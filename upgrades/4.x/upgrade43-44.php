<?php

# File to upgrade PHP-Nuke from 4.3 to 4.4
# After use this file, you can safely delete it
# Change the parameters to fit your info:

$host 		= "localhost";
$database 	= "nuke";
$username 	= "root";
$password 	= "";

mysql_connect($host, $username, $password);
@mysql_select_db($database);

//************************************************************


// Access table creation

$result = mysql_query("CREATE TABLE access (access_id int(10) DEFAULT '0' NOT NULL auto_increment, access_title varchar(20), PRIMARY KEY (access_id))");
$result = mysql_query("INSERT INTO access VALUES ( '1', 'User')");
$result = mysql_query("INSERT INTO access VALUES ( '2', 'Moderator')");
$result = mysql_query("INSERT INTO access VALUES ( '3', 'Super Moderator')");

// Authors table alteration

$result = mysql_query("ALTER TABLE authors ADD radminfaq tinyint(2) DEFAULT '0' NOT NULL after radminhead, ADD radmindownload tinyint(2) DEFAULT '0' NOT NULL after radminfaq, ADD radminforum tinyint(2) DEFAULT '0' NOT NULL after radmindownload, ADD radminreviews TINYINT (2) DEFAULT '0' not null AFTER radminforum");

// Catagories table creation

$result = mysql_query("CREATE TABLE catagories (cat_id int(10) DEFAULT '0' NOT NULL auto_increment, cat_title varchar(100), PRIMARY KEY (cat_id))");

// Config table creation

$result = mysql_query("CREATE TABLE config (allow_html int(2), allow_bbcode int(2), allow_sig int(2), posts_per_page int(10), hot_threshold int(10), topics_per_page int(10))");
$result = mysql_query("INSERT INTO config VALUES ( '1', '1', '1', '10', '10', '10')");

// Downloads table creation

$result = mysql_query("CREATE TABLE downloads (did int(10) DEFAULT '0' NOT NULL auto_increment, dcounter int(10) DEFAULT '0' NOT NULL, durl varchar(255), dfilename varchar(255), dfilesize BIGINT(15), ddate date DEFAULT '0000-00-00' NOT NULL, dweb varchar(255), duser varchar(30), dver varchar(6), dcategory varchar(15), ddescription text, privs enum('0','1','2') DEFAULT '0', PRIMARY KEY (did))");

// Faq tables creation

$result = mysql_query("CREATE TABLE faqAnswer (id tinyint(4) DEFAULT '0' NOT NULL auto_increment, id_cat tinyint(4), question varchar(255), answer text, PRIMARY KEY (id))");
$result = mysql_query("CREATE TABLE faqCategories (id_cat tinyint(3) DEFAULT '0' NOT NULL auto_increment, categories varchar(255), PRIMARY KEY (id_cat))");

// Forums table creation

$result = mysql_query("CREATE TABLE forums (forum_id int(10) DEFAULT '0' NOT NULL auto_increment, forum_name varchar(150), forum_desc text, forum_access int(10) DEFAULT '1', forum_moderator int(10), cat_id int(10), forum_type int(10) DEFAULT '0', forum_pass varchar(60), PRIMARY KEY (forum_id))");
$result = mysql_query("CREATE TABLE forumtopics (topic_id int(10) DEFAULT '0' NOT NULL auto_increment, topic_title varchar(100), topic_poster int(10), topic_time varchar(20), topic_views int(10) DEFAULT '0' NOT NULL, forum_id int(10), topic_status int(10) DEFAULT '0' NOT NULL, topic_notify int(2) DEFAULT '0', PRIMARY KEY (topic_id))");
$result = mysql_query("CREATE TABLE posts (post_id int(10) DEFAULT '0' NOT NULL auto_increment, image varchar(100) NOT NULL, topic_id int(10) DEFAULT '0' NOT NULL, forum_id int(10) DEFAULT '0' NOT NULL, poster_id int(10), post_text text, post_time varchar(20), poster_ip varchar(16), PRIMARY KEY (post_id))");
$result = mysql_query("CREATE TABLE priv_msgs (msg_id int(10) DEFAULT '0' NOT NULL auto_increment, msg_image varchar(100), subject varchar(100), from_userid int(10) DEFAULT '0' NOT NULL, to_userid int(10) DEFAULT '0' NOT NULL, msg_time varchar(20), msg_text text, read_msg tinyint(10) DEFAULT '0' NOT NULL, PRIMARY KEY (msg_id), KEY msg_id (msg_id), KEY to_userid (to_userid))");
$result = mysql_query("CREATE TABLE ranks (rank_id int(10) DEFAULT '0' NOT NULL auto_increment, rank_title varchar(50) NOT NULL, rank_min int(10) DEFAULT '0' NOT NULL, rank_max int(10) DEFAULT '0' NOT NULL, rank_special int(2) DEFAULT '0', PRIMARY KEY (rank_id), KEY rank_min (rank_min), KEY rank_max (rank_max))");

// Users table alteration

$result = mysql_query("select name, uname, email, femail, url, pass, storynum, umode, uorder, thold, noscore, bio, ublock, theme, commentmax, counter from users where uid='2'");
list($name, $uname, $email, $femail, $url, $pass, $storynum, $umode, $uorder, $thold, $noscore, $bio, $ublock, $theme, $commentmax, $counter) = mysql_fetch_row($result);
$result = mysql_query("insert into users values (NULL, '$name', '$uname', '$email', '$femail', '$url', '$pass', '$storynum', '$umode', '$uorder', '$thold', '$noscore', '$bio', '$ublockon', '$ublock', '$theme', '$commentmax', '$counter')");
$result = mysql_query("select name, uname, email, femail, url, pass, storynum, umode, uorder, thold, noscore, bio, ublock, theme, commentmax, counter from users where uid='1'");
list($name, $uname, $email, $femail, $url, $pass, $storynum, $umode, $uorder, $thold, $noscore, $bio, $ublock, $theme, $commentmax, $counter) = mysql_fetch_row($result);
$result = mysql_query("update users set name='$name', uname='$uname', email='$email', femail='$femail', url='$url', pass='$pass', storynum='$storynum', umode='$umode', uorder='$uorder', thold='$thold', noscore='$noscore', bio='$bio', ublockon='$ublockon', ublock='$ublock', theme='$theme', commentmax='$commentmax', counter='$counter' where uid='2'");
$result = mysql_query("ALTER TABLE users ADD user_avatar varchar(30) AFTER url, ADD user_regdate varchar(20) NOT NULL AFTER user_avatar, ADD user_icq varchar(15) AFTER user_regdate, ADD user_occ varchar(100) AFTER user_icq, ADD user_from varchar(100) AFTER user_occ, ADD user_intrest varchar(150) AFTER user_from, ADD user_sig varchar(255) AFTER user_intrest, ADD user_viewemail tinyint(2) AFTER user_sig, ADD user_theme int(3) AFTER user_viewemail, ADD user_aim varchar(18) AFTER user_theme, ADD user_yim varchar(25) AFTER user_aim, ADD user_msnm varchar(25) AFTER user_yim");
$result = mysql_query("update users set name='', uname='Anonymous', email='', femail='', url='', user_avatar='', user_regdate='---', user_icq='', user_occ='', user_from='', user_intrest='', user_sig='', user_viewemail='0', user_theme='0', user_aim='', user_yim='', user_msnm='', pass='', storynum='10', umode='', uorder='0', thold='0', noscore='0', bio='', ublockon='0', ublock='', theme='', commentmax='4096', counter='0' where uid='1'");

$result = mysql_query("select uid from users");
while(list($uid) = mysql_fetch_row($result)) {
    $result2 = mysql_query("update users set user_avatar='blank.gif', user_regdate='Nov 10, 2000' where uid=$uid");
}

// Users Status table creation

$result = mysql_query("CREATE TABLE users_status (uid int(11) DEFAULT '0' NOT NULL auto_increment, posts int(10) DEFAULT '0', attachsig int(2) DEFAULT '0', rank int(10) DEFAULT '0', level int(10) DEFAULT '1', PRIMARY KEY (uid))");
$result = mysql_query("select uid from users");
while(list($uid) = mysql_fetch_row($result)) {
    $result2 = mysql_query("insert into users_status values ('$uid', '0', '0', '0', '1')");
}
$result = mysql_query("update users_status set level='0' where uid='1'");

// Comments table alteration

mysql_query("ALTER TABLE comments CHANGE subject subject VARCHAR (85) DEFAULT '' not null");
mysql_query("ALTER TABLE pollcomments CHANGE subject subject VARCHAR (85) DEFAULT '' not null");

// Reviews table creation

mysql_query("CREATE TABLE reviews_main (title varchar(100), description text)");
mysql_query("INSERT INTO reviews_main VALUES ('Reviews Section Title', 'Reviews Section Long Description')");
mysql_query("CREATE TABLE reviews_comments (cid int(10) DEFAULT '0' NOT NULL auto_increment, rid int(10) DEFAULT '0' NOT NULL, userid varchar(25) NOT NULL, date datetime, comments text, score int(10) DEFAULT '0' NOT NULL, PRIMARY KEY (cid))");
mysql_query("CREATE TABLE reviews (id int(10) NOT NULL auto_increment, date date DEFAULT '0000-00-00' NOT NULL, title varchar(150) DEFAULT '' NOT NULL, text text DEFAULT '' NOT NULL, reviewer varchar(20), email varchar(30), score int(10) DEFAULT '0' NOT NULL, cover varchar(100) DEFAULT '' NOT NULL, url varchar(100) DEFAULT '' NOT NULL, url_title varchar(50) DEFAULT '' NOT NULL, hits int(10) DEFAULT '0' NOT NULL, PRIMARY KEY (id))");
mysql_query("CREATE TABLE reviews_add (id int(10) NOT NULL auto_increment, date date, title varchar(150) DEFAULT '' NOT NULL, text text DEFAULT '' NOT NULL, reviewer varchar(20) DEFAULT '' NOT NULL, email varchar(30) DEFAULT '' NOT NULL, score int(10) DEFAULT '0' NOT NULL, url varchar(100) DEFAULT '' NOT NULL, url_title varchar(50) DEFAULT '' NOT NULL, PRIMARY KEY (id))");

// Categories table creation and alteration

mysql_query("CREATE TABLE stories_cat (catid INT (11) DEFAULT '0' not null AUTO_INCREMENT, title VARCHAR (20) not null , counter INT (11) DEFAULT '0' not null , PRIMARY KEY (catid))");
mysql_query("ALTER TABLE stories ADD catid INT (11) DEFAULT '0' not null AFTER sid");
mysql_query("ALTER TABLE stories ADD ihome INT (1) DEFAULT '0' not null");
mysql_query("ALTER TABLE autonews ADD catid INT (11) DEFAULT '0' not null AFTER anid");
mysql_query("ALTER TABLE autonews ADD ihome INT (1) DEFAULT '0' not null");

echo "PHP-Nuke 4.4 update finished";

?>