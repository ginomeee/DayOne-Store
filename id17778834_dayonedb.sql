-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2021 at 08:38 PM
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
-- Database: `id17778834_dayonedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `itemId`, `orderId`, `quantity`, `user`) VALUES
(1, 0, 0, 1, ''),
(2, 6, 0, 1, 'admin'),
(4, 9, 0, 1, 'admin'),
(5, 2, 0, 1, 'admin'),
(8, 12, 8, 2, 'ginomeee'),
(9, 7, 8, 4, 'ginomeee'),
(10, 8, 0, 1, ''),
(11, 9, 0, 1, 'admin'),
(12, 8, 8, 1, 'ginomeee'),
(13, 8, 8, 1, 'ginomeee'),
(29, 10, 29, 2, 'ginomeee'),
(30, 5, 29, 1, 'ginomeee'),
(31, 1, 29, 1, 'ginomeee'),
(32, 8, 30, 1, 'ginomeee'),
(33, 10, 30, 2, 'ginomeee');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item` varchar(50) NOT NULL,
  `description` varchar(280) NOT NULL,
  `price` int(11) NOT NULL,
  `img` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item`, `description`, `price`, `img`) VALUES
(1, 'tender juicyy', 'sobrang juicy netoo!', 210, 'hotdog.jpg'),
(2, 'hotdog', 'isang jumbo hatdog', 500, 'jollydog.jpg'),
(3, 'EOS M50', 'One of the best mirrorless cameras', 30000, 'm50.jpg'),
(4, 'Galaxy S20', 'The Flagship of the Galaxy line', 34999, 'gs20.jpg'),
(5, 'MX Master 3', 'The best of Logitech, the MX master', 4895, 'mx3.png'),
(6, 'TAG HEUER F1', 'Fine Swiss craftsmanship, the Tag Heuer F1 Batman Edition', 76000, 'tagf1.jpg'),
(7, 'Hamilton Khaki', 'The Hamilton Khaki watch is a classic that never goes out of style', 68900, 'hamilton.jpg'),
(8, 'Apple iPhone 13', 'The Most Powerful iPhone Yet comes with an improved camera', 79990, 'iphone13.jpg'),
(9, 'Canon 80D', 'Canons Best-Selling Prosumer DSLR Camera is here', 49900, 'eos80d.jpg'),
(10, 'ITee Shirt', 'Our best-selling IT themed dri-fit shirt, perfect for a run', 490, 'itee.jpg'),
(11, 'Communications Shirt', 'Wear your org in style with this DB Communications Shirt', 460, 'commstee.jpg'),
(12, 'Macbook Air 2020', 'Theres power in the Air. The Macbook Air M1 is finally here.', 69990, 'mbair.jpg'),
(13, 'Starbucks Tumbler', 'The limited edition Starbucks Tumbler. Perfect for your getaways.', 500, 'sb.webp');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `notes` text NOT NULL,
  `price` int(11) NOT NULL,
  `date_posted` varchar(30) NOT NULL,
  `time_posted` time NOT NULL,
  `date_edited` varchar(30) NOT NULL,
  `time_edited` time NOT NULL,
  `status` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `address` varchar(400) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `card` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `notes`, `price`, `date_posted`, `time_posted`, `date_edited`, `time_edited`, `status`, `user`, `address`, `fname`, `lname`, `card`) VALUES
(4, 'ab', 0, 'October 07, 2021', '10:18:16', 'October 17, 2021', '17:56:13', 1, '0', '', '', '', ''),
(5, 'toot', 0, 'October 07, 2021', '17:04:20', '', '00:00:00', 0, '0', '', '', '', ''),
(8, 'iphone13', 0, 'October 13, 2021', '21:42:26', '', '00:00:00', 0, 'admin', '', '', '', ''),
(30, '', 90686, 'October 17, 2021', '16:36:48', '', '00:00:00', 0, 'ginomeee', '123 Mapua St., Makati City', 'Eugenio Emmanuel', 'Araullo', '1234567890123456');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(320) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `usertype`) VALUES
(0, 'admin@dayone.media', 'admin', '$2y$10$yxnrmYuXre/2BmkbvQCHXOZ90i6GwCLlMAhqglTr5XHF80E6MPYii', 0),
(3, 'gino@dayone.media', 'ginomeee', '$2y$10$es0ZWGBhhubQ9sfQeMJE5uWv9izL9zb80dzdGOGENiPT9WYSpd5KW', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
