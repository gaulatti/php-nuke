<?php

# File to upgrade PHP-Nuke from 4.4x to 5.0
# After use this file, you can safely delete it
# Change the parameters to fit your info:

#############################################################################
#                               WARNING!!!!                                 #
#                                                                           #
# This version of PHP-Nuke will not include forums support anymore due to a #
# high number of problems. This script will leave intact your forums DB but #
# this version will not manage the data. The solution is to migrate to      #
# another forum system or search for an addon. Yes! this sucks, sorry...    #
#############################################################################

$host 		= "localhost";
$database 	= "nuke";
$username 	= "root";
$password 	= "";

mysql_connect($host, $username, $password);
@mysql_select_db($database);

//************************************************************


// Poll Check table creation

$result = mysql_query("CREATE TABLE poll_check (ip VARCHAR (20) not null , time VARCHAR (14) not null )");

// New Blocks table creation

$result = mysql_query("CREATE TABLE blocks (bid INT (10) DEFAULT '0' not null AUTO_INCREMENT, bkey VARCHAR (15) not null , title VARCHAR (60) not null , content TEXT not null , url VARCHAR (200) not null , position VARCHAR (1) not null , weight INT (10) DEFAULT '1' not null , active INT (1) DEFAULT '1' not null , refresh INT (10) DEFAULT '0' not null , time VARCHAR (14) DEFAULT '0' not null , PRIMARY KEY (bid))");

// Main Block data migration

$result = mysql_query("select title, content from mainblock");
list($title, $content) = mysql_fetch_row($result);
$result = mysql_query("insert into blocks values (NULL, 'main', '$title', '$content', '', 'l', '1', '1', '', '')");

// Block data creation

$result = mysql_query("insert into blocks values (NULL, 'online', 'Who\'s Online', '', '', 'l', '2', '1', '', '')");

// Admin Block data migration

$result = mysql_query("select title, content from adminblock");
list($title, $content) = mysql_fetch_row($result);
$result = mysql_query("insert into blocks values (NULL, 'admin', '$title', '$content', '', 'l', '3', '1', '', '')");
mysql_query("DROP TABLE adminblock");

// Blocks data creation

$result = mysql_query("insert into blocks values (NULL, 'search', 'Search Box', '', '', 'l', '4', '0', '', '')");
$result = mysql_query("insert into blocks values (NULL, 'ephem', 'Ephemerids', '', '', 'l', '5', '0', '', '')");
$result = mysql_query("insert into blocks values (NULL, 'thelang', 'Languages', '', '', 'l', '6', '1', '', '')");

// Left Blocks data migration

$result = mysql_query("select title, content from lblocks");
$count = 7;
while(list($title, $content) = mysql_fetch_row($result)) {
    mysql_query("insert into blocks values (NULL, '', '$title', '$content', '', 'l', '$count', '1', '', '')");
    $count++;
}

// Blocks data creation

mysql_query("insert into blocks values (NULL, 'userbox', 'User\'s Custom Box', '', '', 'r', '1', '1', '', '')");
mysql_query("insert into blocks values (NULL, 'category', 'Categories Menu', '', '', 'r', '2', '1', '', '')");
mysql_query("insert into blocks values (NULL, 'random', 'Random Headlines', '', '', 'r', '3', '0', '', '')");
mysql_query("insert into blocks values (NULL, 'poll', 'Surveys', '', '', 'r', '4', '1', '', '')");
mysql_query("insert into blocks values (NULL, 'big', 'Today\'s Big Story', '', '', 'r', '5', '1', '', '')");
mysql_query("insert into blocks values (NULL, 'login', 'User\'s Login', '', '', 'r', '6', '1', '', '')");
mysql_query("insert into blocks values (NULL, 'past', 'Past Articles', '', '', 'r', '7', '1', '', '')");

// Right Blocks data migration

$result = mysql_query("select title, content from rblocks");
$count = 8;
while(list($title, $content) = mysql_fetch_row($result)) {
    mysql_query("insert into blocks values (NULL, '', '$title', '$content', '', 'r', '$count', '1', '', '')");
    $count++;
}

// Authors table alteration

mysql_query("ALTER TABLE authors DROP radminleft");
mysql_query("ALTER TABLE authors DROP radminright");
mysql_query("ALTER TABLE authors DROP radminmain");
mysql_query("ALTER TABLE authors DROP radminhead");
mysql_query("ALTER TABLE authors DROP radminforum");

// Headlines table alteration

mysql_query("ALTER TABLE headlines DROP url");
mysql_query("ALTER TABLE headlines DROP status");

// Home Messages table creation

mysql_query("CREATE TABLE message (title VARCHAR (100) not null , content TEXT not null , date VARCHAR (14) not null , expire INT (7) not null , active INT (1) DEFAULT '1' not null , view INT (1) DEFAULT '1' not null )");

// Reviews table alteration

mysql_query("ALTER TABLE reviews CHANGE email email VARCHAR (60)");
mysql_query("ALTER TABLE reviews_add CHANGE email email VARCHAR (60)");

// Download table alteration and new tables creation

mysql_query("ALTER TABLE downloads DROP privs"); /* Does this make any sense? nahhh */

$result = mysql_query("CREATE TABLE nuke_downloads_categories (
  cid int(11) NOT NULL auto_increment,
  title varchar(50) NOT NULL default '',
  cdescription text NOT NULL,
  PRIMARY KEY  (cid)
)");

$result = mysql_query("CREATE TABLE nuke_downloads_editorials (
  downloadid int(11) NOT NULL default '0',
  adminid varchar(60) NOT NULL default '',
  editorialtimestamp datetime NOT NULL default '0000-00-00 00:00:00',
  editorialtext text NOT NULL,
  editorialtitle varchar(100) NOT NULL default '',
  PRIMARY KEY  (downloadid)
)");

$result = mysql_query("CREATE TABLE nuke_downloads_downloads (
  lid int(11) NOT NULL auto_increment,
  cid int(11) NOT NULL default '0',
  sid int(11) NOT NULL default '0',
  title varchar(100) NOT NULL default '',
  url varchar(100) NOT NULL default '',
  description text NOT NULL,
  date datetime default NULL,
  name varchar(100) NOT NULL default '',
  email varchar(100) NOT NULL default '',
  hits int(11) NOT NULL default '0',
  submitter varchar(60) NOT NULL default '',
  downloadratingsummary double(6,4) NOT NULL default '0.0000',
  totalvotes int(11) NOT NULL default '0',
  totalcomments int(11) NOT NULL default '0',
  filesize int(11) NOT NULL default '0',
  version varchar(10) NOT NULL default '0',
  homepage varchar(200) NOT NULL default '',
  PRIMARY KEY  (lid)
)");

$result = mysql_query("CREATE TABLE nuke_downloads_modrequest (
  requestid int(11) NOT NULL auto_increment,
  lid int(11) NOT NULL default '0',
  cid int(11) NOT NULL default '0',
  sid int(11) NOT NULL default '0',
  title varchar(100) NOT NULL default '',
  url varchar(100) NOT NULL default '',
  description text NOT NULL,
  modifysubmitter varchar(60) NOT NULL default '',
  brokendownload int(3) NOT NULL default '0',
  name varchar(100) NOT NULL default '',
  email varchar(100) NOT NULL default '',
  filesize int(11) NOT NULL default '0',
  version varchar(10) NOT NULL default '0',
  homepage varchar(200) NOT NULL default '',
  PRIMARY KEY  (requestid),
  UNIQUE KEY requestid (requestid)
)");

$result = mysql_query("CREATE TABLE nuke_downloads_newdownload (
  lid int(11) NOT NULL auto_increment,
  cid int(11) NOT NULL default '0',
  sid int(11) NOT NULL default '0',
  title varchar(100) NOT NULL default '',
  url varchar(100) NOT NULL default '',
  description text NOT NULL,
  name varchar(100) NOT NULL default '',
  email varchar(100) NOT NULL default '',
  submitter varchar(60) NOT NULL default '',
  filesize int(11) NOT NULL default '0',
  version varchar(10) NOT NULL default '0',
  homepage varchar(200) NOT NULL default '',
  PRIMARY KEY  (lid)
)");

$result = mysql_query("CREATE TABLE nuke_downloads_subcategories (
  sid int(11) NOT NULL auto_increment,
  cid int(11) NOT NULL default '0',
  title varchar(50) NOT NULL default '',
  PRIMARY KEY  (sid)
)");

$result = mysql_query("CREATE TABLE nuke_downloads_votedata (
  ratingdbid int(11) NOT NULL auto_increment,
  ratinglid int(11) NOT NULL default '0',
  ratinguser varchar(60) NOT NULL default '',
  rating int(11) NOT NULL default '0',
  ratinghostname varchar(60) NOT NULL default '',
  ratingcomments text NOT NULL,
  ratingtimestamp datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (ratingdbid)
)");

// All tables renaming to nuke_*

mysql_query("ALTER TABLE authors RENAME nuke_authors");
mysql_query("ALTER TABLE autonews RENAME nuke_autonews");
mysql_query("ALTER TABLE banner RENAME nuke_banner");
mysql_query("ALTER TABLE bannerclient RENAME nuke_bannerclient");
mysql_query("ALTER TABLE bannerfinish RENAME nuke_bannerfinish");
mysql_query("ALTER TABLE comments RENAME nuke_comments");
mysql_query("ALTER TABLE counter RENAME nuke_counter");
mysql_query("ALTER TABLE ephem RENAME nuke_ephem");
mysql_query("ALTER TABLE faqAnswer RENAME nuke_faqAnswer");
mysql_query("ALTER TABLE faqCategories RENAME nuke_faqCategories");
mysql_query("ALTER TABLE headlines RENAME nuke_headlines");
mysql_query("ALTER TABLE links_categories RENAME nuke_links_categories");
mysql_query("ALTER TABLE links_subcategories RENAME nuke_links_subcategories");
mysql_query("ALTER TABLE links_editorials RENAME nuke_links_editorials");
mysql_query("ALTER TABLE links_links RENAME nuke_links_links");
mysql_query("ALTER TABLE links_modrequest RENAME nuke_links_modrequest");
mysql_query("ALTER TABLE links_newlink RENAME nuke_links_newlink");
mysql_query("ALTER TABLE links_votedata RENAME nuke_links_votedata");
mysql_query("ALTER TABLE message RENAME nuke_message");
mysql_query("ALTER TABLE blocks RENAME nuke_blocks");
mysql_query("ALTER TABLE poll_check RENAME nuke_poll_check");
mysql_query("ALTER TABLE poll_data RENAME nuke_poll_data");
mysql_query("ALTER TABLE poll_desc RENAME nuke_poll_desc");
mysql_query("ALTER TABLE pollcomments RENAME nuke_pollcomments");
mysql_query("ALTER TABLE priv_msgs RENAME nuke_priv_msgs");
mysql_query("ALTER TABLE queue RENAME nuke_queue");
mysql_query("ALTER TABLE quotes RENAME nuke_quotes");
mysql_query("ALTER TABLE referer RENAME nuke_referer");
mysql_query("ALTER TABLE related RENAME nuke_related");
mysql_query("ALTER TABLE reviews RENAME nuke_reviews");
mysql_query("ALTER TABLE reviews_add RENAME nuke_reviews_add");
mysql_query("ALTER TABLE reviews_comments RENAME nuke_reviews_comments");
mysql_query("ALTER TABLE reviews_main RENAME nuke_reviews_main");
mysql_query("ALTER TABLE seccont RENAME nuke_seccont");
mysql_query("ALTER TABLE sections RENAME nuke_sections");
mysql_query("ALTER TABLE session RENAME nuke_session");
mysql_query("ALTER TABLE stories RENAME nuke_stories");
mysql_query("ALTER TABLE stories_cat RENAME nuke_stories_cat");
mysql_query("ALTER TABLE topics RENAME nuke_topics");
mysql_query("ALTER TABLE users RENAME nuke_users");

// Links table alteration

mysql_query("ALTER TABLE nuke_links_links CHANGE email email VARCHAR (100) not null");
mysql_query("ALTER TABLE nuke_links_links CHANGE name name VARCHAR (100) not null");
mysql_query("ALTER TABLE nuke_links_newlink CHANGE email email VARCHAR (100) not null");
mysql_query("ALTER TABLE nuke_links_newlink CHANGE name name VARCHAR (100) not null");

// Reviews table alteration

mysql_query("ALTER TABLE nuke_reviews CHANGE reviewer reviewer VARCHAR (40)");

// Stats table alteration

mysql_query("DELETE FROM nuke_counter WHERE type = 'browser' AND var = 'WebTV'");

// Warning about forums

echo "PHP-Nuke 5.0 update finished<br><br>";
echo "We're sorry, but from this version we will not include Forums system anymore...<br>";
echo "But for many reasons we don't touched your forum's related tables in the database.<br><br>";
echo "FYI, Those tables are:<br><br>
<ul>
<li>access
<li>catagories
<li>config
<li>forums
<li>forumstopics
<li>posts
<li>ranks
<li>user_status
</ul>
<br>
So, you can delete those tables if you don't want to use forums.<br>
Forums are now available as an Addon from <a href=http://nukeaddon.com>NukeAddon.com</a>";

?>
