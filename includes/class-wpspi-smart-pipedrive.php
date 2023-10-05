<?php
class WPSPI_Smart_Pipedrive {

	protected $plugin_name;

	protected $version;

	public function __construct() {
		$this->version = '1.0.0';
		$this->plugin_name = 'wpspi-smart-pipedrive';
	}

	public function run() {
		/*
			Load all class files
		*/
		require_once WPSPI_PLUGIN_PATH . 'includes/class-wpspi-smart-pipedrive-api.php';
        require_once WPSPI_PLUGIN_PATH . 'admin/class.wpspi-smart-pipedrive-admin.php';
		require_once WPSPI_PLUGIN_PATH . 'public/class.wpspi-smart-pipedrive-public.php';
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}
	
	public function get_version() {
		return $this->version;
	}

	public function get_wp_modules(){
		return array(
                'customers' => esc_html__('Customers','wpspi-smart-pipedrive'),
                'orders'    => esc_html__('Orders','wpspi-smart-pipedrive'),
                'products'  => esc_html__('Products','wpspi-smart-pipedrive'),
            );
	}

	public function get_pipedrive_modules(){

		$pipedrive_api_obj   = new WPSPI_Smart_Pipedrive_API();
       
        /*get list modules*/
        $getListModules = $pipedrive_api_obj->getListModules();
        
        return $getListModules;
	}

	public static function get_customer_fields(){
    	
    	global $wpdb;
		$wc_fields = array(
		    'first_name'            => esc_html__('First Name', 'wpspi-smart-pipedrive'),
		    'last_name'             => esc_html__('Last Name', 'wpspi-smart-pipedrive'),
		    'user_email'            => esc_html__('Email', 'wpspi-smart-pipedrive'),
		    'billing_first_name'    => esc_html__('Billing First Name', 'wpspi-smart-pipedrive'),
		    'billing_last_name'     => esc_html__('Billing Last Name', 'wpspi-smart-pipedrive'),
		    'billing_company'       => esc_html__('Billing Company', 'wpspi-smart-pipedrive'),
		    'billing_address_1'     => esc_html__('Billing Address 1', 'wpspi-smart-pipedrive'),
		    'billing_address_2'     => esc_html__('Billing Address 2', 'wpspi-smart-pipedrive'),
		    'billing_city'          => esc_html__('Billing City', 'wpspi-smart-pipedrive'),
		    'billing_state'         => esc_html__('Billing State', 'wpspi-smart-pipedrive'),
		    'billing_postcode'      => esc_html__('Billing Postcode', 'wpspi-smart-pipedrive'),
		    'billing_country'       => esc_html__('Billing Country', 'wpspi-smart-pipedrive'),
		    'billing_phone'         => esc_html__('Billing Phone', 'wpspi-smart-pipedrive'),
		    'billing_email'         => esc_html__('Billing Email', 'wpspi-smart-pipedrive'),
		    'shipping_first_name'   => esc_html__('Shipping First Name', 'wpspi-smart-pipedrive'),
		    'shipping_last_name'    => esc_html__('Shipping Last Name', 'wpspi-smart-pipedrive'),
		    'shipping_company'      => esc_html__('Shipping Company', 'wpspi-smart-pipedrive'),
		    'shipping_address_1'    => esc_html__('Shipping Address 1', 'wpspi-smart-pipedrive'),
		    'shipping_address_2'    => esc_html__('Shipping Address 2', 'wpspi-smart-pipedrive'),
		    'shipping_city'         => esc_html__('Shipping City', 'wpspi-smart-pipedrive'),
		    'shipping_postcode'     => esc_html__('Shipping Postcode', 'wpspi-smart-pipedrive'),
		    'shipping_country'      => esc_html__('Shipping Country', 'wpspi-smart-pipedrive'),
		    'shipping_state'        => esc_html__('Shipping State', 'wpspi-smart-pipedrive'),
		    'user_url'              => esc_html__('Website', 'wpspi-smart-pipedrive'),
		    'description'           => esc_html__('Biographical Info', 'wpspi-smart-pipedrive'),
		    'display_name'          => esc_html__('Display name publicly as', 'wpspi-smart-pipedrive'),
		    'nickname'              => esc_html__('Nickname', 'wpspi-smart-pipedrive'),
		    'user_login'            => esc_html__('Username', 'wpspi-smart-pipedrive'),
		    'user_registered'       => esc_html__('Registration Date', 'wpspi-smart-pipedrive')
		);

		return $wc_fields;
    }


    public static  function get_order_fields(){
    	
    	global $wpdb;


        $wc_fields =  array(
                'get_id'                       => esc_html__('Order Number', 'wpspi-smart-pipedrive'),
                'get_order_key'                => esc_html__('Order Key', 'wpspi-smart-pipedrive'),
                'get_billing_first_name'       => esc_html__('Billing First Name', 'wpspi-smart-pipedrive'),
                'get_billing_last_name'        => esc_html__('Billing Last Name', 'wpspi-smart-pipedrive'),
                'get_billing_company'          => esc_html__('Billing Company', 'wpspi-smart-pipedrive'),
                'get_billing_address_1'        => esc_html__('Billing Address 1', 'wpspi-smart-pipedrive'),
                'get_billing_address_2'        => esc_html__('Billing Address 2', 'wpspi-smart-pipedrive'),
                'get_billing_city'             => esc_html__('Billing City', 'wpspi-smart-pipedrive'),
                'get_billing_state'            => esc_html__('Billing State', 'wpspi-smart-pipedrive'),
                'get_billing_postcode'         => esc_html__('Billing Postcode', 'wpspi-smart-pipedrive'),
                'get_billing_country'          => esc_html__('Billing Country', 'wpspi-smart-pipedrive'), 
                'get_billing_phone'            => esc_html__('Billing Phone', 'wpspi-smart-pipedrive'),
                'get_billing_email'            => esc_html__('Billing Email', 'wpspi-smart-pipedrive'),
                'get_shipping_first_name'      => esc_html__('Shipping First Name', 'wpspi-smart-pipedrive'),
                'get_shipping_last_name'       => esc_html__('Shipping Last Name', 'wpspi-smart-pipedrive'),
                'get_shipping_company'         => esc_html__('Shipping Company', 'wpspi-smart-pipedrive'),
                'get_shipping_address_1'       => esc_html__('Shipping Address 1', 'wpspi-smart-pipedrive'),
                'get_shipping_address_2'       => esc_html__('Shipping Address 2', 'wpspi-smart-pipedrive'),
                'get_shipping_city'            => esc_html__('Shipping City', 'wpspi-smart-pipedrive'),
                'get_shipping_state'           => esc_html__('Shipping State', 'wpspi-smart-pipedrive'),
                'get_shipping_postcode'        => esc_html__('Shipping Postcode', 'wpspi-smart-pipedrive'),
                'get_shipping_country'         => esc_html__('Shipping Country',  'wpspi-smart-pipedrive'),
                'get_formatted_order_total'     => esc_html__('Formatted Order Total', 'wpspi-smart-pipedrive'),
                'get_cart_tax'                  => esc_html__('Cart Tax', 'wpspi-smart-pipedrive'),
                'get_currency'                  => esc_html__('Currency', 'wpspi-smart-pipedrive'),
                'get_discount_tax'              => esc_html__('Discount Tax', 'wpspi-smart-pipedrive'),
                'get_discount_to_display'       => esc_html__('Discount to Display', 'wpspi-smart-pipedrive'),
                'get_discount_total'            => esc_html__('Discount Total', 'wpspi-smart-pipedrive'),
                'get_shipping_tax'              => esc_html__('Shipping Tax', 'wpspi-smart-pipedrive'),
                'get_shipping_total'            => esc_html__('Shipping Total', 'wpspi-smart-pipedrive'),
                'get_subtotal'                  => esc_html__('SubTotal', 'wpspi-smart-pipedrive'),
                'get_subtotal_to_display'       => esc_html__('SubTotal to Display', 'wpspi-smart-pipedrive'),
                'get_total'                     => esc_html__('Get Total', 'wpspi-smart-pipedrive'),
                'get_total_discount'            => esc_html__('Get Total Discount', 'wpspi-smart-pipedrive'),
                'get_total_tax'                 => esc_html__('Total Tax', 'wpspi-smart-pipedrive'),
                'get_total_refunded'            => esc_html__('Total Refunded', 'wpspi-smart-pipedrive'),
                'get_total_tax_refunded'        => esc_html__('Total Tax Refunded', 'wpspi-smart-pipedrive'),
                'get_total_shipping_refunded'   => esc_html__('Total Shipping Refunded', 'wpspi-smart-pipedrive'),
                'get_item_count_refunded'       => esc_html__('Item count refunded', 'wpspi-smart-pipedrive'),
                'get_total_qty_refunded'        => esc_html__('Total Quantity Refunded', 'wpspi-smart-pipedrive'),
                'get_remaining_refund_amount'   => esc_html__('Remaining Refund Amount', 'wpspi-smart-pipedrive'),
                'get_item_count'                => esc_html__('Item count', 'wpspi-smart-pipedrive'),
                'get_shipping_method'           => esc_html__('Shipping Method', 'wpspi-smart-pipedrive'),
                'get_shipping_to_display'       => esc_html__('Shipping to Display', 'wpspi-smart-pipedrive'),
                'get_date_created'              => esc_html__('Date Created', 'wpspi-smart-pipedrive'),
                'get_date_modified'             => esc_html__('Date Modified', 'wpspi-smart-pipedrive'),
                'get_date_completed'            => esc_html__('Date Completed', 'wpspi-smart-pipedrive'),
                'get_date_paid'                 => esc_html__('Date Paid', 'wpspi-smart-pipedrive'),
                'get_customer_id'               => esc_html__('Customer ID', 'wpspi-smart-pipedrive'),
                'get_user_id'                   => esc_html__('User ID', 'wpspi-smart-pipedrive'),
                'get_customer_ip_address'       => esc_html__('Customer IP Address', 'wpspi-smart-pipedrive'),
                'get_customer_user_agent'       => esc_html__('Customer User Agent', 'wpspi-smart-pipedrive'),
                'get_created_via'               => esc_html__('Order Created Via', 'wpspi-smart-pipedrive'),
                'get_customer_note'             => esc_html__('Customer Note', 'wpspi-smart-pipedrive'),
                'get_shipping_address_map_url'  => esc_html__('Shipping Address Map URL', 'wpspi-smart-pipedrive'),
                'get_formatted_billing_full_name'   => esc_html__('Formatted Billing Full Name', 'wpspi-smart-pipedrive'),
                'get_formatted_shipping_full_name'  => esc_html__('Formatted Shipping Full Name', 'wpspi-smart-pipedrive'),
                'get_formatted_billing_address'     => esc_html__('Formatted Billing Address', 'wpspi-smart-pipedrive'),
                'get_formatted_shipping_address'    => esc_html__('Formatted Shipping Address', 'wpspi-smart-pipedrive'),
                'get_payment_method'            => esc_html__('Payment Method', 'wpspi-smart-pipedrive'),
                'get_payment_method_title'      => esc_html__('Payment Method Title', 'wpspi-smart-pipedrive'),
                'get_transaction_id'            => esc_html__('Transaction ID', 'wpspi-smart-pipedrive'),
                'get_checkout_payment_url'      => esc_html__( 'Checkout Payment URL', 'wpspi-smart-pipedrive'),
                'get_checkout_order_received_url'   => esc_html__('Checkout Order Received URL', 'wpspi-smart-pipedrive'),
                'get_cancel_order_url'          => esc_html__('Cancel Order URL', 'wpspi-smart-pipedrive'),
                'get_cancel_order_url_raw'      => esc_html__('Cancel Order URL Raw', 'wpspi-smart-pipedrive'),
                'get_cancel_endpoint'           => esc_html__('Cancel Endpoint', 'wpspi-smart-pipedrive'),
                'get_view_order_url'            => esc_html__('View Order URL', 'wpspi-smart-pipedrive'),
                'get_edit_order_url'            => esc_html__('Edit Order URL', 'wpspi-smart-pipedrive'),
                'get_status'                    => esc_html__('Status', 'wpspi-smart-pipedrive'),
            );
        
        return $wc_fields;
    }


    public static function get_product_fields(){
    	global $wpdb;
		$wc_fields = array(
		    'get_id'              		=> esc_html__('Product Id', 'wpspi-smart-pipedrive'),
            'get_type'       			=> esc_html__('Product Type', 'wpspi-smart-pipedrive'),
            'get_name'       			=> esc_html__('Name', 'wpspi-smart-pipedrive'),
            'get_slug'          		=> esc_html__('Slug', 'wpspi-smart-pipedrive'),
            'get_date_created'      	=> esc_html__('Date Created', 'wpspi-smart-pipedrive'),
            'get_date_modified'     	=> esc_html__('Date Modified', 'wpspi-smart-pipedrive'),
            'get_status'            	=> esc_html__('Status', 'wpspi-smart-pipedrive'),
            'get_featured'          	=> esc_html__('Featured', 'wpspi-smart-pipedrive'),
            'get_catalog_visibility'	=> esc_html__('Catalog Visibility', 'wpspi-smart-pipedrive'),
            'get_description'       	=> esc_html__('Description', 'wpspi-smart-pipedrive'),
            'get_short_description' 	=> esc_html__('Short Description', 'wpspi-smart-pipedrive'),
            'get_sku'            		=> esc_html__('Sku', 'wpspi-smart-pipedrive'),
            'get_menu_order'      		=> esc_html__('Menu Order', 'wpspi-smart-pipedrive'),
            'get_virtual'       		=> esc_html__('Virtual', 'wpspi-smart-pipedrive'),
            'get_permalink'         	=> esc_html__('Product Permalink', 'wpspi-smart-pipedrive'),
            'get_price'       			=> esc_html__('Price', 'wpspi-smart-pipedrive'),
            'get_regular_price'       	=> esc_html__('Regular Price', 'wpspi-smart-pipedrive'),
            'get_sale_price'            => esc_html__('Sale Price', 'wpspi-smart-pipedrive'),
            'get_date_on_sale_from'     => esc_html__('Date on Sale From', 'wpspi-smart-pipedrive'),
            'get_date_on_sale_to'       => esc_html__('Date on Sale To', 'wpspi-smart-pipedrive'),
            'get_total_sales'         	=> esc_html__('Total Sales', 'wpspi-smart-pipedrive'),
            'get_tax_status'     		=> esc_html__('Tax Status', 'wpspi-smart-pipedrive'),
            'get_tax_class'           	=> esc_html__('Tax Class', 'wpspi-smart-pipedrive'),
            'get_manage_stock'          => esc_html__('Manage Stock', 'wpspi-smart-pipedrive'),
            'get_stock_quantity'        => esc_html__('Stock Quantity', 'wpspi-smart-pipedrive'),
            'get_stock_status'          => esc_html__('Stock Status', 'wpspi-smart-pipedrive'),
            'get_backorders'       		=> esc_html__('Backorders', 'wpspi-smart-pipedrive'),
            'get_sold_individually'     => esc_html__('Sold Individually', 'wpspi-smart-pipedrive'),
            'get_purchase_note'         => esc_html__('Purchase Note', 'wpspi-smart-pipedrive'),
            'get_shipping_class_id'     => esc_html__('Shipping Class ID', 'wpspi-smart-pipedrive'),
            'get_weight'               	=> esc_html__('Weight', 'wpspi-smart-pipedrive'),
            'get_length'              	=> esc_html__('Length', 'wpspi-smart-pipedrive'),
            'get_width'            		=> esc_html__('Width', 'wpspi-smart-pipedrive'),
            'get_height'            	=> esc_html__('Height', 'wpspi-smart-pipedrive'),
            'get_categories'            => esc_html__('Categories', 'wpspi-smart-pipedrive'),
            'get_category_ids'          => esc_html__('Categories IDs', 'wpspi-smart-pipedrive'),
            'get_tag_ids'            	=> esc_html__('Tag IDs', 'wpspi-smart-pipedrive'),
		);
        
		return $wc_fields;
    }

    public function store_required_field_mapping_data(){

        global $wpdb;
        $pipedrive_api_obj   = new WPSPI_Smart_Pipedrive_API();
        $wp_modules     = $this->get_wp_modules();
        $getListModules = $this->get_pipedrive_modules();

        if($getListModules['modules']){
            foreach ($getListModules['modules'] as $key => $singleModule) {
                if( $singleModule['deletable'] &&  $singleModule['creatable'] ){
        
                    $pipedrive_fields = $pipedrive_api_obj->getFieldsMetaData( $singleModule['api_name'] );
        
                    if($pipedrive_fields){
                        foreach ($pipedrive_fields['fields'] as $pipedrive_field_key => $pipedrive_field_data) {
                            if($pipedrive_field_data['field_read_only'] == NULL){
                                if( $pipedrive_field_data['system_mandatory'] == 1 ){
                                    if($wp_modules){
                                        foreach ($wp_modules as $wpModuleSlug => $wpModuleLabel) {
        
                                            switch ( $wpModuleSlug ) {
                                                case 'customers':
                                                    $wp_field = "first_name";
                                                    break;
                                                
                                                case 'orders':
                                                    $wp_field = "get_id";
                                                    break;

                                                case 'products':
                                                    $wp_field = "get_name";
                                                    break;

                                                default:
                                                    $wp_field = "";
                                                    break;
                                            }

                                            $status         = 'active';
                                            $description    = '';

                                            $record_exists = $wpdb->get_row( 
                                                $wpdb->prepare(
                                                    "
                                                    SELECT * FROM ".$wpdb->prefix ."smart_pipedrive_field_mapping  WHERE wp_module = %s AND wp_field = %s  AND pipedrive_module = %s AND pipedrive_field = %s
                                                    " ,
                                                    $wpModuleSlug, $wp_field, $singleModule['api_name'], $pipedrive_field_data['api_name']
                                                    )
                                                
                                            );

                                            if ( null !== $record_exists ) {
                                                
                                              $reccord_id       = $record_exists->id;
                                              $is_predefined    = $record_exists->is_predefined;
                                              

                                                $wpdb->update(
                                                    $wpdb->prefix . 'smart_pipedrive_field_mapping', 
                                                    array( 
                                                        'wp_module'     => sanitize_text_field($wpModuleSlug),
                                                        'wp_field'      => sanitize_text_field($wp_field),
                                                        'pipedrive_module'   => sanitize_text_field($singleModule['api_name']),
                                                        'pipedrive_field'    => sanitize_text_field($pipedrive_field_data['api_name']), 
                                                        'status'        => sanitize_text_field($status),
                                                        'description'   => sanitize_text_field($description), 
                                                        'is_predefined' => sanitize_text_field($is_predefined), 
                                                    ), 
                                                    array( 'id' => $reccord_id ), 
                                                    array( 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s'
                                                    ),
                                                    array( '%d' )
                                                );

                                            }else{
                                                $wpdb->insert( 
                                                    $wpdb->prefix . 'smart_pipedrive_field_mapping', 
                                                    array( 
                                                        'wp_module'     => sanitize_text_field($wpModuleSlug),
                                                        'wp_field'      => sanitize_text_field($wp_field),
                                                        'pipedrive_module'   => sanitize_text_field($singleModule['api_name']),
                                                        'pipedrive_field'    => sanitize_text_field($pipedrive_field_data['api_name']), 
                                                        'status'        => sanitize_text_field($status),
                                                        'description'   => sanitize_text_field($description), 
                                                        'is_predefined' => 'yes', 
                                                    ),
                                                    array( 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s', 
                                                        '%s'
                                                    ) 
                                                );
                                            }
                                            
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
?>