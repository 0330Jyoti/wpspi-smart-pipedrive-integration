<?php
/**
 * Plugin Name:       WPSPI Smart Pipedrive Integration
 * Plugin URI:        https://profiles.wordpress.org/iqbal1486/
 * Description:       WP Smart Zoho help you to manage and synch possible WordPress data like customers, orders, products to the Zoho modules as per your settings options.
 * Version:           2.1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Geekerhub
 * Author URI:        https://profiles.wordpress.org/iqbal1486/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wpspi-smart-pipedrive
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit( 'restricted access' );
}

define( 'WPSPI_VERSION', '1.0.0' );

if (! defined('WPSPI_ADMIN_URL') ) {
    define('WPSPI_ADMIN_URL', get_admin_url());
}

if (! defined('WPSPI_PLUGIN_FILE') ) {
    define('WPSPI_PLUGIN_FILE', __FILE__);
}

if (! defined('WPSPI_PLUGIN_PATH') ) {
    define('WPSPI_PLUGIN_PATH', plugin_dir_path(WPSPI_PLUGIN_FILE));
}

if (! defined('WPSPI_PLUGIN_URL') ) {
    define('WPSPI_PLUGIN_URL', plugin_dir_url(WPSPI_PLUGIN_FILE));
}

if (! defined('WPSPI_REDIRECT_URI') ) {
    define('WPSPI_REDIRECT_URI', admin_url( 'admin.php?page=wpspi_smart_pipedrive_process' ));
}

if (! defined('WPSZI_SETTINGS_URI') ) {
    define('WPSPI_SETTINGS_URI', admin_url( 'admin.php?page=wpspi-smart-pipedrive-integration' ));
}

if (! defined('WPSPI_PIPEDRIVEAPIS_URL') ) {
    $tld = "com";
    // $wpspi_smart_pipedrive_settings  = get_option( 'wpspi_smart_pipedrive_settings' );
    // if( !empty($wpspi_smart_pipedrive_settings['data_center'])){
    //     $tld = end(explode(".", parse_url( $wpspi_smart_pipedrive_settings['data_center'], PHP_URL_HOST)));
    // }
    define('WPSPI_PIPEDRIVEAPIS_URL', 'https://www.pipedriveapis.'.$tld);
}

function wpspi_smart_pipedrive_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class.activator.php';
	$WPSPI_Smart_Pipedrive_Activator = new WPSPI_Smart_Pipedrive_Activator();
    $WPSPI_Smart_Pipedrive_Activator->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpszi-smart-zoho-deactivator.php
 */
function wpspi_smart_pipedrive_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class.deactivator.php';
    WPSPI_Smart_Pipedrive_Deactivator::deactivate();
}


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wpspi-smart-pipedrive.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function wpspi_smart_pipedrive_run() {
    $plugin = new WPSPI_Smart_Pipedrive();
	$plugin->run();
}

register_activation_hook( __FILE__, 'wpspi_smart_pipedrive_activate' );
register_deactivation_hook( __FILE__, 'wpspi_smart_pipedrive_deactivate' );

wpspi_smart_pipedrive_run();

function wpspi_smart_pipedrive_textdomain_init() {
    load_plugin_textdomain( 'wpspi-smart-pipedrive', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action('plugins_loaded', 'wpspi_smart_pipedrive_textdomain_init');
?>