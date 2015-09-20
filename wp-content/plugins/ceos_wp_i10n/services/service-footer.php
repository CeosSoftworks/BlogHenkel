<?php

/**
 * Declare the headers held in the $headers scalar, so they
 * are actually sent to the client.
 */

foreach($headers as $header => $value) {
	header("{$header}: {$value}");
}

/**
 * Flush and destroy all output buffers.
 */

while(@ob_end_flush());