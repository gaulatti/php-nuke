<?php

######################################################
# File to upgrade from PHP-Nuke 6.6 to PHP-Nuke 6.7
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

// PHP-Nuke Forums Update
$db->sql_query("UPDATE ".$prefix."_bbconfig SET config_value='.0.4' where config_name='version'");
$db->sql_query("UPDATE ".$prefix."_bbconfig SET config_value='3600' where config_name='session_length'");

// PHP-Nuke Version Number Update
$db->sql_query("UPDATE ".$prefix."_config SET Version_Num='6.7'");

echo "PHP-Nuke Update finished!<br><br>"
    ."You should now delete this upgrade file from your server.";

?>