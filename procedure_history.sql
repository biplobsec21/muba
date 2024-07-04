-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 24, 2018 at 09:52 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmex`
--

-- --------------------------------------------------------

--
-- Table structure for table `procedure_history`
--

CREATE TABLE `procedure_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `procedure_id` int(10) UNSIGNED NOT NULL,
  `history_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yes_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `history_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `procedure_history`
--
ALTER TABLE `procedure_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `procedure_history_procedure_id_foreign` (`procedure_id`),
  ADD KEY `procedure_history_created_by_foreign` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `procedure_history`
--
ALTER TABLE `procedure_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `procedure_history`
--
ALTER TABLE `procedure_history`
  ADD CONSTRAINT `procedure_history_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `procedure_history_procedure_id_foreign` FOREIGN KEY (`procedure_id`) REFERENCES `procedures` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
