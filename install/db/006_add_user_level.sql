-- Add User_Level to Users table

ALTER TABLE `users` ADD `user_level` INT NOT NULL DEFAULT '1' AFTER `email` ,
ADD INDEX ( user_level );

UPDATE `users` SET `user_level` = 5 WHERE `login` = 'admin';

INSERT INTO `maveric` (`option`,`value`) VALUES ('db_version','6')
ON DUPLICATE KEY UPDATE
value = '6';