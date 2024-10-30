<?php
/**
 * The file that defines the bulk print admin area
 *
 * public-facing side of the site and the admin area.
 *
 * @link       https://sharabindu.com/plugins/master-qr-generator/
 * @since      2.0.3
 *
 * @package    masterqr
 * @subpackage masterqr/admin
 */

class MASTERLite_QR_shortcode
{

    public function __construct()
    {
        add_action('init', array(
            $this,
            'qrc_link_shortcode'
        ));
    }

    function qrc_link_shortcode()

    {

        add_shortcode('masterqr_link', array(
            $this,
            'masterqr_link_shortcode_atts'
        ));

        add_shortcode('masterqr_whatsapp', array(
            $this,
            'masterqr_whatapp_shortcode_atts'
        ));

        add_shortcode('masterqr_wifi', array(
            $this,
            'masterqr_wifi_shortcode_atts'
        ));

        add_shortcode('masterqr_maps', array(
            $this,
            'masterqr_maps_shortcode_atts'
        ));

        add_shortcode('masterqr_vcard', array(
            $this,
            'masterqr_vcard_shortcode_atts'
        ));

    }

    function masterqr_link_shortcode_atts($atts)
    {

        ob_start();
        wp_enqueue_script('easyqrcode');
        wp_enqueue_script('master_qr');       
        $options = get_option('masterqr_link_generator');
        $qr_code_custom_text = isset($options['qr_code_custom_text']) ? $options['qr_code_custom_text'] : 'Master QR';

        include MASTER_QR_LITE_PATH . '/admin/extra/optionValue.php';
        $random_id = rand(10, 10000);

        if ($qr_download_hide == 'no')
        {   $eft12 = '10'; 
            $qr_download_ = '<a class="mqrdownload" download="' . $qr_code_custom_text . '.png"  style="color:' . $qr_dwnbtn_color . ';background:' . $qr_dwnbtnbg_color . '">' .__($download_qr,'master-qr-generator')  . '</a>';

        }
        else
        {   $eft12 = '0'; 
            $qr_download_ = '';
        }
        if ($qr_print_hide == 'no')
        {
            $masteqrprint ='<a class="mqrprints" id="printButtoncont'.$random_id.'" style="margin-left:'.$eft12.'px;color:' . $print_clor . ';background:' . $print_background . '";>'.$qr_print_text.'</a>';
        }
        else
        {
            $masteqrprint = '';
        }

        echo '<div class="masteqr-postwarpper" id="masteqr-wrap'.$random_id.'"><div  id="masteqr-post'.$random_id.'" class="masteqr-post"  data-size="'.$qrc_size.'" data-content="'.$qr_code_custom_text.'"></div><div class ="mqrbtnalign"><div style="width:'.$qrc_size.'px;display:flex;align-items: center;justify-content: center;font-size: small">' . $qr_download_ .$masteqrprint .'
                </div></div></div>';

        return ob_get_clean();

    }

    function masterqr_whatapp_shortcode_atts($atts)
    {
       

        ob_start();
         wp_enqueue_script('easyqrcode');
        wp_enqueue_script('master_qr');       
        $options = get_option('masterqr_link_generator');
        
        include MASTER_QR_LITE_PATH . '/admin/extra/optionValue.php';
        $random_id = rand(10, 10000);
        $qr_code_mail_text = isset($options['qr_code_mail_text']) ? $options['qr_code_mail_text'] : '+15623526019';


        if ($qr_download_hide == 'no')
        {  $eft12 = '10'; 
            $qr_download_ = '<a id="download_' . $random_id . '" download="' . $qr_code_mail_text . '.png" class="mqrdownload" style="color:' . $qr_dwnbtn_color . ';background:' . $qr_dwnbtnbg_color . '">' .__($download_qr,'master-qr-generator')  . '</a>';

        }
        else
        {   $eft12 = '0'; 
            $qr_download_ = '';
        }
        if ($qr_print_hide == 'no')
        {
            $masteqrprint ='<a class="mqrprints"  id="printButtoncont'.$random_id.'"  style="margin-left:'.$eft12.'px;color:' . $print_clor . ';background:' . $print_background . '";>'.$qr_print_text.'</a>';
        }
        else
        {
            $masteqrprint = '';
        }

        echo '<div class="masteqr-postwarpper" id="masteqr-wrap'.$random_id.'"><div  id="masteqr-post'.$random_id.'" class="masteqr-post"  data-size="'.$qrc_size.'" data-content="https://wa.me/'.$qr_code_mail_text.'"></div><div class ="mqrbtnalign"><div style="width:'.$qrc_size.'px;display:flex;align-items: center;justify-content: center;font-size: small">' . $qr_download_ .$masteqrprint .'
                </div></div></div>';


        return ob_get_clean();

    }

    function masterqr_wifi_shortcode_atts($atts)
    {
        ob_start();
         wp_enqueue_script('easyqrcode');
        wp_enqueue_script('master_qr');       
        $options = get_option('masterqr_link_generator');
        include MASTER_QR_LITE_PATH . '/admin/extra/optionValue.php';

        $random_id = rand(10, 10000);
    $qr_code_wifi_name = isset($options['qr_code_wifi_name']) ? $options['qr_code_wifi_name'] : 'SPA';
    $qr_code_wifi_type = isset($options['qr_code_wifi_type']) ? $options['qr_code_wifi_type'] : 'WPA';
    $qr_code_wifi_password = isset($options['qr_code_wifi_password']) ? $options['qr_code_wifi_password'] : '1234';

        if ($qr_download_hide == 'no')
        {   $eft12 = '10';
            $qr_download_ = '<a id="download_' . $random_id . '" download="' . $qr_code_wifi_name . '.png" class="mqrdownload" style="color:' . $qr_dwnbtn_color . ';background:' . $qr_dwnbtnbg_color . '" >' .__($download_qr,'master-qr-generator')  . '</a>';

        }
        else
        {   $eft12 = '0';
            $qr_download_ = '';
        }
        if ($qr_print_hide == 'no')
        {
            $masteqrprint ='<a class="mqrprints" id="printwoocs'.$random_id.'"  style="margin-left:'.$eft12.'px;color:' . $print_clor . ';background:' . $print_background . '";>'.$qr_print_text.'</a>';
        }
        else
        {
            $masteqrprint = '';
        }

        echo '<div class="masteqr-postwarpper" id="masteqr-wrap'.$random_id.'"><div  id="masteqr-post'.$random_id.'" class="masteqr-post"  data-size="'.$qrc_size.'" data-content="WIFI:S:'.$qr_code_wifi_name.';T:'.$qr_code_wifi_type.';P:'.$qr_code_wifi_password.';H:true"></div><div class ="mqrbtnalign"><div style="width:'.$qrc_size.'px;display:flex;align-items: center;justify-content: center;font-size: small">' . $qr_download_ .$masteqrprint .'
                </div></div></div>';


         return ob_get_clean();

    }

    function masterqr_maps_shortcode_atts($atts)
    {
        
        ob_start();
        wp_enqueue_script('easyqrcode');
        wp_enqueue_script('master_qr');
        $options = get_option('masterqr_link_generator');

        $qr_code_maps_text = isset($options['qr_code_maps_text']) ? $options['qr_code_maps_text'] : 'Sharabindu Bakshi';
        $qr_code_lati_type = isset($options['qr_code_lati_type']) ? $options['qr_code_lati_type'] : '24.2015042';
        $qr_code_longitude = isset($options['qr_code_longitude']) ? $options['qr_code_longitude'] : '88.9968031';
        include MASTER_QR_LITE_PATH . '/admin/extra/optionValue.php';

        $random_id = rand(10, 10000);

        if ($qr_download_hide == 'no')
        {   $eft12 = '10';
            $qr_download_ = '<a id="download_' . $random_id . '" download="' . $qr_code_maps_text . '.png" class="mqrdownload" style="color:' . $qr_dwnbtn_color . ';background:' . $qr_dwnbtnbg_color . '">' .__($download_qr,'master-qr-generator')  . '</a>';

        }
        else
        {   $eft12 = '0';
            $qr_download_ = '';
        }
        if ($qr_print_hide == 'no')
        {
            $masteqrprint ='<a id="printwoocs'.$random_id.'"  class="mqrprints" style="margin-left:'.$eft12.'px;color:' . $print_clor . ';background:' . $print_background . '";>'.$qr_print_text.'</a>';
        }
        else
        {
            $masteqrprint = '';
        }

        echo '<div class="masteqr-postwarpper" id="masteqr-wrap'.$random_id.'"><div  id="masteqr-post'.$random_id.'" class="masteqr-post"  data-size="'.$qrc_size.'" data-content="geo:'.$qr_code_lati_type.','.$qr_code_longitude.'?q='.$qr_code_maps_text.'"></div><div class ="mqrbtnalign"><div style="width:'.$qrc_size.'px;display:flex;align-items: center;justify-content: center;font-size: small">' . $qr_download_ .$masteqrprint .'
                </div></div></div>';
        return ob_get_clean();

    }

    function masterqr_vcard_shortcode_atts($atts)
    {
        
        ob_start();
         wp_enqueue_script('easyqrcode');
        wp_enqueue_script('master_qr');       
        $options = get_option('masterqr_link_generator');

        $mastervcard_name = isset($options['mastervcard_name']) ? $options['mastervcard_name'] : '';
        $mastervcard_company = isset($options['mastervcard_company']) ? $options['mastervcard_company'] : '';
        $mastervcard_subtitle = isset($options['mastervcard_subtitle']) ? $options['mastervcard_subtitle'] : '';
        $mastervcard_mbunber = isset($options['mastervcard_mbunber']) ? $options['mastervcard_mbunber'] : '';
        $mastervcard_pbunber = isset($options['mastervcard_pbunber']) ? $options['mastervcard_pbunber'] : '';
        $mastervcard_email = isset($options['mastervcard_email']) ? $options['mastervcard_email'] : '';
        $mastervcard_address = isset($options['mastervcard_address']) ? $options['mastervcard_address'] : '';
        $mastervcard_note = isset($options['mastervcard_note']) ? $options['mastervcard_note'] : '';
        $mastervcard_website = isset($options['mastervcard_website']) ? $options['mastervcard_website'] : '';
        include MASTER_QR_LITE_PATH . '/admin/extra/optionValue.php';

        $random_id = rand(10, 10000);
        if ($qr_download_hide == 'no')
        {   $eft12 = '10';
            $qr_download_ = '<a id="download_' . $random_id . '" download="' . $mastervcard_name . '.png" class="mqrdownload" style="color:' . $qr_dwnbtn_color . ';background:' . $qr_dwnbtnbg_color . '">' .__($download_qr,'master-qr-generator')  . '</a>';

        }
        else
        {   $eft12 = '0';
            $qr_download_ = '';
        }
        if ($qr_print_hide == 'no')
        {
            $masteqrprint ='<a id="printwoocs'.$random_id.'"  class="mqrprints" style="margin-left:'.$eft12.'px;color:' . $print_clor . ';background:' . $print_background . '";>'.$qr_print_text.'</a>';
        }
        else
        {
            $masteqrprint = '';
        }

    $mastervcard = "BEGIN:VCARD\nVERSION:3.0\nN:".$mastervcard_name."\nORG:".$mastervcard_company."\nTITLE:".$mastervcard_subtitle."\nTEL:".$mastervcard_pbunber."\nTEL:".$mastervcard_mbunber."\nURL:".$mastervcard_website."\nEMAIL:".$mastervcard_email."\nADR:".$mastervcard_address."\nNOTE:".$mastervcard_note."\nEND:VCARD";

        echo '<div class="masteqr-postwarpper" id="masteqr-wrap'.$random_id.'"><div  id="masteqr-post'.$random_id.'" class="masteqr-post"  data-size="'.$qrc_size.'" data-content="'.$mastervcard.'"></div><div class ="mqrbtnalign"><div style="width:'.$qrc_size.'px;display:flex;align-items: center;justify-content: center;font-size: small">' . $qr_download_ .$masteqrprint .'
                </div></div></div>';
        return ob_get_clean();

    }

}
if(class_exists('MASTERLite_QR_shortcode')){

    new MASTERLite_QR_shortcode;
}
