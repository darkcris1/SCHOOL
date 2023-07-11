-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 11, 2023 at 06:49 PM
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

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`subject`, `message`, `email`, `id`) VALUES
('asdasd', 'asdasdasd', 'asdasd@email.com', 1),
('asdasd', 'asdasd', 'asdasd@asd.asd', 2);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `type` int(13) NOT NULL,
  `image` varchar(255) NOT NULL,
  `caption` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user`, `type`, `image`, `caption`, `created_at`, `updated_at`) VALUES
(19, 20, 2, '2023-06-20_21-20.png', 'sdfsdfsdf', '2023-07-11 15:00:47', '2023-07-11 15:00:47'),
(20, 20, 1, '2023-06-20_21-20.png', 'asdasdasd234324234234324', '2023-07-11 15:05:03', '2023-07-11 16:01:40'),
(21, 20, 1, '2023-06-05_11-56.png', 'sdfsdf2342345464564562', '2023-07-11 16:07:51', '2023-07-11 16:09:15');

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

-- --------------------------------------------------------

--
-- Table structure for table `posts_type`
--

CREATE TABLE `posts_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts_type`
--

INSERT INTO `posts_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Promotion', '2023-07-11 14:44:18', '2023-07-11 14:44:18'),
(2, 'Entertainment', '2023-07-11 14:44:38', '2023-07-11 14:44:38');

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
(20, 'asdasd', '2023-06-05_11-56.png', 'asdasd', 'asdasd@email.com', 0, '$2y$10$897fgUnYvuMn6MRI6nafzeLefjw25xhECpJYwp6x40SgBnquq1T3K', '2023-07-11 14:59:40', '2023-07-11 14:59:40'),
(21, 'admin', '2023-06-20_21-20.png', 'admin', 'admin@email.com', 1, '$2y$10$HaNVV1ZcoQ0WyXEXzDFI0eLNh3gjM3imU4evL4M7v2x/eaAr6TeCC', '2023-07-11 16:28:46', '2023-07-11 16:28:57');

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
  ADD KEY `posts_ibfk_1` (`user`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `posts_reacts`
--
ALTER TABLE `posts_reacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post` (`post`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `posts_type`
--
ALTER TABLE `posts_type`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `posts_reacts`
--
ALTER TABLE `posts_reacts`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts_type`
--
ALTER TABLE `posts_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`type`) REFERENCES `posts_type` (`id`) ON DELETE CASCADE;

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
