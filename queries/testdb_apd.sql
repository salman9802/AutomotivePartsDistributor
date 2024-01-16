-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2023 at 01:00 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdb_apd`
--
CREATE DATABASE IF NOT EXISTS `testdb_apd` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `testdb_apd`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `quantity` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `password`) VALUES
('mahindra_123', 'Mahindra', 'mahindra_12345'),
('tata_123', 'Tata', 'tata_12345');

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `price` int(7) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `company_id` varchar(255) NOT NULL,
  `request` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`id`, `brand`, `model`, `type`, `name`, `price`, `image`, `status`, `company_id`, `request`) VALUES
(14, 'tata', 'ace', 'brake', 'Bosch Front Brake Pad FRONT BRAKE PAD SET DISC BRAKE F002H23640', 863, 'img/parts/tata/ace/brake/tata-ace-front-brake.jpg', 'instock', 'tata_123', 0),
(15, 'tata', 'ace', 'brake', 'Tvs Girling Front Brake Disc FRONT BRAKE DISC 29390069', 879, 'img/parts/tata/ace/brake/tata-ace-front-brake-disc.jpg', 'instock', 'tata_123', 0),
(16, 'tata', 'ace', 'engine', 'Tata Truck Engine For Tata Ace Tata 4018 4923 3718 2516', 50000, 'img/parts/tata/ace/engine/tata-engine.webp', 'instock', 'tata_123', 0),
(17, 'tata', 'ace', 'engine', 'Tata Ace Engine Kit', 4500, 'img/parts/tata/ace/engine/tata-ace-engine-kit.webp', 'instock', 'tata_123', 0),
(18, 'tata', 'ace', 'wheel/tyre', 'APOLLO AMAZER 4G LIFE 145/80 R 12 TUBELESS CAR TYRE', 3088, 'img/parts/tata/ace/wheel-tyre/tata-ace-tyre.jpg', 'outofstock', 'tata_123', 1),
(19, 'tata', 'ace', 'wheel/tyre', 'APOLLO ALTRUST 155 R 13 TUBELESS CAR TYRE', 3972, 'img/parts/tata/ace/wheel-tyre/tata-ace-tyre-tubeless.jpg', 'outofstock', 'tata_123', 1),
(20, 'tata', 'ace', 'headlights', 'Autogold Headlight HEAD LAMP UNIT TATA ACE HT DICOR RH ILH0864R', 1176, 'img/parts/tata/ace/headlights/tata-ace-headlight.jpg', 'outofstock', 'tata_123', 1),
(21, 'tata', 'ace', 'headlights', 'Uno Minda Headlight HEAD LIGHT ASSY. WITH HOLDER- LH HL5600M', 416, 'img/parts/tata/ace/headlights/tata-ace-headlight2.jpg', 'outofstock', 'tata_123', 1),
(22, 'mahindra', 'alfa', 'brake', 'Mahindra Alfa Brake Shoe', 87, 'img/parts/mahindra/alfa/brake/mahindra-alfa-brake.webp', 'instock', 'mahindra_123', 0),
(23, 'mahindra', 'alfa', 'brake', 'Mahindra Alfa Brake Shoe', 87, 'img/parts/mahindra/alfa/brake/mahindra-alfa-brake.webp', 'instock', 'mahindra_123', 0),
(24, 'mahindra', 'alfa', 'engine', 'Mahindra Alfa Auto Spares Parts', 600, 'img/parts/mahindra/alfa/engine/mahindra-alfa-engine.webp', 'instock', 'mahindra_123', 0),
(25, 'mahindra', 'alfa', 'wheel/tyre', 'WHEEL RIM REAR', 836, 'img/parts/mahindra/alfa/wheel-tyre/mahindra-alfa-tyre-rim.webp', 'instock', 'mahindra_123', 0),
(26, 'mahindra', 'alfa', 'headlights', 'Blaupunkt LED 9X PRO - H11 12 Volt Car Headlight Lamp', 4949, 'img/parts/mahindra/alfa/headlights/mahindra-alfa-headlight-led.jpeg', 'instock', 'mahindra_123', 0),
(27, 'tata', 'ace', 'brake', 'ACDelco I14P4009M Front Disc Brake Pad for Tata Indica/Ace (Set of 4)', 570, 'https://m.media-amazon.com/images/I/8127n3zXpnL._SL1500_.jpg', 'instock', 'tata_123', 0),
(28, 'tata', 'ace', 'engine', 'Valeo 2P Clutch Plate And Pressure For Tata Ace, D Diesel 404530, Black', 3146, 'https://m.media-amazon.com/images/I/518XeqNa5NL.jpg', 'instock', 'tata_123', 0),
(29, 'tata', 'ace', 'engine', 'Front Engine Mount for Tata ace compitable', 950, 'https://m.media-amazon.com/images/I/51iTA3YoszL._SL1384_.jpg', 'instock', 'tata_123', 0),
(30, 'tata', 'ace', 'engine', 'Autoclean Radiator Fan Motor For Tata Ace', 2490, 'https://m.media-amazon.com/images/I/51BUa+4qMVL._SL1280_.jpg', 'instock', 'tata_123', 0),
(31, 'tata', 'ace', 'engine', 'NPR REAR ENGINE MOUNTING TATA ACE', 738, 'https://m.media-amazon.com/images/I/411oDqpuAdL.jpg', 'instock', 'tata_123', 0),
(32, 'tata', 'ace', 'engine', 'GENERIC SHANTHI AUTO SPARES APE,TATA ACE DIESEL ENGINE OIL 3 LITRE', 2099, 'https://m.media-amazon.com/images/I/71AGjZx06dL._SL1500_.jpg', 'instock', 'tata_123', 0),
(33, 'tata', 'ace', 'brake', 'Drive Line Front Brake Pads for Tata Indica Vista(Diesel)/ Manza/Super Ace/Venture', 540, 'https://m.media-amazon.com/images/I/51aDL3UYRrL._SL1024_.jpg', 'instock', 'tata_123', 0),
(34, 'tata', 'ace', 'headlights', 'K D Headlight for Tata Ace Mega (Left/Passenger Side) 2013-Now', 1548, 'https://m.media-amazon.com/images/I/81t5Aa8KgjL._SL1500_.jpg', 'instock', 'tata_123', 0),
(35, 'tata', 'ace', 'headlights', 'K D Headlight for Tata Super Ace or Venture (Left/Passenger Side) 2009-now', 1488, 'https://m.media-amazon.com/images/I/71eWSkjGqgL._SL1500_.jpg', 'instock', 'tata_123', 0),
(36, 'tata', 'ace', 'headlights', 'K D Headlight for Tata Ace Mega (Right & Left both Sides) With Bulb 2013-Now PAIR', 2688, 'https://m.media-amazon.com/images/I/71+9i9eymEL._SL1500_.jpg', 'instock', 'tata_123', 0),
(37, 'tata', 'ace', 'headlights', 'K D Headlight assembly for Tata Super Ace with BULB (Right & Left both Sides) PAIR 2009- Now', 2688, 'https://m.media-amazon.com/images/I/71oJD4wFf4L._SL1500_.jpg', 'instock', 'tata_123', 0),
(38, 'tata', 'ace', 'wheel/tyre', 'HUDMOZ - Car Wheel Cover/Cap Hubcaps Camry Silver 12 Inches Compatible with Tata Ace (Set of 4 Pcs.)', 1095, 'https://m.media-amazon.com/images/I/51p9TbJC+NL._SL1014_.jpg', 'instock', 'tata_123', 0),
(39, 'tata', 'ace', 'wheel/tyre', 'PRIGAN TATA ACE Black Red Wheel Cover 12\" for -TATA ACE (Set of 4 Pcs) (Press Fitting) Model- Camry_Red_12', 1365, 'https://m.media-amazon.com/images/I/81vGMha3ilL._SL1500_.jpg', 'instock', 'tata_123', 0),
(40, 'tata', 'ace', 'wheel/tyre', 'PRIGAN TATA ACE Black Green Wheel Cover 12 Inch for -TATA ACE (Set of 4 Pcs) (Press Fitting) Model- Camry,bg12', 1465, 'https://m.media-amazon.com/images/I/814ZH2e2ZML._SL1500_.jpg', 'instock', 'tata_123', 0),
(41, 'tata', 'ace', 'wheel/tyre', 'Ceat Secura Drive 185/65 R15 88H Tubeless Car Tyre (Home Delivery) Black', 4679, 'https://m.media-amazon.com/images/I/710-D1qwVjL._SL1500_.jpg', 'instock', 'tata_123', 0),
(42, 'tata', 'ace', 'wheel/tyre', 'Ceat Milaze LT 145 R12 86Q Tubeless Tyre for Maruti OMNI or TATA ACE Black', 4399, 'https://m.media-amazon.com/images/I/51Z4PbYrHZL.jpg', 'instock', 'tata_123', 0),
(43, 'tata', 'ace', 'wheel/tyre', 'Mrf Wsl 235/65 R17 104H-1 Tubeless Car Tyre For Tata-Aria', 11579, 'https://m.media-amazon.com/images/I/71PmBaVB0DL._SL1200_.jpg', 'instock', 'tata_123', 0),
(44, 'mahindra', 'alfa', 'engine', 'Mahindra Alfa Engine Gear', 118, 'https://5.imimg.com/data5/WR/JV/GG/SELLER-19448630/mahindra-alfa-engine-gear-1000x1000.jpg', 'instock', 'mahindra_123', 0),
(45, 'mahindra', 'alfa', 'brake', 'PA Brake Shoe for Mahindra 125', 395, 'https://m.media-amazon.com/images/I/41vz9SxntyS.jpg', 'instock', 'mahindra_123', 0),
(46, 'mahindra', 'alfa', 'brake', 'UNO Mahindra BR-1504 Brake Pad ZX R', 896, 'https://m.media-amazon.com/images/I/81A+DRBj3LL._SL1500_.jpg', 'instock', 'mahindra_123', 0),
(47, 'mahindra', 'alfa', 'headlights', 'Allpartssource Mahindra ALFA Side Light Assembly Set and Eyes', 1327, 'https://m.media-amazon.com/images/I/714A4aYZBsS._SL1500_.jpg', 'instock', 'mahindra_123', 0),
(48, 'mahindra', 'alfa', 'headlights', 'UNO Minda HL-5536 HEAD LIGHT- LH FOR TAFE T-245', 236, 'https://m.media-amazon.com/images/I/818G1lqEIYL._SL1500_.jpg', 'instock', 'mahindra_123', 0),
(49, 'mahindra', 'alfa', 'headlights', 'A2D H4 C6 35W 6000K 12V LED HID Car Headlight Bulb Conversion Kit with Cooling Fan Car Head lamp WHITE Set Of 2 For Mahindra Type 3', 1499, 'https://m.media-amazon.com/images/I/61276JlOBgL._SL1500_.jpg', 'instock', 'mahindra_123', 0),
(50, 'mahindra', 'alfa', 'headlights', 'K D Headlight assembly for Mahindra Type 2 with Bulb H4 12V 55/60W (Right and Left Both)', 3148, 'https://m.media-amazon.com/images/I/71hiehilixS._SL1500_.jpg', 'instock', 'mahindra_123', 0),
(51, 'mahindra', 'alfa', 'wheel/tyre', 'APLE Round Alfa Wheel Rim, Size: 8 Inch', 800, 'https://2.imimg.com/data2/SI/TK/MY-87611/3-wheeler-spare-parts-1000x1000.jpg', 'instock', 'mahindra_123', 0),
(52, 'mahindra', 'alfa', 'wheel/tyre', 'Ultra Mile UM 4X4 A/T BULL 265/60 R18 TUBELESS CAR TYRE', 13843, 'https://m.media-amazon.com/images/I/51EZKBNVDsL._SL1080_.jpg', 'instock', 'mahindra_123', 0),
(53, 'mahindra', 'alfa', 'wheel/tyre', 'JK TYRE Jumbo Miles 4.50-10 8PR Tubeless 3-Wheeler Tyre, Front', 2489, 'https://m.media-amazon.com/images/I/41hNYc8GpaL.jpg', 'instock', 'mahindra_123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `part_id`, `quantity`, `timestamp`) VALUES
(9, 5, 16, 1, '2023-04-20 12:39:34'),
(10, 5, 16, 1, '2023-04-21 09:15:45'),
(11, 5, 17, 1, '2023-04-21 09:24:19'),
(12, 6, 14, 1, '2023-04-21 11:49:47'),
(13, 6, 26, 1, '2023-04-21 11:49:47'),
(14, 6, 24, 1, '2023-04-21 11:49:47'),
(15, 6, 25, 1, '2023-04-21 11:49:47'),
(16, 5, 24, 2, '2023-04-27 16:48:32'),
(17, 5, 25, 2, '2023-04-27 16:48:32'),
(18, 5, 26, 1, '2023-04-27 17:50:05'),
(19, 5, 22, 1, '2023-04-27 18:47:47'),
(20, 5, 23, 1, '2023-04-27 18:47:47'),
(21, 5, 25, 1, '2023-04-27 18:47:47'),
(22, 5, 23, 1, '2023-04-27 18:48:41'),
(23, 10, 16, 1, '2023-05-13 10:02:13'),
(24, 10, 28, 1, '2023-05-13 10:02:13'),
(25, 10, 29, 2, '2023-05-13 10:02:13'),
(26, 10, 17, 2, '2023-05-13 10:02:13'),
(27, 10, 31, 1, '2023-05-13 10:02:13'),
(28, 10, 34, 1, '2023-05-13 10:04:03'),
(29, 10, 35, 1, '2023-05-13 10:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `gender` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `mobile`, `address`, `gender`) VALUES
(5, 'sallu123', 'sallu123', 'sallu@example.com', '1234567890', 'myaddress', 'male'),
(6, 'fuzzu123', 'fuzzu123', 'fuzzu@fuzzu.com', '9876543210', 'fuzzu123', 'male'),
(10, 'user', 'user12345', 'user@user.com', '1742589630', 'user12345', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `part_id` (`part_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
