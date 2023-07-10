-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 10, 2023 at 06:43 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_medyas`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `caption` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user`, `image`, `caption`, `created_at`, `updated_at`) VALUES
(2, 14, 'Scene_1.jpg', 'sdf', '2023-07-04 15:43:46', '2023-07-04 15:43:46'),
(3, 14, '2023-06-20_21-20.png', 'sdf', '2023-07-04 15:54:11', '2023-07-04 15:54:11'),
(4, 14, '2023-06-20_21-20.png', 'sdf', '2023-07-04 15:54:42', '2023-07-04 15:54:42'),
(5, 14, '2023-06-20_21-20.png', 'sdf', '2023-07-04 15:54:47', '2023-07-04 15:54:47'),
(6, 14, '2023-02-02_20-23.png', 'sdf', '2023-07-04 15:54:57', '2023-07-04 15:54:57'),
(7, 14, '2023-02-02_20-23.png', 'sdfasdasd', '2023-07-04 15:55:09', '2023-07-04 15:55:09'),
(8, 14, '2023-06-20_21-20_1.png', '123', '2023-07-04 16:45:13', '2023-07-04 16:45:13'),
(9, 14, '2023-06-20_21-20_1.png', '123', '2023-07-04 16:45:18', '2023-07-04 16:45:18'),
(10, 14, '2023-06-20_21-20.png', 'sdf', '2023-07-04 16:45:49', '2023-07-04 16:45:49'),
(11, 14, '2023-06-20_21-20.png', 'sdfsdf', '2023-07-04 16:46:09', '2023-07-04 16:46:09'),
(12, 14, '2023-06-20_21-20.png', 'sdfsdf123', '2023-07-04 16:46:23', '2023-07-04 16:46:23'),
(13, 14, '2023-06-20_21-20_1.png', '123dfg', '2023-07-04 16:47:06', '2023-07-04 16:47:06'),
(14, 14, '2023-06-20_21-20.png', '123', '2023-07-04 16:47:26', '2023-07-04 16:47:26'),
(15, 14, '2023-06-20_21-20_1.png', 'asdasd', '2023-07-05 01:57:07', '2023-07-05 01:57:07'),
(16, 14, '2023-06-20_21-20.png', 'sdfsd', '2023-07-05 02:04:00', '2023-07-05 02:04:00'),
(17, 14, '2023-06-20_21-20.png', 'sdf123123', '2023-07-05 02:05:40', '2023-07-05 02:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `posts_reacts`
--

CREATE TABLE `posts_reacts` (
  `id` int(13) NOT NULL,
  `user` int(13) NOT NULL,
  `post` int(13) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts_reacts`
--

INSERT INTO `posts_reacts` (`id`, `user`, `post`, `type`) VALUES
(5, 14, 14, 1),
(6, 14, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(13) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `photo`, `last_name`, `email`, `is_admin`, `password`, `created_at`, `updated_at`) VALUES
(13, 'asd', '2023-02-02_20-23.png', 'asd', 'asd@asd.com', 0, '$2y$10$FudWEo97D/JbQndSKtyYSO3UcoD8N0Di9LVWWtQGALM5rcifmLetO', '2023-07-03 04:04:44', '2023-07-04 16:25:18'),
(14, 'Cris', '2023-02-02_20-23.png', 'Fandino', 'sircnujnuj@gmail.com', 0, '$2y$10$LVxyLIPNNglNK.5A0bTR8OfTjb8sCGX0hDLjxfEsy.Z.kKFD2OOCG', '2023-07-03 04:31:10', '2023-07-04 16:25:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_ibfk_1` (`user`);

--
-- Indexes for table `posts_reacts`
--
ALTER TABLE `posts_reacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post` (`post`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `posts_reacts`
--
ALTER TABLE `posts_reacts`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts_reacts`
--
ALTER TABLE `posts_reacts`
  ADD CONSTRAINT `posts_reacts_ibfk_1` FOREIGN KEY (`post`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_reacts_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
