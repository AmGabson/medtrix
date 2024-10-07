-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 07, 2024 at 01:38 PM
-- Server version: 10.5.26-MariaDB
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medtrix`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `token` int(11) NOT NULL,
  `deposit` int(11) NOT NULL,
  `VAT` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `userid`, `token`, `deposit`, `VAT`) VALUES
(2, 1, 2502, 15400, '1'),
(3, 2, 0, 4900, '1'),
(5, 5, 2, 0, '1'),
(6, 6, 0, 0, '1'),
(7, 7, 0, 0, '1'),
(8, 8, 0, 0, '1'),
(9, 9, 0, 0, '1'),
(10, 10, 0, 0, '1'),
(11, 11, 0, 0, '1'),
(12, 12, 0, 0, '1'),
(13, 13, 0, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `browser` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `os` varchar(100) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `sessionString` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `userid`, `browser`, `ip`, `os`, `dateTime`, `sessionString`, `icon`) VALUES
(102, 1, 'Google Chrome', '::1', 'Mac OS X 10.15.7', '2024-09-27 13:04:50', 'YJTSkOFjZbWAD0qQIvs4', 'ni-b-chrome'),
(103, 1, 'Google Chrome', '127.0.0.1', 'Mac OS X 10.15.7', '2024-10-01 12:23:30', '0', 'ni-b-chrome'),
(104, 1, 'Google Chrome', '::1', 'Mac OS X 10.15.7', '2024-10-05 00:56:38', 'KQIhVoCUbnr1qf34vXds1', 'ni-b-chrome'),
(105, 2, 'Google Chrome', '172.20.10.2', 'Windows 10.0', '2024-10-05 09:17:54', '0', 'ni-b-chrome'),
(106, 1, 'Google Chrome', '::1', 'Mac OS X 10.15.7', '2024-10-06 16:19:43', 'xk025Nj7T3dYyuGiab4S1', 'ni-b-chrome'),
(107, 1, 'Google Chrome', '::1', 'Mac OS X 10.15.7', '2024-10-06 17:02:55', 'k3mzpswo7SMBuQljicqA', 'ni-b-chrome'),
(109, 1, 'Google Chrome', '105.112.109.156', 'Mac OS X 10.15.7', '2024-10-06 18:04:09', 'W8vnfgLaQCb6DtKYZFH71', 'ni-b-chrome'),
(110, 5, 'Google Chrome', '197.210.76.249', 'Linux ', '2024-10-06 18:19:13', '0', 'ni-b-chrome'),
(111, 5, 'Google Chrome', '197.210.76.249', 'Windows 10.0', '2024-10-06 18:39:44', 'eOvPQT0IJAar2wBU3C9q', 'ni-b-chrome'),
(112, 6, 'Google Chrome', '102.91.102.156', 'Linux ', '2024-10-06 18:41:50', '0', 'ni-b-chrome'),
(113, 6, 'Google Chrome', '102.91.102.156', 'Linux ', '2024-10-06 18:42:01', 'azciy58LqIxuGnCPERbd6', 'ni-b-chrome'),
(114, 1, 'Apple Safari', '105.112.222.238', 'Mac OS X ', '2024-10-06 22:02:52', 'UTrGPzqFXusA1JRQ5Imi1', 'ni-b-safari'),
(115, 1, 'Google Chrome', '105.112.222.238', 'Mac OS X 10.15.7', '2024-10-06 22:06:56', 'dZxo6wH2fGWDzip8N1SA', 'ni-b-chrome'),
(116, 1, 'Google Chrome', '105.112.222.238', 'Mac OS X 10.15.7', '2024-10-06 22:11:04', 'dTLJiZR4AB5E7ewapGhg', 'ni-b-chrome'),
(117, 1, 'Google Chrome', '105.112.222.238', 'Mac OS X 10.15.7', '2024-10-06 22:12:16', 'L5ey2b670JzGt14qiRQU', 'ni-b-chrome'),
(118, 7, 'Google Chrome', '102.91.92.210', 'Windows 10.0', '2024-10-06 22:17:41', '0', 'ni-b-chrome'),
(119, 1, 'Google Chrome', '105.112.222.238', 'Mac OS X 10.15.7', '2024-10-06 22:18:59', 'ObeUqNcLJt0u98HBz7G6', 'ni-b-chrome'),
(120, 1, 'Google Chrome', '105.112.222.238', 'Mac OS X 10.15.7', '2024-10-06 22:19:33', '2ak9yTmBexWCdPERDIOq', 'ni-b-chrome'),
(121, 7, 'Google Chrome', '102.91.92.210', 'Windows 10.0', '2024-10-06 22:19:47', 'Tl6vO3HIFb71ieNKmj9s7', 'ni-b-chrome'),
(122, 1, 'Google Chrome', '105.112.222.238', 'Mac OS X 10.15.7', '2024-10-06 22:20:33', 'SlykUd8b7esgn2FCx6WO', 'ni-b-chrome'),
(123, 8, 'Apple Safari', '102.89.46.69', 'Mac OS X ', '2024-10-06 22:21:09', '0', 'ni-b-safari'),
(124, 9, 'Google Chrome', '102.91.102.193', 'Linux ', '2024-10-06 22:23:45', '0', 'ni-b-chrome'),
(125, 9, 'Google Chrome', '102.91.102.193', 'Linux ', '2024-10-06 22:24:37', 'KjzbmvkU0APITBaSYrt39', 'ni-b-chrome'),
(126, 8, 'Apple Safari', '102.89.46.69', 'Mac OS X ', '2024-10-06 22:26:00', 'EgUTy91jaYNPIzxOZAeu8', 'ni-b-safari'),
(127, 8, 'Apple Safari', '102.88.68.29', 'Mac OS X ', '2024-10-06 22:33:42', 'cphnHOCkfEIlr8vFG7x9', 'ni-b-safari'),
(128, 10, 'Google Chrome', '169.239.17.166', 'Linux ', '2024-10-07 08:37:57', '0', 'ni-b-chrome'),
(129, 10, 'Google Chrome', '169.239.17.166', 'Linux ', '2024-10-07 08:38:35', '6BVx5G4wbvMun2l1LgkW10', 'ni-b-chrome'),
(130, 11, 'Google Chrome', '102.91.4.214', 'Linux ', '2024-10-07 09:23:02', '0', 'ni-b-chrome'),
(131, 11, 'Google Chrome', '102.91.4.214', 'Linux ', '2024-10-07 09:26:30', 'vkcsR6JeL5Gi73ZNrFBf11', 'ni-b-chrome'),
(132, 12, 'Google Chrome', '102.91.93.108', 'Linux ', '2024-10-07 10:12:51', '0', 'ni-b-chrome'),
(133, 13, 'Google Chrome', '197.211.61.19', 'Linux ', '2024-10-07 10:34:06', '0', 'ni-b-chrome'),
(134, 13, 'Google Chrome', '197.211.61.19', 'Linux ', '2024-10-07 10:35:58', 'bjiRZltTaYc7dJhV4qM613', 'ni-b-chrome');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `category` varchar(200) NOT NULL,
  `icon` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `category`, `icon`) VALUES
(1, 'Infectious Diseases', ''),
(2, 'Waterborne Diseases', ''),
(3, 'Respiratory Conditions', ''),
(4, 'Chronic Conditions', ''),
(5, 'Genetic Disorders', '');

-- --------------------------------------------------------

--
-- Table structure for table `consultations`
--

CREATE TABLE `consultations` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `consultId` int(11) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `contactFrom` varchar(200) NOT NULL,
  `preferredDate` varchar(100) NOT NULL,
  `preferredTime` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `patientDesc` text NOT NULL,
  `ref` varchar(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `signature` varchar(200) DEFAULT NULL,
  `signDate` varchar(200) DEFAULT NULL,
  `payMethod` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultations`
--

INSERT INTO `consultations` (`id`, `userid`, `consultId`, `sex`, `contactFrom`, `preferredDate`, `preferredTime`, `status`, `patientDesc`, `ref`, `created`, `signature`, `signDate`, `payMethod`) VALUES
(294, 1, 1, 'male', 'Adamawa', '09/19/2024', '12:30 AM', 'pending', 'Paying for medical bills to enable me sort some cruscial issuesPaying for medical bills to enable me sort some cruscial issuesPaying for medical bills to enable me sort some cruscial issuesPaying for medical bills to enable me sort some cruscial issues', 'TXN-HT2X1J1', '2024-10-06 23:24:51', NULL, NULL, NULL),
(295, 1, 1, 'male', 'Anambra', '09/19/2024', '12:00 AM', 'approved', 'Paying for medical bills to enable me sort some cruscial issuesPaying for medical bills to enable me sort some cruscial issuesPaying for medical bills to enable me sort some cruscial issues', 'TXN-5KFIY01', '2024-10-06 23:25:44', '42aYgeqeB2NEgujyjAc73sui5eZHTDYgsZ4oHoMg8yj8iKQekfE46b24MtjX1Pnsogu9wWwfJxmzgeWbvHGHAWPHRjJzTNDQoxYdfP8H4LuzrpKoDL9wDL6JSzTZbGPmThTxPmQU8oVc1pcn6MEnBTCsNSoEDscuufzenc25gfip', '2024-10-06 23:26:40', 'solana');

-- --------------------------------------------------------

--
-- Table structure for table `consultationType`
--

CREATE TABLE `consultationType` (
  `consultId` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `subText` varchar(200) NOT NULL,
  `desc` text NOT NULL,
  `icon` varchar(200) NOT NULL,
  `bg` varchar(200) NOT NULL,
  `nairaPrice` varchar(200) NOT NULL,
  `nairaPercent` varchar(200) NOT NULL,
  `solPrice` varchar(200) NOT NULL,
  `solPercent` varchar(200) NOT NULL,
  `timing` varchar(200) NOT NULL,
  `tokenPrice` varchar(100) NOT NULL,
  `fee` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultationType`
--

INSERT INTO `consultationType` (`consultId`, `type`, `subText`, `desc`, `icon`, `bg`, `nairaPrice`, `nairaPercent`, `solPrice`, `solPercent`, `timing`, `tokenPrice`, `fee`) VALUES
(1, 'video', 'Book for a video Consultation', 'Speak on live video with a Medical Specialists waiting to solve your health related problems. Book video appointment now.', 'ni-video', 'bg-danger', '4300', '-10', '0.02', '-50', '15 Minutes', '1500', NULL),
(2, 'call', 'Talk with a Specialist via Mobile Call', 'You can engage in a live call consultation with a healthcare professional which could last for over 20 minutes and more.', 'ni-call-alt', 'bg-secondary', '2300', '-25', '0.01', '-50', '15 Minutes', '1000', '800'),
(3, 'text', 'Communicate with Specialist via Chat System', 'There is a provision to communicate to healthcare specialist via an online chat system. Use this option today, cheaper and faster.', 'ni-chat-circle', 'bg-warning', '1500', '-30', '0.008', '-50', '20 Minutes', '900', '500'),
(4, 'physical', 'One-on-one Consultation Service', 'Get to meet a doctor or a specialist one-on-one at a scheduled time of preference\r\n', 'ni-users', 'bg-primary', '9800', '-30', '0.2', '-50', '1hr 30 Minutes', '5000', '1500');

-- --------------------------------------------------------

--
-- Table structure for table `control`
--

CREATE TABLE `control` (
  `id` int(11) NOT NULL,
  `solanaQR` varchar(200) DEFAULT NULL,
  `adminWallet` varchar(200) DEFAULT NULL,
  `refBonus` varchar(100) DEFAULT NULL,
  `minWith` varchar(100) DEFAULT NULL,
  `maxWith` varchar(100) DEFAULT NULL,
  `accessCode` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `control`
--

INSERT INTO `control` (`id`, `solanaQR`, `adminWallet`, `refBonus`, `minWith`, `maxWith`, `accessCode`) VALUES
(1, 'solana.png', '9HvPQrAs6yXrdiqSSwbuix8bqXUtCtJWpKFdAxEKjeDy', '3', '50', '100000', '$2y$10$6e/eNDZPAmnwTcaE870Bv.TnUh9AiZSfIGxiMWZ2yZQ2nuX0frHzu');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `hospital` varchar(200) NOT NULL,
  `qualification` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `profession` varchar(200) NOT NULL,
  `bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `cat_id`, `image`, `title`, `fname`, `lname`, `hospital`, `qualification`, `location`, `profession`, `bio`) VALUES
(9, 4, 'doc.png', 'Dr.', 'Emmanuel', 'John', 'Olives Hospital', 'MBBS', 'ABUJA', 'Orthopedic Surgeon', 'Hi, I am pleased to welcome you on board. Please feel free to reach me for any consultation service.'),
(10, 2, 'esth.jpg', 'D.O', 'Esther', 'Simon', 'Specialist Hospital', 'D.O', 'LAFIA', 'Pathologist', 'Hi, I am pleased to welcome you on board. Please feel free to reach me for any consultation service.'),
(11, 3, 'peter.jpg', 'Dr.', 'Peter', 'Ebubechukwu', 'Sky City Hospital', 'MBBS', 'LAGOS', 'Cardiologist', 'Hi, I am pleased to welcome you on board. Please feel free to reach me for any consultation service.'),
(12, 5, 'isa.png', 'Dr.', 'Isa', 'Mohammed', 'Specialist Hospital', 'M.D', 'LAFIA', 'Psychiatric', 'Hi, I am pleased to welcome you on board. Please feel free to reach me for any consultation service.'),
(13, 1, 'blessing.jpg', 'M.O', 'Blessing', 'Israel', 'Olives Clinic', 'M.O', 'ABUJA', 'Pediatrician', 'Hi, I am pleased to welcome you on board. Please feel free to reach me for any consultation service.'),
(14, 3, 'samson.jpg', 'Dr.', 'Samson', 'Gregory', 'Mayo Clinic', 'MBBBS', 'ABUJA', 'Gastroenterologist', 'Hi, I am pleased to welcome you on board. Please feel free to reach me for any consultation service.'),
(15, 5, 'james.jpg', 'M.O', 'James', 'Anthony', 'Sky City Clinic', 'M.O', 'ABUJA', 'Therapist', 'Hi, I am pleased to welcome you on board. Please feel free to reach me for any consultation service.'),
(16, 4, 'mather.png', 'Dr.', 'Marther', 'Abims', 'Mayo Clinic', 'MBBS', 'LAGOS', 'Cardiothoracic Surgeon', 'Hi, I am pleased to welcome you on board. Please feel free to reach me for any consultation service.'),
(17, 1, 'paul.jpg', 'M.D', 'Paul', 'Kingsley', 'Specialist Hospital', 'M.D', 'LAFIA', 'Internal Medicine', 'Hi, I am pleased to welcome you on board. Please feel free to reach me for any consultation service.');

-- --------------------------------------------------------

--
-- Table structure for table `doc_category`
--

CREATE TABLE `doc_category` (
  `cat_id` int(11) NOT NULL,
  `category` varchar(200) NOT NULL,
  `desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doc_category`
--

INSERT INTO `doc_category` (`cat_id`, `category`, `desc`) VALUES
(1, 'Primary Care Physicians', 'Echocardiogram, Chest tube placement, Right heart catheterization, Pleurodesis, Bronchoscopy, Endobronchial ultrasound biopsy, Central venous catheterization, Right heart catheterization with exercise, Endotracheal intubation, Interstitial lung disease, Sarcoidosis, Connective tissue disease-associated ILD'),
(2, 'Diagnostic Specialists', 'Echocardiogram, Chest tube placement, Right heart catheterization, Pleurodesis, Bronchoscopy, Endobronchial ultrasound biopsy, Central venous catheterization, Right heart catheterization with exercise, Endotracheal intubation, Interstitial lung disease, Sarcoidosis, Connective tissue disease-associated ILD'),
(3, 'Medical Specialist', 'Echocardiogram, Chest tube placement, Right heart catheterization, Pleurodesis, Bronchoscopy, Endobronchial ultrasound biopsy, Central venous catheterization, Right heart catheterization with exercise, Endotracheal intubation, Interstitial lung disease, Sarcoidosis, Connective tissue disease-associated ILD'),
(4, 'Surgical Specialist', 'Echocardiogram, Chest tube placement, Right heart catheterization, Pleurodesis, Bronchoscopy, Endobronchial ultrasound biopsy, Central venous catheterization, Right heart catheterization with exercise, Endotracheal intubation, Interstitial lung disease, Sarcoidosis, Connective tissue disease-associated ILD'),
(5, 'Mental Health Profs', 'Echocardiogram, Chest tube placement, Right heart catheterization, Pleurodesis, Bronchoscopy, Endobronchial ultrasound biopsy, Central venous catheterization, Right heart catheterization with exercise, Endotracheal intubation, Interstitial lung disease, Sarcoidosis, Connective tissue disease-associated ILD');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `gameId` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `desc` varchar(200) NOT NULL,
  `folderName` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`gameId`, `title`, `image`, `desc`, `folderName`) VALUES
(1, 'Memory Game', 'memory-card.png', 'Card Flips Games', 'MemoryCards'),
(2, 'Quiz Games', 'quiz.png', 'Health Questions & More', 'QuizApplication'),
(3, 'Hang Man', 'hangman.png', 'Hang Man Game', ''),
(4, 'Word Scramble', 'ws.png', 'Word Scramble Game', '');

-- --------------------------------------------------------

--
-- Table structure for table `leaderboard`
--

CREATE TABLE `leaderboard` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `gameId` int(11) NOT NULL,
  `trials` varchar(200) DEFAULT NULL,
  `timeFrame` varchar(200) DEFAULT NULL,
  `gameLevel` varchar(200) DEFAULT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaderboard`
--

INSERT INTO `leaderboard` (`id`, `userid`, `gameId`, `trials`, `timeFrame`, `gameLevel`, `dateTime`) VALUES
(1, 1, 1, '24', '21', '1', '2024-10-05 01:37:50'),
(2, 5, 1, '32', '34', '2', '2024-10-06 18:21:23'),
(3, 2, 1, '45', '45', '3', '2024-09-01 20:25:43');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `id` int(11) NOT NULL,
  `locked` varchar(200) DEFAULT NULL,
  `text` varchar(2000) DEFAULT NULL,
  `passCode` varchar(200) DEFAULT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`id`, `locked`, `text`, `passCode`, `dateTime`) VALUES
(11, 'unlocked', 'Due to some unforeseen circumstances, this platform is under maintenance, pending on when all setups are done. Please do bear with us.', 'trader@2939', '2022-05-22 17:26:51');

-- --------------------------------------------------------

--
-- Table structure for table `medical_lists`
--

CREATE TABLE `medical_lists` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `subtitle` varchar(200) NOT NULL,
  `desc` text NOT NULL,
  `color` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `verified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_lists`
--

INSERT INTO `medical_lists` (`id`, `cat_id`, `title`, `subtitle`, `desc`, `color`, `image`, `verified`) VALUES
(1, 1, 'Paracetamol', 'Pains, Aches, Fever', '96 Tabs. Tested, Trusted and Dependable', 'bg-gradient-techniques', 'paracetamol.png', 1),
(2, 1, 'Ampiclox', 'Antibiotics, Blood', 'Ampiclox - 500', 'bg-gradient-languages', 'ampiclox.png', 1),
(16, 1, 'Panadol', 'Pains, Aches, Fever', '96 Tabs. Tested, Trusted and Dependable', 'bg-gradient-techniques', 'panadol.png', 1),
(17, 1, 'Acetic Acid', 'Infections, Antibiotic', 'Antimicrobial agent', 'bg-gradient-languages', 'acetic.png', 1),
(18, 1, 'Flagyl', 'Antibiotics, Disease ', '500mg - 10 film coated Tabs', 'bg-gradient-techniques', 'flagyl.JPG', 1),
(19, 1, 'Actified', 'Cold, Blocked nose', '1x12 Tabs - 2.5mg HCL', 'bg-gradient-languages', 'actified.jpg', 1),
(20, 1, 'Cold Time', 'cold, cough, Fever', '96 Tabs. Tested, Trusted and Dependable', 'bg-gradient-techniques', 'coldTime.AVIF', 1),
(21, 1, 'Bilaxten Bilastine', 'Sneezing, runny nose, eyes', '200mg Tablets', 'bg-gradient-languages', 'bilastine.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `med_category`
--

CREATE TABLE `med_category` (
  `cat_id` int(11) NOT NULL,
  `category` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `med_category`
--

INSERT INTO `med_category` (`cat_id`, `category`) VALUES
(1, 'Medicines'),
(2, 'Surgical Instruments'),
(3, 'Vacines'),
(4, 'Supplements'),
(5, 'Vitamins'),
(6, 'Traditionals');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `status` varchar(200) NOT NULL,
  `color` varchar(10) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `type` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `userid`, `title`, `status`, `color`, `icon`, `dateTime`, `type`) VALUES
(148, 1, 'Hello Sir, this is AUGUSTINE GABRIEL. from your site', 'read', NULL, NULL, '2024-04-22 13:55:03', 'chat'),
(149, 1, 'Admin: Welcome ', 'unread', 'info', 'ni-chat', '2024-04-22 14:03:46', 'received'),
(181, 1, 'Your password was changed!', 'unread', 'danger', 'ni-qr', '2024-09-20 00:38:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `preference`
--

CREATE TABLE `preference` (
  `id` int(11) NOT NULL,
  `timezone` varchar(200) DEFAULT NULL,
  `timezoneLabel` varchar(100) DEFAULT NULL,
  `language` varchar(200) DEFAULT NULL,
  `dateFormat` varchar(200) DEFAULT NULL,
  `region` varchar(200) DEFAULT NULL,
  `displayName` varchar(11) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `saveActivity` varchar(10) DEFAULT NULL,
  `skin` varchar(100) DEFAULT NULL,
  `headerFixed` varchar(100) DEFAULT NULL,
  `uiDesign` varchar(100) DEFAULT NULL,
  `headerBg` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `preference`
--

INSERT INTO `preference` (`id`, `timezone`, `timezoneLabel`, `language`, `dateFormat`, `region`, `displayName`, `userid`, `saveActivity`, `skin`, `headerFixed`, `uiDesign`, `headerBg`) VALUES
(1, 'Africa/Lagos', 'Lagos (GMT+01:00)', 'English', 'dd/mm/yy', 'Nigeria', 'username', 1, 'yes', 'light-mode', NULL, 'ui-bordered', NULL),
(2, 'Europe/Berlin', '(GMT +2:00)', 'English', 'dd/mm/yy', 'Nigeria', 'fullName', 2, 'yes', NULL, NULL, NULL, NULL),
(4, 'UTC', '(GMT +0:00)', 'English', 'dd/mm/yy', 'Nigeria', 'fullName', 5, 'yes', NULL, NULL, NULL, NULL),
(5, 'UTC', '(GMT +0:00)', 'English', 'dd/mm/yy', 'Nigeria', 'fullName', 6, 'yes', NULL, NULL, NULL, NULL),
(6, 'UTC', '(GMT +0:00)', 'English', 'dd/mm/yy', 'Nigeria', 'fullName', 7, 'yes', NULL, NULL, NULL, NULL),
(7, 'UTC', '(GMT +0:00)', 'English', 'dd/mm/yy', 'Nigeria', 'fullName', 8, 'yes', NULL, NULL, NULL, NULL),
(8, 'UTC', '(GMT +0:00)', 'English', 'dd/mm/yy', 'Nigeria', 'fullName', 9, 'yes', NULL, NULL, NULL, NULL),
(9, 'UTC', '(GMT +0:00)', 'English', 'dd/mm/yy', 'Nigeria', 'fullName', 10, 'yes', NULL, NULL, NULL, NULL),
(10, 'UTC', '(GMT +0:00)', 'English', 'dd/mm/yy', 'Nigeria', 'fullName', 11, 'yes', NULL, NULL, NULL, NULL),
(11, 'UTC', '(GMT +0:00)', 'English', 'dd/mm/yy', 'Nigeria', 'fullName', 12, 'yes', NULL, NULL, NULL, NULL),
(12, 'UTC', '(GMT +0:00)', 'English', 'dd/mm/yy', 'Nigeria', 'fullName', 13, 'yes', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `referral`
--

CREATE TABLE `referral` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `referee` int(11) DEFAULT NULL,
  `bonus` varchar(200) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `refDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sicknesses`
--

CREATE TABLE `sicknesses` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `cat_id` int(11) NOT NULL,
  `icon` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sicknesses`
--

INSERT INTO `sicknesses` (`id`, `title`, `description`, `cat_id`, `icon`) VALUES
(1, 'Malaria', 'Malaria, a life-threatening disease caused by\r\nPlasmodium parasites, is one of the most prevalent\r\nhealth issues in Nigeria. It is transmitted through the\r\nbite of infected Anopheles mosquitoes and can lead to\r\nsevere complications if left untreated.', 1, 'malaria.png'),
(2, 'Typhoid Fever', 'Typhoid fever, caused by the bacterium Salmonella\r\nTyphi, is another significant concern in Nigeria. It is\r\noften linked to poor sanitation and contaminated water\r\nsources, leading to symptoms such as high fever,\r\nweakness, and gastrointestinal issues.', 1, 'fever.png'),
(3, 'HIV/AIDS', 'Nigeria has one of the highest rates of HIV/AIDS in\r\nAfrica, with the disease weakening the immune system\r\nand making individuals more susceptible to\r\nopportunistic infections. Effective prevention and\r\nmanagement strategies are crucial in combating the\r\nspread of this condition.', 1, 'HIVLogo.png'),
(4, 'Cholera', 'Cholera, an acute diarrheal illness\r\ncaused by the bacterium Vibrio\r\ncholerae, is a significant health\r\nconcern in Nigeria. It is often linked\r\nto poor water and sanitation\r\ninfrastructure, leading to outbreaks\r\nin affected communities.', 2, 'cholera.png'),
(5, 'Gastroenteritis', 'Gastroenteritis, commonly caused\r\nby viral or bacterial infections, leads\r\nto inflammation of the stomach\r\nand intestines, resulting in\r\nsymptoms such as diarrhea,\r\nvomiting, and abdominal cramps.\r\nImproved hygiene and sanitation\r\nare key to preventing the spread of\r\nthese conditions.', 2, 'Gastroenteritis.png'),
(6, 'Meningitis', 'Nigeria is located in the \"meningitis\r\nbelt\" of Africa, where outbreaks of\r\nbacterial meningitis are common,\r\nespecially during the dry season.\r\nMeningitis causes inflammation of\r\nthe membranes covering the brain\r\nand spinal cord and can be lifethreatening\r\nif not treated\r\npromptly.', 2, 'Meningitis.png'),
(7, 'Tuberculosis (TB)', 'Tuberculosis, a contagious\r\nbacterial infection that\r\nprimarily affects the lungs,\r\nremains a significant public\r\nhealth issue in Nigeria,\r\nparticularly in rural areas.\r\nEffective treatment and\r\nprevention strategies are\r\ncrucial in addressing this\r\ncondition.', 3, 'tb.png'),
(8, 'Respiratory Infections', 'Pneumonia, bronchitis, and\r\nother respiratory infections\r\nare common in Nigeria, often\r\naffecting children. These\r\nconditions can be caused by\r\nbacteria, viruses, or\r\nenvironmental factors such as\r\nair pollution.', 3, 'Pneumonia.png'),
(9, 'Lassa Fever', 'Lassa fever, an acute viral\r\nhemorrhagic illness, is\r\nendemic in Nigeria. It is\r\ntransmitted to humans\r\nthrough contact with food or\r\nhousehold items\r\ncontaminated by rodent urine\r\nor feces, and can lead to\r\nsevere complications if not\r\nproperly managed.', 3, 'lasa.png'),
(10, 'Hypertension', 'Hypertension, or high blood pressure, is an increasingly prevalent\r\nissue in Nigeria, often linked to lifestyle factors such as poor diet,\r\nlack of exercise, and stress. It is a major risk factor for stroke, heart\r\ndisease, and kidney failure.', 4, 'hp.png'),
(11, 'Diabetes', 'Type 2 diabetes is becoming more common in Nigeria, especially in\r\nurban areas. This condition is often associated with lifestyle factors\r\nlike poor diet, obesity, and sedentary behavior, and can lead to\r\nvarious complications if not properly managed.', 4, 'diabetes.png'),
(12, 'Hepatitis B and C', 'Chronic hepatitis B and C infections are significant causes of liver\r\ndisease in Nigeria. These viral infections can lead to liver cirrhosis\r\nand liver cancer if not properly diagnosed and treated.', 4, 'hepa.png'),
(13, 'Sickle Cell Disease', 'Nigeria has one of the highest\r\nrates of sickle cell disease in the\r\nworld. This genetic condition\r\ncauses red blood cells to become\r\nmisshapen and break down, leading\r\nto various complications like\r\nanemia, pain, and organ damage.', 5, 'sc.png'),
(14, 'Onchocerciasis (River\r\nBlindness)', 'Onchocerciasis, also known as river\r\nblindness, is a parasitic disease\r\ncaused by the filarial worm\r\nOnchocerca volvulus and spread by\r\nblackfly bites. It is prevalent in rural\r\ncommunities near rivers and can\r\ncause severe itching, skin changes,\r\nand eventually blindness.', 5, 'rb.png'),
(15, 'Leprosy', 'Though less common than in the\r\npast, leprosy remains a public\r\nhealth concern in certain areas of\r\nNigeria. This chronic infectious\r\ndisease caused by Mycobacterium\r\nleprae affects the skin, nerves, and\r\nmucous membranes.', 5, 'leprosy.png');

-- --------------------------------------------------------

--
-- Table structure for table `solana`
--

CREATE TABLE `solana` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `balance` varchar(200) DEFAULT NULL,
  `walletAddress` varchar(200) DEFAULT NULL,
  `privateKey` text DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `solana`
--

INSERT INTO `solana` (`id`, `userid`, `balance`, `walletAddress`, `privateKey`, `created`) VALUES
(54, 5, '0.0', 'GHFnTYPSpYmUHc53DTddb279wcELWepHgRq35JNi6RNR', '3fhUSxaFmvbjMKkFA4YvQna4DtJhE3ypFPmhtQA1hHE2CbKVGDPpkKtjCtqgACvcTxavFz4xWVKk1TfgAHQ4wVLu', '2024-10-06 18:43:14'),
(55, 8, '0.0', 'Aa4KyrVRSib5cuAPcrU8Q2t5NEWXiik4NTKvyYMtgzrk', '4jD6rnGDmJZQb1NzoFDy1c1CQQRoJ594Uths2bDBsaq2QZY7vBdrRvyqoTaq2AsKsNNRogbzzDnV6PkiNUQJxakg', '2024-10-06 22:25:18'),
(56, 13, '0.0', 'BEarAcCQhRA4zDTtDZeF6vCgpWCcvP6UF2KZfcv6Y6xG', 'PPefPr5ub63S2f33Pg3PTeTkCRR15ZK3SLbgs92ENTdPdGdT18bj9rrSXnbBDNr6bLx1dSBhAFWFD7DMzDyoaKS', '2024-10-07 10:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `solanaParams`
--

CREATE TABLE `solanaParams` (
  `id` int(11) NOT NULL,
  `consultId` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `userImage` varchar(300) NOT NULL,
  `adminWallet` varchar(300) NOT NULL,
  `user` varchar(100) NOT NULL,
  `consultType` varchar(100) NOT NULL,
  `amount` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `solanaParams`
--

INSERT INTO `solanaParams` (`id`, `consultId`, `userid`, `userImage`, `adminWallet`, `user`, `consultType`, `amount`) VALUES
(243, 295, 1, '../images/users/—Pngtree—letter eb logo be monogram_5674923.png', '9HvPQrAs6yXrdiqSSwbuix8bqXUtCtJWpKFdAxEKjeDy', 'Augustine Gabriel', 'video', '0.02');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `planId` int(11) DEFAULT NULL,
  `conversionFee` varchar(100) DEFAULT NULL,
  `amount` int(200) DEFAULT NULL,
  `rio` int(100) DEFAULT NULL,
  `ref` varchar(300) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `walletType` varchar(200) DEFAULT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `userid`, `planId`, `conversionFee`, `amount`, `rio`, `ref`, `type`, `status`, `walletType`, `dateTime`) VALUES
(176, 1, 1, '1', 100, 18, 'INV-QVJ06IDS10', 'investment', 'approved', 'btc', '2024-04-26 19:55:28'),
(181, 1, 1, '1', 100, 18, 'INV-5BHX0VZC10', 'investment', 'approved', 'balance', '2024-07-19 16:49:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `fullName` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(2000) NOT NULL,
  `profilepix` varchar(2000) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `residentialCountry` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `address` varchar(2000) DEFAULT NULL,
  `dob` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `type` varchar(200) DEFAULT NULL,
  `disable` varchar(200) DEFAULT NULL,
  `invite_ref` varchar(200) DEFAULT NULL,
  `siteLockPassCode` varchar(200) DEFAULT NULL,
  `passwordReset` varchar(20) DEFAULT NULL,
  `verify` int(11) DEFAULT NULL,
  `bank` varchar(200) DEFAULT NULL,
  `accountNumber` varchar(2000) DEFAULT NULL,
  `passUpdateDate` varchar(200) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `idFront` varchar(200) DEFAULT NULL,
  `idBack` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `fullName`, `email`, `username`, `password`, `profilepix`, `country`, `residentialCountry`, `city`, `address`, `dob`, `phone`, `created`, `type`, `disable`, `invite_ref`, `siteLockPassCode`, `passwordReset`, `verify`, `bank`, `accountNumber`, `passUpdateDate`, `state`, `idFront`, `idBack`) VALUES
(1, 'Augustine Gabriel', 'gabson2939@gmail.com', 'gabson', '$2y$10$f/l.Bxxb49JeacElc72Reus05WpenuT47xctwDGVg3swerLt1jm0C', '—Pngtree—letter eb logo be monogram_5674923.png', 'Nigeria', 'Nigeria', 'Lafia', 'Behind UBA', '05/09/1997', '09072900561', '2024-08-30 07:19:12', NULL, NULL, 'f5431_1', NULL, NULL, NULL, '', '', '2024-09-20 01:38:03', 'Nasarawa', '', ''),
(2, 'Samuel James', 'sam@gmail.com', 'Sam', '$2y$10$saK4XhHy4cPXft/uW5X8rORYabxNiHgz456nYxjSSDURZxA/MbBNy', 'sam.jpg', 'Nigeria', NULL, NULL, 'Behind UBA', '05/09/1997', NULL, '2024-08-31 14:34:31', NULL, NULL, 'A5dC2_2', NULL, NULL, NULL, NULL, NULL, NULL, 'Lagos', '', ''),
(5, 'Abubakar Mohammed', 'abubakarsadiqimohammed@gmail.com', 'Ysd', '$2y$10$z90bsyk.XliHygxyq0NVzuzjaQvhC4Qhuu8/034zzmuZSgCAVb/Pm', 'rerfds.JPG', 'Nigeria', 'Nigeria', 'Lafia', 'HOUSE NUMBER 15 GSS LAFIA QUARTERS', '10/01/1996', '08129332174', '2024-10-06 18:19:06', NULL, NULL, '5F2ae_5', NULL, NULL, NULL, 'Opay', '8129332174', NULL, NULL, NULL, NULL),
(6, 'Agite', 'ashrahson45@gmail.com', 'Bentop4life', '$2y$10$hCOELronaWZyQZcaw3JF6OL69QGsX4y62Dkqap.8urfD4aBhuBkyS', '', 'Nigeria', NULL, NULL, NULL, NULL, NULL, '2024-10-06 18:41:43', NULL, NULL, '13F52_6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Peace Kpaba Danson', 'peacekpaba@gmail.com', 'peacekpaba', '$2y$10$KqAQqOfegFfizHsgZ66MXugMssDV7uSqU7iB/D3DSnY4DZjn4XTeK', '', 'Nigeria', NULL, NULL, NULL, NULL, NULL, '2024-10-06 22:17:34', NULL, NULL, 'E43fF_7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Emmanuel Oparaugo', 'mawuli.ceo@gmail.com', 'Mawuli_Ceo', '$2y$10$VPpjlthlxLqUihtAiabjfOd78/qbVLICbdeELKWMB2G8GScMv6hgm', '', 'Nigeria', NULL, NULL, NULL, NULL, NULL, '2024-10-06 22:21:03', NULL, NULL, 'bB3AC_8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Benjamin James', 'bennamite@gmail.com', 'bennamite', '$2y$10$RMWrKKRPgWH/tgFf7IseoOs.aX1xwop3N7gWKTIgQQxR1EpJaXQ/m', '', 'Nigeria', NULL, NULL, NULL, NULL, NULL, '2024-10-06 22:23:39', NULL, NULL, 'ea4C1_9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Stephen Peter', 'peterstephen331@gmail.com', 'Stevelinks', '$2y$10$YVDD215l.QUuMbzwxRnjaeqgX6sn3Ku9GKyjI/UVnCCXJiiy6W4Ye', '', 'Nigeria', NULL, NULL, NULL, NULL, NULL, '2024-10-07 08:37:51', NULL, NULL, 'AE1dF_10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Attah Faithfulness', 'attahfaithfulness44@gmail.com', 'Aragaki', '$2y$10$RwDEsBVbdi72zbNgiWrqQuT0x3VKw5buKRBFH8s6X1NZ5.Chq7cY6', '', 'Nigeria', NULL, NULL, NULL, NULL, NULL, '2024-10-07 09:22:56', NULL, NULL, 'f1F64_11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Muhammad Junaidu', 'junaidumuhammad169@gmail.com', 'Activeco', '$2y$10$mqCb1m9KpTnEiK/lSBc2.OzWXLgQAnpi2gp/xiiEVO0YkJG8yf.xO', '', 'Nigeria', NULL, NULL, NULL, NULL, NULL, '2024-10-07 10:12:44', NULL, NULL, 'e4Cd1_12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Adejor Gabriel', 'adejorgabriel20@gmail.com', 'Adejorgabriel001', '$2y$10$6LZK7dOzK0HKZZgjfrpSl.6a.JacFRNp85W00THm3Cn58OkFyObJC', '', 'Nigeria', NULL, NULL, NULL, NULL, NULL, '2024-10-07 10:33:59', NULL, NULL, 'af4c6_13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acct_key` (`userid`);

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activityKey` (`userid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consultKey` (`userid`);

--
-- Indexes for table `consultationType`
--
ALTER TABLE `consultationType`
  ADD PRIMARY KEY (`consultId`);

--
-- Indexes for table `control`
--
ALTER TABLE `control`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `docKey` (`cat_id`);

--
-- Indexes for table `doc_category`
--
ALTER TABLE `doc_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`gameId`);

--
-- Indexes for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leadKey` (`userid`),
  ADD KEY `gameKey` (`gameId`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_lists`
--
ALTER TABLE `medical_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catKey` (`cat_id`);

--
-- Indexes for table `med_category`
--
ALTER TABLE `med_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notiKey` (`userid`);

--
-- Indexes for table `preference`
--
ALTER TABLE `preference`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prefKey` (`userid`);

--
-- Indexes for table `referral`
--
ALTER TABLE `referral`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refKey` (`userid`);

--
-- Indexes for table `sicknesses`
--
ALTER TABLE `sicknesses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catKey` (`cat_id`);

--
-- Indexes for table `solana`
--
ALTER TABLE `solana`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solKey` (`userid`);

--
-- Indexes for table `solanaParams`
--
ALTER TABLE `solanaParams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solParamKey` (`userid`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`userid`),
  ADD KEY `planKey` (`planId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=296;

--
-- AUTO_INCREMENT for table `consultationType`
--
ALTER TABLE `consultationType`
  MODIFY `consultId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `control`
--
ALTER TABLE `control`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `doc_category`
--
ALTER TABLE `doc_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `gameId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leaderboard`
--
ALTER TABLE `leaderboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `medical_lists`
--
ALTER TABLE `medical_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `med_category`
--
ALTER TABLE `med_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `preference`
--
ALTER TABLE `preference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `referral`
--
ALTER TABLE `referral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sicknesses`
--
ALTER TABLE `sicknesses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `solana`
--
ALTER TABLE `solana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `solanaParams`
--
ALTER TABLE `solanaParams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `acct_key` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activityKey` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `consultations`
--
ALTER TABLE `consultations`
  ADD CONSTRAINT `consultKey` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `docKey` FOREIGN KEY (`cat_id`) REFERENCES `doc_category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD CONSTRAINT `gameKey` FOREIGN KEY (`gameId`) REFERENCES `games` (`gameId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leadKey` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notiKey` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `preference`
--
ALTER TABLE `preference`
  ADD CONSTRAINT `prefKey` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `referral`
--
ALTER TABLE `referral`
  ADD CONSTRAINT `refKey` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sicknesses`
--
ALTER TABLE `sicknesses`
  ADD CONSTRAINT `catKey` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `solana`
--
ALTER TABLE `solana`
  ADD CONSTRAINT `solKey` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `solanaParams`
--
ALTER TABLE `solanaParams`
  ADD CONSTRAINT `solParamKey` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
