-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 17. Dez 2014 um 15:03
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
  `title` text NOT NULL,
  `article` longtext NOT NULL,
  `originLink` text,
  `userId` int(11) NOT NULL,
  `subCategoryId` int(11) DEFAULT NULL,
  `released` tinyint(4) NOT NULL DEFAULT '0',
  `categoryId` int(11) DEFAULT NULL,
  `teaserImage` int(11) DEFAULT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateLastUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`articleId`),
  KEY `sc_article_sc_user1` (`userId`),
  KEY `sc_article_sc_subcategory1` (`subCategoryId`),
  KEY `fk_sc_article_sc_category1` (`categoryId`),
  KEY `teaserImage` (`teaserImage`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `sc_article`
--

INSERT INTO `sc_article` (`articleId`, `title`, `article`, `originLink`, `userId`, `subCategoryId`, `released`, `categoryId`, `teaserImage`, `dateCreated`, `dateLastUpdated`) VALUES
(2, 'webprog', '<p>Das Projekt konnte <u><em><strong><span style="color:#FF0000"><span style="background-color:rgb(255, 255, 0)">erfolgreich</span></span></strong></em></u> abgeschlossen werden.</p>', NULL, 10023, NULL, 1, 4, 2, '2014-12-17 14:47:20', '2014-12-17 14:47:28'),
(3, 'Limmattalbahn-Projekt: Tempo-30-Zone statt längerer Tunnel für Bahn', 'Die umstrittene Linienführung der Limmattalbahn in Schlieren ZH ist bereinigt: Statt einer Tunnelverlängerung im Spitalquartier soll eine Tempo-30-Zone realisiert werden.', 'http://www.20min.ch/schweiz/zuerich/story/29249332', 9999, NULL, 1, 4, NULL, '2014-12-17 14:52:27', '2014-12-17 14:52:42'),
(4, 'Hausbrand: Herisauer Bar steht in Flammen', 'Kurz vor 13 Uhr ist in Herisau in der Zeughausstrasse 7 Feuer ausgebrochen. Die lokale Feuerwehr ist ausgerückt, um den Brand zu löschen. ', 'http://www.20min.ch/schweiz/ostschweiz/story/19009386', 9999, NULL, 1, 4, NULL, '2014-12-17 14:52:27', '2014-12-17 14:52:42'),
(5, 'Zoo Zürich: Riesen-Schildkröten geben Gas beim Nachwuchs', 'Bei den Galapagos-Schildkröten im Zoo Zürich sind dieses Jahr bereits 16 Junge geschlüpft. Doch damit nicht genug: Am 30. November hat Weibchen Nigrita wieder Eier abgelegt.\n', 'http://www.20min.ch/schweiz/zuerich/story/15142406', 9999, NULL, 1, 4, NULL, '2014-12-17 14:52:27', '2014-12-17 14:52:42'),
(6, 'Neue Alkoholregelung: Light-Bier-Ära im Joggeli ist zu Ende', 'Seit Januar wurde im St. Jakob-Park testweise normales statt Light-Bier ausgeschenkt. Weil die Gewalt nicht zugenommen hat, wird die Praxis nun definitiv eingeführt.', 'http://www.20min.ch/schweiz/basel/story/22891248', 9999, NULL, 1, 4, NULL, '2014-12-17 14:52:27', '2014-12-17 14:52:42'),
(7, 'Neues Produkt: Der legale E-Joint - relaxt, aber berauscht nicht', 'Die E-Hanf-Zigarette soll entspannen, ohne zuzudröhnen: Das legale Produkt sorgt in Frankreich für Aufregung. In der Schweiz ist der Konsum erlaubt, der Verkauf nicht.', 'http://www.20min.ch/schweiz/news/story/25875929', 9999, NULL, 1, 4, NULL, '2014-12-17 14:52:27', '2014-12-17 14:52:42'),
(8, 'Gericht in Thun: «Überlegte mir, das Kind im Garten zu begraben»', 'Die Frau, die 2012 im Berner Oberland ihr Neugeborenes im Kehricht entsorgt haben soll, steht wegen Kindstötung vor Gericht. Sie soll dem Mädchen den Schädel eingedrückt haben.', 'http://www.20min.ch/schweiz/bern/story/16094966', 9999, NULL, 1, 4, NULL, '2014-12-17 14:52:28', '2014-12-17 14:52:42'),
(9, 'Bezirksgericht Zürich: «Perla»-Schütze muss 4,5 Jahre hinter Gitter', 'Der Türke, der in der Zürcher Galerie Perla-Mode zwei Landsleute niedergeschossen hat, wurde wegen mehrfacher Gefährdung des Lebens verurteilt.', 'http://www.20min.ch/schweiz/zuerich/story/30112788', 9999, NULL, 1, 4, NULL, '2014-12-17 14:52:28', '2014-12-17 14:52:42'),
(10, 'Bagatelldelikte: Kiffen, Fischen, Rauchen - dafür gibts Bussen', 'Geht es nach dem Bundesrat, werden in Zukunft auch Bagatelldelikte mit Ordnungsbussen geahndet. Bisher galt dies nur für Verstösse gegen das Strassenverkehrsgesetz.', 'http://www.20min.ch/schweiz/news/story/29733438', 9999, NULL, 1, 4, NULL, '2014-12-17 14:52:28', '2014-12-17 14:52:42');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sc_article_preview`
--

CREATE TABLE IF NOT EXISTS `sc_article_preview` (
  `articlePreviewId` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `article` longtext NOT NULL,
  `userId` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`articlePreviewId`),
  KEY `sc_article_preview_sc_user1` (`userId`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `sc_category`
--

INSERT INTO `sc_category` (`categoryId`, `name`, `description`) VALUES
(1, 'Essen & Trinken', NULL),
(3, 'Business', NULL),
(4, 'News', NULL),
(5, 'Mehr', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sc_comment`
--

CREATE TABLE IF NOT EXISTS `sc_comment` (
  `commentId` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `userId` int(11) NOT NULL,
  `articleId` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`commentId`),
  KEY `sc_comment_sc_user1` (`userId`),
  KEY `sc_comment_sc_article1` (`articleId`)
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
  PRIMARY KEY (`imageId`),
  KEY `sc_image_sc_article1` (`articleId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10000 ;

--
-- Daten für Tabelle `sc_image`
--

INSERT INTO `sc_image` (`imageId`, `physicalPath`, `alternativeText`, `articleId`) VALUES
(2, 'images/upload/articles/e1367566837041279de07cc24cb2a23648ab09993be04bd2a2948d82350e51e7.jpeg', NULL, NULL),
(3, 'images/upload/avatars/eb108124fa611adb1fe0ffbba8523bf2e4c2d453632839e16239d9018193ef35.jpeg', NULL, NULL),
(9999, 'images/upload/avatars/9999.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sc_migration`
--

CREATE TABLE IF NOT EXISTS `sc_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `sc_migration`
--

INSERT INTO `sc_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1413962085),
('m141022_065730_insert_some_categories', 1413962089),
('m141022_121658_create_table_webcrawler', 1413980657),
('m141022_172542_add_col_accessToken_to_user', 1413998792),
('m141024_135000_rename_col_realeased_to_released', 1414158683),
('m141024_144721_insert_rss_user', 1414162218),
('m141024_155633_adapt_article_webcrawler', 1414166885),
('m141031_145519_create_table_webcrawler_import_log', 1414769413),
('m141031_170520_add_col_counter_to_webcrawler_import_log', 1414775497),
('m141113_094334_update_table_article_for_feeds', 1415872463),
('m141113_101156_add_col_to', 1415873921),
('m141123_212751_add_col_timestamp_to_comment', 1416778327),
('m141127_185447_add_col_salt_to_user', 1417119143),
('m141127_185722_add_col_activation_to_user', 1417119145),
('m141127_201522_change_col_email_in_user', 1417123562),
('m141128_105204_make_username_and_email_unique', 1417182579),
('m141201_094952_create_table_articlepreview', 1417427784),
('m141203_153854_add_fk_article_teaserimage', 1417621214),
('m141207_134708_adapt_table_article', 1417960284),
('m141207_215018_remove_evententries_from_categories', 1417989297);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Daten für Tabelle `sc_subcategory`
--

INSERT INTO `sc_subcategory` (`subCategoryId`, `name`, `description`, `categoryId`) VALUES
(1, 'Bier & Wein', NULL, 1),
(2, 'Restaurants', NULL, 1),
(3, 'Bars', NULL, 1),
(7, 'Sport', NULL, 5),
(8, 'Kunst', NULL, 5),
(9, 'Fotos', NULL, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sc_user`
--

CREATE TABLE IF NOT EXISTS `sc_user` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) NOT NULL,
  `password` varchar(128) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `imageId` int(11) DEFAULT NULL,
  `accessToken` text,
  `salt` varchar(128) NOT NULL,
  `activationKey` varchar(128) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `passwordResetKey` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `sc_user_userName_unique` (`userName`),
  KEY `sc_user_sc_image1` (`imageId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10024 ;

--
-- Daten für Tabelle `sc_user`
--

INSERT INTO `sc_user` (`userId`, `userName`, `password`, `firstName`, `lastName`, `email`, `imageId`, `accessToken`, `salt`, `activationKey`, `active`, `passwordResetKey`) VALUES
(9999, 'SOLCITY_RSS_CRAWLER', '3c9783f7b74d1e5b78e0d76ed33fbf4606582d487211bfeff7303e51c05a4ff1ddfa2402a71899a47e22a598ddaffd833e357c7cd55cda02a1788bdeae9319ff', '', '', 'solcityactivate@gmail.com', 9999, NULL, 'ddf0023cd79a6909cc7e41e3442e9a831783c0c874ab2eb66d41d9cf333ede6bb902dd2919b3898e456fb3c726d29e9e9897f6dfe2fe75eeb42c33c24bed432f', NULL, 1, NULL),
(10023, 'test', '74884fea4b49e0aa591cdbcd1aa63c8d46304db0a6232be47857bb3e7d6ed13b7f6652a97e30498f962a97084b28df049ca00538e067c11b970a564f7dd111fc', 'Peter', 'Muster', 'dominiquehelfer@msn.com', 3, '***', '04b6d8187ca5f042888be898d6cdb534fd4f64ab2da2e8586132eaf3369bab6442eaf35d06150a1e0f615f5a11dfbc6e7dba160177e4f77a84f7021d23794ff7', '***', 1, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sc_webcrawler`
--

CREATE TABLE IF NOT EXISTS `sc_webcrawler` (
  `webcrawlerId` int(11) NOT NULL AUTO_INCREMENT,
  `link` text NOT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `subCategoryId` int(11) DEFAULT NULL,
  `specialMapping` text,
  PRIMARY KEY (`webcrawlerId`),
  KEY `fk_sc_webcrawler_sc_category1` (`categoryId`),
  KEY `fk_sc_webcrawler_sc_subcategory1` (`subCategoryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `sc_webcrawler`
--

INSERT INTO `sc_webcrawler` (`webcrawlerId`, `link`, `categoryId`, `subCategoryId`, `specialMapping`) VALUES
(1, 'http://www.20min.ch/rss/rss.tmpl?type=channel&get=4', 4, NULL, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sc_webcrawler_import_log`
--

CREATE TABLE IF NOT EXISTS `sc_webcrawler_import_log` (
  `webcrawlerImportLogId` int(11) NOT NULL AUTO_INCREMENT,
  `webcrawlerId` int(11) NOT NULL,
  `articleId` int(11) DEFAULT NULL,
  `executionTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text,
  `runNumber` int(11) NOT NULL,
  PRIMARY KEY (`webcrawlerImportLogId`),
  KEY `fk_sc_webcrawler_import_log_sc_webcrawler1` (`webcrawlerId`),
  KEY `fk_sc_webcrawler_import_log_sc_article1` (`articleId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `sc_webcrawler_import_log`
--

INSERT INTO `sc_webcrawler_import_log` (`webcrawlerImportLogId`, `webcrawlerId`, `articleId`, `executionTime`, `message`, `runNumber`) VALUES
(1, 1, 3, '2014-12-17 13:52:27', NULL, 1),
(2, 1, 4, '2014-12-17 13:52:27', NULL, 1),
(3, 1, 5, '2014-12-17 13:52:27', NULL, 1),
(4, 1, 6, '2014-12-17 13:52:27', NULL, 1),
(5, 1, 7, '2014-12-17 13:52:27', NULL, 1),
(6, 1, 8, '2014-12-17 13:52:28', NULL, 1),
(7, 1, 9, '2014-12-17 13:52:28', NULL, 1),
(8, 1, 10, '2014-12-17 13:52:28', NULL, 1);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `sc_article`
--
ALTER TABLE `sc_article`
  ADD CONSTRAINT `fk_sc_article_sc_category1` FOREIGN KEY (`categoryId`) REFERENCES `sc_category` (`categoryId`),
  ADD CONSTRAINT `fk_sc_article_sc_image` FOREIGN KEY (`teaserImage`) REFERENCES `sc_image` (`imageId`),
  ADD CONSTRAINT `sc_article_sc_subcategory1` FOREIGN KEY (`subCategoryId`) REFERENCES `sc_subcategory` (`subCategoryId`),
  ADD CONSTRAINT `sc_article_sc_user1` FOREIGN KEY (`userId`) REFERENCES `sc_user` (`userId`);

--
-- Constraints der Tabelle `sc_article_preview`
--
ALTER TABLE `sc_article_preview`
  ADD CONSTRAINT `sc_article_preview_sc_user1` FOREIGN KEY (`userId`) REFERENCES `sc_user` (`userId`);

--
-- Constraints der Tabelle `sc_comment`
--
ALTER TABLE `sc_comment`
  ADD CONSTRAINT `sc_comment_sc_article1` FOREIGN KEY (`articleId`) REFERENCES `sc_article` (`articleId`),
  ADD CONSTRAINT `sc_comment_sc_user1` FOREIGN KEY (`userId`) REFERENCES `sc_user` (`userId`);

--
-- Constraints der Tabelle `sc_image`
--
ALTER TABLE `sc_image`
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

--
-- Constraints der Tabelle `sc_webcrawler`
--
ALTER TABLE `sc_webcrawler`
  ADD CONSTRAINT `fk_sc_webcrawler_sc_category1` FOREIGN KEY (`categoryId`) REFERENCES `sc_category` (`categoryId`),
  ADD CONSTRAINT `fk_sc_webcrawler_sc_subcategory1` FOREIGN KEY (`subCategoryId`) REFERENCES `sc_subcategory` (`subCategoryId`);

--
-- Constraints der Tabelle `sc_webcrawler_import_log`
--
ALTER TABLE `sc_webcrawler_import_log`
  ADD CONSTRAINT `fk_sc_webcrawler_import_log_sc_article1` FOREIGN KEY (`articleId`) REFERENCES `sc_article` (`articleId`),
  ADD CONSTRAINT `fk_sc_webcrawler_import_log_sc_webcrawler1` FOREIGN KEY (`webcrawlerId`) REFERENCES `sc_webcrawler` (`webcrawlerId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
