<?php

#####################################################
# File to upgrade from PHP-Nuke 5.3.1 to PHP-Nuke 5.4
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

// Users Table Alteration to add forums support
mysql_query("ALTER TABLE ".$user_prefix."_users CHANGE pass pass VARCHAR(40) DEFAULT NULL");
mysql_query("ALTER TABLE ".$user_prefix."_users ADD user_posts INT(10) DEFAULT '0' NOT NULL, ADD user_attachsig INT(2) DEFAULT '0' NOT NULL, ADD user_rank INT(10) DEFAULT '0' NOT NULL, ADD user_level INT(10) DEFAULT '1' NOT NULL");

// Author's Table Alteration
mysql_query("ALTER TABLE ".$prefix."_authors ADD radminforum tinyint(2) DEFAULT '0' NOT NULL AFTER radminnewsletter");
mysql_query("ALTER TABLE ".$prefix."_authors ADD radmincontent tinyint(2) NOT NULL DEFAULT '0' AFTER radminforum");
mysql_query("ALTER TABLE ".$prefix."_authors ADD radminency tinyint(2) NOT NULL DEFAULT '0' AFTER radmincontent");
mysql_query("ALTER TABLE ".$prefix."_authors CHANGE pwd pwd VARCHAR(40) DEFAULT NULL");
$result = mysql_query("select aid, pwd from ".$prefix."_authors");
while (list($aid, $pwd) = mysql_fetch_row($result)) {
    $pwd = md5($pwd);
    mysql_query("update ".$prefix."_authors set pwd='$pwd' where aid='$aid'");
}
mysql_query("ALTER TABLE ".$prefix."_authors DROP radminfilem");

// Blocks Table Alteration
$result = mysql_query("select bid, bkey from ".$prefix."_blocks");
while (list($bid, $bkey) = mysql_fetch_row($result)) {
    if ($bkey == "online") {
	mysql_query("UPDATE ".$prefix."_blocks set bkey='', blockfile='block-Who_is_Online.php' where bid='$bid'");
    } elseif ($bkey == "poll") {
	mysql_query("UPDATE ".$prefix."_blocks set bkey='', blockfile='block-Survey.php' where bid='$bid'");
    } elseif ($bkey == "past") {
	mysql_query("UPDATE ".$prefix."_blocks set bkey='', blockfile='block-Old_Articles.php' where bid='$bid'");
    } elseif ($bkey == "big") {
	mysql_query("UPDATE ".$prefix."_blocks set bkey='', blockfile='block-Big_Story_of_Today.php' where bid='$bid'");
    } elseif ($bkey == "search") {
	mysql_query("UPDATE ".$prefix."_blocks set bkey='', blockfile='block-Search.php' where bid='$bid'");
    } elseif ($bkey == "random") {
	mysql_query("UPDATE ".$prefix."_blocks set bkey='', blockfile='block-Random_Headlines.php' where bid='$bid'");
    } elseif ($bkey == "thelang") {
	mysql_query("UPDATE ".$prefix."_blocks set bkey='', blockfile='block-Languages.php' where bid='$bid'");
    }
}

// New Table Creation
mysql_query("CREATE TABLE ".$prefix."_access (access_id int(10) NOT NULL auto_increment, access_title varchar(20) default NULL, PRIMARY KEY (access_id))");
mysql_query("INSERT INTO ".$prefix."_access VALUES ( '-1', 'Deleted')");
mysql_query("INSERT INTO ".$prefix."_access VALUES ( '1', 'User')");
mysql_query("INSERT INTO ".$prefix."_access VALUES ( '2', 'Moderator')");
mysql_query("INSERT INTO ".$prefix."_access VALUES ( '3', 'Super Moderator')");
mysql_query("INSERT INTO ".$prefix."_access VALUES ( '4', 'Administrator')");


// New Table Creation
mysql_query("CREATE TABLE ".$prefix."_banlist (ban_id int(10) NOT NULL auto_increment, ban_userid int(10) default NULL, ban_ip varchar(16) default NULL, ban_start int(32) default NULL, ban_end int(50) default NULL, ban_time_type int(10) default NULL, PRIMARY KEY  (ban_id), KEY ban_id (ban_id))");

// New Table Creation
mysql_query("CREATE TABLE ".$prefix."_bbtopics (topic_id int(10) NOT NULL auto_increment, topic_title varchar(100) default NULL, topic_poster int(10) default NULL, topic_time varchar(20) default NULL, topic_views int(10) NOT NULL default '0', topic_replies int(10) NOT NULL default '0', topic_last_post_id int(10) NOT NULL default '0', forum_id int(10) NOT NULL default '0', topic_status int(10) NOT NULL default '0', topic_notify int(2) default '0', PRIMARY KEY  (topic_id), KEY topic_id (topic_id), KEY forum_id (forum_id), KEY topic_last_post_id (topic_last_post_id))");

// New Table Creation
mysql_query("CREATE TABLE ".$prefix."_config (config_id int(10) NOT NULL auto_increment, allow_html int(2) default NULL, allow_bbcode int(2) default NULL, allow_sig int(2) default NULL, selected int(2) NOT NULL default '0', posts_per_page int(10) default NULL, hot_threshold int(10) default NULL, topics_per_page int(10) default NULL, email_sig varchar(255) default NULL, email_from varchar(100) default NULL, PRIMARY KEY  (config_id), UNIQUE KEY selected (selected))");
mysql_query("INSERT INTO ".$prefix."_config VALUES ( '1', '1', '1', '1', '1', '10', '10', '20', 'Yours Truly, NukeAddOn.com', 'rtirtadji@hotmail.com')");

// New Table Creation
mysql_query("CREATE TABLE ".$prefix."_disallow (disallow_id int(10) NOT NULL auto_increment, disallow_username varchar(50) default NULL, PRIMARY KEY  (disallow_id))");

// New Table Creation
mysql_query("CREATE TABLE ".$prefix."_forum_access (forum_id int(10) NOT NULL default '0', user_id int(10) NOT NULL default '0', can_post tinyint(1) NOT NULL default '0', PRIMARY KEY  (forum_id,user_id))");

// New Table Creation
mysql_query("CREATE TABLE ".$prefix."_forum_mods (forum_id int(10) NOT NULL default '0', user_id int(10) NOT NULL default '0')");

// New Table Creation
mysql_query("CREATE TABLE ".$prefix."_forums (forum_id int(10) NOT NULL auto_increment, forum_name varchar(150) default NULL, forum_desc text, forum_access int(10) default '1', forum_moderator int(10) default NULL, forum_topics int(10) NOT NULL default '0', forum_posts int(10) NOT NULL default '0', forum_last_post_id int(10) NOT NULL default '0', cat_id int(10) default NULL, forum_type int(10) default '0', PRIMARY KEY  (forum_id))");

// New Table Creation
mysql_query("CREATE TABLE ".$prefix."_catagories (cat_id int(10) NOT NULL auto_increment, cat_title varchar(100) default NULL, cat_order varchar(10) default NULL, PRIMARY KEY (cat_id))");

// New Table Creation
mysql_query("CREATE TABLE ".$prefix."_forumtopics (topic_id int(10) NOT NULL auto_increment, topic_title varchar(100) default NULL, topic_poster int(10) default NULL, topic_time varchar(20) default NULL, topic_views int(10) NOT NULL default '0', forum_id int(10) default NULL, topic_status int(10) NOT NULL default '0', topic_notify int(2) default '0', PRIMARY KEY  (topic_id))");

// New Table Creation
mysql_query("CREATE TABLE ".$prefix."_posts (post_id int(10) NOT NULL auto_increment, image varchar(100) default NULL, topic_id int(10) NOT NULL default '0', forum_id int(10) NOT NULL default '0', poster_id int(10) default NULL, post_text text, post_time varchar(20) default NULL, poster_ip varchar(16) default NULL, PRIMARY KEY  (post_id))");

// New Table Creation
mysql_query("CREATE TABLE ".$prefix."_posts_text (post_id int(10) NOT NULL default '0', post_text text, PRIMARY KEY  (post_id))");

// New Table Creation
mysql_query("CREATE TABLE ".$prefix."_ranks (rank_id int(10) NOT NULL auto_increment, rank_title varchar(50) NOT NULL default '', rank_min int(10) NOT NULL default '0', rank_max int(10) NOT NULL default '0', rank_special int(2) default '0', rank_image varchar(255) default NULL, PRIMARY KEY  (rank_id), KEY rank_min (rank_min), KEY rank_max (rank_max))");

// New Table Creation
mysql_query("CREATE TABLE ".$prefix."_smiles (id int(10) NOT NULL auto_increment, code varchar(50) default NULL, smile_url varchar(100) default NULL, emotion varchar(75) default NULL, active tinyint(2) default '0', PRIMARY KEY  (id))");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '1', ':D', 'icon_biggrin.gif', 'Very Happy', '0')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '2', ':-D', 'icon_biggrin.gif', 'Very Happy', '1')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '3', ':grin:', 'icon_biggrin.gif', 'Very Happy', '0')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '4', ':)', 'icon_smile.gif', 'Smile', '0')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '5', ':-)', 'icon_smile.gif', 'Smile', '1')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '6', ':smile:', 'icon_smile.gif', 'Smile', '0')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '7', ':(', 'icon_frown.gif', 'Sad', '0')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '8', ':-(', 'icon_frown.gif', 'Sad', '1')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '9', ':sad:', 'icon_frown.gif', 'Sad', '0')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '10', ':o', 'icon_eek.gif', 'Surprised', '0')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '11', ':-o', 'icon_eek.gif', 'Surprised', '1')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '12', ':eek:', 'icon_eek.gif', 'Suprised', '0')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '13', ':-?', 'icon_confused.gif', 'Confused', '1')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '14', ':???:', 'icon_confused.gif', 'Confused', '0')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '15', '8)', 'icon_cool.gif', 'Cool', '0')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '16', '8-)', 'icon_cool.gif', 'Cool', '1')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '17', ':cool:', 'icon_cool.gif', 'Cool', '0')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '18', ':lol:', 'icon_lol.gif', 'Laughing', '1')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '19', ':x', 'icon_mad.gif', 'Mad', '0')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '20', ':-x', 'icon_mad.gif', 'Mad', '1')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '21', ':mad:', 'icon_mad.gif', 'Mad', '0')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '22', ':P', 'icon_razz.gif', 'Razz', '0')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '23', ':-P', 'icon_razz.gif', 'Razz', '1')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '24', ':razz:', 'icon_razz.gif', 'Razz', '0')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '25', ':oops:', 'icon_redface.gif', 'Embaressed', '1')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '26', ':cry:', 'icon_cry.gif', 'Crying (very sad)', '1')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '27', ':evil:', 'icon_evil.gif', 'Evil or Very Mad', '1')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '28', ':roll:', 'icon_rolleyes.gif', 'Rolling Eyes', '1')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '29', ':wink:', 'icon_wink.gif', 'Wink', '0')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '30', ';)', 'icon_wink.gif', 'Wink', '0')");
mysql_query("INSERT INTO ".$prefix."_smiles VALUES ( '31', ';-)', 'icon_wink.gif', 'Wink', '1')");

// New Table Creation
mysql_query("CREATE TABLE ".$prefix."_words (word_id int(10) NOT NULL auto_increment, word varchar(100) default NULL, replacement varchar(100) default NULL, PRIMARY KEY  (word_id))");

// Links Table Alteration
mysql_query("ALTER TABLE ".$prefix."_links_categories ADD parentid TINYINT(11) DEFAULT '0' NOT NULL");

// Links Table Alteration - patched by simplywebdesign.com  20-01-2002
mysql_query("ALTER TABLE ".$prefix."_links_categories ADD parentid TINYINT(11) DEFAULT '0' NOT NULL");
$result = mysql_query("select sid,cid, title from ".$user_prefix."_links_subcategories order by sid");
while(list($sid,$cid, $title) = mysql_fetch_row($result)) {
    mysql_query("insert into ".$prefix."_links_categories values (NULL, '$title', '', '$cid')");
    $get_last_added = mysql_query("select max(cid) last_added_cat from ".$prefix."_links_categories");
    while(list($last_added_cat) = mysql_fetch_row($get_last_added)) {
        $links_to_update = mysql_query("select lid from ".$prefix."_links_links where sid = $sid");
        while(list($lid) = mysql_fetch_row($links_to_update)) {
            $q = "update ".$prefix."_links_links set cid = ".$last_added_cat." where lid= ". $lid."";
            mysql_query($q);
	}
    }
}
mysql_query("DROP TABLE ".$prefix."_links_subcategories");

// New Table Creation
mysql_query("CREATE TABLE ".$prefix."_pages (pid INT(10) DEFAULT '0' NOT NULL AUTO_INCREMENT, title VARCHAR(255) NOT NULL, subtitle VARCHAR(255) NOT NULL, active int(1) NOT NULL default '0', page_header TEXT NOT NULL, text TEXT NOT NULL, page_footer TEXT NOT NULL, signature TEXT NOT NULL, date datetime default NULL, counter int(10) NOT NULL default '0', clanguage varchar(30) NOT NULL default '', PRIMARY KEY (pid))");

// New Table Creation
mysql_query("CREATE TABLE ".$prefix."_encyclopedia (eid INT(10) DEFAULT '0' AUTO_INCREMENT, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, elanguage varchar(30) NOT NULL default '', active INT(1) NOT NULL default '0', PRIMARY KEY (eid))");
mysql_query("CREATE TABLE ".$prefix."_encyclopedia_text (tid INT(10) DEFAULT '0' AUTO_INCREMENT, eid INT(10) NOT NULL default '0', title VARCHAR(255) NOT NULL, text TEXT NOT NULL, counter INT(10) DEFAULT '0' NOT NULL , PRIMARY KEY (tid))");

// Modules Table Alteration
mysql_query("ALTER TABLE ".$prefix."_modules ADD custom_title VARCHAR(255) NOT NULL AFTER title");

// Blocks Table Alteration
mysql_query("ALTER TABLE ".$prefix."_blocks ADD view int(1) DEFAULT '0' NOT NULL AFTER blockfile");
mysql_query("update ".$prefix."_blocks set view='2' where bkey='admin'");
$result = mysql_query("select bid, bkey from ".$prefix."_blocks where bkey!=''");
while(list($bid, $bkey) = mysql_fetch_row($result)) {
    if ($bkey == "main") {
	mysql_query("update ".$prefix."_blocks set bkey='' where bid='$bid'");
    }
    if ($bkey == "modules") {
	mysql_query("update ".$prefix."_blocks set bkey='', blockfile='block-Modules.php' where bid='$bid'");
    }
    if ($bkey == "category") {
	mysql_query("update ".$prefix."_blocks set bkey='', blockfile='block-Categories.php' where bid='$bid'");
    }
    if ($bkey == "login") {
	mysql_query("update ".$prefix."_blocks set bkey='', blockfile='block-Login.php', view='3' where bid='$bid'");
    }
    if ($bkey == "userbox") {
	mysql_query("update ".$prefix."_blocks set view='1' where bid='$bid'");
    }
    if ($bkey == "admin") {
	mysql_query("update ".$prefix."_blocks set view='2' where bid='$bid'");
    }
}


echo "PHP-Nuke Update finished!";

?>