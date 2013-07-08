# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.29)
# Database: toxotes
# Generation Time: 2013-07-08 09:47:18 +0000
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
	(11,41,'/media/banner/51d297692dea3.jpg','Slideshow 3',3,'','','_self',0,0,0,NULL,NULL,NULL,'*','INACTIVE',0,NULL,'2013-07-02 16:03:45','2013-07-02 16:05:54');

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

INSERT INTO `posts` (`id`, `title`, `term_id`, `slug`, `excerpt`, `content`, `status`, `is_draft`, `author`, `taxonomy`, `language`, `ordering`, `hits`, `modified_time`, `created_time`)
VALUES
	(34,'Giới thiệu chung',17,'gioi-thieu-chung',NULL,'<p>Trường Đại học Y H&agrave; Nội phối hợp với ISAP (Chương tr&igrave;nh ĐIều trị Nghiện chất Lồng gh&eacute;p) của Đại học UCLA, Hoa Kỳ khởi động&nbsp; dự &aacute;n th&agrave;nh lập&nbsp;<strong>Trung t&acirc;m Chuyển giao C&ocirc;ng nghệ điều trị Nghiện chất&nbsp;v&agrave; HIV</strong>&nbsp;(viết tắt l&agrave;&nbsp;<strong>VHATTC</strong>) v&agrave;o cuối năm 2011 với sự hỗ trợ từ ph&iacute;a&nbsp;Chương tr&igrave;nh cứu trợ khẩn cấp về ph&ograve;ng chống HIV/AIDS của Tổng thống Hoa Kỳ&nbsp; (PEPFAR) v&agrave; Cục Quản l&yacute; lạm dụng Chất g&acirc;y nghiện v&agrave; Sức khỏe t&acirc;m thần (Substance Abuse and Mental Health Services Administration- SAMHSA) Hoa Kỳ, phối hợp với Trường Đại học Y H&agrave; Nội v&agrave; Chương tr&igrave;nh Điều trị lạm dụng nghiện chất lồng gh&eacute;p (Integrated Substance Abuse Program- ISAP) thuộc Trường Đại học California, Hoa Kỳ.</p>\r\n<p>Theo b&aacute;o c&aacute;o của Bộ Y tế, t&iacute;nh đến th&aacute;ng 6 năm 2012, tr&ecirc;n to&agrave;n quốc&nbsp;c&oacute; hơn 200.000 người nhiễm HIV c&ograve;n sống,&nbsp;trong đ&oacute; c&oacute; hơn 58.000 người đ&atilde; chuyển sang giai đoạn AIDS, v&agrave; đ&atilde; c&oacute; hơn 60.000 người tử vong do HIV/AIDS. Mặc d&ugrave; trong những năm gần đ&acirc;y l&acirc;y truyền qua đường t&igrave;nh dục ng&agrave;y c&agrave;ng gia tăng mạnh mẽ, l&acirc;y nhiễm qua ti&ecirc;m ch&iacute;ch ma tu&yacute; kh&ocirc;ng an to&agrave;n vẫn l&agrave; nguy&ecirc;n nh&acirc;n chủ yếu. C&oacute; gần 40% người được ph&aacute;t hiện nhiễm HIV l&agrave; người ti&ecirc;m ch&iacute;ch ma tu&yacute;. Rất nhiều trường hợp l&acirc;y nhiễm qua đường t&igrave;nh dục l&agrave; bạn t&igrave;nh của người đ&atilde; từng ti&ecirc;m ch&iacute;ch ma tu&yacute;. V&igrave; vậy ti&ecirc;m ch&iacute;ch ma tu&yacute; kh&ocirc;ng an to&agrave;n đ&oacute;ng vai tr&ograve; quan trọng trong việc ph&aacute;t triển v&agrave; tiếp tục duy tr&igrave; dịch HIV tại Việt Nam.&nbsp; Mặt kh&aacute;c diễn biến của việc sử dụng ma tu&yacute; ở Việt Nam ng&agrave;y c&agrave;ng phức tạp trong đ&oacute; việc sử dụng c&aacute;c chất ma tu&yacute; tổng hợp như ma tu&yacute; đ&aacute; (crystal methamphetamine), ecstasy (MDMA) hay ketamine l&agrave; những chất c&oacute; ảnh hưởng l&acirc;u d&agrave;i đến sức khoẻ (bao gồm nguy cơ l&acirc;y nhiễm HIV do quan hệ t&igrave;nh dục kh&ocirc;ng an to&agrave;n) ng&agrave;y c&agrave;ng trở n&ecirc;n phổ biến hơn trong giới trẻ ở c&aacute;c th&agrave;nh phố lớn.</p>\r\n<p>Từ giữa những năm 1990, Việt Nam đ&atilde; thử nghiệm một loạt c&aacute;c m&ocirc; h&igrave;nh can thiệp nhằm l&agrave;m giảm g&aacute;nh nặng của ti&ecirc;m ch&iacute;ch&nbsp;ma tu&yacute; đối với sức khoẻ v&agrave; x&atilde; hội, bao gồm c&aacute;c hoạt động như cai nghiện tại cộng đồng v&agrave; trung t&acirc;m, ph&acirc;n ph&aacute;t v&agrave; trao đổi bơm kim ti&ecirc;m sạch, v&agrave; điều trị thay thế nghiện c&aacute;c chất dạng thuốc phiện bằng Methadone. Từ năm 2008 đến nay, từ chỗ triển khai th&iacute; điểm ở Hải Ph&ograve;ng v&agrave; TP Hồ Ch&iacute; Minh, chương tr&igrave;nh đ&atilde; nhanh ch&oacute;ng ph&aacute;t triển ra hơn 11 tỉnh th&agrave;nh phố v&agrave; số bệnh nh&acirc;n l&agrave; gần 10.000 người.&nbsp; Theo Bộ Y tế, kế hoạch mở rộng chương tr&igrave;nh đến năm 2015 sẽ c&oacute; hơn 80.000 người nghiện heroin được điều trị trong hơn 200 cơ sở điều trị trong cả nước. B&ecirc;n cạnh đ&oacute; c&aacute;c nỗ lực x&acirc;y dựng c&aacute;c cơ sở điều trị nghiện mở&nbsp; v&agrave; tự nguyện ở cộng đồng cũng l&agrave; một chiến lược quan trọng trong việc thay đổi diện m&ocirc; h&igrave;nh điều trị cai nghiện tập trung trong c&aacute;c trung t&acirc;m của Bộ Lao động-Thương binh v&agrave; X&atilde; hội.</p>\r\n<p>Một trong những th&aacute;ch thức của c&aacute;c chiến lược quan trọng n&oacute;i tr&ecirc;n l&agrave; việc đảm bảo đội ngũ c&aacute;n bộ đ&aacute;p ứng được&nbsp;c&aacute;c ti&ecirc;u chuẩn về&nbsp;chuy&ecirc;n m&ocirc;n v&agrave; được đ&agrave;o tạo cơ bản cũng như li&ecirc;n tục. Trong thời gian qua, Bộ Y tế Việt Nam phối hợp với sự hỗ trợ của PEPFAR, Quỹ To&agrave;n Cầu, Ng&acirc;n H&agrave;ng Thế giới th&ocirc;ng qua c&aacute;c tổ chức như FHI360 v&agrave; SCMS đ&atilde; tổ chức c&aacute;c kho&aacute; tập huấn về điều trị thay thế bằng Methadone đ&aacute;p ứng bước đầu nhu cầu ph&aacute;t triển của chương tr&igrave;nh. Tuy nhi&ecirc;n c&aacute;c hoạt động n&agrave;y c&ograve;n chưa gắn với hệ thống đ&agrave;o tạo y khoa v&agrave; y tế c&ocirc;ng cộng ở Việt Nam, v&agrave; sự tham gia của c&aacute;c cơ sở thực h&agrave;nh kh&aacute;m chữa bệnh v&iacute; dụ như hệ thống bệnh viện của ng&agrave;nh t&acirc;m thần c&ograve;n hạn chế.&nbsp;Trong bối cảnh đ&oacute;, Trung t&acirc;m Nghi&ecirc;n cứu v&agrave; Chuyển giao C&ocirc;ng nghệ Điều trị Nghiện chất ra đời đang từng bước n&acirc;ng cao năng lực cho c&aacute;c c&aacute;n bộ trong lĩnh vực điều trị nghiện, kết nối giữa đ&agrave;o tạo v&agrave; thực h&agrave;nh, giữa c&aacute;c cơ sở điều trị với cơ sở đ&agrave;o tạo nhằm đ&aacute;p ứng tốt nhất nhu cầu ph&aacute;t triển nhanh ch&oacute;ng v&agrave; bền vững lĩnh vực điều trị nghiện tại Việt Nam.&nbsp;Mục đ&iacute;ch của dự &aacute;n v&agrave; trung t&acirc;m l&agrave; x&acirc;y dựng năng lực đ&agrave;o tạo trước mắt để phục vụ cho việc mở rộng chương tr&igrave;nh điều trị thay thế bằng Methadone v&agrave; l&acirc;u d&agrave;i hơn l&agrave; x&acirc;y dựng năng lực về y học nghiện n&oacute;i chung v&agrave; nghiện chất n&oacute;i ri&ecirc;ng tại Trường Đại học Y H&agrave; Nội, g&oacute;p phần v&agrave;o việc kiểm so&aacute;t l&acirc;y nhiễm HIV/AIDS ở Việt Nam.&nbsp;</p>','PUBLISH',1,NULL,'POST','vi-VN',0,0,'2013-07-07 23:17:14','2013-07-06 10:29:20'),
	(35,'Cơ cấu tổ chức',20,'co-cau-to-chuc',NULL,'<p>Văn ph&ograve;ng điều phối VHATTC đặt tại Trung t&acirc;m Nghi&ecirc;n cứu v&agrave; Đ&agrave;o tạo HIV/AIDS của Trường Đại học Y H&agrave; Nội. Dự &aacute;n x&acirc;y dựng VHATTC đặt dưới sự l&atilde;nh đạo trực tiếp của Hiệu Trường nh&agrave; trường, v&agrave; sự tham gia chặt chẽ của c&aacute;c giảng vi&ecirc;n bộ m&ocirc;n T&acirc;m thần v&agrave; Viện Đ&agrave;o tạo Y học Dự ph&ograve;ng v&agrave; Y tế C&ocirc;ng cộng.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><span>Trung t&acirc;m Nghi&ecirc;n cứu v&agrave; Đ&agrave;o tạo HIV/AIDS được th&agrave;nh lập năm 1994, l&agrave; một trong những đơn vị đầu ti&ecirc;n được th&agrave;nh lập trong c&aacute;c trường Đại học Y Dược với mục đ&iacute;ch đ&agrave;o tạo c&aacute;n bộ ph&ograve;ng chống HIV/AIDS v&agrave; đưa nội dung HIV/AIDS v&agrave;o chương tr&igrave;nh đ&agrave;o tạo đại học.&nbsp;Bộ m&ocirc;n T&acirc;m thần v&agrave; Viện Sức khỏe T&acirc;m thần, Bệnh viện Bạch Mai&nbsp;<span>&nbsp;l&agrave; nơi quy tụ của c&aacute;c nh&agrave; khoa học đầu ng&agrave;nh về lĩnh vực t&acirc;m thần học v&agrave; l&agrave; địa chỉ đ&aacute;ng tin cậy trong c&ocirc;ng t&aacute;c đ&agrave;o tạo bậc đại học v&agrave; sau đại học cho chuy&ecirc;n ng&agrave;nh t&acirc;m thần trong cả nước. Trong khi đ&oacute;,&nbsp;</span>Viện YHDP v&agrave; YTCC l&agrave;</span><span>&nbsp;</span><span>được th&agrave;nh lập dựa tr&ecirc;n khoa Y tế c&ocirc;ng cộng, tiền th&acirc;n l&agrave; sự kết hợp giữa hai bộ m&ocirc;n Vệ sinh-dịch tễ v&agrave; Bộ m&ocirc;n Tổ chức quản l&yacute; Y tế. Viện&nbsp;</span><span>đ&atilde; tham gia đ&agrave;o tạo h&agrave;ng ng&agrave;n c&aacute;c b&aacute;c sĩ đa khoa, chuy&ecirc;n khoa Y học dự ph&ograve;ng v&agrave; Y tế c&ocirc;ng cộng, c</span><span>ung cấp nghi&ecirc;n cứu vi&ecirc;n cho c&aacute;c viện nghi&ecirc;n cứu, c&aacute;c c&aacute;n bộ giảng dạy của c&aacute;c trường đại học, cao đẳng, trung cấp Y-Dược trong cả nước, c&aacute;c nh&acirc;n vi&ecirc;n y tế tr&igrave;nh độ đại học v&agrave; sau đại học cho c&aacute;c tỉnh th&agrave;nh cũng như y tế c&aacute;c Bộ, Ng&agrave;nh.</span></p>\r\n<p>B&ecirc;n cạnh việc tận dụng tối đa những chuy&ecirc;n gia h&agrave;ng đầu của nh&agrave; trường trong c&aacute;c lĩnh vực li&ecirc;n quan, c&aacute;c hoạt động của VhATTC được sự hỗ trợ của Ban cố vấn bao gồm đại diện c&aacute;c cơ quan quản l&yacute; nh&agrave; nước, c&aacute;c chuy&ecirc;n gia h&agrave;ng đầu của Việt Nam trong c&aacute;c lĩnh vực li&ecirc;n quan, v&agrave; đại diện c&aacute;c tổ chức quốc tế c&oacute; hoạt động t&iacute;ch cực trong lĩnh vực ph&ograve;ng, chống HIV/AIDS v&agrave; nghiện chất ở Việt Nam. Hoạt động của c&aacute;c th&agrave;nh vi&ecirc;n Ban cố vấn của VHATTC gi&uacute;p kết nối với c&aacute;c cơ quan trong v&agrave; ngo&agrave;i nước c&ugrave;ng chung nỗ lực giải quyết c&aacute;c vấn đề c&oacute; li&ecirc;n quan.</p>\r\n<p>&nbsp;<img src=\"http://i1320.photobucket.com/albums/u529/thuyanh120489/ScreenShot2013-02-02at91654PM_zps6cbdbca2.png\" alt=\"\" /></p>\r\n<p>Để biết th&ecirc;m th&ocirc;ng tin về nh&acirc;n sự ch&iacute;nh của VHATTC, xin vui l&ograve;ng xem th&ecirc;m:</p>\r\n<p>Quản l&yacute; dự&nbsp;&aacute;n</p>\r\n<p>Ban Cố vấn&nbsp;</p>','PUBLISH',1,NULL,'POST','vi-VN',0,0,'2013-07-07 23:25:38','2013-07-06 10:29:40'),
	(36,'Hoạt động',20,'hoat-dong',NULL,'<p><span>VHATTC x&acirc;y dựng năng lực đ&agrave;o tạo v&agrave; chuyển giao c&ocirc;ng nghệ điều trị nghiện chất g&oacute;p phần v&agrave;o c&ocirc;ng t&aacute;c ph&ograve;ng, chống t&aacute;c hại của c&aacute;c chất g&acirc;y nghiện, trong đ&oacute; đặc biệt l&agrave; HIV/AIDS, đối với c&aacute; nh&acirc;n người sử dụng ma tu&yacute;, gia đ&igrave;nh v&agrave; cộng đồng.&nbsp;</span><span>Để thực hiện mục ti&ecirc;u n&agrave;y, c&aacute;c hoạt động của VHATTC tập trung v&agrave;o một số ưu ti&ecirc;n chiến lược.&nbsp;</span></p>\r\n<p>C&aacute;c ưu ti&ecirc;n của VHATTC bao gồm:&nbsp;<span>(1) N&acirc;ng cao năng lực giảng dạy l&yacute; thuyết v&agrave; thực h&agrave;nh về điều trị nghiện chất n&oacute;i chung v&agrave; điều trị thay thế c&aacute;c chất dạng thuốc phiện bằng methadone n&oacute;i ri&ecirc;ng; (2) X&acirc;y dựng, giới thiệu c&aacute;c t&agrave;i liệu đ&agrave;o tạo về nghiện chất v&agrave; điều trị nghiện chất hướng đến hỗ trợ tối đa cho qu&aacute; tr&igrave;nh phục hồi của người lệ thuộc ma tu&yacute;; (3) Triển khai c&aacute;c nghi&ecirc;n cứu l&acirc;m s&agrave;ng v&agrave; cộng đồng gi&uacute;p x&acirc;y dựng bằng chứng của Việt Nam; (4) X&acirc;y dựng quan hệ hợp t&aacute;c với c&aacute;c cơ quan quản l&yacute; nh&agrave; nước, c&aacute;c cơ quan v&agrave; c&aacute; nh&acirc;n nghi&ecirc;n cứu v&agrave; đ&agrave;o tạo trong v&agrave; ngo&agrave;i nước trong c&ocirc;ng t&aacute;c điều trị nghiện chất v&agrave; điều trị thay thế bằng methadone.</span></p>\r\n<p>Về đ&agrave;o tạo, ba trọng t&acirc;m ưu ti&ecirc;n của VHATTC l&agrave;:</p>\r\n<p><span>C&aacute;c hoạt động đ&agrave;o tạo của VHATTC bao gồm chuỗi b&agrave;i giảng về y học v&agrave; khoa học về nghiện chất tổ chức hai th&aacute;ng một lần, c&aacute;c kho&aacute; đ&agrave;o tạo ngắn hạn, đ&agrave;o tạo trực tuyến v&agrave; hỗ trợ kỹ thuật tại c&aacute;c cơ sở điều trị.&nbsp; Để biết th&ecirc;m th&ocirc;ng tin về hoạt động đ&agrave;o tạo của VHATTC, xin bấm&nbsp;<a href=\"vi/dao-tao-ho-tro-ky-thuat/su-kien-khoa-dao-tao-vhattc\">v&agrave;o đ&acirc;y</a><a href=\"vi/dao-tao/su-kien-khoa-dao-tao-vhattc\">.</a></span></p>\r\n<p><span>Về nghi&ecirc;n cứu, c&aacute;c trọng t&acirc;m ưu ti&ecirc;n của VHATTC bao gồm c&aacute;c nghi&ecirc;n cứu dịch tễ học v&agrave; khoa học x&atilde; hội, c&aacute;c nghi&ecirc;n cứu l&acirc;m s&agrave;ng, c&aacute;c nghi&ecirc;n cứu đ&aacute;nh gi&aacute; hiệu quả v&agrave; t&aacute;c động m&ocirc; h&igrave;nh can thiệp, v&agrave; c&aacute;c nghi&ecirc;n cứu ch&iacute;nh s&aacute;ch x&acirc;y dựng bằng chứng li&ecirc;n quan đến nghiện chất v&agrave; HIV/AIDS. Để biết th&ecirc;m th&ocirc;ng tin về c&aacute;c hoạt động nghi&ecirc;n cứu của VHATTC v&agrave; Trung t&acirc;m nghi&ecirc;n cứu v&agrave; đ&agrave;o tạo HIV/AIDS, c&oacute; thể xem th&ecirc;m&nbsp;<a href=\"vi/nghien-cuu\">tại đ&acirc;y</a>.</span></p>','PUBLISH',1,NULL,'POST','vi-VN',0,0,'2013-07-07 23:28:22','2013-07-06 10:30:53'),
	(37,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 10:31:07','2013-07-06 10:31:07'),
	(38,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 10:34:59','2013-07-06 10:34:59'),
	(39,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 10:36:05','2013-07-06 10:36:05'),
	(40,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 10:38:08','2013-07-06 10:38:08'),
	(41,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 10:39:46','2013-07-06 10:39:46'),
	(42,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 10:40:25','2013-07-06 10:40:25'),
	(43,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 10:40:41','2013-07-06 10:40:41'),
	(44,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 10:47:42','2013-07-06 10:47:42'),
	(45,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 10:52:56','2013-07-06 10:52:56'),
	(46,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 11:14:25','2013-07-06 11:14:25'),
	(47,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 11:16:01','2013-07-06 11:16:01'),
	(48,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 11:16:44','2013-07-06 11:16:44'),
	(49,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 11:16:57','2013-07-06 11:16:57'),
	(50,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 11:18:17','2013-07-06 11:18:17'),
	(51,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 11:19:01','2013-07-06 11:19:01'),
	(52,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 11:19:45','2013-07-06 11:19:45'),
	(53,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 11:22:35','2013-07-06 11:22:35'),
	(54,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 11:22:48','2013-07-06 11:22:48'),
	(55,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 11:23:27','2013-07-06 11:23:27'),
	(56,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 11:23:45','2013-07-06 11:23:45'),
	(57,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 11:25:21','2013-07-06 11:25:21'),
	(58,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 11:27:36','2013-07-06 11:27:36'),
	(59,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 11:27:50','2013-07-06 11:27:50'),
	(60,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 11:28:11','2013-07-06 11:28:11'),
	(61,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'POST','*',0,0,'2013-07-06 17:52:12','2013-07-06 11:30:36'),
	(62,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'post','*',0,0,'2013-07-06 17:51:30','2013-07-06 17:51:30'),
	(63,'',0,NULL,NULL,NULL,'PUBLISH',1,NULL,'post','*',0,0,'2013-07-06 17:51:34','2013-07-06 17:51:34');

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
	(5,'new_events','New Events','home.new_events','block_position'),
	(6,'','','','');

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
	(40,'Root of banner','root-of-banner','banner',NULL,'*',0,'banner',1,8,0),
	(41,'Slideshow','slideshow','banner',NULL,'*',0,'banner',2,3,1),
	(42,'Partners (VI)','partners-vi','banner',NULL,'vi-VN',0,'banner',4,5,1),
	(43,'Partners (EN)','partners-en','banner',NULL,'en-GB',0,'banner',6,7,1),
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
	(1,'tronghieu','8d4a275a81f03d619be9dc0caefa361c69bdbf8dd5508f4df7c740b4185258a2','tronghieu.luu@gmail.com','Lưu Trọng Hiếu','0989388300',1,0,1,'1985-12-10','697d6b3664158512ab6596bda46c65ae','2013-07-08 13:20:56','2013-05-07 15:23:13',1373264456,1367916104),
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
  `created_time` datetime NOT NULL,
  `modified_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `position` (`position`),
  KEY `position_2` (`position`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
