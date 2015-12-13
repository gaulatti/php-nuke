<?php

######################################################
# File to upgrade from PHP-Nuke 5.6 to PHP-Nuke 6.0
# After you used this file, you can safely delete it.
# Change the parameters to fit your info:
######################################################
#            -= WARNING: PLEASE READ =-
#
# NOTE: This file uses config.php to retrieve needed
# variables values. So, to do the upgrade PLEASE copy
# this file in your server root directory and execute
# it from your browser. Then you NEED to replace the
# config.php with the new one included in this release
# because all varibales are now stored in the database
######################################################

include("config.php");
mysqli_connect($dbhost, $dbuname, $dbpass);
@mysqli_select_db($dbname);

####################### BEGIN THE UPDATE #######################################

// Broadcast Public Messages Table Creation

mysqli_query("CREATE TABLE ".$prefix."_public_messages (mid int(10) NOT NULL auto_increment, content varchar(255) NOT NULL default '', date varchar(14) default NULL, who varchar(25) NOT NULL default '', PRIMARY KEY (mid))");

// Users Table Alteration

mysqli_query("ALTER TABLE ".$user_prefix."_users ADD broadcast TINYINT(1) DEFAULT '1' NOT NULL");
mysqli_query("ALTER TABLE ".$user_prefix."_users ADD popmeson TINYINT(1) DEFAULT '0' NOT NULL");

// WebMail Tables Creation

mysqli_query("CREATE TABLE ".$prefix."_contactbook(uid int(11) default NULL, contactid int(11) not null default NULL auto_increment, firstname varchar(50) default NULL, lastname varchar(50) default NULL, email varchar(255) default NULL, company varchar(255) default NULL, homeaddress varchar(255) default NULL, city varchar(80) default NULL, homephone varchar(255) default NULL, workphone varchar(255) default NULL, homepage varchar(255) default NULL, IM varchar(255) default NULL, events text default NULL, reminders int(11) default NULL, notes text default NULL, primary key (contactid))");
mysqli_query("CREATE TABLE ".$prefix."_popsettings(id int(11) not null default NULL auto_increment, uid int(11) default NULL, account varchar(50) default NULL, popserver varchar(255) default NULL, port int(5) default NULL, uname varchar(100) default NULL, passwd varchar(20) default NULL, numshow int(11) default NULL, deletefromserver char(1) default NULL, refresh int(11) default NULL, timeout int(11) default NULL, primary key (id))");

// Journal Tables Creation

mysqli_query("CREATE TABLE ".$prefix."_journal (jid int(11) NOT NULL auto_increment, aid varchar(30) NOT NULL default '', title varchar(80) default NULL, bodytext text NOT NULL, mood varchar(48) NOT NULL default '', pdate varchar(48) NOT NULL default '', ptime varchar(48) NOT NULL default '', status varchar(48) NOT NULL default '', mtime varchar(48) NOT NULL default '', mdate varchar(48) NOT NULL default '', PRIMARY KEY (jid))");
mysqli_query("CREATE TABLE ".$prefix."_journal_comments (cid int(11) NOT NULL auto_increment, rid varchar(48) NOT NULL default '', aid varchar(30) NOT NULL default '', comment text NOT NULL, pdate varchar(48) NOT NULL default '', ptime varchar(48) NOT NULL default '', PRIMARY KEY (cid))");
mysqli_query("CREATE TABLE ".$prefix."_journal_stats (id int(11) NOT NULL auto_increment, joid varchar(48) NOT NULL default '', nop varchar(48) NOT NULL default '', ldp varchar(24) NOT NULL default '', ltp varchar(24) NOT NULL default '', micro varchar(128) NOT NULL default '', PRIMARY KEY (id))");

// Modules Table Alteration

mysqli_query("ALTER TABLE ".$prefix."_modules ADD inmenu TINYINT(1) DEFAULT '1' NOT NULL");

// Banners Table Alteration

mysqli_query("ALTER TABLE ".$prefix."_banner ADD alttext VARCHAR(255) DEFAULT '' NOT NULL AFTER clickurl");

// Forums Table Alteration

mysqli_query("ALTER TABLE ".$prefix."_config RENAME ".$prefix."_forum_config");

// Main Configration Table Creation

if ($sitename == "") { $sitename = "PHP-Nuke Powered Site"; }
if ($nukeurl == "") { $nukeurl = "http://phpnuke.org"; }
if ($site_logo == "") { $site_logo = "logo.gif"; }
if ($slogan == "") { $slogan = "Your slogan here"; }
if ($startdate == "") { $startdate = "September 2002"; }
if ($adminmail == "") { $adminmail = "webmaster@phpnuke.org"; }
if ($anonpost == "") { $anonpost = 0; }
if ($Default_Theme == "") { $Default_Theme = "NukeNews"; }
if ($foot1 == "") { $foot1 = "<a href=\"http://phpnuke.org\" target=\"blank\"><img src=\"images/powered/nuke.gif\" border=\"0\" Alt=\"Web site powered by PHP-Nuke\" hspace=\"10\"></a>"; }
if ($foot2 == "") { $foot2 = "All logos and trademarks in this site are property of their respective owner. The comments are property of their posters, all the rest © 2002 by $sitename"; }
if ($foot3 == "") { $foot3 = "You can syndicate our news using the file <a href=\"backend.php\">backend.php</a> or <a href=\"ultramode.txt\">ultramode.txt</a>"; }
if ($commentlimit == "") { $commentlimit = 4096; }
if ($anonymous == "") { $anonymous = "Anonymous"; }
if ($minpass == "") { $minpass = 5; }
if ($pollcomm == "") { $pollcomm = 1; }
if ($articlecomm == "") { $articlecomm = 1; }
if ($top == "") { $top = 10; }
if ($storyhome == "") { $storyhome = 10; }
if ($oldnum == "") { $oldnum = 30; }
if ($ultramode == "") { $ultramode = 0; }
if ($banners == "") { $banners = 1; }
if ($backend_title == "") { $backend_title = "PHP-Nuke Powered Site"; }
if ($backend_language == "") { $backend_language = "en-us"; }
if ($language == "") { $language = "english"; }
if ($locale == "") { $locale = "en_US"; }
if ($multilingual == "") { $multilingual = "0"; }
if ($useflags == "") { $useflags = "0"; }
if ($notify == "") { $notify = 0; }
if ($notify_email == "") { $notify_email = "me@phpnuke.org"; }
if ($notify_subject == "") { $notify_subject = "NEWS for my site"; }
if ($notify_message == "") { $notify_message = "Hey! You got a new submission for your site."; }
if ($notify_from == "") { $notify_from = "webmaster"; }
if ($moderate == "") { $moderate = 0; }
if ($admingraphic == "") { $admingraphic = 1; }
if ($httpref == "") { $httpref = 1; }
if ($httprefmax == "") { $httprefmax = 1000; }
if ($CensorMode == "") { $CensorMode = 0; }
if ($CensorReplace == "") { $CensorReplace = "*****"; }
$copyright = "Web site engine\'s code is Copyright &copy; 2002 by <a href=\"http://phpnuke.org\"><font class=\"footmsg_l\">PHP-Nuke</font></a>. All Rights Reserved. PHP-Nuke is Free Software released under the <a href=\"http://www.gnu.org\"><font class=\"footmsg_l\">GNU/GPL license</font></a>.";
$broadcast_msg = 1;
$my_headlines = 1;
$user_news = 1;
$footermsgtxt = "Mail sent from WebMail service at PHP-Nuke Powered site\n- http://phpnuke.org\n";
$email_send = 1;
$attachmentdir = "/var/www/html/modules/WebMail/tmp/";
$attachments = 0;
$attachments_view = 0;
$download_dir = "modules/WebMail/attachments/";
$defaultpopserver = "";
$singleaccount = 0;
$singleaccountname = "Your account";
$numaccounts = -1;
$imgpath = "modules/WebMail/images";
$filter_forward = 1;
$domain = eregi_replace("http://", "", $nukeurl);
$copyright = addslashes($copyright);
$sitename = addslashes($sitename);
$site_logo = addslashes($site_logo);
$slogan = addslashes($slogan);
$startdate = addslashes($startdate);
$anonymous = addslashes($anonymous);
$backend_title = addslashes($backend_title);
$notify_subject = addslashes($notify_subject);
$notify_message = addslashes($notify_message);
$footermsgtxt = addslashes($footermsgtxt);
$singleaccountname = addslashes($singleaccountname);
$foot1 = addslashes($foot1);
$foot2 = addslashes($foot2);
$foot3 = addslashes($foot3);


mysqli_query("CREATE TABLE ".$prefix."_config (sitename VARCHAR(255) NOT NULL, nukeurl VARCHAR(255) NOT NULL, site_logo VARCHAR(255) NOT NULL, slogan VARCHAR(255) NOT NULL, startdate VARCHAR(50) NOT NULL, adminmail VARCHAR(255) NOT NULL, anonpost TINYINT(1) DEFAULT '0' NOT NULL, Default_Theme VARCHAR(255) NOT NULL, foot1 TEXT NOT NULL, foot2 TEXT NOT NULL, foot3 TEXT NOT NULL, commentlimit INT(9) DEFAULT '4096' NOT NULL, anonymous VARCHAR(255) NOT NULL, minpass TINYINT(1) DEFAULT '5' NOT NULL, pollcomm TINYINT(1) DEFAULT '1' NOT NULL, articlecomm TINYINT(1) DEFAULT '1' NOT NULL, broadcast_msg TINYINT(1) DEFAULT '1' NOT NULL, my_headlines TINYINT(1) DEFAULT '1' NOT NULL, top INT(3) DEFAULT '10' NOT NULL, storyhome INT(2) DEFAULT '10' NOT NULL, user_news TINYINT(1) DEFAULT '1' NOT NULL, oldnum INT(2) DEFAULT '30' NOT NULL, ultramode TINYINT(1) DEFAULT '0' NOT NULL, banners TINYINT(1) DEFAULT '1' NOT NULL, backend_title VARCHAR(255) NOT NULL, backend_language VARCHAR(10) NOT NULL, language VARCHAR(100) NOT NULL, locale VARCHAR(10) NOT NULL, multilingual TINYINT(1) DEFAULT '0' NOT NULL, useflags TINYINT(1) DEFAULT '0' NOT NULL, notify TINYINT(1) DEFAULT '0' NOT NULL, notify_email VARCHAR(255) NOT NULL, notify_subject VARCHAR(255) NOT NULL, notify_message VARCHAR(255) NOT NULL, notify_from VARCHAR(255) NOT NULL, footermsgtxt TEXT NOT NULL, email_send TINYINT(1) DEFAULT '1' NOT NULL, attachmentdir VARCHAR(255) NOT NULL, attachments TINYINT(1) DEFAULT '0' NOT NULL, attachments_view TINYINT(1) DEFAULT '0' NOT NULL, download_dir VARCHAR(255) NOT NULL, defaultpopserver VARCHAR(255) NOT NULL, singleaccount TINYINT(1) NOT NULL DEFAULT '0', singleaccountname VARCHAR(255) NOT NULL, numaccounts TINYINT(2) DEFAULT '-1' NOT NULL, imgpath VARCHAR(255) NOT NULL, filter_forward TINYINT(1) DEFAULT '1' NOT NULL, moderate TINYINT(1) DEFAULT '0' NOT NULL, admingraphic TINYINT(1) DEFAULT '1' NOT NULL, httpref TINYINT(1) DEFAULT '1' NOT NULL, httprefmax INT(5) DEFAULT '1000' NOT NULL, CensorMode TINYINT(1) DEFAULT '3' NOT NULL, CensorReplace VARCHAR(10) NOT NULL, copyright TEXT NOT NULL, Version_Num VARCHAR(10) NOT NULL)");
$result = mysqli_query("INSERT INTO nuke_config VALUES ('$sitename', '$nukeurl', '$site_logo', '$slogan', '$startdate', '$adminmail', '$anonpost', '$Default_Theme', '$foot1', '$foot2', '$foot3', '$commentlimit', '$anonymous', '$minpass', '$pollcomm', '$articlecomm', '$broadcast_msg', '$my_headlines', '$top', '$storyhome', '$user_news', '$oldnum', '$ultramode', '$banners', '$backend_title', '$backend_language', '$language', '$locale', '$multilingual', '$useflags', '$notify', '$notify_email', '$notify_subject', '$notify_message', '$notify_from', '$footermsgtxt', '$email_send', '$attachmentdir', '$attachments', '$attachments_view', '$download_dir', '$defaultpopserver', '$singleaccount', '$singleaccountname', '$numaccounts', '$imgpath', '$filter_forward', '$moderate', '$admingraphic', '$httpref', '$httprefmax', '$CensorMode', '$CensorReplace', '$copyright', '6.0')");

// Indexes Creation for ALL Tables

mysqli_query("ALTER TABLE ".$prefix."_access ADD INDEX (access_id)");
mysqli_query("ALTER TABLE ".$prefix."_authors ADD INDEX (aid)");
mysqli_query("ALTER TABLE ".$prefix."_autonews ADD INDEX (anid)");
mysqli_query("ALTER TABLE ".$prefix."_banner ADD INDEX (bid)");
mysqli_query("ALTER TABLE ".$prefix."_banner ADD INDEX (cid)");
mysqli_query("ALTER TABLE ".$prefix."_bannerclient ADD INDEX (cid)");
mysqli_query("ALTER TABLE ".$prefix."_blocks ADD INDEX (bid)");
mysqli_query("ALTER TABLE ".$prefix."_blocks ADD INDEX (title)");
mysqli_query("ALTER TABLE ".$prefix."_catagories ADD INDEX (cat_id)");
mysqli_query("ALTER TABLE ".$prefix."_comments ADD INDEX (tid)");
mysqli_query("ALTER TABLE ".$prefix."_comments ADD INDEX (pid)");
mysqli_query("ALTER TABLE ".$prefix."_comments ADD INDEX (sid)");
mysqli_query("ALTER TABLE ".$prefix."_contactbook ADD INDEX (uid)");
mysqli_query("ALTER TABLE ".$prefix."_contactbook ADD INDEX (contactid)");
mysqli_query("ALTER TABLE ".$prefix."_disallow ADD INDEX (disallow_id)");
mysqli_query("ALTER TABLE ".$prefix."_downloads_categories ADD INDEX (cid)");
mysqli_query("ALTER TABLE ".$prefix."_downloads_categories ADD INDEX (title)");
mysqli_query("ALTER TABLE ".$prefix."_downloads_downloads ADD INDEX (lid)");
mysqli_query("ALTER TABLE ".$prefix."_downloads_downloads ADD INDEX (cid)");
mysqli_query("ALTER TABLE ".$prefix."_downloads_downloads ADD INDEX (sid)");
mysqli_query("ALTER TABLE ".$prefix."_downloads_downloads ADD INDEX (title)");
mysqli_query("ALTER TABLE ".$prefix."_downloads_editorials ADD INDEX (downloadid)");
mysqli_query("ALTER TABLE ".$prefix."_downloads_newdownload ADD INDEX (lid)");
mysqli_query("ALTER TABLE ".$prefix."_downloads_newdownload ADD INDEX (cid)");
mysqli_query("ALTER TABLE ".$prefix."_downloads_newdownload ADD INDEX (sid)");
mysqli_query("ALTER TABLE ".$prefix."_downloads_newdownload ADD INDEX (title)");
mysqli_query("ALTER TABLE ".$prefix."_downloads_votedata ADD INDEX (ratingdbid)");
mysqli_query("ALTER TABLE ".$prefix."_encyclopedia ADD INDEX (eid)");
mysqli_query("ALTER TABLE ".$prefix."_encyclopedia_text ADD INDEX (tid)");
mysqli_query("ALTER TABLE ".$prefix."_encyclopedia_text ADD INDEX (eid)");
mysqli_query("ALTER TABLE ".$prefix."_encyclopedia_text ADD INDEX (title)");
mysqli_query("ALTER TABLE ".$prefix."_ephem ADD INDEX (eid)");
mysqli_query("ALTER TABLE ".$prefix."_faqAnswer ADD INDEX (id)");
mysqli_query("ALTER TABLE ".$prefix."_faqAnswer ADD INDEX (id_cat)");
mysqli_query("ALTER TABLE ".$prefix."_faqCategories ADD INDEX (id_cat)");
mysqli_query("ALTER TABLE ".$prefix."_forum_access ADD INDEX (forum_id)");
mysqli_query("ALTER TABLE ".$prefix."_forum_access ADD INDEX (user_id)");
mysqli_query("ALTER TABLE ".$prefix."_forum_mods ADD INDEX (forum_id)");
mysqli_query("ALTER TABLE ".$prefix."_forum_mods ADD INDEX (user_id)");
mysqli_query("ALTER TABLE ".$prefix."_forums ADD INDEX (forum_id)");
mysqli_query("ALTER TABLE ".$prefix."_forums ADD INDEX (forum_name)");
mysqli_query("ALTER TABLE ".$prefix."_forumtopics ADD INDEX (topic_id)");
mysqli_query("ALTER TABLE ".$prefix."_forumtopics ADD INDEX (forum_id)");
mysqli_query("ALTER TABLE ".$prefix."_headlines ADD INDEX (hid)");
mysqli_query("ALTER TABLE ".$prefix."_journal ADD INDEX (jid)");
mysqli_query("ALTER TABLE ".$prefix."_journal ADD INDEX (aid)");
mysqli_query("ALTER TABLE ".$prefix."_journal_comments ADD INDEX (cid)");
mysqli_query("ALTER TABLE ".$prefix."_journal_comments ADD INDEX (rid)");
mysqli_query("ALTER TABLE ".$prefix."_journal_comments ADD INDEX (aid)");
mysqli_query("ALTER TABLE ".$prefix."_journal_stats ADD INDEX (id)");
mysqli_query("ALTER TABLE ".$prefix."_links_categories ADD INDEX (cid)");
mysqli_query("ALTER TABLE ".$prefix."_links_editorials ADD INDEX (linkid)");
mysqli_query("ALTER TABLE ".$prefix."_links_links ADD INDEX (lid)");
mysqli_query("ALTER TABLE ".$prefix."_links_links ADD INDEX (cid)");
mysqli_query("ALTER TABLE ".$prefix."_links_links ADD INDEX (sid)");
mysqli_query("ALTER TABLE ".$prefix."_links_newlink ADD INDEX (lid)");
mysqli_query("ALTER TABLE ".$prefix."_links_newlink ADD INDEX (cid)");
mysqli_query("ALTER TABLE ".$prefix."_links_newlink ADD INDEX (sid)");
mysqli_query("ALTER TABLE ".$prefix."_links_votedata ADD INDEX (ratingdbid)");
mysqli_query("ALTER TABLE ".$prefix."_modules ADD INDEX (title)");
mysqli_query("ALTER TABLE ".$prefix."_modules ADD INDEX (custom_title)");
mysqli_query("ALTER TABLE ".$prefix."_pages ADD INDEX (pid)");
mysqli_query("ALTER TABLE ".$prefix."_pages ADD INDEX (cid)");
mysqli_query("ALTER TABLE ".$prefix."_pages_categories ADD INDEX (cid)");
mysqli_query("ALTER TABLE ".$prefix."_poll_desc ADD INDEX (pollID)");
mysqli_query("ALTER TABLE ".$prefix."_pollcomments ADD INDEX (tid)");
mysqli_query("ALTER TABLE ".$prefix."_pollcomments ADD INDEX (pid)");
mysqli_query("ALTER TABLE ".$prefix."_pollcomments ADD INDEX (pollID)");
mysqli_query("ALTER TABLE ".$prefix."_popsettings ADD INDEX (id)");
mysqli_query("ALTER TABLE ".$prefix."_popsettings ADD INDEX (uid)");
mysqli_query("ALTER TABLE ".$prefix."_posts ADD INDEX (post_id)");
mysqli_query("ALTER TABLE ".$prefix."_posts ADD INDEX (topic_id)");
mysqli_query("ALTER TABLE ".$prefix."_posts ADD INDEX (forum_id)");
mysqli_query("ALTER TABLE ".$prefix."_posts ADD INDEX (poster_id)");
mysqli_query("ALTER TABLE ".$prefix."_posts_text ADD INDEX (post_id)");
mysqli_query("ALTER TABLE ".$prefix."_priv_msgs ADD INDEX (from_userid)");
mysqli_query("ALTER TABLE ".$prefix."_public_messages ADD INDEX (mid)");
mysqli_query("ALTER TABLE ".$prefix."_queue ADD INDEX (qid)");
mysqli_query("ALTER TABLE ".$prefix."_queue ADD INDEX (uid)");
mysqli_query("ALTER TABLE ".$prefix."_queue ADD INDEX (uname)");
mysqli_query("ALTER TABLE ".$prefix."_quotes ADD INDEX (qid)");
mysqli_query("ALTER TABLE ".$prefix."_referer ADD INDEX (rid)");
mysqli_query("ALTER TABLE ".$prefix."_related ADD INDEX (rid)");
mysqli_query("ALTER TABLE ".$prefix."_related ADD INDEX (tid)");
mysqli_query("ALTER TABLE ".$prefix."_reviews ADD INDEX (id)");
mysqli_query("ALTER TABLE ".$prefix."_reviews_add ADD INDEX (id)");
mysqli_query("ALTER TABLE ".$prefix."_reviews_comments ADD INDEX (cid)");
mysqli_query("ALTER TABLE ".$prefix."_reviews_comments ADD INDEX (rid)");
mysqli_query("ALTER TABLE ".$prefix."_reviews_comments ADD INDEX (userid)");
mysqli_query("ALTER TABLE ".$prefix."_seccont ADD INDEX (artid)");
mysqli_query("ALTER TABLE ".$prefix."_seccont ADD INDEX (secid)");
mysqli_query("ALTER TABLE ".$prefix."_sections ADD INDEX (secid)");
mysqli_query("ALTER TABLE ".$prefix."_session ADD INDEX (time)");
mysqli_query("ALTER TABLE ".$prefix."_session ADD INDEX (guest)");
mysqli_query("ALTER TABLE ".$prefix."_smiles ADD INDEX (id)");
mysqli_query("ALTER TABLE ".$prefix."_stories ADD INDEX (sid)");
mysqli_query("ALTER TABLE ".$prefix."_stories ADD INDEX (catid)");
mysqli_query("ALTER TABLE ".$prefix."_stories_cat ADD INDEX (catid)");
mysqli_query("ALTER TABLE ".$prefix."_topics ADD INDEX (topicid)");
mysqli_query("ALTER TABLE ".$user_prefix."_users ADD INDEX (uid)");
mysqli_query("ALTER TABLE ".$user_prefix."_users ADD INDEX (uname)");
mysqli_query("ALTER TABLE ".$prefix."_words ADD INDEX (word_id)");

echo "PHP-Nuke Update finished!<br><br>"
    ."<b>NOTE:</b> ALL config.php variables has been moved to the database "
    ."in a new table called $prefix_config and you can change any value from "
    ."\"Settings\" section of Administration Menu.<br><br>NOW, please replace "
    ."your config.php with the included condif.php in this release. It's all. Enjoy!";

?>