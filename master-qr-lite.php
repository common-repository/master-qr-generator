<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Master QR Generator
 * Plugin URI:        https://sharabindu.com/plugins/master-qr-generator/
 * Description:       it will generate QR codes for each page, each post, and each product for WooCommerce.
 * Version:           2.0.3
 * Author:            Sharabindu
 * Author URI:        https://sharabindu.com/plugins/master-qr-generator/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       master-qr-generator
 * Domain Path:       /languages
 */

    // If this file is called directly, abort.
if (!defined('ABSPATH'))
{
    die();
}

/**
 *Include plugin.php
 *Check Qr composer Pro Version is enable.
 * Then Deactive Pro version and activate Lite version
 */

include_once(ABSPATH.'wp-admin/includes/plugin.php');
if( is_plugin_active('master_qr/master_qr.php') ){
     add_action('update_option_active_plugins', 'deactivate_pro_version');
}
function deactivate_pro_version(){
   deactivate_plugins('master_qr/master_qr.php');
}
  /**
 * Currently plugin version.
 * Start at version2.0.3 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MASTER_QR_LITE_VERSION', '2.0.3' );

/**
 * The core plugin path that is used to define internationalization
 */
define( 'MASTER_QR_LITE_PATH', plugin_dir_path(__FILE__));

/**
 * The core plugin url that is used to define internationalization
 */
define( 'MASTER_QR_LITE_URL', plugin_dir_url(__FILE__));

if (! defined('MASTER_QR_LITE_PLUGIN_ID')) {
    define( 'MASTER_QR_LITE_PLUGIN_ID', 'master-qr-generator'); // unique prefix (same plugin ID name for 'lite' and 'pro')
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-Master_QR_Lite-activator.php
 */
function Master_QR_Lite_Activate() {


    require_once MASTER_QR_LITE_PATH . 'includes/class-masterqr-lite-activator.php';
    Master_QR_Lite_Activator::activate();

    }



/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-Master_QR_Lite-deactivator.php
 */
function Master_QR_Lite_Deactivate() {
    require_once MASTER_QR_LITE_PATH . 'includes/class-masterqr-lite-deactivator.php';
    Master_QR_Lite_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'Master_QR_Lite_Activate' );
register_deactivation_hook( __FILE__, 'Master_QR_Lite_Deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require MASTER_QR_LITE_PATH . 'includes/class-masterqr-lite.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since   2.0.3
 */
function Master_QR_Lite_Run() {
   


    $plugin = new Master_QR_Lite();
    $plugin->run();
    }

Master_QR_Lite_Run();

