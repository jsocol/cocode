-- Migration: Add user profile field. 

ALTER TABLE `users` ADD `profile` TEXT NULL AFTER `email`;

INSERT INTO `maveric` (`option`,`value`) VALUES ('db_version','7')
ON DUPLICATE KEY UPDATE
value = '7';