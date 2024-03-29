-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jan 26, 2024 at 04:11 AM
-- Server version: 10.10.2-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `axleus`
--

-- --------------------------------------------------------

--
-- Table structure for table `axl_page`
--

DROP TABLE IF EXISTS `axl_page`;
CREATE TABLE IF NOT EXISTS `axl_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(10) UNSIGNED DEFAULT NULL,
  `ownerId` int(10) UNSIGNED DEFAULT NULL,
  `label` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `class` varchar(100) DEFAULT NULL,
  `iconClass` varchar(100) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `params` longtext DEFAULT NULL CHECK (json_valid(`params`)),
  `rel` varchar(255) DEFAULT NULL,
  `rev` varchar(255) DEFAULT NULL,
  `resource` varchar(50) DEFAULT NULL,
  `privilege` varchar(50) DEFAULT NULL,
  `visible` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `route` varchar(255) DEFAULT NULL,
  `uri` varchar(255) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  `query` varchar(500) DEFAULT NULL,
  `isGroupPage` tinyint(3) UNSIGNED DEFAULT NULL,
  `allowComments` tinyint(3) UNSIGNED DEFAULT NULL,
  `content` text DEFAULT NULL,
  `isLandingPage` tinyint(3) UNSIGNED DEFAULT NULL,
  `cmsType` varchar(50) DEFAULT NULL,
  `createdDate` varchar(255) DEFAULT NULL,
  `updatedDate` varchar(255) DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `showOnLandingPage` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `axl_page`
--

INSERT INTO `axl_page` (`id`, `parentId`, `ownerId`, `label`, `title`, `class`, `iconClass`, `order`, `params`, `rel`, `rev`, `resource`, `privilege`, `visible`, `route`, `uri`, `action`, `query`, `isGroupPage`, `allowComments`, `content`, `isLandingPage`, `cmsType`, `createdDate`, `updatedDate`, `keywords`, `description`, `showOnLandingPage`) VALUES
(1, 0, 1, 'HomeLandingPage', 'homelandingpage', 'nav-link', NULL, 1, '{\"title\": \"homelandingpage\"}', NULL, NULL, 'page', 'view', 1, 'page', NULL, NULL, NULL, NULL, NULL, '<p>Congratulations! You have successfully installed <a href=\"https://github.com/Tyrsson/aurora-2.0/wiki\" target=\"_blank\" rel=\"noopener\">ACMS</a>. testing</p>', 1, NULL, '07-23-2022 5:12:21', '07-23-2022 9:26:01', NULL, NULL, 0),
(6, 1, 1, 'Follow Development', 'follow-development', 'nav-link', NULL, 2, '{\"title\": \"follow-development\"}', NULL, NULL, 'page', 'view', 1, 'page', NULL, 'page', NULL, NULL, NULL, '<p>Follow Development.</p>\r\n<p>Keep up to date on all the changes, or bugs lol... Testing.. Again. and Again...</p>', 0, NULL, '07-23-2022 6:28:31', '07-24-2022 11:59:42', 'Aurora, Php, Custom Development', 'Follow Aurora Development!!', 1),
(9, 0, 1, 'About Us', 'about-us', 'nav-link', NULL, 3, '{\"title\": \"about-us\"}', NULL, NULL, 'page', 'view', 1, 'page', NULL, 'page', NULL, NULL, NULL, '<p>This will be the about us page. Testing Edit. This is some text</p>', 0, NULL, '07-23-2022 10:25:00', '10-16-2022 3:54:17', NULL, NULL, 0),
(10, 0, 1, 'Test', 'test', 'nav-link', NULL, 4, '{\"title\": \"test\"}', NULL, NULL, 'page', 'view', 1, 'page', NULL, NULL, NULL, NULL, NULL, '', 0, NULL, '07-27-2022 8:01:53', NULL, NULL, NULL, 0),
(25, 0, 1, 'Button test', 'button-test', 'nav-link', NULL, 5, '{\"title\": \"button-test\"}', NULL, NULL, 'page', 'view', 1, 'page', NULL, NULL, NULL, NULL, NULL, 'Just testing different control type setups.', 0, NULL, '05-9-2023 7:23:35', NULL, NULL, NULL, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
