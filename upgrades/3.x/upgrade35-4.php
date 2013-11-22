<?php

# File to upgrade PHP-Nuke from 3.5/3.6 to 4.2
# After use this file, you can safely delete it
# Change the parameters to fit your info:

$host 		= "localhost";
$database 	= "nuke";
$username 	= "root";
$password 	= "";

mysql_connect($host, $username, $password);
@mysql_select_db($database);

//************************************************************

$result = mysql_query("ALTER TABLE users CHANGE pass pass varchar(40) NOT NULL");
if (!$result) { 
    echo "Alteration of stories table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}

$result = mysql_query("ALTER TABLE topics CHANGE topicid topicid int(3) NOT NULL");
if (!$result) { 
    echo "Alteration of topics table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}


$result = mysql_query("ALTER TABLE topics CHANGE topicid topicid INT (3) DEFAULT '0' not null AUTO_INCREMENT");
if (!$result) { 
    echo "Alteration of topics table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}


$result = mysql_query("CREATE TABLE headlines (
  hid int(11) DEFAULT '0' NOT NULL auto_increment,
  sitename varchar(30) DEFAULT '' NOT NULL,
  url varchar(100) DEFAULT '' NOT NULL,
  headlinesurl varchar(200) DEFAULT '' NOT NULL,
  status tinyint(1) DEFAULT '0' NOT NULL,
  PRIMARY KEY (hid)
)");
if (!$result) { 
    echo "Creation of headlines table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}


$result = mysql_query("INSERT INTO headlines VALUES (1,'PHP-Nuke','http://phpnuke.org','http://phpnuke.org/backend.php',0)");
$result = mysql_query("INSERT INTO headlines VALUES (2,'LinuxPreview','http://linuxpreview.org','http://linuxpreview.org/backend.php3',0)");
$result = mysql_query("INSERT INTO headlines VALUES (3,'Slashdot','http://slashdot.org','http://slashdot.org/slashdot.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (4,'NewsForge','http://www.newsforge.com','http://www.newsforge.com/newsforge.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (5,'PHPBuilder','http://phpbuilder.com','http://phpbuilder.com/rss_feed.php',0)");
$result = mysql_query("INSERT INTO headlines VALUES (6,'Linux.com','http://linux.com','http://linux.com/mrn/front_page.rss',0)");
$result = mysql_query("INSERT INTO headlines VALUES (7,'Freshmeat','http://freshmeat.net','http://freshmeat.net/backend/fm.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (8,'AppWatch','http://static.appwatch.com','http://static.appwatch.com/appwatch.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (9,'LinuxWeelyNews','http://lwn.net','http://lwn.net/headlines/rss',0)");
$result = mysql_query("INSERT INTO headlines VALUES (10,'HappyPenguin','http://happypenguin.org','http://happypenguin.org/html/news.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (11,'Segfault','http://segfault.org','http://segfault.org/stories.xml',0)");
$result = mysql_query("INSERT INTO headlines VALUES (13,'KDE','http://www.kde.org','http://www.kde.org/news/kdenews.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (14,'Perl.com','http://www.perl.com','http://www.perl.com/pace/perlnews.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (15,'Themes.org','http://themes.org','http://www.themes.org/news.rdf.phtml',0)");
$result = mysql_query("INSERT INTO headlines VALUES (16,'BrunchingShuttlecocks','http://www.brunching.com','http://www.brunching.com/brunching.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (17,'MozillaNewsBot','http://www.mozilla.org/newsbot/','http://www.mozilla.org/newsbot/newsbot.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (18,'NewsTrolls','http://newstrolls.com','http://newstrolls.com/newstrolls.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (19,'FreakTech','http://sunsite.auc.dk/FreakTech/','http://sunsite.auc.dk/FreakTech/FreakTech.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (20,'AbsoluteGames','http://files.gameaholic.com','http://files.gameaholic.com/agfa.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (21,'SciFi-News','http://www.technopagan.org/sf-news/','http://www.technopagan.org/sf-news/rdf.php',0)");
$result = mysql_query("INSERT INTO headlines VALUES (22,'SisterMachineGun','http://www.smg.org','http://www.smg.org/index/mynetscape.html',0)");
$result = mysql_query("INSERT INTO headlines VALUES (23,'LinuxM68k','http://www.linux-m68k.org','http://www.linux-m68k.org/linux-m68k.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (24,'Protest.net','http://www.protest.net','http://www.protest.net/netcenter_rdf.cgi',0)");
$result = mysql_query("INSERT INTO headlines VALUES (25,'HollywoodBitchslap','http://hollywoodbitchslap.com','http://hollywoodbitchslap.com/hbs.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (26,'DrDobbsTechNetCast','http://www.technetcast.com','http://www.technetcast.com/tnc_headlines.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (27,'RivaExtreme','http://rivaextreme.com','http://rivaextreme.com/ssi/rivaextreme.rdf.cdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (28,'Linuxpower','http://linuxpower.org','http://linuxpower.org/linuxpower.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (29,'PBSOnline','http://www.pbs.org','http://cgi.pbs.org/cgi-registry/featuresrdf.pl',0)");
$result = mysql_query("INSERT INTO headlines VALUES (30,'Listology','http://www.listology.com','http://listology.com/recent.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (31,'Linuxdev.net','http://linuxdev.net','http://linuxdev.net/archive/news.cdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (32,'LinuxNewbie','http://www.linuxnewbie.org','http://www.linuxnewbie.org/news.cdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (33,'exoScience','http://www.exosci.com','http://www.exosci.com/exosci.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (34,'Technocrat','http://www.technocrat.net','http://technocrat.net/rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (35,'PDABuzz','http://www.pdabuzz.com','http://www.pdabuzz.com/netscape.txt',0)");
$result = mysql_query("INSERT INTO headlines VALUES (36,'MicroUnices','http://mu.current.nu','http://mu.current.nu/mu.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (37,'TheNextLevel','http://www.the-nextlevel.com','http://www.the-nextlevel.com/rdf/tnl.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (38,'Gnotices','http://news.gnome.org/gnome-news/','http://news.gnome.org/gnome-news/rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (39,'DailyDaemonNews','http://daily.daemonnews.org','http://daily.daemonnews.org/ddn.rdf.php3',0)");
$result = mysql_query("INSERT INTO headlines VALUES (40,'PerlMonks','http://www.perlmonks.org','http://www.perlmonks.org/headlines.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (41,'PerlNews','http://news.perl.org','http://news.perl.org/perl-news-short.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (42,'BSDToday','http://www.bsdtoday.com','http://www.bsdtoday.com/backend/bt.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (43,'DotKDE','http://dot.kde.org','http://dot.kde.org/rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (44,'GeekNik','http://www.geeknik.net','http://www.geeknik.net/backend/weblog.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (45,'HotWired','http://www.hotwired.com','http://www.hotwired.com/webmonkey/meta/headlines.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (46,'JustLinux','http://www.justlinux.com','http://www.justlinux.com/backend/features.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (47,'LAN-Systems','http://www.lansystems.com','http://www.lansystems.com/backend/gazette_news_backend.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (48,'LinuxCentral','http://linuxcentral.com','http://linuxcentral.com/backend/lcnew.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (49,'Linux.nu','http://www.linux.nu','http://www.linux.nu/backend/lnu.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (50,'Lin-x-pert','http://www.lin-x-pert.com','http://www.lin-x-pert.com/linxpert_apps.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (51,'MaximumBSD','http://www.maximumbsd.com','http://www.maximumbsd.com/backend/weblog.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (52,'SolarisCentral','http://www.SolarisCentral.org','http://www.SolarisCentral.org/news/SolarisCentral.rdf',0)");
$result = mysql_query("INSERT INTO headlines VALUES (53,'DigitalTheatre','http://www.dtheatre.com','http://www.dtheatre.com/backend.php3?xml=yes',0)");


$result = mysql_query("CREATE TABLE related (
  rid int(11) DEFAULT '0' NOT NULL auto_increment,
  tid int(11) DEFAULT '0' NOT NULL,
  name varchar(30) DEFAULT '' NOT NULL,
  url varchar(200) DEFAULT '' NOT NULL,
  PRIMARY KEY (rid)
)");
if (!$result) { 
    echo "Creation of related table failed!<br>" .mysql_errno(). ": ".mysql_error(). "<br>"; 
    return; 
}


echo "PHP-Nuke Tables Updated, Ok...";
?>

