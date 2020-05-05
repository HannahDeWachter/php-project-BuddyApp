-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2020 at 08:20 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

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
-- Table structure for table `buddy`
--

CREATE TABLE `buddy` (
  `id` int(11) NOT NULL,
  `user1_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buddy`
--

INSERT INTO `buddy` (`id`, `user1_id`, `user2_id`) VALUES
(373, 23, 24),
(384, 24, 23),
(385, 24, 3),
(406, 24, 25),
(407, 2, 23),
(414, 24, 0);

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` varchar(1000) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `timestamp`, `status`) VALUES
(100, 23, 24, 'qjfdksql', '2020-05-01 14:02:46', 0),
(102, 23, 24, 'qjfdksql', '2020-05-01 14:02:49', 0),
(109, 24, 23, 'yow', '2020-05-01 14:31:04', 0),
(110, 24, 23, 'yow', '2020-05-01 14:31:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `message_like`
--

CREATE TABLE `message_like` (
  `like_id` int(11) NOT NULL,
  `msg_id_fk` int(11) DEFAULT NULL,
  `user_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imdYear` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profileImg` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `music` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hobbies` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialization` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travel` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--


INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `imdYear`, `profileImg`, `bio`, `location`, `music`, `hobbies`, `specialization`, `travel`, `last_activity`) VALUES
(3, 'Hannah', 'De Wachter', 'test@student.thomasmore.be', '$2y$14$2ddLPQ4HrcX9Koi1pshRbeiyL7S2d4N6cvijQq/rthxf3aS23k4W.', NULL, NULL, '', 'Mechelen', 'pop,rock', 'party,instrument', 'design', 'asia,europe', '2020-04-18 14:21:12'),
(4, 'Hannah', 'De Wachter', 'r0738008@student.thomasmore.be', '$2y$14$wBz16sHTgYcczv3a5Gv.PO6tySu9Rmsv5RM3BlsJdfyILEuxG5ab6', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2020-04-18 14:21:12'),
(8, 'hallo', 'jij', 'hallo@student.thomasmore.be', '$2y$14$sXbEW7Q9dxt1XtF3BxDTKuA4nt.dupmLLPBA.VjAm2zYyaE0amOJe', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2020-04-18 14:21:12'),
(11, 'rest', 'rest', 're@student.thomasmore.be', '$2y$14$6WNRRpNfI/F1Gy1VCkiIJex9UAlZ1WXiGJT5dXNxZhPAGbZjOC89W', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2020-04-18 14:21:12'),
(25, 'Tom', 'Aat', 'r789@student.thomasmore.be', '$2y$14$I..r4F2mfgAwGOyGUDpygeLeUGXqkvJvLV5TGat15BLf.ln.HGRoq', '', 'IMG_20190411_102920.jpg', NULL, 'Mechelen', 'rock,rap,other', 'paint,sport', 'design', 'america,europe', '2020-04-18 14:21:12'),
(23, 'Ik', 'ben', 'r456@student.thomasmore.be', '$2y$14$3.2.8.fAO36ZUStR7HqRYeOzlTJcKPuLMo.uYCoUtKCCEJhT5ACZy', '', 'IMG_20180916_120730.jpg', 'hldjqskl\r\nfjdkqslm', 'Keerbergen', 'rock,rap,jazz', 'party,instrument', 'design', 'europe', '2020-04-18 14:21:12'),
(24, 'test', 'hallo', 'r123@student.thomasmore.be', '$2y$14$eUwraib2bMo87j9Ks/o3PeYZoDcmTlzV6iN2Qo7stu02bfBEPhfby', '', NULL, NULL, '&lt;br /&gt;&lt;b&gt;Notice&lt;/b&gt;:  Undefined index: location in &lt;b&gt;C:\\xampp\\htdocs\\test\\php-project-BuddyApp\\profileDetails.php&lt;/b&gt; on line &lt;b&gt;60&lt;/b&gt;&lt;br /&gt;', 'pop,rock,disco', 'sport,party', 'design', 'europe', '2020-04-18 14:21:12'),
(26, 'si', 'mon', 'si@student.thomasmore.be', '$2y$14$vK4qJhwSrUdRutQVSb3qUuSbUDoChPP2Qvdhufa5fnzj2UWJoWJPy', '2IMD', 'IMG_20180915_200625.jpg', 'hallo ', 'Mechelen', 'rock,rap,jazz', 'to paint,sport,to party', 'design', 'europe', '2020-04-18 14:21:12'),
(28, 'ni', 'euwe', 'nieuw@student.thomasmore.be', '$2y$14$xbcWSD8OsCOL0y46EORq3OpIUYkW73OfnRCnFBrC60OXUZSswZ0cG', '2IMD', NULL, 'hallo ik ben simon', 'Mechelen', 'rock,rap,jazz', 'to paint,sport,to party', 'design', 'europe', '2020-04-18 14:21:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buddy`
--
ALTER TABLE `buddy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `message_like`
--
ALTER TABLE `message_like`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buddy`
--
ALTER TABLE `buddy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=415;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `message_like`
--
ALTER TABLE `message_like`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
