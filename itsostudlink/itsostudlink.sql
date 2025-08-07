-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2025 at 05:34 AM
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
-- Database: `itsostudlink`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'Jom', 'jom');

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `faculty_id` int(7) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `section` varchar(10) NOT NULL,
  `year_level` int(1) NOT NULL,
  `room` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `semester` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(7) NOT NULL,
  `facultynum` varchar(7) NOT NULL,
  `email` varchar(27) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `facultynum`, `email`, `contact`, `username`, `password`) VALUES
(1, '11', 'aidaelevera@gmail.com', '0968945784', 'Aida', '$2y$12$/Q6QJ/3hz9/mY4m7PJYYouv0G0I.u2UdAbF2iVbDRgim64HC'),
(2, '22', 'mikkocablao@gmial.com', '09558945048', 'Mikko', '$2y$12$JGg3meyuHesBBeHmwwjH6uerTmiUWI6h0ODBTRoYk3Wk4AQS'),
(3, '33', 'rojabulencia@gmail.com', '09054567392', 'Roger', '$2y$12$yTd60WEZTxmAlmb9v5n5o.fc4Bh44Rw/CqsLls2nqajpS4AX'),
(4, '44', 'archibal@gmail.com', '09097437282', 'Archie', '$2y$12$FiXdPzlBrlv8RQ8vDtuYQ.YAg57tn3CCkjeIKqKeA3G7bWGF'),
(5, '55', 'markanthony@gmail.com', '09093434333', 'Mark', '$2y$12$b0D9STcpEiwWjAguNqvNKuiC8dIWhcUSADuF5k.8ispZhasj'),
(6, '66', 'marygracejune@gmail.com', '09433422544', 'June', '$2y$12$ZS8REXGa1yqWq1XW5sjkU.XdndpFhAUsE1GY7QCBhlPipv4x'),
(9, '88', '1@gmail.com', '09558945048', 'Sunday', '$2y$12$rVOYmLmAzSsrOsnXe27CJuSBEheD/BmQWg0lmjpViX5M6EEv');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_schedule`
--

CREATE TABLE `faculty_schedule` (
  `id` int(11) NOT NULL,
  `faculty_id` int(7) NOT NULL,
  `class_id` int(11) NOT NULL,
  `room` varchar(50) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `student_id` int(7) NOT NULL,
  `class_id` int(11) NOT NULL,
  `midterm_grade` decimal(4,2) DEFAULT NULL,
  `finals_grade` decimal(4,2) DEFAULT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `student_id`, `class_id`, `midterm_grade`, `finals_grade`, `status`) VALUES
(8, 1, 14, 2.50, 3.00, 'Failed'),
(9, 1, 12, 2.50, 3.00, 'Failed'),
(10, 3, 12, 1.60, 1.50, 'Passed'),
(11, 3, 14, 1.90, 1.30, 'Passed'),
(12, 2, 14, 1.20, 1.70, 'Passed'),
(13, 2, 12, 1.40, 1.10, 'Passed');

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `id` int(11) NOT NULL,
  `school_year` varchar(9) NOT NULL,
  `semester` int(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`id`, `school_year`, `semester`, `is_active`) VALUES
(1, '2024-2025', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(7) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `studentnum` varchar(7) NOT NULL,
  `email` varchar(27) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `year_level` int(1) NOT NULL,
  `section` varchar(1) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `firstname`, `lastname`, `studentnum`, `email`, `contact`, `year_level`, `section`, `username`, `password`) VALUES
(1, 'Jomari', 'Terencio', '22-0216', 'j.terencio101@gmail.com', '09557945049', 4, 'A', 'Jom', '$2y$12$XaLs7OuEbyg8IVJTaa5u8uZMyhu2XRROZVcnrciYG6omBEpxWf8pC'),
(6, 'Reymark', 'Moral', '22-3245', 'moral@gmail.com', '09554939833', 4, 'A', 'Reymark', '$2y$12$VYGRMK9aa893stsQSjuTcegsj5QtdjdZww87D36c.Keg4gkHq5fz6');

-- --------------------------------------------------------

--
-- Table structure for table `student_schedule`
--

CREATE TABLE `student_schedule` (
  `id` int(11) NOT NULL,
  `student_id` int(7) NOT NULL,
  `class_id` int(11) NOT NULL,
  `room` varchar(50) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_code` varchar(20) NOT NULL,
  `subject_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_code`, `subject_name`) VALUES
(1, 'CS101', 'Introduction to Computer Science'),
(2, 'IT202', 'Database Management Systems'),
(3, 'WEBDEV', 'Web Development'),
(4, 'IT101', 'Computer Programming'),
(5, 'IT102', 'Computer Programming 2'),
(8, 'IT203', 'Advanced Database Management Systems'),
(9, 'COMP101', 'IT Elective'),
(10, 'IT301', 'CAPSTONE PROJECT'),
(11, 'IT302', 'Special Topics in IT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `section` (`section`),
  ADD KEY `classes_ibfk_3` (`school_year_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `facultynum` (`facultynum`);

--
-- Indexes for table `faculty_schedule`
--
ALTER TABLE `faculty_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `studentnum` (`studentnum`);

--
-- Indexes for table `student_schedule`
--
ALTER TABLE `student_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `faculty_schedule`
--
ALTER TABLE `faculty_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_schedule`
--
ALTER TABLE `student_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`id`),
  ADD CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `classes_ibfk_3` FOREIGN KEY (`school_year_id`) REFERENCES `school_year` (`id`);

--
-- Constraints for table `faculty_schedule`
--
ALTER TABLE `faculty_schedule`
  ADD CONSTRAINT `faculty_schedule_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`id`),
  ADD CONSTRAINT `faculty_schedule_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);

--
-- Constraints for table `student_schedule`
--
ALTER TABLE `student_schedule`
  ADD CONSTRAINT `student_schedule_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `student_schedule_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
