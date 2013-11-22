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

if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}

global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Surveys'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
	if ($row2['name'] == "$admins[$i]" AND !empty($row['admins'])) {
		$auth_user = 1;
	}
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {

	/*********************************************************/
	/* Poll/Surveys Functions                                */
	/*********************************************************/

	function puthome($ihome, $acomm) {
		$ihome = intval($ihome);
		$acomm = intval($acomm);
		echo "<br><b>" . _PUBLISHINHOME . "</b>&nbsp;&nbsp;";
		if (($ihome == 0) OR ($ihome == "")) {
			$sel1 = "checked";
			$sel2 = "";
		}
		if ($ihome == 1) {
			$sel1 = "";
			$sel2 = "checked";
		}
		echo "<input type=\"radio\" name=\"ihome\" value=\"0\" $sel1>" . _YES . "&nbsp;"
		."<input type=\"radio\" name=\"ihome\" value=\"1\" $sel2>" . _NO . ""
		."&nbsp;&nbsp;<font class=\"content\">[ " . _ONLYIFCATSELECTED . " ]</font><br>";

		echo "<br><b>" . _ACTIVATECOMMENTS . "</b>&nbsp;&nbsp;";
		if (($acomm == 0) OR (empty($acomm))) {
			$sel1 = "checked";
			$sel2 = "";
		}
		if ($acomm == 1) {
			$sel1 = "";
			$sel2 = "checked";
		}
		echo "<input type=\"radio\" name=\"acomm\" value=\"0\" $sel1>" . _YES . "&nbsp;"
		."<input type=\"radio\" name=\"acomm\" value=\"1\" $sel2>" . _NO . "</font><br><br>";
	}

	function SelectCategory($cat) {
		global $prefix, $db, $admin_file;
		$cat = intval($cat);
		$selcat = $db->sql_query("SELECT catid, title from " . $prefix . "_stories_cat order by title");
		$a = 1;
		echo "<b>" . _CATEGORY . "</b> ";
		echo "<select name=\"catid\">";
		if ($cat == 0) {
			$sel = "selected";
		} else {
			$sel = "";
		}
		echo "<option name=\"catid\" value=\"0\" $sel>" . _ARTICLES . "</option>";
		while ($row = $db->sql_fetchrow($selcat)) {
			$catid = intval($row['catid']);
			$title = filter($row['title'], "nohtml");
			if ($catid == $cat) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			echo "<option name=\"catid\" value=\"$catid\" $sel>$title</option>";
			$a++;
		}
		echo "</select> [ <a href=\"".$admin_file.".php?op=AddCategory\">" . _ADD . "</a> | <a href=\"".$admin_file.".php?op=EditCategory\">" . _EDIT . "</a> | <a href=\"".$admin_file.".php?op=DelCategory\">" . _DELETE . "</a> ]";
	}

	function poll_createPoll() {
		global $language, $admin, $multilingual, $prefix, $db, $admin_file;
		include ('header.php');
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>" . _POLLSADMIN . "</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"option\"><b>" . _CREATEPOLL . "</b></font><br><br>"
		."[ <a href=\"".$admin_file.".php?op=remove\">" . _DELETEPOLLS . "</a> | <a href=\"".$admin_file.".php?op=polledit_select\">" . _EDITPOLL . "</a> ]</center><br><br>"
		."<form action=\"".$admin_file.".php\" method=\"post\">"
		."" . _POLLTITLE . ": <input type=\"text\" name=\"pollTitle\" size=\"50\" maxlength=\"100\"><br><br>";
		if ($multilingual == 1) {
			echo "<br>" . _LANGUAGE . ": "
			."<select name=\"planguage\">";
			$handle=opendir('language');
			while ($file = readdir($handle)) {
				if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
					$langFound = $matches[1];
					$languageslist .= "$langFound ";
				}
			}
			closedir($handle);
			$languageslist = explode(" ", $languageslist);
			sort($languageslist);
			for ($h=0; $h < sizeof($languageslist); $h++) {
				if(!empty($languageslist[$h])) {
					echo "<option value=\"$languageslist[$h]\" ";
					if($languageslist[$h]==$language) echo "selected";
					echo ">" . ucfirst($languageslist[$h]) . "</option>\n";
				}
			}
			echo "</select><br><br>";
		} else {
			echo "<input type=\"hidden\" name=\"planguage\" value=\"$language\"><br><br>";
		}
		echo "<font class=\"content\">" . _POLLEACHFIELD . "</font><br>"
		."<table border=\"0\">";
		for($i = 1; $i <= 12; $i++)	{
			echo "<tr>"
			."<td>" . _OPTION . " $i:</td><td><input type=\"text\" name=\"optionText[$i]\" size=\"50\" maxlength=\"50\"></td>"
			."</tr>";
		}
		echo "</table>"
		."<br><br><center><hr size=\"1\" noshade><font class=\"option\"><b>" . _ANNOUNCEPOLL . "</b></font><br>"
		."<font class=\"tiny\">" . _LEAVEBLANK . "</font></center>"
		."<br><br><b>" . _TITLE . ":</b><br>"
		."<input type=\"text\" name=\"title\" size=\"40\"><br><br>";
		$cat = 0;
		$ihome = 0;
		$acomm = 0;
		SelectCategory($cat);
		echo "<br>";
		puthome($ihome, $acomm);
		echo "<b>" . _TOPIC . "</b> <select name=\"topic\">";
		$toplist = $db->sql_query("SELECT topicid, topictext from " . $prefix . "_topics order by topictext");
		echo "<option value=\"\">" . _SELECTTOPIC . "</option>\n";
		while ($row = $db->sql_fetchrow($toplist)) {
			$topicid = intval($row['topicid']);
			$topics = filter($row['topictext'], "nohtml");
			echo "<option value=\"$topicid\">$topics</option>\n";
		}
		echo "</select>";
		echo "<br><br><b>" . _STORYTEXT . "</b><br>"
		."<textarea wrap=\"virtual\" cols=\"70\" rows=\"15\" name=\"hometext\">$story</textarea><br><br>"
		."<b>" . _EXTENDEDTEXT . "</b><br>"
		."<textarea wrap=\"virtual\" cols=\"70\" rows=\"15\" name=\"bodytext\"></textarea><BR>"
		."<br><br>"
		."<input type=\"hidden\" name=\"op\" value=\"createPosted\">"
		."<input type=\"submit\" value=\"" . _CREATEPOLLBUT . "\">"
		."</form>";
		CloseTable();
		include ('footer.php');
	}

	function old_poll_createPosted() {
		global $pollTitle, $optionText, $prefix, $db, $planguage, $admin_file;
		$timeStamp = time();
		$pollTitle = filter($pollTitle, "nohtml", 1);
		$res = $db->sql_query("INSERT INTO " . $prefix . "_poll_desc VALUES (NULL, '$pollTitle', '$timeStamp', '$planguage', '0', '0')");
		if (!$res)	{
			return;
		}
		/* create option records in data table */
		for($i = 1; $i <= 12; $i++) {
			if($optionText[$i] != "") {
				$result = $db->sql_query("INSERT INTO " . $prefix . "_poll_data VALUES ('$id', '$optionText[$i]', '0', '$i')");
			}
			if (!result) {
				return;
			}
		}
		Header("Location: ".$admin_file.".php?op=adminMain");
	}

	function poll_createPosted($pollTitle, $optionText, $planguage, $title, $hometext, $topic, $bodytext, $catid, $ihome, $acomm) {
		global $prefix, $db, $aid, $admin_file;
		$timeStamp = time();
		$pollTitle = filter($pollTitle, "nohtml", 1);
		if(!$db->sql_query("INSERT INTO " . $prefix . "_poll_desc VALUES (NULL, '$pollTitle', '$timeStamp', '0', '$planguage', '0', '0')")) {
			return;
		}
		$object = $db->sql_fetchrow($db->sql_query("SELECT pollID FROM ".$prefix."_poll_desc WHERE pollTitle='$pollTitle'"));
		$id = $object['pollID'];
		$id = intval($id);
		for($i = 1; $i <= sizeof($optionText); $i++) {
			if(!empty($optionText[$i])) {
				$optionText[$i] = filter($optionText[$i], "nohtml", 1);
			}
			if(!$db->sql_query("INSERT INTO " . $prefix . "_poll_data (pollID, optionText, optionCount, voteID) VALUES ('$id', '$optionText[$i]', '0', '$i')")) {
				return;
			}
		}
		if ((!empty($title)) AND (!empty($hometext))) {
			$title = filter($title, "nohtml", 1);
			$hometext = filter($hometext, "", 1);
			$bodytext = filter($bodytext, "", 1);
			$result = $db->sql_query("insert into ".$prefix."_stories values (NULL, '$catid', '$aid', '$title', now(), '$hometext', '$bodytext', '0', '0', '$topic', '$aid', '', '$ihome', '$planguage', '$acomm', '0', '0', '0', '0', '', '')");
		}
		Header("Location: ".$admin_file.".php?op=adminMain");
	}

	function poll_removePoll() {
		global $prefix, $db, $admin_file;
		include ('header.php');
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>" . _POLLSADMIN . "</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"option\"><b>" . _REMOVEEXISTING . "</b></font><br><br>"
		."" . _POLLDELWARNING . "</center><br><br>"
		."" . _CHOOSEPOLL . "<br>"
		."<form action=\"".$admin_file.".php\" method=\"post\">"
		."<input type=\"hidden\" name=\"op\" value=\"removePosted\">"
		."<table border=\"0\">";
		$result = $db->sql_query("SELECT pollID, pollTitle, timeStamp, planguage FROM ".$prefix."_poll_desc ORDER BY timeStamp");
		if(!$result) {
			return;
		}
		/* cycle through the descriptions until everyone has been fetched */
		while($object = $db->sql_fetchrow($result)) {
			$pollID = $object['pollID'];
			$pollID = intval($pollID);
			$object['pollTitle'] = filter($object['pollTitle'], "nohtml");
			echo "<tr><td><input type=\"radio\" name=\"id\" value=\"".$object['pollID']."\">".$object['pollTitle']." - (".$object['planguage'].")</td></tr>";
		}
		echo "</table>";
		echo "<input type=\"submit\" value=\"" . _DELETE . "\">";
		echo "</form>";
		CloseTable();
		include ('footer.php');
	}

	function poll_removePosted() {
		global $id, $prefix, $db, $admin_file;
		$id = intval($id);
		$db->sql_query("DELETE FROM " . $prefix . "_poll_desc WHERE pollID='$id'");
		$db->sql_query("DELETE FROM " . $prefix . "_poll_data WHERE pollID='$id'");
		Header("Location: ".$admin_file.".php?op=adminMain");
	}

	function polledit_select() {
		global $prefix, $db, $admin_file;
		include ('header.php');
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>" . _POLLSADMIN . "</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"option\"><b>" . _EDITPOLL . "</b></font></center><br><br>"
		."" . _CHOOSEPOLLEDIT . "<br>"
		."<form action=\"".$admin_file.".php\" method=\"post\">"
		."<input type=\"hidden\" name=\"op\" value=\"polledit\">"
		."<table border=\"0\">";
		$result = $db->sql_query("SELECT pollID, pollTitle, timeStamp, planguage FROM ".$prefix."_poll_desc ORDER BY timeStamp");
		if(!$result) {
			return;
		}
		/* cycle through the descriptions until everyone has been fetched */
		while($object = $db->sql_fetchrow($result)) {
			$pollID = $object['pollID'];
			$pollID = intval($pollID);
			$object['pollTitle'] = filter($object['pollTitle'], "nohtml");
			echo "<tr><td><input type=\"radio\" name=\"pollID\" value=\"".$object['pollID']."\">".$object['pollTitle']." - (".$object['planguage'].")</td></tr>";
		}
		echo "</table>";
		echo "<input type=\"submit\" value=\"" . _EDIT . "\">";
		echo "</form>";
		CloseTable();
		include ('footer.php');
	}

	function polledit($pollID) {
		global $prefix, $db, $multilingual, $admin_file;
		include ('header.php');
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>" . _POLLSADMIN . "</b></font></center>";
		$pollID = intval($pollID);
		$row = $db->sql_fetchrow($db->sql_query("SELECT pollTitle, planguage from " . $prefix . "_poll_desc where pollID='$pollID'"));
		$pollTitle = filter($row['pollTitle'], "nohtml");
		$planguage = $row['planguage'];
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><b>"._POLLEDIT." $pollTitle</b></center><br><br>";
		echo "<form action=\"".$admin_file.".php\" method=\"post\">";
		echo "<table border=\"0\" align=\"center\"><tr><td align=\"right\">";
		echo "<b>" . _TITLE . ":</b></td><td colspan=\"2\"><input type=\"text\" name=\"pollTitle\" value=\"$pollTitle\" size=\"40\" maxlength=\"100\"></td></tr>";
		if ($multilingual == 1) {
			echo "<tr><td><b>" . _LANGUAGE . ":</b></td><td>"
			."<select name=\"planguage\">";
			$handle=opendir('language');
			while ($file = readdir($handle)) {
				if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
					$langFound = $matches[1];
					$languageslist .= "$langFound ";
				}
			}
			closedir($handle);
			$languageslist = explode(" ", $languageslist);
			sort($languageslist);
			for ($h=0; $h < sizeof($languageslist); $h++) {
				if($languageslist[$h]!="") {
					echo "<option value=\"$languageslist[$h]\" ";
					if($languageslist[$h]==$planguage) echo "selected";
					echo ">".ucfirst($languageslist[$h])."</option>\n";
				}
			}
			echo "</select><br><br>";
			echo "</td></tr>";
		} else {
			echo "<input type=\"hidden\" name=\"planguage\" value=\"$planguage\"><br><br>";
		}
		$result2 = $db->sql_query("SELECT optionText, optionCount, voteID from ".$prefix."_poll_data where pollID='$pollID' order by voteID");
		while ($row2 = $db->sql_fetchrow($result2)) {
			$optionText = filter($row2['optionText'], "nohtml");
			$optionCount = intval($row2['optionCount']);
			$voteID = intval($row2['voteID']);
			echo "<tr><td align=\"right\"><b>" . _OPTION . " $voteID:</b></td><td><input type=\"text\" name=\"optiontext$voteID\" value=\"$optionText\" size=\"40\" maxlength=\"50\"></td><td align=\"right\">$optionCount "._VOTES."</td></tr>";
		}
		echo "</table><input type=\"hidden\" name=\"pollID\" value=\"$pollID\"><input type=\"hidden\" name=\"op\" value=\"savepoll\">"
		."<br><br><center><input type=\"submit\" value=\"" . _SAVECHANGES . "\"><br>" . _GOBACK . "</center><br><br></form>";
		CloseTable();
		include("footer.php");
	}

	function savepoll($pollID, $pollTitle, $planguage, $optiontext1, $optiontext2, $optiontext3, $optiontext4, $optiontext5, $optiontext6, $optiontext7, $optiontext8, $optiontext9, $optiontext10, $optiontext11, $optiontext12) {
		global $prefix, $db, $admin_file;
		$pollID = intval($pollID);
		$pollTitle = filter($pollTitle, "nohtml", 1);
		for ($i=0; $i<12; $i++) {
			$a = $i++;
			$optiontext[$a] = filter($optiontext[$a], "nohtml", 1);
		}
		$result = $db->sql_query("update " . $prefix . "_poll_desc set pollTitle='$pollTitle', planguage='$planguage' where pollID='$pollID'");
		$result = $db->sql_query("update " . $prefix . "_poll_data set optionText='$optiontext1' where voteID='1' AND pollID='$pollID'");
		$result = $db->sql_query("update " . $prefix . "_poll_data set optionText='$optiontext2' where voteID='2' AND pollID='$pollID'");
		$result = $db->sql_query("update " . $prefix . "_poll_data set optionText='$optiontext3' where voteID='3' AND pollID='$pollID'");
		$result = $db->sql_query("update " . $prefix . "_poll_data set optionText='$optiontext4' where voteID='4' AND pollID='$pollID'");
		$result = $db->sql_query("update " . $prefix . "_poll_data set optionText='$optiontext5' where voteID='5' AND pollID='$pollID'");
		$result = $db->sql_query("update " . $prefix . "_poll_data set optionText='$optiontext6' where voteID='6' AND pollID='$pollID'");
		$result = $db->sql_query("update " . $prefix . "_poll_data set optionText='$optiontext7' where voteID='7' AND pollID='$pollID'");
		$result = $db->sql_query("update " . $prefix . "_poll_data set optionText='$optiontext8' where voteID='8' AND pollID='$pollID'");
		$result = $db->sql_query("update " . $prefix . "_poll_data set optionText='$optiontext9' where voteID='9' AND pollID='$pollID'");
		$result = $db->sql_query("update " . $prefix . "_poll_data set optionText='$optiontext10' where voteID='10' AND pollID='$pollID'");
		$result = $db->sql_query("update " . $prefix . "_poll_data set optionText='$optiontext11' where voteID='11' AND pollID='$pollID'");
		$result = $db->sql_query("update " . $prefix . "_poll_data set optionText='$optiontext12' where voteID='12' AND pollID='$pollID'");
		Header("Location: ".$admin_file.".php");
	}

	switch($op) {

		case "create":
		poll_createPoll();
		break;

		case "createPosted":
		poll_createPosted($pollTitle, $optionText, $planguage, $title, $hometext, $topic, $bodytext, $catid, $ihome, $acomm);
		break;

		case "ChangePoll":
		ChangePoll($pollID, $pollTitle, $optionText, $voteID);
		break;

		case "remove":
		poll_removePoll();
		break;

		case "removePosted":
		poll_removePosted();
		break;

		case "polledit":
		polledit($pollID);
		break;

		case "savepoll":
		savepoll($pollID, $pollTitle, $planguage, $optiontext1, $optiontext2, $optiontext3, $optiontext4, $optiontext5, $optiontext6, $optiontext7, $optiontext8, $optiontext9, $optiontext10, $optiontext11, $optiontext12);
		break;

		case "polledit_select":
		polledit_select();
		break;

	}

} else {
	include("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<center><b>"._ERROR."</b><br><br>You do not have administration permission for module \"$module_name\"</center>";
	CloseTable();
	include("footer.php");
}

?>