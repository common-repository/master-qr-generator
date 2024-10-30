<?php


/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      2.0.3
 * @package    masterqr
 * @subpackage masterqr/includes
 * @author     Sharabindu Bakshi <sharabindu86@gmail.com>
 */
class Master_QR_Lite_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    2.0.3
	 */
	public static function activate() {
		flush_rewrite_rules();
		if(isset($_POST['action']) && current_user_can('manage_options')) {

		  update_option( 'masterqr_settings' , sanitize_text_field($_POST['masterqr_settings']));

		}	

	}


}
