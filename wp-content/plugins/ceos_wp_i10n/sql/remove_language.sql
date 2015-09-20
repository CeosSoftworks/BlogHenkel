DELETE
	FROM `{PLUGIN_PREFIX}langs`
WHERE
	`lang_id` = %d OR
	`lang_code` = %s
LIMIT 1
