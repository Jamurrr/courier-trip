-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 05, 2024 at 08:26 PM
-- Server version: 10.1.48-MariaDB
-- PHP Version: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `courier_trip`
--

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE `couriers` (
  `id` int(11) NOT NULL,
  `name` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `couriers`
--

INSERT INTO `couriers` (`id`, `name`) VALUES
(1, 'Иван'),
(2, 'Петр'),
(3, 'Владимир'),
(4, 'Александр'),
(5, 'Дмитрий'),
(6, 'Антон'),
(7, 'Олег'),
(8, 'Сергей'),
(9, 'Константин'),
(10, 'Алексей');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `name` varchar(90) NOT NULL,
  `goto_days` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `goto_days`) VALUES
(1, 'Санкт-Петербург', 1),
(2, 'Уфа', 5),
(3, 'Нижний Новгород', 7),
(4, 'Владимир', 3),
(5, 'Кострома', 2),
(6, 'Екатеринбург', 4),
(7, 'Ковров', 10),
(8, 'Воронеж', 8),
(9, 'Самара', 15),
(10, 'Астрахань', 12);

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` int(11) NOT NULL,
  `courier_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `courier_id`, `region_id`, `start_date`, `end_date`) VALUES
(1, 1, 7, '2024-12-01', '2024-12-11'),
(2, 2, 6, '2024-11-06', '2024-11-10'),
(3, 3, 10, '2024-12-10', '2024-12-22'),
(4, 4, 9, '2024-11-05', '2024-11-20'),
(5, 5, 1, '2024-10-01', '2024-10-02'),
(6, 6, 8, '2024-11-20', '2024-11-28'),
(7, 7, 2, '2024-12-09', '2024-12-14'),
(8, 8, 3, '2024-11-15', '2024-11-22'),
(9, 9, 4, '2024-09-01', '2024-09-04'),
(10, 10, 5, '2024-08-01', '2024-08-03'),
(11, 1, 1, '2024-11-28', '2024-11-29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courier_id` (`courier_id`),
  ADD KEY `region_id` (`region_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `trips_ibfk_1` FOREIGN KEY (`courier_id`) REFERENCES `couriers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trips_ibfk_2` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
