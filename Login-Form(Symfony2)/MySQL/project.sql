-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.17 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             8.0.0.4396
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for phonebook
DROP DATABASE IF EXISTS `phonebook`;
CREATE DATABASE IF NOT EXISTS `phonebook` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `phonebook`;


-- Dumping structure for table phonebook.contacts
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contacts_user_idx` (`user_id`),
  CONSTRAINT `fk_contacts_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- Dumping data for table phonebook.contacts: ~0 rows (approximately)
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` (`id`, `first_name`, `last_name`, `address`, `email`, `user_id`) VALUES
	(4, 'dasdas', 'dasdas', 'asdas', 'asdas', 2),
	(5, 'dasdas', 'dasdas', 'asdas', 'asdas', 2),
	(6, 'dasdasdasdsadsa', 'dasdasSSSS', 'XXXX 123', 'asdas@dsds.ds', 1),
	(7, 'dasdas', 'dasdas', 'asdas', 'asdas', 1);
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;


-- Dumping structure for table phonebook.phone_numbers
DROP TABLE IF EXISTS `phone_numbers`;
CREATE TABLE IF NOT EXISTS `phone_numbers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(45) NOT NULL,
  `type` enum('work','home','mobile') NOT NULL,
  `contacts_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_phone_numbers_contacts1_idx` (`contacts_id`),
  CONSTRAINT `fk_phone_numbers_contacts1` FOREIGN KEY (`contacts_id`) REFERENCES `contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- Dumping data for table phonebook.phone_numbers: ~0 rows (approximately)
/*!40000 ALTER TABLE `phone_numbers` DISABLE KEYS */;
INSERT INTO `phone_numbers` (`id`, `number`, `type`, `contacts_id`) VALUES
	(29, 'asdfasdfasdfsd', 'work', 6),
	(30, 'xxxx13312312312', 'mobile', 6),
	(31, '432423423423', 'work', 7);
/*!40000 ALTER TABLE `phone_numbers` ENABLE KEYS */;


-- Dumping structure for table phonebook.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table phonebook.user: ~0 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `email`, `first_name`, `last_name`) VALUES
	(1, 'admin', 'pass', 'asdas@dsd.ds', 'dsad', 'dasd'),
	(2, 'xxx', 'xxx', 'sadas@dsds.ds', 'dasda', 'asdas'),
	(3, 'dsadasdas', 'asdasdasdas', 'asdasdasdas', 'sadasdasd', 'asdsadasd');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
