 <?php

 /************************************************************************/
 /* PHP-NUKE: Web Portal System                                          */
 /* ===========================                                          */
 /*                                                                      */
 /* Copyright (c) 2007 by Francisco Burzi                                */
 /* http://phpnuke.org                                                   */
 /*                                                                      */
 /* This program is free software. You can redistribute it and/or modify */
 /* it under the terms of the GNU General Public License as published by */
 /* the Free Software Foundation; either version 2 of the License.       */
 /************************************************************************/

 if (!defined('MODULE_FILE')) {
 	die ("You can't access this file directly...");
 }

 require_once("mainfile.php");
 $module_name = basename(dirname(__FILE__));
 get_lang($module_name);

 function avtgo() {
 	global $sitename, $slogan, $db, $prefix, $module_name, $site_logo, $Default_Theme;
 	if (file_exists("themes/$Default_Theme/images/logo.gif")) {
 	$avantgo_logo = "themes/$Default_Theme/images/logo.gif";
 	} elseif (file_exists("images/$site_logo")) {
 	$avantgo_logo = "images/$site_logo";
 	} elseif (file_exists("images/logo.gif")) {
 	$avantgo_logo = "images/logo.gif";
 	} else {
 	$avantgo_logo = "";
 	}
 	header("Content-Type: text/html");
 	echo "<html>\n"
 	."<head>\n"
 	."<title>$sitename - AvantGo</title>\n"
 	."<meta name=\"HandheldFriendly\" content=\"True\">\n"
 	."</head>\n"
 	."<body>\n\n\n"
 	."<div align=\"center\">\n";
 	$result = $db->sql_query("SELECT sid, title, time FROM ".$prefix."_stories ORDER BY sid DESC LIMIT 10");
 	if (empty($result)) {
 		echo "An error occured";
 	} else {
 		echo "\t<a href=\"index.php\"><img src=\"$avantgo_logo\" alt=\"$slogan\" title=\"$slogan\" border=\"0\"></a><br><br>\r\n"
 		."\t<table border=\"0\" align=\"center\">\r\n"
 		."\t\t<tr>\r\n"
 		."\t\t\t<td bgcolor=\"#efefef\">"._TITLE."</td>\r\n"
 		."\t\t\t<td bgcolor=\"#efefef\">"._DATE."</td>\r\n"
 		."\t\t</tr>\r\n";
 		for ($m=0; $m < $db->sql_numrows($result); $m++) {
 			$row = $db->sql_fetchrow($result);
 			$sid = intval($row['sid']);
 			$title = filter($row['title'], "nohtml");
 			$time = $row['time'];
 			echo "\t\t<tr>\r\n"
 			."\t\t\t<td><a href=\"modules.php?name=$module_name&amp;op=ReadStory&amp;sid=$sid\">$title</a></td>\r\n"
 			."\t\t\t<td>$time</td>\r\n"
 			."\t\t</tr>\r\n";
 		}
 		echo"\t</table>\r\n";
 	}
 	echo "</body>\n"
 	."</html>";
 	include ("includes/counter.php");
 	die();
 }

 function ReadStory($sid) {
 	global $site_logo, $nukeurl, $sitename, $datetime, $prefix, $db, $module_name;
 	$sid = intval($sid);
 	$num = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_stories WHERE sid='$sid'"));
 	if ($num == 0) {
 		Header("Location: modules.php?name=$module_name");
 		die();
 	}
 	$sid = intval(trim($sid));
 	$row = $db->sql_fetchrow($db->sql_query("SELECT title, time, hometext, bodytext, topic, notes FROM ".$prefix."_stories WHERE sid='$sid'"));
 	$title = filter($row['title'], "nohtml");
 	$time = $row['time'];
 	$hometext = filter($row['hometext']);
 	$bodytext = filter($row['bodytext']);
 	$topic = intval($row['topic']);
 	$notes = filter($row['notes']);
 	$row2 = $db->sql_fetchrow($db->sql_query("SELECT topictext FROM ".$prefix."_topics WHERE topicid='$topic'"));
 	$topictext = filter($row2['topictext'], "nohtml");
 	formatTimestamp($time);
 	echo "
    <html>
    <head>
    <title>$sitename - $title</title>
    <meta name=\"HandheldFriendly\" content=\"True\">
    </head>
    <body bgcolor=\"#ffffff\" text=\"#000000\">
    <table border=\"0\" align=\"center\"><tr><td>
    <table border=\"0\" width=\"640\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"#000000\"><tr><td>
    <table border=\"0\" width=\"640\" cellpadding=\"20\" cellspacing=\"1\" bgcolor=\"#ffffff\"><tr><td>
    <center>
    <img src=\"images/$site_logo\" border=\"0\" alt=\"\"><br><br>
    <font class=\"content\">
    <b>$title</b></font><br>
    <font class=tiny><b>"._PDATE."</b> $datetime<br><b>"._PTOPIC."</b> $topictext</font><br><br>
    </center>
    <font class=\"content\">
    $hometext<br><br>
    $bodytext<br><br>
    $notes<br><br>
    </font>
    </td></tr></table></td></tr></table>
    <br><br><center>
    <font class=\"content\">
    "._COMESFROM." $sitename<br>
    <a href=\"$nukeurl\">$nukeurl</a><br><br>
    "._THEURL."<br>
    <a href=\"$nukeurl/modules.php?name=News&file=article&sid=$sid\">$nukeurl/modules.php?name=News&file=article&sid=$sid</a>
    </font>
    </td></tr></table>
    </body>
    </html>
    ";
 }

 switch($op) {

 	case "ReadStory":
 	ReadStory($sid);
 	break;

 	default:
 	avtgo();
 	break;
 }

?>