<?php

######################################################
# File to upgrade from PHP-Nuke 7.9 to PHP-Nuke 8.0
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

// AntiFlood Table Creation
$db->sql_query("CREATE TABLE ".$prefix."_antiflood (ip_addr VARCHAR( 48 ) NOT NULL , time VARCHAR( 14 ) NOT NULL , INDEX ( ip_addr , time ))");

// PHP-Nuke Version Number Update
$db->sql_query("UPDATE ".$prefix."_config SET Version_Num='8.0'");

// BBtoNuke Forums Tables Alteration
$db->sql_query("ALTER TABLE  ".$prefix."_bbsearch_results ADD COLUMN search_time int(11) DEFAULT '0' NOT NULL");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig  (config_name, config_value) VALUES ('search_flood_interval', '15')");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig  (config_name, config_value) VALUES ('rand_seed', '0')");
$db->sql_query("UPDATE ".$prefix."_bbconfig SET config_value='.0.20' where config_name='version'");

echo "PHP-Nuke Update finished!<br><br>"
    ."You should now delete this upgrade file from your server.<br><br>";
?>