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
$aid = substr($aid, 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='News'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
	if ($row2['name'] == "$admins[$i]" AND !empty($row['admins'])) {
		$auth_user = 1;
	}
}

if ($row2['radminsuper'] == 1) {
	$radminsuper = 1;
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {

	/*********************************************************/
	/* Story/News Functions                                  */
	/*********************************************************/

	function puthome($ihome, $acomm) {
		echo "<br><b>"._PUBLISHINHOME."</b>&nbsp;&nbsp;";
		if (($ihome == 0) OR (empty($ihome))) {
			$sel1 = "checked";
			$sel2 = "";
		}
		if ($ihome == 1) {
			$sel1 = "";
			$sel2 = "checked";
		}
		echo "<input type=\"radio\" name=\"ihome\" value=\"0\" $sel1>"._YES."&nbsp;"
		."<input type=\"radio\" name=\"ihome\" value=\"1\" $sel2>"._NO.""
		."&nbsp;&nbsp;<font class=\"content\">[ "._ONLYIFCATSELECTED." ]</font><br>";

		echo "<br><b>"._ACTIVATECOMMENTS."</b>&nbsp;&nbsp;";
		if (($acomm == 0) OR (empty($acomm))) {
			$sel1 = "checked";
			$sel2 = "";
		}
		if ($acomm == 1) {
			$sel1 = "";
			$sel2 = "checked";
		}
		echo "<input type=\"radio\" name=\"acomm\" value=\"0\" $sel1>"._YES."&nbsp;"
		."<input type=\"radio\" name=\"acomm\" value=\"1\" $sel2>"._NO."</font><br><br>";

	}

	function deleteStory($qid) {
		global $prefix, $db, $admin_file;
		$qid = intval($qid);
		$result = $db->sql_query("delete from ".$prefix."_queue where qid='$qid'");
		if (!$result) {
			return;
		}
		Header("Location: ".$admin_file.".php?op=submissions");
	}

	function SelectCategory($cat) {
		global $prefix, $db, $admin_file;
		$selcat = $db->sql_query("select catid, title from ".$prefix."_stories_cat order by title");
		$a = 1;
		echo "<b>"._CATEGORY."</b> ";
		echo "<select name=\"catid\">";
		if ($cat == 0) {
			$sel = "selected";
		} else {
			$sel = "";
		}
		echo "<option name=\"catid\" value=\"0\" $sel>"._ARTICLES."</option>";
		while(list($catid, $title) = $db->sql_fetchrow($selcat)) {
			$catid = intval($catid);
			$title = filter($title, "nohtml");
			if ($catid == $cat) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			echo "<option name=\"catid\" value=\"$catid\" $sel>$title</option>";
			$a++;
		}
		echo "</select> &nbsp; <a href=\"".$admin_file.".php?op=AddCategory\"><img src=\"images/add.gif\" alt=\""._ADD."\" title=\""._ADD."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=EditCategory\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=DelCategory\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a>";
	}

	function putpoll($pollTitle, $optionText) {
		OpenTable();
		echo "<center><font class=\"title\"><b>"._ATTACHAPOLL."</b></font><br>"
		."<font class=\"tiny\">"._LEAVEBLANKTONOTATTACH."</font><br>"
		."<br><br>"._POLLTITLE.": <input type=\"text\" name=\"pollTitle\" size=\"50\" maxlength=\"100\" value=\"$pollTitle\"><br><br>"
		."<font class=\"content\">"._POLLEACHFIELD."<br>"
		."<table border=\"0\">";
		for($i = 1; $i <= 12; $i++)	{
			echo "<tr>"
			."<td>"._OPTION." $i:</td><td><input type=\"text\" name=\"optionText[$i]\" size=\"50\" maxlength=\"50\" value=\"$optionText[$i]\"></td>"
			."</tr>";
		}
		echo "</table>";
		CloseTable();
	}

	function AddCategory () {
		global $admin_file;
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>"._CATEGORIESADMIN."</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"option\"><b>"._CATEGORYADD."</b></font><br><br><br>"
		."<form action=\"".$admin_file.".php\" method=\"post\">"
		."<b>"._CATNAME.":</b> "
		."<input type=\"text\" name=\"cat_title\" size=\"22\" maxlength=\"20\"> "
		."<input type=\"hidden\" name=\"op\" value=\"SaveCategory\">"
		."<input type=\"submit\" value=\""._SAVE."\">"
		."</form></center>";
		CloseTable();
		include("footer.php");
	}

	function EditCategory($catid) {
		global $prefix, $db, $admin_file;
		$catid = intval($catid);
		$result = $db->sql_query("select title from ".$prefix."_stories_cat where catid='$catid'");
		list($title) = $db->sql_fetchrow($result);
		$title = filter($title, "nohtml");
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>"._CATEGORIESADMIN."</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"option\"><b>"._EDITCATEGORY."</b></font><br>";
		if (!$catid) {
			$selcat = $db->sql_query("select catid, title from ".$prefix."_stories_cat");
			echo "<form action=\"".$admin_file.".php\" method=\"post\">";
			echo "<b>"._ASELECTCATEGORY."</b>";
			echo "<select name=\"catid\">";
			echo "<option name=\"catid\" value=\"0\" $sel>Articles</option>";
			while(list($catid, $title) = $db->sql_fetchrow($selcat)) {
				$catid = intval($catid);
				$title = filter($title, "nohtml");
				echo "<option name=\"catid\" value=\"$catid\" $sel>$title</option>";
			}
			echo "</select>";
			echo "<input type=\"hidden\" name=\"op\" value=\"EditCategory\">";
			echo "<input type=\"submit\" value=\""._EDIT."\"><br><br>";
			echo ""._NOARTCATEDIT."";
		} else {
			echo "<form action=\"".$admin_file.".php\" method=\"post\">";
			echo "<b>"._CATEGORYNAME.":</b> ";
			echo "<input type=\"text\" name=\"title\" size=\"22\" maxlength=\"20\" value=\"$title\"> ";
			echo "<input type=\"hidden\" name=\"catid\" value=\"$catid\">";
			echo "<input type=\"hidden\" name=\"op\" value=\"SaveEditCategory\">";
			echo "<input type=\"submit\" value=\""._SAVECHANGES."\"><br><br>";
			echo ""._NOARTCATEDIT."";
			echo "</form>";
		}
		echo "</center>";
		CloseTable();
		include("footer.php");
	}

	function DelCategory($cat) {
		global $prefix, $db, $admin_file;
		$cat = intval($cat);
		$result = $db->sql_query("select title from ".$prefix."_stories_cat where catid='$cat'");
		list($title) = $db->sql_fetchrow($result);
		$title = filter($title, "nohtml");
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>"._CATEGORIESADMIN."</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"option\"><b>"._DELETECATEGORY."</b></font><br>";
		if (!$cat) {
			$selcat = $db->sql_query("select catid, title from ".$prefix."_stories_cat");
			echo "<form action=\"".$admin_file.".php\" method=\"post\">"
			."<b>"._SELECTCATDEL.": </b>"
			."<select name=\"cat\">";
			while(list($catid, $title) = $db->sql_fetchrow($selcat)) {
				$catid = intval($catid);
				$title = filter($title, "nohtml");
				echo "<option name=\"cat\" value=\"$catid\">$title</option>";
			}
			echo "</select>"
			."<input type=\"hidden\" name=\"op\" value=\"DelCategory\">"
			."<input type=\"submit\" value=\"Delete\">"
			."</form>";
		} else {
			$result2 = $db->sql_query("select * from ".$prefix."_stories where catid='$cat'");
			$numrows = $db->sql_numrows($result2);
			if ($numrows == 0) {
				$db->sql_query("delete from ".$prefix."_stories_cat where catid='$cat'");
				echo "<br><br>"._CATDELETED."<br><br>"._GOTOADMIN."";
			} else {
				echo "<br><br><b>"._WARNING.":</b> "._THECATEGORY." <b>$title</b> "._HAS." <b>$numrows</b> "._STORIESINSIDE."<br>"
				.""._DELCATWARNING1."<br>"
				.""._DELCATWARNING2."<br><br>"
				.""._DELCATWARNING3."<br><br>"
				."<b>[ <a href=\"".$admin_file.".php?op=YesDelCategory&amp;catid=$cat\">"._YESDEL."</a> | "
				."<a href=\"".$admin_file.".php?op=NoMoveCategory&amp;catid=$cat\">"._NOMOVE."</a> ]</b>";
			}
		}
		echo "</center>";
		CloseTable();
		include("footer.php");
	}

	function YesDelCategory($catid) {
		global $prefix, $db, $admin_file;
		$catid = intval($catid);
		$db->sql_query("delete from ".$prefix."_stories_cat where catid='$catid'");
		$result = $db->sql_query("select sid from ".$prefix."_stories where catid='$catid'");
		while(list($sid) = $db->sql_fetchrow($result)) {
			$sid = intval($sid);
			$db->sql_query("delete from ".$prefix."_stories where catid='$catid'");
			$db->sql_query("delete from ".$prefix."_comments where sid='$sid'");
		}
		Header("Location: ".$admin_file.".php");
	}

	function NoMoveCategory($catid, $newcat) {
		global $prefix, $db, $admin_file;
		$catid = intval($catid);
		$newcat = filter($newcat, "nohtml", 1);
		$result = $db->sql_query("select title from ".$prefix."_stories_cat where catid='$catid'");
		list($title) = $db->sql_fetchrow($result);
		$title = filter($title, "nohtml");
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>"._CATEGORIESADMIN."</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"option\"><b>"._MOVESTORIES."</b></font><br><br>";
		if (!$newcat) {
			echo ""._ALLSTORIES." <b>$title</b> "._WILLBEMOVED."<br><br>";
			$selcat = $db->sql_query("select catid, title from ".$prefix."_stories_cat");
			echo "<form action=\"".$admin_file.".php\" method=\"post\">";
			echo "<b>"._SELECTNEWCAT.":</b> ";
			echo "<select name=\"newcat\">";
			echo "<option name=\"newcat\" value=\"0\">"._ARTICLES."</option>";
			while(list($newcat, $title) = $db->sql_fetchrow($selcat)) {
				$title = filter($title, "nohtml");
				echo "<option name=\"newcat\" value=\"$newcat\">$title</option>";
			}
			echo "</select>";
			echo "<input type=\"hidden\" name=\"catid\" value=\"$catid\">";
			echo "<input type=\"hidden\" name=\"op\" value=\"NoMoveCategory\">";
			echo "<input type=\"submit\" value=\""._OK."\">";
			echo "</form>";
		} else {
			$resultm = $db->sql_query("select sid from ".$prefix."_stories where catid='$catid'");
			while(list($sid) = $db->sql_fetchrow($resultm)) {
				$sid = intval($sid);
				$db->sql_query("update ".$prefix."_stories set catid='$newcat' where sid='$sid'");
			}
			$db->sql_query("delete from ".$prefix."_stories_cat where catid='$catid'");
			echo ""._MOVEDONE."";
		}
		CloseTable();
		include("footer.php");
	}

	function SaveEditCategory($catid, $title) {
		global $prefix, $db, $admin_file;
		$title = filter($title, "nohtml", 1);
		$result = $db->sql_query("select catid from ".$prefix."_stories_cat where title='$title'");
		$catid = intval($catid);
		$check = $db->sql_numrows($result);
		if ($check) {
			$what1 = _CATEXISTS;
			$what2 = _GOBACK;
		} else {
			$what1 = _CATSAVED;
			$what2 = "[ <a href=\"".$admin_file.".php\">"._GOTOADMIN."</a> ]";
			$result = $db->sql_query("update ".$prefix."_stories_cat set title='$title' where catid='$catid'");
			if (!$result) {
				return;
			}
		}
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>"._CATEGORIESADMIN."</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"content\"><b>$what1</b></font><br><br>";
		echo "$what2</center>";
		CloseTable();
		include("footer.php");
	}

	function SaveCategory($title) {
		global $prefix, $db;
		$title = filter($title, "nohtml", 1);
		$result = $db->sql_query("select catid from ".$prefix."_stories_cat where title='$title'");
		$check = $db->sql_numrows($result);
		if ($check) {
			$what1 = _CATEXISTS;
			$what2 = _GOBACK;
		} else {
			$what1 = _CATADDED;
			$what2 = _GOTOADMIN;
			$result = $db->sql_query("insert into ".$prefix."_stories_cat values (NULL, '$title', '0')");
			if (!$result) {
				return;
			}
		}
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>"._CATEGORIESADMIN."</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"content\"><b>$what1</b></font><br><br>";
		echo "$what2</center>";
		CloseTable();
		include("footer.php");
	}

	function autodelete($anid) {
		global $prefix, $db, $admin_file;
		$anid = intval($anid);
		$db->sql_query("delete from ".$prefix."_autonews where anid='$anid'");
		Header("Location: ".$admin_file.".php?op=adminMain");
	}

	function publish_now($anid) {
		global $prefix, $db, $admin_file;
		$anid = intval($anid);
		$result2 = $db->sql_query("SELECT * FROM ".$prefix."_autonews WHERE anid='$anid'");
		while ($row2 = $db->sql_fetchrow($result2)) {
			$title = $row2['title'];
			$hometext = filter($row2['hometext']);
			$bodytext = filter($row2['bodytext']);
			$notes = filter($row2['notes']);
			$catid2 = intval($row2['catid']);
			$aid2 = filter($row2['aid'], "nohtml");
			$topic2 = intval($row2['topic']);
			$informant2 = filter($row2['informant'], "nohtml");
			$ihome2 = intval($row2['ihome']);
			$alanguage2 = $row2['alanguage'];
			$acomm2 = intval($row2['acomm']);
			$associated2 = $row2['associated'];
			// Prepare and filter variables to be saved
			$hometext = filter($hometext, "", 1);
			$bodytext = filter($bodytext, "", 1);
			$notes = filter($notes, "", 1);
			$aid2 = filter($aid2, "nohtml", 1);
			$informant2 = filter($informant2, "nohtml", 1);
			$db->sql_query("DELETE FROM ".$prefix."_autonews WHERE anid='$anid'");
			$db->sql_query("INSERT INTO ".$prefix."_stories VALUES (NULL, '$catid2', '$aid2', '$title', now(), '$hometext', '$bodytext', '0', '0', '$topic2', '$informant2', '$notes', '$ihome2', '$alanguage2', '$acomm2', '0', '0', '0', '0', '0', '$associated2')");
		}
		Header("Location: ".$admin_file.".php?op=adminMain");
		fdie();
	}

	function autoEdit($anid) {
		global $aid, $bgcolor1, $bgcolor2, $prefix, $db, $multilingual, $admin_file;
		$sid = intval($sid);
		$aid = substr("$aid", 0,25);
		$result = $db->sql_query("select radminsuper from ".$prefix."_authors where aid='$aid'");
		list($radminsuper) = $db->sql_fetchrow($result);
		$radminsuper = intval($radminsuper);
		$result = $db->sql_query("SELECT admins FROM ".$prefix."_modules WHERE title='News'");
		$row2 = $db->sql_fetchrow($db->sql_query("SELECT name FROM ".$prefix."_authors WHERE aid='$aid'"));
		while ($row = $db->sql_fetchrow($result)) {
			$admins = explode(",", $row['admins']);
			$auth_user = 0;
			for ($i=0; $i < sizeof($admins); $i++) {
				if ($row2['name'] == $admins[$i]) {
					$auth_user = 1;
				}
			}
			if ($auth_user == 1) {
				$radminarticle = 1;
			}
		}
		$result2 = $db->sql_query("select aid from ".$prefix."_stories where sid='$sid'");
		list($aaid) = $db->sql_fetchrow($result2);
		$aaid = substr("$aaid", 0,25);
		if (($radminarticle == 1) AND ($aaid == $aid) OR ($radminsuper == 1)) {
			include ("header.php");
			$result = $db->sql_query("select catid, aid, title, time, hometext, bodytext, topic, informant, notes, ihome, alanguage, acomm from ".$prefix."_autonews where anid='$anid'");
			list($catid, $aid, $title, $time, $hometext, $bodytext, $topic, $informant, $notes, $ihome, $alanguage, $acomm) = $db->sql_fetchrow($result);
			$catid = intval($catid);
			$aid = substr("$aid", 0,25);
			$informant = substr("$informant", 0,25);
			$ihome = intval($ihome);
			$acomm = intval($acomm);
			ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $time, $datetime);
			GraphicAdmin();
			OpenTable();
			echo "<center><font class=\"title\"><b>"._ARTICLEADMIN."</b></font></center>";
			CloseTable();
			echo "<br>";
			OpenTable();
			$today = getdate();
			$tday = $today['mday'];
			if ($tday < 10){
				$tday = "0$tday";
			}
			$tmonth = $today['month'];
			$tyear = $today['year'];
			$thour = $today['hours'];
			if ($thour < 10){
				$thour = "0$thour";
			}
			$tmin = $today['minutes'];
			if ($tmin < 10){
				$tmin = "0$tmin";
			}
			$tsec = $today['seconds'];
			if ($tsec < 10){
				$tsec = "0$tsec";
			}
			$date = "$tmonth $tday, $tyear @ $thour:$tmin:$tsec";
			echo "<center><font class=\"option\"><b>"._AUTOSTORYEDIT."</b></font></center><br><br>"
			."<form action=\"".$admin_file.".php\" method=\"post\">";
			$title = filter($title, "nohtml");
			$hometext = filter($hometext);
			$bodytext = filter($bodytext);
			$notes = filter($notes);
			$result=$db->sql_query("select topicimage from ".$prefix."_topics where topicid='$topic'");
			list($topicimage) = $db->sql_fetchrow($result);
			echo "<table border=\"0\" width=\"75%\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"$bgcolor2\" align=\"center\"><tr><td>"
			."<table border=\"0\" width=\"100%\" cellpadding=\"8\" cellspacing=\"1\" bgcolor=\"$bgcolor1\"><tr><td>"
			."<img src=\"images/topics/$topicimage\" border=\"0\" align=\"right\">";
			themepreview($title, $hometext, $bodytext);
			echo "</td></tr></table></td></tr></table>"
			."<br><br><b>"._TITLE."</b><br>"
			."<input type=\"text\" name=\"title\" size=\"50\" value=\"$title\"><br><br>"
			."<b>"._TOPIC."</b> <select name=\"topic\">";
			$toplist = $db->sql_query("select topicid, topictext from ".$prefix."_topics order by topictext");
			echo "<option value=\"\">"._ALLTOPICS."</option>\n";
			while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
				$topicid = intval($topicid);
				$topics = filter($topics, "nohtml");
				if ($topicid==$topic) { $sel = "selected "; }
				echo "<option $sel value=\"$topicid\">$topics</option>\n";
				$sel = "";
			}
			echo "</select><br><br>";
			$cat = $catid;
			SelectCategory($cat);
			echo "<br>";
			puthome($ihome, $acomm);
			if ($multilingual == 1) {
				echo "<br><b>"._LANGUAGE.": </b>"
				."<select name=\"alanguage\">";
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
				for ($i=0; $i < sizeof($languageslist); $i++) {
					if(!empty($languageslist[$i])) {
						echo "<option value=\"$languageslist[$i]\" ";
						if($languageslist[$i]==$alanguage) echo "selected";
						echo ">".ucfirst($languageslist[$i])."</option>\n";
					}
				}
				if (empty($alanguage)) {
					$sellang = "selected";
				} else {
					$sellang = "";
				}
				echo "<option value=\"\" $sellang>"._ALL."</option></select>";
			} else {
				echo "<input type=\"hidden\" name=\"alanguage\" value=\"\">";
			}
			echo "<br><br><b>"._STORYTEXT."</b><br>"
			."<textarea wrap=\"virtual\" cols=\"100\" rows=\"15\" name=\"hometext\">$hometext</textarea><br><br>"
			."<b>"._EXTENDEDTEXT."</b><br>"
			."<textarea wrap=\"virtual\" cols=\"100\" rows=\"15\" name=\"bodytext\">$bodytext</textarea><br>"
			."<font class=\"content\">"._ARESUREURL."</font><br><br>";
			if ($aid != $informant) {
				echo "<b>"._NOTES."</b><br>
	<textarea wrap=\"virtual\" cols=\"100\" rows=\"10\" name=\"notes\">$notes</textarea><br><br>";
			}
			echo "<br><b>"._CHNGPROGRAMSTORY."</b><br><br>"
			.""._NOWIS.": $date<br><br>";
			$xday = 1;
			echo ""._DAY.": <select name=\"day\">";
			while ($xday <= 31) {
				if ($xday == $datetime[3]) {
					$sel = "selected";
				} else {
					$sel = "";
				}
				echo "<option name=\"day\" $sel>$xday</option>";
				$xday++;
			}
			echo "</select>";
			$xmonth = 1;
			echo ""._UMONTH.": <select name=\"month\">";
			while ($xmonth <= 12) {
				if ($xmonth == $datetime[2]) {
					$sel = "selected";
				} else {
					$sel = "";
				}
				echo "<option name=\"month\" $sel>$xmonth</option>";
				$xmonth++;
			}
			echo "</select>";
			echo ""._YEAR.": <input type=\"text\" name=\"year\" value=\"$datetime[1]\" size=\"5\" maxlength=\"4\">";
			echo "<br>"._HOUR.": <select name=\"hour\">";
			$xhour = 0;
			$cero = "0";
			while ($xhour <= 23) {
				$dummy = $xhour;
				if ($xhour < 10) {
					$xhour = "$cero$xhour";
				}
				if ($xhour == $datetime[4]) {
					$sel = "selected";
				} else {
					$sel = "";
				}
				echo "<option name=\"hour\" $sel>$xhour</option>";
				$xhour = $dummy;
				$xhour++;
			}
			echo "</select>";
			echo ": <select name=\"min\">";
			$xmin = 0;
			while ($xmin <= 59) {
				if (($xmin == 0) OR ($xmin == 5)) {
					$xmin = "0$xmin";
				}
				if ($xmin == $datetime[5]) {
					$sel = "selected";
				} else {
					$sel = "";
				}
				echo "<option name=\"min\" $sel>$xmin</option>";
				$xmin = $xmin + 5;
			}
			echo "</select>";
			echo ": 00<br><br>
    <input type=\"hidden\" name=\"anid\" value=\"$anid\">
    <input type=\"hidden\" name=\"op\" value=\"autoSaveEdit\">
    <input type=\"submit\" value=\""._SAVECHANGES."\">
    </form>";
			CloseTable();
			include ('footer.php');
		} else {
			include ('header.php');
			GraphicAdmin();
			OpenTable();
			echo "<center><font class=\"title\"><b>"._ARTICLEADMIN."</b></font></center>";
			CloseTable();
			echo "<br>";
			OpenTable();
			echo "<center><b>"._NOTAUTHORIZED1."</b><br><br>"
			.""._NOTAUTHORIZED2."<br><br>"
			.""._GOBACK."";
			CloseTable();
			include("footer.php");
		}
	}

	function autoSaveEdit($anid, $year, $day, $month, $hour, $min, $title, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm) {
		global $aid, $ultramode, $prefix, $db, $admin_file;
		$aid = substr("$aid", 0,25);
		$sid = intval($sid);
		$result = $db->sql_query("select radminsuper from ".$prefix."_authors where aid='$aid'");
		list($radminsuper) = $db->sql_fetchrow($result);
		$radminsuper = intval($radminsuper);
		$result = $db->sql_query("SELECT admins FROM ".$prefix."_modules WHERE title='News'");
		$row2 = $db->sql_fetchrow($db->sql_query("SELECT name FROM ".$prefix."_authors WHERE aid='$aid'"));
		while ($row = $db->sql_fetchrow($result)) {
			$admins = explode(",", $row['admins']);
			$auth_user = 0;
			for ($i=0; $i < sizeof($admins); $i++) {
			if ($row2['name'] == $admins[$i]) {
					$auth_user = 1;
				}
			}
			if ($auth_user == 1) {
				$radminarticle = 1;
			}
		}
		$result2 = $db->sql_query("select aid from ".$prefix."_stories where sid='$sid'");
		list($aaid) = $db->sql_fetchrow($result2);
		$aaid = substr("$aaid", 0,25);
		if (($radminarticle == 1) AND ($aaid == $aid) OR ($radminsuper == 1)) {
			if ($day < 10) {
				$day = "0$day";
			}
			if ($month < 10) {
				$month = "0$month";
			}
			$sec = "00";
			$date = "$year-$month-$day $hour:$min:$sec";
			$title = filter($title, "nohtml", 1);
			$hometext = filter($hometext, "", 1);
			$bodytext = filter($bodytext, "", 1);
			$notes = filter($notes, "", 1);
			$result = $db->sql_query("update ".$prefix."_autonews set catid='$catid', title='$title', time='$date', hometext='$hometext', bodytext='$bodytext', topic='$topic', notes='$notes', ihome='$ihome', alanguage='$alanguage', acomm='$acomm' where anid='$anid'");
			if (!$result) {
				fdie();
			}
			if ($ultramode) {
				ultramode();
			}
			Header("Location: ".$admin_file.".php?op=adminMain");
			} else {
			include ('header.php');
			GraphicAdmin();
			OpenTable();
			echo "<center><font class=\"title\"><b>"._ARTICLEADMIN."</b></font></center>";
			CloseTable();
			echo "<br>";
			OpenTable();
			echo "<center><b>"._NOTAUTHORIZED1."</b><br><br>"
			.""._NOTAUTHORIZED2."<br><br>"
			.""._GOBACK."";
			CloseTable();
			include("footer.php");
		}
	}

	function displayStory($qid) {
		global $user, $subject, $story, $bgcolor1, $bgcolor2, $anonymous, $user_prefix, $prefix, $db, $multilingual, $admin_file;
		include ('header.php');
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>"._SUBMISSIONSADMIN."</b></font></center>";
		CloseTable();
		echo "<br>";
		$today = getdate();
		$tday = $today['mday'];
		if ($tday < 10){
			$tday = "0$tday";
		}
		$tmonth = $today['month'];
		$ttmon = $today['mon'];
		if ($ttmon < 10){
			$ttmon = "0$ttmon";
		}
		$tyear = $today['year'];
		$thour = $today['hours'];
		if ($thour < 10){
			$thour = "0$thour";
		}
		$tmin = $today['minutes'];
		if ($tmin < 10){
			$tmin = "0$tmin";
		}
		$tsec = $today['seconds'];
		if ($tsec < 10){
			$tsec = "0$tsec";
		}
		$nowdate = "$tmonth $tday, $tyear @ $thour:$tmin:$tsec";
		$qid = intval($qid);
		$result = $db->sql_query("SELECT qid, uid, uname, subject, story, storyext, topic, alanguage FROM ".$prefix."_queue where qid='$qid'");
		list($qid, $uid, $uname, $subject, $story, $storyext, $topic, $alanguage) = $db->sql_fetchrow($result);
		$qid = intval($qid);
		$uid = intval($uid);
		$topic = intval($topic);
		$uname = filter($uname, "nohtml");
		$subject = filter($subject, "nohtml");
		$story = filter($story);
		$storyext = filter($storyext);
		$story1 = redir($story);
		$storyext1 = redir($storyext);
		OpenTable();
		echo "<br>";
		if(empty($topic)) {
			$topic = 1;
		}
		$result = $db->sql_query("select topicimage from ".$prefix."_topics where topicid='$topic'");
		list($topicimage) = $db->sql_fetchrow($result);
		echo "<table border=\"0\" width=\"70%\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"$bgcolor2\" align=\"center\"><tr><td>"
			."<table border=\"0\" width=\"100%\" cellpadding=\"8\" cellspacing=\"1\" bgcolor=\"$bgcolor1\"><tr><td>"
			."<img src=\"images/topics/$topicimage\" border=\"0\" align=\"right\" alt=\"\">";
		$storypre = "$story1<br><br>$storyext1";
		$pre_subject = "<font class=\"title\">$subject</font>";
		themepreview($pre_subject, $storypre);
		echo "</td></tr></table></td></tr></table><br><br>";
		echo "<table width=\"100%\" border=\"0\" cellspacing=\"6\">"
			."<tr><td><form action=\"".$admin_file.".php\" method=\"post\">"
			."<b>"._USERNEWS.":</b></td><td><b>$uname</b><input type=\"hidden\" NAME=\"author\" value=\"$uname\">";
		if ($uname != $anonymous) {
			$res = $db->sql_query("select user_email from ".$user_prefix."_users where username='$uname'");
			list($email) = $db->sql_fetchrow($res);
			$email = filter($email, "nohtml");
			echo "&nbsp;&nbsp;<font class=\"content\">[ <a href=\"mailto:$email?Subject=Re: $subject\">"._EMAIL."</a> | <a href='modules.php?name=Your_Account&op=userinfo&username=$uname'>"._PROFILE."</a> | <a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=$uid\">"._SENDPM."</a> ]</font>";
		}
		echo "</td></tr><tr><td><b>"._TITLE.":</b></td><td><input type=\"text\" name=\"subject\" size=\"70\" value=\"$subject\"></td></tr>";
		echo "<tr><td><b>"._TOPIC.":</b></td><td><select name=\"topic\">";
		$toplist = $db->sql_query("select topicid, topictext from ".$prefix."_topics order by topictext");
		echo "<option value=\"\">"._SELECTTOPIC."</option>\n";
		while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
			$topicid = intval($topicid);
			$topics = filter($topics, "nohtml");
			if ($topicid==$topic) {
				$sel = "selected ";
			}
			echo "<option $sel value=\"$topicid\">$topics</option>\n";
			$sel = "";
		}
		echo "</select></td></tr>"
			."<tr><td><b>"._ASSOTOPIC.":</b></td><td>";
		$sql = "SELECT topicid, topictext FROM ".$prefix."_topics ORDER BY topictext";
		$result = $db->sql_query($sql);
		echo "<select multiple name=\"assotop[]\" size=\"3\">";
		while ($row = $db->sql_fetchrow($result)) {
			$row['topicid'] = intval($row['topicid']);
			$row['topictext'] = filter($row['topictext'], "nohtml");
			echo "<option value='".$row['topicid']."'>".$row['topictext']."</option>";
		}
		echo "</select></td></tr>";
		$selcat = $db->sql_query("select catid, title from ".$prefix."_stories_cat order by title");
		$a = 1;
		echo "<tr><td><b>"._CATEGORY.":</b></td><td>";
		echo "<select name=\"catid\">";
		if ($cat == 0) {
			$sel = "selected";
		} else {
			$sel = "";
		}
		echo "<option name=\"catid\" value=\"0\" $sel>"._ARTICLES."</option>";
		while(list($catid, $title) = $db->sql_fetchrow($selcat)) {
			$catid = intval($catid);
			$title = filter($title, "nohtml");
			if ($catid == $cat) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			echo "<option name=\"catid\" value=\"$catid\" $sel>$title</option>";
			$a++;
		}
		echo "</select> &nbsp; <a href=\"".$admin_file.".php?op=AddCategory\"><img src=\"images/add.gif\" alt=\""._ADD."\" title=\""._ADD."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=EditCategory\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=DelCategory\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a>";
		echo "</td></tr>";
		echo "<tr><td><b>"._PUBLISHINHOME."</b></td><td>";
		if (($ihome == 0) OR (empty($ihome))) {
			$sel1 = "checked";
			$sel2 = "";
		}
		if ($ihome == 1) {
			$sel1 = "";
			$sel2 = "checked";
		}
		echo "<input type=\"radio\" name=\"ihome\" value=\"0\" $sel1>"._YES."&nbsp;"
			."<input type=\"radio\" name=\"ihome\" value=\"1\" $sel2>"._NO.""
			."&nbsp;&nbsp;<font class=\"content\">[ "._ONLYIFCATSELECTED." ]</font></td></tr>"
			."<tr><td><b>"._ACTIVATECOMMENTS."</b></td><td>";
		if (($acomm == 0) OR (empty($acomm))) {
			$sel1 = "checked";
			$sel2 = "";
		}
		if ($acomm == 1) {
			$sel1 = "";
			$sel2 = "checked";
		}
		echo "<input type=\"radio\" name=\"acomm\" value=\"0\" $sel1>"._YES."&nbsp;"
			."<input type=\"radio\" name=\"acomm\" value=\"1\" $sel2>"._NO."</font></td></tr>";
		if ($multilingual == 1) {
			echo "<tr><td><b>"._LANGUAGE.":</b></td><td>"
				."<select name=\"alanguage\">";
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
			for ($i=0; $i < sizeof($languageslist); $i++) {
				if(!empty($languageslist[$i])) {
					echo "<option value=\"$languageslist[$i]\" ";
					if($languageslist[$i]==$alanguage) echo "selected";
					echo ">".ucfirst($languageslist[$i])."</option>\n";
				}
			}
			if (empty($alanguage)) {
				$sellang = "selected";
			} else {
				$sellang = "";
			}
			echo "<option value=\"\" $sellang>"._ALL."</option></select></td></tr>";
		} else {
			echo "<input type=\"hidden\" name=\"alanguage\" value=\"\"></td></tr>";
		}
		echo "<tr><td><b>"._STORYTEXT.":</b></td><td>"
			."<textarea wrap=\"virtual\" cols=\"70\" rows=\"15\" name=\"hometext\">$story</textarea></td></tr>"
			."<tr><td><b>"._EXTENDEDTEXT.":</b></td><td>"
			."<textarea wrap=\"virtual\" cols=\"70\" rows=\"15\" name=\"bodytext\">$storyext</textarea><br>"
			."<font class=\"content\">"._AREYOUSURE."</font></td></tr>"
			."<tr><td><b>"._NOTES.":</b></td><td>"
			."<textarea wrap=\"virtual\" cols=\"70\" rows=\"10\" name=\"notes\"></textarea></td></tr>"
			."<tr><td colspan=\"2\"><hr noshade size=\"1\"></td></tr>"
			."<tr><td><input type=\"hidden\" NAME=\"qid\" size=\"50\" value=\"$qid\">"
			."<input type=\"hidden\" NAME=\"uid\" size=\"50\" value=\"$uid\">"
			."<b>"._SCHEDULENEWS.":</b></td><td>"
			."<input type=\"radio\" name=\"automated\" value=\"1\">"._YES." &nbsp;&nbsp;"
			."<input type=\"radio\" name=\"automated\" value=\"0\" checked>"._NO."</td></tr>";
		$day = 1;
		echo "<tr><td><b>"._PUBLISHON.":</b></td><td>";
		echo ""._DAY.": <select name=\"day\">";
		while ($day <= 31) {
			if ($tday==$day) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			echo "<option name=\"day\" $sel>$day</option>";
			$day++;
		}
		echo "</select>";
		$month = 1;
		echo " "._UMONTH.": <select name=\"month\">";
		while ($month <= 12) {
			if ($ttmon==$month) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			echo "<option name=\"month\" $sel>$month</option>";
			$month++;
		}
		echo "</select>";
		$date = getdate();
		$year = $date['year'];
		echo " "._YEAR.": <input type=\"text\" name=\"year\" value=\"$year\" size=\"5\" maxlength=\"4\">";
		echo " <b>@</b> "._HOUR.": <select name=\"hour\">";
		$hour = 0;
		$cero = "0";
		while ($hour <= 23) {
			$dummy = $hour;
			if ($hour < 10) {
				$hour = "$cero$hour";
			}
			echo "<option name=\"hour\">$hour</option>";
			$hour = $dummy;
			$hour++;
		}
		echo "</select>";
		echo " : <select name=\"min\">";
		$min = 0;
		while ($min <= 59) {
			if (($min == 0) OR ($min == 5)) {
				$min = "0$min";
			}
			echo "<option name=\"min\">$min</option>";
			$min = $min + 5;
		}
		echo "</select>";
		echo " : 00</td></tr>"
			."<tr><td>&nbsp;</td><td>"._NOWIS.": $nowdate</td></tr>"
			."<tr><td colspan=\"2\"><hr noshade size=\"1\"></td></tr>"
			."<tr><td>&nbsp;</td><td><select name=\"op\">"
			."<option value=\"DeleteStory\">"._DELETESTORY."</option>"
			."<option value=\"PreviewAgain\" selected>"._PREVIEWSTORY."</option>"
			."<option value=\"PostStory\">"._POSTSTORY."</option>"
			."</select>"
			."&nbsp;&nbsp;<input type=\"submit\" value=\""._OK."\">&nbsp;&nbsp;<b>[ <a href=\"".$admin_file.".php?op=DeleteStory&qid=$qid\">"._DELETE."</a> ]</b>"
			."</td></tr></table>";
		CloseTable();
		echo "<br>";
		putpoll($pollTitle, $optionText);
		echo "</form>";
		include ('footer.php');
	}

	function previewStory($automated, $year, $day, $month, $hour, $min, $qid, $uid, $author, $subject, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop) {
		global $user, $boxstuff, $anonymous, $bgcolor1, $bgcolor2, $user_prefix, $prefix, $db, $multilingual, $admin_file;
		include ('header.php');
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>"._ARTICLEADMIN."</b></font></center>";
		CloseTable();
		echo "<br>";
		$today = getdate();
		$tday = $today['mday'];
		if ($tday < 10){
			$tday = "0$tday";
		}
		$tmonth = $today['month'];
		$tyear = $today['year'];
		$thour = $today['hours'];
		if ($thour < 10){
			$thour = "0$thour";
		}
		$tmin = $today['minutes'];
		if ($tmin < 10){
			$tmin = "0$tmin";
		}
		$tsec = $today['seconds'];
		if ($tsec < 10){
			$tsec = "0$tsec";
		}
		$nowdate = "$tmonth $tday, $tyear @ $thour:$tmin:$tsec";
		$subject = filter($subject, "nohtml", 0, preview);
		$hometext = filter($hometext);
		$bodytext = filter($bodytext);
		$hometext1 = redir($hometext);
		$bodytext1 = redir($bodytext);
		$notes = filter($notes);
		OpenTable();
		echo "<br>";
		$result = $db->sql_query("select topicimage from ".$prefix."_topics where topicid='$topic'");
		list($topicimage) = $db->sql_fetchrow($result);
		echo "<table width=\"70%\" bgcolor=\"$bgcolor2\" cellpadding=\"0\" cellspacing=\"1\" border=\"0\"align=\"center\"><tr><td>"
			."<table width=\"100%\" bgcolor=\"$bgcolor1\" cellpadding=\"8\" cellspacing=\"1\" border=\"0\"><tr><td>"
			."<img src=\"images/topics/$topicimage\" border=\"0\" align=\"right\">";
		$pre_subject = "<font class=\"title\">$subject</font>";
		themepreview($pre_subject, $hometext1, $bodytext1, $notes);
		echo "</td></tr></table></td></tr></table><br><br>";
		echo "<br>";
		echo "<table border=\"0\" width=\"100%\" cellspacing=\"6\">";
		echo "<tr><td>"
			."<form action=\"".$admin_file.".php\" method=\"post\">"
			."<b>"._USERNEWS.":</b></td><td>"
			."<b>$author</b><input type=\"hidden\" name=\"author\" value=\"$author\">";
		if ($author != $anonymous) {
			$res = $db->sql_query("select user_id, user_email from ".$user_prefix."_users where username='$author'");
			list($pm_userid, $email) = $db->sql_fetchrow($res);
			$pm_userid = intval($pm_userid);
			echo "&nbsp;&nbsp;<font class=\"content\">[ <a href=\"mailto:$email?Subject=Re: $subject\">"._USER."</a> | <a href='modules.php?name=Your_Account&op=userinfo&username=$author'>"._PROFILE."</a> | <a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=$uid\">"._SENDPM."</a> ]</font>";
		}
		echo "</td></tr><tr><td><b>"._TITLE.":</b></td><td>"
			."<input type=\"text\" name=\"subject\" size=\"70\" value=\"$subject\"></td></tr>"
			."<tr><td><b>"._TOPIC.":</b></td><td><select name=\"topic\">";
		$toplist = $db->sql_query("select topicid, topictext from ".$prefix."_topics order by topictext");
		echo "<option value=\"\">"._ALLTOPICS."</option>\n";
		while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
			$topicid = intval($topicid);
			$topics = filter($topics, "nohtml");
			if ($topicid==$topic) {
				$sel = "selected ";
			}
			echo "<option $sel value=\"$topicid\">$topics</option>\n";
			$sel = "";
		}
		echo "</select></td></tr>";
		for ($i=0; $i<sizeof($assotop); $i++) {
			$associated .= "$assotop[$i]-";
		}
		$asso_t = explode("-", $associated);
		echo "<tr><td><b>"._ASSOTOPIC.":</b></td><td>";
		$sql = "SELECT topicid, topictext FROM ".$prefix."_topics ORDER BY topictext";
		$result = $db->sql_query($sql);
		echo "<select multiple name=\"assotop[]\" size=\"3\">";
		while ($row = $db->sql_fetchrow($result)) {
			for ($i=0; $i<sizeof($asso_t); $i++) {
				if ($asso_t[$i] == $row['topicid']) {
					$checked = "selected";
					break;
				}
			}
			$row['topicid'] = intval($row['topicid']);
			$row['topictext'] = filter($row['topictext'], "nohtml");
			echo "<option value='".$row['topicid']."' $checked>".$row['topictext']."</option>";
			$checked = "";
		}
		echo "</select></td></tr>";
		$cat = $catid;
		$selcat = $db->sql_query("select catid, title from ".$prefix."_stories_cat order by title");
		$a = 1;
		echo "<tr><td><b>"._CATEGORY.":</b></td><td>";
		echo "<select name=\"catid\">";
		if ($cat == 0) {
			$sel = "selected";
		} else {
			$sel = "";
		}
		echo "<option name=\"catid\" value=\"0\" $sel>"._ARTICLES."</option>";
		while(list($catid, $title) = $db->sql_fetchrow($selcat)) {
			$catid = intval($catid);
			$title = filter($title, "nohtml");
			if ($catid == $cat) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			echo "<option name=\"catid\" value=\"$catid\" $sel>$title</option>";
			$a++;
		}
		echo "</select> &nbsp; <a href=\"".$admin_file.".php?op=AddCategory\"><img src=\"images/add.gif\" alt=\""._ADD."\" title=\""._ADD."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=EditCategory\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=DelCategory\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a></td></tr>";
		echo "<tr><td><b>"._PUBLISHINHOME."</b></td><td>";
		if (($ihome == 0) OR (empty($ihome))) {
			$sel1 = "checked";
			$sel2 = "";
		}
		if ($ihome == 1) {
			$sel1 = "";
			$sel2 = "checked";
		}
		echo "<input type=\"radio\" name=\"ihome\" value=\"0\" $sel1>"._YES."&nbsp;"
			."<input type=\"radio\" name=\"ihome\" value=\"1\" $sel2>"._NO.""
			."&nbsp;&nbsp;<font class=\"content\">[ "._ONLYIFCATSELECTED." ]</font></td></tr>";
		echo "<tr><td><b>"._ACTIVATECOMMENTS."</b></td><td>";
		if (($acomm == 0) OR (empty($acomm))) {
			$sel1 = "checked";
			$sel2 = "";
		}
		if ($acomm == 1) {
			$sel1 = "";
			$sel2 = "checked";
		}
		echo "<input type=\"radio\" name=\"acomm\" value=\"0\" $sel1>"._YES."&nbsp;"
			."<input type=\"radio\" name=\"acomm\" value=\"1\" $sel2>"._NO."</font></td></tr>";
		if ($multilingual == 1) {
			echo "<tr><td><b>"._LANGUAGE.":</b></td><td>"
				."<select name=\"alanguage\">";
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
			for ($i=0; $i < sizeof($languageslist); $i++) {
				if(!empty($languageslist[$i])) {
					echo "<option value=\"$languageslist[$i]\" ";
					if($languageslist[$i]==$alanguage) echo "selected";
					echo ">".ucfirst($languageslist[$i])."</option>\n";
				}
			}
			if (empty($alanguage)) {
				$sellang = "selected";
			} else {
				$sellang = "";
			}
			echo "<option value=\"\" $sellang>"._ALL."</option></select></tr><td>";
		} else {
			echo "<input type=\"hidden\" name=\"alanguage\" value=\"$language\"><tr><td>";
		}
		echo "<tr><td><b>"._STORYTEXT.":</b></td><td>"
			."<textarea wrap=\"virtual\" cols=\"70\" rows=\"15\" name=\"hometext\">$hometext</textarea></td></tr>"
			."<tr><td><b>"._EXTENDEDTEXT.":</b></td><td>"
			."<textarea wrap=\"virtual\" cols=\"70\" rows=\"15\" name=\"bodytext\">$bodytext</textarea><br>"
			."<font class=\"content\">"._AREYOUSURE."</font></td></tr>"
			."<tr><td><b>"._NOTES.":</b></td><td>"
			."<textarea wrap=\"virtual\" cols=\"70\" rows=\"10\" name=\"notes\">$notes</textarea></td></tr>"
			."<tr><td colspan=\"2\"><hr noshade size=\"1\"></td></tr>"
			."<tr><td><input type=\"hidden\" NAME=\"qid\" size=\"50\" value=\"$qid\">"
			."<input type=\"hidden\" NAME=\"uid\" size=\"50\" value=\"$uid\">";
		if ($automated == 1) {
			$sel1 = "checked";
			$sel2 = "";
		} else {
			$sel1 = "";
			$sel2 = "checked";
		}
		echo "<b>"._SCHEDULENEWS.":</b></td><td>"
			."<input type=\"radio\" name=\"automated\" value=\"1\" $sel1>"._YES." &nbsp;&nbsp;"
			."<input type=\"radio\" name=\"automated\" value=\"0\" $sel2>"._NO."</td></tr>";
		$xday = 1;
		echo "<tr><td><b>"._PUBLISHON.":</b></td><td>"._DAY.": <select name=\"day\">";
		while ($xday <= 31) {
			if ($xday == $day) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			echo "<option name=\"day\" $sel>$xday</option>";
			$xday++;
		}
		echo "</select>";
		$xmonth = 1;
		echo " "._UMONTH.": <select name=\"month\">";
		while ($xmonth <= 12) {
			if ($xmonth == $month) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			echo "<option name=\"month\" $sel>$xmonth</option>";
			$xmonth++;
		}
		echo "</select>";
		echo " "._YEAR.": <input type=\"text\" name=\"year\" value=\"$year\" size=\"5\" maxlength=\"4\">";
		echo " <b>@</b> "._HOUR.": <select name=\"hour\">";
		$xhour = 0;
		$cero = "0";
		while ($xhour <= 23) {
			$dummy = $xhour;
			if ($xhour < 10) {
				$xhour = "$cero$xhour";
			}
			if ($xhour == $hour) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			echo "<option name=\"hour\" $sel>$xhour</option>";
			$xhour = $dummy;
			$xhour++;
		}
		echo "</select>";
		echo " : <select name=\"min\">";
		$xmin = 0;
		while ($xmin <= 59) {
			if (($xmin == 0) OR ($xmin == 5)) {
				$xmin = "0$xmin";
			}
			if ($xmin == $min) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			echo "<option name=\"min\" $sel>$xmin</option>";
			$xmin = $xmin + 5;
		}
		echo "</select>";
		echo " : 00</td></tr>"
			."<tr><td>&nbsp;</td><td>"._NOWIS.": $nowdate</td></tr>"
			."<tr><td colspan=\"2\"><hr noshade size=\"1\"></td></tr>"
			."<tr><td>&nbsp;</td><td><select name=\"op\">"
			."<option value=\"DeleteStory\">"._DELETESTORY."</option>"
			."<option value=\"PreviewAgain\" selected>"._PREVIEWSTORY."</option>"
			."<option value=\"PostStory\">"._POSTSTORY."</option>"
			."</select>"
			."&nbsp;&nbsp;<input type=\"submit\" value=\""._OK."\">&nbsp;&nbsp;<b>[ <a href=\"".$admin_file.".php?op=DeleteStory&qid=$qid\">"._DELETE."</a> ]</b>"
			."</td></tr></table>";
		CloseTable();
		echo "<br>";
		putpoll($pollTitle, $optionText);
		echo "</form>";
		include ('footer.php');
	}

	function postStory($automated, $year, $day, $month, $hour, $min, $qid, $uid, $author, $subject, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop) {
		global $aid, $ultramode, $prefix, $db, $user_prefix, $admin_file;
		for ($i=0; $i<sizeof($assotop); $i++) {
			$associated .= "$assotop[$i]-";
		}
		if ($automated == 1) {
			if ($day < 10) {
				$day = "0$day";
			}
			if ($month < 10) {
				$month = "0$month";
			}
			$sec = "00";
			$date = "$year-$month-$day $hour:$min:$sec";
			if ($uid == 1) $author = "";
			if ($hometext == $bodytext) $bodytext = "";
			$subject = filter($subject, "nohtml", 1);
			$hometext = filter($hometext, "", 1);
			$bodytext = filter($bodytext, "", 1);
			$notes = filter($notes, "", 1);
			$result = $db->sql_query("insert into ".$prefix."_autonews values (NULL, '$catid', '$aid', '$subject', '$date', '$hometext', '$bodytext', '$topic', '$author', '$notes', '$ihome', '$alanguage', '$acomm', '$associated')");
			if (!$result) {
				return;
			}
			if ($uid != 1) {
				$db->sql_query("update ".$user_prefix."_users set counter=counter+1 where user_id='$uid'");
				$row = $db->sql_fetchrow($db->sql_query("SELECT points FROM ".$prefix."_groups_points WHERE id='4'"));
				$db->sql_query("UPDATE ".$user_prefix."_users SET points=points+".intval($row['points'])." where user_id='$uid'");
			}
			$db->sql_query("update ".$prefix."_authors set counter=counter+1 where aid='$aid'");
			if ($ultramode) {
				ultramode();
			}
			$qid = intval($qid);
			$db->sql_query("delete from ".$prefix."_queue where qid='$qid'");
			Header("Location: ".$admin_file.".php?op=submissions");
		} else {
			if ($uid == 1) $author = "";
			if ($hometext == $bodytext) $bodytext = "";
			$subject = filter($subject, "nohtml", 1);
			$hometext = filter($hometext, "", 1);
			$bodytext = filter($bodytext, "", 1);
			$notes = filter($notes, "", 1);
			if ((!empty($pollTitle)) AND (!empty($optionText[1])) AND (!empty($optionText[2]))) {
				$haspoll = 1;
				$timeStamp = time();
				$pollTitle = filter($pollTitle, "nohtml", 1);
				if(!$db->sql_query("INSERT INTO ".$prefix."_poll_desc VALUES (NULL, '$pollTitle', '$timeStamp', '0', '$alanguage', '0', '0')")) {
					return;
				}
				$object = $db->sql_fetchrow($db->sql_query("SELECT pollID FROM ".$prefix."_poll_desc WHERE pollTitle='$pollTitle'"));
				$id = $object['pollID'];
				$id = intval($id);
				for($i = 1; $i <= sizeof($optionText); $i++) {
					if($optionText[$i] != "") {
						$optionText[$i] = filter($optionText[$i], "nohtml", 1);
					}
					if(!$db->sql_query("INSERT INTO ".$prefix."_poll_data (pollID, optionText, optionCount, voteID) VALUES ('$id', '$optionText[$i]', '0', '$i')")) {
						return;
					}
				}
			} else {
				$haspoll = 0;
				$id = 0;
			}
			$result = $db->sql_query("insert into ".$prefix."_stories values (NULL, '$catid', '$aid', '$subject', now(), '$hometext', '$bodytext', '0', '0', '$topic', '$author', '$notes', '$ihome', '$alanguage', '$acomm', '$haspoll', '$id', '0', '0', '0', '$associated')");
			$result = $db->sql_query("select sid from ".$prefix."_stories WHERE title='$subject' order by time DESC limit 0,1");
			list($artid) = $db->sql_fetchrow($result);
			$artid = intval($artid);
			$db->sql_query("UPDATE ".$prefix."_poll_desc SET artid='$artid' WHERE pollID='$id'");
			if (!$result) {
				return;
			}
			if ($uid != 1) {
				$row = $db->sql_fetchrow($db->sql_query("SELECT points FROM ".$prefix."_groups_points WHERE id='4'"));
				$db->sql_query("UPDATE ".$user_prefix."_users SET points=points+".intval($row['points'])." where user_id='$uid'");
				$db->sql_query("update ".$user_prefix."_users set counter=counter+1 where user_id='$uid'");
			}
			$db->sql_query("update ".$prefix."_authors set counter=counter+1 where aid='$aid'");
			if ($ultramode) {
				ultramode();
			}
			deleteStory($qid);
		}
	}

	function editStory($sid) {
		global $user, $bgcolor1, $bgcolor2, $aid, $prefix, $db, $multilingual, $admin_file;
		$aid = substr("$aid", 0,25);
		$result = $db->sql_query("select radminsuper from ".$prefix."_authors where aid='$aid'");
		list($radminsuper) = $db->sql_fetchrow($result);
		$radminsuper = intval($radminsuper);
		$result = $db->sql_query("SELECT admins FROM ".$prefix."_modules WHERE title='News'");
		$row2 = $db->sql_fetchrow($db->sql_query("SELECT name FROM ".$prefix."_authors WHERE aid='$aid'"));
		while ($row = $db->sql_fetchrow($result)) {
			$admins = explode(",", $row['admins']);
			$auth_user = 0;
			for ($i=0; $i < sizeof($admins); $i++) {
			if ($row2['name'] == $admins[$i]) {
					$auth_user = 1;
				}
			}
			if ($auth_user == 1) {
				$radminarticle = 1;
			}
		}
		$result2 = $db->sql_query("select aid from ".$prefix."_stories where sid='$sid'");
		list($aaid) = $db->sql_fetchrow($result2);
		$aaid = substr("$aaid", 0,25);
		if (($radminarticle == 1) AND ($aaid == $aid) OR ($radminsuper == 1)) {
			include ('header.php');
			GraphicAdmin();
			OpenTable();
			echo "<center><font class=\"title\"><b>"._ARTICLEADMIN."</b></font></center>";
			CloseTable();
			echo "<br>";
			$result = $db->sql_query("SELECT catid, title, hometext, bodytext, topic, notes, ihome, alanguage, acomm FROM ".$prefix."_stories where sid='$sid'");
			list($catid, $subject, $hometext, $bodytext, $topic, $notes, $ihome, $alanguage, $acomm) = $db->sql_fetchrow($result);
			$catid = intval($catid);
			$topic = intval($topic);
			$subject = filter($subject, "nohtml");
			$hometext = filter($hometext);
			$bodytext = filter($bodytext);
			$notes = filter($notes);
			$ihome = intval($ihome);
			$acomm = intval($acomm);
			$result2=$db->sql_query("select topicimage from ".$prefix."_topics where topicid='$topic'");
			list($topicimage) = $db->sql_fetchrow($result2);
			OpenTable();
			echo "<center><font class=\"option\"><b>"._EDITARTICLE."</b></font></center><br>"
			."<table width=\"80%\" border=\"0\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"$bgcolor2\" align=\"center\"><tr><td>"
			."<table width=\"100%\" border=\"0\" cellpadding=\"8\" cellspacing=\"1\" bgcolor=\"$bgcolor1\"><tr><td>"
			."<img src=\"images/topics/$topicimage\" border=\"0\" align=\"right\">";
			themepreview($subject, $hometext, $bodytext, $notes);
			echo "</td></tr></table></td></tr></table><br><br>"
			."<form action=\"".$admin_file.".php\" method=\"post\">"
			."<b>"._TITLE."</b><br>"
			."<input type=\"text\" name=\"subject\" size=\"50\" value=\"$subject\"><br><br>"
			."<b>"._TOPIC."</b> <select name=\"topic\">";
			$toplist = $db->sql_query("select topicid, topictext from ".$prefix."_topics order by topictext");
			echo "<option value=\"\">"._ALLTOPICS."</option>\n";
			while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
				$topicid = intval($topicid);
				$topics = filter($topics, "nohtml");
				if ($topicid==$topic) { $sel = "selected "; }
				echo "<option $sel value=\"$topicid\">$topics</option>\n";
				$sel = "";
			}
			echo "</select>";
			echo "<br><br>";
			$asql = "SELECT associated FROM ".$prefix."_stories WHERE sid='$sid'";
			$aresult = $db->sql_query($asql);
			$arow = $db->sql_fetchrow($aresult);
			$asso_t = explode("-", $arow[associated]);
			echo "<table border='0' width='100%' cellspacing='0'><tr><td width='20%'><b>"._ASSOTOPIC."</b></td><td width='100%'>"
			."<table border='0' cellspacing='0' cellpadding='0'><tr>";
			$sql = "SELECT topicid, topictext FROM ".$prefix."_topics ORDER BY topictext";
			$result = $db->sql_query($sql);
			echo "<td><select multiple name=\"assotop[]\" size=\"5\">";
			while ($row = $db->sql_fetchrow($result)) {
				for ($i=0; $i<sizeof($asso_t); $i++) {
					if ($asso_t[$i] == $row['topicid']) {
						$checked = "selected";
						break;
					}
				}
				$row['topicid'] = intval($row['topicid']);
				$row['topictext'] = filter($row['topictext'], "nohtml");
				echo "<option value='".$row['topicid']."' $checked>".$row['topictext']."</option>";
				$checked = "";
			}
			echo "</select></td>";
			echo "</tr></table></td></tr></table><br><br>";
			$cat = $catid;
			SelectCategory($cat);
			echo "<br>";
			puthome($ihome, $acomm);
			if ($multilingual == 1) {
				echo "<br><b>"._LANGUAGE.":</b>"
				."<select name=\"alanguage\">";
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
				for ($i=0; $i < sizeof($languageslist); $i++) {
					if(!empty($languageslist[$i])) {
						echo "<option name=\"alanguage\" value=\"$languageslist[$i]\" ";
						if($languageslist[$i]==$alanguage) echo "selected";
						echo ">".ucfirst($languageslist[$i])."\n</option>";
					}
				}
				if (empty($alanguage)) {
					$sellang = "selected";
				} else {
					$sellang = "";
				}
				echo "<option value=\"\" $sellang>"._ALL."</option></select>";
			} else {
				echo "<input type=\"hidden\" name=\"alanguage\" value=\"\">";
			}
			echo "<br><br><b>"._STORYTEXT."</b><br>"
			."<textarea wrap=\"virtual\" cols=\"100\" rows=\"15\" name=\"hometext\">$hometext</textarea><br><br>"
			."<b>"._EXTENDEDTEXT."</b><br>"
			."<textarea wrap=\"virtual\" cols=\"100\" rows=\"15\" name=\"bodytext\">$bodytext</textarea><br>"
			."<font class=\"content\">"._AREYOUSURE."</font><br><br>"
			."<b>"._NOTES."</b><br>"
			."<textarea wrap=\"virtual\" cols=\"100\" rows=\"10\" name=\"notes\">$notes</textarea><br><br>"
			."<input type=\"hidden\" NAME=\"sid\" size=\"50\" value=\"$sid\">"
			."<input type=\"hidden\" name=\"op\" value=\"ChangeStory\">"
			."<input type=\"submit\" value=\""._SAVECHANGES."\">"
			."</form>";
			CloseTable();
			include ('footer.php');
		} else {
			include ('header.php');
			GraphicAdmin();
			OpenTable();
			echo "<center><font class=\"title\"><b>"._ARTICLEADMIN."</b></font></center>";
			CloseTable();
			echo "<br>";
			OpenTable();
			echo "<center><b>"._NOTAUTHORIZED1."</b><br><br>"
			.""._NOTAUTHORIZED2."<br><br>"
			.""._GOBACK."";
			CloseTable();
			include("footer.php");
		}
	}

	function removeStory($sid, $ok=0) {
		global $ultramode, $aid, $prefix, $db, $admin_file;
		$aid = substr("$aid", 0,25);
		$result = $db->sql_query("select counter, radminsuper from ".$prefix."_authors where aid='$aid'");
		list($counter, $radminsuper) = $db->sql_fetchrow($result);
		$radminsuper = intval($radminsuper);
		$counter = intval($counter);
		$sid = intval($sid);
		$result = $db->sql_query("SELECT admins FROM ".$prefix."_modules WHERE title='News'");
		$row2 = $db->sql_fetchrow($db->sql_query("SELECT name FROM ".$prefix."_authors WHERE aid='$aid'"));
		while ($row = $db->sql_fetchrow($result)) {
			$admins = explode(",", $row['admins']);
			$auth_user = 0;
			for ($i=0; $i < sizeof($admins); $i++) {
			if ($row2['name'] == $admins[$i]) {
					$auth_user = 1;
				}
			}
			if ($auth_user == 1) {
				$radminarticle = 1;
			}
		}
		$result2 = $db->sql_query("select aid from ".$prefix."_stories where sid='$sid'");
		list($aaid) = $db->sql_fetchrow($result2);
		$aaid = substr("$aaid", 0,25);
		if (($radminarticle == 1) AND ($aaid == $aid) OR ($radminsuper == 1)) {
			if($ok) {
				$counter--;
				$db->sql_query("DELETE FROM ".$prefix."_stories where sid='$sid'");
				$db->sql_query("DELETE FROM ".$prefix."_comments where sid='$sid'");
				$db->sql_query("update ".$prefix."_poll_desc set artid='0' where artid='$sid'");
				$result = $db->sql_query("update ".$prefix."_authors set counter='$counter' where aid='$aid'");
				if ($ultramode) {
					ultramode();
				}
				Header("Location: ".$admin_file.".php");
			} else {
				include("header.php");
				GraphicAdmin();
				OpenTable();
				echo "<center><font class=\"title\"><b>"._ARTICLEADMIN."</b></font></center>";
				CloseTable();
				echo "<br>";
				OpenTable();
				echo "<center>"._REMOVESTORY." $sid "._ANDCOMMENTS."";
				echo "<br><br>[ <a href=\"".$admin_file.".php\">"._NO."</a> | <a href=\"".$admin_file.".php?op=RemoveStory&amp;sid=$sid&amp;ok=1\">"._YES."</a> ]</center>";
				CloseTable();
				include("footer.php");
			}
		} else {
			include ('header.php');
			GraphicAdmin();
			OpenTable();
			echo "<center><font class=\"title\"><b>"._ARTICLEADMIN."</b></font></center>";
			CloseTable();
			echo "<br>";
			OpenTable();
			echo "<center><b>"._NOTAUTHORIZED1."</b><br><br>"
			.""._NOTAUTHORIZED2."<br><br>"
			.""._GOBACK."";
			CloseTable();
			include("footer.php");
		}
	}

	function changeStory($sid, $subject, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $assotop) {
		global $aid, $ultramode, $prefix, $db, $admin_file;
		for ($i=0; $i<sizeof($assotop); $i++) {
			$associated .= "$assotop[$i]-";
		}
		$sid = intval($sid);
		$aid = substr("$aid", 0,25);
		$result = $db->sql_query("select radminsuper from ".$prefix."_authors where aid='$aid'");
		list($radminsuper) = $db->sql_fetchrow($result);
		$radminsuper = intval($radminsuper);
		$result = $db->sql_query("SELECT admins FROM ".$prefix."_modules WHERE title='News'");
		$row2 = $db->sql_fetchrow($db->sql_query("SELECT name FROM ".$prefix."_authors WHERE aid='$aid'"));
		while ($row = $db->sql_fetchrow($result)) {
			$admins = explode(",", $row['admins']);
			$auth_user = 0;
			for ($i=0; $i < sizeof($admins); $i++) {
			if ($row2['name'] == $admins[$i]) {
					$auth_user = 1;
				}
			}
			if ($auth_user == 1) {
				$radminarticle = 1;
			}
		}
		$result2 = $db->sql_query("select aid from ".$prefix."_stories where sid='$sid'");
		list($aaid) = $db->sql_fetchrow($result2);
		$aaid = substr("$aaid", 0,25);
		if (($radminarticle == 1) AND ($aaid == $aid) OR ($radminsuper == 1)) {
			$subject = filter($subject, "nohtml", 1);
			$hometext = filter($hometext, "", 1);
			$bodytext = filter($bodytext, "", 1);
			$notes = filter($notes, "", 1);
			$db->sql_query("update ".$prefix."_stories set catid='$catid', title='$subject', hometext='$hometext', bodytext='$bodytext', topic='$topic', notes='$notes', ihome='$ihome', alanguage='$alanguage', acomm='$acomm', associated='$associated' where sid='$sid'");
			if ($ultramode) {
				ultramode();
			}
			Header("Location: ".$admin_file.".php?op=adminMain");
		}
	}

	function adminStory() {
		global $prefix, $db, $language, $multilingual, $admin_file;
		include ('header.php');
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>"._ARTICLEADMIN."</b></font></center>";
		CloseTable();
		echo "<br>";
		$today = getdate();
		$tday = $today['mday'];
		if ($tday < 10){
			$tday = "0$tday";
		}
		$tmonth = $today['month'];
		$ttmon = $today['mon'];
		if ($ttmon < 10){
			$ttmon = "0$ttmon";
		}
		$tyear = $today['year'];
		$thour = $today['hours'];
		if ($thour < 10){
			$thour = "0$thour";
		}
		$tmin = $today['minutes'];
		if ($tmin < 10){
			$tmin = "0$tmin";
		}
		$tsec = $today['seconds'];
		if ($tsec < 10){
			$tsec = "0$tsec";
		}
		$nowdate = "$tmonth $tday, $tyear @ $thour:$tmin:$tsec";
		OpenTable();
		echo "<center><font class=\"option\"><b>"._ADDARTICLE."</b></font></center><br><br>"
			."<table width=\"100%\" border=\"0\" cellspacing=\"6\">"
			."<tr><td><form action=\"".$admin_file.".php\" method=\"post\">"
			."<b>"._TITLE.":</b></td><td><input type=\"text\" name=\"subject\" size=\"50\"></td></tr>"
			."<tr><td><b>"._TOPIC.":</b></td><td>";
		$toplist = $db->sql_query("select topicid, topictext from ".$prefix."_topics order by topictext");
		echo "<select name=\"topic\">";
		echo "<option value=\"\">"._SELECTTOPIC."</option>\n";
		while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
			$topicid = intval($topicid);
			$topics = filter($topics, "nohtml");
			if ($topicid == $topic) {
				$sel = "selected ";
			}
			echo "<option $sel value=\"$topicid\">$topics</option>\n";
			$sel = "";
		}
		echo "</select></td></tr>"
			."<tr><td nowrap><b>"._ASSOTOPIC.":</b></td><td>";
		$sql = "SELECT topicid, topictext FROM ".$prefix."_topics ORDER BY topictext";
		$result = $db->sql_query($sql);
		echo "<select multiple name=\"assotop[]\" size=\"3\">";
		while ($row = $db->sql_fetchrow($result)) {
			$row['topicid'] = intval($row['topicid']);
			$row['topictext'] = filter($row['topictext'], "nohtml");
			echo "<option value='".$row['topicid']."'>".$row['topictext']."</option>";
		}
		echo "</select></td></tr>";
		$cat = 0;
		$selcat = $db->sql_query("select catid, title from ".$prefix."_stories_cat order by title");
		$a = 1;
		echo "<tr><td><b>"._CATEGORY.":</b></td><td>"
			."<select name=\"catid\">";
		if ($cat == 0) {
			$sel = "selected";
		} else {
			$sel = "";
		}
		echo "<option name=\"catid\" value=\"0\" $sel>"._ARTICLES."</option>";
		while(list($catid, $title) = $db->sql_fetchrow($selcat)) {
			$catid = intval($catid);
			$title = filter($title, "nohtml");
			if ($catid == $cat) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			echo "<option name=\"catid\" value=\"$catid\" $sel>$title</option>";
			$a++;
		}
		echo "</select> &nbsp; <a href=\"".$admin_file.".php?op=AddCategory\"><img src=\"images/add.gif\" alt=\""._ADD."\" title=\""._ADD."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=EditCategory\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=DelCategory\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a>"
			."</td></tr>"
			."<tr><td><b>"._PUBLISHINHOME."</b></td><td>";
		if (($ihome == 0) OR (empty($ihome))) {
			$sel1 = "checked";
			$sel2 = "";
		}
		if ($ihome == 1) {
			$sel1 = "";
			$sel2 = "checked";
		}
		echo "<input type=\"radio\" name=\"ihome\" value=\"0\" $sel1>"._YES."&nbsp;"
			."<input type=\"radio\" name=\"ihome\" value=\"1\" $sel2>"._NO.""
			."&nbsp;&nbsp;<font class=\"content\">[ "._ONLYIFCATSELECTED." ]</font></td></tr>";
		echo "<tr><td><b>"._ACTIVATECOMMENTS."</b></td><td>";
		if (($acomm == 0) OR (empty($acomm))) {
			$sel1 = "checked";
			$sel2 = "";
		}
		if ($acomm == 1) {
			$sel1 = "";
			$sel2 = "checked";
		}
		echo "<input type=\"radio\" name=\"acomm\" value=\"0\" $sel1>"._YES."&nbsp;"
			."<input type=\"radio\" name=\"acomm\" value=\"1\" $sel2>"._NO."</font></td></tr>";
		if ($multilingual == 1) {
			echo "<tr><td><b>"._LANGUAGE.":</b></td><td>"
				."<select name=\"alanguage\">";
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
			for ($i=0; $i < sizeof($languageslist); $i++) {
				if(!empty($languageslist[$i])) {
					echo "<option value=\"$languageslist[$i]\" ";
					if($languageslist[$i]==$language) echo "selected";
					echo ">".ucfirst($languageslist[$i])."</option>\n";
				}
			}
			echo "<option value=\"\">"._ALL."</option></select></td></tr>";
		} else {
			echo "<input type=\"hidden\" name=\"alanguage\" value=\"$language\"></td></tr>";
		}
		echo "<tr><td><b>"._STORYTEXT.":</b></td><td>"
			."<textarea wrap=\"virtual\" cols=\"70\" rows=\"15\" name=\"hometext\"></textarea></td></tr>"
			."<tr><td><b>"._EXTENDEDTEXT.":</b></td><td>"
			."<textarea wrap=\"virtual\" cols=\"70\" rows=\"15\" name=\"bodytext\"></textarea><br>"
			."<font class=\"content\">"._ARESUREURL."</font></td></tr>"
			."<tr><td colspan=\"2\"><hr noshade size=\"1\"></td></tr>"
			."<tr><td><b>"._SCHEDULENEWS.":</b></td><td>"
			."<input type=radio name=automated value=1>"._YES." &nbsp;&nbsp;"
			."<input type=radio name=automated value=0 checked>"._NO."</td></tr>"
			."<tr><td><b>"._PUBLISHON.":</b></td><td>";
		$day = 1;
		echo ""._DAY.": <select name=\"day\">";
		while ($day <= 31) {
			if ($tday==$day) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			echo "<option name=\"day\" $sel>$day</option>";
			$day++;
		}
		echo "</select>";
		$month = 1;
		echo " "._UMONTH.": <select name=\"month\">";
		while ($month <= 12) {
			if ($ttmon==$month) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			echo "<option name=\"month\" $sel>$month</option>";
			$month++;
		}
		echo "</select>";
		$date = getdate();
		$year = $date['year'];
		echo " "._YEAR.": <input type=\"text\" name=\"year\" value=\"$year\" size=\"5\" maxlength=\"4\">"
		." <b>@</b> "._HOUR.": <select name=\"hour\">";
		$hour = 0;
		$cero = "0";
		while ($hour <= 23) {
			$dummy = $hour;
			if ($hour < 10) {
				$hour = "$cero$hour";
			}
			echo "<option name=\"hour\">$hour</option>";
			$hour = $dummy;
			$hour++;
		}
		echo "</select>"
		." : <select name=\"min\">";
		$min = 0;
		while ($min <= 59) {
			if (($min == 0) OR ($min == 5)) {
				$min = "0$min";
			}
			echo "<option name=\"min\">$min</option>";
			$min = $min + 5;
		}
		echo "</select>"
			." : 00</td></tr>"
			."<tr><td>&nbsp;</td><td>"._NOWIS.": $nowdate</td></tr>"
			."<tr><td colspan=\"2\"><hr noshade size=\"1\"></td></tr>"
			."<tr><td>&nbsp;</td><td><select name=\"op\">"
			."<option value=\"PreviewAdminStory\" selected>"._PREVIEWSTORY."</option>"
			."<option value=\"PostAdminStory\">"._POSTSTORY."</option>"
			."</select>"
			."&nbsp;&nbsp;<input type=\"submit\" value=\""._OK."\"></td></tr></table>";
		CloseTable();
		echo "<br>";
		putpoll("", array_fill(1, 12, ""));	
		echo "</form>";
		include ('footer.php');
	}

	function previewAdminStory($automated, $year, $day, $month, $hour, $min, $subject, $hometext, $bodytext, $topic, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop) {
		global $user, $bgcolor1, $bgcolor2, $prefix, $db, $alanguage, $multilingual, $admin_file;
		include ('header.php');
		if ($topic<1) {
			$topic = 1;
		}
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>"._ARTICLEADMIN."</b></font></center>";
		CloseTable();
		echo "<br>";
		$today = getdate();
		$tday = $today['mday'];
		if ($tday < 10){
			$tday = "0$tday";
		}
		$tmonth = $today['month'];
		$tyear = $today['year'];
		$thour = $today['hours'];
		if ($thour < 10){
			$thour = "0$thour";
		}
		$tmin = $today['minutes'];
		if ($tmin < 10){
			$tmin = "0$tmin";
		}
		$tsec = $today['seconds'];
		if ($tsec < 10){
			$tsec = "0$tsec";
		}
		$nowdate = "$tmonth $tday, $tyear @ $thour:$tmin:$tsec";
		OpenTable();
		echo "<center><font class=\"option\"><b>"._PREVIEWSTORY."</b></font></center><br>"
			."<form action=\"".$admin_file.".php\" method=\"post\">"
			."<input type=\"hidden\" name=\"catid\" value=\"$catid\">";
		$subject = filter($subject, "nohtml", 0, preview);
		$hometext = filter($hometext);
		$bodytext = filter($bodytext);
		$result = $db->sql_query("select topicimage from ".$prefix."_topics where topicid='$topic'");
		list($topicimage) = $db->sql_fetchrow($result);
		echo "<table border=\"0\" width=\"75%\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"$bgcolor2\" align=\"center\"><tr><td>"
			."<table border=\"0\" width=\"100%\" cellpadding=\"8\" cellspacing=\"1\" bgcolor=\"$bgcolor1\"><tr><td>"
			."<img src=\"images/topics/$topicimage\" border=\"0\" align=\"right\" alt=\"\">";
		themepreview($subject, $hometext, $bodytext);
		echo "</td></tr></table></td></tr></table><br><br>"
			."<table width=\"100%\" border=\"0\" cellspacing=\"6\">"
			."<tr><td nowrap><b>"._TITLE.":</b></td><td>"
			."<input type=\"text\" name=\"subject\" size=\"50\" value=\"$subject\"></td></tr>"
			."<tr><td nowrap><b>"._TOPIC.":</b></td><td><select name=\"topic\">";
		$toplist = $db->sql_query("select topicid, topictext from ".$prefix."_topics order by topictext");
		echo "<option value=\"\">"._ALLTOPICS."</option>\n";
		while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
			$topicid = intval($topicid);
			$topics = filter($topics, "nohtml");
			if ($topicid==$topic) {
				$sel = "selected ";
			}
			echo "<option $sel value=\"$topicid\">$topics</option>\n";
			$sel = "";
		}
		echo "</select></td></tr>";
		for ($i=0; $i<sizeof($assotop); $i++) {
			$associated .= "$assotop[$i]-";
		}
		$asso_t = explode("-", $associated);
		echo "<tr><td nowrap><b>"._ASSOTOPIC.":</b></td><td>";
		$sql = "SELECT topicid, topictext FROM ".$prefix."_topics ORDER BY topictext";
		$result = $db->sql_query($sql);
		echo "<select multiple name=\"assotop[]\" size=\"3\">";
		while ($row = $db->sql_fetchrow($result)) {
			for ($i=0; $i<sizeof($asso_t); $i++) {
				if ($asso_t[$i] == $row['topicid']) {
					$checked = "selected";
					break;
				}
			}
			$row['topicid'] = intval($row['topicid']);
			$row['topictext'] = filter($row['topictext'], "nohtml");
			echo "<option value='".$row['topicid']."' $checked>".$row['topictext']."</option>";
			$checked = "";
		}
		echo "</select></td></tr>";
		$cat = $catid;
		$selcat = $db->sql_query("select catid, title from ".$prefix."_stories_cat order by title");
		$a = 1;
		echo "<tr><td nowrap><b>"._CATEGORY.":</b></td><td>";
		echo "<select name=\"catid\">";
		if ($cat == 0) {
			$sel = "selected";
		} else {
			$sel = "";
		}
		echo "<option name=\"catid\" value=\"0\" $sel>"._ARTICLES."</option>";
		while(list($catid, $title) = $db->sql_fetchrow($selcat)) {
			$catid = intval($catid);
			$title = filter($title, "nohtml");
			if ($catid == $cat) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			echo "<option name=\"catid\" value=\"$catid\" $sel>$title</option>";
			$a++;
		}
		echo "</select> &nbsp; <a href=\"".$admin_file.".php?op=AddCategory\"><img src=\"images/add.gif\" alt=\""._ADD."\" title=\""._ADD."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=EditCategory\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=DelCategory\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a>"
			."</td></tr>"
			."<tr><td nowrap><b>"._PUBLISHINHOME."</b></td><td>";
		if (($ihome == 0) OR (empty($ihome))) {
			$sel1 = "checked";
			$sel2 = "";
		}
		if ($ihome == 1) {
			$sel1 = "";
			$sel2 = "checked";
		}
		echo "<input type=\"radio\" name=\"ihome\" value=\"0\" $sel1>"._YES."&nbsp;"
			."<input type=\"radio\" name=\"ihome\" value=\"1\" $sel2>"._NO.""
			."&nbsp;&nbsp;<font class=\"content\">[ "._ONLYIFCATSELECTED." ]</font></td></tr>"
			."<tr><td nowrap><b>"._ACTIVATECOMMENTS."</b></td><td>";
		if (($acomm == 0) OR (empty($acomm))) {
			$sel1 = "checked";
			$sel2 = "";
		}
		if ($acomm == 1) {
			$sel1 = "";
			$sel2 = "checked";
		}
		echo "<input type=\"radio\" name=\"acomm\" value=\"0\" $sel1>"._YES."&nbsp;"
			."<input type=\"radio\" name=\"acomm\" value=\"1\" $sel2>"._NO."</font></td></tr>";
		if ($multilingual == 1) {
			echo "<tr><td nowrap><b>"._LANGUAGE.": </b>"
				."<select name=\"alanguage\">";
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
			for ($i=0; $i < sizeof($languageslist); $i++) {
				if(!empty($languageslist[$i])) {
					echo "<option value=\"$languageslist[$i]\" ";
					if($languageslist[$i]==$alanguage) echo "selected";
					echo ">".ucfirst($languageslist[$i])."</option>\n";
				}
			}
			if (empty($alanguage)) {
				$sellang = "selected";
			} else {
				$sellang = "";
			}
			echo "<option value=\"\" $sellang>"._ALL."</option></select></td></tr>";
		} else {
			echo "<input type=\"hidden\" name=\"alanguage\" value=\"$language\"></td></tr>";
		}
		echo "<tr><td nowrap><b>"._STORYTEXT.":</b></td><td>"
			."<textarea wrap=\"virtual\" cols=\"70\" rows=\"15\" name=\"hometext\">$hometext</textarea></td></tr>"
			."<tr><td nowrap><b>"._EXTENDEDTEXT.":</b></td><td>"
			."<textarea wrap=\"virtual\" cols=\"70\" rows=\"15\" name=\"bodytext\">$bodytext</textarea></td></tr>";
		if ($automated == 1) {
			$sel1 = "checked";
			$sel2 = "";
		} else {
			$sel1 = "";
			$sel2 = "checked";
		}
		echo "<tr><td colspan=\"2\"><hr noshade size=\"1\"></td></tr>"
			."<tr><td nowrap><b>"._SCHEDULENEWS.":</b></td><td>"
			."<input type=\"radio\" name=\"automated\" value=\"1\" $sel1>"._YES." &nbsp;&nbsp;"
			."<input type=\"radio\" name=\"automated\" value=\"0\" $sel2>"._NO."</td></tr>";
		$xday = 1;
		echo "<tr><td nowrap><b>"._PUBLISHON.":</b></td><td>"
			.""._DAY.": <select name=\"day\">";
		while ($xday <= 31) {
			if ($xday == $day) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			echo "<option name=\"day\" $sel>$xday</option>";
			$xday++;
		}
		echo "</select>";
		$xmonth = 1;
		echo " "._UMONTH.": <select name=\"month\">";
		while ($xmonth <= 12) {
			if ($xmonth == $month) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			echo "<option name=\"month\" $sel>$xmonth</option>";
			$xmonth++;
		}
		echo "</select>";
		echo " "._YEAR.": <input type=\"text\" name=\"year\" value=\"$year\" size=\"5\" maxlength=\"4\">";
		echo " <b>@</b>"._HOUR.": <select name=\"hour\">";
		$xhour = 0;
		$cero = "0";
		while ($xhour <= 23) {
			$dummy = $xhour;
			if ($xhour < 10) {
				$xhour = "$cero$xhour";
			}
			if ($xhour == $hour) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			echo "<option name=\"hour\" $sel>$xhour</option>";
			$xhour = $dummy;
			$xhour++;
		}
		echo "</select>";
		echo " : <select name=\"min\">";
		$xmin = 0;
		while ($xmin <= 59) {
			if (($xmin == 0) OR ($xmin == 5)) {
				$xmin = "0$xmin";
			}
			if ($xmin == $min) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			echo "<option name=\"min\" $sel>$xmin</option>";
			$xmin = $xmin + 5;
		}
		echo "</select>";
		echo " : 00</td></tr>"
			."<tr><td>&nbsp;</td><td>"._NOWIS.": $nowdate</td></tr>"
			."<tr><td colspan=\"2\"><hr noshade size=\"1\"></td></tr>"
			."<tr><td>&nbsp;</td><td><select name=\"op\">"
			."<option value=\"PreviewAdminStory\" selected>"._PREVIEWSTORY."</option>"
			."<option value=\"PostAdminStory\">"._POSTSTORY."</option>"
			."</select>"
			."&nbsp;&nbsp;<input type=\"submit\" value=\""._OK."\"></td></tr></table>";
		CloseTable();
		echo "<br>";
		putpoll($pollTitle, $optionText);
		echo "</form>";
		include ('footer.php');
	}

	function postAdminStory($automated, $year, $day, $month, $hour, $min, $subject, $hometext, $bodytext, $topic, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop) {
		global $ultramode, $aid, $prefix, $db, $admin_file;
		for ($i=0; $i<sizeof($assotop); $i++) {
			$associated .= "$assotop[$i]-";
		}
		if ($automated == 1) {
			if ($day < 10) {
				$day = "0$day";
			}
			if ($month < 10) {
				$month = "0$month";
			}
			$sec = "00";
			$date = "$year-$month-$day $hour:$min:$sec";
			$notes = "";
			$author = $aid;
			$subject = filter($subject, "nohtml", 1);
			$hometext = filter($hometext, "", 1);
			$bodytext = filter($bodytext, "", 1);
			$result = $db->sql_query("insert into ".$prefix."_autonews values (NULL, '$catid', '$aid', '$subject', '$date', '$hometext', '$bodytext', '$topic', '$author', '$notes', '$ihome', '$alanguage', '$acomm', '$associated')");
			if (!$result) {
				fdie();
			}
			$result = $db->sql_query("update ".$prefix."_authors set counter=counter+1 where aid='$aid'");
			if ($ultramode) {
				ultramode();
			}
			Header("Location: ".$admin_file.".php?op=adminMain");
		} else {
			$subject = filter($subject, "nohtml", 1);
			$hometext = filter($hometext, "", 1);
			$bodytext = filter($bodytext, "", 1);
			if (($pollTitle != "") AND ($optionText[1] != "") AND ($optionText[2] != "")) {
				$haspoll = 1;
				$timeStamp = time();
				$pollTitle = filter($pollTitle, "nohtml", 1);
				if(!$db->sql_query("INSERT INTO ".$prefix."_poll_desc VALUES (NULL, '$pollTitle', '$timeStamp', '0', '$alanguage', '0', '0')")) {
					return;
				}
				$object = $db->sql_fetchrow($db->sql_query("SELECT pollID FROM ".$prefix."_poll_desc WHERE pollTitle='$pollTitle'"));
				$id = $object['pollID'];
				$id = intval($id);
				for($i = 1; $i <= sizeof($optionText); $i++) {
					if(!empty($optionText[$i])) {
						$optionText[$i] = filter($optionText[$i], "nohtml", 1);
					}
					if(!$db->sql_query("INSERT INTO ".$prefix."_poll_data (pollID, optionText, optionCount, voteID) VALUES ('$id', '$optionText[$i]', '0', '$i')")) {
						return;
					}
				}
			} else {
				$haspoll = 0;
				$id = 0;
			}
			$result = $db->sql_query("insert into ".$prefix."_stories values (NULL, '$catid', '$aid', '$subject', now(), '$hometext', '$bodytext', '0', '0', '$topic', '$aid', '$notes', '$ihome', '$alanguage', '$acomm', '$haspoll', '$id', '0', '0', '0', '$associated')");
			$result = $db->sql_query("select sid from ".$prefix."_stories WHERE title='$subject' order by time DESC limit 0,1");
			list($artid) = $db->sql_fetchrow($result);
			$artid = intval($artid);
			$db->sql_query("UPDATE ".$prefix."_poll_desc SET artid='$artid' WHERE pollID='$id'");
			if (!$result) {
				fdie();
			}
			$result = $db->sql_query("update ".$prefix."_authors set counter=counter+1 where aid='$aid'");
			if ($ultramode) {
				ultramode();
			}
			Header("Location: ".$admin_file.".php?op=adminMain");
		}
	}

	function submissions() {
		global $admin, $bgcolor1, $bgcolor2, $prefix, $db, $radminsuper, $anonymous, $multilingual, $admin_file, $user_prefix;
		$dummy = 0;
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>"._SUBMISSIONSADMIN."</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		$result = $db->sql_query("SELECT qid, uid, uname, subject, timestamp, alanguage FROM ".$prefix."_queue order by timestamp DESC");
		if($db->sql_numrows($result) == 0) {
			echo "<table width=\"100%\"><tr><td bgcolor=\"$bgcolor1\" align=\"center\"><b>"._NOSUBMISSIONS."</b></td></tr></table>\n";
		} else {
			echo "<center><font class=\"content\"><b>"._NEWSUBMISSIONS."</b></font><form action=\"".$admin_file.".php\" method=\"post\"><table width=\"100%\" border=\"1\"><tr><td bgcolor=\"$bgcolor2\"><b>&nbsp;"._TITLE."&nbsp;</b></td>";
			if ($multilingual == 1) {
				echo "<td bgcolor=\"$bgcolor2\"><b><center>&nbsp;"._LANGUAGE."&nbsp;</center></b></td>";
			}
			echo "<td bgcolor=\"$bgcolor2\"><b><center>&nbsp;"._AUTHOR."&nbsp;</center></b></td><td bgcolor=\"$bgcolor2\"><b><center>&nbsp;"._DATE."&nbsp;</center></b></td><td bgcolor=\"$bgcolor2\"><b><center>&nbsp;"._FUNCTIONS."&nbsp;</center></b></td></tr>\n";
			while (list($qid, $uid, $uname, $subject, $timestamp, $alanguage) = $db->sql_fetchrow($result)) {
				$qid = intval($qid);
				$uid = intval($uid);
				$subject = filter($subject, "nohtml");
				$row = $db->sql_fetchrow($db->sql_query("SELECT karma FROM ".$user_prefix."_users WHERE user_id='$uid'"));
				if ($row['karma'] == 0) {
					$karma = "&nbsp;";
				} elseif ($row['karma'] == 1) {
					$karma = "&nbsp;<img src=\"images/karma/".$row['karma'].".gif\" alt=\""._KARMALOW."\" title=\""._KARMALOW."\" border=\"0\">";
				} elseif ($row['karma'] == 2) {
					$karma = "&nbsp;<img src=\"images/karma/".$row['karma'].".gif\" alt=\""._KARMABAD."\" title=\""._KARMABAD."\" border=\"0\">";
				} elseif ($row['karma'] == 3) {
					$karma = "&nbsp;<img src=\"images/karma/".$row['karma'].".gif\" alt=\""._KARMADEVIL."\" title=\""._KARMADEVIL."\" border=\"0\">";
				}
				echo "<td width=\"100%\" bgcolor=\"$bgcolor1\"><font class=\"content\">\n";
				if (empty($subject)) {
					echo "&nbsp;<a href=\"".$admin_file.".php?op=DisplayStory&amp;qid=$qid\">"._NOSUBJECT."</a></font>\n";
				} else {
					echo "&nbsp;<a href=\"".$admin_file.".php?op=DisplayStory&amp;qid=$qid\">$subject</a></font>\n";
				}
				if ($multilingual == 1) {
					if (empty($alanguage)) {
						$alanguage = _ALL;
					}
					echo "</td><td align=\"center\" bgcolor=\"$bgcolor1\"><font size=\"2\">&nbsp;$alanguage&nbsp;</font>\n";
				}
				if ($uname != $anonymous) {
					echo "</td><td bgcolor=\"$bgcolor1\" align=\"center\" nowrap><font size=\"2\">&nbsp;<a href='modules.php?name=Your_Account&op=userinfo&username=$uname'>$uname</a>$karma</font>\n";
				} else {
					echo "</td><td bgcolor=\"$bgcolor1\" align=\"center\" nowrap><font size=\"2\">&nbsp;$uname&nbsp;</font>\n";
				}
				$timestamp = explode(" ", $timestamp);
				echo "</td><td bgcolor=\"$bgcolor1\" align=\"right\" nowrap><font class=\"content\">&nbsp;$timestamp[0]&nbsp;</font></td><td bgcolor=\"$bgcolor1\" align=\"center\"><font class=\"content\">&nbsp;<a href=\"".$admin_file.".php?op=DisplayStory&amp;qid=$qid\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=DeleteStory&amp;qid=$qid\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a>&nbsp;</td></tr>\n";
				$dummy++;
			}
			if ($dummy < 1) {
				echo "<tr><td bgcolor=\"$bgcolor1\" align=\"center\"><b>"._NOSUBMISSIONS."</b></form></td></tr></table>\n";
			} else {
				echo "</table></form>\n";
			}
		}
		if ($radminsuper == 1) {
			echo "<br><center>"
			."[ <a href=\"".$admin_file.".php?op=subdelete\">"._DELETE."</a> ]"
			."</center><br>";
		}
		CloseTable();
		include ("footer.php");
	}

	function subdelete() {
		global $prefix, $db, $admin_file;
		$db->sql_query("delete from ".$prefix."_queue");
		Header("Location: ".$admin_file.".php?op=adminMain");
	}

if (!isset($sid)) { $sid = ""; }

	switch($op) {

		case "EditCategory":
		EditCategory($catid);
		break;

		case "subdelete":
		subdelete();
		break;

		case "DelCategory":
		DelCategory($cat);
		break;

		case "YesDelCategory":
		YesDelCategory($catid);
		break;

		case "NoMoveCategory":
		NoMoveCategory($catid, $newcat);
		break;

		case "SaveEditCategory":
		SaveEditCategory($catid, $title);
		break;

		case "SelectCategory":
		SelectCategory($cat);
		break;

		case "AddCategory":
		AddCategory();
		break;

		case "SaveCategory":
		SaveCategory($cat_title);
		break;

		case "DisplayStory":
		displayStory($qid);
		break;

		case "PreviewAgain":
		previewStory($automated, $year, $day, $month, $hour, $min, $qid, $uid, $author, $subject, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop);
		break;

		case "PostStory":
		postStory($automated, $year, $day, $month, $hour, $min, $qid, $uid, $author, $subject, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop);
		break;

		case "EditStory":
		editStory($sid);
		break;

		case "RemoveStory":
		removeStory($sid, $ok);
		break;

		case "ChangeStory":
		changeStory($sid, $subject, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm, $assotop);
		break;

		case "DeleteStory":
		deleteStory($qid);
		break;

		case "adminStory":
		adminStory($sid);
		break;

		case "PreviewAdminStory":
		previewAdminStory($automated, $year, $day, $month, $hour, $min, $subject, $hometext, $bodytext, $topic, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop);
		break;

		case "PostAdminStory":
		postAdminStory($automated, $year, $day, $month, $hour, $min, $subject, $hometext, $bodytext, $topic, $catid, $ihome, $alanguage, $acomm, $pollTitle, $optionText, $assotop);
		break;

		case "autoDelete":
		autodelete($anid);
		break;

		case "autoEdit":
		autoEdit($anid);
		break;

		case "autoSaveEdit":
		autoSaveEdit($anid, $year, $day, $month, $hour, $min, $title, $hometext, $bodytext, $topic, $notes, $catid, $ihome, $alanguage, $acomm);
		break;

		case "submissions":
		submissions();
		break;

		case "publish_now":
		publish_now($anid);
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