SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `gymdb`


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladdpackage`
--

INSERT INTO `tbladdpackage` (`id`, `category`, `titlename`, `PackageType`, `PackageDuration`, `Price`, `uploadphoto`, `Description`, `create_date`) VALUES 
(1, '1', 'Free Fitness Gear Package', '1', '3 Month', '600', NULL, 'Free Fitness Gear\nComplimentary OnePass', '2022-03-05 02:55:34'),
(2, '1', '3 Months Membership Package', '1', '6 Month', '800', NULL, 'Book Six Days Different Trainers Class designed for fast Weight Loss / Weight Gain with combination of Latest Workouts in addition to complimentary access to gym area with personal training.', '2022-03-05 02:56:44'),
(3, '1', 'Nutritionist Counseling', '2', 'Monthly', '10', NULL, 'Hire a personal nutritionist<div><br></div><div>Receive feedback on diet and possible exercises</div>', '2022-03-05 02:57:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `name`, `email`, `mobile`, `password`, `create_date`) VALUES
(1, 'admin', 'admin@gmail.com', '99197896857', '5c428d8875d2948607f3e3fe134d71b4', '2022-01-19 11:25:17');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`id`, `package_id`, `userid`, `booking_date`, `payment`, `paymentType`) VALUES
(1, '2', '1', '2022-03-05 03:53:21', '800', 'Partial Payment'),
(2, '1', '1', '2022-03-05 03:53:28', '600', 'Partial Payment'),
(3, '2', '5', '2022-03-08 17:44:18', '300', 'Full Payment'),
(6, '1', '5', '2022-05-22 02:16:14', NULL, NULL),
(7, '2', '6', '2022-05-22 02:32:45', NULL, 'Full Payment');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `category_name` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `category_name`, `status`) VALUES
(1, 'Category1', '0'),
(2, 'Category2', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tblpackage`
--

CREATE TABLE `tblpackage` (
  `id` int(11) NOT NULL,
  `cate_id` varchar(45) DEFAULT NULL,
  `PackageName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpayment`
--

INSERT INTO `tblpayment` (`id`, `bookingID`, `paymentType`, `payment`, `payment_date`) VALUES
(1, '8', 'Partial Payment', '350', '2022-06-09 08:15:25'),
(1, '1', 'Partial Payment', '300', '2022-03-05 03:54:10'),
(2, '5', 'Full Payment', '500', '2022-06-09 10:45:30'),
(3, '6', 'Partial Payment', '300', '2022-06-10 11:25:55'),
(4, '8', 'Full Payment', '450', '2022-06-10 14:35:00'),
(4, '1', 'Full Payment', '500', '2022-05-22 01:01:58'),
(5, '9', 'Partial Payment', '250', '2022-06-11 16:15:45'),
(5, '3', 'Partial Payment', '300', '2022-05-22 01:09:53'),
(6, '10', 'Full Payment', '550', '2022-06-11 18:25:30'),
(7, '6', 'Partial Payment', '200', '2022-06-12 09:05:15'),
(8, '3', 'Full Payment', '500', '2022-05-22 01:19:03'),
(9, '7', 'Partial Payment', '500', '2022-05-22 02:40:34'),
(10, '7', 'Full Payment', '400', '2022-06-12 12:15:40'),
(10, '7', 'Full Payment', '300', '2022-05-22 02:41:14');


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `fname`, `lname`, `email`, `mobile`, `password`, `state`, `city`, `address`, `create_date`) VALUES
(1, 'Amir', 'Aziz', 'amir.aziz@example.com', '60123456789', 'f925916e2754e5e03f75dd58a5733251', 'Selangor', 'Shah Alam', 'No. 10, Jalan Anggerik', '2023-01-10 09:15:30'),
(2, 'Nurul', 'Huda', 'nurul.huda@example.com', '60129876543', '202cb962ac59075b964b07152d234b70', 'Johor', 'Johor Bahru', 'No. 15, Jalan Mawar', '2023-02-12 14:22:18'),
(3, 'Farid', 'Rashid', 'farid.rashid@example.com', '60138765432', 'e10adc3949ba59abbe56e057f20f883e', 'Penang', 'George Town', 'No. 20, Jalan Dato Keramat', '2023-03-08 11:50:47'),
(4, 'Aisyah', 'Zain', 'aisyah.zain@example.com', '60147654321', 'f925916e2754e5e03f75dd58a5733251', 'Perak', 'Ipoh', 'No. 25, Jalan Raja Musa', '2023-04-18 16:35:20'),
(5, 'Zul', 'Rahman', 'zul.rahman@example.com', '60159876543', '202cb962ac59075b964b07152d234b70', 'Kuala Lumpur', 'Kuala Lumpur', 'No. 30, Jalan Tun Razak', '2023-05-22 13:47:52'),
(6, 'Sara', 'Smith', 'sara.smith@example.com', '1234567891', 'f925916e2754e5e03f75dd58a5733251', 'California', 'Los Angeles', '1234 Sunset Blvd', '2023-01-05 12:34:56'),
(7, 'Mike', 'Johnson', 'mike.johnson@example.com', '9876543210', '202cb962ac59075b964b07152d234b70', 'Texas', 'Austin', '5678 River Rd', '2023-02-10 09:45:23'),
(8, 'Emma', 'Williams', 'emma.williams@example.com', '5647382910', 'e10adc3949ba59abbe56e057f20f883e', 'Florida', 'Miami', '9101 Beach Ave', '2023-03-15 14:56:34'),
(9, 'David', 'Brown', 'david.brown@example.com', '1029384756', 'f925916e2754e5e03f75dd58a5733251', 'New York', 'Brooklyn', '1122 Flatbush Ave', '2023-04-20 08:23:10'),
(10, 'Olivia', 'Jones', 'olivia.jones@example.com', '7485961320', '202cb962ac59075b964b07152d234b70', 'Ohio', 'Columbus', '3344 Maple Dr', '2023-05-25 15:45:19');



CREATE TABLE `tblnutritionmeeting` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `gender` VARCHAR(10) NOT NULL,
  `date` DATE NOT NULL,
  `specifications` TEXT NOT NULL,
  `submission_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `tblnutritionmeeting` (`id`, `name`, `gender`, `date`, `specifications`)
VALUES 
(1, 'Alice Johnson', 'Female', '2024-10-30', 'Perform check up'),
(2, 'Bob Smith', 'Male', '2024-11-01', 'Get advice'),
(3, 'Charlie Brown', 'Male', '2024-11-02', 'Change plan'),
(4, 'Diana Prince', 'Female', '2024-11-03', 'Perform check up'),
(5, 'Eve Adams', 'Female', '2024-11-04', 'Get advice'),
(6, 'Frank Castle', 'Male', '2024-11-05', 'Change plan'),
(7, 'Grace Lee', 'Female', '2024-11-06', 'Perform check up');



CREATE TABLE `body_weight` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `weight_kg` DECIMAL(5, 2) NOT NULL,
  `recorded_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `notes` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `tbluser`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `body_weight` (`id`, `user_id`, `weight_kg`, `recorded_date`, `notes`) VALUES
(1, 1, 55.00, '2024-01-15 08:30:00', 'Underweight'),
(2, 2, 68.50, '2024-02-20 09:00:00', 'Normal'),
(3, 3, 72.00, '2024-03-05 10:00:00', 'Normal'),
(4, 4, 80.30, '2024-04-10 11:15:00', 'Normal'),
(5, 5, 65.40, '2024-05-18 14:00:00', 'Normal'),
(6, 6, 90.00, '2024-06-25 16:45:00', 'Overweight'),
(7, 7, 105.50, '2024-07-30 12:30:00', 'Overweight'),
(8, 8, 59.90, '2024-08-12 08:00:00', 'Underweight'),
(9, 9, 62.00, '2024-09-15 09:30:00', 'Normal'),
(10, 10, 110.00, '2024-10-01 10:15:00', 'Overweight');



CREATE TABLE `exercise_routines` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `exercise_name` VARCHAR(255) NOT NULL,
  `duration` INT(11) NOT NULL,
  `date` DATE NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `tbluser`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `exercise_routines` (`id`, `user_id`, `exercise_name`, `duration`, `date`) VALUES
(1, 1, 'Jogging', 30, '2024-01-15'),
(2, 2, 'Push-Ups', 15, '2024-02-20'),
(3, 3, 'Sit-Ups', 20, '2024-03-05'),
(4, 4, 'Advanced Calisthenics', 45, '2024-04-10'),
(5, 5, 'Yoga', 60, '2024-05-18');




CREATE TABLE `water_consumption` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `amount` INT(11) NOT NULL,
  `date` DATE NOT NULL,
  `time` TIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `water_consumption` (`id`, `amount`, `date`, `time`) VALUES
(1, 500, '2024-01-05', '08:30:00'),
(2, 750, '2024-01-06', '10:15:00'),
(3, 300, '2024-01-07', '12:00:00'),
(4, 600, '2024-01-08', '14:45:00'),
(5, 400, '2024-01-09', '09:30:00'),
(6, 800, '2024-01-10', '17:00:00'),
(7, 350, '2024-01-11', '07:00:00'),
(8, 900, '2024-01-12', '11:00:00'),
(9, 550, '2024-01-13', '15:30:00'),
(10, 1000, '2024-01-14', '18:00:00');



--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladdpackage`
--
ALTER TABLE `tbladdpackage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblpackage`
--
ALTER TABLE `tblpackage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblpayment`
--
ALTER TABLE `tblpayment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

ALTER TABLE `tbluser` 
ADD COLUMN `gender` VARCHAR(10) DEFAULT NULL,
ADD COLUMN `date` DATE DEFAULT NULL,
ADD COLUMN `specifications` TEXT DEFAULT NULL;
