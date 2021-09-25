-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2021 at 01:13 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imanual`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `complain_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `post_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `description`, `complain_time`, `post_id`, `from_user_id`) VALUES
(1, 'this is complaint about manual id3', '2021-04-25 12:10:42', 3, 3),
(2, 'this is complaint for postid2.', '2021-04-24 12:10:35', 2, 2),
(3, 'this is complaint for postid 2 from user3', '2021-04-25 12:09:01', 2, 3),
(4, '<p>this is complain from admin id 1</p>\r\n', '2021-04-25 14:51:27', 8, 1),
(5, '<p>the manual is not clear.</p>\r\n', '2021-04-25 15:08:28', 8, 1),
(6, '<p>the manual is dificult to read.</p>\r\n', '2021-04-25 15:10:41', 8, 5);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `device` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `upload_file` varchar(255) NOT NULL,
  `post_status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `user_id`, `device`, `body`, `upload_file`, `post_status`, `created_at`) VALUES
(1, 'pdf', 3, 'computer', '<p>sdfsadgdg</p>\r\n', 'PHP_Exam (1).pdf', 'requesting', '2021-04-19 08:33:49'),
(2, 'Computer Toshiba', 1, 'computer', '<p>this is toshiba computer manual.</p>\r\n', 'PHP_HT_week_3_eng.pdf', 'approved', '2021-04-19 13:33:54'),
(3, 'Post Three', 3, 'radio', '<p>this is radio manual.</p>\r\n', 'HTML_Practice_Module_2_Week_2_1555051717.pdf', 'approved', '2021-04-19 14:01:33'),
(8, 'Refridgerator Panasonic', 1, 'refrigerator', '<p>this is panasonic refrigerator manual. compatible with 12kg weight.</p>\r\n', 'HTML_HW_Module_5_6_Week_5_1555051876.pdf', 'approved', '2021-04-25 13:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `register_date`, `role`, `status`) VALUES
(1, 'Apple', 'everama520@gmail.com', 'teklim', '5f4dcc3b5aa765d61d8327deb882cf99', '2021-04-18 15:28:18', 'admin', 'unban'),
(2, 'Brad', 'chengdelin1@gmail.com', 'Tekl_ov88', '5f4dcc3b5aa765d61d8327deb882cf99', '2021-04-18 15:32:18', 'user', 'ban'),
(3, 'Christ', 'christ@gmail.com', 'user1', '24c9e15e52afc47c225b757e7bee1f9d', '2021-04-19 08:32:44', 'user', 'unban'),
(5, 'user2', 'user2@gmail.com', 'user2', '7e58d63b60197ceb55a1c487989a3720', '2021-04-25 15:09:41', 'user', 'unban');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
