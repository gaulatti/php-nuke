<?php

#####################################################
# File to upgrade from PHP-Nuke 5.4 to PHP-Nuke 5.5
# After you used this file, you can safely delete it.
# Change the parameters to fit your info:
#####################################################

$host 		= "localhost";
$database 	= "nuke";
$username 	= "root";
$password 	= "";
$prefix 	= "nuke";
$user_prefix	= "nuke";

mysqli_connect($host, $username, $password);
@mysqli_select_db($database);

####################### BEGIN THE UPDATE #######################################

// New Main Table creation
mysqli_query("CREATE TABLE ".$prefix."_main (main_module VARCHAR(255) NOT NULL)");
mysqli_query("INSERT INTO ".$prefix."_main (main_module) VALUES ('News')");

// Modules Table Alteration
mysqli_query("INSERT INTO ".$prefix."_modules VALUES (NULL, 'News', '', 1, 0)");
mysqli_query("INSERT INTO ".$prefix."_modules VALUES (NULL, 'Your_Account', '', 1, 0)");
mysqli_query("INSERT INTO ".$prefix."_modules VALUES (NULL, 'Surveys', '', 1, 0)");
mysqli_query("INSERT INTO ".$prefix."_modules VALUES (NULL, 'Statistics', '', 1, 0)");
mysqli_query("INSERT INTO ".$prefix."_modules VALUES (NULL, 'Top', '', 1, 0)");
mysqli_query("INSERT INTO ".$prefix."_modules VALUES (NULL, 'Topics', '', 1, 0)");
mysqli_query("INSERT INTO ".$prefix."_modules VALUES (NULL, 'Search', '', 1, 0)");
mysqli_query("INSERT INTO ".$prefix."_modules VALUES (NULL, 'Submit_News', '', 1, 0)");
mysqli_query("INSERT INTO ".$prefix."_modules VALUES (NULL, 'Recommend_Us', '', 1, 0)");
mysqli_query("INSERT INTO ".$prefix."_modules VALUES (NULL, 'Private_Messages', '', 1, 0)");

// Downloads Table Alteration - categories reconstruction by simplywebdesign.com  20-01-2002
mysqli_query("ALTER TABLE ".$prefix."_downloads_categories ADD parentid TINYINT(11) DEFAULT '0' NOT NULL");
$result = mysqli_query("select sid,cid, title from ".$prefix."_downloads_subcategories order by sid");
while(list($sid,$cid, $title) = mysqli_fetch_row($result)) {
    mysqli_query("insert into ".$prefix."_downloads_categories values (NULL, '$title', '', '$cid')");
    $get_last_added = mysqli_query("select max(cid) last_added_cat from ".$prefix."_downloads_categories");
    while(list($last_added_cat) = mysqli_fetch_row($get_last_added)) {
        $downloads_to_update = mysqli_query("select lid from ".$prefix."_downloads_downloads where sid = $sid");
        while(list($lid) = mysqli_fetch_row($downloads_to_update)) {
            $q = "update ".$prefix."_downloads_downloads set cid = ".$last_added_cat." where lid= ". $lid."";
            mysqli_query($q);
	}
    }
}
mysqli_query("DROP TABLE ".$prefix."_downloads_subcategories");

// Content Pages Categories Table Creation
mysqli_query("CREATE TABLE ".$prefix."_pages_categories (cid INT(10) DEFAULT '0' AUTO_INCREMENT, title VARCHAR(255) NOT NULL, description TEXT NOT NULL , PRIMARY KEY (cid))");
mysqli_query("ALTER TABLE ".$prefix."_pages ADD cid INT(10) DEFAULT '0' NOT NULL AFTER pid");

// Session Table Alteration
mysqli_query("ALTER TABLE ".$prefix."_session CHANGE host_addr host_addr VARCHAR(48) NOT NULL");

// Statistics Table Creation
mysqli_query("CREATE TABLE nuke_stats_date (year smallint(6) NOT NULL default '0', month tinyint(4) NOT NULL default '0', date tinyint(4) NOT NULL default '0', hits bigint(20) NOT NULL default '0')");
mysqli_query("CREATE TABLE nuke_stats_hour (year smallint(6) NOT NULL default '0', month tinyint(4) NOT NULL default '0', date tinyint(4) NOT NULL default '0', hour tinyint(4) NOT NULL default '0', hits int(11) NOT NULL default '0')");
mysqli_query("CREATE TABLE nuke_stats_month (year smallint(6) NOT NULL default '0', month tinyint(4) NOT NULL default '0', hits bigint(20) NOT NULL default '0')");
mysqli_query("CREATE TABLE nuke_stats_year (year smallint(6) NOT NULL default '0', hits bigint(20) NOT NULL default '0')");

// Authors and Users Table Alteration
mysqli_query("ALTER TABLE ".$prefix."_authors CHANGE aid aid VARCHAR(25) NOT NULL");
mysqli_query("ALTER TABLE ".$prefix."_authors CHANGE url url VARCHAR(255) NOT NULL");
mysqli_query("ALTER TABLE ".$prefix."_authors CHANGE email email VARCHAR(255) NOT NULL");
mysqli_query("ALTER TABLE ".$user_prefix."_users CHANGE email email VARCHAR(255) NOT NULL");
mysqli_query("ALTER TABLE ".$user_prefix."_users CHANGE femail femail VARCHAR(255) NOT NULL");
mysqli_query("ALTER TABLE ".$user_prefix."_users CHANGE url url VARCHAR(255) NOT NULL");

// Repair the Encyclopedia table (an error I had... Almost always I know what I do)
@mysqli_query("ALTER TABLE ".$prefix."_encyclopedia CHANGE clanguage elanguage VARCHAR(30) NOT NULL");

// Downloads & Links Table Alteration
mysqli_query("ALTER TABLE ".$prefix."_downloads_categories CHANGE parentid parentid INT(11) NOT NULL");
mysqli_query("ALTER TABLE ".$prefix."_links_categories CHANGE parentid parentid INT(11) NOT NULL");

// Stories Table Alteration
mysqli_query("ALTER TABLE ".$prefix."_stories ADD score INT(10) DEFAULT '0' NOT NULL");
mysqli_query("ALTER TABLE ".$prefix."_stories ADD ratings INT(10) DEFAULT '0' NOT NULL");

echo "PHP-Nuke Update finished!";

?>