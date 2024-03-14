<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://smartclick.agency/
 * @since             1.0.0
 * @package           Smartclick_Tools
 *
 * @wordpress-plugin
 * Plugin Name:       SmartClick Tools
 * Description:       Ipsum qui consectetur reprehenderit consectetur ad pariatur et ipsum consectetur cillum minim nostrud incididunt incididunt sit esse ad sint enim consequat commodo anim mollit pariatur dolore ea exercitation.
 * Version:           1.0.0
 * Author:            SmartClick
 * Author URI:        https://https://smartclick.agency//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       smartclick-tools
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

define('SMARTCLICK_TRACKER_VERSION', '1.0.0');
define('SMARTCLICK_TRACKER_PATH', plugin_dir_path( __FILE__ ));
define('SMARTCLICK_TRACKER_URL', plugin_dir_url( __FILE__ ));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-smartclick-tracker-activator.php
 */
function activate_smartclick_tracker()
{
	require_once SMARTCLICK_TRACKER_PATH . 'includes/class-smartclick-tracker-activator.php';
	Smartclick_Tracker_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-smartclick-tracker-deactivator.php
 */
function deactivate_smartclick_tracker()
{
	require_once SMARTCLICK_TRACKER_PATH . 'includes/class-smartclick-tracker-deactivator.php';
	Smartclick_Tracker_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_smartclick_tracker');
register_deactivation_hook(__FILE__, 'deactivate_smartclick_tracker');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require SMARTCLICK_TRACKER_PATH . 'includes/class-smartclick-tracker.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

$plugin = new Smartclick_Tracker();
$plugin->run();

