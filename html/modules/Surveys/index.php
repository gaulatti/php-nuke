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

$pagetitle = "- "._SURVEYS."";
if (isset($pollID)) {
	$pollID = intval($pollID);
}

if(!isset($pollID)) {
	include ('header.php');
	pollList();
	include ('footer.php');
} elseif ($pollID <= 0) {
	Header("Location: modules.php?name=$module_name");
	die();
} elseif($op == "results" && $pollID > 0) {
    if (isset($tid)) {
		Header("Location: modules.php?name=$module_name"); // SecurityReason Fix 2005 - sp3x -> Now should be OK.
	}
	include ("header.php");
	OpenTable();
	echo "<center><font class=\"title\"><b>"._CURRENTPOLLRESULTS."</b></font></center>";
	CloseTable();
	echo "<br>";
	OpenTable();
	pollResults($pollID);
	CloseTable();
	echo "<br>";
	OpenTable();
	echo "<b>"._LAST5POLLS." $sitename</b><br><br>";
	$r_options = "";
	if (isset($userinfo['umode'])) { $r_options .= "&amp;mode=".$userinfo['umode']; }
	if (isset($userinfo['uorder'])) { $r_options .= "&amp;order=".$userinfo['uorder']; }
	if (isset($userinfo['thold'])) { $r_options .= "&amp;thold=".$userinfo['thold']; }
	$result = $db->sql_query("SELECT pollID, pollTitle, voters FROM ".$prefix."_poll_desc where artid='0' order by timeStamp DESC limit 1,5");
	while ($row = $db->sql_fetchrow($result)) {
		$plid = intval($row['pollID']);
		$pltitle = filter($row['pollTitle'], "nohtml");
		$plvoters = intval($row['voters']);
		if ($pollID == $plid) {
			echo "<img src='images/arrow.gif' border='0'>&nbsp;$pltitle ($plvoters "._LVOTES.")<br><br>";
		} else {
			echo "<img src='images/arrow.gif' border='0'>&nbsp;<a href='modules.php?name=$module_name&op=results&pollID=$plid$r_options'>$pltitle</a> ($plvoters "._LVOTES.")<br><br>";
		}
	}
	echo "<div align=\"right\"><a href='modules.php?name=$module_name'><b>"._MOREPOLLS."</b></a></div>";
	CloseTable();
	cookiedecode($user);
	if (($pollcomm) AND ((!isset($mode)) OR ($mode != "nocomments")) AND !isset($tid)) {
		echo "<br>";
		include("modules/Surveys/comments.php");
	}
	include ("footer.php");
} elseif(isset($voteID) AND ($voteID > 0)) {
	pollCollector($pollID, $voteID);
} elseif($pollID != pollLatest()) {
	include ('header.php');
	OpenTable();
	echo "<center><font class=\"option\"><b>"._SURVEY."</b></font></center>";
	CloseTable();
	echo "<br><br>";
	echo "<table border=\"0\" align=\"center\"><tr><td>";
	pollMain($pollID);
	echo "</td></tr></table>";
	include ('footer.php');
} else {
	include ('header.php');
	OpenTable();
	echo "<center><font class=\"option\"><b>"._CURRENTSURVEY."</b></font></center>";
	CloseTable();
	echo "<br><br><table border=\"0\" align=\"center\"><tr><td>";
	pollNewest();
	echo "</td></tr></table>";
	include ('footer.php');
}

/*********************************************************/
/* Functions                                             */
/*********************************************************/

function pollMain($pollID) {
	global $boxTitle, $boxContent, $pollcomm, $user, $cookie, $prefix, $module_name, $db, $userinfo;
	$pollID = intval($pollID);
	if(!isset($pollID))
	$pollID = 1;
	$boxContent .= "<form action=\"modules.php?name=$module_name\" method=\"post\">";
	$boxContent .= "<input type=\"hidden\" name=\"pollID\" value=\"".$pollID."\">";
	$result_a = $db->sql_query("SELECT pollTitle, voters FROM ".$prefix."_poll_desc WHERE pollID='$pollID'");
	list($pollTitle, $voters) = $db->sql_fetchrow($result_a);
	$boxTitle = _SURVEY;
	$boxContent .= "<font class=\"content\"><b>$pollTitle</b></font><br><br>\n";
	$boxContent .= "<table border=\"0\" width=\"100%\">";
	for($i = 1; $i <= 12; $i++) {
		$result = $db->sql_query("SELECT pollID, optionText, optionCount, voteID FROM ".$prefix."_poll_data WHERE pollID='$pollID' AND voteID='$i'");
		$row = $db->sql_fetchrow($result);
			$optionText = $row['optionText'];
			if(!empty($optionText)) {
				$boxContent .= "<tr><td valign=\"top\"><input type=\"radio\" name=\"voteID\" value=\"".$i."\"></td><td width=\"100%\"><font class=\"content\">$optionText</font></td></tr>\n";
		}
	}
	$boxContent .= "</table><br><center><font class=\"content\"><input type=\"submit\" value=\""._VOTE."\"></font><br>";
	if (is_user($user)) {
		cookiedecode($user);
		getusrinfo($user);
	}
	$sum = 0;
	for($i = 0; $i < 12; $i++) {
		$result2 = $db->sql_query("SELECT optionCount FROM ".$prefix."_poll_data WHERE pollID='$pollID' AND voteID='$i'");
		$row2 = $db->sql_fetchrow($result2);
		$optionCount = $row2['optionCount'];
		$sum = (int)$sum+$optionCount;
	}
	$boxContent .= "<br><font class=\"content\"><a href=\"modules.php?name=$module_name&amp;op=results&amp;pollID=$pollID&amp;mode=".$userinfo['umode']."&amp;order=".$userinfo['uoder']."&amp;thold=".$userinfo['thold']."\"><b>"._RESULTS."</b></a><br><a href=\"modules.php?name=$module_name\"><b>"._POLLS."</b></a><br>";

	if ($pollcomm) {
		list($numcom) = $db->sql_fetchrow($db->sql_query("select count(*) from ".$prefix."_pollcomments where pollID='$pollID'"));
		$boxContent .= "<br>"._VOTES.": <b>$sum</b> <br> "._PCOMMENTS." <b>$numcom</b>\n\n";
	} else {
		$boxContent .= "<br>"._VOTES." <b>$sum</b>\n\n";
	}
	$boxContent .= "</font></center></form>\n\n";
	themesidebox($boxTitle, $boxContent);
}

function pollLatest() {
	global $prefix, $multilingual, $currentlang, $db;
	if ($multilingual == 1) {
		$querylang = "WHERE planguage='$currentlang' AND artid='0'";
	} else {
		$querylang = "WHERE artid='0'";
	}
	$pollID = $db->sql_fetchrow($db->sql_query("SELECT pollID FROM ".$prefix."_poll_desc $querylang ORDER BY pollID DESC LIMIT 1"));
	return $pollID[0];
}

function pollNewest() {
	$pollID = pollLatest();
	pollMain($pollID);
}

function pollCollector($pollID, $voteID) {
	global $HTTP_COOKIE_VARS, $prefix, $db, $module_name;
	/* Fix for lamers that like to cheat on polls */
	if (empty($ip)) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	$pollID = intval($pollID);
	$voteID = intval($voteID);
	$past = time()-1800;
	$db->sql_query("DELETE FROM ".$prefix."_poll_check WHERE time < '$past'");
	$row = $db->sql_fetchrow($db->sql_query("SELECT ip FROM ".$prefix."_poll_check WHERE (ip='$ip') AND (pollID='$pollID')"));
	$ips = $row['ip'];
	$ctime = time();
	if ($ip == $ips) {
		$voteValid = 0;
	} else {
		$db->sql_query("INSERT INTO ".$prefix."_poll_check (ip, time, pollID) VALUES ('$ip', '$ctime', '$pollID')");
		$voteValid = "1";
	}
	/* Fix end */
	/* update database if the vote is valid */
	if($voteValid>0) {
		$db->sql_query("UPDATE ".$prefix."_poll_data SET optionCount=optionCount+1 WHERE pollID='$pollID' AND voteID='$voteID'");
		if (!empty($voteID)) {
			$db->sql_query("UPDATE ".$prefix."_poll_desc SET voters=voters+1 WHERE pollID='$pollID'");
			update_points(8);
		}
		Header("Location: modules.php?name=$module_name&op=results&pollID=$pollID");
	} else {
		Header("Location: modules.php?name=$module_name&op=results&pollID=$pollID");
	}
	/* a lot of browsers can't handle it if there's an empty page */
	echo "<html><head></head><body></body></html>";
}

function pollList() {
	global $user, $cookie, $prefix, $multilingual, $currentlang, $admin, $module_name, $db, $admin_file, $userinfo;
	$r_options = "";
	if (isset($userinfo['umode'])) { $r_options .= "&amp;mode=".$userinfo['umode']; }
	if (isset($userinfo['uorder'])) { $r_options .= "&amp;order=".$userinfo['uorder']; }
	if (isset($userinfo['thold'])) { $r_options .= "&amp;thold=".$userinfo['thold']; }
	if ($multilingual == 1) {
		$querylang = "WHERE planguage='$currentlang' AND artid='0'";
	} else {
		$querylang = "WHERE artid='0'";
	}
	$result = $db->sql_query("SELECT pollID, pollTitle, timeStamp, voters FROM ".$prefix."_poll_desc $querylang ORDER BY timeStamp DESC");
	$counter = 0;
	OpenTable();
	OpenTable();
	echo "<center><font class=\"title\"><b>"._PASTSURVEYS."</b></font></center>";
	CloseTable();
	echo "<table border=\"0\" cellpadding=\"8\"><tr><td>";
	while($row = $db->sql_fetchrow($result)) {
		$resultArray[$counter] = array($row['pollID'], $row['pollTitle'], $row['timeStamp'], $row['voters']);
		$counter++;
	}
	for ($count = 0; $count < count($resultArray); $count++) {
		$id = $resultArray[$count][0];
		$id = intval($id);
		$sum = 0;	
		$pollTitle = $resultArray[$count][1];
		$voters = $resultArray[$count][3];
		for($i = 0; $i < 12; $i++) {
			$result2 = $db->sql_query("SELECT optionCount FROM ".$prefix."_poll_data WHERE pollID='$id' AND voteID='$i'");
			$row2 = $db->sql_fetchrow($result2);
			$optionCount = $row2['optionCount'];
			$sum = (int)$sum+$optionCount;
		}
		echo "<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=$module_name&amp;pollID=$id\">$pollTitle</a> ";
		if (is_admin($admin)) {
			$editing = " - <a href=\"".$admin_file.".php?op=polledit&amp;pollID=$id\">Edit</a>";
		} else {
			$editing = "";
		}
		echo "(<a href=\"modules.php?name=$module_name&amp;op=results&amp;pollID=$id$r_options\">"._RESULTS."</a> - $sum "._LVOTES."$editing)<br>\n";
		$sum = 0;
	}
	echo "</td></tr></table>";
	echo "<table border=\"0\" cellpadding=\"8\"><tr><td>";
	if ($multilingual == 1) {
		$querylang = "WHERE planguage='$currentlang' AND artid!='0'";
	} else {
		$querylang = "WHERE artid!='0'";
	}
	$counter = 0;
	$result3 = $db->sql_query("SELECT pollID, pollTitle, timeStamp, voters FROM ".$prefix."_poll_desc $querylang ORDER BY timeStamp DESC");
	while($row3 = $db->sql_fetchrow($result3)) {
		$resultArray2[$counter] = array($row3['pollID'], $row3['pollTitle'], $row3['timeStamp'], $row3['voters']);
		$counter++;
	}
	if ($counter > 0) {
		OpenTable();
		echo "<center><font class=\"title\"><b>"._SURVEYSATTACHED."</b></font></center>";
		CloseTable();
	}
	for ($count = 0; $count < count($resultArray2); $count++) {
		$id = $resultArray2[$count][0];
		$id = intval($id);
		$sum = 0;	
		$pollTitle = $resultArray2[$count][1];
		$voters = $resultArray2[$count][3];
		for($i = 0; $i < 12; $i++) {
			$result4 = $db->sql_query("SELECT optionCount FROM ".$prefix."_poll_data WHERE pollID='$id' AND voteID='$i'");
			$row4 = $db->sql_fetchrow($result4);
			$optionCount = $row4['optionCount'];
			$sum = (int)$sum+$optionCount;
		}
		echo "<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=$module_name&amp;pollID=$id\">$pollTitle</a> ";
		if (is_admin($admin)) {
			$editing = " - <a href=\"".$admin_file.".php?op=polledit&amp;pollID=$id\">Edit</a>";
		} else {
			$editing = "";
		}
		$res = $db->sql_query("select sid, title from ".$prefix."_stories where pollID='$id'");
		list($sid, $title) = $db->sql_fetchrow($res);
		$sid = intval($sid);
		$title = filter($title, "nohtml");
		echo "(<a href=\"modules.php?name=$module_name&amp;op=results&amp;pollID=$id$r_options\">"._RESULTS."</a> - $sum "._LVOTES."$editing)<br>\n"
		.""._ATTACHEDTOARTICLE." <a href=\"modules.php?name=News&amp;file=article&amp;sid=$sid$r_options\">$title</a><br><br>\n";
		$sum = "";
	}
	echo "</td></tr></table>";
	CloseTable();
}

function pollResults($pollID) {
	global $resultTableBgColor, $resultBarFile, $Default_Theme, $user, $cookie, $prefix, $admin, $module_name, $db, $admin_file, $userinfo;
	if (is_user($user)) {
		getusrinfo($user);
		cookiedecode($user);
	}
	if(!isset($pollID)) $pollID = 1;
	$pollID = intval($pollID);
	$result = $db->sql_query("SELECT pollID, pollTitle, timeStamp, artid FROM ".$prefix."_poll_desc WHERE pollID='$pollID'");
	$holdtitle = $db->sql_fetchrow($result);
	echo "<b>$holdtitle[1]</b><br><br>";
	$sum = 0;	
	for($i = 0; $i < 12; $i++) {
		$result2 = $db->sql_query("SELECT optionCount FROM ".$prefix."_poll_data WHERE pollID='$pollID' AND voteID='$i'");
		$row2 = $db->sql_fetchrow($result2);
		$optionCount = $row2['optionCount'];
		$sum = (int)$sum+$optionCount;
	}
	echo "<table border=\"0\">";
	/* cycle through all options */
	for($i = 1; $i <= 12; $i++) {
		/* select next vote option */
		$result3 = $db->sql_query("SELECT pollID, optionText, optionCount, voteID FROM ".$prefix."_poll_data WHERE pollID='$pollID' AND voteID='$i'");
		$row3 = $db->sql_fetchrow($result3);
			$optionText = $row3['optionText'];
			$optionCount = $row3['optionCount'];
			if(!empty($optionText)) {
				echo "<tr><td>";
				echo "$optionText";
				echo "</td>";
				if($sum) {
					$percent = 100 * $optionCount / $sum;
				} else {
					$percent = 0;
				}
				echo "<td>";
				$percentInt = (int)$percent * 4 * 1;
				$percent2 = (int)$percent;
                                $ThemeSel = get_theme();
				if (file_exists("themes/$ThemeSel/images/survey_leftbar.gif") AND file_exists("themes/$ThemeSel/images/survey_mainbar.gif") AND file_exists("themes/$ThemeSel/images/survey_rightbar.gif")) {
					$l_size = getimagesize("themes/$ThemeSel/images/survey_leftbar.gif");
					$m_size = getimagesize("themes/$ThemeSel/images/survey_mainbar.gif");
					$r_size = getimagesize("themes/$ThemeSel/images/survey_rightbar.gif");
					$leftbar = "survey_leftbar.gif";
					$mainbar = "survey_mainbar.gif";
					$rightbar = "survey_rightbar.gif";
				} else {
					$l_size = getimagesize("themes/$ThemeSel/images/leftbar.gif");
					$m_size = getimagesize("themes/$ThemeSel/images/mainbar.gif");
					$r_size = getimagesize("themes/$ThemeSel/images/rightbar.gif");
					$leftbar = "leftbar.gif";
					$mainbar = "mainbar.gif";
					$rightbar = "rightbar.gif";
				}
				if (file_exists("themes/$ThemeSel/images/survey_mainbar_d.gif")) {
					$m1_size = getimagesize("themes/$ThemeSel/images/survey_mainbar_d.gif");
					$mainbar_d = "survey_mainbar_d.gif";
					if ($percent2 > 0 AND $percent2 <= 23) {
						$salto = "<img src=\"themes/$ThemeSel/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"$percentInt\">";
					} elseif ($percent2 > 24 AND $percent2 < 50) {
						$a = $percentInt - 100;
						$salto = "<img src=\"themes/$ThemeSel/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"70\">"
						."<img src=\"themes/$ThemeSel/images/$mainbar_d\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m1_size[1]\" width=\"30\">"
						."<img src=\"themes/$ThemeSel/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"$a\">";
					} elseif ($percent2 > 49 AND $percent2 < 75) {
						$a = $percentInt - 200;
						$salto = "<img src=\"themes/$ThemeSel/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"70\">"
						."<img src=\"themes/$ThemeSel/images/$mainbar_d\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m1_size[1]\" width=\"30\">"
						."<img src=\"themes/$ThemeSel/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"70\">"
						."<img src=\"themes/$ThemeSel/images/$mainbar_d\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m1_size[1]\" width=\"30\">"
						."<img src=\"themes/$ThemeSel/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"$a\">";
					} elseif ($percent2 > 74 AND $percent2 <= 100) {
						$a = $percentInt - 300;
						$salto = "<img src=\"themes/$ThemeSel/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"70\">"
						."<img src=\"themes/$ThemeSel/images/$mainbar_d\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m1_size[1]\" width=\"30\">"
						."<img src=\"themes/$ThemeSel/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"70\">"
						."<img src=\"themes/$ThemeSel/images/$mainbar_d\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m1_size[1]\" width=\"30\">"
						."<img src=\"themes/$ThemeSel/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"70\">"
						."<img src=\"themes/$ThemeSel/images/$mainbar_d\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m1_size[1]\" width=\"30\">"
						."<img src=\"themes/$ThemeSel/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"$a\">";
					}
				}
				if ($percent > 0) {
					echo "<img src=\"themes/$ThemeSel/images/$leftbar\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\">";
					if (file_exists("themes/$ThemeSel/images/survey_mainbar_d.gif")) {
						echo "$salto";
					} else {
						echo "<img src=\"themes/$ThemeSel/images/$mainbar\" height=\"$m_size[1]\" width=\"$percentInt\" alt=\"$percent2 %\" title=\"$percent2 %\">";
					}
					echo "<img src=\"themes/$ThemeSel/images/$rightbar\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\">";
				} else {
					echo "<img src=\"themes/$ThemeSel/images/$leftbar\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\">";
					if (!file_exists("themes/$ThemeSel/images/survey_mainbar_d.gif")) {
						echo "<img src=\"themes/$ThemeSel/images/$mainbar\" height=\"$m_size[1]\" width=\"$m_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\">";
					}
					echo "<img src=\"themes/$ThemeSel/images/$rightbar\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\">";
				}
				printf(" %.2f%% (%s)", $percent, $optionCount);
				echo "</td></tr>";
		}

	}
	echo "</table><br>";
	echo "<center><font class=\"content\">";
	echo "<b>"._TOTALVOTES." $sum</b><br>";
	echo "<br><br>";
	$booth = $pollID;
	$booth = intval($booth);
	if ($holdtitle[3] > 0) {
		$article = "<br><br>"._GOBACK."</font></center>";
	} else {
		$article = "</font></center>";
	}
	echo "[ <a href=\"modules.php?name=$module_name&amp;pollID=$booth\">"._VOTING."</a> | "
	."<a href=\"modules.php?name=$module_name\">"._OTHERPOLLS."</a> ] $article";
	if (is_admin($admin)) {
		echo "<br><center>[ <a href=\"".$admin_file.".php?op=create\">"._ADD."</a> | <a href=\"".$admin_file.".php?op=polledit&amp;pollID=$pollID\">"._EDIT."</a> ]</center>";
	}
	return(1);
}

?>