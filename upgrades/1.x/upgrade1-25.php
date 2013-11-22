<?php

# File to upgrade PHP-Nuke from 1.0 to 2.5
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
$result = mysql_query("CREATE TABLE links_categories (cid int(11) DEFAULT '0' NOT NULL auto_increment, title varchar(50) DEFAULT '' NOT NULL, PRIMARY KEY (cid))");
if (!$result) { 
    echo "Creation of links_categories table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}
$result = mysql_query("CREATE TABLE links_links (lid int(11) DEFAULT '0' NOT NULL auto_increment, cid int(11) DEFAULT '0' NOT NULL, sid int(11) DEFAULT '0' NOT NULL, title varchar(100) DEFAULT '' NOT NULL, url varchar(100) DEFAULT '' NOT NULL, description text NOT NULL, date datetime, name varchar(60) DEFAULT '' NOT NULL, email varchar(60) DEFAULT '' NOT NULL, hits int(11) DEFAULT '0' NOT NULL, PRIMARY KEY (lid))");
if (!$result) { 
    echo "Creation of links_links table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}
$result = mysql_query("CREATE TABLE links_newlink (lid int(11) DEFAULT '0' NOT NULL auto_increment, cid int(11) DEFAULT '0' NOT NULL, sid int(11) DEFAULT '0' NOT NULL, title varchar(100) DEFAULT '' NOT NULL, url varchar(100) DEFAULT '' NOT NULL, description text NOT NULL, name varchar(60) DEFAULT '' NOT NULL, email varchar(60) DEFAULT '' NOT NULL, PRIMARY KEY (lid))");
if (!$result) { 
    echo "Creation of links_newlink table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}
$result = mysql_query("CREATE TABLE links_subcategories (sid int(11) DEFAULT '0' NOT NULL auto_increment, cid int(11) DEFAULT '0' NOT NULL, title varchar(50) DEFAULT '' NOT NULL, PRIMARY KEY (sid))");
if (!$result) { 
    echo "Creation of links_subcategories table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}
$result = mysql_query("ALTER TABLE sections ADD image varchar(50) DEFAULT '' NOT NULL");
if (!$result) { 
    echo "Alteration of sections table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
} else {
    $result = mysql_query("select image from sections");
    while(list($image) = mysql_fetch_row($result)) {
	mysql_query("update sections set image='template.gif'");
    }
}
echo "PHP-Nuke Tables Updated, Ok...";
?>
