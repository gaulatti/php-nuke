<?php

# File to upgrade PHP-Nuke from 2.5 to 3.5
# After use this, you can delete it

$host       = "localhost";
$database   = "nuke";
$username   = "root";
$password   = "";
 
mysql_connect($host, $username, $password);
     @mysql_select_db($database);

//***********************************************

$result = mysql_query("CREATE TABLE ephem (eid int(11) DEFAULT '0' NOT NULL auto_increment, did int(2) DEFAULT '0' NOT NULL, mid int(2) DEFAULT '0' NOT NULL, yid int(4) DEFAULT '0' NOT NULL, content text NOT NULL, PRIMARY KEY (eid))");
if (!$result) { 
    echo "Creation of ephem table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}

$result = mysql_query("ALTER TABLE stories DROP hits");
if (!$result) { 
    echo "Alteration of stories table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}

$result = mysql_query("ALTER TABLE stories CHANGE introtext hometext text");
if (!$result) { 
    echo "Alteration of stories table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}

$result = mysql_query("ALTER TABLE stories CHANGE fulltext bodytext text");
if (!$result) { 
    echo "Alteration of stories table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}

echo "PHP-Nuke Tables Updated, Ok...";
?>
