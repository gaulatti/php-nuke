<?php

######################################################
# File to upgrade from PHP-Nuke 7.0 to PHP-Nuke 7.1
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

// Subscription Table Creation
$db->sql_query("CREATE TABLE ".$prefix."_subscriptions (id INT( 10 ) DEFAULT '0' AUTO_INCREMENT, userid INT( 10 ) DEFAULT '0', subscription_expire VARCHAR( 50 ) NOT NULL , INDEX ( id , userid ))");
$db->sql_query("ALTER TABLE ".$prefix."_blocks ADD subscription INT(1) DEFAULT '0' NOT NULL");

// PHP-Nuke Version Number Update
$db->sql_query("UPDATE ".$prefix."_config SET Version_Num='7.1'");

echo "PHP-Nuke Update finished!<br><br>"
    ."You should now delete this upgrade file from your server.<br><br>";
?>
