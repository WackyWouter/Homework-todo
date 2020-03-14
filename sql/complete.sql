-- phpMyAdmin SQL Dump
-- version 5.0.2-dev
-- https://www.phpmyadmin.net/
--
-- Host: shareddb1d.hosting.stackcp.net
-- Gegenereerd op: 14 mrt 2020 om 16:29
-- Serverversie: 10.2.26-MariaDB-log
-- PHP-versie: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Homework-36353e2a`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `adddate` datetime NOT NULL DEFAULT current_timestamp(),
  `moddate` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `category`
--

INSERT INTO `category` (`id`, `name`, `user_id`, `adddate`, `moddate`) VALUES
(1, 'School', 2, '2020-03-04 21:00:22', '2020-03-05 21:23:26'),
(2, 'Housework', 2, '2020-03-04 21:00:22', '2020-03-05 21:23:29');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `homework`
--

CREATE TABLE `homework` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE ascii_bin NOT NULL,
  `description` text COLLATE ascii_bin DEFAULT NULL,
  `duedate` datetime NOT NULL,
  `course` varchar(255) COLLATE ascii_bin DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `priority` enum('LOW','MEDIUM','HIGH') COLLATE ascii_bin NOT NULL DEFAULT 'LOW',
  `done` tinyint(1) NOT NULL DEFAULT 0,
  `adddate` datetime NOT NULL DEFAULT current_timestamp(),
  `moddate` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Gegevens worden geëxporteerd voor tabel `homework`
--

INSERT INTO `homework` (`id`, `user_id`, `name`, `description`, `duedate`, `course`, `category_id`, `priority`, `done`, `adddate`, `moddate`) VALUES
(1, 2, 'Presenteren', 'Presentatie over logica', '2020-03-07 00:00:00', 'IKLO', 1, 'LOW', 0, '2020-03-04 21:48:46', '2020-03-04 21:50:14'),
(2, 2, 'Huiswerk', 'Opdracht 1 en 2', '2020-03-07 00:00:00', 'IPMETH', 1, 'LOW', 0, '2020-03-04 21:51:26', '2020-03-04 21:51:26'),
(3, 2, 'Presenteren 2', 'Presentatie over logica 2', '2020-03-07 00:00:00', 'IKLO', 1, 'LOW', 1, '2020-03-04 21:48:46', '2020-03-04 21:50:14'),
(4, 2, 'Huiswerk 2', 'Opdracht 3 en 4 ', '2020-03-07 00:00:00', 'IPMETH', 1, 'LOW', 1, '2020-03-04 21:51:26', '2020-03-04 22:10:11'),
(5, 2, 'test 1', 'test 1', '2020-03-10 00:00:00', 'IKLO', 1, 'LOW', 0, '2020-03-04 21:48:46', '2020-03-04 21:50:14'),
(6, 2, 'test 2', 'test 2', '2020-03-10 00:00:00', 'IPMETH', 1, 'LOW', 0, '2020-03-04 21:51:26', '2020-03-04 21:51:26'),
(7, 2, 'teset 3', 'test 3', '2020-03-10 00:00:00', 'IKLO', 1, 'LOW', 1, '2020-03-04 21:48:46', '2020-03-04 21:50:14'),
(8, 2, 'test 4', 'test 4', '2020-03-10 00:00:00', 'IPMETH', 1, 'LOW', 1, '2020-03-04 21:51:26', '2020-03-04 22:10:11');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE ascii_bin NOT NULL,
  `password` varchar(255) COLLATE ascii_bin NOT NULL,
  `adddate` datetime NOT NULL DEFAULT current_timestamp(),
  `moddate` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `adddate`, `moddate`) VALUES
(2, 'test', 'test', '2020-03-04 20:51:04', '2020-03-04 20:51:04');

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
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`) USING BTREE;

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `password` (`password`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `homework`
--
ALTER TABLE `homework`
  ADD CONSTRAINT `FK_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
