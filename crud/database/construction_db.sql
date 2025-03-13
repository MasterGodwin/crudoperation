-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2025 at 07:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `construction_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `engineering_drawings`
--

CREATE TABLE `engineering_drawings` (
  `id` int(11) NOT NULL,
  `project_id` varchar(20) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `planned_by` varchar(100) DEFAULT NULL,
  `planned_date` date DEFAULT NULL,
  `diagram_no` varchar(100) DEFAULT NULL,
  `revision_no` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `engineering_drawings`
--

INSERT INTO `engineering_drawings` (`id`, `project_id`, `image_path`, `planned_by`, `planned_date`, `diagram_no`, `revision_no`) VALUES
(5, 'PRJ-1741844627', 'uploads/1741844627_WIN_20241221_19_32_03_Pro.jpg', 'dsaf', '2025-03-13', '232', '23'),
(6, 'PRJ-1741845203', 'uploads/1741845203_EditProject Management (12.png', 'kjhgjh', '2025-03-13', '786', '98789');

-- --------------------------------------------------------

--
-- Table structure for table `plots`
--

CREATE TABLE `plots` (
  `id` int(11) NOT NULL,
  `project_id` varchar(20) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `plot_id` varchar(50) DEFAULT NULL,
  `plot_name` varchar(100) DEFAULT NULL,
  `pile_type` varchar(100) DEFAULT NULL,
  `pile_length` varchar(100) DEFAULT NULL,
  `pile_status` varchar(100) DEFAULT NULL,
  `assigned_worker` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plots`
--

INSERT INTO `plots` (`id`, `project_id`, `image_path`, `plot_id`, `plot_name`, `pile_type`, `pile_length`, `pile_status`, `assigned_worker`) VALUES
(6, 'PRJ-1741844627', 'uploads/1741844627_2.png', '1231', 'dsfa', 'dfas', 'dsfa', 'dsf', 'dfs'),
(7, 'PRJ-1741845203', 'uploads/1741845203_EditProject Management (1).png', '331', 'dfsa', 'T', '24', 'Completed', 'Assigned'),
(8, 'PRJ-1741845203', 'uploads/EditProject Management (12.png', '2432', 'dfa', 'y', '33', 'Ongoing', 'Assigned');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `project_id` varchar(20) NOT NULL,
  `contract_no` varchar(50) DEFAULT NULL,
  `tender_no` varchar(50) DEFAULT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `assigned_team` varchar(255) DEFAULT NULL,
  `current_status` varchar(255) DEFAULT NULL,
  `project_duration` varchar(50) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_id` varchar(50) DEFAULT NULL,
  `pile_type` varchar(100) DEFAULT NULL,
  `no_of_piles` int(11) DEFAULT NULL,
  `pile_designed_length` varchar(50) DEFAULT NULL,
  `expected_pile_installation_rate` varchar(50) DEFAULT NULL,
  `penetration_record` varchar(255) DEFAULT NULL,
  `rig_details` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `rig_length` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `restrike_percentage` varchar(20) DEFAULT NULL,
  `days_piling` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_id`, `contract_no`, `tender_no`, `project_name`, `assigned_team`, `current_status`, `project_duration`, `client_name`, `client_id`, `pile_type`, `no_of_piles`, `pile_designed_length`, `expected_pile_installation_rate`, `penetration_record`, `rig_details`, `address`, `rig_length`, `start_date`, `end_date`, `restrike_percentage`, `days_piling`) VALUES
(3, 'PRJ-1741844627', '3989', '879', 'fdakljl', 'Team B', 'Ongoing', 'dslfj', 'sadkfjl', '8798', 'Type C', 8798, '0890', '98798', 'sdfaklj', 'dfjl', 'sjafllk', '9879', '2025-03-11', '2025-03-20', '7687', '8997'),
(4, 'PRJ-1741845203', '3989', '879', 'fdakljl', 'Team B', 'Completed', 'dslfj', 'sadkfjl', '8798', 'Type C', 8798, '0890', '98798', 'sdfaklj', 'dfjl', 'sjafllk', '9879', '2025-03-11', '2025-03-20', '768723', '8997');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `engineering_drawings`
--
ALTER TABLE `engineering_drawings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `plots`
--
ALTER TABLE `plots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `project_id` (`project_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `engineering_drawings`
--
ALTER TABLE `engineering_drawings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `plots`
--
ALTER TABLE `plots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `engineering_drawings`
--
ALTER TABLE `engineering_drawings`
  ADD CONSTRAINT `engineering_drawings_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`);

--
-- Constraints for table `plots`
--
ALTER TABLE `plots`
  ADD CONSTRAINT `plots_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
