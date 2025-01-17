-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2024 at 04:24 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sis_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_history`
--

CREATE TABLE `academic_history` (
  `id` int(30) NOT NULL,
  `student_id` int(30) NOT NULL,
  `student_roll` int(11) DEFAULT NULL,
  `course_id` int(30) NOT NULL,
  `semester` varchar(200) NOT NULL,
  `year` varchar(200) NOT NULL,
  `school_year` text NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1 COMMENT '1= New,\r\n2= Regular,\r\n3= Returnee,\r\n4= Transferee',
  `end_status` tinyint(3) NOT NULL DEFAULT 0 COMMENT '0=pending,\r\n1=Completed,\r\n2=Dropout,\r\n3=failed,\r\n4=Transferred-out,\r\n5=Not Enrolled',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `grade` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academic_history`
--

INSERT INTO `academic_history` (`id`, `student_id`, `student_roll`, `course_id`, `semester`, `year`, `school_year`, `status`, `end_status`, `date_created`, `date_updated`, `grade`) VALUES
(30, 17, 0, 54, 'Second Semester', '1', '2023', 1, 1, '2024-01-14 06:46:25', '2024-02-02 09:17:58', 2.65),
(31, 17, 0, 46, 'First Semester', '1', '2023', 1, 5, '2024-01-15 04:39:59', NULL, 1),
(34, 17, NULL, 15, 'First Semester', '1', '2024', 1, 0, '2024-02-02 10:12:20', NULL, 5),
(35, 18, NULL, 15, 'First Semester', '1', '2024', 1, 1, '2024-02-02 10:15:57', NULL, 2.53),
(36, 18, NULL, 124, 'First Semester', '1', '2024', 1, 1, '2024-02-02 10:51:21', NULL, 2.78),
(37, 18, NULL, 68, 'First Semester', '2', '2024', 1, 1, '2024-02-02 11:04:58', NULL, 1.45);

-- --------------------------------------------------------

--
-- Table structure for table `course_list`
--

CREATE TABLE `course_list` (
  `id` int(30) NOT NULL,
  `department_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `units` int(10) DEFAULT NULL,
  `year` int(1) DEFAULT NULL,
  `semester` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_list`
--

INSERT INTO `course_list` (`id`, `department_id`, `name`, `description`, `status`, `delete_flag`, `units`, `year`, `semester`) VALUES
(15, 7, 'GE 01', 'Reading in Philippine History', 1, 0, 3, 1, '1'),
(16, 7, 'GE 02', 'Contemporary Word', 1, 0, 3, 1, '1'),
(17, 7, 'GE 03', 'Mathematics in the Modern World', 1, 0, 3, 1, '1'),
(18, 7, 'GE 04', 'Purposive Communication', 1, 0, 3, 1, '1'),
(19, 7, 'GE 05', 'Art Appreciation', 1, 0, 3, 1, '1'),
(20, 7, 'GE 06', 'Kontekstwalisadong Komunikasyon sa Filipino (KOMFIL)', 1, 0, 3, 1, '1'),
(21, 7, 'NSTP', 'National Service Training Program', 1, 0, 3, 1, '1'),
(22, 7, 'PE 11', 'Fundamentals of Physical Fitness', 1, 0, 3, 1, '1'),
(23, 7, 'GE 07', 'Ethics', 1, 0, 3, 1, '2'),
(24, 7, 'GE 08', 'Science, Technology and Society', 1, 0, 3, 1, '2'),
(25, 7, 'GE 09', 'Understanding The Self', 1, 0, 3, 1, '2'),
(26, 7, 'GE 10', 'Filipino sa Ibat Ibang Larang', 1, 0, 3, 1, '2'),
(27, 7, 'GE 11', 'Sosyedad at Literatura', 1, 0, 3, 1, '2'),
(28, 7, 'GE 12', 'The life and Works of Rizal', 1, 0, 3, 1, '2'),
(29, 7, 'NSTP', 'National Service Training Program 2', 1, 0, 3, 1, '2'),
(30, 7, 'PE 12', 'Rythmic Activities', 1, 0, 2, 1, '2'),
(31, 7, ' ITP 101', 'ICT Fundamentals', 1, 0, 3, 1, '2'),
(32, 7, 'ITP 102', 'Programming 2 (Logic Formation)', 1, 0, 3, 2, '1'),
(33, 7, 'ITP 103', 'Fundamentals of Information Management ', 1, 0, 3, 2, '1'),
(34, 7, 'ITP 104', 'Fundamentals of Networking', 1, 0, 3, 2, '1'),
(35, 7, 'ITP 105', 'Fundamentals of Accounting & Financial System', 1, 0, 3, 2, '1'),
(36, 7, 'PE 13', 'Individial and Dual Sports', 1, 0, 2, 2, '1'),
(37, 7, ' ITC 106', 'Programming 2', 1, 0, 3, 2, '2'),
(38, 7, 'ITC 107', 'Operating System', 1, 0, 3, 2, '2'),
(39, 7, 'ITC 108', 'PC Servicing & Management ', 1, 0, 3, 2, '2'),
(40, 7, 'ITC 109', 'Data Structure and Algorithm', 1, 0, 3, 2, '2'),
(41, 7, 'ITC 110', 'Networking Management', 1, 0, 3, 2, '2'),
(42, 7, 'ITC 111', 'System Analysis and Design', 1, 0, 3, 2, '2'),
(43, 7, 'ITC 112', 'Fundamentals of Database Systems', 1, 0, 3, 2, '2'),
(44, 7, 'ITC 113', 'Web System & Technologies', 1, 0, 3, 2, '2'),
(45, 7, 'PE 14', 'Team Sports', 1, 0, 2, 2, '2'),
(46, 7, ' ELECTIVE 1', 'Mapping and GIS', 1, 0, 3, 3, '1'),
(47, 7, 'ITC 114', 'Advanced Database System', 1, 0, 3, 3, '1'),
(48, 7, 'ITC 115', 'Computer Organization with Assembly Language', 1, 0, 3, 3, '1'),
(49, 7, 'ITC 116', 'Web System and Technologies', 1, 0, 3, 3, '1'),
(50, 7, 'ITC 117', 'Social and Proffesional Issue', 1, 0, 3, 3, '1'),
(51, 7, 'ITC 118', 'System Integration and Architecture', 1, 0, 3, 3, '1'),
(52, 7, 'ITC 119', 'Multimedia System', 1, 0, 3, 3, '1'),
(53, 7, 'ITC 120', 'E- commerce', 1, 0, 3, 3, '1'),
(54, 7, ' ELECTIVE 2', 'Graphic Design and Animation', 1, 0, 3, 3, '2'),
(55, 7, 'ITP 121', 'Advanced JAVA  Programming', 1, 0, 3, 3, '2'),
(56, 7, 'ITP 122', 'Wireless and Internet Technologies', 1, 0, 3, 3, '2'),
(57, 7, 'ITP 123', 'Android and Mobile Computing', 1, 0, 3, 3, '2'),
(58, 7, 'ITP 124', 'Capstone Project 1', 1, 0, 3, 3, '2'),
(59, 7, 'ITP 125', 'Content Management System', 1, 0, 3, 3, '2'),
(60, 7, 'ITP 126', 'Information Assurance and Security', 1, 0, 3, 3, '2'),
(61, 7, 'ITC 127', 'Application Development and Emerging Technologies', 1, 0, 3, 4, '1'),
(62, 7, 'ITC 128', 'Artificial Intelligence', 1, 0, 3, 4, '1'),
(63, 7, 'ITC 129', 'Event Driven Programming', 1, 0, 3, 4, '1'),
(64, 7, 'ITC 130', 'Capstone Project2', 1, 0, 3, 4, '1'),
(65, 7, 'ELECTIVE 3', 'Autocad/ Free Elective', 1, 0, 3, 4, '1'),
(66, 7, 'ELECTIVE 4', 'Platform Technologies', 1, 0, 3, 4, '1'),
(67, 7, 'OJT', 'On the job Training', 1, 0, 6, 4, '2'),
(68, 8, 'EL 100', 'Introduction to Lingustics', 1, 0, 3, 2, '1'),
(69, 8, 'EL 101', 'Language, Culture and Society', 1, 0, 3, 2, '1'),
(70, 8, 'EL 102', 'Structures of English', 1, 0, 3, 2, '1'),
(71, 8, 'EL 103', 'Principles and Theories of Language Acquisition ', 1, 0, 3, 2, '1'),
(72, 8, 'PE 13', 'Individual and Dual Sports', 1, 0, 2, 2, '1'),
(73, 8, 'PROF ED 11', 'The Child and Adoloscent Learner and Learning', 1, 0, 3, 2, '1'),
(74, 8, 'PROF ED 12', 'The Teaching Profession', 1, 0, 3, 2, '1'),
(75, 8, 'PROF ED 13', 'Foundation of Special and Inclusive Education', 1, 0, 3, 2, '1'),
(76, 8, 'PROF ED 14', 'Facilitating Learner- Centered Teaching', 1, 0, 3, 2, '1'),
(77, 8, 'PROF ED 15', 'The Teacher and the School Curriculum', 1, 0, 3, 2, '1'),
(78, 8, 'EL 104', 'Language Programs and Policies in Multilingual', 1, 0, 3, 2, '2'),
(79, 8, 'EL 106', 'Teaching and Assesment in Literature', 1, 0, 3, 2, '2'),
(80, 8, 'EL 107', 'Teaching and Assesment of the Macro Skills', 1, 0, 3, 2, '2'),
(81, 8, 'EL 108', 'Teaching and Assesment of Grammar ', 1, 0, 3, 2, '2'),
(82, 8, 'EL 119', 'Campus Journalism', 1, 0, 3, 2, '2'),
(83, 8, 'ELEC 1', 'Remedial Instruction in English', 1, 0, 3, 2, '2'),
(84, 8, 'ELEC 2', 'English for Specific Purposes', 1, 0, 3, 2, '2'),
(85, 8, 'PE 14', 'Team Sports', 1, 0, 2, 2, '2'),
(86, 8, 'PROF ED 16', 'The Teacher and The Community, School Culture', 1, 0, 3, 2, '2'),
(87, 8, 'EL 112', 'Language Research', 1, 0, 3, 3, '1'),
(88, 8, 'EL 113', 'Survey of Philippine Literature in English', 1, 0, 3, 3, '1'),
(89, 8, 'EL 114', 'Survey of Afgo Asia Literature', 1, 0, 3, 3, '1'),
(90, 8, 'EL 115', 'Survey of English and American Literature', 1, 0, 3, 3, '1'),
(91, 8, 'EL 116', 'Contemporary and Popular Literature', 1, 0, 3, 3, '1'),
(92, 8, 'EL 18', 'Technical Writing', 1, 0, 3, 3, '1'),
(93, 8, 'PROF ED 17', 'Technology for Teaching and Learning 1', 1, 0, 3, 3, '1'),
(94, 8, 'PROF ED 18', 'Assesment of Learning 1', 1, 0, 3, 3, '1'),
(95, 8, 'EL 105', 'Preparation of Language Learning Materials', 1, 0, 3, 3, '2'),
(96, 8, 'EL 109', 'Speech and Theater Arts', 1, 0, 3, 3, '2'),
(97, 8, 'EL 111', 'Children and Adolescent Literature', 1, 0, 3, 3, '2'),
(98, 8, 'EL 112', 'Mythology and Folklore', 1, 0, 3, 3, '2'),
(99, 8, 'EL 117', 'Literary Critism', 1, 0, 3, 3, '2'),
(100, 8, 'PROF ED 19', 'Assessment of Learning 2', 1, 0, 3, 3, '2'),
(101, 8, 'PROF ED 20', 'Building and Enhancing New LiteraciesAcross ', 1, 0, 3, 3, '2'),
(102, 8, 'TTL 2', 'Technology for Teaching and Learning 2', 1, 0, 3, 3, '2'),
(103, 8, 'PROF ED 21', 'Field Study 1 observations of Teaching Learning in Actual', 1, 0, 3, 4, '1'),
(104, 8, 'PROF ED 22', 'Field Study 2 Participation and Teaching Assistantship', 1, 0, 3, 4, '1'),
(105, 8, 'PROF ED 23', 'Practice Teaching', 1, 0, 3, 4, '2'),
(106, 8, 'PROF ED 24', 'Research', 1, 0, 3, 4, '2'),
(108, 8, 'GE 01', 'Reading in Philippine History', 1, 0, 3, 1, '1'),
(109, 8, 'GE 02', 'Contemporary Word', 1, 0, 3, 1, '1'),
(110, 8, 'GE 03', 'Mathematics in the Modern World', 1, 0, 3, 1, '1'),
(111, 8, 'GE 04', 'Purposive Communication', 1, 0, 3, 1, '1'),
(112, 8, 'GE 05', 'Art Appreciation', 1, 0, 3, 1, '1'),
(113, 8, 'GE 06', 'Kontekstwalisadong Komunikasyon sa Filipino (KOMFIL)', 1, 0, 3, 1, '1'),
(114, 8, 'NSTP', 'National Service Training Program', 1, 0, 3, 1, '1'),
(115, 8, 'PE 11', 'Fundamentals of Physical Fitness', 1, 0, 3, 1, '1'),
(116, 8, 'GE 07', 'Ethics', 1, 0, 3, 1, '2'),
(117, 8, 'GE 08', 'Science, Technology and Society', 1, 0, 3, 1, '2'),
(118, 8, 'GE 09', 'Understanding The Self', 1, 0, 3, 1, '2'),
(119, 8, 'GE 10', 'Filipino sa Ibat Ibang Larang', 1, 0, 3, 1, '2'),
(120, 8, 'GE 11', 'Sosyedad at Literatura', 1, 0, 3, 1, '2'),
(121, 8, 'GE 12', 'The life and Works of Rizal', 1, 0, 3, 1, '2'),
(122, 8, 'NSTP', 'National Service Training Program 2', 1, 0, 3, 1, '2'),
(123, 8, 'PE 12', 'Rythmic Activities', 1, 0, 2, 1, '2'),
(124, 8, ' ITP 101', 'ICT Fundamentals', 1, 0, 3, 1, '2');

-- --------------------------------------------------------

--
-- Table structure for table `department_list`
--

CREATE TABLE `department_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_list`
--

INSERT INTO `department_list` (`id`, `name`, `description`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(7, 'BSIT', 'Bachelor of Science in Information Technology', 1, 0, '2023-12-14 10:06:57', NULL),
(8, 'BEED', 'Bachelor in Elementary Education', 1, 0, '2023-12-14 10:07:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `log_audit`
--

CREATE TABLE `log_audit` (
  `id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `user_type` int(10) NOT NULL,
  `activity` varchar(20) NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_audit`
--

INSERT INTO `log_audit` (`id`, `firstname`, `middlename`, `lastname`, `username`, `user_type`, `activity`, `date`) VALUES
(8, 'Nino', NULL, 'Valdez', 'Valdez-29878456', 3, 'Login', 'Tue, 23 Jan 2024 08:13:54 +080'),
(9, '', NULL, '', '', 0, 'Logout', 'Tue, 23 Jan 2024 08:14:05 +080'),
(10, 'Adminstrator', NULL, 'Admin', 'admin', 1, 'Login', 'Tue, 23 Jan 2024 08:14:14 +080'),
(11, 'Adminstrator', NULL, 'Admin', 'admin', 1, 'Logout', 'Tue, 23 Jan 2024 08:17:31 +080'),
(12, 'Nino', NULL, 'Valdez', 'Valdez-29878456', 3, 'Login', 'Tue, 23 Jan 2024 08:17:45 +080'),
(13, 'Nino', NULL, 'Valdez', 'Valdez-29878456', 3, 'Logout', 'Tue, 23 Jan 2024 08:17:48 +080'),
(14, 'Adminstrator', NULL, 'Admin', 'admin', 1, 'Login', 'Tue, 23 Jan 2024 08:17:53 +080'),
(15, 'Adminstrator', NULL, 'Admin', 'admin', 1, 'Login', 'Fri, 26 Jan 2024 08:23:55 +080'),
(16, 'Adminstrator', NULL, 'Admin', 'admin', 1, 'Login', 'Fri, 02 Feb 2024 07:25:41 +080'),
(17, 'Adminstrator', NULL, 'Admin', 'admin', 1, 'Logout', 'Fri, 02 Feb 2024 10:26:32 +080'),
(18, 'Lyka Mae', NULL, 'Solis', 'Solis-77777777', 3, 'Login', 'Fri, 02 Feb 2024 10:26:37 +080'),
(19, 'Lyka Mae', NULL, 'Solis', 'Solis-77777777', 3, 'Logout', 'Fri, 02 Feb 2024 10:28:22 +080'),
(20, 'Nino', NULL, 'Valdez', 'Valdez-29878456', 3, 'Login', 'Fri, 02 Feb 2024 10:28:36 +080'),
(21, 'Nino', NULL, 'Valdez', 'Valdez-29878456', 3, 'Logout', 'Fri, 02 Feb 2024 10:35:24 +080'),
(22, 'Adminstrator', NULL, 'Admin', 'admin', 1, 'Login', 'Fri, 02 Feb 2024 10:35:28 +080'),
(23, 'Adminstrator', NULL, 'Admin', 'admin', 1, 'Logout', 'Fri, 02 Feb 2024 10:52:39 +080'),
(24, 'Lyka Mae', NULL, 'Solis', 'Solis-77777777', 3, 'Login', 'Fri, 02 Feb 2024 10:52:44 +080'),
(25, 'Lyka Mae', NULL, 'Solis', 'Solis-77777777', 3, 'Logout', 'Fri, 02 Feb 2024 11:04:11 +080'),
(26, 'Adminstrator', NULL, 'Admin', 'admin', 1, 'Login', 'Fri, 02 Feb 2024 11:04:16 +080'),
(27, 'Adminstrator', NULL, 'Admin', 'admin', 1, 'Logout', 'Fri, 02 Feb 2024 11:05:03 +080'),
(28, 'Lyka Mae', NULL, 'Solis', 'Solis-77777777', 3, 'Login', 'Fri, 02 Feb 2024 11:05:13 +080');

-- --------------------------------------------------------

--
-- Table structure for table `student_list`
--

CREATE TABLE `student_list` (
  `id` int(30) NOT NULL,
  `roll` varchar(100) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` text NOT NULL,
  `gender` varchar(100) NOT NULL,
  `contact` text NOT NULL,
  `present_address` text NOT NULL,
  `permanent_address` text NOT NULL,
  `dob` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `department` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_list`
--

INSERT INTO `student_list` (`id`, `roll`, `firstname`, `middlename`, `lastname`, `gender`, `contact`, `present_address`, `permanent_address`, `dob`, `status`, `delete_flag`, `date_created`, `date_updated`, `department`) VALUES
(17, '29878456', 'Nino', 'Protacio', 'Valdez', 'Male', '09756447863', 'Curva', 'Curva', '1997-11-20', 1, 0, '2024-01-08 09:32:40', NULL, 'BSIT'),
(18, '77777777', 'Lyka Mae', 'Rino', 'Solis', 'Female', '09763457623', 'Luna', 'Apayao', '1997-11-20', 1, 0, '2024-02-02 10:15:24', NULL, 'BEED');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Student Information System'),
(6, 'short_name', 'SIS - PHP'),
(11, 'logo', 'uploads/logo-1702865305.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1704498731.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0=not verified, 1 = verified',
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `academic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `status`, `date_added`, `date_updated`, `academic_id`) VALUES
(1, 'Adminstrator', NULL, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatar-1.png?v=1639468007', NULL, 1, 1, '2021-01-20 14:02:37', '2021-12-14 15:47:08', 0),
(21, 'Nino', 'Protacio', 'Valdez', 'Valdez-29878456', 'ad6a280417a0f533d8b670c61667e1a0', NULL, NULL, 3, 1, '2024-01-08 09:32:40', NULL, 17),
(22, 'Lyka Mae', 'Rino', 'Solis', 'Solis-77777777', 'ad6a280417a0f533d8b670c61667e1a0', NULL, NULL, 3, 1, '2024-02-02 10:15:24', NULL, 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_history`
--
ALTER TABLE `academic_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `course_list`
--
ALTER TABLE `course_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `department_list`
--
ALTER TABLE `department_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_audit`
--
ALTER TABLE `log_audit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_list`
--
ALTER TABLE `student_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_history`
--
ALTER TABLE `academic_history`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `course_list`
--
ALTER TABLE `course_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `department_list`
--
ALTER TABLE `department_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `log_audit`
--
ALTER TABLE `log_audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `student_list`
--
ALTER TABLE `student_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_history`
--
ALTER TABLE `academic_history`
  ADD CONSTRAINT `academic_history_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `academic_history_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_list`
--
ALTER TABLE `course_list`
  ADD CONSTRAINT `course_list_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
