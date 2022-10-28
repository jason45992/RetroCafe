-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 28, 2022 at 01:04 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `RetroCafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_number` int(11) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `amount` float NOT NULL,
  `status` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `first_name`, `last_name`, `contact_number`, `postal_code`, `address`, `amount`, `status`, `datetime`) VALUES
(1, 2, 'Albert', 'Tan', 62120196, 48423, '18 Cross Street #12-01/08 China Square Central', 67, 'Processing', '2022-10-28 10:48:11');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `img_url` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `visable` tinyint(1) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category`, `name`, `img_url`, `description`, `price`, `quantity`, `visable`, `modified_date`) VALUES
(1, 'cake', 'TIRAMISU CAKE', 'https://images01.nicepage.com/c461c07a441a5d220e8feb1a/2f3a74b06285575ab76bf4fb/1.jpg', 'It is made of ladyfingers dipped in coffee, layered with a whipped mixture of eggs, sugar, and cheese, flavored with cocoa.', 9.9, 10, 1, '2022-10-28 10:10:29'),
(2, 'cake', 'CHIA PUDDING', 'https://images01.nicepage.com/c461c07a441a5d220e8feb1a/ab84de2ad5735d628d59ed26/2.jpg', 'This 3-Ingredient Chia Pudding is made with almond milk, chia seeds & sweetener of choice', 8.9, 10, 1, '2022-10-28 10:10:29'),
(3, 'cake', 'CHEESECAKE', 'https://images01.nicepage.com/c461c07a441a5d220e8feb1a/0af96baec95b56e6842e9bbd/4.jpg', 'It consists of a thick, creamy filling of cheese, eggs, and sugar over a thinner crust and topped with sweet or sometimes salty items.', 7.5, 10, 1, '2022-10-28 10:30:29'),
(4, 'cake', 'CHOCOLATE CAKE', 'https://images01.nicepage.com/c461c07a441a5d220e8feb1a/27ba1863cf0252319fb18a31/677u.jpg', 'Chocolate cake or chocolate gâteau is a cake flavored with melted chocolate, cocoa powder, or both. ', 7.5, 10, 1, '2022-10-28 10:37:44'),
(5, 'cake', 'CHEESECAKE', 'https://images01.nicepage.com/c461c07a441a5d220e8feb1a/4dbe427549b7580ead405557/7.jpg', 'It consists of a thick, creamy filling of cheese, eggs, and sugar over a thinner crust and topped with sweet or sometimes salty items.', 7.8, 10, 1, '2022-10-28 10:38:49'),
(6, 'cake', 'ORANGE CAKE', 'https://images01.nicepage.com/c461c07a441a5d220e8feb1a/c11d5f2f2fab5c8abed3521d/fff.jpg', 'An everyday orange cake extra moist and loaded with orange flavor. Soft, fluffy with a melt in your mouth texture.', 7.5, 10, 1, '2022-10-28 10:39:42'),
(7, 'coffee', 'CAFFE LATTE', 'https://i.postimg.cc/HLfbBnsV/1.png', 'Our dark, rich espresso balanced with steamed milk and a light layer of foam. A perfect milk forward warm up.', 7.1, 10, 1, '2022-10-28 11:36:25'),
(8, 'coffee', 'AMERICANO', 'https://i.postimg.cc/FsDcwDHt/2.png', 'Espresso shots topped with hot water, made with Retro Blonde Roast for an extra-smooth, lighter-roasted cup.', 5.7, 10, 1, '2022-10-28 11:36:25'),
(9, 'coffee', 'FRAPPUCCINO', 'https://i.postimg.cc/Mp37ftC0/3.png', 'Brown sugar syrup blended with coffee, oatmilk and ice topped with mocha drizzle. Drinks are served without whipped cream.', 8.7, 10, 1, '2022-10-28 11:36:25'),
(10, 'coffee', 'FLAT WHITE', 'https://i.postimg.cc/cCcYxc7n/4.png', 'Bold shots of espresso get the perfect amount of steamed whole milk to create a just right flavor.', 7.9, 10, 1, '2022-10-28 11:36:25'),
(11, 'coffee', 'VANILLA LATTE', 'https://i.postimg.cc/sX778zvK/5.png', 'Rich, full-bodied espresso blended with creamy steamed milk and vanilla syrup.', 7.8, 10, 1, '2022-10-28 11:36:25'),
(12, 'coffee', 'HANDCRAFT', 'https://i.postimg.cc/kGCKPHSC/6.png', 'Espresso shots are topped with hot water to produce a light layer of crema. Handcrafted gives a fresh taste.', 5.8, 10, 1, '2022-10-28 11:36:25'),
(13, 'coffee', 'CAFFE MOCHA', 'https://i.postimg.cc/2jdn7zpS/7.png', 'Our rich, full-bodied espresso combined with bittersweet mocha sauce and steamed milk. The classic coffee drink that always sweetly satisfies.', 7.8, 10, 1, '2022-10-28 11:36:25'),
(14, 'coffee', 'ESPRESSO', 'https://i.postimg.cc/jjWzHPTp/8.png', 'Espresso shots topped with hot water, made with Retro Blonde Roast for an extra-smooth, lighter-roasted cup.', 5.7, 10, 1, '2022-10-28 11:36:25'),
(15, 'coffee', 'BREWED CAFFE', 'https://i.postimg.cc/xC2cXz1y/9.png', 'Enjoy our rich, flavorful brewed coffees any time of the day.Easy-drinking on its own and delicious with milk and sugar.', 4.8, 10, 1, '2022-10-28 11:36:25'),
(16, 'coffee', 'FLAT WHITE', 'https://i.postimg.cc/ydm3jTbb/10.png', 'Bold shots of espresso get the perfect amount of steamed whole milk to create a just right flavor.', 7.9, 10, 1, '2022-10-28 11:36:25'),
(17, 'coffee', 'ICED LATTE', 'https://i.postimg.cc/fR13hF4P/13.png', 'A blend of blonde espresso with creamy oatmilk, brown sugar and a hint of cinnamon for rich layers of deliciousness', 8.3, 10, 1, '2022-10-28 11:36:25'),
(18, 'coffee', 'OAT LATTE', 'https://i.postimg.cc/YCv4Z7Pg/15.png', 'Our dark, rich espresso balanced with steamed milk and a light layer of foam. A perfect milk forward iced.', 7.2, 10, 1, '2022-10-28 11:36:25'),
(19, 'coffee', 'COLD BREW', 'https://i.postimg.cc/j54CPSW-V/18.png', 'Enjoy our rich, flavorful brewed coffees any time of the day.\r\nEasy-drinking on its own and delicious with milk and sugar.', 4.6, 10, 1, '2022-10-28 11:36:25');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `password`, `is_admin`) VALUES
(1, 'Jason Wang', 'jasonwang', 'jasonw@localhost', '123456', 1),
(2, 'Albert Tan', 'albert.tan', 'albert.tan@gmail.com', '123456', 0),
(3, 'Cong Cong', 'cong.cong', 'cong.c@gmail.com', '123456', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CS1` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `CS2` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `CS1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
