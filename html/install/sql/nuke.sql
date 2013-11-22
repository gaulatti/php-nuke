# phpMyAdmin MySQL-Dump
# version 2.3.1-rc1
# http://www.phpmyadmin.net/ (download page)
#
# servidor: localhost
# Tiempo de generación: 08-03-2006 a las 23:31:12
# Versión del servidor: 4.01.10
# Versión de PHP: 5.0.3
# Base de datos : `nuke`
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_antiflood`
#

CREATE TABLE nuke_antiflood (
  ip_addr varchar(48) NOT NULL,
  time varchar(14) NOT NULL,
  KEY (ip_addr),
  KEY (time) 
);

#
# Volcar la base de datos para la tabla `nuke_antiflood`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_authors`
#

CREATE TABLE nuke_authors (
  aid varchar(25) NOT NULL default '',
  name varchar(50) default NULL,
  url varchar(255) NOT NULL default '',
  email varchar(255) NOT NULL default '',
  pwd varchar(40) default NULL,
  counter int(11) NOT NULL default '0',
  radminsuper tinyint(1) NOT NULL default '1',
  admlanguage varchar(30) NOT NULL default '',
  PRIMARY KEY  (aid),
  KEY aid (aid)
);

#
# Volcar la base de datos para la tabla `nuke_authors`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_autonews`
#

CREATE TABLE nuke_autonews (
  anid int(11) NOT NULL auto_increment,
  catid int(11) NOT NULL default '0',
  aid varchar(30) NOT NULL default '',
  title varchar(80) NOT NULL default '',
  `time` varchar(19) NOT NULL default '',
  hometext text NOT NULL,
  bodytext text NOT NULL,
  topic int(3) NOT NULL default '1',
  informant varchar(20) NOT NULL default '',
  notes text NOT NULL,
  ihome int(1) NOT NULL default '0',
  alanguage varchar(30) NOT NULL default '',
  acomm int(1) NOT NULL default '0',
  associated text NOT NULL,
  PRIMARY KEY  (anid),
  KEY anid (anid)
);

#
# Volcar la base de datos para la tabla `nuke_autonews`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_banned_ip`
#

CREATE TABLE nuke_banned_ip (
  id int(11) NOT NULL auto_increment,
  ip_address varchar(15) NOT NULL default '',
  reason varchar(255) NOT NULL default '',
  `date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (id),
  KEY id (id)
);

#
# Volcar la base de datos para la tabla `nuke_banned_ip`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_banner`
#

CREATE TABLE nuke_banner (
  bid int(11) NOT NULL auto_increment,
  cid int(11) NOT NULL default '0',
  name varchar(50) NOT NULL default '',
  imptotal int(11) NOT NULL default '0',
  impmade int(11) NOT NULL default '0',
  clicks int(11) NOT NULL default '0',
  imageurl varchar(100) NOT NULL default '',
  clickurl varchar(200) NOT NULL default '',
  alttext varchar(255) NOT NULL default '',
  `date` datetime default NULL,
  dateend datetime default NULL,
  position int(10) NOT NULL default '0',
  active tinyint(1) NOT NULL default '1',
  ad_class varchar(5) NOT NULL default '',
  ad_code text NOT NULL,
  ad_width int(4) default '0',
  ad_height int(4) default '0',
  PRIMARY KEY  (bid),
  KEY bid (bid),
  KEY cid (cid)
);

#
# Volcar la base de datos para la tabla `nuke_banner`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_banner_plans`
#

CREATE TABLE nuke_banner_plans (
  pid int(10) NOT NULL auto_increment,
  active tinyint(1) NOT NULL default '0',
  name varchar(255) NOT NULL default '',
  description text NOT NULL,
  delivery varchar(10) NOT NULL default '',
  delivery_type varchar(25) NOT NULL default '',
  price varchar(25) NOT NULL default '0',
  buy_links text NOT NULL,
  PRIMARY KEY  (pid)
);

#
# Volcar la base de datos para la tabla `nuke_banner_plans`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_banner_positions`
#

CREATE TABLE nuke_banner_positions (
  apid int(10) NOT NULL auto_increment,
  position_number int(5) NOT NULL default '0',
  position_name varchar(255) NOT NULL default '',
  PRIMARY KEY  (apid),
  KEY position_number (position_number)
);

#
# Volcar la base de datos para la tabla `nuke_banner_positions`
#

INSERT INTO nuke_banner_positions VALUES (1, 0, 'Page Top');
INSERT INTO nuke_banner_positions VALUES (2, 1, 'Left Block');

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_banner_terms`
#

CREATE TABLE nuke_banner_terms (
  terms_body text NOT NULL,
  country varchar(255) NOT NULL default ''
);

#
# Volcar la base de datos para la tabla `nuke_banner_terms`
#

INSERT INTO nuke_banner_terms VALUES ('<div align="justify"><strong>Introduction:</strong> This Agreement between you and&nbsp;[sitename] consists of these Terms and Conditions. &quot;You&quot; or &quot;Advertiser&quot; means the entity identified in this enrollment form, and/or any agency acting on its behalf, which shall also be bound by the terms of this Agreement. Please read very carefully these Terms and Conditions.<br /><strong><br />Uses:</strong> You agree that your ads may be placed on (i) [sitename] web site and (ii) Any ads may be modified without your consent to comply with any policy of [sitename]. [sitename] reserves the right to, and in its sole discretion may, at any time review, reject, modify, or remove any ad. No liability of [sitename] and/or its owner(s) shall result from any such decision.<br /><br /></div><div align="justify"><strong>Parties\' Responsibilities:</strong> You are responsible of your own site and/or service advertised in [sitename] web site. You are solely responsible for the advertising image creation, advertising text and for the content of your ads, including URL links. [sitename] is not responsible for anything regarding your Web site(s) including, but not limited to, maintenance of your Web site(s), order entry, customer service, payment processing, shipping, cancellations or returns.<br /><br /></div><div align="justify"><strong>Impressions Count:</strong> Any hit to [sitename] web site is counted as an impression. Due to our advertising price we don\'t discriminate from users or automated robots. Even if you access to [sitename] web site and see your own banner ad it will be counted as a valid impression. Only in the case of [sitename] web site administrator, the impressions will not be counted.<br /><br /></div><div align="justify"><strong>Termination, Cancellation:</strong> [sitename] may at any time, in its sole discretion, terminate the Campaign, terminate this Agreement, or cancel any ad(s) or your use of any Target. [sitename] will notify you via email of any such termination or cancellation, which shall be effective immediately. No refund will be made for any reason. Remaining impressions will be stored in a database and you\'ll be able to request another campaign to complete your inventory. You may cancel any ad and/or terminate this Agreement with or without cause at any time. Termination of your account shall be effective when [sitename] receives your notice via email. No refund will be made for any reason. Remaining impressions will be stored in a database for future uses by you and/or your company.<br /><br /></div><div align="justify"><strong>Content:</strong> [sitename] web site doesn\'t accepts advertising that contains: (i) pornography, (ii) explicit adult content, (iii) moral questionable content, (iv) illegal content of any kind, (v) illegal drugs promotion, (vi) racism, (vii) politics content, (viii) religious content, and/or (ix) fraudulent suspicious content. If your advertising and/or target web site has any of this content and you purchased an advertising package, you\'ll not receive refund of any kind but your banners ads impressions will be stored for future use.<br /><br /></div><div align="justify"><strong>Confidentiality:</strong> Each party agrees not to disclose Confidential Information of the other party without prior written consent except as provided herein. &quot;Confidential Information&quot; includes (i) ads, prior to publication, (ii) submissions or modifications relating to any advertising campaign, (iii) clickthrough rates or other statistics (except in an aggregated form that includes no identifiable information about you), and (iv) any other information designated in writing as &quot;Confidential.&quot; It does not include information that has become publicly known through no breach by a party, or has been (i) independently developed without access to the other party\'s Confidential Information; (ii) rightfully received from a third party; or (iii) required to be disclosed by law or by a governmental authority.<br /><br /></div><div align="justify"><strong>No Guarantee:</strong> [sitename] makes no guarantee regarding the levels of clicks for any ad on its site. [sitename] may offer the same Target to more than one advertiser. You may not receive exclusivity unless special private contract between [sitename] and you.<br /><br /></div><div align="justify"><strong>No Warranty:</strong> [sitename] MAKES NO WARRANTY, EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION WITH RESPECT TO ADVERTISING AND OTHER SERVICES, AND EXPRESSLY DISCLAIMS THE WARRANTIES OR CONDITIONS OF NONINFRINGEMENT, MERCHANTABILITY AND FITNESS FOR ANY PARTICULAR PURPOSE.<br /><br /></div><div align="justify"><strong>Limitations of Liability:</strong> In no event shall [sitename] be liable for any act or omission, or any event directly or indirectly resulting from any act or omission of Advertiser, Partner, or any third parties (if any). EXCEPT FOR THE PARTIES\' INDEMNIFICATION AND CONFIDENTIALITY OBLIGATIONS HEREUNDER, (i) IN NO EVENT SHALL EITHER PARTY BE LIABLE UNDER THIS AGREEMENT FOR ANY CONSEQUENTIAL, SPECIAL, INDIRECT, EXEMPLARY, PUNITIVE, OR OTHER DAMAGES WHETHER IN CONTRACT, TORT OR ANY OTHER LEGAL THEORY, EVEN IF SUCH PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES AND NOTWITHSTANDING ANY FAILURE OF ESSENTIAL PURPOSE OF ANY LIMITED REMEDY AND (ii) [sitename] AGGREGATE LIABILITY TO ADVERTISER UNDER THIS AGREEMENT FOR ANY CLAIM IS LIMITED TO THE AMOUNT PAID TO [sitename] BY ADVERTISER FOR THE AD GIVING RISE TO THE CLAIM. Each party acknowledges that the other party has entered into this Agreement relying on the limitations of liability stated herein and that those limitations are an essential basis of the bargain between the parties. Without limiting the foregoing and except for payment obligations, neither party shall have any liability for any failure or delay resulting from any condition beyond the reasonable control of such party, including but not limited to governmental action or acts of terrorism, earthquake or other acts of God, labor conditions, and power failures.<br /><br /></div><div align="justify"><strong>Payment:</strong> You agree to pay in advance the cost of the advertising. [sitename] will not setup any banner ads campaign(s) unless the payment process is complete. [sitename] may change its pricing at any time without prior notice. If you have an advertising campaign running and/or impressions stored for future use for any mentioned cause and [sitename] changes its pricing, you\'ll not need to pay any difference. Your purchased banners fee will remain the same. Charges shall be calculated solely based on records maintained by [sitename]. No other measurements or statistics of any kind shall be accepted by [sitename] or have any effect under this Agreement.<br /><br /></div><div align="justify"><strong>Representations and Warranties:</strong> You represent and warrant that (a) all of the information provided by you to [sitename] to enroll in the Advertising Campaign is correct and current; (b) you hold all rights to permit [sitename] and any Partner(s) to use, reproduce, display, transmit and distribute your ad(s); and (c) [sitename] and any Partner(s) Use, your Target(s), and any site(s) linked to, and products or services to which users are directed, will not, in any state or country where the ad is displayed (i) violate any criminal laws or third party rights giving rise to civil liability, including but not limited to trademark rights or rights relating to the performance of music; or (ii) encourage conduct that would violate any criminal or civil law. You further represent and warrant that any Web site linked to your ad(s) (i) complies with all laws and regulations in any state or country where the ad is displayed; (ii) does not breach and has not breached any duty toward or rights of any person or entity including, without limitation, rights of publicity or privacy, or rights or duties under consumer protection, product liability, tort, or contract theories; and (iii) is not false, misleading, defamatory, libelous, slanderous or threatening.<br /><br /></div><div align="justify"><strong>Your Obligation to Indemnify:</strong> You agree to indemnify, defend and hold [sitename], its agents, affiliates, subsidiaries, directors, officers, employees, and applicable third parties (e.g., all relevant Partner(s), licensors, licensees, consultants and contractors) (&quot;Indemnified Person(s)&quot;) harmless from and against any and all third party claims, liability, loss, and expense (including damage awards, settlement amounts, and reasonable legal fees), brought against any Indemnified Person(s), arising out of, related to or which may arise from your use of the Advertising Program, your Web site, and/or your breach of any term of this Agreement. Customer understands and agrees that each Partner, as defined herein, has the right to assert and enforce its rights under this Section directly on its own behalf as a third party beneficiary.<br /><br /></div><div align="justify"><strong>Information Rights:</strong> [sitename] may retain and use for its own purposes all information you provide, including but not limited to Targets, URLs, the content of ads, and contact and billing information. [sitename] may share this information about you with business partners and/or sponsors. [sitename] will not sell your information. Your name, web site\'s URL and related graphics shall be used by [sitename] in its own web site at any time as a sample to the public, even if your Advertising Campaign has been finished.<br /><br /></div><div align="justify"><strong>Miscellaneous:</strong> Any decision made by [sitename] under this Agreement shall be final. [sitename] shall have no liability for any such decision. You will be responsible for all reasonable expenses (including attorneys\' fees) incurred by [sitename] in collecting unpaid amounts under this Agreement. This Agreement shall be governed by the laws of [country]. Any dispute or claim arising out of or in connection with this Agreement shall be adjudicated in [country]. This constitutes the entire agreement between the parties with respect to the subject matter hereof. Advertiser may not resell, assign, or transfer any of its rights hereunder. Any such attempt may result in termination of this Agreement, without liability to [sitename] and without any refund. The relationship(s) between [sitename] and the &quot;Partners&quot; is not one of a legal partnership relationship, but is one of independent contractors. This Agreement shall be construed as if both parties jointly wrote it.</div>', 'Canada');

#
# Estructura de tabla para la tabla `nuke_banner_clients`
#

CREATE TABLE nuke_banner_clients (
  cid int(11) NOT NULL auto_increment,
  name varchar(60) NOT NULL default '',
  contact varchar(60) NOT NULL default '',
  email varchar(60) NOT NULL default '',
  login varchar(10) NOT NULL default '',
  passwd varchar(10) NOT NULL default '',
  extrainfo text NOT NULL,
  PRIMARY KEY  (cid),
  KEY cid (cid)
);

#
# Volcar la base de datos para la tabla `nuke_banner_clients`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbauth_access`
#

CREATE TABLE nuke_bbauth_access (
  group_id mediumint(8) NOT NULL default '0',
  forum_id smallint(5) unsigned NOT NULL default '0',
  auth_view tinyint(1) NOT NULL default '0',
  auth_read tinyint(1) NOT NULL default '0',
  auth_post tinyint(1) NOT NULL default '0',
  auth_reply tinyint(1) NOT NULL default '0',
  auth_edit tinyint(1) NOT NULL default '0',
  auth_delete tinyint(1) NOT NULL default '0',
  auth_sticky tinyint(1) NOT NULL default '0',
  auth_announce tinyint(1) NOT NULL default '0',
  auth_vote tinyint(1) NOT NULL default '0',
  auth_pollcreate tinyint(1) NOT NULL default '0',
  auth_attachments tinyint(1) NOT NULL default '0',
  auth_mod tinyint(1) NOT NULL default '0',
  KEY group_id (group_id),
  KEY forum_id (forum_id)
);

#
# Volcar la base de datos para la tabla `nuke_bbauth_access`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbbanlist`
#

CREATE TABLE nuke_bbbanlist (
  ban_id mediumint(8) unsigned NOT NULL auto_increment,
  ban_userid mediumint(8) NOT NULL default '0',
  ban_ip varchar(8) NOT NULL default '',
  ban_email varchar(255) default NULL,
  ban_time int(11) default NULL,
  ban_expire_time int(11) default NULL,
  ban_by_userid mediumint(8) default NULL,
  ban_priv_reason text,
  ban_pub_reason_mode tinyint(1) default NULL,
  ban_pub_reason text,
  PRIMARY KEY  (ban_id),
  KEY ban_ip_user_id (ban_ip,ban_userid)
);

#
# Volcar la base de datos para la tabla `nuke_bbbanlist`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbcategories`
#

CREATE TABLE nuke_bbcategories (
  cat_id mediumint(8) unsigned NOT NULL auto_increment,
  cat_title varchar(100) default NULL,
  cat_order mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (cat_id),
  KEY cat_order (cat_order)
);

#
# Volcar la base de datos para la tabla `nuke_bbcategories`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbconfig`
#

CREATE TABLE nuke_bbconfig (
  config_name varchar(255) NOT NULL default '',
  config_value varchar(255) NOT NULL default '',
  PRIMARY KEY  (config_name)
);

#
# Volcar la base de datos para la tabla `nuke_bbconfig`
#

INSERT INTO nuke_bbconfig VALUES ('config_id', '1');
INSERT INTO nuke_bbconfig VALUES ('board_disable', '0');
INSERT INTO nuke_bbconfig VALUES ('sitename', 'MySite.com');
INSERT INTO nuke_bbconfig VALUES ('site_desc', '');
INSERT INTO nuke_bbconfig VALUES ('cookie_name', 'phpbb2mysql');
INSERT INTO nuke_bbconfig VALUES ('cookie_path', '/');
INSERT INTO nuke_bbconfig VALUES ('cookie_domain', 'MySite.com');
INSERT INTO nuke_bbconfig VALUES ('cookie_secure', '0');
INSERT INTO nuke_bbconfig VALUES ('session_length', '3600');
INSERT INTO nuke_bbconfig VALUES ('allow_html', '1');
INSERT INTO nuke_bbconfig VALUES ('allow_html_tags', 'b,i,u,pre');
INSERT INTO nuke_bbconfig VALUES ('allow_bbcode', '1');
INSERT INTO nuke_bbconfig VALUES ('allow_smilies', '1');
INSERT INTO nuke_bbconfig VALUES ('allow_sig', '1');
INSERT INTO nuke_bbconfig VALUES ('allow_namechange', '0');
INSERT INTO nuke_bbconfig VALUES ('allow_theme_create', '0');
INSERT INTO nuke_bbconfig VALUES ('allow_avatar_local', '1');
INSERT INTO nuke_bbconfig VALUES ('allow_avatar_remote', '0');
INSERT INTO nuke_bbconfig VALUES ('allow_avatar_upload', '0');
INSERT INTO nuke_bbconfig VALUES ('override_user_style', '1');
INSERT INTO nuke_bbconfig VALUES ('posts_per_page', '15');
INSERT INTO nuke_bbconfig VALUES ('topics_per_page', '50');
INSERT INTO nuke_bbconfig VALUES ('hot_threshold', '25');
INSERT INTO nuke_bbconfig VALUES ('max_poll_options', '10');
INSERT INTO nuke_bbconfig VALUES ('max_sig_chars', '255');
INSERT INTO nuke_bbconfig VALUES ('max_inbox_privmsgs', '100');
INSERT INTO nuke_bbconfig VALUES ('max_sentbox_privmsgs', '100');
INSERT INTO nuke_bbconfig VALUES ('max_savebox_privmsgs', '100');
INSERT INTO nuke_bbconfig VALUES ('board_email_sig', 'Thanks, Webmaster@MySite.com');
INSERT INTO nuke_bbconfig VALUES ('board_email', 'Webmaster@MySite.com');
INSERT INTO nuke_bbconfig VALUES ('smtp_delivery', '0');
INSERT INTO nuke_bbconfig VALUES ('smtp_host', '');
INSERT INTO nuke_bbconfig VALUES ('require_activation', '0');
INSERT INTO nuke_bbconfig VALUES ('flood_interval', '15');
INSERT INTO nuke_bbconfig VALUES ('board_email_form', '0');
INSERT INTO nuke_bbconfig VALUES ('avatar_filesize', '6144');
INSERT INTO nuke_bbconfig VALUES ('avatar_max_width', '80');
INSERT INTO nuke_bbconfig VALUES ('avatar_max_height', '80');
INSERT INTO nuke_bbconfig VALUES ('avatar_path', 'modules/Forums/images/avatars');
INSERT INTO nuke_bbconfig VALUES ('avatar_gallery_path', 'modules/Forums/images/avatars');
INSERT INTO nuke_bbconfig VALUES ('smilies_path', 'modules/Forums/images/smiles');
INSERT INTO nuke_bbconfig VALUES ('default_style', '1');
INSERT INTO nuke_bbconfig VALUES ('default_dateformat', 'D M d, Y g:i a');
INSERT INTO nuke_bbconfig VALUES ('board_timezone', '10');
INSERT INTO nuke_bbconfig VALUES ('prune_enable', '0');
INSERT INTO nuke_bbconfig VALUES ('privmsg_disable', '0');
INSERT INTO nuke_bbconfig VALUES ('gzip_compress', '0');
INSERT INTO nuke_bbconfig VALUES ('coppa_fax', '');
INSERT INTO nuke_bbconfig VALUES ('coppa_mail', '');
INSERT INTO nuke_bbconfig VALUES ('board_startdate', '1013908210');
INSERT INTO nuke_bbconfig VALUES ('default_lang', 'english');
INSERT INTO nuke_bbconfig VALUES ('smtp_username', '');
INSERT INTO nuke_bbconfig VALUES ('smtp_password', '');
INSERT INTO nuke_bbconfig VALUES ('record_online_users', '2');
INSERT INTO nuke_bbconfig VALUES ('record_online_date', '1034668530');
INSERT INTO nuke_bbconfig VALUES ('server_name', 'MySite.com');
INSERT INTO nuke_bbconfig VALUES ('server_port', '80');
INSERT INTO nuke_bbconfig VALUES ('script_path', '/modules/Forums/');
INSERT INTO nuke_bbconfig VALUES ('version', '.0.21');
INSERT INTO nuke_bbconfig VALUES ('enable_confirm', '0');
INSERT INTO nuke_bbconfig VALUES ('sendmail_fix', '0');
INSERT INTO nuke_bbconfig VALUES ('search_flood_interval', '15');
INSERT INTO nuke_bbconfig VALUES ('rand_seed', '0');
INSERT INTO nuke_bbconfig VALUES ('search_min_chars', '3');
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbdisallow`
#

CREATE TABLE nuke_bbdisallow (
  disallow_id mediumint(8) unsigned NOT NULL auto_increment,
  disallow_username varchar(25) default NULL,
  PRIMARY KEY  (disallow_id)
);

#
# Volcar la base de datos para la tabla `nuke_bbdisallow`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbforum_prune`
#

CREATE TABLE nuke_bbforum_prune (
  prune_id mediumint(8) unsigned NOT NULL auto_increment,
  forum_id smallint(5) unsigned NOT NULL default '0',
  prune_days tinyint(4) unsigned NOT NULL default '0',
  prune_freq tinyint(4) unsigned NOT NULL default '0',
  PRIMARY KEY  (prune_id),
  KEY forum_id (forum_id)
);

#
# Volcar la base de datos para la tabla `nuke_bbforum_prune`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbforums`
#

CREATE TABLE nuke_bbforums (
  forum_id smallint(5) unsigned NOT NULL auto_increment,
  cat_id mediumint(8) unsigned NOT NULL default '0',
  forum_name varchar(150) default NULL,
  forum_desc text,
  forum_status tinyint(4) NOT NULL default '0',
  forum_order mediumint(8) unsigned NOT NULL default '1',
  forum_posts mediumint(8) unsigned NOT NULL default '0',
  forum_topics mediumint(8) unsigned NOT NULL default '0',
  forum_last_post_id mediumint(8) unsigned NOT NULL default '0',
  prune_next int(11) default NULL,
  prune_enable tinyint(1) NOT NULL default '1',
  auth_view tinyint(2) NOT NULL default '0',
  auth_read tinyint(2) NOT NULL default '0',
  auth_post tinyint(2) NOT NULL default '0',
  auth_reply tinyint(2) NOT NULL default '0',
  auth_edit tinyint(2) NOT NULL default '0',
  auth_delete tinyint(2) NOT NULL default '0',
  auth_sticky tinyint(2) NOT NULL default '0',
  auth_announce tinyint(2) NOT NULL default '0',
  auth_vote tinyint(2) NOT NULL default '0',
  auth_pollcreate tinyint(2) NOT NULL default '0',
  auth_attachments tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (forum_id),
  KEY forums_order (forum_order),
  KEY cat_id (cat_id),
  KEY forum_last_post_id (forum_last_post_id)
);

#
# Volcar la base de datos para la tabla `nuke_bbforums`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbgroups`
#

CREATE TABLE nuke_bbgroups (
  group_id mediumint(8) NOT NULL auto_increment,
  group_type tinyint(4) NOT NULL default '1',
  group_name varchar(40) NOT NULL default '',
  group_description varchar(255) NOT NULL default '',
  group_moderator mediumint(8) NOT NULL default '0',
  group_single_user tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (group_id),
  KEY group_single_user (group_single_user)
);

#
# Volcar la base de datos para la tabla `nuke_bbgroups`
#

INSERT INTO nuke_bbgroups VALUES (1, 1, 'Anonymous', 'Personal User', 0, 1);
INSERT INTO nuke_bbgroups VALUES (3, 2, 'Moderators', 'Moderators of this Forum', 5, 0);
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbposts`
#

CREATE TABLE nuke_bbposts (
  post_id mediumint(8) unsigned NOT NULL auto_increment,
  topic_id mediumint(8) unsigned NOT NULL default '0',
  forum_id smallint(5) unsigned NOT NULL default '0',
  poster_id mediumint(8) NOT NULL default '0',
  post_time int(11) NOT NULL default '0',
  poster_ip varchar(8) NOT NULL default '',
  post_username varchar(25) default NULL,
  enable_bbcode tinyint(1) NOT NULL default '1',
  enable_html tinyint(1) NOT NULL default '0',
  enable_smilies tinyint(1) NOT NULL default '1',
  enable_sig tinyint(1) NOT NULL default '1',
  post_edit_time int(11) default NULL,
  post_edit_count smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (post_id),
  KEY forum_id (forum_id),
  KEY topic_id (topic_id),
  KEY poster_id (poster_id),
  KEY post_time (post_time)
);

#
# Volcar la base de datos para la tabla `nuke_bbposts`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbposts_text`
#

CREATE TABLE nuke_bbposts_text (
  post_id mediumint(8) unsigned NOT NULL default '0',
  bbcode_uid varchar(10) NOT NULL default '',
  post_subject varchar(60) default NULL,
  post_text text,
  PRIMARY KEY  (post_id)
);

#
# Volcar la base de datos para la tabla `nuke_bbposts_text`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbprivmsgs`
#

CREATE TABLE nuke_bbprivmsgs (
  privmsgs_id mediumint(8) unsigned NOT NULL auto_increment,
  privmsgs_type tinyint(4) NOT NULL default '0',
  privmsgs_subject varchar(255) NOT NULL default '0',
  privmsgs_from_userid mediumint(8) NOT NULL default '0',
  privmsgs_to_userid mediumint(8) NOT NULL default '0',
  privmsgs_date int(11) NOT NULL default '0',
  privmsgs_ip varchar(8) NOT NULL default '',
  privmsgs_enable_bbcode tinyint(1) NOT NULL default '1',
  privmsgs_enable_html tinyint(1) NOT NULL default '0',
  privmsgs_enable_smilies tinyint(1) NOT NULL default '1',
  privmsgs_attach_sig tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (privmsgs_id),
  KEY privmsgs_from_userid (privmsgs_from_userid),
  KEY privmsgs_to_userid (privmsgs_to_userid)
);

#
# Volcar la base de datos para la tabla `nuke_bbprivmsgs`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbprivmsgs_text`
#

CREATE TABLE nuke_bbprivmsgs_text (
  privmsgs_text_id mediumint(8) unsigned NOT NULL default '0',
  privmsgs_bbcode_uid varchar(10) NOT NULL default '0',
  privmsgs_text text,
  PRIMARY KEY  (privmsgs_text_id)
);

#
# Volcar la base de datos para la tabla `nuke_bbprivmsgs_text`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbranks`
#

CREATE TABLE nuke_bbranks (
  rank_id smallint(5) unsigned NOT NULL auto_increment,
  rank_title varchar(50) NOT NULL default '',
  rank_min mediumint(8) NOT NULL default '0',
  rank_max mediumint(8) NOT NULL default '0',
  rank_special tinyint(1) default '0',
  rank_image varchar(255) default NULL,
  PRIMARY KEY  (rank_id)
);

#
# Volcar la base de datos para la tabla `nuke_bbranks`
#

INSERT INTO nuke_bbranks VALUES (1, 'Site Admin', -1, -1, 1, 'modules/Forums/images/ranks/6stars.gif');
INSERT INTO nuke_bbranks VALUES (2, 'Newbie', 1, 0, 0, 'modules/Forums/images/ranks/1star.gif');
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbsearch_results`
#

CREATE TABLE nuke_bbsearch_results (
  search_id int(11) unsigned NOT NULL default '0',
  session_id varchar(32) NOT NULL default '',
  search_array text NOT NULL,
  search_time int(11) DEFAULT '0' NOT NULL,
  PRIMARY KEY  (search_id),
  KEY session_id (session_id)
);

#
# Volcar la base de datos para la tabla `nuke_bbsearch_results`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbsearch_wordlist`
#

CREATE TABLE nuke_bbsearch_wordlist (
  word_text varchar(50) NOT NULL default '',
  word_id mediumint(8) unsigned NOT NULL auto_increment,
  word_common tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (word_text),
  KEY word_id (word_id)
);

#
# Volcar la base de datos para la tabla `nuke_bbsearch_wordlist`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbsearch_wordmatch`
#

CREATE TABLE nuke_bbsearch_wordmatch (
  post_id mediumint(8) unsigned NOT NULL default '0',
  word_id mediumint(8) unsigned NOT NULL default '0',
  title_match tinyint(1) NOT NULL default '0',
  KEY word_id (word_id)
);

#
# Volcar la base de datos para la tabla `nuke_bbsearch_wordmatch`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbsessions`
#

CREATE TABLE nuke_bbsessions (
  session_id char(32) NOT NULL default '',
  session_user_id mediumint(8) NOT NULL default '0',
  session_start int(11) NOT NULL default '0',
  session_time int(11) NOT NULL default '0',
  session_ip char(8) NOT NULL default '0',
  session_page int(11) NOT NULL default '0',
  session_logged_in tinyint(1) NOT NULL default '0',
  session_admin tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (session_id),
  KEY session_user_id (session_user_id),
  KEY session_id_ip_user_id (session_id,session_ip,session_user_id)
);

#
# Volcar la base de datos para la tabla `nuke_bbsessions`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbsmilies`
#

CREATE TABLE nuke_bbsmilies (
  smilies_id smallint(5) unsigned NOT NULL auto_increment,
  code varchar(50) default NULL,
  smile_url varchar(100) default NULL,
  emoticon varchar(75) default NULL,
  PRIMARY KEY  (smilies_id)
);

#
# Volcar la base de datos para la tabla `nuke_bbsmilies`
#

INSERT INTO nuke_bbsmilies VALUES (1, ':D', 'icon_biggrin.gif', 'Very Happy');
INSERT INTO nuke_bbsmilies VALUES (2, ':-D', 'icon_biggrin.gif', 'Very Happy');
INSERT INTO nuke_bbsmilies VALUES (3, ':grin:', 'icon_biggrin.gif', 'Very Happy');
INSERT INTO nuke_bbsmilies VALUES (4, ':)', 'icon_smile.gif', 'Smile');
INSERT INTO nuke_bbsmilies VALUES (5, ':-)', 'icon_smile.gif', 'Smile');
INSERT INTO nuke_bbsmilies VALUES (6, ':smile:', 'icon_smile.gif', 'Smile');
INSERT INTO nuke_bbsmilies VALUES (7, ':(', 'icon_sad.gif', 'Sad');
INSERT INTO nuke_bbsmilies VALUES (8, ':-(', 'icon_sad.gif', 'Sad');
INSERT INTO nuke_bbsmilies VALUES (9, ':sad:', 'icon_sad.gif', 'Sad');
INSERT INTO nuke_bbsmilies VALUES (10, ':o', 'icon_surprised.gif', 'Surprised');
INSERT INTO nuke_bbsmilies VALUES (11, ':-o', 'icon_surprised.gif', 'Surprised');
INSERT INTO nuke_bbsmilies VALUES (12, ':eek:', 'icon_surprised.gif', 'Surprised');
INSERT INTO nuke_bbsmilies VALUES (13, '8O', 'icon_eek.gif', 'Shocked');
INSERT INTO nuke_bbsmilies VALUES (14, '8-O', 'icon_eek.gif', 'Shocked');
INSERT INTO nuke_bbsmilies VALUES (15, ':shock:', 'icon_eek.gif', 'Shocked');
INSERT INTO nuke_bbsmilies VALUES (16, ':?', 'icon_confused.gif', 'Confused');
INSERT INTO nuke_bbsmilies VALUES (17, ':-?', 'icon_confused.gif', 'Confused');
INSERT INTO nuke_bbsmilies VALUES (18, ':???:', 'icon_confused.gif', 'Confused');
INSERT INTO nuke_bbsmilies VALUES (19, '8)', 'icon_cool.gif', 'Cool');
INSERT INTO nuke_bbsmilies VALUES (20, '8-)', 'icon_cool.gif', 'Cool');
INSERT INTO nuke_bbsmilies VALUES (21, ':cool:', 'icon_cool.gif', 'Cool');
INSERT INTO nuke_bbsmilies VALUES (22, ':lol:', 'icon_lol.gif', 'Laughing');
INSERT INTO nuke_bbsmilies VALUES (23, ':x', 'icon_mad.gif', 'Mad');
INSERT INTO nuke_bbsmilies VALUES (24, ':-x', 'icon_mad.gif', 'Mad');
INSERT INTO nuke_bbsmilies VALUES (25, ':mad:', 'icon_mad.gif', 'Mad');
INSERT INTO nuke_bbsmilies VALUES (26, ':P', 'icon_razz.gif', 'Razz');
INSERT INTO nuke_bbsmilies VALUES (27, ':-P', 'icon_razz.gif', 'Razz');
INSERT INTO nuke_bbsmilies VALUES (28, ':razz:', 'icon_razz.gif', 'Razz');
INSERT INTO nuke_bbsmilies VALUES (29, ':oops:', 'icon_redface.gif', 'Embarassed');
INSERT INTO nuke_bbsmilies VALUES (30, ':cry:', 'icon_cry.gif', 'Crying or Very sad');
INSERT INTO nuke_bbsmilies VALUES (31, ':evil:', 'icon_evil.gif', 'Evil or Very Mad');
INSERT INTO nuke_bbsmilies VALUES (32, ':twisted:', 'icon_twisted.gif', 'Twisted Evil');
INSERT INTO nuke_bbsmilies VALUES (33, ':roll:', 'icon_rolleyes.gif', 'Rolling Eyes');
INSERT INTO nuke_bbsmilies VALUES (34, ':wink:', 'icon_wink.gif', 'Wink');
INSERT INTO nuke_bbsmilies VALUES (35, ';)', 'icon_wink.gif', 'Wink');
INSERT INTO nuke_bbsmilies VALUES (36, ';-)', 'icon_wink.gif', 'Wink');
INSERT INTO nuke_bbsmilies VALUES (37, ':!:', 'icon_exclaim.gif', 'Exclamation');
INSERT INTO nuke_bbsmilies VALUES (38, ':?:', 'icon_question.gif', 'Question');
INSERT INTO nuke_bbsmilies VALUES (39, ':idea:', 'icon_idea.gif', 'Idea');
INSERT INTO nuke_bbsmilies VALUES (40, ':arrow:', 'icon_arrow.gif', 'Arrow');
INSERT INTO nuke_bbsmilies VALUES (41, ':|', 'icon_neutral.gif', 'Neutral');
INSERT INTO nuke_bbsmilies VALUES (42, ':-|', 'icon_neutral.gif', 'Neutral');
INSERT INTO nuke_bbsmilies VALUES (43, ':neutral:', 'icon_neutral.gif', 'Neutral');
INSERT INTO nuke_bbsmilies VALUES (44, ':mrgreen:', 'icon_mrgreen.gif', 'Mr. Green');
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbthemes`
#

CREATE TABLE nuke_bbthemes (
  themes_id mediumint(8) unsigned NOT NULL auto_increment,
  template_name varchar(30) NOT NULL default '',
  style_name varchar(30) NOT NULL default '',
  head_stylesheet varchar(100) default NULL,
  body_background varchar(100) default NULL,
  body_bgcolor varchar(6) default NULL,
  body_text varchar(6) default NULL,
  body_link varchar(6) default NULL,
  body_vlink varchar(6) default NULL,
  body_alink varchar(6) default NULL,
  body_hlink varchar(6) default NULL,
  tr_color1 varchar(6) default NULL,
  tr_color2 varchar(6) default NULL,
  tr_color3 varchar(6) default NULL,
  tr_class1 varchar(25) default NULL,
  tr_class2 varchar(25) default NULL,
  tr_class3 varchar(25) default NULL,
  th_color1 varchar(6) default NULL,
  th_color2 varchar(6) default NULL,
  th_color3 varchar(6) default NULL,
  th_class1 varchar(25) default NULL,
  th_class2 varchar(25) default NULL,
  th_class3 varchar(25) default NULL,
  td_color1 varchar(6) default NULL,
  td_color2 varchar(6) default NULL,
  td_color3 varchar(6) default NULL,
  td_class1 varchar(25) default NULL,
  td_class2 varchar(25) default NULL,
  td_class3 varchar(25) default NULL,
  fontface1 varchar(50) default NULL,
  fontface2 varchar(50) default NULL,
  fontface3 varchar(50) default NULL,
  fontsize1 tinyint(4) default NULL,
  fontsize2 tinyint(4) default NULL,
  fontsize3 tinyint(4) default NULL,
  fontcolor1 varchar(6) default NULL,
  fontcolor2 varchar(6) default NULL,
  fontcolor3 varchar(6) default NULL,
  span_class1 varchar(25) default NULL,
  span_class2 varchar(25) default NULL,
  span_class3 varchar(25) default NULL,
  img_size_poll smallint(5) unsigned default NULL,
  img_size_privmsg smallint(5) unsigned default NULL,
  PRIMARY KEY  (themes_id)
);

#
# Volcar la base de datos para la tabla `nuke_bbthemes`
#

INSERT INTO nuke_bbthemes VALUES (1, 'subSilver', 'subSilver', 'subSilver.css', '', '0E3259', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', 10, 11, 12, '444444', '006600', 'FFA34F', '', '', '', NULL, NULL);
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbthemes_name`
#

CREATE TABLE nuke_bbthemes_name (
  themes_id smallint(5) unsigned NOT NULL default '0',
  tr_color1_name char(50) default NULL,
  tr_color2_name char(50) default NULL,
  tr_color3_name char(50) default NULL,
  tr_class1_name char(50) default NULL,
  tr_class2_name char(50) default NULL,
  tr_class3_name char(50) default NULL,
  th_color1_name char(50) default NULL,
  th_color2_name char(50) default NULL,
  th_color3_name char(50) default NULL,
  th_class1_name char(50) default NULL,
  th_class2_name char(50) default NULL,
  th_class3_name char(50) default NULL,
  td_color1_name char(50) default NULL,
  td_color2_name char(50) default NULL,
  td_color3_name char(50) default NULL,
  td_class1_name char(50) default NULL,
  td_class2_name char(50) default NULL,
  td_class3_name char(50) default NULL,
  fontface1_name char(50) default NULL,
  fontface2_name char(50) default NULL,
  fontface3_name char(50) default NULL,
  fontsize1_name char(50) default NULL,
  fontsize2_name char(50) default NULL,
  fontsize3_name char(50) default NULL,
  fontcolor1_name char(50) default NULL,
  fontcolor2_name char(50) default NULL,
  fontcolor3_name char(50) default NULL,
  span_class1_name char(50) default NULL,
  span_class2_name char(50) default NULL,
  span_class3_name char(50) default NULL,
  PRIMARY KEY  (themes_id)
);

#
# Volcar la base de datos para la tabla `nuke_bbthemes_name`
#

INSERT INTO nuke_bbthemes_name VALUES (1, 'The lightest row colour', 'The medium row color', 'The darkest row colour', '', '', '', 'Border round the whole page', 'Outer table border', 'Inner table border', 'Silver gradient picture', 'Blue gradient picture', 'Fade-out gradient on index', 'Background for quote boxes', 'All white areas', '', 'Background for topic posts', '2nd background for topic posts', '', 'Main fonts', 'Additional topic title font', 'Form fonts', 'Smallest font size', 'Medium font size', 'Normal font size (post body etc)', 'Quote & copyright text', 'Code text colour', 'Main table header text colour', '', '', '');
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbtopics`
#

CREATE TABLE nuke_bbtopics (
  topic_id mediumint(8) unsigned NOT NULL auto_increment,
  forum_id smallint(8) unsigned NOT NULL default '0',
  topic_title char(60) NOT NULL default '',
  topic_poster mediumint(8) NOT NULL default '0',
  topic_time int(11) NOT NULL default '0',
  topic_views mediumint(8) unsigned NOT NULL default '0',
  topic_replies mediumint(8) unsigned NOT NULL default '0',
  topic_status tinyint(3) NOT NULL default '0',
  topic_vote tinyint(1) NOT NULL default '0',
  topic_type tinyint(3) NOT NULL default '0',
  topic_last_post_id mediumint(8) unsigned NOT NULL default '0',
  topic_first_post_id mediumint(8) unsigned NOT NULL default '0',
  topic_moved_id mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (topic_id),
  KEY forum_id (forum_id),
  KEY topic_moved_id (topic_moved_id),
  KEY topic_status (topic_status),
  KEY topic_type (topic_type)
);

#
# Volcar la base de datos para la tabla `nuke_bbtopics`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbtopics_watch`
#

CREATE TABLE nuke_bbtopics_watch (
  topic_id mediumint(8) unsigned NOT NULL default '0',
  user_id mediumint(8) NOT NULL default '0',
  notify_status tinyint(1) NOT NULL default '0',
  KEY topic_id (topic_id),
  KEY user_id (user_id),
  KEY notify_status (notify_status)
);

#
# Volcar la base de datos para la tabla `nuke_bbtopics_watch`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbuser_group`
#

CREATE TABLE nuke_bbuser_group (
  group_id mediumint(8) NOT NULL default '0',
  user_id mediumint(8) NOT NULL default '0',
  user_pending tinyint(1) default NULL,
  KEY group_id (group_id),
  KEY user_id (user_id)
);

#
# Volcar la base de datos para la tabla `nuke_bbuser_group`
#

INSERT INTO nuke_bbuser_group VALUES (1, -1, 0);
INSERT INTO nuke_bbuser_group VALUES (3, 5, 0);
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbvote_desc`
#

CREATE TABLE nuke_bbvote_desc (
  vote_id mediumint(8) unsigned NOT NULL auto_increment,
  topic_id mediumint(8) unsigned NOT NULL default '0',
  vote_text text NOT NULL,
  vote_start int(11) NOT NULL default '0',
  vote_length int(11) NOT NULL default '0',
  PRIMARY KEY  (vote_id),
  KEY topic_id (topic_id)
);

#
# Volcar la base de datos para la tabla `nuke_bbvote_desc`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbvote_results`
#

CREATE TABLE nuke_bbvote_results (
  vote_id mediumint(8) unsigned NOT NULL default '0',
  vote_option_id tinyint(4) unsigned NOT NULL default '0',
  vote_option_text varchar(255) NOT NULL default '',
  vote_result int(11) NOT NULL default '0',
  KEY vote_option_id (vote_option_id),
  KEY vote_id (vote_id)
);

#
# Volcar la base de datos para la tabla `nuke_bbvote_results`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbvote_voters`
#

CREATE TABLE nuke_bbvote_voters (
  vote_id mediumint(8) unsigned NOT NULL default '0',
  vote_user_id mediumint(8) NOT NULL default '0',
  vote_user_ip char(8) NOT NULL default '',
  KEY vote_id (vote_id),
  KEY vote_user_id (vote_user_id),
  KEY vote_user_ip (vote_user_ip)
);

#
# Volcar la base de datos para la tabla `nuke_bbvote_voters`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_bbwords`
#

CREATE TABLE nuke_bbwords (
  word_id mediumint(8) unsigned NOT NULL auto_increment,
  word char(100) NOT NULL default '',
  replacement char(100) NOT NULL default '',
  PRIMARY KEY  (word_id)
);

#
# Volcar la base de datos para la tabla `nuke_bbwords`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_blocks`
#

CREATE TABLE nuke_blocks (
  bid int(10) NOT NULL auto_increment,
  bkey varchar(15) NOT NULL default '',
  title varchar(60) NOT NULL default '',
  content text NOT NULL,
  url varchar(200) NOT NULL default '',
  bposition char(1) NOT NULL default '',
  weight int(10) NOT NULL default '1',
  active int(1) NOT NULL default '1',
  refresh int(10) NOT NULL default '0',
  `time` varchar(14) NOT NULL default '0',
  blanguage varchar(30) NOT NULL default '',
  blockfile varchar(255) NOT NULL default '',
  view int(1) NOT NULL default '0',
  expire varchar(14) NOT NULL default '0',
  `action` char(1) NOT NULL default '',
  subscription int(1) NOT NULL default '0',
  PRIMARY KEY  (bid),
  KEY bid (bid),
  KEY title (title)
);

#
# Volcar la base de datos para la tabla `nuke_blocks`
#

INSERT INTO nuke_blocks VALUES (1, '', 'Modules', '', '', 'l', 1, 1, 0, '', '', 'block-Modules.php', 0, '0', 'd', 0);
INSERT INTO nuke_blocks VALUES (2, 'admin', 'Administration', '<strong><big>&middot;</big></strong> <a href="admin.php">Administration</a><br>\r\n<strong><big>&middot;</big></strong> <a href="admin.php?op=adminStory">NEW Story</a><br>\r\n<strong><big>&middot;</big></strong> <a href="admin.php?op=create">Change Survey</a><br>\r\n<strong><big>&middot;</big></strong> <a href="admin.php?op=content">Content</a><br>\r\n<strong><big>&middot;</big></strong> <a href="admin.php?op=logout">Logout</a>', '', 'l', 2, 1, 0, '985591188', '', '', 2, '0', 'd', 0);
INSERT INTO nuke_blocks VALUES (3, '', 'Who\'s Online', '', '', 'l', 3, 1, 0, '', '', 'block-Who_is_Online.php', 0, '0', 'd', 0);
INSERT INTO nuke_blocks VALUES (4, '', 'Search', '', '', 'l', 4, 0, 3600, '', '', 'block-Search.php', 0, '0', 'd', 0);
INSERT INTO nuke_blocks VALUES (5, '', 'Languages', '', '', 'l', 5, 1, 3600, '', '', 'block-Languages.php', 0, '0', 'd', 0);
INSERT INTO nuke_blocks VALUES (6, '', 'Random Headlines', '', '', 'l', 6, 0, 3600, '', '', 'block-Random_Headlines.php', 0, '0', 'd', 0);
INSERT INTO nuke_blocks VALUES (8, 'userbox', 'User\'s Custom Box', '', '', 'r', 1, 1, 0, '', '', '', 1, '0', 'd', 0);
INSERT INTO nuke_blocks VALUES (9, '', 'Categories Menu', '', '', 'r', 2, 0, 0, '', '', 'block-Categories.php', 0, '0', 'd', 0);
INSERT INTO nuke_blocks VALUES (10, '', 'Survey', '', '', 'r', 3, 1, 3600, '', '', 'block-Survey.php', 0, '0', 'd', 0);
INSERT INTO nuke_blocks VALUES (11, '', 'Login', '', '', 'r', 4, 1, 3600, '', '', 'block-Login.php', 3, '0', 'd', 0);
INSERT INTO nuke_blocks VALUES (12, '', 'Big Story of Today', '', '', 'r', 5, 1, 3600, '', '', 'block-Big_Story_of_Today.php', 0, '0', 'd', 0);
INSERT INTO nuke_blocks VALUES (13, '', 'Old Articles', '', '', 'r', 6, 1, 3600, '', '', 'block-Old_Articles.php', 0, '0', 'd', 0);
INSERT INTO nuke_blocks VALUES (14, '', 'Information', '<br><center><font class="content">\r\n<a href="http://phpnuke.org"><img src="images/powered/powered8.jpg" border="0" alt="Powered by PHP-Nuke" title="Powered by PHP-Nuke" width="88" height="31"></a>\r\n<br><br>\r\n<a href="http://validator.w3.org/check/referer"><img src="images/html401.gif" width="88" height="31" alt="Valid HTML 4.01!" title="Valid HTML 4.01!" border="0"></a>\r\n<br><br>\r\n<a href="http://jigsaw.w3.org/css-validator"><img src="images/css.gif" width="88" height="31" alt="Valid CSS!" title="Valid CSS!" border="0"></a></font></center><br>', '', 'r', 7, 1, 0, '', '', '', 0, '0', 'd', 0);

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_cities`
#

CREATE TABLE nuke_cities (
  id mediumint(4) NOT NULL default '0',
  local_id mediumint(3) NOT NULL default '0',
  city varchar(65) NOT NULL default '',
  cc char(2) NOT NULL default '',
  country varchar(35) NOT NULL default '',
  PRIMARY KEY  (id)
);

#
# Volcar la base de datos para la tabla `nuke_cities`
#

INSERT INTO nuke_cities VALUES (1, 1, 'Asâdâbâd', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (2, 2, 'Âybak', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (3, 3, 'Baghlân', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (4, 4, 'Balkh', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (5, 5, 'Bâmîyân', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (6, 6, 'Chaghcharân', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (7, 7, 'Chârîkâr', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (8, 8, 'Farâh', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (9, 9, 'Fayzâbâd', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (10, 10, 'Ghardez', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (11, 11, 'Ghazni', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (12, 12, 'Herât', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (13, 13, 'Jalâlâbâd', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (14, 14, 'Kâbul', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (15, 15, 'Khânâbâd', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (16, 16, 'Khawst', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (17, 17, 'Kholm', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (18, 18, 'Lashkar Gâh', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (19, 19, 'Mahmûd-e Râqî', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (20, 20, 'Maydânshahr', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (21, 21, 'Maymânah', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (22, 22, 'Mazâr-e Sharîf', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (23, 23, 'Mehtar Lâm', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (24, 24, 'Nûristân', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (25, 25, 'Pol-e Alam', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (26, 26, 'Pol-e Khumri', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (27, 27, 'Qal´eh-ye Naw', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (28, 28, 'Qalât-e Ghilzay', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (29, 29, 'Qandahâr', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (30, 30, 'Qundûz', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (31, 31, 'Sar-e Pul', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (32, 32, 'Shibarghan', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (33, 33, 'Tâloqân', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (34, 34, 'Tarîn Kawt', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (35, 35, 'Zaranj', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (36, 36, 'Zareh Sharan', 'af', 'Afghanistan');
INSERT INTO nuke_cities VALUES (37, 1, 'Bajram Curri', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (38, 2, 'Ballsh', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (39, 3, 'Berat', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (40, 4, 'Bilisht', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (41, 5, 'Bulqizë', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (42, 6, 'Burrel', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (43, 7, 'Çorovodë', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (44, 8, 'Delvinë', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (45, 9, 'Durrës', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (46, 10, 'Elbasan', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (47, 11, 'Ersekë', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (48, 12, 'Fier', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (49, 13, 'Gjirokastër', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (50, 14, 'Gramsh', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (51, 15, 'Kavajë', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (52, 16, 'Koplik', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (53, 17, 'Korçë', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (54, 18, 'Krujë', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (55, 19, 'Krumë', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (56, 20, 'Kuçovë', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (57, 21, 'Kukës', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (58, 22, 'Laç', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (59, 23, 'Lezhë', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (60, 24, 'Librazhd', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (61, 25, 'Lushnjë', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (62, 26, 'Patos', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (63, 27, 'Peqin', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (64, 28, 'Përmet', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (65, 29, 'Peshkopi', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (66, 30, 'Pogradec', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (67, 31, 'Pukë', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (68, 32, 'Rrëshen', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (69, 33, 'Sarandë', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (70, 34, 'Shkodër', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (71, 35, 'Tepelenë', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (72, 36, 'Tiranë', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (73, 37, 'Vlorë', 'al', 'Albania');
INSERT INTO nuke_cities VALUES (74, 1, '´Ayn Baydâ', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (75, 2, '´Ayn Daflah', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (76, 3, '´Ayn Tamûshanat', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (77, 4, 'Adrâr', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (78, 5, 'al-´Ulmah', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (79, 6, 'al-Aghwât', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (80, 7, 'al-Bayadh', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (81, 8, 'al-Bûnî', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (82, 9, 'al-Jazâ´ir', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (83, 10, 'al-Wâd', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (84, 11, 'Annâbah', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (85, 12, 'ash-Shalif', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (86, 13, 'at-Tarif', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (87, 14, 'Bab Azwâr', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (88, 15, 'Bashshar', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (89, 16, 'Bâtnah', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (90, 17, 'Bijâyah', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (91, 18, 'Biskrah', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (92, 19, 'Blîdah', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (93, 20, 'Bû Sâ´adah', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (94, 21, 'Bûîrah', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (95, 22, 'Bumardas', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (96, 23, 'Burj Bû Arrîrij', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (97, 24, 'Burj-al-Kiffan', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (98, 25, 'Ghâlizân', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (99, 26, 'Ghardâyah', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (100, 27, 'Ilizi', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (101, 28, 'Jîjîlî', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (102, 29, 'Jilfah', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (103, 30, 'Khanshalah', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (104, 31, 'Masîlah', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (105, 32, 'Midyah', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (106, 33, 'Mîlah', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (107, 34, 'Muaskar', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (108, 35, 'Mustaghanam', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (109, 36, 'Naama', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (110, 37, 'Qalmah', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (111, 38, 'Qustantînah', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (112, 39, 'Sakîkdah', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (113, 40, 'Satîf', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (114, 41, 'Saydâ\'', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (115, 42, 'Sîdî ban-al-´Abbas', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (116, 43, 'Sûq Ahrâs', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (117, 44, 'Tamanghâsat', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (118, 45, 'Tibâzah', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (119, 46, 'Tibissah', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (120, 47, 'Tîlîmsân', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (121, 48, 'Tindûf', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (122, 49, 'Tîsamsîlt', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (123, 50, 'Tiyârat', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (124, 51, 'Tîzî Wazû', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (125, 52, 'Umm-al-Bawâghî', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (126, 53, 'Wahrân', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (127, 54, 'Warqlâ', 'dz', 'Algeria');
INSERT INTO nuke_cities VALUES (128, 1, 'Aoloau', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (129, 2, 'Aua', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (130, 3, 'Faga\'alu', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (131, 4, 'Fagasa', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (132, 5, 'Fagatogo', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (133, 6, 'Faleniu', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (134, 7, 'Futiga', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (135, 8, 'Ili\'ili', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (136, 9, 'Lauli\'i', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (137, 10, 'Leone', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (138, 11, 'Malaeimi', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (139, 12, 'Mapusagafou', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (140, 13, 'Nu\'uuli', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (141, 14, 'Ofu', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (142, 15, 'Pago Pago', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (143, 16, 'Pava\'ia\'i', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (144, 17, 'Swains', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (145, 18, 'Tafuna', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (146, 19, 'Taputimu', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (147, 20, 'Utulei', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (148, 21, 'Vailoatai', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (149, 22, 'Vaitogi', 'as', 'American Samoa');
INSERT INTO nuke_cities VALUES (150, 1, 'Andorra la Vella', 'ad', 'Andorra');
INSERT INTO nuke_cities VALUES (151, 2, 'Canillo', 'ad', 'Andorra');
INSERT INTO nuke_cities VALUES (152, 3, 'Encamp', 'ad', 'Andorra');
INSERT INTO nuke_cities VALUES (153, 4, 'La Massana', 'ad', 'Andorra');
INSERT INTO nuke_cities VALUES (154, 5, 'Les Escaldes', 'ad', 'Andorra');
INSERT INTO nuke_cities VALUES (155, 6, 'Ordino', 'ad', 'Andorra');
INSERT INTO nuke_cities VALUES (156, 7, 'Sant Julià de Lòria', 'ad', 'Andorra');
INSERT INTO nuke_cities VALUES (157, 1, 'Benguela', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (158, 2, 'Caála', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (159, 3, 'Cabinda', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (160, 4, 'Caxito', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (161, 5, 'Chissamba', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (162, 6, 'Huambo', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (163, 7, 'Kuito', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (164, 8, 'Lobito', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (165, 9, 'Luanda', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (166, 10, 'Lubango', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (167, 11, 'Lucapa', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (168, 12, 'Luena', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (169, 13, 'Malanje', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (170, 14, 'M\'banza-Kongo', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (171, 15, 'Menongue', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (172, 16, 'Namibe', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (173, 17, 'N\'dalatando', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (174, 18, 'Ondjiva', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (175, 19, 'Saurimo', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (176, 20, 'Soyo', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (177, 21, 'Sumbe', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (178, 22, 'Uíge', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (179, 23, 'Waku-Kungo', 'ao', 'Angola');
INSERT INTO nuke_cities VALUES (180, 1, 'Sandy Ground', 'ai', 'Anguilla');
INSERT INTO nuke_cities VALUES (181, 2, 'The Valley', 'ai', 'Anguilla');
INSERT INTO nuke_cities VALUES (182, 1, 'Amundsen-Scott', 'aq', 'Antarctica');
INSERT INTO nuke_cities VALUES (183, 2, 'Bellingshausen', 'aq', 'Antarctica');
INSERT INTO nuke_cities VALUES (184, 3, 'Capitán Arturo Prat', 'aq', 'Antarctica');
INSERT INTO nuke_cities VALUES (185, 4, 'Casey', 'aq', 'Antarctica');
INSERT INTO nuke_cities VALUES (186, 5, 'Chang Cheng', 'aq', 'Antarctica');
INSERT INTO nuke_cities VALUES (187, 6, 'Davis', 'aq', 'Antarctica');
INSERT INTO nuke_cities VALUES (188, 7, 'Dumont d\'Urville', 'aq', 'Antarctica');
INSERT INTO nuke_cities VALUES (189, 8, 'Escudero', 'aq', 'Antarctica');
INSERT INTO nuke_cities VALUES (190, 9, 'Esperanza', 'aq', 'Antarctica');
INSERT INTO nuke_cities VALUES (191, 10, 'General Belgrano II', 'aq', 'Antarctica');
INSERT INTO nuke_cities VALUES (192, 11, 'General Bernardo O\'Higgins', 'aq', 'Antarctica');
INSERT INTO nuke_cities VALUES (193, 12, 'MacMurdo', 'aq', 'Antarctica');
INSERT INTO nuke_cities VALUES (194, 13, 'Maitri', 'aq', 'Antarctica');
INSERT INTO nuke_cities VALUES (195, 14, 'Mirnyj', 'aq', 'Antarctica');
INSERT INTO nuke_cities VALUES (196, 15, 'Molodezhnaya', 'aq', 'Antarctica');
INSERT INTO nuke_cities VALUES (197, 16, 'Novolazarovskaya', 'aq', 'Antarctica');
INSERT INTO nuke_cities VALUES (198, 17, 'Presidente Eduardo Frei Montalva', 'aq', 'Antarctica');
INSERT INTO nuke_cities VALUES (199, 18, 'Rothera', 'aq', 'Antarctica');
INSERT INTO nuke_cities VALUES (200, 19, 'Syowa', 'aq', 'Antarctica');
INSERT INTO nuke_cities VALUES (201, 20, 'Vicecomodoro Marambio', 'aq', 'Antarctica');
INSERT INTO nuke_cities VALUES (202, 1, 'All Saints', 'ag', 'Antigua & Barbuda');
INSERT INTO nuke_cities VALUES (203, 2, 'Bolands', 'ag', 'Antigua & Barbuda');
INSERT INTO nuke_cities VALUES (204, 3, 'Carlisle', 'ag', 'Antigua & Barbuda');
INSERT INTO nuke_cities VALUES (205, 4, 'Cedar Grove', 'ag', 'Antigua & Barbuda');
INSERT INTO nuke_cities VALUES (206, 5, 'Codrington', 'ag', 'Antigua & Barbuda');
INSERT INTO nuke_cities VALUES (207, 6, 'English Harbour', 'ag', 'Antigua & Barbuda');
INSERT INTO nuke_cities VALUES (208, 7, 'Falmouth', 'ag', 'Antigua & Barbuda');
INSERT INTO nuke_cities VALUES (209, 8, 'Freetown', 'ag', 'Antigua & Barbuda');
INSERT INTO nuke_cities VALUES (210, 9, 'Jennings', 'ag', 'Antigua & Barbuda');
INSERT INTO nuke_cities VALUES (211, 10, 'Liberta', 'ag', 'Antigua & Barbuda');
INSERT INTO nuke_cities VALUES (212, 11, 'Old Road', 'ag', 'Antigua & Barbuda');
INSERT INTO nuke_cities VALUES (213, 12, 'Parham', 'ag', 'Antigua & Barbuda');
INSERT INTO nuke_cities VALUES (214, 13, 'Saint John\'s', 'ag', 'Antigua & Barbuda');
INSERT INTO nuke_cities VALUES (215, 14, 'Swetes', 'ag', 'Antigua & Barbuda');
INSERT INTO nuke_cities VALUES (216, 15, 'Willikies', 'ag', 'Antigua & Barbuda');
INSERT INTO nuke_cities VALUES (217, 1, 'Bahía Blanca', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (218, 2, 'Buenos Aires', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (219, 3, 'Catamarca', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (220, 4, 'Comodoro Rivadavia', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (221, 5, 'Concordia', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (222, 6, 'Córdoba', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (223, 7, 'Corrientes', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (224, 8, 'Formosa', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (225, 9, 'Jujuy', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (226, 10, 'La Plata', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (227, 11, 'La Rioja', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (228, 12, 'Mar del Plata', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (229, 13, 'Mendoza', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (230, 14, 'Mercedes', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (231, 15, 'Neuquén', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (232, 16, 'Paraná', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (233, 17, 'Posadas', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (234, 18, 'Rawson', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (235, 19, 'Resistencia', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (236, 20, 'Río Cuarto', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (237, 21, 'Río Gallegos', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (238, 22, 'Rosario', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (239, 23, 'Salta', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (240, 24, 'San Carlos de Bariloche', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (241, 25, 'San Juan', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (242, 26, 'San Luis', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (243, 27, 'San Nicolás', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (244, 28, 'San Rafael', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (245, 29, 'Santa Fé', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (246, 30, 'Santa Rosa', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (247, 31, 'Santiago del Estero', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (248, 32, 'Tandil', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (249, 33, 'Trelew', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (250, 34, 'Tucumán', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (251, 35, 'Ushuaia', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (252, 36, 'Viedma', 'ar', 'Argentina');
INSERT INTO nuke_cities VALUES (253, 1, 'Abovyan', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (254, 2, 'Alaverdi', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (255, 3, 'Ararat', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (256, 4, 'Armavir', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (257, 5, 'Artashat', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (258, 6, 'Artik', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (259, 7, 'Ashtarak', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (260, 8, 'Charentsavan', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (261, 9, 'Dilijan', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (262, 10, 'Gavar', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (263, 11, 'Goris', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (264, 12, 'Gyumri', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (265, 13, 'Hrazdan', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (266, 14, 'Ijevan', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (267, 15, 'Kapan', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (268, 16, 'Sevan', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (269, 17, 'Stepanavan', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (270, 18, 'Vagharshapat', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (271, 19, 'Vanadzor', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (272, 20, 'Vardenis', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (273, 21, 'Yegheknadzor', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (274, 22, 'Yerevan', 'am', 'Armenia');
INSERT INTO nuke_cities VALUES (275, 1, 'Oranjestad', 'aw', 'Aruba');
INSERT INTO nuke_cities VALUES (276, 2, 'Sint Nicolas', 'aw', 'Aruba');
INSERT INTO nuke_cities VALUES (277, 1, 'Adelaide', 'au', 'Australia');
INSERT INTO nuke_cities VALUES (278, 2, 'Albury-Wodonga', 'au', 'Australia');
INSERT INTO nuke_cities VALUES (279, 3, 'Ballarat', 'au', 'Australia');
INSERT INTO nuke_cities VALUES (280, 4, 'Brisbane', 'au', 'Australia');
INSERT INTO nuke_cities VALUES (281, 5, 'Cairns', 'au', 'Australia');
INSERT INTO nuke_cities VALUES (282, 6, 'Canberra', 'au', 'Australia');
INSERT INTO nuke_cities VALUES (283, 7, 'Darwin', 'au', 'Australia');
INSERT INTO nuke_cities VALUES (284, 8, 'Geelong', 'au', 'Australia');
INSERT INTO nuke_cities VALUES (285, 9, 'Gold Coast', 'au', 'Australia');
INSERT INTO nuke_cities VALUES (286, 10, 'Hobart', 'au', 'Australia');
INSERT INTO nuke_cities VALUES (287, 11, 'Launceston', 'au', 'Australia');
INSERT INTO nuke_cities VALUES (288, 12, 'Melbourne', 'au', 'Australia');
INSERT INTO nuke_cities VALUES (289, 13, 'Newcastle', 'au', 'Australia');
INSERT INTO nuke_cities VALUES (290, 14, 'Perth', 'au', 'Australia');
INSERT INTO nuke_cities VALUES (291, 15, 'Shoalhaven', 'au', 'Australia');
INSERT INTO nuke_cities VALUES (292, 16, 'Sunshine Coast', 'au', 'Australia');
INSERT INTO nuke_cities VALUES (293, 17, 'Sydney', 'au', 'Australia');
INSERT INTO nuke_cities VALUES (294, 18, 'Toowoomba', 'au', 'Australia');
INSERT INTO nuke_cities VALUES (295, 19, 'Townsville', 'au', 'Australia');
INSERT INTO nuke_cities VALUES (296, 20, 'Wollongong', 'au', 'Australia');
INSERT INTO nuke_cities VALUES (297, 1, 'Baden', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (298, 2, 'Bregenz', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (299, 3, 'Dornbirn', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (300, 4, 'Eisenstadt', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (301, 5, 'Feldkirch', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (302, 6, 'Graz', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (303, 7, 'Innsbruck', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (304, 8, 'Klagenfurt', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (305, 9, 'Klosterneuburg', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (306, 10, 'Krems', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (307, 11, 'Leoben', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (308, 12, 'Linz', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (309, 13, 'Salzburg', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (310, 14, 'Sankt Pölten', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (311, 15, 'Steyr', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (312, 16, 'Traun', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (313, 17, 'Villach', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (314, 18, 'Wels', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (315, 19, 'Wien', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (316, 20, 'Wiener Neustadt', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (317, 21, 'Wolfsberg', 'at', 'Austria');
INSERT INTO nuke_cities VALUES (318, 1, 'Äli Bayramli', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (319, 2, 'Bakixanov', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (320, 3, 'Baku', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (321, 4, 'Bärdä', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (322, 5, 'Biläcäri', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (323, 6, 'Gäncä', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (324, 7, 'Göyçay', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (325, 8, 'Hövsan', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (326, 9, 'Imisli', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (327, 10, 'Kälbäcär', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (328, 11, 'Länkäran', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (329, 12, 'Mastaga', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (330, 13, 'Mingäçevir', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (331, 14, 'Naxçivan', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (332, 15, 'Qarasuxur', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (333, 16, 'Qazax', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (334, 17, 'Räsulzadä', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (335, 18, 'Säki', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (336, 19, 'Salyan', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (337, 20, 'Sumqayit', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (338, 21, 'Xaçmaz', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (339, 22, 'Xankändi', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (340, 23, 'Yevlax', 'az', 'Azerbaijan');
INSERT INTO nuke_cities VALUES (341, 1, 'Alice Town', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (342, 2, 'Andros Town', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (343, 3, 'Arthur\'s Town', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (344, 4, 'Clarence Town', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (345, 5, 'Cockburn Town', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (346, 6, 'Colonel Hill', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (347, 7, 'Coopers Town', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (348, 8, 'Duncan Town', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (349, 9, 'Dunmore Town', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (350, 10, 'Freeport', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (351, 11, 'Freetown', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (352, 12, 'George Town', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (353, 13, 'Great Harbour', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (354, 14, 'High Rock', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (355, 15, 'Marsh Harbour', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (356, 16, 'Matthew Town', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (357, 17, 'Nassau', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (358, 18, 'Nicholls Town', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (359, 19, 'Pirates Well', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (360, 20, 'Port Nelson', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (361, 21, 'Rock Sound', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (362, 22, 'Snug Corner', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (363, 23, 'Sweeting Cay', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (364, 24, 'West End', 'bs', 'Bahamas');
INSERT INTO nuke_cities VALUES (365, 1, '´Îsâ', 'bh', 'Bahrain');
INSERT INTO nuke_cities VALUES (366, 2, 'al-Manâmah', 'bh', 'Bahrain');
INSERT INTO nuke_cities VALUES (367, 3, 'al-Muharraq', 'bh', 'Bahrain');
INSERT INTO nuke_cities VALUES (368, 4, 'ar-Rifa´a', 'bh', 'Bahrain');
INSERT INTO nuke_cities VALUES (369, 5, 'Hidd', 'bh', 'Bahrain');
INSERT INTO nuke_cities VALUES (370, 6, 'Jidd Hafs', 'bh', 'Bahrain');
INSERT INTO nuke_cities VALUES (371, 7, 'Sitrah', 'bh', 'Bahrain');
INSERT INTO nuke_cities VALUES (372, 1, 'Bâgar Hât', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (373, 2, 'Bândarban', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (374, 3, 'Barguna', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (375, 4, 'Barîsâl', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (376, 5, 'Begamganj', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (377, 6, 'Bholâ', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (378, 7, 'Bogorâ', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (379, 8, 'Brâhman Bâriya', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (380, 9, 'Chândpûr', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (381, 10, 'Châttagâm', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (382, 11, 'Chuâdângâ', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (383, 12, 'Dhâka', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (384, 13, 'Dinâjpûr', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (385, 14, 'Farîdpûr', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (386, 15, 'Fenî', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (387, 16, 'Gâybândâ', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (388, 17, 'Gâzîpûr', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (389, 18, 'Gopâlganj', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (390, 19, 'Habîganj', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (391, 20, 'Jaipûr Hât', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (392, 21, 'Jamâlpûr', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (393, 22, 'Jessor', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (394, 23, 'Jhâlâkâtî', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (395, 24, 'Jhanaydâh', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (396, 25, 'Khagrachari', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (397, 26, 'Khulnâ', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (398, 27, 'Kishorganj', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (399, 28, 'Koks Bâzâr', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (400, 29, 'Komîllâ', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (401, 30, 'Kurîgrâm', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (402, 31, 'Kushtiyâ', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (403, 32, 'Lakshmîpûr', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (404, 33, 'Lâlmanîr Hât', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (405, 34, 'Madârîpûr', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (406, 35, 'Mâgura', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (407, 36, 'Maimansingh', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (408, 37, 'Mânikganj', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (409, 38, 'Maulvi Bâzâr', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (410, 39, 'Meherpur', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (411, 40, 'Munshiganj', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (412, 41, 'Narâl', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (413, 42, 'Nârâyanganj', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (414, 43, 'Narsingdi', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (415, 44, 'Nator', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (416, 45, 'Naugâon', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (417, 46, 'Nawâbganj', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (418, 47, 'Netrâkonâ', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (419, 48, 'Nilphâmâri', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (420, 49, 'Noâkhâli', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (421, 50, 'Pâbna', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (422, 51, 'Pâlang', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (423, 52, 'Panchagarh', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (424, 53, 'Patûâkhâlî', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (425, 54, 'Pirojpûr', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (426, 55, 'Rajbârî', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (427, 56, 'Râjshâhî', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (428, 57, 'Rângâmâtî', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (429, 58, 'Rangpûr', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (430, 59, 'Sa´idpur', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (431, 60, 'Sâtkhîrâ', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (432, 61, 'Sherpûr', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (433, 62, 'Silhat', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (434, 63, 'Sirâjganj', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (435, 64, 'Sûnâmganj', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (436, 65, 'Tangâyal', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (437, 66, 'Thâkurgâon', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (438, 67, 'Tungî', 'bd', 'Bangladesh');
INSERT INTO nuke_cities VALUES (439, 1, 'Bathsheba', 'bb', 'Barbados');
INSERT INTO nuke_cities VALUES (440, 2, 'Blackmans', 'bb', 'Barbados');
INSERT INTO nuke_cities VALUES (441, 3, 'Bridgetown', 'bb', 'Barbados');
INSERT INTO nuke_cities VALUES (442, 4, 'Bulkeley', 'bb', 'Barbados');
INSERT INTO nuke_cities VALUES (443, 5, 'Crab Hill', 'bb', 'Barbados');
INSERT INTO nuke_cities VALUES (444, 6, 'Crane', 'bb', 'Barbados');
INSERT INTO nuke_cities VALUES (445, 7, 'Greenland', 'bb', 'Barbados');
INSERT INTO nuke_cities VALUES (446, 8, 'Hillaby', 'bb', 'Barbados');
INSERT INTO nuke_cities VALUES (447, 9, 'Holetown', 'bb', 'Barbados');
INSERT INTO nuke_cities VALUES (448, 10, 'Oistins', 'bb', 'Barbados');
INSERT INTO nuke_cities VALUES (449, 11, 'Speightstown', 'bb', 'Barbados');
INSERT INTO nuke_cities VALUES (450, 1, 'Babrujsk', 'by', 'Belarus');
INSERT INTO nuke_cities VALUES (451, 2, 'Baranavichy', 'by', 'Belarus');
INSERT INTO nuke_cities VALUES (452, 3, 'Barisaw', 'by', 'Belarus');
INSERT INTO nuke_cities VALUES (453, 4, 'Brèst', 'by', 'Belarus');
INSERT INTO nuke_cities VALUES (454, 5, 'Homjel\'', 'by', 'Belarus');
INSERT INTO nuke_cities VALUES (455, 6, 'Hrodna', 'by', 'Belarus');
INSERT INTO nuke_cities VALUES (456, 7, 'Lida', 'by', 'Belarus');
INSERT INTO nuke_cities VALUES (457, 8, 'Mahiljow', 'by', 'Belarus');
INSERT INTO nuke_cities VALUES (458, 9, 'Maladzechna', 'by', 'Belarus');
INSERT INTO nuke_cities VALUES (459, 10, 'Mazyr', 'by', 'Belarus');
INSERT INTO nuke_cities VALUES (460, 11, 'Minsk', 'by', 'Belarus');
INSERT INTO nuke_cities VALUES (461, 12, 'Navapolack', 'by', 'Belarus');
INSERT INTO nuke_cities VALUES (462, 13, 'Orsha', 'by', 'Belarus');
INSERT INTO nuke_cities VALUES (463, 14, 'Pinsk', 'by', 'Belarus');
INSERT INTO nuke_cities VALUES (464, 15, 'Polack', 'by', 'Belarus');
INSERT INTO nuke_cities VALUES (465, 16, 'Rèchyca', 'by', 'Belarus');
INSERT INTO nuke_cities VALUES (466, 17, 'Salihorsk', 'by', 'Belarus');
INSERT INTO nuke_cities VALUES (467, 18, 'Svetlahorsk', 'by', 'Belarus');
INSERT INTO nuke_cities VALUES (468, 19, 'Vicebsk', 'by', 'Belarus');
INSERT INTO nuke_cities VALUES (469, 20, 'Zhlobin', 'by', 'Belarus');
INSERT INTO nuke_cities VALUES (470, 1, 'Aalst', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (471, 2, 'Antwerpen', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (472, 3, 'Arlon', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (473, 4, 'Brugge', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (474, 5, 'Brussel', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (475, 6, 'Charleroi', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (476, 7, 'Genk', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (477, 8, 'Gent', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (478, 9, 'Hasselt', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (479, 10, 'Kortrijk', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (480, 11, 'La Louvière', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (481, 12, 'Leuven', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (482, 13, 'Liège', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (483, 14, 'Mechelen', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (484, 15, 'Mons', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (485, 16, 'Namur', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (486, 17, 'Oostende', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (487, 18, 'Roeselare', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (488, 19, 'Seraing', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (489, 20, 'Sint-Niklaas', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (490, 21, 'Tournai', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (491, 22, 'Wavre', 'be', 'Belgium');
INSERT INTO nuke_cities VALUES (492, 1, 'Belize', 'bz', 'Belize');
INSERT INTO nuke_cities VALUES (493, 2, 'Belmopan', 'bz', 'Belize');
INSERT INTO nuke_cities VALUES (494, 3, 'Benque Viejo', 'bz', 'Belize');
INSERT INTO nuke_cities VALUES (495, 4, 'Corozal', 'bz', 'Belize');
INSERT INTO nuke_cities VALUES (496, 5, 'Dangriga', 'bz', 'Belize');
INSERT INTO nuke_cities VALUES (497, 6, 'Orange Walk', 'bz', 'Belize');
INSERT INTO nuke_cities VALUES (498, 7, 'Punta Gorda', 'bz', 'Belize');
INSERT INTO nuke_cities VALUES (499, 8, 'San Ignacio', 'bz', 'Belize');
INSERT INTO nuke_cities VALUES (500, 9, 'San Pedro', 'bz', 'Belize');
INSERT INTO nuke_cities VALUES (501, 1, 'Abomey', 'bj', 'Benin');
INSERT INTO nuke_cities VALUES (502, 2, 'Bohicon', 'bj', 'Benin');
INSERT INTO nuke_cities VALUES (503, 3, 'Comé', 'bj', 'Benin');
INSERT INTO nuke_cities VALUES (504, 4, 'Cotonou', 'bj', 'Benin');
INSERT INTO nuke_cities VALUES (505, 5, 'Cové', 'bj', 'Benin');
INSERT INTO nuke_cities VALUES (506, 6, 'Djougou', 'bj', 'Benin');
INSERT INTO nuke_cities VALUES (507, 7, 'Dogbo', 'bj', 'Benin');
INSERT INTO nuke_cities VALUES (508, 8, 'Kandi', 'bj', 'Benin');
INSERT INTO nuke_cities VALUES (509, 9, 'Kouandé', 'bj', 'Benin');
INSERT INTO nuke_cities VALUES (510, 10, 'Lokossa', 'bj', 'Benin');
INSERT INTO nuke_cities VALUES (511, 11, 'Malanville', 'bj', 'Benin');
INSERT INTO nuke_cities VALUES (512, 12, 'Natitingou', 'bj', 'Benin');
INSERT INTO nuke_cities VALUES (513, 13, 'Nikki', 'bj', 'Benin');
INSERT INTO nuke_cities VALUES (514, 14, 'Ouidah', 'bj', 'Benin');
INSERT INTO nuke_cities VALUES (515, 15, 'Parakou', 'bj', 'Benin');
INSERT INTO nuke_cities VALUES (516, 16, 'Pobé', 'bj', 'Benin');
INSERT INTO nuke_cities VALUES (517, 17, 'Porto Novo', 'bj', 'Benin');
INSERT INTO nuke_cities VALUES (518, 18, 'Sakété', 'bj', 'Benin');
INSERT INTO nuke_cities VALUES (519, 19, 'Savalou', 'bj', 'Benin');
INSERT INTO nuke_cities VALUES (520, 20, 'Savé', 'bj', 'Benin');
INSERT INTO nuke_cities VALUES (521, 1, 'Hamilton', 'bm', 'Bermuda');
INSERT INTO nuke_cities VALUES (522, 2, 'Saint George', 'bm', 'Bermuda');
INSERT INTO nuke_cities VALUES (523, 1, 'Chhukha', 'bt', 'Bhutan');
INSERT INTO nuke_cities VALUES (524, 2, 'Damphu', 'bt', 'Bhutan');
INSERT INTO nuke_cities VALUES (525, 3, 'Gasa', 'bt', 'Bhutan');
INSERT INTO nuke_cities VALUES (526, 4, 'Geylegphug', 'bt', 'Bhutan');
INSERT INTO nuke_cities VALUES (527, 5, 'Ha', 'bt', 'Bhutan');
INSERT INTO nuke_cities VALUES (528, 6, 'Jakar', 'bt', 'Bhutan');
INSERT INTO nuke_cities VALUES (529, 7, 'Lhuntshi', 'bt', 'Bhutan');
INSERT INTO nuke_cities VALUES (530, 8, 'Mongar', 'bt', 'Bhutan');
INSERT INTO nuke_cities VALUES (531, 9, 'Paro', 'bt', 'Bhutan');
INSERT INTO nuke_cities VALUES (532, 10, 'Pemagatsel', 'bt', 'Bhutan');
INSERT INTO nuke_cities VALUES (533, 11, 'Phuntsholing', 'bt', 'Bhutan');
INSERT INTO nuke_cities VALUES (534, 12, 'Punakha', 'bt', 'Bhutan');
INSERT INTO nuke_cities VALUES (535, 13, 'Samchi', 'bt', 'Bhutan');
INSERT INTO nuke_cities VALUES (536, 14, 'Samdrup Jongkhar', 'bt', 'Bhutan');
INSERT INTO nuke_cities VALUES (537, 15, 'Shemgang', 'bt', 'Bhutan');
INSERT INTO nuke_cities VALUES (538, 16, 'Taga Dzong', 'bt', 'Bhutan');
INSERT INTO nuke_cities VALUES (539, 17, 'Tashigang', 'bt', 'Bhutan');
INSERT INTO nuke_cities VALUES (540, 18, 'Timphu', 'bt', 'Bhutan');
INSERT INTO nuke_cities VALUES (541, 19, 'Tongsa', 'bt', 'Bhutan');
INSERT INTO nuke_cities VALUES (542, 20, 'Wangdiphodrang', 'bt', 'Bhutan');
INSERT INTO nuke_cities VALUES (543, 1, 'Bermejo', 'bo', 'Bolivia');
INSERT INTO nuke_cities VALUES (544, 2, 'Camiri', 'bo', 'Bolivia');
INSERT INTO nuke_cities VALUES (545, 3, 'Cobija', 'bo', 'Bolivia');
INSERT INTO nuke_cities VALUES (546, 4, 'Cochabamba', 'bo', 'Bolivia');
INSERT INTO nuke_cities VALUES (547, 5, 'El Alto', 'bo', 'Bolivia');
INSERT INTO nuke_cities VALUES (548, 6, 'Guayaramerín', 'bo', 'Bolivia');
INSERT INTO nuke_cities VALUES (549, 7, 'La Paz', 'bo', 'Bolivia');
INSERT INTO nuke_cities VALUES (550, 8, 'Llallagua', 'bo', 'Bolivia');
INSERT INTO nuke_cities VALUES (551, 9, 'Montero', 'bo', 'Bolivia');
INSERT INTO nuke_cities VALUES (552, 10, 'Oruro', 'bo', 'Bolivia');
INSERT INTO nuke_cities VALUES (553, 11, 'Potosí', 'bo', 'Bolivia');
INSERT INTO nuke_cities VALUES (554, 12, 'Riberalta', 'bo', 'Bolivia');
INSERT INTO nuke_cities VALUES (555, 13, 'San Ignacio', 'bo', 'Bolivia');
INSERT INTO nuke_cities VALUES (556, 14, 'Santa Cruz', 'bo', 'Bolivia');
INSERT INTO nuke_cities VALUES (557, 15, 'Sucre', 'bo', 'Bolivia');
INSERT INTO nuke_cities VALUES (558, 16, 'Tarija', 'bo', 'Bolivia');
INSERT INTO nuke_cities VALUES (559, 17, 'Trinidad', 'bo', 'Bolivia');
INSERT INTO nuke_cities VALUES (560, 18, 'Tupiza', 'bo', 'Bolivia');
INSERT INTO nuke_cities VALUES (561, 19, 'Villazón', 'bo', 'Bolivia');
INSERT INTO nuke_cities VALUES (562, 20, 'Yacuíba', 'bo', 'Bolivia');
INSERT INTO nuke_cities VALUES (563, 1, 'Banja Luka', 'ba', 'Bosnia-Herzegovina');
INSERT INTO nuke_cities VALUES (564, 2, 'Bihac', 'ba', 'Bosnia-Herzegovina');
INSERT INTO nuke_cities VALUES (565, 3, 'Bijeljina', 'ba', 'Bosnia-Herzegovina');
INSERT INTO nuke_cities VALUES (566, 4, 'Bosanska Krupa', 'ba', 'Bosnia-Herzegovina');
INSERT INTO nuke_cities VALUES (567, 5, 'Brchko', 'ba', 'Bosnia-Herzegovina');
INSERT INTO nuke_cities VALUES (568, 6, 'Bugojno', 'ba', 'Bosnia-Herzegovina');
INSERT INTO nuke_cities VALUES (569, 7, 'Cazin', 'ba', 'Bosnia-Herzegovina');
INSERT INTO nuke_cities VALUES (570, 8, 'Doboj', 'ba', 'Bosnia-Herzegovina');
INSERT INTO nuke_cities VALUES (571, 9, 'Focha', 'ba', 'Bosnia-Herzegovina');
INSERT INTO nuke_cities VALUES (572, 10, 'Gorazhde', 'ba', 'Bosnia-Herzegovina');
INSERT INTO nuke_cities VALUES (573, 11, 'Konjic', 'ba', 'Bosnia-Herzegovina');
INSERT INTO nuke_cities VALUES (574, 12, 'Mostar', 'ba', 'Bosnia-Herzegovina');
INSERT INTO nuke_cities VALUES (575, 13, 'Prijedor', 'ba', 'Bosnia-Herzegovina');
INSERT INTO nuke_cities VALUES (576, 14, 'Sarajevo', 'ba', 'Bosnia-Herzegovina');
INSERT INTO nuke_cities VALUES (577, 15, 'Travnik', 'ba', 'Bosnia-Herzegovina');
INSERT INTO nuke_cities VALUES (578, 16, 'Trebinje', 'ba', 'Bosnia-Herzegovina');
INSERT INTO nuke_cities VALUES (579, 17, 'Tuzla', 'ba', 'Bosnia-Herzegovina');
INSERT INTO nuke_cities VALUES (580, 18, 'Velika Kladusha', 'ba', 'Bosnia-Herzegovina');
INSERT INTO nuke_cities VALUES (581, 19, 'Visoko', 'ba', 'Bosnia-Herzegovina');
INSERT INTO nuke_cities VALUES (582, 20, 'Zenica', 'ba', 'Bosnia-Herzegovina');
INSERT INTO nuke_cities VALUES (583, 1, 'Bobonong', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (584, 2, 'Francistown', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (585, 3, 'Gaborone', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (586, 4, 'Ghanzi', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (587, 5, 'Gumare', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (588, 6, 'Hukuntsi', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (589, 7, 'Jwaneng', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (590, 8, 'Kanye', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (591, 9, 'Kasane', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (592, 10, 'Letlhakane', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (593, 11, 'Lobatse', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (594, 12, 'Mahalapye', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (595, 13, 'Masunga', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (596, 14, 'Maun', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (597, 15, 'Mochudi', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (598, 16, 'Mogoditshane', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (599, 17, 'Molepolole', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (600, 18, 'Moshupa', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (601, 19, 'Orapa', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (602, 20, 'Palapye', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (603, 21, 'Ramotswa', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (604, 22, 'Selibe Phikwe', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (605, 23, 'Serowe', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (606, 24, 'Shakawe', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (607, 25, 'Sowa', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (608, 26, 'Thamaga', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (609, 27, 'Tlokweng', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (610, 28, 'Tonota', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (611, 29, 'Tsabong', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (612, 30, 'Tutume', 'bw', 'Botswana');
INSERT INTO nuke_cities VALUES (613, 1, 'Águas Lindas de Goiás', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (614, 2, 'Alagoinhas', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (615, 3, 'Alvorada', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (616, 4, 'Americana', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (617, 5, 'Ananindeua', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (618, 6, 'Anápolis', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (619, 7, 'Angra dos Reis', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (620, 8, 'Aparecida de Goiânia', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (621, 9, 'Apucarana', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (622, 10, 'Aracaju', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (623, 11, 'Araçatuba', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (624, 12, 'Araguaína', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (625, 13, 'Arapiraca', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (626, 14, 'Araraquara', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (627, 15, 'Araras', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (628, 16, 'Atibaia', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (629, 17, 'Barbacena', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (630, 18, 'Barra Mansa', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (631, 19, 'Barreiras', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (632, 20, 'Barretos', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (633, 21, 'Barueri', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (634, 22, 'Bauru', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (635, 23, 'Belém', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (636, 24, 'Belford Roxo', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (637, 25, 'Belo Horizonte', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (638, 26, 'Betim', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (639, 27, 'Blumenau', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (640, 28, 'Boa Vista', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (641, 29, 'Botucatu', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (642, 30, 'Bragança Paulista', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (643, 31, 'Brasília', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (644, 32, 'Cabo de Santo Agostinho', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (645, 33, 'Cabo Frio', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (646, 34, 'Cachoeirinha', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (647, 35, 'Cachoeiro de Itapemirim', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (648, 36, 'Camaçari', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (649, 37, 'Camaragibe', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (650, 38, 'Campina Grande', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (651, 39, 'Campinas', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (652, 40, 'Campo Grande', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (653, 41, 'Campos', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (654, 42, 'Canoas', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (655, 43, 'Carapicuíba', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (656, 44, 'Cariacica', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (657, 45, 'Caruaru', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (658, 46, 'Cascavel', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (659, 47, 'Castanhal', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (660, 48, 'Catanduva', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (661, 49, 'Caucaia', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (662, 50, 'Caxias', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (663, 51, 'Caxias do Sul', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (664, 52, 'Chapecó', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (665, 53, 'Colombo', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (666, 54, 'Conselheiro Lafaiete', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (667, 55, 'Contagem', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (668, 56, 'Coronel Fabriciano', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (669, 57, 'Cotia', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (670, 58, 'Criciúma', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (671, 59, 'Cubatão', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (672, 60, 'Cuiabá', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (673, 61, 'Curitiba', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (674, 62, 'Diadema', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (675, 63, 'Divinópolis', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (676, 64, 'Dourados', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (677, 65, 'Duque de Caxias', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (678, 66, 'Embu', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (679, 67, 'Feira de Santana', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (680, 68, 'Ferraz de Vasconcelos', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (681, 69, 'Florianópolis', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (682, 70, 'Fortaleza', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (683, 71, 'Foz do Iguaçu', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (684, 72, 'Franca', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (685, 73, 'Francisco Morato', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (686, 74, 'Franco da Rocha', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (687, 75, 'Garanhuns', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (688, 76, 'Goiânia', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (689, 77, 'Governador Valadares', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (690, 78, 'Gravataí', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (691, 79, 'Guarapuava', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (692, 80, 'Guaratinguetá', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (693, 81, 'Guarujá', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (694, 82, 'Guarulhos', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (695, 83, 'Hortolândia', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (696, 84, 'Ibirité', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (697, 85, 'Ilhéus', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (698, 86, 'Imperatriz', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (699, 87, 'Indaiatuba', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (700, 88, 'Ipatinga', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (701, 89, 'Itaboraí', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (702, 90, 'Itabuna', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (703, 91, 'Itajaí', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (704, 92, 'Itapecerica da Serra', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (705, 93, 'Itapetininga', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (706, 94, 'Itapevi', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (707, 95, 'Itaquaquecetuba', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (708, 96, 'Itu', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (709, 97, 'Jaboatão', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (710, 98, 'Jacareí', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (711, 99, 'Jandira', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (712, 100, 'Jaraguá do Sul', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (713, 101, 'Jaú', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (714, 102, 'Jequié', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (715, 103, 'João Pessoa', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (716, 104, 'Joinville', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (717, 105, 'Juazeiro', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (718, 106, 'Juazeiro do Norte', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (719, 107, 'Juiz de Fora', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (720, 108, 'Jundiaí', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (721, 109, 'Lages', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (722, 110, 'Lauro de Freitas', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (723, 111, 'Limeira', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (724, 112, 'Londrina', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (725, 113, 'Luziânia', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (726, 114, 'Macaé', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (727, 115, 'Macapá', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (728, 116, 'Maceió', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (729, 117, 'Magé', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (730, 118, 'Manaus', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (731, 119, 'Marabá', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (732, 120, 'Maracanaú', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (733, 121, 'Marília', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (734, 122, 'Maringá', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (735, 123, 'Mauá', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (736, 124, 'Mogi Guaçu', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (737, 125, 'Moji das Cruzes', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (738, 126, 'Montes Claros', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (739, 127, 'Mossoró', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (740, 128, 'Natal', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (741, 129, 'Nilópolis', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (742, 130, 'Niterói', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (743, 131, 'Nossa Senhora do Socorro', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (744, 132, 'Nova Friburgo', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (745, 133, 'Nova Iguaçu', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (746, 134, 'Novo Hamburgo', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (747, 135, 'Olinda', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (748, 136, 'Osasco', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (749, 137, 'Palhoça', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (750, 138, 'Palmas', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (751, 139, 'Paranaguá', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (752, 140, 'Parnaíba', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (753, 141, 'Parnamirim', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (754, 142, 'Passo Fundo', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (755, 143, 'Patos de Minas', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (756, 144, 'Paulista', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (757, 145, 'Pelotas', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (758, 146, 'Petrolina', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (759, 147, 'Petrópolis', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (760, 148, 'Pindamonhangaba', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (761, 149, 'Pinhais', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (762, 150, 'Piracicaba', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (763, 151, 'Poá', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (764, 152, 'Poços de Caldas', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (765, 153, 'Ponta Grossa', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (766, 154, 'Porto Alegre', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (767, 155, 'Porto Velho', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (768, 156, 'Pouso Alegre', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (769, 157, 'Praia Grande', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (770, 158, 'Presidente Prudente', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (771, 159, 'Queimados', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (772, 160, 'Recife', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (773, 161, 'Resende', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (774, 162, 'Ribeirão das Neves', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (775, 163, 'Ribeirão Pires', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (776, 164, 'Ribeirão Preto', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (777, 165, 'Rio Branco', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (778, 166, 'Rio Claro', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (779, 167, 'Rio de Janeiro', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (780, 168, 'Rio Grande', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (781, 169, 'Rio Verde', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (782, 170, 'Rondonópolis', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (783, 171, 'Sabará', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (784, 172, 'Salvador', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (785, 173, 'Santa Bárbara d\'Oeste', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (786, 174, 'Santa Cruz do Sul', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (787, 175, 'Santa Luzia', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (788, 176, 'Santa Maria', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (789, 177, 'Santa Rita', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (790, 178, 'Santarém', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (791, 179, 'Santo André', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (792, 180, 'Santos', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (793, 181, 'São Bernardo do Campo', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (794, 182, 'São Caetano do Sul', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (795, 183, 'São Carlos', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (796, 184, 'São Gonçalo', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (797, 185, 'São João de Meriti', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (798, 186, 'São José', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (799, 187, 'São José do Rio Preto', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (800, 188, 'São José dos Campos', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (801, 189, 'São José dos Pinhais', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (802, 190, 'São Leopoldo', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (803, 191, 'São Luís', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (804, 192, 'São Paulo', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (805, 193, 'São Vicente', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (806, 194, 'Sapucaia', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (807, 195, 'Serra', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (808, 196, 'Sete Lagoas', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (809, 197, 'Sobral', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (810, 198, 'Sorocaba', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (811, 199, 'Sumaré', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (812, 200, 'Suzano', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (813, 201, 'Taboão da Serra', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (814, 202, 'Taubaté', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (815, 203, 'Teixeira de Freitas', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (816, 204, 'Teófilo Otoni', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (817, 205, 'Teresina', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (818, 206, 'Teresópolis', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (819, 207, 'Timon', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (820, 208, 'Uberaba', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (821, 209, 'Uberlândia', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (822, 210, 'Uruguaiana', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (823, 211, 'Valparaiso de Goiás', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (824, 212, 'Varginha', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (825, 213, 'Várzea Grande', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (826, 214, 'Várzea Paulista', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (827, 215, 'Viamão', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (828, 216, 'Vila Velha', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (829, 217, 'Vitória', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (830, 218, 'Vitória da Conquista', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (831, 219, 'Vitória de Santo Antão', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (832, 220, 'Volta Redonda', 'br', 'Brazil');
INSERT INTO nuke_cities VALUES (833, 1, 'East End-Long Look', 'vg', 'British Virgin Islands');
INSERT INTO nuke_cities VALUES (834, 2, 'Little Harbour', 'vg', 'British Virgin Islands');
INSERT INTO nuke_cities VALUES (835, 3, 'Road Town', 'vg', 'British Virgin Islands');
INSERT INTO nuke_cities VALUES (836, 4, 'Settlement', 'vg', 'British Virgin Islands');
INSERT INTO nuke_cities VALUES (837, 5, 'Spanish Town', 'vg', 'British Virgin Islands');
INSERT INTO nuke_cities VALUES (838, 6, 'West End', 'vg', 'British Virgin Islands');
INSERT INTO nuke_cities VALUES (839, 1, 'Bandar Seri Begawan', 'bn', 'Brunei');
INSERT INTO nuke_cities VALUES (840, 2, 'Bangar', 'bn', 'Brunei');
INSERT INTO nuke_cities VALUES (841, 3, 'Kuala Belait', 'bn', 'Brunei');
INSERT INTO nuke_cities VALUES (842, 4, 'Seria', 'bn', 'Brunei');
INSERT INTO nuke_cities VALUES (843, 5, 'Tutong', 'bn', 'Brunei');
INSERT INTO nuke_cities VALUES (844, 1, 'Blagoevgrad', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (845, 2, 'Burgas', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (846, 3, 'Dobrich', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (847, 4, 'Gabrovo', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (848, 5, 'Haskovo', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (849, 6, 'Jambol', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (850, 7, 'Kardzhali', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (851, 8, 'Kazanlak', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (852, 9, 'Kjustendil', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (853, 10, 'Lovech', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (854, 11, 'Montana', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (855, 12, 'Pazardzhik', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (856, 13, 'Pernik', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (857, 14, 'Pleven', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (858, 15, 'Plovdiv', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (859, 16, 'Razgrad', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (860, 17, 'Ruse', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (861, 18, 'Shumen', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (862, 19, 'Silistra', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (863, 20, 'Sliven', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (864, 21, 'Smoljan', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (865, 22, 'Sofija', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (866, 23, 'Stara Zagora', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (867, 24, 'Targovishte', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (868, 25, 'Varna', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (869, 26, 'Veliko Tarnovo', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (870, 27, 'Vidin', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (871, 28, 'Vraca', 'bg', 'Bulgaria');
INSERT INTO nuke_cities VALUES (872, 1, 'Banfora', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (873, 2, 'Batié', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (874, 3, 'Bobo Dioulasso', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (875, 4, 'Bogandé', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (876, 5, 'Boromo', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (877, 6, 'Boulsa', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (878, 7, 'Boussé', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (879, 8, 'Dano', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (880, 9, 'Dédougou', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (881, 10, 'Diapaga', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (882, 11, 'Diébougou', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (883, 12, 'Djibo', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (884, 13, 'Dori', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (885, 14, 'Fada N\'gourma', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (886, 15, 'Gaoua', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (887, 16, 'Gayéri', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (888, 17, 'Gorom-Gorom', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (889, 18, 'Gourcy', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (890, 19, 'Houndé', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (891, 20, 'Kaya', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (892, 21, 'Kombissiri', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (893, 22, 'Kongoussi', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (894, 23, 'Koudougou', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (895, 24, 'Koupéla', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (896, 25, 'Léo', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (897, 26, 'Manga', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (898, 27, 'Nouna', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (899, 28, 'Orodara', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (900, 29, 'Ouagadougou', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (901, 30, 'Ouahigouya', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (902, 31, 'Pama', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (903, 32, 'Pô', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (904, 33, 'Réo', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (905, 34, 'Sindou', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (906, 35, 'Tenkodogo', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (907, 36, 'Tougan', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (908, 37, 'Yako', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (909, 38, 'Ziniaré', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (910, 39, 'Zorgo', 'bf', 'Burkina Faso');
INSERT INTO nuke_cities VALUES (911, 1, 'Bubanza', 'bi', 'Burundi');
INSERT INTO nuke_cities VALUES (912, 2, 'Bujumbura', 'bi', 'Burundi');
INSERT INTO nuke_cities VALUES (913, 3, 'Bururi', 'bi', 'Burundi');
INSERT INTO nuke_cities VALUES (914, 4, 'Cankuzo', 'bi', 'Burundi');
INSERT INTO nuke_cities VALUES (915, 5, 'Cibitoke', 'bi', 'Burundi');
INSERT INTO nuke_cities VALUES (916, 6, 'Gitega', 'bi', 'Burundi');
INSERT INTO nuke_cities VALUES (917, 7, 'Karuzi', 'bi', 'Burundi');
INSERT INTO nuke_cities VALUES (918, 8, 'Kayanza', 'bi', 'Burundi');
INSERT INTO nuke_cities VALUES (919, 9, 'Kirundo', 'bi', 'Burundi');
INSERT INTO nuke_cities VALUES (920, 10, 'Makamba', 'bi', 'Burundi');
INSERT INTO nuke_cities VALUES (921, 11, 'Muramvya', 'bi', 'Burundi');
INSERT INTO nuke_cities VALUES (922, 12, 'Muyinga', 'bi', 'Burundi');
INSERT INTO nuke_cities VALUES (923, 13, 'Ngozi', 'bi', 'Burundi');
INSERT INTO nuke_cities VALUES (924, 14, 'Rutana', 'bi', 'Burundi');
INSERT INTO nuke_cities VALUES (925, 15, 'Ruyigi', 'bi', 'Burundi');
INSERT INTO nuke_cities VALUES (926, 1, 'Banlung', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (927, 2, 'Bat Dâmbâng', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (928, 3, 'Dong Tong', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (929, 4, 'Kâmpóng Cham', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (930, 5, 'Kâmpóng Chhnang', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (931, 6, 'Kâmpóng Spoeu', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (932, 7, 'Kâmpóng Thum', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (933, 8, 'Kâmpôt', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (934, 9, 'Krâchéh', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (935, 10, 'Krong Kaeb', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (936, 11, 'Krong Pailin', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (937, 12, 'Phnum Pénh', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (938, 13, 'Phumi Sâmraông', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (939, 14, 'Phumi Takaev', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (940, 15, 'Pousat', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (941, 16, 'Preah Sihanouk', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (942, 17, 'Prey Veaeng', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (943, 18, 'Senmonorom', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (944, 19, 'Siem Reab', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (945, 20, 'Sisophon', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (946, 21, 'Stueng Traeng', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (947, 22, 'Svay Rieng', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (948, 23, 'Ta Khmau', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (949, 24, 'Tbeng Mean Chey', 'kh', 'Cambodia');
INSERT INTO nuke_cities VALUES (950, 1, 'Bafang', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (951, 2, 'Bafoussam', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (952, 3, 'Bamenda', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (953, 4, 'Bana', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (954, 5, 'Bertoua', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (955, 6, 'Buéa', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (956, 7, 'Douala', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (957, 8, 'Ebolowa', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (958, 9, 'Edéa', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (959, 10, 'Foumban', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (960, 11, 'Garoua', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (961, 12, 'Kaélé', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (962, 13, 'Kousséri', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (963, 14, 'Kumba', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (964, 15, 'Limbe', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (965, 16, 'Loum', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (966, 17, 'Maroua', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (967, 18, 'Mokolo', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (968, 19, 'Ngaoundéré', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (969, 20, 'Nkongsamba', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (970, 21, 'Yaoundé', 'cm', 'Cameroon');
INSERT INTO nuke_cities VALUES (971, 1, 'Abbotsford', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (972, 2, 'Barrie', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (973, 3, 'Calgary', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (974, 4, 'Charlottetown', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (975, 5, 'Chicoutimi-Jonquière', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (976, 6, 'Edmonton', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (977, 7, 'Fredericton', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (978, 8, 'Guelph', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (979, 9, 'Halifax', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (980, 10, 'Hamilton', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (981, 11, 'Iqaluit', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (982, 12, 'Kelowna', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (983, 13, 'Kingston', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (984, 14, 'Kitchener', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (985, 15, 'London', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (986, 16, 'Montréal', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (987, 17, 'Oshawa', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (988, 18, 'Ottawa', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (989, 19, 'Québec', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (990, 20, 'Regina', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (991, 21, 'Saint Catharines-Niagara', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (992, 22, 'Saint John\'s', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (993, 23, 'Saskatoon', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (994, 24, 'Sherbrooke', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (995, 25, 'Sudbury', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (996, 26, 'Thunder Bay', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (997, 27, 'Toronto', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (998, 28, 'Trois-Rivières', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (999, 29, 'Vancouver', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (1000, 30, 'Victoria', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (1001, 31, 'Whitehorse', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (1002, 32, 'Windsor', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (1003, 33, 'Winnipeg', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (1004, 34, 'Yellowknife', 'ca', 'Canada');
INSERT INTO nuke_cities VALUES (1005, 1, 'Assomada', 'cv', 'Cape Verde');
INSERT INTO nuke_cities VALUES (1006, 2, 'Mindelo', 'cv', 'Cape Verde');
INSERT INTO nuke_cities VALUES (1007, 3, 'Mosteiros', 'cv', 'Cape Verde');
INSERT INTO nuke_cities VALUES (1008, 4, 'Nova Sintra', 'cv', 'Cape Verde');
INSERT INTO nuke_cities VALUES (1009, 5, 'Pedra Badejo', 'cv', 'Cape Verde');
INSERT INTO nuke_cities VALUES (1010, 6, 'Pombas', 'cv', 'Cape Verde');
INSERT INTO nuke_cities VALUES (1011, 7, 'Ponta do Sol', 'cv', 'Cape Verde');
INSERT INTO nuke_cities VALUES (1012, 8, 'Porto Novo', 'cv', 'Cape Verde');
INSERT INTO nuke_cities VALUES (1013, 9, 'Praia', 'cv', 'Cape Verde');
INSERT INTO nuke_cities VALUES (1014, 10, 'Ribeira Brava', 'cv', 'Cape Verde');
INSERT INTO nuke_cities VALUES (1015, 11, 'Sal Rei', 'cv', 'Cape Verde');
INSERT INTO nuke_cities VALUES (1016, 12, 'Santa Maria', 'cv', 'Cape Verde');
INSERT INTO nuke_cities VALUES (1017, 13, 'São Domingos', 'cv', 'Cape Verde');
INSERT INTO nuke_cities VALUES (1018, 14, 'São Filipe', 'cv', 'Cape Verde');
INSERT INTO nuke_cities VALUES (1019, 15, 'São Miguel', 'cv', 'Cape Verde');
INSERT INTO nuke_cities VALUES (1020, 16, 'Tarrafal', 'cv', 'Cape Verde');
INSERT INTO nuke_cities VALUES (1021, 17, 'Vila do Maio', 'cv', 'Cape Verde');
INSERT INTO nuke_cities VALUES (1022, 1, 'Bodden Town', 'ky', 'Cayman Islands');
INSERT INTO nuke_cities VALUES (1023, 2, 'George Town', 'ky', 'Cayman Islands');
INSERT INTO nuke_cities VALUES (1024, 3, 'West Bay', 'ky', 'Cayman Islands');
INSERT INTO nuke_cities VALUES (1025, 1, 'Bambari', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1026, 2, 'Bangassou', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1027, 3, 'Bangui', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1028, 4, 'Batangafo', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1029, 5, 'Berbérati', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1030, 6, 'Bimbo', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1031, 7, 'Birao', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1032, 8, 'Boda', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1033, 9, 'Bossangoa', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1034, 10, 'Bossembélé', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1035, 11, 'Bouar', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1036, 12, 'Bozoum', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1037, 13, 'Bria', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1038, 14, 'Carnot', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1039, 15, 'Ippy', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1040, 16, 'Kaga-Bandoro', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1041, 17, 'Mbaiki', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1042, 18, 'Mobaye', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1043, 19, 'Ndélé', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1044, 20, 'Nola', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1045, 21, 'Obo', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1046, 22, 'Paoua', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1047, 23, 'Rafaï', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1048, 24, 'Sibut', 'cf', 'Central Africa');
INSERT INTO nuke_cities VALUES (1049, 1, 'Abéché', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1050, 2, 'Am Timan', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1051, 3, 'Ati', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1052, 4, 'Biltine', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1053, 5, 'Bitkine', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1054, 6, 'Bol', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1055, 7, 'Bongor', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1056, 8, 'Doba', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1057, 9, 'Dourbali', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1058, 10, 'Faya', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1059, 11, 'Kélo', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1060, 12, 'Koumra', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1061, 13, 'Kyabé', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1062, 14, 'Laï', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1063, 15, 'Léré', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1064, 16, 'Mao', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1065, 17, 'Massaguet', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1066, 18, 'Mongo', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1067, 19, 'Moundou', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1068, 20, 'N\'Djaména', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1069, 21, 'Oum Hadjer', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1070, 22, 'Pala', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1071, 23, 'Sarh', 'td', 'Chad');
INSERT INTO nuke_cities VALUES (1072, 1, 'Antofagasta', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1073, 2, 'Arica', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1074, 3, 'Calama', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1075, 4, 'Chillán', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1076, 5, 'Coihaique', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1077, 6, 'Concepción', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1078, 7, 'Copiapó', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1079, 8, 'Coquimbo', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1080, 9, 'Curicó', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1081, 10, 'Iquique', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1082, 11, 'La Serena', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1083, 12, 'Los Ángeles', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1084, 13, 'Osorno', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1085, 14, 'Puente Alto', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1086, 15, 'Puerto Montt', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1087, 16, 'Punta Arenas', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1088, 17, 'Quilpué', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1089, 18, 'Rancagua', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1090, 19, 'San Bernardo', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1091, 20, 'Santiago', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1092, 21, 'Talca', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1093, 22, 'Talcahuano', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1094, 23, 'Temuco', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1095, 24, 'Valdivia', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1096, 25, 'Valparaíso', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1097, 26, 'Viña del Mar', 'cl', 'Chile');
INSERT INTO nuke_cities VALUES (1098, 1, 'Acheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1099, 2, 'Aksu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1100, 3, 'Anbu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1101, 4, 'Anda', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1102, 5, 'Ankang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1103, 6, 'Anqing', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1104, 7, 'Anqiu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1105, 8, 'Anshan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1106, 9, 'Anshun', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1107, 10, 'Anyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1108, 11, 'Aomen', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1109, 12, 'Badaojiang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1110, 13, 'Bagongshan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1111, 14, 'Baicheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1112, 15, 'Baiyin', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1113, 16, 'Bantou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1114, 17, 'Baoding', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1115, 18, 'Baoji', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1116, 19, 'Baoshan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1117, 20, 'Baotou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1118, 21, 'Beian', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1119, 22, 'Beibei', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1120, 23, 'Beihai', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1121, 24, 'Beijing', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1122, 25, 'Beipiao', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1123, 26, 'Bengbu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1124, 27, 'Benxi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1125, 28, 'Binzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1126, 29, 'Boli', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1127, 30, 'Boshan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1128, 31, 'Bozhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1129, 32, 'Buhe', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1130, 33, 'Cangzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1131, 34, 'Changchun', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1132, 35, 'Changde', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1133, 36, 'Changji', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1134, 37, 'Changsha', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1135, 38, 'Changzhi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1136, 39, 'Changzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1137, 40, 'Chaohu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1138, 41, 'Chaoyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1139, 42, 'Chaozhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1140, 43, 'Chengde', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1141, 44, 'Chengdu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1142, 45, 'Chenghai', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1143, 46, 'Chengzihe', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1144, 47, 'Chenzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1145, 48, 'Chifeng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1146, 49, 'Chizhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1147, 50, 'Chongqing', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1148, 51, 'Chuncheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1149, 52, 'Chuzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1150, 53, 'Daan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1151, 54, 'Daan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1152, 55, 'Dachang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1153, 56, 'Dali', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1154, 57, 'Dalian', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1155, 58, 'Daliang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1156, 59, 'Dandong', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1157, 60, 'Datong', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1158, 61, 'Dawukou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1159, 62, 'Daxian', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1160, 63, 'Dehui', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1161, 64, 'Deyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1162, 65, 'Dezhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1163, 66, 'Didao', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1164, 67, 'Dingshu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1165, 68, 'Dingzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1166, 69, 'Dongchang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1167, 70, 'Dongguan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1168, 71, 'Donghai', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1169, 72, 'Donghe', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1170, 73, 'Dongling', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1171, 74, 'Dongtai', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1172, 75, 'Dongying', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1173, 76, 'Dunhua', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1174, 77, 'Ezhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1175, 78, 'Fengcheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1176, 79, 'Foshan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1177, 80, 'Fuling', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1178, 81, 'Fushun', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1179, 82, 'Fuxin', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1180, 83, 'Fuyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1181, 84, 'Fuyu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1182, 85, 'Fuzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1183, 86, 'Gangdong', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1184, 87, 'Ganzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1185, 88, 'Gaomi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1186, 89, 'Gaozhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1187, 90, 'Gejiu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1188, 91, 'Gongzhuling', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1189, 92, 'Guangshui', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1190, 93, 'Guangyuan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1191, 94, 'Guangzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1192, 95, 'Guilin', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1193, 96, 'Guiqing', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1194, 97, 'Guiyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1195, 98, 'Haibowan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1196, 99, 'Haicheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1197, 100, 'Haikou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1198, 101, 'Hailar', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1199, 102, 'Hailun', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1200, 103, 'Hami', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1201, 104, 'Handan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1202, 105, 'Hangu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1203, 106, 'Hangzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1204, 107, 'Hanzhong', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1205, 108, 'Harbin', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1206, 109, 'Hebi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1207, 110, 'Hefei', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1208, 111, 'Hegang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1209, 112, 'Hekou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1210, 113, 'Hengshan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1211, 114, 'Hengshui', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1212, 115, 'Hengyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1213, 116, 'Heze', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1214, 117, 'Hohhot', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1215, 118, 'Honggang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1216, 119, 'Honghu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1217, 120, 'Huadian', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1218, 121, 'Huaibei', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1219, 122, 'Huaihua', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1220, 123, 'Huaiyin', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1221, 124, 'Huanggang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1222, 125, 'Huangshi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1223, 126, 'Huangyan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1224, 127, 'Huangzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1225, 128, 'Huicheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1226, 129, 'Huizhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1227, 130, 'Hulan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1228, 131, 'Hulan Ergi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1229, 132, 'Humen', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1230, 133, 'Huzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1231, 134, 'Jiagedagi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1232, 135, 'Jiamusi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1233, 136, 'Jian', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1234, 137, 'Jiangmen', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1235, 138, 'Jiangyin', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1236, 139, 'Jiangyou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1237, 140, 'Jiaohe', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1238, 141, 'Jiaozhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1239, 142, 'Jiaozuo', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1240, 143, 'Jiaxing', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1241, 144, 'Jiayuguan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1242, 145, 'Jieshi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1243, 146, 'Jieshou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1244, 147, 'Jilin', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1245, 148, 'Jinan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1246, 149, 'Jinchang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1247, 150, 'Jincheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1248, 151, 'Jinchengjiang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1249, 152, 'Jingdezhen', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1250, 153, 'Jingmen', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1251, 154, 'Jingzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1252, 155, 'Jinhua', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1253, 156, 'Jining', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1254, 157, 'Jining', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1255, 158, 'Jinma', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1256, 159, 'Jinsha', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1257, 160, 'Jinxi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1258, 161, 'Jinzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1259, 162, 'Jinzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1260, 163, 'Jishu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1261, 164, 'Jiujiang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1262, 165, 'Jiulong', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1263, 166, 'Jiupu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1264, 167, 'Jiutai', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1265, 168, 'Jixi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1266, 169, 'Kaifeng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1267, 170, 'Kaili', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1268, 171, 'Kaiyuan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1269, 172, 'Kaiyuan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1270, 173, 'Karamay', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1271, 174, 'Kashi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1272, 175, 'Korla', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1273, 176, 'Kunming', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1274, 177, 'Laiwu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1275, 178, 'Laiyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1276, 179, 'Langfang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1277, 180, 'Lanzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1278, 181, 'Laohekou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1279, 182, 'Lasa', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1280, 183, 'Leiyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1281, 184, 'Lengshuijiang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1282, 185, 'Leshan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1283, 186, 'Lianran', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1284, 187, 'Liaocheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1285, 188, 'Liaoyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1286, 189, 'Liaoyuan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1287, 190, 'Licheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1288, 191, 'Linchuan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1289, 192, 'Linfen', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1290, 193, 'Linhai', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1291, 194, 'Linhe', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1292, 195, 'Linqing', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1293, 196, 'Linshui', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1294, 197, 'Linxi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1295, 198, 'Linyi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1296, 199, 'Lishui', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1297, 200, 'Liupanshui', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1298, 201, 'Liuzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1299, 202, 'Longfeng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1300, 203, 'Longjiang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1301, 204, 'Longyan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1302, 205, 'Loudi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1303, 206, 'Luan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1304, 207, 'Luohe', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1305, 208, 'Luoyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1306, 209, 'Luzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1307, 210, 'Maanshan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1308, 211, 'Macheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1309, 212, 'Majie', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1310, 213, 'Maoming', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1311, 214, 'Meihekou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1312, 215, 'Meizhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1313, 216, 'Mentougou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1314, 217, 'Mianchang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1315, 218, 'Mianyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1316, 219, 'Mingshui', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1317, 220, 'Minhang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1318, 221, 'Mudanjiang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1319, 222, 'Nancha', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1320, 223, 'Nanchang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1321, 224, 'Nanchong', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1322, 225, 'Nanjing', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1323, 226, 'Nanning', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1324, 227, 'Nanping', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1325, 228, 'Nantong', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1326, 229, 'Nantongkuang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1327, 230, 'Nanyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1328, 231, 'Nehe', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1329, 232, 'Neijiang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1330, 233, 'Ningbo', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1331, 234, 'Nongan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1332, 235, 'Panjin', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1333, 236, 'Panzhihua', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1334, 237, 'Pingdingshan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1335, 238, 'Pingliang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1336, 239, 'Pingxiang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1337, 240, 'Pulandian', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1338, 241, 'Puqi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1339, 242, 'Puyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1340, 243, 'Qianguo', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1341, 244, 'Qianjiang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1342, 245, 'Qincheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1343, 246, 'Qingdao', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1344, 247, 'Qingyuan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1345, 248, 'Qinhuangdao', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1346, 249, 'Qiqihar', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1347, 250, 'Qitaihe', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1348, 251, 'Quanwan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1349, 252, 'Quanzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1350, 253, 'Qujing', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1351, 254, 'Ranghulu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1352, 255, 'Rizhao', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1353, 256, 'Rongcheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1354, 257, 'Rongcheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1355, 258, 'Ruian', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1356, 259, 'Saertu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1357, 260, 'Saigong', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1358, 261, 'Sanbu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1359, 262, 'Sanmenxia', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1360, 263, 'Sanming', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1361, 264, 'Shahe', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1362, 265, 'Shanghai', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1363, 266, 'Shangqiu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1364, 267, 'Shangrao', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1365, 268, 'Shantou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1366, 269, 'Shanwei', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1367, 270, 'Shaoguan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1368, 271, 'Shaowu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1369, 272, 'Shaoxing', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1370, 273, 'Shaoyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1371, 274, 'Shashi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1372, 275, 'Shatin', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1373, 276, 'Shenjiamen', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1374, 277, 'Shenyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1375, 278, 'Shenzhen', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1376, 279, 'Shihezi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1377, 280, 'Shijiazhuang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1378, 281, 'Shiqiao', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1379, 282, 'Shishou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1380, 283, 'Shiyan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1381, 284, 'Shizuishan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1382, 285, 'Shuangcheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1383, 286, 'Shuangyashan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1384, 287, 'Shuimogou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1385, 288, 'Siping', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1386, 289, 'Songjiang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1387, 290, 'Sucheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1388, 291, 'Suihua', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1389, 292, 'Suining', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1390, 293, 'Suizhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1391, 294, 'Sujiatun', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1392, 295, 'Suzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1393, 296, 'Suzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1394, 297, 'Taian', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1395, 298, 'Taicheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1396, 299, 'Taipo', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1397, 300, 'Taiyuan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1398, 301, 'Tanggu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1399, 302, 'Tangshan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1400, 303, 'Taonan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1401, 304, 'Tengzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1402, 305, 'Tiangjiaan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1403, 306, 'Tianjin', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1404, 307, 'Tianmen', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1405, 308, 'Tieli', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1406, 309, 'Tieling', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1407, 310, 'Tongchuan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1408, 311, 'Tongliao', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1409, 312, 'Tongling', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1410, 313, 'Tongren', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1411, 314, 'Tongzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1412, 315, 'Tuanmun', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1413, 316, 'Urumqi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1414, 317, 'Wafangdian', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1415, 318, 'Wanxian', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1416, 319, 'Weifang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1417, 320, 'Weihai', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1418, 321, 'Weinan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1419, 322, 'Wencheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1420, 323, 'Wenzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1421, 324, 'Wuchang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1422, 325, 'Wuda', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1423, 326, 'Wuhan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1424, 327, 'Wuhu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1425, 328, 'Wulanhaote', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1426, 329, 'Wuning', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1427, 330, 'Wuwei', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1428, 331, 'Wuxi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1429, 332, 'Wuxue', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1430, 333, 'Wuzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1431, 334, 'Xiamen', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1432, 335, 'Xian', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1433, 336, 'Xiangdong', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1434, 337, 'Xiangfan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1435, 338, 'Xianggang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1436, 339, 'Xiangtan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1437, 340, 'Xianning', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1438, 341, 'Xiantao', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1439, 342, 'Xianyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1440, 343, 'Xiaogan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1441, 344, 'Xiaolan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1442, 345, 'Xichang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1443, 346, 'Xiejiaji', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1444, 347, 'Xilinhaote', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1445, 348, 'Xinan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1446, 349, 'Xincheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1447, 350, 'Xingcheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1448, 351, 'Xingtai', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1449, 352, 'Xingyi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1450, 353, 'Xining', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1451, 354, 'Xinji', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1452, 355, 'Xinpu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1453, 356, 'Xinshi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1454, 357, 'Xintai', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1455, 358, 'Xinxiang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1456, 359, 'Xinyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1457, 360, 'Xinzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1458, 361, 'Xuanhua', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1459, 362, 'Xuanzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1460, 363, 'Xuchang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1461, 364, 'Xuzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1462, 365, 'Yaan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1463, 366, 'Yakeshi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1464, 367, 'Yanan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1465, 368, 'Yancheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1466, 369, 'Yangjiang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1467, 370, 'Yangquan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1468, 371, 'Yangzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1469, 372, 'Yanji', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1470, 373, 'Yantai', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1471, 374, 'Yibin', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1472, 375, 'Yichang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1473, 376, 'Yichun', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1474, 377, 'Yichun', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1475, 378, 'Yidu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1476, 379, 'Yinchuan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1477, 380, 'Yingcheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1478, 381, 'Yingkou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1479, 382, 'Yingzhong', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1480, 383, 'Yining', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1481, 384, 'Yiyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1482, 385, 'Yizheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1483, 386, 'Yongan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1484, 387, 'Yuanlong', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1485, 388, 'Yuci', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1486, 389, 'Yueyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1487, 390, 'Yuhong', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1488, 391, 'Yulin', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1489, 392, 'Yuncheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1490, 393, 'Yunyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1491, 394, 'Yushan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1492, 395, 'Yushan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1493, 396, 'Yushu', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1494, 397, 'Yuyao', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1495, 398, 'Zalantun', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1496, 399, 'Zaoyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1497, 400, 'Zaozhuang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1498, 401, 'Zhalainuoer', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1499, 402, 'Zhangdian', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1500, 403, 'Zhangjiakou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1501, 404, 'Zhangye', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1502, 405, 'Zhangzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1503, 406, 'Zhanjiang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1504, 407, 'Zhaocheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1505, 408, 'Zhaodong', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1506, 409, 'Zhaoqing', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1507, 410, 'Zhaotong', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1508, 411, 'Zhaoyang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1509, 412, 'Zhengzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1510, 413, 'Zhenjiang', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1511, 414, 'Zhicheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1512, 415, 'Zhongshan', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1513, 416, 'Zhoucun', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1514, 417, 'Zhoukou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1515, 418, 'Zhucheng', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1516, 419, 'Zhuhai', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1517, 420, 'Zhuji', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1518, 421, 'Zhumadian', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1519, 422, 'Zhuozhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1520, 423, 'Zhuzhou', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1521, 424, 'Zigong', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1522, 425, 'Zouxian', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1523, 426, 'Zunyi', 'cn', 'China');
INSERT INTO nuke_cities VALUES (1524, 1, 'Armenia', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1525, 2, 'Barrancabermeja', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1526, 3, 'Barranquilla', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1527, 4, 'Bello', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1528, 5, 'Bogotá', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1529, 6, 'Bucaramanga', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1530, 7, 'Buenaventura', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1531, 8, 'Buga', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1532, 9, 'Cali', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1533, 10, 'Cartagena', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1534, 11, 'Cartago', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1535, 12, 'Cúcuta', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1536, 13, 'Dos Quebradas', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1537, 14, 'Envigado', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1538, 15, 'Florencia', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1539, 16, 'Floridablanca', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1540, 17, 'Girardot', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1541, 18, 'Girón', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1542, 19, 'Ibagué', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1543, 20, 'Itagüí', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1544, 21, 'Maicao', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1545, 22, 'Manizales', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1546, 23, 'Medellín', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1547, 24, 'Montería', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1548, 25, 'Neiva', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1549, 26, 'Palmira', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1550, 27, 'Pasto', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1551, 28, 'Pereira', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1552, 29, 'Popayán', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1553, 30, 'Santa Marta', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1554, 31, 'Sincelejo', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1555, 32, 'Soacha', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1556, 33, 'Sogamoso', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1557, 34, 'Soledad', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1558, 35, 'Tuluá', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1559, 36, 'Tunja', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1560, 37, 'Valledupar', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1561, 38, 'Villavicencio', 'co', 'Colombia');
INSERT INTO nuke_cities VALUES (1562, 1, 'Domoni', 'km', 'Comoros');
INSERT INTO nuke_cities VALUES (1563, 2, 'Fomboni', 'km', 'Comoros');
INSERT INTO nuke_cities VALUES (1564, 3, 'Mitsamiouli', 'km', 'Comoros');
INSERT INTO nuke_cities VALUES (1565, 4, 'Moroni', 'km', 'Comoros');
INSERT INTO nuke_cities VALUES (1566, 5, 'Mutsamudu', 'km', 'Comoros');
INSERT INTO nuke_cities VALUES (1567, 1, 'Brazzaville', 'cg', 'Congo');
INSERT INTO nuke_cities VALUES (1568, 2, 'Djambala', 'cg', 'Congo');
INSERT INTO nuke_cities VALUES (1569, 3, 'Dongou', 'cg', 'Congo');
INSERT INTO nuke_cities VALUES (1570, 4, 'Ewo', 'cg', 'Congo');
INSERT INTO nuke_cities VALUES (1571, 5, 'Gamboma', 'cg', 'Congo');
INSERT INTO nuke_cities VALUES (1572, 6, 'Impfondo', 'cg', 'Congo');
INSERT INTO nuke_cities VALUES (1573, 7, 'Kinkala', 'cg', 'Congo');
INSERT INTO nuke_cities VALUES (1574, 8, 'Loandjili', 'cg', 'Congo');
INSERT INTO nuke_cities VALUES (1575, 9, 'Loubomo', 'cg', 'Congo');
INSERT INTO nuke_cities VALUES (1576, 10, 'Madingou', 'cg', 'Congo');
INSERT INTO nuke_cities VALUES (1577, 11, 'Makoua', 'cg', 'Congo');
INSERT INTO nuke_cities VALUES (1578, 12, 'Matsanga', 'cg', 'Congo');
INSERT INTO nuke_cities VALUES (1579, 13, 'Mossaka', 'cg', 'Congo');
INSERT INTO nuke_cities VALUES (1580, 14, 'Mossendjo', 'cg', 'Congo');
INSERT INTO nuke_cities VALUES (1581, 15, 'Ngamaba-Mfilou', 'cg', 'Congo');
INSERT INTO nuke_cities VALUES (1582, 16, 'Nkayi', 'cg', 'Congo');
INSERT INTO nuke_cities VALUES (1583, 17, 'Ouesso', 'cg', 'Congo');
INSERT INTO nuke_cities VALUES (1584, 18, 'Owando', 'cg', 'Congo');
INSERT INTO nuke_cities VALUES (1585, 19, 'Pointe Noire', 'cg', 'Congo');
INSERT INTO nuke_cities VALUES (1586, 20, 'Sibiti', 'cg', 'Congo');
INSERT INTO nuke_cities VALUES (1587, 1, 'Bandundu', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1588, 2, 'Beni', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1589, 3, 'Boma', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1590, 4, 'Bukavu', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1591, 5, 'Bunia', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1592, 6, 'Butembo', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1593, 7, 'Gemena', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1594, 8, 'Goma', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1595, 9, 'Ilebo', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1596, 10, 'Isiro', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1597, 11, 'Kalemie', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1598, 12, 'Kananga', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1599, 13, 'Kikwit', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1600, 14, 'Kindu', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1601, 15, 'Kinshasa', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1602, 16, 'Kisangani', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1603, 17, 'Kolwezi', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1604, 18, 'Likasi', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1605, 19, 'Lubumbashi', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1606, 20, 'Matadi', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1607, 21, 'Mbandaka', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1608, 22, 'Mbuji-Mayi', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1609, 23, 'Mwene-Ditu', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1610, 24, 'Tshikapa', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1611, 25, 'Uvira', 'cd', 'Congo (Dem. Rep.)');
INSERT INTO nuke_cities VALUES (1612, 1, 'Amuri', 'ck', 'Cook Islands');
INSERT INTO nuke_cities VALUES (1613, 2, 'Atiu', 'ck', 'Cook Islands');
INSERT INTO nuke_cities VALUES (1614, 3, 'Avarua', 'ck', 'Cook Islands');
INSERT INTO nuke_cities VALUES (1615, 4, 'Mangaia', 'ck', 'Cook Islands');
INSERT INTO nuke_cities VALUES (1616, 5, 'Mauke', 'ck', 'Cook Islands');
INSERT INTO nuke_cities VALUES (1617, 6, 'Mitiaro', 'ck', 'Cook Islands');
INSERT INTO nuke_cities VALUES (1618, 7, 'Nassau', 'ck', 'Cook Islands');
INSERT INTO nuke_cities VALUES (1619, 8, 'Omoka', 'ck', 'Cook Islands');
INSERT INTO nuke_cities VALUES (1620, 9, 'Rakahanga', 'ck', 'Cook Islands');
INSERT INTO nuke_cities VALUES (1621, 10, 'Roto', 'ck', 'Cook Islands');
INSERT INTO nuke_cities VALUES (1622, 11, 'Tauhunu', 'ck', 'Cook Islands');
INSERT INTO nuke_cities VALUES (1623, 1, 'Aguacaliente', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1624, 2, 'Alajuela', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1625, 3, 'Cartago', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1626, 4, 'Curridabat', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1627, 5, 'Desamparados', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1628, 6, 'Heredia', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1629, 7, 'Ipís', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1630, 8, 'Liberia', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1631, 9, 'Limón', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1632, 10, 'Paraíso', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1633, 11, 'Puntarenas', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1634, 12, 'Purral', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1635, 13, 'San Francisco', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1636, 14, 'San Isidro', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1637, 15, 'San José', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1638, 16, 'San José', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1639, 17, 'San Juan', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1640, 18, 'San Miguel', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1641, 19, 'San Pedro', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1642, 20, 'San Vicente', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1643, 21, 'Turrialba', 'cr', 'Costa Rica');
INSERT INTO nuke_cities VALUES (1644, 1, 'Bjelovar', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1645, 2, 'Chakovec', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1646, 3, 'Dhakovo', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1647, 4, 'Dubrovnik', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1648, 5, 'Gospic', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1649, 6, 'Karlovac', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1650, 7, 'Koprivnica', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1651, 8, 'Krapina', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1652, 9, 'Osijek', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1653, 10, 'Pozhega', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1654, 11, 'Pula', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1655, 12, 'Rijeka', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1656, 13, 'Sesvete', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1657, 14, 'Shibenik', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1658, 15, 'Sisak', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1659, 16, 'Slavonski Brod', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1660, 17, 'Split', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1661, 18, 'Varazhdin', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1662, 19, 'Velika Gorica', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1663, 20, 'Vinkovci', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1664, 21, 'Virovitica', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1665, 22, 'Vukovar', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1666, 23, 'Zadar', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1667, 24, 'Zagreb', 'hr', 'Croatia');
INSERT INTO nuke_cities VALUES (1668, 1, 'Bayamo', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1669, 2, 'Camagüey', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1670, 3, 'Cárdenas', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1671, 4, 'Ciego de Ávila', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1672, 5, 'Cienfuegos', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1673, 6, 'Consolación del Sur', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1674, 7, 'Contramaestre', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1675, 8, 'Guantánamo', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1676, 9, 'Holguín', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1677, 10, 'La Habana', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1678, 11, 'Las Tunas', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1679, 12, 'Manzanillo', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1680, 13, 'Matanzas', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1681, 14, 'Mayarí', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1682, 15, 'Nueva Gerona', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1683, 16, 'Palma Soriano', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1684, 17, 'Pinar del Rio', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1685, 18, 'Puerto Padre', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1686, 19, 'Sancti Spíritus', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1687, 20, 'Santa Clara', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1688, 21, 'Santiago de Cuba', 'cu', 'Cuba');
INSERT INTO nuke_cities VALUES (1689, 1, 'Aradippou', 'cy', 'Cyprus');
INSERT INTO nuke_cities VALUES (1690, 2, 'Dali', 'cy', 'Cyprus');
INSERT INTO nuke_cities VALUES (1691, 3, 'Deryneia', 'cy', 'Cyprus');
INSERT INTO nuke_cities VALUES (1692, 4, 'Dipkarpaz', 'cy', 'Cyprus');
INSERT INTO nuke_cities VALUES (1693, 5, 'Dromolaxia', 'cy', 'Cyprus');
INSERT INTO nuke_cities VALUES (1694, 6, 'Gazimagusa', 'cy', 'Cyprus');
INSERT INTO nuke_cities VALUES (1695, 7, 'Geri', 'cy', 'Cyprus');
INSERT INTO nuke_cities VALUES (1696, 8, 'Girne', 'cy', 'Cyprus');
INSERT INTO nuke_cities VALUES (1697, 9, 'Güzelyurt', 'cy', 'Cyprus');
INSERT INTO nuke_cities VALUES (1698, 10, 'Larnaka', 'cy', 'Cyprus');
INSERT INTO nuke_cities VALUES (1699, 11, 'Lefka', 'cy', 'Cyprus');
INSERT INTO nuke_cities VALUES (1700, 12, 'Lefkosa', 'cy', 'Cyprus');
INSERT INTO nuke_cities VALUES (1701, 13, 'Lefkosia', 'cy', 'Cyprus');
INSERT INTO nuke_cities VALUES (1702, 14, 'Lemesos', 'cy', 'Cyprus');
INSERT INTO nuke_cities VALUES (1703, 15, 'Livadia', 'cy', 'Cyprus');
INSERT INTO nuke_cities VALUES (1704, 16, 'Pafos', 'cy', 'Cyprus');
INSERT INTO nuke_cities VALUES (1705, 17, 'Paralimni', 'cy', 'Cyprus');
INSERT INTO nuke_cities VALUES (1706, 18, 'Tseri', 'cy', 'Cyprus');
INSERT INTO nuke_cities VALUES (1707, 19, 'Xylofagou', 'cy', 'Cyprus');
INSERT INTO nuke_cities VALUES (1708, 20, 'Ypsonas', 'cy', 'Cyprus');
INSERT INTO nuke_cities VALUES (1709, 1, 'Brno', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1710, 2, 'Cheské Budejovice', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1711, 3, 'Chomutov', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1712, 4, 'Dechín', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1713, 5, 'Frýdek-Místek', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1714, 6, 'Havírov', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1715, 7, 'Hradec Králové', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1716, 8, 'Jihlava', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1717, 9, 'Karlovy Vary', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1718, 10, 'Karviná', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1719, 11, 'Kladno', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1720, 12, 'Liberec', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1721, 13, 'Most', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1722, 14, 'Olomouc', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1723, 15, 'Opava', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1724, 16, 'Ostrava', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1725, 17, 'Pardubice', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1726, 18, 'Plzen', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1727, 19, 'Praha', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1728, 20, 'Ústí', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1729, 21, 'Zlín', 'cz', 'Czech Republic');
INSERT INTO nuke_cities VALUES (1730, 1, 'Aabenraa', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1731, 2, 'Aalborg', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1732, 3, 'Århus', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1733, 4, 'Esbjerg', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1734, 5, 'Fredericia', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1735, 6, 'Greve Strand', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1736, 7, 'Helsingør', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1737, 8, 'Hillerød', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1738, 9, 'Holstebro', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1739, 10, 'Horsens', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1740, 11, 'Hørsholm', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1741, 12, 'København', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1742, 13, 'Køge', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1743, 14, 'Kolding', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1744, 15, 'Næstved', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1745, 16, 'Nykøbing', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1746, 17, 'Odense', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1747, 18, 'Randers', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1748, 19, 'Ribe', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1749, 20, 'Ringkøbing', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1750, 21, 'Rønne', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1751, 22, 'Roskilde', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1752, 23, 'Silkeborg', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1753, 24, 'Slagelse', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1754, 25, 'Sorø', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1755, 26, 'Vejle', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1756, 27, 'Viborg', 'dk', 'Denmark');
INSERT INTO nuke_cities VALUES (1757, 1, '´Ali Sabîh', 'dj', 'Djibouti');
INSERT INTO nuke_cities VALUES (1758, 2, 'Dikhil', 'dj', 'Djibouti');
INSERT INTO nuke_cities VALUES (1759, 3, 'Jibûti', 'dj', 'Djibouti');
INSERT INTO nuke_cities VALUES (1760, 4, 'Tajûrah', 'dj', 'Djibouti');
INSERT INTO nuke_cities VALUES (1761, 5, 'Ubuk', 'dj', 'Djibouti');
INSERT INTO nuke_cities VALUES (1762, 1, 'Atkinson', 'dm', 'Dominica');
INSERT INTO nuke_cities VALUES (1763, 2, 'Barroui', 'dm', 'Dominica');
INSERT INTO nuke_cities VALUES (1764, 3, 'Berekua', 'dm', 'Dominica');
INSERT INTO nuke_cities VALUES (1765, 4, 'Castle Bruce', 'dm', 'Dominica');
INSERT INTO nuke_cities VALUES (1766, 5, 'Coulihaut', 'dm', 'Dominica');
INSERT INTO nuke_cities VALUES (1767, 6, 'Délices', 'dm', 'Dominica');
INSERT INTO nuke_cities VALUES (1768, 7, 'Hampstead', 'dm', 'Dominica');
INSERT INTO nuke_cities VALUES (1769, 8, 'La Plaine', 'dm', 'Dominica');
INSERT INTO nuke_cities VALUES (1770, 9, 'Mahaut', 'dm', 'Dominica');
INSERT INTO nuke_cities VALUES (1771, 10, 'Marigot', 'dm', 'Dominica');
INSERT INTO nuke_cities VALUES (1772, 11, 'Petite Soufrière', 'dm', 'Dominica');
INSERT INTO nuke_cities VALUES (1773, 12, 'Pointe Michel', 'dm', 'Dominica');
INSERT INTO nuke_cities VALUES (1774, 13, 'Pont Cassé', 'dm', 'Dominica');
INSERT INTO nuke_cities VALUES (1775, 14, 'Portsmouth', 'dm', 'Dominica');
INSERT INTO nuke_cities VALUES (1776, 15, 'Rosalie', 'dm', 'Dominica');
INSERT INTO nuke_cities VALUES (1777, 16, 'Roseau', 'dm', 'Dominica');
INSERT INTO nuke_cities VALUES (1778, 17, 'Saint Joseph', 'dm', 'Dominica');
INSERT INTO nuke_cities VALUES (1779, 18, 'Soufrière', 'dm', 'Dominica');
INSERT INTO nuke_cities VALUES (1780, 19, 'Vieille Case', 'dm', 'Dominica');
INSERT INTO nuke_cities VALUES (1781, 20, 'Wesley', 'dm', 'Dominica');
INSERT INTO nuke_cities VALUES (1782, 1, 'Azua', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1783, 2, 'Bajos de Haina', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1784, 3, 'Baní', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1785, 4, 'Barahona', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1786, 5, 'Bonao', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1787, 6, 'Comendador', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1788, 7, 'Cotuí', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1789, 8, 'Dajabón', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1790, 9, 'El Seybo', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1791, 10, 'Esperanza', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1792, 11, 'Hato Mayor', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1793, 12, 'Higüey', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1794, 13, 'Jimaní', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1795, 14, 'La Romana', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1796, 15, 'La Vega', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1797, 16, 'Mao', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1798, 17, 'Moca', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1799, 18, 'Monte Cristi', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1800, 19, 'Monte Plata', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1801, 20, 'Nagua', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1802, 21, 'Neyba', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1803, 22, 'Pedernales', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1804, 23, 'Puerto Plata', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1805, 24, 'Sabaneta', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1806, 25, 'Salcedo', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1807, 26, 'Samaná', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1808, 27, 'San Cristóbal', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1809, 28, 'San Francisco de Macorís', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1810, 29, 'San Juan de la Maguana', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1811, 30, 'San Pedro de Macorís', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1812, 31, 'Santiago', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1813, 32, 'Santo Domingo', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1814, 33, 'Villa Altagracia', 'do', 'Dominican Republic');
INSERT INTO nuke_cities VALUES (1815, 1, 'Aileu', 'tp', 'East Timor');
INSERT INTO nuke_cities VALUES (1816, 2, 'Ainaro', 'tp', 'East Timor');
INSERT INTO nuke_cities VALUES (1817, 3, 'Aubá', 'tp', 'East Timor');
INSERT INTO nuke_cities VALUES (1818, 4, 'Baucau', 'tp', 'East Timor');
INSERT INTO nuke_cities VALUES (1819, 5, 'Bazartete', 'tp', 'East Timor');
INSERT INTO nuke_cities VALUES (1820, 6, 'Dare', 'tp', 'East Timor');
INSERT INTO nuke_cities VALUES (1821, 7, 'Dili', 'tp', 'East Timor');
INSERT INTO nuke_cities VALUES (1822, 8, 'Ermera', 'tp', 'East Timor');
INSERT INTO nuke_cities VALUES (1823, 9, 'Lautem', 'tp', 'East Timor');
INSERT INTO nuke_cities VALUES (1824, 10, 'Liquiça', 'tp', 'East Timor');
INSERT INTO nuke_cities VALUES (1825, 11, 'Lolotoi', 'tp', 'East Timor');
INSERT INTO nuke_cities VALUES (1826, 12, 'Los Palos', 'tp', 'East Timor');
INSERT INTO nuke_cities VALUES (1827, 13, 'Maliana', 'tp', 'East Timor');
INSERT INTO nuke_cities VALUES (1828, 14, 'Manatuto', 'tp', 'East Timor');
INSERT INTO nuke_cities VALUES (1829, 15, 'Metinaro', 'tp', 'East Timor');
INSERT INTO nuke_cities VALUES (1830, 16, 'Pante Macassar', 'tp', 'East Timor');
INSERT INTO nuke_cities VALUES (1831, 17, 'Same', 'tp', 'East Timor');
INSERT INTO nuke_cities VALUES (1832, 18, 'Suai', 'tp', 'East Timor');
INSERT INTO nuke_cities VALUES (1833, 19, 'Viqueque', 'tp', 'East Timor');
INSERT INTO nuke_cities VALUES (1834, 1, 'Ambato', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1835, 2, 'Azogues', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1836, 3, 'Babahoyo', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1837, 4, 'Cuenca', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1838, 5, 'Eloy Alfaro', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1839, 6, 'Esmeraldas', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1840, 7, 'Guaranda', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1841, 8, 'Guayaquil', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1842, 9, 'Ibarra', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1843, 10, 'La Libertad', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1844, 11, 'Latacunga', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1845, 12, 'Loja', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1846, 13, 'Macas', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1847, 14, 'Machala', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1848, 15, 'Manta', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1849, 16, 'Milagro', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1850, 17, 'Nueva Loja', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1851, 18, 'Orellana', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1852, 19, 'Pasaje', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1853, 20, 'Portoviejo', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1854, 21, 'Puerto Baquerizo Moreno', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1855, 22, 'Puyo', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1856, 23, 'Quevedo', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1857, 24, 'Quito', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1858, 25, 'Riobamba', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1859, 26, 'Santo Domingo', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1860, 27, 'Tena', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1861, 28, 'Tulcán', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1862, 29, 'Zamora', 'ec', 'Ecuador');
INSERT INTO nuke_cities VALUES (1863, 1, 'al-´Arîsh', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1864, 2, 'al-Fayyûm', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1865, 3, 'al-Ghardaqah', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1866, 4, 'al-Hawâmidîyah', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1867, 5, 'al-Iskandarîyah', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1868, 6, 'al-Ismâîlîyah', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1869, 7, 'al-Jîzah', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1870, 8, 'al-Khârijah', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1871, 9, 'al-Mahallah al-Kubrâ', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1872, 10, 'al-Mansûrah', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1873, 11, 'al-Matarîyah', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1874, 12, 'al-Minyâ', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1875, 13, 'al-Qahira', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1876, 14, 'al-Uqsur', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1877, 15, 'as-Suways', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1878, 16, 'Aswân', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1879, 17, 'Asyût', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1880, 18, 'at-Tûr', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1881, 19, 'az-Zaqâzîq', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1882, 20, 'Banhâ', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1883, 21, 'Banî Suwayf', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1884, 22, 'Bilbays', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1885, 23, 'Bilqâs', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1886, 24, 'Bûr Sa´îd', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1887, 25, 'Damanhûr', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1888, 26, 'Disûq', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1889, 27, 'Dumyât', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1890, 28, 'Idfû', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1891, 29, 'Idkû', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1892, 30, 'Jirjâ', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1893, 31, 'Kafr-ad-Dawwâr', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1894, 32, 'Kafr-ash-Shaykh', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1895, 33, 'Mallawî', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1896, 34, 'Marsâ Matrûh', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1897, 35, 'Mît Gamr', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1898, 36, 'Qalyûb', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1899, 37, 'Qinâ', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1900, 38, 'Sawhâj', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1901, 39, 'Shibîn-al-Kawm', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1902, 40, 'Shubrâ al-Khaymah', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1903, 41, 'Talkhâ', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1904, 42, 'Tantâ', 'eg', 'Egypt');
INSERT INTO nuke_cities VALUES (1905, 1, 'Ahuachapán', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1906, 2, 'Antiguo Cuscatlán', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1907, 3, 'Apopa', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1908, 4, 'Chalatenango', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1909, 5, 'Cojutepeque', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1910, 6, 'Cuscatancingo', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1911, 7, 'Delgado', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1912, 8, 'Gotera', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1913, 9, 'Ilopango', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1914, 10, 'La Unión', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1915, 11, 'Mejicanos', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1916, 12, 'Nueva San Salvador', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1917, 13, 'Quezaltepeque', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1918, 14, 'San Marcos', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1919, 15, 'San Martín', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1920, 16, 'San Miguel', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1921, 17, 'San Salvador', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1922, 18, 'San Vicente', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1923, 19, 'Santa Ana', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1924, 20, 'Sensuntepeque', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1925, 21, 'Sonsonate', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1926, 22, 'Soyapango', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1927, 23, 'Usulután', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1928, 24, 'Zacatecoluca', 'sv', 'El Salvador');
INSERT INTO nuke_cities VALUES (1929, 1, 'Aconibe', 'gq', 'Equatorial Guinea');
INSERT INTO nuke_cities VALUES (1930, 2, 'Acurenam', 'gq', 'Equatorial Guinea');
INSERT INTO nuke_cities VALUES (1931, 3, 'Añisoc', 'gq', 'Equatorial Guinea');
INSERT INTO nuke_cities VALUES (1932, 4, 'Bata', 'gq', 'Equatorial Guinea');
INSERT INTO nuke_cities VALUES (1933, 5, 'Ebebiyin', 'gq', 'Equatorial Guinea');
INSERT INTO nuke_cities VALUES (1934, 6, 'Evinayong', 'gq', 'Equatorial Guinea');
INSERT INTO nuke_cities VALUES (1935, 7, 'Luba', 'gq', 'Equatorial Guinea');
INSERT INTO nuke_cities VALUES (1936, 8, 'Malabo', 'gq', 'Equatorial Guinea');
INSERT INTO nuke_cities VALUES (1937, 9, 'Mbini', 'gq', 'Equatorial Guinea');
INSERT INTO nuke_cities VALUES (1938, 10, 'Mikomeseng', 'gq', 'Equatorial Guinea');
INSERT INTO nuke_cities VALUES (1939, 11, 'Moca', 'gq', 'Equatorial Guinea');
INSERT INTO nuke_cities VALUES (1940, 12, 'Mongomo', 'gq', 'Equatorial Guinea');
INSERT INTO nuke_cities VALUES (1941, 13, 'Niefang', 'gq', 'Equatorial Guinea');
INSERT INTO nuke_cities VALUES (1942, 14, 'Nsok', 'gq', 'Equatorial Guinea');
INSERT INTO nuke_cities VALUES (1943, 15, 'Palé', 'gq', 'Equatorial Guinea');
INSERT INTO nuke_cities VALUES (1944, 16, 'Riaba', 'gq', 'Equatorial Guinea');
INSERT INTO nuke_cities VALUES (1945, 1, 'Âddî K\'eyih', 'er', 'Eritrea');
INSERT INTO nuke_cities VALUES (1946, 2, 'Âddî Kwala', 'er', 'Eritrea');
INSERT INTO nuke_cities VALUES (1947, 3, 'Âddî Ugrî', 'er', 'Eritrea');
INSERT INTO nuke_cities VALUES (1948, 4, 'Âk\'ordat', 'er', 'Eritrea');
INSERT INTO nuke_cities VALUES (1949, 5, 'Âsmara', 'er', 'Eritrea');
INSERT INTO nuke_cities VALUES (1950, 6, 'Âsseb', 'er', 'Eritrea');
INSERT INTO nuke_cities VALUES (1951, 7, 'Barentu', 'er', 'Eritrea');
INSERT INTO nuke_cities VALUES (1952, 8, 'Bêylul', 'er', 'Eritrea');
INSERT INTO nuke_cities VALUES (1953, 9, 'Dek\'emhâre', 'er', 'Eritrea');
INSERT INTO nuke_cities VALUES (1954, 10, 'Êdd', 'er', 'Eritrea');
INSERT INTO nuke_cities VALUES (1955, 11, 'Gînda', 'er', 'Eritrea');
INSERT INTO nuke_cities VALUES (1956, 12, 'Himbirtî', 'er', 'Eritrea');
INSERT INTO nuke_cities VALUES (1957, 13, 'Keren', 'er', 'Eritrea');
INSERT INTO nuke_cities VALUES (1958, 14, 'Mersa Fatma', 'er', 'Eritrea');
INSERT INTO nuke_cities VALUES (1959, 15, 'Mitsiwa', 'er', 'Eritrea');
INSERT INTO nuke_cities VALUES (1960, 16, 'Nefasît', 'er', 'Eritrea');
INSERT INTO nuke_cities VALUES (1961, 17, 'Sen\'afê', 'er', 'Eritrea');
INSERT INTO nuke_cities VALUES (1962, 18, 'Teseney', 'er', 'Eritrea');
INSERT INTO nuke_cities VALUES (1963, 1, 'Elva', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1964, 2, 'Haapsalu', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1965, 3, 'Jôgeva', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1966, 4, 'Jôhvi', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1967, 5, 'Kärdla', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1968, 6, 'Keila', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1969, 7, 'Kiviôli', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1970, 8, 'Kohtla-Järve', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1971, 9, 'Kuressaare', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1972, 10, 'Maardu', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1973, 11, 'Narva', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1974, 12, 'Paide', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1975, 13, 'Pärnu', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1976, 14, 'Pôlva', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1977, 15, 'Rakvere', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1978, 16, 'Rapla', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1979, 17, 'Sillamäe', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1980, 18, 'Tallinn', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1981, 19, 'Tapa', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1982, 20, 'Tartu', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1983, 21, 'Valga', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1984, 22, 'Viljandi', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1985, 23, 'Vôru', 'ee', 'Estonia');
INSERT INTO nuke_cities VALUES (1986, 1, 'Âddîgrat', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (1987, 2, 'Âddîs Âbebâ', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (1988, 3, 'Ârba Minch', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (1989, 4, 'Asayita', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (1990, 5, 'Âsosa', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (1991, 6, 'Âssela', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (1992, 7, 'Âwassa', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (1993, 8, 'Bahir Dar', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (1994, 9, 'Debre Birhan', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (1995, 10, 'Debre Mark\'os', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (1996, 11, 'Debre Zeyit', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (1997, 12, 'Desê', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (1998, 13, 'Dirê Dawa', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (1999, 14, 'Gambêla', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (2000, 15, 'Gondar', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (2001, 16, 'Harer', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (2002, 17, 'Jijiga', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (2003, 18, 'Jîmma', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (2004, 19, 'Kembolcha', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (2005, 20, 'Mek\'elê', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (2006, 21, 'Nazrêt', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (2007, 22, 'Nek\'emtê', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (2008, 23, 'Shashemennê', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (2009, 24, 'Soddo', 'et', 'Ethiopia');
INSERT INTO nuke_cities VALUES (2010, 1, 'Bantam', 'xa', 'Ext. Territ. of Australia');
INSERT INTO nuke_cities VALUES (2011, 2, 'The Settlement', 'xa', 'Ext. Territ. of Australia');
INSERT INTO nuke_cities VALUES (2012, 3, 'West Island', 'xa', 'Ext. Territ. of Australia');
INSERT INTO nuke_cities VALUES (2013, 4, 'Willis Island Meteorological Station', 'xa', 'Ext. Territ. of Australia');
INSERT INTO nuke_cities VALUES (2014, 1, 'Goose Green', 'fk', 'Falkland Islands');
INSERT INTO nuke_cities VALUES (2015, 2, 'Grytviken', 'fk', 'Falkland Islands');
INSERT INTO nuke_cities VALUES (2016, 3, 'Port Howard', 'fk', 'Falkland Islands');
INSERT INTO nuke_cities VALUES (2017, 4, 'Port Stanley', 'fk', 'Falkland Islands');
INSERT INTO nuke_cities VALUES (2018, 1, 'Eiði', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2019, 2, 'Fuglafjarð', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2020, 3, 'Gøta', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2021, 4, 'Húsavík', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2022, 5, 'Hvalbi', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2023, 6, 'Klaksvík', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2024, 7, 'Kollafjarð', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2025, 8, 'Kvívík', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2026, 9, 'Leirvík', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2027, 10, 'Midvágs', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2028, 11, 'Nes', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2029, 12, 'Runavík', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2030, 13, 'Sandavágs', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2031, 14, 'Sands', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2032, 15, 'Sjó', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2033, 16, 'Skála', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2034, 17, 'Sørvags', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2035, 18, 'Tórshavn', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2036, 19, 'Tvøroyri', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2037, 20, 'Vágs', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2038, 21, 'Vestmanna', 'fo', 'Faroe Islands');
INSERT INTO nuke_cities VALUES (2039, 1, 'Ba', 'fj', 'Fiji');
INSERT INTO nuke_cities VALUES (2040, 2, 'Deuba', 'fj', 'Fiji');
INSERT INTO nuke_cities VALUES (2041, 3, 'Korokade', 'fj', 'Fiji');
INSERT INTO nuke_cities VALUES (2042, 4, 'Korovou', 'fj', 'Fiji');
INSERT INTO nuke_cities VALUES (2043, 5, 'Labasa', 'fj', 'Fiji');
INSERT INTO nuke_cities VALUES (2044, 6, 'Lami', 'fj', 'Fiji');
INSERT INTO nuke_cities VALUES (2045, 7, 'Lautoka', 'fj', 'Fiji');
INSERT INTO nuke_cities VALUES (2046, 8, 'Levuka', 'fj', 'Fiji');
INSERT INTO nuke_cities VALUES (2047, 9, 'Nadi', 'fj', 'Fiji');
INSERT INTO nuke_cities VALUES (2048, 10, 'Nausori', 'fj', 'Fiji');
INSERT INTO nuke_cities VALUES (2049, 11, 'Navouvalu', 'fj', 'Fiji');
INSERT INTO nuke_cities VALUES (2050, 12, 'Navua', 'fj', 'Fiji');
INSERT INTO nuke_cities VALUES (2051, 13, 'Rakiraki', 'fj', 'Fiji');
INSERT INTO nuke_cities VALUES (2052, 14, 'Savusavu', 'fj', 'Fiji');
INSERT INTO nuke_cities VALUES (2053, 15, 'Seaqaqa', 'fj', 'Fiji');
INSERT INTO nuke_cities VALUES (2054, 16, 'Sigatoka', 'fj', 'Fiji');
INSERT INTO nuke_cities VALUES (2055, 17, 'Suva', 'fj', 'Fiji');
INSERT INTO nuke_cities VALUES (2056, 18, 'Tavua', 'fj', 'Fiji');
INSERT INTO nuke_cities VALUES (2057, 19, 'Tubou', 'fj', 'Fiji');
INSERT INTO nuke_cities VALUES (2058, 20, 'Vatukoula', 'fj', 'Fiji');
INSERT INTO nuke_cities VALUES (2059, 1, 'Espoo', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2060, 2, 'Hämeenlinna', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2061, 3, 'Helsinki', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2062, 4, 'Hyvinkää', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2063, 5, 'Järvenpää', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2064, 6, 'Joensuu', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2065, 7, 'Jyväskylä', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2066, 8, 'Kajaani', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2067, 9, 'Kokkola', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2068, 10, 'Kotka', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2069, 11, 'Kouvola', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2070, 12, 'Kuopio', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2071, 13, 'Lahti', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2072, 14, 'Lappeenranta', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2073, 15, 'Lohja', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2074, 16, 'Maarianhamina', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2075, 17, 'Mikkeli', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2076, 18, 'Nurmijärvi', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2077, 19, 'Oulu', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2078, 20, 'Pori', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2079, 21, 'Porvoo', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2080, 22, 'Rovaniemi', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2081, 23, 'Seinäjoki', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2082, 24, 'Tampere', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2083, 25, 'Turku', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2084, 26, 'Vaasa', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2085, 27, 'Vantaa', 'fi', 'Finland');
INSERT INTO nuke_cities VALUES (2086, 1, 'Agen', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2087, 2, 'Aix-en-Provence', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2088, 3, 'Ajaccio', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2089, 4, 'Albi', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2090, 5, 'Alençon', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2091, 6, 'Amiens', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2092, 7, 'Angers', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2093, 8, 'Angoulême', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2094, 9, 'Annecy', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2095, 10, 'Arras', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2096, 11, 'Auch', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2097, 12, 'Aurillac', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2098, 13, 'Auxerre', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2099, 14, 'Avignon', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2100, 15, 'Bar-le-Duc', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2101, 16, 'Bastia', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2102, 17, 'Beauvais', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2103, 18, 'Belfort', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2104, 19, 'Besançon', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2105, 20, 'Blois', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2106, 21, 'Bobigny', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2107, 22, 'Bordeaux', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2108, 23, 'Boulogne-Billancourt', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2109, 24, 'Bourg-en-Bresse', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2110, 25, 'Bourges', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2111, 26, 'Brest', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2112, 27, 'Caen', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2113, 28, 'Cahors', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2114, 29, 'Carcassonne', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2115, 30, 'Châlons-en-Champagne', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2116, 31, 'Chambéry', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2117, 32, 'Charleville-Mézières', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2118, 33, 'Chartres', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2119, 34, 'Châteauroux', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2120, 35, 'Chaumont', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2121, 36, 'Clermont-Ferrand', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2122, 37, 'Colmar', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2123, 38, 'Créteil', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2124, 39, 'Digne-les-Bains', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2125, 40, 'Dijon', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2126, 41, 'Épinal', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2127, 42, 'Évreux', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2128, 43, 'Évry', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2129, 44, 'Foix', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2130, 45, 'Gap', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2131, 46, 'Grenoble', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2132, 47, 'Guéret', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2133, 48, 'La Rochelle', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2134, 49, 'La Roche-sur-Yon', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2135, 50, 'Laon', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2136, 51, 'Laval', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2137, 52, 'Le Havre', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2138, 53, 'Le Mans', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2139, 54, 'Le Puy-en-Velay', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2140, 55, 'Lille', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2141, 56, 'Limoges', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2142, 57, 'Lons-le-Saunier', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2143, 58, 'Lyon', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2144, 59, 'Mâcon', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2145, 60, 'Marseille', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2146, 61, 'Melun', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2147, 62, 'Mende', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2148, 63, 'Metz', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2149, 64, 'Montauban', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2150, 65, 'Mont-de-Marsan', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2151, 66, 'Montpellier', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2152, 67, 'Moulins', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2153, 68, 'Mulhouse', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2154, 69, 'Nancy', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2155, 70, 'Nanterre', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2156, 71, 'Nantes', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2157, 72, 'Nevers', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2158, 73, 'Nice', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2159, 74, 'Nîmes', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2160, 75, 'Niort', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2161, 76, 'Orléans', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2162, 77, 'Paris', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2163, 78, 'Pau', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2164, 79, 'Périgueux', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2165, 80, 'Perpignan', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2166, 81, 'Poitiers', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2167, 82, 'Pontoise', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2168, 83, 'Privas', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2169, 84, 'Quimper', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2170, 85, 'Reims', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2171, 86, 'Rennes', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2172, 87, 'Rodez', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2173, 88, 'Rouen', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2174, 89, 'Saint-Brieuc', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2175, 90, 'Saint-Étienne', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2176, 91, 'Saint-Lô', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2177, 92, 'Strasbourg', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2178, 93, 'Tarbes', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2179, 94, 'Toulon', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2180, 95, 'Toulouse', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2181, 96, 'Tours', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2182, 97, 'Troyes', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2183, 98, 'Tulle', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2184, 99, 'Valence', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2185, 100, 'Vannes', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2186, 101, 'Versailles', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2187, 102, 'Vesoul', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2188, 103, 'Villeurbanne', 'fr', 'France');
INSERT INTO nuke_cities VALUES (2189, 1, 'Apatou', 'gf', 'French Guiana');
INSERT INTO nuke_cities VALUES (2190, 2, 'Awala-Yalimapo', 'gf', 'French Guiana');
INSERT INTO nuke_cities VALUES (2191, 3, 'Camopi', 'gf', 'French Guiana');
INSERT INTO nuke_cities VALUES (2192, 4, 'Cayenne', 'gf', 'French Guiana');
INSERT INTO nuke_cities VALUES (2193, 5, 'Grand-Santi', 'gf', 'French Guiana');
INSERT INTO nuke_cities VALUES (2194, 6, 'Iracoubo', 'gf', 'French Guiana');
INSERT INTO nuke_cities VALUES (2195, 7, 'Kourou', 'gf', 'French Guiana');
INSERT INTO nuke_cities VALUES (2196, 8, 'Macouria', 'gf', 'French Guiana');
INSERT INTO nuke_cities VALUES (2197, 9, 'Mana', 'gf', 'French Guiana');
INSERT INTO nuke_cities VALUES (2198, 10, 'Maripasoula', 'gf', 'French Guiana');
INSERT INTO nuke_cities VALUES (2199, 11, 'Matoury', 'gf', 'French Guiana');
INSERT INTO nuke_cities VALUES (2200, 12, 'Remire-Montjoly', 'gf', 'French Guiana');
INSERT INTO nuke_cities VALUES (2201, 13, 'Roura', 'gf', 'French Guiana');
INSERT INTO nuke_cities VALUES (2202, 14, 'Saint-Georges', 'gf', 'French Guiana');
INSERT INTO nuke_cities VALUES (2203, 15, 'Saint-Laurent-du-Maroni', 'gf', 'French Guiana');
INSERT INTO nuke_cities VALUES (2204, 16, 'Sinnamary', 'gf', 'French Guiana');
INSERT INTO nuke_cities VALUES (2205, 1, 'Afaahiti', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2206, 2, 'Afareaitu', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2207, 3, 'Arue', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2208, 4, 'Avera', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2209, 5, 'Faaa', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2210, 6, 'Haapiti', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2211, 7, 'Mahina', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2212, 8, 'Mataiea', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2213, 9, 'Mataura', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2214, 10, 'Paea', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2215, 11, 'Paopao', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2216, 12, 'Papara', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2217, 13, 'Papeari', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2218, 14, 'Papeete', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2219, 15, 'Papenoo', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2220, 16, 'Pirae', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2221, 17, 'Punaauia', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2222, 18, 'Rikitea', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2223, 19, 'Taiohae', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2224, 20, 'Tautira', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2225, 21, 'Tiarei', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2226, 22, 'Uturoa', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2227, 23, 'Vaitape', 'pf', 'French Polynesia');
INSERT INTO nuke_cities VALUES (2228, 1, 'Bitam', 'ga', 'Gabon');
INSERT INTO nuke_cities VALUES (2229, 2, 'Booué', 'ga', 'Gabon');
INSERT INTO nuke_cities VALUES (2230, 3, 'Gamba', 'ga', 'Gabon');
INSERT INTO nuke_cities VALUES (2231, 4, 'Koulamoutou', 'ga', 'Gabon');
INSERT INTO nuke_cities VALUES (2232, 5, 'Lambaréné', 'ga', 'Gabon');
INSERT INTO nuke_cities VALUES (2233, 6, 'Lastoursville', 'ga', 'Gabon');
INSERT INTO nuke_cities VALUES (2234, 7, 'Libreville', 'ga', 'Gabon');
INSERT INTO nuke_cities VALUES (2235, 8, 'Makokou', 'ga', 'Gabon');
INSERT INTO nuke_cities VALUES (2236, 9, 'Masuku', 'ga', 'Gabon');
INSERT INTO nuke_cities VALUES (2237, 10, 'Moanda', 'ga', 'Gabon');
INSERT INTO nuke_cities VALUES (2238, 11, 'Mouila', 'ga', 'Gabon');
INSERT INTO nuke_cities VALUES (2239, 12, 'Mounana', 'ga', 'Gabon');
INSERT INTO nuke_cities VALUES (2240, 13, 'Ndendé', 'ga', 'Gabon');
INSERT INTO nuke_cities VALUES (2241, 14, 'Nkan', 'ga', 'Gabon');
INSERT INTO nuke_cities VALUES (2242, 15, 'Ntoum', 'ga', 'Gabon');
INSERT INTO nuke_cities VALUES (2243, 16, 'Okandja', 'ga', 'Gabon');
INSERT INTO nuke_cities VALUES (2244, 17, 'Oyem', 'ga', 'Gabon');
INSERT INTO nuke_cities VALUES (2245, 18, 'Port-Gentil', 'ga', 'Gabon');
INSERT INTO nuke_cities VALUES (2246, 19, 'Tchibanga', 'ga', 'Gabon');
INSERT INTO nuke_cities VALUES (2247, 20, 'Tsogni', 'ga', 'Gabon');
INSERT INTO nuke_cities VALUES (2248, 1, 'Bakau', 'gm', 'Gambia');
INSERT INTO nuke_cities VALUES (2249, 2, 'Banjul', 'gm', 'Gambia');
INSERT INTO nuke_cities VALUES (2250, 3, 'Bansang', 'gm', 'Gambia');
INSERT INTO nuke_cities VALUES (2251, 4, 'Barra', 'gm', 'Gambia');
INSERT INTO nuke_cities VALUES (2252, 5, 'Basse', 'gm', 'Gambia');
INSERT INTO nuke_cities VALUES (2253, 6, 'Brikama', 'gm', 'Gambia');
INSERT INTO nuke_cities VALUES (2254, 7, 'Brufut', 'gm', 'Gambia');
INSERT INTO nuke_cities VALUES (2255, 8, 'Essau', 'gm', 'Gambia');
INSERT INTO nuke_cities VALUES (2256, 9, 'Farafenni', 'gm', 'Gambia');
INSERT INTO nuke_cities VALUES (2257, 10, 'Gambissara', 'gm', 'Gambia');
INSERT INTO nuke_cities VALUES (2258, 11, 'Gunjur', 'gm', 'Gambia');
INSERT INTO nuke_cities VALUES (2259, 12, 'Janjanbureh', 'gm', 'Gambia');
INSERT INTO nuke_cities VALUES (2260, 13, 'Kerewan', 'gm', 'Gambia');
INSERT INTO nuke_cities VALUES (2261, 14, 'Kuntaur', 'gm', 'Gambia');
INSERT INTO nuke_cities VALUES (2262, 15, 'Lamin', 'gm', 'Gambia');
INSERT INTO nuke_cities VALUES (2263, 16, 'Mansakonko', 'gm', 'Gambia');
INSERT INTO nuke_cities VALUES (2264, 17, 'Sabi', 'gm', 'Gambia');
INSERT INTO nuke_cities VALUES (2265, 18, 'Salikeni', 'gm', 'Gambia');
INSERT INTO nuke_cities VALUES (2266, 19, 'Serekunda', 'gm', 'Gambia');
INSERT INTO nuke_cities VALUES (2267, 20, 'Sukuta', 'gm', 'Gambia');
INSERT INTO nuke_cities VALUES (2268, 1, 'Ahalcihe', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2269, 2, 'Ambrolauri', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2270, 3, 'Batumi', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2271, 4, 'Chaltubo', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2272, 5, 'Chiatura', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2273, 6, 'Chinvali', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2274, 7, 'Gagra', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2275, 8, 'Gori', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2276, 9, 'Hashuri', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2277, 10, 'Kutaisi', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2278, 11, 'Marneuli', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2279, 12, 'Mcheta', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2280, 13, 'Ozurgeti', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2281, 14, 'Poti', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2282, 15, 'Rustavi', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2283, 16, 'Samtredia', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2284, 17, 'Senaki', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2285, 18, 'Suhumi', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2286, 19, 'Tbilisi', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2287, 20, 'Telavi', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2288, 21, 'Tkibuli', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2289, 22, 'Zestaponi', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2290, 23, 'Zugdidi', 'ge', 'Georgia');
INSERT INTO nuke_cities VALUES (2291, 1, 'Aachen', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2292, 2, 'Augsburg', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2293, 3, 'Bergisch Gladbach', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2294, 4, 'Berlin', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2295, 5, 'Bielefeld', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2296, 6, 'Bochum', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2297, 7, 'Bonn', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2298, 8, 'Bottrop', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2299, 9, 'Braunschweig', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2300, 10, 'Bremen', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2301, 11, 'Bremerhaven', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2302, 12, 'Chemnitz', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2303, 13, 'Cottbus', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2304, 14, 'Darmstadt', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2305, 15, 'Dortmund', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2306, 16, 'Dresden', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2307, 17, 'Duisburg', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2308, 18, 'Düsseldorf', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2309, 19, 'Erfurt', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2310, 20, 'Erlangen', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2311, 21, 'Essen', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2312, 22, 'Frankfurt', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2313, 23, 'Freiburg', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2314, 24, 'Fürth', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2315, 25, 'Gelsenkirchen', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2316, 26, 'Gera', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2317, 27, 'Göttingen', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2318, 28, 'Hagen', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2319, 29, 'Halle', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2320, 30, 'Hamburg', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2321, 31, 'Hamm', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2322, 32, 'Hannover', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2323, 33, 'Heidelberg', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2324, 34, 'Heilbronn', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2325, 35, 'Herne', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2326, 36, 'Hildesheim', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2327, 37, 'Ingolstadt', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2328, 38, 'Karlsruhe', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2329, 39, 'Kassel', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2330, 40, 'Kiel', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2331, 41, 'Koblenz', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2332, 42, 'Köln', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2333, 43, 'Krefeld', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2334, 44, 'Leipzig', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2335, 45, 'Leverkusen', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2336, 46, 'Ludwigshafen', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2337, 47, 'Lübeck', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2338, 48, 'Magdeburg', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2339, 49, 'Mainz', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2340, 50, 'Mannheim', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2341, 51, 'Moers', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2342, 52, 'Mönchengladbach', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2343, 53, 'Mülheim', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2344, 54, 'München', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2345, 55, 'Münster', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2346, 56, 'Neuss', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2347, 57, 'Nürnberg', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2348, 58, 'Oberhausen', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2349, 59, 'Offenbach', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2350, 60, 'Oldenburg', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2351, 61, 'Osnabrück', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2352, 62, 'Paderborn', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2353, 63, 'Pforzheim', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2354, 64, 'Potsdam', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2355, 65, 'Recklinghausen', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2356, 66, 'Regensburg', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2357, 67, 'Remscheid', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2358, 68, 'Reutlingen', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2359, 69, 'Rostock', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2360, 70, 'Saarbrücken', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2361, 71, 'Salzgitter', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2362, 72, 'Schwerin', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2363, 73, 'Siegen', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2364, 74, 'Solingen', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2365, 75, 'Stuttgart', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2366, 76, 'Ulm', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2367, 77, 'Wiesbaden', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2368, 78, 'Witten', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2369, 79, 'Wolfsburg', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2370, 80, 'Wuppertal', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2371, 81, 'Würzburg', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2372, 82, 'Zwickau', 'de', 'Germany');
INSERT INTO nuke_cities VALUES (2373, 1, 'Accra', 'gh', 'Ghana');
INSERT INTO nuke_cities VALUES (2374, 2, 'Ashiaman', 'gh', 'Ghana');
INSERT INTO nuke_cities VALUES (2375, 3, 'Bawku', 'gh', 'Ghana');
INSERT INTO nuke_cities VALUES (2376, 4, 'Bolgatanga', 'gh', 'Ghana');
INSERT INTO nuke_cities VALUES (2377, 5, 'Cape Coast', 'gh', 'Ghana');
INSERT INTO nuke_cities VALUES (2378, 6, 'Ho', 'gh', 'Ghana');
INSERT INTO nuke_cities VALUES (2379, 7, 'Koforidua', 'gh', 'Ghana');
INSERT INTO nuke_cities VALUES (2380, 8, 'Kumasi', 'gh', 'Ghana');
INSERT INTO nuke_cities VALUES (2381, 9, 'Nkawkaw', 'gh', 'Ghana');
INSERT INTO nuke_cities VALUES (2382, 10, 'Obuasi', 'gh', 'Ghana');
INSERT INTO nuke_cities VALUES (2383, 11, 'Sekondi', 'gh', 'Ghana');
INSERT INTO nuke_cities VALUES (2384, 12, 'Sunyani', 'gh', 'Ghana');
INSERT INTO nuke_cities VALUES (2385, 13, 'Swedru', 'gh', 'Ghana');
INSERT INTO nuke_cities VALUES (2386, 14, 'Takoradi', 'gh', 'Ghana');
INSERT INTO nuke_cities VALUES (2387, 15, 'Tamale', 'gh', 'Ghana');
INSERT INTO nuke_cities VALUES (2388, 16, 'Tema', 'gh', 'Ghana');
INSERT INTO nuke_cities VALUES (2389, 17, 'Tema New Town', 'gh', 'Ghana');
INSERT INTO nuke_cities VALUES (2390, 18, 'Teshie', 'gh', 'Ghana');
INSERT INTO nuke_cities VALUES (2391, 19, 'Wa', 'gh', 'Ghana');
INSERT INTO nuke_cities VALUES (2392, 20, 'Yendi', 'gh', 'Ghana');
INSERT INTO nuke_cities VALUES (2393, 1, 'Gibraltar', 'gi', 'Gibraltar');
INSERT INTO nuke_cities VALUES (2394, 1, 'Aharna', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2395, 2, 'Aiyáleo', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2396, 3, 'Alexandroúpoli', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2397, 4, 'Ámfissa', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2398, 5, 'Argostólion', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2399, 6, 'Árta', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2400, 7, 'Athína', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2401, 8, 'Áyios Nikólaos', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2402, 9, 'Dráma', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2403, 10, 'Édessa', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2404, 11, 'Ermoúpoli', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2405, 12, 'Flórina', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2406, 13, 'Glifáda', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2407, 14, 'Grevená', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2408, 15, 'Halándrion', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2409, 16, 'Halkída', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2410, 17, 'Haniá', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2411, 18, 'Híos', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2412, 19, 'Igoumenítsa', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2413, 20, 'Ilioúpoli', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2414, 21, 'Ioánnina', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2415, 22, 'Iráklion', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2416, 23, 'Kalamariá', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2417, 24, 'Kalámata', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2418, 25, 'Kallithéa', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2419, 26, 'Kardítsa', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2420, 27, 'Kariaí', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2421, 28, 'Karpenísi', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2422, 29, 'Kastoría', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2423, 30, 'Kateríni', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2424, 31, 'Kavála', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2425, 32, 'Keratsínion', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2426, 33, 'Kérkira', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2427, 34, 'Kilkís', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2428, 35, 'Komotiní', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2429, 36, 'Kórinthos', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2430, 37, 'Kozáni', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2431, 38, 'Lamía', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2432, 39, 'Lárisa', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2433, 40, 'Levadía', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2434, 41, 'Levkás', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2435, 42, 'Mesolóngion', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2436, 43, 'Mitilíni', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2437, 44, 'Návplion', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2438, 45, 'Néa Liósia', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2439, 46, 'Néa Smírni', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2440, 47, 'Níkaia', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2441, 48, 'Pátra', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2442, 49, 'Peristérion', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2443, 50, 'Piraeus', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2444, 51, 'Pírgos', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2445, 52, 'Políyiros', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2446, 53, 'Préveza', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2447, 54, 'Réthimnon', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2448, 55, 'Ródos', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2449, 56, 'Sámos', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2450, 57, 'Sérrai', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2451, 58, 'Spárti', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2452, 59, 'Thessaloníki', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2453, 60, 'Tríkala', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2454, 61, 'Trípoli', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2455, 62, 'Véroia', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2456, 63, 'Vólos', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2457, 64, 'Xánthi', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2458, 65, 'Zákinthos', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2459, 66, 'Zográfos', 'gr', 'Greece');
INSERT INTO nuke_cities VALUES (2460, 1, 'Aasiaat', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2461, 2, 'Alluitsup Paa', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2462, 3, 'Illoqqortoormiut', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2463, 4, 'Ilulissat', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2464, 5, 'Ivittuut', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2465, 6, 'Kangaamiut', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2466, 7, 'Kangaatsiaq', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2467, 8, 'Kangerlussuaq', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2468, 9, 'Maniitsoq', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2469, 10, 'Nanortalik', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2470, 11, 'Narsaq', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2471, 12, 'Nuuk', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2472, 13, 'Paamiut', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2473, 14, 'Pituffik', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2474, 15, 'Qaanaaq', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2475, 16, 'Qaqortoq', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2476, 17, 'Qasigiannguit', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2477, 18, 'Qeqertarsuaq', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2478, 19, 'Sisimiut', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2479, 20, 'Tasiilaq', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2480, 21, 'Upernavik', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2481, 22, 'Uummannaq', 'gl', 'Greenland');
INSERT INTO nuke_cities VALUES (2482, 1, 'Gouyave', 'gd', 'Grenada');
INSERT INTO nuke_cities VALUES (2483, 2, 'Grenville', 'gd', 'Grenada');
INSERT INTO nuke_cities VALUES (2484, 3, 'Hillsborough', 'gd', 'Grenada');
INSERT INTO nuke_cities VALUES (2485, 4, 'Saint Davids', 'gd', 'Grenada');
INSERT INTO nuke_cities VALUES (2486, 5, 'Saint George\'s', 'gd', 'Grenada');
INSERT INTO nuke_cities VALUES (2487, 6, 'Sauteurs', 'gd', 'Grenada');
INSERT INTO nuke_cities VALUES (2488, 7, 'Victoria', 'gd', 'Grenada');
INSERT INTO nuke_cities VALUES (2489, 1, 'Baie-Mahault', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2490, 2, 'Basse-Terre', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2491, 3, 'Bouillante', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2492, 4, 'Capesterre-Belle-Eau', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2493, 5, 'Gourbeyre', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2494, 6, 'Grand-Bourg', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2495, 7, 'La Désirade', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2496, 8, 'Lamentin', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2497, 9, 'Le Gosier', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2498, 10, 'Le Moule', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2499, 11, 'Les Abymes', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2500, 12, 'Marigot', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2501, 13, 'Morne-à-l\'Eau', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2502, 14, 'Petit-Bourg', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2503, 15, 'Petit-Canal', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2504, 16, 'Point-à-Pitre', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2505, 17, 'Pointe-Noire', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2506, 18, 'Saint-Barthélemy', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2507, 19, 'Saint-Claude', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2508, 20, 'Sainte-Anne', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2509, 21, 'Sainte-Rose', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2510, 22, 'Saint-François', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2511, 23, 'Terre-de-Bas', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2512, 24, 'Trois-Rivières', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2513, 25, 'Vieux-Habitants', 'gp', 'Guadeloupe');
INSERT INTO nuke_cities VALUES (2514, 1, 'Agana', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2515, 2, 'Agana Heights', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2516, 3, 'Agat', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2517, 4, 'Anderson Air Force Base', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2518, 5, 'Apra Harbor', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2519, 6, 'Astumbo', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2520, 7, 'Barrigada', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2521, 8, 'Chalan Pago', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2522, 9, 'Dededo', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2523, 10, 'Finegayan Station', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2524, 11, 'Inarajan', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2525, 12, 'Mangilao', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2526, 13, 'Marbo Annex', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2527, 14, 'Merizo', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2528, 15, 'Mongmong', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2529, 16, 'Ordot', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2530, 17, 'Santa Rita', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2531, 18, 'Sinajana', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2532, 19, 'Talofofo', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2533, 20, 'Tamuning', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2534, 21, 'Toto', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2535, 22, 'Yigo', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2536, 23, 'Yona', 'gu', 'Guam');
INSERT INTO nuke_cities VALUES (2537, 1, 'Amatitlán', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2538, 2, 'Antigua', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2539, 3, 'Atitlán', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2540, 4, 'Chimaltenango', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2541, 5, 'Chinautla', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2542, 6, 'Chiquimula', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2543, 7, 'Cobán', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2544, 8, 'Comalapa', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2545, 9, 'Cotzumalguapa', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2546, 10, 'Cuilapa', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2547, 11, 'Escuintla', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2548, 12, 'Flores', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2549, 13, 'Guastatoya', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2550, 14, 'Guatemala', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2551, 15, 'Huehuetenango', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2552, 16, 'Jalapa', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2553, 17, 'Jutiapa', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2554, 18, 'Mazatenango', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2555, 19, 'Mixco', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2556, 20, 'Puerto Barrios', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2557, 21, 'Quezaltenango', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2558, 22, 'Quiché', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2559, 23, 'Retalhuleu', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2560, 24, 'Salamá', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2561, 25, 'San Marcos', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2562, 26, 'Sololá', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2563, 27, 'Totonicapán', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2564, 28, 'Villa Nueva', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2565, 29, 'Zacapa', 'gt', 'Guatemala');
INSERT INTO nuke_cities VALUES (2566, 1, 'Castle', 'xu', 'Guernsey and Alderney');
INSERT INTO nuke_cities VALUES (2567, 2, 'Forest', 'xu', 'Guernsey and Alderney');
INSERT INTO nuke_cities VALUES (2568, 3, 'Saint Andrew', 'xu', 'Guernsey and Alderney');
INSERT INTO nuke_cities VALUES (2569, 4, 'Saint Anne\'s', 'xu', 'Guernsey and Alderney');
INSERT INTO nuke_cities VALUES (2570, 5, 'Saint Martin', 'xu', 'Guernsey and Alderney');
INSERT INTO nuke_cities VALUES (2571, 6, 'Saint Peter', 'xu', 'Guernsey and Alderney');
INSERT INTO nuke_cities VALUES (2572, 7, 'Saint Peter Port', 'xu', 'Guernsey and Alderney');
INSERT INTO nuke_cities VALUES (2573, 8, 'Saint Sampson', 'xu', 'Guernsey and Alderney');
INSERT INTO nuke_cities VALUES (2574, 9, 'Saint Saviour', 'xu', 'Guernsey and Alderney');
INSERT INTO nuke_cities VALUES (2575, 10, 'Sark', 'xu', 'Guernsey and Alderney');
INSERT INTO nuke_cities VALUES (2576, 11, 'Torteval', 'xu', 'Guernsey and Alderney');
INSERT INTO nuke_cities VALUES (2577, 12, 'Vale', 'xu', 'Guernsey and Alderney');
INSERT INTO nuke_cities VALUES (2578, 1, 'Beyla', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2579, 2, 'Boffa', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2580, 3, 'Boké', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2581, 4, 'Conakry', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2582, 5, 'Coyah', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2583, 6, 'Dabola', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2584, 7, 'Dalaba', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2585, 8, 'Dinguiraye', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2586, 9, 'Faranah', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2587, 10, 'Forécariah', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2588, 11, 'Fria', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2589, 12, 'Gaoual', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2590, 13, 'Guékédou', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2591, 14, 'Kankan', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2592, 15, 'Kérouane', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2593, 16, 'Kindia', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2594, 17, 'Kissidougou', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2595, 18, 'Koubia', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2596, 19, 'Koundara', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2597, 20, 'Kouroussa', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2598, 21, 'Labé', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2599, 22, 'Lola', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2600, 23, 'Macenta', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2601, 24, 'Mali', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2602, 25, 'Mamou', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2603, 26, 'Mandiana', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2604, 27, 'Nzérékoré', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2605, 28, 'Pita', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2606, 29, 'Siguiri', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2607, 30, 'Télimélé', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2608, 31, 'Tondon', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2609, 32, 'Tougué', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2610, 33, 'Yomou', 'gn', 'Guinea');
INSERT INTO nuke_cities VALUES (2611, 1, 'Bafatá', 'gw', 'Guinea Bissau');
INSERT INTO nuke_cities VALUES (2612, 2, 'Bissau', 'gw', 'Guinea Bissau');
INSERT INTO nuke_cities VALUES (2613, 3, 'Bissorã', 'gw', 'Guinea Bissau');
INSERT INTO nuke_cities VALUES (2614, 4, 'Bolama', 'gw', 'Guinea Bissau');
INSERT INTO nuke_cities VALUES (2615, 5, 'Buba', 'gw', 'Guinea Bissau');
INSERT INTO nuke_cities VALUES (2616, 6, 'Bubaque', 'gw', 'Guinea Bissau');
INSERT INTO nuke_cities VALUES (2617, 7, 'Cacheu', 'gw', 'Guinea Bissau');
INSERT INTO nuke_cities VALUES (2618, 8, 'Canchungo', 'gw', 'Guinea Bissau');
INSERT INTO nuke_cities VALUES (2619, 9, 'Catió', 'gw', 'Guinea Bissau');
INSERT INTO nuke_cities VALUES (2620, 10, 'Farim', 'gw', 'Guinea Bissau');
INSERT INTO nuke_cities VALUES (2621, 11, 'Fulacunda', 'gw', 'Guinea Bissau');
INSERT INTO nuke_cities VALUES (2622, 12, 'Gabú', 'gw', 'Guinea Bissau');
INSERT INTO nuke_cities VALUES (2623, 13, 'Mansôa', 'gw', 'Guinea Bissau');
INSERT INTO nuke_cities VALUES (2624, 14, 'Quebo', 'gw', 'Guinea Bissau');
INSERT INTO nuke_cities VALUES (2625, 1, 'Anna Regina', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2626, 2, 'Bartica', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2627, 3, 'Charity', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2628, 4, 'Corriverton', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2629, 5, 'Danielstown', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2630, 6, 'Fort Wellington', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2631, 7, 'Georgetown', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2632, 8, 'Kumaka', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2633, 9, 'Lethem', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2634, 10, 'Linden', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2635, 11, 'Mabaruma', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2636, 12, 'Mahaica', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2637, 13, 'Mahaicony', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2638, 14, 'Mahdia', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2639, 15, 'New Amsterdam', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2640, 16, 'Paradise', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2641, 17, 'Parika', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2642, 18, 'Pickersgill', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2643, 19, 'Queenstown', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2644, 20, 'Rosignol', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2645, 21, 'Skeldon', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2646, 22, 'Suddie', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2647, 23, 'Vreed en Hoop', 'gy', 'Guyana');
INSERT INTO nuke_cities VALUES (2648, 1, 'Cap-Haïtien', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2649, 2, 'Carrefour', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2650, 3, 'Delmas', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2651, 4, 'Desdunes', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2652, 5, 'Dessalines', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2653, 6, 'Fort-Liberté', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2654, 7, 'Gonaïves', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2655, 8, 'Hinche', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2656, 9, 'Jacmel', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2657, 10, 'Jérémie', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2658, 11, 'L\'Artibonite', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2659, 12, 'Les Cayes', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2660, 13, 'Limbe', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2661, 14, 'Ouanaminthe', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2662, 15, 'Pétionville', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2663, 16, 'Port-au-Prince', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2664, 17, 'Port-de-Paix', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2665, 18, 'Saint-Marc', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2666, 19, 'Saint-Michel-de-l\'Atalaye', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2667, 20, 'Trou-du-Nord', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2668, 21, 'Verrettes', 'ht', 'Haiti');
INSERT INTO nuke_cities VALUES (2669, 1, 'Catacamas', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2670, 2, 'Choloma', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2671, 3, 'Choluteca', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2672, 4, 'Comayagua', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2673, 5, 'Danlí', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2674, 6, 'El Paraíso', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2675, 7, 'El Progreso', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2676, 8, 'Gracias', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2677, 9, 'Juticalpa', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2678, 10, 'La Ceiba', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2679, 11, 'La Esperanza', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2680, 12, 'La Lima', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2681, 13, 'La Paz', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2682, 14, 'Nacaome', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2683, 15, 'Ocotepeque', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2684, 16, 'Olanchito', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2685, 17, 'Puerto Cortés', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2686, 18, 'Puerto Lempira', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2687, 19, 'Roatán', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2688, 20, 'San Lorenzo', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2689, 21, 'San Pedro Sula', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2690, 22, 'Santa Bárbara', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2691, 23, 'Santa Rosa de Copán', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2692, 24, 'Siguatepeque', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2693, 25, 'Tegucigalpa', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2694, 26, 'Tela', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2695, 27, 'Tocoa', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2696, 28, 'Trujillo', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2697, 29, 'Yoro', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2698, 30, 'Yuscarán', 'hn', 'Honduras');
INSERT INTO nuke_cities VALUES (2699, 1, 'Békéscsaba', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2700, 2, 'Budapest', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2701, 3, 'Debrecen', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2702, 4, 'Dunaújváros', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2703, 5, 'Eger', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2704, 6, 'Györ', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2705, 7, 'Kaposvár', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2706, 8, 'Kecskemét', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2707, 9, 'Miskolc', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2708, 10, 'Nagykanizsa', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2709, 11, 'Nyíregyháza', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2710, 12, 'Pécs', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2711, 13, 'Salgótarján', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2712, 14, 'Sopron', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2713, 15, 'Szeged', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2714, 16, 'Székesfehérvár', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2715, 17, 'Szekszárd', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2716, 18, 'Szolnok', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2717, 19, 'Szombathely', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2718, 20, 'Tatabánya', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2719, 21, 'Veszprém', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2720, 22, 'Zalaegerszeg', 'hu', 'Hungary');
INSERT INTO nuke_cities VALUES (2721, 1, 'Akranes', 'is', 'Iceland');
INSERT INTO nuke_cities VALUES (2722, 2, 'Akureyri', 'is', 'Iceland');
INSERT INTO nuke_cities VALUES (2723, 3, 'Álftanes', 'is', 'Iceland');
INSERT INTO nuke_cities VALUES (2724, 4, 'Borgarnes', 'is', 'Iceland');
INSERT INTO nuke_cities VALUES (2725, 5, 'Egilsstaðir', 'is', 'Iceland');
INSERT INTO nuke_cities VALUES (2726, 6, 'Garðabær', 'is', 'Iceland');
INSERT INTO nuke_cities VALUES (2727, 7, 'Grindavík', 'is', 'Iceland');
INSERT INTO nuke_cities VALUES (2728, 8, 'Hafnarfjörður', 'is', 'Iceland');
INSERT INTO nuke_cities VALUES (2729, 9, 'Höfn', 'is', 'Iceland');
INSERT INTO nuke_cities VALUES (2730, 10, 'Húsavík', 'is', 'Iceland');
INSERT INTO nuke_cities VALUES (2731, 11, 'Hveragerði', 'is', 'Iceland');
INSERT INTO nuke_cities VALUES (2732, 12, 'Ísafjörður', 'is', 'Iceland');
INSERT INTO nuke_cities VALUES (2733, 13, 'Keflavík', 'is', 'Iceland');
INSERT INTO nuke_cities VALUES (2734, 14, 'Kópavogur', 'is', 'Iceland');
INSERT INTO nuke_cities VALUES (2735, 15, 'Mosfellsbær', 'is', 'Iceland');
INSERT INTO nuke_cities VALUES (2736, 16, 'Reykjavík', 'is', 'Iceland');
INSERT INTO nuke_cities VALUES (2737, 17, 'Sauðárkrókur', 'is', 'Iceland');
INSERT INTO nuke_cities VALUES (2738, 18, 'Selfoss', 'is', 'Iceland');
INSERT INTO nuke_cities VALUES (2739, 19, 'Seltjarnarnes', 'is', 'Iceland');
INSERT INTO nuke_cities VALUES (2740, 20, 'Vestmannæyjar', 'is', 'Iceland');
INSERT INTO nuke_cities VALUES (2741, 1, 'Abohar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2742, 2, 'Achalpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2743, 3, 'Âdilâbâd', 'in', 'India');
INSERT INTO nuke_cities VALUES (2744, 4, 'Âdityâpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2745, 5, 'Âdoni', 'in', 'India');
INSERT INTO nuke_cities VALUES (2746, 6, 'Agartala', 'in', 'India');
INSERT INTO nuke_cities VALUES (2747, 7, 'Âgra', 'in', 'India');
INSERT INTO nuke_cities VALUES (2748, 8, 'Ahmadâbâd', 'in', 'India');
INSERT INTO nuke_cities VALUES (2749, 9, 'Ahmadnagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2750, 10, 'Âîzawl', 'in', 'India');
INSERT INTO nuke_cities VALUES (2751, 11, 'Ajmer', 'in', 'India');
INSERT INTO nuke_cities VALUES (2752, 12, 'Akola', 'in', 'India');
INSERT INTO nuke_cities VALUES (2753, 13, 'Alandur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2754, 14, 'Alappuzha', 'in', 'India');
INSERT INTO nuke_cities VALUES (2755, 15, 'Alîgarh', 'in', 'India');
INSERT INTO nuke_cities VALUES (2756, 16, 'Allahâbâd', 'in', 'India');
INSERT INTO nuke_cities VALUES (2757, 17, 'Alwal', 'in', 'India');
INSERT INTO nuke_cities VALUES (2758, 18, 'Alwar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2759, 19, 'Ambâla', 'in', 'India');
INSERT INTO nuke_cities VALUES (2760, 20, 'Ambâla Sadar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2761, 21, 'Ambarnath', 'in', 'India');
INSERT INTO nuke_cities VALUES (2762, 22, 'Ambattur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2763, 23, 'Âmbûr', 'in', 'India');
INSERT INTO nuke_cities VALUES (2764, 24, 'Amrâvati', 'in', 'India');
INSERT INTO nuke_cities VALUES (2765, 25, 'Amritsar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2766, 26, 'Amroha', 'in', 'India');
INSERT INTO nuke_cities VALUES (2767, 27, 'Ânand', 'in', 'India');
INSERT INTO nuke_cities VALUES (2768, 28, 'Anantapur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2769, 29, 'Ara', 'in', 'India');
INSERT INTO nuke_cities VALUES (2770, 30, 'Asansol', 'in', 'India');
INSERT INTO nuke_cities VALUES (2771, 31, 'Ashoknagar Kalyangarh', 'in', 'India');
INSERT INTO nuke_cities VALUES (2772, 32, 'Aurangâbâd', 'in', 'India');
INSERT INTO nuke_cities VALUES (2773, 33, 'Avadi', 'in', 'India');
INSERT INTO nuke_cities VALUES (2774, 34, 'Azamgarh', 'in', 'India');
INSERT INTO nuke_cities VALUES (2775, 35, 'Badlapur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2776, 36, 'Bahâdurgarh', 'in', 'India');
INSERT INTO nuke_cities VALUES (2777, 37, 'Baharampur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2778, 38, 'Bahraich', 'in', 'India');
INSERT INTO nuke_cities VALUES (2779, 39, 'Baidyabâti', 'in', 'India');
INSERT INTO nuke_cities VALUES (2780, 40, 'Bâleshwar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2781, 41, 'Ballia', 'in', 'India');
INSERT INTO nuke_cities VALUES (2782, 42, 'Bally', 'in', 'India');
INSERT INTO nuke_cities VALUES (2783, 43, 'Bâlurghât', 'in', 'India');
INSERT INTO nuke_cities VALUES (2784, 44, 'Bânda', 'in', 'India');
INSERT INTO nuke_cities VALUES (2785, 45, 'Bangaon', 'in', 'India');
INSERT INTO nuke_cities VALUES (2786, 46, 'Bânkura', 'in', 'India');
INSERT INTO nuke_cities VALUES (2787, 47, 'Bânsbâria', 'in', 'India');
INSERT INTO nuke_cities VALUES (2788, 48, 'Bârâkpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2789, 49, 'Baranagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2790, 50, 'Bârâsat', 'in', 'India');
INSERT INTO nuke_cities VALUES (2791, 51, 'Barddhamân', 'in', 'India');
INSERT INTO nuke_cities VALUES (2792, 52, 'Bareli', 'in', 'India');
INSERT INTO nuke_cities VALUES (2793, 53, 'Barnâla', 'in', 'India');
INSERT INTO nuke_cities VALUES (2794, 54, 'Bârsi', 'in', 'India');
INSERT INTO nuke_cities VALUES (2795, 55, 'Basîrhât', 'in', 'India');
INSERT INTO nuke_cities VALUES (2796, 56, 'Basti', 'in', 'India');
INSERT INTO nuke_cities VALUES (2797, 57, 'Batala', 'in', 'India');
INSERT INTO nuke_cities VALUES (2798, 58, 'Bathinda', 'in', 'India');
INSERT INTO nuke_cities VALUES (2799, 59, 'Beâwar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2800, 60, 'Belgaum', 'in', 'India');
INSERT INTO nuke_cities VALUES (2801, 61, 'Bellary', 'in', 'India');
INSERT INTO nuke_cities VALUES (2802, 62, 'Bengalûru', 'in', 'India');
INSERT INTO nuke_cities VALUES (2803, 63, 'Bettiah', 'in', 'India');
INSERT INTO nuke_cities VALUES (2804, 64, 'Bhadrâvati', 'in', 'India');
INSERT INTO nuke_cities VALUES (2805, 65, 'Bhadreswar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2806, 66, 'Bhâgalpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2807, 67, 'Bhalswa Jahangirpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2808, 68, 'Bharatpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2809, 69, 'Bharûch', 'in', 'India');
INSERT INTO nuke_cities VALUES (2810, 70, 'Bhâtpâra', 'in', 'India');
INSERT INTO nuke_cities VALUES (2811, 71, 'Bhâvnagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2812, 72, 'Bhilai', 'in', 'India');
INSERT INTO nuke_cities VALUES (2813, 73, 'Bhîlwâra', 'in', 'India');
INSERT INTO nuke_cities VALUES (2814, 74, 'Bhîmavaram', 'in', 'India');
INSERT INTO nuke_cities VALUES (2815, 75, 'Bhind', 'in', 'India');
INSERT INTO nuke_cities VALUES (2816, 76, 'Bhiwandi', 'in', 'India');
INSERT INTO nuke_cities VALUES (2817, 77, 'Bhiwâni', 'in', 'India');
INSERT INTO nuke_cities VALUES (2818, 78, 'Bhopâl', 'in', 'India');
INSERT INTO nuke_cities VALUES (2819, 79, 'Bhubaneswar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2820, 80, 'Bhuj', 'in', 'India');
INSERT INTO nuke_cities VALUES (2821, 81, 'Bhusâwal', 'in', 'India');
INSERT INTO nuke_cities VALUES (2822, 82, 'Bîd', 'in', 'India');
INSERT INTO nuke_cities VALUES (2823, 83, 'Bîdar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2824, 84, 'Bidhannagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2825, 85, 'Bihâr', 'in', 'India');
INSERT INTO nuke_cities VALUES (2826, 86, 'Bijâpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2827, 87, 'Bîkâner', 'in', 'India');
INSERT INTO nuke_cities VALUES (2828, 88, 'Bilâspur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2829, 89, 'Bokâro', 'in', 'India');
INSERT INTO nuke_cities VALUES (2830, 90, 'Bommanahalli', 'in', 'India');
INSERT INTO nuke_cities VALUES (2831, 91, 'Botâd', 'in', 'India');
INSERT INTO nuke_cities VALUES (2832, 92, 'Brahmapur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2833, 93, 'Budaun', 'in', 'India');
INSERT INTO nuke_cities VALUES (2834, 94, 'Bulandshahr', 'in', 'India');
INSERT INTO nuke_cities VALUES (2835, 95, 'Burhânpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2836, 96, 'Byatarayanapura', 'in', 'India');
INSERT INTO nuke_cities VALUES (2837, 97, 'Champdâni', 'in', 'India');
INSERT INTO nuke_cities VALUES (2838, 98, 'Chandannagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2839, 99, 'Chandausi', 'in', 'India');
INSERT INTO nuke_cities VALUES (2840, 100, 'Chandîgarh', 'in', 'India');
INSERT INTO nuke_cities VALUES (2841, 101, 'Chandrapur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2842, 102, 'Châs', 'in', 'India');
INSERT INTO nuke_cities VALUES (2843, 103, 'Chennai', 'in', 'India');
INSERT INTO nuke_cities VALUES (2844, 104, 'Chhâpra', 'in', 'India');
INSERT INTO nuke_cities VALUES (2845, 105, 'Chhatarpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2846, 106, 'Chhindwâra', 'in', 'India');
INSERT INTO nuke_cities VALUES (2847, 107, 'Chikmagalûr', 'in', 'India');
INSERT INTO nuke_cities VALUES (2848, 108, 'Chitradurga', 'in', 'India');
INSERT INTO nuke_cities VALUES (2849, 109, 'Chittur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2850, 110, 'Chûru', 'in', 'India');
INSERT INTO nuke_cities VALUES (2851, 111, 'Cuddapah', 'in', 'India');
INSERT INTO nuke_cities VALUES (2852, 112, 'Dallo Pura', 'in', 'India');
INSERT INTO nuke_cities VALUES (2853, 113, 'Damân', 'in', 'India');
INSERT INTO nuke_cities VALUES (2854, 114, 'Damoh', 'in', 'India');
INSERT INTO nuke_cities VALUES (2855, 115, 'Darbhanga', 'in', 'India');
INSERT INTO nuke_cities VALUES (2856, 116, 'Dârjiling', 'in', 'India');
INSERT INTO nuke_cities VALUES (2857, 117, 'Dasarahalli', 'in', 'India');
INSERT INTO nuke_cities VALUES (2858, 118, 'Davanagere', 'in', 'India');
INSERT INTO nuke_cities VALUES (2859, 119, 'Dehra Dûn', 'in', 'India');
INSERT INTO nuke_cities VALUES (2860, 120, 'Dehri', 'in', 'India');
INSERT INTO nuke_cities VALUES (2861, 121, 'Deoli', 'in', 'India');
INSERT INTO nuke_cities VALUES (2862, 122, 'Deoria', 'in', 'India');
INSERT INTO nuke_cities VALUES (2863, 123, 'Devghar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2864, 124, 'Dewâs', 'in', 'India');
INSERT INTO nuke_cities VALUES (2865, 125, 'Dhanbad', 'in', 'India');
INSERT INTO nuke_cities VALUES (2866, 126, 'Dharmavaram', 'in', 'India');
INSERT INTO nuke_cities VALUES (2867, 127, 'Dhule', 'in', 'India');
INSERT INTO nuke_cities VALUES (2868, 128, 'Dibrugarh', 'in', 'India');
INSERT INTO nuke_cities VALUES (2869, 129, 'Dilli', 'in', 'India');
INSERT INTO nuke_cities VALUES (2870, 130, 'Dilli Cantonment', 'in', 'India');
INSERT INTO nuke_cities VALUES (2871, 131, 'Dimâpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2872, 132, 'Dinapur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2873, 133, 'Dindigul', 'in', 'India');
INSERT INTO nuke_cities VALUES (2874, 134, 'Dispur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2875, 135, 'Dum Dum', 'in', 'India');
INSERT INTO nuke_cities VALUES (2876, 136, 'Durg', 'in', 'India');
INSERT INTO nuke_cities VALUES (2877, 137, 'Durgâpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2878, 138, 'Elûru', 'in', 'India');
INSERT INTO nuke_cities VALUES (2879, 139, 'Erode', 'in', 'India');
INSERT INTO nuke_cities VALUES (2880, 140, 'Etah', 'in', 'India');
INSERT INTO nuke_cities VALUES (2881, 141, 'Etâwah', 'in', 'India');
INSERT INTO nuke_cities VALUES (2882, 142, 'Faizâbâd', 'in', 'India');
INSERT INTO nuke_cities VALUES (2883, 143, 'Farîdâbad', 'in', 'India');
INSERT INTO nuke_cities VALUES (2884, 144, 'Farrukhâbâd', 'in', 'India');
INSERT INTO nuke_cities VALUES (2885, 145, 'Fatehpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2886, 146, 'Fîrozâbâd', 'in', 'India');
INSERT INTO nuke_cities VALUES (2887, 147, 'Gadag', 'in', 'India');
INSERT INTO nuke_cities VALUES (2888, 148, 'Gajuvaka', 'in', 'India');
INSERT INTO nuke_cities VALUES (2889, 149, 'Gândhîdham', 'in', 'India');
INSERT INTO nuke_cities VALUES (2890, 150, 'Gândhînagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2891, 151, 'Gangânagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2892, 152, 'Gangâpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2893, 153, 'Gangtok', 'in', 'India');
INSERT INTO nuke_cities VALUES (2894, 154, 'Gaya', 'in', 'India');
INSERT INTO nuke_cities VALUES (2895, 155, 'Ghatlodiya', 'in', 'India');
INSERT INTO nuke_cities VALUES (2896, 156, 'Ghâziâbâd', 'in', 'India');
INSERT INTO nuke_cities VALUES (2897, 157, 'Godhra', 'in', 'India');
INSERT INTO nuke_cities VALUES (2898, 158, 'Gonda', 'in', 'India');
INSERT INTO nuke_cities VALUES (2899, 159, 'Gondiya', 'in', 'India');
INSERT INTO nuke_cities VALUES (2900, 160, 'Gorakhpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2901, 161, 'Gûdalûr', 'in', 'India');
INSERT INTO nuke_cities VALUES (2902, 162, 'Gudivâda', 'in', 'India');
INSERT INTO nuke_cities VALUES (2903, 163, 'Gulbarga', 'in', 'India');
INSERT INTO nuke_cities VALUES (2904, 164, 'Guna', 'in', 'India');
INSERT INTO nuke_cities VALUES (2905, 165, 'Guntakal', 'in', 'India');
INSERT INTO nuke_cities VALUES (2906, 166, 'Guntûr', 'in', 'India');
INSERT INTO nuke_cities VALUES (2907, 167, 'Gurgaon', 'in', 'India');
INSERT INTO nuke_cities VALUES (2908, 168, 'Guwâhâti', 'in', 'India');
INSERT INTO nuke_cities VALUES (2909, 169, 'Gwalior', 'in', 'India');
INSERT INTO nuke_cities VALUES (2910, 170, 'Hâbra', 'in', 'India');
INSERT INTO nuke_cities VALUES (2911, 171, 'Haidarâbâd', 'in', 'India');
INSERT INTO nuke_cities VALUES (2912, 172, 'Hâjîpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2913, 173, 'Haldia', 'in', 'India');
INSERT INTO nuke_cities VALUES (2914, 174, 'Haldwâni', 'in', 'India');
INSERT INTO nuke_cities VALUES (2915, 175, 'Hâlîsahar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2916, 176, 'Hanumângarh', 'in', 'India');
INSERT INTO nuke_cities VALUES (2917, 177, 'Hâora', 'in', 'India');
INSERT INTO nuke_cities VALUES (2918, 178, 'Hâpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2919, 179, 'Hardoî', 'in', 'India');
INSERT INTO nuke_cities VALUES (2920, 180, 'Haridwâr', 'in', 'India');
INSERT INTO nuke_cities VALUES (2921, 181, 'Hassan', 'in', 'India');
INSERT INTO nuke_cities VALUES (2922, 182, 'Hâthras', 'in', 'India');
INSERT INTO nuke_cities VALUES (2923, 183, 'Hazârîbâg', 'in', 'India');
INSERT INTO nuke_cities VALUES (2924, 184, 'Hindupur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2925, 185, 'Hisâr', 'in', 'India');
INSERT INTO nuke_cities VALUES (2926, 186, 'Hoshangâbâd', 'in', 'India');
INSERT INTO nuke_cities VALUES (2927, 187, 'Hoshiârpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2928, 188, 'Hospet', 'in', 'India');
INSERT INTO nuke_cities VALUES (2929, 189, 'Hubli', 'in', 'India');
INSERT INTO nuke_cities VALUES (2930, 190, 'Hugli-Chunchura', 'in', 'India');
INSERT INTO nuke_cities VALUES (2931, 191, 'Ichalkaranji', 'in', 'India');
INSERT INTO nuke_cities VALUES (2932, 192, 'Imphâl', 'in', 'India');
INSERT INTO nuke_cities VALUES (2933, 193, 'Indore', 'in', 'India');
INSERT INTO nuke_cities VALUES (2934, 194, 'Ingrâj Bâzâr', 'in', 'India');
INSERT INTO nuke_cities VALUES (2935, 195, 'Itânagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2936, 196, 'Jabalpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2937, 197, 'Jâgadhri', 'in', 'India');
INSERT INTO nuke_cities VALUES (2938, 198, 'Jaipur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2939, 199, 'Jalandhar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2940, 200, 'Jâlgaon', 'in', 'India');
INSERT INTO nuke_cities VALUES (2941, 201, 'Jâlna', 'in', 'India');
INSERT INTO nuke_cities VALUES (2942, 202, 'Jalpâiguri', 'in', 'India');
INSERT INTO nuke_cities VALUES (2943, 203, 'Jamâlpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2944, 204, 'Jammu', 'in', 'India');
INSERT INTO nuke_cities VALUES (2945, 205, 'Jâmnagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2946, 206, 'Jamshedpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2947, 207, 'Jâmuria', 'in', 'India');
INSERT INTO nuke_cities VALUES (2948, 208, 'Jaridih', 'in', 'India');
INSERT INTO nuke_cities VALUES (2949, 209, 'Jaunpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2950, 210, 'Jetpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2951, 211, 'Jhânsi', 'in', 'India');
INSERT INTO nuke_cities VALUES (2952, 212, 'Jhunjhunûn', 'in', 'India');
INSERT INTO nuke_cities VALUES (2953, 213, 'Jînd', 'in', 'India');
INSERT INTO nuke_cities VALUES (2954, 214, 'Jodhpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2955, 215, 'Jûnâgadh', 'in', 'India');
INSERT INTO nuke_cities VALUES (2956, 216, 'Kaithal', 'in', 'India');
INSERT INTO nuke_cities VALUES (2957, 217, 'Kâkinâda', 'in', 'India');
INSERT INTO nuke_cities VALUES (2958, 218, 'Kâlol', 'in', 'India');
INSERT INTO nuke_cities VALUES (2959, 219, 'Kalyân', 'in', 'India');
INSERT INTO nuke_cities VALUES (2960, 220, 'Kâmârhâti', 'in', 'India');
INSERT INTO nuke_cities VALUES (2961, 221, 'Kânchipuram', 'in', 'India');
INSERT INTO nuke_cities VALUES (2962, 222, 'Kânchrâpâra', 'in', 'India');
INSERT INTO nuke_cities VALUES (2963, 223, 'Kânpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2964, 224, 'Kapra', 'in', 'India');
INSERT INTO nuke_cities VALUES (2965, 225, 'Karawal Nagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2966, 226, 'Karîmnagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2967, 227, 'Karnâl', 'in', 'India');
INSERT INTO nuke_cities VALUES (2968, 228, 'Karnûl', 'in', 'India');
INSERT INTO nuke_cities VALUES (2969, 229, 'Kataka', 'in', 'India');
INSERT INTO nuke_cities VALUES (2970, 230, 'Katihâr', 'in', 'India');
INSERT INTO nuke_cities VALUES (2971, 231, 'Kavaratti', 'in', 'India');
INSERT INTO nuke_cities VALUES (2972, 232, 'Khammam', 'in', 'India');
INSERT INTO nuke_cities VALUES (2973, 233, 'Khandwa', 'in', 'India');
INSERT INTO nuke_cities VALUES (2974, 234, 'Khanna', 'in', 'India');
INSERT INTO nuke_cities VALUES (2975, 235, 'Kharagpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2976, 236, 'Khardaha', 'in', 'India');
INSERT INTO nuke_cities VALUES (2977, 237, 'Khurja', 'in', 'India');
INSERT INTO nuke_cities VALUES (2978, 238, 'Kirari Suleman Nagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2979, 239, 'Kishangarh', 'in', 'India');
INSERT INTO nuke_cities VALUES (2980, 240, 'Kochi', 'in', 'India');
INSERT INTO nuke_cities VALUES (2981, 241, 'Kohîma', 'in', 'India');
INSERT INTO nuke_cities VALUES (2982, 242, 'Kolâr', 'in', 'India');
INSERT INTO nuke_cities VALUES (2983, 243, 'Kolhâpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2984, 244, 'Kolkata', 'in', 'India');
INSERT INTO nuke_cities VALUES (2985, 245, 'Kollam', 'in', 'India');
INSERT INTO nuke_cities VALUES (2986, 246, 'Korba', 'in', 'India');
INSERT INTO nuke_cities VALUES (2987, 247, 'Kota', 'in', 'India');
INSERT INTO nuke_cities VALUES (2988, 248, 'Koyampattur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2989, 249, 'Kozhikkod', 'in', 'India');
INSERT INTO nuke_cities VALUES (2990, 250, 'Krishnanagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2991, 251, 'Krishnarajapura', 'in', 'India');
INSERT INTO nuke_cities VALUES (2992, 252, 'Kukatpalle', 'in', 'India');
INSERT INTO nuke_cities VALUES (2993, 253, 'Kulti', 'in', 'India');
INSERT INTO nuke_cities VALUES (2994, 254, 'Kumbakonam', 'in', 'India');
INSERT INTO nuke_cities VALUES (2995, 255, 'Lakhîmpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2996, 256, 'Lakhnau', 'in', 'India');
INSERT INTO nuke_cities VALUES (2997, 257, 'Lalbahadur Nagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (2998, 258, 'Lalitpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (2999, 259, 'Lâtûr', 'in', 'India');
INSERT INTO nuke_cities VALUES (3000, 260, 'Loni', 'in', 'India');
INSERT INTO nuke_cities VALUES (3001, 261, 'Ludhiâna', 'in', 'India');
INSERT INTO nuke_cities VALUES (3002, 262, 'Machilîpatnam', 'in', 'India');
INSERT INTO nuke_cities VALUES (3003, 263, 'Madanapalle', 'in', 'India');
INSERT INTO nuke_cities VALUES (3004, 264, 'Madhyamgram', 'in', 'India');
INSERT INTO nuke_cities VALUES (3005, 265, 'Madurai', 'in', 'India');
INSERT INTO nuke_cities VALUES (3006, 266, 'Mahadevapura', 'in', 'India');
INSERT INTO nuke_cities VALUES (3007, 267, 'Mahbûbnagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (3008, 268, 'Mâhesana', 'in', 'India');
INSERT INTO nuke_cities VALUES (3009, 269, 'Maheshtala', 'in', 'India');
INSERT INTO nuke_cities VALUES (3010, 270, 'Maisûru', 'in', 'India');
INSERT INTO nuke_cities VALUES (3011, 271, 'Mâlegaon', 'in', 'India');
INSERT INTO nuke_cities VALUES (3012, 272, 'Mâler Kotla', 'in', 'India');
INSERT INTO nuke_cities VALUES (3013, 273, 'Malkajgiri', 'in', 'India');
INSERT INTO nuke_cities VALUES (3014, 274, 'Mandsaur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3015, 275, 'Mandya', 'in', 'India');
INSERT INTO nuke_cities VALUES (3016, 276, 'Mangaluru', 'in', 'India');
INSERT INTO nuke_cities VALUES (3017, 277, 'Mango', 'in', 'India');
INSERT INTO nuke_cities VALUES (3018, 278, 'Mathura', 'in', 'India');
INSERT INTO nuke_cities VALUES (3019, 279, 'Mau', 'in', 'India');
INSERT INTO nuke_cities VALUES (3020, 280, 'Midnapur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3021, 281, 'Mira Bhayandar', 'in', 'India');
INSERT INTO nuke_cities VALUES (3022, 282, 'Mîrat', 'in', 'India');
INSERT INTO nuke_cities VALUES (3023, 283, 'Mirzâpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3024, 284, 'Modinagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (3025, 285, 'Moga', 'in', 'India');
INSERT INTO nuke_cities VALUES (3026, 286, 'Mohali', 'in', 'India');
INSERT INTO nuke_cities VALUES (3027, 287, 'Morâdâbâd', 'in', 'India');
INSERT INTO nuke_cities VALUES (3028, 288, 'Morena', 'in', 'India');
INSERT INTO nuke_cities VALUES (3029, 289, 'Mormugao', 'in', 'India');
INSERT INTO nuke_cities VALUES (3030, 290, 'Morvi', 'in', 'India');
INSERT INTO nuke_cities VALUES (3031, 291, 'Motîhâri', 'in', 'India');
INSERT INTO nuke_cities VALUES (3032, 292, 'Mumbai', 'in', 'India');
INSERT INTO nuke_cities VALUES (3033, 293, 'Munger', 'in', 'India');
INSERT INTO nuke_cities VALUES (3034, 294, 'Murwâra', 'in', 'India');
INSERT INTO nuke_cities VALUES (3035, 295, 'Muzaffarnagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (3036, 296, 'Muzaffarpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3037, 297, 'Nadiâd', 'in', 'India');
INSERT INTO nuke_cities VALUES (3038, 298, 'Nagaon', 'in', 'India');
INSERT INTO nuke_cities VALUES (3039, 299, 'Nagda', 'in', 'India');
INSERT INTO nuke_cities VALUES (3040, 300, 'Nâgercoil', 'in', 'India');
INSERT INTO nuke_cities VALUES (3041, 301, 'Nâgpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3042, 302, 'Naihâti', 'in', 'India');
INSERT INTO nuke_cities VALUES (3043, 303, 'Nalasopara', 'in', 'India');
INSERT INTO nuke_cities VALUES (3044, 304, 'Nalgonda', 'in', 'India');
INSERT INTO nuke_cities VALUES (3045, 305, 'Nânded', 'in', 'India');
INSERT INTO nuke_cities VALUES (3046, 306, 'Nandyâl', 'in', 'India');
INSERT INTO nuke_cities VALUES (3047, 307, 'Nângloi Jât', 'in', 'India');
INSERT INTO nuke_cities VALUES (3048, 308, 'Nâshik', 'in', 'India');
INSERT INTO nuke_cities VALUES (3049, 309, 'Navadwîp', 'in', 'India');
INSERT INTO nuke_cities VALUES (3050, 310, 'Navghar', 'in', 'India');
INSERT INTO nuke_cities VALUES (3051, 311, 'Navi Mumbai', 'in', 'India');
INSERT INTO nuke_cities VALUES (3052, 312, 'Navsâri', 'in', 'India');
INSERT INTO nuke_cities VALUES (3053, 313, 'Nellur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3054, 314, 'Neyveli', 'in', 'India');
INSERT INTO nuke_cities VALUES (3055, 315, 'Ni Dilli', 'in', 'India');
INSERT INTO nuke_cities VALUES (3056, 316, 'Nîmach', 'in', 'India');
INSERT INTO nuke_cities VALUES (3057, 317, 'Nizâmâbâd', 'in', 'India');
INSERT INTO nuke_cities VALUES (3058, 318, 'Noida', 'in', 'India');
INSERT INTO nuke_cities VALUES (3059, 319, 'North Bârâkpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3060, 320, 'North Dum Dum', 'in', 'India');
INSERT INTO nuke_cities VALUES (3061, 321, 'Ongole', 'in', 'India');
INSERT INTO nuke_cities VALUES (3062, 322, 'Orai', 'in', 'India');
INSERT INTO nuke_cities VALUES (3063, 323, 'Ozhukarai', 'in', 'India');
INSERT INTO nuke_cities VALUES (3064, 324, 'Palakkad', 'in', 'India');
INSERT INTO nuke_cities VALUES (3065, 325, 'Pâlanpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3066, 326, 'Pâli', 'in', 'India');
INSERT INTO nuke_cities VALUES (3067, 327, 'Pallâvaram', 'in', 'India');
INSERT INTO nuke_cities VALUES (3068, 328, 'Palwal', 'in', 'India');
INSERT INTO nuke_cities VALUES (3069, 329, 'Panaji', 'in', 'India');
INSERT INTO nuke_cities VALUES (3070, 330, 'Panchkula', 'in', 'India');
INSERT INTO nuke_cities VALUES (3071, 331, 'Pânihâti', 'in', 'India');
INSERT INTO nuke_cities VALUES (3072, 332, 'Pânîpat', 'in', 'India');
INSERT INTO nuke_cities VALUES (3073, 333, 'Panvel', 'in', 'India');
INSERT INTO nuke_cities VALUES (3074, 334, 'Parbhani', 'in', 'India');
INSERT INTO nuke_cities VALUES (3075, 335, 'Pâtan', 'in', 'India');
INSERT INTO nuke_cities VALUES (3076, 336, 'Pathânkot', 'in', 'India');
INSERT INTO nuke_cities VALUES (3077, 337, 'Patiâla', 'in', 'India');
INSERT INTO nuke_cities VALUES (3078, 338, 'Patna', 'in', 'India');
INSERT INTO nuke_cities VALUES (3079, 339, 'Pîlîbhît', 'in', 'India');
INSERT INTO nuke_cities VALUES (3080, 340, 'Pimpri', 'in', 'India');
INSERT INTO nuke_cities VALUES (3081, 341, 'Pondicherry', 'in', 'India');
INSERT INTO nuke_cities VALUES (3082, 342, 'Porbandar', 'in', 'India');
INSERT INTO nuke_cities VALUES (3083, 343, 'Port Blair', 'in', 'India');
INSERT INTO nuke_cities VALUES (3084, 344, 'Proddatûr', 'in', 'India');
INSERT INTO nuke_cities VALUES (3085, 345, 'Pudukkottai', 'in', 'India');
INSERT INTO nuke_cities VALUES (3086, 346, 'Pune', 'in', 'India');
INSERT INTO nuke_cities VALUES (3087, 347, 'Puri', 'in', 'India');
INSERT INTO nuke_cities VALUES (3088, 348, 'Pûrnia', 'in', 'India');
INSERT INTO nuke_cities VALUES (3089, 349, 'Puruliya', 'in', 'India');
INSERT INTO nuke_cities VALUES (3090, 350, 'Qutubullapur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3091, 351, 'Râe Bareli', 'in', 'India');
INSERT INTO nuke_cities VALUES (3092, 352, 'Râichûr', 'in', 'India');
INSERT INTO nuke_cities VALUES (3093, 353, 'Râiganj', 'in', 'India');
INSERT INTO nuke_cities VALUES (3094, 354, 'Raigarh', 'in', 'India');
INSERT INTO nuke_cities VALUES (3095, 355, 'Raipur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3096, 356, 'Râjamahendri', 'in', 'India');
INSERT INTO nuke_cities VALUES (3097, 357, 'Râjapâlaiyam', 'in', 'India');
INSERT INTO nuke_cities VALUES (3098, 358, 'Rajarhat Gopalpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3099, 359, 'Rajendranagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (3100, 360, 'Râjkot', 'in', 'India');
INSERT INTO nuke_cities VALUES (3101, 361, 'Râjnândgaon', 'in', 'India');
INSERT INTO nuke_cities VALUES (3102, 362, 'Râjpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3103, 363, 'Râmagundam', 'in', 'India');
INSERT INTO nuke_cities VALUES (3104, 364, 'Râmpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3105, 365, 'Rânchi', 'in', 'India');
INSERT INTO nuke_cities VALUES (3106, 366, 'Rânîganj', 'in', 'India');
INSERT INTO nuke_cities VALUES (3107, 367, 'Ratlâm', 'in', 'India');
INSERT INTO nuke_cities VALUES (3108, 368, 'Raurkela', 'in', 'India');
INSERT INTO nuke_cities VALUES (3109, 369, 'Raurkela Civil Township', 'in', 'India');
INSERT INTO nuke_cities VALUES (3110, 370, 'Rewa', 'in', 'India');
INSERT INTO nuke_cities VALUES (3111, 371, 'Rewâri', 'in', 'India');
INSERT INTO nuke_cities VALUES (3112, 372, 'Rishra', 'in', 'India');
INSERT INTO nuke_cities VALUES (3113, 373, 'Robertsonpet', 'in', 'India');
INSERT INTO nuke_cities VALUES (3114, 374, 'Rohtak', 'in', 'India');
INSERT INTO nuke_cities VALUES (3115, 375, 'Rûrkî', 'in', 'India');
INSERT INTO nuke_cities VALUES (3116, 376, 'Sâgar', 'in', 'India');
INSERT INTO nuke_cities VALUES (3117, 377, 'Sahâranpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3118, 378, 'Saharsa', 'in', 'India');
INSERT INTO nuke_cities VALUES (3119, 379, 'Sambalpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3120, 380, 'Sambhal', 'in', 'India');
INSERT INTO nuke_cities VALUES (3121, 381, 'Sangli-Miraj', 'in', 'India');
INSERT INTO nuke_cities VALUES (3122, 382, 'Sâsarâm', 'in', 'India');
INSERT INTO nuke_cities VALUES (3123, 383, 'Sâtâra', 'in', 'India');
INSERT INTO nuke_cities VALUES (3124, 384, 'Satna', 'in', 'India');
INSERT INTO nuke_cities VALUES (3125, 385, 'Sawâi Mâdhopur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3126, 386, 'Selam', 'in', 'India');
INSERT INTO nuke_cities VALUES (3127, 387, 'Serilungampalle', 'in', 'India');
INSERT INTO nuke_cities VALUES (3128, 388, 'Shâhjahânpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3129, 389, 'Shântipur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3130, 390, 'Shilîguri', 'in', 'India');
INSERT INTO nuke_cities VALUES (3131, 391, 'Shillong', 'in', 'India');
INSERT INTO nuke_cities VALUES (3132, 392, 'Shimla', 'in', 'India');
INSERT INTO nuke_cities VALUES (3133, 393, 'Shimoga', 'in', 'India');
INSERT INTO nuke_cities VALUES (3134, 394, 'Shivapuri', 'in', 'India');
INSERT INTO nuke_cities VALUES (3135, 395, 'Sholâpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3136, 396, 'Shrîrâmpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3137, 397, 'Sikandarâbâd', 'in', 'India');
INSERT INTO nuke_cities VALUES (3138, 398, 'Sîkar', 'in', 'India');
INSERT INTO nuke_cities VALUES (3139, 399, 'Silchar', 'in', 'India');
INSERT INTO nuke_cities VALUES (3140, 400, 'Silvassa', 'in', 'India');
INSERT INTO nuke_cities VALUES (3141, 401, 'Singrauli', 'in', 'India');
INSERT INTO nuke_cities VALUES (3142, 402, 'Sirsa', 'in', 'India');
INSERT INTO nuke_cities VALUES (3143, 403, 'Sîtâpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3144, 404, 'Siwân', 'in', 'India');
INSERT INTO nuke_cities VALUES (3145, 405, 'Sonîpat', 'in', 'India');
INSERT INTO nuke_cities VALUES (3146, 406, 'South Dum Dum', 'in', 'India');
INSERT INTO nuke_cities VALUES (3147, 407, 'Srîkâkulam', 'in', 'India');
INSERT INTO nuke_cities VALUES (3148, 408, 'Srînagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (3149, 409, 'Sultânpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3150, 410, 'Sultanpur Majra', 'in', 'India');
INSERT INTO nuke_cities VALUES (3151, 411, 'Sûrat', 'in', 'India');
INSERT INTO nuke_cities VALUES (3152, 412, 'Surendranagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (3153, 413, 'Tâdepallegûdem', 'in', 'India');
INSERT INTO nuke_cities VALUES (3154, 414, 'Tâmbaram', 'in', 'India');
INSERT INTO nuke_cities VALUES (3155, 415, 'Tenâli', 'in', 'India');
INSERT INTO nuke_cities VALUES (3156, 416, 'Thalassery', 'in', 'India');
INSERT INTO nuke_cities VALUES (3157, 417, 'Thâna', 'in', 'India');
INSERT INTO nuke_cities VALUES (3158, 418, 'Thânesar', 'in', 'India');
INSERT INTO nuke_cities VALUES (3159, 419, 'Thanjâvûr', 'in', 'India');
INSERT INTO nuke_cities VALUES (3160, 420, 'Thiruvananthapuram', 'in', 'India');
INSERT INTO nuke_cities VALUES (3161, 421, 'Thrissûr', 'in', 'India');
INSERT INTO nuke_cities VALUES (3162, 422, 'Thûthukkudi', 'in', 'India');
INSERT INTO nuke_cities VALUES (3163, 423, 'Tiruchchirâppalli', 'in', 'India');
INSERT INTO nuke_cities VALUES (3164, 424, 'Tirunelveli', 'in', 'India');
INSERT INTO nuke_cities VALUES (3165, 425, 'Tirupati', 'in', 'India');
INSERT INTO nuke_cities VALUES (3166, 426, 'Tiruppur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3167, 427, 'Tiruvannâmalai', 'in', 'India');
INSERT INTO nuke_cities VALUES (3168, 428, 'Tirûvottiyûr', 'in', 'India');
INSERT INTO nuke_cities VALUES (3169, 429, 'Titâgarh', 'in', 'India');
INSERT INTO nuke_cities VALUES (3170, 430, 'Tonk', 'in', 'India');
INSERT INTO nuke_cities VALUES (3171, 431, 'Tumkûr', 'in', 'India');
INSERT INTO nuke_cities VALUES (3172, 432, 'Udaipur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3173, 433, 'Udupi', 'in', 'India');
INSERT INTO nuke_cities VALUES (3174, 434, 'Ujjain', 'in', 'India');
INSERT INTO nuke_cities VALUES (3175, 435, 'Ulhâsnagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (3176, 436, 'Ulubâria', 'in', 'India');
INSERT INTO nuke_cities VALUES (3177, 437, 'Unnâo', 'in', 'India');
INSERT INTO nuke_cities VALUES (3178, 438, 'Uppal Kalan', 'in', 'India');
INSERT INTO nuke_cities VALUES (3179, 439, 'Uttarpara-Kotrung', 'in', 'India');
INSERT INTO nuke_cities VALUES (3180, 440, 'Vadodara', 'in', 'India');
INSERT INTO nuke_cities VALUES (3181, 441, 'Vârânasî', 'in', 'India');
INSERT INTO nuke_cities VALUES (3182, 442, 'Vejalpur', 'in', 'India');
INSERT INTO nuke_cities VALUES (3183, 443, 'Velluru', 'in', 'India');
INSERT INTO nuke_cities VALUES (3184, 444, 'Verâval', 'in', 'India');
INSERT INTO nuke_cities VALUES (3185, 445, 'Vidisha', 'in', 'India');
INSERT INTO nuke_cities VALUES (3186, 446, 'Vijayawâda', 'in', 'India');
INSERT INTO nuke_cities VALUES (3187, 447, 'Virâr', 'in', 'India');
INSERT INTO nuke_cities VALUES (3188, 448, 'Visakhapatnam', 'in', 'India');
INSERT INTO nuke_cities VALUES (3189, 449, 'Vizianagaram', 'in', 'India');
INSERT INTO nuke_cities VALUES (3190, 450, 'Warangal', 'in', 'India');
INSERT INTO nuke_cities VALUES (3191, 451, 'Wardha', 'in', 'India');
INSERT INTO nuke_cities VALUES (3192, 452, 'Yamunânagar', 'in', 'India');
INSERT INTO nuke_cities VALUES (3193, 453, 'Yavatmâl', 'in', 'India');
INSERT INTO nuke_cities VALUES (3194, 1, 'Adiwerna', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3195, 2, 'Ambon', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3196, 3, 'Balikpapan', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3197, 4, 'Banda Aceh', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3198, 5, 'Bandar Lampung', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3199, 6, 'Bandung', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3200, 7, 'Banjarmasin', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3201, 8, 'Banyuwangi', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3202, 9, 'Batam', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3203, 10, 'Bekasi', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3204, 11, 'Belawan', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3205, 12, 'Bengkulu', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3206, 13, 'Binjai', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3207, 14, 'Bitung', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3208, 15, 'Blitar', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3209, 16, 'Bogor', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3210, 17, 'Brebes', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3211, 18, 'Cianjur', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3212, 19, 'Ciawi', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3213, 20, 'Cibinong', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3214, 21, 'Cilacap', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3215, 22, 'Cilegon', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3216, 23, 'Cimahi', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3217, 24, 'Cimanggis', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3218, 25, 'Ciomas', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3219, 26, 'Ciparay', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3220, 27, 'Ciputat', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3221, 28, 'Cirebon', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3222, 29, 'Citeureup', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3223, 30, 'Denpasar', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3224, 31, 'Depok', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3225, 32, 'Depok', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3226, 33, 'Dumai', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3227, 34, 'Garut', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3228, 35, 'Gorontalo', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3229, 36, 'Jakarta', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3230, 37, 'Jambi', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3231, 38, 'Jaya Pura', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3232, 39, 'Jember', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3233, 40, 'Jombang', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3234, 41, 'Karawang', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3235, 42, 'Kediri', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3236, 43, 'Kendari', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3237, 44, 'Klaten', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3238, 45, 'Kudus', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3239, 46, 'Kupang', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3240, 47, 'Lhokseumawe', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3241, 48, 'Madiun', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3242, 49, 'Magelang', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3243, 50, 'Majalaya', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3244, 51, 'Makasar', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3245, 52, 'Malang', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3246, 53, 'Manado', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3247, 54, 'Martapura', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3248, 55, 'Mataram', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3249, 56, 'Medan', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3250, 57, 'Mojokerto', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3251, 58, 'Padang', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3252, 59, 'Padang Sidempuan', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3253, 60, 'Palangka Raya', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3254, 61, 'Palembang', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3255, 62, 'Palu', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3256, 63, 'Pangkal Pinang', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3257, 64, 'Pare Pare', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3258, 65, 'Pasuruan', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3259, 66, 'Pekalongan', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3260, 67, 'Pekan Baru', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3261, 68, 'Pemalang', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3262, 69, 'Pematang Siantar', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3263, 70, 'Percut Sei Tuan', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3264, 71, 'Pondok Aren', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3265, 72, 'Pondokgede', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3266, 73, 'Pontianak', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3267, 74, 'Probolinggo', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3268, 75, 'Purwakarta', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3269, 76, 'Purwokerto', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3270, 77, 'Rantauprapat', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3271, 78, 'Salatiga', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3272, 79, 'Samarinda', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3273, 80, 'Sawangan', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3274, 81, 'Semarang', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3275, 82, 'Serang', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3276, 83, 'Sorong', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3277, 84, 'Sukabumi', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3278, 85, 'Sunggal', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3279, 86, 'Surabaya', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3280, 87, 'Surakarta', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3281, 88, 'Taman', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3282, 89, 'Tangerang', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3283, 90, 'Tanjung Balai', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3284, 91, 'Tanjung Pinang', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3285, 92, 'Tasikmalaya', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3286, 93, 'Tebingtinggi', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3287, 94, 'Tegal', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3288, 95, 'Ternate', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3289, 96, 'Waru', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3290, 97, 'Weru', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3291, 98, 'Yogyakarta', 'id', 'Indonesia');
INSERT INTO nuke_cities VALUES (3292, 1, 'Âbâdân', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3293, 2, 'Ahvâz', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3294, 3, 'Âmol', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3295, 4, 'Andîmeshk', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3296, 5, 'Arâk', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3297, 6, 'Ardabîl', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3298, 7, 'Bâbol', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3299, 8, 'Bandar-e ´Abbâs', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3300, 9, 'Bandar-e Anzalî', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3301, 10, 'Bandar-e Mâhshahr', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3302, 11, 'Behbahân', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3303, 12, 'Bîrjand', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3304, 13, 'Bojnûrd', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3305, 14, 'Borûjerd', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3306, 15, 'Bûkân', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3307, 16, 'Bûshehr', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3308, 17, 'Dezfûl', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3309, 18, 'Esfahân', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3310, 19, 'Eslâmshahr', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3311, 20, 'Ezeh', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3312, 21, 'Gonbad-e Qâbûs', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3313, 22, 'Gorgân', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3314, 23, 'Hamadân', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3315, 24, 'Îlâm', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3316, 25, 'Jahrom', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3317, 26, 'Karaj', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3318, 27, 'Kâshân', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3319, 28, 'Kermân', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3320, 29, 'Kermânshâh', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3321, 30, 'Khomeynîshahr', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3322, 31, 'Khorramâbâd', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3323, 32, 'Khorramshahr', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3324, 33, 'Khoy', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3325, 34, 'Mahâbâd', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3326, 35, 'Malârd', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3327, 36, 'Malâyer', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3328, 37, 'Marâgheh', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3329, 38, 'Marv Dasht', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3330, 39, 'Mashhad', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3331, 40, 'Masjed-e Soleymân', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3332, 41, 'Mîândoâb', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3333, 42, 'Najafâbâd', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3334, 43, 'Neyshâbûr', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3335, 44, 'Orûmîyeh', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3336, 45, 'Qâ´emshahr', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3337, 46, 'Qarchak', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3338, 47, 'Qazvîn', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3339, 48, 'Qods', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3340, 49, 'Qom', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3341, 50, 'Rafsanjân', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3342, 51, 'Rasht', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3343, 52, 'Sabzevâr', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3344, 53, 'Sanandaj', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3345, 54, 'Saqqez', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3346, 55, 'Sârî', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3347, 56, 'Sâveh', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3348, 57, 'Semnân', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3349, 58, 'Shahr-e Kord', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3350, 59, 'Shâhrûd', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3351, 60, 'Shîrâz', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3352, 61, 'Sîrjân', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3353, 62, 'Tabrîz', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3354, 63, 'Tehrân', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3355, 64, 'Varâmîn', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3356, 65, 'Yâsûj', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3357, 66, 'Yazd', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3358, 67, 'Zâbol', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3359, 68, 'Zâhedân', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3360, 69, 'Zanjân', 'ir', 'Iran');
INSERT INTO nuke_cities VALUES (3361, 1, 'ad-Dîwânîyah', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3362, 2, 'al-´Amârah', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3363, 3, 'al-Basrah', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3364, 4, 'al-Fallûjah', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3365, 5, 'al-Hillah', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3366, 6, 'al-Kûfah', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3367, 7, 'al-Kût', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3368, 8, 'al-Mawsil', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3369, 9, 'an-Najaf', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3370, 10, 'an-Nâsirîyah', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3371, 11, 'ar-Ramâdî', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3372, 12, 'as-Samâwah', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3373, 13, 'as-Sulaymânîyah', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3374, 14, 'az-Zubayr', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3375, 15, 'Ba´qûbah', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3376, 16, 'Baghdâd', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3377, 17, 'Dahûk', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3378, 18, 'Irbîl', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3379, 19, 'Karbalâ', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3380, 20, 'Kirkûk', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3381, 21, 'Sâmarrâ', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3382, 22, 'Tall ´Afar', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3383, 23, 'Tikrit', 'iq', 'Iraq');
INSERT INTO nuke_cities VALUES (3384, 1, 'Athlone', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3385, 2, 'Bray', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3386, 3, 'Carlow', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3387, 4, 'Carrick-on-Shannon', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3388, 5, 'Castlebar', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3389, 6, 'Cavan', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3390, 7, 'Clonmel', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3391, 8, 'Cork', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3392, 9, 'Drogheda', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3393, 10, 'Dublin', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3394, 11, 'Dundalk', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3395, 12, 'Dungarvan', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3396, 13, 'Ennis', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3397, 14, 'Galway', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3398, 15, 'Kilkenny', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3399, 16, 'Lifford', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3400, 17, 'Limerick', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3401, 18, 'Longford', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3402, 19, 'Monaghan', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3403, 20, 'Mullingar', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3404, 21, 'Naas', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3405, 22, 'Navan', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3406, 23, 'Nenagh', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3407, 24, 'Newbridge', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3408, 25, 'Port Laoise', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3409, 26, 'Roscommon', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3410, 27, 'Sligo', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3411, 28, 'Swords', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3412, 29, 'Tralee', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3413, 30, 'Tullamore', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3414, 31, 'Waterford', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3415, 32, 'Wexford', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3416, 33, 'Wicklow', 'ie', 'Ireland');
INSERT INTO nuke_cities VALUES (3417, 1, 'Ashdod', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3418, 2, 'Ashqelon', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3419, 3, 'Bat Yam', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3420, 4, 'Be\'er Sheva', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3421, 5, 'Bene Beraq', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3422, 6, 'Herzeliyya', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3423, 7, 'Kefar Sava', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3424, 8, 'Khadera', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3425, 9, 'Khefa', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3426, 10, 'Kholon', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3427, 11, 'Lod', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3428, 12, 'Nazerat', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3429, 13, 'Netanya', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3430, 14, 'Petakh Tiqwa', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3431, 15, 'Ra\'anana', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3432, 16, 'Ramat Gan', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3433, 17, 'Ramla', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3434, 18, 'Rekhovot', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3435, 19, 'Rishon LeZiyyon', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3436, 20, 'Tel Aviv-Yafo', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3437, 21, 'Yerushalayim', 'il', 'Israel');
INSERT INTO nuke_cities VALUES (3438, 1, 'Ancona', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3439, 2, 'Bari', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3440, 3, 'Bergamo', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3441, 4, 'Bologna', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3442, 5, 'Brescia', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3443, 6, 'Cagliari', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3444, 7, 'Catania', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3445, 8, 'Ferrara', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3446, 9, 'Firenze', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3447, 10, 'Foggia', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3448, 11, 'Forlì', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3449, 12, 'Genova', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3450, 13, 'Latina', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3451, 14, 'Livorno', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3452, 15, 'Messina', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3453, 16, 'Milano', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3454, 17, 'Modena', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3455, 18, 'Monza', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3456, 19, 'Napoli', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3457, 20, 'Novara', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3458, 21, 'Padova', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3459, 22, 'Palermo', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3460, 23, 'Parma', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3461, 24, 'Perugia', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3462, 25, 'Pescara', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3463, 26, 'Prato', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3464, 27, 'Ravenna', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3465, 28, 'Reggio di Calabria', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3466, 29, 'Reggio nell\'Emilia', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3467, 30, 'Rimini', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3468, 31, 'Roma', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3469, 32, 'Salerno', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3470, 33, 'Sassari', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3471, 34, 'Siracusa', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3472, 35, 'Taranto', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3473, 36, 'Terni', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3474, 37, 'Torino', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3475, 38, 'Trento', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3476, 39, 'Trieste', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3477, 40, 'Venezia', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3478, 41, 'Verona', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3479, 42, 'Vicenza', 'it', 'Italy');
INSERT INTO nuke_cities VALUES (3480, 1, 'Abengourou', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3481, 2, 'Abidjan', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3482, 3, 'Agboville', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3483, 4, 'Anyama', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3484, 5, 'Bingerville', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3485, 6, 'Bondoukou', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3486, 7, 'Bouaflé', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3487, 8, 'Bouaké', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3488, 9, 'Dabou', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3489, 10, 'Daloa', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3490, 11, 'Danané', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3491, 12, 'Dimbokro', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3492, 13, 'Divo', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3493, 14, 'Gagnoa', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3494, 15, 'Grand Bassam', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3495, 16, 'Korhogo', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3496, 17, 'Man', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3497, 18, 'Odienné', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3498, 19, 'San-Pédro', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3499, 20, 'Séguéla', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3500, 21, 'Sinfra', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3501, 22, 'Touba', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3502, 23, 'Yamoussoukro', 'ci', 'Ivory Coast');
INSERT INTO nuke_cities VALUES (3503, 1, 'Anchovy', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3504, 2, 'Anotto Bay', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3505, 3, 'Bamboo', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3506, 4, 'Black River', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3507, 5, 'Brown\'s Town', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3508, 6, 'Bull Savanna', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3509, 7, 'Falmouth', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3510, 8, 'Half Way Tree', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3511, 9, 'Kingston', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3512, 10, 'Lucea', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3513, 11, 'Mandeville', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3514, 12, 'May Pen', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3515, 13, 'Montego Bay', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3516, 14, 'Morant Bay', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3517, 15, 'Ocho Rios', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3518, 16, 'Port Antonio', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3519, 17, 'Port Maria', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3520, 18, 'Portmore', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3521, 19, 'Saint Ann\'s Bay', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3522, 20, 'Savanna la Mar', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3523, 21, 'Spanish Town', 'jm', 'Jamaica');
INSERT INTO nuke_cities VALUES (3524, 1, 'Abiko', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3525, 2, 'Ageo', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3526, 3, 'Aizuwakamatsu', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3527, 4, 'Akashi', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3528, 5, 'Akishima', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3529, 6, 'Akita', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3530, 7, 'Amagasaki', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3531, 8, 'Anjô', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3532, 9, 'Aomori', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3533, 10, 'Asahikawa', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3534, 11, 'Asaka', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3535, 12, 'Ashikaga', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3536, 13, 'Atsugi', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3537, 14, 'Beppu', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3538, 15, 'Chiba', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3539, 16, 'Chigasaki', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3540, 17, 'Chôfu', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3541, 18, 'Daitô', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3542, 19, 'Ebetsu', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3543, 20, 'Ebina', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3544, 21, 'Fuchû', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3545, 22, 'Fuji', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3546, 23, 'Fujieda', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3547, 24, 'Fujimi', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3548, 25, 'Fujinomiya', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3549, 26, 'Fujisawa', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3550, 27, 'Fukaya', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3551, 28, 'Fukui', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3552, 29, 'Fukuoka', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3553, 30, 'Fukushima', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3554, 31, 'Fukuyama', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3555, 32, 'Funabashi', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3556, 33, 'Gifu', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3557, 34, 'Habikino', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3558, 35, 'Hachinohe', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3559, 36, 'Hachiôji', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3560, 37, 'Hadano', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3561, 38, 'Hakodate', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3562, 39, 'Hamamatsu', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3563, 40, 'Handa', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3564, 41, 'Higashihiroshima', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3565, 42, 'Higashikurume', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3566, 43, 'Higashimurayama', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3567, 44, 'Higashiôsaka', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3568, 45, 'Hikone', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3569, 46, 'Himeji', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3570, 47, 'Hino', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3571, 48, 'Hirakata', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3572, 49, 'Hiratsuka', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3573, 50, 'Hirosaki', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3574, 51, 'Hiroshima', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3575, 52, 'Hitachi', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3576, 53, 'Hitachinaka', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3577, 54, 'Hôfu', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3578, 55, 'Hôya', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3579, 56, 'Ibaraki', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3580, 57, 'Ichihara', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3581, 58, 'Ichikawa', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3582, 59, 'Ichinomiya', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3583, 60, 'Iida', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3584, 61, 'Ikeda', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3585, 62, 'Ikoma', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3586, 63, 'Imabari', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3587, 64, 'Inazawa', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3588, 65, 'Iruma', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3589, 66, 'Isehara', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3590, 67, 'Isesaki', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3591, 68, 'Ishinomaki', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3592, 69, 'Itami', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3593, 70, 'Iwaki', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3594, 71, 'Iwakuni', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3595, 72, 'Iwatsuki', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3596, 73, 'Izumi', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3597, 74, 'Jôetsu', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3598, 75, 'Kadoma', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3599, 76, 'Kagoshima', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3600, 77, 'Kakamigahara', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3601, 78, 'Kakogawa', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3602, 79, 'Kamagaya', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3603, 80, 'Kamakura', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3604, 81, 'Kanazawa', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3605, 82, 'Kariya', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3606, 83, 'Kashihara', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3607, 84, 'Kashiwa', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3608, 85, 'Kasuga', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3609, 86, 'Kasugai', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3610, 87, 'Kasukabe', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3611, 88, 'Kawachinagano', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3612, 89, 'Kawagoe', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3613, 90, 'Kawaguchi', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3614, 91, 'Kawanishi', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3615, 92, 'Kawasaki', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3616, 93, 'Kiryû', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3617, 94, 'Kisarazu', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3618, 95, 'Kishiwada', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3619, 96, 'Kitakyûshû', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3620, 97, 'Kitami', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3621, 98, 'Kôbe', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3622, 99, 'Kôchi', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3623, 100, 'Kodaira', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3624, 101, 'Kôfu', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3625, 102, 'Koganei', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3626, 103, 'Kokubunji', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3627, 104, 'Komaki', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3628, 105, 'Komatsu', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3629, 106, 'Kôriyama', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3630, 107, 'Koshigaya', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3631, 108, 'Kumagaya', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3632, 109, 'Kumamoto', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3633, 110, 'Kurashiki', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3634, 111, 'Kure', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3635, 112, 'Kurume', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3636, 113, 'Kusatsu', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3637, 114, 'Kushiro', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3638, 115, 'Kuwana', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3639, 116, 'Kyôto', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3640, 117, 'Machida', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3641, 118, 'Maebashi', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3642, 119, 'Matsubara', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3643, 120, 'Matsudo', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3644, 121, 'Matsue', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3645, 122, 'Matsumoto', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3646, 123, 'Matsusaka', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3647, 124, 'Matsuyama', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3648, 125, 'Minô', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3649, 126, 'Misato', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3650, 127, 'Mishima', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3651, 128, 'Mitaka', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3652, 129, 'Mito', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3653, 130, 'Miyakonojô', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3654, 131, 'Miyazaki', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3655, 132, 'Moriguchi', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3656, 133, 'Morioka', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3657, 134, 'Muroran', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3658, 135, 'Musashino', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3659, 136, 'Nagano', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3660, 137, 'Nagaoka', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3661, 138, 'Nagareyama', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3662, 139, 'Nagasaki', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3663, 140, 'Nagoya', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3664, 141, 'Naha', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3665, 142, 'Nara', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3666, 143, 'Narashino', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3667, 144, 'Neyagawa', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3668, 145, 'Niigata', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3669, 146, 'Niihama', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3670, 147, 'Niiza', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3671, 148, 'Nishinomiya', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3672, 149, 'Nishio', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3673, 150, 'Nobeoka', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3674, 151, 'Noda', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3675, 152, 'Numazu', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3676, 153, 'Obihiro', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3677, 154, 'Odawara', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3678, 155, 'Ôgaki', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3679, 156, 'Ôita', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3680, 157, 'Okayama', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3681, 158, 'Okazaki', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3682, 159, 'Okinawa', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3683, 160, 'Ôme', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3684, 161, 'Ômiya', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3685, 162, 'Ômuta', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3686, 163, 'Ôsaka', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3687, 164, 'Ôta', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3688, 165, 'Otaru', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3689, 166, 'Ôtsu', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3690, 167, 'Oyama', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3691, 168, 'Saga', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3692, 169, 'Sagamihara', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3693, 170, 'Sakai', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3694, 171, 'Sakata', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3695, 172, 'Sakura', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3696, 173, 'Sanda', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3697, 174, 'Sapporo', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3698, 175, 'Sasebo', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3699, 176, 'Sayama', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3700, 177, 'Sendai', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3701, 178, 'Seto', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3702, 179, 'Shimizu', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3703, 180, 'Shimonoseki', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3704, 181, 'Shizuoka', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3705, 182, 'Sôka', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3706, 183, 'Suita', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3707, 184, 'Suzuka', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3708, 185, 'Tachikawa', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3709, 186, 'Tajimi', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3710, 187, 'Takamatsu', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3711, 188, 'Takaoka', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3712, 189, 'Takarazuka', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3713, 190, 'Takasaki', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3714, 191, 'Takatsuki', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3715, 192, 'Tama', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3716, 193, 'Toda', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3717, 194, 'Tokai', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3718, 195, 'Tokorozawa', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3719, 196, 'Tokushima', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3720, 197, 'Tokuyama', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3721, 198, 'Tôkyô', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3722, 199, 'Tomakomai', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3723, 200, 'Tondabayashi', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3724, 201, 'Tottori', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3725, 202, 'Toyama', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3726, 203, 'Toyohashi', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3727, 204, 'Toyokawa', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3728, 205, 'Toyonaka', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3729, 206, 'Toyota', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3730, 207, 'Tsu', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3731, 208, 'Tsuchiura', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3732, 209, 'Tsukuba', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3733, 210, 'Tsuruoka', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3734, 211, 'Ube', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3735, 212, 'Ueda', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3736, 213, 'Uji', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3737, 214, 'Urasoe', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3738, 215, 'Urawa', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3739, 216, 'Urayasu', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3740, 217, 'Utsunomiya', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3741, 218, 'Wakayama', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3742, 219, 'Yachiyo', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3743, 220, 'Yaizu', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3744, 221, 'Yamagata', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3745, 222, 'Yamaguchi', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3746, 223, 'Yamato', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3747, 224, 'Yao', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3748, 225, 'Yatsushiro', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3749, 226, 'Yokkaichi', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3750, 227, 'Yokohama', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3751, 228, 'Yokosuka', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3752, 229, 'Yonago', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3753, 230, 'Zama', 'jp', 'Japan');
INSERT INTO nuke_cities VALUES (3754, 1, 'Grouville', 'xj', 'Jersey');
INSERT INTO nuke_cities VALUES (3755, 2, 'Saint Brelade', 'xj', 'Jersey');
INSERT INTO nuke_cities VALUES (3756, 3, 'Saint Clement', 'xj', 'Jersey');
INSERT INTO nuke_cities VALUES (3757, 4, 'Saint Helier', 'xj', 'Jersey');
INSERT INTO nuke_cities VALUES (3758, 5, 'Saint John', 'xj', 'Jersey');
INSERT INTO nuke_cities VALUES (3759, 6, 'Saint Lawrence', 'xj', 'Jersey');
INSERT INTO nuke_cities VALUES (3760, 7, 'Saint Martin', 'xj', 'Jersey');
INSERT INTO nuke_cities VALUES (3761, 8, 'Saint Mary', 'xj', 'Jersey');
INSERT INTO nuke_cities VALUES (3762, 9, 'Saint Ouen', 'xj', 'Jersey');
INSERT INTO nuke_cities VALUES (3763, 10, 'Saint Peter', 'xj', 'Jersey');
INSERT INTO nuke_cities VALUES (3764, 11, 'Saint Saviour', 'xj', 'Jersey');
INSERT INTO nuke_cities VALUES (3765, 12, 'Trinity', 'xj', 'Jersey');
INSERT INTO nuke_cities VALUES (3766, 1, '´Ajlûn', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3767, 2, '´Ammân', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3768, 3, 'Abû ´Alandâ', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3769, 4, 'al-´Aqabah', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3770, 5, 'al-Baq´ah', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3771, 6, 'al-Jubayhah', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3772, 7, 'al-Karak', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3773, 8, 'al-Mafraq', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3774, 9, 'al-Quwaysimah', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3775, 10, 'ar-Ramtha', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3776, 11, 'ar-Russayfah', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3777, 12, 'as-Salt', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3778, 13, 'at-Tafîlah', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3779, 14, 'az-Zarqâ\'', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3780, 15, 'Irbid', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3781, 16, 'Jarash', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3782, 17, 'Khalda wa Tilâ´-al-´Alî', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3783, 18, 'Ma´ân', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3784, 19, 'Mâdabâ', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3785, 20, 'Mushayrfat Râs al-´Ayn', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3786, 21, 'Sahâb', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3787, 22, 'Shnillar', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3788, 23, 'Suwaylih', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3789, 24, 'Târiq', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3790, 25, 'Wâdî as-Sîr', 'jo', 'Jordan');
INSERT INTO nuke_cities VALUES (3791, 1, 'Akmeçet', 'kz', 'Kazakhstan');
INSERT INTO nuke_cities VALUES (3792, 2, 'Aktaû', 'kz', 'Kazakhstan');
INSERT INTO nuke_cities VALUES (3793, 3, 'Aktöbe', 'kz', 'Kazakhstan');
INSERT INTO nuke_cities VALUES (3794, 4, 'Almati', 'kz', 'Kazakhstan');
INSERT INTO nuke_cities VALUES (3795, 5, 'Astana', 'kz', 'Kazakhstan');
INSERT INTO nuke_cities VALUES (3796, 6, 'Atiraû', 'kz', 'Kazakhstan');
INSERT INTO nuke_cities VALUES (3797, 7, 'Èkibastuz', 'kz', 'Kazakhstan');
INSERT INTO nuke_cities VALUES (3798, 8, 'Karaganda', 'kz', 'Kazakhstan');
INSERT INTO nuke_cities VALUES (3799, 9, 'Kostanay', 'kz', 'Kazakhstan');
INSERT INTO nuke_cities VALUES (3800, 10, 'Köksetaû', 'kz', 'Kazakhstan');
INSERT INTO nuke_cities VALUES (3801, 11, 'Oral', 'kz', 'Kazakhstan');
INSERT INTO nuke_cities VALUES (3802, 12, 'Öskemen', 'kz', 'Kazakhstan');
INSERT INTO nuke_cities VALUES (3803, 13, 'Pavlodar', 'kz', 'Kazakhstan');
INSERT INTO nuke_cities VALUES (3804, 14, 'Petropavl', 'kz', 'Kazakhstan');
INSERT INTO nuke_cities VALUES (3805, 15, 'Rûdni', 'kz', 'Kazakhstan');
INSERT INTO nuke_cities VALUES (3806, 16, 'Semey', 'kz', 'Kazakhstan');
INSERT INTO nuke_cities VALUES (3807, 17, 'Simkent', 'kz', 'Kazakhstan');
INSERT INTO nuke_cities VALUES (3808, 18, 'Taldikorgan', 'kz', 'Kazakhstan');
INSERT INTO nuke_cities VALUES (3809, 19, 'Taraz', 'kz', 'Kazakhstan');
INSERT INTO nuke_cities VALUES (3810, 20, 'Temirtaû', 'kz', 'Kazakhstan');
INSERT INTO nuke_cities VALUES (3811, 1, 'Eldoret', 'ke', 'Kenya');
INSERT INTO nuke_cities VALUES (3812, 2, 'Embu', 'ke', 'Kenya');
INSERT INTO nuke_cities VALUES (3813, 3, 'Garissa', 'ke', 'Kenya');
INSERT INTO nuke_cities VALUES (3814, 4, 'Homa Bay', 'ke', 'Kenya');
INSERT INTO nuke_cities VALUES (3815, 5, 'Kakamega', 'ke', 'Kenya');
INSERT INTO nuke_cities VALUES (3816, 6, 'Kericho', 'ke', 'Kenya');
INSERT INTO nuke_cities VALUES (3817, 7, 'Kisii', 'ke', 'Kenya');
INSERT INTO nuke_cities VALUES (3818, 8, 'Kisumu', 'ke', 'Kenya');
INSERT INTO nuke_cities VALUES (3819, 9, 'Kitale', 'ke', 'Kenya');
INSERT INTO nuke_cities VALUES (3820, 10, 'Machakos', 'ke', 'Kenya');
INSERT INTO nuke_cities VALUES (3821, 11, 'Maragua', 'ke', 'Kenya');
INSERT INTO nuke_cities VALUES (3822, 12, 'Meru', 'ke', 'Kenya');
INSERT INTO nuke_cities VALUES (3823, 13, 'Mombasa', 'ke', 'Kenya');
INSERT INTO nuke_cities VALUES (3824, 14, 'Muranga', 'ke', 'Kenya');
INSERT INTO nuke_cities VALUES (3825, 15, 'Nairobi', 'ke', 'Kenya');
INSERT INTO nuke_cities VALUES (3826, 16, 'Naivasha', 'ke', 'Kenya');
INSERT INTO nuke_cities VALUES (3827, 17, 'Nakuru', 'ke', 'Kenya');
INSERT INTO nuke_cities VALUES (3828, 18, 'Nyeri', 'ke', 'Kenya');
INSERT INTO nuke_cities VALUES (3829, 19, 'Thika', 'ke', 'Kenya');
INSERT INTO nuke_cities VALUES (3830, 20, 'Webuye', 'ke', 'Kenya');
INSERT INTO nuke_cities VALUES (3831, 1, 'Abaokoro', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3832, 2, 'Bairiki', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3833, 3, 'Bikenibeu', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3834, 4, 'Binoinano', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3835, 5, 'Bonriki', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3836, 6, 'Buariki', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3837, 7, 'Buariki', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3838, 8, 'Butaritari', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3839, 9, 'Ijaki', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3840, 10, 'London', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3841, 11, 'Makin', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3842, 12, 'Nabari', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3843, 13, 'Ooma', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3844, 14, 'Pyramid Point', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3845, 15, 'Rawannawi', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3846, 16, 'Roreti', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3847, 17, 'Rungata', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3848, 18, 'Tabiauea', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3849, 19, 'Tabontebike', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3850, 20, 'Tabukiniberu', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3851, 21, 'Taburao', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3852, 22, 'Takaeang', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3853, 23, 'Temaraia', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3854, 24, 'Utiroa', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3855, 25, 'Washington', 'ki', 'Kiribati');
INSERT INTO nuke_cities VALUES (3856, 1, 'Cheongjin', 'kp', 'Korea (North)');
INSERT INTO nuke_cities VALUES (3857, 2, 'Haeju', 'kp', 'Korea (North)');
INSERT INTO nuke_cities VALUES (3858, 3, 'Hamheung', 'kp', 'Korea (North)');
INSERT INTO nuke_cities VALUES (3859, 4, 'Hyesan', 'kp', 'Korea (North)');
INSERT INTO nuke_cities VALUES (3860, 5, 'Kaeseong', 'kp', 'Korea (North)');
INSERT INTO nuke_cities VALUES (3861, 6, 'Kanggye', 'kp', 'Korea (North)');
INSERT INTO nuke_cities VALUES (3862, 7, 'Kimchaek', 'kp', 'Korea (North)');
INSERT INTO nuke_cities VALUES (3863, 8, 'Najin', 'kp', 'Korea (North)');
INSERT INTO nuke_cities VALUES (3864, 9, 'Nampo', 'kp', 'Korea (North)');
INSERT INTO nuke_cities VALUES (3865, 10, 'Phyeongseong', 'kp', 'Korea (North)');
INSERT INTO nuke_cities VALUES (3866, 11, 'Pyeongyang', 'kp', 'Korea (North)');
INSERT INTO nuke_cities VALUES (3867, 12, 'Sariweon', 'kp', 'Korea (North)');
INSERT INTO nuke_cities VALUES (3868, 13, 'Seongnim', 'kp', 'Korea (North)');
INSERT INTO nuke_cities VALUES (3869, 14, 'Sineuiju', 'kp', 'Korea (North)');
INSERT INTO nuke_cities VALUES (3870, 15, 'Weonsan', 'kp', 'Korea (North)');
INSERT INTO nuke_cities VALUES (3871, 1, 'Andong', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3872, 2, 'Ansan', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3873, 3, 'Anyang', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3874, 4, 'Changweon', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3875, 5, 'Chechon', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3876, 6, 'Cheju', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3877, 7, 'Cheonan', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3878, 8, 'Cheongju', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3879, 9, 'Cheonju', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3880, 10, 'Chinhae', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3881, 11, 'Chinju', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3882, 12, 'Chuncheon', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3883, 13, 'Chungju', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3884, 14, 'Euijeongbu', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3885, 15, 'Euiwang', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3886, 16, 'Hanam', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3887, 17, 'Iksan', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3888, 18, 'Incheon', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3889, 19, 'Kangneung', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3890, 20, 'Kimhae', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3891, 21, 'Koyang', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3892, 22, 'Kumi', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3893, 23, 'Kunpo', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3894, 24, 'Kunsan', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3895, 25, 'Kuri', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3896, 26, 'Kwangju', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3897, 27, 'Kwangmyeong', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3898, 28, 'Kyeongju', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3899, 29, 'Masan', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3900, 30, 'Mokpo', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3901, 31, 'Pohang', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3902, 32, 'Poryong', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3903, 33, 'Pucheon', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3904, 34, 'Pusan', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3905, 35, 'Pyeongtaek', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3906, 36, 'Seongnam', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3907, 37, 'Seoul', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3908, 38, 'Shiheung', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3909, 39, 'Suncheon', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3910, 40, 'Suweon', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3911, 41, 'Taegu', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3912, 42, 'Taejeon', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3913, 43, 'Tongyong', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3914, 44, 'Ulsan', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3915, 45, 'Weonju', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3916, 46, 'Yeosu', 'kr', 'Korea (South)');
INSERT INTO nuke_cities VALUES (3917, 1, 'Abraq Khîtân', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3918, 2, 'al-Ahmadî', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3919, 3, 'al-Farwânîyah', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3920, 4, 'al-Fuhayhîl', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3921, 5, 'al-Jabirîyah', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3922, 6, 'al-Jahrâ', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3923, 7, 'al-Karîm', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3924, 8, 'al-Kuwayt', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3925, 9, 'al-Qusayr', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3926, 10, 'Ardîyah', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3927, 11, 'ar-Riqqah', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3928, 12, 'ar-Rumaythiyah', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3929, 13, 'as-Sabahîyah', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3930, 14, 'as-Sâlimîyah', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3931, 15, 'as-Sulaybîyah', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3932, 16, 'Fardaws', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3933, 17, 'Hawallî', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3934, 18, 'Jalîb ash-Shuyûh', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3935, 19, 'Khîtân-al-Janûbîyah', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3936, 20, 'Salwâ\'', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3937, 21, 'Subbah-as-Salim', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3938, 22, 'Tayma´', 'kw', 'Kuwait');
INSERT INTO nuke_cities VALUES (3939, 1, 'Balykchy', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3940, 2, 'Batken', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3941, 3, 'Bazarkurgon', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3942, 4, 'Belovodskoye', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3943, 5, 'Bishkek', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3944, 6, 'Chui', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3945, 7, 'Jalal-Abad', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3946, 8, 'Kant', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3947, 9, 'Karabalta', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3948, 10, 'Karakol', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3949, 11, 'Kara-Suu', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3950, 12, 'Kemin', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3951, 13, 'Kyzyl-Kiya', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3952, 14, 'Mingkush', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3953, 15, 'Naryn', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3954, 16, 'Osh', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3955, 17, 'Sokuluk', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3956, 18, 'Talas', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3957, 19, 'Tash-Kumyr', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3958, 20, 'Tokmok', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3959, 21, 'Uzgen', 'kg', 'Kyrgyzstan');
INSERT INTO nuke_cities VALUES (3960, 1, 'Ban Nahin', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3961, 2, 'Champasak', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3962, 3, 'Huayxay', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3963, 4, 'Luang Prabang', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3964, 5, 'Muang Khong', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3965, 6, 'Muang Khongxedon', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3966, 7, 'Muang Sing', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3967, 8, 'Muang Vangviang', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3968, 9, 'Nam Tha', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3969, 10, 'Pakxan', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3970, 11, 'Pakxe', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3971, 12, 'Pek', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3972, 13, 'Phongsaly', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3973, 14, 'Phonhong', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3974, 15, 'Samakhixai', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3975, 16, 'Saravan', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3976, 17, 'Savannakhet', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3977, 18, 'Sekong', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3978, 19, 'Thakek', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3979, 20, 'Viangchan', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3980, 21, 'Xaignabury', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3981, 22, 'Xam Nua', 'la', 'Laos');
INSERT INTO nuke_cities VALUES (3982, 1, 'Aizkraukle', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (3983, 2, 'Alûksne', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (3984, 3, 'Balvi', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (3985, 4, 'Bauska', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (3986, 5, 'Cêsis', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (3987, 6, 'Daugavpils', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (3988, 7, 'Dôbele', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (3989, 8, 'Gulbene', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (3990, 9, 'Jêkabspils', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (3991, 10, 'Jelgava', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (3992, 11, 'Jûrmala', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (3993, 12, 'Krâslava', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (3994, 13, 'Kuldîga', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (3995, 14, 'Liepâja', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (3996, 15, 'Limbazhi', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (3997, 16, 'Ludza', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (3998, 17, 'Madona', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (3999, 18, 'Ogre', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (4000, 19, 'Olaine', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (4001, 20, 'Preili', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (4002, 21, 'Rêzekne', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (4003, 22, 'Rîga', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (4004, 23, 'Salaspils', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (4005, 24, 'Saldus', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (4006, 25, 'Talsi', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (4007, 26, 'Tukums', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (4008, 27, 'Valka', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (4009, 28, 'Valmiera', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (4010, 29, 'Ventspils', 'lv', 'Latvia');
INSERT INTO nuke_cities VALUES (4011, 1, '´Âlayh', 'lb', 'Lebanon');
INSERT INTO nuke_cities VALUES (4012, 2, 'al-Batrun', 'lb', 'Lebanon');
INSERT INTO nuke_cities VALUES (4013, 3, 'al-Hirmil', 'lb', 'Lebanon');
INSERT INTO nuke_cities VALUES (4014, 4, 'an-Nabatîyat-at-Tahtâ', 'lb', 'Lebanon');
INSERT INTO nuke_cities VALUES (4015, 5, 'B´abda', 'lb', 'Lebanon');
INSERT INTO nuke_cities VALUES (4016, 6, 'Ba´labakk', 'lb', 'Lebanon');
INSERT INTO nuke_cities VALUES (4017, 7, 'Bayrût', 'lb', 'Lebanon');
INSERT INTO nuke_cities VALUES (4018, 8, 'Jazzîn', 'lb', 'Lebanon');
INSERT INTO nuke_cities VALUES (4019, 9, 'Jubayl', 'lb', 'Lebanon');
INSERT INTO nuke_cities VALUES (4020, 10, 'Jubb Jannin', 'lb', 'Lebanon');
INSERT INTO nuke_cities VALUES (4021, 11, 'Jûniyah', 'lb', 'Lebanon');
INSERT INTO nuke_cities VALUES (4022, 12, 'Juwayyâ', 'lb', 'Lebanon');
INSERT INTO nuke_cities VALUES (4023, 13, 'Marj ´Uyun', 'lb', 'Lebanon');
INSERT INTO nuke_cities VALUES (4024, 14, 'Râshayyâ', 'lb', 'Lebanon');
INSERT INTO nuke_cities VALUES (4025, 15, 'Rîyâk', 'lb', 'Lebanon');
INSERT INTO nuke_cities VALUES (4026, 16, 'Saydâ\'', 'lb', 'Lebanon');
INSERT INTO nuke_cities VALUES (4027, 17, 'Sûr', 'lb', 'Lebanon');
INSERT INTO nuke_cities VALUES (4028, 18, 'Tarâbulus ash-Sham', 'lb', 'Lebanon');
INSERT INTO nuke_cities VALUES (4029, 19, 'Zahlah', 'lb', 'Lebanon');
INSERT INTO nuke_cities VALUES (4030, 1, 'Butha Buthe', 'ls', 'Lesotho');
INSERT INTO nuke_cities VALUES (4031, 2, 'Hlotse', 'ls', 'Lesotho');
INSERT INTO nuke_cities VALUES (4032, 3, 'Mafeteng', 'ls', 'Lesotho');
INSERT INTO nuke_cities VALUES (4033, 4, 'Maputsoa', 'ls', 'Lesotho');
INSERT INTO nuke_cities VALUES (4034, 5, 'Maseru', 'ls', 'Lesotho');
INSERT INTO nuke_cities VALUES (4035, 6, 'Mohale\'s Hoek', 'ls', 'Lesotho');
INSERT INTO nuke_cities VALUES (4036, 7, 'Mokhotlong', 'ls', 'Lesotho');
INSERT INTO nuke_cities VALUES (4037, 8, 'Qacha\'s Nek', 'ls', 'Lesotho');
INSERT INTO nuke_cities VALUES (4038, 9, 'Quthing', 'ls', 'Lesotho');
INSERT INTO nuke_cities VALUES (4039, 10, 'Teyateyaneng', 'ls', 'Lesotho');
INSERT INTO nuke_cities VALUES (4040, 11, 'Thaba-Tseka', 'ls', 'Lesotho');
INSERT INTO nuke_cities VALUES (4041, 1, 'Barclayville', 'lr', 'Liberia');
INSERT INTO nuke_cities VALUES (4042, 2, 'Bensonville', 'lr', 'Liberia');
INSERT INTO nuke_cities VALUES (4043, 3, 'Buchanan', 'lr', 'Liberia');
INSERT INTO nuke_cities VALUES (4044, 4, 'Ganta', 'lr', 'Liberia');
INSERT INTO nuke_cities VALUES (4045, 5, 'Gbarnga', 'lr', 'Liberia');
INSERT INTO nuke_cities VALUES (4046, 6, 'Greenville', 'lr', 'Liberia');
INSERT INTO nuke_cities VALUES (4047, 7, 'Harbel', 'lr', 'Liberia');
INSERT INTO nuke_cities VALUES (4048, 8, 'Harper', 'lr', 'Liberia');
INSERT INTO nuke_cities VALUES (4049, 9, 'Kakata', 'lr', 'Liberia');
INSERT INTO nuke_cities VALUES (4050, 10, 'Monrovia', 'lr', 'Liberia');
INSERT INTO nuke_cities VALUES (4051, 11, 'Rivercess', 'lr', 'Liberia');
INSERT INTO nuke_cities VALUES (4052, 12, 'Robertsport', 'lr', 'Liberia');
INSERT INTO nuke_cities VALUES (4053, 13, 'Sanniquellie', 'lr', 'Liberia');
INSERT INTO nuke_cities VALUES (4054, 14, 'Tapeta', 'lr', 'Liberia');
INSERT INTO nuke_cities VALUES (4055, 15, 'Tubmanburg', 'lr', 'Liberia');
INSERT INTO nuke_cities VALUES (4056, 16, 'Voinjama', 'lr', 'Liberia');
INSERT INTO nuke_cities VALUES (4057, 17, 'Yekepa', 'lr', 'Liberia');
INSERT INTO nuke_cities VALUES (4058, 18, 'Zwedru', 'lr', 'Liberia');
INSERT INTO nuke_cities VALUES (4059, 1, 'Ajdâbiyâ', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4060, 2, 'al-Azîzîyah', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4061, 3, 'al-Baydâ', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4062, 4, 'al-Jawf', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4063, 5, 'al-Khums', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4064, 6, 'al-Marj', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4065, 7, 'Awbâri', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4066, 8, 'az-Zâwiyah', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4067, 9, 'Banghâzî', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4068, 10, 'Banî Walîd', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4069, 11, 'Birâk', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4070, 12, 'Darnah', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4071, 13, 'Ghadâmis', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4072, 14, 'Gharyân', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4073, 15, 'Misrâtah', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4074, 16, 'Murzûq', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4075, 17, 'Sabhâ', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4076, 18, 'Sabrâtah', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4077, 19, 'Surt', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4078, 20, 'Tarâbulus', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4079, 21, 'Tarhûnah', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4080, 22, 'Tubruq', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4081, 23, 'Waddân', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4082, 24, 'Yafran', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4083, 25, 'Zlîtan', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4084, 26, 'Zuwârah', 'ly', 'Libya');
INSERT INTO nuke_cities VALUES (4085, 1, 'Balzers', 'li', 'Liechtenstein');
INSERT INTO nuke_cities VALUES (4086, 2, 'Eschen', 'li', 'Liechtenstein');
INSERT INTO nuke_cities VALUES (4087, 3, 'Gamprin', 'li', 'Liechtenstein');
INSERT INTO nuke_cities VALUES (4088, 4, 'Mauren', 'li', 'Liechtenstein');
INSERT INTO nuke_cities VALUES (4089, 5, 'Planken', 'li', 'Liechtenstein');
INSERT INTO nuke_cities VALUES (4090, 6, 'Ruggell', 'li', 'Liechtenstein');
INSERT INTO nuke_cities VALUES (4091, 7, 'Schaan', 'li', 'Liechtenstein');
INSERT INTO nuke_cities VALUES (4092, 8, 'Schellenberg', 'li', 'Liechtenstein');
INSERT INTO nuke_cities VALUES (4093, 9, 'Triesen', 'li', 'Liechtenstein');
INSERT INTO nuke_cities VALUES (4094, 10, 'Triesenberg', 'li', 'Liechtenstein');
INSERT INTO nuke_cities VALUES (4095, 11, 'Vaduz', 'li', 'Liechtenstein');
INSERT INTO nuke_cities VALUES (4096, 1, 'Alytus', 'lt', 'Lithuania');
INSERT INTO nuke_cities VALUES (4097, 2, 'Druskininkai', 'lt', 'Lithuania');
INSERT INTO nuke_cities VALUES (4098, 3, 'Jonava', 'lt', 'Lithuania');
INSERT INTO nuke_cities VALUES (4099, 4, 'Kaunas', 'lt', 'Lithuania');
INSERT INTO nuke_cities VALUES (4100, 5, 'Kedainiai', 'lt', 'Lithuania');
INSERT INTO nuke_cities VALUES (4101, 6, 'Klaipeda', 'lt', 'Lithuania');
INSERT INTO nuke_cities VALUES (4102, 7, 'Kretinga', 'lt', 'Lithuania');
INSERT INTO nuke_cities VALUES (4103, 8, 'Marijampole', 'lt', 'Lithuania');
INSERT INTO nuke_cities VALUES (4104, 9, 'Mazheikiai', 'lt', 'Lithuania');
INSERT INTO nuke_cities VALUES (4105, 10, 'Panevezhys', 'lt', 'Lithuania');
INSERT INTO nuke_cities VALUES (4106, 11, 'Plunge', 'lt', 'Lithuania');
INSERT INTO nuke_cities VALUES (4107, 12, 'Radvilishkis', 'lt', 'Lithuania');
INSERT INTO nuke_cities VALUES (4108, 13, 'Shiauliai', 'lt', 'Lithuania');
INSERT INTO nuke_cities VALUES (4109, 14, 'Shilute', 'lt', 'Lithuania');
INSERT INTO nuke_cities VALUES (4110, 15, 'Taurage', 'lt', 'Lithuania');
INSERT INTO nuke_cities VALUES (4111, 16, 'Telshiai', 'lt', 'Lithuania');
INSERT INTO nuke_cities VALUES (4112, 17, 'Ukmerge', 'lt', 'Lithuania');
INSERT INTO nuke_cities VALUES (4113, 18, 'Utena', 'lt', 'Lithuania');
INSERT INTO nuke_cities VALUES (4114, 19, 'Vilnius', 'lt', 'Lithuania');
INSERT INTO nuke_cities VALUES (4115, 20, 'Visaginas', 'lt', 'Lithuania');
INSERT INTO nuke_cities VALUES (4116, 1, 'Bascharage', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4117, 2, 'Belvaux', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4118, 3, 'Bertrange', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4119, 4, 'Bettembourg', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4120, 5, 'Capellen', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4121, 6, 'Clervaux', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4122, 7, 'Diekirch', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4123, 8, 'Differdange', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4124, 9, 'Dudelange', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4125, 10, 'Echternach', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4126, 11, 'Esch-Alzette', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4127, 12, 'Ettelbruck', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4128, 13, 'Fousbann', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4129, 14, 'Grevenmacher', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4130, 15, 'Luxembourg', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4131, 16, 'Mamer', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4132, 17, 'Mersch', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4133, 18, 'Obercorn', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4134, 19, 'Pétange', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4135, 20, 'Redange', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4136, 21, 'Remich', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4137, 22, 'Rodange', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4138, 23, 'Schifflange', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4139, 24, 'Soleuvre', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4140, 25, 'Strassen', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4141, 26, 'Vianden', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4142, 27, 'Wiltz', 'lu', 'Luxembourg');
INSERT INTO nuke_cities VALUES (4143, 1, 'Berovo', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4144, 2, 'Bitola', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4145, 3, 'Brod', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4146, 4, 'Debar', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4147, 5, 'Delchevo', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4148, 6, 'Demir Hisar', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4149, 7, 'Gevgelija', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4150, 8, 'Gostivar', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4151, 9, 'Kavadarci', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4152, 10, 'Kichevo', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4153, 11, 'Kochani', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4154, 12, 'Kratovo', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4155, 13, 'Kriva Palanka', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4156, 14, 'Krushevo', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4157, 15, 'Kumanovo', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4158, 16, 'Negotino', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4159, 17, 'Ohrid', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4160, 18, 'Prilep', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4161, 19, 'Probishtip', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4162, 20, 'Radovish', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4163, 21, 'Resen', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4164, 22, 'Saraj', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4165, 23, 'Shtip', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4166, 24, 'Skopje', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4167, 25, 'Struga', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4168, 26, 'Strumica', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4169, 27, 'Sveti Nikole', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4170, 28, 'Tetovo', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4171, 29, 'Valandovo', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4172, 30, 'Veles', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4173, 31, 'Vinica', 'mk', 'Macedonia');
INSERT INTO nuke_cities VALUES (4174, 1, 'Ambatondrazaka', 'mg', 'Madagascar');
INSERT INTO nuke_cities VALUES (4175, 2, 'Ambovombe', 'mg', 'Madagascar');
INSERT INTO nuke_cities VALUES (4176, 3, 'Amparafaravola', 'mg', 'Madagascar');
INSERT INTO nuke_cities VALUES (4177, 4, 'Antananarivo', 'mg', 'Madagascar');
INSERT INTO nuke_cities VALUES (4178, 5, 'Antanifotsy', 'mg', 'Madagascar');
INSERT INTO nuke_cities VALUES (4179, 6, 'Antsirabé', 'mg', 'Madagascar');
INSERT INTO nuke_cities VALUES (4180, 7, 'Antsiranana', 'mg', 'Madagascar');
INSERT INTO nuke_cities VALUES (4181, 8, 'Faratsiho', 'mg', 'Madagascar');
INSERT INTO nuke_cities VALUES (4182, 9, 'Fianarantsoa', 'mg', 'Madagascar');
INSERT INTO nuke_cities VALUES (4183, 10, 'Mahajanga', 'mg', 'Madagascar');
INSERT INTO nuke_cities VALUES (4184, 11, 'Mahanoro', 'mg', 'Madagascar');
INSERT INTO nuke_cities VALUES (4185, 12, 'Manakara', 'mg', 'Madagascar');
INSERT INTO nuke_cities VALUES (4186, 13, 'Mananara', 'mg', 'Madagascar');
INSERT INTO nuke_cities VALUES (4187, 14, 'Morondava', 'mg', 'Madagascar');
INSERT INTO nuke_cities VALUES (4188, 15, 'Nosy Varika', 'mg', 'Madagascar');
INSERT INTO nuke_cities VALUES (4189, 16, 'Soanierana Ivongo', 'mg', 'Madagascar');
INSERT INTO nuke_cities VALUES (4190, 17, 'Soavinandriana', 'mg', 'Madagascar');
INSERT INTO nuke_cities VALUES (4191, 18, 'Taolanaro', 'mg', 'Madagascar');
INSERT INTO nuke_cities VALUES (4192, 19, 'Toamasina', 'mg', 'Madagascar');
INSERT INTO nuke_cities VALUES (4193, 20, 'Toliary', 'mg', 'Madagascar');
INSERT INTO nuke_cities VALUES (4194, 1, 'Balaka', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4195, 2, 'Blantyre', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4196, 3, 'Chikwawa', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4197, 4, 'Chilumba', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4198, 5, 'Chiradzulu', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4199, 6, 'Chitipa', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4200, 7, 'Dedza', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4201, 8, 'Dowa', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4202, 9, 'Karonga', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4203, 10, 'Kasungu', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4204, 11, 'Lilongwe', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4205, 12, 'Liwonde', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4206, 13, 'Machinga', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4207, 14, 'Mangochi', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4208, 15, 'Mchinji', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4209, 16, 'Mponela', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4210, 17, 'Mulanje', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4211, 18, 'Mwanza', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4212, 19, 'Mzimba', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4213, 20, 'Mzuzu', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4214, 21, 'Nkhata Bay', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4215, 22, 'Nkhotakota', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4216, 23, 'Nsanje', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4217, 24, 'Ntcheu', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4218, 25, 'Ntchisi', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4219, 26, 'Phalombe', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4220, 27, 'Rumphi', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4221, 28, 'Salima', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4222, 29, 'Thyolo', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4223, 30, 'Zomba', 'mw', 'Malawi');
INSERT INTO nuke_cities VALUES (4224, 1, 'Alor Setar', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4225, 2, 'Ampang Jaya', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4226, 3, 'Ayer Itam', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4227, 4, 'Bandar Maharani', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4228, 5, 'Bandar Penggaram', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4229, 6, 'Batu Sembilan Cheras', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4230, 7, 'Bintulu', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4231, 8, 'Bukit Mertajam', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4232, 9, 'Butterworth', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4233, 10, 'Gelugor', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4234, 11, 'Georgetown', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4235, 12, 'Ipoh', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4236, 13, 'Johor Bahru', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4237, 14, 'Kajang-Sungai Chua', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4238, 15, 'Kangar', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4239, 16, 'Klang', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4240, 17, 'Kluang', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4241, 18, 'Kota Bahru', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4242, 19, 'Kota Kinabalu', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4243, 20, 'Kuala Lumpur', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4244, 21, 'Kuala Terengganu', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4245, 22, 'Kuantan', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4246, 23, 'Kuching', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4247, 24, 'Kulim', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4248, 25, 'Labuan', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4249, 26, 'Melaka', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4250, 27, 'Miri', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4251, 28, 'Petaling Jaya', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4252, 29, 'Sandakan', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4253, 30, 'Sekudai', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4254, 31, 'Selayang Baru', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4255, 32, 'Seremban', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4256, 33, 'Shah Alam', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4257, 34, 'Sibu', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4258, 35, 'Subang Jaya', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4259, 36, 'Sungai Ara', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4260, 37, 'Sungai Petani', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4261, 38, 'Taiping', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4262, 39, 'Tawau', 'my', 'Malaysia');
INSERT INTO nuke_cities VALUES (4263, 1, 'Dhidhdhoo', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4264, 2, 'Eydhafushi', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4265, 3, 'Felidhoo', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4266, 4, 'Feydhoo', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4267, 5, 'Fonadhoo', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4268, 6, 'Funadhoo', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4269, 7, 'Fuvammulah', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4270, 8, 'Gamu', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4271, 9, 'Hinnavaru', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4272, 10, 'Hithadhoo', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4273, 11, 'Hoarafushi', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4274, 12, 'Ihavandhoo', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4275, 13, 'Kadholhudhoo', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4276, 14, 'Kudahuvadhoo', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4277, 15, 'Kulhudhuffushi', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4278, 16, 'Maafushi', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4279, 17, 'Magoodhoo', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4280, 18, 'Mahibadhoo', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4281, 19, 'Malé', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4282, 20, 'Manadhoo', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4283, 21, 'Maradhoo', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4284, 22, 'Muli', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4285, 23, 'Naifaru', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4286, 24, 'Rasdhoo', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4287, 25, 'Thinadhoo', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4288, 26, 'Thulhaadhoo', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4289, 27, 'Thulusdhoo', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4290, 28, 'Ugoofaaru', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4291, 29, 'Velidhoo', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4292, 30, 'Veymandhoo', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4293, 31, 'Viligili', 'mv', 'Maldives');
INSERT INTO nuke_cities VALUES (4294, 1, 'Bafoulabé', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4295, 2, 'Bamako', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4296, 3, 'Banamba', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4297, 4, 'Bougouni', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4298, 5, 'Djenné', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4299, 6, 'Gao', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4300, 7, 'Kati', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4301, 8, 'Kayes', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4302, 9, 'Kidal', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4303, 10, 'Kolokani', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4304, 11, 'Koulikoro', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4305, 12, 'Koutiala', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4306, 13, 'Markala', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4307, 14, 'Mopti', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4308, 15, 'Nara', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4309, 16, 'Niono', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4310, 17, 'Nioro', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4311, 18, 'San', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4312, 19, 'Ségou', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4313, 20, 'Sikasso', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4314, 21, 'Tombouctou', 'ml', 'Mali');
INSERT INTO nuke_cities VALUES (4315, 1, 'Attard', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4316, 2, 'Birkirkara', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4317, 3, 'Birzebugia', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4318, 4, 'Fgura', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4319, 5, 'Gzira', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4320, 6, 'Hamrun', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4321, 7, 'Mosta', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4322, 8, 'Naxxar', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4323, 9, 'Paola', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4324, 10, 'Qormi', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4325, 11, 'Rabat', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4326, 12, 'Rabat', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4327, 13, 'San Gwann', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4328, 14, 'San Pawl il-Bahar', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4329, 15, 'Sighghiewi', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4330, 16, 'Sliema', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4331, 17, 'Tarxien', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4332, 18, 'Valletta', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4333, 19, 'Zabbar', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4334, 20, 'Zebbug', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4335, 21, 'Zejtun', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4336, 22, 'Zurrieq', 'mt', 'Malta');
INSERT INTO nuke_cities VALUES (4337, 1, 'Castletown', 'xm', 'Man (Isle of)');
INSERT INTO nuke_cities VALUES (4338, 2, 'Douglas', 'xm', 'Man (Isle of)');
INSERT INTO nuke_cities VALUES (4339, 3, 'Laxey', 'xm', 'Man (Isle of)');
INSERT INTO nuke_cities VALUES (4340, 4, 'Onchan', 'xm', 'Man (Isle of)');
INSERT INTO nuke_cities VALUES (4341, 5, 'Peel', 'xm', 'Man (Isle of)');
INSERT INTO nuke_cities VALUES (4342, 6, 'Port Erin', 'xm', 'Man (Isle of)');
INSERT INTO nuke_cities VALUES (4343, 7, 'Port Saint Mary', 'xm', 'Man (Isle of)');
INSERT INTO nuke_cities VALUES (4344, 8, 'Ramsey', 'xm', 'Man (Isle of)');
INSERT INTO nuke_cities VALUES (4345, 1, 'Aerok', 'mh', 'Marshall Islands');
INSERT INTO nuke_cities VALUES (4346, 2, 'Ailuk', 'mh', 'Marshall Islands');
INSERT INTO nuke_cities VALUES (4347, 3, 'Ajeltake', 'mh', 'Marshall Islands');
INSERT INTO nuke_cities VALUES (4348, 4, 'Ebeye', 'mh', 'Marshall Islands');
INSERT INTO nuke_cities VALUES (4349, 5, 'Enewetak', 'mh', 'Marshall Islands');
INSERT INTO nuke_cities VALUES (4350, 6, 'Enubirr', 'mh', 'Marshall Islands');
INSERT INTO nuke_cities VALUES (4351, 7, 'Jabwor', 'mh', 'Marshall Islands');
INSERT INTO nuke_cities VALUES (4352, 8, 'Kili', 'mh', 'Marshall Islands');
INSERT INTO nuke_cities VALUES (4353, 9, 'Laura', 'mh', 'Marshall Islands');
INSERT INTO nuke_cities VALUES (4354, 10, 'Likiep', 'mh', 'Marshall Islands');
INSERT INTO nuke_cities VALUES (4355, 11, 'Mejatto', 'mh', 'Marshall Islands');
INSERT INTO nuke_cities VALUES (4356, 12, 'Mejit', 'mh', 'Marshall Islands');
INSERT INTO nuke_cities VALUES (4357, 13, 'Mili', 'mh', 'Marshall Islands');
INSERT INTO nuke_cities VALUES (4358, 14, 'Namorik', 'mh', 'Marshall Islands');
INSERT INTO nuke_cities VALUES (4359, 15, 'Rita', 'mh', 'Marshall Islands');
INSERT INTO nuke_cities VALUES (4360, 16, 'Ujae', 'mh', 'Marshall Islands');
INSERT INTO nuke_cities VALUES (4361, 17, 'Utirik', 'mh', 'Marshall Islands');
INSERT INTO nuke_cities VALUES (4362, 18, 'Woja', 'mh', 'Marshall Islands');
INSERT INTO nuke_cities VALUES (4363, 19, 'Woja', 'mh', 'Marshall Islands');
INSERT INTO nuke_cities VALUES (4364, 20, 'Wotje', 'mh', 'Marshall Islands');
INSERT INTO nuke_cities VALUES (4365, 1, 'Ducos', 'mq', 'Martinique');
INSERT INTO nuke_cities VALUES (4366, 2, 'Fort-de-France', 'mq', 'Martinique');
INSERT INTO nuke_cities VALUES (4367, 3, 'Gros-Morne', 'mq', 'Martinique');
INSERT INTO nuke_cities VALUES (4368, 4, 'La Trinité', 'mq', 'Martinique');
INSERT INTO nuke_cities VALUES (4369, 5, 'Le François', 'mq', 'Martinique');
INSERT INTO nuke_cities VALUES (4370, 6, 'Le Lamentin', 'mq', 'Martinique');
INSERT INTO nuke_cities VALUES (4371, 7, 'Le Lorrain', 'mq', 'Martinique');
INSERT INTO nuke_cities VALUES (4372, 8, 'Le Marin', 'mq', 'Martinique');
INSERT INTO nuke_cities VALUES (4373, 9, 'Le Morne-Rouge', 'mq', 'Martinique');
INSERT INTO nuke_cities VALUES (4374, 10, 'Le Robert', 'mq', 'Martinique');
INSERT INTO nuke_cities VALUES (4375, 11, 'Le Vauclin', 'mq', 'Martinique');
INSERT INTO nuke_cities VALUES (4376, 12, 'Les Trois-Îlets', 'mq', 'Martinique');
INSERT INTO nuke_cities VALUES (4377, 13, 'Rivière-Pilote', 'mq', 'Martinique');
INSERT INTO nuke_cities VALUES (4378, 14, 'Rivière-Salée', 'mq', 'Martinique');
INSERT INTO nuke_cities VALUES (4379, 15, 'Sainte-Luce', 'mq', 'Martinique');
INSERT INTO nuke_cities VALUES (4380, 16, 'Sainte-Marie', 'mq', 'Martinique');
INSERT INTO nuke_cities VALUES (4381, 17, 'Saint-Esprit', 'mq', 'Martinique');
INSERT INTO nuke_cities VALUES (4382, 18, 'Saint-Joseph', 'mq', 'Martinique');
INSERT INTO nuke_cities VALUES (4383, 19, 'Saint-Pierre', 'mq', 'Martinique');
INSERT INTO nuke_cities VALUES (4384, 20, 'Schoelcher', 'mq', 'Martinique');
INSERT INTO nuke_cities VALUES (4385, 1, '´Ayûn-al-´Atrûs', 'mr', 'Mauritania');
INSERT INTO nuke_cities VALUES (4386, 2, 'Alaq', 'mr', 'Mauritania');
INSERT INTO nuke_cities VALUES (4387, 3, 'an-Na´mah', 'mr', 'Mauritania');
INSERT INTO nuke_cities VALUES (4388, 4, 'Aqjawajat', 'mr', 'Mauritania');
INSERT INTO nuke_cities VALUES (4389, 5, 'Âtâr', 'mr', 'Mauritania');
INSERT INTO nuke_cities VALUES (4390, 6, 'Buqah', 'mr', 'Mauritania');
INSERT INTO nuke_cities VALUES (4391, 7, 'Fdayrik', 'mr', 'Mauritania');
INSERT INTO nuke_cities VALUES (4392, 8, 'Hsay Wâlad ´Alî Bâbî', 'mr', 'Mauritania');
INSERT INTO nuke_cities VALUES (4393, 9, 'Kayhaydi', 'mr', 'Mauritania');
INSERT INTO nuke_cities VALUES (4394, 10, 'Kîfah', 'mr', 'Mauritania');
INSERT INTO nuke_cities VALUES (4395, 11, 'Kubanni', 'mr', 'Mauritania');
INSERT INTO nuke_cities VALUES (4396, 12, 'Magta´ Lahjar', 'mr', 'Mauritania');
INSERT INTO nuke_cities VALUES (4397, 13, 'Nawadhîbu', 'mr', 'Mauritania');
INSERT INTO nuke_cities VALUES (4398, 14, 'Nawâkshût', 'mr', 'Mauritania');
INSERT INTO nuke_cities VALUES (4399, 15, 'Rûsû', 'mr', 'Mauritania');
INSERT INTO nuke_cities VALUES (4400, 16, 'Shingati', 'mr', 'Mauritania');
INSERT INTO nuke_cities VALUES (4401, 17, 'Tijiqjah', 'mr', 'Mauritania');
INSERT INTO nuke_cities VALUES (4402, 18, 'Timbédra', 'mr', 'Mauritania');
INSERT INTO nuke_cities VALUES (4403, 19, 'Walâtah', 'mr', 'Mauritania');
INSERT INTO nuke_cities VALUES (4404, 20, 'Zuwârat', 'mr', 'Mauritania');
INSERT INTO nuke_cities VALUES (4405, 1, 'Baie du Tombeau', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4406, 2, 'Bambous', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4407, 3, 'Beau Bassin-Rose Hill', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4408, 4, 'Bel Air', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4409, 5, 'Central Flacq', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4410, 6, 'Chemin Grenier', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4411, 7, 'Curepipe', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4412, 8, 'Goodlands', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4413, 9, 'Grand Baie', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4414, 10, 'Le Hochet', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4415, 11, 'Mahébourg', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4416, 12, 'Moka', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4417, 13, 'Pailles', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4418, 14, 'Pamplemousse', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4419, 15, 'Plaine Magnien', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4420, 16, 'Port Louis', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4421, 17, 'Port Mathurin', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4422, 18, 'Poudre d\'Or', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4423, 19, 'Quatre Bornes', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4424, 20, 'Rose Belle', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4425, 21, 'Saint Pierre', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4426, 22, 'Souillac', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4427, 23, 'Surinam', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4428, 24, 'Tamarin', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4429, 25, 'Triolet', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4430, 26, 'Vascoas-Phoenix', 'mu', 'Mauritius');
INSERT INTO nuke_cities VALUES (4431, 1, 'Acoua', 'yt', 'Mayotte');
INSERT INTO nuke_cities VALUES (4432, 2, 'Bandraboua', 'yt', 'Mayotte');
INSERT INTO nuke_cities VALUES (4433, 3, 'Bandrélé', 'yt', 'Mayotte');
INSERT INTO nuke_cities VALUES (4434, 4, 'Bouéni', 'yt', 'Mayotte');
INSERT INTO nuke_cities VALUES (4435, 5, 'Chiconi', 'yt', 'Mayotte');
INSERT INTO nuke_cities VALUES (4436, 6, 'Chirongui', 'yt', 'Mayotte');
INSERT INTO nuke_cities VALUES (4437, 7, 'Dembéni', 'yt', 'Mayotte');
INSERT INTO nuke_cities VALUES (4438, 8, 'Dzaoudzi', 'yt', 'Mayotte');
INSERT INTO nuke_cities VALUES (4439, 9, 'Kanikéli', 'yt', 'Mayotte');
INSERT INTO nuke_cities VALUES (4440, 10, 'Koungou', 'yt', 'Mayotte');
INSERT INTO nuke_cities VALUES (4441, 11, 'Mamoudzou', 'yt', 'Mayotte');
INSERT INTO nuke_cities VALUES (4442, 12, 'Mtsamboro', 'yt', 'Mayotte');
INSERT INTO nuke_cities VALUES (4443, 13, 'Mtsangamouji', 'yt', 'Mayotte');
INSERT INTO nuke_cities VALUES (4444, 14, 'Ouangani', 'yt', 'Mayotte');
INSERT INTO nuke_cities VALUES (4445, 15, 'Pamanzi', 'yt', 'Mayotte');
INSERT INTO nuke_cities VALUES (4446, 16, 'Sada', 'yt', 'Mayotte');
INSERT INTO nuke_cities VALUES (4447, 17, 'Tsingoni', 'yt', 'Mayotte');
INSERT INTO nuke_cities VALUES (4448, 1, 'Acapulco', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4449, 2, 'Acuña', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4450, 3, 'Aguascalientes', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4451, 4, 'Apodaca', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4452, 5, 'Buenavista', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4453, 6, 'Campeche', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4454, 7, 'Cancún', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4455, 8, 'Carmen', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4456, 9, 'Celaya', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4457, 10, 'Chalco', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4458, 11, 'Chetumal', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4459, 12, 'Chihuahua', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4460, 13, 'Chilpancingo', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4461, 14, 'Chimalhuacán', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4462, 15, 'Ciudad Valles', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4463, 16, 'Coacalco', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4464, 17, 'Coatzacoalcos', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4465, 18, 'Colima', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4466, 19, 'Córdoba', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4467, 20, 'Cuautitlán Izcalli', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4468, 21, 'Cuautla', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4469, 22, 'Cuernavaca', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4470, 23, 'Culiacán', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4471, 24, 'Delicias', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4472, 25, 'Durango', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4473, 26, 'Ecatepec', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4474, 27, 'Ensenada', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4475, 28, 'Fresnillo', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4476, 29, 'Garza García', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4477, 30, 'General Escobedo', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4478, 31, 'Gómez Palacio', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4479, 32, 'Guadalajara', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4480, 33, 'Guadalupe', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4481, 34, 'Guanajuato', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4482, 35, 'Guaymas', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4483, 36, 'Hermosillo', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4484, 37, 'Hidalgo', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4485, 38, 'Huixquilucan', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4486, 39, 'Iguala', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4487, 40, 'Irapuato', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4488, 41, 'Ixtapaluca', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4489, 42, 'Jiutepec', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4490, 43, 'Juárez', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4491, 44, 'La Paz', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4492, 45, 'León', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4493, 46, 'López Mateos', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4494, 47, 'Los Mochis', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4495, 48, 'Los Reyes', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4496, 49, 'Madero', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4497, 50, 'Manzanillo', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4498, 51, 'Matamoros', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4499, 52, 'Mazatlán', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4500, 53, 'Mérida', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4501, 54, 'Metepec', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4502, 55, 'Mexicali', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4503, 56, 'México', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4504, 57, 'Minatitlán', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4505, 58, 'Monclova', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4506, 59, 'Monterrey', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4507, 60, 'Morelia', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4508, 61, 'Naucalpan', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4509, 62, 'Navajoa', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4510, 63, 'Nezahualcóyotl', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4511, 64, 'Nicolás Romero', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4512, 65, 'Nogales', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4513, 66, 'Nuevo Laredo', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4514, 67, 'Oaxaca', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4515, 68, 'Obregón', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4516, 69, 'Orizaba', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4517, 70, 'Pachuca', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4518, 71, 'Piedras Negras', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4519, 72, 'Poza Rica', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4520, 73, 'Puebla', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4521, 74, 'Puerto Vallarta', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4522, 75, 'Querétaro', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4523, 76, 'Reynosa', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4524, 77, 'Salamanca', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4525, 78, 'Saltillo', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4526, 79, 'San Cristóbal de las Casas', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4527, 80, 'San Juan del Río', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4528, 81, 'San Luis Potosí', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4529, 82, 'San Luis Río Colorado', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4530, 83, 'San Nicolás de los Garza', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4531, 84, 'San Pablo de las Salinas', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4532, 85, 'Santa Catarina', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4533, 86, 'Soledad', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4534, 87, 'Tampico', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4535, 88, 'Tapachula', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4536, 89, 'Tehuacán', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4537, 90, 'Tepic', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4538, 91, 'Texcoco', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4539, 92, 'Tijuana', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4540, 93, 'Tlalnepantla', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4541, 94, 'Tlaquepaque', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4542, 95, 'Tlaxcala', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4543, 96, 'Toluca', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4544, 97, 'Tonalá', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4545, 98, 'Torreón', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4546, 99, 'Tuxtla Gutiérrez', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4547, 100, 'Uruapan', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4548, 101, 'Veracruz', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4549, 102, 'Victoria', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4550, 103, 'Villahermosa', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4551, 104, 'Xalapa', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4552, 105, 'Xico', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4553, 106, 'Zacatecas', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4554, 107, 'Zamora', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4555, 108, 'Zapopan', 'mx', 'Mexico');
INSERT INTO nuke_cities VALUES (4556, 1, 'Colonia', 'fm', 'Micronesia');
INSERT INTO nuke_cities VALUES (4557, 2, 'Kolonia', 'fm', 'Micronesia');
INSERT INTO nuke_cities VALUES (4558, 3, 'Lelu', 'fm', 'Micronesia');
INSERT INTO nuke_cities VALUES (4559, 4, 'Palikir', 'fm', 'Micronesia');
INSERT INTO nuke_cities VALUES (4560, 5, 'Tol', 'fm', 'Micronesia');
INSERT INTO nuke_cities VALUES (4561, 6, 'Weno', 'fm', 'Micronesia');
INSERT INTO nuke_cities VALUES (4562, 1, 'Balti', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4563, 2, 'Cahul', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4564, 3, 'Calarasi', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4565, 4, 'Causani', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4566, 5, 'Chisinau', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4567, 6, 'Ciadâr Lunga', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4568, 7, 'Comrat', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4569, 8, 'Drochia', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4570, 9, 'Dubasari', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4571, 10, 'Edinet', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4572, 11, 'Falesti', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4573, 12, 'Floresti', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4574, 13, 'Hâncesti', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4575, 14, 'Orhei', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4576, 15, 'Râbnita', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4577, 16, 'Slobozia', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4578, 17, 'Soroca', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4579, 18, 'Taraclia', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4580, 19, 'Tighina', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4581, 20, 'Tiraspol\'', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4582, 21, 'Ungheni', 'md', 'Moldova');
INSERT INTO nuke_cities VALUES (4583, 1, 'Fontvieille', 'mc', 'Monaco');
INSERT INTO nuke_cities VALUES (4584, 2, 'La Condamine', 'mc', 'Monaco');
INSERT INTO nuke_cities VALUES (4585, 3, 'Monaco-Ville', 'mc', 'Monaco');
INSERT INTO nuke_cities VALUES (4586, 4, 'Monte Carlo', 'mc', 'Monaco');
INSERT INTO nuke_cities VALUES (4587, 1, 'Altaj', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4588, 2, 'Arvajhèèr', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4589, 3, 'Bajanhongor', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4590, 4, 'Baruun-Urt', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4591, 5, 'Bulgan', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4592, 6, 'Cècèrleg', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4593, 7, 'Chojbalsan', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4594, 8, 'Chojr', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4595, 9, 'Dalanzadgad', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4596, 10, 'Darhan', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4597, 11, 'Èrdènèt', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4598, 12, 'Hovd', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4599, 13, 'Mandalgovi', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4600, 14, 'Mörön', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4601, 15, 'Ölgij', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4602, 16, 'Öndörhaan', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4603, 17, 'Sajnshand', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4604, 18, 'Sühbaatar', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4605, 19, 'Ulaanbaatar', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4606, 20, 'Ulaangom', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4607, 21, 'Uliastaj', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4608, 22, 'Zuunharaa', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4609, 23, 'Zuunmod', 'mn', 'Mongolia');
INSERT INTO nuke_cities VALUES (4610, 1, 'ad-Dâr-al-Baydâ', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4611, 2, 'Aghâdir', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4612, 3, 'al-´Arâ´ish', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4613, 4, 'al-Jadîdah', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4614, 5, 'al-Qanitrah', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4615, 6, 'al-Qasr-al-Kabîr', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4616, 7, 'an-Nadûr', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4617, 8, 'ar-Ribât', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4618, 9, 'Asfî', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4619, 10, 'Banî Mallâl', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4620, 11, 'Fâs', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4621, 12, 'Ghulimîm', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4622, 13, 'Khamissât', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4623, 14, 'Khurîbghah', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4624, 15, 'Marrâkush', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4625, 16, 'Miknâs', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4626, 17, 'Sattât', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4627, 18, 'Tanjah', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4628, 19, 'Tâzah', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4629, 20, 'Titwân', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4630, 21, 'Ujdah', 'ma', 'Morocco');
INSERT INTO nuke_cities VALUES (4631, 1, 'Angoche', 'mz', 'Mozambique');
INSERT INTO nuke_cities VALUES (4632, 2, 'Beira', 'mz', 'Mozambique');
INSERT INTO nuke_cities VALUES (4633, 3, 'Chibuto', 'mz', 'Mozambique');
INSERT INTO nuke_cities VALUES (4634, 4, 'Chimoio', 'mz', 'Mozambique');
INSERT INTO nuke_cities VALUES (4635, 5, 'Cuamba', 'mz', 'Mozambique');
INSERT INTO nuke_cities VALUES (4636, 6, 'Dondo', 'mz', 'Mozambique');
INSERT INTO nuke_cities VALUES (4637, 7, 'Garue', 'mz', 'Mozambique');
INSERT INTO nuke_cities VALUES (4638, 8, 'Inhambane', 'mz', 'Mozambique');
INSERT INTO nuke_cities VALUES (4639, 9, 'Lichinga', 'mz', 'Mozambique');
INSERT INTO nuke_cities VALUES (4640, 10, 'Maputo', 'mz', 'Mozambique');
INSERT INTO nuke_cities VALUES (4641, 11, 'Matola', 'mz', 'Mozambique');
INSERT INTO nuke_cities VALUES (4642, 12, 'Maxixe', 'mz', 'Mozambique');
INSERT INTO nuke_cities VALUES (4643, 13, 'Mocuba', 'mz', 'Mozambique');
INSERT INTO nuke_cities VALUES (4644, 14, 'Montepuez', 'mz', 'Mozambique');
INSERT INTO nuke_cities VALUES (4645, 15, 'Nacala', 'mz', 'Mozambique');
INSERT INTO nuke_cities VALUES (4646, 16, 'Nampula', 'mz', 'Mozambique');
INSERT INTO nuke_cities VALUES (4647, 17, 'Pemba', 'mz', 'Mozambique');
INSERT INTO nuke_cities VALUES (4648, 18, 'Quelimane', 'mz', 'Mozambique');
INSERT INTO nuke_cities VALUES (4649, 19, 'Tete', 'mz', 'Mozambique');
INSERT INTO nuke_cities VALUES (4650, 20, 'Xai-Xai', 'mz', 'Mozambique');
INSERT INTO nuke_cities VALUES (4651, 1, 'Akyab', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4652, 2, 'Bago', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4653, 3, 'Dawei', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4654, 4, 'Falam', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4655, 5, 'Henzada', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4656, 6, 'Hpa-an', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4657, 7, 'Lashio', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4658, 8, 'Loikaw', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4659, 9, 'Magway', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4660, 10, 'Mandalay', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4661, 11, 'Mawlamyine', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4662, 12, 'Maymyo', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4663, 13, 'Meiktila', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4664, 14, 'Mergui', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4665, 15, 'Monywa', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4666, 16, 'Myingyan', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4667, 17, 'Myitkyina', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4668, 18, 'Pakokku', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4669, 19, 'Pathein', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4670, 20, 'Pyay', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4671, 21, 'Sagaing', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4672, 22, 'Taunggyi', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4673, 23, 'Thaton', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4674, 24, 'Toungoo', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4675, 25, 'Yangon', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4676, 26, 'Yenangyaung', 'mm', 'Myanmar');
INSERT INTO nuke_cities VALUES (4677, 1, 'Bethanien', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4678, 2, 'Gobabis', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4679, 3, 'Grootfontein', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4680, 4, 'Katima Mulilo', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4681, 5, 'Keetmanshoop', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4682, 6, 'Khorixas', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4683, 7, 'Kuisebmond', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4684, 8, 'Lüderitz', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4685, 9, 'Mariental', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4686, 10, 'Okahandja', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4687, 11, 'Omaruru', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4688, 12, 'Ondangwa', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4689, 13, 'Ongandjera', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4690, 14, 'Opuwo', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4691, 15, 'Oranjemund', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4692, 16, 'Oshakati', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4693, 17, 'Oshikango', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4694, 18, 'Otjiwarongo', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4695, 19, 'Rehoboth', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4696, 20, 'Rundu', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4697, 21, 'Swakopmund', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4698, 22, 'Tsumeb', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4699, 23, 'Walvis Bay', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4700, 24, 'Windhoek', 'na', 'Namibia');
INSERT INTO nuke_cities VALUES (4701, 1, 'Yaren', 'nr', 'Nauru');
INSERT INTO nuke_cities VALUES (4702, 1, 'Bâglung', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4703, 2, 'Bhaktapur', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4704, 3, 'Bharatpur', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4705, 4, 'Birâtnagar', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4706, 5, 'Bîrganj', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4707, 6, 'Butwal', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4708, 7, 'Damak', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4709, 8, 'Dhangadi', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4710, 9, 'Dharân', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4711, 10, 'Gulariya', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4712, 11, 'Hetauda', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4713, 12, 'Ilâm', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4714, 13, 'Jaleshwar', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4715, 14, 'Janakpur', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4716, 15, 'Jumla', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4717, 16, 'Kathmandu', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4718, 17, 'Lalitpur', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4719, 18, 'Madhyapur Thimi', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4720, 19, 'Mahendranagar', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4721, 20, 'Mechinagar', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4722, 21, 'Nepâlgânj', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4723, 22, 'Pokharâ', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4724, 23, 'Râjbirâj', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4725, 24, 'Sidharthanagar', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4726, 25, 'Triyuga', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4727, 26, 'Tulsîpur', 'np', 'Nepal');
INSERT INTO nuke_cities VALUES (4728, 1, 'Almere', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4729, 2, 'Amersfoort', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4730, 3, 'Amsterdam', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4731, 4, 'Apeldoorn', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4732, 5, 'Arnhem', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4733, 6, 'Assen', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4734, 7, 'Breda', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4735, 8, 'Dordrecht', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4736, 9, 'Ede', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4737, 10, 'Eindhoven', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4738, 11, 'Emmen', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4739, 12, 'Enschede', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4740, 13, 'Groningen', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4741, 14, 'Haarlem', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4742, 15, 'Haarlemmermeer', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4743, 16, 'Leeuwarden', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4744, 17, 'Leiden', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4745, 18, 'Lelystad', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4746, 19, 'Maastricht', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4747, 20, 'Middelburg', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4748, 21, 'Nijmegen', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4749, 22, 'Rotterdam', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4750, 23, '\'s-Gravenhage', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4751, 24, '\'s-Hertogenbosch', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4752, 25, 'Tilburg', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4753, 26, 'Utrecht', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4754, 27, 'Zaanstad', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4755, 28, 'Zoetermeer', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4756, 29, 'Zwolle', 'nl', 'Netherlands');
INSERT INTO nuke_cities VALUES (4757, 1, 'Kralendijk', 'an', 'Netherlands Antilles');
INSERT INTO nuke_cities VALUES (4758, 2, 'Oranjestad', 'an', 'Netherlands Antilles');
INSERT INTO nuke_cities VALUES (4759, 3, 'Philipsburg', 'an', 'Netherlands Antilles');
INSERT INTO nuke_cities VALUES (4760, 4, 'The Bottom', 'an', 'Netherlands Antilles');
INSERT INTO nuke_cities VALUES (4761, 5, 'Willemstad', 'an', 'Netherlands Antilles');
INSERT INTO nuke_cities VALUES (4762, 1, 'Bourail', 'nc', 'New Caledonia');
INSERT INTO nuke_cities VALUES (4763, 2, 'Canala', 'nc', 'New Caledonia');
INSERT INTO nuke_cities VALUES (4764, 3, 'Dumbéa', 'nc', 'New Caledonia');
INSERT INTO nuke_cities VALUES (4765, 4, 'Fayaoué', 'nc', 'New Caledonia');
INSERT INTO nuke_cities VALUES (4766, 5, 'Houaïlu', 'nc', 'New Caledonia');
INSERT INTO nuke_cities VALUES (4767, 6, 'Koné', 'nc', 'New Caledonia');
INSERT INTO nuke_cities VALUES (4768, 7, 'Koumac', 'nc', 'New Caledonia');
INSERT INTO nuke_cities VALUES (4769, 8, 'La Foa', 'nc', 'New Caledonia');
INSERT INTO nuke_cities VALUES (4770, 9, 'Mont-Doré', 'nc', 'New Caledonia');
INSERT INTO nuke_cities VALUES (4771, 10, 'Nouméa', 'nc', 'New Caledonia');
INSERT INTO nuke_cities VALUES (4772, 11, 'Ouégoa', 'nc', 'New Caledonia');
INSERT INTO nuke_cities VALUES (4773, 12, 'Païta', 'nc', 'New Caledonia');
INSERT INTO nuke_cities VALUES (4774, 13, 'Poindimié', 'nc', 'New Caledonia');
INSERT INTO nuke_cities VALUES (4775, 14, 'Ponerihouen', 'nc', 'New Caledonia');
INSERT INTO nuke_cities VALUES (4776, 15, 'Pouébo', 'nc', 'New Caledonia');
INSERT INTO nuke_cities VALUES (4777, 16, 'Poya', 'nc', 'New Caledonia');
INSERT INTO nuke_cities VALUES (4778, 17, 'Tadine', 'nc', 'New Caledonia');
INSERT INTO nuke_cities VALUES (4779, 18, 'Thio', 'nc', 'New Caledonia');
INSERT INTO nuke_cities VALUES (4780, 19, 'Touho', 'nc', 'New Caledonia');
INSERT INTO nuke_cities VALUES (4781, 20, 'Wé', 'nc', 'New Caledonia');
INSERT INTO nuke_cities VALUES (4782, 1, 'Auckland', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4783, 2, 'Blenheim', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4784, 3, 'Christchurch', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4785, 4, 'Dunedin', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4786, 5, 'Gisborne', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4787, 6, 'Greymouth', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4788, 7, 'Hamilton', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4789, 8, 'Hastings', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4790, 9, 'Invercargill', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4791, 10, 'Lower Hutt', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4792, 11, 'Manukau', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4793, 12, 'Napier', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4794, 13, 'Nelson', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4795, 14, 'New Plymouth', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4796, 15, 'North Shore', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4797, 16, 'Palmerston North', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4798, 17, 'Porirua', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4799, 18, 'Richmond', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4800, 19, 'Rotorua', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4801, 20, 'Stratford', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4802, 21, 'Tauranga', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4803, 22, 'Waitakere', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4804, 23, 'Waitangi', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4805, 24, 'Wanganui', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4806, 25, 'Wellington', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4807, 26, 'Whakatane', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4808, 27, 'Whangarei', 'nz', 'New Zealand');
INSERT INTO nuke_cities VALUES (4809, 1, 'Bluefields', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4810, 2, 'Boaco', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4811, 3, 'Chichigalpa', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4812, 4, 'Chinandega', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4813, 5, 'Diriamba', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4814, 6, 'El Viejo', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4815, 7, 'Estelí', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4816, 8, 'Granada', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4817, 9, 'Jalapa', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4818, 10, 'Jinotega', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4819, 11, 'Jinotepe', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4820, 12, 'Juigalpa', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4821, 13, 'León', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4822, 14, 'Managua', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4823, 15, 'Masaya', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4824, 16, 'Matagalpa', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4825, 17, 'Nagarote', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4826, 18, 'Nueva Guinea', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4827, 19, 'Ocotal', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4828, 20, 'Puerto Cabezas', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4829, 21, 'Rivas', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4830, 22, 'San Carlos', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4831, 23, 'Somoto', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4832, 24, 'Tipitapa', 'ni', 'Nicaragua');
INSERT INTO nuke_cities VALUES (4833, 1, 'Agadez', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4834, 2, 'Arlit', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4835, 3, 'Ayorou', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4836, 4, 'Birni N\'Gaouré', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4837, 5, 'Birni N\'Konni', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4838, 6, 'Dakoro', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4839, 7, 'Diffa', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4840, 8, 'Dogondoutchi', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4841, 9, 'Dosso', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4842, 10, 'Gaya', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4843, 11, 'Illéla', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4844, 12, 'Magaria', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4845, 13, 'Maradi', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4846, 14, 'Mirriah', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4847, 15, 'Niamey', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4848, 16, 'Tahoua', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4849, 17, 'Tanout', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4850, 18, 'Téra', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4851, 19, 'Tessaoua', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4852, 20, 'Tillabéry', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4853, 21, 'Zinder', 'ne', 'Niger');
INSERT INTO nuke_cities VALUES (4854, 1, 'Aba', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4855, 2, 'Abakaliki', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4856, 3, 'Abeokuta', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4857, 4, 'Abuja', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4858, 5, 'Ado', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4859, 6, 'Akure', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4860, 7, 'Amaigbo', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4861, 8, 'Asaba', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4862, 9, 'Awka', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4863, 10, 'Azare', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4864, 11, 'Bama', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4865, 12, 'Bauchi', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4866, 13, 'Benin', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4867, 14, 'Bida', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4868, 15, 'Birnin Kebbi', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4869, 16, 'Bugama', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4870, 17, 'Calabar', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4871, 18, 'Damaturu', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4872, 19, 'Dutse', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4873, 20, 'Ede', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4874, 21, 'Efon Alaye', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4875, 22, 'Ejigbo', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4876, 23, 'Enugu', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4877, 24, 'Funtua', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4878, 25, 'Gashua', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4879, 26, 'Gboko', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4880, 27, 'Gbongan', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4881, 28, 'Gombe', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4882, 29, 'Gusau', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4883, 30, 'Hadejia', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4884, 31, 'Ibadan', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4885, 32, 'Ife', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4886, 33, 'Ifon Osun', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4887, 34, 'Igboho', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4888, 35, 'Ijebu Ode', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4889, 36, 'Ijero', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4890, 37, 'Ikare', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4891, 38, 'Ikire', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4892, 39, 'Ikirun', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4893, 40, 'Ikorodu', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4894, 41, 'Ikot Ekpene', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4895, 42, 'Ila', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4896, 43, 'Ilawe', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4897, 44, 'Ilesha', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4898, 45, 'Ilobu', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4899, 46, 'Ilorin', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4900, 47, 'Inisa', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4901, 48, 'Ise', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4902, 49, 'Iseyin', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4903, 50, 'Iwo', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4904, 51, 'Jalingo', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4905, 52, 'Jimeta', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4906, 53, 'Jos', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4907, 54, 'Kaduna', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4908, 55, 'Kano', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4909, 56, 'Katsina', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4910, 57, 'Kishi', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4911, 58, 'Lafia', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4912, 59, 'Lagos', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4913, 60, 'Lokoja', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4914, 61, 'Maiduguri', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4915, 62, 'Makurdi', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4916, 63, 'Minna', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4917, 64, 'Modakeke', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4918, 65, 'Mubi', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4919, 66, 'Nnewi', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4920, 67, 'Nsukka', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4921, 68, 'Obosi', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4922, 69, 'Offa', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4923, 70, 'Ogbomosho', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4924, 71, 'Okene', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4925, 72, 'Okigwe', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4926, 73, 'Okpoko', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4927, 74, 'Okrika', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4928, 75, 'Ondo', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4929, 76, 'Onitsha', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4930, 77, 'Oshogbo', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4931, 78, 'Otukpo', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4932, 79, 'Owerri', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4933, 80, 'Owo', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4934, 81, 'Oyo', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4935, 82, 'Port Harcourt', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4936, 83, 'Sango Ota', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4937, 84, 'Sapele', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4938, 85, 'Shagamu', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4939, 86, 'Shaki', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4940, 87, 'Sokoto', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4941, 88, 'Suleja', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4942, 89, 'Ugep', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4943, 90, 'Umuahia', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4944, 91, 'Uromi', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4945, 92, 'Uyo', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4946, 93, 'Warri', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4947, 94, 'Yenagoa', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4948, 95, 'Yola', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4949, 96, 'Zaria', 'ng', 'Nigeria');
INSERT INTO nuke_cities VALUES (4950, 1, 'Alofi', 'nu', 'Niue');
INSERT INTO nuke_cities VALUES (4951, 2, 'Avatele', 'nu', 'Niue');
INSERT INTO nuke_cities VALUES (4952, 3, 'Hakupu', 'nu', 'Niue');
INSERT INTO nuke_cities VALUES (4953, 4, 'Hikutavake', 'nu', 'Niue');
INSERT INTO nuke_cities VALUES (4954, 5, 'Lakepa', 'nu', 'Niue');
INSERT INTO nuke_cities VALUES (4955, 6, 'Liku', 'nu', 'Niue');
INSERT INTO nuke_cities VALUES (4956, 7, 'Makefu', 'nu', 'Niue');
INSERT INTO nuke_cities VALUES (4957, 8, 'Mutalau', 'nu', 'Niue');
INSERT INTO nuke_cities VALUES (4958, 9, 'Namukulu', 'nu', 'Niue');
INSERT INTO nuke_cities VALUES (4959, 10, 'Tamakautoga', 'nu', 'Niue');
INSERT INTO nuke_cities VALUES (4960, 11, 'Toi', 'nu', 'Niue');
INSERT INTO nuke_cities VALUES (4961, 12, 'Tuapa', 'nu', 'Niue');
INSERT INTO nuke_cities VALUES (4962, 13, 'Vaiea', 'nu', 'Niue');
INSERT INTO nuke_cities VALUES (4963, 1, 'Kingston', 'nf', 'Norfolk');
INSERT INTO nuke_cities VALUES (4964, 1, 'Capital Hill', 'mp', 'Northern Mariana Islands');
INSERT INTO nuke_cities VALUES (4965, 2, 'Chalan Kanoa', 'mp', 'Northern Mariana Islands');
INSERT INTO nuke_cities VALUES (4966, 3, 'Dandan', 'mp', 'Northern Mariana Islands');
INSERT INTO nuke_cities VALUES (4967, 4, 'Garapan', 'mp', 'Northern Mariana Islands');
INSERT INTO nuke_cities VALUES (4968, 5, 'Gualo Rai', 'mp', 'Northern Mariana Islands');
INSERT INTO nuke_cities VALUES (4969, 6, 'Kagman', 'mp', 'Northern Mariana Islands');
INSERT INTO nuke_cities VALUES (4970, 7, 'Koblerville', 'mp', 'Northern Mariana Islands');
INSERT INTO nuke_cities VALUES (4971, 8, 'Navy Hill', 'mp', 'Northern Mariana Islands');
INSERT INTO nuke_cities VALUES (4972, 9, 'San Antonio', 'mp', 'Northern Mariana Islands');
INSERT INTO nuke_cities VALUES (4973, 10, 'San Jose', 'mp', 'Northern Mariana Islands');
INSERT INTO nuke_cities VALUES (4974, 11, 'San Jose', 'mp', 'Northern Mariana Islands');
INSERT INTO nuke_cities VALUES (4975, 12, 'San Roque', 'mp', 'Northern Mariana Islands');
INSERT INTO nuke_cities VALUES (4976, 13, 'San Vicente', 'mp', 'Northern Mariana Islands');
INSERT INTO nuke_cities VALUES (4977, 14, 'Settlement', 'mp', 'Northern Mariana Islands');
INSERT INTO nuke_cities VALUES (4978, 15, 'Songsong', 'mp', 'Northern Mariana Islands');
INSERT INTO nuke_cities VALUES (4979, 16, 'Susupe', 'mp', 'Northern Mariana Islands');
INSERT INTO nuke_cities VALUES (4980, 17, 'Tanapag', 'mp', 'Northern Mariana Islands');
INSERT INTO nuke_cities VALUES (4981, 1, '´Ibrî', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (4982, 2, 'al-Buraymi', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (4983, 3, 'al-Khabûrah', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (4984, 4, 'al-Mudaybî', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (4985, 5, 'ar-Rustâq', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (4986, 6, 'as-Sîb', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (4987, 7, 'as-Suwayq', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (4988, 8, 'Bahlâ\'', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (4989, 9, 'Barkah', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (4990, 10, 'Bawshar', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (4991, 11, 'Khasab', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (4992, 12, 'Madinat Qabûs', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (4993, 13, 'Masqat', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (4994, 14, 'Matrah', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (4995, 15, 'Nizwa', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (4996, 16, 'Ruwî', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (4997, 17, 'Saham', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (4998, 18, 'Salâlah', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (4999, 19, 'Shinâs', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (5000, 20, 'Suhâr', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (5001, 21, 'Sûr', 'om', 'Oman');
INSERT INTO nuke_cities VALUES (5002, 1, 'Abottâbâd', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5003, 2, 'Ahmadpur East', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5004, 3, 'Bahâwalnagar', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5005, 4, 'Bahâwalpur', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5006, 5, 'Bûrewâla', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5007, 6, 'Chiniot', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5008, 7, 'Chishtiân Mandi', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5009, 8, 'Dâdu', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5010, 9, 'Daska', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5011, 10, 'Dera Ghâzi Khân', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5012, 11, 'Dera Îsmâil Khân', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5013, 12, 'Faisalâbâd', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5014, 13, 'Gilgit', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5015, 14, 'Gojra', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5016, 15, 'Gujrânwâla', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5017, 16, 'Gujrât', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5018, 17, 'Hâfizâbâd', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5019, 18, 'Hyderâbâd', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5020, 19, 'Islâmâbâd', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5021, 20, 'Jacobâbâd', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5022, 21, 'Jarânwâla', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5023, 22, 'Jhang', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5024, 23, 'Jhelum', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5025, 24, 'Kamâlia', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5026, 25, 'Kâmoke', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5027, 26, 'Karâchi', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5028, 27, 'Kasûr', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5029, 28, 'Khairpur', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5030, 29, 'Khânewâl', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5031, 30, 'Khânpur', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5032, 31, 'Khuzdar', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5033, 32, 'Kohât', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5034, 33, 'Lahore', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5035, 34, 'Lârkâna', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5036, 35, 'Mandi Bahâuddîn', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5037, 36, 'Mardân', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5038, 37, 'Mingâora', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5039, 38, 'Mîrpur Khâs', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5040, 39, 'Multân', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5041, 40, 'Murîdke', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5042, 41, 'Muzaffarâbâd', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5043, 42, 'Muzaffargarh', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5044, 43, 'Nawâbshâh', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5045, 44, 'Nowshera', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5046, 45, 'Okâra', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5047, 46, 'Pâkpattan', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5048, 47, 'Peshâwar', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5049, 48, 'Quetta', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5050, 49, 'Rahîm Yâr Khân', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5051, 50, 'Râwalpindi', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5052, 51, 'Sâdiqâbâd', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5053, 52, 'Sâhîwâl', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5054, 53, 'Sargodha', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5055, 54, 'Shekhûpura', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5056, 55, 'Shikârpur', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5057, 56, 'Siâlkot', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5058, 57, 'Sukkur', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5059, 58, 'Tando Âdam', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5060, 59, 'Vihâri', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5061, 60, 'Wâh', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5062, 61, 'Wazîrâbâd', 'pk', 'Pakistan');
INSERT INTO nuke_cities VALUES (5063, 1, 'Airai', 'pw', 'Palau');
INSERT INTO nuke_cities VALUES (5064, 2, 'Chol', 'pw', 'Palau');
INSERT INTO nuke_cities VALUES (5065, 3, 'Dongosaru', 'pw', 'Palau');
INSERT INTO nuke_cities VALUES (5066, 4, 'Hatohobei', 'pw', 'Palau');
INSERT INTO nuke_cities VALUES (5067, 5, 'Imeong', 'pw', 'Palau');
INSERT INTO nuke_cities VALUES (5068, 6, 'Kayangel', 'pw', 'Palau');
INSERT INTO nuke_cities VALUES (5069, 7, 'Kloulklubed', 'pw', 'Palau');
INSERT INTO nuke_cities VALUES (5070, 8, 'Koror', 'pw', 'Palau');
INSERT INTO nuke_cities VALUES (5071, 9, 'Melekeok', 'pw', 'Palau');
INSERT INTO nuke_cities VALUES (5072, 10, 'Meyungs', 'pw', 'Palau');
INSERT INTO nuke_cities VALUES (5073, 11, 'Ngaramash', 'pw', 'Palau');
INSERT INTO nuke_cities VALUES (5074, 12, 'Ngerkeai', 'pw', 'Palau');
INSERT INTO nuke_cities VALUES (5075, 13, 'Ngermechau', 'pw', 'Palau');
INSERT INTO nuke_cities VALUES (5076, 14, 'Ngetkip', 'pw', 'Palau');
INSERT INTO nuke_cities VALUES (5077, 15, 'Oikul', 'pw', 'Palau');
INSERT INTO nuke_cities VALUES (5078, 16, 'Ollei', 'pw', 'Palau');
INSERT INTO nuke_cities VALUES (5079, 17, 'Ulimang', 'pw', 'Palau');
INSERT INTO nuke_cities VALUES (5080, 1, 'ad-Dâhirîyah', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5081, 2, 'al-Bîrah', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5082, 3, 'al-Burayj', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5083, 4, 'al-Insayrât', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5084, 5, 'al-Khalîl', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5085, 6, 'al-Quds', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5086, 7, 'Arîhâ', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5087, 8, 'Banî Suhaylah', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5088, 9, 'Bayt Hânûn', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5089, 10, 'Bayt Lâhiyah', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5090, 11, 'Bayt Lahm', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5091, 12, 'Dayr-al-Balah', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5092, 13, 'Ghazzah', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5093, 14, 'Jabâliyah', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5094, 15, 'Janin', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5095, 16, 'Khân Yûnis', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5096, 17, 'Nâbulus', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5097, 18, 'Qalqîlyah', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5098, 19, 'Rafah', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5099, 20, 'Râm Allâh', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5100, 21, 'Salfît', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5101, 22, 'Tûbâs', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5102, 23, 'Tûlkarm', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5103, 24, 'Yattah', 'ps', 'Palestine');
INSERT INTO nuke_cities VALUES (5104, 1, 'Antón', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5105, 2, 'Arraiján', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5106, 3, 'Bocas del Toro', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5107, 4, 'Bugaba', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5108, 5, 'Changuinola', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5109, 6, 'Chepo', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5110, 7, 'Chichica', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5111, 8, 'Chitré', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5112, 9, 'Cirilo Guainora', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5113, 10, 'Colón', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5114, 11, 'David', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5115, 12, 'La Chorrera', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5116, 13, 'La Palma', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5117, 14, 'Las Tablas', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5118, 15, 'Narganá', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5119, 16, 'Ocú', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5120, 17, 'Panamá', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5121, 18, 'Penonomé', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5122, 19, 'Portobelo', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5123, 20, 'Puerto Armuelles', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5124, 21, 'Río Sereno', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5125, 22, 'San Miguelito', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5126, 23, 'Santiago', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5127, 24, 'Soná', 'pa', 'Panama');
INSERT INTO nuke_cities VALUES (5128, 1, 'Alotau', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5129, 2, 'Arawa', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5130, 3, 'Bulolo', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5131, 4, 'Daru', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5132, 5, 'Goroka', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5133, 6, 'Kavieng', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5134, 7, 'Kerema', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5135, 8, 'Kimbe', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5136, 9, 'Kiunga', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5137, 10, 'Kokopo', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5138, 11, 'Kundiawa', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5139, 12, 'Lae', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5140, 13, 'Lorengau', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5141, 14, 'Madang', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5142, 15, 'Mendi', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5143, 16, 'Mount Hagen', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5144, 17, 'Popondetta', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5145, 18, 'Port Moresby', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5146, 19, 'Rabaul', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5147, 20, 'Vanimo', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5148, 21, 'Wabag', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5149, 22, 'Wau', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5150, 23, 'Wewak', 'pg', 'Papua New Guinea');
INSERT INTO nuke_cities VALUES (5151, 1, 'Areguá', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5152, 2, 'Asunción', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5153, 3, 'Caacupé', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5154, 4, 'Caaguazú', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5155, 5, 'Caazapá', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5156, 6, 'Capiatá', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5157, 7, 'Ciudad del Este', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5158, 8, 'Concepción', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5159, 9, 'Coronel Oviedo', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5160, 10, 'Encarnación', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5161, 11, 'Fernando de la Mora', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5162, 12, 'Filadelfia', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5163, 13, 'Fuerte Olimpo', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5164, 14, 'Hernandaríaz', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5165, 15, 'Itauguá', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5166, 16, 'Lambaré', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5167, 17, 'Limpio', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5168, 18, 'Luque', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5169, 19, 'Mariano Roque Alonso', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5170, 20, 'Ñemby', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5171, 21, 'Paraguarí', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5172, 22, 'Pedro Juan Caballero', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5173, 23, 'Pilar', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5174, 24, 'Pozo Colorado', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5175, 25, 'Presidente Franco', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5176, 26, 'Salto del Guairá', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5177, 27, 'San Antonio', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5178, 28, 'San Juan Bautista', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5179, 29, 'San Lorenzo', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5180, 30, 'San Pedro de Ycuamandiyú', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5181, 31, 'Villa Elisa', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5182, 32, 'Villarrica', 'py', 'Paraguay');
INSERT INTO nuke_cities VALUES (5183, 1, 'Abancay', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5184, 2, 'Arequipa', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5185, 3, 'Ayacucho', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5186, 4, 'Cajamarca', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5187, 5, 'Cerro de Pasco', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5188, 6, 'Chachapoyas', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5189, 7, 'Chiclayo', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5190, 8, 'Chimbote', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5191, 9, 'Chincha Alta', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5192, 10, 'Cusco', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5193, 11, 'Huancavelica', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5194, 12, 'Huancayo', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5195, 13, 'Huánuco', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5196, 14, 'Ica', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5197, 15, 'Iquitos', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5198, 16, 'Juliaca', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5199, 17, 'Lima', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5200, 18, 'Moquegua', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5201, 19, 'Moyobamba', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5202, 20, 'Piura', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5203, 21, 'Pucallpa', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5204, 22, 'Puerto Maldonado', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5205, 23, 'Puno', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5206, 24, 'Sullana', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5207, 25, 'Tacna', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5208, 26, 'Talara', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5209, 27, 'Tarapoto', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5210, 28, 'Trujillo', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5211, 29, 'Tumbes', 'pe', 'Peru');
INSERT INTO nuke_cities VALUES (5212, 1, 'Angeles', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5213, 2, 'Antipolo', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5214, 3, 'Bacolod', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5215, 4, 'Bacoor', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5216, 5, 'Baguio', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5217, 6, 'Baliuag', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5218, 7, 'Bangued', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5219, 8, 'Biñan', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5220, 9, 'Binangonan', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5221, 10, 'Butuan', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5222, 11, 'Cabanatuan', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5223, 12, 'Cagayan', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5224, 13, 'Cainta', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5225, 14, 'Calamba', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5226, 15, 'Calbayog', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5227, 16, 'Cavite', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5228, 17, 'Cebu', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5229, 18, 'Cotabato', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5230, 19, 'Dagupan', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5231, 20, 'Davao', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5232, 21, 'Dumaguete', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5233, 22, 'Gapan', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5234, 23, 'General Mariano Alvarez', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5235, 24, 'General Santos', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5236, 25, 'Guagua', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5237, 26, 'Iloilo', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5238, 27, 'Lapu-Lapu', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5239, 28, 'Legaspi', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5240, 29, 'Los Baños', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5241, 30, 'Lucena', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5242, 31, 'Malolos', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5243, 32, 'Mandaue', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5244, 33, 'Manila', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5245, 34, 'Marawi', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5246, 35, 'Meycauayan', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5247, 36, 'Montalban', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5248, 37, 'Naga', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5249, 38, 'Olongapo', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5250, 39, 'Roxas', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5251, 40, 'San Fernando', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5252, 41, 'San Fernando', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5253, 42, 'San Mateo', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5254, 43, 'San Pablo', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5255, 44, 'San Pedro', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5256, 45, 'Santa Cruz', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5257, 46, 'Santa Rosa', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5258, 47, 'Santiago', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5259, 48, 'Sultan Kudarat', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5260, 49, 'Tacloban', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5261, 50, 'Tagum', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5262, 51, 'Taytay', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5263, 52, 'Toledo', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5264, 53, 'Tuguegarao', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5265, 54, 'Zamboanga', 'ph', 'Philippines');
INSERT INTO nuke_cities VALUES (5266, 1, 'Bialystok', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5267, 2, 'Bielsko-Biala', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5268, 3, 'Bydgoszcz', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5269, 4, 'Bytom', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5270, 5, 'Chorzów', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5271, 6, 'Czestochowa', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5272, 7, 'Dabrowa Górnicza', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5273, 8, 'Elblag', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5274, 9, 'Gdansk', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5275, 10, 'Gdynia', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5276, 11, 'Gliwice', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5277, 12, 'Gorzów Wielkopolski', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5278, 13, 'Grudziadz', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5279, 14, 'Jastrzebie-Zdrój', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5280, 15, 'Kalisz', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5281, 16, 'Katowice', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5282, 17, 'Kielce', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5283, 18, 'Koszalin', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5284, 19, 'Kraków', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5285, 20, 'Legnica', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5286, 21, 'Lódz', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5287, 22, 'Lublin', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5288, 23, 'Olsztyn', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5289, 24, 'Opole', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5290, 25, 'Plock', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5291, 26, 'Poznan', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5292, 27, 'Radom', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5293, 28, 'Ruda Slaska', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5294, 29, 'Rybnik', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5295, 30, 'Rzeszów', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5296, 31, 'Slupsk', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5297, 32, 'Sosnowiec', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5298, 33, 'Szczecin', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5299, 34, 'Tarnów', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5300, 35, 'Torun', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5301, 36, 'Tychy', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5302, 37, 'Walbrzych', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5303, 38, 'Warszawa', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5304, 39, 'Wloclawek', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5305, 40, 'Wroclaw', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5306, 41, 'Zabrze', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5307, 42, 'Zielona Góra', 'pl', 'Poland');
INSERT INTO nuke_cities VALUES (5308, 1, 'Agualva-Cacém', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5309, 2, 'Algueirão-Mem Martins', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5310, 3, 'Amadora', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5311, 4, 'Amora', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5312, 5, 'Aveiro', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5313, 6, 'Barreiro', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5314, 7, 'Braga', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5315, 8, 'Coimbra', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5316, 9, 'Corroios', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5317, 10, 'Évora', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5318, 11, 'Faro', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5319, 12, 'Funchal', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5320, 13, 'Lisboa', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5321, 14, 'Loures', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5322, 15, 'Odivelas', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5323, 16, 'Ponta Delgada', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5324, 17, 'Porto', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5325, 18, 'Queluz', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5326, 19, 'Rio de Mouro', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5327, 20, 'Rio Tinto', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5328, 21, 'Setúbal', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5329, 22, 'Vila Nova de Gaia', 'pt', 'Portugal');
INSERT INTO nuke_cities VALUES (5330, 1, 'Aguadilla', 'pr', 'Puerto Rico');
INSERT INTO nuke_cities VALUES (5331, 2, 'Arecibo', 'pr', 'Puerto Rico');
INSERT INTO nuke_cities VALUES (5332, 3, 'Bayamón', 'pr', 'Puerto Rico');
INSERT INTO nuke_cities VALUES (5333, 4, 'Caguas', 'pr', 'Puerto Rico');
INSERT INTO nuke_cities VALUES (5334, 5, 'Candelaria', 'pr', 'Puerto Rico');
INSERT INTO nuke_cities VALUES (5335, 6, 'Carolina', 'pr', 'Puerto Rico');
INSERT INTO nuke_cities VALUES (5336, 7, 'Cataño', 'pr', 'Puerto Rico');
INSERT INTO nuke_cities VALUES (5337, 8, 'Cayey', 'pr', 'Puerto Rico');
INSERT INTO nuke_cities VALUES (5338, 9, 'Fajardo', 'pr', 'Puerto Rico');
INSERT INTO nuke_cities VALUES (5339, 10, 'Guayama', 'pr', 'Puerto Rico');
INSERT INTO nuke_cities VALUES (5340, 11, 'Guaynabo', 'pr', 'Puerto Rico');
INSERT INTO nuke_cities VALUES (5341, 12, 'Humacao', 'pr', 'Puerto Rico');
INSERT INTO nuke_cities VALUES (5342, 13, 'Levittown', 'pr', 'Puerto Rico');
INSERT INTO nuke_cities VALUES (5343, 14, 'Mayagüez', 'pr', 'Puerto Rico');
INSERT INTO nuke_cities VALUES (5344, 15, 'Ponce', 'pr', 'Puerto Rico');
INSERT INTO nuke_cities VALUES (5345, 16, 'Río Grande', 'pr', 'Puerto Rico');
INSERT INTO nuke_cities VALUES (5346, 17, 'San Juan', 'pr', 'Puerto Rico');
INSERT INTO nuke_cities VALUES (5347, 18, 'Trujillo Alto', 'pr', 'Puerto Rico');
INSERT INTO nuke_cities VALUES (5348, 19, 'Vega Baja', 'pr', 'Puerto Rico');
INSERT INTO nuke_cities VALUES (5349, 20, 'Yauco', 'pr', 'Puerto Rico');
INSERT INTO nuke_cities VALUES (5350, 1, 'ad-Dawhah', 'qa', 'Qatar');
INSERT INTO nuke_cities VALUES (5351, 2, 'al-Ghuwayrîyah', 'qa', 'Qatar');
INSERT INTO nuke_cities VALUES (5352, 3, 'al-Jumaylîyah', 'qa', 'Qatar');
INSERT INTO nuke_cities VALUES (5353, 4, 'al-Khawr', 'qa', 'Qatar');
INSERT INTO nuke_cities VALUES (5354, 5, 'al-Wakrah', 'qa', 'Qatar');
INSERT INTO nuke_cities VALUES (5355, 6, 'al-Wukayr', 'qa', 'Qatar');
INSERT INTO nuke_cities VALUES (5356, 7, 'ar-Rayyân', 'qa', 'Qatar');
INSERT INTO nuke_cities VALUES (5357, 8, 'ar-Ruways', 'qa', 'Qatar');
INSERT INTO nuke_cities VALUES (5358, 9, 'ash-Shahanîyah', 'qa', 'Qatar');
INSERT INTO nuke_cities VALUES (5359, 10, 'Dukhân', 'qa', 'Qatar');
INSERT INTO nuke_cities VALUES (5360, 11, 'Musay´id', 'qa', 'Qatar');
INSERT INTO nuke_cities VALUES (5361, 12, 'Umm Bâb', 'qa', 'Qatar');
INSERT INTO nuke_cities VALUES (5362, 13, 'Umm Salal', 'qa', 'Qatar');
INSERT INTO nuke_cities VALUES (5363, 1, 'Bras-Panon', 're', 'Réunion');
INSERT INTO nuke_cities VALUES (5364, 2, 'La Possession', 're', 'Réunion');
INSERT INTO nuke_cities VALUES (5365, 3, 'Le Port', 're', 'Réunion');
INSERT INTO nuke_cities VALUES (5366, 4, 'Le Tampon', 're', 'Réunion');
INSERT INTO nuke_cities VALUES (5367, 5, 'Les Aviron', 're', 'Réunion');
INSERT INTO nuke_cities VALUES (5368, 6, 'Les Trois-Bassins', 're', 'Réunion');
INSERT INTO nuke_cities VALUES (5369, 7, 'L\'Étang-Salé', 're', 'Réunion');
INSERT INTO nuke_cities VALUES (5370, 8, 'Petite-Ile', 're', 'Réunion');
INSERT INTO nuke_cities VALUES (5371, 9, 'Saint-André', 're', 'Réunion');
INSERT INTO nuke_cities VALUES (5372, 10, 'Saint-Benoit', 're', 'Réunion');
INSERT INTO nuke_cities VALUES (5373, 11, 'Saint-Denis', 're', 'Réunion');
INSERT INTO nuke_cities VALUES (5374, 12, 'Sainte-Marie', 're', 'Réunion');
INSERT INTO nuke_cities VALUES (5375, 13, 'Sainte-Rose', 're', 'Réunion');
INSERT INTO nuke_cities VALUES (5376, 14, 'Sainte-Suzanne', 're', 'Réunion');
INSERT INTO nuke_cities VALUES (5377, 15, 'Saint-Joseph', 're', 'Réunion');
INSERT INTO nuke_cities VALUES (5378, 16, 'Saint-Leu', 're', 'Réunion');
INSERT INTO nuke_cities VALUES (5379, 17, 'Saint-Louis', 're', 'Réunion');
INSERT INTO nuke_cities VALUES (5380, 18, 'Saint-Paul', 're', 'Réunion');
INSERT INTO nuke_cities VALUES (5381, 19, 'Saint-Pierre', 're', 'Réunion');
INSERT INTO nuke_cities VALUES (5382, 20, 'Salazie', 're', 'Réunion');
INSERT INTO nuke_cities VALUES (5383, 1, 'Arad', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5384, 2, 'Bacau', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5385, 3, 'Baia Mare', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5386, 4, 'Botosani', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5387, 5, 'Braila', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5388, 6, 'Brasov', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5389, 7, 'Bucuresti', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5390, 8, 'Buzau', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5391, 9, 'Cluj-Napoca', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5392, 10, 'Constanta', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5393, 11, 'Craiova', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5394, 12, 'Drobeta-Turnu Severin', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5395, 13, 'Focsani', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5396, 14, 'Galati', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5397, 15, 'Iasi', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5398, 16, 'Oradea', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5399, 17, 'Piatra Neamt', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5400, 18, 'Pitesti', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5401, 19, 'Ploiesti', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5402, 20, 'Râmnicu Vâlcea', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5403, 21, 'Satu Mare', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5404, 22, 'Sibiu', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5405, 23, 'Suceava', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5406, 24, 'Târgu-Mures', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5407, 25, 'Timisoara', 'ro', 'Romania');
INSERT INTO nuke_cities VALUES (5408, 1, 'Abakan', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5409, 2, 'Achinsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5410, 3, 'Aginskoje', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5411, 4, 'Almetjevsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5412, 5, 'Anadyr', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5413, 6, 'Angarsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5414, 7, 'Arhangelsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5415, 8, 'Armavir', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5416, 9, 'Arzamas', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5417, 10, 'Astrahan', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5418, 11, 'Balakovo', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5419, 12, 'Balashiha', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5420, 13, 'Barnaul', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5421, 14, 'Belgorod', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5422, 15, 'Berezniki', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5423, 16, 'Bijsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5424, 17, 'Birobidzhan', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5425, 18, 'Blagoveshchensk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5426, 19, 'Bratsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5427, 20, 'Brjansk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5428, 21, 'Cheboksary', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5429, 22, 'Cheljabinsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5430, 23, 'Cherepovec', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5431, 24, 'Cherkessk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5432, 25, 'Chita', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5433, 26, 'Dimitrovgrad', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5434, 27, 'Dudinka', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5435, 28, 'Dzerzhinsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5436, 29, 'Elektrostal', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5437, 30, 'Elista', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5438, 31, 'Engels', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5439, 32, 'Glazov', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5440, 33, 'Gorno-Altajsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5441, 34, 'Groznyj', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5442, 35, 'Habarovsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5443, 36, 'Hanty-Mansijsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5444, 37, 'Himki', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5445, 38, 'Irkutsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5446, 39, 'Ivanovo', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5447, 40, 'Izhevsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5448, 41, 'Jakutsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5449, 42, 'Jaroslavl', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5450, 43, 'Jekaterinburg', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5451, 44, 'Jelec', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5452, 45, 'Jessentuki', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5453, 46, 'Joshkar-Ola', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5454, 47, 'Juzhno-Sahalinsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5455, 48, 'Kaliningrad', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5456, 49, 'Kaluga', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5457, 50, 'Kamensk-Uralskij', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5458, 51, 'Kamyshin', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5459, 52, 'Kansk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5460, 53, 'Kazan', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5461, 54, 'Kemerovo', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5462, 55, 'Kirov', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5463, 56, 'Kiseljovsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5464, 57, 'Kislovodsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5465, 58, 'Kolomna', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5466, 59, 'Kolpino', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5467, 60, 'Komsomolsk-na-Amure', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5468, 61, 'Korolyov', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5469, 62, 'Kostroma', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5470, 63, 'Kovrov', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5471, 64, 'Krasnodar', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5472, 65, 'Krasnojarsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5473, 66, 'Kudymkar', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5474, 67, 'Kurgan', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5475, 68, 'Kursk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5476, 69, 'Kyzyl', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5477, 70, 'Leninsk-Kuzneckij', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5478, 71, 'Lipeck', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5479, 72, 'Ljubercy', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5480, 73, 'Magadan', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5481, 74, 'Magnitogorsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5482, 75, 'Mahackala', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5483, 76, 'Majkop', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5484, 77, 'Mezhdurechensk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5485, 78, 'Miass', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5486, 79, 'Michurinsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5487, 80, 'Moskva', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5488, 81, 'Murmansk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5489, 82, 'Murom', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5490, 83, 'Mytishchi', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5491, 84, 'Naberezhnyje Chelny', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5492, 85, 'Nahodka', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5493, 86, 'Nalchik', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5494, 87, 'Narjan-Mar', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5495, 88, 'Nazran', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5496, 89, 'Neftekamsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5497, 90, 'Nevinnomyssk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5498, 91, 'Nizhnekamsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5499, 92, 'Nizhnevartovsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5500, 93, 'Nizhnij Novgorod', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5501, 94, 'Nizhnij Tagil', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5502, 95, 'Noginsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5503, 96, 'Norilsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5504, 97, 'Novocheboksarsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5505, 98, 'Novocherkassk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5506, 99, 'Novokujbyshevsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5507, 100, 'Novokuzneck', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5508, 101, 'Novomoskovsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5509, 102, 'Novorossijsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5510, 103, 'Novoshahtinsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5511, 104, 'Novosibirsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5512, 105, 'Novotroick', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5513, 106, 'Obninsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5514, 107, 'Odincovo', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5515, 108, 'Oktjabrskij', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5516, 109, 'Omsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5517, 110, 'Orehovo-Zujevo', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5518, 111, 'Orenburg', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5519, 112, 'Orjol', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5520, 113, 'Orsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5521, 114, 'Palana', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5522, 115, 'Penza', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5523, 116, 'Perm', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5524, 117, 'Pervouralsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5525, 118, 'Petropavlovsk-Kamchatskij', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5526, 119, 'Petrozavodsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5527, 120, 'Pjatigorsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5528, 121, 'Podolsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5529, 122, 'Prokopjevsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5530, 123, 'Pskov', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5531, 124, 'Rjazan', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5532, 125, 'Rostov', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5533, 126, 'Rubcovsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5534, 127, 'Rybinsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5535, 128, 'Salavat', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5536, 129, 'Salehard', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5537, 130, 'Samara', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5538, 131, 'Sankt Peterburg', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5539, 132, 'Saransk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5540, 133, 'Sarapul', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5541, 134, 'Saratov', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5542, 135, 'Sergijev Posad', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5543, 136, 'Serpuhov', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5544, 137, 'Severodvinsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5545, 138, 'Seversk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5546, 139, 'Shahty', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5547, 140, 'Shchjolkovo', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5548, 141, 'Smolensk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5549, 142, 'Sochi', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5550, 143, 'Solikamsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5551, 144, 'Staryj Oskol', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5552, 145, 'Stavropol', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5553, 146, 'Sterlitamak', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5554, 147, 'Surgut', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5555, 148, 'Syktyvkar', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5556, 149, 'Syzran', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5557, 150, 'Taganrog', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5558, 151, 'Tambov', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5559, 152, 'Tjumen', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5560, 153, 'Toljatti', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5561, 154, 'Tomsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5562, 155, 'Tula', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5563, 156, 'Tura', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5564, 157, 'Tver', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5565, 158, 'Ufa', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5566, 159, 'Ulan-Ude', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5567, 160, 'Uljanovsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5568, 161, 'Usolje-Sibirskoje', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5569, 162, 'Ussurijsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5570, 163, 'Ust-Ilimsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5571, 164, 'Ust-Ordynskij', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5572, 165, 'Velikij Novgorod', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5573, 166, 'Velikije Luki', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5574, 167, 'Vladikavkaz', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5575, 168, 'Vladimir', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5576, 169, 'Vladivostok', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5577, 170, 'Volgodonsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5578, 171, 'Volgograd', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5579, 172, 'Vologda', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5580, 173, 'Volzhskij', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5581, 174, 'Voronezh', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5582, 175, 'Votkinsk', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5583, 176, 'Zeljenograd', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5584, 177, 'Zlatoust', 'ru', 'Russia');
INSERT INTO nuke_cities VALUES (5585, 1, 'Butare', 'rw', 'Rwanda');
INSERT INTO nuke_cities VALUES (5586, 2, 'Byumba', 'rw', 'Rwanda');
INSERT INTO nuke_cities VALUES (5587, 3, 'Cyangugu', 'rw', 'Rwanda');
INSERT INTO nuke_cities VALUES (5588, 4, 'Gikongoro', 'rw', 'Rwanda');
INSERT INTO nuke_cities VALUES (5589, 5, 'Gisenyi', 'rw', 'Rwanda');
INSERT INTO nuke_cities VALUES (5590, 6, 'Gitarama', 'rw', 'Rwanda');
INSERT INTO nuke_cities VALUES (5591, 7, 'Kibungo', 'rw', 'Rwanda');
INSERT INTO nuke_cities VALUES (5592, 8, 'Kibuye', 'rw', 'Rwanda');
INSERT INTO nuke_cities VALUES (5593, 9, 'Kigali', 'rw', 'Rwanda');
INSERT INTO nuke_cities VALUES (5594, 10, 'Nyanza', 'rw', 'Rwanda');
INSERT INTO nuke_cities VALUES (5595, 11, 'Ruhengeri', 'rw', 'Rwanda');
INSERT INTO nuke_cities VALUES (5596, 12, 'Rwamagana', 'rw', 'Rwanda');
INSERT INTO nuke_cities VALUES (5597, 1, 'ad-Dakhlah', 'eh', 'Sahara');
INSERT INTO nuke_cities VALUES (5598, 2, 'al-´Ayûn', 'eh', 'Sahara');
INSERT INTO nuke_cities VALUES (5599, 3, 'as-Samârah', 'eh', 'Sahara');
INSERT INTO nuke_cities VALUES (5600, 4, 'Bû Jaydûr', 'eh', 'Sahara');
INSERT INTO nuke_cities VALUES (5601, 1, 'Edinburgh', 'sh', 'Saint Helena');
INSERT INTO nuke_cities VALUES (5602, 2, 'Georgetown', 'sh', 'Saint Helena');
INSERT INTO nuke_cities VALUES (5603, 3, 'Gough Island', 'sh', 'Saint Helena');
INSERT INTO nuke_cities VALUES (5604, 4, 'Jamestown', 'sh', 'Saint Helena');
INSERT INTO nuke_cities VALUES (5605, 1, 'Basseterre', 'kn', 'Saint Kitts and Nevis');
INSERT INTO nuke_cities VALUES (5606, 2, 'Boyds', 'kn', 'Saint Kitts and Nevis');
INSERT INTO nuke_cities VALUES (5607, 3, 'Cayon', 'kn', 'Saint Kitts and Nevis');
INSERT INTO nuke_cities VALUES (5608, 4, 'Charlestown', 'kn', 'Saint Kitts and Nevis');
INSERT INTO nuke_cities VALUES (5609, 5, 'Cotton Ground', 'kn', 'Saint Kitts and Nevis');
INSERT INTO nuke_cities VALUES (5610, 6, 'Dieppe Bay', 'kn', 'Saint Kitts and Nevis');
INSERT INTO nuke_cities VALUES (5611, 7, 'Fig Tree', 'kn', 'Saint Kitts and Nevis');
INSERT INTO nuke_cities VALUES (5612, 8, 'Gingerland', 'kn', 'Saint Kitts and Nevis');
INSERT INTO nuke_cities VALUES (5613, 9, 'Mansion', 'kn', 'Saint Kitts and Nevis');
INSERT INTO nuke_cities VALUES (5614, 10, 'Middle Island', 'kn', 'Saint Kitts and Nevis');
INSERT INTO nuke_cities VALUES (5615, 11, 'Monkey Hill', 'kn', 'Saint Kitts and Nevis');
INSERT INTO nuke_cities VALUES (5616, 12, 'Newcastle', 'kn', 'Saint Kitts and Nevis');
INSERT INTO nuke_cities VALUES (5617, 13, 'Old Road', 'kn', 'Saint Kitts and Nevis');
INSERT INTO nuke_cities VALUES (5618, 14, 'Sadlers', 'kn', 'Saint Kitts and Nevis');
INSERT INTO nuke_cities VALUES (5619, 15, 'Saint Paul\'s', 'kn', 'Saint Kitts and Nevis');
INSERT INTO nuke_cities VALUES (5620, 16, 'Sandy Point', 'kn', 'Saint Kitts and Nevis');
INSERT INTO nuke_cities VALUES (5621, 17, 'Tabernacle', 'kn', 'Saint Kitts and Nevis');
INSERT INTO nuke_cities VALUES (5622, 1, 'Anse-la-Raye', 'lc', 'Saint Lucia');
INSERT INTO nuke_cities VALUES (5623, 2, 'Canaries', 'lc', 'Saint Lucia');
INSERT INTO nuke_cities VALUES (5624, 3, 'Cap Estate', 'lc', 'Saint Lucia');
INSERT INTO nuke_cities VALUES (5625, 4, 'Castries', 'lc', 'Saint Lucia');
INSERT INTO nuke_cities VALUES (5626, 5, 'Choc', 'lc', 'Saint Lucia');
INSERT INTO nuke_cities VALUES (5627, 6, 'Choiseul', 'lc', 'Saint Lucia');
INSERT INTO nuke_cities VALUES (5628, 7, 'Dennery', 'lc', 'Saint Lucia');
INSERT INTO nuke_cities VALUES (5629, 8, 'Gros Islet', 'lc', 'Saint Lucia');
INSERT INTO nuke_cities VALUES (5630, 9, 'Laborie', 'lc', 'Saint Lucia');
INSERT INTO nuke_cities VALUES (5631, 10, 'Micoud', 'lc', 'Saint Lucia');
INSERT INTO nuke_cities VALUES (5632, 11, 'Soufrière', 'lc', 'Saint Lucia');
INSERT INTO nuke_cities VALUES (5633, 12, 'Vieux Fort', 'lc', 'Saint Lucia');
INSERT INTO nuke_cities VALUES (5634, 1, 'Miquelon', 'pm', 'Saint Pierre & Miquelon');
INSERT INTO nuke_cities VALUES (5635, 2, 'Saint-Pierre', 'pm', 'Saint Pierre & Miquelon');
INSERT INTO nuke_cities VALUES (5636, 1, 'Barroualie', 'vc', 'St. Vincent & the Grenadines');
INSERT INTO nuke_cities VALUES (5637, 2, 'Biabou', 'vc', 'St. Vincent & the Grenadines');
INSERT INTO nuke_cities VALUES (5638, 3, 'Byera', 'vc', 'St. Vincent & the Grenadines');
INSERT INTO nuke_cities VALUES (5639, 4, 'Chateaubelair', 'vc', 'St. Vincent & the Grenadines');
INSERT INTO nuke_cities VALUES (5640, 5, 'Dovers', 'vc', 'St. Vincent & the Grenadines');
INSERT INTO nuke_cities VALUES (5641, 6, 'Georgetown', 'vc', 'St. Vincent & the Grenadines');
INSERT INTO nuke_cities VALUES (5642, 7, 'Hamilton', 'vc', 'St. Vincent & the Grenadines');
INSERT INTO nuke_cities VALUES (5643, 8, 'Kingstown', 'vc', 'St. Vincent & the Grenadines');
INSERT INTO nuke_cities VALUES (5644, 9, 'Layou', 'vc', 'St. Vincent & the Grenadines');
INSERT INTO nuke_cities VALUES (5645, 10, 'Port Elizabeth', 'vc', 'St. Vincent & the Grenadines');
INSERT INTO nuke_cities VALUES (5646, 1, 'A\'opo', 'ws', 'Samoa');
INSERT INTO nuke_cities VALUES (5647, 2, 'Apia', 'ws', 'Samoa');
INSERT INTO nuke_cities VALUES (5648, 3, 'Falelatai', 'ws', 'Samoa');
INSERT INTO nuke_cities VALUES (5649, 4, 'Gautavai', 'ws', 'Samoa');
INSERT INTO nuke_cities VALUES (5650, 5, 'Mulifanua', 'ws', 'Samoa');
INSERT INTO nuke_cities VALUES (5651, 6, 'Neiafu', 'ws', 'Samoa');
INSERT INTO nuke_cities VALUES (5652, 7, 'Safotulafai', 'ws', 'Samoa');
INSERT INTO nuke_cities VALUES (5653, 8, 'Samalae\'ulu', 'ws', 'Samoa');
INSERT INTO nuke_cities VALUES (5654, 9, 'Samamea', 'ws', 'Samoa');
INSERT INTO nuke_cities VALUES (5655, 10, 'Solosolo', 'ws', 'Samoa');
INSERT INTO nuke_cities VALUES (5656, 11, 'Taga', 'ws', 'Samoa');
INSERT INTO nuke_cities VALUES (5657, 1, 'Acquaviva', 'sm', 'San Marino');
INSERT INTO nuke_cities VALUES (5658, 2, 'Borgo Maggiore', 'sm', 'San Marino');
INSERT INTO nuke_cities VALUES (5659, 3, 'Chiesanuova', 'sm', 'San Marino');
INSERT INTO nuke_cities VALUES (5660, 4, 'Domagnano', 'sm', 'San Marino');
INSERT INTO nuke_cities VALUES (5661, 5, 'Faetano', 'sm', 'San Marino');
INSERT INTO nuke_cities VALUES (5662, 6, 'Fiorentino', 'sm', 'San Marino');
INSERT INTO nuke_cities VALUES (5663, 7, 'Montegiardino', 'sm', 'San Marino');
INSERT INTO nuke_cities VALUES (5664, 8, 'San Marino', 'sm', 'San Marino');
INSERT INTO nuke_cities VALUES (5665, 9, 'Serravalle', 'sm', 'San Marino');
INSERT INTO nuke_cities VALUES (5666, 1, 'Neves', 'st', 'São Tomé and Príncipe');
INSERT INTO nuke_cities VALUES (5667, 2, 'Santana', 'st', 'São Tomé and Príncipe');
INSERT INTO nuke_cities VALUES (5668, 3, 'Santo Amaro', 'st', 'São Tomé and Príncipe');
INSERT INTO nuke_cities VALUES (5669, 4, 'Santo António', 'st', 'São Tomé and Príncipe');
INSERT INTO nuke_cities VALUES (5670, 5, 'São Tomé', 'st', 'São Tomé and Príncipe');
INSERT INTO nuke_cities VALUES (5671, 6, 'Trindade', 'st', 'São Tomé and Príncipe');
INSERT INTO nuke_cities VALUES (5672, 1, '´Unayzah', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5673, 2, 'Abhâ', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5674, 3, 'ad-Dammâm', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5675, 4, 'al-Bâhah', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5676, 5, 'al-Hawîyah', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5677, 6, 'al-Hufûf', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5678, 7, 'al-Kharj', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5679, 8, 'al-Khubar', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5680, 9, 'al-Madînah', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5681, 10, 'al-Mubarraz', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5682, 11, 'al-Qatîf', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5683, 12, 'Ara´ar', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5684, 13, 'ar-Riyâd', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5685, 14, 'ath-Thuqbah', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5686, 15, 'at-Ta´if', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5687, 16, 'Buraydah', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5688, 17, 'Hâ´il', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5689, 18, 'Hafar-al-Bâtin', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5690, 19, 'Jawf', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5691, 20, 'Jiddah', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5692, 21, 'Jîzân', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5693, 22, 'Jubayl', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5694, 23, 'Khamîs Mushayt', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5695, 24, 'Makkah', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5696, 25, 'Najrân', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5697, 26, 'Tabûk', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5698, 27, 'Yanbu', 'sa', 'Saudi Arabia');
INSERT INTO nuke_cities VALUES (5699, 1, 'Bambey', 'sn', 'Senegal');
INSERT INTO nuke_cities VALUES (5700, 2, 'Bignona', 'sn', 'Senegal');
INSERT INTO nuke_cities VALUES (5701, 3, 'Dakar', 'sn', 'Senegal');
INSERT INTO nuke_cities VALUES (5702, 4, 'Diourbel', 'sn', 'Senegal');
INSERT INTO nuke_cities VALUES (5703, 5, 'Fatick', 'sn', 'Senegal');
INSERT INTO nuke_cities VALUES (5704, 6, 'Joal-Fadiouth', 'sn', 'Senegal');
INSERT INTO nuke_cities VALUES (5705, 7, 'Kaffrine', 'sn', 'Senegal');
INSERT INTO nuke_cities VALUES (5706, 8, 'Kaolack', 'sn', 'Senegal');
INSERT INTO nuke_cities VALUES (5707, 9, 'Kayar', 'sn', 'Senegal');
INSERT INTO nuke_cities VALUES (5708, 10, 'Kolda', 'sn', 'Senegal');
INSERT INTO nuke_cities VALUES (5709, 11, 'Louga', 'sn', 'Senegal');
INSERT INTO nuke_cities VALUES (5710, 12, 'Mbacké', 'sn', 'Senegal');
INSERT INTO nuke_cities VALUES (5711, 13, 'Mbour', 'sn', 'Senegal');
INSERT INTO nuke_cities VALUES (5712, 14, 'Pout', 'sn', 'Senegal');
INSERT INTO nuke_cities VALUES (5713, 15, 'Richard Toll', 'sn', 'Senegal');
INSERT INTO nuke_cities VALUES (5714, 16, 'Saint-Louis', 'sn', 'Senegal');
INSERT INTO nuke_cities VALUES (5715, 17, 'Tambacounda', 'sn', 'Senegal');
INSERT INTO nuke_cities VALUES (5716, 18, 'Thiès', 'sn', 'Senegal');
INSERT INTO nuke_cities VALUES (5717, 19, 'Tivaouane', 'sn', 'Senegal');
INSERT INTO nuke_cities VALUES (5718, 20, 'Ziguinchor', 'sn', 'Senegal');
INSERT INTO nuke_cities VALUES (5719, 1, 'Beograd', 'yu', 'Serbia and Montenegro');
INSERT INTO nuke_cities VALUES (5720, 2, 'Chachak', 'yu', 'Serbia and Montenegro');
INSERT INTO nuke_cities VALUES (5721, 3, 'Dhakovica', 'yu', 'Serbia and Montenegro');
INSERT INTO nuke_cities VALUES (5722, 4, 'Gnjilane', 'yu', 'Serbia and Montenegro');
INSERT INTO nuke_cities VALUES (5723, 5, 'Kosovska Mitrovica', 'yu', 'Serbia and Montenegro');
INSERT INTO nuke_cities VALUES (5724, 6, 'Kragujevac', 'yu', 'Serbia and Montenegro');
INSERT INTO nuke_cities VALUES (5725, 7, 'Kraljevo', 'yu', 'Serbia and Montenegro');
INSERT INTO nuke_cities VALUES (5726, 8, 'Leskovac', 'yu', 'Serbia and Montenegro');
INSERT INTO nuke_cities VALUES (5727, 9, 'Nikshic', 'yu', 'Serbia and Montenegro');
INSERT INTO nuke_cities VALUES (5728, 10, 'Nish', 'yu', 'Serbia and Montenegro');
INSERT INTO nuke_cities VALUES (5729, 11, 'Novi Sad', 'yu', 'Serbia and Montenegro');
INSERT INTO nuke_cities VALUES (5730, 12, 'Panchevo', 'yu', 'Serbia and Montenegro');
INSERT INTO nuke_cities VALUES (5731, 13, 'Pec', 'yu', 'Serbia and Montenegro');
INSERT INTO nuke_cities VALUES (5732, 14, 'Podgorica', 'yu', 'Serbia and Montenegro');
INSERT INTO nuke_cities VALUES (5733, 15, 'Prishtina', 'yu', 'Serbia and Montenegro');
INSERT INTO nuke_cities VALUES (5734, 16, 'Prizren', 'yu', 'Serbia and Montenegro');
INSERT INTO nuke_cities VALUES (5735, 17, 'Smederevo', 'yu', 'Serbia and Montenegro');
INSERT INTO nuke_cities VALUES (5736, 18, 'Subotica', 'yu', 'Serbia and Montenegro');
INSERT INTO nuke_cities VALUES (5737, 19, 'Valjevo', 'yu', 'Serbia and Montenegro');
INSERT INTO nuke_cities VALUES (5738, 20, 'Zrenjanin', 'yu', 'Serbia and Montenegro');
INSERT INTO nuke_cities VALUES (5739, 1, 'Anse Boileau', 'sc', 'Seychelles');
INSERT INTO nuke_cities VALUES (5740, 2, 'Anse Royal', 'sc', 'Seychelles');
INSERT INTO nuke_cities VALUES (5741, 3, 'Cascade', 'sc', 'Seychelles');
INSERT INTO nuke_cities VALUES (5742, 4, 'Takamaka', 'sc', 'Seychelles');
INSERT INTO nuke_cities VALUES (5743, 5, 'Victoria', 'sc', 'Seychelles');
INSERT INTO nuke_cities VALUES (5744, 1, 'Binkolo', 'sl', 'Sierra Leone');
INSERT INTO nuke_cities VALUES (5745, 2, 'Bo', 'sl', 'Sierra Leone');
INSERT INTO nuke_cities VALUES (5746, 3, 'Bonthe', 'sl', 'Sierra Leone');
INSERT INTO nuke_cities VALUES (5747, 4, 'Freetown', 'sl', 'Sierra Leone');
INSERT INTO nuke_cities VALUES (5748, 5, 'Kabala', 'sl', 'Sierra Leone');
INSERT INTO nuke_cities VALUES (5749, 6, 'Kailahun', 'sl', 'Sierra Leone');
INSERT INTO nuke_cities VALUES (5750, 7, 'Kenema', 'sl', 'Sierra Leone');
INSERT INTO nuke_cities VALUES (5751, 8, 'Koidu', 'sl', 'Sierra Leone');
INSERT INTO nuke_cities VALUES (5752, 9, 'Koindu', 'sl', 'Sierra Leone');
INSERT INTO nuke_cities VALUES (5753, 10, 'Lunsar', 'sl', 'Sierra Leone');
INSERT INTO nuke_cities VALUES (5754, 11, 'Magburaka', 'sl', 'Sierra Leone');
INSERT INTO nuke_cities VALUES (5755, 12, 'Makeni', 'sl', 'Sierra Leone');
INSERT INTO nuke_cities VALUES (5756, 13, 'Matru', 'sl', 'Sierra Leone');
INSERT INTO nuke_cities VALUES (5757, 14, 'Pepel', 'sl', 'Sierra Leone');
INSERT INTO nuke_cities VALUES (5758, 15, 'Port Loko', 'sl', 'Sierra Leone');
INSERT INTO nuke_cities VALUES (5759, 16, 'Sefadu', 'sl', 'Sierra Leone');
INSERT INTO nuke_cities VALUES (5760, 17, 'Taiama', 'sl', 'Sierra Leone');
INSERT INTO nuke_cities VALUES (5761, 18, 'Yele', 'sl', 'Sierra Leone');
INSERT INTO nuke_cities VALUES (5762, 19, 'Yengema', 'sl', 'Sierra Leone');
INSERT INTO nuke_cities VALUES (5763, 20, 'York', 'sl', 'Sierra Leone');
INSERT INTO nuke_cities VALUES (5764, 1, 'Singapore', 'sg', 'Singapore');
INSERT INTO nuke_cities VALUES (5765, 1, 'Banská Bystrica', 'sk', 'Slovakia');
INSERT INTO nuke_cities VALUES (5766, 2, 'Bardejov', 'sk', 'Slovakia');
INSERT INTO nuke_cities VALUES (5767, 3, 'Bratislava', 'sk', 'Slovakia');
INSERT INTO nuke_cities VALUES (5768, 4, 'Humenné', 'sk', 'Slovakia');
INSERT INTO nuke_cities VALUES (5769, 5, 'Komárno', 'sk', 'Slovakia');
INSERT INTO nuke_cities VALUES (5770, 6, 'Koshice', 'sk', 'Slovakia');
INSERT INTO nuke_cities VALUES (5771, 7, 'Levice', 'sk', 'Slovakia');
INSERT INTO nuke_cities VALUES (5772, 8, 'Martin', 'sk', 'Slovakia');
INSERT INTO nuke_cities VALUES (5773, 9, 'Michalovce', 'sk', 'Slovakia');
INSERT INTO nuke_cities VALUES (5774, 10, 'Nitra', 'sk', 'Slovakia');
INSERT INTO nuke_cities VALUES (5775, 11, 'Nové Zámky', 'sk', 'Slovakia');
INSERT INTO nuke_cities VALUES (5776, 12, 'Poprad', 'sk', 'Slovakia');
INSERT INTO nuke_cities VALUES (5777, 13, 'Povazhská Bystrica', 'sk', 'Slovakia');
INSERT INTO nuke_cities VALUES (5778, 14, 'Preshov', 'sk', 'Slovakia');
INSERT INTO nuke_cities VALUES (5779, 15, 'Prievidza', 'sk', 'Slovakia');
INSERT INTO nuke_cities VALUES (5780, 16, 'Spishská Nová Ves', 'sk', 'Slovakia');
INSERT INTO nuke_cities VALUES (5781, 17, 'Trenchín', 'sk', 'Slovakia');
INSERT INTO nuke_cities VALUES (5782, 18, 'Trnava', 'sk', 'Slovakia');
INSERT INTO nuke_cities VALUES (5783, 19, 'Zhilina', 'sk', 'Slovakia');
INSERT INTO nuke_cities VALUES (5784, 20, 'Zvolen', 'sk', 'Slovakia');
INSERT INTO nuke_cities VALUES (5785, 1, 'Celje', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5786, 2, 'Domzhale', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5787, 3, 'Izola', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5788, 4, 'Jesenice', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5789, 5, 'Kamnik', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5790, 6, 'Kochevje', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5791, 7, 'Koper', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5792, 8, 'Kranj', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5793, 9, 'Krshko', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5794, 10, 'Ljubljana', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5795, 11, 'Maribor', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5796, 12, 'Murska Sobota', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5797, 13, 'Nova Gorica', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5798, 14, 'Novo Mesto', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5799, 15, 'Postojna', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5800, 16, 'Ptuj', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5801, 17, 'Ravne', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5802, 18, 'Shkofja Loka', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5803, 19, 'Slovenj Gradec', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5804, 20, 'Trbovlje', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5805, 21, 'Velenje', 'si', 'Slovenia');
INSERT INTO nuke_cities VALUES (5806, 1, 'Adamstown', 'xg', 'Smaller Territories of the UK');
INSERT INTO nuke_cities VALUES (5807, 1, 'Auki', 'sb', 'Solomon Islands');
INSERT INTO nuke_cities VALUES (5808, 2, 'Buala', 'sb', 'Solomon Islands');
INSERT INTO nuke_cities VALUES (5809, 3, 'Gizo', 'sb', 'Solomon Islands');
INSERT INTO nuke_cities VALUES (5810, 4, 'Honiara', 'sb', 'Solomon Islands');
INSERT INTO nuke_cities VALUES (5811, 5, 'Kirakira', 'sb', 'Solomon Islands');
INSERT INTO nuke_cities VALUES (5812, 6, 'Lata', 'sb', 'Solomon Islands');
INSERT INTO nuke_cities VALUES (5813, 7, 'Taro Island', 'sb', 'Solomon Islands');
INSERT INTO nuke_cities VALUES (5814, 8, 'Tigoa', 'sb', 'Solomon Islands');
INSERT INTO nuke_cities VALUES (5815, 9, 'Tulagi', 'sb', 'Solomon Islands');
INSERT INTO nuke_cities VALUES (5816, 1, '´Adâdlay', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5817, 2, '´Êldhêre', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5818, 3, '´Êrigabo', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5819, 4, 'Afgôye', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5820, 5, 'Awdhêgle', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5821, 6, 'Baki', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5822, 7, 'Barâwe', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5823, 8, 'Bârdhêre', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5824, 9, 'Baydhabo', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5825, 10, 'Beled Wêyne', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5826, 11, 'Berbera', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5827, 12, 'Bôsâso', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5828, 13, 'Bûr Hakkaba', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5829, 14, 'Bur´o', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5830, 15, 'Dhûsa Marrêb', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5831, 16, 'Gâlka´yo', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5832, 17, 'Garbahârey', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5833, 18, 'Garôwe', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5834, 19, 'Hargeysa', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5835, 20, 'Jamâme', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5836, 21, 'Jawhar', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5837, 22, 'Jilib', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5838, 23, 'Kismâyo', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5839, 24, 'Lâs´ânôd', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5840, 25, 'Marka', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5841, 26, 'Muqdîsho', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5842, 27, 'Qoryôley', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5843, 28, 'Wanlaweyn', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5844, 29, 'Xuddur', 'so', 'Somalia');
INSERT INTO nuke_cities VALUES (5845, 1, 'Alberton', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5846, 2, 'Benoni', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5847, 3, 'Bisho', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5848, 4, 'Bloemfontein', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5849, 5, 'Boksburg', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5850, 6, 'Botshabelo', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5851, 7, 'Brakpan', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5852, 8, 'Cape Town', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5853, 9, 'Carltonville', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5854, 10, 'Durban', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5855, 11, 'East London', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5856, 12, 'Emnambithi', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5857, 13, 'George', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5858, 14, 'Johannesburg', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5859, 15, 'Kimberley', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5860, 16, 'Klerksdorp', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5861, 17, 'Krugersdorp', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5862, 18, 'Mhluzi', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5863, 19, 'Midrand', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5864, 20, 'Mmabatho', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5865, 21, 'Mogalakwena', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5866, 22, 'Msunduzi', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5867, 23, 'Nelspruit', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5868, 24, 'Newcastle', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5869, 25, 'Nigel', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5870, 26, 'Paarl', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5871, 27, 'Phalaborwa', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5872, 28, 'Pietersburg', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5873, 29, 'Port Elizabeth', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5874, 30, 'Potchefstroom', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5875, 31, 'Pretoria', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5876, 32, 'Randfontein', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5877, 33, 'Rustenburg', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5878, 34, 'Somerset West', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5879, 35, 'Soweto', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5880, 36, 'Springs', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5881, 37, 'Tembisa', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5882, 38, 'Uitenhage', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5883, 39, 'Vanderbijlpark', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5884, 40, 'Vereeniging', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5885, 41, 'Verwoerdburg', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5886, 42, 'Welkom', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5887, 43, 'Westonaria', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5888, 44, 'Witbank', 'za', 'South Africa');
INSERT INTO nuke_cities VALUES (5889, 1, 'A Coruña', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5890, 2, 'Alacant', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5891, 3, 'Albacete', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5892, 4, 'Alcalá de Henares', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5893, 5, 'Alcorcón', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5894, 6, 'Algeciras', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5895, 7, 'Almería', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5896, 8, 'Ávila', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5897, 9, 'Badajoz', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5898, 10, 'Badalona', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5899, 11, 'Barcelona', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5900, 12, 'Bilbao', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5901, 13, 'Burgos', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5902, 14, 'Cáceres', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5903, 15, 'Cádiz', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5904, 16, 'Cartagena', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5905, 17, 'Castelló', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5906, 18, 'Ceuta', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5907, 19, 'Ciudad Real', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5908, 20, 'Córdoba', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5909, 21, 'Cuenca', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5910, 22, 'Donostia', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5911, 23, 'Dos Hermanas', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5912, 24, 'Elx', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5913, 25, 'Fuenlabrada', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5914, 26, 'Getafe', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5915, 27, 'Gijón', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5916, 28, 'Girona', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5917, 29, 'Granada', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5918, 30, 'Guadalajara', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5919, 31, 'Huelva', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5920, 32, 'Huesca', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5921, 33, 'Iruña', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5922, 34, 'Jaén', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5923, 35, 'Jerez', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5924, 36, 'Las Palmas', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5925, 37, 'Leganés', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5926, 38, 'León', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5927, 39, 'L\'Hospitalet de Llobregat', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5928, 40, 'Lleida', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5929, 41, 'Logroño', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5930, 42, 'Lugo', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5931, 43, 'Madrid', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5932, 44, 'Málaga', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5933, 45, 'Marbella', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5934, 46, 'Mataró', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5935, 47, 'Melilla', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5936, 48, 'Móstoles', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5937, 49, 'Murcia', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5938, 50, 'Ourense', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5939, 51, 'Oviedo', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5940, 52, 'Palencia', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5941, 53, 'Palma', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5942, 54, 'Pontevedra', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5943, 55, 'Sabadell', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5944, 56, 'Salamanca', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5945, 57, 'San Cristóbal de la Laguna', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5946, 58, 'Santa Coloma de Gramenet', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5947, 59, 'Santa Cruz de Tenerife', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5948, 60, 'Santander', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5949, 61, 'Segovia', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5950, 62, 'Sevilla', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5951, 63, 'Soria', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5952, 64, 'Tarragona', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5953, 65, 'Terrassa', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5954, 66, 'Teruel', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5955, 67, 'Toledo', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5956, 68, 'Torrejón de Ardoz', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5957, 69, 'Valencia', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5958, 70, 'Valladolid', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5959, 71, 'Vigo', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5960, 72, 'Vitoria', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5961, 73, 'Zamora', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5962, 74, 'Zaragoza', 'es', 'Spain');
INSERT INTO nuke_cities VALUES (5963, 1, 'Amparai', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5964, 2, 'Anurâdhapûraya', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5965, 3, 'Badulla', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5966, 4, 'Battaramulla', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5967, 5, 'Châvâkachchêri', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5968, 6, 'Daluguma', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5969, 7, 'Dambulla', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5970, 8, 'Dehiwala-Mount Lavinia', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5971, 9, 'Gâlla', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5972, 10, 'Galmûnê', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5973, 11, 'Gampaha', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5974, 12, 'Hambantota', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5975, 13, 'Kalutara', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5976, 14, 'Katunayaka', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5977, 15, 'Kêgalla', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5978, 16, 'Kilinochchi', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5979, 17, 'Kolamba', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5980, 18, 'Kotikawatta', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5981, 19, 'Kurunegala', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5982, 20, 'Madakalpûwa', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5983, 21, 'Maha Nuwara', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5984, 22, 'Maharagama', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5985, 23, 'Mannârama', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5986, 24, 'Mâtale', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5987, 25, 'Mâtara', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5988, 26, 'Mîgamuwa', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5989, 27, 'Monaragala', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5990, 28, 'Moratuwa', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5991, 29, 'Mullaitivu', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5992, 30, 'Nuwara Eliya', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5993, 31, 'Pêduru Tuduwa', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5994, 32, 'Polonnaruwa', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5995, 33, 'Pûttalama', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5996, 34, 'Ratnapûraya', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5997, 35, 'Sri Jayawardenepura', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5998, 36, 'Tirikunâmalaya', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (5999, 37, 'Vavuniyâwa', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (6000, 38, 'Yâpanaya', 'lk', 'Sri Lanka');
INSERT INTO nuke_cities VALUES (6001, 1, '´Atbarah', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6002, 2, 'ad-Damazîn', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6003, 3, 'ad-Dâmîr', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6004, 4, 'ad-Du´ayn', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6005, 5, 'al-Fâshir', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6006, 6, 'al-Fûlah', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6007, 7, 'al-Junaynah', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6008, 8, 'al-Khartûm', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6009, 9, 'al-Khartûm Bahrî', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6010, 10, 'al-Manâqil', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6011, 11, 'al-Qadârif', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6012, 12, 'al-Ubayyid', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6013, 13, 'Bentiu', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6014, 14, 'Bûr', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6015, 15, 'Bûr Sûdân', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6016, 16, 'Dunqulah', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6017, 17, 'Jûbâ', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6018, 18, 'Kâduqlî', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6019, 19, 'Kâpôêta', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6020, 20, 'Kassalâ', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6021, 21, 'Kûstî', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6022, 22, 'Malakâl', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6023, 23, 'Niyâlâ', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6024, 24, 'Rabak', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6025, 25, 'Rumbîk', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6026, 26, 'Sinjah', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6027, 27, 'Sinnâr', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6028, 28, 'Tonj', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6029, 29, 'Umm Durmân', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6030, 30, 'Uwayl', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6031, 31, 'Wad Madanî', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6032, 32, 'Wâw', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6033, 33, 'Yambio', 'sd', 'Sudan');
INSERT INTO nuke_cities VALUES (6034, 1, 'Albina', 'sr', 'Suriname');
INSERT INTO nuke_cities VALUES (6035, 2, 'Brokopondo', 'sr', 'Suriname');
INSERT INTO nuke_cities VALUES (6036, 3, 'Brownsweg', 'sr', 'Suriname');
INSERT INTO nuke_cities VALUES (6037, 4, 'Groningen', 'sr', 'Suriname');
INSERT INTO nuke_cities VALUES (6038, 5, 'Lelydorp', 'sr', 'Suriname');
INSERT INTO nuke_cities VALUES (6039, 6, 'Marienburg', 'sr', 'Suriname');
INSERT INTO nuke_cities VALUES (6040, 7, 'Meerzorg', 'sr', 'Suriname');
INSERT INTO nuke_cities VALUES (6041, 8, 'Moengo', 'sr', 'Suriname');
INSERT INTO nuke_cities VALUES (6042, 9, 'Nieuw Amsterdam', 'sr', 'Suriname');
INSERT INTO nuke_cities VALUES (6043, 10, 'Nieuw Nickerie', 'sr', 'Suriname');
INSERT INTO nuke_cities VALUES (6044, 11, 'Onverwacht', 'sr', 'Suriname');
INSERT INTO nuke_cities VALUES (6045, 12, 'Paramaribo', 'sr', 'Suriname');
INSERT INTO nuke_cities VALUES (6046, 13, 'Totness', 'sr', 'Suriname');
INSERT INTO nuke_cities VALUES (6047, 14, 'Wageningen', 'sr', 'Suriname');
INSERT INTO nuke_cities VALUES (6048, 1, 'Barentsburg', 'sj', 'Svalbard and Jan Mayen');
INSERT INTO nuke_cities VALUES (6049, 2, 'Hornsund', 'sj', 'Svalbard and Jan Mayen');
INSERT INTO nuke_cities VALUES (6050, 3, 'Isfjord Radio', 'sj', 'Svalbard and Jan Mayen');
INSERT INTO nuke_cities VALUES (6051, 4, 'Longyearbyen', 'sj', 'Svalbard and Jan Mayen');
INSERT INTO nuke_cities VALUES (6052, 5, 'Ny-Ålesund', 'sj', 'Svalbard and Jan Mayen');
INSERT INTO nuke_cities VALUES (6053, 1, 'Bhunya', 'sz', 'Swaziland');
INSERT INTO nuke_cities VALUES (6054, 2, 'Big Bend', 'sz', 'Swaziland');
INSERT INTO nuke_cities VALUES (6055, 3, 'Bulembu', 'sz', 'Swaziland');
INSERT INTO nuke_cities VALUES (6056, 4, 'Hluti', 'sz', 'Swaziland');
INSERT INTO nuke_cities VALUES (6057, 5, 'Kwaluseni', 'sz', 'Swaziland');
INSERT INTO nuke_cities VALUES (6058, 6, 'Lobamba', 'sz', 'Swaziland');
INSERT INTO nuke_cities VALUES (6059, 7, 'Manzini', 'sz', 'Swaziland');
INSERT INTO nuke_cities VALUES (6060, 8, 'Matsapha', 'sz', 'Swaziland');
INSERT INTO nuke_cities VALUES (6061, 9, 'Mbabane', 'sz', 'Swaziland');
INSERT INTO nuke_cities VALUES (6062, 10, 'Mhlambanyatsi', 'sz', 'Swaziland');
INSERT INTO nuke_cities VALUES (6063, 11, 'Mhlume', 'sz', 'Swaziland');
INSERT INTO nuke_cities VALUES (6064, 12, 'Mondi', 'sz', 'Swaziland');
INSERT INTO nuke_cities VALUES (6065, 13, 'Nhlangano', 'sz', 'Swaziland');
INSERT INTO nuke_cities VALUES (6066, 14, 'Nsoko', 'sz', 'Swaziland');
INSERT INTO nuke_cities VALUES (6067, 15, 'Pigg\'s Peak', 'sz', 'Swaziland');
INSERT INTO nuke_cities VALUES (6068, 16, 'Sidvokodvo', 'sz', 'Swaziland');
INSERT INTO nuke_cities VALUES (6069, 17, 'Simunye', 'sz', 'Swaziland');
INSERT INTO nuke_cities VALUES (6070, 18, 'Siteki', 'sz', 'Swaziland');
INSERT INTO nuke_cities VALUES (6071, 19, 'Thabankulu', 'sz', 'Swaziland');
INSERT INTO nuke_cities VALUES (6072, 20, 'Tshaneni', 'sz', 'Swaziland');
INSERT INTO nuke_cities VALUES (6073, 1, 'Borås', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6074, 2, 'Eskilstuna', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6075, 3, 'Falun', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6076, 4, 'Gävle', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6077, 5, 'Göteborg', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6078, 6, 'Halmstad', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6079, 7, 'Härnösand', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6080, 8, 'Helsingborg', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6081, 9, 'Jönköping', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6082, 10, 'Kalmar', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6083, 11, 'Karlskrona', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6084, 12, 'Karlstad', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6085, 13, 'Linköping', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6086, 14, 'Luleå', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6087, 15, 'Lund', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6088, 16, 'Malmö', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6089, 17, 'Norrköping', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6090, 18, 'Nyköping', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6091, 19, 'Örebro', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6092, 20, 'Östersund', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6093, 21, 'Södertälje', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6094, 22, 'Stockholm', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6095, 23, 'Täby', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6096, 24, 'Umeå', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6097, 25, 'Uppsala', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6098, 26, 'Västerås', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6099, 27, 'Växjö', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6100, 28, 'Visby', 'se', 'Sweden');
INSERT INTO nuke_cities VALUES (6101, 1, 'Aarau', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6102, 2, 'Altdorf', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6103, 3, 'Appenzell', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6104, 4, 'Basel', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6105, 5, 'Bellinzona', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6106, 6, 'Bern', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6107, 7, 'Biel', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6108, 8, 'Chur', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6109, 9, 'Delémont', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6110, 10, 'Emmen', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6111, 11, 'Frauenfeld', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6112, 12, 'Fribourg', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6113, 13, 'Genève', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6114, 14, 'Glarus', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6115, 15, 'Herisau', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6116, 16, 'Köniz', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6117, 17, 'La Chaux-de-Fonds', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6118, 18, 'Lausanne', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6119, 19, 'Liestal', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6120, 20, 'Luzern', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6121, 21, 'Neuchâtel', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6122, 22, 'Sankt Gallen', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6123, 23, 'Sarnen', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6124, 24, 'Schaffhausen', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6125, 25, 'Schwyz', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6126, 26, 'Sion', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6127, 27, 'Solothurn', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6128, 28, 'Stans', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6129, 29, 'Thun', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6130, 30, 'Uster', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6131, 31, 'Vernier', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6132, 32, 'Winterthur', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6133, 33, 'Zug', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6134, 34, 'Zürich', 'ch', 'Switzerland');
INSERT INTO nuke_cities VALUES (6135, 1, 'al-Hasakah', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6136, 2, 'al-Lâdhiqîyah', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6137, 3, 'al-Qâmishlî', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6138, 4, 'al-Qunaytirah', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6139, 5, 'ar-Raqqah', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6140, 6, 'as-Suwaydâ', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6141, 7, 'ath-Thawrah', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6142, 8, 'Dar´â', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6143, 9, 'Dârayyâ', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6144, 10, 'Dayr az-Zawr', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6145, 11, 'Dimashq', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6146, 12, 'Dûmâ', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6147, 13, 'Halab', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6148, 14, 'Hamâh', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6149, 15, 'Hims', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6150, 16, 'Idlib', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6151, 17, 'Jaramânah', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6152, 18, 'Ma´arrat-an-Nu´mân', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6153, 19, 'Manbij', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6154, 20, 'Salamîyah', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6155, 21, 'Tartûs', 'sy', 'Syria');
INSERT INTO nuke_cities VALUES (6156, 1, 'Changhwa', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6157, 2, 'Chiayi', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6158, 3, 'Chungho', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6159, 4, 'Chungli', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6160, 5, 'Fengshan', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6161, 6, 'Fengyuan', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6162, 7, 'Hsichih', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6163, 8, 'Hsinchu', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6164, 9, 'Hsinchuang', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6165, 10, 'Hsintien', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6166, 11, 'Hsinying', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6167, 12, 'Hualian', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6168, 13, 'Ilan', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6169, 14, 'Kangshan', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6170, 15, 'Kaohsiung', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6171, 16, 'Keelung', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6172, 17, 'Kincheng', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6173, 18, 'Luchou', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6174, 19, 'Makung', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6175, 20, 'Miaoli', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6176, 21, 'Nantou', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6177, 22, 'Panchiao', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6178, 23, 'Pate', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6179, 24, 'Pingchen', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6180, 25, 'Pingtung', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6181, 26, 'Sanchung', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6182, 27, 'Shulin', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6183, 28, 'Taichung', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6184, 29, 'Tainan', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6185, 30, 'Taipei', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6186, 31, 'Taitung', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6187, 32, 'Tali', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6188, 33, 'Tanshui', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6189, 34, 'Taoyuan', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6190, 35, 'Touliu', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6191, 36, 'Tucheng', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6192, 37, 'Yangmei', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6193, 38, 'Yuanlin', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6194, 39, 'Yungho', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6195, 40, 'Yungkang', 'tw', 'Taiwan');
INSERT INTO nuke_cities VALUES (6196, 1, 'Chkalov', 'tj', 'Tajikistan');
INSERT INTO nuke_cities VALUES (6197, 2, 'Chorku', 'tj', 'Tajikistan');
INSERT INTO nuke_cities VALUES (6198, 3, 'Dangara', 'tj', 'Tajikistan');
INSERT INTO nuke_cities VALUES (6199, 4, 'Dushanbe', 'tj', 'Tajikistan');
INSERT INTO nuke_cities VALUES (6200, 5, 'Farkhor', 'tj', 'Tajikistan');
INSERT INTO nuke_cities VALUES (6201, 6, 'Hisor', 'tj', 'Tajikistan');
INSERT INTO nuke_cities VALUES (6202, 7, 'Isfara', 'tj', 'Tajikistan');
INSERT INTO nuke_cities VALUES (6203, 8, 'Khorug', 'tj', 'Tajikistan');
INSERT INTO nuke_cities VALUES (6204, 9, 'Khujand', 'tj', 'Tajikistan');
INSERT INTO nuke_cities VALUES (6205, 10, 'Kofarnihon', 'tj', 'Tajikistan');
INSERT INTO nuke_cities VALUES (6206, 11, 'Konibodom', 'tj', 'Tajikistan');
INSERT INTO nuke_cities VALUES (6207, 12, 'Kulob', 'tj', 'Tajikistan');
INSERT INTO nuke_cities VALUES (6208, 13, 'Leninskiy', 'tj', 'Tajikistan');
INSERT INTO nuke_cities VALUES (6209, 14, 'Nurak', 'tj', 'Tajikistan');
INSERT INTO nuke_cities VALUES (6210, 15, 'Panjakent', 'tj', 'Tajikistan');
INSERT INTO nuke_cities VALUES (6211, 16, 'Qurgonteppa', 'tj', 'Tajikistan');
INSERT INTO nuke_cities VALUES (6212, 17, 'Tursunzoda', 'tj', 'Tajikistan');
INSERT INTO nuke_cities VALUES (6213, 18, 'Uroteppa', 'tj', 'Tajikistan');
INSERT INTO nuke_cities VALUES (6214, 19, 'Vose', 'tj', 'Tajikistan');
INSERT INTO nuke_cities VALUES (6215, 20, 'Yovon', 'tj', 'Tajikistan');
INSERT INTO nuke_cities VALUES (6216, 1, 'Arusha', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6217, 2, 'Bukoba', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6218, 3, 'Dar es Salaam', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6219, 4, 'Dodoma', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6220, 5, 'Iringa', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6221, 6, 'Kibaha', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6222, 7, 'Kigoma', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6223, 8, 'Kilosa', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6224, 9, 'Korogwe', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6225, 10, 'Lindi', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6226, 11, 'Mbeya', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6227, 12, 'Morogoro', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6228, 13, 'Moshi', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6229, 14, 'Mpanda', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6230, 15, 'Mtwara', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6231, 16, 'Musoma', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6232, 17, 'Mwanza', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6233, 18, 'Shinyanga', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6234, 19, 'Singida', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6235, 20, 'Songea', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6236, 21, 'Sumbawanga', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6237, 22, 'Tabora', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6238, 23, 'Tanga', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6239, 24, 'Zanzibar', 'tz', 'Tanzania');
INSERT INTO nuke_cities VALUES (6240, 1, 'Alfred-Faure', 'tf', 'Terres Australes');
INSERT INTO nuke_cities VALUES (6241, 2, 'Martin-de-Viviès', 'tf', 'Terres Australes');
INSERT INTO nuke_cities VALUES (6242, 3, 'Port-aux-Français', 'tf', 'Terres Australes');
INSERT INTO nuke_cities VALUES (6243, 1, 'Amnat Charoen', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6244, 2, 'Ang Thong', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6245, 3, 'Ayutthaya', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6246, 4, 'Buri Ram', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6247, 5, 'Chachoengsao', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6248, 6, 'Chai Nat', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6249, 7, 'Chaiyaphum', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6250, 8, 'Chanthaburi', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6251, 9, 'Chiang Mai', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6252, 10, 'Chiang Rai', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6253, 11, 'Chon Buri', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6254, 12, 'Chumphon', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6255, 13, 'Hat Yai', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6256, 14, 'Kalasin', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6257, 15, 'Kamphaeng Phet', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6258, 16, 'Kanchanaburi', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6259, 17, 'Khlong Luang', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6260, 18, 'Khon Kaen', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6261, 19, 'Krabi', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6262, 20, 'Krung Thep', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6263, 21, 'Lampang', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6264, 22, 'Lamphun', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6265, 23, 'Loei', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6266, 24, 'Lop Buri', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6267, 25, 'Mae Hong Son', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6268, 26, 'Maha Sarakham', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6269, 27, 'Mukdahan', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6270, 28, 'Nakhon Nayok', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6271, 29, 'Nakhon Pathom', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6272, 30, 'Nakhon Phanom', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6273, 31, 'Nakhon Ratchasima', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6274, 32, 'Nakhon Sawan', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6275, 33, 'Nakhon Si Thammarat', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6276, 34, 'Nan', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6277, 35, 'Narathiwat', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6278, 36, 'Nong Bua Lam Phu', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6279, 37, 'Nong Khai', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6280, 38, 'Nonthaburi', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6281, 39, 'Pak Kret', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6282, 40, 'Pathum Thani', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6283, 41, 'Pattani', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6284, 42, 'Phangnga', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6285, 43, 'Phatthalung', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6286, 44, 'Phayao', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6287, 45, 'Phetchabun', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6288, 46, 'Phetchaburi', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6289, 47, 'Phichit', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6290, 48, 'Phitsanulok', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6291, 49, 'Phra Pradaeng', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6292, 50, 'Phrae', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6293, 51, 'Phuket', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6294, 52, 'Prachin Buri', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6295, 53, 'Prachuap Khiri Khan', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6296, 54, 'Ranong', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6297, 55, 'Ratchaburi', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6298, 56, 'Rayong', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6299, 57, 'Roi Et', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6300, 58, 'Sa Kaeo', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6301, 59, 'Sakhon Nakhon', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6302, 60, 'Samut Prakan', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6303, 61, 'Samut Sakhon', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6304, 62, 'Samut Songkhram', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6305, 63, 'Saraburi', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6306, 64, 'Satun', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6307, 65, 'Si Racha', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6308, 66, 'Si Sa Ket', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6309, 67, 'Sing Buri', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6310, 68, 'Songkhla', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6311, 69, 'Sukhothai', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6312, 70, 'Suphan Buri', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6313, 71, 'Surat Thani', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6314, 72, 'Surin', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6315, 73, 'Tak', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6316, 74, 'Thanyaburi', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6317, 75, 'Trang', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6318, 76, 'Trat', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6319, 77, 'Ubon Ratchathani', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6320, 78, 'Udon Thani', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6321, 79, 'Uthai Thani', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6322, 80, 'Uttaradit', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6323, 81, 'Yala', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6324, 82, 'Yasothon', 'th', 'Thailand');
INSERT INTO nuke_cities VALUES (6325, 1, 'Aného', 'tg', 'Togo');
INSERT INTO nuke_cities VALUES (6326, 2, 'Anié', 'tg', 'Togo');
INSERT INTO nuke_cities VALUES (6327, 3, 'Atakpamé', 'tg', 'Togo');
INSERT INTO nuke_cities VALUES (6328, 4, 'Badou', 'tg', 'Togo');
INSERT INTO nuke_cities VALUES (6329, 5, 'Bafilo', 'tg', 'Togo');
INSERT INTO nuke_cities VALUES (6330, 6, 'Bassar', 'tg', 'Togo');
INSERT INTO nuke_cities VALUES (6331, 7, 'Blitta', 'tg', 'Togo');
INSERT INTO nuke_cities VALUES (6332, 8, 'Dapaong', 'tg', 'Togo');
INSERT INTO nuke_cities VALUES (6333, 9, 'Kara', 'tg', 'Togo');
INSERT INTO nuke_cities VALUES (6334, 10, 'Kpalimé', 'tg', 'Togo');
INSERT INTO nuke_cities VALUES (6335, 11, 'Lomé', 'tg', 'Togo');
INSERT INTO nuke_cities VALUES (6336, 12, 'Mango', 'tg', 'Togo');
INSERT INTO nuke_cities VALUES (6337, 13, 'Niamtougou', 'tg', 'Togo');
INSERT INTO nuke_cities VALUES (6338, 14, 'Notsé', 'tg', 'Togo');
INSERT INTO nuke_cities VALUES (6339, 15, 'Sokodé', 'tg', 'Togo');
INSERT INTO nuke_cities VALUES (6340, 16, 'Sotouboua', 'tg', 'Togo');
INSERT INTO nuke_cities VALUES (6341, 17, 'Tandjouaré', 'tg', 'Togo');
INSERT INTO nuke_cities VALUES (6342, 18, 'Tchamba', 'tg', 'Togo');
INSERT INTO nuke_cities VALUES (6343, 19, 'Tsévié', 'tg', 'Togo');
INSERT INTO nuke_cities VALUES (6344, 20, 'Vogan', 'tg', 'Togo');
INSERT INTO nuke_cities VALUES (6345, 1, 'Atafu', 'tk', 'Tokelau');
INSERT INTO nuke_cities VALUES (6346, 2, 'Fakaofo', 'tk', 'Tokelau');
INSERT INTO nuke_cities VALUES (6347, 3, 'Nukunonu', 'tk', 'Tokelau');
INSERT INTO nuke_cities VALUES (6348, 1, 'Haveloloto', 'to', 'Tonga');
INSERT INTO nuke_cities VALUES (6349, 2, 'Hihifo', 'to', 'Tonga');
INSERT INTO nuke_cities VALUES (6350, 3, 'Mu\'a', 'to', 'Tonga');
INSERT INTO nuke_cities VALUES (6351, 4, 'Neiafu', 'to', 'Tonga');
INSERT INTO nuke_cities VALUES (6352, 5, 'Nuku\'alofa', 'to', 'Tonga');
INSERT INTO nuke_cities VALUES (6353, 6, 'Ohonua', 'to', 'Tonga');
INSERT INTO nuke_cities VALUES (6354, 7, 'Pangai', 'to', 'Tonga');
INSERT INTO nuke_cities VALUES (6355, 8, 'Tofoa-Koloua', 'to', 'Tonga');
INSERT INTO nuke_cities VALUES (6356, 9, 'Vaini', 'to', 'Tonga');
INSERT INTO nuke_cities VALUES (6357, 1, 'Arima', 'tt', 'Trinidad and Tobago');
INSERT INTO nuke_cities VALUES (6358, 2, 'Arouca', 'tt', 'Trinidad and Tobago');
INSERT INTO nuke_cities VALUES (6359, 3, 'Chaguanas', 'tt', 'Trinidad and Tobago');
INSERT INTO nuke_cities VALUES (6360, 4, 'Couva', 'tt', 'Trinidad and Tobago');
INSERT INTO nuke_cities VALUES (6361, 5, 'Débé', 'tt', 'Trinidad and Tobago');
INSERT INTO nuke_cities VALUES (6362, 6, 'Marabella', 'tt', 'Trinidad and Tobago');
INSERT INTO nuke_cities VALUES (6363, 7, 'Mucurapo', 'tt', 'Trinidad and Tobago');
INSERT INTO nuke_cities VALUES (6364, 8, 'Peñal', 'tt', 'Trinidad and Tobago');
INSERT INTO nuke_cities VALUES (6365, 9, 'Point Fortín', 'tt', 'Trinidad and Tobago');
INSERT INTO nuke_cities VALUES (6366, 10, 'Port of Spain', 'tt', 'Trinidad and Tobago');
INSERT INTO nuke_cities VALUES (6367, 11, 'Princes Town', 'tt', 'Trinidad and Tobago');
INSERT INTO nuke_cities VALUES (6368, 12, 'Saint Joseph', 'tt', 'Trinidad and Tobago');
INSERT INTO nuke_cities VALUES (6369, 13, 'San Fernando', 'tt', 'Trinidad and Tobago');
INSERT INTO nuke_cities VALUES (6370, 14, 'San Juan', 'tt', 'Trinidad and Tobago');
INSERT INTO nuke_cities VALUES (6371, 15, 'Sangre Grande', 'tt', 'Trinidad and Tobago');
INSERT INTO nuke_cities VALUES (6372, 16, 'Scarborough', 'tt', 'Trinidad and Tobago');
INSERT INTO nuke_cities VALUES (6373, 17, 'Siparia', 'tt', 'Trinidad and Tobago');
INSERT INTO nuke_cities VALUES (6374, 18, 'Tabaquite', 'tt', 'Trinidad and Tobago');
INSERT INTO nuke_cities VALUES (6375, 19, 'Tacarigua', 'tt', 'Trinidad and Tobago');
INSERT INTO nuke_cities VALUES (6376, 20, 'Tunapuna', 'tt', 'Trinidad and Tobago');
INSERT INTO nuke_cities VALUES (6377, 1, 'al-Kâf', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6378, 2, 'al-Mahdîyah', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6379, 3, 'al-Marsâ', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6380, 4, 'al-Munastîr', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6381, 5, 'al-Murûj', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6382, 6, 'al-Qasrayn', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6383, 7, 'al-Qayrawân', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6384, 8, 'Aryânah', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6385, 9, 'at-Tadâman Dawwâr Hîshar', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6386, 10, 'Bâjah', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6387, 11, 'Bârdaw', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6388, 12, 'Bin ´Arûs', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6389, 13, 'Binzart', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6390, 14, 'Halq-al-Wâdî', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6391, 15, 'Jarbah Hawmat-as-Sûq', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6392, 16, 'Jarjîs', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6393, 17, 'Jundûbah', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6394, 18, 'Madanîyîn', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6395, 19, 'Manûbah', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6396, 20, 'Masâkin', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6397, 21, 'Mûhammadiyat Fushânah', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6398, 22, 'Nâbul', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6399, 23, 'Qâbis', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6400, 24, 'Qafsah', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6401, 25, 'Qibilî', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6402, 26, 'Safâqis', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6403, 27, 'Sîdî Bû Zayd', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6404, 28, 'Silyânah', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6405, 29, 'Sûsah', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6406, 30, 'Tatâwîn', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6407, 31, 'Tawzar', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6408, 32, 'Tûnis', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6409, 33, 'Zaghwân', 'tn', 'Tunisia');
INSERT INTO nuke_cities VALUES (6410, 1, 'Adana', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6411, 2, 'Adapazari', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6412, 3, 'Adiyaman', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6413, 4, 'Afyon', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6414, 5, 'Aksaray', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6415, 6, 'Amasya', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6416, 7, 'Ankara', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6417, 8, 'Antakya', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6418, 9, 'Antalya', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6419, 10, 'Ardahan', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6420, 11, 'Artvin', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6421, 12, 'Aydin', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6422, 13, 'Balikesir', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6423, 14, 'Bandirma', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6424, 15, 'Bartin', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6425, 16, 'Batman', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6426, 17, 'Bayburt', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6427, 18, 'Bilecik', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6428, 19, 'Bingöl', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6429, 20, 'Bitlis', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6430, 21, 'Bolu', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6431, 22, 'Burdur', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6432, 23, 'Bursa', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6433, 24, 'Çanakkale', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6434, 25, 'Çankiri', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6435, 26, 'Çorlu', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6436, 27, 'Çorum', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6437, 28, 'Denizli', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6438, 29, 'Diyarbakir', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6439, 30, 'Düzce', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6440, 31, 'Edirne', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6441, 32, 'Elazig', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6442, 33, 'Erzincan', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6443, 34, 'Erzurum', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6444, 35, 'Eskisehir', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6445, 36, 'Gaziantep', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6446, 37, 'Gebze', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6447, 38, 'Giresun', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6448, 39, 'Gümüshane', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6449, 40, 'Hakkari', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6450, 41, 'Igdir', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6451, 42, 'Iskenderun', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6452, 43, 'Isparta', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6453, 44, 'Istanbul', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6454, 45, 'Izmir', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6455, 46, 'Izmit', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6456, 47, 'Kahramanmaras', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6457, 48, 'Karaköse', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6458, 49, 'Karaman', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6459, 50, 'Kars', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6460, 51, 'Kastamonu', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6461, 52, 'Kayseri', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6462, 53, 'Kilis', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6463, 54, 'Kirikkale', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6464, 55, 'Kirklareli', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6465, 56, 'Kirsehir', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6466, 57, 'Konya', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6467, 58, 'Kütahya', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6468, 59, 'Malatya', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6469, 60, 'Manisa', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6470, 61, 'Mardin', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6471, 62, 'Mersin', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6472, 63, 'Mugla', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6473, 64, 'Mus', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6474, 65, 'Nevsehir', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6475, 66, 'Nigde', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6476, 67, 'Ordu', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6477, 68, 'Osmaniye', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6478, 69, 'Rize', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6479, 70, 'Samsun', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6480, 71, 'Siirt', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6481, 72, 'Sinop', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6482, 73, 'Sirnak', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6483, 74, 'Sivas', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6484, 75, 'Tekirdag', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6485, 76, 'Tokat', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6486, 77, 'Trabzon', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6487, 78, 'Tunceli', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6488, 79, 'Urfa', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6489, 80, 'Usak', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6490, 81, 'Van', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6491, 82, 'Yalova', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6492, 83, 'Yozgat', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6493, 84, 'Zonguldak', 'tr', 'Turkey');
INSERT INTO nuke_cities VALUES (6494, 1, 'Akdepe', 'tm', 'Turkmenistan');
INSERT INTO nuke_cities VALUES (6495, 2, 'Annau', 'tm', 'Turkmenistan');
INSERT INTO nuke_cities VALUES (6496, 3, 'Asgabat', 'tm', 'Turkmenistan');
INSERT INTO nuke_cities VALUES (6497, 4, 'Balkanabat', 'tm', 'Turkmenistan');
INSERT INTO nuke_cities VALUES (6498, 5, 'Bayramali', 'tm', 'Turkmenistan');
INSERT INTO nuke_cities VALUES (6499, 6, 'Boldumsaz', 'tm', 'Turkmenistan');
INSERT INTO nuke_cities VALUES (6500, 7, 'Büzmeyin', 'tm', 'Turkmenistan');
INSERT INTO nuke_cities VALUES (6501, 8, 'Dasoguz', 'tm', 'Turkmenistan');
INSERT INTO nuke_cities VALUES (6502, 9, 'Elöten', 'tm', 'Turkmenistan');
INSERT INTO nuke_cities VALUES (6503, 10, 'Govurdak', 'tm', 'Turkmenistan');
INSERT INTO nuke_cities VALUES (6504, 11, 'Gumdag', 'tm', 'Turkmenistan');
INSERT INTO nuke_cities VALUES (6505, 12, 'Kerki', 'tm', 'Turkmenistan');
INSERT INTO nuke_cities VALUES (6506, 13, 'Komsomolsk', 'tm', 'Turkmenistan');
INSERT INTO nuke_cities VALUES (6507, 14, 'Köhne Ürgenç', 'tm', 'Turkmenistan');
INSERT INTO nuke_cities VALUES (6508, 15, 'Mari', 'tm', 'Turkmenistan');
INSERT INTO nuke_cities VALUES (6509, 16, 'Serdar', 'tm', 'Turkmenistan');
INSERT INTO nuke_cities VALUES (6510, 17, 'Tecen', 'tm', 'Turkmenistan');
INSERT INTO nuke_cities VALUES (6511, 18, 'Türkmenabat', 'tm', 'Turkmenistan');
INSERT INTO nuke_cities VALUES (6512, 19, 'Türkmenbasi', 'tm', 'Turkmenistan');
INSERT INTO nuke_cities VALUES (6513, 20, 'Yilanli', 'tm', 'Turkmenistan');
INSERT INTO nuke_cities VALUES (6514, 1, 'Cockburn Harbour', 'tc', 'Turks and Caicos Islands');
INSERT INTO nuke_cities VALUES (6515, 2, 'Cockburn Town', 'tc', 'Turks and Caicos Islands');
INSERT INTO nuke_cities VALUES (6516, 1, 'Asau', 'tv', 'Tuvalu');
INSERT INTO nuke_cities VALUES (6517, 2, 'Fangaua', 'tv', 'Tuvalu');
INSERT INTO nuke_cities VALUES (6518, 3, 'Kua', 'tv', 'Tuvalu');
INSERT INTO nuke_cities VALUES (6519, 4, 'Lolua', 'tv', 'Tuvalu');
INSERT INTO nuke_cities VALUES (6520, 5, 'Savave', 'tv', 'Tuvalu');
INSERT INTO nuke_cities VALUES (6521, 6, 'Tanrake', 'tv', 'Tuvalu');
INSERT INTO nuke_cities VALUES (6522, 7, 'Tonga', 'tv', 'Tuvalu');
INSERT INTO nuke_cities VALUES (6523, 8, 'Vaiaku', 'tv', 'Tuvalu');
INSERT INTO nuke_cities VALUES (6524, 1, 'Arua', 'ug', 'Uganda');
INSERT INTO nuke_cities VALUES (6525, 2, 'Busia', 'ug', 'Uganda');
INSERT INTO nuke_cities VALUES (6526, 3, 'Entebbe', 'ug', 'Uganda');
INSERT INTO nuke_cities VALUES (6527, 4, 'Fort Portal', 'ug', 'Uganda');
INSERT INTO nuke_cities VALUES (6528, 5, 'Gulu', 'ug', 'Uganda');
INSERT INTO nuke_cities VALUES (6529, 6, 'Iganga', 'ug', 'Uganda');
INSERT INTO nuke_cities VALUES (6530, 7, 'Jinja', 'ug', 'Uganda');
INSERT INTO nuke_cities VALUES (6531, 8, 'Kabale', 'ug', 'Uganda');
INSERT INTO nuke_cities VALUES (6532, 9, 'Kampala', 'ug', 'Uganda');
INSERT INTO nuke_cities VALUES (6533, 10, 'Kasese', 'ug', 'Uganda');
INSERT INTO nuke_cities VALUES (6534, 11, 'Kitgum', 'ug', 'Uganda');
INSERT INTO nuke_cities VALUES (6535, 12, 'Lira', 'ug', 'Uganda');
INSERT INTO nuke_cities VALUES (6536, 13, 'Masaka', 'ug', 'Uganda');
INSERT INTO nuke_cities VALUES (6537, 14, 'Mbale', 'ug', 'Uganda');
INSERT INTO nuke_cities VALUES (6538, 15, 'Mbarara', 'ug', 'Uganda');
INSERT INTO nuke_cities VALUES (6539, 16, 'Mityana', 'ug', 'Uganda');
INSERT INTO nuke_cities VALUES (6540, 17, 'Mukono', 'ug', 'Uganda');
INSERT INTO nuke_cities VALUES (6541, 18, 'Njeru', 'ug', 'Uganda');
INSERT INTO nuke_cities VALUES (6542, 19, 'Soroti', 'ug', 'Uganda');
INSERT INTO nuke_cities VALUES (6543, 20, 'Tororo', 'ug', 'Uganda');
INSERT INTO nuke_cities VALUES (6544, 1, 'Alchevs\'k', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6545, 2, 'Berdyans\'k', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6546, 3, 'Bila Tserkva', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6547, 4, 'Cherkasy', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6548, 5, 'Chernihiv', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6549, 6, 'Chernivtsi', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6550, 7, 'Dniprodzerzhyns\'k', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6551, 8, 'Dnipropetrovs\'k', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6552, 9, 'Donets\'k', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6553, 10, 'Horlivka', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6554, 11, 'Ivano-Frankivs\'k', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6555, 12, 'Kerch', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6556, 13, 'Kharkiv', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6557, 14, 'Kherson', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6558, 15, 'Khmel\'nyts\'kyy', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6559, 16, 'Kirovohrad', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6560, 17, 'Kramators\'k', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6561, 18, 'Kremenchuh', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6562, 19, 'Kryvyy Rih', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6563, 20, 'Kyyiv', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6564, 21, 'Luhans\'k', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6565, 22, 'Luts\'k', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6566, 23, 'L\'viv', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6567, 24, 'Lysychans\'k', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6568, 25, 'Makiyivka', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6569, 26, 'Mariupol\'', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6570, 27, 'Melitpol\'', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6571, 28, 'Mykolayiv', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6572, 29, 'Nikopol\'', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6573, 30, 'Odesa', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6574, 31, 'Pavlohrad', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6575, 32, 'Poltava', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6576, 33, 'Rivne', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6577, 34, 'Sevastopol\'', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6578, 35, 'Simferopol\'', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6579, 36, 'Slov\'yans\'k', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6580, 37, 'Sumy', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6581, 38, 'Syeverodonets\'k', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6582, 39, 'Ternopil\'', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6583, 40, 'Uzhhorod', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6584, 41, 'Vinnytsya', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6585, 42, 'Yenakiyeve', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6586, 43, 'Yevpatoriya', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6587, 44, 'Zaporizhzhya', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6588, 45, 'Zhytomyr', 'ua', 'Ukraine');
INSERT INTO nuke_cities VALUES (6589, 1, '´Ajmân', 'ae', 'United Arab Emirates');
INSERT INTO nuke_cities VALUES (6590, 2, 'Abû Zabi', 'ae', 'United Arab Emirates');
INSERT INTO nuke_cities VALUES (6591, 3, 'al-´Ayn', 'ae', 'United Arab Emirates');
INSERT INTO nuke_cities VALUES (6592, 4, 'al-Fujayrah', 'ae', 'United Arab Emirates');
INSERT INTO nuke_cities VALUES (6593, 5, 'ash-Shâriqah', 'ae', 'United Arab Emirates');
INSERT INTO nuke_cities VALUES (6594, 6, 'Dubayy', 'ae', 'United Arab Emirates');
INSERT INTO nuke_cities VALUES (6595, 7, 'Khawr Fakkân', 'ae', 'United Arab Emirates');
INSERT INTO nuke_cities VALUES (6596, 8, 'Râ\'s al-Khaymah', 'ae', 'United Arab Emirates');
INSERT INTO nuke_cities VALUES (6597, 9, 'Umm al-Qaywayn', 'ae', 'United Arab Emirates');
INSERT INTO nuke_cities VALUES (6598, 1, 'Aberdeen', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6599, 2, 'Basildon', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6600, 3, 'Belfast', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6601, 4, 'Birmingham', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6602, 5, 'Blackburn', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6603, 6, 'Blackpool', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6604, 7, 'Bolton', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6605, 8, 'Bournemouth', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6606, 9, 'Bradford', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6607, 10, 'Brighton', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6608, 11, 'Bristol', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6609, 12, 'Cardiff', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6610, 13, 'Chelmsford', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6611, 14, 'Coventry', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6612, 15, 'Derby', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6613, 16, 'Dudley', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6614, 17, 'Dundee', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6615, 18, 'Edinburgh', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6616, 19, 'Glasgow', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6617, 20, 'Gloucester', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6618, 21, 'Huddersfield', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6619, 22, 'Ipswich', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6620, 23, 'Kingston upon Hull', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6621, 24, 'Leeds', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6622, 25, 'Leicester', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6623, 26, 'Liverpool', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6624, 27, 'London', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6625, 28, 'Luton', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6626, 29, 'Manchester', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6627, 30, 'Middlesbrough', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6628, 31, 'Motherwell', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6629, 32, 'Newcastle upon Tyne', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6630, 33, 'Newport', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6631, 34, 'Northampton', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6632, 35, 'Norwich', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6633, 36, 'Nottingham', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6634, 37, 'Oldbury-Smethwick', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6635, 38, 'Oldham', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6636, 39, 'Oxford', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6637, 40, 'Peterborough', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6638, 41, 'Plymouth', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6639, 42, 'Poole', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6640, 43, 'Portsmouth', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6641, 44, 'Preston', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6642, 45, 'Reading', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6643, 46, 'Rotherham', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6644, 47, 'Saint Helens', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6645, 48, 'Sheffield', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6646, 49, 'Slough', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6647, 50, 'Southampton', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6648, 51, 'Southend-on-Sea', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6649, 52, 'Stockport', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6650, 53, 'Stoke-on-Trent', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6651, 54, 'Sunderland', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6652, 55, 'Sutton Coldfield', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6653, 56, 'Swansea', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6654, 57, 'Swindon', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6655, 58, 'Walsall', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6656, 59, 'Watford', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6657, 60, 'West Bromwich', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6658, 61, 'Woking-Byfleet', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6659, 62, 'Wolverhampton', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6660, 63, 'York', 'gb', 'United Kingdom');
INSERT INTO nuke_cities VALUES (6661, 1, 'Alabama', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6662, 2, 'Alaska', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6663, 3, 'Arizona', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6664, 4, 'Arkansas', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6665, 5, 'California', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6666, 6, 'Colorado', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6667, 7, 'Connecticut', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6668, 8, 'Delaware', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6669, 9, 'District of Columbia', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6670, 10, 'Florida', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6671, 11, 'Georgia', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6672, 12, 'Hawaii', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6673, 13, 'Idaho', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6674, 14, 'Illinois', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6675, 15, 'Indiana', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6676, 16, 'Iowa', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6677, 17, 'Kansas', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6678, 18, 'Kentucky', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6679, 19, 'Louisiana', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6680, 20, 'Maine', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6681, 21, 'Maryland', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6682, 22, 'Massachusetts', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6683, 23, 'Michigan', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6684, 24, 'Minnesota', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6685, 25, 'Mississippi', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6686, 26, 'Missouri', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6687, 27, 'Montana', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6688, 28, 'Nebraska', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6689, 29, 'Nevada', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6690, 30, 'New Hampshire', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6691, 31, 'New Jersey', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6692, 32, 'New Mexico', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6693, 33, 'New York', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6694, 34, 'North Carolina', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6695, 35, 'North Dakota', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6696, 36, 'Ohio', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6697, 37, 'Oklahoma', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6698, 38, 'Oregon', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6699, 39, 'Pennsylvania', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6700, 40, 'Rhode Island', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6701, 41, 'South Carolina', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6702, 42, 'South Dakota', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6703, 43, 'Tennessee', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6704, 44, 'Texas', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6705, 45, 'Utah', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6706, 46, 'Vermont', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6707, 47, 'Virginia', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6708, 48, 'Washington', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6709, 49, 'West Virginia', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6710, 50, 'Wisconsin', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6711, 51, 'Wyoming', 'us', 'United States of America');
INSERT INTO nuke_cities VALUES (6712, 1, 'Artigas', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6713, 2, 'Canelones', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6714, 3, 'Ciudad de la Costa', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6715, 4, 'Colonia', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6716, 5, 'Durazno', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6717, 6, 'Florida', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6718, 7, 'Fray Bentos', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6719, 8, 'Las Piedras', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6720, 9, 'Maldonado', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6721, 10, 'Melo', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6722, 11, 'Mercedes', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6723, 12, 'Minas', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6724, 13, 'Montevideo', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6725, 14, 'Pando', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6726, 15, 'Paysandú', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6727, 16, 'Rivera', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6728, 17, 'Rocha', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6729, 18, 'Salto', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6730, 19, 'San Carlos', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6731, 20, 'San José', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6732, 21, 'Tacuarembó', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6733, 22, 'Treinta y Tres', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6734, 23, 'Trinidad', 'uy', 'Uruguay');
INSERT INTO nuke_cities VALUES (6735, 1, 'Andijon', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6736, 2, 'Angren', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6737, 3, 'Bekobod', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6738, 4, 'Buhoro', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6739, 5, 'Cizah', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6740, 6, 'Çirçik', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6741, 7, 'Fargona', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6742, 8, 'Guliston', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6743, 9, 'Hücayli', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6744, 10, 'Karsi', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6745, 11, 'Kükon', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6746, 12, 'Margilon', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6747, 13, 'Namangan', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6748, 14, 'Navoi', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6749, 15, 'Nukus', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6750, 16, 'Olmalik', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6751, 17, 'Sahrisabz', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6752, 18, 'Samarkand', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6753, 19, 'Termiz', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6754, 20, 'Toskent', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6755, 21, 'Ürgenç', 'uz', 'Uzbekistan');
INSERT INTO nuke_cities VALUES (6756, 1, 'Isangel', 'vu', 'Vanuatu');
INSERT INTO nuke_cities VALUES (6757, 2, 'Lakatoro', 'vu', 'Vanuatu');
INSERT INTO nuke_cities VALUES (6758, 3, 'Longana', 'vu', 'Vanuatu');
INSERT INTO nuke_cities VALUES (6759, 4, 'Luganville', 'vu', 'Vanuatu');
INSERT INTO nuke_cities VALUES (6760, 5, 'Norsup', 'vu', 'Vanuatu');
INSERT INTO nuke_cities VALUES (6761, 6, 'Port Olry', 'vu', 'Vanuatu');
INSERT INTO nuke_cities VALUES (6762, 7, 'Sola', 'vu', 'Vanuatu');
INSERT INTO nuke_cities VALUES (6763, 8, 'Vila', 'vu', 'Vanuatu');
INSERT INTO nuke_cities VALUES (6764, 1, 'Vatican', 'va', 'Vatican');
INSERT INTO nuke_cities VALUES (6765, 1, 'Acarigua', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6766, 2, 'Barcelona', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6767, 3, 'Barinas', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6768, 4, 'Barquisimeto', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6769, 5, 'Baruta', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6770, 6, 'Cabimas', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6771, 7, 'Cagua', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6772, 8, 'Calabozo', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6773, 9, 'Caracas', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6774, 10, 'Carora', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6775, 11, 'Carúpano', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6776, 12, 'Catia La Mar', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6777, 13, 'Charallave', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6778, 14, 'Ciudad Bolívar', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6779, 15, 'Ciudad Guayana', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6780, 16, 'Coro', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6781, 17, 'Cúa', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6782, 18, 'Cumaná', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6783, 19, 'El Limón', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6784, 20, 'El Tigre', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6785, 21, 'Guacara', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6786, 22, 'Guanare', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6787, 23, 'Guarenas', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6788, 24, 'Guatire', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6789, 25, 'La Asunción', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6790, 26, 'La Guaira', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6791, 27, 'La Victoria', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6792, 28, 'Los Teques', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6793, 29, 'Maracaibo', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6794, 30, 'Maracay', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6795, 31, 'Mariara', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6796, 32, 'Maturín', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6797, 33, 'Mérida', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6798, 34, 'Ocumare del Tuy', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6799, 35, 'Petare', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6800, 36, 'Puerto Ayacucho', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6801, 37, 'Puerto Cabello', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6802, 38, 'Puerto la Cruz', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6803, 39, 'Punto Fijo', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6804, 40, 'San Carlos', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6805, 41, 'San Cristóbal', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6806, 42, 'San Felipe', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6807, 43, 'San Fernando', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6808, 44, 'San Juan de los Morros', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6809, 45, 'Santa Teresa', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6810, 46, 'Trujillo', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6811, 47, 'Tucupita', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6812, 48, 'Turmero', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6813, 49, 'Valencia', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6814, 50, 'Valera', 've', 'Venezuela');
INSERT INTO nuke_cities VALUES (6815, 1, 'Bac Lieu', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6816, 2, 'Bien Hoa', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6817, 3, 'Buon Me Thuot', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6818, 4, 'Ca Mau', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6819, 5, 'Cam Pha', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6820, 6, 'Cam Ranh', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6821, 7, 'Can Tho', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6822, 8, 'Da Lat', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6823, 9, 'Dha Nâng', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6824, 10, 'Ha Noi', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6825, 11, 'Hai Phong', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6826, 12, 'Hong Gai', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6827, 13, 'Hue', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6828, 14, 'Long Xuyen', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6829, 15, 'My Tho', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6830, 16, 'Nam Dinh', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6831, 17, 'Nha Trang', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6832, 18, 'Phan Thiet', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6833, 19, 'Play Cu', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6834, 20, 'Qui Nhon', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6835, 21, 'Rach Gia', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6836, 22, 'Soc Trang', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6837, 23, 'Thai Nguyen', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6838, 24, 'Thanh Hoa', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6839, 25, 'Thanh Pho Ho Chi Minh', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6840, 26, 'Vung Tau', 'vn', 'Vietnam');
INSERT INTO nuke_cities VALUES (6841, 1, 'Anna\'s Retreat', 'vi', 'Virgin Islands of the USA');
INSERT INTO nuke_cities VALUES (6842, 2, 'Charlotte Amalie', 'vi', 'Virgin Islands of the USA');
INSERT INTO nuke_cities VALUES (6843, 3, 'Charlotte Amalie East', 'vi', 'Virgin Islands of the USA');
INSERT INTO nuke_cities VALUES (6844, 4, 'Charlotte Amalie West', 'vi', 'Virgin Islands of the USA');
INSERT INTO nuke_cities VALUES (6845, 5, 'Christiansted', 'vi', 'Virgin Islands of the USA');
INSERT INTO nuke_cities VALUES (6846, 6, 'Cruz Bay', 'vi', 'Virgin Islands of the USA');
INSERT INTO nuke_cities VALUES (6847, 7, 'Frederiksted', 'vi', 'Virgin Islands of the USA');
INSERT INTO nuke_cities VALUES (6848, 8, 'Frederiksted Southeast', 'vi', 'Virgin Islands of the USA');
INSERT INTO nuke_cities VALUES (6849, 9, 'Grove Place', 'vi', 'Virgin Islands of the USA');
INSERT INTO nuke_cities VALUES (6850, 1, 'Aka Aka', 'wf', 'Wallis & Futuna');
INSERT INTO nuke_cities VALUES (6851, 2, 'Alele', 'wf', 'Wallis & Futuna');
INSERT INTO nuke_cities VALUES (6852, 3, 'Falaleu', 'wf', 'Wallis & Futuna');
INSERT INTO nuke_cities VALUES (6853, 4, 'Fiua', 'wf', 'Wallis & Futuna');
INSERT INTO nuke_cities VALUES (6854, 5, 'Haafuasia', 'wf', 'Wallis & Futuna');
INSERT INTO nuke_cities VALUES (6855, 6, 'Halalo', 'wf', 'Wallis & Futuna');
INSERT INTO nuke_cities VALUES (6856, 7, 'Kolia', 'wf', 'Wallis & Futuna');
INSERT INTO nuke_cities VALUES (6857, 8, 'Lavegahau', 'wf', 'Wallis & Futuna');
INSERT INTO nuke_cities VALUES (6858, 9, 'Leava', 'wf', 'Wallis & Futuna');
INSERT INTO nuke_cities VALUES (6859, 10, 'Liku', 'wf', 'Wallis & Futuna');
INSERT INTO nuke_cities VALUES (6860, 11, 'Malaefoou', 'wf', 'Wallis & Futuna');
INSERT INTO nuke_cities VALUES (6861, 12, 'Matâ\'Utu', 'wf', 'Wallis & Futuna');
INSERT INTO nuke_cities VALUES (6862, 13, 'Nuku', 'wf', 'Wallis & Futuna');
INSERT INTO nuke_cities VALUES (6863, 14, 'Ono', 'wf', 'Wallis & Futuna');
INSERT INTO nuke_cities VALUES (6864, 15, 'Poi', 'wf', 'Wallis & Futuna');
INSERT INTO nuke_cities VALUES (6865, 16, 'Taoa', 'wf', 'Wallis & Futuna');
INSERT INTO nuke_cities VALUES (6866, 17, 'Utuofa', 'wf', 'Wallis & Futuna');
INSERT INTO nuke_cities VALUES (6867, 18, 'Vailala', 'wf', 'Wallis & Futuna');
INSERT INTO nuke_cities VALUES (6868, 19, 'Vaimalau', 'wf', 'Wallis & Futuna');
INSERT INTO nuke_cities VALUES (6869, 20, 'Vaitupu', 'wf', 'Wallis & Futuna');
INSERT INTO nuke_cities VALUES (6870, 1, '´Adan', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6871, 2, '´Amrân', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6872, 3, '´Ataq', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6873, 4, 'al-Baydâ', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6874, 5, 'al-Ghaydah', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6875, 6, 'al-Hawthah', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6876, 7, 'al-Hazm', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6877, 8, 'al-Hudaydah', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6878, 9, 'al-Marawi´ah', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6879, 10, 'al-Mukallâ', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6880, 11, 'ash-Shahir', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6881, 12, 'Bâjil', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6882, 13, 'Bayt-al-Faqîh', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6883, 14, 'Dhamâr', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6884, 15, 'Dhi Sufal', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6885, 16, 'Hajjah', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6886, 17, 'Ibb', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6887, 18, 'Ja´ar', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6888, 19, 'Mahwît', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6889, 20, 'Ma\'rib', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6890, 21, 'Raydah', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6891, 22, 'Sa´dah', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6892, 23, 'Sahâr', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6893, 24, 'San´â', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6894, 25, 'Sayyân', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6895, 26, 'Ta´izz', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6896, 27, 'Tuban', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6897, 28, 'Yarim', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6898, 29, 'Zabid', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6899, 30, 'Zinjibar', 'ye', 'Yemen');
INSERT INTO nuke_cities VALUES (6900, 1, 'Chililabombwe', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6901, 2, 'Chingola', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6902, 3, 'Chipata', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6903, 4, 'Choma', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6904, 5, 'Kabwe', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6905, 6, 'Kafue', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6906, 7, 'Kalulushi', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6907, 8, 'Kansanshi', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6908, 9, 'Kasama', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6909, 10, 'Kitwe', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6910, 11, 'Livingstone', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6911, 12, 'Luanshya', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6912, 13, 'Lusaka', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6913, 14, 'Mansa', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6914, 15, 'Mazabuka', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6915, 16, 'Mongu', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6916, 17, 'Mpika', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6917, 18, 'Mufulira', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6918, 19, 'Nchelenge', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6919, 20, 'Ndola', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6920, 21, 'Solwezi', 'zm', 'Zambia');
INSERT INTO nuke_cities VALUES (6921, 1, 'Bindura', 'zw', 'Zimbabwe');
INSERT INTO nuke_cities VALUES (6922, 2, 'Bulawayo', 'zw', 'Zimbabwe');
INSERT INTO nuke_cities VALUES (6923, 3, 'Chegutu', 'zw', 'Zimbabwe');
INSERT INTO nuke_cities VALUES (6924, 4, 'Chinhoyi', 'zw', 'Zimbabwe');
INSERT INTO nuke_cities VALUES (6925, 5, 'Chitungwiza', 'zw', 'Zimbabwe');
INSERT INTO nuke_cities VALUES (6926, 6, 'Gweru', 'zw', 'Zimbabwe');
INSERT INTO nuke_cities VALUES (6927, 7, 'Harare', 'zw', 'Zimbabwe');
INSERT INTO nuke_cities VALUES (6928, 8, 'Hwange', 'zw', 'Zimbabwe');
INSERT INTO nuke_cities VALUES (6929, 9, 'Kadoma', 'zw', 'Zimbabwe');
INSERT INTO nuke_cities VALUES (6930, 10, 'Kariba', 'zw', 'Zimbabwe');
INSERT INTO nuke_cities VALUES (6931, 11, 'Karoi', 'zw', 'Zimbabwe');
INSERT INTO nuke_cities VALUES (6932, 12, 'Kwekwe', 'zw', 'Zimbabwe');
INSERT INTO nuke_cities VALUES (6933, 13, 'Marondera', 'zw', 'Zimbabwe');
INSERT INTO nuke_cities VALUES (6934, 14, 'Masvingo', 'zw', 'Zimbabwe');
INSERT INTO nuke_cities VALUES (6935, 15, 'Mutare', 'zw', 'Zimbabwe');
INSERT INTO nuke_cities VALUES (6936, 16, 'Norton', 'zw', 'Zimbabwe');
INSERT INTO nuke_cities VALUES (6937, 17, 'Redcliffe', 'zw', 'Zimbabwe');
INSERT INTO nuke_cities VALUES (6938, 18, 'Sakubva', 'zw', 'Zimbabwe');
INSERT INTO nuke_cities VALUES (6939, 19, 'Victoria Falls', 'zw', 'Zimbabwe');
INSERT INTO nuke_cities VALUES (6940, 20, 'Zvishavane', 'zw', 'Zimbabwe');

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_comments`
#

CREATE TABLE nuke_comments (
  tid int(11) NOT NULL auto_increment,
  pid int(11) NOT NULL default '0',
  sid int(11) NOT NULL default '0',
  `date` datetime default NULL,
  name varchar(60) NOT NULL default '',
  email varchar(60) default NULL,
  url varchar(60) default NULL,
  host_name varchar(60) default NULL,
  `subject` varchar(85) NOT NULL default '',
  `comment` text NOT NULL,
  score tinyint(4) NOT NULL default '0',
  reason tinyint(4) NOT NULL default '0',
  last_moderation_ip varchar(15) default '0',
  PRIMARY KEY  (tid),
  KEY tid (tid),
  KEY pid (pid),
  KEY sid (sid)
);

#
# Volcar la base de datos para la tabla `nuke_comments`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_comments_moderated`
#

CREATE TABLE nuke_comments_moderated (
  tid int(11) NOT NULL auto_increment,
  pid int(11) NOT NULL default '0',
  sid int(11) NOT NULL default '0',
  `date` datetime default NULL,
  name varchar(60) NOT NULL default '',
  email varchar(60) default NULL,
  url varchar(60) default NULL,
  host_name varchar(60) default NULL,
  `subject` varchar(85) NOT NULL default '',
  `comment` text NOT NULL,
  score tinyint(4) NOT NULL default '0',
  reason tinyint(4) NOT NULL default '0',
  last_moderation_ip varchar(15) default '0',
  PRIMARY KEY  (tid),
  KEY tid (tid),
  KEY pid (pid),
  KEY sid (sid)
);

#
# Volcar la base de datos para la tabla `nuke_comments_moderated`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_config`
#

CREATE TABLE nuke_config (
  sitename varchar(255) NOT NULL default '',
  nukeurl varchar(255) NOT NULL default '',
  site_logo varchar(255) NOT NULL default '',
  slogan varchar(255) NOT NULL default '',
  startdate varchar(50) NOT NULL default '',
  adminmail varchar(255) NOT NULL default '',
  anonpost tinyint(1) NOT NULL default '0',
  Default_Theme varchar(255) NOT NULL default '',
  overwrite_theme tinyint(1) NOT NULL default '1',
  foot1 text NOT NULL,
  foot2 text NOT NULL,
  foot3 text NOT NULL,
  commentlimit int(9) NOT NULL default '4096',
  anonymous varchar(255) NOT NULL default '',
  minpass tinyint(1) NOT NULL default '5',
  pollcomm tinyint(1) NOT NULL default '1',
  articlecomm tinyint(1) NOT NULL default '1',
  broadcast_msg tinyint(1) NOT NULL default '1',
  my_headlines tinyint(1) NOT NULL default '1',
  top int(3) NOT NULL default '10',
  storyhome int(2) NOT NULL default '10',
  user_news tinyint(1) NOT NULL default '1',
  oldnum int(2) NOT NULL default '30',
  ultramode tinyint(1) NOT NULL default '0',
  banners tinyint(1) NOT NULL default '1',
  backend_title varchar(255) NOT NULL default '',
  backend_language varchar(10) NOT NULL default '',
  language varchar(100) NOT NULL default '',
  locale varchar(10) NOT NULL default '',
  multilingual tinyint(1) NOT NULL default '0',
  useflags tinyint(1) NOT NULL default '0',
  notify tinyint(1) NOT NULL default '0',
  notify_email varchar(255) NOT NULL default '',
  notify_subject varchar(255) NOT NULL default '',
  notify_message varchar(255) NOT NULL default '',
  notify_from varchar(255) NOT NULL default '',
  moderate tinyint(1) NOT NULL default '0',
  admingraphic tinyint(1) NOT NULL default '1',
  httpref tinyint(1) NOT NULL default '1',
  httprefmax int(5) NOT NULL default '1000',
  httprefmode tinyint(1) NOT NULL default '1',
  CensorMode tinyint(1) NOT NULL default '3',
  CensorReplace varchar(10) NOT NULL default '',
  copyright text NOT NULL,
  Version_Num varchar(10) NOT NULL default '',
  gfx_chk tinyint(1) NOT NULL default '0',
  nuke_editor tinyint(1) NOT NULL default '1',
  display_errors tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (sitename)
);

#
# Volcar la base de datos para la tabla `nuke_config`
#

INSERT INTO nuke_config VALUES ('PHP-Nuke Powered Site', 'http://nukeurl', 'logo.gif', 'Your slogan here', 'May 2007', 'webmaster@phpnuke.org', 0, 'org_green', 1, '<a rel="nofollow" href="http://phpnuke.org/" target="blank"><img alt="Web site powered by PHP-Nuke" hspace="10" src="images/powered/powered8.jpg" border="0" /></a><br />', 'All logos and trademarks in this site are property of their respective owner. The comments are property of their posters, all the rest &copy; 2005 by me.', 'You can syndicate our news using the file <a href="backend.php">backend.php</a> or <a href="ultramode.txt">ultramode.txt</a>', 4096, 'Anonymous', 5, 1, 1, 1, 1, 10, 10, 1, 30, 0, 1, 'PHP-Nuke Powered Site', 'en-us', 'english', 'en_US', 0, 0, 0, 'me@phpnuke.org', 'NEWS for my site', 'Hey! You got a new submission for your site.', 'webmaster', 0, 1, 1, 1000, 0, 3, '*****', '<a rel="nofollow" href="http://phpnuke.org"><font class="footmsg_l">PHP-Nuke</font></a> Copyright &copy; 2005 by Francisco Burzi. This is free software, and you may redistribute it under the <a rel="nofollow" href="http://phpnuke.org/files/gpl.txt"><font class="footmsg_l">GPL</font></a>. PHP-Nuke comes with absolutely no warranty, for details, see the <a rel="nofollow" href="http://phpnuke.org/files/gpl.txt"><font class="footmsg_l">license</font></a>.', '8.1', 0, 1, 0);
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_confirm`
#

CREATE TABLE nuke_confirm (
  confirm_id char(32) NOT NULL default '',
  session_id char(32) NOT NULL default '',
  code char(6) NOT NULL default '',
  PRIMARY KEY  (session_id,confirm_id)
);

#
# Volcar la base de datos para la tabla `nuke_confirm`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_counter`
#

CREATE TABLE nuke_counter (
  `type` varchar(80) NOT NULL default '',
  var varchar(80) NOT NULL default '',
  count int(10) unsigned NOT NULL default '0'
);

#
# Volcar la base de datos para la tabla `nuke_counter`
#

INSERT INTO nuke_counter VALUES ('total', 'hits', 1);
INSERT INTO nuke_counter VALUES ('browser', 'WebTV', 0);
INSERT INTO nuke_counter VALUES ('browser', 'Lynx', 0);
INSERT INTO nuke_counter VALUES ('browser', 'MSIE', 1);
INSERT INTO nuke_counter VALUES ('browser', 'Opera', 0);
INSERT INTO nuke_counter VALUES ('browser', 'Konqueror', 0);
INSERT INTO nuke_counter VALUES ('browser', 'Netscape', 0);
INSERT INTO nuke_counter VALUES ('browser', 'FireFox', 0);
INSERT INTO nuke_counter VALUES ('browser', 'Bot', 0);
INSERT INTO nuke_counter VALUES ('browser', 'Other', 0);
INSERT INTO nuke_counter VALUES ('os', 'Windows', 1);
INSERT INTO nuke_counter VALUES ('os', 'Linux', 0);
INSERT INTO nuke_counter VALUES ('os', 'Mac', 0);
INSERT INTO nuke_counter VALUES ('os', 'FreeBSD', 0);
INSERT INTO nuke_counter VALUES ('os', 'SunOS', 0);
INSERT INTO nuke_counter VALUES ('os', 'IRIX', 0);
INSERT INTO nuke_counter VALUES ('os', 'BeOS', 0);
INSERT INTO nuke_counter VALUES ('os', 'OS/2', 0);
INSERT INTO nuke_counter VALUES ('os', 'AIX', 0);
INSERT INTO nuke_counter VALUES ('os', 'Other', 0);
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_downloads_categories`
#

CREATE TABLE nuke_downloads_categories (
  cid int(11) NOT NULL auto_increment,
  title varchar(50) NOT NULL default '',
  cdescription text NOT NULL,
  parentid int(11) NOT NULL default '0',
  PRIMARY KEY  (cid),
  KEY cid (cid),
  KEY title (title)
);

#
# Volcar la base de datos para la tabla `nuke_downloads_categories`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_downloads_downloads`
#

CREATE TABLE nuke_downloads_downloads (
  lid int(11) NOT NULL auto_increment,
  cid int(11) NOT NULL default '0',
  sid int(11) NOT NULL default '0',
  title varchar(100) NOT NULL default '',
  url varchar(100) NOT NULL default '',
  description text NOT NULL,
  `date` datetime default NULL,
  name varchar(100) NOT NULL default '',
  email varchar(100) NOT NULL default '',
  hits int(11) NOT NULL default '0',
  submitter varchar(60) NOT NULL default '',
  downloadratingsummary double(6,4) NOT NULL default '0.0000',
  totalvotes int(11) NOT NULL default '0',
  totalcomments int(11) NOT NULL default '0',
  filesize int(11) NOT NULL default '0',
  version varchar(10) NOT NULL default '',
  homepage varchar(200) NOT NULL default '',
  PRIMARY KEY  (lid),
  KEY lid (lid),
  KEY cid (cid),
  KEY sid (sid),
  KEY title (title)
);

#
# Volcar la base de datos para la tabla `nuke_downloads_downloads`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_downloads_editorials`
#

CREATE TABLE nuke_downloads_editorials (
  downloadid int(11) NOT NULL default '0',
  adminid varchar(60) NOT NULL default '',
  editorialtimestamp datetime NOT NULL default '0000-00-00 00:00:00',
  editorialtext text NOT NULL,
  editorialtitle varchar(100) NOT NULL default '',
  PRIMARY KEY  (downloadid),
  KEY downloadid (downloadid)
);

#
# Volcar la base de datos para la tabla `nuke_downloads_editorials`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_downloads_modrequest`
#

CREATE TABLE nuke_downloads_modrequest (
  requestid int(11) NOT NULL auto_increment,
  lid int(11) NOT NULL default '0',
  cid int(11) NOT NULL default '0',
  sid int(11) NOT NULL default '0',
  title varchar(100) NOT NULL default '',
  url varchar(100) NOT NULL default '',
  description text NOT NULL,
  modifysubmitter varchar(60) NOT NULL default '',
  brokendownload int(3) NOT NULL default '0',
  name varchar(100) NOT NULL default '',
  email varchar(100) NOT NULL default '',
  filesize int(11) NOT NULL default '0',
  version varchar(10) NOT NULL default '',
  homepage varchar(200) NOT NULL default '',
  PRIMARY KEY  (requestid),
  UNIQUE KEY requestid (requestid)
);

#
# Volcar la base de datos para la tabla `nuke_downloads_modrequest`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_downloads_newdownload`
#

CREATE TABLE nuke_downloads_newdownload (
  lid int(11) NOT NULL auto_increment,
  cid int(11) NOT NULL default '0',
  sid int(11) NOT NULL default '0',
  title varchar(100) NOT NULL default '',
  url varchar(100) NOT NULL default '',
  description text NOT NULL,
  name varchar(100) NOT NULL default '',
  email varchar(100) NOT NULL default '',
  submitter varchar(60) NOT NULL default '',
  filesize int(11) NOT NULL default '0',
  version varchar(10) NOT NULL default '',
  homepage varchar(200) NOT NULL default '',
  PRIMARY KEY  (lid),
  KEY lid (lid),
  KEY cid (cid),
  KEY sid (sid),
  KEY title (title)
);

#
# Volcar la base de datos para la tabla `nuke_downloads_newdownload`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_downloads_votedata`
#

CREATE TABLE nuke_downloads_votedata (
  ratingdbid int(11) NOT NULL auto_increment,
  ratinglid int(11) NOT NULL default '0',
  ratinguser varchar(60) NOT NULL default '',
  rating int(11) NOT NULL default '0',
  ratinghostname varchar(60) NOT NULL default '',
  ratingcomments text NOT NULL,
  ratingtimestamp datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (ratingdbid),
  KEY ratingdbid (ratingdbid)
);

#
# Volcar la base de datos para la tabla `nuke_downloads_votedata`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_encyclopedia`
#

CREATE TABLE nuke_encyclopedia (
  eid int(10) NOT NULL auto_increment,
  title varchar(255) NOT NULL default '',
  description text NOT NULL,
  elanguage varchar(30) NOT NULL default '',
  active int(1) NOT NULL default '0',
  PRIMARY KEY  (eid),
  KEY eid (eid)
);

#
# Volcar la base de datos para la tabla `nuke_encyclopedia`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_encyclopedia_text`
#

CREATE TABLE nuke_encyclopedia_text (
  tid int(10) NOT NULL auto_increment,
  eid int(10) NOT NULL default '0',
  title varchar(255) NOT NULL default '',
  `text` text NOT NULL,
  counter int(10) NOT NULL default '0',
  PRIMARY KEY  (tid),
  KEY tid (tid),
  KEY eid (eid),
  KEY title (title)
);

#
# Volcar la base de datos para la tabla `nuke_encyclopedia_text`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_faqanswer`
#

CREATE TABLE nuke_faqanswer (
  id tinyint(4) NOT NULL auto_increment,
  id_cat tinyint(4) NOT NULL default '0',
  question varchar(255) default '',
  answer text,
  PRIMARY KEY  (id),
  KEY id (id),
  KEY id_cat (id_cat)
);

#
# Volcar la base de datos para la tabla `nuke_faqanswer`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_faqcategories`
#

CREATE TABLE nuke_faqcategories (
  id_cat tinyint(3) NOT NULL auto_increment,
  categories varchar(255) default NULL,
  flanguage varchar(30) NOT NULL default '',
  PRIMARY KEY  (id_cat),
  KEY id_cat (id_cat)
);

#
# Volcar la base de datos para la tabla `nuke_faqcategories`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_groups`
#

CREATE TABLE nuke_groups (
  id int(10) NOT NULL auto_increment,
  name varchar(255) NOT NULL default '',
  description text NOT NULL,
  points int(10) NOT NULL default '0',
  KEY id (id)
);

#
# Volcar la base de datos para la tabla `nuke_groups`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_groups_points`
#

CREATE TABLE nuke_groups_points (
  id int(10) NOT NULL auto_increment,
  points int(10) NOT NULL default '0',
  KEY id (id)
);

#
# Volcar la base de datos para la tabla `nuke_groups_points`
#

INSERT INTO nuke_groups_points VALUES (1, 0);
INSERT INTO nuke_groups_points VALUES (2, 0);
INSERT INTO nuke_groups_points VALUES (3, 0);
INSERT INTO nuke_groups_points VALUES (4, 0);
INSERT INTO nuke_groups_points VALUES (5, 0);
INSERT INTO nuke_groups_points VALUES (6, 0);
INSERT INTO nuke_groups_points VALUES (7, 0);
INSERT INTO nuke_groups_points VALUES (8, 0);
INSERT INTO nuke_groups_points VALUES (9, 0);
INSERT INTO nuke_groups_points VALUES (10, 0);
INSERT INTO nuke_groups_points VALUES (11, 0);
INSERT INTO nuke_groups_points VALUES (12, 0);
INSERT INTO nuke_groups_points VALUES (13, 0);
INSERT INTO nuke_groups_points VALUES (14, 0);
INSERT INTO nuke_groups_points VALUES (15, 0);
INSERT INTO nuke_groups_points VALUES (16, 0);
INSERT INTO nuke_groups_points VALUES (17, 0);
INSERT INTO nuke_groups_points VALUES (18, 0);
INSERT INTO nuke_groups_points VALUES (19, 0);
INSERT INTO nuke_groups_points VALUES (20, 0);
INSERT INTO nuke_groups_points VALUES (21, 0);
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_headlines`
#

CREATE TABLE nuke_headlines (
  hid int(11) NOT NULL auto_increment,
  sitename varchar(30) NOT NULL default '',
  headlinesurl varchar(200) NOT NULL default '',
  PRIMARY KEY  (hid),
  KEY hid (hid)
);

#
# Volcar la base de datos para la tabla `nuke_headlines`
#

INSERT INTO nuke_headlines VALUES (1, 'AbsoluteGames', 'http://files.gameaholic.com/agfa.rdf');
INSERT INTO nuke_headlines VALUES (2, 'BSDToday', 'http://www.bsdtoday.com/backend/bt.rdf');
INSERT INTO nuke_headlines VALUES (3, 'BrunchingShuttlecocks', 'http://www.brunching.com/brunching.rdf');
INSERT INTO nuke_headlines VALUES (4, 'DailyDaemonNews', 'http://daily.daemonnews.org/ddn.rdf.php3');
INSERT INTO nuke_headlines VALUES (5, 'DigitalTheatre', 'http://www.dtheatre.com/backend.php3?xml=yes');
INSERT INTO nuke_headlines VALUES (6, 'DotKDE', 'http://dot.kde.org/rdf');
INSERT INTO nuke_headlines VALUES (7, 'FreeDOS', 'http://www.freedos.org/channels/rss.cgi');
INSERT INTO nuke_headlines VALUES (8, 'Freshmeat', 'http://rss.freshmeat.net/freshmeat/feeds/fm-releases-global');
INSERT INTO nuke_headlines VALUES (9, 'Gnome Desktop', 'http://www.gnomedesktop.org/backend.php');
INSERT INTO nuke_headlines VALUES (10, 'HappyPenguin', 'http://happypenguin.org/html/news.rdf');
INSERT INTO nuke_headlines VALUES (11, 'HollywoodBitchslap', 'http://hollywoodbitchslap.com/hbs.rdf');
INSERT INTO nuke_headlines VALUES (12, 'Learning Linux', 'http://www.learninglinux.com/backend.php');
INSERT INTO nuke_headlines VALUES (13, 'LinuxCentral', 'http://linuxcentral.com/backend/lcnew.rdf');
INSERT INTO nuke_headlines VALUES (14, 'LinuxJournal', 'http://www.linuxjournal.com/news.rss');
INSERT INTO nuke_headlines VALUES (15, 'LinuxWeelyNews', 'http://lwn.net/headlines/rss');
INSERT INTO nuke_headlines VALUES (16, 'Listology', 'http://listology.com/recent.rdf');
INSERT INTO nuke_headlines VALUES (17, 'MozillaNewsBot', 'http://www.mozilla.org/newsbot/newsbot.rdf');
INSERT INTO nuke_headlines VALUES (18, 'NewsForge', 'http://www.newsforge.com/newsforge.rdf');
INSERT INTO nuke_headlines VALUES (19, 'NukeResources', 'http://www.nukeresources.com/backend.php');
INSERT INTO nuke_headlines VALUES (20, 'WebReference', 'http://webreference.com/webreference.rdf');
INSERT INTO nuke_headlines VALUES (21, 'PDABuzz', 'http://www.pdabuzz.com/netscape.txt');
INSERT INTO nuke_headlines VALUES (22, 'PHP-Nuke', 'http://phpnuke.org/backend.php');
INSERT INTO nuke_headlines VALUES (23, 'PHP.net', 'http://www.php.net/news.rss');
INSERT INTO nuke_headlines VALUES (24, 'PHPBuilder', 'http://phpbuilder.com/rss_feed.php');
INSERT INTO nuke_headlines VALUES (25, 'PerlMonks', 'http://www.perlmonks.org/headlines.rdf');
INSERT INTO nuke_headlines VALUES (26, 'TheNextLevel', 'http://www.the-nextlevel.com/rdf/tnl.rdf');
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_journal`
#

CREATE TABLE nuke_journal (
  jid int(11) NOT NULL auto_increment,
  aid varchar(30) NOT NULL default '',
  title varchar(80) default NULL,
  bodytext text NOT NULL,
  mood varchar(48) NOT NULL default '',
  pdate varchar(48) NOT NULL default '',
  ptime varchar(48) NOT NULL default '',
  `status` varchar(48) NOT NULL default '',
  mtime varchar(48) NOT NULL default '',
  mdate varchar(48) NOT NULL default '',
  PRIMARY KEY  (jid),
  KEY jid (jid),
  KEY aid (aid)
);

#
# Volcar la base de datos para la tabla `nuke_journal`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_journal_comments`
#

CREATE TABLE nuke_journal_comments (
  cid int(11) NOT NULL auto_increment,
  rid varchar(48) NOT NULL default '',
  aid varchar(30) NOT NULL default '',
  `comment` text NOT NULL,
  pdate varchar(48) NOT NULL default '',
  ptime varchar(48) NOT NULL default '',
  PRIMARY KEY  (cid),
  KEY cid (cid),
  KEY rid (rid),
  KEY aid (aid)
);

#
# Volcar la base de datos para la tabla `nuke_journal_comments`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_journal_stats`
#

CREATE TABLE nuke_journal_stats (
  id int(11) NOT NULL auto_increment,
  joid varchar(48) NOT NULL default '',
  nop varchar(48) NOT NULL default '',
  ldp varchar(24) NOT NULL default '',
  ltp varchar(24) NOT NULL default '',
  micro varchar(128) NOT NULL default '',
  PRIMARY KEY  (id),
  KEY id (id)
);

#
# Volcar la base de datos para la tabla `nuke_journal_stats`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_links_categories`
#

CREATE TABLE nuke_links_categories (
  cid int(11) NOT NULL auto_increment,
  title varchar(50) NOT NULL default '',
  cdescription text NOT NULL,
  parentid int(11) NOT NULL default '0',
  PRIMARY KEY  (cid),
  KEY cid (cid)
);

#
# Volcar la base de datos para la tabla `nuke_links_categories`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_links_editorials`
#

CREATE TABLE nuke_links_editorials (
  linkid int(11) NOT NULL default '0',
  adminid varchar(60) NOT NULL default '',
  editorialtimestamp datetime NOT NULL default '0000-00-00 00:00:00',
  editorialtext text NOT NULL,
  editorialtitle varchar(100) NOT NULL default '',
  PRIMARY KEY  (linkid),
  KEY linkid (linkid)
);

#
# Volcar la base de datos para la tabla `nuke_links_editorials`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_links_links`
#

CREATE TABLE nuke_links_links (
  lid int(11) NOT NULL auto_increment,
  cid int(11) NOT NULL default '0',
  sid int(11) NOT NULL default '0',
  title varchar(100) NOT NULL default '',
  url varchar(100) NOT NULL default '',
  description text NOT NULL,
  `date` datetime default NULL,
  name varchar(100) NOT NULL default '',
  email varchar(100) NOT NULL default '',
  hits int(11) NOT NULL default '0',
  submitter varchar(60) NOT NULL default '',
  linkratingsummary double(6,4) NOT NULL default '0.0000',
  totalvotes int(11) NOT NULL default '0',
  totalcomments int(11) NOT NULL default '0',
  PRIMARY KEY  (lid),
  KEY lid (lid),
  KEY cid (cid),
  KEY sid (sid)
);

#
# Volcar la base de datos para la tabla `nuke_links_links`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_links_modrequest`
#

CREATE TABLE nuke_links_modrequest (
  requestid int(11) NOT NULL auto_increment,
  lid int(11) NOT NULL default '0',
  cid int(11) NOT NULL default '0',
  sid int(11) NOT NULL default '0',
  title varchar(100) NOT NULL default '',
  url varchar(100) NOT NULL default '',
  description text NOT NULL,
  modifysubmitter varchar(60) NOT NULL default '',
  brokenlink int(3) NOT NULL default '0',
  PRIMARY KEY  (requestid),
  UNIQUE KEY requestid (requestid)
);

#
# Volcar la base de datos para la tabla `nuke_links_modrequest`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_links_newlink`
#

CREATE TABLE nuke_links_newlink (
  lid int(11) NOT NULL auto_increment,
  cid int(11) NOT NULL default '0',
  sid int(11) NOT NULL default '0',
  title varchar(100) NOT NULL default '',
  url varchar(100) NOT NULL default '',
  description text NOT NULL,
  name varchar(100) NOT NULL default '',
  email varchar(100) NOT NULL default '',
  submitter varchar(60) NOT NULL default '',
  PRIMARY KEY  (lid),
  KEY lid (lid),
  KEY cid (cid),
  KEY sid (sid)
);

#
# Volcar la base de datos para la tabla `nuke_links_newlink`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_links_votedata`
#

CREATE TABLE nuke_links_votedata (
  ratingdbid int(11) NOT NULL auto_increment,
  ratinglid int(11) NOT NULL default '0',
  ratinguser varchar(60) NOT NULL default '',
  rating int(11) NOT NULL default '0',
  ratinghostname varchar(60) NOT NULL default '',
  ratingcomments text NOT NULL,
  ratingtimestamp datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (ratingdbid),
  KEY ratingdbid (ratingdbid)
);

#
# Volcar la base de datos para la tabla `nuke_links_votedata`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_main`
#

CREATE TABLE nuke_main (
  main_module varchar(255) NOT NULL default ''
);

#
# Volcar la base de datos para la tabla `nuke_main`
#

INSERT INTO nuke_main VALUES ('News');
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_message`
#

CREATE TABLE nuke_message (
  mid int(11) NOT NULL auto_increment,
  title varchar(100) NOT NULL default '',
  content text NOT NULL,
  `date` varchar(14) NOT NULL default '',
  expire int(7) NOT NULL default '0',
  active int(1) NOT NULL default '1',
  view int(1) NOT NULL default '1',
  mlanguage varchar(30) NOT NULL default '',
  PRIMARY KEY  (mid),
  UNIQUE KEY mid (mid)
);

#
# Volcar la base de datos para la tabla `nuke_message`
#

INSERT INTO nuke_message VALUES (1, 'Welcome to PHP-Nuke!', '<br>Congratulations! You have now a web portal installed!. You can edit or change this message from the <a href="admin.php">Administration</a> page.\r\n<br><br>\r\n<center><b>If you didn\'t use the Web Installer utility the best idea now is to create the Super User by clicking <a href="admin.php">HERE</a></b>.</center>\r\n<br><br>\r\nYou can also create a user for you from the same page or just create it at <a href="modules.php?name=Your_Account">Your Account module</a>. Please read carefully the README file, CREDITS file to see from where comes the things and remember that this is free software released under the GPL License (read COPYING file for details). Hope you enjoy this software. Please report any bug you find when one of this annoying things happens and I\'ll fix it for the next release.\r\n<br><br>\r\nIf you like this software and want to make a contribution you can purchase the latest non-free version before it goes public. This can be done from <a href="http://phpnuke.org/modules.php?name=Release">here</a> or if you prefer you can become a PHP-Nuke\'s Club Member by clicking <a href="http://phpnuke.org/modules.php?name=Club">here</a> and obtain extra goodies for your system.\r\n<br><br>You can also browse for great <b>PHP-Nuke\'s Themes</b> at <a href="http://smeego.com/index.php?act=viewCat&catId=34"><b>Smeego.com</b></a> where you can find professional looking themes for your business, gaming or casual site.\r\n<br><br>\r\nPHP-Nuke is an advanced and <i>intelligent</i> content management system designed and programmed with very hard work. PHP-Nuke has the biggest user\'s community in the world for this kind of application, thousands of people (users and programmers) are waiting for you to join this community at <a href="http://phpnuke.org">http://phpnuke.org</a> where you can find thousands of modules/addons, themes, blocks, graphics, utilities and much more...\r\n<br><br>If you want to have written authorization to remove all visible copyright messages and any reference to PHP-Nuke, you can now acquire it by clicking <a href="http://phpnuke.org/modules.php?name=Commercial_License" target="new">here</a>, at the same time this will be a great support.\r\n<br><br>\r\nThanks for your support and for selecting PHP-Nuke as you web site\'s code! Hope you can can enjoy this application as much as we enjoy developing it!', '993373194', 0, 1, 1, '');
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_modules`
#

CREATE TABLE nuke_modules (
  mid int(10) NOT NULL auto_increment,
  title varchar(255) NOT NULL default '',
  custom_title varchar(255) NOT NULL default '',
  active int(1) NOT NULL default '0',
  view int(1) NOT NULL default '0',
  inmenu tinyint(1) NOT NULL default '1',
  mod_group int(10) default '0',
  admins varchar(255) NOT NULL default '',
  PRIMARY KEY  (mid),
  KEY mid (mid),
  KEY title (title),
  KEY custom_title (custom_title)
);

#
# Volcar la base de datos para la tabla `nuke_modules`
#

INSERT INTO nuke_modules VALUES (1, 'AvantGo', 'AvantGo', 1, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (2, 'Content', 'Content', 0, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (3, 'Downloads', 'Downloads', 1, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (4, 'Encyclopedia', 'Encyclopedia', 0, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (5, 'FAQ', 'FAQ', 1, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (6, 'Feedback', 'Feedback', 1, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (7, 'Forums', 'Forums', 0, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (8, 'Journal', 'Journal', 1, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (9, 'Members_List', 'Members List', 0, 1, 1, 0, '');
INSERT INTO nuke_modules VALUES (10, 'News', 'News', 1, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (11, 'Private_Messages', 'Private Messages', 1, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (12, 'Recommend_Us', 'Recommend Us', 1, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (13, 'Reviews', 'Reviews', 0, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (14, 'Search', 'Search', 1, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (15, 'Statistics', 'Statistics', 1, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (16, 'Stories_Archive', 'Stories Archive', 1, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (17, 'Submit_News', 'Submit News', 1, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (18, 'Surveys', 'Surveys', 1, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (19, 'Top', 'Top 10', 1, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (20, 'Topics', 'Topics', 1, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (21, 'Web_Links', 'Web Links', 1, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (22, 'Your_Account', 'Your Account', 1, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (23, 'Advertising', 'Advertising', 0, 0, 1, 0, '');
INSERT INTO nuke_modules VALUES (24, 'AutoTheme', 'AutoTheme', 1, 0, 0, 0, '');

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_pages`
#

CREATE TABLE nuke_pages (
  pid int(10) NOT NULL auto_increment,
  cid int(10) NOT NULL default '0',
  title varchar(255) NOT NULL default '',
  subtitle varchar(255) NOT NULL default '',
  active int(1) NOT NULL default '0',
  page_header text NOT NULL,
  `text` text NOT NULL,
  page_footer text NOT NULL,
  signature text NOT NULL,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  counter int(10) NOT NULL default '0',
  clanguage varchar(30) NOT NULL default '',
  PRIMARY KEY  (pid),
  KEY pid (pid),
  KEY cid (cid)
);

#
# Volcar la base de datos para la tabla `nuke_pages`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_pages_categories`
#

CREATE TABLE nuke_pages_categories (
  cid int(10) NOT NULL auto_increment,
  title varchar(255) NOT NULL default '',
  description text NOT NULL,
  PRIMARY KEY  (cid),
  KEY cid (cid)
);

#
# Volcar la base de datos para la tabla `nuke_pages_categories`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_poll_check`
#

CREATE TABLE nuke_poll_check (
  ip varchar(20) NOT NULL default '',
  `time` varchar(14) NOT NULL default '',
  pollID int(10) NOT NULL default '0'
);

#
# Volcar la base de datos para la tabla `nuke_poll_check`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_poll_data`
#

CREATE TABLE nuke_poll_data (
  pollID int(11) NOT NULL default '0',
  optionText char(50) NOT NULL default '',
  optionCount int(11) NOT NULL default '0',
  voteID int(11) NOT NULL default '0'
);

#
# Volcar la base de datos para la tabla `nuke_poll_data`
#

INSERT INTO nuke_poll_data VALUES (1, 'Ummmm, not bad', 0, 1);
INSERT INTO nuke_poll_data VALUES (1, 'Cool', 0, 2);
INSERT INTO nuke_poll_data VALUES (1, 'Terrific', 0, 3);
INSERT INTO nuke_poll_data VALUES (1, 'The best one!', 0, 4);
INSERT INTO nuke_poll_data VALUES (1, 'what the hell is this?', 0, 5);
INSERT INTO nuke_poll_data VALUES (1, '', 0, 6);
INSERT INTO nuke_poll_data VALUES (1, '', 0, 7);
INSERT INTO nuke_poll_data VALUES (1, '', 0, 8);
INSERT INTO nuke_poll_data VALUES (1, '', 0, 9);
INSERT INTO nuke_poll_data VALUES (1, '', 0, 10);
INSERT INTO nuke_poll_data VALUES (1, '', 0, 11);
INSERT INTO nuke_poll_data VALUES (1, '', 0, 12);
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_poll_desc`
#

CREATE TABLE nuke_poll_desc (
  pollID int(11) NOT NULL auto_increment,
  pollTitle varchar(100) NOT NULL default '',
  `timeStamp` int(11) NOT NULL default '0',
  voters mediumint(9) NOT NULL default '0',
  planguage varchar(30) NOT NULL default '',
  artid int(10) NOT NULL default '0',
  comments int(11) default '0',
  PRIMARY KEY  (pollID),
  KEY pollID (pollID)
);

#
# Volcar la base de datos para la tabla `nuke_poll_desc`
#

INSERT INTO nuke_poll_desc VALUES (1, 'What do you think about this site?', 961405160, 0, 'english', 0, 0);
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_pollcomments`
#

CREATE TABLE nuke_pollcomments (
  tid int(11) NOT NULL auto_increment,
  pid int(11) NOT NULL default '0',
  pollID int(11) NOT NULL default '0',
  `date` datetime default NULL,
  name varchar(60) NOT NULL default '',
  email varchar(60) default NULL,
  url varchar(60) default NULL,
  host_name varchar(60) default NULL,
  `subject` varchar(60) NOT NULL default '',
  `comment` text NOT NULL,
  score tinyint(4) NOT NULL default '0',
  reason tinyint(4) NOT NULL default '0',
  last_moderation_ip varchar(15) default '0',
  PRIMARY KEY  (tid),
  KEY tid (tid),
  KEY pid (pid),
  KEY pollID (pollID)
);

#
# Volcar la base de datos para la tabla `nuke_pollcomments`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_pollcomments_moderated`
#

CREATE TABLE nuke_pollcomments_moderated (
  tid int(11) NOT NULL auto_increment,
  pid int(11) NOT NULL default '0',
  pollID int(11) NOT NULL default '0',
  `date` datetime default NULL,
  name varchar(60) NOT NULL default '',
  email varchar(60) default NULL,
  url varchar(60) default NULL,
  host_name varchar(60) default NULL,
  `subject` varchar(60) NOT NULL default '',
  `comment` text NOT NULL,
  score tinyint(4) NOT NULL default '0',
  reason tinyint(4) NOT NULL default '0',
  last_moderation_ip varchar(15) default '0',
  PRIMARY KEY  (tid),
  KEY tid (tid),
  KEY pid (pid),
  KEY pollID (pollID)
);

#
# Volcar la base de datos para la tabla `nuke_pollcomments_moderated`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_public_messages`
#

CREATE TABLE nuke_public_messages (
  mid int(10) NOT NULL auto_increment,
  content varchar(255) NOT NULL default '',
  `date` varchar(14) default NULL,
  who varchar(25) NOT NULL default '',
  PRIMARY KEY  (mid),
  KEY mid (mid)
);

#
# Volcar la base de datos para la tabla `nuke_public_messages`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_queue`
#

CREATE TABLE nuke_queue (
  qid smallint(5) unsigned NOT NULL auto_increment,
  uid mediumint(9) NOT NULL default '0',
  uname varchar(40) NOT NULL default '',
  `subject` varchar(100) NOT NULL default '',
  story text,
  storyext text NOT NULL,
  `timestamp` datetime NOT NULL default '0000-00-00 00:00:00',
  topic varchar(20) NOT NULL default '',
  alanguage varchar(30) NOT NULL default '',
  PRIMARY KEY  (qid),
  KEY qid (qid),
  KEY uid (uid),
  KEY uname (uname)
);

#
# Volcar la base de datos para la tabla `nuke_queue`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_referer`
#

CREATE TABLE nuke_referer (
  rid int(11) NOT NULL auto_increment,
  url varchar(100) NOT NULL default '',
  PRIMARY KEY  (rid),
  KEY rid (rid)
);

#
# Volcar la base de datos para la tabla `nuke_referer`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_related`
#

CREATE TABLE nuke_related (
  rid int(11) NOT NULL auto_increment,
  tid int(11) NOT NULL default '0',
  name varchar(30) NOT NULL default '',
  url varchar(200) NOT NULL default '',
  PRIMARY KEY  (rid),
  KEY rid (rid),
  KEY tid (tid)
);

#
# Volcar la base de datos para la tabla `nuke_related`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_reviews`
#

CREATE TABLE nuke_reviews (
  id int(10) NOT NULL auto_increment,
  `date` date NOT NULL default '0000-00-00',
  title varchar(150) NOT NULL default '',
  `text` text NOT NULL,
  reviewer varchar(20) default NULL,
  email varchar(60) default NULL,
  score int(10) NOT NULL default '0',
  cover varchar(100) NOT NULL default '',
  url varchar(100) NOT NULL default '',
  url_title varchar(50) NOT NULL default '',
  hits int(10) NOT NULL default '0',
  rlanguage varchar(30) NOT NULL default '',
  PRIMARY KEY  (id),
  KEY id (id)
);

#
# Volcar la base de datos para la tabla `nuke_reviews`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_reviews_add`
#

CREATE TABLE nuke_reviews_add (
  id int(10) NOT NULL auto_increment,
  `date` date default NULL,
  title varchar(150) NOT NULL default '',
  `text` text NOT NULL,
  reviewer varchar(20) NOT NULL default '',
  email varchar(60) default NULL,
  score int(10) NOT NULL default '0',
  url varchar(100) NOT NULL default '',
  url_title varchar(50) NOT NULL default '',
  rlanguage varchar(30) NOT NULL default '',
  PRIMARY KEY  (id),
  KEY id (id)
);

#
# Volcar la base de datos para la tabla `nuke_reviews_add`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_reviews_comments`
#

CREATE TABLE nuke_reviews_comments (
  cid int(10) NOT NULL auto_increment,
  rid int(10) NOT NULL default '0',
  userid varchar(25) NOT NULL default '',
  `date` datetime default NULL,
  comments text,
  score int(10) NOT NULL default '0',
  PRIMARY KEY  (cid),
  KEY cid (cid),
  KEY rid (rid),
  KEY userid (userid)
);

#
# Volcar la base de datos para la tabla `nuke_reviews_comments`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_reviews_comments_moderated`
#

CREATE TABLE nuke_reviews_comments_moderated (
  cid int(10) NOT NULL auto_increment,
  rid int(10) NOT NULL default '0',
  userid varchar(25) NOT NULL default '',
  `date` datetime default NULL,
  comments text,
  score int(10) NOT NULL default '0',
  PRIMARY KEY  (cid),
  KEY cid (cid),
  KEY rid (rid),
  KEY userid (userid)
);

#
# Volcar la base de datos para la tabla `nuke_reviews_comments_moderated`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_reviews_main`
#

CREATE TABLE nuke_reviews_main (
  title varchar(100) default NULL,
  description text
);

#
# Volcar la base de datos para la tabla `nuke_reviews_main`
#

INSERT INTO nuke_reviews_main VALUES ('Reviews Section Title', 'Reviews Section Long Description');
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_session`
#

CREATE TABLE nuke_session (
  uname varchar(25) NOT NULL default '',
  `time` varchar(14) NOT NULL default '',
  host_addr varchar(48) NOT NULL default '',
  guest int(1) NOT NULL default '0',
  KEY `time` (`time`),
  KEY guest (guest)
);

#
# Volcar la base de datos para la tabla `nuke_session`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_stats_date`
#

CREATE TABLE nuke_stats_date (
  `year` smallint(6) NOT NULL default '0',
  `month` tinyint(4) NOT NULL default '0',
  `date` tinyint(4) NOT NULL default '0',
  hits bigint(20) NOT NULL default '0'
);

#
# Volcar la base de datos para la tabla `nuke_stats_date`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_stats_hour`
#

CREATE TABLE nuke_stats_hour (
  `year` smallint(6) NOT NULL default '0',
  `month` tinyint(4) NOT NULL default '0',
  `date` tinyint(4) NOT NULL default '0',
  `hour` tinyint(4) NOT NULL default '0',
  hits int(11) NOT NULL default '0'
);

#
# Volcar la base de datos para la tabla `nuke_stats_hour`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_stats_month`
#

CREATE TABLE nuke_stats_month (
  `year` smallint(6) NOT NULL default '0',
  `month` tinyint(4) NOT NULL default '0',
  hits bigint(20) NOT NULL default '0'
);

#
# Volcar la base de datos para la tabla `nuke_stats_month`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_stats_year`
#

CREATE TABLE nuke_stats_year (
  `year` smallint(6) NOT NULL default '0',
  hits bigint(20) NOT NULL default '0'
);

#
# Volcar la base de datos para la tabla `nuke_stats_year`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_stories`
#

CREATE TABLE nuke_stories (
  sid int(11) NOT NULL auto_increment,
  catid int(11) NOT NULL default '0',
  aid varchar(30) NOT NULL default '',
  title varchar(80) default NULL,
  `time` datetime default NULL,
  hometext text,
  bodytext text NOT NULL,
  comments int(11) default '0',
  counter mediumint(8) unsigned default NULL,
  topic int(3) NOT NULL default '1',
  informant varchar(20) NOT NULL default '',
  notes text NOT NULL,
  ihome int(1) NOT NULL default '0',
  alanguage varchar(30) NOT NULL default '',
  acomm int(1) NOT NULL default '0',
  haspoll int(1) NOT NULL default '0',
  pollID int(10) NOT NULL default '0',
  score int(10) NOT NULL default '0',
  ratings int(10) NOT NULL default '0',
  rating_ip varchar(15) default '0',
  associated text NOT NULL,
  PRIMARY KEY  (sid),
  KEY sid (sid),
  KEY catid (catid),
  KEY counter (counter),
  KEY topic (topic)
);

#
# Volcar la base de datos para la tabla `nuke_stories`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_stories_cat`
#

CREATE TABLE nuke_stories_cat (
  catid int(11) NOT NULL auto_increment,
  title varchar(20) NOT NULL default '',
  counter int(11) NOT NULL default '0',
  PRIMARY KEY  (catid),
  KEY catid (catid)
);

#
# Volcar la base de datos para la tabla `nuke_stories_cat`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_subscriptions`
#

CREATE TABLE nuke_subscriptions (
  id int(10) NOT NULL auto_increment,
  userid int(10) default '0',
  subscription_expire varchar(50) NOT NULL default '',
  KEY id (id,userid)
);

#
# Volcar la base de datos para la tabla `nuke_subscriptions`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_topics`
#

CREATE TABLE nuke_topics (
  topicid int(3) NOT NULL auto_increment,
  topicname varchar(20) default NULL,
  topicimage varchar(100) NOT NULL default '',
  topictext varchar(40) default NULL,
  counter int(11) NOT NULL default '0',
  PRIMARY KEY  (topicid),
  KEY topicid (topicid)
);

#
# Volcar la base de datos para la tabla `nuke_topics`
#

INSERT INTO nuke_topics VALUES (1, 'phpnuke', 'phpnuke.gif', 'PHP-Nuke', 0);
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_users`
#

CREATE TABLE nuke_users (
  user_id int(11) NOT NULL auto_increment,
  name varchar(60) NOT NULL default '',
  username varchar(25) NOT NULL default '',
  user_email varchar(255) NOT NULL default '',
  femail varchar(255) NOT NULL default '',
  user_website varchar(255) NOT NULL default '',
  user_avatar varchar(255) NOT NULL default '',
  user_regdate varchar(20) NOT NULL default '',
  user_icq varchar(15) default NULL,
  user_occ varchar(100) default NULL,
  user_from varchar(100) default NULL,
  user_interests varchar(150) NOT NULL default '',
  user_sig varchar(255) default NULL,
  user_viewemail tinyint(2) default NULL,
  user_theme int(3) default NULL,
  user_aim varchar(18) default NULL,
  user_yim varchar(25) default NULL,
  user_msnm varchar(25) default NULL,
  user_password varchar(40) NOT NULL default '',
  storynum tinyint(4) NOT NULL default '10',
  umode varchar(10) NOT NULL default '',
  uorder tinyint(1) NOT NULL default '0',
  thold tinyint(1) NOT NULL default '0',
  noscore tinyint(1) NOT NULL default '0',
  bio tinytext NOT NULL,
  ublockon tinyint(1) NOT NULL default '0',
  ublock tinytext NOT NULL,
  theme varchar(255) NOT NULL default '',
  commentmax int(11) NOT NULL default '4096',
  counter int(11) NOT NULL default '0',
  newsletter int(1) NOT NULL default '0',
  user_posts int(10) NOT NULL default '0',
  user_attachsig int(2) NOT NULL default '0',
  user_rank int(10) NOT NULL default '0',
  user_level int(10) NOT NULL default '1',
  broadcast tinyint(1) NOT NULL default '1',
  popmeson tinyint(1) NOT NULL default '0',
  user_active tinyint(1) default '1',
  user_session_time int(11) NOT NULL default '0',
  user_session_page smallint(5) NOT NULL default '0',
  user_lastvisit int(11) NOT NULL default '0',
  user_timezone tinyint(4) NOT NULL default '10',
  user_style tinyint(4) default NULL,
  user_lang varchar(255) NOT NULL default 'english',
  user_dateformat varchar(14) NOT NULL default 'D M d, Y g:i a',
  user_new_privmsg smallint(5) unsigned NOT NULL default '0',
  user_unread_privmsg smallint(5) unsigned NOT NULL default '0',
  user_last_privmsg int(11) NOT NULL default '0',
  user_emailtime int(11) default NULL,
  user_allowhtml tinyint(1) default '1',
  user_allowbbcode tinyint(1) default '1',
  user_allowsmile tinyint(1) default '1',
  user_allowavatar tinyint(1) NOT NULL default '1',
  user_allow_pm tinyint(1) NOT NULL default '1',
  user_allow_viewonline tinyint(1) NOT NULL default '1',
  user_notify tinyint(1) NOT NULL default '0',
  user_notify_pm tinyint(1) NOT NULL default '0',
  user_popup_pm tinyint(1) NOT NULL default '0',
  user_avatar_type tinyint(4) NOT NULL default '3',
  user_sig_bbcode_uid varchar(10) default NULL,
  user_actkey varchar(32) default NULL,
  user_newpasswd varchar(32) default NULL,
  points int(10) default '0',
  last_ip varchar(15) NOT NULL default '0',
  karma tinyint(1) default '0',
  PRIMARY KEY  (user_id),
  KEY uid (user_id),
  KEY uname (username),
  KEY user_session_time (user_session_time),
  KEY karma (karma)
);

#
# Volcar la base de datos para la tabla `nuke_users`
#

INSERT INTO nuke_users VALUES (1, '', 'Anonymous', '', '', '', 'blank.gif', 'Nov 10, 2000', '', '', '', '', '', 0, 0, '', '', '', '', 10, '', 0, 0, 0, '', 0, '', '', 4096, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 10, NULL, 'english', 'D M d, Y g:i a', 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 0, 3, NULL, NULL, NULL, 0, '0', 0);
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `nuke_users_temp`
#

CREATE TABLE nuke_users_temp (
  user_id int(10) NOT NULL auto_increment,
  username varchar(25) NOT NULL default '',
  user_email varchar(255) NOT NULL default '',
  user_password varchar(40) NOT NULL default '',
  user_regdate varchar(20) NOT NULL default '',
  check_num varchar(50) NOT NULL default '',
  `time` varchar(14) NOT NULL default '',
  PRIMARY KEY  (user_id)
);

#
# Volcar la base de datos para la tabla `nuke_users_temp`
#
