-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2022 at 02:37 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forums`
--

-- --------------------------------------------------------

--
-- Table structure for table `forum_category`
--

CREATE TABLE `forum_category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_category`
--

INSERT INTO `forum_category` (`category_id`, `name`, `description`) VALUES
(1, 'PHP Tutorial', 'Category about PHP tutorial'),
(2, 'Java Tutorial', 'Tutorial about Java.'),
(3, 'General Discussion', 'This category is for general discussion.'),
(4, 'Programming', 'This category is for programming discussions.'),
(5, 'Web Design Discussions', 'This is for web design discussions.'),
(7, 'Support', 'its about support');

-- --------------------------------------------------------

--
-- Table structure for table `forum_owner`
--

CREATE TABLE `forum_owner` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_owner`
--

INSERT INTO `forum_owner` (`id`, `username`, `email`, `password`, `created`) VALUES
(1, 'david', 'david@webdamn.com', '202cb962ac59075b964b07152d234b70', '2021-12-29');

-- --------------------------------------------------------

--
-- Table structure for table `forum_posts`
--

CREATE TABLE `forum_posts` (
  `post_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_posts`
--

INSERT INTO `forum_posts` (`post_id`, `message`, `topic_id`, `user_id`, `name`, `created`) VALUES
(1, '<p>In this tutorial we will explain how to develop your own discussion forum system with PHP and MySQL. We have created a running forum example in this tutorial and can download complete example code to enhance this to create own forum.&nbsp;</p>\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\"><strong>&nbsp;</strong></div>', 2, 1, '', '2020-06-26 04:16:17'),
(2, '<p data-children-count=\"0\">&nbsp;</p>\n<p data-children-count=\"0\">&nbsp;</p>\n<p data-children-count=\"0\">whatsss</p>\n<p data-children-count=\"0\">yyyyyyyy</p>', 2, 2, '', '2020-06-27 06:14:14'),
(5, '<p>test comment</p>', 2, 2, '', '0000-00-00 00:00:00'),
(6, '<p>test comment</p>', 2, 2, '', '0000-00-00 00:00:00'),
(7, '<p>test comment</p>', 2, 2, '', '0000-00-00 00:00:00'),
(8, '<p>test</p>', 2, 2, '', '0000-00-00 00:00:00'),
(9, '<p>,hkh</p>', 2, 2, '', '0000-00-00 00:00:00'),
(10, '<p>ddwedwe</p>', 2, 2, '', '0000-00-00 00:00:00'),
(1792, '<p>ssdgsdg</p>', 8, 2, '', '0000-00-00 00:00:00'),
(1793, '<p>dfsdgsd</p>', 9, 2, '', '0000-00-00 00:00:00'),
(1794, '<p>we will talk about&nbsp;the web design trends in 2021</p>', 10, 2, '', '2021-12-26 16:33:29'),
(1795, '<p>yes we will discuss trends of future.</p>', 10, 2, '', '2021-12-26 16:33:29'),
(1796, '<p>really !</p>', 10, 2, '', '2021-12-26 17:43:02'),
(1797, '<p>hey guyss.</p>', 10, 2, '', '2021-12-26 17:56:12'),
(1798, '<p>xfgdfhdfhdf</p>', 10, 2, '', '2021-12-26 17:58:28'),
(1799, '<p>cxbcbcxb</p>', 10, 2, '', '2021-12-26 17:58:39'),
(1800, '<p>gggggg</p>', 10, 2, '', '2021-12-26 17:59:10'),
(1801, '<p>which one is in trends</p>', 11, 2, '', '2021-12-26 18:31:02'),
(1802, '<p>both are in trends</p>', 11, 2, '', '2021-12-26 18:31:21'),
(1803, '<p>its about new year 2022</p>', 12, 1, '', '2022-01-01 17:21:37'),
(1804, '<p>ok, it\'s realy fantastic to enter into 2022</p>', 12, 1, '', '2022-01-01 17:24:02'),
(1805, '<p>yes its a new year conversationnn.</p>', 12, 1, '', '2022-01-01 17:24:20'),
(1806, '<p>fsfsfsf</p>', 13, 1, '', '2022-01-01 17:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

CREATE TABLE `forum_topics` (
  `topic_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_topics`
--

INSERT INTO `forum_topics` (`topic_id`, `subject`, `category_id`, `user_id`, `created`) VALUES
(1, 'Array in PHP', 1, 1, '2020-06-21 18:53:12'),
(2, 'Control statement in PHP', 1, 1, '2020-06-21 18:53:12'),
(3, 'Oops in Java', 2, 2, '2020-06-21 18:53:45'),
(4, 'Loops in Java', 2, 2, '2020-06-21 18:53:45'),
(8, 'most popular programming language', 3, 2, '2021-12-26 16:27:29'),
(9, 'best language in 2022 ', 3, 2, '2021-12-26 16:32:39'),
(10, 'web design trends in 2021', 3, 2, '2021-12-26 16:33:29'),
(11, 'python or react ?', 3, 2, '2021-12-26 18:31:02'),
(12, 'my new topic for 2022', 3, 1, '2022-01-01 17:21:37'),
(13, 'my first support topic', 7, 1, '2022-01-01 17:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `forum_usergroup`
--

CREATE TABLE `forum_usergroup` (
  `usergroup_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `view_forum` int(11) NOT NULL,
  `create_topic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_usergroup`
--

INSERT INTO `forum_usergroup` (`usergroup_id`, `title`, `view_forum`, `create_topic`) VALUES
(1, 'administrator', 1, 1),
(2, 'member', 1, 1),
(3, 'guest', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forum_users`
--

CREATE TABLE `forum_users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usergroup` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_users`
--

INSERT INTO `forum_users` (`user_id`, `name`, `email`, `password`, `usergroup`) VALUES
(1, 'Jhon Smith', 'smith@webdamn.com', '202cb962ac59075b964b07152d234b70', 1),
(2, 'Kane William', 'william@webdamn.com', '202cb962ac59075b964b07152d234b70', 1),
(4, 'jhon', 'jhon@webdamn.com', '202cb962ac59075b964b07152d234b70', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forum_category`
--
ALTER TABLE `forum_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `forum_owner`
--
ALTER TABLE `forum_owner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_posts`
--
ALTER TABLE `forum_posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `forum_usergroup`
--
ALTER TABLE `forum_usergroup`
  ADD PRIMARY KEY (`usergroup_id`);

--
-- Indexes for table `forum_users`
--
ALTER TABLE `forum_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forum_category`
--
ALTER TABLE `forum_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `forum_owner`
--
ALTER TABLE `forum_owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `forum_posts`
--
ALTER TABLE `forum_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1807;

--
-- AUTO_INCREMENT for table `forum_topics`
--
ALTER TABLE `forum_topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `forum_usergroup`
--
ALTER TABLE `forum_usergroup`
  MODIFY `usergroup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `forum_users`
--
ALTER TABLE `forum_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
