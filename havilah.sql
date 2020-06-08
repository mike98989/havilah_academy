-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2020 at 04:39 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `havilah`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` tinytext NOT NULL,
  `last_name` tinytext NOT NULL,
  `department` int(11) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `address` tinytext NOT NULL,
  `state` tinytext NOT NULL,
  `country` tinytext NOT NULL,
  `whatsapp` varchar(25) NOT NULL,
  `mobile1` varchar(25) NOT NULL,
  `account_type` int(11) NOT NULL,
  `subscription_level` int(11) NOT NULL,
  `image` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `token` tinytext NOT NULL,
  `last_login` datetime NOT NULL,
  `signup_date` date NOT NULL,
  `signup_coords` tinytext NOT NULL,
  `user_confirm_id` varchar(25) NOT NULL,
  `user_recover_id` varchar(15) NOT NULL,
  `activated` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `department`, `gender`, `email`, `phone`, `address`, `state`, `country`, `whatsapp`, `mobile1`, `account_type`, `subscription_level`, `image`, `password`, `token`, `last_login`, `signup_date`, `signup_coords`, `user_confirm_id`, `user_recover_id`, `activated`, `status`) VALUES
(1, 'Michael', 'Akpobome', 1, 'Male', 'mike@test.com', '07060678275', 'Karu Abuja ', 'Delta', '', '', '', 3, 0, 'public/images/uploads/profile_images/default_avatar.jpg', '1a1dc91c907325c69271ddf0c944bc72', '0b0f580b63d3a2e6027f4912268f05529d74e8daa55956b5116078109ce71dd56a7b45219558d4dc647de869a7a99901d1211e5aefa9a0d4fe1eac86083152cb', '2020-06-07 03:21:56', '2019-09-12', '{\'latitude\':9.0765793,\'longitude\':7.4601162}', '58642', '388967', 1, 1),
(38, 'John', 'Doe', 2, 'Male', 'michael.akpobome@gmail.com', '07060678275', 'Karu Abuja', 'Fct', '', '', '', 0, 0, 'public/images/uploads/profile_images/default_avatar.jpg', '1a1dc91c907325c69271ddf0c944bc72', 'c656c5e83ab842fa13747f287e252c44819977ddd85e8a6a49430a95887fbdbb4bbaa86cfd8a8388b0b4b16335de1549c1e738bb593c1346b3e51c0d0158e9ce', '2020-05-18 15:52:59', '2020-04-29', '{\'latitude\':9.0078949,\'longitude\':7.5624717}', '63258', '', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
