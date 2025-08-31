-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 26, 2025 at 09:07 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `medicine_id` (`medicine_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(222) NOT NULL,
  `pic` varchar(111) NOT NULL,
  `details` varchar(333) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `pic`, `details`, `date`) VALUES
(1, 'Capsule', 'cap.png', 'these are capsules whisd some k dsfksd', '2017-11-03 04:58:57'),
(2, 'Tablets', 'tablet.png', 'some of the pic to be modii dfs tablet', '2017-11-03 04:58:57'),
(3, 'Syrup', 'syrup.png', 'these are capsules whisd some k dsfksd', '2017-11-03 04:59:24'),
(4, 'Cream', 'cream.png', 'some of the pic to be modii dfs tablet', '2017-11-03 04:59:24'),
(5, 'Lotion', 'lotion.png', 'these are capsules whisd some k dsfksd', '2017-11-03 04:59:59'),
(6, 'Syrunj', 'syrunj.png', 'some of the pic to be modii dfs tablet', '2017-11-03 04:59:59'),
(7, 'Injection', 'injection.jpg', 'these are capsules whisd some k dsfksd', '2017-11-03 05:00:19'),
(8, 'Other', 'fk.jpg', 'some of the pic to be modii dfs tablet', '2017-11-03 05:00:19');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'wqe', 'qwe@gmail.com', '$2y$10$TS9LA8afoVAuPOejEkZpU./9hCP0SG4X5.BkIoxwGMJWfbNR6nf2G', '2025-03-26 15:16:46'),
(2, 'zxc', 'zxc@gmail.com', '$2y$10$ugVRI4ViDVN7NkbxinG.feYwo9T5Njn9n.jIpMk6EfCRn3LqoIOCu', '2025-03-26 17:10:08'),
(3, 'asd', 'asd@gmail.com', '$2y$10$gb96cwUL7B/yStdwMdPpaOZvKHXZCTruncrUMHLKPfOrbyqhomj1W', '2025-03-26 17:55:08');

-- --------------------------------------------------------

--
-- Table structure for table `inventeries`
--

DROP TABLE IF EXISTS `inventeries`;
CREATE TABLE IF NOT EXISTS `inventeries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catId` int(11) NOT NULL,
  `supplier` varchar(222) NOT NULL,
  `name` text NOT NULL,
  `unit` text NOT NULL,
  `price` text NOT NULL,
  `pic` text NOT NULL,
  `description` text NOT NULL,
  `company` varchar(111) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventeries`
--

INSERT INTO `inventeries` (`id`, `catId`, `supplier`, `name`, `unit`, `price`, `pic`, `description`, `company`, `date`) VALUES
(5, 2, 'Arif Khan', 'Disprin', '6mg', '7', 'fk.jpg', 'these are 2mg disprin for the cure of some thing extera', 'fasdf', '2017-11-03 06:10:37'),
(6, 2, 'Arif Khan', 'Disprin', '6mg', '7', 'fk.jpg', 'these are 2mg disprin for the cure of some thing extera', 'sdfas', '2017-11-03 06:10:40'),
(7, 2, 'Arif Khan', 'Disprin', '6mg', '7', 'fk.jpg', 'these are 2mg disprin for the cure of some thing extera', '0', '2017-11-03 06:10:43'),
(9, 2, 'Arif Khan', 'Disprin', '6mg', '7', 'fk.jpg', 'these are 2mg disprin for the cure of some thing extera', '0', '2017-11-03 06:10:48'),
(10, 3, 'Arif Khan', 'Disprin', '6mg', '6', 'fk.jpg', 'these are 2mg disprin for the cure of some thing extera', '0', '2017-11-03 06:11:36'),
(11, 3, 'Arif Khan', 'Disprin', '6mg', '7', 'fk.jpg', 'these are 2mg disprin for the cure of some thing extera', '0', '2017-11-03 06:11:43'),
(12, 4, 'Arif Khan', 'Disprin', '6mg', '8', 'fk.jpg', 'these are 2mg disprin for the cure of some thing extera', '0', '2017-11-03 06:11:50'),
(13, 4, 'Arif Khan', 'Disprin', '6mg', '7', 'fk.jpg', 'these are 2mg disprin for the cure of some thing extera', '0', '2017-11-03 06:11:53'),
(14, 4, 'Arif Khan', 'Disprin', '6mg', '7', 'fk.jpg', 'these are 2mg disprin for the cure of some thing extera', '0', '2017-11-03 06:11:56'),
(15, 5, 'Arif Khan', 'Disprin', '6mg', '7', 'fk.jpg', 'these are 2mg disprin for the cure of some thing extera', '0', '2017-11-03 06:12:03'),
(16, 6, 'Arif Khan', 'Disprin', '6mg', '7', 'fk.jpg', 'these are 2mg disprin for the cure of some thing extera', '0', '2017-11-03 06:12:09'),
(17, 6, 'Arif Khan', 'Disprin', '6mg', '7', 'fk.jpg', 'these are 2mg disprin for the cure of some thing extera', '0', '2017-11-03 06:12:14'),
(18, 6, 'Arif Khan', 'Disprin', '6mg', '7', 'fk.jpg', 'these are 2mg disprin for the cure of some thing extera', '0', '2017-11-03 06:12:17'),
(19, 6, 'Arif Khan', 'Disprin', '6mg', '7', 'fk.jpg', 'these are 2mg disprin for the cure of some thing extera', '0', '2017-11-03 06:12:21'),
(20, 1, 'Asif Khan', 'Panadol', '100mg', '12', '', 'there is no askdfas dfsakdfkas', 'atalfa', '2017-11-17 16:20:25');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

DROP TABLE IF EXISTS `medicines`;
CREATE TABLE IF NOT EXISTS `medicines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

DROP TABLE IF EXISTS `site`;
CREATE TABLE IF NOT EXISTS `site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(222) NOT NULL,
  `name` varchar(222) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `title`, `name`) VALUES
(1, 'Medical Stores', 'Medical Stores');

-- --------------------------------------------------------

--
-- Table structure for table `sold`
--

DROP TABLE IF EXISTS `sold`;
CREATE TABLE IF NOT EXISTS `sold` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(222) NOT NULL,
  `contact` varchar(222) NOT NULL,
  `discount` varchar(222) NOT NULL,
  `item` varchar(222) NOT NULL,
  `amount` varchar(222) NOT NULL,
  `userId` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sold`
--

INSERT INTO `sold` (`id`, `name`, `contact`, `discount`, `item`, `amount`, `userId`, `date`) VALUES
(2, 'khan Shoaib', '03445584686', '10', '2', '3', 1, '2017-11-17 15:44:15'),
(3, 'sdfgsd', 'dsfgsdf', '10', '3', '25', 1, '2017-11-17 16:47:22'),
(4, 'Younis', '03451212345', '21', '4', '35', 1, '2017-11-19 08:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `pic` text NOT NULL,
  `number` text NOT NULL,
  `address` text NOT NULL,
  `cnic` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `pic`, `number`, `address`, `cnic`, `date`) VALUES
(1, 'faisal khan', 'fk.jpg', '2432342342', 'adfasdfasfdasdf', '2342342342423423', '2017-11-03 07:23:49'),
(2, 'faisal khan', 'fk.jpg', '2432342342', 'adfasdfasfdasdf', '2342342342423423', '2017-11-03 07:23:53'),
(3, 'faisal khan', 'fk.jpg', '2432342342', 'adfasdfasfdasdf', '2342342342423423', '2017-11-03 07:23:56'),
(4, 'faisal khan', 'fk.jpg', '2432342342', 'adfasdfasfdasdf', '2342342342423423', '2017-11-03 07:23:59'),
(5, 'faisal khan', 'fk.jpg', '2432342342', 'adfasdfasfdasdf', '2342342342423423', '2017-11-03 07:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `name` varchar(222) NOT NULL,
  `pic` varchar(222) NOT NULL,
  `number` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `pic`, `number`, `date`) VALUES
(1, 'admin@gmail.com', 'admin', 'FK', 'fk.jpg', '03356910260', '2017-11-02 12:34:53');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
