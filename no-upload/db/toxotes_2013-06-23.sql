# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.29)
# Database: toxotes
# Generation Time: 2013-06-23 10:47:41 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table extension
# ------------------------------------------------------------

DROP TABLE IF EXISTS `extension`;

CREATE TABLE `extension` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `author_email` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` enum('PLUGIN','MODULE') DEFAULT NULL,
  `path` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_time` datetime NOT NULL,
  `modified_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `extension` WRITE;
/*!40000 ALTER TABLE `extension` DISABLE KEYS */;

INSERT INTO `extension` (`id`, `name`, `author`, `author_email`, `description`, `type`, `path`, `status`, `created_time`, `modified_time`)
VALUES
	(1,'Simple Event','Lưu Trọng Hiếu','tronghieu.luu@gmail.com',NULL,'PLUGIN','simple_event/simple_event.php',1,'2013-05-22 10:32:38','2013-05-22 10:32:34');

/*!40000 ALTER TABLE `extension` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table item_attachments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `item_attachments`;

CREATE TABLE `item_attachments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `file` text NOT NULL,
  `file_name` varchar(255) NOT NULL DEFAULT '',
  `mime_type` text NOT NULL,
  `type_group` varchar(100) NOT NULL DEFAULT '',
  `uploaded_time` datetime NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table item_custom_fields
# ------------------------------------------------------------

DROP TABLE IF EXISTS `item_custom_fields`;

CREATE TABLE `item_custom_fields` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `cf_id` int(11) NOT NULL,
  `text_value` text NOT NULL,
  `number_value` double(20,2) NOT NULL DEFAULT '0.00',
  `bool_value` tinyint(4) NOT NULL DEFAULT '0',
  `datetime_value` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table item_images
# ------------------------------------------------------------

DROP TABLE IF EXISTS `item_images`;

CREATE TABLE `item_images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `is_main` tinyint(1) NOT NULL,
  `created_time` datetime NOT NULL,
  `modified_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table item_property
# ------------------------------------------------------------

DROP TABLE IF EXISTS `item_property`;

CREATE TABLE `item_property` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `property` varchar(255) NOT NULL DEFAULT '',
  `text_value` text,
  `int_value` int(11) DEFAULT NULL,
  `float_value` decimal(20,2) DEFAULT NULL,
  `boolean_value` tinyint(1) DEFAULT NULL,
  `datetime_value` datetime DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `term_id` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `excerpt` text,
  `content` text,
  `status` varchar(20) NOT NULL DEFAULT 'PUBLISH',
  `author` varchar(255) DEFAULT NULL,
  `taxonomy` varchar(100) NOT NULL DEFAULT 'POST',
  `language` varchar(20) NOT NULL DEFAULT '*',
  `modified_time` datetime NOT NULL,
  `created_time` datetime NOT NULL,
  `ordering` int(11) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `ordering` (`ordering`),
  KEY `status` (`status`,`created_time`,`ordering`),
  KEY `taxonomy` (`taxonomy`),
  KEY `taxonomy_status` (`status`,`taxonomy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table languages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `lang_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lang_code` char(7) NOT NULL,
  `title` varchar(50) NOT NULL,
  `title_native` varchar(50) NOT NULL,
  `sef` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` varchar(512) NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `sitename` varchar(1024) NOT NULL DEFAULT '',
  `published` int(11) NOT NULL DEFAULT '0',
  `default` int(10) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lang_id`),
  UNIQUE KEY `idx_sef` (`sef`),
  UNIQUE KEY `idx_image` (`image`),
  UNIQUE KEY `idx_langcode` (`lang_code`),
  KEY `idx_access` (`default`),
  KEY `idx_ordering` (`ordering`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;

INSERT INTO `languages` (`lang_id`, `lang_code`, `title`, `title_native`, `sef`, `image`, `description`, `metakey`, `metadesc`, `sitename`, `published`, `default`, `ordering`)
VALUES
	(1,'en-GB','English (UK)','English (UK)','en','en','','','','',1,0,1),
	(2,'vi-VN','Tiếng Việt','Tiếng Việt (VI)','vi','vi','','','','',1,1,0);

/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `lvl` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `scope_id` int(11) DEFAULT NULL,
  `admin_access` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `lvl`, `lft`, `rgt`, `scope_id`, `admin_access`)
VALUES
	(14,'Anonymous',0,1,12,NULL,0),
	(15,'Authenticated',1,2,11,NULL,0),
	(16,'Public',2,3,4,NULL,0),
	(17,'Manager',2,5,10,NULL,1),
	(18,'Administrator',3,6,9,NULL,1),
	(19,'Super Administrator',4,7,8,NULL,1);

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table setting
# ------------------------------------------------------------

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `setting_key` varchar(255) NOT NULL DEFAULT '',
  `setting_value` text NOT NULL,
  PRIMARY KEY (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table term_custom_fields
# ------------------------------------------------------------

DROP TABLE IF EXISTS `term_custom_fields`;

CREATE TABLE `term_custom_fields` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` int(11) NOT NULL,
  `field_key` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `type` enum('INPUT','TEXTAREA','RADIO','SELECT') NOT NULL DEFAULT 'INPUT',
  `accept_value` text,
  `format` enum('TEXT','NUMBER','BOOL','DATETIME') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table term_property
# ------------------------------------------------------------

DROP TABLE IF EXISTS `term_property`;

CREATE TABLE `term_property` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` int(11) NOT NULL,
  `property` varchar(255) NOT NULL DEFAULT '',
  `text_value` text,
  `int_value` int(11) DEFAULT '0',
  `float_value` decimal(20,4) DEFAULT NULL,
  `bolean_value` tinyint(1) DEFAULT NULL,
  `datetime_value` datetime DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table term_relationship
# ------------------------------------------------------------

DROP TABLE IF EXISTS `term_relationship`;

CREATE TABLE `term_relationship` (
  `object_id` int(11) NOT NULL DEFAULT '0',
  `term_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) DEFAULT NULL,
  PRIMARY KEY (`object_id`,`term_id`),
  KEY `object_id` (`object_id`),
  KEY `term_id` (`term_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table terms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `terms`;

CREATE TABLE `terms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `slug` varchar(255) DEFAULT NULL,
  `taxonomy` varchar(100) NOT NULL DEFAULT '',
  `description` text,
  `language` varchar(20) NOT NULL DEFAULT '*',
  `count` int(11) NOT NULL,
  `scope` varchar(100) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `scope_id` (`name`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `terms` WRITE;
/*!40000 ALTER TABLE `terms` DISABLE KEYS */;

INSERT INTO `terms` (`id`, `name`, `slug`, `taxonomy`, `description`, `language`, `count`, `scope`, `lft`, `rgt`, `lvl`)
VALUES
	(15,'Root of category',NULL,'category',NULL,'*',0,'category',1,26,0),
	(16,'Tiếng Việt','tieng-viet','category',NULL,'vi-VN',0,'category',2,13,1),
	(17,'Giới Thiệu','gioi-thieu','category',NULL,'vi-VN',0,'category',3,12,2),
	(19,'English','english','category',NULL,'en-GB',0,'category',14,25,1),
	(20,'Tổ chức','to-chuc','category',NULL,'vi-VN',0,'category',4,5,3),
	(21,'Quản lý VHATTC','quan-ly-vhattc','category',NULL,'vi-VN',0,'category',6,7,3),
	(22,'Ban Cố vấn VHATTC','ban-co-van-vhattc','category',NULL,'vi-VN',0,'category',10,11,3),
	(23,'Nhân viên VHATTC','nhan-vien-vhattc','category',NULL,'vi-VN',0,'category',8,9,3),
	(24,'About Us','about-us','category',NULL,'en-GB',0,'category',15,24,2),
	(25,'Organization','organization','category',NULL,'en-GB',0,'category',16,18,3),
	(26,'VHATTC Managing Board','vhattc-managing-board','category',NULL,'en-GB',0,'category',19,20,3),
	(27,'VHATTC Advisory Board','vhattc-advisory-board','category',NULL,'en-GB',0,'category',20,21,3),
	(28,'VHATTC Staff','vhattc-staff','category',NULL,'en-GB',0,'category',22,23,3),
	(31,'Root of event_manager','root-of-eventmanager','event_manager',NULL,'*',0,'event_manager',1,2,0),
	(32,'Root of post','root-of-post','post',NULL,'*',0,'post',1,2,0);

/*!40000 ALTER TABLE `terms` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `user_id` int(11) unsigned NOT NULL,
  `role_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;

INSERT INTO `user_role` (`user_id`, `role_id`)
VALUES
	(1,19);

/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` char(64) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(255) DEFAULT '',
  `phone_number` varchar(100) DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1: active, 0: inactive, -1: deleted',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `active_email` tinyint(4) NOT NULL DEFAULT '0',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `secret` char(32) NOT NULL,
  `last_visit_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `register_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_time` int(11) NOT NULL DEFAULT '0',
  `created_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `phone_number`, `status`, `banned`, `active_email`, `birthday`, `secret`, `last_visit_time`, `register_time`, `modified_time`, `created_time`)
VALUES
	(1,'tronghieu','8d4a275a81f03d619be9dc0caefa361c69bdbf8dd5508f4df7c740b4185258a2','tronghieu.luu@gmail.com','Lưu Trọng Hiếu','0989388300',1,0,1,'1985-12-10','697d6b3664158512ab6596bda46c65ae','2013-06-23 15:38:44','2013-05-07 15:23:13',1371976724,1367916104),
	(3,'thuyanh','b1a4c6218389de138ee95629e92a5768d44d21cd8f5b46f3f9f012070331fbaf','thuyanh@gmail.com','Nguyễn Thùy Anh','',1,0,1,'0000-00-00','893ed74e258e209931a5ace399a4cc33','0000-00-00 00:00:00','2013-05-07 15:31:36',1368002688,1367916104),
	(4,'admin','ae84841430fd0ba539aecdcfd1492b49bd10c0e95704c683666557a495be0a7c','admin@localhost.com','Administrator','',1,0,0,'0000-00-00','8613595b5afe0f2dbb4a905c88b8a525','0000-00-00 00:00:00','2013-05-08 15:51:33',1368003093,1368003093),
	(6,'manager','c242e832873544e722c2a9563a29ed0bc949e6aae5392c3b2f1dd4c642460851','manager@localhost.com','Manager','',1,0,0,'0000-00-00','f4a430e07579f886b84800945dc85ba4','0000-00-00 00:00:00','2013-05-25 11:13:33',1369455213,1369455213),
	(7,'thuytrang','641d343a85f2fdff9c7e5440a0d2c0d57909196af56c50130224abd704bbb1a8','thuytrang@gmail.com','Nguyễn Thùy Trang','',1,0,0,'0000-00-00','765562b94f67ca7edf8c98d1dd038c2b','0000-00-00 00:00:00','2013-06-15 09:28:19',1371263299,1371263299);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users_profiles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_profiles`;

CREATE TABLE `users_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `profile_key` varchar(255) NOT NULL DEFAULT '',
  `profile_value` varchar(255) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
