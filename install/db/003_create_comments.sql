-- Migration: Create Comments Table

CREATE TABLE `comments` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`snippet_id` INT NOT NULL,
	`user_id` INT NOT NULL,
	`body` TEXT NOT NULL,
	`created` BIGINT NOT NULL,
	INDEX(`snippet_id`),
	INDEX(`user_id`),
	INDEX( `created` )
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO `maveric` (`option`,`value`) VALUES ('db_version','3')
ON DUPLICATE KEY UPDATE
value = '3';