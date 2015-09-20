<?php
/**
 * @author Jeferson Oliveira @ CEOS Softworks
 * @version 1.0
 */

namespace CEOS\WPi10n;

class Entry {
	/**
	 * Entry unique ID in the database.
	 * @var int 
	 */
	var $id;

	/**
	 * Entry language code.
	 * @var string
	 */
	var $code;

	/**
	 * Used for grouping entries together.
	 * @var string
	 */
	var $domain;

	/**
	 * Context of the entry. Can be NULL.
	 * @var string|null
	 */
	var $context;

	/**
	 * The original value of the entry. This is the value that is passed by the
	 * user, which is used to retrieve it's translation. 
	 * @var string e.g.: "The quick red fox" or "Jumped over the dog"
	 */
	var $original;

	/**
	 * The translated version of the original entry. This is the value that is
	 * returned to the client.
	 * @var string e.g.: "Le rapide renard roux" or "Sauté par-dessus le chien"
	 */
	var $translation;

	/**
	 * Loads a entry from the database into the object.
	 *
	 * @param int ID of the entry to be loaded.
	 * @return bool TRUE in case of success. FALSE otherwise.
	 */
	public function load($id) {
		global $wpdb;

		$sql = loadSQLFile('load_entry_by_id');

		$result = $wpdb->get_row($wpdb->prepare($sql, $id));

		if($result) {
			$this->id = $result->entry_id;
			$this->code = $result->entry_code;
			$this->domain = $result->entry_domain;
			$this->context = $result->entry_context;
			$this->original = $result->entry_original;
			$this->translation = $result->entry_translation;

			return true;
		} else {
			return false;
		}
	}

	/**
	 * Inserts an entry into the database. If there already is an entry with
	 * the same language code, domain and context, the entry isn't inserted.
	 *
	 * @return int|bool The ID of the inserted entry in case of success, FALSE 
	 *		otherwise.
	 */
	public function insert() {
		global $wpdb;

		$sql = loadSQLFile('insert_entry');

		$result = $wpdb->query($wpdb->prepare($sql,
			$this->code,
			$this->domain,
			$this->context,
			$this->original,
			$this->translation));

		if($result) {
			$result = $wpdb->insert_id;
		}

		return $result;
	}

	/**
	 * Updates an entry in the database.
	 *
	 * @return bool TRUE in case of success, FALSE otherwise.
	 */
	public function update() {
		global $wpdb;

		$sql = loadSQLFile('update_entry_by_id');

		$result = $wpdb->query($wpdb->prepare($sql,
			$this->code,
			$this->domain,
			$this->context,
			$this->original,
			$this->translation,
			$this->id));

		if($result || empty($wpdb->last_error)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Entry object constructor. If an entry ID is provided, the corresponding
	 * entry information will be fetched from the database and stored into the
	 * object.
	 *
	 * @param int The ID of the entry to be load from the database.
	 */
	public function __construct($id = null) {
		if(isset($id)) {
			$this->load($id);
		}
	}

	/**
	 * Retrieves an entry from the database in a {@see Entry} object.
	 *
	 * @param string The original string to be looked over in the database.
	 * @param string The language code of the entry.
	 * @param string (optional) The domain which the entry belongs to.
	 * @param string (optional) The context which the entry has.
	 *
	 * @return Entry|bool The entry retrieved from the database. In case of
	 *		error, FALSE is returned otherwise.
	 */
	public static function get(
		$original, $langCode, $domain = null, $context = null) {
		
		global $wpdb;

		$optConditions = 
			(isset($domain) ? ' AND `entry_domain` = %s' : '') . 
			(isset($context) ? ' AND `entry_context` = %s' : '');

		$sql = loadSQLFile('get_entry');

		$sql = str_ireplace('{OPT_CONDITIONS}', $optConditions, $sql);

		/**
		 * Below we append the SQL statement returned by loadSQLFile with one
		 * or two WHERE conditions, so we get the right results in the operation
		 * below. That leave us with a scenario were we either have three or
		 * four blanks to fill with $wpdb->prepare. If $wpdb->prepare supported
		 * named or numbered arguments, we could attribute an identification to
		 * each argument passed to this function and pass them along to the
		 * prepare statement so it could do it's job. Unfortunatelly, it doesn't
		 * support that, so we have to improvise and swap the arguments values
		 * so the SQL query receives the right one.
		 *
		 * So, to summarize what we're doing below: If the context was passed
		 * but not the domain, we make the domain have the same value as the
		 * context, so the query doesn't end up looking for a null domain and
		 * ignoring the context value.
		 *
		 * PS: That a whole lot of commenting for three lines of code, isn't it?
		 */
		if(!isset($domain) && isset($context)) {
			$domain = $context;
		}

		$result = $wpdb->get_row($wpdb->prepare($sql,
			$original,
			$langCode,
			$domain,
			$context));


		if($result) {
			return new Entry($result->entry_id);
		} else {
			return false;
		}
	}

	/**
	 * Retrieves the translation of a string from the database.
	 *
	 * @param string The original string to be looked over in the database.
	 * @param string The language code of the entry.
	 * @param string (optional) The domain which the entry belongs to.
	 * @param string (optional) The context which the entry has.
	 *
	 * @return string|bool The translation of the original string. FALSE in
	 *		case of error.
	 */
	public static function translate(
		$original, $langCode, $domain = null, $context = null) {

		$obj = self::get($original, $langCode, $domain, $context);

		if($obj && !empty($obj->translation)) {
			return $obj->translation;
		} else {
			return $original;
		}	
	}

	/**
	 * Verifies if an entry with the given attributes exists in the database.
	 *
	 * @param string The original string to be looked over in the database.
	 * @param string The language code of the entry.
	 * @param string (optional) The domain which the entry belongs to.
	 * @param string (optional) The context which the entry has.
	 *
	 * @return bool TRUE in case there is an entry with the given attributes.
	 *		FALSE otherwise.
	 */
	public static function exists(
		$original, $langCode, $domain = null, $context = null) {

		$obj = self::get($original, $langCode, $domain, $context);

		return (!$obj ? false : true);
	}

	/**
	 * Removes an entry from the database.
	 *
	 * @param int ID of the entry to be removed.
	 * @return bool TRUE in case of success, FALSE otherwise.
	 */
	public static function remove($id) {
		global $wpdb;

		$sql = loadSQLFile('delete_entry');

		return $wpdb->query($wpdb->prepare($sql, $id));
	}

	/**
	 * Retrieves all entries from the database. The arguments that can be given
	 * to this function limit the entries returned from the database. If no
	 * arguments are given, all entries are returned.
	 *
	 * @param string (optional) The language code that the entries must have to
	 * 		be returned. If an empty value is given, this parameter is ignored.
	 * @param string (optional) The domain which the entries must belong to be
	 * 		returned. if an empty value is given, this parameter is ignored.
	 * @param string (optional) The context which the entries must have to be
	 * 		returned. if an empty value is given, this parameter is ignored.
	 *
	 * @return Entry[]|bool An array with all the entries found in the database.
	 *		FALSE in case of error.
	 */
	public static function all(
		$langCode = null, $domain = null, $context = null) {

		global $wpdb;

		/**
		 * Below we build the conditions to limit which entries to acquire from
		 * the database. Since Wordpress' $wpdb->prepare doesn't support named
		 * nor numeric arguments and we have more than two optional conditions,
		 * we have to order the arguments according to the query we built.
		 */

		$optConditions = '';
		$optOrder = array();

		if(isset($langCode)) {
			$optConditions .= ' AND `entry_code` = %s';
			array_push($optOrder, $langCode);
		}
		if(isset($domain)) {
			$optConditions .= ' AND `entry_domain` = %s';
			array_push($optOrder, $domain);
		}
		if(isset($context)) {
			$optConditions .= ' AND `entry_context` = %s';
			array_push($optOrder, $context);
		}

		$sql = loadSQLFile('all_entries');
		$sql = str_ireplace('{OPT_CONDITIONS}', $optConditions, $sql);

		$results = $wpdb->get_results($wpdb->prepare($sql,
			@$optOrder[0],
			@$optOrder[1],
			@$optOrder[2]));

		var_dump($results);

		if($results) {
			$entries = array();

			foreach($results as $result) {
				$entry = new Entry($result->entry_id);
				array_push($entries, $entry);
			}

			return $entries;
		} else {
			return false;
		}
	}
}