-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           10.5.10-MariaDB - mariadb.org binary distribution
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour record
DROP DATABASE IF EXISTS `record`;
CREATE DATABASE IF NOT EXISTS `record` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `record`;

-- Listage de la structure de la table record. artist
DROP TABLE IF EXISTS `artist`;
CREATE TABLE IF NOT EXISTS `artist` (
  `artist_id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_name` varchar(255) DEFAULT NULL,
  `artist_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`artist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Listage des données de la table record.artist : ~10 rows (environ)
/*!40000 ALTER TABLE `artist` DISABLE KEYS */;
INSERT INTO `artist` (`artist_id`, `artist_name`, `artist_url`) VALUES
	(1, 'Neil Young', NULL),
	(2, 'YES', NULL),
	(3, 'Rolling Stones', NULL),
	(4, 'Queens of the Stone Age', NULL),
	(5, 'Serge Gainsbourg', NULL),
	(6, 'AC/DC', NULL),
	(7, 'Marillion', NULL),
	(8, 'Bob Dylan', NULL),
	(9, 'Fleshtones', NULL),
	(10, 'The Clash', NULL);
/*!40000 ALTER TABLE `artist` ENABLE KEYS */;

-- Listage de la structure de la table record. disc
DROP TABLE IF EXISTS `disc`;
CREATE TABLE IF NOT EXISTS `disc` (
  `disc_id` int(11) NOT NULL AUTO_INCREMENT,
  `disc_title` varchar(255) DEFAULT NULL,
  `disc_year` int(11) DEFAULT NULL,
  `disc_picture` varchar(255) DEFAULT NULL,
  `disc_label` varchar(255) DEFAULT NULL,
  `disc_genre` varchar(255) DEFAULT NULL,
  `disc_price` decimal(6,2) DEFAULT NULL,
  `artist_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`disc_id`),
  KEY `artist_id` (`artist_id`),
  CONSTRAINT `disc_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- Listage des données de la table record.disc : ~15 rows (environ)
/*!40000 ALTER TABLE `disc` DISABLE KEYS */;
INSERT INTO `disc` (`disc_id`, `disc_title`, `disc_year`, `disc_picture`, `disc_label`, `disc_genre`, `disc_price`, `artist_id`) VALUES
	(1, 'Fugazi', 1984, 'fugazi.jpeg', 'EMI', 'Prog', 14.99, 7),
	(2, 'Songs for the Deaf', 2002, 'songs_for_the_deaf.jpeg', 'Interscope Records', 'Rock/Stoner', 12.99, 4),
	(3, 'Harvest Moon', 1992, 'harvest_moon.jpeg', 'Reprise Records', 'Rock', 4.20, 1),
	(4, 'Initials BB', 1968, 'initials_bb.jpeg', 'Philips', ' Chanson, Pop Rock', 12.99, 5),
	(5, 'After the Gold Rush', 1970, 'after_the_gold_rush.jpeg', ' Reprise Records', 'Country Rock', 20.00, 1),
	(6, 'Broken Arrow', 1996, 'broken_arrow.jpeg', 'Reprise Records', ' Country Rock, Classic Rock', 15.00, 1),
	(7, 'Highway To Hell', 1979, 'highway_to_hell.jpeg', 'Atlantic', 'Hard Rock', 15.00, 6),
	(8, 'Drama', 1980, 'drama.jpeg', 'Atlantic', 'Prog', 15.00, 2),
	(9, 'Year of the Horse', 1997, 'year_of_the_horse.jpeg', 'Reprise Records', 'Country Rock, Classic Rock', 7.50, 1),
	(10, 'Ragged Glory', 1990, 'ragged_glory.jpeg', 'Reprise Records', 'Country Rock, Grunge', 11.00, 1),
	(11, 'Rust Never Sleeps', 1979, 'rust_never_sleeps.jpeg', 'Reprise Records', 'Classic Rock, Arena Rock', 15.00, 1),
	(12, 'Exile on main street', 1972, 'exile_on_main_street.jpeg', 'Rolling Stones Records', 'Blues Rock, Classic Rock', 33.00, 1),
	(13, 'London Calling', 1971, 'london__calling.jpeg', 'CBS', 'Punk, New Wave', 33.00, 10),
	(14, 'Beggars Banquet', 1968, 'beggars_banquet.jpeg', 'Rolling Stones Records', 'Blues Rock, Classic Rock', 33.00, 1),
	(15, 'Laboratory of sound', 1995, 'laboratory_of_sound.jpeg', 'Rebel Rec.', 'Rock', 33.00, 9);
/*!40000 ALTER TABLE `disc` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
