<?php

######################################################
# File to upgrade from PHP-Nuke 6.7 to PHP-Nuke 6.8
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

// PHP-Nuke Version Number Update
$db->sql_query("UPDATE ".$prefix."_config SET Version_Num='6.8'");

echo "PHP-Nuke Update finished!<br><br>"
    ."You should now delete this upgrade file from your server.<br><br>"
    ."<b>IMPORTANT ANNOUNCE:</b><br>"
    ."PHP-Nuke now includes XDMP Service Client, which is "
    ."an innovative service that, after a very simple configuration, will "
    ."automaticaly retrieve and publish news for your site <b>without any "
    ."human intervention!</b>. You can access XDMP Client from <a href=\"modules/News/xdmp.php\">HERE</a> "
    ."after you're logged as administrator of your system. To know more "
    ."about this great service just visit XDMP website at <a href=\"http://xdmp.com\" target=\"new\">XDMP.com</a>";
?>