-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2022 at 05:12 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ghulam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL DEFAULT 'images/adminprofile/avatar5.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `phone`, `password`, `profile`) VALUES
(1, 'Zahid Hussain', 'admin@gmail.com', '+923015014536', '123456', 'images/adminprofile/61f9b1bb26cf4adminprofile.png'),
(2, 'Talha Umar', 'talha@gmail.com', '0123456978', '12345', 'images/adminprofile/avatar5.png	');

-- --------------------------------------------------------

--
-- Table structure for table `bank_detail`
--

CREATE TABLE `bank_detail` (
  `id` int(11) NOT NULL,
  `b_name` varchar(255) NOT NULL,
  `b_title` varchar(255) NOT NULL,
  `b_account` varchar(255) NOT NULL,
  `b_reference` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank_detail`
--

INSERT INTO `bank_detail` (`id`, `b_name`, `b_title`, `b_account`, `b_reference`) VALUES
(1, 'Muslim Bank Limited.', 'Talha Umar', '033838373737', '0304767898');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(255) NOT NULL,
  `cate_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cate_name`) VALUES
(1, 'vivo'),
(3, 'mobile');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `subject`, `message`, `date_time`) VALUES
(1, 'Talha', 'tuc4373@gmail.com', 'Order', 'Please check my order status. Order number is #90880', '05/02/2022 - 12:45 PM');

-- --------------------------------------------------------

--
-- Table structure for table `description`
--

CREATE TABLE `description` (
  `id` int(11) NOT NULL,
  `desc_urdu` varchar(255) NOT NULL,
  `desc_englisj` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `description`
--

INSERT INTO `description` (`id`, `desc_urdu`, `desc_englisj`) VALUES
(2, ' کے بارے میں حوالہ سائٹ، اس کی ابتدا کے بارے میں معلومات فراہم کرنے کے ساتھ ساتھ ایک بے ترتیب لپسم جنریٹر\r\n', 'Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator');

-- --------------------------------------------------------

--
-- Table structure for table `newupdate`
--

CREATE TABLE `newupdate` (
  `id` int(11) NOT NULL,
  `update_date` date NOT NULL,
  `update_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newupdate`
--

INSERT INTO `newupdate` (`id`, `update_date`, `update_time`) VALUES
(3, '2022-02-24', '23:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `Method` varchar(255) NOT NULL,
  `TID` varchar(255) NOT NULL,
  `Paid_amount` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `pid`, `product_id`, `user_id`, `order_date`, `Method`, `TID`, `Paid_amount`, `status`) VALUES
(22, NULL, 7, 3, '2022-02-23', 'Jazzcash', '70869', '1300', 0),
(23, NULL, 6, 3, '2022-02-24', 'Easypaisa', '8888', '55', 1),
(24, NULL, 9, 3, '2022-02-24', 'Easypaisa', '34233213', '15000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `method` varchar(255) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `card_exp_month` text NOT NULL,
  `card_exp_year` text NOT NULL,
  `currency` text NOT NULL,
  `amount` text NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `product_id`, `method`, `card_number`, `card_exp_month`, `card_exp_year`, `currency`, `amount`, `txn_id`, `status`, `date`, `time`) VALUES
(1, 2, 10, 'Stripe', '4000056655665556', '12', '35', 'pkr', '50000', 'txn_3KRfySBZyq1XOWbv085Oo8NT', 'succeeded', '2022-02-10', '17:58:27'),
(2, 2, 8, 'Stripe', '4000056655665556', '09', '35', 'pkr', '29000', 'txn_3KRggeBZyq1XOWbv0NL8XW2x', 'succeeded', '2022-02-10', '18:44:07'),
(3, 3, 8, 'Stripe', '5555555555554444', '10', '29', 'pkr', '29000', 'txn_3KVc8LBZyq1XOWbv1pTRckXn', 'succeeded', '2022-02-21', '14:40:53'),
(4, 3, 7, 'Stripe', '5555555555554444', '11', '33', 'pkr', '130000', 'txn_3KVep6BZyq1XOWbv1H67WHDy', 'succeeded', '2022-02-21', '17:33:14'),
(5, 3, 7, 'Stripe', '5555555555554444', '10', '34', 'pkr', '130000', 'txn_3KVeqXBZyq1XOWbv0FJqMbUc', 'succeeded', '2022-02-21', '17:34:44'),
(6, 3, 7, 'Stripe', '6011111111111117', '11', '33', 'pkr', '130000', 'txn_3KVevGBZyq1XOWbv0A6f9QmA', 'succeeded', '2022-02-21', '17:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `cate_id` int(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `add_date` date NOT NULL,
  `status` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cate_id`, `product_code`, `product_price`, `product_img`, `add_date`, `status`) VALUES
(6, 1, 'Ab125', '55', 'images/products/61fd1b977d25cimages.png', '2022-02-08', 1),
(7, 3, 'mobile-223', '1300', 'images/products/61ffe08f403a5images.png', '2022-02-08', 1),
(8, 3, 'mobile-vivoy51', '29000', 'images/products/61ffe0c791332images.png', '2022-02-08', 1),
(9, 3, 'oppo-a37', '15000', 'images/products/61ffe0e898765images.png', '2022-02-08', 1),
(10, 3, 'samsung', '50000', 'images/products/61ffe10e5da58images.png', '2022-02-08', 1),
(11, 3, 'vivo-344', '9000', 'images/products/620a5ea581547images.png', '2022-02-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` int(11) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(222) NOT NULL,
  `terms` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `youtube`, `facebook`, `instagram`, `banner`, `twitter`, `email`, `whatsapp`, `terms`) VALUES
(2, 'youtube.com', 'facebook.com', 'instagram.com/', 'images/banner/621703e592854images.jpg', 'twitter.com', 'zahidmuna@gmail.com', 'web.whatsapp.com', 'Hello, I am Terms and Services. And... What?');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `OTP` int(4) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0,
  `register_date` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `email`, `phone`, `password`, `profile`, `OTP`, `status`, `register_date`) VALUES
(2, 'talha', 'Talha Umar', 'talha@gmail.com', '01322656452', '123456', 'img/userprofile/6204a24b04f67images.jpg', 2222, 1, '2022-02-02'),
(3, 'talhaumar', 'TalhaUmar', 'tuc4373@gmail.com', '03037495997', '1122', 'img/userprofile/620f7e4b629c8images.jpg', 3062, 1, '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_detail`
--
ALTER TABLE `bank_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `description`
--
ALTER TABLE `description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newupdate`
--
ALTER TABLE `newupdate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cate_key` (`cate_id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bank_detail`
--
ALTER TABLE `bank_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `description`
--
ALTER TABLE `description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `newupdate`
--
ALTER TABLE `newupdate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `cate_key` FOREIGN KEY (`cate_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
