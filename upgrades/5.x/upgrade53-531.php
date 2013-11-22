<?php

#####################################################
# File to upgrade from PHP-Nuke 5.3 to PHP-Nuke 5.3.1
# After you used this file, you can safely delete it.
# Change the parameters to fit your info:
#####################################################

$host 		= "localhost";
$database 	= "nuke";
$username 	= "root";
$password 	= "";
$prefix 	= "nuke";
$user_prefix	= "nuke";

mysql_connect($host, $username, $password);
@mysql_select_db($database);

####################### BEGIN THE UPDATE #######################################

// User's Table Alteration (Add Newsletter field)
mysql_query("ALTER TABLE ".$user_prefix."_users ADD newsletter INT (1) DEFAULT '0' not null ");

// Author's Table Alteration (Add Newsletter field)
mysql_query("ALTER TABLE ".$prefix."_authors ADD radminnewsletter TINYINT(2) DEFAULT '0' NOT NULL AFTER radminreviews");

echo "PHP-Nuke Update finished!";

?>
