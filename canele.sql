-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-01-12 10:30:17
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

--
-- 傾印資料表的資料 `closeddate`
--

INSERT INTO `closeddate` (`Date`, `Closed`) VALUES
('2022-12-02', 1),
('2022-12-03', 1),
('2022-12-04', 1),
('2022-12-09', 1),
('2022-12-10', 1),
('2022-12-11', 1),
('2022-12-16', 1),
('2022-12-17', 1),
('2022-12-18', 1),
('2022-12-23', 1),
('2022-12-24', 1),
('2022-12-25', 1),
('2022-12-30', 1),
('2022-12-31', 1),
('2023-01-01', 1),
('2023-01-06', 1),
('2023-01-07', 1),
('2023-01-08', 1),
('2023-01-13', 1),
('2023-01-14', 1),
('2023-01-15', 1),
('2023-01-20', 1),
('2023-01-21', 1),
('2023-01-22', 1),
('2023-01-27', 1),
('2023-01-28', 1),
('2023-01-29', 1),
('2023-02-03', 0),
('2023-02-04', 1),
('2023-02-05', 1),
('2023-02-10', 0),
('2023-02-11', 1),
('2023-02-12', 1),
('2023-02-17', 0),
('2023-02-18', 1),
('2023-02-19', 1),
('2023-02-24', 1),
('2023-02-25', 1),
('2023-02-26', 1),
('2023-03-03', 1),
('2023-03-04', 1),
('2023-03-05', 1),
('2023-03-10', 1),
('2023-03-11', 1),
('2023-03-12', 1),
('2023-03-17', 1),
('2023-03-18', 1),
('2023-03-19', 1),
('2023-03-24', 1),
('2023-03-25', 1),
('2023-03-26', 1),
('2023-03-31', 1);

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
  `UpdatedTS` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `menu`
--

INSERT INTO `menu` (`MealId`, `Ssn`, `Name`, `Price`, `Note`, `ImgName`, `ImgDir`, `StartDate`, `ExpiryDate`, `CreatedTS`, `UpdatedTS`) VALUES
(00001, 'L125719117', '原味可麗露', 60, '本產品含有可可脂', 'Original.jpg', './Images/Original.jpg', '2023-01-02', '2033-12-31', '2023-01-12 05:33:02', '2023-01-12 05:33:59'),
(00002, 'L125719117', '焦糖可麗露', 65, '', 'Caramel.jpg', './Images/Caramel.jpg', '2023-01-01', '2033-12-31', '2023-01-12 05:33:33', '2023-01-12 05:33:33'),
(00003, 'L125719117', '抹茶可麗露', 65, '使用日本靜岡抹茶', 'Matcha.jpg', './Images/Matcha.jpg', '2023-01-01', '2033-12-31', '2023-01-12 05:34:34', '2023-01-12 05:34:34'),
(00004, 'L125719117', '巧克力可麗露', 65, '本產品含有可可脂', 'Chocolate.jpg', './Images/Chocolate.jpg', '2023-01-01', '2033-12-31', '2023-01-12 05:34:54', '2023-01-12 05:34:54'),
(00005, 'L125719117', '草莓可麗露', 65, '', 'Strawberry.jpg', './Images/Strawberry.jpg', '2023-01-01', '2023-04-06', '2023-01-12 05:35:55', '2023-01-12 05:35:55');

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

--
-- 傾印資料表的資料 `owner`
--

INSERT INTO `owner` (`Ssn`, `Name`, `Position`, `Password`, `Status`) VALUES
('L125719117', 'root', '系統開發者', 'root', 'ACTIVE');

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
  MODIFY `MealId` smallint(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
