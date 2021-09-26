-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Sep 26, 2021 at 01:40 PM
-- Server version: 8.0.22
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event`
--

-- --------------------------------------------------------

--
-- Table structure for table `scans`
--

CREATE TABLE `scans` (
  `id` int NOT NULL,
  `kode` varchar(9) NOT NULL,
  `pendaftars_id` int NOT NULL,
  `scan` int NOT NULL,
  `jam` time NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scans`
--

INSERT INTO `scans` (`id`, `kode`, `pendaftars_id`, `scan`, `jam`, `date`, `user_id`, `created_at`) VALUES
(12, 'K20140040', 40, 1, '13:24:11', '2021-09-26 13:24:11', 1, '2021-09-26 13:24:11'),
(13, 'K20180039', 39, 1, '13:31:52', '2021-09-26 13:31:52', 1, '2021-09-26 13:31:52'),
(14, 'K20110041', 41, 1, '13:37:13', '2021-09-26 13:37:13', 1, '2021-09-26 13:37:13'),
(15, 'K20110036', 37, 1, '13:39:07', '2021-09-26 13:39:07', 1, '2021-09-26 13:39:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scans`
--
ALTER TABLE `scans`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scans`
--
ALTER TABLE `scans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
