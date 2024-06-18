-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jun 2024 pada 10.34
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

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
-- Struktur dari tabel `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'p', 'p@gmail.com', 'tes', '2024-06-18 07:50:24'),
(2, 'nopal', 'p@gmail.com', 'tes saja', '2024-06-18 07:50:24'),
(3, 'alv', 'al@gmail.com', 'nsudhbygds', '2024-06-18 08:21:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `name`, `address`, `phone`, `order_date`) VALUES
(2, 0, 3, 0, 'christo', 'pisang agung', '09889787987897', '2024-06-13 12:41:37'),
(3, 0, 1, 0, 'hy', 'ht', '098', '2024-06-13 12:58:18'),
(4, 0, 3, 0, 't', '-09', '9', '2024-06-13 12:59:40'),
(5, 0, 1, 0, 't', 't', '0', '2024-06-13 13:08:45'),
(6, 0, 1, 0, 't', 't', '9', '2024-06-13 13:09:03'),
(7, 0, 1, 0, 'p', 'p', '98989', '2024-06-16 17:54:56'),
(8, 3, 4, 0, 'nopal', 'jl pisang candi', '089789789', '2024-06-18 06:54:26'),
(9, 3, 2, 0, 'al', 'gun', '08', '2024-06-18 08:20:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
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
-- Dumping data untuk tabel `products`
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
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'alvin', '', '$2y$10$8oV8wb7lVFiMd7cHJTuAfeO.n29Y.ejlVdrsUqBQZ0slcbIuCgsqG', 'admin'),
(2, 'adi', 'adi@gmail.com', '12345678', 'user'),
(3, 'nopal', '', '$2y$10$rUft8TtCnhxV94B1rYr9f.RdeYzlsrIrfmsxSVJM1.vnvyAd3ykpa', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
