-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2023 at 06:01 PM
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
  `faculty_id` int(10) UNSIGNED NOT NULL,
  `school_year` varchar(10) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `access_code` varchar(12) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_evaluations`
--

INSERT INTO `tb_evaluations` (`evaluation_id`, `faculty_id`, `school_year`, `semester`, `access_code`, `created_at`, `updated_at`) VALUES
(7, 7, '2021-2022', '2nd Semester', '0a8e81b25142', '2023-04-23 18:49:51', '2023-04-26 16:35:19'),
(11, 7, '2022-2023', '2nd Semester', '871b9cfa5df4', '2023-04-29 17:25:10', '2023-04-29 17:25:10'),
(12, 10, '2022-2023', '2nd Semester', 'ee07e0c49e9b', '2023-04-29 17:25:42', '2023-04-29 17:25:42'),
(13, 11, '2022-2023', '2nd Semester', '23f3f159d6c7', '2023-04-30 11:10:57', '2023-04-30 11:10:57');

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
  `rating` float NOT NULL,
  `comment` text DEFAULT NULL,
  `responses` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`responses`)),
  `sentiment` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_reports`
--

INSERT INTO `tb_reports` (`report_id`, `evaluation_id`, `student_id`, `rating`, `comment`, `responses`, `sentiment`, `created_at`, `updated_at`) VALUES
(3, 7, 5, 3.69, 'N/A', '[{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor clearly explain the course objectives and learning outcomes?\\n\",\"answer\":\"4\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Was the instructor well-prepared for each class session?\\n\",\"answer\":\"3\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor provide engaging and challenging course content?\",\"answer\":\"3\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor use effective instructional methods to enhance learning?\",\"answer\":\"4\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor effectively communicate with students?\",\"answer\":\"3\",\"weight\":\"50\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Was the instructor approachable and willing to assist students outside of class?\\n\",\"answer\":\"5\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide helpful and timely feedback on assignments and assessments?\",\"answer\":\"5\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide opportunities for students to ask questions and participate in class discussions?\\n\",\"answer\":\"4\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide adequate resources to support student learning?\\n\",\"answer\":\"5\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor show genuine concern for the academic success of their students?\\n\",\"answer\":\"5\",\"weight\":\"25\"},{\"category\":\"Grading and Assessment\",\"question\":\"Was the grading and assessment of assignments fair and consistent?\\n\",\"answer\":\"3\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Were the assessments aligned with the course objectives and learning outcomes?\\n\",\"answer\":\"2\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor provide clear criteria and rubrics for assignments and assessments?\\n\",\"answer\":\"2\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor return graded assignments in a timely manner?\\n\",\"answer\":\"3\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor offer opportunities for students to improve their grades?\",\"answer\":\"1\",\"weight\":\"15\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the classroom environment conducive to learning?\\n\",\"answer\":\"5\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Did the instructor manage classroom behavior effectively?\\n\",\"answer\":\"4\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the instructor respectful of students and their opinions?\\n\",\"answer\":\"5\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Did the instructor maintain a safe and inclusive classroom environment?\\n\",\"answer\":\"5\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the instructor punctual and consistent with class attendance and communication?\\n\",\"answer\":\"4\",\"weight\":\"10\"}]', 'N/A', '2023-04-25 18:01:36', '2023-04-29 18:18:10'),
(13, 7, 4, 3.99, 'N/A', '[{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor clearly explain the course objectives and learning outcomes?\\n\",\"answer\":\"4\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Was the instructor well-prepared for each class session?\\n\",\"answer\":\"4\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor provide engaging and challenging course content?\",\"answer\":\"3\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor use effective instructional methods to enhance learning?\",\"answer\":\"3\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor effectively communicate with students?\",\"answer\":\"5\",\"weight\":\"50\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Was the instructor approachable and willing to assist students outside of class?\\n\",\"answer\":\"5\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide helpful and timely feedback on assignments and assessments?\",\"answer\":\"3\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide opportunities for students to ask questions and participate in class discussions?\\n\",\"answer\":\"5\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide adequate resources to support student learning?\\n\",\"answer\":\"3\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor show genuine concern for the academic success of their students?\\n\",\"answer\":\"5\",\"weight\":\"25\"},{\"category\":\"Grading and Assessment\",\"question\":\"Was the grading and assessment of assignments fair and consistent?\\n\",\"answer\":\"4\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Were the assessments aligned with the course objectives and learning outcomes?\\n\",\"answer\":\"4\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor provide clear criteria and rubrics for assignments and assessments?\\n\",\"answer\":\"4\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor return graded assignments in a timely manner?\\n\",\"answer\":\"5\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor offer opportunities for students to improve their grades?\",\"answer\":\"5\",\"weight\":\"15\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the classroom environment conducive to learning?\\n\",\"answer\":\"3\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Did the instructor manage classroom behavior effectively?\\n\",\"answer\":\"4\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the instructor respectful of students and their opinions?\\n\",\"answer\":\"3\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Did the instructor maintain a safe and inclusive classroom environment?\\n\",\"answer\":\"4\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the instructor punctual and consistent with class attendance and communication?\\n\",\"answer\":\"5\",\"weight\":\"10\"}]', 'N/A', '2023-04-25 18:58:51', '2023-04-29 18:18:04'),
(18, 11, 4, 4.69, 'He is really good! I like his way of teaching.', '[{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor clearly explain the course objectives and learning outcomes?\\n\",\"answer\":\"5\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Was the instructor well-prepared for each class session?\\n\",\"answer\":\"4\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor provide engaging and challenging course content?\",\"answer\":\"5\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor use effective instructional methods to enhance learning?\",\"answer\":\"5\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor effectively communicate with students?\",\"answer\":\"4\",\"weight\":\"50\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Was the instructor approachable and willing to assist students outside of class?\\n\",\"answer\":\"5\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide helpful and timely feedback on assignments and assessments?\",\"answer\":\"5\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide opportunities for students to ask questions and participate in class discussions?\\n\",\"answer\":\"5\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide adequate resources to support student learning?\\n\",\"answer\":\"4\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor show genuine concern for the academic success of their students?\\n\",\"answer\":\"5\",\"weight\":\"25\"},{\"category\":\"Grading and Assessment\",\"question\":\"Was the grading and assessment of assignments fair and consistent?\\n\",\"answer\":\"5\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Were the assessments aligned with the course objectives and learning outcomes?\\n\",\"answer\":\"5\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor provide clear criteria and rubrics for assignments and assessments?\\n\",\"answer\":\"4\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor return graded assignments in a timely manner?\\n\",\"answer\":\"4\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor offer opportunities for students to improve their grades?\",\"answer\":\"5\",\"weight\":\"15\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the classroom environment conducive to learning?\\n\",\"answer\":\"5\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Did the instructor manage classroom behavior effectively?\\n\",\"answer\":\"5\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the instructor respectful of students and their opinions?\\n\",\"answer\":\"5\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Did the instructor maintain a safe and inclusive classroom environment?\\n\",\"answer\":\"5\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the instructor punctual and consistent with class attendance and communication?\\n\",\"answer\":\"5\",\"weight\":\"10\"}]', 'Positive', '2023-04-29 17:30:13', '2023-04-29 17:30:13'),
(19, 12, 5, 4.9, 'Napakagaling magturo, grabe idol ko to.', '[{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor clearly explain the course objectives and learning outcomes?\\n\",\"answer\":\"5\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Was the instructor well-prepared for each class session?\\n\",\"answer\":\"5\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor provide engaging and challenging course content?\",\"answer\":\"5\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor use effective instructional methods to enhance learning?\",\"answer\":\"4\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor effectively communicate with students?\",\"answer\":\"5\",\"weight\":\"50\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Was the instructor approachable and willing to assist students outside of class?\\n\",\"answer\":\"5\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide helpful and timely feedback on assignments and assessments?\",\"answer\":\"5\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide opportunities for students to ask questions and participate in class discussions?\\n\",\"answer\":\"5\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide adequate resources to support student learning?\\n\",\"answer\":\"5\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor show genuine concern for the academic success of their students?\\n\",\"answer\":\"5\",\"weight\":\"25\"},{\"category\":\"Grading and Assessment\",\"question\":\"Was the grading and assessment of assignments fair and consistent?\\n\",\"answer\":\"5\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Were the assessments aligned with the course objectives and learning outcomes?\\n\",\"answer\":\"5\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor provide clear criteria and rubrics for assignments and assessments?\\n\",\"answer\":\"5\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor return graded assignments in a timely manner?\\n\",\"answer\":\"5\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor offer opportunities for students to improve their grades?\",\"answer\":\"5\",\"weight\":\"15\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the classroom environment conducive to learning?\\n\",\"answer\":\"5\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Did the instructor manage classroom behavior effectively?\\n\",\"answer\":\"5\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the instructor respectful of students and their opinions?\\n\",\"answer\":\"5\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Did the instructor maintain a safe and inclusive classroom environment?\\n\",\"answer\":\"5\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the instructor punctual and consistent with class attendance and communication?\\n\",\"answer\":\"5\",\"weight\":\"10\"}]', 'Positive', '2023-04-29 17:31:34', '2023-04-29 17:31:34'),
(39, 11, 5, 3.54, 'Ayoko dito, daming activity hindi naman nagtuturo.', '[{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor clearly explain the course objectives and learning outcomes?\\n\",\"answer\":\"4\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Was the instructor well-prepared for each class session?\\n\",\"answer\":\"4\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor provide engaging and challenging course content?\",\"answer\":\"3\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor use effective instructional methods to enhance learning?\",\"answer\":\"4\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor effectively communicate with students?\",\"answer\":\"4\",\"weight\":\"50\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Was the instructor approachable and willing to assist students outside of class?\\n\",\"answer\":\"3\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide helpful and timely feedback on assignments and assessments?\",\"answer\":\"3\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide opportunities for students to ask questions and participate in class discussions?\\n\",\"answer\":\"4\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide adequate resources to support student learning?\\n\",\"answer\":\"3\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor show genuine concern for the academic success of their students?\\n\",\"answer\":\"4\",\"weight\":\"25\"},{\"category\":\"Grading and Assessment\",\"question\":\"Was the grading and assessment of assignments fair and consistent?\\n\",\"answer\":\"3\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Were the assessments aligned with the course objectives and learning outcomes?\\n\",\"answer\":\"3\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor provide clear criteria and rubrics for assignments and assessments?\\n\",\"answer\":\"2\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor return graded assignments in a timely manner?\\n\",\"answer\":\"3\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor offer opportunities for students to improve their grades?\",\"answer\":\"4\",\"weight\":\"15\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the classroom environment conducive to learning?\\n\",\"answer\":\"4\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Did the instructor manage classroom behavior effectively?\\n\",\"answer\":\"4\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the instructor respectful of students and their opinions?\\n\",\"answer\":\"3\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Did the instructor maintain a safe and inclusive classroom environment?\\n\",\"answer\":\"2\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the instructor punctual and consistent with class attendance and communication?\\n\",\"answer\":\"4\",\"weight\":\"10\"}]', 'Negative', '2023-04-29 18:48:53', '2023-04-29 18:48:53'),
(41, 12, 4, 4.77, 'The best professor to ever grace this planet!', '[{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor clearly explain the course objectives and learning outcomes?\\n\",\"answer\":\"5\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Was the instructor well-prepared for each class session?\\n\",\"answer\":\"5\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor provide engaging and challenging course content?\",\"answer\":\"5\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor use effective instructional methods to enhance learning?\",\"answer\":\"5\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor effectively communicate with students?\",\"answer\":\"5\",\"weight\":\"50\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Was the instructor approachable and willing to assist students outside of class?\\n\",\"answer\":\"5\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide helpful and timely feedback on assignments and assessments?\",\"answer\":\"4\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide opportunities for students to ask questions and participate in class discussions?\\n\",\"answer\":\"4\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide adequate resources to support student learning?\\n\",\"answer\":\"5\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor show genuine concern for the academic success of their students?\\n\",\"answer\":\"4\",\"weight\":\"25\"},{\"category\":\"Grading and Assessment\",\"question\":\"Was the grading and assessment of assignments fair and consistent?\\n\",\"answer\":\"5\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Were the assessments aligned with the course objectives and learning outcomes?\\n\",\"answer\":\"4\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor provide clear criteria and rubrics for assignments and assessments?\\n\",\"answer\":\"5\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor return graded assignments in a timely manner?\\n\",\"answer\":\"5\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor offer opportunities for students to improve their grades?\",\"answer\":\"4\",\"weight\":\"15\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the classroom environment conducive to learning?\\n\",\"answer\":\"5\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Did the instructor manage classroom behavior effectively?\\n\",\"answer\":\"5\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the instructor respectful of students and their opinions?\\n\",\"answer\":\"5\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Did the instructor maintain a safe and inclusive classroom environment?\\n\",\"answer\":\"4\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the instructor punctual and consistent with class attendance and communication?\\n\",\"answer\":\"5\",\"weight\":\"10\"}]', 'Positive', '2023-04-30 11:05:38', '2023-04-30 11:05:38'),
(42, 13, 4, 4.19, 'Pretty good professor. He is so chill.', '[{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor clearly explain the course objectives and learning outcomes?\\n\",\"answer\":\"5\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Was the instructor well-prepared for each class session?\\n\",\"answer\":\"4\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor provide engaging and challenging course content?\",\"answer\":\"4\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor use effective instructional methods to enhance learning?\",\"answer\":\"3\",\"weight\":\"50\"},{\"category\":\"Course Content and Delivery\",\"question\":\"Did the instructor effectively communicate with students?\",\"answer\":\"5\",\"weight\":\"50\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Was the instructor approachable and willing to assist students outside of class?\\n\",\"answer\":\"4\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide helpful and timely feedback on assignments and assessments?\",\"answer\":\"4\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide opportunities for students to ask questions and participate in class discussions?\\n\",\"answer\":\"3\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor provide adequate resources to support student learning?\\n\",\"answer\":\"4\",\"weight\":\"25\"},{\"category\":\"Instructor Approachability and Support\",\"question\":\"Did the instructor show genuine concern for the academic success of their students?\\n\",\"answer\":\"5\",\"weight\":\"25\"},{\"category\":\"Grading and Assessment\",\"question\":\"Was the grading and assessment of assignments fair and consistent?\\n\",\"answer\":\"5\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Were the assessments aligned with the course objectives and learning outcomes?\\n\",\"answer\":\"5\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor provide clear criteria and rubrics for assignments and assessments?\\n\",\"answer\":\"4\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor return graded assignments in a timely manner?\\n\",\"answer\":\"4\",\"weight\":\"15\"},{\"category\":\"Grading and Assessment\",\"question\":\"Did the instructor offer opportunities for students to improve their grades?\",\"answer\":\"5\",\"weight\":\"15\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the classroom environment conducive to learning?\\n\",\"answer\":\"4\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Did the instructor manage classroom behavior effectively?\\n\",\"answer\":\"3\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the instructor respectful of students and their opinions?\\n\",\"answer\":\"4\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Did the instructor maintain a safe and inclusive classroom environment?\\n\",\"answer\":\"4\",\"weight\":\"10\"},{\"category\":\"Classroom Environment and Management\",\"question\":\"Was the instructor punctual and consistent with class attendance and communication?\\n\",\"answer\":\"5\",\"weight\":\"10\"}]', 'Positive', '2023-04-30 11:11:46', '2023-04-30 11:11:46');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
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

INSERT INTO `tb_users` (`user_id`, `user_type`, `email`, `password`, `firstname`, `lastname`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$2a6suV9Wa9TtmZJW6RAKjOVlFKybXxz.eARFqMCASyZket9HYP6Hi', 'ADMIN', 'MAIN', '2023-04-22 10:11:05', '2023-04-22 20:49:26'),
(4, 'student', 'pangilinan.janreynald@ue.edu.ph', '$2y$10$X2mVerh2zW1F8btgsv2WROCK5ZEQABhugK1TNgBHGlOloA7q.wR1y', 'JANREYNALD', 'PANGILINAN', '2023-04-22 20:16:25', '2023-04-22 20:16:25'),
(5, 'student', 'test.email@gmail.com', '$2y$10$V1BlMdYvVuAHC4vr.yxV0O15oN9NuWMu5KVxvXoBVAUN7vFf3DXpu', 'EMAIL', 'TEST', '2023-04-22 20:25:56', '2023-04-22 20:25:56'),
(7, 'faculty', 'doe.john@spcc.edu.ph', '$2y$10$2Fx0yOCyP1hg7WOgBmXBaOunDmATdNNZFrFQdurTFNhUhd01SfaeS', 'JOHN', 'DOE', '2023-04-23 07:43:38', '2023-04-23 07:43:38'),
(10, 'faculty', 'redpangilinan715@gmail.com', '$2y$10$GlzEg/elCykjUBl6VeV7retWQJZU14y1DpBLG/j.8MLxAi2lmjuTq', '', 'REDPANGILINAN715', '2023-04-24 13:35:37', '2023-04-24 13:35:37'),
(11, 'faculty', 'new.prof@spcc.edu.ph', '$2y$10$ISp/ykXSE8IJiwqyrCzrL.7YS2vjafpZB6LAdsC3m7AzNrew0I5fm', 'PROF', 'NEW', '2023-04-30 11:09:52', '2023-04-30 11:09:52');

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
  ADD UNIQUE KEY `access_code` (`access_code`),
  ADD KEY `faculty_id` (`faculty_id`);

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
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

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
  MODIFY `evaluation_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_questions`
--
ALTER TABLE `tb_questions`
  MODIFY `question_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_reports`
--
ALTER TABLE `tb_reports`
  MODIFY `report_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_verification`
--
ALTER TABLE `tb_verification`
  MODIFY `verification_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_api_keys`
--
ALTER TABLE `tb_api_keys`
  ADD CONSTRAINT `tb_api_keys_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`user_id`);

--
-- Constraints for table `tb_evaluations`
--
ALTER TABLE `tb_evaluations`
  ADD CONSTRAINT `tb_evaluations_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `tb_users` (`user_id`);

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
  ADD CONSTRAINT `tb_reports_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `tb_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
