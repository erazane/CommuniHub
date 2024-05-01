-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2018 at 09:19 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tahfizcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_ID` int(5) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `phoneno` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `username`, `password`, `email`, `phoneno`) VALUES
(2, 'admin', '12345', 'admin@gmail.com', '019882992');

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `donationid` int(5) NOT NULL,
  `donationname` varchar(50) NOT NULL,
  `donationamount` double NOT NULL,
  `donationstartdate` varchar(50) NOT NULL,
  `donationenddate` varchar(50) NOT NULL,
  `tahfizid` int(5) NOT NULL,
  `userid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventid` int(5) NOT NULL,
  `eventtitle` varchar(50) NOT NULL,
  `eventdescription` varchar(1500) NOT NULL,
  `eventvenue` varchar(100) NOT NULL,
  `eventstartdate` date NOT NULL,
  `eventenddate` date NOT NULL,
  `eventtime` time NOT NULL,
  `image` varchar(1000) NOT NULL,
  `tahfizid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(5) NOT NULL,
  `admin_ID` int(5) DEFAULT NULL,
  `schools_ID` int(5) DEFAULT NULL,
  `parents_ID` int(5) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `admin_ID`, `schools_ID`, `parents_ID`, `email`, `password`, `type`, `status`) VALUES
(1, 2, NULL, NULL, 'admin@gmail.com', '12345', 'admin', NULL),
(15, NULL, NULL, 1001, 'mimobenjol@gmail.com', '12345', 'parent', 'approved'),
(16, NULL, 20001, NULL, 'mutiaratahfiz@gmail.com', '12345', 'tahfiz', 'approved'),
(17, NULL, 20002, NULL, 'setapaktahfiz@gmail.com', '12345', 'tahfiz', 'approved'),
(18, NULL, 20003, NULL, '', '', 'tahfiz', 'approved'),
(19, NULL, 20004, NULL, '', '', 'tahfiz', 'approved'),
(20, NULL, NULL, 1002, '', '', 'parent', 'approved'),
(21, NULL, NULL, 1003, 'syedzaquan@gmail.com', '12345', 'parent', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `parents_ID` int(5) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `age` varchar(15) DEFAULT NULL,
  `phoneno` varchar(10) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `street_name` varchar(500) DEFAULT NULL,
  `state` varchar(500) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `ic_number` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`parents_ID`, `firstname`, `lastname`, `job`, `age`, `phoneno`, `email`, `street_name`, `state`, `city`, `postcode`, `ic_number`, `password`) VALUES
(1001, 'mimo', 'benjol', 'manager di akuarium', '55', '0198829933', 'mimobenjol@gmail.com', 'jalan kampung bharu', 'no 54 Taman wahyu', 'Bandar benjol', '32445', '12345493212', '12345'),
(1002, '', '', '', '', '', '', '', '', '', '', '', ''),
(1003, 'Syed', 'Zaquan', 'Student', '23', '0139901824', 'syedzaquan@gmail.com', 'Jalan Cemur', 'Kuala Lumpur', 'Titiwangsa', '54000', '950113115357', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `schools_ID` int(5) NOT NULL,
  `school_name` varchar(1000) DEFAULT NULL,
  `street_name` varchar(500) DEFAULT NULL,
  `state` varchar(500) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `register_no` varchar(20) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `certificate_school` varchar(1000) DEFAULT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `monthly_fees` varchar(100) DEFAULT NULL,
  `descriptions` varchar(10000) DEFAULT NULL,
  `date_joined` date DEFAULT NULL,
  `school_catID` int(5) DEFAULT NULL,
  `school_url` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`schools_ID`, `school_name`, `street_name`, `state`, `city`, `postcode`, `register_no`, `status`, `certificate_school`, `category_name`, `monthly_fees`, `descriptions`, `date_joined`, `school_catID`, `school_url`, `email`, `password`) VALUES
(20001, 'Sekolah Tahfiz Mutiara', 'jalan kampung bharu', 'no 54 Taman wahyu', 'Bandar benjol', '32445', '65843291', 'approved', NULL, 'secondary', '50', 'nanti la ', '2018-10-28', NULL, 'https://www.facebook.com/422029681658469/videos/242013946472277/', 'mutiaratahfiz@gmail.com', '12345'),
(20002, 'Sekolah tahfiz setapak', 'jalan kampung bharu', 'no 54 Taman wahyu', 'Bandar benjol', '32445', '1234567898765', 'approved', NULL, 'secondary', '50', 'nanti la ', '2018-10-28', NULL, 'setapaktahfiz.my', 'setapaktahfiz@gmail.com', '12345'),
(20003, '', '', '', '', '', '', 'approved', NULL, '', '', '', '2018-10-28', NULL, '', '', ''),
(20004, '', '', '', '', '', '', 'approved', NULL, '', '', '', '2018-10-28', NULL, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `school_category`
--

CREATE TABLE `school_category` (
  `school_catID` int(5) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_category`
--

INSERT INTO `school_category` (`school_catID`, `category_name`) VALUES
(1, 'primary'),
(2, 'secondary');

-- --------------------------------------------------------

--
-- Table structure for table `school_list`
--

CREATE TABLE `school_list` (
  `school_listID` int(5) NOT NULL,
  `school_listname` varchar(500) DEFAULT NULL,
  `school_listfees` varchar(100) DEFAULT NULL,
  `school_liststate` varchar(100) DEFAULT NULL,
  `school_catID` int(5) DEFAULT NULL,
  `school_listcode` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_list`
--

INSERT INTO `school_list` (`school_listID`, `school_listname`, `school_listfees`, `school_liststate`, `school_catID`, `school_listcode`) VALUES
(1, 'PONDOK TURATH BAITUSSAADAH', '50.00', 'SELANGOR', 2, 'BZA8001'),
(2, 'MAAHAD TAHFIZ DHIYA\'UL ISLAH', '100', 'Kuala Lumpur', 1, 'WZH0016');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`donationid`),
  ADD KEY `tahfizid` (`tahfizid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventid`),
  ADD KEY `tahfizid` (`tahfizid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_admin` (`admin_ID`),
  ADD KEY `fk_schools` (`schools_ID`),
  ADD KEY `fk_parents` (`parents_ID`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`parents_ID`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`schools_ID`),
  ADD KEY `fk_schoolcategory` (`school_catID`);

--
-- Indexes for table `school_category`
--
ALTER TABLE `school_category`
  ADD PRIMARY KEY (`school_catID`);

--
-- Indexes for table `school_list`
--
ALTER TABLE `school_list`
  ADD PRIMARY KEY (`school_listID`),
  ADD KEY `fk_schoollistcat` (`school_catID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `donationid` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eventid` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `parents_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;
--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `schools_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20005;
--
-- AUTO_INCREMENT for table `school_category`
--
ALTER TABLE `school_category`
  MODIFY `school_catID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `school_list`
--
ALTER TABLE `school_list`
  MODIFY `school_listID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `fk_admin` FOREIGN KEY (`admin_ID`) REFERENCES `admin` (`admin_ID`),
  ADD CONSTRAINT `fk_parents` FOREIGN KEY (`parents_ID`) REFERENCES `parents` (`parents_ID`),
  ADD CONSTRAINT `fk_schools` FOREIGN KEY (`schools_ID`) REFERENCES `schools` (`schools_ID`);

--
-- Constraints for table `schools`
--
ALTER TABLE `schools`
  ADD CONSTRAINT `fk_schoolcategory` FOREIGN KEY (`school_catID`) REFERENCES `school_category` (`school_catID`);

--
-- Constraints for table `school_list`
--
ALTER TABLE `school_list`
  ADD CONSTRAINT `fk_schoollistcat` FOREIGN KEY (`school_catID`) REFERENCES `school_category` (`school_catID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
