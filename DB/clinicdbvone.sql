-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2018 at 02:49 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinicdbvone`
--

-- --------------------------------------------------------

--
-- Table structure for table `cld_appointments`
--

CREATE TABLE `cld_appointments` (
  `appt_id` int(11) NOT NULL,
  `appt_patient_id` int(11) DEFAULT NULL,
  `appt_clinic_id` int(11) DEFAULT NULL,
  `appt_status` enum('confirmed','toconfirm','treated','skipped','cancelled') DEFAULT NULL,
  `appt_date` date DEFAULT NULL,
  `appt_start` time DEFAULT NULL,
  `appt_end` time DEFAULT NULL,
  `appt_cost` double DEFAULT NULL,
  `appt_comments` text,
  `appt_created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `appt_updated_at` timestamp NULL DEFAULT NULL,
  `appt_author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cld_appointments`
--

INSERT INTO `cld_appointments` (`appt_id`, `appt_patient_id`, `appt_clinic_id`, `appt_status`, `appt_date`, `appt_start`, `appt_end`, `appt_cost`, `appt_comments`, `appt_created_at`, `appt_updated_at`, `appt_author_id`) VALUES
(1, 2, 3, 'toconfirm', '2018-05-31', '18:00:00', '19:00:00', 20, 'To confirm this patient', '2018-05-31 22:47:43', '2018-05-31 22:47:43', NULL),
(2, 1, 4, 'treated', '2018-06-01', '15:00:00', '16:00:00', 105, 'To close - has treated', '2018-05-31 22:49:50', '2018-06-01 14:00:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cld_clinics`
--

CREATE TABLE `cld_clinics` (
  `clinic_id` int(11) NOT NULL,
  `clinic_title` varchar(255) DEFAULT NULL,
  `clinic_created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `clinic_updated_at` timestamp NULL DEFAULT NULL,
  `clinic_author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cld_clinics`
--

INSERT INTO `cld_clinics` (`clinic_id`, `clinic_title`, `clinic_created_at`, `clinic_updated_at`, `clinic_author_id`) VALUES
(1, 'Dentist', '2018-05-30 11:34:10', '2018-05-30 21:02:07', NULL),
(3, 'Optics', '2018-05-30 21:43:51', '2018-05-30 21:43:51', NULL),
(4, 'Surgery', '2018-05-30 21:45:33', '2018-05-30 21:45:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cld_migrations`
--

CREATE TABLE `cld_migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cld_migrations`
--

INSERT INTO `cld_migrations` (`version`) VALUES
(0);

-- --------------------------------------------------------

--
-- Table structure for table `cld_patients`
--

CREATE TABLE `cld_patients` (
  `patient_id` int(11) NOT NULL,
  `patient_key` varchar(16) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `patient_mobile` varchar(20) NOT NULL,
  `patient_gender` enum('male','female') NOT NULL DEFAULT 'male',
  `patient_created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `patient_updated_at` timestamp NULL DEFAULT NULL,
  `patient_author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cld_patients`
--

INSERT INTO `cld_patients` (`patient_id`, `patient_key`, `patient_name`, `patient_mobile`, `patient_gender`, `patient_created_at`, `patient_updated_at`, `patient_author_id`) VALUES
(1, '123456789zxcvbnm', 'Ahmed Ali2', '010123456789', 'male', '2018-05-31 22:01:44', '2018-06-01 14:00:11', NULL),
(2, '123456789zxcvbnn', 'Sara Taher', '0123654789', 'female', '2018-05-31 22:47:43', '2018-05-31 22:47:43', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cld_appointments`
--
ALTER TABLE `cld_appointments`
  ADD PRIMARY KEY (`appt_id`),
  ADD KEY `appt_clinic_id` (`appt_clinic_id`),
  ADD KEY `appt_patient_id` (`appt_patient_id`);

--
-- Indexes for table `cld_clinics`
--
ALTER TABLE `cld_clinics`
  ADD PRIMARY KEY (`clinic_id`),
  ADD KEY `clinic_title` (`clinic_title`);
ALTER TABLE `cld_clinics` ADD FULLTEXT KEY `clinic_title_2` (`clinic_title`);

--
-- Indexes for table `cld_patients`
--
ALTER TABLE `cld_patients`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `patient_key_3` (`patient_key`),
  ADD KEY `patient_key` (`patient_key`),
  ADD KEY `patient_key_2` (`patient_key`,`patient_name`,`patient_mobile`);
ALTER TABLE `cld_patients` ADD FULLTEXT KEY `patient_key_4` (`patient_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cld_appointments`
--
ALTER TABLE `cld_appointments`
  MODIFY `appt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cld_clinics`
--
ALTER TABLE `cld_clinics`
  MODIFY `clinic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cld_patients`
--
ALTER TABLE `cld_patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cld_appointments`
--
ALTER TABLE `cld_appointments`
  ADD CONSTRAINT `cld_appointments_ibfk_1` FOREIGN KEY (`appt_clinic_id`) REFERENCES `cld_clinics` (`clinic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cld_appointments_ibfk_2` FOREIGN KEY (`appt_patient_id`) REFERENCES `cld_patients` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
