<?php

######################################################
# File to upgrade from PHP-Nuke 7.4 to PHP-Nuke 7.5
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

// Modules Table Update
$db->sql_query("ALTER TABLE nuke_modules ADD admins VARCHAR( 255 ) NOT NULL");

// Administrators Table modification
$db->sql_query("ALTER TABLE nuke_authors DROP radminarticle, DROP radmintopic, DROP radminuser, DROP radminsurvey, DROP radminlink , DROP radminfaq, DROP radmindownload, DROP radminreviews, DROP radminnewsletter, DROP radminforum, DROP radmincontent, DROP radminency");
$db->sql_query("ALTER TABLE nuke_authors CHANGE radminsuper radminsuper TINYINT( 1 ) DEFAULT '1' NOT NULL");

// PHP-Nuke Version Number Update
$db->sql_query("UPDATE ".$prefix."_config SET Version_Num='7.5'");

echo "PHP-Nuke Update finished!<br><br>"
    ."Please note that if you had more than one administrator on your system, "
    ."you need to reasing all of them to the right modules. This upgrade didn't make "
    ."the change for you for practical reasons, anyway it should not take long time. Thanks "
    ."for understanding and sorry for this inconvenient...<br><br>"
    ."You should now delete this upgrade file from your server.<br><br>";
?>