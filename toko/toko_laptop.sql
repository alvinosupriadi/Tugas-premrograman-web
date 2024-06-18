-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2024 at 04:33 PM
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
-- Database: `toko_laptop`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `name`, `address`, `phone`, `order_date`) VALUES
(2, 3, 'christo', 'pisang agung', '09889787987897', '2024-06-13 12:41:37'),
(3, 1, 'hy', 'ht', '098', '2024-06-13 12:58:18'),
(4, 3, 't', '-09', '9', '2024-06-13 12:59:40'),
(5, 1, 't', 't', '0', '2024-06-13 13:08:45'),
(6, 1, 't', 't', '9', '2024-06-13 13:09:03');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `brand` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `spek` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand`, `name`, `price`, `image`, `spek`) VALUES
(1, 'asus', 'ASUS PREDATOR', 10000000.00, 'images/laptop_a.jpeg', 'SSD 1 TERA & DDR3 4GB'),
(2, 'asus', 'ASUS B944', 15000000.00, 'images/laptop_b.jpeg', 'SSD 256 GB  & DDR3 8GB'),
(3, 'asus', 'ASUS  A99', 20000000.00, 'images/laptop_c.jpeg', 'HDD 1TB & DDR3 4GB'),
(4, 'lenovo', 'LENOVO v67', 19000000.00, 'images/laptop_D.jpeg', 'SSD 1 TERA & DDR3 8GB'),
(5, 'lenovo', 'LENOVO a12', 19000000.00, 'images/laptop_E.jpeg', 'SSD 1 TB & DDR3 16GB'),
(6, 'lenovo', 'LENOVO p31', 19000000.00, 'images/laptop_F.jpeg', 'SSD 1 TB & DDR3 4GB'),
(7, 'acer', 'Acer p31', 19000000.00, 'images/laptop_G.jpeg', 'SSD 1 TB & DDR3 8GB'),
(8, 'acer', 'Acer Z90', 19000000.00, 'images/laptop_H.jpeg', 'SSD 1 TB & DDR3 16GB'),
(9, 'acer', 'Acer Z98', 19000000.00, 'images/laptop_I.jpeg', 'SSD 1 TB & DDR3 8GB');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('admin','buyer') NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`, `email`, `name`, `address`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'admin123', 'hashed_admin_password', 'admin', 'admin@example.com', 'Admin User', NULL, NULL, '2024-06-16 13:06:26', '2024-06-16 13:06:26'),
(2, 'buyer123', 'hashed_buyer_password', 'buyer', 'buyer@example.com', 'Buyer User', NULL, NULL, '2024-06-16 13:06:26', '2024-06-16 13:06:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
