-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2024 at 05:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`name`, `age`, `model`, `manufacturer`) VALUES
('carina', 2003, 'diesel', 'american'),
('ham ham', 5, 'petrol', 'dutch'),
('rava', 2008, 'petrol', 'japan'),
('toyota', 2017, 'petrol', 'germany');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `email`, `phone`) VALUES
(1, 'EMMANUEL ISHIMWE', 'ishimweemmy811@gmail.com', '0785237426'),
(2, 'uwase fatina', 'fatina@gmail.com', '0793307516'),
(3, 'TUOMBE', 'tuombe@gmail.com', '0789234323'),
(4, 'simon', 'simon@gmail.com', '0785237426'),
(5, 'simon', 'simon@gmail.com', '0785237426'),
(6, 'nowa', 'nowa@gmail.com', '0793307516'),
(7, 'nowa', 'simon@gmail.com', '0785237426'),
(8, 'nowa', 'simon@gmail.com', '0785237426'),
(9, 'nowa', 'simon@gmail.com', '0785237426'),
(10, 'ancelloti', 'ancelloti@gmail.com', '0785237426'),
(11, 'cr7', 'ancelloti@gmail.com', '0785237426');

-- --------------------------------------------------------

--
-- Table structure for table `parkinglot`
--

CREATE TABLE `parkinglot` (
  `parkinglot_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parkinglot`
--

INSERT INTO `parkinglot` (`parkinglot_id`, `name`, `address`, `capacity`) VALUES
(2, 'city center', 'kk123street', 200),
(3, 'city center', 'kk123street', 200),
(4, 'fatina site', 'ngr', 500);

-- --------------------------------------------------------

--
-- Table structure for table `parkingslot`
--

CREATE TABLE `parkingslot` (
  `parkingslot_id` int(11) NOT NULL,
  `slot_number` varchar(50) NOT NULL,
  `size` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parkingslot`
--

INSERT INTO `parkingslot` (`parkingslot_id`, `slot_number`, `size`, `status`) VALUES
(1, '123', '3456', 'Reserved'),
(2, '167', '12', 'Occupied'),
(3, '526', '223', 'Occupied'),
(4, '526', '223', 'Occupied'),
(5, '8765', '2345', 'Reserved'),
(6, '123', '3456', 'Reserved'),
(7, '980', '140', 'Occupied');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hired_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `name`, `phone`, `address`, `email`, `username`, `password`, `hired_date`) VALUES
(1, 'asdfg', '1234', 'sr1234', 'ishimweemmy811@gmail.com', 'ee', '123', '2024-04-24'),
(2, 'aaaa', '123', '1er', 'aaa@gmail.com', 'aaa', '12345', '2024-04-24'),
(3, 'ishimwe', '079', 'ngr', 'ishimweemmy811@gmail.com', 'emmy', '555', '2024-04-24'),
(4, 'ishimwe', '079', 'ngr', 'ishimweemmy811@gmail.com', 'emmy', '555', '2024-04-24'),
(5, 'emmy', '0783456754', 'wetyu456', 'ertyuudfghr@gmail.com', 'nowa', 'nowa', '2024-04-25'),
(6, 'james', '0793034341', 'gats/east', 'aaa@gmail.com', 'nowa', 'nowa12345', '2024-04-26'),
(9, 'james', '0793034341', 'gats/east', 'aaa@gmail.com', 'nowa', 'nowa12345', '2024-04-26'),
(10, 'sera', '0780108115', 'gtsb', 'ser@gmail.com', 'mere', '12345', '2024-04-26'),
(11, 'oli', '0780108115', 'kyz', 'oli@gmail.com', 'oli', '12345', '2024-04-26'),
(12, 'tifa', '0780108115', 'kyz', 'oli@gmail.com', 'tifa', '12345', '2024-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `start_time`, `end_time`, `cost`) VALUES
(4, '2024-04-24 19:35:00', '2024-04-24 19:35:00', 300.00),
(5, '2024-04-24 20:46:00', '2024-04-25 00:50:00', 5000.00),
(6, '2024-04-24 11:49:00', '2024-04-24 21:47:00', 400.00),
(7, '2024-04-25 00:00:00', '2024-04-25 22:58:00', 700.00),
(8, '2024-04-26 07:22:00', '2024-04-26 21:24:00', 2000.00),
(9, '2024-04-26 15:59:00', '2024-04-26 20:04:00', 300.00),
(10, '2024-04-26 16:12:00', '2024-04-26 16:12:00', 400.00),
(11, '2024-04-26 16:13:00', '2024-04-26 21:13:00', 700.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `parkinglot`
--
ALTER TABLE `parkinglot`
  ADD PRIMARY KEY (`parkinglot_id`);

--
-- Indexes for table `parkingslot`
--
ALTER TABLE `parkingslot`
  ADD PRIMARY KEY (`parkingslot_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `parkinglot`
--
ALTER TABLE `parkinglot`
  MODIFY `parkinglot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `parkingslot`
--
ALTER TABLE `parkingslot`
  MODIFY `parkingslot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
