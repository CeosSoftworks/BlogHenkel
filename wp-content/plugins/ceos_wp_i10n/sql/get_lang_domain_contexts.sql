SELECT DISTINCT `entry_context`
	FROM `{PLUGIN_PREFIX}entries`
	WHERE
		`entry_code` = %s AND
		`entry_domain` = %s AND
		`entry_context` > '' 