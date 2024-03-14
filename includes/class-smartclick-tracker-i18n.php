<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://https://smartclick.agency/
 * @since      1.0.0
 *
 * @package    Smartclick_Tracker
 * @subpackage Smartclick_Tracker/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Smartclick_Tracker
 * @subpackage Smartclick_Tracker/includes
 * @author     SmartClick <contact@smartclick.mk>
 */
class Smartclick_Tracker_i18n
{


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain()
	{

		load_plugin_textdomain(
			'smartclick-tracker',
			false,
			dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
		);

	}
}
