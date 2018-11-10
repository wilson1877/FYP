-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2018 at 09:55 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stockID` int(100) NOT NULL,
  `stockImage` varchar(100) NOT NULL,
  `stockName` varchar(50) NOT NULL,
  `price` decimal(50,2) NOT NULL,
  `totalStock` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stockID`, `stockImage`, `stockName`, `price`, `totalStock`) VALUES
(1, 'images/stockUpload/20170424042023_20130415045738floatglass.jpg', 'HONSBERG VISION M42 in coil 30m', '700.00', 483),
(2, 'images/stockUpload/dowel.png', 'M42 High Speed Steel Bi-Metal', '60.00', 489),
(3, 'images/stockUpload/DSC_1218.jpg', 'HONSBERG EXTRA M42 High Speed Steel Bi-Metal', '58.00', 283),
(4, 'images/stockUpload/nitrile-rubber-sheet.jpg', 'HONSBERG DURATEC M51 High Speed Steel Bi-Metal	', '200.00', 23),
(5, 'images/stockUpload/plastic-sheet-supplier.jpg', 'HONSBERG SPECTRA M42 High Speed Steel Bi-metal', '150.00', 112);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stockID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stockID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
