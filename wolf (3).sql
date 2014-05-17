-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2014 at 09:22 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wolf`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutus`
--

CREATE TABLE IF NOT EXISTS `aboutus` (
  `abid` int(11) NOT NULL AUTO_INCREMENT,
  `abtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `abcontent` text,
  `username` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`abid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `aboutus`
--

INSERT INTO `aboutus` (`abid`, `abtime`, `abcontent`, `username`) VALUES
(1, '2014-04-24 05:10:12', 'its keep getting grow', 'super_admin');

-- --------------------------------------------------------

--
-- Table structure for table `add_product`
--

CREATE TABLE IF NOT EXISTS `add_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `size` int(20) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `pcategory` varchar(10) DEFAULT NULL,
  `psize` varchar(10) DEFAULT NULL,
  `pcolor` varchar(10) DEFAULT NULL,
  `pprize` int(20) DEFAULT NULL,
  `ptype` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `add_product`
--

INSERT INTO `add_product` (`id`, `filename`, `type`, `size`, `product_name`, `pcategory`, `psize`, `pcolor`, `pprize`, `ptype`) VALUES
(11, 'Penguins.jpg', 'image/jpeg', 777835, 'my littel cat', 'Kids', '8', 'Brown', 265, 'Wedding'),
(14, 'Desert.jpg', 'image/jpeg', 845941, 'girl', 'Kids', '10', 'White', 6000, 'Casual'),
(15, 'angry-lions-1024x768-wallpaper-6666.jpg', 'image/jpeg', 784768, '', '', '', '', 0, ''),
(16, 'alice-in-wonderland-the-cheshire-cat-1024x768-wallpaper-9891.jpg', 'image/jpeg', 554169, '', '', '', '', 0, ''),
(17, 'beautiful-blossoming-tree-1024x768-wallpaper-5921.jpg', 'image/jpeg', 890048, 'sea', 'Men', '7', 'Black', 345, 'Office'),
(18, 'Desert.jpg', 'image/jpeg', 845941, 'test product edit', 'Kids', '8', 'Brown', 4000, 'Wedding'),
(19, '1.jpg', 'image/jpeg', 35557, 'Dark Brown office shoe', 'Men', '7', 'Brown', 2400, 'Office'),
(20, '2.jpg', 'image/jpeg', 38658, 'Light Brown office shoe', 'Men', '8', 'Brown', 4200, 'Office'),
(21, '6.jpg', 'image/jpeg', 38249, 'Black office shoe', 'Men', '7', 'Black', 5200, 'Office'),
(22, '8.jpg', 'image/jpeg', 40325, 'Black wedding shoe', 'Men', '9', 'Black', 3000, 'Wedding'),
(23, 'Jellyfish.jpg', 'image/jpeg', 775702, 'test', 'Men', '7', 'Brown', 12300, 'Office'),
(24, 'Chrysanthemum.jpg', 'image/jpeg', 879394, 'yiyuoooo', 'Men', '7', 'Black', 6777, 'Office');

-- --------------------------------------------------------

--
-- Table structure for table `category_color`
--

CREATE TABLE IF NOT EXISTS `category_color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL COMMENT '1 - Men, 2 - Kids',
  `color` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `category_color`
--

INSERT INTO `category_color` (`id`, `cat_id`, `color`) VALUES
(1, 1, 'Black'),
(2, 1, 'Brown'),
(3, 1, 'Light Brown'),
(4, 1, 'Grey'),
(5, 1, 'Red'),
(6, 2, 'White'),
(7, 2, 'Blue');

-- --------------------------------------------------------

--
-- Table structure for table `category_size`
--

CREATE TABLE IF NOT EXISTS `category_size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL COMMENT '1 - Men, 2 - Kids',
  `size` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `category_size`
--

INSERT INTO `category_size` (`id`, `cat_id`, `size`) VALUES
(1, 1, 40),
(2, 1, 41),
(3, 1, 42),
(4, 1, 43),
(5, 1, 44),
(6, 1, 45),
(7, 2, 10),
(8, 2, 11),
(9, 2, 12),
(10, 2, 13),
(11, 2, 14);

-- --------------------------------------------------------

--
-- Table structure for table `category_type`
--

CREATE TABLE IF NOT EXISTS `category_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `category_type`
--

INSERT INTO `category_type` (`id`, `cat_id`, `type`) VALUES
(1, 1, 'Office'),
(2, 1, 'Wedding'),
(3, 1, 'Casual'),
(4, 1, 'Party'),
(5, 1, 'Fashion'),
(6, 2, 'Home'),
(7, 2, 'Outgoing'),
(8, 3, 'Shoks'),
(9, 3, 'Polishes'),
(10, 3, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `conid` int(11) NOT NULL AUTO_INCREMENT,
  `condate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `contitle` varchar(10) DEFAULT NULL,
  `confname` varchar(40) DEFAULT NULL,
  `conlname` varchar(40) DEFAULT NULL,
  `conemail` varchar(50) DEFAULT NULL,
  `contel` varchar(15) DEFAULT NULL,
  `conmass` text,
  PRIMARY KEY (`conid`),
  UNIQUE KEY `conid_3` (`conid`),
  KEY `conid` (`conid`),
  KEY `conid_2` (`conid`),
  KEY `conid_4` (`conid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`conid`, `condate`, `contitle`, `confname`, `conlname`, `conemail`, `contel`, `conmass`) VALUES
(1, '2014-04-24 05:06:29', 'Ms.', 'kasun', 'ok', 'gucjk', 'asdasd', 'asdasda'),
(2, '2014-05-17 06:20:59', '', 'gayan', 'jayanath', 'roxjayanath@gmail.com', '056551', 'HELL YA');

-- --------------------------------------------------------

--
-- Table structure for table `coustomer`
--

CREATE TABLE IF NOT EXISTS `coustomer` (
  `cusid` int(10) NOT NULL AUTO_INCREMENT,
  `cfname` varchar(40) DEFAULT NULL,
  `clname` varchar(40) DEFAULT NULL,
  `cadress1` varchar(40) DEFAULT NULL,
  `cadress2` varchar(40) DEFAULT NULL,
  `ccity` varchar(20) DEFAULT NULL,
  `cprovince` varchar(30) DEFAULT NULL,
  `cpcode` varchar(10) DEFAULT NULL,
  `ccounty` varchar(20) DEFAULT NULL,
  `csadress1` varchar(60) DEFAULT NULL,
  `csadress2` varchar(60) DEFAULT NULL,
  `cscity` varchar(40) DEFAULT NULL,
  `csprovince` varchar(20) DEFAULT NULL,
  `cspcode` varchar(10) DEFAULT NULL,
  `cscounty` varchar(20) DEFAULT NULL,
  `cemail` varchar(60) DEFAULT NULL,
  `cpassword` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`cusid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `coustomer`
--

INSERT INTO `coustomer` (`cusid`, `cfname`, `clname`, `cadress1`, `cadress2`, `ccity`, `cprovince`, `cpcode`, `ccounty`, `csadress1`, `csadress2`, `cscity`, `csprovince`, `cspcode`, `cscounty`, `cemail`, `cpassword`) VALUES
(2, 'Sahan', 'Madurasinghe', '123, new road,', 'Pannipitiya', 'Colombo', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sahan@mail.com', 'abc123'),
(3, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, 'sdaf', '', 'vsxcasd', 'Bahamas', 'asdadf', '', '', '', '', '', '', '', '', '', '', ''),
(5, 'sdfava', '', 'adgadf', 'Benin', 'asdasd', '', '', '', '', '', '', '', '', '', 'asdfgafsda', 'mn'),
(6, 'jayanath', '', 'sdfsdfad', 'Antigua and Barbuda', 'adsa', '', '', '', '', '', '', '', '', '', 'dfdsafd', 'm'),
(7, 'gayan', 'jayanath', 'sa', 'Austria', 'al', '', '', '', '', '', '', '', '', '', 'eeeeee', 'mi'),
(8, 'gayan', 'jayanath', 'bill', 'a1', 'a2', 'p', 'c', 'Belgium', 'ssa', 'aa1', 'aa2', 'ssa2', 'ccct', 'Belize', 'eeeeeeeee', 'm'),
(9, 'Sahan', 'test', '123,tyty', '', '', '', '', '', '', '', '', '', '', '', 'sahan@mail2.com', 'a'),
(10, 'gayan', 'jayanath', '163/42', 'a balangalwatha', 'kiraillawa', 'western', '0094', 'Sri Lanka', '', '', '', '', '', '', 'roxjayanath@gmail.com', '123'),
(11, 'gayan', 'jayanath', '163/42', 'a balangalwatha', 'kiraillawa', 'western', '0094', 'Sri Lanka', '163/42', 'a balangalwatha', 'kiraillawa', 'western', '0094', 'Sri Lanka', 'roxjayanath@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `i_code` varchar(15) DEFAULT NULL,
  `image_1` varchar(255) DEFAULT NULL,
  `image_2` varchar(255) DEFAULT NULL,
  `image_3` varchar(255) DEFAULT NULL,
  `image_4` varchar(255) DEFAULT NULL,
  `cat_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quan` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1 - active, 0 - inactive',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `i_code`, `image_1`, `image_2`, `image_3`, `image_4`, `cat_id`, `size_id`, `color_id`, `type_id`, `price`, `quan`, `status`, `time`) VALUES
(3, 'test 2', NULL, '1.jpg', NULL, '', '4.jpg', 1, 3, 2, 2, '3999.00', NULL, 1, '2014-04-18 11:36:16'),
(4, 'test 2 image', NULL, '1.jpg', '2.jpg', '', '', 1, 1, 1, 1, '80000.00', NULL, 1, '2014-04-18 13:57:29'),
(6, 'test 4', NULL, '1_1399977197.jpg', '2_1400240328.jpg', '3_1400240348.jpg', NULL, 2, 9, 7, 7, '1200.00', 52, 1, '2014-04-19 03:03:36'),
(15, 'sdfwer', NULL, '1_1400241472.jpg', NULL, NULL, NULL, 3, 0, 0, 10, '435.34', 234, 1, '2014-05-16 11:57:52'),
(16, 'bicke', 'new code', '1_1400305786.jpg', NULL, NULL, NULL, 1, 1, 1, 1, '23.45', 345, 1, '2014-05-17 05:49:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `category`) VALUES
(1, 'Men'),
(2, 'Kids'),
(3, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `puchid` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(10) DEFAULT NULL,
  `productid` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `prize` decimal(10,2) DEFAULT NULL,
  `ouchtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`puchid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`puchid`, `customerid`, `productid`, `quantity`, `prize`, `ouchtime`) VALUES
(1, 2, 3, 2, '3999.00', NULL),
(2, 2, 8, 1, '234234.00', NULL),
(3, 2, 3, 2, '3999.00', '2014-04-20 16:42:16'),
(4, 2, 8, 1, '234234.00', '2014-04-20 16:42:16'),
(5, 2, 3, 2, '3999.00', '2014-04-20 16:50:57'),
(6, 2, 8, 1, '234234.00', '2014-04-20 16:50:57'),
(7, 2, 3, 2, '3999.00', '2014-04-20 16:51:21'),
(8, 2, 8, 1, '234234.00', '2014-04-20 16:51:21'),
(9, 2, 4, 1, '80000.00', '2014-04-24 05:08:10'),
(10, 2, 3, 4, '3999.00', '2014-04-24 05:08:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'super_admin', 'e99a18c428cb38d5f260853678922e03'),
(21, 'my', '6848d756da66e55b42f79c0728e351ad'),
(23, 'hello', 'baby'),
(28, 'efrg', 'dfg'),
(29, 'gayan', 'a63791c9c0a875957baeb7666aa90546');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `cus_id`, `item_id`, `date_time`) VALUES
(1, 2, 3, '2014-05-12 18:01:48'),
(2, 2, 4, '2014-05-12 18:48:53'),
(3, 2, 4, '2014-05-16 04:38:31'),
(4, 2, 3, '2014-05-16 04:40:39'),
(5, 2, 4, '2014-05-16 08:36:40'),
(6, 2, 3, '2014-05-16 08:36:54');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
