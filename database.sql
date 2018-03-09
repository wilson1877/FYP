-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2018 at 03:38 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

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
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `userID` int(100) NOT NULL,
  `emailAddress` varchar(20) NOT NULL,
  `contactNumber` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `userImage` varchar(100) NOT NULL,
  `isDriver` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`userID`, `emailAddress`, `contactNumber`, `username`, `password`, `firstName`, `lastName`, `userImage`, `isDriver`) VALUES
(1, 'ckm@ckm.com', 125201314, 'ckm5801', 'ckm5801', 'Wilson', 'Ckm', '', 0),
(2, 'hs@hs.com', 123456789, 'chs', 'chs', 'Hiap', 'Seng', '', 0),
(3, 'test@test.com', 69, 'driver', 'driver', 'driver', 'test', '', 0),
(4, 'driver@driver.com', 10, 'driver2', 'driver2', 'driver2', 'test', '', 0),
(5, 'admin@admin.com', 0, 'admin', '123', 'Main', 'Admin', '', 0),
(6, '3@3.com', 4654, 'driver3', 'driver3', 'driver3', 'test', '', 1),
(7, 'dri@dri.com', 6854, '3', '3', 'driver3', 'test', '', 1),
(8, '2@2.com', 6451, '2', '2', 'admin2', 'admin', '', 1),
(9, 'admin3@3.com', 6415, 'admin3', 'admin3', 'admin3', 'test', '', 0),
(10, '4@4.com', 6548, '4', '4', 'driver4', 'test', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `userID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
