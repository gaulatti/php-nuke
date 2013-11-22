<?php

######################################################
# File to upgrade from PHP-Nuke 6.0 to PHP-Nuke 6.5
# After you used this file, you can safely delete it.
######################################################
#            -= WARNING: PLEASE READ =-
#
# NOTE: This file uses config.php to retrieve needed
# variables values. So, to do the upgrade PLEASE copy
# this file in your server root directory and execute
# it from your browser.
######################################################

include("mainfile.php");

####################### BEGIN THE UPDATE #######################################

/*
    // Uncomment all this block if you want to remove Splatt Forums tables    
    $db->sql_query("DROP TABLE ".$prefix."_access");
    $db->sql_query("DROP TABLE ".$prefix."_banlist");
    $db->sql_query("DROP TABLE ".$prefix."_catagories");
    $db->sql_query("DROP TABLE ".$prefix."_disallow");
    $db->sql_query("DROP TABLE ".$prefix."_forum_access");
    $db->sql_query("DROP TABLE ".$prefix."_forum_config");
    $db->sql_query("DROP TABLE ".$prefix."_forum_mods");
    $db->sql_query("DROP TABLE ".$prefix."_forum_notifica");
    $db->sql_query("DROP TABLE ".$prefix."_forums");
    $db->sql_query("DROP TABLE ".$prefix."_forumtopics");
    $db->sql_query("DROP TABLE ".$prefix."_posts");
    $db->sql_query("DROP TABLE ".$prefix."_posts_text");
    $db->sql_query("DROP TABLE ".$prefix."_ranks");
    $db->sql_query("DROP TABLE ".$prefix."_smiles");
    $db->sql_query("DROP TABLE ".$prefix."_words");
*/

// Blocks Table Alteration
$db->sql_query("ALTER TABLE ".$prefix."_blocks CHANGE position bposition CHAR(1) NOT NULL");

// Session Table Alteration
$db->sql_query("ALTER TABLE ".$prefix."_session CHANGE username uname VARCHAR(25) NOT NULL");

// phpBB Forums Port Tables Creation
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_active tinyint(1) default '1'");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_session_time int(11) NOT NULL default '0'");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_session_page smallint(5) NOT NULL default '0'");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_lastvisit int(11) NOT NULL default '0'");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_timezone tinyint(4) NOT NULL default '10'");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_style tinyint(4) default NULL");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_lang varchar(255) NOT NULL default 'english'");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_dateformat varchar(14) NOT NULL default 'D M d, Y g:i a'");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_new_privmsg smallint(5) unsigned NOT NULL default '0'");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_unread_privmsg smallint(5) unsigned NOT NULL default '0'");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_last_privmsg int(11) NOT NULL default '0'");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_emailtime int(11) default NULL");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_allowhtml tinyint(1) default '1'");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_allowbbcode tinyint(1) default '1'");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_allowsmile tinyint(1) default '1'");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_allowavatar tinyint(1) NOT NULL default '1'");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_allow_pm tinyint(1) NOT NULL default '1'");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_allow_viewonline tinyint(1) NOT NULL default '1'");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_notify tinyint(1) NOT NULL default '0'");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_notify_pm tinyint(1) NOT NULL default '0'");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_popup_pm tinyint(1) NOT NULL default '0'");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_avatar_type tinyint(4) NOT NULL default '3'");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_sig_bbcode_uid varchar(10) default NULL");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_actkey varchar(32) default NULL");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD user_newpasswd varchar(32) default NULL");
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD INDEX (user_session_time)");
$db->sql_query("CREATE TABLE ".$prefix."_bbauth_access (group_id mediumint(8) NOT NULL default '0', forum_id smallint(5) unsigned NOT NULL default '0', auth_view tinyint(1) NOT NULL default '0', auth_read tinyint(1) NOT NULL default '0', auth_post tinyint(1) NOT NULL default '0', auth_reply tinyint(1) NOT NULL default '0', auth_edit tinyint(1) NOT NULL default '0', auth_delete tinyint(1) NOT NULL default '0', auth_sticky tinyint(1) NOT NULL default '0', auth_announce tinyint(1) NOT NULL default '0', auth_vote tinyint(1) NOT NULL default '0', auth_pollcreate tinyint(1) NOT NULL default '0', auth_attachments tinyint(1) NOT NULL default '0', auth_mod tinyint(1) NOT NULL default '0', KEY group_id (group_id), KEY forum_id (forum_id))");
$db->sql_query("CREATE TABLE ".$prefix."_bbbanlist (ban_id mediumint(8) unsigned NOT NULL auto_increment, ban_userid mediumint(8) NOT NULL default '0', ban_ip varchar(8) NOT NULL default '', ban_email varchar(255) default NULL, PRIMARY KEY  (ban_id), KEY ban_ip_user_id (ban_ip,ban_userid))");
$db->sql_query("CREATE TABLE ".$prefix."_bbcategories (cat_id mediumint(8) unsigned NOT NULL auto_increment, cat_title varchar(100) default NULL, cat_order mediumint(8) unsigned NOT NULL default '0', PRIMARY KEY  (cat_id), KEY cat_order (cat_order))");
$db->sql_query("CREATE TABLE ".$prefix."_bbconfig (config_name varchar(255) NOT NULL default '', config_value varchar(255) NOT NULL default '', PRIMARY KEY  (config_name))");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('config_id','1')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('board_disable','0')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('sitename','MySite.com')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('site_desc','')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('cookie_name','phpbb2mysql')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('cookie_path','/')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('cookie_domain','MySite.com')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('cookie_secure','0')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('session_length','0')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('allow_html','1')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('allow_html_tags','b,i,u,pre')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('allow_bbcode','1')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('allow_smilies','1')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('allow_sig','1')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('allow_namechange','0')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('allow_theme_create','0')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('allow_avatar_local','1')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('allow_avatar_remote','0')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('allow_avatar_upload','0')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('override_user_style','1')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('posts_per_page','15')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('topics_per_page','50')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('hot_threshold','25')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('max_poll_options','10')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('max_sig_chars','255')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('max_inbox_privmsgs','100')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('max_sentbox_privmsgs','100')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('max_savebox_privmsgs','100')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('board_email_sig','Thanks, Webmaster@MySite.com')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('board_email','Webmaster@MySite.com')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('smtp_delivery','0')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('smtp_host','')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('require_activation','0')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('flood_interval','15')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('board_email_form','0')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('avatar_filesize','6144')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('avatar_max_width','80')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('avatar_max_height','80')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('avatar_path','modules/Forums/images/avatars')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('avatar_gallery_path','modules/Forums/images/avatars')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('smilies_path','modules/Forums/images/smiles')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('default_style','1')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('default_dateformat','D M d, Y g:i a')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('board_timezone','10')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('prune_enable','0')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('privmsg_disable','0')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('gzip_compress','0')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('coppa_fax','')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('coppa_mail','')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('board_startdate','1013908210')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('default_lang','english')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('smtp_username','')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('smtp_password','')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('record_online_users','2')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('record_online_date','1034668530')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('server_name','MySite.com')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('server_port','80')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('script_path','/modules/Forums/')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig VALUES ('version','.0.2')");
$db->sql_query("CREATE TABLE ".$prefix."_bbdisallow (disallow_id mediumint(8) unsigned NOT NULL auto_increment, disallow_username varchar(25) default NULL, PRIMARY KEY  (disallow_id))");
$db->sql_query("CREATE TABLE ".$prefix."_bbforum_prune (prune_id mediumint(8) unsigned NOT NULL auto_increment, forum_id smallint(5) unsigned NOT NULL default '0', prune_days tinyint(4) unsigned NOT NULL default '0', prune_freq tinyint(4) unsigned NOT NULL default '0', PRIMARY KEY  (prune_id), KEY forum_id (forum_id))");
$db->sql_query("CREATE TABLE ".$prefix."_bbforums (forum_id smallint(5) unsigned NOT NULL auto_increment, cat_id mediumint(8) unsigned NOT NULL default '0', forum_name varchar(150) default NULL, forum_desc text, forum_status tinyint(4) NOT NULL default '0', forum_order mediumint(8) unsigned NOT NULL default '1', forum_posts mediumint(8) unsigned NOT NULL default '0', forum_topics mediumint(8) unsigned NOT NULL default '0', forum_last_post_id mediumint(8) unsigned NOT NULL default '0', prune_next int(11) default NULL, prune_enable tinyint(1) NOT NULL default '1', auth_view tinyint(2) NOT NULL default '0', auth_read tinyint(2) NOT NULL default '0', auth_post tinyint(2) NOT NULL default '0', auth_reply tinyint(2) NOT NULL default '0', auth_edit tinyint(2) NOT NULL default '0', auth_delete tinyint(2) NOT NULL default '0', auth_sticky tinyint(2) NOT NULL default '0', auth_announce tinyint(2) NOT NULL default '0', auth_vote tinyint(2) NOT NULL default '0', auth_pollcreate tinyint(2) NOT NULL default '0', auth_attachments tinyint(2) NOT NULL default '0', PRIMARY KEY  (forum_id), KEY forums_order (forum_order), KEY cat_id (cat_id), KEY forum_last_post_id (forum_last_post_id))");
$db->sql_query("CREATE TABLE ".$prefix."_bbgroups (group_id mediumint(8) NOT NULL auto_increment, group_type tinyint(4) NOT NULL default '1', group_name varchar(40) NOT NULL default '', group_description varchar(255) NOT NULL default '', group_moderator mediumint(8) NOT NULL default '0', group_single_user tinyint(1) NOT NULL default '1', PRIMARY KEY  (group_id), KEY group_single_user (group_single_user))");
$db->sql_query("INSERT INTO ".$prefix."_bbgroups VALUES (1,1,'Anonymous','Personal User',0,1)");
$db->sql_query("INSERT INTO ".$prefix."_bbgroups VALUES (3,2,'Moderators','Moderators of this Forum',5,0)");
$db->sql_query("CREATE TABLE ".$prefix."_bbposts (post_id mediumint(8) unsigned NOT NULL auto_increment, topic_id mediumint(8) unsigned NOT NULL default '0', forum_id smallint(5) unsigned NOT NULL default '0', poster_id mediumint(8) NOT NULL default '0', post_time int(11) NOT NULL default '0', poster_ip varchar(8) NOT NULL default '', post_username varchar(25) default NULL, enable_bbcode tinyint(1) NOT NULL default '1', enable_html tinyint(1) NOT NULL default '0', enable_smilies tinyint(1) NOT NULL default '1', enable_sig tinyint(1) NOT NULL default '1', post_edit_time int(11) default NULL, post_edit_count smallint(5) unsigned NOT NULL default '0', PRIMARY KEY  (post_id), KEY forum_id (forum_id), KEY topic_id (topic_id), KEY poster_id (poster_id), KEY post_time (post_time))");
$db->sql_query("CREATE TABLE ".$prefix."_bbposts_text (post_id mediumint(8) unsigned NOT NULL default '0', bbcode_uid varchar(10) NOT NULL default '', post_subject varchar(60) default NULL, post_text text, PRIMARY KEY  (post_id))");
$db->sql_query("CREATE TABLE ".$prefix."_bbprivmsgs (privmsgs_id mediumint(8) unsigned NOT NULL auto_increment, privmsgs_type tinyint(4) NOT NULL default '0', privmsgs_subject varchar(255) NOT NULL default '0', privmsgs_from_userid mediumint(8) NOT NULL default '0', privmsgs_to_userid mediumint(8) NOT NULL default '0', privmsgs_date int(11) NOT NULL default '0', privmsgs_ip varchar(8) NOT NULL default '', privmsgs_enable_bbcode tinyint(1) NOT NULL default '1', privmsgs_enable_html tinyint(1) NOT NULL default '0', privmsgs_enable_smilies tinyint(1) NOT NULL default '1', privmsgs_attach_sig tinyint(1) NOT NULL default '1', PRIMARY KEY  (privmsgs_id), KEY privmsgs_from_userid (privmsgs_from_userid), KEY privmsgs_to_userid (privmsgs_to_userid))");
$db->sql_query("CREATE TABLE ".$prefix."_bbprivmsgs_text (privmsgs_text_id mediumint(8) unsigned NOT NULL default '0', privmsgs_bbcode_uid varchar(10) NOT NULL default '0', privmsgs_text text, PRIMARY KEY  (privmsgs_text_id))");
$db->sql_query("CREATE TABLE ".$prefix."_bbranks (rank_id smallint(5) unsigned NOT NULL auto_increment, rank_title varchar(50) NOT NULL default '', rank_min mediumint(8) NOT NULL default '0', rank_max mediumint(8) NOT NULL default '0', rank_special tinyint(1) default '0', rank_image varchar(255) default NULL, PRIMARY KEY  (rank_id))");
$db->sql_query("INSERT INTO ".$prefix."_bbranks VALUES (1,'Site Admin',-1,-1,1,'modules/Forums/images/ranks/6stars.gif')");
$db->sql_query("INSERT INTO ".$prefix."_bbranks VALUES (2,'Newbie',1,0,0,'modules/Forums/images/ranks/1star.gif')");
$db->sql_query("CREATE TABLE ".$prefix."_bbsearch_results (search_id int(11) unsigned NOT NULL default '0', session_id varchar(32) NOT NULL default '', search_array text NOT NULL, PRIMARY KEY  (search_id), KEY session_id (session_id))");
$db->sql_query("CREATE TABLE ".$prefix."_bbsearch_wordlist (word_text varchar(50) binary NOT NULL default '', word_id mediumint(8) unsigned NOT NULL auto_increment, word_common tinyint(1) unsigned NOT NULL default '0', PRIMARY KEY  (word_text), KEY word_id (word_id))");
$db->sql_query("CREATE TABLE ".$prefix."_bbsearch_wordmatch (post_id mediumint(8) unsigned NOT NULL default '0', word_id mediumint(8) unsigned NOT NULL default '0', title_match tinyint(1) NOT NULL default '0', KEY word_id (word_id))");
$db->sql_query("CREATE TABLE ".$prefix."_bbsessions (session_id char(32) NOT NULL default '', session_user_id mediumint(8) NOT NULL default '0', session_start int(11) NOT NULL default '0', session_time int(11) NOT NULL default '0', session_ip char(8) NOT NULL default '0', session_page int(11) NOT NULL default '0', session_logged_in tinyint(1) NOT NULL default '0', PRIMARY KEY  (session_id), KEY session_user_id (session_user_id), KEY session_id_ip_user_id (session_id,session_ip,session_user_id))");
$db->sql_query("CREATE TABLE ".$prefix."_bbsmilies (smilies_id smallint(5) unsigned NOT NULL auto_increment, code varchar(50) default NULL, smile_url varchar(100) default NULL, emoticon varchar(75) default NULL, PRIMARY KEY  (smilies_id))");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (1,':D','icon_biggrin.gif','Very Happy')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (2,':-D','icon_biggrin.gif','Very Happy')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (3,':grin:','icon_biggrin.gif','Very Happy')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (4,':)','icon_smile.gif','Smile')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (5,':-)','icon_smile.gif','Smile')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (6,':smile:','icon_smile.gif','Smile')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (7,':(','icon_sad.gif','Sad')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (8,':-(','icon_sad.gif','Sad')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (9,':sad:','icon_sad.gif','Sad')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (10,':o','icon_surprised.gif','Surprised')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (11,':-o','icon_surprised.gif','Surprised')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (12,':eek:','icon_surprised.gif','Surprised')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (13,'8O','icon_eek.gif','Shocked')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (14,'8-O','icon_eek.gif','Shocked')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (15,':shock:','icon_eek.gif','Shocked')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (16,':?','icon_confused.gif','Confused')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (17,':-?','icon_confused.gif','Confused')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (18,':???:','icon_confused.gif','Confused')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (19,'8)','icon_cool.gif','Cool')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (20,'8-)','icon_cool.gif','Cool')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (21,':cool:','icon_cool.gif','Cool')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (22,':lol:','icon_lol.gif','Laughing')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (23,':x','icon_mad.gif','Mad')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (24,':-x','icon_mad.gif','Mad')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (25,':mad:','icon_mad.gif','Mad')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (26,':P','icon_razz.gif','Razz')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (27,':-P','icon_razz.gif','Razz')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (28,':razz:','icon_razz.gif','Razz')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (29,':oops:','icon_redface.gif','Embarassed')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (30,':cry:','icon_cry.gif','Crying or Very sad')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (31,':evil:','icon_evil.gif','Evil or Very Mad')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (32,':twisted:','icon_twisted.gif','Twisted Evil')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (33,':roll:','icon_rolleyes.gif','Rolling Eyes')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (34,':wink:','icon_wink.gif','Wink')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (35,';)','icon_wink.gif','Wink')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (36,';-)','icon_wink.gif','Wink')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (37,':!:','icon_exclaim.gif','Exclamation')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (38,':?:','icon_question.gif','Question')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (39,':idea:','icon_idea.gif','Idea')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (40,':arrow:','icon_arrow.gif','Arrow')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (41,':|','icon_neutral.gif','Neutral')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (42,':-|','icon_neutral.gif','Neutral')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (43,':neutral:','icon_neutral.gif','Neutral')");
$db->sql_query("INSERT INTO ".$prefix."_bbsmilies VALUES (44,':mrgreen:','icon_mrgreen.gif','Mr. Green')");
$db->sql_query("CREATE TABLE ".$prefix."_bbthemes (themes_id mediumint(8) unsigned NOT NULL auto_increment, template_name varchar(30) NOT NULL default '', style_name varchar(30) NOT NULL default '', head_stylesheet varchar(100) default NULL, body_background varchar(100) default NULL, body_bgcolor varchar(6) default NULL, body_text varchar(6) default NULL, body_link varchar(6) default NULL, body_vlink varchar(6) default NULL, body_alink varchar(6) default NULL, body_hlink varchar(6) default NULL, tr_color1 varchar(6) default NULL, tr_color2 varchar(6) default NULL, tr_color3 varchar(6) default NULL, tr_class1 varchar(25) default NULL, tr_class2 varchar(25) default NULL, tr_class3 varchar(25) default NULL, th_color1 varchar(6) default NULL, th_color2 varchar(6) default NULL, th_color3 varchar(6) default NULL, th_class1 varchar(25) default NULL, th_class2 varchar(25) default NULL, th_class3 varchar(25) default NULL, td_color1 varchar(6) default NULL, td_color2 varchar(6) default NULL, td_color3 varchar(6) default NULL, td_class1 varchar(25) default NULL, td_class2 varchar(25) default NULL, td_class3 varchar(25) default NULL, fontface1 varchar(50) default NULL, fontface2 varchar(50) default NULL, fontface3 varchar(50) default NULL, fontsize1 tinyint(4) default NULL, fontsize2 tinyint(4) default NULL, fontsize3 tinyint(4) default NULL, fontcolor1 varchar(6) default NULL, fontcolor2 varchar(6) default NULL, fontcolor3 varchar(6) default NULL, span_class1 varchar(25) default NULL, span_class2 varchar(25) default NULL, span_class3 varchar(25) default NULL, img_size_poll smallint(5) unsigned default NULL, img_size_privmsg smallint(5) unsigned default NULL, PRIMARY KEY  (themes_id))");
$db->sql_query("INSERT INTO ".$prefix."_bbthemes VALUES (1,'subSilver','subSilver','subSilver.css','','0E3259','000000','006699','5493B4','','DD6900','EFEFEF','DEE3E7','D1D7DC','','','','98AAB1','006699','FFFFFF','cellpic1.gif','cellpic3.gif','cellpic2.jpg','FAFAFA','FFFFFF','','row1','row2','','Verdana, Arial, Helvetica, sans-serif','Trebuchet MS','Courier, \'Courier New\', sans-serif',10,11,12,'444444','006600','FFA34F','','','',NULL,NULL)");
$db->sql_query("CREATE TABLE ".$prefix."_bbthemes_name (themes_id smallint(5) unsigned NOT NULL default '0', tr_color1_name char(50) default NULL, tr_color2_name char(50) default NULL, tr_color3_name char(50) default NULL, tr_class1_name char(50) default NULL, tr_class2_name char(50) default NULL, tr_class3_name char(50) default NULL, th_color1_name char(50) default NULL, th_color2_name char(50) default NULL, th_color3_name char(50) default NULL, th_class1_name char(50) default NULL, th_class2_name char(50) default NULL, th_class3_name char(50) default NULL, td_color1_name char(50) default NULL, td_color2_name char(50) default NULL, td_color3_name char(50) default NULL, td_class1_name char(50) default NULL, td_class2_name char(50) default NULL, td_class3_name char(50) default NULL, fontface1_name char(50) default NULL, fontface2_name char(50) default NULL, fontface3_name char(50) default NULL, fontsize1_name char(50) default NULL, fontsize2_name char(50) default NULL, fontsize3_name char(50) default NULL, fontcolor1_name char(50) default NULL, fontcolor2_name char(50) default NULL, fontcolor3_name char(50) default NULL, span_class1_name char(50) default NULL, span_class2_name char(50) default NULL, span_class3_name char(50) default NULL, PRIMARY KEY  (themes_id))");
$db->sql_query("INSERT INTO ".$prefix."_bbthemes_name VALUES (1,'The lightest row colour','The medium row color','The darkest row colour','','','','Border round the whole page','Outer table border','Inner table border','Silver gradient picture','Blue gradient picture','Fade-out gradient on index','Background for quote boxes','All white areas','','Background for topic posts','2nd background for topic posts','','Main fonts','Additional topic title font','Form fonts','Smallest font size','Medium font size','Normal font size (post body etc)','Quote & copyright text','Code text colour','Main table header text colour','','','')");
$db->sql_query("DROP TABLE ".$prefix."_bbtopics");
$db->sql_query("CREATE TABLE ".$prefix."_bbtopics (topic_id mediumint(8) unsigned NOT NULL auto_increment, forum_id smallint(8) unsigned NOT NULL default '0', topic_title char(60) NOT NULL default '', topic_poster mediumint(8) NOT NULL default '0', topic_time int(11) NOT NULL default '0', topic_views mediumint(8) unsigned NOT NULL default '0', topic_replies mediumint(8) unsigned NOT NULL default '0', topic_status tinyint(3) NOT NULL default '0', topic_vote tinyint(1) NOT NULL default '0', topic_type tinyint(3) NOT NULL default '0', topic_last_post_id mediumint(8) unsigned NOT NULL default '0', topic_first_post_id mediumint(8) unsigned NOT NULL default '0', topic_moved_id mediumint(8) unsigned NOT NULL default '0', PRIMARY KEY  (topic_id), KEY forum_id (forum_id), KEY topic_moved_id (topic_moved_id), KEY topic_status (topic_status), KEY topic_type (topic_type))");
$db->sql_query("CREATE TABLE ".$prefix."_bbtopics_watch (topic_id mediumint(8) unsigned NOT NULL default '0', user_id mediumint(8) NOT NULL default '0', notify_status tinyint(1) NOT NULL default '0', KEY topic_id (topic_id), KEY user_id (user_id), KEY notify_status (notify_status))");
$db->sql_query("CREATE TABLE ".$prefix."_bbuser_group (group_id mediumint(8) NOT NULL default '0', user_id mediumint(8) NOT NULL default '0', user_pending tinyint(1) default NULL, KEY group_id (group_id), KEY user_id (user_id))");
$db->sql_query("INSERT INTO ".$prefix."_bbuser_group VALUES (1,-1,0)");
$db->sql_query("INSERT INTO ".$prefix."_bbuser_group VALUES (3,5,0)");
$db->sql_query("CREATE TABLE ".$prefix."_bbvote_desc (vote_id mediumint(8) unsigned NOT NULL auto_increment, topic_id mediumint(8) unsigned NOT NULL default '0', vote_text text NOT NULL, vote_start int(11) NOT NULL default '0', vote_length int(11) NOT NULL default '0', PRIMARY KEY  (vote_id), KEY topic_id (topic_id))");
$db->sql_query("CREATE TABLE ".$prefix."_bbvote_results (vote_id mediumint(8) unsigned NOT NULL default '0', vote_option_id tinyint(4) unsigned NOT NULL default '0', vote_option_text varchar(255) NOT NULL default '', vote_result int(11) NOT NULL default '0', KEY vote_option_id (vote_option_id), KEY vote_id (vote_id))");
$db->sql_query("CREATE TABLE ".$prefix."_bbvote_voters (vote_id mediumint(8) unsigned NOT NULL default '0', vote_user_id mediumint(8) NOT NULL default '0', vote_user_ip char(8) NOT NULL default '', KEY vote_id (vote_id), KEY vote_user_id (vote_user_id), KEY vote_user_ip (vote_user_ip))");
$db->sql_query("CREATE TABLE ".$prefix."_bbwords (word_id mediumint(8) unsigned NOT NULL auto_increment, word char(100) NOT NULL default '', replacement char(100) NOT NULL default '', PRIMARY KEY  (word_id))");

// Private Messages Migration
$sql = "SELECT * FROM ".$prefix."_priv_msgs";
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
    if ($row[read_msg] == '0') {
	$type = 5;
    } elseif ($row[read_msg] == '1') {
	$type = 0;
    }
    $time = $row[msg_time];
    $both = explode(" ", $time);
    $date = explode("-", $both[0]);
    $time = explode(":", $both[1]);
    $new_time = mktime($time[0],$time[1],$time[2],$date[1],$date[2],$date[0]);
    $uid = md5(mt_rand());
    $uid = substr($uid, 0, 10);
    $db->sql_query("INSERT INTO ".$prefix."_bbprivmsgs VALUES ('$row[msg_id]', '$type', '$row[subject]', '$row[from_userid]', '$row[to_userid]', '$new_time', '00000000', '1', '1', '1', '0')");
    $db->sql_query("INSERT INTO ".$prefix."_bbprivmsgs_text VALUES ('$row[msg_id]', '$uid', '$row[msg_text]')");
}
$db->sql_query("DROP TABLE ".$prefix."_priv_msgs");

// Delete some miserable entries. Slashdot because they never publish anything about PHP-Nuke and
// Linux.com because they never gave me a reply right when I asked for it after a very bad article
// about me and my project. So, eat this.
// In change, added two very nice resources...
$db->sql_query("DELETE FROM ".$prefix."_headlines WHERE sitename='Slashdot'");
$db->sql_query("DELETE FROM ".$prefix."_headlines WHERE sitename='Linux.com'");
$db->sql_query("INSERT INTO ".$prefix."_headlines VALUES (NULL, 'PHP.net', 'http://www.php.net/news.rss')");
$db->sql_query("INSERT INTO ".$prefix."_headlines VALUES (NULL, 'LinuxJournal', 'http://www.linuxjournal.com/news.rss')");

// PHP-Nuke Version Number Update
$db->sql_query("UPDATE ".$prefix."_config SET Version_Num='6.5'");

// Users table change, fields renamed
$db->sql_query("ALTER TABLE ".$user_prefix."_users CHANGE uid user_id INT(11) NOT NULL auto_increment");
$db->sql_query("ALTER TABLE ".$user_prefix."_users CHANGE uname username VARCHAR(25) NOT NULL");
$db->sql_query("ALTER TABLE ".$user_prefix."_users CHANGE email user_email VARCHAR(255) NOT NULL");
$db->sql_query("ALTER TABLE ".$user_prefix."_users CHANGE url user_website VARCHAR(255) NOT NULL");
$db->sql_query("ALTER TABLE ".$user_prefix."_users CHANGE user_intrest user_interests VARCHAR(150) NOT NULL");
$db->sql_query("ALTER TABLE ".$user_prefix."_users CHANGE pass user_password VARCHAR(40) NOT NULL");

// Users Table Alteration and Creation
$db->sql_query("ALTER TABLE ".$user_prefix."_users CHANGE user_avatar user_avatar VARCHAR(255) NOT NULL DEFAULT ''");
$db->sql_query("CREATE TABLE nuke_users_temp (user_id INT( 10 ) DEFAULT '0'AUTO_INCREMENT PRIMARY KEY, username VARCHAR( 25 ) NOT NULL, user_email VARCHAR(255) NOT NULL, user_password VARCHAR(40) NOT NULL, user_regdate VARCHAR(20) NOT NULL, check_num VARCHAR(50) NOT NULL, time VARCHAR(14) NOT NULL)");

// Stories Table Indexing
$db->sql_query("ALTER TABLE ".$prefix."_stories ADD INDEX (counter)");
$db->sql_query("ALTER TABLE ".$prefix."_stories ADD INDEX (topic)");

echo "PHP-Nuke Update finished!<br><br>"
    ."<b>NOTE:</b> This version of PHP-Nuke includes phpBB 2.0 port as official Forums module. Splatt Forum "
    ."module isn't included anymore but updates are available from <a href=\"http://www.splatt.it\">Splatt Forum</a> Homepage.<br><br>"
    ."You should now delete this upgrade file from your server.";

?>
