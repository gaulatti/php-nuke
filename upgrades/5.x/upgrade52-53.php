<?php

#####################################################
# File to upgrade from PHP-Nuke 5.2 to PHP-Nuke 5.3
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

// Modules Table Creation
mysql_query("CREATE TABLE ".$prefix."_modules (mid INT (10) DEFAULT '0' null AUTO_INCREMENT, title VARCHAR (255) not null , active INT (1) DEFAULT '0' not null , view INT (1) DEFAULT '0' not null , PRIMARY KEY (mid), INDEX (mid))");

// Blocks Table Alteration
$bkey = "modules";
$title = "Modules";
$bkey2 = "ephem";
mysql_query("update ".$prefix."_blocks set title='$title', active='1' where bkey='$bkey2'");
mysql_query("update ".$prefix."_blocks set bkey='$bkey' where title='$title'");

echo "PHP-Nuke Update finished!";

?>