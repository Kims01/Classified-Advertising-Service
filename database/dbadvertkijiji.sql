-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 19-04-22 10:00
-- 서버 버전: 10.1.37-MariaDB
-- PHP 버전: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `dbadvertkijiji`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `advertisement`
--

CREATE TABLE `advertisement` (
  `AdvertID` int(11) NOT NULL,
  `PaymentID` int(11) DEFAULT NULL,
  `MemberID` int(11) NOT NULL,
  `SubCategoryID` int(11) NOT NULL,
  `AdvertDesc` text NOT NULL,
  `RegDate` date NOT NULL,
  `ExpDate` date NOT NULL,
  `Price` double NOT NULL,
  `Title` varchar(100) NOT NULL,
  `PaidAd` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `advertisement`
--

INSERT INTO `advertisement` (`AdvertID`, `PaymentID`, `MemberID`, `SubCategoryID`, `AdvertDesc`, `RegDate`, `ExpDate`, `Price`, `Title`, `PaidAd`) VALUES
(1, 1, 1, 1, 'Selling my Tesla Car', '2019-03-05', '2019-03-10', 1000, 'TESLA - tesla sale', 1),
(2, 2, 2, 3, 'A great truck is on sale!', '2019-03-09', '2019-03-13', 3500.99, 'Truck Sale Advertisement', 1),
(4, NULL, 1, 4, 'call us', '2019-04-29', '2019-04-29', 300, 'manager wanted', 0),
(5, NULL, 1, 5, 'c', '2019-04-20', '2019-04-29', 1000, 'developer needed', 0),
(6, NULL, 1, 9, 'call me', '2019-04-20', '2019-04-29', 200, 'baby needed', 0),
(12, NULL, 1, 8, 'only wore once', '2019-04-20', '2019-04-29', 1000, 'Club Monaco Jacket', 0),
(13, NULL, 1, 1, '22', '2019-04-20', '2019-04-29', 2000, 'Good car', 0),
(30, NULL, 1, 1, 'sedan', '2019-04-22', '2019-05-01', 1000, 'sedan', 0),
(31, NULL, 1, 7, 'Nobody can buy this because it is too expensive', '2019-04-22', '2019-05-01', 50000, 'Bloody expensive coat', 1),
(32, NULL, 1, 2, 'Very powerful. Good Condition.', '2019-04-22', '2019-05-01', 25000, 'Mazda V6', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `category`
--

CREATE TABLE `category` (
  `CategoryID` int(3) NOT NULL,
  `Desc_Eng` varchar(250) NOT NULL,
  `Desc_Fre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `category`
--

INSERT INTO `category` (`CategoryID`, `Desc_Eng`, `Desc_Fre`) VALUES
(1, 'Vehicles', 'Véhicules\r\n'),
(2, 'Jobs', 'Emplois'),
(3, 'Clothes', 'Vêtements');

-- --------------------------------------------------------

--
-- 테이블 구조 `images`
--

CREATE TABLE `images` (
  `ImageID` int(11) NOT NULL,
  `AdvertID` int(11) NOT NULL,
  `Source` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `images`
--

INSERT INTO `images` (`ImageID`, `AdvertID`, `Source`) VALUES
(1, 1, '001-001.jpg'),
(2, 2, '002-001.jpg'),
(3, 31, '031-001.jpg');

-- --------------------------------------------------------

--
-- 테이블 구조 `luckymember`
--

CREATE TABLE `luckymember` (
  `LuckyMemberID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `RegDate` date NOT NULL,
  `ExpDate` date NOT NULL,
  `DiscountRate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `luckymember`
--

INSERT INTO `luckymember` (`LuckyMemberID`, `MemberID`, `RegDate`, `ExpDate`, `DiscountRate`) VALUES
(1, 1, '2019-03-22', '2019-03-25', 0.2),
(2, 2, '2019-03-27', '2019-03-30', 0.35);

-- --------------------------------------------------------

--
-- 테이블 구조 `member`
--

CREATE TABLE `member` (
  `MemberID` int(5) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Address` varchar(20) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(12) NOT NULL,
  `MemberType` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `member`
--

INSERT INTO `member` (`MemberID`, `Name`, `Address`, `City`, `State`, `Phone`, `Email`, `Password`, `MemberType`) VALUES
(1, 'Judy Mok', '1819 Beaubien East', 'Montreal', 'Quebec', '514-549-5016', 'sigurrosist@gmail.com', '1234', 1),
(2, 'Seungyeon', '2000 Ste.Catherine', 'Montreal', 'Quebec', '514-516-1135', 'seungyeon@gmail.com', '1234', 2),
(3, 'Admin Admin', '1827 Admin Road', 'Admin', 'Admin', '7894561230', 'admin@admin.com', '1234', 2);

-- --------------------------------------------------------

--
-- 테이블 구조 `message`
--

CREATE TABLE `message` (
  `MessageID` int(3) NOT NULL,
  `Title` varchar(250) NOT NULL,
  `Message` varchar(250) NOT NULL,
  `CreateDate` date NOT NULL,
  `Sender` int(3) NOT NULL,
  `Receiver` int(3) NOT NULL,
  `New` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `message`
--

INSERT INTO `message` (`MessageID`, `Title`, `Message`, `CreateDate`, `Sender`, `Receiver`, `New`) VALUES
(1, 'Hyundai', 'Iwantit', '2019-04-19', 10, 30, 1),
(2, 'What\'sup', 'I wanna buy', '2019-04-21', 2, 1, 1),
(3, 'How r u', 'Do u wanna meet?', '2019-04-21', 2, 1, 1),
(4, 'ur jacket', 'I want it', '2019-04-21', 1, 2, 1),
(5, 'your coat', 'I wanna buy it', '2019-04-21', 1, 2, 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(3) NOT NULL,
  `NumberOfImage` int(3) NOT NULL,
  `Duration` int(3) NOT NULL,
  `TotalPayment` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `payment`
--

INSERT INTO `payment` (`PaymentID`, `NumberOfImage`, `Duration`, `TotalPayment`) VALUES
(1, 5, 5, '20'),
(2, 5, 5, '20');

-- --------------------------------------------------------

--
-- 테이블 구조 `subcategory`
--

CREATE TABLE `subcategory` (
  `SubCategoryID` int(3) NOT NULL,
  `CategoryID` int(3) NOT NULL,
  `Desc_Eng` varchar(250) NOT NULL,
  `Desc_Fre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `subcategory`
--

INSERT INTO `subcategory` (`SubCategoryID`, `CategoryID`, `Desc_Eng`, `Desc_Fre`) VALUES
(1, 1, 'Sedan', 'Sedan'),
(2, 1, 'Wagon', 'Wagon'),
(3, 1, 'Truck', 'Camion'),
(4, 2, 'Manager', 'Directeur'),
(5, 2, 'Developer', 'Développeur'),
(6, 2, 'Clerk', 'Employé de bureau\r\n'),
(7, 3, 'Woman', 'Femme'),
(8, 3, 'Man', 'Homme'),
(9, 3, 'Baby', 'Bébé');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`AdvertID`),
  ADD KEY `PaymentID` (`PaymentID`),
  ADD KEY `MemberID` (`MemberID`,`SubCategoryID`),
  ADD KEY `SubCategoryID` (`SubCategoryID`);

--
-- 테이블의 인덱스 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- 테이블의 인덱스 `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`ImageID`),
  ADD KEY `AdvertID` (`AdvertID`);

--
-- 테이블의 인덱스 `luckymember`
--
ALTER TABLE `luckymember`
  ADD PRIMARY KEY (`LuckyMemberID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- 테이블의 인덱스 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`MemberID`);

--
-- 테이블의 인덱스 `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`MessageID`);

--
-- 테이블의 인덱스 `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`);

--
-- 테이블의 인덱스 `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`SubCategoryID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `AdvertID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- 테이블의 AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 테이블의 AUTO_INCREMENT `images`
--
ALTER TABLE `images`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 테이블의 AUTO_INCREMENT `luckymember`
--
ALTER TABLE `luckymember`
  MODIFY `LuckyMemberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `MemberID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 테이블의 AUTO_INCREMENT `message`
--
ALTER TABLE `message`
  MODIFY `MessageID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 테이블의 AUTO_INCREMENT `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `SubCategoryID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `advertisement`
--
ALTER TABLE `advertisement`
  ADD CONSTRAINT `advertisement_ibfk_1` FOREIGN KEY (`SubCategoryID`) REFERENCES `subcategory` (`SubCategoryID`),
  ADD CONSTRAINT `advertisement_ibfk_2` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`),
  ADD CONSTRAINT `advertisement_ibfk_3` FOREIGN KEY (`PaymentID`) REFERENCES `payment` (`PaymentID`);

--
-- 테이블의 제약사항 `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`AdvertID`) REFERENCES `advertisement` (`AdvertID`);

--
-- 테이블의 제약사항 `luckymember`
--
ALTER TABLE `luckymember`
  ADD CONSTRAINT `luckymember_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`);

--
-- 테이블의 제약사항 `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
