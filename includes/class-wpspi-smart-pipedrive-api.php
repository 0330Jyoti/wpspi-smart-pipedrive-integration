<?php
class WPSPI_Smart_Pipedrive_API {
    
    var $url;
    var $client_id;
    var $client_secret;
    var $token;
    
    function __construct() {

        $wpspi_smart_pipedrive_settings     = get_option( 'wpspi_smart_pipedrive_settings' );

        $client_id                  = isset($wpspi_smart_pipedrive_settings['client_id']) ? esc_attr($wpspi_smart_pipedrive_settings['client_id']) : '';
        $client_secret              = isset($wpspi_smart_pipedrive_settings['client_secret']) ? esc_attr($wpspi_smart_pipedrive_settings['client_secret']) : '';
        $wpspi_smart_pipedrive_data_center  = isset($wpspi_smart_pipedrive_settings['data_center']) ? esc_attr($wpspi_smart_pipedrive_settings['data_center']) : '';

        $wpspi_smart_pipedrive_data_center    = ( $wpspi_smart_pipedrive_data_center ? $wpspi_smart_pipedrive_data_center : 'https://oauth.pipedrive.com' );

        $this->url              = $wpspi_smart_pipedrive_data_center;
        $this->client_id        = $client_id;
        $this->client_secret    = $client_secret;
        $this->token            = get_option( 'wpspi_smart_pipedrive' );

        //Get any existing copy of our transient data
        if ( false === ( $wpspi_smart_pipedrive_expire = get_transient( 'wpspi_smart_pipedrive_expire' ) ) ) {
            
            $this->getRefreshToken($this->token);
        }

        $this->loadAPIFiles();
    }
    
    function loadAPIFiles(){
        require_once WPSPI_PLUGIN_PATH . 'includes/class.getListofModules.php';
        require_once WPSPI_PLUGIN_PATH . 'includes/class.getFieldsMetaData.php';
    }

    function getListModules(){
        return (new GetListofModules())->execute($this->token);
    }

    function getFieldsMetaData( $module_name = NULL ){
        return (new GetFieldsMetaData())->execute($module_name);
    }

    function getToken( $code, $redirect_uri ) {
        
        $client_id   = $this->client_id;
        $user_secret = $this->client_secret;
        $auth        = base64_encode($client_id . ':' . $user_secret);

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL =>  $this->url.'/oauth/token',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'grant_type=authorization_code&code='.$code.'&redirect_uri='.$redirect_uri.'',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Basic '.$auth.'',
          ),
        ));

        $response = curl_exec($curl);
        
        return $response;
    }

    function getRefreshToken($token) {

       if (is_string($token)) {
            $token = json_decode($token);
        }

            $client_id   = $this->client_id;
            $user_secret = $this->client_secret;
            $auth        = base64_encode($client_id . ':' . $user_secret);
            $data = http_build_query(array(
                    'grant_type'    => 'refresh_token',
                    'refresh_token' => $token->refresh_token,
                ));
            $access_token = $token->access_token;

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->url.'/oauth/token/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic ' . $auth,
                    'Content-Type: application/x-www-form-urlencoded',
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            if (isset($response->access_token)) {
                $token->access_token = $response->access_token;
                $wpspi_smart_pipedrive_expire = 'Expire_Management';
                set_transient('wpspi_smart_pipedrive_expire', $wpspi_smart_pipedrive_expire, 3500);
                update_option('wpspi_smart_pipedrive', $token);
            }

        return $response;
    } 


    function manageToken( $token ){

        $old_token = get_option( 'wpspi_smart_pipedrive' );
        if (is_string($token)) {
            $token = json_decode($token);
        }

        if ( ! isset( $token->refresh_token ) && $old_token ) {
            $old_token->access_token = $token->access_token;
            $token = $old_token;
        }
        
        $wpspi_smart_pipedrive_expire = 'Expire_Management';
        set_transient( 'wpspi_smart_pipedrive_expire', $wpspi_smart_pipedrive_expire, 3500 );
        update_option( 'wpspi_smart_pipedrive', $token );
        return true;
    }

    function getModuleFields( $token, $module ) {
        
        $header = array(
            'Authorization: Pipedrive-oauthtoken '.$token->access_token,
            'Content-Type: application/json',
        );
        
        $url = $token->api_domain.'/crm/v2/settings/fields?module='.$module;
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        $json_response = curl_exec( $ch );
        curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        curl_close( $ch );
        
        $response = json_decode( $json_response );
        $fields = array();
        if ( isset( $response->fields ) && $response->fields != null ) {
            foreach ( $response->fields as $field ) {
                if ( isset( $field->view_type->create ) && $field->view_type->create ) {
                    $fields[$field->api_name] = array(
                        'label'     => $field->field_label,
                        'type'      => $field->data_type,
                    );
                }
            }
        }
        return $fields;
    }
    
    function addRecord( $module, $data ) {
        
        $data = array(
            'data'  => array(
                $data,
            ),
        );

        $data = json_encode( $data );
        $header = array(
            'Authorization: Pipedrive-oauthtoken '.$this->token->access_token,
        );
        
        $url = WPSPI_PIPEDRIVEAPIS_URL.'/crm/v2/'.$module;
        
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
        $json_response = curl_exec( $ch );
        curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        curl_close( $ch );
        
        $response = json_decode( $json_response );
        
        if ( isset( $response->data[0]->status ) && $response->data[0]->status == 'error' ) {
            $log = "errorCode: ".$response->data[0]->code."\n";
            $log .= "message: ".$response->data[0]->message."\n";
            $log .= "Date: ".date( 'Y-m-d H:i:s' )."\n\n";                            

            file_put_contents( WPSPI_PLUGIN_PATH.'debug.log', $log, FILE_APPEND );
        }
        
        return $response;
    }
    
    function updateRecord( $module, $data, $record_id ) {
        
        $data = array(
            'data'  => array(
                $data,
            ),
        );
        
        $data = json_encode( $data );
        $header = array(
            'Authorization: Pipedrive-oauthtoken '.$this->token->access_token,
        );
        
        $url = WPSPI_PIPEDRIVEAPIS_URL.'/crm/v2/'.$module.'/'.$record_id;
        
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'PUT' );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
        $json_response = curl_exec( $ch );
        curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        curl_close( $ch );
        
        $response = json_decode( $json_response );
        if ( isset( $response->data[0]->status ) && $response->data[0]->status == 'error' ) {
            $log = "errorCode: ".$response->data[0]->code."\n";
            $log .= "message: ".$response->data[0]->message."\n";
            $log .= "Date: ".date( 'Y-m-d H:i:s' )."\n\n";                            

            file_put_contents( WPSPI_PLUGIN_PATH.'debug.log', $log, FILE_APPEND );
        }
        
        return $response;
    }
}
?>