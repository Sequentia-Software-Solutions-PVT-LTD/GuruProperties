-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2024 at 12:42 PM
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
-- Database: `guru_seqpro`
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
  `location` text NOT NULL,
  `location_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `login_name`, `login_id`, `login_password`, `login_role`, `type`, `login_photo`, `status`, `location`, `location_id`) VALUES
(1, 'Administrator', 'admin', '$2y$10$62GOdcttnKe4ewxhR3YfiOHb1RK9DScRZgRtC8tf8rTJQnL1rgZK.', 'ADMIN', 'ADMIN', 'default.png', 'Active', '0', NULL),
(2, 'superadmin', 'superadmin', '$2y$10$62GOdcttnKe4ewxhR3YfiOHb1RK9DScRZgRtC8tf8rTJQnL1rgZK.', 'ADMIN', 'SUPERADMIN', 'default.png', 'Active', '0', NULL),
(46, 'Lead Generator', 'leadgenerator', '$2y$10$zpRToYM7QiKHnJQHFX.k8.tUO1Ljy59vNjuRJUjTesASIKwlgxw4i', 'LEAD GENERATOR', 'LEAD GENERATOR', 'default.png', 'Active', '0', NULL),
(49, 'Ross', 'CE-ross', '$2y$10$vWo3ROLsDSnyHGDEjlYOS.Njkmg.FtvDdyI90iPGqGvZelLP8kDB.', 'CUSTOMER EXECUTIVE', 'CUSTOMER EXECUTIVE', 'default.png', 'Active', 'Baner', 13),
(50, 'Joe', 'CE-joe', '$2y$10$Ac0aXsY984YPqXLa3F.lvuPBuXzxnb89PAWBkzV.PKiJTJaCRE5M2', 'CUSTOMER EXECUTIVE', 'CUSTOMER EXECUTIVE', 'default.png', 'Active', 'Bavdhan', 10),
(51, 'Chandu', 'SE-chandu', '$2y$10$/pNPgEuNA7OfW646Go51V.npnysjOehzl2YvLOLcxmxqUDVz63A9y', 'SALES EXECUTIVE', 'SALES EXECUTIVE', 'default.png', 'Active', 'Hadapsar', 5),
(52, 'john', 'SE-john', '$2y$10$Y0OP3p/Pvzu6SmYFOPVaj.CHC4xCKjZOtp6VmB3Kue52I8.sQCpTK', 'SALES EXECUTIVE', 'SALES EXECUTIVE', 'default.png', 'Active', 'Baner', 13),
(53, 'gayatri', 'CE-gayatri', '$2y$10$D3ROCHGMkdGazB7/73cQJOC8KGIm.PxFsKM4t8w0J7ZusssJwR/aK', 'CUSTOMER EXECUTIVE', 'CUSTOMER EXECUTIVE', 'default.png', 'Suspended', 'Baner', 13),
(54, 'Ram', 'CE-ram', '$2y$10$rO58CzDFl8dohtZuEETlFe4iW5ZPfFwYcM7PFSzjSt6mP0RTYjDUm', 'CUSTOMER EXECUTIVE', 'CUSTOMER EXECUTIVE', 'default.png', 'Active', 'Viman Nagar', 12),
(55, 'Seeta', 'SE-seeta', '$2y$10$lk6Vrm7z/kNIXBJfYH.s4.bFU7WoTQTbLwVf7Oqit8I95HducC1cC', 'SALES EXECUTIVE', 'SALES EXECUTIVE', '10.png', 'Active', 'Shivaji Nagar', 8),
(56, 'Bharat', 'CE-bharat', '$2y$10$HMWLX0BVm2Ye4Zv/6MWT8uczoI3gOViyCTK04cinUHA6YZWiScjcu', 'CUSTOMER EXECUTIVE', 'CUSTOMER EXECUTIVE', '5.png', 'Active', 'Hinjewadi', 3);

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
  `admin_request_date` datetime DEFAULT NULL,
  `admin_aproved_date` datetime DEFAULT NULL,
  `request_for_admin` varchar(250) DEFAULT NULL,
  `fresh_lead` int(11) NOT NULL,
  `latitude` text NOT NULL,
  `longitude` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign_leads`
--

INSERT INTO `assign_leads` (`assign_leads_id`, `leads_id`, `admin_id`, `location_id`, `employee_id`, `employee_name`, `assign_employee_type`, `notes`, `remark`, `next_date`, `next_time`, `mark_dead`, `status`, `connection_status`, `lead_type`, `dead_reason`, `transfer_status`, `transfer_employee_id`, `transfer_employee_type`, `transfer_reason`, `lead_date`, `edited_on`, `added_on`, `admin_request_date`, `admin_aproved_date`, `request_for_admin`, `fresh_lead`, `latitude`, `longitude`) VALUES
(1, 3, 50, 10, 2, 'Joe', 'CUSTOMER EXECUTIVE', 'followup sequentia 3 bye CE-Joe', '', '2024-09-05', '15:44:00', '', 'Followup', 'connected', 'hot', NULL, 'Not Available', NULL, NULL, NULL, '2024-09-05', '2024-08-05 15:45:02', '2024-08-05 15:25:18', NULL, NULL, NULL, 1, '', ''),
(2, 4, 50, 10, 2, 'Joe', 'CUSTOMER EXECUTIVE', 'followup test seq4 by CE-joe', '', '2024-09-05', '15:49:00', '', 'Followup', 'connected', 'hot', NULL, 'Not Available', NULL, NULL, NULL, '2024-09-05', '2024-09-05 15:49:46', '2024-09-05 15:25:18', NULL, NULL, NULL, 1, '', ''),
(3, 3, 50, 0, 2, 'Joe', NULL, 'follow up sequentia 3by CE-Joe', '', '2024-09-05', '15:46:00', '', 'Followup', 'connected', 'hot', NULL, 'Not Available', NULL, NULL, NULL, NULL, '2024-09-05 15:46:18', '2024-09-05 15:45:02', NULL, NULL, NULL, 0, '', ''),
(4, 3, 50, 0, 2, 'Joe', NULL, '', '', '2024-09-05', '15:46:00', '', 'Active', NULL, NULL, NULL, 'Transfered', 1, 'CUSTOMER EXECUTIVE', 'Transfer sequentia 3 from CE-joe to CE-ross', NULL, '2024-09-05 15:47:18', '2024-09-05 15:46:18', NULL, NULL, NULL, 0, '', ''),
(5, 3, 49, 0, 1, 'Ross', NULL, 'followup seq3 by CE-ross', '', '2024-09-05', '16:12:00', '', 'Followup', 'connected', 'hot', NULL, 'Not Available', NULL, NULL, NULL, NULL, '2024-09-05 16:12:22', '2024-09-05 15:47:18', '2024-09-05 15:47:18', '2024-09-05 16:06:50', 'Yes', 0, '', ''),
(6, 4, 50, 0, 2, 'Joe', 'SALES EXECUTIVE', '', '', '2024-09-05', '15:49:00', '', 'Assigned', NULL, NULL, NULL, 'Transfered', 2, NULL, NULL, NULL, '2024-09-05 15:53:19', '2024-09-05 15:49:46', NULL, NULL, NULL, 0, '', ''),
(7, 3, 50, 0, 2, 'Ross', 'SALES EXECUTIVE', '', '', '2024-09-05', '16:12:00', '', 'Assigned', NULL, NULL, NULL, 'Transfered', 1, NULL, NULL, NULL, '2024-09-05 16:14:36', '2024-09-05 16:12:22', NULL, NULL, NULL, 0, '', ''),
(8, 19, 50, 13, 2, 'Joe', 'SALES EXECUTIVE', 'followup bye CE-joe for uc', '', '2024-09-20', '12:00:00', '', 'Followup', 'connected', 'warm', NULL, 'Not Available', NULL, NULL, NULL, '2024-09-05', '2024-09-17 11:32:08', '2024-09-05 16:49:53', NULL, NULL, NULL, 1, '73.8567437', '18.5204303'),
(9, 20, 50, 13, 2, 'Joe', 'SALES EXECUTIVE', 'mona 2 followup 1 CE-joe', '', '2024-09-05', '17:38:00', '', 'Followup', 'connected', 'hot', NULL, 'Not Available', NULL, NULL, NULL, '2024-09-05', '2024-09-05 17:38:37', '2024-09-05 16:49:53', NULL, NULL, NULL, 1, '', ''),
(10, 21, 50, 13, 2, 'Joe', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-05', NULL, '2024-09-05 16:49:53', NULL, NULL, NULL, 1, '', ''),
(11, 22, 50, 13, 2, 'Joe', 'SALES EXECUTIVE', '', '', '0000-00-00', NULL, '', 'Assigned', NULL, NULL, NULL, 'Transfered', 2, NULL, NULL, '2024-09-05', '2024-09-05 17:20:55', '2024-09-05 16:49:53', NULL, NULL, NULL, 1, '', ''),
(12, 19, 50, 0, 2, 'Joe', NULL, '', '', '2024-09-05', '16:56:00', '', 'Active', NULL, NULL, NULL, 'Transfered', 1, 'CUSTOMER EXECUTIVE', 'moana 1 Transfer from CE-joe to CE-ross', NULL, '2024-09-05 16:59:40', '2024-09-05 16:56:52', NULL, NULL, NULL, 0, '', ''),
(13, 19, 49, 0, 1, 'Ross', NULL, 'moana followup-1 by CE-ross after transfer', '', '2024-09-05', '17:02:00', '', 'Followup', 'connected', 'hot', NULL, 'Not Available', NULL, NULL, NULL, NULL, '2024-09-05 17:02:52', '2024-09-05 16:59:40', '2024-09-05 16:59:40', '2024-09-05 17:00:48', 'Yes', 0, '', ''),
(14, 19, 49, 0, 1, 'Ross', 'SALES EXECUTIVE', '', '', '2024-09-05', '17:02:00', '', 'Assigned', NULL, NULL, NULL, 'Transfered', 1, NULL, NULL, NULL, '2024-09-05 17:04:18', '2024-09-05 17:02:52', NULL, NULL, NULL, 0, '', ''),
(15, 22, 50, 0, 2, 'Joe', 'Customer EXECUTIVE', '', '', '2024-09-06', '17:22:00', '', 'From SE', NULL, NULL, NULL, 'Admin Pending', 4, 'SALES EXECUTIVE', 'tr moana4 from SE-john to CE-joe', NULL, NULL, '2024-09-05 17:28:21', '2024-09-05 17:28:21', NULL, 'Yes', 0, '', ''),
(16, 20, 50, 0, 2, 'Joe', NULL, '', '', '2024-09-05', '17:38:00', '', 'Active', NULL, NULL, NULL, 'Transfered', 1, 'CUSTOMER EXECUTIVE', 'mona2 Transfer from CE-joe to CE-ross', NULL, '2024-09-05 17:39:25', '2024-09-05 17:38:37', NULL, NULL, NULL, 0, '', ''),
(17, 20, 49, 0, 1, 'Ross', 'SALES EXECUTIVE', '', '', '2024-09-05', '17:39:00', '', 'Assigned', NULL, NULL, NULL, 'Transfered', 1, NULL, NULL, NULL, '2024-09-05 17:41:01', '2024-09-05 17:39:25', '2024-09-05 17:39:25', '2024-09-05 17:39:43', 'Yes', 0, '', ''),
(18, 20, 50, 0, 2, 'Joe', 'SALES EXECUTIVE', '', '', '2024-09-05', '17:44:00', '', 'Assigned', NULL, NULL, NULL, 'Transfered', 2, 'SALES EXECUTIVE', 'moana 2 transfer from SE-john to CE-joe', NULL, '2024-09-05 17:47:25', '2024-09-05 17:45:08', '2024-09-05 17:45:08', '2024-09-05 17:45:28', 'Yes', 0, '', ''),
(19, 24, 49, 13, 1, 'test', NULL, 'notes - not connected ', '', '2024-09-06', '14:08:00', '', 'Followup', 'not_connected', 'hot', NULL, 'Not Available', NULL, NULL, NULL, '2024-09-06', '2024-09-06 13:07:30', '2024-09-06 12:36:35', NULL, NULL, NULL, 1, '', ''),
(20, 24, 49, 0, 1, 'test', NULL, 'notes connected', '', '2024-09-06', '13:20:00', '', 'Followup', 'connected', 'warm', NULL, 'Not Available', NULL, NULL, NULL, NULL, '2024-09-06 13:20:29', '2024-09-06 13:07:30', NULL, NULL, NULL, 0, '', ''),
(21, 24, 49, 0, 1, 'test', NULL, '', '', '2024-09-06', '13:20:00', '', 'Active', NULL, NULL, NULL, 'Transferred', 2, 'CUSTOMER EXECUTIVE', 'Reason For Transfer CE-CE', NULL, '2024-09-06 15:44:20', '2024-09-06 13:20:39', NULL, NULL, NULL, 0, '', ''),
(22, 24, 50, 0, 2, 'Joe', NULL, 'opopopo', '', '2024-09-13', '18:24:00', '', 'Followup', 'connected', 'warm', NULL, 'Not Available', NULL, NULL, NULL, NULL, '2024-09-13 18:24:19', '2024-09-06 15:44:19', '2024-09-06 15:44:29', '2024-09-06 16:08:20', 'yes', 0, '72.9578561', '19.2192248'),
(23, 24, 50, 0, 2, 'Joe', 'SALES EXECUTIVE', '', '', '2024-09-06', '16:30:00', '', 'Assigned', NULL, NULL, NULL, 'Transferred', 3, NULL, NULL, NULL, '2024-09-06 16:39:51', '2024-09-06 16:28:44', NULL, NULL, NULL, 0, '', ''),
(24, 24, 49, 0, 1, 'Ross', 'SALES EXECUTIVE', '', '', '2024-09-06', '19:09:00', '', 'Assigned', NULL, NULL, NULL, 'Transferred', 4, '', 'Reason For Transfer SE-CE', NULL, '2024-09-06 19:19:04', '2024-09-06 19:09:25', '2024-09-06 19:09:25', '2024-09-06 19:16:12', 'yes', 0, '', ''),
(25, 25, 49, 13, 1, 'test', NULL, '', '', '0000-00-00', NULL, 'yes', 'Dead', NULL, NULL, 'Resasdas  askjdkasjhdkas dasdkaskdjaskl', 'Available', NULL, NULL, NULL, '2024-09-06', '2024-09-06 20:26:59', '2024-09-06 20:26:35', NULL, NULL, NULL, 1, '', ''),
(26, 26, 49, 13, 1, 'test', 'SALES EXECUTIVE', '', '', '0000-00-00', NULL, '', 'Assigned', NULL, NULL, NULL, 'Transferred', 3, NULL, NULL, '2024-09-06', '2024-09-06 20:34:18', '2024-09-06 20:33:45', NULL, NULL, NULL, 1, '', ''),
(27, 3, 49, 0, 1, 'Ross', NULL, '', '', '2024-09-10', '10:59:00', '', 'Followup', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, NULL, NULL, '2024-09-10 10:59:17', NULL, NULL, NULL, 0, '20.9977344', '75.563008'),
(28, 3, 50, 0, 2, 'Joe', NULL, '', '', '2024-09-10', '11:07:00', '', 'Transferred', 'connected', NULL, NULL, 'Available', NULL, NULL, NULL, NULL, '2024-09-12 16:14:39', '2024-09-10 11:07:58', '2024-09-10 11:07:58', '2024-09-12 16:14:39', 'yes', 0, '20.9977344', '75.563008'),
(29, 20, 49, 0, 1, 'Ross', NULL, '', '', '2024-09-12', '11:34:00', '', 'Transferred', NULL, NULL, NULL, 'Admin Pending', NULL, NULL, NULL, NULL, NULL, '2024-09-12 11:34:58', '2024-09-12 11:34:58', NULL, 'no', 0, '', ''),
(30, 19, 50, 0, 2, 'Joe', 'Customer EXECUTIVE', '', '', '2024-09-12', '16:30:00', '', 'From SE', NULL, NULL, NULL, 'Admin Pending', 3, 'SALES EXECUTIVE', 'gvdsgshffffffh', NULL, NULL, '2024-09-12 16:30:17', '2024-09-12 16:30:17', NULL, 'no', 0, '', ''),
(31, 24, 56, 0, 8, 'Bharat', 'Customer EXECUTIVE', 'Niranjan For Timeline followup by CE-bharat', '', '2024-09-13', '17:23:00', '', 'Followup', 'connected', 'warm', NULL, 'Not Available', 3, '', 'gdfbds', NULL, '2024-09-13 17:23:58', '2024-09-12 16:39:15', '2024-09-12 16:39:15', NULL, 'no', 0, '72.9578561', '19.2192248'),
(32, 27, 49, 13, 1, 'Ross', NULL, ' testing purpose', '', '2024-09-12', '20:23:00', '', 'Followup', 'connected', 'hot', NULL, 'Not Available', NULL, NULL, NULL, '2024-09-12', '2024-09-12 19:27:24', '2024-09-12 17:54:23', NULL, NULL, NULL, 1, '72.9578561', '19.2192248'),
(33, 28, 49, 13, 1, 'Ross', NULL, ' followup 1 shradha 2 from CE-ross ', '', '2024-09-12', '20:05:00', '', 'Followup', 'connected', 'cold', NULL, 'Not Available', NULL, NULL, NULL, '2024-09-12', '2024-09-12 20:05:28', '2024-09-12 17:54:23', NULL, NULL, NULL, 1, '72.9578561', '19.2192248'),
(34, 27, 49, 0, 1, 'Ross', NULL, '', '', '2024-09-12', '18:17:00', '', 'Followup', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, NULL, NULL, '2024-09-12 18:17:39', NULL, NULL, NULL, 0, '', ''),
(36, 28, 49, 0, 1, 'Ross', 'SALES EXECUTIVE', '', '', '2024-09-12', '20:05:00', '', 'Assigned', NULL, NULL, NULL, 'Transferred', 3, NULL, NULL, NULL, '2024-09-12 20:14:18', '2024-09-12 20:05:28', NULL, NULL, NULL, 0, '', ''),
(37, 29, 49, 13, 1, 'Bharat', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-13', NULL, '2024-09-13 17:16:42', NULL, NULL, NULL, 1, '', ''),
(38, 24, 56, 0, 8, 'Bharat', 'SALES EXECUTIVE', '', '', '2024-09-13', '17:23:00', '', 'Assigned', NULL, NULL, NULL, 'Transferred', 3, NULL, NULL, NULL, '2024-09-13 17:26:15', '2024-09-13 17:23:58', NULL, NULL, NULL, 0, '', ''),
(39, 24, 50, 0, 2, 'Joe', NULL, '', '', '2024-09-13', '18:24:00', '', 'Followup', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, NULL, NULL, '2024-09-13 18:24:19', NULL, NULL, NULL, 0, '', ''),
(40, 19, 50, 0, 2, 'Joe', NULL, '', '', '2024-09-16', NULL, '', 'Followup', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, NULL, NULL, '2024-09-16 10:42:29', NULL, NULL, NULL, 0, '', ''),
(41, 19, 50, 0, 2, 'Joe', NULL, '', '', '2024-09-20', '12:00:00', '', 'Followup', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, NULL, NULL, '2024-09-17 11:32:08', NULL, NULL, NULL, 0, '', '');

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
  `transfer_status` varchar(250) NOT NULL,
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
  `transfer_employee_id` int(10) NOT NULL,
  `transfer_employee_type` varchar(250) NOT NULL,
  `transfer_reason` varchar(250) NOT NULL,
  `edited_on` datetime DEFAULT NULL,
  `added_on` datetime NOT NULL,
  `admin_request_date` datetime DEFAULT NULL,
  `admin_aproved_date` datetime DEFAULT NULL,
  `request_for_admin` varchar(250) DEFAULT NULL,
  `latitude` text NOT NULL,
  `longitude` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign_leads_sr`
--

INSERT INTO `assign_leads_sr` (`assign_leads_sr_id`, `leads_id`, `assign_leads_id`, `lead_date`, `status`, `transfer_status`, `admin_id`, `employee_id`, `employee_name`, `employee_type`, `notes`, `remark`, `connection_status`, `lead_type`, `is_followup`, `followup_or_another_property`, `next_date`, `next_time`, `property_id`, `sub_property_id`, `variant`, `area`, `location1`, `rate`, `visit_done`, `visit_date`, `visit_time`, `visit_notes`, `photo`, `location`, `dead_reason`, `mark_dead`, `convert_lead`, `quotated_price`, `sale_price`, `other_details`, `row_date`, `assign_employee_type`, `assign_employee_id`, `transfer_employee_id`, `transfer_employee_type`, `transfer_reason`, `edited_on`, `added_on`, `admin_request_date`, `admin_aproved_date`, `request_for_admin`, `latitude`, `longitude`) VALUES
(1, 4, 6, NULL, 'Active', 'Transfered', 51, 3, 'Chandu', 'SALES EXECUTIVE', 'todays followup Mehta Properties by SE-chandu', '', 'connected', 'hot', '', NULL, '2024-09-05', '15:54:00', '1', '1', '2', '', 'Baner', '', '', '0000-00-00', '00:00:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 2, 4, 'SALES EXECUTIVE', 'seq4 transfer Se-chandu to Se-john', '2024-09-05 17:13:17', '2024-09-05 15:53:19', NULL, NULL, NULL, '', ''),
(2, 4, 6, NULL, 'Active', 'Transfered', 51, 3, 'Chandu', '', '', '', NULL, NULL, '', 'Follow Up', '2024-09-05', '15:54:00', '1', '1', '2', '', '', '', '', '0000-00-00', '00:00:00', '', 'photos/photo_20240905035544.png', '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 1, 'CUSTOMER EXECUTIVE', 'seq 4 trasnfer from SE-chandu to CE-ross', '2024-09-05 16:02:42', '2024-09-05 15:55:44', NULL, NULL, NULL, '', ''),
(3, 3, 7, NULL, 'Active', 'Transfered', 52, 4, 'john', 'SALES EXECUTIVE', 'notes', '', NULL, NULL, '', NULL, NULL, NULL, '1', '1', '4', '', 'Baner', '', '', '2024-09-05', '16:14:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 1, 3, 'SALES EXECUTIVE', 'seq 3 transfer from SE-john to SE-chandu', '2024-09-05 16:17:44', '2024-09-05 16:14:36', NULL, NULL, NULL, '', ''),
(4, 3, 7, NULL, 'Followup', 'Not Available', 51, 3, 'Chandu', 'SALES EXECUTIVE', 'gggggggg', '', 'connected', 'hot', '', NULL, '2024-09-05', '18:02:00', '1', '1', '4', '', 'Baner', '', '', '0000-00-00', '00:00:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'SALES EXECUTIVE', 4, 0, '', '', '2024-09-05 18:05:30', '2024-09-05 16:17:44', '2024-09-05 16:17:44', '2024-09-05 16:18:54', 'Yes', '', ''),
(5, 19, 14, NULL, 'Followup', 'Not Available', 51, 3, 'Chandu', 'SALES EXECUTIVE', 'moana 1 followup by MT-A 2bhk by SE-chandu', '', 'connected', 'hot', '', NULL, '2024-09-05', '17:07:00', '1', '1', '2', '', 'Baner', '', '', '0000-00-00', '00:00:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 1, 0, '', '', '2024-09-05 17:07:52', '2024-09-05 17:04:18', NULL, NULL, NULL, '', ''),
(6, 19, 14, NULL, 'Active', 'Transfered', 51, 3, 'Chandu', '', '', '', NULL, NULL, '', 'Follow Up', '2024-09-05', '17:07:00', '1', '1', '2', '', '', '', '', '0000-00-00', '00:00:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 2, 'CUSTOMER EXECUTIVE', 'moana 1 transfer from SE-chandu to CE-john', '2024-09-05 17:10:28', '2024-09-05 17:07:52', NULL, NULL, NULL, '', ''),
(7, 4, 6, NULL, 'Active', 'Transfered', 52, 4, 'john', 'SALES EXECUTIVE', '', '', NULL, NULL, '', NULL, '2024-09-05', '17:12:00', '1', '1', '2', '', 'Baner', '', '', NULL, NULL, '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'SALES EXECUTIVE', 3, 2, 'CUSTOMER EXECUTIVE', 'seq4 transfer SE-john to CE-joe', '2024-09-05 17:15:36', '2024-09-05 17:13:17', '2024-09-05 17:13:17', '2024-09-05 17:13:42', 'Yes', '', ''),
(8, 22, 11, NULL, 'Active', 'Transfered', 52, 4, 'john', 'SALES EXECUTIVE', 'fadgfgbf', '', NULL, NULL, '', NULL, NULL, NULL, '1', '1', '4', '', 'Baner', '', '', '2024-09-05', '17:20:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 2, 2, 'CUSTOMER EXECUTIVE', 'tr moana4 from SE-john to CE-joe', '2024-09-05 17:28:21', '2024-09-05 17:20:55', NULL, NULL, NULL, '', ''),
(9, 20, 17, NULL, 'Followup', 'Not Available', 51, 3, 'Chandu', 'SALES EXECUTIVE', 'followup moana2 by SE-chandu', '', 'connected', 'warm', '', NULL, '2024-09-16', NULL, '1', '1', '2', '', 'Baner', '', '', '0000-00-00', '00:00:00', '', 'photos/photo_20240916105204.png', '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 1, 0, '', '', '2024-09-16 10:52:04', '2024-09-05 17:41:01', NULL, NULL, NULL, '18.5204303', '73.8567437'),
(10, 20, 17, NULL, 'Active', 'Transfered', 51, 3, 'Chandu', '', '', '', NULL, NULL, '', 'Follow Up', '2024-09-05', '17:41:00', '1', '1', '2', '', '', '', '', '0000-00-00', '00:00:00', '', 'photos/photo_20240905054200.png', '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 4, 'SALES EXECUTIVE', 'moana2 transfer SE-chandu to SE-john', '2024-09-05 17:43:30', '2024-09-05 17:42:00', NULL, NULL, NULL, '', ''),
(11, 20, 17, NULL, 'Active', 'Transfered', 52, 4, 'john', 'SALES EXECUTIVE', '', '', NULL, NULL, '', NULL, '2024-09-05', '17:43:00', '1', '1', '2', '', '', '', '', NULL, NULL, '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'SALES EXECUTIVE', 3, 2, 'CUSTOMER EXECUTIVE', 'moana 2 transfer from SE-john to CE-joe', '2024-09-05 17:45:08', '2024-09-05 17:43:30', '2024-09-05 17:43:30', '2024-09-05 17:43:46', 'Yes', '', ''),
(12, 20, 18, NULL, 'Converted', 'Converted', 51, 3, 'Chandu', 'SALES EXECUTIVE', 'notefgs', '', NULL, NULL, '', NULL, NULL, NULL, '1', '1', '2', '', 'Baner', '', '', '2024-09-05', '17:47:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 2, 0, '', '', '2024-09-05 17:49:01', '2024-09-05 17:47:25', NULL, NULL, NULL, '', ''),
(13, 3, 7, NULL, 'Followup', 'Available', 51, 3, 'Chandu', '', '', '', NULL, NULL, '', 'Follow Up', '2024-09-05', '18:02:00', '1', '1', '4', '', '', '', '', '0000-00-00', '00:00:00', '', 'photos/photo_20240905060530.png', '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 0, '', '', NULL, '2024-09-05 18:05:30', NULL, NULL, NULL, '', ''),
(14, 24, 23, NULL, 'Followup', 'Not Available', 51, 3, 'Chandu', 'SALES EXECUTIVE', 'customer not visited on site due to some reason.', '', 'not_connected', 'cold', '', NULL, '2024-09-06', '17:02:00', '1', '1', '1,2,4', '', 'Baner', '', '', '0000-00-00', '00:00:00', '', 'photos/photo_20240906050006.png', '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 2, 0, '', '', '2024-09-06 17:00:06', '2024-09-06 16:39:59', NULL, NULL, NULL, '', ''),
(15, 24, 23, NULL, 'Followup', 'Not Available', 51, 3, 'Chandu', '', 'Customer is interested in another property', '', 'connected', 'hot', '', 'Follow Up', '0000-00-00', '00:00:00', '1', '1', '1,2,4', '', '', '', '', '2024-09-06', '17:22:00', '', 'photos/photo_20240906052245.png', '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 0, '', '', '2024-09-06 17:22:45', '2024-09-06 17:00:06', NULL, NULL, NULL, '', ''),
(16, 24, 23, NULL, 'Active', 'Transferred', 51, 3, 'Chandu', '', '', '', NULL, NULL, '', 'Another Property', '0000-00-00', '00:00:00', '1', '1', '1,2', '', '', '', '', '2024-09-06', '17:22:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 4, 'SALES EXECUTIVE', 'Reason For Transfer SE-SE', '2024-09-06 18:28:40', '2024-09-06 17:22:46', NULL, NULL, NULL, '', ''),
(17, 24, 23, NULL, 'Followup', 'Not Available', 52, 4, 'john', 'SALES EXECUTIVE', 'Visited for SE-SE', '', 'connected', 'hot', '', NULL, '2024-09-06', '19:06:00', '1', '1', '1,2', '', '', '', '', '0000-00-00', '00:00:00', '', 'photos/photo_20240906070553.png', '', '', '', '', '', '', '', '0000-00-00', 'SALES EXECUTIVE', 3, 0, '', '', '2024-09-06 19:05:53', '2024-09-06 18:28:42', '2024-09-06 18:28:42', '2024-09-06 18:53:20', 'yes', '', ''),
(18, 24, 23, NULL, 'Active', 'Transferred', 52, 4, 'john', '', '', '', NULL, NULL, '', 'Follow Up', '2024-09-06', '19:06:00', '1', '1', '1,2', '', '', '', '', '0000-00-00', '00:00:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 1, 'CUSTOMER EXECUTIVE', 'Reason For Transfer SE-CE', '2024-09-06 19:09:25', '2024-09-06 19:05:53', NULL, NULL, NULL, '', ''),
(19, 24, 24, NULL, 'Converted', 'Converted', 52, 4, 'john', 'SALES EXECUTIVE', 'from CE-SE', '', NULL, NULL, '', NULL, NULL, NULL, '1', '1', '5', '', 'Baner', '', '', '2024-09-06', '19:19:10', '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 1, 0, '', '', '2024-09-06 19:28:26', '2024-09-06 19:19:14', NULL, NULL, NULL, '', ''),
(20, 26, 26, NULL, 'Dead', 'Dead', 51, 3, 'Chandu', 'SALES EXECUTIVE', 'notes', '', NULL, NULL, '', NULL, NULL, NULL, '1', '1', '5', '', 'Baner', '', '', '2024-09-06', '20:35:00', '', NULL, '', 'dead by ce', 'Yes', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 1, 0, '', '', '2024-09-06 20:34:42', '2024-09-06 20:34:18', NULL, NULL, NULL, '', ''),
(21, 19, 14, NULL, 'Transferred', 'Available', 55, 7, 'Seeta', 'SALES EXECUTIVE', '', '', NULL, NULL, '', NULL, '2024-09-12', '16:46:00', '1', '1', '2', '', '', '', '', NULL, NULL, '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'SALES EXECUTIVE', 3, 0, '', '', '2024-09-12 20:03:58', '2024-09-12 16:46:43', '2024-09-12 16:46:43', '2024-09-12 20:03:58', 'yes', '', ''),
(22, 3, 7, NULL, 'Transferred', 'Available', 52, 4, 'john', 'SALES EXECUTIVE', '', '', NULL, NULL, '', NULL, '2024-09-12', '16:49:00', '1', '1', '4', '', 'Baner', '', '', NULL, NULL, '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'SALES EXECUTIVE', 3, 0, '', '', '2024-09-12 20:04:02', '2024-09-12 16:49:45', '2024-09-12 16:49:45', '2024-09-12 20:04:02', 'yes', '', ''),
(23, 28, 36, NULL, 'Followup', 'Not Available', 51, 3, 'Chandu', 'SALES EXECUTIVE', 'Sharada 2 followup-1 by chandu', '', 'connected', 'cold', '', NULL, '2024-09-12', '20:31:00', '1', '1', '6', '', 'Baner', '', '', '0000-00-00', '00:00:00', '', 'photos/photo_20240912083113.png', '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 1, 0, '', '', '2024-09-12 20:31:13', '2024-09-12 20:14:18', NULL, NULL, NULL, '19.2192248', '72.9578561'),
(24, 28, 36, NULL, 'Active', 'Transferred', 51, 3, 'Chandu', '', '', '', NULL, NULL, '', 'Follow Up', '2024-09-12', '20:31:00', '1', '1', '6', '', '', '', '', '0000-00-00', '00:00:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 4, 'SALES EXECUTIVE', 'shradha 2 transfer by SE-chandu to SE-john', '2024-09-12 20:32:08', '2024-09-12 20:31:13', NULL, NULL, NULL, '', ''),
(25, 28, 36, NULL, 'Transferred', 'Admin Pending', 52, 4, 'john', 'SALES EXECUTIVE', '', '', NULL, NULL, '', NULL, '2024-09-12', '20:31:00', '1', '1', '6', '', '', '', '', NULL, NULL, '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'SALES EXECUTIVE', 3, 0, '', '', NULL, '2024-09-12 20:32:08', '2024-09-12 20:32:08', NULL, 'no', '', ''),
(26, 24, 38, NULL, 'Active', 'Available', 51, 3, 'Chandu', 'SALES EXECUTIVE', 'jkjkkjkjkj', '', NULL, NULL, '', NULL, NULL, NULL, '1', '1', '3', '', 'Baner', '', '', '2024-09-13', '17:26:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 8, 0, '', '', NULL, '2024-09-13 17:26:15', NULL, NULL, NULL, '', ''),
(27, 20, 17, NULL, 'Followup', 'Available', 51, 3, 'Chandu', '', '', '', NULL, NULL, '', 'Follow Up', '2024-09-16', NULL, '1', '1', '2', '', '', '', '', '0000-00-00', '00:00:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 0, '', '', NULL, '2024-09-16 10:52:04', NULL, NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(10) NOT NULL,
  `login_id` int(10) NOT NULL,
  `login_name` varchar(250) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(250) NOT NULL,
  `added_on` datetime NOT NULL,
  `latitude` text NOT NULL,
  `longitude` text NOT NULL,
  `accuracy` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `login_id`, `login_name`, `date`, `time`, `status`, `added_on`, `latitude`, `longitude`, `accuracy`) VALUES
(3, 50, 'Joe', '2024-09-10', '13:23:31', 'Logged In', '2024-09-10 13:23:31', '19.2192248', '72.9578561', '1251.6769115364737'),
(4, 50, 'Joe', '2024-09-10', '13:23:48', 'Logged Out', '2024-09-10 13:23:48', '19.2192248', '72.9578561', '1251.6769115364737'),
(5, 49, 'Ross', '2024-09-10', '13:25:08', 'Logged In', '2024-09-10 13:25:08', '19.2192248', '72.9578561', '1251.6769115364737'),
(6, 49, 'Ross', '2024-09-10', '13:28:31', 'Logged Out', '2024-09-10 13:28:31', '19.2192248', '72.9578561', '1251.6769115364737'),
(7, 50, 'Joe', '2024-09-10', '19:22:45', 'Logged In', '2024-09-10 19:22:45', '19.2192248', '72.9578561', '1251.6769115364737'),
(8, 50, 'Joe', '2024-09-10', '20:59:24', 'Logged Out', '2024-09-10 20:59:24', '19.2192248', '72.9578561', '1251.6769115364737'),
(9, 50, 'Joe', '2024-09-10', '20:59:53', 'Logged In', '2024-09-10 20:59:53', '19.2192248', '72.9578561', '1251.6769115364737'),
(10, 50, 'Joe', '2024-09-12', '11:25:14', 'Logged Out', '2024-09-12 11:25:14', '19.2192248', '72.9578561', '1251.6769115364737'),
(11, 49, 'Ross', '2024-09-12', '11:32:17', 'Logged In', '2024-09-12 11:32:17', '19.2192248', '72.9578561', '1251.6769115364737'),
(12, 49, 'Ross', '2024-09-12', '11:32:43', 'Logged Out', '2024-09-12 11:32:43', '19.2192248', '72.9578561', '1251.6769115364737'),
(13, 50, 'Joe', '2024-09-12', '11:32:52', 'Logged In', '2024-09-12 11:32:52', '19.2192248', '72.9578561', '1251.6769115364737'),
(14, 50, 'Joe', '2024-09-12', '11:59:02', 'Logged Out', '2024-09-12 11:59:02', '19.2192248', '72.9578561', '1251.6769115364737'),
(15, 55, 'Seeta', '2024-09-12', '12:00:52', 'Logged In', '2024-09-12 12:00:52', '19.2192248', '72.9578561', '1251.6769115364737'),
(16, 55, 'Seeta', '2024-09-12', '12:24:20', 'Logged Out', '2024-09-12 12:24:20', '19.2192248', '72.9578561', '1251.6769115364737'),
(17, 50, 'Joe', '2024-09-12', '12:37:21', 'Logged In', '2024-09-12 12:37:21', '19.2192248', '72.9578561', '1251.6769115364737'),
(18, 50, 'Joe', '2024-09-12', '13:15:26', 'Logged Out', '2024-09-12 13:15:26', '19.2192248', '72.9578561', '1251.6769115364737'),
(19, 51, 'Chandu', '2024-09-12', '13:15:56', 'Logged In', '2024-09-12 13:15:56', '19.2192248', '72.9578561', '1251.6769115364737'),
(20, 51, 'Chandu', '2024-09-12', '13:19:21', 'Logged Out', '2024-09-12 13:19:21', '19.2192248', '72.9578561', '1251.6769115364737'),
(21, 50, 'Joe', '2024-09-12', '14:23:37', 'Logged In', '2024-09-12 14:23:37', '19.2192248', '72.9578561', '1251.6769115364737'),
(22, 50, 'Joe', '2024-09-12', '14:48:34', 'Logged In', '2024-09-12 14:48:34', '19.2192248', '72.9578561', '1251.6769115364737'),
(23, 50, 'Joe', '2024-09-12', '15:10:16', 'Logged Out', '2024-09-12 15:10:16', '19.2192248', '72.9578561', '1251.6769115364737'),
(24, 49, 'Ross', '2024-09-12', '15:10:41', 'Logged In', '2024-09-12 15:10:41', '19.2192248', '72.9578561', '1251.6769115364737'),
(25, 49, 'Ross', '2024-09-12', '15:23:32', 'Logged Out', '2024-09-12 15:23:32', '19.2192248', '72.9578561', '1251.6769115364737'),
(26, 50, 'Joe', '2024-09-12', '16:07:22', 'Logged Out', '2024-09-12 16:07:22', '19.2192248', '72.9578561', '1251.6769115364737'),
(27, 54, 'Ram', '2024-09-12', '16:07:33', 'Logged In', '2024-09-12 16:07:33', '19.2192248', '72.9578561', '1251.6769115364737'),
(28, 54, 'Ram', '2024-09-12', '16:07:58', 'Logged Out', '2024-09-12 16:07:58', '19.2192248', '72.9578561', '1251.6769115364737'),
(29, 56, 'Bharat', '2024-09-12', '16:08:07', 'Logged In', '2024-09-12 16:08:07', '19.2192248', '72.9578561', '1251.6769115364737'),
(30, 56, 'Bharat', '2024-09-12', '16:15:26', 'Logged Out', '2024-09-12 16:15:26', '19.2192248', '72.9578561', '1251.6769115364737'),
(31, 50, 'Joe', '2024-09-12', '16:15:51', 'Logged In', '2024-09-12 16:15:51', '19.2192248', '72.9578561', '1251.6769115364737'),
(32, 50, 'Joe', '2024-09-12', '16:29:25', 'Logged Out', '2024-09-12 16:29:25', '19.2169996', '72.9602542', '20.288'),
(33, 51, 'Chandu', '2024-09-12', '16:29:34', 'Logged In', '2024-09-12 16:29:34', '19.2169996', '72.9602542', '20.288'),
(34, 51, 'Chandu', '2024-09-12', '17:51:48', 'Logged Out', '2024-09-12 17:51:48', '19.2192248', '72.9578561', '1251.6769115364737'),
(35, 50, 'Joe', '2024-09-12', '17:56:35', 'Logged In', '2024-09-12 17:56:35', '19.2192248', '72.9578561', '1251.6769115364737'),
(36, 50, 'Joe', '2024-09-12', '17:57:14', 'Logged Out', '2024-09-12 17:57:14', '19.2192248', '72.9578561', '1251.6769115364737'),
(37, 49, 'Ross', '2024-09-12', '17:57:31', 'Logged In', '2024-09-12 17:57:31', '19.2192248', '72.9578561', '1251.6769115364737'),
(38, 51, 'Chandu', '2024-09-12', '19:35:44', 'Logged In', '2024-09-12 19:35:44', '19.2192248', '72.9578561', '1251.6769115364737'),
(39, 51, 'Chandu', '2024-09-12', '19:53:22', 'Logged Out', '2024-09-12 19:53:22', '19.2192248', '72.9578561', '1251.6769115364737'),
(40, 50, 'Joe', '2024-09-12', '19:53:34', 'Logged In', '2024-09-12 19:53:34', '19.2192248', '72.9578561', '1251.6769115364737'),
(41, 49, 'Ross', '2024-09-12', '20:02:54', 'Logged Out', '2024-09-12 20:02:54', '19.2192248', '72.9578561', '1251.6769115364737'),
(42, 50, 'Joe', '2024-09-12', '20:04:25', 'Logged Out', '2024-09-12 20:04:25', '19.2192248', '72.9578561', '1251.6769115364737'),
(43, 49, 'Ross', '2024-09-12', '20:04:38', 'Logged In', '2024-09-12 20:04:38', '19.2192248', '72.9578561', '1251.6769115364737'),
(44, 49, 'Ross', '2024-09-12', '20:14:43', 'Logged Out', '2024-09-12 20:14:43', '19.2192248', '72.9578561', '1251.6769115364737'),
(45, 51, 'Chandu', '2024-09-12', '20:14:52', 'Logged In', '2024-09-12 20:14:52', '19.2192248', '72.9578561', '1251.6769115364737'),
(46, 51, 'Chandu', '2024-09-12', '20:32:22', 'Logged Out', '2024-09-12 20:32:22', '19.2192248', '72.9578561', '1251.6769115364737'),
(47, 52, 'john', '2024-09-12', '20:32:31', 'Logged In', '2024-09-12 20:32:31', '19.2192248', '72.9578561', '1251.6769115364737'),
(48, 50, 'Joe', '2024-09-12', '21:12:34', 'Logged In', '2024-09-12 21:12:34', '19.2192248', '72.9578561', '1251.6769115364737'),
(49, 52, 'john', '2024-09-12', '21:13:41', 'Logged Out', '2024-09-12 21:13:41', '19.2192248', '72.9578561', '1251.6769115364737'),
(50, 50, 'Joe', '2024-09-12', '21:28:50', 'Logged In', '2024-09-12 21:28:50', '19.2192248', '72.9578561', '1251.6769115364737'),
(51, 50, 'Joe', '2024-09-12', '21:34:46', 'Logged Out', '2024-09-12 21:34:46', '19.2192248', '72.9578561', '1251.6769115364737'),
(52, 50, 'Joe', '2024-09-13', '11:18:26', 'Logged In', '2024-09-13 11:18:26', '19.2192248', '72.9578561', '1251.6769115364737'),
(53, 50, 'Joe', '2024-09-13', '11:35:56', 'Logged Out', '2024-09-13 11:35:56', '19.2192248', '72.9578561', '1251.6769115364737'),
(54, 51, 'Chandu', '2024-09-13', '11:36:07', 'Logged In', '2024-09-13 11:36:07', '19.2192248', '72.9578561', '1251.6769115364737'),
(55, 51, 'Chandu', '2024-09-13', '17:12:54', 'Logged Out', '2024-09-13 17:12:54', '19.2192248', '72.9578561', '1251.6769115364737'),
(56, 56, 'Bharat', '2024-09-13', '17:21:25', 'Logged In', '2024-09-13 17:21:25', '19.2192248', '72.9578561', '1251.6769115364737'),
(57, 56, 'Bharat', '2024-09-13', '18:20:30', 'Logged Out', '2024-09-13 18:20:30', '19.2192248', '72.9578561', '1251.6769115364737'),
(58, 50, 'Joe', '2024-09-13', '18:20:37', 'Logged In', '2024-09-13 18:20:37', '19.2192248', '72.9578561', '1251.6769115364737'),
(59, 50, 'Joe', '2024-09-13', '18:28:11', 'Logged Out', '2024-09-13 18:28:11', '19.2192248', '72.9578561', '1251.6769115364737'),
(60, 51, 'Chandu', '2024-09-13', '18:28:24', 'Logged In', '2024-09-13 18:28:24', '19.2192248', '72.9578561', '1251.6769115364737'),
(61, 51, 'Chandu', '2024-09-13', '18:43:23', 'Logged Out', '2024-09-13 18:43:23', '19.2192248', '72.9578561', '1251.6769115364737'),
(62, 50, 'Joe', '2024-09-13', '18:43:31', 'Logged In', '2024-09-13 18:43:31', '19.2192248', '72.9578561', '1251.6769115364737'),
(63, 50, 'Joe', '2024-09-13', '19:21:00', 'Logged Out', '2024-09-13 19:21:00', '19.2192248', '72.9578561', '1251.6769115364737'),
(64, 51, 'Chandu', '2024-09-13', '19:21:08', 'Logged In', '2024-09-13 19:21:08', '19.2192248', '72.9578561', '1251.6769115364737'),
(65, 51, 'Chandu', '2024-09-13', '19:38:03', 'Logged Out', '2024-09-13 19:38:03', '19.2192248', '72.9578561', '1251.6769115364737'),
(66, 50, 'Joe', '2024-09-13', '19:38:11', 'Logged In', '2024-09-13 19:38:11', '19.2192248', '72.9578561', '1251.6769115364737'),
(67, 50, 'Joe', '2024-09-16', '10:41:33', 'Logged In', '2024-09-16 10:41:33', '18.5204303', '73.8567437', '361518.3267508434'),
(68, 50, 'Joe', '2024-09-16', '10:50:18', 'Logged Out', '2024-09-16 10:50:18', '18.5204303', '73.8567437', '361518.3267508434'),
(69, 51, 'Chandu', '2024-09-16', '10:50:28', 'Logged In', '2024-09-16 10:50:28', '18.5204303', '73.8567437', '361518.3267508434'),
(70, 51, 'Chandu', '2024-09-16', '11:17:29', 'Logged Out', '2024-09-16 11:17:29', '18.5204303', '73.8567437', '361518.3267508434'),
(71, 50, 'Joe', '2024-09-16', '11:17:36', 'Logged In', '2024-09-16 11:17:36', '18.5204303', '73.8567437', '361518.3267508434'),
(72, 50, 'Joe', '2024-09-16', '15:51:58', 'Logged In', '2024-09-16 15:51:58', '18.552553', '73.755737', '389'),
(73, 50, 'Joe', '2024-09-16', '15:53:54', 'Logged Out', '2024-09-16 15:53:54', '18.5892864', '73.7247232', '356273.32215163816'),
(74, 50, 'Joe', '2024-09-16', '16:34:47', 'Logged In', '2024-09-16 16:34:47', '18.5504508', '73.7531619', '32.099'),
(75, 50, 'Joe', '2024-09-16', '16:41:09', 'Logged In', '2024-09-16 16:41:09', '18.5892864', '73.7247232', '356273.32215163816'),
(76, 50, 'Joe', '2024-09-16', '17:24:18', 'Logged Out', '2024-09-16 17:24:18', '18.5892864', '73.7247232', '356273.32215163816'),
(77, 52, 'john', '2024-09-16', '17:24:24', 'Logged In', '2024-09-16 17:24:24', '18.5892864', '73.7247232', '356273.32215163816'),
(78, 50, 'Joe', '2024-09-16', '18:18:04', 'Logged Out', '2024-09-16 18:18:04', '18.5892864', '73.7247232', '356273.32215163816'),
(79, 52, 'john', '2024-09-16', '18:18:16', 'Logged In', '2024-09-16 18:18:16', '18.5892864', '73.7247232', '356273.32215163816'),
(80, 52, 'john', '2024-09-17', '11:07:15', 'Logged Out', '2024-09-17 11:07:15', '18.5204303', '73.8567437', '357645.55210257374'),
(81, 50, 'Joe', '2024-09-17', '11:29:02', 'Logged In', '2024-09-17 11:29:02', '18.5204303', '73.8567437', '357645.55210257374'),
(82, 52, 'john', '2024-09-17', '15:24:31', 'Logged Out', '2024-09-17 15:24:31', '18.6604545', '73.900709', '333432.02208955254'),
(83, 50, 'Joe', '2024-09-17', '15:24:40', 'Logged In', '2024-09-17 15:24:40', '18.6604545', '73.900709', '333432.02208955254'),
(84, 50, 'Joe', '2024-09-17', '16:17:36', 'Logged Out', '2024-09-17 16:17:36', '18.5504387', '73.7531453', '31.819'),
(85, 52, 'john', '2024-09-17', '16:17:48', 'Logged In', '2024-09-17 16:17:48', '18.5504387', '73.7531453', '31.819'),
(86, 52, 'john', '2024-09-17', '17:57:56', 'Logged Out', '2024-09-17 17:57:56', '18.5729024', '73.793536', '358267.5303262672'),
(87, 50, 'Joe', '2024-09-17', '17:58:10', 'Logged In', '2024-09-17 17:58:10', '18.5729024', '73.793536', '358267.5303262672');

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
  `contact_person_name` varchar(250) DEFAULT NULL,
  `contact_person_phone` varchar(50) DEFAULT NULL,
  `property_name_id` int(10) NOT NULL,
  `property_tower_id` int(10) NOT NULL,
  `property_variants` varchar(250) NOT NULL,
  `notes` text NOT NULL,
  `agreement_value` int(10) NOT NULL,
  `registrantion` int(10) NOT NULL,
  `gst` int(10) NOT NULL,
  `stamp_duty` int(10) NOT NULL,
  `commission` int(10) NOT NULL,
  `quoted_price` int(10) NOT NULL,
  `sale_price` int(10) NOT NULL,
  `added_on` datetime NOT NULL,
  `edited_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `converted_leads`
--

INSERT INTO `converted_leads` (`converted_leads_id`, `assign_leads_sr_id`, `leads_id`, `admin_id`, `employee_id`, `employee_name`, `contact_person_name`, `contact_person_phone`, `property_name_id`, `property_tower_id`, `property_variants`, `notes`, `agreement_value`, `registrantion`, `gst`, `stamp_duty`, `commission`, `quoted_price`, `sale_price`, `added_on`, `edited_on`) VALUES
(1, 12, 20, 51, 3, 'Chandu', NULL, NULL, 1, 1, '2', 'notes bbbbb', 20, 20, 20, 20, 20, 20, 20, '2024-09-05 17:49:01', '0000-00-00 00:00:00'),
(2, 19, 24, 52, 4, 'john', NULL, NULL, 1, 1, '5', 'notes converted', 5676561, 345542, 79000, 7865432, 10, 123567, 2147483647, '2024-09-06 19:28:36', '0000-00-00 00:00:00');

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
  `location` text NOT NULL,
  `location_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `admin_id`, `employee_name`, `user_id`, `designation`, `cell_no`, `email_id`, `password`, `added_on`, `status`, `login_photo`, `login_role`, `department`, `edited_on`, `location`, `location_id`) VALUES
(1, 49, 'Ross', 'CE-ross', 'Employee', '9898989898', 'ross@gamil.com', '$2y$10$vWo3ROLsDSnyHGDEjlYOS.Njkmg.FtvDdyI90iPGqGvZelLP8kDB.', '2024-09-05 14-45-43', 'Active', '5.png', 'CUSTOMER EXECUTIVE', '', '0000-00-00 00:00:00', 'Baner', 13),
(2, 50, 'Joe', 'CE-joe', 'Employee', '8989898989', 'joe@gamil.com', '$2y$10$Ac0aXsY984YPqXLa3F.lvuPBuXzxnb89PAWBkzV.PKiJTJaCRE5M2', '2024-09-05 14-46-21', 'Active', '5.png', 'CUSTOMER EXECUTIVE', '', '2024-09-12 17:56:59', 'Bavdhan', 10),
(3, 51, 'Chandu', 'SE-chandu', 'Employee', '7676767676', 'chandu@gmail.com', '$2y$10$/pNPgEuNA7OfW646Go51V.npnysjOehzl2YvLOLcxmxqUDVz63A9y', '2024-09-05 14-46-58', 'Active', '5.png', 'SALES EXECUTIVE', '', '2024-09-05 14:50:41', 'Hadapsar', 5),
(4, 52, 'john', 'SE-john', 'Employee', '6767676767', 'john@gamil.com', '$2y$10$Y0OP3p/Pvzu6SmYFOPVaj.CHC4xCKjZOtp6VmB3Kue52I8.sQCpTK', '2024-09-05 14-47-34', 'Active', '5.png', 'SALES EXECUTIVE', '', '0000-00-00 00:00:00', 'Baner', 13),
(5, 53, 'gayatri', 'CE-gayatri', 'Employee', '98989898', 'seqtest@demo.com', '$2y$10$D3ROCHGMkdGazB7/73cQJOC8KGIm.PxFsKM4t8w0J7ZusssJwR/aK', '2024-09-10 14-07-47', 'Suspended', '10.png', 'CUSTOMER EXECUTIVE', '', '2024-09-10 15:01:47', 'Baner', 13),
(6, 54, 'Ram', 'CE-ram', 'Employee', '98989898', 'seqtest@demo.com', '$2y$10$rO58CzDFl8dohtZuEETlFe4iW5ZPfFwYcM7PFSzjSt6mP0RTYjDUm', '2024-09-10 14-30-30', 'Active', '5.png', 'CUSTOMER EXECUTIVE', '', '0000-00-00 00:00:00', 'Viman Nagar', 12),
(7, 55, 'Seeta', 'SE-seeta', 'Employee', '98989898', 'seeta@gmail.com', '$2y$10$lk6Vrm7z/kNIXBJfYH.s4.bFU7WoTQTbLwVf7Oqit8I95HducC1cC', '2024-09-12 11-57-00', 'Active', '10.png', 'SALES EXECUTIVE', '', '0000-00-00 00:00:00', 'Shivaji Nagar', 8),
(8, 56, 'Bharat', 'CE-bharat', 'Employee', '9898989878', 'seqtest@demo.com', '$2y$10$HMWLX0BVm2Ye4Zv/6MWT8uczoI3gOViyCTK04cinUHA6YZWiScjcu', '2024-09-12 12-08-53', 'Active', '5.png', 'CUSTOMER EXECUTIVE', '', '0000-00-00 00:00:00', 'Hinjewadi', 3);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `month`, `lead_gen_date`, `budget_range`, `flat_size`, `location`, `lead_name`, `phone_no`, `email_id`, `called_by`, `call_outcome`, `connected_outcome`, `remark`, `source`, `status`, `other_details`, `added_on`, `edited_on`, `assign_lead_id`) VALUES
(1, '', '2024-09-05', '16000000', '', '13', 'sequentia 1', '989898989', 'seq1@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-09-05 15:25:17', '0000-00-00 00:00:00', 0),
(2, '', '2024-09-05', '5000000', '', '13', 'sequentia 2', '56565656566', 'seq2@gamil.com', '', '', '', '', '99M', 'Active', '', '2024-09-05 15:25:18', '0000-00-00 00:00:00', 0),
(3, '', '2024-09-05', '8000000', '', '10', 'sequentia 3', '78978897897', 'seq3@gamil.com', '', '', '', '', '99A1', 'Assigned', '', '2024-09-05 15:25:18', '0000-00-00 00:00:00', 1),
(4, '', '2024-09-05', '10000000', '', '10', 'sequentia 4', '9000000001', 'seq4@gamil.com', '', '', '', '', '99S', 'Assigned', '', '2024-09-05 15:25:18', '0000-00-00 00:00:00', 2),
(5, '', '2024-09-05', '16000000', '', '13', 'Gavatri 1', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-09-05 16:32:47', '0000-00-00 00:00:00', 0),
(6, '', '2024-09-05', '4000000', '', '13', 'Gavatri 2', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-09-05 16:32:47', '0000-00-00 00:00:00', 0),
(7, '', '2024-09-05', '3000000', '', '13', 'Gavatri 3', '78978897897', 'amol@gamil.com', '', '', '', '', '99M', 'Active', '', '2024-09-05 16:32:47', '0000-00-00 00:00:00', 0),
(8, '', '2024-09-05', '7000000', '', '13', 'Gavatri 4', '9000000001', 'amol@gamil.com', '', '', '', '', '99A1', 'Active', '', '2024-09-05 16:32:47', '0000-00-00 00:00:00', 0),
(9, '', '2024-09-05', '10000000', '', '13', 'Gavatri 5', '989898989', 'amol@gamil.com', '', '', '', '', '99A8', 'Active', '', '2024-09-05 16:32:47', '0000-00-00 00:00:00', 0),
(10, '', '2024-09-05', '16000000', '', '13', 'Raj 1', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-09-05 16:35:46', '0000-00-00 00:00:00', 0),
(11, '', '2024-09-05', '5000000', '', '13', 'Raj 2', '78978897897', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-09-05 16:35:46', '0000-00-00 00:00:00', 0),
(12, '', '2024-09-05', '3000000', '', '13', 'Raj 3', '9000000001', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-09-05 16:35:46', '0000-00-00 00:00:00', 0),
(13, '', '2024-09-05', '4000000', '', '13', 'Raj 4', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-09-05 16:35:46', '0000-00-00 00:00:00', 0),
(14, '', '2024-09-05', '10000000', '', '13', 'Raj 5', '9000000001', 'amol@gamil.com', '', '', '', '', '99S', 'Active', '', '2024-09-05 16:35:46', '0000-00-00 00:00:00', 0),
(15, '', '2024-09-05', '16000000', '', '13', 'Moana 1', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-09-05 16:37:29', '0000-00-00 00:00:00', 0),
(16, '', '2024-09-05', '6000000', '', '13', 'Moana 2', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-09-05 16:37:29', '0000-00-00 00:00:00', 0),
(17, '', '2024-09-05', '7000000', '', '13', 'Moana 3', '989898989', 'amol@gamil.com', '', '', '', '', '99M', 'Active', '', '2024-09-05 16:37:29', '0000-00-00 00:00:00', 0),
(18, '', '2024-09-05', '11000000', '', '13', 'Moana 4', '989898989', 'amol@gamil.com', '', '', '', '', '99A1', 'Active', '', '2024-09-05 16:37:29', '0000-00-00 00:00:00', 0),
(19, '', '2024-09-05', '16000000', '', '13', 'Moana 1', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Assigned', '', '2024-09-05 16:49:53', '0000-00-00 00:00:00', 8),
(20, '', '2024-09-05', '6000000', '', '13', 'Moana 2', '989898989', 'amol@gamil.com', '', '', '', '', '99A', 'Assigned', '', '2024-09-05 16:49:53', '0000-00-00 00:00:00', 9),
(21, '', '2024-09-05', '7000000', '', '13', 'Moana 3', '989898989', 'amol@gamil.com', '', '', '', '', '99M', 'Assigned', '', '2024-09-05 16:49:53', '0000-00-00 00:00:00', 10),
(22, '', '2024-09-05', '11000000', '', '13', 'Moana 4', '989898989', 'amol@gamil.com', '', '', '', '', '99A1', 'Assigned', '', '2024-09-05 16:49:53', '0000-00-00 00:00:00', 11),
(24, '', '2024-09-06', '9000000', '', '13', 'Niranjan For Timeline', '98765432345', 'niranjanchaudhari12@gmail.com', '', '', '', '', '99a', 'Assigned', '', '2024-09-06 12:36:35', '0000-00-00 00:00:00', 19),
(25, '', '2024-09-06', '15000000', '', '13', 'Tset', 'asdasdasdas', 'test@test.com', '', '', '', '', 'asdas', 'Assigned', '', '2024-09-06 20:26:35', '0000-00-00 00:00:00', 25),
(26, '', '2024-09-06', '14000000', '', '13', 'asdfghjkl', '9876543234', 'asdyuiytdfcv', '', '', '', '', '99a', 'Assigned', '', '2024-09-06 20:33:45', '0000-00-00 00:00:00', 26),
(27, '', '2024-09-12', '14000000', '', '13', 'Sharada 1', '8786786789', 'amol@gamil.com', '', '', '', '', '99A1', 'Assigned', '', '2024-09-12 17:54:23', '0000-00-00 00:00:00', 32),
(28, '', '2024-09-12', '7000000', '', '13', 'Sharada 2', '7897889789', 'mrunal@gamil.com', '', '', '', '', '99S', 'Assigned', '', '2024-09-12 17:54:23', '0000-00-00 00:00:00', 33),
(29, '', '2024-09-13', '16000000', '', '13', 'Preeti 1', '9898989899', 'amol@gamil.com', '', '', '', '', '99A1', 'Assigned', '', '2024-09-13 17:16:42', '0000-00-00 00:00:00', 37),
(30, '', '2024-09-13', '4000000', '', '15', 'Preeti 2', '9898989899', 'mayur@gamil.com', '', '', '', '', '99A', 'Active', '', '2024-09-13 17:16:42', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(15, 'Wagholi');

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

-- --------------------------------------------------------

--
-- Table structure for table `property_name`
--

CREATE TABLE `property_name` (
  `property_name_id` int(10) NOT NULL,
  `property_title` text NOT NULL,
  `location` text NOT NULL,
  `location_id` int(10) DEFAULT NULL,
  `google_location_lat` varchar(250) DEFAULT NULL,
  `google_location_long` varchar(250) DEFAULT NULL,
  `builder_name` text NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `added_on` datetime NOT NULL,
  `edited_on` datetime NOT NULL,
  `car_parking` varchar(50) DEFAULT NULL,
  `furnishing` varchar(50) DEFAULT NULL,
  `amenities` text DEFAULT NULL,
  `USP` text DEFAULT NULL,
  `pdf1` varchar(255) DEFAULT NULL,
  `pdf2` varchar(255) DEFAULT NULL,
  `pdf3` varchar(255) DEFAULT NULL,
  `pdf4` varchar(255) DEFAULT NULL,
  `pdf5` varchar(255) DEFAULT NULL,
  `pdf6` varchar(255) DEFAULT NULL,
  `video1` varchar(255) DEFAULT NULL,
  `video2` varchar(255) DEFAULT NULL,
  `video3` varchar(255) DEFAULT NULL,
  `video4` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_name`
--

INSERT INTO `property_name` (`property_name_id`, `property_title`, `location`, `location_id`, `google_location_lat`, `google_location_long`, `builder_name`, `status`, `added_on`, `edited_on`, `car_parking`, `furnishing`, `amenities`, `USP`, `pdf1`, `pdf2`, `pdf3`, `pdf4`, `pdf5`, `pdf6`, `video1`, `video2`, `video3`, `video4`) VALUES
(1, 'Mehta Properties', 'Baner', 13, '0.67543', '0.4546', 'Sagar Mehta', 'Active', '2024-08-22 18:05:06', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Sharma Properties', 'Wakad', 13, '0.564', '0.45', 'Pooja Sharma', 'Active', '2024-08-22 18:05:51', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Sighania Properties', 'Viman Nagar', 13, '0.456', '0.34532', 'Ashok Sighania', 'Active', '2024-08-22 18:06:47', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Raunak Group', 'Sangavi', 13, '0.765', '0.654', 'Shreya Raunak', 'Suspended', '2024-08-22 18:17:24', '2024-09-04 11:45:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Shaha Property', 'Wagholi', 15, '0.7878', '0.2323', 'Amol Shaha', 'Active', '2024-09-02 17:42:01', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Joshi Property', 'Shivaji Nagar', 8, '0.343', '0.454', 'Sarang Joshi', 'Active', '2024-09-02 18:56:51', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'uploads/pdfs/The Tactics -2.pdf', 'uploads/pdfs/Advanced beginners_April 2018 (1).pdf', 'uploads/pdfs/Double Attack (1).pdf', NULL, NULL, NULL, 'uploads/videos/skinsure-screenrecord.webm', 'uploads/videos/3.edit_bill.webm', NULL, NULL),
(7, 'Patil Property', 'Kharadi', 4, '0.53', '0.89', 'Harshal Patil', 'Active', '2024-09-03 15:50:06', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'uploads/pdfs/M.Phil. Clinical Psychology Report (1).pdf', 'uploads/pdfs/Hall Ticket-narayan rathod.pdf', NULL, NULL, NULL, NULL, 'uploads/videos/addmore.webm', 'uploads/videos/addmore-single.webm', NULL, NULL),
(8, 'Ravi Property', 'Bavdhan', 10, '0.5312', '0.8912', 'Ravi Patil', 'Active', '2024-09-04 14:54:39', '0000-00-00 00:00:00', 'Open', 'Furnished', 'amenities', 'uspsss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
  `status` varchar(50) DEFAULT NULL,
  `added_on` datetime NOT NULL,
  `edited_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_tower`
--

INSERT INTO `property_tower` (`property_tower_id`, `property_name_id`, `property_tower_name`, `builder_possession`, `rera_possession`, `status`, `added_on`, `edited_on`) VALUES
(1, 1, 'mehta tower A', 'May 2024', 'June 2026', 'Active', '2024-08-22 18:49:03', '0000-00-00 00:00:00'),
(2, 2, 'Sharma tower A', 'May 2024', 'June 2025', 'Active', '2024-08-22 18:50:11', '0000-00-00 00:00:00'),
(3, 1, ' Mehta tower B', 'June 2022', 'may 2026', 'Active', '2024-08-23 20:24:09', '0000-00-00 00:00:00'),
(4, 2, 'Sharma tower B', 'May 2024', 'June 2025', 'Suspended', '2024-08-23 20:24:27', '2024-09-04 11:51:02');

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
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `assign_leads`
--
ALTER TABLE `assign_leads`
  MODIFY `assign_leads_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `assign_leads_sr`
--
ALTER TABLE `assign_leads_sr`
  MODIFY `assign_leads_sr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `converted_leads`
--
ALTER TABLE `converted_leads`
  MODIFY `converted_leads_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_name`
--
ALTER TABLE `property_name`
  MODIFY `property_name_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
