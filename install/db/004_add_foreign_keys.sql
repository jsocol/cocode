-- Migration: Add FK Constraints

ALTER TABLE `comments` ADD FOREIGN KEY (`snippet_id`)
	REFERENCES `snippets` (`id`)
	ON DELETE CASCADE
	ON UPDATE NO ACTION;

ALTER TABLE `comments` ADD FOREIGN KEY (`user_id`)
	REFERENCES `users` (`id`)
	ON DELETE RESTRICT
	ON UPDATE NO ACTION;

ALTER TABLE `snippets` ADD FOREIGN KEY (`user_id`)
	REFERENCES `users` (`id`)
	ON DELETE NO ACTION
	ON UPDATE NO ACTION;

INSERT INTO `maveric` (`option`,`value`) VALUES ('db_version','4')
ON DUPLICATE KEY UPDATE
value = '4';