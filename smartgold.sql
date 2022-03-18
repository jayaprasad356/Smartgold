-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2022 at 03:21 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

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
(1, 'prasad', 1, '26 uppukara street', '', 'sholapuram', 'Kumbakonam', '612503', 1);

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
(1, 'Ring', 'upload/images/0780-2021-12-25.jpg', 1),
(2, 'Chain', 'upload/images/4086-2021-12-25.jpg', 1);

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
(1, 70, 10);

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
(1, 'Reputed Shop'),
(2, 'Popular Shop'),
(3, 'Good');

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
(1, 1, 2, 5, 5, 5, 0, '2022-03-12'),
(2, 1, 2, 5, 5, 5, 0, '2022-03-15');

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

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `buy_method` varchar(30) NOT NULL,
  `status` varchar(200) NOT NULL,
  `delivery_charges` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `buy_method`, `status`, `delivery_charges`) VALUES
(1, 1, 1, 1, '2', 'received', 0);

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
  `status` varchar(200) DEFAULT NULL,
  `discounted_price` float NOT NULL,
  `price` float NOT NULL,
  `stock` int(5) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_approved` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `longitude` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `valid` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `name`, `store_name`, `email`, `mobile`, `password`, `store_url`, `logo`, `store_description`, `street`, `pincode`, `city`, `state`, `account_number`, `bank_ifsc_code`, `account_name`, `bank_name`, `status`, `last_updated`, `date_created`, `national_identity_card`, `address_proof`, `pan_number`, `latitude`, `longitude`, `valid`) VALUES
(1, 'Prasad BE', 'JP Mart', 'jp@gmail.com', '9876543210', 'e807f1fcf82d132f9bb018ca6738a19f', 'https://www.apple.com/in/', '1647014772.7646.png', 'scs dcdcd', 'east street', '612503', 'Kumbakonam', 'Tamil Nadu', '34325325235', 'TRGRGRGG', 'jp', 'Indian Bank', 1, '2022-03-13 16:57:00', '2021-12-24 19:08:33', '1647014694.2344.png', '1647057090.7513.png', '132342432', '434343', '45453', '2021-03-13'),
(2, 'safds', 'Test Shop', 'wre@gmail.com', '4343434', 'e10adc3949ba59abbe56e057f20f883e', '34332432', '1645933635.0093.png', '', 'east street', '612503', 'kumbakonam', 'Bihar', '34324324', '33432432', 'jp', 'cub', 1, NULL, '2022-02-27 03:47:15', '1645933635.011.png', '1645933635.0127.png', '3242143432', '32432432', '4324324', ''),
(3, 'Developer', 'Dev', 'dev@gmail.com', '9090909090', '25d55ad283aa400af464c76d713c07ad', '', '1646240879.5935.png', '', '', '612503', 'chennai', 'Andhra Pradesh', '', '', '', '', 1, NULL, '2022-03-02 17:07:59', '1646240879.5944.png', '1646240879.5954.png', '65674674', '0', '0', ''),
(4, 'Prasad', 'hi shop', 'jp@gmail.com', '8080808080', '93279e3308bdbbeed946fc965017f67a', '', '1646918191.9885.png', 'fdsfds', '', '613113', 'shjfdfds', 'Andhra Pradesh', '', '', '', '', 1, '2022-03-16 05:57:07', '2022-03-10 13:16:31', '1646918191.9892.png', '1646918191.9897.png', '1234567890', '0', '0', '2022-03-17'),
(5, 'Akash', 'Akash Shop', 'akash@gmail.com', '6060606060', '25d55ad283aa400af464c76d713c07ad', '', '1646919064.1564.png', '', '', '', '', '', '', '', '', '', 2, NULL, '2022-03-10 13:31:04', '1646919064.158.png', '1646919064.1599.png', '1234567890', '0', '0', ''),
(6, 'test', 'Test', 'test@gmail.com', '7070707070', 'e807f1fcf82d132f9bb018ca6738a19f', '', '1647335497.4464.png', '', '', '612503', 'kumbakonam', 'Tamil Nadu', '', '', '', '', 1, NULL, '2022-03-15 09:11:37', '1647335497.448.png', '1647335497.4495.png', '12346677766', '0', '0', '2022-03-25');

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
(1, 'Jaya Prasad', '8778624681', 'jayaprasad356@gmail.com');

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nickname`
--
ALTER TABLE `nickname`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offer_lock`
--
ALTER TABLE `offer_lock`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
