-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2023 at 04:01 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plant_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(250) NOT NULL,
  `admin_email` text NOT NULL,
  `admin_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin', 'planthub.plants@gmail.com', '25f9e794323b453885f5181f1b624d0b'),
(2, 'admin2', 'admin@123.gmail.com', '1234abcd');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(1, 'indoor plants '),
(2, 'flower plants');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `Message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(128) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_email`, `customer_password`) VALUES
(4, 'rukaiya', 'rukaiyah678@gmail.com', '25f9e794323b453885f5181f1b624d0b'),
(9, 'Aarah', 'aarah345@gmail.com', '25f9e794323b453885f5181f1b624d0b'),
(10, 'musthaq', 'mohamedmusthaq617@gmail.com', '25f9e794323b453885f5181f1b624d0b');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `faq_id` int(11) NOT NULL,
  `faq_qsn` varchar(255) NOT NULL,
  `faq_ansr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`faq_id`, `faq_qsn`, `faq_ansr`) VALUES
(5, 'Why Is the price for an item different from when I added it to the shopping cart?', 'Prices are subject to change — including temporary reductions as well as permanent increases. The prices of items in your cart represent the current price for which you will be charged'),
(6, 'When will I recive my order?', 'probably 10 to 15 days from the ordering date.'),
(7, 'How do I get a new password?', 'There is an option on the account page to change your password. You can change your password there.'),
(8, 'What is the return policy?', 'Well, there is no return on our plants,and we always sell the best kind of plants.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(12,2) NOT NULL,
  `order_status` varchar(100) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'on_hold',
  `customer_id` int(11) NOT NULL,
  `customer_phone` int(11) NOT NULL,
  `customer_city` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `customer_address` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `customer_id`, `customer_phone`, `customer_city`, `customer_address`, `order_date`) VALUES
(1, '700.00', 'not paid', 4, 775837494, 'kandy', '188,matale road,Akurana', '2023-09-06 11:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `plant_id` int(11) NOT NULL,
  `plant_name` varchar(100) NOT NULL,
  `plant_image` varchar(255) NOT NULL,
  `plant_price` decimal(6,2) NOT NULL,
  `plant_quantity` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `plant_id`, `plant_name`, `plant_image`, `plant_price`, `plant_quantity`, `customer_id`, `order_date`) VALUES
(1, 1, 2, 'Spider Plant', 'SpiderPlant.jpg', '400.00', 1, 4, '2023-09-06 17:25:57'),
(2, 1, 1, 'Peace Lily', 'Peace lily.jpg', '300.00', 1, 4, '2023-09-06 17:25:57');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `card_holder_name` varchar(255) NOT NULL,
  `card_no` int(11) NOT NULL,
  `card_date` date NOT NULL,
  `card_cvv` int(11) NOT NULL,
  `payment_mtd` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `date_of_payment` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `plant_id` int(11) NOT NULL,
  `plant_name` varchar(100) NOT NULL,
  `plant_description` longtext NOT NULL,
  `plant_keywords` varchar(300) NOT NULL,
  `category_id` int(11) NOT NULL,
  `plant_soil` varchar(255) NOT NULL,
  `plant_sunlight` varchar(255) NOT NULL,
  `environment` varchar(255) NOT NULL,
  `plant_watering` varchar(255) NOT NULL,
  `plant_image1` varchar(255) NOT NULL,
  `plant_price` decimal(12,2) NOT NULL,
  `plant_quantity` int(5) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`plant_id`, `plant_name`, `plant_description`, `plant_keywords`, `category_id`, `plant_soil`, `plant_sunlight`, `environment`, `plant_watering`, `plant_image1`, `plant_price`, `plant_quantity`, `date`, `status`) VALUES
(1, 'Peace Lily', 'Peace lilies are sturdy, easy to grow plants with glossy, dark green oval leaves that narrow to a point. The leaves rise directly from the soil.', 'flower,indoor', 2, 'Keep the soil in moist but do not over-water', ' indirect sunlight', 'Mostly as Indoor Plants', ' weekly watering is good', 'Peace lily.jpg', '300.00', 12, '2023-09-06 15:25:57', 'true'),
(2, 'Spider Plant', 'Spider plants have also been proven to remove around 95% of toxins from the air around them in 24 hours. Spider plants will also emit a lot of oxygen, helping you breathe more naturally in the evening while you sleep.', 'pet friendly', 1, 'soil medium that can retain moisture but also allows for draining excess water to avoid root rot.', 'bright, indirect light', 'both indoor and outside', 'once or twice a week ', 'SpiderPlant.jpg', '400.00', -1, '2023-09-06 15:25:57', 'false'),
(3, 'Roses ', 'The plants grow in the form of shrubs or vines. The stems usually have sharp thorns. The flowers vary in color and size. They come in shades of pink, red, orange, yellow, and white.\r\nwith big sized pot ', 'rose, flower,red,outdoor', 2, 'The best soils are those of a medium to heavy loam to a minimum of 35cm, over a good clay sub-soil', 'Direct sunlight', 'Outdoor plant', 'Water every 2-3 days', 'rose.jpg', '2000.00', 0, '2023-08-27 09:29:29', 'false'),
(4, 'Jasmine', 'Jasmine is one of the best plants to attract prosperity, according to Feng Shui. Along with its power to attract money according to Feng Shui, jasmine is a very beautiful addition for your home or your garden.', 'outdoor, flower,mother,happy cute', 2, 'Well-drained, rich loamy soil with a pH ranging from 6.5-7.5', ' full sun or part shade – usually about 6 hours or more of direct sunlight each day', 'out door', 'Need to water multiple times each week', 'Jasmine.jpg', '600.00', 0, '2023-08-31 12:50:58', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `plant_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `plant_id`, `customer_id`, `rating`, `comment`, `date`) VALUES
(1, 2, 4, 5, 'nys product', '2023-07-06 19:11:19'),
(2, 2, 6, 5, 'spider plant...i  love your shop and its plants\r\n', '2023-07-06 19:17:56'),
(4, 1, 6, 5, 'its same as the description ', '2023-07-06 19:32:29'),
(5, 3, 9, 5, 'do u have white rose?\r\n', '2023-08-31 08:24:33');

-- --------------------------------------------------------

--
-- Table structure for table `sold_item_qty`
--

CREATE TABLE `sold_item_qty` (
  `plant_id` int(11) NOT NULL,
  `plant_name` varchar(25) NOT NULL,
  `sold` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sold_item_qty`
--

INSERT INTO `sold_item_qty` (`plant_id`, `plant_name`, `sold`) VALUES
(1, 'Peace Lily', 3),
(2, 'Spider Plant', 35),
(3, 'Roses ', 23),
(4, 'Jasmine', 17),
(5, 'Anturian', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`plant_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `sold_item_qty`
--
ALTER TABLE `sold_item_qty`
  ADD PRIMARY KEY (`plant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `plant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sold_item_qty`
--
ALTER TABLE `sold_item_qty`
  MODIFY `plant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
