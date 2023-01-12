-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-01-09 01:53:14
-- 伺服器版本： 10.4.25-MariaDB
-- PHP 版本： 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `canele`
--

-- --------------------------------------------------------

--
-- 資料表結構 `closeddate`
--

CREATE TABLE `closeddate` (
  `Date` date NOT NULL,
  `Closed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `customer`
--

CREATE TABLE `customer` (
  `CustomerId` mediumint(8) UNSIGNED ZEROFILL NOT NULL,
  `CustomerName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Phone` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `customer`
--

INSERT INTO `customer` (`CustomerId`, `CustomerName`, `Email`, `Phone`, `Password`, `Status`) VALUES
(00000001, '李銘峰', 'leemikepop@gmail.com', '0988315452', '1234', 'ACTIVE'),
(00000002, '裘斯淇', '477@gmail.com', '0123456789', '1234', 'ACTIVE');

-- --------------------------------------------------------

--
-- 資料表結構 `menu`
--

CREATE TABLE `menu` (
  `MealId` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `Ssn` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Price` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `Note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ImgName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ImgDir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StartDate` date NOT NULL DEFAULT '2001-01-01',
  `ExpiryDate` date NOT NULL DEFAULT '3000-12-31',
  `CreatedTS` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedTS` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `ordermenu`
--

CREATE TABLE `ordermenu` (
  `OderId` char(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MealId` smallint(5) UNSIGNED ZEROFILL NOT NULL,
  `NumOfMeals` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `OrderId` char(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CustomerId` mediumint(8) UNSIGNED ZEROFILL NOT NULL,
  `Type` char(1) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'A:自取|B:宅配',
  `Note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `OrderStatus` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NEW' COMMENT 'NEW|ACCEPT|DELIVERYING|COMPLITED|CANCELLED',
  `PayStatus` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '''UNPAID''' COMMENT 'UNPAID|FAIL|OVERTIME|PAID|REFUNDING|REFUND',
  `CreatedTS` timestamp NOT NULL DEFAULT current_timestamp(),
  `AcceptedTS` timestamp NULL DEFAULT NULL,
  `DeliverdTS` timestamp NULL DEFAULT NULL,
  `CompletedTS` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `owner`
--

CREATE TABLE `owner` (
  `Ssn` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Position` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `shipmentinfo`
--

CREATE TABLE `shipmentinfo` (
  `OrderId` char(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Recipient` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Phone` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Date` date NOT NULL,
  `ShippingTime` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '4' COMMENT '1:13時前|2:14-18時|4:不指定',
  `ZipCode` char(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `closeddate`
--
ALTER TABLE `closeddate`
  ADD PRIMARY KEY (`Date`);

--
-- 資料表索引 `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerId`);

--
-- 資料表索引 `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`MealId`);

--
-- 資料表索引 `ordermenu`
--
ALTER TABLE `ordermenu`
  ADD PRIMARY KEY (`OderId`,`MealId`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderId`);

--
-- 資料表索引 `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`Ssn`);

--
-- 資料表索引 `shipmentinfo`
--
ALTER TABLE `shipmentinfo`
  ADD PRIMARY KEY (`OrderId`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerId` mediumint(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `menu`
--
ALTER TABLE `menu`
  MODIFY `MealId` smallint(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
