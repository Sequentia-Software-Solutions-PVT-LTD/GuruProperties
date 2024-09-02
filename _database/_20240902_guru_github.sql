-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2024 at 08:47 AM
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
-- Database: `guru_github`
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
  `status` varchar(10) DEFAULT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `login_name`, `login_id`, `login_password`, `login_role`, `type`, `login_photo`, `status`, `location`) VALUES
(1, 'Administrator', 'admin', '$2y$10$62GOdcttnKe4ewxhR3YfiOHb1RK9DScRZgRtC8tf8rTJQnL1rgZK.', 'ADMIN', 'ADMIN', 'default.png', 'Active', '0'),
(2, 'superadmin', 'superadmin', '$2y$10$62GOdcttnKe4ewxhR3YfiOHb1RK9DScRZgRtC8tf8rTJQnL1rgZK.', 'ADMIN', 'SUPERADMIN', 'default.png', 'Active', '0'),
(40, 'amol', 'amol', '$2y$10$lXYWzJnqeEVgv6BY90LCDe5hCCCF3Ge8m8eFb9JweVckp8hY2JkZa', 'CUSTOMER EXECUTIVE', 'CUSTOMER EXECUTIVE', 'default.png', 'Active', '1,2,3,4,9'),
(41, 'gayatri kate 11', 'gayatri', '$2y$10$lXYWzJnqeEVgv6BY90LCDe5hCCCF3Ge8m8eFb9JweVckp8hY2JkZa', 'SALES EXECUTIVE', 'SALES EXECUTIVE', 'default.png', 'Active', '9,10,11,12'),
(42, 'mayuri', 'CE-mayuri', '$2y$10$jv9cSkYzY.Ku3If1rCAFZucpXlaAsyZeCHdVWxOI/fzcoRQ6o/Obe', 'CUSTOMER EXECUTIVE', 'CUSTOMER EXECUTIVE', 'default.png', 'Active', '5,6,7,8'),
(43, 'megha', 'SE-megha', '$2y$10$hho1Dyc3.eR.n2g/acrYEuK/zibMM1hSyIm7qqZpvtzf9FtrHAvFi', 'SALES EXECUTIVE', 'SALES EXECUTIVE', 'default.png', 'Active', '1,2,34'),
(44, 'pooja', 'SE-pooja', '$2y$10$MwrW090p.qd5QDDcUNM8yuY73dI65H86YZwoIoCWi5diOQtQYDpse', 'SALES EXECUTIVE', 'SALES EXECUTIVE', 'default.png', 'Active', '5,6,7,8'),
(45, 'sara', 'CE-sara', '$2y$10$ADI5RKEUu6S4zlbrEIAOEeTUcszIAfX1pPFd1yOKKGV.auDBN9amq', 'CUSTOMER EXECUTIVE', 'CUSTOMER EXECUTIVE', 'default.png', 'Active', '9,10,11,12'),
(46, 'Lead Generator', 'leadgenerator', '$2y$10$zpRToYM7QiKHnJQHFX.k8.tUO1Ljy59vNjuRJUjTesASIKwlgxw4i', 'LEAD GENERATOR', 'LEAD GENERATOR', 'default.png', 'Active', '0');

-- --------------------------------------------------------

--
-- Table structure for table `assign_leads`
--

CREATE TABLE `assign_leads` (
  `assign_leads_id` int(10) NOT NULL,
  `leads_id` int(10) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `location_id` int(11) NOT NULL,
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
  `added_on` datetime NOT NULL,
  `fresh_lead` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assign_leads`
--

INSERT INTO `assign_leads` (`assign_leads_id`, `leads_id`, `admin_id`, `location_id`, `employee_id`, `employee_name`, `assign_employee_type`, `notes`, `remark`, `next_date`, `next_time`, `mark_dead`, `status`, `connection_status`, `lead_type`, `dead_reason`, `transfer_status`, `transfer_employee_id`, `transfer_employee_type`, `transfer_reason`, `lead_date`, `edited_on`, `added_on`, `fresh_lead`) VALUES
(1, 4, 40, 1, 10, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 02:39:53', 0),
(2, 14, 40, 2, 10, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 02:39:53', 0),
(3, 2, 40, 3, 10, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 02:39:53', 0),
(4, 10, 40, 3, 10, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 02:39:53', 0),
(5, 1, 40, 4, 10, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 02:39:53', 0),
(6, 3, 40, 4, 10, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 02:39:53', 0),
(7, 12, 40, 9, 10, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 02:39:53', 0),
(8, 13, 45, 10, 15, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 02:39:53', 0),
(9, 8, 45, 11, 15, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 02:39:53', 0),
(10, 6, 45, 12, 15, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 02:39:53', 0),
(11, 4, 40, 1, 10, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 12:11:05', 1),
(12, 4, 40, 1, 10, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 12:11:51', 1),
(13, 4, 40, 1, 10, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 12:13:34', 1),
(14, 4, 40, 1, 10, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 12:13:54', 1),
(15, 14, 40, 2, 10, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 12:13:54', 1),
(16, 2, 40, 3, 10, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 12:13:54', 1),
(17, 4, 40, 1, 10, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 12:14:17', 1),
(18, 14, 40, 2, 10, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 12:14:17', 1),
(19, 2, 40, 3, 10, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 12:14:17', 1),
(20, 10, 40, 3, 10, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 12:14:17', 1),
(21, 1, 40, 4, 10, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 12:14:17', 1),
(22, 3, 40, 4, 10, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 12:14:17', 1),
(23, 12, 40, 9, 10, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 12:14:17', 1),
(24, 13, 45, 10, 15, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 12:14:17', 1),
(25, 8, 45, 11, 15, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 12:14:17', 1),
(26, 6, 45, 12, 15, 'test', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-02', NULL, '2024-09-02 12:14:17', 1);

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
  `followup_or_another_property` varchar(250) DEFAULT NULL,
  `next_date` date DEFAULT NULL,
  `next_time` time DEFAULT NULL,
  `property_id` text NOT NULL,
  `sub_property_id` text NOT NULL,
  `variant` text NOT NULL,
  `area` text NOT NULL,
  `location1` text NOT NULL,
  `rate` text NOT NULL,
  `visit_done` text NOT NULL,
  `visit_date` date DEFAULT NULL,
  `visit_time` time DEFAULT NULL,
  `visit_notes` text NOT NULL,
  `photo` text DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assign_leads_sr`
--

INSERT INTO `assign_leads_sr` (`assign_leads_sr_id`, `leads_id`, `assign_leads_id`, `lead_date`, `status`, `admin_id`, `employee_id`, `employee_name`, `employee_type`, `notes`, `remark`, `connection_status`, `lead_type`, `is_followup`, `followup_or_another_property`, `next_date`, `next_time`, `property_id`, `sub_property_id`, `variant`, `area`, `location1`, `rate`, `visit_done`, `visit_date`, `visit_time`, `visit_notes`, `photo`, `location`, `dead_reason`, `mark_dead`, `convert_lead`, `quotated_price`, `sale_price`, `other_details`, `row_date`, `assign_employee_type`, `assign_employee_id`, `transfer_status`, `transfer_employee_id`, `transfer_employee_type`, `transfer_reason`, `edited_on`, `added_on`) VALUES
(1, 5, 9, NULL, 'Active', 41, 11, 'gayatri kate 11', 'SALES EXECUTIVE', 'notes', '', NULL, NULL, '', NULL, '2024-08-24', '20:06:00', '1', '1', '1', '500', 'Baner', '5 Lacks', '', '0000-00-00', '00:00:00', '', '', '', '', '', '', '', '', '', '0000-00-00', 'SALES EXECUTIVE', 0, '', 0, '', '', NULL, '2024-08-23 20:11:55'),
(2, 5, 9, NULL, 'Active', 44, 14, 'pooja', 'SALES EXECUTIVE', 'pooja mehta tower A 2,2.5,3 BHK', '', NULL, NULL, '', NULL, '0000-00-00', '00:00:00', '1', '1', '2,4,5', '', 'Baner', '', '', '2024-08-25', '00:00:00', '', '', '', '', '', '', '', '', '', '0000-00-00', 'SALES EXECUTIVE', 0, '', 0, '', '', NULL, '2024-08-24 15:45:45'),
(5, 5, 9, NULL, 'Active', 0, 15, 'sara', 'SALES EXECUTIVE', 'mehta t A 3,4 BHK, by sara to megha', '', NULL, NULL, '', NULL, '0000-00-00', NULL, '1', '1', '5,6', '', 'Baner', '', '', '2024-08-25', '20:30:00', '', '', '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 15, 'Available', 0, '', '', NULL, '2024-08-24 16:40:59'),
(6, 15, 24, NULL, 'Dead', 44, 14, 'pooja', 'SALES EXECUTIVE', 'Lead New 1, Amol assigned to pooja, Mehta Tower A 4BHK', '', NULL, NULL, '', NULL, '0000-00-00', NULL, '1', '1', '6,5,3', '', 'Baner', '', '', '2024-08-27', '11:20:00', '', '', '', 'Lead New 1, mehta tower A, dead bye SE-pooja', 'Yes', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 10, 'Dead', 0, '', '', '2024-08-27 14:37:54', '2024-08-26 11:21:24'),
(7, 16, 25, NULL, 'Active', 44, 14, 'pooja', 'SALES EXECUTIVE', ' Lead New 2, assign to pooja by amol', '', NULL, NULL, '', NULL, '0000-00-00', NULL, '1', '1', '5', '', 'Baner', '', '', '2024-08-27', '12:11:00', '', '', '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 10, 'Transfered', 15, 'CUSTOMER EXECUTIVE', 'Lead New 2 transfer from SE-pooja to CE-sara', '2024-08-28 15:01:07', '2024-08-26 12:12:26'),
(8, 29, 42, NULL, 'Followup', 44, 14, 'pooja', 'SALES EXECUTIVE', 'Rekha followup-1 SE-pooja', '', 'connected', 'hot', '', NULL, '0000-00-00', '00:00:00', '1', '1', '1,2,4', '', 'Baner', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 15, 'Not Available', 13, 'SALES EXECUTIVE', 'Rekha transfer from SE-pooja to SE-megha', '2024-08-30 11:47:00', '2024-08-28 16:38:07'),
(9, 29, NULL, NULL, 'Transfered', 43, 13, 'megha', '', '', '', NULL, NULL, '', NULL, '0000-00-00', NULL, '', '', '', '', '', '', '', '0000-00-00', '00:00:00', '', '', '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 'Available', 0, '', '', NULL, '2024-08-28 16:46:32'),
(10, 27, 43, NULL, 'Converted', 44, 14, 'pooja', 'SALES EXECUTIVE', 'Mehta tower a amol to pooja', '', NULL, NULL, '', NULL, '0000-00-00', NULL, '1', '1', '6', '', 'Baner', '', '', '2024-08-29', '16:57:00', '', '', '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 10, 'Converted', 0, '', '', '2024-08-28 17:08:17', '2024-08-28 16:58:19'),
(11, 25, 38, NULL, 'Active', 44, 14, 'pooja', 'SALES EXECUTIVE', 'akash ce-amol to se-pooja', '', NULL, NULL, '', NULL, '0000-00-00', NULL, '1', '1', '4', '', 'Baner', '', '', '2024-08-28', '17:01:00', '', '', '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 10, 'Transfered', 15, 'CUSTOMER EXECUTIVE', 'akash transfer SE-pooja to CE-sara', '2024-08-28 17:04:03', '2024-08-28 17:02:24'),
(12, 29, NULL, NULL, 'Active', 43, 13, 'megha', '', '', '', NULL, NULL, '', NULL, '0000-00-00', NULL, '', '', '', '', '', '', '', '0000-00-00', '00:00:00', '', '', '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 'Transfered', 15, 'CUSTOMER EXECUTIVE', 'Rekha transfer from megha sara', '2024-08-29 11:40:27', '2024-08-29 11:35:14'),
(13, 35, 52, NULL, 'Converted', 44, 14, 'pooja', 'SALES EXECUTIVE', 'Iyyer assign to SE-pooja by CE-sara', '', NULL, NULL, '', NULL, '0000-00-00', NULL, '1', '1', '2', '', 'Baner', '', '', '2024-08-29', '17:19:00', '', '', '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 15, 'Converted', 0, '', '', '2024-08-29 17:31:45', '2024-08-29 17:19:55'),
(14, 37, 54, NULL, 'Active', 44, 14, 'pooja', 'SALES EXECUTIVE', 'Tappu assigned by CE-sara to SE-pooja', '', NULL, NULL, '', NULL, '0000-00-00', NULL, '1', '1', '4', '', 'Baner', '', '', '2024-08-29', '17:33:00', '', '', '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 15, 'Transfered', 13, 'SALES EXECUTIVE', 'tappu T from SE-pooja to SE-megha', '2024-08-29 17:36:28', '2024-08-29 17:34:04'),
(15, 37, NULL, NULL, 'Active', 43, 13, 'megha', '', '', '', NULL, NULL, '', NULL, '0000-00-00', NULL, '', '', '', '', '', '', '', '0000-00-00', '00:00:00', '', '', '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 'Transfered', 10, 'CUSTOMER EXECUTIVE', 'tappu T. CE-amol by SE-megha', '2024-08-29 17:37:35', '2024-08-29 17:36:28'),
(16, 36, 53, NULL, 'Followup', 44, 14, 'pooja', 'SALES EXECUTIVE', 'Hathi Bhai', '', 'connected', 'hot', '', NULL, '2024-08-31', '11:48:00', '1', '1', '3', '', 'Baner', '', '', '0000-00-00', '00:00:00', '', '', '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 15, 'Not Available', 0, '', '', '2024-08-30 12:05:21', '2024-08-29 23:35:07'),
(17, 27, 40, NULL, 'Followup', 44, 14, 'pooja', 'SALES EXECUTIVE', 'Mehta Properties Tower A Followup-1 by SE-pooja ', '', 'connected', 'hot', '', NULL, '0000-00-00', '00:00:00', '1', '1', '4', '', 'Baner', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 15, 'Not Available', 0, '', '', '2024-08-30 11:32:18', '2024-08-30 10:38:46'),
(18, 27, 40, NULL, 'Followup', 44, 14, 'pooja', '', '', '', NULL, NULL, '', 'Follow Up', '2024-08-31', '20:20:20', '1', '1', '4', '', '', '', '', '2024-09-01', NULL, '', NULL, '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 'Available', 0, '', '', NULL, '2024-08-30 11:32:18'),
(19, 29, 42, NULL, 'Followup', 44, 14, 'pooja', '', '', '', NULL, NULL, '', 'Follow Up', '0000-00-00', '00:00:00', '1', '1', '1,2,4', '', '', '', '', NULL, NULL, '', 'photos/photo_20240830114700.png', '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 'Available', 0, '', '', NULL, '2024-08-30 11:47:00'),
(20, 36, 53, NULL, 'Followup', 44, 14, 'pooja', '', '', '', NULL, NULL, '', 'Follow Up', '2024-08-31', '11:48:00', '1', '1', '3', '', '', '', '', '0000-00-00', '00:00:00', '', 'photos/photo_20240830120521.png', '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 'Available', 0, '', '', NULL, '2024-08-30 12:05:21'),
(21, 38, 55, NULL, 'Followup', 44, 14, 'pooja', 'SALES EXECUTIVE', 'Golli followup-1 SE-pooja', '', 'connected', 'hot', '', NULL, '0000-00-00', '00:00:00', '1', '1', '4', '', 'Baner', '', '', '2024-09-01', '12:16:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 15, 'Not Available', 0, '', '', '2024-08-30 12:17:17', '2024-08-30 12:11:08'),
(22, 38, 55, NULL, 'Followup', 44, 14, 'pooja', '', '', '', NULL, NULL, '', 'Another Property', '0000-00-00', '00:00:00', '1', '1', '6', '', '', '', '', '2024-09-01', '12:16:00', '', 'photos/photo_20240830121717.png', '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 'Available', 0, '', '', NULL, '2024-08-30 12:17:17'),
(23, 25, 45, NULL, 'Active', 44, 14, 'pooja', 'SALES EXECUTIVE', 'akash 5th sept to sara to pooja', '', NULL, NULL, '', NULL, NULL, NULL, '1', '1', '5', '', 'Baner', '', '', '2024-09-05', '12:21:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 15, 'Transfered', 13, 'SALES EXECUTIVE', 'kolml;', '2024-08-30 14:49:45', '2024-08-30 12:21:39'),
(24, 25, NULL, NULL, 'Transfered', 43, 13, 'megha', '', '', '', NULL, NULL, '', NULL, NULL, NULL, '', '', '', '', '', '', '', NULL, NULL, '', NULL, '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 'Available', 0, '', '', NULL, '2024-08-30 14:49:45'),
(25, 42, 62, NULL, 'Active', 43, 13, 'megha', 'SALES EXECUTIVE', 'notes', '', NULL, NULL, '', NULL, NULL, NULL, '1', '1', '4', '', 'Baner', '', '', '2024-08-30', '16:26:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 15, 'Available', 0, '', '', NULL, '2024-08-30 16:29:07');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `converted_leads`
--

INSERT INTO `converted_leads` (`converted_leads_id`, `assign_leads_sr_id`, `leads_id`, `admin_id`, `employee_id`, `employee_name`, `property_name_id`, `property_tower_id`, `property_variants`, `notes`, `agreement_value`, `registrantion`, `gst`, `stamp_duty`, `commission`, `quoted_price`, `sale_price`, `added_on`, `edited_on`) VALUES
(1, 7, 16, 44, 14, 'pooja', 1, 1, '3,4,5,6', 'It look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', '22K', '20K', '18K', '16K', '15K', '50L', '45L', '2024-08-27 18:32:47', '0000-00-00 00:00:00'),
(2, 10, 27, 44, 14, 'pooja', 1, 1, '4', 'mehta tower A mamata', '20k', '20k', '20k', '20k', '20k', '20k', '20k', '2024-08-28 17:08:17', '0000-00-00 00:00:00'),
(3, 13, 35, 44, 14, 'pooja', 1, 1, '5', 'Iyyer convert by pooja', '20k', '20k', '20k', '20k', '20k', '20k', '20k', '2024-08-29 17:31:45', '0000-00-00 00:00:00');

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
  `edited_on` datetime NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `admin_id`, `employee_name`, `user_id`, `designation`, `cell_no`, `email_id`, `password`, `added_on`, `status`, `login_photo`, `login_role`, `department`, `edited_on`, `location`) VALUES
(10, 40, 'amol', 'amol', 'Employee', '98989898', 'seqtest@demo.com', '$2y$10$lXYWzJnqeEVgv6BY90LCDe5hCCCF3Ge8m8eFb9JweVckp8hY2JkZa', '2024-08-11 14-08-24', 'Active', 'default.png', 'CUSTOMER EXECUTIVE', '', '0000-00-00 00:00:00', ''),
(11, 41, 'gayatri kate 11', 'gayatri', 'Employee', '9000099', 'gggg11@demo.com', '$2y$10$lXYWzJnqeEVgv6BY90LCDe5hCCCF3Ge8m8eFb9JweVckp8hY2JkZa', '2024-08-11 14-08-43', 'Active', 'default.png', 'SALES EXECUTIVE', '', '0000-00-00 00:00:00', ''),
(12, 42, 'mayuri', 'mayuri', 'Employee', '787878787111', 'amolsir@demo.com', '$2y$10$jv9cSkYzY.Ku3If1rCAFZucpXlaAsyZeCHdVWxOI/fzcoRQ6o/Obe', '2024-08-11 14-39-20', 'Suspended', 'default.png', 'CUSTOMER EXECUTIVE', '', '2024-08-11 14:51:19', ''),
(13, 43, 'megha', 'SE-megha', 'Employee', '98989891', 'amolsir1@demo.com', '$2y$10$hho1Dyc3.eR.n2g/acrYEuK/zibMM1hSyIm7qqZpvtzf9FtrHAvFi', '2024-08-11 16-03-02', 'Active', 'default.png', 'SALES EXECUTIVE', '', '0000-00-00 00:00:00', ''),
(14, 44, 'pooja', 'SE-pooja', 'Employee', '9898798798', 'amolsir@demo.com', '$2y$10$MwrW090p.qd5QDDcUNM8yuY73dI65H86YZwoIoCWi5diOQtQYDpse', '2024-08-11 16-18-04', 'Active', 'default.png', 'SALES EXECUTIVE', '', '0000-00-00 00:00:00', ''),
(15, 45, 'sara', 'CE-sara', 'Employee', '9898989856', 'seq1@demo.com', '$2y$10$ADI5RKEUu6S4zlbrEIAOEeTUcszIAfX1pPFd1yOKKGV.auDBN9amq', '2024-08-12 11-51-01', 'Active', 'default.png', 'CUSTOMER EXECUTIVE', '', '0000-00-00 00:00:00', ''),
(16, 46, 'Lead Generator', 'leadgenerator', 'Employee', '9898989898', 'leadgenerator@gamil.com', '$2y$10$ADI5RKEUu6S4zlbrEIAOEeTUcszIAfX1pPFd1yOKKGV.auDBN9amq', '2024-08-29 23-28-06', 'Active', 'default.png', 'LEAD GENERATOR', '', '0000-00-00 00:00:00', '');

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
  `edited_on` datetime NOT NULL,
  `assign_lead_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `month`, `lead_gen_date`, `budget_range`, `flat_size`, `location`, `lead_name`, `phone_no`, `email_id`, `called_by`, `call_outcome`, `connected_outcome`, `remark`, `source`, `status`, `other_details`, `added_on`, `edited_on`, `assign_lead_id`) VALUES
(1, '', '2024-08-22', '40', '', 'kothrud', 'Amol', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Assigned', '', '2024-08-22 11:17:15', '0000-00-00 00:00:00', 21),
(2, '', '2024-08-22', '42', '', 'Viman nagar', 'Niranjan', '99999999999', 'demo@gmail.com', '', '', '', '', '99N', 'Assigned', '', '2024-08-22 11:17:15', '0000-00-00 00:00:00', 19),
(3, '', '2024-08-22', '45', '', 'Karve Nagar', 'Akshay', '888888888', 'demo@gmail.com', '', '', '', '', '99AK', 'Assigned', '', '2024-08-22 11:17:15', '0000-00-00 00:00:00', 22),
(4, '', '2024-08-22', '47', '', 'Baner', 'Sana', '77777777777', 'demo@gmail.com', '', '', '', '', '99S', 'Assigned', '', '2024-08-22 11:17:15', '0000-00-00 00:00:00', 17),
(5, '', '2024-08-22', '50', '', 'Mohan Nagar', 'Mohan', '78787878787', 'demo@gmail.com', '', '', '', '', '99M', 'Active', '', '2024-08-22 11:17:15', '0000-00-00 00:00:00', 0),
(6, '', '2024-08-22', '52', '', 'Soham Nagar', 'Soham', '676767676', 'demo@gmail.com', '', '', '', '', '99S', 'Assigned', '', '2024-08-22 11:17:15', '0000-00-00 00:00:00', 26),
(7, '', '2024-08-22', '55', '', 'Mitali Nagar', 'Mitali', '6676767676', 'demo@gmail.com', '', '', '', '', '99M', 'Active', '', '2024-08-22 11:17:15', '0000-00-00 00:00:00', 0),
(8, '', '2024-08-22', '60', '', 'pune', 'Mayur', '78978897897', 'mayur@gamil.com', '', '', '', '', '99M', 'Assigned', '', '2024-08-22 11:56:50', '0000-00-00 00:00:00', 25),
(9, '', '2024-08-22', '62', '', 'wakad', 'Shital', '98889998989', 'shital@gamil.com', '', '', '', '', '99S', 'Active', '', '2024-08-22 11:56:50', '0000-00-00 00:00:00', 0),
(10, '', '2024-08-22', '66', '', 'Havare City', 'Mrunal', '989898989', 'mrunal@gamil.com', '', '', '', '', '99M', 'Assigned', '', '2024-08-22 11:59:23', '0000-00-00 00:00:00', 20),
(11, '', '2024-08-22', '61', '', 'kothrud', 'Shubham', '989898989', 'Shubham@gamil.com', '', '', '', '', '99S', 'Active', '', '2024-08-22 12:03:00', '0000-00-00 00:00:00', 0),
(12, '', '2024-08-24', '40', '', 'pune', 'lead 1', '989898989', 'lead1@gamil.com', '', '', '', '', '99A1', 'Assigned', '', '2024-08-24 16:51:48', '0000-00-00 00:00:00', 23),
(13, '', '2024-08-24', '60', '', 'kothrud', 'lead 2', '989898989', 'lead2@gamil.com', '', '', '', '', '99A2', 'Assigned', '', '2024-08-24 16:51:48', '0000-00-00 00:00:00', 24),
(14, '', '2024-08-24', '66', '', 'Havare City', 'lead 2', '989898989', 'lead3@gamil.com', '', '', '', '', '99A3', 'Assigned', '', '2024-08-24 16:51:48', '0000-00-00 00:00:00', 18),
(15, '', '2024-08-26', '40.1', '', 'Pune 1', 'Lead New 1', '9000000001', 'leadnew1@gamil.com', '', '', '', '', '99A1', 'Active', '', '2024-08-26 10:57:03', '0000-00-00 00:00:00', 0),
(16, '', '2024-08-26', '40.2', '', 'Pune 2', 'Lead New 2', '9000000002', 'leadnew2@gamil.com', '', '', '', '', '99A2', 'Active', '', '2024-08-26 10:57:03', '0000-00-00 00:00:00', 0),
(17, '', '2024-08-26', '40.3', '', 'Pune 3', 'Lead New 3', '9000000003', 'leadnew3@gamil.com', '', '', '', '', '99A3', 'Active', '', '2024-08-26 10:57:03', '0000-00-00 00:00:00', 0),
(18, '', '2024-08-26', '40.4', '', 'Pune 4', 'Lead New 4', '9000000004', 'leadnew4@gamil.com', '', '', '', '', '99A4', 'Active', '', '2024-08-26 10:57:03', '0000-00-00 00:00:00', 0),
(19, '', '2024-08-26', '40.5', '', 'Pune 5', 'Lead New 5', '9000000005', 'leadnew5@gamil.com', '', '', '', '', '99A5', 'Active', '', '2024-08-26 10:57:03', '0000-00-00 00:00:00', 0),
(20, '', '2024-08-26', '40.6', '', 'Pune 6', 'Lead New 6', '9000000006', 'leadnew6@gamil.com', '', '', '', '', '99A6', 'Active', '', '2024-08-26 10:57:03', '0000-00-00 00:00:00', 0),
(21, '', '2024-08-26', '40.7', '', 'Pune 7', 'Lead New 7', '9000000007', 'leadnew7@gamil.com', '', '', '', '', '99A7', 'Active', '', '2024-08-26 10:57:03', '0000-00-00 00:00:00', 0),
(22, '', '2024-08-28', '40', '', 'kothrud', 'Veena', '989898989', 'Veena@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-28 16:23:30', '0000-00-00 00:00:00', 0),
(23, '', '2024-08-28', '41', '', 'pune', 'Pallavi', '78978897897', 'Pallavi@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-28 16:23:30', '0000-00-00 00:00:00', 0),
(24, '', '2024-08-28', '42', '', 'Havare City', 'Prachi', '989898989', 'Prachi@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-28 16:23:30', '0000-00-00 00:00:00', 0),
(25, '', '2024-08-28', '43', '', 'Wakad', 'Akash', '78978897897', 'Akash@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-28 16:23:30', '0000-00-00 00:00:00', 0),
(26, '', '2024-08-28', '44', '', 'Viman Nagar', 'Prakash', '989898989', 'Prakash@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-28 16:23:30', '0000-00-00 00:00:00', 0),
(27, '', '2024-08-28', '45', '', 'Pimpri Chinchawad', 'Mamata', '989898989', 'Mamata@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-28 16:23:30', '0000-00-00 00:00:00', 0),
(28, '', '2024-08-28', '46', '', 'Suswad', 'Jaya', '989898989', 'Jaya@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-28 16:23:30', '0000-00-00 00:00:00', 0),
(29, '', '2024-08-28', '47', '', 'Kalyani Nagar', 'Rekha', '989898989', 'Rekha@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-28 16:23:30', '0000-00-00 00:00:00', 0),
(30, '', '2024-08-29', '40Lac', '', 'kothrud', 'Jethalal', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-29 17:09:07', '0000-00-00 00:00:00', 0),
(31, '', '2024-08-29', '40Lac', '', 'pune', 'Tarak', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-29 17:09:07', '0000-00-00 00:00:00', 0),
(32, '', '2024-08-29', '40Lac', '', 'pune', 'Atmaram', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-29 17:09:07', '0000-00-00 00:00:00', 0),
(33, '', '2024-08-29', '40Lac', '', 'pune', 'Roshan', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-29 17:09:07', '0000-00-00 00:00:00', 0),
(34, '', '2024-08-29', '40Lac', '', 'pune', 'Popatlal', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-29 17:09:07', '0000-00-00 00:00:00', 0),
(35, '', '2024-08-29', '40Lac', '', 'pune', 'Iyyer', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-29 17:09:07', '0000-00-00 00:00:00', 0),
(36, '', '2024-08-29', '40Lac', '', 'pune', 'Hathi Bhai', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-29 17:09:07', '0000-00-00 00:00:00', 0),
(37, '', '2024-08-29', '40Lac', '', '', 'Tappu', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-29 17:09:07', '0000-00-00 00:00:00', 0),
(38, '', '2024-08-29', '40Lac', '', '', 'Golli', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-29 17:09:07', '0000-00-00 00:00:00', 0),
(39, '', '2024-08-29', '40Lac', '', '', 'Sundar', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-29 17:09:07', '0000-00-00 00:00:00', 0),
(40, '', '2024-08-29', '40Lac', '', '', 'Sonu', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-29 17:09:07', '0000-00-00 00:00:00', 0),
(41, '', '2024-08-30', '1CR', '', 'baner', 'Prashant', '9890309191', 'prashant.18feb@gmail.com', '', '', '', '', '99A', 'Active', '', '2024-08-30 16:12:25', '0000-00-00 00:00:00', 0),
(42, '', '2024-08-30', '50L', '', 'Wakad', 'Pragati', '989898989', 'pragati@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-30 16:12:25', '0000-00-00 00:00:00', 0),
(43, '', '2024-08-30', '58L', '', 'Pune', 'Minakshi', '989898989', 'minakshi@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-30 16:12:25', '0000-00-00 00:00:00', 0),
(44, '', '2024-08-30', '40', '', 'pune', 'Harshal', '989898989', 'harshal@gmail.com', '', '', '', '', '99A', 'Active', '', '2024-08-30 17:15:14', '0000-00-00 00:00:00', 0),
(45, '', '2024-08-30', '60', '', 'kothrud', 'Vishal', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-08-30 17:15:14', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`) VALUES
(1, 'Koregaon Park'),
(2, 'Kalyani Nagar'),
(3, 'Hinjewadi'),
(4, 'Kharadi'),
(5, 'Hadapsar'),
(6, 'Aundh'),
(7, 'NIBM Road'),
(8, 'Shivaji Nagar'),
(9, 'Magarpatta City'),
(10, 'Bavdhan'),
(11, 'Model Colony'),
(12, 'Viman Nagar'),
(13, 'Baner'),
(14, 'Wakad'),
(15, 'Wagholi'),
(16, 'Pimple Saudagar');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `location`
--
ALTER TABLE `location`
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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `assign_leads`
--
ALTER TABLE `assign_leads`
  MODIFY `assign_leads_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `assign_leads_sr`
--
ALTER TABLE `assign_leads_sr`
  MODIFY `assign_leads_sr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `converted_leads`
--
ALTER TABLE `converted_leads`
  MODIFY `converted_leads_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
