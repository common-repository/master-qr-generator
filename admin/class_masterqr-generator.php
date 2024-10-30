<?php
/**
 * The file that defines the bulk qrc_download admin area
 *
 * -facing side of the site and the admin area.
 *
 * @link       https://sharabindu.com/plugins/master-qr-generator/
 * @since      2.0.3
 *
 * @package    masterqr
 * @subpackage masterqr/admin
 */
class MASTER_LiteQR_Generator
{
    public function __construct()
    {
        add_action('admin_init', array(
            $this,
            'qcr_settings_page'
        ));

    }

    function qcr_settings_page()
    {
        include MASTER_QR_LITE_PATH . '/admin/extra/MsterGeneretorRegiser.php';

    }
    /**
     * This function is a callback function of  add seeting section
     */

    function qrdowtext()
    {

       return true;
    }
    function settting_sec_func()
    {
        return true;
    }

    function qr_checkbox()
    {
    $args = array(
        'public' => true,
    );

        $excluded_posttypes = array('attachment','revision','nav_menu_item','custom_css','customize_changeset','oembed_cache','user_request','wp_block','scheduled-action','product_variation','shop_order','shop_order_refund','shop_coupon','elementor_library','e-landing-page','wp_template','wp_template_part','wp_navigation','wp_global_styles','shop_order_placehold');
    $types = get_post_types( $args);
        $post_types = array_diff($types, $excluded_posttypes);

        foreach ($post_types as $post_type)
        {
            $post_type_title = get_post_type_object($post_type);
            $options = get_option('masterqr_pagety');

            $checked = isset($options[$post_type]) ? 'checked' : '';

            printf('<input type="checkbox" id="%s" class="master-apple-switch" value="%s" name="masterqr_pagety[%s]" %s>
            <label for ="%s" id="qr-label-wrap"><strong>' . $post_type_title
                ->labels->name . '</strong></label></br>', $post_type, $post_type, $post_type, $checked, $post_type);

        }


        echo '<em class="descripton">'.esc_html('if you want to turnoff any post type form QR code click the swticher','master-qr-generator').'</em>';

    }

    function qr_input_size()
    {

        $options = get_option('masterqr_settings');
        $qr_input_size = isset($options['qr_code_picture_size_width']) ? $options['qr_code_picture_size_width'] : '300';

    ?>
            <input type="range" min="100" max="600" name="masterqr_settings[qr_code_picture_size_width]" value="<?php echo esc_attr($qr_input_size); ?>" id="qrnputsize"  class="mqrranges"  oninput="mqrnum4.value = this.value"/><input type="number" class="mqrnclss" id="mqrnum4" value="<?php echo esc_attr($qr_input_size); ?>" min="100" max="600" oninput="qrnputsize.value = this.value">

        <?php
    }


    function master_wc_ptab_name()
    {

        $options = get_option('masterqr_pagety');
        $master_wc_ptab_name = isset($options['master_wc_ptab_name']) ? $options['master_wc_ptab_name'] : 'Product QR';

        printf('<input type="text" name="masterqr_pagety[master_wc_ptab_name]" value="%s" placeholder="e:g:Product QR">', $master_wc_ptab_name);

    }
    /**
     * This function is a callback function of  add seeting field
     */

    function qr_alignment()
    {

        $options = get_option('masterqr_pagety');

        $qrc_alignment = isset($options['qrc_select_alignment']) ? $options['qrc_select_alignment'] : 'left';

        $qrc_wc_alignment = isset($options['qrc_wc_select_alignment']) ? $options['qrc_wc_select_alignment'] : 'left';

?>
        <select name="masterqr_pagety[qrc_select_alignment]">
            
        <option value="left" <?php echo esc_attr($qrc_alignment) == 'left' ? 'selected' : '' ?>><?php esc_html_e('Left', 'master-qr-generator'); ?></option>
        <option value="right" <?php echo esc_attr($qrc_alignment) == 'right' ? 'selected' : '' ?>><?php esc_html_e('Right', 'master-qr-generator'); ?></option>   
        <option value="center" <?php echo esc_attr($qrc_alignment) == 'center' ? 'selected' : '' ?>><?php esc_html_e('Center', 'master-qr-generator'); ?></option>

        </select>
    <?php

    }    /**
     * This function is a callback function of  add seeting field
     */

    function mqr_wcalignment()
    {

        $options = get_option('masterqr_pagety');

        $qrc_wc_alignment = isset($options['qrc_wc_select_alignment']) ? $options['qrc_wc_select_alignment'] : 'left';

    ?>
    <select name="masterqr_pagety[qrc_wc_select_alignment]">
        
    <option value="left" <?php echo esc_attr($qrc_wc_alignment) == 'left' ? 'selected' : '' ?>><?php esc_html_e('Left', 'master-qr-generator'); ?></option>
    <option value="right" <?php echo esc_attr($qrc_wc_alignment) == 'right' ? 'selected' : '' ?>><?php esc_html_e('Right', 'master-qr-generator'); ?></option>    
    <option value="center" <?php echo esc_attr($qrc_wc_alignment) == 'center' ? 'selected' : '' ?>><?php esc_html_e('Center', 'master-qr-generator'); ?></option>

    </select>

        <?php

    }

    /**
     * This function is a callback function of  add seeting field
     */

    function qr_download_text()
    {

        $options = get_option('masterqr_settings');
        $options_value = isset($options['qr_download_text']) ? $options['qr_download_text'] : 'Download QR Code';

        printf('<input type="text" name="masterqr_settings[qr_download_text]" value="%s" placeholder="Download QR Code" id="qr_download_text">', $options_value);
        
    }   /**
     * This function is a callback function of  add seeting field
     */

    function qr_download_show()
    {

        $options = get_option('masterqr_settings');
        $qr_download_hide = isset($options['qr_download_hide']) ? $options['qr_download_hide'] : 'no';
?>
        <select name="masterqr_settings[qr_download_hide]" id="qr_download_hide">
            
        <option value="yes" <?php echo esc_attr($qr_download_hide) == 'yes' ? 'selected' : '' ?>><?php esc_html_e('Remove Download Button', 'master-qr-generator'); ?></option>
        <option value="no" <?php echo esc_attr($qr_download_hide) == 'no' ? 'selected' : '' ?>><?php esc_html_e('Keep Download Button', 'master-qr-generator'); ?></option>    

        </select>

    <?php
    }

    function qr_download_text_c()
    {
        $options = get_option('masterqr_settings');
        $qr_dwnbtn_color = (isset($options['dt_clor'])) ? $options['dt_clor'] : '#fff';

        printf('<input type="text" name="masterqr_settings[dt_clor]" value="%s"  id="dt_clor">', $qr_dwnbtn_color);

    } function qrcbtnbg()
    {
        $options = get_option('masterqr_settings');
        $qr_dwnbtnbg_color = (isset($options['dt_background'])) ? $options['dt_background'] : '#e53463';

        printf('<input type="text" name="masterqr_settings[dt_background]" value="%s"  id="dt_background">', $qr_dwnbtnbg_color);

    }

    function qr_print_show(){

        $options = get_option('masterqr_settings');

        $qr_download_hide = isset($options['qr_print_hide']) ? $options['qr_print_hide'] : 'no';?>

        <select name="masterqr_settings[qr_print_hide]" id="qr_print_hide">
            
        <option value="yes" <?php echo esc_attr($qr_download_hide) == 'yes' ? 'selected' : '' ?>><?php esc_html_e('Remove Print button', 'master-qr-generator'); ?></option>
        <option value="no" <?php echo esc_attr($qr_download_hide) == 'no' ? 'selected' : '' ?>><?php esc_html_e('Keep Print button', 'master-qr-generator'); ?></option>    

        </select>
         
    <?php
    }

    function qr_print_text(){

        $options = get_option('masterqr_settings');
        $options_value = isset($options['qr_print_text']) ? $options['qr_print_text'] : 'Print QR Code';

        printf('<input type="text" name="masterqr_settings[qr_print_text]" value="%s" placeholder="Print QR Code" id="qr_print_text">', $options_value); 

    }
    function qr_print_text_c()
    {
        $options = get_option('masterqr_settings');
        $dt_clor = (isset($options['print_clor'])) ? $options['print_clor'] : '#fff';
        printf('<input type="text" name="masterqr_settings[print_clor]" value="%s"  id="print_clor">', $dt_clor);

    }
function qr_printbtnbg()
    {
        $options = get_option('masterqr_settings');

        $dt_background = (isset($options['print_background'])) ? $options['print_background'] : '#e53463';

        printf('<input type="text" name="masterqr_settings[print_background]" value="%s"  id="print_background">', $dt_background);


    }

    /**
     * This function is a callback function of  add seeting field
     */

    function qrc_logo_image()
    {?>
            <input type="text" disabled value="Premium Feature"/>
            <a href="https://master-qr.dipashi.com/wp-admin/admin.php?page=masterqr" target="_blank">Pro Admin Demo</a>
        <?php
    }   


    function qrc_logo_bgimage()
    {?>
            <input type="text" disabled value="Premium Feature"/>
            <a href="https://master-qr.dipashi.com/wp-admin/admin.php?page=masterqr" target="_blank">Pro Admin Demo</a>
        <?php
    }

    function dot_scale()
    {

        $options = get_option('masterqr_settings');
        $dot_scale = isset($options['dot_scale']) ? $options['dot_scale'] : 0.4;

        ?>
            <input type="range" id="dot_scale" name="masterqr_settings[dot_scale]"   value="<?php echo esc_attr($dot_scale); ?>" min="0.4" max="1" step="0.1" class="mqrranges"  oninput="mqrnum8.value = this.value"/><output id="mqrnum8"><?php echo esc_attr($dot_scale); ?></output>
<?php    }


    function qr_color_management()
    {

        $options = get_option('masterqr_settings');
        $qrc_color = isset($options['qr_color']) ? $options['qr_color'] : '#1f2984';
        printf('<input type="text" name="masterqr_settings[qr_color]" value="%s" id="qrc_color" class="qrc-bgcolor-picker">', $qrc_color);


    }
    /**
     *  Qr BG Color field
     */

    function background()
    {

        $options = get_option('masterqr_settings');

        $qrc_bgcolor = isset($options['background']) ? $options['background'] : 'transparent';

        printf('<input type="text" name="masterqr_settings[background]" value="%s"  id="qr_bg" class="qrc-bgcolor-picker">', $qrc_bgcolor);

    }

    function qr_stcode_management()
    {

        printf('<span id="qr_current_url_sc">[masterqr-post]</span>
                <button type="button" class="masterqr_qrc_clip_btn" data-clipboard-demo data-clipboard-target="#qr_current_url_sc"><span class="dashicons dashicons-admin-page"></span></button>');
        printf('<div style="width:%s; padding:10px 0px"><em class="descripton">This shortcode generate a QR code for the URL of the current page. available attributes; [masterqr-post print_hide="no" download_hide="no"] Type "yes" if you want to hide a button</div>', '90%');

    }
    function master_stcode_postype()
    {

        printf('<span id="qr_current_posttype_sc">[mqr-type-post type="post" limit="5"]</span>
                <button type="button" class="masterqr_qrc_clip_btn" data-clipboard-demo data-clipboard-target="#qr_current_posttype_sc" style="margin-right:20px"><span class="dashicons dashicons-admin-page"></span></button> <em ><a href="https://masterqr.sharabindu.com/docs/post-type-qr/#1-toc-title">How to use</a></em>');
        printf('<div style="width:%s; padding:10px 0px"><em class="descripton" >With this shortcode, you can display a QR list by post type, category type or ID type, suppose you want to show 5 product QR codes with product title:[mqr-type-post type="product" title="true" limit="5" print_hide="no" download_hide="no"]</div>', '90%');

    }

    /**
     * admin form field validation
     */

    function master_option_page_sanitize($input)
    {

        include MASTER_QR_LITE_PATH . '/admin/extra/MgeneratorSavevalues.php';
        return $sanitary_values;
    }
    function master_opagetype_sanitize($input)
    {

    $sanitary_values = array();
   if (isset($input['qrc_select_alignment']))
    {
        $sanitary_values['qrc_select_alignment'] = $input['qrc_select_alignment'];
    }

    if (isset($input['qrc_wc_select_alignment']))
    {
        $sanitary_values['qrc_wc_select_alignment'] = $input['qrc_wc_select_alignment'];
    }
    if (isset($input['master_wc_ptab_name']))
    {
        $sanitary_values['master_wc_ptab_name'] = sanitize_text_field($input['master_wc_ptab_name']);
    }   
     $post_types = get_post_types();

    foreach ($post_types as $post_type)
    {

        if (isset($input[$post_type]))
        {
            $sanitary_values[$post_type] = $input[$post_type];
        }
    }
        return $sanitary_values;
    }
}

