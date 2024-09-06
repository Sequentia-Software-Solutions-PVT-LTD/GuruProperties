-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2024 at 05:06 PM
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
  `status` varchar(10) DEFAULT NULL,
  `location` text NOT NULL,
  `location_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `login_name`, `login_id`, `login_password`, `login_role`, `type`, `login_photo`, `status`, `location`, `location_id`) VALUES
(1, 'Administrator', 'admin', '$2y$10$62GOdcttnKe4ewxhR3YfiOHb1RK9DScRZgRtC8tf8rTJQnL1rgZK.', 'ADMIN', 'ADMIN', 'default.png', 'Active', '0', NULL),
(2, 'superadmin', 'superadmin', '$2y$10$62GOdcttnKe4ewxhR3YfiOHb1RK9DScRZgRtC8tf8rTJQnL1rgZK.', 'ADMIN', 'SUPERADMIN', 'default.png', 'Active', '0', NULL),
(46, 'Lead Generator', 'leadgenerator', '$2y$10$zpRToYM7QiKHnJQHFX.k8.tUO1Ljy59vNjuRJUjTesASIKwlgxw4i', 'LEAD GENERATOR', 'LEAD GENERATOR', 'default.png', 'Active', '0', NULL),
(49, 'Ross', 'CE-ross', '$2y$10$vWo3ROLsDSnyHGDEjlYOS.Njkmg.FtvDdyI90iPGqGvZelLP8kDB.', 'CUSTOMER EXECUTIVE', 'CUSTOMER EXECUTIVE', 'default.png', 'Active', 'Baner', 13),
(50, 'Joe', 'CE-joe', '$2y$10$djKvOsAephxNiJQSPF8ahOgdBxpjbxvAPjkM6wxC4m/1oH4QMi2Uq', 'CUSTOMER EXECUTIVE', 'CUSTOMER EXECUTIVE', 'default.png', 'Active', 'Bavdhan', 10),
(51, 'Chandu', 'SE-chandu', '$2y$10$/pNPgEuNA7OfW646Go51V.npnysjOehzl2YvLOLcxmxqUDVz63A9y', 'SALES EXECUTIVE', 'SALES EXECUTIVE', 'default.png', 'Active', 'Hadapsar', 5),
(52, 'john', 'SE-john', '$2y$10$Y0OP3p/Pvzu6SmYFOPVaj.CHC4xCKjZOtp6VmB3Kue52I8.sQCpTK', 'SALES EXECUTIVE', 'SALES EXECUTIVE', 'default.png', 'Active', 'Baner', 13);

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
  `fresh_lead` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assign_leads`
--

INSERT INTO `assign_leads` (`assign_leads_id`, `leads_id`, `admin_id`, `location_id`, `employee_id`, `employee_name`, `assign_employee_type`, `notes`, `remark`, `next_date`, `next_time`, `mark_dead`, `status`, `connection_status`, `lead_type`, `dead_reason`, `transfer_status`, `transfer_employee_id`, `transfer_employee_type`, `transfer_reason`, `lead_date`, `edited_on`, `added_on`, `admin_request_date`, `admin_aproved_date`, `request_for_admin`, `fresh_lead`) VALUES
(1, 3, 50, 10, 2, 'Joe', 'CUSTOMER EXECUTIVE', 'followup sequentia 3 bye CE-Joe', '', '2024-09-05', '15:44:00', '', 'Followup', 'connected', 'hot', NULL, 'Not Available', NULL, NULL, NULL, '2024-09-05', '2024-09-05 15:45:02', '2024-09-05 15:25:18', NULL, NULL, NULL, 1),
(2, 4, 50, 10, 2, 'Joe', 'CUSTOMER EXECUTIVE', 'followup test seq4 by CE-joe', '', '2024-09-05', '15:49:00', '', 'Followup', 'connected', 'hot', NULL, 'Not Available', NULL, NULL, NULL, '2024-09-05', '2024-09-05 15:49:46', '2024-09-05 15:25:18', NULL, NULL, NULL, 1),
(3, 3, 50, 0, 2, 'Joe', NULL, 'follow up sequentia 3by CE-Joe', '', '2024-09-05', '15:46:00', '', 'Followup', 'connected', 'hot', NULL, 'Not Available', NULL, NULL, NULL, NULL, '2024-09-05 15:46:18', '2024-09-05 15:45:02', NULL, NULL, NULL, 0),
(4, 3, 50, 0, 2, 'Joe', NULL, '', '', '2024-09-05', '15:46:00', '', 'Active', NULL, NULL, NULL, 'Transfered', 1, 'CUSTOMER EXECUTIVE', 'Transfer sequentia 3 from CE-joe to CE-ross', NULL, '2024-09-05 15:47:18', '2024-09-05 15:46:18', NULL, NULL, NULL, 0),
(5, 3, 49, 0, 1, 'Ross', NULL, 'followup seq3 by CE-ross', '', '2024-09-05', '16:12:00', '', 'Followup', 'connected', 'hot', NULL, 'Not Available', NULL, NULL, NULL, NULL, '2024-09-05 16:12:22', '2024-09-05 15:47:18', '2024-09-05 15:47:18', '2024-09-05 16:06:50', 'Yes', 0),
(6, 4, 50, 0, 2, 'Joe', 'SALES EXECUTIVE', '', '', '2024-09-05', '15:49:00', '', 'Assigned', NULL, NULL, NULL, 'Transfered', 2, NULL, NULL, NULL, '2024-09-05 15:53:19', '2024-09-05 15:49:46', NULL, NULL, NULL, 0),
(7, 3, 50, 0, 2, 'Ross', 'SALES EXECUTIVE', '', '', '2024-09-05', '16:12:00', '', 'Assigned', NULL, NULL, NULL, 'Transfered', 1, NULL, NULL, NULL, '2024-09-05 16:14:36', '2024-09-05 16:12:22', NULL, NULL, NULL, 0),
(8, 19, 50, 13, 2, 'Joe', 'SALES EXECUTIVE', 'Moana1 followup 1 by CE-joe', '', '2024-09-05', '16:56:00', '', 'Followup', 'connected', 'hot', NULL, 'Not Available', NULL, NULL, NULL, '2024-09-05', '2024-09-05 16:56:52', '2024-09-05 16:49:53', NULL, NULL, NULL, 1),
(9, 20, 50, 13, 2, 'Joe', 'SALES EXECUTIVE', 'mona 2 followup 1 CE-joe', '', '2024-09-05', '17:38:00', '', 'Followup', 'connected', 'hot', NULL, 'Not Available', NULL, NULL, NULL, '2024-09-05', '2024-09-05 17:38:37', '2024-09-05 16:49:53', NULL, NULL, NULL, 1),
(10, 21, 50, 13, 2, 'Joe', NULL, '', '', '0000-00-00', NULL, '', 'Active', NULL, NULL, NULL, 'Available', NULL, NULL, NULL, '2024-09-05', NULL, '2024-09-05 16:49:53', NULL, NULL, NULL, 1),
(11, 22, 50, 13, 2, 'Joe', 'SALES EXECUTIVE', '', '', '0000-00-00', NULL, '', 'Assigned', NULL, NULL, NULL, 'Transfered', 2, NULL, NULL, '2024-09-05', '2024-09-05 17:20:55', '2024-09-05 16:49:53', NULL, NULL, NULL, 1),
(12, 19, 50, 0, 2, 'Joe', NULL, '', '', '2024-09-05', '16:56:00', '', 'Active', NULL, NULL, NULL, 'Transfered', 1, 'CUSTOMER EXECUTIVE', 'moana 1 Transfer from CE-joe to CE-ross', NULL, '2024-09-05 16:59:40', '2024-09-05 16:56:52', NULL, NULL, NULL, 0),
(13, 19, 49, 0, 1, 'Ross', NULL, 'moana followup-1 by CE-ross after transfer', '', '2024-09-05', '17:02:00', '', 'Followup', 'connected', 'hot', NULL, 'Not Available', NULL, NULL, NULL, NULL, '2024-09-05 17:02:52', '2024-09-05 16:59:40', '2024-09-05 16:59:40', '2024-09-05 17:00:48', 'Yes', 0),
(14, 19, 49, 0, 1, 'Ross', 'SALES EXECUTIVE', '', '', '2024-09-05', '17:02:00', '', 'Assigned', NULL, NULL, NULL, 'Transfered', 1, NULL, NULL, NULL, '2024-09-05 17:04:18', '2024-09-05 17:02:52', NULL, NULL, NULL, 0),
(15, 22, 50, 0, 2, 'Joe', 'Customer EXECUTIVE', '', '', '2024-09-06', '17:22:00', '', 'From SE', NULL, NULL, NULL, 'Admin Pending', 4, 'SALES EXECUTIVE', 'tr moana4 from SE-john to CE-joe', NULL, NULL, '2024-09-05 17:28:21', '2024-09-05 17:28:21', NULL, 'Yes', 0),
(16, 20, 50, 0, 2, 'Joe', NULL, '', '', '2024-09-05', '17:38:00', '', 'Active', NULL, NULL, NULL, 'Transfered', 1, 'CUSTOMER EXECUTIVE', 'mona2 Transfer from CE-joe to CE-ross', NULL, '2024-09-05 17:39:25', '2024-09-05 17:38:37', NULL, NULL, NULL, 0),
(17, 20, 49, 0, 1, 'Ross', 'SALES EXECUTIVE', '', '', '2024-09-05', '17:39:00', '', 'Assigned', NULL, NULL, NULL, 'Transfered', 1, NULL, NULL, NULL, '2024-09-05 17:41:01', '2024-09-05 17:39:25', '2024-09-05 17:39:25', '2024-09-05 17:39:43', 'Yes', 0),
(18, 20, 50, 0, 2, 'Joe', 'SALES EXECUTIVE', '', '', '2024-09-05', '17:44:00', '', 'Assigned', NULL, NULL, NULL, 'Transfered', 2, 'SALES EXECUTIVE', 'moana 2 transfer from SE-john to CE-joe', NULL, '2024-09-05 17:47:25', '2024-09-05 17:45:08', '2024-09-05 17:45:08', '2024-09-05 17:45:28', 'Yes', 0),
(19, 24, 49, 13, 1, 'test', NULL, 'notes - not connected ', '', '2024-09-06', '14:08:00', '', 'Followup', 'not_connected', 'hot', NULL, 'Not Available', NULL, NULL, NULL, '2024-09-06', '2024-09-06 13:07:30', '2024-09-06 12:36:35', NULL, NULL, NULL, 1),
(20, 24, 49, 0, 1, 'test', NULL, 'notes connected', '', '2024-09-06', '13:20:00', '', 'Followup', 'connected', 'warm', NULL, 'Not Available', NULL, NULL, NULL, NULL, '2024-09-06 13:20:29', '2024-09-06 13:07:30', NULL, NULL, NULL, 0),
(21, 24, 49, 0, 1, 'test', NULL, '', '', '2024-09-06', '13:20:00', '', 'Active', NULL, NULL, NULL, 'Transferred', 2, 'CUSTOMER EXECUTIVE', 'Reason For Transfer CE-CE', NULL, '2024-09-06 15:44:20', '2024-09-06 13:20:39', NULL, NULL, NULL, 0),
(22, 24, 50, 0, 2, 'Joe', NULL, 'trasnferred followup CE 2 connected wala', '', '2024-09-06', '16:30:00', '', 'Followup', 'connected', 'cold', NULL, 'Not Available', NULL, NULL, NULL, NULL, '2024-09-06 16:28:43', '2024-09-06 15:44:19', '2024-09-06 15:44:29', '2024-09-06 16:08:20', 'yes', 0),
(23, 24, 50, 0, 2, 'Joe', 'SALES EXECUTIVE', '', '', '2024-09-06', '16:30:00', '', 'Assigned', NULL, NULL, NULL, 'Transferred', 3, NULL, NULL, NULL, '2024-09-06 16:39:51', '2024-09-06 16:28:44', NULL, NULL, NULL, 0),
(24, 24, 49, 0, 1, 'Ross', 'SALES EXECUTIVE', '', '', '2024-09-06', '19:09:00', '', 'Assigned', NULL, NULL, NULL, 'Transferred', 4, '', 'Reason For Transfer SE-CE', NULL, '2024-09-06 19:19:04', '2024-09-06 19:09:25', '2024-09-06 19:09:25', '2024-09-06 19:16:12', 'yes', 0),
(25, 25, 49, 13, 1, 'test', NULL, '', '', '0000-00-00', NULL, 'yes', 'Dead', NULL, NULL, 'Resasdas  askjdkasjhdkas dasdkaskdjaskl', 'Available', NULL, NULL, NULL, '2024-09-06', '2024-09-06 20:26:59', '2024-09-06 20:26:35', NULL, NULL, NULL, 1),
(26, 26, 49, 13, 1, 'test', 'SALES EXECUTIVE', '', '', '0000-00-00', NULL, '', 'Assigned', NULL, NULL, NULL, 'Transferred', 3, NULL, NULL, '2024-09-06', '2024-09-06 20:34:18', '2024-09-06 20:33:45', NULL, NULL, NULL, 1);

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
  `request_for_admin` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assign_leads_sr`
--

INSERT INTO `assign_leads_sr` (`assign_leads_sr_id`, `leads_id`, `assign_leads_id`, `lead_date`, `status`, `transfer_status`, `admin_id`, `employee_id`, `employee_name`, `employee_type`, `notes`, `remark`, `connection_status`, `lead_type`, `is_followup`, `followup_or_another_property`, `next_date`, `next_time`, `property_id`, `sub_property_id`, `variant`, `area`, `location1`, `rate`, `visit_done`, `visit_date`, `visit_time`, `visit_notes`, `photo`, `location`, `dead_reason`, `mark_dead`, `convert_lead`, `quotated_price`, `sale_price`, `other_details`, `row_date`, `assign_employee_type`, `assign_employee_id`, `transfer_employee_id`, `transfer_employee_type`, `transfer_reason`, `edited_on`, `added_on`, `admin_request_date`, `admin_aproved_date`, `request_for_admin`) VALUES
(1, 4, 6, NULL, 'Active', 'Transfered', 51, 3, 'Chandu', 'SALES EXECUTIVE', 'todays followup Mehta Properties by SE-chandu', '', 'connected', 'hot', '', NULL, '2024-09-05', '15:54:00', '1', '1', '2', '', 'Baner', '', '', '0000-00-00', '00:00:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 2, 4, 'SALES EXECUTIVE', 'seq4 transfer Se-chandu to Se-john', '2024-09-05 17:13:17', '2024-09-05 15:53:19', NULL, NULL, NULL),
(2, 4, 6, NULL, 'Active', 'Transfered', 51, 3, 'Chandu', '', '', '', NULL, NULL, '', 'Follow Up', '2024-09-05', '15:54:00', '1', '1', '2', '', '', '', '', '0000-00-00', '00:00:00', '', 'photos/photo_20240905035544.png', '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 1, 'CUSTOMER EXECUTIVE', 'seq 4 trasnfer from SE-chandu to CE-ross', '2024-09-05 16:02:42', '2024-09-05 15:55:44', NULL, NULL, NULL),
(3, 3, 7, NULL, 'Active', 'Transfered', 52, 4, 'john', 'SALES EXECUTIVE', 'notes', '', NULL, NULL, '', NULL, NULL, NULL, '1', '1', '4', '', 'Baner', '', '', '2024-09-05', '16:14:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 1, 3, 'SALES EXECUTIVE', 'seq 3 transfer from SE-john to SE-chandu', '2024-09-05 16:17:44', '2024-09-05 16:14:36', NULL, NULL, NULL),
(4, 3, 7, NULL, 'Followup', 'Not Available', 51, 3, 'Chandu', 'SALES EXECUTIVE', 'gggggggg', '', 'connected', 'hot', '', NULL, '2024-09-05', '18:02:00', '1', '1', '4', '', 'Baner', '', '', '0000-00-00', '00:00:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'SALES EXECUTIVE', 4, 0, '', '', '2024-09-05 18:05:30', '2024-09-05 16:17:44', '2024-09-05 16:17:44', '2024-09-05 16:18:54', 'Yes'),
(5, 19, 14, NULL, 'Followup', 'Not Available', 51, 3, 'Chandu', 'SALES EXECUTIVE', 'moana 1 followup by MT-A 2bhk by SE-chandu', '', 'connected', 'hot', '', NULL, '2024-09-05', '17:07:00', '1', '1', '2', '', 'Baner', '', '', '0000-00-00', '00:00:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 1, 0, '', '', '2024-09-05 17:07:52', '2024-09-05 17:04:18', NULL, NULL, NULL),
(6, 19, 14, NULL, 'Active', 'Transfered', 51, 3, 'Chandu', '', '', '', NULL, NULL, '', 'Follow Up', '2024-09-05', '17:07:00', '1', '1', '2', '', '', '', '', '0000-00-00', '00:00:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 2, 'CUSTOMER EXECUTIVE', 'moana 1 transfer from SE-chandu to CE-john', '2024-09-05 17:10:28', '2024-09-05 17:07:52', NULL, NULL, NULL),
(7, 4, 6, NULL, 'Active', 'Transfered', 52, 4, 'john', 'SALES EXECUTIVE', '', '', NULL, NULL, '', NULL, '2024-09-05', '17:12:00', '1', '1', '2', '', 'Baner', '', '', NULL, NULL, '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'SALES EXECUTIVE', 3, 2, 'CUSTOMER EXECUTIVE', 'seq4 transfer SE-john to CE-joe', '2024-09-05 17:15:36', '2024-09-05 17:13:17', '2024-09-05 17:13:17', '2024-09-05 17:13:42', 'Yes'),
(8, 22, 11, NULL, 'Active', 'Transfered', 52, 4, 'john', 'SALES EXECUTIVE', 'fadgfgbf', '', NULL, NULL, '', NULL, NULL, NULL, '1', '1', '4', '', 'Baner', '', '', '2024-09-05', '17:20:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 2, 2, 'CUSTOMER EXECUTIVE', 'tr moana4 from SE-john to CE-joe', '2024-09-05 17:28:21', '2024-09-05 17:20:55', NULL, NULL, NULL),
(9, 20, 17, NULL, 'Followup', 'Not Available', 51, 3, 'Chandu', 'SALES EXECUTIVE', 'followup moana 2 by SE-chandu', '', 'connected', 'hot', '', NULL, '2024-09-05', '17:41:00', '1', '1', '2', '', 'Baner', '', '', '0000-00-00', '00:00:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 1, 0, '', '', '2024-09-05 17:42:00', '2024-09-05 17:41:01', NULL, NULL, NULL),
(10, 20, 17, NULL, 'Active', 'Transfered', 51, 3, 'Chandu', '', '', '', NULL, NULL, '', 'Follow Up', '2024-09-05', '17:41:00', '1', '1', '2', '', '', '', '', '0000-00-00', '00:00:00', '', 'photos/photo_20240905054200.png', '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 4, 'SALES EXECUTIVE', 'moana2 transfer SE-chandu to SE-john', '2024-09-05 17:43:30', '2024-09-05 17:42:00', NULL, NULL, NULL),
(11, 20, 17, NULL, 'Active', 'Transfered', 52, 4, 'john', 'SALES EXECUTIVE', '', '', NULL, NULL, '', NULL, '2024-09-05', '17:43:00', '1', '1', '2', '', '', '', '', NULL, NULL, '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'SALES EXECUTIVE', 3, 2, 'CUSTOMER EXECUTIVE', 'moana 2 transfer from SE-john to CE-joe', '2024-09-05 17:45:08', '2024-09-05 17:43:30', '2024-09-05 17:43:30', '2024-09-05 17:43:46', 'Yes'),
(12, 20, 18, NULL, 'Converted', 'Converted', 51, 3, 'Chandu', 'SALES EXECUTIVE', 'notefgs', '', NULL, NULL, '', NULL, NULL, NULL, '1', '1', '2', '', 'Baner', '', '', '2024-09-05', '17:47:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 2, 0, '', '', '2024-09-05 17:49:01', '2024-09-05 17:47:25', NULL, NULL, NULL),
(13, 3, 7, NULL, 'Followup', 'Available', 51, 3, 'Chandu', '', '', '', NULL, NULL, '', 'Follow Up', '2024-09-05', '18:02:00', '1', '1', '4', '', '', '', '', '0000-00-00', '00:00:00', '', 'photos/photo_20240905060530.png', '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 0, '', '', NULL, '2024-09-05 18:05:30', NULL, NULL, NULL),
(14, 24, 23, NULL, 'Followup', 'Not Available', 51, 3, 'Chandu', 'SALES EXECUTIVE', 'customer not visited on site due to some reason.', '', 'not_connected', 'cold', '', NULL, '2024-09-06', '17:02:00', '1', '1', '1,2,4', '', 'Baner', '', '', '0000-00-00', '00:00:00', '', 'photos/photo_20240906050006.png', '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 2, 0, '', '', '2024-09-06 17:00:06', '2024-09-06 16:39:59', NULL, NULL, NULL),
(15, 24, 23, NULL, 'Followup', 'Not Available', 51, 3, 'Chandu', '', 'Customer is interested in another property', '', 'connected', 'hot', '', 'Follow Up', '0000-00-00', '00:00:00', '1', '1', '1,2,4', '', '', '', '', '2024-09-06', '17:22:00', '', 'photos/photo_20240906052245.png', '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 0, '', '', '2024-09-06 17:22:45', '2024-09-06 17:00:06', NULL, NULL, NULL),
(16, 24, 23, NULL, 'Active', 'Transferred', 51, 3, 'Chandu', '', '', '', NULL, NULL, '', 'Another Property', '0000-00-00', '00:00:00', '1', '1', '1,2', '', '', '', '', '2024-09-06', '17:22:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 4, 'SALES EXECUTIVE', 'Reason For Transfer SE-SE', '2024-09-06 18:28:40', '2024-09-06 17:22:46', NULL, NULL, NULL),
(17, 24, 23, NULL, 'Followup', 'Not Available', 52, 4, 'john', 'SALES EXECUTIVE', 'Visited for SE-SE', '', 'connected', 'hot', '', NULL, '2024-09-06', '19:06:00', '1', '1', '1,2', '', '', '', '', '0000-00-00', '00:00:00', '', 'photos/photo_20240906070553.png', '', '', '', '', '', '', '', '0000-00-00', 'SALES EXECUTIVE', 3, 0, '', '', '2024-09-06 19:05:53', '2024-09-06 18:28:42', '2024-09-06 18:28:42', '2024-09-06 18:53:20', 'yes'),
(18, 24, 23, NULL, 'Active', 'Transferred', 52, 4, 'john', '', '', '', NULL, NULL, '', 'Follow Up', '2024-09-06', '19:06:00', '1', '1', '1,2', '', '', '', '', '0000-00-00', '00:00:00', '', NULL, '', '', '', '', '', '', '', '0000-00-00', NULL, 0, 1, 'CUSTOMER EXECUTIVE', 'Reason For Transfer SE-CE', '2024-09-06 19:09:25', '2024-09-06 19:05:53', NULL, NULL, NULL),
(19, 24, 24, NULL, 'Converted', 'Converted', 52, 4, 'john', 'SALES EXECUTIVE', 'from CE-SE', '', NULL, NULL, '', NULL, NULL, NULL, '1', '1', '5', '', 'Baner', '', '', '2024-09-06', '19:19:10', '', NULL, '', '', '', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 1, 0, '', '', '2024-09-06 19:28:26', '2024-09-06 19:19:14', NULL, NULL, NULL),
(20, 26, 26, NULL, 'Dead', 'Dead', 51, 3, 'Chandu', 'SALES EXECUTIVE', 'notes', '', NULL, NULL, '', NULL, NULL, NULL, '1', '1', '5', '', 'Baner', '', '', '2024-09-06', '20:35:00', '', NULL, '', 'dead by ce', 'Yes', '', '', '', '', '0000-00-00', 'CUSTOMER EXECUTIVE', 1, 0, '', '', '2024-09-06 20:34:42', '2024-09-06 20:34:18', NULL, NULL, NULL);

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
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `login_id`, `login_name`, `date`, `time`, `status`, `added_on`) VALUES
(1, 7, 'Amol ', '2024-08-07', '05:13:33', '', '2024-08-07 05:13:33'),
(2, 7, 'Amol ', '2024-08-07', '05:13:53', '', '2024-08-07 05:13:53'),
(3, 7, 'Amol ', '2024-08-07', '05:15:22', '', '2024-08-07 05:15:22'),
(4, 7, 'Amol ', '2024-08-07', '05:40:20', 'Logged In', '2024-08-07 05:40:20'),
(5, 7, 'Amol ', '2024-08-07', '05:42:46', 'Logged OUT', '2024-08-07 05:42:46'),
(6, 0, 'Administrator', '2024-08-07', '11:46:51', 'Logged OUT', '2024-08-07 11:46:51'),
(7, 7, 'Amol ', '2024-08-07', '11:47:00', 'Logged In', '2024-08-07 11:47:00'),
(8, 7, 'Amol ', '2024-08-07', '11:47:42', 'Logged OUT', '2024-08-07 11:47:42'),
(9, 0, 'Administrator', '2024-08-07', '11:48:59', 'Logged OUT', '2024-08-07 11:48:59'),
(10, 0, 'Administrator', '2024-08-07', '11:52:03', 'Logged OUT', '2024-08-07 11:52:03'),
(11, 0, 'Administrator', '2024-08-08', '13:28:55', 'Logged OUT', '2024-08-08 13:28:55'),
(12, 45, 'sara', '2024-09-03', '17:19:13', 'Logged OUT', '2024-09-03 17:19:13'),
(13, 45, 'sara', '2024-09-03', '17:22:45', 'Logged In', '2024-09-03 17:22:45'),
(14, 45, 'sara', '2024-09-03', '17:38:42', 'Logged OUT', '2024-09-03 17:38:42'),
(15, 44, 'pooja', '2024-09-03', '17:38:48', 'Logged In', '2024-09-03 17:38:48'),
(16, 44, 'pooja', '2024-09-03', '18:20:24', 'Logged OUT', '2024-09-03 18:20:24'),
(17, 43, 'megha', '2024-09-03', '18:20:30', 'Logged In', '2024-09-03 18:20:30'),
(18, 45, 'sara', '2024-09-04', '10:39:49', 'Logged In', '2024-09-04 10:39:49'),
(19, 45, 'sara', '2024-09-04', '10:44:03', 'Logged OUT', '2024-09-04 10:44:03'),
(20, 44, 'pooja', '2024-09-04', '10:44:15', 'Logged In', '2024-09-04 10:44:15'),
(21, 44, 'pooja', '2024-09-04', '10:48:55', 'Logged OUT', '2024-09-04 10:48:55'),
(22, 2, 'superadmin', '2024-09-04', '10:49:03', 'Logged In', '2024-09-04 10:49:03'),
(23, 2, 'superadmin', '2024-09-04', '11:04:26', 'Logged OUT', '2024-09-04 11:04:26'),
(24, 45, 'sara', '2024-09-04', '11:04:42', 'Logged In', '2024-09-04 11:04:42'),
(25, 45, 'sara', '2024-09-04', '11:20:58', 'Logged OUT', '2024-09-04 11:20:58'),
(26, 2, 'superadmin', '2024-09-04', '11:21:05', 'Logged In', '2024-09-04 11:21:05'),
(27, 43, 'megha', '2024-09-04', '11:21:51', 'Logged OUT', '2024-09-04 11:21:51'),
(28, 44, 'pooja', '2024-09-04', '11:21:56', 'Logged In', '2024-09-04 11:21:56'),
(29, 44, 'pooja', '2024-09-04', '11:24:54', 'Logged OUT', '2024-09-04 11:24:54'),
(30, 43, 'megha', '2024-09-04', '11:25:00', 'Logged In', '2024-09-04 11:25:00'),
(31, 2, 'superadmin', '2024-09-04', '11:56:15', 'Logged OUT', '2024-09-04 11:56:15'),
(32, 45, 'sara', '2024-09-04', '11:56:26', 'Logged In', '2024-09-04 11:56:26'),
(33, 45, 'sara', '2024-09-04', '12:00:30', 'Logged OUT', '2024-09-04 12:00:30'),
(34, 44, 'pooja', '2024-09-04', '12:00:40', 'Logged In', '2024-09-04 12:00:40'),
(35, 43, 'megha', '2024-09-04', '12:09:31', 'Logged OUT', '2024-09-04 12:09:31'),
(36, 45, 'sara', '2024-09-04', '12:09:37', 'Logged In', '2024-09-04 12:09:37'),
(37, 45, 'sara', '2024-09-04', '12:18:06', 'Logged OUT', '2024-09-04 12:18:06'),
(38, 2, 'superadmin', '2024-09-04', '12:18:13', 'Logged In', '2024-09-04 12:18:13'),
(39, 44, 'pooja', '2024-09-04', '15:24:52', 'Logged OUT', '2024-09-04 15:24:52'),
(40, 46, 'Lead Generator', '2024-09-04', '15:25:27', 'Logged In', '2024-09-04 15:25:27'),
(41, 46, 'Lead Generator', '2024-09-04', '15:29:17', 'Logged OUT', '2024-09-04 15:29:17'),
(42, 45, 'sara', '2024-09-04', '15:29:27', 'Logged In', '2024-09-04 15:29:27'),
(43, 2, 'superadmin', '2024-09-04', '15:42:09', 'Logged OUT', '2024-09-04 15:42:09'),
(44, 45, 'sara', '2024-09-04', '15:42:14', 'Logged In', '2024-09-04 15:42:14'),
(45, 45, 'sara', '2024-09-04', '17:44:38', 'Logged OUT', '2024-09-04 17:44:38'),
(46, 45, 'sara', '2024-09-04', '17:44:47', 'Logged In', '2024-09-04 17:44:47'),
(47, 45, 'sara', '2024-09-04', '18:45:01', 'Logged OUT', '2024-09-04 18:45:01'),
(48, 46, 'Lead Generator', '2024-09-04', '18:45:14', 'Logged In', '2024-09-04 18:45:14'),
(49, 1, 'Administrator', '2024-09-04', '18:51:00', 'Logged OUT', '2024-09-04 18:51:00'),
(50, 45, 'sara', '2024-09-04', '18:51:07', 'Logged In', '2024-09-04 18:51:07'),
(51, 45, 'sara', '2024-09-04', '18:53:55', 'Logged OUT', '2024-09-04 18:53:55'),
(52, 48, 'CE-diya', '2024-09-04', '18:54:01', 'Logged In', '2024-09-04 18:54:01'),
(53, 48, 'CE-diya', '2024-09-04', '19:07:31', 'Logged OUT', '2024-09-04 19:07:31'),
(54, 45, 'sara', '2024-09-04', '19:07:46', 'Logged In', '2024-09-04 19:07:46'),
(55, 46, 'Lead Generator', '2024-09-04', '19:28:21', 'Logged OUT', '2024-09-04 19:28:21'),
(56, 44, 'pooja', '2024-09-04', '19:28:34', 'Logged In', '2024-09-04 19:28:34'),
(57, 44, 'pooja', '2024-09-04', '19:42:52', 'Logged OUT', '2024-09-04 19:42:52'),
(58, 2, 'superadmin', '2024-09-04', '19:43:03', 'Logged In', '2024-09-04 19:43:03'),
(59, 44, 'pooja', '2024-09-05', '12:07:17', 'Logged In', '2024-09-05 12:07:17'),
(60, 2, 'superadmin', '2024-09-05', '12:22:52', 'Logged In', '2024-09-05 12:22:52'),
(61, 44, 'pooja', '2024-09-05', '14:36:12', 'Logged OUT', '2024-09-05 14:36:12'),
(62, 2, 'superadmin', '2024-09-05', '14:57:21', 'Logged OUT', '2024-09-05 14:57:21'),
(63, 46, 'Lead Generator', '2024-09-05', '14:57:32', 'Logged In', '2024-09-05 14:57:32'),
(64, 46, 'Lead Generator', '2024-09-05', '14:59:21', 'Logged OUT', '2024-09-05 14:59:21'),
(65, 49, 'Ross', '2024-09-05', '15:00:16', 'Logged In', '2024-09-05 15:00:16'),
(66, 49, 'Ross', '2024-09-05', '15:00:25', 'Logged OUT', '2024-09-05 15:00:25'),
(67, 50, 'Joe', '2024-09-05', '15:00:35', 'Logged In', '2024-09-05 15:00:35'),
(68, 46, 'Lead Generator', '2024-09-05', '15:05:57', 'Logged In', '2024-09-05 15:05:57'),
(69, 46, 'Lead Generator', '2024-09-05', '15:47:24', 'Logged OUT', '2024-09-05 15:47:24'),
(70, 49, 'Ross', '2024-09-05', '15:47:33', 'Logged In', '2024-09-05 15:47:33'),
(71, 49, 'Ross', '2024-09-05', '15:53:31', 'Logged OUT', '2024-09-05 15:53:31'),
(72, 51, 'Chandu', '2024-09-05', '15:53:42', 'Logged In', '2024-09-05 15:53:42'),
(73, 51, 'Chandu', '2024-09-05', '16:04:01', 'Logged OUT', '2024-09-05 16:04:01'),
(74, 2, 'superadmin', '2024-09-05', '16:04:09', 'Logged In', '2024-09-05 16:04:09'),
(75, 2, 'superadmin', '2024-09-05', '16:08:46', 'Logged OUT', '2024-09-05 16:08:46'),
(76, 51, 'Chandu', '2024-09-05', '16:08:59', 'Logged In', '2024-09-05 16:08:59'),
(77, 51, 'Chandu', '2024-09-05', '16:09:34', 'Logged OUT', '2024-09-05 16:09:34'),
(78, 49, 'Ross', '2024-09-05', '16:09:49', 'Logged In', '2024-09-05 16:09:49'),
(79, 49, 'Ross', '2024-09-05', '16:14:46', 'Logged OUT', '2024-09-05 16:14:46'),
(80, 2, 'superadmin', '2024-09-05', '16:14:56', 'Logged In', '2024-09-05 16:14:56'),
(81, 2, 'superadmin', '2024-09-05', '16:15:37', 'Logged OUT', '2024-09-05 16:15:37'),
(82, 52, 'john', '2024-09-05', '16:15:50', 'Logged In', '2024-09-05 16:15:50'),
(83, 52, 'john', '2024-09-05', '16:17:46', 'Logged OUT', '2024-09-05 16:17:46'),
(84, 51, 'Chandu', '2024-09-05', '16:17:58', 'Logged In', '2024-09-05 16:17:58'),
(85, 51, 'Chandu', '2024-09-05', '16:18:38', 'Logged OUT', '2024-09-05 16:18:38'),
(86, 2, 'superadmin', '2024-09-05', '16:18:46', 'Logged In', '2024-09-05 16:18:46'),
(87, 2, 'superadmin', '2024-09-05', '16:19:03', 'Logged OUT', '2024-09-05 16:19:03'),
(88, 51, 'Chandu', '2024-09-05', '16:19:14', 'Logged In', '2024-09-05 16:19:14'),
(89, 51, 'Chandu', '2024-09-05', '16:30:21', 'Logged OUT', '2024-09-05 16:30:21'),
(90, 46, 'Lead Generator', '2024-09-05', '16:30:32', 'Logged In', '2024-09-05 16:30:32'),
(91, 46, 'Lead Generator', '2024-09-05', '16:46:26', 'Logged OUT', '2024-09-05 16:46:26'),
(92, 50, 'Joe', '2024-09-05', '16:54:40', 'Logged In', '2024-09-05 16:54:40'),
(93, 49, 'Ross', '2024-09-05', '17:00:06', 'Logged In', '2024-09-05 17:00:06'),
(94, 49, 'Ross', '2024-09-05', '17:00:21', 'Logged OUT', '2024-09-05 17:00:21'),
(95, 2, 'superadmin', '2024-09-05', '17:00:28', 'Logged In', '2024-09-05 17:00:28'),
(96, 2, 'superadmin', '2024-09-05', '17:00:58', 'Logged OUT', '2024-09-05 17:00:58'),
(97, 49, 'Ross', '2024-09-05', '17:01:06', 'Logged In', '2024-09-05 17:01:06'),
(98, 49, 'Ross', '2024-09-05', '17:04:22', 'Logged OUT', '2024-09-05 17:04:22'),
(99, 51, 'Chandu', '2024-09-05', '17:04:30', 'Logged In', '2024-09-05 17:04:30'),
(100, 51, 'Chandu', '2024-09-05', '17:07:58', 'Logged OUT', '2024-09-05 17:07:58'),
(101, 51, 'Chandu', '2024-09-05', '17:08:15', 'Logged In', '2024-09-05 17:08:15'),
(102, 51, 'Chandu', '2024-09-05', '17:11:06', 'Logged OUT', '2024-09-05 17:11:06'),
(103, 2, 'superadmin', '2024-09-05', '17:11:14', 'Logged In', '2024-09-05 17:11:14'),
(104, 2, 'superadmin', '2024-09-05', '17:12:13', 'Logged OUT', '2024-09-05 17:12:13'),
(105, 51, 'Chandu', '2024-09-05', '17:12:33', 'Logged In', '2024-09-05 17:12:33'),
(106, 51, 'Chandu', '2024-09-05', '17:13:23', 'Logged OUT', '2024-09-05 17:13:23'),
(107, 2, 'superadmin', '2024-09-05', '17:13:29', 'Logged In', '2024-09-05 17:13:29'),
(108, 2, 'superadmin', '2024-09-05', '17:13:55', 'Logged OUT', '2024-09-05 17:13:55'),
(109, 52, 'john', '2024-09-05', '17:14:05', 'Logged In', '2024-09-05 17:14:05'),
(110, 52, 'john', '2024-09-05', '17:18:54', 'Logged OUT', '2024-09-05 17:18:54'),
(111, 2, 'superadmin', '2024-09-05', '17:19:00', 'Logged In', '2024-09-05 17:19:00'),
(112, 2, 'superadmin', '2024-09-05', '17:19:19', 'Logged OUT', '2024-09-05 17:19:19'),
(113, 50, 'Joe', '2024-09-05', '17:19:30', 'Logged In', '2024-09-05 17:19:30'),
(114, 50, 'Joe', '2024-09-05', '17:21:36', 'Logged OUT', '2024-09-05 17:21:36'),
(115, 52, 'john', '2024-09-05', '17:21:59', 'Logged In', '2024-09-05 17:21:59'),
(116, 52, 'john', '2024-09-05', '17:28:25', 'Logged OUT', '2024-09-05 17:28:25'),
(117, 2, 'superadmin', '2024-09-05', '17:28:32', 'Logged In', '2024-09-05 17:28:32'),
(118, 2, 'superadmin', '2024-09-05', '17:29:25', 'Logged OUT', '2024-09-05 17:29:25'),
(119, 50, 'Joe', '2024-09-05', '17:29:35', 'Logged In', '2024-09-05 17:29:35'),
(120, 50, 'Joe', '2024-09-05', '17:39:31', 'Logged OUT', '2024-09-05 17:39:31'),
(121, 2, 'superadmin', '2024-09-05', '17:39:38', 'Logged In', '2024-09-05 17:39:38'),
(122, 2, 'superadmin', '2024-09-05', '17:39:54', 'Logged OUT', '2024-09-05 17:39:54'),
(123, 49, 'Ross', '2024-09-05', '17:40:01', 'Logged In', '2024-09-05 17:40:01'),
(124, 49, 'Ross', '2024-09-05', '17:41:06', 'Logged OUT', '2024-09-05 17:41:06'),
(125, 51, 'Chandu', '2024-09-05', '17:41:14', 'Logged In', '2024-09-05 17:41:14'),
(126, 51, 'Chandu', '2024-09-05', '17:43:35', 'Logged OUT', '2024-09-05 17:43:35'),
(127, 2, 'superadmin', '2024-09-05', '17:43:40', 'Logged In', '2024-09-05 17:43:40'),
(128, 2, 'superadmin', '2024-09-05', '17:43:53', 'Logged OUT', '2024-09-05 17:43:53'),
(129, 52, 'john', '2024-09-05', '17:44:08', 'Logged In', '2024-09-05 17:44:08'),
(130, 52, 'john', '2024-09-05', '17:45:13', 'Logged OUT', '2024-09-05 17:45:13'),
(131, 2, 'superadmin', '2024-09-05', '17:45:19', 'Logged In', '2024-09-05 17:45:19'),
(132, 2, 'superadmin', '2024-09-05', '17:45:41', 'Logged OUT', '2024-09-05 17:45:41'),
(133, 50, 'Joe', '2024-09-05', '17:45:50', 'Logged In', '2024-09-05 17:45:50'),
(134, 50, 'Joe', '2024-09-05', '17:47:29', 'Logged OUT', '2024-09-05 17:47:29'),
(135, 51, 'Chandu', '2024-09-05', '17:47:41', 'Logged In', '2024-09-05 17:47:41'),
(136, 51, 'Chandu', '2024-09-05', '18:03:18', 'Logged OUT', '2024-09-05 18:03:18'),
(137, 52, 'john', '2024-09-05', '18:03:48', 'Logged In', '2024-09-05 18:03:48'),
(138, 52, 'john', '2024-09-05', '18:04:01', 'Logged OUT', '2024-09-05 18:04:01'),
(139, 51, 'Chandu', '2024-09-05', '18:04:15', 'Logged In', '2024-09-05 18:04:15'),
(140, 51, 'Chandu', '2024-09-05', '18:20:20', 'Logged OUT', '2024-09-05 18:20:20'),
(141, 2, 'superadmin', '2024-09-05', '18:20:28', 'Logged In', '2024-09-05 18:20:28'),
(142, 2, 'superadmin', '2024-09-05', '18:21:21', 'Logged OUT', '2024-09-05 18:21:21'),
(143, 51, 'Chandu', '2024-09-05', '18:22:12', 'Logged In', '2024-09-05 18:22:12'),
(144, 51, 'Chandu', '2024-09-06', '12:31:35', 'Logged In', '2024-09-06 12:31:35'),
(145, 51, 'Chandu', '2024-09-06', '12:33:49', 'Logged OUT', '2024-09-06 12:33:49'),
(146, 50, 'Joe', '2024-09-06', '12:33:53', 'Logged In', '2024-09-06 12:33:53'),
(147, 50, 'Joe', '2024-09-06', '12:34:27', 'Logged In', '2024-09-06 12:34:27'),
(148, 50, 'Joe', '2024-09-06', '12:35:06', 'Logged OUT', '2024-09-06 12:35:06'),
(149, 46, 'Lead Generator', '2024-09-06', '12:35:11', 'Logged In', '2024-09-06 12:35:11'),
(150, 50, 'Joe', '2024-09-06', '12:41:03', 'Logged OUT', '2024-09-06 12:41:03'),
(151, 49, 'Ross', '2024-09-06', '12:41:07', 'Logged In', '2024-09-06 12:41:07'),
(152, 46, 'Lead Generator', '2024-09-06', '12:41:29', 'Logged OUT', '2024-09-06 12:41:29'),
(153, 49, 'Ross', '2024-09-06', '12:41:33', 'Logged In', '2024-09-06 12:41:33'),
(154, 49, 'Ross', '2024-09-06', '15:41:12', 'Logged In', '2024-09-06 15:41:12'),
(155, 49, 'Ross', '2024-09-06', '15:41:18', 'Logged In', '2024-09-06 15:41:18'),
(156, 49, 'Ross', '2024-09-06', '15:55:10', 'Logged OUT', '2024-09-06 15:55:10'),
(157, 1, 'Administrator', '2024-09-06', '15:55:14', 'Logged In', '2024-09-06 15:55:14'),
(158, 1, 'Administrator', '2024-09-06', '15:55:17', 'Logged OUT', '2024-09-06 15:55:17'),
(159, 2, 'superadmin', '2024-09-06', '15:55:21', 'Logged In', '2024-09-06 15:55:21'),
(160, 2, 'superadmin', '2024-09-06', '16:27:19', 'Logged OUT', '2024-09-06 16:27:19'),
(161, 50, 'Joe', '2024-09-06', '16:27:22', 'Logged In', '2024-09-06 16:27:22'),
(162, 50, 'Joe', '2024-09-06', '16:27:28', 'Logged OUT', '2024-09-06 16:27:28'),
(163, 50, 'Joe', '2024-09-06', '16:27:31', 'Logged In', '2024-09-06 16:27:31'),
(164, 50, 'Joe', '2024-09-06', '16:53:07', 'Logged OUT', '2024-09-06 16:53:07'),
(165, 51, 'Chandu', '2024-09-06', '16:53:10', 'Logged In', '2024-09-06 16:53:10'),
(166, 51, 'Chandu', '2024-09-06', '18:28:44', 'Logged OUT', '2024-09-06 18:28:44'),
(167, 1, 'Administrator', '2024-09-06', '18:28:48', 'Logged In', '2024-09-06 18:28:48'),
(168, 1, 'Administrator', '2024-09-06', '18:29:10', 'Logged OUT', '2024-09-06 18:29:10'),
(169, 51, 'Chandu', '2024-09-06', '18:29:18', 'Logged In', '2024-09-06 18:29:18'),
(170, 49, 'Ross', '2024-09-06', '18:52:49', 'Logged OUT', '2024-09-06 18:52:49'),
(171, 1, 'Administrator', '2024-09-06', '18:52:53', 'Logged In', '2024-09-06 18:52:53'),
(172, 1, 'Administrator', '2024-09-06', '18:52:58', 'Logged OUT', '2024-09-06 18:52:58'),
(173, 2, 'superadmin', '2024-09-06', '18:53:01', 'Logged In', '2024-09-06 18:53:01'),
(174, 2, 'superadmin', '2024-09-06', '19:03:55', 'Logged OUT', '2024-09-06 19:03:55'),
(175, 50, 'Joe', '2024-09-06', '19:04:02', 'Logged In', '2024-09-06 19:04:02'),
(176, 50, 'Joe', '2024-09-06', '19:04:28', 'Logged OUT', '2024-09-06 19:04:28'),
(177, 52, 'john', '2024-09-06', '19:04:40', 'Logged In', '2024-09-06 19:04:40'),
(178, 52, 'john', '2024-09-06', '19:09:28', 'Logged OUT', '2024-09-06 19:09:28'),
(179, 49, 'Ross', '2024-09-06', '19:15:49', 'Logged In', '2024-09-06 19:15:49'),
(180, 49, 'Ross', '2024-09-06', '19:15:52', 'Logged OUT', '2024-09-06 19:15:52'),
(181, 2, 'superadmin', '2024-09-06', '19:15:56', 'Logged In', '2024-09-06 19:15:56'),
(182, 2, 'superadmin', '2024-09-06', '19:17:08', 'Logged OUT', '2024-09-06 19:17:08'),
(183, 2, 'superadmin', '2024-09-06', '19:17:13', 'Logged In', '2024-09-06 19:17:13'),
(184, 2, 'superadmin', '2024-09-06', '19:18:12', 'Logged OUT', '2024-09-06 19:18:12'),
(185, 49, 'Ross', '2024-09-06', '19:18:17', 'Logged In', '2024-09-06 19:18:17'),
(186, 49, 'Ross', '2024-09-06', '19:27:01', 'Logged OUT', '2024-09-06 19:27:01'),
(187, 50, 'Joe', '2024-09-06', '19:27:13', 'Logged In', '2024-09-06 19:27:13'),
(188, 50, 'Joe', '2024-09-06', '19:27:20', 'Logged OUT', '2024-09-06 19:27:20'),
(189, 52, 'john', '2024-09-06', '19:27:26', 'Logged In', '2024-09-06 19:27:26'),
(190, 52, 'john', '2024-09-06', '20:18:57', 'Logged In', '2024-09-06 20:18:57'),
(191, 52, 'john', '2024-09-06', '20:19:44', 'Logged OUT', '2024-09-06 20:19:44'),
(192, 46, 'Lead Generator', '2024-09-06', '20:25:48', 'Logged In', '2024-09-06 20:25:48'),
(193, 46, 'Lead Generator', '2024-09-06', '20:26:39', 'Logged OUT', '2024-09-06 20:26:39'),
(194, 49, 'Ross', '2024-09-06', '20:26:45', 'Logged In', '2024-09-06 20:26:45'),
(195, 49, 'Ross', '2024-09-06', '20:33:22', 'Logged OUT', '2024-09-06 20:33:22'),
(196, 46, 'Lead Generator', '2024-09-06', '20:33:25', 'Logged In', '2024-09-06 20:33:25'),
(197, 46, 'Lead Generator', '2024-09-06', '20:33:47', 'Logged OUT', '2024-09-06 20:33:47'),
(198, 49, 'Ross', '2024-09-06', '20:33:51', 'Logged In', '2024-09-06 20:33:51'),
(199, 49, 'Ross', '2024-09-06', '20:34:26', 'Logged OUT', '2024-09-06 20:34:26'),
(200, 51, 'Chandu', '2024-09-06', '20:34:31', 'Logged In', '2024-09-06 20:34:31'),
(201, 51, 'Chandu', '2024-09-06', '20:35:01', 'Logged OUT', '2024-09-06 20:35:01');

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
  `agreement_value` int(10) NOT NULL,
  `registrantion` int(10) NOT NULL,
  `gst` int(10) NOT NULL,
  `stamp_duty` int(10) NOT NULL,
  `commission` int(10) NOT NULL,
  `quoted_price` int(10) NOT NULL,
  `sale_price` int(10) NOT NULL,
  `added_on` datetime NOT NULL,
  `edited_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `converted_leads`
--

INSERT INTO `converted_leads` (`converted_leads_id`, `assign_leads_sr_id`, `leads_id`, `admin_id`, `employee_id`, `employee_name`, `property_name_id`, `property_tower_id`, `property_variants`, `notes`, `agreement_value`, `registrantion`, `gst`, `stamp_duty`, `commission`, `quoted_price`, `sale_price`, `added_on`, `edited_on`) VALUES
(1, 12, 20, 51, 3, 'Chandu', 1, 1, '2', 'notes bbbbb', 20, 20, 20, 20, 20, 20, 20, '2024-09-05 17:49:01', '0000-00-00 00:00:00'),
(2, 19, 24, 52, 4, 'john', 1, 1, '5', 'notes converted', 5676561, 345542, 79000, 7865432, 10, 123567, 2147483647, '2024-09-06 19:28:36', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `admin_id`, `employee_name`, `user_id`, `designation`, `cell_no`, `email_id`, `password`, `added_on`, `status`, `login_photo`, `login_role`, `department`, `edited_on`, `location`, `location_id`) VALUES
(1, 49, 'Ross', 'CE-ross', 'Employee', '9898989898', 'ross@gamil.com', '$2y$10$vWo3ROLsDSnyHGDEjlYOS.Njkmg.FtvDdyI90iPGqGvZelLP8kDB.', '2024-09-05 14-45-43', 'Active', 'default.png', 'CUSTOMER EXECUTIVE', '', '0000-00-00 00:00:00', 'Baner', 13),
(2, 50, 'Joe', 'CE-joe', 'Employee', '8989898989', 'joe@gamil.com', '$2y$10$djKvOsAephxNiJQSPF8ahOgdBxpjbxvAPjkM6wxC4m/1oH4QMi2Uq', '2024-09-05 14-46-21', 'Active', 'default.png', 'CUSTOMER EXECUTIVE', '', '2024-09-05 14:50:00', 'Bavdhan', 10),
(3, 51, 'Chandu', 'SE-chandu', 'Employee', '7676767676', 'chandu@gmail.com', '$2y$10$/pNPgEuNA7OfW646Go51V.npnysjOehzl2YvLOLcxmxqUDVz63A9y', '2024-09-05 14-46-58', 'Active', 'default.png', 'SALES EXECUTIVE', '', '2024-09-05 14:50:41', 'Hadapsar', 5),
(4, 52, 'john', 'SE-john', 'Employee', '6767676767', 'john@gamil.com', '$2y$10$Y0OP3p/Pvzu6SmYFOPVaj.CHC4xCKjZOtp6VmB3Kue52I8.sQCpTK', '2024-09-05 14-47-34', 'Active', 'default.png', 'SALES EXECUTIVE', '', '0000-00-00 00:00:00', 'Baner', 13);

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
(26, '', '2024-09-06', '14000000', '', '13', 'asdfghjkl', '9876543234', 'asdyuiytdfcv', '', '', '', '', '99a', 'Assigned', '', '2024-09-06 20:33:45', '0000-00-00 00:00:00', 26);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `assign_leads`
--
ALTER TABLE `assign_leads`
  MODIFY `assign_leads_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `assign_leads_sr`
--
ALTER TABLE `assign_leads_sr`
  MODIFY `assign_leads_sr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `converted_leads`
--
ALTER TABLE `converted_leads`
  MODIFY `converted_leads_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
