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

define('INDEX_FILE', true);
$categories = 1;
$cat = $catid;
automated_news();

function theindex($catid) {
	global $storyhome, $httpref, $httprefmax, $topicname, $topicimage, $topictext, $datetime, $user, $cookie, $nukeurl, $prefix, $multilingual, $currentlang, $db, $articlecomm, $module_name, $userinfo;
        if (is_user($user)) { getusrinfo($user); }
	if ($multilingual == 1) {
		$querylang = "AND (alanguage='$currentlang' OR alanguage='')"; /* the OR is needed to display stories who are posted to ALL languages */
	} else {
		$querylang = "";
	}
	include("header.php");
	if (isset($userinfo['storynum'])) {
		$storynum = $userinfo['storynum'];
	} else {
		$storynum = $storyhome;
	}
	$catid = intval($catid);
	$db->sql_query("update ".$prefix."_stories_cat set counter=counter+1 where catid='$catid'");
	$result = $db->sql_query("SELECT sid, aid, title, time, hometext, bodytext, comments, counter, topic, informant, notes, acomm, score, ratings FROM ".$prefix."_stories where catid='$catid' $querylang ORDER BY sid DESC limit $storynum");
	while ($row = $db->sql_fetchrow($result)) {
		$s_sid = intval($row['sid']);
		$aid = filter($row['aid'], "nohtml");
		$title = filter($row['title'], "nohtml");
		$time = $row['time'];
		$hometext = filter($row['hometext']);
		$bodytext = filter($row['bodytext']);
		$comments = intval($row['comments']);
		$counter = intval($row['counter']);
		$topic = intval($row['topic']);
		$informant = filter($row['informant'], "nohtml");
		$notes = filter($row['notes']);
		$acomm = intval($row['acomm']);
		$score = intval($row['score']);
		$ratings = intval($row['ratings']);
		getTopics($s_sid);
		formatTimestamp($time);
		$subject = filter($subject, "nohtml");
		$introcount = strlen($hometext);
		$fullcount = strlen($bodytext);
		$totalcount = $introcount + $fullcount;
		$c_count = $comments;
		$r_options = "";
		if (isset($userinfo['umode'])) { $r_options .= "&amp;mode=".$userinfo['umode']; }
		if (isset($userinfo['uorder'])) { $r_options .= "&amp;order=".$userinfo['uorder']; }
		if (isset($userinfo['thold'])) { $r_options .= "&amp;thold=".$userinfo['thold']; }
		$story_link = "<a class='readmore' href=\"modules.php?name=News&amp;file=article&amp;sid=$s_sid$r_options\">";
		$morelink = " ";
		if ($fullcount > 0 OR $c_count > 0 OR $articlecomm == 0 OR $acomm == 1) {
			$morelink .= "$story_link<b>"._READMORE."</b></a> | ";
		} else {
			$morelink .= "";
		}
		if ($fullcount > 0) { $morelink .= "$totalcount "._BYTESMORE." | "; }
		if ($articlecomm == 1 AND $acomm == 0) {
			if ($c_count == 0) { $morelink .= "$story_link"._COMMENTSQ."</a>"; } elseif ($c_count == 1) { $morelink .= "$story_link$c_count "._COMMENT."</a>"; } elseif ($c_count > 1) { $morelink .= "$story_link$c_count "._COMMENTS."</a>"; }
		}
		if ($score != 0) {
			$rated = substr($score / $ratings, 0, 4);
		} else {
			$rated = 0;
		}
		$morelink .= " | "._SCORE." $rated";
		$morelink .= " ";
		$morelink = str_replace(" |  | ", " | ", $morelink);
		$sid = intval($s_sid);
		$row2 = $db->sql_fetchrow($db->sql_query("select title from ".$prefix."_stories_cat where catid='$catid'"));
		$title1 = filter($row2['title'], "nohtml");
		$title = "$title1: $title";
		themeindex($aid, $informant, $datetime, $title, $counter, $topic, $hometext, $notes, $morelink, $topicname, $topicimage, $topictext);
	}
	if ($httpref==1) {
		$referer = $_SERVER['HTTP_REFERER'];
		if ($referer=="" OR ereg("unknown", $referer) OR eregi($nukeurl,$referer)) {
		} else {
			$db->sql_query("insert into ".$prefix."_referer values (NULL, '$referer')");
		}
		$numrows = $db->sql_numrows($db->sql_query("select * from ".$prefix."_referer"));
		if($numrows==$httprefmax) {
			$db->sql_query("delete from ".$prefix."_referer");
		}
	}
	include("footer.php");
}

switch ($op) {

	case "newindex":
	if ($catid == 0 OR $catid == "") {
		Header("Location: modules.php?name=$module_name");
	}
	theindex($catid);
	break;

	default:
	Header("Location: modules.php?name=$module_name");

}

?>