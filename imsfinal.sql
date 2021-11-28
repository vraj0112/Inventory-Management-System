-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2021 at 07:31 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imsfinal`
--

-- --------------------------------------------------------

--
-- Table structure for table `brandmapp`
--

CREATE TABLE `brandmapp` (
  `BrandMapping` int(11) NOT NULL,
  `SubcategoryId` int(11) DEFAULT NULL,
  `BrandId` int(11) DEFAULT NULL,
  `RecStatus` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `brandnames`
--

CREATE TABLE `brandnames` (
  `BrandId` int(11) NOT NULL,
  `BrandName` varchar(70) DEFAULT NULL,
  `RecStatus` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `breakageanddamage`
--

CREATE TABLE `breakageanddamage` (
  `SysId` int(11) NOT NULL,
  `StockId` int(11) DEFAULT NULL,
  `BillingQty` int(11) DEFAULT NULL,
  `OtherQty` int(11) DEFAULT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ModifiedDate` datetime NOT NULL,
  `RecStatus` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) DEFAULT NULL,
  `active_status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `challandetails`
--

CREATE TABLE `challandetails` (
  `ChallanId` int(11) DEFAULT NULL,
  `StockId` int(11) DEFAULT NULL,
  `BillingQty` int(11) DEFAULT NULL,
  `OtherQty` int(11) DEFAULT NULL,
  `SellingPrice` float DEFAULT NULL,
  `RecStatus` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `challanmst`
--

CREATE TABLE `challanmst` (
  `ChallanId` int(11) NOT NULL,
  `ChallanNo` int(11) DEFAULT 0,
  `ChallanDate` datetime NOT NULL,
  `CustomerId` int(11) DEFAULT NULL,
  `CreatedDate` datetime NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `TotalAmount` float DEFAULT NULL,
  `Discount` float DEFAULT 0,
  `TransportCost` float DEFAULT NULL,
  `AmountToBePaid` float DEFAULT NULL,
  `RoundOffDeade` float DEFAULT 0,
  `DueAmount` float DEFAULT 0,
  `RecStatus` tinyint(1) DEFAULT 1,
  `ExtraCostDesc` text DEFAULT NULL,
  `ExtraCost` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `challanno`
--

CREATE TABLE `challanno` (
  `month` varchar(6) NOT NULL,
  `last_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `grademapp`
--

CREATE TABLE `grademapp` (
  `GradeMappId` int(11) NOT NULL,
  `Subcategory_id` int(11) DEFAULT NULL,
  `GradeId` int(11) DEFAULT NULL,
  `RecStatus` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `GradeId` int(11) NOT NULL,
  `GradeText` varchar(20) DEFAULT NULL,
  `RecStatus` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invoicedetails`
--

CREATE TABLE `invoicedetails` (
  `InvoiceId` int(30) NOT NULL,
  `StockId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `SellingPrice` float NOT NULL,
  `RecStatus` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invoicemst`
--

CREATE TABLE `invoicemst` (
  `InvoiceId` int(30) NOT NULL,
  `InvoiceNo` varchar(10) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `InvoiceDate` datetime NOT NULL,
  `TotalAmount` int(11) NOT NULL,
  `Discount` float NOT NULL,
  `TransportationCost` float NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ModifiedDate` datetime NOT NULL,
  `RecStatus` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invoiceno`
--

CREATE TABLE `invoiceno` (
  `month` varchar(6) NOT NULL,
  `last_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `productmst`
--

CREATE TABLE `productmst` (
  `ProductID` int(11) NOT NULL,
  `ProductSubCategoryID` int(11) DEFAULT NULL,
  `ProductTypeColor` varchar(50) DEFAULT 'N/A',
  `SizeOrDimension` varchar(50) DEFAULT 'N/A',
  `QtyPerUnit` int(11) NOT NULL,
  `PackingUnit` varchar(15) NOT NULL,
  `Code` varchar(30) DEFAULT 'N/A',
  `CreatedDate` date DEFAULT curdate(),
  `ModifiedDate` date DEFAULT NULL,
  `BrandId` int(11) DEFAULT NULL,
  `GradeId` int(11) DEFAULT NULL,
  `RecStatus` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `returndetails`
--

CREATE TABLE `returndetails` (
  `ReturnId` int(10) NOT NULL,
  `ChallanId` int(10) NOT NULL,
  `StockId` int(10) NOT NULL,
  `BillingReturnQty` int(10) NOT NULL,
  `OtherReturnQty` int(10) NOT NULL,
  `ReturnAmount` int(10) NOT NULL,
  `Createddate` datetime NOT NULL,
  `Modifieddate` datetime NOT NULL,
  `RecStatus` tinyint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stockdetails`
--

CREATE TABLE `stockdetails` (
  `StockId` int(100) NOT NULL,
  `SysId` int(100) NOT NULL,
  `BillingQty` int(100) NOT NULL,
  `OtherQty` int(100) NOT NULL,
  `VirtualQty` int(100) NOT NULL,
  `DateAdded` datetime NOT NULL DEFAULT current_timestamp(),
  `InwardId` int(100) NOT NULL,
  `Createdate` datetime NOT NULL DEFAULT current_timestamp(),
  `ModifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stockmst`
--

CREATE TABLE `stockmst` (
  `SysId` int(11) NOT NULL,
  `BillingQty` int(11) DEFAULT 0,
  `OtherQty` int(11) DEFAULT 0,
  `RecStatus` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(30) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `active_status` tinyint(1) DEFAULT 1,
  `ProductHSNCode` varchar(8) DEFAULT NULL,
  `ProductGST` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `systable`
--

CREATE TABLE `systable` (
  `SysId` int(11) NOT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `BasePrice` float DEFAULT NULL,
  `BatchNo` varchar(100) NOT NULL,
  `RecStatus` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomermst`
--

CREATE TABLE `tblcustomermst` (
  `CustomerId` int(10) NOT NULL,
  `CustomerName` text NOT NULL,
  `MobileNo` bigint(10) NOT NULL,
  `Email` text NOT NULL,
  `Address` text NOT NULL,
  `GSTNo` varchar(16) NOT NULL,
  `CreatedDate` date NOT NULL,
  `ModifiedDate` date NOT NULL,
  `RecStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblexpencemst`
--

CREATE TABLE `tblexpencemst` (
  `ExpanceId` int(10) NOT NULL,
  `Discription` text NOT NULL,
  `ExpanceDate` date NOT NULL,
  `Amount` float NOT NULL,
  `CreatedDate` date NOT NULL,
  `ModifiedDate` datetime NOT NULL,
  `RecStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblinwardbillmst`
--

CREATE TABLE `tblinwardbillmst` (
  `InwardId` int(100) NOT NULL,
  `InwardDate` datetime NOT NULL,
  `VendorId` int(100) NOT NULL,
  `TotalGST` float(100,2) NOT NULL,
  `Transport_extracost` float(100,2) NOT NULL,
  `TotalAmount` float(100,2) NOT NULL,
  `AmountPaid` float(100,2) NOT NULL,
  `AmountPending` float(100,2) NOT NULL,
  `UploadBill` longtext NOT NULL,
  `PaymentMode` varchar(10) NOT NULL,
  `TotalDiscount` float(100,2) NOT NULL,
  `Notes` varchar(200) NOT NULL,
  `StockMstSysId` int(100) NOT NULL,
  `CreatedDate` date NOT NULL DEFAULT current_timestamp(),
  `ModifiedDate` date NOT NULL,
  `RecStatus` varchar(1) NOT NULL DEFAULT 'A',
  `StockType` varchar(50) NOT NULL,
  `ExtraCost` int(100) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `tempextra` int(11) NOT NULL DEFAULT 0,
  `temptransport` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblinwarddetails`
--

CREATE TABLE `tblinwarddetails` (
  `InwardNo` int(10) NOT NULL,
  `ProductId` int(10) NOT NULL,
  `InwardId` int(10) NOT NULL,
  `Qty` int(10) NOT NULL,
  `Price` float NOT NULL,
  `CGST` float NOT NULL,
  `SGST` float NOT NULL,
  `TotalCost` float NOT NULL,
  `Discount` float NOT NULL,
  `StockMstSysId` int(10) NOT NULL,
  `CreatedDate` date NOT NULL DEFAULT current_timestamp(),
  `ModifiedDate` date NOT NULL,
  `RecStatus` varchar(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblinwardpayment`
--

CREATE TABLE `tblinwardpayment` (
  `InwardId` int(10) NOT NULL,
  `PaymentDate` datetime NOT NULL DEFAULT current_timestamp(),
  `AmountPaid` float NOT NULL,
  `AmountPending` float NOT NULL,
  `Status` text NOT NULL,
  `PaymentMode` text NOT NULL,
  `RoundOffDade` float NOT NULL,
  `PaymentNotes` varchar(255) NOT NULL,
  `StockMstSysId` int(10) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ModifiedDate` datetime DEFAULT NULL,
  `RecStatus` varchar(1) NOT NULL DEFAULT '1',
  `ChallanId` int(11) DEFAULT NULL,
  `PaymentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblqutationdetails`
--

CREATE TABLE `tblqutationdetails` (
  `ItemNo` int(11) NOT NULL,
  `Discription` text NOT NULL,
  `Qty` int(10) NOT NULL,
  `Rate` float NOT NULL,
  `Gst` int(10) NOT NULL,
  `CreatedDate` date NOT NULL DEFAULT current_timestamp(),
  `ModifiedDate` date NOT NULL,
  `RecStatus` tinyint(1) NOT NULL DEFAULT 1,
  `QutationId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblqutationmst`
--

CREATE TABLE `tblqutationmst` (
  `QutationId` int(10) NOT NULL,
  `Name` text NOT NULL,
  `QDate` date NOT NULL,
  `TotalPrice` float NOT NULL,
  `TotalGST` float NOT NULL,
  `TotalAmount` float NOT NULL,
  `CreatedDate` date NOT NULL DEFAULT current_timestamp(),
  `ModifiedDate` date NOT NULL,
  `RecStatus` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblvendormst`
--

CREATE TABLE `tblvendormst` (
  `VendorId` int(10) NOT NULL,
  `VendorName` text NOT NULL,
  `MobileNo` bigint(10) NOT NULL,
  `Email` text NOT NULL,
  `Address` text NOT NULL,
  `GSTNo` varchar(16) NOT NULL,
  `CreatedDate` date NOT NULL,
  `ModifiedDate` date NOT NULL,
  `RecStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brandmapp`
--
ALTER TABLE `brandmapp`
  ADD PRIMARY KEY (`BrandMapping`),
  ADD KEY `SubcategoryId` (`SubcategoryId`),
  ADD KEY `BrandId` (`BrandId`);

--
-- Indexes for table `brandnames`
--
ALTER TABLE `brandnames`
  ADD PRIMARY KEY (`BrandId`);

--
-- Indexes for table `breakageanddamage`
--
ALTER TABLE `breakageanddamage`
  ADD PRIMARY KEY (`SysId`),
  ADD KEY `StockId` (`StockId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `challandetails`
--
ALTER TABLE `challandetails`
  ADD KEY `ChallanId` (`ChallanId`),
  ADD KEY `StockId` (`StockId`);

--
-- Indexes for table `challanmst`
--
ALTER TABLE `challanmst`
  ADD PRIMARY KEY (`ChallanId`),
  ADD KEY `CustomerId` (`CustomerId`);

--
-- Indexes for table `challanno`
--
ALTER TABLE `challanno`
  ADD PRIMARY KEY (`month`);

--
-- Indexes for table `grademapp`
--
ALTER TABLE `grademapp`
  ADD PRIMARY KEY (`GradeMappId`),
  ADD KEY `Subcategory_id` (`Subcategory_id`),
  ADD KEY `GradeId` (`GradeId`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`GradeId`);

--
-- Indexes for table `invoicedetails`
--
ALTER TABLE `invoicedetails`
  ADD KEY `InvoiceId` (`InvoiceId`),
  ADD KEY `StockId` (`StockId`);

--
-- Indexes for table `invoicemst`
--
ALTER TABLE `invoicemst`
  ADD PRIMARY KEY (`InvoiceId`),
  ADD KEY `CustomerId` (`CustomerId`);

--
-- Indexes for table `invoiceno`
--
ALTER TABLE `invoiceno`
  ADD PRIMARY KEY (`month`);

--
-- Indexes for table `productmst`
--
ALTER TABLE `productmst`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `ProductSubCategoryID` (`ProductSubCategoryID`);

--
-- Indexes for table `returndetails`
--
ALTER TABLE `returndetails`
  ADD PRIMARY KEY (`ReturnId`);

--
-- Indexes for table `stockdetails`
--
ALTER TABLE `stockdetails`
  ADD PRIMARY KEY (`StockId`);

--
-- Indexes for table `stockmst`
--
ALTER TABLE `stockmst`
  ADD KEY `SysId` (`SysId`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`subcategory_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `systable`
--
ALTER TABLE `systable`
  ADD PRIMARY KEY (`SysId`),
  ADD KEY `ProductId` (`ProductId`);

--
-- Indexes for table `tblcustomermst`
--
ALTER TABLE `tblcustomermst`
  ADD PRIMARY KEY (`CustomerId`);

--
-- Indexes for table `tblexpencemst`
--
ALTER TABLE `tblexpencemst`
  ADD PRIMARY KEY (`ExpanceId`);

--
-- Indexes for table `tblinwardbillmst`
--
ALTER TABLE `tblinwardbillmst`
  ADD PRIMARY KEY (`InwardId`);

--
-- Indexes for table `tblinwarddetails`
--
ALTER TABLE `tblinwarddetails`
  ADD PRIMARY KEY (`InwardNo`);

--
-- Indexes for table `tblinwardpayment`
--
ALTER TABLE `tblinwardpayment`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `tblqutationdetails`
--
ALTER TABLE `tblqutationdetails`
  ADD KEY `fk_foreign_key_name` (`QutationId`);

--
-- Indexes for table `tblqutationmst`
--
ALTER TABLE `tblqutationmst`
  ADD PRIMARY KEY (`QutationId`);

--
-- Indexes for table `tblvendormst`
--
ALTER TABLE `tblvendormst`
  ADD PRIMARY KEY (`VendorId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brandmapp`
--
ALTER TABLE `brandmapp`
  MODIFY `BrandMapping` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brandnames`
--
ALTER TABLE `brandnames`
  MODIFY `BrandId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `breakageanddamage`
--
ALTER TABLE `breakageanddamage`
  MODIFY `SysId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `challanmst`
--
ALTER TABLE `challanmst`
  MODIFY `ChallanId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grademapp`
--
ALTER TABLE `grademapp`
  MODIFY `GradeMappId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `GradeId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoicemst`
--
ALTER TABLE `invoicemst`
  MODIFY `InvoiceId` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productmst`
--
ALTER TABLE `productmst`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `returndetails`
--
ALTER TABLE `returndetails`
  MODIFY `ReturnId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stockdetails`
--
ALTER TABLE `stockdetails`
  MODIFY `StockId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `systable`
--
ALTER TABLE `systable`
  MODIFY `SysId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblcustomermst`
--
ALTER TABLE `tblcustomermst`
  MODIFY `CustomerId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblexpencemst`
--
ALTER TABLE `tblexpencemst`
  MODIFY `ExpanceId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblinwardbillmst`
--
ALTER TABLE `tblinwardbillmst`
  MODIFY `InwardId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblinwarddetails`
--
ALTER TABLE `tblinwarddetails`
  MODIFY `InwardNo` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblinwardpayment`
--
ALTER TABLE `tblinwardpayment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblqutationmst`
--
ALTER TABLE `tblqutationmst`
  MODIFY `QutationId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblvendormst`
--
ALTER TABLE `tblvendormst`
  MODIFY `VendorId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
