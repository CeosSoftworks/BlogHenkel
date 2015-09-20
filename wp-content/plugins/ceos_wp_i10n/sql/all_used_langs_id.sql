SELECT DISTINCT
	`lang_id`
FROM `{PLUGIN_PREFIX}entries`
LEFT JOIN `{PLUGIN_PREFIX}langs` ON `lang_code` = `entry_code`
