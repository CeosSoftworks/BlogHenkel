SELECT
	`entry_id`
FROM `{PLUGIN_PREFIX}entries`
WHERE
	`entry_original` = %s
	AND `entry_code` = %s
	{OPT_CONDITIONS}
ORDER BY `entry_id` ASC
LIMIT 1
