-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 03:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payment`
--

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `amount` int(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `reference_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `amount`, `quantity`, `total`, `status`, `reference_number`) VALUES
(1, 400, 2, 0, '', 0),
(2, 400, 2, 0, '', 0),
(3, 600, 3, 0, '', 0),
(4, 600, 3, 0, '', 0),
(5, 400, 2, 0, '', 0),
(6, 600, 3, 0, '', 0),
(7, 400, 2, 0, '', 0),
(8, 600, 3, 0, '', 0),
(9, 200, 1, 0, '', 0),
(10, 200, 1, 0, '', 0),
(11, 200, 1, 0, '', 0),
(12, 200, 1, 0, '', 0),
(13, 200, 1, 0, '', 0),
(14, 200, 1, 0, '', 0),
(15, 200, 1, 0, '', 0),
(16, 1600, 8, 0, '', 0),
(17, 600, 3, 0, '', 0),
(18, 200, 1, 0, '', 0),
(19, 600, 3, 0, '', 0),
(20, 600, 3, 0, '', 0),
(21, 800, 4, 0, '', 0),
(22, 2400, 12, 0, '', 0),
(23, 200, 1, 0, '', 0),
(24, 200, 1, 0, '', 0),
(25, 600, 3, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orderz` (
  `orderID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `bust` int(11) NOT NULL,
  `waist` int(11) NOT NULL,
  `shoulder` int(11) NOT NULL,
  `fabric` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;