<?php

# File to upgrade PHP-Nuke from 2.0x to 2.5
# After use this, you can delete it

$host       = "localhost";
$database   = "nuke";
$username   = "root";
$password   = "";
 
mysql_connect($host, $username, $password);
     @mysql_select_db($database);

//*********************************************

$result = mysql_query("CREATE TABLE pollcomments (tid int(11) DEFAULT '0' NOT NULL auto_increment, pid int(11) DEFAULT '0', pollID int(11) DEFAULT '0', date datetime, name varchar(60) DEFAULT '' NOT NULL, email varchar(60), url varchar(60), host_name varchar(60), subject varchar(60) DEFAULT '' NOT NULL, comment text NOT NULL, score tinyint(4) DEFAULT '0' NOT NULL, reason tinyint(4) DEFAULT '0' NOT NULL, PRIMARY KEY (tid))");
if (!$result) { 
    echo "Creation of pollcomments table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}
echo "PHP-Nuke Tables Updated, Ok...";
?>
