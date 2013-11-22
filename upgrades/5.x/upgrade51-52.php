<?php

#####################################################
# File to upgrade from PHP-Nuke 5.1 to PHP-Nuke 5.2
# After you used this file, you can safely delete it.
# Change the parameters to fit your info:
#####################################################

$host 		= "localhost";
$database 	= "nuke";
$username 	= "root";
$password 	= "";
$prefix 	= "nuke"; /* Your database table's prefix */

mysql_connect($host, $username, $password);
@mysql_select_db($database);

####################### BEGIN THE UPDATE #######################################

// Stories Table Alteration
mysql_query("ALTER TABLE ".$prefix."_stories ADD haspoll INT (1) DEFAULT '0' not null ");
mysql_query("ALTER TABLE ".$prefix."_stories ADD pollID INT (10) DEFAULT '0' not null ");
mysql_query("ALTER TABLE ".$prefix."_queue ADD storyext TEXT not null AFTER story");


// Polls Table Alteration
mysql_query("ALTER TABLE ".$prefix."_poll_desc ADD artid INT (10) DEFAULT '0' not null ");
mysql_query("ALTER TABLE ".$prefix."_poll_check ADD pollID INT (10) DEFAULT '0' not null ");


echo "PHP-Nuke 5.2 update finished<br><br>";
echo "Thanks for your interest...<br>";
echo "Don't forget to copy and replace all the scripts!<br>";

?>
