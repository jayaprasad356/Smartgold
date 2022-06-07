-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2022 at 11:51 PM
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
  `default_address` tinyint(1) NOT NULL,
  `last_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `name`, `user_id`, `address`, `landmark`, `area`, `city`, `pincode`, `default_address`, `last_updated`, `date_created`) VALUES
(1, 'prasad', 1, '26 uppukara street', '', 'sholapuram', 'Kumbakonam', '612503', 1, NULL, '2022-04-07 11:13:23'),
(2, 'Vijay', 2, 'HQ9Q+HPM', '', 'HQ9Q+HPM, Ezhil Nagar, Keeranur, Tamil Nadu 622502, India', 'Keeranur', '622502', 0, '2022-05-29 09:25:10', '2022-04-07 11:13:23'),
(3, 'subha', 3, '438/95', 'temple', '438/95, G.V. Residency, Uppili Palayam, Coimbatore, Tamil Nadu 641015, India', 'Coimbatore', '641015', 1, '2022-05-29 09:27:00', '2022-04-07 11:13:23'),
(4, 'subha', 3, '71', '', 'Ezhil nagar old', 'keeranur', '622502', 0, '2022-06-01 20:11:25', '2022-04-07 11:13:23'),
(5, 'Office 2', 2, 'Tiruchirappalli', '', 'No 4/72 Supramaniyan Street Airport, Thirunagar, Tiruchirappalli, Tamil Nadu 620007, India', 'Tiruchirappalli', '620007', 0, '2022-05-21 05:06:11', '2022-04-07 11:13:23'),
(6, 'Jerusalen', 4, 'Jiron Jerusalen', '', 'Jr. Jerusalen, San Juan de Lurigancho 15408, Peru', 'San Juan de Lurigancho', '154085', 1, NULL, '2022-04-07 11:13:23'),
(7, 'Otra', 4, 'prueba', '', 'prueba', 'prueba', '123123', 0, NULL, '2022-04-07 11:13:23'),
(8, 'asdasd', 4, 'asdasdasdasd', '', 'asdasd', 'asdasd', '123123', 0, NULL, '2022-04-07 11:13:23'),
(9, 'Segunda direccion', 4, 'Direccion de prueba 2', 'Landmark prueba', 'Area de prueba', 'ciudad de prueba', '105231', 0, NULL, '2022-04-07 11:13:23'),
(10, 'Chandra', 5, 'T.Nagar', 'rathinagiri road', 'vilankurichi', 'Coimbatore', '641035', 1, NULL, '2022-04-16 10:20:14'),
(11, 'chandrasekar', 6, 'no1', 'Near Bharat gas', 'ammapalayam', 'Tirupur', '641652', 1, NULL, '2022-04-22 05:28:36'),
(12, 'Coimbatore Address', 2, '114/1', '', '114/1, Udayampalayam, Tamil Nadu 641028, India', 'Udayampalayam', '641028', 1, '2022-05-29 09:25:10', '2022-04-26 09:09:32'),
(13, 'venkat', 7, 'Tiruppur', 'near Bharath gas', 'NO.25. G.K.Tex St, Bridgeway Colony Extn., ( Backside Om Sakthi Kovil), Lakshmi Nagar, Thaneerpanthal, Anupparpalayam Pu', 'Avinashi', '641652', 0, '2022-04-28 07:17:56', '2022-04-28 05:55:41'),
(14, 'suba', 7, 'gv resi', 'back to fun mall', 'p n palayam', 'Coimbatore', '641015', 1, '2022-04-28 07:17:56', '2022-04-28 07:17:46'),
(15, 'test', 8, 'Unnamed Road', '', 'Unnamed Road, Gujarat 394345, India', 'Surat', '394345', 1, NULL, '2022-05-01 12:53:24'),
(16, 'sekar', 9, 'fkdnfld', 'shop', 'sha', 'kum', '454343', 1, '2022-05-21 05:03:57', '2022-05-07 08:09:44'),
(17, 'Care', 2, 'QJMR+GP9', '', 'QJMR+GP9, Trichy - Dindugal Rd, Tiruchirappalli, Tamil Nadu 620009, India', 'Tiruchirappalli', '620009', 0, NULL, '2022-05-10 11:24:41'),
(18, 'Vijay 2', 2, '4a', 'Kattess school', 'Ezhil Nagar', 'Keeranur', '622502', 0, NULL, '2022-05-18 13:30:58'),
(19, 'asda', 11, 'asdasd', '', 'asdasdasd', '12312312', '153333', 0, '2022-05-26 22:13:39', '2022-05-26 15:31:41'),
(20, 'asdasd', 11, 'County Road 3900', '', 'County Rd 3900, Independence, KS 67301, USA', 'Independence', '673011', 0, NULL, '2022-05-26 17:02:17'),
(21, 'Prueba', 11, 'Jirón Zorritos 721, Cercado de Lima 15082, Perú', '', 'Perú', 'Cercado de Lima', '15082', 0, '2022-06-02 00:36:10', '2022-05-26 19:30:44'),
(22, 'jjj', 11, 'Jirón Zorritos 721, Cercado de Lima 15082, Perú', '', 'Perú', 'Cercado de Lima', '15082', 0, NULL, '2022-05-26 19:32:41'),
(23, 'asdasd', 11, 'Jirón Zorritos 721, Cercado de Lima 15082, Perú', '', 'Perú', 'Cercado de Lima', '15082', 0, NULL, '2022-05-26 19:37:04'),
(24, 'hhhhhh', 11, 'Jirón Zorritos 721, Cercado de Lima 15082, Perú', '', 'Perú', 'Cercado de Lima', '15082', 0, NULL, '2022-05-26 19:37:59'),
(25, 'asdasdasdasd', 11, 'Jirón Zorritos 721, Cercado de Lima 15082, Perú', '', 'Perú', 'Cercado de Lima', '15082', 0, NULL, '2022-05-26 19:38:55'),
(26, 'aaa', 11, 'Jirón Zorritos 721, Cercado de Lima 15082, Perú', '', 'Perú', 'Cercado de Lima', '15082', 0, NULL, '2022-05-26 19:45:09'),
(27, 'asd', 11, 'Jirón Zorritos 721, Cercado de Lima 15082, Perú', '', 'Perú', 'Cercado de Lima', '15082', 0, NULL, '2022-05-26 19:46:30'),
(28, 'asdasd', 11, 'Jirón Zorritos 721, Cercado de Lima 15082, Perú', '', 'Perú', 'Cercado de Lima', '150821', 0, NULL, '2022-05-26 19:47:44'),
(29, 'My address', 11, '341', '', '341, near Amaravathipalayam, Varuthiangara Palayam, Seth Narang Das Layout, Peruntholuvu, Coimbatore, Tamil Nadu 641665,', 'Coimbatore', '641665', 0, '2022-06-02 15:53:34', '2022-05-26 22:13:27'),
(30, 'My', 11, '109u230210382193213', '293i2ooweo', '103773', 'lsa,dñlmasd', '102123', 0, NULL, '2022-05-27 14:29:34'),
(31, 'asda0000', 11, 'asdasd', 'undefined', 'asdasdasd', '12312312', '153333', 0, NULL, '2022-05-27 14:29:57'),
(32, 'Thane', 11, '7, Kolshet Rd, Thane West, Thane, Maharashtra, India', 'Prueba', 'India', 'Thane', '400606', 0, '2022-05-27 14:54:45', '2022-05-27 14:33:56'),
(33, 'My location', 11, 'Coimbatore North, Sivananda Colony, Tatabad, Coimbatore, Tamil Nadu 641001, India', '', 'India', 'Coimbatore', '641012', 0, NULL, '2022-06-02 00:38:03'),
(34, 'Coimbatore', 11, 'Venkitapuram', '', 'Venkitapuram, Tatabad, Coimbatore, Tamil Nadu, India', 'Coimbatore', '641665', 1, '2022-06-02 15:53:34', '2022-06-02 15:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `role` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `role`, `status`) VALUES
(13, 'Smart Gold Admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'Super Admin', 1),
(14, 'Manager', 'subhasubramanian2000@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'Admin', 1),
(15, 'Divakar', 'divakarvan03@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(10) NOT NULL,
  `imgUrl` varchar(200) NOT NULL,
  `last_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `imgUrl`, `last_updated`, `date_created`) VALUES
(1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRhrT-e8MqX-SSxA3pJVkYRpu3gcoccsVjPdw&usqp=CAUhttps://i.pinimg.com/originals/1e/5d/27/1e5d270c627074a21966cd113c3aa3d1.jpg', NULL, '2022-04-07 11:16:00'),
(2, 'https://jewelsbox.co/images/jewelsbox-banner-23-aug-2021.jpeg', NULL, '2022-04-07 11:16:00'),
(3, 'https://i.pinimg.com/originals/a1/83/7b/a1837bd992681c561de4985a48884f7a.jpg', NULL, '2022-04-07 11:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id` int(11) NOT NULL,
  `budget` varchar(200) NOT NULL,
  `last_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`id`, `budget`, `last_updated`, `date_created`) VALUES
(1, 'upto 1 lakh', NULL, '2022-04-07 11:20:02'),
(2, '1 lakh to 5 lakhs', NULL, '2022-04-07 11:20:02'),
(3, '5 lakhs to 10 lakhs', NULL, '2022-04-07 11:20:02'),
(4, 'above 10 lakhs', NULL, '2022-04-07 11:20:02'),
(5, 'Any Budget', NULL, '2022-05-09 17:22:52');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `last_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `last_updated`, `date_created`) VALUES
(57, 4, 8, 2, NULL, '2022-04-07 11:21:24'),
(58, 4, 9, 1, NULL, '2022-04-07 11:21:24'),
(69, 6, 40, 1, NULL, '2022-04-22 05:33:49'),
(78, 8, 1, 2, '2022-05-01 12:52:56', '2022-05-01 12:52:36'),
(79, 8, 13, 1, NULL, '2022-05-01 12:52:54'),
(80, 8, 39, 2, NULL, '2022-05-01 17:54:38'),
(82, 9, 15, 1, NULL, '2022-05-07 08:11:46'),
(97, 12, 22, 1, '2022-05-25 19:52:13', '2022-05-25 19:44:00'),
(102, 12, 14, 1, NULL, '2022-05-25 20:15:08'),
(104, 12, 12, 39, NULL, '2022-05-25 20:24:08'),
(120, 10, 1, 2, NULL, '2022-05-25 23:16:01'),
(121, 12, 29, 3, NULL, '2022-05-26 01:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `image` text NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `last_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `status`, `last_updated`, `date_created`) VALUES
(1, 'Ring', 'upload/images/0780-2021-12-25.jpg', 1, NULL, '2022-04-07 11:22:37'),
(2, 'Chain', 'upload/images/4086-2021-12-25.jpg', 1, NULL, '2022-04-07 11:22:37'),
(3, 'Ear Rings', 'upload/images/1649320567.5162.jpg', 1, NULL, '2022-04-07 11:22:37'),
(4, 'Bracelets', 'upload/images/1649320740.1485.jpg', 1, NULL, '2022-04-07 11:22:37'),
(5, 'Bangles', 'upload/images/1550-2022-04-02.jpg', 1, NULL, '2022-04-07 11:22:37'),
(6, 'Nose Pins', 'upload/images/8947-2022-04-03.jpg', 1, NULL, '2022-04-07 11:22:37'),
(7, 'Pendants', 'upload/images/2758-2022-04-03.jpg', 1, NULL, '2022-04-07 11:22:37'),
(8, 'MANGALSUTRA', 'upload/images/6452-2022-04-03.jpg', 1, NULL, '2022-04-07 11:22:37'),
(9, 'Necklaces', 'upload/images/5220-2022-04-03.jpg', 1, NULL, '2022-04-07 11:22:37'),
(10, 'Necklace Set', 'upload/images/4024-2022-04-03.png', 1, NULL, '2022-04-07 11:22:37'),
(11, 'Gold Coins', 'upload/images/7242-2022-04-03.jpg', 1, NULL, '2022-04-07 11:22:37'),
(12, 'Gift Card', 'upload/images/7563-2022-04-03.png', 1, NULL, '2022-04-07 11:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(10) NOT NULL,
  `title` text NOT NULL,
  `charges` int(3) NOT NULL,
  `days` int(3) NOT NULL,
  `last_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `title`, `charges`, `days`, `last_updated`, `date_created`) VALUES
(1, 'delivery', 100, 7, '2022-04-09 07:07:28', '2022-04-07 11:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `nickname`
--

CREATE TABLE `nickname` (
  `id` int(10) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `last_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nickname`
--

INSERT INTO `nickname` (`id`, `nickname`, `last_updated`, `date_created`) VALUES
(1, 'Reputed Shop', NULL, '2022-04-07 11:25:50'),
(2, 'Popular Shop', NULL, '2022-04-07 11:25:50'),
(3, 'Seller Nick', NULL, '2022-04-07 11:25:50'),
(4, 'Test Nick', NULL, '2022-04-07 11:25:50');

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
  `valid_date` varchar(20) NOT NULL,
  `claim_validity` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `last_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `seller_id`, `budget_id`, `gram_price`, `wastage`, `max_locked`, `status`, `valid_date`, `claim_validity`, `description`, `last_updated`, `date_created`) VALUES
(1, 3, 2, 4000, 100, 1, 1, '2022-03-10', '', '', NULL, '2022-04-07 11:28:04'),
(2, 3, 2, 3456, 20, 8, 1, '2022-03-28', '', '', NULL, '2022-04-07 11:28:04'),
(3, 9, 2, 200, 2, 4, 1, '2022-03-28', '', 'Ear rings, chains and bangles are available in latest design for locking', NULL, '2022-04-07 11:28:04'),
(4, 9, 1, 200, 3, 10, 1, '2022-03-31', '', 'Offer applicable on some of our latest designs (bangles, chains, ear rings etc)', NULL, '2022-04-07 11:28:04'),
(5, 9, 1, 200, 3, 10, 1, '2022-04-07', '', 'Offer applicable on some of our latest designs (Bangles, Chains, Ear Rings etc)', NULL, '2022-04-07 11:28:04'),
(6, 9, 1, 200, 3, 8, 1, '2022-04-01', '', 'Offer applicable on some of our latest designs (Bangles, Chains, Ear Rings etc)', NULL, '2022-04-07 11:28:04'),
(7, 9, 3, 100, 2, 14, 1, '2022-04-07', '', 'Offer valid on chains ONLY', NULL, '2022-04-07 11:28:04'),
(8, 9, 1, 100, 8, 8, 1, '2022-04-07', '', 'Offer applicable only on bangles.', NULL, '2022-04-07 11:28:04'),
(9, 9, 4, 150, 8, 14, 1, '2022-03-31', '', 'Offer applicable only on sets.', NULL, '2022-04-07 11:28:04'),
(10, 9, 4, 0, 2, 8, 1, '2022-04-02', '', 'Offer is applicable of Necklace Sets', NULL, '2022-04-07 11:28:04'),
(11, 1, 3, 5000, 5, 5, 1, '2022-04-08', '', 'fgfg', NULL, '2022-04-08 15:21:01'),
(12, 11, 1, 100, 2, 5, 1, '2022-04-29', '', '₹100 Discount per gram, 2% wastage discount upto 5 items', '2022-04-29 05:06:29', '2022-04-18 05:09:29'),
(13, 9, 4, 1000, 0, 1, 1, '2022-05-31', '', 'Chandra task 1 jimikki', '2022-05-18 18:23:57', '2022-04-23 14:59:21'),
(14, 9, 3, 200, 0, 2, 1, '2022-06-01', '', 'The offer is applicable on chains', '2022-05-18 18:23:31', '2022-04-26 08:24:12'),
(15, 9, 2, 100, 0, 8, 1, '2022-05-31', '', 'Offer is available on bangles', '2022-05-18 18:22:40', '2022-04-28 07:04:59'),
(16, 9, 1, 300, 5, 10, 1, '2022-06-10', '', 'test', '2022-06-02 18:12:08', '2022-05-07 08:26:58'),
(17, 9, 1, 133, 2, 33, 0, '2022-05-08', '', 'Offer valid only for rings', '2022-05-15 09:35:52', '2022-05-08 16:11:18'),
(18, 11, 1, 200, 4, 10, 1, '2022-05-09', '', '200 discount per gram, 4% on wastage upto 10 items.', NULL, '2022-05-09 12:37:38'),
(19, 1, 3, 34, 33, 4, 1, '2022-05-17', '', '4r4', NULL, '2022-05-17 14:54:32'),
(20, 1, 2, 4, 5, 5, 1, '2022-05-25', '', 'gr', NULL, '2022-05-17 14:55:48'),
(21, 9, 5, 500, 1, 50, 1, '2022-05-31', '', 'Offer applicable on chains only', '2022-05-30 07:50:37', '2022-05-21 08:58:41'),
(22, 9, 5, 222, 2, 6, 1, '2022-06-08', '', 'Rings only', '2022-06-02 18:12:50', '2022-05-21 12:45:54'),
(23, 9, 4, 700, 3, 8, 1, '2022-06-10', '', 'applicable on rings', '2022-06-02 18:11:51', '2022-05-24 19:56:42'),
(24, 9, 5, 200, 2, 5, 1, '2022-06-10', '', 'Only Rings', '2022-06-02 18:07:14', '2022-05-29 06:39:05'),
(25, 9, 3, 150, 1, 8, 1, '2022-06-09', '', 'Bangles', '2022-06-02 18:04:17', '2022-05-29 09:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `offer_lock`
--

CREATE TABLE `offer_lock` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `offer_id` int(10) NOT NULL,
  `lock_date` text DEFAULT NULL,
  `paid_amt` int(20) NOT NULL,
  `status` text DEFAULT NULL,
  `seller_product_name` text DEFAULT NULL,
  `seller_product_price` text DEFAULT NULL,
  `seller_description` text DEFAULT NULL,
  `last_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offer_lock`
--

INSERT INTO `offer_lock` (`id`, `user_id`, `offer_id`, `lock_date`, `paid_amt`, `status`, `seller_product_name`, `seller_product_price`, `seller_description`, `last_updated`, `date_created`) VALUES
(1, 3, 2, '2022-04-07 11:28 AM', 1000, 'Offer Locked', '', '', '', '2022-05-28 12:22:07', '2022-04-07 11:28:41'),
(2, 3, 2, '2022-04-07 11:28 AM', 1000, 'Offer Locked', '', '', '', '2022-05-28 12:22:29', '2022-04-07 11:28:41'),
(3, 2, 2, '2022-04-07 11:28 AM', 1000, 'Offer Locked', '', '', '', '2022-05-28 12:22:29', '2022-04-07 11:28:41'),
(4, 1, 11, '2022-04-16 08:37 AM', 500, 'Offer Claimed', 'Gold Chain', '50000', '', '2022-05-28 12:23:15', '2022-04-16 08:37:36'),
(5, 2, 1, '2022-04-18 05:44 AM', 500, 'Offer Locked', NULL, NULL, NULL, '2022-05-28 12:22:29', '2022-04-18 05:44:58'),
(6, 2, 12, '2022-04-23 07:37 AM', 500, 'Offer Locked', '', '', '', '2022-05-28 12:22:29', '2022-04-23 07:37:53'),
(7, 9, 16, '2022-05-07 08:28 AM', 500, 'Offer Locked', '', '', '', '2022-05-28 12:22:29', '2022-05-07 08:28:58'),
(8, 3, 17, '2022-05-08 04:13 PM', 500, 'Offer Locked', NULL, NULL, NULL, '2022-05-28 12:22:29', '2022-05-08 16:13:16'),
(9, 2, 18, '2022-05-09 12:42 AM', 500, 'Offer Locked', '', '', '', '2022-05-28 12:22:29', '2022-05-09 12:42:00'),
(10, 3, 16, '2022-05-15 11:06 AM', 500, 'Offer Locked', NULL, NULL, NULL, '2022-05-28 12:22:29', '2022-05-15 11:06:11'),
(11, 2, 16, '2022-05-21 02:58 PM', 500, 'Offer Locked', NULL, NULL, NULL, '2022-05-28 12:22:29', '2022-05-21 14:58:10'),
(12, 3, 24, '2022-05-29 09:35 AM', 500, 'Offer Claimed', '', '', '', '2022-05-29 09:39:17', '2022-05-29 09:35:32'),
(13, 3, 25, '2022-05-30 07:47 AM', 500, 'Offer Locked', NULL, NULL, NULL, NULL, '2022-05-30 07:47:07'),
(14, 3, 14, '2022-05-30 07:47 AM', 500, 'Offer Locked', NULL, NULL, NULL, NULL, '2022-05-30 07:47:52'),
(15, 3, 21, '2022-05-30 11:08 AM', 500, 'Offer Locked', NULL, NULL, NULL, NULL, '2022-05-30 11:08:03'),
(16, 11, 22, '2022-06-02 07:00 PM', 500, 'Offer Locked', NULL, NULL, NULL, NULL, '2022-06-02 19:00:34'),
(17, 11, 24, '2022-06-03 02:02 AM', 500, 'Offer Locked', NULL, NULL, NULL, NULL, '2022-06-03 02:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `offer_lock_status`
--

CREATE TABLE `offer_lock_status` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `last_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offer_lock_status`
--

INSERT INTO `offer_lock_status` (`id`, `title`, `status`, `last_updated`, `date_created`) VALUES
(1, 'Offer Claimed', 1, '2022-05-28 15:40:30', '2022-04-16 03:20:36'),
(2, 'Visited Store But not Purchased', 1, '2022-05-28 15:40:38', '2022-04-16 04:25:15'),
(3, 'Offer Missed', 0, '2022-05-28 15:40:44', '2022-04-16 08:27:32'),
(4, 'Buy Later', 1, '2022-05-28 15:40:47', '2022-04-16 08:38:52');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `product_id` int(10) NOT NULL,
  `order_date` text DEFAULT NULL,
  `quantity` int(10) NOT NULL,
  `buy_method` varchar(30) NOT NULL,
  `status` varchar(200) NOT NULL,
  `delivery_charges` float NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `total` float NOT NULL,
  `last_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `seller_id`, `product_id`, `order_date`, `quantity`, `buy_method`, `status`, `delivery_charges`, `payment_status`, `total`, `last_updated`, `date_created`) VALUES
(1, 1, 1, 1, '2022-04-07', 1, '2', 'Cancelled', 0, 'UnPaid', 0, '2022-05-24 16:07:45', '2022-04-07 11:29:49'),
(2, 3, 3, 4, '2022-04-07', 1, '2', 'Received', 0, '', 0, '2022-05-24 16:07:45', '2022-04-07 11:29:49'),
(3, 2, 3, 4, '2022-04-07', 1, '1', 'Received', 0, '', 0, '2022-05-24 16:07:45', '2022-04-07 11:29:49'),
(4, 2, 3, 4, '2022-04-07', 1, '2', 'Received', 0, '', 0, '2022-05-24 16:07:45', '2022-04-07 11:29:49'),
(5, 1, 3, 4, '2022-04-07', 1, '1', 'Completed', 0, 'Paid', 0, '2022-05-24 16:07:45', '2022-04-07 11:29:49'),
(6, 1, 3, 4, '2022-04-07', 1, '1', 'Received', 0, '', 0, '2022-05-24 16:07:45', '2022-04-07 11:29:49'),
(7, 1, 3, 4, '2022-04-07', 1, '1', 'Received', 0, 'Paid', 0, '2022-05-24 16:07:45', '2022-04-07 11:29:49'),
(8, 1, 3, 4, '2022-04-07', 1, '1', 'Received', 0, 'UnPaid', 0, '2022-05-24 16:07:45', '2022-04-07 11:29:49'),
(9, 3, 3, 4, '2022-04-07', 1, '2', 'Received', 0, 'UnPaid', 0, '2022-05-24 16:07:45', '2022-04-07 11:29:49'),
(10, 3, 3, 4, '2022-04-07', 1, '2', 'Received', 0, 'UnPaid', 0, '2022-05-24 16:07:45', '2022-04-07 11:29:49'),
(11, 3, 3, 4, '2022-04-07', 1, '1', 'Received', 0, 'UnPaid', 0, '2022-05-24 16:07:45', '2022-04-07 11:29:49'),
(12, 3, 3, 4, '2022-04-07', 1, '1', 'Received', 0, 'Paid', 0, '2022-05-24 16:07:45', '2022-04-07 11:29:49'),
(13, 4, 9, 6, '2022-04-07', 2, '1', 'Received', 0, 'UnPaid', 0, '2022-05-24 16:07:45', '2022-04-07 11:29:49'),
(14, 4, 3, 4, '2022-04-07', 2, '1', 'Received', 0, 'UnPaid', 0, '2022-05-24 16:07:45', '2022-04-07 11:29:49'),
(15, 4, 9, 5, '2022-04-07', 2, '1', 'Received', 0, 'UnPaid', 0, '2022-05-24 16:07:45', '2022-04-07 11:29:49'),
(16, 4, 9, 6, '2022-04-07', 2, '1', 'Received', 0, 'UnPaid', 0, '2022-05-24 16:07:45', '2022-04-07 11:29:49'),
(17, 4, 9, 5, '2022-04-07', 4, '1', 'Received', 0, 'UnPaid', 0, '2022-05-24 16:07:45', '2022-04-07 11:29:49'),
(18, 4, 3, 4, '2022-04-07', 2, '1', 'Received', 0, 'UnPaid', 0, '2022-05-24 16:07:45', '2022-04-07 11:29:49'),
(19, 4, 9, 6, '2022-04-07', 2, '2', 'Completed', 0, 'Paid', 0, '2022-05-24 16:07:45', '2022-04-07 11:29:49'),
(20, 4, 9, 5, '2022-04-07', 2, '2', 'Cancelled', 0, 'Paid', 0, '2022-05-24 16:07:45', '2022-04-07 11:29:49'),
(21, 5, 3, 4, '2022-04-16', 1, '1', 'Received', 100, 'Paid', 1000, '2022-05-24 16:08:35', '2022-04-16 10:24:02'),
(22, 5, 9, 32, '2022-04-16', 1, '1', 'Received', 100, 'UnPaid', 8000, '2022-05-24 16:08:35', '2022-04-16 10:25:49'),
(23, 5, 9, 33, '2022-04-16', 1, '1', 'Received', 100, 'UnPaid', 100000, '2022-05-24 16:08:35', '2022-04-16 10:25:49'),
(24, 5, 9, 35, '2022-04-16', 1, '1', 'Received', 100, 'UnPaid', 120000, '2022-05-24 16:08:35', '2022-04-16 10:25:49'),
(25, 6, 9, 22, '2022-04-22', 1, '1', 'Received', 100, 'UnPaid', 45000, '2022-05-24 16:10:17', '2022-04-22 05:28:53'),
(26, 6, 9, 12, '2022-04-22', 1, '1', 'Received', 100, 'Paid', 200000, '2022-05-24 16:10:22', '2022-04-22 05:30:06'),
(27, 6, 11, 41, '2022-04-22', 1, '2', 'Received', 100, 'Paid', 15360, '2022-05-24 16:10:24', '2022-04-22 05:32:04'),
(28, 5, 9, 42, '2022-04-23', 1, '1', 'Received', 100, 'Paid', 83600, '2022-05-24 16:10:32', '2022-04-23 15:08:32'),
(29, 2, 11, 41, '2022-04-23', 1, '1', 'Cancelled', 100, 'UnPaid', 15360, '2022-05-24 16:10:36', '2022-04-23 15:11:35'),
(30, 7, 11, 41, '2022-04-28', 1, '1', 'Received', 100, 'UnPaid', 15360, '2022-05-24 16:08:47', '2022-04-28 07:18:05'),
(31, 5, 9, 42, '2022-04-28', 1, '1', 'Received', 100, 'UnPaid', 83600, '2022-05-24 16:08:47', '2022-04-28 07:22:38'),
(32, 3, 1, 1, '2022-04-28', 1, '2', 'Received', 100, 'UnPaid', 20000, '2022-05-24 16:08:47', '2022-04-28 07:26:14'),
(33, 7, 9, 15, '2022-04-28', 1, '2', 'Received', 100, 'UnPaid', 43000, '2022-05-24 16:08:47', '2022-04-28 07:26:49'),
(34, 7, 9, 12, '2022-04-28', 1, '2', 'Received', 100, 'UnPaid', 200000, '2022-05-24 16:08:47', '2022-04-28 07:27:19'),
(35, 7, 9, 16, '2022-04-28', 1, '1', 'Received', 100, 'UnPaid', 45000, '2022-05-24 16:08:47', '2022-04-28 07:27:56'),
(36, 9, 9, 12, '2022-05-07', 1, '1', 'Received', 100, 'UnPaid', 200000, '2022-05-24 16:09:26', '2022-05-07 08:11:04'),
(37, 2, 11, 41, '2022-05-09', 1, '2', 'Received', 100, 'Paid', 15360, '2022-05-24 16:09:36', '2022-05-09 12:46:01'),
(38, 3, 9, 23, '2022-05-15', 1, '1', 'Completed', 100, 'Paid', 29700, '2022-05-24 16:09:48', '2022-05-15 11:11:46'),
(39, 3, 1, 1, '2022-05-19', 1, '1', 'Received', 100, 'UnPaid', 20000, '2022-05-24 16:09:57', '2022-05-19 21:49:57'),
(40, 3, 9, 5, '2022-05-19', 1, '1', 'Completed', 100, 'Paid', 1000, '2022-05-24 16:10:06', '2022-05-19 21:49:57'),
(41, 11, 1, 1, '2022-05-26', 1, '1', 'Received', 100, 'UnPaid', 20000, NULL, '2022-05-26 22:28:43'),
(42, 11, 9, 29, '2022-05-26', 3, '1', 'Received', 100, 'UnPaid', 75000, NULL, '2022-05-26 22:28:43'),
(43, 11, 1, 10, '2022-05-26', 2, '1', 'Received', 100, 'UnPaid', 60000, NULL, '2022-05-26 22:28:43'),
(44, 11, 9, 51, '2022-05-27', 12, '1', 'Received', 100, 'UnPaid', 4800000, NULL, '2022-05-27 14:23:56'),
(45, 3, 9, 25, '2022-05-29', 1, '2', 'Received', 100, 'UnPaid', 60000, NULL, '2022-05-29 06:25:00'),
(46, 3, 9, 14, '2022-05-29', 1, '2', 'Received', 100, 'UnPaid', 342000, NULL, '2022-05-29 06:25:00'),
(47, 3, 9, 47, '2022-05-29', 1, '2', 'Received', 100, 'UnPaid', 25000, NULL, '2022-05-29 06:25:00'),
(48, 3, 1, 1, '2022-05-29', 1, '2', 'Received', 100, 'UnPaid', 20000, NULL, '2022-05-29 06:25:00'),
(49, 3, 9, 6, '2022-05-29', 1, '2', 'Received', 100, 'UnPaid', 0, NULL, '2022-05-29 06:29:13'),
(50, 3, 9, 51, '2022-05-29', 1, '1', 'Received', 100, 'UnPaid', 400000, NULL, '2022-05-29 06:31:28'),
(51, 3, 1, 1, '2022-05-29', 1, '1', 'Received', 100, 'UnPaid', 20000, NULL, '2022-05-29 06:32:53'),
(52, 2, 11, 41, '2022-05-29', 1, '1', 'Received', 100, 'Paid', 15360, NULL, '2022-05-29 06:39:09'),
(53, 3, 9, 47, '2022-05-30', 1, '2', 'Received', 100, 'UnPaid', 25000, NULL, '2022-05-30 11:03:32'),
(54, 3, 9, 51, '2022-05-30', 1, '2', 'Received', 100, 'UnPaid', 400000, NULL, '2022-05-30 11:03:32'),
(55, 3, 9, 5, '2022-06-01', 1, '1', 'Received', 100, 'UnPaid', 1000, NULL, '2022-06-01 20:21:55'),
(56, 11, 1, 11, '2022-06-03', 3, '1', 'Received', 100, 'UnPaid', 15, NULL, '2022-06-03 02:12:25'),
(57, 11, 1, 1, '2022-06-03', 1, '1', 'Received', 100, 'UnPaid', 20000, NULL, '2022-06-03 02:12:25'),
(58, 11, 9, 51, '2022-06-03', 2, '1', 'Received', 100, 'UnPaid', 800000, NULL, '2022-06-03 02:12:25'),
(59, 11, 9, 15, '2022-06-03', 2, '1', 'Received', 100, 'UnPaid', 86000, NULL, '2022-06-03 02:12:25'),
(60, 11, 1, 1, '2022-06-03', 2, '1', 'Received', 100, 'Paid', 40000, NULL, '2022-06-03 02:13:15'),
(61, 11, 1, 1, '2022-06-03', 2, '1', 'Received', 100, 'UnPaid', 40000, NULL, '2022-06-03 02:23:08'),
(62, 11, 9, 51, '2022-06-03', 1, '1', 'Received', 100, 'Paid', 400000, NULL, '2022-06-03 02:24:17'),
(63, 11, 1, 1, '2022-06-03', 2, '1', 'Received', 100, 'Paid', 40000, NULL, '2022-06-03 02:30:09');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `validity` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `products` text DEFAULT NULL,
  `offers` text DEFAULT NULL,
  `access` text DEFAULT NULL,
  `last_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `validity`, `price`, `products`, `offers`, `access`, `last_updated`, `date_created`) VALUES
(1, 'Basic', '1', '10000', '100', '10', '2', NULL, '2022-04-16 12:37:05'),
(2, 'Basic', '3', '28000', '100', '10', '2', NULL, '2022-04-16 12:37:05'),
(3, 'Basic', '12', '100000', '100', '10', '2', NULL, '2022-04-16 12:37:05'),
(4, 'Deluxe', '1', '50000', '500', '15', '5', NULL, '2022-04-16 12:37:05'),
(5, 'Deluxe', '3', '135000', '500', '15', '5', NULL, '2022-04-16 12:37:05'),
(6, 'Deluxe', '12', '500000', '500', '15', '5', NULL, '2022-04-16 12:37:05'),
(7, 'Premium', '1', '100000', 'Unlimited', 'One a day', '10', NULL, '2022-04-16 12:37:05'),
(8, 'Premium', '3', '275000', 'Unlimited', 'One a day', '10', NULL, '2022-04-16 12:37:05'),
(9, 'Premium', '12', '1000000', 'Unlimited', 'One a day', '10', '2022-04-16 17:04:43', '2022-04-16 12:37:05');

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
  `status` tinyint(4) DEFAULT NULL,
  `discounted_price` float NOT NULL,
  `price` float NOT NULL,
  `stock` int(5) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_approved` int(11) DEFAULT NULL,
  `gender` text DEFAULT NULL,
  `weight` int(10) DEFAULT NULL,
  `last_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `seller_id`, `name`, `category_id`, `image`, `description`, `status`, `discounted_price`, `price`, `stock`, `date_added`, `is_approved`, `gender`, `weight`, `last_updated`, `date_created`) VALUES
(1, 1, 'Female  Beautiful Ring ', 1, 'upload/images/7789-2021-12-25.jpg', '', 1, 20000, 25000, 10, '2021-12-24 19:28:37', 1, 'Female', 4, '2022-04-08 05:06:28', '2022-04-07 11:30:49'),
(51, 9, 'Necklace', 9, 'upload/images/7881-2022-05-27.jpg', '', 1, 400000, 400000, 6, '2022-05-27 08:30:47', 1, 'Female', 35, NULL, '2022-05-27 08:30:47'),
(5, 9, 'Gold Ring', 1, 'upload/images/3649-2022-03-31.png', 'Stone ring', 1, 1000, 50000, 4, '2022-03-31 08:22:14', 1, NULL, NULL, '2022-04-08 05:06:48', '2022-04-07 11:30:49'),
(6, 9, 'Timeless 18 Karat Yellow Gold Bali-Style Hoop Earrings', 3, 'upload/images/4079-2022-03-31.jpg', 'These 18 Karat gold earrings feature two rings and a multi-faceted gold bead with tiny dots all over it strung on a smooth, easy-on-hinged gold hoop', 1, 0, 34000, 5, '2022-03-31 08:34:01', 1, NULL, NULL, '2022-04-08 05:06:48', '2022-04-07 11:30:49'),
(22, 9, 'Alluring Gold Chain', 2, 'upload/images/3713-2022-04-13.jpg', 'Lustrous Cable Chain set in 22 Karat Yellow Gold', 1, 45000, 45000, 8, '2022-04-13 16:11:17', 1, 'Female', 23, NULL, '2022-04-13 16:11:17'),
(10, 1, 'Jewel', 5, 'upload/images/6244-2022-04-03.jpg', 'vdfd', 1, 30000, 50000, 5, '2022-04-03 15:43:30', 1, 'Male', 5, '2022-04-08 05:06:48', '2022-04-07 11:30:49'),
(11, 1, 'Test', 5, 'upload/images/2154-2022-04-06.jpg', '', 1, 5, 5, 5, '2022-04-05 19:51:58', 1, 'Male', 5, '2022-04-11 12:06:08', '2022-04-07 11:30:49'),
(12, 9, 'Glitzy Gold Bangle', 5, 'upload/images/3116-2022-04-08.jpg', 'Wrap the beauty of fresh flowers around your wrist with this bangle crafted in 22 Karat Yellow Gold with a single stunning floral motif.', 1, 200000, 200000, 6, '2022-04-08 07:12:33', 1, 'Female', 35, NULL, '2022-04-08 07:12:33'),
(13, 9, 'Ornate 22 Karat Yellow Gold Etched Bangle', 5, 'upload/images/8517-2022-04-08.jpg', 'This luxurious 22 Karat yellow gold bangle features a stippled band etched with floral motifs, ending in a crown and orb with an embossed flower', 1, 435678, 435678, 20, '2022-04-08 07:27:17', 1, 'Female', 46, NULL, '2022-04-08 07:27:17'),
(14, 9, 'Slender 22 Karat Yellow Gold Orb Bangle', 5, 'upload/images/8262-2022-04-08.jpg', 'This 22 Karat yellow gold bangle features a polished orb flanked by 2 rings, with 4 triads of roped gold circlets arranged single file across the band', 1, 342000, 342000, 23, '2022-04-08 07:40:35', 1, 'Female', 45, NULL, '2022-04-08 07:40:35'),
(15, 9, 'Dazzling Rawa Work Gold Bangle', 5, 'upload/images/6749-2022-04-08.jpg', 'Add oppulence to your style when you pair your Traditional Wear with this Exquisite Rawa Work Bangle crafted in 22 Karat Yellow Gold.', 1, 43000, 43000, 6, '2022-04-08 07:56:45', 1, 'Female', 34, NULL, '2022-04-08 07:56:45'),
(16, 9, 'Detailed Rawa Work Floral Motif Gold Bangle', 5, 'upload/images/5067-2022-04-08.jpg', 'The Detailed Rawa Work on this Floral Motif Gold Bangle to add grace to your overall look', 1, 45000, 45000, 5, '2022-04-08 08:07:02', 1, 'Female', 26, NULL, '2022-04-08 08:07:02'),
(24, 9, 'Splendid Gold Chain', 2, 'upload/images/2481-2022-04-13.jpg', 'Gorgeous Beaded Chain with Enamelling set in 22 Karat Yellow Gold', 1, 29000, 29000, 21, '2022-04-13 16:18:04', 1, 'Female', 49, NULL, '2022-04-13 16:18:04'),
(23, 9, 'Traditional Patterned Gold Chain', 2, 'upload/images/9160-2022-04-13.jpg', 'Multi Pattern Chain set in 22 Karat Yellow Gold', 1, 29700, 30000, 20, '2022-04-13 16:14:39', 1, 'Female', 40, NULL, '2022-04-13 16:14:39'),
(20, 9, 'Delightful Yellow Gold Clover Jhumkas', 3, 'upload/images/9607-2022-04-09.jpg', 'These lovely 22 Karat Gold Jhumkas feature an etched, matte 3-petal stud suspending a bell with matte drops, roped frets and gold discs ending in a bead', 1, 10000, 10000, 39, '2022-04-09 16:09:49', 1, 'Female', 10, '2022-04-09 16:15:04', '2022-04-09 16:09:49'),
(21, 9, 'Gold Earrings for Women | Gold earrings for women, 22k gold earrings ', 3, 'upload/images/3632-2022-04-09.jpg', 'Gold Earrings for Women | Gold earrings for women, 22k gold earrings ', 1, 20000, 20000, 7, '2022-04-09 16:32:27', 1, 'Female', 14, NULL, '2022-04-09 16:32:27'),
(25, 9, 'Surreal Gold Chain', 2, 'upload/images/3822-2022-04-13.png', 'Eclectic Multi String Beaded Chain set in 22 Karat Yellow Gold', 1, 60000, 60000, 10, '2022-04-13 16:21:08', 1, 'Female', 35, NULL, '2022-04-13 16:21:08'),
(26, 9, 'Slender Gold Bracelet', 4, 'upload/images/4344-2022-04-13.jpg', 'Beaded bracelet with light rhodium finish set in 22 karat yellow gold. The textured beads add a surreal charm to this bracelet.', 1, 50000, 50000, 19, '2022-04-13 18:22:00', 1, 'Female', 14, NULL, '2022-04-13 18:22:00'),
(27, 9, 'Dainty Floral Gold Bracelet For Kids', 4, 'upload/images/5311-2022-04-14.jpg', 'Floral bracelet set in 22 karat yellow gold. Petite floral motifs add timeless charm to this bracelet.', 1, 44000, 44000, 8, '2022-04-13 18:38:36', 1, 'Female', 9, NULL, '2022-04-13 18:38:36'),
(28, 9, 'Glossy Knotted Gold Bracelet', 4, 'upload/images/9174-2022-04-14.jpg', 'Add the sheen of gold to your daily ensembles with this bracelet crafted in 22 Karat Yellow Gold.', 1, 13000, 13000, 7, '2022-04-13 18:39:41', 1, 'Female', 13, NULL, '2022-04-13 18:39:41'),
(29, 9, 'Marvellous Artistic Gold Bracelet', 4, 'upload/images/8576-2022-04-14.jpg', 'Teardrop bracelet set in 22 karat yellow gold. Wrap timeless beauty around your wrist with this classy bracelet.', 1, 25000, 25000, 50000, '2022-04-13 18:42:00', 1, 'Female', 6, '2022-04-13 18:44:28', '2022-04-13 18:42:00'),
(30, 9, 'Two Line Loose Black Bead And Gold Bracelet', 4, 'upload/images/5353-2022-04-14.jpg', 'Bracelet 22 Karat', 1, 24000, 24000, 24, '2022-04-13 18:43:09', 1, 'Female', 8, NULL, '2022-04-13 18:43:09'),
(31, 9, 'Majestic Exuberant Peacock Inspired Gold Nose Pin', 6, 'upload/images/7904-2022-04-14.jpg', 'Accent the magnificence of your occasion ensemble with this peacock inspired nose pin crafted in 22 karat yellow gold adorned with exuberant stones.', 1, 5000, 5000, 14, '2022-04-13 18:47:43', 1, 'Female', 3, NULL, '2022-04-13 18:47:43'),
(32, 9, 'Graceful Floral Gold And Diamond Nose Pin', 6, 'upload/images/8822-2022-04-14.jpg', 'Decorate yourself with the charm of flowers with this nose pin SET in 18 Karat Yellow Gold with diamonds in a floral motif. Stone Clarity SI2', 1, 8000, 8000, 7, '2022-04-13 18:50:54', 1, 'Female', 2, NULL, '2022-04-13 18:50:54'),
(33, 9, 'Captivating Diamond Nose Pin', 6, 'upload/images/6709-2022-04-14.jpg', 'Decorate yourself with the charm of flowers with this nose pin SET in 18 Karat Yellow Gold with diamonds in a floral motif. Stone Clarity SI2', 1, 100000, 100000, 2, '2022-04-13 18:53:51', 1, 'Female', 3, NULL, '2022-04-13 18:53:51'),
(34, 9, 'Gift An 18kt Gold Pendant To Your Special One', 7, 'upload/images/5365-2022-04-14.jpg', '', 1, 20000, 20000, 4, '2022-04-13 18:56:36', 1, 'Female', 16, NULL, '2022-04-13 18:56:36'),
(35, 9, 'Perfect Mangalsutra', 8, 'upload/images/1096-2022-04-14.jpg', 'Glamorous Diamond Mangalsutra', 1, 120000, 120000, 6, '2022-04-13 18:59:27', 1, 'Female', 80, NULL, '2022-04-13 18:59:27'),
(36, 9, '8 Gram 24 Karat Gold Coin With Ganesha-Lakshmi Motif', 11, 'upload/images/9564-2022-04-14.jpg', '8 Gram 24 Karat Gold Coin With Ganesha-Lakshmi Motif', 1, 50000, 50000, 8, '2022-04-13 19:02:11', 1, 'Female', 8, NULL, '2022-04-13 19:02:11'),
(37, 9, 'Farah Emerald And Ruby Necklace', 9, 'upload/images/4984-2022-04-14.jpg', 'Opulent Necklace set in 22 Karat Yellow Gold and studded with Emeralds and Rubies', 1, 350000, 350000, 17, '2022-04-14 07:20:32', 1, 'Female', 80, NULL, '2022-04-14 07:20:32'),
(38, 9, 'Radiant Floral Ruby Pendant With Chain And Earrings Set', 10, 'upload/images/7705-2022-04-14.png', 'Floral pendant with chain and earrings set with rubies and chakri diamonds set in 22 karat yellow gold. Dainty floral motifs make this an elegant set', 0, 400000, 400000, 5, '2022-04-14 07:22:41', 1, 'Female', 55, '2022-05-15 09:36:01', '2022-04-14 07:22:41'),
(39, 9, 'Thangam Gift Card', 12, 'upload/images/8999-2022-04-14.jpg', 'Gift Card', 1, 49500, 50000, 17, '2022-04-14 07:26:07', 1, 'Female', 1, NULL, '2022-04-14 07:26:07'),
(40, 9, 'SABARI Jewelry Gift Card', 12, 'upload/images/4383-2022-04-14.jpg', '', 1, 25000, 25000, 5, '2022-04-14 07:27:48', 1, 'Female', 1, '2022-05-28 10:39:29', '2022-04-14 07:27:48'),
(41, 11, 'DIAMOND PENDANT', 7, 'upload/images/9179-2022-04-18.png', 'Finding inspiration from the circle of life & love! Try on this chic gold pendant', 1, 15360, 16000, 5, '2022-04-18 05:00:46', 1, 'Unisex', 7, '2022-04-18 05:01:44', '2022-04-18 05:00:46'),
(42, 9, 'Chandra task1 jimikki', 3, 'upload/images/6669-2022-04-23.jpeg', 'Beautiful jimikkis for traditional look', 0, 83600, 88000, 10, '2022-04-23 14:55:36', 1, 'Female', 16, '2022-05-15 09:36:16', '2022-04-23 14:55:36'),
(43, 9, 'Wedding Gift Card', 12, 'upload/images/1956-2022-04-24.jpg', '', 1, 100000, 100000, 20, '2022-04-24 05:44:58', 1, 'Unisex', 0, NULL, '2022-04-24 05:44:58'),
(44, 9, 'Nose Pin', 6, 'upload/images/9792-2022-05-21.jpg', '', 1, 19800, 20000, 6, '2022-05-21 12:28:23', 1, 'Female', 5, NULL, '2022-05-21 12:28:23'),
(45, 9, 'Kasu malai', 2, 'upload/images/1055-2022-05-23.jpg', '', 1, 497500, 500000, 5, '2022-05-23 09:19:10', 1, 'Female', 50, NULL, '2022-05-23 09:19:10'),
(46, 9, 'Stone Ring', 1, 'upload/images/3212-2022-05-23.jpg', '', 1, 30000, 30000, 10, '2022-05-23 09:20:34', 1, 'Female', 8, NULL, '2022-05-23 09:20:34'),
(47, 9, 'Ring', 1, 'upload/images/2211-2022-05-23.jpg', '', 1, 25000, 25000, 7, '2022-05-23 09:22:37', 1, 'Female', 5, NULL, '2022-05-23 09:22:37'),
(48, 9, 'Stud', 3, 'upload/images/4412-2022-05-23.jpg', '', 1, 25000, 25000, 7, '2022-05-23 09:22:37', 1, 'Female', 5, '2022-05-23 09:26:11', '2022-05-23 09:22:37'),
(49, 9, 'Stone Bangle', 5, 'upload/images/4828-2022-05-25.jpg', '', 1, 198000, 200000, 8, '2022-05-24 19:53:46', 1, 'Female', 19, NULL, '2022-05-24 19:53:46'),
(50, 9, 'Necklace', 6, 'upload/images/6827-2022-05-25.jpg', '', 1, 300000, 300000, 8, '2022-05-24 19:55:35', 1, 'Female', 14, NULL, '2022-05-24 19:55:35'),
(52, 9, 'Mangalyam', 8, 'upload/images/8425-2022-05-29.jpg', 'Traditional and trendy!! ', 1, 50000, 50000, 8, '2022-05-29 05:37:29', 1, 'Female', 15, NULL, '2022-05-29 05:37:29'),
(53, 9, 'Gold Coin Peacock', 11, 'upload/images/8488-2022-05-29.jpg', 'Beautiful Peacock Design', 1, 98010, 99000, 5, '2022-05-29 05:57:42', 1, 'Unisex', 20, NULL, '2022-05-29 05:57:42'),
(54, 9, 'Necklace SEt', 10, 'upload/images/6331-2022-06-03.jpg', '', 1, 297000, 300000, 3, '2022-06-02 19:11:17', 1, 'Female', 50, NULL, '2022-06-02 19:11:17'),
(55, 9, 'Necklace Set', 10, 'upload/images/3284-2022-06-03.jpg', '', 1, 19800, 20000, 5, '2022-06-02 19:12:45', 1, 'Female', 50, NULL, '2022-06-02 19:12:45'),
(56, 9, 'Necklace Set', 10, 'upload/images/2837-2022-06-03.jpg', '', 1, 99, 100, 5, '2022-06-02 19:19:57', 1, 'Female', 50, NULL, '2022-06-02 19:19:57'),
(57, 9, 'Necklace Set', 10, 'upload/images/2072-2022-06-03.jpg', '', 1, 99, 100, 5, '2022-06-02 19:21:49', 1, 'Female', 40, NULL, '2022-06-02 19:21:49'),
(58, 1, 'fdfef', 2, 'upload/images/8505-2022-06-06.png', 'ht56', 1, 70, 200, 565, '2022-06-06 14:03:53', 1, 'Female', 4, NULL, '2022-06-06 14:03:53'),
(59, 1, 'trt', 2, 'upload/images/4273-2022-06-06.png', 'fdfrff', 1, 433.2, 456, 4, '2022-06-06 14:04:45', 1, 'Female', 10, NULL, '2022-06-06 14:04:45');

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
  `gst_number` text DEFAULT NULL,
  `latitude` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `longitude` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `valid` varchar(20) NOT NULL,
  `plan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `name`, `store_name`, `email`, `mobile`, `password`, `store_url`, `logo`, `store_description`, `street`, `pincode`, `city`, `state`, `account_number`, `bank_ifsc_code`, `account_name`, `bank_name`, `status`, `last_updated`, `date_created`, `national_identity_card`, `address_proof`, `pan_number`, `gst_number`, `latitude`, `longitude`, `valid`, `plan`) VALUES
(1, 'JP', 'Jewel Shop', 'jp@gmail.com', '9876543210', 'e807f1fcf82d132f9bb018ca6738a19f', 'https://www.apple.com/in/', '1648975386.2208.jpg', 'JPMart Gold Seller\r\n', 'Kalyan Jewellers, APHB Colony, Kukatpally, Hyderabad, Telangana 500072, India', '612503', 'Kumbakonam', 'Tamil Nadu', '34325325235', 'TRGRGRGG', 'jp', 'Indian Bank', 1, '2022-06-02 10:41:00', '2021-12-24 19:08:33', '1648975386.2216.jpeg', '1648975386.2221.jpg', 'GNQPD6996D', '1234', '17.4855015', '78.4105536', '2022-07-02', 'basic-monthly'),
(5, 'SuperGoldMart', 'Super Gold Mart', 'subha.sellimuthu@gmail.com', '9655790843', '25d55ad283aa400af464c76d713c07ad', '', '1648975535.6976.jpg', 'test', 'Coimbatore, Tamil Nadu 641015, India', '876653', 'cbe', 'Tamil Nadu', '', '', '', '', 1, '2022-04-03 08:45:35', '2022-03-17 13:19:33', '1648975535.701.jpeg', '1648975535.7018.jpg', '76439876', NULL, '11.0076142', '77.0132643', '2023-10-10', '0'),
(8, 'PD Shop', 'Shop', 'prasad@gmail.com', '8778624681', '25d55ad283aa400af464c76d713c07ad', '', '1648300727.0855.png', 'Test', 'test', '612503', 'Kumbakonam', 'Tamil Nadu', '', '', '', '', 2, '2022-04-05 19:24:52', '2022-03-26 13:18:47', '1648300727.086.png', '1648300727.0863.png', '23243454', NULL, '10.9601852', '79.3844976', '', NULL),
(9, 'Sabari Jewels', 'Sabari Jewels', 's_subha@hotmail.com', '9944017666', 'cc03e747a6afbbcbf8be7668acfebee5', 'https://www.facebook.com/Sabari-Diamonds-Jewels-299406417209839/', '1653294813.675.png', 'The best jewelry in the world', '1, east street', '641028', 'coimbatore', 'Tamil Nadu', '', '', 'admin@gmail.com', '', 1, '2022-05-28 10:27:05', '2022-03-27 08:20:46', '1648372706.0891.jpeg', '1648372706.0898.jpg', '7896549', '123456788990', '11.0126517', '77.0017465', '2023-05-27', 'premium-annually'),
(10, 'Chandra', 'Chand Jewellers', 'cppsgcas@gmail.com', '7204323367', '97da1ae5301b259baa5b080b71c47c18', '', '1650103619.7903.jpg', 'Unique designs an affordable cost', '1, cross cut street', '641012', 'Coimbatore', 'Tamil Nadu', '', '', 'admin@gmail.com', '', 0, '2022-06-02 20:42:58', '2022-04-16 10:06:59', '1650103619.7908.jpg', '1650103619.7912.jpg', 'AP1234543', '12345678', '-1', '14', '2023-05-27', 'deluxe-annually'),
(11, 'Vijay', 'Jos Alukkas', 'vjdeveloper2020@gmail.com', '9751665327', 'ba59d642c891bca824b843ed9986d958', 'https://www.josalukkasonline.com/', '1650256797.1784.jpg', 'A Tradition Of Fine Jewellery', 'Keezha raja Veedhi, Melaraja Vidi, Brindavan, Tamil Nadu 622001, India', '622001', 'Pudukkottai', 'Tamil Nadu', '1234567890', 'TEST1234', 'Vijay', 'Test Bank of India', 1, '2022-05-29 09:54:15', '2022-04-18 04:39:57', '1650256797.179.jpg', '1650256797.1793.jpg', 'AKKPI6289', '12345678', '10.3831671', '78.82189559999999', '2022-06-28', 'basic-monthly'),
(12, 'Suman Jewellery', 'Suman Jewellery', 'suman@gmail.com', '9751644898', 'cc03e747a6afbbcbf8be7668acfebee5', 'http://sumanjewellery.in/', '1653733159.3132.png', 'Finest collection encrusted with years and years of meticulous artistry and craftsmanship', '25, 11th St, Tatabad, Gandhipuram, Tamil Nadu 641012, India', '641012', 'Gandhipuram', 'Tamil Nadu', '112233445566', 'HDFC00012', 'admin@gmail.com', 'HDFC', 1, '2022-05-28 10:25:10', '2022-05-28 10:19:19', '1653733159.3136.jpeg', '1653733159.3139.jpg', 'AAAPZ1234C', '1865437839', '11.0179308', '76.9628209', '2023-05-27', 'premium-annually'),
(13, 'Sumangali Jewellers', 'Sumangali Jewellery', 'sumangali@gmail.com', '9655790854', 'cc03e747a6afbbcbf8be7668acfebee5', 'http://sumangalijewellery.in/', '1653804679.425.png', 'A leading and largest jewellery store', '380, Cross Cut Rd, near GRT Jewellers, Peranaidu Layout, Ram Nagar, Gandhipuram, Tamil Nadu 641012, India', '641012', 'Gandhipuram', 'Tamil Nadu', '', '', 'admin@gmail.com', '', 1, NULL, '2022-05-29 06:11:19', '1653804679.4254.jpeg', '1653804679.4257.jpg', 'AAAPZ1234D', '1865437839', '11.0168899', '76.96236499999999', '2023-05-28', 'premium-annually');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `days` int(10) NOT NULL,
  `last_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `price`, `days`, `last_updated`, `date_created`) VALUES
(1, 500, 1, '2022-05-09 16:26:35', '2022-04-07 11:31:45');

-- --------------------------------------------------------

--
-- Table structure for table `today_gold`
--

CREATE TABLE `today_gold` (
  `id` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `today_gold`
--

INSERT INTO `today_gold` (`id`, `price`) VALUES
(1, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `last_updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `email`, `last_updated`, `date_created`) VALUES
(1, 'Prasad', '8778624681', 'jayaprsad356@gmail.com', '2022-04-11 11:59:44', '2022-04-07 11:32:31'),
(2, 'Vijay Bhaskar', '9751665327', 'settaivijay@gmail.com', '2022-04-11 12:28:38', '2022-04-07 11:32:31'),
(3, 'subha', '9655790843', 'subha.sellimuthu@gmail.com', NULL, '2022-04-07 11:32:31'),
(4, 'Loki', '9751665328', 'loki@gmail.com', NULL, '2022-04-07 11:32:31'),
(5, 'chandra', '7204323361', 'cppsgcas@gmail.com', '2022-05-02 08:56:38', '2022-04-16 10:01:12'),
(6, 'chandrasekar', '9894910001', 'geekaygroups@gmail.com', '2022-05-02 08:55:59', '2022-04-16 13:26:10'),
(7, 'venkat', '7871207671', 'geekaygroups@gmail.com', '2022-05-02 08:56:12', '2022-04-28 05:42:37'),
(8, 'Ankit Gabani', '7096859504', 'gabani7004@gmail.com', NULL, '2022-05-01 12:52:25'),
(9, 'chandra sekar', '9894910000', 'geekaygroups@gmail.com', NULL, '2022-05-07 08:03:40'),
(10, 'asdasd', '7081309853', 'asdasd@gmail.com', NULL, '2022-05-21 20:45:33'),
(11, 'Prueba23', '9876543210', 'test@gmail.com', '2022-06-03 04:03:44', '2022-05-22 12:47:28'),
(12, 'Sara', '9444038834', 'sara@hotmail.com', NULL, '2022-05-25 19:28:41'),
(13, 'mkm', 'oiiuuyytr', 'tvvy@gmail.com', NULL, '2022-05-26 00:10:49'),
(14, 'mkm', 'oiiuuyytr0', '909vy@gmail.com', NULL, '2022-05-26 00:11:07'),
(15, 'sfsd', '0poiuytrew', 'asd@gmail.com', NULL, '2022-05-26 00:12:08'),
(16, 'PRueba', '8728963926', 'prueba@gmail.com', NULL, '2022-05-26 04:45:27'),
(17, 'Prueba', '7428730894', 'prueba@gmail.com', NULL, '2022-05-27 01:58:53'),
(18, 'Prueba', '7428731249', 'prueba@gmail.com', NULL, '2022-05-27 15:16:53'),
(19, 'Prueba', '7428723247', 'nuevo@gmail.com', NULL, '2022-05-27 19:57:05'),
(20, 'Junior', '7235083526', 'jmcf@gmail.com', NULL, '2022-05-27 20:02:23'),
(21, 'Krueba', '7237897654', 'kk@gmail.com', NULL, '2022-05-27 20:44:51'),
(22, 'KRUEBA2', '7707909733', 'Pruebaq@gmail.com', NULL, '2022-05-27 21:13:41'),
(23, 'Rpueba', '9506543991', 'rpeuba@gmail.com', NULL, '2022-06-03 16:23:42'),
(24, 'Prueba', '7617046325', 'prueba@gmail.com', NULL, '2022-06-03 17:07:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
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
-- Indexes for table `offer_lock_status`
--
ALTER TABLE `offer_lock_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
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
-- Indexes for table `today_gold`
--
ALTER TABLE `today_gold`
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nickname`
--
ALTER TABLE `nickname`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `offer_lock`
--
ALTER TABLE `offer_lock`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `offer_lock_status`
--
ALTER TABLE `offer_lock_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `today_gold`
--
ALTER TABLE `today_gold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
