-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2018 at 02:28 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

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
-- Table structure for table `creditdebit`
--

CREATE TABLE `creditdebit` (
  `ID` int(100) NOT NULL,
  `invoiceID` int(100) NOT NULL,
  `customerID` int(100) NOT NULL,
  `credit` decimal(50,2) NOT NULL,
  `debit` decimal(50,2) NOT NULL,
  `date` date NOT NULL,
  `notes` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `creditdebit`
--

INSERT INTO `creditdebit` (`ID`, `invoiceID`, `customerID`, `credit`, `debit`, `date`, `notes`) VALUES
(1, 9, 2, '0.00', '10.00', '2018-08-15', ''),
(2, 19, 3, '0.00', '50.00', '2018-08-18', ''),
(4, 0, 3, '100.50', '0.00', '2018-09-20', 'CIMB: 12311'),
(5, 21, 3, '0.00', '4000.00', '2018-09-20', ''),
(7, 0, 3, '10.00', '0.00', '2018-09-20', '411'),
(8, 0, 3, '1000.00', '0.00', '2018-09-20', 'RHB: 1111');

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
(1, 'Teoh', 'Maxta Trading', '0124773136', '045523198', 'maxta@maxta.com', '63, Lorong Alma Jaya 12, Kawasan \r\nIndustri Alma, 14000 Bukit Mertajam, \r\nPulau Pinang.'),
(2, 'Natsuki', 'DDLC Club', '019-2231331', '019-2231332', 'natsuki@ddlc.dom', 'No 10 Street Shanghai,\r\n456 Book Road'),
(3, 'Sayori', 'SayoriDDLC', '013-1421212', '013-1421213', 'sayori@ddlc.com', 'No 10 Bookyln Road,\r\nBook Road 23102'),
(4, 'ete', '', '', '', '', ''),
(5, 'test', '', '', '', '', ''),
(6, 'Monn11', '1231', '241', '124', 'yur1@ddlc.com', '121'),
(7, 'NewUserpls', '124', '1211-12112', '1', '', ''),
(8, 'Moon Moon', 'assa1221', '12-23224214', '12212412', '1244', '444'),
(9, 'Test2131', '21412', '', '', '', '');

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
  `delivered` varchar(1) NOT NULL,
  `customerID` int(100) NOT NULL,
  `miscNotes` varchar(500) NOT NULL,
  `purchaseOrderNo` varchar(500) NOT NULL,
  `driverID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoiceID`, `date`, `totalPrice`, `delivered`, `customerID`, `miscNotes`, `purchaseOrderNo`, `driverID`) VALUES
(1, '2018-04-12', '4700.00', '0', 1, 'Deliver on 1st April', 'PO-000567', 0),
(3, '2018-04-12', '200.00', '0', 1, 'Test', 'PO-1111', 0),
(4, '2018-04-15', '20.00', '0', 2, 'New Test', 'PO-2131', 0),
(5, '2018-04-15', '350.00', '0', 3, '', 'PS-12111', 0),
(9, '2018-08-15', '10.00', '0', 2, '', '1231', 0),
(10, '2018-08-15', '160.00', '0', 4, '', 'tetet', 0),
(11, '2018-08-15', '10.00', '0', 5, '', '1111', 0),
(12, '2018-08-15', '10.00', '0', 6, '', '4124', 0),
(13, '2018-08-15', '10.00', '0', 1, '121', '12', 0),
(14, '2018-08-15', '0.00', '0', 7, '', '1111', 0),
(15, '2018-08-17', '10.00', '0', 4, 'as', 'as', 0),
(16, '2018-08-17', '10.00', '0', 2, '121421412', 'NAT-2124', 0),
(19, '2018-08-18', '50.00', '1', 3, '', 'Sayoori-241', 0),
(20, '2018-08-28', '3600.00', '1', 7, 'Helloooaa', 'KEK-PLASa', 0),
(21, '2018-09-20', '4000.00', '1', 3, '11', 'SAY-1241', 0);

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
(6, 3, 1, 20, ''),
(8, 5, 4, 1, ''),
(9, 5, 2, 2, ''),
(10, 1, 1, 10, ''),
(11, 1, 2, 20, ''),
(12, 1, 5, 10, ''),
(14, 4, 1, 2, ''),
(18, 9, 1, 1, ''),
(19, 10, 5, 1, ''),
(20, 11, 1, 1, ''),
(21, 12, 1, 1, ''),
(22, 13, 1, 1, ''),
(24, 15, 1, 1, ''),
(25, 16, 1, 1, ''),
(31, 19, 4, 1, ''),
(84, 20, 1, 5, ''),
(85, 20, 2, 20, ''),
(86, 20, 4, 11, ''),
(87, 21, 3, 100, '');

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
(1, 'images/stockUpload/Trade-Assurance-pine-wood-plank.jpg_350x350.jpg', 'Pine Wood', '10.00', 7),
(2, 'images/stockUpload/dowel.png', 'Stainless Steel Bar', '150.00', 97),
(3, 'images/stockUpload/nitrile-rubber-sheet.jpg', 'Rubber Sheet', '40.00', -35),
(4, 'images/stockUpload/plastic-sheet-supplier.jpg', 'Plastic Sheet', '50.00', 37),
(5, 'images/stockUpload/20170424042023_20130415045738floatglass.jpg', 'Glass Sheet', '160.00', 194);

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
(1, 'admin@admin.com', 0, 'admin', 'admin123', 'admin', 'admin', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `creditdebit`
--
ALTER TABLE `creditdebit`
  ADD PRIMARY KEY (`ID`);

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
-- AUTO_INCREMENT for table `creditdebit`
--
ALTER TABLE `creditdebit`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `deliveryID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoiceID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `invoiceitemlist`
--
ALTER TABLE `invoiceitemlist`
  MODIFY `itemListID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stockID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
