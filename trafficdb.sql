-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2024 at 12:12 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trafficdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_priority`
--

CREATE TABLE `tbl_priority` (
  `id` int(11) NOT NULL,
  `signals` varchar(50) NOT NULL,
  `priority` int(11) NOT NULL,
  `greenlight` int(11) NOT NULL,
  `yellowlight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_priority`
--

INSERT INTO `tbl_priority` (`id`, `signals`, `priority`, `greenlight`, `yellowlight`) VALUES
(1, 'A', 4, 10, 3),
(2, 'B', 3, 10, 3),
(3, 'C', 2, 10, 3),
(4, 'D', 1, 10, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_priority`
--
ALTER TABLE `tbl_priority`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_priority`
--
ALTER TABLE `tbl_priority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
