<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://promolayer.io
 * @since      1.0.0
 *
 * @package    Promolayer
 * @subpackage Promolayer/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Promolayer
 * @subpackage Promolayer/includes
 * @author     Peakdigital <hello@peakdigital.co.jp>
 */
class Promolayer {
    private $options;
    private static $promolayer;
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Promolayer_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    public static function getInstance(){
        if(!isset(self::$promolayer)){
            self::$promolayer = new Promolayer();
        }

        return self::$promolayer;

    }

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {
        if ( defined( 'PROMOLAYER_VERSION' ) ) {
            $this->version = PROMOLAYER_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'promolayer';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();

    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Promolayer_Loader. Orchestrates the hooks of the plugin.
     * - Promolayer_i18n. Defines internationalization functionality.
     * - Promolayer_Admin. Defines all hooks for the admin area.
     * - Promolayer_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-promolayer-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-promolayer-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-promolayer-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-promolayer-public.php';

        $this->loader = new Promolayer_Loader();

    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Promolayer_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale() {

        $plugin_i18n = new Promolayer_i18n();

        $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {
        $plugin_admin = new Promolayer_Admin( $this->get_plugin_name(), $this->get_version() );
        $this->loader->add_action( 'current_screen', $this, 'enqueue_admin_assets' );
        $this->loader->add_action('admin_notices', $plugin_admin, 'show_notice' );
        $this->loader->add_action('admin_menu', $plugin_admin,'add_menu_page');
        $this->loader->add_action('plugin_action_links', $plugin_admin,'add_plugin_action_links', 10, 2);
        $this->loader->add_action('wp_ajax_promolayer_connect', $plugin_admin,'process_connection');
        $this->loader->add_action('admin_init', $plugin_admin,'check_status');
        $this->loader->add_action('wp_ajax_promolayer_is_connected', $plugin_admin,'promolayer_is_connected');
        $this->loader->add_action('wp_ajax_promolayer_disconnect', $plugin_admin,'promolayer_disconnect');
        $this->loader->add_action('admin_enqueue_scripts', $this, 'enqueue_admin_assets');
    }


    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {

        $plugin_public = new Promolayer_Public( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Promolayer_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }

    public function is_woocommerce_activated(){

        $plugin_path = trailingslashit( WP_PLUGIN_DIR ) . 'woocommerce/woocommerce.php';

        return (
            in_array( $plugin_path, wp_get_active_and_valid_plugins() )
            || ( function_exists('wp_get_active_network_plugins' ) && in_array( $plugin_path, wp_get_active_network_plugins() ))
        );
    }

    public function get_option($key){
        if(!$this->options){
            $this->options = get_option('promolayer_options');
        }

        if(isset($this->options[$key])) {
            return $this->options[$key];
        }else{
            return false;
        }
    }

    public function set_option($key,$value){
        if(!$this->options){
            $this->options = $this->get_option('promolayer_options');
        }
        $this->options[$key] = $value;

        update_option('promolayer_options',$this->options);
    }

    public function disconnect_promolayer(){
        delete_option('promolayer_options');
        update_option('promolayer_options', ['secret' => uniqid('pl_',true)]);
    }

    public function enqueue_admin_assets() {
        $screen = get_current_screen();
        if ( $screen->id === 'toplevel_page_promolayer' ) {
            wp_enqueue_style( 'promolayer_admin_css', plugin_dir_url( __FILE__ ) . 'css/promolayer-admin.css', array(), $this->version, 'all' );
            wp_enqueue_script( 'promolayer_admin_js', plugin_dir_url( __FILE__ ) . 'js/promolayer-admin.js', array( 'jquery' ), $this->version, true );
            wp_localize_script('promolayer_admin_js', 'promolayer_object',
            array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'promolayer_url' => esc_url(PROMOLAYER_URL),
                'secret' => $this->get_option('secret'),
                'nonce' => wp_create_nonce('promolayer_nonce')
            )
        );
        }
    }

    public static function clear_all_caches()
    {
        // W3 Total Cache
        if (function_exists('w3tc_pgcache_flush')) {
            w3tc_pgcache_flush();
        }

// WP Super Cache
        if (function_exists('wp_cache_clear_cache')) {
            wp_cache_clear_cache();
        }

// WP Rocket
        if (function_exists('rocket_clean_domain')) {
            rocket_clean_domain();
        }

// LiteSpeed Cache
        if (method_exists('LiteSpeed_Cache_Tags', 'add_purge_tags')) {
            LiteSpeed_Cache_Tags::add_purge_tags('*');
        }

// Comet Cache
        if (class_exists('comet_cache')) {
            comet_cache::clear();
        }

// WP-Optimize
        if (function_exists('wpo_cache_flush')) {
            wpo_cache_flush();
        }

// WP Fastest Cache
        if (class_exists('WpFastestCache')) {
            $wpfc = new WpFastestCache();
            $wpfc->deleteCache();
        }
    }

}
