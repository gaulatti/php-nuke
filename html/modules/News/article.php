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
$optionbox = "";
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

if (isset($sid)) { $sid = intval($sid); } else { $sid = ""; }
if (stristr($REQUEST_URI,"mainfile")) {
	Header("Location: modules.php?name=$module_name&file=article&sid=$sid");
} elseif (empty($sid) && !isset($tid)) {
	Header("Location: index.php");
}

if ($save AND is_user($user)) {
	cookiedecode($user);
	getusrinfo($user);
	if(!isset($mode)) { $mode = $userinfo['umode']; }
	if(!isset($order)) { $order = $userinfo['uorder']; }
	if(!isset($thold)) { $thold = $userinfo['thold']; }
	$db->sql_query("UPDATE ".$user_prefix."_users SET umode='$mode', uorder='$order', thold='$thold' where uid='$cookie[0]'");
	getusrinfo($user);
	$info = base64_encode("$userinfo[user_id]:$userinfo[username]:$userinfo[user_password]:$userinfo[storynum]:$userinfo[umode]:$userinfo[uorder]:$userinfo[thold]:$userinfo[noscore]");
	setcookie("user","$info",time()+$cookieusrtime);
}

if ($op == "Reply") {
  $display = "";
  if(isset($mode)) { $display .= "&mode=".$mode; }
  if(isset($order)) { $display .= "&order=".$order; }
  if(isset($thold)) { $display .= "&thold=".$thold; }
  Header("Location: modules.php?name=$module_name&file=comments&op=Reply&pid=0&sid=".$sid.$display);
}

$result = $db->sql_query("select catid, aid, time, title, hometext, bodytext, topic, informant, notes, acomm, haspoll, pollID, score, ratings FROM ".$prefix."_stories where sid='$sid'");
if ($numrows = $db->sql_numrows($result) != 1) {
	Header("Location: index.php");
	fdie();
}
$row = $db->sql_fetchrow($result);
$catid = intval($row['catid']);
$aaid = filter($row['aid'], "nohtml");
$time = $row['time'];
$title = filter($row['title'], "nohtml");
$hometext = filter($row['hometext']);
$bodytext = filter($row['bodytext']);
$topic = intval($row['topic']);
$informant = filter($row['informant'], "nohtml");
$notes = filter($row['notes']);
$acomm = intval($row['acomm']);
$haspoll = intval($row['haspoll']);
$pollID = intval($row['pollID']);
$score = intval($row['score']);
$ratings = intval($row['ratings']);

if (empty($aaid)) {
	Header("Location: modules.php?name=$module_name");
}

$db->sql_query("UPDATE ".$prefix."_stories SET counter=counter+1 where sid='$sid'");

$artpage = 1;
$pagetitle = "- $title";
require("header.php");
$artpage = 0;

formatTimestamp($time);
$title = filter($title, "nohtml");
$hometext = filter($hometext);
$bodytext = filter($bodytext);
$notes = filter($notes);
if (!empty($notes)) {
	$notes = "<br><br><b>"._NOTE."</b> <i>$notes</i>";
} else {
	$notes = "";
}

if(empty($bodytext)) {
	$bodytext = "$hometext$notes";
} else {
	$bodytext = "$hometext<br><br>$bodytext$notes";
}

if(empty($informant)) {
	$informant = $anonymous;
}

getTopics($sid);

if ($catid != 0) {
	$row2 = $db->sql_fetchrow($db->sql_query("select title from ".$prefix."_stories_cat where catid='$catid'"));
	$title1 = filter($row2['title'], "nohtml");
	$title = "<a href=\"modules.php?name=$module_name&amp;file=categories&amp;op=newindex&amp;catid=$catid\"><font class=\"storycat\">$title1</font></a>: $title";
}

//echo "<table width=\"100%\" border=\"0\"><tr><td valign=\"top\" width=\"100%\">\n";
themearticle($aaid, $informant, $datetime, $title, $bodytext, $topic, $topicname, $topicimage, $topictext);
//echo "</td><td>&nbsp;</td><td valign=\"top\">\n";

if ($multilingual == 1) {
	$querylang = "AND (blanguage='$currentlang' OR blanguage='')";
} else {
	$querylang = "";
}

/* Determine if the article has attached a poll */
if ($haspoll == 1) {
	$url = sprintf("modules.php?name=Surveys&amp;op=results&amp;pollID=%d", $pollID);
	$boxContent = "<form action=\"modules.php?name=Surveys\" method=\"post\">";
	$boxContent .= "<input type=\"hidden\" name=\"pollID\" value=\"".$pollID."\">";
	$row3 = $db->sql_fetchrow($db->sql_query("SELECT pollTitle, voters FROM ".$prefix."_poll_desc WHERE pollID='$pollID'"));
	$pollTitle = filter($row3['pollTitle'], "nohtml");
	$voters = $row3['voters'];
	$boxTitle = _ARTICLEPOLL;
	//$boxContent .= "<font class=\"content\"><b>$pollTitle</b></font><br><br>\n";
	//$boxContent .= "<table border=\"0\" width=\"100%\">";
	for($i = 1; $i <= 12; $i++) {
		$result4 = $db->sql_query("SELECT pollID, optionText, optionCount, voteID FROM ".$prefix."_poll_data WHERE (pollID='$pollID') AND (voteID='$i')");
		$row4 = $db->sql_fetchrow($result4);
		$numrows = $db->sql_numrows($result4);
		if($numrows != 0) {
			$optionText = $row4['optionText'];
			if(!empty($optionText)) {
				//$boxContent .= "<tr><td valign=\"top\"><input type=\"radio\" name=\"voteID\" value=\"".$i."\"></td><td width=\"100%\"><font class=\"content\">$optionText</font></td></tr>\n";
			}
		}
	}
	//$boxContent .= "</table><br><center><font class=\"content\"><input type=\"submit\" value=\""._VOTE."\"></font><br>";
	if (is_user($user)) {
		cookiedecode($user);
	}
	for($i = 0; $i < 12; $i++) {
		$row5 = $db->sql_fetchrow($db->sql_query("SELECT optionCount FROM ".$prefix."_poll_data WHERE (pollID='$pollID') AND (voteID='$i')"));
		$optionCount = $row5['optionCount'];
		$sum = (int)$sum+$optionCount;
	}
	$boxContent .= "<font class=\"content\">[ <a href=\"modules.php?name=Surveys&amp;op=results&amp;pollID=$pollID&amp;mode=".$userinfo['umode']."&amp;order=".$userinfo['uorder']."&amp;thold=".$userinfo['thold']."\"><b>"._RESULTS."</b></a> | <a href=\"modules.php?name=Surveys\"><b>"._POLLS."</b></a> ]<br>";

	if ($pollcomm) {
		$result6 = $db->sql_query("select * from ".$prefix."_pollcomments where pollID='$pollID'");
		$numcom = $db->sql_numrows($result6);
		$boxContent .= "<br>"._VOTES.": <b>$sum</b><br>"._PCOMMENTS." <b>$numcom</b>\n\n";
	} else {
		$boxContent .= "<br>"._VOTES." <b>$sum</b>\n\n";
	}
	$boxContent .= "</font></center></form>\n\n";
	themesidebox($boxTitle, $boxContent);
}

/* old modules */

//echo "</td></tr></table>\n";
cookiedecode($user);
include("modules/$module_name/associates.php");

if (((empty($mode) OR ($mode != "nocomments")) OR ($acomm == 0)) OR ($articlecomm == 1)) {
	include("modules/News/comments.php");
}
include ("footer.php");

?>