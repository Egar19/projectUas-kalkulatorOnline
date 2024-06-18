-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2024 at 07:57 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kalkulator_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `calculations`
--

CREATE TABLE `calculations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expression` varchar(255) DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calculations`
--

INSERT INTO `calculations` (`id`, `user_id`, `expression`, `result`, `created_at`) VALUES
(77, 2, '9*6', '54', '2024-06-13 05:08:49'),
(79, 2, 'cos(6)', '0.96017028665037', '2024-06-13 07:46:12'),
(80, 2, 'cos(6)/6', '0.16002838110839', '2024-06-13 07:46:24'),
(97, 3, '2/9', '0.22222222222222', '2024-06-16 01:58:39'),
(98, 3, '6*9', '54', '2024-06-16 03:05:57'),
(99, 1, '8-3', '5', '2024-06-16 03:11:18'),
(100, 1, '6*9', '54', '2024-06-16 03:11:29'),
(101, 1, '8/4', '2', '2024-06-16 05:43:48'),
(102, 1, '8/3', '2.6666666666667', '2024-06-16 05:44:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'andi', '$2y$10$XnQaFhTxg/LfNkioXTW5A.agpUk9ZtYjr8pDhzFMcacNH5tUSXlDu'),
(2, 'grandong', '$2y$10$9WN620.o6.7gyptO1dPfXe75UkH4dYl2Xn4sXax0Bj1a5M5F6X3ci'),
(3, 'andiandi', '$2y$10$cMDJ3wyBHxZjJUKKh9/9/u2ucncSVl9dYRlKx8BthT2tmfYRwiKqS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calculations`
--
ALTER TABLE `calculations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calculations`
--
ALTER TABLE `calculations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calculations`
--
ALTER TABLE `calculations`
  ADD CONSTRAINT `calculations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
