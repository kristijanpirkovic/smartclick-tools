<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://smartclick.agency/
 * @since      1.0.0
 *
 * @package    Smartclick_Tracker
 * @subpackage Smartclick_Tracker/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Smartclick_Tracker
 * @subpackage Smartclick_Tracker/admin
 * @author     SmartClick <contact@smartclick.mk>
 */
class Smartclick_Tracker_Admin
{

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
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'assets/admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'assets/admin.js', array(), $this->version, false);
	}

	/**
	 * Register Settings Page
	 *
	 * @since    1.0.0
	 */
	public function create_settings()
	{
		add_menu_page(
			'SmartClick Tools', // Page Title
			'SmartClick Tools', // Menu Title
			'manage_options', // Capability
			'smartclick-tools', // Menu Slug
			[$this, 'render_settings'], // Callback Function
			'dashicons-admin-smartclick', // Icon URL or CSS Class
		);
	}

	public function render_settings() {
		include_once(SMARTCLICK_TRACKER_PATH . 'admin/partials/smartclick-tracker-admin-display.php');
	}
}
