--
-- phpMyAdmin v.3.5.8 SQL Dump
-- http://www.phpmyadmin.net
-- Optimized by https://zooku.ro for Cloud Hosting
--
-- Generation Time: Feb 09, 2016 at 01:36 AM
-- Server name: Zooku_DB31_Server
-- Server version: 5.1.50-rel11.4-log
--

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `adry_ro_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `ph2_characters`
--
-- Creation: Nov 06, 2015 at 03:56 PM
--

DROP TABLE IF EXISTS `ph2_characters`;
CREATE TABLE IF NOT EXISTS `ph2_characters` (
  `ch_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`ch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ph2_characters`
--

INSERT INTO `ph2_characters` (`ch_id`, `image`) VALUES
(1, 'character1.png'),
(2, 'character2.png'),
(3, 'character3.png'),
(4, 'character4.png'),
(5, 'character5.png');

-- --------------------------------------------------------

--
-- Table structure for table `ph2_games`
--
-- Creation: Nov 06, 2015 at 03:56 PM
--

DROP TABLE IF EXISTS `ph2_games`;
CREATE TABLE IF NOT EXISTS `ph2_games` (
  `game_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `pass` varchar(32) DEFAULT NULL,
  `started` enum('1','0') NOT NULL DEFAULT '0',
  `started_date` datetime DEFAULT NULL,
  PRIMARY KEY (`game_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `ph2_games`
--

INSERT INTO `ph2_games` (`game_id`, `name`, `pass`, `started`, `started_date`) VALUES
(1, 'Lost - The Adventure', NULL, '0', NULL),
(2, 'Family four', '6969', '0', NULL),
(3, 'Family four', '4984', '1', '2015-06-30 20:40:20'),
(4, 'Family four', '8306', '0', NULL),
(5, 'Family four', '2787', '1', '2015-10-20 22:39:44'),
(6, 'Family four', '2346', '1', '2015-10-21 00:19:22'),
(7, 'Family four', '9765', '1', '2015-10-21 02:32:24'),
(8, 'Family four', '1782', '1', '2015-10-21 16:09:37'),
(9, 'Family four', '2889', '1', '2015-10-21 19:04:45'),
(10, 'Family four', '8861', '1', '2015-10-21 21:17:55'),
(11, 'Family four', '3919', '1', '2015-10-25 18:13:14'),
(12, 'Family four', '7225', '1', '2015-10-25 21:22:24'),
(13, 'Family four', '5196', '1', '2015-10-25 21:33:23'),
(14, 'Family four', '6882', '0', NULL),
(15, 'Family four', '9739', '1', '2015-10-25 21:36:34'),
(16, 'Family four', '7148', '1', '2015-10-25 22:30:38'),
(17, 'Family four', '9092', '1', '2015-10-25 22:34:03'),
(18, 'Family four', '9951', '1', '2015-10-25 22:45:37'),
(19, 'Family four', '4076', '1', '2015-10-26 00:44:35'),
(20, 'Family four', '2023', '1', '2015-10-26 14:25:11'),
(21, 'Family four', '4505', '1', '2015-10-26 16:37:26'),
(22, 'Family four', '5568', '1', '2015-10-26 19:30:35'),
(23, 'Family four', '2950', '1', '2015-10-26 23:42:39'),
(24, 'Family four', '1821', '1', '2015-10-26 23:46:03'),
(25, 'Family four', '7273', '1', '2015-10-27 01:18:46'),
(26, 'Family four', '2979', '1', '2015-10-27 01:27:46'),
(27, 'Family four', '1588', '1', '2015-10-27 14:21:26'),
(28, 'Family four', '6573', '1', '2015-10-27 14:25:34'),
(29, 'Family four', '6376', '1', '2015-10-27 16:37:16'),
(30, 'Family four', '9018', '1', '2015-10-27 21:49:02'),
(31, 'Family four', '8337', '1', '2015-10-27 22:23:23'),
(32, 'Family four', '1659', '1', '2015-10-28 00:25:46'),
(33, 'Family four', '3124', '1', '2015-10-28 02:24:29'),
(34, 'Family four', '1994', '1', '2015-10-28 14:08:05'),
(35, 'Family four', '3695', '1', '2015-10-28 14:10:24'),
(36, 'Family four', '1793', '0', NULL),
(37, 'Family four', '3051', '1', '2015-10-30 21:29:19'),
(38, 'Family four', '2739', '1', '2015-10-30 22:21:40'),
(39, 'Family four', '5408', '1', '2015-10-30 22:25:22'),
(40, 'Family four', '4635', '1', '2015-10-30 23:44:24'),
(41, 'Family four', '3280', '1', '2015-11-01 19:42:01'),
(42, 'Family four', '4166', '1', '2015-11-01 20:00:22'),
(43, 'Family four', '5881', '1', '2015-11-01 20:08:41'),
(44, 'Family four', '7907', '1', '2015-11-01 21:00:16'),
(45, 'Family four', '2681', '1', '2015-11-01 22:14:52'),
(46, 'Family four', '7051', '1', '2015-11-03 22:20:50'),
(47, 'Family four', '7540', '1', '2015-11-03 23:14:08'),
(48, 'Family four', '5074', '1', '2015-11-03 23:50:03'),
(49, 'Family four', '1227', '1', '2015-11-04 00:54:53'),
(50, 'Family four', '2275', '1', '2015-11-04 01:01:27'),
(51, 'Family four', '4106', '1', '2015-11-04 01:22:28'),
(52, 'Family four', '3332', '1', '2015-11-04 02:00:10'),
(53, 'Family four', '8163', '1', '2015-11-06 17:56:37'),
(54, 'Family four', '4819', '1', '2015-11-06 22:01:26'),
(55, 'Family four', '7212', '1', '2015-11-09 21:01:18'),
(56, 'Family four', '4486', '1', '2015-11-09 21:03:08'),
(57, 'Family four', '7000', '1', '2015-11-11 08:07:46'),
(58, 'Family four', '7512', '1', '2015-11-22 23:45:49'),
(59, 'Family four', '3831', '1', '2015-12-16 10:34:13'),
(60, 'Family four', '1131', '1', '2015-12-16 10:51:56'),
(61, 'Family four', '1718', '1', '2016-01-20 11:07:32'),
(62, 'Family four', '7846', '1', '2016-01-20 11:12:50'),
(63, 'Family four', '8698', '1', '2016-01-20 11:18:58'),
(64, 'Family four', '7573', '1', '2016-02-08 12:28:29');

-- --------------------------------------------------------

--
-- Table structure for table `ph2_game_finish_pos`
--
-- Creation: Nov 06, 2015 at 03:56 PM
--

DROP TABLE IF EXISTS `ph2_game_finish_pos`;
CREATE TABLE IF NOT EXISTS `ph2_game_finish_pos` (
  `game_id` int(10) unsigned NOT NULL,
  `posx` tinyint(4) NOT NULL,
  `posy` tinyint(4) NOT NULL,
  KEY `game_id` (`game_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `ph2_game_finish_pos`:
--   `game_id`
--       `ph2_games` -> `game_id`
--

--
-- Dumping data for table `ph2_game_finish_pos`
--

INSERT INTO `ph2_game_finish_pos` (`game_id`, `posx`, `posy`) VALUES
(49, 0, 22),
(50, 6, 18),
(51, 22, 4),
(52, 12, 22),
(53, 12, 18),
(54, 22, 4),
(55, 18, 10),
(56, 10, 12),
(57, 0, 10),
(58, 12, 22),
(59, 22, 4),
(60, 0, 10),
(61, 0, 22),
(62, 20, 0),
(63, 6, 18),
(64, 10, 12);

-- --------------------------------------------------------

--
-- Table structure for table `ph2_game_map_places`
--
-- Creation: Nov 06, 2015 at 03:56 PM
--

DROP TABLE IF EXISTS `ph2_game_map_places`;
CREATE TABLE IF NOT EXISTS `ph2_game_map_places` (
  `game_id` int(10) unsigned NOT NULL,
  `place_pos` int(10) unsigned NOT NULL,
  `place_ver` int(10) unsigned NOT NULL,
  PRIMARY KEY (`game_id`,`place_pos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ph2_game_map_places`
--

INSERT INTO `ph2_game_map_places` (`game_id`, `place_pos`, `place_ver`) VALUES
(12, 1, 0),
(12, 2, 0),
(12, 3, 0),
(12, 4, 0),
(12, 5, 0),
(12, 6, 0),
(12, 7, 0),
(12, 8, 0),
(12, 9, 0),
(13, 1, 0),
(13, 2, 0),
(13, 3, 0),
(13, 4, 0),
(13, 5, 0),
(13, 6, 0),
(13, 7, 0),
(13, 8, 0),
(13, 9, 0),
(14, 1, 0),
(14, 2, 0),
(14, 3, 0),
(14, 4, 0),
(14, 5, 0),
(14, 6, 0),
(14, 7, 0),
(14, 8, 0),
(14, 9, 0),
(15, 1, 2),
(15, 2, 0),
(15, 3, 0),
(15, 4, 0),
(15, 5, 0),
(15, 6, 0),
(15, 7, 0),
(15, 8, 0),
(15, 9, 0),
(16, 1, 1),
(16, 2, 0),
(16, 3, 0),
(16, 4, 0),
(16, 5, 0),
(16, 6, 0),
(16, 7, 0),
(16, 8, 0),
(16, 9, 0),
(17, 1, 0),
(17, 2, 0),
(17, 3, 0),
(17, 4, 0),
(17, 5, 0),
(17, 6, 0),
(17, 7, 0),
(17, 8, 0),
(17, 9, 0),
(18, 1, 0),
(18, 2, 0),
(18, 3, 0),
(18, 4, 0),
(18, 5, 0),
(18, 6, 0),
(18, 7, 0),
(18, 8, 0),
(18, 9, 0),
(19, 1, 1),
(19, 2, 0),
(19, 3, 0),
(19, 4, 0),
(19, 5, 0),
(19, 6, 0),
(19, 7, 0),
(19, 8, 0),
(19, 9, 0),
(20, 1, 0),
(20, 2, 0),
(20, 3, 0),
(20, 4, 0),
(20, 5, 0),
(20, 6, 0),
(20, 7, 0),
(20, 8, 0),
(20, 9, 0),
(21, 1, 2),
(21, 2, 0),
(21, 3, 0),
(21, 4, 0),
(21, 5, 0),
(21, 6, 0),
(21, 7, 0),
(21, 8, 0),
(21, 9, 0),
(22, 1, 2),
(22, 2, 0),
(22, 3, 0),
(22, 4, 0),
(22, 5, 0),
(22, 6, 0),
(22, 7, 0),
(22, 8, 0),
(22, 9, 0),
(23, 1, 2),
(23, 2, 0),
(23, 3, 0),
(23, 4, 0),
(23, 5, 0),
(23, 6, 0),
(23, 7, 0),
(23, 8, 0),
(23, 9, 0),
(24, 1, 0),
(24, 2, 0),
(24, 3, 0),
(24, 4, 0),
(24, 5, 0),
(24, 6, 0),
(24, 7, 0),
(24, 8, 0),
(24, 9, 0),
(25, 1, 1),
(25, 2, 0),
(25, 3, 0),
(25, 4, 0),
(25, 5, 0),
(25, 6, 0),
(25, 7, 0),
(25, 8, 0),
(25, 9, 0),
(26, 1, 0),
(26, 2, 0),
(26, 3, 0),
(26, 4, 0),
(26, 5, 0),
(26, 6, 0),
(26, 7, 0),
(26, 8, 0),
(26, 9, 0),
(27, 1, 0),
(27, 2, 0),
(27, 3, 0),
(27, 4, 0),
(27, 5, 0),
(27, 6, 0),
(27, 7, 0),
(27, 8, 0),
(27, 9, 0),
(28, 1, 2),
(28, 2, 0),
(28, 3, 0),
(28, 4, 0),
(28, 5, 0),
(28, 6, 0),
(28, 7, 0),
(28, 8, 0),
(28, 9, 0),
(29, 1, 2),
(29, 2, 0),
(29, 3, 0),
(29, 4, 0),
(29, 5, 0),
(29, 6, 0),
(29, 7, 0),
(29, 8, 0),
(29, 9, 0),
(30, 1, 2),
(30, 2, 0),
(30, 3, 0),
(30, 4, 0),
(30, 5, 0),
(30, 6, 0),
(30, 7, 0),
(30, 8, 0),
(30, 9, 0),
(31, 1, 0),
(31, 2, 0),
(31, 3, 0),
(31, 4, 0),
(31, 5, 0),
(31, 6, 0),
(31, 7, 0),
(31, 8, 0),
(31, 9, 0),
(32, 1, 2),
(32, 2, 0),
(32, 3, 0),
(32, 4, 0),
(32, 5, 0),
(32, 6, 0),
(32, 7, 0),
(32, 8, 0),
(32, 9, 0),
(33, 1, 1),
(33, 2, 0),
(33, 3, 0),
(33, 4, 0),
(33, 5, 0),
(33, 6, 0),
(33, 7, 0),
(33, 8, 0),
(33, 9, 0),
(34, 1, 1),
(34, 2, 0),
(34, 3, 0),
(34, 4, 0),
(34, 5, 0),
(34, 6, 0),
(34, 7, 0),
(34, 8, 0),
(34, 9, 0),
(35, 1, 0),
(35, 2, 0),
(35, 3, 0),
(35, 4, 0),
(35, 5, 0),
(35, 6, 0),
(35, 7, 0),
(35, 8, 0),
(35, 9, 0),
(36, 1, 0),
(36, 2, 0),
(36, 3, 0),
(36, 4, 0),
(36, 5, 0),
(36, 6, 0),
(36, 7, 0),
(36, 8, 0),
(36, 9, 0),
(37, 1, 0),
(37, 2, 0),
(37, 3, 0),
(37, 4, 0),
(37, 5, 0),
(37, 6, 0),
(37, 7, 0),
(37, 8, 0),
(37, 9, 0),
(38, 1, 1),
(38, 2, 0),
(38, 3, 0),
(38, 4, 0),
(38, 5, 0),
(38, 6, 0),
(38, 7, 0),
(38, 8, 0),
(38, 9, 0),
(39, 1, 1),
(39, 2, 0),
(39, 3, 0),
(39, 4, 0),
(39, 5, 0),
(39, 6, 0),
(39, 7, 0),
(39, 8, 0),
(39, 9, 0),
(40, 1, 0),
(40, 2, 0),
(40, 3, 0),
(40, 4, 0),
(40, 5, 0),
(40, 6, 0),
(40, 7, 0),
(40, 8, 0),
(40, 9, 0),
(41, 1, 0),
(41, 2, 0),
(41, 3, 0),
(41, 4, 0),
(41, 5, 0),
(41, 6, 0),
(41, 7, 0),
(41, 8, 0),
(41, 9, 0),
(42, 1, 1),
(42, 2, 0),
(42, 3, 0),
(42, 4, 0),
(42, 5, 0),
(42, 6, 0),
(42, 7, 0),
(42, 8, 0),
(42, 9, 0),
(43, 1, 2),
(43, 2, 0),
(43, 3, 0),
(43, 4, 0),
(43, 5, 0),
(43, 6, 0),
(43, 7, 0),
(43, 8, 0),
(43, 9, 0),
(44, 1, 1),
(44, 2, 0),
(44, 3, 0),
(44, 4, 0),
(44, 5, 0),
(44, 6, 0),
(44, 7, 0),
(44, 8, 0),
(44, 9, 0),
(45, 1, 2),
(45, 2, 0),
(45, 3, 0),
(45, 4, 0),
(45, 5, 0),
(45, 6, 0),
(45, 7, 0),
(45, 8, 0),
(45, 9, 0),
(46, 1, 0),
(46, 2, 0),
(46, 3, 0),
(46, 4, 0),
(46, 5, 0),
(46, 6, 0),
(46, 7, 0),
(46, 8, 0),
(46, 9, 0),
(47, 1, 0),
(47, 2, 0),
(47, 3, 0),
(47, 4, 0),
(47, 5, 0),
(47, 6, 0),
(47, 7, 0),
(47, 8, 0),
(47, 9, 0),
(48, 1, 0),
(48, 2, 0),
(48, 3, 0),
(48, 4, 0),
(48, 5, 0),
(48, 6, 0),
(48, 7, 0),
(48, 8, 0),
(48, 9, 0),
(49, 1, 0),
(49, 2, 0),
(49, 3, 0),
(49, 4, 0),
(49, 5, 0),
(49, 6, 0),
(49, 7, 0),
(49, 8, 0),
(49, 9, 0),
(50, 1, 0),
(50, 2, 0),
(50, 3, 0),
(50, 4, 0),
(50, 5, 0),
(50, 6, 0),
(50, 7, 0),
(50, 8, 0),
(50, 9, 0),
(51, 1, 0),
(51, 2, 0),
(51, 3, 0),
(51, 4, 0),
(51, 5, 0),
(51, 6, 0),
(51, 7, 0),
(51, 8, 0),
(51, 9, 0),
(52, 1, 0),
(52, 2, 0),
(52, 3, 0),
(52, 4, 0),
(52, 5, 0),
(52, 6, 0),
(52, 7, 0),
(52, 8, 0),
(52, 9, 0),
(53, 1, 0),
(53, 2, 0),
(53, 3, 0),
(53, 4, 0),
(53, 5, 0),
(53, 6, 0),
(53, 7, 0),
(53, 8, 0),
(53, 9, 0),
(54, 1, 0),
(54, 2, 0),
(54, 3, 0),
(54, 4, 0),
(54, 5, 0),
(54, 6, 0),
(54, 7, 0),
(54, 8, 0),
(54, 9, 0),
(55, 1, 0),
(55, 2, 0),
(55, 3, 0),
(55, 4, 0),
(55, 5, 0),
(55, 6, 0),
(55, 7, 0),
(55, 8, 0),
(55, 9, 0),
(56, 1, 0),
(56, 2, 0),
(56, 3, 0),
(56, 4, 0),
(56, 5, 0),
(56, 6, 0),
(56, 7, 0),
(56, 8, 0),
(56, 9, 0),
(57, 1, 0),
(57, 2, 0),
(57, 3, 0),
(57, 4, 0),
(57, 5, 0),
(57, 6, 0),
(57, 7, 0),
(57, 8, 0),
(57, 9, 0),
(58, 1, 0),
(58, 2, 0),
(58, 3, 0),
(58, 4, 0),
(58, 5, 0),
(58, 6, 0),
(58, 7, 0),
(58, 8, 0),
(58, 9, 0),
(59, 1, 0),
(59, 2, 0),
(59, 3, 0),
(59, 4, 0),
(59, 5, 0),
(59, 6, 0),
(59, 7, 0),
(59, 8, 0),
(59, 9, 0),
(60, 1, 0),
(60, 2, 0),
(60, 3, 0),
(60, 4, 0),
(60, 5, 0),
(60, 6, 0),
(60, 7, 0),
(60, 8, 0),
(60, 9, 0),
(61, 1, 0),
(61, 2, 0),
(61, 3, 0),
(61, 4, 0),
(61, 5, 0),
(61, 6, 0),
(61, 7, 0),
(61, 8, 0),
(61, 9, 0),
(62, 1, 0),
(62, 2, 0),
(62, 3, 0),
(62, 4, 0),
(62, 5, 0),
(62, 6, 0),
(62, 7, 0),
(62, 8, 0),
(62, 9, 0),
(63, 1, 0),
(63, 2, 0),
(63, 3, 0),
(63, 4, 0),
(63, 5, 0),
(63, 6, 0),
(63, 7, 0),
(63, 8, 0),
(63, 9, 0),
(64, 1, 0),
(64, 2, 0),
(64, 3, 0),
(64, 4, 0),
(64, 5, 0),
(64, 6, 0),
(64, 7, 0),
(64, 8, 0),
(64, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ph2_game_spells`
--
-- Creation: Nov 06, 2015 at 03:56 PM
--

DROP TABLE IF EXISTS `ph2_game_spells`;
CREATE TABLE IF NOT EXISTS `ph2_game_spells` (
  `game_id` int(10) unsigned NOT NULL,
  `player_id` int(10) unsigned NOT NULL,
  `spell_id` tinyint(3) unsigned NOT NULL,
  `start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `time` int(10) unsigned NOT NULL COMMENT 'miliseconds',
  PRIMARY KEY (`game_id`,`player_id`,`spell_id`,`start`),
  KEY `spell_id` (`spell_id`),
  KEY `player_id` (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `ph2_game_spells`:
--   `spell_id`
--       `ph2_spells` -> `spell_id`
--   `game_id`
--       `ph2_games` -> `game_id`
--   `player_id`
--       `ph2_players` -> `player_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `ph2_players`
--
-- Creation: Nov 06, 2015 at 03:56 PM
--

DROP TABLE IF EXISTS `ph2_players`;
CREATE TABLE IF NOT EXISTS `ph2_players` (
  `player_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ch_id` int(10) unsigned DEFAULT NULL,
  `game_id` int(11) unsigned DEFAULT NULL,
  `team` tinyint(3) unsigned DEFAULT NULL,
  `posx` int(11) DEFAULT NULL,
  `posy` int(11) DEFAULT NULL,
  `vision` tinyint(4) DEFAULT NULL,
  `finished` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`player_id`),
  KEY `user_id` (`user_id`),
  KEY `ch_id` (`ch_id`),
  KEY `game_id` (`game_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=160 ;

--
-- RELATIONS FOR TABLE `ph2_players`:
--   `user_id`
--       `ph2_users` -> `user_id`
--   `ch_id`
--       `ph2_characters` -> `ch_id`
--   `game_id`
--       `ph2_games` -> `game_id`
--

--
-- Dumping data for table `ph2_players`
--

INSERT INTO `ph2_players` (`player_id`, `user_id`, `ch_id`, `game_id`, `team`, `posx`, `posy`, `vision`, `finished`) VALUES
(1, 1, 1, 1, NULL, 4, 7, 3, '0'),
(2, 2, 2, 1, NULL, 5, 5, 4, '0'),
(3, 3, 1, 2, NULL, NULL, NULL, NULL, '0'),
(4, NULL, NULL, 2, NULL, NULL, NULL, NULL, '0'),
(5, NULL, NULL, 2, NULL, NULL, NULL, NULL, '0'),
(6, NULL, NULL, 2, NULL, 5, 5, 20, '0'),
(7, 4, 1, 3, 1, 5, 7, 30, '0'),
(8, 5, 2, 3, 2, 5, 5, 3, '0'),
(11, 5, 1, 4, 1, NULL, NULL, NULL, '0'),
(12, NULL, NULL, 4, 2, NULL, NULL, NULL, '0'),
(13, NULL, NULL, 4, 1, NULL, NULL, NULL, '0'),
(14, NULL, NULL, 4, 2, NULL, NULL, 20, '0'),
(15, 6, 2, 5, 2, 5, 8, 20, '0'),
(16, 7, NULL, 5, 1, 5, 7, 20, '0'),
(17, 8, 1, 5, 1, 5, 6, 20, '0'),
(18, NULL, NULL, 5, 2, 5, 5, 20, '0'),
(19, 18, 1, 6, 1, 5, 4, 100, '0'),
(20, 19, 2, 6, 2, 5, 6, 4, '0'),
(21, 20, 1, 7, 1, 7, 4, 10, '0'),
(22, NULL, NULL, 7, 2, NULL, NULL, NULL, '0'),
(23, NULL, NULL, 7, 1, NULL, NULL, NULL, '0'),
(24, NULL, NULL, 7, 2, NULL, NULL, NULL, '0'),
(25, 21, 1, 8, 1, 5, 5, 10, '0'),
(26, NULL, NULL, 8, 2, NULL, NULL, NULL, '0'),
(27, NULL, NULL, 8, 1, NULL, NULL, NULL, '0'),
(28, NULL, NULL, 8, 2, NULL, NULL, NULL, '0'),
(29, 22, 1, 9, 1, 3, 7, 10, '0'),
(30, NULL, NULL, 9, 2, NULL, NULL, NULL, '0'),
(31, NULL, NULL, 9, 1, NULL, NULL, NULL, '0'),
(32, NULL, NULL, 9, 2, NULL, NULL, NULL, '0'),
(33, 23, 1, 10, 1, 5, 5, 10, '0'),
(34, NULL, NULL, 10, 2, NULL, NULL, NULL, '0'),
(35, NULL, NULL, 10, 1, NULL, NULL, NULL, '0'),
(36, NULL, NULL, 10, 2, NULL, NULL, NULL, '0'),
(37, 24, 1, 11, 1, 5, 5, 10, '0'),
(38, NULL, NULL, 11, 2, NULL, NULL, NULL, '0'),
(39, NULL, NULL, 11, 1, NULL, NULL, NULL, '0'),
(40, NULL, NULL, 11, 2, NULL, NULL, NULL, '0'),
(41, 25, 1, 12, 1, 5, 5, 10, '0'),
(42, 26, 1, 13, 1, 5, 5, 10, '0'),
(43, 27, 1, 14, 1, NULL, NULL, NULL, '0'),
(44, 28, 1, 15, 1, 10, 0, 10, '0'),
(45, 29, 1, 16, 1, 5, 0, 10, '0'),
(46, 30, 2, 17, 1, 1, 0, 10, '0'),
(47, 32, 1, 18, 1, 7, 0, 10, '1'),
(48, 33, 2, 18, 2, 0, 0, 10, '0'),
(49, NULL, NULL, 19, 1, NULL, NULL, NULL, '0'),
(50, 36, 1, 19, 1, 7, 0, 10, '1'),
(51, NULL, NULL, 20, 1, NULL, NULL, NULL, '0'),
(52, 37, 1, 20, 1, 1, 0, 10, '0'),
(53, NULL, NULL, 21, 1, NULL, NULL, NULL, '0'),
(54, 40, 1, 21, 1, 7, 0, 10, '1'),
(55, 39, 2, 21, 1, 5, 0, 10, '0'),
(56, NULL, NULL, 22, 1, NULL, NULL, NULL, '0'),
(57, 40, 1, 22, 1, 7, 0, 10, '1'),
(58, NULL, NULL, 23, 1, NULL, NULL, NULL, '0'),
(59, 42, 1, 23, 1, 7, 0, 10, '1'),
(60, NULL, NULL, 24, 1, NULL, NULL, NULL, '0'),
(61, 42, 1, 24, 1, 7, 0, 10, '1'),
(62, NULL, NULL, 25, 1, NULL, NULL, NULL, '0'),
(63, 42, 1, 25, 1, 7, 0, 4, '1'),
(64, NULL, NULL, 26, 1, NULL, NULL, NULL, '0'),
(65, 42, 1, 26, 1, 1, 0, 4, '0'),
(66, NULL, NULL, 27, 1, NULL, NULL, NULL, '0'),
(67, 43, 1, 27, 1, 7, 0, 4, '1'),
(68, NULL, NULL, 28, 1, NULL, NULL, NULL, '0'),
(69, 43, 2, 28, 1, 7, 0, 4, '1'),
(70, NULL, NULL, 29, 1, NULL, NULL, NULL, '0'),
(71, 44, 1, 29, 1, 7, 0, 4, '1'),
(72, NULL, NULL, 30, 1, NULL, NULL, NULL, '0'),
(73, 44, 1, 30, 1, 7, 0, 4, '1'),
(74, NULL, NULL, 31, 1, NULL, NULL, NULL, '0'),
(75, 44, 1, 31, 1, 0, 0, 4, '0'),
(76, NULL, NULL, 32, 1, NULL, NULL, NULL, '0'),
(77, 45, 1, 32, 1, 4, 0, 4, '0'),
(78, NULL, NULL, 33, 1, NULL, NULL, NULL, '0'),
(79, 46, 1, 33, 1, 2, 0, 4, '0'),
(80, NULL, NULL, 34, 1, NULL, NULL, NULL, '0'),
(81, 47, 1, 34, 1, 1, 0, 4, '0'),
(82, 48, 2, 34, 1, 1, 0, 4, '0'),
(83, NULL, NULL, 35, 1, NULL, NULL, NULL, '0'),
(84, 49, 1, 35, 1, 7, 0, 4, '1'),
(85, NULL, NULL, 36, 1, NULL, NULL, NULL, '0'),
(86, 51, 1, 36, 1, NULL, NULL, NULL, '0'),
(87, NULL, NULL, 37, 1, NULL, NULL, NULL, '0'),
(88, 51, 3, 37, 1, 1, 0, 4, '0'),
(89, NULL, NULL, 38, 1, NULL, NULL, NULL, '0'),
(90, 51, 4, 38, 1, 2, 0, 4, '0'),
(91, NULL, NULL, 39, 1, NULL, NULL, NULL, '0'),
(92, 51, 5, 39, 1, 1, 0, 4, '0'),
(93, NULL, NULL, 40, 1, NULL, NULL, NULL, '0'),
(94, 51, 2, 40, 1, 1, 0, 4, '0'),
(95, NULL, NULL, 41, 1, NULL, NULL, NULL, '0'),
(96, 55, 1, 41, 1, 3, 0, 4, '0'),
(97, 56, 3, 41, 1, 3, 0, 4, '0'),
(98, NULL, NULL, 42, 1, NULL, NULL, NULL, '0'),
(99, 57, 2, 42, 1, 2, 0, 4, '0'),
(100, 58, 5, 42, 1, 2, 0, 4, '0'),
(101, NULL, NULL, 43, 1, NULL, NULL, NULL, '0'),
(102, 59, 5, 43, 1, 3, 0, 4, '0'),
(103, NULL, NULL, 44, 1, NULL, NULL, NULL, '0'),
(104, 60, 1, 44, 1, 5, 0, 4, '0'),
(105, 61, 2, 44, 1, 6, 0, 4, '0'),
(106, NULL, NULL, 45, 1, NULL, NULL, NULL, '0'),
(107, 65, 1, 45, 1, 7, 0, 4, '1'),
(108, 62, 2, 45, 1, 7, 0, 4, '1'),
(109, 63, 3, 45, 2, 0, 0, 4, '0'),
(110, 64, 4, 45, 2, 7, 0, 4, '1'),
(111, 66, 5, 45, 1, 7, 0, 4, '1'),
(112, NULL, NULL, 46, 1, NULL, NULL, NULL, '0'),
(113, 67, 5, 46, 1, 7, 0, 4, '1'),
(114, NULL, NULL, 47, 1, NULL, NULL, NULL, '0'),
(115, 67, 1, 47, 1, 7, 0, 4, '1'),
(116, NULL, NULL, 48, 1, NULL, NULL, NULL, '0'),
(117, 67, 1, 48, 1, 3, 6, 4, '0'),
(118, NULL, NULL, 49, 1, NULL, NULL, NULL, '0'),
(119, 68, 3, 49, 1, 4, 1, 4, '0'),
(120, NULL, NULL, 50, 1, NULL, NULL, NULL, '0'),
(121, 69, 3, 50, 1, 18, 20, 4, '0'),
(122, NULL, NULL, 51, 1, NULL, NULL, NULL, '0'),
(123, 70, 1, 51, 1, 9, 18, 4, '0'),
(124, NULL, NULL, 52, 1, NULL, NULL, NULL, '0'),
(125, 71, 1, 52, 1, 18, 14, 4, '0'),
(126, NULL, NULL, 53, 1, NULL, NULL, NULL, '0'),
(127, 5, 1, 53, 1, 10, 4, 4, '0'),
(128, NULL, NULL, 54, 1, NULL, NULL, NULL, '0'),
(129, 74, 1, 54, 1, 10, 16, 4, '0'),
(130, 75, 2, 54, 1, 22, 4, 4, '1'),
(131, NULL, NULL, 55, 1, NULL, NULL, NULL, '0'),
(132, 76, 1, 55, 1, 6, 7, 4, '0'),
(133, NULL, NULL, 56, 1, NULL, NULL, NULL, '0'),
(134, 76, 3, 56, 1, 14, 6, 4, '0'),
(135, NULL, NULL, 57, 1, NULL, NULL, NULL, '0'),
(136, 77, 3, 57, 1, 9, 14, 4, '0'),
(137, NULL, NULL, 58, 1, NULL, NULL, NULL, '0'),
(138, 82, 1, 58, 1, 4, 1, 4, '0'),
(139, 83, 2, 58, 1, 7, 0, 4, '0'),
(140, 84, 3, 58, 2, 0, 13, 4, '0'),
(141, 85, 4, 58, 2, 0, 15, 4, '0'),
(142, NULL, NULL, 59, 1, NULL, NULL, NULL, '0'),
(143, 91, 1, 59, 1, 6, 0, 4, '0'),
(144, 92, 1, 59, 2, 8, 4, 4, '0'),
(145, NULL, NULL, 60, 1, NULL, NULL, NULL, '0'),
(146, 93, 5, 60, 1, 10, 20, 4, '0'),
(147, NULL, NULL, 61, 1, NULL, NULL, NULL, '0'),
(148, 95, 1, 61, 1, 4, 1, 4, '0'),
(149, 96, 5, 61, 1, 7, 0, 4, '0'),
(150, 97, 3, 61, 1, NULL, NULL, NULL, '0'),
(151, NULL, NULL, 62, 1, NULL, NULL, NULL, '0'),
(152, 95, 1, 62, 1, 4, 1, 4, '0'),
(153, 98, 5, 62, 1, 7, 0, 4, '0'),
(154, NULL, NULL, 63, 1, NULL, NULL, NULL, '0'),
(155, 100, 1, 63, 1, 6, 0, 4, '0'),
(156, 101, 5, 63, 1, 7, 0, 4, '0'),
(157, NULL, NULL, 64, 1, NULL, NULL, NULL, '0'),
(158, 102, 1, 64, 1, 5, 0, 4, '0'),
(159, 103, 2, 64, 1, 7, 0, 4, '0');

-- --------------------------------------------------------

--
-- Table structure for table `ph2_spells`
--
-- Creation: Nov 06, 2015 at 03:56 PM
--

DROP TABLE IF EXISTS `ph2_spells`;
CREATE TABLE IF NOT EXISTS `ph2_spells` (
  `spell_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `spell_key` varchar(30) NOT NULL,
  `label` varchar(50) NOT NULL,
  `description` varchar(512) NOT NULL,
  PRIMARY KEY (`spell_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ph2_spells`
--

INSERT INTO `ph2_spells` (`spell_id`, `spell_key`, `label`, `description`) VALUES
(1, 'dice_delay', 'Delay', 'You need to wait a time until the dice is ready.');

-- --------------------------------------------------------

--
-- Table structure for table `ph2_users`
--
-- Creation: Nov 06, 2015 at 03:56 PM
--

DROP TABLE IF EXISTS `ph2_users`;
CREATE TABLE IF NOT EXISTS `ph2_users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;

--
-- Dumping data for table `ph2_users`
--

INSERT INTO `ph2_users` (`user_id`, `fullname`) VALUES
(1, 'Adrian Simionescu'),
(2, 'Adriana'),
(3, 'adrian'),
(4, '5488'),
(5, 'adry'),
(6, 'adriana'),
(7, 'Guest'),
(8, '3333'),
(9, 'Guest3296'),
(10, 'Guest1687'),
(11, 'Guest3771'),
(12, 'Guest4354'),
(13, 'Guest1646'),
(14, 'Guest4375'),
(15, 'Guest5218'),
(16, 'Guest6671'),
(17, 'Guest4292'),
(18, 'Adrian'),
(19, 'adriana'),
(20, 'cxxc'),
(21, 'Adrian'),
(22, 'Adrian'),
(23, 'Adrian'),
(24, 'asd'),
(25, 'adry'),
(26, 'Adrian'),
(27, 'ad'),
(28, 'asd'),
(29, 'ad'),
(30, '123'),
(31, 'explorer'),
(32, 'opera'),
(33, 'chrome'),
(34, 'Guest9959'),
(35, 'Guest7306'),
(36, 'adrian'),
(37, 'adry'),
(38, 'Guest4575'),
(39, 'chrome'),
(40, 'adry'),
(41, 'Guest3459'),
(42, 'adry'),
(43, 'Adriana'),
(44, 'adrian'),
(45, 'adr'),
(46, 'uyhgf'),
(47, 'Adrian'),
(48, 'Asdd'),
(49, 'adry'),
(50, 'Guest2485'),
(51, 'sdf'),
(52, 'Guest1377'),
(53, 'Guest6709'),
(54, 'Guest6089'),
(55, 'adrian'),
(56, 'simi'),
(57, 'adri'),
(58, 'bo'),
(59, 'bb'),
(60, 'ad'),
(61, 'add'),
(62, 'Chrome'),
(63, 'ChromePrivat'),
(64, 'IExplorer'),
(65, 'OperaPrivate'),
(66, 'IExplorerPriv'),
(67, 'ss'),
(68, 'dr'),
(69, 'dr'),
(70, 's'),
(71, 'ff'),
(72, 'Guest3555'),
(73, 'Guest9614'),
(74, 'Adrian'),
(75, 'Adria'),
(76, 'SiMi'),
(77, 'Ovidiu'),
(78, 'Guest6089'),
(79, 'Guest7407'),
(80, 'Guest9520'),
(81, 'Guest1605'),
(82, 'Adrian'),
(83, 'Adriana'),
(84, 'Dr.SiMi'),
(85, 'Flori'),
(86, 'Guest3899'),
(87, 'Guest7785'),
(88, 'Guest7288'),
(89, 'Guest2974'),
(90, 'Guest6208'),
(91, 'adry'),
(92, 'Relu'),
(93, 'adry'),
(94, 'Guest1692'),
(95, 'Adrian'),
(96, 'Ral'),
(97, 'dr.simi'),
(98, 'Bib'),
(99, 'Guest6160'),
(100, 'Adrian'),
(101, 'Ray'),
(102, 'Adrian'),
(103, 'Par');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ph2_game_finish_pos`
--
ALTER TABLE `ph2_game_finish_pos`
  ADD CONSTRAINT `ph2_game_finish_pos_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `ph2_games` (`game_id`);

--
-- Constraints for table `ph2_game_spells`
--
ALTER TABLE `ph2_game_spells`
  ADD CONSTRAINT `ph2_game_spells_ibfk_1` FOREIGN KEY (`spell_id`) REFERENCES `ph2_spells` (`spell_id`),
  ADD CONSTRAINT `ph2_game_spells_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `ph2_games` (`game_id`),
  ADD CONSTRAINT `ph2_game_spells_ibfk_3` FOREIGN KEY (`player_id`) REFERENCES `ph2_players` (`player_id`);

--
-- Constraints for table `ph2_players`
--
ALTER TABLE `ph2_players`
  ADD CONSTRAINT `ph2_players_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `ph2_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ph2_players_ibfk_2` FOREIGN KEY (`ch_id`) REFERENCES `ph2_characters` (`ch_id`),
  ADD CONSTRAINT `ph2_players_ibfk_3` FOREIGN KEY (`game_id`) REFERENCES `ph2_games` (`game_id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
