DROP TABLE IF EXISTS `nodelogipchange`;
CREATE TABLE `nodelogipchange` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `ipaddr_pub` INT(16) UNSIGNED NOT NULL,
  `ipaddr_pub_new` INT(16) UNSIGNED NOT NULL,
  `moddate` INT(11) NOT NULL,
  `ownerid` INT(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
