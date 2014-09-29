-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 29. Sep 2014 um 15:05
-- Server Version: 5.6.11
-- PHP-Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `solcity`
--
CREATE DATABASE IF NOT EXISTS `solcity` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `solcity`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sc_article`
--

CREATE TABLE IF NOT EXISTS `sc_article` (
  `articleId` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `article` longtext,
  `originLink` text,
  `userId` int(11) NOT NULL,
  `subCategoryId` int(11) NOT NULL,
  PRIMARY KEY (`articleId`),
  KEY `sc_article_sc_user1` (`userId`),
  KEY `sc_article_sc_subcategory1` (`subCategoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sc_category`
--

CREATE TABLE IF NOT EXISTS `sc_category` (
  `categoryId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sc_comment`
--

CREATE TABLE IF NOT EXISTS `sc_comment` (
  `commentId` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `userId` int(11) NOT NULL,
  `articleId` int(11) NOT NULL,
  PRIMARY KEY (`commentId`),
  KEY `sc_comment_sc_user1` (`userId`),
  KEY `sc_comment_sc_article1` (`articleId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sc_event`
--

CREATE TABLE IF NOT EXISTS `sc_event` (
  `eventId` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` longtext,
  `userId` int(11) NOT NULL,
  `subCategoryId` int(11) NOT NULL,
  `venueId` int(11) NOT NULL,
  PRIMARY KEY (`eventId`),
  KEY `sc_event_sc_user1` (`userId`),
  KEY `sc_event_sc_subcategory1` (`subCategoryId`),
  KEY `sc_event_sc_venue1` (`venueId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sc_image`
--

CREATE TABLE IF NOT EXISTS `sc_image` (
  `imageId` int(11) NOT NULL AUTO_INCREMENT,
  `physicalPath` text NOT NULL,
  `alternativeText` text,
  `articleId` int(11) DEFAULT NULL,
  `eventId` int(11) DEFAULT NULL,
  PRIMARY KEY (`imageId`),
  KEY `sc_image_sc_article1` (`articleId`),
  KEY `sc_image_sc_event1` (`eventId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sc_subcategory`
--

CREATE TABLE IF NOT EXISTS `sc_subcategory` (
  `subCategoryId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `categoryId` int(11) NOT NULL,
  PRIMARY KEY (`subCategoryId`),
  KEY `sc_subcategory_sc_category1` (`categoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sc_user`
--

CREATE TABLE IF NOT EXISTS `sc_user` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `imageId` int(11) DEFAULT NULL,
  PRIMARY KEY (`userId`),
  KEY `sc_user_sc_image1` (`imageId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sc_venue`
--

CREATE TABLE IF NOT EXISTS `sc_venue` (
  `venueId` int(11) NOT NULL AUTO_INCREMENT,
  `zipCode` smallint(4) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `geoTagLatitude` decimal(10,8) DEFAULT NULL,
  `geoTagLongitude` decimal(11,8) DEFAULT NULL,
  PRIMARY KEY (`venueId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `sc_article`
--
ALTER TABLE `sc_article`
  ADD CONSTRAINT `sc_article_sc_subcategory1` FOREIGN KEY (`subCategoryId`) REFERENCES `sc_subcategory` (`subCategoryId`),
  ADD CONSTRAINT `sc_article_sc_user1` FOREIGN KEY (`userId`) REFERENCES `sc_user` (`userId`);

--
-- Constraints der Tabelle `sc_comment`
--
ALTER TABLE `sc_comment`
  ADD CONSTRAINT `sc_comment_sc_article1` FOREIGN KEY (`articleId`) REFERENCES `sc_article` (`articleId`),
  ADD CONSTRAINT `sc_comment_sc_user1` FOREIGN KEY (`userId`) REFERENCES `sc_user` (`userId`);

--
-- Constraints der Tabelle `sc_event`
--
ALTER TABLE `sc_event`
  ADD CONSTRAINT `sc_event_sc_subcategory1` FOREIGN KEY (`subCategoryId`) REFERENCES `sc_subcategory` (`subCategoryId`),
  ADD CONSTRAINT `sc_event_sc_user1` FOREIGN KEY (`userId`) REFERENCES `sc_user` (`userId`),
  ADD CONSTRAINT `sc_event_sc_venue1` FOREIGN KEY (`venueId`) REFERENCES `sc_venue` (`venueId`);

--
-- Constraints der Tabelle `sc_image`
--
ALTER TABLE `sc_image`
  ADD CONSTRAINT `sc_image_sc_event1` FOREIGN KEY (`eventId`) REFERENCES `sc_event` (`eventId`),
  ADD CONSTRAINT `sc_image_sc_article1` FOREIGN KEY (`articleId`) REFERENCES `sc_article` (`articleId`);

--
-- Constraints der Tabelle `sc_subcategory`
--
ALTER TABLE `sc_subcategory`
  ADD CONSTRAINT `sc_subcategory_sc_category1` FOREIGN KEY (`categoryId`) REFERENCES `sc_category` (`categoryId`);

--
-- Constraints der Tabelle `sc_user`
--
ALTER TABLE `sc_user`
  ADD CONSTRAINT `sc_user_sc_image1` FOREIGN KEY (`imageId`) REFERENCES `sc_image` (`imageId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
