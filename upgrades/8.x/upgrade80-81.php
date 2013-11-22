<?php

######################################################
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
global $prefix, $db;

// Forums Table Update
$db->sql_query("UPDATE ".$prefix."_bbconfig SET config_value='.0.21' where config_name='version'");
$db->sql_query("INSERT INTO ".$prefix."_bbconfig (config_name, config_value) VALUES ('search_min_chars', '3')");
$db->sql_query("DELETE FROM ".$prefix."_bbsessions");

// Config Table Alteration
$db->sql_query("ALTER TABLE ".$prefix."_config ADD overwrite_theme TINYINT( 1 ) NOT NULL DEFAULT '1' AFTER Default_Theme");
$db->sql_query("ALTER TABLE ".$prefix."_config ADD httprefmode TINYINT( 1 ) NOT NULL DEFAULT '1' AFTER httprefmax");
$db->sql_query("ALTER TABLE ".$prefix."_config ADD gfx_chk TINYINT( 1 ) NOT NULL DEFAULT '0'");
$db->sql_query("ALTER TABLE ".$prefix."_config ADD nuke_editor TINYINT( 1 ) NOT NULL DEFAULT '1'");
$db->sql_query("ALTER TABLE ".$prefix."_config ADD display_errors TINYINT( 1 ) NOT NULL DEFAULT '0'");

// AutoTheme module creation
$db->sql_query("INSERT INTO ".$prefix."_modules (mid, title, custom_title, active, view, inmenu, mod_group, admins) VALUES (NULL, 'AutoTheme', 'AutoTheme', '1', '0', '1', '0', '')");


// PHP-Nuke Version Number Update
$db->sql_query("UPDATE ".$prefix."_config SET Version_Num='8.1'");

echo "PHP-Nuke Update finished!<br><br>"
    ."You should now delete this upgrade file from your server.<br><br>";

?>