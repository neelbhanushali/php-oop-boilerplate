-- Adminer 4.6.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `abcd`;
CREATE TABLE `abcd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `q` varchar(2) DEFAULT NULL,
  `sq` varchar(3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `abcd` (`id`, `q`, `sq`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'1',	'iii',	'2018-02-15 19:57:42',	'2018-02-15 20:47:35',	NULL),
(2,	'1',	'ii',	'2018-02-15 19:57:42',	'2018-02-15 20:47:35',	NULL),
(3,	'1',	'i',	'2018-02-15 19:57:42',	'2018-02-15 20:47:35',	NULL),
(4,	'1',	'iv',	'2018-02-15 19:57:42',	'2018-02-15 20:47:35',	NULL);

-- 2018-02-17 11:55:59
