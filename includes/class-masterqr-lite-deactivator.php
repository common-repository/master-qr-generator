<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://sharabindu.com/plugins/master-qr-generator/
 * @since      2.0.3
 *
 * @package    masterqr
 * @subpackage masterqr/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      2.0.3
 * @package    masterqr
 * @subpackage masterqr/includes
 * @author     Sharabindu Bakshi <sharabindu86@gmail.com>
 */
class Master_QR_Lite_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    2.0.3
	 */
	public static function deactivate() {
		flush_rewrite_rules();
}
}
