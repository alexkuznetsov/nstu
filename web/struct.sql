 CREATE TABLE `blog_comments` (
  `id` int(12) NOT NULL auto_increment,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `name` varchar(100) NOT NULL default '',
  `text` text NOT NULL,
  `post_id` int(12) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `date` (`date`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

 CREATE TABLE `blog_post` (
  `id` int(12) NOT NULL auto_increment,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `title` varchar(100) NOT NULL default '',
  `text` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `date` (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `blog_views` (
  `id` int(12) NOT NULL auto_increment,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;