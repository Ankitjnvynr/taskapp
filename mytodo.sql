-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2023 at 05:48 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mytodo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(50) NOT NULL,
  `task` text NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending',
  `user_id` varchar(50) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task`, `status`, `user_id`, `dt`) VALUES
(9, 'The main content for the websire of anotehr', 'Done', '1', '2023-12-31 15:07:34'),
(20, 'My first TAsk forever', 'Done', '1', '2023-12-31 15:15:49'),
(23, 'this is my anoter tak ok its not varry\n', 'pending', '1', '2023-12-31 16:44:08'),
(24, 'The next task is ', 'pending', '1', '2023-12-31 20:42:07'),
(25, 'My first Task', 'pending', '1', '2023-12-31 22:07:45'),
(26, 'my frist task from 2nd id', 'pending', '13', '2023-12-31 22:08:57'),
(27, 'my second task from 2nd id', 'pending', '13', '2023-12-31 22:10:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `password`, `dt`) VALUES
(1, 'Ankit', 'ankitbkana@outlook.com', '$2y$10$DO9dfjSKcy/uCrN8dxqA/eUiTwDHbZJvLUO1DK4XAwvHAQXgLGIRS', '2023-12-31 20:23:58'),
(13, 'Ankit', 'ankitbkana@gmail.com', '$2y$10$BaNCrSnC542EeRChhwk.suF.ajZlHWmaoxuxGSNCzopDpwIwjMM3.', '2023-12-31 21:53:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
