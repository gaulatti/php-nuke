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
$pagetitle = "- "._SUBMITNEWS."";

function defaultDisplay() {
	global $AllowableHTML, $prefix, $user, $cookie, $anonymous, $currentlang, $multilingual, $db, $module_name, $nuke_editor;
	include ("header.php");
	OpenTable();
	echo "<center><font class=\"title\"><b>"._SUBMITNEWS."</b></font>";
	CloseTable();
	echo "<br>";
	info_box("caution", _SUBMITADVICE);
	//OpenTable();
	//echo "<br><center><img src=\"images/system/caution.gif\" border=\"0\" alt=\"\" title=\"\"><br><br><font class=\"content\"><i>"._SUBMITADVICE."</i></font></center><br>";
	//CloseTable();
	echo "<br>";
	OpenTable();
	if (is_user($user)) getusrinfo($user);
	echo "<table border=\"0\" widht=\"100%\">";
	echo "<tr><td><form action=\"modules.php?name=$module_name\" method=\"post\">"
		."<b>"._YOURNAME.":</b></td><td>";
	if (is_user($user)) {
		cookiedecode($user);
		echo "<a href=\"modules.php?name=Your_Account\">$cookie[1]</a> <font class=\"content\">[ <a href=\"modules.php?name=Your_Account&amp;op=logout\">"._LOGOUT."</a> ]</font>";
	} else {
		echo "$anonymous <font class=\"content\">[ <a href=\"modules.php?name=Your_Account\">"._NEWUSER."</a> ]</font>";
	}
	echo "</td></tr>"
		."<tr><td colspan=\"2\">&nbsp;</td></tr>"
		."<tr><td><b>"._SUBTITLE.":</b></td><td>"
		."<input type=\"text\" name=\"subject\" size=\"50\" maxlength=\"80\"><br>("._BEDESCRIPTIVE.")</td></tr>"
		."<tr><td colspan=\"2\">&nbsp;</td></tr>"
		."<tr><td><b>"._TOPIC.":</b></td><td><select name=\"topic\">";
	$result = $db->sql_query("SELECT topicid, topictext FROM ".$prefix."_topics ORDER BY topictext");
	echo "<option value=\"\">"._SELECTTOPIC."</option>\n";
	while ($row = $db->sql_fetchrow($result)) {
		$topicid = intval($row['topicid']);
		$topics = filter($row['topictext'], "nohtml");
		if ($topicid == $topic) {
			$sel = "selected ";
		}
		echo "<option $sel value=\"$topicid\">$topics</option>\n";
		$sel = "";
	}
	echo "</select></td></tr>";
	if ($multilingual == 1) {
		echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
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
				if($languageslist[$i]==$currentlang) echo "selected";
				echo ">".ucfirst($languageslist[$i])."</option>\n";
			}
		}
		echo "</select></td></tr>";
	} else {
		echo "<input type=\"hidden\" name=\"alanguage\" value=\"$language\">";
	}
	echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
	echo "<tr><td><b>"._STORYTEXT.":</b></td><td>"
	."<textarea cols=\"70\" rows=\"15\" name=\"story\"></textarea></td></tr>"
	."<tr><td colspan=\"2\">&nbsp;</td></tr>"
	."<tr><td><b>"._EXTENDEDTEXT.":</b></td><td>"
	."<textarea cols=\"70\" rows=\"15\" name=\"storyext\"></textarea><br>"
	."<font class=\"content\">("._AREYOUSURE.")<br>";
	if ($nuke_editor == 0) {
    	echo "<font class=\"content\">"._ALLOWEDHTML."<br>";
    	while (list($key,) = each($AllowableHTML)) echo " &lt;".$key."&gt;";
    	echo "</font>";
	} else {
		echo ""._HTMLNOTALLOWED."</font>";
	}
	echo "</td></tr>";
	echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
	echo "<tr><td>&nbsp;</td><td><hr noshade size=\"1\"></td></tr>";
	echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
	echo "<tr><td>&nbsp;</td><td><input type=\"submit\" name=\"op\" value=\""._PREVIEW."\"> ("._SUBPREVIEW.")</font></form>";
	echo "</td></tr></table>";
	CloseTable();
	include ('footer.php');
}

function PreviewStory($name, $address, $subject, $story, $storyext, $topic, $alanguage) {
	global $user, $cookie, $bgcolor1, $bgcolor2, $anonymous, $prefix, $multilingual, $AllowableHTML, $db, $module_name, $nuke_editor;
	include ("header.php");
	$f_story = filter($story);
	$f_storyext = filter($storyext);
	$subject = filter($subject, "nohtml", 0, preview);
	$story2 = "$f_story<br><br>$f_storyext";
	OpenTable();
	echo "<center><font class=\"title\"><b>"._NEWSUBPREVIEW."</b></font>";
	CloseTable();
	echo "<br>";
	OpenTable();
	echo "<center><i>"._STORYLOOK."</i></center><br><br>";
	echo "<table width=\"70%\" bgcolor=\"$bgcolor2\" cellpadding=\"0\" cellspacing=\"1\" border=\"0\"align=\"center\"><tr><td>"
	."<table width=\"100%\" bgcolor=\"$bgcolor1\" cellpadding=\"8\" cellspacing=\"1\" border=\"0\"><tr><td>";
	if (empty($topic)) {
		$topicimage="AllTopics.gif";
		$warning = "<center><blink><b>"._SELECTTOPIC."</b></blink></center>";
	} else {
		$warning = "";
		$row = $db->sql_fetchrow($db->sql_query("SELECT topictext, topicimage FROM ".$prefix."_topics WHERE topicid='$topic'"));
		$topicimage = filter($row['topicimage'], "nohtml");
	}
	echo "<img src=\"images/topics/$topicimage\" border=\"0\" align=\"right\" alt=\"".$row['topictext']."\" title=\"".$row['topictext']."\">";
	themepreview($subject, $story2);
	echo "$warning"
		."</td></tr></table></td></tr></table>"
		."<br><br><center><font class=\"tiny\">"._CHECKSTORY."</font></center>";
	CloseTable();
	echo "<br>";
	OpenTable();
	echo "<table border=\"0\" widht=\"100%\">";
	echo "<tr><td><form action=\"modules.php?name=$module_name\" method=\"post\">"
		."<b>"._YOURNAME.":</b></td><td>";
	if (is_user($user)) {
		cookiedecode($user);
		echo "<a href=\"modules.php?name=Your_Account\">$cookie[1]</a> <font class=\"content\">[ <a href=\"modules.php?name=Your_Account&amp;op=logout\">"._LOGOUT."</a> ]</font>";
	} else {
		echo "$anonymous";
	}
	echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
	echo "</td></tr>";
	echo "<tr><td><b>"._SUBTITLE.":</b></td><td>"
		."<input type=\"text\" name=\"subject\" size=\"50\" maxlength=\"80\" value=\"$subject\"><br>("._BEDESCRIPTIVE.")</td></tr>"
		."<tr><td colspan=\"2\">&nbsp;</td></tr>"
		."<tr><td><b>"._TOPIC.":</b></td><td><select name=\"topic\">";
	$result2 = $db->sql_query("SELECT topicid, topictext FROM ".$prefix."_topics ORDER BY topictext");
	echo "<OPTION VALUE=\"\">"._SELECTTOPIC."</option>\n";
	while ($row2 = $db->sql_fetchrow($result2)) {
		$topicid = intval($row2['topicid']);
		$topics = filter($row2['topictext'], "nohtml");
		if ($topicid == $topic) {
			$sel = "selected ";
		}
		echo "<option $sel value=\"$topicid\">$topics</option>\n";
		$sel = "";
	}
	echo "</select></td></tr>";
	if ($multilingual == 1) {
		echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
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
		echo "</select></td></tr>";
	}
	echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
	echo "<tr><td><b>"._STORYTEXT.":</b></td><td>"
		."<textarea cols=\"70\" rows=\"15\" name=\"story\">$f_story</textarea></td></tr>"
		."<tr><td colspan=\"2\">&nbsp;</td></tr>"
		."<tr><td><b>"._EXTENDEDTEXT.":</b></td><td>"
		."<textarea cols=\"70\" rows=\"15\" name=\"storyext\">$f_storyext</textarea><br>"
		."<font class=\"content\">("._AREYOUSURE.")</font><br>";
	if ($nuke_editor == 0) {
    	echo "<font class=\"content\">"._ALLOWEDHTML."";
    	while (list($key,) = each($AllowableHTML)) echo " &lt;".$key."&gt;";
    	echo "</font></td></tr>";
	} else {
		echo ""._HTMLNOTALLOWED."</font></td></tr>";
	}
	echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
	echo "<tr><td>&nbsp;</td><td><hr noshade size=\"1\"></td></tr>";
	echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
	echo "<tr><td>&nbsp;</td><td><input type=\"submit\" name=\"op\" value=\""._PREVIEW."\">&nbsp;&nbsp;"
		."<input type=\"submit\" name=\"op\" value=\""._OK."\"></form>"
		."</td></tr></table>";
	CloseTable();
	include ("footer.php");
}

function submitStory($name, $address, $subject, $story, $storyext, $topic, $alanguage) {
	global $user, $EditedMessage, $cookie, $anonymous, $notify, $notify_email, $notify_subject, $notify_message, $notify_from, $prefix, $db;
	if (is_user($user)) {
		cookiedecode($user);
		$uid = $cookie[0];
		$name = $cookie[1];
	} else {
		$uid = 1;
		$name = "$anonymous";
	}
	$subject = filter($subject, "nohtml", 1);
	$story = filter($story, "", 1);
	$storyext = filter($storyext, "", 1);
	$numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_queue WHERE subject='$subject' OR story='$story'"));
	if ($numrows == 0) {
		$result = $db->sql_query("INSERT INTO ".$prefix."_queue VALUES (NULL, '$uid', '$name', '$subject', '$story', '$storyext', now(), '$topic', '$alanguage')");
		if(!$result) {
			echo ""._ERROR."<br>";
			exit();
		}
	}
	if($notify) {
		$notify_message = "$notify_message\n\n\n========================================================\n$subject\n\n\n$story\n\n$storyext\n\n$name";
		mail($notify_email, $notify_subject, $notify_message, "From: $notify_from\nX-Mailer: PHP/" . phpversion());
	}
	include ("header.php");
	OpenTable();
	$waiting = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_queue"));
	echo "<center><font class=\"title\">"._SUBSENT."</font><br><br>"
	."<font class=\"content\"><b>"._THANKSSUB."</b><br><br>"
	.""._SUBTEXT.""
	."<br>"._WEHAVESUB." $waiting "._WAITING."";
	CloseTable();
	include ("footer.php");
}

if (!isset($address)) { $address = ""; }
if (!isset($alanguage)) { $alanguage = ""; }

switch($op) {

	case ""._PREVIEW."":
	PreviewStory($name, $address, $subject, $story, $storyext, $topic, $alanguage);
	break;

	case ""._OK."":
	SubmitStory($name, $address, $subject, $story, $storyext, $topic, $alanguage);
	break;

	default:
	defaultDisplay();
	break;

}

?>