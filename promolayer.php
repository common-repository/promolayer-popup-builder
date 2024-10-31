<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://promolayer.io
 * @since             1.0.0
 * @package           Promolayer
 *
 * @wordpress-plugin
 * Plugin Name:       Promolayer popup builder
 * Plugin URI:        https://promolayer.io
 * Description:       Pop ups, banners, slide ins and more for your website. Boost your conversion and subscription rate with beautiful displays.
 * Version:           1.1.1
 * Author:            Peakdigital
 * Author URI:        https://promolayer.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       promolayer-popup-builder
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define('PROMOLAYER_URL', 'https://app.promolayer.io');
define('PROMOLAYER_SCRIPT_URL', 'https://modules.promolayer.io/index.js');
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PROMOLAYER_VERSION', '1.1.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-promolayer-activator.php
 */
function activate_promolayer() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-promolayer-activator.php';
    Promolayer_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-promolayer-deactivator.php
 */
function deactivate_promolayer() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-promolayer-deactivator.php';
    Promolayer_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_promolayer' );
register_deactivation_hook( __FILE__, 'deactivate_promolayer' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-promolayer.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function run_promolayer() {

    $plugin = Promolayer::getInstance();
    $plugin->run();
}
run_promolayer();
