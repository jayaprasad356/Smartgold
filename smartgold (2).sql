-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2021 at 11:58 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartgold`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_id` int(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `area` varchar(120) NOT NULL,
  `city` varchar(120) NOT NULL,
  `pincode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `name`, `user_id`, `address`, `landmark`, `area`, `city`, `pincode`) VALUES
(1, '', 1, 'fkdnfld', '', 'sholapuram', 'kum', '454343'),
(2, '', 1, 'fkdnfld', '', 'sholapuram', 'kum', '454343'),
(3, '', 1, 'fkdnfld', 'shop', 'sholapuram', 'kum', '454343');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(10) NOT NULL,
  `imgUrl` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `imgUrl`) VALUES
(1, 'https://www.geeksforgeeks.org/wp-content/uploads/gfg_200X200-1.png'),
(2, 'https://qphs.fs.quoracdn.net/main-qimg-8e203d34a6a56345f86f1a92570557ba.webp'),
(3, 'https://bizzbucket.co/wp-content/uploads/2020/08/Life-in-The-Metro-Blog-Title-22.png');

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id` int(11) NOT NULL,
  `budget` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`id`, `budget`) VALUES
(1, 'upto 1 lakh'),
(2, '1 lakh to 5 lakhs'),
(3, '5 lakhs to 10 lakhs'),
(4, 'above 10 lakhs');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `image` text NOT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `status`) VALUES
(2, 'Chain', 'upload/images/6346-2021-10-22.jpeg', 1),
(3, 'Bracelet', 'upload/images/4125-2021-10-22.jpeg', 1),
(5, 'Necklace', 'upload/images/6066-2021-10-26.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(50) NOT NULL,
  `seller_id` int(10) NOT NULL,
  `budget_id` int(10) NOT NULL,
  `gram_price` int(50) NOT NULL,
  `wastage` tinyint(2) NOT NULL,
  `max_locked` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `valid_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `seller_id`, `budget_id`, `gram_price`, `wastage`, `max_locked`, `status`, `valid_date`) VALUES
(1, 1, 2, 34322, 5, 10, 0, '2021-10-14'),
(2, 2, 2, 34322, 5, 10, 0, '2021-10-14'),
(3, 3, 2, 34322, 5, 10, 0, '2021-10-14');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `name` varchar(500) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `status` int(2) DEFAULT 1,
  `discounted_price` float NOT NULL,
  `price` float NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_approved` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `seller_id`, `name`, `category_id`, `image`, `description`, `status`, `discounted_price`, `price`, `date_added`, `is_approved`) VALUES
(1, 1, 'Gold Bracelet', 3, 'upload/images/5834-2021-10-26.jpg', 'None', 0, 40000, 45000, '2021-10-26 13:18:27', 1),
(2, 2, 'Ring', 2, 'upload/images/6243-2021-10-26.jpg', 'ring ', 0, 20000, 25000, '2021-10-26 13:44:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 DEFAULT NULL,
  `store_name` text CHARACTER SET utf8 DEFAULT NULL,
  `email` text CHARACTER SET utf8 DEFAULT NULL,
  `mobile` text DEFAULT NULL,
  `password` text CHARACTER SET utf8 NOT NULL,
  `store_url` text CHARACTER SET utf8 DEFAULT NULL,
  `logo` text CHARACTER SET utf8 DEFAULT NULL,
  `store_description` text CHARACTER SET utf8 DEFAULT NULL,
  `street` text CHARACTER SET utf8 DEFAULT NULL,
  `pincode` text DEFAULT NULL,
  `city` text DEFAULT NULL,
  `state` text CHARACTER SET utf8 DEFAULT NULL,
  `account_number` text CHARACTER SET utf8 DEFAULT NULL,
  `bank_ifsc_code` text CHARACTER SET utf8 DEFAULT NULL,
  `account_name` text CHARACTER SET utf8 DEFAULT NULL,
  `bank_name` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0,
  `last_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `national_identity_card` text CHARACTER SET utf8 DEFAULT NULL,
  `address_proof` text CHARACTER SET utf8 DEFAULT NULL,
  `pan_number` text CHARACTER SET utf8 DEFAULT NULL,
  `latitude` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `longitude` varchar(256) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `name`, `store_name`, `email`, `mobile`, `password`, `store_url`, `logo`, `store_description`, `street`, `pincode`, `city`, `state`, `account_number`, `bank_ifsc_code`, `account_name`, `bank_name`, `status`, `last_updated`, `date_created`, `national_identity_card`, `address_proof`, `pan_number`, `latitude`, `longitude`) VALUES
(1, 'Tamil Arasan', 'Tamil Shop', 'tamil@gmail.com', '9442071531', '25d55ad283aa400af464c76d713c07ad', '', '1635253717.1721.png', '<p>none</p>\r\n', 'east street', '643567', 'Kumbakonam', 'tamil nadu', '', '', '', '', 1, '2021-10-30 08:48:17', '2021-10-26 13:08:37', '1635253717.1757.jpg', '1635253717.1757.jpg', '948343989', '10.7905', '78.7047'),
(2, 'vijay', 'Vijay Shop', 'vijay@gmail.com', '9876543210', '25d55ad283aa400af464c76d713c07ad', '', '1635255762.5182.jpg', '', 'east street', '612694', 'kumbakonam', 'bihar', '', '', '', '', 1, '2021-10-30 08:47:20', '2021-10-26 13:42:42', '1635255762.536.jpg', '1635255762.5398.jpg', '278636273', '11.3410', '77.7172'),
(3, 'prasad', 'Vijay Shop', 'vijay@gmail.com', '9876543210', '25d55ad283aa400af464c76d713c07ad', '', '1635255762.5182.jpg', '', 'east street', '612694', 'kumbakonam', 'bihar', '', '', '', '', 1, '2021-10-30 08:47:20', '2021-10-26 13:42:42', '1635255762.536.jpg', '1635255762.5398.jpg', '278636273', '10.9602', '79.3845');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `email`) VALUES
(1, 'jp', '96752373427', 'jp@gmail.com'),
(2, 'prasad', '9809989099', 'jp1234@gmail.com'),
(3, 'hi', '872627282', 'hi@gmail.com'),
(4, 'hi', '8726272823', 'hi@gmail.com'),
(5, 'jp123', '97654445556', 'jvvp@gmail.com'),
(6, 'hvdfg', '97655555', 'jhh@gmail.com'),
(7, 'ramesh', '9765445667', 'ramesh@gmail.com'),
(8, 'vijay', '77654566777', 'vijay @gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
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
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
