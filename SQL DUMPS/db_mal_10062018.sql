-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 10 jun 2018 om 21:33
-- Serverversie: 10.1.26-MariaDB
-- PHP-versie: 7.1.9

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

--
-- Gegevens worden geëxporteerd voor tabel `tbl_module`
--

INSERT INTO `tbl_module` (`id`, `naam`, `beschrijving`, `categorie`, `view _level`) VALUES
(3, 'Afspreken met vrienden', 'Afspreken met vrienden zonder enige verplichting kan een goede afleiding zijn en is een goede manier om weer terug onder de mensen te komen.', 1, 4);

--
-- Gegevens worden geëxporteerd voor tabel `tbl_rollen`
--

INSERT INTO `tbl_rollen` (`id`, `rol_naam`) VALUES
(1, 'admin'),
(2, 'psycholoog'),
(3, 'patient'),
(4, '3de-partij');

--
-- Gegevens worden geëxporteerd voor tabel `tbl_taken`
--

INSERT INTO `tbl_taken` (`id`, `module_id`, `naam`, `beschrijving`) VALUES
(1, 1, 'leg je situatie uit', 'je huidige situatie uitleggen aan een goede vriend kan begrip geven voor je vriend en voor je zelf kan het ook een opluchting zijn.'),
(2, 1, 'nodig een vriend uit voor mal', 'Mal geeft ook de mogelijkheid om je vrienden jou te laten helpen met jouw taken. nodig iemand uit zodat die je kan helpen.'),
(3, 1, 'spreek minstens een keer met een vriend af', 'Spreek deze week minstens 1 keer met een goede vriend af zonder enige verplichtingen.');

--
-- Gegevens worden geëxporteerd voor tabel `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `usernaam`, `voornaam`, `achternaam`, `wachtwoord`, `rol`, `profielfoto`) VALUES
(1, 'aronvanes', 'Aron', 'van Es', '$2y$10$t/HDseCW83ewyU6/MQ5C3ewzrSYU1fClMfWthKZi5ni7wMJv3hmiK', 3, ''),
(2, 'johndoe', 'john', 'Doe', '$2y$10$JJ1O934JTYeSigxSBbx5seUstPILiVgv1VtEMobbbvINIUk9K5wWS', 2, ''),
(3, 'alexhermans', 'alex', 'hermans', '$2y$10$jq3OmqOCMQl8E6yyqm.yTutxUTWAliqy5wTcw3GcScldd9aT3Wzgq', 3, '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
