SELECT COUNT(1)
	FROM `{PLUGIN_PREFIX}langs`
	WHERE
		`lang_code` = TRIM(%s) OR
		`lang_english_name` = TRIM(%s) OR
		`lang_local_name` = TRIM(%s)
	LIMIT 1