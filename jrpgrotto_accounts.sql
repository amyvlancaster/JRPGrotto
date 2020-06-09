-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2020 at 11:30 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jrpgrotto_accounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `character_profiles`
--

CREATE TABLE `character_profiles` (
  `id` int(11) NOT NULL,
  `jrpg_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `job_role` varchar(255) DEFAULT NULL,
  `weapon` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `image_file` varchar(255) DEFAULT NULL,
  `posted` date DEFAULT NULL,
  `author` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `character_profiles`
--

INSERT INTO `character_profiles` (`id`, `jrpg_id`, `game_id`, `first_name`, `last_name`, `job_role`, `weapon`, `item`, `image_file`, `posted`, `author`) VALUES
(4, 6, 2, 'Lydie', 'Malen', 'Alchemist', 'None', 'Staff', 'Lydie.jpg', '2020-04-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `ID` int(11) NOT NULL,
  `franchise_name` varchar(255) DEFAULT NULL,
  `game_name` varchar(255) DEFAULT NULL,
  `publisher_name` varchar(255) DEFAULT NULL,
  `game_date` date DEFAULT NULL,
  `subseries` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`ID`, `franchise_name`, `game_name`, `publisher_name`, `game_date`, `subseries`, `platform`, `user_id`) VALUES
(2, 'Atelier', 'Lydie and Suelle The Alchemists and the Mysterious Paintings', 'Koei Tecmo', '2017-12-21', 'The Mysterious Series', 'Playstation 4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jrpg`
--

CREATE TABLE `jrpg` (
  `ID` int(11) NOT NULL,
  `franchise_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jrpg`
--

INSERT INTO `jrpg` (`ID`, `franchise_name`) VALUES
(2, 'Persona'),
(3, 'Xeno'),
(6, 'Atelier');

-- --------------------------------------------------------

--
-- Table structure for table `platform`
--

CREATE TABLE `platform` (
  `ID` int(11) NOT NULL,
  `platform_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `platform`
--

INSERT INTO `platform` (`ID`, `platform_name`) VALUES
(3, 'Playstation 4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `is_locked` binary(1) DEFAULT NULL,
  `login_fail_count` int(11) DEFAULT NULL,
  `lock_start_timestamp` datetime DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `DOB` datetime DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `is_locked`, `login_fail_count`, `lock_start_timestamp`, `email`, `first_name`, `last_name`, `DOB`, `role`) VALUES
(1, 'Amivicky', '$2y$10$ZC1ORPni/kxU63AginTuZuilIwC/dqJ9eVhmuO0lrHR6qxs.m1acy', '2020-04-05 15:51:57', NULL, NULL, NULL, 'amy.lancaster@mymail.champlain.edu', 'Amy', 'Lancaster', '1990-11-08 00:00:00', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `character_profiles`
--
ALTER TABLE `character_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `jrpg`
--
ALTER TABLE `jrpg`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `platform`
--
ALTER TABLE `platform`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `character_profiles`
--
ALTER TABLE `character_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jrpg`
--
ALTER TABLE `jrpg`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `platform`
--
ALTER TABLE `platform`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
