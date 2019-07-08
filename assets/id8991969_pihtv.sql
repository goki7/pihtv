-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 08, 2019 at 03:47 PM
-- Server version: 10.3.14-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id8991969_pihtv`
--
CREATE DATABASE IF NOT EXISTS `id8991969_pihtv` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id8991969_pihtv`;

-- --------------------------------------------------------

--
-- Table structure for table `eventi`
--

DROP TABLE IF EXISTS `eventi`;
CREATE TABLE `eventi` (
  `id` int(11) NOT NULL,
  `data_inizio` date DEFAULT NULL,
  `data_fine` date DEFAULT NULL,
  `orario_inizio` time DEFAULT NULL,
  `orario_fine` time DEFAULT NULL,
  `id_presentazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eventi`
--

INSERT INTO `eventi` (`id`, `data_inizio`, `data_fine`, `orario_inizio`, `orario_fine`, `id_presentazione`) VALUES
(70, '2019-03-05', '1970-01-01', '08:10:00', '00:00:00', 11),
(71, '2019-03-20', '1970-01-01', '10:10:00', '00:00:00', 11),
(74, '2019-02-27', '1970-01-01', '00:00:00', '00:00:00', 11),
(81, '2019-03-18', '1970-01-01', '08:40:00', '00:00:00', 11),
(82, '2019-03-15', '2019-03-15', '08:40:00', '09:40:00', 11),
(83, '2019-03-16', '1970-01-01', '00:00:00', '00:00:00', 11),
(85, '2019-03-23', '2019-03-23', '08:10:00', '13:10:00', 11),
(86, '2019-03-25', '2019-03-25', '12:30:00', '15:00:00', 11),
(87, '2019-04-07', '2019-04-08', '19:00:00', '01:00:00', 11),
(88, '2019-04-08', '2019-04-08', '12:30:00', '16:30:00', 11),
(89, '2019-04-13', '2019-04-13', '10:14:00', '11:10:00', 11),
(90, '1970-01-01', '1970-01-01', '01:00:00', '01:00:00', 15),
(92, '2019-04-08', '2019-04-08', '08:30:00', '12:30:00', 15),
(93, '2019-04-09', '2019-04-09', '10:30:00', '12:30:00', 11),
(94, '1970-01-01', '1970-01-01', '01:00:00', '01:00:00', 16),
(95, '2019-07-08', '2019-07-08', '06:00:00', '12:00:00', 16);

-- --------------------------------------------------------

--
-- Table structure for table `presentazioni`
--

DROP TABLE IF EXISTS `presentazioni`;
CREATE TABLE `presentazioni` (
  `id` int(11) NOT NULL,
  `titolo` varchar(128) NOT NULL,
  `descrizione` varchar(230) DEFAULT '',
  `ultima_modifica` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `data_creazione` datetime NOT NULL,
  `username` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `presentazioni`
--

INSERT INTO `presentazioni` (`id`, `titolo`, `descrizione`, `ultima_modifica`, `data_creazione`, `username`) VALUES
(11, 'aòdfjsalòkdsf', 'b', '2019-04-13 07:27:31', '2019-03-13 22:16:08', 'dave'),
(15, 'titolo', 'lkj;ljk', '2019-04-13 07:48:32', '2019-04-13 07:44:38', 'dave'),
(16, 'hi_dave_how_are_you_?', '', '2019-04-26 14:36:52', '2019-04-26 14:36:52', 'dave');

-- --------------------------------------------------------

--
-- Table structure for table `presentazioni_slides`
--

DROP TABLE IF EXISTS `presentazioni_slides`;
CREATE TABLE `presentazioni_slides` (
  `id_presentazione` int(11) NOT NULL,
  `id_slide` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `presentazioni_slides`
--

INSERT INTO `presentazioni_slides` (`id_presentazione`, `id_slide`) VALUES
(11, 4),
(11, 7),
(11, 8),
(15, 4),
(15, 20);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

DROP TABLE IF EXISTS `slides`;
CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `titolo` varchar(128) NOT NULL,
  `testo` varchar(255) DEFAULT NULL,
  `multimedia` varchar(128) DEFAULT NULL,
  `ultima_modifica` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `data_creazione` datetime NOT NULL,
  `durata` time DEFAULT NULL,
  `username` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `titolo`, `testo`, `multimedia`, `ultima_modifica`, `data_creazione`, `durata`, `username`) VALUES
(4, 'uomo pesce', 'very fico', '18838878_1892511037669148_6871260195488893721_n.jpg', '2019-03-16 20:09:50', '2019-02-13 21:40:50', '01:00:00', 'dave'),
(7, 'testa', 'testa', '19989257_813984338766876_1774836452363805236_n.jpg', '2019-03-15 21:09:40', '2019-03-11 21:01:13', '01:00:00', 'dave'),
(8, 'd', '', '19399809_1902736689979916_5391790329717912174_n.jpg', '2019-03-15 21:09:58', '2019-03-15 18:25:32', '01:00:00', 'dave'),
(20, 'upload file', 'upload file', 'Grande-Onda-di-Hokusai.jpg', '2019-03-15 20:06:23', '2019-03-15 21:06:23', '01:00:00', 'dave'),
(21, 'upload 2', 'upload 2', 'soursop.jpg', '2019-03-15 20:07:18', '2019-03-15 21:07:18', '01:00:00', 'dave'),
(22, 'hosting', 'test hosting', '18403325_1880478128872439_456202423138758182_n.jpg', '2019-03-16 19:03:00', '2019-03-16 19:01:06', '01:00:00', 'dave'),
(23, 'Beter', 'Beter', 'ahegao eve.png', '2019-03-16 20:10:44', '2019-03-16 20:10:44', '10:10:00', 'bodo'),
(24, 'Beter 2', 'Beter 2', 'Cattura (1).PNG', '2019-03-16 20:13:07', '2019-03-16 20:13:07', '10:10:00', 'bodo'),
(25, 'titolo', '', '', '2019-04-07 19:46:16', '2019-04-07 19:46:16', '01:00:00', 'dave'),
(26, 'adsfasdf', '', '', '2019-04-07 19:48:10', '2019-04-07 19:48:10', '01:00:00', 'dave'),
(28, 'titolo', 'descrizione', '32.jpg', '2019-04-13 08:07:01', '2019-04-13 08:07:01', '01:00:00', 'dave');

-- --------------------------------------------------------

--
-- Table structure for table `utenti`
--

DROP TABLE IF EXISTS `utenti`;
CREATE TABLE `utenti` (
  `username` varchar(128) NOT NULL,
  `password` char(64) NOT NULL,
  `ultimo_accesso` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utenti`
--

INSERT INTO `utenti` (`username`, `password`, `ultimo_accesso`) VALUES
('alezanola', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '2019-03-16 19:54:30'),
('beccaculo', 'de2ca46d642fb597232ca0028ca907213e9676462a1106d77c41f505f9c3a74d', '2019-03-18 21:46:22'),
('benny', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '2019-03-16 19:05:56'),
('bodo', '41c54f400c240799ee1d3784c22e78df2a5395f790185c539b3b74dd5edb5402', '2019-03-15 18:16:25'),
('dave', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2', '2019-07-08 15:27:02'),
('maxmasetti', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '2019-03-17 16:04:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eventi`
--
ALTER TABLE `eventi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_presentazione` (`id_presentazione`);

--
-- Indexes for table `presentazioni`
--
ALTER TABLE `presentazioni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `presentazioni_slides`
--
ALTER TABLE `presentazioni_slides`
  ADD KEY `id_presentazione` (`id_presentazione`),
  ADD KEY `id_slide` (`id_slide`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eventi`
--
ALTER TABLE `eventi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `presentazioni`
--
ALTER TABLE `presentazioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eventi`
--
ALTER TABLE `eventi`
  ADD CONSTRAINT `eventi_ibfk_1` FOREIGN KEY (`id_presentazione`) REFERENCES `presentazioni` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `presentazioni`
--
ALTER TABLE `presentazioni`
  ADD CONSTRAINT `presentazioni_ibfk_1` FOREIGN KEY (`username`) REFERENCES `utenti` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `presentazioni_slides`
--
ALTER TABLE `presentazioni_slides`
  ADD CONSTRAINT `presentazioni_slides_ibfk_1` FOREIGN KEY (`id_presentazione`) REFERENCES `presentazioni` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `presentazioni_slides_ibfk_2` FOREIGN KEY (`id_slide`) REFERENCES `slides` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `slides`
--
ALTER TABLE `slides`
  ADD CONSTRAINT `slides_ibfk_2` FOREIGN KEY (`username`) REFERENCES `utenti` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
