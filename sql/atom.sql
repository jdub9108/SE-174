-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2015 at 04:40 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `atom`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
`book_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author_first` varchar(100) NOT NULL,
  `author_last` varchar(100) NOT NULL,
  `year_published` int(5) NOT NULL,
  `pages` int(5) NOT NULL,
  `ISBN` int(13) NOT NULL,
  `image_path` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author_first`, `author_last`, `year_published`, `pages`, `ISBN`, `image_path`) VALUES
(1, 'HTML5 and CSS3 for Dummies', 'Andy', 'Harris', 2015, 1000, 2147483646, ''),
(2, 'Practical C Programming', 'Steve', 'Oualline', 1997, 400, 2147483641, ''),
(3, 'Java in Easy Steps', 'Mike', 'Mcgrath', 2008, 100, 2147483636, ''),
(4, 'Programming in C# 3.0', 'Jesse', 'Donald', 2001, 700, 2147483647, '');

-- --------------------------------------------------------

--
-- Table structure for table `book_posts`
--

CREATE TABLE IF NOT EXISTS `book_posts` (
  `book_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_posts`
--

INSERT INTO `book_posts` (`book_id`, `post_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`post_id` int(100) NOT NULL,
  `user` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `content` text NOT NULL,
  `post_closed` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user`, `date`, `content`, `post_closed`) VALUES
(1, 'dmevada', '2015-03-01', 'test', 0),
(2, 'brandonj', '2015-03-02', 'test post', 0),
(3, 'calvinh', '2015-03-03', 'test post 2', 0),
(4, 'jordanw', '2015-03-04', 'test post 3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(10) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `user_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `books_sold` int(10) NOT NULL,
  `books_bought` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `user_name`, `last_name`, `email`, `password`, `books_sold`, `books_bought`) VALUES
(4, 'Dhruv', 'dmevada', 'Mevada', 'dmevada@gmail.com', '1', 0, 0),
(5, 'Brandon', 'brandonj', 'Jaculina', 'bjaculina@gmail.com', '2', 0, 0),
(6, 'Calvin', 'calvinh', 'Ha', 'cha@gmail.com', '3', 0, 0),
(7, 'Jordan', 'jordanw', 'Watts', 'jwatts@gmail.com', '4', 0, 0),
(8, 'Zachary', 'zmartin08', 'Martin', 'zmartin@gmail.com', 'ogpU72Vvjobevc', 0, 0),
(9, '', '', '', NULL, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_books`
--

CREATE TABLE IF NOT EXISTS `user_books` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

CREATE TABLE IF NOT EXISTS `user_posts` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_posts`
--

INSERT INTO `user_posts` (`user_id`, `post_id`) VALUES
(4, 1),
(5, 2),
(6, 3),
(7, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
 ADD PRIMARY KEY (`book_id`), ADD UNIQUE KEY `ISBN` (`ISBN`);

--
-- Indexes for table `book_posts`
--
ALTER TABLE `book_posts`
 ADD PRIMARY KEY (`book_id`,`post_id`), ADD KEY `posts_fk_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_books`
--
ALTER TABLE `user_books`
 ADD PRIMARY KEY (`user_id`,`book_id`), ADD KEY `book_fk_id` (`book_id`);

--
-- Indexes for table `user_posts`
--
ALTER TABLE `user_posts`
 ADD PRIMARY KEY (`user_id`,`post_id`), ADD KEY `post_fk_id` (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `post_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_posts`
--
ALTER TABLE `book_posts`
ADD CONSTRAINT `books_fk_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON UPDATE CASCADE,
ADD CONSTRAINT `posts_fk_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_books`
--
ALTER TABLE `user_books`
ADD CONSTRAINT `book_fk_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
ADD CONSTRAINT `user_fk_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_posts`
--
ALTER TABLE `user_posts`
ADD CONSTRAINT `post_fk_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
ADD CONSTRAINT `users_fk_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
