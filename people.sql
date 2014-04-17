-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 17, 2014 at 04:20 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `people`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `registered_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `email`, `registered_timestamp`) VALUES
(10, 'misterpah', '$2y$10$LAQv5VEJeYDG41p4iJWQ0euiuJCOcLaXj0mJTQwAX4yt5b6rdO6fW', 'misterpah@gmail.com', '2014-04-16 04:17:00'),
(11, 'misterpaha', '$2y$10$QnWLafUreHElV.tFcEcz3OtbRUfccgSwQtu.zZSNEl8OtlhD7xPhu', 'misterpah@gmail.com', '2014-04-16 08:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE IF NOT EXISTS `details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `variable` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `user_id`, `variable`, `value`) VALUES
(1, 10, 'G+', 'misterpah/abc/123'),
(2, 10, 'facebook', 'misterpah');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `logout_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

