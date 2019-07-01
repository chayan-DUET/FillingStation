-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2018 at 04:21 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `filling_station`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_setting`
--

CREATE TABLE `account_setting` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `account_name` varchar(100) DEFAULT NULL,
  `account_no` varchar(100) DEFAULT NULL,
  `account_type` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `_key` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account_setting`
--

INSERT INTO `account_setting` (`id`, `institute_id`, `bank_id`, `branch_id`, `account_name`, `account_no`, `account_type`, `created_at`, `created_by`, `updated_at`, `updated_by`, `_key`) VALUES
(1, 12, 1, 1, 'asd', '343', 'Current', '2018-10-19 20:27:27', NULL, NULL, NULL, 'c0f28745058e1bbaae77b5aafd98860a');

-- --------------------------------------------------------

--
-- Table structure for table `bank_setting`
--

CREATE TABLE `bank_setting` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `_key` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank_setting`
--

INSERT INTO `bank_setting` (`id`, `institute_id`, `bank_name`, `created_at`, `created_by`, `updated_at`, `updated_by`, `_key`) VALUES
(1, 12, 'Sonali Bankk', '2018-10-18 21:54:55', NULL, '2018-10-18 21:59:55', NULL, 'c2c2f2026c4133cc37b6bf185ae24815');

-- --------------------------------------------------------

--
-- Table structure for table `branch_setting`
--

CREATE TABLE `branch_setting` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `branch_name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `_key` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branch_setting`
--

INSERT INTO `branch_setting` (`id`, `institute_id`, `bank_id`, `branch_name`, `created_at`, `created_by`, `updated_at`, `updated_by`, `_key`) VALUES
(1, 12, 1, 'Dhaka-01', '2018-10-19 19:25:07', NULL, '2018-10-19 19:34:00', NULL, '0b2c8272d0e4ec44afb1d1205ec23f8e'),
(3, 12, 1, 'Rangpur', '2018-10-19 19:25:07', NULL, NULL, NULL, 'a9604b306bc249b7c32aab6c88f920e5');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `_key` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `institute_id`, `category_name`, `created_at`, `created_by`, `updated_at`, `updated_by`, `_key`) VALUES
(4, 12, 'Oil', '2018-10-11 22:30:48', NULL, NULL, NULL, '6'),
(5, 12, 'Engine Oil', '2018-10-11 22:30:48', NULL, '2018-10-11 22:49:29', NULL, '9332');

-- --------------------------------------------------------

--
-- Table structure for table `chamber_caliber_setting`
--

CREATE TABLE `chamber_caliber_setting` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `tanklory_id` int(11) DEFAULT NULL,
  `chamber_id` int(11) DEFAULT NULL,
  `mm` int(11) DEFAULT NULL,
  `liter` int(11) DEFAULT NULL,
  `_key` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chamber_setting`
--

CREATE TABLE `chamber_setting` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `tanklory_id` int(11) DEFAULT NULL,
  `chamber_name` varchar(100) DEFAULT NULL,
  `chamber_capacity` double DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `_key` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chamber_setting`
--

INSERT INTO `chamber_setting` (`id`, `institute_id`, `tanklory_id`, `chamber_name`, `chamber_capacity`, `created_at`, `created_by`, `updated_at`, `updated_by`, `_key`) VALUES
(2, 12, 3, '১ম চেম্বার', 210000, '2018-10-14 00:22:01', NULL, '2018-10-14 00:34:04', NULL, '0af786b88109eb79c8532d45e8209cf1'),
(3, 12, 4, '২য় চেম্বার', 210000, '2018-10-14 01:16:57', NULL, NULL, NULL, '92891d4f71ee97fc51b74b950d5ce430');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `_key` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `institute_id`, `company_name`, `description`, `created_at`, `created_by`, `updated_at`, `updated_by`, `_key`) VALUES
(2, 12, 'Padma Ltd', NULL, '2018-10-12 20:50:51', NULL, '2018-10-12 20:52:44', NULL, '1'),
(3, 12, 'Padma Ltd 2', NULL, '2018-10-12 20:52:59', NULL, NULL, NULL, '28844'),
(4, 12, 'Padma Ltd 3', NULL, '2018-10-12 20:52:59', NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `deeps`
--

CREATE TABLE `deeps` (
  `id` int(10) UNSIGNED NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `deep_name` varchar(200) DEFAULT NULL,
  `code` int(15) DEFAULT NULL,
  `is_deleted` tinyint(2) DEFAULT '0',
  `is_fixed` tinyint(4) NOT NULL DEFAULT '1',
  `_key` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deeps`
--

INSERT INTO `deeps` (`id`, `institute_id`, `deep_name`, `code`, `is_deleted`, `is_fixed`, `_key`) VALUES
(12, 12, 'Deep 03', 1539021014, 0, 1, '4'),
(13, 12, 'Deep 02', 1539021015, 0, 1, '1'),
(14, 12, 'Deep 01', 1539021016, 0, 1, '2'),
(15, 12, 'Deep 04', 1539232458, 0, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `deep_caliber_setting`
--

CREATE TABLE `deep_caliber_setting` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `deep_id` int(11) DEFAULT NULL,
  `mm` double DEFAULT NULL,
  `liter` double DEFAULT NULL,
  `_key` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `deep_caliber_setting`
--

INSERT INTO `deep_caliber_setting` (`id`, `institute_id`, `deep_id`, `mm`, `liter`, `_key`) VALUES
(19, 12, 4, 434, 3434, '6a540d665bf2b946113a41e8739612'),
(20, 12, 4, 3434, 3434, '4760c74bfd8400a8275810e887793f'),
(21, 12, 4, 4545, 5454, '26ff52c0e11162f4318433237199c6'),
(22, 12, 4, 4545, 454545, '855ff232c20aece9674529eb735564'),
(23, 12, 4, 5656, 5656, 'ee774b39e4333248d347cd37f38a6c'),
(24, 12, 4, 5656, 5656, '2a8870e487ca369904e3dcdecb05fe'),
(25, 12, 4, 3434, 3434, '1abe18e8f1ef3e50f0400c2db069e0'),
(26, 12, 4, 343, 43434, '0f6489d2f77cc38ca732564573ef50');

-- --------------------------------------------------------

--
-- Table structure for table `deep_setting`
--

CREATE TABLE `deep_setting` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `deep_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `deep_type` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `deep_capacity` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `deep_issue_authority` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `calibration_by` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `calibration_date` date DEFAULT NULL,
  `validity` date DEFAULT NULL,
  `remarks` text CHARACTER SET utf8,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `_key` varchar(200) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deep_setting`
--

INSERT INTO `deep_setting` (`id`, `institute_id`, `company_id`, `category_id`, `product_id`, `deep_name`, `deep_type`, `deep_capacity`, `deep_issue_authority`, `calibration_by`, `calibration_date`, `validity`, `remarks`, `created_by`, `updated_by`, `created_at`, `updated_at`, `_key`) VALUES
(4, 12, 2, 4, 5, 'Deep 01', 'Underground', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-10-13 00:38:29', NULL, '0442188654a4db80db8b27833c41969c'),
(5, 12, 2, 5, 4, 'Deep 03', 'Underground', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-10-13 00:38:44', NULL, '65131be1e0d43fea9d49f5ed6b61d4e8');

-- --------------------------------------------------------

--
-- Table structure for table `employee_info`
--

CREATE TABLE `employee_info` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `employee_name` varchar(200) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `address` text,
  `mobile_no` varchar(30) DEFAULT NULL,
  `phone_no` varchar(30) DEFAULT NULL,
  `salary` double DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `_key` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_info`
--

INSERT INTO `employee_info` (`id`, `institute_id`, `employee_name`, `designation`, `address`, `mobile_no`, `phone_no`, `salary`, `description`, `created_at`, `created_by`, `updated_at`, `updated_by`, `_key`) VALUES
(2, 12, 'asdwee', 'asd', 'asd', 'asd', 'asd', 20000, 'frfsdf', '2018-10-20 22:21:42', 2, '2018-10-20 22:30:06', NULL, 'cf7c06b9abf7617edfe0f1040a9d573e');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(10) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `owner` varchar(100) DEFAULT NULL,
  `logo` varchar(300) DEFAULT NULL,
  `favicon` varchar(300) DEFAULT NULL,
  `address` text,
  `description` text,
  `email` varchar(120) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `other_contact` text,
  `phone` varchar(15) DEFAULT NULL,
  `pagesize` int(10) DEFAULT NULL,
  `copyright` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(10) DEFAULT NULL,
  `_key` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `institute_id`, `title`, `owner`, `logo`, `favicon`, `address`, `description`, `email`, `mobile`, `other_contact`, `phone`, `pagesize`, `copyright`, `created_at`, `created_by`, `modified_at`, `modified_by`, `_key`) VALUES
(1, 1, 'Legend Bricks', 'Legend IT Solution', NULL, 'fav.jpg', 'Dc More,near Land Registry Office, Rangpur', 'Legend Bricks Management System', 'mrhsajib.cse@gmail.com', '01719206144', 'sdfsf', '01719206144', 10, 'Copyright © 2018 Protected. All Rights Reserved, Legend IT', '2017-07-28 09:44:38', 2, '2018-09-13 10:34:30', 2, 'dc02ew21a0ya639kq912qx2tglf0si96'),
(14, 12, 'NN Bricks 1', NULL, NULL, NULL, 'DC More, Rangpur , Bangladesh', NULL, 'mrhsajib.cse@gmail.com', '01719206144', NULL, '01719206144', NULL, 'Copyright © 2018 Protected. All Rights Reserved,NN Bricks 1', '2018-02-06 11:41:44', 2, '2018-03-14 07:06:31', NULL, '9cb8c4c1ee36d837222cf08db4866ad9'),
(15, 13, 'NN Bricks 2', NULL, NULL, NULL, 'DC More, Rangpur , Bangladesh', NULL, 'nn2@gmail.com', '01719206144', NULL, '01719206144', 10, 'Copyright © 2018 Protected. All Rights Reserved, NN Bricks 2', '2018-02-06 11:43:21', 2, '2018-03-11 10:00:46', 32, 'e0545395b889c4f952f4163a51238f80'),
(16, 14, 'NN Bricks 3', NULL, NULL, NULL, 'NN Bricks 3', NULL, 'nn3@gmail.com', '01719206144', NULL, '01719206144', NULL, 'Copyright © 2018 Protected. All Rights Reserved,NN Bricks 3', '2018-02-06 11:43:37', 2, '2018-03-14 07:07:42', 33, '1aa975e274924b81130a241b4f96181f');

-- --------------------------------------------------------

--
-- Table structure for table `heads`
--

CREATE TABLE `heads` (
  `id` int(10) UNSIGNED NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `code` int(15) UNSIGNED DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0',
  `is_fixed` tinyint(4) NOT NULL DEFAULT '1',
  `_key` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `heads`
--

INSERT INTO `heads` (`id`, `institute_id`, `name`, `code`, `is_deleted`, `is_fixed`, `_key`) VALUES
(14, 12, 'Cash in Hand', 1533625874, 0, 1, '1aed366457ac27dde245418436a4310f0'),
(15, 12, 'Capital Account', 1533625875, 0, 1, 'c81aa4a93cae40382e8f69fbff2de14e1'),
(17, 13, 'Cash in Hand', 1533630827, 0, 1, '00d86737b9cc9d27cc8ed20783514f6a0'),
(18, 13, 'Cash At Bank', 1533630828, 0, 1, '475b6cbff9708b7e9c2f27f2e21f125b1'),
(19, 13, 'Debtors/ Customer', 1533630829, 0, 1, 'dc066e534a2c92e2723297d85d6289df2'),
(20, 13, 'Creditors/ Supplier', 1533630830, 0, 1, 'bbdfa5d5e09e0a82d1c8c817ba5a45383'),
(21, 13, 'Account Payable', 1533630831, 0, 1, '5dbed9d84e7a39456236ffa9a9874d0a4'),
(22, 13, 'Account Receivable', 1533630832, 0, 1, '99f40a68e2f69db5e8af1ffada0eef735'),
(23, 13, 'Expense', 1533630833, 0, 1, '6382dbcf8593a60e11ec9f6fc818de046'),
(24, 13, 'Capital', 1533630834, 0, 1, 'b7906f566bd3aa083463667b66924bb87'),
(25, 13, 'Purchase', 1533630835, 0, 1, '1c841ff848b67b2017472e01203f3abf8'),
(26, 13, 'Sales', 1533630836, 0, 1, 'c35d2b5ebeb0a297b8b6a97f8acffe009'),
(27, 12, 'Debtors/ Customer', 1534061875, 0, 1, 'f0f57ad96feed02f91d8812fb8816eb30'),
(28, 12, 'Creditors/ Supplier', 1534062067, 0, 1, '90c0c146b6dd99179236bf1d5ecc47400'),
(29, 12, 'Purchase', 1534233835, 0, 1, '48ee7ec6c34581c9052eb659a4fe01610'),
(30, 12, 'Party', 1534412403, 0, 1, 'faf5f18b7ae8c86ffbd3405a7b8188c80'),
(31, 13, 'Party', 1534412636, 0, 1, '6347c5a55e3db2693bd497bf650007d70');

-- --------------------------------------------------------

--
-- Table structure for table `institutes`
--

CREATE TABLE `institutes` (
  `id` int(20) NOT NULL,
  `type` varchar(30) DEFAULT 'institute',
  `code` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address` text,
  `phone` varchar(15) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `is_fixed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `_key` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `institutes`
--

INSERT INTO `institutes` (`id`, `type`, `code`, `name`, `address`, `phone`, `mobile`, `email`, `website`, `status`, `is_fixed`, `created_at`, `created_by`, `updated_at`, `updated_by`, `_key`) VALUES
(1, 'admin', NULL, 'Legend Admin', 'Rangpur, Bangladesh', '54856665', '01719206144', 'admin@gmail.com', 'www.legenditsolution.com', 1, 1, '2017-07-28 09:44:38', 2, '2018-08-06 07:02:56', NULL, 'dc02ew21a0ya639kq912qx2tglf0si96'),
(12, 'institute', NULL, 'NN Bricks 1', 'DC More, Rangpur , Bangladesh', '01719206144', '01719206144', 'nn1@gmail.com', 'www.nnbricks.com', 1, 0, '2018-02-06 11:41:44', 2, '2018-02-06 11:43:45', NULL, '9cb8c4c1ee36d837222cf08db4866ad9'),
(13, 'institute', NULL, 'NN Bricks 2', 'DC More, Rangpur , Bangladesh', '01719206144', '01719206144', 'nn2@gmail.com', 'www.nnbricks.com', 1, 0, '2018-02-06 11:43:21', 2, '2018-02-06 11:43:49', NULL, 'e0545395b889c4f952f4163a51238f80'),
(14, 'institute', NULL, 'NN Bricks 3', 'DC More, Rangpur , Bangladesh', '01719206144', '01719206144', 'nn3@gmail.com', 'www.nnbricks.com', 1, 0, '2018-02-06 11:43:37', 2, '2018-02-06 11:43:51', NULL, '1aa975e274924b81130a241b4f96181f');

-- --------------------------------------------------------

--
-- Table structure for table `institute_permissions`
--

CREATE TABLE `institute_permissions` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `permissions` text,
  `_key` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `institute_permissions`
--

INSERT INTO `institute_permissions` (`id`, `institute_id`, `permissions`, `_key`) VALUES
(1, 1, '{\"setting\":\"Setting\",\"generel_setting\":\"General Setting\",\"generel_setting_update\":\"General Setting Update\",\"chamber_setting\":\"Chamber Setting\",\"mill_setting\":\"Mill Setting\",\"manage_category\":\"Manage Category\",\"manage_purchase\":\"Manage Purchase\",\"purchase_create\":\"Purchase Create\",\"purchase_edit\":\"Purchase Edit\",\"purchase_delete\":\"Purchase Delete\",\"manage_rawbricks\":\"Manage Raw Bricks\",\"rawbricks_delete\":\"Raw Bricks Delete\",\"manage_loading\":\"Manage Loading\",\"loading_delete\":\"Loading Delete\",\"manage_unloading\":\"Manage Unloading\",\"unloading_delete\":\"Unloading Delete\",\"manage_sales\":\"Manage Sales\",\"sale_create\":\"Sale Create\",\"sale_edit\":\"Sale Edit\",\"sale_delete\":\"Sale Delete\",\"manage_customer\":\"Manage Customer\",\"manage_supplier\":\"Manage Supplier\",\"customer_create\":\"Customer Create\",\"customer_edit\":\"Customer Edit\",\"customer_delete\":\"Customer Delete\",\"supplier_create\":\"Supplier Create\",\"supplier_edit\":\"Supplier Edit\",\"supplier_delete\":\"Supplier Delete\",\"manage_stocks\":\"Manage Stocks\",\"manage_user\":\"Manage User\",\"user_create\":\"User Create\",\"user_edit\":\"User Edit\",\"user_delete\":\"User Delete\",\"user_access\":\"User Access\",\"user_status\":\"User Status\",\"institute_create\":\"Institute Create\",\"institute_edit\":\"Institute Edit\",\"institute_delete\":\"Institute Delete\",\"institute_access\":\"Institute Access\",\"institute_status\":\"Institute Status\",\"manage_account\":\"Manage Accounts\",\"head_create\":\"Head Create\",\"head_edit\":\"Head Edit\",\"head_delete\":\"Head Delete\",\"subhead_create\":\"Subhead Create\",\"subhead_edit\":\"Subhead Edit\",\"subhead_delete\":\"Subhead Delete\",\"particular_create\":\"Particular Create\",\"particular_edit\":\"Particular Edit\",\"particular_delete\":\"Particular Delete\",\"transaction\":\"Transaction\",\"ledger\":\"Ledger\",\"daily_sheet\":\"Daily Sheet\"}', 'dc02ew21a0ya639kq912qx2tglf0si96'),
(12, 12, '{\"setting\":\"Setting\",\"generel_setting\":\"General Setting\",\"generel_setting_update\":\"General Setting Update\",\"chamber_setting\":\"Chamber Setting\",\"mill_setting\":\"Mill Setting\",\"manage_category\":\"Manage Category\",\"manage_purchase\":\"Manage Purchase\",\"purchase_create\":\"Purchase Create\",\"purchase_edit\":\"Purchase Edit\",\"purchase_delete\":\"Purchase Delete\",\"manage_rawbricks\":\"Manage Raw Bricks\",\"rawbricks_delete\":\"Raw Bricks Delete\",\"manage_loading\":\"Manage Loading\",\"loading_delete\":\"Loading Delete\",\"manage_unloading\":\"Manage Unloading\",\"unloading_delete\":\"Unloading Delete\",\"manage_sales\":\"Manage Sales\",\"sale_create\":\"Sale Create\",\"sale_edit\":\"Sale Edit\",\"sale_delete\":\"Sale Delete\",\"manage_customer\":\"Manage Customer\",\"manage_supplier\":\"Manage Supplier\",\"customer_create\":\"Customer Create\",\"customer_edit\":\"Customer Edit\",\"customer_delete\":\"Customer Delete\",\"supplier_create\":\"Supplier Create\",\"supplier_edit\":\"Supplier Edit\",\"supplier_delete\":\"Supplier Delete\",\"manage_stocks\":\"Manage Stocks\",\"manage_user\":\"Manage User\",\"user_create\":\"User Create\",\"user_edit\":\"User Edit\",\"user_delete\":\"User Delete\",\"user_access\":\"User Access\",\"user_status\":\"User Status\",\"institute_create\":\"Institute Create\",\"institute_edit\":\"Institute Edit\",\"institute_delete\":\"Institute Delete\",\"institute_access\":\"Institute Access\",\"institute_status\":\"Institute Status\",\"manage_account\":\"Manage Accounts\",\"head_create\":\"Head Create\",\"head_edit\":\"Head Edit\",\"head_delete\":\"Head Delete\",\"subhead_create\":\"Subhead Create\",\"subhead_edit\":\"Subhead Edit\",\"subhead_delete\":\"Subhead Delete\",\"particular_create\":\"Particular Create\",\"particular_edit\":\"Particular Edit\",\"particular_delete\":\"Particular Delete\",\"transaction\":\"Transaction\",\"ledger\":\"Ledger\",\"daily_sheet\":\"Daily Sheet\"}', '9cb8c4c1ee36d837222cf08db4866ad9'),
(13, 13, '{\"setting\":\"Setting\",\"generel_setting\":\"General Setting\",\"generel_setting_update\":\"General Setting Update\",\"chamber_setting\":\"Chamber Setting\",\"mill_setting\":\"Mill Setting\",\"manage_category\":\"Manage Category\",\"manage_purchase\":\"Manage Purchase\",\"purchase_create\":\"Purchase Create\",\"purchase_edit\":\"Purchase Edit\",\"purchase_delete\":\"Purchase Delete\",\"manage_rawbricks\":\"Manage Raw Bricks\",\"rawbricks_delete\":\"Raw Bricks Delete\",\"manage_loading\":\"Manage Loading\",\"loading_delete\":\"Loading Delete\",\"manage_unloading\":\"Manage Unloading\",\"unloading_delete\":\"Unloading Delete\",\"manage_sales\":\"Manage Sales\",\"sale_create\":\"Sale Create\",\"sale_edit\":\"Sale Edit\",\"sale_delete\":\"Sale Delete\",\"manage_customer\":\"Manage Customer\",\"manage_supplier\":\"Manage Supplier\",\"customer_create\":\"Customer Create\",\"customer_edit\":\"Customer Edit\",\"customer_delete\":\"Customer Delete\",\"supplier_create\":\"Supplier Create\",\"supplier_edit\":\"Supplier Edit\",\"supplier_delete\":\"Supplier Delete\",\"manage_stocks\":\"Manage Stocks\",\"manage_user\":\"Manage User\",\"user_create\":\"User Create\",\"user_edit\":\"User Edit\",\"user_delete\":\"User Delete\",\"user_access\":\"User Access\",\"user_status\":\"User Status\",\"institute_create\":\"Institute Create\",\"institute_edit\":\"Institute Edit\",\"institute_delete\":\"Institute Delete\",\"institute_access\":\"Institute Access\",\"institute_status\":\"Institute Status\",\"manage_account\":\"Manage Accounts\",\"head_create\":\"Head Create\",\"head_edit\":\"Head Edit\",\"head_delete\":\"Head Delete\",\"subhead_create\":\"Subhead Create\",\"subhead_edit\":\"Subhead Edit\",\"subhead_delete\":\"Subhead Delete\",\"particular_create\":\"Particular Create\",\"particular_edit\":\"Particular Edit\",\"particular_delete\":\"Particular Delete\",\"transaction\":\"Transaction\",\"ledger\":\"Ledger\",\"daily_sheet\":\"Daily Sheet\"}', 'e0545395b889c4f952f4163a51238f80'),
(14, 14, '{\"setting\":\"Setting\",\"generel_setting\":\"General Setting\",\"generel_setting_update\":\"General Setting Update\",\"chamber_setting\":\"Chamber Setting\",\"mill_setting\":\"Mill Setting\",\"manage_category\":\"Manage Category\",\"manage_purchase\":\"Manage Purchase\",\"purchase_create\":\"Purchase Create\",\"purchase_edit\":\"Purchase Edit\",\"purchase_delete\":\"Purchase Delete\",\"manage_rawbricks\":\"Manage Raw Bricks\",\"rawbricks_delete\":\"Raw Bricks Delete\",\"manage_loading\":\"Manage Loading\",\"loading_delete\":\"Loading Delete\",\"manage_unloading\":\"Manage Unloading\",\"unloading_delete\":\"Unloading Delete\",\"manage_sales\":\"Manage Sales\",\"sale_create\":\"Sale Create\",\"sale_edit\":\"Sale Edit\",\"sale_delete\":\"Sale Delete\",\"manage_customer\":\"Manage Customer\",\"manage_supplier\":\"Manage Supplier\",\"customer_create\":\"Customer Create\",\"customer_edit\":\"Customer Edit\",\"customer_delete\":\"Customer Delete\",\"supplier_create\":\"Supplier Create\",\"supplier_edit\":\"Supplier Edit\",\"supplier_delete\":\"Supplier Delete\",\"manage_stocks\":\"Manage Stocks\",\"manage_user\":\"Manage User\",\"user_create\":\"User Create\",\"user_edit\":\"User Edit\",\"user_delete\":\"User Delete\",\"user_access\":\"User Access\",\"user_status\":\"User Status\",\"institute_create\":\"Institute Create\",\"institute_edit\":\"Institute Edit\",\"institute_delete\":\"Institute Delete\",\"institute_access\":\"Institute Access\",\"institute_status\":\"Institute Status\",\"manage_account\":\"Manage Accounts\",\"head_create\":\"Head Create\",\"head_edit\":\"Head Edit\",\"head_delete\":\"Head Delete\",\"subhead_create\":\"Subhead Create\",\"subhead_edit\":\"Subhead Edit\",\"subhead_delete\":\"Subhead Delete\",\"particular_create\":\"Particular Create\",\"particular_edit\":\"Particular Edit\",\"particular_delete\":\"Particular Delete\",\"transaction\":\"Transaction\",\"ledger\":\"Ledger\",\"daily_sheet\":\"Daily Sheet\"}', '1aa975e274924b81130a241b4f96181f');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nozel_setting`
--

CREATE TABLE `nozel_setting` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `deep_id` int(11) DEFAULT NULL,
  `station_id` int(11) DEFAULT NULL,
  `nozel_no` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `_key` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nozel_setting`
--

INSERT INTO `nozel_setting` (`id`, `institute_id`, `deep_id`, `station_id`, `nozel_no`, `created_at`, `created_by`, `updated_at`, `updated_by`, `_key`) VALUES
(1, 12, 4, 3, 'নজেল-০2', '2018-10-15 23:41:16', NULL, '2018-10-16 00:15:00', NULL, 'd659ad655a55a6cf55ccea643ec7293f'),
(2, 12, 4, 3, 'নজেল-01', '2018-10-15 23:41:16', NULL, '2018-10-16 00:15:05', NULL, '1208422495ccfcc06680fc2c1cd6e5e6');

-- --------------------------------------------------------

--
-- Table structure for table `particulars`
--

CREATE TABLE `particulars` (
  `id` int(10) UNSIGNED NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `head_id` int(11) DEFAULT NULL,
  `subhead_id` int(11) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `address` text,
  `name` varchar(200) DEFAULT NULL,
  `company_name` varchar(150) DEFAULT NULL,
  `mon` double DEFAULT NULL,
  `commission` double DEFAULT NULL,
  `code` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(12) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `_key` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `particulars`
--

INSERT INTO `particulars` (`id`, `institute_id`, `head_id`, `subhead_id`, `mobile`, `address`, `name`, `company_name`, `mon`, `commission`, `code`, `created_at`, `created_by`, `modified_at`, `modified_by`, `is_deleted`, `_key`) VALUES
(10, 13, 20, 57, '99', 'sdfsdf', 'Kamal hasan', 'ljlj', NULL, NULL, 1533638560, '2018-08-07 10:42:40', NULL, NULL, NULL, 0, 'c48276699d75c82e655afde915c2e9de'),
(11, 12, 28, 59, NULL, NULL, 'Rajib Ahmed', NULL, NULL, NULL, 1534062176, '2018-08-12 08:22:56', NULL, NULL, NULL, 0, '39cbbf012aa36df7073fa47ba93a11dd'),
(12, 12, 28, 59, NULL, NULL, 'Raton Mia', NULL, NULL, NULL, 1534062188, '2018-08-12 08:23:08', NULL, NULL, NULL, 0, '92f2d7dbae8a5ad4d282093062e6fd80'),
(13, 12, 28, 60, NULL, NULL, 'Ripon', NULL, NULL, NULL, 1534062196, '2018-08-12 08:23:16', NULL, NULL, NULL, 0, 'f5baf000e949d4bbfa72bdbd974fb251'),
(14, 13, 20, 57, NULL, NULL, 'Sajib', NULL, NULL, NULL, 1534062205, '2018-08-12 08:23:25', NULL, NULL, NULL, 0, '130d43aaef92c056ca4c08001e8a8671'),
(15, 13, 20, 61, NULL, NULL, 'Ryad', NULL, NULL, NULL, 1534062218, '2018-08-12 08:23:38', NULL, NULL, NULL, 0, 'a1b7e1a073f344867d6c904c5a3ff5c5'),
(16, 12, 30, 70, NULL, NULL, 'Hasan Ali', NULL, NULL, NULL, 1534412937, '2018-08-16 09:48:57', NULL, NULL, NULL, 0, 'c6f165b324e3142e16172aea66fc821f'),
(17, 12, 30, 71, NULL, NULL, 'Kashem Ali', NULL, NULL, NULL, 1534412964, '2018-08-16 09:49:24', NULL, NULL, NULL, 0, 'b8a65d7c506d03d19abfa46dac511628'),
(18, 12, 30, 70, NULL, NULL, 'Najjim Ahmed', NULL, NULL, NULL, 1534420022, '2018-08-16 11:47:02', NULL, NULL, NULL, 0, '56e235474404af34fff6ec929d7ddc10'),
(19, 13, 31, 77, NULL, NULL, 'Billah', NULL, NULL, NULL, 1534422261, '2018-08-16 12:24:21', NULL, NULL, NULL, 0, '06dbb2abf061e882bddb36e298c051b1'),
(20, 13, 31, 78, NULL, NULL, 'Shofiqul Islam', NULL, NULL, NULL, 1536388665, '2018-09-08 06:37:45', NULL, NULL, NULL, 0, 'cd34f0fbc873ac1ef1f53dbeb38348e0'),
(21, 13, 31, 78, NULL, NULL, 'Nadim', NULL, NULL, NULL, 1536388683, '2018-09-08 06:38:03', NULL, NULL, NULL, 0, '797d48c26b63c87e58ed5f1d8a643c30');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `unit_name` enum('Liter','piece') DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `_key` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `institute_id`, `category_id`, `product_name`, `unit_name`, `created_at`, `created_by`, `updated_at`, `updated_by`, `_key`) VALUES
(1, 12, 4, 'Petrol', 'Liter', '2018-10-11 23:32:29', NULL, NULL, NULL, NULL),
(4, 12, 5, 'Octen', NULL, '2018-10-12 19:42:44', NULL, '2018-10-12 20:35:05', NULL, '815894'),
(5, 12, 4, 'Petrol', NULL, '2018-10-12 19:42:44', NULL, NULL, NULL, '1'),
(6, 12, 4, 'Petrol', NULL, '2018-10-12 19:53:17', NULL, NULL, NULL, '5'),
(7, 12, 4, 'Petrol', NULL, '2018-10-12 19:53:17', NULL, NULL, NULL, '1'),
(8, 12, 4, 'Petrol', NULL, '2018-10-12 19:54:45', NULL, '2018-10-12 20:34:49', NULL, '329180'),
(9, 12, 5, 'Petrol', NULL, '2018-10-12 19:56:00', NULL, '2018-10-12 20:35:16', NULL, '0'),
(10, 12, 4, 'Octen', NULL, '2018-10-12 19:56:00', NULL, NULL, NULL, '0'),
(11, 12, 5, 'MOBIL', NULL, '2018-10-12 19:58:14', NULL, NULL, NULL, '529792'),
(12, 12, 5, 'MOBIL', NULL, '2018-10-12 19:58:43', NULL, NULL, NULL, '0'),
(13, 12, 5, 'Petrol', NULL, '2018-10-12 19:58:43', NULL, NULL, NULL, '10'),
(14, 12, 4, 'MOBIL', NULL, '2018-10-18 12:34:10', NULL, NULL, NULL, '0'),
(15, 12, 4, 'MOBIL', NULL, '2018-10-18 12:34:10', NULL, NULL, NULL, '1'),
(16, 12, 4, 'Petrol', NULL, '2018-10-18 12:49:52', NULL, NULL, NULL, '9');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_challan`
--

CREATE TABLE `purchase_challan` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `purchase_order_Id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_Id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `quantity` double(12,3) DEFAULT NULL,
  `amount` double(12,3) DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `pay_order_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `do_no` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supply_chain_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `by_whom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vehicle_type` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vehicle_no` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `driver_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(2) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `_key` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_item`
--

CREATE TABLE `purchase_item` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `purchase_order_Id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_Id` int(11) NOT NULL,
  `quantity` double(12,3) DEFAULT NULL,
  `amount` double(12,3) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `pay_amount` double DEFAULT NULL,
  `status` tinyint(2) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `_key` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `order_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pay_type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_quantity` double DEFAULT NULL,
  `grand_total` double(12,2) NOT NULL,
  `request_date` date DEFAULT NULL,
  `status` tinyint(2) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `_key` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `station_setting`
--

CREATE TABLE `station_setting` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `deep_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `station_name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `_key` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `station_setting`
--

INSERT INTO `station_setting` (`id`, `institute_id`, `deep_id`, `category_id`, `product_id`, `station_name`, `created_at`, `created_by`, `updated_at`, `updated_by`, `_key`) VALUES
(3, 12, 4, 4, 1, 'Station 02', '2018-10-15 23:08:41', NULL, NULL, NULL, '4');

-- --------------------------------------------------------

--
-- Table structure for table `subheads`
--

CREATE TABLE `subheads` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `head_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `code` int(11) NOT NULL,
  `is_edible` tinyint(2) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0',
  `_key` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subheads`
--

INSERT INTO `subheads` (`id`, `institute_id`, `head_id`, `name`, `code`, `is_edible`, `is_deleted`, `_key`) VALUES
(53, 12, 14, 'Cash Account', 1533626009, 1, 0, 'd192658e614356e5f336c9c6b68ec25b'),
(55, 13, 17, 'Cash Account', 1533630869, 1, 0, 'eba05505dcfefaebd310db479f5f2672'),
(57, 13, 20, 'Coila Supplier', 1533630923, 1, 0, '4d695491fa33dc4be492b90a874c5522'),
(58, 12, 27, 'Customer', 1534062124, 1, 0, '392f1164999c40f04d9aea9343d6caef'),
(59, 12, 28, 'Coila Supplier', 1534062146, 1, 0, 'ad8c42a10e5bfb0452cd82e5e099faf1'),
(60, 12, 28, 'Soil Supplier', 1534062147, 1, 0, 'bc1d1f17246e2cd2da711400e9037b86'),
(61, 13, 20, 'Soil Supplier', 1534062160, 1, 0, '27c8e5af1acc34028ffbe66c46611023'),
(62, 13, 25, 'Soil Purchase', 1534231228, 1, 0, 'b2dbfaa681a7a38c88e6b63d740b0a4a'),
(66, 13, 25, 'Coila Purchase', 1534231264, 1, 0, 'c9e5136643662bfdaa1f4aba88a0d386'),
(68, 12, 29, 'Soil Purchase', 1534233878, 1, 0, 'e421e967d544f9764a8167febfad9fd7'),
(69, 12, 29, 'Coila Purchase', 1534233879, 1, 0, '81067e4346245c1490f083b0345d6b3f'),
(70, 12, 30, 'Mill party', 1534412550, 1, 0, '60d9ceebb4b5cae8f8c4be9e5f4c0451'),
(71, 12, 30, 'Reza party', 1534412551, 1, 0, 'eb7384e9e41fcdb11e09a9d942365bc1'),
(72, 12, 30, 'Reza Mistri', 1534412552, 1, 0, '978687a6e693bb0d4e8df1e1a9228cc5'),
(73, 12, 30, 'Chamber Rubbish party', 1534412553, 1, 0, '742df68ef0126118081f87fa1bd2dca7'),
(74, 12, 30, 'Unloading Party', 1534412554, 1, 0, '72afce8ab9109e31bf61cc124fc6707a'),
(75, 12, 30, 'Coal Break party', 1534412555, 1, 0, '17fe6df23e18205fccb337fbbe3b0635'),
(76, 12, 30, 'Coal burning party', 1534412556, 1, 0, '238e27e8319c8c3829646133bce72449'),
(77, 13, 31, 'Mill Party', 1534412732, 1, 0, '5e5998732534900cfbc9012e310b78dd'),
(78, 13, 31, 'Reza party', 1534412733, 1, 0, '5a1a90b0dbe7250dce3de5eb8287fe7e'),
(79, 13, 31, 'Reza Mistri', 1534412734, 1, 0, '90d13278948ec7e2510bc1fcdb9cc22f'),
(80, 13, 31, 'Chamber Rubbish party ', 1534412735, 1, 0, '018d55c13405d26b0317b120cda53cc2'),
(81, 13, 31, 'Unloading Party', 1534412736, 1, 0, '9d13ed26cb707fcb24dc6525d90cee63'),
(82, 13, 31, 'Coal Break Party ', 1534412737, 1, 0, '3d77cf09c3e7dd1e71e5192436d03802'),
(83, 13, 31, 'Coal burning party', 1534412738, 1, 0, '69e1946b1a584c3076e6dcf017a2e787'),
(84, 13, 31, 'Fire Mistri', 1534412739, 1, 0, '19869c57eb5cc900af7fd1fc4aab5912'),
(85, 12, 30, 'Fire Mistri', 1534412763, 1, 0, 'a3d1ea3506a2ca18785eed956b087816');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_setting`
--

CREATE TABLE `supplier_setting` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `supplier_name` varchar(200) DEFAULT NULL,
  `address` text,
  `mobile_no` varchar(30) DEFAULT NULL,
  `phone_no` varchar(30) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `_key` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier_setting`
--

INSERT INTO `supplier_setting` (`id`, `institute_id`, `company_id`, `supplier_name`, `address`, `mobile_no`, `phone_no`, `description`, `created_at`, `created_by`, `updated_at`, `updated_by`, `_key`) VALUES
(1, 12, 2, 'sdfsdf', 'sdfsdf', 'sdf', 'sdfsdf', 'sdfsdf', '2018-10-21 23:25:00', 2, NULL, NULL, 'ae2b141e8c057d002e4674c51431d809');

-- --------------------------------------------------------

--
-- Table structure for table `tanklory_setting`
--

CREATE TABLE `tanklory_setting` (
  `id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `tank_lory_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `registration_no` varchar(50) DEFAULT NULL,
  `license_no` varchar(100) DEFAULT NULL,
  `chasiss_no` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `date_of_caliber` datetime DEFAULT NULL,
  `validity` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `vehicle_no` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `notes` text CHARACTER SET utf8,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `_key` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tanklory_setting`
--

INSERT INTO `tanklory_setting` (`id`, `institute_id`, `company_id`, `tank_lory_name`, `registration_date`, `registration_no`, `license_no`, `chasiss_no`, `date_of_caliber`, `validity`, `vehicle_no`, `notes`, `created_by`, `created_at`, `updated_by`, `updated_at`, `_key`) VALUES
(3, 12, 2, 'Tanklory 01', '2018-10-11', 'sd', 'asd', 'asd', '2018-10-15 00:00:00', 'asda', 'asd', 'asdasd', NULL, '2018-10-14 00:04:33', NULL, '2018-10-14 00:07:27', '740d36ea499655a92fbaf4e7b01c2f'),
(4, 12, 2, 'Tanklory 02', '2018-10-14', 'asdasd', 'asdasdasd', 'asdasd', '2018-10-14 00:00:00', 'asdasd', 'asdasd', 'asdasd', NULL, '2018-10-14 01:14:23', NULL, NULL, 'e91ef6461a3a63218d218c6d4df2f7');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `purchase_coal_id` int(11) DEFAULT NULL,
  `type` enum('D','C') DEFAULT NULL,
  `voucher_type` enum('Payment Voucher','Receive Voucher','Purchase Voucher','Sales Voucher','Paddy Sales Voucher','Journal Voucher') DEFAULT NULL,
  `payment_method` enum('No Payment','Bank Payment','Cash Payment') DEFAULT NULL,
  `dr_head_id` int(15) DEFAULT NULL,
  `dr_subhead_id` int(15) DEFAULT NULL,
  `dr_particular_id` int(15) DEFAULT NULL,
  `cr_head_id` int(15) DEFAULT NULL,
  `cr_subhead_id` int(15) DEFAULT NULL,
  `cr_particular_id` int(15) DEFAULT NULL,
  `bank_account_id` int(10) UNSIGNED DEFAULT NULL,
  `check_no` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` text,
  `note` text,
  `by_whom` varchar(100) DEFAULT NULL,
  `debit` double DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `is_edible` tinyint(2) NOT NULL DEFAULT '0',
  `is_dbl` tinyint(4) NOT NULL DEFAULT '0',
  `_key` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `institute_id`, `purchase_id`, `sale_id`, `purchase_coal_id`, `type`, `voucher_type`, `payment_method`, `dr_head_id`, `dr_subhead_id`, `dr_particular_id`, `cr_head_id`, `cr_subhead_id`, `cr_particular_id`, `bank_account_id`, `check_no`, `date`, `description`, `note`, `by_whom`, `debit`, `credit`, `amount`, `created`, `created_by`, `modified`, `modified_by`, `is_edible`, `is_dbl`, `_key`) VALUES
(1, 13, NULL, NULL, NULL, 'C', 'Payment Voucher', NULL, 20, 57, 10, 17, 55, NULL, NULL, NULL, '2018-09-27', 'gfjjg', 'gfjjg', 'ghfhfg', 500, 500, 500, '2018-09-27 06:35:07', 26, NULL, NULL, 1, 0, 'eb795d87d27b6d3c91f5828bc2fe4d38'),
(2, 12, NULL, NULL, NULL, 'D', 'Receive Voucher', NULL, 14, 53, NULL, 28, 59, 11, NULL, NULL, '2018-10-21', 'ASDASD', 'ASDASD', 'ASDASD', 20000, 20000, 20000, '2018-10-21 16:39:10', 2, NULL, NULL, 1, 0, 'c27bf40144fc23e78dc7180e7a80129f');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `institute_id` int(10) DEFAULT NULL,
  `user_role_id` int(10) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'institute',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `is_loggedin` tinyint(1) NOT NULL DEFAULT '0',
  `lastlogin` timestamp NULL DEFAULT NULL,
  `locale` enum('en','bn') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(10) DEFAULT NULL,
  `_key` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `institute_id`, `user_role_id`, `name`, `type`, `email`, `password`, `status`, `is_loggedin`, `lastlogin`, `locale`, `remember_token`, `created_at`, `created_by`, `updated_at`, `updated_by`, `_key`) VALUES
(2, 1, 1, 'Legend Admin', 'admin', 'admin@gmail.com', '$2y$10$tmd4k3lQMeX30ChEjKWtP.e9EqTpv73enTIqQnZeLVyYZ/skkwaNy', 1, 1, NULL, 'bn', 'Gjj3wRBenPIbBY34F7xqHfKkLlggeMrR4pEHrBOBc6v45OuPSSdBeEEGa2Cu', NULL, 2, '2018-10-11 02:42:35', 2, 'dc0g5w21a0ya63pob912qbddglf0si96'),
(26, 1, 1, 'Motahar', 'admin', 'mrhsajib.cse@gmail.com', '$2y$10$aHSECQ0Ar/olV0cwI3QHFuqD7iOhkOjaExn3fArr7C6guKl2StrZC', 1, 1, NULL, 'bn', 'svnrwlDWXJ4Klbej9M1KMavvomTcGkgziKc4fowohNO6zxwlqkpkQmJpVRqk', '2018-02-06 09:12:48', 2, '2018-09-27 00:25:18', 26, 'dc0b1121a0946355b91e8bddbbf0ffe6'),
(31, 12, 1, 'NN Bricks 1', 'institute', 'nn1@gmail.com', '$2y$10$Kx3l74slFGdDD3v4zupeIObfMPeU58XmY98tM5ElZGt/wev3t8mQK', 1, 0, NULL, 'bn', 'NIxPCD3NiON1h007uQl6xIbXWyPFbRPCctcbYg2fGyl0OnLHFIoizE5s2Pau', '2018-02-06 11:44:32', 2, '2018-08-30 06:15:02', 31, 'da406e5ba774410f48204fcb1fd3b4d4'),
(32, 13, 1, 'NN Bricks 2', 'institute', 'nn2@gmail.com', '$2y$10$KUOYsFhqFL0Nw.gNzyu8deGAkj8eZbyTMN98YD8P7TAw3FbuHim7O', 1, 1, NULL, 'bn', 'c0fWuu2SNeWOrn0flSmWz2oaWOxIVu7VrKbNUnlu8QL1or340FAaqH7fjUlg', '2018-02-06 11:44:53', 2, '2018-08-12 02:58:59', 32, '2383f28135caec532d087d1570948f8f'),
(33, 14, 1, 'NN Bricks 3', 'institute', 'nn3@gmail.com', '$2y$10$tc.WFjV2ICC3OF80SwEiyOmXZOTifDKNdpVWvr3AT1FNyM6nZ5N66', 1, 0, NULL, 'en', 'NDvRvckLOrPTauFDu7YNqelLVZASi9WyTAuFWyFwuiA80QftFQuwr1q021ca', '2018-02-06 11:45:34', 2, '2018-08-12 08:58:12', NULL, '8caeac9e91b651a3eae731b9383d88aa'),
(34, 14, 2, 'Mashrafi', 'institute', 'nn3new@gmail.com', '$2y$10$7AhbaFlFGWR/XkjrbxnnYOZpWlmo3ZP5oSmNyMaWTd9z6UtlMwAuG', 1, 0, NULL, 'en', 'dK74n7TVi8BhVmbMDI3z3UYPW9j9sqQ3nsD0oI0vIY092D2dhPidGnhMAoAH', '2018-02-26 11:59:08', 33, '2018-02-26 12:00:58', NULL, 'a5ab0ddfcc243df2f6d8d2db0ae226c0'),
(35, 12, 2, 'tareq', 'institute', 'tareq@gmail.com', '$2y$10$9eWteSZ3CRnjfnf/2Xj3R.ILBc6Nh8iS/yQ.IyqBO8qvylI/G0dd2', 1, 0, NULL, 'en', '168xQqgJuhECoSc05yPx5kVSgCDxPUUNEC8xiubM1i1wVQQsAMJJ7vtSvbjX', '2018-10-11 05:33:22', 2, '2018-10-11 08:42:25', NULL, 'ad4e41067ca78c786dd91797795f013c');

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `id` int(20) NOT NULL,
  `institute_id` int(20) DEFAULT NULL,
  `user_id` int(20) DEFAULT NULL,
  `user_type` varchar(30) DEFAULT NULL,
  `permissions` text,
  `_key` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_permissions`
--

INSERT INTO `user_permissions` (`id`, `institute_id`, `user_id`, `user_type`, `permissions`, `_key`) VALUES
(3, 1, 2, NULL, '{\"setting\":\"Setting\",\"generel_setting\":\"General Setting\",\"generel_setting_update\":\"General Setting Update\",\"chamber_setting\":\"Chamber Setting\",\"mill_setting\":\"Mill Setting\",\"manage_category\":\"Manage Category\",\"manage_purchase\":\"Manage Purchase\",\"purchase_create\":\"Purchase Create\",\"purchase_edit\":\"Purchase Edit\",\"purchase_delete\":\"Purchase Delete\",\"manage_rawbricks\":\"Manage Raw Bricks\",\"rawbricks_delete\":\"Raw Bricks Delete\",\"manage_loading\":\"Manage Loading\",\"loading_delete\":\"Loading Delete\",\"manage_unloading\":\"Manage Unloading\",\"unloading_delete\":\"Unloading Delete\",\"manage_sales\":\"Manage Sales\",\"sale_create\":\"Sale Create\",\"sale_edit\":\"Sale Edit\",\"sale_delete\":\"Sale Delete\",\"manage_customer\":\"Manage Customer\",\"manage_supplier\":\"Manage Supplier\",\"customer_create\":\"Customer Create\",\"customer_edit\":\"Customer Edit\",\"customer_delete\":\"Customer Delete\",\"supplier_create\":\"Supplier Create\",\"supplier_edit\":\"Supplier Edit\",\"supplier_delete\":\"Supplier Delete\",\"manage_stocks\":\"Manage Stocks\",\"manage_user\":\"Manage User\",\"user_create\":\"User Create\",\"user_edit\":\"User Edit\",\"user_delete\":\"User Delete\",\"user_access\":\"User Access\",\"user_status\":\"User Status\",\"institute_create\":\"Institute Create\",\"institute_edit\":\"Institute Edit\",\"institute_delete\":\"Institute Delete\",\"institute_access\":\"Institute Access\",\"institute_status\":\"Institute Status\",\"manage_account\":\"Manage Accounts\",\"head_create\":\"Head Create\",\"head_edit\":\"Head Edit\",\"head_delete\":\"Head Delete\",\"subhead_create\":\"Subhead Create\",\"subhead_edit\":\"Subhead Edit\",\"subhead_delete\":\"Subhead Delete\",\"particular_create\":\"Particular Create\",\"particular_edit\":\"Particular Edit\",\"particular_delete\":\"Particular Delete\",\"transaction\":\"Transaction\",\"ledger\":\"Ledger\",\"daily_sheet\":\"Daily Sheet\"}', 'dc0g5w21a0ya63pob912qbddglf0si96'),
(27, 1, 26, NULL, '{\"setting\":\"Setting\",\"generel_setting\":\"General Setting\",\"generel_setting_update\":\"General Setting Update\",\"chamber_setting\":\"Chamber Setting\",\"mill_setting\":\"Mill Setting\",\"manage_category\":\"Manage Category\",\"manage_purchase\":\"Manage Purchase\",\"purchase_create\":\"Purchase Create\",\"purchase_edit\":\"Purchase Edit\",\"purchase_delete\":\"Purchase Delete\",\"manage_rawbricks\":\"Manage Raw Bricks\",\"rawbricks_delete\":\"Raw Bricks Delete\",\"manage_loading\":\"Manage Loading\",\"loading_delete\":\"Loading Delete\",\"manage_unloading\":\"Manage Unloading\",\"unloading_delete\":\"Unloading Delete\",\"manage_sales\":\"Manage Sales\",\"sale_create\":\"Sale Create\",\"sale_edit\":\"Sale Edit\",\"sale_delete\":\"Sale Delete\",\"manage_customer\":\"Manage Customer\",\"manage_supplier\":\"Manage Supplier\",\"customer_create\":\"Customer Create\",\"customer_edit\":\"Customer Edit\",\"customer_delete\":\"Customer Delete\",\"supplier_create\":\"Supplier Create\",\"supplier_edit\":\"Supplier Edit\",\"supplier_delete\":\"Supplier Delete\",\"manage_stocks\":\"Manage Stocks\",\"manage_user\":\"Manage User\",\"user_create\":\"User Create\",\"user_edit\":\"User Edit\",\"user_delete\":\"User Delete\",\"user_access\":\"User Access\",\"user_status\":\"User Status\",\"institute_create\":\"Institute Create\",\"institute_edit\":\"Institute Edit\",\"institute_delete\":\"Institute Delete\",\"institute_access\":\"Institute Access\",\"institute_status\":\"Institute Status\",\"manage_account\":\"Manage Accounts\",\"head_create\":\"Head Create\",\"head_edit\":\"Head Edit\",\"head_delete\":\"Head Delete\",\"subhead_create\":\"Subhead Create\",\"subhead_edit\":\"Subhead Edit\",\"subhead_delete\":\"Subhead Delete\",\"particular_create\":\"Particular Create\",\"particular_edit\":\"Particular Edit\",\"particular_delete\":\"Particular Delete\",\"transaction\":\"Transaction\",\"ledger\":\"Ledger\",\"daily_sheet\":\"Daily Sheet\"}', 'dc0b1121a0946355b91e8bddbbf0ffe6'),
(32, 12, 31, NULL, '{\"setting\":\"Setting\",\"generel_setting\":\"General Setting\",\"generel_setting_update\":\"General Setting Update\",\"chamber_setting\":\"Chamber Setting\",\"mill_setting\":\"Mill Setting\",\"manage_category\":\"Manage Category\",\"manage_purchase\":\"Manage Purchase\",\"purchase_create\":\"Purchase Create\",\"purchase_edit\":\"Purchase Edit\",\"purchase_delete\":\"Purchase Delete\",\"manage_rawbricks\":\"Manage Raw Bricks\",\"rawbricks_delete\":\"Raw Bricks Delete\",\"manage_loading\":\"Manage Loading\",\"loading_delete\":\"Loading Delete\",\"manage_unloading\":\"Manage Unloading\",\"unloading_delete\":\"Unloading Delete\",\"manage_sales\":\"Manage Sales\",\"sale_create\":\"Sale Create\",\"sale_edit\":\"Sale Edit\",\"sale_delete\":\"Sale Delete\",\"manage_customer\":\"Manage Customer\",\"manage_supplier\":\"Manage Supplier\",\"customer_create\":\"Customer Create\",\"customer_edit\":\"Customer Edit\",\"customer_delete\":\"Customer Delete\",\"supplier_create\":\"Supplier Create\",\"supplier_edit\":\"Supplier Edit\",\"supplier_delete\":\"Supplier Delete\",\"manage_stocks\":\"Manage Stocks\",\"manage_user\":\"Manage User\",\"user_create\":\"User Create\",\"user_edit\":\"User Edit\",\"user_delete\":\"User Delete\",\"user_access\":\"User Access\",\"user_status\":\"User Status\",\"institute_create\":\"Institute Create\",\"institute_edit\":\"Institute Edit\",\"institute_delete\":\"Institute Delete\",\"institute_access\":\"Institute Access\",\"institute_status\":\"Institute Status\",\"manage_account\":\"Manage Accounts\",\"head_create\":\"Head Create\",\"head_edit\":\"Head Edit\",\"head_delete\":\"Head Delete\",\"subhead_create\":\"Subhead Create\",\"subhead_edit\":\"Subhead Edit\",\"subhead_delete\":\"Subhead Delete\",\"particular_create\":\"Particular Create\",\"particular_edit\":\"Particular Edit\",\"particular_delete\":\"Particular Delete\",\"transaction\":\"Transaction\",\"ledger\":\"Ledger\",\"daily_sheet\":\"Daily Sheet\"}', 'da406e5ba774410f48204fcb1fd3b4d4'),
(33, 13, 32, NULL, '{\"setting\":\"Setting\",\"generel_setting\":\"General Setting\",\"generel_setting_update\":\"General Setting Update\",\"chamber_setting\":\"Chamber Setting\",\"mill_setting\":\"Mill Setting\",\"manage_category\":\"Manage Category\",\"manage_purchase\":\"Manage Purchase\",\"purchase_create\":\"Purchase Create\",\"purchase_edit\":\"Purchase Edit\",\"purchase_delete\":\"Purchase Delete\",\"manage_rawbricks\":\"Manage Raw Bricks\",\"rawbricks_delete\":\"Raw Bricks Delete\",\"manage_loading\":\"Manage Loading\",\"loading_delete\":\"Loading Delete\",\"manage_unloading\":\"Manage Unloading\",\"unloading_delete\":\"Unloading Delete\",\"manage_sales\":\"Manage Sales\",\"sale_create\":\"Sale Create\",\"sale_edit\":\"Sale Edit\",\"sale_delete\":\"Sale Delete\",\"manage_customer\":\"Manage Customer\",\"manage_supplier\":\"Manage Supplier\",\"customer_create\":\"Customer Create\",\"customer_edit\":\"Customer Edit\",\"customer_delete\":\"Customer Delete\",\"supplier_create\":\"Supplier Create\",\"supplier_edit\":\"Supplier Edit\",\"supplier_delete\":\"Supplier Delete\",\"manage_stocks\":\"Manage Stocks\",\"manage_user\":\"Manage User\",\"user_create\":\"User Create\",\"user_edit\":\"User Edit\",\"user_delete\":\"User Delete\",\"user_access\":\"User Access\",\"user_status\":\"User Status\",\"institute_create\":\"Institute Create\",\"institute_edit\":\"Institute Edit\",\"institute_delete\":\"Institute Delete\",\"institute_access\":\"Institute Access\",\"institute_status\":\"Institute Status\",\"manage_account\":\"Manage Accounts\",\"head_create\":\"Head Create\",\"head_edit\":\"Head Edit\",\"head_delete\":\"Head Delete\",\"subhead_create\":\"Subhead Create\",\"subhead_edit\":\"Subhead Edit\",\"subhead_delete\":\"Subhead Delete\",\"particular_create\":\"Particular Create\",\"particular_edit\":\"Particular Edit\",\"particular_delete\":\"Particular Delete\",\"transaction\":\"Transaction\",\"ledger\":\"Ledger\",\"daily_sheet\":\"Daily Sheet\"}', '2383f28135caec532d087d1570948f8f'),
(34, 14, 33, NULL, '{\"setting\":\"Setting\",\"generel_setting\":\"General Setting\",\"generel_setting_update\":\"General Setting Update\",\"chamber_setting\":\"Chamber Setting\",\"mill_setting\":\"Mill Setting\",\"manage_category\":\"Manage Category\",\"manage_purchase\":\"Manage Purchase\",\"purchase_create\":\"Purchase Create\",\"purchase_edit\":\"Purchase Edit\",\"purchase_delete\":\"Purchase Delete\",\"manage_rawbricks\":\"Manage Raw Bricks\",\"rawbricks_delete\":\"Raw Bricks Delete\",\"manage_loading\":\"Manage Loading\",\"loading_delete\":\"Loading Delete\",\"manage_unloading\":\"Manage Unloading\",\"unloading_delete\":\"Unloading Delete\",\"manage_sales\":\"Manage Sales\",\"sale_create\":\"Sale Create\",\"sale_edit\":\"Sale Edit\",\"sale_delete\":\"Sale Delete\",\"manage_supplier\":\"Manage Supplier\",\"customer_create\":\"Customer Create\",\"customer_edit\":\"Customer Edit\",\"customer_delete\":\"Customer Delete\",\"supplier_create\":\"Supplier Create\",\"supplier_edit\":\"Supplier Edit\",\"supplier_delete\":\"Supplier Delete\",\"manage_stocks\":\"Manage Stocks\",\"manage_user\":\"Manage User\",\"user_create\":\"User Create\",\"user_edit\":\"User Edit\",\"user_delete\":\"User Delete\",\"user_access\":\"User Access\",\"user_status\":\"User Status\",\"institute_create\":\"Institute Create\",\"institute_edit\":\"Institute Edit\",\"institute_delete\":\"Institute Delete\",\"institute_access\":\"Institute Access\",\"institute_status\":\"Institute Status\",\"manage_account\":\"Manage Accounts\",\"head_create\":\"Head Create\",\"head_edit\":\"Head Edit\",\"head_delete\":\"Head Delete\",\"subhead_create\":\"Subhead Create\",\"subhead_edit\":\"Subhead Edit\",\"subhead_delete\":\"Subhead Delete\",\"particular_create\":\"Particular Create\",\"particular_edit\":\"Particular Edit\",\"particular_delete\":\"Particular Delete\",\"transaction\":\"Transaction\",\"ledger\":\"Ledger\",\"daily_sheet\":\"Daily Sheet\"}', '8caeac9e91b651a3eae731b9383d88aa'),
(35, 14, 34, NULL, '{\"setting\":\"Setting\",\"generel_setting\":\"General Setting\",\"generel_setting_update\":\"General Setting Update\",\"chamber_setting\":\"Chamber Setting\",\"mill_setting\":\"Mill Setting\",\"manage_category\":\"Manage Category\",\"manage_purchase\":\"Manage Purchase\",\"purchase_create\":\"Purchase Create\",\"purchase_edit\":\"Purchase Edit\",\"purchase_delete\":\"Purchase Delete\",\"manage_rawbricks\":\"Manage Raw Bricks\",\"rawbricks_delete\":\"Raw Bricks Delete\",\"manage_loading\":\"Manage Loading\",\"loading_delete\":\"Loading Delete\",\"manage_unloading\":\"Manage Unloading\",\"unloading_delete\":\"Unloading Delete\"}', 'a5ab0ddfcc243df2f6d8d2db0ae226c0'),
(36, 12, 35, NULL, '{\"setting\":\"Setting\",\"generel_setting\":\"General Setting\",\"generel_setting_update\":\"General Setting Update\",\"chamber_setting\":\"Chamber Setting\",\"mill_setting\":\"Mill Setting\",\"manage_category\":\"Manage Category\",\"manage_purchase\":\"Manage Purchase\",\"purchase_create\":\"Purchase Create\",\"purchase_edit\":\"Purchase Edit\",\"purchase_delete\":\"Purchase Delete\",\"manage_rawbricks\":\"Manage Raw Bricks\",\"rawbricks_delete\":\"Raw Bricks Delete\",\"manage_loading\":\"Manage Loading\",\"loading_delete\":\"Loading Delete\",\"manage_unloading\":\"Manage Unloading\",\"unloading_delete\":\"Unloading Delete\",\"manage_sales\":\"Manage Sales\",\"sale_create\":\"Sale Create\",\"sale_edit\":\"Sale Edit\",\"sale_delete\":\"Sale Delete\",\"manage_customer\":\"Manage Customer\",\"manage_supplier\":\"Manage Supplier\",\"customer_create\":\"Customer Create\",\"customer_edit\":\"Customer Edit\",\"customer_delete\":\"Customer Delete\",\"supplier_create\":\"Supplier Create\",\"supplier_edit\":\"Supplier Edit\",\"supplier_delete\":\"Supplier Delete\",\"manage_stocks\":\"Manage Stocks\",\"manage_user\":\"Manage User\",\"user_create\":\"User Create\",\"user_edit\":\"User Edit\",\"user_delete\":\"User Delete\",\"user_access\":\"User Access\",\"user_status\":\"User Status\",\"institute_create\":\"Institute Create\",\"institute_edit\":\"Institute Edit\",\"institute_delete\":\"Institute Delete\",\"institute_access\":\"Institute Access\",\"institute_status\":\"Institute Status\",\"manage_account\":\"Manage Accounts\",\"head_create\":\"Head Create\",\"head_edit\":\"Head Edit\",\"head_delete\":\"Head Delete\",\"subhead_create\":\"Subhead Create\",\"subhead_edit\":\"Subhead Edit\",\"subhead_delete\":\"Subhead Delete\",\"particular_create\":\"Particular Create\",\"particular_edit\":\"Particular Edit\",\"particular_delete\":\"Particular Delete\",\"transaction\":\"Transaction\",\"ledger\":\"Ledger\",\"daily_sheet\":\"Daily Sheet\"}', 'ad4e41067ca78c786dd91797795f013c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_setting`
--
ALTER TABLE `account_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_setting`
--
ALTER TABLE `bank_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_setting`
--
ALTER TABLE `branch_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chamber_caliber_setting`
--
ALTER TABLE `chamber_caliber_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chamber_setting`
--
ALTER TABLE `chamber_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deeps`
--
ALTER TABLE `deeps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deep_caliber_setting`
--
ALTER TABLE `deep_caliber_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deep_setting`
--
ALTER TABLE `deep_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_info`
--
ALTER TABLE `employee_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `heads`
--
ALTER TABLE `heads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`),
  ADD KEY `institute_id` (`institute_id`);

--
-- Indexes for table `institutes`
--
ALTER TABLE `institutes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `mobile` (`mobile`),
  ADD KEY `code` (`code`),
  ADD KEY `email` (`email`),
  ADD KEY `is_fixed` (`is_fixed`);

--
-- Indexes for table `institute_permissions`
--
ALTER TABLE `institute_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nozel_setting`
--
ALTER TABLE `nozel_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `particulars`
--
ALTER TABLE `particulars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`),
  ADD KEY `institute_id` (`institute_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `station_setting`
--
ALTER TABLE `station_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subheads`
--
ALTER TABLE `subheads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `head_id` (`head_id`),
  ADD KEY `code` (`code`),
  ADD KEY `institute_id` (`institute_id`);

--
-- Indexes for table `supplier_setting`
--
ALTER TABLE `supplier_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tanklory_setting`
--
ALTER TABLE `tanklory_setting`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reg_no` (`registration_no`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`bank_account_id`),
  ADD KEY `type` (`type`),
  ADD KEY `ledger_head_id` (`dr_head_id`),
  ADD KEY `transaction_date` (`date`),
  ADD KEY `sub_head_id` (`cr_head_id`),
  ADD KEY `is_edible` (`is_edible`),
  ADD KEY `purchase_id` (`purchase_id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `empty_bag_id` (`purchase_coal_id`),
  ADD KEY `institute_id` (`institute_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_setting`
--
ALTER TABLE `account_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_setting`
--
ALTER TABLE `bank_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branch_setting`
--
ALTER TABLE `branch_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chamber_caliber_setting`
--
ALTER TABLE `chamber_caliber_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chamber_setting`
--
ALTER TABLE `chamber_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `deeps`
--
ALTER TABLE `deeps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `deep_caliber_setting`
--
ALTER TABLE `deep_caliber_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `deep_setting`
--
ALTER TABLE `deep_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee_info`
--
ALTER TABLE `employee_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `heads`
--
ALTER TABLE `heads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `institutes`
--
ALTER TABLE `institutes`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `institute_permissions`
--
ALTER TABLE `institute_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nozel_setting`
--
ALTER TABLE `nozel_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `particulars`
--
ALTER TABLE `particulars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `station_setting`
--
ALTER TABLE `station_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subheads`
--
ALTER TABLE `subheads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `supplier_setting`
--
ALTER TABLE `supplier_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tanklory_setting`
--
ALTER TABLE `tanklory_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
