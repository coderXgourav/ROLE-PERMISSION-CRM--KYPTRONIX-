-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 12, 2024 at 07:29 AM
-- Server version: 10.11.8-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u729855735_new_crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `username`, `password`, `otp`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', '1234', '2587', '1', NULL, '2023-08-23 07:31:11');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_number` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `msg` text DEFAULT NULL,
  `task` varchar(255) NOT NULL DEFAULT '0',
  `team_member` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_number`, `customer_email`, `msg`, `task`, `team_member`, `status`, `created_at`, `updated_at`) VALUES
(286, 'Gourav', '+916296665907', 'gourav.kyptronix@gmail.com', 'test', '0', '2', '1', '2023-08-10 05:22:45', '2023-08-10 05:23:05'),
(288, 'Ryan Moeller', '+116122294531', 'ryan@aibe.cool', 'Call Back', '0', NULL, '1', '2023-08-25 20:30:58', '2023-08-25 20:30:58'),
(289, 'Doble', '+1 (218) 779 1868', 'heidipooch@msn.com', '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(290, 'Krupa', '+1 (715) 688 2863', NULL, '7000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(291, 'Crosthwaite', '+1 (320) 252 3943', 'magsworld@live.com', '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(292, 'Rice', NULL, 'comfortrice2@gmail.com', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(293, 'Strang', '+1 (218) 839 5353', NULL, '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(294, 'Lauseng', '+1 (218) 744 5855', NULL, '25000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(295, 'Worm', '+1 (952) 467 3397', 'nyafoodshelf@gmail.com', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(296, 'Hesley', '+1 (763) 263 0915', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(297, 'Scheffert', '-1086881132', NULL, '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(298, 'Schuelke', '1827785282', 'scheulkemaddog@q.com', '27286.63', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(299, 'Wymer', '+1 (763) 757 5978', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(300, 'Toulou', '+1 (507) 454 1511', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(301, 'Strand', '-2077363305', 'jonelledraughn@yahoo.com', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(302, 'Rice', '+1 (763) 843 5520', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(303, 'Olson', '+1 (218) 444 8304', NULL, '10002', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(304, 'Nilsson', '+1 (320) 229 8771', 'dfnilsson7@gmail.com', '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(305, 'Mansicka', '+1 (320) 398 8811', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(306, 'Taylor', '+1 (763) 377 0660', 'lawandataylor54@yahoo.com', '10422', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(307, 'Nelson', '+1 (641) 201 1051', 'nelsons725@gmail.com', '50000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(308, 'Court', '+1 (320) 252 0448', NULL, '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(309, 'Dugger', '+1 (307) 240 0435', NULL, '5001', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(310, 'Rivard', '+1 (763) 434 5977', NULL, '7000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(311, 'Schlotfeldt', '+1 (320) 240 9064', 'rocktere58@gmail.com', '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(312, 'Kaster', '+1 (218) 744 5855', NULL, '25000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(313, 'Gregory', '+1 (612) 270 2778', 'dmg1256@gmail.com', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(314, 'Gageby', '+1 (320) 980 5219', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(315, 'Malpert', '+1 (701) 212 6208', 'joycemalpert@hotmail.com', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(316, 'Olberg', '+1 (218) 263 8640', NULL, '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(317, 'Lindee', '+1 (320) 510 2882', NULL, '7000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(318, 'Collins', '+1 (763) 753 1133', NULL, '35000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(319, 'Agan', '+1 (218) 256 5946', NULL, '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(320, 'Jarvi', '-2110986225', NULL, '49093', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(321, 'Braud', '+1 (218) 736 2043', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(322, 'Eastgate', '+1 (320) 424 2393', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(323, 'Kremers', '+1 (320) 356 9816', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(324, 'Peterson', '+1 (320) 834 5015', 'retka105@rea-alp.com', '20000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(325, 'Pedersen', '+1 (651) 787 0488', 'pedersen.evie@yahoo.com', '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(326, 'Hansen', '+1 (763) 203 1275', 'sandyjhansen54@yahoo.com', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(327, 'Kaufmann', '+1 (952) 467 2425', NULL, '25000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(328, 'Mitchell', '+1 (763) 568 6837', 'rnrmitchell3@aol.com', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(329, 'Lauseng', '+1 (218) 248 5727', NULL, '25000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(330, 'Lister', '-952258402', 'golly50@hotmail.com', '20000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(331, 'Kack', NULL, 'maryann56308@gmail.com', '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(332, 'Kack', '+1 (320) 304 4475', 'emilkackjr@gmail.com', '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(333, 'Gross', '+1 (320) 248 8334', 'retired551@hotmail.com', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(334, 'Kaiser', '+1 (952) 440 6167', 'jkmenke11@gmail.com', '50000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(335, 'Kaiser', '+1 (952) 440 6167', 'rorykaiser0@gmail.com', '60000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(336, 'Hansen', '+1 (763) 203 1275', 'sandyjhansen54@yahoo.com', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(337, 'Collette', '+1 (763) 421 9226', NULL, '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(338, 'Oleson', '+1 (612) 328 4541', 'compaqpreole@live.com', '20000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(339, 'Mayes-Okerstrom', '+1 (320) 685 0011', 'snj10398@aol.com', '20000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(340, 'Riebel', '+1 (763) 755 7265', NULL, '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(341, 'Williams', '+1 (218) 749 1090', 'dlwilliams@traveltags.com', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(342, 'Plemel', '+1 (218) 831 8418', NULL, '35000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(343, 'Henkel', '+1 (320) 230 0473', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(344, 'Nelson', '+1 (612) 998 3043', NULL, '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(345, 'Erickson', '+1 (715) 246 7832', NULL, '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(346, 'Kaster', '+1 (218) 744 5855', NULL, '25000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(347, 'Pearson', '+1 (218) 739 9618', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(348, 'Gundlach', '+1 (215) 692 3657', 'marygundlach@gmail.com', '15004', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(349, 'Becker', '+1 (701) 235 5550', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(350, 'Rindfuss', '+1 (218) 404 6364', 'donr2015@gmail.com', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(351, 'Johnson', '+1 (320) 743 5100', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(352, 'Hocking', '+1 (218) 969 6761', NULL, '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(353, 'Henkel', '+1 (320) 230 0473', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(354, 'Hansen', '+1 (320) 685 3167', NULL, '30000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(355, 'Mitchell', '+1 (763) 447 1274', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(356, 'Olson', '+1 (718) 444 8304', 'donduck@paulbunyan.net', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(357, 'Strang', '+1 (218) 839 0394', NULL, '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(358, 'Adams', '+1 (218) 444 6895', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(359, 'Green', '+1 (657) 224 3267', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(360, 'Pederson', '+1 (218) 414 0557', 'crispygoddess84@gmail.com', '20000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(361, 'Jackson', '-1092368679', 'miaandpapa1958@gmail.com', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(362, 'Gibson', '+1 (320) 632 2126', 'hurlgibb@yahoo.com', '25000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(363, 'Gerads', '+1 (320) 251 9483', 'quiltingmom2299@yahoo.com', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(364, 'Snook', '+1 (320) 219 1791', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(365, 'Leen', '+1 (320) 352 6755', NULL, '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(366, 'Wright', '+1 (218) 556 4659', 'winterowd75@msn.com', '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(367, 'Stierlen', '+1 (320) 960 8635', NULL, '13373', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(368, 'Rindfuss', '+1 (218) 290 2769', 'bonetoj@msn.com', '10305', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(369, 'Nelsen', '+1 (218) 393 7584', NULL, '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(370, 'Miller', '+1 (218) 751 5739', NULL, '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(371, 'Jantzen', '+1 (218) 393 2338', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(372, 'Thorsen', '+1 (218) 675 5262', 'negril@tds.net', '20000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(373, 'Adamson', '+1 (218) 751 8316', 'sweetsongbird2@gmail.com', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(374, 'Scheulke', '-957476654', 'pshgk@q.com', '25000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(375, 'Erickson', '+1 (715) 246 7832', NULL, '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(376, 'McQueen', '+1 (218) 744 2544', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(377, 'Petterson', '+1 (218) 410 9627', 'joe_petterson76@yahoo.com', '25000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(378, 'Trosvig', '+1 (218) 736 2520', NULL, '20000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(379, 'Matich', '+1 (218) 829 8012', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(380, 'Green', '+1 (763) 442 4449', 'alsagreen@yahoo.com', '20000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(381, 'Skrzypek', '+1 (936) 230 7151', 'skrzypekjudy@gmail.com', '14000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(382, 'Mitchell', '+1 (763) 447 1274', NULL, '5436', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(383, 'Fuller', '+1 (763) 434 3481', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(384, 'Gibbs', '+1 (763) 323 6733', 'yvonnegibbs45@gmail.com', '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(385, 'Estlick', '+1 (218) 731 5773', NULL, '13805', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(386, 'Nelson', '+1 (218) 739 2483', NULL, '7000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(387, 'Evans', '+1 (218) 731 0863', NULL, '7500', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(388, 'Viche', '+1 (218) 727 4915', NULL, '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(389, 'Miller', '+1 (218) 751 5739', NULL, '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(390, 'Losey', '-1092794042', NULL, '12084', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(391, 'Johnson', '+1 (320) 243 5100', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(392, 'Daiker', '+1 (320) 260 5375', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(393, 'Hansen', '+1 (218) 327 1817', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(394, 'Durant', '+1 (320) 249 4517', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(395, 'Benson', '+1 (218) 821 7209', NULL, '20000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(396, 'Sterling', '+1 (218) 831 4512', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(397, 'Olson', '-1091366134', 'jadholson@gmail.com', '20000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(398, 'Leen', '-1091440541', NULL, '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(399, 'Weed', '+1 (507) 276 7224', 'umkraut@gmail.com', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(400, 'Schelinder', '+1 (219) 729 7953', 'roonietoons@gmail.com', '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(401, 'Swenson', '+1 (218) 751 8888', 'dp_swenson@yahoo.com', '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(402, 'McLeod', '+1 (320) 219 7722', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(403, 'Brostorm', '+1 (218) 591 3088', NULL, '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(404, 'Wenning', '+1 (320) 845 4188', 'cjwenning@albanytel.com', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(405, 'Burdick', '+1 (218) 333 8591', NULL, '2000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(406, 'Ford', '+1 (320) 493 9404', 'dhurttgam69@gmail.com', '7500', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(407, 'Fernandez Marfori', '+1 (320) 251 7344', NULL, '20000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(408, 'Huber', '+1 (218) 839 1696', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(409, 'Marohn', '+1 (320) 828 1896', 'dcm194344@gmail.com', '25000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(410, 'Ramacher', '+1 (963) 843 1186', NULL, '20000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(411, 'Henderson', '+1 (218) 731 5894', 'wandahen90@gmail.com', '20000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(412, 'Mitchell', '+1 (763) 568 6837', 'rnrmitchell3@aol.com', '8324', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(413, 'Jarvi', NULL, NULL, '75000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(414, 'Cruz', '+1 (320) 292 2794', NULL, '25000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(415, 'Magnuson', '+1 (320) 352 5655', 'kevin@mainstreetcom.com', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(416, 'Gregory', '+1 (612) 270 2778', 'jgregory.ump22@gmail.com', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(417, 'Braun', '+1 (320) 393 3736', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(418, 'Gibbs', '+1 (763) 323 6733', 'yvonnegibbs45@gmail.com', '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(419, 'Shelstad', '+1 (218) 831 8142', NULL, '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(420, 'Gibson', '+1 (320) 632 2126', 'hurlgibb@yahoo.com', '25000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(421, 'Berglund', NULL, NULL, '10015', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(422, 'Berglund', '+1 (320) 491 0734', NULL, '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(423, 'Patton', '+1 (320) 282 6771', 'lindarybakpatton@gmail.com', '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(424, 'Stenger', '+1 (320) 252 5341', NULL, '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(425, 'Willman', '+1 (218) 393 9937', NULL, '2000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(426, 'Rumreich', '+1 (763) 434 9406', 'rsrum50reich45@quixnet.net', '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(427, 'Frantz', NULL, 'Healingenergies@icloud.com', '20000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(428, 'Olmscheid', '-1092460770', NULL, '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(429, 'Olson', '+1 (218) 236 9902', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(430, 'Unger', '+1 (218) 743 3525', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(431, 'Gosch', '+1 (320) 759 2040', NULL, '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(432, 'Krueger', '+1 (320) 815 1897', 'eriknaaronsmom@yahoo.com', '5000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(433, 'Green', '+1 (651) 224 3267', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(434, 'Woudsma', '+1 (218) 829 0184', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(435, 'Atkins', NULL, NULL, '25000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(436, 'Braud', '+1 (218) 736 3043', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(437, 'Delles', '+1 (320) 859 5658', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(438, 'Kremers', '+1 (320) 356 9816', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(439, 'Gustafson', '+1 (218) 929 2836', 'togus2@yahoo.com', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(440, 'Glidden', '+1 (218) 444 6812', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(441, 'Gaul', '+1 (216) 428 4777', NULL, '20000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(442, 'Gray', NULL, NULL, '75000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(443, 'Sanguma', '+1 (218) 831 8418', 'kelli.plemel@centracare.com', '26538', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(444, 'Gillespie', '+1 (218) 838 2561', NULL, '5365', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(445, 'Joyce', NULL, 'joycebev0@gmail.com', '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(446, 'Rytty', '-2110922568', NULL, '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(447, 'Delles', '+1 (320) 859 5658', NULL, '10615', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(448, 'Sundblad', '+1 (320) 759 2363', NULL, '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(449, 'Lutz', '+1 (651) 325 7554', '5455katie@gmail.com', '15000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(450, 'Burdick', '+1 (218) 333 8591', NULL, '3000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(451, 'Steele', '+1 (218) 444 3993', 'BurrBurr1929@gmail.com', '10000', '0', '4', '1', '2023-08-29 21:37:18', '2024-03-15 17:34:41'),
(452, 'Estlick', '+1 (218) 731 5773', NULL, '10000', '0', NULL, '1', '2023-08-29 21:37:18', '2023-08-29 21:37:18'),
(453, 'Dawson', '+1 (763) 227 3153', NULL, '10000', '0', '3', '1', '2023-08-29 21:37:18', '2024-01-19 12:18:40'),
(454, 'Gourav Swarnakar', '+916296665907', 'gourav@gmail.com', 'test', '0', NULL, '1', '2023-09-12 11:08:04', '2023-09-12 11:08:04'),
(456, 'Gourav Swarnakar', '+106296665907', 'test@gmail.com', 'test', '0', NULL, '1', '2024-02-07 13:12:37', '2024-02-07 13:12:37'),
(457, 'Indranil', '+916296665907', 'test@gmail.com', 'customer looking for aco', '1', '3', '1', '2024-02-07 13:23:47', '2024-03-15 17:33:42'),
(458, 'Sourav', '+919593636434', 'sourav@gmail.com', 'looking for website', '1', '5', '1', '2024-02-07 13:24:20', '2024-02-07 13:24:20'),
(460, 'Gourav Swarnakar', '+916296665907', 'test@gmail.com', 'customer looking for aco', '1', '4', '1', '2024-02-07 13:58:37', '2024-02-07 13:58:37');

-- --------------------------------------------------------

--
-- Table structure for table `email_send`
--

CREATE TABLE `email_send` (
  `email_id` bigint(20) UNSIGNED NOT NULL,
  `email_customer` varchar(255) DEFAULT NULL,
  `email_admin` varchar(255) DEFAULT NULL,
  `email_text` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_send`
--

INSERT INTO `email_send` (`email_id`, `email_customer`, `email_admin`, `email_text`, `created_at`, `updated_at`) VALUES
(5, '29', '6', '<p>&quot;Hello,</p>\r\n\r\n<p>I am looking for a 1BHK room in Kolkata. If you have any available options or information, please let me know.</p>\r\n\r\n<p>Thank you</p>', '2023-06-23 05:21:51', '2023-06-23 05:21:51'),
(6, '43', '2', '<p><strong>Subject: Request for Holiday during&nbsp;</strong></p>\n\n<p>Dear Kaliyaganj School Administration,</p>\n\n<p>I hope this email finds you well. I am writing to request a holiday for my child, [Child&#39;s Name], who is enrolled in [Grade/Class] at your esteemed institution.</p>\n\n<p><em><strong>During the period from [Start Date] to [End Date], we have planned a family vacation/trip. It would be greatly appreciated if my child could be granted leave for this duration. We understand the importance of regular attendance and do not take this request lightly. However, we believe that this trip presents a unique opportunity for [Child&#39;s Name] to experience and learn outside of the classroom setting.</strong></em></p>\n\n<p>I would like to assure you that we will make every effort to minimize the impact on my child&#39;s education by ensuring that all missed assignments and coursework are completed upon our return. We understand the value of education and will make it a priority to catch up on any missed lessons.</p>\n\n<p>If it is possible to grant this holiday for [Child&#39;s Name], I would be grateful for your consideration and understanding. Please let us know if any further documentation or information is required from our end.</p>\n\n<p>Thank you for your attention to this matter. We have great respect for the educational policies and guidelines of [School Name], and we look forward to your positive response.</p>\n\n<p>Best regards,</p>\n\n<p><strong>Gourav</strong><br />\n&nbsp;</p>', '2023-06-27 13:15:43', '2023-06-27 13:15:43'),
(7, '266', '2', '<p><strong>test</strong></p>', '2023-07-02 11:37:21', '2023-07-02 11:37:21'),
(8, '286', '2', '<p>hello gourav , good morning</p>', '2023-08-11 05:25:43', '2023-08-11 05:25:43'),
(9, '286', '2', '<p>hello</p>', '2023-08-11 08:46:46', '2023-08-11 08:46:46'),
(10, '455', '2', '<p>&nbsp; &nbsp; &nbsp;&nbsp;</p>', '2023-12-01 10:16:51', '2023-12-01 10:16:51'),
(11, '455', '2', '<p>&nbsp; &nbsp; &nbsp;&nbsp;</p>', '2023-12-01 10:16:58', '2023-12-01 10:16:58');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messages_id` bigint(20) UNSIGNED NOT NULL,
  `team_member_id` varchar(255) DEFAULT NULL,
  `customer_msg_id` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messages_id`, `team_member_id`, `customer_msg_id`, `message`, `created_at`, `updated_at`) VALUES
(1, '2', '37', 'hello brother', '2023-06-27 04:24:02', '2023-06-27 04:24:02'),
(2, '2', '37', 'hello good afternoon gourav', '2023-06-27 06:20:03', '2023-06-27 06:20:03'),
(3, '2', '43', 'hello , testing msg', '2023-06-27 07:23:18', '2023-06-27 07:23:18'),
(4, '2', '266', 'test', '2023-07-02 11:48:50', '2023-07-02 11:48:50'),
(5, '2', '37', 'hello sob thik', '2023-08-08 10:39:26', '2023-08-08 10:39:26'),
(6, '2', '37', 'hi', '2023-08-08 11:31:17', '2023-08-08 11:31:17'),
(7, '2', '286', 'hello gourav , good morning', '2023-08-11 05:24:18', '2023-08-11 05:24:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_06_12_082038_create_admin_table', 2),
(10, '2023_06_16_070311_create_customer_table', 4),
(12, '2023_06_20_102016_create_email_send_table', 5),
(13, '2023_06_14_081537_create_user_table', 6),
(14, '2023_06_27_094631_create_messages_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `otp` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `country_code`, `phone_number`, `email`, `dob`, `password`, `status`, `otp`, `created_at`, `updated_at`) VALUES
(2, 'Gourav Swarnakar', NULL, '6296665907', 'team@gmail.com', NULL, '1234', '1', NULL, '2023-06-27 02:47:07', '2023-06-28 17:36:14'),
(3, 'John Walter', '+91', '9748086104', 'iroy2809@gmail.com', NULL, 'Indra@2703', '1', NULL, '2024-01-19 12:18:20', '2024-01-19 12:18:20'),
(4, 'test', '+1', '6296665970', 'gourav@gmail.com', NULL, '1234', '1', NULL, '2024-02-07 13:09:29', '2024-02-07 13:09:29'),
(5, 'Harry Brown', '+1', '9593636434', 'harry@gmail.com', NULL, '1234', '1', NULL, '2024-02-07 13:19:19', '2024-02-07 13:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `email_send`
--
ALTER TABLE `email_send`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messages_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=461;

--
-- AUTO_INCREMENT for table `email_send`
--
ALTER TABLE `email_send`
  MODIFY `email_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messages_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
