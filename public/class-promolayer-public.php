<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://promolayer.io
 * @since      1.0.0
 *
 * @package    Promolayer
 * @subpackage Promolayer/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Promolayer
 * @subpackage Promolayer/public
 * @author     Peakdigital <hello@peakdigital.co.jp>
 */
class Promolayer_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

        $compatMode = false;
        if(in_array('wp-rocket/wp-rocket.php', apply_filters('active_plugins', get_option('active_plugins')))){
            $compatMode = true;
        }

        $promolayer = Promolayer::getInstance();
        $user_id = $promolayer->get_option('user_id');
        $pluginName = $this->plugin_name;

        // AO compatibility
        if (has_filter('autoptimize_filter_js_exclude')) {
            add_filter('autoptimize_filter_js_exclude', function ($exclude) {
                return $exclude . ", " . PROMOLAYER_SCRIPT_URL;
            });
        }

        // WP Rocket compatibility
        if (has_filter('rocket_exclude_js')) {
            add_filter('rocket_exclude_js', function ($excluded_files = []) {
                $excluded_files[] = PROMOLAYER_SCRIPT_URL;
                return $excluded_files;
            });
        }

        if (has_filter('rocket_exclude_defer_js')) {
            add_filter('rocket_exclude_defer_js', function ($excluded_files = []) {
                $excluded_files[] = PROMOLAYER_SCRIPT_URL;
                return $excluded_files;
            });
        }

        if (has_filter('rocket_delay_js_exclusions')) {
            add_filter('rocket_delay_js_exclusions', function ($excluded_files = []) {
                $excluded_files[] = PROMOLAYER_SCRIPT_URL;
                return $excluded_files;
            });
        }

        if (has_filter('rocket_minify_excluded_external_js')) {
            add_filter('rocket_minify_excluded_external_js', function ($excluded_files = []) {
                $excluded_files[] = PROMOLAYER_SCRIPT_URL;
                return $excluded_files;
            });
        }

            wp_enqueue_script($pluginName, PROMOLAYER_SCRIPT_URL, null, $this->version, false);

            add_filter('script_loader_src', function($src, $handle) use ($pluginName) {
                if ($handle === $pluginName) {
                    $src = remove_query_arg('ver', $src);
                }
                return $src;
            }, 10, 2);

            add_filter('script_loader_tag', function ($tag, $handle, $src) use ($user_id, $pluginName) {
                if ($pluginName !== $handle) {
                    return $tag;
                };
                $tag = '<script type="module" src="' . esc_url($src) . '" data-pluid="' . $user_id . '" crossorigin async></script>';
                return $tag;
            }, 100, 3);


	}

}
