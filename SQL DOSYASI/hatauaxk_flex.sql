-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 03, 2022 at 01:40 PM
-- Server version: 10.3.34-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hatauaxk_flex`
--

-- --------------------------------------------------------

--
-- Table structure for table `anahtar`
--

CREATE TABLE `anahtar` (
  `key_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `key_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `anahtar`
--

INSERT INTO `anahtar` (`key_id`, `urun_id`, `key_text`) VALUES
(100, 50, 'G3E9D-96KTA-9E1Q5');

-- --------------------------------------------------------

--
-- Table structure for table `ayar`
--

CREATE TABLE `ayar` (
  `ayar_id` int(11) NOT NULL,
  `ayar_logo` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_favicon` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_url` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_title` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_description` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_keywords` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_tel` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_footer` text COLLATE utf8_turkish_ci NOT NULL,
  `ayar_facebook` text COLLATE utf8_turkish_ci NOT NULL,
  `ayar_twitter` text COLLATE utf8_turkish_ci NOT NULL,
  `ayar_instagram` text COLLATE utf8_turkish_ci NOT NULL,
  `ayar_google` text COLLATE utf8_turkish_ci NOT NULL,
  `ayar_canli` text COLLATE utf8_turkish_ci NOT NULL,
  `ayar_api` text COLLATE utf8_turkish_ci NOT NULL,
  `ayar_secret` text COLLATE utf8_turkish_ci NOT NULL,
  `ayar_googlekey` text COLLATE utf8_turkish_ci NOT NULL,
  `ayar_googlesecret` text COLLATE utf8_turkish_ci NOT NULL,
  `ayar_komisyon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `ayar`
--

INSERT INTO `ayar` (`ayar_id`, `ayar_logo`, `ayar_favicon`, `ayar_url`, `ayar_title`, `ayar_description`, `ayar_keywords`, `ayar_tel`, `ayar_footer`, `ayar_facebook`, `ayar_twitter`, `ayar_instagram`, `ayar_google`, `ayar_canli`, `ayar_api`, `ayar_secret`, `ayar_googlekey`, `ayar_googlesecret`, `ayar_komisyon`) VALUES
(0, 'assets/images/24885258642683023456legacy.png', 'assets/images/26802221762992731532favicon.png', 'https://leagcy.hatauzmani.com/', 'Legacy', 'açıklama', 'anahtar kelime,vs,vs', '0553 884 96 58', '© Copyrights 2021 LeftSoft All rights reserved.', 'https://facebook.com', 'https://twitter.com', 'https://instagram.com', '', '', 'f100692eadd4680c0565b4a3368945f7', 'f5ddab28b301946c90f8228aa927cfaf', '6LeGzXYcAAAAAOBQv5G8GbbaLHvmd9m0lLKsQj3R', '6LeGzXYcAAAAAERK13rTOFvNE42LD8Z-6aqnslUG', 3);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL,
  `blog_resim` text NOT NULL,
  `blog_baslik` text NOT NULL,
  `blog_text` text NOT NULL,
  `blog_tarih` text NOT NULL,
  `blog_tarih2` text NOT NULL,
  `blog_views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `blog_resim`, `blog_baslik`, `blog_text`, `blog_tarih`, `blog_tarih2`, `blog_views`) VALUES
(17, 'assets/images/blog/29685209613142922070EregistryException.jpg', 'deneme2', '<p>222222222222222222</p>\r\n', '21/09/2021 - 21:09', '2021-09-21 21:09:01', 51);

-- --------------------------------------------------------

--
-- Table structure for table `blog_ip`
--

CREATE TABLE `blog_ip` (
  `ip_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `ip_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_ip`
--

INSERT INTO `blog_ip` (`ip_id`, `blog_id`, `ip_text`) VALUES
(1, 2, '::1'),
(2, 13, '::1'),
(3, 14, '::1'),
(4, 14, '88.240.251.182'),
(5, 2, '176.55.164.104'),
(6, 14, '88.245.193.91'),
(7, 13, '88.245.193.91'),
(8, 15, '88.245.193.91'),
(9, 2, '88.245.193.91'),
(10, 2, '85.104.55.64'),
(11, 15, '85.104.55.64'),
(12, 16, '85.104.55.64'),
(13, 17, '85.104.55.64'),
(14, 16, '31.13.127.117'),
(15, 16, '31.13.127.16'),
(16, 16, '31.13.127.116'),
(17, 16, '199.59.150.181'),
(18, 17, '88.243.193.251'),
(19, 16, '46.221.214.145'),
(20, 16, '77.88.5.253'),
(21, 17, '77.88.5.253'),
(22, 17, '77.88.5.33'),
(23, 16, '193.235.141.147'),
(24, 17, '193.235.141.147'),
(25, 16, '31.145.217.51'),
(26, 17, '88.240.251.0'),
(27, 16, '60.205.176.89'),
(28, 17, '60.205.176.89'),
(29, 16, '176.88.130.156'),
(30, 16, '216.244.66.199'),
(31, 17, '216.244.66.199'),
(32, 17, '78.180.14.111'),
(33, 16, '31.223.9.245'),
(34, 17, '31.223.9.245'),
(35, 16, '95.8.200.74'),
(36, 17, '54.36.148.50'),
(37, 16, '54.36.148.116'),
(38, 17, '5.255.253.150'),
(39, 16, '77.88.5.89'),
(40, 17, '212.154.4.195'),
(41, 17, '54.36.148.106'),
(42, 16, '54.36.148.172'),
(43, 17, '207.46.13.177'),
(44, 16, '88.253.65.111'),
(45, 17, '54.36.149.84'),
(46, 16, '54.36.149.87'),
(47, 16, '40.77.167.43'),
(48, 17, '185.191.171.37'),
(49, 16, '185.191.171.13'),
(50, 17, '185.191.171.42'),
(51, 16, '31.223.13.146'),
(52, 17, '54.36.148.231'),
(53, 16, '54.36.149.17'),
(54, 16, '78.189.189.70'),
(55, 17, '87.250.224.192'),
(56, 17, '54.36.148.182'),
(57, 16, '54.36.148.2'),
(58, 17, '88.243.198.29'),
(59, 16, '88.243.198.29'),
(60, 16, '193.176.84.143'),
(61, 17, '193.176.84.143'),
(62, 13, '193.176.84.143'),
(63, 11, '193.176.84.143'),
(64, 18, '193.176.84.143'),
(65, 17, '54.36.148.159'),
(66, 16, '54.36.149.37'),
(67, 16, '185.191.171.42'),
(68, 16, '185.191.171.15'),
(69, 17, '162.55.85.221'),
(70, 16, '162.55.85.221'),
(71, 17, '54.36.148.213'),
(72, 16, '54.36.149.62'),
(73, 16, '5.255.253.162'),
(74, 17, '5.45.207.154'),
(75, 17, '185.191.171.25'),
(76, 17, '88.243.194.134'),
(77, 17, '54.36.148.196'),
(78, 16, '54.36.148.82'),
(79, 17, '157.55.39.27'),
(80, 17, '88.245.196.193'),
(81, 17, '54.36.149.25'),
(82, 16, '54.36.148.249'),
(83, 16, '157.55.39.60'),
(84, 17, '54.36.148.49'),
(85, 16, '54.36.148.149'),
(86, 16, '185.191.171.4'),
(87, 17, '54.36.148.19'),
(88, 17, '185.191.171.1'),
(89, 16, '77.88.5.241'),
(90, 16, '77.88.5.46'),
(91, 17, '54.36.148.115'),
(92, 17, '213.14.173.223'),
(93, 17, '77.88.5.14'),
(94, 16, '77.88.5.14'),
(95, 17, '176.237.196.178'),
(96, 17, '31.13.127.116'),
(97, 17, '31.13.127.25'),
(98, 17, '31.13.127.34'),
(99, 17, '54.36.148.149'),
(100, 17, '85.104.55.87'),
(101, 17, '88.243.199.142'),
(102, 17, '54.36.148.197'),
(103, 17, '185.191.171.17'),
(104, 17, '54.36.148.125'),
(105, 17, '185.191.171.4'),
(106, 17, '54.36.148.27');

-- --------------------------------------------------------

--
-- Table structure for table `destek`
--

CREATE TABLE `destek` (
  `destek_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `destek_rand` text CHARACTER SET utf8 NOT NULL,
  `destek_konu` text CHARACTER SET utf8 NOT NULL,
  `destek_tarih` text CHARACTER SET utf8 NOT NULL,
  `destek_sontarih` text CHARACTER SET utf8 NOT NULL,
  `destek_durum` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `destek`
--

INSERT INTO `destek` (`destek_id`, `kullanici_id`, `destek_rand`, `destek_konu`, `destek_tarih`, `destek_sontarih`, `destek_durum`) VALUES
(20, 1, 'R5TPQ34NSDI', 'SELAM', '11-09-2021 12:18:35', '18-09-2021 18:55:54', 2),
(24, 12, 'E4NPY3224H7', 'deneme', '12-01-2022 17:52:04', '12-01-2022 17:52:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hesap`
--

CREATE TABLE `hesap` (
  `hesap_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `hesap_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hesap`
--

INSERT INTO `hesap` (`hesap_id`, `urun_id`, `hesap_text`) VALUES
(80, 49, 'hesap:sifre1'),
(81, 51, 'hesap.deneme30'),
(82, 51, '20'),
(83, 51, '50000'),
(84, 51, 'test'),
(85, 51, 'merhaba'),
(86, 51, 'kaygen'),
(87, 51, 'kader');

-- --------------------------------------------------------

--
-- Table structure for table `ipadress`
--

CREATE TABLE `ipadress` (
  `ip_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `ip_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ipadress`
--

INSERT INTO `ipadress` (`ip_id`, `urun_id`, `ip_text`) VALUES
(34, 15, '88.245.197.214'),
(35, 32, '88.245.197.214'),
(36, 31, '88.245.197.214'),
(37, 32, '88.240.251.237'),
(38, 31, '88.240.251.237'),
(39, 15, '88.240.251.237'),
(40, 29, '88.240.251.237'),
(41, 26, '88.240.251.237'),
(42, 17, '88.240.251.237'),
(43, 15, '88.240.251.182'),
(44, 31, '88.240.251.182'),
(45, 29, '88.240.251.182'),
(46, 32, '88.240.251.182'),
(47, 32, '176.55.164.104'),
(48, 17, '5.46.90.117'),
(49, 15, '5.46.90.117'),
(50, 25, '5.46.90.117'),
(51, 32, '5.46.90.117'),
(52, 17, '95.70.128.87'),
(53, 15, '95.70.128.87'),
(54, 21, '88.240.251.237'),
(55, 23, '88.240.251.237'),
(56, 26, '5.46.85.194'),
(57, 32, '5.46.85.194'),
(58, 17, '5.46.85.194'),
(59, 24, '5.46.85.194'),
(60, 17, '5.46.112.51'),
(62, 33, '5.46.112.51'),
(63, 33, '88.240.251.237'),
(64, 17, '5.46.48.190'),
(65, 32, '88.245.193.91'),
(66, 15, '88.245.193.91'),
(67, 26, '88.245.193.91'),
(68, 17, '88.245.193.91'),
(69, 27, '88.245.193.91'),
(70, 17, '88.245.195.206'),
(71, 32, '88.245.195.206'),
(72, 15, '88.245.195.206'),
(73, 17, '85.104.54.159'),
(74, 17, '85.104.55.64'),
(75, 15, '85.104.55.64'),
(76, 34, '85.104.55.64'),
(77, 36, '85.104.55.64'),
(78, 35, '85.104.55.64'),
(79, 47, '85.104.55.64'),
(80, 47, '5.24.2.33'),
(81, 48, '178.240.72.188'),
(82, 48, '85.104.55.64'),
(83, 48, '88.243.193.251'),
(84, 50, '88.243.193.251'),
(85, 50, '78.182.142.190'),
(86, 50, '78.178.159.227'),
(87, 50, '5.46.89.38'),
(88, 49, '88.243.193.251'),
(89, 50, '78.166.176.226'),
(90, 49, '176.237.195.161'),
(91, 49, '88.236.108.121'),
(92, 50, '88.236.108.121'),
(93, 49, '31.155.127.247'),
(94, 49, '95.12.249.133'),
(95, 49, '85.108.120.51'),
(96, 49, '5.47.238.113'),
(97, 50, '5.27.33.156'),
(98, 49, '31.223.2.92'),
(99, 50, '77.88.5.33'),
(100, 49, '77.88.5.253'),
(101, 49, '212.253.195.136'),
(102, 49, '46.1.70.107'),
(103, 49, '95.90.240.189'),
(104, 49, '24.133.86.167'),
(105, 50, '88.229.4.95'),
(106, 50, '77.88.5.253'),
(107, 50, '78.176.173.11'),
(108, 49, '31.206.103.154'),
(109, 49, '78.189.33.126'),
(110, 50, '188.58.58.10'),
(111, 50, '88.232.51.48'),
(112, 49, '178.243.175.98'),
(113, 49, '88.243.143.73'),
(114, 50, '88.243.143.73'),
(115, 50, '78.190.153.84'),
(116, 50, '159.146.42.122'),
(117, 49, '193.235.141.147'),
(118, 50, '193.235.141.147'),
(119, 49, '159.146.70.217'),
(120, 49, '95.10.22.134'),
(121, 50, '95.10.22.134'),
(122, 49, '95.70.214.198'),
(123, 49, '31.145.217.51'),
(124, 49, '88.240.251.0'),
(125, 50, '88.245.36.170'),
(126, 49, '95.70.245.79'),
(127, 50, '88.240.251.0'),
(128, 49, '37.155.21.154'),
(129, 49, '60.205.176.89'),
(130, 50, '60.205.176.89'),
(131, 50, '88.241.165.192'),
(132, 49, '88.241.165.192'),
(133, 50, '46.1.156.54'),
(134, 50, '95.70.146.183'),
(135, 49, '89.0.48.247'),
(136, 49, '88.233.2.207'),
(137, 50, '88.233.2.207'),
(138, 49, '88.241.49.112'),
(139, 50, '95.70.207.135'),
(140, 50, '85.107.15.238'),
(141, 49, '85.98.18.50'),
(142, 49, '88.241.39.177'),
(143, 49, '159.146.18.181'),
(144, 49, '216.244.66.199'),
(145, 49, '77.88.5.37'),
(146, 49, '83.66.106.164'),
(147, 50, '78.180.14.111'),
(148, 50, '77.88.5.10'),
(149, 50, '88.243.141.173'),
(150, 50, '216.244.66.199'),
(151, 49, '85.104.210.81'),
(152, 50, '88.243.197.175'),
(153, 50, '85.104.210.81'),
(154, 49, '85.107.65.251'),
(155, 49, '46.2.231.185'),
(156, 50, '31.142.101.15'),
(157, 50, '88.240.249.27'),
(158, 49, '82.194.31.15'),
(159, 49, '78.174.77.137'),
(160, 49, '88.243.143.102'),
(161, 49, '188.3.112.137'),
(162, 50, '31.223.9.245'),
(163, 49, '31.223.9.245'),
(164, 49, '54.36.148.152'),
(165, 50, '54.36.148.6'),
(166, 49, '77.88.5.89'),
(167, 50, '207.46.13.15'),
(168, 49, '212.125.12.141'),
(169, 50, '77.88.5.228'),
(170, 49, '31.145.216.254'),
(171, 49, '85.104.53.221'),
(172, 50, '85.104.53.221'),
(173, 50, '46.1.26.82'),
(174, 50, '85.104.200.156'),
(175, 50, '95.14.55.28'),
(176, 50, '88.245.197.102'),
(177, 49, '88.245.197.102'),
(178, 49, '88.242.22.106'),
(179, 49, '212.154.4.195'),
(180, 49, '54.36.148.227'),
(181, 50, '54.36.148.176'),
(182, 49, '88.253.65.111'),
(183, 49, '54.36.149.55'),
(184, 50, '54.36.149.4'),
(185, 49, '185.191.171.34'),
(186, 50, '185.191.171.14'),
(187, 50, '88.253.67.28'),
(188, 49, '185.191.171.21'),
(189, 49, '31.223.11.99'),
(190, 50, '185.191.171.4'),
(191, 49, '54.36.148.249'),
(192, 50, '54.36.148.235'),
(193, 49, '31.223.11.195'),
(194, 49, '5.191.50.91'),
(195, 49, '5.25.140.229'),
(196, 50, '78.189.189.70'),
(197, 49, '157.55.39.36'),
(198, 50, '87.250.224.192'),
(199, 49, '54.36.148.136'),
(200, 50, '54.36.148.3'),
(201, 49, '88.243.198.29'),
(202, 50, '88.243.198.29'),
(203, 50, '185.191.171.33'),
(204, 49, '88.240.159.90'),
(205, 49, '89.205.128.194'),
(206, 50, '185.191.171.41'),
(207, 49, '54.36.148.70'),
(208, 50, '88.245.199.231'),
(209, 50, '54.36.148.83'),
(210, 49, '188.119.39.116'),
(211, 49, '78.171.177.84'),
(212, 49, '46.196.106.71'),
(213, 49, '162.55.85.221'),
(214, 50, '162.55.85.221'),
(215, 49, '95.10.17.234'),
(216, 49, '31.223.11.162'),
(217, 49, '54.36.148.243'),
(218, 50, '157.55.39.61'),
(219, 50, '31.206.141.1'),
(220, 50, '176.217.85.186'),
(221, 49, '87.250.224.13'),
(222, 50, '5.45.207.66'),
(223, 50, '54.36.149.92'),
(224, 50, '66.249.66.213'),
(225, 49, '5.45.207.94'),
(226, 50, '87.250.224.178'),
(227, 49, '31.223.49.208'),
(228, 50, '31.223.49.208'),
(229, 49, '185.191.171.18'),
(230, 50, '88.240.250.152'),
(231, 49, '46.221.74.148'),
(232, 49, '77.88.5.250'),
(233, 49, '176.216.103.241'),
(234, 49, '88.243.194.134'),
(235, 49, '46.221.246.77'),
(236, 49, '46.1.216.61'),
(237, 50, '88.243.194.134'),
(238, 49, '185.191.171.35'),
(239, 49, '54.36.148.62'),
(240, 49, '88.245.193.135'),
(241, 50, '54.36.148.203'),
(242, 49, '46.1.228.208'),
(243, 50, '46.1.228.208'),
(244, 49, '5.27.3.90'),
(245, 49, '88.230.175.158'),
(246, 50, '178.241.184.53'),
(247, 49, '176.165.247.247'),
(248, 49, '176.237.195.98'),
(249, 49, '176.88.92.154'),
(250, 49, '213.74.52.155'),
(251, 50, '213.74.52.155'),
(252, 50, '88.245.196.193'),
(253, 49, '88.245.196.193'),
(254, 49, '54.36.149.84'),
(255, 49, '31.223.10.249'),
(256, 50, '54.36.149.64'),
(257, 49, '88.241.45.151'),
(258, 50, '185.191.171.8'),
(259, 49, '5.178.12.57'),
(260, 49, '188.3.219.165'),
(261, 49, '34.107.92.109'),
(262, 50, '176.240.101.91'),
(263, 49, '54.36.148.37'),
(264, 49, '88.245.198.186'),
(265, 50, '54.36.149.40'),
(266, 50, '157.55.39.171'),
(267, 49, '54.36.149.0'),
(268, 50, '54.36.148.204'),
(269, 49, '85.111.77.29'),
(270, 50, '88.245.196.185'),
(271, 49, '31.223.48.192'),
(272, 49, '95.70.185.251'),
(273, 49, '151.135.165.109'),
(274, 49, '54.36.148.190'),
(275, 50, '46.106.223.12'),
(276, 49, '93.158.161.6'),
(277, 50, '93.158.161.35'),
(278, 50, '77.88.5.230'),
(279, 49, '77.88.5.36'),
(280, 49, '212.154.0.68'),
(281, 49, '95.70.175.196'),
(282, 50, '185.191.171.13'),
(283, 49, '54.36.149.37'),
(284, 50, '54.36.148.46'),
(285, 50, '54.36.148.91'),
(286, 50, '77.88.5.14'),
(287, 50, '78.182.132.94'),
(288, 49, '185.191.171.25'),
(289, 49, '213.14.173.223'),
(290, 50, '213.14.173.223'),
(291, 50, '88.240.251.207'),
(292, 51, '213.14.173.223'),
(293, 49, '54.36.148.83'),
(294, 49, '54.36.148.192'),
(295, 49, '54.36.148.26'),
(296, 50, '54.36.148.218'),
(297, 49, '54.36.148.23'),
(298, 50, '54.36.148.117'),
(299, 51, '93.158.161.53'),
(300, 51, '77.88.5.68'),
(301, 49, '93.158.161.44'),
(302, 51, '77.88.5.14'),
(303, 51, '185.191.171.40'),
(304, 50, '54.36.148.225'),
(305, 50, '78.164.208.95'),
(306, 51, '185.191.171.14'),
(307, 49, '176.237.196.178'),
(308, 51, '95.70.246.59'),
(309, 51, '54.36.148.104'),
(310, 50, '207.46.13.188'),
(311, 49, '37.130.78.75'),
(312, 51, '37.130.78.75'),
(313, 50, '54.36.148.4'),
(314, 49, '54.36.148.230'),
(315, 49, '54.36.148.48'),
(316, 50, '185.191.171.18'),
(317, 51, '85.104.55.87'),
(318, 51, '162.55.85.221'),
(319, 51, '159.146.5.176'),
(320, 51, '54.36.149.45'),
(321, 50, '185.191.171.7'),
(322, 50, '207.46.13.81'),
(323, 51, '88.230.236.106'),
(324, 49, '88.249.58.5'),
(325, 51, '88.243.199.142'),
(326, 51, '151.135.160.11'),
(327, 51, '185.191.171.44'),
(328, 51, '78.175.233.159'),
(329, 51, '54.36.148.157'),
(330, 50, '54.36.148.115'),
(331, 49, '54.36.148.248'),
(332, 51, '5.47.178.220'),
(333, 50, '207.46.13.28'),
(334, 49, '213.172.88.25'),
(335, 51, '85.98.192.193'),
(336, 51, '54.36.148.69'),
(337, 49, '185.191.171.16'),
(338, 51, '5.191.18.199'),
(339, 49, '185.191.171.8');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_isim` text NOT NULL,
  `kategori_slug` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_isim`, `kategori_slug`) VALUES
(7, 'Facebook', 'facebook'),
(8, 'Steam', 'steam');

-- --------------------------------------------------------

--
-- Table structure for table `kullanici`
--

CREATE TABLE `kullanici` (
  `k_id` int(11) NOT NULL,
  `k_isim` varchar(255) NOT NULL,
  `k_mail` varchar(255) NOT NULL,
  `k_sifre` varchar(255) NOT NULL,
  `k_tarih` varchar(255) NOT NULL,
  `k_adres` text DEFAULT NULL,
  `k_sehir` text DEFAULT NULL,
  `k_posta` text DEFAULT NULL,
  `k_tel` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kullanici`
--

INSERT INTO `kullanici` (`k_id`, `k_isim`, `k_mail`, `k_sifre`, `k_tarih`, `k_adres`, `k_sehir`, `k_posta`, `k_tel`) VALUES
(1, 'Ramazan Karaca', 'ramazankaraca5@gmail.com', '25f9e794323b453885f5181f1b624d0b', '28.07.2021', 'deneme', 'İstanbul', '34000', '05538849658'),
(6, 'METHOR', 'ayazdemirhd@gmail.com', '29b2b54f360329a606f600018be733cf', '21.09.2021', NULL, NULL, NULL, NULL),
(7, 'sefa', 'sefacanucan@gmail.com', '11973671a5964acea2bdbb8d01a7a639', '12.10.2021', NULL, NULL, NULL, NULL),
(8, 'deneme', 'deneme@deneme.com', '5eade53654dd51bb9493190cb1a651cd', '15.11.2021', NULL, NULL, NULL, NULL),
(9, 'furkan', 'aytar1147@gmail.com', '25f9e794323b453885f5181f1b624d0b', '04.12.2021', NULL, NULL, NULL, NULL),
(10, 'respectonline', 'respectonlayn@gmail.com', '5702cf27c87e1511d75869f6aa5d3198', '23.12.2021', NULL, NULL, NULL, NULL),
(11, '123123123', 's31a@gmail.com', 'f5bb0c8de146c67b44babbf4e6584cc0', '02.01.2022', NULL, NULL, NULL, NULL),
(12, 'test deneme', 'dene@mem.com', '25d55ad283aa400af464c76d713c07ad', '12.01.2022', 'adres yok', 'aydın', '06100', '02120987654');

-- --------------------------------------------------------

--
-- Table structure for table `mesaj`
--

CREATE TABLE `mesaj` (
  `mesaj_id` int(11) NOT NULL,
  `destek_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `mesaj_text` text CHARACTER SET utf8 NOT NULL,
  `mesaj_sontarih` text CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mesaj`
--

INSERT INTO `mesaj` (`mesaj_id`, `destek_id`, `kullanici_id`, `mesaj_text`, `mesaj_sontarih`) VALUES
(78, 20, 0, 'Selam :)', '11-09-2021 00:23:29'),
(71, 20, 1, 'SELAM ADMİNN', '11-09-2021 00:18:41'),
(98, 24, 12, 'merhaba', '12-01-2022 17:52:04');

-- --------------------------------------------------------

--
-- Table structure for table `satis`
--

CREATE TABLE `satis` (
  `satis_id` int(11) NOT NULL,
  `k_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `satis_bilgi` text CHARACTER SET utf8 NOT NULL,
  `satis_rand` text NOT NULL,
  `satis_durum` text NOT NULL,
  `satis_tarih` text NOT NULL,
  `satis_tarih2` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sayfa`
--

CREATE TABLE `sayfa` (
  `sayfa_id` int(11) NOT NULL,
  `sayfa_baslik` text NOT NULL,
  `sayfa_slug` text NOT NULL,
  `sayfa_aciklama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sayfa`
--

INSERT INTO `sayfa` (`sayfa_id`, `sayfa_baslik`, `sayfa_slug`, `sayfa_aciklama`) VALUES
(2, 'Şartlar & Koşullar', 'sartlar-kosullar', '<p>Şartlar ve <strong>Koşullar</strong></p>\r\n'),
(3, 'deneme', 'deneme', '<p>deneme</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `sss`
--

CREATE TABLE `sss` (
  `sss_id` int(11) NOT NULL,
  `sss_baslik` text NOT NULL,
  `sss_aciklama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sss`
--

INSERT INTO `sss` (`sss_id`, `sss_baslik`, `sss_aciklama`) VALUES
(3, 's', '<p><strong>deneme</strong></p>\r\n'),
(4, 'deneme', '<p>deneme</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `urun`
--

CREATE TABLE `urun` (
  `urun_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `urun_resim` text NOT NULL,
  `urun_isim` varchar(255) NOT NULL,
  `urun_fiyat` varchar(255) NOT NULL,
  `urun_views` varchar(255) NOT NULL,
  `urun_satis` varchar(255) NOT NULL,
  `urun_aciklama` text NOT NULL,
  `urun_anahtar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `urun`
--

INSERT INTO `urun` (`urun_id`, `kategori_id`, `urun_resim`, `urun_isim`, `urun_fiyat`, `urun_views`, `urun_satis`, `urun_aciklama`, `urun_anahtar`) VALUES
(49, 7, 'assets/images/product/213792493222331298969317ccaffacebook.jpg', 'Facebook Hesap', '10', '131', '0', '<p>Facebook hesap</p>\r\n', '1'),
(50, 8, 'assets/images/product/29504319402647721293co-to-jest-steam11.jpg', 'Steam Key', '25', '102', '0', '<p>steam key</p>\r\n', '0'),
(51, 7, 'assets/images/product/24560305682462428821images.jpeg', 'instagram', '35', '23', '0', '<p>instagram</p>\r\n', '1');

-- --------------------------------------------------------

--
-- Table structure for table `yonetici`
--

CREATE TABLE `yonetici` (
  `kullanici_id` int(11) NOT NULL,
  `kullanici_mail` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_password` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `yonetici`
--

INSERT INTO `yonetici` (`kullanici_id`, `kullanici_mail`, `kullanici_password`) VALUES
(147, 'deneme@deneme.com', '25f9e794323b453885f5181f1b624d0b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anahtar`
--
ALTER TABLE `anahtar`
  ADD PRIMARY KEY (`key_id`);

--
-- Indexes for table `ayar`
--
ALTER TABLE `ayar`
  ADD PRIMARY KEY (`ayar_id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `blog_ip`
--
ALTER TABLE `blog_ip`
  ADD PRIMARY KEY (`ip_id`);

--
-- Indexes for table `destek`
--
ALTER TABLE `destek`
  ADD PRIMARY KEY (`destek_id`);

--
-- Indexes for table `hesap`
--
ALTER TABLE `hesap`
  ADD PRIMARY KEY (`hesap_id`);

--
-- Indexes for table `ipadress`
--
ALTER TABLE `ipadress`
  ADD PRIMARY KEY (`ip_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`k_id`);

--
-- Indexes for table `mesaj`
--
ALTER TABLE `mesaj`
  ADD PRIMARY KEY (`mesaj_id`);

--
-- Indexes for table `satis`
--
ALTER TABLE `satis`
  ADD PRIMARY KEY (`satis_id`);

--
-- Indexes for table `sayfa`
--
ALTER TABLE `sayfa`
  ADD PRIMARY KEY (`sayfa_id`);

--
-- Indexes for table `sss`
--
ALTER TABLE `sss`
  ADD PRIMARY KEY (`sss_id`);

--
-- Indexes for table `urun`
--
ALTER TABLE `urun`
  ADD PRIMARY KEY (`urun_id`);

--
-- Indexes for table `yonetici`
--
ALTER TABLE `yonetici`
  ADD PRIMARY KEY (`kullanici_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anahtar`
--
ALTER TABLE `anahtar`
  MODIFY `key_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `blog_ip`
--
ALTER TABLE `blog_ip`
  MODIFY `ip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `destek`
--
ALTER TABLE `destek`
  MODIFY `destek_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `hesap`
--
ALTER TABLE `hesap`
  MODIFY `hesap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `ipadress`
--
ALTER TABLE `ipadress`
  MODIFY `ip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=340;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `k_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mesaj`
--
ALTER TABLE `mesaj`
  MODIFY `mesaj_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `satis`
--
ALTER TABLE `satis`
  MODIFY `satis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `sayfa`
--
ALTER TABLE `sayfa`
  MODIFY `sayfa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sss`
--
ALTER TABLE `sss`
  MODIFY `sss_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `urun`
--
ALTER TABLE `urun`
  MODIFY `urun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `yonetici`
--
ALTER TABLE `yonetici`
  MODIFY `kullanici_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
