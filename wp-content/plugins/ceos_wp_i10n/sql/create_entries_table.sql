CREATE TABLE IF NOT EXISTS `{PLUGIN_PREFIX}entries` (
	`entry_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`entry_code` CHAR(5) NOT NULL,
	`entry_domain` VARCHAR(128) NULL DEFAULT NULL,
	`entry_context` VARCHAR(128) NULL DEFAULT NULL,
	`entry_original` MEDIUMTEXT NOT NULL,
	`entry_translation` MEDIUMTEXT NOT NULL,
	PRIMARY KEY (`entry_id`),
	INDEX `keys` (`entry_code`, `entry_domain`, `entry_context`)
) ENGINE=InnoDB;
