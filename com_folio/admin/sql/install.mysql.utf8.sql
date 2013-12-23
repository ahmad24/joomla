

CREATE TABLE IF NOT EXISTS `#__folio` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',

    `title` varchar(150) NOT NULL COMMENT 'The unique name for the asset.\n',
    `alias` varchar(150) NOT NULL COMMENT 'The descriptive title for the asset.',
 	`catid` int(11) NOT NULL ,
	`state` tinyint(1) NOT NULL ,
	`image` varchar(255) NOT NULL,
	`company` varchar(250) NOT NULL ,
	`phone` varchar(12) NOT NULL ,
	`url` varchar(255) NOT NULL, 
	`description` TEXT, 
	`publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
  
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;