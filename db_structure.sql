-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 15, 2011 at 07:22 AM
-- Server version: 5.1.56
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crictwit_peyar`
--

-- --------------------------------------------------------

--
-- Table structure for table `names`
--

CREATE TABLE IF NOT EXISTS `names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(100) NOT NULL DEFAULT '',
  `meaning` varchar(255) DEFAULT '',
  `gender` enum('boy','girl') DEFAULT NULL,
  `source` char(30) NOT NULL DEFAULT '',
  `prefix` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`gender`),
  KEY `prefix` (`prefix`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47212 ;

-- --------------------------------------------------------

--
-- Table structure for table `name_contents`
--

CREATE TABLE IF NOT EXISTS `name_contents` (
  `name_id` int(11) NOT NULL,
  `contents` longtext CHARACTER SET utf8,
  PRIMARY KEY (`name_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
