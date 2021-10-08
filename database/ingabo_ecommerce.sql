-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2021 at 05:16 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ingabo_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `ps_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(200) NOT NULL,
  `descriptions` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `descriptions`) VALUES
(1, 'Pesticides', ''),
(2, 'Fertilizers', '');

-- --------------------------------------------------------

--
-- Table structure for table `cooperatives`
--

CREATE TABLE `cooperatives` (
  `coop_id` int(11) NOT NULL,
  `coop_name` varchar(200) NOT NULL,
  `phone_to_contact` varchar(200) NOT NULL,
  `province` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `cell` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `descriptions` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cooperatives`
--

INSERT INTO `cooperatives` (`coop_id`, `coop_name`, `phone_to_contact`, `province`, `district`, `sector`, `cell`, `village`, `descriptions`, `created_at`) VALUES
(1, 'urwego', '78984565', 'South', 'Nyamagabe', 'Tare', 'Gasarenda', 'Kagarama', 'rub ewutheiutgi euOWHUG NES GU SGHURHYUHGBGAIPHG DIHGUERS', '2021-10-05 14:51:42'),
(2, 'Yego bana burwanda', '49545635', 'Kigali', 'Gasabo', 'Tare', 'ewthbiewb', 'ekektkene', 'fndbsfjgdsig sd gusdguis\r\ngausghiuasdguasuguuyuafayga\r\nagugashgiugbwbgioeyue eugtueigh regret hsiuthg\r\niugtgwg erbg eh eh\r\nqerhgij', '2021-10-05 14:52:55');

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `farmer_id` int(11) NOT NULL,
  `farmer_reg_no` varchar(255) NOT NULL,
  `farmer_firstname` varchar(255) NOT NULL,
  `farmer_lastname` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `cell` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `farmer_address` int(11) DEFAULT NULL,
  `farmer_phone` varchar(200) NOT NULL,
  `farmer_landsize` varchar(200) NOT NULL,
  `farmer_product_season_A` varchar(200) DEFAULT NULL,
  `farmer_product_season_B` varchar(200) DEFAULT NULL,
  `farmer_product_season_C` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`farmer_id`, `farmer_reg_no`, `farmer_firstname`, `farmer_lastname`, `province`, `district`, `sector`, `cell`, `village`, `farmer_address`, `farmer_phone`, `farmer_landsize`, `farmer_product_season_A`, `farmer_product_season_B`, `farmer_product_season_C`, `created_at`) VALUES
(1, 'INGABO-67969', 'mugus', 'ali', 'south', 'nyamagabe', 'tare', 'gasarenda', 'kagarama', 0, '', '120', '', '', '', '2021-10-04 12:21:46'),
(2, 'INGABO-02054', 'Gustave', 'MUHOZA', 'Washington', 'rykljrpyj', 'erpyjperj', '', 'wtupjwp', NULL, '546788804330', '33', '', '', '', '2021-10-04 13:05:33'),
(6, 'INGABO-87472524', 'Christian', 'Ishimwe', 'Kigali', 'Kicukiro', 'Masaka', '', 'Cyiza', NULL, '0733194591', '120', '', '', '', '2021-10-04 14:41:36');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_address`
--

CREATE TABLE `farmer_address` (
  `address_id` int(11) NOT NULL,
  `province` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `cell` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `sales_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `ps_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `farmer_address` varchar(255) NOT NULL,
  `farmer_phone` varchar(255) NOT NULL,
  `coop_address` varchar(255) NOT NULL,
  `coop_phone` varchar(255) NOT NULL,
  `farmer_reg_no` varchar(255) NOT NULL,
  `tranaction_id` varchar(255) DEFAULT NULL,
  `tx_ref` varchar(255) NOT NULL,
  `sales_status` int(11) NOT NULL,
  `due_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`sales_id`, `user_id`, `product_id`, `ps_id`, `qty`, `farmer_address`, `farmer_phone`, `coop_address`, `coop_phone`, `farmer_reg_no`, `tranaction_id`, `tx_ref`, `sales_status`, `due_date`) VALUES
(1, 6154246, 5, 11, 1, 'Masaka, , Cyiza', '0733194591', 'Tare, Gasarenda, Kagarama', '78984565', 'INGABO-87472524', NULL, '8367rtfM2Dtgiukj2uDM2uyrRG2', 0, '2021-10-06 11:23:27'),
(2, 6154246, 2, 8, 1, 'Masaka, , Cyiza', '0733194591', 'Tare, Gasarenda, Kagarama', '78984565', 'INGABO-87472524', NULL, '8367rtfM2Dtgiukj2uDM2uyrRG2', 0, '2021-10-06 11:23:27'),
(3, 6154246, 2, 7, 1, 'erpyjperj, , wtupjwp', '546788804330', 'Tare, Gasarenda, Kagarama', '78984565', 'INGABO-02054', NULL, '8367rtfM2Dtgiukj2uDM2uyrRG2', 0, '2021-10-07 14:10:34'),
(4, 6154246, 1, 2, 3, 'erpyjperj, , wtupjwp', '546788804330', 'Tare, Gasarenda, Kagarama', '78984565', 'INGABO-02054', NULL, '615f0339beef3d1453740wio615f0339bef06nj615f0339bef0beu263115kkiz615f0339bef0e', 0, '2021-10-07 14:25:01'),
(5, 6154246, 3, 4, 1, 'erpyjperj, , wtupjwp', '546788804330', 'Tare, Gasarenda, Kagarama', '78984565', 'INGABO-02054', NULL, '615f0339beef3d1453740wio615f0339bef06nj615f0339bef0beu263115kkiz615f0339bef0e', 0, '2021-10-07 14:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `amount` int(11) NOT NULL,
  `tx_ref` varchar(255) NOT NULL,
  `verified` int(11) NOT NULL DEFAULT 0,
  `paid_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `fullname`, `phone`, `email`, `amount`, `tx_ref`, `verified`, `paid_on`) VALUES
(1, 'MUHOZA Gustave', '0788345538', 'muhozagustave1213@gmail.com', 22000, '8367rtfM2Dtgiukj2uDM2uyrRG2', 0, '2021-10-06 09:27:30'),
(2, 'MUHOZA Gustave', '0788804330', 'muhozagustave1213@gmail.com', 22000, '8367rtfM2Dtgiukj2uDM2uyrRG2', 0, '2021-10-06 09:49:13'),
(3, 'MUHOZA Gustave', '0788804330', 'muhozagustave1213@gmail.com', 22000, '8367rtfM2Dtgiukj2uDM2uyrRG2', 0, '2021-10-06 09:50:47'),
(4, 'MUHOZA Gustave', '0788804330', 'muhozagustave1213@gmail.com', 22000, '8367rtfM2Dtgiukj2uDM2uyrRG2', 0, '2021-10-06 09:52:50'),
(5, 'Ishimwe Christian', '0788804330', 'muhozagustave1213@gmail.com', 22000, '8367rtfM2Dtgiukj2uDM2uyrRG2', 0, '2021-10-06 09:57:13'),
(6, 'MUHOZA Gustave', '0788804330', 'muhozagustave1213@gmail.com', 22000, '8367rtfM2Dtgiukj2uDM2uyrRG2', 0, '2021-10-06 10:06:45'),
(7, 'MUHOZA Gustave', '0788804330', 'muhozagustave1213@gmail.com', 22000, '8367rtfM2Dtgiukj2uDM2uyrRG2', 0, '2021-10-06 10:09:44'),
(8, 'MUHOZA Gustave', '0788804330', 'muhozagustave1213@gmail.com', 22000, '8367rtfM2Dtgiukj2uDM2uyrRG2', 0, '2021-10-06 10:11:50'),
(9, 'Ishimwe Christian', '0788804330', 'muhozagustave1213@gmail.com', 10000, '8367rtfM2Dtgiukj2uDM2uyrRG2', 0, '2021-10-06 10:44:41'),
(10, 'Ishimwe Christian', '0788804330', 'muhozagustave1213@gmail.com', 10000, '8367rtfM2Dtgiukj2uDM2uyrRG2', 0, '2021-10-06 10:44:44'),
(11, 'Ishimwe Christian', '0788804330', 'muhozagustave1213@gmail.com', 9600, '8367rtfM2Dtgiukj2uDM2uyrRG2', 0, '2021-10-06 10:46:55'),
(12, 'Ishimwe Christian', '0788804330', 'muhozagustave1213@gmail.com', 9600, '8367rtfM2Dtgiukj2uDM2uyrRG2', 0, '2021-10-06 10:47:23'),
(13, 'Ishimwe Christian', '0788804330', 'muhozagustave1213@gmail.com', 49450, '8367rtfM2Dtgiukj2uDM2uyrRG2', 0, '2021-10-06 10:50:17'),
(14, 'ali mugus', '0788804330', 'muhozagustave1213@gmail.com', 3800, '8367rtfM2Dtgiukj2uDM2uyrRG2', 0, '2021-10-06 10:52:10'),
(15, 'Ishimwe Christian', '0788804330', 'muhozagustave1213@gmail.com', 10450, '8367rtfM2Dtgiukj2uDM2uyrRG2', 0, '2021-10-06 11:23:27'),
(16, 'MUHOZA Gustave', '0788804330', 'muhozagustave1213@gmail.com', 4500, '8367rtfM2Dtgiukj2uDM2uyrRG2', 0, '2021-10-07 14:10:34'),
(17, 'MUHOZA Gustave', '0788804330', 'muhozagustave1213@gmail.com', 4150, '615f0339beef3d1453740wio615f0339bef06nj615f0339bef0beu263115kkiz615f0339bef0e', 0, '2021-10-07 14:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `product_size` int(11) NOT NULL,
  `man_date` date NOT NULL,
  `exp_date` date NOT NULL,
  `product_status` varchar(110) NOT NULL DEFAULT 'New',
  `descriptions` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `cat_id`, `stock`, `price`, `product_size`, `man_date`, `exp_date`, `product_status`, `descriptions`, `photo`, `creation_date`) VALUES
(1, 'JackMax', 1, 120, 2500, 0, '2021-10-01', '2021-11-01', 'New', 'jackmax gdwqugjackmaxjackmaxjackmaxjackmaxjackmaxjackmaxjackmaxjackmaxjackmaxjackmaxjackmaxjackmaxjackmaxjackmax', 'JackMax_1_1633090011.jpg', '2021-10-01 12:06:51'),
(2, 'Romaxtyn', 1, 95, 2000, 0, '2021-02-01', '2022-04-30', 'New', 'Romaxtyn Romaxtyn Romaxtyn Romaxtyn Romaxtyn Romaxtyn Romaxtyn Romaxtyn Romaxtyn Romaxtyn Romaxtyn Romaxtyn Romaxtyn Romaxtyn Romaxtyn Romaxtyn ', 'Romaxtyn_1_1633090194.jpg', '2021-10-01 12:09:54'),
(3, 'GliderMax', 1, 57, 1500, 0, '2021-05-01', '2022-04-10', 'New', 'GliderMax GliderMax GliderMax GliderMax GliderMax GliderMax GliderMax GliderMax GliderMax GliderMax GliderMax GliderMax GliderMax GliderMax GliderMax GliderMax GliderMax GliderMax GliderMax GliderMax GliderMax GliderMax GliderMax GliderMax GliderMax Glide', 'GliderMax_1_1633090277.jpg', '2021-10-01 12:11:17'),
(4, 'MillMax Gold', 2, 25, 3000, 0, '2021-02-01', '2023-06-30', 'New', 'MillMax MillMax MillMaxMillMaxMillMaxMillMax MillMaxMillMax MillMaxMillMaxMillMaxMillMaxMillMaxMillMaxMillMaxMillMaxMillMaxMillMaxMillMaxMillMaxMillMaxMillMaxMillMaxMillMaxMillMaxMillMaxMillMaxMillMaxMillMaxMillMaxMillMax', 'MillMax_2_1633090674.jpg', '2021-10-01 12:17:54'),
(5, 'CopperMax', 2, 100, 4000, 0, '2021-03-01', '2022-02-28', 'New', 'CopperMax CopperMax CopperMax CopperMax CopperMax CopperMax CopperMax CopperMax CopperMax CopperMax CopperMax CopperMax CopperMax CopperMax CopperMax CopperMax CopperMax CopperMax CopperMax CopperMax CopperMax CopperMax CopperMax CopperMax CopperMax Coppe', 'CopperMax_2_1633090742.jpg', '2021-10-01 12:19:02');

-- --------------------------------------------------------

--
-- Table structure for table `products_size`
--

CREATE TABLE `products_size` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_size`
--

INSERT INTO `products_size` (`id`, `product_id`, `product_size`, `price`) VALUES
(1, 1, '1L', '9000'),
(2, 1, '100ML', '1000'),
(3, 3, '1L', '9700'),
(4, 3, '100ML', '1150'),
(5, 3, '500ML', '5000'),
(6, 2, '1L', '9000'),
(7, 2, '500ML', '4500'),
(8, 2, '100ML', '950'),
(9, 4, '1Kg', '13100'),
(10, 4, '250Gr', '3800'),
(11, 5, '1Kg', '9500'),
(12, 5, '250Gr', '2400');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status_code` int(11) NOT NULL DEFAULT 0,
  `user_role` int(11) NOT NULL DEFAULT 0,
  `join_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `un_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `phone_number`, `address`, `password`, `status_code`, `user_role`, `join_date`, `un_id`) VALUES
(1, 'Gustave', 'MUHOZA', 'muhozagustave1213@gmail.com', '0788804330', 'KG 655', '$2y$10$0ko9tkdvmX9K8V9GhSzZCOIqGO2iOQM8OLgeDJhtinDmgl4y3huuu', 1, 1, '2021-09-29 08:31:41', '6154246da0aef'),
(2, 'Gustave', 'MUHOZA', 'aba1remy@gmail.com', '0788804330', 'KG 655', '$2y$10$oAVdADCXOzrxk5QpXf6LheqUpckiwXPTshuwHgX5/jHQI9KgEx6SW', 0, 0, '2021-09-29 08:45:13', '615427998fe47'),
(3, 'ISHIWME', 'Christian', 'ishimwechristian71@gmail.com', '0788345538', 'Kn 34 Street, Kigali, Rwanda', '$2y$10$/jd2FfUhC0ucZ3JiE8GAReRQxROI/T5hC8Pj66w0HBQqFnbzNTFIS', 1, 1, '2021-09-30 14:30:22', '6155c9fe6ee841302716155c9fe6ee986155c9fe6ee9a780936155c9fe6ee9c');

-- --------------------------------------------------------

--
-- Table structure for table `userstatus`
--

CREATE TABLE `userstatus` (
  `id` int(11) NOT NULL,
  `status_code` int(11) NOT NULL,
  `status_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userstatus`
--

INSERT INTO `userstatus` (`id`, `status_code`, `status_name`) VALUES
(1, 0, 'Not Verified'),
(2, 1, 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `role_code` int(11) NOT NULL,
  `role_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role_code`, `role_name`) VALUES
(1, 0, 'client'),
(2, 1, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`,`product_id`),
  ADD KEY `ps_id` (`ps_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `cooperatives`
--
ALTER TABLE `cooperatives`
  ADD PRIMARY KEY (`coop_id`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`farmer_id`),
  ADD UNIQUE KEY `farmer_phone` (`farmer_phone`),
  ADD UNIQUE KEY `farmer_reg_no` (`farmer_reg_no`),
  ADD KEY `farmer_address` (`farmer_address`),
  ADD KEY `farmer_address_2` (`farmer_address`);

--
-- Indexes for table `farmer_address`
--
ALTER TABLE `farmer_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `user_id` (`user_id`,`product_id`),
  ADD KEY `ps_id` (`ps_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `product_size` (`product_size`);

--
-- Indexes for table `products_size`
--
ALTER TABLE `products_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `status_code` (`status_code`),
  ADD KEY `user_status` (`user_role`);

--
-- Indexes for table `userstatus`
--
ALTER TABLE `userstatus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_code` (`status_code`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_code` (`role_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cooperatives`
--
ALTER TABLE `cooperatives`
  MODIFY `coop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `farmer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `farmer_address`
--
ALTER TABLE `farmer_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products_size`
--
ALTER TABLE `products_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `userstatus`
--
ALTER TABLE `userstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `farmer_address`
--
ALTER TABLE `farmer_address`
  ADD CONSTRAINT `farmer_address_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `farmers` (`farmer_address`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_size`
--
ALTER TABLE `products_size`
  ADD CONSTRAINT `products_size_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`status_code`) REFERENCES `userstatus` (`status_code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
