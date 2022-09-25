-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2022 at 05:26 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mtj_budgeting`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_right`
--

CREATE TABLE `access_right` (
  `accessRightId` int(11) NOT NULL,
  `accessName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_right`
--

INSERT INTO `access_right` (`accessRightId`, `accessName`) VALUES
(1, 'Administrator'),
(2, 'Project Manager'),
(3, 'Finance'),
(4, 'Pengawas Lapangan');

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `budgetId` int(11) NOT NULL,
  `projectId` int(11) NOT NULL,
  `orderNo` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `budget` double NOT NULL,
  `createdAt` datetime NOT NULL,
  `lastUpdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `approved` varchar(20) NOT NULL,
  `approvedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`budgetId`, `projectId`, `orderNo`, `description`, `budget`, `createdAt`, `lastUpdate`, `approved`, `approvedBy`) VALUES
(4, 8, '12345', 'Initial Budgett', 100000000, '2022-09-18 23:45:29', '2022-09-19 01:36:18', 'APPROVED', 1),
(6, 8, '123', 'Kurang', 30000000, '2022-09-19 00:35:17', '2022-09-19 00:42:44', 'APPROVED', 1),
(7, 9, '12345', 'Budget Material', 50000000, '2022-09-19 02:05:25', '2022-09-24 00:11:37', 'APPROVED', 8),
(8, 10, '123', 'Initial Budget', 120000000, '2022-09-19 02:05:27', '2022-09-19 02:05:59', 'APPROVED', 8),
(9, 10, '121345', 'Kurang', 50000000, '2022-09-19 02:06:12', '2022-09-19 02:06:44', 'APPROVED', 8),
(10, 9, '12345567', 'Budget Konsumsi', 20000000, '2022-09-24 00:11:59', '2022-09-24 00:12:49', 'APPROVED', 1),
(11, 9, '12334567', 'Budget Operasional', 30000000, '2022-09-24 00:12:27', '2022-09-24 00:12:52', 'APPROVED', 1);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `clientId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`clientId`, `name`, `description`) VALUES
(4, 'Client Test 1', 'Desc Test'),
(5, 'Client Test 2', 'Desc TEst');

-- --------------------------------------------------------

--
-- Table structure for table `distribution_cost`
--

CREATE TABLE `distribution_cost` (
  `distributionCostId` int(11) NOT NULL,
  `projectId` int(11) NOT NULL,
  `proposedCostId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `holder` int(11) NOT NULL,
  `value` double NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distribution_cost`
--

INSERT INTO `distribution_cost` (`distributionCostId`, `projectId`, `proposedCostId`, `userId`, `holder`, `value`, `description`) VALUES
(7, 10, 5, 8, 4, 5000000, 'Test Desc'),
(9, 9, 6, 1, 4, 10000000, 'desc');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `notesId` int(11) NOT NULL,
  `projectId` int(11) NOT NULL,
  `notesType` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userId` int(11) NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `projectId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `generateId` varchar(10) NOT NULL,
  `projectGroupId` int(11) DEFAULT NULL,
  `projectName` varchar(100) NOT NULL,
  `clientId` int(11) NOT NULL,
  `description` text NOT NULL,
  `value` varchar(100) NOT NULL,
  `approved` varchar(10) NOT NULL,
  `approvedBy` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`projectId`, `userId`, `generateId`, `projectGroupId`, `projectName`, `clientId`, `description`, `value`, `approved`, `approvedBy`, `status`) VALUES
(8, 1, '2209006', 3, 'TEST NEW PROJECT EDIT', 5, 'DESC TEST EDIT', '130000000', 'APPROVED', 1, 'ON GOING'),
(9, 1, '2209002', NULL, 'TEST', 4, 'TEST', '50000000', 'APPROVED', 8, 'PENDING'),
(10, 6, '2209003', NULL, 'Test project pm 1', 4, 'test desc', '170000000', 'APPROVED', 8, 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `project_group`
--

CREATE TABLE `project_group` (
  `projectGroupId` int(11) NOT NULL,
  `projectGroupName` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_group`
--

INSERT INTO `project_group` (`projectGroupId`, `projectGroupName`, `description`) VALUES
(3, 'Group Project 1', 'Desc Group Project 1');

-- --------------------------------------------------------

--
-- Table structure for table `proposed_cost`
--

CREATE TABLE `proposed_cost` (
  `proposedCostId` int(11) NOT NULL,
  `projectId` int(11) NOT NULL,
  `proposedCostName` varchar(100) NOT NULL,
  `proposedDate` date NOT NULL,
  `proposedBy` int(11) NOT NULL,
  `proposedValue` double NOT NULL,
  `detailDescription` text NOT NULL,
  `approved` varchar(15) NOT NULL,
  `approvedDate` date DEFAULT NULL,
  `approvedBy` int(11) DEFAULT NULL,
  `approvedValue` double DEFAULT NULL,
  `approvedDescription` text,
  `rejectedDate` date DEFAULT NULL,
  `rejectedBy` int(11) DEFAULT NULL,
  `rejectedDescription` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proposed_cost`
--

INSERT INTO `proposed_cost` (`proposedCostId`, `projectId`, `proposedCostName`, `proposedDate`, `proposedBy`, `proposedValue`, `detailDescription`, `approved`, `approvedDate`, `approvedBy`, `approvedValue`, `approvedDescription`, `rejectedDate`, `rejectedBy`, `rejectedDescription`) VALUES
(3, 8, 'PROPOSED COST NAME TEST', '2022-09-19', 1, 10000000, 'buat a b c', 'APPROVED', '2022-09-19', 1, 10000000, 'Jangan Boros', NULL, NULL, NULL),
(4, 8, 'TEST 1', '2022-09-19', 1, 20000000, 'TEST', 'REJECTED', '2022-09-19', 1, 20000000, 'TEST', '2022-09-19', 1, 'Gak ada budget'),
(5, 10, 'Test Waspang 1', '2022-09-19', 4, 10000000, 'Test Desc', 'APPROVED', '2022-09-19', 6, 10000000, 'Boros', NULL, NULL, NULL),
(6, 9, 'Beli Material dan Transportasi', '2022-09-24', 1, 10000000, '- a\r\n- b\r\n- c', 'APPROVED', '2022-09-24', 1, 10000000, 'Sok', NULL, NULL, NULL),
(7, 9, 'TEST PROPOSED COST', '2022-09-25', 1, 5000000, 'DESC', 'PENDING', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `report_cost`
--

CREATE TABLE `report_cost` (
  `reportCostId` int(11) NOT NULL,
  `distributionCostId` int(11) NOT NULL,
  `budgetId` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `reportCostValue` double NOT NULL,
  `fileName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report_cost`
--

INSERT INTO `report_cost` (`reportCostId`, `distributionCostId`, `budgetId`, `description`, `reportCostValue`, `fileName`) VALUES
(1, 9, 7, 'Beli Semen', 1000000, 'aj1.png'),
(2, 9, 7, 'Beli Pasir', 2000000, 'aj_(2)1.jpeg'),
(3, 9, 10, 'Beli Makan', 2000000, '2798326-middle.png'),
(5, 9, 11, 'Desc', 5000000, '2798326-middle1.png');

-- --------------------------------------------------------

--
-- Table structure for table `team_member`
--

CREATE TABLE `team_member` (
  `teamMemberId` int(11) NOT NULL,
  `projectId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team_member`
--

INSERT INTO `team_member` (`teamMemberId`, `projectId`, `userId`) VALUES
(8, 9, 4),
(10, 10, 4),
(11, 8, 4),
(12, 8, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPassword` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userName`, `userEmail`, `userPassword`) VALUES
(1, 'Administrator', 'admin@email.com', '$2y$10$5VifqomOAsoe39zJDc/GJefzvAwOmvdqMbDeNjocX0piQd5KDOKbS'),
(4, 'Waspang 1', 'waspang1@email.com', '$2y$10$5VifqomOAsoe39zJDc/GJefzvAwOmvdqMbDeNjocX0piQd5KDOKbS'),
(5, 'Waspang 2', 'waspang2@email.com', '$2y$10$QkO/ZmvdkMaGRDlQrAuw8eeF4q6.86qNMO67aI61Tw7GBkb73Rt1.'),
(6, 'PM 1', 'pm1@email.com', '$2y$10$5nSS8/6mUJ0s2gISu0Ev8ORZhAfPzxGyaxZK2EWSpKYphM5JIOpWe'),
(7, 'PM 2', 'pm2@email.com', '$2y$10$XBt6ip9Qd9VEkJcbxXzRAO91KUi51kEPyqF6ode777ZOrJKQR2KYy'),
(8, 'Finance', 'finance@email.com', '$2y$10$i0zRjb1oxP355/LBFQk1L.jUazFig14sWobnTiBNH78qa.hecpEuC');

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE `user_access` (
  `userAccessId` int(11) NOT NULL,
  `accessRightId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access`
--

INSERT INTO `user_access` (`userAccessId`, `accessRightId`, `userId`) VALUES
(13, 1, 1),
(14, 2, 1),
(15, 3, 1),
(16, 4, 1),
(18, 4, 4),
(22, 2, 7),
(24, 3, 8),
(27, 4, 5),
(28, 2, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_right`
--
ALTER TABLE `access_right`
  ADD PRIMARY KEY (`accessRightId`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`budgetId`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `distribution_cost`
--
ALTER TABLE `distribution_cost`
  ADD PRIMARY KEY (`distributionCostId`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`notesId`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`projectId`);

--
-- Indexes for table `project_group`
--
ALTER TABLE `project_group`
  ADD PRIMARY KEY (`projectGroupId`);

--
-- Indexes for table `proposed_cost`
--
ALTER TABLE `proposed_cost`
  ADD PRIMARY KEY (`proposedCostId`);

--
-- Indexes for table `report_cost`
--
ALTER TABLE `report_cost`
  ADD PRIMARY KEY (`reportCostId`);

--
-- Indexes for table `team_member`
--
ALTER TABLE `team_member`
  ADD PRIMARY KEY (`teamMemberId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`userAccessId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_right`
--
ALTER TABLE `access_right`
  MODIFY `accessRightId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `budgetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `clientId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `distribution_cost`
--
ALTER TABLE `distribution_cost`
  MODIFY `distributionCostId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `notesId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `projectId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `project_group`
--
ALTER TABLE `project_group`
  MODIFY `projectGroupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proposed_cost`
--
ALTER TABLE `proposed_cost`
  MODIFY `proposedCostId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `report_cost`
--
ALTER TABLE `report_cost`
  MODIFY `reportCostId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `team_member`
--
ALTER TABLE `team_member`
  MODIFY `teamMemberId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_access`
--
ALTER TABLE `user_access`
  MODIFY `userAccessId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
