-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220225094309',	'2022-02-25 10:43:21',	111),
('DoctrineMigrations\\Version20220225123943',	'2022-02-25 13:39:57',	120);

SET NAMES utf8mb4;

CREATE TABLE `rockband` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `origine` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_year` date NOT NULL,
  `year_of_separation` date DEFAULT NULL,
  `founders` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `members` smallint(6) DEFAULT NULL,
  `musical_movement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `presentation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachement_filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2022-02-25 12:57:01
