-- phpMyAdmin SQL Dump
-- version 4.3.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2015 at 10:16 PM
-- Server version: 5.6.23
-- PHP Version: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `school`
--

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `code`, `name`, `IsDeleted`) VALUES
(1, 1, 'test class', 0);

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`, `IsDeleted`) VALUES
(1, 'admin', 0),
(2, 'manager', 0),
(7, 'test1', 0);

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `first_name`, `last_name`, `gender`, `email`, `address`, `IsDeleted`) VALUES
(1, 'test first name', 'test last name', 'M', 'test@test.test', 'test address', 0),
(2, 'test first name 2', 'test last name 2', 'F', 'test2@test2.test2', 'test address 2', 0);

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `password`, `role_id`, `username`, `IsDeleted`) VALUES
(4, '202cb962ac59075b964b07152d234b70', 7, 'test1', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
