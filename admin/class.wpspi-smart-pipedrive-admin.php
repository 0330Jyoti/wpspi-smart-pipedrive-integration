<?php
class WPSPI_Smart_Pipedrive_Admin {

    public function __construct() {
        $this->load();
        $this->menu();
    }

    private function load() {
        require_once WPSPI_PLUGIN_PATH . 'admin/class.settings.php';
        require_once WPSPI_PLUGIN_PATH . 'admin/class.fields-mappings.php';
        require_once WPSPI_PLUGIN_PATH . 'admin/class.synchronization.php';
        require_once WPSPI_PLUGIN_PATH . 'admin/class.customers-list.php';
        require_once WPSPI_PLUGIN_PATH . 'admin/class.orders-list.php';
        require_once WPSPI_PLUGIN_PATH . 'admin/class.products-list.php';
    }

    private function menu() {
        add_action( 'admin_enqueue_scripts', array($this, 'wpspi_smart_pipedrive_scripts_callback') );
        add_action( 'wp_ajax_wp_field', array($this, 'wpspi_smart_pipedrive_wp_field_callback') );
        add_action( 'wp_ajax_pipedrive_field', array($this, 'wpspi_smart_pipedrive_pipedrive_field_callback') );
        add_action( 'admin_menu', array($this, 'wpspi_smart_pipedrive_main_menu_callback') );
    }

    public function wpspi_smart_pipedrive_scripts_callback(  $hook ) {
      
        $hook_array = array(
                            'toplevel_page_wpspi-smart-pipedrive-integration',
                            'smart-pipedrive_page_wpspi-smart-pipedrive-mappings'
                        );
        if (  ! in_array($hook, $hook_array)  ) {
            return;
        }

        // Register the script

        wp_register_script( 
                    'jquery-dataTables-min-js', 
                    WPSPI_PLUGIN_URL . 'admin/js/jquery.dataTables.min.js', 
                    array(), 
                    time() 
                );

        wp_register_script( 
                    'wpspi-smart-pipedrive-js', 
                    WPSPI_PLUGIN_URL . 'admin/js/wpspi-smart-pipedrive.js', 
                    array(), 
                    time() 
                );

        wp_register_style( 
                    'jquery-dataTables-min-css', 
                    WPSPI_PLUGIN_URL . 'admin/css/jquery.dataTables.min.css', 
                    array(), 
                    time() 
                );

        wp_register_style( 
                    'wpspi-smart-pipedrive-style', 
                    WPSPI_PLUGIN_URL . 'admin/css/wpspi-smart-pipedrive.css', 
                    array(), 
                    time() 
                );
        

        // Localize the script with new data
        $localize_array = array(
            'ajaxurl'       => admin_url( 'admin-ajax.php' ),
        );

        wp_localize_script( 'wpspi-smart-pipedrive-js', 'smart_pipedrive_js', $localize_array );
         
        // Enqueued script with localized data.

        wp_enqueue_script( 'jquery-dataTables-min-js' );
        wp_enqueue_script( 'wpspi-smart-pipedrive-js' );
        
        wp_enqueue_style( 'jquery-dataTables-min-css' );
        wp_enqueue_style( 'wpspi-smart-pipedrive-style' );
    }

    public function wpspi_smart_pipedrive_wp_field_callback() {
       ob_start(); 
       $wp_fields = array();

       if( isset( $_REQUEST['wp_module_name'] ) ){

            switch ( $_REQUEST['wp_module_name'] ) {
                case 'customers':
                    $wp_fields = WPSPI_Smart_Pipedrive::get_customer_fields();
                    break;

                case 'orders':
                    $wp_fields = WPSPI_Smart_Pipedrive::get_order_fields();
                    break;

                case 'products':
                    $wp_fields = WPSPI_Smart_Pipedrive::get_product_fields();
                    break;

                default:
                    # code...
                    break;
            }
       }
       
       $wp_fields_options = "<option>".esc_html__('Select WP Fields', 'wpspi-smart-pipedrive')."</option>";
       
       if($wp_fields){
            foreach ($wp_fields as $option_value => $option_label) {
                $wp_fields_options .=  "<option value='".$option_value."'>".esc_html__($option_label, 'wpspi-smart-pipedrive')."</option>";
            }
       }
       
       ob_get_clean();
       echo $wp_fields_options;
       wp_die(); 
    }

    public function wpspi_smart_pipedrive_pipedrive_field_callback() {
       ob_start(); 
       $pipedrive_fields = array();

       if( isset($_REQUEST['pipedrive_module_name']) ){
            $pipedrive_module    = $_REQUEST['pipedrive_module_name'];
                $pipedrive_api_obj   = new WPSPI_Smart_Pipedrive_API();
                $pipedrive_fields    = $pipedrive_api_obj->getFieldsMetaData($pipedrive_module);
       }
       
       $pipedrive_fields_options = "<option>".esc_html__('Select Pipedrive Fields', 'wpspi-smart-pipedrive')."</option>";
       
       if($pipedrive_fields){
            foreach ($pipedrive_fields['fields'] as $pipedrive_field_key => $pipedrive_field_data) {
                if($pipedrive_field_data['field_read_only'] == NULL){

                    $system_mandatory   = ($pipedrive_field_data['system_mandatory'] == 1) ? " ( Required ) " : "";
                    $data_type          = isset($pipedrive_field_data['data_type']) ? " ( ".ucfirst($pipedrive_field_data['data_type'])." ) " : "";

                    echo 
                    $pipedrive_fields_options .= "<option value='".$pipedrive_field_data['api_name']."'>". esc_html__($pipedrive_field_data['display_label'], 'wpspi-smart-pipedrive') . esc_html($data_type) . esc_html($system_mandatory) . "</option>";
                }
            }
       }
       
       ob_get_clean();
       echo $pipedrive_fields_options;
       wp_die(); 
    }

    public function wpspi_smart_pipedrive_main_menu_callback() {
        add_menu_page( 
                        esc_html__('Smart Pipedrive', 'wpspi-smart-pipedrive'), 
                        esc_html__('Smart Pipedrive', 'wpspi-smart-pipedrive'), 
                        'manage_options', 
                        'wpspi-smart-pipedrive-integration', 
                        array($this, 'settings_callback'), 
                        'dashicons-paperclip' 
                    );

        add_submenu_page( 
                        'wpspi-smart-pipedrive-integration', 
                        esc_html__( 'Smart Pipedrive Settings', 'wpspi-smart-pipedrive' ), 
                        esc_html__( 'Smart Pipedrive', 'wpspi-smart-pipedrive' ), 
                        'manage_options', 
                        'wpspi-smart-pipedrive-integration', 
                        array($this, 'settings_callback')
                    );

        add_submenu_page( 
                        'wpspi-smart-pipedrive-integration', 
                        esc_html__( 'Smart Pipedrive Fields Mappings', 'wpspi-smart-pipedrive' ), 
                        esc_html__( 'Fields Mappings', 'wpspi-smart-pipedrive' ), 
                        'manage_options', 
                        'wpspi-smart-pipedrive-mappings', 
                        array($this, 'mappings_callback')
                    );

        add_submenu_page( 
                        'wpspi-smart-pipedrive-integration', 
                        esc_html__( 'Smart Pipedrive Synchronization', 'wpspi-smart-pipedrive' ), 
                        esc_html__( 'Synchronization', 'wpspi-smart-pipedrive' ), 
                        'manage_options', 
                        'wpspi-smart-pipedrive-synchronization', 
                        array($this, 'Synchronization_callback')
                    );

        add_submenu_page( 
                        'wpspi-smart-pipedrive-integration', 
                        NULL, 
                        NULL, 
                        'manage_options', 
                        'wpspi_smart_pipedrive_process', 
                        array($this, 'pipedrive_process_callback')
                    );
    }

    public function pipedrive_process_callback(){
        
        global $wpdb;

        if ( isset( $_REQUEST['code'] ) ) {
            $code           = sanitize_text_field($_REQUEST['code']);
            $pipedrive_api_obj   = new WPSPI_Smart_Pipedrive_API();
            $token          = $pipedrive_api_obj->getToken( $code, WPSPI_REDIRECT_URI );
            
            if ( isset( $token->error ) ) {
                /*Error logic*/
            } else {
                $pipedrive_api_obj->manageToken( $token );    
            }
        }

        $smart_pipedrive_obj = new WPSPI_Smart_Pipedrive();
        $smart_pipedrive_obj->store_required_field_mapping_data();
        
        wp_redirect(WPSPI_SETTINGS_URI);
        exit();
    }

    public function settings_callback(){
        $admin_settings_obj = new WPSPI_Smart_Pipedrive_Admin_Settings();
        $admin_settings_obj->processSettingsForm();
        $admin_settings_obj->displaySettingsForm();
    }

    public function mappings_callback(){
        $field_mapping_obj = new WPSPI_Smart_Pipedrive_Field_Mappings();
        $field_mapping_obj->processMappingsForm();
        $field_mapping_obj->displayMappingsForm(); 
        $field_mapping_obj->displayMappingsFieldList();
    }

    public function Synchronization_callback(){
        $admin_synch_obj = new WPSPI_Smart_Pipedrive_Admin_Synchronization();
        $admin_synch_obj->processSynch();
        $admin_synch_obj->displaySynchData();
    }
}

new WPSPI_Smart_Pipedrive_Admin();
?>