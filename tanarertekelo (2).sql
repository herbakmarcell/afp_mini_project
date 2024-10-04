-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Okt 04. 18:07
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `tanarertekelo`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ertekelesek`
--

CREATE TABLE `ertekelesek` (
  `id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `tanar_id` int(11) NOT NULL,
  `ertekeles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `ertekelesek`
--

INSERT INTO `ertekelesek` (`id`, `felhasznalo_id`, `tanar_id`, `ertekeles`) VALUES
(1, 2, 1, 4),
(2, 2, 2, 5);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jelszo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `nev`, `email`, `jelszo`) VALUES
(2, 'pisti', 'pisti@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kommentek`
--

CREATE TABLE `kommentek` (
  `id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `tanar_id` int(11) NOT NULL,
  `komment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `kommentek`
--

INSERT INTO `kommentek` (`id`, `felhasznalo_id`, `tanar_id`, `komment`) VALUES
(1, 2, 2, 'Nagyon jól magyaráz, érdekes órákat tart.'),
(2, 2, 1, 'Nagyon jól magyaráz, érdekes órákat tart.');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tanarok`
--

CREATE TABLE `tanarok` (
  `id` int(11) NOT NULL,
  `vezeteknev` varchar(255) NOT NULL,
  `keresztnev` varchar(255) NOT NULL,
  `atlag` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `tanarok`
--

INSERT INTO `tanarok` (`id`, `vezeteknev`, `keresztnev`, `atlag`) VALUES
(1, 'Nagy', 'Károly', 3),
(2, 'Kovásznai', 'Gergely', 5);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tantargyak`
--

CREATE TABLE `tantargyak` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `tantargyak`
--

INSERT INTO `tantargyak` (`id`, `nev`) VALUES
(1, 'Kalkulus'),
(2, 'Programozás');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tantargykapcsolotabla`
--

CREATE TABLE `tantargykapcsolotabla` (
  `id` int(11) NOT NULL,
  `tanar_id` int(11) NOT NULL,
  `tantargy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `tantargykapcsolotabla`
--

INSERT INTO `tantargykapcsolotabla` (`id`, `tanar_id`, `tantargy_id`) VALUES
(1, 1, 1),
(2, 2, 2);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `ertekelesek`
--
ALTER TABLE `ertekelesek`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `felhasznalo_id` (`felhasznalo_id`,`tanar_id`),
  ADD KEY `tanar_id` (`tanar_id`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `kommentek`
--
ALTER TABLE `kommentek`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `felhasznalo_id` (`felhasznalo_id`,`tanar_id`),
  ADD KEY `tanar_id` (`tanar_id`);

--
-- A tábla indexei `tanarok`
--
ALTER TABLE `tanarok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `tantargyak`
--
ALTER TABLE `tantargyak`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `tantargykapcsolotabla`
--
ALTER TABLE `tantargykapcsolotabla`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tanar_id` (`tanar_id`,`tantargy_id`),
  ADD KEY `tantargy_id` (`tantargy_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `ertekelesek`
--
ALTER TABLE `ertekelesek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `kommentek`
--
ALTER TABLE `kommentek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `tanarok`
--
ALTER TABLE `tanarok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `tantargyak`
--
ALTER TABLE `tantargyak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `tantargykapcsolotabla`
--
ALTER TABLE `tantargykapcsolotabla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `ertekelesek`
--
ALTER TABLE `ertekelesek`
  ADD CONSTRAINT `ertekelesek_ibfk_1` FOREIGN KEY (`tanar_id`) REFERENCES `tanarok` (`id`),
  ADD CONSTRAINT `ertekelesek_ibfk_2` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalok` (`id`);

--
-- Megkötések a táblához `kommentek`
--
ALTER TABLE `kommentek`
  ADD CONSTRAINT `kommentek_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalok` (`id`),
  ADD CONSTRAINT `kommentek_ibfk_2` FOREIGN KEY (`tanar_id`) REFERENCES `tanarok` (`id`);

--
-- Megkötések a táblához `tantargykapcsolotabla`
--
ALTER TABLE `tantargykapcsolotabla`
  ADD CONSTRAINT `tantargykapcsolotabla_ibfk_1` FOREIGN KEY (`tanar_id`) REFERENCES `tanarok` (`id`),
  ADD CONSTRAINT `tantargykapcsolotabla_ibfk_2` FOREIGN KEY (`tantargy_id`) REFERENCES `tantargyak` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
