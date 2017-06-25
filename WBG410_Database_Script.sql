-- phpMyAdmin SQL Dump
-- version 2.8.0.1
-- http://www.phpmyadmin.net
-- 
-- Host: custsql-ipg29.eigbox.net
-- Generation Time: Nov 19, 2012 at 06:06 PM
-- Server version: 5.0.91
-- PHP Version: 4.4.9
-- 
-- Database: `game_site1`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `home_page`
-- 

CREATE TABLE `home_page` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(3000) NOT NULL,
  `message` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `home_page`
-- 

INSERT INTO `home_page` VALUES (1, 'Home Page Text', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. \r\n\r\nDuis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. \r\n\r\nNam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. \r\n\r\nMirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.');

-- --------------------------------------------------------

-- 
-- Table structure for table `mailing_list`
-- 

CREATE TABLE `mailing_list` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(500) NOT NULL,
  `phone` varchar(500) NOT NULL,
  `email` varchar(3000) NOT NULL,
  `comments` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `mailing_list`
-- 

INSERT INTO `mailing_list` VALUES (1, 'John Smith', '111.111.1111', 'john@test.com', 'Comments from John here...');
INSERT INTO `mailing_list` VALUES (2, 'Mary Smith', '555.555.5555', 'mary@test.com', 'Comments from Mary here...');

-- --------------------------------------------------------

-- 
-- Table structure for table `products`
-- 

CREATE TABLE `products` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(3000) NOT NULL,
  `description` longtext NOT NULL,
  `price` varchar(500) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `products`
-- 

INSERT INTO `products` VALUES (1, 'Product 1', 'Description for product 1.', '19.99');
INSERT INTO `products` VALUES (2, 'Product 2', 'Description for product 2.', '25.99');

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(3000) NOT NULL,
  `password` varchar(500) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` VALUES (1, 'test@test.com', 'test');

-- --------------------------------------------------------

-- 
-- Table structure for table `reviews`
-- 

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL auto_increment,
  `product_id` varchar(50) NOT NULL,
  `name` varchar(500) NOT NULL,
  `comment` longtext NOT NULL,
  `review_date` timestamp NOT NULL default '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `reviews`
-- 