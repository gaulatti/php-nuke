<?php

######################################################
# File to upgrade from PHP-Nuke 7.5 to PHP-Nuke 7.6
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

// Counter Table Alteration to add FireFox Support
$db->sql_query("INSERT INTO ".$prefix."_counter (type, var, count) VALUES ('browser', 'FireFox', '0')");

// PHP-Nuke copyright notice modification to be GPL 2(c) section compliant.
$db->sql_query("UPDATE ".$prefix."_config SET copyright='PHP-Nuke Copyright &copy; 2005 by Francisco Burzi. This is free software, and you may redistribute it under the <a rel=\"nofollow\" href=\"http://phpnuke.org/files/gpl.txt\">GPL</a>. PHP-Nuke comes with absolutely no warranty, for details, see the <a rel=\"nofollow\" href=\"http://phpnuke.org/files/gpl.txt\">license</a>.'");

// PHP-Nuke Version Number Update
$db->sql_query("UPDATE ".$prefix."_config SET Version_Num='7.6'");

echo "PHP-Nuke Update finished!<br><br>"
    ."You should now delete this upgrade file from your server.<br><br>";
?>
