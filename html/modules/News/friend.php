<?php
if(!strpos($_SERVER['PHP_SELF'], 'admin.php')) {
	#show right panel:
	define('INDEX_FILE', true);
}
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
if (stripos_clone($_SERVER['QUERY_STRING'],'%25')) header("Location: index.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = "- "._RECOMMEND."";

if (!is_user($user)) {
	Header("Location: modules.php?name=$module_name&file=article&sid=$sid");
	fdie();	
}

function FriendSend($sid) {
	global $user, $cookie, $prefix, $db, $user_prefix, $module_name;
	$sid = intval($sid);
	if(!isset($sid)) { fdie(); }
	include ("header.php");
	$row = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_stories WHERE sid='$sid'"));
	$title = filter($row['title'], "nohtml");
	title(""._FRIEND."");
	OpenTable();
	echo "<center><font class=\"content\"><b>"._FRIEND."</b></font></center><br><br>"
	.""._YOUSENDSTORY." <b>$title</b> "._TOAFRIEND."<br><br>"
	."<form action=\"modules.php?name=$module_name&amp;file=friend\" method=\"post\">"
	."<input type=\"hidden\" name=\"sid\" value=\"$sid\">";
	if (is_user($user)) {
		$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, username, user_email FROM ".$user_prefix."_users WHERE user_id = '".intval($cookie[0])."'"));
		if (empty($row['name'])) {
			$yn = filter($row2['username'], "nohtml");
		} else {
			$yn = filter($row2['name'], "nohtml");
		}
		$ye = filter($row2['user_email'], "nohtml");
	}
	echo "<b>"._FYOURNAME." </b> $yn <input type=\"hidden\" name=\"yname\" value=\"$yn\"><br><br>\n"
	."<b>"._FYOUREMAIL." </b> $ye <input type=\"hidden\" name=\"ymail\" value=\"$ye\"><br><br><br>\n"
	."<b>"._FFRIENDNAME." </b> <input type=\"text\" name=\"fname\"><br><br>\n"
	."<b>"._FFRIENDEMAIL." </b> <input type=\"text\" name=\"fmail\"><br><br>\n"
	."<input type=\"hidden\" name=\"op\" value=\"SendStory\">\n"
	."<input type=\"submit\" value="._SEND.">\n"
	."</form>\n";
	CloseTable();
	include ('footer.php');
}

function SendStory($sid, $yname, $ymail, $fname, $fmail) {
	global $sitename, $nukeurl, $prefix, $db, $module_name;
	$fname = removecrlf(filter($fname, "nohtml"));
	$fmail = removecrlf(filter($fmail, "nohtml"));
	$yname = removecrlf(filter($yname, "nohtml"));
	$ymail = removecrlf(filter($ymail, "nohtml"));
	$sid = intval($sid);
	$row = $db->sql_fetchrow($db->sql_query("SELECT title, time, topic FROM ".$prefix."_stories WHERE sid='$sid'"));
	$title = filter($row['title'], "nohtml");
	$time = $row['time'];
	$topic = intval($row['topic']);
	$row2 = $db->sql_fetchrow($db->sql_query("SELECT topictext FROM ".$prefix."_topics WHERE topicid='$topic'"));
	$topictext = filter($row2['topictext'], "nohtml");
	$subject = ""._INTERESTING." $sitename";
	$message = ""._HELLO." $fname:\n\n"._YOURFRIEND." $yname "._CONSIDERED."\n\n\n$title\n("._FDATE." $time)\n"._FTOPIC." $topictext\n\n"._URL.": $nukeurl/modules.php?name=$module_name&file=article&sid=$sid\n\n"._YOUCANREAD." $sitename\n$nukeurl";
	mail($fmail, $subject, $message, "From: \"$yname\" <$ymail>\nX-Mailer: PHP/" . phpversion());
	update_points(6);
	$title = urlencode($title);
	$fname = urlencode($fname);
	Header("Location: modules.php?name=$module_name&file=friend&op=StorySent&title=$title&fname=$fname");
}

function StorySent($title, $fname) {
	include ("header.php");
	$title = filter($title, "nohtml");
	$fname = filter($fname, "nohtml");
	OpenTable();
	echo "<center><font class=\"content\">"._FSTORY." <b>$title</b> "._HASSENT." $fname... "._THANKS."</font></center>";
	CloseTable();
	include ("footer.php");
}

switch($op) {

	case "SendStory":
	SendStory($sid, $yname, $ymail, $fname, $fmail);
	break;

	case "StorySent":
	StorySent($title, $fname);
	break;

	case "FriendSend":
	FriendSend($sid);
	break;

}

?>