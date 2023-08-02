-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2022 at 11:02 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `awafi`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`) VALUES
(1, NULL),
(3, NULL),
(4, NULL),
(5, NULL),
(6, NULL),
(7, NULL),
(8, NULL),
(9, NULL),
(10, NULL),
(11, NULL),
(12, NULL),
(13, NULL),
(14, NULL),
(15, NULL),
(16, NULL),
(17, NULL),
(18, NULL),
(19, NULL),
(20, NULL),
(21, NULL),
(22, NULL),
(23, NULL),
(24, NULL),
(25, NULL),
(26, NULL),
(27, NULL),
(28, NULL),
(29, NULL),
(31, NULL),
(30, 1),
(32, 3),
(33, 4),
(34, 5);

-- --------------------------------------------------------

--
-- Table structure for table `cart_products`
--

CREATE TABLE `cart_products` (
  `id` int(11) NOT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `cart_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_products`
--

INSERT INTO `cart_products` (`id`, `pro_id`, `quantity`, `cart_id`) VALUES
(27, NULL, 1, NULL),
(28, NULL, 1, NULL),
(29, NULL, 1, NULL),
(35, NULL, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `photo`) VALUES
(1, 'Fast Food', 'cat-1.png'),
(2, 'Main Dishes', 'cat-2.png'),
(3, 'Drinks', 'cat-3.png'),
(4, 'Desserts', 'cat-4.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `_date` date DEFAULT current_timestamp(),
  `total_price` int(11) NOT NULL,
  `total_products` varchar(300) NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `acceptance` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `_date`, `total_price`, `total_products`, `cart_id`, `acceptance`) VALUES
(1, '2022-10-29', 100, 'pizza (20 x 5) - ', 30, '1'),
(2, '2022-11-01', 6000, 'aleahddd (6000 x 1) - ', 33, '2'),
(3, '2022-11-01', 8, 'juice (8 x 1) - ', 32, '2');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Usre');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `price` int(10) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `scat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`price`, `photo`, `description`, `id`, `name`, `scat_id`) VALUES
(13, '-5985474623254412467_120.jpg', 'Pizza with meat', 1, 'Pizza', 1),
(7, '-5985474623254412466_120.jpg', 'Pizza with vegetables', 2, 'Pizza', 1),
(10, '-5985474623254412473_120.jpg', 'Pizza with chicken & cheeses', 3, 'Pizza', 1),
(2, '-5985474623254412475_120.jpg', 'strawberry juice', 4, 'Juice', 19);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `description`, `photo`, `cat_id`) VALUES
(1, 'Pizza', '', 'home-img-1.png', 1),
(18, 'Burger', '', 'burger-1.png', 1),
(19, 'Juice', '', '-5985474623254412477_120.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` int(9) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT '4.jpg',
  `per_id` int(11) DEFAULT 2,
  `gender` varchar(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `phone`, `email`, `address`, `birth_date`, `password`, `image`, `per_id`, `gender`, `status`) VALUES
(1, 'Atrab', 771115555, 'atrab@gmail.com', 'hail st. sanaa', '2002-02-11', '$2y$10$jKvqGYrdQTBc6M/kxB997ePSmrmCzJGnCXqajCzXssQtbIEGY4Lz6', '4.jpg', 1, 'Famale', 1),
(3, 'aleah', 775054556, 'aleah1136@gmail.com', 'sanna', '1995-02-01', '$2y$10$UF3CirZ/iQ5ZOiaax4e9F.jxkhA2Z1lYt1HpyMRd00.YUkCuhrQky', '4.jpg', 2, 'Famale', 1),
(4, 'atrab', 777888999, 'atrab00@gmail.com', 'aaaaaa', '2002-02-22', '$2y$10$XYhQDbqTzjV8mMeXRNxqEeReGtp0GuYB/0kMrXNhmOesxI9p2kZ1.', '4.jpg', 1, 'Famale', 1),
(5, 'safa', 777444111, 'safa@gmail.com', 'aa', '2002-11-11', '$2y$10$mBScPGqs7DZlXzSn6z0O1uvnji2iAw2Yw27p2gG74EAcCnVlMSv3W', '4.jpg', 2, 'Famale', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_products`
--
ALTER TABLE `cart_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_fk` (`scat_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `per_fk` (`per_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `cart_products`
--
ALTER TABLE `cart_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `user_cart` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `cart_products`
--
ALTER TABLE `cart_products`
  ADD CONSTRAINT `cart_fkk` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pro_id` FOREIGN KEY (`pro_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `cart_` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `cat_fk` FOREIGN KEY (`scat_id`) REFERENCES `subcategories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcat_id` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `per_fk` FOREIGN KEY (`per_id`) REFERENCES `permission` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
