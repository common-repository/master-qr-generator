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

class MasterLiteMetavalues
{

    public function __construct()
    {

        add_action('admin_init', array(
            $this,
            'qcr_metabox_page'
        ));
        add_action('save_post', array(
            $this,
            'qrc_save_post_meta'
        ));

    }
    /**
     *  metabox function
     */

    public function qcr_metabox_page()
    {
    $args = array(
        'public' => true,
    );

        $excluded_posttypes = array('attachment','revision','nav_menu_item','custom_css','customize_changeset','oembed_cache','user_request','wp_block','scheduled-action','product_variation','shop_order','shop_order_refund','shop_coupon','elementor_library','e-landing-page','wp_template','wp_template_part','wp_navigation','wp_global_styles','shop_order_placehold');

    $types = get_post_types( $args);
        $post_types = array_diff($types, $excluded_posttypes);

        add_meta_box('masterqr_metabox', esc_html__('Master QR Generator', 'master-qr-generator') , array(
            $this,
            'masterqr_metabox_func'
        ) , array(
            $post_types
        ));

    }

    /**
     * This is call back function of add_meta_box
     */

    public function masterqr_metabox_func($post)
    {

        $qrc_meta_check_info = get_post_meta($post->ID, 'masterqr_meta', true) ? get_post_meta($post->ID, 'masterqr_meta', true) : 1;
    ?>
	<ul  class="master_metaoutput_wrap">
	    <li>
	    <label for="checkbox_3" class="checkbox_qr_3"><strong><?php esc_html_e('Disable QR?', 'master-qr-generator') ?> </strong></label>
	    </li><li>
	    <select name="master_select_field" class="mqr_selct_admin">
	        
	    <option value="no" <?php echo esc_attr($qrc_meta_check_info) == "no" ? 'selected' : '' ?>><?php esc_html_e('No', 'master-qr-generator'); ?></option>
	    <option value="yes" <?php echo esc_attr($qrc_meta_check_info) == "yes" ? 'selected' : '' ?>><?php esc_html_e('Yes', 'master-qr-generator'); ?></option>

	    </select>
	    </li>

	    <li class="mast_mta_bx">
	    <?php
        $options = get_option('masterqr_settings');

        $current_title = get_the_title(get_the_id());
        $currentlink = get_the_permalink(get_the_id());
        $rand = rand(37684782, 23297323);
        $qrc_size = isset($options['qr_code_picture_size_width']) ? $options['qr_code_picture_size_width'] : 254;

        $qrc_logo_image = isset($options['qrc_logo_image']) ? $options['qrc_logo_image'] : '';
        include MASTER_QR_LITE_PATH . '/admin/extra/optionValue.php';

        if ($qrc_size <= '100')
        {
            $logo_size = '30';
        }
        else
        {
            $logo_size = '55';
        }
        $qr_download = '<a class="mqrdownload"  download="' . $current_title . '.png" class="btn_fromt_canvas" style="color:' . $qr_dwnbtn_color . ';background:' . $qr_dwnbtnbg_color . ';">' .__($download_qr,'master-qr-generator')  . '
                </a>';
    $masteqrprint ='<a class="mqrprints" id="printButtoncont'.$rand.'" style="margin-left:10px;color:' . $print_clor . ';background:' . $print_background . '";>'.$qr_print_text.'</a>';

        echo  '<div class="masteqr-postwarpper" id="masteqr-wrap'.$rand.'"><div id="masteqr-post'.$rand.'" class="masteqr-post"  data-size="'.$qrc_size.'" data-content="'.$currentlink.'"></div><div class ="mqrbtnalign" style="    display: flex;justify-content:center"><div style="width:'.$qrc_size.'px;display:flex;align-items: center;justify-content: center;font-size: small">' . $qr_download .$masteqrprint .'
                </div></div></div>';

    }

    /**
     * This function save meta data
     */

    public function qrc_save_post_meta($post_id)
    {

        if (array_key_exists('master_select_field', $_POST))
        {

            update_post_meta($post_id, 'masterqr_meta', sanitize_text_field($_POST['master_select_field']));
        }

    }

}
if (class_exists('MasterLiteMetavalues'))
{
    new MasterLiteMetavalues();
}

