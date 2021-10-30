-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2021 at 12:14 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `register`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ad_ID` varchar(8) NOT NULL,
  `ad_fname` varchar(30) NOT NULL,
  `ad_lname` varchar(30) NOT NULL,
  `dept_ID` varchar(3) NOT NULL,
  `ad_email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ad_ID`, `ad_fname`, `ad_lname`, `dept_ID`, `ad_email`) VALUES
('B204001', 'วราภรณ์', 'อินสม', '204', 'admin01');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_ID` varchar(6) NOT NULL,
  `coursename` varchar(40) NOT NULL,
  `lec_credit` int(1) NOT NULL,
  `lab_credit` int(1) DEFAULT NULL,
  `db_ID` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_ID`, `coursename`, `lec_credit`, `lab_credit`, `db_ID`) VALUES
('057127', 'Badmin for life & exerc', 1, 0, '057'),
('057132', 'Happy life in camping', 2, 0, '057'),
('057137', 'SPORTS FOR HEALTH', 3, 0, '057'),
('202101', 'Basic biology 1', 3, 0, '202'),
('204100', 'It and modern life', 3, 0, '204'),
('204111', 'FUNDAMENTALS OF PROGRAMMING', 2, 1, '204'),
('204321', 'DATABASE SYSTEMS', 2, 1, '204'),
('204341', 'OPERATING SYSTEMS', 3, 0, '204'),
('204361', 'SOFTWARE ENGINEERING', 3, 0, '204'),
('204362', 'Object-oriented design', 3, 0, '204'),
('204451', 'ALGO DESIGN & ANALYSIS', 3, 0, '204'),
('208263', 'Elementary statistics', 3, 0, '208'),
('229323', 'DATA MANIPULATION FOR DS', 2, 1, '204'),
('356102', 'Ornamental aquatic animals', 3, 0, '356');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_ID` varchar(3) NOT NULL,
  `dept_name` varchar(30) NOT NULL,
  `fac_ID` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_ID`, `dept_name`, `fac_ID`) VALUES
('000', 'Central', '00'),
('057', 'Physical and Health Education', '02'),
('201', 'Faculty Course', '05'),
('202', 'Biology', '05'),
('203', 'Chemistry', '05'),
('204', 'Computer Science', '05'),
('207', 'Physics', '05'),
('208', 'Statistics', '05'),
('229', 'Data Science', '05'),
('356', 'Animal Science', '08');

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `s_ID` varchar(9) NOT NULL,
  `c_ID` varchar(8) NOT NULL,
  `en_sec` varchar(3) NOT NULL,
  `en_sem` varchar(1) NOT NULL,
  `en_year` varchar(2) NOT NULL,
  `comp_enroll` varchar(21) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`s_ID`, `c_ID`, `en_sec`, `en_sem`, `en_year`, `comp_enroll`) VALUES
('620510650', '057137', '001', '1', '64', '620510650057137001164'),
('620510650', '204321', '001', '1', '64', '620510650204321001164'),
('620510650', '204341', '001', '1', '64', '620510650204341001164'),
('620510650', '204361', '002', '1', '64', '620510650204361002164'),
('620510650', '204451', '002', '1', '64', '620510650204451002164'),
('620510650', '229323', '002', '1', '64', '620510650229323002164'),
('620510650', '356102', '001', '1', '64', '620510650356102001164'),
('620510651', '057137', '001', '1', '64', '620510651057137001164'),
('620510658', '057137', '001', '1', '64', '620510658057137001164'),
('620510658', '204321', '001', '1', '64', '620510658204321001164'),
('620510658', '204451', '001', '1', '64', '620510658204451001164');

-- --------------------------------------------------------

--
-- Table structure for table `exam_time`
--

CREATE TABLE `exam_time` (
  `exam_start` varchar(5) DEFAULT NULL,
  `exam_finish` varchar(5) DEFAULT NULL,
  `comp_exam` int(2) NOT NULL,
  `ex_date` varchar(30) NOT NULL,
  `status` varchar(7) NOT NULL,
  `exam_sem` varchar(1) NOT NULL,
  `exam_year` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_time`
--

INSERT INTO `exam_time` (`exam_start`, `exam_finish`, `comp_exam`, `ex_date`, `status`, `exam_sem`, `exam_year`) VALUES
(NULL, NULL, 0, 'Regular Exam', 'Midterm', '0', ''),
('8:00', '11:00', 1, '16 สิงหาคม 2564', 'Midterm', '1', '64'),
('12:00', '15:00', 2, '16 สิงหาคม 2564', 'Midterm', '1', '64'),
('15:30', '18:30', 3, '16 สิงหาคม 2564', 'Midterm', '1', '64'),
('8:00', '11:00', 4, '17 สิงหาคม 2564', 'Midterm', '1', '64'),
('12:00', '15:00', 5, '17 สิงหาคม 2564', 'Midterm', '1', '64'),
('15:30', '18:30', 6, '17 สิงหาคม 2564', 'Midterm', '1', '64'),
('8:00', '11:00', 7, '18 สิงหาคม 2564', 'Midterm', '1', '64'),
('12:00', '15:00', 8, '18 สิงหาคม 2564', 'Midterm', '1', '64'),
('15:30', '18:30', 9, '18 สิงหาคม 2564', 'Midterm', '1', '64'),
('8:00', '11:00', 10, '19 สิงหาคม 2564', 'Midterm', '1', '64'),
('12:00', '15:00', 11, '19 สิงหาคม 2564', 'Midterm', '1', '64'),
('15:30', '18:30', 12, '19 สิงหาคม 2564', 'Midterm', '1', '64'),
('8:00', '11:00', 13, '20 สิงหาคม 2564', 'Midterm', '1', '64'),
('12:00', '15:00', 14, '20 สิงหาคม 2564', 'Midterm', '1', '64'),
('15:30', '18:30', 15, '20 สิงหาคม 2564', 'Midterm', '1', '64'),
('8:00', '11:00', 16, '21 สิงหาคม 2564', 'Midterm', '1', '64'),
('12:00', '15:00', 17, '21 สิงหาคม 2564', 'Midterm', '1', '64'),
('15:30', '18:30', 18, '21 สิงหาคม 2564', 'Midterm', '1', '64'),
('8:00', '11:00', 19, '22 สิงหาคม 2564', 'Midterm', '1', '64'),
('12:00', '15:00', 20, '22 สิงหาคม 2564', 'Midterm', '1', '64'),
('15:30', '18:30', 21, '22 สิงหาคม 2564', 'Midterm', '1', '64');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `fac_ID` varchar(2) NOT NULL,
  `fac_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`fac_ID`, `fac_name`) VALUES
('00', 'Central'),
('01', 'Humanities'),
('02', 'Education'),
('03', 'Fine Arts'),
('04', 'SOCIAL SCIENCES'),
('05', 'Science'),
('06', 'Engineering'),
('07', 'Medicine'),
('08', 'Agriculture'),
('09', 'Dentistry'),
('10', 'Pharmacy'),
('11', 'Associated Medical Sciences');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `type`) VALUES
('admin01', 'test3456', 3),
('munpao@cmu.ac.th', 'test1234', 1),
('pachara@cmu.ac.th', 'test1234', 1),
('phonsuang@cmu.ac.th', 'test1234', 1),
('phutawan@cmu.ac.th', 'phu1234', 1),
('s001', 'test1234', 2),
('s002', 'test1234', 2),
('t001', 'test01', 2),
('t002', 'test02', 2),
('t004', 'test04', 2),
('t006', 'test06', 2),
('t007', 'test07', 2),
('t011', 'test11', 2),
('t013', 'test3456', 2),
('t014', 'test3456', 2),
('t017', 'test17', 2),
('t018', 'test18', 2),
('t021', 'test21', 2),
('t057001', 'test6789', 2),
('t356', 'test3456', 2);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_ID` varchar(8) NOT NULL,
  `capacity` int(3) DEFAULT NULL,
  `dr_ID` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_ID`, `capacity`, `dr_ID`) VALUES
('AB4-101', 300, '356'),
('CSB100', 100, '204'),
('CSB201', 28, '204'),
('CSB202', 28, '204'),
('CSB203', 18, '204'),
('CSB204', NULL, '204'),
('CSB207', 38, '204'),
('CSB209', 40, '204'),
('CSB210', 40, '204'),
('CSB301', 55, '204'),
('CSB303', 31, '204'),
('CSB307', 41, '204'),
('CSB308', 40, '204'),
('EB9202', 60, '057'),
('MS Team', NULL, '000'),
('PB2100', 300, '207'),
('RB5301', 40, '000');

-- --------------------------------------------------------

--
-- Table structure for table `schduling_exam`
--

CREATE TABLE `schduling_exam` (
  `course_ID` varchar(6) NOT NULL,
  `ex_capacity` int(3) DEFAULT NULL,
  `ex_date` int(2) NOT NULL,
  `ex_room` varchar(8) NOT NULL,
  `t_ID1` varchar(30) NOT NULL,
  `t_ID2` varchar(30) DEFAULT NULL,
  `comp_examschdule` varchar(30) NOT NULL,
  `comp_examroom` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schduling_exam`
--

INSERT INTO `schduling_exam` (`course_ID`, `ex_capacity`, `ex_date`, `ex_room`, `t_ID1`, `t_ID2`, `comp_examschdule`, `comp_examroom`) VALUES
('057137', NULL, 0, '', 'สราวุฒิ พงษ์พิพัฒน์', NULL, '057137001164', '057137001164EB9201'),
('204321', 30, 11, 'CSB209', 'อารีรัตน์ ตรงรัศมีทอง', 'สุทธิพงศ์ สุรักษ์', '204321002164', '204321002164CSB209'),
('204321', 30, 11, 'CSB207', 'ชุรี เตชะวุฒิ', 'ถนอม กองใจ', '204321001164', '204324001164CSB207'),
('204341', 30, 7, 'CSB207', 'วาริน เชาวทัต', 'สุทธิพงศ์ สุรักษ์', '204341001164', '204341001164CSB207'),
('204341', 30, 7, 'CSB209', 'วรวุฒิ ศรีสุขคำ', 'ถนอม กองใจ', '204341002164', '204341002164CSB209'),
('204361', 30, 19, 'CSB207', 'วัชรี จำปามูล', 'ถนอม กองใจ', '204361001164', '204361001164CSB207'),
('204361', 30, 19, 'CSB209', 'ดุษฎี ประเสริฐธิติพงษ์', 'สุทธิพงศ์ สุรักษ์', '204361002164', '204361002164CSB209'),
('204451', 30, 2, 'CSB207', 'เบญจมาศ ปัญญางาม', 'ถนอม กองใจ', '204451001164', '204451001164CSB207'),
('204451', 30, 2, 'CSB209', 'จักริน ชวชาติ', 'สุทธิพงศ์ สุรักษ์', '204451002164', '204451002164CSB209'),
('229323', 45, 17, 'CSB207', 'เสมอเเข สมหอม', 'ถนอม กองใจ', '229323001164', '229323001164CSB207'),
('229323', 40, 17, 'CSB207', 'รัศมีทิพย์ วิตา', 'สุทธิพงศ์ สุรักษ์', '229323002164', '229323002164CSB209'),
('356102', 300, 0, '', 'ศิริพร โตลา', '', '356102001164', '356102001164AB1410');

-- --------------------------------------------------------

--
-- Table structure for table `schduling_lec`
--

CREATE TABLE `schduling_lec` (
  `course_lecID` varchar(6) NOT NULL,
  `capacity` int(3) NOT NULL,
  `date` int(3) NOT NULL,
  `section` varchar(3) NOT NULL,
  `semester` varchar(1) NOT NULL,
  `year` varchar(3) NOT NULL,
  `comp_schduling` varchar(13) NOT NULL,
  `lab_room` varchar(8) DEFAULT NULL,
  `lec_room` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schduling_lec`
--

INSERT INTO `schduling_lec` (`course_lecID`, `capacity`, `date`, `section`, `semester`, `year`, `comp_schduling`, `lab_room`, `lec_room`) VALUES
('057137', 60, 8, '001', '1', '64', '057137001164', NULL, 'EB9202'),
('204321', 30, 17, '001', '1', '64', '204321001164', 'CSB301', 'CSB209'),
('204321', 30, 17, '002', '1', '64', '204321002164', 'CSB303', 'CSB210'),
('204341', 30, 3, '001', '1', '64', '204341001164', '', 'CSB207'),
('204341', 30, 3, '002', '1', '64', '204341002164', '', 'CSB209'),
('204361', 30, 2, '001', '1', '64', '204361001164', '', 'CSB207'),
('204361', 30, 2, '002', '1', '64', '204361002164', '', 'CSB209'),
('204451', 30, 7, '001', '1', '64', '204451001164', '', 'CSB207'),
('204451', 30, 7, '002', '1', '64', '204451002164', '', 'CSB209'),
('229323', 45, 18, '001', '1', '64', '229323001164', 'CSB301', 'CSB209'),
('229323', 40, 18, '002', '1', '64', '229323002164', 'CSB210', 'CSB303'),
('356102', 200, 5, '001', '1', '64', '356102001164', NULL, 'AB4-101'),
('356102', 100, 5, '002', '1', '64', '356102002164', NULL, 'AB4-101');

-- --------------------------------------------------------

--
-- Table structure for table `slot_time`
--

CREATE TABLE `slot_time` (
  `study_day` varchar(3) NOT NULL,
  `study_start` varchar(5) NOT NULL,
  `study_finish` varchar(5) NOT NULL,
  `comp_slot` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slot_time`
--

INSERT INTO `slot_time` (`study_day`, `study_start`, `study_finish`, `comp_slot`) VALUES
('MTh', '8:00', '9:30', 1),
('MTh', '9:30', '11:00', 2),
('MTh', '11:00', '12:30', 3),
('MTh', '13:00', '14:30', 4),
('MTh', '14:30', '16:00', 5),
('MTh', '16:00', '17:30', 6),
('TuF', '8:00', '9:30', 7),
('TuF', '9:30', '11:00', 8),
('TuF', '11:00', '12:30', 9),
('TuF', '13:00', '14:30', 10),
('TuF', '14:30', '16:30', 11),
('TuF', '16:00', '17:30', 12),
('We', '9:30', '12:30', 13),
('We', '13:00', '16:00', 14),
('We', '14:30', '17:30', 15),
('MTh', '12:30', '14:30', 16),
('TuF', '12:30', '14:30', 17),
('TuF', '14:30', '16:30', 18);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `std_ID` varchar(9) NOT NULL,
  `std_fname` varchar(30) NOT NULL,
  `std_lname` varchar(30) NOT NULL,
  `sex` varchar(1) NOT NULL,
  `email` varchar(30) NOT NULL,
  `d_ID` varchar(3) NOT NULL,
  `t_ID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`std_ID`, `std_fname`, `std_lname`, `sex`, `email`, `d_ID`, `t_ID`) VALUES
('620510001', 'มันเผา', 'สุขดี', 'F', 'munpao@cmu.ac.th', '204', 'A204001'),
('620510650', 'พชร', 'สุขสำราญ', 'M', 'pachara@cmu.ac.th', '204', 'A204021'),
('620510651', 'พรสรวง', 'รังควร', 'F', 'phonsuang@cmu.ac.th', '204', 'A204021'),
('620510658', 'ภูตะวัน', 'สาระสุข', 'M', 'phutawan@cmu.ac.th', '204', 'A204011');

-- --------------------------------------------------------

--
-- Table structure for table `teach`
--

CREATE TABLE `teach` (
  `t_ID` varchar(11) NOT NULL,
  `course_ID` varchar(11) NOT NULL,
  `t_sec` varchar(3) NOT NULL,
  `t_sem` varchar(1) NOT NULL,
  `t_year` varchar(2) NOT NULL,
  `comp_teach` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teach`
--

INSERT INTO `teach` (`t_ID`, `course_ID`, `t_sec`, `t_sem`, `t_year`, `comp_teach`) VALUES
('A057001', '057137', '001', '1', '64', 'A057001057137001164'),
('A204001', '204321', '001', '1', '64', 'A204001204321001164'),
('A204002', '204361', '002', '1', '64', 'A204002204361001164'),
('A204013', '204361', '001', '1', '64', 'A204002204361002164'),
('A204004', '204451', '001', '1', '64', 'A204004204451001164'),
('A204006', '204451', '002', '1', '64', 'A204006204451002164'),
('A204007', '229323', '002', '1', '64', 'A204007229323002164'),
('A204011', '204341', '002', '1', '64', 'A204011204341002164'),
('A204014', '229323', '001', '1', '64', 'A204014229323001164'),
('A204017', '204321', '002', '1', '64', 'A204017204321002164'),
('A204018', '204341', '001', '1', '64', 'A204018204341001164'),
('A356001', '356102', '001', '1', '64', 'A356001356102002164');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `t_ID` varchar(10) NOT NULL,
  `t_fname` varchar(30) NOT NULL,
  `t_lname` varchar(30) NOT NULL,
  `dt_ID` varchar(3) NOT NULL,
  `t_email` varchar(30) NOT NULL,
  `type` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`t_ID`, `t_fname`, `t_lname`, `dt_ID`, `t_email`, `type`) VALUES
('A057001', 'สราวุฒิ', 'พงษ์พิพัฒน์', '057', 't057001', '1'),
('A204001', 'ชุรี', 'เตชะวุฒิ', '204', 't001', '1'),
('A204002', 'ดุษฎี', 'ประเสริฐธิติพงษ์', '204', 't002', '1'),
('A204004', 'เบญจมาศ', 'ปัญญางาม', '204', 't004', '1'),
('A204006', 'จักริน', 'ชวชาติ', '204', 't006', '1'),
('A204007', 'รัศมีทิพย์', 'วิตา', '204', 't007', '1'),
('A204011', 'วรวุฒิ', 'ศรีสุขคำ', '204', 't011', '1'),
('A204013', 'วัชรี', 'จำปามูล', '204', 't013', '1'),
('A204014', 'เสมอเเข', 'สมหอม', '204', 't014', '1'),
('A204017', 'อารีรัตน์', 'ตรงรัศมีทอง', '204', 't017', '1'),
('A204018', 'วาริน', 'เชาวทัต', '204', 't018', '1'),
('A204021', 'ปราการ', 'อุณจักร', '204', 't021', '1'),
('A356001', 'ศิริพร', 'โตลา', '356', 't356', '1'),
('B204001', 'สุทธิพงศ์', 'สุรักษ์', '204', 's001', '2'),
('B204002', 'ถนอม', 'กองใจ', '204', 's002', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ad_ID`),
  ADD KEY `admin_dept` (`dept_ID`),
  ADD KEY `admin_login` (`ad_email`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_ID`),
  ADD KEY `course_dpm` (`db_ID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_ID`),
  ADD KEY `faculty` (`fac_ID`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`comp_enroll`),
  ADD KEY `ec_ID` (`c_ID`),
  ADD KEY `es_ID` (`s_ID`);

--
-- Indexes for table `exam_time`
--
ALTER TABLE `exam_time`
  ADD PRIMARY KEY (`comp_exam`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`fac_ID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_ID`),
  ADD KEY `room_dept` (`dr_ID`);

--
-- Indexes for table `schduling_exam`
--
ALTER TABLE `schduling_exam`
  ADD PRIMARY KEY (`comp_examroom`),
  ADD KEY `exam_date` (`ex_date`),
  ADD KEY `exam_course` (`course_ID`),
  ADD KEY `exam_comp_schduling` (`comp_examschdule`);

--
-- Indexes for table `schduling_lec`
--
ALTER TABLE `schduling_lec`
  ADD PRIMARY KEY (`comp_schduling`),
  ADD KEY `lec_study_date` (`date`),
  ADD KEY `lecture_room` (`lec_room`) USING BTREE,
  ADD KEY `course_open` (`course_lecID`);

--
-- Indexes for table `slot_time`
--
ALTER TABLE `slot_time`
  ADD PRIMARY KEY (`comp_slot`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`std_ID`),
  ADD KEY `department` (`d_ID`),
  ADD KEY `teacher_advisor` (`t_ID`),
  ADD KEY `student_login` (`email`);

--
-- Indexes for table `teach`
--
ALTER TABLE `teach`
  ADD PRIMARY KEY (`comp_teach`),
  ADD KEY `teach_ID` (`t_ID`),
  ADD KEY `teach_course` (`course_ID`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`t_ID`),
  ADD KEY `teacher_dept` (`dt_ID`),
  ADD KEY `teacher_login` (`t_email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_dept` FOREIGN KEY (`dept_ID`) REFERENCES `department` (`dept_ID`),
  ADD CONSTRAINT `admin_login` FOREIGN KEY (`ad_email`) REFERENCES `login` (`username`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_dpm` FOREIGN KEY (`db_ID`) REFERENCES `department` (`dept_ID`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `faculty` FOREIGN KEY (`fac_ID`) REFERENCES `faculty` (`fac_ID`);

--
-- Constraints for table `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `ec_ID` FOREIGN KEY (`c_ID`) REFERENCES `course` (`course_ID`),
  ADD CONSTRAINT `es_ID` FOREIGN KEY (`s_ID`) REFERENCES `student` (`std_ID`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_dept` FOREIGN KEY (`dr_ID`) REFERENCES `department` (`dept_ID`);

--
-- Constraints for table `schduling_exam`
--
ALTER TABLE `schduling_exam`
  ADD CONSTRAINT `exam_comp_schduling` FOREIGN KEY (`comp_examschdule`) REFERENCES `schduling_lec` (`comp_schduling`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_course` FOREIGN KEY (`course_ID`) REFERENCES `course` (`course_ID`),
  ADD CONSTRAINT `exam_date` FOREIGN KEY (`ex_date`) REFERENCES `exam_time` (`comp_exam`);

--
-- Constraints for table `schduling_lec`
--
ALTER TABLE `schduling_lec`
  ADD CONSTRAINT `c_lecID` FOREIGN KEY (`course_lecID`) REFERENCES `course` (`course_ID`),
  ADD CONSTRAINT `lec_study_date` FOREIGN KEY (`date`) REFERENCES `slot_time` (`comp_slot`),
  ADD CONSTRAINT `lecture_room` FOREIGN KEY (`lec_room`) REFERENCES `room` (`room_ID`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `department` FOREIGN KEY (`d_ID`) REFERENCES `department` (`dept_ID`),
  ADD CONSTRAINT `student_login` FOREIGN KEY (`email`) REFERENCES `login` (`username`),
  ADD CONSTRAINT `teacher_advisor` FOREIGN KEY (`t_ID`) REFERENCES `teacher` (`t_ID`);

--
-- Constraints for table `teach`
--
ALTER TABLE `teach`
  ADD CONSTRAINT `teach_ID` FOREIGN KEY (`t_ID`) REFERENCES `teacher` (`t_ID`),
  ADD CONSTRAINT `teach_course` FOREIGN KEY (`course_ID`) REFERENCES `course` (`course_ID`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_dept` FOREIGN KEY (`dt_ID`) REFERENCES `department` (`dept_ID`),
  ADD CONSTRAINT `teacher_login` FOREIGN KEY (`t_email`) REFERENCES `login` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
