<?php

/**
 * The info given by Wordpress about this plugin.
 */

$plugInfo = get_plugin_data(PLUGIN_FILE);

/**
 * A better way to pass the text domain to the translation function.
 */

$domain = $plugInfo['TextDomain'];

/**
 * Enqueue styles and scripts
 */

wp_enqueue_script('ajax-request', PLUGIN_PATH_URL.'pages/scripts/ajax-request.js');
wp_enqueue_script('main-page', PLUGIN_PATH_URL.'pages/scripts/main-page.js');
wp_enqueue_script('ceos-select', PLUGIN_PATH_URL.'pages/scripts/ceos_select.js');

wp_enqueue_style('main-page', PLUGIN_PATH_URL.'pages/styles/main-page.css');
wp_enqueue_style('ceos-select', PLUGIN_PATH_URL.'pages/styles/ceos_select.css');

?>

<script type="text/javascript">
	var nonce = "<?= wp_create_nonce(PLUGIN_PREFIX . NONCE_KEY . NONCE_SALT) ?>";
	var pluginPathURL = "<?= PLUGIN_PATH_URL ?>";
</script>

<header id="page-header">
	<span id="page-title-wrap">
		<h2><?= $plugInfo['Name'] ?></h2>
		<p id="plug-ver"><?= __('Version', $domain).' '.$plugInfo['Version'] ?></p>
	</span>
	<span id="page-header-controls" class="t-row">
		<a href="javascript:void(0)">The crew</a>
	</span>
</header>

<hr />