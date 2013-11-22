<?php

######################################################
# File to upgrade from PHP-Nuke 6.8 to PHP-Nuke 6.9
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
$db->sql_query("UPDATE ".$prefix."_config SET Version_Num='6.9'");

echo "PHP-Nuke Step 1 Update finished!<br><br>"
    ."You should now delete this upgrade file from your server.<br><br>"
    ."<b>IMPORTANT ANNOUNCE:</b><br>"
    ."Is VERY IMPORTANT that you now upgrade the FORUMS Module by clicking <a href=\"modules.php?name=Forums&file=update_to_205\">HERE</a>, "
    ."this process is now separated from the core upgrade. After the update you can safely delete the file "
    ."<i>/modules/Forums/update_to_205.php</i><br><br>"
    ."That file will upgrade Forums, Private Messages and Members List modules...";
?>