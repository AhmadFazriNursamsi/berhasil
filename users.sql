-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 15, 2022 at 01:54 PM
-- Server version: 8.0.29-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `divisions`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_division` int NOT NULL DEFAULT '1',
  `join_date` date DEFAULT NULL,
  `mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int NOT NULL DEFAULT '1',
  `id_role` int NOT NULL DEFAULT '3',
  `flag_delete` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `id_division`, `join_date`, `mobile`, `active`, `id_role`, `flag_delete`) VALUES
(1, 'superuser', 'superuser', 'superuser@admin.com', NULL, '$2y$10$SFwa85IFn61XbJGjjg5P3uTOY4hSWY..aqhJaPoFL2BUeZULECfjS', 'ug3WMKKoWLcwibinjPF9Ohfe861Df8JBXa9tQiIzlUAydtqkxObe02dPzJeP', '2022-05-27 06:22:29', '2022-05-26 06:22:29', 1, '2022-05-25', '08775884515', 1, 99, 0),
(2, 'Joko', 'admin1', 'admin1@admin.com', NULL, '$2y$10$SFwa85IFn61XbJGjjg5P3uTOY4hSWY..aqhJaPoFL2BUeZULECfjS', NULL, '2022-05-27 06:22:29', '2022-06-05 20:15:06', 3, '2022-05-25', '08775884515', 1, 1, 0),
(3, 'Budi', 'itbudi', 'it1@admin.com', NULL, '$2y$10$r.xdlZp5pOa58e631UFNd./h5LDhO9rZpwbEgqpWfEcPgKDMVGw5m', NULL, '2022-05-27 06:22:29', '2022-06-13 02:21:00', 9, '2022-05-25', '08775884515', 1, 1, 0),
(4, 'IcTc', 'adminx1', 'adminx1@admin11.com', NULL, '$2y$10$SFwa85IFn61XbJGjjg5P3uTOY4hSWY..aqhJaPoFL2BUeZULECfjS', NULL, '2022-06-01 10:21:31', '2022-06-01 10:21:31', 1, NULL, '0809199204012', 1, 1, 0),
(5, 'IctIlmi', 'IctIlmi', 'IctIlmi@gmail.com', NULL, '$2y$10$1RARxqPb23O/c86uX5XPd.lzlZwf2utQ0NicOB3Csnse/QZ6SuUEq', NULL, '2022-06-01 10:27:29', '2022-06-01 10:27:29', 1, NULL, '087887918595', 1, 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
