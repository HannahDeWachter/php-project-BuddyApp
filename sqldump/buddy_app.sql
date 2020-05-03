-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 19, 2020 at 10:57 AM
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
-- Table structure for table `matched`
--

DROP TABLE IF EXISTS `matched`;
CREATE TABLE IF NOT EXISTS `matched` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user1_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user2_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `deny_reason` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `matched`
--

INSERT INTO `matched` (`id`, `user1_id`, `user2_id`, `status`, `deny_reason`) VALUES
(1, '1', '2', 'chat', NULL),
(2, '3', '4', 'verzoek', NULL),
(3, '5', '7', 'buddies', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(300) NOT NULL,
  `lastname` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `imdYear` varchar(300) DEFAULT NULL,
  `location` varchar(300) DEFAULT NULL,
  `music` varchar(300) DEFAULT NULL,
  `hobbies` varchar(300) DEFAULT NULL,
  `specialization` varchar(300) DEFAULT NULL,
  `travel` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `imdYear`, `location`, `music`, `hobbies`, `specialization`, `travel`) VALUES
(1, 'klowi', 'graphicdesign', 'r0614748@student.thomasmore.be', '$2y$14$3JzbmeYlMh6/MqZJFFzip.O/zGjDDmsGrHasX.Pugqj1Xx.MnskM2', 'buddy', 'Lier', 'rap,jazz', NULL, NULL, NULL),
(2, 'john', 'doe', 'klowi@student.thomasmore.be', '$2y$14$6NSV7Vvpt7JAH1Q8efS3BuwZ7p3xo0nuPYfnV1Bal/Ao0X6cVQW9i', 'buddyZoek', 'Mechelen', 'disco', NULL, NULL, NULL),
(3, 'Hannah', 'De Wachter', 'r0738008@student.thomasmore.be', '$2y$14$NJ12xOnPmTQepwDLsEXUWe0G4TFIXXDtVfjI.O2eHdrIgMGZ2ZWoW', 'buddy', 'Mechelen', 'pop,rock,disco,rap,techno,dnb,indie,jazz,rnb,other', 'to paint,sport,to party,to play an instrument,to read,other', 'design', 'africa,america,asia,europe,oceania'),
(4, 'Test', 'Test', 'test@student.thomasmore.be', '$2y$14$DP2meJVU7irlUhLLyNbfc.85EHjOzxd83Kk9TzhDNXCYW/pLo87XC', 'buddyZoek', 'Mechelen', 'pop,rap,indie', 'to paint,to party,to play an instrument', 'dev', 'europe'),
(5, 'blub', 'blub', 'blub@student.thomasmore.be', '$2y$14$3zjb4AZasJV0ZtWHzsom4OxnpHrZR4NLcqNbNTUtp1vFzXOldBxU2', 'buddy', 'Leuven', 'pop,disco,indie,jazz', 'sport,to read', 'both', 'africa,asia,europe'),
(7, 'Jos', 'Joske', 'jos@student.thomasmore.be', '$2y$14$eFZpYRkcCIX66lct/c3X.OPZbyycrvyjvcLiQLQOj/y.2jGXkng.S', 'buddy', 'Leuven', 'techno', 'to paint', 'both', 'europe');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
