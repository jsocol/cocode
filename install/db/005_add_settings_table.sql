-- Migration: Add settings table

CREATE TABLE `settings` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(255) NOT NULL,
	`value` TEXT NOT NULL,
	UNIQUE(`name`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO `maveric` (`option`,`value`) VALUES ('db_version','5')
ON DUPLICATE KEY UPDATE
value = '5';