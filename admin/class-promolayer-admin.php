<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://promolayer.io
 * @since      1.0.0
 *
 * @package    Promolayer
 * @subpackage Promolayer/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Promolayer
 * @subpackage Promolayer/admin
 * @author     Peakdigital <hello@peakdigital.co.jp>
 */
class Promolayer_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Promolayer_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Promolayer_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style( $this->plugin_name, esc_url( plugin_dir_url( __FILE__ ) ) . 'css/promolayer-admin.css', array(), $this->version, 'all' );
        wp_enqueue_style($this->plugin_name,"https://fonts.googleapis.com/css2?family=Hina+Mincho&display=swap",array(), $this->version);
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Promolayer_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Promolayer_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        $promolayer = Promolayer::getInstance();
        wp_enqueue_script( 'promolayer-admin', esc_url( plugin_dir_url( __FILE__ ) ) . 'js/promolayer-admin.js', array( 'jquery' ), $this->version, false );

    }

    public function add_menu_page(){

        add_menu_page(
            'Promolayer',
            'Promolayer',
            'manage_options',
            'promolayer',
            [$this,'add_custom_menu_page'],
            'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+Cjxzdmcgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDI1NiAyNTYiIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgeG1sbnM6c2VyaWY9Imh0dHA6Ly93d3cuc2VyaWYuY29tLyIgc3R5bGU9ImZpbGwtcnVsZTpldmVub2RkO2NsaXAtcnVsZTpldmVub2RkO3N0cm9rZS1saW5lam9pbjpyb3VuZDtzdHJva2UtbWl0ZXJsaW1pdDoyOyI+CiAgICA8ZyB0cmFuc2Zvcm09Im1hdHJpeCgwLjM5NDc3MiwwLDAsMC4zOTQ3NzEsLTc4Ljk3NzIsLTM2OC40NDYpIj4KICAgICAgICA8cGF0aCBkPSJNNzE2LjAxNSwxMTI2LjczTDc1OC45NjIsMTEwNC40OUw1NDUuNDY1LDk5Ni44OTdMNTAyLjEwNiw5OTYuODk3TDIwMC4wNTgsMTE0OC41M0w1MjQuMDg3LDEzMTEuNDZMODAzLjg3NCwxMTcwLjgxTDgwMy44NzQsMTIzMEw1MjMuMjUyLDEzNzAuNDZMMjAwLjMxNCwxMjA4Ljk5TDIwMC4zMTQsMTM1NC44M0w1MjQuMjI5LDE1MTguMjFMODQ4LjUzNCwxMzU1LjkzTDg0OC41MzQsMTMxMi4xOEw1MjQuNDExLDE0NzMuMTFMMjQzLjc4OSwxMzM0LjIzTDI0My43ODksMTI3NS44Nkw1MjMuNjkyLDE0MTMuOTRMODQ4LjQ1MiwxMjUyLjM0TDg0OC40NTIsMTE0OS44TDgwMy42MzcsMTEyNi41TDUyMy4yNjMsMTI2Ni40NUwyODcuNjk0LDExNDkuMDlMNTIzLjc1MiwxMDMxLjA1TDcxNi4wMTUsMTEyNi43M1oiIHN0eWxlPSJmaWxsOndoaXRlOyIvPgogICAgPC9nPgogICAgPGcgdHJhbnNmb3JtPSJtYXRyaXgoMC4zOTQ3NzIsMCwwLDAuMzk0NzcxLC03OC45NzcyLC0zNjguNDQ2KSI+CiAgICAgICAgPHBhdGggZD0iTTM3OC4wMjMsMTE0OC43MUw0MTkuMzE5LDExNzEuNjhMNDk0LjA4OSwxMTM0LjE5TDQ5NC4wODksMTE3Ny41MUw1NTEuNjg1LDExNzcuNTFMNTUxLjY4NSwxMTMzLjA1TDYyNS4yMTEsMTE3MC41M0w2NjkuODAzLDExNDkuMDhMNTIyLjkxOSwxMDc1LjQyTDM3OC4wMjMsMTE0OC43MVoiIHN0eWxlPSJmaWxsOndoaXRlOyIvPgogICAgPC9nPgo8L3N2Zz4K'
        );
    }

    public function add_plugin_action_links ($links, $file ) {
        if( $file == 'promolayer/promolayer.php' && function_exists( 'admin_url' ) ) {
            $settings_link = '<a href="' . admin_url( 'admin.php?page=promolayer' ) . '">' . __( 'Settings', 'promolayer-popup-builder' ) . '</a>';
            array_unshift( $links, $settings_link ); // before other links

        }
    return $links;
    }


    public function add_custom_menu_page(){

        require plugin_dir_path( __FILE__ ) . 'partials/promolayer-admin-display.php';
    }

    public function check_status(){
        $status_changed = false;
        $promolayer = Promolayer::getInstance();
        $user_id = $promolayer->get_option('user_id');
        if(!$user_id) return;
        $current_site_url = $promolayer->get_option('site_url');
        if($current_site_url !== site_url()){
            $status_changed = true;
            $promolayer->set_option('site_url', site_url());
        }

        $current_woocommerce_activated = $promolayer->get_option('woocommerce_activated');
        $woocommerce_activated =  $promolayer->is_woocommerce_activated() ? 'yes' : 'no';
        if($current_woocommerce_activated !== $woocommerce_activated){
            $status_changed = true;
            $promolayer->set_option('woocommerce_activated', $woocommerce_activated);
        }

        if($status_changed){
            $this->send_status([
                'user_id' => $user_id,
                'site_url' => site_url(),
                'woocommerce_activated' => $woocommerce_activated,
                'secret' => $promolayer->get_option('secret')
            ]);
        }

    }

    public function send_status($data){

        $url = PROMOLAYER_URL . '/api/wordpress/sync';

        return wp_remote_post( $url, array(
            'headers'     => array('Content-Type' => 'application/json; charset=utf-8'),
            'body'        => wp_json_encode($data),
            'method'      => 'POST',
            'data_format' => 'body'
        ));

    }

    public function process_connection(){
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'promolayer_nonce')) {
            wp_send_json_error('Nonce verification failed', 403);
        }

        if(!isset($_POST['secret']) || !isset($_POST['userId']))  exit('No userId or secret');
        $promolayer = Promolayer::getInstance();

        $secret = $promolayer->get_option('secret');

        if($_POST['secret'] == $secret){
            $user_id = sanitize_text_field($_POST['userId']);
            $promolayer->set_option('user_id', $user_id);
            $promolayer->set_option('site_url', site_url());
            $woocommerce_activated =  $promolayer->is_woocommerce_activated() ? 'yes' : 'no';
            $promolayer->set_option('woocommerce_activated', $woocommerce_activated);
            $promolayer->clear_all_caches();
            echo wp_json_encode(['status'=>'success']);
        }else{
            echo wp_json_encode(['status'=>'error']);
        }

        exit();
    }


    public function promolayer_is_connected() {
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'promolayer_nonce')) {
            wp_send_json_error('Nonce verification failed', 403);
        }

        $promolayer = Promolayer::getInstance();
        $user_id = $promolayer->get_option('user_id');
        echo wp_json_encode(['status'=>$user_id ? '1' : '0']);
        wp_die(); // this is required to terminate immediately and return a proper response
    }

    public function promolayer_disconnect(){
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'promolayer_nonce')) {
            wp_send_json_error('Nonce verification failed', 403);
        }

        if (current_user_can('manage_options')) {
            $promolayer = Promolayer::getInstance();
            $promolayer->disconnect_promolayer();
            echo wp_json_encode(['1']);
        } else {
            echo wp_json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
        }
        wp_die(); // this is required to terminate immediately and return a proper response
    }

    /**
     * Render the disconnected banner.
     */
    public function show_notice() {
        $promolayer = Promolayer::getInstance();
        $pl_user_id = $promolayer->get_option('user_id');
        if(!$pl_user_id){
            ?>
            <div id="promolayer-disconnected-banner" class="promolayer-banner notice notice-warning is-dismissible">
                <p>&nbsp;
                    <?php
                    echo sprintf(
                        // translators: %1$s: start link tag with URL to connect the plugin, %2$s: end link tag
                        esc_html( __( 'The Promolayer plugin isn’t connected yet. To use Promolayer on your WordPress site, %1$sconnect the plugin now%2$s.', 'promolayer-popup-builder' ) ),
                        '<a class="promolayer-banner__link" href="admin.php?page=promolayer&bannerClick=true">',
                        '</a>'
                    );
                    ?>
                </p>
            </div>
            <?php
        }
    }

}
