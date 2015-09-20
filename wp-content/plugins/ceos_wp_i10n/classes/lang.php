<?php
/**
 * @author Jeferson Oliveira @ CEOS Softworks
 * @version 1.0
 */

namespace CEOS\WPi10n;

class Language {
	/**
	 * Language ID in the database.
	 * @var int Example: 1
	 */

	var $id;

	/**
	 * The code of the language.
	 * @var string Example: fr
	 */

	var $code;
	
	/**
	 * The english name of the language.
	 * @var string Example: French
	 */

	var $englishName;
	
	/**
	 * The local name of the language.
	 * @var string Example: Français
	 */

	var $localName;

	/**
	 * The status of the language. A language can have a status of 'disabled',
	 * 'enabled' or 'draft'. Disabled and enabled statuses are pretty straight
	 * forward, no explanations needed. A language with 'draft' status,
	 * otherwise indicates a language that is unavailable to everyone other than
	 * admins. This functionality is intended to allow admins to test
	 * translations they might be working on.
	 * @var string Example: 'draft'
	 */

	var $status;

	/**
	 * Loads a language information from the database into the object.
	 *
	 * @param int|string The ID (int) or the code (string) of the language to
	 *		load into the object.
	 * @return bool TRUE if the language information was loaded.
	 *		FALSE otherwise.
	 */

	public function load($id) {
		global $wpdb;

		$sql = loadSQLFile('load_language_by_id');

		$row = $wpdb->get_row($wpdb->prepare($sql, $id, $id));

		if($row) {
			$this->id = $row->lang_id;
			$this->code = $row->lang_code;
			$this->englishName = $row->lang_english_name;
			$this->localName = $row->lang_local_name;
			$this->status = $row->lang_status;

			$result = true;
		} else {
			$result = false;
		}

		return $result;
	}

	/**
	 * Pushes the information within the object into the database. If this
	 * language has no ID or the ID isn't being used in the database, the
	 * language information will be inserted in the database. Otherwise,
	 * if there already is a language in the database with the same ID as this
	 * object's, the language in the database will have its data updated.
	 *
	 * @return bool TRUE if the language was pushed successfully into the 
	 *		database. FALSE otherwise.
	 */

	public function push() {
		global $wpdb;

		$sql = loadSQLFile('push_language');

		$result = $wpdb->query(
			$wpdb->prepare($sql,
				$this->id,
				$this->code,
				$this->englishName,
				$this->localName,
				$this->status,

				$this->code,
				$this->englishName,
				$this->localName,
				$this->status));

		if($result || empty($wpdb->last_error)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Language object constructor. If a language ID or language code is
	 * provided, the corresponding language information will be fetched from
	 * the database and stored into the object.
	 *
	 * @param int|string The ID (int) or the code (string) of the language to
	 *		load into the object.
	 */

	public function __construct($id = null) {
		if(isset($id)) {
			$this->load($id);
		}
	}

	/**
	 * Removes a language from the database.
	 *
	 * @param int The ID (int) or the code (string) of the language to
	 *		remove from the database.
	 */

	public static function remove($id) {
		global $wpdb;

		$sql = loadSQLFile('remove_language');

		return $wpdb->query($wpdb->prepare($sql, $id, $id));
	}

	/**
	 * Retrieves all languages available in the database.
	 *
	 * @return Language[] Array with all the languages available in the database
	 *		represented with {@see Language} object.
	 */

	public static function all() {
		global $wpdb;

		$sql = loadSQLFile('all_langs_id');

		$queryResults = $wpdb->get_results($sql);

		if(is_array($queryResults) && sizeof($queryResults) > 0) {
			$results = array();

			foreach($queryResults as $dbLang) {
				$lang = new Language($dbLang->lang_id);
				array_push($results, $lang);
			}
			
			return $results;
		} else {
			return false;
		}
	}

	/**
	 * Retrieves all languages that have at least one entry in the database.
	 *
	 * @return Language[] Array with the languages that have at least an entry.
	 */

	public static function allUsed() {
		global $wpdb;

		$sql = loadSQLFile('all_used_langs_id');

		$queryResults = $wpdb->get_results($sql);

		if(is_array($queryResults) && sizeof($queryResults) > 0) {
			$results = array();

			foreach ($queryResults as $queryResult) {
				array_push($results, new Language($queryResult->lang_id));
			}

			return $results;
		} else {
			return false;
		}
	}

	/**
	 * Retrieves the domains of a given language.
	 *
	 * @param string $langCode Language code from which to acquire the domains
	 *		in use.
	 * @return string[] Names of the domains beloging to the language given.
	 */

	public static function langDomains($langCode) {
		global $wpdb;

		$sql = loadSQLFile('get_lang_domains');

		$queryResults = $wpdb->get_results(
			$wpdb->prepare($sql, $langCode));

		if(is_array($queryResults) && sizeof($queryResults) > 0) {
			$results = array();

			foreach ($queryResults as $queryResult) {
				array_push($results, $queryResult->entry_domain);
			}

			return $results;
		}
	}

	/**
	 * Retrieves the contexts of a given language domain.
	 *
	 * @param string $langCode The language code from which the given domains
	 *		belongs to.
	 * @param string $domain The domain name from which to retrieve the
	 *		contexts in use.
	 * @return string[] Contexts of the language domain given.
	 */

	public static function langDomainContexts($langCode, $domain) {
		global $wpdb;

		$sql = loadSQLFile('get_lang_domain_contexts');

		$queryResults = $wpdb->get_results(
			$wpdb->prepare($sql, $langCode, $domain));

		if(is_array($queryResults) && sizeof($queryResults) > 0) {
			$results = array();

			foreach ($queryResults as $queryResult) {
				array_push($results, $queryResult->entry_context);
			}

			return $results;
		}
	}

	/**
	 * Checks if the site already has a default language set. If it does, than
	 * this value is returned. If not, this procedure tries to set the default
	 * language as the same used by Wordpress.
	 *
	 * @return string|bool Returns the code of default language of the website.
	 *		If an error occur during the process of setting up a new default
	 *		language, then FALSE will be returned.
	 */

	public static function setupDefaultLanguage() {
		$defLang = get_option(OPT_DEF_LANG);
		$wpDefLang = get_locale();

		/**
		 * Convert the locale format used by Wordpress to the format used by
		 * the plugin.
		 */
		$wpDefLang = strtolower(str_ireplace('_', '-', $wpDefLang));

		if(!$defLang) {
			if(add_option(OPT_DEF_LANG, $wpDefLang)) {
				return $wpDefLang;
			} else {
				return false;
			}
		} else {
			return $defLang;
		}
	}

	/**
	 * Retrieves the default language of the website.
	 *
	 * @return string The language code of the default language of the website.
	 */

	public static function defaultLanguage($langCode = null) {
		if(isset($langCode)) {
			update_option(OPT_DEF_LANG, $langCode);
		}
		return Language::setupDefaultLanguage(OPT_DEF_LANG);
	}

	/**
	 * Retrieves the client predominant language.
	 *
	 * @return string|bool The language code for the predominant client
	 *		language. If such information wasn't supplied by the client, then
	 *		FALSE is returned.
	 */

	public static function getClientPredominantLanguage() {
		$clientLangs = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		if($clientLangs) {
			return strtolower(substr($clientLangs, 0, strpos($clientLangs, ',')));
		} else {
			return false;
		}
	}

	/**
	 * Sets and/or retrieves the users prefered language. If language code is
	 * provided, that code will be the new prefered language of the user.
	 *
	 * @param string $langCode Language code to be set as the new prefered.
	 * @return string Prefered language of the user. 
	 */
	public static function clientLang($langCode = null) {
		if(isset($langCode)) {
			setcookie(
				COOKIE_CLIENT_LANG, 
				$langCode, 
				time() + COOKIE_CLIENT_LANG_TIME);
		}

		return @$_COOKIE[COOKIE_CLIENT_LANG];
	}

	/**
	 * Verifies if the given language already exists in the database.
	 * 
	 * Such verification is done by checking if either the short code,
	 * english name or local name are already present in the database. If any
	 * are already present, this procedure considers the given language
	 * to be already registered.
	 *
	 * @param string $shortCode Short code to look for in the database.
	 * @param string $englishName English name of the language to look for in
	 * the database.
	 * @param string $localName Local name of the language to look for in the
	 * database;
	 *
	 * @return bool|int TRUE is any of the parameters given exist in the
	 * database, FALSE otherwise or -1 if an error occured during the
	 * verification. 
	 */
	
	public static function exists($shortCode, $englishName, $localName) {
		global $wpdb;
		
		$sql = loadSQLFile('lang_exists');

		print $sql;
	}
}