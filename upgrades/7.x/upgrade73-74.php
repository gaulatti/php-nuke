<?php

######################################################
# File to upgrade from PHP-Nuke 7.3 to PHP-Nuke 7.4
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

// Forums Table Update
$db->sql_query("UPDATE ".$prefix."_bbconfig SET config_value='.0.10' WHERE config_name='version'");

// IP Ban System Table Creation
$db->sql_query("CREATE TABLE ".$prefix."_banned_ip (id int(11) NOT NULL auto_increment, ip_address varchar(15) NOT NULL default '',  reason varchar(255) NOT NULL default '', date date NOT NULL default '0000-00-00', PRIMARY KEY id (id))");

// Users Table Modification
$db->sql_query("ALTER TABLE ".$user_prefix."_users ADD last_ip VARCHAR(15) DEFAULT '0' NOT NULL");

// PHP-Nuke Version Number Update
$db->sql_query("UPDATE ".$prefix."_config SET Version_Num='7.4'");

// Section to Content conversion
$result = $db->sql_query("SELECT secid, secname FROM ".$prefix."_sections");
while ($row = $db->sql_fetchrow($result)) {
	$db->sql_query("INSERT INTO ".$prefix."_pages_categories VALUES (NULL, '$row[secname]', '')");
}
$result = $db->sql_query("SELECT * FROM ".$prefix."_seccont");
while ($row = $db->sql_fetchrow($result)) {
	$sec_cont = addslashes(FixQuotes($row[content]));
	$row2 = $db->sql_fetchrow($db->sql_query("SELECT secname FROM ".$prefix."_sections WHERE secid='$row[secid]'"));
	$row3 = $db->sql_fetchrow($db->sql_query("SELECT cid FROM ".$prefix."_pages_categories WHERE title='$row2[secname]'"));
	$row[content]=ereg_replace('\'', "\'", $row[content]);  // by Marcus Maciel marcus@underlinux.com.br
	$db->sql_query("INSERT INTO ".$prefix."_pages VALUES (NULL, '$row3[cid]', '$row[title]', '', '1', '', '$row[content]', '', '', now(), '$row[counter]', '$row[slanguage]')");
}
$db->sql_query("DROP TABLE ".$prefix."_sections");
$db->sql_query("DROP TABLE ".$prefix."_seccont");
$db->sql_query("UPDATE ".$prefix."_modules SET active='0' WHERE title='Sections'");

// Ephemerids and Sections field removal from authors table
$db->sql_query("ALTER TABLE ".$prefix."_authors DROP radminsection, DROP radminephem");

echo "PHP-Nuke Update finished!<br><br>"
    ."Please note that SECTIONS modules has been removed on this version. All your data from Sections module has been moved to CONTENT Module.<br><br>"
    ."You should now delete this upgrade file from your server.<br><br>";
?>