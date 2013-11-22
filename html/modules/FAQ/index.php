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

$pagetitle = "- $module_name";

function ShowFaq($id_cat, $categories) {
	global $bgcolor2, $sitename, $prefix, $db, $module_name;
    $categories = filter($categories, "nohtml");
	OpenTable();
	echo"<center><font class=\"content\"><b>$sitename "._FAQ2."</b></font></center><br><br>"
	."<a name=\"top\"></a><br>" /* Bug fix : added missing closing hyperlink tag messes up display */
	.""._CATEGORY.": <a href=\"modules.php?name=$module_name\">"._MAIN."</a> -> $categories"
	."<br><br>"
	."<table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">"
	."<tr bgcolor=\"$bgcolor2\"><td colspan=\"2\"><font class=\"option\"><b>"._QUESTION."</b></font></td></tr><tr><td colspan=\"2\">";
	$id_cat = intval($id_cat);
	$result = $db->sql_query("SELECT id, id_cat, question, answer FROM ".$prefix."_faqanswer WHERE id_cat='$id_cat'");
	while ($row = $db->sql_fetchrow($result)) {
		$id = intval($row['id']);
		$id_cat = intval($row['id_cat']);
		$question = filter($row['question'], "nohtml");
		$answer = filter($row['answer']);
		echo"<strong><big>&middot;</big></strong>&nbsp;&nbsp;<a href=\"#$id\">$question</a><br>";
	}
	echo "</td></tr></table>
    <br>";
}

function ShowFaqAll($id_cat) {
	global $bgcolor2, $prefix, $db, $module_name;
	$id_cat = intval($id_cat);
	echo "<table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">"
	."<tr bgcolor=\"$bgcolor2\"><td colspan=\"2\"><font class=\"option\"><b>"._ANSWER."</b></font></td></tr>";
	$id_cat = intval($id_cat);
	$result = $db->sql_query("SELECT id, id_cat, question, answer FROM ".$prefix."_faqanswer WHERE id_cat='$id_cat'");
	while ($row = $db->sql_fetchrow($result)) {
		$id = intval($row['id']);
		$id_cat = intval($row['id_cat']);
		$question = filter($row['question'], "nohtml");
		$answer = filter($row['answer']);
		echo"<tr><td><a name=\"$id\"></a>"
		."<strong><big>&middot;</big></strong>&nbsp;&nbsp;<b>$question</b>"
		."<p align=\"justify\">$answer</p>"
		."[ <a href=\"#top\">"._BACKTOTOP."</a> ]"
		."<br><br>"
		."</td></tr>";
	}
	echo "</table><br><br>"
	."<div align=\"center\"><b>[ <a href=\"modules.php?name=$module_name\">"._BACKTOFAQINDEX."</a> ]</b></div>";
}

if (!isset($myfaq)) {
	global $currentlang, $multilingual;
	if ($multilingual == 1) {
		$querylang = "WHERE flanguage='$currentlang'";
	} else {
		$querylang = "";
	}
	include("header.php");
	OpenTable();
	echo "<center><font class=\"option\">"._FAQ2."</font></center><br><br>"
	."<table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">"
	."<tr><td bgcolor=\"$bgcolor2\"><font class=\"option\"><b>"._CATEGORIES."</b></font></td></tr><tr><td>";
	$result2 = $db->sql_query("SELECT id_cat, categories FROM ".$prefix."_faqcategories $querylang");
	while ($row2 = $db->sql_fetchrow($result2)) {
		$id_cat = intval($row2['id_cat']);
		$categories = filter($row2['categories'], "nohtml");
		echo"<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=$module_name&amp;myfaq=yes&amp;id_cat=$id_cat&amp;categories=$catname\">$categories</a><br>";
	}
	echo "</td></tr></table>";
	CloseTable();
	include("footer.php");
} else {
	include("header.php");
	ShowFaq($id_cat, $categories);
	ShowFaqAll($id_cat);
	CloseTable();
	include("footer.php");
}

?>