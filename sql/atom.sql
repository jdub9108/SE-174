-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2015 at 06:41 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

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
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `author_first` varchar(100) NOT NULL,
  `author_last` varchar(100) NOT NULL,
  `year_published` int(5) NOT NULL,
  `pages` int(5) NOT NULL,
  `isbn` bigint(16) NOT NULL,
  `image_path` varchar(500) NOT NULL,
  PRIMARY KEY (`book_id`),
  UNIQUE KEY `ISBN` (`isbn`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author_first`, `author_last`, `year_published`, `pages`, `isbn`, `image_path`) VALUES
(1, 'HTML5 and CSS3 for Dummies', 'Andy', 'Harris', 2015, 1000, 9781118289389, 'images/bookCovers/html5css3.jpg'),
(2, 'Practical C Programming', 'Steve', 'Oualline', 1997, 400, 9781565923065, ''),
(3, 'Java in Easy Steps', 'Mike', 'Mcgrath', 2011, 100, 9781840784435, 'images/bookCovers/javaEasySteps.jpg'),
(4, 'Programming in C# 3.0', 'Jesse', 'Liberty', 2001, 700, 9780596527433, ''),
(5, 'JavaScript: The Definitive Guide', 'David', 'Flanagan', 2001, 900, 9780596000486, 'images/bookCovers/javascriptDefiniteGuide.jpg'),
(6, 'The Ruby Programming Language', 'David', 'Flanagan', 2008, 448, 9780596516178, ''),
(7, 'jQuery Pocket Reference', 'David', 'Flanagan', 2011, 160, 9781449397227, ''),
(12, 'html', 'test', 'test', 2014, 415, 9781118289380, ''),
(13, 'Great Gatsby', 'Jim', 'Gilligan', 2015, 12, 23412341234243, ''),
(14, 'Great Gatsby', 'Big', 'Watts', 2015, 12, 934800938408, ''),
(15, 'Playboy', 'Hue', 'Heffner', 2012, 60, 3209348309, ''),
(17, 'Playboy', 'Hue', 'Heffner', 2012, 60, 790078078097, ''),
(18, 'Playboy', 'Hue', 'Heffner', 2012, 60, 89978987, ''),
(19, 'jlsdkjf', 'herp ', 'derp', 2012, 60, 6435764567, '');

-- --------------------------------------------------------

--
-- Table structure for table `book_posts`
--

CREATE TABLE IF NOT EXISTS `book_posts` (
  `book_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`,`post_id`),
  KEY `posts_fk_id` (`post_id`)
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
  `post_id` int(100) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `content` text NOT NULL,
  `post_closed` tinyint(1) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

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
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) CHARACTER SET utf8 NOT NULL,
  `user_name` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(25) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `books_sold` int(10) NOT NULL,
  `books_bought` int(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `user_name`, `last_name`, `email`, `password`, `books_sold`, `books_bought`) VALUES
(2, 'Jordan', 'jdub9108', 'Watts', 'Jdub9108@gmail.com', '$2a$07$tBEEWQyE8rvtgg6vIPXuMeWqfXxN/.P1Blv6EfwOfvMHKrEpMoZIu', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_books`
--

CREATE TABLE IF NOT EXISTS `user_books` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`book_id`),
  KEY `book_fk_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_books`
--

INSERT INTO `user_books` (`user_id`, `book_id`) VALUES
(2, 13),
(2, 14),
(2, 15),
(2, 17),
(2, 18),
(2, 19);

-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

CREATE TABLE IF NOT EXISTS `user_posts` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`post_id`),
  KEY `post_fk_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD CONSTRAINT `book_fk_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_fk_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_posts`
--
ALTER TABLE `user_posts`
  ADD CONSTRAINT `post_fk_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_fk_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
