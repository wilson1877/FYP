-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2018 at 01:07 PM
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
(1, 1, 2, '0.00', '0.00', '2018-10-02', ''),
(2, 2, 5, '0.00', '9000.00', '2018-10-02', ''),
(3, 3, 7, '0.00', '200.00', '2018-10-02', ''),
(4, 4, 8, '0.00', '176.00', '2018-10-02', ''),
(5, 5, 8, '0.00', '300.00', '2018-10-02', ''),
(6, 6, 5, '0.00', '750.00', '2018-10-02', ''),
(9, 0, 5, '5000.00', '0.00', '2018-10-02', 'MAYBANK-5129922'),
(10, 7, 1, '0.00', '200.00', '2018-10-02', ''),
(11, 8, 6, '0.00', '1000.00', '2018-10-02', ''),
(12, 9, 6, '0.00', '1000.00', '2018-10-02', ''),
(13, 10, 4, '0.00', '4096.00', '2018-10-02', ''),
(14, 11, 7, '0.00', '300.00', '2018-10-02', ''),
(15, 12, 8, '0.00', '450.00', '2018-10-02', ''),
(16, 13, 3, '0.00', '3674.00', '2018-10-02', ''),
(17, 0, 8, '211.00', '0.00', '2018-10-02', '1121'),
(18, 0, 7, '111.00', '0.00', '2018-10-02', 'MAYBANK-12111'),
(19, 14, 8, '0.00', '1000.00', '2018-10-02', '');

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
(1, 'Sayori', 'DDLC Club', '019-231121221', '', 'sayori@ddlc.com', '464 Rockland Rd.\r\nGlenside, PA 19038'),
(2, 'Mrs Koay', 'Axis Industrial Machinery Sdn Bhd', '604-3907440', '604-3996561', '', '2412, NK. Prai Industrial Complex, 13600 Penang'),
(3, 'Encik Jamil', 'Ohara Optical (M) Sdn Bhd', '606-2633334', '606-2633332', '', 'Lot 6B & 6C, Merlimau Industrial Estate						Merlimau						77300 Melaka'),
(4, 'Ah Siong', 'Nam Seng Hardware Trading Co', '03-33422618', '03-33433329', 'ahsing@namseng.com', 'No. 74, Lebuh Tapah\r\nOff Jalan Goh Hock Huat\r\nKlang. Selangor D.E.'),
(5, 'Mr Tiong Chiong Chan', 'Kobeco Machine Tools (KL) Sdn Bhd.', '03 - 8066 7850', '', 'admin@kobecokl.com', 'No. 9,  Taman Perindustrian Tasik Perdana,47100 Puchong'),
(6, 'Ms Kiew', 'UB Acrylic (M) Sdn Bhd', '603-87611377', '603-87611296', 'kiew@acrylickl.com', 'Lot 1286, Bt.19, Jalan Ulu Beranang,\r\nBroga,\r\n71750 Lenggeng'),
(7, 'Ms. Low GT', 'Dormakaba Production Malaysia Sdn Bhd', '06-3354848 (EXT 122)', '06-3354869', '', '2A, Jalan TTC8, Taman Teknologi Cheng\r\nMelaka 75250, Malaysia'),
(8, 'Mr Ooi', 'O&O Enterprise', '604-5089551', '604-5089551', '', '51,Jalan Saujana Permai 1,\r\nTaman Saujana Permai,\r\n14000 Bukit Mertajam. Penang');

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
  `delivered` int(1) NOT NULL,
  `customerID` int(100) NOT NULL,
  `miscNotes` varchar(500) NOT NULL,
  `purchaseOrderNo` varchar(500) NOT NULL,
  `driverID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoiceID`, `date`, `totalPrice`, `delivered`, `customerID`, `miscNotes`, `purchaseOrderNo`, `driverID`) VALUES
(2, '2018-10-02', '2700.00', 0, 5, '', 'TO-1211', 0),
(3, '2018-10-02', '200.00', 0, 7, '', 'LOWGT-211', 0),
(4, '2018-10-02', '176.00', 0, 8, 'Phone Order', 'OO-093', 0),
(5, '2018-10-02', '300.00', 0, 8, '', 'OO-094', 0),
(6, '2018-10-02', '750.00', 0, 5, '', 'TO-1212', 0),
(7, '2018-10-02', '200.00', 0, 1, '', 'SAY-2111', 0),
(8, '2018-10-02', '1000.00', 0, 6, '', 'KW-12151', 0),
(9, '2018-10-02', '1000.00', 0, 6, '', 'KW-12151', 0),
(10, '2018-10-02', '4096.00', 0, 4, '', 'NAM-S-1215', 0),
(11, '2018-10-02', '300.00', 0, 7, '', 'LowGT-220', 0),
(12, '2018-10-02', '450.00', 0, 8, 'Call on Delivery', 'OO-121', 0),
(13, '2018-10-02', '3674.00', 1, 3, '', 'OHARA-1522', 0),
(14, '2018-10-02', '1000.00', 1, 8, '', 'OO-122', 0);

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
(3, 2, 1, 1, ''),
(4, 2, 4, 10, ''),
(5, 3, 4, 1, ''),
(6, 4, 2, 1, ''),
(7, 4, 3, 2, ''),
(8, 5, 2, 5, ''),
(9, 6, 5, 5, ''),
(10, 7, 4, 1, ''),
(11, 8, 4, 5, ''),
(12, 9, 4, 5, ''),
(13, 10, 1, 2, ''),
(14, 10, 3, 12, ''),
(15, 10, 4, 10, ''),
(16, 11, 2, 5, ''),
(18, 12, 5, 3, ''),
(19, 13, 3, 3, ''),
(20, 13, 1, 5, ''),
(21, 14, 4, 5, '');

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
(1, 'images/stockUpload/20170424042023_20130415045738floatglass.jpg', 'HONSBERG VISION M42 in coil 30m', '700.00', 479),
(2, 'images/stockUpload/dowel.png', 'M42 High Speed Steel Bi-Metal', '60.00', 489),
(3, 'images/stockUpload/DSC_1218.jpg', 'HONSBERG EXTRA M42 High Speed Steel Bi-Metal', '58.00', 283),
(4, 'images/stockUpload/nitrile-rubber-sheet.jpg', 'HONSBERG DURATEC M51 High Speed Steel Bi-Metal	', '200.00', 23),
(5, 'images/stockUpload/plastic-sheet-supplier.jpg', 'HONSBERG SPECTRA M42 High Speed Steel Bi-metal', '150.00', 112);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(100) NOT NULL,
  `emailAddress` varchar(20) NOT NULL,
  `contactNumber` varchar(20) NOT NULL,
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
(1, 'admin@admin.com', '00', 'Admin', 'admin123', 'Admin', 'Admin', '', 0),
(2, 'ckm@ckm.com', '0125201314', 'Wilson', 'ckm123', 'Wilson', 'Chang', '', 1),
(3, 'chs@chs.com', '0123456789', 'Hiap Seng', 'chs123', 'Chuah', 'Hiap Seng', '', 0);

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
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `deliveryID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoiceID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `invoiceitemlist`
--
ALTER TABLE `invoiceitemlist`
  MODIFY `itemListID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stockID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
