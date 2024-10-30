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
class masterqrLite_Public
{
    /**
     * The ID of this plugin.
     *
     * @since    2.0.3
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;
    /**
     * The version of this plugin.
     *
     * @since    2.0.3
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;
    /**
     * Initialize the class and set its properties.
     *
     * @since    2.0.3
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }
    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    2.0.3
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->plugin_name, MASTER_QR_LITE_URL . 'public/css/masterqr-public.css', array() , $this->version, 'all');
    }
    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    2.0.3
     */
    public function enqueue_scripts()
    { 
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in masterqrlite_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The masterqrlite_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
    wp_register_script('easyqrcode', MASTER_QR_LITE_URL . 'admin/js/easy.qrcode.min.js', array(
            'jquery'
        ) , $this->version, true);
        wp_register_script('master_qr', MASTER_QR_LITE_URL . 'public/js/custom.js', array(
            'jquery',
        ) , $this->version, true);

        include MASTER_QR_LITE_PATH . '/admin/extra/optionValue.php';

        global $wp;
        $current_id_link = home_url(add_query_arg(array() , $wp->request));
        $rand = rand(736476,3984); 
 
        if($qr_print_hide == 'no'){
                wp_enqueue_script('PrintJs', MASTER_QR_LITE_URL . 'admin/js/jQuery.print.js', array(
                    'jquery'
                ) , $this->version, true);
        }

        $types = get_post_types();
        foreach ($types as $post_type){
            $post_type_title = get_post_type_object($post_type);
        }

            $data = array(
            "linksas"=> $current_id_link,
            "scale"=> $dot_scale,
            "size"=> $qrc_size,
            "bgcolor"=> $qrc_bgcolor,
            "qrcolor"=> $qrc_color

        );    
    wp_localize_script( 'master_qr', 'datas', $data );   
    }

    /**
     * This function is display Qr code on frontend.
     */

    public function qcr_code_element($content)
    {
       
        $rand = rand(736476,3984);
        include MASTER_QR_LITE_PATH . '/admin/extra/optionValue.php';

        if ($qr_download_hide == 'no')
        {   $eft12 = '10';
            $qr_download_ = '<a class="mqrdownload"  download="' . $current_title . '.png" class="btn_fromt_canvas" style="color:' . $qr_dwnbtn_color . ';background:' . $qr_dwnbtnbg_color . ';">' .__($download_qr,'master-qr-generator')  . '
                </a>';
        }
        else
        {
            $qr_download_ = '';
            $eft12 = '0';
        }
        if ($qr_print_hide == 'no')
        {
            $masteqrprint ='<a class="mqrprints" id="printButtoncont'.$rand.'" style="margin-left:'.$eft12.'px;color:' . $print_clor . ';background:' . $print_background . '";>'.$qr_print_text.'</a>';
        }
        else
        {
            $masteqrprint = '';
        }
        $options1 = get_option('masterqr_pagety');
     if (!empty($options1))
        {
            $singlular_exclude = is_singular($options1);
        }
        else
        {
            $singlular_exclude = '';
        }

        if (($qrc_meta_display == 'yes') or ($singlular_exclude) or is_singular('product'))
        {
            $content .= '';

        }
        else
        {
        
            $qrc_qr_image = '<div class="masteqr-postwarpper" id="masteqr-wrap'.$rand.'"><div style="text-align:' . $qrc_alignment . '" id="masteqr-post'.$rand.'" class="masteqr-post"  data-size="'.$qrc_size.'" data-content="'.$current_id_link.'"></div><div class ="mqrbtnalign" style="    display: flex;justify-content:' . $qrc_alignment . '"><div style="width:'.$qrc_size.'px;display:flex;align-items: center;justify-content: center;font-size: small">' . $qr_download_ .$masteqrprint .'
                </div></div></div>';

            $content .= sprintf('%s', $qrc_qr_image);
        wp_enqueue_script('easyqrcode');

        wp_enqueue_script('master_qr');
        }

        return $content;

    }

    /**
     * This function is Provide for Createing Woocomerce custom product tab for Qr Code
     */

    public function woo_custom_product_tabs($tabs){

        $options = get_option('masterqr_settings');
        $options1 = get_option('masterqr_pagety');

        $master_wc_ptab_name = isset($options1['master_wc_ptab_name']) ? $options1['master_wc_ptab_name'] : 'Product QR';

        $tabs['master_pricing_tab'] = array(
            'title' => $master_wc_ptab_name,
            'priority' => 200,
            'callback' => array(
                $this,
                'master_qrc_tab_content'
            )
        );
        $current_id = get_the_ID();
        $qrc_meta_display = get_post_meta($current_id, 'masterqr_meta', true);

        if (!empty($options1))
        {
            $singlular_wc_exclude = is_singular($options1);
        }
        else
        {
            $singlular_wc_exclude = '';
        }

        if (($qrc_meta_display == 'yes') or ($singlular_wc_exclude))
        {
            return false;
        }
        else
        {
            return $tabs;

    }
    }

    /**
     *  Woocomerce custom product tab Call Back function
     */

    public function master_qrc_tab_content()
    {
        include MASTER_QR_LITE_PATH . '/admin/extra/optionValue.php';
        $rand = rand(347857,368968);
        if ($qr_download_hide == 'no')
        {   $eft12 = '10';
            $qr_download_ = '<a  class="mqrdownload" download="' . $current_title . '.png"  class="mastbtnclass" style="width:' . $qrc_size . 'px;color:' . $qr_dwnbtn_color . ';background:' . $qr_dwnbtnbg_color . ';">' .__($download_qr,'master-qr-generator')  . '
                </a>';
        }
        else
        {
            $qr_download_ = '';
            $eft12 = '0';
        }
        if ($qr_print_hide == 'no')
        {
            $masteqrprint ='<a class="mqrprints" id="printButtoncont'.$rand.'" style="margin-left:'.$eft12.'px;color:' . $print_clor . ';background:' . $print_background . '";>'.$qr_print_text.'</a>';
        }
        else
        {
            $masteqrprint = '';
        }
         wp_enqueue_script('easyqrcode');

        wp_enqueue_script('master_qr');
        echo '<div class="masteqr-postwarpper" id="masteqr-wrap'.$rand.'"><div style="text-align:' . $qrc_wc_alignment . '" id="masteqr-post'.$rand.'" class="masteqr-post"  data-size="'.$qrc_size.'"  data-content="'.$current_id_link.'"></div><div class ="mqrbtnalign" style="    display: flex;justify-content:' . $qrc_wc_alignment . '"><div style="width:'.$qrc_size.'px;display:flex;align-items: center;justify-content: center;font-size: small">' . $qr_download_ .$masteqrprint .'
                </div></div></div>';



    }

    function qcr_shortcode_setting()
    {

        add_shortcode('masterqr-post', array(
            $this,
            'mastershortcode_atts'
        ));
        add_shortcode('mqr-type-post', array(
            $this,
            'mastershortcode_posttype_atts'
        ));

    }

    function mastershortcode_posttype_atts($atts)
    {

        ob_start();
        wp_enqueue_script('easyqrcode');
        wp_enqueue_script('master_qr');
        global $wp;
  

        $current_title = get_the_title(get_the_id());
        $x = 1;
        $options1 = get_option('masterqr_pagety');

        $qrc_alignment = isset($options1['qrc_select_alignment']) ? $options1['qrc_select_alignment'] : 'left';
        include MASTER_QR_LITE_PATH . '/admin/extra/optionValue.php';
         if(!empty($id)){
       $product_ids = explode(",", $id);
        $args = array(
            'post_type'=> $type,
            'posts_per_page' => $limit,
            'post__in' => $product_ids
         );

        }elseif(!empty($taxonomy)){

       $category_ids = explode(",", $category);
        $args = array(
            'post_type'=> $type,
            'posts_per_page' => $limit,
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy,
                    'terms' => $category_ids,
                    'field' => 'slug',
                    'include_children' => true,
                    'operator' => 'IN'
                )
            ),
         );
        }else{
            $args = array(
            'post_type'=> $type,
            'posts_per_page' => $limit,
         );    
        }

    $masterqr_loop = new WP_Query($args);

    if ($masterqr_loop->have_posts()):
        while ($masterqr_loop->have_posts()):
            $masterqr_loop->the_post();

        $rand = rand(347857,368968);
        $current_id_link = get_the_permalink();
        if($title == 'true'){

            $tileytetrue = '<p style="font-weight:600;text-align:center">'.get_the_title().'</p>';
        }else{
           $tileytetrue = '<p></p>';
        }

        if ($qr_download_hide == 'no')
        {
            $eft12 = '10';
            $qr_download_ = '<a  class="mqrdownload"  download="' . get_the_title() . '.png" class="mastbtnclass" style="color:' . $qr_dwnbtn_color . ';background:' . $qr_dwnbtnbg_color . '">' .__($download_qr,'master-qr-generator')  . '</a>';

        }
        else
        {
            $qr_download_ = '';
             $eft12 = '0';           
        }

        if ($qr_print_hide == 'no')
        {
            $masteqrprint ='<a class="mqrprints" id="printButtoncont'.$rand.'" style="margin-left:'.$eft12.'px;color:' . $print_clor . ';background:' . $print_background . '";>'.$qr_print_text.'</a>';
        }
        else
        {
            $masteqrprint = '';
        }
     echo '<div class="masteqr-postwarpper" id="masteqr-wrap'.$rand.'" style="display:inline-block; margin-right: 24px">'.$tileytetrue.'<div style="text-align:' . $qrc_alignment . '" id="masteqr-post'.$rand.'" class="masteqr-post"  data-size="'.$qrc_size.'" data-content="'.$current_id_link.'"></div><div class ="mqrbtnalign" style="    display: flex;justify-content:' . $qrc_alignment . '"><div style="width:'.$qrc_size.'px;display:flex;align-items: center;justify-content: center;font-size: small">' . $qr_download_ .$masteqrprint .'
                </div></div></div>';

        endwhile;
   
     wp_reset_postdata();
    endif;

    return ob_get_clean();
    }


    function mastershortcode_atts($atts)
    {
        ob_start();

        wp_enqueue_script('easyqrcode');

        wp_enqueue_script('master_qr');
        global $wp;
        $current_id_link = home_url(add_query_arg(array() , $wp->request));

        $current_title = get_the_title(get_the_id());
        $rand = rand(37684782, 23297323);
        $x = 1;
        $options1 = get_option('masterqr_pagety');

        $qrc_alignment = isset($options1['qrc_select_alignment']) ? $options1['qrc_select_alignment'] : 'left';
        include MASTER_QR_LITE_PATH . '/admin/extra/optionValue.php';

        if ($qr_download_hide == 'no')
        {   $eft12 = '10';  
            $qr_download_ = '<a class="mqrdownload" download="' . get_the_title() . '.png" class="mastbtnclass" style="color:' . $qr_dwnbtn_color . ';background:' . $qr_dwnbtnbg_color . '">' .__($download_qr, 'master-qr-generator')  . '</a>';
        }
        else
        {   
            $eft12 = '0';  
            $qr_download_ = '';
        }

        if ($qr_print_hide == 'no')
        {
            $masteqrprint ='<a class="mqrprints" id="printButtoncont'.$rand.'" style="margin-left:'.$eft12.'px;color:' . $print_clor . ';background:' . $print_background . '";>'.$qr_print_text.'</a>';
        }
        else
        {
            $masteqrprint = '';
        }

        echo '<div class="masteqr-postwarpper" id="masteqr-wrap'.$rand.'"><div style="text-align:' . $qrc_alignment . '" id="masteqr-post'.$rand.'" class="masteqr-post"  data-size="'.$qrc_size.'" data-content="'.$current_id_link.'"></div><div class ="mqrbtnalign" style="    display: flex;justify-content:' . $qrc_alignment . '"><div style="width:'.$qrc_size.'px;display:flex;align-items: center;justify-content: center;font-size: small">' . $qr_download_ .$masteqrprint .'
                </div></div></div>';

     return ob_get_clean();

    }

}

