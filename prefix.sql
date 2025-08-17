-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 17, 2025 at 10:12 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prefix`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `email`, `password`, `created_on`, `updated_on`) VALUES
(6, 'Stephen', 'Ifeoluwa', 'admin@admin.com', '$2y$10$7FNsrw7yFF6PoFN0gCscNeX4utFUEq12t0I2/bRPhW5U5ZqKAxYsO', '2025-07-26 19:39:19', '2025-07-26 19:39:19'),
(4, 'Famous', 'Stephen', 'stevofame15@gmail.com', '$2y$10$oj37uKtbFdoskpRJ5stL2udbtOTUfEeXZ9vqtESoI.QVDvzRjf3bi', '2025-07-26 19:34:48', '2025-07-26 19:34:48'),
(7, 'Emmanuel', 'Idegun', 'idegun@gmail.com', '$2y$10$jjG8mZgxwRgnGm3tToCVfeZmZ41dJCdPigty4BAdzUs/nHZ.KLKXG', '2025-07-26 19:40:26', '2025-07-26 19:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Flash Sales'),
(2, 'Top Deals'),
(3, 'Phone &amp; Tablets'),
(4, 'Clothing'),
(6, 'Small &amp; Cooking Appliances');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_item` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` int NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `p2p_posts`
--

DROP TABLE IF EXISTS `p2p_posts`;
CREATE TABLE IF NOT EXISTS `p2p_posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `p2p_posts`
--

INSERT INTO `p2p_posts` (`id`, `user_id`, `title`, `price`, `description`, `image`, `phone_number`, `created_on`, `updated_on`) VALUES
(1, 0, 'Samsung', '102', 'asgardgadrgdadvd', '1116.png', '0', '2025-08-04 01:24:31', '2025-08-04 01:24:31'),
(2, 0, 'Samsung', '102', 'asgardgadrgdadvd', '9000.png', '0', '2025-08-04 01:25:02', '2025-08-04 01:25:02'),
(3, 0, 'Samsung', '102', 'asgardgadrgdadvd', '5014.png', '0', '2025-08-04 01:25:36', '2025-08-04 01:25:36'),
(4, 0, 'Samsung', '102', 'asgardgadrgdadvd', '2109.png', '0', '2025-08-04 01:25:46', '2025-08-04 01:25:46'),
(5, 0, 'Samsung', '102', 'asgardgadrgdadvd', '6917.png', '0', '2025-08-04 01:25:51', '2025-08-04 01:25:51'),
(6, 0, 'Samsung', '102', 'asgardgadrgdadvd', '8927.png', '0', '2025-08-04 01:27:13', '2025-08-04 01:27:13'),
(7, 0, 'Samsung', '102', 'asgardgadrgdadvd', '9329.png', '0', '2025-08-04 01:27:23', '2025-08-04 01:27:23'),
(8, 0, 'Samsung', '102', 'asgardgadrgdadvd', '9524.png', '0', '2025-08-04 01:27:40', '2025-08-04 01:27:40'),
(9, 0, 'Samsung', '102', 'asgardgadrgdadvd', '8679.png', '0', '2025-08-04 01:27:58', '2025-08-04 01:27:58'),
(23, 1, 'Nobody', '3000', 'eqlhafkljvhakvnhdwkvhcccccccccccccccccccccccccccccccccccccccccclbh,jb', '5313.png', '07081338890', '2025-08-05 07:48:49', '2025-08-05 07:48:49'),
(21, 2, 'Syinix Electric Kettle-2.2L', '12345', 'hljhbfvadkbfva,dbf afvajdbfva,bhvavdjbvhLEBVHALDBVHKJABFVAKDBVHAVKVKAJBVAKBVHAKDFVHAIEUVHADLVHUADLGHALKJNDV;AHVADKLAJBLKHBG', '6663.png', '08934554332', '2025-08-04 03:58:01', '2025-08-04 03:58:01');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `product_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `product_discount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `product_details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `product_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `product_category` int NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_price`, `product_discount`, `product_details`, `product_image`, `product_category`, `created_on`, `updated_on`) VALUES
(7, 'XIAOMI', '1300', '20', '<p>aetrhysgdhsfh</p>', '6490.png', 1, '2025-07-17 13:50:04', '2025-07-17 13:50:04'),
(8, 'Nobody', '130', '80', '<p>ahstjdgdghg</p>', '2159.png', 1, '2025-07-18 13:38:55', '2025-07-18 13:38:55'),
(9, 'Ade', '130', '40', '<p>rtqrhyqrhyqrhryhwryhrharharart</p>', '4478.png', 1, '2025-07-18 13:39:55', '2025-07-18 13:39:55'),
(22, 'Redmi', '600', '50', '&lt;p&gt;gzfgzgfb&lt;/p&gt;', '8921.png', 4, '2025-07-30 00:36:20', '2025-07-30 00:36:20'),
(23, 'Ankara', '20000', '30', '&lt;p&gt;adggg&lt;/p&gt;', '1293.png', 4, '2025-07-30 02:25:22', '2025-07-30 02:25:22'),
(24, 'Ank', '13000', '20', '&lt;p&gt;aagatrf&lt;/p&gt;', '5831.png', 2, '2025-07-30 02:26:02', '2025-07-30 02:26:02'),
(25, 'XIAOMI', '1300', '40', '&lt;p&gt;Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quidem, vitae excepturi repellendus obcaecati facilis quisquam esse itaque dolore provident. Explicabo earum, neque odio omnis, sint libero maxime tempora, cum minus amet perspiciatis porr', '9038.png', 3, '2025-07-31 18:52:26', '2025-07-31 18:52:26'),
(12, 'tecno', '1300', '40', '<p>GDSDDFSGHHJMHNBZGHMH,JMHGDFZBGHG</p>', '2251.png', 1, '2025-07-29 22:20:59', '2025-07-29 22:20:59'),
(13, 'Redmi', '130', '40', '<p>sdhjgsfadsdfdgsfhdgh;lgjkfhjdghfg</p>', '5786.png', 1, '2025-07-29 22:23:36', '2025-07-29 22:23:36'),
(14, 'tecno', '130', '40', '<p>hvgfxfgvbj</p>', '9179.png', 1, '2025-07-29 22:25:03', '2025-07-29 22:25:03'),
(15, 'tecno', '1300', '40', '<p>gviyofxiyfviuobh</p>', '5401.png', 1, '2025-07-29 22:26:37', '2025-07-29 22:26:37'),
(16, 'tecno', '1300', '40', '<p>gviyofxiyfviuobh</p>', '3339.png', 1, '2025-07-29 22:26:38', '2025-07-29 22:26:38'),
(17, 'tecno', '130', '80', '<p>lhgcdgtxkhjkn</p><p>;knpgucigvkj;nkjbhjbk; &nbsp;hpb</p>', '2766.png', 1, '2025-07-29 22:28:16', '2025-07-29 22:28:16'),
(18, 'tecno', '130', '80', '<p>lhgcdgtxkhjkn</p><p>;knpgucigvkj;nkjbhjbk; &nbsp;hpb</p>', '9436.png', 1, '2025-07-29 22:28:16', '2025-07-29 22:28:16'),
(19, 'tecno', '130', '80', '<p>lhgcdgtxkhjkn</p><p>;knpgucigvkj;nkjbhjbk; &nbsp;hpb</p>', '2397.png', 1, '2025-07-29 22:28:17', '2025-07-29 22:28:17'),
(20, 'tecno', '130', '80', '<p>lhgcdgtxkhjkn</p><p>;knpgucigvkj;nkjbhjbk; &nbsp;hpb</p>', '7091.png', 1, '2025-07-29 22:28:17', '2025-07-29 22:28:17'),
(21, 'XIAOMI', '130', '80', '<p>gftfckjygkjbhbhy</p>', '1048.png', 1, '2025-07-29 22:30:24', '2025-07-29 22:30:24'),
(26, 'Syinix Electric Kettle-2.2L', '19000', '53', '<p>lllllllllllllllllllllllllllllllllllllllllllll</p>', '8026.jpg', 6, '2025-07-31 22:04:11', '2025-07-31 22:04:11');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `profile_pics` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `orders` int NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remember_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `profile_pics`, `email`, `password`, `address`, `orders`, `created_on`, `updated_on`, `remember_token`) VALUES
(1, 'Famous', 'Stephen', 'Phamozchrist', '', 'stevofame15@gmail.com', '$2y$10$8C2rD.oOjzCWhJ4o68UY0.A4Sl7aD93jP5fzyyPRIV3cNQIrPDvcW', '', 0, '2025-06-05 16:02:25', '2025-07-29 13:49:29', '$2y$10$nnCJY9ycxzknn8tbLCwm.OWsrIuzeC1j/f5Wu7NZslGfoAdJMqPEu'),
(2, 'Samuel', 'Anthony', 'Samtony', '', 'ojehvictor46@gmail.com', '$2y$10$LX/TEMX0Wyeu9P94ZFv6oOZHXQC1YqAp8WyN7BUOau45R1UKWH.sK', '', 0, '2025-06-05 17:10:02', '2025-06-08 07:27:49', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
