-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 05 jun 2018 om 14:46
-- Serverversie: 10.1.32-MariaDB
-- PHP-versie: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mal`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_berichten`
--

CREATE TABLE `tbl_berichten` (
  `id` int(11) NOT NULL,
  `verzender_id` int(11) NOT NULL COMMENT 'FK_users',
  `ontvanger_id` int(11) NOT NULL COMMENT 'FK_users',
  `bericht` text COLLATE utf8_unicode_ci NOT NULL,
  `datum_verstuurd` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_module`
--

CREATE TABLE `tbl_module` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `beschrijving` text COLLATE utf8_unicode_ci NOT NULL,
  `categorie` int(11) NOT NULL COMMENT 'FK_psychologisch_profiel',
  `view _level` int(11) NOT NULL COMMENT 'FK_rol'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_psychologisch_profiel`
--

CREATE TABLE `tbl_psychologisch_profiel` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `categorie_werk` int(11) NOT NULL,
  `categorie_energie` int(11) NOT NULL,
  `categorie_sociaal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_rollen`
--

CREATE TABLE `tbl_rollen` (
  `id` int(11) NOT NULL,
  `rol_naam` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_taken`
--

CREATE TABLE `tbl_taken` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL COMMENT 'FK_module',
  `naam` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `beschrijving` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_taken_users`
--

CREATE TABLE `tbl_taken_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'FK_users',
  `taak_id` int(11) NOT NULL COMMENT 'FK_taken',
  `completed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `usernaam` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `voornaam` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `achternaam` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `wachtwoord` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rol` int(11) NOT NULL,
  `profielfoto` varchar(511) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_users_extra`
--

CREATE TABLE `tbl_users_extra` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `geboortedatum` date NOT NULL,
  `woonplaats` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tewerkgesteld` tinyint(1) NOT NULL,
  `jobtitel` varchar(511) COLLATE utf8_unicode_ci NOT NULL,
  `functie` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_users_module`
--

CREATE TABLE `tbl_users_module` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL COMMENT 'FK_tbl_user',
  `user_id` int(11) NOT NULL COMMENT 'FK_tbl_module'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_users_relationship`
--

CREATE TABLE `tbl_users_relationship` (
  `id` int(11) NOT NULL,
  `user_id_origin` int(11) NOT NULL,
  `user_id_destination` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_user_options`
--

CREATE TABLE `tbl_user_options` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `tbl_berichten`
--
ALTER TABLE `tbl_berichten`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `tbl_module`
--
ALTER TABLE `tbl_module`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `tbl_psychologisch_profiel`
--
ALTER TABLE `tbl_psychologisch_profiel`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `tbl_rollen`
--
ALTER TABLE `tbl_rollen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `tbl_taken`
--
ALTER TABLE `tbl_taken`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `tbl_taken_users`
--
ALTER TABLE `tbl_taken_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `tbl_users_extra`
--
ALTER TABLE `tbl_users_extra`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `tbl_users_module`
--
ALTER TABLE `tbl_users_module`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `tbl_users_relationship`
--
ALTER TABLE `tbl_users_relationship`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `tbl_berichten`
--
ALTER TABLE `tbl_berichten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_module`
--
ALTER TABLE `tbl_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_psychologisch_profiel`
--
ALTER TABLE `tbl_psychologisch_profiel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_rollen`
--
ALTER TABLE `tbl_rollen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_taken`
--
ALTER TABLE `tbl_taken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_taken_users`
--
ALTER TABLE `tbl_taken_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `tbl_users_extra`
--
ALTER TABLE `tbl_users_extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_users_module`
--
ALTER TABLE `tbl_users_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_users_relationship`
--
ALTER TABLE `tbl_users_relationship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
