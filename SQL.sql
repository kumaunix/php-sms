

CREATE TABLE IF NOT EXISTS `sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(255) DEFAULT NULL,
  `receiver` varchar(255) DEFAULT NULL,
  `conv_id` varchar(100) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `file` varchar(250) NOT NULL,
  `time` datetime DEFAULT NULL,
  `view` varchar(255) DEFAULT NULL,
  `view_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;



CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lname` varchar(100) CHARACTER SET latin1 NOT NULL,
  `gname` varchar(100) CHARACTER SET latin1 NOT NULL,
  `location` varchar(200) NOT NULL,
  `wife` int(2) NOT NULL,
  `children` int(2) NOT NULL,
  `payrate` int(50) NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(200) CHARACTER SET latin1 NOT NULL,
  `attempt` int(3) NOT NULL,
  `lockout` int(11) NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `phone` char(11) CHARACTER SET latin1 NOT NULL,
  `profile_pic` varchar(100) CHARACTER SET latin1 NOT NULL,
  `description` varchar(50) CHARACTER SET latin1 NOT NULL,
  `gender` varchar(10) CHARACTER SET latin1 NOT NULL,
  `pw` varchar(200) NOT NULL,
  `status` int(4) NOT NULL,
  `in_or_out` int(4) NOT NULL DEFAULT '0',
  `punchin` datetime NOT NULL,
  `status_today` varchar(100) NOT NULL,
  `request_vacation` date NOT NULL,
  `request_vacation1` date NOT NULL,
  `request_vacation2` date NOT NULL,
  `sick_day_available` int(10) NOT NULL,
  `sick_day_used` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;
