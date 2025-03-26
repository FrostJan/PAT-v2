-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2025 at 01:32 PM
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
-- Database: `eventmanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `activitypurpose`
--

CREATE TABLE `activitypurpose` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activitypurpose`
--

INSERT INTO `activitypurpose` (`id`, `name`) VALUES
(1, 'Seminars'),
(3, 'Department Days'),
(4, 'Party'),
(5, 'Pageant'),
(6, 'Symposium'),
(7, 'Awarding/Recognition Ceremony'),
(9, 'CCS DAYS');

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `event_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `event_start_date` date DEFAULT NULL,
  `event_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`event_id`, `request_id`, `users_id`, `event_name`, `event_start_date`, `event_end_date`) VALUES
(4, 0, 5, 'test', '2024-03-08', '2024-03-09'),
(5, 0, 7, 'CAS', '2024-03-13', '2024-03-13'),
(10, 9, 0, 'SET', '2024-03-24', '2024-03-25'),
(12, 14, 0, 'asdasdasd', '2024-05-14', '2024-05-18'),
(13, 18, 42, 'wasalak', '2024-05-09', '2024-05-11'),
(14, 11, 42, 'College of Computer Studies', '2024-05-23', '2024-05-26'),
(15, 11, 42, 'College of Computer Studies', '2024-05-24', '2024-05-29'),
(17, 20, 42, 'College of Education', '2024-05-30', '2024-06-03'),
(19, 11, 42, 'College of Computer Studies', '2025-03-25', '2025-03-26'),
(20, 21, 42, 'College of Arts and Sciences', '2025-03-20', '2025-03-21');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `department` text NOT NULL,
  `activityorpurpose` text NOT NULL,
  `division` text NOT NULL,
  `numberofattendees` text NOT NULL,
  `datefilled` date NOT NULL,
  `timeneeded` text NOT NULL,
  `dateneeded` text NOT NULL,
  `pat` text NOT NULL,
  `emcroom` text NOT NULL,
  `tvroom` text NOT NULL,
  `institutional` text NOT NULL,
  `cocurricular` text NOT NULL,
  `curricular` text NOT NULL,
  `extracurricular` text NOT NULL,
  `outsidegroup` text NOT NULL,
  `personincharge` text NOT NULL,
  `contactnumber` text NOT NULL,
  `file` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `users_id`, `department`, `activityorpurpose`, `division`, `numberofattendees`, `datefilled`, `timeneeded`, `dateneeded`, `pat`, `emcroom`, `tvroom`, `institutional`, `cocurricular`, `curricular`, `extracurricular`, `outsidegroup`, `personincharge`, `contactnumber`, `file`, `status`) VALUES
(11, 42, 'College of Computer Studies', 'Seminars', 'Division', '3', '2024-05-23', '3pm - 8pm', '2024-04-26', 'yes', 'no', 'no', 'no', 'no', 'yes', 'no', 'yes', 'juan', '09123456789', 'Doc3 - Copy (8).pdf', 'Approved'),
(12, 42, 'College of Computer Studies', 'Pageant', 'dasdas', '45', '2024-05-30', '3pm - 8pm', '2024-06-01', 'no', 'no', 'no', 'no', 'no', 'yes', 'no', 'yes', 'Person in-charge:', '09123456789', '', 'Declined'),
(13, 0, '', 'Pageant', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', 'yes', '', '', '', ''),
(14, 0, '', 'Symposium', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(16, 0, '', 'Seminars', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Declined'),
(17, 0, '', 'Seminars', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Approved'),
(18, 42, 'College of Computer Studies', 'Party', 'Division', '4', '2024-05-25', '3pm - 6pm', '2024-05-30', 'no', 'yes', 'yes', 'yes', 'yes', 'no', 'yes', 'no', 'juan', '09123456789', 'Doc3 - Copy (6).pdf', ''),
(19, 40, 'College of Computer Studies', 'Awarding/Recognition Ceremony', 'asd', '33', '2024-06-01', '3pm - 4pm', '2024-05-31', 'yes', 'no', 'no', 'yes', 'no', 'no', 'no', 'yes', 'me', '1111111', 'Client.pdf', 'Approved'),
(20, 42, 'College of Education', 'Party', 'te', '34', '2024-06-01', '8pm - 9pm', '2024-05-31', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'yes', 'yes', 'bry', '09123456789', 'allpdf.pdf', 'Approved'),
(21, 42, 'College of Arts and Sciences', 'Seminars', 'Check 2', '123', '2025-03-25', '10 Am - 11AM', '2025-03-26', 'yes', 'no', 'no', 'yes', 'yes', 'no', 'no', 'no', 'Check 4', '942069629', 'render.png', 'Approved'),
(22, 42, 'College of Arts and Sciences', 'Seminars', 'Check 2', '123', '2025-03-26', '10 Am - 11AM', '2025-03-25', 'yes', 'no', 'no', 'yes', 'yes', 'no', 'no', 'no', 'Check 4', '942069629', '', ''),
(23, 42, 'College of Arts and Sciences', 'Department Days', 'Check 2', '123', '2025-03-26', '10 Am - 11AM', '2025-03-26', 'yes', 'no', 'no', 'yes', 'yes', 'no', 'no', 'no', 'Check 4', '942069629', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `img` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `passwordtxt` varchar(50) NOT NULL,
  `type` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `img`, `firstname`, `lastname`, `email`, `password`, `passwordtxt`, `type`) VALUES
(1, 'eJ8Dd_5c.jpg', 'Admin Messi', '', 'admin@gmail.com', '$2y$10$7k3Ea6WBZoxqSV7M8tvRG.d1Vmv1EMh0holQSTymz/FKElwFbN.Yu', 'admin', 0),
(40, 'MESSI.jpg', 'Department', 'Office', 'departmentoffice@gmail.com', '$2y$10$khiDSDfpqEOFWvJSBnvxyupGz8gL7uyhLkREoZCnmeMP7HY8uHHNO', '123', 1),
(42, '', 'Juan', 'Cruz', 'student@gmail.com', '$2y$10$hahhAjwrqkF1MPXX2kAS8Og1LsTWznC8o9Cz0dTERM.QintESwsSa', '123', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activitypurpose`
--
ALTER TABLE `activitypurpose`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
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
-- AUTO_INCREMENT for table `activitypurpose`
--
ALTER TABLE `activitypurpose`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
