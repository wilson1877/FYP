-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2018 at 07:31 PM
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
  `contactNumber` varchar(50) NOT NULL,
  `faxNumber` varchar(50) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `customerName`, `companyName`, `contactNumber`, `faxNumber`, `emailAddress`, `address`) VALUES
(1, 'Mr.Teoh', 'Maxta Trading', '04-552 2198', '04-552 3198', 'maxta@gmail.com', 'No.63, Lorong Alma Jaya 12, Kawasan Industri Alma\r\n14000 Bukit Mertajam, Pulau Penang'),
(2, 'Mr William Ng', 'Jetro Technology Enterprise', '04-5083518', '04-5301943', '-', 'No 41, Tingkat Maju, Pusat Perniagaan Maju Jaya\r\n14000 Bukit Mertajam');

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
  `date` date NOT NULL,
  `totalPrice` decimal(50,2) NOT NULL,
  `itemQuantity` int(100) NOT NULL,
  `customerID` int(100) NOT NULL,
  `miscNotes` varchar(500) NOT NULL,
  `purchaseOrderNo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoiceID`, `date`, `totalPrice`, `itemQuantity`, `customerID`, `miscNotes`, `purchaseOrderNo`) VALUES
(1, '2018-04-12', '940.00', 0, 1, '', 'PO-000567'),
(2, '2018-04-12', '580.00', 0, 2, '', 'Phone Order');

-- --------------------------------------------------------

--
-- Table structure for table `invoiceitemlist`
--

CREATE TABLE `invoiceitemlist` (
  `itemListID` int(100) NOT NULL,
  `invoiceID` int(100) NOT NULL,
  `stockID` int(100) NOT NULL,
  `itemQty` int(100) NOT NULL,
  `notes` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoiceitemlist`
--

INSERT INTO `invoiceitemlist` (`itemListID`, `invoiceID`, `stockID`, `itemQty`, `notes`) VALUES
(2, 1, 1, 10, ''),
(3, 1, 2, 5, ''),
(4, 2, 2, 10, '');

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
(1, 'images/stockUpload/ae235.jpg', 'HONSBERG SPECTRA-2363x20mmx5/8V', '65.00', 20),
(2, 'images/stockUpload/bimetal-band-saw-blades-cnc-inserts-honsberg-250x250.jpg', 'HONSBERG UNICUT-2365mm x 20mmx5/8TPI', '58.00', 90);

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
(1, 'admin@admin.com', 13, 'admin', 'password', 'admin', 'admin', '', 0),
(2, 'admin@ibuzz.com', 12, 'admin', 'password', 'admin', 'admin', '', 0);

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
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `invoiceitemlist`
--
ALTER TABLE `invoiceitemlist`
  ADD PRIMARY KEY (`itemListID`),
  ADD KEY `invoiceID` (`invoiceID`),
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
  MODIFY `customerID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `deliveryID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoiceID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoiceitemlist`
--
ALTER TABLE `invoiceitemlist`
  MODIFY `itemListID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stockID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`);

--
-- Constraints for table `invoiceitemlist`
--
ALTER TABLE `invoiceitemlist`
  ADD CONSTRAINT `invoiceitemlist_ibfk_1` FOREIGN KEY (`invoiceID`) REFERENCES `invoice` (`invoiceID`),
  ADD CONSTRAINT `invoiceitemlist_ibfk_2` FOREIGN KEY (`stockID`) REFERENCES `stock` (`stockID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
