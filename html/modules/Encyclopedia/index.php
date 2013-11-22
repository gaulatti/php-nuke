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

$pagetitle = "- "._ENCYCLOPEDIA."";

function encysearch($eid) {
	global $module_name;
	echo "<center><form action=\"modules.php?name=$module_name&file=search\" method=\"post\">"
	."<input type=\"text\" size=\"20\" name=\"query\">&nbsp;&nbsp;"
	."<input type=\"hidden\" name=\"eid\" value=\"$eid\">"
	."<input type=\"submit\" value=\""._SEARCH."\">"
	."</form>"
	."</center>";
}

function alpha($eid) {
	global $module_name, $prefix, $db;
	echo "<center>"._ENCYSELECTLETTER."</center><br><br>";
	$alphabet = array ("A","B","C","D","E","F","G","H","I","J","K","L","M",
	"N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
	$num = count($alphabet) - 1;
	echo "<center>[ ";
	$counter = 0;
	$eid = intval($eid);
	while (list(, $ltr) = each($alphabet)) {
		$ltr = substr("$ltr", 0,1);
		$numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_encyclopedia_text WHERE eid='$eid' AND UPPER(title) LIKE '$ltr%'"));
		if ($numrows > 0) {
			echo "<a href=\"modules.php?name=$module_name&amp;op=terms&amp;eid=$eid&amp;ltr=$ltr\">$ltr</a>";
		} else {
			echo "$ltr";
		}
		if ( $counter == round($num/2) ) {
			echo " ]\n<br>\n[ ";
		} elseif ( $counter != $num ) {
			echo "&nbsp;|&nbsp;\n";
		}
		$counter++;
	}
	echo " ]</center><br><br>\n\n\n";
	encysearch($eid);
	echo "<center>"._GOBACK."</center>";
}

function list_content($eid) {
	global $module_name, $prefix, $sitename, $db;
	$eid = intval($eid);
	$row = $db->sql_fetchrow($db->sql_query("SELECT title, description FROM ".$prefix."_encyclopedia WHERE eid='$eid'"));
	$title = filter($row['title'], "nohtml");
	$description = filter($row['description']);
	include("header.php");
	title("$title");
	OpenTable();
	echo "<center><b>$title</b></center><br>"
	."<p align=\"justify\">$description</p>";
	CloseTable();
	echo "<br>";
	OpenTable();
	alpha($eid);
	CloseTable();
	echo "<br>";
	OpenTable();
	echo "<center><font class=\"tiny\">"._COPYRIGHT." &copy; "._BY." $sitename</font></center>";
	CloseTable();
	include("footer.php");
}

function terms($eid, $ltr) {
	global $module_name, $prefix, $sitename, $db, $admin;
	$eid = intval($eid);
	$ltr = substr($ltr,0,1);
	if (ereg("[^a-zA-Z0-9]",$ltr))
	{
	   die('Invalid letter/digit specified!');
	}
	$row = $db->sql_fetchrow($db->sql_query("SELECT active FROM ".$prefix."_encyclopedia WHERE eid='$eid'"));
	$active = intval($row['active']);
	$row2 = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_encyclopedia WHERE eid='$eid'"));
	$title = filter($row2['title'], "nohtml");
	include("header.php");
	title("$title");
	OpenTable();
	if (($active == 1) OR (is_admin($admin))) {
		if (($active != 1) AND (is_admin($admin))) {
			echo "<center>"._YOURADMINENCY."</center><br><br>";
		}
		echo "<center>Please select one term from the following list:</center><br><br>"
		."<table border=\"0\" align=\"center\">";
		$result3 = $db->sql_query("SELECT tid, title FROM ".$prefix."_encyclopedia_text WHERE UPPER(title) LIKE '$ltr%' AND eid='$eid'");
		$numrows = $db->sql_numrows($result3);
		if ($numrows == 0) {
			echo "<center><i>"._NOCONTENTFORLETTER." ".htmlentities($ltr).".</i></center>";
		}
		while ($row3 = $db->sql_fetchrow($result3)) {
			$tid = intval($row3['tid']);
			$title = filter($row3['title'], "nohtml");
			echo "<tr><td><a href=\"modules.php?name=$module_name&amp;op=content&amp;tid=$tid\">$title</a></td></tr>";
		}
		echo "</table><br><br>";
		alpha($eid);
	} else {
		echo "<center>"._ENCYNOTACTIVE."<br><br>"
		.""._GOBACK."</center>";
	}
	CloseTable();
	include("footer.php");
}

function content($tid, $ltr, $page=0, $query="") {
	global $prefix, $db, $sitename, $admin, $module_name, $admin_file;
	$tid = intval($tid);
	include("header.php");
	OpenTable();
	$ency = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_encyclopedia_text WHERE tid='$tid'"));
	$etid = intval($ency['tid']);
	$eeid = intval($ency['eid']);
	$etitle = filter($ency['title'], "nohtml");
	$etext = filter($ency['text']);
	$ecounter = intval($ency['counter']);
	$row = $db->sql_fetchrow($db->sql_query("SELECT active FROM ".$prefix."_encyclopedia WHERE eid='$eeid'"));
	$active = intval($row['active']);
	if (($active == 1) OR ($active == 0 AND is_admin($admin))) {
		$db->sql_query("UPDATE ".$prefix."_encyclopedia_text SET counter=counter+1 WHERE tid='$tid'");
		$row2 = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_encyclopedia WHERE eid='$eeid'"));
		$enc_title = filter($row2['title'], "nohtml");
		echo "<font class=\"title\">$etitle</font><br><br><br>";
		$contentpages = explode( "[--pagebreak--]", $etext );
		$pageno = count($contentpages);
		if ( empty($page) || $page < 1 )
		$page = 1;
		if ( $page > $pageno )
		$page = $pageno;
		$arrayelement = (int)$page;
		$arrayelement --;
		if ($pageno > 1) {
			echo ""._PAGE.": $page/$pageno<br>";
		}
		if (!empty($query)) {
			$query = htmlentities($query);
			$contentpages[$arrayelement] = eregi_replace($query,"<b>$query</b>",$contentpages[$arrayelement]);
			$fromsearch = "&query=$query";
		} else {
			$fromsearch = "";
		}
		echo "<p align=\"justify\">".nl2br($contentpages[$arrayelement])."</p>";
		if($page >= $pageno) {
			$next_page = "";
		} else {
			$next_pagenumber = $page + 1;
			if ($page != 1) {
				$next_page .= "- ";
			}
			$next_page .= "<a href=\"modules.php?name=$module_name&amp;op=content&amp;tid=$tid&amp;page=$next_pagenumber$fromsearch\">"._NEXT." ($next_pagenumber/$pageno)</a> <a href=\"modules.php?name=$module_name&amp;op=content&amp;tid=$tid&amp;page=$next_pagenumber\"><img src=\"images/right.gif\" border=\"0\" alt=\""._NEXT."\" title=\""._NEXT."\"></a>";
		}
		if($page <= 1) {
			$previous_page = "";
		} else {
			$previous_pagenumber = $page - 1;
			$previous_page = "<a href=\"modules.php?name=$module_name&amp;op=content&amp;tid=$tid&amp;page=$previous_pagenumber$fromsearch\"><img src=\"images/left.gif\" border=\"0\" alt=\""._PREVIOUS."\" title=\""._PREVIOUS."\"></a> <a href=\"modules.php?name=$module_name&amp;op=content&amp;tid=$tid&amp;page=$previous_pagenumber$fromsearch\">"._PREVIOUS." ($previous_pagenumber/$pageno)</a>";
		}
		echo "<br><br><br><center>$previous_page $next_page<br><br>"
		.""._GOBACK."</center><br>";
		if (is_admin($admin)) {
			echo "<p align=\"right\">[ <a href=\"".$admin_file.".php?op=encyclopedia_text_edit&amp;tid=$etid\">"._EDIT."</a> ]</p>";
		}
		echo "<p align=\"right\"><a href=\"modules.php?name=$module_name&amp;op=list_content&amp;eid=$eeid\">$enc_title</a></p>";
		if ($page == $pageno) {
			echo "<p align=\"right\">"._COPYRIGHT." &copy; "._BY." $sitename - ($ecounter "._READS.")</font></p>";
		}
	} else {
		echo "Sorry, This page isn't active...";
	}
	CloseTable();
	include("footer.php");
}

function list_themes() {
	global $prefix, $db, $sitename, $admin, $multilingual, $module_name, $admin_file;
	include("header.php");
	title("$sitename: "._ENCYCLOPEDIA."");
	OpenTable();
	echo "<center><font class=\"content\">"._AVAILABLEENCYLIST." $sitename:</center><br><br>";
	$result = $db->sql_query("SELECT eid, title, description, elanguage FROM ".$prefix."_encyclopedia WHERE active='1'");
	echo "<blockquote>";
	while ($row = $db->sql_fetchrow($result)) {
		$eid = intval($row['eid']);
		$title = filter($row['title'], "nohtml");
		$description = filter($row['description']);
		$elanguage = $row['elanguage'];
		if ($multilingual == 1) {
			$the_lang = "<img src=\"images/language/flag-$elanguage.png\" hspace=\"3\" border=\"0\" height=\"10\" width=\"20\">";
		} else {
			$the_lang = "";
		}
		if (!empty($subtitle)) {
			$subtitle = "<br>($description)<br><br>";
		} else {
			$subtitle = "";
		}
		if (is_admin($admin)) {
			echo "<strong><big>&middot;</big></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;op=list_content&amp;eid=$eid\">$title</a><br>$description<br>[ <a href=\"".$admin_file.".php?op=encyclopedia_edit&amp;eid=$eid\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=encyclopedia_change_status&amp;eid=$eid&amp;active=1\">"._DEACTIVATE."</a> | <a href=\"".$admin_file.".php?op=encyclopedia_delete&amp;eid=$eid\">"._DELETE."</a> ]<br><br>";
		} else {
			echo "<strong><big>&middot;</big></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;op=list_content&amp;eid=$eid\">$title</a><br> $description<br><br>";
		}
	}
	echo "</blockquote>";
	if (is_admin($admin)) {
		$result2 = $db->sql_query("SELECT eid, title, description, elanguage FROM ".$prefix."_encyclopedia WHERE active='0'");
		echo "<br><br><center><b>"._YOURADMININACTIVELIST."</b></center><br><br>";
		echo "<blockquote>";
		while ($row2 = $db->sql_fetchrow($result2)) {
			$eid = intval($row2['eid']);
			$title = filter($row2['title'], "nohtml");
			$description = filter($row2['description']);
			$elanguage = $row2['elanguage'];
			if ($multilingual == 1) {
				$the_lang = "<img src=\"images/language/flag-$elanguage.png\" hspace=\"3\" border=\"0\" height=\"10\" width=\"20\">";
			} else {
				$the_lang = "";
			}
			if (!empty($subtitle)) {
				$subtitle = " ($subtitle) ";
			} else {
				$subtitle = " ";
			}
			echo "<strong><big>&middot;</big></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;op=list_content&amp;eid=$eid\">$title</a><br>$description<br>[ <a href=\"".$admin_file.".php?op=encyclopedia_edit&amp;eid=$eid\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=encyclopedia_change_status&amp;eid=$eid&amp;active=0\">"._ACTIVATE."</a> | <a href=\"".$admin_file.".php?op=encyclopedia_delete&amp;eid=$eid\">"._DELETE."</a> ]<br><br>";
		}
		echo "</blockquote>";
	}
	CloseTable();
	include("footer.php");
}

if (!isset($ltr)) { $ltr = ""; }
if (!isset($page)) { $page = ""; }
if (!isset($query)) { $query = ""; }

switch($op) {

	case "content":
	content($tid, $ltr, $page, $query);
	break;

	case "list_content":
	list_content($eid);
	break;

	case "terms":
	terms($eid, $ltr);
	break;

	case "search":
	search($query, $eid);
	break;

	default:
	list_themes();
	break;

}

?>