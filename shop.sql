-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2024 at 08:59 PM
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
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `categoria`, `imagen`) VALUES
(1, 'PinePhone 5', 'Teléfono inteligente basado en Linux por Pine64', '199.00', 50, 'Smartphone', 'PinePhone.png'),
(2, 'Nokia 2720 Flip (con KaiOS)', 'Teléfono de concha clásico con KaiOS', '79.99', 100, 'Teléfono con funciones', 'Nokia2720.png'),
(3, 'Fair Phone 4', 'Nuestro smartphone más sostenible. Hecho con materiales justos y reciclados.', '499.00', 150, 'Smartphone', 'FairPhone.png'),
(4, 'Mini Smartphone, Sudroid SOYES', 'Mini Smartphone,Child Phone Sudroid SOYES The World\'s Smallest Cell Phone 2.5 Inch Android Small Phone Quad Core 1G+8G 5.0MP Dual SIM', '99.00', 20, 'Smartphone', 'miniphone.png'),
(14, 'Ubuntu Smartphone', 'The popular open-source operating system Ubuntu, soon gets a mobile version suitable for modern generation Smartphones and pave the path for Ubuntu Smartphone. ', '200.00', 13, 'Smartphone', 'Ubuntu-smartphone-1823834562.png'),
(15, 'Framework Laptop 13', 'Framework Laptop 13 DIY Edition (13th Gen Intel® Core™) ', '849.00', 33, 'Laptop', 'laptop_breakout-af05a1150a781124.png'),
(16, 'Thelio Spark Essential', '    6-core 12th Gen Intel i5-12400 CPU     32GB DDR4 RAM (3200MHz)     1TB PCIe 4.0 M.2 SSD storage     Integrated Intel UHD Graphics 730', '999.00', 4, 'Desktops', '600x600-2080301.png'),
(17, 'Meerkat mini-pc', 'Diminutive and unassuming, Meerkat adorns your desk without consuming it.', '987.00', 6, 'Desktops', '300x300.png');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_history`
--

CREATE TABLE `purchase_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_history`
--

INSERT INTO `purchase_history` (`id`, `user_id`, `product_name`, `quantity`, `amount`, `purchase_date`, `payment_status`) VALUES
(13, 7, 'Nokia 2720 Flip (con KaiOS)', 1, '79.99', '2024-01-24 05:19:31', 'approved'),
(14, 7, 'Mini Smartphone, Sudroid SOYES', 1, '99.99', '2024-01-24 05:19:31', 'approved'),
(15, 7, 'Fair Phone 4', 3, '499.99', '2024-01-24 05:19:31', 'approved'),
(16, 7, 'PinePhone', 1, '199.99', '2024-01-24 05:20:57', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `is_admin`, `created_at`, `updated_at`) VALUES
(7, 'asd@asd.com', '$2y$10$B5wJzXbh3BKTvpjFmKdnNOChAjBZGjIbl6XopSCXC97JvLURgkp.6', 0, '2024-01-23 00:51:05', '2024-01-23 00:51:05'),
(10, 'admin@admin.com', '$2y$10$6tQfPVmbZseK/aG42BaAKu4g3HIk7d2pYrvK.nxD0/EgVFnV4bng6', 1, '2024-02-01 06:58:39', '2024-02-01 06:59:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_history`
--
ALTER TABLE `purchase_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `purchase_history`
--
ALTER TABLE `purchase_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchase_history`
--
ALTER TABLE `purchase_history`
  ADD CONSTRAINT `purchase_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
