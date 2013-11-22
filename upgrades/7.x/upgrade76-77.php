<?php

######################################################
# File to upgrade from PHP-Nuke 7.6 to PHP-Nuke 7.7
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

// Table creation and alteration for Moderated Comments to add the karma system
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD karma TINYINT( 1 ) DEFAULT '0'");
$db->sql_query("ALTER TABLE ".$prefix."_users ADD INDEX ( karma )");
$db->sql_query("CREATE TABLE ".$prefix."_comments_moderated (tid int( 11 ) NOT NULL auto_increment, pid int( 11 ) NOT NULL default '0', sid int( 11 ) NOT NULL default '0', date datetime default NULL , name varchar( 60 ) NOT NULL default '', email varchar( 60 ) default NULL , url varchar( 60 ) default NULL , host_name varchar( 60 ) default NULL , subject varchar( 85 ) NOT NULL default '', comment text NOT NULL , score tinyint( 4 ) NOT NULL default '0', reason tinyint( 4 ) NOT NULL default '0', last_moderation_ip varchar( 15 ) default '0', PRIMARY KEY ( tid ) , KEY tid ( tid ) , KEY pid ( pid ) , KEY sid ( sid ))");
$db->sql_query("CREATE TABLE ".$prefix."_pollcomments_moderated (tid int( 11 ) NOT NULL auto_increment, pid int( 11 ) NOT NULL default '0', pollID int( 11 ) NOT NULL default '0', date datetime default NULL , name varchar( 60 ) NOT NULL default '', email varchar( 60 ) default NULL , url varchar( 60 ) default NULL , host_name varchar( 60 ) default NULL , subject varchar( 60 ) NOT NULL default '', comment text NOT NULL , score tinyint( 4 ) NOT NULL default '0', reason tinyint( 4 ) NOT NULL default '0', last_moderation_ip varchar( 15 ) default '0', PRIMARY KEY ( tid ) , KEY tid ( tid ) , KEY pid ( pid ) , KEY pollID ( pollID ))");
$db->sql_query("CREATE TABLE ".$prefix."_reviews_comments_moderated (cid int( 10 ) NOT NULL auto_increment, rid int( 10 ) NOT NULL default '0', userid varchar( 25 )  NOT NULL default '', date datetime default NULL , comments text, score int( 10 ) NOT NULL default '0', PRIMARY KEY ( cid ) , KEY cid ( cid ) , KEY rid ( rid ) , KEY userid ( userid ))");

// News Comments table alteration for moderation system
$db->sql_query("ALTER TABLE ".$prefix."_comments ADD last_moderation_ip VARCHAR( 15 ) DEFAULT '0'");

// Surveys Comments table alteration for moderation system
$db->sql_query("ALTER TABLE ".$prefix."_pollcomments ADD last_moderation_ip VARCHAR( 15 ) DEFAULT '0'");
$db->sql_query("ALTER TABLE ".$prefix."_poll_desc ADD comments INT( 11 ) DEFAULT '0'");

// Articles rating system update
$db->sql_query("ALTER TABLE ".$prefix."_stories ADD rating_ip VARCHAR( 15 ) DEFAULT '0' AFTER ratings");

// Topic image field length increased
$db->sql_query("ALTER TABLE ".$prefix."_topics CHANGE topicimage topicimage VARCHAR(100) NOT NULL");

// Forums Table Update
$db->sql_query("UPDATE ".$prefix."_bbconfig SET config_value='.0.14' where config_name='version'");

// PHP-Nuke copyright notice modification. (c) year changed.
$db->sql_query("UPDATE ".$prefix."_config SET copyright='<a rel=\"nofollow\" href=\"http://phpnuke.org\"><font class=\"footmsg_l\">PHP-Nuke</font></a> Copyright &copy; 2005 by Francisco Burzi. This is free software, and you may redistribute it under the <a rel=\"nofollow\" href=\"http://phpnuke.org/files/gpl.txt\"><font class=\"footmsg_l\">GPL</font></a>. PHP-Nuke comes with absolutely no warranty, for details, see the <a rel=\"nofollow\" href=\"http://phpnuke.org/files/gpl.txt\"><font class=\"footmsg_l\">license</font></a>.'");

// PHP-Nuke Version Number Update
$db->sql_query("UPDATE ".$prefix."_config SET Version_Num='7.7'");


echo "PHP-Nuke Update finished!<br><br>"
    ."You should now delete this upgrade file from your server.<br><br>";
?>
