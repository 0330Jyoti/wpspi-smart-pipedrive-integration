<?php
class WPSPI_Smart_Pipedrive_Public {
  
    public function __construct() {
        
        $this->loadCustomerAction();
        $this->loadOrderAction();
        $this->loadProductAction();
    }


    private function loadCustomerAction() {
        add_action( 'user_register', array($this, 'addUserToPipedrive') );
        add_action( 'profile_update', array($this, 'addUserToPipedrive'), 10, 1 );
        add_action( 'woocommerce_update_customer', array($this, 'addUserToPipedrive'), 10, 1 );
    }


    private function loadOrderAction() {
        add_action( 'save_post', array( $this, 'addOrderToPipedrive' ), 10, 1 );
        add_action('woocommerce_thankyou', array( $this, 'addOrderToPipedrive' ), 10, 1);
    }


    private function loadProductAction() {
        add_action( 'woocommerce_update_product', array( $this, 'addProductToPipedrive' ), 10, 1 );
    }

    public function addUserToPipedrive( $user_id ){
        global $wpdb;
        $data       = array();
        $user_info  = get_userdata($user_id);

        $default_wp_module = "customers";

        $wpspi_smart_pipedrive_settings = get_option( 'wpspi_smart_pipedrive_settings' );
        $synch_settings         = !empty( $wpspi_smart_pipedrive_settings['synch'] ) ? $wpspi_smart_pipedrive_settings['synch'] : array();

        foreach ($synch_settings as $wp_pipedrive_module => $enable) {
            
            $wp_pipedrive_module = explode('_', $wp_pipedrive_module);
            $wp_module      = $wp_pipedrive_module[0];
            $pipedrive_module    = $wp_pipedrive_module[1];

            if($default_wp_module == $wp_module){
                
                $get_pipedrive_field_mapping = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}smart_pipedrive_field_mapping WHERE wp_module ='".$wp_module."' AND pipedrive_module = '".$pipedrive_module."' AND status='active'");

                foreach ($get_pipedrive_field_mapping as $key => $value) {
                    $wp_field   = $value->wp_field;
                    $pipedrive_field = $value->pipedrive_field;

                    if ( $pipedrive_field ) {
                        if ( isset( $user_info->{$wp_field} ) ) {
                            if ( is_array( $user_info->{$wp_field} ) ) {
                                $user_info->{$wp_field} = implode(';', $user_info->{$wp_field} );
                            }
                            $data[$pipedrive_module][$pipedrive_field] = strip_tags( $user_info->{$wp_field} );
                        }
                    }
                }
            }   
        }

        if( $data != null ){
            $this->prepareAndActionOnData( $user_id, $data, $default_wp_module );
        }
    }


    public function addOrderToPipedrive( $order_id ){
        global $wpdb, $post_type; 
        $data       = array();

        if ( get_post_type( $order_id ) !== 'shop_order' ){
            return;
        }

        $order = wc_get_order( $order_id );
        
        $default_wp_module = "orders";

        $wpspi_smart_pipedrive_settings = get_option( 'wpspi_smart_pipedrive_settings' );
        $synch_settings         = !empty( $wpspi_smart_pipedrive_settings['synch'] ) ? $wpspi_smart_pipedrive_settings['synch'] : array();

        foreach ($synch_settings as $wp_pipedrive_module => $enable) {
            
            $wp_pipedrive_module = explode('_', $wp_pipedrive_module);
            $wp_module      = $wp_pipedrive_module[0];
            $pipedrive_module    = $wp_pipedrive_module[1];

            if($default_wp_module == $wp_module){
                
                $get_pipedrive_field_mapping = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}smart_pipedrive_field_mapping WHERE wp_module ='".$wp_module."' AND pipedrive_module = '".$pipedrive_module."' AND status='active'");

                foreach ($get_pipedrive_field_mapping as $key => $value) {
                    $wp_field   = $value->wp_field;
                    $pipedrive_field = $value->pipedrive_field;

                    if ( $pipedrive_field ) {

                        if ( null !== $order->{$wp_field}() ) {
                            $data[$pipedrive_module][$pipedrive_field] = strip_tags( $order->{$wp_field}() );
                        }
                    }
                }
            }   
        }
        
        if( $data != null ){
            $this->prepareAndActionOnData( $order_id, $data, $default_wp_module );
        }
    }


    public function addProductToPipedrive( $post_id ){
        global $wpdb, $post_type, $data; 
        $data = array();

        if ( get_post_type( $post_id ) !== 'product' ){
            return;
        }
        
        $product = wc_get_product( $post_id );

        $default_wp_module = "products";

        $wpspi_smart_pipedrive_settings = get_option( 'wpspi_smart_pipedrive_settings' );
        $synch_settings         = !empty( $wpspi_smart_pipedrive_settings['synch'] ) ? $wpspi_smart_pipedrive_settings['synch'] : array();

        foreach ($synch_settings as $wp_pipedrive_module => $enable) {
            
            $wp_pipedrive_module = explode('_', $wp_pipedrive_module);
            $wp_module      = $wp_pipedrive_module[0];
            $pipedrive_module    = $wp_pipedrive_module[1];

            if($default_wp_module == $wp_module){
                
                $get_pipedrive_field_mapping = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}smart_pipedrive_field_mapping WHERE wp_module ='".$wp_module."' AND pipedrive_module = '".$pipedrive_module."' AND status='active'");

                foreach ($get_pipedrive_field_mapping as $key => $value) {
                    $wp_field   = $value->wp_field;
                    $pipedrive_field = $value->pipedrive_field;

                    if ( $pipedrive_field ) {

                        if ( null !== $product->{$wp_field}() ) {
                            if(is_array($product->{$wp_field}())){
                                $data[$pipedrive_module][$pipedrive_field] = implode(',', $product->{$wp_field}());
                            }else{
                                $data[$pipedrive_module][$pipedrive_field] = strip_tags( $product->{$wp_field}() );    
                            }
                        }
                    }
                }
            }   
        }

        if($data != null ){
            $this->prepareAndActionOnData( $post_id, $data, $default_wp_module );
        }
    }


    public function prepareAndActionOnData($id, $data = array(), $default_wp_module = NULL){
        
        if( $default_wp_module == 'orders' ||  $default_wp_module == 'products' ){
            $smart_pipedrive_relation = get_post_meta( $id, 'smart_pipedrive_relation', true );
        }else{
            $smart_pipedrive_relation = get_user_meta( $id, 'smart_pipedrive_relation', true );    
        }
        

        if ( ! is_array( $smart_pipedrive_relation ) ) {
            $smart_pipedrive_relation = array();
        }

        $pipedrive_api_obj   = new WPSPI_Smart_Pipedrive_API();
        
        foreach ($data as $pipedrive_module => $pipedrive_data) {
            
            $record_id = ( isset( $smart_pipedrive_relation[$pipedrive_module] ) ? $smart_pipedrive_relation[$pipedrive_module] : 0 );

            if ( $record_id ) {
                $response = $pipedrive_api_obj->updateRecord($pipedrive_module, $pipedrive_data, $record_id);
            }else{
                $response = $pipedrive_api_obj->addRecord($pipedrive_module, $pipedrive_data);
            }
                        
            if ( isset( $response->data[0]->details->id ) ) {
                $record_id = $response->data[0]->details->id;
                $smart_pipedrive_relation[$pipedrive_module] = $record_id;
            }
        }

        if( $default_wp_module == 'orders' ||  $default_wp_module == 'products' ){
            update_post_meta( $id, 'smart_pipedrive_relation', $smart_pipedrive_relation );
        }else{
            update_user_meta( $id, 'smart_pipedrive_relation', $smart_pipedrive_relation );    
        }
        
    }
}

new WPSPI_Smart_Pipedrive_Public();
?>