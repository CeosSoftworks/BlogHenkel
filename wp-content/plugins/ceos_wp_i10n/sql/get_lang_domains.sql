SELECT DISTINCT `entry_domain`
	FROM `{PLUGIN_PREFIX}entries`
	WHERE
		`entry_code` = %s AND
		`entry_domain` > '' 