-- -- phpMyAdmin SQL Dump
-- -- version 4.8.3
-- -- https://www.phpmyadmin.net/
-- --
-- -- Host: localhost:3306
-- -- Generation Time: Mar 30, 2020 at 01:25 PM
-- -- Server version: 5.7.24-log
-- -- PHP Version: 7.1.20

-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- SET AUTOCOMMIT = 0;
-- START TRANSACTION;
-- SET time_zone = "+00:00";


-- /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
-- /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
-- /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
-- /*!40101 SET NAMES utf8mb4 */;

-- --
-- -- Database: `buddy_app`
-- --

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `users`
-- --

-- CREATE TABLE `users` (
--   `id` int(11) NOT NULL,
--   `firstname` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `lastname` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `email` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `location` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `music` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `hobbies` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `specialization` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `profileImage` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
-- ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --
-- -- Indexes for dumped tables
-- --

-- --
-- -- Indexes for table `users`
-- --
-- ALTER TABLE `users`
--   ADD PRIMARY KEY (`id`);

-- --
-- -- AUTO_INCREMENT for dumped tables
-- --

-- --
-- -- AUTO_INCREMENT for table `users`
-- --
-- ALTER TABLE `users`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
-- COMMIT;

-- /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
-- /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
-- /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 30, 2020 at 03:07 PM
-- Server version: 5.7.24-log
-- PHP Version: 7.1.20

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

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `music` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hobbies` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialization` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profileImage` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
