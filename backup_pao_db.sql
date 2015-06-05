-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 29 mei 2015 om 12:40
-- Serverversie: 5.6.21
-- PHP-versie: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `pao`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bedrijven`
--

CREATE TABLE IF NOT EXISTS `bedrijven` (
`bedrijfid` int(255) NOT NULL,
  `bedrijfnaam` varchar(255) NOT NULL,
  `adres` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `plaats` varchar(255) NOT NULL,
  `telefoonnummer` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `codeleerbedrijf` varchar(255) NOT NULL,
  `opmerking` longtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `bedrijven`
--

INSERT INTO `bedrijven` (`bedrijfid`, `bedrijfnaam`, `adres`, `postcode`, `plaats`, `telefoonnummer`, `email`, `website`, `codeleerbedrijf`, `opmerking`) VALUES
(1, 'hoi2', 'hoi', 'hoi', 'hoi', 'hoi', 'hoi', 'http://www.google.nl', 'hoi', 'hoi'),
(2, 'derptown', 'dadad', 'dadad', 'dadad', 'dadad', 'dadad', 'dadad', 'dadad', 'dadaddad');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klassen`
--

CREATE TABLE IF NOT EXISTS `klassen` (
`klasId` int(255) NOT NULL,
  `klasnaam` varchar(255) NOT NULL,
  `mentor` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `klassen`
--

INSERT INTO `klassen` (`klasId`, `klasnaam`, `mentor`) VALUES
(2, 'AO2A', 'P. Brouwer');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `studenten`
--

CREATE TABLE IF NOT EXISTS `studenten` (
`studentId` int(255) NOT NULL,
  `studentnummer` int(255) NOT NULL,
  `voornaam` varchar(255) NOT NULL,
  `tussennaam` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `adres` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `plaats` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefoonnummer` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `studenten`
--

INSERT INTO `studenten` (`studentId`, `studentnummer`, `voornaam`, `tussennaam`, `achternaam`, `adres`, `postcode`, `plaats`, `email`, `telefoonnummer`) VALUES
(4, 97008387, 'Raoul', '', 'Mensink', 'sheppinkmate 44', '8014 JR', 'zwolle', '97008387@deltion.nl', '0611133206');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`userId` int(255) NOT NULL,
  `voornaam` varchar(255) COLLATE utf8_bin NOT NULL,
  `tussenvoegsel` varchar(255) COLLATE utf8_bin NOT NULL,
  `achternaam` varchar(255) COLLATE utf8_bin NOT NULL,
  `wachtwoord` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `groep` int(255) NOT NULL,
  `salt` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`userId`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `email`, `groep`, `salt`) VALUES
(3, 'Raoul', '', 'Mensink', '93a4a57efbe2ba848258527580f1c7ab34cafb02', 'raoulgamer@live.nl', 1, '');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bedrijven`
--
ALTER TABLE `bedrijven`
 ADD PRIMARY KEY (`bedrijfid`);

--
-- Indexen voor tabel `klassen`
--
ALTER TABLE `klassen`
 ADD PRIMARY KEY (`klasId`);

--
-- Indexen voor tabel `studenten`
--
ALTER TABLE `studenten`
 ADD PRIMARY KEY (`studentId`), ADD UNIQUE KEY `studentnummer` (`studentnummer`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`userId`), ADD UNIQUE KEY `naam` (`voornaam`,`salt`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bedrijven`
--
ALTER TABLE `bedrijven`
MODIFY `bedrijfid` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `klassen`
--
ALTER TABLE `klassen`
MODIFY `klasId` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `studenten`
--
ALTER TABLE `studenten`
MODIFY `studentId` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
MODIFY `userId` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
