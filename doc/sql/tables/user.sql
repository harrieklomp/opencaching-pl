SET NAMES 'utf8';
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL auto_increment,
  `username` varchar(60) character set utf8 collate utf8_polish_ci default NULL,
  `password` varchar(512) default NULL,
  `email` varchar(60) default NULL,
  `latitude` double default NULL,
  `longitude` double default NULL,
  `last_modified` datetime default NULL,
  `login_faults` int(11) default NULL,
  `last_login` datetime NOT NULL default '0000-00-00 00:00:00',
  `login_id` varchar(13) default NULL,
  `is_active_flag` int(11) default NULL,
  `was_loggedin` int(11) default NULL,
  `country` char(2) default NULL,
  `pmr_flag` int(11) default NULL,
  `new_pw_code` varchar(13) default NULL,
  `new_pw_date` int(11) default NULL,
  `date_created` datetime default NULL,
  `new_email_code` varchar(13) default NULL,
  `new_email_date` int(11) default NULL,
  `new_email` varchar(60) default NULL,
  `post_news` int(11) default NULL,
  `hidden_count` int(11) default '0',
  `log_notes_count` int(11) default '0',
  `founds_count` int(11) default '0',
  `notfounds_count` int(11) default '0',
  `uuid` varchar(36) default NULL,
  `cache_watches` int(11) default NULL,
  `permanent_login_flag` int(11) default NULL,
  `watchmail_mode` int(11) NOT NULL default '1',
  `watchmail_hour` int(11) NOT NULL default '0',
  `watchmail_nextmail` datetime NOT NULL default '0000-00-00 00:00:00',
  `watchmail_day` int(11) NOT NULL default '0',
  `activation_code` varchar(13) NOT NULL,
  `statpic_logo` int(11) NOT NULL default '0',
  `statpic_text` varchar(30) NOT NULL default 'Opencaching',
  `cache_ignores` int(11) default '0',
  `no_htmledit_flag` tinyint(1) NOT NULL default '0',
  `notify_radius` int(11) NOT NULL default '0',
  `admin` tinyint(1) NOT NULL default '0',
  `node` tinyint(4) NOT NULL default '0',
  `stat_ban` tinyint(1) NOT NULL default '0',
  `description` varchar(1024) default NULL,
  `rules_confirmed` int(1) NOT NULL default '0',
  `get_bulletin` tinyint(1) NOT NULL default '1',
  `ozi_filips` varchar(255) default NULL,
  `hide_flag` int(1) NOT NULL default '0',
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `email` (`email`),
  KEY `notify_radius` (`notify_radius`),
  KEY `username` (`username`),
  KEY `hidden_count` (`hidden_count`),
  KEY `founds_count` (`founds_count`),
  KEY `notfounds_count` (`notfounds_count`),
  KEY `uuid` (`uuid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;



