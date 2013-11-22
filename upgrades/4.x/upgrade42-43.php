<?php

# File to upgrade PHP-Nuke from 4.1/4.2 to 4.3
# After use this file, you can safely delete it
# Change the parameters to fit your info:

$host 		= "localhost";
$database 	= "nuke";
$username 	= "root";
$password 	= "";

mysql_connect($host, $username, $password);
@mysql_select_db($database);

//************************************************************


$result = mysql_query("ALTER TABLE links_categories ADD cdescription TEXT not null");
if (!$result) { 
    echo "Alteration of links_categories table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}

$result = mysql_query("CREATE TABLE links_editorials (linkid INT (11) DEFAULT '0' not null , adminid VARCHAR (60) not null , editorialtimestamp DATETIME not null , editorialtext TEXT not null , editorialtitle VARCHAR (100) not null , PRIMARY KEY (linkid))");
if (!$result) { 
    echo "Creation of links_editorials table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}

$result = mysql_query("ALTER TABLE links_links ADD submitter VARCHAR (60) not null , ADD linkratingsummary DOUBLE (6,4) DEFAULT '0.0000' not null , ADD totalvotes INT (11) DEFAULT '0' not null , ADD totalcomments INT (11) DEFAULT '0' not null");
if (!$result) { 
    echo "Alteration of links_links table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}

$result = mysql_query("CREATE TABLE links_modrequest (requestid INT (11) DEFAULT '0' not null AUTO_INCREMENT, lid INT (11) DEFAULT '0' not null , cid INT (11) DEFAULT '0' not null , sid INT (11) DEFAULT '0' not null , title VARCHAR (100) not null , url VARCHAR (100) not null , description TEXT not null , modifysubmitter VARCHAR (60) not null , brokenlink INT (3) DEFAULT '0' not null , PRIMARY KEY (requestid), UNIQUE (requestid))");
if (!$result) { 
    echo "Creation of links_modrequest table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}

$result = mysql_query("ALTER TABLE links_newlink ADD submitter VARCHAR (60) not null");
if (!$result) { 
    echo "Alteration of links_newlink table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}

$result = mysql_query("CREATE TABLE links_votedata (ratingdbid INT (11) DEFAULT '0' not null AUTO_INCREMENT, ratinglid INT (11) DEFAULT '0' not null , ratinguser VARCHAR (60) not null , rating INT (11) not null , ratinghostname VARCHAR (60) not null , ratingcomments TEXT not null , ratingtimestamp DATETIME not null , PRIMARY KEY (ratingdbid))");
if (!$result) { 
    echo "Creation of links_votedata table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}

$result = mysql_query("CREATE TABLE session (username VARCHAR (25) not null , time VARCHAR (14) not null , host_addr VARCHAR (20) not null , guest INT (1) not null )"); 
if (!$result) { 
    echo "Creation of session table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}

$result = mysql_query("ALTER TABLE stories CHANGE topic topic INT (3) DEFAULT '1' not null");
if (!$result) { 
    echo "Alteration of stories table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}

$result = mysql_query("CREATE TABLE autonews (anid INT (11) DEFAULT '0' not null AUTO_INCREMENT, aid VARCHAR (30) not null , title VARCHAR (80) not null , time VARCHAR (19) not null , hometext TEXT not null , bodytext TEXT not null , topic INT (3) DEFAULT '1' not null , informant VARCHAR (20) not null , notes TEXT not null , PRIMARY KEY (anid))");
if (!$result) { 
    echo "Creation of autonews table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}

$result = mysql_query("ALTER TABLE authors 
      ADD radminarticle tinyint(2) DEFAULT '0' NOT NULL,
      ADD radmintopic tinyint(2) DEFAULT '0' NOT NULL,
      ADD radminleft tinyint(2) DEFAULT '0' NOT NULL,
      ADD radminright tinyint(2) DEFAULT '0' NOT NULL,
      ADD radminuser tinyint(2) DEFAULT '0' NOT NULL,
      ADD radminmain tinyint(2) DEFAULT '0' NOT NULL,
      ADD radminsurvey tinyint(2) DEFAULT '0' NOT NULL,
      ADD radminsection tinyint(2) DEFAULT '0' NOT NULL,
      ADD radminlink tinyint(2) DEFAULT '0' NOT NULL,
      ADD radminephem tinyint(2) DEFAULT '0' NOT NULL,
      ADD radminfilem tinyint(2) DEFAULT '0' NOT NULL,
      ADD radminhead tinyint(2) DEFAULT '0' NOT NULL,
      ADD radminsuper tinyint(2) DEFAULT '1' NOT NULL
   ");
if (!$result) { 
    echo "Alter of authors table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}

echo "PHP-Nuke Tables Updated, Ok...";
?>