-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2020 at 05:55 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mediator`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_ID` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rating` tinyint(4) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `seller_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_ID`, `comment`, `date`, `rating`, `user_ID`, `seller_ID`) VALUES
(7, 'good seller ', '2020-03-22 02:03:03', 5, 90, 91);

-- --------------------------------------------------------

--
-- Table structure for table `exchanges`
--

CREATE TABLE `exchanges` (
  `id` int(11) NOT NULL,
  `transfer_id` varchar(55) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email_1` varchar(55) NOT NULL,
  `phone_1` varchar(55) NOT NULL,
  `money_1` varchar(55) NOT NULL,
  `proof_1` varchar(500) NOT NULL,
  `method_1` int(11) NOT NULL,
  `wallet_1` varchar(55) NOT NULL,
  `details_1` varchar(255) NOT NULL,
  `email_2` varchar(55) NOT NULL,
  `phone_2` varchar(55) DEFAULT NULL,
  `money_2` varchar(55) NOT NULL,
  `proof_2` varchar(500) DEFAULT NULL,
  `method_2` int(11) NOT NULL,
  `wallet_2` varchar(55) DEFAULT NULL,
  `details_2` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `accepted` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exchanges`
--

INSERT INTO `exchanges` (`id`, `transfer_id`, `date`, `email_1`, `phone_1`, `money_1`, `proof_1`, `method_1`, `wallet_1`, `details_1`, `email_2`, `phone_2`, `money_2`, `proof_2`, `method_2`, `wallet_2`, `details_2`, `product_id`, `accepted`, `status`, `comment`) VALUES
(11, 'D50325099', '2020-03-22 02:02:41', 'adel@gmail.com', '01210811347', '52', '860_paypal.jpg', 18, 'E234235', 'I want to buy this product', 'osama@gmail.com', '01210811347', '50', '351_sample_app.PNG', 16, 'E325235235', 'i finish transfer', 6, 1, 1, 'transfer is done');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `chat_Link` varchar(55) NOT NULL,
  `message` varchar(500) NOT NULL,
  `msg_type` varchar(50) NOT NULL,
  `Sender_ID` varchar(55) NOT NULL,
  `Receiver_ID` varchar(55) NOT NULL,
  `msg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `chat_Link`, `message`, `msg_type`, `Sender_ID`, `Receiver_ID`, `msg_time`) VALUES
(30, '91_90', 'hi osama', 'text', '90', '91', '2020-03-22 02:01:26'),
(31, '91_90', '? ', 'text', '90', '91', '2020-03-22 02:01:28'),
(32, '91_90', '?', 'text', '90', '91', '2020-03-22 02:01:29'),
(33, '91_90', '?', 'text', '90', '91', '2020-03-22 02:01:29'),
(34, 'admin_91', 'hi admins', 'text', '91', 'admin', '2020-03-22 02:06:46'),
(35, 'admin_91', 'assets/images/EMOJIS/1.png', 'emoji', '91', 'admin', '2020-03-22 02:06:50'),
(36, 'admin_91', 'fas fa-thumbs-up', 'like', '91', 'admin', '2020-03-22 02:06:52'),
(37, 'admin_91', 'i faced problem at transfer', 'text', '91', 'admin', '2020-03-22 02:07:05'),
(38, 'admin_91', 'fas fa-thumbs-up', 'like', 'admin', '91', '2020-03-22 02:07:20'),
(39, 'admin_91', 'assets/images/EMOJIS/33.png', 'emoji', 'admin', '91', '2020-03-22 02:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `type` varchar(55) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `transfer_id` varchar(55) NOT NULL,
  `accepted` tinyint(4) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `sender`, `receiver`, `transfer_id`, `accepted`, `date`) VALUES
(25, 'purchase_request', 90, 91, 'D50325099', 1, '2020-03-22 02:02:41');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `icon` varchar(500) NOT NULL,
  `our_account` varchar(55) NOT NULL,
  `minimum` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `icon`, `our_account`, `minimum`) VALUES
(16, 'paypal', '901_paypal.png', 'povami.software@gmail.com', '50'),
(17, 'skrill', '816_skrill.png', 'povami.software@gmail.com', '80'),
(18, 'payeer', '999_payeer.png', 'povami.software@gmail.com', '100'),
(21, 'vodafone cash', '466_vodafone_cash.jpg', '0124124125', '20');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `UserID` int(11) NOT NULL,
  `amount` varchar(55) NOT NULL,
  `amount_paid` varchar(55) NOT NULL,
  `category` int(11) NOT NULL,
  `accepted` varchar(255) NOT NULL,
  `img` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `UserID`, `amount`, `amount_paid`, `category`, `accepted`, `img`, `status`, `date`) VALUES
(6, '50$ paypal', 'Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello ', 91, '50', '52', 16, '[\"payeer\",\"skrill\"]', '595_paypal.jpg', 1, '2020-03-22 01:58:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `firstName` varchar(55) NOT NULL,
  `lastName` varchar(55) NOT NULL,
  `Username` varchar(55) NOT NULL,
  `Email` varchar(55) NOT NULL,
  `Pass` varchar(255) NOT NULL,
  `GroupID` tinyint(4) NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '1',
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(500) DEFAULT NULL,
  `rating` varchar(55) DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL,
  `jobs` int(11) DEFAULT NULL,
  `availability` tinyint(4) NOT NULL DEFAULT '0',
  `email_vertified` tinyint(4) NOT NULL DEFAULT '0',
  `token` varchar(20) NOT NULL,
  `num` varchar(55) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `transfers` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `firstName`, `lastName`, `Username`, `Email`, `Pass`, `GroupID`, `Status`, `register_date`, `image`, `rating`, `about`, `jobs`, `availability`, `email_vertified`, `token`, `num`, `address`, `facebook`, `twitter`, `instagram`, `transfers`) VALUES
(82, 'mohamed', 'ahmed', 'mohamed2020', 'mohamed@gmail.com', '$2y$10$TppLp2t4SiCA6cmhF75S5OgF/5srZJZzBDj8rSPVRJyMrOo9XcFZS', 3, 0, '2020-02-18 01:04:11', NULL, NULL, NULL, NULL, 0, 0, '61poajTdgy92R4enPmJ8', NULL, NULL, NULL, NULL, NULL, NULL),
(89, 'ahmed', 'mohamed', 'ahmed2020', 'ahmed@gmail.com', '$2y$10$vIK2hIHTApWEU0iMEpY5C.CVe8BkkMcZMABy0BTjy5f2VYgM1u0CG', 1, 1, '2020-03-22 00:50:37', NULL, NULL, NULL, NULL, 0, 0, '3Fg8vbWLUremTANX7wdq', NULL, NULL, NULL, NULL, NULL, NULL),
(90, 'adel', 'mohamed', 'adel2020', 'adel@gmail.com', '$2y$10$0QI76jPN5hueoqzA5lbn3O0dttUd7yWOFUknsQt75xzZ/f2jlAbaG', 1, 1, '2020-03-22 00:52:38', NULL, NULL, NULL, NULL, 0, 0, 'EhURvGDLWNe5ZCXMA9ml', NULL, NULL, NULL, NULL, NULL, NULL),
(91, 'osama', 'mohamed', 'osama2020', 'osama@gmail.com', '$2y$10$pm48tBdMaL6u7uRbex0v7.onrjpcNo72QpWULAk9.yooIl/b4nTB.', 2, 1, '2020-03-22 01:02:34', '407_pax.jpg', NULL, 'Hello i am good seller contact with me if you want paypal money', NULL, 2, 0, 'WJ3VxkXdqQsM8fhAOryE', '0101024125125', 'cairo, Egypt', 'https://www.facebook.com/abdelrahman.esmail.94/', 'https://www.twitter.com/abdelrahman.esmail.94/', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comments_ibfk_1` (`user_ID`),
  ADD KEY `seller_ID` (`seller_ID`);

--
-- Indexes for table `exchanges`
--
ALTER TABLE `exchanges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `method_1` (`method_1`),
  ADD KEY `method_2` (`method_2`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receiver` (`receiver`),
  ADD KEY `sender` (`sender`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `exchanges`
--
ALTER TABLE `exchanges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`seller_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exchanges`
--
ALTER TABLE `exchanges`
  ADD CONSTRAINT `exchanges_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exchanges_ibfk_2` FOREIGN KEY (`method_1`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exchanges_ibfk_3` FOREIGN KEY (`method_2`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`receiver`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`sender`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
