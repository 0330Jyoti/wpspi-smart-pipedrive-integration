<?php
class WPSPI_Smart_Pipedrive_Admin_Settings {

    public function processSettingsForm($POST = array()){
       
        $client_id = $client_secret = "";
        
        if ( isset( $_POST['submit'] ) ) {
                        
            $wpspi_smart_pipedrive_settings  = !empty(get_option( 'wpspi_smart_pipedrive_settings' )) ? get_option( 'wpspi_smart_pipedrive_settings' ) : array();

            if (isset($_REQUEST['wpspi_smart_pipedrive_settings'])) {
                $wpspi_smart_pipedrive_settings = array_merge($wpspi_smart_pipedrive_settings, $_REQUEST['wpspi_smart_pipedrive_settings']);
            }
            
            update_option( 'wpspi_smart_pipedrive_settings', $wpspi_smart_pipedrive_settings );
            
        }

    }

    public function displaySettingsForm(){
        require_once WPSPI_PLUGIN_PATH . 'admin/partials/settings.php';
    }
}
?>
