UPDATE `{PLUGIN_PREFIX}entries` SET
	`entry_code` = %s,
	`entry_domain` = %s,
	`entry_context` = %s,
	`entry_original` = %s,
	`entry_translation` = %s
WHERE
	`entry_id` = %d
LIMIT 1
