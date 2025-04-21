-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2025 at 12:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_rest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `code` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `username`, `password`, `email`, `code`, `date`) VALUES
(6, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'admin@gmail.com', '', '2018-04-09 07:36:18'),
(14, 'mansi', '1212', 'm@gmail.com', 'QFE6ZM', '2025-04-17 11:11:30'),
(15, 'divyesh', '1234', 'd@gmail.com', 'myadmin2024', '2025-04-18 04:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `admin_codes`
--

CREATE TABLE `admin_codes` (
  `id` int(222) NOT NULL,
  `codes` varchar(666) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_codes`
--

INSERT INTO `admin_codes` (`id`, `codes`) VALUES
(1, 'QX5ZMN'),
(2, 'QFE6ZM'),
(3, 'QMZR92'),
(4, 'QPGIOV'),
(5, 'QSTE52'),
(6, 'QMTZ2J'),
(7, 'myadmin2024');

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `d_id` int(222) NOT NULL,
  `rs_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `slogan` varchar(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`d_id`, `rs_id`, `title`, `slogan`, `price`, `img`) VALUES
(12, 48, 'Hard Rock Cafe', 'A mix of chopped lettuces, shredded cheese, chicken cubes', 22.12, '5ad7590d9702b.jpg'),
(13, 49, 'Uno Pizzeria & Grill', 'Kids can choose their pasta shape, type of sauce, favorite veggies (like broccoli or mushrooms)', 12.35, '5ad7597aa0479.jpg'),
(22, 57, 'Dhosa', 'A Bite of South India in Every Crisp!', 70.00, '67b7d9c782b49.jpg'),
(23, 57, 'Idli Sambar', 'Soft Idlis, Spicy Sambar – A Perfect Pair!', 30.00, '67b7da29e1447.jpg'),
(24, 57, 'Medu Vada', 'Crispy Outside, Soft Inside – Pure Bliss', 40.00, '67b7dad31375a.jpg'),
(25, 57, 'Appam', 'A Kerala Classic, A World Favorite', 30.00, '67b7db3bcc6c8.jpg'),
(26, 57, 'Pongal ', 'A comforting rice and lentil dish', 120.00, '67b7dbc347dd2.jpg'),
(27, 57, 'Puttu ', 'Steamed rice flour cakes with coconut', 120.00, '67b7dd74d0fdf.jpg'),
(28, 57, 'Uttapam ', 'Thick, savory rice pancake', 80.00, '67b7dce6546a0.jpg'),
(29, 57, 'Thengai Sadam', 'Aromatic, Nutty, and Full of Flavor!', 60.00, '67b7de1c7cd08.jpg'),
(30, 50, 'Cheese Burst pizza', 'Extra cheesy delight with creamy mozzarella ', 220.00, '67b7e32a10e20.jpg'),
(31, 51, 'Alfredo Dream Pasta', 'Creamy, Dreamy, and Oh-So-Cheesy', 150.00, '67b7dfbdaded4.jpg'),
(32, 51, 'Truffle Cheese Pasta', 'Rich, creamy truffle-flavored delight', 140.00, '67b7e0c061626.jpg'),
(33, 48, ' Classic Grilled Cheeseburger ', 'Grilled patty, cheese, lettuce, tomato, and mayonnaise', 120.00, '67b7e1dc954ae.jpg'),
(34, 48, 'Smoky Peri Peri Burger', 'Spicy peri peri sauce and grilled patty', 90.00, '67b7e210b3c12.jpg'),
(35, 48, ' Veg Grilled Burger', 'Grilled paneer/soy patty, fresh vegetables, and sauce', 70.00, '67b7e298c55f3.jpg'),
(36, 48, 'Tandoori Grilled Burger', 'Indian tandoori spices with grilled chicken or paneer', 80.00, '67b7e2d18520f.jpg'),
(37, 48, 'BBQ Grilled Burger', 'Barbecue sauce, cheddar cheese, and crispy onion rings', 230.00, '67b7e3e032190.jpg'),
(38, 53, 'Fish & Chips', 'Crispy Fish, Perfect Chips – A Classic Delight!', 120.00, '67b7e4d3e9316.jpg'),
(39, 53, 'CrispyFishTacos', 'Golden Fish, Bold Flavors', 80.00, '67b7e5d1df9d3.jpg'),
(41, 58, 'Punjabi Dish', 'Every Bite Tells a Story of Punjab!', 300.00, '67b7e8ab5c864.jpg'),
(42, 58, 'Dal Makhani', 'Rich, Creamy & Full of Flavor!', 200.00, '67b80fe4e40ab.jpg'),
(43, 58, ' Paneer Butter Masala', 'A Punjabi Classic, Made with Love & Butter!', 100.00, '67b7e963264f0.jpg'),
(44, 59, 'Chole Bhature', 'Served with onions, pickle, and garlic chutney', 60.00, '67b7eb7b26efa.jpg'),
(45, 49, 'Shami Kebab', 'One Bite, Endless Indulgence', 80.00, '67b7ee6e45b50.jpg'),
(46, 49, 'Tandoori Kebab ', 'From the Tandoor, Straight to Your Heart!', 90.00, '67b7eed63bafa.jpg'),
(47, 49, 'Hariyali Kebab', 'Green, Grilled & Glorious!', 80.00, '67b7ef261ca2b.jpg'),
(48, 49, 'Kashmiri Kebab ', 'Kashmiri Spices, Royal Bites!', 120.00, '67b7ef636a8b5.jpg'),
(49, 49, 'Kofta Kebab', 'Juicy, Smoky, and Full of Flavor', 200.00, '67b7f01fbfddc.jpg'),
(50, 50, 'Garlic Bread', 'Crispy, Buttery, Garlicky – Pure Perfection', 60.00, '67b7f07125efa.jpg'),
(51, 49, 'Grill', 'Sizzle. Smoke. Satisfaction', 120.00, '67b7f0d312ad6.jpg'),
(52, 60, 'Kathiyawadi Dish', 'Swad Etlo Ke Gujarat Yaad Rahe!', 250.00, '67b7f2b0ac668.jpg'),
(53, 50, 'Tandoori Paneer Pizza', 'Smoky paneer tikka with tandoori sauce.', 140.00, '67b7f3559e3f1.jpg'),
(54, 52, 'Thai Spring Rolls', ' Crispy rolls filled with cabbage, carrots, and glass noodles, served with sweet chili sauce.', 140.00, '67b7f4043d337.jpg'),
(55, 52, 'Thai Coconut Soups', 'Creamy coconut milk soup with tender chicken, lemongrass, galangal, and kaffir lime leaves.', 160.00, '67b7f451ddb4b.jpg'),
(56, 52, 'thaicuisine', 'spicy, sweet, tangy, and aromatic Thai dishes!', 210.00, '67b7f4b7d2875.jpg'),
(58, 60, 'Undhiyu', 'Puri Sang Undhiyu, Taste No Jadoo!', 120.00, '67b80840ec95c.jpg'),
(59, 58, 'Shahi Paneer ', 'Soft Paneer, Rich Gravy – Taste the Shahi Magic!', 130.00, '67b808f1b5c90.jpg'),
(60, 60, 'Ringna Bateka', 'Simple Yet Spicy, Ringna Bateka is Always Tasty!\"', 50.00, '67b8096ad023c.jpg'),
(61, 60, 'Sev Tameta', 'Chatpato Swad, Gujarati No Asal Pyaar!', 40.00, '67b809ab2cbee.jpg'),
(62, 60, 'Salad', 'Healthy, Crunchy, & Full of Flavor!', 15.00, '67b809efafbfa.jpg'),
(63, 60, 'Rotla', 'Gujarati Rasoi Ni Shaan!', 7.00, '67b80a291080c.jpg'),
(64, 60, 'Rotli', 'Soft, Fluffy, & Full of Love!', 5.00, '67b80a5e4a263.jpg'),
(65, 50, 'Spicy Garlic Paneer Pizza', 'Roasted garlic, paneer & red chili flakes.', 110.00, '67b80b5f14c27.png'),
(66, 51, 'Pesto Perfection Pasta', 'A Bite of Italy, A Burst of Basil!', 70.00, '67b80c1d187d2.jpg'),
(67, 50, 'Paneer Tikka Pizza', 'Spicy, Cheesy & Irresistibly Tikka-fied!', 80.00, '67b80cd40e386.jpg'),
(68, 50, 'Mexican Veggie Supreme', 'Bell peppers, onions, sweet corn, jalapeños & olives', 100.00, '67b80d5f67cc4.jpg'),
(69, 50, 'Veggie Supreme Pizza', 'A  Supreme Pizza for Supreme Taste!', 130.00, '67b80dad8ff1d.jpg'),
(70, 58, 'Lachha Paratha', 'Bite into Tradition, One Layer at a Time!', 20.00, '67b80f51d9c0d.jpg'),
(71, 58, 'Roti', 'Handmade with Love, Served with Tradition!', 10.00, '67b80e3dd003b.jpg'),
(72, 60, 'Buttermilk', 'Chilled, Spiced & Simply Refreshing!', 10.00, '67b80ee4943a2.jpg'),
(73, 58, 'Lassi', 'Thick, Creamy & Oh-So-Dreamy!', 30.00, '67b80f30edc08.jpg'),
(74, 51, 'LasagnaLayers', 'Layered with Love, Baked to Perfection!', 150.00, '67b810c370ad7.jpg'),
(75, 59, 'Buttermilk', 'Stay Cool, Stay Fresh with Buttermilk!', 10.00, '67b811f902552.jpg'),
(77, 58, 'Buttermilk', 'Stay Cool, Stay Fresh with Buttermilk!', 10.00, '67b81265bc184.jpg'),
(78, 53, 'Crispy Fried Fish ', 'Golden, Crunchy & Irresistible!', 100.00, '67b81376cf4dd.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` decimal(2,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `res_id`, `user_id`, `rating`) VALUES
(2, 49, 34, 5.0),
(12, 50, 37, 5.0),
(13, 51, 37, 5.0),
(14, 52, 37, 2.0),
(15, 53, 37, 2.0),
(17, 53, 41, 5.0),
(23, 48, 41, 3.0),
(24, 48, 37, 4.0),
(25, 57, 44, 3.0),
(26, 58, 44, 3.0),
(27, 59, 44, 1.0),
(30, 53, 44, 4.0),
(31, 60, 44, 1.0);

-- --------------------------------------------------------

--
-- Table structure for table `remark`
--

CREATE TABLE `remark` (
  `id` int(11) NOT NULL,
  `frm_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `remark`
--

INSERT INTO `remark` (`id`, `frm_id`, `status`, `remark`, `remarkDate`) VALUES
(62, 32, 'in process', 'hi', '2018-04-18 17:35:52'),
(63, 32, 'closed', 'cc', '2018-04-18 17:36:46'),
(64, 32, 'in process', 'fff', '2018-04-18 18:01:37'),
(65, 32, 'closed', 'its delv', '2018-04-18 18:08:55'),
(66, 34, 'in process', 'on a way', '2018-04-18 18:56:32'),
(67, 35, 'closed', 'ok', '2018-04-18 18:59:08'),
(68, 37, 'in process', 'on the way!', '2018-04-18 19:50:06'),
(69, 37, 'rejected', 'if admin cancel for any reason this box is for remark only for buter perposes', '2018-04-18 19:51:19'),
(70, 37, 'closed', 'delivered success', '2018-04-18 19:51:50'),
(71, 49, 'in process', 'good', '2025-01-21 09:37:29'),
(72, 95, 'rejected', 'yes', '2025-01-22 09:15:38'),
(73, 49, 'in process', 'mkm', '2025-01-22 09:16:07'),
(74, 96, 'in process', 'ok', '2025-01-22 09:17:01'),
(75, 96, 'closed', 'ok', '2025-01-22 09:17:53'),
(76, 104, 'closed', 'ok', '2025-01-22 09:33:38'),
(77, 105, 'in process', 'ok', '2025-01-22 09:35:04'),
(78, 105, 'closed', 'feg', '2025-04-16 05:25:14'),
(79, 115, 'in process', 'good', '2025-04-16 05:26:22'),
(80, 185, 'in process', 'drf', '2025-04-17 09:10:19');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `rs_id` int(222) NOT NULL,
  `c_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `url` varchar(222) NOT NULL,
  `o_hr` varchar(222) NOT NULL,
  `c_hr` varchar(222) NOT NULL,
  `o_days` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `image` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`rs_id`, `c_id`, `title`, `email`, `phone`, `url`, `o_hr`, `c_hr`, `o_days`, `address`, `image`, `date`) VALUES
(48, 5, 'Hari Burger', 'HariBurger@gmail.com', ' 090412 64676', 'HariBurger.com', '7am', '4pm', 'mon-tue', ' Palace,   natwar jalandhar', '5ad74ce37c383.jpg', '2018-04-18 13:49:23'),
(49, 5, 'The Great Kabab Factory', 'kwbab@gmail.com', '011 2677 9070', 'kwbab.com', '6am', '5pm', 'mon-fri', 'Radisson Blu Plaza Hotel, Delhi Airport, NH-8, New Delhi, 110037', '5ad74de005016.jpg', '2018-04-18 13:53:36'),
(50, 6, 'Dominos Pizza', 'pizza@gmail.com', '090410 35147', 'domi.com', '10am', '8pm', '24hr-x7', ' Bhargav Nagar, Jalandhar - Nakodar Rd, Jalandhar, Punjab 144003 ', '67b7d5ab39966.jpg', '2025-02-21 01:23:55'),
(51, 7, 'Martini', 'martin@gmail.com', '3454345654', 'martin.com', '8am', '4pm', 'mon-thu', '399 L Near Apple Showroom, Model Town,', '5ad74ebf1d103.jpg', '2018-04-18 13:57:19'),
(52, 8, 'hudson', 'hud@gmail.com', '2345434567', 'hudson.com', '6am', '7pm', 'mon-fri', 'Opposite Lovely Sweets, Nakodar Road, Jalandhar, Punjab 144001', '5ad756f1429e3.jpg', '2018-04-18 14:32:17'),
(53, 9, 'Fish Ahoy!', 'fish@gmail.com', '4512545784', 'fish.com', '6am', '8pm', '24hr-x7', ' near kalu gali hotel india what everrrr. ', '67b7e55dbb6fb.jpg', '2025-02-21 02:30:53'),
(57, 14, 'Namma Ooru Kitchen ', 'southkitchen@gmail.com', '0904035147', 'http://southkitchen.com', '6am', '8pm', '24hr-x7', 'NH 66 Bypass Road  ,Edappally  ,Kochi - 682024  Kerala,', '67b7d7e646933.jpg', '2025-02-21 01:33:26'),
(58, 15, 'Pind Da Swad', 'punjabi@gmail.com', '7412589632', 'http://punjabi.com', '7am', '8pm', '24hr-x7', 'GT Road, Near Golden Temple, Amritsar, Punjab - 143001', '67b7e72e084f5.jpg', '2025-02-21 02:38:38'),
(59, 15, 'Patiala Haveli', 'haveli@gmail.com', '7412589632', 'http://punjabi.com', '9am', '8pm', '24hr-x7', 'Sher-E-Punjab Road, Beside Desi Tandoor Market , Jalandhar', '67b7ea91b2cfe.jpg', '2025-02-21 02:53:05'),
(60, 16, 'Padharo Kathiyawadi Restaurant', 'padharo@gmail.com', '7412589632', 'http://padharo.com', '6am', '8pm', '24hr-x7', ' Rajwadi Rasoi, Near Race Course, Rajkot ', '67b7f23f5bbbe.jpg', '2025-02-21 03:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `res_category`
--

CREATE TABLE `res_category` (
  `c_id` int(222) NOT NULL,
  `c_name` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `res_category`
--

INSERT INTO `res_category` (`c_id`, `c_name`, `date`) VALUES
(5, 'grill', '2018-04-14 18:45:28'),
(6, 'pizza', '2018-04-14 18:44:56'),
(7, 'pasta', '2018-04-14 18:45:13'),
(8, 'thaifood', '2018-04-14 18:32:56'),
(9, 'fish', '2018-04-14 18:44:33'),
(14, 'southIndian', '2025-01-22 10:21:13'),
(15, 'punjabi ', '2025-02-21 02:39:43'),
(16, 'Kathiyawadi ', '2025-02-21 03:21:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `f_name` varchar(222) NOT NULL,
  `l_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `status` int(222) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`, `status`, `date`) VALUES
(34, 'Drashti ', 'Drashti', 'Chavda', 'D@gmail.com', '7894561230', 'e10adc3949ba59abbe56e057f20f883e', 'rajkot', 1, '2022-08-03 06:45:14'),
(37, 'drashti', 'drashti', 'drashti', 'dd@gmail.com', '1234567890', '123456', 'rajkot', 1, '2025-02-21 01:14:49'),
(41, 'manu patel', 'mansi', 'kaila', 'mmmm1@gmail.com', '3748844839', '190180', 'snjd', 1, '2025-01-23 11:46:11'),
(44, 'hetanshree', 'Hetanshree', 'Maheta', 'hetanshreemehta@gmail.com', '9173633311', '1234', 'Rajkot.', 1, '2025-04-18 10:30:41'),
(57, 'Divyesh', 'divyesh', 'dhameshiya', 'ddd@gmail.com', '9712047015', '123456', 'Rajkot.', 1, '2025-04-19 07:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `users_orders`
--

CREATE TABLE `users_orders` (
  `o_id` int(222) NOT NULL,
  `u_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `quantity` int(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users_orders`
--

INSERT INTO `users_orders` (`o_id`, `u_id`, `title`, `quantity`, `price`, `status`, `date`) VALUES
(95, 37, 'fish fry', 1, 130.00, 'rejected', '2025-01-22 09:15:38'),
(96, 37, 'jklmno', 1, 17.99, 'closed', '2025-01-22 09:17:53'),
(105, 37, 'jklmno', 1, 17.99, 'closed', '2025-04-16 05:25:14'),
(115, 37, 'Bonefish', 1, 55.77, 'in process', '2025-04-16 05:26:22'),
(185, 44, 'Garlic Bread', 1, 60.00, 'in process', '2025-04-17 09:10:19'),
(193, 37, 'Roti', 1, 10.00, 'pending', '2025-04-18 10:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE `user_cart` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `rs_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `slogan` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `admin_codes`
--
ALTER TABLE `admin_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `res_id` (`res_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `remark`
--
ALTER TABLE `remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`rs_id`);

--
-- Indexes for table `res_category`
--
ALTER TABLE `res_category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `users_orders`
--
ALTER TABLE `users_orders`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`u_id`),
  ADD KEY `dishid` (`d_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adm_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `admin_codes`
--
ALTER TABLE `admin_codes`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `d_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `remark`
--
ALTER TABLE `remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `rs_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `res_category`
--
ALTER TABLE `res_category`
  MODIFY `c_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users_orders`
--
ALTER TABLE `users_orders`
  MODIFY `o_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `restaurant` (`rs_id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`u_id`);

--
-- Constraints for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD CONSTRAINT `dishid` FOREIGN KEY (`d_id`) REFERENCES `dishes` (`d_id`),
  ADD CONSTRAINT `userid` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
