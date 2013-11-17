-- Migration: Create Snippets Table

CREATE TABLE `snippets` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`user_id` INT NOT NULL ,
	`parent_id` INT NULL ,
	`name` VARCHAR( 255 ) NOT NULL ,
	`body` LONGTEXT NOT NULL ,
	`language` VARCHAR( 31 ) NULL,
	`created` BIGINT NOT NULL,
	INDEX ( `user_id` ),
	INDEX ( `parent_id` ),
	INDEX ( `language` ),
	INDEX ( `created` )
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO `maveric` (`option`,`value`) VALUES ('db_version','1')
ON DUPLICATE KEY UPDATE
value = '1';