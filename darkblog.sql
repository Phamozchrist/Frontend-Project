-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 17, 2025 at 10:13 PM
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
-- Database: `darkblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `email`, `password`, `created_on`, `updated_on`) VALUES
(1, 'sunday', 'micheal', 'admin@admin.com', '$2y$10$qJE39oW66J014dfeLfx97.pBLm242lW.EDs47ARYv0n7RzBHNlhqy', '2025-04-10 11:28:21', '2025-05-02 11:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Sport'),
(2, 'Politics'),
(3, 'Entertainment'),
(5, 'Fashion'),
(6, 'hhho');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_title` varchar(255) NOT NULL,
  `post_subtitle` varchar(255) NOT NULL,
  `post_details` text NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `post_category` int NOT NULL,
  `views` int NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_title`, `post_subtitle`, `post_details`, `post_image`, `post_category`, `views`, `created_on`, `updated_on`) VALUES
(4, 'The 20 greatest African footballers of all time', 'Africa has produced world-class football talents for generations, but who truly stands out among the best?', '<p id=\"isPasted\"><strong><span style=\"font-family: Tahoma, Geneva, sans-serif; font-size: 24px;\">Mohamed Salah is currently enjoying a historic season with Liverpool and he&rsquo;s already managed to break several records in the process.</span></strong></p><p>Following another assist against Newcastle, the Reds now sit 13 points clear at the top of the Premier League with 10 games to go.</p><p>&ldquo;I don&rsquo;t know. It is opinion,&rdquo; Salah told Sky Sports after the win over Manchester City last Sunday after being asked if he&rsquo;s currently playing better than ever.</p><p id=\"isPasted\">Following another assist against Newcastle, the Reds now sit 13 points clear at the top of the Premier League with 10 games to go.</p><p>&ldquo;I don&rsquo;t know. It is opinion,&rdquo; Salah told Sky Sports after the win over Manchester City last Sunday after being asked if he&rsquo;s currently playing better than ever.</p>', '3906.jpeg', 1, 0, '2025-05-08 12:21:45', '2025-08-03 00:07:01'),
(2, 'Supercomputer picks 2025 Champions League winner after Arsenal&#039;s big win', 'Opta&#039;s supercomputer has predicted the Champions League winner after Arsenal, Paris Saint-Germain, Barcelona, and Inter Milan booked their semi-final spots.', '&lt;p id=&quot;isPasted&quot; style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;font-family: Impact, Charcoal, sans-serif; font-size: 30px;&quot;&gt;Which teams are in Champions League semis?&lt;/span&gt;&lt;/p&gt;&lt;p&gt;Paris Saint-Germain and Barcelona were the first teams to reach the semi-finals. They secured their ties on Tuesday, April 15, despite a late score from Aston Villa and Borussia Dortmund.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;On Wednesday, Arsenal and Inter Milan booked their Champions League semi-final spots after their victories over Real Madrid and Bayern Munich.&lt;/p&gt;', '4001.jpeg', 1, 0, '2025-04-17 12:21:03', '2025-04-17 12:21:03'),
(3, 'Supercomputer picks Champions League winner after Arsenal&#039;s big win', 'Opta&#039;s supercomputer has predicted the Champions League winner after Arsenal, Paris Saint-Germain, Barcelona, and Inter Milan booked their semi-final spots.', '                                                    <p id=\"isPasted\" style=\"text-align: center;\"><span style=\"font-family: Impact, Charcoal, sans-serif; font-size: 30px;\">Which teams are in Champions League semis?</span></p><p>Paris Saint-Germain and Barcelona were the first teams to reach the semi-finals. They secured their ties on Tuesday, April 15, despite a late score from Aston Villa and Borussia Dortmund.</p><p><br></p><p>On Wednesday, Arsenal and Inter Milan booked their Champions League semi-final spots after their victories over Real Madrid and Bayern Munich.</p>                                                    ', '4424.jpg', 1, 0, '2025-04-17 12:22:31', '2025-05-02 11:36:53'),
(5, 'The 20 greatest African footballers of all time', 'Africa has produced world-class football talents for generations, but who truly stands out among the best?', '<p>hbd shfvjhdljhv sdflvvdfsvliksv&nbsp;</p>', '9981.jpeg', 2, 0, '2025-05-08 13:00:40', '2025-05-08 13:02:20');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
