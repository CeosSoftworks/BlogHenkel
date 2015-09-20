<?php

require('header.php');

header('Content-type: Text/plain');

/**
 * This scripts is ment for pushing a slider into the database. So it only
 * accept POST requests.
 */

if($_SERVER['REQUEST_METHOD'] != 'POST') {
	$error = 'status=invalid_method';
	require('footer.php');
	exit;
}

/**
 * Nonce verification
 */

$nonceAction = \CEOS\Slider\PLUGIN_PREFIX . '_remove_' . $_POST['id'] . get_current_user_id();

if(!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], $nonceAction)) {
	$error = 'status=invalid_verification';
	require('footer.php');
	exit;
}

if(!isset($_POST['id']) 
	|| !\CEOS\Slider\Slider::removeFromDatabase($_POST['id'])) {
	$error = 'status=remove_error';
	require('footer.php');
	exit;
}

require('footer.php');