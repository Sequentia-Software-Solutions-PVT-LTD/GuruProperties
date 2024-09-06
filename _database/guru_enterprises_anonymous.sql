-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2024 at 12:27 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guru_enterprises`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `login_name` varchar(250) NOT NULL,
  `login_id` varchar(20) NOT NULL DEFAULT '',
  `login_password` varchar(60) NOT NULL DEFAULT '',
  `login_role` varchar(20) DEFAULT NULL,
  `type` varchar(250) DEFAULT NULL,
  `login_photo` varchar(200) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `login_name`, `login_id`, `login_password`, `login_role`, `type`, `login_photo`, `status`) VALUES
(1, 'Administrator', 'admin', '$2y$10$62GOdcttnKe4ewxhR3YfiOHb1RK9DScRZgRtC8tf8rTJQnL1rgZK.', 'ADMIN', 'ADMIN', 'default.png', 'Active'),
(2, 'superadmin', 'superadmin', '$2y$10$62GOdcttnKe4ewxhR3YfiOHb1RK9DScRZgRtC8tf8rTJQnL1rgZK.', 'ADMIN', 'SUPERADMIN', 'default.png', 'Active'),
(40, 'amol', 'amol', '$2y$10$lXYWzJnqeEVgv6BY90LCDe5hCCCF3Ge8m8eFb9JweVckp8hY2JkZa', 'CUSTOMER EXECUTIVE', 'CUSTOMER EXECUTIVE', 'default.png', 'Active'),
(41, 'gayatri kate 11', 'gayatri', '$2y$10$lXYWzJnqeEVgv6BY90LCDe5hCCCF3Ge8m8eFb9JweVckp8hY2JkZa', 'SALES EXECUTIVE', 'SALES EXECUTIVE', 'default.png', 'Active'),
(42, 'mayuri', 'CE-mayuri', '$2y$10$jv9cSkYzY.Ku3If1rCAFZucpXlaAsyZeCHdVWxOI/fzcoRQ6o/Obe', 'CUSTOMER EXECUTIVE', 'CUSTOMER EXECUTIVE', 'default.png', 'Active'),
(43, 'megha', 'SE-megha', '$2y$10$hho1Dyc3.eR.n2g/acrYEuK/zibMM1hSyIm7qqZpvtzf9FtrHAvFi', 'SALES EXECUTIVE', 'SALES EXECUTIVE', 'default.png', 'Active'),
(44, 'pooja', 'SE-pooja', '$2y$10$MwrW090p.qd5QDDcUNM8yuY73dI65H86YZwoIoCWi5diOQtQYDpse', 'SALES EXECUTIVE', 'SALES EXECUTIVE', 'default.png', 'Active'),
(45, 'sara', 'CE-sara', '$2y$10$ADI5RKEUu6S4zlbrEIAOEeTUcszIAfX1pPFd1yOKKGV.auDBN9amq', 'CUSTOMER EXECUTIVE', 'CUSTOMER EXECUTIVE', 'default.png', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `assign_leads`
--

CREATE TABLE `assign_leads` (
  `assign_leads_id` int(10) NOT NULL,
  `leads_id` int(10) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `employee_name` varchar(250) NOT NULL,
  `assign_employee_type` varchar(250) DEFAULT NULL,
  `notes` text NOT NULL,
  `remark` text NOT NULL,
  `next_date` date NOT NULL,
  `next_time` time DEFAULT NULL,
  `mark_dead` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `connection_status` varchar(250) DEFAULT NULL,
  `lead_type` varchar(250) DEFAULT NULL,
  `dead_reason` text DEFAULT NULL,
  `transfer_status` varchar(250) DEFAULT NULL,
  `transfer_employee_id` int(10) DEFAULT NULL,
  `transfer_employee_type` varchar(250) DEFAULT NULL,
  `transfer_reason` varchar(250) DEFAULT NULL,
  `lead_date` date DEFAULT NULL,
  `edited_on` datetime DEFAULT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign_leads`
--

INSERT INTO `assign_leads` (`assign_leads_id`, `leads_id`, `admin_id`, `employee_id`, `employee_name`, `assign_employee_type`, `notes`, `remark`, `next_date`, `next_time`, `mark_dead`, `status`, `connection_status`, `lead_type`, `dead_reason`, `transfer_status`, `transfer_employee_id`, `transfer_employee_type`, `transfer_reason`, `lead_date`, `edited_on`, `added_on`) VALUES
(5, 1, 40, 10, 'amol', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', 15, 'CUSTOMER EXECUTIVE', 'amol transfer from emp-amol to sara', '2024-08-22', '2024-08-22 12:30:38', '2024-08-22 11:17:15'),
(6, 2, 40, 10, 'amol', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', 15, 'CUSTOMER EXECUTIVE', 'lead niranjan transfer to sara bye empamol', '2024-08-22', '2024-08-22 12:41:13', '2024-08-22 11:17:15'),
(7, 3, 40, 10, 'amol', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-22', NULL, '2024-08-22 11:17:15'),
(8, 4, 45, 15, 'sara', NULL, 'connected view for next followup', '', '2024-08-23', '12:12:00', '', 'Followup', 'connected', 'hot', NULL, NULL, NULL, NULL, NULL, '2024-08-22', NULL, '2024-08-22 12:12:34'),
(9, 5, 45, 15, 'sara', 'SALES EXECUTIVE', '', '', '0000-00-00', NULL, '', 'Assigned', NULL, NULL, NULL, 'Transferred', 15, 'CUSTOMER EXECUTIVE', 'mohan transfer to amol by sara', '2024-08-22', '2024-08-24 16:40:59', '2024-08-22 11:17:15'),
(10, 6, 45, 15, 'sara', NULL, '', '', '0000-00-00', NULL, 'yes', 'Dead', NULL, NULL, 'soham mark dead by sara', NULL, NULL, NULL, NULL, '2024-08-22', '2024-08-22 12:49:56', '2024-08-22 11:17:15'),
(11, 7, 40, 10, 'amol', NULL, '', '', '0000-00-00', NULL, '', 'Transferred', NULL, NULL, NULL, 'Transferred', 15, 'CUSTOMER EXECUTIVE', 'mitali transferred to sara by amol', '2024-08-22', '2024-08-22 12:48:37', '2024-08-22 11:17:15'),
(12, 8, 40, 10, 'amol', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-22', NULL, '2024-08-22 11:56:50'),
(13, 9, 45, 15, 'sara', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-22', NULL, '2024-08-22 11:56:50'),
(14, 10, 40, 10, 'amol', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-22', NULL, '2024-08-22 11:59:23'),
(15, 11, 40, 10, 'amol', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-22', NULL, '2024-08-22 12:03:00'),
(16, 4, 45, 15, 'sara', NULL, '', '', '2024-08-23', NULL, '', 'Followup', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, NULL, NULL, '2024-08-22 12:12:34'),
(17, 5, 40, 10, 'amol', NULL, '', '', '0000-00-00', NULL, '', 'Transferred', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, NULL, NULL, '2024-08-22 12:23:58'),
(18, 1, 45, 15, 'sara', NULL, '', '', '0000-00-00', NULL, '', 'Transferred', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, NULL, NULL, '2024-08-22 12:30:38'),
(19, 2, 45, 15, 'sara', NULL, '', '', '0000-00-00', NULL, '', 'Followup', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, NULL, NULL, '2024-08-22 12:41:13'),
(20, 7, 45, 15, 'sara', NULL, '', '', '0000-00-00', NULL, '', 'Transferred', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, NULL, NULL, '2024-08-22 12:48:37'),
(21, 12, 40, 10, 'amol', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-08-24', NULL, '2024-08-24 16:51:48'),
(22, 13, 45, 15, 'sara', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-08-24', NULL, '2024-08-24 16:51:48'),
(23, 14, 40, 10, 'amol', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-08-24', NULL, '2024-08-24 16:51:48'),
(24, 15, 40, 10, 'amol', 'SALES EXECUTIVE', '', '', '0000-00-00', NULL, '', 'Assigned', NULL, NULL, NULL, 'Transferred', 10, NULL, NULL, '2024-08-26', '2024-08-26 11:21:24', '2024-08-26 10:57:03'),
(25, 16, 40, 10, 'amol', 'SALES EXECUTIVE', '', '', '0000-00-00', NULL, '', 'Assigned', NULL, NULL, NULL, 'Transferred', 10, NULL, NULL, '2024-08-26', '2024-08-26 12:12:26', '2024-08-26 10:57:03'),
(26, 17, 40, 10, 'amol', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-08-26', NULL, '2024-08-26 10:57:03'),
(27, 18, 45, 15, 'sara', NULL, ' Lead New 4, CE-sara, take a followup', '', '2024-08-27', '11:01:00', '', 'Followup', 'connected', 'hot', NULL, 'Not Available', NULL, NULL, NULL, '2024-08-26', NULL, '2024-08-26 11:01:51'),
(28, 19, 45, 15, 'sara', NULL, 'Lead New 5,CE-sara Followup', '', '2024-08-27', '11:10:00', '', 'Followup', 'connected', 'hot', NULL, 'Not Available', NULL, NULL, NULL, '2024-08-26', NULL, '2024-08-26 11:10:21'),
(29, 20, 45, 15, 'sara', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Transferred', 10, 'CUSTOMER EXECUTIVE', 'Lead New 6 transfer to amol by sara (CE to CE)', '2024-08-26', '2024-08-26 11:12:32', '2024-08-26 10:57:03'),
(30, 21, 40, 10, 'amol', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-08-26', NULL, '2024-08-26 10:57:03'),
(31, 18, 45, 15, 'sara', NULL, '', '', '2024-08-27', NULL, '', 'Followup', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, NULL, NULL, '2024-08-26 11:01:51'),
(32, 19, 45, 15, 'sara', NULL, '', '', '2024-08-27', '11:10:00', '', 'Followup', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, NULL, NULL, '2024-08-26 11:10:21'),
(33, 20, 40, 10, 'amol', NULL, '', '', '0000-00-00', NULL, '', 'Transferred', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, NULL, NULL, '2024-08-26 11:12:32'),
(34, 16, 45, 15, 'sara', NULL, '', '', '0000-00-00', NULL, '', 'From SE', NULL, NULL, NULL, 'Available', 14, 'SALES EXECUTIVE', 'Lead New 2 transfer from SE-pooja to CE-sara', NULL, NULL, '2024-08-28 15:01:07'),
(35, 22, 40, 10, 'amol', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-08-28', NULL, '2024-08-28 16:23:30'),
(36, 23, 40, 10, 'amol', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-08-28', NULL, '2024-08-28 16:23:30'),
(37, 24, 40, 10, 'amol', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-08-28', NULL, '2024-08-28 16:23:30'),
(38, 25, 40, 10, 'amol', 'SALES EXECUTIVE', '', '', '0000-00-00', NULL, '', 'Assigned', NULL, NULL, NULL, 'Transferred', 10, NULL, NULL, '2024-08-28', '2024-08-28 17:02:24', '2024-08-28 16:23:30'),
(39, 26, 45, 15, 'sara', NULL, '', '', '0000-00-00', NULL, 'yes', 'Dead', NULL, NULL, 'dead by CE-sara to prakash', 'Available', NULL, NULL, NULL, '2024-08-28', '2024-08-28 16:31:32', '2024-08-28 16:23:30'),
(40, 27, 45, 15, 'sara', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Transferred', 10, 'CUSTOMER EXECUTIVE', 'Mamata trasnfer to CE- amol by CE-sara', '2024-08-28', '2024-08-28 16:34:11', '2024-08-28 16:23:30'),
(41, 28, 45, 15, 'sara', NULL, 'Jaya followup by CE-sara', '', '2024-08-29', '16:35:00', '', 'Followup', 'connected', 'cold', NULL, 'Not Available', NULL, NULL, NULL, '2024-08-28', NULL, '2024-08-28 16:35:52'),
(42, 29, 45, 15, 'sara', 'SALES EXECUTIVE', '', '', '0000-00-00', NULL, '', 'Assigned', NULL, NULL, NULL, 'Transferred', 15, NULL, NULL, '2024-08-28', '2024-08-28 16:38:07', '2024-08-28 16:23:30'),
(43, 27, 40, 10, 'amol', 'SALES EXECUTIVE', '', '', '0000-00-00', NULL, '', 'Assigned', NULL, NULL, NULL, 'Transferred', 10, NULL, NULL, NULL, '2024-08-28 16:58:19', '2024-08-28 16:34:11'),
(44, 28, 45, 15, 'sara', NULL, '', '', '2024-08-29', '16:35:00', '', 'Followup', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, NULL, NULL, '2024-08-28 16:35:52'),
(45, 25, 45, 15, 'sara', NULL, '', '', '0000-00-00', NULL, '', 'From SE', NULL, NULL, NULL, 'Available', 14, 'SALES EXECUTIVE', 'akash transfer SE-pooja to CE-sara', NULL, NULL, '2024-08-28 17:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `assign_leads_sr`
--

CREATE TABLE `assign_leads_sr` (
  `assign_leads_sr_id` int(11) NOT NULL,
  `leads_id` int(10) NOT NULL,
  `assign_leads_id` int(10) DEFAULT NULL COMMENT 'this is primary key of assign_leads table for refrence',
  `lead_date` date DEFAULT NULL,
  `status` varchar(250) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `employee_name` varchar(250) NOT NULL,
  `employee_type` text NOT NULL,
  `notes` text NOT NULL,
  `remark` text NOT NULL,
  `connection_status` varchar(250) DEFAULT NULL,
  `lead_type` varchar(250) DEFAULT NULL,
  `is_followup` text NOT NULL,
  `next_date` date NOT NULL,
  `next_time` time DEFAULT NULL,
  `property_id` text NOT NULL,
  `sub_property_id` text NOT NULL,
  `variant` text NOT NULL,
  `area` text NOT NULL,
  `location1` text NOT NULL,
  `rate` text NOT NULL,
  `visit_done` text NOT NULL,
  `visit_date` date NOT NULL,
  `visit_time` time NOT NULL,
  `visit_notes` text NOT NULL,
  `photo` text NOT NULL,
  `location` text NOT NULL,
  `dead_reason` text NOT NULL,
  `mark_dead` text NOT NULL,
  `convert_lead` text NOT NULL,
  `quotated_price` text NOT NULL,
  `sale_price` text NOT NULL,
  `other_details` text NOT NULL,
  `row_date` date NOT NULL,
  `assign_employee_type` varchar(250) DEFAULT NULL,
  `assign_employee_id` int(10) NOT NULL,
  `transfer_status` varchar(250) NOT NULL,
  `transfer_employee_id` int(10) NOT NULL,
  `transfer_employee_type` varchar(250) NOT NULL,
  `transfer_reason` varchar(250) NOT NULL,
  `edited_on` datetime DEFAULT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign_leads_sr`
--

INSERT INTO `assign_leads_sr` (`assign_leads_sr_id`, `leads_id`, `assign_leads_id`, `lead_date`, `status`, `admin_id`, `employee_id`, `employee_name`, `employee_type`, `notes`, `remark`, `connection_status`, `lead_type`, `is_followup`, `next_date`, `next_time`, `property_id`, `sub_property_id`, `variant`, `area`, `location1`, `rate`, `visit_done`, `visit_date`, `visit_time`, `visit_notes`, `photo`, `location`, `dead_reason`, `mark_dead`, `convert_lead`, `quotated_price`, `sale_price`, `other_details`, `row_date`, `assign_employee_type`, `assign_employee_id`, `transfer_status`, `transfer_employee_id`, `transfer_employee_type`, `transfer_reason`, `edited_on`, `added_on`) VALUES
(1, 5, 9, NULL, 'Active', 41, 11, 'gayatri kate 11', 'SALES EXECUTIVE', 'notes', '', NULL, NULL, '', '2024-08-24', '20:06:00', '1', '1', '1', '500', 'Baner', '5 Lacks', '', '0000-00-00', '00:00:00', '', '', '', '', '', '', '', '', '', '0000-00-00', 'SALES EXECUTIVE', 0, '', 0, '', '', NULL, '2024-08-23 20:11:55'),
(2, 5, 9, NULL, 'Active', 44, 14, 'pooja', 'SALES EXECUTIVE', 'pooja mehta tower A 2,2.5,3 BHK', '', NULL, NULL, '', '0000-00-00', '00:00:00', '1', '1', '2,4,5', '', 'Baner', '', '', '2024-08-25', '00:00:00', '', '', '', '', '', '', '', '', '', '0000-00-00', 'SALES EXECUTIVE', 0, '', 0, '', '', NULL, '2024-08-24 15:45:45'),
(5, 5, 9, NULL, 'Active', 0, 15, 'sara', 'SALES EXECUTIVE', 'mehta t A 3,4 BHK, by sara to megha', '', NULL, NULL, '', '0000-00-00', NULL, '1', '1', '5,6', '', 'Baner', '', '', '2024-08-25', '20:30:00', '', '', '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 15, 'Available', 0, '', '', NULL, '2024-08-24 16:40:59'),
(6, 15, 24, NULL, 'Dead', 44, 14, 'pooja', 'SALES EXECUTIVE', 'Lead New 1, Amol assigned to pooja, Mehta Tower A 4BHK', '', NULL, NULL, '', '0000-00-00', NULL, '1', '1', '6,5,3', '', 'Baner', '', '', '2024-08-27', '11:20:00', '', '', '', 'Lead New 1, mehta tower A, dead bye SE-pooja', 'Yes', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 10, 'Dead', 0, '', '', '2024-08-27 14:37:54', '2024-08-26 11:21:24'),
(7, 16, 25, NULL, 'Active', 44, 14, 'pooja', 'SALES EXECUTIVE', ' Lead New 2, assign to pooja by amol', '', NULL, NULL, '', '0000-00-00', NULL, '1', '1', '5', '', 'Baner', '', '', '2024-08-27', '12:11:00', '', '', '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 10, 'Transferred', 15, 'CUSTOMER EXECUTIVE', 'Lead New 2 transfer from SE-pooja to CE-sara', '2024-08-28 15:01:07', '2024-08-26 12:12:26'),
(8, 29, 42, NULL, 'Active', 44, 14, 'pooja', 'SALES EXECUTIVE', 'mehta t A 1,2,2.5BHK, by sara to pooja', '', NULL, NULL, '', '0000-00-00', NULL, '1', '1', '1,2,4', '', 'Baner', '', '', '2024-08-28', '16:36:00', '', '', '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 15, 'Available', 13, 'SALES EXECUTIVE', 'Rekha transfer from SE-pooja to SE-megha', '2024-08-28 16:46:32', '2024-08-28 16:38:07'),
(9, 29, NULL, NULL, 'Transferred', 43, 13, 'megha', '', '', '', NULL, NULL, '', '0000-00-00', NULL, '', '', '', '', '', '', '', '0000-00-00', '00:00:00', '', '', '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 'Available', 0, '', '', NULL, '2024-08-28 16:46:32'),
(10, 27, 43, NULL, 'Converted', 44, 14, 'pooja', 'SALES EXECUTIVE', 'Mehta tower a amol to pooja', '', NULL, NULL, '', '0000-00-00', NULL, '1', '1', '6', '', 'Baner', '', '', '2024-08-29', '16:57:00', '', '', '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 10, 'Converted', 0, '', '', '2024-08-28 17:08:17', '2024-08-28 16:58:19'),
(11, 25, 38, NULL, 'Active', 44, 14, 'pooja', 'SALES EXECUTIVE', 'akash ce-amol to se-pooja', '', NULL, NULL, '', '0000-00-00', NULL, '1', '1', '4', '', 'Baner', '', '', '2024-08-28', '17:01:00', '', '', '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 10, 'Transferred', 15, 'CUSTOMER EXECUTIVE', 'akash transfer SE-pooja to CE-sara', '2024-08-28 17:04:03', '2024-08-28 17:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `converted_leads`
--

CREATE TABLE `converted_leads` (
  `converted_leads_id` int(10) NOT NULL,
  `assign_leads_sr_id` int(10) NOT NULL,
  `leads_id` int(10) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `employee_name` varchar(250) NOT NULL,
  `property_name_id` int(10) NOT NULL,
  `property_tower_id` int(10) NOT NULL,
  `property_variants` varchar(250) NOT NULL,
  `notes` text NOT NULL,
  `agreement_value` varchar(250) NOT NULL,
  `registrantion` varchar(250) NOT NULL,
  `gst` varchar(250) NOT NULL,
  `stamp_duty` varchar(250) NOT NULL,
  `commission` varchar(250) NOT NULL,
  `quoted_price` varchar(250) NOT NULL,
  `sale_price` varchar(250) NOT NULL,
  `added_on` datetime NOT NULL,
  `edited_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `converted_leads`
--

INSERT INTO `converted_leads` (`converted_leads_id`, `assign_leads_sr_id`, `leads_id`, `admin_id`, `employee_id`, `employee_name`, `property_name_id`, `property_tower_id`, `property_variants`, `notes`, `agreement_value`, `registrantion`, `gst`, `stamp_duty`, `commission`, `quoted_price`, `sale_price`, `added_on`, `edited_on`) VALUES
(1, 7, 16, 44, 14, 'pooja', 1, 1, '3,4,5,6', 'It look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', '22K', '20K', '18K', '16K', '15K', '50L', '45L', '2024-08-27 18:32:47', '0000-00-00 00:00:00'),
(2, 10, 27, 44, 14, 'pooja', 1, 1, '4', 'mehta tower A mamata', '20k', '20k', '20k', '20k', '20k', '20k', '20k', '2024-08-28 17:08:17', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) UNSIGNED NOT NULL,
  `admin_id` int(10) NOT NULL,
  `employee_name` varchar(500) DEFAULT NULL,
  `user_id` varchar(250) NOT NULL,
  `designation` varchar(500) DEFAULT NULL,
  `cell_no` varchar(20) DEFAULT NULL,
  `email_id` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `added_on` varchar(20) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `login_photo` varchar(100) DEFAULT 'default.png',
  `login_role` varchar(100) DEFAULT 'EMPLOYEE',
  `department` text NOT NULL,
  `edited_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `admin_id`, `employee_name`, `user_id`, `designation`, `cell_no`, `email_id`, `password`, `added_on`, `status`, `login_photo`, `login_role`, `department`, `edited_on`) VALUES
(10, 40, 'amol', 'amol', 'Employee', '98989898', 'seqtest@demo.com', '$2y$10$lXYWzJnqeEVgv6BY90LCDe5hCCCF3Ge8m8eFb9JweVckp8hY2JkZa', '2024-08-11 14-08-24', 'Active', 'default.png', 'CUSTOMER EXECUTIVE', '', '0000-00-00 00:00:00'),
(11, 41, 'gayatri kate 11', 'gayatri', 'Employee', '9000099', 'gggg11@demo.com', '$2y$10$lXYWzJnqeEVgv6BY90LCDe5hCCCF3Ge8m8eFb9JweVckp8hY2JkZa', '2024-08-11 14-08-43', 'Active', 'default.png', 'SALES EXECUTIVE', '', '0000-00-00 00:00:00'),
(12, 42, 'mayuri', 'mayuri', 'Employee', '787878787111', 'amolsir@demo.com', '$2y$10$jv9cSkYzY.Ku3If1rCAFZucpXlaAsyZeCHdVWxOI/fzcoRQ6o/Obe', '2024-08-11 14-39-20', 'Suspended', 'default.png', 'CUSTOMER EXECUTIVE', '', '2024-08-11 14:51:19'),
(13, 43, 'megha', 'SE-megha', 'Employee', '98989891', 'amolsir1@demo.com', '$2y$10$hho1Dyc3.eR.n2g/acrYEuK/zibMM1hSyIm7qqZpvtzf9FtrHAvFi', '2024-08-11 16-03-02', 'Active', 'default.png', 'SALES EXECUTIVE', '', '0000-00-00 00:00:00'),
(14, 44, 'pooja', 'SE-pooja', 'Employee', '9898798798', 'amolsir@demo.com', '$2y$10$MwrW090p.qd5QDDcUNM8yuY73dI65H86YZwoIoCWi5diOQtQYDpse', '2024-08-11 16-18-04', 'Active', 'default.png', 'SALES EXECUTIVE', '', '0000-00-00 00:00:00'),
(15, 45, 'sara', 'CE-sara', 'Employee', '9898989856', 'seq1@demo.com', '$2y$10$ADI5RKEUu6S4zlbrEIAOEeTUcszIAfX1pPFd1yOKKGV.auDBN9amq', '2024-08-12 11-51-01', 'Active', 'default.png', 'CUSTOMER EXECUTIVE', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(10) NOT NULL,
  `month` text NOT NULL,
  `lead_gen_date` text NOT NULL,
  `budget_range` varchar(250) NOT NULL,
  `flat_size` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL,
  `lead_name` varchar(250) NOT NULL,
  `phone_no` varchar(250) NOT NULL,
  `email_id` varchar(250) NOT NULL,
  `called_by` varchar(250) NOT NULL,
  `call_outcome` varchar(250) NOT NULL,
  `connected_outcome` varchar(250) NOT NULL,
  `remark` text NOT NULL,
  `source` text NOT NULL,
  `status` varchar(250) NOT NULL,
  `other_details` text NOT NULL,
  `added_on` datetime NOT NULL,
  `edited_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `month`, `lead_gen_date`, `budget_range`, `flat_size`, `location`, `lead_name`, `phone_no`, `email_id`, `called_by`, `call_outcome`, `connected_outcome`, `remark`, `source`, `status`, `other_details`, `added_on`, `edited_on`) VALUES
(1, '', '2024-08-22', '40', '', 'kothrud', 'Amol', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-22 11:17:15', '0000-00-00 00:00:00'),
(2, '', '2024-08-22', '42', '', 'Viman nagar', 'Niranjan', '99999999999', 'demo@gmail.com', '', '', '', '', '99N', 'Active', '', '2024-08-22 11:17:15', '0000-00-00 00:00:00'),
(3, '', '2024-08-22', '45', '', 'Karve Nagar', 'Akshay', '888888888', 'demo@gmail.com', '', '', '', '', '99AK', 'Active', '', '2024-08-22 11:17:15', '0000-00-00 00:00:00'),
(4, '', '2024-08-22', '47', '', 'Baner', 'Sana', '77777777777', 'demo@gmail.com', '', '', '', '', '99S', 'Active', '', '2024-08-22 11:17:15', '0000-00-00 00:00:00'),
(5, '', '2024-08-22', '50', '', 'Mohan Nagar', 'Mohan', '78787878787', 'demo@gmail.com', '', '', '', '', '99M', 'Active', '', '2024-08-22 11:17:15', '0000-00-00 00:00:00'),
(6, '', '2024-08-22', '52', '', 'Soham Nagar', 'Soham', '676767676', 'demo@gmail.com', '', '', '', '', '99S', 'Active', '', '2024-08-22 11:17:15', '0000-00-00 00:00:00'),
(7, '', '2024-08-22', '55', '', 'Mitali Nagar', 'Mitali', '6676767676', 'demo@gmail.com', '', '', '', '', '99M', 'Active', '', '2024-08-22 11:17:15', '0000-00-00 00:00:00'),
(8, '', '2024-08-22', '60', '', 'pune', 'Mayur', '78978897897', 'mayur@gamil.com', '', '', '', '', '99M', 'Active', '', '2024-08-22 11:56:50', '0000-00-00 00:00:00'),
(9, '', '2024-08-22', '62', '', 'wakad', 'Shital', '98889998989', 'shital@gamil.com', '', '', '', '', '99S', 'Active', '', '2024-08-22 11:56:50', '0000-00-00 00:00:00'),
(10, '', '2024-08-22', '66', '', 'Havare City', 'Mrunal', '989898989', 'mrunal@gamil.com', '', '', '', '', '99M', 'Active', '', '2024-08-22 11:59:23', '0000-00-00 00:00:00'),
(11, '', '2024-08-22', '61', '', 'kothrud', 'Shubham', '989898989', 'Shubham@gamil.com', '', '', '', '', '99S', 'Active', '', '2024-08-22 12:03:00', '0000-00-00 00:00:00'),
(12, '', '2024-08-24', '40', '', 'pune', 'lead 1', '989898989', 'lead1@gamil.com', '', '', '', '', '99A1', 'Active', '', '2024-08-24 16:51:48', '0000-00-00 00:00:00'),
(13, '', '2024-08-24', '60', '', 'kothrud', 'lead 2', '989898989', 'lead2@gamil.com', '', '', '', '', '99A2', 'Active', '', '2024-08-24 16:51:48', '0000-00-00 00:00:00'),
(14, '', '2024-08-24', '66', '', 'Havare City', 'lead 2', '989898989', 'lead3@gamil.com', '', '', '', '', '99A3', 'Active', '', '2024-08-24 16:51:48', '0000-00-00 00:00:00'),
(15, '', '2024-08-26', '40.1', '', 'Pune 1', 'Lead New 1', '9000000001', 'leadnew1@gamil.com', '', '', '', '', '99A1', 'Active', '', '2024-08-26 10:57:03', '0000-00-00 00:00:00'),
(16, '', '2024-08-26', '40.2', '', 'Pune 2', 'Lead New 2', '9000000002', 'leadnew2@gamil.com', '', '', '', '', '99A2', 'Active', '', '2024-08-26 10:57:03', '0000-00-00 00:00:00'),
(17, '', '2024-08-26', '40.3', '', 'Pune 3', 'Lead New 3', '9000000003', 'leadnew3@gamil.com', '', '', '', '', '99A3', 'Active', '', '2024-08-26 10:57:03', '0000-00-00 00:00:00'),
(18, '', '2024-08-26', '40.4', '', 'Pune 4', 'Lead New 4', '9000000004', 'leadnew4@gamil.com', '', '', '', '', '99A4', 'Active', '', '2024-08-26 10:57:03', '0000-00-00 00:00:00'),
(19, '', '2024-08-26', '40.5', '', 'Pune 5', 'Lead New 5', '9000000005', 'leadnew5@gamil.com', '', '', '', '', '99A5', 'Active', '', '2024-08-26 10:57:03', '0000-00-00 00:00:00'),
(20, '', '2024-08-26', '40.6', '', 'Pune 6', 'Lead New 6', '9000000006', 'leadnew6@gamil.com', '', '', '', '', '99A6', 'Active', '', '2024-08-26 10:57:03', '0000-00-00 00:00:00'),
(21, '', '2024-08-26', '40.7', '', 'Pune 7', 'Lead New 7', '9000000007', 'leadnew7@gamil.com', '', '', '', '', '99A7', 'Active', '', '2024-08-26 10:57:03', '0000-00-00 00:00:00'),
(22, '', '2024-08-28', '40', '', 'kothrud', 'Veena', '989898989', 'Veena@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-28 16:23:30', '0000-00-00 00:00:00'),
(23, '', '2024-08-28', '41', '', 'pune', 'Pallavi', '78978897897', 'Pallavi@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-28 16:23:30', '0000-00-00 00:00:00'),
(24, '', '2024-08-28', '42', '', 'Havare City', 'Prachi', '989898989', 'Prachi@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-28 16:23:30', '0000-00-00 00:00:00'),
(25, '', '2024-08-28', '43', '', 'Wakad', 'Akash', '78978897897', 'Akash@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-28 16:23:30', '0000-00-00 00:00:00'),
(26, '', '2024-08-28', '44', '', 'Viman Nagar', 'Prakash', '989898989', 'Prakash@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-28 16:23:30', '0000-00-00 00:00:00'),
(27, '', '2024-08-28', '45', '', 'Pimpri Chinchawad', 'Mamata', '989898989', 'Mamata@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-28 16:23:30', '0000-00-00 00:00:00'),
(28, '', '2024-08-28', '46', '', 'Suswad', 'Jaya', '989898989', 'Jaya@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-28 16:23:30', '0000-00-00 00:00:00'),
(29, '', '2024-08-28', '47', '', 'Kalyani Nagar', 'Rekha', '989898989', 'Rekha@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-28 16:23:30', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `id` int(10) NOT NULL,
  `property_title` text NOT NULL,
  `builder_name` varchar(250) NOT NULL,
  `varients` varchar(250) NOT NULL,
  `location` text NOT NULL,
  `area` varchar(250) NOT NULL,
  `price` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `builder_possession` varchar(250) DEFAULT NULL,
  `rera_possession` varchar(250) DEFAULT NULL,
  `added_on` datetime NOT NULL,
  `edited_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `property_title`, `builder_name`, `varients`, `location`, `area`, `price`, `status`, `builder_possession`, `rera_possession`, `added_on`, `edited_on`) VALUES
(1, 'ppptt', 'bbbbb', '2BHK', 'Pune', '555', '40k', 'Active', NULL, NULL, '2024-08-08 19:08:28', '0000-00-00 00:00:00'),
(2, 'abccc', 'amol', '1BHK', 'wagholi', '400', '30000', 'Active', NULL, NULL, '2024-08-09 11:47:38', '0000-00-00 00:00:00'),
(3, 'oioioi 22', 'oioioi 22', '3.5BHK', 'Pune 22', '90022', '8000022', 'Active', NULL, NULL, '2024-08-09 11:48:11', '2024-08-11 16:08:11'),
(4, 'Kate Property', 'Kate Property', '1BHK', 'viman nagar', '500', '5 Lacks', 'Active', 'May 2024', 'June 2026', '2024-08-20 22:14:31', '0000-00-00 00:00:00'),
(5, 'Kate Property', 'Gayatri BN', '2BHK', 'Kalyani nagar', '600', '6 Lacks', 'Suspended', NULL, NULL, '2024-08-20 22:14:31', '2024-08-22 15:02:44'),
(6, 'Kate Property', 'Kate Property', '3BHK', 'Wagholi 1', '701', '7.1 Lacks', 'Active', NULL, NULL, '2024-08-20 22:14:31', '0000-00-00 00:00:00'),
(7, 'Kate Property', 'Gayatri BN', '4BHK', 'Mohan nagar', '400', '4 Lacks', 'Active', NULL, NULL, '2024-08-20 22:14:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `property_name`
--

CREATE TABLE `property_name` (
  `property_name_id` int(10) NOT NULL,
  `property_title` text NOT NULL,
  `location` text NOT NULL,
  `builder_name` text NOT NULL,
  `added_on` datetime NOT NULL,
  `edited_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_name`
--

INSERT INTO `property_name` (`property_name_id`, `property_title`, `location`, `builder_name`, `added_on`, `edited_on`) VALUES
(1, 'Mehta Properties', 'Baner', 'Sagar Mehta', '2024-08-22 18:05:06', '0000-00-00 00:00:00'),
(2, 'Sharma Properties', 'Wakad', 'Pooja Sharma', '2024-08-22 18:05:51', '0000-00-00 00:00:00'),
(3, 'Sighania Properties', 'Viman Nagar', 'Ashok Sighania', '2024-08-22 18:06:47', '0000-00-00 00:00:00'),
(4, 'Raunak Group', 'Sangavi', 'Shreya Raunak', '2024-08-22 18:17:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `property_tower`
--

CREATE TABLE `property_tower` (
  `property_tower_id` int(10) NOT NULL,
  `property_name_id` int(10) DEFAULT NULL,
  `property_tower_name` varchar(250) NOT NULL,
  `builder_possession` varchar(250) NOT NULL,
  `rera_possession` varchar(250) NOT NULL,
  `added_on` datetime NOT NULL,
  `edited_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_tower`
--

INSERT INTO `property_tower` (`property_tower_id`, `property_name_id`, `property_tower_name`, `builder_possession`, `rera_possession`, `added_on`, `edited_on`) VALUES
(1, 1, 'mehta tower A', 'May 2024', 'June 2026', '2024-08-22 18:49:03', '0000-00-00 00:00:00'),
(2, 2, 'Sharma tower A', 'May 2024', 'June 2025', '2024-08-22 18:50:11', '0000-00-00 00:00:00'),
(3, 1, ' Mehta tower B', 'June 2022', 'may 2026', '2024-08-23 20:24:09', '0000-00-00 00:00:00'),
(4, 2, 'Sharma tower A', 'May 2024', 'June 2025', '2024-08-23 20:24:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `property_varients`
--

CREATE TABLE `property_varients` (
  `property_varients_id` int(10) NOT NULL,
  `property_name_id` int(10) DEFAULT NULL,
  `property_title` text DEFAULT NULL,
  `property_tower_id` int(10) DEFAULT NULL,
  `property_tower_name` text NOT NULL,
  `varients` text DEFAULT NULL,
  `area` varchar(250) NOT NULL,
  `price` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `added_on` datetime NOT NULL,
  `edited_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_varients`
--

INSERT INTO `property_varients` (`property_varients_id`, `property_name_id`, `property_title`, `property_tower_id`, `property_tower_name`, `varients`, `area`, `price`, `status`, `added_on`, `edited_on`) VALUES
(1, 1, 'Mehta Properties', 1, 'mehta tower A', '1BHK', '500', '5 Lacks', 'Active', '2024-08-23 12:19:41', '0000-00-00 00:00:00'),
(2, 1, 'Mehta Properties', 1, 'mehta tower A', '2BHK', '550', '5.5 L', 'Active', '2024-08-23 12:49:26', '0000-00-00 00:00:00'),
(3, 1, 'Mehta Properties', 1, 'mehta tower A', '2BHK', '5002', '5 Lacks', 'Active', '2024-08-23 20:23:27', '0000-00-00 00:00:00'),
(4, 1, 'Mehta Properties', 1, 'mehta tower A', '2.5BHK', '5001', '5.1 Lacks', 'Active', '2024-08-23 20:23:27', '0000-00-00 00:00:00'),
(5, 1, 'Mehta Properties', 1, 'mehta tower A', '3BHK', '5003', '5.3 Lacks', 'Active', '2024-08-23 20:23:27', '0000-00-00 00:00:00'),
(6, 1, 'Mehta Properties', 1, 'mehta tower A', '4BHK', '5004', '5.4 Lacks', 'Active', '2024-08-23 20:23:27', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `assign_leads`
--
ALTER TABLE `assign_leads`
  ADD PRIMARY KEY (`assign_leads_id`);

--
-- Indexes for table `assign_leads_sr`
--
ALTER TABLE `assign_leads_sr`
  ADD PRIMARY KEY (`assign_leads_sr_id`);

--
-- Indexes for table `converted_leads`
--
ALTER TABLE `converted_leads`
  ADD PRIMARY KEY (`converted_leads_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_name`
--
ALTER TABLE `property_name`
  ADD PRIMARY KEY (`property_name_id`);

--
-- Indexes for table `property_tower`
--
ALTER TABLE `property_tower`
  ADD PRIMARY KEY (`property_tower_id`);

--
-- Indexes for table `property_varients`
--
ALTER TABLE `property_varients`
  ADD PRIMARY KEY (`property_varients_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `assign_leads`
--
ALTER TABLE `assign_leads`
  MODIFY `assign_leads_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `assign_leads_sr`
--
ALTER TABLE `assign_leads_sr`
  MODIFY `assign_leads_sr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `converted_leads`
--
ALTER TABLE `converted_leads`
  MODIFY `converted_leads_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `property_name`
--
ALTER TABLE `property_name`
  MODIFY `property_name_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `property_tower`
--
ALTER TABLE `property_tower`
  MODIFY `property_tower_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `property_varients`
--
ALTER TABLE `property_varients`
  MODIFY `property_varients_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
