-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Mar 31, 2020 at 10:18 AM
-- Server version: 5.7.28
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buddy_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imdYear` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profileImg` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` VARCHAR(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `music` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hobbies` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialization` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travel` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `imdYear`, `profileImg`, `bio`, `location`, `music`, `hobbies`, `specialization`, `travel`) VALUES
(3, 'Hannah', 'De Wachter', 'test@student.thomasmore.be', '$2y$14$2ddLPQ4HrcX9Koi1pshRbeiyL7S2d4N6cvijQq/rthxf3aS23k4W.', NULL, NULL, NULL, 'Mechelen', 'pop,rock', 'party,instrument', 'design', 'asia,europe'),
(4, 'Hannah', 'De Wachter', 'r0738008@student.thomasmore.be', '$2y$14$wBz16sHTgYcczv3a5Gv.PO6tySu9Rmsv5RM3BlsJdfyILEuxG5ab6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'hallo', 'jij', 'hallo@student.thomasmore.be', '$2y$14$sXbEW7Q9dxt1XtF3BxDTKuA4nt.dupmLLPBA.VjAm2zYyaE0amOJe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'rest', 'rest', 're@student.thomasmore.be', '$2y$14$6WNRRpNfI/F1Gy1VCkiIJex9UAlZ1WXiGJT5dXNxZhPAGbZjOC89W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
COMMIT;

DROP TABLE IF EXISTS `buddy`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_ id` int(11) NOT NULL,
  `message_text` text NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
