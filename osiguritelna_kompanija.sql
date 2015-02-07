-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 07, 2015 at 04:44 PM
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role_id`, `ime`, `prezime`, `licna_karta`, `adresa`, `telefon`) VALUES
(3, 'ptrjovanov', 'qwerty123', 1, 'Petar', 'Jovanov', 54489, 'Marsal Tito br 1/18', 72212488),
(4, 'andrstojmenov', 'qwerty123', 1, 'Andrej', 'Stojmenov', 46541, 'Todosija Paunov br. 16', 71233209),
(5, 'someuser', 'qwerty123', 2, 'Stojan', 'Stojanov', 4654612, 'Jordan Piperkata bb', 75889665),
(9, 'Душан.Стојков', 'qwerty123', 2, 'Душан', 'Стојков', 123, 'Зрновци', 1234);

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
