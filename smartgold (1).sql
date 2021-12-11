-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2021 at 04:26 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

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
  `pincode` varchar(10) NOT NULL,
  `default_address` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `name`, `user_id`, `address`, `landmark`, `area`, `city`, `pincode`, `default_address`) VALUES
(1, '', 1, 'fkdnfld', '', 'sholapuram', 'kum', '454343', 0),
(2, '', 1, 'fkdnfld', '', 'sholapuram', 'kum', '454343', 0),
(3, '', 1, 'fkdnfld', 'shop', 'sholapuram', 'kum', '454343', 0),
(4, 'fkwdk', 11, 'eifkskcc', 'shfkcck', 'dkcvosmw', 'dn kxmsmd', '156564', 0);

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
(1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRhrT-e8MqX-SSxA3pJVkYRpu3gcoccsVjPdw&usqp=CAUhttps://i.pinimg.com/originals/1e/5d/27/1e5d270c627074a21966cd113c3aa3d1.jpg'),
(2, 'https://jewelsbox.co/images/jewelsbox-banner-23-aug-2021.jpeg'),
(3, 'https://i.pinimg.com/originals/a1/83/7b/a1837bd992681c561de4985a48884f7a.jpg');

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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(1, 1, 2, 7),
(2, 1, 2, 5),
(4, 2, 5, 2),
(13, 9, 1, 1);

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
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(10) NOT NULL,
  `charges` int(3) NOT NULL,
  `days` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `charges`, `days`) VALUES
(1, 30, 6);

-- --------------------------------------------------------

--
-- Table structure for table `nickname`
--

CREATE TABLE `nickname` (
  `id` int(10) NOT NULL,
  `nickname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nickname`
--

INSERT INTO `nickname` (`id`, `nickname`) VALUES
(1, 'Reputed Shop');

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
(1, 1, 2, 34322, 5, 10, 1, '2021-10-14'),
(2, 2, 2, 34322, 5, 10, 1, '2021-10-14'),
(3, 3, 2, 34322, 5, 10, 1, '2021-10-14');

-- --------------------------------------------------------

--
-- Table structure for table `offer_lock`
--

CREATE TABLE `offer_lock` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `offer_id` int(10) NOT NULL,
  `paid_amt` int(20) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offer_lock`
--

INSERT INTO `offer_lock` (`id`, `user_id`, `offer_id`, `paid_amt`, `status`) VALUES
(1, 2, 1, 500, 'received'),
(2, 9, 2, 100, 'received'),
(3, 9, 2, 100, 'received'),
(4, 9, 2, 100, 'received'),
(5, 10, 2, 100, 'received');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `status` varchar(200) NOT NULL,
  `delivery_charges` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `status`, `delivery_charges`) VALUES
(4, 2, 1, 'received', 0),
(5, 2, 2, 'received', 0),
(6, 2, 3, 'received', 0);

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
(1, 1, 'Gold Bracelet', 3, 'upload/images/5834-2021-10-26.jpg', 'This is beautiful Gold bracelet for both male and female.made by india and manufacture at kolkata', 0, 40000, 45000, '2021-10-26 13:18:27', 1),
(2, 2, 'Ring', 2, 'upload/images/6243-2021-10-26.jpg', 'ring ', 0, 20000, 25000, '2021-10-26 13:44:12', 1),
(3, 1, 'Banglee', 2, 'upload/images/6243-2021-10-26.jpg', 'ring ', 0, 20000, 15000, '2021-10-26 13:44:12', 1);

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
(2, 'vijay', 'Vijay Shop', 'vijay@gmail.com', '9876543210', '25d55ad283aa400af464c76d713c07ad', '', '1635255762.5182.jpg', '', 'east street', '612694', 'kumbakonam', 'bihar', '', '', '', '', 1, '2021-10-30 08:47:20', '2021-10-26 13:42:42', '1635255762.536.jpg', '1635255762.5398.jpg', '278636273', '11.3410', '77.7172');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `days` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `price`, `days`) VALUES
(1, 1000, 7);

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
(8, 'vijay', '77654566777', 'vijay @gmail.com'),
(9, 'Vijay', '9751665327', 'settaivijay@gmail.com'),
(10, 'jaya prasad', '8778624681', 'jayaprasad356@gmail.com'),
(11, 'bharath', '9566006640', 'xjskckd');

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
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nickname`
--
ALTER TABLE `nickname`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer_lock`
--
ALTER TABLE `offer_lock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nickname`
--
ALTER TABLE `nickname`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `offer_lock`
--
ALTER TABLE `offer_lock`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
