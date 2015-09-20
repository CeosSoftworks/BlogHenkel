<?php
/**
 * @author Jeferson Oliveira @ CEOS Softworks
 * @version 1.0
 */

namespace CEOS\WPi10n;

/**
 * Name of the folder that holds the SQL files used by this plugin.
 */

define('SQL_FOLDER', 'sql');

/**
 * Reads a SQL file from the SQL_FOLDER. This function replaces any occurence of
 * {PLUGIN_PREFIX} with the value defined in the constant PLUGIN_PREFIX.
 *
 * @return string|boolean The contents of the SQL files or FALSE in case of
 *		error
 */

function loadSQLFile($fileName) {
	$filePath = PLUGIN_PATH . SQL_FOLDER . "/{$fileName}.sql";
	$fileHandle = fopen($filePath, 'r');

	if($fileHandle) {
		$content = fread($fileHandle, filesize($filePath));
		$content = preg_replace('/\{PLUGIN_PREFIX\}/', PLUGIN_PREFIX, $content);
	} else {
		$content = false;
	}

	return $content;
}

/**
 * Tries to create the tables needed for proper functioning of the plugin if
 * they don't exist already.
 *
 * @return boolean TRUE if it succeeds, FALSE otherwise.
 */

function setupTables() {
	global $wpdb;

	$sqlLangs = loadSQLFile('create_langs_table');
	$sqlEntries = loadSQLFile('create_entries_table');

	$resultLangs = $wpdb->query($sqlLangs);
	$resultEntries = $wpdb->query($sqlEntries);

	return ($resultLangs && $resultEntries);
}