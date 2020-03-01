-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 01, 2020 at 11:56 AM
-- Server version: 5.7.11
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feedback-site`
--

-- --------------------------------------------------------

--
-- Table structure for table `suggestions`
--

CREATE TABLE `suggestions` (
  `nr` int(11) NOT NULL,
  `title` text COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `date` text COLLATE utf8_bin NOT NULL,
  `nick` text COLLATE utf8_bin NOT NULL,
  `votes` int(11) NOT NULL,
  `status` text COLLATE utf8_bin NOT NULL,
  `edited` int(11) NOT NULL,
  `edit_date` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_comments`
--

CREATE TABLE `ticket_comments` (
  `ticket_nr` int(11) NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `date` text COLLATE utf8_bin NOT NULL,
  `author` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` text COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_tickets`
--

CREATE TABLE `user_tickets` (
  `nr` int(11) NOT NULL,
  `title` text COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `date` text COLLATE utf8_bin NOT NULL,
  `nick` text COLLATE utf8_bin NOT NULL,
  `status` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `vote_nr` int(11) NOT NULL,
  `voter` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `suggestions`
--
ALTER TABLE `suggestions`
  ADD PRIMARY KEY (`nr`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tickets`
--
ALTER TABLE `user_tickets`
  ADD PRIMARY KEY (`nr`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `suggestions`
--
ALTER TABLE `suggestions`
  MODIFY `nr` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_tickets`
--
ALTER TABLE `user_tickets`
  MODIFY `nr` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
