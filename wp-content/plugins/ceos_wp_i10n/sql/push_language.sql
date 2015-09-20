INSERT INTO `{PLUGIN_PREFIX}langs` SET
	`lang_id` = %d,
	`lang_code` = TRIM(%s),
	`lang_english_name` = TRIM(%s),
	`lang_local_name` = TRIM(%s),
	`lang_status` = TRIM(%s)
ON DUPLICATE KEY UPDATE
	`lang_code` = TRIM(%s),
	`lang_english_name` = TRIM(%s),
	`lang_local_name` = TRIM(%s),
	`lang_status` = TRIM(%s);
