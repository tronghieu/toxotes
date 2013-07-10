# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.29)
# Database: toxotes
# Generation Time: 2013-07-10 10:43:01 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table banner
# ------------------------------------------------------------

DROP TABLE IF EXISTS `banner`;

CREATE TABLE `banner` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `img_alt` varchar(255) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(10) NOT NULL DEFAULT '_self',
  `auto_size` tinyint(1) NOT NULL DEFAULT '0',
  `width` int(11) NOT NULL DEFAULT '0',
  `height` int(11) NOT NULL DEFAULT '0',
  `wrapper_id` varchar(255) DEFAULT NULL,
  `wrapper_class` varchar(255) DEFAULT NULL,
  `is_visible` varchar(255) DEFAULT NULL,
  `language` char(10) NOT NULL DEFAULT '*',
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `clicked` int(11) NOT NULL DEFAULT '0',
  `description` text,
  `created_date` datetime NOT NULL,
  `modified_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `term_id` (`term_id`,`status`,`ordering`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `banner` WRITE;
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;

INSERT INTO `banner` (`id`, `term_id`, `file`, `title`, `ordering`, `img_alt`, `link`, `link_target`, `auto_size`, `width`, `height`, `wrapper_id`, `wrapper_class`, `is_visible`, `language`, `status`, `clicked`, `description`, `created_date`, `modified_time`)
VALUES
	(9,41,'/media/banner/51d285e712155.jpg','Slideshow 1',1,'','','_self',0,0,0,NULL,NULL,NULL,'*','ACTIVE',0,NULL,'0000-00-00 00:00:00','2013-07-02 14:48:55'),
	(10,41,'/media/banner/51d29407695c2.jpg','Slideshow 2',2,'','','_self',0,0,0,NULL,NULL,NULL,'*','ACTIVE',0,NULL,'2013-07-02 16:00:59','2013-07-02 16:00:59'),
	(11,41,'/media/banner/51d297692dea3.jpg','Slideshow 3',3,'','','_self',0,0,0,NULL,NULL,NULL,'*','ACTIVE',0,NULL,'2013-07-02 16:03:45','2013-07-02 16:05:54'),
	(12,42,'/media/banner/51dd0bc8526ac.jpg','VAAC',1,'','http://www.vaac.gov.vn/','_blank',0,0,0,NULL,NULL,NULL,'*','ACTIVE',0,NULL,'2013-07-10 14:22:48','2013-07-10 14:24:23'),
	(13,42,'/media/banner/51dd0be8a1a21.jpg','DSEP/MOLISA',2,'','http://www.molisa.gov.vn/','_blank',0,0,0,NULL,NULL,NULL,'*','ACTIVE',0,NULL,'2013-07-10 14:23:20','2013-07-10 14:23:59'),
	(14,42,'/media/banner/51dd0c57bceb2.png','FHI360',3,'','http://www.fhi360.org','_blank',0,0,0,NULL,NULL,NULL,'*','ACTIVE',0,NULL,'2013-07-10 14:25:11','2013-07-10 14:25:11'),
	(15,42,'/media/banner/51dd0ca245bc1.png','ATTC',4,'','http://attcnetwork.org/index.asp','_blank',0,0,0,NULL,NULL,NULL,'*','ACTIVE',0,NULL,'2013-07-10 14:26:26','2013-07-10 14:26:26'),
	(16,42,'/media/banner/51dd0cd2ba276.png','PEPFAR',5,'','http://www.pepfar.gov/','_blank',0,0,0,NULL,NULL,NULL,'*','ACTIVE',0,NULL,'2013-07-10 14:27:14','2013-07-10 14:27:14');

/*!40000 ALTER TABLE `banner` ENABLE KEYS */;
UNLOCK TABLES;


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


# Dump of table menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(10) NOT NULL DEFAULT '',
  `route` varchar(20) NOT NULL DEFAULT '',
  `route_param` text NOT NULL,
  `link` text NOT NULL,
  `object` varchar(255) NOT NULL DEFAULT '',
  `extra_param` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `lvl` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table post_attachments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_attachments`;

CREATE TABLE `post_attachments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `file` text NOT NULL,
  `file_name` varchar(255) NOT NULL DEFAULT '',
  `mime_type` text NOT NULL,
  `type_group` varchar(100) NOT NULL DEFAULT '',
  `hits` int(11) NOT NULL DEFAULT '0',
  `uploaded_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table post_custom_fields
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_custom_fields`;

CREATE TABLE `post_custom_fields` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `cf_id` int(11) NOT NULL,
  `text_value` text NOT NULL,
  `number_value` double(20,2) NOT NULL DEFAULT '0.00',
  `bool_value` tinyint(4) NOT NULL DEFAULT '0',
  `datetime_value` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table post_images
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_images`;

CREATE TABLE `post_images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `is_main` tinyint(1) NOT NULL,
  `created_time` datetime NOT NULL,
  `modified_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `post_images` WRITE;
/*!40000 ALTER TABLE `post_images` DISABLE KEYS */;

INSERT INTO `post_images` (`id`, `post_id`, `path`, `caption`, `is_main`, `created_time`, `modified_time`)
VALUES
	(24,66,'/media/post_img/51dce661b07d4.jpg',NULL,1,'2013-07-10 11:43:13','2013-07-10 11:43:13'),
	(25,64,'/media/post_img/51dce6fbb270b.jpg',NULL,1,'2013-07-10 11:45:47','2013-07-10 11:45:47'),
	(26,63,'/media/post_img/51dce7edca70a.jpg',NULL,1,'2013-07-10 11:49:49','2013-07-10 11:49:49'),
	(27,67,'/media/post_img/51dce87638665.jpg',NULL,1,'2013-07-10 11:52:06','2013-07-10 11:52:06'),
	(28,70,'/media/post_img/51dce8e04cc32.jpg',NULL,1,'2013-07-10 11:53:52','2013-07-10 11:53:52'),
	(29,62,'/media/post_img/51dce9f37ecb7.jpg',NULL,1,'2013-07-10 11:58:27','2013-07-10 11:58:27'),
	(30,78,'/media/post_img/51dceaee13229.jpg',NULL,1,'2013-07-10 12:02:38','2013-07-10 12:02:38'),
	(31,80,'/media/post_img/51dceb9d3bc6e.jpg',NULL,1,'2013-07-10 12:05:33','2013-07-10 12:05:33'),
	(32,85,'/media/post_img/51dcee49af62d.jpg',NULL,1,'2013-07-10 12:16:57','2013-07-10 12:16:57'),
	(33,84,'/media/post_img/51dcee537a8c1.jpg',NULL,1,'2013-07-10 12:17:07','2013-07-10 12:17:07');

/*!40000 ALTER TABLE `post_images` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table post_property
# ------------------------------------------------------------

DROP TABLE IF EXISTS `post_property`;

CREATE TABLE `post_property` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `property` varchar(255) NOT NULL DEFAULT '',
  `text_value` text,
  `int_value` int(11) DEFAULT NULL,
  `float_value` decimal(20,2) DEFAULT NULL,
  `boolean_value` tinyint(1) DEFAULT NULL,
  `datetime_value` datetime DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `item_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `term_id` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `excerpt` text,
  `content` text,
  `status` varchar(20) NOT NULL DEFAULT 'PUBLISH',
  `is_draft` tinyint(1) NOT NULL DEFAULT '0',
  `author` varchar(255) DEFAULT NULL,
  `taxonomy` varchar(100) NOT NULL DEFAULT 'POST',
  `language` varchar(20) NOT NULL DEFAULT '*',
  `ordering` int(11) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `is_pin` tinyint(1) NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `ordering` (`ordering`),
  KEY `status` (`status`,`created_time`,`ordering`),
  KEY `taxonomy` (`taxonomy`),
  KEY `taxonomy_status` (`status`,`taxonomy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`id`, `title`, `term_id`, `slug`, `excerpt`, `content`, `status`, `is_draft`, `author`, `taxonomy`, `language`, `ordering`, `hits`, `is_pin`, `modified_time`, `created_time`)
VALUES
	(34,'Giới thiệu chung',17,'gioi-thieu-chung',NULL,'<p>Trường Đại học Y H&agrave; Nội phối hợp với ISAP (Chương tr&igrave;nh ĐIều trị Nghiện chất Lồng gh&eacute;p) của Đại học UCLA, Hoa Kỳ khởi động&nbsp; dự &aacute;n th&agrave;nh lập&nbsp;<strong>Trung t&acirc;m Chuyển giao C&ocirc;ng nghệ điều trị Nghiện chất&nbsp;v&agrave; HIV</strong>&nbsp;(viết tắt l&agrave;&nbsp;<strong>VHATTC</strong>) v&agrave;o cuối năm 2011 với sự hỗ trợ từ ph&iacute;a&nbsp;Chương tr&igrave;nh cứu trợ khẩn cấp về ph&ograve;ng chống HIV/AIDS của Tổng thống Hoa Kỳ&nbsp; (PEPFAR) v&agrave; Cục Quản l&yacute; lạm dụng Chất g&acirc;y nghiện v&agrave; Sức khỏe t&acirc;m thần (Substance Abuse and Mental Health Services Administration- SAMHSA) Hoa Kỳ, phối hợp với Trường Đại học Y H&agrave; Nội v&agrave; Chương tr&igrave;nh Điều trị lạm dụng nghiện chất lồng gh&eacute;p (Integrated Substance Abuse Program- ISAP) thuộc Trường Đại học California, Hoa Kỳ.</p>\r\n<p>Theo b&aacute;o c&aacute;o của Bộ Y tế, t&iacute;nh đến th&aacute;ng 6 năm 2012, tr&ecirc;n to&agrave;n quốc&nbsp;c&oacute; hơn 200.000 người nhiễm HIV c&ograve;n sống,&nbsp;trong đ&oacute; c&oacute; hơn 58.000 người đ&atilde; chuyển sang giai đoạn AIDS, v&agrave; đ&atilde; c&oacute; hơn 60.000 người tử vong do HIV/AIDS. Mặc d&ugrave; trong những năm gần đ&acirc;y l&acirc;y truyền qua đường t&igrave;nh dục ng&agrave;y c&agrave;ng gia tăng mạnh mẽ, l&acirc;y nhiễm qua ti&ecirc;m ch&iacute;ch ma tu&yacute; kh&ocirc;ng an to&agrave;n vẫn l&agrave; nguy&ecirc;n nh&acirc;n chủ yếu. C&oacute; gần 40% người được ph&aacute;t hiện nhiễm HIV l&agrave; người ti&ecirc;m ch&iacute;ch ma tu&yacute;. Rất nhiều trường hợp l&acirc;y nhiễm qua đường t&igrave;nh dục l&agrave; bạn t&igrave;nh của người đ&atilde; từng ti&ecirc;m ch&iacute;ch ma tu&yacute;. V&igrave; vậy ti&ecirc;m ch&iacute;ch ma tu&yacute; kh&ocirc;ng an to&agrave;n đ&oacute;ng vai tr&ograve; quan trọng trong việc ph&aacute;t triển v&agrave; tiếp tục duy tr&igrave; dịch HIV tại Việt Nam.&nbsp; Mặt kh&aacute;c diễn biến của việc sử dụng ma tu&yacute; ở Việt Nam ng&agrave;y c&agrave;ng phức tạp trong đ&oacute; việc sử dụng c&aacute;c chất ma tu&yacute; tổng hợp như ma tu&yacute; đ&aacute; (crystal methamphetamine), ecstasy (MDMA) hay ketamine l&agrave; những chất c&oacute; ảnh hưởng l&acirc;u d&agrave;i đến sức khoẻ (bao gồm nguy cơ l&acirc;y nhiễm HIV do quan hệ t&igrave;nh dục kh&ocirc;ng an to&agrave;n) ng&agrave;y c&agrave;ng trở n&ecirc;n phổ biến hơn trong giới trẻ ở c&aacute;c th&agrave;nh phố lớn.</p>\r\n<p>Từ giữa những năm 1990, Việt Nam đ&atilde; thử nghiệm một loạt c&aacute;c m&ocirc; h&igrave;nh can thiệp nhằm l&agrave;m giảm g&aacute;nh nặng của ti&ecirc;m ch&iacute;ch&nbsp;ma tu&yacute; đối với sức khoẻ v&agrave; x&atilde; hội, bao gồm c&aacute;c hoạt động như cai nghiện tại cộng đồng v&agrave; trung t&acirc;m, ph&acirc;n ph&aacute;t v&agrave; trao đổi bơm kim ti&ecirc;m sạch, v&agrave; điều trị thay thế nghiện c&aacute;c chất dạng thuốc phiện bằng Methadone. Từ năm 2008 đến nay, từ chỗ triển khai th&iacute; điểm ở Hải Ph&ograve;ng v&agrave; TP Hồ Ch&iacute; Minh, chương tr&igrave;nh đ&atilde; nhanh ch&oacute;ng ph&aacute;t triển ra hơn 11 tỉnh th&agrave;nh phố v&agrave; số bệnh nh&acirc;n l&agrave; gần 10.000 người.&nbsp; Theo Bộ Y tế, kế hoạch mở rộng chương tr&igrave;nh đến năm 2015 sẽ c&oacute; hơn 80.000 người nghiện heroin được điều trị trong hơn 200 cơ sở điều trị trong cả nước. B&ecirc;n cạnh đ&oacute; c&aacute;c nỗ lực x&acirc;y dựng c&aacute;c cơ sở điều trị nghiện mở&nbsp; v&agrave; tự nguyện ở cộng đồng cũng l&agrave; một chiến lược quan trọng trong việc thay đổi diện m&ocirc; h&igrave;nh điều trị cai nghiện tập trung trong c&aacute;c trung t&acirc;m của Bộ Lao động-Thương binh v&agrave; X&atilde; hội.</p>\r\n<p>Một trong những th&aacute;ch thức của c&aacute;c chiến lược quan trọng n&oacute;i tr&ecirc;n l&agrave; việc đảm bảo đội ngũ c&aacute;n bộ đ&aacute;p ứng được&nbsp;c&aacute;c ti&ecirc;u chuẩn về&nbsp;chuy&ecirc;n m&ocirc;n v&agrave; được đ&agrave;o tạo cơ bản cũng như li&ecirc;n tục. Trong thời gian qua, Bộ Y tế Việt Nam phối hợp với sự hỗ trợ của PEPFAR, Quỹ To&agrave;n Cầu, Ng&acirc;n H&agrave;ng Thế giới th&ocirc;ng qua c&aacute;c tổ chức như FHI360 v&agrave; SCMS đ&atilde; tổ chức c&aacute;c kho&aacute; tập huấn về điều trị thay thế bằng Methadone đ&aacute;p ứng bước đầu nhu cầu ph&aacute;t triển của chương tr&igrave;nh. Tuy nhi&ecirc;n c&aacute;c hoạt động n&agrave;y c&ograve;n chưa gắn với hệ thống đ&agrave;o tạo y khoa v&agrave; y tế c&ocirc;ng cộng ở Việt Nam, v&agrave; sự tham gia của c&aacute;c cơ sở thực h&agrave;nh kh&aacute;m chữa bệnh v&iacute; dụ như hệ thống bệnh viện của ng&agrave;nh t&acirc;m thần c&ograve;n hạn chế.&nbsp;Trong bối cảnh đ&oacute;, Trung t&acirc;m Nghi&ecirc;n cứu v&agrave; Chuyển giao C&ocirc;ng nghệ Điều trị Nghiện chất ra đời đang từng bước n&acirc;ng cao năng lực cho c&aacute;c c&aacute;n bộ trong lĩnh vực điều trị nghiện, kết nối giữa đ&agrave;o tạo v&agrave; thực h&agrave;nh, giữa c&aacute;c cơ sở điều trị với cơ sở đ&agrave;o tạo nhằm đ&aacute;p ứng tốt nhất nhu cầu ph&aacute;t triển nhanh ch&oacute;ng v&agrave; bền vững lĩnh vực điều trị nghiện tại Việt Nam.&nbsp;Mục đ&iacute;ch của dự &aacute;n v&agrave; trung t&acirc;m l&agrave; x&acirc;y dựng năng lực đ&agrave;o tạo trước mắt để phục vụ cho việc mở rộng chương tr&igrave;nh điều trị thay thế bằng Methadone v&agrave; l&acirc;u d&agrave;i hơn l&agrave; x&acirc;y dựng năng lực về y học nghiện n&oacute;i chung v&agrave; nghiện chất n&oacute;i ri&ecirc;ng tại Trường Đại học Y H&agrave; Nội, g&oacute;p phần v&agrave;o việc kiểm so&aacute;t l&acirc;y nhiễm HIV/AIDS ở Việt Nam.&nbsp;</p>','PUBLISH',0,NULL,'POST','vi-VN',1,0,0,'2013-07-10 10:28:46','2013-07-06 10:29:20'),
	(35,'Cơ cấu tổ chức',20,'co-cau-to-chuc','Văn phòng điều phối VHATTC đặt tại Trung tâm Nghiên cứu và Đào tạo HIV/AIDS của Trường Đại học Y Hà Nội. Dự án xây dựng VHATTC đặt dưới sự lãnh đạo trực tiếp của Hiệu Trường nhà trường, và sự tham gia chặt chẽ của các giảng viên bộ môn Tâm thần và Viện Đào tạo Y học Dự phòng và Y tế Công cộng. ','<p>Trung t&acirc;m Nghi&ecirc;n cứu v&agrave; Đ&agrave;o tạo HIV/AIDS được th&agrave;nh lập năm 1994, l&agrave; một trong những đơn vị đầu ti&ecirc;n được th&agrave;nh lập trong c&aacute;c trường Đại học Y Dược với mục đ&iacute;ch đ&agrave;o tạo c&aacute;n bộ ph&ograve;ng chống HIV/AIDS v&agrave; đưa nội dung HIV/AIDS v&agrave;o chương tr&igrave;nh đ&agrave;o tạo đại học.&nbsp;Bộ m&ocirc;n T&acirc;m thần v&agrave; Viện Sức khỏe T&acirc;m thần, Bệnh viện Bạch Mai&nbsp;&nbsp;l&agrave; nơi quy tụ của c&aacute;c nh&agrave; khoa học đầu ng&agrave;nh về lĩnh vực t&acirc;m thần học v&agrave; l&agrave; địa chỉ đ&aacute;ng tin cậy trong c&ocirc;ng t&aacute;c đ&agrave;o tạo bậc đại học v&agrave; sau đại học cho chuy&ecirc;n ng&agrave;nh t&acirc;m thần trong cả nước. Trong khi đ&oacute;,&nbsp;Viện YHDP v&agrave; YTCC l&agrave;&nbsp;được th&agrave;nh lập dựa tr&ecirc;n khoa Y tế c&ocirc;ng cộng, tiền th&acirc;n l&agrave; sự kết hợp giữa hai bộ m&ocirc;n Vệ sinh-dịch tễ v&agrave; Bộ m&ocirc;n Tổ chức quản l&yacute; Y tế. Viện&nbsp;đ&atilde; tham gia đ&agrave;o tạo h&agrave;ng ng&agrave;n c&aacute;c b&aacute;c sĩ đa khoa, chuy&ecirc;n khoa Y học dự ph&ograve;ng v&agrave; Y tế c&ocirc;ng cộng, cung cấp nghi&ecirc;n cứu vi&ecirc;n cho c&aacute;c viện nghi&ecirc;n cứu, c&aacute;c c&aacute;n bộ giảng dạy của c&aacute;c trường đại học, cao đẳng, trung cấp Y-Dược trong cả nước, c&aacute;c nh&acirc;n vi&ecirc;n y tế tr&igrave;nh độ đại học v&agrave; sau đại học cho c&aacute;c tỉnh th&agrave;nh cũng như y tế c&aacute;c Bộ, Ng&agrave;nh.</p>\r\n<p>B&ecirc;n cạnh việc tận dụng tối đa những chuy&ecirc;n gia h&agrave;ng đầu của nh&agrave; trường trong c&aacute;c lĩnh vực li&ecirc;n quan, c&aacute;c hoạt động của VhATTC được sự hỗ trợ của Ban cố vấn bao gồm đại diện c&aacute;c cơ quan quản l&yacute; nh&agrave; nước, c&aacute;c chuy&ecirc;n gia h&agrave;ng đầu của Việt Nam trong c&aacute;c lĩnh vực li&ecirc;n quan, v&agrave; đại diện c&aacute;c tổ chức quốc tế c&oacute; hoạt động t&iacute;ch cực trong lĩnh vực ph&ograve;ng, chống HIV/AIDS v&agrave; nghiện chất ở Việt Nam. Hoạt động của c&aacute;c th&agrave;nh vi&ecirc;n Ban cố vấn của VHATTC gi&uacute;p kết nối với c&aacute;c cơ quan trong v&agrave; ngo&agrave;i nước c&ugrave;ng chung nỗ lực giải quyết c&aacute;c vấn đề c&oacute; li&ecirc;n quan.</p>\r\n<p>&nbsp;<img src=\"http://i1320.photobucket.com/albums/u529/thuyanh120489/ScreenShot2013-02-02at91654PM_zps6cbdbca2.png\" alt=\"\" /></p>\r\n<p>Để biết th&ecirc;m th&ocirc;ng tin về nh&acirc;n sự ch&iacute;nh của VHATTC, xin vui l&ograve;ng xem th&ecirc;m:</p>\r\n<p>Quản l&yacute; dự&nbsp;&aacute;n</p>\r\n<p>Ban Cố vấn&nbsp;</p>','PUBLISH',0,'Lưu Trọng Hiếu','POST','vi-VN',1,0,0,'2013-07-10 15:19:03','2013-07-06 10:29:40'),
	(36,'Hoạt động',20,'hoat-dong','VHATTC xây dựng năng lực đào tạo và chuyển giao công nghệ điều trị nghiện chất góp phần vào công tác phòng, chống tác hại của các chất gây nghiện, trong đó đặc biệt là HIV/AIDS, đối với cá nhân người sử dụng ma tuý, gia đình và cộng đồng. Để thực hiện mục tiêu này, các hoạt động của VHATTC tập trung vào một số ưu tiên chiến lược. ','<p>C&aacute;c ưu ti&ecirc;n của VHATTC bao gồm:&nbsp;(1) N&acirc;ng cao năng lực giảng dạy l&yacute; thuyết v&agrave; thực h&agrave;nh về điều trị nghiện chất n&oacute;i chung v&agrave; điều trị thay thế c&aacute;c chất dạng thuốc phiện bằng methadone n&oacute;i ri&ecirc;ng; (2) X&acirc;y dựng, giới thiệu c&aacute;c t&agrave;i liệu đ&agrave;o tạo về nghiện chất v&agrave; điều trị nghiện chất hướng đến hỗ trợ tối đa cho qu&aacute; tr&igrave;nh phục hồi của người lệ thuộc ma tu&yacute;; (3) Triển khai c&aacute;c nghi&ecirc;n cứu l&acirc;m s&agrave;ng v&agrave; cộng đồng gi&uacute;p x&acirc;y dựng bằng chứng của Việt Nam; (4) X&acirc;y dựng quan hệ hợp t&aacute;c với c&aacute;c cơ quan quản l&yacute; nh&agrave; nước, c&aacute;c cơ quan v&agrave; c&aacute; nh&acirc;n nghi&ecirc;n cứu v&agrave; đ&agrave;o tạo trong v&agrave; ngo&agrave;i nước trong c&ocirc;ng t&aacute;c điều trị nghiện chất v&agrave; điều trị thay thế bằng methadone.</p>\r\n<p>Về đ&agrave;o tạo, ba trọng t&acirc;m ưu ti&ecirc;n của VHATTC l&agrave;:</p>\r\n<p>C&aacute;c hoạt động đ&agrave;o tạo của VHATTC bao gồm chuỗi b&agrave;i giảng về y học v&agrave; khoa học về nghiện chất tổ chức hai th&aacute;ng một lần, c&aacute;c kho&aacute; đ&agrave;o tạo ngắn hạn, đ&agrave;o tạo trực tuyến v&agrave; hỗ trợ kỹ thuật tại c&aacute;c cơ sở điều trị.&nbsp; Để biết th&ecirc;m th&ocirc;ng tin về hoạt động đ&agrave;o tạo của VHATTC, xin bấm&nbsp;<a href=\"vi/dao-tao-ho-tro-ky-thuat/su-kien-khoa-dao-tao-vhattc\">v&agrave;o đ&acirc;y</a><a href=\"vi/dao-tao/su-kien-khoa-dao-tao-vhattc\">.</a></p>\r\n<p>Về nghi&ecirc;n cứu, c&aacute;c trọng t&acirc;m ưu ti&ecirc;n của VHATTC bao gồm c&aacute;c nghi&ecirc;n cứu dịch tễ học v&agrave; khoa học x&atilde; hội, c&aacute;c nghi&ecirc;n cứu l&acirc;m s&agrave;ng, c&aacute;c nghi&ecirc;n cứu đ&aacute;nh gi&aacute; hiệu quả v&agrave; t&aacute;c động m&ocirc; h&igrave;nh can thiệp, v&agrave; c&aacute;c nghi&ecirc;n cứu ch&iacute;nh s&aacute;ch x&acirc;y dựng bằng chứng li&ecirc;n quan đến nghiện chất v&agrave; HIV/AIDS. Để biết th&ecirc;m th&ocirc;ng tin về c&aacute;c hoạt động nghi&ecirc;n cứu của VHATTC v&agrave; Trung t&acirc;m nghi&ecirc;n cứu v&agrave; đ&agrave;o tạo HIV/AIDS, c&oacute; thể xem th&ecirc;m&nbsp;<a href=\"vi/nghien-cuu\">tại đ&acirc;y</a>.</p>','PUBLISH',0,'Lưu Trọng Hiếu','POST','vi-VN',2,0,0,'2013-07-10 15:19:37','2013-07-06 10:30:53'),
	(62,'TS. Phạm Đức Mạnh',22,'ts-pham-duc-manh','Phó Cục trưởng Cục phòng chống HIV/AIDS- Bộ Y tế<br />\r\nThành viên Ban cố vấn','<p>Th&ocirc;ng tin đang được cập nh&acirc;t, xin vui l&ograve;ng quay lại sau.</p>','PUBLISH',0,'Lưu Trọng Hiếu','post','vi-VN',4,0,0,'2013-07-10 11:58:30','2013-07-06 17:51:30'),
	(63,'Bà Đỗ Thị Ninh Xuân',22,'ba-do-thi-ninh-xuan','Phó Cục trưởng Cục Phòng chống tệ nạn xã hội- Bộ Lao động- Thương Binh và Xã hội<br />\r\nThành viên Ban cố vấn','<p><strong>B&agrave; Đỗ Thị Ninh Xu&acirc;n</strong>&nbsp;tốt nghiệp Đại học Tổng hợp H&agrave; Nội năm 1979, KhoaNgữ Văn; tốt nghiệp cao cấp Ch&iacute;nh trị Nguyễn &Aacute;i Quốc năm 2002, cao cấp quản l&yacute; nh&agrave; nước năm 2008. Hiện đang l&agrave; Ph&oacute; Cục trưởng Cục ph&ograve;ng chống tệ nạn x&atilde; hội- Bộ Lao động- Thương binh v&agrave; X&atilde; hội, đồng thời l&agrave; Gi&aacute;m đốc một số dự &aacute;n quốc gia về N&acirc;ng cao năng lực điều trị cai nghiện ma t&uacute;y tại cộng đồng, giảm hại về sức khỏe li&ecirc;n quan đến HIV, trong khu&ocirc;n khổ hợp t&aacute;c với CDC, FHI, UNODC tại H&agrave; Nội. Lĩnh vực thực hiện chủ yếu l&agrave;: nghi&ecirc;n cứu x&acirc;y dựng ch&iacute;nh s&aacute;ch về hỗ trợ chữa trị, phục hồi, t&aacute;i h&ograve;a nhập cộng đồng cho người nghiện ma t&uacute;y, người b&aacute;n d&acirc;m v&agrave; nạn nh&acirc;n bị bu&ocirc;n b&aacute;n; hỗ trợ kỹ thuật&nbsp; cho c&aacute;n bộ l&agrave;m việc trong c&aacute;c lĩnh vực tr&ecirc;n th&ocirc;ng qua cung cấp c&aacute;c kh&oacute;a đ&agrave;o tạo về hỗ trợ t&acirc;m l&yacute;, x&atilde; hội v&agrave; hướng dẫn lập kế hoạch, gi&aacute;m s&aacute;t đ&aacute;nh gi&aacute; chương tr&igrave;nh.</p>','PUBLISH',0,'Lưu Trọng Hiếu','post','vi-VN',3,0,0,'2013-07-10 11:58:00','2013-07-06 17:51:34'),
	(64,'PGS.TS.Nguyễn Kim Việt',22,'pgs-ts-nguyen-kim-viet','Trưởng Bộ môn Tâm thần- Trường Đại học Y Hà Nội<br />\r\nViện trưởng Viện Sức khỏe Tâm thần Quốc gia- Bệnh viện Bạch Mai<br />\r\nĐồng Trưởng ban cố vấn VHATTC','<p><strong>PGS. TS. BS. Nguyễn Kim Việt</strong>, c&aacute;n bộ giảng dạy bộ m&ocirc;n T&acirc;m thần Đại học Y H&agrave; Nội, tốt nghiệp b&aacute;c sĩ nội tr&uacute; năm 1981. Năm 1996 tốt nghiệp b&aacute;c sĩ chuy&ecirc;n khoa 2 v&agrave; năm 2005 tốt nghiệp tiễn sĩ chuy&ecirc;n ng&agrave;nh t&acirc;m thần. TS Việt được phong h&agrave;m Ph&oacute; gi&aacute;o sư năm 2010. Hiện nay PGS Việt l&agrave; Viện trưởng Viện Sức khỏe t&acirc;m thần v&agrave; Chủ nhiệm bộ m&ocirc;n T&acirc;m thần, Đại học Y H&agrave; Nội. Lĩnh vực nghi&ecirc;n cứu ch&iacute;nh: t&acirc;m thần học người gi&agrave;, dược l&yacute; t&acirc;m thần, nghiện học.</p>','PUBLISH',0,'Lưu Trọng Hiếu','POST','*',2,0,0,'2013-07-10 11:58:00','2013-07-09 00:55:23'),
	(65,'Đối tượng phục vụ',20,'doi-tuong-phuc-vu','Các đối tượng VHATTC hướng tới đều nhắm mục đích chung nhất là xây dựng năng lực đào tạo trước mắt để phục vụ cho việc mở rộng chương trình điều trị thay thế bằng Methadone, và về lâu dài xây dựng năng lực về y học nghiện nói chung và nghiện chất nói riêng. ','<ul>\r\n<li>C&aacute;c c&aacute;n bộ&nbsp;đ&atilde;,&nbsp;đang v&agrave; sẽ c&ocirc;ng t&aacute;c trong hệ thống&nbsp;điều trị nghiện chất dự ph&ograve;ng l&acirc;u nhiễm HIV trực thuộc BỘ Y tế v&agrave; Bộ Lao&nbsp;động-Thương binh v&agrave; X&atilde; hội.</li>\r\n<li>C&aacute;c c&aacute;n bộ của c&aacute;c trường&nbsp;Đại học, c&aacute;c cơ&nbsp;quan quản l&yacute; c&aacute;c cấp, c&aacute;c tổ chức quốc tế c&oacute; quan t&acirc;m v&agrave; hoạt động trong lĩnh vực nghiện chất v&agrave; HIV/AIDS</li>\r\n<li>C&aacute;c sinh vi&ecirc;n v&agrave; học vi&ecirc;n của&nbsp;Đại học Y H&agrave; Nội, trong&nbsp;đ&oacute;&nbsp;thuộc hai chuy&ecirc;n ng&agrave;nh ch&iacute;nh l&agrave; Y học Dự ph&ograve;ng v&agrave; T&acirc;m thần</li>\r\n<li>C&aacute;c tổ chức x&atilde; hội nghề nghiệp hoạt động trong lĩnh vực điều trị nghiện chất v&agrave; ph&ograve;ng, chống HIV/AIDS&nbsp;&nbsp;</li>\r\n</ul>','PUBLISH',0,'Lưu Trọng Hiếu','POST','vi-VN',3,0,0,'2013-07-10 15:25:13','2013-07-09 00:56:12'),
	(66,'GS.TS. Nguyễn Trần Hiển',22,'gs-ts-nguyen-tran-hien','Trưởng Bộ môn Dịch tễ học<br />\r\nViện trưởng Viện Vệ sinh Dịch tễ Trung ương<br />\r\nĐồng Trưởng ban cố vấn VHATTC','<p><strong>PGS. TS. Nguyễn Trần Hiển</strong> l&agrave; một nh&agrave; dịch tễ học h&agrave;ng đầu của Việt Nam với hơn 34 năm kinh nghiệm l&agrave;m việc trong lĩnh vực n&agrave;y. PGS. Hiển c&oacute; nhiều kinh nghiệm trong dự ph&ograve;ng v&agrave; kiểm so&aacute;t c&aacute;c bệnh truyền nhiễm, đặc biệt l&agrave; HIV/AIDS, C&uacute;m gia cầm v&agrave; bệnh dại. PGS. Hiển l&agrave; Viện trưởng Viện Vệ sinh Dịch tễ trung ương từ năm 2004, Gi&aacute;m đốc Trung t&acirc;m Nghi&ecirc;n cứu v&agrave; Đ&agrave;o tạo HIV/AIDS, trường Đại học Y H&agrave; Nội từ năm 2003 v&agrave; l&agrave; Chủ nhiệm bộ m&ocirc;n Dịch tễ học, Viện Đ&agrave;o tạo Y học dự ph&ograve;ng v&agrave; Y tế c&ocirc;ng cộng, trường Đại học Y H&agrave; Nội từ năm 2000 đến nay.<br />PGS. Hiển l&agrave; một trong những nh&agrave; khoa học đầu ti&ecirc;n c&oacute; những đ&oacute;ng g&oacute;p to lớn v&agrave;o c&ocirc;ng cuộc ph&ograve;ng chống HIV/AIDS của Việt Nam ngay từ những năm đầu ti&ecirc;n của đại dịch (1988). PGS. Hiển hiện l&agrave; cố vấn kỹ thuật của dự &aacute;n Đ&agrave;o tạo v&agrave; chuyển giao c&ocirc;ng nghệ điều trị nghiện chất trong ph&ograve;ng chống HIV/AIDS tại Việt Nam (VHATTC) của trường Đại học Y H&agrave; Nội do Cục Quản l&yacute; lạm dụng chất g&acirc;y nghiện v&agrave; sức khỏe t&acirc;m thần Hoa Kỳ (SAMHSA) th&ocirc;ng qua C&aacute;c Chương tr&igrave;nh về Lạm dụng c&aacute;c chất g&acirc;y nghiện Lồng gh&eacute;p (ISAP) trường Đại học California, Los Angeles (UCLA) &ndash; Hoa Kỳ t&agrave;i trợ. PGS. Hiển l&agrave; chủ bi&ecirc;n v&agrave; đồng chủ bi&ecirc;n của nhiều cuốn s&aacute;ch gi&aacute;o khoa về dịch tễ học, HIV/AIDS v&agrave; l&agrave; t&aacute;c giả cũng như đồng t&aacute;c giả của 51 b&agrave;i b&aacute;o quốc tế, phần lớn trong số đ&oacute; l&agrave; về HIV/AIDS.</p>','PUBLISH',0,'Lưu Trọng Hiếu','post','vi-VN',1,0,0,'2013-07-10 11:58:00','2013-07-10 09:24:40'),
	(74,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'post','*',0,0,0,'2013-07-10 11:57:15','2013-07-10 11:57:15'),
	(75,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'post','*',0,0,0,'2013-07-10 11:58:48','2013-07-10 11:58:48'),
	(76,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'post','*',0,0,0,'2013-07-10 11:59:14','2013-07-10 11:59:14'),
	(77,'TS. Kevin P. Mulvey',22,'ts-kevin-p-mulvey','Cố vấn về Điều trị lạm dụng chất gây nghiện, Chương trình PEPFAR tại Việt Nam                                                                           <br />\r\nĐại diện Cục Quản lý Chất gây nghiện và Tâm thần trực thuộc Bộ Y tế và Nhân lực Hoa Kỳ                                                                                                                                                            <br />\r\nThành viên Ban cố vấn VHATTC','<p><strong>Tiến sĩ Kevin P. Mulvey&nbsp;</strong>l&agrave; Cố vấn về điều trị lạm dụng chất g&acirc;y nghiện cho chương tr&igrave;nh PEPFAR thuộc Đại Sứ qu&aacute;n Mỹ ở Việt Nam, th&ocirc;ng qua Trung t&acirc;m Quản l&yacute; Điều trị Lạm dụng chất g&acirc;y nghiện của Cục Quản l&yacute; Lạm dụng chất g&acirc;y nghiện v&agrave; sức khoẻ t&acirc;m thần của Hoa Kỳ.&nbsp; &Ocirc;ng c&oacute; kinh nghiệm l&agrave;m việc trong khu vực với vai tr&ograve; l&agrave; Chuy&ecirc;n gia tư vấn kỹ thuật cao cấp cho c&aacute;c can thiệp về sử dụng ma t&uacute;y v&agrave; HIV. L&agrave; một nh&agrave; x&atilde; hội học ứng dụng, &ocirc;ng đ&atilde; từng đảm nhận c&aacute;c vị tr&iacute; kh&aacute;c nhau ở Trung T&acirc;m ph&ograve;ng chống lạm dụng chất g&acirc;y nghiện (CSAP), v&agrave; đ&atilde; từng l&agrave; Quyền Trưởng Ban Ph&aacute;t triển hệ thống của Trung t&acirc;m n&agrave;y, v&agrave; từng l&agrave; Trường Nh&oacute;m hỗ trợ kỹ thuật v&agrave; hiệu suất dịch vụ của Trung t&acirc;m. &Ocirc;ng nhận được bằng Tiến sĩ của Đại học Northeasten v&agrave;o năm 1993,&nbsp; v&agrave; lĩnh vực chuy&ecirc;n s&acirc;u l&agrave; x&atilde; hội học ứng dụng v&agrave; sai lệch x&atilde; hội, đặc biệt l&agrave; đ&aacute;nh gi&aacute; chương tr&igrave;nh v&agrave; phương ph&aacute;p nghi&ecirc;n cứu định lượng. &Ocirc;ng cũng c&oacute; bằng thạc sĩ về x&atilde; hội học ứng dụng do Đại học Massachusetts ở Boston cấp năm 1986, v&agrave; Chứng chỉ về Y tế cộng cộng do đại học North Carolina cấp năm 2004.</p>\r\n<p>Những dự &aacute;n chủ yếu của &ocirc;ng ở CSAP li&ecirc;n quan tới ph&aacute;t triển v&agrave; triển khai chương tr&igrave;nh ph&ograve;ng chống c&oacute; hiệu quả th&ocirc;ng qua tập huấn, hỗ trợ kỹ thuật, x&acirc;y dựng v&agrave; phổ biến t&agrave;i liệu, v&agrave; đ&aacute;nh gi&aacute;, gi&aacute;m s&aacute;t chương tr&igrave;nh. B&ecirc;n cạnh đ&oacute;, &ocirc;ng cũng l&agrave;m việc với c&aacute;c nh&oacute;m quần thể như người v&ocirc; gia cư, tội phạm h&igrave;nh sự v&agrave; người sử dụng/ lạm dụng chất g&acirc;y nghiện nhưng kh&ocirc;ng chỉ giới hạn ri&ecirc;ng c&aacute;c quần thể n&agrave;y. &Ocirc;ng l&agrave; giảng vi&ecirc;n cao cấp của trường Liberal Arts thuộc Đại học Northeasten, nơi &ocirc;ng đ&atilde; nhận Giải Thưởng Garth Pittman cho th&agrave;nh t&iacute;ch giảng dậy xuất sắc v&agrave;o năm 1998, v&agrave; hiện nay &ocirc;ng vẫn đang dạy c&aacute;c kh&oacute;a học từ xa kết hợp giữa X&atilde; hội học về sử dụng rượu, x&atilde; hội học về AIDS, Ma t&uacute;y v&agrave; x&atilde; hội, C&aacute;c phương ph&aacute;p nghi&ecirc;n cứu, v&agrave; c&aacute;c kỹ thuật ph&acirc;n t&iacute;ch dữ liệu v&agrave; thống k&ecirc;. Trước khi l&agrave;m việc cho Ch&iacute;nh phủ li&ecirc;n bang, &ocirc;ng đ&atilde; l&agrave;m Gi&aacute;m đốc đ&aacute;nh gi&aacute; cho một dự &aacute;n do Viện Nghiện cứu Lạm dụng v&agrave; Nghiện Rượu (Hoa Kỳ) cho th&agrave;nh phố Boston trong 3 năm, từ 1988 đến 1991. Trong vai tr&ograve; n&agrave;y, &ocirc;ng hỗ trợ triển khai kh&ocirc;ng chỉ c&aacute;c chương tr&igrave;nh của dự &aacute;n m&agrave; c&ograve;n thiết kế v&agrave; triển khai c&aacute;c hoạt động thu thập dữ liệu của c&aacute;n bộ dự &aacute;n/c&aacute;n bộ đ&aacute;nh gi&aacute;. Th&ecirc;m v&agrave;o đ&oacute;, &ocirc;ng l&agrave; chuy&ecirc;n gia đ&aacute;nh gi&aacute; cấp cao của Dự &aacute;n th&iacute; diểm một số th&agrave;nh phố do CSAT t&agrave;i trợ trong năm năm ở Boston. Trong vai tr&ograve; n&agrave;y, &ocirc;ng chịu tr&aacute;ch nhiệm hỗ trợ thiết kế v&agrave; triển khai dự &aacute;n. &Ocirc;ng c&ograve;n hỗ trợ c&aacute;c chương tr&igrave;nh v&agrave; nh&oacute;m c&aacute;n bộ n&ograve;ng cốt sử dụng số liệu để quản l&yacute;. B&ecirc;n cạnh đ&oacute;, &ocirc;ng đ&atilde; hỗ trợ Gi&aacute;m đốc đ&aacute;nh gi&aacute; trong c&aacute;c hoạt động nghi&ecirc;n cứu. &Ocirc;ng đ&atilde; từng l&agrave;m Chuy&ecirc;n gia đ&aacute;nh gi&aacute;/nghi&ecirc;n cứu vi&ecirc;n cấp cao của Văn ph&ograve;ng hệ thống dữ liệu, đ&aacute;nh gi&aacute; sức khỏe v&agrave; nghi&ecirc;n cứu của Ủy Ban Y tế C&ocirc;ng Cộng Boston đảm nhận c&aacute;c hoạt động về nghi&ecirc;n cứu, đ&aacute;nh gi&aacute; v&agrave; b&aacute;o c&aacute;o của Sở Y tế C&ocirc;ng Cộng. Tất cả c&aacute;c vị tr&iacute; &ocirc;ng đ&atilde; đảm nhận đều cần phải cộng t&aacute;c với c&aacute;c dự &aacute;n nỗ lực đ&aacute;nh gi&aacute; cấp quốc gia&nbsp;</p>','PUBLISH',0,'Lưu Trọng Hiếu','post','*',5,0,0,'2013-07-10 11:59:21','2013-07-10 11:59:21'),
	(78,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'post','*',0,0,0,'2013-07-10 12:01:59','2013-07-10 12:01:59'),
	(79,'PGS.TS.Nguyễn Đức Hinh',21,'pgs-ts-nguyen-duc-hinh','Hiệu trưởng Trường Đại học Y Hà Nội<br />\r\nGiám đốc VHATTC','<p><strong>PGS. TS. Nguyễn Đức Hinh</strong>&nbsp;l&agrave; Hiệu trưởng trường Đại học Y H&agrave; Nội v&agrave; đồng thời l&agrave; Chủ tịch Hội đồng Hiệu trưởng c&aacute;c Trường Đại học Y của Việt Nam. &Ocirc;ng tốt nghiệp b&aacute;c sĩ năm 1983, nhận bằng tiến sĩ năm 2003 v&agrave; sau đ&oacute; phong danh hiệu Ph&oacute; gi&aacute;o sư năm 2006.&nbsp; &Ocirc;ng cũng l&agrave; Gi&aacute;o sư danh dự Khoa Y trường Đại học Tổng hợp Sydney. Mặc d&ugrave; chuy&ecirc;n ng&agrave;nh đ&agrave;o tạo s&acirc;u l&agrave; Sản phụ khoa nhưng Ph&oacute; gi&aacute;o sư Hinh lu&ocirc;n quan t&acirc;m tới mối li&ecirc;n quan giữa c&aacute;c vấn đề x&atilde; hội v&agrave; sức khỏe. Đ&oacute; cũng l&agrave; một trong những l&yacute; do m&agrave; Bộ m&ocirc;n Y đức v&agrave; Y x&atilde; hội học của Trường Đại học Y H&agrave; Nội được th&agrave;nh lập v&agrave; hiện tại Ph&oacute; gi&aacute;o sư Hinh cũng l&agrave; Chủ nhiệm Bộ m&ocirc;n n&agrave;y. Ph&oacute; gi&aacute;o sư đặc biệt quan t&acirc;m đến việc ph&aacute;t triển nguồn nh&acirc;n lực y khoa trong c&aacute;c lĩnh vực y học, y học dự ph&ograve;ng v&agrave; y tế c&ocirc;ng cộng v&agrave; điều dưỡng, v&agrave; đặc biệt l&agrave; gắn c&aacute;c hoạt động đ&agrave;o tạo của Trường Đại học Y H&agrave; Nội với nhu cầu của x&atilde; hội.</p>','PUBLISH',0,'Lưu Trọng Hiếu','post','vi-VN',1,0,0,'2013-07-10 12:15:58','2013-07-10 12:02:43'),
	(80,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'post','*',0,0,0,'2013-07-10 12:04:53','2013-07-10 12:04:53'),
	(81,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'post','*',0,0,0,'2013-07-10 12:05:38','2013-07-10 12:05:38'),
	(82,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'post','*',0,0,0,'2013-07-10 12:14:27','2013-07-10 12:14:27'),
	(83,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'post','*',0,0,0,'2013-07-10 12:15:20','2013-07-10 12:15:20'),
	(84,'GS.TS Richard A. Rawson',21,'gs-ts-richard-a-rawson','Khoa Tâm Thần- Trường Đại học California (University of California- UCLA), Hoa Kỳ<br />\r\nPhó giám đốc Chương trình về Lạm dụng chất gây nghiện lồng ghép của trường Đại học UCLA','<p><strong>Gi&aacute;o sư, Tiến sĩ Richard A. Rawson&nbsp;</strong>l&agrave; Ph&oacute; gi&aacute;m đốc Chương tr&igrave;nh về Lạm dụng chất g&acirc;y nghiện lồng gh&eacute;p của trường Đại học UCLA v&agrave; l&agrave; Gi&aacute;o sư tại tại Khoa T&acirc;m Thần thuộc trường Đại học UCLA trong hơn 25 năm qua.&nbsp; Gi&aacute;o sư Richard A Rawson đ&atilde; triển khai nhiều nghi&ecirc;n cứu thử nghiệm l&acirc;m s&agrave;ng sử dụng thuốc v&agrave; c&aacute;c liệu ph&aacute;p t&acirc;m l&yacute; x&atilde; hội trong điều trị nghiện, cũng như thực hiện việc ph&aacute;t triển v&agrave; đ&aacute;nh gi&aacute; hệ thống dịch vụ li&ecirc;n quan tới điều trị rối loạn do sử dụng nghiện chất.&nbsp; &Ocirc;ng từng l&agrave;m gi&aacute;m đốc Trung t&acirc;m chuyển giao c&ocirc;ng nghệ điều trị nghiện v&ugrave;ng T&acirc;y Nam v&agrave; Th&aacute;i B&igrave;nh Dương của Hoa Kỳ (Pacific Southwest ATTC), một tổ chức c&oacute; trụ sở tại trường đại học UCLA trong 1 thập kỷ vừa qua. Hiện nay &ocirc;ng l&agrave; Gi&aacute;m đốc dự &aacute;n do SAMHSA t&agrave;i trợ ở Việt nam để x&acirc;y dựng Trung t&acirc;m chuyển giao c&ocirc;ng nghệ điều trị nghiện chất ph&ograve;ng chống HIV/AIDS v&agrave; ở Iraq để x&acirc;y dựng Chương tr&igrave;nh giảm nhu cầu sử dụng nghiện chất. &Ocirc;ng cũng c&oacute; nhiều đ&oacute;ng g&oacute;p v&agrave;o c&aacute;c nỗ lực n&acirc;ng cao năng lực điều trị nghiện to&agrave;n cầu của Cơ quan Ph&ograve;ng chống ma t&uacute;y v&agrave; tội phạm Li&ecirc;n Hợp Quốc (UNODC) th&ocirc;ng qua mạng lưới Treatnet, đồng thời l&agrave;m việc nhiều năm với Tổ chức Y tế Thế giới (WHO) v&agrave; Bộ Ngoại Giao Hoa Kỳ để phổ biến những kiến thức về điều trị nghiện dựa tr&ecirc;n nền tảng khoa học đến nhiều nơi tr&ecirc;n thế giới. Gi&aacute;o sư Rawson đ&atilde; xuất bản 6 cuốn s&aacute;ch, 230 chương s&aacute;ch v&agrave; b&agrave;i viết trong c&aacute;c tạp ch&iacute; chuy&ecirc;n ng&agrave;nh, v&agrave; đ&atilde; tham gia tr&igrave;nh b&agrave;y v&agrave; giảng dạy tr&ecirc;n 1000 cuộc hội thảo khoa học, tr&igrave;nh b&agrave;y kết quả nghi&ecirc;n cứu v&agrave; c&aacute;c kh&oacute;a tập huấn.&nbsp;</p>','PUBLISH',0,'Lưu Trọng Hiếu','post','*',2,0,0,'2013-07-10 12:17:10','2013-07-10 12:15:49'),
	(85,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,0,'2013-07-10 12:16:12','2013-07-10 12:16:12'),
	(86,'TS. Lê Minh Giang',21,'ts-le-minh-giang','Giảng viên Bộ môn Dịch tễ học, Trường Đại học Y Hà Nội<br />\r\nĐiều phối viên VHATTC','<p><strong>Tiến sĩ L&ecirc; Minh Giang</strong>&nbsp;l&agrave; Điều phối vi&ecirc;n VHATTC tại Trường Đại học Y H&agrave; Nội v&agrave; l&agrave; giảng vi&ecirc;n Bộ m&ocirc;n Dịch tễ, Viện Y học Dự ph&ograve;ng v&agrave; Y tế c&ocirc;ng cộng.&nbsp; &Ocirc;ng tốt nghiệp trường Đại học Y H&agrave; Nội năm 1992 (B&aacute;c sĩ đa khoa). Sau đ&oacute;, &ocirc;ng tiếp tục học v&agrave; nhận bằng Thạc sĩ Nh&acirc;n học v&agrave; Khoa học X&atilde; hộiTrong Y học năm 2004 tại Trường Đại học Columbia (Hoa Kỳ), v&agrave; bảo vệ luận &aacute;n Tiến sĩ v&agrave;o th&aacute;ng 3 năm 2012.&nbsp; C&aacute;c nội dung nghi&ecirc;n cứu của TS. L&ecirc; Minh Giang tập trung chủ yếu v&agrave;o khoa học x&atilde; hội v&agrave; khoa học h&agrave;nh vi của c&aacute;c vấn đề li&ecirc;n quan đến HIV/AIDS, đặc biệt l&agrave; c&aacute;c nguy cơ về ma t&uacute;y v&agrave; t&igrave;nh dục của nam thanh ni&ecirc;n m&agrave; l&agrave; hệ quả của những thay đổi x&atilde; hội. TS. L&ecirc; MinhGiang l&agrave; th&agrave;nh vi&ecirc;n bi&ecirc;n tập của tạp ch&iacute; chuy&ecirc;n ng&agrave;nh quốc tế mang t&ecirc;n Global Public Health v&agrave; Culture, Health and Sexuality v&agrave; đ&atilde; c&ocirc;ng bố những nghi&ecirc;n cứu của m&igrave;nh tr&ecirc;n một số tạp ch&iacute; trong nước v&agrave; quốc tế. Từ năm 2004, TS. L&ecirc; Minh Giang l&agrave; nghi&ecirc;n cứu vi&ecirc;n ch&iacute;nh v&agrave; điều phối vi&ecirc;n một số nghi&ecirc;n cứu do C&aacute;c Viện Sức khỏe Quốc gia Hoa Kỳ (NIH) t&agrave;i trợ trong khu&ocirc;n khổ hợp t&aacute;c c&aacute;c trường Đại học của Hoa Kỳ với trường Đại học Y H&agrave; Nội. &Ocirc;ng cũng l&agrave; một trong 9 người được nhận &ldquo;Giải thưởng Nghi&ecirc;n cứu vi&ecirc;n trẻ&rdquo; (Young Investigator Award) do Hiệp Hội AIDS Quốc Tế (ISA) v&agrave; Quỹ nghi&ecirc;n cứu ph&ograve;ng chống SIDA của Ph&aacute;p (ANRS) trao tặng tại Hội Nghị Quốc tế về AIDS lần thứ XVI tại Toronto, Canada năm 2006.&nbsp;</p>','PUBLISH',0,'Lưu Trọng Hiếu','POST','*',3,0,0,'2013-07-10 12:17:01','2013-07-10 12:17:01'),
	(87,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'event_manager','*',0,0,0,'2013-07-10 15:34:27','2013-07-10 15:34:27');

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
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

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;

INSERT INTO `setting` (`setting_key`, `setting_value`)
VALUES
	('site_name','VHATTC');

/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table system_fields
# ------------------------------------------------------------

DROP TABLE IF EXISTS `system_fields`;

CREATE TABLE `system_fields` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  `type` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `system_fields` WRITE;
/*!40000 ALTER TABLE `system_fields` DISABLE KEYS */;

INSERT INTO `system_fields` (`id`, `key`, `title`, `value`, `type`)
VALUES
	(1,'main_menu','Main Menu','main_menu','block_position'),
	(2,'slide_show','Slideshow','home.slide_show','block_position'),
	(3,'partners','Partners List','partners_list','block_position'),
	(4,'switching_lang','Switching Languages','switching_lang','block_position'),
	(5,'new_events','New Events','home.new_events','block_position');

/*!40000 ALTER TABLE `system_fields` ENABLE KEYS */;
UNLOCK TABLES;


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
	(33,'Root of menu','root-of-menu','menu',NULL,'*',0,'menu',1,2,0),
	(40,'Root of banner','root-of-banner','banner',NULL,'*',0,'banner',1,6,0),
	(41,'Slideshow','slideshow','banner',NULL,'*',0,'banner',2,3,1),
	(42,'Partners ','partners-vi','banner',NULL,'vi-VN',0,'banner',4,5,1),
	(44,'Root of POST','root-of-post','POST',NULL,'*',0,'POST',1,2,0);

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
	(1,'tronghieu','8d4a275a81f03d619be9dc0caefa361c69bdbf8dd5508f4df7c740b4185258a2','tronghieu.luu@gmail.com','Lưu Trọng Hiếu','0989388300',1,0,1,'1985-12-10','697d6b3664158512ab6596bda46c65ae','2013-07-09 14:17:55','2013-05-07 15:23:13',1373354275,1367916104),
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



# Dump of table widget_block
# ------------------------------------------------------------

DROP TABLE IF EXISTS `widget_block`;

CREATE TABLE `widget_block` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `position` varchar(255) NOT NULL DEFAULT '',
  `path` varchar(255) NOT NULL DEFAULT '',
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `language` varchar(10) NOT NULL DEFAULT '*',
  `note` text,
  `properties` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL,
  `modified_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `position` (`position`),
  KEY `position_2` (`position`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `widget_block` WRITE;
/*!40000 ALTER TABLE `widget_block` DISABLE KEYS */;

INSERT INTO `widget_block` (`id`, `name`, `position`, `path`, `status`, `language`, `note`, `properties`, `ordering`, `created_time`, `modified_time`)
VALUES
	(1,'Main Menu (VI)','main_menu','extension.widget.Menu','ACTIVE','vi-VN',NULL,'{\"menu_id\": 1, \"deep\": 0, \"view\" : \"main_menu\"}',0,'2013-07-09 16:31:50','2013-07-09 17:18:19'),
	(3,'Main Menu (EN)','main_menu','extension.widget.Menu','ACTIVE','en-US',NULL,'{\"menu_id\": 2, \"deep\": 0, \"view\" : \"main_menu\"}',0,'2013-07-09 17:16:34','2013-07-09 17:18:16'),
	(4,'Slide show','slide_show','extension.widget.SlideShow','ACTIVE','*',NULL,'{\"banner_group_id\" : 41, \"view\": \"main\"}',0,'2013-07-09 17:41:24','2013-07-09 17:41:27'),
	(6,'Partners List','partners_list','extension.widget.SlideShow','ACTIVE','*',NULL,'{\"banner_group_id\" : 42, \"view\": \"partners\"}',0,'2013-07-10 14:03:02','2013-07-10 14:03:05'),
	(8,'Intro Us (VI)','home.about','extension.widget.LatestNews','ACTIVE','vi-VN',NULL,'{\"term_id\":20, \"view\" : \"home_about\",\"fetch_child\": 0, \"ordering\" : [{\"field\" : \"ordering\", \"order\" : \"ASC\"}]}',0,'2013-07-10 14:45:57','2013-07-10 14:46:01'),
	(9,'VH ATTC News (VI)','home.about','extension.widget.LatestNews','ACTIVE','vi-VN',NULL,'{\"term_id\":20, \"view\" : \"home_about\",\"fetch_child\": 0, \"ordering\" : [{\"field\" : \"ordering\", \"order\" : \"ASC\"}]}',0,'2013-07-10 14:45:57','2013-07-10 14:46:01');

/*!40000 ALTER TABLE `widget_block` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
