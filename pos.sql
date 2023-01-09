-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2023 at 09:55 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) UNSIGNED NOT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_price` float UNSIGNED NOT NULL,
  `item_quantity` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `seller_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `price` float UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cost` float UNSIGNED NOT NULL,
  `image` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `price`, `name`, `quantity`, `created_at`, `updated_at`, `cost`, `image`) VALUES
(47, 90, 'Jaxi HeadPhone', 3, '2023-01-10 20:33:11', '2023-01-10 20:33:11', 42, '././resources/images/product-images/HeadPhoneMPOW.png'),
(48, 15.5, 'Razzer Mouse', 91209, '2023-01-10 20:32:33', '2023-01-10 20:32:33', 12, '././resources/images/product-images/mouse.png'),
(49, 100, 'Obam Mouse', 212330, '2023-01-10 19:51:44', '2023-01-10 19:51:44', 40, '././resources/images/product-images/mouse2.png'),
(50, 499.99, 'Hp Laptop', 129297, '2023-01-09 21:10:27', '2023-01-09 21:10:27', 250.5, '././resources/images/product-images/HP_Laptop.png'),
(53, 799.99, 'MAC Laptop', 9484848, '2023-01-10 19:45:20', '2023-01-10 19:45:20', 500.34, '././resources/images/product-images/MacLaptop.png'),
(54, 375, 'Samsung Laptop', 14, '2023-01-08 22:03:39', '2023-01-08 22:03:39', 91, '././resources/images/product-images/SamsungLaptop.png'),
(55, 500, 'Lenovo Laptop', 3124123, '2023-01-09 21:09:46', '2023-01-09 21:09:46', 231, '././resources/images/product-images/Lenovo-laptop.png'),
(56, 679.99, 'ThinkPad Latpop', 0, '2023-01-07 22:49:03', '2023-01-07 22:49:03', 0, '././resources/images/product-images/ThinkPad.png'),
(57, 72.88, 'OUHI HeadPhone', 6789, '2023-01-08 22:04:15', '2023-01-08 22:04:15', 55, '././resources/images/product-images/headphone2.png');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `item_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `total` float UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `updated_at`, `item_id`, `quantity`, `total`, `created_at`) VALUES
(14, '2023-01-09 21:45:08', 46, 5, 25, '2023-01-09 21:45:08'),
(15, '2023-01-07 01:20:40', 48, 1, 15.5, '2023-01-07 01:20:40'),
(16, '2023-01-07 19:46:09', 54, 1, 375, '2023-01-07 19:46:09'),
(17, '2023-01-07 19:47:41', 46, 0, 0, '2023-01-07 19:47:41'),
(18, '2023-01-07 21:08:44', 34, 6, 7440, '2023-01-07 21:08:44'),
(19, '2023-01-07 21:08:53', 46, 0, 0, '2023-01-07 21:08:53'),
(20, '2023-01-07 21:08:58', 53, 1, 799.99, '2023-01-07 21:08:58'),
(21, '2023-01-07 22:01:05', 34, 8, 0, '2023-01-07 22:01:05'),
(22, '2023-01-07 22:24:04', 49, 1, 13.5, '2023-01-07 22:24:04'),
(23, '2023-01-07 22:44:21', 50, 1, 499.99, '2023-01-07 22:44:21'),
(24, '2023-01-07 22:45:46', 55, 1, 500, '2023-01-07 22:45:46'),
(25, '2023-01-07 22:46:27', 57, 1, 72.88, '2023-01-07 22:46:27'),
(26, '2023-01-07 22:49:03', 56, 1, 679.99, '2023-01-07 22:49:03'),
(27, '2023-01-07 22:51:56', 34, 3, 0, '2023-01-07 22:51:56'),
(28, '2023-01-07 22:52:12', 46, 2, 159.98, '2023-01-07 22:52:12'),
(29, '2023-01-07 23:04:24', 34, 1, 0, '2023-01-07 23:04:24'),
(30, '2023-01-07 23:06:12', 34, 2, 0, '2023-01-07 23:06:12'),
(31, '2023-01-07 23:06:57', 34, 1, 0, '2023-01-07 23:06:57'),
(32, '2023-01-07 23:08:20', 34, 1, 0, '2023-01-07 23:08:20'),
(33, '2023-01-07 23:24:32', 46, 3, 239.97, '2023-01-07 23:24:32'),
(34, '2023-01-07 23:49:18', 34, 1, 0, '2023-01-07 23:49:18'),
(35, '2023-01-07 23:49:23', 34, 1, 0, '2023-01-07 23:49:23'),
(36, '2023-01-07 23:49:33', 34, 1, 0, '2023-01-07 23:49:33'),
(37, '2023-01-07 23:49:34', 34, 1, 0, '2023-01-07 23:49:34'),
(38, '2023-01-07 23:51:19', 34, 1, 0, '2023-01-07 23:51:19'),
(39, '2023-01-07 23:52:20', 46, 1, 79.99, '2023-01-07 23:52:20'),
(40, '2023-01-07 23:52:27', 46, 1, 79.99, '2023-01-07 23:52:27'),
(41, '2023-01-07 23:54:21', 34, 2, 68, '2023-01-07 23:54:21'),
(42, '2023-01-07 23:54:42', 34, 2, 68, '2023-01-07 23:54:42'),
(43, '2023-01-07 23:54:45', 46, 4, 319.96, '2023-01-07 23:54:45'),
(44, '2023-01-07 23:55:31', 34, 1, 34, '2023-01-07 23:55:31'),
(45, '2023-01-07 23:57:15', 34, 1, 34, '2023-01-07 23:57:15'),
(46, '2023-01-07 23:57:39', 46, 1, 79.99, '2023-01-07 23:57:39'),
(47, '2023-01-07 23:59:48', 46, 1, 79.99, '2023-01-07 23:59:48'),
(48, '2023-01-08 00:07:32', 34, 1, 34, '2023-01-08 00:07:32'),
(49, '2023-01-08 00:07:41', 34, 1, 34, '2023-01-08 00:07:41'),
(50, '2023-01-08 00:07:43', 34, 1, 34, '2023-01-08 00:07:43'),
(51, '2023-01-08 00:07:46', 34, 1, 34, '2023-01-08 00:07:46'),
(52, '2023-01-08 00:07:46', 34, 1, 34, '2023-01-08 00:07:46'),
(53, '2023-01-08 00:07:53', 34, 1, 34, '2023-01-08 00:07:53'),
(54, '2023-01-08 00:07:53', 34, 1, 34, '2023-01-08 00:07:53'),
(55, '2023-01-08 00:07:53', 34, 1, 34, '2023-01-08 00:07:53'),
(56, '2023-01-08 00:07:53', 34, 1, 34, '2023-01-08 00:07:53'),
(57, '2023-01-08 00:07:56', 34, 1, 34, '2023-01-08 00:07:56'),
(58, '2023-01-08 00:07:56', 34, 1, 34, '2023-01-08 00:07:56'),
(59, '2023-01-08 00:07:56', 34, 1, 34, '2023-01-08 00:07:56'),
(60, '2023-01-08 00:08:36', 46, 1, 79.99, '2023-01-08 00:08:36'),
(61, '2023-01-08 00:08:46', 34, 7, 238, '2023-01-08 00:08:46'),
(62, '2023-01-08 00:12:10', 34, 2, 68, '2023-01-08 00:12:10'),
(63, '2023-01-08 00:12:18', 46, 2, 159.98, '2023-01-08 00:12:18'),
(64, '2023-01-08 00:17:50', 34, 1, 34, '2023-01-08 00:17:50'),
(65, '2023-01-08 00:18:09', 34, 3, 102, '2023-01-08 00:18:09'),
(66, '2023-01-08 00:18:12', 46, 2, 159.98, '2023-01-08 00:18:12'),
(68, '2023-01-08 00:18:56', 46, 2, 159.98, '2023-01-08 00:18:56'),
(70, '2023-01-08 00:19:08', 34, 1, 34, '2023-01-08 00:19:08'),
(71, '2023-01-08 00:21:35', 46, 1, 79.99, '2023-01-08 00:21:35'),
(72, '2023-01-08 00:21:36', 34, 1, 34, '2023-01-08 00:21:36'),
(74, '2023-01-08 00:24:21', 34, 2, 68, '2023-01-08 00:24:21'),
(75, '2023-01-08 00:28:16', 34, 1, 34, '2023-01-08 00:28:16'),
(76, '2023-01-08 00:28:20', 46, 1, 79.99, '2023-01-08 00:28:20'),
(77, '2023-01-08 00:28:35', 34, 1, 34, '2023-01-08 00:28:35'),
(78, '2023-01-08 00:28:36', 46, 1, 79.99, '2023-01-08 00:28:36'),
(79, '2023-01-08 00:29:13', 34, 1, 34, '2023-01-08 00:29:13'),
(80, '2023-01-08 00:29:38', 46, 1, 79.99, '2023-01-08 00:29:38'),
(81, '2023-01-08 00:30:57', 46, 1, 79.99, '2023-01-08 00:30:57'),
(82, '2023-01-08 00:31:00', 34, 3, 102, '2023-01-08 00:31:00'),
(83, '2023-01-08 00:37:05', 46, 2, 159.98, '2023-01-08 00:37:05'),
(84, '2023-01-08 00:37:08', 34, 1, 34, '2023-01-08 00:37:08'),
(85, '2023-01-08 00:40:35', 34, 1, 34, '2023-01-08 00:40:35'),
(86, '2023-01-08 00:41:11', 34, 2, 68, '2023-01-08 00:41:11'),
(87, '2023-01-08 00:41:12', 46, 2, 159.98, '2023-01-08 00:41:12'),
(88, '2023-01-08 22:01:19', 34, 1, 34, '2023-01-08 22:01:19'),
(89, '2023-01-09 21:09:33', 34, 3, 102, '2023-01-09 21:09:33'),
(90, '2023-01-09 21:09:39', 49, 1, 100, '2023-01-09 21:09:39'),
(91, '2023-01-09 21:09:46', 55, 1, 500, '2023-01-09 21:09:46'),
(92, '2023-01-09 21:09:47', 46, 1, 79.99, '2023-01-09 21:09:47'),
(93, '2023-01-09 21:10:27', 50, 4, 1999.96, '2023-01-09 21:10:27'),
(94, '2023-01-09 21:10:32', 49, 4, 400, '2023-01-09 21:10:32'),
(95, '2023-01-09 21:10:34', 48, 3, 46.5, '2023-01-09 21:10:34'),
(96, '2023-01-09 21:11:39', 46, 1, 79.99, '2023-01-09 21:11:39'),
(97, '2023-01-09 21:11:44', 46, 1, 79.99, '2023-01-09 21:11:44'),
(98, '2023-01-09 21:11:45', 34, 1, 34, '2023-01-09 21:11:45'),
(99, '2023-01-09 21:11:46', 34, 1, 34, '2023-01-09 21:11:46'),
(101, '2023-01-09 21:11:46', 34, 1, 34, '2023-01-09 21:11:46'),
(102, '2023-01-09 21:11:46', 34, 1, 34, '2023-01-09 21:11:46'),
(103, '2023-01-09 21:11:46', 34, 1, 34, '2023-01-09 21:11:46'),
(104, '2023-01-09 21:11:47', 34, 1, 34, '2023-01-09 21:11:47'),
(105, '2023-01-09 21:11:47', 34, 1, 34, '2023-01-09 21:11:47'),
(106, '2023-01-09 21:11:47', 34, 1, 34, '2023-01-09 21:11:47'),
(107, '2023-01-09 21:12:32', 46, 1, 79.99, '2023-01-09 21:12:32'),
(108, '2023-01-09 21:12:35', 34, 1, 34, '2023-01-09 21:12:35'),
(109, '2023-01-09 21:21:20', 46, 1, 79.99, '2023-01-09 21:21:20'),
(110, '2023-01-09 21:21:43', 46, 3, 239.97, '2023-01-09 21:21:43'),
(111, '2023-01-09 21:21:43', 34, 4, 136, '2023-01-09 21:21:43'),
(113, '2023-01-10 16:42:18', 49, 2, 200, '2023-01-10 16:42:18'),
(124, '2023-01-10 19:45:20', 53, 1, 799.99, '2023-01-10 19:45:20'),
(125, '2023-01-10 19:46:17', 48, 3, 46.5, '2023-01-10 19:46:17'),
(126, '2023-01-10 19:49:20', 48, 7, 108.5, '2023-01-10 19:49:20'),
(127, '2023-01-10 19:49:44', 49, 3, 300, '2023-01-10 19:49:44'),
(128, '2023-01-10 19:51:16', 48, 3, 46.5, '2023-01-10 19:51:16'),
(129, '2023-01-10 19:51:44', 49, 2, 200, '2023-01-10 19:51:44'),
(131, '2023-01-10 20:31:55', 48, 1, 15.5, '2023-01-10 20:31:55'),
(132, '2023-01-10 20:32:33', 48, 1, 15.5, '2023-01-10 20:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permissions` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `display_name` varchar(100) NOT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `image` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `permissions`, `created_at`, `updated_at`, `display_name`, `gender`, `image`) VALUES
(30, 'Seller', 'Mike@mailinator.com', '$2y$10$NC9NXmRYQfErXMArcF2ZFe/ObVI1981bjBCH4ECJygLCZdnogkUcC', 'a:7:{i:0;s:16:\"transaction:read\";i:1;s:18:\"transaction:create\";i:2;s:18:\"transaction:update\";i:3;s:18:\"transaction:delete\";i:4;s:9:\"cart:read\";i:5;s:11:\"cart:create\";i:6;s:11:\"cart:delete\";}', '2023-01-02 22:30:37', '2023-01-10 19:10:01', 'Mike Bloiuar', 'male', '././resources/images/users-images/image_user_7.png'),
(41, 'Procurement', 'vydosawis@mailinator.com', '$2y$10$xSom7SsgRzn01/QJ.pN.fOxOJwfak6t1xmTe4CwomRc/0IqKnxeMO', 'a:4:{i:0;s:12:\"product:read\";i:1;s:14:\"product:create\";i:2;s:14:\"product:update\";i:3;s:14:\"product:delete\";}', '2023-01-10 16:10:43', '2023-01-10 19:10:01', 'Sarah Wilcox', 'female', '././resources/images/users-images/image_user_2.png'),
(43, 'Accountant', 'Nasim@mailinator.com', '$2y$10$2YI6OkK8ISgejWZPmps5c.A5OKVozuWNCAU3K/zExE3qtbSNEDcVe', 'a:5:{i:0;s:16:\"transaction:read\";i:1;s:18:\"transaction:create\";i:2;s:18:\"transaction:update\";i:3;s:18:\"transaction:delete\";i:4;s:17:\"transaction:super\";}', '2023-01-10 16:17:43', '2023-01-10 19:10:01', 'Nasim Livingston', 'female', '././resources/images/users-images/image_user_5.png'),
(45, 'Admin', 'Talal@mailinator.com', '$2y$10$j.pi9kfC5c.o1GwC3S/vmuSBUH2wLjEDXvuhPMUBKzh56JtjYrMwO', 'a:16:{i:0;s:12:\"product:read\";i:1;s:14:\"product:create\";i:2;s:14:\"product:update\";i:3;s:14:\"product:delete\";i:4;s:9:\"user:read\";i:5;s:11:\"user:create\";i:6;s:11:\"user:update\";i:7;s:11:\"user:delete\";i:8;s:16:\"transaction:read\";i:9;s:18:\"transaction:create\";i:10;s:18:\"transaction:update\";i:11;s:18:\"transaction:delete\";i:12;s:9:\"cart:read\";i:13;s:11:\"cart:create\";i:14;s:11:\"cart:delete\";i:15;s:17:\"transaction:super\";}', '2023-01-10 20:17:59', '2023-01-10 20:18:09', 'Talal Alotaibi', 'male', '././resources/images/users-images/image_user_8.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_transactions`
--

CREATE TABLE `user_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_transactions`
--

INSERT INTO `user_transactions` (`id`, `user_id`, `transaction_id`) VALUES
(1, 3, 32),
(2, 3, 48),
(3, 3, 49),
(4, 3, 50),
(5, 3, 51),
(6, 3, 51),
(7, 3, 53),
(8, 3, 54),
(9, 3, 55),
(10, 3, 56),
(11, 3, 57),
(12, 3, 57),
(13, 3, 57),
(14, 3, 60),
(15, 3, 61),
(16, 3, 62),
(17, 3, 63),
(18, 3, 64),
(19, 3, 65),
(20, 3, 66),
(21, 3, 67),
(22, 3, 68),
(23, 3, 69),
(24, 3, 69),
(25, 3, 71),
(26, 3, 72),
(27, 3, 73),
(28, 3, 74),
(29, 3, 75),
(30, 3, 76),
(31, 3, 77),
(32, 3, 78),
(33, 3, 79),
(34, 3, 80),
(35, 3, 81),
(36, 3, 82),
(37, 3, 83),
(38, 3, 84),
(39, 3, 85),
(40, 3, 86),
(41, 3, 87),
(42, 3, 88),
(43, 3, 89),
(44, 3, 90),
(45, 3, 91),
(46, 3, 92),
(47, 3, 93),
(48, 3, 94),
(49, 3, 95),
(50, 3, 96),
(51, 3, 97),
(52, 3, 98),
(53, 3, 99),
(54, 3, 100),
(55, 3, 101),
(56, 3, 102),
(57, 3, 103),
(58, 3, 104),
(59, 3, 104),
(60, 3, 104),
(61, 3, 107),
(62, 3, 108),
(63, 3, 109),
(64, 3, 110),
(65, 3, 110),
(66, 3, 112),
(67, 30, 113),
(68, 30, 114),
(69, 3, 115),
(70, 3, 116),
(71, 3, 117),
(72, 30, 118),
(73, 30, 119),
(74, 30, 120),
(75, 30, 121),
(76, 30, 122),
(77, 30, 123),
(78, 30, 124),
(79, 30, 125),
(80, 30, 126),
(81, 30, 127),
(82, 30, 128),
(83, 30, 129),
(84, 45, 130),
(85, 45, 131),
(86, 45, 132);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_transactions`
--
ALTER TABLE `user_transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `user_transactions`
--
ALTER TABLE `user_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
