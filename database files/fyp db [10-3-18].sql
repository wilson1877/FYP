-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2018 at 07:10 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

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
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(100) NOT NULL,
  `customerName` varchar(50) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `contactNumber` int(50) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `customerName`, `companyName`, `contactNumber`, `emailAddress`, `address`) VALUES
(1, 'Test Customer', 'CompanyTest', 111111111, 'qwerty@test.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `debtorlist`
--

CREATE TABLE `debtorlist` (
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `credit` decimal(50,2) NOT NULL,
  `debit` decimal(50,2) NOT NULL,
  `balance` decimal(50,2) NOT NULL,
  `customerID` int(100) NOT NULL,
  `invoiceID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `deliveryID` int(100) NOT NULL,
  `GPS` geometry NOT NULL,
  `stockID` int(100) NOT NULL,
  `driverID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoiceID` int(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `totalPrice` decimal(50,2) NOT NULL,
  `customerID` int(100) NOT NULL,
  `itemQuantity01` int(100) NOT NULL,
  `stockID01` int(100) NOT NULL,
  `itemQuantity02` int(100) NOT NULL,
  `stockID02` int(100) NOT NULL,
  `itemQuantity03` int(100) NOT NULL,
  `stockID03` int(100) NOT NULL,
  `itemQuantity04` int(100) NOT NULL,
  `stockID04` int(100) NOT NULL,
  `itemQuantity05` int(100) NOT NULL,
  `stockID05` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoiceID`, `date`, `totalPrice`, `customerID`, `itemQuantity01`, `stockID01`, `itemQuantity02`, `stockID02`, `itemQuantity03`, `stockID03`, `itemQuantity04`, `stockID04`, `itemQuantity05`, `stockID05`) VALUES
(1, '2018-03-10 04:18:56', '10.00', 1, 10, 1, 10, 20, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchaseID` int(100) NOT NULL,
  `purchaseItem` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `issueReceipt` tinyint(1) NOT NULL,
  `customerID` int(100) NOT NULL,
  `stockID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'StockImage', 'StockName', '12.11', 100),
(2, 'null', 'StockName 2', '50.00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
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
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `emailAddress`, `contactNumber`, `username`, `password`, `firstName`, `lastName`, `userImage`, `isDriver`) VALUES
(1, 'ckm@ckm.com', 125201314, 'ckm5801', 'ckm5801', 'Wilson', 'Ckm', '', 0),
(2, 'admin', 123456789, 'admin', 'password', 'FirstName', 'LastName', '', 0),
(3, 'test@test.com', 69, 'driver', 'driver', 'driver', 'test', '', 0),
(4, 'driver@driver.com', 10, 'driver2', 'driver2', 'driver2', 'test', '', 0),
(5, 'admin@admin.com', 0, 'admin', '123', 'Main', 'Admin', '', 0),
(6, '3@3.com', 4654, 'driver3', 'driver3', 'driver3', 'test', '', 1),
(7, 'dri@dri.com', 6854, '3', '3', 'driver3', 'test', '', 1),
(8, '2@2.com', 6451, '2', '2', 'admin2', 'admin', '', 1),
(9, 'admin3@3.com', 6415, 'admin3', 'admin3', 'admin3', 'test', '', 0),
(10, '4@4.com', 6548, '4', '4', 'driver4', 'test', '', 1),
(11, 'hs@hs.com', 123, 'CHS', 'chs', 'Hiap', 'Seng', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `debtorlist`
--
ALTER TABLE `debtorlist`
  ADD KEY `customerID` (`customerID`),
  ADD KEY `invoiceID` (`invoiceID`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`deliveryID`),
  ADD KEY `driverID` (`driverID`),
  ADD KEY `stockID` (`stockID`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoiceID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `stockID01` (`stockID01`),
  ADD KEY `stockID02` (`stockID02`),
  ADD KEY `stockID03` (`stockID03`),
  ADD KEY `stockID04` (`stockID04`),
  ADD KEY `stockID05` (`stockID05`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchaseID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `stockID` (`stockID`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stockID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `deliveryID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoiceID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchaseID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stockID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `debtorlist`
--
ALTER TABLE `debtorlist`
  ADD CONSTRAINT `debtorlist_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`),
  ADD CONSTRAINT `debtorlist_ibfk_2` FOREIGN KEY (`invoiceID`) REFERENCES `invoice` (`invoiceID`);

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`driverID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`stockID`) REFERENCES `stock` (`stockID`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`stockID01`) REFERENCES `stock` (`stockID`),
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`);

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`),
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`stockID`) REFERENCES `stock` (`stockID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
