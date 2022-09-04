-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2022 at 07:58 PM
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
(1, 'Manager Budget'),
(2, 'Manager Leader');

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `budgetId` int(11) NOT NULL,
  `projectId` int(11) NOT NULL,
  `projectQuotationId` int(11) NOT NULL,
  `orderNo` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `budget` double NOT NULL,
  `createdAt` datetime NOT NULL,
  `lastUpdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Client Test', 'Description Test'),
(3, 'Client Test 2', 'Desc 2');

-- --------------------------------------------------------

--
-- Table structure for table `distribution_cost`
--

CREATE TABLE `distribution_cost` (
  `distributionCostId` int(11) NOT NULL,
  `proposedCostId` int(11) NOT NULL,
  `holder` int(11) NOT NULL,
  `value` double NOT NULL,
  `distributionDate` date NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `groupId` int(11) NOT NULL,
  `groupName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`groupId`, `groupName`) VALUES
(1, 'GROUP 1'),
(2, 'GROUP 2');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `notesId` int(11) NOT NULL,
  `notesType` varchar(50) NOT NULL,
  `timestamp` datetime NOT NULL,
  `userId` int(11) NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `projectId` int(11) NOT NULL,
  `generateId` varchar(10) NOT NULL,
  `groupId` int(11) NOT NULL,
  `projectGroupId` int(11) DEFAULT NULL,
  `projectName` varchar(100) NOT NULL,
  `clientId` int(11) NOT NULL,
  `description` text NOT NULL,
  `value` varchar(100) NOT NULL,
  `isFinal` int(11) NOT NULL,
  `isAddWork` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`projectId`, `generateId`, `groupId`, `projectGroupId`, `projectName`, `clientId`, `description`, `value`, `isFinal`, `isAddWork`) VALUES
(1, '2209001', 1, 1, 'Project Test', 1, 'Desc Test', '2000000', 1, 0),
(4, '2209002', 2, NULL, 'Project Test 2', 3, 'Desc', '5000000', 0, 0);

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
(1, 'Group Test', 'Desc'),
(2, 'Group Test 2', 'Desc Test');

-- --------------------------------------------------------

--
-- Table structure for table `project_quotation`
--

CREATE TABLE `project_quotation` (
  `projectQuotationId` int(11) NOT NULL,
  `projectId` int(11) NOT NULL,
  `quotationHeaderId` int(11) DEFAULT NULL,
  `orderNo` varchar(100) NOT NULL,
  `projectQuotationName` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `quoteValue` double NOT NULL,
  `estCost` double NOT NULL,
  `detailDescription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `proposed_cost`
--

CREATE TABLE `proposed_cost` (
  `proposedCostId` int(11) NOT NULL,
  `proposedCostName` varchar(100) NOT NULL,
  `proposedDate` date NOT NULL,
  `proposedBy` int(11) NOT NULL,
  `proposedValue` double NOT NULL,
  `approvedBy` int(11) NOT NULL,
  `approvedValue` double NOT NULL,
  `approcedDate` date NOT NULL,
  `processedDate` date NOT NULL,
  `processedValue` double NOT NULL,
  `detailDescription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_header`
--

CREATE TABLE `quotation_header` (
  `quotationHeaderId` int(11) NOT NULL,
  `orderNo` varchar(100) NOT NULL,
  `pdName` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `real_budget`
--

CREATE TABLE `real_budget` (
  `readlBudgetId` int(11) NOT NULL,
  `distributionCostid` int(11) NOT NULL,
  `budgetId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `description` text NOT NULL,
  `realBudgetValue` double NOT NULL,
  `reportDate` date NOT NULL,
  `reportBy` int(11) NOT NULL,
  `detailDescription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report_budget`
--

CREATE TABLE `report_budget` (
  `reportBudgetId` int(11) NOT NULL,
  `realBudgetId` int(11) NOT NULL,
  `description` text NOT NULL,
  `reportBudgetValue` double NOT NULL,
  `reportBy` int(11) NOT NULL,
  `fileName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(4, 'a', 'a@a.c', '$2y$10$3QLNv1eUz/4gI.aAjEhpbecllqf.yRfJgqgcf06j0prR8gBQic6pK');

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
(6, 1, 4),
(8, 1, 1),
(9, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `userGroupId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`userGroupId`, `groupId`, `userId`) VALUES
(6, 1, 4),
(8, 1, 1),
(9, 2, 1);

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
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`groupId`);

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
-- Indexes for table `project_quotation`
--
ALTER TABLE `project_quotation`
  ADD PRIMARY KEY (`projectQuotationId`);

--
-- Indexes for table `proposed_cost`
--
ALTER TABLE `proposed_cost`
  ADD PRIMARY KEY (`proposedCostId`);

--
-- Indexes for table `quotation_header`
--
ALTER TABLE `quotation_header`
  ADD PRIMARY KEY (`quotationHeaderId`);

--
-- Indexes for table `real_budget`
--
ALTER TABLE `real_budget`
  ADD PRIMARY KEY (`readlBudgetId`);

--
-- Indexes for table `report_budget`
--
ALTER TABLE `report_budget`
  ADD PRIMARY KEY (`reportBudgetId`);

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
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`userGroupId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_right`
--
ALTER TABLE `access_right`
  MODIFY `accessRightId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `budgetId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `clientId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `distribution_cost`
--
ALTER TABLE `distribution_cost`
  MODIFY `distributionCostId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `notesId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `projectId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `project_group`
--
ALTER TABLE `project_group`
  MODIFY `projectGroupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_quotation`
--
ALTER TABLE `project_quotation`
  MODIFY `projectQuotationId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proposed_cost`
--
ALTER TABLE `proposed_cost`
  MODIFY `proposedCostId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_header`
--
ALTER TABLE `quotation_header`
  MODIFY `quotationHeaderId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `real_budget`
--
ALTER TABLE `real_budget`
  MODIFY `readlBudgetId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_budget`
--
ALTER TABLE `report_budget`
  MODIFY `reportBudgetId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_access`
--
ALTER TABLE `user_access`
  MODIFY `userAccessId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `userGroupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
