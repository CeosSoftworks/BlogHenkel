CREATE TABLE IF NOT EXISTS `{PLUGIN_PREFIX}langs` (
	`lang_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`lang_code` CHAR(5) NOT NULL,
	`lang_english_name` TINYTEXT NOT NULL,
	`lang_local_name` TINYTEXT NULL,
	`lang_status` CHAR(32) NOT NULL DEFAULT 'enabled',
	PRIMARY KEY (`lang_id`),
	INDEX `keys` (`lang_code`),
	UNIQUE INDEX `code` (`lang_code`)
) ENGINE=InnoDB;
