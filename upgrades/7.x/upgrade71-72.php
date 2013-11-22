<?php

######################################################
# File to upgrade from PHP-Nuke 7.1 to PHP-Nuke 7.2
# After you used this file, you can safely delete it.
######################################################
#            -= WARNING: PLEASE READ =-
#
# NOTE: This file uses config.php to retrieve needed
# variables values. So, to do the upgrade PLEASE copy
# this file in your server root directory and execute
# it from your browser.
#
# IMPORTANT: PHP-Nuke 7.2 doesn't support WebMail module
# anymore. If you still use this module just apply this
# upgrade as is, if you want to remove it proceed to
# delete /modules/WebMail folder and uncomment the two
# queries lines bellow (WebMail Table Remove).
######################################################

include("mainfile.php");

// Forums Table Modification
$db->sql_query("UPDATE ".$prefix."_bbconfig SET config_value='.0.7' WHERE config_name='version'");

// FAQ Tables Alteration
$db->sql_query("ALTER TABLE ".$prefix."_faqAnswer RENAME ".$prefix."_faqanswer");
$db->sql_query("ALTER TABLE ".$prefix."_faqCategories RENAME ".$prefix."_faqcategories");

// WebMail Table Remove
// IMPORTANT: UNCOMMENT THE FOLLOWING LINES TO REMOVE WEBMAIL MODULE TABLES
//$db->sql_query("DELETE TABLE ".$prefix."_popsettings");
//$db->sql_query("ALTER TABLE nuke_config DROP footermsgtxt, DROP email_send, DROP attachmentdir, DROP attachments, DROP attachments_view, DROP download_dir, DROP defaultpopserver, DROP singleaccount, DROP singleaccountname, DROP numaccounts, DROP imgpath, DROP filter_forward");

// PHP-Nuke Version Number Update
$db->sql_query("UPDATE ".$prefix."_config SET Version_Num='7.2'");

echo "PHP-Nuke Update finished!<br><br>"
    ."You should now delete this upgrade file from your server.<br><br>";
?>