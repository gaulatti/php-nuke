<?php

######################################################
# File to upgrade from PHP-Nuke 6.5 to PHP-Nuke 6.6
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

// Stories Table Alteration
$db->sql_query("ALTER TABLE ".$prefix."_stories ADD associated TEXT NOT NULL");
$db->sql_query("ALTER TABLE ".$prefix."_autonews ADD associated TEXT NOT NULL");

// PHP-Nuke Version Number Update
$db->sql_query("UPDATE ".$prefix."_config SET Version_Num='6.6'");

echo "PHP-Nuke Update finished!<br><br>"
    ."You should now delete this upgrade file from your server.";

?>
