<?php
class WPSPI_Smart_Pipedrive_Admin_Synchronization {

    public function processSynch($POST = array()){
       
       	if ( isset( $_POST['submit'] ) ) {

            if(isset($_REQUEST['tab']) && $_REQUEST['tab'] == "general"){
                $api_key                  = sanitize_text_field($_REQUEST['wpspi_smart_pipedrive_settings']['psn-token']);
            }
                        
            $wpspi_smart_pipedrive_settings  = !empty(get_option( 'wpspi_smart_pipedrive_settings' )) ? get_option( 'wpspi_smart_pipedrive_settings' ) : array();

            $wpspi_smart_pipedrive_settings = array_merge($wpspi_smart_pipedrive_settings, $_REQUEST['wpspi_smart_pipedrive_settings']);
            
            update_option( 'wpspi_smart_pipedrive_settings', $wpspi_smart_pipedrive_settings );
            
        }


        /*Synch product*/
        if( isset( $_POST['smart_synch'] ) && $_POST['smart_synch'] == 'pipedrive' ){

           
            $id = $_POST['id'];

            switch ($_POST['wp_module']) {
                
                case 'products':
                    
                    $WPSPI_Smart_Pipedrive_Public = new WPSPI_Smart_Pipedrive_Public();
                    $WPSPI_Smart_Pipedrive_Public->addProductToPipedrive( $id );

                    break;

                case 'orders':
                    
                    $WPSPI_Smart_Pipedrive_Public = new WPSPI_Smart_Pipedrive_Public();
                    $WPSPI_Smart_Pipedrive_Public->addOrderToPipedrive( $id );

                    break;

                case 'customers':
                    
                    $WPSPI_Smart_Pipedrive_Public = new WPSPI_Smart_Pipedrive_Public();
                    $WPSPI_Smart_Pipedrive_Public->addUserToPipedrive( $id );

                    break;    
                
                default:
                    # code...
                    break;
            }
            
        }
        

    }

    public function displaySynchData(){
        require_once WPSPI_PLUGIN_PATH . 'admin/partials/synchronization.php';
    }
}
?>