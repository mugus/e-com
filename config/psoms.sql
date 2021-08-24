-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2021 at 06:54 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psoms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL DEFAULT 'SCMS',
  `lastname` varchar(100) NOT NULL DEFAULT 'Admin',
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL DEFAULT 'profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `firstname`, `lastname`, `email`, `password`, `image`) VALUES
(1, 'PSOMS', 'Admin', 'admin', 'psoms.admin', '2_1614792157.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catid`, `name`, `description`) VALUES
(1, 'History Painting', 'Historical Painting is art that describe the past'),
(2, 'Genre', 'hgigiugiuin uygiu'),
(3, 'Landscaping', 'giruqw bqguriuajg atkhahotuq uygiu');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `companyid` int(11) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `about` varchar(5000) NOT NULL,
  `contacts` varchar(500) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`companyid`, `brand`, `about`, `contacts`, `description`, `logo`, `createdDate`) VALUES
(1, 'MANSHAW', 'Luxury Depreciationa', '07439464', 'We provide best delivery services', '', '0000-00-00 00:00:00'),
(2, 'Rain Bow', 'My work is done', '07349383', 'we deliver on time', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `deliverer`
--

CREATE TABLE `deliverer` (
  `id` int(11) NOT NULL,
  `company` varchar(300) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `status` varchar(30) NOT NULL,
  `activate_code` varchar(15) NOT NULL,
  `resetCode` varchar(15) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deliverer`
--

INSERT INTO `deliverer` (`id`, `company`, `email`, `password`, `firstname`, `lastname`, `address`, `phone`, `photo`, `status`, `activate_code`, `resetCode`, `createdDate`) VALUES
(1, '2', 'jack@psoms.com', '$2y$10$iTCuT.HEZvoAnSaQ/8pvoej07TdpIJeIZ81cSURpocB9WhWT1J8dS', 'Sam', 'Didier', 'Kabarondo', '06393943', '1_9933533898.jpg', 'Activated', '', '', '2021-01-31 22:00:00'),
(14, '1', 'kelly@psoms.com', '$2y$10$iTCuT.HEZvoAnSaQ/8pvoej07TdpIJeIZ81cSURpocB9WhWT1J8dS', 'Kelly', 'Dina', 'Musanze', '07783734763', '14_3787834035.jpg', 'Activated', '', '', '0000-00-00 00:00:00'),
(24, '1', 'Joana@gmail.com', '$2y$10$iTCuT.HEZvoAnSaQ/8pvoej07TdpIJeIZ81cSURpocB9WhWT1J8dS', 'Joanite', 'Shimwe', 'Gikondo', '07238784232384', '24_7701502071.jpg', 'Activated', '', 'f9wp37EMdF', '2021-07-20 11:44:53'),
(25, '1', 'felix@auca.ac.ar', '$2y$10$iTCuT.HEZvoAnSaQ/8pvoej07TdpIJeIZ81cSURpocB9WhWT1J8dS', 'Felix', 'Ugirashebuja', 'Gisozi', '06387474835783', '25_4851915814.jpg', 'Activated', '', 'QoQ3sGtEQC', '2021-07-20 11:46:50'),
(26, '2', 'shaolin@yahoo.fr', '$2y$10$iTCuT.HEZvoAnSaQ/8pvoej07TdpIJeIZ81cSURpocB9WhWT1J8dS', 'Kubita', 'Shaolin', 'Nyabugogo', '093734657834', '26_3109481874.jpg', 'Activated', '', 'qmOBlxNDwf', '2021-07-20 11:52:48');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `docid` int(11) NOT NULL,
  `owner` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `file` varchar(300) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paintings`
--

CREATE TABLE `paintings` (
  `pid` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `catid` varchar(20) NOT NULL,
  `tech_id` varchar(20) NOT NULL,
  `vendorid` varchar(100) NOT NULL,
  `height` varchar(20) NOT NULL,
  `width` varchar(20) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL,
  `status` varchar(30) NOT NULL,
  `photoid` varchar(500) NOT NULL,
  `likes` varchar(20) NOT NULL,
  `madeDate` date NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paintings`
--

INSERT INTO `paintings` (`pid`, `name`, `catid`, `tech_id`, `vendorid`, `height`, `width`, `quantity`, `price`, `status`, `photoid`, `likes`, `madeDate`, `dateAdded`) VALUES
(3, 'tech_name', '1', '1', '6', '30', '20', '2', '5300', '', '112496026', '', '2021-06-29', '2021-07-29 09:59:36'),
(4, 'home decor', '2', '2', '6', '23', '14', '1', '2500', '', '221971006', '', '2021-07-06', '2021-07-29 10:19:05'),
(6, 'dhsf', '3', '2', '6', '30', '20', '2', '3400', '', '32957216', '', '2021-12-12', '2021-07-29 16:34:28'),
(10, 'tzorganal', '3', '2', '6', '36', '24', '5', '5600', '', '322596426', '', '2021-07-21', '2021-07-29 16:38:42');

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `photoid` int(11) NOT NULL,
  `fileName` varchar(200) NOT NULL,
  `owner` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `photoid`, `fileName`, `owner`) VALUES
(1, 2982056, '2_162755254816_pic.jpg', '6'),
(2, 21841906, '2_162755261026_pic.jpg', '6'),
(3, 112496026, '1_162755277616_pic.jpg', '6'),
(4, 221971006, '2_162755394526_pic.jpg', '6'),
(5, 113473836, '1_162755401916_pic.png', '6'),
(6, 32957216, '3_162757646826_pic.jpg', '6'),
(7, 113107026, '1_162757652116_pic.jpg', '6'),
(8, 222483786, '2_162757658026_pic.jpg', '6'),
(9, 12640386, '1_162757667726_pic.jpg', '6'),
(10, 322596426, '3_162757672226_pic.jpg', '6');

-- --------------------------------------------------------

--
-- Table structure for table `technics`
--

CREATE TABLE `technics` (
  `tech_id` int(11) NOT NULL,
  `tech_name` varchar(100) NOT NULL,
  `description` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `technics`
--

INSERT INTO `technics` (`tech_id`, `tech_name`, `description`) VALUES
(1, 'Water', 'water colored paint'),
(2, 'Oiled Paint', 'Oiled Colored Paint');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(60) NOT NULL,
  `type` int(1) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `status` varchar(30) NOT NULL,
  `activate_code` varchar(15) NOT NULL,
  `reset_code` varchar(15) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `type`, `firstname`, `lastname`, `address`, `phone`, `photo`, `status`, `activate_code`, `reset_code`, `created_on`) VALUES
(1, 'admin@admin.com', '$2y$10$iTCuT.HEZvoAnSaQ/8pvoej07TdpIJeIZ81cSURpocB9WhWT1J8dS', 1, 'Sam', 'Didier', '', '', 'thanos1.jpg', 'Activated', '', '', '2021-01-31 22:00:00'),
(14, 'manager@manager.com', '$2y$10$iTCuT.HEZvoAnSaQ/8pvoej07TdpIJeIZ81cSURpocB9WhWT1J8dS', 2, 'Kelly', 'Dina', 'Musanze', '07783734763', 'about-1.jpg', 'Deactivated', '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `role_name` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role`, `role_name`) VALUES
(1, 1, 'Customer'),
(2, 2, 'Deliverer');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendorid` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `businessName` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `status` varchar(30) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorid`, `email`, `password`, `businessName`, `logo`, `address`, `phone`, `status`, `createdDate`) VALUES
(6, 'aba1remy@gmail.com', '$2y$10$iTCuT.HEZvoAnSaQ/8pvoej07TdpIJeIZ81cSURpocB9WhWT1J8dS', 'JogLow', 'JogLow_7559006343.png', 'Nyarugenge, DownTown', '+2507800000032', 'Activated', '2021-07-17 12:13:17'),
(7, 'alhwiclo@gmail.com', '$2y$10$iTCuT.HEZvoAnSaQ/8pvoej07TdpIJeIZ81cSURpocB9WhWT1J8dS', 'THEMAG', 'THEMAG_6535005817.jpg', 'Gasabo, Masoro', '0793934856', 'Activated', '2021-07-17 15:17:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`companyid`);

--
-- Indexes for table `deliverer`
--
ALTER TABLE `deliverer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`docid`);

--
-- Indexes for table `paintings`
--
ALTER TABLE `paintings`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photoid` (`photoid`);

--
-- Indexes for table `technics`
--
ALTER TABLE `technics`
  ADD PRIMARY KEY (`tech_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendorid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `companyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `deliverer`
--
ALTER TABLE `deliverer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `docid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paintings`
--
ALTER TABLE `paintings`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `technics`
--
ALTER TABLE `technics`
  MODIFY `tech_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
