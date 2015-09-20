<?php

/**
 * Redirects the client to the URL he came from, adding new info to the query
 * string.
 */

if(isset($error)) {
	$query .= '&' . $error;
} else {
	$query .= '&status=success';
}

header('Location: ' . admin_url($query));

while(@ob_flush_end());