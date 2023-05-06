-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2023 at 10:26 AM
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
-- Database: `fesdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_activation_codes`
--

CREATE TABLE `tb_activation_codes` (
  `activation_id` int(10) UNSIGNED NOT NULL,
  `activation_code` varchar(32) NOT NULL,
  `activation_type` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_activation_codes`
--

INSERT INTO `tb_activation_codes` (`activation_id`, `activation_code`, `activation_type`, `created_at`, `updated_at`) VALUES
(1, 'ABC123', 'faculty', '2023-04-23 05:49:46', '2023-04-30 11:13:26'),
(2, 'DEF456', 'admin', '2023-04-23 05:49:46', '2023-04-29 20:45:53');

-- --------------------------------------------------------

--
-- Table structure for table `tb_api_keys`
--

CREATE TABLE `tb_api_keys` (
  `api_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `api_name` varchar(255) NOT NULL,
  `key_value` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_api_keys`
--

INSERT INTO `tb_api_keys` (`api_id`, `user_id`, `api_name`, `key_value`, `created_at`, `updated_at`) VALUES
(1, 1, 'OpenAI API Key', 'testapikey', '2023-04-23 05:49:46', '2023-04-23 11:50:18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_categories`
--

CREATE TABLE `tb_categories` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `weight` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_categories`
--

INSERT INTO `tb_categories` (`category_id`, `category`, `weight`) VALUES
(37, 'Course Content and Delivery', 50),
(38, 'Instructor Approachability and Support', 25),
(39, 'Grading and Assessment', 15),
(40, 'Classroom Environment and Management', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tb_evaluations`
--

CREATE TABLE `tb_evaluations` (
  `evaluation_id` int(10) UNSIGNED NOT NULL,
  `faculty_name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `school_year` varchar(10) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `access_code` varchar(12) NOT NULL,
  `permit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_evaluations`
--

INSERT INTO `tb_evaluations` (`evaluation_id`, `faculty_name`, `subject`, `school_year`, `semester`, `access_code`, `permit`, `created_at`, `updated_at`) VALUES
(18, 'Jan Mak', 'Mathematics', '2022-2023', '2nd Semester', '6fbb5b24e3b9', 'IT2G,IT3A', '2023-05-05 14:17:15', '2023-05-06 06:58:38'),
(24, 'Mark Wan', 'History', '2022-2023', '2nd Semester', 'be81718af667', 'IT2R,IT3A', '2023-05-05 16:16:28', '2023-05-06 06:58:47'),
(25, 'Mark Zuckerberg', 'Data Structures', '2022-2023', '1st Semester', 'd4c376bbfbdb', 'IT2F,IT2G', '2023-05-06 07:51:29', '2023-05-06 07:51:29'),
(26, 'Jan Mak', 'English', '2022-2023', '1st Semester', '210eeed3fedd', 'IT2G,IT3A,IT2F', '2023-05-06 07:51:29', '2023-05-06 07:51:29'),
(27, 'John Doe', 'Science', '2022-2023', '2nd Semester', 'e04b80e14adc', 'IT2F,IT2G', '2023-05-06 08:19:42', '2023-05-06 08:19:42'),
(29, 'George Bill', 'Programming', '2022-2023', '2nd Semester', '861402067842', 'IT2H,IT2F', '2023-05-06 08:19:42', '2023-05-06 08:19:42');

-- --------------------------------------------------------

--
-- Table structure for table `tb_questions`
--

CREATE TABLE `tb_questions` (
  `question_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_questions`
--

INSERT INTO `tb_questions` (`question_id`, `category_id`, `question`) VALUES
(5, 37, 'Did the instructor clearly explain the course objectives and learning outcomes?\r\n'),
(6, 37, 'Was the instructor well-prepared for each class session?\r\n'),
(7, 37, 'Did the instructor provide engaging and challenging course content?'),
(8, 37, 'Did the instructor use effective instructional methods to enhance learning?'),
(9, 37, 'Did the instructor effectively communicate with students?'),
(10, 38, 'Was the instructor approachable and willing to assist students outside of class?\r\n'),
(11, 39, 'Was the grading and assessment of assignments fair and consistent?\r\n'),
(12, 38, 'Did the instructor provide helpful and timely feedback on assignments and assessments?'),
(13, 39, 'Were the assessments aligned with the course objectives and learning outcomes?\r\n'),
(14, 38, 'Did the instructor provide opportunities for students to ask questions and participate in class discussions?\r\n'),
(15, 38, 'Did the instructor provide adequate resources to support student learning?\r\n'),
(16, 39, 'Did the instructor provide clear criteria and rubrics for assignments and assessments?\r\n'),
(17, 39, 'Did the instructor return graded assignments in a timely manner?\r\n'),
(18, 39, 'Did the instructor offer opportunities for students to improve their grades?'),
(19, 38, 'Did the instructor show genuine concern for the academic success of their students?\r\n'),
(20, 40, 'Was the classroom environment conducive to learning?\r\n'),
(21, 40, 'Did the instructor manage classroom behavior effectively?\r\n'),
(22, 40, 'Was the instructor respectful of students and their opinions?\r\n'),
(23, 40, 'Did the instructor maintain a safe and inclusive classroom environment?\r\n'),
(24, 40, 'Was the instructor punctual and consistent with class attendance and communication?\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tb_reports`
--

CREATE TABLE `tb_reports` (
  `report_id` int(10) UNSIGNED NOT NULL,
  `evaluation_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `rating` decimal(3,2) NOT NULL,
  `comment` text DEFAULT NULL,
  `responses` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`responses`)),
  `sentiment` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_students`
--

CREATE TABLE `tb_students` (
  `student_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_students`
--

INSERT INTO `tb_students` (`student_id`, `email`, `firstname`, `lastname`, `section`) VALUES
(398, 'pangilinan.janreynald@ue.edu.ph', 'Jan Reynald', 'Pangilinan', 'IT2F'),
(400, 'janreynaldpangilinan@gmail.com', 'Reynald', 'Pangilinan', 'IT2H'),
(401, 'reeeee@gmail.com', 'Reeeee', 'Pangilinan', 'IT3S'),
(402, 'rest@gmail.com', 'Rest', 'Pangilinan', 'IT4H'),
(403, 'redpangilinan715@gmail.com', 'Red', 'Pangilinan', 'IT2G');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(11) UNSIGNED DEFAULT NULL,
  `user_type` enum('admin','faculty','student') NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`user_id`, `student_id`, `user_type`, `email`, `password`, `firstname`, `lastname`, `created_at`, `updated_at`) VALUES
(1, NULL, 'admin', 'admin@gmail.com', '$2y$10$2a6suV9Wa9TtmZJW6RAKjOVlFKybXxz.eARFqMCASyZket9HYP6Hi', 'ADMIN', 'MAIN', '2023-04-22 10:11:05', '2023-04-22 20:49:26'),
(5, NULL, 'student', 'test.email@gmail.com', '$2y$10$V1BlMdYvVuAHC4vr.yxV0O15oN9NuWMu5KVxvXoBVAUN7vFf3DXpu', 'EMAIL', 'TEST', '2023-04-22 20:25:56', '2023-04-22 20:25:56'),
(7, NULL, 'faculty', 'doe.john@spcc.edu.ph', '$2y$10$2Fx0yOCyP1hg7WOgBmXBaOunDmATdNNZFrFQdurTFNhUhd01SfaeS', 'JOHN', 'DOE', '2023-04-23 07:43:38', '2023-04-23 07:43:38'),
(11, NULL, 'faculty', 'new.prof@spcc.edu.ph', '$2y$10$ISp/ykXSE8IJiwqyrCzrL.7YS2vjafpZB6LAdsC3m7AzNrew0I5fm', 'PROF', 'NEW', '2023-04-30 11:09:52', '2023-04-30 11:09:52'),
(14, 398, 'student', 'pangilinan.janreynald@ue.edu.ph', '$2y$10$89CZ/RlTs7QKIH2q71AVrONbwcSvTwbspTs5rF4E3vsIA8I5nszku', 'Jan Reynald', 'Pangilinan', '2023-05-05 18:46:04', '2023-05-05 18:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `tb_verification`
--

CREATE TABLE `tb_verification` (
  `verification_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `verification_code` varchar(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_activation_codes`
--
ALTER TABLE `tb_activation_codes`
  ADD PRIMARY KEY (`activation_id`),
  ADD UNIQUE KEY `activation_code` (`activation_code`);

--
-- Indexes for table `tb_api_keys`
--
ALTER TABLE `tb_api_keys`
  ADD PRIMARY KEY (`api_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_categories`
--
ALTER TABLE `tb_categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category` (`category`);

--
-- Indexes for table `tb_evaluations`
--
ALTER TABLE `tb_evaluations`
  ADD PRIMARY KEY (`evaluation_id`),
  ADD UNIQUE KEY `access_code` (`access_code`);

--
-- Indexes for table `tb_questions`
--
ALTER TABLE `tb_questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `tb_questions_ibfk_1` (`category_id`);

--
-- Indexes for table `tb_reports`
--
ALTER TABLE `tb_reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `tb_reports_ibfk_1` (`evaluation_id`),
  ADD KEY `tb_reports_ibfk_2` (`student_id`);

--
-- Indexes for table `tb_students`
--
ALTER TABLE `tb_students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `tb_verification`
--
ALTER TABLE `tb_verification`
  ADD PRIMARY KEY (`verification_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_activation_codes`
--
ALTER TABLE `tb_activation_codes`
  MODIFY `activation_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_api_keys`
--
ALTER TABLE `tb_api_keys`
  MODIFY `api_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_categories`
--
ALTER TABLE `tb_categories`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tb_evaluations`
--
ALTER TABLE `tb_evaluations`
  MODIFY `evaluation_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_questions`
--
ALTER TABLE `tb_questions`
  MODIFY `question_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_reports`
--
ALTER TABLE `tb_reports`
  MODIFY `report_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tb_students`
--
ALTER TABLE `tb_students`
  MODIFY `student_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=404;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_verification`
--
ALTER TABLE `tb_verification`
  MODIFY `verification_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_api_keys`
--
ALTER TABLE `tb_api_keys`
  ADD CONSTRAINT `tb_api_keys_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`user_id`);

--
-- Constraints for table `tb_questions`
--
ALTER TABLE `tb_questions`
  ADD CONSTRAINT `tb_questions_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tb_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_reports`
--
ALTER TABLE `tb_reports`
  ADD CONSTRAINT `tb_reports_ibfk_1` FOREIGN KEY (`evaluation_id`) REFERENCES `tb_evaluations` (`evaluation_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_reports_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `tb_students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD CONSTRAINT `tb_users_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `tb_students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
