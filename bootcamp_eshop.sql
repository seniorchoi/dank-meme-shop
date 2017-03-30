-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Čtv 03. lis 2016, 17:38
-- Verze serveru: 10.1.13-MariaDB
-- Verze PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `bootcamp_eshop`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `uri` varchar(127) COLLATE utf8_czech_ci DEFAULT NULL,
  `name` varchar(127) COLLATE utf8_czech_ci DEFAULT NULL,
  `description` text COLLATE utf8_czech_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `category`
--

INSERT INTO `category` (`id`, `parent_id`, `uri`, `name`, `description`) VALUES
(1, NULL, 'pcs-and-laptops', 'PCs & Laptops', NULL),
(2, NULL, 'mobile-phones', 'Mobile phones', NULL),
(3, NULL, 'televisions', 'Televisions', NULL),
(4, NULL, 'appliances', 'Appliances', NULL),
(5, 1, 'laptops', 'Laptops', NULL),
(6, 1, 'pcs', 'PCs', NULL),
(7, 2, 'iphone', 'iPhone', NULL),
(8, 2, 'android', 'Android', NULL),
(9, 2, 'windows', 'Windows', NULL),
(10, 4, 'cooking', 'Cooking', NULL),
(11, 4, 'ironing', 'Ironing', NULL),
(12, 4, 'washing-machines', 'Washing machines', NULL),
(13, 4, 'coffee-preparation', 'Coffee preparation', NULL),
(14, 4, 'refridgerators', 'Refridgerators', NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `category_has_product`
--

CREATE TABLE `category_has_product` (
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `category_has_product`
--

INSERT INTO `category_has_product` (`category_id`, `product_id`) VALUES
(5, 1),
(5, 2),
(6, 3),
(6, 4),
(6, 5);

-- --------------------------------------------------------

--
-- Struktura tabulky `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(127) COLLATE utf8_czech_ci DEFAULT NULL,
  `address` text COLLATE utf8_czech_ci,
  `user_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `myshop_product_params`
--

CREATE TABLE `myshop_product_params` (
  `product_id` int(11) NOT NULL,
  `brand` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  `model` varchar(127) COLLATE utf8_czech_ci DEFAULT NULL,
  `color` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `myshop_product_params`
--

INSERT INTO `myshop_product_params` (`product_id`, `brand`, `model`, `color`) VALUES
(1, 'Lenovo', 'ThinkPad Yoga 260', 'black'),
(2, 'Apple', 'MacBook', 'silver'),
(3, 'HP', 'ProDesk 600', 'black'),
(4, 'Alza', 'Office Mini', 'silver'),
(5, 'Lenovo', 'IdeaCentre 300', 'black');

-- --------------------------------------------------------

--
-- Struktura tabulky `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `ordered_at` datetime DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `is_shipped` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `order_has_product`
--

CREATE TABLE `order_has_product` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `unit_price` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `description` text COLLATE utf8_czech_ci,
  `price` float DEFAULT NULL,
  `unit_qty` float NOT NULL DEFAULT '1',
  `amount_in_stock` float NOT NULL DEFAULT '0',
  `is_top` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `unit_qty`, `amount_in_stock`, `is_top`) VALUES
(1, 'Lenovo ThinkPad Yoga 260', 'Tablet PC - Ultrabook certification, Intel Core i5 6200U Skylake, multitouch 12.5" LED IPS 1920x1080 anti-glare, 8GB RAM, Intel HD Graphics 520, SSD 256GB, WiFi, Bluetooth 4.1, webcam, mini DisplayPort, HDMI, USB 3.0, fingerprint scanner, dockable, backlit keyboard, pen, Windows 10 Pro 64bit (20FD0-01X)', 36790, 1, 3, 0),
(2, 'MacBook Air 13"', 'MacBook - Intel Core i5 1.6GHz Broadwell, 13.3" LED 1440x900, RAM 8GB, Intel HD Graphics 6000, SSD 256GB, WiFi 802.11ac, BlueTooth 4.0, Bluetooth 4.0, webcam, USB 3.0, 1x Thunderbolt port, backlit keyboard, MAC OS X El Capitan', 36990, 1, 7, 1),
(3, 'HP ProDesk 600 G1 Tower', 'Computer - Intel Core i3 4160 Haswell, four GB of DDR3 RAM, Intel HD Graphics 4400, 500 GB 7200 RPM HDD, DVD, DVI, USB 3.0, Keyboard and Mouse, Windows 8.1 Pro 64-bit - preinstalled Windows 7 Professional 64-bit (J7C46EA)', 17990, 1, 2, 0),
(4, 'Office Mini i3 W10 Pro', 'Computer - Intel Core i3 6100U 2.3GHz Skylake, RAM 8GB DDR4, HD Graphic 520, SSD 120GB, 4x USB 3.0, mDP, mHDMI, WiFi, Bluetooth, Windows 10 Pro 64-bit, VESA, Top Office', 15490, 1, 17, 1),
(5, 'Lenovo IdeaCentre 300-22ISU Black', 'All In One PC - 21.5 "LED 1920x1080 IPS, Intel Celeron Dual Core 3855 Skylake, RAM 4 gigabytes DDR4, Intel HD Graphics 510, HDD 500 gigabytes 7200 RPM, DVD burner, WiFi, Bluetooth 4.0, HD webcam, HDMI, USB 3.0, card reader, speakers, USB keyboard and mouse, Windows 10 Home 64bit', 10999, 1, 4, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `product_image`
--

CREATE TABLE `product_image` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `filename` varchar(127) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `order`, `filename`) VALUES
(1, 1, 1, '1-1.jpg'),
(2, 1, 2, '1-2.jpg'),
(3, 1, 3, '1-3.jpg'),
(4, 1, 4, '1-4.jpg'),
(5, 1, 5, '1-5.jpg'),
(6, 1, 6, '1-6.jpg'),
(7, 1, 7, '1-7.jpg'),
(8, 2, 1, '2-1.jpg'),
(9, 2, 2, '2-2.jpg'),
(10, 2, 3, '2-3.jpg'),
(11, 2, 4, '2-4.jpg'),
(12, 2, 5, '2-5.jpg'),
(13, 2, 6, '2-6.jpg'),
(14, 2, 7, '2-7.jpg'),
(15, 3, 1, '3-1.jpg'),
(16, 3, 2, '3-2.jpg'),
(17, 3, 3, '3-3.jpg'),
(18, 3, 4, '3-4.jpg'),
(19, 4, 1, '4-1.jpg'),
(20, 4, 2, '4-2.jpg'),
(21, 4, 3, '4-3.jpg'),
(22, 4, 4, '4-4.jpg'),
(23, 5, 1, '5-1.jpg'),
(24, 5, 2, '5-2.jpg'),
(25, 5, 3, '5-3.jpg'),
(26, 5, 4, '5-4.jpg'),
(27, 5, 5, '5-5.jpg'),
(28, 5, 6, '5-6.jpg'),
(29, 5, 7, '5-7.jpg'),
(30, 5, 8, '5-8.jpg');

-- --------------------------------------------------------

--
-- Struktura tabulky `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(127) COLLATE utf8_czech_ci DEFAULT NULL,
  `email` varchar(127) COLLATE utf8_czech_ci DEFAULT NULL,
  `password` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uri` (`uri`),
  ADD KEY `parent_id_fk` (`parent_id`);

--
-- Klíče pro tabulku `category_has_product`
--
ALTER TABLE `category_has_product`
  ADD PRIMARY KEY (`category_id`,`product_id`),
  ADD KEY `category_id_fk` (`category_id`),
  ADD KEY `product_id_fk` (`product_id`);

--
-- Klíče pro tabulku `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Klíče pro tabulku `myshop_product_params`
--
ALTER TABLE `myshop_product_params`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_id_fk` (`product_id`);

--
-- Klíče pro tabulku `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id_fk` (`customer_id`);

--
-- Klíče pro tabulku `order_has_product`
--
ALTER TABLE `order_has_product`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `order_id_fk` (`order_id`),
  ADD KEY `product_id_fk` (`product_id`);

--
-- Klíče pro tabulku `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id_fk` (`product_id`),
  ADD KEY `product_order` (`product_id`,`order`);

--
-- Klíče pro tabulku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pro tabulku `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pro tabulku `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pro tabulku `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pro tabulku `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT pro tabulku `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
