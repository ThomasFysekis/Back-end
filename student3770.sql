-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 08, 2023 at 11:51 PM
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
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `Number` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Subject` varchar(1000) NOT NULL,
  `MainText` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`Number`, `Date`, `Subject`, `MainText`) VALUES
(1, '2022-10-08', 'Έναρξη μαθημάτων', 'Τα μαθήματα αρχίζουν την Δευτέρα 17/08/2022'),
(3, '2022-12-08', 'Ακύρωση μαθήματος', 'Το επόμενο μαθήμα δεν θα πραγματοποιηθεί.'),
(4, '2022-08-25', 'Εργασία bonus', 'Έχει αναρτηθεί στην ιστοσελίδα Εργασίες μια άσκηση bonus με άριστα το 10% της τελικής βαθμολογίας.');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `Number` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `FileLocation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`Number`, `Title`, `Description`, `FileLocation`) VALUES
(1, 'Αλγόρυθμοι τυφλής αναζήτησης:', 'Στον παρακάτω σύνδεσμο μπορείτε να κατεβάσετε τις διαφάνειες για τους αλγόριθμους BFS,DFS και ID.', './uploads/file1.doc'),
(2, 'Αλγόρυθμοι ευρετικής αναζήτησης:', 'Στον παρακάτω σύνδεσμο μπορείτε να κατεβάσετε τις διαφάνειες για τους αλγόριθμους ευρετικής αναζήτησης.', './uploads/file2.doc');

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `Number` int(11) NOT NULL,
  `Goal` varchar(225) NOT NULL,
  `Subject` varchar(225) NOT NULL,
  `Delivered` varchar(225) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homework`
--

INSERT INTO `homework` (`Number`, `Goal`, `Subject`, `Delivered`, `Date`) VALUES
(1, 'Εξάσκηση στον αλγόριθμοBFS,Εξάσκηση στον αλγόριθμο DFS,Εξάσκηση στον αλγόριθμο ID', './uploads/ergasia1.doc', 'Γραπτή αναφορά σε word,Παρουσίαση σε powerpoint', '2022-09-01'),
(2, 'Εξάσκηση στις γνώσεις που λάβατε,η εργασία είναι bonus', './uploads/ergasia2.doc', 'Γραπτή αναφορά σε word,Παρουσίαση σε powerpoint', '2022-10-01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Role` varchar(30) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Lastname` varchar(30) NOT NULL,
  `Loginname` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Role`, `Name`, `Lastname`, `Loginname`, `Password`) VALUES
('Student', 'Stergios', 'Moumtzis', 'stergios@gmail.com', '123123'),
('Tutor', 'tommy', 'fys', 'thwmas1234@hotmail.gr', '123'),
('Tutor', 'Θωμάς', 'Φυσέκης', 'thwmas321@gmail.com', '321321');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`Number`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`Number`);

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`Number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Loginname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `Number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12347;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `Number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123123124;

--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `Number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123124;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;