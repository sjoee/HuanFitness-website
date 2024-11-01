-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2024 at 08:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gymdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `exercise_management`
--

CREATE TABLE `exercise_management` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `Edate` date DEFAULT NULL,
  `exercise_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercise_management`
--

INSERT INTO `exercise_management` (`id`, `uid`, `Edate`, `exercise_type`) VALUES
(1, 12, '2024-10-30', 'jogging'),
(3, 12, '2024-10-29', 'cycling');

-- --------------------------------------------------------

--
-- Table structure for table `tbladdpackage`
--

CREATE TABLE `tbladdpackage` (
  `id` int(11) NOT NULL,
  `category` varchar(45) DEFAULT NULL,
  `titlename` varchar(450) DEFAULT NULL,
  `PackageType` varchar(45) DEFAULT NULL,
  `PackageDuratiobn` varchar(45) DEFAULT NULL,
  `Price` varchar(45) DEFAULT NULL,
  `uploadphoto` varchar(450) DEFAULT NULL,
  `Description` varchar(450) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladdpackage`
--

INSERT INTO `tbladdpackage` (`id`, `category`, `titlename`, `PackageType`, `PackageDuratiobn`, `Price`, `uploadphoto`, `Description`, `create_date`) VALUES
(1, '1', 'Free Fitness Gear Package', '1', '3 Month', '600', NULL, 'Free Fitness Gear\nComplimentary OnePass', '2022-03-04 18:55:34'),
(2, '1', '3 Months Membership Package', '1', '6 Month', '800', NULL, 'Book Six Days Different Trainers Class designed for fast Weight Loss / Weight Gain with combination of Latest Workouts in addition to complimentary access to gym area with personal training.', '2022-03-04 18:56:44'),
(3, '1', 'Nutritionist Counseling', '2', 'Monthly', '10', NULL, 'Hire a personal nutritionist<div><br></div><div>Receive feedback on diet and possible exercises</div>', '2022-03-04 18:57:00'),
(4, '1', 'Annual Membership Package', '1', '1 Year', '120', NULL, 'Get unlimited access to our Gym amenities all year long.', '2022-03-04 18:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `name`, `email`, `mobile`, `password`, `create_date`) VALUES
(1, 'admin', 'admin@gmail.com', '99197896857', '5c428d8875d2948607f3e3fe134d71b4', '2022-01-19 03:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `id` int(11) NOT NULL,
  `package_id` varchar(45) DEFAULT NULL,
  `userid` varchar(45) DEFAULT NULL,
  `booking_date` timestamp NULL DEFAULT current_timestamp(),
  `payment` varchar(45) DEFAULT NULL,
  `paymentType` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`id`, `package_id`, `userid`, `booking_date`, `payment`, `paymentType`) VALUES
(1, '2', '1', '2022-03-04 19:53:21', '800', 'Partial Payment'),
(2, '1', '1', '2022-03-04 19:53:28', '600', 'Partial Payment'),
(3, '2', '5', '2022-03-08 09:44:18', '300', 'Full Payment'),
(8, '2', '11', '2024-10-29 03:40:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `category_name` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `category_name`, `status`) VALUES
(1, 'Category1', '0'),
(2, 'Category2', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tblnutritionmeeting`
--

CREATE TABLE `tblnutritionmeeting` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `specifications` text NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblnutritionmeeting`
--

INSERT INTO `tblnutritionmeeting` (`id`, `name`, `gender`, `date`, `specifications`, `submission_date`) VALUES
(1, 'Alice Johnson', 'Female', '2024-10-30', 'Perform check up', '2024-10-29 02:30:37'),
(2, 'Bob Smith', 'Male', '2024-11-01', 'Get advice', '2024-10-29 02:30:37'),
(3, 'Charlie Brown', 'Male', '2024-11-02', 'Change plan', '2024-10-29 02:30:37'),
(4, 'Diana Prince', 'Female', '2024-11-03', 'Perform check up', '2024-10-29 02:30:37'),
(5, 'Eve Adams', 'Female', '2024-11-04', 'Get advice', '2024-10-29 02:30:37'),
(6, 'Frank Castle', 'Male', '2024-11-05', 'Change plan', '2024-10-29 02:30:37'),
(7, 'Grace Lee', 'Female', '2024-11-06', 'Perform check up', '2024-10-29 02:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `tblpackage`
--

CREATE TABLE `tblpackage` (
  `id` int(11) NOT NULL,
  `cate_id` varchar(45) DEFAULT NULL,
  `PackageName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpackage`
--

INSERT INTO `tblpackage` (`id`, `cate_id`, `PackageName`) VALUES
(1, '1', 'Package1'),
(3, '2', 'Package2');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment`
--

CREATE TABLE `tblpayment` (
  `id` int(11) NOT NULL,
  `bookingID` varchar(45) DEFAULT NULL,
  `paymentType` varchar(45) DEFAULT NULL,
  `payment` varchar(45) DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpayment`
--

INSERT INTO `tblpayment` (`id`, `bookingID`, `paymentType`, `payment`, `payment_date`) VALUES
(1, '8', 'Partial Payment', '350', '2022-06-09 00:15:25'),
(2, '1', 'Partial Payment', '300', '2022-03-04 19:54:10'),
(3, '5', 'Full Payment', '500', '2022-06-09 02:45:30'),
(4, '6', 'Partial Payment', '300', '2022-06-10 03:25:55'),
(5, '8', 'Full Payment', '450', '2022-06-10 06:35:00'),
(6, '1', 'Full Payment', '500', '2022-05-21 17:01:58'),
(7, '9', 'Partial Payment', '250', '2022-06-11 08:15:45'),
(8, '3', 'Partial Payment', '300', '2022-05-21 17:09:53'),
(9, '10', 'Full Payment', '550', '2022-06-11 10:25:30'),
(10, '6', 'Partial Payment', '200', '2022-06-12 01:05:15'),
(11, '3', 'Full Payment', '500', '2022-05-21 17:19:03'),
(12, '7', 'Partial Payment', '500', '2022-05-21 18:40:34'),
(13, '7', 'Full Payment', '400', '2022-06-12 04:15:40'),
(14, '7', 'Full Payment', '300', '2022-05-21 18:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `fname`, `lname`, `email`, `mobile`, `password`, `state`, `city`, `address`, `create_date`) VALUES
(1, 'Amir', 'Aziz', 'amir.aziz@example.com', '60123456789', 'f925916e2754e5e03f75dd58a5733251', 'Selangor', 'Shah Alam', 'No. 10, Jalan Anggerik', '2023-01-10 01:15:30'),
(2, 'Nurul', 'Huda', 'nurul.huda@example.com', '60129876543', '202cb962ac59075b964b07152d234b70', 'Johor', 'Johor Bahru', 'No. 15, Jalan Mawar', '2023-02-12 06:22:18'),
(3, 'Farid', 'Rashid', 'farid.rashid@example.com', '60138765432', 'e10adc3949ba59abbe56e057f20f883e', 'Penang', 'George Town', 'No. 20, Jalan Dato Keramat', '2023-03-08 03:50:47'),
(4, 'Aisyah', 'Zain', 'aisyah.zain@example.com', '60147654321', 'f925916e2754e5e03f75dd58a5733251', 'Perak', 'Ipoh', 'No. 25, Jalan Raja Musa', '2023-04-18 08:35:20'),
(5, 'Zul', 'Rahman', 'zul.rahman@example.com', '60159876543', '202cb962ac59075b964b07152d234b70', 'Kuala Lumpur', 'Kuala Lumpur', 'No. 30, Jalan Tun Razak', '2023-05-22 05:47:52'),
(6, 'Sara', 'Smith', 'sara.smith@example.com', '1234567891', 'f925916e2754e5e03f75dd58a5733251', 'California', 'Los Angeles', '1234 Sunset Blvd', '2023-01-05 04:34:56'),
(7, 'Mike', 'Johnson', 'mike.johnson@example.com', '9876543210', '202cb962ac59075b964b07152d234b70', 'Texas', 'Austin', '5678 River Rd', '2023-02-10 01:45:23'),
(8, 'Emma', 'Williams', 'emma.williams@example.com', '5647382910', 'e10adc3949ba59abbe56e057f20f883e', 'Florida', 'Miami', '9101 Beach Ave', '2023-03-15 06:56:34'),
(9, 'David', 'Brown', 'david.brown@example.com', '1029384756', 'f925916e2754e5e03f75dd58a5733251', 'New York', 'Brooklyn', '1122 Flatbush Ave', '2023-04-20 00:23:10'),
(10, 'Olivia', 'Jones', 'olivia.jones@example.com', '7485961320', '202cb962ac59075b964b07152d234b70', 'Ohio', 'Columbus', '3344 Maple Dr', '2023-05-25 07:45:19'),
(11, 'John', 'Aaron', 'johna@test.com', '0193991100', 'd41d8cd98f00b204e9800998ecf8427e', 'Selangor', 'Subang Jaya', '', '2024-10-29 02:47:04'),
(12, 'j', 'j', 'james@gmail.com', '55555', '81dc9bdb52d04dc20036dbd8313ed055', 'f', 'gg', NULL, '2024-10-29 03:55:01');

-- --------------------------------------------------------

--
-- Table structure for table `water_management`
--

CREATE TABLE `water_management` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `Cdate` date DEFAULT NULL,
  `water_consumed` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `water_management`
--

INSERT INTO `water_management` (`id`, `uid`, `Cdate`, `water_consumed`) VALUES
(2, 12, '2024-10-31', 4.00),
(9, 12, '2024-10-30', 4.30);

-- --------------------------------------------------------

--
-- Table structure for table `weight_management`
--

CREATE TABLE `weight_management` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `Wdate` date DEFAULT NULL,
  `weightKG` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weight_management`
--

INSERT INTO `weight_management` (`id`, `uid`, `Wdate`, `weightKG`) VALUES
(5, 12, '2024-10-30', 90.00),
(10, 12, '2024-10-27', 90.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exercise_management`
--
ALTER TABLE `exercise_management`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `tbladdpackage`
--
ALTER TABLE `tbladdpackage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblnutritionmeeting`
--
ALTER TABLE `tblnutritionmeeting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpackage`
--
ALTER TABLE `tblpackage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `water_management`
--
ALTER TABLE `water_management`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `weight_management`
--
ALTER TABLE `weight_management`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exercise_management`
--
ALTER TABLE `exercise_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbladdpackage`
--
ALTER TABLE `tbladdpackage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=911;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblnutritionmeeting`
--
ALTER TABLE `tblnutritionmeeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblpackage`
--
ALTER TABLE `tblpackage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblpayment`
--
ALTER TABLE `tblpayment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `water_management`
--
ALTER TABLE `water_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `weight_management`
--
ALTER TABLE `weight_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exercise_management`
--
ALTER TABLE `exercise_management`
  ADD CONSTRAINT `exercise_management_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `tbluser` (`id`);

--
-- Constraints for table `water_management`
--
ALTER TABLE `water_management`
  ADD CONSTRAINT `water_management_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `tbluser` (`id`);

--
-- Constraints for table `weight_management`
--
ALTER TABLE `weight_management`
  ADD CONSTRAINT `weight_management_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `tbluser` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
