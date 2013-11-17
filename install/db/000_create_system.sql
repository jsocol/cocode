-- Create the maveric system table

CREATE TABLE IF NOT EXISTS `maveric` (
  `id` int(11) NOT NULL auto_increment,
  `option` varchar(255) collate utf8_unicode_ci NOT NULL,
  `value` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `option` (`option`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `maveric` (`id`, `option`, `value`) VALUES (1, 'db_version', '0');