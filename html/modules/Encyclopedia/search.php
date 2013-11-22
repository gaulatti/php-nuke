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
include("header.php");
global $db, $prefix;
$query = filter($query);
if ((isset($query) AND !isset($eid)) AND (!empty($query))) {
	$query1 = filter($query, "nohtml", 1);
	$result = $db->sql_query("SELECT tid, title FROM ".$prefix."_encyclopedia_text WHERE title LIKE '%".addslashes($query1)."%'");
	$row = $db->sql_fetchrow($result);
	$ency_title = filter($row['title'], "nohtml");
	title("$ency_title: "._SEARCHRESULTS."");
	OpenTable();
	echo "<center><b>"._SEARCHRESULTSFOR." <i>$query</i></b></center><br><br><br>"
	."<i><b>"._RESULTSINTERMTITLE."</b></i><br><br>";
	if ($numrows = $db->sql_numrows($result) == 0) {
		echo _NORESULTSTITLE;
	} else {
		while ($row = $db->sql_fetchrow($result)) {
			$tid = intval($row['tid']);
			$title = filter($row['title'], "nohtml");
			echo "<strong><big>&middot</big></strong>&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=content&amp;tid=$tid\">$title</a><br>";
		}
	}
	$query2 = filter($query);
	$result2 = $db->sql_query("SELECT tid, title FROM ".$prefix."_encyclopedia_text WHERE text LIKE '%".addslashes($query2)."%'");
	$numrows = $db->sql_numrows($result2);
	echo "<br><br><i><b>"._RESULTSINTERMTEXT."</b></i><br><br>";
	if ($numrows == 0) {
		echo _NORESULTSTEXT;
	} else {
		while ($row2 = $db->sql_fetchrow($result2)) {
			$tid = intval($row2['tid']);
			$title = filter($row2['title'], "nohtml");
			echo "<strong><big>&middot</big></strong>&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=content&amp;tid=$tid&amp;query=$query\">$title</a><br>";
		}
	}
	echo "<br><br>"
	."<center><form action=\"modules.php?name=$module_name&amp;file=search\" method=\"post\">"
	."<input type=\"text\" size=\"20\" name=\"query\">&nbsp;&nbsp;"
	."<input type=\"hidden\" name=\"eid\" value=\"$eid\">"
	."<input type=\"submit\" value=\""._SEARCH."\">"
	."</form><br><br>"
	."[ <a href=\"modules.php?name=$module_name\">"._RETURNTO." $module_name</a> ]<br><br>"
	.""._GOBACK."</center>";
	CloseTable();
} elseif ((isset($query) AND isset($eid)) AND (!empty($query))) {
	$query1 = filter($query, "nohtml", 1);
	$result3 = $db->sql_query("SELECT tid, title FROM ".$prefix."_encyclopedia_text WHERE eid='$eid' AND title LIKE '%".addslashes($query1)."%'");
	$row4 = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_encyclopedia WHERE eid='$eid'"));
	$ency_title = filter($row4['title'], "nohtml");
	title("$ency_title: "._SEARCHRESULTS."");
	OpenTable();
	echo "<center><b>"._SEARCHRESULTSFOR." <i>$query</i></b></center><br><br><br>"
	."<i><b>"._RESULTSINTERMTITLE."</b></i><br><br>";
	if ($numrows = $db->sql_numrows($result3) == 0) {
		echo _NORESULTSTITLE;
	} else {
		while ($row3 = $db->sql_fetchrow($result3)) {
			$tid = intval($row3['tid']);
			$title = filter($row3['title'], "nohtml");
			echo "<strong><big>&middot</big></strong>&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=content&amp;tid=$tid\">$title</a><br>";
		}
	}
	$query2 = filter($query, "", 1);
	$result5 = $db->sql_query("SELECT tid, title FROM ".$prefix."_encyclopedia_text WHERE eid='$eid' AND text LIKE '%".addslashes($query2)."%'");
	$numrows = $db->sql_numrows($result5);
	echo "<br><br><i><b>"._RESULTSINTERMTEXT."</b></i><br><br>";
	if ($numrows == 0) {
		echo _NORESULTSTEXT;
	} else {
		while ($row5 = $db->sql_fetchrow($result5)) {
			$tid = intval($row5['tid']);
			$title = filter($row5['title'], "nohtml");
			echo "<strong><big>&middot</big></strong>&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;op=content&amp;tid=$tid&amp;query=$query\">$title</a><br>";
		}
	}
	echo "<br><br>"
	."<center><form action=\"modules.php?name=$module_name&amp;file=search\" method=\"post\">"
	."<input type=\"text\" size=\"20\" name=\"query\">&nbsp;&nbsp;"
	."<input type=\"hidden\" name=\"eid\" value=\"$eid\">"
	."<input type=\"submit\" value=\""._SEARCH."\">"
	."</form><br><br>"
	."[ <a href=\"modules.php?name=$module_name&amp;op=list_content&amp;eid=$eid\">"._RETURNTO." $ency_title</a> ]<br><br>"
	.""._GOBACK."</center>";
	CloseTable();
} else {
	OpenTable();
	echo "<center>"._SEARCHNOTCOMPLETE."<br><br><br>"
	."<center><form action=\"modules.php?name=$module_name&amp;file=search\" method=\"post\">"
	."<input type=\"text\" size=\"20\" name=\"query\">&nbsp;&nbsp;"
	."<input type=\"hidden\" name=\"eid\" value=\"$eid\">"
	."<input type=\"submit\" value=\""._SEARCH."\">"
	."</form><br><br>"
	.""._GOBACK."</center>";
	CloseTable();
}

include("footer.php");

?>