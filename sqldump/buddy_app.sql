-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 03 apr 2020 om 11:47
-- Serverversie: 10.4.10-MariaDB
-- PHP-versie: 7.3.12

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
-- Tabelstructuur voor tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(300) NOT NULL,
  `lastname` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `imdYear` varchar(300) NOT NULL,
  `location` varchar(300) DEFAULT NULL,
  `music` varchar(300) DEFAULT NULL,
  `hobbies` varchar(300) DEFAULT NULL,
  `specialization` varchar(300) DEFAULT NULL,
  `travel` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `imdYear`, `location`, `music`, `hobbies`, `specialization`, `travel`) VALUES
(1, 'klowi', 'graphicdesign', 'r0614748@student.thomasmore.be', '$2y$14$3JzbmeYlMh6/MqZJFFzip.O/zGjDDmsGrHasX.Pugqj1Xx.MnskM2', '3IMD', NULL, NULL, NULL, NULL, NULL),
(2, 'john', 'doe', 'klowi@student.thomasmore.be', '$2y$14$6NSV7Vvpt7JAH1Q8efS3BuwZ7p3xo0nuPYfnV1Bal/Ao0X6cVQW9i', '1IMD', NULL, NULL, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
