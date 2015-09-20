<?php

require('service-header.php');

require_once(PLUGIN_PATH . '/classes/lang.php');

$requiredFields = array(
	'englishName',
	'localName',
	'code');

verifyRequiredFields($requiredFields, $_POST);

$lang = new \CEOS\WPi10n\Language();

$lang->englishName = $_POST['englishName'];
$lang->localName = $_POST['localName'];
$lang->code = $_POST['code'];

if(!\CEOS\WPi10n\Language::exists(
	$lang->code,
	$lang->englishName,
	$lang->localName)) {

	if(!$lang->push()) {
		header('HTTP/1.1 430 Failure');
		$headers['service-status'] = 'error';
		$headers['service-details'] = 'Error pushing language to the database';
	}
} else {
	header('HTTP/1.1 430 Failure');
	$headers['service-status'] = 'error';
	$headers['service-details'] = 'Language already registered';
}

require('service-footer.php');