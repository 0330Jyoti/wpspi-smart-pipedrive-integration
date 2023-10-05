<?php

class WPSPI_Smart_Pipedrive_Deactivator
{
    public function deactivate() {
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		
		$smart_pipedrive_report_table_name 			= $wpdb->prefix . 'smart_pipedrive_report';
		$smart_pipedrive_field_mapping_table_name 	= $wpdb->prefix . 'smart_pipedrive_field_mapping';

		delete_option('wpspi_smart_pipedrive_settings');
		delete_option('wpspi_smart_pipedrive');
		delete_option('wpspi_smart_pipedrive_modules_fields');
	}
}
?>