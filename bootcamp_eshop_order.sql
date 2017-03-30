# order

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NULL DEFAULT NULL,
  `ordered_at` datetime NULL DEFAULT NULL,
  `total_price` float NULL DEFAULT NULL,
  `is_shipped` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `customer_id_fk` (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

# customer

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) NULL COLLATE utf8_czech_ci DEFAULT NULL,
  `address` text NULL COLLATE utf8_czech_ci DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_fk` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

# order_has_product

DROP TABLE IF EXISTS `order_has_product`;

CREATE TABLE `order_has_product` (
  `order_id` int(11) NULL DEFAULT NULL,
  `product_id` int(11) NULL DEFAULT NULL,
  `amount` float NULL DEFAULT NULL,
  `unit_price` float NULL DEFAULT NULL,
  PRIMARY KEY (`order_id`, `product_id`),
  KEY `order_id_fk` (`order_id`),
  KEY `product_id_fk` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

# user

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(127) NULL COLLATE utf8_czech_ci DEFAULT NULL,
  `email` varchar(127) NULL COLLATE utf8_czech_ci DEFAULT NULL,
  `password` varchar(64) NULL COLLATE utf8_czech_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
  
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;