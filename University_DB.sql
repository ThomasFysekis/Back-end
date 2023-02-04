-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 04, 2023 at 02:19 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `University_DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Announcements`
--

CREATE TABLE `Announcements` (
  `Number` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Subject` varchar(1000) NOT NULL,
  `MainText` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Announcements`
--

INSERT INTO `Announcements` (`Number`, `Date`, `Subject`, `MainText`) VALUES
(1, '2311-12-31', '123', '123123123123'),
(2, '2022-12-08', 'Ανακοίνωση εργασίας', 'Η 1η εργασία έχει ανακοινωθεί στην ιστοσελίδα Εργασίες.'),
(3, '2022-12-08', 'Ακύρωση μαθήματος', 'Το επόμενο μαθήμα δεν θα πραγματοποιηθεί.');

-- --------------------------------------------------------

--
-- Table structure for table `Documents`
--

CREATE TABLE `Documents` (
  `Number` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `FileLocation` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Documents`
--

INSERT INTO `Documents` (`Number`, `Title`, `Description`, `FileLocation`) VALUES
(12, '1', '1', 0x6f6b6179),
(312, '312', '312', 0x75706c6f61642f53637265656e73686f742066726f6d20323032322d30392d31392032322d31322d30312e706e67),
(1234, '1234', '1234', 0x75706c6f61642f32303232303431385f3233333432372e6a7067),
(123123123, '123', '123', 0x75706c6f61642f323031372d31382d455247415349415f7061727441312d48544d4c2e646f63);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `Role` varchar(30) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Lastname` varchar(30) NOT NULL,
  `Loginname` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`Role`, `Name`, `Lastname`, `Loginname`, `Password`) VALUES
('Student', 'idk', 'idk', 'idk', 'idk'),
('Student', 'thomas', 'dekserq', 'kepo@gmail.com', '123'),
('Student', 'Mixalis', 'lastname', 'mixalis@gmail.com', '123123123'),
('Student', 'Stergios', 'Moumtzis', 'stergios@gmail.com', '123123'),
('Tutor', 'Thomas', 'Fysekis', 'thwmas321@gmail.com', '321321');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Announcements`
--
ALTER TABLE `Announcements`
  ADD PRIMARY KEY (`Number`);

--
-- Indexes for table `Documents`
--
ALTER TABLE `Documents`
  ADD PRIMARY KEY (`Number`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`Loginname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Announcements`
--
ALTER TABLE `Announcements`
  MODIFY `Number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12347;

--
-- AUTO_INCREMENT for table `Documents`
--
ALTER TABLE `Documents`
  MODIFY `Number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123123124;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
