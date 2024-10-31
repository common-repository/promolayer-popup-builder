<?php

/**
 * Fired during plugin activation
 *
 * @link       https://promolayer.io
 * @since      1.0.0
 *
 * @package    Promolayer
 * @subpackage Promolayer/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Promolayer
 * @subpackage Promolayer/includes
 * @author     Peakdigital <hello@peakdigital.co.jp>
 */


class Promolayer_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        $promolayer_options = get_option('promolayer_options');

        if(empty($promolayer_options) || empty($promolayer_options['secret'])){
            update_option('promolayer_options', ['secret' => uniqid('pl_',true)]);
        } else {
            Promolayer::clear_all_caches();
        }
	}
}
