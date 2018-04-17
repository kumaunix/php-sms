Contribution by Hans Tobias Sopu
email tobias.sopu@gmail.com
https://github.com/kumaunix/

-- Please create table for SMS table. 

--

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

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





-----------------------------------------------------

-- Please read before create the user name also
Your session usage in this system $_SESSION['id'] = id as auto_increment in the users table
$_SESSION['user'] refers to the role of the users in the system, users, admin, manager, etc.
$_SESSION['lname'] refers to the last name and $_SESSION['fname'] refers to first name of the user. If you have a different variable name please 
change the above sessions to yours inorder for the proper names of the users to display. 


CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lname` varchar(100) CHARACTER SET latin1 NOT NULL,
  `gname` varchar(100) CHARACTER SET latin1 NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(200) CHARACTER SET latin1 NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `phone` char(11) CHARACTER SET latin1 NOT NULL,
  `profile_pic` varchar(100) CHARACTER SET latin1 NOT NULL,
  `description` varchar(50) CHARACTER SET latin1 NOT NULL,
  `gender` varchar(10) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

