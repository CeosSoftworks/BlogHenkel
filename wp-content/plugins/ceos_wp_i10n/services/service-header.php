<?php

include('../../../../wp-load.php');

/**
 * A small function to check if the user provided the required fields. If not,
 * them an error is returned (430 Failure) right away.
 */

function verifyRequiredFields($requirements, $fields) {
	foreach($requirements as $fieldName) {
		if(!isset($fields[$fieldName]) || empty($fields[$fieldName])) {
			header('HTTP/1.1 430 Failure');

			header('service-status: error');
			header('service-details: One or more required fields were not provided.');
			exit;
		}
	}
}

/**
 * As we'll be using HTTP headers as a method of communication with the client,
 * we can't send any data before being sure that everything went as expected,
 * so we'll make use of ob_start() to start the output buffer.
 */

ob_start();


/**
 * This associative array holds the headers that will be sent to the client at
 * the end of the execution of the program by the script 'service-footer.php'
 * 
 * @var string[] $headers 
 * 		The headers that will be sent to the client. By default, we
 * 		have a collection of headers that indicate that everything wen't fine.
 * 		These values are bound to be changed whenever something goes wrong.
 */

$headers = array(
		'Content-Type' => 'application/json',
		'Cache-Control' => 'no-cache, no-store, must-revalidate, max-age=0',
		'service-status' => 'ok',
		'service-details' => ''
	);

/**
 * If the user is not logged in, forbids the access.
 */

if(!is_user_logged_in()) {
	header('HTTP/1.1 401 Unauthorized');

	header('service-status: unauthorized');
	header('service-details: User not logged in');
	exit;
}

/**
 * If the current user can't manage options, forbids his access as well.
 */

if(!current_user_can('manage_options')) {
	header('HTTP/1.1 403 Forbidden');

	header('service-status: forbidden');
	header('service-details: Current user can\'t manage options');
	exit;
}

/**
 * Nonce checking
 */

if(!wp_verify_nonce($_REQUEST['nonce'], PLUGIN_PREFIX . NONCE_KEY . NONCE_SALT)) {
	header('HTTP/1.1 403 Forbidden');

	header('service-status: forbidden');
	header('service-details: Invalid nonce provided');
	exit;
}