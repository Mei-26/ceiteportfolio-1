-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2025 at 06:39 PM
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
-- Database: `eportfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `id` bigint(20) NOT NULL,
  `description` varchar(256) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `type` varchar(256) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `description`, `user_id`, `type`, `date`, `time`, `status`) VALUES
(2, 'asdasd', 39, 'Events', '2024-08-29', '11:57:00', 0),
(3, 'Mag gagala', 39, 'ToDo', '2024-08-29', '23:01:00', 0),
(6, 'asdasd', 39, 'ToDo', '2024-09-07', '12:45:00', 0),
(14, 'test', 44, 'Events', '2024-10-24', '21:36:00', 0),
(15, 'tes', 44, 'Events', '2024-10-09', '21:37:00', 0),
(16, 'tesz', 44, 'ToDo', '2024-10-23', '21:37:00', 0),
(18, 'fdf', 44, 'ToDo', '2024-10-16', '09:38:00', 0),
(21, 'test', 43, 'Events', '2024-10-10', '22:06:00', 0),
(22, 'asd', 43, 'ToDo', '2024-10-10', '22:06:00', 0),
(23, 'test', 43, 'Events', '2024-10-10', '22:07:00', 0),
(24, 'aasd', 43, 'ToDo', '2024-10-10', '10:08:00', 0),
(40, 'System Testing', 88, 'Events', '2024-11-26', '13:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `college_details`
--

CREATE TABLE `college_details` (
  `college_id` bigint(20) NOT NULL,
  `college_name` varchar(256) NOT NULL,
  `college_image` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `college_details`
--

INSERT INTO `college_details` (`college_id`, `college_name`, `college_image`, `status`) VALUES
(13, 'college g', '66b48f109e683-doctor.png', 0),
(14, 'college B', '66b48f109e683-doctor.png', 0),
(15, 'new college', '66ed213b44b9a-greens.jpg', 0),
(16, 'College of Engineering and Information Technology', '6741063683c4d-HFUAjfbamNhbM8dsNSQW3D.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `college_officers`
--

CREATE TABLE `college_officers` (
  `id` bigint(20) NOT NULL,
  `college_id` bigint(20) NOT NULL,
  `college_secretary_id` bigint(20) NOT NULL,
  `college_dean_id` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `college_officers`
--

INSERT INTO `college_officers` (`id`, `college_id`, `college_secretary_id`, `college_dean_id`, `status`) VALUES
(4, 14, 21, 20, 0),
(5, 13, 1, 23, 0),
(6, 15, 43, 44, 0),
(7, 16, 62, 102, 0);

-- --------------------------------------------------------

--
-- Table structure for table `college_user_added`
--

CREATE TABLE `college_user_added` (
  `id` bigint(20) NOT NULL,
  `college_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `college_user_added`
--

INSERT INTO `college_user_added` (`id`, `college_id`, `user_id`, `status`) VALUES
(1, 15, 46, 0),
(2, 15, 47, 0),
(3, 15, 48, 0),
(4, 15, 49, 0),
(5, 15, 50, 0),
(6, 15, 51, 0),
(7, 15, 52, 0),
(8, 15, 53, 0),
(9, 15, 54, 0),
(10, 15, 55, 0),
(11, 15, 56, 0),
(12, 15, 57, 0),
(13, 15, 59, 0),
(14, 13, 60, 0),
(15, 13, 61, 0),
(16, 13, 62, 0),
(17, 16, 63, 0),
(18, 16, 64, 0),
(19, 16, 65, 0),
(20, 16, 66, 0),
(21, 16, 67, 0),
(22, 16, 68, 0),
(23, 16, 69, 0),
(24, 16, 70, 0),
(25, 16, 71, 0),
(26, 16, 72, 0),
(27, 16, 73, 0),
(28, 16, 74, 0),
(29, 16, 75, 0),
(30, 16, 76, 0),
(31, 16, 77, 0),
(32, 16, 78, 0),
(33, 16, 79, 0),
(34, 16, 80, 0),
(35, 16, 81, 0),
(36, 16, 88, 0),
(37, 16, 89, 0),
(38, 16, 90, 0),
(39, 16, 91, 0),
(40, 16, 92, 0),
(41, 16, 93, 0),
(42, 16, 94, 0),
(43, 16, 95, 0),
(44, 16, 102, 0);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` bigint(20) NOT NULL,
  `name` varchar(256) NOT NULL,
  `image` text NOT NULL,
  `department_id` bigint(20) NOT NULL,
  `college_id` bigint(20) NOT NULL,
  `secretary_id` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `image`, `department_id`, `college_id`, `secretary_id`, `status`) VALUES
(1, 'tite si ibonss', '66bc9898d50ad-1879x1056-The-Wolf-Among-Us-Wallpaper-HD-Wolf-Wallpaper.pro_-1536x863.jpg', 5, 13, 24, 0),
(2, 'course 2', '66bc98700ea38-asdczxczxkdkqjwkejqwelkqmweblqwmebqlwemqwne.jpg', 5, 13, 24, 0),
(3, 'Programming', '66bd8ba4c7556-a.jpg', 6, 13, 24, 0),
(4, 'Web Development', '66c0bc43897e0-bg1.png', 6, 13, 24, 0),
(5, 'course 2', '66c6eedad3c20-unnamed.png', 7, 14, 40, 0),
(6, 'new course new college', '66ed3cef0c01e-plant4.png', 8, 15, 46, 0),
(7, 'c1', '6703d593cd76a-logo_chicken.png', 9, 15, 51, 0),
(8, 'zzzzxc', '672e1921aaed1-bg.jpg', 9, 15, 55, 0),
(9, 'Information Technology', '67411286be23f-banner-3-blog-it-trends.jpg', 11, 16, 64, 0),
(10, 'Computer Science', '674112de573b3-computerscience-scaled.jpg', 11, 16, 64, 0),
(11, 'Architecture', '674134f38c302-archi.jpeg', 12, 16, 66, 0),
(12, 'Civil Engineering', '6741351329aa4-NDUSTRIAL ENGINEERING ANF TECHNOLOGY.jpeg', 12, 16, 66, 0),
(13, 'Course Testing', '6741523c15d96-cs.jpeg', 14, 16, 79, 0),
(14, 'Course Testing 2', '6741525876dec-COMPUTER ELECTRONICS AND ELECTRICAL ENGINEERING.jpeg', 14, 16, 79, 0),
(15, 'Industrial Engineering', '6743a65c732a2-james-harrison-vpOeXr5wmR4-unsplash.jpg', 15, 16, 69, 0),
(16, 'BS Computer Engineering (BSCpE)', '674f86332ad47-comeng.jpg', 13, 16, 70, 0),
(17, 'BS Electronics Engineering (BSEcE)', '674f869e15ad9-images (2).jpg', 13, 16, 70, 0),
(18, 'BS Electrical Engineering (BSEE)', '674f8711bac6e-Umspannwerk-Pulverdingen_380kV-Trennschalter.jpg', 13, 16, 70, 0);

-- --------------------------------------------------------

--
-- Table structure for table `credential_added`
--

CREATE TABLE `credential_added` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `file_type` text NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `credential_added`
--

INSERT INTO `credential_added` (`id`, `user_id`, `title`, `description`, `image`, `file_type`, `date`, `status`) VALUES
(3, 53, 'gg', 'asdasd', '66ed9969717df-gg.jpg', 'image/jpeg', '2024-09-18', 0),
(5, 53, 'asd', 'q', '66ed99cac587f-gg.jpg', 'image/jpeg', '2024-09-05', 0),
(6, 51, 'qqqqqqqq', 'qqqq', '66edb24207f65-gg.jpg', 'image/jpeg', '2024-09-05', 0),
(8, 52, 'zxc', 'zxc', '66edb4299f005-sample_pdf.pdf', 'application/pdf', '2024-09-18', 0),
(9, 62, 'Sample', 'fdfhd', '6741086f110b3-376251635_6510371742408951_2028030286999995308_n.jpg', 'image/jpeg', '2000-10-10', 0),
(10, 71, 'NCII', 'jfkgnxxxxxxxbcv,m v ,m', '67411981787c0-certificate2.jpeg', 'image/jpeg', '2020-03-02', 0),
(11, 71, 'dggnng', 'gngg', '6741dd51c9323-james-harrison-vpOeXr5wmR4-unsplash.jpg', 'image/jpeg', '2002-10-20', 0),
(12, 61, 'cvv', 'trjrjr', '674463d114146-467755279_1042269941035225_2314011519112823248_n.jpg', 'image/jpeg', '2002-10-10', 0),
(13, 64, 'Cutie', 'qwedrty', '674552c3cbd55-certificate2.jpeg', 'image/jpeg', '2002-10-10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `current_year_sem`
--

CREATE TABLE `current_year_sem` (
  `id` bigint(20) NOT NULL,
  `college_id` bigint(20) NOT NULL,
  `current_sem` varchar(256) NOT NULL,
  `current_year` varchar(256) NOT NULL,
  `current_status` varchar(256) NOT NULL DEFAULT 'current'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `current_year_sem`
--

INSERT INTO `current_year_sem` (`id`, `college_id`, `current_sem`, `current_year`, `current_status`) VALUES
(8, 13, '1st Semester', '2024-2025', 'current'),
(12, 14, '1st Semester', '2025-2026', 'history'),
(16, 14, '1st Semester', '2025-2026', 'history'),
(17, 14, '1st Semester', '2025-2026', 'history'),
(18, 14, '2nd Semester', '2025-2026', 'history'),
(19, 14, '1st Semester', '2026-2027', 'history'),
(20, 14, '1st Semester', '2024-2025', 'history'),
(21, 14, '2nd Semester', '2024-2025', 'current'),
(22, 15, '1st Semester', '2027-2028', 'history'),
(23, 15, '2nd Semester', '2027-2028', 'history'),
(24, 15, '1st Semester', '2028-2029', 'history'),
(25, 15, '2nd Semester', '2028-2029', 'history'),
(26, 15, '1st Semester', '2029-2030', 'history'),
(27, 15, '2nd Semester', '2029-2030', 'history'),
(28, 15, '1st Semester', '2030-2031', 'current'),
(29, 16, '1st Semester', '2024-2025', 'history'),
(30, 16, '2nd Semester', '2024-2025', 'history'),
(31, 16, '1st Semester', '2024-2025', 'history'),
(32, 16, '3rd Semester', '2024-2025', 'current');

-- --------------------------------------------------------

--
-- Table structure for table `deparment_section`
--

CREATE TABLE `deparment_section` (
  `id` bigint(20) NOT NULL,
  `name` varchar(256) NOT NULL,
  `yearlevel` varchar(256) NOT NULL,
  `semester` varchar(256) NOT NULL,
  `schoolyear` varchar(256) NOT NULL,
  `department_id` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deparment_section`
--

INSERT INTO `deparment_section` (`id`, `name`, `yearlevel`, `semester`, `schoolyear`, `department_id`, `status`) VALUES
(1, 'kjkjhzxczxc', '2nd Year', '1st Semester', '2024-2025', 6, 0),
(2, 'bsit3-1', '1st Year', '1st Semester', '2024-2025', 6, 0),
(3, 'BSIT 2A', '2nd Year', '1st Semester', '2024-2025', 6, 0),
(4, 'BSIT 1A', '1st Year', '1st Semester', '2024-2025', 6, 0),
(5, 'BSCS 3A', '3rd Year', '1st Semester', '2024-2025', 6, 0),
(6, 'asdasd', '2nd Year', '2nd Semester', '2024-2025', 6, 0),
(7, 'test section new', '1st Year', '1st Semester', '2027-2028', 8, 0),
(8, 'gname', '2nd Year', '1st Semester', '2027-2028', 8, 0),
(9, 'testerzxzz', '3rd Year', '1st Semester', '2027-2028', 9, 0),
(10, 'mike test', '1st Year', '1st Semester', '2027-2028', 9, 0),
(11, 'zxc', '1st Year', '1st Semester', '2027-2028', 9, 0),
(12, '3-A', '3rd Year', '1st Semester', '2027-2028', 9, 0),
(13, 'ggggggggggg', '2nd Year', '1st Semester', '2027-2028', 9, 1),
(14, 'BSIT 4-2', '4th Year', '', '', 11, 0),
(16, 'BSIT 3-1', '3rd Year', '', '', 11, 0),
(17, 'BSIT 1-1', '1st Year', '', '', 11, 0),
(18, 'BSIT 1-2', '1st Year', '1st Semester', '2024-2025', 11, 0),
(19, 'BSIT 4-4', '4th Year', '1st Semester', '2024-2025', 11, 0),
(20, 'DT 1-1', '1st Year', '1st Semester', '2024-2025', 14, 0),
(21, 'DT 1-2', '1st Year', '1st Semester', '2024-2025', 14, 0),
(22, 'DT 2-2', '2nd Year', '1st Semester', '2024-2025', 14, 0),
(23, 'BSIT 6-6', '6th Year', '1st Semester', '2024-2025', 11, 1),
(25, 'BSIT 2-2', '2nd Year', '1st Semester', '2024-2025', 11, 0),
(27, 'IE-1-1', '1st Year', '1st Semester', '2024-2025', 15, 0),
(29, 'IE-1-2', '1st Year', '1st Semester', '2024-2025', 15, 0),
(30, 'BSIT 6-1', '6th Year', '1st Semester', '2024-2025', 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `department_details`
--

CREATE TABLE `department_details` (
  `id` int(11) NOT NULL,
  `department_name` varchar(256) NOT NULL,
  `department_code` varchar(256) NOT NULL,
  `department_dean` bigint(20) NOT NULL DEFAULT 0,
  `department_secretary` bigint(20) NOT NULL DEFAULT 0,
  `department_image` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `depatment_college` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_details`
--

INSERT INTO `department_details` (`id`, `department_name`, `department_code`, `department_dean`, `department_secretary`, `department_image`, `status`, `depatment_college`) VALUES
(11, 'INFORMATION TECHNOLOGY', 'DIT', 63, 74, '67410a5cf2a18-images.jpg', 0, 16),
(12, 'CIVIL ENGINEERING AND ARCHITECTURE', 'DCEA', 65, 60, '67410de90eeba-623888_ccbf189032f34f15a9071a78c503538f~mv2.jpg', 0, 16),
(13, 'COMPUTER ELECTRONICS AND ELECTRICAL ENGINEERING', 'DCEEE', 67, 70, '67410ec51672d-images (1).jpg', 0, 16),
(14, 'TEST DEPARTMENT', 'TD', 78, 79, '6741477542a53-COMPUTER ELECTRONICS AND ELECTRICAL ENGINEERING.jpeg', 0, 16),
(15, 'INDUSTRIAL ENGINEERING AND  TECHNOLOGY', 'DIET', 68, 69, '67414bf4b71cd-NDUSTRIAL ENGINEERING ANF TECHNOLOGY.jpeg', 0, 16),
(19, 'asdasd', 'asd', 0, 0, '67563184c51ee-rounded_logo.png', 0, 16),
(20, 'test', 'zz', 0, 0, '677d6689e1bdc-no_image.jpg', 0, 16);

-- --------------------------------------------------------

--
-- Table structure for table `department_faculty`
--

CREATE TABLE `department_faculty` (
  `id` bigint(20) NOT NULL,
  `department_id` bigint(20) NOT NULL,
  `faculty_id` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_faculty`
--

INSERT INTO `department_faculty` (`id`, `department_id`, `faculty_id`, `status`) VALUES
(1, 6, 36, 0),
(2, 6, 38, 0),
(3, 6, 39, 0),
(4, 7, 42, 0),
(5, 8, 47, 0),
(6, 8, 48, 0),
(7, 9, 53, 0),
(8, 9, 54, 0),
(9, 11, 71, 0),
(10, 11, 72, 0),
(11, 11, 73, 0),
(13, 12, 75, 0),
(14, 12, 76, 0),
(15, 14, 80, 0),
(16, 14, 81, 0),
(17, 11, 88, 0),
(18, 15, 89, 0),
(19, 13, 90, 0),
(21, 11, 61, 0),
(22, 11, 92, 0),
(23, 11, 93, 0),
(24, 11, 94, 0),
(25, 11, 95, 0);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_subject`
--

CREATE TABLE `faculty_subject` (
  `id` bigint(20) NOT NULL,
  `faculty_id` bigint(20) NOT NULL,
  `subject_id` bigint(20) NOT NULL,
  `sy` varchar(256) NOT NULL,
  `sem` varchar(256) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_subject`
--

INSERT INTO `faculty_subject` (`id`, `faculty_id`, `subject_id`, `sy`, `sem`, `status`) VALUES
(18, 38, 3, '2025-2026', '1st Semester', 0),
(19, 38, 4, '2025-2026', '1st Semester', 0),
(25, 42, 5, '2025-2026', '1st Semester', 0),
(28, 48, 6, '2025-2026', '1st Semester', 0),
(31, 47, 6, '2027-2028', '1st Semester', 0),
(33, 47, 6, '2028-2029', '1st Semester', 0),
(37, 47, 6, '2030-2031', '1st Semester', 0),
(39, 54, 7, '2030-2031', '1st Semester', 0),
(40, 53, 7, '2030-2031', '1st Semester', 0),
(41, 53, 8, '2030-2031', '1st Semester', 0),
(42, 54, 8, '2030-2031', '1st Semester', 0),
(43, 71, 9, '2024-2025', '1st Semester', 0),
(44, 71, 10, '2024-2025', '1st Semester', 0),
(45, 71, 11, '2024-2025', '1st Semester', 0),
(46, 73, 11, '2024-2025', '1st Semester', 0),
(47, 80, 12, '2024-2025', '1st Semester', 0),
(48, 81, 12, '2024-2025', '1st Semester', 0),
(49, 74, 10, '2024-2025', '1st Semester', 0),
(50, 71, 10, '2024-2025', '3rd Semester', 0),
(51, 71, 9, '2024-2025', '3rd Semester', 0),
(52, 88, 9, '2024-2025', '3rd Semester', 0),
(53, 74, 9, '2024-2025', '3rd Semester', 0),
(54, 74, 10, '2024-2025', '3rd Semester', 0),
(55, 89, 14, '2024-2025', '3rd Semester', 0),
(56, 92, 15, '2024-2025', '3rd Semester', 0),
(57, 94, 15, '2024-2025', '3rd Semester', 0),
(58, 93, 11, '2024-2025', '3rd Semester', 0),
(59, 95, 16, '2024-2025', '3rd Semester', 0),
(60, 93, 16, '2024-2025', '3rd Semester', 0);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_subject_section`
--

CREATE TABLE `faculty_subject_section` (
  `id` bigint(20) NOT NULL,
  `faculty_id` bigint(20) NOT NULL,
  `section_id` bigint(20) NOT NULL,
  `subject_id` bigint(20) NOT NULL,
  `sy` varchar(256) NOT NULL,
  `sem` varchar(256) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_subject_section`
--

INSERT INTO `faculty_subject_section` (`id`, `faculty_id`, `section_id`, `subject_id`, `sy`, `sem`, `status`) VALUES
(3, 39, 3, 4, '2024-2025', '1st Semester', 0),
(4, 39, 4, 4, '2024-2025', '1st Semester', 0),
(8, 39, 3, 3, '2024-2025', '1st Semester', 0),
(10, 38, 3, 3, '2024-2025', '1st Semester', 0),
(11, 38, 4, 3, '2024-2025', '1st Semester', 0),
(12, 38, 5, 3, '2024-2025', '1st Semester', 0),
(13, 38, 3, 4, '2024-2025', '1st Semester', 0),
(14, 38, 4, 4, '2024-2025', '1st Semester', 0),
(18, 48, 7, 6, '2024-2025', '1st Semester', 0),
(19, 47, 7, 6, '2024-2025', '1st Semester', 0),
(21, 47, 7, 6, '2027-2028', '1st Semester', 0),
(27, 47, 7, 6, '2028-2029', '1st Semester', 0),
(47, 54, 10, 7, '2030-2031', '1st Semester', 0),
(53, 54, 11, 8, '2030-2031', '1st Semester', 0),
(54, 53, 10, 8, '2030-2031', '1st Semester', 0),
(56, 53, 12, 8, '2030-2031', '1st Semester', 0),
(57, 53, 10, 7, '2030-2031', '1st Semester', 0),
(58, 53, 11, 7, '2030-2031', '1st Semester', 0),
(59, 53, 12, 7, '2030-2031', '1st Semester', 0),
(60, 71, 14, 9, '2024-2025', '1st Semester', 0),
(62, 71, 17, 11, '2024-2025', '1st Semester', 0),
(63, 73, 16, 11, '2024-2025', '1st Semester', 0),
(65, 80, 21, 12, '2024-2025', '1st Semester', 0),
(67, 81, 22, 12, '2024-2025', '1st Semester', 0),
(68, 74, 19, 10, '2024-2025', '1st Semester', 0),
(76, 74, 25, 10, '2024-2025', '3rd Semester', 0),
(77, 71, 19, 10, '2024-2025', '3rd Semester', 0),
(78, 88, 17, 9, '2024-2025', '3rd Semester', 1),
(80, 89, 27, 14, '2024-2025', '3rd Semester', 0),
(81, 92, 16, 15, '2024-2025', '3rd Semester', 0),
(82, 94, 25, 15, '2024-2025', '3rd Semester', 0),
(83, 93, 30, 11, '2024-2025', '3rd Semester', 0),
(84, 95, 16, 16, '2024-2025', '3rd Semester', 0),
(85, 93, 18, 16, '2024-2025', '3rd Semester', 0),
(91, 71, 17, 9, '2024-2025', '3rd Semester', 0),
(92, 71, 18, 9, '2024-2025', '3rd Semester', 0);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_uploads`
--

CREATE TABLE `faculty_uploads` (
  `id` bigint(20) NOT NULL,
  `faculty_id` bigint(20) NOT NULL,
  `subject_id` bigint(20) NOT NULL,
  `upload_id` bigint(20) NOT NULL,
  `section_id` bigint(20) NOT NULL,
  `file` text NOT NULL,
  `datetime_created` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  `semester` varchar(256) NOT NULL,
  `year` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_uploads`
--

INSERT INTO `faculty_uploads` (`id`, `faculty_id`, `subject_id`, `upload_id`, `section_id`, `file`, `datetime_created`, `status`, `semester`, `year`) VALUES
(13, 39, 3, 1, 3, '66c1ecc42a6c5-66bf07b5b2473-CAP_1_Group___3_-_Information-Guide-for-BulSU-Bustos-Students_FINAL.pdf', '2024-08-18 20:44:52', 0, '1st Semester', '2024-2025'),
(14, 39, 3, 4, 5, '66c1eccbea391-CAP_1_Group___3_-_Information-Guide-for-BulSU-Bustos-Students_FINAL.pdf', '2024-08-18 20:44:59', 0, '1st Semester', '2024-2025'),
(15, 39, 4, 3, 3, '66c1eef8a65d4-CAP_1_Group___3_-_Information-Guide-for-BulSU-Bustos-Students_FINAL.pdf', '2024-08-18 20:54:16', 0, '1st Semester', '2024-2025'),
(16, 39, 4, 2, 4, '66c1ef007cc8d-sample.pdf', '2024-08-18 20:54:24', 0, '1st Semester', '2024-2025'),
(17, 38, 3, 1, 4, '66c21df941e09-for-revise.pdf', '2024-08-19 00:14:49', 0, '1st Semester', '2024-2025'),
(18, 38, 3, 4, 3, '66c21e02e8031-CAP_1_Group___3_-_Information-Guide-for-BulSU-Bustos-Students_FINAL.pdf', '2024-08-19 00:14:58', 0, '1st Semester', '2024-2025'),
(19, 39, 3, 3, 3, '66c22c6e3e338-comment-new__1_.pdf', '2024-08-19 01:16:30', 0, '1st Semester', '2024-2025'),
(20, 39, 3, 2, 3, '66c22c74ebdb0-comment-new.pdf', '2024-08-19 01:16:36', 0, '1st Semester', '2024-2025'),
(21, 39, 3, 2, 5, '66c22c7e25c01-for-revise.pdf', '2024-08-19 01:16:46', 0, '1st Semester', '2024-2025'),
(22, 38, 4, 1, 4, '66c24769c0fb3-CAPSTONE-PROJECT-PROPOSAL-FILE-medyo-final.pdf', '2024-08-19 03:11:37', 0, '1st Semester', '2024-2025'),
(23, 38, 4, 2, 3, '66c2477c615d9-comment.pdf', '2024-08-19 03:11:56', 0, '1st Semester', '2024-2025'),
(24, 38, 3, 1, 3, '66c2f2b7a1aa8-for-revise.pdf', '2024-08-19 15:22:31', 0, '1st Semester', '2024-2025'),
(25, 38, 3, 1, 5, '66c2f2c61b0ff-for-revise.pdf', '2024-08-19 15:22:46', 0, '1st Semester', '2024-2025'),
(26, 47, 6, 3, 7, '66ed4636a16dc-kapepongtsa.pdf', '2024-09-20 17:53:58', 0, '1st Semester', '2027-2028'),
(29, 48, 6, 14, 7, '66ed4c6fc1390-invoicesample.pdf', '2024-09-20 18:14:19', 0, '1st Semester', '2027-2028'),
(31, 48, 6, 14, 7, '66ed4e1a7a744-User-Interface.pdf', '2024-09-20 18:25:28', 0, '2nd Semester', '2027-2028'),
(32, 47, 6, 14, 7, '66ed628a64f36-sample_pdf.pdf', '2024-09-20 19:54:50', 0, '2nd Semester', '2027-2028'),
(33, 47, 6, 11, 7, '66ed67b0c1836-User-Interface.pdf', '2024-09-20 20:16:48', 0, '2nd Semester', '2027-2028'),
(34, 54, 8, 6, 11, '673671c8302bc-sample_pdf.pdf', '2024-11-15 05:55:20', 0, '1st Semester', '2030-2031'),
(35, 54, 8, 3, 11, '67367445c85db-sample_pdf.pdf', '2024-11-15 06:05:57', 0, '1st Semester', '2030-2031'),
(36, 54, 8, 1, 11, '673674608ff98-sample_pdf.pdf', '2024-11-15 06:06:24', 0, '1st Semester', '2030-2031'),
(37, 54, 8, 10, 11, '6736746a0eee5-sample_pdf.pdf', '2024-11-15 06:06:34', 0, '1st Semester', '2030-2031'),
(38, 54, 8, 12, 11, '67367470d5fe3-sample_pdf.pdf', '2024-11-15 06:06:40', 0, '1st Semester', '2030-2031'),
(39, 54, 8, 15, 11, '673674769732b-sample_pdf.pdf', '2024-11-15 06:06:46', 0, '1st Semester', '2030-2031'),
(40, 54, 8, 2, 11, '6736747d7445f-sample_pdf.pdf', '2024-11-15 06:06:53', 0, '1st Semester', '2030-2031'),
(41, 54, 8, 4, 11, '67367482a17ff-sample_pdf.pdf', '2024-11-15 06:06:58', 0, '1st Semester', '2030-2031'),
(42, 54, 8, 8, 11, '673674880a8a4-sample_pdf.pdf', '2024-11-15 06:07:04', 0, '1st Semester', '2030-2031'),
(43, 54, 8, 11, 11, '67367490629cd-sample_pdf.pdf', '2024-11-15 06:07:12', 0, '1st Semester', '2030-2031'),
(44, 54, 8, 14, 11, '6737611386f60-invoicesample.pdf', '2024-11-15 06:07:20', 0, '1st Semester', '2030-2031'),
(45, 54, 7, 3, 10, '6736751418000-sample_pdf.pdf', '2024-11-15 06:09:24', 0, '1st Semester', '2030-2031'),
(46, 54, 7, 1, 10, '6736751949228-sample_pdf.pdf', '2024-11-15 06:09:29', 0, '1st Semester', '2030-2031'),
(47, 54, 7, 6, 10, '6736751e9344f-sample_pdf.pdf', '2024-11-15 06:09:34', 0, '1st Semester', '2030-2031'),
(48, 54, 7, 10, 10, '673675237dd26-sample_pdf.pdf', '2024-11-15 06:09:39', 0, '1st Semester', '2030-2031'),
(49, 54, 7, 12, 10, '67367528d9ef7-sample_pdf.pdf', '2024-11-15 06:09:44', 0, '1st Semester', '2030-2031'),
(50, 54, 7, 15, 10, '6736752eed22a-sample_pdf.pdf', '2024-11-15 06:09:50', 0, '1st Semester', '2030-2031'),
(51, 54, 7, 2, 10, '6736753c12756-sample_pdf.pdf', '2024-11-15 06:10:04', 0, '1st Semester', '2030-2031'),
(52, 54, 7, 4, 10, '67367542d6339-sample_pdf.pdf', '2024-11-15 06:10:10', 0, '1st Semester', '2030-2031'),
(53, 54, 7, 8, 10, '67378456df402-Modules_Quiz.pdf', '2024-11-15 18:26:46', 0, '1st Semester', '2030-2031'),
(60, 54, 7, 11, 10, '673784685cbee-kapepongtsa.pdf', '2024-11-16 01:27:04', 0, '1st Semester', '2030-2031'),
(61, 54, 7, 14, 10, '673784744f355-kapepongtsa.pdf', '2024-11-16 01:27:16', 0, '1st Semester', '2030-2031'),
(62, 53, 7, 3, 10, '67378c32bde25-kapepongtsa.pdf', '2024-11-16 02:00:18', 0, '1st Semester', '2030-2031'),
(63, 53, 8, 4, 10, '67378c950d579-kapepongtsa.pdf', '2024-11-16 02:01:57', 0, '1st Semester', '2030-2031'),
(64, 53, 7, 1, 10, '67378f4935429-kapepongtsa.pdf', '2024-11-16 02:13:29', 0, '1st Semester', '2030-2031'),
(65, 53, 8, 3, 12, '67378fe51a5cd-kapepongtsa.pdf', '2024-11-16 02:16:05', 0, '1st Semester', '2030-2031'),
(66, 71, 9, 1, 14, '674119c4e43d8-resume-sample.pdf', '2024-11-23 07:54:44', 0, '1st Semester', '2024-2025'),
(67, 71, 9, 3, 14, '674119cce6ba3-resume-sample.pdf', '2024-11-23 07:54:52', 0, '1st Semester', '2024-2025'),
(68, 71, 9, 6, 14, '674119d4ce985-resume-sample.pdf', '2024-11-23 07:55:00', 0, '1st Semester', '2024-2025'),
(69, 71, 9, 10, 14, '674119dbe9dde-resume-sample.pdf', '2024-11-23 07:55:07', 0, '1st Semester', '2024-2025'),
(70, 71, 9, 12, 14, '674119e4d2825-resume-sample.pdf', '2024-11-23 07:55:16', 0, '1st Semester', '2024-2025'),
(71, 71, 9, 15, 14, '674119ee85869-resume-sample.pdf', '2024-11-23 07:55:26', 0, '1st Semester', '2024-2025'),
(72, 71, 9, 14, 14, '674119f83c609-resume-sample.pdf', '2024-11-23 07:55:36', 0, '1st Semester', '2024-2025'),
(73, 71, 9, 2, 14, '67411be855ca3-ITEC-116.pdf', '2024-11-23 08:03:52', 0, '1st Semester', '2024-2025'),
(74, 71, 9, 4, 14, '67411bf154ca0-ITEC-116.pdf', '2024-11-23 08:04:01', 0, '1st Semester', '2024-2025'),
(75, 71, 9, 8, 14, '67411bfba7085-ITEC-116.pdf', '2024-11-23 08:04:11', 0, '1st Semester', '2024-2025'),
(76, 71, 9, 11, 14, '67411c05a872b-ITEC-116.pdf', '2024-11-23 08:04:21', 0, '1st Semester', '2024-2025'),
(77, 74, 10, 14, 19, '674166f716570-resume-sample.pdf', '2024-11-23 13:24:07', 0, '1st Semester', '2024-2025'),
(78, 74, 10, 6, 19, '67416702bc1f9-resume-sample.pdf', '2024-11-23 13:24:18', 0, '1st Semester', '2024-2025'),
(79, 71, 11, 1, 17, '6741707d43187-resume-sample.pdf', '2024-11-23 14:04:45', 0, '1st Semester', '2024-2025'),
(80, 71, 11, 3, 17, '674170852f797-resume-sample.pdf', '2024-11-23 14:04:53', 0, '1st Semester', '2024-2025'),
(81, 71, 11, 6, 17, '6741708d42d60-resume-sample.pdf', '2024-11-23 14:05:01', 0, '1st Semester', '2024-2025'),
(82, 71, 11, 10, 17, '6741709481368-resume-sample.pdf', '2024-11-23 14:05:08', 0, '1st Semester', '2024-2025'),
(83, 71, 11, 12, 17, '6741709c63553-resume-sample.pdf', '2024-11-23 14:05:16', 0, '1st Semester', '2024-2025'),
(84, 71, 11, 14, 17, '674170a79ee62-resume-sample.pdf', '2024-11-23 14:05:27', 0, '1st Semester', '2024-2025'),
(85, 71, 10, 1, 19, '6743a708ad5e4-resume-sample.pdf', '2024-11-25 06:22:00', 0, '3rd Semester', '2024-2025'),
(86, 71, 10, 3, 19, '6743a711a351d-resume-sample.pdf', '2024-11-25 06:22:09', 0, '3rd Semester', '2024-2025'),
(87, 71, 10, 6, 19, '6743a71937753-resume-sample.pdf', '2024-11-25 06:22:17', 0, '3rd Semester', '2024-2025'),
(88, 71, 10, 10, 19, '6743a722087eb-resume-sample.pdf', '2024-11-25 06:22:26', 0, '3rd Semester', '2024-2025'),
(89, 71, 10, 12, 19, '6743a7416e9f5-resume-sample.pdf', '2024-11-25 06:22:57', 0, '3rd Semester', '2024-2025'),
(90, 71, 10, 15, 19, '6743a74a9e757-resume-sample.pdf', '2024-11-25 06:23:06', 0, '3rd Semester', '2024-2025'),
(91, 71, 10, 14, 19, '6743a754011c7-resume-sample.pdf', '2024-11-25 06:23:16', 0, '3rd Semester', '2024-2025'),
(92, 71, 10, 11, 19, '6743a76be417c-resume-sample.pdf', '2024-11-25 06:23:39', 0, '3rd Semester', '2024-2025'),
(93, 71, 10, 2, 19, '674459762efb9-Lecture_3.1_-_Intellectual_Property.pdf', '2024-11-25 19:03:18', 0, '3rd Semester', '2024-2025'),
(94, 71, 10, 4, 19, '67445981c1e7f-Lecture_1_-_Social_Context_of_Computing.pdf', '2024-11-25 19:03:29', 0, '3rd Semester', '2024-2025'),
(95, 71, 10, 8, 19, '6744598b0f822-Lecture_1_-_The_Social_Context_of_Computing.pdf', '2024-11-25 19:03:39', 0, '3rd Semester', '2024-2025'),
(106, 88, 9, 1, 17, '67452feab5f6e-DCIT-65-Midterms-Reviewer.pdf', '2024-11-26 10:18:18', 0, '3rd Semester', '2024-2025'),
(107, 88, 9, 3, 17, '67452ff23d002-DCIT-65-Midterms-Reviewer.pdf', '2024-11-26 10:18:26', 0, '3rd Semester', '2024-2025'),
(108, 88, 9, 6, 17, '67452ff93e285-DCIT-65-Midterms-Reviewer.pdf', '2024-11-26 10:18:33', 0, '3rd Semester', '2024-2025'),
(109, 88, 9, 10, 17, '674530015e06e-DCIT-65-Midterms-Reviewer.pdf', '2024-11-26 10:18:41', 0, '3rd Semester', '2024-2025'),
(110, 88, 9, 12, 17, '67453007efa9c-DCIT-65-Midterms-Reviewer.pdf', '2024-11-26 10:18:47', 0, '3rd Semester', '2024-2025'),
(111, 88, 9, 15, 17, '674530105643c-DCIT-65-Midterms-Reviewer.pdf', '2024-11-26 10:18:56', 0, '3rd Semester', '2024-2025'),
(112, 88, 9, 14, 17, '674530198e8d7-DCIT-65-Midterms-Reviewer.pdf', '2024-11-26 10:19:05', 0, '3rd Semester', '2024-2025'),
(113, 88, 9, 11, 17, '6745301f6427e-DCIT-65-Midterms-Reviewer.pdf', '2024-11-26 10:19:11', 0, '3rd Semester', '2024-2025'),
(114, 88, 9, 8, 17, '6745302600111-DCIT-65-Midterms-Reviewer.pdf', '2024-11-26 10:19:18', 0, '3rd Semester', '2024-2025'),
(115, 88, 9, 4, 17, '6745302c765f5-DCIT-65-Midterms-Reviewer.pdf', '2024-11-26 10:19:24', 0, '3rd Semester', '2024-2025'),
(116, 88, 9, 2, 17, '67453033ba22a-DCIT-65-Midterms-Reviewer.pdf', '2024-11-26 10:19:31', 0, '3rd Semester', '2024-2025'),
(117, 74, 10, 1, 19, '674f840c7d9ff-STICKERS.pdf', '2024-12-04 06:19:56', 0, '3rd Semester', '2024-2025'),
(118, 74, 10, 4, 19, '6750ea760fe5a-sample2.pdf', '2024-12-05 07:49:10', 0, '3rd Semester', '2024-2025'),
(119, 74, 10, 10, 19, '6750eac39b931-sample2.pdf', '2024-12-05 07:50:27', 0, '3rd Semester', '2024-2025'),
(133, 71, 9, 1, 17, '67599efc42f56-sample2.pdf', '2024-12-11 22:17:32', 0, '3rd Semester', '2024-2025'),
(134, 71, 9, 3, 17, '67599f0006fe7-sample2.pdf', '2024-12-11 22:17:36', 0, '3rd Semester', '2024-2025'),
(135, 71, 9, 6, 17, '67599f0470884-sample.pdf', '2024-12-11 22:17:40', 0, '3rd Semester', '2024-2025'),
(136, 71, 9, 10, 17, '67599f105153e-sample2.pdf', '2024-12-11 22:17:52', 0, '3rd Semester', '2024-2025'),
(137, 71, 9, 12, 17, '67599f15386be-sample.pdf', '2024-12-11 22:17:57', 0, '3rd Semester', '2024-2025'),
(138, 71, 9, 15, 17, '67599f19a89d1-sample2.pdf', '2024-12-11 22:18:01', 0, '3rd Semester', '2024-2025'),
(139, 71, 9, 2, 17, '67599f1e220f9-sample.pdf', '2024-12-11 22:18:06', 0, '3rd Semester', '2024-2025'),
(140, 71, 9, 4, 17, '67599f223bb23-sample2.pdf', '2024-12-11 22:18:10', 0, '3rd Semester', '2024-2025'),
(141, 71, 9, 8, 17, '67599f27247ea-sample2.pdf', '2024-12-11 22:18:15', 0, '3rd Semester', '2024-2025'),
(142, 71, 9, 11, 17, '67599f2c1384b-sample2.pdf', '2024-12-11 22:18:20', 0, '3rd Semester', '2024-2025'),
(143, 71, 9, 14, 17, '67599f334b0cb-sample.pdf', '2024-12-11 22:18:27', 0, '3rd Semester', '2024-2025'),
(144, 71, 9, 11, 18, '6759bda29b23e-sample.pdf', '2024-12-12 00:28:18', 0, '3rd Semester', '2024-2025'),
(145, 71, 9, 1, 18, '6759c3f07c53f-sample2.pdf', '2024-12-12 00:55:12', 0, '3rd Semester', '2024-2025'),
(146, 71, 9, 3, 18, '6759c3f4b62ad-sample2.pdf', '2024-12-12 00:55:16', 0, '3rd Semester', '2024-2025'),
(147, 71, 9, 2, 18, '6759c3f8e9775-sample2.pdf', '2024-12-12 00:55:20', 0, '3rd Semester', '2024-2025'),
(148, 71, 9, 4, 18, '6759c3fcb2b24-sample2.pdf', '2024-12-12 00:55:24', 0, '3rd Semester', '2024-2025'),
(149, 71, 9, 6, 18, '6759c4024d420-sample2.pdf', '2024-12-12 00:55:30', 0, '3rd Semester', '2024-2025'),
(150, 71, 9, 8, 18, '6759c40858dd3-sample.pdf', '2024-12-12 00:55:36', 0, '3rd Semester', '2024-2025'),
(152, 71, 9, 10, 18, '6759c4110b608-sample.pdf', '2024-12-12 00:55:45', 0, '3rd Semester', '2024-2025'),
(153, 71, 9, 12, 18, '6759c41908e7b-sample2.pdf', '2024-12-12 00:55:53', 0, '3rd Semester', '2024-2025'),
(154, 71, 9, 14, 18, '6759c4584b8e0-sample.pdf', '2024-12-12 00:56:56', 0, '3rd Semester', '2024-2025'),
(155, 95, 16, 3, 16, '6759fa02837fa-sample2.pdf', '2024-12-12 04:45:54', 0, '3rd Semester', '2024-2025'),
(156, 95, 16, 14, 16, '6759fa09ceafa-sample2.pdf', '2024-12-12 04:46:01', 0, '3rd Semester', '2024-2025');

-- --------------------------------------------------------

--
-- Table structure for table `for_uploads`
--

CREATE TABLE `for_uploads` (
  `id` bigint(20) NOT NULL,
  `name` varchar(256) NOT NULL,
  `image` text NOT NULL DEFAULT 'file.png',
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `for_uploads`
--

INSERT INTO `for_uploads` (`id`, `name`, `image`, `status`) VALUES
(1, 'Attendance Sheets', 'file.png', 0),
(2, 'Grading Sheets', 'file.png', 0),
(3, 'Class Records', 'file.png', 0),
(4, 'Lab Module', 'file.png', 0),
(6, 'Student Outputs', 'file.png', 0),
(8, 'Lab Reports', 'file.png', 0),
(10, 'Exam Results Discussion', 'file.png', 0),
(11, 'Exam with TOS', 'file.png', 0),
(12, 'Consultation Slips', 'file.png', 0),
(14, 'Syllabus Acceptance', 'file.png', 0),
(15, 'Lecture Module', 'file.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `resume_upload`
--

CREATE TABLE `resume_upload` (
  `id` bigint(20) NOT NULL,
  `faculty_id` bigint(20) NOT NULL,
  `file` text NOT NULL,
  `file_type` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resume_upload`
--

INSERT INTO `resume_upload` (`id`, `faculty_id`, `file`, `file_type`, `status`) VALUES
(2, 36, '674471c96ddda-E-PorfolioSystem_Rationale.pdf', 'application/pdf', 0),
(3, 51, '674471c96ddda-E-PorfolioSystem_Rationale.pdf', 'application/pdf', 0),
(4, 52, '674471c96ddda-E-PorfolioSystem_Rationale.pdf', 'application/pdf', 0),
(5, 54, '674471c96ddda-E-PorfolioSystem_Rationale.pdf', 'application/pdf', 0),
(6, 62, '67581c48655ce-STICKERS.pdf', 'application/pdf', 0),
(7, 71, '674471c96ddda-E-PorfolioSystem_Rationale.pdf', 'application/pdf', 0),
(8, 73, '674471c96ddda-E-PorfolioSystem_Rationale.pdf', 'application/pdf', 0),
(9, 74, '675842cbe10e4-01-OSI-Subnetting-and-Static-Routing__1_.pdf', 'application/pdf', 0),
(10, 61, '67565e13c2f05-462571929_841428821217793_6869436032257337556_n.jpg', 'image/jpeg', 0),
(11, 63, '675853b1510de-resume-sample.pdf', 'application/pdf', 0),
(12, 88, '6745487257634-RESUME.pdf', 'application/pdf', 0),
(13, 64, '674552aa7e3ec-resume-sample.pdf', 'application/pdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` bigint(20) NOT NULL,
  `code` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `image` text NOT NULL,
  `secretary_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `code`, `name`, `image`, `secretary_id`, `course_id`, `status`) VALUES
(1, 'tsi', 'Programming fundamentals', '66bcbf7fb0563-deaftalk.png', 24, 2, 0),
(2, 'OOP', 'Object-oriented programming', '66bcbfb9c10b8-bg1.png', 24, 2, 0),
(3, 'CSS - 1', 'Cascading Style Sheet', '66c0bc7fc2a31-doctor.png', 24, 4, 0),
(4, 'BSIT-3-2', 'Computer programming', '66c0bc911e960-clip.png', 24, 3, 0),
(5, 'subject code', 'Subject Name', '66c6eef67379f-Gemini_Generated_Image_ab0ppxab0ppxab0p.jpeg', 40, 5, 0),
(6, 'subject_new_code', 'subject new', '66ed3d0f2b9ed-OIP.png', 46, 6, 0),
(7, 'sub1', 'sub1', '6703d5a00ef79-logo_chicken.png', 51, 7, 0),
(8, 'qqq', 'casd', '672e19382530d-462571929_841428821217793_6869436032257337556_n.jpg', 55, 8, 0),
(9, 'ITEC116', 'System Architecture 2', '6741138a47a2d-A-system-architecture-diagram.png', 64, 9, 0),
(10, 'ITEC 111A', 'IT ELECTIVE 3 (INTEGRATED PROGRAMMING AND TECHNOLOGIES 2)', '66bcba3a9f39d-a.jpg', 64, 9, 0),
(11, 'ITEC200B', 'CAPSTONE PROJECT AND RESEARCH 2', '674114554f6b8-banner-3-blog-it-trends.jpg', 64, 9, 0),
(12, 'SBT', 'Subject Testing', '67415283d6c0b-Discrete Structure.jpg', 79, 13, 0),
(13, 'S2T', 'Subject 2 Testing', '674154e63b30f-james-harrison-vpOeXr5wmR4-unsplash.jpg', 79, 13, 0),
(14, 'IE', 'Industrial Engi', '6743a67712cab-computerscience-scaled.jpg', 69, 15, 0),
(15, 'INSY 55', 'SYSTEM ANALYSIS AND DESIGN', '675849813518c-cs.jpeg', 74, 9, 0),
(16, 'DCIT 60A', 'METHODS OF RESEARCH', '6758499c14c1a-COMPUTER ELECTRONICS AND ELECTRICAL ENGINEERING.jpeg', 74, 9, 0),
(17, 'adasd', 'xzcxc', '6759f4d75dccb-rounded_logo.png', 74, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `employment_id` varchar(256) DEFAULT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `role` varchar(256) NOT NULL DEFAULT 'faculty',
  `added` int(11) NOT NULL DEFAULT 0,
  `type` varchar(256) DEFAULT NULL,
  `verification_code` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `employment_id`, `email`, `password`, `status`, `role`, `added`, `type`, `verification_code`) VALUES
(1, '1234', 'admin@admin', '$2y$10$g.el9OIenXwuNHAMlbKLWugBuEb5syJ/XFKej8wLdklsQ7lacaxg2', 0, 'college_secretary', 0, 'Regular', ''),
(20, '321', 'bob@gmail.com', '$2y$10$g.el9OIenXwuNHAMlbKLWugBuEb5syJ/XFKej8wLdklsQ7lacaxg2', 0, 'college_dean', 1, 'Regular', ''),
(21, '123', 'secretary@secretary', '$2y$10$g.el9OIenXwuNHAMlbKLWugBuEb5syJ/XFKej8wLdklsQ7lacaxg2', 0, 'college_secretary', 1, 'Contractual', ''),
(22, '12345', 'depdean@dean', '$2y$10$g.el9OIenXwuNHAMlbKLWugBuEb5syJ/XFKej8wLdklsQ7lacaxg2', 0, 'department_chairperson', 1, 'Contractual', ''),
(23, '123456', 'chairperson@chairperson', '$2y$10$g.el9OIenXwuNHAMlbKLWugBuEb5syJ/XFKej8wLdklsQ7lacaxg2', 0, 'department_chairperson', 1, 'Regular', ''),
(24, '111', 'dep@secretary', '$2y$10$g.el9OIenXwuNHAMlbKLWugBuEb5syJ/XFKej8wLdklsQ7lacaxg2', 0, 'department_secretary', 1, 'Regular', ''),
(25, '007', 'gancho@gmail.com', '$2y$10$g.el9OIenXwuNHAMlbKLWugBuEb5syJ/XFKej8wLdklsQ7lacaxg2', 0, 'college_dean', 1, 'Contractual', ''),
(36, '9876123', 'asdas123@gmail.com', '$2y$10$42Bhb3baxvUqrjuxvQhA2.T2TlrBWPKrYrAGv7H0JFp1gvExGBl/O', 0, 'faculty', 0, 'Regular', ''),
(38, '123123', 'facultyname@gmail.com', '$2y$10$iSK3VkOVNhqeGFzLGREoZe0teAGFGAo9vKBVZo8pCSgo3YdMHHhUC', 0, 'faculty', 0, 'Regular', ''),
(39, '6123123', 'dummy1stapador@gmail.com', '$2y$10$t6Qz6kjb7b./UJNyC8wfqOKhc1zV4xP.s0aTXbKqTBEdFWehfHITq', 0, 'faculty', 0, 'Regular', ''),
(40, '9873454', 'tt@gmail.com', '$2y$10$OoP6YLwsrCWH/7/7KTJYYOdGCCP8/evMeu2aufkVtyCWG1hPlcTfi', 0, 'department_secretary', 1, 'Regular', ''),
(41, '723423423', 'gg@gmail.com', '$2y$10$mRvRfoMFyg5yHB.2ozoLS.gcFnDE7voDrmIkItI91WLQ64e1PQOze', 0, 'department_chairperson', 1, 'Regular', ''),
(42, '7123123', 't@gmail.com', '$2y$10$uNx8h1l/IvBZDKXkN/DQpehoxdqPYsttUM18WgimbTHRPNX8UfW1C', 0, 'faculty', 0, 'Regular', ''),
(43, '00000', 'new_college_secretary@gmail.com', '$2y$10$BVeZHdC0jBtsu9xPZvCyiOJmQjfhOFHpoOVlvdfhtS7Vqy.WF3O1S', 0, 'college_secretary', 1, 'Regular', ''),
(44, '11111', 'new_college_chairperson@gmail.com', '$2y$10$w77FSL.rJCKnmGO5x8WVhOjrMdqIC1ndtbaY.987fc0YpMnuRc0wy', 0, 'college_dean', 1, 'Regular', ''),
(45, '22222', '22222@gmail.com', '$2y$10$pOg/fNVDVUOd/MC6laEtYeY/rHRgjDOANrJUfsd7xVtoPn7g2uL0q', 0, 'department_chairperson', 1, 'Regular', ''),
(46, '33333', '33333@gmail.com', '$2y$10$pOg/fNVDVUOd/MC6laEtYeY/rHRgjDOANrJUfsd7xVtoPn7g2uL0q', 1, 'department_secretary', 1, 'Regular', ''),
(47, '44444', '44444@gmail.com', '$2y$10$2n75eyPGkx1fwEKVbjpNkuzQGlxW92lu9sFj3Cv3gd9Ls7nLgQIKe', 0, 'faculty', 0, 'Contractual', ''),
(48, '55555', '55555@gmail.com', '$2y$10$tacpGFZYG6mw/MInSO4XpODs6k6CdZc35HaastXrdh7hfAewW1NH.', 0, 'faculty', 0, 'Regular', ''),
(49, '66666', 'new_college_secretary2@gmail.com', '$2y$10$.vyZpAWTjoSmWQZ/oWpBjuhtaCEo8Aftd9chNL5GQ3tkqZTqte3LS', 0, 'college_secretary', 0, 'Regular', ''),
(50, '77777', 'new_college_chairperson2@gmail.com', '$2y$10$IWrJkQRUzuZ0YKmKA5KLveHU0c9U1stsIBCc1txY6f8GM3/GNVOPa', 0, 'college_dean', 0, 'Regular', ''),
(51, '88888', '88888@gmail.com', '$2y$10$G4hhYltzsCQ31Q41N7bsQOp0WLEtFHE9eQRP.foxBilXyTo.3Gx4a', 1, 'department_secretary', 1, 'Regular', ''),
(52, '99999', '99999@gmail.com', '$2y$10$QHwes2tYat0Gd8qxj1KEnOtmjpSmH09SQ0UCJ/mM8sK8wAc8JOZda', 0, 'department_chairperson', 1, 'Regular', ''),
(53, '10101', '10101@gmail.com', '$2y$10$VPPr6sgOtyV14WxgFfT8cOFLOIXze5K.jR4nils7A2slL4oV4L6pm', 0, 'faculty', 0, 'Regular', ''),
(54, '20202', '20202@gmail.com', '$2y$10$FFlXfy.5.OOW8HGY61u1.exMIHE1bZoTmTa8b9XEt7mJdAHv33H0.', 0, 'faculty', 0, 'Regular', ''),
(55, '9191919191', '9191919191@gmail.com', '$2y$10$pmOqnNUiU67Bl1SN9MrMPuSSd1Xodt/6RT2EXG4rUZmipgP.FCeY.', 0, 'department_secretary', 1, 'Regular', ''),
(56, '5555123123', '5555123123@gmail.com', '$2y$10$iW6lAmT52QuxoqkaFgReje.i4P1QYy2vb78CJO9v3mo1TZesdc9Zy', 0, 'department_chairperson', 1, 'Regular', ''),
(57, '765412312', '765412312@cvsu.edu.ph', '$2y$10$IcabV2VRjVIuvgzhZHJvNuVIlE.ew36K1WNwl6T3vYWupzW4fWf4q', 0, 'department_secretary', 1, 'Regular', ''),
(59, '7234234234', '7234234234@cvsu.edu.ph', '$2y$10$I9X/eQgH5yic9HOngocWIOY5wFbNYSGeSwNfTvvwVTUe4CbHsTOiS', 0, 'department_chairperson', 1, 'Regular', ''),
(60, '202105206', 'testing@cvsu.edu.ph', '$2y$10$a5nD1LVEJPO4Lrcjf6zZg.8lVQy5knoFKfcqnmnVbLVfukTllpzAG', 1, 'college_dean', 0, 'Contractual', ''),
(61, '202105203', 'may@cvsu.edu.ph', '$2y$10$gJFAn41Zj.1B4Asv9Kv8ouOIrwLZayePG0OWYT5xUUQZmQiREiv3S', 0, 'faculty', 1, 'Regular', ''),
(62, '202105204', 'irinemay.ompaling@cvsu.edu.ph', '$2y$10$8HxcMH7.5kNKDXG.3ISNl..AY8nkG6nlWTEPe9IULATvSlfnC/08y', 0, 'college_secretary', 1, 'Regular', 'BiNopZ'),
(63, '10000001', 'roberto.garcia@cvsu.edu.ph', '$2y$10$eJ554gI35QEB6FKbC7Ih3.cDk2ZdVAdDfsMr9.g3AB3bgpMb3qZym', 0, 'department_chairperson', 1, 'Regular', ''),
(64, '20000001', 'jennifer.perez@cvsu.edu.ph', '$2y$10$Al03jrP5Frk9QBy8RbUUMe/NvOIb4gnYCRhfSeGjiTRbfI8dWpDkq', 0, 'department_secretary', 1, 'Regular', ''),
(65, '10000002', 'miguel.torres@cvsu.edu.ph', '$2y$10$EEv.2YKx2a9oFRCkO.NDj.a/PawRA6EUbL6oPO.H6JeDnD7KYh3s6', 0, 'department_chairperson', 1, 'Contractual', ''),
(66, '20000002', 'alicia.santos@cvsu.edu.ph', '$2y$10$/M2E9ndOrG9cyug0fyIRyuvhFCT7Rsvx35urfN5iPMOHdbvY0LfkG', 0, 'department_secretary', 1, 'Regular', ''),
(67, '10000003', 'sophia.delacruz@cvsu.edu.ph', '$2y$10$ezMPIrpQbf/8wyn6Ql35j.bEF9tAd04tJWVDu41/JqrZFVdY4ETPe', 0, 'department_chairperson', 1, 'Regular', ''),
(68, '10000004', 'ricardo.santiago@cvsu.edu.ph', '$2y$10$dQhUKIiYq.NiMweOii0o/.bP9LGbCjPuVbZVQWptRSqWiXQg8odhW', 0, 'department_chairperson', 1, 'Regular', ''),
(69, '20000004', 'linda.martinez@cvsu.edu.ph', '$2y$10$EZjlQvuKKhrXlR4IJQRF9eAxSU5JPUpduA3vi.x2cWgsI.znrodaG', 0, 'department_secretary', 1, 'Regular', ''),
(70, '20000003', 'teresa.gonzales@cvsu.edu.ph', '$2y$10$iAhhL6L5HxuwhE38lNblcO6YkdlldyIZKrqZ7Zsexrm80aqN6l4n2', 0, 'department_secretary', 1, 'Regular', ''),
(71, '30000001', 'ramon.rivera@cvsu.edu.ph', '$2y$10$5bGnV6q/eBqS7V9IvvPuGuiBWJ5WwdIusUoBGg2X1ZC9pMV5nXjES', 0, 'faculty', 0, 'Contractual', ''),
(72, '31000001', 'anna.rodriguez@cvsu.edu.ph', '$2y$10$MqmxGXbxZZSlAvcOfvjejuaazzZcNoz2XkNRlqGnrSEmitzfr69Qm', 1, 'faculty', 0, 'Contractual', ''),
(73, '32000001', 'carlos.mendez@cvsu.edu.ph', '$2y$10$PEizscLZSSuiG/o94mqRPu6p8SPLwXyF41xmbcBxCX/xxZ6rL9HYG', 1, 'faculty', 0, 'Contractual', ''),
(74, '33000001', 'mariaclara.reyes@cvsu.edu.ph', '$2y$10$w/4QN4DPhhr3c4hTFgSNouaky89xtJd0.LnSluhSlN0zOhWp/X0D2', 0, 'department_secretary', 0, 'Regular', ''),
(75, '30000002', 'juan.santos@cvsu.edu.ph', '$2y$10$Nw0p4eJJocKaxg8cQTkL4eKukehClUc0e6VBGFJWiuyIYByOGEj2.', 0, 'faculty', 0, 'Regular', ''),
(76, '31000002', 'elena.torres@cvsu.edu.ph', '$2y$10$avm4xfbhuFB.crkrzq51wO/gtznV1mVxIJ0691nFmaTRbFM.THVnC', 0, 'faculty', 0, 'Contractual', ''),
(77, '202105209', 'testing.college.sec@cvsu.edu.ph', '$2y$10$cfn6kxAX6NMSox5JV4edQ.BW4JPO98GFBccYnEpGfqPFEUB1HJPXy', 0, 'college_secretary', 0, 'Contractual', ''),
(78, '10000006', 'department.chairperson@cvsu.edu.ph', '$2y$10$LP0AUHCC4ev0k/tCyQVfLO0tX7yqu8UIupr8oskK5ufsG9yqg5ruC', 0, 'department_chairperson', 1, 'Regular', ''),
(79, '20000006', 'department.secretary@cvsu.edu.ph', '$2y$10$lWtIKEr0gTWOdDcmgC92ReG0CI3YVgFQjPKIZDHmiLGyJY5ztNcGS', 1, 'department_secretary', 1, 'Contractual', ''),
(80, '30000006', 'member1ez@cvsu.edu.ph', '$2y$10$SgF/frg2.0uDFABkAJLsUe3APgCsJJObagtuowaM8.V/R5OF7Ag3a', 0, 'faculty', 0, 'Contractual', ''),
(81, '31000006', 'member2 @cvsu.edu.ph', '$2y$10$DoURHh5i0xoftPC94WQ9yuO/WQNTps8No13n6Iz/91Jm9PeJqwR06', 0, 'faculty', 0, 'Contractual', ''),
(88, '202105207', 'testingu@cvsu.edu.ph', '$2y$10$uu0f2IEX4.ZTQM1kEpeVau2v7OMAvnoYO5X6N5XgjVNssPOWkIZvW', 0, 'faculty', 0, 'Regular', ''),
(89, '30000004', 'jose.reyes@cvsu.edu.ph', '$2y$10$v5oKlwezw6azhy41O8yNteRvfawmiqyAnDcDUeaT5gtL.gAUN5tjK', 0, 'faculty', 0, 'Contractual', ''),
(90, '876543', 'mr.ephraiel@cvsu.edu.ph', '$2y$10$xsnhzpzEFMYKtCa5BSVTx.bxDQ/EagC1xEkZQgca7KllY49ppeHja', 0, 'faculty', 0, 'Regular', ''),
(91, '202105300', 'larajean.sibunga@cvsu.edu.ph', '$2y$10$vAM670I6jLXpnDA2fRiVteXdANoHRK5EqqQlaFzOYNRM82nKshJ2m', 0, 'college_dean', 0, 'Regular', ''),
(92, '33400001', 'sace@cvsu.edu.ph', '$2y$10$1CXTCoGz.o0ZvGYXtAWTqOt3twuakxusAVvo3QZTaCOSyJUcEEtia', 0, 'faculty', 0, 'Regular', ''),
(93, '33500001', 'arceta@cvsu.edu.ph', '$2y$10$2IxRRTKq46hzR0sJBpCoauHZZetTZ4EV07J5PO2SJkuhXDQ0ZV0mS', 1, 'faculty', 0, 'Regular', ''),
(94, '33600001', 'vergara@cvsu.edu.ph', '$2y$10$aY5B1xFileFtClRtv1Aove5KId1SV1yQ/XCGEGnojJ0qZ7NS/rPQG', 0, 'faculty', 0, 'Contractual', ''),
(95, '33700001', 'ricalde@cvsu.edu.ph', '$2y$10$0MldaZNt1HBewOOZ/GasUOmcLpcUlWx4xDi8gwSoDd.SWWnBOtc.S', 0, 'faculty', 0, 'Contractual', ''),
(102, '2021053100', 'zyrellrezanszzo@cvsu.edu.ph', '$2y$10$GRIyYlZhi.4buQuGF0zOHu7m9mudARqz9kSTRhUjHJrBkY6kZch.i', 0, 'college_dean', 0, 'Regular', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` bigint(20) NOT NULL,
  `name` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `birthday` varchar(256) NOT NULL,
  `phone` varchar(256) NOT NULL,
  `specialization` varchar(256) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `name`, `address`, `birthday`, `phone`, `specialization`, `image`) VALUES
(20, 'Bob Joe', 'Tondo Manila', '2013-06-27', '09876543654', 'Programming', '66b37ad18c234-asdczxczxkdkqjwkejqwelkqmweblqwmebqlwemqwne.jpg'),
(21, 'secretary', 'address', '2024-08-07', '09123091822', 'Cashier', '66b465b4e893a-1879x1056-The-Wolf-Among-Us-Wallpaper-HD-Wolf-Wallpaper.pro_-1536x863.jpg'),
(22, 'asd', 'sad', '2024-08-12', '0987654322', 'Teacher', '66b46918ddc0a-micon.jfif'),
(23, 'chairperson', 'address', '2024-07-29', '0987654321', 'maupo', '66b46aa967e66-asdczxczxkdkqjwkejqwelkqmweblqwmebqlwemqwne.jpg'),
(24, 'department sssecretary', 'address', '2024-08-28', '098765432', 'magsulat', '66b46ad0bbac0-8be718cbbfe66f9b16d26691d3862621.jpg'),
(25, 'gancho', 'poiuytre', '2024-08-14', '0987654323', 'gangster', '66b46f6f5e36f-plant4.png'),
(36, 'tesasdas', 'sitio batong bakal', '2024-08-01', '09865432123', 'teaching', '66bd97ce4c5eb-a.jpg'),
(38, 'faculty is the name', 'j street', '2010-07-18', '09812312371', 'web development', '66c17ebc28a96-deaftalk.png'),
(39, 'faculty lang ako', 'yyy', '1997-06-25', '09234234223', 'programming', '66c183846e5cb-about.png'),
(40, 'tt', 'address', '2000-07-07', '091237182311', 'test', '66c6e97aa204e-unnamed.png'),
(41, 'chairperson 2', 'asdasd', '1995-02-16', '09182937192', 'qwe', '66c6e9c88c1fc-Gemini_Generated_Image_ab0ppxab0ppxab0p.jpeg'),
(42, 'tt', 'asd', '2024-08-08', '0987654321', 'a', '66c6f0c5744d5-oefk25h3.jpg'),
(43, 'New College Faculty Secretary', 'hatdog', '2024-09-10', '09126235532', 'matulog', '66ed1f7b93fda-gg.jpg'),
(44, 'new college chairperson', 'gg', '2024-09-04', '09123456789', 'kumain', '66ed2007ee47f-teacher.png'),
(45, 'new dep chperson', 'zxc', '2024-09-04', '09123456789', 'z', '66ed25c5b9d3c-stop.png'),
(46, '333333', '333333', '2024-09-11', '333333', '333333', '66ed28f7e9085-icons7.png'),
(47, 'New Facultyqqq', 'tester', '2024-09-04', '091283091111', 'Testeraaa', 'profile_66edc219508e53.51485454.png'),
(48, '55555', '55555', '2024-09-04', '55555', '55555', '66ed39deb52d6-asdczxczxkdkqjwkejqwelkqmweblqwmebqlwemqwne.jpg'),
(49, 'new college secretary 2', 'b', '2024-09-10', '09123456789', 'a', '66ed776e111c4-gg.jpg'),
(50, 'new college chairperson 2', 'b', '2024-09-03', '09123456789', 'a', '66ed779b14bf6-gg.jpg'),
(51, '88888z', 'b', '2024-09-11', '091234567882', 'Az', 'profile_66edc076a8bd07.68084030.jpg'),
(52, 'ako si pandoy', 'gf', '2024-09-04', '09182397162', '123123', 'profile_66edc109d01069.64163698.png'),
(53, '10101', 'a', '2024-09-02', '09123571823', 'z', '66ed7cc91c625-greens.jpg'),
(54, '20202', 'basd', '2024-09-10', '0912320202', 'a', '66ed7ce9e3a8c-book.jpg'),
(55, '9191919191', 'tester', '2024-10-18', '0912345678', 'tester', '6705369da816d-logo_chicken.png'),
(56, '5555123123', 'zxc', '2024-10-05', '09876541231', 'aa', '6705526e98ed3-bg.jpg'),
(57, '765412312', '765412312', '2024-10-30', '765412312', '765412312', '672b683767e0e-bg.jpg'),
(59, '7234234234', '7234234234', '2024-11-01', '7234234234', '7234234234', '672b687026f3d-bg.jpg'),
(60, 'TESTING', 'Cebu', '2002-10-10', '094394723800', 'Robotics', '6741041a5733e-aa6566aaacd80d2da2e7496c7ee8d637.jpg'),
(61, 'Dr. May Rodriguez', 'Cavite', '2000-02-22', '09439472390', 'Programming', 'profile_675836844b5b66.99442371.jpg'),
(62, 'Dr. Irine May Ompaling', 'Makati', '2002-10-10', '09674102820', 'Full Stack', '674105a26369a-7c138b1b7607e018b0c7d14bebaa6c6a.jpg'),
(63, 'Dr. Roberto Garcia', 'Cavite', '1978-09-04', '09439472381', 'Robotics', '6741077b0f920-eb9b7b316beeca116a2e0c8fe6736304.jpg'),
(64, 'Ms. Jennifer Kim', 'Cavite', '2002-10-10', '09439472381', 'BACK-END', 'profile_67455c532254e6.13051007.jpg'),
(65, 'Dr. Miguel Torres', 'Indang, Cavite', '1970-07-31', '09123456789', 'Layout', '67410af95e236-a-business-man-stands-against-white-background-with-his-arms-crossed-ai-generative-photo.jpg'),
(66, 'Ms. Alicia Santos', 'Tanza, Cavite', '2000-04-05', '09439472381', 'Robotics', '67410b4ea963e-360_F_658890324_90cQhWiw1FsmeC8UVDuQrzqEjQb5WnnN.jpg'),
(67, 'Dr. Sophia Dela Cruz', 'Naic, Cavite', '2002-05-06', '09876543245', 'Drafting', '67410ba66295c-360_F_617571490_Lagtv4frKo0T4zoElZsldDuzznAATG10.jpg'),
(68, 'Dr. Ricardo Santiago', 'Trece, Cavite', '2000-02-09', '09876543245', 'BACK-END', '67410c29b31c0-channel-2.jpeg'),
(69, 'Ms. Linda Martinez', 'Cavite', '2000-02-23', '0987654', 'BACK-END', '67410cae98377-aa6566aaacd80d2da2e7496c7ee8d637 (1).jpg'),
(70, 'Ms. Teresa Gonzales', 'Manila', '2000-10-20', '09876543245', 'Electrical', '67410ea62eb5f-eb9b7b316beeca116a2e0c8fe6736304.jpg'),
(71, 'Dr. Ramon Rivera', 'Makati City', '2002-02-20', '096778444331', 'Layout', 'profile_6742da62be7880.13633389.jpg'),
(72, 'Dr. Anna Rodriguez', 'San Jose, Bulucan', '2002-01-23', '09677842331', 'System Administration', '67411668553a9-64f0d39d98ca065c3654a58e7c4caa06.jpg'),
(73, 'Dr. Carlos Mendez', 'San Fernando, Pampanga', '2002-04-22', '09677842331', 'Debugginh', '6741174b35d00-png-clipart-leonardo-dicaprio-titanic-leonardo-dicaprio-celebrities-formal-wear.png'),
(74, 'Dr. Maria Clara Reyes', 'Laguna', '1990-07-08', '09677842331', 'UI/UX Designer', 'profile_67583ffcedd3f0.26978558.jpg'),
(75, 'Dr. Juan Santos', 'Cebu', '2002-07-08', '09123456789', 'BACK-END', '6741343a5a1d4-47ccf1c2b509df7d2155186fa85e8d34.jpg'),
(76, 'Dr. Elena Torres', 'Cubao', '2002-10-10', '09876543245', 'BACK-END', '6741348d62efe-9b5b576986a3bfd9cd168a5fd2700c66.png'),
(77, 'Testing College Secretary', 'Cavite', '1990-08-09', '09123456789', 'front-end', '67414287b4f63-shawn.jpg'),
(78, 'Test Department Chairperson', 'Cubao', '2002-02-02', '09439472381', 'dghdghdgd', '6741469670963-d64602a7b954a8b2f09bac97a7911bf8.jpg'),
(79, 'Test Department Secretary', 'Cubao', '2022-05-04', '09439472381', 'Full Stack', '674147451c94f-d64602a7b954a8b2f09bac97a7911bf8.jpg'),
(80, 'Member1', 'Cavite', '2002-03-04', '09677842331', 'Programming', '6741544e497bc-64f0d39d98ca065c3654a58e7c4caa06.jpg'),
(81, 'Member2', 'San Fernando, Pampanga', '2000-10-10', '09677842331', 'Programming', '674154a20ee55-Lee-MinHo_profile_s_0216.jpg'),
(88, 'Testing Faculty U', 'cavite', '2002-10-10', '0987654321', 'Layout', '67452f94a0346-64f0d39d98ca065c3654a58e7c4caa06.jpg'),
(89, 'Dr. Jose Reyes', 'Cavite', '2002-10-10', '09439472381', 'Electrical', '674f9d3fb5a29-360_F_617571490_Lagtv4frKo0T4zoElZsldDuzznAATG10.jpg'),
(90, 'tester', 'asdasd', '2025-01-02', '098765431231', 'asda', '6750e5284e86a-no_image.jpg'),
(91, 'Lara Jean', 'Manila, Philippines', '2000-12-22', '09114102822', 'Firing', '67582c9166214-D5jB8bgWkAAZGyI.jpg'),
(92, 'Elisabeth Sace', 'Manila, Philippines', '2004-02-22', '09114102822', 'Programming', '675830f87de4a-7550a1c6dc4673affc47626958d1b76f.jpg'),
(93, 'Maraiah Queen Arceta', 'Manila, Philippines', '2005-02-02', '09004101122', 'Programming', '67583133e3c8b-460449455_1211811546729481_1744740225868258300_n (1).jpg'),
(94, 'Maria Niccolet Vergara', 'Manila, Philippines', '2000-03-15', '09114101122', 'Programming', '6758317c1ddb7-460476196_1211811466729489_1737615108033501579_n.jpg'),
(95, 'Mary Loi Yves Ricalde', 'Makati, Philippines', '2002-04-06', '09674102822', 'Modeling', '675831c193fce-460468863_1211811536729482_4797097431543960371_n.jpg'),
(102, 'Zy Rezano', 'Manila, Philippines', '2024-12-10', '09674102811', 'Programming', '675852345ae7c-bts.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `college_details`
--
ALTER TABLE `college_details`
  ADD PRIMARY KEY (`college_id`);

--
-- Indexes for table `college_officers`
--
ALTER TABLE `college_officers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `college_id` (`college_id`);

--
-- Indexes for table `college_user_added`
--
ALTER TABLE `college_user_added`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credential_added`
--
ALTER TABLE `credential_added`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `current_year_sem`
--
ALTER TABLE `current_year_sem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `college_id` (`college_id`);

--
-- Indexes for table `deparment_section`
--
ALTER TABLE `deparment_section`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `department_details`
--
ALTER TABLE `department_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `depatment_college` (`depatment_college`);

--
-- Indexes for table `department_faculty`
--
ALTER TABLE `department_faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_subject`
--
ALTER TABLE `faculty_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_subject_section`
--
ALTER TABLE `faculty_subject_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_uploads`
--
ALTER TABLE `faculty_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `for_uploads`
--
ALTER TABLE `for_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resume_upload`
--
ALTER TABLE `resume_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employment_id` (`employment_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `college_details`
--
ALTER TABLE `college_details`
  MODIFY `college_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `college_officers`
--
ALTER TABLE `college_officers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `college_user_added`
--
ALTER TABLE `college_user_added`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `credential_added`
--
ALTER TABLE `credential_added`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `current_year_sem`
--
ALTER TABLE `current_year_sem`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `deparment_section`
--
ALTER TABLE `deparment_section`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `department_details`
--
ALTER TABLE `department_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `department_faculty`
--
ALTER TABLE `department_faculty`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `faculty_subject`
--
ALTER TABLE `faculty_subject`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `faculty_subject_section`
--
ALTER TABLE `faculty_subject_section`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `faculty_uploads`
--
ALTER TABLE `faculty_uploads`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `for_uploads`
--
ALTER TABLE `for_uploads`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `resume_upload`
--
ALTER TABLE `resume_upload`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `college_officers`
--
ALTER TABLE `college_officers`
  ADD CONSTRAINT `college_officers_ibfk_1` FOREIGN KEY (`college_id`) REFERENCES `college_details` (`college_id`);

--
-- Constraints for table `current_year_sem`
--
ALTER TABLE `current_year_sem`
  ADD CONSTRAINT `current_year_sem_ibfk_1` FOREIGN KEY (`college_id`) REFERENCES `college_officers` (`college_id`);

--
-- Constraints for table `department_details`
--
ALTER TABLE `department_details`
  ADD CONSTRAINT `department_details_ibfk_1` FOREIGN KEY (`depatment_college`) REFERENCES `college_details` (`college_id`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
