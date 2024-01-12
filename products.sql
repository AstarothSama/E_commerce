-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2023 at 01:13 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vistashop`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Product_id` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Price` float NOT NULL,
  `Add_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `End_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Product_id`, `Username`, `Name`, `Description`, `Price`, `Add_date`, `End_date`, `Image`) VALUES
(3, 'Astaroth', 'Satoru gojo', 'jujutsu kaisen caracter', 20, '2023-05-03 07:08:19', '2023-05-16 15:05:00', 0x696d616765732e6a7067),
(14, 'Astaroth', 'Xiaomi Redmi 10', 'STockage 64gb/ram 4GB', 500, '2023-05-05 10:54:03', '2023-05-07 11:00:00', 0x7869616f6d692e6a7067),
(15, 'Astaroth', 'PC Dell', 'Ordinateur portatif', 1600, '2023-05-05 10:55:10', '2023-05-06 13:00:00', 0x706344656c6c2e6a7067),
(16, 'Astaroth', 'Tanjiro', 'demon slayer caracter', 5, '2023-05-05 10:56:05', '2023-05-07 23:00:00', 0x74616e6a69726f2e6a7067),
(17, 'foulen', 'MSI DS502', 'xxx', 110, '2023-05-05 11:10:47', '2023-05-07 11:00:00', 0x6d73694361737175652e6a7067);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Product_id`),
  ADD KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_userproduct` FOREIGN KEY (`Username`) REFERENCES `users` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
