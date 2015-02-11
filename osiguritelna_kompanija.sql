-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 11, 2015 at 10:03 PM
-- Server version: 5.6.13
-- PHP Version: 5.4.17

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `osiguritelna_kompanija`
--
CREATE DATABASE IF NOT EXISTS `osiguritelna_kompanija` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `osiguritelna_kompanija`;

-- --------------------------------------------------------

--
-- Table structure for table `avtomobili`
--

CREATE TABLE IF NOT EXISTS `avtomobili` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `licna_karta` int(11) NOT NULL,
  `reg_br` int(11) NOT NULL,
  `br_shasija` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `marka` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sila` int(11) NOT NULL,
  `zafatnina` int(11) NOT NULL,
  `godina` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `boja` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cena` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `avtomobili`
--

INSERT INTO `avtomobili` (`id`, `licna_karta`, `reg_br`, `br_shasija`, `marka`, `tip`, `sila`, `zafatnina`, `godina`, `boja`, `cena`, `user_id`) VALUES
(18, 123456, 58752, '254321', 'Honda Civic', 'Лимузина', 55, 1400, '2006-12-25', 'Zelena', 4000, 15);

-- --------------------------------------------------------

--
-- Table structure for table `delovni`
--

CREATE TABLE IF NOT EXISTS `delovni` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `licna_karta` int(11) NOT NULL,
  `adresa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gradba` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `povrsina` int(11) NOT NULL,
  `cena` int(11) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Table structure for table `kuki`
--

CREATE TABLE IF NOT EXISTS `kuki` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `licna_karta` int(11) NOT NULL,
  `adresa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gradba` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `povrsina` int(11) NOT NULL,
  `cena` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `kuki`
--

INSERT INTO `kuki` (`id`, `licna_karta`, `adresa`, `grad`, `gradba`, `povrsina`, `cena`, `user_id`) VALUES
(4, 1357, 'roza petrova 26', 'Кочани', 'Мешовита', 126, 3750, 13);

-- --------------------------------------------------------

--
-- Table structure for table `motorcikli`
--

CREATE TABLE IF NOT EXISTS `motorcikli` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `licna_karta` int(11) NOT NULL,
  `reg_br` int(11) NOT NULL,
  `br_shasija` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `marka` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sila` int(11) NOT NULL,
  `zafatnina` int(11) NOT NULL,
  `godina` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `boja` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cena` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `patnicki`
--

CREATE TABLE IF NOT EXISTS `patnicki` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `licna_karta` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `drzava` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zdravstvena` tinyint(1) NOT NULL,
  `nezgoda` tinyint(1) NOT NULL,
  `bagaz` tinyint(1) NOT NULL,
  `cena` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `patnicki`
--

INSERT INTO `patnicki` (`id`, `licna_karta`, `period`, `drzava`, `zdravstvena`, `nezgoda`, `bagaz`, `cena`, `user_id`) VALUES
(1, 123, 1231, '123', 0, 0, 0, 0, 9),
(2, 123, 1231, '123', 0, 0, 0, 0, 9),
(3, 123, 10, 'mak', 0, 0, 0, 80, 9),
(4, 123, 10, 'mak', 0, 0, 0, 300, 9),
(6, 123456789, 10, 'mak', 0, 0, 0, 300, 12),
(7, 2468, 13, 'Italija', 0, 0, 0, 300, 14);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `value`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `stanovi`
--

CREATE TABLE IF NOT EXISTS `stanovi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `licna_karta` int(11) NOT NULL,
  `adresa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gradba` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `povrsina` int(11) NOT NULL,
  `cena` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `stanovi`
--

INSERT INTO `stanovi` (`id`, `licna_karta`, `adresa`, `grad`, `gradba`, `povrsina`, `cena`, `user_id`) VALUES
(7, 1357, 'ilindenska 178', 'Кочани', 'Тврда', 67, 2500, 13);

-- --------------------------------------------------------

--
-- Table structure for table `tovarni`
--

CREATE TABLE IF NOT EXISTS `tovarni` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `licna_karta` int(11) NOT NULL,
  `reg_br` int(11) NOT NULL,
  `br_shasija` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `marka` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sila` int(11) NOT NULL,
  `zafatnina` int(11) NOT NULL,
  `godina` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `boja` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cena` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tovarni`
--

INSERT INTO `tovarni` (`id`, `licna_karta`, `reg_br`, `br_shasija`, `marka`, `tip`, `sila`, `zafatnina`, `godina`, `boja`, `cena`, `user_id`) VALUES
(7, 123456, 25425, '16523', 'FAP 1620', 'Камион', 140, 6000, '1999-12-10', 'Plava', 12200, 15);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `ime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `licna_karta` int(11) NOT NULL,
  `adresa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefon` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role_id`, `ime`, `prezime`, `licna_karta`, `adresa`, `telefon`) VALUES
(3, 'ptrjovanov', 'qwerty123', 1, 'Petar', 'Jovanov', 54489, 'Marsal Tito br 1/18', 72212488),
(4, 'andrejstojmenov', 'qwerty123', 1, 'Andrej', 'Stojmenov', 46541, 'Todosija Paunov br. 16', 71233209),
(9, 'dusanstojkov', 'qwerty123', 1, 'Душан', 'Стојков', 123, 'Зрновци', 1234),
(11, 'acenikolov', 'qwerty123', 1, 'Aleksandar', 'Nikolov', 123467, 'strumica', 1280198491),
(13, 'Saso.Trajanov', 'qwerty123', 2, 'Saso', 'Trajanov', 1357, 'Zrnovci', 33275572),
(14, 'Stanka.Petrova', 'qwerty123', 2, 'Stanka', 'Petrova', 2468, 'Obleshevo bb', 33363654),
(15, 'Dame.Mitev', 'qwerty123', 2, 'Dame', 'Mitev', 123456, 'Orizari', 33378254);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
