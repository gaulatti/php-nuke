<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2007 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Based on PHP-Nuke Add-On                                             */
/* Copyright (c) 2001 by Richard Tirtadji AKA King Richard              */
/*                       (rtirtadji@hotmail.com)                        */
/*                       Hutdik Hermawan AKA hotFix                     */
/*                       (hutdik76@hotmail.com)                         */
/* http://www.nukeaddon.com                                             */
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
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='FAQ'"));
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
	/* Faq Admin Function                                    */
	/*********************************************************/

	function FaqAdmin() {
		global $admin, $bgcolor2, $prefix, $db, $currentlang, $multilingual, $admin_file, $language;
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>" . _FAQADMIN . "</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"option\"><b>" . _ACTIVEFAQS . "</b></font></center><br>"
		."<table border=\"1\" width=\"100%\" align=\"center\"><tr>"
		."<td bgcolor=\"$bgcolor2\" align=\"left\" nowrap>&nbsp;<b>" . _CATEGORIES . "</b>&nbsp;</td>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\" nowrap>&nbsp;<b>" . _LANGUAGE . "</b>&nbsp;</td>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\" nowrap>&nbsp;<b>" . _FUNCTIONS . "</b>&nbsp;</td></tr><tr>";
		$result = $db->sql_query("select id_cat, categories, flanguage from ".$prefix."_faqcategories order by id_cat");
		while ($row = $db->sql_fetchrow($result)) {
			$id_cat = $row['id_cat'];
			$categories = filter($row['categories'], "nohtml");
			$flanguage = $row['flanguage'];
			if (empty($flanguage)) {
				$flanguage = _ALL;
			}
			echo "<td align=\"left\" width=\"100%\">&nbsp;$categories</td>"
			."<td align=\"center\">$flanguage</td>"
			."<td align=\"center\" nowrap>&nbsp;<a href=\"".$admin_file.".php?op=FaqCatGo&amp;id_cat=$id_cat\"><img src=\"images/add.gif\" alt=\""._CONTENT."\" title=\""._CONTENT."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=FaqCatEdit&amp;id_cat=$id_cat\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=FaqCatDel&amp;id_cat=$id_cat&amp;ok=0\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a>&nbsp;</td><tr>";
		}
		echo "</td></tr></table>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"option\"><b>" . _ADDCATEGORY . "</b></font></center><br>"
		."<form action=\"".$admin_file.".php\" method=\"post\">"
		."<table border=\"0\" width=\"100%\"><tr><td>"
		."" . _CATEGORIES . ":</td><td><input type=\"text\" name=\"categories\" size=\"30\"></td>";
		if ($multilingual == 1) {
			echo "<tr><td>" . _LANGUAGE . ":</td><td>"
			."<select name=\"flanguage\">";
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
			echo "</select></td>";
		} else {
			echo "<input type=\"hidden\" name=\"flanguage\" value=\"$language\">";
		}
		echo "</tr></table>"
		."<input type=\"hidden\" name=\"op\" value=\"FaqCatAdd\">"
		."<input type=\"submit\" value=" . _SAVE . ">"
		."</form>";
		CloseTable();
		include("footer.php");
	}

	function FaqCatGo($id_cat) {
		global $admin, $bgcolor2, $prefix, $db, $admin_file;
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>" . _FAQADMIN . "</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"option\"><b>" . _QUESTIONS . "</b></font></center><br>"
		."<table border=1 width=100% align=\"center\"><tr>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _CONTENT . "</b></td>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _FUNCTIONS . "</b></td></tr>";
		$id_cat = intval($id_cat);
		$result = $db->sql_query("select id, question, answer from ".$prefix."_faqanswer where id_cat='$id_cat' order by id");
		while ($row = $db->sql_fetchrow($result)) {
			$id = intval($row['id']);
			$question = filter($row['question'], "nohtml");
			$answer = filter($row['answer']);
			echo "<tr><td><i>$question</i><br><br>$answer"
			."</td><td align=\"center\">&nbsp;<a href=\"".$admin_file.".php?op=FaqCatGoEdit&amp;id=$id\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=FaqCatGoDel&amp;id=$id&amp;ok=0\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a>&nbsp;</td></tr>"
			."</td></tr>";
		}
		echo "</table>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"option\"><b>" . _ADDQUESTION . "</b></center><br>"
		."<form action=\"".$admin_file.".php\" method=\"post\">"
		."<table border=\"0\" width=\"100%\"><tr><td>"
		."" . _QUESTION . ":</td><td><input type=\"text\" name=\"question\" size=\"40\"></td></tr><tr><td>"
		."" . _ANSWER . " </td><td><textarea name=\"answer\" cols=\"70\" rows=\"15\"></textarea>"
		."</td></tr></table>"
		."<input type=\"hidden\" name=\"id_cat\" value=\"$id_cat\">"
		."<input type=\"hidden\" name=\"op\" value=\"FaqCatGoAdd\">"
		."<input type=\"submit\" value=" . _SAVE . "> " . _GOBACK . ""
		."</form>";
		CloseTable();
		include("footer.php");
	}

	function FaqCatEdit($id_cat) {
		global $admin, $db, $multilingual, $admin_file;
		include ("config.php");
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>" . _FAQADMIN . "</b></font></center>";
		CloseTable();
		echo "<br>";
		$id_cat = intval($id_cat);
		$row = $db->sql_fetchrow($db->sql_query("SELECT categories, flanguage from " . $prefix . "_faqcategories where id_cat='$id_cat'"));
		$categories = filter($row['categories'], "nohtml");
		$flanguage = $row['flanguage'];
		OpenTable();
		echo "<center><font class=\"option\"><b>" . _EDITCATEGORY . "</b></font></center>"
		."<form action=\"".$admin_file.".php\" method=\"post\">"
		."<input type=\"hidden\" name=\"id_cat\" value=\"$id_cat\">"
		."<table border=\"0\" width=\"100%\"><tr><td>"
		."" . _CATEGORIES . ":</td><td><input type=\"text\" name=\"categories\" size=\"31\" value='$categories'></td>";
		if ($multilingual == 1) {
			echo "<tr><td>" . _LANGUAGE . ":</td><td>"
			."<select name=\"flanguage\">";
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
					echo "<option name=\"flanguage\" value=\"$languageslist[$i]\" ";
					if($languageslist[$i]==$flanguage) echo "selected";
					echo ">".ucfirst($languageslist[$i])."</option>\n";
				}
			}
			echo "</select></td>";
		} else {
			echo "<input type=\"hidden\" name=\"flanguage\" value=\"$language\">";
		}
		echo "</tr></table>"
		."<input type=\"hidden\" name=\"op\" value=\"FaqCatSave\">"
		."<input type=\"submit\" value=\""._SAVE."\"> "._GOBACK.""
		."</form>";
		CloseTable();
		include("footer.php");
	}

	function FaqCatGoEdit($id) {
		global $admin, $bgcolor2, $prefix, $db, $admin_file;
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>" . _FAQADMIN . "</b></font></center>";
		CloseTable();
		echo "<br>";
		$id = intval($id);
		$row = $db->sql_fetchrow($db->sql_query("SELECT question, answer from " . $prefix . "_faqanswer where id='$id'"));
		$question = filter($row['question'], "nohtml");
		$answer = filter($row['answer']);
		OpenTable();
		echo "<center><font class=\"option\"><b>" . _EDITQUESTIONS . "</b></font></center>"
		."<form action=\"".$admin_file.".php\" method=\"post\">"
		."<input type=\"hidden\" name=\"id\" value=\"$id\">"
		."<table border=\"0\" width=\"100%\"><tr><td>"
		."" . _QUESTION . ":</td><td><input type=\"text\" name=\"question\" size=\"31\" value=\"$question\"></td></tr><tr><td>"
		."" . _ANSWER . ":</td><td><textarea name=\"answer\" cols=70 rows=15>$answer</textarea>"
		."</td></tr></table>"
		."<input type=\"hidden\" name=\"op\" value=\"FaqCatGoSave\">"
		."<input type=\"submit\" value=" . _SAVE . "> " . _GOBACK . ""
		."</form>";
		CloseTable();
		include("footer.php");
	}


	function FaqCatSave($id_cat, $categories, $flanguage) {
		global $prefix, $db, $admin_file;
		$categories = filter($categories, "nohtml", 1);
		$id_cat = intval($id_cat);
		$db->sql_query("update ".$prefix."_faqcategories set categories='$categories', flanguage='$flanguage' where id_cat='$id_cat'");
		Header("Location: ".$admin_file.".php?op=FaqAdmin");
	}

	function FaqCatGoSave($id, $question, $answer) {
		global $prefix, $db, $admin_file;
		$question = filter($question, "nohtml", 1);
		$answer = filter($answer, "", 1);
		$id = intval($id);
		$db->sql_query("update ".$prefix."_faqanswer set question='$question', answer='$answer' where id='$id'");
		Header("Location: ".$admin_file.".php?op=FaqAdmin");
	}

	function FaqCatAdd($categories, $flanguage) {
		global $prefix, $db, $admin_file;
		$categories = filter($categories, "nohtml", 1);
		$db->sql_query("insert into ".$prefix."_faqcategories values (NULL, '$categories', '$flanguage')");
		Header("Location: ".$admin_file.".php?op=FaqAdmin");
	}

	function FaqCatGoAdd($id_cat, $question, $answer) {
		global $prefix, $db, $admin_file;
		$question = filter($question, "nohtml", 1);
		$answer = filter($answer, "", 1);
		$db->sql_query("insert into ".$prefix."_faqanswer values (NULL, '$id_cat', '$question', '$answer')");
		Header("Location: ".$admin_file.".php?op=FaqCatGo&id_cat=$id_cat");
	}

	function FaqCatDel($id_cat, $ok=0) {
		global $prefix, $db, $admin_file;
		if($ok==1) {
			$id_cat = intval($id_cat);
			$db->sql_query("delete from ".$prefix."_faqcategories where id_cat='$id_cat'");
			$db->sql_query("delete from ".$prefix."_faqanswer where id_cat='$id_cat'");
			Header("Location: ".$admin_file.".php?op=FaqAdmin");
		} else {
			include("header.php");
			GraphicAdmin();
			OpenTable();
			echo "<center><font class=\"title\"><b>" . _FAQADMIN . "</b></font></center>";
			CloseTable();
			echo "<br>";
			OpenTable();
			echo "<br><center><b>" . _FAQDELWARNING . "</b><br><br>";
		}
		echo "[ <a href=\"".$admin_file.".php?op=FaqCatDel&amp;id_cat=$id_cat&amp;ok=1\">" . _YES . "</a> | <a href=\"".$admin_file.".php?op=FaqAdmin\">" . _NO . "</a> ]</center><br><br>";
		CloseTable();
		include("footer.php");
	}

	function FaqCatGoDel($id, $ok=0) {
		global $prefix, $db, $admin_file;
		if($ok==1) {
			$id = intval($id);
			$db->sql_query("delete from ".$prefix."_faqanswer where id='$id'");
			Header("Location: ".$admin_file.".php?op=FaqAdmin");
		} else {
			include("header.php");
			GraphicAdmin();
			OpenTable();
			echo "<center><font class=\"title\"><b>" . _FAQADMIN . "</b></font></center>";
			CloseTable();
			echo "<br>";
			OpenTable();
			echo "<br><center><b>" . _QUESTIONDEL . "</b><br><br>";
		}
		echo "[ <a href=\"".$admin_file.".php?op=FaqCatGoDel&amp;id=$id&amp;ok=1\">" . _YES . "</a> | <a href=\"".$admin_file.".php?op=FaqAdmin\">" . _NO . "</a> ]</center><br><br>";
		CloseTable();
		include("footer.php");
	}

	switch($op) {

		case "FaqCatSave":
		FaqCatSave($id_cat, $categories, $flanguage); /* Multilingual Code : added variable */
		break;

		case "FaqCatGoSave":
		FaqCatGoSave($id, $question, $answer);
		break;

		case "FaqCatAdd":
		FaqCatAdd($categories, $flanguage); /* Multilingual Code : added variable */
		break;

		case "FaqCatGoAdd":
		FaqCatGoAdd($id_cat, $question, $answer);
		break;

		case "FaqCatEdit":
		FaqCatEdit($id_cat);
		break;

		case "FaqCatGoEdit":
		FaqCatGoEdit($id);
		break;

		case "FaqCatDel":
		FaqCatDel($id_cat, $ok);
		break;

		case "FaqCatGoDel":
		FaqCatGoDel($id, $ok);
		break;

		case "FaqAdmin":
		FaqAdmin();
		break;

		case "FaqCatGo":
		FaqCatGo($id_cat);
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