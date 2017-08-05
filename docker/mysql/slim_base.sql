CREATE DATABASE `slim_base` !40100 DEFAULT CHARACTER SET utf8;

USE `slim_base`;
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` char(128) NOT NULL, /*SHA512 size, hexa encoding*/
  `salt` char(64) NOT NULL, /*256bit length, hexa encoding*/
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

