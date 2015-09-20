SELECT SQL_CALC_FOUND_ROWS
	`entry_id`,
	`entry_code`,
	`entry_domain`,
	`entry_context`,
	`entry_original`,
	`entry_translation`
FROM
	`{PLUGIN_PREFIX}entries`
WHERE
	`entry_id` = %d
LIMIT 1	
