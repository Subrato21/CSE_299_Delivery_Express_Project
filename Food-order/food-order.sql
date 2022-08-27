-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2022 at 07:54 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(41, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(42, 'Subrato Chandra Pal', 'subrato', '5f50a940cbb783e7e0ed3cc9a9eb0271');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(19, 'Pizza', 'Food_Category_266.jpg', 'Yes', 'Yes'),
(30, 'Burger', 'Food_Category_133.jpg', 'Yes', 'Yes'),
(31, 'Pasta', 'Food_Category_196.jpg', 'No', 'Yes'),
(33, 'Ice Creame', 'Food_Category_287.jpg', 'Yes', 'Yes'),
(34, 'Momo', 'Food_Category_810.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(6, 'Pizza', 'Cheesy Pizza     ', '546.00', 'Food_Name_215.jpg', 19, 'Yes', 'Yes'),
(9, 'Burger', 'Mexican Burger  ', '343.00', 'Food_Name_160.jpg', 30, 'Yes', 'Yes'),
(10, 'Stawberry Ice Creame', 'Stawberry Ice Creame With Chocolate.   ', '234.00', 'Food_Name_54.jpeg', 33, 'No', 'Yes'),
(11, 'Pasta', 'Cheese Pasta', '322.00', 'Food_Name_523.jpg', 31, 'No', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Pizza', '546.00', 3, '1638.00', '2022-08-26 10:30:29', 'Ordered', 'Subrato Chandra Pal', '01564654664', 'subrato.pal@northsouth.edu', 'NSU Basundhara'),
(2, 'Dumpling', '178.00', 4, '712.00', '2022-08-26 10:36:09', 'Delivered', 'Subrato Chandra Pal', '01564654664', 'subrato.pal@northsouth.edu', 'NSU'),
(3, 'Burger', '343.00', 1, '343.00', '2022-08-26 10:37:10', 'Cancelled', 'Subrato Chandra Pal', '01564654664', 'subrato.pal@northsouth.edu', 'Khilgaon'),
(4, 'Stawberry Ice Creame', '234.00', 1, '234.00', '2022-08-26 10:39:30', 'Delivered', 'Subrato Chandra Pal', '01564654664', 'subrato.pal@northsouth.edu', 'Khilgaon ..'),
(5, 'Dumpling', '178.00', 4, '712.00', '2022-08-26 10:42:56', 'On Delivery', 'Subrato Chandra Pal', '01564654664', 'subrato.pal@northsouth.edu', 'NSU 8 Gate'),
(6, 'Stawberry Ice Creame', '234.00', 4, '936.00', '2022-08-26 05:46:42', 'Ordered', 'Subrato', '01564654664', 'subrato.pal@northsouth.edu', 'Basundhara');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_store_category`
--

CREATE TABLE `tbl_store_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_store_category`
--

INSERT INTO `tbl_store_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(2, 'Grocery', 'Store_Category_521.jpg', 'Yes', 'Yes'),
(3, 'Meat', 'Store_Category_348.jpg', 'Yes', 'Yes'),
(4, 'Medicine', 'Store_Category_640.png', 'Yes', 'Yes'),
(6, 'Snacks', 'Store_Category_7.png', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_store_food`
--

CREATE TABLE `tbl_store_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_store_food`
--

INSERT INTO `tbl_store_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(1, 'Chiken Meat', 'Bonless chicken meat', '435.00', 'Iteam_Name_93.jpg', 3, 'Yes', 'Yes'),
(2, 'Napa', 'Pain Reliver', '2.00', 'Iteam_Name_921.jpg', 4, 'Yes', 'Yes'),
(3, 'Oil', 'Kings Oil', '566.00', 'Iteam_Name_929.jpg', 2, 'Yes', 'Yes'),
(4, 'Doritos', 'Doritos Chips', '20.00', 'Iteam_Name_545.jpg', 6, 'No', 'Yes'),
(6, 'Beef', 'Premium Raw Beef Meat', '877.00', 'Iteam_Name_369.jpg', 3, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_store_order`
--

CREATE TABLE `tbl_store_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_store_order`
--

INSERT INTO `tbl_store_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Chiken Meat', '435.00', 1, '435.00', '2022-08-26 05:32:27', 'On Delivery', 'Subrato', '01564654664', 'subrato.pal@northsouth.edu', 'NSU University'),
(2, 'Oil', '566.00', 1, '566.00', '2022-08-26 05:33:10', 'Delivered', 'Subrato', '01564654664', 'subratochandrapal@gmail.com', 'NSU'),
(3, 'Beef', '877.00', 1, '877.00', '2022-08-26 05:34:28', 'Cancelled', 'Subrato', '01564654664', 'subrato.pal@northsouth.edu', 'Basundhara'),
(4, 'Napa', '2.00', 1, '2.00', '2022-08-26 05:47:24', 'Ordered', 'Subrato', '01564654664', 'subrato.pal@northsouth.edu', 'Basundhara Gate');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_store_category`
--
ALTER TABLE `tbl_store_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_store_food`
--
ALTER TABLE `tbl_store_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_store_order`
--
ALTER TABLE `tbl_store_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_store_category`
--
ALTER TABLE `tbl_store_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_store_food`
--
ALTER TABLE `tbl_store_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_store_order`
--
ALTER TABLE `tbl_store_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
