<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://sharabindu.com/plugins/master-qr-generator/
 * @since      2.0.3
 *
 * @package    masterqr
 * @subpackage masterqr/includes
 */

class Master_QR_Lite
{
    
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    2.0.3
     * @access   protected
     * @var      masterqrlite_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;
    
    /**
     * The unique identifier of this plugin.
     *
     * @since    2.0.3
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;
    
    /**
     * The current version of the plugin.
     *
     * @since    2.0.3
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;
    
    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    2.0.3
     */
    public function __construct()
    {
        if (defined('MASTER_QR_LITE_VERSION')) {
            $this->version = MASTER_QR_LITE_VERSION;
        } else {
            $this->version = '2.0.3';
        }
        $this->plugin_name = 'master-qr-lite';
        
        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
        
        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */

        
    }
    
    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - masterqrlite_Loader. Orchestrates the hooks of the plugin.
     * - masterqrlite_i18n. Defines internationalization functionality.
     * - MASTER_QR_Lite_Admin. Defines all hooks for the admin area.
     * - masterqrLite_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    2.0.3
     * @access   private
     */
    private function load_dependencies()
    {

        require_once MASTER_QR_LITE_PATH . 'admin/class_masterqr_admin_menu.php';

        require_once MASTER_QR_LITE_PATH . 'includes/class-masterqr-loader.php';
 
        require_once MASTER_QR_LITE_PATH . 'includes/class-masterqr-i18n.php';
        
        require_once MASTER_QR_LITE_PATH . 'admin/class-masterqr-admin.php';

        require_once MASTER_QR_LITE_PATH . 'public/class-masterqr-public.php';

        require_once MASTER_QR_LITE_PATH . 'admin/class_masterqr_shortcode.php';

        
        $this->loader = new masterqrlite_Loader();
   
    }
    
    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the masterqrlite_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    2.0.3
     * @access   private
     */
    private function set_locale()
    {
        
        $plugin_i18n = new masterqrlite_i18n();
        
        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
        
    }
    
    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    2.0.3
     * @access   private
     */
    private function define_admin_hooks()
    {
        
        $plugin_admin = new MASTER_QR_Lite_Admin($this->get_plugin_name(), $this->get_version());
        
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        
        $this->loader->add_filter('plugin_action_links_' . plugin_basename(dirname(__DIR__) . '/master-qr-lite.php'), $plugin_admin, 'plugin_settings_link');
        
    }
    
    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    2.0.3
     * @access   private
     */
    private function define_public_hooks()
    {
        
        $plugin_public = new masterqrLite_Public($this->get_plugin_name(), $this->get_version());
        
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
        $this->loader->add_filter('the_content', $plugin_public, 'qcr_code_element');
        $this->loader->add_action('init', $plugin_public, 'qcr_shortcode_setting');
        $this->loader->add_filter('woocommerce_product_tabs', $plugin_public, 'woo_custom_product_tabs');
    }
    
    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    2.0.3
     */
    public function run()
    {
        $this->loader->run();
    }
    
    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     2.0.3
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }
    
    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     2.0.3
     * @return    masterqrlite_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }
    
    /**
     * Retrieve the version number of the plugin.
     *
     * @since     2.0.3
     * @return    string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }
    
}
