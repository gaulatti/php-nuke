-- MySQL dump 10.13  Distrib 5.6.24, for osx10.8 (x86_64)
--
-- Host: 127.0.0.1    Database: nuke
-- ------------------------------------------------------
-- Server version 5.6.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `nuke_antiflood`
--

DROP TABLE IF EXISTS `nuke_antiflood`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_antiflood` (
  `ip_addr` varchar(48) NOT NULL,
  `time` varchar(14) NOT NULL,
  KEY `ip_addr` (`ip_addr`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_antiflood`
--

LOCK TABLES `nuke_antiflood` WRITE;
/*!40000 ALTER TABLE `nuke_antiflood` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_antiflood` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_authors`
--

DROP TABLE IF EXISTS `nuke_authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_authors` (
  `aid` varchar(25) NOT NULL DEFAULT '',
  `name` varchar(50) DEFAULT NULL,
  `url` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `pwd` varchar(40) DEFAULT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `radminsuper` tinyint(1) NOT NULL DEFAULT '1',
  `admlanguage` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`aid`),
  KEY `aid` (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_authors`
--

LOCK TABLES `nuke_authors` WRITE;
/*!40000 ALTER TABLE `nuke_authors` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_autonews`
--

DROP TABLE IF EXISTS `nuke_autonews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_autonews` (
  `anid` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `aid` varchar(30) NOT NULL DEFAULT '',
  `title` varchar(80) NOT NULL DEFAULT '',
  `time` varchar(19) NOT NULL DEFAULT '',
  `hometext` text NOT NULL,
  `bodytext` text NOT NULL,
  `topic` int(3) NOT NULL DEFAULT '1',
  `informant` varchar(20) NOT NULL DEFAULT '',
  `notes` text NOT NULL,
  `ihome` int(1) NOT NULL DEFAULT '0',
  `alanguage` varchar(30) NOT NULL DEFAULT '',
  `acomm` int(1) NOT NULL DEFAULT '0',
  `associated` text NOT NULL,
  PRIMARY KEY (`anid`),
  KEY `anid` (`anid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_autonews`
--

LOCK TABLES `nuke_autonews` WRITE;
/*!40000 ALTER TABLE `nuke_autonews` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_autonews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_banned_ip`
--

DROP TABLE IF EXISTS `nuke_banned_ip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_banned_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL DEFAULT '',
  `reason` varchar(255) NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_banned_ip`
--

LOCK TABLES `nuke_banned_ip` WRITE;
/*!40000 ALTER TABLE `nuke_banned_ip` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_banned_ip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_banner`
--

DROP TABLE IF EXISTS `nuke_banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_banner` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `imageurl` varchar(100) NOT NULL DEFAULT '',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `alttext` varchar(255) NOT NULL DEFAULT '',
  `date` datetime DEFAULT NULL,
  `dateend` datetime DEFAULT NULL,
  `position` int(10) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `ad_class` varchar(5) NOT NULL DEFAULT '',
  `ad_code` text NOT NULL,
  `ad_width` int(4) DEFAULT '0',
  `ad_height` int(4) DEFAULT '0',
  PRIMARY KEY (`bid`),
  KEY `bid` (`bid`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_banner`
--

LOCK TABLES `nuke_banner` WRITE;
/*!40000 ALTER TABLE `nuke_banner` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_banner_clients`
--

DROP TABLE IF EXISTS `nuke_banner_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_banner_clients` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL DEFAULT '',
  `contact` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `login` varchar(10) NOT NULL DEFAULT '',
  `passwd` varchar(10) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL,
  PRIMARY KEY (`cid`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_banner_clients`
--

LOCK TABLES `nuke_banner_clients` WRITE;
/*!40000 ALTER TABLE `nuke_banner_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_banner_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_banner_plans`
--

DROP TABLE IF EXISTS `nuke_banner_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_banner_plans` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `delivery` varchar(10) NOT NULL DEFAULT '',
  `delivery_type` varchar(25) NOT NULL DEFAULT '',
  `price` varchar(25) NOT NULL DEFAULT '0',
  `buy_links` text NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_banner_plans`
--

LOCK TABLES `nuke_banner_plans` WRITE;
/*!40000 ALTER TABLE `nuke_banner_plans` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_banner_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_banner_positions`
--

DROP TABLE IF EXISTS `nuke_banner_positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_banner_positions` (
  `apid` int(10) NOT NULL AUTO_INCREMENT,
  `position_number` int(5) NOT NULL DEFAULT '0',
  `position_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`apid`),
  KEY `position_number` (`position_number`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_banner_positions`
--

LOCK TABLES `nuke_banner_positions` WRITE;
/*!40000 ALTER TABLE `nuke_banner_positions` DISABLE KEYS */;
INSERT INTO `nuke_banner_positions` VALUES (1,0,'Page Top'),(2,1,'Left Block');
/*!40000 ALTER TABLE `nuke_banner_positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_banner_terms`
--

DROP TABLE IF EXISTS `nuke_banner_terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_banner_terms` (
  `terms_body` text NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_banner_terms`
--

LOCK TABLES `nuke_banner_terms` WRITE;
/*!40000 ALTER TABLE `nuke_banner_terms` DISABLE KEYS */;
INSERT INTO `nuke_banner_terms` VALUES ('<div align=\"justify\"><strong>Introduction:</strong> This Agreement between you and&nbsp;[sitename] consists of these Terms and Conditions. &quot;You&quot; or &quot;Advertiser&quot; means the entity identified in this enrollment form, and/or any agency acting on its behalf, which shall also be bound by the terms of this Agreement. Please read very carefully these Terms and Conditions.<br /><strong><br />Uses:</strong> You agree that your ads may be placed on (i) [sitename] web site and (ii) Any ads may be modified without your consent to comply with any policy of [sitename]. [sitename] reserves the right to, and in its sole discretion may, at any time review, reject, modify, or remove any ad. No liability of [sitename] and/or its owner(s) shall result from any such decision.<br /><br /></div><div align=\"justify\"><strong>Parties\' Responsibilities:</strong> You are responsible of your own site and/or service advertised in [sitename] web site. You are solely responsible for the advertising image creation, advertising text and for the content of your ads, including URL links. [sitename] is not responsible for anything regarding your Web site(s) including, but not limited to, maintenance of your Web site(s), order entry, customer service, payment processing, shipping, cancellations or returns.<br /><br /></div><div align=\"justify\"><strong>Impressions Count:</strong> Any hit to [sitename] web site is counted as an impression. Due to our advertising price we don\'t discriminate from users or automated robots. Even if you access to [sitename] web site and see your own banner ad it will be counted as a valid impression. Only in the case of [sitename] web site administrator, the impressions will not be counted.<br /><br /></div><div align=\"justify\"><strong>Termination, Cancellation:</strong> [sitename] may at any time, in its sole discretion, terminate the Campaign, terminate this Agreement, or cancel any ad(s) or your use of any Target. [sitename] will notify you via email of any such termination or cancellation, which shall be effective immediately. No refund will be made for any reason. Remaining impressions will be stored in a database and you\'ll be able to request another campaign to complete your inventory. You may cancel any ad and/or terminate this Agreement with or without cause at any time. Termination of your account shall be effective when [sitename] receives your notice via email. No refund will be made for any reason. Remaining impressions will be stored in a database for future uses by you and/or your company.<br /><br /></div><div align=\"justify\"><strong>Content:</strong> [sitename] web site doesn\'t accepts advertising that contains: (i) pornography, (ii) explicit adult content, (iii) moral questionable content, (iv) illegal content of any kind, (v) illegal drugs promotion, (vi) racism, (vii) politics content, (viii) religious content, and/or (ix) fraudulent suspicious content. If your advertising and/or target web site has any of this content and you purchased an advertising package, you\'ll not receive refund of any kind but your banners ads impressions will be stored for future use.<br /><br /></div><div align=\"justify\"><strong>Confidentiality:</strong> Each party agrees not to disclose Confidential Information of the other party without prior written consent except as provided herein. &quot;Confidential Information&quot; includes (i) ads, prior to publication, (ii) submissions or modifications relating to any advertising campaign, (iii) clickthrough rates or other statistics (except in an aggregated form that includes no identifiable information about you), and (iv) any other information designated in writing as &quot;Confidential.&quot; It does not include information that has become publicly known through no breach by a party, or has been (i) independently developed without access to the other party\'s Confidential Information; (ii) rightfully received from a third party; or (iii) required to be disclosed by law or by a governmental authority.<br /><br /></div><div align=\"justify\"><strong>No Guarantee:</strong> [sitename] makes no guarantee regarding the levels of clicks for any ad on its site. [sitename] may offer the same Target to more than one advertiser. You may not receive exclusivity unless special private contract between [sitename] and you.<br /><br /></div><div align=\"justify\"><strong>No Warranty:</strong> [sitename] MAKES NO WARRANTY, EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION WITH RESPECT TO ADVERTISING AND OTHER SERVICES, AND EXPRESSLY DISCLAIMS THE WARRANTIES OR CONDITIONS OF NONINFRINGEMENT, MERCHANTABILITY AND FITNESS FOR ANY PARTICULAR PURPOSE.<br /><br /></div><div align=\"justify\"><strong>Limitations of Liability:</strong> In no event shall [sitename] be liable for any act or omission, or any event directly or indirectly resulting from any act or omission of Advertiser, Partner, or any third parties (if any). EXCEPT FOR THE PARTIES\' INDEMNIFICATION AND CONFIDENTIALITY OBLIGATIONS HEREUNDER, (i) IN NO EVENT SHALL EITHER PARTY BE LIABLE UNDER THIS AGREEMENT FOR ANY CONSEQUENTIAL, SPECIAL, INDIRECT, EXEMPLARY, PUNITIVE, OR OTHER DAMAGES WHETHER IN CONTRACT, TORT OR ANY OTHER LEGAL THEORY, EVEN IF SUCH PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES AND NOTWITHSTANDING ANY FAILURE OF ESSENTIAL PURPOSE OF ANY LIMITED REMEDY AND (ii) [sitename] AGGREGATE LIABILITY TO ADVERTISER UNDER THIS AGREEMENT FOR ANY CLAIM IS LIMITED TO THE AMOUNT PAID TO [sitename] BY ADVERTISER FOR THE AD GIVING RISE TO THE CLAIM. Each party acknowledges that the other party has entered into this Agreement relying on the limitations of liability stated herein and that those limitations are an essential basis of the bargain between the parties. Without limiting the foregoing and except for payment obligations, neither party shall have any liability for any failure or delay resulting from any condition beyond the reasonable control of such party, including but not limited to governmental action or acts of terrorism, earthquake or other acts of God, labor conditions, and power failures.<br /><br /></div><div align=\"justify\"><strong>Payment:</strong> You agree to pay in advance the cost of the advertising. [sitename] will not setup any banner ads campaign(s) unless the payment process is complete. [sitename] may change its pricing at any time without prior notice. If you have an advertising campaign running and/or impressions stored for future use for any mentioned cause and [sitename] changes its pricing, you\'ll not need to pay any difference. Your purchased banners fee will remain the same. Charges shall be calculated solely based on records maintained by [sitename]. No other measurements or statistics of any kind shall be accepted by [sitename] or have any effect under this Agreement.<br /><br /></div><div align=\"justify\"><strong>Representations and Warranties:</strong> You represent and warrant that (a) all of the information provided by you to [sitename] to enroll in the Advertising Campaign is correct and current; (b) you hold all rights to permit [sitename] and any Partner(s) to use, reproduce, display, transmit and distribute your ad(s); and (c) [sitename] and any Partner(s) Use, your Target(s), and any site(s) linked to, and products or services to which users are directed, will not, in any state or country where the ad is displayed (i) violate any criminal laws or third party rights giving rise to civil liability, including but not limited to trademark rights or rights relating to the performance of music; or (ii) encourage conduct that would violate any criminal or civil law. You further represent and warrant that any Web site linked to your ad(s) (i) complies with all laws and regulations in any state or country where the ad is displayed; (ii) does not breach and has not breached any duty toward or rights of any person or entity including, without limitation, rights of publicity or privacy, or rights or duties under consumer protection, product liability, tort, or contract theories; and (iii) is not false, misleading, defamatory, libelous, slanderous or threatening.<br /><br /></div><div align=\"justify\"><strong>Your Obligation to Indemnify:</strong> You agree to indemnify, defend and hold [sitename], its agents, affiliates, subsidiaries, directors, officers, employees, and applicable third parties (e.g., all relevant Partner(s), licensors, licensees, consultants and contractors) (&quot;Indemnified Person(s)&quot;) harmless from and against any and all third party claims, liability, loss, and expense (including damage awards, settlement amounts, and reasonable legal fees), brought against any Indemnified Person(s), arising out of, related to or which may arise from your use of the Advertising Program, your Web site, and/or your breach of any term of this Agreement. Customer understands and agrees that each Partner, as defined herein, has the right to assert and enforce its rights under this Section directly on its own behalf as a third party beneficiary.<br /><br /></div><div align=\"justify\"><strong>Information Rights:</strong> [sitename] may retain and use for its own purposes all information you provide, including but not limited to Targets, URLs, the content of ads, and contact and billing information. [sitename] may share this information about you with business partners and/or sponsors. [sitename] will not sell your information. Your name, web site\'s URL and related graphics shall be used by [sitename] in its own web site at any time as a sample to the public, even if your Advertising Campaign has been finished.<br /><br /></div><div align=\"justify\"><strong>Miscellaneous:</strong> Any decision made by [sitename] under this Agreement shall be final. [sitename] shall have no liability for any such decision. You will be responsible for all reasonable expenses (including attorneys\' fees) incurred by [sitename] in collecting unpaid amounts under this Agreement. This Agreement shall be governed by the laws of [country]. Any dispute or claim arising out of or in connection with this Agreement shall be adjudicated in [country]. This constitutes the entire agreement between the parties with respect to the subject matter hereof. Advertiser may not resell, assign, or transfer any of its rights hereunder. Any such attempt may result in termination of this Agreement, without liability to [sitename] and without any refund. The relationship(s) between [sitename] and the &quot;Partners&quot; is not one of a legal partnership relationship, but is one of independent contractors. This Agreement shall be construed as if both parties jointly wrote it.</div>','Canada');
/*!40000 ALTER TABLE `nuke_banner_terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbauth_access`
--

DROP TABLE IF EXISTS `nuke_bbauth_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbauth_access` (
  `group_id` mediumint(8) NOT NULL DEFAULT '0',
  `forum_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `auth_view` tinyint(1) NOT NULL DEFAULT '0',
  `auth_read` tinyint(1) NOT NULL DEFAULT '0',
  `auth_post` tinyint(1) NOT NULL DEFAULT '0',
  `auth_reply` tinyint(1) NOT NULL DEFAULT '0',
  `auth_edit` tinyint(1) NOT NULL DEFAULT '0',
  `auth_delete` tinyint(1) NOT NULL DEFAULT '0',
  `auth_sticky` tinyint(1) NOT NULL DEFAULT '0',
  `auth_announce` tinyint(1) NOT NULL DEFAULT '0',
  `auth_vote` tinyint(1) NOT NULL DEFAULT '0',
  `auth_pollcreate` tinyint(1) NOT NULL DEFAULT '0',
  `auth_attachments` tinyint(1) NOT NULL DEFAULT '0',
  `auth_mod` tinyint(1) NOT NULL DEFAULT '0',
  KEY `group_id` (`group_id`),
  KEY `forum_id` (`forum_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbauth_access`
--

LOCK TABLES `nuke_bbauth_access` WRITE;
/*!40000 ALTER TABLE `nuke_bbauth_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_bbauth_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbbanlist`
--

DROP TABLE IF EXISTS `nuke_bbbanlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbbanlist` (
  `ban_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ban_userid` mediumint(8) NOT NULL DEFAULT '0',
  `ban_ip` varchar(8) NOT NULL DEFAULT '',
  `ban_email` varchar(255) DEFAULT NULL,
  `ban_time` int(11) DEFAULT NULL,
  `ban_expire_time` int(11) DEFAULT NULL,
  `ban_by_userid` mediumint(8) DEFAULT NULL,
  `ban_priv_reason` text,
  `ban_pub_reason_mode` tinyint(1) DEFAULT NULL,
  `ban_pub_reason` text,
  PRIMARY KEY (`ban_id`),
  KEY `ban_ip_user_id` (`ban_ip`,`ban_userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbbanlist`
--

LOCK TABLES `nuke_bbbanlist` WRITE;
/*!40000 ALTER TABLE `nuke_bbbanlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_bbbanlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbcategories`
--

DROP TABLE IF EXISTS `nuke_bbcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbcategories` (
  `cat_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(100) DEFAULT NULL,
  `cat_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`),
  KEY `cat_order` (`cat_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbcategories`
--

LOCK TABLES `nuke_bbcategories` WRITE;
/*!40000 ALTER TABLE `nuke_bbcategories` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_bbcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbconfig`
--

DROP TABLE IF EXISTS `nuke_bbconfig`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbconfig` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`config_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbconfig`
--

LOCK TABLES `nuke_bbconfig` WRITE;
/*!40000 ALTER TABLE `nuke_bbconfig` DISABLE KEYS */;
INSERT INTO `nuke_bbconfig` VALUES ('allow_avatar_local','1'),('allow_avatar_remote','0'),('allow_avatar_upload','0'),('allow_bbcode','1'),('allow_html','1'),('allow_html_tags','b,i,u,pre'),('allow_namechange','0'),('allow_sig','1'),('allow_smilies','1'),('allow_theme_create','0'),('avatar_filesize','6144'),('avatar_gallery_path','modules/Forums/images/avatars'),('avatar_max_height','80'),('avatar_max_width','80'),('avatar_path','modules/Forums/images/avatars'),('board_disable','0'),('board_email','Webmaster@MySite.com'),('board_email_form','0'),('board_email_sig','Thanks, Webmaster@MySite.com'),('board_startdate','1013908210'),('board_timezone','10'),('config_id','1'),('cookie_domain','MySite.com'),('cookie_name','phpbb2mysql'),('cookie_path','/'),('cookie_secure','0'),('coppa_fax',''),('coppa_mail',''),('default_dateformat','D M d, Y g:i a'),('default_lang','english'),('default_style','1'),('enable_confirm','0'),('flood_interval','15'),('gzip_compress','0'),('hot_threshold','25'),('max_inbox_privmsgs','100'),('max_poll_options','10'),('max_savebox_privmsgs','100'),('max_sentbox_privmsgs','100'),('max_sig_chars','255'),('override_user_style','1'),('posts_per_page','15'),('privmsg_disable','0'),('prune_enable','0'),('rand_seed','0'),('record_online_date','1034668530'),('record_online_users','2'),('require_activation','0'),('script_path','/modules/Forums/'),('search_flood_interval','15'),('search_min_chars','3'),('sendmail_fix','0'),('server_name','MySite.com'),('server_port','80'),('session_length','3600'),('sitename','MySite.com'),('site_desc',''),('smilies_path','modules/Forums/images/smiles'),('smtp_delivery','0'),('smtp_host',''),('smtp_password',''),('smtp_username',''),('topics_per_page','50'),('version','.0.21');
/*!40000 ALTER TABLE `nuke_bbconfig` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbdisallow`
--

DROP TABLE IF EXISTS `nuke_bbdisallow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbdisallow` (
  `disallow_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `disallow_username` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`disallow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbdisallow`
--

LOCK TABLES `nuke_bbdisallow` WRITE;
/*!40000 ALTER TABLE `nuke_bbdisallow` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_bbdisallow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbforum_prune`
--

DROP TABLE IF EXISTS `nuke_bbforum_prune`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbforum_prune` (
  `prune_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `forum_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `prune_days` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `prune_freq` tinyint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`prune_id`),
  KEY `forum_id` (`forum_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbforum_prune`
--

LOCK TABLES `nuke_bbforum_prune` WRITE;
/*!40000 ALTER TABLE `nuke_bbforum_prune` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_bbforum_prune` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbforums`
--

DROP TABLE IF EXISTS `nuke_bbforums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbforums` (
  `forum_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_name` varchar(150) DEFAULT NULL,
  `forum_desc` text,
  `forum_status` tinyint(4) NOT NULL DEFAULT '0',
  `forum_order` mediumint(8) unsigned NOT NULL DEFAULT '1',
  `forum_posts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_topics` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_last_post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `prune_next` int(11) DEFAULT NULL,
  `prune_enable` tinyint(1) NOT NULL DEFAULT '1',
  `auth_view` tinyint(2) NOT NULL DEFAULT '0',
  `auth_read` tinyint(2) NOT NULL DEFAULT '0',
  `auth_post` tinyint(2) NOT NULL DEFAULT '0',
  `auth_reply` tinyint(2) NOT NULL DEFAULT '0',
  `auth_edit` tinyint(2) NOT NULL DEFAULT '0',
  `auth_delete` tinyint(2) NOT NULL DEFAULT '0',
  `auth_sticky` tinyint(2) NOT NULL DEFAULT '0',
  `auth_announce` tinyint(2) NOT NULL DEFAULT '0',
  `auth_vote` tinyint(2) NOT NULL DEFAULT '0',
  `auth_pollcreate` tinyint(2) NOT NULL DEFAULT '0',
  `auth_attachments` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`forum_id`),
  KEY `forums_order` (`forum_order`),
  KEY `cat_id` (`cat_id`),
  KEY `forum_last_post_id` (`forum_last_post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbforums`
--

LOCK TABLES `nuke_bbforums` WRITE;
/*!40000 ALTER TABLE `nuke_bbforums` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_bbforums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbgroups`
--

DROP TABLE IF EXISTS `nuke_bbgroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbgroups` (
  `group_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `group_type` tinyint(4) NOT NULL DEFAULT '1',
  `group_name` varchar(40) NOT NULL DEFAULT '',
  `group_description` varchar(255) NOT NULL DEFAULT '',
  `group_moderator` mediumint(8) NOT NULL DEFAULT '0',
  `group_single_user` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`group_id`),
  KEY `group_single_user` (`group_single_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbgroups`
--

LOCK TABLES `nuke_bbgroups` WRITE;
/*!40000 ALTER TABLE `nuke_bbgroups` DISABLE KEYS */;
INSERT INTO `nuke_bbgroups` VALUES (1,1,'Anonymous','Personal User',0,1),(3,2,'Moderators','Moderators of this Forum',5,0);
/*!40000 ALTER TABLE `nuke_bbgroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbposts`
--

DROP TABLE IF EXISTS `nuke_bbposts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbposts` (
  `post_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `poster_id` mediumint(8) NOT NULL DEFAULT '0',
  `post_time` int(11) NOT NULL DEFAULT '0',
  `poster_ip` varchar(8) NOT NULL DEFAULT '',
  `post_username` varchar(25) DEFAULT NULL,
  `enable_bbcode` tinyint(1) NOT NULL DEFAULT '1',
  `enable_html` tinyint(1) NOT NULL DEFAULT '0',
  `enable_smilies` tinyint(1) NOT NULL DEFAULT '1',
  `enable_sig` tinyint(1) NOT NULL DEFAULT '1',
  `post_edit_time` int(11) DEFAULT NULL,
  `post_edit_count` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`),
  KEY `poster_id` (`poster_id`),
  KEY `post_time` (`post_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbposts`
--

LOCK TABLES `nuke_bbposts` WRITE;
/*!40000 ALTER TABLE `nuke_bbposts` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_bbposts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbposts_text`
--

DROP TABLE IF EXISTS `nuke_bbposts_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbposts_text` (
  `post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `bbcode_uid` varchar(10) NOT NULL DEFAULT '',
  `post_subject` varchar(60) DEFAULT NULL,
  `post_text` text,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbposts_text`
--

LOCK TABLES `nuke_bbposts_text` WRITE;
/*!40000 ALTER TABLE `nuke_bbposts_text` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_bbposts_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbprivmsgs`
--

DROP TABLE IF EXISTS `nuke_bbprivmsgs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbprivmsgs` (
  `privmsgs_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `privmsgs_type` tinyint(4) NOT NULL DEFAULT '0',
  `privmsgs_subject` varchar(255) NOT NULL DEFAULT '0',
  `privmsgs_from_userid` mediumint(8) NOT NULL DEFAULT '0',
  `privmsgs_to_userid` mediumint(8) NOT NULL DEFAULT '0',
  `privmsgs_date` int(11) NOT NULL DEFAULT '0',
  `privmsgs_ip` varchar(8) NOT NULL DEFAULT '',
  `privmsgs_enable_bbcode` tinyint(1) NOT NULL DEFAULT '1',
  `privmsgs_enable_html` tinyint(1) NOT NULL DEFAULT '0',
  `privmsgs_enable_smilies` tinyint(1) NOT NULL DEFAULT '1',
  `privmsgs_attach_sig` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`privmsgs_id`),
  KEY `privmsgs_from_userid` (`privmsgs_from_userid`),
  KEY `privmsgs_to_userid` (`privmsgs_to_userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbprivmsgs`
--

LOCK TABLES `nuke_bbprivmsgs` WRITE;
/*!40000 ALTER TABLE `nuke_bbprivmsgs` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_bbprivmsgs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbprivmsgs_text`
--

DROP TABLE IF EXISTS `nuke_bbprivmsgs_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbprivmsgs_text` (
  `privmsgs_text_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `privmsgs_bbcode_uid` varchar(10) NOT NULL DEFAULT '0',
  `privmsgs_text` text,
  PRIMARY KEY (`privmsgs_text_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbprivmsgs_text`
--

LOCK TABLES `nuke_bbprivmsgs_text` WRITE;
/*!40000 ALTER TABLE `nuke_bbprivmsgs_text` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_bbprivmsgs_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbranks`
--

DROP TABLE IF EXISTS `nuke_bbranks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbranks` (
  `rank_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `rank_title` varchar(50) NOT NULL DEFAULT '',
  `rank_min` mediumint(8) NOT NULL DEFAULT '0',
  `rank_max` mediumint(8) NOT NULL DEFAULT '0',
  `rank_special` tinyint(1) DEFAULT '0',
  `rank_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`rank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbranks`
--

LOCK TABLES `nuke_bbranks` WRITE;
/*!40000 ALTER TABLE `nuke_bbranks` DISABLE KEYS */;
INSERT INTO `nuke_bbranks` VALUES (1,'Site Admin',-1,-1,1,'modules/Forums/images/ranks/6stars.gif'),(2,'Newbie',1,0,0,'modules/Forums/images/ranks/1star.gif');
/*!40000 ALTER TABLE `nuke_bbranks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbsearch_results`
--

DROP TABLE IF EXISTS `nuke_bbsearch_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbsearch_results` (
  `search_id` int(11) unsigned NOT NULL DEFAULT '0',
  `session_id` varchar(32) NOT NULL DEFAULT '',
  `search_array` text NOT NULL,
  `search_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`search_id`),
  KEY `session_id` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbsearch_results`
--

LOCK TABLES `nuke_bbsearch_results` WRITE;
/*!40000 ALTER TABLE `nuke_bbsearch_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_bbsearch_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbsearch_wordlist`
--

DROP TABLE IF EXISTS `nuke_bbsearch_wordlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbsearch_wordlist` (
  `word_text` varchar(50) NOT NULL DEFAULT '',
  `word_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `word_common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`word_text`),
  KEY `word_id` (`word_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbsearch_wordlist`
--

LOCK TABLES `nuke_bbsearch_wordlist` WRITE;
/*!40000 ALTER TABLE `nuke_bbsearch_wordlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_bbsearch_wordlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbsearch_wordmatch`
--

DROP TABLE IF EXISTS `nuke_bbsearch_wordmatch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbsearch_wordmatch` (
  `post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `word_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `title_match` tinyint(1) NOT NULL DEFAULT '0',
  KEY `word_id` (`word_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbsearch_wordmatch`
--

LOCK TABLES `nuke_bbsearch_wordmatch` WRITE;
/*!40000 ALTER TABLE `nuke_bbsearch_wordmatch` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_bbsearch_wordmatch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbsessions`
--

DROP TABLE IF EXISTS `nuke_bbsessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbsessions` (
  `session_id` char(32) NOT NULL DEFAULT '',
  `session_user_id` mediumint(8) NOT NULL DEFAULT '0',
  `session_start` int(11) NOT NULL DEFAULT '0',
  `session_time` int(11) NOT NULL DEFAULT '0',
  `session_ip` char(8) NOT NULL DEFAULT '0',
  `session_page` int(11) NOT NULL DEFAULT '0',
  `session_logged_in` tinyint(1) NOT NULL DEFAULT '0',
  `session_admin` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`),
  KEY `session_user_id` (`session_user_id`),
  KEY `session_id_ip_user_id` (`session_id`,`session_ip`,`session_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbsessions`
--

LOCK TABLES `nuke_bbsessions` WRITE;
/*!40000 ALTER TABLE `nuke_bbsessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_bbsessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbsmilies`
--

DROP TABLE IF EXISTS `nuke_bbsmilies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbsmilies` (
  `smilies_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `smile_url` varchar(100) DEFAULT NULL,
  `emoticon` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`smilies_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbsmilies`
--

LOCK TABLES `nuke_bbsmilies` WRITE;
/*!40000 ALTER TABLE `nuke_bbsmilies` DISABLE KEYS */;
INSERT INTO `nuke_bbsmilies` VALUES (1,':D','icon_biggrin.gif','Very Happy'),(2,':-D','icon_biggrin.gif','Very Happy'),(3,':grin:','icon_biggrin.gif','Very Happy'),(4,':)','icon_smile.gif','Smile'),(5,':-)','icon_smile.gif','Smile'),(6,':smile:','icon_smile.gif','Smile'),(7,':(','icon_sad.gif','Sad'),(8,':-(','icon_sad.gif','Sad'),(9,':sad:','icon_sad.gif','Sad'),(10,':o','icon_surprised.gif','Surprised'),(11,':-o','icon_surprised.gif','Surprised'),(12,':eek:','icon_surprised.gif','Surprised'),(13,'8O','icon_eek.gif','Shocked'),(14,'8-O','icon_eek.gif','Shocked'),(15,':shock:','icon_eek.gif','Shocked'),(16,':?','icon_confused.gif','Confused'),(17,':-?','icon_confused.gif','Confused'),(18,':???:','icon_confused.gif','Confused'),(19,'8)','icon_cool.gif','Cool'),(20,'8-)','icon_cool.gif','Cool'),(21,':cool:','icon_cool.gif','Cool'),(22,':lol:','icon_lol.gif','Laughing'),(23,':x','icon_mad.gif','Mad'),(24,':-x','icon_mad.gif','Mad'),(25,':mad:','icon_mad.gif','Mad'),(26,':P','icon_razz.gif','Razz'),(27,':-P','icon_razz.gif','Razz'),(28,':razz:','icon_razz.gif','Razz'),(29,':oops:','icon_redface.gif','Embarassed'),(30,':cry:','icon_cry.gif','Crying or Very sad'),(31,':evil:','icon_evil.gif','Evil or Very Mad'),(32,':twisted:','icon_twisted.gif','Twisted Evil'),(33,':roll:','icon_rolleyes.gif','Rolling Eyes'),(34,':wink:','icon_wink.gif','Wink'),(35,';)','icon_wink.gif','Wink'),(36,';-)','icon_wink.gif','Wink'),(37,':!:','icon_exclaim.gif','Exclamation'),(38,':?:','icon_question.gif','Question'),(39,':idea:','icon_idea.gif','Idea'),(40,':arrow:','icon_arrow.gif','Arrow'),(41,':|','icon_neutral.gif','Neutral'),(42,':-|','icon_neutral.gif','Neutral'),(43,':neutral:','icon_neutral.gif','Neutral'),(44,':mrgreen:','icon_mrgreen.gif','Mr. Green');
/*!40000 ALTER TABLE `nuke_bbsmilies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbthemes`
--

DROP TABLE IF EXISTS `nuke_bbthemes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbthemes` (
  `themes_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `template_name` varchar(30) NOT NULL DEFAULT '',
  `style_name` varchar(30) NOT NULL DEFAULT '',
  `head_stylesheet` varchar(100) DEFAULT NULL,
  `body_background` varchar(100) DEFAULT NULL,
  `body_bgcolor` varchar(6) DEFAULT NULL,
  `body_text` varchar(6) DEFAULT NULL,
  `body_link` varchar(6) DEFAULT NULL,
  `body_vlink` varchar(6) DEFAULT NULL,
  `body_alink` varchar(6) DEFAULT NULL,
  `body_hlink` varchar(6) DEFAULT NULL,
  `tr_color1` varchar(6) DEFAULT NULL,
  `tr_color2` varchar(6) DEFAULT NULL,
  `tr_color3` varchar(6) DEFAULT NULL,
  `tr_class1` varchar(25) DEFAULT NULL,
  `tr_class2` varchar(25) DEFAULT NULL,
  `tr_class3` varchar(25) DEFAULT NULL,
  `th_color1` varchar(6) DEFAULT NULL,
  `th_color2` varchar(6) DEFAULT NULL,
  `th_color3` varchar(6) DEFAULT NULL,
  `th_class1` varchar(25) DEFAULT NULL,
  `th_class2` varchar(25) DEFAULT NULL,
  `th_class3` varchar(25) DEFAULT NULL,
  `td_color1` varchar(6) DEFAULT NULL,
  `td_color2` varchar(6) DEFAULT NULL,
  `td_color3` varchar(6) DEFAULT NULL,
  `td_class1` varchar(25) DEFAULT NULL,
  `td_class2` varchar(25) DEFAULT NULL,
  `td_class3` varchar(25) DEFAULT NULL,
  `fontface1` varchar(50) DEFAULT NULL,
  `fontface2` varchar(50) DEFAULT NULL,
  `fontface3` varchar(50) DEFAULT NULL,
  `fontsize1` tinyint(4) DEFAULT NULL,
  `fontsize2` tinyint(4) DEFAULT NULL,
  `fontsize3` tinyint(4) DEFAULT NULL,
  `fontcolor1` varchar(6) DEFAULT NULL,
  `fontcolor2` varchar(6) DEFAULT NULL,
  `fontcolor3` varchar(6) DEFAULT NULL,
  `span_class1` varchar(25) DEFAULT NULL,
  `span_class2` varchar(25) DEFAULT NULL,
  `span_class3` varchar(25) DEFAULT NULL,
  `img_size_poll` smallint(5) unsigned DEFAULT NULL,
  `img_size_privmsg` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`themes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbthemes`
--

LOCK TABLES `nuke_bbthemes` WRITE;
/*!40000 ALTER TABLE `nuke_bbthemes` DISABLE KEYS */;
INSERT INTO `nuke_bbthemes` VALUES (1,'subSilver','subSilver','subSilver.css','','0E3259','000000','006699','5493B4','','DD6900','EFEFEF','DEE3E7','D1D7DC','','','','98AAB1','006699','FFFFFF','cellpic1.gif','cellpic3.gif','cellpic2.jpg','FAFAFA','FFFFFF','','row1','row2','','Verdana, Arial, Helvetica, sans-serif','Trebuchet MS','Courier, \'Courier New\', sans-serif',10,11,12,'444444','006600','FFA34F','','','',NULL,NULL);
/*!40000 ALTER TABLE `nuke_bbthemes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbthemes_name`
--

DROP TABLE IF EXISTS `nuke_bbthemes_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbthemes_name` (
  `themes_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tr_color1_name` char(50) DEFAULT NULL,
  `tr_color2_name` char(50) DEFAULT NULL,
  `tr_color3_name` char(50) DEFAULT NULL,
  `tr_class1_name` char(50) DEFAULT NULL,
  `tr_class2_name` char(50) DEFAULT NULL,
  `tr_class3_name` char(50) DEFAULT NULL,
  `th_color1_name` char(50) DEFAULT NULL,
  `th_color2_name` char(50) DEFAULT NULL,
  `th_color3_name` char(50) DEFAULT NULL,
  `th_class1_name` char(50) DEFAULT NULL,
  `th_class2_name` char(50) DEFAULT NULL,
  `th_class3_name` char(50) DEFAULT NULL,
  `td_color1_name` char(50) DEFAULT NULL,
  `td_color2_name` char(50) DEFAULT NULL,
  `td_color3_name` char(50) DEFAULT NULL,
  `td_class1_name` char(50) DEFAULT NULL,
  `td_class2_name` char(50) DEFAULT NULL,
  `td_class3_name` char(50) DEFAULT NULL,
  `fontface1_name` char(50) DEFAULT NULL,
  `fontface2_name` char(50) DEFAULT NULL,
  `fontface3_name` char(50) DEFAULT NULL,
  `fontsize1_name` char(50) DEFAULT NULL,
  `fontsize2_name` char(50) DEFAULT NULL,
  `fontsize3_name` char(50) DEFAULT NULL,
  `fontcolor1_name` char(50) DEFAULT NULL,
  `fontcolor2_name` char(50) DEFAULT NULL,
  `fontcolor3_name` char(50) DEFAULT NULL,
  `span_class1_name` char(50) DEFAULT NULL,
  `span_class2_name` char(50) DEFAULT NULL,
  `span_class3_name` char(50) DEFAULT NULL,
  PRIMARY KEY (`themes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbthemes_name`
--

LOCK TABLES `nuke_bbthemes_name` WRITE;
/*!40000 ALTER TABLE `nuke_bbthemes_name` DISABLE KEYS */;
INSERT INTO `nuke_bbthemes_name` VALUES (1,'The lightest row colour','The medium row color','The darkest row colour','','','','Border round the whole page','Outer table border','Inner table border','Silver gradient picture','Blue gradient picture','Fade-out gradient on index','Background for quote boxes','All white areas','','Background for topic posts','2nd background for topic posts','','Main fonts','Additional topic title font','Form fonts','Smallest font size','Medium font size','Normal font size (post body etc)','Quote & copyright text','Code text colour','Main table header text colour','','','');
/*!40000 ALTER TABLE `nuke_bbthemes_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbtopics`
--

DROP TABLE IF EXISTS `nuke_bbtopics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbtopics` (
  `topic_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `forum_id` smallint(8) unsigned NOT NULL DEFAULT '0',
  `topic_title` char(60) NOT NULL DEFAULT '',
  `topic_poster` mediumint(8) NOT NULL DEFAULT '0',
  `topic_time` int(11) NOT NULL DEFAULT '0',
  `topic_views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_status` tinyint(3) NOT NULL DEFAULT '0',
  `topic_vote` tinyint(1) NOT NULL DEFAULT '0',
  `topic_type` tinyint(3) NOT NULL DEFAULT '0',
  `topic_last_post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_first_post_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_moved_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`topic_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_moved_id` (`topic_moved_id`),
  KEY `topic_status` (`topic_status`),
  KEY `topic_type` (`topic_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbtopics`
--

LOCK TABLES `nuke_bbtopics` WRITE;
/*!40000 ALTER TABLE `nuke_bbtopics` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_bbtopics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbtopics_watch`
--

DROP TABLE IF EXISTS `nuke_bbtopics_watch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbtopics_watch` (
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `notify_status` tinyint(1) NOT NULL DEFAULT '0',
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  KEY `notify_status` (`notify_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbtopics_watch`
--

LOCK TABLES `nuke_bbtopics_watch` WRITE;
/*!40000 ALTER TABLE `nuke_bbtopics_watch` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_bbtopics_watch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbuser_group`
--

DROP TABLE IF EXISTS `nuke_bbuser_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbuser_group` (
  `group_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_pending` tinyint(1) DEFAULT NULL,
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbuser_group`
--

LOCK TABLES `nuke_bbuser_group` WRITE;
/*!40000 ALTER TABLE `nuke_bbuser_group` DISABLE KEYS */;
INSERT INTO `nuke_bbuser_group` VALUES (1,-1,0),(3,5,0);
/*!40000 ALTER TABLE `nuke_bbuser_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbvote_desc`
--

DROP TABLE IF EXISTS `nuke_bbvote_desc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbvote_desc` (
  `vote_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `vote_text` text NOT NULL,
  `vote_start` int(11) NOT NULL DEFAULT '0',
  `vote_length` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vote_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbvote_desc`
--

LOCK TABLES `nuke_bbvote_desc` WRITE;
/*!40000 ALTER TABLE `nuke_bbvote_desc` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_bbvote_desc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbvote_results`
--

DROP TABLE IF EXISTS `nuke_bbvote_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbvote_results` (
  `vote_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `vote_option_id` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `vote_option_text` varchar(255) NOT NULL DEFAULT '',
  `vote_result` int(11) NOT NULL DEFAULT '0',
  KEY `vote_option_id` (`vote_option_id`),
  KEY `vote_id` (`vote_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbvote_results`
--

LOCK TABLES `nuke_bbvote_results` WRITE;
/*!40000 ALTER TABLE `nuke_bbvote_results` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_bbvote_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbvote_voters`
--

DROP TABLE IF EXISTS `nuke_bbvote_voters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbvote_voters` (
  `vote_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `vote_user_id` mediumint(8) NOT NULL DEFAULT '0',
  `vote_user_ip` char(8) NOT NULL DEFAULT '',
  KEY `vote_id` (`vote_id`),
  KEY `vote_user_id` (`vote_user_id`),
  KEY `vote_user_ip` (`vote_user_ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbvote_voters`
--

LOCK TABLES `nuke_bbvote_voters` WRITE;
/*!40000 ALTER TABLE `nuke_bbvote_voters` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_bbvote_voters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_bbwords`
--

DROP TABLE IF EXISTS `nuke_bbwords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_bbwords` (
  `word_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `word` char(100) NOT NULL DEFAULT '',
  `replacement` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`word_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_bbwords`
--

LOCK TABLES `nuke_bbwords` WRITE;
/*!40000 ALTER TABLE `nuke_bbwords` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_bbwords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_blocks`
--

DROP TABLE IF EXISTS `nuke_blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_blocks` (
  `bid` int(10) NOT NULL AUTO_INCREMENT,
  `bkey` varchar(15) NOT NULL DEFAULT '',
  `title` varchar(60) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `url` varchar(200) NOT NULL DEFAULT '',
  `bposition` char(1) NOT NULL DEFAULT '',
  `weight` int(10) NOT NULL DEFAULT '1',
  `active` int(1) NOT NULL DEFAULT '1',
  `refresh` int(10) NOT NULL DEFAULT '0',
  `time` varchar(14) NOT NULL DEFAULT '0',
  `blanguage` varchar(30) NOT NULL DEFAULT '',
  `blockfile` varchar(255) NOT NULL DEFAULT '',
  `view` int(1) NOT NULL DEFAULT '0',
  `expire` varchar(14) NOT NULL DEFAULT '0',
  `action` char(1) NOT NULL DEFAULT '',
  `subscription` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bid`),
  KEY `bid` (`bid`),
  KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_blocks`
--

LOCK TABLES `nuke_blocks` WRITE;
/*!40000 ALTER TABLE `nuke_blocks` DISABLE KEYS */;
INSERT INTO `nuke_blocks` VALUES (1,'','Modules','','','l',1,1,0,'','','block-Modules.php',0,'0','d',0),(2,'admin','Administration','<strong><big>&middot;</big></strong> <a href=\"admin.php\">Administration</a><br>\r\n<strong><big>&middot;</big></strong> <a href=\"admin.php?op=adminStory\">NEW Story</a><br>\r\n<strong><big>&middot;</big></strong> <a href=\"admin.php?op=create\">Change Survey</a><br>\r\n<strong><big>&middot;</big></strong> <a href=\"admin.php?op=content\">Content</a><br>\r\n<strong><big>&middot;</big></strong> <a href=\"admin.php?op=logout\">Logout</a>','','l',2,1,0,'985591188','','',2,'0','d',0),(3,'','Who\'s Online','','','l',3,1,0,'','','block-Who_is_Online.php',0,'0','d',0),(4,'','Search','','','l',4,0,3600,'','','block-Search.php',0,'0','d',0),(5,'','Languages','','','l',5,1,3600,'','','block-Languages.php',0,'0','d',0),(6,'','Random Headlines','','','l',6,0,3600,'','','block-Random_Headlines.php',0,'0','d',0),(8,'userbox','User\'s Custom Box','','','r',1,1,0,'','','',1,'0','d',0),(9,'','Categories Menu','','','r',2,0,0,'','','block-Categories.php',0,'0','d',0),(10,'','Survey','','','r',3,1,3600,'','','block-Survey.php',0,'0','d',0),(11,'','Login','','','r',4,1,3600,'','','block-Login.php',3,'0','d',0),(12,'','Big Story of Today','','','r',5,1,3600,'','','block-Big_Story_of_Today.php',0,'0','d',0),(13,'','Old Articles','','','r',6,1,3600,'','','block-Old_Articles.php',0,'0','d',0),(14,'','Information','<br><center><font class=\"content\">\r\n<a href=\"http://phpnuke.org\"><img src=\"images/powered/powered8.jpg\" border=\"0\" alt=\"Powered by PHP-Nuke\" title=\"Powered by PHP-Nuke\" width=\"88\" height=\"31\"></a>\r\n<br><br>\r\n<a href=\"http://validator.w3.org/check/referer\"><img src=\"images/html401.gif\" width=\"88\" height=\"31\" alt=\"Valid HTML 4.01!\" title=\"Valid HTML 4.01!\" border=\"0\"></a>\r\n<br><br>\r\n<a href=\"http://jigsaw.w3.org/css-validator\"><img src=\"images/css.gif\" width=\"88\" height=\"31\" alt=\"Valid CSS!\" title=\"Valid CSS!\" border=\"0\"></a></font></center><br>','','r',7,1,0,'','','',0,'0','d',0);
/*!40000 ALTER TABLE `nuke_blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_cities`
--

DROP TABLE IF EXISTS `nuke_cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_cities` (
  `id` mediumint(4) NOT NULL DEFAULT '0',
  `local_id` mediumint(3) NOT NULL DEFAULT '0',
  `city` varchar(65) NOT NULL DEFAULT '',
  `cc` char(2) NOT NULL DEFAULT '',
  `country` varchar(35) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_cities`
--

LOCK TABLES `nuke_cities` WRITE;
/*!40000 ALTER TABLE `nuke_cities` DISABLE KEYS */;
INSERT INTO `nuke_cities` VALUES (1,1,'Asâdâbâd','af','Afghanistan'),(2,2,'Âybak','af','Afghanistan'),(3,3,'Baghlân','af','Afghanistan'),(4,4,'Balkh','af','Afghanistan'),(5,5,'Bâmîyân','af','Afghanistan'),(6,6,'Chaghcharân','af','Afghanistan'),(7,7,'Chârîkâr','af','Afghanistan'),(8,8,'Farâh','af','Afghanistan'),(9,9,'Fayzâbâd','af','Afghanistan'),(10,10,'Ghardez','af','Afghanistan'),(11,11,'Ghazni','af','Afghanistan'),(12,12,'Herât','af','Afghanistan'),(13,13,'Jalâlâbâd','af','Afghanistan'),(14,14,'Kâbul','af','Afghanistan'),(15,15,'Khânâbâd','af','Afghanistan'),(16,16,'Khawst','af','Afghanistan'),(17,17,'Kholm','af','Afghanistan'),(18,18,'Lashkar Gâh','af','Afghanistan'),(19,19,'Mahmûd-e Râqî','af','Afghanistan'),(20,20,'Maydânshahr','af','Afghanistan'),(21,21,'Maymânah','af','Afghanistan'),(22,22,'Mazâr-e Sharîf','af','Afghanistan'),(23,23,'Mehtar Lâm','af','Afghanistan'),(24,24,'Nûristân','af','Afghanistan'),(25,25,'Pol-e Alam','af','Afghanistan'),(26,26,'Pol-e Khumri','af','Afghanistan'),(27,27,'Qal´eh-ye Naw','af','Afghanistan'),(28,28,'Qalât-e Ghilzay','af','Afghanistan'),(29,29,'Qandahâr','af','Afghanistan'),(30,30,'Qundûz','af','Afghanistan'),(31,31,'Sar-e Pul','af','Afghanistan'),(32,32,'Shibarghan','af','Afghanistan'),(33,33,'Tâloqân','af','Afghanistan'),(34,34,'Tarîn Kawt','af','Afghanistan'),(35,35,'Zaranj','af','Afghanistan'),(36,36,'Zareh Sharan','af','Afghanistan'),(37,1,'Bajram Curri','al','Albania'),(38,2,'Ballsh','al','Albania'),(39,3,'Berat','al','Albania'),(40,4,'Bilisht','al','Albania'),(41,5,'Bulqizë','al','Albania'),(42,6,'Burrel','al','Albania'),(43,7,'Çorovodë','al','Albania'),(44,8,'Delvinë','al','Albania'),(45,9,'Durrës','al','Albania'),(46,10,'Elbasan','al','Albania'),(47,11,'Ersekë','al','Albania'),(48,12,'Fier','al','Albania'),(49,13,'Gjirokastër','al','Albania'),(50,14,'Gramsh','al','Albania'),(51,15,'Kavajë','al','Albania'),(52,16,'Koplik','al','Albania'),(53,17,'Korçë','al','Albania'),(54,18,'Krujë','al','Albania'),(55,19,'Krumë','al','Albania'),(56,20,'Kuçovë','al','Albania'),(57,21,'Kukës','al','Albania'),(58,22,'Laç','al','Albania'),(59,23,'Lezhë','al','Albania'),(60,24,'Librazhd','al','Albania'),(61,25,'Lushnjë','al','Albania'),(62,26,'Patos','al','Albania'),(63,27,'Peqin','al','Albania'),(64,28,'Përmet','al','Albania'),(65,29,'Peshkopi','al','Albania'),(66,30,'Pogradec','al','Albania'),(67,31,'Pukë','al','Albania'),(68,32,'Rrëshen','al','Albania'),(69,33,'Sarandë','al','Albania'),(70,34,'Shkodër','al','Albania'),(71,35,'Tepelenë','al','Albania'),(72,36,'Tiranë','al','Albania'),(73,37,'Vlorë','al','Albania'),(74,1,'´Ayn Baydâ','dz','Algeria'),(75,2,'´Ayn Daflah','dz','Algeria'),(76,3,'´Ayn Tamûshanat','dz','Algeria'),(77,4,'Adrâr','dz','Algeria'),(78,5,'al-´Ulmah','dz','Algeria'),(79,6,'al-Aghwât','dz','Algeria'),(80,7,'al-Bayadh','dz','Algeria'),(81,8,'al-Bûnî','dz','Algeria'),(82,9,'al-Jazâ´ir','dz','Algeria'),(83,10,'al-Wâd','dz','Algeria'),(84,11,'Annâbah','dz','Algeria'),(85,12,'ash-Shalif','dz','Algeria'),(86,13,'at-Tarif','dz','Algeria'),(87,14,'Bab Azwâr','dz','Algeria'),(88,15,'Bashshar','dz','Algeria'),(89,16,'Bâtnah','dz','Algeria'),(90,17,'Bijâyah','dz','Algeria'),(91,18,'Biskrah','dz','Algeria'),(92,19,'Blîdah','dz','Algeria'),(93,20,'Bû Sâ´adah','dz','Algeria'),(94,21,'Bûîrah','dz','Algeria'),(95,22,'Bumardas','dz','Algeria'),(96,23,'Burj Bû Arrîrij','dz','Algeria'),(97,24,'Burj-al-Kiffan','dz','Algeria'),(98,25,'Ghâlizân','dz','Algeria'),(99,26,'Ghardâyah','dz','Algeria'),(100,27,'Ilizi','dz','Algeria'),(101,28,'Jîjîlî','dz','Algeria'),(102,29,'Jilfah','dz','Algeria'),(103,30,'Khanshalah','dz','Algeria'),(104,31,'Masîlah','dz','Algeria'),(105,32,'Midyah','dz','Algeria'),(106,33,'Mîlah','dz','Algeria'),(107,34,'Muaskar','dz','Algeria'),(108,35,'Mustaghanam','dz','Algeria'),(109,36,'Naama','dz','Algeria'),(110,37,'Qalmah','dz','Algeria'),(111,38,'Qustantînah','dz','Algeria'),(112,39,'Sakîkdah','dz','Algeria'),(113,40,'Satîf','dz','Algeria'),(114,41,'Saydâ\'','dz','Algeria'),(115,42,'Sîdî ban-al-´Abbas','dz','Algeria'),(116,43,'Sûq Ahrâs','dz','Algeria'),(117,44,'Tamanghâsat','dz','Algeria'),(118,45,'Tibâzah','dz','Algeria'),(119,46,'Tibissah','dz','Algeria'),(120,47,'Tîlîmsân','dz','Algeria'),(121,48,'Tindûf','dz','Algeria'),(122,49,'Tîsamsîlt','dz','Algeria'),(123,50,'Tiyârat','dz','Algeria'),(124,51,'Tîzî Wazû','dz','Algeria'),(125,52,'Umm-al-Bawâghî','dz','Algeria'),(126,53,'Wahrân','dz','Algeria'),(127,54,'Warqlâ','dz','Algeria'),(128,1,'Aoloau','as','American Samoa'),(129,2,'Aua','as','American Samoa'),(130,3,'Faga\'alu','as','American Samoa'),(131,4,'Fagasa','as','American Samoa'),(132,5,'Fagatogo','as','American Samoa'),(133,6,'Faleniu','as','American Samoa'),(134,7,'Futiga','as','American Samoa'),(135,8,'Ili\'ili','as','American Samoa'),(136,9,'Lauli\'i','as','American Samoa'),(137,10,'Leone','as','American Samoa'),(138,11,'Malaeimi','as','American Samoa'),(139,12,'Mapusagafou','as','American Samoa'),(140,13,'Nu\'uuli','as','American Samoa'),(141,14,'Ofu','as','American Samoa'),(142,15,'Pago Pago','as','American Samoa'),(143,16,'Pava\'ia\'i','as','American Samoa'),(144,17,'Swains','as','American Samoa'),(145,18,'Tafuna','as','American Samoa'),(146,19,'Taputimu','as','American Samoa'),(147,20,'Utulei','as','American Samoa'),(148,21,'Vailoatai','as','American Samoa'),(149,22,'Vaitogi','as','American Samoa'),(150,1,'Andorra la Vella','ad','Andorra'),(151,2,'Canillo','ad','Andorra'),(152,3,'Encamp','ad','Andorra'),(153,4,'La Massana','ad','Andorra'),(154,5,'Les Escaldes','ad','Andorra'),(155,6,'Ordino','ad','Andorra'),(156,7,'Sant Julià de Lòria','ad','Andorra'),(157,1,'Benguela','ao','Angola'),(158,2,'Caála','ao','Angola'),(159,3,'Cabinda','ao','Angola'),(160,4,'Caxito','ao','Angola'),(161,5,'Chissamba','ao','Angola'),(162,6,'Huambo','ao','Angola'),(163,7,'Kuito','ao','Angola'),(164,8,'Lobito','ao','Angola'),(165,9,'Luanda','ao','Angola'),(166,10,'Lubango','ao','Angola'),(167,11,'Lucapa','ao','Angola'),(168,12,'Luena','ao','Angola'),(169,13,'Malanje','ao','Angola'),(170,14,'M\'banza-Kongo','ao','Angola'),(171,15,'Menongue','ao','Angola'),(172,16,'Namibe','ao','Angola'),(173,17,'N\'dalatando','ao','Angola'),(174,18,'Ondjiva','ao','Angola'),(175,19,'Saurimo','ao','Angola'),(176,20,'Soyo','ao','Angola'),(177,21,'Sumbe','ao','Angola'),(178,22,'Uíge','ao','Angola'),(179,23,'Waku-Kungo','ao','Angola'),(180,1,'Sandy Ground','ai','Anguilla'),(181,2,'The Valley','ai','Anguilla'),(182,1,'Amundsen-Scott','aq','Antarctica'),(183,2,'Bellingshausen','aq','Antarctica'),(184,3,'Capitán Arturo Prat','aq','Antarctica'),(185,4,'Casey','aq','Antarctica'),(186,5,'Chang Cheng','aq','Antarctica'),(187,6,'Davis','aq','Antarctica'),(188,7,'Dumont d\'Urville','aq','Antarctica'),(189,8,'Escudero','aq','Antarctica'),(190,9,'Esperanza','aq','Antarctica'),(191,10,'General Belgrano II','aq','Antarctica'),(192,11,'General Bernardo O\'Higgins','aq','Antarctica'),(193,12,'MacMurdo','aq','Antarctica'),(194,13,'Maitri','aq','Antarctica'),(195,14,'Mirnyj','aq','Antarctica'),(196,15,'Molodezhnaya','aq','Antarctica'),(197,16,'Novolazarovskaya','aq','Antarctica'),(198,17,'Presidente Eduardo Frei Montalva','aq','Antarctica'),(199,18,'Rothera','aq','Antarctica'),(200,19,'Syowa','aq','Antarctica'),(201,20,'Vicecomodoro Marambio','aq','Antarctica'),(202,1,'All Saints','ag','Antigua & Barbuda'),(203,2,'Bolands','ag','Antigua & Barbuda'),(204,3,'Carlisle','ag','Antigua & Barbuda'),(205,4,'Cedar Grove','ag','Antigua & Barbuda'),(206,5,'Codrington','ag','Antigua & Barbuda'),(207,6,'English Harbour','ag','Antigua & Barbuda'),(208,7,'Falmouth','ag','Antigua & Barbuda'),(209,8,'Freetown','ag','Antigua & Barbuda'),(210,9,'Jennings','ag','Antigua & Barbuda'),(211,10,'Liberta','ag','Antigua & Barbuda'),(212,11,'Old Road','ag','Antigua & Barbuda'),(213,12,'Parham','ag','Antigua & Barbuda'),(214,13,'Saint John\'s','ag','Antigua & Barbuda'),(215,14,'Swetes','ag','Antigua & Barbuda'),(216,15,'Willikies','ag','Antigua & Barbuda'),(217,1,'Bahía Blanca','ar','Argentina'),(218,2,'Buenos Aires','ar','Argentina'),(219,3,'Catamarca','ar','Argentina'),(220,4,'Comodoro Rivadavia','ar','Argentina'),(221,5,'Concordia','ar','Argentina'),(222,6,'Córdoba','ar','Argentina'),(223,7,'Corrientes','ar','Argentina'),(224,8,'Formosa','ar','Argentina'),(225,9,'Jujuy','ar','Argentina'),(226,10,'La Plata','ar','Argentina'),(227,11,'La Rioja','ar','Argentina'),(228,12,'Mar del Plata','ar','Argentina'),(229,13,'Mendoza','ar','Argentina'),(230,14,'Mercedes','ar','Argentina'),(231,15,'Neuquén','ar','Argentina'),(232,16,'Paraná','ar','Argentina'),(233,17,'Posadas','ar','Argentina'),(234,18,'Rawson','ar','Argentina'),(235,19,'Resistencia','ar','Argentina'),(236,20,'Río Cuarto','ar','Argentina'),(237,21,'Río Gallegos','ar','Argentina'),(238,22,'Rosario','ar','Argentina'),(239,23,'Salta','ar','Argentina'),(240,24,'San Carlos de Bariloche','ar','Argentina'),(241,25,'San Juan','ar','Argentina'),(242,26,'San Luis','ar','Argentina'),(243,27,'San Nicolás','ar','Argentina'),(244,28,'San Rafael','ar','Argentina'),(245,29,'Santa Fé','ar','Argentina'),(246,30,'Santa Rosa','ar','Argentina'),(247,31,'Santiago del Estero','ar','Argentina'),(248,32,'Tandil','ar','Argentina'),(249,33,'Trelew','ar','Argentina'),(250,34,'Tucumán','ar','Argentina'),(251,35,'Ushuaia','ar','Argentina'),(252,36,'Viedma','ar','Argentina'),(253,1,'Abovyan','am','Armenia'),(254,2,'Alaverdi','am','Armenia'),(255,3,'Ararat','am','Armenia'),(256,4,'Armavir','am','Armenia'),(257,5,'Artashat','am','Armenia'),(258,6,'Artik','am','Armenia'),(259,7,'Ashtarak','am','Armenia'),(260,8,'Charentsavan','am','Armenia'),(261,9,'Dilijan','am','Armenia'),(262,10,'Gavar','am','Armenia'),(263,11,'Goris','am','Armenia'),(264,12,'Gyumri','am','Armenia'),(265,13,'Hrazdan','am','Armenia'),(266,14,'Ijevan','am','Armenia'),(267,15,'Kapan','am','Armenia'),(268,16,'Sevan','am','Armenia'),(269,17,'Stepanavan','am','Armenia'),(270,18,'Vagharshapat','am','Armenia'),(271,19,'Vanadzor','am','Armenia'),(272,20,'Vardenis','am','Armenia'),(273,21,'Yegheknadzor','am','Armenia'),(274,22,'Yerevan','am','Armenia'),(275,1,'Oranjestad','aw','Aruba'),(276,2,'Sint Nicolas','aw','Aruba'),(277,1,'Adelaide','au','Australia'),(278,2,'Albury-Wodonga','au','Australia'),(279,3,'Ballarat','au','Australia'),(280,4,'Brisbane','au','Australia'),(281,5,'Cairns','au','Australia'),(282,6,'Canberra','au','Australia'),(283,7,'Darwin','au','Australia'),(284,8,'Geelong','au','Australia'),(285,9,'Gold Coast','au','Australia'),(286,10,'Hobart','au','Australia'),(287,11,'Launceston','au','Australia'),(288,12,'Melbourne','au','Australia'),(289,13,'Newcastle','au','Australia'),(290,14,'Perth','au','Australia'),(291,15,'Shoalhaven','au','Australia'),(292,16,'Sunshine Coast','au','Australia'),(293,17,'Sydney','au','Australia'),(294,18,'Toowoomba','au','Australia'),(295,19,'Townsville','au','Australia'),(296,20,'Wollongong','au','Australia'),(297,1,'Baden','at','Austria'),(298,2,'Bregenz','at','Austria'),(299,3,'Dornbirn','at','Austria'),(300,4,'Eisenstadt','at','Austria'),(301,5,'Feldkirch','at','Austria'),(302,6,'Graz','at','Austria'),(303,7,'Innsbruck','at','Austria'),(304,8,'Klagenfurt','at','Austria'),(305,9,'Klosterneuburg','at','Austria'),(306,10,'Krems','at','Austria'),(307,11,'Leoben','at','Austria'),(308,12,'Linz','at','Austria'),(309,13,'Salzburg','at','Austria'),(310,14,'Sankt Pölten','at','Austria'),(311,15,'Steyr','at','Austria'),(312,16,'Traun','at','Austria'),(313,17,'Villach','at','Austria'),(314,18,'Wels','at','Austria'),(315,19,'Wien','at','Austria'),(316,20,'Wiener Neustadt','at','Austria'),(317,21,'Wolfsberg','at','Austria'),(318,1,'Äli Bayramli','az','Azerbaijan'),(319,2,'Bakixanov','az','Azerbaijan'),(320,3,'Baku','az','Azerbaijan'),(321,4,'Bärdä','az','Azerbaijan'),(322,5,'Biläcäri','az','Azerbaijan'),(323,6,'Gäncä','az','Azerbaijan'),(324,7,'Göyçay','az','Azerbaijan'),(325,8,'Hövsan','az','Azerbaijan'),(326,9,'Imisli','az','Azerbaijan'),(327,10,'Kälbäcär','az','Azerbaijan'),(328,11,'Länkäran','az','Azerbaijan'),(329,12,'Mastaga','az','Azerbaijan'),(330,13,'Mingäçevir','az','Azerbaijan'),(331,14,'Naxçivan','az','Azerbaijan'),(332,15,'Qarasuxur','az','Azerbaijan'),(333,16,'Qazax','az','Azerbaijan'),(334,17,'Räsulzadä','az','Azerbaijan'),(335,18,'Säki','az','Azerbaijan'),(336,19,'Salyan','az','Azerbaijan'),(337,20,'Sumqayit','az','Azerbaijan'),(338,21,'Xaçmaz','az','Azerbaijan'),(339,22,'Xankändi','az','Azerbaijan'),(340,23,'Yevlax','az','Azerbaijan'),(341,1,'Alice Town','bs','Bahamas'),(342,2,'Andros Town','bs','Bahamas'),(343,3,'Arthur\'s Town','bs','Bahamas'),(344,4,'Clarence Town','bs','Bahamas'),(345,5,'Cockburn Town','bs','Bahamas'),(346,6,'Colonel Hill','bs','Bahamas'),(347,7,'Coopers Town','bs','Bahamas'),(348,8,'Duncan Town','bs','Bahamas'),(349,9,'Dunmore Town','bs','Bahamas'),(350,10,'Freeport','bs','Bahamas'),(351,11,'Freetown','bs','Bahamas'),(352,12,'George Town','bs','Bahamas'),(353,13,'Great Harbour','bs','Bahamas'),(354,14,'High Rock','bs','Bahamas'),(355,15,'Marsh Harbour','bs','Bahamas'),(356,16,'Matthew Town','bs','Bahamas'),(357,17,'Nassau','bs','Bahamas'),(358,18,'Nicholls Town','bs','Bahamas'),(359,19,'Pirates Well','bs','Bahamas'),(360,20,'Port Nelson','bs','Bahamas'),(361,21,'Rock Sound','bs','Bahamas'),(362,22,'Snug Corner','bs','Bahamas'),(363,23,'Sweeting Cay','bs','Bahamas'),(364,24,'West End','bs','Bahamas'),(365,1,'´Îsâ','bh','Bahrain'),(366,2,'al-Manâmah','bh','Bahrain'),(367,3,'al-Muharraq','bh','Bahrain'),(368,4,'ar-Rifa´a','bh','Bahrain'),(369,5,'Hidd','bh','Bahrain'),(370,6,'Jidd Hafs','bh','Bahrain'),(371,7,'Sitrah','bh','Bahrain'),(372,1,'Bâgar Hât','bd','Bangladesh'),(373,2,'Bândarban','bd','Bangladesh'),(374,3,'Barguna','bd','Bangladesh'),(375,4,'Barîsâl','bd','Bangladesh'),(376,5,'Begamganj','bd','Bangladesh'),(377,6,'Bholâ','bd','Bangladesh'),(378,7,'Bogorâ','bd','Bangladesh'),(379,8,'Brâhman Bâriya','bd','Bangladesh'),(380,9,'Chândpûr','bd','Bangladesh'),(381,10,'Châttagâm','bd','Bangladesh'),(382,11,'Chuâdângâ','bd','Bangladesh'),(383,12,'Dhâka','bd','Bangladesh'),(384,13,'Dinâjpûr','bd','Bangladesh'),(385,14,'Farîdpûr','bd','Bangladesh'),(386,15,'Fenî','bd','Bangladesh'),(387,16,'Gâybândâ','bd','Bangladesh'),(388,17,'Gâzîpûr','bd','Bangladesh'),(389,18,'Gopâlganj','bd','Bangladesh'),(390,19,'Habîganj','bd','Bangladesh'),(391,20,'Jaipûr Hât','bd','Bangladesh'),(392,21,'Jamâlpûr','bd','Bangladesh'),(393,22,'Jessor','bd','Bangladesh'),(394,23,'Jhâlâkâtî','bd','Bangladesh'),(395,24,'Jhanaydâh','bd','Bangladesh'),(396,25,'Khagrachari','bd','Bangladesh'),(397,26,'Khulnâ','bd','Bangladesh'),(398,27,'Kishorganj','bd','Bangladesh'),(399,28,'Koks Bâzâr','bd','Bangladesh'),(400,29,'Komîllâ','bd','Bangladesh'),(401,30,'Kurîgrâm','bd','Bangladesh'),(402,31,'Kushtiyâ','bd','Bangladesh'),(403,32,'Lakshmîpûr','bd','Bangladesh'),(404,33,'Lâlmanîr Hât','bd','Bangladesh'),(405,34,'Madârîpûr','bd','Bangladesh'),(406,35,'Mâgura','bd','Bangladesh'),(407,36,'Maimansingh','bd','Bangladesh'),(408,37,'Mânikganj','bd','Bangladesh'),(409,38,'Maulvi Bâzâr','bd','Bangladesh'),(410,39,'Meherpur','bd','Bangladesh'),(411,40,'Munshiganj','bd','Bangladesh'),(412,41,'Narâl','bd','Bangladesh'),(413,42,'Nârâyanganj','bd','Bangladesh'),(414,43,'Narsingdi','bd','Bangladesh'),(415,44,'Nator','bd','Bangladesh'),(416,45,'Naugâon','bd','Bangladesh'),(417,46,'Nawâbganj','bd','Bangladesh'),(418,47,'Netrâkonâ','bd','Bangladesh'),(419,48,'Nilphâmâri','bd','Bangladesh'),(420,49,'Noâkhâli','bd','Bangladesh'),(421,50,'Pâbna','bd','Bangladesh'),(422,51,'Pâlang','bd','Bangladesh'),(423,52,'Panchagarh','bd','Bangladesh'),(424,53,'Patûâkhâlî','bd','Bangladesh'),(425,54,'Pirojpûr','bd','Bangladesh'),(426,55,'Rajbârî','bd','Bangladesh'),(427,56,'Râjshâhî','bd','Bangladesh'),(428,57,'Rângâmâtî','bd','Bangladesh'),(429,58,'Rangpûr','bd','Bangladesh'),(430,59,'Sa´idpur','bd','Bangladesh'),(431,60,'Sâtkhîrâ','bd','Bangladesh'),(432,61,'Sherpûr','bd','Bangladesh'),(433,62,'Silhat','bd','Bangladesh'),(434,63,'Sirâjganj','bd','Bangladesh'),(435,64,'Sûnâmganj','bd','Bangladesh'),(436,65,'Tangâyal','bd','Bangladesh'),(437,66,'Thâkurgâon','bd','Bangladesh'),(438,67,'Tungî','bd','Bangladesh'),(439,1,'Bathsheba','bb','Barbados'),(440,2,'Blackmans','bb','Barbados'),(441,3,'Bridgetown','bb','Barbados'),(442,4,'Bulkeley','bb','Barbados'),(443,5,'Crab Hill','bb','Barbados'),(444,6,'Crane','bb','Barbados'),(445,7,'Greenland','bb','Barbados'),(446,8,'Hillaby','bb','Barbados'),(447,9,'Holetown','bb','Barbados'),(448,10,'Oistins','bb','Barbados'),(449,11,'Speightstown','bb','Barbados'),(450,1,'Babrujsk','by','Belarus'),(451,2,'Baranavichy','by','Belarus'),(452,3,'Barisaw','by','Belarus'),(453,4,'Brèst','by','Belarus'),(454,5,'Homjel\'','by','Belarus'),(455,6,'Hrodna','by','Belarus'),(456,7,'Lida','by','Belarus'),(457,8,'Mahiljow','by','Belarus'),(458,9,'Maladzechna','by','Belarus'),(459,10,'Mazyr','by','Belarus'),(460,11,'Minsk','by','Belarus'),(461,12,'Navapolack','by','Belarus'),(462,13,'Orsha','by','Belarus'),(463,14,'Pinsk','by','Belarus'),(464,15,'Polack','by','Belarus'),(465,16,'Rèchyca','by','Belarus'),(466,17,'Salihorsk','by','Belarus'),(467,18,'Svetlahorsk','by','Belarus'),(468,19,'Vicebsk','by','Belarus'),(469,20,'Zhlobin','by','Belarus'),(470,1,'Aalst','be','Belgium'),(471,2,'Antwerpen','be','Belgium'),(472,3,'Arlon','be','Belgium'),(473,4,'Brugge','be','Belgium'),(474,5,'Brussel','be','Belgium'),(475,6,'Charleroi','be','Belgium'),(476,7,'Genk','be','Belgium'),(477,8,'Gent','be','Belgium'),(478,9,'Hasselt','be','Belgium'),(479,10,'Kortrijk','be','Belgium'),(480,11,'La Louvière','be','Belgium'),(481,12,'Leuven','be','Belgium'),(482,13,'Liège','be','Belgium'),(483,14,'Mechelen','be','Belgium'),(484,15,'Mons','be','Belgium'),(485,16,'Namur','be','Belgium'),(486,17,'Oostende','be','Belgium'),(487,18,'Roeselare','be','Belgium'),(488,19,'Seraing','be','Belgium'),(489,20,'Sint-Niklaas','be','Belgium'),(490,21,'Tournai','be','Belgium'),(491,22,'Wavre','be','Belgium'),(492,1,'Belize','bz','Belize'),(493,2,'Belmopan','bz','Belize'),(494,3,'Benque Viejo','bz','Belize'),(495,4,'Corozal','bz','Belize'),(496,5,'Dangriga','bz','Belize'),(497,6,'Orange Walk','bz','Belize'),(498,7,'Punta Gorda','bz','Belize'),(499,8,'San Ignacio','bz','Belize'),(500,9,'San Pedro','bz','Belize'),(501,1,'Abomey','bj','Benin'),(502,2,'Bohicon','bj','Benin'),(503,3,'Comé','bj','Benin'),(504,4,'Cotonou','bj','Benin'),(505,5,'Cové','bj','Benin'),(506,6,'Djougou','bj','Benin'),(507,7,'Dogbo','bj','Benin'),(508,8,'Kandi','bj','Benin'),(509,9,'Kouandé','bj','Benin'),(510,10,'Lokossa','bj','Benin'),(511,11,'Malanville','bj','Benin'),(512,12,'Natitingou','bj','Benin'),(513,13,'Nikki','bj','Benin'),(514,14,'Ouidah','bj','Benin'),(515,15,'Parakou','bj','Benin'),(516,16,'Pobé','bj','Benin'),(517,17,'Porto Novo','bj','Benin'),(518,18,'Sakété','bj','Benin'),(519,19,'Savalou','bj','Benin'),(520,20,'Savé','bj','Benin'),(521,1,'Hamilton','bm','Bermuda'),(522,2,'Saint George','bm','Bermuda'),(523,1,'Chhukha','bt','Bhutan'),(524,2,'Damphu','bt','Bhutan'),(525,3,'Gasa','bt','Bhutan'),(526,4,'Geylegphug','bt','Bhutan'),(527,5,'Ha','bt','Bhutan'),(528,6,'Jakar','bt','Bhutan'),(529,7,'Lhuntshi','bt','Bhutan'),(530,8,'Mongar','bt','Bhutan'),(531,9,'Paro','bt','Bhutan'),(532,10,'Pemagatsel','bt','Bhutan'),(533,11,'Phuntsholing','bt','Bhutan'),(534,12,'Punakha','bt','Bhutan'),(535,13,'Samchi','bt','Bhutan'),(536,14,'Samdrup Jongkhar','bt','Bhutan'),(537,15,'Shemgang','bt','Bhutan'),(538,16,'Taga Dzong','bt','Bhutan'),(539,17,'Tashigang','bt','Bhutan'),(540,18,'Timphu','bt','Bhutan'),(541,19,'Tongsa','bt','Bhutan'),(542,20,'Wangdiphodrang','bt','Bhutan'),(543,1,'Bermejo','bo','Bolivia'),(544,2,'Camiri','bo','Bolivia'),(545,3,'Cobija','bo','Bolivia'),(546,4,'Cochabamba','bo','Bolivia'),(547,5,'El Alto','bo','Bolivia'),(548,6,'Guayaramerín','bo','Bolivia'),(549,7,'La Paz','bo','Bolivia'),(550,8,'Llallagua','bo','Bolivia'),(551,9,'Montero','bo','Bolivia'),(552,10,'Oruro','bo','Bolivia'),(553,11,'Potosí','bo','Bolivia'),(554,12,'Riberalta','bo','Bolivia'),(555,13,'San Ignacio','bo','Bolivia'),(556,14,'Santa Cruz','bo','Bolivia'),(557,15,'Sucre','bo','Bolivia'),(558,16,'Tarija','bo','Bolivia'),(559,17,'Trinidad','bo','Bolivia'),(560,18,'Tupiza','bo','Bolivia'),(561,19,'Villazón','bo','Bolivia'),(562,20,'Yacuíba','bo','Bolivia'),(563,1,'Banja Luka','ba','Bosnia-Herzegovina'),(564,2,'Bihac','ba','Bosnia-Herzegovina'),(565,3,'Bijeljina','ba','Bosnia-Herzegovina'),(566,4,'Bosanska Krupa','ba','Bosnia-Herzegovina'),(567,5,'Brchko','ba','Bosnia-Herzegovina'),(568,6,'Bugojno','ba','Bosnia-Herzegovina'),(569,7,'Cazin','ba','Bosnia-Herzegovina'),(570,8,'Doboj','ba','Bosnia-Herzegovina'),(571,9,'Focha','ba','Bosnia-Herzegovina'),(572,10,'Gorazhde','ba','Bosnia-Herzegovina'),(573,11,'Konjic','ba','Bosnia-Herzegovina'),(574,12,'Mostar','ba','Bosnia-Herzegovina'),(575,13,'Prijedor','ba','Bosnia-Herzegovina'),(576,14,'Sarajevo','ba','Bosnia-Herzegovina'),(577,15,'Travnik','ba','Bosnia-Herzegovina'),(578,16,'Trebinje','ba','Bosnia-Herzegovina'),(579,17,'Tuzla','ba','Bosnia-Herzegovina'),(580,18,'Velika Kladusha','ba','Bosnia-Herzegovina'),(581,19,'Visoko','ba','Bosnia-Herzegovina'),(582,20,'Zenica','ba','Bosnia-Herzegovina'),(583,1,'Bobonong','bw','Botswana'),(584,2,'Francistown','bw','Botswana'),(585,3,'Gaborone','bw','Botswana'),(586,4,'Ghanzi','bw','Botswana'),(587,5,'Gumare','bw','Botswana'),(588,6,'Hukuntsi','bw','Botswana'),(589,7,'Jwaneng','bw','Botswana'),(590,8,'Kanye','bw','Botswana'),(591,9,'Kasane','bw','Botswana'),(592,10,'Letlhakane','bw','Botswana'),(593,11,'Lobatse','bw','Botswana'),(594,12,'Mahalapye','bw','Botswana'),(595,13,'Masunga','bw','Botswana'),(596,14,'Maun','bw','Botswana'),(597,15,'Mochudi','bw','Botswana'),(598,16,'Mogoditshane','bw','Botswana'),(599,17,'Molepolole','bw','Botswana'),(600,18,'Moshupa','bw','Botswana'),(601,19,'Orapa','bw','Botswana'),(602,20,'Palapye','bw','Botswana'),(603,21,'Ramotswa','bw','Botswana'),(604,22,'Selibe Phikwe','bw','Botswana'),(605,23,'Serowe','bw','Botswana'),(606,24,'Shakawe','bw','Botswana'),(607,25,'Sowa','bw','Botswana'),(608,26,'Thamaga','bw','Botswana'),(609,27,'Tlokweng','bw','Botswana'),(610,28,'Tonota','bw','Botswana'),(611,29,'Tsabong','bw','Botswana'),(612,30,'Tutume','bw','Botswana'),(613,1,'Águas Lindas de Goiás','br','Brazil'),(614,2,'Alagoinhas','br','Brazil'),(615,3,'Alvorada','br','Brazil'),(616,4,'Americana','br','Brazil'),(617,5,'Ananindeua','br','Brazil'),(618,6,'Anápolis','br','Brazil'),(619,7,'Angra dos Reis','br','Brazil'),(620,8,'Aparecida de Goiânia','br','Brazil'),(621,9,'Apucarana','br','Brazil'),(622,10,'Aracaju','br','Brazil'),(623,11,'Araçatuba','br','Brazil'),(624,12,'Araguaína','br','Brazil'),(625,13,'Arapiraca','br','Brazil'),(626,14,'Araraquara','br','Brazil'),(627,15,'Araras','br','Brazil'),(628,16,'Atibaia','br','Brazil'),(629,17,'Barbacena','br','Brazil'),(630,18,'Barra Mansa','br','Brazil'),(631,19,'Barreiras','br','Brazil'),(632,20,'Barretos','br','Brazil'),(633,21,'Barueri','br','Brazil'),(634,22,'Bauru','br','Brazil'),(635,23,'Belém','br','Brazil'),(636,24,'Belford Roxo','br','Brazil'),(637,25,'Belo Horizonte','br','Brazil'),(638,26,'Betim','br','Brazil'),(639,27,'Blumenau','br','Brazil'),(640,28,'Boa Vista','br','Brazil'),(641,29,'Botucatu','br','Brazil'),(642,30,'Bragança Paulista','br','Brazil'),(643,31,'Brasília','br','Brazil'),(644,32,'Cabo de Santo Agostinho','br','Brazil'),(645,33,'Cabo Frio','br','Brazil'),(646,34,'Cachoeirinha','br','Brazil'),(647,35,'Cachoeiro de Itapemirim','br','Brazil'),(648,36,'Camaçari','br','Brazil'),(649,37,'Camaragibe','br','Brazil'),(650,38,'Campina Grande','br','Brazil'),(651,39,'Campinas','br','Brazil'),(652,40,'Campo Grande','br','Brazil'),(653,41,'Campos','br','Brazil'),(654,42,'Canoas','br','Brazil'),(655,43,'Carapicuíba','br','Brazil'),(656,44,'Cariacica','br','Brazil'),(657,45,'Caruaru','br','Brazil'),(658,46,'Cascavel','br','Brazil'),(659,47,'Castanhal','br','Brazil'),(660,48,'Catanduva','br','Brazil'),(661,49,'Caucaia','br','Brazil'),(662,50,'Caxias','br','Brazil'),(663,51,'Caxias do Sul','br','Brazil'),(664,52,'Chapecó','br','Brazil'),(665,53,'Colombo','br','Brazil'),(666,54,'Conselheiro Lafaiete','br','Brazil'),(667,55,'Contagem','br','Brazil'),(668,56,'Coronel Fabriciano','br','Brazil'),(669,57,'Cotia','br','Brazil'),(670,58,'Criciúma','br','Brazil'),(671,59,'Cubatão','br','Brazil'),(672,60,'Cuiabá','br','Brazil'),(673,61,'Curitiba','br','Brazil'),(674,62,'Diadema','br','Brazil'),(675,63,'Divinópolis','br','Brazil'),(676,64,'Dourados','br','Brazil'),(677,65,'Duque de Caxias','br','Brazil'),(678,66,'Embu','br','Brazil'),(679,67,'Feira de Santana','br','Brazil'),(680,68,'Ferraz de Vasconcelos','br','Brazil'),(681,69,'Florianópolis','br','Brazil'),(682,70,'Fortaleza','br','Brazil'),(683,71,'Foz do Iguaçu','br','Brazil'),(684,72,'Franca','br','Brazil'),(685,73,'Francisco Morato','br','Brazil'),(686,74,'Franco da Rocha','br','Brazil'),(687,75,'Garanhuns','br','Brazil'),(688,76,'Goiânia','br','Brazil'),(689,77,'Governador Valadares','br','Brazil'),(690,78,'Gravataí','br','Brazil'),(691,79,'Guarapuava','br','Brazil'),(692,80,'Guaratinguetá','br','Brazil'),(693,81,'Guarujá','br','Brazil'),(694,82,'Guarulhos','br','Brazil'),(695,83,'Hortolândia','br','Brazil'),(696,84,'Ibirité','br','Brazil'),(697,85,'Ilhéus','br','Brazil'),(698,86,'Imperatriz','br','Brazil'),(699,87,'Indaiatuba','br','Brazil'),(700,88,'Ipatinga','br','Brazil'),(701,89,'Itaboraí','br','Brazil'),(702,90,'Itabuna','br','Brazil'),(703,91,'Itajaí','br','Brazil'),(704,92,'Itapecerica da Serra','br','Brazil'),(705,93,'Itapetininga','br','Brazil'),(706,94,'Itapevi','br','Brazil'),(707,95,'Itaquaquecetuba','br','Brazil'),(708,96,'Itu','br','Brazil'),(709,97,'Jaboatão','br','Brazil'),(710,98,'Jacareí','br','Brazil'),(711,99,'Jandira','br','Brazil'),(712,100,'Jaraguá do Sul','br','Brazil'),(713,101,'Jaú','br','Brazil'),(714,102,'Jequié','br','Brazil'),(715,103,'João Pessoa','br','Brazil'),(716,104,'Joinville','br','Brazil'),(717,105,'Juazeiro','br','Brazil'),(718,106,'Juazeiro do Norte','br','Brazil'),(719,107,'Juiz de Fora','br','Brazil'),(720,108,'Jundiaí','br','Brazil'),(721,109,'Lages','br','Brazil'),(722,110,'Lauro de Freitas','br','Brazil'),(723,111,'Limeira','br','Brazil'),(724,112,'Londrina','br','Brazil'),(725,113,'Luziânia','br','Brazil'),(726,114,'Macaé','br','Brazil'),(727,115,'Macapá','br','Brazil'),(728,116,'Maceió','br','Brazil'),(729,117,'Magé','br','Brazil'),(730,118,'Manaus','br','Brazil'),(731,119,'Marabá','br','Brazil'),(732,120,'Maracanaú','br','Brazil'),(733,121,'Marília','br','Brazil'),(734,122,'Maringá','br','Brazil'),(735,123,'Mauá','br','Brazil'),(736,124,'Mogi Guaçu','br','Brazil'),(737,125,'Moji das Cruzes','br','Brazil'),(738,126,'Montes Claros','br','Brazil'),(739,127,'Mossoró','br','Brazil'),(740,128,'Natal','br','Brazil'),(741,129,'Nilópolis','br','Brazil'),(742,130,'Niterói','br','Brazil'),(743,131,'Nossa Senhora do Socorro','br','Brazil'),(744,132,'Nova Friburgo','br','Brazil'),(745,133,'Nova Iguaçu','br','Brazil'),(746,134,'Novo Hamburgo','br','Brazil'),(747,135,'Olinda','br','Brazil'),(748,136,'Osasco','br','Brazil'),(749,137,'Palhoça','br','Brazil'),(750,138,'Palmas','br','Brazil'),(751,139,'Paranaguá','br','Brazil'),(752,140,'Parnaíba','br','Brazil'),(753,141,'Parnamirim','br','Brazil'),(754,142,'Passo Fundo','br','Brazil'),(755,143,'Patos de Minas','br','Brazil'),(756,144,'Paulista','br','Brazil'),(757,145,'Pelotas','br','Brazil'),(758,146,'Petrolina','br','Brazil'),(759,147,'Petrópolis','br','Brazil'),(760,148,'Pindamonhangaba','br','Brazil'),(761,149,'Pinhais','br','Brazil'),(762,150,'Piracicaba','br','Brazil'),(763,151,'Poá','br','Brazil'),(764,152,'Poços de Caldas','br','Brazil'),(765,153,'Ponta Grossa','br','Brazil'),(766,154,'Porto Alegre','br','Brazil'),(767,155,'Porto Velho','br','Brazil'),(768,156,'Pouso Alegre','br','Brazil'),(769,157,'Praia Grande','br','Brazil'),(770,158,'Presidente Prudente','br','Brazil'),(771,159,'Queimados','br','Brazil'),(772,160,'Recife','br','Brazil'),(773,161,'Resende','br','Brazil'),(774,162,'Ribeirão das Neves','br','Brazil'),(775,163,'Ribeirão Pires','br','Brazil'),(776,164,'Ribeirão Preto','br','Brazil'),(777,165,'Rio Branco','br','Brazil'),(778,166,'Rio Claro','br','Brazil'),(779,167,'Rio de Janeiro','br','Brazil'),(780,168,'Rio Grande','br','Brazil'),(781,169,'Rio Verde','br','Brazil'),(782,170,'Rondonópolis','br','Brazil'),(783,171,'Sabará','br','Brazil'),(784,172,'Salvador','br','Brazil'),(785,173,'Santa Bárbara d\'Oeste','br','Brazil'),(786,174,'Santa Cruz do Sul','br','Brazil'),(787,175,'Santa Luzia','br','Brazil'),(788,176,'Santa Maria','br','Brazil'),(789,177,'Santa Rita','br','Brazil'),(790,178,'Santarém','br','Brazil'),(791,179,'Santo André','br','Brazil'),(792,180,'Santos','br','Brazil'),(793,181,'São Bernardo do Campo','br','Brazil'),(794,182,'São Caetano do Sul','br','Brazil'),(795,183,'São Carlos','br','Brazil'),(796,184,'São Gonçalo','br','Brazil'),(797,185,'São João de Meriti','br','Brazil'),(798,186,'São José','br','Brazil'),(799,187,'São José do Rio Preto','br','Brazil'),(800,188,'São José dos Campos','br','Brazil'),(801,189,'São José dos Pinhais','br','Brazil'),(802,190,'São Leopoldo','br','Brazil'),(803,191,'São Luís','br','Brazil'),(804,192,'São Paulo','br','Brazil'),(805,193,'São Vicente','br','Brazil'),(806,194,'Sapucaia','br','Brazil'),(807,195,'Serra','br','Brazil'),(808,196,'Sete Lagoas','br','Brazil'),(809,197,'Sobral','br','Brazil'),(810,198,'Sorocaba','br','Brazil'),(811,199,'Sumaré','br','Brazil'),(812,200,'Suzano','br','Brazil'),(813,201,'Taboão da Serra','br','Brazil'),(814,202,'Taubaté','br','Brazil'),(815,203,'Teixeira de Freitas','br','Brazil'),(816,204,'Teófilo Otoni','br','Brazil'),(817,205,'Teresina','br','Brazil'),(818,206,'Teresópolis','br','Brazil'),(819,207,'Timon','br','Brazil'),(820,208,'Uberaba','br','Brazil'),(821,209,'Uberlândia','br','Brazil'),(822,210,'Uruguaiana','br','Brazil'),(823,211,'Valparaiso de Goiás','br','Brazil'),(824,212,'Varginha','br','Brazil'),(825,213,'Várzea Grande','br','Brazil'),(826,214,'Várzea Paulista','br','Brazil'),(827,215,'Viamão','br','Brazil'),(828,216,'Vila Velha','br','Brazil'),(829,217,'Vitória','br','Brazil'),(830,218,'Vitória da Conquista','br','Brazil'),(831,219,'Vitória de Santo Antão','br','Brazil'),(832,220,'Volta Redonda','br','Brazil'),(833,1,'East End-Long Look','vg','British Virgin Islands'),(834,2,'Little Harbour','vg','British Virgin Islands'),(835,3,'Road Town','vg','British Virgin Islands'),(836,4,'Settlement','vg','British Virgin Islands'),(837,5,'Spanish Town','vg','British Virgin Islands'),(838,6,'West End','vg','British Virgin Islands'),(839,1,'Bandar Seri Begawan','bn','Brunei'),(840,2,'Bangar','bn','Brunei'),(841,3,'Kuala Belait','bn','Brunei'),(842,4,'Seria','bn','Brunei'),(843,5,'Tutong','bn','Brunei'),(844,1,'Blagoevgrad','bg','Bulgaria'),(845,2,'Burgas','bg','Bulgaria'),(846,3,'Dobrich','bg','Bulgaria'),(847,4,'Gabrovo','bg','Bulgaria'),(848,5,'Haskovo','bg','Bulgaria'),(849,6,'Jambol','bg','Bulgaria'),(850,7,'Kardzhali','bg','Bulgaria'),(851,8,'Kazanlak','bg','Bulgaria'),(852,9,'Kjustendil','bg','Bulgaria'),(853,10,'Lovech','bg','Bulgaria'),(854,11,'Montana','bg','Bulgaria'),(855,12,'Pazardzhik','bg','Bulgaria'),(856,13,'Pernik','bg','Bulgaria'),(857,14,'Pleven','bg','Bulgaria'),(858,15,'Plovdiv','bg','Bulgaria'),(859,16,'Razgrad','bg','Bulgaria'),(860,17,'Ruse','bg','Bulgaria'),(861,18,'Shumen','bg','Bulgaria'),(862,19,'Silistra','bg','Bulgaria'),(863,20,'Sliven','bg','Bulgaria'),(864,21,'Smoljan','bg','Bulgaria'),(865,22,'Sofija','bg','Bulgaria'),(866,23,'Stara Zagora','bg','Bulgaria'),(867,24,'Targovishte','bg','Bulgaria'),(868,25,'Varna','bg','Bulgaria'),(869,26,'Veliko Tarnovo','bg','Bulgaria'),(870,27,'Vidin','bg','Bulgaria'),(871,28,'Vraca','bg','Bulgaria'),(872,1,'Banfora','bf','Burkina Faso'),(873,2,'Batié','bf','Burkina Faso'),(874,3,'Bobo Dioulasso','bf','Burkina Faso'),(875,4,'Bogandé','bf','Burkina Faso'),(876,5,'Boromo','bf','Burkina Faso'),(877,6,'Boulsa','bf','Burkina Faso'),(878,7,'Boussé','bf','Burkina Faso'),(879,8,'Dano','bf','Burkina Faso'),(880,9,'Dédougou','bf','Burkina Faso'),(881,10,'Diapaga','bf','Burkina Faso'),(882,11,'Diébougou','bf','Burkina Faso'),(883,12,'Djibo','bf','Burkina Faso'),(884,13,'Dori','bf','Burkina Faso'),(885,14,'Fada N\'gourma','bf','Burkina Faso'),(886,15,'Gaoua','bf','Burkina Faso'),(887,16,'Gayéri','bf','Burkina Faso'),(888,17,'Gorom-Gorom','bf','Burkina Faso'),(889,18,'Gourcy','bf','Burkina Faso'),(890,19,'Houndé','bf','Burkina Faso'),(891,20,'Kaya','bf','Burkina Faso'),(892,21,'Kombissiri','bf','Burkina Faso'),(893,22,'Kongoussi','bf','Burkina Faso'),(894,23,'Koudougou','bf','Burkina Faso'),(895,24,'Koupéla','bf','Burkina Faso'),(896,25,'Léo','bf','Burkina Faso'),(897,26,'Manga','bf','Burkina Faso'),(898,27,'Nouna','bf','Burkina Faso'),(899,28,'Orodara','bf','Burkina Faso'),(900,29,'Ouagadougou','bf','Burkina Faso'),(901,30,'Ouahigouya','bf','Burkina Faso'),(902,31,'Pama','bf','Burkina Faso'),(903,32,'Pô','bf','Burkina Faso'),(904,33,'Réo','bf','Burkina Faso'),(905,34,'Sindou','bf','Burkina Faso'),(906,35,'Tenkodogo','bf','Burkina Faso'),(907,36,'Tougan','bf','Burkina Faso'),(908,37,'Yako','bf','Burkina Faso'),(909,38,'Ziniaré','bf','Burkina Faso'),(910,39,'Zorgo','bf','Burkina Faso'),(911,1,'Bubanza','bi','Burundi'),(912,2,'Bujumbura','bi','Burundi'),(913,3,'Bururi','bi','Burundi'),(914,4,'Cankuzo','bi','Burundi'),(915,5,'Cibitoke','bi','Burundi'),(916,6,'Gitega','bi','Burundi'),(917,7,'Karuzi','bi','Burundi'),(918,8,'Kayanza','bi','Burundi'),(919,9,'Kirundo','bi','Burundi'),(920,10,'Makamba','bi','Burundi'),(921,11,'Muramvya','bi','Burundi'),(922,12,'Muyinga','bi','Burundi'),(923,13,'Ngozi','bi','Burundi'),(924,14,'Rutana','bi','Burundi'),(925,15,'Ruyigi','bi','Burundi'),(926,1,'Banlung','kh','Cambodia'),(927,2,'Bat Dâmbâng','kh','Cambodia'),(928,3,'Dong Tong','kh','Cambodia'),(929,4,'Kâmpóng Cham','kh','Cambodia'),(930,5,'Kâmpóng Chhnang','kh','Cambodia'),(931,6,'Kâmpóng Spoeu','kh','Cambodia'),(932,7,'Kâmpóng Thum','kh','Cambodia'),(933,8,'Kâmpôt','kh','Cambodia'),(934,9,'Krâchéh','kh','Cambodia'),(935,10,'Krong Kaeb','kh','Cambodia'),(936,11,'Krong Pailin','kh','Cambodia'),(937,12,'Phnum Pénh','kh','Cambodia'),(938,13,'Phumi Sâmraông','kh','Cambodia'),(939,14,'Phumi Takaev','kh','Cambodia'),(940,15,'Pousat','kh','Cambodia'),(941,16,'Preah Sihanouk','kh','Cambodia'),(942,17,'Prey Veaeng','kh','Cambodia'),(943,18,'Senmonorom','kh','Cambodia'),(944,19,'Siem Reab','kh','Cambodia'),(945,20,'Sisophon','kh','Cambodia'),(946,21,'Stueng Traeng','kh','Cambodia'),(947,22,'Svay Rieng','kh','Cambodia'),(948,23,'Ta Khmau','kh','Cambodia'),(949,24,'Tbeng Mean Chey','kh','Cambodia'),(950,1,'Bafang','cm','Cameroon'),(951,2,'Bafoussam','cm','Cameroon'),(952,3,'Bamenda','cm','Cameroon'),(953,4,'Bana','cm','Cameroon'),(954,5,'Bertoua','cm','Cameroon'),(955,6,'Buéa','cm','Cameroon'),(956,7,'Douala','cm','Cameroon'),(957,8,'Ebolowa','cm','Cameroon'),(958,9,'Edéa','cm','Cameroon'),(959,10,'Foumban','cm','Cameroon'),(960,11,'Garoua','cm','Cameroon'),(961,12,'Kaélé','cm','Cameroon'),(962,13,'Kousséri','cm','Cameroon'),(963,14,'Kumba','cm','Cameroon'),(964,15,'Limbe','cm','Cameroon'),(965,16,'Loum','cm','Cameroon'),(966,17,'Maroua','cm','Cameroon'),(967,18,'Mokolo','cm','Cameroon'),(968,19,'Ngaoundéré','cm','Cameroon'),(969,20,'Nkongsamba','cm','Cameroon'),(970,21,'Yaoundé','cm','Cameroon'),(971,1,'Abbotsford','ca','Canada'),(972,2,'Barrie','ca','Canada'),(973,3,'Calgary','ca','Canada'),(974,4,'Charlottetown','ca','Canada'),(975,5,'Chicoutimi-Jonquière','ca','Canada'),(976,6,'Edmonton','ca','Canada'),(977,7,'Fredericton','ca','Canada'),(978,8,'Guelph','ca','Canada'),(979,9,'Halifax','ca','Canada'),(980,10,'Hamilton','ca','Canada'),(981,11,'Iqaluit','ca','Canada'),(982,12,'Kelowna','ca','Canada'),(983,13,'Kingston','ca','Canada'),(984,14,'Kitchener','ca','Canada'),(985,15,'London','ca','Canada'),(986,16,'Montréal','ca','Canada'),(987,17,'Oshawa','ca','Canada'),(988,18,'Ottawa','ca','Canada'),(989,19,'Québec','ca','Canada'),(990,20,'Regina','ca','Canada'),(991,21,'Saint Catharines-Niagara','ca','Canada'),(992,22,'Saint John\'s','ca','Canada'),(993,23,'Saskatoon','ca','Canada'),(994,24,'Sherbrooke','ca','Canada'),(995,25,'Sudbury','ca','Canada'),(996,26,'Thunder Bay','ca','Canada'),(997,27,'Toronto','ca','Canada'),(998,28,'Trois-Rivières','ca','Canada'),(999,29,'Vancouver','ca','Canada'),(1000,30,'Victoria','ca','Canada'),(1001,31,'Whitehorse','ca','Canada'),(1002,32,'Windsor','ca','Canada'),(1003,33,'Winnipeg','ca','Canada'),(1004,34,'Yellowknife','ca','Canada'),(1005,1,'Assomada','cv','Cape Verde'),(1006,2,'Mindelo','cv','Cape Verde'),(1007,3,'Mosteiros','cv','Cape Verde'),(1008,4,'Nova Sintra','cv','Cape Verde'),(1009,5,'Pedra Badejo','cv','Cape Verde'),(1010,6,'Pombas','cv','Cape Verde'),(1011,7,'Ponta do Sol','cv','Cape Verde'),(1012,8,'Porto Novo','cv','Cape Verde'),(1013,9,'Praia','cv','Cape Verde'),(1014,10,'Ribeira Brava','cv','Cape Verde'),(1015,11,'Sal Rei','cv','Cape Verde'),(1016,12,'Santa Maria','cv','Cape Verde'),(1017,13,'São Domingos','cv','Cape Verde'),(1018,14,'São Filipe','cv','Cape Verde'),(1019,15,'São Miguel','cv','Cape Verde'),(1020,16,'Tarrafal','cv','Cape Verde'),(1021,17,'Vila do Maio','cv','Cape Verde'),(1022,1,'Bodden Town','ky','Cayman Islands'),(1023,2,'George Town','ky','Cayman Islands'),(1024,3,'West Bay','ky','Cayman Islands'),(1025,1,'Bambari','cf','Central Africa'),(1026,2,'Bangassou','cf','Central Africa'),(1027,3,'Bangui','cf','Central Africa'),(1028,4,'Batangafo','cf','Central Africa'),(1029,5,'Berbérati','cf','Central Africa'),(1030,6,'Bimbo','cf','Central Africa'),(1031,7,'Birao','cf','Central Africa'),(1032,8,'Boda','cf','Central Africa'),(1033,9,'Bossangoa','cf','Central Africa'),(1034,10,'Bossembélé','cf','Central Africa'),(1035,11,'Bouar','cf','Central Africa'),(1036,12,'Bozoum','cf','Central Africa'),(1037,13,'Bria','cf','Central Africa'),(1038,14,'Carnot','cf','Central Africa'),(1039,15,'Ippy','cf','Central Africa'),(1040,16,'Kaga-Bandoro','cf','Central Africa'),(1041,17,'Mbaiki','cf','Central Africa'),(1042,18,'Mobaye','cf','Central Africa'),(1043,19,'Ndélé','cf','Central Africa'),(1044,20,'Nola','cf','Central Africa'),(1045,21,'Obo','cf','Central Africa'),(1046,22,'Paoua','cf','Central Africa'),(1047,23,'Rafaï','cf','Central Africa'),(1048,24,'Sibut','cf','Central Africa'),(1049,1,'Abéché','td','Chad'),(1050,2,'Am Timan','td','Chad'),(1051,3,'Ati','td','Chad'),(1052,4,'Biltine','td','Chad'),(1053,5,'Bitkine','td','Chad'),(1054,6,'Bol','td','Chad'),(1055,7,'Bongor','td','Chad'),(1056,8,'Doba','td','Chad'),(1057,9,'Dourbali','td','Chad'),(1058,10,'Faya','td','Chad'),(1059,11,'Kélo','td','Chad'),(1060,12,'Koumra','td','Chad'),(1061,13,'Kyabé','td','Chad'),(1062,14,'Laï','td','Chad'),(1063,15,'Léré','td','Chad'),(1064,16,'Mao','td','Chad'),(1065,17,'Massaguet','td','Chad'),(1066,18,'Mongo','td','Chad'),(1067,19,'Moundou','td','Chad'),(1068,20,'N\'Djaména','td','Chad'),(1069,21,'Oum Hadjer','td','Chad'),(1070,22,'Pala','td','Chad'),(1071,23,'Sarh','td','Chad'),(1072,1,'Antofagasta','cl','Chile'),(1073,2,'Arica','cl','Chile'),(1074,3,'Calama','cl','Chile'),(1075,4,'Chillán','cl','Chile'),(1076,5,'Coihaique','cl','Chile'),(1077,6,'Concepción','cl','Chile'),(1078,7,'Copiapó','cl','Chile'),(1079,8,'Coquimbo','cl','Chile'),(1080,9,'Curicó','cl','Chile'),(1081,10,'Iquique','cl','Chile'),(1082,11,'La Serena','cl','Chile'),(1083,12,'Los Ángeles','cl','Chile'),(1084,13,'Osorno','cl','Chile'),(1085,14,'Puente Alto','cl','Chile'),(1086,15,'Puerto Montt','cl','Chile'),(1087,16,'Punta Arenas','cl','Chile'),(1088,17,'Quilpué','cl','Chile'),(1089,18,'Rancagua','cl','Chile'),(1090,19,'San Bernardo','cl','Chile'),(1091,20,'Santiago','cl','Chile'),(1092,21,'Talca','cl','Chile'),(1093,22,'Talcahuano','cl','Chile'),(1094,23,'Temuco','cl','Chile'),(1095,24,'Valdivia','cl','Chile'),(1096,25,'Valparaíso','cl','Chile'),(1097,26,'Viña del Mar','cl','Chile'),(1098,1,'Acheng','cn','China'),(1099,2,'Aksu','cn','China'),(1100,3,'Anbu','cn','China'),(1101,4,'Anda','cn','China'),(1102,5,'Ankang','cn','China'),(1103,6,'Anqing','cn','China'),(1104,7,'Anqiu','cn','China'),(1105,8,'Anshan','cn','China'),(1106,9,'Anshun','cn','China'),(1107,10,'Anyang','cn','China'),(1108,11,'Aomen','cn','China'),(1109,12,'Badaojiang','cn','China'),(1110,13,'Bagongshan','cn','China'),(1111,14,'Baicheng','cn','China'),(1112,15,'Baiyin','cn','China'),(1113,16,'Bantou','cn','China'),(1114,17,'Baoding','cn','China'),(1115,18,'Baoji','cn','China'),(1116,19,'Baoshan','cn','China'),(1117,20,'Baotou','cn','China'),(1118,21,'Beian','cn','China'),(1119,22,'Beibei','cn','China'),(1120,23,'Beihai','cn','China'),(1121,24,'Beijing','cn','China'),(1122,25,'Beipiao','cn','China'),(1123,26,'Bengbu','cn','China'),(1124,27,'Benxi','cn','China'),(1125,28,'Binzhou','cn','China'),(1126,29,'Boli','cn','China'),(1127,30,'Boshan','cn','China'),(1128,31,'Bozhou','cn','China'),(1129,32,'Buhe','cn','China'),(1130,33,'Cangzhou','cn','China'),(1131,34,'Changchun','cn','China'),(1132,35,'Changde','cn','China'),(1133,36,'Changji','cn','China'),(1134,37,'Changsha','cn','China'),(1135,38,'Changzhi','cn','China'),(1136,39,'Changzhou','cn','China'),(1137,40,'Chaohu','cn','China'),(1138,41,'Chaoyang','cn','China'),(1139,42,'Chaozhou','cn','China'),(1140,43,'Chengde','cn','China'),(1141,44,'Chengdu','cn','China'),(1142,45,'Chenghai','cn','China'),(1143,46,'Chengzihe','cn','China'),(1144,47,'Chenzhou','cn','China'),(1145,48,'Chifeng','cn','China'),(1146,49,'Chizhou','cn','China'),(1147,50,'Chongqing','cn','China'),(1148,51,'Chuncheng','cn','China'),(1149,52,'Chuzhou','cn','China'),(1150,53,'Daan','cn','China'),(1151,54,'Daan','cn','China'),(1152,55,'Dachang','cn','China'),(1153,56,'Dali','cn','China'),(1154,57,'Dalian','cn','China'),(1155,58,'Daliang','cn','China'),(1156,59,'Dandong','cn','China'),(1157,60,'Datong','cn','China'),(1158,61,'Dawukou','cn','China'),(1159,62,'Daxian','cn','China'),(1160,63,'Dehui','cn','China'),(1161,64,'Deyang','cn','China'),(1162,65,'Dezhou','cn','China'),(1163,66,'Didao','cn','China'),(1164,67,'Dingshu','cn','China'),(1165,68,'Dingzhou','cn','China'),(1166,69,'Dongchang','cn','China'),(1167,70,'Dongguan','cn','China'),(1168,71,'Donghai','cn','China'),(1169,72,'Donghe','cn','China'),(1170,73,'Dongling','cn','China'),(1171,74,'Dongtai','cn','China'),(1172,75,'Dongying','cn','China'),(1173,76,'Dunhua','cn','China'),(1174,77,'Ezhou','cn','China'),(1175,78,'Fengcheng','cn','China'),(1176,79,'Foshan','cn','China'),(1177,80,'Fuling','cn','China'),(1178,81,'Fushun','cn','China'),(1179,82,'Fuxin','cn','China'),(1180,83,'Fuyang','cn','China'),(1181,84,'Fuyu','cn','China'),(1182,85,'Fuzhou','cn','China'),(1183,86,'Gangdong','cn','China'),(1184,87,'Ganzhou','cn','China'),(1185,88,'Gaomi','cn','China'),(1186,89,'Gaozhou','cn','China'),(1187,90,'Gejiu','cn','China'),(1188,91,'Gongzhuling','cn','China'),(1189,92,'Guangshui','cn','China'),(1190,93,'Guangyuan','cn','China'),(1191,94,'Guangzhou','cn','China'),(1192,95,'Guilin','cn','China'),(1193,96,'Guiqing','cn','China'),(1194,97,'Guiyang','cn','China'),(1195,98,'Haibowan','cn','China'),(1196,99,'Haicheng','cn','China'),(1197,100,'Haikou','cn','China'),(1198,101,'Hailar','cn','China'),(1199,102,'Hailun','cn','China'),(1200,103,'Hami','cn','China'),(1201,104,'Handan','cn','China'),(1202,105,'Hangu','cn','China'),(1203,106,'Hangzhou','cn','China'),(1204,107,'Hanzhong','cn','China'),(1205,108,'Harbin','cn','China'),(1206,109,'Hebi','cn','China'),(1207,110,'Hefei','cn','China'),(1208,111,'Hegang','cn','China'),(1209,112,'Hekou','cn','China'),(1210,113,'Hengshan','cn','China'),(1211,114,'Hengshui','cn','China'),(1212,115,'Hengyang','cn','China'),(1213,116,'Heze','cn','China'),(1214,117,'Hohhot','cn','China'),(1215,118,'Honggang','cn','China'),(1216,119,'Honghu','cn','China'),(1217,120,'Huadian','cn','China'),(1218,121,'Huaibei','cn','China'),(1219,122,'Huaihua','cn','China'),(1220,123,'Huaiyin','cn','China'),(1221,124,'Huanggang','cn','China'),(1222,125,'Huangshi','cn','China'),(1223,126,'Huangyan','cn','China'),(1224,127,'Huangzhou','cn','China'),(1225,128,'Huicheng','cn','China'),(1226,129,'Huizhou','cn','China'),(1227,130,'Hulan','cn','China'),(1228,131,'Hulan Ergi','cn','China'),(1229,132,'Humen','cn','China'),(1230,133,'Huzhou','cn','China'),(1231,134,'Jiagedagi','cn','China'),(1232,135,'Jiamusi','cn','China'),(1233,136,'Jian','cn','China'),(1234,137,'Jiangmen','cn','China'),(1235,138,'Jiangyin','cn','China'),(1236,139,'Jiangyou','cn','China'),(1237,140,'Jiaohe','cn','China'),(1238,141,'Jiaozhou','cn','China'),(1239,142,'Jiaozuo','cn','China'),(1240,143,'Jiaxing','cn','China'),(1241,144,'Jiayuguan','cn','China'),(1242,145,'Jieshi','cn','China'),(1243,146,'Jieshou','cn','China'),(1244,147,'Jilin','cn','China'),(1245,148,'Jinan','cn','China'),(1246,149,'Jinchang','cn','China'),(1247,150,'Jincheng','cn','China'),(1248,151,'Jinchengjiang','cn','China'),(1249,152,'Jingdezhen','cn','China'),(1250,153,'Jingmen','cn','China'),(1251,154,'Jingzhou','cn','China'),(1252,155,'Jinhua','cn','China'),(1253,156,'Jining','cn','China'),(1254,157,'Jining','cn','China'),(1255,158,'Jinma','cn','China'),(1256,159,'Jinsha','cn','China'),(1257,160,'Jinxi','cn','China'),(1258,161,'Jinzhou','cn','China'),(1259,162,'Jinzhou','cn','China'),(1260,163,'Jishu','cn','China'),(1261,164,'Jiujiang','cn','China'),(1262,165,'Jiulong','cn','China'),(1263,166,'Jiupu','cn','China'),(1264,167,'Jiutai','cn','China'),(1265,168,'Jixi','cn','China'),(1266,169,'Kaifeng','cn','China'),(1267,170,'Kaili','cn','China'),(1268,171,'Kaiyuan','cn','China'),(1269,172,'Kaiyuan','cn','China'),(1270,173,'Karamay','cn','China'),(1271,174,'Kashi','cn','China'),(1272,175,'Korla','cn','China'),(1273,176,'Kunming','cn','China'),(1274,177,'Laiwu','cn','China'),(1275,178,'Laiyang','cn','China'),(1276,179,'Langfang','cn','China'),(1277,180,'Lanzhou','cn','China'),(1278,181,'Laohekou','cn','China'),(1279,182,'Lasa','cn','China'),(1280,183,'Leiyang','cn','China'),(1281,184,'Lengshuijiang','cn','China'),(1282,185,'Leshan','cn','China'),(1283,186,'Lianran','cn','China'),(1284,187,'Liaocheng','cn','China'),(1285,188,'Liaoyang','cn','China'),(1286,189,'Liaoyuan','cn','China'),(1287,190,'Licheng','cn','China'),(1288,191,'Linchuan','cn','China'),(1289,192,'Linfen','cn','China'),(1290,193,'Linhai','cn','China'),(1291,194,'Linhe','cn','China'),(1292,195,'Linqing','cn','China'),(1293,196,'Linshui','cn','China'),(1294,197,'Linxi','cn','China'),(1295,198,'Linyi','cn','China'),(1296,199,'Lishui','cn','China'),(1297,200,'Liupanshui','cn','China'),(1298,201,'Liuzhou','cn','China'),(1299,202,'Longfeng','cn','China'),(1300,203,'Longjiang','cn','China'),(1301,204,'Longyan','cn','China'),(1302,205,'Loudi','cn','China'),(1303,206,'Luan','cn','China'),(1304,207,'Luohe','cn','China'),(1305,208,'Luoyang','cn','China'),(1306,209,'Luzhou','cn','China'),(1307,210,'Maanshan','cn','China'),(1308,211,'Macheng','cn','China'),(1309,212,'Majie','cn','China'),(1310,213,'Maoming','cn','China'),(1311,214,'Meihekou','cn','China'),(1312,215,'Meizhou','cn','China'),(1313,216,'Mentougou','cn','China'),(1314,217,'Mianchang','cn','China'),(1315,218,'Mianyang','cn','China'),(1316,219,'Mingshui','cn','China'),(1317,220,'Minhang','cn','China'),(1318,221,'Mudanjiang','cn','China'),(1319,222,'Nancha','cn','China'),(1320,223,'Nanchang','cn','China'),(1321,224,'Nanchong','cn','China'),(1322,225,'Nanjing','cn','China'),(1323,226,'Nanning','cn','China'),(1324,227,'Nanping','cn','China'),(1325,228,'Nantong','cn','China'),(1326,229,'Nantongkuang','cn','China'),(1327,230,'Nanyang','cn','China'),(1328,231,'Nehe','cn','China'),(1329,232,'Neijiang','cn','China'),(1330,233,'Ningbo','cn','China'),(1331,234,'Nongan','cn','China'),(1332,235,'Panjin','cn','China'),(1333,236,'Panzhihua','cn','China'),(1334,237,'Pingdingshan','cn','China'),(1335,238,'Pingliang','cn','China'),(1336,239,'Pingxiang','cn','China'),(1337,240,'Pulandian','cn','China'),(1338,241,'Puqi','cn','China'),(1339,242,'Puyang','cn','China'),(1340,243,'Qianguo','cn','China'),(1341,244,'Qianjiang','cn','China'),(1342,245,'Qincheng','cn','China'),(1343,246,'Qingdao','cn','China'),(1344,247,'Qingyuan','cn','China'),(1345,248,'Qinhuangdao','cn','China'),(1346,249,'Qiqihar','cn','China'),(1347,250,'Qitaihe','cn','China'),(1348,251,'Quanwan','cn','China'),(1349,252,'Quanzhou','cn','China'),(1350,253,'Qujing','cn','China'),(1351,254,'Ranghulu','cn','China'),(1352,255,'Rizhao','cn','China'),(1353,256,'Rongcheng','cn','China'),(1354,257,'Rongcheng','cn','China'),(1355,258,'Ruian','cn','China'),(1356,259,'Saertu','cn','China'),(1357,260,'Saigong','cn','China'),(1358,261,'Sanbu','cn','China'),(1359,262,'Sanmenxia','cn','China'),(1360,263,'Sanming','cn','China'),(1361,264,'Shahe','cn','China'),(1362,265,'Shanghai','cn','China'),(1363,266,'Shangqiu','cn','China'),(1364,267,'Shangrao','cn','China'),(1365,268,'Shantou','cn','China'),(1366,269,'Shanwei','cn','China'),(1367,270,'Shaoguan','cn','China'),(1368,271,'Shaowu','cn','China'),(1369,272,'Shaoxing','cn','China'),(1370,273,'Shaoyang','cn','China'),(1371,274,'Shashi','cn','China'),(1372,275,'Shatin','cn','China'),(1373,276,'Shenjiamen','cn','China'),(1374,277,'Shenyang','cn','China'),(1375,278,'Shenzhen','cn','China'),(1376,279,'Shihezi','cn','China'),(1377,280,'Shijiazhuang','cn','China'),(1378,281,'Shiqiao','cn','China'),(1379,282,'Shishou','cn','China'),(1380,283,'Shiyan','cn','China'),(1381,284,'Shizuishan','cn','China'),(1382,285,'Shuangcheng','cn','China'),(1383,286,'Shuangyashan','cn','China'),(1384,287,'Shuimogou','cn','China'),(1385,288,'Siping','cn','China'),(1386,289,'Songjiang','cn','China'),(1387,290,'Sucheng','cn','China'),(1388,291,'Suihua','cn','China'),(1389,292,'Suining','cn','China'),(1390,293,'Suizhou','cn','China'),(1391,294,'Sujiatun','cn','China'),(1392,295,'Suzhou','cn','China'),(1393,296,'Suzhou','cn','China'),(1394,297,'Taian','cn','China'),(1395,298,'Taicheng','cn','China'),(1396,299,'Taipo','cn','China'),(1397,300,'Taiyuan','cn','China'),(1398,301,'Tanggu','cn','China'),(1399,302,'Tangshan','cn','China'),(1400,303,'Taonan','cn','China'),(1401,304,'Tengzhou','cn','China'),(1402,305,'Tiangjiaan','cn','China'),(1403,306,'Tianjin','cn','China'),(1404,307,'Tianmen','cn','China'),(1405,308,'Tieli','cn','China'),(1406,309,'Tieling','cn','China'),(1407,310,'Tongchuan','cn','China'),(1408,311,'Tongliao','cn','China'),(1409,312,'Tongling','cn','China'),(1410,313,'Tongren','cn','China'),(1411,314,'Tongzhou','cn','China'),(1412,315,'Tuanmun','cn','China'),(1413,316,'Urumqi','cn','China'),(1414,317,'Wafangdian','cn','China'),(1415,318,'Wanxian','cn','China'),(1416,319,'Weifang','cn','China'),(1417,320,'Weihai','cn','China'),(1418,321,'Weinan','cn','China'),(1419,322,'Wencheng','cn','China'),(1420,323,'Wenzhou','cn','China'),(1421,324,'Wuchang','cn','China'),(1422,325,'Wuda','cn','China'),(1423,326,'Wuhan','cn','China'),(1424,327,'Wuhu','cn','China'),(1425,328,'Wulanhaote','cn','China'),(1426,329,'Wuning','cn','China'),(1427,330,'Wuwei','cn','China'),(1428,331,'Wuxi','cn','China'),(1429,332,'Wuxue','cn','China'),(1430,333,'Wuzhou','cn','China'),(1431,334,'Xiamen','cn','China'),(1432,335,'Xian','cn','China'),(1433,336,'Xiangdong','cn','China'),(1434,337,'Xiangfan','cn','China'),(1435,338,'Xianggang','cn','China'),(1436,339,'Xiangtan','cn','China'),(1437,340,'Xianning','cn','China'),(1438,341,'Xiantao','cn','China'),(1439,342,'Xianyang','cn','China'),(1440,343,'Xiaogan','cn','China'),(1441,344,'Xiaolan','cn','China'),(1442,345,'Xichang','cn','China'),(1443,346,'Xiejiaji','cn','China'),(1444,347,'Xilinhaote','cn','China'),(1445,348,'Xinan','cn','China'),(1446,349,'Xincheng','cn','China'),(1447,350,'Xingcheng','cn','China'),(1448,351,'Xingtai','cn','China'),(1449,352,'Xingyi','cn','China'),(1450,353,'Xining','cn','China'),(1451,354,'Xinji','cn','China'),(1452,355,'Xinpu','cn','China'),(1453,356,'Xinshi','cn','China'),(1454,357,'Xintai','cn','China'),(1455,358,'Xinxiang','cn','China'),(1456,359,'Xinyang','cn','China'),(1457,360,'Xinzhou','cn','China'),(1458,361,'Xuanhua','cn','China'),(1459,362,'Xuanzhou','cn','China'),(1460,363,'Xuchang','cn','China'),(1461,364,'Xuzhou','cn','China'),(1462,365,'Yaan','cn','China'),(1463,366,'Yakeshi','cn','China'),(1464,367,'Yanan','cn','China'),(1465,368,'Yancheng','cn','China'),(1466,369,'Yangjiang','cn','China'),(1467,370,'Yangquan','cn','China'),(1468,371,'Yangzhou','cn','China'),(1469,372,'Yanji','cn','China'),(1470,373,'Yantai','cn','China'),(1471,374,'Yibin','cn','China'),(1472,375,'Yichang','cn','China'),(1473,376,'Yichun','cn','China'),(1474,377,'Yichun','cn','China'),(1475,378,'Yidu','cn','China'),(1476,379,'Yinchuan','cn','China'),(1477,380,'Yingcheng','cn','China'),(1478,381,'Yingkou','cn','China'),(1479,382,'Yingzhong','cn','China'),(1480,383,'Yining','cn','China'),(1481,384,'Yiyang','cn','China'),(1482,385,'Yizheng','cn','China'),(1483,386,'Yongan','cn','China'),(1484,387,'Yuanlong','cn','China'),(1485,388,'Yuci','cn','China'),(1486,389,'Yueyang','cn','China'),(1487,390,'Yuhong','cn','China'),(1488,391,'Yulin','cn','China'),(1489,392,'Yuncheng','cn','China'),(1490,393,'Yunyang','cn','China'),(1491,394,'Yushan','cn','China'),(1492,395,'Yushan','cn','China'),(1493,396,'Yushu','cn','China'),(1494,397,'Yuyao','cn','China'),(1495,398,'Zalantun','cn','China'),(1496,399,'Zaoyang','cn','China'),(1497,400,'Zaozhuang','cn','China'),(1498,401,'Zhalainuoer','cn','China'),(1499,402,'Zhangdian','cn','China'),(1500,403,'Zhangjiakou','cn','China'),(1501,404,'Zhangye','cn','China'),(1502,405,'Zhangzhou','cn','China'),(1503,406,'Zhanjiang','cn','China'),(1504,407,'Zhaocheng','cn','China'),(1505,408,'Zhaodong','cn','China'),(1506,409,'Zhaoqing','cn','China'),(1507,410,'Zhaotong','cn','China'),(1508,411,'Zhaoyang','cn','China'),(1509,412,'Zhengzhou','cn','China'),(1510,413,'Zhenjiang','cn','China'),(1511,414,'Zhicheng','cn','China'),(1512,415,'Zhongshan','cn','China'),(1513,416,'Zhoucun','cn','China'),(1514,417,'Zhoukou','cn','China'),(1515,418,'Zhucheng','cn','China'),(1516,419,'Zhuhai','cn','China'),(1517,420,'Zhuji','cn','China'),(1518,421,'Zhumadian','cn','China'),(1519,422,'Zhuozhou','cn','China'),(1520,423,'Zhuzhou','cn','China'),(1521,424,'Zigong','cn','China'),(1522,425,'Zouxian','cn','China'),(1523,426,'Zunyi','cn','China'),(1524,1,'Armenia','co','Colombia'),(1525,2,'Barrancabermeja','co','Colombia'),(1526,3,'Barranquilla','co','Colombia'),(1527,4,'Bello','co','Colombia'),(1528,5,'Bogotá','co','Colombia'),(1529,6,'Bucaramanga','co','Colombia'),(1530,7,'Buenaventura','co','Colombia'),(1531,8,'Buga','co','Colombia'),(1532,9,'Cali','co','Colombia'),(1533,10,'Cartagena','co','Colombia'),(1534,11,'Cartago','co','Colombia'),(1535,12,'Cúcuta','co','Colombia'),(1536,13,'Dos Quebradas','co','Colombia'),(1537,14,'Envigado','co','Colombia'),(1538,15,'Florencia','co','Colombia'),(1539,16,'Floridablanca','co','Colombia'),(1540,17,'Girardot','co','Colombia'),(1541,18,'Girón','co','Colombia'),(1542,19,'Ibagué','co','Colombia'),(1543,20,'Itagüí','co','Colombia'),(1544,21,'Maicao','co','Colombia'),(1545,22,'Manizales','co','Colombia'),(1546,23,'Medellín','co','Colombia'),(1547,24,'Montería','co','Colombia'),(1548,25,'Neiva','co','Colombia'),(1549,26,'Palmira','co','Colombia'),(1550,27,'Pasto','co','Colombia'),(1551,28,'Pereira','co','Colombia'),(1552,29,'Popayán','co','Colombia'),(1553,30,'Santa Marta','co','Colombia'),(1554,31,'Sincelejo','co','Colombia'),(1555,32,'Soacha','co','Colombia'),(1556,33,'Sogamoso','co','Colombia'),(1557,34,'Soledad','co','Colombia'),(1558,35,'Tuluá','co','Colombia'),(1559,36,'Tunja','co','Colombia'),(1560,37,'Valledupar','co','Colombia'),(1561,38,'Villavicencio','co','Colombia'),(1562,1,'Domoni','km','Comoros'),(1563,2,'Fomboni','km','Comoros'),(1564,3,'Mitsamiouli','km','Comoros'),(1565,4,'Moroni','km','Comoros'),(1566,5,'Mutsamudu','km','Comoros'),(1567,1,'Brazzaville','cg','Congo'),(1568,2,'Djambala','cg','Congo'),(1569,3,'Dongou','cg','Congo'),(1570,4,'Ewo','cg','Congo'),(1571,5,'Gamboma','cg','Congo'),(1572,6,'Impfondo','cg','Congo'),(1573,7,'Kinkala','cg','Congo'),(1574,8,'Loandjili','cg','Congo'),(1575,9,'Loubomo','cg','Congo'),(1576,10,'Madingou','cg','Congo'),(1577,11,'Makoua','cg','Congo'),(1578,12,'Matsanga','cg','Congo'),(1579,13,'Mossaka','cg','Congo'),(1580,14,'Mossendjo','cg','Congo'),(1581,15,'Ngamaba-Mfilou','cg','Congo'),(1582,16,'Nkayi','cg','Congo'),(1583,17,'Ouesso','cg','Congo'),(1584,18,'Owando','cg','Congo'),(1585,19,'Pointe Noire','cg','Congo'),(1586,20,'Sibiti','cg','Congo'),(1587,1,'Bandundu','cd','Congo (Dem. Rep.)'),(1588,2,'Beni','cd','Congo (Dem. Rep.)'),(1589,3,'Boma','cd','Congo (Dem. Rep.)'),(1590,4,'Bukavu','cd','Congo (Dem. Rep.)'),(1591,5,'Bunia','cd','Congo (Dem. Rep.)'),(1592,6,'Butembo','cd','Congo (Dem. Rep.)'),(1593,7,'Gemena','cd','Congo (Dem. Rep.)'),(1594,8,'Goma','cd','Congo (Dem. Rep.)'),(1595,9,'Ilebo','cd','Congo (Dem. Rep.)'),(1596,10,'Isiro','cd','Congo (Dem. Rep.)'),(1597,11,'Kalemie','cd','Congo (Dem. Rep.)'),(1598,12,'Kananga','cd','Congo (Dem. Rep.)'),(1599,13,'Kikwit','cd','Congo (Dem. Rep.)'),(1600,14,'Kindu','cd','Congo (Dem. Rep.)'),(1601,15,'Kinshasa','cd','Congo (Dem. Rep.)'),(1602,16,'Kisangani','cd','Congo (Dem. Rep.)'),(1603,17,'Kolwezi','cd','Congo (Dem. Rep.)'),(1604,18,'Likasi','cd','Congo (Dem. Rep.)'),(1605,19,'Lubumbashi','cd','Congo (Dem. Rep.)'),(1606,20,'Matadi','cd','Congo (Dem. Rep.)'),(1607,21,'Mbandaka','cd','Congo (Dem. Rep.)'),(1608,22,'Mbuji-Mayi','cd','Congo (Dem. Rep.)'),(1609,23,'Mwene-Ditu','cd','Congo (Dem. Rep.)'),(1610,24,'Tshikapa','cd','Congo (Dem. Rep.)'),(1611,25,'Uvira','cd','Congo (Dem. Rep.)'),(1612,1,'Amuri','ck','Cook Islands'),(1613,2,'Atiu','ck','Cook Islands'),(1614,3,'Avarua','ck','Cook Islands'),(1615,4,'Mangaia','ck','Cook Islands'),(1616,5,'Mauke','ck','Cook Islands'),(1617,6,'Mitiaro','ck','Cook Islands'),(1618,7,'Nassau','ck','Cook Islands'),(1619,8,'Omoka','ck','Cook Islands'),(1620,9,'Rakahanga','ck','Cook Islands'),(1621,10,'Roto','ck','Cook Islands'),(1622,11,'Tauhunu','ck','Cook Islands'),(1623,1,'Aguacaliente','cr','Costa Rica'),(1624,2,'Alajuela','cr','Costa Rica'),(1625,3,'Cartago','cr','Costa Rica'),(1626,4,'Curridabat','cr','Costa Rica'),(1627,5,'Desamparados','cr','Costa Rica'),(1628,6,'Heredia','cr','Costa Rica'),(1629,7,'Ipís','cr','Costa Rica'),(1630,8,'Liberia','cr','Costa Rica'),(1631,9,'Limón','cr','Costa Rica'),(1632,10,'Paraíso','cr','Costa Rica'),(1633,11,'Puntarenas','cr','Costa Rica'),(1634,12,'Purral','cr','Costa Rica'),(1635,13,'San Francisco','cr','Costa Rica'),(1636,14,'San Isidro','cr','Costa Rica'),(1637,15,'San José','cr','Costa Rica'),(1638,16,'San José','cr','Costa Rica'),(1639,17,'San Juan','cr','Costa Rica'),(1640,18,'San Miguel','cr','Costa Rica'),(1641,19,'San Pedro','cr','Costa Rica'),(1642,20,'San Vicente','cr','Costa Rica'),(1643,21,'Turrialba','cr','Costa Rica'),(1644,1,'Bjelovar','hr','Croatia'),(1645,2,'Chakovec','hr','Croatia'),(1646,3,'Dhakovo','hr','Croatia'),(1647,4,'Dubrovnik','hr','Croatia'),(1648,5,'Gospic','hr','Croatia'),(1649,6,'Karlovac','hr','Croatia'),(1650,7,'Koprivnica','hr','Croatia'),(1651,8,'Krapina','hr','Croatia'),(1652,9,'Osijek','hr','Croatia'),(1653,10,'Pozhega','hr','Croatia'),(1654,11,'Pula','hr','Croatia'),(1655,12,'Rijeka','hr','Croatia'),(1656,13,'Sesvete','hr','Croatia'),(1657,14,'Shibenik','hr','Croatia'),(1658,15,'Sisak','hr','Croatia'),(1659,16,'Slavonski Brod','hr','Croatia'),(1660,17,'Split','hr','Croatia'),(1661,18,'Varazhdin','hr','Croatia'),(1662,19,'Velika Gorica','hr','Croatia'),(1663,20,'Vinkovci','hr','Croatia'),(1664,21,'Virovitica','hr','Croatia'),(1665,22,'Vukovar','hr','Croatia'),(1666,23,'Zadar','hr','Croatia'),(1667,24,'Zagreb','hr','Croatia'),(1668,1,'Bayamo','cu','Cuba'),(1669,2,'Camagüey','cu','Cuba'),(1670,3,'Cárdenas','cu','Cuba'),(1671,4,'Ciego de Ávila','cu','Cuba'),(1672,5,'Cienfuegos','cu','Cuba'),(1673,6,'Consolación del Sur','cu','Cuba'),(1674,7,'Contramaestre','cu','Cuba'),(1675,8,'Guantánamo','cu','Cuba'),(1676,9,'Holguín','cu','Cuba'),(1677,10,'La Habana','cu','Cuba'),(1678,11,'Las Tunas','cu','Cuba'),(1679,12,'Manzanillo','cu','Cuba'),(1680,13,'Matanzas','cu','Cuba'),(1681,14,'Mayarí','cu','Cuba'),(1682,15,'Nueva Gerona','cu','Cuba'),(1683,16,'Palma Soriano','cu','Cuba'),(1684,17,'Pinar del Rio','cu','Cuba'),(1685,18,'Puerto Padre','cu','Cuba'),(1686,19,'Sancti Spíritus','cu','Cuba'),(1687,20,'Santa Clara','cu','Cuba'),(1688,21,'Santiago de Cuba','cu','Cuba'),(1689,1,'Aradippou','cy','Cyprus'),(1690,2,'Dali','cy','Cyprus'),(1691,3,'Deryneia','cy','Cyprus'),(1692,4,'Dipkarpaz','cy','Cyprus'),(1693,5,'Dromolaxia','cy','Cyprus'),(1694,6,'Gazimagusa','cy','Cyprus'),(1695,7,'Geri','cy','Cyprus'),(1696,8,'Girne','cy','Cyprus'),(1697,9,'Güzelyurt','cy','Cyprus'),(1698,10,'Larnaka','cy','Cyprus'),(1699,11,'Lefka','cy','Cyprus'),(1700,12,'Lefkosa','cy','Cyprus'),(1701,13,'Lefkosia','cy','Cyprus'),(1702,14,'Lemesos','cy','Cyprus'),(1703,15,'Livadia','cy','Cyprus'),(1704,16,'Pafos','cy','Cyprus'),(1705,17,'Paralimni','cy','Cyprus'),(1706,18,'Tseri','cy','Cyprus'),(1707,19,'Xylofagou','cy','Cyprus'),(1708,20,'Ypsonas','cy','Cyprus'),(1709,1,'Brno','cz','Czech Republic'),(1710,2,'Cheské Budejovice','cz','Czech Republic'),(1711,3,'Chomutov','cz','Czech Republic'),(1712,4,'Dechín','cz','Czech Republic'),(1713,5,'Frýdek-Místek','cz','Czech Republic'),(1714,6,'Havírov','cz','Czech Republic'),(1715,7,'Hradec Králové','cz','Czech Republic'),(1716,8,'Jihlava','cz','Czech Republic'),(1717,9,'Karlovy Vary','cz','Czech Republic'),(1718,10,'Karviná','cz','Czech Republic'),(1719,11,'Kladno','cz','Czech Republic'),(1720,12,'Liberec','cz','Czech Republic'),(1721,13,'Most','cz','Czech Republic'),(1722,14,'Olomouc','cz','Czech Republic'),(1723,15,'Opava','cz','Czech Republic'),(1724,16,'Ostrava','cz','Czech Republic'),(1725,17,'Pardubice','cz','Czech Republic'),(1726,18,'Plzen','cz','Czech Republic'),(1727,19,'Praha','cz','Czech Republic'),(1728,20,'Ústí','cz','Czech Republic'),(1729,21,'Zlín','cz','Czech Republic'),(1730,1,'Aabenraa','dk','Denmark'),(1731,2,'Aalborg','dk','Denmark'),(1732,3,'Århus','dk','Denmark'),(1733,4,'Esbjerg','dk','Denmark'),(1734,5,'Fredericia','dk','Denmark'),(1735,6,'Greve Strand','dk','Denmark'),(1736,7,'Helsingør','dk','Denmark'),(1737,8,'Hillerød','dk','Denmark'),(1738,9,'Holstebro','dk','Denmark'),(1739,10,'Horsens','dk','Denmark'),(1740,11,'Hørsholm','dk','Denmark'),(1741,12,'København','dk','Denmark'),(1742,13,'Køge','dk','Denmark'),(1743,14,'Kolding','dk','Denmark'),(1744,15,'Næstved','dk','Denmark'),(1745,16,'Nykøbing','dk','Denmark'),(1746,17,'Odense','dk','Denmark'),(1747,18,'Randers','dk','Denmark'),(1748,19,'Ribe','dk','Denmark'),(1749,20,'Ringkøbing','dk','Denmark'),(1750,21,'Rønne','dk','Denmark'),(1751,22,'Roskilde','dk','Denmark'),(1752,23,'Silkeborg','dk','Denmark'),(1753,24,'Slagelse','dk','Denmark'),(1754,25,'Sorø','dk','Denmark'),(1755,26,'Vejle','dk','Denmark'),(1756,27,'Viborg','dk','Denmark'),(1757,1,'´Ali Sabîh','dj','Djibouti'),(1758,2,'Dikhil','dj','Djibouti'),(1759,3,'Jibûti','dj','Djibouti'),(1760,4,'Tajûrah','dj','Djibouti'),(1761,5,'Ubuk','dj','Djibouti'),(1762,1,'Atkinson','dm','Dominica'),(1763,2,'Barroui','dm','Dominica'),(1764,3,'Berekua','dm','Dominica'),(1765,4,'Castle Bruce','dm','Dominica'),(1766,5,'Coulihaut','dm','Dominica'),(1767,6,'Délices','dm','Dominica'),(1768,7,'Hampstead','dm','Dominica'),(1769,8,'La Plaine','dm','Dominica'),(1770,9,'Mahaut','dm','Dominica'),(1771,10,'Marigot','dm','Dominica'),(1772,11,'Petite Soufrière','dm','Dominica'),(1773,12,'Pointe Michel','dm','Dominica'),(1774,13,'Pont Cassé','dm','Dominica'),(1775,14,'Portsmouth','dm','Dominica'),(1776,15,'Rosalie','dm','Dominica'),(1777,16,'Roseau','dm','Dominica'),(1778,17,'Saint Joseph','dm','Dominica'),(1779,18,'Soufrière','dm','Dominica'),(1780,19,'Vieille Case','dm','Dominica'),(1781,20,'Wesley','dm','Dominica'),(1782,1,'Azua','do','Dominican Republic'),(1783,2,'Bajos de Haina','do','Dominican Republic'),(1784,3,'Baní','do','Dominican Republic'),(1785,4,'Barahona','do','Dominican Republic'),(1786,5,'Bonao','do','Dominican Republic'),(1787,6,'Comendador','do','Dominican Republic'),(1788,7,'Cotuí','do','Dominican Republic'),(1789,8,'Dajabón','do','Dominican Republic'),(1790,9,'El Seybo','do','Dominican Republic'),(1791,10,'Esperanza','do','Dominican Republic'),(1792,11,'Hato Mayor','do','Dominican Republic'),(1793,12,'Higüey','do','Dominican Republic'),(1794,13,'Jimaní','do','Dominican Republic'),(1795,14,'La Romana','do','Dominican Republic'),(1796,15,'La Vega','do','Dominican Republic'),(1797,16,'Mao','do','Dominican Republic'),(1798,17,'Moca','do','Dominican Republic'),(1799,18,'Monte Cristi','do','Dominican Republic'),(1800,19,'Monte Plata','do','Dominican Republic'),(1801,20,'Nagua','do','Dominican Republic'),(1802,21,'Neyba','do','Dominican Republic'),(1803,22,'Pedernales','do','Dominican Republic'),(1804,23,'Puerto Plata','do','Dominican Republic'),(1805,24,'Sabaneta','do','Dominican Republic'),(1806,25,'Salcedo','do','Dominican Republic'),(1807,26,'Samaná','do','Dominican Republic'),(1808,27,'San Cristóbal','do','Dominican Republic'),(1809,28,'San Francisco de Macorís','do','Dominican Republic'),(1810,29,'San Juan de la Maguana','do','Dominican Republic'),(1811,30,'San Pedro de Macorís','do','Dominican Republic'),(1812,31,'Santiago','do','Dominican Republic'),(1813,32,'Santo Domingo','do','Dominican Republic'),(1814,33,'Villa Altagracia','do','Dominican Republic'),(1815,1,'Aileu','tp','East Timor'),(1816,2,'Ainaro','tp','East Timor'),(1817,3,'Aubá','tp','East Timor'),(1818,4,'Baucau','tp','East Timor'),(1819,5,'Bazartete','tp','East Timor'),(1820,6,'Dare','tp','East Timor'),(1821,7,'Dili','tp','East Timor'),(1822,8,'Ermera','tp','East Timor'),(1823,9,'Lautem','tp','East Timor'),(1824,10,'Liquiça','tp','East Timor'),(1825,11,'Lolotoi','tp','East Timor'),(1826,12,'Los Palos','tp','East Timor'),(1827,13,'Maliana','tp','East Timor'),(1828,14,'Manatuto','tp','East Timor'),(1829,15,'Metinaro','tp','East Timor'),(1830,16,'Pante Macassar','tp','East Timor'),(1831,17,'Same','tp','East Timor'),(1832,18,'Suai','tp','East Timor'),(1833,19,'Viqueque','tp','East Timor'),(1834,1,'Ambato','ec','Ecuador'),(1835,2,'Azogues','ec','Ecuador'),(1836,3,'Babahoyo','ec','Ecuador'),(1837,4,'Cuenca','ec','Ecuador'),(1838,5,'Eloy Alfaro','ec','Ecuador'),(1839,6,'Esmeraldas','ec','Ecuador'),(1840,7,'Guaranda','ec','Ecuador'),(1841,8,'Guayaquil','ec','Ecuador'),(1842,9,'Ibarra','ec','Ecuador'),(1843,10,'La Libertad','ec','Ecuador'),(1844,11,'Latacunga','ec','Ecuador'),(1845,12,'Loja','ec','Ecuador'),(1846,13,'Macas','ec','Ecuador'),(1847,14,'Machala','ec','Ecuador'),(1848,15,'Manta','ec','Ecuador'),(1849,16,'Milagro','ec','Ecuador'),(1850,17,'Nueva Loja','ec','Ecuador'),(1851,18,'Orellana','ec','Ecuador'),(1852,19,'Pasaje','ec','Ecuador'),(1853,20,'Portoviejo','ec','Ecuador'),(1854,21,'Puerto Baquerizo Moreno','ec','Ecuador'),(1855,22,'Puyo','ec','Ecuador'),(1856,23,'Quevedo','ec','Ecuador'),(1857,24,'Quito','ec','Ecuador'),(1858,25,'Riobamba','ec','Ecuador'),(1859,26,'Santo Domingo','ec','Ecuador'),(1860,27,'Tena','ec','Ecuador'),(1861,28,'Tulcán','ec','Ecuador'),(1862,29,'Zamora','ec','Ecuador'),(1863,1,'al-´Arîsh','eg','Egypt'),(1864,2,'al-Fayyûm','eg','Egypt'),(1865,3,'al-Ghardaqah','eg','Egypt'),(1866,4,'al-Hawâmidîyah','eg','Egypt'),(1867,5,'al-Iskandarîyah','eg','Egypt'),(1868,6,'al-Ismâîlîyah','eg','Egypt'),(1869,7,'al-Jîzah','eg','Egypt'),(1870,8,'al-Khârijah','eg','Egypt'),(1871,9,'al-Mahallah al-Kubrâ','eg','Egypt'),(1872,10,'al-Mansûrah','eg','Egypt'),(1873,11,'al-Matarîyah','eg','Egypt'),(1874,12,'al-Minyâ','eg','Egypt'),(1875,13,'al-Qahira','eg','Egypt'),(1876,14,'al-Uqsur','eg','Egypt'),(1877,15,'as-Suways','eg','Egypt'),(1878,16,'Aswân','eg','Egypt'),(1879,17,'Asyût','eg','Egypt'),(1880,18,'at-Tûr','eg','Egypt'),(1881,19,'az-Zaqâzîq','eg','Egypt'),(1882,20,'Banhâ','eg','Egypt'),(1883,21,'Banî Suwayf','eg','Egypt'),(1884,22,'Bilbays','eg','Egypt'),(1885,23,'Bilqâs','eg','Egypt'),(1886,24,'Bûr Sa´îd','eg','Egypt'),(1887,25,'Damanhûr','eg','Egypt'),(1888,26,'Disûq','eg','Egypt'),(1889,27,'Dumyât','eg','Egypt'),(1890,28,'Idfû','eg','Egypt'),(1891,29,'Idkû','eg','Egypt'),(1892,30,'Jirjâ','eg','Egypt'),(1893,31,'Kafr-ad-Dawwâr','eg','Egypt'),(1894,32,'Kafr-ash-Shaykh','eg','Egypt'),(1895,33,'Mallawî','eg','Egypt'),(1896,34,'Marsâ Matrûh','eg','Egypt'),(1897,35,'Mît Gamr','eg','Egypt'),(1898,36,'Qalyûb','eg','Egypt'),(1899,37,'Qinâ','eg','Egypt'),(1900,38,'Sawhâj','eg','Egypt'),(1901,39,'Shibîn-al-Kawm','eg','Egypt'),(1902,40,'Shubrâ al-Khaymah','eg','Egypt'),(1903,41,'Talkhâ','eg','Egypt'),(1904,42,'Tantâ','eg','Egypt'),(1905,1,'Ahuachapán','sv','El Salvador'),(1906,2,'Antiguo Cuscatlán','sv','El Salvador'),(1907,3,'Apopa','sv','El Salvador'),(1908,4,'Chalatenango','sv','El Salvador'),(1909,5,'Cojutepeque','sv','El Salvador'),(1910,6,'Cuscatancingo','sv','El Salvador'),(1911,7,'Delgado','sv','El Salvador'),(1912,8,'Gotera','sv','El Salvador'),(1913,9,'Ilopango','sv','El Salvador'),(1914,10,'La Unión','sv','El Salvador'),(1915,11,'Mejicanos','sv','El Salvador'),(1916,12,'Nueva San Salvador','sv','El Salvador'),(1917,13,'Quezaltepeque','sv','El Salvador'),(1918,14,'San Marcos','sv','El Salvador'),(1919,15,'San Martín','sv','El Salvador'),(1920,16,'San Miguel','sv','El Salvador'),(1921,17,'San Salvador','sv','El Salvador'),(1922,18,'San Vicente','sv','El Salvador'),(1923,19,'Santa Ana','sv','El Salvador'),(1924,20,'Sensuntepeque','sv','El Salvador'),(1925,21,'Sonsonate','sv','El Salvador'),(1926,22,'Soyapango','sv','El Salvador'),(1927,23,'Usulután','sv','El Salvador'),(1928,24,'Zacatecoluca','sv','El Salvador'),(1929,1,'Aconibe','gq','Equatorial Guinea'),(1930,2,'Acurenam','gq','Equatorial Guinea'),(1931,3,'Añisoc','gq','Equatorial Guinea'),(1932,4,'Bata','gq','Equatorial Guinea'),(1933,5,'Ebebiyin','gq','Equatorial Guinea'),(1934,6,'Evinayong','gq','Equatorial Guinea'),(1935,7,'Luba','gq','Equatorial Guinea'),(1936,8,'Malabo','gq','Equatorial Guinea'),(1937,9,'Mbini','gq','Equatorial Guinea'),(1938,10,'Mikomeseng','gq','Equatorial Guinea'),(1939,11,'Moca','gq','Equatorial Guinea'),(1940,12,'Mongomo','gq','Equatorial Guinea'),(1941,13,'Niefang','gq','Equatorial Guinea'),(1942,14,'Nsok','gq','Equatorial Guinea'),(1943,15,'Palé','gq','Equatorial Guinea'),(1944,16,'Riaba','gq','Equatorial Guinea'),(1945,1,'Âddî K\'eyih','er','Eritrea'),(1946,2,'Âddî Kwala','er','Eritrea'),(1947,3,'Âddî Ugrî','er','Eritrea'),(1948,4,'Âk\'ordat','er','Eritrea'),(1949,5,'Âsmara','er','Eritrea'),(1950,6,'Âsseb','er','Eritrea'),(1951,7,'Barentu','er','Eritrea'),(1952,8,'Bêylul','er','Eritrea'),(1953,9,'Dek\'emhâre','er','Eritrea'),(1954,10,'Êdd','er','Eritrea'),(1955,11,'Gînda','er','Eritrea'),(1956,12,'Himbirtî','er','Eritrea'),(1957,13,'Keren','er','Eritrea'),(1958,14,'Mersa Fatma','er','Eritrea'),(1959,15,'Mitsiwa','er','Eritrea'),(1960,16,'Nefasît','er','Eritrea'),(1961,17,'Sen\'afê','er','Eritrea'),(1962,18,'Teseney','er','Eritrea'),(1963,1,'Elva','ee','Estonia'),(1964,2,'Haapsalu','ee','Estonia'),(1965,3,'Jôgeva','ee','Estonia'),(1966,4,'Jôhvi','ee','Estonia'),(1967,5,'Kärdla','ee','Estonia'),(1968,6,'Keila','ee','Estonia'),(1969,7,'Kiviôli','ee','Estonia'),(1970,8,'Kohtla-Järve','ee','Estonia'),(1971,9,'Kuressaare','ee','Estonia'),(1972,10,'Maardu','ee','Estonia'),(1973,11,'Narva','ee','Estonia'),(1974,12,'Paide','ee','Estonia'),(1975,13,'Pärnu','ee','Estonia'),(1976,14,'Pôlva','ee','Estonia'),(1977,15,'Rakvere','ee','Estonia'),(1978,16,'Rapla','ee','Estonia'),(1979,17,'Sillamäe','ee','Estonia'),(1980,18,'Tallinn','ee','Estonia'),(1981,19,'Tapa','ee','Estonia'),(1982,20,'Tartu','ee','Estonia'),(1983,21,'Valga','ee','Estonia'),(1984,22,'Viljandi','ee','Estonia'),(1985,23,'Vôru','ee','Estonia'),(1986,1,'Âddîgrat','et','Ethiopia'),(1987,2,'Âddîs Âbebâ','et','Ethiopia'),(1988,3,'Ârba Minch','et','Ethiopia'),(1989,4,'Asayita','et','Ethiopia'),(1990,5,'Âsosa','et','Ethiopia'),(1991,6,'Âssela','et','Ethiopia'),(1992,7,'Âwassa','et','Ethiopia'),(1993,8,'Bahir Dar','et','Ethiopia'),(1994,9,'Debre Birhan','et','Ethiopia'),(1995,10,'Debre Mark\'os','et','Ethiopia'),(1996,11,'Debre Zeyit','et','Ethiopia'),(1997,12,'Desê','et','Ethiopia'),(1998,13,'Dirê Dawa','et','Ethiopia'),(1999,14,'Gambêla','et','Ethiopia'),(2000,15,'Gondar','et','Ethiopia'),(2001,16,'Harer','et','Ethiopia'),(2002,17,'Jijiga','et','Ethiopia'),(2003,18,'Jîmma','et','Ethiopia'),(2004,19,'Kembolcha','et','Ethiopia'),(2005,20,'Mek\'elê','et','Ethiopia'),(2006,21,'Nazrêt','et','Ethiopia'),(2007,22,'Nek\'emtê','et','Ethiopia'),(2008,23,'Shashemennê','et','Ethiopia'),(2009,24,'Soddo','et','Ethiopia'),(2010,1,'Bantam','xa','Ext. Territ. of Australia'),(2011,2,'The Settlement','xa','Ext. Territ. of Australia'),(2012,3,'West Island','xa','Ext. Territ. of Australia'),(2013,4,'Willis Island Meteorological Station','xa','Ext. Territ. of Australia'),(2014,1,'Goose Green','fk','Falkland Islands'),(2015,2,'Grytviken','fk','Falkland Islands'),(2016,3,'Port Howard','fk','Falkland Islands'),(2017,4,'Port Stanley','fk','Falkland Islands'),(2018,1,'Eiði','fo','Faroe Islands'),(2019,2,'Fuglafjarð','fo','Faroe Islands'),(2020,3,'Gøta','fo','Faroe Islands'),(2021,4,'Húsavík','fo','Faroe Islands'),(2022,5,'Hvalbi','fo','Faroe Islands'),(2023,6,'Klaksvík','fo','Faroe Islands'),(2024,7,'Kollafjarð','fo','Faroe Islands'),(2025,8,'Kvívík','fo','Faroe Islands'),(2026,9,'Leirvík','fo','Faroe Islands'),(2027,10,'Midvágs','fo','Faroe Islands'),(2028,11,'Nes','fo','Faroe Islands'),(2029,12,'Runavík','fo','Faroe Islands'),(2030,13,'Sandavágs','fo','Faroe Islands'),(2031,14,'Sands','fo','Faroe Islands'),(2032,15,'Sjó','fo','Faroe Islands'),(2033,16,'Skála','fo','Faroe Islands'),(2034,17,'Sørvags','fo','Faroe Islands'),(2035,18,'Tórshavn','fo','Faroe Islands'),(2036,19,'Tvøroyri','fo','Faroe Islands'),(2037,20,'Vágs','fo','Faroe Islands'),(2038,21,'Vestmanna','fo','Faroe Islands'),(2039,1,'Ba','fj','Fiji'),(2040,2,'Deuba','fj','Fiji'),(2041,3,'Korokade','fj','Fiji'),(2042,4,'Korovou','fj','Fiji'),(2043,5,'Labasa','fj','Fiji'),(2044,6,'Lami','fj','Fiji'),(2045,7,'Lautoka','fj','Fiji'),(2046,8,'Levuka','fj','Fiji'),(2047,9,'Nadi','fj','Fiji'),(2048,10,'Nausori','fj','Fiji'),(2049,11,'Navouvalu','fj','Fiji'),(2050,12,'Navua','fj','Fiji'),(2051,13,'Rakiraki','fj','Fiji'),(2052,14,'Savusavu','fj','Fiji'),(2053,15,'Seaqaqa','fj','Fiji'),(2054,16,'Sigatoka','fj','Fiji'),(2055,17,'Suva','fj','Fiji'),(2056,18,'Tavua','fj','Fiji'),(2057,19,'Tubou','fj','Fiji'),(2058,20,'Vatukoula','fj','Fiji'),(2059,1,'Espoo','fi','Finland'),(2060,2,'Hämeenlinna','fi','Finland'),(2061,3,'Helsinki','fi','Finland'),(2062,4,'Hyvinkää','fi','Finland'),(2063,5,'Järvenpää','fi','Finland'),(2064,6,'Joensuu','fi','Finland'),(2065,7,'Jyväskylä','fi','Finland'),(2066,8,'Kajaani','fi','Finland'),(2067,9,'Kokkola','fi','Finland'),(2068,10,'Kotka','fi','Finland'),(2069,11,'Kouvola','fi','Finland'),(2070,12,'Kuopio','fi','Finland'),(2071,13,'Lahti','fi','Finland'),(2072,14,'Lappeenranta','fi','Finland'),(2073,15,'Lohja','fi','Finland'),(2074,16,'Maarianhamina','fi','Finland'),(2075,17,'Mikkeli','fi','Finland'),(2076,18,'Nurmijärvi','fi','Finland'),(2077,19,'Oulu','fi','Finland'),(2078,20,'Pori','fi','Finland'),(2079,21,'Porvoo','fi','Finland'),(2080,22,'Rovaniemi','fi','Finland'),(2081,23,'Seinäjoki','fi','Finland'),(2082,24,'Tampere','fi','Finland'),(2083,25,'Turku','fi','Finland'),(2084,26,'Vaasa','fi','Finland'),(2085,27,'Vantaa','fi','Finland'),(2086,1,'Agen','fr','France'),(2087,2,'Aix-en-Provence','fr','France'),(2088,3,'Ajaccio','fr','France'),(2089,4,'Albi','fr','France'),(2090,5,'Alençon','fr','France'),(2091,6,'Amiens','fr','France'),(2092,7,'Angers','fr','France'),(2093,8,'Angoulême','fr','France'),(2094,9,'Annecy','fr','France'),(2095,10,'Arras','fr','France'),(2096,11,'Auch','fr','France'),(2097,12,'Aurillac','fr','France'),(2098,13,'Auxerre','fr','France'),(2099,14,'Avignon','fr','France'),(2100,15,'Bar-le-Duc','fr','France'),(2101,16,'Bastia','fr','France'),(2102,17,'Beauvais','fr','France'),(2103,18,'Belfort','fr','France'),(2104,19,'Besançon','fr','France'),(2105,20,'Blois','fr','France'),(2106,21,'Bobigny','fr','France'),(2107,22,'Bordeaux','fr','France'),(2108,23,'Boulogne-Billancourt','fr','France'),(2109,24,'Bourg-en-Bresse','fr','France'),(2110,25,'Bourges','fr','France'),(2111,26,'Brest','fr','France'),(2112,27,'Caen','fr','France'),(2113,28,'Cahors','fr','France'),(2114,29,'Carcassonne','fr','France'),(2115,30,'Châlons-en-Champagne','fr','France'),(2116,31,'Chambéry','fr','France'),(2117,32,'Charleville-Mézières','fr','France'),(2118,33,'Chartres','fr','France'),(2119,34,'Châteauroux','fr','France'),(2120,35,'Chaumont','fr','France'),(2121,36,'Clermont-Ferrand','fr','France'),(2122,37,'Colmar','fr','France'),(2123,38,'Créteil','fr','France'),(2124,39,'Digne-les-Bains','fr','France'),(2125,40,'Dijon','fr','France'),(2126,41,'Épinal','fr','France'),(2127,42,'Évreux','fr','France'),(2128,43,'Évry','fr','France'),(2129,44,'Foix','fr','France'),(2130,45,'Gap','fr','France'),(2131,46,'Grenoble','fr','France'),(2132,47,'Guéret','fr','France'),(2133,48,'La Rochelle','fr','France'),(2134,49,'La Roche-sur-Yon','fr','France'),(2135,50,'Laon','fr','France'),(2136,51,'Laval','fr','France'),(2137,52,'Le Havre','fr','France'),(2138,53,'Le Mans','fr','France'),(2139,54,'Le Puy-en-Velay','fr','France'),(2140,55,'Lille','fr','France'),(2141,56,'Limoges','fr','France'),(2142,57,'Lons-le-Saunier','fr','France'),(2143,58,'Lyon','fr','France'),(2144,59,'Mâcon','fr','France'),(2145,60,'Marseille','fr','France'),(2146,61,'Melun','fr','France'),(2147,62,'Mende','fr','France'),(2148,63,'Metz','fr','France'),(2149,64,'Montauban','fr','France'),(2150,65,'Mont-de-Marsan','fr','France'),(2151,66,'Montpellier','fr','France'),(2152,67,'Moulins','fr','France'),(2153,68,'Mulhouse','fr','France'),(2154,69,'Nancy','fr','France'),(2155,70,'Nanterre','fr','France'),(2156,71,'Nantes','fr','France'),(2157,72,'Nevers','fr','France'),(2158,73,'Nice','fr','France'),(2159,74,'Nîmes','fr','France'),(2160,75,'Niort','fr','France'),(2161,76,'Orléans','fr','France'),(2162,77,'Paris','fr','France'),(2163,78,'Pau','fr','France'),(2164,79,'Périgueux','fr','France'),(2165,80,'Perpignan','fr','France'),(2166,81,'Poitiers','fr','France'),(2167,82,'Pontoise','fr','France'),(2168,83,'Privas','fr','France'),(2169,84,'Quimper','fr','France'),(2170,85,'Reims','fr','France'),(2171,86,'Rennes','fr','France'),(2172,87,'Rodez','fr','France'),(2173,88,'Rouen','fr','France'),(2174,89,'Saint-Brieuc','fr','France'),(2175,90,'Saint-Étienne','fr','France'),(2176,91,'Saint-Lô','fr','France'),(2177,92,'Strasbourg','fr','France'),(2178,93,'Tarbes','fr','France'),(2179,94,'Toulon','fr','France'),(2180,95,'Toulouse','fr','France'),(2181,96,'Tours','fr','France'),(2182,97,'Troyes','fr','France'),(2183,98,'Tulle','fr','France'),(2184,99,'Valence','fr','France'),(2185,100,'Vannes','fr','France'),(2186,101,'Versailles','fr','France'),(2187,102,'Vesoul','fr','France'),(2188,103,'Villeurbanne','fr','France'),(2189,1,'Apatou','gf','French Guiana'),(2190,2,'Awala-Yalimapo','gf','French Guiana'),(2191,3,'Camopi','gf','French Guiana'),(2192,4,'Cayenne','gf','French Guiana'),(2193,5,'Grand-Santi','gf','French Guiana'),(2194,6,'Iracoubo','gf','French Guiana'),(2195,7,'Kourou','gf','French Guiana'),(2196,8,'Macouria','gf','French Guiana'),(2197,9,'Mana','gf','French Guiana'),(2198,10,'Maripasoula','gf','French Guiana'),(2199,11,'Matoury','gf','French Guiana'),(2200,12,'Remire-Montjoly','gf','French Guiana'),(2201,13,'Roura','gf','French Guiana'),(2202,14,'Saint-Georges','gf','French Guiana'),(2203,15,'Saint-Laurent-du-Maroni','gf','French Guiana'),(2204,16,'Sinnamary','gf','French Guiana'),(2205,1,'Afaahiti','pf','French Polynesia'),(2206,2,'Afareaitu','pf','French Polynesia'),(2207,3,'Arue','pf','French Polynesia'),(2208,4,'Avera','pf','French Polynesia'),(2209,5,'Faaa','pf','French Polynesia'),(2210,6,'Haapiti','pf','French Polynesia'),(2211,7,'Mahina','pf','French Polynesia'),(2212,8,'Mataiea','pf','French Polynesia'),(2213,9,'Mataura','pf','French Polynesia'),(2214,10,'Paea','pf','French Polynesia'),(2215,11,'Paopao','pf','French Polynesia'),(2216,12,'Papara','pf','French Polynesia'),(2217,13,'Papeari','pf','French Polynesia'),(2218,14,'Papeete','pf','French Polynesia'),(2219,15,'Papenoo','pf','French Polynesia'),(2220,16,'Pirae','pf','French Polynesia'),(2221,17,'Punaauia','pf','French Polynesia'),(2222,18,'Rikitea','pf','French Polynesia'),(2223,19,'Taiohae','pf','French Polynesia'),(2224,20,'Tautira','pf','French Polynesia'),(2225,21,'Tiarei','pf','French Polynesia'),(2226,22,'Uturoa','pf','French Polynesia'),(2227,23,'Vaitape','pf','French Polynesia'),(2228,1,'Bitam','ga','Gabon'),(2229,2,'Booué','ga','Gabon'),(2230,3,'Gamba','ga','Gabon'),(2231,4,'Koulamoutou','ga','Gabon'),(2232,5,'Lambaréné','ga','Gabon'),(2233,6,'Lastoursville','ga','Gabon'),(2234,7,'Libreville','ga','Gabon'),(2235,8,'Makokou','ga','Gabon'),(2236,9,'Masuku','ga','Gabon'),(2237,10,'Moanda','ga','Gabon'),(2238,11,'Mouila','ga','Gabon'),(2239,12,'Mounana','ga','Gabon'),(2240,13,'Ndendé','ga','Gabon'),(2241,14,'Nkan','ga','Gabon'),(2242,15,'Ntoum','ga','Gabon'),(2243,16,'Okandja','ga','Gabon'),(2244,17,'Oyem','ga','Gabon'),(2245,18,'Port-Gentil','ga','Gabon'),(2246,19,'Tchibanga','ga','Gabon'),(2247,20,'Tsogni','ga','Gabon'),(2248,1,'Bakau','gm','Gambia'),(2249,2,'Banjul','gm','Gambia'),(2250,3,'Bansang','gm','Gambia'),(2251,4,'Barra','gm','Gambia'),(2252,5,'Basse','gm','Gambia'),(2253,6,'Brikama','gm','Gambia'),(2254,7,'Brufut','gm','Gambia'),(2255,8,'Essau','gm','Gambia'),(2256,9,'Farafenni','gm','Gambia'),(2257,10,'Gambissara','gm','Gambia'),(2258,11,'Gunjur','gm','Gambia'),(2259,12,'Janjanbureh','gm','Gambia'),(2260,13,'Kerewan','gm','Gambia'),(2261,14,'Kuntaur','gm','Gambia'),(2262,15,'Lamin','gm','Gambia'),(2263,16,'Mansakonko','gm','Gambia'),(2264,17,'Sabi','gm','Gambia'),(2265,18,'Salikeni','gm','Gambia'),(2266,19,'Serekunda','gm','Gambia'),(2267,20,'Sukuta','gm','Gambia'),(2268,1,'Ahalcihe','ge','Georgia'),(2269,2,'Ambrolauri','ge','Georgia'),(2270,3,'Batumi','ge','Georgia'),(2271,4,'Chaltubo','ge','Georgia'),(2272,5,'Chiatura','ge','Georgia'),(2273,6,'Chinvali','ge','Georgia'),(2274,7,'Gagra','ge','Georgia'),(2275,8,'Gori','ge','Georgia'),(2276,9,'Hashuri','ge','Georgia'),(2277,10,'Kutaisi','ge','Georgia'),(2278,11,'Marneuli','ge','Georgia'),(2279,12,'Mcheta','ge','Georgia'),(2280,13,'Ozurgeti','ge','Georgia'),(2281,14,'Poti','ge','Georgia'),(2282,15,'Rustavi','ge','Georgia'),(2283,16,'Samtredia','ge','Georgia'),(2284,17,'Senaki','ge','Georgia'),(2285,18,'Suhumi','ge','Georgia'),(2286,19,'Tbilisi','ge','Georgia'),(2287,20,'Telavi','ge','Georgia'),(2288,21,'Tkibuli','ge','Georgia'),(2289,22,'Zestaponi','ge','Georgia'),(2290,23,'Zugdidi','ge','Georgia'),(2291,1,'Aachen','de','Germany'),(2292,2,'Augsburg','de','Germany'),(2293,3,'Bergisch Gladbach','de','Germany'),(2294,4,'Berlin','de','Germany'),(2295,5,'Bielefeld','de','Germany'),(2296,6,'Bochum','de','Germany'),(2297,7,'Bonn','de','Germany'),(2298,8,'Bottrop','de','Germany'),(2299,9,'Braunschweig','de','Germany'),(2300,10,'Bremen','de','Germany'),(2301,11,'Bremerhaven','de','Germany'),(2302,12,'Chemnitz','de','Germany'),(2303,13,'Cottbus','de','Germany'),(2304,14,'Darmstadt','de','Germany'),(2305,15,'Dortmund','de','Germany'),(2306,16,'Dresden','de','Germany'),(2307,17,'Duisburg','de','Germany'),(2308,18,'Düsseldorf','de','Germany'),(2309,19,'Erfurt','de','Germany'),(2310,20,'Erlangen','de','Germany'),(2311,21,'Essen','de','Germany'),(2312,22,'Frankfurt','de','Germany'),(2313,23,'Freiburg','de','Germany'),(2314,24,'Fürth','de','Germany'),(2315,25,'Gelsenkirchen','de','Germany'),(2316,26,'Gera','de','Germany'),(2317,27,'Göttingen','de','Germany'),(2318,28,'Hagen','de','Germany'),(2319,29,'Halle','de','Germany'),(2320,30,'Hamburg','de','Germany'),(2321,31,'Hamm','de','Germany'),(2322,32,'Hannover','de','Germany'),(2323,33,'Heidelberg','de','Germany'),(2324,34,'Heilbronn','de','Germany'),(2325,35,'Herne','de','Germany'),(2326,36,'Hildesheim','de','Germany'),(2327,37,'Ingolstadt','de','Germany'),(2328,38,'Karlsruhe','de','Germany'),(2329,39,'Kassel','de','Germany'),(2330,40,'Kiel','de','Germany'),(2331,41,'Koblenz','de','Germany'),(2332,42,'Köln','de','Germany'),(2333,43,'Krefeld','de','Germany'),(2334,44,'Leipzig','de','Germany'),(2335,45,'Leverkusen','de','Germany'),(2336,46,'Ludwigshafen','de','Germany'),(2337,47,'Lübeck','de','Germany'),(2338,48,'Magdeburg','de','Germany'),(2339,49,'Mainz','de','Germany'),(2340,50,'Mannheim','de','Germany'),(2341,51,'Moers','de','Germany'),(2342,52,'Mönchengladbach','de','Germany'),(2343,53,'Mülheim','de','Germany'),(2344,54,'München','de','Germany'),(2345,55,'Münster','de','Germany'),(2346,56,'Neuss','de','Germany'),(2347,57,'Nürnberg','de','Germany'),(2348,58,'Oberhausen','de','Germany'),(2349,59,'Offenbach','de','Germany'),(2350,60,'Oldenburg','de','Germany'),(2351,61,'Osnabrück','de','Germany'),(2352,62,'Paderborn','de','Germany'),(2353,63,'Pforzheim','de','Germany'),(2354,64,'Potsdam','de','Germany'),(2355,65,'Recklinghausen','de','Germany'),(2356,66,'Regensburg','de','Germany'),(2357,67,'Remscheid','de','Germany'),(2358,68,'Reutlingen','de','Germany'),(2359,69,'Rostock','de','Germany'),(2360,70,'Saarbrücken','de','Germany'),(2361,71,'Salzgitter','de','Germany'),(2362,72,'Schwerin','de','Germany'),(2363,73,'Siegen','de','Germany'),(2364,74,'Solingen','de','Germany'),(2365,75,'Stuttgart','de','Germany'),(2366,76,'Ulm','de','Germany'),(2367,77,'Wiesbaden','de','Germany'),(2368,78,'Witten','de','Germany'),(2369,79,'Wolfsburg','de','Germany'),(2370,80,'Wuppertal','de','Germany'),(2371,81,'Würzburg','de','Germany'),(2372,82,'Zwickau','de','Germany'),(2373,1,'Accra','gh','Ghana'),(2374,2,'Ashiaman','gh','Ghana'),(2375,3,'Bawku','gh','Ghana'),(2376,4,'Bolgatanga','gh','Ghana'),(2377,5,'Cape Coast','gh','Ghana'),(2378,6,'Ho','gh','Ghana'),(2379,7,'Koforidua','gh','Ghana'),(2380,8,'Kumasi','gh','Ghana'),(2381,9,'Nkawkaw','gh','Ghana'),(2382,10,'Obuasi','gh','Ghana'),(2383,11,'Sekondi','gh','Ghana'),(2384,12,'Sunyani','gh','Ghana'),(2385,13,'Swedru','gh','Ghana'),(2386,14,'Takoradi','gh','Ghana'),(2387,15,'Tamale','gh','Ghana'),(2388,16,'Tema','gh','Ghana'),(2389,17,'Tema New Town','gh','Ghana'),(2390,18,'Teshie','gh','Ghana'),(2391,19,'Wa','gh','Ghana'),(2392,20,'Yendi','gh','Ghana'),(2393,1,'Gibraltar','gi','Gibraltar'),(2394,1,'Aharna','gr','Greece'),(2395,2,'Aiyáleo','gr','Greece'),(2396,3,'Alexandroúpoli','gr','Greece'),(2397,4,'Ámfissa','gr','Greece'),(2398,5,'Argostólion','gr','Greece'),(2399,6,'Árta','gr','Greece'),(2400,7,'Athína','gr','Greece'),(2401,8,'Áyios Nikólaos','gr','Greece'),(2402,9,'Dráma','gr','Greece'),(2403,10,'Édessa','gr','Greece'),(2404,11,'Ermoúpoli','gr','Greece'),(2405,12,'Flórina','gr','Greece'),(2406,13,'Glifáda','gr','Greece'),(2407,14,'Grevená','gr','Greece'),(2408,15,'Halándrion','gr','Greece'),(2409,16,'Halkída','gr','Greece'),(2410,17,'Haniá','gr','Greece'),(2411,18,'Híos','gr','Greece'),(2412,19,'Igoumenítsa','gr','Greece'),(2413,20,'Ilioúpoli','gr','Greece'),(2414,21,'Ioánnina','gr','Greece'),(2415,22,'Iráklion','gr','Greece'),(2416,23,'Kalamariá','gr','Greece'),(2417,24,'Kalámata','gr','Greece'),(2418,25,'Kallithéa','gr','Greece'),(2419,26,'Kardítsa','gr','Greece'),(2420,27,'Kariaí','gr','Greece'),(2421,28,'Karpenísi','gr','Greece'),(2422,29,'Kastoría','gr','Greece'),(2423,30,'Kateríni','gr','Greece'),(2424,31,'Kavála','gr','Greece'),(2425,32,'Keratsínion','gr','Greece'),(2426,33,'Kérkira','gr','Greece'),(2427,34,'Kilkís','gr','Greece'),(2428,35,'Komotiní','gr','Greece'),(2429,36,'Kórinthos','gr','Greece'),(2430,37,'Kozáni','gr','Greece'),(2431,38,'Lamía','gr','Greece'),(2432,39,'Lárisa','gr','Greece'),(2433,40,'Levadía','gr','Greece'),(2434,41,'Levkás','gr','Greece'),(2435,42,'Mesolóngion','gr','Greece'),(2436,43,'Mitilíni','gr','Greece'),(2437,44,'Návplion','gr','Greece'),(2438,45,'Néa Liósia','gr','Greece'),(2439,46,'Néa Smírni','gr','Greece'),(2440,47,'Níkaia','gr','Greece'),(2441,48,'Pátra','gr','Greece'),(2442,49,'Peristérion','gr','Greece'),(2443,50,'Piraeus','gr','Greece'),(2444,51,'Pírgos','gr','Greece'),(2445,52,'Políyiros','gr','Greece'),(2446,53,'Préveza','gr','Greece'),(2447,54,'Réthimnon','gr','Greece'),(2448,55,'Ródos','gr','Greece'),(2449,56,'Sámos','gr','Greece'),(2450,57,'Sérrai','gr','Greece'),(2451,58,'Spárti','gr','Greece'),(2452,59,'Thessaloníki','gr','Greece'),(2453,60,'Tríkala','gr','Greece'),(2454,61,'Trípoli','gr','Greece'),(2455,62,'Véroia','gr','Greece'),(2456,63,'Vólos','gr','Greece'),(2457,64,'Xánthi','gr','Greece'),(2458,65,'Zákinthos','gr','Greece'),(2459,66,'Zográfos','gr','Greece'),(2460,1,'Aasiaat','gl','Greenland'),(2461,2,'Alluitsup Paa','gl','Greenland'),(2462,3,'Illoqqortoormiut','gl','Greenland'),(2463,4,'Ilulissat','gl','Greenland'),(2464,5,'Ivittuut','gl','Greenland'),(2465,6,'Kangaamiut','gl','Greenland'),(2466,7,'Kangaatsiaq','gl','Greenland'),(2467,8,'Kangerlussuaq','gl','Greenland'),(2468,9,'Maniitsoq','gl','Greenland'),(2469,10,'Nanortalik','gl','Greenland'),(2470,11,'Narsaq','gl','Greenland'),(2471,12,'Nuuk','gl','Greenland'),(2472,13,'Paamiut','gl','Greenland'),(2473,14,'Pituffik','gl','Greenland'),(2474,15,'Qaanaaq','gl','Greenland'),(2475,16,'Qaqortoq','gl','Greenland'),(2476,17,'Qasigiannguit','gl','Greenland'),(2477,18,'Qeqertarsuaq','gl','Greenland'),(2478,19,'Sisimiut','gl','Greenland'),(2479,20,'Tasiilaq','gl','Greenland'),(2480,21,'Upernavik','gl','Greenland'),(2481,22,'Uummannaq','gl','Greenland'),(2482,1,'Gouyave','gd','Grenada'),(2483,2,'Grenville','gd','Grenada'),(2484,3,'Hillsborough','gd','Grenada'),(2485,4,'Saint Davids','gd','Grenada'),(2486,5,'Saint George\'s','gd','Grenada'),(2487,6,'Sauteurs','gd','Grenada'),(2488,7,'Victoria','gd','Grenada'),(2489,1,'Baie-Mahault','gp','Guadeloupe'),(2490,2,'Basse-Terre','gp','Guadeloupe'),(2491,3,'Bouillante','gp','Guadeloupe'),(2492,4,'Capesterre-Belle-Eau','gp','Guadeloupe'),(2493,5,'Gourbeyre','gp','Guadeloupe'),(2494,6,'Grand-Bourg','gp','Guadeloupe'),(2495,7,'La Désirade','gp','Guadeloupe'),(2496,8,'Lamentin','gp','Guadeloupe'),(2497,9,'Le Gosier','gp','Guadeloupe'),(2498,10,'Le Moule','gp','Guadeloupe'),(2499,11,'Les Abymes','gp','Guadeloupe'),(2500,12,'Marigot','gp','Guadeloupe'),(2501,13,'Morne-à-l\'Eau','gp','Guadeloupe'),(2502,14,'Petit-Bourg','gp','Guadeloupe'),(2503,15,'Petit-Canal','gp','Guadeloupe'),(2504,16,'Point-à-Pitre','gp','Guadeloupe'),(2505,17,'Pointe-Noire','gp','Guadeloupe'),(2506,18,'Saint-Barthélemy','gp','Guadeloupe'),(2507,19,'Saint-Claude','gp','Guadeloupe'),(2508,20,'Sainte-Anne','gp','Guadeloupe'),(2509,21,'Sainte-Rose','gp','Guadeloupe'),(2510,22,'Saint-François','gp','Guadeloupe'),(2511,23,'Terre-de-Bas','gp','Guadeloupe'),(2512,24,'Trois-Rivières','gp','Guadeloupe'),(2513,25,'Vieux-Habitants','gp','Guadeloupe'),(2514,1,'Agana','gu','Guam'),(2515,2,'Agana Heights','gu','Guam'),(2516,3,'Agat','gu','Guam'),(2517,4,'Anderson Air Force Base','gu','Guam'),(2518,5,'Apra Harbor','gu','Guam'),(2519,6,'Astumbo','gu','Guam'),(2520,7,'Barrigada','gu','Guam'),(2521,8,'Chalan Pago','gu','Guam'),(2522,9,'Dededo','gu','Guam'),(2523,10,'Finegayan Station','gu','Guam'),(2524,11,'Inarajan','gu','Guam'),(2525,12,'Mangilao','gu','Guam'),(2526,13,'Marbo Annex','gu','Guam'),(2527,14,'Merizo','gu','Guam'),(2528,15,'Mongmong','gu','Guam'),(2529,16,'Ordot','gu','Guam'),(2530,17,'Santa Rita','gu','Guam'),(2531,18,'Sinajana','gu','Guam'),(2532,19,'Talofofo','gu','Guam'),(2533,20,'Tamuning','gu','Guam'),(2534,21,'Toto','gu','Guam'),(2535,22,'Yigo','gu','Guam'),(2536,23,'Yona','gu','Guam'),(2537,1,'Amatitlán','gt','Guatemala'),(2538,2,'Antigua','gt','Guatemala'),(2539,3,'Atitlán','gt','Guatemala'),(2540,4,'Chimaltenango','gt','Guatemala'),(2541,5,'Chinautla','gt','Guatemala'),(2542,6,'Chiquimula','gt','Guatemala'),(2543,7,'Cobán','gt','Guatemala'),(2544,8,'Comalapa','gt','Guatemala'),(2545,9,'Cotzumalguapa','gt','Guatemala'),(2546,10,'Cuilapa','gt','Guatemala'),(2547,11,'Escuintla','gt','Guatemala'),(2548,12,'Flores','gt','Guatemala'),(2549,13,'Guastatoya','gt','Guatemala'),(2550,14,'Guatemala','gt','Guatemala'),(2551,15,'Huehuetenango','gt','Guatemala'),(2552,16,'Jalapa','gt','Guatemala'),(2553,17,'Jutiapa','gt','Guatemala'),(2554,18,'Mazatenango','gt','Guatemala'),(2555,19,'Mixco','gt','Guatemala'),(2556,20,'Puerto Barrios','gt','Guatemala'),(2557,21,'Quezaltenango','gt','Guatemala'),(2558,22,'Quiché','gt','Guatemala'),(2559,23,'Retalhuleu','gt','Guatemala'),(2560,24,'Salamá','gt','Guatemala'),(2561,25,'San Marcos','gt','Guatemala'),(2562,26,'Sololá','gt','Guatemala'),(2563,27,'Totonicapán','gt','Guatemala'),(2564,28,'Villa Nueva','gt','Guatemala'),(2565,29,'Zacapa','gt','Guatemala'),(2566,1,'Castle','xu','Guernsey and Alderney'),(2567,2,'Forest','xu','Guernsey and Alderney'),(2568,3,'Saint Andrew','xu','Guernsey and Alderney'),(2569,4,'Saint Anne\'s','xu','Guernsey and Alderney'),(2570,5,'Saint Martin','xu','Guernsey and Alderney'),(2571,6,'Saint Peter','xu','Guernsey and Alderney'),(2572,7,'Saint Peter Port','xu','Guernsey and Alderney'),(2573,8,'Saint Sampson','xu','Guernsey and Alderney'),(2574,9,'Saint Saviour','xu','Guernsey and Alderney'),(2575,10,'Sark','xu','Guernsey and Alderney'),(2576,11,'Torteval','xu','Guernsey and Alderney'),(2577,12,'Vale','xu','Guernsey and Alderney'),(2578,1,'Beyla','gn','Guinea'),(2579,2,'Boffa','gn','Guinea'),(2580,3,'Boké','gn','Guinea'),(2581,4,'Conakry','gn','Guinea'),(2582,5,'Coyah','gn','Guinea'),(2583,6,'Dabola','gn','Guinea'),(2584,7,'Dalaba','gn','Guinea'),(2585,8,'Dinguiraye','gn','Guinea'),(2586,9,'Faranah','gn','Guinea'),(2587,10,'Forécariah','gn','Guinea'),(2588,11,'Fria','gn','Guinea'),(2589,12,'Gaoual','gn','Guinea'),(2590,13,'Guékédou','gn','Guinea'),(2591,14,'Kankan','gn','Guinea'),(2592,15,'Kérouane','gn','Guinea'),(2593,16,'Kindia','gn','Guinea'),(2594,17,'Kissidougou','gn','Guinea'),(2595,18,'Koubia','gn','Guinea'),(2596,19,'Koundara','gn','Guinea'),(2597,20,'Kouroussa','gn','Guinea'),(2598,21,'Labé','gn','Guinea'),(2599,22,'Lola','gn','Guinea'),(2600,23,'Macenta','gn','Guinea'),(2601,24,'Mali','gn','Guinea'),(2602,25,'Mamou','gn','Guinea'),(2603,26,'Mandiana','gn','Guinea'),(2604,27,'Nzérékoré','gn','Guinea'),(2605,28,'Pita','gn','Guinea'),(2606,29,'Siguiri','gn','Guinea'),(2607,30,'Télimélé','gn','Guinea'),(2608,31,'Tondon','gn','Guinea'),(2609,32,'Tougué','gn','Guinea'),(2610,33,'Yomou','gn','Guinea'),(2611,1,'Bafatá','gw','Guinea Bissau'),(2612,2,'Bissau','gw','Guinea Bissau'),(2613,3,'Bissorã','gw','Guinea Bissau'),(2614,4,'Bolama','gw','Guinea Bissau'),(2615,5,'Buba','gw','Guinea Bissau'),(2616,6,'Bubaque','gw','Guinea Bissau'),(2617,7,'Cacheu','gw','Guinea Bissau'),(2618,8,'Canchungo','gw','Guinea Bissau'),(2619,9,'Catió','gw','Guinea Bissau'),(2620,10,'Farim','gw','Guinea Bissau'),(2621,11,'Fulacunda','gw','Guinea Bissau'),(2622,12,'Gabú','gw','Guinea Bissau'),(2623,13,'Mansôa','gw','Guinea Bissau'),(2624,14,'Quebo','gw','Guinea Bissau'),(2625,1,'Anna Regina','gy','Guyana'),(2626,2,'Bartica','gy','Guyana'),(2627,3,'Charity','gy','Guyana'),(2628,4,'Corriverton','gy','Guyana'),(2629,5,'Danielstown','gy','Guyana'),(2630,6,'Fort Wellington','gy','Guyana'),(2631,7,'Georgetown','gy','Guyana'),(2632,8,'Kumaka','gy','Guyana'),(2633,9,'Lethem','gy','Guyana'),(2634,10,'Linden','gy','Guyana'),(2635,11,'Mabaruma','gy','Guyana'),(2636,12,'Mahaica','gy','Guyana'),(2637,13,'Mahaicony','gy','Guyana'),(2638,14,'Mahdia','gy','Guyana'),(2639,15,'New Amsterdam','gy','Guyana'),(2640,16,'Paradise','gy','Guyana'),(2641,17,'Parika','gy','Guyana'),(2642,18,'Pickersgill','gy','Guyana'),(2643,19,'Queenstown','gy','Guyana'),(2644,20,'Rosignol','gy','Guyana'),(2645,21,'Skeldon','gy','Guyana'),(2646,22,'Suddie','gy','Guyana'),(2647,23,'Vreed en Hoop','gy','Guyana'),(2648,1,'Cap-Haïtien','ht','Haiti'),(2649,2,'Carrefour','ht','Haiti'),(2650,3,'Delmas','ht','Haiti'),(2651,4,'Desdunes','ht','Haiti'),(2652,5,'Dessalines','ht','Haiti'),(2653,6,'Fort-Liberté','ht','Haiti'),(2654,7,'Gonaïves','ht','Haiti'),(2655,8,'Hinche','ht','Haiti'),(2656,9,'Jacmel','ht','Haiti'),(2657,10,'Jérémie','ht','Haiti'),(2658,11,'L\'Artibonite','ht','Haiti'),(2659,12,'Les Cayes','ht','Haiti'),(2660,13,'Limbe','ht','Haiti'),(2661,14,'Ouanaminthe','ht','Haiti'),(2662,15,'Pétionville','ht','Haiti'),(2663,16,'Port-au-Prince','ht','Haiti'),(2664,17,'Port-de-Paix','ht','Haiti'),(2665,18,'Saint-Marc','ht','Haiti'),(2666,19,'Saint-Michel-de-l\'Atalaye','ht','Haiti'),(2667,20,'Trou-du-Nord','ht','Haiti'),(2668,21,'Verrettes','ht','Haiti'),(2669,1,'Catacamas','hn','Honduras'),(2670,2,'Choloma','hn','Honduras'),(2671,3,'Choluteca','hn','Honduras'),(2672,4,'Comayagua','hn','Honduras'),(2673,5,'Danlí','hn','Honduras'),(2674,6,'El Paraíso','hn','Honduras'),(2675,7,'El Progreso','hn','Honduras'),(2676,8,'Gracias','hn','Honduras'),(2677,9,'Juticalpa','hn','Honduras'),(2678,10,'La Ceiba','hn','Honduras'),(2679,11,'La Esperanza','hn','Honduras'),(2680,12,'La Lima','hn','Honduras'),(2681,13,'La Paz','hn','Honduras'),(2682,14,'Nacaome','hn','Honduras'),(2683,15,'Ocotepeque','hn','Honduras'),(2684,16,'Olanchito','hn','Honduras'),(2685,17,'Puerto Cortés','hn','Honduras'),(2686,18,'Puerto Lempira','hn','Honduras'),(2687,19,'Roatán','hn','Honduras'),(2688,20,'San Lorenzo','hn','Honduras'),(2689,21,'San Pedro Sula','hn','Honduras'),(2690,22,'Santa Bárbara','hn','Honduras'),(2691,23,'Santa Rosa de Copán','hn','Honduras'),(2692,24,'Siguatepeque','hn','Honduras'),(2693,25,'Tegucigalpa','hn','Honduras'),(2694,26,'Tela','hn','Honduras'),(2695,27,'Tocoa','hn','Honduras'),(2696,28,'Trujillo','hn','Honduras'),(2697,29,'Yoro','hn','Honduras'),(2698,30,'Yuscarán','hn','Honduras'),(2699,1,'Békéscsaba','hu','Hungary'),(2700,2,'Budapest','hu','Hungary'),(2701,3,'Debrecen','hu','Hungary'),(2702,4,'Dunaújváros','hu','Hungary'),(2703,5,'Eger','hu','Hungary'),(2704,6,'Györ','hu','Hungary'),(2705,7,'Kaposvár','hu','Hungary'),(2706,8,'Kecskemét','hu','Hungary'),(2707,9,'Miskolc','hu','Hungary'),(2708,10,'Nagykanizsa','hu','Hungary'),(2709,11,'Nyíregyháza','hu','Hungary'),(2710,12,'Pécs','hu','Hungary'),(2711,13,'Salgótarján','hu','Hungary'),(2712,14,'Sopron','hu','Hungary'),(2713,15,'Szeged','hu','Hungary'),(2714,16,'Székesfehérvár','hu','Hungary'),(2715,17,'Szekszárd','hu','Hungary'),(2716,18,'Szolnok','hu','Hungary'),(2717,19,'Szombathely','hu','Hungary'),(2718,20,'Tatabánya','hu','Hungary'),(2719,21,'Veszprém','hu','Hungary'),(2720,22,'Zalaegerszeg','hu','Hungary'),(2721,1,'Akranes','is','Iceland'),(2722,2,'Akureyri','is','Iceland'),(2723,3,'Álftanes','is','Iceland'),(2724,4,'Borgarnes','is','Iceland'),(2725,5,'Egilsstaðir','is','Iceland'),(2726,6,'Garðabær','is','Iceland'),(2727,7,'Grindavík','is','Iceland'),(2728,8,'Hafnarfjörður','is','Iceland'),(2729,9,'Höfn','is','Iceland'),(2730,10,'Húsavík','is','Iceland'),(2731,11,'Hveragerði','is','Iceland'),(2732,12,'Ísafjörður','is','Iceland'),(2733,13,'Keflavík','is','Iceland'),(2734,14,'Kópavogur','is','Iceland'),(2735,15,'Mosfellsbær','is','Iceland'),(2736,16,'Reykjavík','is','Iceland'),(2737,17,'Sauðárkrókur','is','Iceland'),(2738,18,'Selfoss','is','Iceland'),(2739,19,'Seltjarnarnes','is','Iceland'),(2740,20,'Vestmannæyjar','is','Iceland'),(2741,1,'Abohar','in','India'),(2742,2,'Achalpur','in','India'),(2743,3,'Âdilâbâd','in','India'),(2744,4,'Âdityâpur','in','India'),(2745,5,'Âdoni','in','India'),(2746,6,'Agartala','in','India'),(2747,7,'Âgra','in','India'),(2748,8,'Ahmadâbâd','in','India'),(2749,9,'Ahmadnagar','in','India'),(2750,10,'Âîzawl','in','India'),(2751,11,'Ajmer','in','India'),(2752,12,'Akola','in','India'),(2753,13,'Alandur','in','India'),(2754,14,'Alappuzha','in','India'),(2755,15,'Alîgarh','in','India'),(2756,16,'Allahâbâd','in','India'),(2757,17,'Alwal','in','India'),(2758,18,'Alwar','in','India'),(2759,19,'Ambâla','in','India'),(2760,20,'Ambâla Sadar','in','India'),(2761,21,'Ambarnath','in','India'),(2762,22,'Ambattur','in','India'),(2763,23,'Âmbûr','in','India'),(2764,24,'Amrâvati','in','India'),(2765,25,'Amritsar','in','India'),(2766,26,'Amroha','in','India'),(2767,27,'Ânand','in','India'),(2768,28,'Anantapur','in','India'),(2769,29,'Ara','in','India'),(2770,30,'Asansol','in','India'),(2771,31,'Ashoknagar Kalyangarh','in','India'),(2772,32,'Aurangâbâd','in','India'),(2773,33,'Avadi','in','India'),(2774,34,'Azamgarh','in','India'),(2775,35,'Badlapur','in','India'),(2776,36,'Bahâdurgarh','in','India'),(2777,37,'Baharampur','in','India'),(2778,38,'Bahraich','in','India'),(2779,39,'Baidyabâti','in','India'),(2780,40,'Bâleshwar','in','India'),(2781,41,'Ballia','in','India'),(2782,42,'Bally','in','India'),(2783,43,'Bâlurghât','in','India'),(2784,44,'Bânda','in','India'),(2785,45,'Bangaon','in','India'),(2786,46,'Bânkura','in','India'),(2787,47,'Bânsbâria','in','India'),(2788,48,'Bârâkpur','in','India'),(2789,49,'Baranagar','in','India'),(2790,50,'Bârâsat','in','India'),(2791,51,'Barddhamân','in','India'),(2792,52,'Bareli','in','India'),(2793,53,'Barnâla','in','India'),(2794,54,'Bârsi','in','India'),(2795,55,'Basîrhât','in','India'),(2796,56,'Basti','in','India'),(2797,57,'Batala','in','India'),(2798,58,'Bathinda','in','India'),(2799,59,'Beâwar','in','India'),(2800,60,'Belgaum','in','India'),(2801,61,'Bellary','in','India'),(2802,62,'Bengalûru','in','India'),(2803,63,'Bettiah','in','India'),(2804,64,'Bhadrâvati','in','India'),(2805,65,'Bhadreswar','in','India'),(2806,66,'Bhâgalpur','in','India'),(2807,67,'Bhalswa Jahangirpur','in','India'),(2808,68,'Bharatpur','in','India'),(2809,69,'Bharûch','in','India'),(2810,70,'Bhâtpâra','in','India'),(2811,71,'Bhâvnagar','in','India'),(2812,72,'Bhilai','in','India'),(2813,73,'Bhîlwâra','in','India'),(2814,74,'Bhîmavaram','in','India'),(2815,75,'Bhind','in','India'),(2816,76,'Bhiwandi','in','India'),(2817,77,'Bhiwâni','in','India'),(2818,78,'Bhopâl','in','India'),(2819,79,'Bhubaneswar','in','India'),(2820,80,'Bhuj','in','India'),(2821,81,'Bhusâwal','in','India'),(2822,82,'Bîd','in','India'),(2823,83,'Bîdar','in','India'),(2824,84,'Bidhannagar','in','India'),(2825,85,'Bihâr','in','India'),(2826,86,'Bijâpur','in','India'),(2827,87,'Bîkâner','in','India'),(2828,88,'Bilâspur','in','India'),(2829,89,'Bokâro','in','India'),(2830,90,'Bommanahalli','in','India'),(2831,91,'Botâd','in','India'),(2832,92,'Brahmapur','in','India'),(2833,93,'Budaun','in','India'),(2834,94,'Bulandshahr','in','India'),(2835,95,'Burhânpur','in','India'),(2836,96,'Byatarayanapura','in','India'),(2837,97,'Champdâni','in','India'),(2838,98,'Chandannagar','in','India'),(2839,99,'Chandausi','in','India'),(2840,100,'Chandîgarh','in','India'),(2841,101,'Chandrapur','in','India'),(2842,102,'Châs','in','India'),(2843,103,'Chennai','in','India'),(2844,104,'Chhâpra','in','India'),(2845,105,'Chhatarpur','in','India'),(2846,106,'Chhindwâra','in','India'),(2847,107,'Chikmagalûr','in','India'),(2848,108,'Chitradurga','in','India'),(2849,109,'Chittur','in','India'),(2850,110,'Chûru','in','India'),(2851,111,'Cuddapah','in','India'),(2852,112,'Dallo Pura','in','India'),(2853,113,'Damân','in','India'),(2854,114,'Damoh','in','India'),(2855,115,'Darbhanga','in','India'),(2856,116,'Dârjiling','in','India'),(2857,117,'Dasarahalli','in','India'),(2858,118,'Davanagere','in','India'),(2859,119,'Dehra Dûn','in','India'),(2860,120,'Dehri','in','India'),(2861,121,'Deoli','in','India'),(2862,122,'Deoria','in','India'),(2863,123,'Devghar','in','India'),(2864,124,'Dewâs','in','India'),(2865,125,'Dhanbad','in','India'),(2866,126,'Dharmavaram','in','India'),(2867,127,'Dhule','in','India'),(2868,128,'Dibrugarh','in','India'),(2869,129,'Dilli','in','India'),(2870,130,'Dilli Cantonment','in','India'),(2871,131,'Dimâpur','in','India'),(2872,132,'Dinapur','in','India'),(2873,133,'Dindigul','in','India'),(2874,134,'Dispur','in','India'),(2875,135,'Dum Dum','in','India'),(2876,136,'Durg','in','India'),(2877,137,'Durgâpur','in','India'),(2878,138,'Elûru','in','India'),(2879,139,'Erode','in','India'),(2880,140,'Etah','in','India'),(2881,141,'Etâwah','in','India'),(2882,142,'Faizâbâd','in','India'),(2883,143,'Farîdâbad','in','India'),(2884,144,'Farrukhâbâd','in','India'),(2885,145,'Fatehpur','in','India'),(2886,146,'Fîrozâbâd','in','India'),(2887,147,'Gadag','in','India'),(2888,148,'Gajuvaka','in','India'),(2889,149,'Gândhîdham','in','India'),(2890,150,'Gândhînagar','in','India'),(2891,151,'Gangânagar','in','India'),(2892,152,'Gangâpur','in','India'),(2893,153,'Gangtok','in','India'),(2894,154,'Gaya','in','India'),(2895,155,'Ghatlodiya','in','India'),(2896,156,'Ghâziâbâd','in','India'),(2897,157,'Godhra','in','India'),(2898,158,'Gonda','in','India'),(2899,159,'Gondiya','in','India'),(2900,160,'Gorakhpur','in','India'),(2901,161,'Gûdalûr','in','India'),(2902,162,'Gudivâda','in','India'),(2903,163,'Gulbarga','in','India'),(2904,164,'Guna','in','India'),(2905,165,'Guntakal','in','India'),(2906,166,'Guntûr','in','India'),(2907,167,'Gurgaon','in','India'),(2908,168,'Guwâhâti','in','India'),(2909,169,'Gwalior','in','India'),(2910,170,'Hâbra','in','India'),(2911,171,'Haidarâbâd','in','India'),(2912,172,'Hâjîpur','in','India'),(2913,173,'Haldia','in','India'),(2914,174,'Haldwâni','in','India'),(2915,175,'Hâlîsahar','in','India'),(2916,176,'Hanumângarh','in','India'),(2917,177,'Hâora','in','India'),(2918,178,'Hâpur','in','India'),(2919,179,'Hardoî','in','India'),(2920,180,'Haridwâr','in','India'),(2921,181,'Hassan','in','India'),(2922,182,'Hâthras','in','India'),(2923,183,'Hazârîbâg','in','India'),(2924,184,'Hindupur','in','India'),(2925,185,'Hisâr','in','India'),(2926,186,'Hoshangâbâd','in','India'),(2927,187,'Hoshiârpur','in','India'),(2928,188,'Hospet','in','India'),(2929,189,'Hubli','in','India'),(2930,190,'Hugli-Chunchura','in','India'),(2931,191,'Ichalkaranji','in','India'),(2932,192,'Imphâl','in','India'),(2933,193,'Indore','in','India'),(2934,194,'Ingrâj Bâzâr','in','India'),(2935,195,'Itânagar','in','India'),(2936,196,'Jabalpur','in','India'),(2937,197,'Jâgadhri','in','India'),(2938,198,'Jaipur','in','India'),(2939,199,'Jalandhar','in','India'),(2940,200,'Jâlgaon','in','India'),(2941,201,'Jâlna','in','India'),(2942,202,'Jalpâiguri','in','India'),(2943,203,'Jamâlpur','in','India'),(2944,204,'Jammu','in','India'),(2945,205,'Jâmnagar','in','India'),(2946,206,'Jamshedpur','in','India'),(2947,207,'Jâmuria','in','India'),(2948,208,'Jaridih','in','India'),(2949,209,'Jaunpur','in','India'),(2950,210,'Jetpur','in','India'),(2951,211,'Jhânsi','in','India'),(2952,212,'Jhunjhunûn','in','India'),(2953,213,'Jînd','in','India'),(2954,214,'Jodhpur','in','India'),(2955,215,'Jûnâgadh','in','India'),(2956,216,'Kaithal','in','India'),(2957,217,'Kâkinâda','in','India'),(2958,218,'Kâlol','in','India'),(2959,219,'Kalyân','in','India'),(2960,220,'Kâmârhâti','in','India'),(2961,221,'Kânchipuram','in','India'),(2962,222,'Kânchrâpâra','in','India'),(2963,223,'Kânpur','in','India'),(2964,224,'Kapra','in','India'),(2965,225,'Karawal Nagar','in','India'),(2966,226,'Karîmnagar','in','India'),(2967,227,'Karnâl','in','India'),(2968,228,'Karnûl','in','India'),(2969,229,'Kataka','in','India'),(2970,230,'Katihâr','in','India'),(2971,231,'Kavaratti','in','India'),(2972,232,'Khammam','in','India'),(2973,233,'Khandwa','in','India'),(2974,234,'Khanna','in','India'),(2975,235,'Kharagpur','in','India'),(2976,236,'Khardaha','in','India'),(2977,237,'Khurja','in','India'),(2978,238,'Kirari Suleman Nagar','in','India'),(2979,239,'Kishangarh','in','India'),(2980,240,'Kochi','in','India'),(2981,241,'Kohîma','in','India'),(2982,242,'Kolâr','in','India'),(2983,243,'Kolhâpur','in','India'),(2984,244,'Kolkata','in','India'),(2985,245,'Kollam','in','India'),(2986,246,'Korba','in','India'),(2987,247,'Kota','in','India'),(2988,248,'Koyampattur','in','India'),(2989,249,'Kozhikkod','in','India'),(2990,250,'Krishnanagar','in','India'),(2991,251,'Krishnarajapura','in','India'),(2992,252,'Kukatpalle','in','India'),(2993,253,'Kulti','in','India'),(2994,254,'Kumbakonam','in','India'),(2995,255,'Lakhîmpur','in','India'),(2996,256,'Lakhnau','in','India'),(2997,257,'Lalbahadur Nagar','in','India'),(2998,258,'Lalitpur','in','India'),(2999,259,'Lâtûr','in','India'),(3000,260,'Loni','in','India'),(3001,261,'Ludhiâna','in','India'),(3002,262,'Machilîpatnam','in','India'),(3003,263,'Madanapalle','in','India'),(3004,264,'Madhyamgram','in','India'),(3005,265,'Madurai','in','India'),(3006,266,'Mahadevapura','in','India'),(3007,267,'Mahbûbnagar','in','India'),(3008,268,'Mâhesana','in','India'),(3009,269,'Maheshtala','in','India'),(3010,270,'Maisûru','in','India'),(3011,271,'Mâlegaon','in','India'),(3012,272,'Mâler Kotla','in','India'),(3013,273,'Malkajgiri','in','India'),(3014,274,'Mandsaur','in','India'),(3015,275,'Mandya','in','India'),(3016,276,'Mangaluru','in','India'),(3017,277,'Mango','in','India'),(3018,278,'Mathura','in','India'),(3019,279,'Mau','in','India'),(3020,280,'Midnapur','in','India'),(3021,281,'Mira Bhayandar','in','India'),(3022,282,'Mîrat','in','India'),(3023,283,'Mirzâpur','in','India'),(3024,284,'Modinagar','in','India'),(3025,285,'Moga','in','India'),(3026,286,'Mohali','in','India'),(3027,287,'Morâdâbâd','in','India'),(3028,288,'Morena','in','India'),(3029,289,'Mormugao','in','India'),(3030,290,'Morvi','in','India'),(3031,291,'Motîhâri','in','India'),(3032,292,'Mumbai','in','India'),(3033,293,'Munger','in','India'),(3034,294,'Murwâra','in','India'),(3035,295,'Muzaffarnagar','in','India'),(3036,296,'Muzaffarpur','in','India'),(3037,297,'Nadiâd','in','India'),(3038,298,'Nagaon','in','India'),(3039,299,'Nagda','in','India'),(3040,300,'Nâgercoil','in','India'),(3041,301,'Nâgpur','in','India'),(3042,302,'Naihâti','in','India'),(3043,303,'Nalasopara','in','India'),(3044,304,'Nalgonda','in','India'),(3045,305,'Nânded','in','India'),(3046,306,'Nandyâl','in','India'),(3047,307,'Nângloi Jât','in','India'),(3048,308,'Nâshik','in','India'),(3049,309,'Navadwîp','in','India'),(3050,310,'Navghar','in','India'),(3051,311,'Navi Mumbai','in','India'),(3052,312,'Navsâri','in','India'),(3053,313,'Nellur','in','India'),(3054,314,'Neyveli','in','India'),(3055,315,'Ni Dilli','in','India'),(3056,316,'Nîmach','in','India'),(3057,317,'Nizâmâbâd','in','India'),(3058,318,'Noida','in','India'),(3059,319,'North Bârâkpur','in','India'),(3060,320,'North Dum Dum','in','India'),(3061,321,'Ongole','in','India'),(3062,322,'Orai','in','India'),(3063,323,'Ozhukarai','in','India'),(3064,324,'Palakkad','in','India'),(3065,325,'Pâlanpur','in','India'),(3066,326,'Pâli','in','India'),(3067,327,'Pallâvaram','in','India'),(3068,328,'Palwal','in','India'),(3069,329,'Panaji','in','India'),(3070,330,'Panchkula','in','India'),(3071,331,'Pânihâti','in','India'),(3072,332,'Pânîpat','in','India'),(3073,333,'Panvel','in','India'),(3074,334,'Parbhani','in','India'),(3075,335,'Pâtan','in','India'),(3076,336,'Pathânkot','in','India'),(3077,337,'Patiâla','in','India'),(3078,338,'Patna','in','India'),(3079,339,'Pîlîbhît','in','India'),(3080,340,'Pimpri','in','India'),(3081,341,'Pondicherry','in','India'),(3082,342,'Porbandar','in','India'),(3083,343,'Port Blair','in','India'),(3084,344,'Proddatûr','in','India'),(3085,345,'Pudukkottai','in','India'),(3086,346,'Pune','in','India'),(3087,347,'Puri','in','India'),(3088,348,'Pûrnia','in','India'),(3089,349,'Puruliya','in','India'),(3090,350,'Qutubullapur','in','India'),(3091,351,'Râe Bareli','in','India'),(3092,352,'Râichûr','in','India'),(3093,353,'Râiganj','in','India'),(3094,354,'Raigarh','in','India'),(3095,355,'Raipur','in','India'),(3096,356,'Râjamahendri','in','India'),(3097,357,'Râjapâlaiyam','in','India'),(3098,358,'Rajarhat Gopalpur','in','India'),(3099,359,'Rajendranagar','in','India'),(3100,360,'Râjkot','in','India'),(3101,361,'Râjnândgaon','in','India'),(3102,362,'Râjpur','in','India'),(3103,363,'Râmagundam','in','India'),(3104,364,'Râmpur','in','India'),(3105,365,'Rânchi','in','India'),(3106,366,'Rânîganj','in','India'),(3107,367,'Ratlâm','in','India'),(3108,368,'Raurkela','in','India'),(3109,369,'Raurkela Civil Township','in','India'),(3110,370,'Rewa','in','India'),(3111,371,'Rewâri','in','India'),(3112,372,'Rishra','in','India'),(3113,373,'Robertsonpet','in','India'),(3114,374,'Rohtak','in','India'),(3115,375,'Rûrkî','in','India'),(3116,376,'Sâgar','in','India'),(3117,377,'Sahâranpur','in','India'),(3118,378,'Saharsa','in','India'),(3119,379,'Sambalpur','in','India'),(3120,380,'Sambhal','in','India'),(3121,381,'Sangli-Miraj','in','India'),(3122,382,'Sâsarâm','in','India'),(3123,383,'Sâtâra','in','India'),(3124,384,'Satna','in','India'),(3125,385,'Sawâi Mâdhopur','in','India'),(3126,386,'Selam','in','India'),(3127,387,'Serilungampalle','in','India'),(3128,388,'Shâhjahânpur','in','India'),(3129,389,'Shântipur','in','India'),(3130,390,'Shilîguri','in','India'),(3131,391,'Shillong','in','India'),(3132,392,'Shimla','in','India'),(3133,393,'Shimoga','in','India'),(3134,394,'Shivapuri','in','India'),(3135,395,'Sholâpur','in','India'),(3136,396,'Shrîrâmpur','in','India'),(3137,397,'Sikandarâbâd','in','India'),(3138,398,'Sîkar','in','India'),(3139,399,'Silchar','in','India'),(3140,400,'Silvassa','in','India'),(3141,401,'Singrauli','in','India'),(3142,402,'Sirsa','in','India'),(3143,403,'Sîtâpur','in','India'),(3144,404,'Siwân','in','India'),(3145,405,'Sonîpat','in','India'),(3146,406,'South Dum Dum','in','India'),(3147,407,'Srîkâkulam','in','India'),(3148,408,'Srînagar','in','India'),(3149,409,'Sultânpur','in','India'),(3150,410,'Sultanpur Majra','in','India'),(3151,411,'Sûrat','in','India'),(3152,412,'Surendranagar','in','India'),(3153,413,'Tâdepallegûdem','in','India'),(3154,414,'Tâmbaram','in','India'),(3155,415,'Tenâli','in','India'),(3156,416,'Thalassery','in','India'),(3157,417,'Thâna','in','India'),(3158,418,'Thânesar','in','India'),(3159,419,'Thanjâvûr','in','India'),(3160,420,'Thiruvananthapuram','in','India'),(3161,421,'Thrissûr','in','India'),(3162,422,'Thûthukkudi','in','India'),(3163,423,'Tiruchchirâppalli','in','India'),(3164,424,'Tirunelveli','in','India'),(3165,425,'Tirupati','in','India'),(3166,426,'Tiruppur','in','India'),(3167,427,'Tiruvannâmalai','in','India'),(3168,428,'Tirûvottiyûr','in','India'),(3169,429,'Titâgarh','in','India'),(3170,430,'Tonk','in','India'),(3171,431,'Tumkûr','in','India'),(3172,432,'Udaipur','in','India'),(3173,433,'Udupi','in','India'),(3174,434,'Ujjain','in','India'),(3175,435,'Ulhâsnagar','in','India'),(3176,436,'Ulubâria','in','India'),(3177,437,'Unnâo','in','India'),(3178,438,'Uppal Kalan','in','India'),(3179,439,'Uttarpara-Kotrung','in','India'),(3180,440,'Vadodara','in','India'),(3181,441,'Vârânasî','in','India'),(3182,442,'Vejalpur','in','India'),(3183,443,'Velluru','in','India'),(3184,444,'Verâval','in','India'),(3185,445,'Vidisha','in','India'),(3186,446,'Vijayawâda','in','India'),(3187,447,'Virâr','in','India'),(3188,448,'Visakhapatnam','in','India'),(3189,449,'Vizianagaram','in','India'),(3190,450,'Warangal','in','India'),(3191,451,'Wardha','in','India'),(3192,452,'Yamunânagar','in','India'),(3193,453,'Yavatmâl','in','India'),(3194,1,'Adiwerna','id','Indonesia'),(3195,2,'Ambon','id','Indonesia'),(3196,3,'Balikpapan','id','Indonesia'),(3197,4,'Banda Aceh','id','Indonesia'),(3198,5,'Bandar Lampung','id','Indonesia'),(3199,6,'Bandung','id','Indonesia'),(3200,7,'Banjarmasin','id','Indonesia'),(3201,8,'Banyuwangi','id','Indonesia'),(3202,9,'Batam','id','Indonesia'),(3203,10,'Bekasi','id','Indonesia'),(3204,11,'Belawan','id','Indonesia'),(3205,12,'Bengkulu','id','Indonesia'),(3206,13,'Binjai','id','Indonesia'),(3207,14,'Bitung','id','Indonesia'),(3208,15,'Blitar','id','Indonesia'),(3209,16,'Bogor','id','Indonesia'),(3210,17,'Brebes','id','Indonesia'),(3211,18,'Cianjur','id','Indonesia'),(3212,19,'Ciawi','id','Indonesia'),(3213,20,'Cibinong','id','Indonesia'),(3214,21,'Cilacap','id','Indonesia'),(3215,22,'Cilegon','id','Indonesia'),(3216,23,'Cimahi','id','Indonesia'),(3217,24,'Cimanggis','id','Indonesia'),(3218,25,'Ciomas','id','Indonesia'),(3219,26,'Ciparay','id','Indonesia'),(3220,27,'Ciputat','id','Indonesia'),(3221,28,'Cirebon','id','Indonesia'),(3222,29,'Citeureup','id','Indonesia'),(3223,30,'Denpasar','id','Indonesia'),(3224,31,'Depok','id','Indonesia'),(3225,32,'Depok','id','Indonesia'),(3226,33,'Dumai','id','Indonesia'),(3227,34,'Garut','id','Indonesia'),(3228,35,'Gorontalo','id','Indonesia'),(3229,36,'Jakarta','id','Indonesia'),(3230,37,'Jambi','id','Indonesia'),(3231,38,'Jaya Pura','id','Indonesia'),(3232,39,'Jember','id','Indonesia'),(3233,40,'Jombang','id','Indonesia'),(3234,41,'Karawang','id','Indonesia'),(3235,42,'Kediri','id','Indonesia'),(3236,43,'Kendari','id','Indonesia'),(3237,44,'Klaten','id','Indonesia'),(3238,45,'Kudus','id','Indonesia'),(3239,46,'Kupang','id','Indonesia'),(3240,47,'Lhokseumawe','id','Indonesia'),(3241,48,'Madiun','id','Indonesia'),(3242,49,'Magelang','id','Indonesia'),(3243,50,'Majalaya','id','Indonesia'),(3244,51,'Makasar','id','Indonesia'),(3245,52,'Malang','id','Indonesia'),(3246,53,'Manado','id','Indonesia'),(3247,54,'Martapura','id','Indonesia'),(3248,55,'Mataram','id','Indonesia'),(3249,56,'Medan','id','Indonesia'),(3250,57,'Mojokerto','id','Indonesia'),(3251,58,'Padang','id','Indonesia'),(3252,59,'Padang Sidempuan','id','Indonesia'),(3253,60,'Palangka Raya','id','Indonesia'),(3254,61,'Palembang','id','Indonesia'),(3255,62,'Palu','id','Indonesia'),(3256,63,'Pangkal Pinang','id','Indonesia'),(3257,64,'Pare Pare','id','Indonesia'),(3258,65,'Pasuruan','id','Indonesia'),(3259,66,'Pekalongan','id','Indonesia'),(3260,67,'Pekan Baru','id','Indonesia'),(3261,68,'Pemalang','id','Indonesia'),(3262,69,'Pematang Siantar','id','Indonesia'),(3263,70,'Percut Sei Tuan','id','Indonesia'),(3264,71,'Pondok Aren','id','Indonesia'),(3265,72,'Pondokgede','id','Indonesia'),(3266,73,'Pontianak','id','Indonesia'),(3267,74,'Probolinggo','id','Indonesia'),(3268,75,'Purwakarta','id','Indonesia'),(3269,76,'Purwokerto','id','Indonesia'),(3270,77,'Rantauprapat','id','Indonesia'),(3271,78,'Salatiga','id','Indonesia'),(3272,79,'Samarinda','id','Indonesia'),(3273,80,'Sawangan','id','Indonesia'),(3274,81,'Semarang','id','Indonesia'),(3275,82,'Serang','id','Indonesia'),(3276,83,'Sorong','id','Indonesia'),(3277,84,'Sukabumi','id','Indonesia'),(3278,85,'Sunggal','id','Indonesia'),(3279,86,'Surabaya','id','Indonesia'),(3280,87,'Surakarta','id','Indonesia'),(3281,88,'Taman','id','Indonesia'),(3282,89,'Tangerang','id','Indonesia'),(3283,90,'Tanjung Balai','id','Indonesia'),(3284,91,'Tanjung Pinang','id','Indonesia'),(3285,92,'Tasikmalaya','id','Indonesia'),(3286,93,'Tebingtinggi','id','Indonesia'),(3287,94,'Tegal','id','Indonesia'),(3288,95,'Ternate','id','Indonesia'),(3289,96,'Waru','id','Indonesia'),(3290,97,'Weru','id','Indonesia'),(3291,98,'Yogyakarta','id','Indonesia'),(3292,1,'Âbâdân','ir','Iran'),(3293,2,'Ahvâz','ir','Iran'),(3294,3,'Âmol','ir','Iran'),(3295,4,'Andîmeshk','ir','Iran'),(3296,5,'Arâk','ir','Iran'),(3297,6,'Ardabîl','ir','Iran'),(3298,7,'Bâbol','ir','Iran'),(3299,8,'Bandar-e ´Abbâs','ir','Iran'),(3300,9,'Bandar-e Anzalî','ir','Iran'),(3301,10,'Bandar-e Mâhshahr','ir','Iran'),(3302,11,'Behbahân','ir','Iran'),(3303,12,'Bîrjand','ir','Iran'),(3304,13,'Bojnûrd','ir','Iran'),(3305,14,'Borûjerd','ir','Iran'),(3306,15,'Bûkân','ir','Iran'),(3307,16,'Bûshehr','ir','Iran'),(3308,17,'Dezfûl','ir','Iran'),(3309,18,'Esfahân','ir','Iran'),(3310,19,'Eslâmshahr','ir','Iran'),(3311,20,'Ezeh','ir','Iran'),(3312,21,'Gonbad-e Qâbûs','ir','Iran'),(3313,22,'Gorgân','ir','Iran'),(3314,23,'Hamadân','ir','Iran'),(3315,24,'Îlâm','ir','Iran'),(3316,25,'Jahrom','ir','Iran'),(3317,26,'Karaj','ir','Iran'),(3318,27,'Kâshân','ir','Iran'),(3319,28,'Kermân','ir','Iran'),(3320,29,'Kermânshâh','ir','Iran'),(3321,30,'Khomeynîshahr','ir','Iran'),(3322,31,'Khorramâbâd','ir','Iran'),(3323,32,'Khorramshahr','ir','Iran'),(3324,33,'Khoy','ir','Iran'),(3325,34,'Mahâbâd','ir','Iran'),(3326,35,'Malârd','ir','Iran'),(3327,36,'Malâyer','ir','Iran'),(3328,37,'Marâgheh','ir','Iran'),(3329,38,'Marv Dasht','ir','Iran'),(3330,39,'Mashhad','ir','Iran'),(3331,40,'Masjed-e Soleymân','ir','Iran'),(3332,41,'Mîândoâb','ir','Iran'),(3333,42,'Najafâbâd','ir','Iran'),(3334,43,'Neyshâbûr','ir','Iran'),(3335,44,'Orûmîyeh','ir','Iran'),(3336,45,'Qâ´emshahr','ir','Iran'),(3337,46,'Qarchak','ir','Iran'),(3338,47,'Qazvîn','ir','Iran'),(3339,48,'Qods','ir','Iran'),(3340,49,'Qom','ir','Iran'),(3341,50,'Rafsanjân','ir','Iran'),(3342,51,'Rasht','ir','Iran'),(3343,52,'Sabzevâr','ir','Iran'),(3344,53,'Sanandaj','ir','Iran'),(3345,54,'Saqqez','ir','Iran'),(3346,55,'Sârî','ir','Iran'),(3347,56,'Sâveh','ir','Iran'),(3348,57,'Semnân','ir','Iran'),(3349,58,'Shahr-e Kord','ir','Iran'),(3350,59,'Shâhrûd','ir','Iran'),(3351,60,'Shîrâz','ir','Iran'),(3352,61,'Sîrjân','ir','Iran'),(3353,62,'Tabrîz','ir','Iran'),(3354,63,'Tehrân','ir','Iran'),(3355,64,'Varâmîn','ir','Iran'),(3356,65,'Yâsûj','ir','Iran'),(3357,66,'Yazd','ir','Iran'),(3358,67,'Zâbol','ir','Iran'),(3359,68,'Zâhedân','ir','Iran'),(3360,69,'Zanjân','ir','Iran'),(3361,1,'ad-Dîwânîyah','iq','Iraq'),(3362,2,'al-´Amârah','iq','Iraq'),(3363,3,'al-Basrah','iq','Iraq'),(3364,4,'al-Fallûjah','iq','Iraq'),(3365,5,'al-Hillah','iq','Iraq'),(3366,6,'al-Kûfah','iq','Iraq'),(3367,7,'al-Kût','iq','Iraq'),(3368,8,'al-Mawsil','iq','Iraq'),(3369,9,'an-Najaf','iq','Iraq'),(3370,10,'an-Nâsirîyah','iq','Iraq'),(3371,11,'ar-Ramâdî','iq','Iraq'),(3372,12,'as-Samâwah','iq','Iraq'),(3373,13,'as-Sulaymânîyah','iq','Iraq'),(3374,14,'az-Zubayr','iq','Iraq'),(3375,15,'Ba´qûbah','iq','Iraq'),(3376,16,'Baghdâd','iq','Iraq'),(3377,17,'Dahûk','iq','Iraq'),(3378,18,'Irbîl','iq','Iraq'),(3379,19,'Karbalâ','iq','Iraq'),(3380,20,'Kirkûk','iq','Iraq'),(3381,21,'Sâmarrâ','iq','Iraq'),(3382,22,'Tall ´Afar','iq','Iraq'),(3383,23,'Tikrit','iq','Iraq'),(3384,1,'Athlone','ie','Ireland'),(3385,2,'Bray','ie','Ireland'),(3386,3,'Carlow','ie','Ireland'),(3387,4,'Carrick-on-Shannon','ie','Ireland'),(3388,5,'Castlebar','ie','Ireland'),(3389,6,'Cavan','ie','Ireland'),(3390,7,'Clonmel','ie','Ireland'),(3391,8,'Cork','ie','Ireland'),(3392,9,'Drogheda','ie','Ireland'),(3393,10,'Dublin','ie','Ireland'),(3394,11,'Dundalk','ie','Ireland'),(3395,12,'Dungarvan','ie','Ireland'),(3396,13,'Ennis','ie','Ireland'),(3397,14,'Galway','ie','Ireland'),(3398,15,'Kilkenny','ie','Ireland'),(3399,16,'Lifford','ie','Ireland'),(3400,17,'Limerick','ie','Ireland'),(3401,18,'Longford','ie','Ireland'),(3402,19,'Monaghan','ie','Ireland'),(3403,20,'Mullingar','ie','Ireland'),(3404,21,'Naas','ie','Ireland'),(3405,22,'Navan','ie','Ireland'),(3406,23,'Nenagh','ie','Ireland'),(3407,24,'Newbridge','ie','Ireland'),(3408,25,'Port Laoise','ie','Ireland'),(3409,26,'Roscommon','ie','Ireland'),(3410,27,'Sligo','ie','Ireland'),(3411,28,'Swords','ie','Ireland'),(3412,29,'Tralee','ie','Ireland'),(3413,30,'Tullamore','ie','Ireland'),(3414,31,'Waterford','ie','Ireland'),(3415,32,'Wexford','ie','Ireland'),(3416,33,'Wicklow','ie','Ireland'),(3417,1,'Ashdod','il','Israel'),(3418,2,'Ashqelon','il','Israel'),(3419,3,'Bat Yam','il','Israel'),(3420,4,'Be\'er Sheva','il','Israel'),(3421,5,'Bene Beraq','il','Israel'),(3422,6,'Herzeliyya','il','Israel'),(3423,7,'Kefar Sava','il','Israel'),(3424,8,'Khadera','il','Israel'),(3425,9,'Khefa','il','Israel'),(3426,10,'Kholon','il','Israel'),(3427,11,'Lod','il','Israel'),(3428,12,'Nazerat','il','Israel'),(3429,13,'Netanya','il','Israel'),(3430,14,'Petakh Tiqwa','il','Israel'),(3431,15,'Ra\'anana','il','Israel'),(3432,16,'Ramat Gan','il','Israel'),(3433,17,'Ramla','il','Israel'),(3434,18,'Rekhovot','il','Israel'),(3435,19,'Rishon LeZiyyon','il','Israel'),(3436,20,'Tel Aviv-Yafo','il','Israel'),(3437,21,'Yerushalayim','il','Israel'),(3438,1,'Ancona','it','Italy'),(3439,2,'Bari','it','Italy'),(3440,3,'Bergamo','it','Italy'),(3441,4,'Bologna','it','Italy'),(3442,5,'Brescia','it','Italy'),(3443,6,'Cagliari','it','Italy'),(3444,7,'Catania','it','Italy'),(3445,8,'Ferrara','it','Italy'),(3446,9,'Firenze','it','Italy'),(3447,10,'Foggia','it','Italy'),(3448,11,'Forlì','it','Italy'),(3449,12,'Genova','it','Italy'),(3450,13,'Latina','it','Italy'),(3451,14,'Livorno','it','Italy'),(3452,15,'Messina','it','Italy'),(3453,16,'Milano','it','Italy'),(3454,17,'Modena','it','Italy'),(3455,18,'Monza','it','Italy'),(3456,19,'Napoli','it','Italy'),(3457,20,'Novara','it','Italy'),(3458,21,'Padova','it','Italy'),(3459,22,'Palermo','it','Italy'),(3460,23,'Parma','it','Italy'),(3461,24,'Perugia','it','Italy'),(3462,25,'Pescara','it','Italy'),(3463,26,'Prato','it','Italy'),(3464,27,'Ravenna','it','Italy'),(3465,28,'Reggio di Calabria','it','Italy'),(3466,29,'Reggio nell\'Emilia','it','Italy'),(3467,30,'Rimini','it','Italy'),(3468,31,'Roma','it','Italy'),(3469,32,'Salerno','it','Italy'),(3470,33,'Sassari','it','Italy'),(3471,34,'Siracusa','it','Italy'),(3472,35,'Taranto','it','Italy'),(3473,36,'Terni','it','Italy'),(3474,37,'Torino','it','Italy'),(3475,38,'Trento','it','Italy'),(3476,39,'Trieste','it','Italy'),(3477,40,'Venezia','it','Italy'),(3478,41,'Verona','it','Italy'),(3479,42,'Vicenza','it','Italy'),(3480,1,'Abengourou','ci','Ivory Coast'),(3481,2,'Abidjan','ci','Ivory Coast'),(3482,3,'Agboville','ci','Ivory Coast'),(3483,4,'Anyama','ci','Ivory Coast'),(3484,5,'Bingerville','ci','Ivory Coast'),(3485,6,'Bondoukou','ci','Ivory Coast'),(3486,7,'Bouaflé','ci','Ivory Coast'),(3487,8,'Bouaké','ci','Ivory Coast'),(3488,9,'Dabou','ci','Ivory Coast'),(3489,10,'Daloa','ci','Ivory Coast'),(3490,11,'Danané','ci','Ivory Coast'),(3491,12,'Dimbokro','ci','Ivory Coast'),(3492,13,'Divo','ci','Ivory Coast'),(3493,14,'Gagnoa','ci','Ivory Coast'),(3494,15,'Grand Bassam','ci','Ivory Coast'),(3495,16,'Korhogo','ci','Ivory Coast'),(3496,17,'Man','ci','Ivory Coast'),(3497,18,'Odienné','ci','Ivory Coast'),(3498,19,'San-Pédro','ci','Ivory Coast'),(3499,20,'Séguéla','ci','Ivory Coast'),(3500,21,'Sinfra','ci','Ivory Coast'),(3501,22,'Touba','ci','Ivory Coast'),(3502,23,'Yamoussoukro','ci','Ivory Coast'),(3503,1,'Anchovy','jm','Jamaica'),(3504,2,'Anotto Bay','jm','Jamaica'),(3505,3,'Bamboo','jm','Jamaica'),(3506,4,'Black River','jm','Jamaica'),(3507,5,'Brown\'s Town','jm','Jamaica'),(3508,6,'Bull Savanna','jm','Jamaica'),(3509,7,'Falmouth','jm','Jamaica'),(3510,8,'Half Way Tree','jm','Jamaica'),(3511,9,'Kingston','jm','Jamaica'),(3512,10,'Lucea','jm','Jamaica'),(3513,11,'Mandeville','jm','Jamaica'),(3514,12,'May Pen','jm','Jamaica'),(3515,13,'Montego Bay','jm','Jamaica'),(3516,14,'Morant Bay','jm','Jamaica'),(3517,15,'Ocho Rios','jm','Jamaica'),(3518,16,'Port Antonio','jm','Jamaica'),(3519,17,'Port Maria','jm','Jamaica'),(3520,18,'Portmore','jm','Jamaica'),(3521,19,'Saint Ann\'s Bay','jm','Jamaica'),(3522,20,'Savanna la Mar','jm','Jamaica'),(3523,21,'Spanish Town','jm','Jamaica'),(3524,1,'Abiko','jp','Japan'),(3525,2,'Ageo','jp','Japan'),(3526,3,'Aizuwakamatsu','jp','Japan'),(3527,4,'Akashi','jp','Japan'),(3528,5,'Akishima','jp','Japan'),(3529,6,'Akita','jp','Japan'),(3530,7,'Amagasaki','jp','Japan'),(3531,8,'Anjô','jp','Japan'),(3532,9,'Aomori','jp','Japan'),(3533,10,'Asahikawa','jp','Japan'),(3534,11,'Asaka','jp','Japan'),(3535,12,'Ashikaga','jp','Japan'),(3536,13,'Atsugi','jp','Japan'),(3537,14,'Beppu','jp','Japan'),(3538,15,'Chiba','jp','Japan'),(3539,16,'Chigasaki','jp','Japan'),(3540,17,'Chôfu','jp','Japan'),(3541,18,'Daitô','jp','Japan'),(3542,19,'Ebetsu','jp','Japan'),(3543,20,'Ebina','jp','Japan'),(3544,21,'Fuchû','jp','Japan'),(3545,22,'Fuji','jp','Japan'),(3546,23,'Fujieda','jp','Japan'),(3547,24,'Fujimi','jp','Japan'),(3548,25,'Fujinomiya','jp','Japan'),(3549,26,'Fujisawa','jp','Japan'),(3550,27,'Fukaya','jp','Japan'),(3551,28,'Fukui','jp','Japan'),(3552,29,'Fukuoka','jp','Japan'),(3553,30,'Fukushima','jp','Japan'),(3554,31,'Fukuyama','jp','Japan'),(3555,32,'Funabashi','jp','Japan'),(3556,33,'Gifu','jp','Japan'),(3557,34,'Habikino','jp','Japan'),(3558,35,'Hachinohe','jp','Japan'),(3559,36,'Hachiôji','jp','Japan'),(3560,37,'Hadano','jp','Japan'),(3561,38,'Hakodate','jp','Japan'),(3562,39,'Hamamatsu','jp','Japan'),(3563,40,'Handa','jp','Japan'),(3564,41,'Higashihiroshima','jp','Japan'),(3565,42,'Higashikurume','jp','Japan'),(3566,43,'Higashimurayama','jp','Japan'),(3567,44,'Higashiôsaka','jp','Japan'),(3568,45,'Hikone','jp','Japan'),(3569,46,'Himeji','jp','Japan'),(3570,47,'Hino','jp','Japan'),(3571,48,'Hirakata','jp','Japan'),(3572,49,'Hiratsuka','jp','Japan'),(3573,50,'Hirosaki','jp','Japan'),(3574,51,'Hiroshima','jp','Japan'),(3575,52,'Hitachi','jp','Japan'),(3576,53,'Hitachinaka','jp','Japan'),(3577,54,'Hôfu','jp','Japan'),(3578,55,'Hôya','jp','Japan'),(3579,56,'Ibaraki','jp','Japan'),(3580,57,'Ichihara','jp','Japan'),(3581,58,'Ichikawa','jp','Japan'),(3582,59,'Ichinomiya','jp','Japan'),(3583,60,'Iida','jp','Japan'),(3584,61,'Ikeda','jp','Japan'),(3585,62,'Ikoma','jp','Japan'),(3586,63,'Imabari','jp','Japan'),(3587,64,'Inazawa','jp','Japan'),(3588,65,'Iruma','jp','Japan'),(3589,66,'Isehara','jp','Japan'),(3590,67,'Isesaki','jp','Japan'),(3591,68,'Ishinomaki','jp','Japan'),(3592,69,'Itami','jp','Japan'),(3593,70,'Iwaki','jp','Japan'),(3594,71,'Iwakuni','jp','Japan'),(3595,72,'Iwatsuki','jp','Japan'),(3596,73,'Izumi','jp','Japan'),(3597,74,'Jôetsu','jp','Japan'),(3598,75,'Kadoma','jp','Japan'),(3599,76,'Kagoshima','jp','Japan'),(3600,77,'Kakamigahara','jp','Japan'),(3601,78,'Kakogawa','jp','Japan'),(3602,79,'Kamagaya','jp','Japan'),(3603,80,'Kamakura','jp','Japan'),(3604,81,'Kanazawa','jp','Japan'),(3605,82,'Kariya','jp','Japan'),(3606,83,'Kashihara','jp','Japan'),(3607,84,'Kashiwa','jp','Japan'),(3608,85,'Kasuga','jp','Japan'),(3609,86,'Kasugai','jp','Japan'),(3610,87,'Kasukabe','jp','Japan'),(3611,88,'Kawachinagano','jp','Japan'),(3612,89,'Kawagoe','jp','Japan'),(3613,90,'Kawaguchi','jp','Japan'),(3614,91,'Kawanishi','jp','Japan'),(3615,92,'Kawasaki','jp','Japan'),(3616,93,'Kiryû','jp','Japan'),(3617,94,'Kisarazu','jp','Japan'),(3618,95,'Kishiwada','jp','Japan'),(3619,96,'Kitakyûshû','jp','Japan'),(3620,97,'Kitami','jp','Japan'),(3621,98,'Kôbe','jp','Japan'),(3622,99,'Kôchi','jp','Japan'),(3623,100,'Kodaira','jp','Japan'),(3624,101,'Kôfu','jp','Japan'),(3625,102,'Koganei','jp','Japan'),(3626,103,'Kokubunji','jp','Japan'),(3627,104,'Komaki','jp','Japan'),(3628,105,'Komatsu','jp','Japan'),(3629,106,'Kôriyama','jp','Japan'),(3630,107,'Koshigaya','jp','Japan'),(3631,108,'Kumagaya','jp','Japan'),(3632,109,'Kumamoto','jp','Japan'),(3633,110,'Kurashiki','jp','Japan'),(3634,111,'Kure','jp','Japan'),(3635,112,'Kurume','jp','Japan'),(3636,113,'Kusatsu','jp','Japan'),(3637,114,'Kushiro','jp','Japan'),(3638,115,'Kuwana','jp','Japan'),(3639,116,'Kyôto','jp','Japan'),(3640,117,'Machida','jp','Japan'),(3641,118,'Maebashi','jp','Japan'),(3642,119,'Matsubara','jp','Japan'),(3643,120,'Matsudo','jp','Japan'),(3644,121,'Matsue','jp','Japan'),(3645,122,'Matsumoto','jp','Japan'),(3646,123,'Matsusaka','jp','Japan'),(3647,124,'Matsuyama','jp','Japan'),(3648,125,'Minô','jp','Japan'),(3649,126,'Misato','jp','Japan'),(3650,127,'Mishima','jp','Japan'),(3651,128,'Mitaka','jp','Japan'),(3652,129,'Mito','jp','Japan'),(3653,130,'Miyakonojô','jp','Japan'),(3654,131,'Miyazaki','jp','Japan'),(3655,132,'Moriguchi','jp','Japan'),(3656,133,'Morioka','jp','Japan'),(3657,134,'Muroran','jp','Japan'),(3658,135,'Musashino','jp','Japan'),(3659,136,'Nagano','jp','Japan'),(3660,137,'Nagaoka','jp','Japan'),(3661,138,'Nagareyama','jp','Japan'),(3662,139,'Nagasaki','jp','Japan'),(3663,140,'Nagoya','jp','Japan'),(3664,141,'Naha','jp','Japan'),(3665,142,'Nara','jp','Japan'),(3666,143,'Narashino','jp','Japan'),(3667,144,'Neyagawa','jp','Japan'),(3668,145,'Niigata','jp','Japan'),(3669,146,'Niihama','jp','Japan'),(3670,147,'Niiza','jp','Japan'),(3671,148,'Nishinomiya','jp','Japan'),(3672,149,'Nishio','jp','Japan'),(3673,150,'Nobeoka','jp','Japan'),(3674,151,'Noda','jp','Japan'),(3675,152,'Numazu','jp','Japan'),(3676,153,'Obihiro','jp','Japan'),(3677,154,'Odawara','jp','Japan'),(3678,155,'Ôgaki','jp','Japan'),(3679,156,'Ôita','jp','Japan'),(3680,157,'Okayama','jp','Japan'),(3681,158,'Okazaki','jp','Japan'),(3682,159,'Okinawa','jp','Japan'),(3683,160,'Ôme','jp','Japan'),(3684,161,'Ômiya','jp','Japan'),(3685,162,'Ômuta','jp','Japan'),(3686,163,'Ôsaka','jp','Japan'),(3687,164,'Ôta','jp','Japan'),(3688,165,'Otaru','jp','Japan'),(3689,166,'Ôtsu','jp','Japan'),(3690,167,'Oyama','jp','Japan'),(3691,168,'Saga','jp','Japan'),(3692,169,'Sagamihara','jp','Japan'),(3693,170,'Sakai','jp','Japan'),(3694,171,'Sakata','jp','Japan'),(3695,172,'Sakura','jp','Japan'),(3696,173,'Sanda','jp','Japan'),(3697,174,'Sapporo','jp','Japan'),(3698,175,'Sasebo','jp','Japan'),(3699,176,'Sayama','jp','Japan'),(3700,177,'Sendai','jp','Japan'),(3701,178,'Seto','jp','Japan'),(3702,179,'Shimizu','jp','Japan'),(3703,180,'Shimonoseki','jp','Japan'),(3704,181,'Shizuoka','jp','Japan'),(3705,182,'Sôka','jp','Japan'),(3706,183,'Suita','jp','Japan'),(3707,184,'Suzuka','jp','Japan'),(3708,185,'Tachikawa','jp','Japan'),(3709,186,'Tajimi','jp','Japan'),(3710,187,'Takamatsu','jp','Japan'),(3711,188,'Takaoka','jp','Japan'),(3712,189,'Takarazuka','jp','Japan'),(3713,190,'Takasaki','jp','Japan'),(3714,191,'Takatsuki','jp','Japan'),(3715,192,'Tama','jp','Japan'),(3716,193,'Toda','jp','Japan'),(3717,194,'Tokai','jp','Japan'),(3718,195,'Tokorozawa','jp','Japan'),(3719,196,'Tokushima','jp','Japan'),(3720,197,'Tokuyama','jp','Japan'),(3721,198,'Tôkyô','jp','Japan'),(3722,199,'Tomakomai','jp','Japan'),(3723,200,'Tondabayashi','jp','Japan'),(3724,201,'Tottori','jp','Japan'),(3725,202,'Toyama','jp','Japan'),(3726,203,'Toyohashi','jp','Japan'),(3727,204,'Toyokawa','jp','Japan'),(3728,205,'Toyonaka','jp','Japan'),(3729,206,'Toyota','jp','Japan'),(3730,207,'Tsu','jp','Japan'),(3731,208,'Tsuchiura','jp','Japan'),(3732,209,'Tsukuba','jp','Japan'),(3733,210,'Tsuruoka','jp','Japan'),(3734,211,'Ube','jp','Japan'),(3735,212,'Ueda','jp','Japan'),(3736,213,'Uji','jp','Japan'),(3737,214,'Urasoe','jp','Japan'),(3738,215,'Urawa','jp','Japan'),(3739,216,'Urayasu','jp','Japan'),(3740,217,'Utsunomiya','jp','Japan'),(3741,218,'Wakayama','jp','Japan'),(3742,219,'Yachiyo','jp','Japan'),(3743,220,'Yaizu','jp','Japan'),(3744,221,'Yamagata','jp','Japan'),(3745,222,'Yamaguchi','jp','Japan'),(3746,223,'Yamato','jp','Japan'),(3747,224,'Yao','jp','Japan'),(3748,225,'Yatsushiro','jp','Japan'),(3749,226,'Yokkaichi','jp','Japan'),(3750,227,'Yokohama','jp','Japan'),(3751,228,'Yokosuka','jp','Japan'),(3752,229,'Yonago','jp','Japan'),(3753,230,'Zama','jp','Japan'),(3754,1,'Grouville','xj','Jersey'),(3755,2,'Saint Brelade','xj','Jersey'),(3756,3,'Saint Clement','xj','Jersey'),(3757,4,'Saint Helier','xj','Jersey'),(3758,5,'Saint John','xj','Jersey'),(3759,6,'Saint Lawrence','xj','Jersey'),(3760,7,'Saint Martin','xj','Jersey'),(3761,8,'Saint Mary','xj','Jersey'),(3762,9,'Saint Ouen','xj','Jersey'),(3763,10,'Saint Peter','xj','Jersey'),(3764,11,'Saint Saviour','xj','Jersey'),(3765,12,'Trinity','xj','Jersey'),(3766,1,'´Ajlûn','jo','Jordan'),(3767,2,'´Ammân','jo','Jordan'),(3768,3,'Abû ´Alandâ','jo','Jordan'),(3769,4,'al-´Aqabah','jo','Jordan'),(3770,5,'al-Baq´ah','jo','Jordan'),(3771,6,'al-Jubayhah','jo','Jordan'),(3772,7,'al-Karak','jo','Jordan'),(3773,8,'al-Mafraq','jo','Jordan'),(3774,9,'al-Quwaysimah','jo','Jordan'),(3775,10,'ar-Ramtha','jo','Jordan'),(3776,11,'ar-Russayfah','jo','Jordan'),(3777,12,'as-Salt','jo','Jordan'),(3778,13,'at-Tafîlah','jo','Jordan'),(3779,14,'az-Zarqâ\'','jo','Jordan'),(3780,15,'Irbid','jo','Jordan'),(3781,16,'Jarash','jo','Jordan'),(3782,17,'Khalda wa Tilâ´-al-´Alî','jo','Jordan'),(3783,18,'Ma´ân','jo','Jordan'),(3784,19,'Mâdabâ','jo','Jordan'),(3785,20,'Mushayrfat Râs al-´Ayn','jo','Jordan'),(3786,21,'Sahâb','jo','Jordan'),(3787,22,'Shnillar','jo','Jordan'),(3788,23,'Suwaylih','jo','Jordan'),(3789,24,'Târiq','jo','Jordan'),(3790,25,'Wâdî as-Sîr','jo','Jordan'),(3791,1,'Akmeçet','kz','Kazakhstan'),(3792,2,'Aktaû','kz','Kazakhstan'),(3793,3,'Aktöbe','kz','Kazakhstan'),(3794,4,'Almati','kz','Kazakhstan'),(3795,5,'Astana','kz','Kazakhstan'),(3796,6,'Atiraû','kz','Kazakhstan'),(3797,7,'Èkibastuz','kz','Kazakhstan'),(3798,8,'Karaganda','kz','Kazakhstan'),(3799,9,'Kostanay','kz','Kazakhstan'),(3800,10,'Köksetaû','kz','Kazakhstan'),(3801,11,'Oral','kz','Kazakhstan'),(3802,12,'Öskemen','kz','Kazakhstan'),(3803,13,'Pavlodar','kz','Kazakhstan'),(3804,14,'Petropavl','kz','Kazakhstan'),(3805,15,'Rûdni','kz','Kazakhstan'),(3806,16,'Semey','kz','Kazakhstan'),(3807,17,'Simkent','kz','Kazakhstan'),(3808,18,'Taldikorgan','kz','Kazakhstan'),(3809,19,'Taraz','kz','Kazakhstan'),(3810,20,'Temirtaû','kz','Kazakhstan'),(3811,1,'Eldoret','ke','Kenya'),(3812,2,'Embu','ke','Kenya'),(3813,3,'Garissa','ke','Kenya'),(3814,4,'Homa Bay','ke','Kenya'),(3815,5,'Kakamega','ke','Kenya'),(3816,6,'Kericho','ke','Kenya'),(3817,7,'Kisii','ke','Kenya'),(3818,8,'Kisumu','ke','Kenya'),(3819,9,'Kitale','ke','Kenya'),(3820,10,'Machakos','ke','Kenya'),(3821,11,'Maragua','ke','Kenya'),(3822,12,'Meru','ke','Kenya'),(3823,13,'Mombasa','ke','Kenya'),(3824,14,'Muranga','ke','Kenya'),(3825,15,'Nairobi','ke','Kenya'),(3826,16,'Naivasha','ke','Kenya'),(3827,17,'Nakuru','ke','Kenya'),(3828,18,'Nyeri','ke','Kenya'),(3829,19,'Thika','ke','Kenya'),(3830,20,'Webuye','ke','Kenya'),(3831,1,'Abaokoro','ki','Kiribati'),(3832,2,'Bairiki','ki','Kiribati'),(3833,3,'Bikenibeu','ki','Kiribati'),(3834,4,'Binoinano','ki','Kiribati'),(3835,5,'Bonriki','ki','Kiribati'),(3836,6,'Buariki','ki','Kiribati'),(3837,7,'Buariki','ki','Kiribati'),(3838,8,'Butaritari','ki','Kiribati'),(3839,9,'Ijaki','ki','Kiribati'),(3840,10,'London','ki','Kiribati'),(3841,11,'Makin','ki','Kiribati'),(3842,12,'Nabari','ki','Kiribati'),(3843,13,'Ooma','ki','Kiribati'),(3844,14,'Pyramid Point','ki','Kiribati'),(3845,15,'Rawannawi','ki','Kiribati'),(3846,16,'Roreti','ki','Kiribati'),(3847,17,'Rungata','ki','Kiribati'),(3848,18,'Tabiauea','ki','Kiribati'),(3849,19,'Tabontebike','ki','Kiribati'),(3850,20,'Tabukiniberu','ki','Kiribati'),(3851,21,'Taburao','ki','Kiribati'),(3852,22,'Takaeang','ki','Kiribati'),(3853,23,'Temaraia','ki','Kiribati'),(3854,24,'Utiroa','ki','Kiribati'),(3855,25,'Washington','ki','Kiribati'),(3856,1,'Cheongjin','kp','Korea (North)'),(3857,2,'Haeju','kp','Korea (North)'),(3858,3,'Hamheung','kp','Korea (North)'),(3859,4,'Hyesan','kp','Korea (North)'),(3860,5,'Kaeseong','kp','Korea (North)'),(3861,6,'Kanggye','kp','Korea (North)'),(3862,7,'Kimchaek','kp','Korea (North)'),(3863,8,'Najin','kp','Korea (North)'),(3864,9,'Nampo','kp','Korea (North)'),(3865,10,'Phyeongseong','kp','Korea (North)'),(3866,11,'Pyeongyang','kp','Korea (North)'),(3867,12,'Sariweon','kp','Korea (North)'),(3868,13,'Seongnim','kp','Korea (North)'),(3869,14,'Sineuiju','kp','Korea (North)'),(3870,15,'Weonsan','kp','Korea (North)'),(3871,1,'Andong','kr','Korea (South)'),(3872,2,'Ansan','kr','Korea (South)'),(3873,3,'Anyang','kr','Korea (South)'),(3874,4,'Changweon','kr','Korea (South)'),(3875,5,'Chechon','kr','Korea (South)'),(3876,6,'Cheju','kr','Korea (South)'),(3877,7,'Cheonan','kr','Korea (South)'),(3878,8,'Cheongju','kr','Korea (South)'),(3879,9,'Cheonju','kr','Korea (South)'),(3880,10,'Chinhae','kr','Korea (South)'),(3881,11,'Chinju','kr','Korea (South)'),(3882,12,'Chuncheon','kr','Korea (South)'),(3883,13,'Chungju','kr','Korea (South)'),(3884,14,'Euijeongbu','kr','Korea (South)'),(3885,15,'Euiwang','kr','Korea (South)'),(3886,16,'Hanam','kr','Korea (South)'),(3887,17,'Iksan','kr','Korea (South)'),(3888,18,'Incheon','kr','Korea (South)'),(3889,19,'Kangneung','kr','Korea (South)'),(3890,20,'Kimhae','kr','Korea (South)'),(3891,21,'Koyang','kr','Korea (South)'),(3892,22,'Kumi','kr','Korea (South)'),(3893,23,'Kunpo','kr','Korea (South)'),(3894,24,'Kunsan','kr','Korea (South)'),(3895,25,'Kuri','kr','Korea (South)'),(3896,26,'Kwangju','kr','Korea (South)'),(3897,27,'Kwangmyeong','kr','Korea (South)'),(3898,28,'Kyeongju','kr','Korea (South)'),(3899,29,'Masan','kr','Korea (South)'),(3900,30,'Mokpo','kr','Korea (South)'),(3901,31,'Pohang','kr','Korea (South)'),(3902,32,'Poryong','kr','Korea (South)'),(3903,33,'Pucheon','kr','Korea (South)'),(3904,34,'Pusan','kr','Korea (South)'),(3905,35,'Pyeongtaek','kr','Korea (South)'),(3906,36,'Seongnam','kr','Korea (South)'),(3907,37,'Seoul','kr','Korea (South)'),(3908,38,'Shiheung','kr','Korea (South)'),(3909,39,'Suncheon','kr','Korea (South)'),(3910,40,'Suweon','kr','Korea (South)'),(3911,41,'Taegu','kr','Korea (South)'),(3912,42,'Taejeon','kr','Korea (South)'),(3913,43,'Tongyong','kr','Korea (South)'),(3914,44,'Ulsan','kr','Korea (South)'),(3915,45,'Weonju','kr','Korea (South)'),(3916,46,'Yeosu','kr','Korea (South)'),(3917,1,'Abraq Khîtân','kw','Kuwait'),(3918,2,'al-Ahmadî','kw','Kuwait'),(3919,3,'al-Farwânîyah','kw','Kuwait'),(3920,4,'al-Fuhayhîl','kw','Kuwait'),(3921,5,'al-Jabirîyah','kw','Kuwait'),(3922,6,'al-Jahrâ','kw','Kuwait'),(3923,7,'al-Karîm','kw','Kuwait'),(3924,8,'al-Kuwayt','kw','Kuwait'),(3925,9,'al-Qusayr','kw','Kuwait'),(3926,10,'Ardîyah','kw','Kuwait'),(3927,11,'ar-Riqqah','kw','Kuwait'),(3928,12,'ar-Rumaythiyah','kw','Kuwait'),(3929,13,'as-Sabahîyah','kw','Kuwait'),(3930,14,'as-Sâlimîyah','kw','Kuwait'),(3931,15,'as-Sulaybîyah','kw','Kuwait'),(3932,16,'Fardaws','kw','Kuwait'),(3933,17,'Hawallî','kw','Kuwait'),(3934,18,'Jalîb ash-Shuyûh','kw','Kuwait'),(3935,19,'Khîtân-al-Janûbîyah','kw','Kuwait'),(3936,20,'Salwâ\'','kw','Kuwait'),(3937,21,'Subbah-as-Salim','kw','Kuwait'),(3938,22,'Tayma´','kw','Kuwait'),(3939,1,'Balykchy','kg','Kyrgyzstan'),(3940,2,'Batken','kg','Kyrgyzstan'),(3941,3,'Bazarkurgon','kg','Kyrgyzstan'),(3942,4,'Belovodskoye','kg','Kyrgyzstan'),(3943,5,'Bishkek','kg','Kyrgyzstan'),(3944,6,'Chui','kg','Kyrgyzstan'),(3945,7,'Jalal-Abad','kg','Kyrgyzstan'),(3946,8,'Kant','kg','Kyrgyzstan'),(3947,9,'Karabalta','kg','Kyrgyzstan'),(3948,10,'Karakol','kg','Kyrgyzstan'),(3949,11,'Kara-Suu','kg','Kyrgyzstan'),(3950,12,'Kemin','kg','Kyrgyzstan'),(3951,13,'Kyzyl-Kiya','kg','Kyrgyzstan'),(3952,14,'Mingkush','kg','Kyrgyzstan'),(3953,15,'Naryn','kg','Kyrgyzstan'),(3954,16,'Osh','kg','Kyrgyzstan'),(3955,17,'Sokuluk','kg','Kyrgyzstan'),(3956,18,'Talas','kg','Kyrgyzstan'),(3957,19,'Tash-Kumyr','kg','Kyrgyzstan'),(3958,20,'Tokmok','kg','Kyrgyzstan'),(3959,21,'Uzgen','kg','Kyrgyzstan'),(3960,1,'Ban Nahin','la','Laos'),(3961,2,'Champasak','la','Laos'),(3962,3,'Huayxay','la','Laos'),(3963,4,'Luang Prabang','la','Laos'),(3964,5,'Muang Khong','la','Laos'),(3965,6,'Muang Khongxedon','la','Laos'),(3966,7,'Muang Sing','la','Laos'),(3967,8,'Muang Vangviang','la','Laos'),(3968,9,'Nam Tha','la','Laos'),(3969,10,'Pakxan','la','Laos'),(3970,11,'Pakxe','la','Laos'),(3971,12,'Pek','la','Laos'),(3972,13,'Phongsaly','la','Laos'),(3973,14,'Phonhong','la','Laos'),(3974,15,'Samakhixai','la','Laos'),(3975,16,'Saravan','la','Laos'),(3976,17,'Savannakhet','la','Laos'),(3977,18,'Sekong','la','Laos'),(3978,19,'Thakek','la','Laos'),(3979,20,'Viangchan','la','Laos'),(3980,21,'Xaignabury','la','Laos'),(3981,22,'Xam Nua','la','Laos'),(3982,1,'Aizkraukle','lv','Latvia'),(3983,2,'Alûksne','lv','Latvia'),(3984,3,'Balvi','lv','Latvia'),(3985,4,'Bauska','lv','Latvia'),(3986,5,'Cêsis','lv','Latvia'),(3987,6,'Daugavpils','lv','Latvia'),(3988,7,'Dôbele','lv','Latvia'),(3989,8,'Gulbene','lv','Latvia'),(3990,9,'Jêkabspils','lv','Latvia'),(3991,10,'Jelgava','lv','Latvia'),(3992,11,'Jûrmala','lv','Latvia'),(3993,12,'Krâslava','lv','Latvia'),(3994,13,'Kuldîga','lv','Latvia'),(3995,14,'Liepâja','lv','Latvia'),(3996,15,'Limbazhi','lv','Latvia'),(3997,16,'Ludza','lv','Latvia'),(3998,17,'Madona','lv','Latvia'),(3999,18,'Ogre','lv','Latvia'),(4000,19,'Olaine','lv','Latvia'),(4001,20,'Preili','lv','Latvia'),(4002,21,'Rêzekne','lv','Latvia'),(4003,22,'Rîga','lv','Latvia'),(4004,23,'Salaspils','lv','Latvia'),(4005,24,'Saldus','lv','Latvia'),(4006,25,'Talsi','lv','Latvia'),(4007,26,'Tukums','lv','Latvia'),(4008,27,'Valka','lv','Latvia'),(4009,28,'Valmiera','lv','Latvia'),(4010,29,'Ventspils','lv','Latvia'),(4011,1,'´Âlayh','lb','Lebanon'),(4012,2,'al-Batrun','lb','Lebanon'),(4013,3,'al-Hirmil','lb','Lebanon'),(4014,4,'an-Nabatîyat-at-Tahtâ','lb','Lebanon'),(4015,5,'B´abda','lb','Lebanon'),(4016,6,'Ba´labakk','lb','Lebanon'),(4017,7,'Bayrût','lb','Lebanon'),(4018,8,'Jazzîn','lb','Lebanon'),(4019,9,'Jubayl','lb','Lebanon'),(4020,10,'Jubb Jannin','lb','Lebanon'),(4021,11,'Jûniyah','lb','Lebanon'),(4022,12,'Juwayyâ','lb','Lebanon'),(4023,13,'Marj ´Uyun','lb','Lebanon'),(4024,14,'Râshayyâ','lb','Lebanon'),(4025,15,'Rîyâk','lb','Lebanon'),(4026,16,'Saydâ\'','lb','Lebanon'),(4027,17,'Sûr','lb','Lebanon'),(4028,18,'Tarâbulus ash-Sham','lb','Lebanon'),(4029,19,'Zahlah','lb','Lebanon'),(4030,1,'Butha Buthe','ls','Lesotho'),(4031,2,'Hlotse','ls','Lesotho'),(4032,3,'Mafeteng','ls','Lesotho'),(4033,4,'Maputsoa','ls','Lesotho'),(4034,5,'Maseru','ls','Lesotho'),(4035,6,'Mohale\'s Hoek','ls','Lesotho'),(4036,7,'Mokhotlong','ls','Lesotho'),(4037,8,'Qacha\'s Nek','ls','Lesotho'),(4038,9,'Quthing','ls','Lesotho'),(4039,10,'Teyateyaneng','ls','Lesotho'),(4040,11,'Thaba-Tseka','ls','Lesotho'),(4041,1,'Barclayville','lr','Liberia'),(4042,2,'Bensonville','lr','Liberia'),(4043,3,'Buchanan','lr','Liberia'),(4044,4,'Ganta','lr','Liberia'),(4045,5,'Gbarnga','lr','Liberia'),(4046,6,'Greenville','lr','Liberia'),(4047,7,'Harbel','lr','Liberia'),(4048,8,'Harper','lr','Liberia'),(4049,9,'Kakata','lr','Liberia'),(4050,10,'Monrovia','lr','Liberia'),(4051,11,'Rivercess','lr','Liberia'),(4052,12,'Robertsport','lr','Liberia'),(4053,13,'Sanniquellie','lr','Liberia'),(4054,14,'Tapeta','lr','Liberia'),(4055,15,'Tubmanburg','lr','Liberia'),(4056,16,'Voinjama','lr','Liberia'),(4057,17,'Yekepa','lr','Liberia'),(4058,18,'Zwedru','lr','Liberia'),(4059,1,'Ajdâbiyâ','ly','Libya'),(4060,2,'al-Azîzîyah','ly','Libya'),(4061,3,'al-Baydâ','ly','Libya'),(4062,4,'al-Jawf','ly','Libya'),(4063,5,'al-Khums','ly','Libya'),(4064,6,'al-Marj','ly','Libya'),(4065,7,'Awbâri','ly','Libya'),(4066,8,'az-Zâwiyah','ly','Libya'),(4067,9,'Banghâzî','ly','Libya'),(4068,10,'Banî Walîd','ly','Libya'),(4069,11,'Birâk','ly','Libya'),(4070,12,'Darnah','ly','Libya'),(4071,13,'Ghadâmis','ly','Libya'),(4072,14,'Gharyân','ly','Libya'),(4073,15,'Misrâtah','ly','Libya'),(4074,16,'Murzûq','ly','Libya'),(4075,17,'Sabhâ','ly','Libya'),(4076,18,'Sabrâtah','ly','Libya'),(4077,19,'Surt','ly','Libya'),(4078,20,'Tarâbulus','ly','Libya'),(4079,21,'Tarhûnah','ly','Libya'),(4080,22,'Tubruq','ly','Libya'),(4081,23,'Waddân','ly','Libya'),(4082,24,'Yafran','ly','Libya'),(4083,25,'Zlîtan','ly','Libya'),(4084,26,'Zuwârah','ly','Libya'),(4085,1,'Balzers','li','Liechtenstein'),(4086,2,'Eschen','li','Liechtenstein'),(4087,3,'Gamprin','li','Liechtenstein'),(4088,4,'Mauren','li','Liechtenstein'),(4089,5,'Planken','li','Liechtenstein'),(4090,6,'Ruggell','li','Liechtenstein'),(4091,7,'Schaan','li','Liechtenstein'),(4092,8,'Schellenberg','li','Liechtenstein'),(4093,9,'Triesen','li','Liechtenstein'),(4094,10,'Triesenberg','li','Liechtenstein'),(4095,11,'Vaduz','li','Liechtenstein'),(4096,1,'Alytus','lt','Lithuania'),(4097,2,'Druskininkai','lt','Lithuania'),(4098,3,'Jonava','lt','Lithuania'),(4099,4,'Kaunas','lt','Lithuania'),(4100,5,'Kedainiai','lt','Lithuania'),(4101,6,'Klaipeda','lt','Lithuania'),(4102,7,'Kretinga','lt','Lithuania'),(4103,8,'Marijampole','lt','Lithuania'),(4104,9,'Mazheikiai','lt','Lithuania'),(4105,10,'Panevezhys','lt','Lithuania'),(4106,11,'Plunge','lt','Lithuania'),(4107,12,'Radvilishkis','lt','Lithuania'),(4108,13,'Shiauliai','lt','Lithuania'),(4109,14,'Shilute','lt','Lithuania'),(4110,15,'Taurage','lt','Lithuania'),(4111,16,'Telshiai','lt','Lithuania'),(4112,17,'Ukmerge','lt','Lithuania'),(4113,18,'Utena','lt','Lithuania'),(4114,19,'Vilnius','lt','Lithuania'),(4115,20,'Visaginas','lt','Lithuania'),(4116,1,'Bascharage','lu','Luxembourg'),(4117,2,'Belvaux','lu','Luxembourg'),(4118,3,'Bertrange','lu','Luxembourg'),(4119,4,'Bettembourg','lu','Luxembourg'),(4120,5,'Capellen','lu','Luxembourg'),(4121,6,'Clervaux','lu','Luxembourg'),(4122,7,'Diekirch','lu','Luxembourg'),(4123,8,'Differdange','lu','Luxembourg'),(4124,9,'Dudelange','lu','Luxembourg'),(4125,10,'Echternach','lu','Luxembourg'),(4126,11,'Esch-Alzette','lu','Luxembourg'),(4127,12,'Ettelbruck','lu','Luxembourg'),(4128,13,'Fousbann','lu','Luxembourg'),(4129,14,'Grevenmacher','lu','Luxembourg'),(4130,15,'Luxembourg','lu','Luxembourg'),(4131,16,'Mamer','lu','Luxembourg'),(4132,17,'Mersch','lu','Luxembourg'),(4133,18,'Obercorn','lu','Luxembourg'),(4134,19,'Pétange','lu','Luxembourg'),(4135,20,'Redange','lu','Luxembourg'),(4136,21,'Remich','lu','Luxembourg'),(4137,22,'Rodange','lu','Luxembourg'),(4138,23,'Schifflange','lu','Luxembourg'),(4139,24,'Soleuvre','lu','Luxembourg'),(4140,25,'Strassen','lu','Luxembourg'),(4141,26,'Vianden','lu','Luxembourg'),(4142,27,'Wiltz','lu','Luxembourg'),(4143,1,'Berovo','mk','Macedonia'),(4144,2,'Bitola','mk','Macedonia'),(4145,3,'Brod','mk','Macedonia'),(4146,4,'Debar','mk','Macedonia'),(4147,5,'Delchevo','mk','Macedonia'),(4148,6,'Demir Hisar','mk','Macedonia'),(4149,7,'Gevgelija','mk','Macedonia'),(4150,8,'Gostivar','mk','Macedonia'),(4151,9,'Kavadarci','mk','Macedonia'),(4152,10,'Kichevo','mk','Macedonia'),(4153,11,'Kochani','mk','Macedonia'),(4154,12,'Kratovo','mk','Macedonia'),(4155,13,'Kriva Palanka','mk','Macedonia'),(4156,14,'Krushevo','mk','Macedonia'),(4157,15,'Kumanovo','mk','Macedonia'),(4158,16,'Negotino','mk','Macedonia'),(4159,17,'Ohrid','mk','Macedonia'),(4160,18,'Prilep','mk','Macedonia'),(4161,19,'Probishtip','mk','Macedonia'),(4162,20,'Radovish','mk','Macedonia'),(4163,21,'Resen','mk','Macedonia'),(4164,22,'Saraj','mk','Macedonia'),(4165,23,'Shtip','mk','Macedonia'),(4166,24,'Skopje','mk','Macedonia'),(4167,25,'Struga','mk','Macedonia'),(4168,26,'Strumica','mk','Macedonia'),(4169,27,'Sveti Nikole','mk','Macedonia'),(4170,28,'Tetovo','mk','Macedonia'),(4171,29,'Valandovo','mk','Macedonia'),(4172,30,'Veles','mk','Macedonia'),(4173,31,'Vinica','mk','Macedonia'),(4174,1,'Ambatondrazaka','mg','Madagascar'),(4175,2,'Ambovombe','mg','Madagascar'),(4176,3,'Amparafaravola','mg','Madagascar'),(4177,4,'Antananarivo','mg','Madagascar'),(4178,5,'Antanifotsy','mg','Madagascar'),(4179,6,'Antsirabé','mg','Madagascar'),(4180,7,'Antsiranana','mg','Madagascar'),(4181,8,'Faratsiho','mg','Madagascar'),(4182,9,'Fianarantsoa','mg','Madagascar'),(4183,10,'Mahajanga','mg','Madagascar'),(4184,11,'Mahanoro','mg','Madagascar'),(4185,12,'Manakara','mg','Madagascar'),(4186,13,'Mananara','mg','Madagascar'),(4187,14,'Morondava','mg','Madagascar'),(4188,15,'Nosy Varika','mg','Madagascar'),(4189,16,'Soanierana Ivongo','mg','Madagascar'),(4190,17,'Soavinandriana','mg','Madagascar'),(4191,18,'Taolanaro','mg','Madagascar'),(4192,19,'Toamasina','mg','Madagascar'),(4193,20,'Toliary','mg','Madagascar'),(4194,1,'Balaka','mw','Malawi'),(4195,2,'Blantyre','mw','Malawi'),(4196,3,'Chikwawa','mw','Malawi'),(4197,4,'Chilumba','mw','Malawi'),(4198,5,'Chiradzulu','mw','Malawi'),(4199,6,'Chitipa','mw','Malawi'),(4200,7,'Dedza','mw','Malawi'),(4201,8,'Dowa','mw','Malawi'),(4202,9,'Karonga','mw','Malawi'),(4203,10,'Kasungu','mw','Malawi'),(4204,11,'Lilongwe','mw','Malawi'),(4205,12,'Liwonde','mw','Malawi'),(4206,13,'Machinga','mw','Malawi'),(4207,14,'Mangochi','mw','Malawi'),(4208,15,'Mchinji','mw','Malawi'),(4209,16,'Mponela','mw','Malawi'),(4210,17,'Mulanje','mw','Malawi'),(4211,18,'Mwanza','mw','Malawi'),(4212,19,'Mzimba','mw','Malawi'),(4213,20,'Mzuzu','mw','Malawi'),(4214,21,'Nkhata Bay','mw','Malawi'),(4215,22,'Nkhotakota','mw','Malawi'),(4216,23,'Nsanje','mw','Malawi'),(4217,24,'Ntcheu','mw','Malawi'),(4218,25,'Ntchisi','mw','Malawi'),(4219,26,'Phalombe','mw','Malawi'),(4220,27,'Rumphi','mw','Malawi'),(4221,28,'Salima','mw','Malawi'),(4222,29,'Thyolo','mw','Malawi'),(4223,30,'Zomba','mw','Malawi'),(4224,1,'Alor Setar','my','Malaysia'),(4225,2,'Ampang Jaya','my','Malaysia'),(4226,3,'Ayer Itam','my','Malaysia'),(4227,4,'Bandar Maharani','my','Malaysia'),(4228,5,'Bandar Penggaram','my','Malaysia'),(4229,6,'Batu Sembilan Cheras','my','Malaysia'),(4230,7,'Bintulu','my','Malaysia'),(4231,8,'Bukit Mertajam','my','Malaysia'),(4232,9,'Butterworth','my','Malaysia'),(4233,10,'Gelugor','my','Malaysia'),(4234,11,'Georgetown','my','Malaysia'),(4235,12,'Ipoh','my','Malaysia'),(4236,13,'Johor Bahru','my','Malaysia'),(4237,14,'Kajang-Sungai Chua','my','Malaysia'),(4238,15,'Kangar','my','Malaysia'),(4239,16,'Klang','my','Malaysia'),(4240,17,'Kluang','my','Malaysia'),(4241,18,'Kota Bahru','my','Malaysia'),(4242,19,'Kota Kinabalu','my','Malaysia'),(4243,20,'Kuala Lumpur','my','Malaysia'),(4244,21,'Kuala Terengganu','my','Malaysia'),(4245,22,'Kuantan','my','Malaysia'),(4246,23,'Kuching','my','Malaysia'),(4247,24,'Kulim','my','Malaysia'),(4248,25,'Labuan','my','Malaysia'),(4249,26,'Melaka','my','Malaysia'),(4250,27,'Miri','my','Malaysia'),(4251,28,'Petaling Jaya','my','Malaysia'),(4252,29,'Sandakan','my','Malaysia'),(4253,30,'Sekudai','my','Malaysia'),(4254,31,'Selayang Baru','my','Malaysia'),(4255,32,'Seremban','my','Malaysia'),(4256,33,'Shah Alam','my','Malaysia'),(4257,34,'Sibu','my','Malaysia'),(4258,35,'Subang Jaya','my','Malaysia'),(4259,36,'Sungai Ara','my','Malaysia'),(4260,37,'Sungai Petani','my','Malaysia'),(4261,38,'Taiping','my','Malaysia'),(4262,39,'Tawau','my','Malaysia'),(4263,1,'Dhidhdhoo','mv','Maldives'),(4264,2,'Eydhafushi','mv','Maldives'),(4265,3,'Felidhoo','mv','Maldives'),(4266,4,'Feydhoo','mv','Maldives'),(4267,5,'Fonadhoo','mv','Maldives'),(4268,6,'Funadhoo','mv','Maldives'),(4269,7,'Fuvammulah','mv','Maldives'),(4270,8,'Gamu','mv','Maldives'),(4271,9,'Hinnavaru','mv','Maldives'),(4272,10,'Hithadhoo','mv','Maldives'),(4273,11,'Hoarafushi','mv','Maldives'),(4274,12,'Ihavandhoo','mv','Maldives'),(4275,13,'Kadholhudhoo','mv','Maldives'),(4276,14,'Kudahuvadhoo','mv','Maldives'),(4277,15,'Kulhudhuffushi','mv','Maldives'),(4278,16,'Maafushi','mv','Maldives'),(4279,17,'Magoodhoo','mv','Maldives'),(4280,18,'Mahibadhoo','mv','Maldives'),(4281,19,'Malé','mv','Maldives'),(4282,20,'Manadhoo','mv','Maldives'),(4283,21,'Maradhoo','mv','Maldives'),(4284,22,'Muli','mv','Maldives'),(4285,23,'Naifaru','mv','Maldives'),(4286,24,'Rasdhoo','mv','Maldives'),(4287,25,'Thinadhoo','mv','Maldives'),(4288,26,'Thulhaadhoo','mv','Maldives'),(4289,27,'Thulusdhoo','mv','Maldives'),(4290,28,'Ugoofaaru','mv','Maldives'),(4291,29,'Velidhoo','mv','Maldives'),(4292,30,'Veymandhoo','mv','Maldives'),(4293,31,'Viligili','mv','Maldives'),(4294,1,'Bafoulabé','ml','Mali'),(4295,2,'Bamako','ml','Mali'),(4296,3,'Banamba','ml','Mali'),(4297,4,'Bougouni','ml','Mali'),(4298,5,'Djenné','ml','Mali'),(4299,6,'Gao','ml','Mali'),(4300,7,'Kati','ml','Mali'),(4301,8,'Kayes','ml','Mali'),(4302,9,'Kidal','ml','Mali'),(4303,10,'Kolokani','ml','Mali'),(4304,11,'Koulikoro','ml','Mali'),(4305,12,'Koutiala','ml','Mali'),(4306,13,'Markala','ml','Mali'),(4307,14,'Mopti','ml','Mali'),(4308,15,'Nara','ml','Mali'),(4309,16,'Niono','ml','Mali'),(4310,17,'Nioro','ml','Mali'),(4311,18,'San','ml','Mali'),(4312,19,'Ségou','ml','Mali'),(4313,20,'Sikasso','ml','Mali'),(4314,21,'Tombouctou','ml','Mali'),(4315,1,'Attard','mt','Malta'),(4316,2,'Birkirkara','mt','Malta'),(4317,3,'Birzebugia','mt','Malta'),(4318,4,'Fgura','mt','Malta'),(4319,5,'Gzira','mt','Malta'),(4320,6,'Hamrun','mt','Malta'),(4321,7,'Mosta','mt','Malta'),(4322,8,'Naxxar','mt','Malta'),(4323,9,'Paola','mt','Malta'),(4324,10,'Qormi','mt','Malta'),(4325,11,'Rabat','mt','Malta'),(4326,12,'Rabat','mt','Malta'),(4327,13,'San Gwann','mt','Malta'),(4328,14,'San Pawl il-Bahar','mt','Malta'),(4329,15,'Sighghiewi','mt','Malta'),(4330,16,'Sliema','mt','Malta'),(4331,17,'Tarxien','mt','Malta'),(4332,18,'Valletta','mt','Malta'),(4333,19,'Zabbar','mt','Malta'),(4334,20,'Zebbug','mt','Malta'),(4335,21,'Zejtun','mt','Malta'),(4336,22,'Zurrieq','mt','Malta'),(4337,1,'Castletown','xm','Man (Isle of)'),(4338,2,'Douglas','xm','Man (Isle of)'),(4339,3,'Laxey','xm','Man (Isle of)'),(4340,4,'Onchan','xm','Man (Isle of)'),(4341,5,'Peel','xm','Man (Isle of)'),(4342,6,'Port Erin','xm','Man (Isle of)'),(4343,7,'Port Saint Mary','xm','Man (Isle of)'),(4344,8,'Ramsey','xm','Man (Isle of)'),(4345,1,'Aerok','mh','Marshall Islands'),(4346,2,'Ailuk','mh','Marshall Islands'),(4347,3,'Ajeltake','mh','Marshall Islands'),(4348,4,'Ebeye','mh','Marshall Islands'),(4349,5,'Enewetak','mh','Marshall Islands'),(4350,6,'Enubirr','mh','Marshall Islands'),(4351,7,'Jabwor','mh','Marshall Islands'),(4352,8,'Kili','mh','Marshall Islands'),(4353,9,'Laura','mh','Marshall Islands'),(4354,10,'Likiep','mh','Marshall Islands'),(4355,11,'Mejatto','mh','Marshall Islands'),(4356,12,'Mejit','mh','Marshall Islands'),(4357,13,'Mili','mh','Marshall Islands'),(4358,14,'Namorik','mh','Marshall Islands'),(4359,15,'Rita','mh','Marshall Islands'),(4360,16,'Ujae','mh','Marshall Islands'),(4361,17,'Utirik','mh','Marshall Islands'),(4362,18,'Woja','mh','Marshall Islands'),(4363,19,'Woja','mh','Marshall Islands'),(4364,20,'Wotje','mh','Marshall Islands'),(4365,1,'Ducos','mq','Martinique'),(4366,2,'Fort-de-France','mq','Martinique'),(4367,3,'Gros-Morne','mq','Martinique'),(4368,4,'La Trinité','mq','Martinique'),(4369,5,'Le François','mq','Martinique'),(4370,6,'Le Lamentin','mq','Martinique'),(4371,7,'Le Lorrain','mq','Martinique'),(4372,8,'Le Marin','mq','Martinique'),(4373,9,'Le Morne-Rouge','mq','Martinique'),(4374,10,'Le Robert','mq','Martinique'),(4375,11,'Le Vauclin','mq','Martinique'),(4376,12,'Les Trois-Îlets','mq','Martinique'),(4377,13,'Rivière-Pilote','mq','Martinique'),(4378,14,'Rivière-Salée','mq','Martinique'),(4379,15,'Sainte-Luce','mq','Martinique'),(4380,16,'Sainte-Marie','mq','Martinique'),(4381,17,'Saint-Esprit','mq','Martinique'),(4382,18,'Saint-Joseph','mq','Martinique'),(4383,19,'Saint-Pierre','mq','Martinique'),(4384,20,'Schoelcher','mq','Martinique'),(4385,1,'´Ayûn-al-´Atrûs','mr','Mauritania'),(4386,2,'Alaq','mr','Mauritania'),(4387,3,'an-Na´mah','mr','Mauritania'),(4388,4,'Aqjawajat','mr','Mauritania'),(4389,5,'Âtâr','mr','Mauritania'),(4390,6,'Buqah','mr','Mauritania'),(4391,7,'Fdayrik','mr','Mauritania'),(4392,8,'Hsay Wâlad ´Alî Bâbî','mr','Mauritania'),(4393,9,'Kayhaydi','mr','Mauritania'),(4394,10,'Kîfah','mr','Mauritania'),(4395,11,'Kubanni','mr','Mauritania'),(4396,12,'Magta´ Lahjar','mr','Mauritania'),(4397,13,'Nawadhîbu','mr','Mauritania'),(4398,14,'Nawâkshût','mr','Mauritania'),(4399,15,'Rûsû','mr','Mauritania'),(4400,16,'Shingati','mr','Mauritania'),(4401,17,'Tijiqjah','mr','Mauritania'),(4402,18,'Timbédra','mr','Mauritania'),(4403,19,'Walâtah','mr','Mauritania'),(4404,20,'Zuwârat','mr','Mauritania'),(4405,1,'Baie du Tombeau','mu','Mauritius'),(4406,2,'Bambous','mu','Mauritius'),(4407,3,'Beau Bassin-Rose Hill','mu','Mauritius'),(4408,4,'Bel Air','mu','Mauritius'),(4409,5,'Central Flacq','mu','Mauritius'),(4410,6,'Chemin Grenier','mu','Mauritius'),(4411,7,'Curepipe','mu','Mauritius'),(4412,8,'Goodlands','mu','Mauritius'),(4413,9,'Grand Baie','mu','Mauritius'),(4414,10,'Le Hochet','mu','Mauritius'),(4415,11,'Mahébourg','mu','Mauritius'),(4416,12,'Moka','mu','Mauritius'),(4417,13,'Pailles','mu','Mauritius'),(4418,14,'Pamplemousse','mu','Mauritius'),(4419,15,'Plaine Magnien','mu','Mauritius'),(4420,16,'Port Louis','mu','Mauritius'),(4421,17,'Port Mathurin','mu','Mauritius'),(4422,18,'Poudre d\'Or','mu','Mauritius'),(4423,19,'Quatre Bornes','mu','Mauritius'),(4424,20,'Rose Belle','mu','Mauritius'),(4425,21,'Saint Pierre','mu','Mauritius'),(4426,22,'Souillac','mu','Mauritius'),(4427,23,'Surinam','mu','Mauritius'),(4428,24,'Tamarin','mu','Mauritius'),(4429,25,'Triolet','mu','Mauritius'),(4430,26,'Vascoas-Phoenix','mu','Mauritius'),(4431,1,'Acoua','yt','Mayotte'),(4432,2,'Bandraboua','yt','Mayotte'),(4433,3,'Bandrélé','yt','Mayotte'),(4434,4,'Bouéni','yt','Mayotte'),(4435,5,'Chiconi','yt','Mayotte'),(4436,6,'Chirongui','yt','Mayotte'),(4437,7,'Dembéni','yt','Mayotte'),(4438,8,'Dzaoudzi','yt','Mayotte'),(4439,9,'Kanikéli','yt','Mayotte'),(4440,10,'Koungou','yt','Mayotte'),(4441,11,'Mamoudzou','yt','Mayotte'),(4442,12,'Mtsamboro','yt','Mayotte'),(4443,13,'Mtsangamouji','yt','Mayotte'),(4444,14,'Ouangani','yt','Mayotte'),(4445,15,'Pamanzi','yt','Mayotte'),(4446,16,'Sada','yt','Mayotte'),(4447,17,'Tsingoni','yt','Mayotte'),(4448,1,'Acapulco','mx','Mexico'),(4449,2,'Acuña','mx','Mexico'),(4450,3,'Aguascalientes','mx','Mexico'),(4451,4,'Apodaca','mx','Mexico'),(4452,5,'Buenavista','mx','Mexico'),(4453,6,'Campeche','mx','Mexico'),(4454,7,'Cancún','mx','Mexico'),(4455,8,'Carmen','mx','Mexico'),(4456,9,'Celaya','mx','Mexico'),(4457,10,'Chalco','mx','Mexico'),(4458,11,'Chetumal','mx','Mexico'),(4459,12,'Chihuahua','mx','Mexico'),(4460,13,'Chilpancingo','mx','Mexico'),(4461,14,'Chimalhuacán','mx','Mexico'),(4462,15,'Ciudad Valles','mx','Mexico'),(4463,16,'Coacalco','mx','Mexico'),(4464,17,'Coatzacoalcos','mx','Mexico'),(4465,18,'Colima','mx','Mexico'),(4466,19,'Córdoba','mx','Mexico'),(4467,20,'Cuautitlán Izcalli','mx','Mexico'),(4468,21,'Cuautla','mx','Mexico'),(4469,22,'Cuernavaca','mx','Mexico'),(4470,23,'Culiacán','mx','Mexico'),(4471,24,'Delicias','mx','Mexico'),(4472,25,'Durango','mx','Mexico'),(4473,26,'Ecatepec','mx','Mexico'),(4474,27,'Ensenada','mx','Mexico'),(4475,28,'Fresnillo','mx','Mexico'),(4476,29,'Garza García','mx','Mexico'),(4477,30,'General Escobedo','mx','Mexico'),(4478,31,'Gómez Palacio','mx','Mexico'),(4479,32,'Guadalajara','mx','Mexico'),(4480,33,'Guadalupe','mx','Mexico'),(4481,34,'Guanajuato','mx','Mexico'),(4482,35,'Guaymas','mx','Mexico'),(4483,36,'Hermosillo','mx','Mexico'),(4484,37,'Hidalgo','mx','Mexico'),(4485,38,'Huixquilucan','mx','Mexico'),(4486,39,'Iguala','mx','Mexico'),(4487,40,'Irapuato','mx','Mexico'),(4488,41,'Ixtapaluca','mx','Mexico'),(4489,42,'Jiutepec','mx','Mexico'),(4490,43,'Juárez','mx','Mexico'),(4491,44,'La Paz','mx','Mexico'),(4492,45,'León','mx','Mexico'),(4493,46,'López Mateos','mx','Mexico'),(4494,47,'Los Mochis','mx','Mexico'),(4495,48,'Los Reyes','mx','Mexico'),(4496,49,'Madero','mx','Mexico'),(4497,50,'Manzanillo','mx','Mexico'),(4498,51,'Matamoros','mx','Mexico'),(4499,52,'Mazatlán','mx','Mexico'),(4500,53,'Mérida','mx','Mexico'),(4501,54,'Metepec','mx','Mexico'),(4502,55,'Mexicali','mx','Mexico'),(4503,56,'México','mx','Mexico'),(4504,57,'Minatitlán','mx','Mexico'),(4505,58,'Monclova','mx','Mexico'),(4506,59,'Monterrey','mx','Mexico'),(4507,60,'Morelia','mx','Mexico'),(4508,61,'Naucalpan','mx','Mexico'),(4509,62,'Navajoa','mx','Mexico'),(4510,63,'Nezahualcóyotl','mx','Mexico'),(4511,64,'Nicolás Romero','mx','Mexico'),(4512,65,'Nogales','mx','Mexico'),(4513,66,'Nuevo Laredo','mx','Mexico'),(4514,67,'Oaxaca','mx','Mexico'),(4515,68,'Obregón','mx','Mexico'),(4516,69,'Orizaba','mx','Mexico'),(4517,70,'Pachuca','mx','Mexico'),(4518,71,'Piedras Negras','mx','Mexico'),(4519,72,'Poza Rica','mx','Mexico'),(4520,73,'Puebla','mx','Mexico'),(4521,74,'Puerto Vallarta','mx','Mexico'),(4522,75,'Querétaro','mx','Mexico'),(4523,76,'Reynosa','mx','Mexico'),(4524,77,'Salamanca','mx','Mexico'),(4525,78,'Saltillo','mx','Mexico'),(4526,79,'San Cristóbal de las Casas','mx','Mexico'),(4527,80,'San Juan del Río','mx','Mexico'),(4528,81,'San Luis Potosí','mx','Mexico'),(4529,82,'San Luis Río Colorado','mx','Mexico'),(4530,83,'San Nicolás de los Garza','mx','Mexico'),(4531,84,'San Pablo de las Salinas','mx','Mexico'),(4532,85,'Santa Catarina','mx','Mexico'),(4533,86,'Soledad','mx','Mexico'),(4534,87,'Tampico','mx','Mexico'),(4535,88,'Tapachula','mx','Mexico'),(4536,89,'Tehuacán','mx','Mexico'),(4537,90,'Tepic','mx','Mexico'),(4538,91,'Texcoco','mx','Mexico'),(4539,92,'Tijuana','mx','Mexico'),(4540,93,'Tlalnepantla','mx','Mexico'),(4541,94,'Tlaquepaque','mx','Mexico'),(4542,95,'Tlaxcala','mx','Mexico'),(4543,96,'Toluca','mx','Mexico'),(4544,97,'Tonalá','mx','Mexico'),(4545,98,'Torreón','mx','Mexico'),(4546,99,'Tuxtla Gutiérrez','mx','Mexico'),(4547,100,'Uruapan','mx','Mexico'),(4548,101,'Veracruz','mx','Mexico'),(4549,102,'Victoria','mx','Mexico'),(4550,103,'Villahermosa','mx','Mexico'),(4551,104,'Xalapa','mx','Mexico'),(4552,105,'Xico','mx','Mexico'),(4553,106,'Zacatecas','mx','Mexico'),(4554,107,'Zamora','mx','Mexico'),(4555,108,'Zapopan','mx','Mexico'),(4556,1,'Colonia','fm','Micronesia'),(4557,2,'Kolonia','fm','Micronesia'),(4558,3,'Lelu','fm','Micronesia'),(4559,4,'Palikir','fm','Micronesia'),(4560,5,'Tol','fm','Micronesia'),(4561,6,'Weno','fm','Micronesia'),(4562,1,'Balti','md','Moldova'),(4563,2,'Cahul','md','Moldova'),(4564,3,'Calarasi','md','Moldova'),(4565,4,'Causani','md','Moldova'),(4566,5,'Chisinau','md','Moldova'),(4567,6,'Ciadâr Lunga','md','Moldova'),(4568,7,'Comrat','md','Moldova'),(4569,8,'Drochia','md','Moldova'),(4570,9,'Dubasari','md','Moldova'),(4571,10,'Edinet','md','Moldova'),(4572,11,'Falesti','md','Moldova'),(4573,12,'Floresti','md','Moldova'),(4574,13,'Hâncesti','md','Moldova'),(4575,14,'Orhei','md','Moldova'),(4576,15,'Râbnita','md','Moldova'),(4577,16,'Slobozia','md','Moldova'),(4578,17,'Soroca','md','Moldova'),(4579,18,'Taraclia','md','Moldova'),(4580,19,'Tighina','md','Moldova'),(4581,20,'Tiraspol\'','md','Moldova'),(4582,21,'Ungheni','md','Moldova'),(4583,1,'Fontvieille','mc','Monaco'),(4584,2,'La Condamine','mc','Monaco'),(4585,3,'Monaco-Ville','mc','Monaco'),(4586,4,'Monte Carlo','mc','Monaco'),(4587,1,'Altaj','mn','Mongolia'),(4588,2,'Arvajhèèr','mn','Mongolia'),(4589,3,'Bajanhongor','mn','Mongolia'),(4590,4,'Baruun-Urt','mn','Mongolia'),(4591,5,'Bulgan','mn','Mongolia'),(4592,6,'Cècèrleg','mn','Mongolia'),(4593,7,'Chojbalsan','mn','Mongolia'),(4594,8,'Chojr','mn','Mongolia'),(4595,9,'Dalanzadgad','mn','Mongolia'),(4596,10,'Darhan','mn','Mongolia'),(4597,11,'Èrdènèt','mn','Mongolia'),(4598,12,'Hovd','mn','Mongolia'),(4599,13,'Mandalgovi','mn','Mongolia'),(4600,14,'Mörön','mn','Mongolia'),(4601,15,'Ölgij','mn','Mongolia'),(4602,16,'Öndörhaan','mn','Mongolia'),(4603,17,'Sajnshand','mn','Mongolia'),(4604,18,'Sühbaatar','mn','Mongolia'),(4605,19,'Ulaanbaatar','mn','Mongolia'),(4606,20,'Ulaangom','mn','Mongolia'),(4607,21,'Uliastaj','mn','Mongolia'),(4608,22,'Zuunharaa','mn','Mongolia'),(4609,23,'Zuunmod','mn','Mongolia'),(4610,1,'ad-Dâr-al-Baydâ','ma','Morocco'),(4611,2,'Aghâdir','ma','Morocco'),(4612,3,'al-´Arâ´ish','ma','Morocco'),(4613,4,'al-Jadîdah','ma','Morocco'),(4614,5,'al-Qanitrah','ma','Morocco'),(4615,6,'al-Qasr-al-Kabîr','ma','Morocco'),(4616,7,'an-Nadûr','ma','Morocco'),(4617,8,'ar-Ribât','ma','Morocco'),(4618,9,'Asfî','ma','Morocco'),(4619,10,'Banî Mallâl','ma','Morocco'),(4620,11,'Fâs','ma','Morocco'),(4621,12,'Ghulimîm','ma','Morocco'),(4622,13,'Khamissât','ma','Morocco'),(4623,14,'Khurîbghah','ma','Morocco'),(4624,15,'Marrâkush','ma','Morocco'),(4625,16,'Miknâs','ma','Morocco'),(4626,17,'Sattât','ma','Morocco'),(4627,18,'Tanjah','ma','Morocco'),(4628,19,'Tâzah','ma','Morocco'),(4629,20,'Titwân','ma','Morocco'),(4630,21,'Ujdah','ma','Morocco'),(4631,1,'Angoche','mz','Mozambique'),(4632,2,'Beira','mz','Mozambique'),(4633,3,'Chibuto','mz','Mozambique'),(4634,4,'Chimoio','mz','Mozambique'),(4635,5,'Cuamba','mz','Mozambique'),(4636,6,'Dondo','mz','Mozambique'),(4637,7,'Garue','mz','Mozambique'),(4638,8,'Inhambane','mz','Mozambique'),(4639,9,'Lichinga','mz','Mozambique'),(4640,10,'Maputo','mz','Mozambique'),(4641,11,'Matola','mz','Mozambique'),(4642,12,'Maxixe','mz','Mozambique'),(4643,13,'Mocuba','mz','Mozambique'),(4644,14,'Montepuez','mz','Mozambique'),(4645,15,'Nacala','mz','Mozambique'),(4646,16,'Nampula','mz','Mozambique'),(4647,17,'Pemba','mz','Mozambique'),(4648,18,'Quelimane','mz','Mozambique'),(4649,19,'Tete','mz','Mozambique'),(4650,20,'Xai-Xai','mz','Mozambique'),(4651,1,'Akyab','mm','Myanmar'),(4652,2,'Bago','mm','Myanmar'),(4653,3,'Dawei','mm','Myanmar'),(4654,4,'Falam','mm','Myanmar'),(4655,5,'Henzada','mm','Myanmar'),(4656,6,'Hpa-an','mm','Myanmar'),(4657,7,'Lashio','mm','Myanmar'),(4658,8,'Loikaw','mm','Myanmar'),(4659,9,'Magway','mm','Myanmar'),(4660,10,'Mandalay','mm','Myanmar'),(4661,11,'Mawlamyine','mm','Myanmar'),(4662,12,'Maymyo','mm','Myanmar'),(4663,13,'Meiktila','mm','Myanmar'),(4664,14,'Mergui','mm','Myanmar'),(4665,15,'Monywa','mm','Myanmar'),(4666,16,'Myingyan','mm','Myanmar'),(4667,17,'Myitkyina','mm','Myanmar'),(4668,18,'Pakokku','mm','Myanmar'),(4669,19,'Pathein','mm','Myanmar'),(4670,20,'Pyay','mm','Myanmar'),(4671,21,'Sagaing','mm','Myanmar'),(4672,22,'Taunggyi','mm','Myanmar'),(4673,23,'Thaton','mm','Myanmar'),(4674,24,'Toungoo','mm','Myanmar'),(4675,25,'Yangon','mm','Myanmar'),(4676,26,'Yenangyaung','mm','Myanmar'),(4677,1,'Bethanien','na','Namibia'),(4678,2,'Gobabis','na','Namibia'),(4679,3,'Grootfontein','na','Namibia'),(4680,4,'Katima Mulilo','na','Namibia'),(4681,5,'Keetmanshoop','na','Namibia'),(4682,6,'Khorixas','na','Namibia'),(4683,7,'Kuisebmond','na','Namibia'),(4684,8,'Lüderitz','na','Namibia'),(4685,9,'Mariental','na','Namibia'),(4686,10,'Okahandja','na','Namibia'),(4687,11,'Omaruru','na','Namibia'),(4688,12,'Ondangwa','na','Namibia'),(4689,13,'Ongandjera','na','Namibia'),(4690,14,'Opuwo','na','Namibia'),(4691,15,'Oranjemund','na','Namibia'),(4692,16,'Oshakati','na','Namibia'),(4693,17,'Oshikango','na','Namibia'),(4694,18,'Otjiwarongo','na','Namibia'),(4695,19,'Rehoboth','na','Namibia'),(4696,20,'Rundu','na','Namibia'),(4697,21,'Swakopmund','na','Namibia'),(4698,22,'Tsumeb','na','Namibia'),(4699,23,'Walvis Bay','na','Namibia'),(4700,24,'Windhoek','na','Namibia'),(4701,1,'Yaren','nr','Nauru'),(4702,1,'Bâglung','np','Nepal'),(4703,2,'Bhaktapur','np','Nepal'),(4704,3,'Bharatpur','np','Nepal'),(4705,4,'Birâtnagar','np','Nepal'),(4706,5,'Bîrganj','np','Nepal'),(4707,6,'Butwal','np','Nepal'),(4708,7,'Damak','np','Nepal'),(4709,8,'Dhangadi','np','Nepal'),(4710,9,'Dharân','np','Nepal'),(4711,10,'Gulariya','np','Nepal'),(4712,11,'Hetauda','np','Nepal'),(4713,12,'Ilâm','np','Nepal'),(4714,13,'Jaleshwar','np','Nepal'),(4715,14,'Janakpur','np','Nepal'),(4716,15,'Jumla','np','Nepal'),(4717,16,'Kathmandu','np','Nepal'),(4718,17,'Lalitpur','np','Nepal'),(4719,18,'Madhyapur Thimi','np','Nepal'),(4720,19,'Mahendranagar','np','Nepal'),(4721,20,'Mechinagar','np','Nepal'),(4722,21,'Nepâlgânj','np','Nepal'),(4723,22,'Pokharâ','np','Nepal'),(4724,23,'Râjbirâj','np','Nepal'),(4725,24,'Sidharthanagar','np','Nepal'),(4726,25,'Triyuga','np','Nepal'),(4727,26,'Tulsîpur','np','Nepal'),(4728,1,'Almere','nl','Netherlands'),(4729,2,'Amersfoort','nl','Netherlands'),(4730,3,'Amsterdam','nl','Netherlands'),(4731,4,'Apeldoorn','nl','Netherlands'),(4732,5,'Arnhem','nl','Netherlands'),(4733,6,'Assen','nl','Netherlands'),(4734,7,'Breda','nl','Netherlands'),(4735,8,'Dordrecht','nl','Netherlands'),(4736,9,'Ede','nl','Netherlands'),(4737,10,'Eindhoven','nl','Netherlands'),(4738,11,'Emmen','nl','Netherlands'),(4739,12,'Enschede','nl','Netherlands'),(4740,13,'Groningen','nl','Netherlands'),(4741,14,'Haarlem','nl','Netherlands'),(4742,15,'Haarlemmermeer','nl','Netherlands'),(4743,16,'Leeuwarden','nl','Netherlands'),(4744,17,'Leiden','nl','Netherlands'),(4745,18,'Lelystad','nl','Netherlands'),(4746,19,'Maastricht','nl','Netherlands'),(4747,20,'Middelburg','nl','Netherlands'),(4748,21,'Nijmegen','nl','Netherlands'),(4749,22,'Rotterdam','nl','Netherlands'),(4750,23,'\'s-Gravenhage','nl','Netherlands'),(4751,24,'\'s-Hertogenbosch','nl','Netherlands'),(4752,25,'Tilburg','nl','Netherlands'),(4753,26,'Utrecht','nl','Netherlands'),(4754,27,'Zaanstad','nl','Netherlands'),(4755,28,'Zoetermeer','nl','Netherlands'),(4756,29,'Zwolle','nl','Netherlands'),(4757,1,'Kralendijk','an','Netherlands Antilles'),(4758,2,'Oranjestad','an','Netherlands Antilles'),(4759,3,'Philipsburg','an','Netherlands Antilles'),(4760,4,'The Bottom','an','Netherlands Antilles'),(4761,5,'Willemstad','an','Netherlands Antilles'),(4762,1,'Bourail','nc','New Caledonia'),(4763,2,'Canala','nc','New Caledonia'),(4764,3,'Dumbéa','nc','New Caledonia'),(4765,4,'Fayaoué','nc','New Caledonia'),(4766,5,'Houaïlu','nc','New Caledonia'),(4767,6,'Koné','nc','New Caledonia'),(4768,7,'Koumac','nc','New Caledonia'),(4769,8,'La Foa','nc','New Caledonia'),(4770,9,'Mont-Doré','nc','New Caledonia'),(4771,10,'Nouméa','nc','New Caledonia'),(4772,11,'Ouégoa','nc','New Caledonia'),(4773,12,'Païta','nc','New Caledonia'),(4774,13,'Poindimié','nc','New Caledonia'),(4775,14,'Ponerihouen','nc','New Caledonia'),(4776,15,'Pouébo','nc','New Caledonia'),(4777,16,'Poya','nc','New Caledonia'),(4778,17,'Tadine','nc','New Caledonia'),(4779,18,'Thio','nc','New Caledonia'),(4780,19,'Touho','nc','New Caledonia'),(4781,20,'Wé','nc','New Caledonia'),(4782,1,'Auckland','nz','New Zealand'),(4783,2,'Blenheim','nz','New Zealand'),(4784,3,'Christchurch','nz','New Zealand'),(4785,4,'Dunedin','nz','New Zealand'),(4786,5,'Gisborne','nz','New Zealand'),(4787,6,'Greymouth','nz','New Zealand'),(4788,7,'Hamilton','nz','New Zealand'),(4789,8,'Hastings','nz','New Zealand'),(4790,9,'Invercargill','nz','New Zealand'),(4791,10,'Lower Hutt','nz','New Zealand'),(4792,11,'Manukau','nz','New Zealand'),(4793,12,'Napier','nz','New Zealand'),(4794,13,'Nelson','nz','New Zealand'),(4795,14,'New Plymouth','nz','New Zealand'),(4796,15,'North Shore','nz','New Zealand'),(4797,16,'Palmerston North','nz','New Zealand'),(4798,17,'Porirua','nz','New Zealand'),(4799,18,'Richmond','nz','New Zealand'),(4800,19,'Rotorua','nz','New Zealand'),(4801,20,'Stratford','nz','New Zealand'),(4802,21,'Tauranga','nz','New Zealand'),(4803,22,'Waitakere','nz','New Zealand'),(4804,23,'Waitangi','nz','New Zealand'),(4805,24,'Wanganui','nz','New Zealand'),(4806,25,'Wellington','nz','New Zealand'),(4807,26,'Whakatane','nz','New Zealand'),(4808,27,'Whangarei','nz','New Zealand'),(4809,1,'Bluefields','ni','Nicaragua'),(4810,2,'Boaco','ni','Nicaragua'),(4811,3,'Chichigalpa','ni','Nicaragua'),(4812,4,'Chinandega','ni','Nicaragua'),(4813,5,'Diriamba','ni','Nicaragua'),(4814,6,'El Viejo','ni','Nicaragua'),(4815,7,'Estelí','ni','Nicaragua'),(4816,8,'Granada','ni','Nicaragua'),(4817,9,'Jalapa','ni','Nicaragua'),(4818,10,'Jinotega','ni','Nicaragua'),(4819,11,'Jinotepe','ni','Nicaragua'),(4820,12,'Juigalpa','ni','Nicaragua'),(4821,13,'León','ni','Nicaragua'),(4822,14,'Managua','ni','Nicaragua'),(4823,15,'Masaya','ni','Nicaragua'),(4824,16,'Matagalpa','ni','Nicaragua'),(4825,17,'Nagarote','ni','Nicaragua'),(4826,18,'Nueva Guinea','ni','Nicaragua'),(4827,19,'Ocotal','ni','Nicaragua'),(4828,20,'Puerto Cabezas','ni','Nicaragua'),(4829,21,'Rivas','ni','Nicaragua'),(4830,22,'San Carlos','ni','Nicaragua'),(4831,23,'Somoto','ni','Nicaragua'),(4832,24,'Tipitapa','ni','Nicaragua'),(4833,1,'Agadez','ne','Niger'),(4834,2,'Arlit','ne','Niger'),(4835,3,'Ayorou','ne','Niger'),(4836,4,'Birni N\'Gaouré','ne','Niger'),(4837,5,'Birni N\'Konni','ne','Niger'),(4838,6,'Dakoro','ne','Niger'),(4839,7,'Diffa','ne','Niger'),(4840,8,'Dogondoutchi','ne','Niger'),(4841,9,'Dosso','ne','Niger'),(4842,10,'Gaya','ne','Niger'),(4843,11,'Illéla','ne','Niger'),(4844,12,'Magaria','ne','Niger'),(4845,13,'Maradi','ne','Niger'),(4846,14,'Mirriah','ne','Niger'),(4847,15,'Niamey','ne','Niger'),(4848,16,'Tahoua','ne','Niger'),(4849,17,'Tanout','ne','Niger'),(4850,18,'Téra','ne','Niger'),(4851,19,'Tessaoua','ne','Niger'),(4852,20,'Tillabéry','ne','Niger'),(4853,21,'Zinder','ne','Niger'),(4854,1,'Aba','ng','Nigeria'),(4855,2,'Abakaliki','ng','Nigeria'),(4856,3,'Abeokuta','ng','Nigeria'),(4857,4,'Abuja','ng','Nigeria'),(4858,5,'Ado','ng','Nigeria'),(4859,6,'Akure','ng','Nigeria'),(4860,7,'Amaigbo','ng','Nigeria'),(4861,8,'Asaba','ng','Nigeria'),(4862,9,'Awka','ng','Nigeria'),(4863,10,'Azare','ng','Nigeria'),(4864,11,'Bama','ng','Nigeria'),(4865,12,'Bauchi','ng','Nigeria'),(4866,13,'Benin','ng','Nigeria'),(4867,14,'Bida','ng','Nigeria'),(4868,15,'Birnin Kebbi','ng','Nigeria'),(4869,16,'Bugama','ng','Nigeria'),(4870,17,'Calabar','ng','Nigeria'),(4871,18,'Damaturu','ng','Nigeria'),(4872,19,'Dutse','ng','Nigeria'),(4873,20,'Ede','ng','Nigeria'),(4874,21,'Efon Alaye','ng','Nigeria'),(4875,22,'Ejigbo','ng','Nigeria'),(4876,23,'Enugu','ng','Nigeria'),(4877,24,'Funtua','ng','Nigeria'),(4878,25,'Gashua','ng','Nigeria'),(4879,26,'Gboko','ng','Nigeria'),(4880,27,'Gbongan','ng','Nigeria'),(4881,28,'Gombe','ng','Nigeria'),(4882,29,'Gusau','ng','Nigeria'),(4883,30,'Hadejia','ng','Nigeria'),(4884,31,'Ibadan','ng','Nigeria'),(4885,32,'Ife','ng','Nigeria'),(4886,33,'Ifon Osun','ng','Nigeria'),(4887,34,'Igboho','ng','Nigeria'),(4888,35,'Ijebu Ode','ng','Nigeria'),(4889,36,'Ijero','ng','Nigeria'),(4890,37,'Ikare','ng','Nigeria'),(4891,38,'Ikire','ng','Nigeria'),(4892,39,'Ikirun','ng','Nigeria'),(4893,40,'Ikorodu','ng','Nigeria'),(4894,41,'Ikot Ekpene','ng','Nigeria'),(4895,42,'Ila','ng','Nigeria'),(4896,43,'Ilawe','ng','Nigeria'),(4897,44,'Ilesha','ng','Nigeria'),(4898,45,'Ilobu','ng','Nigeria'),(4899,46,'Ilorin','ng','Nigeria'),(4900,47,'Inisa','ng','Nigeria'),(4901,48,'Ise','ng','Nigeria'),(4902,49,'Iseyin','ng','Nigeria'),(4903,50,'Iwo','ng','Nigeria'),(4904,51,'Jalingo','ng','Nigeria'),(4905,52,'Jimeta','ng','Nigeria'),(4906,53,'Jos','ng','Nigeria'),(4907,54,'Kaduna','ng','Nigeria'),(4908,55,'Kano','ng','Nigeria'),(4909,56,'Katsina','ng','Nigeria'),(4910,57,'Kishi','ng','Nigeria'),(4911,58,'Lafia','ng','Nigeria'),(4912,59,'Lagos','ng','Nigeria'),(4913,60,'Lokoja','ng','Nigeria'),(4914,61,'Maiduguri','ng','Nigeria'),(4915,62,'Makurdi','ng','Nigeria'),(4916,63,'Minna','ng','Nigeria'),(4917,64,'Modakeke','ng','Nigeria'),(4918,65,'Mubi','ng','Nigeria'),(4919,66,'Nnewi','ng','Nigeria'),(4920,67,'Nsukka','ng','Nigeria'),(4921,68,'Obosi','ng','Nigeria'),(4922,69,'Offa','ng','Nigeria'),(4923,70,'Ogbomosho','ng','Nigeria'),(4924,71,'Okene','ng','Nigeria'),(4925,72,'Okigwe','ng','Nigeria'),(4926,73,'Okpoko','ng','Nigeria'),(4927,74,'Okrika','ng','Nigeria'),(4928,75,'Ondo','ng','Nigeria'),(4929,76,'Onitsha','ng','Nigeria'),(4930,77,'Oshogbo','ng','Nigeria'),(4931,78,'Otukpo','ng','Nigeria'),(4932,79,'Owerri','ng','Nigeria'),(4933,80,'Owo','ng','Nigeria'),(4934,81,'Oyo','ng','Nigeria'),(4935,82,'Port Harcourt','ng','Nigeria'),(4936,83,'Sango Ota','ng','Nigeria'),(4937,84,'Sapele','ng','Nigeria'),(4938,85,'Shagamu','ng','Nigeria'),(4939,86,'Shaki','ng','Nigeria'),(4940,87,'Sokoto','ng','Nigeria'),(4941,88,'Suleja','ng','Nigeria'),(4942,89,'Ugep','ng','Nigeria'),(4943,90,'Umuahia','ng','Nigeria'),(4944,91,'Uromi','ng','Nigeria'),(4945,92,'Uyo','ng','Nigeria'),(4946,93,'Warri','ng','Nigeria'),(4947,94,'Yenagoa','ng','Nigeria'),(4948,95,'Yola','ng','Nigeria'),(4949,96,'Zaria','ng','Nigeria'),(4950,1,'Alofi','nu','Niue'),(4951,2,'Avatele','nu','Niue'),(4952,3,'Hakupu','nu','Niue'),(4953,4,'Hikutavake','nu','Niue'),(4954,5,'Lakepa','nu','Niue'),(4955,6,'Liku','nu','Niue'),(4956,7,'Makefu','nu','Niue'),(4957,8,'Mutalau','nu','Niue'),(4958,9,'Namukulu','nu','Niue'),(4959,10,'Tamakautoga','nu','Niue'),(4960,11,'Toi','nu','Niue'),(4961,12,'Tuapa','nu','Niue'),(4962,13,'Vaiea','nu','Niue'),(4963,1,'Kingston','nf','Norfolk'),(4964,1,'Capital Hill','mp','Northern Mariana Islands'),(4965,2,'Chalan Kanoa','mp','Northern Mariana Islands'),(4966,3,'Dandan','mp','Northern Mariana Islands'),(4967,4,'Garapan','mp','Northern Mariana Islands'),(4968,5,'Gualo Rai','mp','Northern Mariana Islands'),(4969,6,'Kagman','mp','Northern Mariana Islands'),(4970,7,'Koblerville','mp','Northern Mariana Islands'),(4971,8,'Navy Hill','mp','Northern Mariana Islands'),(4972,9,'San Antonio','mp','Northern Mariana Islands'),(4973,10,'San Jose','mp','Northern Mariana Islands'),(4974,11,'San Jose','mp','Northern Mariana Islands'),(4975,12,'San Roque','mp','Northern Mariana Islands'),(4976,13,'San Vicente','mp','Northern Mariana Islands'),(4977,14,'Settlement','mp','Northern Mariana Islands'),(4978,15,'Songsong','mp','Northern Mariana Islands'),(4979,16,'Susupe','mp','Northern Mariana Islands'),(4980,17,'Tanapag','mp','Northern Mariana Islands'),(4981,1,'´Ibrî','om','Oman'),(4982,2,'al-Buraymi','om','Oman'),(4983,3,'al-Khabûrah','om','Oman'),(4984,4,'al-Mudaybî','om','Oman'),(4985,5,'ar-Rustâq','om','Oman'),(4986,6,'as-Sîb','om','Oman'),(4987,7,'as-Suwayq','om','Oman'),(4988,8,'Bahlâ\'','om','Oman'),(4989,9,'Barkah','om','Oman'),(4990,10,'Bawshar','om','Oman'),(4991,11,'Khasab','om','Oman'),(4992,12,'Madinat Qabûs','om','Oman'),(4993,13,'Masqat','om','Oman'),(4994,14,'Matrah','om','Oman'),(4995,15,'Nizwa','om','Oman'),(4996,16,'Ruwî','om','Oman'),(4997,17,'Saham','om','Oman'),(4998,18,'Salâlah','om','Oman'),(4999,19,'Shinâs','om','Oman'),(5000,20,'Suhâr','om','Oman'),(5001,21,'Sûr','om','Oman'),(5002,1,'Abottâbâd','pk','Pakistan'),(5003,2,'Ahmadpur East','pk','Pakistan'),(5004,3,'Bahâwalnagar','pk','Pakistan'),(5005,4,'Bahâwalpur','pk','Pakistan'),(5006,5,'Bûrewâla','pk','Pakistan'),(5007,6,'Chiniot','pk','Pakistan'),(5008,7,'Chishtiân Mandi','pk','Pakistan'),(5009,8,'Dâdu','pk','Pakistan'),(5010,9,'Daska','pk','Pakistan'),(5011,10,'Dera Ghâzi Khân','pk','Pakistan'),(5012,11,'Dera Îsmâil Khân','pk','Pakistan'),(5013,12,'Faisalâbâd','pk','Pakistan'),(5014,13,'Gilgit','pk','Pakistan'),(5015,14,'Gojra','pk','Pakistan'),(5016,15,'Gujrânwâla','pk','Pakistan'),(5017,16,'Gujrât','pk','Pakistan'),(5018,17,'Hâfizâbâd','pk','Pakistan'),(5019,18,'Hyderâbâd','pk','Pakistan'),(5020,19,'Islâmâbâd','pk','Pakistan'),(5021,20,'Jacobâbâd','pk','Pakistan'),(5022,21,'Jarânwâla','pk','Pakistan'),(5023,22,'Jhang','pk','Pakistan'),(5024,23,'Jhelum','pk','Pakistan'),(5025,24,'Kamâlia','pk','Pakistan'),(5026,25,'Kâmoke','pk','Pakistan'),(5027,26,'Karâchi','pk','Pakistan'),(5028,27,'Kasûr','pk','Pakistan'),(5029,28,'Khairpur','pk','Pakistan'),(5030,29,'Khânewâl','pk','Pakistan'),(5031,30,'Khânpur','pk','Pakistan'),(5032,31,'Khuzdar','pk','Pakistan'),(5033,32,'Kohât','pk','Pakistan'),(5034,33,'Lahore','pk','Pakistan'),(5035,34,'Lârkâna','pk','Pakistan'),(5036,35,'Mandi Bahâuddîn','pk','Pakistan'),(5037,36,'Mardân','pk','Pakistan'),(5038,37,'Mingâora','pk','Pakistan'),(5039,38,'Mîrpur Khâs','pk','Pakistan'),(5040,39,'Multân','pk','Pakistan'),(5041,40,'Murîdke','pk','Pakistan'),(5042,41,'Muzaffarâbâd','pk','Pakistan'),(5043,42,'Muzaffargarh','pk','Pakistan'),(5044,43,'Nawâbshâh','pk','Pakistan'),(5045,44,'Nowshera','pk','Pakistan'),(5046,45,'Okâra','pk','Pakistan'),(5047,46,'Pâkpattan','pk','Pakistan'),(5048,47,'Peshâwar','pk','Pakistan'),(5049,48,'Quetta','pk','Pakistan'),(5050,49,'Rahîm Yâr Khân','pk','Pakistan'),(5051,50,'Râwalpindi','pk','Pakistan'),(5052,51,'Sâdiqâbâd','pk','Pakistan'),(5053,52,'Sâhîwâl','pk','Pakistan'),(5054,53,'Sargodha','pk','Pakistan'),(5055,54,'Shekhûpura','pk','Pakistan'),(5056,55,'Shikârpur','pk','Pakistan'),(5057,56,'Siâlkot','pk','Pakistan'),(5058,57,'Sukkur','pk','Pakistan'),(5059,58,'Tando Âdam','pk','Pakistan'),(5060,59,'Vihâri','pk','Pakistan'),(5061,60,'Wâh','pk','Pakistan'),(5062,61,'Wazîrâbâd','pk','Pakistan'),(5063,1,'Airai','pw','Palau'),(5064,2,'Chol','pw','Palau'),(5065,3,'Dongosaru','pw','Palau'),(5066,4,'Hatohobei','pw','Palau'),(5067,5,'Imeong','pw','Palau'),(5068,6,'Kayangel','pw','Palau'),(5069,7,'Kloulklubed','pw','Palau'),(5070,8,'Koror','pw','Palau'),(5071,9,'Melekeok','pw','Palau'),(5072,10,'Meyungs','pw','Palau'),(5073,11,'Ngaramash','pw','Palau'),(5074,12,'Ngerkeai','pw','Palau'),(5075,13,'Ngermechau','pw','Palau'),(5076,14,'Ngetkip','pw','Palau'),(5077,15,'Oikul','pw','Palau'),(5078,16,'Ollei','pw','Palau'),(5079,17,'Ulimang','pw','Palau'),(5080,1,'ad-Dâhirîyah','ps','Palestine'),(5081,2,'al-Bîrah','ps','Palestine'),(5082,3,'al-Burayj','ps','Palestine'),(5083,4,'al-Insayrât','ps','Palestine'),(5084,5,'al-Khalîl','ps','Palestine'),(5085,6,'al-Quds','ps','Palestine'),(5086,7,'Arîhâ','ps','Palestine'),(5087,8,'Banî Suhaylah','ps','Palestine'),(5088,9,'Bayt Hânûn','ps','Palestine'),(5089,10,'Bayt Lâhiyah','ps','Palestine'),(5090,11,'Bayt Lahm','ps','Palestine'),(5091,12,'Dayr-al-Balah','ps','Palestine'),(5092,13,'Ghazzah','ps','Palestine'),(5093,14,'Jabâliyah','ps','Palestine'),(5094,15,'Janin','ps','Palestine'),(5095,16,'Khân Yûnis','ps','Palestine'),(5096,17,'Nâbulus','ps','Palestine'),(5097,18,'Qalqîlyah','ps','Palestine'),(5098,19,'Rafah','ps','Palestine'),(5099,20,'Râm Allâh','ps','Palestine'),(5100,21,'Salfît','ps','Palestine'),(5101,22,'Tûbâs','ps','Palestine'),(5102,23,'Tûlkarm','ps','Palestine'),(5103,24,'Yattah','ps','Palestine'),(5104,1,'Antón','pa','Panama'),(5105,2,'Arraiján','pa','Panama'),(5106,3,'Bocas del Toro','pa','Panama'),(5107,4,'Bugaba','pa','Panama'),(5108,5,'Changuinola','pa','Panama'),(5109,6,'Chepo','pa','Panama'),(5110,7,'Chichica','pa','Panama'),(5111,8,'Chitré','pa','Panama'),(5112,9,'Cirilo Guainora','pa','Panama'),(5113,10,'Colón','pa','Panama'),(5114,11,'David','pa','Panama'),(5115,12,'La Chorrera','pa','Panama'),(5116,13,'La Palma','pa','Panama'),(5117,14,'Las Tablas','pa','Panama'),(5118,15,'Narganá','pa','Panama'),(5119,16,'Ocú','pa','Panama'),(5120,17,'Panamá','pa','Panama'),(5121,18,'Penonomé','pa','Panama'),(5122,19,'Portobelo','pa','Panama'),(5123,20,'Puerto Armuelles','pa','Panama'),(5124,21,'Río Sereno','pa','Panama'),(5125,22,'San Miguelito','pa','Panama'),(5126,23,'Santiago','pa','Panama'),(5127,24,'Soná','pa','Panama'),(5128,1,'Alotau','pg','Papua New Guinea'),(5129,2,'Arawa','pg','Papua New Guinea'),(5130,3,'Bulolo','pg','Papua New Guinea'),(5131,4,'Daru','pg','Papua New Guinea'),(5132,5,'Goroka','pg','Papua New Guinea'),(5133,6,'Kavieng','pg','Papua New Guinea'),(5134,7,'Kerema','pg','Papua New Guinea'),(5135,8,'Kimbe','pg','Papua New Guinea'),(5136,9,'Kiunga','pg','Papua New Guinea'),(5137,10,'Kokopo','pg','Papua New Guinea'),(5138,11,'Kundiawa','pg','Papua New Guinea'),(5139,12,'Lae','pg','Papua New Guinea'),(5140,13,'Lorengau','pg','Papua New Guinea'),(5141,14,'Madang','pg','Papua New Guinea'),(5142,15,'Mendi','pg','Papua New Guinea'),(5143,16,'Mount Hagen','pg','Papua New Guinea'),(5144,17,'Popondetta','pg','Papua New Guinea'),(5145,18,'Port Moresby','pg','Papua New Guinea'),(5146,19,'Rabaul','pg','Papua New Guinea'),(5147,20,'Vanimo','pg','Papua New Guinea'),(5148,21,'Wabag','pg','Papua New Guinea'),(5149,22,'Wau','pg','Papua New Guinea'),(5150,23,'Wewak','pg','Papua New Guinea'),(5151,1,'Areguá','py','Paraguay'),(5152,2,'Asunción','py','Paraguay'),(5153,3,'Caacupé','py','Paraguay'),(5154,4,'Caaguazú','py','Paraguay'),(5155,5,'Caazapá','py','Paraguay'),(5156,6,'Capiatá','py','Paraguay'),(5157,7,'Ciudad del Este','py','Paraguay'),(5158,8,'Concepción','py','Paraguay'),(5159,9,'Coronel Oviedo','py','Paraguay'),(5160,10,'Encarnación','py','Paraguay'),(5161,11,'Fernando de la Mora','py','Paraguay'),(5162,12,'Filadelfia','py','Paraguay'),(5163,13,'Fuerte Olimpo','py','Paraguay'),(5164,14,'Hernandaríaz','py','Paraguay'),(5165,15,'Itauguá','py','Paraguay'),(5166,16,'Lambaré','py','Paraguay'),(5167,17,'Limpio','py','Paraguay'),(5168,18,'Luque','py','Paraguay'),(5169,19,'Mariano Roque Alonso','py','Paraguay'),(5170,20,'Ñemby','py','Paraguay'),(5171,21,'Paraguarí','py','Paraguay'),(5172,22,'Pedro Juan Caballero','py','Paraguay'),(5173,23,'Pilar','py','Paraguay'),(5174,24,'Pozo Colorado','py','Paraguay'),(5175,25,'Presidente Franco','py','Paraguay'),(5176,26,'Salto del Guairá','py','Paraguay'),(5177,27,'San Antonio','py','Paraguay'),(5178,28,'San Juan Bautista','py','Paraguay'),(5179,29,'San Lorenzo','py','Paraguay'),(5180,30,'San Pedro de Ycuamandiyú','py','Paraguay'),(5181,31,'Villa Elisa','py','Paraguay'),(5182,32,'Villarrica','py','Paraguay'),(5183,1,'Abancay','pe','Peru'),(5184,2,'Arequipa','pe','Peru'),(5185,3,'Ayacucho','pe','Peru'),(5186,4,'Cajamarca','pe','Peru'),(5187,5,'Cerro de Pasco','pe','Peru'),(5188,6,'Chachapoyas','pe','Peru'),(5189,7,'Chiclayo','pe','Peru'),(5190,8,'Chimbote','pe','Peru'),(5191,9,'Chincha Alta','pe','Peru'),(5192,10,'Cusco','pe','Peru'),(5193,11,'Huancavelica','pe','Peru'),(5194,12,'Huancayo','pe','Peru'),(5195,13,'Huánuco','pe','Peru'),(5196,14,'Ica','pe','Peru'),(5197,15,'Iquitos','pe','Peru'),(5198,16,'Juliaca','pe','Peru'),(5199,17,'Lima','pe','Peru'),(5200,18,'Moquegua','pe','Peru'),(5201,19,'Moyobamba','pe','Peru'),(5202,20,'Piura','pe','Peru'),(5203,21,'Pucallpa','pe','Peru'),(5204,22,'Puerto Maldonado','pe','Peru'),(5205,23,'Puno','pe','Peru'),(5206,24,'Sullana','pe','Peru'),(5207,25,'Tacna','pe','Peru'),(5208,26,'Talara','pe','Peru'),(5209,27,'Tarapoto','pe','Peru'),(5210,28,'Trujillo','pe','Peru'),(5211,29,'Tumbes','pe','Peru'),(5212,1,'Angeles','ph','Philippines'),(5213,2,'Antipolo','ph','Philippines'),(5214,3,'Bacolod','ph','Philippines'),(5215,4,'Bacoor','ph','Philippines'),(5216,5,'Baguio','ph','Philippines'),(5217,6,'Baliuag','ph','Philippines'),(5218,7,'Bangued','ph','Philippines'),(5219,8,'Biñan','ph','Philippines'),(5220,9,'Binangonan','ph','Philippines'),(5221,10,'Butuan','ph','Philippines'),(5222,11,'Cabanatuan','ph','Philippines'),(5223,12,'Cagayan','ph','Philippines'),(5224,13,'Cainta','ph','Philippines'),(5225,14,'Calamba','ph','Philippines'),(5226,15,'Calbayog','ph','Philippines'),(5227,16,'Cavite','ph','Philippines'),(5228,17,'Cebu','ph','Philippines'),(5229,18,'Cotabato','ph','Philippines'),(5230,19,'Dagupan','ph','Philippines'),(5231,20,'Davao','ph','Philippines'),(5232,21,'Dumaguete','ph','Philippines'),(5233,22,'Gapan','ph','Philippines'),(5234,23,'General Mariano Alvarez','ph','Philippines'),(5235,24,'General Santos','ph','Philippines'),(5236,25,'Guagua','ph','Philippines'),(5237,26,'Iloilo','ph','Philippines'),(5238,27,'Lapu-Lapu','ph','Philippines'),(5239,28,'Legaspi','ph','Philippines'),(5240,29,'Los Baños','ph','Philippines'),(5241,30,'Lucena','ph','Philippines'),(5242,31,'Malolos','ph','Philippines'),(5243,32,'Mandaue','ph','Philippines'),(5244,33,'Manila','ph','Philippines'),(5245,34,'Marawi','ph','Philippines'),(5246,35,'Meycauayan','ph','Philippines'),(5247,36,'Montalban','ph','Philippines'),(5248,37,'Naga','ph','Philippines'),(5249,38,'Olongapo','ph','Philippines'),(5250,39,'Roxas','ph','Philippines'),(5251,40,'San Fernando','ph','Philippines'),(5252,41,'San Fernando','ph','Philippines'),(5253,42,'San Mateo','ph','Philippines'),(5254,43,'San Pablo','ph','Philippines'),(5255,44,'San Pedro','ph','Philippines'),(5256,45,'Santa Cruz','ph','Philippines'),(5257,46,'Santa Rosa','ph','Philippines'),(5258,47,'Santiago','ph','Philippines'),(5259,48,'Sultan Kudarat','ph','Philippines'),(5260,49,'Tacloban','ph','Philippines'),(5261,50,'Tagum','ph','Philippines'),(5262,51,'Taytay','ph','Philippines'),(5263,52,'Toledo','ph','Philippines'),(5264,53,'Tuguegarao','ph','Philippines'),(5265,54,'Zamboanga','ph','Philippines'),(5266,1,'Bialystok','pl','Poland'),(5267,2,'Bielsko-Biala','pl','Poland'),(5268,3,'Bydgoszcz','pl','Poland'),(5269,4,'Bytom','pl','Poland'),(5270,5,'Chorzów','pl','Poland'),(5271,6,'Czestochowa','pl','Poland'),(5272,7,'Dabrowa Górnicza','pl','Poland'),(5273,8,'Elblag','pl','Poland'),(5274,9,'Gdansk','pl','Poland'),(5275,10,'Gdynia','pl','Poland'),(5276,11,'Gliwice','pl','Poland'),(5277,12,'Gorzów Wielkopolski','pl','Poland'),(5278,13,'Grudziadz','pl','Poland'),(5279,14,'Jastrzebie-Zdrój','pl','Poland'),(5280,15,'Kalisz','pl','Poland'),(5281,16,'Katowice','pl','Poland'),(5282,17,'Kielce','pl','Poland'),(5283,18,'Koszalin','pl','Poland'),(5284,19,'Kraków','pl','Poland'),(5285,20,'Legnica','pl','Poland'),(5286,21,'Lódz','pl','Poland'),(5287,22,'Lublin','pl','Poland'),(5288,23,'Olsztyn','pl','Poland'),(5289,24,'Opole','pl','Poland'),(5290,25,'Plock','pl','Poland'),(5291,26,'Poznan','pl','Poland'),(5292,27,'Radom','pl','Poland'),(5293,28,'Ruda Slaska','pl','Poland'),(5294,29,'Rybnik','pl','Poland'),(5295,30,'Rzeszów','pl','Poland'),(5296,31,'Slupsk','pl','Poland'),(5297,32,'Sosnowiec','pl','Poland'),(5298,33,'Szczecin','pl','Poland'),(5299,34,'Tarnów','pl','Poland'),(5300,35,'Torun','pl','Poland'),(5301,36,'Tychy','pl','Poland'),(5302,37,'Walbrzych','pl','Poland'),(5303,38,'Warszawa','pl','Poland'),(5304,39,'Wloclawek','pl','Poland'),(5305,40,'Wroclaw','pl','Poland'),(5306,41,'Zabrze','pl','Poland'),(5307,42,'Zielona Góra','pl','Poland'),(5308,1,'Agualva-Cacém','pt','Portugal'),(5309,2,'Algueirão-Mem Martins','pt','Portugal'),(5310,3,'Amadora','pt','Portugal'),(5311,4,'Amora','pt','Portugal'),(5312,5,'Aveiro','pt','Portugal'),(5313,6,'Barreiro','pt','Portugal'),(5314,7,'Braga','pt','Portugal'),(5315,8,'Coimbra','pt','Portugal'),(5316,9,'Corroios','pt','Portugal'),(5317,10,'Évora','pt','Portugal'),(5318,11,'Faro','pt','Portugal'),(5319,12,'Funchal','pt','Portugal'),(5320,13,'Lisboa','pt','Portugal'),(5321,14,'Loures','pt','Portugal'),(5322,15,'Odivelas','pt','Portugal'),(5323,16,'Ponta Delgada','pt','Portugal'),(5324,17,'Porto','pt','Portugal'),(5325,18,'Queluz','pt','Portugal'),(5326,19,'Rio de Mouro','pt','Portugal'),(5327,20,'Rio Tinto','pt','Portugal'),(5328,21,'Setúbal','pt','Portugal'),(5329,22,'Vila Nova de Gaia','pt','Portugal'),(5330,1,'Aguadilla','pr','Puerto Rico'),(5331,2,'Arecibo','pr','Puerto Rico'),(5332,3,'Bayamón','pr','Puerto Rico'),(5333,4,'Caguas','pr','Puerto Rico'),(5334,5,'Candelaria','pr','Puerto Rico'),(5335,6,'Carolina','pr','Puerto Rico'),(5336,7,'Cataño','pr','Puerto Rico'),(5337,8,'Cayey','pr','Puerto Rico'),(5338,9,'Fajardo','pr','Puerto Rico'),(5339,10,'Guayama','pr','Puerto Rico'),(5340,11,'Guaynabo','pr','Puerto Rico'),(5341,12,'Humacao','pr','Puerto Rico'),(5342,13,'Levittown','pr','Puerto Rico'),(5343,14,'Mayagüez','pr','Puerto Rico'),(5344,15,'Ponce','pr','Puerto Rico'),(5345,16,'Río Grande','pr','Puerto Rico'),(5346,17,'San Juan','pr','Puerto Rico'),(5347,18,'Trujillo Alto','pr','Puerto Rico'),(5348,19,'Vega Baja','pr','Puerto Rico'),(5349,20,'Yauco','pr','Puerto Rico'),(5350,1,'ad-Dawhah','qa','Qatar'),(5351,2,'al-Ghuwayrîyah','qa','Qatar'),(5352,3,'al-Jumaylîyah','qa','Qatar'),(5353,4,'al-Khawr','qa','Qatar'),(5354,5,'al-Wakrah','qa','Qatar'),(5355,6,'al-Wukayr','qa','Qatar'),(5356,7,'ar-Rayyân','qa','Qatar'),(5357,8,'ar-Ruways','qa','Qatar'),(5358,9,'ash-Shahanîyah','qa','Qatar'),(5359,10,'Dukhân','qa','Qatar'),(5360,11,'Musay´id','qa','Qatar'),(5361,12,'Umm Bâb','qa','Qatar'),(5362,13,'Umm Salal','qa','Qatar'),(5363,1,'Bras-Panon','re','Réunion'),(5364,2,'La Possession','re','Réunion'),(5365,3,'Le Port','re','Réunion'),(5366,4,'Le Tampon','re','Réunion'),(5367,5,'Les Aviron','re','Réunion'),(5368,6,'Les Trois-Bassins','re','Réunion'),(5369,7,'L\'Étang-Salé','re','Réunion'),(5370,8,'Petite-Ile','re','Réunion'),(5371,9,'Saint-André','re','Réunion'),(5372,10,'Saint-Benoit','re','Réunion'),(5373,11,'Saint-Denis','re','Réunion'),(5374,12,'Sainte-Marie','re','Réunion'),(5375,13,'Sainte-Rose','re','Réunion'),(5376,14,'Sainte-Suzanne','re','Réunion'),(5377,15,'Saint-Joseph','re','Réunion'),(5378,16,'Saint-Leu','re','Réunion'),(5379,17,'Saint-Louis','re','Réunion'),(5380,18,'Saint-Paul','re','Réunion'),(5381,19,'Saint-Pierre','re','Réunion'),(5382,20,'Salazie','re','Réunion'),(5383,1,'Arad','ro','Romania'),(5384,2,'Bacau','ro','Romania'),(5385,3,'Baia Mare','ro','Romania'),(5386,4,'Botosani','ro','Romania'),(5387,5,'Braila','ro','Romania'),(5388,6,'Brasov','ro','Romania'),(5389,7,'Bucuresti','ro','Romania'),(5390,8,'Buzau','ro','Romania'),(5391,9,'Cluj-Napoca','ro','Romania'),(5392,10,'Constanta','ro','Romania'),(5393,11,'Craiova','ro','Romania'),(5394,12,'Drobeta-Turnu Severin','ro','Romania'),(5395,13,'Focsani','ro','Romania'),(5396,14,'Galati','ro','Romania'),(5397,15,'Iasi','ro','Romania'),(5398,16,'Oradea','ro','Romania'),(5399,17,'Piatra Neamt','ro','Romania'),(5400,18,'Pitesti','ro','Romania'),(5401,19,'Ploiesti','ro','Romania'),(5402,20,'Râmnicu Vâlcea','ro','Romania'),(5403,21,'Satu Mare','ro','Romania'),(5404,22,'Sibiu','ro','Romania'),(5405,23,'Suceava','ro','Romania'),(5406,24,'Târgu-Mures','ro','Romania'),(5407,25,'Timisoara','ro','Romania'),(5408,1,'Abakan','ru','Russia'),(5409,2,'Achinsk','ru','Russia'),(5410,3,'Aginskoje','ru','Russia'),(5411,4,'Almetjevsk','ru','Russia'),(5412,5,'Anadyr','ru','Russia'),(5413,6,'Angarsk','ru','Russia'),(5414,7,'Arhangelsk','ru','Russia'),(5415,8,'Armavir','ru','Russia'),(5416,9,'Arzamas','ru','Russia'),(5417,10,'Astrahan','ru','Russia'),(5418,11,'Balakovo','ru','Russia'),(5419,12,'Balashiha','ru','Russia'),(5420,13,'Barnaul','ru','Russia'),(5421,14,'Belgorod','ru','Russia'),(5422,15,'Berezniki','ru','Russia'),(5423,16,'Bijsk','ru','Russia'),(5424,17,'Birobidzhan','ru','Russia'),(5425,18,'Blagoveshchensk','ru','Russia'),(5426,19,'Bratsk','ru','Russia'),(5427,20,'Brjansk','ru','Russia'),(5428,21,'Cheboksary','ru','Russia'),(5429,22,'Cheljabinsk','ru','Russia'),(5430,23,'Cherepovec','ru','Russia'),(5431,24,'Cherkessk','ru','Russia'),(5432,25,'Chita','ru','Russia'),(5433,26,'Dimitrovgrad','ru','Russia'),(5434,27,'Dudinka','ru','Russia'),(5435,28,'Dzerzhinsk','ru','Russia'),(5436,29,'Elektrostal','ru','Russia'),(5437,30,'Elista','ru','Russia'),(5438,31,'Engels','ru','Russia'),(5439,32,'Glazov','ru','Russia'),(5440,33,'Gorno-Altajsk','ru','Russia'),(5441,34,'Groznyj','ru','Russia'),(5442,35,'Habarovsk','ru','Russia'),(5443,36,'Hanty-Mansijsk','ru','Russia'),(5444,37,'Himki','ru','Russia'),(5445,38,'Irkutsk','ru','Russia'),(5446,39,'Ivanovo','ru','Russia'),(5447,40,'Izhevsk','ru','Russia'),(5448,41,'Jakutsk','ru','Russia'),(5449,42,'Jaroslavl','ru','Russia'),(5450,43,'Jekaterinburg','ru','Russia'),(5451,44,'Jelec','ru','Russia'),(5452,45,'Jessentuki','ru','Russia'),(5453,46,'Joshkar-Ola','ru','Russia'),(5454,47,'Juzhno-Sahalinsk','ru','Russia'),(5455,48,'Kaliningrad','ru','Russia'),(5456,49,'Kaluga','ru','Russia'),(5457,50,'Kamensk-Uralskij','ru','Russia'),(5458,51,'Kamyshin','ru','Russia'),(5459,52,'Kansk','ru','Russia'),(5460,53,'Kazan','ru','Russia'),(5461,54,'Kemerovo','ru','Russia'),(5462,55,'Kirov','ru','Russia'),(5463,56,'Kiseljovsk','ru','Russia'),(5464,57,'Kislovodsk','ru','Russia'),(5465,58,'Kolomna','ru','Russia'),(5466,59,'Kolpino','ru','Russia'),(5467,60,'Komsomolsk-na-Amure','ru','Russia'),(5468,61,'Korolyov','ru','Russia'),(5469,62,'Kostroma','ru','Russia'),(5470,63,'Kovrov','ru','Russia'),(5471,64,'Krasnodar','ru','Russia'),(5472,65,'Krasnojarsk','ru','Russia'),(5473,66,'Kudymkar','ru','Russia'),(5474,67,'Kurgan','ru','Russia'),(5475,68,'Kursk','ru','Russia'),(5476,69,'Kyzyl','ru','Russia'),(5477,70,'Leninsk-Kuzneckij','ru','Russia'),(5478,71,'Lipeck','ru','Russia'),(5479,72,'Ljubercy','ru','Russia'),(5480,73,'Magadan','ru','Russia'),(5481,74,'Magnitogorsk','ru','Russia'),(5482,75,'Mahackala','ru','Russia'),(5483,76,'Majkop','ru','Russia'),(5484,77,'Mezhdurechensk','ru','Russia'),(5485,78,'Miass','ru','Russia'),(5486,79,'Michurinsk','ru','Russia'),(5487,80,'Moskva','ru','Russia'),(5488,81,'Murmansk','ru','Russia'),(5489,82,'Murom','ru','Russia'),(5490,83,'Mytishchi','ru','Russia'),(5491,84,'Naberezhnyje Chelny','ru','Russia'),(5492,85,'Nahodka','ru','Russia'),(5493,86,'Nalchik','ru','Russia'),(5494,87,'Narjan-Mar','ru','Russia'),(5495,88,'Nazran','ru','Russia'),(5496,89,'Neftekamsk','ru','Russia'),(5497,90,'Nevinnomyssk','ru','Russia'),(5498,91,'Nizhnekamsk','ru','Russia'),(5499,92,'Nizhnevartovsk','ru','Russia'),(5500,93,'Nizhnij Novgorod','ru','Russia'),(5501,94,'Nizhnij Tagil','ru','Russia'),(5502,95,'Noginsk','ru','Russia'),(5503,96,'Norilsk','ru','Russia'),(5504,97,'Novocheboksarsk','ru','Russia'),(5505,98,'Novocherkassk','ru','Russia'),(5506,99,'Novokujbyshevsk','ru','Russia'),(5507,100,'Novokuzneck','ru','Russia'),(5508,101,'Novomoskovsk','ru','Russia'),(5509,102,'Novorossijsk','ru','Russia'),(5510,103,'Novoshahtinsk','ru','Russia'),(5511,104,'Novosibirsk','ru','Russia'),(5512,105,'Novotroick','ru','Russia'),(5513,106,'Obninsk','ru','Russia'),(5514,107,'Odincovo','ru','Russia'),(5515,108,'Oktjabrskij','ru','Russia'),(5516,109,'Omsk','ru','Russia'),(5517,110,'Orehovo-Zujevo','ru','Russia'),(5518,111,'Orenburg','ru','Russia'),(5519,112,'Orjol','ru','Russia'),(5520,113,'Orsk','ru','Russia'),(5521,114,'Palana','ru','Russia'),(5522,115,'Penza','ru','Russia'),(5523,116,'Perm','ru','Russia'),(5524,117,'Pervouralsk','ru','Russia'),(5525,118,'Petropavlovsk-Kamchatskij','ru','Russia'),(5526,119,'Petrozavodsk','ru','Russia'),(5527,120,'Pjatigorsk','ru','Russia'),(5528,121,'Podolsk','ru','Russia'),(5529,122,'Prokopjevsk','ru','Russia'),(5530,123,'Pskov','ru','Russia'),(5531,124,'Rjazan','ru','Russia'),(5532,125,'Rostov','ru','Russia'),(5533,126,'Rubcovsk','ru','Russia'),(5534,127,'Rybinsk','ru','Russia'),(5535,128,'Salavat','ru','Russia'),(5536,129,'Salehard','ru','Russia'),(5537,130,'Samara','ru','Russia'),(5538,131,'Sankt Peterburg','ru','Russia'),(5539,132,'Saransk','ru','Russia'),(5540,133,'Sarapul','ru','Russia'),(5541,134,'Saratov','ru','Russia'),(5542,135,'Sergijev Posad','ru','Russia'),(5543,136,'Serpuhov','ru','Russia'),(5544,137,'Severodvinsk','ru','Russia'),(5545,138,'Seversk','ru','Russia'),(5546,139,'Shahty','ru','Russia'),(5547,140,'Shchjolkovo','ru','Russia'),(5548,141,'Smolensk','ru','Russia'),(5549,142,'Sochi','ru','Russia'),(5550,143,'Solikamsk','ru','Russia'),(5551,144,'Staryj Oskol','ru','Russia'),(5552,145,'Stavropol','ru','Russia'),(5553,146,'Sterlitamak','ru','Russia'),(5554,147,'Surgut','ru','Russia'),(5555,148,'Syktyvkar','ru','Russia'),(5556,149,'Syzran','ru','Russia'),(5557,150,'Taganrog','ru','Russia'),(5558,151,'Tambov','ru','Russia'),(5559,152,'Tjumen','ru','Russia'),(5560,153,'Toljatti','ru','Russia'),(5561,154,'Tomsk','ru','Russia'),(5562,155,'Tula','ru','Russia'),(5563,156,'Tura','ru','Russia'),(5564,157,'Tver','ru','Russia'),(5565,158,'Ufa','ru','Russia'),(5566,159,'Ulan-Ude','ru','Russia'),(5567,160,'Uljanovsk','ru','Russia'),(5568,161,'Usolje-Sibirskoje','ru','Russia'),(5569,162,'Ussurijsk','ru','Russia'),(5570,163,'Ust-Ilimsk','ru','Russia'),(5571,164,'Ust-Ordynskij','ru','Russia'),(5572,165,'Velikij Novgorod','ru','Russia'),(5573,166,'Velikije Luki','ru','Russia'),(5574,167,'Vladikavkaz','ru','Russia'),(5575,168,'Vladimir','ru','Russia'),(5576,169,'Vladivostok','ru','Russia'),(5577,170,'Volgodonsk','ru','Russia'),(5578,171,'Volgograd','ru','Russia'),(5579,172,'Vologda','ru','Russia'),(5580,173,'Volzhskij','ru','Russia'),(5581,174,'Voronezh','ru','Russia'),(5582,175,'Votkinsk','ru','Russia'),(5583,176,'Zeljenograd','ru','Russia'),(5584,177,'Zlatoust','ru','Russia'),(5585,1,'Butare','rw','Rwanda'),(5586,2,'Byumba','rw','Rwanda'),(5587,3,'Cyangugu','rw','Rwanda'),(5588,4,'Gikongoro','rw','Rwanda'),(5589,5,'Gisenyi','rw','Rwanda'),(5590,6,'Gitarama','rw','Rwanda'),(5591,7,'Kibungo','rw','Rwanda'),(5592,8,'Kibuye','rw','Rwanda'),(5593,9,'Kigali','rw','Rwanda'),(5594,10,'Nyanza','rw','Rwanda'),(5595,11,'Ruhengeri','rw','Rwanda'),(5596,12,'Rwamagana','rw','Rwanda'),(5597,1,'ad-Dakhlah','eh','Sahara'),(5598,2,'al-´Ayûn','eh','Sahara'),(5599,3,'as-Samârah','eh','Sahara'),(5600,4,'Bû Jaydûr','eh','Sahara'),(5601,1,'Edinburgh','sh','Saint Helena'),(5602,2,'Georgetown','sh','Saint Helena'),(5603,3,'Gough Island','sh','Saint Helena'),(5604,4,'Jamestown','sh','Saint Helena'),(5605,1,'Basseterre','kn','Saint Kitts and Nevis'),(5606,2,'Boyds','kn','Saint Kitts and Nevis'),(5607,3,'Cayon','kn','Saint Kitts and Nevis'),(5608,4,'Charlestown','kn','Saint Kitts and Nevis'),(5609,5,'Cotton Ground','kn','Saint Kitts and Nevis'),(5610,6,'Dieppe Bay','kn','Saint Kitts and Nevis'),(5611,7,'Fig Tree','kn','Saint Kitts and Nevis'),(5612,8,'Gingerland','kn','Saint Kitts and Nevis'),(5613,9,'Mansion','kn','Saint Kitts and Nevis'),(5614,10,'Middle Island','kn','Saint Kitts and Nevis'),(5615,11,'Monkey Hill','kn','Saint Kitts and Nevis'),(5616,12,'Newcastle','kn','Saint Kitts and Nevis'),(5617,13,'Old Road','kn','Saint Kitts and Nevis'),(5618,14,'Sadlers','kn','Saint Kitts and Nevis'),(5619,15,'Saint Paul\'s','kn','Saint Kitts and Nevis'),(5620,16,'Sandy Point','kn','Saint Kitts and Nevis'),(5621,17,'Tabernacle','kn','Saint Kitts and Nevis'),(5622,1,'Anse-la-Raye','lc','Saint Lucia'),(5623,2,'Canaries','lc','Saint Lucia'),(5624,3,'Cap Estate','lc','Saint Lucia'),(5625,4,'Castries','lc','Saint Lucia'),(5626,5,'Choc','lc','Saint Lucia'),(5627,6,'Choiseul','lc','Saint Lucia'),(5628,7,'Dennery','lc','Saint Lucia'),(5629,8,'Gros Islet','lc','Saint Lucia'),(5630,9,'Laborie','lc','Saint Lucia'),(5631,10,'Micoud','lc','Saint Lucia'),(5632,11,'Soufrière','lc','Saint Lucia'),(5633,12,'Vieux Fort','lc','Saint Lucia'),(5634,1,'Miquelon','pm','Saint Pierre & Miquelon'),(5635,2,'Saint-Pierre','pm','Saint Pierre & Miquelon'),(5636,1,'Barroualie','vc','St. Vincent & the Grenadines'),(5637,2,'Biabou','vc','St. Vincent & the Grenadines'),(5638,3,'Byera','vc','St. Vincent & the Grenadines'),(5639,4,'Chateaubelair','vc','St. Vincent & the Grenadines'),(5640,5,'Dovers','vc','St. Vincent & the Grenadines'),(5641,6,'Georgetown','vc','St. Vincent & the Grenadines'),(5642,7,'Hamilton','vc','St. Vincent & the Grenadines'),(5643,8,'Kingstown','vc','St. Vincent & the Grenadines'),(5644,9,'Layou','vc','St. Vincent & the Grenadines'),(5645,10,'Port Elizabeth','vc','St. Vincent & the Grenadines'),(5646,1,'A\'opo','ws','Samoa'),(5647,2,'Apia','ws','Samoa'),(5648,3,'Falelatai','ws','Samoa'),(5649,4,'Gautavai','ws','Samoa'),(5650,5,'Mulifanua','ws','Samoa'),(5651,6,'Neiafu','ws','Samoa'),(5652,7,'Safotulafai','ws','Samoa'),(5653,8,'Samalae\'ulu','ws','Samoa'),(5654,9,'Samamea','ws','Samoa'),(5655,10,'Solosolo','ws','Samoa'),(5656,11,'Taga','ws','Samoa'),(5657,1,'Acquaviva','sm','San Marino'),(5658,2,'Borgo Maggiore','sm','San Marino'),(5659,3,'Chiesanuova','sm','San Marino'),(5660,4,'Domagnano','sm','San Marino'),(5661,5,'Faetano','sm','San Marino'),(5662,6,'Fiorentino','sm','San Marino'),(5663,7,'Montegiardino','sm','San Marino'),(5664,8,'San Marino','sm','San Marino'),(5665,9,'Serravalle','sm','San Marino'),(5666,1,'Neves','st','São Tomé and Príncipe'),(5667,2,'Santana','st','São Tomé and Príncipe'),(5668,3,'Santo Amaro','st','São Tomé and Príncipe'),(5669,4,'Santo António','st','São Tomé and Príncipe'),(5670,5,'São Tomé','st','São Tomé and Príncipe'),(5671,6,'Trindade','st','São Tomé and Príncipe'),(5672,1,'´Unayzah','sa','Saudi Arabia'),(5673,2,'Abhâ','sa','Saudi Arabia'),(5674,3,'ad-Dammâm','sa','Saudi Arabia'),(5675,4,'al-Bâhah','sa','Saudi Arabia'),(5676,5,'al-Hawîyah','sa','Saudi Arabia'),(5677,6,'al-Hufûf','sa','Saudi Arabia'),(5678,7,'al-Kharj','sa','Saudi Arabia'),(5679,8,'al-Khubar','sa','Saudi Arabia'),(5680,9,'al-Madînah','sa','Saudi Arabia'),(5681,10,'al-Mubarraz','sa','Saudi Arabia'),(5682,11,'al-Qatîf','sa','Saudi Arabia'),(5683,12,'Ara´ar','sa','Saudi Arabia'),(5684,13,'ar-Riyâd','sa','Saudi Arabia'),(5685,14,'ath-Thuqbah','sa','Saudi Arabia'),(5686,15,'at-Ta´if','sa','Saudi Arabia'),(5687,16,'Buraydah','sa','Saudi Arabia'),(5688,17,'Hâ´il','sa','Saudi Arabia'),(5689,18,'Hafar-al-Bâtin','sa','Saudi Arabia'),(5690,19,'Jawf','sa','Saudi Arabia'),(5691,20,'Jiddah','sa','Saudi Arabia'),(5692,21,'Jîzân','sa','Saudi Arabia'),(5693,22,'Jubayl','sa','Saudi Arabia'),(5694,23,'Khamîs Mushayt','sa','Saudi Arabia'),(5695,24,'Makkah','sa','Saudi Arabia'),(5696,25,'Najrân','sa','Saudi Arabia'),(5697,26,'Tabûk','sa','Saudi Arabia'),(5698,27,'Yanbu','sa','Saudi Arabia'),(5699,1,'Bambey','sn','Senegal'),(5700,2,'Bignona','sn','Senegal'),(5701,3,'Dakar','sn','Senegal'),(5702,4,'Diourbel','sn','Senegal'),(5703,5,'Fatick','sn','Senegal'),(5704,6,'Joal-Fadiouth','sn','Senegal'),(5705,7,'Kaffrine','sn','Senegal'),(5706,8,'Kaolack','sn','Senegal'),(5707,9,'Kayar','sn','Senegal'),(5708,10,'Kolda','sn','Senegal'),(5709,11,'Louga','sn','Senegal'),(5710,12,'Mbacké','sn','Senegal'),(5711,13,'Mbour','sn','Senegal'),(5712,14,'Pout','sn','Senegal'),(5713,15,'Richard Toll','sn','Senegal'),(5714,16,'Saint-Louis','sn','Senegal'),(5715,17,'Tambacounda','sn','Senegal'),(5716,18,'Thiès','sn','Senegal'),(5717,19,'Tivaouane','sn','Senegal'),(5718,20,'Ziguinchor','sn','Senegal'),(5719,1,'Beograd','yu','Serbia and Montenegro'),(5720,2,'Chachak','yu','Serbia and Montenegro'),(5721,3,'Dhakovica','yu','Serbia and Montenegro'),(5722,4,'Gnjilane','yu','Serbia and Montenegro'),(5723,5,'Kosovska Mitrovica','yu','Serbia and Montenegro'),(5724,6,'Kragujevac','yu','Serbia and Montenegro'),(5725,7,'Kraljevo','yu','Serbia and Montenegro'),(5726,8,'Leskovac','yu','Serbia and Montenegro'),(5727,9,'Nikshic','yu','Serbia and Montenegro'),(5728,10,'Nish','yu','Serbia and Montenegro'),(5729,11,'Novi Sad','yu','Serbia and Montenegro'),(5730,12,'Panchevo','yu','Serbia and Montenegro'),(5731,13,'Pec','yu','Serbia and Montenegro'),(5732,14,'Podgorica','yu','Serbia and Montenegro'),(5733,15,'Prishtina','yu','Serbia and Montenegro'),(5734,16,'Prizren','yu','Serbia and Montenegro'),(5735,17,'Smederevo','yu','Serbia and Montenegro'),(5736,18,'Subotica','yu','Serbia and Montenegro'),(5737,19,'Valjevo','yu','Serbia and Montenegro'),(5738,20,'Zrenjanin','yu','Serbia and Montenegro'),(5739,1,'Anse Boileau','sc','Seychelles'),(5740,2,'Anse Royal','sc','Seychelles'),(5741,3,'Cascade','sc','Seychelles'),(5742,4,'Takamaka','sc','Seychelles'),(5743,5,'Victoria','sc','Seychelles'),(5744,1,'Binkolo','sl','Sierra Leone'),(5745,2,'Bo','sl','Sierra Leone'),(5746,3,'Bonthe','sl','Sierra Leone'),(5747,4,'Freetown','sl','Sierra Leone'),(5748,5,'Kabala','sl','Sierra Leone'),(5749,6,'Kailahun','sl','Sierra Leone'),(5750,7,'Kenema','sl','Sierra Leone'),(5751,8,'Koidu','sl','Sierra Leone'),(5752,9,'Koindu','sl','Sierra Leone'),(5753,10,'Lunsar','sl','Sierra Leone'),(5754,11,'Magburaka','sl','Sierra Leone'),(5755,12,'Makeni','sl','Sierra Leone'),(5756,13,'Matru','sl','Sierra Leone'),(5757,14,'Pepel','sl','Sierra Leone'),(5758,15,'Port Loko','sl','Sierra Leone'),(5759,16,'Sefadu','sl','Sierra Leone'),(5760,17,'Taiama','sl','Sierra Leone'),(5761,18,'Yele','sl','Sierra Leone'),(5762,19,'Yengema','sl','Sierra Leone'),(5763,20,'York','sl','Sierra Leone'),(5764,1,'Singapore','sg','Singapore'),(5765,1,'Banská Bystrica','sk','Slovakia'),(5766,2,'Bardejov','sk','Slovakia'),(5767,3,'Bratislava','sk','Slovakia'),(5768,4,'Humenné','sk','Slovakia'),(5769,5,'Komárno','sk','Slovakia'),(5770,6,'Koshice','sk','Slovakia'),(5771,7,'Levice','sk','Slovakia'),(5772,8,'Martin','sk','Slovakia'),(5773,9,'Michalovce','sk','Slovakia'),(5774,10,'Nitra','sk','Slovakia'),(5775,11,'Nové Zámky','sk','Slovakia'),(5776,12,'Poprad','sk','Slovakia'),(5777,13,'Povazhská Bystrica','sk','Slovakia'),(5778,14,'Preshov','sk','Slovakia'),(5779,15,'Prievidza','sk','Slovakia'),(5780,16,'Spishská Nová Ves','sk','Slovakia'),(5781,17,'Trenchín','sk','Slovakia'),(5782,18,'Trnava','sk','Slovakia'),(5783,19,'Zhilina','sk','Slovakia'),(5784,20,'Zvolen','sk','Slovakia'),(5785,1,'Celje','si','Slovenia'),(5786,2,'Domzhale','si','Slovenia'),(5787,3,'Izola','si','Slovenia'),(5788,4,'Jesenice','si','Slovenia'),(5789,5,'Kamnik','si','Slovenia'),(5790,6,'Kochevje','si','Slovenia'),(5791,7,'Koper','si','Slovenia'),(5792,8,'Kranj','si','Slovenia'),(5793,9,'Krshko','si','Slovenia'),(5794,10,'Ljubljana','si','Slovenia'),(5795,11,'Maribor','si','Slovenia'),(5796,12,'Murska Sobota','si','Slovenia'),(5797,13,'Nova Gorica','si','Slovenia'),(5798,14,'Novo Mesto','si','Slovenia'),(5799,15,'Postojna','si','Slovenia'),(5800,16,'Ptuj','si','Slovenia'),(5801,17,'Ravne','si','Slovenia'),(5802,18,'Shkofja Loka','si','Slovenia'),(5803,19,'Slovenj Gradec','si','Slovenia'),(5804,20,'Trbovlje','si','Slovenia'),(5805,21,'Velenje','si','Slovenia'),(5806,1,'Adamstown','xg','Smaller Territories of the UK'),(5807,1,'Auki','sb','Solomon Islands'),(5808,2,'Buala','sb','Solomon Islands'),(5809,3,'Gizo','sb','Solomon Islands'),(5810,4,'Honiara','sb','Solomon Islands'),(5811,5,'Kirakira','sb','Solomon Islands'),(5812,6,'Lata','sb','Solomon Islands'),(5813,7,'Taro Island','sb','Solomon Islands'),(5814,8,'Tigoa','sb','Solomon Islands'),(5815,9,'Tulagi','sb','Solomon Islands'),(5816,1,'´Adâdlay','so','Somalia'),(5817,2,'´Êldhêre','so','Somalia'),(5818,3,'´Êrigabo','so','Somalia'),(5819,4,'Afgôye','so','Somalia'),(5820,5,'Awdhêgle','so','Somalia'),(5821,6,'Baki','so','Somalia'),(5822,7,'Barâwe','so','Somalia'),(5823,8,'Bârdhêre','so','Somalia'),(5824,9,'Baydhabo','so','Somalia'),(5825,10,'Beled Wêyne','so','Somalia'),(5826,11,'Berbera','so','Somalia'),(5827,12,'Bôsâso','so','Somalia'),(5828,13,'Bûr Hakkaba','so','Somalia'),(5829,14,'Bur´o','so','Somalia'),(5830,15,'Dhûsa Marrêb','so','Somalia'),(5831,16,'Gâlka´yo','so','Somalia'),(5832,17,'Garbahârey','so','Somalia'),(5833,18,'Garôwe','so','Somalia'),(5834,19,'Hargeysa','so','Somalia'),(5835,20,'Jamâme','so','Somalia'),(5836,21,'Jawhar','so','Somalia'),(5837,22,'Jilib','so','Somalia'),(5838,23,'Kismâyo','so','Somalia'),(5839,24,'Lâs´ânôd','so','Somalia'),(5840,25,'Marka','so','Somalia'),(5841,26,'Muqdîsho','so','Somalia'),(5842,27,'Qoryôley','so','Somalia'),(5843,28,'Wanlaweyn','so','Somalia'),(5844,29,'Xuddur','so','Somalia'),(5845,1,'Alberton','za','South Africa'),(5846,2,'Benoni','za','South Africa'),(5847,3,'Bisho','za','South Africa'),(5848,4,'Bloemfontein','za','South Africa'),(5849,5,'Boksburg','za','South Africa'),(5850,6,'Botshabelo','za','South Africa'),(5851,7,'Brakpan','za','South Africa'),(5852,8,'Cape Town','za','South Africa'),(5853,9,'Carltonville','za','South Africa'),(5854,10,'Durban','za','South Africa'),(5855,11,'East London','za','South Africa'),(5856,12,'Emnambithi','za','South Africa'),(5857,13,'George','za','South Africa'),(5858,14,'Johannesburg','za','South Africa'),(5859,15,'Kimberley','za','South Africa'),(5860,16,'Klerksdorp','za','South Africa'),(5861,17,'Krugersdorp','za','South Africa'),(5862,18,'Mhluzi','za','South Africa'),(5863,19,'Midrand','za','South Africa'),(5864,20,'Mmabatho','za','South Africa'),(5865,21,'Mogalakwena','za','South Africa'),(5866,22,'Msunduzi','za','South Africa'),(5867,23,'Nelspruit','za','South Africa'),(5868,24,'Newcastle','za','South Africa'),(5869,25,'Nigel','za','South Africa'),(5870,26,'Paarl','za','South Africa'),(5871,27,'Phalaborwa','za','South Africa'),(5872,28,'Pietersburg','za','South Africa'),(5873,29,'Port Elizabeth','za','South Africa'),(5874,30,'Potchefstroom','za','South Africa'),(5875,31,'Pretoria','za','South Africa'),(5876,32,'Randfontein','za','South Africa'),(5877,33,'Rustenburg','za','South Africa'),(5878,34,'Somerset West','za','South Africa'),(5879,35,'Soweto','za','South Africa'),(5880,36,'Springs','za','South Africa'),(5881,37,'Tembisa','za','South Africa'),(5882,38,'Uitenhage','za','South Africa'),(5883,39,'Vanderbijlpark','za','South Africa'),(5884,40,'Vereeniging','za','South Africa'),(5885,41,'Verwoerdburg','za','South Africa'),(5886,42,'Welkom','za','South Africa'),(5887,43,'Westonaria','za','South Africa'),(5888,44,'Witbank','za','South Africa'),(5889,1,'A Coruña','es','Spain'),(5890,2,'Alacant','es','Spain'),(5891,3,'Albacete','es','Spain'),(5892,4,'Alcalá de Henares','es','Spain'),(5893,5,'Alcorcón','es','Spain'),(5894,6,'Algeciras','es','Spain'),(5895,7,'Almería','es','Spain'),(5896,8,'Ávila','es','Spain'),(5897,9,'Badajoz','es','Spain'),(5898,10,'Badalona','es','Spain'),(5899,11,'Barcelona','es','Spain'),(5900,12,'Bilbao','es','Spain'),(5901,13,'Burgos','es','Spain'),(5902,14,'Cáceres','es','Spain'),(5903,15,'Cádiz','es','Spain'),(5904,16,'Cartagena','es','Spain'),(5905,17,'Castelló','es','Spain'),(5906,18,'Ceuta','es','Spain'),(5907,19,'Ciudad Real','es','Spain'),(5908,20,'Córdoba','es','Spain'),(5909,21,'Cuenca','es','Spain'),(5910,22,'Donostia','es','Spain'),(5911,23,'Dos Hermanas','es','Spain'),(5912,24,'Elx','es','Spain'),(5913,25,'Fuenlabrada','es','Spain'),(5914,26,'Getafe','es','Spain'),(5915,27,'Gijón','es','Spain'),(5916,28,'Girona','es','Spain'),(5917,29,'Granada','es','Spain'),(5918,30,'Guadalajara','es','Spain'),(5919,31,'Huelva','es','Spain'),(5920,32,'Huesca','es','Spain'),(5921,33,'Iruña','es','Spain'),(5922,34,'Jaén','es','Spain'),(5923,35,'Jerez','es','Spain'),(5924,36,'Las Palmas','es','Spain'),(5925,37,'Leganés','es','Spain'),(5926,38,'León','es','Spain'),(5927,39,'L\'Hospitalet de Llobregat','es','Spain'),(5928,40,'Lleida','es','Spain'),(5929,41,'Logroño','es','Spain'),(5930,42,'Lugo','es','Spain'),(5931,43,'Madrid','es','Spain'),(5932,44,'Málaga','es','Spain'),(5933,45,'Marbella','es','Spain'),(5934,46,'Mataró','es','Spain'),(5935,47,'Melilla','es','Spain'),(5936,48,'Móstoles','es','Spain'),(5937,49,'Murcia','es','Spain'),(5938,50,'Ourense','es','Spain'),(5939,51,'Oviedo','es','Spain'),(5940,52,'Palencia','es','Spain'),(5941,53,'Palma','es','Spain'),(5942,54,'Pontevedra','es','Spain'),(5943,55,'Sabadell','es','Spain'),(5944,56,'Salamanca','es','Spain'),(5945,57,'San Cristóbal de la Laguna','es','Spain'),(5946,58,'Santa Coloma de Gramenet','es','Spain'),(5947,59,'Santa Cruz de Tenerife','es','Spain'),(5948,60,'Santander','es','Spain'),(5949,61,'Segovia','es','Spain'),(5950,62,'Sevilla','es','Spain'),(5951,63,'Soria','es','Spain'),(5952,64,'Tarragona','es','Spain'),(5953,65,'Terrassa','es','Spain'),(5954,66,'Teruel','es','Spain'),(5955,67,'Toledo','es','Spain'),(5956,68,'Torrejón de Ardoz','es','Spain'),(5957,69,'Valencia','es','Spain'),(5958,70,'Valladolid','es','Spain'),(5959,71,'Vigo','es','Spain'),(5960,72,'Vitoria','es','Spain'),(5961,73,'Zamora','es','Spain'),(5962,74,'Zaragoza','es','Spain'),(5963,1,'Amparai','lk','Sri Lanka'),(5964,2,'Anurâdhapûraya','lk','Sri Lanka'),(5965,3,'Badulla','lk','Sri Lanka'),(5966,4,'Battaramulla','lk','Sri Lanka'),(5967,5,'Châvâkachchêri','lk','Sri Lanka'),(5968,6,'Daluguma','lk','Sri Lanka'),(5969,7,'Dambulla','lk','Sri Lanka'),(5970,8,'Dehiwala-Mount Lavinia','lk','Sri Lanka'),(5971,9,'Gâlla','lk','Sri Lanka'),(5972,10,'Galmûnê','lk','Sri Lanka'),(5973,11,'Gampaha','lk','Sri Lanka'),(5974,12,'Hambantota','lk','Sri Lanka'),(5975,13,'Kalutara','lk','Sri Lanka'),(5976,14,'Katunayaka','lk','Sri Lanka'),(5977,15,'Kêgalla','lk','Sri Lanka'),(5978,16,'Kilinochchi','lk','Sri Lanka'),(5979,17,'Kolamba','lk','Sri Lanka'),(5980,18,'Kotikawatta','lk','Sri Lanka'),(5981,19,'Kurunegala','lk','Sri Lanka'),(5982,20,'Madakalpûwa','lk','Sri Lanka'),(5983,21,'Maha Nuwara','lk','Sri Lanka'),(5984,22,'Maharagama','lk','Sri Lanka'),(5985,23,'Mannârama','lk','Sri Lanka'),(5986,24,'Mâtale','lk','Sri Lanka'),(5987,25,'Mâtara','lk','Sri Lanka'),(5988,26,'Mîgamuwa','lk','Sri Lanka'),(5989,27,'Monaragala','lk','Sri Lanka'),(5990,28,'Moratuwa','lk','Sri Lanka'),(5991,29,'Mullaitivu','lk','Sri Lanka'),(5992,30,'Nuwara Eliya','lk','Sri Lanka'),(5993,31,'Pêduru Tuduwa','lk','Sri Lanka'),(5994,32,'Polonnaruwa','lk','Sri Lanka'),(5995,33,'Pûttalama','lk','Sri Lanka'),(5996,34,'Ratnapûraya','lk','Sri Lanka'),(5997,35,'Sri Jayawardenepura','lk','Sri Lanka'),(5998,36,'Tirikunâmalaya','lk','Sri Lanka'),(5999,37,'Vavuniyâwa','lk','Sri Lanka'),(6000,38,'Yâpanaya','lk','Sri Lanka'),(6001,1,'´Atbarah','sd','Sudan'),(6002,2,'ad-Damazîn','sd','Sudan'),(6003,3,'ad-Dâmîr','sd','Sudan'),(6004,4,'ad-Du´ayn','sd','Sudan'),(6005,5,'al-Fâshir','sd','Sudan'),(6006,6,'al-Fûlah','sd','Sudan'),(6007,7,'al-Junaynah','sd','Sudan'),(6008,8,'al-Khartûm','sd','Sudan'),(6009,9,'al-Khartûm Bahrî','sd','Sudan'),(6010,10,'al-Manâqil','sd','Sudan'),(6011,11,'al-Qadârif','sd','Sudan'),(6012,12,'al-Ubayyid','sd','Sudan'),(6013,13,'Bentiu','sd','Sudan'),(6014,14,'Bûr','sd','Sudan'),(6015,15,'Bûr Sûdân','sd','Sudan'),(6016,16,'Dunqulah','sd','Sudan'),(6017,17,'Jûbâ','sd','Sudan'),(6018,18,'Kâduqlî','sd','Sudan'),(6019,19,'Kâpôêta','sd','Sudan'),(6020,20,'Kassalâ','sd','Sudan'),(6021,21,'Kûstî','sd','Sudan'),(6022,22,'Malakâl','sd','Sudan'),(6023,23,'Niyâlâ','sd','Sudan'),(6024,24,'Rabak','sd','Sudan'),(6025,25,'Rumbîk','sd','Sudan'),(6026,26,'Sinjah','sd','Sudan'),(6027,27,'Sinnâr','sd','Sudan'),(6028,28,'Tonj','sd','Sudan'),(6029,29,'Umm Durmân','sd','Sudan'),(6030,30,'Uwayl','sd','Sudan'),(6031,31,'Wad Madanî','sd','Sudan'),(6032,32,'Wâw','sd','Sudan'),(6033,33,'Yambio','sd','Sudan'),(6034,1,'Albina','sr','Suriname'),(6035,2,'Brokopondo','sr','Suriname'),(6036,3,'Brownsweg','sr','Suriname'),(6037,4,'Groningen','sr','Suriname'),(6038,5,'Lelydorp','sr','Suriname'),(6039,6,'Marienburg','sr','Suriname'),(6040,7,'Meerzorg','sr','Suriname'),(6041,8,'Moengo','sr','Suriname'),(6042,9,'Nieuw Amsterdam','sr','Suriname'),(6043,10,'Nieuw Nickerie','sr','Suriname'),(6044,11,'Onverwacht','sr','Suriname'),(6045,12,'Paramaribo','sr','Suriname'),(6046,13,'Totness','sr','Suriname'),(6047,14,'Wageningen','sr','Suriname'),(6048,1,'Barentsburg','sj','Svalbard and Jan Mayen'),(6049,2,'Hornsund','sj','Svalbard and Jan Mayen'),(6050,3,'Isfjord Radio','sj','Svalbard and Jan Mayen'),(6051,4,'Longyearbyen','sj','Svalbard and Jan Mayen'),(6052,5,'Ny-Ålesund','sj','Svalbard and Jan Mayen'),(6053,1,'Bhunya','sz','Swaziland'),(6054,2,'Big Bend','sz','Swaziland'),(6055,3,'Bulembu','sz','Swaziland'),(6056,4,'Hluti','sz','Swaziland'),(6057,5,'Kwaluseni','sz','Swaziland'),(6058,6,'Lobamba','sz','Swaziland'),(6059,7,'Manzini','sz','Swaziland'),(6060,8,'Matsapha','sz','Swaziland'),(6061,9,'Mbabane','sz','Swaziland'),(6062,10,'Mhlambanyatsi','sz','Swaziland'),(6063,11,'Mhlume','sz','Swaziland'),(6064,12,'Mondi','sz','Swaziland'),(6065,13,'Nhlangano','sz','Swaziland'),(6066,14,'Nsoko','sz','Swaziland'),(6067,15,'Pigg\'s Peak','sz','Swaziland'),(6068,16,'Sidvokodvo','sz','Swaziland'),(6069,17,'Simunye','sz','Swaziland'),(6070,18,'Siteki','sz','Swaziland'),(6071,19,'Thabankulu','sz','Swaziland'),(6072,20,'Tshaneni','sz','Swaziland'),(6073,1,'Borås','se','Sweden'),(6074,2,'Eskilstuna','se','Sweden'),(6075,3,'Falun','se','Sweden'),(6076,4,'Gävle','se','Sweden'),(6077,5,'Göteborg','se','Sweden'),(6078,6,'Halmstad','se','Sweden'),(6079,7,'Härnösand','se','Sweden'),(6080,8,'Helsingborg','se','Sweden'),(6081,9,'Jönköping','se','Sweden'),(6082,10,'Kalmar','se','Sweden'),(6083,11,'Karlskrona','se','Sweden'),(6084,12,'Karlstad','se','Sweden'),(6085,13,'Linköping','se','Sweden'),(6086,14,'Luleå','se','Sweden'),(6087,15,'Lund','se','Sweden'),(6088,16,'Malmö','se','Sweden'),(6089,17,'Norrköping','se','Sweden'),(6090,18,'Nyköping','se','Sweden'),(6091,19,'Örebro','se','Sweden'),(6092,20,'Östersund','se','Sweden'),(6093,21,'Södertälje','se','Sweden'),(6094,22,'Stockholm','se','Sweden'),(6095,23,'Täby','se','Sweden'),(6096,24,'Umeå','se','Sweden'),(6097,25,'Uppsala','se','Sweden'),(6098,26,'Västerås','se','Sweden'),(6099,27,'Växjö','se','Sweden'),(6100,28,'Visby','se','Sweden'),(6101,1,'Aarau','ch','Switzerland'),(6102,2,'Altdorf','ch','Switzerland'),(6103,3,'Appenzell','ch','Switzerland'),(6104,4,'Basel','ch','Switzerland'),(6105,5,'Bellinzona','ch','Switzerland'),(6106,6,'Bern','ch','Switzerland'),(6107,7,'Biel','ch','Switzerland'),(6108,8,'Chur','ch','Switzerland'),(6109,9,'Delémont','ch','Switzerland'),(6110,10,'Emmen','ch','Switzerland'),(6111,11,'Frauenfeld','ch','Switzerland'),(6112,12,'Fribourg','ch','Switzerland'),(6113,13,'Genève','ch','Switzerland'),(6114,14,'Glarus','ch','Switzerland'),(6115,15,'Herisau','ch','Switzerland'),(6116,16,'Köniz','ch','Switzerland'),(6117,17,'La Chaux-de-Fonds','ch','Switzerland'),(6118,18,'Lausanne','ch','Switzerland'),(6119,19,'Liestal','ch','Switzerland'),(6120,20,'Luzern','ch','Switzerland'),(6121,21,'Neuchâtel','ch','Switzerland'),(6122,22,'Sankt Gallen','ch','Switzerland'),(6123,23,'Sarnen','ch','Switzerland'),(6124,24,'Schaffhausen','ch','Switzerland'),(6125,25,'Schwyz','ch','Switzerland'),(6126,26,'Sion','ch','Switzerland'),(6127,27,'Solothurn','ch','Switzerland'),(6128,28,'Stans','ch','Switzerland'),(6129,29,'Thun','ch','Switzerland'),(6130,30,'Uster','ch','Switzerland'),(6131,31,'Vernier','ch','Switzerland'),(6132,32,'Winterthur','ch','Switzerland'),(6133,33,'Zug','ch','Switzerland'),(6134,34,'Zürich','ch','Switzerland'),(6135,1,'al-Hasakah','sy','Syria'),(6136,2,'al-Lâdhiqîyah','sy','Syria'),(6137,3,'al-Qâmishlî','sy','Syria'),(6138,4,'al-Qunaytirah','sy','Syria'),(6139,5,'ar-Raqqah','sy','Syria'),(6140,6,'as-Suwaydâ','sy','Syria'),(6141,7,'ath-Thawrah','sy','Syria'),(6142,8,'Dar´â','sy','Syria'),(6143,9,'Dârayyâ','sy','Syria'),(6144,10,'Dayr az-Zawr','sy','Syria'),(6145,11,'Dimashq','sy','Syria'),(6146,12,'Dûmâ','sy','Syria'),(6147,13,'Halab','sy','Syria'),(6148,14,'Hamâh','sy','Syria'),(6149,15,'Hims','sy','Syria'),(6150,16,'Idlib','sy','Syria'),(6151,17,'Jaramânah','sy','Syria'),(6152,18,'Ma´arrat-an-Nu´mân','sy','Syria'),(6153,19,'Manbij','sy','Syria'),(6154,20,'Salamîyah','sy','Syria'),(6155,21,'Tartûs','sy','Syria'),(6156,1,'Changhwa','tw','Taiwan'),(6157,2,'Chiayi','tw','Taiwan'),(6158,3,'Chungho','tw','Taiwan'),(6159,4,'Chungli','tw','Taiwan'),(6160,5,'Fengshan','tw','Taiwan'),(6161,6,'Fengyuan','tw','Taiwan'),(6162,7,'Hsichih','tw','Taiwan'),(6163,8,'Hsinchu','tw','Taiwan'),(6164,9,'Hsinchuang','tw','Taiwan'),(6165,10,'Hsintien','tw','Taiwan'),(6166,11,'Hsinying','tw','Taiwan'),(6167,12,'Hualian','tw','Taiwan'),(6168,13,'Ilan','tw','Taiwan'),(6169,14,'Kangshan','tw','Taiwan'),(6170,15,'Kaohsiung','tw','Taiwan'),(6171,16,'Keelung','tw','Taiwan'),(6172,17,'Kincheng','tw','Taiwan'),(6173,18,'Luchou','tw','Taiwan'),(6174,19,'Makung','tw','Taiwan'),(6175,20,'Miaoli','tw','Taiwan'),(6176,21,'Nantou','tw','Taiwan'),(6177,22,'Panchiao','tw','Taiwan'),(6178,23,'Pate','tw','Taiwan'),(6179,24,'Pingchen','tw','Taiwan'),(6180,25,'Pingtung','tw','Taiwan'),(6181,26,'Sanchung','tw','Taiwan'),(6182,27,'Shulin','tw','Taiwan'),(6183,28,'Taichung','tw','Taiwan'),(6184,29,'Tainan','tw','Taiwan'),(6185,30,'Taipei','tw','Taiwan'),(6186,31,'Taitung','tw','Taiwan'),(6187,32,'Tali','tw','Taiwan'),(6188,33,'Tanshui','tw','Taiwan'),(6189,34,'Taoyuan','tw','Taiwan'),(6190,35,'Touliu','tw','Taiwan'),(6191,36,'Tucheng','tw','Taiwan'),(6192,37,'Yangmei','tw','Taiwan'),(6193,38,'Yuanlin','tw','Taiwan'),(6194,39,'Yungho','tw','Taiwan'),(6195,40,'Yungkang','tw','Taiwan'),(6196,1,'Chkalov','tj','Tajikistan'),(6197,2,'Chorku','tj','Tajikistan'),(6198,3,'Dangara','tj','Tajikistan'),(6199,4,'Dushanbe','tj','Tajikistan'),(6200,5,'Farkhor','tj','Tajikistan'),(6201,6,'Hisor','tj','Tajikistan'),(6202,7,'Isfara','tj','Tajikistan'),(6203,8,'Khorug','tj','Tajikistan'),(6204,9,'Khujand','tj','Tajikistan'),(6205,10,'Kofarnihon','tj','Tajikistan'),(6206,11,'Konibodom','tj','Tajikistan'),(6207,12,'Kulob','tj','Tajikistan'),(6208,13,'Leninskiy','tj','Tajikistan'),(6209,14,'Nurak','tj','Tajikistan'),(6210,15,'Panjakent','tj','Tajikistan'),(6211,16,'Qurgonteppa','tj','Tajikistan'),(6212,17,'Tursunzoda','tj','Tajikistan'),(6213,18,'Uroteppa','tj','Tajikistan'),(6214,19,'Vose','tj','Tajikistan'),(6215,20,'Yovon','tj','Tajikistan'),(6216,1,'Arusha','tz','Tanzania'),(6217,2,'Bukoba','tz','Tanzania'),(6218,3,'Dar es Salaam','tz','Tanzania'),(6219,4,'Dodoma','tz','Tanzania'),(6220,5,'Iringa','tz','Tanzania'),(6221,6,'Kibaha','tz','Tanzania'),(6222,7,'Kigoma','tz','Tanzania'),(6223,8,'Kilosa','tz','Tanzania'),(6224,9,'Korogwe','tz','Tanzania'),(6225,10,'Lindi','tz','Tanzania'),(6226,11,'Mbeya','tz','Tanzania'),(6227,12,'Morogoro','tz','Tanzania'),(6228,13,'Moshi','tz','Tanzania'),(6229,14,'Mpanda','tz','Tanzania'),(6230,15,'Mtwara','tz','Tanzania'),(6231,16,'Musoma','tz','Tanzania'),(6232,17,'Mwanza','tz','Tanzania'),(6233,18,'Shinyanga','tz','Tanzania'),(6234,19,'Singida','tz','Tanzania'),(6235,20,'Songea','tz','Tanzania'),(6236,21,'Sumbawanga','tz','Tanzania'),(6237,22,'Tabora','tz','Tanzania'),(6238,23,'Tanga','tz','Tanzania'),(6239,24,'Zanzibar','tz','Tanzania'),(6240,1,'Alfred-Faure','tf','Terres Australes'),(6241,2,'Martin-de-Viviès','tf','Terres Australes'),(6242,3,'Port-aux-Français','tf','Terres Australes'),(6243,1,'Amnat Charoen','th','Thailand'),(6244,2,'Ang Thong','th','Thailand'),(6245,3,'Ayutthaya','th','Thailand'),(6246,4,'Buri Ram','th','Thailand'),(6247,5,'Chachoengsao','th','Thailand'),(6248,6,'Chai Nat','th','Thailand'),(6249,7,'Chaiyaphum','th','Thailand'),(6250,8,'Chanthaburi','th','Thailand'),(6251,9,'Chiang Mai','th','Thailand'),(6252,10,'Chiang Rai','th','Thailand'),(6253,11,'Chon Buri','th','Thailand'),(6254,12,'Chumphon','th','Thailand'),(6255,13,'Hat Yai','th','Thailand'),(6256,14,'Kalasin','th','Thailand'),(6257,15,'Kamphaeng Phet','th','Thailand'),(6258,16,'Kanchanaburi','th','Thailand'),(6259,17,'Khlong Luang','th','Thailand'),(6260,18,'Khon Kaen','th','Thailand'),(6261,19,'Krabi','th','Thailand'),(6262,20,'Krung Thep','th','Thailand'),(6263,21,'Lampang','th','Thailand'),(6264,22,'Lamphun','th','Thailand'),(6265,23,'Loei','th','Thailand'),(6266,24,'Lop Buri','th','Thailand'),(6267,25,'Mae Hong Son','th','Thailand'),(6268,26,'Maha Sarakham','th','Thailand'),(6269,27,'Mukdahan','th','Thailand'),(6270,28,'Nakhon Nayok','th','Thailand'),(6271,29,'Nakhon Pathom','th','Thailand'),(6272,30,'Nakhon Phanom','th','Thailand'),(6273,31,'Nakhon Ratchasima','th','Thailand'),(6274,32,'Nakhon Sawan','th','Thailand'),(6275,33,'Nakhon Si Thammarat','th','Thailand'),(6276,34,'Nan','th','Thailand'),(6277,35,'Narathiwat','th','Thailand'),(6278,36,'Nong Bua Lam Phu','th','Thailand'),(6279,37,'Nong Khai','th','Thailand'),(6280,38,'Nonthaburi','th','Thailand'),(6281,39,'Pak Kret','th','Thailand'),(6282,40,'Pathum Thani','th','Thailand'),(6283,41,'Pattani','th','Thailand'),(6284,42,'Phangnga','th','Thailand'),(6285,43,'Phatthalung','th','Thailand'),(6286,44,'Phayao','th','Thailand'),(6287,45,'Phetchabun','th','Thailand'),(6288,46,'Phetchaburi','th','Thailand'),(6289,47,'Phichit','th','Thailand'),(6290,48,'Phitsanulok','th','Thailand'),(6291,49,'Phra Pradaeng','th','Thailand'),(6292,50,'Phrae','th','Thailand'),(6293,51,'Phuket','th','Thailand'),(6294,52,'Prachin Buri','th','Thailand'),(6295,53,'Prachuap Khiri Khan','th','Thailand'),(6296,54,'Ranong','th','Thailand'),(6297,55,'Ratchaburi','th','Thailand'),(6298,56,'Rayong','th','Thailand'),(6299,57,'Roi Et','th','Thailand'),(6300,58,'Sa Kaeo','th','Thailand'),(6301,59,'Sakhon Nakhon','th','Thailand'),(6302,60,'Samut Prakan','th','Thailand'),(6303,61,'Samut Sakhon','th','Thailand'),(6304,62,'Samut Songkhram','th','Thailand'),(6305,63,'Saraburi','th','Thailand'),(6306,64,'Satun','th','Thailand'),(6307,65,'Si Racha','th','Thailand'),(6308,66,'Si Sa Ket','th','Thailand'),(6309,67,'Sing Buri','th','Thailand'),(6310,68,'Songkhla','th','Thailand'),(6311,69,'Sukhothai','th','Thailand'),(6312,70,'Suphan Buri','th','Thailand'),(6313,71,'Surat Thani','th','Thailand'),(6314,72,'Surin','th','Thailand'),(6315,73,'Tak','th','Thailand'),(6316,74,'Thanyaburi','th','Thailand'),(6317,75,'Trang','th','Thailand'),(6318,76,'Trat','th','Thailand'),(6319,77,'Ubon Ratchathani','th','Thailand'),(6320,78,'Udon Thani','th','Thailand'),(6321,79,'Uthai Thani','th','Thailand'),(6322,80,'Uttaradit','th','Thailand'),(6323,81,'Yala','th','Thailand'),(6324,82,'Yasothon','th','Thailand'),(6325,1,'Aného','tg','Togo'),(6326,2,'Anié','tg','Togo'),(6327,3,'Atakpamé','tg','Togo'),(6328,4,'Badou','tg','Togo'),(6329,5,'Bafilo','tg','Togo'),(6330,6,'Bassar','tg','Togo'),(6331,7,'Blitta','tg','Togo'),(6332,8,'Dapaong','tg','Togo'),(6333,9,'Kara','tg','Togo'),(6334,10,'Kpalimé','tg','Togo'),(6335,11,'Lomé','tg','Togo'),(6336,12,'Mango','tg','Togo'),(6337,13,'Niamtougou','tg','Togo'),(6338,14,'Notsé','tg','Togo'),(6339,15,'Sokodé','tg','Togo'),(6340,16,'Sotouboua','tg','Togo'),(6341,17,'Tandjouaré','tg','Togo'),(6342,18,'Tchamba','tg','Togo'),(6343,19,'Tsévié','tg','Togo'),(6344,20,'Vogan','tg','Togo'),(6345,1,'Atafu','tk','Tokelau'),(6346,2,'Fakaofo','tk','Tokelau'),(6347,3,'Nukunonu','tk','Tokelau'),(6348,1,'Haveloloto','to','Tonga'),(6349,2,'Hihifo','to','Tonga'),(6350,3,'Mu\'a','to','Tonga'),(6351,4,'Neiafu','to','Tonga'),(6352,5,'Nuku\'alofa','to','Tonga'),(6353,6,'Ohonua','to','Tonga'),(6354,7,'Pangai','to','Tonga'),(6355,8,'Tofoa-Koloua','to','Tonga'),(6356,9,'Vaini','to','Tonga'),(6357,1,'Arima','tt','Trinidad and Tobago'),(6358,2,'Arouca','tt','Trinidad and Tobago'),(6359,3,'Chaguanas','tt','Trinidad and Tobago'),(6360,4,'Couva','tt','Trinidad and Tobago'),(6361,5,'Débé','tt','Trinidad and Tobago'),(6362,6,'Marabella','tt','Trinidad and Tobago'),(6363,7,'Mucurapo','tt','Trinidad and Tobago'),(6364,8,'Peñal','tt','Trinidad and Tobago'),(6365,9,'Point Fortín','tt','Trinidad and Tobago'),(6366,10,'Port of Spain','tt','Trinidad and Tobago'),(6367,11,'Princes Town','tt','Trinidad and Tobago'),(6368,12,'Saint Joseph','tt','Trinidad and Tobago'),(6369,13,'San Fernando','tt','Trinidad and Tobago'),(6370,14,'San Juan','tt','Trinidad and Tobago'),(6371,15,'Sangre Grande','tt','Trinidad and Tobago'),(6372,16,'Scarborough','tt','Trinidad and Tobago'),(6373,17,'Siparia','tt','Trinidad and Tobago'),(6374,18,'Tabaquite','tt','Trinidad and Tobago'),(6375,19,'Tacarigua','tt','Trinidad and Tobago'),(6376,20,'Tunapuna','tt','Trinidad and Tobago'),(6377,1,'al-Kâf','tn','Tunisia'),(6378,2,'al-Mahdîyah','tn','Tunisia'),(6379,3,'al-Marsâ','tn','Tunisia'),(6380,4,'al-Munastîr','tn','Tunisia'),(6381,5,'al-Murûj','tn','Tunisia'),(6382,6,'al-Qasrayn','tn','Tunisia'),(6383,7,'al-Qayrawân','tn','Tunisia'),(6384,8,'Aryânah','tn','Tunisia'),(6385,9,'at-Tadâman Dawwâr Hîshar','tn','Tunisia'),(6386,10,'Bâjah','tn','Tunisia'),(6387,11,'Bârdaw','tn','Tunisia'),(6388,12,'Bin ´Arûs','tn','Tunisia'),(6389,13,'Binzart','tn','Tunisia'),(6390,14,'Halq-al-Wâdî','tn','Tunisia'),(6391,15,'Jarbah Hawmat-as-Sûq','tn','Tunisia'),(6392,16,'Jarjîs','tn','Tunisia'),(6393,17,'Jundûbah','tn','Tunisia'),(6394,18,'Madanîyîn','tn','Tunisia'),(6395,19,'Manûbah','tn','Tunisia'),(6396,20,'Masâkin','tn','Tunisia'),(6397,21,'Mûhammadiyat Fushânah','tn','Tunisia'),(6398,22,'Nâbul','tn','Tunisia'),(6399,23,'Qâbis','tn','Tunisia'),(6400,24,'Qafsah','tn','Tunisia'),(6401,25,'Qibilî','tn','Tunisia'),(6402,26,'Safâqis','tn','Tunisia'),(6403,27,'Sîdî Bû Zayd','tn','Tunisia'),(6404,28,'Silyânah','tn','Tunisia'),(6405,29,'Sûsah','tn','Tunisia'),(6406,30,'Tatâwîn','tn','Tunisia'),(6407,31,'Tawzar','tn','Tunisia'),(6408,32,'Tûnis','tn','Tunisia'),(6409,33,'Zaghwân','tn','Tunisia'),(6410,1,'Adana','tr','Turkey'),(6411,2,'Adapazari','tr','Turkey'),(6412,3,'Adiyaman','tr','Turkey'),(6413,4,'Afyon','tr','Turkey'),(6414,5,'Aksaray','tr','Turkey'),(6415,6,'Amasya','tr','Turkey'),(6416,7,'Ankara','tr','Turkey'),(6417,8,'Antakya','tr','Turkey'),(6418,9,'Antalya','tr','Turkey'),(6419,10,'Ardahan','tr','Turkey'),(6420,11,'Artvin','tr','Turkey'),(6421,12,'Aydin','tr','Turkey'),(6422,13,'Balikesir','tr','Turkey'),(6423,14,'Bandirma','tr','Turkey'),(6424,15,'Bartin','tr','Turkey'),(6425,16,'Batman','tr','Turkey'),(6426,17,'Bayburt','tr','Turkey'),(6427,18,'Bilecik','tr','Turkey'),(6428,19,'Bingöl','tr','Turkey'),(6429,20,'Bitlis','tr','Turkey'),(6430,21,'Bolu','tr','Turkey'),(6431,22,'Burdur','tr','Turkey'),(6432,23,'Bursa','tr','Turkey'),(6433,24,'Çanakkale','tr','Turkey'),(6434,25,'Çankiri','tr','Turkey'),(6435,26,'Çorlu','tr','Turkey'),(6436,27,'Çorum','tr','Turkey'),(6437,28,'Denizli','tr','Turkey'),(6438,29,'Diyarbakir','tr','Turkey'),(6439,30,'Düzce','tr','Turkey'),(6440,31,'Edirne','tr','Turkey'),(6441,32,'Elazig','tr','Turkey'),(6442,33,'Erzincan','tr','Turkey'),(6443,34,'Erzurum','tr','Turkey'),(6444,35,'Eskisehir','tr','Turkey'),(6445,36,'Gaziantep','tr','Turkey'),(6446,37,'Gebze','tr','Turkey'),(6447,38,'Giresun','tr','Turkey'),(6448,39,'Gümüshane','tr','Turkey'),(6449,40,'Hakkari','tr','Turkey'),(6450,41,'Igdir','tr','Turkey'),(6451,42,'Iskenderun','tr','Turkey'),(6452,43,'Isparta','tr','Turkey'),(6453,44,'Istanbul','tr','Turkey'),(6454,45,'Izmir','tr','Turkey'),(6455,46,'Izmit','tr','Turkey'),(6456,47,'Kahramanmaras','tr','Turkey'),(6457,48,'Karaköse','tr','Turkey'),(6458,49,'Karaman','tr','Turkey'),(6459,50,'Kars','tr','Turkey'),(6460,51,'Kastamonu','tr','Turkey'),(6461,52,'Kayseri','tr','Turkey'),(6462,53,'Kilis','tr','Turkey'),(6463,54,'Kirikkale','tr','Turkey'),(6464,55,'Kirklareli','tr','Turkey'),(6465,56,'Kirsehir','tr','Turkey'),(6466,57,'Konya','tr','Turkey'),(6467,58,'Kütahya','tr','Turkey'),(6468,59,'Malatya','tr','Turkey'),(6469,60,'Manisa','tr','Turkey'),(6470,61,'Mardin','tr','Turkey'),(6471,62,'Mersin','tr','Turkey'),(6472,63,'Mugla','tr','Turkey'),(6473,64,'Mus','tr','Turkey'),(6474,65,'Nevsehir','tr','Turkey'),(6475,66,'Nigde','tr','Turkey'),(6476,67,'Ordu','tr','Turkey'),(6477,68,'Osmaniye','tr','Turkey'),(6478,69,'Rize','tr','Turkey'),(6479,70,'Samsun','tr','Turkey'),(6480,71,'Siirt','tr','Turkey'),(6481,72,'Sinop','tr','Turkey'),(6482,73,'Sirnak','tr','Turkey'),(6483,74,'Sivas','tr','Turkey'),(6484,75,'Tekirdag','tr','Turkey'),(6485,76,'Tokat','tr','Turkey'),(6486,77,'Trabzon','tr','Turkey'),(6487,78,'Tunceli','tr','Turkey'),(6488,79,'Urfa','tr','Turkey'),(6489,80,'Usak','tr','Turkey'),(6490,81,'Van','tr','Turkey'),(6491,82,'Yalova','tr','Turkey'),(6492,83,'Yozgat','tr','Turkey'),(6493,84,'Zonguldak','tr','Turkey'),(6494,1,'Akdepe','tm','Turkmenistan'),(6495,2,'Annau','tm','Turkmenistan'),(6496,3,'Asgabat','tm','Turkmenistan'),(6497,4,'Balkanabat','tm','Turkmenistan'),(6498,5,'Bayramali','tm','Turkmenistan'),(6499,6,'Boldumsaz','tm','Turkmenistan'),(6500,7,'Büzmeyin','tm','Turkmenistan'),(6501,8,'Dasoguz','tm','Turkmenistan'),(6502,9,'Elöten','tm','Turkmenistan'),(6503,10,'Govurdak','tm','Turkmenistan'),(6504,11,'Gumdag','tm','Turkmenistan'),(6505,12,'Kerki','tm','Turkmenistan'),(6506,13,'Komsomolsk','tm','Turkmenistan'),(6507,14,'Köhne Ürgenç','tm','Turkmenistan'),(6508,15,'Mari','tm','Turkmenistan'),(6509,16,'Serdar','tm','Turkmenistan'),(6510,17,'Tecen','tm','Turkmenistan'),(6511,18,'Türkmenabat','tm','Turkmenistan'),(6512,19,'Türkmenbasi','tm','Turkmenistan'),(6513,20,'Yilanli','tm','Turkmenistan'),(6514,1,'Cockburn Harbour','tc','Turks and Caicos Islands'),(6515,2,'Cockburn Town','tc','Turks and Caicos Islands'),(6516,1,'Asau','tv','Tuvalu'),(6517,2,'Fangaua','tv','Tuvalu'),(6518,3,'Kua','tv','Tuvalu'),(6519,4,'Lolua','tv','Tuvalu'),(6520,5,'Savave','tv','Tuvalu'),(6521,6,'Tanrake','tv','Tuvalu'),(6522,7,'Tonga','tv','Tuvalu'),(6523,8,'Vaiaku','tv','Tuvalu'),(6524,1,'Arua','ug','Uganda'),(6525,2,'Busia','ug','Uganda'),(6526,3,'Entebbe','ug','Uganda'),(6527,4,'Fort Portal','ug','Uganda'),(6528,5,'Gulu','ug','Uganda'),(6529,6,'Iganga','ug','Uganda'),(6530,7,'Jinja','ug','Uganda'),(6531,8,'Kabale','ug','Uganda'),(6532,9,'Kampala','ug','Uganda'),(6533,10,'Kasese','ug','Uganda'),(6534,11,'Kitgum','ug','Uganda'),(6535,12,'Lira','ug','Uganda'),(6536,13,'Masaka','ug','Uganda'),(6537,14,'Mbale','ug','Uganda'),(6538,15,'Mbarara','ug','Uganda'),(6539,16,'Mityana','ug','Uganda'),(6540,17,'Mukono','ug','Uganda'),(6541,18,'Njeru','ug','Uganda'),(6542,19,'Soroti','ug','Uganda'),(6543,20,'Tororo','ug','Uganda'),(6544,1,'Alchevs\'k','ua','Ukraine'),(6545,2,'Berdyans\'k','ua','Ukraine'),(6546,3,'Bila Tserkva','ua','Ukraine'),(6547,4,'Cherkasy','ua','Ukraine'),(6548,5,'Chernihiv','ua','Ukraine'),(6549,6,'Chernivtsi','ua','Ukraine'),(6550,7,'Dniprodzerzhyns\'k','ua','Ukraine'),(6551,8,'Dnipropetrovs\'k','ua','Ukraine'),(6552,9,'Donets\'k','ua','Ukraine'),(6553,10,'Horlivka','ua','Ukraine'),(6554,11,'Ivano-Frankivs\'k','ua','Ukraine'),(6555,12,'Kerch','ua','Ukraine'),(6556,13,'Kharkiv','ua','Ukraine'),(6557,14,'Kherson','ua','Ukraine'),(6558,15,'Khmel\'nyts\'kyy','ua','Ukraine'),(6559,16,'Kirovohrad','ua','Ukraine'),(6560,17,'Kramators\'k','ua','Ukraine'),(6561,18,'Kremenchuh','ua','Ukraine'),(6562,19,'Kryvyy Rih','ua','Ukraine'),(6563,20,'Kyyiv','ua','Ukraine'),(6564,21,'Luhans\'k','ua','Ukraine'),(6565,22,'Luts\'k','ua','Ukraine'),(6566,23,'L\'viv','ua','Ukraine'),(6567,24,'Lysychans\'k','ua','Ukraine'),(6568,25,'Makiyivka','ua','Ukraine'),(6569,26,'Mariupol\'','ua','Ukraine'),(6570,27,'Melitpol\'','ua','Ukraine'),(6571,28,'Mykolayiv','ua','Ukraine'),(6572,29,'Nikopol\'','ua','Ukraine'),(6573,30,'Odesa','ua','Ukraine'),(6574,31,'Pavlohrad','ua','Ukraine'),(6575,32,'Poltava','ua','Ukraine'),(6576,33,'Rivne','ua','Ukraine'),(6577,34,'Sevastopol\'','ua','Ukraine'),(6578,35,'Simferopol\'','ua','Ukraine'),(6579,36,'Slov\'yans\'k','ua','Ukraine'),(6580,37,'Sumy','ua','Ukraine'),(6581,38,'Syeverodonets\'k','ua','Ukraine'),(6582,39,'Ternopil\'','ua','Ukraine'),(6583,40,'Uzhhorod','ua','Ukraine'),(6584,41,'Vinnytsya','ua','Ukraine'),(6585,42,'Yenakiyeve','ua','Ukraine'),(6586,43,'Yevpatoriya','ua','Ukraine'),(6587,44,'Zaporizhzhya','ua','Ukraine'),(6588,45,'Zhytomyr','ua','Ukraine'),(6589,1,'´Ajmân','ae','United Arab Emirates'),(6590,2,'Abû Zabi','ae','United Arab Emirates'),(6591,3,'al-´Ayn','ae','United Arab Emirates'),(6592,4,'al-Fujayrah','ae','United Arab Emirates'),(6593,5,'ash-Shâriqah','ae','United Arab Emirates'),(6594,6,'Dubayy','ae','United Arab Emirates'),(6595,7,'Khawr Fakkân','ae','United Arab Emirates'),(6596,8,'Râ\'s al-Khaymah','ae','United Arab Emirates'),(6597,9,'Umm al-Qaywayn','ae','United Arab Emirates'),(6598,1,'Aberdeen','gb','United Kingdom'),(6599,2,'Basildon','gb','United Kingdom'),(6600,3,'Belfast','gb','United Kingdom'),(6601,4,'Birmingham','gb','United Kingdom'),(6602,5,'Blackburn','gb','United Kingdom'),(6603,6,'Blackpool','gb','United Kingdom'),(6604,7,'Bolton','gb','United Kingdom'),(6605,8,'Bournemouth','gb','United Kingdom'),(6606,9,'Bradford','gb','United Kingdom'),(6607,10,'Brighton','gb','United Kingdom'),(6608,11,'Bristol','gb','United Kingdom'),(6609,12,'Cardiff','gb','United Kingdom'),(6610,13,'Chelmsford','gb','United Kingdom'),(6611,14,'Coventry','gb','United Kingdom'),(6612,15,'Derby','gb','United Kingdom'),(6613,16,'Dudley','gb','United Kingdom'),(6614,17,'Dundee','gb','United Kingdom'),(6615,18,'Edinburgh','gb','United Kingdom'),(6616,19,'Glasgow','gb','United Kingdom'),(6617,20,'Gloucester','gb','United Kingdom'),(6618,21,'Huddersfield','gb','United Kingdom'),(6619,22,'Ipswich','gb','United Kingdom'),(6620,23,'Kingston upon Hull','gb','United Kingdom'),(6621,24,'Leeds','gb','United Kingdom'),(6622,25,'Leicester','gb','United Kingdom'),(6623,26,'Liverpool','gb','United Kingdom'),(6624,27,'London','gb','United Kingdom'),(6625,28,'Luton','gb','United Kingdom'),(6626,29,'Manchester','gb','United Kingdom'),(6627,30,'Middlesbrough','gb','United Kingdom'),(6628,31,'Motherwell','gb','United Kingdom'),(6629,32,'Newcastle upon Tyne','gb','United Kingdom'),(6630,33,'Newport','gb','United Kingdom'),(6631,34,'Northampton','gb','United Kingdom'),(6632,35,'Norwich','gb','United Kingdom'),(6633,36,'Nottingham','gb','United Kingdom'),(6634,37,'Oldbury-Smethwick','gb','United Kingdom'),(6635,38,'Oldham','gb','United Kingdom'),(6636,39,'Oxford','gb','United Kingdom'),(6637,40,'Peterborough','gb','United Kingdom'),(6638,41,'Plymouth','gb','United Kingdom'),(6639,42,'Poole','gb','United Kingdom'),(6640,43,'Portsmouth','gb','United Kingdom'),(6641,44,'Preston','gb','United Kingdom'),(6642,45,'Reading','gb','United Kingdom'),(6643,46,'Rotherham','gb','United Kingdom'),(6644,47,'Saint Helens','gb','United Kingdom'),(6645,48,'Sheffield','gb','United Kingdom'),(6646,49,'Slough','gb','United Kingdom'),(6647,50,'Southampton','gb','United Kingdom'),(6648,51,'Southend-on-Sea','gb','United Kingdom'),(6649,52,'Stockport','gb','United Kingdom'),(6650,53,'Stoke-on-Trent','gb','United Kingdom'),(6651,54,'Sunderland','gb','United Kingdom'),(6652,55,'Sutton Coldfield','gb','United Kingdom'),(6653,56,'Swansea','gb','United Kingdom'),(6654,57,'Swindon','gb','United Kingdom'),(6655,58,'Walsall','gb','United Kingdom'),(6656,59,'Watford','gb','United Kingdom'),(6657,60,'West Bromwich','gb','United Kingdom'),(6658,61,'Woking-Byfleet','gb','United Kingdom'),(6659,62,'Wolverhampton','gb','United Kingdom'),(6660,63,'York','gb','United Kingdom'),(6661,1,'Alabama','us','United States of America'),(6662,2,'Alaska','us','United States of America'),(6663,3,'Arizona','us','United States of America'),(6664,4,'Arkansas','us','United States of America'),(6665,5,'California','us','United States of America'),(6666,6,'Colorado','us','United States of America'),(6667,7,'Connecticut','us','United States of America'),(6668,8,'Delaware','us','United States of America'),(6669,9,'District of Columbia','us','United States of America'),(6670,10,'Florida','us','United States of America'),(6671,11,'Georgia','us','United States of America'),(6672,12,'Hawaii','us','United States of America'),(6673,13,'Idaho','us','United States of America'),(6674,14,'Illinois','us','United States of America'),(6675,15,'Indiana','us','United States of America'),(6676,16,'Iowa','us','United States of America'),(6677,17,'Kansas','us','United States of America'),(6678,18,'Kentucky','us','United States of America'),(6679,19,'Louisiana','us','United States of America'),(6680,20,'Maine','us','United States of America'),(6681,21,'Maryland','us','United States of America'),(6682,22,'Massachusetts','us','United States of America'),(6683,23,'Michigan','us','United States of America'),(6684,24,'Minnesota','us','United States of America'),(6685,25,'Mississippi','us','United States of America'),(6686,26,'Missouri','us','United States of America'),(6687,27,'Montana','us','United States of America'),(6688,28,'Nebraska','us','United States of America'),(6689,29,'Nevada','us','United States of America'),(6690,30,'New Hampshire','us','United States of America'),(6691,31,'New Jersey','us','United States of America'),(6692,32,'New Mexico','us','United States of America'),(6693,33,'New York','us','United States of America'),(6694,34,'North Carolina','us','United States of America'),(6695,35,'North Dakota','us','United States of America'),(6696,36,'Ohio','us','United States of America'),(6697,37,'Oklahoma','us','United States of America'),(6698,38,'Oregon','us','United States of America'),(6699,39,'Pennsylvania','us','United States of America'),(6700,40,'Rhode Island','us','United States of America'),(6701,41,'South Carolina','us','United States of America'),(6702,42,'South Dakota','us','United States of America'),(6703,43,'Tennessee','us','United States of America'),(6704,44,'Texas','us','United States of America'),(6705,45,'Utah','us','United States of America'),(6706,46,'Vermont','us','United States of America'),(6707,47,'Virginia','us','United States of America'),(6708,48,'Washington','us','United States of America'),(6709,49,'West Virginia','us','United States of America'),(6710,50,'Wisconsin','us','United States of America'),(6711,51,'Wyoming','us','United States of America'),(6712,1,'Artigas','uy','Uruguay'),(6713,2,'Canelones','uy','Uruguay'),(6714,3,'Ciudad de la Costa','uy','Uruguay'),(6715,4,'Colonia','uy','Uruguay'),(6716,5,'Durazno','uy','Uruguay'),(6717,6,'Florida','uy','Uruguay'),(6718,7,'Fray Bentos','uy','Uruguay'),(6719,8,'Las Piedras','uy','Uruguay'),(6720,9,'Maldonado','uy','Uruguay'),(6721,10,'Melo','uy','Uruguay'),(6722,11,'Mercedes','uy','Uruguay'),(6723,12,'Minas','uy','Uruguay'),(6724,13,'Montevideo','uy','Uruguay'),(6725,14,'Pando','uy','Uruguay'),(6726,15,'Paysandú','uy','Uruguay'),(6727,16,'Rivera','uy','Uruguay'),(6728,17,'Rocha','uy','Uruguay'),(6729,18,'Salto','uy','Uruguay'),(6730,19,'San Carlos','uy','Uruguay'),(6731,20,'San José','uy','Uruguay'),(6732,21,'Tacuarembó','uy','Uruguay'),(6733,22,'Treinta y Tres','uy','Uruguay'),(6734,23,'Trinidad','uy','Uruguay'),(6735,1,'Andijon','uz','Uzbekistan'),(6736,2,'Angren','uz','Uzbekistan'),(6737,3,'Bekobod','uz','Uzbekistan'),(6738,4,'Buhoro','uz','Uzbekistan'),(6739,5,'Cizah','uz','Uzbekistan'),(6740,6,'Çirçik','uz','Uzbekistan'),(6741,7,'Fargona','uz','Uzbekistan'),(6742,8,'Guliston','uz','Uzbekistan'),(6743,9,'Hücayli','uz','Uzbekistan'),(6744,10,'Karsi','uz','Uzbekistan'),(6745,11,'Kükon','uz','Uzbekistan'),(6746,12,'Margilon','uz','Uzbekistan'),(6747,13,'Namangan','uz','Uzbekistan'),(6748,14,'Navoi','uz','Uzbekistan'),(6749,15,'Nukus','uz','Uzbekistan'),(6750,16,'Olmalik','uz','Uzbekistan'),(6751,17,'Sahrisabz','uz','Uzbekistan'),(6752,18,'Samarkand','uz','Uzbekistan'),(6753,19,'Termiz','uz','Uzbekistan'),(6754,20,'Toskent','uz','Uzbekistan'),(6755,21,'Ürgenç','uz','Uzbekistan'),(6756,1,'Isangel','vu','Vanuatu'),(6757,2,'Lakatoro','vu','Vanuatu'),(6758,3,'Longana','vu','Vanuatu'),(6759,4,'Luganville','vu','Vanuatu'),(6760,5,'Norsup','vu','Vanuatu'),(6761,6,'Port Olry','vu','Vanuatu'),(6762,7,'Sola','vu','Vanuatu'),(6763,8,'Vila','vu','Vanuatu'),(6764,1,'Vatican','va','Vatican'),(6765,1,'Acarigua','ve','Venezuela'),(6766,2,'Barcelona','ve','Venezuela'),(6767,3,'Barinas','ve','Venezuela'),(6768,4,'Barquisimeto','ve','Venezuela'),(6769,5,'Baruta','ve','Venezuela'),(6770,6,'Cabimas','ve','Venezuela'),(6771,7,'Cagua','ve','Venezuela'),(6772,8,'Calabozo','ve','Venezuela'),(6773,9,'Caracas','ve','Venezuela'),(6774,10,'Carora','ve','Venezuela'),(6775,11,'Carúpano','ve','Venezuela'),(6776,12,'Catia La Mar','ve','Venezuela'),(6777,13,'Charallave','ve','Venezuela'),(6778,14,'Ciudad Bolívar','ve','Venezuela'),(6779,15,'Ciudad Guayana','ve','Venezuela'),(6780,16,'Coro','ve','Venezuela'),(6781,17,'Cúa','ve','Venezuela'),(6782,18,'Cumaná','ve','Venezuela'),(6783,19,'El Limón','ve','Venezuela'),(6784,20,'El Tigre','ve','Venezuela'),(6785,21,'Guacara','ve','Venezuela'),(6786,22,'Guanare','ve','Venezuela'),(6787,23,'Guarenas','ve','Venezuela'),(6788,24,'Guatire','ve','Venezuela'),(6789,25,'La Asunción','ve','Venezuela'),(6790,26,'La Guaira','ve','Venezuela'),(6791,27,'La Victoria','ve','Venezuela'),(6792,28,'Los Teques','ve','Venezuela'),(6793,29,'Maracaibo','ve','Venezuela'),(6794,30,'Maracay','ve','Venezuela'),(6795,31,'Mariara','ve','Venezuela'),(6796,32,'Maturín','ve','Venezuela'),(6797,33,'Mérida','ve','Venezuela'),(6798,34,'Ocumare del Tuy','ve','Venezuela'),(6799,35,'Petare','ve','Venezuela'),(6800,36,'Puerto Ayacucho','ve','Venezuela'),(6801,37,'Puerto Cabello','ve','Venezuela'),(6802,38,'Puerto la Cruz','ve','Venezuela'),(6803,39,'Punto Fijo','ve','Venezuela'),(6804,40,'San Carlos','ve','Venezuela'),(6805,41,'San Cristóbal','ve','Venezuela'),(6806,42,'San Felipe','ve','Venezuela'),(6807,43,'San Fernando','ve','Venezuela'),(6808,44,'San Juan de los Morros','ve','Venezuela'),(6809,45,'Santa Teresa','ve','Venezuela'),(6810,46,'Trujillo','ve','Venezuela'),(6811,47,'Tucupita','ve','Venezuela'),(6812,48,'Turmero','ve','Venezuela'),(6813,49,'Valencia','ve','Venezuela'),(6814,50,'Valera','ve','Venezuela'),(6815,1,'Bac Lieu','vn','Vietnam'),(6816,2,'Bien Hoa','vn','Vietnam'),(6817,3,'Buon Me Thuot','vn','Vietnam'),(6818,4,'Ca Mau','vn','Vietnam'),(6819,5,'Cam Pha','vn','Vietnam'),(6820,6,'Cam Ranh','vn','Vietnam'),(6821,7,'Can Tho','vn','Vietnam'),(6822,8,'Da Lat','vn','Vietnam'),(6823,9,'Dha Nâng','vn','Vietnam'),(6824,10,'Ha Noi','vn','Vietnam'),(6825,11,'Hai Phong','vn','Vietnam'),(6826,12,'Hong Gai','vn','Vietnam'),(6827,13,'Hue','vn','Vietnam'),(6828,14,'Long Xuyen','vn','Vietnam'),(6829,15,'My Tho','vn','Vietnam'),(6830,16,'Nam Dinh','vn','Vietnam'),(6831,17,'Nha Trang','vn','Vietnam'),(6832,18,'Phan Thiet','vn','Vietnam'),(6833,19,'Play Cu','vn','Vietnam'),(6834,20,'Qui Nhon','vn','Vietnam'),(6835,21,'Rach Gia','vn','Vietnam'),(6836,22,'Soc Trang','vn','Vietnam'),(6837,23,'Thai Nguyen','vn','Vietnam'),(6838,24,'Thanh Hoa','vn','Vietnam'),(6839,25,'Thanh Pho Ho Chi Minh','vn','Vietnam'),(6840,26,'Vung Tau','vn','Vietnam'),(6841,1,'Anna\'s Retreat','vi','Virgin Islands of the USA'),(6842,2,'Charlotte Amalie','vi','Virgin Islands of the USA'),(6843,3,'Charlotte Amalie East','vi','Virgin Islands of the USA'),(6844,4,'Charlotte Amalie West','vi','Virgin Islands of the USA'),(6845,5,'Christiansted','vi','Virgin Islands of the USA'),(6846,6,'Cruz Bay','vi','Virgin Islands of the USA'),(6847,7,'Frederiksted','vi','Virgin Islands of the USA'),(6848,8,'Frederiksted Southeast','vi','Virgin Islands of the USA'),(6849,9,'Grove Place','vi','Virgin Islands of the USA'),(6850,1,'Aka Aka','wf','Wallis & Futuna'),(6851,2,'Alele','wf','Wallis & Futuna'),(6852,3,'Falaleu','wf','Wallis & Futuna'),(6853,4,'Fiua','wf','Wallis & Futuna'),(6854,5,'Haafuasia','wf','Wallis & Futuna'),(6855,6,'Halalo','wf','Wallis & Futuna'),(6856,7,'Kolia','wf','Wallis & Futuna'),(6857,8,'Lavegahau','wf','Wallis & Futuna'),(6858,9,'Leava','wf','Wallis & Futuna'),(6859,10,'Liku','wf','Wallis & Futuna'),(6860,11,'Malaefoou','wf','Wallis & Futuna'),(6861,12,'Matâ\'Utu','wf','Wallis & Futuna'),(6862,13,'Nuku','wf','Wallis & Futuna'),(6863,14,'Ono','wf','Wallis & Futuna'),(6864,15,'Poi','wf','Wallis & Futuna'),(6865,16,'Taoa','wf','Wallis & Futuna'),(6866,17,'Utuofa','wf','Wallis & Futuna'),(6867,18,'Vailala','wf','Wallis & Futuna'),(6868,19,'Vaimalau','wf','Wallis & Futuna'),(6869,20,'Vaitupu','wf','Wallis & Futuna'),(6870,1,'´Adan','ye','Yemen'),(6871,2,'´Amrân','ye','Yemen'),(6872,3,'´Ataq','ye','Yemen'),(6873,4,'al-Baydâ','ye','Yemen'),(6874,5,'al-Ghaydah','ye','Yemen'),(6875,6,'al-Hawthah','ye','Yemen'),(6876,7,'al-Hazm','ye','Yemen'),(6877,8,'al-Hudaydah','ye','Yemen'),(6878,9,'al-Marawi´ah','ye','Yemen'),(6879,10,'al-Mukallâ','ye','Yemen'),(6880,11,'ash-Shahir','ye','Yemen'),(6881,12,'Bâjil','ye','Yemen'),(6882,13,'Bayt-al-Faqîh','ye','Yemen'),(6883,14,'Dhamâr','ye','Yemen'),(6884,15,'Dhi Sufal','ye','Yemen'),(6885,16,'Hajjah','ye','Yemen'),(6886,17,'Ibb','ye','Yemen'),(6887,18,'Ja´ar','ye','Yemen'),(6888,19,'Mahwît','ye','Yemen'),(6889,20,'Ma\'rib','ye','Yemen'),(6890,21,'Raydah','ye','Yemen'),(6891,22,'Sa´dah','ye','Yemen'),(6892,23,'Sahâr','ye','Yemen'),(6893,24,'San´â','ye','Yemen'),(6894,25,'Sayyân','ye','Yemen'),(6895,26,'Ta´izz','ye','Yemen'),(6896,27,'Tuban','ye','Yemen'),(6897,28,'Yarim','ye','Yemen'),(6898,29,'Zabid','ye','Yemen'),(6899,30,'Zinjibar','ye','Yemen'),(6900,1,'Chililabombwe','zm','Zambia'),(6901,2,'Chingola','zm','Zambia'),(6902,3,'Chipata','zm','Zambia'),(6903,4,'Choma','zm','Zambia'),(6904,5,'Kabwe','zm','Zambia'),(6905,6,'Kafue','zm','Zambia'),(6906,7,'Kalulushi','zm','Zambia'),(6907,8,'Kansanshi','zm','Zambia'),(6908,9,'Kasama','zm','Zambia'),(6909,10,'Kitwe','zm','Zambia'),(6910,11,'Livingstone','zm','Zambia'),(6911,12,'Luanshya','zm','Zambia'),(6912,13,'Lusaka','zm','Zambia'),(6913,14,'Mansa','zm','Zambia'),(6914,15,'Mazabuka','zm','Zambia'),(6915,16,'Mongu','zm','Zambia'),(6916,17,'Mpika','zm','Zambia'),(6917,18,'Mufulira','zm','Zambia'),(6918,19,'Nchelenge','zm','Zambia'),(6919,20,'Ndola','zm','Zambia'),(6920,21,'Solwezi','zm','Zambia'),(6921,1,'Bindura','zw','Zimbabwe'),(6922,2,'Bulawayo','zw','Zimbabwe'),(6923,3,'Chegutu','zw','Zimbabwe'),(6924,4,'Chinhoyi','zw','Zimbabwe'),(6925,5,'Chitungwiza','zw','Zimbabwe'),(6926,6,'Gweru','zw','Zimbabwe'),(6927,7,'Harare','zw','Zimbabwe'),(6928,8,'Hwange','zw','Zimbabwe'),(6929,9,'Kadoma','zw','Zimbabwe'),(6930,10,'Kariba','zw','Zimbabwe'),(6931,11,'Karoi','zw','Zimbabwe'),(6932,12,'Kwekwe','zw','Zimbabwe'),(6933,13,'Marondera','zw','Zimbabwe'),(6934,14,'Masvingo','zw','Zimbabwe'),(6935,15,'Mutare','zw','Zimbabwe'),(6936,16,'Norton','zw','Zimbabwe'),(6937,17,'Redcliffe','zw','Zimbabwe'),(6938,18,'Sakubva','zw','Zimbabwe'),(6939,19,'Victoria Falls','zw','Zimbabwe'),(6940,20,'Zvishavane','zw','Zimbabwe');
/*!40000 ALTER TABLE `nuke_cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_comments`
--

DROP TABLE IF EXISTS `nuke_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_comments` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) DEFAULT NULL,
  `url` varchar(60) DEFAULT NULL,
  `host_name` varchar(60) DEFAULT NULL,
  `subject` varchar(85) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `score` tinyint(4) NOT NULL DEFAULT '0',
  `reason` tinyint(4) NOT NULL DEFAULT '0',
  `last_moderation_ip` varchar(15) DEFAULT '0',
  PRIMARY KEY (`tid`),
  KEY `tid` (`tid`),
  KEY `pid` (`pid`),
  KEY `sid` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_comments`
--

LOCK TABLES `nuke_comments` WRITE;
/*!40000 ALTER TABLE `nuke_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_comments_moderated`
--

DROP TABLE IF EXISTS `nuke_comments_moderated`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_comments_moderated` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) DEFAULT NULL,
  `url` varchar(60) DEFAULT NULL,
  `host_name` varchar(60) DEFAULT NULL,
  `subject` varchar(85) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `score` tinyint(4) NOT NULL DEFAULT '0',
  `reason` tinyint(4) NOT NULL DEFAULT '0',
  `last_moderation_ip` varchar(15) DEFAULT '0',
  PRIMARY KEY (`tid`),
  KEY `tid` (`tid`),
  KEY `pid` (`pid`),
  KEY `sid` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_comments_moderated`
--

LOCK TABLES `nuke_comments_moderated` WRITE;
/*!40000 ALTER TABLE `nuke_comments_moderated` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_comments_moderated` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_config`
--

DROP TABLE IF EXISTS `nuke_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_config` (
  `sitename` varchar(255) NOT NULL DEFAULT '',
  `nukeurl` varchar(255) NOT NULL DEFAULT '',
  `site_logo` varchar(255) NOT NULL DEFAULT '',
  `slogan` varchar(255) NOT NULL DEFAULT '',
  `startdate` varchar(50) NOT NULL DEFAULT '',
  `adminmail` varchar(255) NOT NULL DEFAULT '',
  `anonpost` tinyint(1) NOT NULL DEFAULT '0',
  `Default_Theme` varchar(255) NOT NULL DEFAULT '',
  `overwrite_theme` tinyint(1) NOT NULL DEFAULT '1',
  `foot1` text NOT NULL,
  `foot2` text NOT NULL,
  `foot3` text NOT NULL,
  `commentlimit` int(9) NOT NULL DEFAULT '4096',
  `anonymous` varchar(255) NOT NULL DEFAULT '',
  `minpass` tinyint(1) NOT NULL DEFAULT '5',
  `pollcomm` tinyint(1) NOT NULL DEFAULT '1',
  `articlecomm` tinyint(1) NOT NULL DEFAULT '1',
  `broadcast_msg` tinyint(1) NOT NULL DEFAULT '1',
  `my_headlines` tinyint(1) NOT NULL DEFAULT '1',
  `top` int(3) NOT NULL DEFAULT '10',
  `storyhome` int(2) NOT NULL DEFAULT '10',
  `user_news` tinyint(1) NOT NULL DEFAULT '1',
  `oldnum` int(2) NOT NULL DEFAULT '30',
  `ultramode` tinyint(1) NOT NULL DEFAULT '0',
  `banners` tinyint(1) NOT NULL DEFAULT '1',
  `backend_title` varchar(255) NOT NULL DEFAULT '',
  `backend_language` varchar(10) NOT NULL DEFAULT '',
  `language` varchar(100) NOT NULL DEFAULT '',
  `locale` varchar(10) NOT NULL DEFAULT '',
  `multilingual` tinyint(1) NOT NULL DEFAULT '0',
  `useflags` tinyint(1) NOT NULL DEFAULT '0',
  `notify` tinyint(1) NOT NULL DEFAULT '0',
  `notify_email` varchar(255) NOT NULL DEFAULT '',
  `notify_subject` varchar(255) NOT NULL DEFAULT '',
  `notify_message` varchar(255) NOT NULL DEFAULT '',
  `notify_from` varchar(255) NOT NULL DEFAULT '',
  `moderate` tinyint(1) NOT NULL DEFAULT '0',
  `admingraphic` tinyint(1) NOT NULL DEFAULT '1',
  `httpref` tinyint(1) NOT NULL DEFAULT '1',
  `httprefmax` int(5) NOT NULL DEFAULT '1000',
  `httprefmode` tinyint(1) NOT NULL DEFAULT '1',
  `CensorMode` tinyint(1) NOT NULL DEFAULT '3',
  `CensorReplace` varchar(10) NOT NULL DEFAULT '',
  `copyright` text NOT NULL,
  `Version_Num` varchar(10) NOT NULL DEFAULT '',
  `gfx_chk` tinyint(1) NOT NULL DEFAULT '0',
  `nuke_editor` tinyint(1) NOT NULL DEFAULT '1',
  `display_errors` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sitename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_config`
--

LOCK TABLES `nuke_config` WRITE;
/*!40000 ALTER TABLE `nuke_config` DISABLE KEYS */;
INSERT INTO `nuke_config` VALUES ('PHP-Nuke Powered Site','http://nukeurl','logo.gif','Your slogan here','May 2007','webmaster@phpnuke.org',0,'org_green',1,'<a rel=\"nofollow\" href=\"http://phpnuke.org/\" target=\"blank\"><img alt=\"Web site powered by PHP-Nuke\" hspace=\"10\" src=\"images/powered/powered8.jpg\" border=\"0\" /></a><br />','All logos and trademarks in this site are property of their respective owner. The comments are property of their posters, all the rest &copy; 2005 by me.','You can syndicate our news using the file <a href=\"backend.php\">backend.php</a> or <a href=\"ultramode.txt\">ultramode.txt</a>',4096,'Anonymous',5,1,1,1,1,10,10,1,30,0,1,'PHP-Nuke Powered Site','en-us','english','en_US',0,0,0,'me@phpnuke.org','NEWS for my site','Hey! You got a new submission for your site.','webmaster',0,1,1,1000,0,3,'*****','<a rel=\"nofollow\" href=\"http://phpnuke.org\"><font class=\"footmsg_l\">PHP-Nuke</font></a> Copyright &copy; 2005 by Francisco Burzi. This is free software, and you may redistribute it under the <a rel=\"nofollow\" href=\"http://phpnuke.org/files/gpl.txt\"><font class=\"footmsg_l\">GPL</font></a>. PHP-Nuke comes with absolutely no warranty, for details, see the <a rel=\"nofollow\" href=\"http://phpnuke.org/files/gpl.txt\"><font class=\"footmsg_l\">license</font></a>.','8.1',0,1,0);
/*!40000 ALTER TABLE `nuke_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_confirm`
--

DROP TABLE IF EXISTS `nuke_confirm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_confirm` (
  `confirm_id` char(32) NOT NULL DEFAULT '',
  `session_id` char(32) NOT NULL DEFAULT '',
  `code` char(6) NOT NULL DEFAULT '',
  PRIMARY KEY (`session_id`,`confirm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_confirm`
--

LOCK TABLES `nuke_confirm` WRITE;
/*!40000 ALTER TABLE `nuke_confirm` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_confirm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_counter`
--

DROP TABLE IF EXISTS `nuke_counter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_counter` (
  `type` varchar(80) NOT NULL DEFAULT '',
  `var` varchar(80) NOT NULL DEFAULT '',
  `count` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_counter`
--

LOCK TABLES `nuke_counter` WRITE;
/*!40000 ALTER TABLE `nuke_counter` DISABLE KEYS */;
INSERT INTO `nuke_counter` VALUES ('total','hits',1),('browser','WebTV',0),('browser','Lynx',0),('browser','MSIE',1),('browser','Opera',0),('browser','Konqueror',0),('browser','Netscape',0),('browser','FireFox',0),('browser','Bot',0),('browser','Other',0),('os','Windows',1),('os','Linux',0),('os','Mac',0),('os','FreeBSD',0),('os','SunOS',0),('os','IRIX',0),('os','BeOS',0),('os','OS/2',0),('os','AIX',0),('os','Other',0);
/*!40000 ALTER TABLE `nuke_counter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_downloads_categories`
--

DROP TABLE IF EXISTS `nuke_downloads_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_downloads_categories` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `cdescription` text NOT NULL,
  `parentid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`),
  KEY `cid` (`cid`),
  KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_downloads_categories`
--

LOCK TABLES `nuke_downloads_categories` WRITE;
/*!40000 ALTER TABLE `nuke_downloads_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_downloads_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_downloads_downloads`
--

DROP TABLE IF EXISTS `nuke_downloads_downloads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_downloads_downloads` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date` datetime DEFAULT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `hits` int(11) NOT NULL DEFAULT '0',
  `submitter` varchar(60) NOT NULL DEFAULT '',
  `downloadratingsummary` double(6,4) NOT NULL DEFAULT '0.0000',
  `totalvotes` int(11) NOT NULL DEFAULT '0',
  `totalcomments` int(11) NOT NULL DEFAULT '0',
  `filesize` int(11) NOT NULL DEFAULT '0',
  `version` varchar(10) NOT NULL DEFAULT '',
  `homepage` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`lid`),
  KEY `lid` (`lid`),
  KEY `cid` (`cid`),
  KEY `sid` (`sid`),
  KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_downloads_downloads`
--

LOCK TABLES `nuke_downloads_downloads` WRITE;
/*!40000 ALTER TABLE `nuke_downloads_downloads` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_downloads_downloads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_downloads_editorials`
--

DROP TABLE IF EXISTS `nuke_downloads_editorials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_downloads_editorials` (
  `downloadid` int(11) NOT NULL DEFAULT '0',
  `adminid` varchar(60) NOT NULL DEFAULT '',
  `editorialtimestamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editorialtext` text NOT NULL,
  `editorialtitle` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`downloadid`),
  KEY `downloadid` (`downloadid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_downloads_editorials`
--

LOCK TABLES `nuke_downloads_editorials` WRITE;
/*!40000 ALTER TABLE `nuke_downloads_editorials` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_downloads_editorials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_downloads_modrequest`
--

DROP TABLE IF EXISTS `nuke_downloads_modrequest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_downloads_modrequest` (
  `requestid` int(11) NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL DEFAULT '0',
  `cid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `modifysubmitter` varchar(60) NOT NULL DEFAULT '',
  `brokendownload` int(3) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `filesize` int(11) NOT NULL DEFAULT '0',
  `version` varchar(10) NOT NULL DEFAULT '',
  `homepage` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`requestid`),
  UNIQUE KEY `requestid` (`requestid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_downloads_modrequest`
--

LOCK TABLES `nuke_downloads_modrequest` WRITE;
/*!40000 ALTER TABLE `nuke_downloads_modrequest` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_downloads_modrequest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_downloads_newdownload`
--

DROP TABLE IF EXISTS `nuke_downloads_newdownload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_downloads_newdownload` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `submitter` varchar(60) NOT NULL DEFAULT '',
  `filesize` int(11) NOT NULL DEFAULT '0',
  `version` varchar(10) NOT NULL DEFAULT '',
  `homepage` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`lid`),
  KEY `lid` (`lid`),
  KEY `cid` (`cid`),
  KEY `sid` (`sid`),
  KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_downloads_newdownload`
--

LOCK TABLES `nuke_downloads_newdownload` WRITE;
/*!40000 ALTER TABLE `nuke_downloads_newdownload` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_downloads_newdownload` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_downloads_votedata`
--

DROP TABLE IF EXISTS `nuke_downloads_votedata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_downloads_votedata` (
  `ratingdbid` int(11) NOT NULL AUTO_INCREMENT,
  `ratinglid` int(11) NOT NULL DEFAULT '0',
  `ratinguser` varchar(60) NOT NULL DEFAULT '',
  `rating` int(11) NOT NULL DEFAULT '0',
  `ratinghostname` varchar(60) NOT NULL DEFAULT '',
  `ratingcomments` text NOT NULL,
  `ratingtimestamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ratingdbid`),
  KEY `ratingdbid` (`ratingdbid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_downloads_votedata`
--

LOCK TABLES `nuke_downloads_votedata` WRITE;
/*!40000 ALTER TABLE `nuke_downloads_votedata` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_downloads_votedata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_encyclopedia`
--

DROP TABLE IF EXISTS `nuke_encyclopedia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_encyclopedia` (
  `eid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `elanguage` varchar(30) NOT NULL DEFAULT '',
  `active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`eid`),
  KEY `eid` (`eid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_encyclopedia`
--

LOCK TABLES `nuke_encyclopedia` WRITE;
/*!40000 ALTER TABLE `nuke_encyclopedia` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_encyclopedia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_encyclopedia_text`
--

DROP TABLE IF EXISTS `nuke_encyclopedia_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_encyclopedia_text` (
  `tid` int(10) NOT NULL AUTO_INCREMENT,
  `eid` int(10) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `counter` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`),
  KEY `tid` (`tid`),
  KEY `eid` (`eid`),
  KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_encyclopedia_text`
--

LOCK TABLES `nuke_encyclopedia_text` WRITE;
/*!40000 ALTER TABLE `nuke_encyclopedia_text` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_encyclopedia_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_faqanswer`
--

DROP TABLE IF EXISTS `nuke_faqanswer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_faqanswer` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_cat` tinyint(4) NOT NULL DEFAULT '0',
  `question` varchar(255) DEFAULT '',
  `answer` text,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_cat` (`id_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_faqanswer`
--

LOCK TABLES `nuke_faqanswer` WRITE;
/*!40000 ALTER TABLE `nuke_faqanswer` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_faqanswer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_faqcategories`
--

DROP TABLE IF EXISTS `nuke_faqcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_faqcategories` (
  `id_cat` tinyint(3) NOT NULL AUTO_INCREMENT,
  `categories` varchar(255) DEFAULT NULL,
  `flanguage` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_cat`),
  KEY `id_cat` (`id_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_faqcategories`
--

LOCK TABLES `nuke_faqcategories` WRITE;
/*!40000 ALTER TABLE `nuke_faqcategories` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_faqcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_groups`
--

DROP TABLE IF EXISTS `nuke_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_groups` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `points` int(10) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_groups`
--

LOCK TABLES `nuke_groups` WRITE;
/*!40000 ALTER TABLE `nuke_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_groups_points`
--

DROP TABLE IF EXISTS `nuke_groups_points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_groups_points` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `points` int(10) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_groups_points`
--

LOCK TABLES `nuke_groups_points` WRITE;
/*!40000 ALTER TABLE `nuke_groups_points` DISABLE KEYS */;
INSERT INTO `nuke_groups_points` VALUES (1,0),(2,0),(3,0),(4,0),(5,0),(6,0),(7,0),(8,0),(9,0),(10,0),(11,0),(12,0),(13,0),(14,0),(15,0),(16,0),(17,0),(18,0),(19,0),(20,0),(21,0);
/*!40000 ALTER TABLE `nuke_groups_points` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_headlines`
--

DROP TABLE IF EXISTS `nuke_headlines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_headlines` (
  `hid` int(11) NOT NULL AUTO_INCREMENT,
  `sitename` varchar(30) NOT NULL DEFAULT '',
  `headlinesurl` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`hid`),
  KEY `hid` (`hid`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_headlines`
--

LOCK TABLES `nuke_headlines` WRITE;
/*!40000 ALTER TABLE `nuke_headlines` DISABLE KEYS */;
INSERT INTO `nuke_headlines` VALUES (1,'AbsoluteGames','http://files.gameaholic.com/agfa.rdf'),(2,'BSDToday','http://www.bsdtoday.com/backend/bt.rdf'),(3,'BrunchingShuttlecocks','http://www.brunching.com/brunching.rdf'),(4,'DailyDaemonNews','http://daily.daemonnews.org/ddn.rdf.php3'),(5,'DigitalTheatre','http://www.dtheatre.com/backend.php3?xml=yes'),(6,'DotKDE','http://dot.kde.org/rdf'),(7,'FreeDOS','http://www.freedos.org/channels/rss.cgi'),(8,'Freshmeat','http://rss.freshmeat.net/freshmeat/feeds/fm-releases-global'),(9,'Gnome Desktop','http://www.gnomedesktop.org/backend.php'),(10,'HappyPenguin','http://happypenguin.org/html/news.rdf'),(11,'HollywoodBitchslap','http://hollywoodbitchslap.com/hbs.rdf'),(12,'Learning Linux','http://www.learninglinux.com/backend.php'),(13,'LinuxCentral','http://linuxcentral.com/backend/lcnew.rdf'),(14,'LinuxJournal','http://www.linuxjournal.com/news.rss'),(15,'LinuxWeelyNews','http://lwn.net/headlines/rss'),(16,'Listology','http://listology.com/recent.rdf'),(17,'MozillaNewsBot','http://www.mozilla.org/newsbot/newsbot.rdf'),(18,'NewsForge','http://www.newsforge.com/newsforge.rdf'),(19,'NukeResources','http://www.nukeresources.com/backend.php'),(20,'WebReference','http://webreference.com/webreference.rdf'),(21,'PDABuzz','http://www.pdabuzz.com/netscape.txt'),(22,'PHP-Nuke','http://phpnuke.org/backend.php'),(23,'PHP.net','http://www.php.net/news.rss'),(24,'PHPBuilder','http://phpbuilder.com/rss_feed.php'),(25,'PerlMonks','http://www.perlmonks.org/headlines.rdf'),(26,'TheNextLevel','http://www.the-nextlevel.com/rdf/tnl.rdf');
/*!40000 ALTER TABLE `nuke_headlines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_journal`
--

DROP TABLE IF EXISTS `nuke_journal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_journal` (
  `jid` int(11) NOT NULL AUTO_INCREMENT,
  `aid` varchar(30) NOT NULL DEFAULT '',
  `title` varchar(80) DEFAULT NULL,
  `bodytext` text NOT NULL,
  `mood` varchar(48) NOT NULL DEFAULT '',
  `pdate` varchar(48) NOT NULL DEFAULT '',
  `ptime` varchar(48) NOT NULL DEFAULT '',
  `status` varchar(48) NOT NULL DEFAULT '',
  `mtime` varchar(48) NOT NULL DEFAULT '',
  `mdate` varchar(48) NOT NULL DEFAULT '',
  PRIMARY KEY (`jid`),
  KEY `jid` (`jid`),
  KEY `aid` (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_journal`
--

LOCK TABLES `nuke_journal` WRITE;
/*!40000 ALTER TABLE `nuke_journal` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_journal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_journal_comments`
--

DROP TABLE IF EXISTS `nuke_journal_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_journal_comments` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `rid` varchar(48) NOT NULL DEFAULT '',
  `aid` varchar(30) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `pdate` varchar(48) NOT NULL DEFAULT '',
  `ptime` varchar(48) NOT NULL DEFAULT '',
  PRIMARY KEY (`cid`),
  KEY `cid` (`cid`),
  KEY `rid` (`rid`),
  KEY `aid` (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_journal_comments`
--

LOCK TABLES `nuke_journal_comments` WRITE;
/*!40000 ALTER TABLE `nuke_journal_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_journal_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_journal_stats`
--

DROP TABLE IF EXISTS `nuke_journal_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_journal_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `joid` varchar(48) NOT NULL DEFAULT '',
  `nop` varchar(48) NOT NULL DEFAULT '',
  `ldp` varchar(24) NOT NULL DEFAULT '',
  `ltp` varchar(24) NOT NULL DEFAULT '',
  `micro` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_journal_stats`
--

LOCK TABLES `nuke_journal_stats` WRITE;
/*!40000 ALTER TABLE `nuke_journal_stats` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_journal_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_links_categories`
--

DROP TABLE IF EXISTS `nuke_links_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_links_categories` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `cdescription` text NOT NULL,
  `parentid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_links_categories`
--

LOCK TABLES `nuke_links_categories` WRITE;
/*!40000 ALTER TABLE `nuke_links_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_links_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_links_editorials`
--

DROP TABLE IF EXISTS `nuke_links_editorials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_links_editorials` (
  `linkid` int(11) NOT NULL DEFAULT '0',
  `adminid` varchar(60) NOT NULL DEFAULT '',
  `editorialtimestamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editorialtext` text NOT NULL,
  `editorialtitle` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`linkid`),
  KEY `linkid` (`linkid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_links_editorials`
--

LOCK TABLES `nuke_links_editorials` WRITE;
/*!40000 ALTER TABLE `nuke_links_editorials` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_links_editorials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_links_links`
--

DROP TABLE IF EXISTS `nuke_links_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_links_links` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date` datetime DEFAULT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `hits` int(11) NOT NULL DEFAULT '0',
  `submitter` varchar(60) NOT NULL DEFAULT '',
  `linkratingsummary` double(6,4) NOT NULL DEFAULT '0.0000',
  `totalvotes` int(11) NOT NULL DEFAULT '0',
  `totalcomments` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lid`),
  KEY `lid` (`lid`),
  KEY `cid` (`cid`),
  KEY `sid` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_links_links`
--

LOCK TABLES `nuke_links_links` WRITE;
/*!40000 ALTER TABLE `nuke_links_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_links_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_links_modrequest`
--

DROP TABLE IF EXISTS `nuke_links_modrequest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_links_modrequest` (
  `requestid` int(11) NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL DEFAULT '0',
  `cid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `modifysubmitter` varchar(60) NOT NULL DEFAULT '',
  `brokenlink` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`requestid`),
  UNIQUE KEY `requestid` (`requestid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_links_modrequest`
--

LOCK TABLES `nuke_links_modrequest` WRITE;
/*!40000 ALTER TABLE `nuke_links_modrequest` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_links_modrequest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_links_newlink`
--

DROP TABLE IF EXISTS `nuke_links_newlink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_links_newlink` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `submitter` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`lid`),
  KEY `lid` (`lid`),
  KEY `cid` (`cid`),
  KEY `sid` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_links_newlink`
--

LOCK TABLES `nuke_links_newlink` WRITE;
/*!40000 ALTER TABLE `nuke_links_newlink` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_links_newlink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_links_votedata`
--

DROP TABLE IF EXISTS `nuke_links_votedata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_links_votedata` (
  `ratingdbid` int(11) NOT NULL AUTO_INCREMENT,
  `ratinglid` int(11) NOT NULL DEFAULT '0',
  `ratinguser` varchar(60) NOT NULL DEFAULT '',
  `rating` int(11) NOT NULL DEFAULT '0',
  `ratinghostname` varchar(60) NOT NULL DEFAULT '',
  `ratingcomments` text NOT NULL,
  `ratingtimestamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ratingdbid`),
  KEY `ratingdbid` (`ratingdbid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_links_votedata`
--

LOCK TABLES `nuke_links_votedata` WRITE;
/*!40000 ALTER TABLE `nuke_links_votedata` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_links_votedata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_main`
--

DROP TABLE IF EXISTS `nuke_main`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_main` (
  `main_module` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_main`
--

LOCK TABLES `nuke_main` WRITE;
/*!40000 ALTER TABLE `nuke_main` DISABLE KEYS */;
INSERT INTO `nuke_main` VALUES ('News');
/*!40000 ALTER TABLE `nuke_main` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_message`
--

DROP TABLE IF EXISTS `nuke_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_message` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `date` varchar(14) NOT NULL DEFAULT '',
  `expire` int(7) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1',
  `view` int(1) NOT NULL DEFAULT '1',
  `mlanguage` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`mid`),
  UNIQUE KEY `mid` (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_message`
--

LOCK TABLES `nuke_message` WRITE;
/*!40000 ALTER TABLE `nuke_message` DISABLE KEYS */;
INSERT INTO `nuke_message` VALUES (1,'Welcome to PHP-Nuke!','<br>Congratulations! You have now a web portal installed!. You can edit or change this message from the <a href=\"admin.php\">Administration</a> page.\r\n<br><br>\r\n<center><b>If you didn\'t use the Web Installer utility the best idea now is to create the Super User by clicking <a href=\"admin.php\">HERE</a></b>.</center>\r\n<br><br>\r\nYou can also create a user for you from the same page or just create it at <a href=\"modules.php?name=Your_Account\">Your Account module</a>. Please read carefully the README file, CREDITS file to see from where comes the things and remember that this is free software released under the GPL License (read COPYING file for details). Hope you enjoy this software. Please report any bug you find when one of this annoying things happens and I\'ll fix it for the next release.\r\n<br><br>\r\nIf you like this software and want to make a contribution you can purchase the latest non-free version before it goes public. This can be done from <a href=\"http://phpnuke.org/modules.php?name=Release\">here</a> or if you prefer you can become a PHP-Nuke\'s Club Member by clicking <a href=\"http://phpnuke.org/modules.php?name=Club\">here</a> and obtain extra goodies for your system.\r\n<br><br>You can also browse for great <b>PHP-Nuke\'s Themes</b> at <a href=\"http://smeego.com/index.php?act=viewCat&catId=34\"><b>Smeego.com</b></a> where you can find professional looking themes for your business, gaming or casual site.\r\n<br><br>\r\nPHP-Nuke is an advanced and <i>intelligent</i> content management system designed and programmed with very hard work. PHP-Nuke has the biggest user\'s community in the world for this kind of application, thousands of people (users and programmers) are waiting for you to join this community at <a href=\"http://phpnuke.org\">http://phpnuke.org</a> where you can find thousands of modules/addons, themes, blocks, graphics, utilities and much more...\r\n<br><br>If you want to have written authorization to remove all visible copyright messages and any reference to PHP-Nuke, you can now acquire it by clicking <a href=\"http://phpnuke.org/modules.php?name=Commercial_License\" target=\"new\">here</a>, at the same time this will be a great support.\r\n<br><br>\r\nThanks for your support and for selecting PHP-Nuke as you web site\'s code! Hope you can can enjoy this application as much as we enjoy developing it!','993373194',0,1,1,'');
/*!40000 ALTER TABLE `nuke_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_modules`
--

DROP TABLE IF EXISTS `nuke_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_modules` (
  `mid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `custom_title` varchar(255) NOT NULL DEFAULT '',
  `active` int(1) NOT NULL DEFAULT '0',
  `view` int(1) NOT NULL DEFAULT '0',
  `inmenu` tinyint(1) NOT NULL DEFAULT '1',
  `mod_group` int(10) DEFAULT '0',
  `admins` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`mid`),
  KEY `mid` (`mid`),
  KEY `title` (`title`),
  KEY `custom_title` (`custom_title`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_modules`
--

LOCK TABLES `nuke_modules` WRITE;
/*!40000 ALTER TABLE `nuke_modules` DISABLE KEYS */;
INSERT INTO `nuke_modules` VALUES (1,'AvantGo','AvantGo',1,0,1,0,''),(2,'Content','Content',0,0,1,0,''),(3,'Downloads','Downloads',1,0,1,0,''),(4,'Encyclopedia','Encyclopedia',0,0,1,0,''),(5,'FAQ','FAQ',1,0,1,0,''),(6,'Feedback','Feedback',1,0,1,0,''),(7,'Forums','Forums',0,0,1,0,''),(8,'Journal','Journal',1,0,1,0,''),(9,'Members_List','Members List',0,1,1,0,''),(10,'News','News',1,0,1,0,''),(11,'Private_Messages','Private Messages',1,0,1,0,''),(12,'Recommend_Us','Recommend Us',1,0,1,0,''),(13,'Reviews','Reviews',0,0,1,0,''),(14,'Search','Search',1,0,1,0,''),(15,'Statistics','Statistics',1,0,1,0,''),(16,'Stories_Archive','Stories Archive',1,0,1,0,''),(17,'Submit_News','Submit News',1,0,1,0,''),(18,'Surveys','Surveys',1,0,1,0,''),(19,'Top','Top 10',1,0,1,0,''),(20,'Topics','Topics',1,0,1,0,''),(21,'Web_Links','Web Links',1,0,1,0,''),(22,'Your_Account','Your Account',1,0,1,0,''),(23,'Advertising','Advertising',0,0,1,0,''),(24,'AutoTheme','AutoTheme',1,0,0,0,'');
/*!40000 ALTER TABLE `nuke_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_pages`
--

DROP TABLE IF EXISTS `nuke_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_pages` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `cid` int(10) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `subtitle` varchar(255) NOT NULL DEFAULT '',
  `active` int(1) NOT NULL DEFAULT '0',
  `page_header` text NOT NULL,
  `text` text NOT NULL,
  `page_footer` text NOT NULL,
  `signature` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `counter` int(10) NOT NULL DEFAULT '0',
  `clanguage` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`pid`),
  KEY `pid` (`pid`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_pages`
--

LOCK TABLES `nuke_pages` WRITE;
/*!40000 ALTER TABLE `nuke_pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_pages_categories`
--

DROP TABLE IF EXISTS `nuke_pages_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_pages_categories` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  PRIMARY KEY (`cid`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_pages_categories`
--

LOCK TABLES `nuke_pages_categories` WRITE;
/*!40000 ALTER TABLE `nuke_pages_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_pages_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_poll_check`
--

DROP TABLE IF EXISTS `nuke_poll_check`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_poll_check` (
  `ip` varchar(20) NOT NULL DEFAULT '',
  `time` varchar(14) NOT NULL DEFAULT '',
  `pollID` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_poll_check`
--

LOCK TABLES `nuke_poll_check` WRITE;
/*!40000 ALTER TABLE `nuke_poll_check` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_poll_check` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_poll_data`
--

DROP TABLE IF EXISTS `nuke_poll_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_poll_data` (
  `pollID` int(11) NOT NULL DEFAULT '0',
  `optionText` char(50) NOT NULL DEFAULT '',
  `optionCount` int(11) NOT NULL DEFAULT '0',
  `voteID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_poll_data`
--

LOCK TABLES `nuke_poll_data` WRITE;
/*!40000 ALTER TABLE `nuke_poll_data` DISABLE KEYS */;
INSERT INTO `nuke_poll_data` VALUES (1,'Ummmm, not bad',0,1),(1,'Cool',0,2),(1,'Terrific',0,3),(1,'The best one!',0,4),(1,'what the hell is this?',0,5),(1,'',0,6),(1,'',0,7),(1,'',0,8),(1,'',0,9),(1,'',0,10),(1,'',0,11),(1,'',0,12);
/*!40000 ALTER TABLE `nuke_poll_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_poll_desc`
--

DROP TABLE IF EXISTS `nuke_poll_desc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_poll_desc` (
  `pollID` int(11) NOT NULL AUTO_INCREMENT,
  `pollTitle` varchar(100) NOT NULL DEFAULT '',
  `timeStamp` int(11) NOT NULL DEFAULT '0',
  `voters` mediumint(9) NOT NULL DEFAULT '0',
  `planguage` varchar(30) NOT NULL DEFAULT '',
  `artid` int(10) NOT NULL DEFAULT '0',
  `comments` int(11) DEFAULT '0',
  PRIMARY KEY (`pollID`),
  KEY `pollID` (`pollID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_poll_desc`
--

LOCK TABLES `nuke_poll_desc` WRITE;
/*!40000 ALTER TABLE `nuke_poll_desc` DISABLE KEYS */;
INSERT INTO `nuke_poll_desc` VALUES (1,'What do you think about this site?',961405160,0,'english',0,0);
/*!40000 ALTER TABLE `nuke_poll_desc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_pollcomments`
--

DROP TABLE IF EXISTS `nuke_pollcomments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_pollcomments` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `pollID` int(11) NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) DEFAULT NULL,
  `url` varchar(60) DEFAULT NULL,
  `host_name` varchar(60) DEFAULT NULL,
  `subject` varchar(60) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `score` tinyint(4) NOT NULL DEFAULT '0',
  `reason` tinyint(4) NOT NULL DEFAULT '0',
  `last_moderation_ip` varchar(15) DEFAULT '0',
  PRIMARY KEY (`tid`),
  KEY `tid` (`tid`),
  KEY `pid` (`pid`),
  KEY `pollID` (`pollID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_pollcomments`
--

LOCK TABLES `nuke_pollcomments` WRITE;
/*!40000 ALTER TABLE `nuke_pollcomments` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_pollcomments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_pollcomments_moderated`
--

DROP TABLE IF EXISTS `nuke_pollcomments_moderated`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_pollcomments_moderated` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `pollID` int(11) NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) DEFAULT NULL,
  `url` varchar(60) DEFAULT NULL,
  `host_name` varchar(60) DEFAULT NULL,
  `subject` varchar(60) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `score` tinyint(4) NOT NULL DEFAULT '0',
  `reason` tinyint(4) NOT NULL DEFAULT '0',
  `last_moderation_ip` varchar(15) DEFAULT '0',
  PRIMARY KEY (`tid`),
  KEY `tid` (`tid`),
  KEY `pid` (`pid`),
  KEY `pollID` (`pollID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_pollcomments_moderated`
--

LOCK TABLES `nuke_pollcomments_moderated` WRITE;
/*!40000 ALTER TABLE `nuke_pollcomments_moderated` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_pollcomments_moderated` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_public_messages`
--

DROP TABLE IF EXISTS `nuke_public_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_public_messages` (
  `mid` int(10) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL DEFAULT '',
  `date` varchar(14) DEFAULT NULL,
  `who` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`mid`),
  KEY `mid` (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_public_messages`
--

LOCK TABLES `nuke_public_messages` WRITE;
/*!40000 ALTER TABLE `nuke_public_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_public_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_queue`
--

DROP TABLE IF EXISTS `nuke_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_queue` (
  `qid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(9) NOT NULL DEFAULT '0',
  `uname` varchar(40) NOT NULL DEFAULT '',
  `subject` varchar(100) NOT NULL DEFAULT '',
  `story` text,
  `storyext` text NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `topic` varchar(20) NOT NULL DEFAULT '',
  `alanguage` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`qid`),
  KEY `qid` (`qid`),
  KEY `uid` (`uid`),
  KEY `uname` (`uname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_queue`
--

LOCK TABLES `nuke_queue` WRITE;
/*!40000 ALTER TABLE `nuke_queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_referer`
--

DROP TABLE IF EXISTS `nuke_referer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_referer` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`rid`),
  KEY `rid` (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_referer`
--

LOCK TABLES `nuke_referer` WRITE;
/*!40000 ALTER TABLE `nuke_referer` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_referer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_related`
--

DROP TABLE IF EXISTS `nuke_related`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_related` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`rid`),
  KEY `rid` (`rid`),
  KEY `tid` (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_related`
--

LOCK TABLES `nuke_related` WRITE;
/*!40000 ALTER TABLE `nuke_related` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_related` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_reviews`
--

DROP TABLE IF EXISTS `nuke_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_reviews` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `title` varchar(150) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `reviewer` varchar(20) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `score` int(10) NOT NULL DEFAULT '0',
  `cover` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `url_title` varchar(50) NOT NULL DEFAULT '',
  `hits` int(10) NOT NULL DEFAULT '0',
  `rlanguage` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_reviews`
--

LOCK TABLES `nuke_reviews` WRITE;
/*!40000 ALTER TABLE `nuke_reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_reviews_add`
--

DROP TABLE IF EXISTS `nuke_reviews_add`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_reviews_add` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `title` varchar(150) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `reviewer` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(60) DEFAULT NULL,
  `score` int(10) NOT NULL DEFAULT '0',
  `url` varchar(100) NOT NULL DEFAULT '',
  `url_title` varchar(50) NOT NULL DEFAULT '',
  `rlanguage` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_reviews_add`
--

LOCK TABLES `nuke_reviews_add` WRITE;
/*!40000 ALTER TABLE `nuke_reviews_add` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_reviews_add` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_reviews_comments`
--

DROP TABLE IF EXISTS `nuke_reviews_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_reviews_comments` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `rid` int(10) NOT NULL DEFAULT '0',
  `userid` varchar(25) NOT NULL DEFAULT '',
  `date` datetime DEFAULT NULL,
  `comments` text,
  `score` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`),
  KEY `cid` (`cid`),
  KEY `rid` (`rid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_reviews_comments`
--

LOCK TABLES `nuke_reviews_comments` WRITE;
/*!40000 ALTER TABLE `nuke_reviews_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_reviews_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_reviews_comments_moderated`
--

DROP TABLE IF EXISTS `nuke_reviews_comments_moderated`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_reviews_comments_moderated` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `rid` int(10) NOT NULL DEFAULT '0',
  `userid` varchar(25) NOT NULL DEFAULT '',
  `date` datetime DEFAULT NULL,
  `comments` text,
  `score` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`),
  KEY `cid` (`cid`),
  KEY `rid` (`rid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_reviews_comments_moderated`
--

LOCK TABLES `nuke_reviews_comments_moderated` WRITE;
/*!40000 ALTER TABLE `nuke_reviews_comments_moderated` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_reviews_comments_moderated` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_reviews_main`
--

DROP TABLE IF EXISTS `nuke_reviews_main`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_reviews_main` (
  `title` varchar(100) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_reviews_main`
--

LOCK TABLES `nuke_reviews_main` WRITE;
/*!40000 ALTER TABLE `nuke_reviews_main` DISABLE KEYS */;
INSERT INTO `nuke_reviews_main` VALUES ('Reviews Section Title','Reviews Section Long Description');
/*!40000 ALTER TABLE `nuke_reviews_main` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_session`
--

DROP TABLE IF EXISTS `nuke_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_session` (
  `uname` varchar(25) NOT NULL DEFAULT '',
  `time` varchar(14) NOT NULL DEFAULT '',
  `host_addr` varchar(48) NOT NULL DEFAULT '',
  `guest` int(1) NOT NULL DEFAULT '0',
  KEY `time` (`time`),
  KEY `guest` (`guest`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_session`
--

LOCK TABLES `nuke_session` WRITE;
/*!40000 ALTER TABLE `nuke_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_stats_date`
--

DROP TABLE IF EXISTS `nuke_stats_date`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_stats_date` (
  `year` smallint(6) NOT NULL DEFAULT '0',
  `month` tinyint(4) NOT NULL DEFAULT '0',
  `date` tinyint(4) NOT NULL DEFAULT '0',
  `hits` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_stats_date`
--

LOCK TABLES `nuke_stats_date` WRITE;
/*!40000 ALTER TABLE `nuke_stats_date` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_stats_date` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_stats_hour`
--

DROP TABLE IF EXISTS `nuke_stats_hour`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_stats_hour` (
  `year` smallint(6) NOT NULL DEFAULT '0',
  `month` tinyint(4) NOT NULL DEFAULT '0',
  `date` tinyint(4) NOT NULL DEFAULT '0',
  `hour` tinyint(4) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_stats_hour`
--

LOCK TABLES `nuke_stats_hour` WRITE;
/*!40000 ALTER TABLE `nuke_stats_hour` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_stats_hour` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_stats_month`
--

DROP TABLE IF EXISTS `nuke_stats_month`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_stats_month` (
  `year` smallint(6) NOT NULL DEFAULT '0',
  `month` tinyint(4) NOT NULL DEFAULT '0',
  `hits` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_stats_month`
--

LOCK TABLES `nuke_stats_month` WRITE;
/*!40000 ALTER TABLE `nuke_stats_month` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_stats_month` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_stats_year`
--

DROP TABLE IF EXISTS `nuke_stats_year`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_stats_year` (
  `year` smallint(6) NOT NULL DEFAULT '0',
  `hits` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_stats_year`
--

LOCK TABLES `nuke_stats_year` WRITE;
/*!40000 ALTER TABLE `nuke_stats_year` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_stats_year` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_stories`
--

DROP TABLE IF EXISTS `nuke_stories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_stories` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `aid` varchar(30) NOT NULL DEFAULT '',
  `title` varchar(80) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `hometext` text,
  `bodytext` text NOT NULL,
  `comments` int(11) DEFAULT '0',
  `counter` mediumint(8) unsigned DEFAULT NULL,
  `topic` int(3) NOT NULL DEFAULT '1',
  `informant` varchar(20) NOT NULL DEFAULT '',
  `notes` text NOT NULL,
  `ihome` int(1) NOT NULL DEFAULT '0',
  `alanguage` varchar(30) NOT NULL DEFAULT '',
  `acomm` int(1) NOT NULL DEFAULT '0',
  `haspoll` int(1) NOT NULL DEFAULT '0',
  `pollID` int(10) NOT NULL DEFAULT '0',
  `score` int(10) NOT NULL DEFAULT '0',
  `ratings` int(10) NOT NULL DEFAULT '0',
  `rating_ip` varchar(15) DEFAULT '0',
  `associated` text NOT NULL,
  PRIMARY KEY (`sid`),
  KEY `sid` (`sid`),
  KEY `catid` (`catid`),
  KEY `counter` (`counter`),
  KEY `topic` (`topic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_stories`
--

LOCK TABLES `nuke_stories` WRITE;
/*!40000 ALTER TABLE `nuke_stories` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_stories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_stories_cat`
--

DROP TABLE IF EXISTS `nuke_stories_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_stories_cat` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL DEFAULT '',
  `counter` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`catid`),
  KEY `catid` (`catid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_stories_cat`
--

LOCK TABLES `nuke_stories_cat` WRITE;
/*!40000 ALTER TABLE `nuke_stories_cat` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_stories_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_subscriptions`
--

DROP TABLE IF EXISTS `nuke_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_subscriptions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) DEFAULT '0',
  `subscription_expire` varchar(50) NOT NULL DEFAULT '',
  KEY `id` (`id`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_subscriptions`
--

LOCK TABLES `nuke_subscriptions` WRITE;
/*!40000 ALTER TABLE `nuke_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_topics`
--

DROP TABLE IF EXISTS `nuke_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_topics` (
  `topicid` int(3) NOT NULL AUTO_INCREMENT,
  `topicname` varchar(20) DEFAULT NULL,
  `topicimage` varchar(100) NOT NULL DEFAULT '',
  `topictext` varchar(40) DEFAULT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`topicid`),
  KEY `topicid` (`topicid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_topics`
--

LOCK TABLES `nuke_topics` WRITE;
/*!40000 ALTER TABLE `nuke_topics` DISABLE KEYS */;
INSERT INTO `nuke_topics` VALUES (1,'phpnuke','phpnuke.gif','PHP-Nuke',0);
/*!40000 ALTER TABLE `nuke_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_users`
--

DROP TABLE IF EXISTS `nuke_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL DEFAULT '',
  `username` varchar(25) NOT NULL DEFAULT '',
  `user_email` varchar(255) NOT NULL DEFAULT '',
  `femail` varchar(255) NOT NULL DEFAULT '',
  `user_website` varchar(255) NOT NULL DEFAULT '',
  `user_avatar` varchar(255) NOT NULL DEFAULT '',
  `user_regdate` varchar(20) NOT NULL DEFAULT '',
  `user_icq` varchar(15) DEFAULT NULL,
  `user_occ` varchar(100) DEFAULT NULL,
  `user_from` varchar(100) DEFAULT NULL,
  `user_interests` varchar(150) NOT NULL DEFAULT '',
  `user_sig` varchar(255) DEFAULT NULL,
  `user_viewemail` tinyint(2) DEFAULT NULL,
  `user_theme` int(3) DEFAULT NULL,
  `user_aim` varchar(18) DEFAULT NULL,
  `user_yim` varchar(25) DEFAULT NULL,
  `user_msnm` varchar(25) DEFAULT NULL,
  `user_password` varchar(40) NOT NULL DEFAULT '',
  `storynum` tinyint(4) NOT NULL DEFAULT '10',
  `umode` varchar(10) NOT NULL DEFAULT '',
  `uorder` tinyint(1) NOT NULL DEFAULT '0',
  `thold` tinyint(1) NOT NULL DEFAULT '0',
  `noscore` tinyint(1) NOT NULL DEFAULT '0',
  `bio` tinytext NOT NULL,
  `ublockon` tinyint(1) NOT NULL DEFAULT '0',
  `ublock` tinytext NOT NULL,
  `theme` varchar(255) NOT NULL DEFAULT '',
  `commentmax` int(11) NOT NULL DEFAULT '4096',
  `counter` int(11) NOT NULL DEFAULT '0',
  `newsletter` int(1) NOT NULL DEFAULT '0',
  `user_posts` int(10) NOT NULL DEFAULT '0',
  `user_attachsig` int(2) NOT NULL DEFAULT '0',
  `user_rank` int(10) NOT NULL DEFAULT '0',
  `user_level` int(10) NOT NULL DEFAULT '1',
  `broadcast` tinyint(1) NOT NULL DEFAULT '1',
  `popmeson` tinyint(1) NOT NULL DEFAULT '0',
  `user_active` tinyint(1) DEFAULT '1',
  `user_session_time` int(11) NOT NULL DEFAULT '0',
  `user_session_page` smallint(5) NOT NULL DEFAULT '0',
  `user_lastvisit` int(11) NOT NULL DEFAULT '0',
  `user_timezone` tinyint(4) NOT NULL DEFAULT '10',
  `user_style` tinyint(4) DEFAULT NULL,
  `user_lang` varchar(255) NOT NULL DEFAULT 'english',
  `user_dateformat` varchar(14) NOT NULL DEFAULT 'D M d, Y g:i a',
  `user_new_privmsg` smallint(5) unsigned NOT NULL DEFAULT '0',
  `user_unread_privmsg` smallint(5) unsigned NOT NULL DEFAULT '0',
  `user_last_privmsg` int(11) NOT NULL DEFAULT '0',
  `user_emailtime` int(11) DEFAULT NULL,
  `user_allowhtml` tinyint(1) DEFAULT '1',
  `user_allowbbcode` tinyint(1) DEFAULT '1',
  `user_allowsmile` tinyint(1) DEFAULT '1',
  `user_allowavatar` tinyint(1) NOT NULL DEFAULT '1',
  `user_allow_pm` tinyint(1) NOT NULL DEFAULT '1',
  `user_allow_viewonline` tinyint(1) NOT NULL DEFAULT '1',
  `user_notify` tinyint(1) NOT NULL DEFAULT '0',
  `user_notify_pm` tinyint(1) NOT NULL DEFAULT '0',
  `user_popup_pm` tinyint(1) NOT NULL DEFAULT '0',
  `user_avatar_type` tinyint(4) NOT NULL DEFAULT '3',
  `user_sig_bbcode_uid` varchar(10) DEFAULT NULL,
  `user_actkey` varchar(32) DEFAULT NULL,
  `user_newpasswd` varchar(32) DEFAULT NULL,
  `points` int(10) DEFAULT '0',
  `last_ip` varchar(15) NOT NULL DEFAULT '0',
  `karma` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  KEY `uid` (`user_id`),
  KEY `uname` (`username`),
  KEY `user_session_time` (`user_session_time`),
  KEY `karma` (`karma`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_users`
--

LOCK TABLES `nuke_users` WRITE;
/*!40000 ALTER TABLE `nuke_users` DISABLE KEYS */;
INSERT INTO `nuke_users` VALUES (1,'','Anonymous','','','','blank.gif','Nov 10, 2000','','','','','',0,0,'','','','',10,'',0,0,0,'',0,'','',4096,0,0,0,0,0,1,0,0,1,0,0,0,10,NULL,'english','D M d, Y g:i a',0,0,0,NULL,1,1,1,1,1,1,1,1,0,3,NULL,NULL,NULL,0,'0',0);
/*!40000 ALTER TABLE `nuke_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nuke_users_temp`
--

DROP TABLE IF EXISTS `nuke_users_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nuke_users_temp` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL DEFAULT '',
  `user_email` varchar(255) NOT NULL DEFAULT '',
  `user_password` varchar(40) NOT NULL DEFAULT '',
  `user_regdate` varchar(20) NOT NULL DEFAULT '',
  `check_num` varchar(50) NOT NULL DEFAULT '',
  `time` varchar(14) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nuke_users_temp`
--

LOCK TABLES `nuke_users_temp` WRITE;
/*!40000 ALTER TABLE `nuke_users_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `nuke_users_temp` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-13 12:11:15
