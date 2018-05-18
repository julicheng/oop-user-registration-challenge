-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 18, 2018 at 07:20 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oop_user_registration_challenge`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `title`, `content`) VALUES
(2, 13, 'Test', 'Testing'),
(6, 13, 'Hello', 'hellooooooooooooooooooooooooooooooo'),
(4, 14, 'Test1', 'Testing'),
(5, 14, 'Test', 'Testing'),
(8, 13, 'Groceries', 'helloooooooooooooooooooooooooooooo'),
(9, 14, 'jkdhslf', 'jkfl;sjf;dsfjsfdsfdsf'),
(11, 25, 'hello', 'ksdfjsdfddsdsdsdsd'),
(14, 25, 'yoyoyoyo asd', 'h;rlhlsfsdfsdfsdf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `hashed_password` varchar(255) DEFAULT NULL,
  `profile_img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `hashed_password`, `profile_img`) VALUES
(13, 'Juli', 'Cheng', 'hellojuli@gmail.com', '$2y$10$ojfQc7bAtTbvktDzC8lba.KgCqtItBubBah8v/wCwXPmxZCokWX.C', 'noimage.jpg'),
(14, 'John', 'Smith', 'hellojohn@gmail.com', '$2y$10$m7xWKV20SBqym680ImxOB.izgD0.zFbO1QUlVwRP89GSJ4Ml2Ccya', 'noimage.jpg'),
(20, 'Test', 'Test', 'testing@gmail.com', '$2y$10$UjRzAmjMBpYJUkpNkxC65egyHtqPknfwxlilmYBvikvg75.tFUoSS', 'noimage.jpg'),
(18, 'Blah', 'blah', 'helloblah@gmail.com', '$2y$10$Bm4V0PP21HxIQCkFOxZwn.3WFF/p/sZOeq.VA51A6H8qA4xqkryfy', 'noimage.jpg'),
(19, 'Juli', 'Cheng', 'blah@gmail.com', '$2y$10$w/WtI2p7mEBuIbeVkIJSkuR/p.GTWBY2h7eI4mqZOtg25lXheApQC', 'noimage.jpg'),
(26, 'sdfldsfjsf', 'sjfsdkf;sfj', 'dsjfsf@gmail.com', '$2y$10$0REOzkjFTG2afa9b9gXL4OgeV66UOGCBsRdy5x6MrRzGcQTnhcCY6', 'noimage.jpg'),
(25, 'Blah', 'Testings', 'hello@gmail.com', '$2y$10$b0vPc5Pz3IPMx9Nlon8gKeEP8YABtyhkWZ9MCDz30PS1.zgd60W8m', 'noimage.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
