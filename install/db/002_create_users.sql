-- Migration: Create users table

CREATE TABLE `users` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`login` VARCHAR(63) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	`name` VARCHAR(255) NULL,
	`email` VARCHAR(255) NULL,
	`created` BIGINT NOT NULL,
	UNIQUE(`email`),
	UNIQUE(`login`),
	INDEX(`created`)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO `users` (`login`,`password`,`created`) VALUES
('admin','$1$Oo1.9/0.$Q0AtKu3zEGkmROgVkSXjg0',UNIX_TIMESTAMP());

INSERT INTO `maveric` (`option`,`value`) VALUES ('db_version','2')
ON DUPLICATE KEY UPDATE
value = '2';