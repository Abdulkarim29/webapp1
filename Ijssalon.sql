-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Gegenereerd op: 07 apr 2026 om 12:06
-- Serverversie: 8.4.8
-- PHP-versie: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Ijssalon`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `menukaart`
--

CREATE TABLE `menukaart` (
  `id` int NOT NULL,
  `titel` text NOT NULL,
  `omschrijving` text NOT NULL,
  `prijs` decimal(10,0) NOT NULL,
  `flavor` varchar(50) DEFAULT 'kt-creme'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `menukaart`
--

INSERT INTO `menukaart` (`id`, `titel`, `omschrijving`, `prijs`, `flavor`) VALUES
(1, 'Stracciatella', 'Romige melkijs met fijne chocoladevlokken — een echte Italiaanse klassieker.', 3, 'kt-creme'),
(2, 'Frambozenroom', 'Fris, zuur en zoet — met echte frambozen en een romige slagroomtoets.', 3, 'kt-creme'),
(3, 'Pistache Royale', 'Authentiek pistache-ijs met fijngehakte pistachenootjes en een rijke smaak.', 3, 'kt-creme'),
(4, 'Mango Sorbet', 'Tropisch en fris mango-ijs — 100% vrucht, zonder room. Perfect bij warm weer!', 3, 'kt-creme'),
(5, 'Chocolade Fondante', 'Intense pure chocolade-ijs — rijk, diep van smaak en absoluut onweerstaanbaar.', 3, 'kt-creme'),
(6, 'Vanille Bourbon', 'Zachte vanille-ijs van echte Bourbonvanille. Tijdloos, romig en heerlijk simpel.', 3, 'kt-creme'),
(7, 'Aardbei Droom', 'Hemels zacht aardbeiijs met echte stukjes aardbei — fruitig fris in elke hap.', 3, 'kt-creme'),
(8, 'Witte Choco Framboos', 'Romige witte chocolade gecombineerd met frisse frambozen en een rijke toplaag.', 3, 'kt-creme'),
(9, 'Caramel Zeezout', 'Het perfecte balans van zoet en zout — met Hollandse fleur de sel. Verslavend lekker.', 3, 'kt-creme'),
(10, 'Kersen Kus', 'Zoet en fris kersenis met zachte fruitige smaak — een en al zon en zomer.', 3, 'kt-creme'),
(11, 'Smurfen Droom', 'Blauw framboos- en vanilleijs — favoriet bij kinderen en jong van hart!', 3, 'kt-creme'),
(12, 'Oreo Delight', 'Volle roomijs met knapperige Oreo-stukjes — romig én crunchy in elke hap.', 3, 'kt-creme');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `menukaart`
--
ALTER TABLE `menukaart`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `menukaart`
--
ALTER TABLE `menukaart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
