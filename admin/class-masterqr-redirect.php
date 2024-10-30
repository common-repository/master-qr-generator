<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://sharabindu.com/plugins/master-qr-generator/
 * @since      2.0.3
 *
 * @package    masterqr
 * @subpackage masterqr/public
 */

class MQRLiteRediect
{

    public function __construct()
    {

        define('MASTERQR_LITE_PLUGIN_ID', 'master-qr-generator');
        define('MASTERQR_LITE_PRINT_ID', 'masterqr_print');

        add_action('admin_enqueue_scripts', array(
            $this,
            'qrc_admin_theme_style'
        ));

        add_action('login_enqueue_scripts', array(
            $this,
            'qrc_admin_theme_style'
        ));
    }

    public function qrc_admin_theme_style()
    {

        if (isset($_GET['page']) && strpos($_GET['page'], MASTERQR_LITE_PLUGIN_ID) !== false)
        {
            echo '<style>.update-nag, .updated,.notice.notice-info,.notice{ display: none !important; }.notice-success.settings-error {display: block !important}</style>';
        }
        if (isset($_GET['page']) && strpos($_GET['page'], MASTERQR_LITE_PRINT_ID) !== false)
        {
            echo '<style>.update-nag, .updated,.notice.notice-info,.notice{ display: none !important; }.notice-success.settings-error {display: block !important}</style>';
        }

    }

}
if (class_exists('MQRLiteRediect'))
{

    new MQRLiteRediect();
}

