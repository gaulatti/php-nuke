<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2007 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Based on Journey Links Hack                                          */
/* Copyright (c) 2000 by James Knickelbein                              */
/* Journey Milwaukee (http://www.journeymilwaukee.com)                  */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}

if (isset($min)) {
    $min = intval($min);
}

if (isset($show)) {
    $show = intval($show);
}
if (isset($description)) {
    $description = addslashes(htmlentities($description));
}

define('INDEX_FILE', true);
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = "- "._WEBLINKS."";
require_once("modules/Web_Links/l_config.php");

function getparent($parentid,$title) {
	global $prefix, $db;
	$parentid = intval($parentid);
	$row = $db->sql_fetchrow($db->sql_query("SELECT cid, title, parentid from ".$prefix."_links_categories where cid='$parentid'"));
	$cid = intval($row['cid']);
	$ptitle = filter($row['title'], "nohtml");
	$pparentid = intval($row['parentid']);
	if ($ptitle=="$title") $title=$title;
	elseif (!empty($ptitle)) $title=$ptitle."/".$title;
	if ($pparentid!=0) {
		$title=getparent($pparentid,$title);
	}
	return $title;
}

function getparentlink($parentid,$title) {
	global $prefix, $db, $module_name;
	$parentid = intval($parentid);
	$row = $db->sql_fetchrow($db->sql_query("SELECT cid, title, parentid from ".$prefix."_links_categories where cid='$parentid'"));
	$cid = intval($row['cid']);
	$ptitle = filter($row['title'], "nohtml");
	$pparentid = intval($row['parentid']);
	if (!empty($ptitle)) $title="<a href=modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid>$ptitle</a>/".$title;
	if ($pparentid!=0) {
		$title=getparentlink($pparentid,$ptitle);
	}
	return $title;
}

function menu($mainlink) {
	global $module_name, $query;
	OpenTable();
	$ThemeSel = get_theme();
	if (file_exists("themes/$ThemeSel/images/link-logo.gif")) {
		echo "<br><center><a href=\"modules.php?name=$module_name\"><img src=\"themes/$ThemeSel/images/link-logo.gif\" border=\"0\" alt=\"\"></a><br><br>";
	} else {
		echo "<br><center><a href=\"modules.php?name=$module_name\"><img src=\"modules/$module_name/images/link-logo.gif\" border=\"0\" alt=\"\"></a><br><br>";
	}
	echo "<form action=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$query\" method=\"post\">"
	."<font class=\"content\"><input type=\"text\" size=\"25\" name=\"query\"> <input type=\"submit\" value=\""._SEARCH."\"></font>"
	."</form>";
	echo "<font class=\"content\">[ ";
	if ($mainlink>0) {
		echo "<a href=\"modules.php?name=$module_name\">"._LINKSMAIN."</a> | ";
	}
	echo "<a href=\"modules.php?name=$module_name&amp;l_op=AddLink\">"._ADDLINK."</a>"
	." | <a href=\"modules.php?name=$module_name&amp;l_op=NewLinks\">"._NEW."</a>"
	." | <a href=\"modules.php?name=$module_name&amp;l_op=MostPopular\">"._POPULAR."</a>"
	." | <a href=\"modules.php?name=$module_name&amp;l_op=TopRated\">"._TOPRATED."</a>"
	." | <a href=\"modules.php?name=$module_name&amp;l_op=RandomLink\">"._RANDOM."</a> ]"
	."</font></center>";
	CloseTable();
}

function SearchForm() {
	echo "<form action=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$query\" method=\"post\">"
	."<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">"
	."<tr><td><font class=\"content\"><input type=\"text\" size=\"25\" name=\"query\"> <input type=\"submit\" value=\""._SEARCH."\"></td></tr>"
	."</table>"
	."</form>";
}

function linkinfomenu($lid) {
	global $module_name, $user;
	echo "<br><font class=\"content\">[ "
	."<a href=\"modules.php?name=$module_name&amp;l_op=viewlinkcomments&amp;lid=$lid\">"._LINKCOMMENTS."</a>"
	." | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkdetails&amp;lid=$lid\">"._ADDITIONALDET."</a>"
	." | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkeditorial&amp;lid=$lid\">"._EDITORREVIEW."</a>"
	." | <a href=\"modules.php?name=$module_name&amp;l_op=modifylinkrequest&amp;lid=$lid\">"._MODIFY."</a>";
	if (is_user($user)) {
		echo " | <a href=\"modules.php?name=$module_name&amp;l_op=brokenlink&amp;lid=$lid\">"._REPORTBROKEN."</a>";
	}
	echo " ]</font>";
}

function index() {
	global $prefix, $db;
	include("header.php");
	$mainlink = 0;
	menu($mainlink);
	echo "<br>";
	OpenTable();
	echo "<center><font class=\"title\"><b>"._LINKSMAINCAT."</b></font></center><br>";
	echo "<table border=\"0\" cellspacing=\"10\" cellpadding=\"0\" align=\"center\"><tr>";
	$result = $db->sql_query("select cid, title, cdescription from ".$prefix."_links_categories where parentid=0 order by title");
	$dum = 0;
	$count = 0;
	while ($row = $db->sql_fetchrow($result)) {
		$cid = intval($row['cid']);
		$title = filter($row['title'], "nohtml");
		$cdescription = filter($row['cdescription']);
		echo "<td><font class=\"option\"><strong><big>&middot;</big></strong> <a href=\"modules.php?name=Web_Links&amp;l_op=viewlink&amp;cid=$cid\"><b>$title</b></a></font>";
		categorynewlinkgraphic($cid);
		if ($cdescription) {
			echo "<br><font class=\"content\">$cdescription</font><br>";
		} else {
			echo "<br>";
		}
		$result2 = $db->sql_query("SELECT cid, title from ".$prefix."_links_categories where parentid='$cid' order by title limit 0,3");
		$space = 0;
		while ($row2 = $db->sql_fetchrow($result2)) {
			$cid = intval($row2['cid']);
			$stitle = filter($row2['title'], "nohtml");
			if ($space>0) {
				echo ",&nbsp;";
			}
			echo "<font class=\"content\"><a href=\"modules.php?name=Web_Links&amp;l_op=viewlink&amp;cid=$cid\">$stitle</a></font>";
			$space++;
		}
		if ($count<1) {
			echo "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td>";
			$dum = 1;
		}
		$count++;
		if ($count==2) {
			echo "</td></tr><tr>";
			$count = 0;
			$dum = 0;
		}
	}
	if ($dum == 1) {
		echo "</tr></table>";
	} elseif ($dum == 0) {
		echo "<td></td></tr></table>";
	}
	$result3 = $db->sql_query("SELECT * from ".$prefix."_links_links");
	$numrows = $db->sql_numrows($result3);
	$result4 = $db->sql_query("SELECT * from ".$prefix."_links_categories");
	$catnum = $db->sql_numrows($result4);
	$numrows = intval($numrows);
	$catnum = intval($catnum);
	echo "<br><br><center><font class=\"content\">"._THEREARE." <b>$numrows</b> "._LINKS." "._AND." <b>$catnum</b> "._CATEGORIES." "._INDB."</font></center>";
	CloseTable();
	include("footer.php");
}

function AddLink() {
	global $prefix, $db, $user, $links_anonaddlinklock, $module_name;
	include("header.php");
	$mainlink = 1;
	menu(1);
	echo "<br>";
	OpenTable();
	echo "<center><font class=\"title\"><b>"._ADDALINK."</b></font></center><br><br>";
	if (is_user($user) || $links_anonaddlinklock == 1) {  /* 06-24-01 Bug fix : changed $links_anonaddlinklock != 1 to $links_anonaddlinklock == 1 */
	echo "<b>"._INSTRUCTIONS.":</b><br>"
	."<strong><big>&middot;</big></strong> "._SUBMITONCE."<br>"
	."<strong><big>&middot;</big></strong> "._POSTPENDING."<br>"
	."<strong><big>&middot;</big></strong> "._USERANDIP."<br>"
	."<form method=\"post\" action=\"modules.php?name=$module_name&amp;l_op=Add\">"
	.""._PAGETITLE.": <input type=\"text\" name=\"title\" size=\"50\" maxlength=\"100\"><br>"
	.""._PAGEURL.": <input type=\"text\" name=\"url\" size=\"50\" maxlength=\"100\" value=\"http://\"><br>";
	echo ""._CATEGORY.": <select name=\"cat\">";
	$result = $db->sql_query("SELECT cid, title, parentid from ".$prefix."_links_categories order by parentid,title");
	while ($row = $db->sql_fetchrow($result)) {
		$cid2 = intval($row['cid']);
		$ctitle2 = filter($row['title'], "nohtml");
		$parentid2 = intval($row['parentid']);
		if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
		echo "<option value=\"$cid2\">$ctitle2</option>";
	}
	echo "</select><br><br>"
	.""._LDESCRIPTION."<br><textarea name=\"description\" cols=\"70\" rows=\"15\"></textarea><br><br><br>"
	.""._YOURNAME.": <input type=\"text\" name=\"auth_name\" size=\"30\" maxlength=\"60\"><br>"
	.""._YOUREMAIL.": <input type=\"text\" name=\"email\" size=\"30\" maxlength=\"60\"><br><br>"
	."<input type=\"hidden\" name=\"l_op\" value=\"Add\">"
	."<input type=\"submit\" value=\""._ADDURL."\"> "._GOBACK."<br><br>"
	."</form>";
	}else {
		echo "<center>"._LINKSNOTUSER1."<br>"
		.""._LINKSNOTUSER2."<br><br>"
		.""._LINKSNOTUSER3."<br>"
		.""._LINKSNOTUSER4."<br>"
		.""._LINKSNOTUSER5."<br>"
		.""._LINKSNOTUSER6."<br>"
		.""._LINKSNOTUSER7."<br><br>"
		.""._LINKSNOTUSER8."";
	}
	CloseTable();
	include("footer.php");
}

function Add($title, $url, $auth_name, $cat, $description, $email) {
	global $prefix, $db, $user;
	$url = filter($url, "nohtml");
	$result = $db->sql_query("SELECT url from ".$prefix."_links_links where url='$url'");
	$numrows = $db->sql_numrows($result);
	if ($numrows>0) {
		include("header.php");
		menu(1);
		echo "<br>";
		OpenTable();
		echo "<center><b>"._LINKALREADYEXT."</b><br><br>"
		.""._GOBACK."";
		CloseTable();
		include("footer.php");
	} else {
		if(is_user($user)) {
			$user2 = base64_decode($user);
			$user2 = addslashes($user2);
			$cookie = explode(":", $user2);
			cookiedecode($user);
			$submitter = $cookie[1];
		}
		// Check if Title exist
		if (empty($title)) {
			include("header.php");
			menu(1);
			echo "<br>";
			OpenTable();
			echo "<center><b>"._LINKNOTITLE."</b><br><br>"
			.""._GOBACK."";
			CloseTable();
			include("footer.php");
		}
		// Check if URL exist
		if (empty($url)) {
			include("header.php");
			menu(1);
			echo "<br>";
			OpenTable();
			echo "<center><b>"._LINKNOURL."</b><br><br>"
			.""._GOBACK."";
			CloseTable();
			include("footer.php");
		}
		// Check if Description exist
		if (empty($description)) {
			include("header.php");
			menu(1);
			echo "<br>";
			OpenTable();
			echo "<center><b>"._LINKNODESC."</b><br><br>"
			.""._GOBACK."";
			CloseTable();
			include("footer.php");
		}
		$cat = explode("-", $cat);
		if (empty($cat[1])) {
			$cat[1] = 0;
		}
		$title = filter($title, "nohtml", 1);
		$url = filter($url, "nohtml", 1);
		$description = filter($description, "", 1);
		$auth_name = filter($auth_name, "nohtml", 1);
		$email = filter($email, "nohtml", 1);
		$cat[0] = intval($cat[0]);
		$cat[1] = intval($cat[1]);
		$num_new = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_links_newlink WHERE title='$title' OR url='$url' OR description='$description'"));
		if ($num_new == 0) {
			$db->sql_query("insert into ".$prefix."_links_newlink values (NULL, '$cat[0]', '$cat[1]', '$title', '$url', '$description', '$auth_name', '$email', '$submitter')");
		}
		include("header.php");
		menu(1);
		echo "<br>";
		OpenTable();
		echo "<center><b>"._LINKRECEIVED."</b><br>";
		if (!empty($email)) {
			echo _EMAILWHENADD;
		} else {
			echo _CHECKFORIT;
		}
		CloseTable();
		include("footer.php");
	}
}

function NewLinks($newlinkshowdays) {
	global $prefix, $db, $module_name;
	include("header.php");
    $newlinkshowdays = intval(trim($newlinkshowdays));
	menu(1);
	echo "<br>";
	OpenTable();
	echo "<center><font class=\"option\"><b>"._NEWLINKS."</b></font></center><br>";
	$counter = 0;
	$allweeklinks = 0;
	while ($counter <= 7-1){
		$newlinkdayRaw = (time()-(86400 * $counter));
		$newlinkday = date("d-M-Y", $newlinkdayRaw);
		$newlinkView = date("F d, Y", $newlinkdayRaw);
		$newlinkDB = Date("Y-m-d", $newlinkdayRaw);
		$totallinks = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_links_links WHERE date LIKE '%$newlinkDB%'"));
		$counter++;
		$allweeklinks = $allweeklinks + $totallinks;
	}
	$counter = 0;
	$allmonthlinks = 0;
	while ($counter <=30-1){
		$newlinkdayRaw = (time()-(86400 * $counter));
		$newlinkDB = Date("Y-m-d", $newlinkdayRaw);
		$totallinks = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_links_links WHERE date LIKE '%$newlinkDB%'"));
		$allmonthlinks = $allmonthlinks + $totallinks;
		$counter++;
	}
	echo "<center><b>"._TOTALNEWLINKS.":</b> "._LASTWEEK." - $allweeklinks \ "._LAST30DAYS." - $allmonthlinks<br>"
	.""._SHOW.": <a href=\"modules.php?name=$module_name&amp;l_op=NewLinks&amp;newlinkshowdays=7\">"._1WEEK."</a> - <a href=\"modules.php?name=$module_name&amp;l_op=NewLinks&amp;newlinkshowdays=14\">"._2WEEKS."</a> - <a href=\"modules.php?name=$module_name&amp;l_op=NewLinks&amp;newlinkshowdays=30\">"._30DAYS."</a>"
	."</center><br>";
	/* List Last VARIABLE Days of Links */
	if ($newlinkshowdays <= 0) $newlinkshowdays = 7;
	echo "<br><center><b>"._TOTALFORLAST." $newlinkshowdays "._DAYS.":</b><br><br>";
	$counter = 0;
	$allweeklinks = 0;
	while ($counter <= $newlinkshowdays-1) {
		$newlinkdayRaw = (time()-(86400 * $counter));
		$newlinkday = date("d-M-Y", $newlinkdayRaw);
		$newlinkView = date("F d, Y", $newlinkdayRaw);
		$newlinkDB = Date("Y-m-d", $newlinkdayRaw);
		$totallinks = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_links_links WHERE date LIKE '%$newlinkDB%'"));
		$counter++;
		$allweeklinks = $allweeklinks + $totallinks;
		echo "<strong><big>&middot;</big></strong> <a href=\"modules.php?name=Web_Links&amp;l_op=NewLinksDate&amp;selectdate=$newlinkdayRaw\">$newlinkView</a>&nbsp;($totallinks)<br>";
	}
	$counter = 0;
	$allmonthlinks = 0;
	echo "</center>";
	CloseTable();
	include("footer.php");
}

function NewLinksDate($selectdate) {
	global $prefix, $db, $module_name, $admin, $user, $admin_file, $locale, $mainvotedecimal, $datetime;
	$admin = base64_decode($admin);
	$admin = addslashes($admin);
	$admin = explode(":", $admin);
	$aid = "$admin[0]";
	$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper from ".$prefix."_authors where aid='$aid'"));
	$radminsuper = intval($row['radminsuper']);
	$dateDB = (date("d-M-Y", $selectdate));
	$dateView = (date("F d, Y", $selectdate));
	include("header.php");
	menu(1);
	echo "<br>";
	OpenTable();
	$newlinkDB = Date("Y-m-d", $selectdate);
	$totallinks = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_links_links WHERE date LIKE '%$newlinkDB%'"));
	echo "<font class=\"option\"><b>$dateView - $totallinks "._NEWLINKS."</b></font>"
	."<table width=\"100%\" cellspacing=\"0\" cellpadding=\"10\" border=\"0\"><tr><td><font class=\"content\">";
	$result2 = $db->sql_query("SELECT lid, cid, sid, title, description, date, hits, linkratingsummary, totalvotes, totalcomments from ".$prefix."_links_links where date LIKE '%$newlinkDB%' order by title ASC");
	while ($row2 = $db->sql_fetchrow($result2)) {
		$lid = intval($row2['lid']);
		$cid = intval($row2['cid']);
		$sid = intval($row2['sid']);
		$title = filter($row2['title'], "nohtml");
		$description = filter($row2['description']);
		$time = $row2['date'];
		$hits = intval($row2['hits']);
		$linkratingsummary = $row2['linkratingsummary'];
		$totalvotes = intval($row2['totalvotes']);
		$totalcomments = intval($row2['totalcomments']);
		$linkratingsummary = number_format($linkratingsummary, $mainvotedecimal);
		if (is_admin($admin)) {
	    	echo "<a href=\"".$admin_file.".php?op=LinksModLink&amp;lid=$lid\"><img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\""._EDIT."\"></a>&nbsp;&nbsp;";
		} else {
	    	echo "<img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\"\">&nbsp;&nbsp;";
		}
		echo "<a href=\"modules.php?name=$module_name&amp;l_op=visit&amp;lid=$lid\" target=\"new\">$title</a>";
		newlinkgraphic($datetime, $time);
		popgraphic($hits);
		echo "<br>"._DESCRIPTION.": $description<br>";
		setlocale (LC_TIME, $locale);
		/* INSERT code for *editor review* here */
		ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $time, $datetime);
		$datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
		$datetime = ucfirst($datetime);
		echo ""._ADDEDON.": <b>$datetime</b> "._HITS.": $hits";
		$transfertitle = str_replace (" ", "_", $title);
		/* voting & comments stats */
		if ($totalvotes == 1) {
			$votestring = _VOTE;
		} else {
			$votestring = _VOTES;
		}
		if ($linkratingsummary!="0" || $linkratingsummary!="0.0") {
			echo " "._RATING.": $linkratingsummary ($totalvotes $votestring)";
		}
		echo "<br>";
		if ($radminsuper == 1) {
			echo "<a href=\"".$admin_file.".php?op=LinksModLink&amp;lid=$lid\">"._EDIT."</a> | ";
		}
		echo "<a href=\"modules.php?name=$module_name&amp;l_op=ratelink&amp;lid=$lid\">"._RATESITE."</a>";
		if (is_user($user)) {
			echo " | <a href=\"modules.php?name=$module_name&amp;l_op=brokenlink&amp;lid=$lid\">"._REPORTBROKEN."</a>";
		}
		if ($totalvotes != 0) {
			echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkdetails&amp;lid=$lid\">"._DETAILS."</a>";
		}
		if ($totalcomments != 0) {
			echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkcomments&amp;lid=$lid\">"._SCOMMENTS." ($totalcomments)</a>";
		}
		detecteditorial($lid, $transfertitle);
		echo "<br>";
		$row3 = $db->sql_fetchrow($db->sql_query("SELECT title from ".$prefix."_links_categories where cid='$cid'"));
		$ctitle = filter($row3['title'], "nohtml");
		$ctitle = getparent($cid,$ctitle);
		echo ""._CATEGORY.": $ctitle";
		echo "<br><br>";
	}
	echo "</font></td></tr></table>";
	CloseTable();
	include("footer.php");
}

function TopRated($ratenum, $ratetype) {
	global $prefix, $db, $admin, $module_name, $user, $locale, $mainvotedecimal, $datetime, $admin_file;
	include("header.php");
	include("modules/$module_name/l_config.php");
	menu(1);
	echo "<br>";
	OpenTable();
	echo "<table border=\"0\" width=\"100%\"><tr><td align=\"center\">";
	if (!empty($ratenum) && !empty($ratetype)) {
		$ratenum = intval($ratenum);
		$ratetype = htmlentities($ratetype);
		$toplinks = $ratenum;
		if ($ratetype == "percent") {
			$toplinkspercentrigger = 1;
		}
	}
	if ($toplinkspercentrigger == 1) {
		$toplinkspercent = $toplinks;
		$totalratedlinks = $db->sql_numrows($db->sql_query("SELECT * from ".$prefix."_links_links where linkratingsummary != '0'"));
		$toplinks = $toplinks / 100;
		$toplinks = $totalratedlinks * $toplinks;
		$toplinks = round($toplinks);
	}
	if ($toplinkspercentrigger == 1) {
		echo "<center><font class=\"option\"><b>"._BESTRATED." $toplinkspercent% ("._OF." $totalratedlinks "._TRATEDLINKS.")</b></font></center><br>";
	} else {
		echo "<center><font class=\"option\"><b>"._BESTRATED." ".htmlentities($toplinks)." </b></font></center><br>";
	}
	echo "</td></tr>"
	."<tr><td><center>"._NOTE." $linkvotemin "._TVOTESREQ."<br>"
	.""._SHOWTOP.":  [ <a href=\"modules.php?name=$module_name&amp;l_op=TopRated&amp;ratenum=10&amp;ratetype=num\">10</a> - "
	."<a href=\"modules.php?name=$module_name&amp;l_op=TopRated&amp;ratenum=25&amp;ratetype=num\">25</a> - "
	."<a href=\"modules.php?name=$module_name&amp;l_op=TopRated&amp;ratenum=50&amp;ratetype=num\">50</a> | "
	."<a href=\"modules.php?name=$module_name&amp;l_op=TopRated&amp;ratenum=1&amp;ratetype=percent\">1%</a> - "
	."<a href=\"modules.php?name=$module_name&amp;l_op=TopRated&amp;ratenum=5&amp;ratetype=percent\">5%</a> - "
	."<a href=\"modules.php?name=$module_name&amp;l_op=TopRated&amp;ratenum=10&amp;ratetype=percent\">10%</a> ]</center><br><br></td></tr>";
	$result = $db->sql_query("SELECT lid, cid, sid, title, description, date, hits, linkratingsummary, totalvotes, totalcomments from ".$prefix."_links_links where linkratingsummary != 0 and totalvotes >= $linkvotemin order by linkratingsummary DESC limit 0,$toplinks");
	echo "<tr><td>";
	while ($row = $db->sql_fetchrow($result)) {
		$lid = intval($row['lid']);
		$cid = intval($row['cid']);
		$sid = intval($row['sid']);
		$title = filter($row['title'], "nohtml");
		$description = filter($row['description']);
		$time = $row['date'];
		$hits = intval($row['hits']);
		$linkratingsummary = $row['linkratingsummary'];
		$totalvotes = intval($row['totalvotes']);
		$totalcomments = intval($row['totalcomments']);
		$linkratingsummary = number_format($linkratingsummary, $mainvotedecimal);
		if (is_admin($admin)) {
	    	echo "<a href=\"".$admin_file.".php?op=LinksModLink&amp;lid=$lid\"><img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\""._EDIT."\"></a>&nbsp;&nbsp;";
		} else {
	    	echo "<img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\"\">&nbsp;&nbsp;";
		}
		echo "<a href=\"modules.php?name=$module_name&amp;l_op=visit&amp;lid=$lid\" target=\"new\">$title</a>";
		newlinkgraphic($datetime, $time);
		popgraphic($hits);
		echo "<br>";
		echo ""._DESCRIPTION.": $description<br>";
		setlocale (LC_TIME, $locale);
		ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $time, $datetime);
		$datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
		$datetime = ucfirst($datetime);
		echo ""._ADDEDON.": $datetime "._HITS.": $hits";
		$transfertitle = str_replace (" ", "_", $title);
		/* voting & comments stats */
		if ($totalvotes == 1) {
			$votestring = _VOTE;
		} else {
			$votestring = _VOTES;
		}
		if ($linkratingsummary!="0" || $linkratingsummary!="0.0") {
			echo " "._RATING.": <b> $linkratingsummary </b> ($totalvotes $votestring)";
		}
		echo "<br><a href=\"modules.php?name=$module_name&amp;l_op=ratelink&amp;lid=$lid\">"._RATESITE."</a>";
		if (is_user($user)) {
			echo " | <a href=\"modules.php?name=$module_name&amp;l_op=brokenlink&amp;lid=$lid\">"._REPORTBROKEN."</a>";
		}
		if ($totalvotes != 0) {
			echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkdetails&amp;lid=$lid\">"._DETAILS."</a>";
		}
		if ($totalcomments != 0) {
			echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkcomments&amp;lid=$lid&amp;ttitle=$transfertitle\">"._SCOMMENTS." ($totalcomments)</a>";
		}
		detecteditorial($lid, $transfertitle);
		echo "<br>";
		$row2 = $db->sql_fetchrow($db->sql_query("SELECT title from ".$prefix."_links_categories where cid='$cid'"));
		$ctitle = filter($row2['title'], "nohtml");
		$ctitle = getparent($cid,$ctitle);
		echo ""._CATEGORY.": $ctitle";
		echo "<br><br>";
		echo "<br><br>";
	}
	echo "</font></td></tr></table>";
	CloseTable();
	include("footer.php");
}

function MostPopular($ratenum, $ratetype) {
	global $prefix, $db, $admin, $module_name, $user, $admin_file, $locale, $mainvotedecimal, $datetime;
	$admin = base64_decode($admin);
	$admin = addslashes($admin);
	$admin = explode(":", $admin);
	$aid = "$admin[0]";
	$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper from ".$prefix."_authors where aid='$aid'"));
	$radminsuper = intval($row['radminsuper']);
	include("header.php");
	include("modules/$module_name/l_config.php");
	menu(1);
	echo "<br>";
	OpenTable();
	echo "<table border=\"0\" width=\"100%\"><tr><td align=\"center\">";
	if (!empty($ratenum) && !empty($ratetype)) {
		$ratenum = intval($ratenum);
		$ratetype = htmlentities($ratetype);
		$mostpoplinks = $ratenum;
		if ($ratetype == "percent") $mostpoplinkspercentrigger = 1;
	}
	if ($mostpoplinkspercentrigger == 1) {
		$toplinkspercent = $mostpoplinks;
		$result2 = $db->sql_query("SELECT * from ".$prefix."_links_links");
		$totalmostpoplinks = $db->sql_numrows($result2);
		$mostpoplinks = $mostpoplinks / 100;
		$mostpoplinks = $totalmostpoplinks * $mostpoplinks;
		$mostpoplinks = round($mostpoplinks);
	}
	if ($mostpoplinkspercentrigger == 1) {
		echo "<center><font class=\"option\"><b>"._MOSTPOPULAR." $toplinkspercent% ("._OFALL." $totalmostpoplinks "._LINKS.")</b></font></center>";
	} else {
		echo "<center><font class=\"option\"><b>"._MOSTPOPULAR." ".htmlentities($mostpoplinks)."</b></font></center>";
	}
	echo "<tr><td><center>"._SHOWTOP.": [ <a href=\"modules.php?name=$module_name&amp;l_op=MostPopular&amp;ratenum=10&amp;ratetype=num\">10</a> - "
	."<a href=\"modules.php?name=$module_name&amp;l_op=MostPopular&amp;ratenum=25&amp;ratetype=num\">25</a> - "
	."<a href=\"modules.php?name=$module_name&amp;l_op=MostPopular&amp;ratenum=50&amp;ratetype=num\">50</a> | "
	."<a href=\"modules.php?name=$module_name&amp;l_op=MostPopular&amp;ratenum=1&amp;ratetype=percent\">1%</a> - "
	."<a href=\"modules.php?name=$module_name&amp;l_op=MostPopular&amp;ratenum=5&amp;ratetype=percent\">5%</a> - "
	."<a href=\"modules.php?name=$module_name&amp;l_op=MostPopular&amp;ratenum=10&amp;ratetype=percent\">10%</a> ]</center><br><br></td></tr>";
	if(!is_numeric($mostpoplinks)) {
	$mostpoplinks=10;
	}
	$result3 = $db->sql_query("SELECT lid, cid, sid, title, description, date, hits, linkratingsummary, totalvotes, totalcomments from ".$prefix."_links_links order by hits DESC limit 0,$mostpoplinks");
	echo "<tr><td>";
	while($row3 = $db->sql_fetchrow($result3)) {
		$lid = intval($row3['lid']);
		$cid = intval($row3['cid']);
		$sid = intval($row3['sid']);
		$title = filter($row3['title'], "nohtml");
		$description = filter($row3['description']);
		$time = $row3['date'];
		$hits = intval($row3['hits']);
		$linkratingsummary = $row3['linkratingsummary'];
		$totalvotes = intval($row3['totalvotes']);
		$totalcomments = intval($row3['totalcomments']);
		$linkratingsummary = number_format($linkratingsummary, $mainvotedecimal);
		if (is_admin($admin)) {
	    	echo "<a href=\"".$admin_file.".php?op=LinksModLink&amp;lid=$lid\"><img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\""._EDIT."\"></a>&nbsp;&nbsp;";
		} else {
	    	echo "<img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\"\">&nbsp;&nbsp;";
		}
		echo "<font class=\"content\"><a href=\"modules.php?name=$module_name&amp;l_op=visit&amp;lid=$lid\" target=\"new\">$title</a>";
		newlinkgraphic($datetime, $time);
		popgraphic($hits);
		echo "<br>";
		echo ""._DESCRIPTION.": $description<br>";
		setlocale (LC_TIME, $locale);
		ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $time, $datetime);
		$datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
		$datetime = ucfirst($datetime);
		echo ""._ADDEDON.": $datetime "._HITS.": <b>$hits</b>";
		$transfertitle = str_replace (" ", "_", $title);
		/* voting & comments stats */
		if ($totalvotes == 1) {
			$votestring = _VOTE;
		} else {
			$votestring = _VOTES;
		}
		if ($linkratingsummary!="0" || $linkratingsummary!="0.0") {
			echo " "._RATING.": $linkratingsummary ($totalvotes $votestring)";
		}
		echo "<br>";
		if ($radminsuper == 1) {
			echo "<a href=\"".$admin_file.".php?op=LinksModLink&amp;lid=$lid\">"._EDIT."</a> | ";
		}
		echo "<a href=\"modules.php?name=$module_name&amp;l_op=ratelink&amp;lid=$lid\">"._RATESITE."</a>";
		if (is_user($user)) {
			echo " | <a href=\"modules.php?name=$module_name&amp;l_op=brokenlink&amp;lid=$lid\">"._REPORTBROKEN."</a>";
		}
		if ($totalvotes != 0) {
			echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkdetails&amp;lid=$lid\">"._DETAILS."</a>";
		}
		if ($totalcomments != 0) {
			echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkcomments&amp;lid=$lid&amp;ttitle=$transfertitle\">"._SCOMMENTS." ($totalcomments)</a>";
		}
		detecteditorial($lid, $transfertitle);
		echo "<br>";
		$row4 = $db->sql_fetchrow($db->sql_query("SELECT title from ".$prefix."_links_categories where cid='$cid'"));
		$ctitle = filter($row4['title'], "nohtml");
		$ctitle = getparent($cid,$ctitle);
		echo ""._CATEGORY.": $ctitle";
		echo "<br><br>";
		echo "<br><br></font>";
	}
	echo "</font></td></tr></table>";
	CloseTable();
	include("footer.php");
}

function RandomLink() {
	global $prefix, $db;
	$result = $db->sql_query("SELECT * from ".$prefix."_links_links");
	$numrows = $db->sql_numrows($result);
	if ($numrows == 1) {
		$random = 1;
	} else {
		srand((double)microtime()*1000000);
		$random = rand(1,$numrows);
		$random = intval($random);
	}
	$row2 = $db->sql_fetchrow($db->sql_query("SELECT url from ".$prefix."_links_links where lid='$random'"));
	$url = filter($row2['url'], "nohtml");
	$db->sql_query("update ".$prefix."_links_links set hits=hits+1 where lid='$random'");
	Header("Location: $url");
}

function viewlink($cid, $min, $orderby, $show) {
	global $prefix, $db, $admin, $perpage, $module_name, $user, $admin_file, $locale, $mainvotedecimal, $datetime;
	$show = intval($show);
	if (empty($show))
	{
		$show = '';
	}
	if (!empty($orderby)) {
		$orderby = htmlspecialchars($orderby);
	}
	$admin = base64_decode($admin);
	$admin = addslashes($admin);
	$admin = explode(":", $admin);
	$aid = "$admin[0]";
	$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper from ".$prefix."_authors where aid='$aid'"));
	$radminsuper = intval($row['radminsuper']);
	include("header.php");
	if (!isset($min)) $min=0;
	if (!isset($max)) $max=$min+$perpage;
	if(!empty($orderby)) {
		$orderby = convertorderbyin($orderby);
	} else {
		$orderby = "title ASC";
	}
	if (!empty($show)) {
		$perpage = $show;
	} else {
		$show=$perpage;
	}
	menu(1);
	echo "<br>";
	OpenTable();
	$cid = intval($cid);
	$row_two = $db->sql_fetchrow($db->sql_query("SELECT title,parentid FROM ".$prefix."_links_categories WHERE cid='$cid'"));
	$title = filter($row_two['title'], "nohtml");
	$parentid = intval($row_two['parentid']);
	$title = getparentlink($parentid,$title);
	$title = "<a href=modules.php?name=$module_name>"._MAIN."</a>/$title";
	echo "<center><font class=\"option\"><b>"._CATEGORY.": $title</b></font></center><br>";
	echo "<table border=\"0\" cellspacing=\"10\" cellpadding=\"0\" align=\"center\"><tr>";
	$cid = intval($cid);
	$result2 = $db->sql_query("SELECT cid, title, cdescription from ".$prefix."_links_categories where parentid='$cid' order by title");
	$dum = 0;
	$count = 0;
	while($row2 = $db->sql_fetchrow($result2)) {
		$cid2 = intval($row2['cid']);
		$title2 = filter($row2['title'], "nohtml");
		$cdescription2 = filter($row2['cdescription']);
		echo "<td><font class=\"option\"><strong><big>&middot;</big></strong> <a href=\"modules.php?name=Web_Links&amp;l_op=viewlink&amp;cid=$cid2\"><b>$title2</b></a></font>";
		categorynewlinkgraphic($cid2);
		if ($description) {
			echo "<font class=\"content\">$cdescription2</font><br>";
		} else {
			echo "<br>";
		}
		$result3 = $db->sql_query("SELECT cid, title from ".$prefix."_links_categories where parentid='$cid2' order by title limit 0,3");
		$space = 0;
		while($row3 = $db->sql_fetchrow($result3)) {
			$cid3 = intval($row3['cid']);
			$title3 = filter($row3['title'], "nohtml");
			if ($space>0) {
				echo ",&nbsp;";
			}
			echo "<font class=\"content\"><a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid3\">$title3</a></font>";
			$space++;
		}
		if ($count<1) {
			echo "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td>";
			$dum = 1;
		}
		$count++;
		if ($count==2) {
			echo "</td></tr><tr>";
			$count = 0;
			$dum = 0;
		}
	}
	if ($dum == 1) {
		echo "</tr></table>";
	} elseif ($dum == 0) {
		echo "<td></td></tr></table>";
	}

	echo "<hr noshade size=\"1\">";
	$orderbyTrans = convertorderbytrans($orderby);
	echo "<center><font class=\"content\">"._SORTLINKSBY.": "
	.""._TITLE." (<a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;orderby=titleA\">A</a>\<a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;orderby=titleD\">D</a>) "
	.""._DATE." (<a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;orderby=dateA\">A</a>\<a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;orderby=dateD\">D</a>) "
	.""._RATING." (<a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;orderby=ratingA\">A</a>\<a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;orderby=ratingD\">D</a>) "
	.""._POPULARITY." (<a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;orderby=hitsA\">A</a>\<a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;orderby=hitsD\">D</a>)"
	."<br><b>"._SITESSORTED.": $orderbyTrans</b></font></center><br><br>";
	if(!is_numeric($min)){
	$min=0;
	}
	$result4 = $db->sql_query("SELECT lid, title, description, date, hits, linkratingsummary, totalvotes, totalcomments from ".$prefix."_links_links where cid='$cid' order by $orderby limit $min,$perpage");
	$fullcountresult = $db->sql_query("SELECT lid, title, description, date, hits, linkratingsummary, totalvotes, totalcomments from ".$prefix."_links_links where cid='$cid'");
	$totalselectedlinks = $db->sql_numrows($fullcountresult);
	echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"10\" border=\"0\"><tr><td><font class=\"content\">";
	$x=0;
	while($row4 = $db->sql_fetchrow($result4)) {
		$lid = intval($row4['lid']);
		$title = filter($row4['title'], "nohtml");
		$description = filter($row4['description']);
		$time = $row4['date'];
		$hits = intval($row4['hits']);
		$linkratingsummary = $row4['linkratingsummary'];
		$totalvotes = intval($row4['totalvotes']);
		$totalcomments = intval($row4['totalcomments']);
		$linkratingsummary = number_format($linkratingsummary, $mainvotedecimal);
		if (is_admin($admin)) {
	    	echo "<a href=\"".$admin_file.".php?op=LinksModLink&amp;lid=$lid\"><img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\""._EDIT."\"></a>&nbsp;&nbsp;";
		} else {
	    	echo "<img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\"\">&nbsp;&nbsp;";
		}
		echo "<a href=\"modules.php?name=$module_name&amp;l_op=visit&amp;lid=$lid\" target=\"new\"><b>$title</b></a>";
		newlinkgraphic($datetime, $time);
		popgraphic($hits);
		/* INSERT code for *editor review* here */
		echo "<br>";
		echo ""._DESCRIPTION.": $description<br>";
		setlocale (LC_TIME, $locale);
		ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $time, $datetime);
		$datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
		$datetime = ucfirst($datetime);
		echo ""._ADDEDON.": $datetime "._HITS.": $hits";
		$transfertitle = str_replace (" ", "_", $title);
		/* voting & comments stats */
		if ($totalvotes == 1) {
			$votestring = _VOTE;
		} else {
			$votestring = _VOTES;
		}
		if ($linkratingsummary!="0" || $linkratingsummary!="0.0") {
			echo " "._RATING.": $linkratingsummary ($totalvotes $votestring)";
		}
		echo "<br>";
		if ($radminsuper == 1) {
			echo "<a href=\"".$admin_file.".php?op=LinksModLink&amp;lid=$lid\">"._EDIT."</a> | ";
		}
		echo "<a href=\"modules.php?name=$module_name&amp;l_op=ratelink&amp;lid=$lid\">"._RATESITE."</a>";
		if (is_user($user)) {
			echo " | <a href=\"modules.php?name=$module_name&amp;l_op=brokenlink&amp;lid=$lid\">"._REPORTBROKEN."</a>";
		}
		if ($totalvotes != 0) {
			echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkdetails&amp;lid=$lid\">"._DETAILS."</a>";
		}
		if ($totalcomments != 0) {
			echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkcomments&amp;lid=$lid&amp;ttitle=$transfertitle\">"._SCOMMENTS." ($totalcomments)</a>";
		}
		detecteditorial($lid, $transfertitle);
		echo "<br><br>";
		$x++;
	}
	echo "</font>";
	$orderby = convertorderbyout($orderby);
	/* Calculates how many pages exist. Which page one should be on, etc... */
	$linkpagesint = ($totalselectedlinks / $perpage);
	$linkpageremainder = ($totalselectedlinks % $perpage);
	if ($linkpageremainder != 0) {
		$linkpages = ceil($linkpagesint);
		if ($totalselectedlinks < $perpage) {
			$linkpageremainder = 0;
		}
	} else {
		$linkpages = $linkpagesint;
	}
	/* Page Numbering */
	if ($linkpages!=1 && $linkpages!=0) {
		echo "<br><br>";
		echo ""._SELECTPAGE.": ";
		$prev=$min-$perpage;
		if ($prev>=0) {
			echo "&nbsp;&nbsp;<b>[ <a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;min=$prev&amp;orderby=$orderby&amp;show=$show\">";
			echo " &lt;&lt; "._PREVIOUS."</a> ]</b> ";
		}
		$counter = 1;
		$currentpage = ($max / $perpage);
		while ($counter<=$linkpages ) {
			$cpage = $counter;
			$mintemp = ($perpage * $counter) - $perpage;
			if ($counter == $currentpage) {
				echo "<b>$counter</b>&nbsp;";
			} else {
				echo "<a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;min=$mintemp&amp;orderby=$orderby&amp;show=$show\">$counter</a> ";
			}
			$counter++;
		}
		$next=$min+$perpage;
		if ($x>=$perpage) {
			echo "&nbsp;&nbsp;<b>[ <a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;min=$max&amp;orderby=$orderby&amp;show=$show\">";
			echo " "._NEXT." &gt;&gt;</a> ]</b> ";
		}
	}
	echo "</td></tr></table>";
	CloseTable();
	include("footer.php");
}

function newlinkgraphic($datetime, $time) {
	global $module_name, $locale;
	echo "&nbsp;";
	setlocale (LC_TIME, $locale);
	ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $time, $datetime);
	$datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
	$datetime = ucfirst($datetime);
	$startdate = time();
	$count = 0;
	while ($count <= 7) {
		$daysold = date("d-M-Y", $startdate);
		if ("$daysold" == "$datetime") {
			if ($count<=1) {
				echo "<img src=\"modules/$module_name/images/newred.gif\" alt=\""._NEWTODAY."\">";
			}
			if ($count<=3 && $count>1) {
				echo "<img src=\"modules/$module_name/images/newgreen.gif\" alt=\""._NEWLAST3DAYS."\">";
			}
			if ($count<=7 && $count>3) {
				echo "<img src=\"modules/$module_name/images/newblue.gif\" alt=\""._NEWTHISWEEK."\">";
			}
		}
		$count++;
		$startdate = (time()-(86400 * $count));
	}
}

function categorynewlinkgraphic($cat) {
	global $prefix, $db, $module_name, $locale;
	$cat = intval(trim($cat));
	$row = $db->sql_fetchrow($db->sql_query("SELECT date from ".$prefix."_links_links where cid='$cat' order by date desc limit 1"));
	$time = $row['date'];
	echo "&nbsp;";
	setlocale (LC_TIME, $locale);
	ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $time, $datetime);
	$datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
	$datetime = ucfirst($datetime);
	$startdate = time();
	$count = 0;
	while ($count <= 7) {
		$daysold = date("d-M-Y", $startdate);
		if ("$daysold" == "$datetime") {
			if ($count<=1) {
				echo "<img src=\"modules/$module_name/images/newred.gif\" alt=\""._CATNEWTODAY."\">";
			}
			if ($count<=3 && $count>1) {
				echo "<img src=\"modules/$module_name/images/newgreen.gif\" alt=\""._CATLAST3DAYS."\">";
			}
			if ($count<=7 && $count>3) {
				echo "<img src=\"modules/$module_name/images/newblue.gif\" alt=\""._CATTHISWEEK."\">";
			}
		}
		$count++;
		$startdate = (time()-(86400 * $count));
	}
}

function popgraphic($hits) {
	global $module_name;
	include("modules/$module_name/l_config.php");
	if ($hits>=$popular) {
		echo "&nbsp;<img src=\"modules/$module_name/images/pop.gif\" alt=\""._POPULAR."\">";
	}
}

function convertorderbyin($orderby) {
	if ($orderby != "titleA" AND $orderby != "dateA" AND $orderby != "hitsA" AND $orderby != "ratingA" AND $orderby != "titleD" AND $orderby != "dateD" AND $orderby != "hitsD" AND $orderby != "ratingD") {
	    Header("Location: index.php");
	    die();
	}
	if ($orderby == "titleA")	$orderby = "title ASC";
	if ($orderby == "dateA")	$orderby = "date ASC";
	if ($orderby == "hitsA")	$orderby = "hits ASC";
	if ($orderby == "ratingA")	$orderby = "linkratingsummary ASC";
	if ($orderby == "titleD")	$orderby = "title DESC";
	if ($orderby == "dateD")	$orderby = "date DESC";
	if ($orderby == "hitsD")	$orderby = "hits DESC";
	if ($orderby == "ratingD")	$orderby = "linkratingsummary DESC";
	return $orderby;
}

function convertorderbytrans($orderby) {
	if ($orderby != "hits ASC" AND $orderby != "hits DESC" AND $orderby != "title ASC" AND $orderby != "title DESC" AND $orderby != "date ASC" AND $orderby != "date DESC" AND $orderby != "linkratingsummary ASC" AND $orderby != "linkratingsummary DESC") {
	    Header("Location: index.php");
	    die();
	}
	if ($orderby == "hits ASC")			$orderbyTrans = ""._POPULARITY1."";
	if ($orderby == "hits DESC")		$orderbyTrans = ""._POPULARITY2."";
	if ($orderby == "title ASC")		$orderbyTrans = ""._TITLEAZ."";
	if ($orderby == "title DESC")		$orderbyTrans = ""._TITLEZA."";
	if ($orderby == "date ASC")			$orderbyTrans = ""._DATE1."";
	if ($orderby == "date DESC")		$orderbyTrans = ""._DATE2."";
	if ($orderby == "linkratingsummary ASC")	$orderbyTrans = ""._RATING1."";
	if ($orderby == "linkratingsummary DESC")	$orderbyTrans = ""._RATING2."";
	return $orderbyTrans;
}

function convertorderbyout($orderby) {
	if ($orderby != "title ASC" AND $orderby != "date ASC" AND $orderby != "hits ASC" AND $orderby != "linkratingsummary ASC" AND $orderby != "title DESC" AND $orderby != "date DESC" AND $orderby != "hits DESC" AND $orderby != "linkratingsummary DESC") {
	    Header("Location: index.php");
	    die();
	}
	if ($orderby == "title ASC")		$orderby = "titleA";
	if ($orderby == "date ASC")			$orderby = "dateA";
	if ($orderby == "hits ASC")			$orderby = "hitsA";
	if ($orderby == "linkratingsummary ASC")	$orderby = "ratingA";
	if ($orderby == "title DESC")		$orderby = "titleD";
	if ($orderby == "date DESC")		$orderby = "dateD";
	if ($orderby == "hits DESC")		$orderby = "hitsD";
	if ($orderby == "linkratingsummary DESC")	$orderby = "ratingD";
	return $orderby;
}

function visit($lid) {
	global $prefix, $db;
	$lid = intval($lid);
	$db->sql_query("update ".$prefix."_links_links set hits=hits+1 where lid='$lid'");
	update_points(14);
	$row = $db->sql_fetchrow($db->sql_query("SELECT url from ".$prefix."_links_links where lid='$lid'"));
	$url = filter($row['url'], "nohtml");
	Header("Location: $url");
}

function search($query, $min, $orderby, $show) {
	global $prefix, $db, $admin, $bgcolor2, $module_name, $locale, $mainvotedecimal, $datetime, $admin_file;
	include("modules/$module_name/l_config.php");
	include("header.php");
	if (!isset($min)) $min=0;
	if (!isset($max)) $max=$min+$linksresults;
	if(!empty($orderby)) {
		$orderby = convertorderbyin($orderby);
	} else {
		$orderby = "title ASC";
	}
	if ($show!="") {
		$linksresults = $show;
	} else {
		$show=$linksresults;
	}
    $query1 = filter($query, "nohtml", 1);
	$query2 = filter($query, "", 1);
	if(!is_numeric($linksresults) AND $linksresults==0)
	{
	$linksresults=10;
	}
	$result = $db->sql_query("SELECT lid, cid, sid, title, url, description, date, hits, linkratingsummary, totalvotes, totalcomments from ".$prefix."_links_links where title LIKE '%$query1%' OR description LIKE '%$query2%' ORDER BY $orderby LIMIT $min,$linksresults");
	$fullcountresult = $db->sql_query("SELECT lid, title, description, date, hits, linkratingsummary, totalvotes, totalcomments from ".$prefix."_links_links where title LIKE '%$query1%' OR description LIKE '%$query2%'");
	$totalselectedlinks = $db->sql_numrows($fullcountresult);
	$nrows = $db->sql_numrows($result);
	$x=0;
    $the_query = filter($query, "nohtml");
    $the_query = FixQuotes($the_query);
	menu(1);
	echo "<br>";
	OpenTable();
	if ($query != "") {
		if ($nrows>0) {
			echo "<font class=\"option\">"._SEARCHRESULTS4.": <b>$the_query</b></font><br><br>"
			."<table width=\"100%\" bgcolor=\"$bgcolor2\"><tr><td><font class=\"option\"><b>"._USUBCATEGORIES."</b></font></td></tr></table>";
			$result2 = $db->sql_query("SELECT cid, title from ".$prefix."_links_categories where title LIKE '%$query1%' ORDER BY title DESC");
			while ($row2 = $db->sql_fetchrow($result2)) {
				$cid = intval($row2['cid']);
				$stitle = filter($row2['title'], "nohtml");
				$res = $db->sql_query("SELECT * from ".$prefix."_links_links where cid='$cid'");
				$numrows = $db->sql_numrows($res);
				$row3 = $db->sql_fetchrow($db->sql_query("SELECT cid,title,parentid from ".$prefix."_links_categories where cid='$cid'"));
				$cid3 = intval($row3['cid']);
				$title3 = filter($row3['title'], "nohtml");
				$parentid3 = intval($row3['parentid']);
				if ($parentid3>0) $title3 = getparent($parentid3,$title3);
				$title3 = ereg_replace($query1, "<b>$query1</b>", $title3);
				echo "<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid\">$title3</a> ($numrows)<br>";
			}
			echo "<br><table width=\"100%\" bgcolor=\"$bgcolor2\"><tr><td><font class=\"option\"><b>"._LINKS."</b></font></td></tr></table>";
			$orderbyTrans = convertorderbytrans($orderby);
			echo "<br><font class=\"content\">"._SORTLINKSBY.": "
			.""._TITLE." (<a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;orderby=titleA\">A</a>\<a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;orderby=titleD\">D</a>)"
			.""._DATE." (<a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;orderby=dateA\">A</a>\<a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;orderby=dateD\">D</a>)"
			.""._RATING." (<a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;orderby=ratingA\">A</a>\<a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;orderby=ratingD\">D</a>)"
			.""._POPULARITY." (<a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;orderby=hitsA\">A</a>\<a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;orderby=hitsD\">D</a>)"
			."<br>"._SITESSORTED.": $orderbyTrans<br><br>";
			while($row = $db->sql_fetchrow($result)) {
				$lid = intval($row['lid']);
				$cid = intval($row['cid']);
				$sid = intval($row['sid']);
				$title = filter($row['title'], "nohtml");
				$url = filter($row['url'], "nohtml");
				$description = filter($row['description']);
				$time = $row['date'];
				$hits = intval($row['hits']);
				$linkratingsummary = $row['linkratingsummary'];
				$totalvotes = intval($row['totalvotes']);
				$totalcomments = intval($row['totalcomments']);
				$linkratingsummary = number_format($linkratingsummary, $mainvotedecimal);
				$transfertitle = str_replace (" ", "_", $title);
				$title = ereg_replace($query1, "<b>$query1</b>", $title);
				if (is_admin($admin)) {
			    	echo "<a href=\"".$admin_file.".php?op=LinksModLink&amp;lid=$lid\"><img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\""._EDIT."\"></a>&nbsp;&nbsp;";
				} else {
			    	echo "<img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\"\">&nbsp;&nbsp;";
				}
				echo "<a href=\"modules.php?name=$module_name&amp;l_op=visit&amp;lid=$lid\" target=\"new\">$title</a>";
				newlinkgraphic($datetime, $time);
				popgraphic($hits);
				echo "<br>";
				$description = ereg_replace($the_query, "<b>$the_query</b>", $description);
				echo ""._DESCRIPTION.": $description<br>";
				setlocale (LC_TIME, $locale);
				ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $time, $datetime);
				$datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
				$datetime = ucfirst($datetime);
				echo ""._ADDEDON.": $datetime "._HITS.": $hits";
				/* voting & comments stats */
				if ($totalvotes == 1) {
					$votestring = _VOTE;
				} else {
					$votestring = _VOTES;
				}
				if ($linkratingsummary!="0" || $linkratingsummary!="0.0") {
					echo " "._RATING.": $linkratingsummary ($totalvotes $votestring)";
				}
				echo "<br><a href=\"modules.php?name=$module_name&amp;l_op=ratelink&amp;lid=$lid\">"._RATESITE."</a>";
				if ($totalvotes != 0) {
					echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkdetails&amp;lid=$lid\">"._DETAILS."</a>";
				}
				if ($totalcomments != 0) {
					echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkcomments&amp;lid=$lid&amp;ttitle=$transfertitle>"._SCOMMENTS." ($totalcomments)</a>";
				}
				detecteditorial($lid, $transfertitle);
				echo "<br>";
				$row4 = $db->sql_fetchrow($db->sql_query("SELECT cid,title,parentid from ".$prefix."_links_categories where cid='$cid'"));
				$cid3 = intval($row4['cid']);
				$title3 = filter($row4['title'], "nohtml");
				$parentid3 = intval($row4['parentid']);
				if ($parentid3>0) $title3 = getparent($parentid3,$title3);
				echo ""._CATEGORY.": $title3<br><br>";
				$x++;
			}
			echo "</font>";
			$orderby = convertorderbyout($orderby);
		} else {
			echo "<br><br><center><font class=\"option\"><b>"._NOMATCHES."</b></font><br><br>"._GOBACK."<br></center>";
		}
		/* Calculates how many pages exist.  Which page one should be on, etc... */
		$linkpagesint = ($totalselectedlinks / $linksresults);
		$linkpageremainder = ($totalselectedlinks % $linksresults);
		if ($linkpageremainder != 0) {
			$linkpages = ceil($linkpagesint);
			if ($totalselectedlinks < $linksresults) {
				$linkpageremainder = 0;
			}
		} else {
			$linkpages = $linkpagesint;
		}
		/* Page Numbering */
		if ($linkpages!=1 && $linkpages!=0) {
			echo "<br><br>"
			.""._SELECTPAGE.": ";
			$prev=$min-$linksresults;
			if ($prev>=0) {
				echo "&nbsp;&nbsp;<b>[ <a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;min=$prev&amp;orderby=$orderby&amp;show=$show\">"
				." &lt;&lt; "._PREVIOUS."</a> ]</b> ";
			}
			$counter = 1;
			$currentpage = ($max / $linksresults);
			while ($counter<=$linkpages ) {
				$cpage = $counter;
				$mintemp = ($perpage * $counter) - $linksresults;
				if ($counter == $currentpage) {
					echo "<b>$counter</b>&nbsp;";
				} else {
					echo "<a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;min=$mintemp&amp;orderby=$orderby&amp;show=$show\">$counter</a> ";
				}
				$counter++;
			}
			$next=$min+$linksresults;
			if ($x>=$perpage) {
				echo "&nbsp;&nbsp;<b>[ <a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;min=$max&amp;orderby=$orderby&amp;show=$show\">"
				." "._NEXT." &gt;&gt;</a> ]</b>";
			}
		}
		echo "<br><br><center><font class=\"content\">"
		.""._TRY2SEARCH." \"$the_query\" "._INOTHERSENGINES."<br>"
		."<a target=\"_blank\" href=\"http://www.altavista.com/cgi-bin/query?pg=q&amp;sc=on&amp;hl=on&amp;act=2006&amp;par=0&amp;q=$the_query&amp;kl=XX&amp;stype=stext\">Alta Vista</a> - "
		."<a target=\"_blank\" href=\"http://search.yahoo.com/bin/search?p=$the_query\">Yahoo</a> - "
		."<a target=\"_blank\" href=\"http://www.google.com/search?q=$the_query\">Google</a>"
		."</font>";
	} else {
		echo "<center><font class=\"option\"><b>"._NOMATCHES."</b></font></center><br><br>";
	}
	CloseTable();
	include("footer.php");
}

function viewlinkeditorial($lid) {
	global $prefix, $db, $admin, $module_name;
	include("header.php");
	include("modules/$module_name/l_config.php");
	menu(1);
	$row = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_links_links WHERE lid='$lid'"));
    $ttitle = filter($row['title'], "nohtml");
	$lid = intval(trim($lid));
	$result = $db->sql_query("SELECT adminid, editorialtimestamp, editorialtext, editorialtitle FROM ".$prefix."_links_editorials WHERE linkid = '$lid'");
	$recordexist = $db->sql_numrows($result);
	$transfertitle = ereg_replace ("_", " ", $ttitle);
	$displaytitle = $transfertitle;
	echo "<br>";
	OpenTable();
	echo "<center><font class=\"option\"><b>"._LINKPROFILE.": ".htmlentities($displaytitle)."</b></font><br>";
	linkinfomenu($lid);
	if ($recordexist != 0) {
		while($row = $db->sql_fetchrow($result)) {
			$adminid = intval($row['adminid']);
			$editorialtimestamp = $row['editorialtimestamp'];
			$editorialtext = filter($row['editorialtext']);
			$editorialtitle = filter($row['editorialtitle'], "nohtml");
			ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $editorialtimestamp, $editorialtime);
			$editorialtime = strftime("%F",mktime($editorialtime[4],$editorialtime[5],$editorialtime[6],$editorialtime[2],$editorialtime[3],$editorialtime[1]));
			$date_array = explode("-", $editorialtime);
			$timestamp = mktime(0, 0, 0, $date_array['1'], $date_array['2'], $date_array['0']);
			$formatted_date = date("F j, Y", $timestamp);
			echo "<br><br>";
			OpenTable2();
			echo "<center><font class=\"option\"><b>'$editorialtitle'</b></font></center>"
			."<center><font class=\"tiny\">"._EDITORIALBY." $adminid - $formatted_date</font></center><br><br>"
			."$editorialtext";
			CloseTable2();
		}
	} else {
		echo "<br><br><center><font class=\"option\"><b>"._NOEDITORIAL."</b></font></center>";
	}
	echo "<br><br><center>";
	linkfooter($lid);
	echo "</center>";
	CloseTable();
	include("footer.php");
}

function detecteditorial($lid) {
	global $prefix, $db, $module_name;
	$lid = intval($lid);
	$resulted2 = $db->sql_query("SELECT adminid from ".$prefix."_links_editorials where linkid='$lid'");
	$recordexist = $db->sql_numrows($resulted2);
	if ($recordexist != 0) {
		echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkeditorial&amp;lid=$lid\">"._EDITORIAL."</a>";
	}
}

function viewlinkcomments($lid) {
	global $prefix, $db, $admin, $bgcolor2, $module_name, $admin_file;
	include("header.php");
	include("modules/$module_name/l_config.php");
	menu(1);
	$row = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_links_links WHERE lid='$lid'"));
    $ttitle = filter($row['title'], "nohtml");
	$lid = intval(trim($lid));
	echo "<br>";
	$result = $db->sql_query("SELECT ratinguser, rating, ratingcomments, ratingtimestamp FROM ".$prefix."_links_votedata WHERE ratinglid = '$lid' AND ratingcomments != '' ORDER BY ratingtimestamp DESC");
	$totalcomments = $db->sql_numrows($result);
	$transfertitle = ereg_replace ("_", " ", $ttitle);
	$displaytitle = $transfertitle;
	OpenTable();
	echo "<center><font class=\"option\"><b>"._LINKPROFILE.": ".htmlentities($displaytitle)."</b></font><br><br>";
	linkinfomenu($lid);
	echo "<br><br><br>"._TOTALOF." $totalcomments "._COMMENTS."</font></center><br>"
	."<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" width=\"450\">";
	$x=0;
	while($row = $db->sql_fetchrow($result)) {
		$ratinguser = $row['ratinguser'];
		$rating = intval($row['rating']);
		$ratingcomments = $row['ratingcomments'];
		$ratingtimestamp = $row['ratingtimestamp'];
		ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $ratingtimestamp, $ratingtime);
		$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
		$date_array = explode("-", $ratingtime);
		$timestamp = mktime(0, 0, 0, $date_array['1'], $date_array['2'], $date_array['0']);
		$formatted_date = date("F j, Y", $timestamp);
		/* Individual user information */
		$result2 = $db->sql_query("SELECT rating FROM ".$prefix."_links_votedata WHERE ratinguser = '$ratinguser'");
		$usertotalcomments = $db->sql_numrows($result2);
		$useravgrating = 0;
		while($row2 = $db->sql_fetchrow($result2))
		$rating2 = intval($row2['rating']);
		$useravgrating = $useravgrating + $rating2;
		$useravgrating = $useravgrating / $usertotalcomments;
		$useravgrating = number_format($useravgrating, 1);
		echo "<tr><td bgcolor=\"$bgcolor2\">"
		."<font class=\"content\"><b> "._USER.": </b><a href=\"$nukeurl/modules.php?name=Your_Account&amp;op=userinfo&amp;username=$ratinguser\">$ratinguser</a></font>"
		."</td>"
		."<td bgcolor=\"$bgcolor2\">"
		."<font class=\"content\"><b>"._RATING.": </b>$rating</font>"
		."</td>"
		."<td bgcolor=\"$bgcolor2\" align=\"right\">"
		."<font class=\"content\">$formatted_date</font>"
		."</td>"
		."</tr>"
		."<tr>"
		."<td valign=\"top\">"
		."<font class=\"tiny\">"._USERAVGRATING.": $useravgrating</font>"
		."</td>"
		."<td valign=\"top\" colspan=\"2\">"
		."<font class=\"tiny\">"._NUMRATINGS.": $usertotalcomments</font>"
		."</td>"
		."</tr>"
		."<tr>"
		."<td colspan=\"3\">"
		."<font class=\"content\">";
		if (is_admin($admin)) {
			echo "<a href=\"".$admin_file.".php?op=LinksModLink&amp;lid=$lid\"><img src=\"modules/$module_name/images/editicon.gif\" border=\"0\" alt=\""._EDITTHISLINK."\"></a>";
		}
		echo " $ratingcomments</font>"
		."<br><br><br></td></tr>";
		$x++;
	}
	echo "</table><br><br><center>";
	linkfooter($lid);
	echo "</center>";
	CloseTable();
	include("footer.php");
}

function viewlinkdetails($lid) {
	global $prefix, $db, $admin, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $module_name, $anonymous;
	include("header.php");
	include("modules/$module_name/l_config.php");
	menu(1);
	$lid = intval($lid);
	$voteresult = $db->sql_query("SELECT rating, ratinguser, ratingcomments FROM ".$prefix."_links_votedata WHERE ratinglid = '$lid'");
	$totalvotesDB = $db->sql_numrows($voteresult);
	$anonvotes = 0;
	$anonvoteval = 0;
	$outsidevotes = 0;
	$outsidevoteeval = 0;
	$regvoteval = 0;
	$topanon = 0;
	$bottomanon = 11;
	$topreg = 0;
	$bottomreg = 11;
	$topoutside = 0;
	$bottomoutside = 11;
	$avv = array(0,0,0,0,0,0,0,0,0,0,0);
	$rvv = array(0,0,0,0,0,0,0,0,0,0,0);
	$ovv = array(0,0,0,0,0,0,0,0,0,0,0);
	$truecomments = $totalvotesDB;
	while($row = $db->sql_fetchrow($voteresult)) {
		$ratingDB = intval($row['rating']);
		$ratinguserDB = $row['ratinguser'];
		$ratingcommentsDB = $row['ratingcomments'];
		if ($ratingcommentsDB=="") $truecomments--;
		if ($ratinguserDB==$anonymous) {
			$anonvotes++;
			$anonvoteval += $ratingDB;
		}
		if ($useoutsidevoting == 1) {
			if ($ratinguserDB=='outside') {
				$outsidevotes++;
				$outsidevoteval += $ratingDB;
			}
		} else {
			$outsidevotes = 0;
		}
		if ($ratinguserDB!=$anonymous && $ratinguserDB!="outside") {
			$regvoteval += $ratingDB;
		}
		if ($ratinguserDB!=$anonymous && $ratinguserDB!="outside") {
			if ($ratingDB > $topreg) $topreg = $ratingDB;
			if ($ratingDB < $bottomreg) $bottomreg = $ratingDB;
			for ($rcounter=1; $rcounter<11; $rcounter++) if ($ratingDB==$rcounter) $rvv[$rcounter]++;
		}
		if ($ratinguserDB==$anonymous) {
			if ($ratingDB > $topanon) $topanon = $ratingDB;
			if ($ratingDB < $bottomanon) $bottomanon = $ratingDB;
			for ($rcounter=1; $rcounter<11; $rcounter++) if ($ratingDB==$rcounter) $avv[$rcounter]++;
		}
		if ($ratinguserDB=="outside") {
			if ($ratingDB > $topoutside) $topoutside = $ratingDB;
			if ($ratingDB < $bottomoutside) $bottomoutside = $ratingDB;
			for ($rcounter=1; $rcounter<11; $rcounter++) if ($ratingDB==$rcounter) $ovv[$rcounter]++;
		}
	}
	$regvotes = $totalvotesDB - $anonvotes - $outsidevotes;
	if ($totalvotesDB == 0) {
		$finalrating = 0;
	} else if ($anonvotes == 0 && $regvotes == 0) {
		/* Figure Outside Only Vote */
		$finalrating = $outsidevoteval / $outsidevotes;
		$finalrating = number_format($finalrating, $detailvotedecimal);
		$avgOU = $outsidevoteval / $totalvotesDB;
		$avgOU = number_format($avgOU, $detailvotedecimal);
	} else if ($outsidevotes == 0 && $regvotes == 0) {
		/* Figure Anon Only Vote */
		$finalrating = $anonvoteval / $anonvotes;
		$finalrating = number_format($finalrating, $detailvotedecimal);
		$avgAU = $anonvoteval / $totalvotesDB;
		$avgAU = number_format($avgAU, $detailvotedecimal);
	} else if ($outsidevotes == 0 && $anonvotes == 0) {
		/* Figure Reg Only Vote */
		$finalrating = $regvoteval / $regvotes;
		$finalrating = number_format($finalrating, $detailvotedecimal);
		$avgRU = $regvoteval / $totalvotesDB;
		$avgRU = number_format($avgRU, $detailvotedecimal);
	} else if ($regvotes == 0 && $useoutsidevoting == 1 && $outsidevotes != 0 && $anonvotes != 0 ) {
		/* Figure Reg and Anon Mix */
		$avgAU = $anonvoteval / $anonvotes;
		$avgOU = $outsidevoteval / $outsidevotes;
		if ($anonweight > $outsideweight ) {
			/* Anon is 'standard weight' */
			$newimpact = $anonweight / $outsideweight;
			$impactAU = $anonvotes;
			$impactOU = $outsidevotes / $newimpact;
			$finalrating = ((($avgOU * $impactOU) + ($avgAU * $impactAU)) / ($impactAU + $impactOU));
			$finalrating = number_format($finalrating, $detailvotedecimal);
		} else {
			/* Outside is 'standard weight' */
			$newimpact = $outsideweight / $anonweight;
			$impactOU = $outsidevotes;
			$impactAU = $anonvotes / $newimpact;
			$finalrating = ((($avgOU * $impactOU) + ($avgAU * $impactAU)) / ($impactAU + $impactOU));
			$finalrating = number_format($finalrating, $detailvotedecimal);
		}
	} else {
		/* REG User vs. Anonymous vs. Outside User Weight Calutions */
		$impact = $anonweight;
		$outsideimpact = $outsideweight;
		if ($regvotes == 0) {
			$avgRU = 0;
		} else {
			$avgRU = $regvoteval / $regvotes;
		}
		if ($anonvotes == 0) {
			$avgAU = 0;
		} else {
			$avgAU = $anonvoteval / $anonvotes;
		}
		if ($outsidevotes == 0 ) {
			$avgOU = 0;
		} else {
			$avgOU = $outsidevoteval / $outsidevotes;
		}
		$impactRU = $regvotes;
		$impactAU = $anonvotes / $impact;
		$impactOU = $outsidevotes / $outsideimpact;
		$finalrating = (($avgRU * $impactRU) + ($avgAU * $impactAU) + ($avgOU * $impactOU)) / ($impactRU + $impactAU + $impactOU);
		$finalrating = number_format($finalrating, $detailvotedecimal);
	}
    if (!isset($avgOU) || $avgOU == 0 || empty($avgOU)) {
		$avgOU = "";
	} else {
		$avgOU = number_format($avgOU, $detailvotedecimal);
	}
    if (!isset($avgRU) || $avgRU == 0 || empty($avgRU)) {
		$avgRU = "";
	} else {
		$avgRU = number_format($avgRU, $detailvotedecimal);
	}
    if (!isset($avgAU) || $avgAU == 0 || empty($avgAU)) {
		$avgAU = "";
	} else {
		$avgAU = number_format($avgAU, $detailvotedecimal);
	}
	if ($topanon == 0) $topanon = "";
	if ($bottomanon == 11) $bottomanon = "";
	if ($topreg == 0) $topreg = "";
	if ($bottomreg == 11) $bottomreg = "";
	if ($topoutside == 0) $topoutside = "";
	if ($bottomoutside == 11) $bottomoutside = "";
	$totalchartheight = 70;
	$chartunits = $totalchartheight / 10;
	$avvper		= array(0,0,0,0,0,0,0,0,0,0,0);
	$rvvper 		= array(0,0,0,0,0,0,0,0,0,0,0);
	$ovvper 		= array(0,0,0,0,0,0,0,0,0,0,0);
	$avvpercent 	= array(0,0,0,0,0,0,0,0,0,0,0);
	$rvvpercent 	= array(0,0,0,0,0,0,0,0,0,0,0);
	$ovvpercent 	= array(0,0,0,0,0,0,0,0,0,0,0);
	$avvchartheight	= array(0,0,0,0,0,0,0,0,0,0,0);
	$rvvchartheight	= array(0,0,0,0,0,0,0,0,0,0,0);
	$ovvchartheight	= array(0,0,0,0,0,0,0,0,0,0,0);
	$avvmultiplier = 0;
	$rvvmultiplier = 0;
	$ovvmultiplier = 0;
	for ($rcounter=1; $rcounter<11; $rcounter++) {
		if ($anonvotes != 0) $avvper[$rcounter] = $avv[$rcounter] / $anonvotes;
		if ($regvotes != 0) $rvvper[$rcounter] = $rvv[$rcounter] / $regvotes;
		if ($outsidevotes != 0) $ovvper[$rcounter] = $ovv[$rcounter] / $outsidevotes;
		$avvpercent[$rcounter] = number_format($avvper[$rcounter] * 100, 1);
		$rvvpercent[$rcounter] = number_format($rvvper[$rcounter] * 100, 1);
		$ovvpercent[$rcounter] = number_format($ovvper[$rcounter] * 100, 1);
		if ($avv[$rcounter] > $avvmultiplier) $avvmultiplier = $avv[$rcounter];
		if ($rvv[$rcounter] > $rvvmultiplier) $rvvmultiplier = $rvv[$rcounter];
		if ($ovv[$rcounter] > $ovvmultiplier) $ovvmultiplier = $ovv[$rcounter];
	}
	if ($avvmultiplier != 0) $avvmultiplier = 10 / $avvmultiplier;
	if ($rvvmultiplier != 0) $rvvmultiplier = 10 / $rvvmultiplier;
	if ($ovvmultiplier != 0) $ovvmultiplier = 10 / $ovvmultiplier;
	for ($rcounter=1; $rcounter<11; $rcounter++) {
		$avvchartheight[$rcounter] = ($avv[$rcounter] * $avvmultiplier) * $chartunits;
		$rvvchartheight[$rcounter] = ($rvv[$rcounter] * $rvvmultiplier) * $chartunits;
		$ovvchartheight[$rcounter] = ($ovv[$rcounter] * $ovvmultiplier) * $chartunits;
		if ($avvchartheight[$rcounter]==0) $avvchartheight[$rcounter]=1;
		if ($rvvchartheight[$rcounter]==0) $rvvchartheight[$rcounter]=1;
		if ($ovvchartheight[$rcounter]==0) $ovvchartheight[$rcounter]=1;
	}
    $res = $db->sql_query("SELECT title FROM ".$prefix."_links_links WHERE lid='$lid'");
    list($title) = $db->sql_fetchrow($res);
    $ttitle = filter($title, "nohtml");
    $displaytitle = $ttitle;
	echo "<br>";
	OpenTable();
	echo "<center><font class=\"option\"><b>"._LINKPROFILE.": ".htmlentities($displaytitle)."</b></font><br><br>";
	linkinfomenu($lid);
	echo "<br><br>"._LINKRATINGDET."<br>"
	.""._TOTALVOTES." $totalvotesDB<br>"
	.""._OVERALLRATING.": $finalrating</center><br><br>"
	."<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" width=\"455\">"
	."<tr><td colspan=\"2\" bgcolor=\"$bgcolor2\">"
	."<font class=\"content\"><b>"._REGISTEREDUSERS."</b></font>"
	."</td></tr>"
	."<tr>"
	."<td bgcolor=\"$bgcolor1\">"
	."<font class=\"content\">"._NUMBEROFRATINGS.": $regvotes</font>"
	."</td>"
	."<td rowspan=\"5\" width=\"200\">";
	if ($regvotes==0) {
		echo "<center><font class=\"content\">"._NOREGUSERSVOTES."</font></center>";
	} else {
		echo "<table border=\"1\" width=\"200\">"
		."<tr>"
		."<td valign=\"top\" align=\"center\" colspan=\"10\" bgcolor=\"$bgcolor2\"><font class=\"content\">"._BREAKDOWNBYVAL."</font></td>"
		."</tr>"
		."<tr>"
		."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[1] "._LVOTES." ($rvvpercent[1]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[1]\"></td>"
		."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[2] "._LVOTES." ($rvvpercent[2]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[2]\"></td>"
		."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[3] "._LVOTES." ($rvvpercent[3]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[3]\"></td>"
		."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[4] "._LVOTES." ($rvvpercent[4]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[4]\"></td>"
		."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[5] "._LVOTES." ($rvvpercent[5]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[5]\"></td>"
		."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[6] "._LVOTES." ($rvvpercent[6]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[6]\"></td>"
		."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[7] "._LVOTES." ($rvvpercent[7]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[7]\"></td>"
		."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[8] "._LVOTES." ($rvvpercent[8]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[8]\"></td>"
		."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[9] "._LVOTES." ($rvvpercent[9]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[9]\"></td>"
		."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[10] "._LVOTES." ($rvvpercent[10]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$rvvchartheight[10]\"></td>"
		."</tr>"
		."<tr><td colspan=\"10\" bgcolor=\"$bgcolor2\">"
		."<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"200\"><tr>"
		."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">1</font></td>"
		."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">2</font></td>"
		."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">3</font></td>"
		."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">4</font></td>"
		."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">5</font></td>"
		."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">6</font></td>"
		."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">7</font></td>"
		."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">8</font></td>"
		."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">9</font></td>"
		."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">10</font></td>"
		."</tr></table>"
		."</td></tr></table>";
	}
	echo "</td>"
	."</tr>"
	."<tr><td bgcolor=\"$bgcolor2\"><font class=\"content\">"._LINKRATING.": $avgRU</font></td></tr>"
	."<tr><td bgcolor=\"$bgcolor1\"><font class=\"content\">"._HIGHRATING.": $topreg</font></td></tr>"
	."<tr><td bgcolor=\"$bgcolor2\"><font class=\"content\">"._LOWRATING.": $bottomreg</font></td></tr>"
	."<tr><td bgcolor=\"$bgcolor1\"><font class=\"content\">"._NUMOFCOMMENTS.": $truecomments</font></td></tr>"
	."<tr><td></td></tr>"
	."<tr><td valign=\"top\" colspan=\"2\"><font class=\"tiny\"><br><br>"._WEIGHNOTE." $anonweight "._TO." 1.</font></td></tr>"
	."<tr><td colspan=\"2\" bgcolor=\"$bgcolor2\"><font class=\"content\"><b>"._UNREGISTEREDUSERS."</b></font></td></tr>"
	."<tr><td bgcolor=\"$bgcolor1\"><font class=\"content\">"._NUMBEROFRATINGS.": $anonvotes</font></td>"
	."<td rowspan=\"5\" width=\"200\">";
	if ($anonvotes==0) {
		echo "<center><font class=\"content\">"._NOUNREGUSERSVOTES."</font></center>";
	} else {
		echo "<table border=\"1\" width=\"200\">"
		."<tr>"
		."<td valign=\"top\" align=\"center\" colspan=\"10\" bgcolor=\"$bgcolor2\"><font class=\"content\">"._BREAKDOWNBYVAL."</font></td>"
		."</tr>"
		."<tr>"
		."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[1] "._LVOTES." ($avvpercent[1]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[1]\"></td>"
		."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[2] "._LVOTES." ($avvpercent[2]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[2]\"></td>"
		."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[3] "._LVOTES." ($avvpercent[3]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[3]\"></td>"
		."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[4] "._LVOTES." ($avvpercent[4]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[4]\"></td>"
		."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[5] "._LVOTES." ($avvpercent[5]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[5]\"></td>"
		."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[6] "._LVOTES." ($avvpercent[6]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[6]\"></td>"
		."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[7] "._LVOTES." ($avvpercent[7]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[7]\"></td>"
		."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[8] "._LVOTES." ($avvpercent[8]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[8]\"></td>"
		."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[9] "._LVOTES." ($avvpercent[9]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[9]\"></td>"
		."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[10] "._LVOTES." ($avvpercent[10]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[10]\"></td>"
		."</tr>"
		."<tr><td colspan=\"10\" bgcolor=\"$bgcolor2\">"
		."<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"200\"><tr>"
		."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">1</font></td>"
		."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">2</font></td>"
		."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">3</font></td>"
		."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">4</font></td>"
		."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">5</font></td>"
		."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">6</font></td>"
		."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">7</font></td>"
		."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">8</font></td>"
		."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">9</font></td>"
		."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">10</font></td>"
		."</tr></table>"
		."</td></tr></table>";
	}
	echo "</td>"
	."</tr>"
	."<tr><td bgcolor=\"$bgcolor2\"><font class=\"content\">"._LINKRATING.": $avgAU</font></td></tr>"
	."<tr><td bgcolor=\"$bgcolor1\"><font class=\"content\">"._HIGHRATING.": $topanon</font></td></tr>"
	."<tr><td bgcolor=\"$bgcolor2\"><font class=\"content\">"._LOWRATING.": $bottomanon</font></td></tr>"
	."<tr><td bgcolor=\"$bgcolor1\"><font class=\"content\">&nbsp;</font></td></tr>";
	if ($useoutsidevoting == 1) {
		echo "<tr><td valign=top colspan=\"2\"><font class=\"tiny\"><br><br>"._WEIGHOUTNOTE." $outsideweight "._TO." 1.</font></td></tr>"
		."<tr><td colspan=\"2\" bgcolor=\"$bgcolor2\"><font class=\"content\"><b>"._OUTSIDEVOTERS."</b></font></td></tr>"
		."<tr><td bgcolor=\"$bgcolor1\"><font class=\"content\">"._NUMBEROFRATINGS.": $outsidevotes</font></td>"
		."<td rowspan=\"5\" width=\"200\">";
		if ($outsidevotes==0) {
			echo "<center><font class=\"content\">"._NOOUTSIDEVOTES."</font></center>";
		} else {
			echo "<table border=\"1\" width=\"200\">"
			."<tr>"
			."<td valign=\"top\" align=\"center\" colspan=\"10\" bgcolor=\"$bgcolor2\"><font class=\"content\">"._BREAKDOWNBYVAL."</font></td>"
			."</tr>"
			."<tr>"
			."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[1] "._LVOTES." ($ovvpercent[1]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[1]\"></td>"
			."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[2] "._LVOTES." ($ovvpercent[2]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[2]\"></td>"
			."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[3] "._LVOTES." ($ovvpercent[3]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[3]\"></td>"
			."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[4] "._LVOTES." ($ovvpercent[4]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[4]\"></td>"
			."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[5] "._LVOTES." ($ovvpercent[5]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[5]\"></td>"
			."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[6] "._LVOTES." ($ovvpercent[6]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[6]\"></td>"
			."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[7] "._LVOTES." ($ovvpercent[7]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[7]\"></td>"
			."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[8] "._LVOTES." ($ovvpercent[8]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[8]\"></td>"
			."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[9] "._LVOTES." ($ovvpercent[9]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[9]\"></td>"
			."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[10] "._LVOTES." ($ovvpercent[10]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[10]\"></td>"
			."</tr>"
			."<tr><td colspan=\"10\" bgcolor=\"$bgcolor2\">"
			."<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"200\"><tr>"
			."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">1</font></td>"
			."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">2</font></td>"
			."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">3</font></td>"
			."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">4</font></td>"
			."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">5</font></td>"
			."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">6</font></td>"
			."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">7</font></td>"
			."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">8</font></td>"
			."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">9</font></td>"
			."<td width=\"10%\" valign=\"bottom\" align=\"center\"><font class=\"content\">10</font></td>"
			."</tr></table>"
			."</td></tr></table>";
		}
		echo "</td>"
		."</tr>"
		."<tr><td bgcolor=\"$bgcolor2\"><font class=\"content\">"._LINKRATING.": $avgOU</font></td></tr>"
		."<tr><td bgcolor=\"$bgcolor1\"><font class=\"content\">"._HIGHRATING.": $topoutside</font></td></tr>"
		."<tr><td bgcolor=\"$bgcolor2\"><font class=\"content\">"._LOWRATING.": $bottomoutside</font></td></tr>"
		."<tr><td bgcolor=\"$bgcolor1\"><font class=\"content\">&nbsp;</font></td></tr>";
	}
	echo "</table><br><br><center>";
	linkfooter($lid);
	echo "</center>";
	CloseTable();
	include("footer.php");
}

function linkfooter($lid) {
	global $module_name;
	echo "<font class=\"content\">[ <a href=\"modules.php?name=$module_name&amp;l_op=visit&amp;lid=$lid\" target=\"_blank\">"._VISITTHISSITE."</a> | <a href=\"modules.php?name=$module_name&amp;l_op=ratelink&amp;lid=$lid\">"._RATETHISSITE."</a> ]</font><br><br>";
	linkfooterchild($lid);
}

function linkfooterchild($lid) {
	global $module_name;
	include("modules/$module_name/l_config.php");
	if ($useoutsidevoting = 1) {
		echo "<br><font class=\"content\">"._ISTHISYOURSITE." <a href=\"modules.php?name=$module_name&amp;l_op=outsidelinksetup&amp;lid=$lid\">"._ALLOWTORATE."</a></font>";
	}
}

function outsidelinksetup($lid) {
	global $module_name, $sitename, $nukeurl;
	include("header.php");
	include("modules/$module_name/l_config.php");
	menu(1);
	echo "<br>";
	OpenTable();
	echo "<center><font class=\"option\"><b>"._PROMOTEYOURSITE."</b></font></center><br><br>

    "._PROMOTE01."<br><br>

    <b>1) "._TEXTLINK."</b><br><br>

    "._PROMOTE02."<br><br>
    <center><a href=\"$nukeurl/modules.php?name=$module_name&amp;l_op=ratelink&amp;lid=$lid\">"._RATETHISSITE." @ $sitename</a></center><br><br>
    <center>"._HTMLCODE1."</center><br>
    <center><i>&lt;a href=\"$nukeurl/modules.php?name=$module_name&amp;l_op=ratelink&amp;lid=$lid\"&gt;"._RATETHISSITE."&lt;/a&gt;</i></center>
    <br><br>
    "._THENUMBER." \"$lid\" "._IDREFER."<br><br>

    <b>2) "._BUTTONLINK."</b><br><br>

    "._PROMOTE03."<br><br>

    <center>
    <form action=\"modules.php?name=$module_name\" method=\"post\">\n
	<input type=\"hidden\" name=\"lid\" value=\"$lid\">\n
	<input type=\"hidden\" name=\"l_op\" value=\"ratelink\">\n
	<input type=\"submit\" value=\""._RATEIT."\">\n
    </form>\n
    </center>

    <center>"._HTMLCODE2."</center><br><br>

    <table border=\"0\" align=\"center\"><tr><td align=\"left\"><i>
    &lt;form action=\"$nukeurl/modules.php?name=$module_name\" method=\"post\"&gt;<br>\n
    &nbsp;&nbsp;&lt;input type=\"hidden\" name=\"lid\" value=\"$lid\"&gt;<br>\n
    &nbsp;&nbsp;&lt;input type=\"hidden\" name=\"l_op\" value=\"ratelink\"&gt;<br>\n
    &nbsp;&nbsp;&lt;input type=\"submit\" value=\""._RATEIT."\"&gt;<br>\n
    &lt;/form&gt;\n
    </i></td></tr></table>

    <br><br>

    <b>3) "._REMOTEFORM."</b><br><br>

    "._PROMOTE04."

    <center>
    <form method=\"post\" action=\"$nukeurl/modules.php?name=$module_name\">
    <table align=\"center\" border=\"0\" width=\"175\" cellspacing=\"0\" cellpadding=\"0\">
    <tr><td align=\"center\"><b>"._VOTE4THISSITE."</b></a></td></tr>
    <tr><td>
    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
    <tr><td valign=\"top\">
        <select name=\"rating\">
        <option selected>--</option>
	<option>10</option>
	<option>9</option>
	<option>8</option>
	<option>7</option>
	<option>6</option>
	<option>5</option>
	<option>4</option>
	<option>3</option>
	<option>2</option>
	<option>1</option>
	</select>
    </td><td valign=\"top\">
	<input type=\"hidden\" name=\"ratinglid\" value=\"$lid\">
        <input type=\"hidden\" name=\"ratinguser\" value=\"outside\">
        <input type=\"hidden\" name=\"op value=\"addrating\">
	<input type=\"submit\" value=\""._LINKVOTE."\">
    </td></tr></table>
    </td></tr></table></form>

    <br>"._HTMLCODE3."<br><br></center>

    <blockquote><i>
    &lt;form method=\"post\" action=\"$nukeurl/modules.php?name=$module_name\"&gt;<br>
	&lt;table align=\"center\" border=\"0\" width=\"175\" cellspacing=\"0\" cellpadding=\"0\"&gt;<br>
	    &lt;tr&gt;&lt;td align=\"center\"&gt;&lt;b&gt;"._VOTE4THISSITE."&lt;/b&gt;&lt;/a&gt;&lt;/td&gt;&lt;/tr&gt;<br>
	    &lt;tr&gt;&lt;td&gt;<br>
	    &lt;table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\"&gt;<br>
		&lt;tr&gt;&lt;td valign=\"top\"&gt;<br>
    		&lt;select name=\"rating\"&gt;<br>
    		&lt;option selected&gt;--&lt;/option&gt;<br>
		&lt;option&gt;10&lt;/option&gt;<br>
		&lt;option&gt;9&lt;/option&gt;<br>
		&lt;option&gt;8&lt;/option&gt;<br>
		&lt;option&gt;7&lt;/option&gt;<br>
		&lt;option&gt;6&lt;/option&gt;<br>
		&lt;option&gt;5&lt;/option&gt;<br>
		&lt;option&gt;4&lt;/option&gt;<br>
		&lt;option&gt;3&lt;/option&gt;<br>
		&lt;option&gt;2&lt;/option&gt;<br>
		&lt;option&gt;1&lt;/option&gt;<br>
		&lt;/select&gt;<br>
	    &lt;/td&gt;&lt;td valign=\"top\"&gt;<br>
		&lt;input type=\"hidden\" name=\"ratinglid\" value=\"$lid\"&gt;<br>
    		&lt;input type=\"hidden\" name=\"ratinguser\" value=\"outside\"&gt;<br>
    		&lt;input type=\"hidden\" name=\"l_op\" value=\"addrating\"&gt;<br>
		&lt;input type=\"submit\" value=\""._LINKVOTE."\"&gt;<br>
	    &lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;<br>
	&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;<br>
    &lt;/form&gt;<br>
    </i></blockquote>
    <br><br><center>
    "._PROMOTE05."<br><br>
    - $sitename "._STAFF."
    <br><br></center>";
	CloseTable();
	include("footer.php");
}

function brokenlink($lid) {
	global $prefix, $db, $user, $cookie, $module_name;
	if (is_user($user)) {
		include("header.php");
		include("modules/$module_name/l_config.php");
		$user2 = base64_decode($user);
		$user2 = addslashes($user2);
		$cookie = explode(":", $user2);
		cookiedecode($user);
		$ratinguser = $cookie[1];
		menu(1);
		$lid = intval($lid);
		echo "<br>";
		$row = $db->sql_fetchrow($db->sql_query("SELECT cid, title, url, description from ".$prefix."_links_links where lid='$lid'"));
		$cid = intval($row['cid']);
		$title = filter($row['title'], "nohtml");
		$url = filter($row['url'], "nohtml");
		$description = filter($row['description']);
		OpenTable();
		echo "<center><font class=\"option\"><b>"._REPORTBROKEN."</b></font><br><br><br><font class=\"content\">";
		echo "<form action=\"modules.php?name=$module_name\" method=\"post\">";
		echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\">";
		echo "<input type=\"hidden\" name=\"cid\" value=\"$cid\">";
		echo "<input type=\"hidden\" name=\"title\" value=\"$title\">";
		echo "<input type=\"hidden\" name=\"url\" value=\"$url\">";
		echo "<input type=\"hidden\" name=\"description\" value=\"$description\">";
		echo "<input type=\"hidden\" name=\"modifysubmitter\" value=\"$ratinguser\">";
		echo ""._THANKSBROKEN."<br><br>";
		echo "<input type=\"hidden\" name=\"l_op\" value=\"brokenlinkS\"><input type=\"submit\" value=\""._REPORTBROKEN."\"></center></form>";
		CloseTable();
		include("footer.php");
	} else {
		Header("Location: modules.php?name=$module_name");
	}
}

function brokenlinkS($lid,$cid, $title, $url, $description, $modifysubmitter) {
	global $prefix, $db, $user, $anonymous, $cookie, $module_name, $user;
	if (is_user($user)) {
		include("modules/$module_name/l_config.php");
		$user2 = base64_decode($user);
		$user2 = addslashes($user2);
		$cookie = explode(":", $user2);
		cookiedecode($user);
		$ratinguser = $cookie[1];
		$lid = intval($lid);
		$cid = intval($cid);
		$title = filter($title, "nohtml", 1);
		$description = filter($description, "", 1);
		$url = filter($url, "nohtml", 1);
		$modifysubmitter = filter($modifysubmitter, "nohtml", 1);
		$db->sql_query("insert into ".$prefix."_links_modrequest values (NULL, '$lid', '$cid', '0', '".addslashes($title)."', '".addslashes($url)."', '".addslashes($description)."', '".addslashes($ratinguser)."', '1')");
		include("header.php");
		menu(1);
		echo "<br>";
		OpenTable();
		echo "<br><center>"._THANKSFORINFO."<br><br>"._LOOKTOREQUEST."</center><br>";
		CloseTable();
		include("footer.php");
	} else {
		Header("Location: modules.php?name=$module_name");
	}
}

function modifylinkrequest($lid) {
	global $prefix, $db, $user, $module_name, $anonymous;
	include("header.php");
	include("modules/$module_name/l_config.php");
	if(is_user($user)) {
		$user2 = base64_decode($user);
		$user2 = addslashes($user2);
		$cookie = explode(":", $user2);
		cookiedecode($user);
		$ratinguser = $cookie[1];
	} else {
		$ratinguser = "$anonymous";
	}
	menu(1);
	echo "<br>";
	OpenTable();
	$blocknow = 0;
	$lid = intval(trim($lid));
	if ($blockunregmodify == 1 && $ratinguser=="$anonymous") {
		echo "<br><br><center>"._ONLYREGUSERSMODIFY."</center>";
		$blocknow = 1;
	}
	if ($blocknow != 1) {
		$result = $db->sql_query("SELECT cid, sid, title, url, description from ".$prefix."_links_links where lid='$lid'");
		echo "<center><font class=\"option\"><b>"._REQUESTLINKMOD."</b></font><br><font class=\"content\">";
		while($row = $db->sql_fetchrow($result)) {
			$cid = intval($row['cid']);
			$sid = intval($row['sid']);
			$title = filter($row['title'], "nohtml");
			$url = filter($row['url'], "nohtml");
			$description = filter($row['description']);
			echo "<form action=\"modules.php?name=$module_name\" method=\"post\">"
			.""._LINKID.": <b>$lid</b></center><br><br><br>"
			.""._LINKTITLE.":<br><input type=\"text\" name=\"title\" value=\"$title\" size=\"50\" maxlength=\"100\"><br><br>"
			.""._URL.":<br><input type=\"text\" name=\"url\" value=\"$url\" size=\"50\" maxlength=\"100\"><br><br>"
			.""._DESCRIPTION.": <br><textarea name=\"description\" cols=\"70\" rows=\"15\">$description</textarea><br><br>";
			// $result2=sql_query("select cid, title from ".$prefix."_links_categories order by title", $dbi);
			echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\">"
			."<input type=\"hidden\" name=\"modifysubmitter\" value=\"$ratinguser\">"
			.""._CATEGORY.": <select name=\"cat\">";
			$result2 = $db->sql_query("SELECT cid, title, parentid from ".$prefix."_links_categories order by title");
			while($row2 = $db->sql_fetchrow($result2)) {
				$cid2 = intval($row2['cid']);
				$ctitle2 = filter($row2['title'], "nohtml");
				$parentid2 = intval($row2['parentid']);
				if ($cid2==$cid) {
					$sel = "selected";
				} else {
					$sel = "";
				}
				if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
				echo "<option value=\"$cid2\" $sel>$ctitle2</option>";
			}
			echo "</select><br><br>"
			."<input type=\"hidden\" name=\"l_op\" value=\"modifylinkrequestS\">"
			."<input type=\"submit\" value=\""._SENDREQUEST."\"></form>";
		}
	}
	CloseTable();
	include("footer.php");
}

function modifylinkrequestS($lid, $cat, $title, $url, $description, $modifysubmitter) {
	global $prefix, $db, $user, $module_name;
	include("modules/$module_name/l_config.php");
	if(is_user($user)) {
		$user2 = base64_decode($user);
		$user2 = addslashes($user2);
		$cookie = explode(":", $user2);
		cookiedecode($user);
		$ratinguser = $cookie[1];
	} else {
		$ratinguser = "$anonymous";
	}
	$blocknow = 0;
	if ($blockunregmodify == 1 && $ratinguser=="$anonymous") {
		include("header.php");
		menu(1);
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"content\">"._ONLYREGUSERSMODIFY."</font></center>";
		$blocknow = 1;
		CloseTable();
		include("footer.php");
	}
	if ($blocknow != 1) {
		$cat = explode("-", $cat);
		if (empty($cat[1])) {
			$cat[1] = 0;
		}
		$title = filter($title, "nohtml", 1);
		$description = filter($description, "", 1);
		$url = filter($url, "nohtml", 1);
		$lid = intval($lid);
		$cat[0] = intval($cat[0]);
		$cat[1] = intval($cat[1]);
		$db->sql_query("insert into ".$prefix."_links_modrequest values (NULL, '$lid', '$cat[0]', '$cat[1]', '".addslashes($title)."', '".addslashes($url)."', '".addslashes($description)."', '".addslashes($ratinguser)."', 0)");
		include("header.php");
		menu(1);
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"content\">"._THANKSFORINFO." "._LOOKTOREQUEST."</font></center>";
		CloseTable();
		include("footer.php");
	}
}

function rateinfo($lid) {
	global $prefix, $db;
	$lid = intval($lid);
	$db->sql_query("update ".$prefix."_links_links set hits=hits+1 where lid='$lid'");
	$row = $db->sql_fetchrow($db->sql_query("SELECT url from ".$prefix."_links_links where lid='$lid'"));
	$url = filter($row['url'], "nohtml");
	Header("Location: $url");
}

function addrating($ratinglid, $ratinguser, $rating, $ratinghost_name, $ratingcomments) {
	global $prefix, $db, $cookie, $user, $module_name, $anonymous;
	$passtest = "yes";
	include("header.php");
	include("modules/$module_name/l_config.php");
	$ratinglid = intval($ratinglid);
	completevoteheader();
	if(is_user($user)) {
		$user2 = base64_decode($user);
		$user2 = addslashes($user2);
		$cookie = explode(":", $user2);
		cookiedecode($user);
		$ratinguser = $cookie[1];
	} else if ($ratinguser=="outside") {
		$ratinguser = "outside";
	} else {
		$ratinguser = "$anonymous";
	}
	$result = $db->sql_query("SELECT title FROM ".$prefix."_links_links WHERE lid='$ratinglid'");
	while ($row = $db->sql_fetchrow($result)) {
		$title = filter($row['title'], "nohtml");
		$ttitle = $title;
		/* Make sure only 1 anonymous from an IP in a single day. */
		if(isset($_SERVER['REMOTE_HOST'])) { $ip = $_SERVER['REMOTE_HOST'];}
		if (empty($ip)) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		/* Check if Rating is Null */
		if ($rating=="--") {
			$error = "nullerror";
			completevote($error);
			$passtest = "no";
		}
		/* Check if Link POSTER is voting (UNLESS Anonymous users allowed to post) */
		if ($ratinguser != $anonymous && $ratinguser != "outside") {
			$result2 = $db->sql_query("SELECT submitter from ".$prefix."_links_links where lid='$ratinglid'");
			while ($row2 = $db->sql_fetchrow($result2)) {
				$ratinguserDB = $row2['submitter'];
				if ($ratinguserDB==$ratinguser) {
					$error = "postervote";
					completevote($error);
					$passtest = "no";
				}
			}
		}
		/* Check if REG user is trying to vote twice. */
		if ($ratinguser!=$anonymous && $ratinguser != "outside") {
			$result3 = $db->sql_query("SELECT ratinguser from ".$prefix."_links_votedata where ratinglid='$ratinglid'");
			while ($row3 = $db->sql_fetchrow($result3)) {
				$ratinguserDB = $row3['ratinguser'];
				if ($ratinguserDB==$ratinguser) {
					$error = "regflood";
					completevote($error);
					$passtest = "no";
				}
			}
		}
		/* Check if ANONYMOUS user is trying to vote more than once per day. */
		if ($ratinguser==$anonymous){
			$yesterdaytimestamp = (time()-(86400 * $anonwaitdays));
			$ytsDB = Date("Y-m-d H:i:s", $yesterdaytimestamp);
			$result4 = $db->sql_query("SELECT * FROM ".$prefix."_links_votedata WHERE ratinglid='$ratinglid' AND ratinguser='$anonymous' AND ratinghostname = '$ip' AND TO_DAYS(NOW()) - TO_DAYS(ratingtimestamp) < '$anonwaitdays'");
			$anonvotecount = $db->sql_numrows($result4);
			if ($anonvotecount >= 1) {
				$error = "anonflood";
				completevote($error);
				$passtest = "no";
			}
		}
		/* Check if OUTSIDE user is trying to vote more than once per day. */
		if ($ratinguser=="outside"){
			$yesterdaytimestamp = (time()-(86400 * $outsidewaitdays));
			$ytsDB = Date("Y-m-d H:i:s", $yesterdaytimestamp);
			$result5 = $db->sql_query("SELECT * FROM ".$prefix."_links_votedata WHERE ratinglid='$ratinglid' AND ratinguser='outside' AND ratinghostname = '$ip' AND TO_DAYS(NOW()) - TO_DAYS(ratingtimestamp) < '$outsidewaitdays'");
			$outsidevotecount = $db->sql_numrows($result5);
			if ($outsidevotecount >= 1) {
				$error = "outsideflood";
				completevote($error);
				$passtest = "no";
			}
		}
		/* Passed Tests */
		if ($passtest == "yes") {
			$comment = filter(ratingcomments);
			if (!empty($comment)) {
				update_points(16);
			}
			update_points(15);
			/* All is well.  Add to Line Item Rate to DB. */
			$ratinglid = intval($ratinglid);
			$rating = intval($rating);
			if ($rating > 10 || $rating < 1) { 
			   header("Location: modules.php?name=$module_name&d_op=ratedownload&lid=$ratinglid"); 
			   die(); 
			}
			$db->sql_query("INSERT into ".$prefix."_links_votedata values (NULL,'$ratinglid', '$ratinguser', '$rating', '$ip', '$ratingcomments', now())");
			/* All is well.  Calculate Score & Add to Summary (for quick retrieval & sorting) to DB. */
			/* NOTE: If weight is modified, ALL links need to be refreshed with new weight. */
			/*	 Running a SQL statement with your modded calc for ALL links will accomplish this. */
			$voteresult = $db->sql_query("SELECT rating, ratinguser, ratingcomments FROM ".$prefix."_links_votedata WHERE ratinglid = '$ratinglid'");
			$totalvotesDB = $db->sql_numrows($voteresult);
			include ("modules/$module_name/voteinclude.php");
			$lid = intval($lid);
			$db->sql_query("UPDATE ".$prefix."_links_links SET linkratingsummary='$finalrating',totalvotes='$totalvotesDB',totalcomments='$truecomments' WHERE lid = '$ratinglid'");
			$error = "none";
			completevote($error);
		}
	}
	completevotefooter($ratinglid, $ratinguser);
	include("footer.php");
}

function completevoteheader(){
	menu(1);
	echo "<br>";
	OpenTable();
}

function completevotefooter($lid, $ratinguser) {
	global $prefix, $db, $sitename, $module_name;
	$row = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_links_links where lid='$lid'"));
	$ttitle = filter($row['title'], "nohtml");
	include("modules/$module_name/l_config.php");
	$lid = intval($lid);
	$row = $db->sql_fetchrow($db->sql_query("SELECT url FROM ".$prefix."_links_links WHERE lid='$lid'"));
	$url = filter($row['url'], "nohtml");
	echo "<font class=\"content\">"._THANKSTOTAKETIME." $sitename. "._LETSDECIDE."</font><br><br><br>";
	if ($ratinguser=="outside") {
		echo "<center><font class=\"content\">".WEAPPREACIATE." $sitename!<br><a href=\"$url\">"._RETURNTO." $ttitle</a></font><center><br><br>";
		$row2 = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_links_links where lid='$lid'"));
		$title = filter($row2['title'], "nohtml");
		$ttitle = ereg_replace (" ", "_", $title);
	}
	echo "<center>";
	linkinfomenu($lid);
	echo "</center>";
	CloseTable();
}

function completevote($error) {
	global $module_name;
	include("modules/$module_name/l_config.php");
	if ($error == "none") echo "<center><font class=\"content\"><b>"._COMPLETEVOTE1."</b></font></center>";
	if ($error == "anonflood") echo "<center><font class=\"option\"><b>"._COMPLETEVOTE2."</b></font></center><br>";
	if ($error == "regflood") echo "<center><font class=\"option\"><b>"._COMPLETEVOTE3."</b></font></center><br>";
	if ($error == "postervote") echo "<center><font class=\"option\"><b>"._COMPLETEVOTE4."</b></font></center><br>";
	if ($error == "nullerror") echo "<center><font class=\"option\"><b>"._COMPLETEVOTE5."</b></font></center><br>";
	if ($error == "outsideflood") echo "<center><font class=\"option\"><b>"._COMPLETEVOTE6."</b></font></center><br>";
}

function ratelink($lid, $user) {
	global $prefix, $cookie, $datetime, $module_name, $user_prefix;
	include("header.php");
	menu(1);
	echo "<br>";
	OpenTable();
    $row = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_links_links WHERE lid='$lid'"));
    $displaytitle = filter($row['title'], "nohtml");
	if(isset($_SERVER['REMOTE_HOST'])) { $ip = $_SERVER['REMOTE_HOST'];}
	if (empty($ip)) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	echo "<b>".htmlentities($displaytitle)."</b>"
	."<ul><font class=\"content\">"
	."<li>"._RATENOTE1.""
	."<li>"._RATENOTE2.""
	."<li>"._RATENOTE3.""
	."<li>"._RATENOTE4.""
	."<li>"._RATENOTE5."";
	if(is_user($user)) {
		$user2 = base64_decode($user);
		$user2 = addslashes($user2);
		$cookie = explode(":", $user2);
		echo "<li>"._YOUAREREGGED.""
		."<li>"._FEELFREE2ADD."";
		cookiedecode($user);
		$auth_name = $cookie[1];
	} else {
		echo "<li>"._YOUARENOTREGGED.""
		."<li>"._IFYOUWEREREG."";
		$auth_name = "$anonymous";
	}
	echo "</ul>"
	."<form method=\"post\" action=\"modules.php?name=$module_name\">"
	."<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" width=\"100%\">"
	."<tr><td width=\"25\" nowrap></td>"
	."<tr><td width=\"25\" nowrap></td><td width=\"550\">"
	."<input type=\"hidden\" name=\"ratinglid\" value=\"$lid\">"
	."<input type=\"hidden\" name=\"ratinguser\" value=\"$auth_name\">"
	."<input type=\"hidden\" name=\"ratinghost_name\" value=\"$ip\">"
	."<font class=content>"._RATETHISSITE.""
	."<select name=\"rating\">"
	."<option>--</option>"
	."<option>10</option>"
	."<option>9</option>"
	."<option>8</option>"
	."<option>7</option>"
	."<option>6</option>"
	."<option>5</option>"
	."<option>4</option>"
	."<option>3</option>"
	."<option>2</option>"
	."<option>1</option>"
	."</select></font>"
	."<font class=\"content\"><input type=\"submit\" value=\""._RATETHISSITE."\"></font>"
	."<br><br>";
    $karma = $db->sql_fetchrow($db->sql_query("SELECT karma FROM ".$user_prefix."_users WHERE user_id='$cookie[0]'"));
    if(is_user($user) AND $karma['karma'] != 3 AND $karma['karma'] != 4) {
		echo "<b>"._SCOMMENTS.":</b><br><textarea wrap=\"virtual\" cols=\"70\" rows=\"15\" name=\"ratingcomments\"></textarea>"
		."<br><br><br>"
		."</font></td>";
	} else {
		echo"<input type=\"hidden\" name=\"ratingcomments\" value=\"\">";
	}
	echo "</tr></table></form>";
	echo "<center>";
	linkfooterchild($lid);
	echo "</center>";
	CloseTable();
	include("footer.php");
}

if (isset($ratinglid) && isset ($ratinguser) && isset ($rating)) {
	$ret = addrating($ratinglid, $ratinguser, $rating, $ratinghost_name, $ratingcomments);
}

if (!isset($l_op)) { $l_op = ""; }
if (!isset($min)) { $min = ""; }
if (!isset($orderby)) { $orderby = ""; }
if (!isset($show)) { $show = ""; }
if (!isset($newlinkshowdays)) { $newlinkshowdays = ""; }
if (!isset($ratenum)) { $ratenum = ""; }
if (!isset($ratetype)) { $ratetype = ""; }

switch($l_op) {

	case "AddLink":
	AddLink();
	break;

	case "NewLinks":
	NewLinks($newlinkshowdays);
	break;

	case "NewLinksDate":
	NewLinksDate($selectdate);
	break;

	case "TopRated":
	TopRated($ratenum, $ratetype);
	break;

	case "MostPopular":
	MostPopular($ratenum, $ratetype);
	break;

	case "RandomLink":
	RandomLink();
	break;

	case "viewlink":
	viewlink($cid, $min, $orderby, $show);
	break;

	case "brokenlink":
	brokenlink($lid);
	break;

	case "modifylinkrequest":
	modifylinkrequest($lid);
	break;

	case "modifylinkrequestS":
	modifylinkrequestS($lid, $cat, $title, $url, $description, $modifysubmitter);
	break;

	case "brokenlinkS":
	brokenlinkS($lid,$cid, $title, $url, $description, $modifysubmitter);
	break;

	case "visit":
	visit($lid);
	break;

	case "Add":
	Add($title, $url, $auth_name, $cat, $description, $email);
	break;

	case "search":
	search($query, $min, $orderby, $show);
	break;

	case "rateinfo":
	rateinfo($lid, $user, $title);
	break;

	case "ratelink":
	ratelink($lid, $user);
	break;

	case "addrating":
	addrating($ratinglid, $ratinguser, $rating, $ratinghost_name, $ratingcomments, $user);
	break;

	case "viewlinkcomments":
	viewlinkcomments($lid);
	break;

	case "outsidelinksetup":
	outsidelinksetup($lid);
	break;

	case "viewlinkeditorial":
	viewlinkeditorial($lid);
	break;

	case "viewlinkdetails":
	viewlinkdetails($lid);
	break;

	default:
	index();
	break;

}

?>
