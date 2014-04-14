SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- テーブルの構造 `town_dev_articles`
--

CREATE TABLE IF NOT EXISTS `town_dev_articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(128) NOT NULL,
  `body` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `town_dev_battles`
--

CREATE TABLE IF NOT EXISTS `town_dev_battles` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `user_id` int(16) NOT NULL,
  `opponent` int(16) NOT NULL,
  `energy` int(16) NOT NULL,
  `spirit` int(16) NOT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `town_dev_chats`
--

CREATE TABLE IF NOT EXISTS `town_dev_chats` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `message` varchar(256) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `town_dev_comments`
--

CREATE TABLE IF NOT EXISTS `town_dev_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `article_id` int(10) unsigned NOT NULL,
  `message` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `town_dev_houses`
--

CREATE TABLE IF NOT EXISTS `town_dev_houses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `image_id` int(10) unsigned NOT NULL,
  `image` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `town_dev_images`
--

CREATE TABLE IF NOT EXISTS `town_dev_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `dir` varchar(255) NOT NULL,
  `subdir` varchar(255) NOT NULL,
  `mimetype` varchar(255) NOT NULL,
  `filesize` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `town_dev_items`
--

CREATE TABLE IF NOT EXISTS `town_dev_items` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(16) NOT NULL,
  `name` varchar(32) NOT NULL,
  `asin` varchar(128) NOT NULL,
  `image` varchar(512) NOT NULL,
  `price` int(11) NOT NULL,
  `life` int(11) NOT NULL,
  `interval` int(11) NOT NULL,
  `description` varchar(128) NOT NULL,
  `height` int(11) NOT NULL,
  `weight` float NOT NULL,
  `special` text NOT NULL,
  `stock` int(11) NOT NULL,
  `rand` int(11) NOT NULL,
  `energy` int(11) NOT NULL,
  `spirit` int(11) NOT NULL,
  `language` int(11) NOT NULL,
  `math` int(11) NOT NULL,
  `science` int(11) NOT NULL,
  `society` int(11) NOT NULL,
  `power` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `soft` int(11) NOT NULL,
  `beauty` int(11) NOT NULL,
  `technic` int(11) NOT NULL,
  `lucky` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `town_dev_items_shops`
--

CREATE TABLE IF NOT EXISTS `town_dev_items_shops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `town_dev_items_stores`
--

CREATE TABLE IF NOT EXISTS `town_dev_items_stores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(10) unsigned NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `life` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `town_dev_items_users`
--

CREATE TABLE IF NOT EXISTS `town_dev_items_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `life` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `town_dev_mails`
--

CREATE TABLE IF NOT EXISTS `town_dev_mails` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(16) unsigned NOT NULL,
  `to` int(10) unsigned NOT NULL,
  `title` varchar(128) NOT NULL,
  `message` text NOT NULL,
  `read` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `town_dev_maps`
--

CREATE TABLE IF NOT EXISTS `town_dev_maps` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `town_dev_petas`
--

CREATE TABLE IF NOT EXISTS `town_dev_petas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `house_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `message` varchar(256) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `town_dev_responses`
--

CREATE TABLE IF NOT EXISTS `town_dev_responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `town_dev_shops`
--

CREATE TABLE IF NOT EXISTS `town_dev_shops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `house_id` int(10) unsigned NOT NULL,
  `name` varchar(64) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `town_dev_stores`
--

CREATE TABLE IF NOT EXISTS `town_dev_stores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `house_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `stock` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `town_dev_threads`
--

CREATE TABLE IF NOT EXISTS `town_dev_threads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `town_dev_units`
--

CREATE TABLE IF NOT EXISTS `town_dev_units` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `image` varchar(64) NOT NULL,
  `url` varchar(64) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `town_dev_users`
--

CREATE TABLE IF NOT EXISTS `town_dev_users` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL,
  `status` enum('','spa','battle') NOT NULL,
  `email` varchar(64) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `image_id` int(10) unsigned NOT NULL,
  `image` varchar(255) NOT NULL,
  `born` date NOT NULL,
  `money` bigint(20) NOT NULL,
  `weight` float NOT NULL,
  `height` int(11) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `energy` int(11) NOT NULL,
  `spirit` int(11) NOT NULL,
  `math` int(11) NOT NULL,
  `science` int(11) NOT NULL,
  `language` int(11) NOT NULL,
  `society` int(11) NOT NULL,
  `power` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `soft` int(11) NOT NULL,
  `beauty` int(11) NOT NULL,
  `technic` int(11) NOT NULL,
  `lucky` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `recovered` datetime NOT NULL,
  `chat_id` int(11) NOT NULL,
  `item_limit` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

