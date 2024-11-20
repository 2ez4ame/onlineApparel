-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 05:28 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apparel`
--

-- --------------------------------------------------------

--
-- Table structure for table `designs`
--

CREATE TABLE `designs` (
  `id` int(11) NOT NULL,
  `color` varchar(20) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `font` varchar(50) DEFAULT NULL,
  `model_state` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saved_design`
--

CREATE TABLE `saved_design` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `size` varchar(50) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `model_file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `garmentColor` varchar(7) NOT NULL,
  `textInput` text NOT NULL,
  `fontSelect` varchar(50) NOT NULL,
  `textSize` int(11) NOT NULL,
  `textColor` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saved_design`
--

INSERT INTO `saved_design` (`id`, `user_id`, `title`, `size`, `image_url`, `model_file_path`, `created_at`, `garmentColor`, `textInput`, `fontSelect`, `textSize`, `textColor`) VALUES
(1, 0, '', '', '', NULL, '2024-11-19 01:43:26', '#ffffff', '', 'Arial', 16, '#000000'),
(2, 0, '', '', '', NULL, '2024-11-19 01:43:36', '#ffffff', '', 'Arial', 16, '#000000'),
(3, 0, '', '', '', NULL, '2024-11-19 02:09:57', '#c11515', 'roel', 'Arial', 16, '#000000'),
(4, 0, '', '', '', NULL, '2024-11-19 02:27:26', '#9a1d1d', '', 'Arial', 16, '#000000'),
(5, 0, '', '', '', NULL, '2024-11-19 02:28:55', '#9a1d1d', '', 'Arial', 16, '#000000');

-- --------------------------------------------------------

--
-- Table structure for table `t_shirt_designs`
--

CREATE TABLE `t_shirt_designs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `garment_color` varchar(7) NOT NULL,
  `text_input` varchar(255) NOT NULL,
  `font_select` varchar(100) NOT NULL,
  `text_size` int(11) NOT NULL,
  `text_color` varchar(7) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `phone_number`, `address`, `role`) VALUES
(10, 'Roel', NULL, 'user@gmail.com', '$2y$10$vIRxsPQoySIMXmYqRoiwsuMOoT4wGztQllgof7lxuqSpkmq/RAuTG', NULL, NULL, 'user'),
(11, 'akosiroel', NULL, 'akosiroel@gmail.com', '$2y$10$Tg9JdoVE/H1V8kuFgdUOu.1BYMKgJeClP8Pm2B1aAXn4XS1xbQAnm', NULL, NULL, 'user'),
(12, 'Admin', NULL, 'admin@gmail.com', '$2y$10$eQMeR0ocvq58J9rrtyixlOGVnbDbmAdsIoEqxavs1eHSay6cM8oA.', NULL, NULL, 'admin'),
(13, 'Admin', NULL, 'admin1@gmail.com', 'admin', NULL, NULL, 'admin'),
(14, 'adminRoel', NULL, 'adminRoel@gmail.com', 'adminRoel', NULL, NULL, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `designs`
--
ALTER TABLE `designs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `saved_design`
--
ALTER TABLE `saved_design`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_shirt_designs`
--
ALTER TABLE `t_shirt_designs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `designs`
--
ALTER TABLE `designs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saved_design`
--
ALTER TABLE `saved_design`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_shirt_designs`
--
ALTER TABLE `t_shirt_designs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
