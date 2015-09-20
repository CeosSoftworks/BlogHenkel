<?php
/**
 * @author Jeferson Oliveira @ CEOS Softworks <contato@ceossoftworks.com.br>
 * @version 1.0
 */
/*
Plugin Name: 	CEOS Softworks Wordpress i10n
Plugin URI: 	http://www.ceossoftworks.com.br/products/wp-i10n
Author: 		CEOS Softworks
Author URI: 	http://www.ceossoftworks.com.br/
Version: 		1.0.0.0
License: 		Copyright© 2015, CEOS Softworks. Licensed under the Apache License, Version 2.0.
License URI:	http://apache.org/licenses/LICENSE-2.0.txt
Text Domain: 	ceos-wp-i10n
Description: 	CEOS Softworks Wordpress i10n tries to make the act of translating a website a easier task.
*/

//------------------------------------------------------------------------------

namespace CEOS\WPi10n;

error_reporting(-1);
ini_set('display_errors', 'On');

/**
 * The absolute filepath of the plugin.
 */

define('PLUGIN_FILE', __FILE__);

/**
 * The complete path to the directory of this plugin.
 */

define('PLUGIN_PATH', plugin_dir_path(__FILE__));

/**
 * The URL of the plugin folder
 */

define('PLUGIN_PATH_URL', plugin_dir_url(__FILE__));

/**
 * Value used as signature to distinguish options, tables and other sorts of
 * things created and used by this plugin.
 *
 * This value is prefixed before the name of all tables created by this plugin.
 * We encourage you to not change it as it might lead to incompatibilities or
 * other sort of "funny" problems (the change of a serious problem occuring due
 * to that is actually preeeeety small, but we encourage you to not temper with
 * this constant anyway).
 */

define('PLUGIN_PREFIX', 'ceos_wp_i10n_');

/**
 * The default language option name (the value is stored within the Wordpress
 * options table, generally named 'wp_options').
 */

define('OPT_DEF_LANG', PLUGIN_PREFIX . 'def_lang');

/**
 * Name of the cookie that will hold the client language code.
 */

define('COOKIE_CLIENT_LANG', PLUGIN_PREFIX . 'usr_lang');

/**
 * How long the client language cookie will last.
 */

define('COOKIE_CLIENT_LANG_TIME', (60 * 525949));

/**
 * Scripts acquirement
 */

require_once('functions.php');
require_once('database_functions.php');

/**
 * Classes acquirement
 */

require_once('classes/lang.php');
require_once('classes/entry.php');

/**
 * Pages acquirement
 */

require_once('pages/main.php');

/**
 * Register the function responsible for setting up the plugin tables to be run
 * whenever the user activates the plugin.
 *
 * It was considered invoking this function everytime Wordpress was initialized,
 * but for some reason (maybe the server had low resources available) this
 * approached ended up conflicting with the filtering of 'gettext', taking too
 * long to complete on a Windows environment and the server always ended up
 * resetting the connection. For that reason, it's recommended to not try to 
 * invoke this function anywhere else other than during the activation of the
 * plugin, at least if you intend to use this plugin on a Windows server.
 */

register_activation_hook(PLUGIN_FILE, 'CEOS\WPi10n\setupTables');

/**
 * Setup the pages, so they are shown in the administration panel.
 */

add_action('admin_menu', 'CEOS\WPi10n\setupPages');

/**
 * Intercepts Wordpress' "gettext" data and recovers the appropriate translation
 * from the database.
 */

function filterWPi10n($transText, $untransText = null, $domain = null) {
	$langCookie = Language::clientLang();
	$langDefault = Language::defaultLanguage();

	if(!empty($langCookie)) {
		$langCode = $langCookie;
	} else if(!empty($langDefault)) {
		$langCode = $langDefault;
	} else {
		return $transText;
	}

	return Entry::translate(
		$transText, Language::defaultLanguage(), $domain);
}

add_filter('gettext', 'CEOS\WPi10n\filterWPi10n', 1);

/**
 * Intercepts Wordpress' "gettext_with_context" data and recovers the
 * appropriate translation from the database.
 */

function filterWPi10nWithContext(
	$transText, $untransText = null, $context = null, $domain = null) {

	$langCookie = Language::clientLang();
	$langDefault = Language::defaultLanguage();

	if(!empty($langCookie)) {
		$langCode = $langCookie;
	} else if(!empty($langDefault)) {
		$langCode = $langDefault;
	} else {
		return $transText;
	}

	return Entry::translate(
		$transText, Language::defaultLanguage(), $domain, $context);
}

add_filter('gettext_with_context', 'CEOS\WPi10n\filterWPi10nWithContext', 1);

/**
 * Verifies if a cookie holding the user prefered language was set. If it
 * wasn't, then it creates a cookie with the predominant language provided by
 * the user's browser. In case the browser didn't provide such information,
 * nothing is done.
 */

function setupClientDefaultLanguage() {
	$dominant = Language::getClientPredominantLanguage();

	if(!isset($_COOKIE[COOKIE_CLIENT_LANG]) && $dominant) {
		setcookie(
			COOKIE_CLIENT_LANG, 
			$dominant, 
			time() + COOKIE_CLIENT_LANG_TIME);
	}
}

add_action('init', 'CEOS\WPi10n\setupClientDefaultLanguage');