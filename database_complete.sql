-- phpMyAdmin SQL Dump
-- version 5.0.2-dev
-- https://www.phpmyadmin.net/
--
-- Host: shareddb1c.hosting.stackcp.net
-- Gegenereerd op: 06 sep 2020 om 17:11
-- Serverversie: 10.2.33-MariaDB-log
-- PHP-versie: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homework-3633a282`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` varchar(255) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `adddate` datetime NOT NULL DEFAULT current_timestamp(),
  `moddate` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `category`
--

INSERT INTO `category` (`id`, `name`, `user_id`, `adddate`, `moddate`) VALUES
(5, 'Cambridge English', '1c14aefc-4f03-422b-bba5-2d02b8ee3580', '2020-09-01 18:06:18', '2020-09-01 18:06:18'),
(7, 'General TODO', '1c14aefc-4f03-422b-bba5-2d02b8ee3580', '2020-09-03 09:25:16', '2020-09-03 09:25:16'),
(8, 'ISLH', '1c14aefc-4f03-422b-bba5-2d02b8ee3580', '2020-09-04 09:18:59', '2020-09-04 09:18:59');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `homework`
--

CREATE TABLE `homework` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) COLLATE ascii_bin NOT NULL,
  `name` varchar(255) COLLATE ascii_bin NOT NULL,
  `description` text COLLATE ascii_bin DEFAULT NULL,
  `comments` text COLLATE ascii_bin DEFAULT NULL,
  `duedate` date NOT NULL,
  `course` varchar(255) COLLATE ascii_bin DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `priority` enum('low','medium','high') COLLATE ascii_bin NOT NULL DEFAULT 'low',
  `done` tinyint(1) NOT NULL DEFAULT 0,
  `adddate` datetime NOT NULL DEFAULT current_timestamp(),
  `moddate` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Gegevens worden geëxporteerd voor tabel `homework`
--

INSERT INTO `homework` (`id`, `user_id`, `name`, `description`, `comments`, `duedate`, `course`, `category_id`, `priority`, `done`, `adddate`, `moddate`) VALUES
(11, '1c14aefc-4f03-422b-bba5-2d02b8ee3580', 'Homework ', 'unit 1:  reading page 12 ,13 and vocab page 14, exercise 5,6,7,8,9 Read: p 6-10: Introduction and exam overview in students book. Guide to Cambridge exams: p133-148; Pre-pronunciation task; check the anwsers yourself', NULL, '2020-09-03', 'CPE', 5, 'high', 1, '2020-05-18 13:58:08', '2020-09-02 15:52:41'),
(12, '1c14aefc-4f03-422b-bba5-2d02b8ee3580', 'homework', 'Read Earliest Times Chapter 1,2,3', NULL, '2020-09-08', 'Aspect of Britain', 5, 'high', 1, '2020-09-01 18:19:12', '2020-09-05 02:34:29'),
(13, '1c14aefc-4f03-422b-bba5-2d02b8ee3580', 'Presentation ', 'Presentation with Lucas on myths and legends \r\nin england. Needs to have a active learning part\r\nBetween 10-20min', NULL, '2020-09-22', 'Aspects of Britain', 5, 'high', 0, '2020-09-02 00:49:10', '2020-09-02 00:49:10'),
(14, '1c14aefc-4f03-422b-bba5-2d02b8ee3580', 'Workshop 3 Homework', 'Unit2: page 22,23,24,25,26,27\r\nWriting Exam practice page 30', NULL, '2020-09-08', 'CPE', 5, 'medium', 1, '2020-09-03 08:28:56', '2020-09-03 12:58:52'),
(15, '1c14aefc-4f03-422b-bba5-2d02b8ee3580', 'essay', 'Write an essay based on the two tasks on page 29. dont copy wright in your own words', NULL, '2020-09-08', 'CPE', 5, 'medium', 0, '2020-09-03 09:10:56', '2020-09-03 09:10:56'),
(16, '1c14aefc-4f03-422b-bba5-2d02b8ee3580', 'Tuesday', 'Email CPE teacher about which group im going to join on the 8th of spetember', NULL, '2020-09-04', 'CPE', 7, 'high', 1, '2020-09-03 09:26:09', '2020-09-04 15:20:01'),
(17, '1c14aefc-4f03-422b-bba5-2d02b8ee3580', 'it\'s 5pm somewhere', 'Make a it\'s 5pm somewhere app for fun and to figure out how publishing to the play store works', NULL, '2021-01-01', 'it\'s 5pm somewhere', 7, 'low', 0, '2020-09-04 09:17:42', '2020-09-04 09:17:42'),
(18, '1c14aefc-4f03-422b-bba5-2d02b8ee3580', 'clean room', '', NULL, '2020-09-09', 'Housework', 7, 'medium', 0, '2020-09-04 09:18:36', '2020-09-04 09:18:36'),
(19, '1c14aefc-4f03-422b-bba5-2d02b8ee3580', 'Opdracht F', '', NULL, '2020-10-31', 'ISLH', 8, 'low', 0, '2020-09-04 09:19:44', '2020-09-04 09:19:44'),
(20, '1c14aefc-4f03-422b-bba5-2d02b8ee3580', 'Opdracht G', '', NULL, '2020-10-31', 'ISLH', 8, 'low', 0, '2020-09-04 09:20:08', '2020-09-04 09:20:08'),
(21, '1c14aefc-4f03-422b-bba5-2d02b8ee3580', 'Tuition', 'Check wnr het schoolgeld van mijn rekening afgeschreven gaat worden', NULL, '2020-09-07', 'School', 7, 'high', 1, '2020-09-04 12:00:32', '2020-09-04 15:18:33'),
(22, '1c14aefc-4f03-422b-bba5-2d02b8ee3580', 'Manage Subscriptions', 'Add the subscription that i have to the subscription app that i have to easier manage them', NULL, '2020-09-07', 'Finance', 7, 'medium', 1, '2020-09-04 15:17:54', '2020-09-05 19:26:08'),
(23, '1c14aefc-4f03-422b-bba5-2d02b8ee3580', 'Check wnr mijn contract bij Appstudio begon', '', NULL, '2020-09-07', 'Finance', 7, 'medium', 1, '2020-09-04 16:03:11', '2020-09-05 19:26:11'),
(24, '1c14aefc-4f03-422b-bba5-2d02b8ee3580', 'Test', '', NULL, '2020-09-01', 'test', 7, 'low', 1, '2020-09-04 16:03:30', '2020-09-05 19:25:42'),
(25, '1c14aefc-4f03-422b-bba5-2d02b8ee3580', 'Portfolio', 'Vraag aan Milan wat er op mijn portfolio mag als ik weg ga', NULL, '2020-12-31', 'Appstudio', 7, 'low', 0, '2020-09-04 16:09:12', '2020-09-04 16:09:12'),
(26, '1c14aefc-4f03-422b-bba5-2d02b8ee3580', 'Put the certificates i have on linkedin', '', NULL, '2020-09-07', 'Portfolio', 7, 'medium', 0, '2020-09-04 16:13:47', '2020-09-04 16:13:47'),
(27, '1c14aefc-4f03-422b-bba5-2d02b8ee3580', 'Test', '', NULL, '2020-09-26', 'CPE', 7, 'low', 1, '2020-09-05 19:17:44', '2020-09-05 19:17:53');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE ascii_bin NOT NULL,
  `password` varbinary(255) NOT NULL,
  `user_uuid` varchar(255) COLLATE ascii_bin NOT NULL,
  `adddate` datetime NOT NULL DEFAULT current_timestamp(),
  `moddate` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_uuid`, `adddate`, `moddate`) VALUES
(3, 'WackyWouter', 0x1ca81e18b70dbb9a462b48a3305caa07, '1c14aefc-4f03-422b-bba5-2d02b8ee3580', '2020-05-10 20:51:04', '2020-05-10 20:51:04');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_id` (`user_id`);

--
-- Indexen voor tabel `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`) USING BTREE;

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_uuid`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `password` (`password`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_uuid`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `homework`
--
ALTER TABLE `homework`
  ADD CONSTRAINT `FK_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_uuid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
