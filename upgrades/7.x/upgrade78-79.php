<?php

######################################################
# File to upgrade from PHP-Nuke 7.8 to PHP-Nuke 7.9
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

// Content pagebreak fix
$result = $db->sql_query("SELECT pid, text FROM ".$prefix."_pages");
while ($row = $db->sql_fetchrow($result)) {
	$row[text] = eregi_replace("<!--pagebreak-->", "[--pagebreak--]", $row[text]);
	$db->sql_query("UPDATE ".$prefix."_pages SET text='$row[text]' WHERE pid='$row[pid]'");
}

// Reviews pagebreak fix
$result = $db->sql_query("SELECT id, text FROM ".$prefix."_reviews");
while ($row = $db->sql_fetchrow($result)) {
	$row[text] = eregi_replace("<!--pagebreak-->", "[--pagebreak--]", $row[text]);
	$db->sql_query("UPDATE ".$prefix."_reviews SET text='$row[text]' WHERE id='$row[id]'");
}

// Encyclopedia pagebreak fix
$result = $db->sql_query("SELECT tid, text FROM ".$prefix."_encyclopedia_text");
while ($row = $db->sql_fetchrow($result)) {
	$row[text] = eregi_replace("<!--pagebreak-->", "[--pagebreak--]", $row[text]);
	$db->sql_query("UPDATE ".$prefix."_encyclopedia_text SET text='$row[text]' WHERE tid='$row[tid]'");
}

// Some fixes in the headlines sites
$fmurl = "http://rss.freshmeat.net/freshmeat/feeds/fm-releases-global";
$db->sql_query("UPDATE ".$prefix."_headlines SET headlinesurl='$fmurl' WHERE sitename='Freshmeat'");

// Forums Table update
$db->sql_query("ALTER TABLE ".$prefix."_bbsessions ADD session_admin tinyint(2) NOT NULL default '0'");
$db->sql_query("UPDATE ".$prefix."_bbconfig SET config_value='.0.17' where config_name='version'");

// PHP-Nuke Version Number Update
$db->sql_query("UPDATE ".$prefix."_config SET Version_Num='7.9'");

echo "PHP-Nuke Update finished!<br><br>"
    ."You should now delete this upgrade file from your server.<br><br>";
?>