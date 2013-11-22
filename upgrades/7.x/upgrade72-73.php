<?php

######################################################
# File to upgrade from PHP-Nuke 7.2 to PHP-Nuke 7.3
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

// Forums Table Modification
$db->sql_query("UPDATE ".$prefix."_bbconfig SET config_value='.0.8' WHERE config_name='version'");

// PHP-Nuke Version Number Update
$db->sql_query("UPDATE ".$prefix."_config SET Version_Num='7.3'");

echo "PHP-Nuke Update finished!<br><br>"
    ."You should now delete this upgrade file from your server.<br><br>";
?>