SELECT
	`lang_id`,
	`lang_code`,
	`lang_english_name`,
	`lang_local_name`,
	`lang_status`
FROM
	`{PLUGIN_PREFIX}langs`
WHERE
	`lang_id` = %d OR
	`lang_code` = %s
LIMIT 1
