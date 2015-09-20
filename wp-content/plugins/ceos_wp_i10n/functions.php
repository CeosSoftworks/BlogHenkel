<?php
/**
 * @author Jeferson Oliveira @ CEOS Softworks
 * @version 1.0
 */

namespace CEOS\WPi10n;

function setupPages() { 
	// Main plugin page
	add_utility_page(
		'CEOS WordPress i10n',
		__('Translations', 'ceos-wp-i10n'),
		'manage_options',
		PLUGIN_PREFIX . 'main',
		'CEOS\WPi10n\Pages\mainPage',
		PLUGIN_PATH_URL . 'icon.png');
}