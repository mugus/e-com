-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2021 at 03:57 PM
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
  `user_id` varchar(255) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `ps_id` int(11) NOT NULL,
  `coop_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `ps_id`, `coop_id`, `qty`) VALUES
(1, 'muhozagustave1213@gmail.com-617a5060adaaf617a5060adac0-617a5060adac6-617a5060adaca617a5060adacd617a5060adad2-617a5060adad7', 41, 27, 3, 10);

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
(2, 'Fertilizers', ''),
(3, 'Fungicides', '');

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
(2, 'Yego bana burwanda', '49545635', 'Kigali', 'Gasabo', 'Tare', 'ewthbiewb', 'ekektkene', 'fndbsfjgdsig sd gusdguis\r\ngausghiuasdguasuguuyuafayga\r\nagugashgiugbwbgioeyue eugtueigh regret hsiuthg\r\niugtgwg erbg eh eh\r\nqerhgij', '2021-10-05 14:52:55'),
(3, 'Test', '784564531', 'South', 'rykljrpyj', 'Tare', 'Muhoza', 'Kagarama', 'rehgvrhewvrhewrwegn ewt', '2021-10-19 12:47:46');

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
(8, 'INGABO-14425597', 'Abdul', 'Baari', 'North', 'Musanze', 'Muhoza', 'Musanze', 'Muhoza', NULL, '0787848876', '75', 'vegetable', 'wheat', 'vegetable', '2021-10-13 11:04:29'),
(9, 'INGABO-06251858', 'Gustave', 'MUHOZA', 'Kigali', 'Kicukiro', 'Kagarama', 'Urugero', 'Rukatsa', NULL, '0788804330', '560', 'wheat', 'wheat', 'vegetable', '2021-10-13 12:44:24'),
(10, 'INGABO-42174030', 'tytyne', 'ali', 'Kigali', 'rykljrpyj', 'Summertown', 'Kagarama', 'Muhoza', NULL, '0781449311', '1265', 'vegetable', 'vegetable', 'vegetable', '2021-10-19 12:45:26'),
(11, 'INGABO-38165736', 'tytyne', 'ali', 'Kigali', 'Nyamagabe', 'ewtuyewug', 'Musanze', 'Gasarenda', NULL, '7078144931', '785', 'vegetable', 'vegetable', 'wheat', '2021-10-19 12:47:00');

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
  `coop_id` int(11) NOT NULL,
  `tx_ref` varchar(255) NOT NULL,
  `due_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`sales_id`, `user_id`, `product_id`, `ps_id`, `qty`, `farmer_address`, `farmer_phone`, `coop_address`, `coop_phone`, `farmer_reg_no`, `coop_id`, `tx_ref`, `due_date`) VALUES
(1, 6154246, 41, 27, 1, '', '', '', '', 'INGABO-42174030', 1, '617802d7862fdd858100wio617802d789a9cnj617802d789aa3eu293038kkiz617802d789aa7', '2021-10-26 13:30:18'),
(2, 6154246, 41, 26, 4, '', '', '', '', 'INGABO-42174030', 1, '617802d7862fdd858100wio617802d789a9cnj617802d789aa3eu293038kkiz617802d789aa7', '2021-10-26 13:30:18'),
(3, 6154246, 41, 27, 5, '', '', '', '', 'INGABO-06251858', 1, '61790ab37f379d2362710wio61790ab37f392nj61790ab37f394eu2163363kkiz61790ab37f396', '2021-10-27 08:15:49'),
(4, 6155, 41, 27, 14, '', '', '', '', 'INGABO-42174030', 1, '61790d62ee59cd1838750wio61790d62ee5cdnj61790d62ee5cfeu2229798kkiz61790d62ee5d2', '2021-10-27 08:27:16'),
(5, 6155, 41, 27, 14, '', '', '', '', 'INGABO-42174030', 1, '61790df0cfa9cd3034330wio61790df0cfaacnj61790df0cfaadeu270990kkiz61790df0cfaaf', '2021-10-27 08:29:37'),
(6, 6155, 41, 26, 10, '', '', '', '', 'INGABO-42174030', 1, '61790e9a7c799d2838870wio61790e9a7c7c7nj61790e9a7c7caeu2131239kkiz61790e9a7c7cd', '2021-10-27 08:32:27'),
(7, 6155, 41, 27, 5, '', '', '', '', 'INGABO-38165736', 2, '61790f564e65bd2967130wio61790f564e676nj61790f564e67beu294485kkiz61790f564e682', '2021-10-27 08:35:35'),
(8, 6155, 41, 26, 5, '', '', '', '', 'INGABO-38165736', 2, '61790f564e65bd2967130wio61790f564e676nj61790f564e67beu294485kkiz61790f564e682', '2021-10-27 08:35:35'),
(9, 0, 41, 26, 53, '', '', '', '', 'INGABO-42174030', 1, '617a9f4fa10b8d664140wio617a9f4fa10c7nj617a9f4fa10c8eu252032kkiz617a9f4fa10ca', '2021-10-28 13:02:09');

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
  `sales_status` int(11) NOT NULL DEFAULT 0,
  `paid_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `fullname`, `phone`, `email`, `amount`, `tx_ref`, `verified`, `sales_status`, `paid_on`) VALUES
(1, 'ali tytyne', '0788804330', 'muhozagustave1213@gmail.com', 16800, '617802d7862fdd858100wio617802d789a9cnj617802d789aa3eu293038kkiz617802d789aa7', 0, 0, '2021-10-26 13:30:18'),
(2, 'MUHOZA Gustave', '0788804330', 'muhozagustave1213@gmail.com', 60000, '61790ab37f379d2362710wio61790ab37f392nj61790ab37f394eu2163363kkiz61790ab37f396', 0, 0, '2021-10-27 08:15:49'),
(3, 'ali tytyne', '0788804330', 'ishimwechristian71@gmail.com', 168000, '61790d62ee59cd1838750wio61790d62ee5cdnj61790d62ee5cfeu2229798kkiz61790d62ee5d2', 0, 0, '2021-10-27 08:27:16'),
(4, 'ali tytyne', '0788804330', 'ishimwechristian71@gmail.com', 168000, '61790df0cfa9cd3034330wio61790df0cfaacnj61790df0cfaadeu270990kkiz61790df0cfaaf', 0, 0, '2021-10-27 08:29:37'),
(5, 'ali tytyne', '0788804330', 'ishimwechristian71@gmail.com', 12000, '61790e9a7c799d2838870wio61790e9a7c7c7nj61790e9a7c7caeu2131239kkiz61790e9a7c7cd', 0, 0, '2021-10-27 08:32:27'),
(6, 'ali tytyne', '0788804330', 'ishimwechristian71@gmail.com', 66000, '61790f564e65bd2967130wio61790f564e676nj61790f564e67beu294485kkiz61790f564e682', 0, 0, '2021-10-27 08:35:35'),
(7, 'ali tytyne', '0788804330', 'muhozagustave1213@gmail.com', 63600, '617a9f4fa10b8d664140wio617a9f4fa10c7nj617a9f4fa10c8eu252032kkiz617a9f4fa10ca', 0, 0, '2021-10-28 13:02:09');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `descriptions` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `cat_id`, `descriptions`, `photo`, `creation_date`) VALUES
(41, 'MillMax', 3, 'm dfbndfjger erty89qhgwQIU 8YTGAGBHBV KJGBSIUuriuhgn', 'MillMax_3_1635233495.jpg', '2021-10-26 07:31:35'),
(42, 'JackMax', 3, 'asfsgsdgsf', 'JackMax_3_1635242217.jpg', '2021-10-26 09:56:57'),
(43, 'JackMax 2', 1, ',nebrekj', 'JackMax 2_1_1635339015.jpg', '2021-10-27 12:50:15'),
(44, 'Done', 1, 'fs', 'Done_1_1635340887.jpg', '2021-10-27 13:21:27');

-- --------------------------------------------------------

--
-- Table structure for table `products_size`
--

CREATE TABLE `products_size` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `stock` int(255) NOT NULL DEFAULT 0,
  `man_date` varchar(255) NOT NULL,
  `exp_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_size`
--

INSERT INTO `products_size` (`id`, `product_id`, `product_size`, `price`, `stock`, `man_date`, `exp_date`) VALUES
(26, 41, '500ML', '1200', 1280, '2021-10-08', '2021-10-01'),
(27, 41, '1L', '12000', 81, '2021-10-01', '2022-02-28'),
(29, 42, '500ML', '3000', 250, '2021-05-06', '2022-02-12'),
(31, 42, '250Gr', '3000', 154, '2022-04-30', '2021-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `stock_mgt`
--

CREATE TABLE `stock_mgt` (
  `id` int(11) NOT NULL,
  `ps_id` int(11) NOT NULL,
  `coop_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_mgt`
--

INSERT INTO `stock_mgt` (`id`, `ps_id`, `coop_id`, `stock`) VALUES
(4, 27, 1, 62),
(5, 26, 3, 1200),
(6, 26, 1, 80),
(7, 31, 1, 154),
(8, 29, 1, 250);

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
(1, 'Gustave', 'MUHOZA', 'muhozagustave1213@gmail.com', '0788804330', 'KG 655', '$2y$10$Te/O1LEIIfExr.GKFFOtXOEaxGS1Rm3lBpf97qtSSdo8IJMqKzZai', 1, 4, '2021-09-29 08:31:41', 'muhozagustave1213@gmail.com-617a5060adaaf617a5060adac0-617a5060adac6-617a5060adaca617a5060adacd617a5060adad2-617a5060adad7'),
(2, 'Gustave', 'MUHOZA', 'aba1remy@gmail.com', '0788804332', 'KG 655', '$2y$10$71tWRhAJPCl2MhMMMH.ms.MS4cVQi61ZaWp1UMW5TsfovgLGz.6wG', 0, 0, '2021-09-29 08:45:13', '615427998fe47'),
(3, 'ISHIWME', 'Christian', 'ishimwechristian71@gmail.com', '0788345538', 'Kn 34 Street, Kigali, Rwanda', '$2y$10$/jd2FfUhC0ucZ3JiE8GAReRQxROI/T5hC8Pj66w0HBQqFnbzNTFIS', 1, 3, '2021-09-30 14:30:22', '6155c9fe6ee841302716155c9fe6ee986155c9fe6ee9a780936155c9fe6ee9c'),
(7, 'tytyne', 'ali', 'mugus@gmail.com', '0781449311', 'kicukiro', '$2y$10$eHmAHEsvs1NHexp6sqASIuUCT9X.4GO903elqd1kSkmLmYC0SxGLK', 0, 3, '2021-10-11 07:46:47', '6163ebe74d96a1182846163ebe74d9826163ebe74d9831292846163ebe74d985'),
(8, 'Accountant', 'Test', 'test@gmail.com', '6128506070', 'KG 655', '$2y$10$1y.7AFEj7Ci/q4qoaKEA4ePlWkvEFCF1EuO3UPCcL6srbShOwh2Fi', 0, 2, '2021-10-11 08:34:10', '6163f7020ff462944476163f7020ff586163f7020ff592610206163f7020ff5a'),
(9, 'Prince', 'Rukundo', 'princerukundo@gmail.com', '0781237564', 'Gikondo, Kigali', '$2y$10$Qd4/2s9I0X8mcQr3ET1uRulYCnYOd177XaOTC1T5L1YdvGLVquS5.', 0, 0, '2021-10-15 13:44:27', '616985bb32e70294370616985bb32e81616985bb32e8384016616985bb32e85'),
(10, 'Prince', 'Rukundo', 'princerukundo@gmail.com', '0781237564', 'Gikondo, Kigali', '$2y$10$GeNNWduz1qwzTSB9JAoFV.PF1da38Oyw.VfaNzPl5Dvgth61Ot.xm', 1, 1, '2021-10-15 13:44:40', '616985c80617c109731616985c80618c616985c80618d174916616985c80618f');

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
(1, 0, 'Client'),
(2, 1, 'Agent'),
(3, 2, 'Accountant'),
(4, 3, 'Warehouse Keeper'),
(5, 4, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`,`product_id`),
  ADD KEY `ps_id` (`ps_id`),
  ADD KEY `coop_id` (`coop_id`),
  ADD KEY `product_id` (`product_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tx_ref` (`tx_ref`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `products_size`
--
ALTER TABLE `products_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `stock_mgt`
--
ALTER TABLE `stock_mgt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ps_id` (`ps_id`),
  ADD KEY `coop_id` (`coop_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `un_id` (`un_id`),
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
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cooperatives`
--
ALTER TABLE `cooperatives`
  MODIFY `coop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `farmer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `farmer_address`
--
ALTER TABLE `farmer_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `products_size`
--
ALTER TABLE `products_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `stock_mgt`
--
ALTER TABLE `stock_mgt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `userstatus`
--
ALTER TABLE `userstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`ps_id`) REFERENCES `products_size` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`coop_id`) REFERENCES `cooperatives` (`coop_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`un_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `stock_mgt`
--
ALTER TABLE `stock_mgt`
  ADD CONSTRAINT `stock_mgt_ibfk_1` FOREIGN KEY (`ps_id`) REFERENCES `products_size` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_mgt_ibfk_2` FOREIGN KEY (`coop_id`) REFERENCES `cooperatives` (`coop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`status_code`) REFERENCES `userstatus` (`status_code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
