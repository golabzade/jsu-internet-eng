-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 30, 2024 at 09:11 PM
-- Server version: 8.0.31
-- PHP Version: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ie-project`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'طبیعی', 'آبشارها و دره های دیدنی و بسیار زیبای شهرستان دزفول.'),
(2, 'فرهنگی', 'مکان های تاریخی و فرهنگی شهرستان دزفول.');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `leader_id` int NOT NULL,
  `user_id` int NOT NULL,
  `score` tinyint NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`leader_id`,`user_id`),
  KEY `user_id` (`user_id`),
  KEY `leader_id` (`leader_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`leader_id`, `user_id`, `score`, `content`) VALUES
(1, 5, 2, 'اطلاعاتشون کم بود'),
(1, 8, 4, 'راضی بودم');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

DROP TABLE IF EXISTS `places`;
CREATE TABLE IF NOT EXISTS `places` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `name`, `image`, `description`, `category_id`) VALUES
(1, 'آبشار شوی', 'http://127.0.0.1:8000/assets/img/nature-1.jpg', 'توضیح درباره ابشار شوی', 1),
(2, 'روستای پامنار', 'http://127.0.0.1:8000/assets/img/nature-2.jpg', 'توضیحات روستای پامنار', 1),
(3, 'صوفی احمد', 'http://127.0.0.1:8000/assets/img/nature-3.jpg', 'توضیحات درباره صوفی احمد', 1),
(4, 'دریاچه شهیون', 'http://127.0.0.1:8000/assets/img/nature-4.jpg', 'توضیحات درباره دریاچه شهیون', 1),
(5, 'دره کول خرسون', 'http://127.0.0.1:8000/assets/img/nature-5.jpg', 'توضیحات درباره دره کول خرسون', 1),
(6, 'دره توبیرون', 'http://127.0.0.1:8000/assets/img/nature-6.jpg', 'توضیحات درباره دره توبیرون', 1),
(7, 'پل قدیم', 'http://127.0.0.1:8000/assets/img/culture-1.jpg', 'درباره پل قدیم', 2),
(8, 'سازه آبی', 'http://127.0.0.1:8000/assets/img/culture-2.jpg', 'درباره سازه آبی', 2),
(9, 'قنات قمش چوقابافان', 'http://127.0.0.1:8000/assets/img/culture-3.jpg', 'درباره قنات قمش چوقابافان', 2),
(10, 'گندی شاپور', 'http://127.0.0.1:8000/assets/img/culture-4.jpg', 'درباره گندی شاپور', 2),
(11, 'آرامگاه یعقوب لیث', 'http://127.0.0.1:8000/assets/img/culture-5.jpg', 'درباره آرامگاه یعقوب لیث', 2),
(12, 'حمام کرناسیون', 'http://127.0.0.1:8000/assets/img/culture-6.jpg', 'درباره حمام کرناسیون', 2),
(14, 'مسجد جامع', 'http://127.0.0.1:8000/assets/img/culture-7.jpg', 'درباره مسجد جامع', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tourleaders`
--

DROP TABLE IF EXISTS `tourleaders`;
CREATE TABLE IF NOT EXISTS `tourleaders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tourleaders`
--

INSERT INTO `tourleaders` (`id`, `name`, `phone`, `image`) VALUES
(1, 'محمد حکیمی', '09161234567', 'http://127.0.0.1:8000/assets/img/person-1.png'),
(2, 'مهدی فروتن', '09162345671', 'http://127.0.0.1:8000/assets/img/person-2.png'),
(3, 'شیرین هاشمیان', '09163456712', 'http://127.0.0.1:8000/assets/img/person-3.png'),
(4, 'بیتا نامجو', '09164567123', 'http://127.0.0.1:8000/assets/img/person-4.png'),
(5, 'احمد ذاکری', '09165671234', 'http://127.0.0.1:8000/assets/img/person-5.png'),
(6, 'ستایش توکلیان', '09166712345', 'http://127.0.0.1:8000/assets/img/person-6.png');

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

DROP TABLE IF EXISTS `tours`;
CREATE TABLE IF NOT EXISTS `tours` (
  `id` int NOT NULL AUTO_INCREMENT,
  `leader_id` int NOT NULL,
  `user_id` int NOT NULL,
  `date` date NOT NULL,
  `time` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tours_ibfk_1` (`leader_id`),
  KEY `tours_ibfk_2` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`id`, `leader_id`, `user_id`, `date`, `time`) VALUES
(1, 1, 5, '2024-01-31', '09-12'),
(2, 1, 8, '2024-01-30', '15-18'),
(3, 1, 5, '2024-01-09', '21-24'),
(4, 1, 5, '2024-02-04', '15-18'),
(5, 1, 5, '2024-02-04', '12-15'),
(6, 1, 5, '2024-02-04', '18-21'),
(7, 1, 5, '2024-02-04', '21-24'),
(8, 1, 5, '2024-02-04', '09-12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`) VALUES
(5, 'حسین', 'hosseing@chmail.ir', NULL, '$2y$10$GrnRp1r1FFWm9liEUzg6K.dEAYabHitRnr/QENAFKpuFPXDrTJCkK'),
(8, 'علی', 'adsljkfk@sajldkgn.com', NULL, 'asdafe'),
(9, 'محمد', 'sikdbhjgv@isbkdg.com', NULL, 'srgrghehertgh');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`leader_id`) REFERENCES `tourleaders` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `places`
--
ALTER TABLE `places`
  ADD CONSTRAINT `places_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `tours_ibfk_1` FOREIGN KEY (`leader_id`) REFERENCES `tourleaders` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `tours_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
