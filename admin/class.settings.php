<?php
class WPSPI_Smart_Pipedrive_Admin_Settings {

    public function processSettingsForm($POST = array()){
       
        $client_id = $client_secret = "";
        
       	if ( isset( $_POST['submit'] ) ) {

            if(isset($_REQUEST['tab']) && $_REQUEST['tab'] == "general"){
                $client_id                  = sanitize_text_field($_REQUEST['wpspi_smart_pipedrive_settings']['client_id']);
                $client_secret              = sanitize_text_field($_REQUEST['wpspi_smart_pipedrive_settings']['client_secret']);
                $wpspi_smart_pipedrive_data_center  = sanitize_text_field($_REQUEST['wpspi_smart_pipedrive_settings']);    
            }
                        
            $wpspi_smart_pipedrive_settings  = !empty(get_option( 'wpspi_smart_pipedrive_settings' )) ? get_option( 'wpspi_smart_pipedrive_settings' ) : array();

            $wpspi_smart_pipedrive_settings = array_merge($wpspi_smart_pipedrive_settings, $_REQUEST['wpspi_smart_pipedrive_settings']);
            
            update_option( 'wpspi_smart_pipedrive_settings', $wpspi_smart_pipedrive_settings );
            
            if ( $client_id && $client_secret ) {
                $redirect_uri = esc_url(WPSPI_REDIRECT_URI);
                $redirect_url = "https://oauth.pipedrive.com/oauth/authorize?client_id=$client_id&redirect_uri=$redirect_uri";

                if ( wp_redirect( $redirect_url ) ) {
				    exit;
				}
            }
            
        }
    }

    public function displaySettingsForm(){
        require_once WPSPI_PLUGIN_PATH . 'admin/partials/settings.php';
    }
}
?>