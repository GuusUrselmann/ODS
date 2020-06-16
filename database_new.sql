-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 16 jun 2020 om 16:53
-- Serverversie: 5.5.62-MariaDB
-- PHP-versie: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ods`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `couponcodes`
--

CREATE TABLE `couponcodes` (
  `id` int(11) NOT NULL,
  `code` varchar(500) NOT NULL,
  `einddatum` varchar(500) NOT NULL,
  `soort` set('bedrag','procent') NOT NULL DEFAULT 'bedrag',
  `waarde` decimal(10,2) NOT NULL,
  `min` decimal(10,2) NOT NULL,
  `eenmalig` set('nee','ja') NOT NULL DEFAULT 'nee',
  `filiaal` int(255) NOT NULL,
  `type` set('bezorgen','afhalen','beide') NOT NULL DEFAULT 'beide',
  `actief` set('ja','nee') NOT NULL DEFAULT 'ja'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `couponcodes`
--

INSERT INTO `couponcodes` (`id`, `code`, `einddatum`, `soort`, `waarde`, `min`, `eenmalig`, `filiaal`, `type`, `actief`) VALUES
(1, 'S0L6PPLJCF', '1591048740', 'procent', '10.00', '10000.00', 'ja', 1, 'beide', 'ja');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `filialen`
--

CREATE TABLE `filialen` (
  `id` int(255) NOT NULL,
  `naam` varchar(500) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `actief` set('0','1') NOT NULL DEFAULT '1',
  `maxafstand` decimal(10,2) NOT NULL,
  `adres` varchar(500) NOT NULL,
  `plaats` varchar(500) NOT NULL,
  `tel` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `contant` set('0','1') NOT NULL DEFAULT '1',
  `pin` set('0','1') NOT NULL DEFAULT '1',
  `ideal` set('0','1') NOT NULL DEFAULT '1',
  `factuur` set('0','1') NOT NULL DEFAULT '1',
  `bezorgen` set('0','1') NOT NULL DEFAULT '1',
  `afhalen` set('0','1') NOT NULL DEFAULT '1',
  `bezorgkosten` varchar(100) NOT NULL,
  `gratisbezorgen` decimal(10,2) NOT NULL,
  `minimumbedrag` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `filialen`
--

INSERT INTO `filialen` (`id`, `naam`, `postcode`, `actief`, `maxafstand`, `adres`, `plaats`, `tel`, `email`, `contant`, `pin`, `ideal`, `factuur`, `bezorgen`, `afhalen`, `bezorgkosten`, `gratisbezorgen`, `minimumbedrag`) VALUES
(1, 'den eerste snackbar', '1234AB', '1', '3.00', 'straatjehuppelepup 10', 'Bussem', '0853456458', 'boem@banaantjes.nl', '1', '1', '1', '1', '1', '1', '3', '0.25', '0.50'),
(4, 'Den tweede snackbar', '1234AB', '1', '0.00', '', '', '', '', '1', '1', '1', '1', '1', '1', '', '0.00', '0.00'),
(6, 'test filiaal', '', '1', '0.00', '', '', '', '', '1', '1', '1', '1', '1', '1', '', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `groups`
--

CREATE TABLE `groups` (
  `id` int(255) NOT NULL,
  `naam` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `groups`
--

INSERT INTO `groups` (`id`, `naam`) VALUES
(1, 'Admin');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `openingstijdenafhalen`
--

CREATE TABLE `openingstijdenafhalen` (
  `id` int(11) NOT NULL,
  `fid` int(255) NOT NULL,
  `shopOpenMaandag` int(30) NOT NULL,
  `shopSluitMaandag` int(30) NOT NULL,
  `shopOpenDinsdag` int(30) NOT NULL,
  `shopSluitDinsdag` int(30) NOT NULL,
  `shopOpenWoensdag` int(30) NOT NULL,
  `shopSluitWoensdag` int(30) NOT NULL,
  `shopOpenDonderdag` int(30) NOT NULL,
  `shopSluitDonderdag` int(30) NOT NULL,
  `shopOpenVrijdag` int(30) NOT NULL,
  `shopSluitVrijdag` int(30) NOT NULL,
  `shopOpenZaterdag` int(30) NOT NULL,
  `shopSluitZaterdag` int(30) NOT NULL,
  `shopOpenZondag` int(30) NOT NULL,
  `shopSluitZondag` int(30) NOT NULL,
  `shopGeopendMaandag` int(30) NOT NULL,
  `shopGeopendDinsdag` int(30) NOT NULL,
  `shopGeopendWoensdag` int(30) NOT NULL,
  `shopGeopendDonderdag` int(30) NOT NULL,
  `shopGeopendVrijdag` int(30) NOT NULL,
  `shopGeopendZaterdag` int(30) NOT NULL,
  `shopGeopendZondag` int(30) NOT NULL,
  `shopBereidingsTijd` int(30) NOT NULL,
  `shopTijdVak` int(30) NOT NULL,
  `shopDaysBefore` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `openingstijdenafhalen`
--

INSERT INTO `openingstijdenafhalen` (`id`, `fid`, `shopOpenMaandag`, `shopSluitMaandag`, `shopOpenDinsdag`, `shopSluitDinsdag`, `shopOpenWoensdag`, `shopSluitWoensdag`, `shopOpenDonderdag`, `shopSluitDonderdag`, `shopOpenVrijdag`, `shopSluitVrijdag`, `shopOpenZaterdag`, `shopSluitZaterdag`, `shopOpenZondag`, `shopSluitZondag`, `shopGeopendMaandag`, `shopGeopendDinsdag`, `shopGeopendWoensdag`, `shopGeopendDonderdag`, `shopGeopendVrijdag`, `shopGeopendZaterdag`, `shopGeopendZondag`, `shopBereidingsTijd`, `shopTijdVak`, `shopDaysBefore`) VALUES
(1, 1, 61200, 93600, 32400, 93600, 28800, 93600, 28800, 93600, 28800, 93600, 28800, 93600, 32400, 93600, 1, 1, 1, 1, 1, 1, 1, 1800, 900, 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `openingstijdenbezorgen`
--

CREATE TABLE `openingstijdenbezorgen` (
  `id` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `shopOpenMaandag` int(30) NOT NULL,
  `shopSluitMaandag` int(30) NOT NULL,
  `shopOpenDinsdag` int(30) NOT NULL,
  `shopSluitDinsdag` int(30) NOT NULL,
  `shopOpenWoensdag` int(30) NOT NULL,
  `shopSluitWoensdag` int(30) NOT NULL,
  `shopOpenDonderdag` int(30) NOT NULL,
  `shopSluitDonderdag` int(30) NOT NULL,
  `shopOpenVrijdag` int(30) NOT NULL,
  `shopSluitVrijdag` int(30) NOT NULL,
  `shopOpenZaterdag` int(30) NOT NULL,
  `shopSluitZaterdag` int(30) NOT NULL,
  `shopOpenZondag` int(30) NOT NULL,
  `shopSluitZondag` int(30) NOT NULL,
  `shopGeopendMaandag` int(30) NOT NULL,
  `shopGeopendDinsdag` int(30) NOT NULL,
  `shopGeopendWoensdag` int(30) NOT NULL,
  `shopGeopendDonderdag` int(30) NOT NULL,
  `shopGeopendVrijdag` int(30) NOT NULL,
  `shopGeopendZaterdag` int(30) NOT NULL,
  `shopGeopendZondag` int(30) NOT NULL,
  `shopBereidingsTijd` int(30) NOT NULL,
  `shopTijdVak` int(30) NOT NULL,
  `shopDaysBefore` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `openingstijdenbezorgen`
--

INSERT INTO `openingstijdenbezorgen` (`id`, `fid`, `shopOpenMaandag`, `shopSluitMaandag`, `shopOpenDinsdag`, `shopSluitDinsdag`, `shopOpenWoensdag`, `shopSluitWoensdag`, `shopOpenDonderdag`, `shopSluitDonderdag`, `shopOpenVrijdag`, `shopSluitVrijdag`, `shopOpenZaterdag`, `shopSluitZaterdag`, `shopOpenZondag`, `shopSluitZondag`, `shopGeopendMaandag`, `shopGeopendDinsdag`, `shopGeopendWoensdag`, `shopGeopendDonderdag`, `shopGeopendVrijdag`, `shopGeopendZaterdag`, `shopGeopendZondag`, `shopBereidingsTijd`, `shopTijdVak`, `shopDaysBefore`) VALUES
(1, 1, 61200, 82800, 34200, 82800, 28800, 78600, 28800, 82800, 28800, 73800, 32400, 68400, 43200, 68400, 1, 1, 1, 1, 1, 1, 1, 1800, 900, 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `openingstijdenextra`
--

CREATE TABLE `openingstijdenextra` (
  `id` int(11) NOT NULL,
  `filiaalID` int(11) NOT NULL,
  `timeStart` int(30) NOT NULL,
  `timeEnd` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `perms`
--

CREATE TABLE `perms` (
  `id` int(255) NOT NULL,
  `slug` varchar(500) NOT NULL,
  `naam` varchar(500) NOT NULL,
  `cat` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `perms`
--

INSERT INTO `perms` (`id`, `slug`, `naam`, `cat`) VALUES
(1, 'coupon', 'Coupon pagina openen', 'Coupons'),
(2, 'coupon_maken', 'Coupons maken', 'Coupons'),
(3, 'coupon_wijzig', 'Coupons wijzigen', 'Coupons'),
(4, 'coupon_verwijderen', 'Coupons verwijderen', 'Coupons'),
(5, 'perms_groups', 'Groep Permissies', 'Permissies'),
(6, 'perms_users', 'Gebruiker Permissies', 'Permissies'),
(7, 'coupon_allefilialen', 'Coupon op Alle Filialen maken', 'Coupons'),
(8, 'filialen', 'Filialen Pagina', 'Filialen'),
(9, 'filialen_nieuw', 'Nieuw Filiaal maken', 'Filialen'),
(10, 'filialen_verwijder', 'Filialen Verwijderen', 'Filialen'),
(11, 'filialen_wijzig', 'Filialen Wijzigen', 'Filialen'),
(12, 'filialen_all', 'Beheer alle filialen', 'Filialen'),
(13, 'filialen_openingstijden', 'Openingstijden Beheren', 'Filialen');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `perms_groups`
--

CREATE TABLE `perms_groups` (
  `id` int(255) NOT NULL,
  `gid` int(255) NOT NULL,
  `perm` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `perms_groups`
--

INSERT INTO `perms_groups` (`id`, `gid`, `perm`) VALUES
(130, 1, 'coupon'),
(131, 1, 'coupon_maken'),
(132, 1, 'coupon_verwijderen'),
(133, 1, 'coupon_wijzig'),
(134, 1, 'filialen'),
(135, 1, 'filialen_verwijder'),
(136, 1, 'filialen_wijzig'),
(137, 1, 'filialen_nieuw'),
(138, 1, 'filialen_openingstijden'),
(139, 1, 'perms_users'),
(140, 1, 'perms_groups');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `perms_user`
--

CREATE TABLE `perms_user` (
  `id` int(255) NOT NULL,
  `uid` int(255) NOT NULL,
  `perm` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `fullname` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `groep` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `email`, `groep`) VALUES
(1, 'admin', '$2y$11$A36O3n1al93hF4tk1fXHbutrchORseonkdathxHjyKTl/W3ZDHP66', 'Admin User', 'admin@ods.vnieuwenhuizen.com', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users_filialen`
--

CREATE TABLE `users_filialen` (
  `id` int(255) NOT NULL,
  `uid` int(255) NOT NULL,
  `fid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `users_filialen`
--

INSERT INTO `users_filialen` (`id`, `uid`, `fid`) VALUES
(15, 1, 5),
(16, 1, 1),
(17, 1, 4),
(18, 1, 6);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `couponcodes`
--
ALTER TABLE `couponcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `filialen`
--
ALTER TABLE `filialen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `openingstijdenafhalen`
--
ALTER TABLE `openingstijdenafhalen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `openingstijdenbezorgen`
--
ALTER TABLE `openingstijdenbezorgen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `openingstijdenextra`
--
ALTER TABLE `openingstijdenextra`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_3` (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexen voor tabel `perms`
--
ALTER TABLE `perms`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `perms_groups`
--
ALTER TABLE `perms_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `perms_user`
--
ALTER TABLE `perms_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users_filialen`
--
ALTER TABLE `users_filialen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `couponcodes`
--
ALTER TABLE `couponcodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `filialen`
--
ALTER TABLE `filialen`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `openingstijdenafhalen`
--
ALTER TABLE `openingstijdenafhalen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `openingstijdenbezorgen`
--
ALTER TABLE `openingstijdenbezorgen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `openingstijdenextra`
--
ALTER TABLE `openingstijdenextra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `perms`
--
ALTER TABLE `perms`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT voor een tabel `perms_groups`
--
ALTER TABLE `perms_groups`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT voor een tabel `perms_user`
--
ALTER TABLE `perms_user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `users_filialen`
--
ALTER TABLE `users_filialen`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
