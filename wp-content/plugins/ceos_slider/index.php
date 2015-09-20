<?php
/**
 * Plugin Name: CEOS Slider
 * Plugin URI: http://www.ceossoftworks.com.br/products/wordpress_slider
 * Version: 1.0
 * Description: Description yet to come.
 * Author: CEOS Softworks
 * Author URI: http://www.ceossoftworks.com.br
 * License: Copyright© 2015, CEOS Softworks. Licensed under the Apache License, Version 2.0.
 * License URI: http://www.apache.org/licenses/LICENSE-2.0
 * Text Domain: ceos_slider
 */

namespace CEOS\Slider;

error_reporting(-1);
ini_set('display_errors', 'On');

/**
 * Deny direct access to the plugin file.
 */

defined('ABSPATH') or die ('This is not for you. It never was for you.');

/**
 * For internationalization purposes.
 */

load_plugin_textdomain('ceos_slider');

/**
 * Prefix used to identify tables and other elements belonging to this plugin.
 */

define(__NAMESPACE__.'\PLUGIN_PREFIX', 'ceos_slider_');

/**
 * Provides access to the main plugin filepath to other scripts within
 * the namespace.
 */

define(__NAMESPACE__.'\PLUGIN_FILE', __FILE__);

/**
 * Provides access to the path of the plugin directory to other scripts within
 * the namespace.
 */

define(__NAMESPACE__.'\PLUGIN_PATH', plugin_dir_path(__FILE__));

/**
 * Provides access to the URL of the plugin directory to other scripts within
 * the namespace.
 */

define(__NAMESPACE__.'\PLUGIN_PATH_URL', plugin_dir_url(__FILE__));

/**
 * A few essential functions.
 */

require_once('functions.php');

/**
 * Plugin pages
 */

require_once('pages/menu_page.php');
require_once('pages/create_slider.php');

/**
 * Classes
 */

require_once('classes/slider.php');
require_once('classes/slider_item.php');
require_once('classes/slider_print.php');

/**
 * Creates the plugin table during the plugin activation process.
 */

register_activation_hook(\CEOS\Slider\PLUGIN_FILE, '\CEOS\Slider\createTables');

/**
 * Sets up the plugin pages along with the admin menu.
 */

add_action('admin_menu', 'CEOS\Slider\setupPages');