<?php

######################################################
# File to upgrade from PHP-Nuke 6.9 to PHP-Nuke 7.0
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

// Users Groups Table Creation
$db->sql_query("CREATE TABLE ".$prefix."_groups (id INT( 10 ) DEFAULT '0' AUTO_INCREMENT, name VARCHAR( 255 ) NOT NULL , description TEXT NOT NULL , points INT( 10 ) DEFAULT '0' NOT NULL , INDEX ( id ))");

// Users Groups Points System Table Creation
$db->sql_query("CREATE TABLE ".$prefix."_groups_points (id INT( 10 ) DEFAULT '0'AUTO_INCREMENT, points INT( 10 ) DEFAULT '0' NOT NULL , INDEX ( id ))");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('1', '0')");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('2', '0')");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('3', '0')");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('4', '0')");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('5', '0')");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('6', '0')");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('7', '0')");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('8', '0')");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('9', '0')");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('10', '0')");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('11', '0')");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('12', '0')");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('13', '0')");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('14', '0')");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('15', '0')");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('16', '0')");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('17', '0')");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('18', '0')");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('19', '0')");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('20', '0')");
$db->sql_query("INSERT INTO ".$prefix."_groups_points VALUES ('21', '0')");

// Modules Table Alteration
$db->sql_query("ALTER TABLE ".$prefix."_modules ADD mod_group INT(10) DEFAULT '0'");

// Users Table Alteration
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD points INT(10) DEFAULT '0'");

// Forums Upgrade
$db->sql_query("CREATE TABLE ".$prefix."_bbconfirm (confirm_id char(32) DEFAULT NOT NULL, session_id char(32) DEFAULT NOT NULL, code char(6) DEFAULT NOT NULL, PRIMARY KEY (session_id, confirm_id))'");
$db->sql_query("ALTER TABLE ".$prefix."_bbbanlist ADD ban_time int(11) default NULL");
$db->sql_query("ALTER TABLE ".$prefix."_bbbanlist ADD ban_expire_time int(11) default NULL");
$db->sql_query("ALTER TABLE ".$prefix."_bbbanlist ADD ban_by_userid mediumint(8) default NULL");
$db->sql_query("ALTER TABLE ".$prefix."_bbbanlist ADD ban_priv_reason text");
$db->sql_query("ALTER TABLE ".$prefix."_bbbanlist ADD ban_pub_reason_mode tinyint(1) default NULL");
$db->sql_query("ALTER TABLE ".$prefix."_bbbanlist ADD ban_pub_reason text");
$db->sql_query("UPDATE ".$prefix."_bbconfig SET config_value='.0.6' where config_name='version'");
$db->sql_query("UPDATE ".$prefix."_bbconfig SET config_value='3600' where config_name='session_length'");

// Table fix
$db->sql_query("ALTER TABLE confirm RENAME ".$prefix."_confirm");

// Blocks Table Alteration
$db->sql_query("ALTER TABLE ".$prefix."_blocks ADD expire VARCHAR( 14 ) DEFAULT '0' NOT NULL");
$db->sql_query("ALTER TABLE ".$prefix."_blocks ADD action VARCHAR( 1 ) NOT NULL");

// PHP-Nuke Version Number Update
$db->sql_query("UPDATE ".$prefix."_config SET Version_Num='7.0'");

echo "PHP-Nuke Update finished!<br><br>"
    ."You should now delete this upgrade file from your server.<br><br>";
?>
