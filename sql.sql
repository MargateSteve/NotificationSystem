-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2017 at 12:15 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gitprojects`
--

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `message` text NOT NULL,
  `sent_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `sender`, `message`, `sent_time`) VALUES
(1, 0, 'erter', '2017-02-14 21:01:26'),
(2, 0, 'dfgdfgdfgdfg', '2017-02-14 21:01:49'),
(3, 1, 'sdasda', '2017-02-14 21:03:18'),
(4, 1, 'vvvvvv', '2017-02-14 21:03:43'),
(5, 1, 'werwe', '2017-02-14 21:07:51'),
(6, 1, 'werwe', '2017-02-14 21:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `notification_user`
--

CREATE TABLE `notification_user` (
  `id` int(11) NOT NULL,
  `message` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `sent` datetime DEFAULT '0000-00-00 00:00:00',
  `dismissed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification_user`
--

INSERT INTO `notification_user` (`id`, `message`, `user`, `sent`, `dismissed`) VALUES
(1, 1, 1, '2017-02-14 23:06:46', '2017-02-14 23:06:53'),
(2, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 3, 1, '2017-02-14 23:13:52', '2017-02-14 23:13:54'),
(5, 4, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 4, 1, '2017-02-14 23:13:54', '2017-02-14 23:13:58'),
(7, 6, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 7, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 5, 1, '2017-02-14 23:13:58', '2017-02-14 23:14:02'),
(10, 6, 1, '2017-02-14 23:14:02', '2017-02-14 23:14:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_user`
--
ALTER TABLE `notification_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `notification_user`
--
ALTER TABLE `notification_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;