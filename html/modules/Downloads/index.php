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

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = "- "._UDOWNLOADS."";
include_secure("modules/$module_name/d_config.php");
define('INDEX_FILE', true);

// ALTERED BY PALADIN - 170102 - Start
function getparent($parentid,$title) {
    global $prefix, $db;
    $parentid = intval($parentid);
    $sql = "SELECT cid, title, parentid FROM ".$prefix."_downloads_categories WHERE cid='$parentid'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
  	$cid = intval($row[cid]);
  	$ptitle = filter($row[title], "nohtml");
  	$pparentid = intval($row[parentid]);
    if ($ptitle=="$title") $title=$title; 
    	elseif (!empty($ptitle)) $title=$ptitle."/".$title;
    if ($pparentid!=0) {
		$title=getparent($pparentid,$ptitle);
    }
    return $title;
}

function getparentlink($parentid,$title) {
    global $prefix, $db, $module_name;
    $parentid = intval($parentid);
    $sql = "SELECT cid, title, parentid FROM ".$prefix."_downloads_categories WHERE cid='$parentid'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $cid = intval($row['cid']);
  	$ptitle = filter($row['title'], "nohtml");
  	$pparentid = intval($row['parentid']);
    if (!empty($ptitle)) $title="<a href=modules.php?name=$module_name&amp;d_op=viewdownload&amp;cid=$cid>$ptitle</a>/".$title;
    if ($pparentid!=0) {
    	$title=getparentlink($pparentid,$ptitle);
    }
    return $title;
}
// ALTERED BY PALADIN - 170102 - End

function menu($maindownload) {
    global $prefix, $user_adddownload, $module_name, $query;
    OpenTable();
    $ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/down-logo.gif")) {
	echo "<br><center><a href=\"modules.php?name=$module_name\"><img src=\"themes/$ThemeSel/images/down-logo.gif\" border=\"0\" alt=\"\"></a><br><br>";
    } else {
	echo "<br><center><a href=\"modules.php?name=$module_name\"><img src=\"modules/$module_name/images/down-logo.gif\" border=\"0\" alt=\"\"></a><br><br>";
    }
    echo "<form action=\"modules.php?name=$module_name&amp;d_op=search&amp;query=$query\" method=\"post\">"
	."<font class=\"content\"><input type=\"text\" size=\"25\" name=\"query\"> <input type=\"submit\" value=\""._SEARCH."\"></font>"
	."</form>";
    echo "<font class=\"content\">[ ";
    if ($maindownload>0) {
	echo "<a href=\"modules.php?name=$module_name\">"._DOWNLOADSMAIN."</a> | ";
    }
    if ($user_adddownload == 1) {
	echo "<a href=\"modules.php?name=$module_name&amp;d_op=AddDownload\">"._ADDDOWNLOAD."</a>"
	    ." | ";
    }
    echo "<a href=\"modules.php?name=$module_name&amp;d_op=NewDownloads\">"._NEW."</a>"
	." | <a href=\"modules.php?name=$module_name&amp;d_op=MostPopular\">"._POPULAR."</a>"
	." | <a href=\"modules.php?name=$module_name&amp;d_op=TopRated\">"._TOPRATED."</a> ]"
	."</font></center>";
    CloseTable();
}

function SearchForm() {
    global $module_name;
    echo "<form action=\"modules.php?name=$module_name\" method=\"post\">"
	."<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">"
	."<tr><td><font class=\"content\"><input type=\"hidden\" name=\"d_op\" value=\"search\"><input type=\"text\" size=\"25\" name=\"query\"> <input type=\"submit\" value=\""._SEARCH."\"></td></tr>"
	."</table>"
	."</form>";
}

function downloadinfomenu($lid) {
    global $module_name, $user;
    echo "<br><font class=\"content\">[ "
	."<a href=\"modules.php?name=$module_name&amp;d_op=viewdownloadcomments&amp;lid=$lid\">"._DOWNLOADCOMMENTS."</a>"
	." | <a href=\"modules.php?name=$module_name&amp;d_op=viewdownloaddetails&amp;lid=$lid\">"._ADDITIONALDET."</a>"
	." | <a href=\"modules.php?name=$module_name&amp;d_op=viewdownloadeditorial&amp;lid=$lid\">"._EDITORREVIEW."</a>"
	." | <a href=\"modules.php?name=$module_name&amp;d_op=modifydownloadrequest&amp;lid=$lid\">"._MODIFY."</a>";
    if (is_user($user)) {
	echo " | <a href=\"modules.php?name=$module_name&amp;d_op=brokendownload&amp;lid=$lid\">"._REPORTBROKEN."</a>";
    }
    echo " ]</font>";
}

function index() {
    global $prefix, $db, $show_links_num, $module_name;
    include("header.php");
    $maindownload = 0;
    menu($maindownload);
    echo "<br>";
    OpenTable();
    echo "<center><font class=\"title\"><b>"._DOWNLOADSMAINCAT."</b></font></center><br>";
    echo "<table border=\"0\" cellspacing=\"10\" cellpadding=\"0\" align=\"center\"><tr>";
    $sql = "SELECT cid, title, cdescription FROM ".$prefix."_downloads_categories WHERE parentid='0' ORDER BY title";
    $result = $db->sql_query($sql);
    $count = 0;
    while ($row = $db->sql_fetchrow($result)) {
	$cid = intval($row['cid']);
	$title = filter($row['title'], "nohtml");
	$cdescription = filter($row['cdescription']);
	if ($show_links_num == 1) {
	    $cnumrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_downloads_downloads WHERE cid='$cid'"));
	    $cnumm = "($cnumrows)";
	} else {
	    $cnumm = "";
	}
	echo "<td><font class=\"option\"><strong><big>&middot;</big></strong> <a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;cid=$cid\"><b>$title</b></a>$cnumm</font>";
	categorynewdownloadgraphic($cid);
	if ($cdescription) {
	    echo "<br><font class=\"content\">$cdescription</font><br>";
	} else {
	    echo "<br>";
	}
	$sql2 = "SELECT cid, title FROM ".$prefix."_downloads_categories WHERE parentid='$cid' ORDER BY title LIMIT 0,3";
	$result2 = $db->sql_query($sql2);
	$space = 0;
    $cnum = "";
	while ($row2 = $db->sql_fetchrow($result2)) {
		$cid = intval($row2['cid']);
		$stitle = filter($row2['title'], "nohtml");
   	    if ($space>0) {
			echo ",&nbsp;";
	    }
        if ($show_links_num == 1) {
        	$cnumrows2 = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_downloads_downloads WHERE cid='$cid'"));
			$cnum = " ($cnumrows2)";
	    } else {
			$cnumrows2 = "";
	    }
	    echo "<font class=\"content\"><a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;cid=$cid\">$stitle</a>$cnum</font>";
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
    $numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_downloads_downloads"));
    $catnum = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_downloads_categories"));
    echo "<center><font class=\"content\">"._THEREARE." <b>$numrows</b> "._DOWNLOADS." "._AND." <b>$catnum</b> "._CATEGORIES." "._INDB."</font></center>";
    CloseTable();
    include("footer.php");
}

function AddDownload() {
    global $prefix, $db, $cookie, $user, $downloads_anonadddownloadlock, $module_name;
    include("header.php");
    $maindownload = 1;
    menu(1);
    echo "<br>";
    OpenTable();
    echo "<center><font class=\"title\"><b>"._ADDADOWNLOAD."</b></font></center><br>";
    if (is_user($user) || $downloads_anonadddownloadlock != 1) {
    	$message = "<b>"._INSTRUCTIONS.":</b><br>"
	    	."<strong><big>&middot;</big></strong> "._DSUBMITONCE."<br>"
	    	."<strong><big>&middot;</big></strong> "._DPOSTPENDING."<br>"
	    	."<strong><big>&middot;</big></strong> "._USERANDIP."<br>";
	    info_box("caution", $message);
	    echo "<br><br><table width=\"100%\" border=\"0\" cellspacing=\"3\">"
    		."<tr><td nowrap><form method=\"post\" action=\"modules.php?name=$module_name&amp;d_op=Add\">"
    	    ."<b>"._DOWNLOADNAME.":</b></td><td><input type=\"text\" name=\"title\" size=\"40\" maxlength=\"100\"></td></tr>"
    	    ."<tr><td nowrap><b>"._FILEURL.":</b></td><td><input type=\"text\" name=\"url\" size=\"40\" maxlength=\"100\" value=\"http://\"></td></tr>"
    		."<tr><td nowrap><b>"._CATEGORY.":</b></td><td><select name=\"cat\">";
    	$sql = "SELECT cid, title, parentid FROM ".$prefix."_downloads_categories ORDER BY parentid,title";
		$result = $db->sql_query($sql);
    	while ($row = $db->sql_fetchrow($result)) {
			$cid2 = intval($row['cid']);
			$ctitle2 = filter($row['title'], "nohtml");
			$parentid2 = intval($row['parentid']);
    	    if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
    	    echo "<option value=\"$cid2\">$ctitle2</option>";
    	}
    	echo "</select></td></tr>"
    	    ."<tr><td nowrap><b>"._DESCRIPTION.":</b></td><td><textarea name=\"description\" cols=\"60\" rows=\"10\"></textarea></td></tr>"
    	    ."<tr><td nowrap><b>"._AUTHORNAME.":</b></td><td><input type=\"text\" name=\"auth_name\" size=\"30\" maxlength=\"60\"></td></tr>"
    	    ."<tr><td nowrap><b>"._AUTHOREMAIL.":</b></td><td><input type=\"text\" name=\"email\" size=\"30\" maxlength=\"60\"></td></tr>"
	    	."<tr><td nowrap><b>"._FILESIZE.":</b></td><td><input type=\"text\" name=\"filesize\" size=\"12\" maxlength=\"11\"> ("._INBYTES.")</td></tr>"
	    	."<tr><td nowrap><b>"._VERSION.":</b></td><td><input type=\"text\" name=\"version\" size=\"11\" maxlength=\"10\"></td></tr>"
    	    ."<tr><td nowrap><b>"._HOMEPAGE.":</b></td><td><input type=\"text\" name=\"homepage\" size=\"40\" maxlength=\"200\" value=\"http://\"></td></tr>"
	    	."<tr><td>&nbsp;</td><td><input type=\"hidden\" name=\"d_op\" value=\"Add\">"
    	    ."<input type=\"submit\" value=\""._ADDTHISFILE."\"> "._GOBACK.""
    	    ."</form></td></tr></table>";
    } else {
    	echo "<center>"._DOWNLOADSNOTUSER1."<br>"
	    	.""._DOWNLOADSNOTUSER2."<br><br>"
    	    .""._DOWNLOADSNOTUSER3."<br>"
    	    .""._DOWNLOADSNOTUSER4."<br>"
    	    .""._DOWNLOADSNOTUSER5."<br>"
    	    .""._DOWNLOADSNOTUSER6."<br>"
    	    .""._DOWNLOADSNOTUSER7."<br><br>"
    	    .""._DOWNLOADSNOTUSER8."";
    }
    CloseTable();
    include("footer.php");
}

function Add($title, $url, $auth_name, $cat, $description, $email, $filesize, $version, $homepage) {
    global $prefix, $db, $user;
    $sql = "SELECT url FROM ".$prefix."_downloads_downloads WHERE url='$url'";
    $result = $db->sql_query($sql);
    $numrows = $db->sql_numrows($result);
    if ($numrows>0) {
	include("header.php");
	menu(1);
	echo "<br>";
	OpenTable();
	echo "<center><b>"._DOWNLOADALREADYEXT."</b><br><br>"
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
	echo "<center><b>"._DOWNLOADNOTITLE."</b><br><br>"
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
	echo "<center><b>"._DOWNLOADNOURL."</b><br><br>"
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
	echo "<center><b>"._DOWNLOADNODESC."</b><br><br>"
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
    if (!empty($email)) { 
    $email = validate_mail(filter($email, "nohtml", 1));
    }
    $filesize = ereg_replace("\.","",$filesize);
    $filesize = ereg_replace("\,","",$filesize);
    $cat[0] = intval($cat[0]);
    $cat[1] = intval($cat[1]);
    $num_new = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_downloads_newdownload WHERE title='$title' OR url='$url' OR description='$description'"));
    if ($num_new == 0) {
    $db->sql_query("INSERT INTO ".$prefix."_downloads_newdownload VALUES (NULL, '$cat[0]', '$cat[1]', '".addslashes($title)."', '".addslashes($url)."', '".addslashes($description)."', '".addslashes($auth_name)."', '".addslashes($email)."', '".addslashes($submitter)."', '".addslashes($filesize)."', '".addslashes($version)."', '".addslashes($homepage)."')");
    }
    include("header.php");
    menu(1);
    echo "<br>";
    OpenTable();
    echo "<center><b>"._DOWNLOADRECEIVED."</b><br>";
    if (empty($email)) {
	echo _CHECKFORIT;
    }
    CloseTable();
    include("footer.php");
    }
}

function NewDownloads($newdownloadshowdays) {
    global $prefix, $db, $module_name;
    include("header.php");
    $newdownloadshowdays = intval(trim($newdownloadshowdays));
    menu(1);
    echo "<br>";
    OpenTable();
    echo "<center><font class=\"option\"><b>"._NEWDOWNLOADS."</b></font></center><br>";
    $counter = 0;
    $allweekdownloads = 0;
    while ($counter <= 7-1){
	$newdownloaddayRaw = (time()-(86400 * $counter));
	$newdownloadday = date("d-M-Y", $newdownloaddayRaw);
	$newdownloadView = date("F d, Y", $newdownloaddayRaw);
	$newdownloadDB = Date("Y-m-d", $newdownloaddayRaw);
	$totaldownloads = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_downloads_downloads WHERE date LIKE '%$newdownloadDB%'"));
	$counter++;
	$allweekdownloads = $allweekdownloads + $totaldownloads;
    }
	$allmonthdownloads = 0;
    $counter = 0;
    while ($counter <=30-1){
        $newdownloaddayRaw = (time()-(86400 * $counter));
        $newdownloadDB = Date("Y-m-d", $newdownloaddayRaw);
        $totaldownloads = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_downloads_downloads WHERE date LIKE '%$newdownloadDB%'"));
        $allmonthdownloads = $allmonthdownloads + $totaldownloads;
        $counter++;
    }
    echo "<center><b>"._TOTALNEWDOWNLOADS.":</b> "._LASTWEEK." - $allweekdownloads \ "._LAST30DAYS." - $allmonthdownloads<br>"
	.""._SHOW.": <a href=\"modules.php?name=$module_name&amp;d_op=NewDownloads&amp;newdownloadshowdays=7\">"._1WEEK."</a> - <a href=\"modules.php?name=$module_name&amp;d_op=NewDownloads&amp;newdownloadshowdays=14\">"._2WEEKS."</a> - <a href=\"modules.php?name=$module_name&amp;d_op=NewDownloads&amp;newdownloadshowdays=30\">"._30DAYS."</a>"
	."</center><br>";
    /* List Last VARIABLE Days of Downloads */
    if (intval($newdownloadshowdays) <= 0) { $newdownloadshowdays = 7; }
    echo "<br><center><b>"._DTOTALFORLAST." $newdownloadshowdays "._DAYS.":</b><br><br>";
    $counter = 0;
    $allweekdownloads = 0;
    while ($counter <= $newdownloadshowdays-1) {
	$newdownloaddayRaw = (time()-(86400 * $counter));
	$newdownloadday = date("d-M-Y", $newdownloaddayRaw);
	$newdownloadView = date("F d, Y", $newdownloaddayRaw);
	$newdownloadDB = Date("Y-m-d", $newdownloaddayRaw);
	$totaldownloads = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_downloads_downloads WHERE date LIKE '%$newdownloadDB%'"));
	$counter++;
	$allweekdownloads = $allweekdownloads + $totaldownloads;
	echo "<strong><big>&middot;</big></strong> <a href=\"modules.php?name=$module_name&amp;d_op=NewDownloadsDate&amp;selectdate=$newdownloaddayRaw\">$newdownloadView</a>&nbsp;($totaldownloads)<br>";
    }
    $counter = 0;
    $allmonthdownloads = 0;
    echo "</center>";
    CloseTable();
    include("footer.php");
}

function NewDownloadsDate($selectdate) {
    global $prefix, $db, $module_name, $admin, $user, $admin_file, $datetime, $transfertitle, $locale;
    $dateDB = (date("d-M-Y", $selectdate));
    $dateView = (date("F d, Y", $selectdate));
    include("header.php");
    menu(1);
    echo "<br>";
    OpenTable();
    $newdownloadDB = Date("Y-m-d", $selectdate);
    $totaldownloads = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_downloads_downloads WHERE date LIKE '%$newdownloadDB%'"));
    echo "<font class=\"option\"><b>$dateView - $totaldownloads "._NEWDOWNLOADS."</b></font>"
	."<table width=\"100%\" cellspacing=\"0\" cellpadding=\"10\" border=\"0\"><tr><td><font class=\"content\">";
    $sql = "SELECT lid, cid, title, description, date, hits, downloadratingsummary, totalvotes, totalcomments, filesize, version, homepage FROM ".$prefix."_downloads_downloads WHERE date LIKE '%$newdownloadDB%' ORDER BY title ASC";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
	$lid = intval($row['lid']);
	$cid = intval($row['cid']);
	$title = filter($row['title'], "nohtml");
	$description = filter($row['description']);
	$time = $row['date'];
	$hits = intval($row['hits']);
	$downloadratingsummary = $row['downloadratingsummary'];
	$totalvotes = intval($row['totalvotes']);
	$totalcomments = intval($row['totalcomments']);
	$filesize = $row['filesize'];
	$version = $row['version'];
	$homepage = filter($row['homepage'], "nohtml");
	$downloadratingsummary = number_format($downloadratingsummary, $mainvotedecimal);
	if (is_admin($admin)) {
	    echo "<a href=\"".$admin_file.".php?op=DownloadsModDownload&amp;lid=$lid\"><img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\""._EDIT."\"></a>&nbsp;&nbsp;";
	} else {
	    echo "<img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\"\">&nbsp;&nbsp;";
	}
	echo "<a href=\"modules.php?name=$module_name&amp;d_op=getit&amp;lid=$lid\">$title</a>";
	newdownloadgraphic($datetime, $time);
	popgraphic($hits);
	detecteditorial($lid, $transfertitle, 1);
	echo "<br><b>"._DESCRIPTION.":</b> $description<br>";
	setlocale (LC_TIME, $locale);
	/* INSERT code for *editor review* here */
	ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $time, $datetime);
	$datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
	$datetime = ucfirst($datetime);
	echo "<b>"._VERSION.":</b> $version <b>"._FILESIZE.":</b> ".CoolSize($filesize)."<br>";
	echo "<b>"._ADDEDON.":</b> <b>$datetime</b> <b>"._UDOWNLOADS.":</b> $hits";
        $transfertitle = str_replace (" ", "_", $title);
        /* voting & comments stats */
        if ($totalvotes == 1) {
	    $votestring = _VOTE;
        } else {
	    $votestring = _VOTES;
	}
        if ($downloadratingsummary!="0" || $downloadratingsummary!="0.0") {
	    echo " <b>"._RATING.":</b> $downloadratingsummary ($totalvotes $votestring)";
	}
        if (empty($homepage)) {
	    echo "<br>";
	} else {
	    echo "<br><a href=\"$homepage\" target=\"new\">"._HOMEPAGE."</a> | ";
	}
	echo "<a href=\"modules.php?name=$module_name&amp;d_op=ratedownload&amp;lid=$lid\">"._RATERESOURCE."</a>";
        if (is_user($user)) {
	    echo " | <a href=\"modules.php?name=$module_name&amp;d_op=brokendownload&amp;lid=$lid\">"._REPORTBROKEN."</a>";
	}
	echo " | <a href=\"modules.php?name=$module_name&amp;d_op=viewdownloaddetails&amp;lid=$lid\">"._DETAILS."</a>";
        if ($totalcomments != 0) {
	    echo " | <a href=\"modules.php?name=$module_name&amp;d_op=viewdownloadcomments&amp;lid=$lid\">"._SCOMMENTS." ($totalcomments)</a>";
	}
	detecteditorial($lid, $transfertitle, 0);
	echo "<br>";
	$sql2 = "SELECT title FROM ".$prefix."_downloads_categories WHERE cid='$cid'";
	$result2 = $db->sql_query($sql2);
	$row2 = $db->sql_fetchrow($result2);
	$ctitle = filter($row2['title'], "nohtml");
	$ctitle = getparent($cid,$ctitle);
	echo ""._CATEGORY.": $ctitle";
	echo "<br><br>";
    }
    echo "</font></td></tr></table>";
    CloseTable();
    include("footer.php");
}

function TopRated($ratenum, $ratetype) {
    global $prefix, $db, $admin, $module_name, $user, $admin_file, $datetime, $transfertitle, $locale;
    include("header.php");
    include("modules/$module_name/d_config.php");
    menu(1);
    echo "<br>";
    OpenTable();
    echo "<table border=\"0\" width=\"100%\"><tr><td align=\"center\">";
	if (!empty($ratenum) && !empty($ratetype)) {
    	$ratenum = intval($ratenum); 
    	$ratetype = htmlentities($ratetype); 
    	$topdownloads = $ratenum;
    	if ($ratetype == "percent") {
	    $topdownloadspercentrigger = 1;
	}
    }
    if ($topdownloadspercentrigger == 1) {
    	$topdownloadspercent = $topdownloads;
    	$totalrateddownloads = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_downloads_downloads WHERE downloadratingsummary != '0'"));
    	$topdownloads = $topdownloads / 100;
    	$topdownloads = $totalrateddownloads * $topdownloads;
    	$topdownloads = round($topdownloads);
    }
    if ($topdownloadspercentrigger == 1) {
	echo "<center><font class=\"option\"><b>"._DBESTRATED." $topdownloadspercent% ("._OF." $totalrateddownloads "._TRATEDDOWNLOADS.")</b></font></center><br>";
    } else {
	echo "<center><font class=\"option\"><b>"._DBESTRATED." $topdownloads </b></font></center><br>";
    }
    echo "</td></tr>"
	."<tr><td><center>"._NOTE." $downloadvotemin "._TVOTESREQ."<br>"
	.""._SHOWTOP.":  [ <a href=\"modules.php?name=$module_name&amp;d_op=TopRated&amp;ratenum=10&amp;ratetype=num\">10</a> - "
	."<a href=\"modules.php?name=$module_name&amp;d_op=TopRated&amp;ratenum=25&amp;ratetype=num\">25</a> - "
    	."<a href=\"modules.php?name=$module_name&amp;d_op=TopRated&amp;ratenum=50&amp;ratetype=num\">50</a> | "
    	."<a href=\"modules.php?name=$module_name&amp;d_op=TopRated&amp;ratenum=1&amp;ratetype=percent\">1%</a> - "
    	."<a href=\"modules.php?name=$module_name&amp;d_op=TopRated&amp;ratenum=5&amp;ratetype=percent\">5%</a> - "
    	."<a href=\"modules.php?name=$module_name&amp;d_op=TopRated&amp;ratenum=10&amp;ratetype=percent\">10%</a> ]</center><br><br></td></tr>";
    $sql = "SELECT lid, cid, title, description, date, hits, downloadratingsummary, totalvotes, totalcomments, filesize, version, homepage FROM ".$prefix."_downloads_downloads WHERE downloadratingsummary != '0' AND totalvotes >= '$downloadvotemin' ORDER BY downloadratingsummary DESC LIMIT 0,$topdownloads";
    $result = $db->sql_query($sql);
    echo "<tr><td>";
    while ($row = $db->sql_fetchrow($result)) {
	$lid = intval($row['lid']);
	$cid = intval($row['cid']);
	$title = filter($row['title'], "nohtml");
	$description = filter($row['description']);
	$time = $row['date'];
	$hits = intval($row['hits']);
	$downloadratingsummary = $row['downloadratingsummary'];
	$totalvotes = intval($row['totalvotes']);
	$totalcomments = intval($row['totalcomments']);
	$filesize = $row['filesize'];
	$version = $row['version'];
	$homepage = filter($row['homepage'], "nohtml");
	$downloadratingsummary = number_format($downloadratingsummary, $mainvotedecimal);
	if (is_admin($admin)) {
	    echo "<a href=\"".$admin_file.".php?op=DownloadsModDownload&amp;lid=$lid\"><img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\""._EDIT."\"></a>&nbsp;&nbsp;";
	} else {
	    echo "<img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\"\">&nbsp;&nbsp;";
	}
        echo "<a href=\"modules.php?name=$module_name&amp;d_op=getit&amp;lid=$lid\">$title</a>";
	newdownloadgraphic($datetime, $time);
	popgraphic($hits);
	detecteditorial($lid, $transfertitle, 1);
	echo "<br>";
	echo "<b>"._DESCRIPTION.":</b> $description<br>";
	setlocale (LC_TIME, $locale);
	ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $time, $datetime);
	$datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
	$datetime = ucfirst($datetime);
	echo "<b>"._VERSION.":</b> $version <b>"._FILESIZE.":</b> ".CoolSize($filesize)."<br>";
	echo "<b>"._ADDEDON.":</b> $datetime <b>"._UDOWNLOADS.":</b> $hits";
	$transfertitle = str_replace (" ", "_", $title);
	/* voting & comments stats */
        if ($totalvotes == 1) {
	    $votestring = _VOTE;
        } else {
	    $votestring = _VOTES;
	}
	if ($downloadratingsummary!="0" || $downloadratingsummary!="0.0") {
	    echo " <b>"._RATING.":</b> <b>$downloadratingsummary</b> ($totalvotes $votestring)";
	}
        if (empty($homepage)) {
	    echo "<br>";
	} else {
	    echo "<br><a href=\"$homepage\" target=\"new\">"._HOMEPAGE."</a> | ";
	}
	echo "<a href=\"modules.php?name=$module_name&amp;d_op=ratedownload&amp;lid=$lid\">"._RATERESOURCE."</a>";
	if (is_user($user)) {
	    echo " | <a href=\"modules.php?name=$module_name&amp;d_op=brokendownload&amp;lid=$lid\">"._REPORTBROKEN."</a>";
	}
	echo " | <a href=\"modules.php?name=$module_name&amp;d_op=viewdownloaddetails&amp;lid=$lid\">"._DETAILS."</a>";
	if ($totalcomments != 0) {
	    echo " | <a href=\"modules.php?name=$module_name&amp;d_op=viewdownloadcomments&amp;lid=$lid\">"._SCOMMENTS." ($totalcomments)</a>";
	}
	detecteditorial($lid, $transfertitle, 0);
	echo "<br>";
	$sql2 = "SELECT title FROM ".$prefix."_downloads_categories WHERE cid='$cid'";
	$result2 = $db->sql_query($sql2);
	$row2 = $db->sql_fetchrow($result2);
	$ctitle = filter($row2['title'], "nohtml");
	$ctitle = getparent($cid,$ctitle);
	echo ""._CATEGORY.": $ctitle";
	echo "<br><br>";
    }
    echo "</font></td></tr></table>";
    CloseTable();
    include("footer.php");
}

function MostPopular($ratenum, $ratetype) {
    global $prefix, $db, $admin, $module_name, $user, $admin_file, $datetime, $transfertitle, $locale;
    include("header.php");
    include("modules/$module_name/d_config.php");
    menu(1);
    echo "<br>";
    OpenTable();
    echo "<table border=\"0\" width=\"100%\"><tr><td align=\"center\">";
   	if (!empty($ratenum) && !empty($ratetype)) {
    	$ratenum = intval($ratenum); 
    	$ratetype = htmlentities($ratetype); 
    	$mostpopdownloads = $ratenum;
    	if ($ratetype == "percent") $mostpopdownloadspercentrigger = 1;
    }
    if ($mostpopdownloadspercentrigger == 1) {
    	$topdownloadspercent = $mostpopdownloads;
    	$result = $db->sql_query("SELECT * FROM ".$prefix."_downloads_downloads");
    	$totalmostpopdownloads = $db->sql_numrows($result);
    	$mostpopdownloads = $mostpopdownloads / 100;
    	$mostpopdownloads = $totalmostpopdownloads * $mostpopdownloads;
    	$mostpopdownloads = round($mostpopdownloads);
    }    
    if ($mostpopdownloadspercentrigger == 1) {
	echo "<center><font class=\"option\"><b>"._MOSTPOPULAR." $topdownloadspercent% ("._OFALL." $totalmostpopdownloads "._DOWNLOADS.")</b></font></center>";
    } else {
	echo "<center><font class=\"option\"><b>"._MOSTPOPULAR." $mostpopdownloads</b></font></center>";
    }
    echo "<tr><td><center>"._SHOWTOP.": [ <a href=\"modules.php?name=$module_name&amp;d_op=MostPopular&amp;ratenum=10&amp;ratetype=num\">10</a> - "
	."<a href=\"modules.php?name=$module_name&amp;d_op=MostPopular&amp;ratenum=25&amp;ratetype=num\">25</a> - "
    	."<a href=\"modules.php?name=$module_name&amp;d_op=MostPopular&amp;ratenum=50&amp;ratetype=num\">50</a> | "
    	."<a href=\"modules.php?name=$module_name&amp;d_op=MostPopular&amp;ratenum=1&amp;ratetype=percent\">1%</a> - "
    	."<a href=\"modules.php?name=$module_name&amp;d_op=MostPopular&amp;ratenum=5&amp;ratetype=percent\">5%</a> - "
    	."<a href=\"modules.php?name=$module_name&amp;d_op=MostPopular&amp;ratenum=10&amp;ratetype=percent\">10%</a> ]</center><br><br></td></tr>";
    $result = $db->sql_query("SELECT lid, cid, title, description, date, hits, downloadratingsummary, totalvotes, totalcomments, filesize, version, homepage FROM ".$prefix."_downloads_downloads order by hits DESC limit 0,$mostpopdownloads ");
    echo "<tr><td>";
    while(list($lid, $cid, $title, $description, $time, $hits, $downloadratingsummary, $totalvotes, $totalcomments, $filesize, $version, $homepage) = $db->sql_fetchrow($result)) {
	$lid = intval($lid);
	$cid = intval($cid);
	$downloadratingsummary = number_format($downloadratingsummary, $mainvotedecimal);
	$hits = intval($hits);
	$title = filter($title, "nohtml");
	$totalvotes = intval($totalvotes);
	$totalcomments = intval($totalcomments);
	$description = filter($description);
        global $prefix, $db, $admin;
	if (is_admin($admin)) {
	    echo "<a href=\"".$admin_file.".php?op=DownloadsModDownload&amp;lid=$lid\"><img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\""._EDIT."\"></a>&nbsp;&nbsp;";
	} else {
	    echo "<img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\"\">&nbsp;&nbsp;";
	}
        echo "<font class=\"content\"><a href=\"modules.php?name=$module_name&amp;d_op=getit&amp;lid=$lid\">$title</a>";
	newdownloadgraphic($datetime, $time);
	popgraphic($hits);
	detecteditorial($lid, $transfertitle, 1);
	echo "<br>";
	echo "<b>"._DESCRIPTION.":</b> $description<br>";
	setlocale (LC_TIME, $locale);
	ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $time, $datetime);
	$datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
	$datetime = ucfirst($datetime);
	echo "<b>"._VERSION.":</b> $version <b>"._FILESIZE.":</b> ".CoolSize($filesize)."<br>";
	echo "<b>"._ADDEDON.":</b> $datetime <b>"._UDOWNLOADS.":</b> <b>$hits</b>";
	$transfertitle = str_replace (" ", "_", $title);
	/* voting & comments stats */
        if ($totalvotes == 1) {
	    $votestring = _VOTE;
        } else {
	    $votestring = _VOTES;
	}
	if ($downloadratingsummary!="0" || $downloadratingsummary!="0.0") {
	    echo " <b>"._RATING.":</b> $downloadratingsummary ($totalvotes $votestring)";
	}
        if (empty($homepage)) {
	    echo "<br>";
	} else {
	    echo "<br><a href=\"$homepage\" target=\"new\">"._HOMEPAGE."</a> | ";
	}
	echo "<a href=\"modules.php?name=$module_name&amp;d_op=ratedownload&amp;lid=$lid\">"._RATERESOURCE."</a>";
	if (is_user($user)) {
	    echo " | <a href=\"modules.php?name=$module_name&amp;d_op=brokendownload&amp;lid=$lid\">"._REPORTBROKEN."</a>";
	}
	echo " | <a href=\"modules.php?name=$module_name&amp;d_op=viewdownloaddetails&amp;lid=$lid\">"._DETAILS."</a>";
	if ($totalcomments != 0) {
	    echo " | <a href=\"modules.php?name=$module_name&amp;d_op=viewdownloadcomments&amp;lid=$lid\">"._SCOMMENTS." ($totalcomments)</a>";
	}
	detecteditorial($lid, $transfertitle, 0);
	echo "<br>";
	$result2 = $db->sql_query("SELECT title FROM ".$prefix."_downloads_categories WHERE cid='$cid'");
	list($ctitle) = $db->sql_fetchrow($result2);
	$ctitle = filter($ctitle, "nohtml");
	$ctitle = getparent($cid,$ctitle);
	echo ""._CATEGORY.": $ctitle";
	echo "<br><br>";
    }
    echo "</font></td></tr></table>";
    CloseTable();
    include("footer.php");
}

function viewdownload($cid, $min, $orderby, $show) {
    global $prefix, $db, $admin, $perpage, $module_name, $user, $admin_file, $mainvotedecimal, $datetime, $transfertitle, $locale;
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
    $result = $db->sql_query("SELECT title,parentid FROM ".$prefix."_downloads_categories WHERE cid='$cid'");
	list($title,$parentid)=$db->sql_fetchrow($result);
	$title = filter($title, "nohtml");
	$parentid = intval($parentid);
	$title=getparentlink($parentid,$title);
	$title="<a href=modules.php?name=$module_name>"._MAIN."</a>/$title";
    echo "<center><font class=\"option\"><b>"._CATEGORY.": $title</b></font></center><br>";
    echo "<table border=\"0\" cellspacing=\"10\" cellpadding=\"0\" align=\"center\"><tr>";
    $cid = intval($cid);
    $result2 = $db->sql_query("SELECT cid, title, cdescription FROM ".$prefix."_downloads_categories WHERE parentid='$cid' order by title");
	$dum = 0;
    $count = 0;
    while(list($cid2, $title2, $cdescription2) = $db->sql_fetchrow($result2)) {
    	$cid2 = intval($cid2);
    	$title2 = filter($title2, "nohtml");
    	$cdescription2 = filter($cdescription2);
    	$cresult = $db->sql_query("SELECT * FROM ".$prefix."_downloads_downloads WHERE cid='$cid2'");
        $cnumrows = $db->sql_numrows($cresult);
		echo "<td><font class=\"option\"><strong><big>&middot;</big></strong> <a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;cid=$cid2\"><b>$title2</b></a></font> ($cnumrows)";
		categorynewdownloadgraphic($cid2);
		if ($cdescription2) {
	    	echo "<font class=\"content\">$cdescription2</font><br>";
		} else {
	    	echo "<br>";
		}
		$result3 = $db->sql_query("SELECT cid, title FROM ".$prefix."_downloads_categories WHERE parentid='$cid2' order by title limit 0,3");
		$space = 0;
		while(list($cid3, $title3) = $db->sql_fetchrow($result3)) {
            $cid3 = intval($cid3);
            $title3 = filter($title3, "nohtml");
    	    if ($space>0) {
				echo ",&nbsp;";
	    	}
            $cresult2 = $db->sql_query("SELECT * FROM ".$prefix."_downloads_downloads WHERE cid='$cid3'");
            $cnumrows2 = $db->sql_numrows($cresult2);
	    	echo "<font class=\"content\"><a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;cid=$cid3\">$title3</a> ($cnumrows2)</font>";
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
    echo "<center><font class=\"content\">"._SORTDOWNLOADSBY.": "
        .""._TITLE." (<a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;cid=$cid&amp;orderby=titleA\">A</a>\<a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;cid=$cid&amp;orderby=titleD\">D</a>) "
        .""._DATE." (<a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;cid=$cid&amp;orderby=dateA\">A</a>\<a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;cid=$cid&amp;orderby=dateD\">D</a>) "
        .""._RATING." (<a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;cid=$cid&amp;orderby=ratingA\">A</a>\<a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;cid=$cid&amp;orderby=ratingD\">D</a>) "
        .""._POPULARITY." (<a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;cid=$cid&amp;orderby=hitsA\">A</a>\<a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;cid=$cid&amp;orderby=hitsD\">D</a>)"
	."<br><b>"._RESSORTED.": $orderbyTrans</b></font></center><br><br>";
    $result=$db->sql_query("SELECT lid, title, description, date, hits, downloadratingsummary, totalvotes, totalcomments, filesize, version, homepage FROM ".$prefix."_downloads_downloads WHERE cid='$cid' order by $orderby limit $min,$perpage ");
    $fullcountresult=$db->sql_query("SELECT lid, title, description, date, hits, downloadratingsummary, totalvotes, totalcomments FROM ".$prefix."_downloads_downloads WHERE cid='$cid'");
    $totalselecteddownloads = $db->sql_numrows($fullcountresult);
    echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"10\" border=\"0\"><tr><td><font class=\"content\">";
    $x=0;
    while(list($lid, $title, $description, $time, $hits, $downloadratingsummary, $totalvotes, $totalcomments, $filesize, $version, $homepage)=$db->sql_fetchrow($result)) {
        $lid = intval($lid);
        $hits = intval($hits);
        $totalvotes = intval($totalvotes);
        $totalcomments = intval($totalcomments);
	$downloadratingsummary = number_format($downloadratingsummary, $mainvotedecimal);
	$title = filter($title, "nohtml");
	$description = filter($description);
        global $prefix, $db, $admin;
	if (is_admin($admin)) {
	    echo "<a href=\"".$admin_file.".php?op=DownloadsModDownload&amp;lid=$lid\"><img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\""._EDIT."\"></a>&nbsp;&nbsp;";
	} else {
	    echo "<img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\"\">&nbsp;&nbsp;";
	}
        echo "<a href=\"modules.php?name=$module_name&amp;d_op=getit&amp;lid=$lid\">$title</a>";
	newdownloadgraphic($datetime, $time);
	popgraphic($hits);
	/* INSERT code for *editor review* here */
	detecteditorial($lid, $transfertitle, 1);
	echo "<br>";
	echo "<b>"._DESCRIPTION.":</b> $description<br>";
	setlocale (LC_TIME, $locale);
	ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $time, $datetime);
	$datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
	$datetime = ucfirst($datetime);
	echo "<b>"._VERSION.":</b> $version <b>"._FILESIZE.":</b> ".CoolSize($filesize)."<br>";
	echo "<b>"._ADDEDON.":</b> $datetime <b>"._UDOWNLOADS.":</b> $hits";
        $transfertitle = str_replace (" ", "_", $title);
        /* voting & comments stats */
        if ($totalvotes == 1) {
	    $votestring = _VOTE;
        } else {
	    $votestring = _VOTES;
	}
        if ($downloadratingsummary!="0" || $downloadratingsummary!="0.0") {
	    echo " <b>"._RATING.":</b> $downloadratingsummary ($totalvotes $votestring)";
	}
        if (empty($homepage)) {
	    echo "<br>";
	} else {
	    echo "<br><a href=\"$homepage\" target=\"new\">"._HOMEPAGE."</a> | ";
	}
	echo "<a href=\"modules.php?name=$module_name&amp;d_op=ratedownload&amp;lid=$lid\">"._RATERESOURCE."</a>";
        if (is_user($user)) {
	    echo " | <a href=\"modules.php?name=$module_name&amp;d_op=brokendownload&amp;lid=$lid\">"._REPORTBROKEN."</a>";
	}
	echo " | <a href=\"modules.php?name=$module_name&amp;d_op=viewdownloaddetails&amp;lid=$lid\">"._DETAILS."</a>";
        if ($totalcomments != 0) {
	    echo " | <a href=\"modules.php?name=$module_name&amp;d_op=viewdownloadcomments&amp;lid=$lid\">"._SCOMMENTS." ($totalcomments)</a>";
	}
        detecteditorial($lid, $transfertitle, 0);
        echo "<br><br>";
	$x++;
    }
    echo "</font>";
    $orderby = convertorderbyout($orderby);
    /* Calculates how many pages exist. Which page one should be on, etc... */
    $downloadpagesint = ($totalselecteddownloads / $perpage);
    $downloadpageremainder = ($totalselecteddownloads % $perpage);
    if ($downloadpageremainder != 0) {
            $downloadpages = ceil($downloadpagesint);
    	if ($totalselecteddownloads < $perpage) {
    		$downloadpageremainder = 0;
    	}
    } else {
    	$downloadpages = $downloadpagesint;
    }
    /* Page Numbering */
    if ($downloadpages!=1 && $downloadpages!=0) {
        echo "<br><br>";
      	echo ""._SELECTPAGE.": ";
     	$prev=$min-$perpage;
     	if ($prev>=0) {
    	    echo "&nbsp;&nbsp;<b>[ <a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;cid=$cid&amp;min=$prev&amp;orderby=$orderby&amp;show=$show\">";
    	    echo " &lt;&lt; "._PREVIOUS."</a> ]</b> ";
          }
    	$counter = 1;
 	$currentpage = ($max / $perpage);
       	while ($counter<=$downloadpages ) {
      	    $cpage = $counter;
      	    $mintemp = ($perpage * $counter) - $perpage;
      	    if ($counter == $currentpage) {
		echo "<b>$counter</b>&nbsp;";
	    } else {
		echo "<a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;cid=$cid&amp;min=$mintemp&amp;orderby=$orderby&amp;show=$show\">$counter</a> ";
	    }
       	    $counter++;
               }
     	$next=$min+$perpage;
     	if ($x>=$perpage) {
    		echo "&nbsp;&nbsp;<b>[ <a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;cid=$cid&amp;min=$max&amp;orderby=$orderby&amp;show=$show\">";
    		echo " "._NEXT." &gt;&gt;</a> ]</b> ";
     	}
    }
    echo "</td></tr></table>";
    CloseTable();
    include("footer.php");
}

function viewsdownload($sid, $min, $orderby, $show) {
    global $prefix, $db, $admin, $module_name, $user, $admin_file, $datetime, $transfertitle, $locale;
    include("modules/$module_name/d_config.php");
    include("header.php");
    $sid = intval($sid);
    menu(1);
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
    echo "<br>";
    OpenTable();
    $cid = intval(trim($cid));
    $result = $db->sql_query("SELECT title,parentid FROM ".$prefix."_downloads_categories WHERE cid='$cid'");
	list($title,$parentid)=$db->sql_fetchrow($result);
	$title = filter($title, "nohtml");
	$parentid = intval($parentid);
	$title=getparentlink($parentid,$title);
	$title="<a href=modules.php?name=$module_name>"._MAIN."</a>/$title";
    echo "<center><font class=\"option\"><b>"._CATEGORY.": $title</b></font></center><br>";
    echo "<table border=\"0\" cellspacing=\"10\" cellpadding=\"0\" align=\"center\"><tr>";
    $result2 = $db->sql_query("SELECT cid, title, cdescription FROM ".$prefix."_downloads_categories WHERE parentid='$cid' order by title");
    $count = 0;
    while(list($cid2, $title2, $cdescription2) = $db->sql_fetchrow($result2)) {
        $cid2 = intval($cid2);
        $title = filter($title, "nohtml");
        $cdescription = filter($cdescription);
		echo "<td><font class=\"option\"><strong><big>&middot;</big></strong> <a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;cid=$cid2\"><b>$title2</b></a></font>";
		categorynewdownloadgraphic($cid2);
		if ($cdescription2) {
	    	echo "<font class=\"content\">$cdescription2</font><br>";
		} else {
	    	echo "<br>";
		}
		$result3 = $db->sql_query("SELECT cid, title FROM ".$prefix."_downloads_categories WHERE parentid='$cid2' order by title limit 0,3");
		$space = 0;
		while(list($cid3, $title3) = $db->sql_fetchrow($result3)) {
            $cid3 = intval($cid3);
            $title3 = filter($title3, "nohtml");
    	    if ($space>0) {
				echo ",&nbsp;";
	    	}
	    	echo "<font class=\"content\"><a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;cid=$cid3\">$title3</a></font>";
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
    echo "<br><center><font class=\"content\">"._SORTDOWNLOADSBY.": "
		.""._TITLE." (<a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;sid=$sid&amp;orderby=titleA\">A</a>\<a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;sid=$sid&amp;orderby=titleD\">D</a>)"
		." "._DATE." (<a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;sid=$sid&amp;orderby=dateA\">A</a>\<a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;sid=$sid&amp;orderby=dateD\">D</a>)"
		." "._RATING." (<a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;sid=$sid&amp;orderby=ratingA\">A</a>\<a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;sid=$sid&amp;orderby=ratingD\">D</a>)"
        ." "._POPULARITY." (<a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;sid=$sid&amp;orderby=hitsA\">A</a>\<a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;sid=$sid&amp;orderby=hitsD\">D</a>)"
		."<br><b>"._RESSORTED.": $orderbyTrans</b></font></center><br><br>";
    if(!is_numeric($min)){
    $min=0;
    }
    $result=$db->sql_query("SELECT lid, url, title, description, date, hits, downloadratingsummary, totalvotes, totalcomments, filesize, version, homepage FROM ".$prefix."_downloads_downloads WHERE sid='$sid' order by $orderby limit $min,$perpage");
    $fullcountresult=$db->sql_query("SELECT lid, title, description, date, hits, downloadratingsummary, totalvotes, totalcomments FROM ".$prefix."_downloads_downloads WHERE sid='$sid'");
    $totalselecteddownloads = $db->sql_numrows($fullcountresult);
    echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"10\" border=\"0\"><tr><td><font class=\"content\">";
    $x=0;
    while(list($lid, $url, $title, $description, $time, $hits, $downloadratingsummary, $totalvotes, $totalcomments, $filesize, $version, $homepage)=$db->sql_fetchrow($result)) {
        $lid = intval($lid);
        $hits = intval($hits);
        $totalvotes = intval($totalvotes);
        $totalcomments = intval($totalcomments);
		$downloadratingsummary = number_format($downloadratingsummary, $mainvotedecimal);
		$title = filter($title, "nohtml");
        $description = filter($description);
        global $prefix, $db, $admin;
	if (is_admin($admin)) {
	    echo "<a href=\"".$admin_file.".php?op=DownloadsModDownload&amp;lid=$lid\"><img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\""._EDIT."\"></a>&nbsp;&nbsp;";
	} else {
	    echo "<img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\"\">&nbsp;&nbsp;";
	}
        echo "<a href=\"modules.php?name=$module_name&amp;d_op=getit&amp;lid=$lid\">$title</a>";
	newdownloadgraphic($datetime, $time);
	popgraphic($hits);
        /* code for *editor review* insert here	*/
	detecteditorial($lid, $transfertitle, 1);
	echo "<br><b>"._DESCRIPTION.":</b> $description<br>";
	setlocale (LC_TIME, $locale);
	ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $time, $datetime);
	$datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
	$datetime = ucfirst($datetime);
	echo "<b>"._VERSION.":</b> $version <b>"._FILESIZE.":</b> ".CoolSize($filesize)."<br>";
	echo "<b>"._ADDEDON.":</b> $datetime <b>"._UDOWNLOADS.":</b> $hits";
        $transfertitle = str_replace (" ", "_", $title);
        /* voting & comments stats */
        if ($totalvotes == 1) {
	    $votestring = _VOTE;
	} else {
	    $votestring = _VOTES;
	}
        if ($downloadratingsummary!="0" || $downloadratingsummary!="0.0") {
	    echo " <b>"._RATING.":</b> $downloadratingsummary ($totalvotes $votestring)";
        }
        if (empty($homepage)) {
	    echo "<br>";
	} else {
	    echo "<br><a href=\"$homepage\" target=\"new\">"._HOMEPAGE."</a> | ";
	}
	echo "<a href=\"modules.php?name=$module_name&amp;d_op=ratedownload&amp;lid=$lid\">"._RATERESOURCE."</a>";
	if (is_user($user)) {
	    echo " | <a href=\"modules.php?name=$module_name&amp;d_op=brokendownload&amp;lid=$lid\">"._REPORTBROKEN."</a>";
	}
	echo " | <a href=\"modules.php?name=$module_name&amp;d_op=viewdownloaddetails&amp;lid=$lid\">"._DETAILS."</a>";
        if ($totalcomments != 0) {
	    echo " | <a href=\"modules.php?name=$module_name&amp;d_op=viewdownloadcomments&amp;lid=$lid\">"._SCOMMENTS." ($totalcomments)</a>";
	}
	detecteditorial($lid, $transfertitle, 0);
	echo "<br><br>";
	$x++;
    }
    echo "</font>";
    $orderby = convertorderbyout($orderby);
    /* Calculates how many pages exist.  Which page one should be on, etc... */
    $downloadpagesint = ($totalselecteddownloads / $perpage);
    $downloadpageremainder = ($totalselecteddownloads % $perpage);
    if ($downloadpageremainder != 0) {
        $downloadpages = ceil($downloadpagesint);
        if ($totalselecteddownloads < $perpage) {
    	    $downloadpageremainder = 0;
        }
    } else {
    	$downloadpages = $downloadpagesint;
    }        
    /* Page Numbering */
    if ($downloadpages!=1 && $downloadpages!=0) {
	echo "<br><br>"
    	    .""._SELECTPAGE.": ";
        $prev=$min-$perpage;
        if ($prev>=0) {
    	    echo "&nbsp;&nbsp;<b>[ <a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;sid=$sid&amp;min=$prev&amp;orderby=$orderby&amp;show=$show\">"
    		." &lt;&lt; "._PREVIOUS."</a> ]</b> ";
      	}
        $counter = 1;
        $currentpage = ($max / $perpage);
        while ($counter<=$downloadpages ) {
    	    $cpage = $counter;
            $mintemp = ($perpage * $counter) - $perpage;
            if ($counter == $currentpage) {
		echo "<b>$counter</b>&nbsp;";
	    } else {
		echo "<a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;sid=$sid&amp;min=$mintemp&amp;orderby=$orderby&amp;show=$show\">$counter</a> ";
	    }
            $counter++; 	
        }    	
        $next=$min+$perpage;
        if ($x>=$perpage) {
    	    echo "&nbsp;&nbsp;<b>[ <a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;sid=$sid&amp;min=$max&amp;orderby=$orderby&amp;show=$show\">"
    		." "._NEXT." &gt;&gt;</a> ]</b> ";
        }
    }
    echo "</td></tr></table>";
    CloseTable();
    include("footer.php");
}

function newdownloadgraphic($datetime, $time) {
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
		echo "<img src=\"modules/$module_name/images/new_1.gif\" alt=\""._NEWTODAY."\">";
	    }
            if ($count<=3 && $count>1) {
		echo "<img src=\"modules/$module_name/images/new_3.gif\" alt=\""._NEWLAST3DAYS."\">";
	    }
            if ($count<=7 && $count>3) {
		echo "<img src=\"modules/$module_name/images/new_7.gif\" alt=\""._NEWTHISWEEK."\">";
	    }
	}
        $count++;
        $startdate = (time()-(86400 * $count));
    }
}

function categorynewdownloadgraphic($cat) {
    global $prefix, $db, $module_name, $datetime, $locale;
    $cat = intval(trim($cat));
    $newresult = $db->sql_query("SELECT date FROM ".$prefix."_downloads_downloads WHERE cid='$cat' order by date desc limit 1");
    list($time)=$db->sql_fetchrow($newresult);
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
		echo "<img src=\"modules/$module_name/images/new_1.gif\" alt=\""._DCATNEWTODAY."\">";
	    }
            if ($count<=3 && $count>1) {
		echo "<img src=\"modules/$module_name/images/new_3.gif\" alt=\""._DCATLAST3DAYS."\">";
	    }
            if ($count<=7 && $count>3) {
		echo "<img src=\"modules/$module_name/images/new_7.gif\" alt=\""._DCATTHISWEEK."\">";
	    }
	}
        $count++;
        $startdate = (time()-(86400 * $count));
    }
}

function popgraphic($hits) {
    global $module_name;
    include("modules/$module_name/d_config.php");
    if ($hits>=$popular) {
	echo "&nbsp;<img src=\"modules/$module_name/images/popular.gif\" alt=\""._POPULAR."\">";
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
    if ($orderby == "ratingA")	$orderby = "downloadratingsummary ASC";
    if ($orderby == "titleD")	$orderby = "title DESC"; 
    if ($orderby == "dateD")	$orderby = "date DESC";
    if ($orderby == "hitsD")	$orderby = "hits DESC";
    if ($orderby == "ratingD")	$orderby = "downloadratingsummary DESC";
    return $orderby;
}

function convertorderbytrans($orderby) {
	if ($orderby != "hits ASC" AND $orderby != "hits DESC" AND $orderby != "title ASC" AND $orderby != "title DESC" AND $orderby != "date ASC" AND $orderby != "date DESC" AND $orderby != "downloadratingsummary ASC" AND $orderby != "downloadratingsummary DESC") {
	    Header("Location: index.php");
	    die();
	}
    if ($orderby == "hits ASC")			$orderbyTrans = ""._POPULARITY1."";
    if ($orderby == "hits DESC")		$orderbyTrans = ""._POPULARITY2."";
    if ($orderby == "title ASC")		$orderbyTrans = ""._TITLEAZ."";
    if ($orderby == "title DESC")		$orderbyTrans = ""._TITLEZA."";
    if ($orderby == "date ASC")			$orderbyTrans = ""._DDATE1."";
    if ($orderby == "date DESC")		$orderbyTrans = ""._DDATE2."";
    if ($orderby == "downloadratingsummary ASC")	$orderbyTrans = ""._RATING1."";
    if ($orderby == "downloadratingsummary DESC")	$orderbyTrans = ""._RATING2."";
    return $orderbyTrans;
}

function convertorderbyout($orderby) {
	if ($orderby != "title ASC" AND $orderby != "date ASC" AND $orderby != "hits ASC" AND $orderby != "downloadratingsummary ASC" AND $orderby != "title DESC" AND $orderby != "date DESC" AND $orderby != "hits DESC" AND $orderby != "downloadratingsummary DESC") {
	    Header("Location: index.php");
	    die();
	}
    if ($orderby == "title ASC")		$orderby = "titleA";
    if ($orderby == "date ASC")			$orderby = "dateA";
    if ($orderby == "hits ASC")			$orderby = "hitsA";
    if ($orderby == "downloadratingsummary ASC")	$orderby = "ratingA";
    if ($orderby == "title DESC")		$orderby = "titleD";
    if ($orderby == "date DESC")		$orderby = "dateD";
    if ($orderby == "hits DESC")		$orderby = "hitsD";
    if ($orderby == "downloadratingsummary DESC")	$orderby = "ratingD";
    return $orderby;
}

function getit($lid) {
    global $prefix, $db;
    $lid = intval($lid);
    $db->sql_query("update ".$prefix."_downloads_downloads set hits=hits+1 WHERE lid='$lid'");
    update_points(17);
    $result = $db->sql_query("SELECT url FROM ".$prefix."_downloads_downloads WHERE lid='$lid'");
    list($url) = $db->sql_fetchrow($result);
    Header("Location: $url");
}

function search($query, $min, $orderby, $show) {
    global $prefix, $db, $admin, $bgcolor2, $module_name, $admin_file, $datetime, $transfertitle, $locale;
    include("modules/$module_name/d_config.php");
    include("header.php");
    if (!isset($min)) $min=0;
    if (!isset($max)) $max=$min+$downloadsresults;
    if(!empty($orderby)) {
	$orderby = convertorderbyin($orderby);
    } else {
	$orderby = "title ASC";
    }
    if ($show!="") {
	$downloadsresults = $show;
    } else {
	$show=$downloadsresults;     
    }
    $query1 = filter($query, "nohtml", 1);
    $query1 = addslashes($query1);
	$query2 = filter($query, "", 1);
    if(!is_numeric($min)){
    $min=0;
    }
    $result = $db->sql_query("SELECT lid, cid, title, url, description, date, hits, downloadratingsummary, totalvotes, totalcomments, filesize, version, homepage FROM ".$prefix."_downloads_downloads WHERE title LIKE '%$query1%' OR description LIKE '%$query2%' ORDER BY $orderby LIMIT $min,$downloadsresults");
    $fullcountresult = $db->sql_query("SELECT lid, title, description, date, hits, downloadratingsummary, totalvotes, totalcomments FROM ".$prefix."_downloads_downloads WHERE title LIKE '%$query1%' OR description LIKE '%$query2%' ");
    $totalselecteddownloads = $db->sql_numrows($fullcountresult);
    $nrows = $db->sql_numrows($result);
    $x=0;
    $the_query = filter($query, "nohtml");
    $the_query = FixQuotes($the_query);
    menu(1);
    echo "<br>";
    OpenTable();
    if (!empty($query)) {
    	if ($nrows>0) {
	    echo "<font class=\"option\">"._SEARCHRESULTS4.": <b>$the_query</b></font><br><br>"
	        ."<table width=\"100%\" bgcolor=\"$bgcolor2\"><tr><td><font class=\"option\"><b>"._USUBCATEGORIES."</b></font></td></tr></table>";
    	    $result2 = $db->sql_query("SELECT cid, title FROM ".$prefix."_downloads_categories WHERE title LIKE '%$query1%' ORDER BY title DESC");
	    while(list($cid, $stitle) = $db->sql_fetchrow($result2)) {
    	    $cid = intval($cid);
	        $res = $db->sql_query("SELECT * FROM ".$prefix."_downloads_downloads WHERE cid='$cid'");
	        $numrows = $db->sql_numrows($res);
    	        $result3 = $db->sql_query("SELECT cid,title,parentid FROM ".$prefix."_downloads_categories WHERE cid='$cid'");
    	        list($cid3,$title3,$parentid3) = $db->sql_fetchrow($result3);
    	        $cid3 = intval($cid3);
    	        $title3 = filter($title3, "nohtml");
    	        $parentid3 = intval($parentid3);
    	        if ($parentid3>0) $title3 = getparent($parentid3,$title3);
    	        $title3 = ereg_replace($query, "<b>$query</b>", $title3);
    	        echo "<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=$module_name&amp;d_op=viewdownload&amp;cid=$cid\">$title3</a> ($numrows)<br>";
	    }
	    echo "<br><table width=\"100%\" bgcolor=\"$bgcolor2\"><tr><td><font class=\"option\"><b>"._UDOWNLOADS."</b></font></td></tr></table>";
    	    $orderbyTrans = convertorderbytrans($orderby);
    	    echo "<center><font class=\"content\">"._SORTDOWNLOADSBY.": "
    		.""._TITLE." (<a href=\"modules.php?name=$module_name&amp;d_op=search&amp;query=$the_query&amp;orderby=titleA\">A</a>\<a href=\"modules.php?name=$module_name&amp;d_op=search&amp;query=$the_query&amp;orderby=titleD\">D</a>) "
    		.""._DATE." (<a href=\"modules.php?name=$module_name&amp;d_op=search&amp;query=$the_query&amp;orderby=dateA\">A</a>\<a href=\"modules.php?name=$module_name&amp;d_op=search&amp;query=$the_query&amp;orderby=dateD\">D</a>) "
    		.""._RATING." (<a href=\"modules.php?name=$module_name&amp;d_op=search&amp;query=$the_query&amp;orderby=ratingA\">A</a>\<a href=\"modules.php?name=$module_name&amp;d_op=search&amp;query=$the_query&amp;orderby=ratingD\">D</a>) "
    		.""._POPULARITY." (<a href=\"modules.php?name=$module_name&amp;d_op=search&amp;query=$the_query&amp;orderby=hitsA\">A</a>\<a href=\"modules.php?name=$module_name&amp;d_op=search&amp;query=$the_query&amp;orderby=hitsD\">D</a>)"
    		."<br>"._RESSORTED.": $orderbyTrans</center><br><br><br>";
	    while(list($lid, $cid, $title, $url, $description, $time, $hits, $downloadratingsummary, $totalvotes, $totalcomments, $filesize, $version, $homepage) = $db->sql_fetchrow($result)) {
            $lid = intval($lid);
            $cid = intval(trim($cid));
            $hits = intval($hits);
            $totalvotes = intval($totalvotes);
                $totalcomments=0;
            $totalcomments = intval($totalcomments);
			$downloadratingsummary = number_format($downloadratingsummary, $mainvotedecimal);
			$title = filter($title, "nohtml");
			$url = filter($url, "nohtml");
            $description = filter($description);	    
			$transfertitle = str_replace (" ", "_", $title);
			$title = ereg_replace($query1, "<b>$query1</b>", $title);
    		global $prefix, $db, $admin;
		if (is_admin($admin)) {
		    echo "<a href=\"".$admin_file.".php?op=DownloadsModDownload&amp;lid=$lid\"><img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\""._EDIT."\"></a>&nbsp;&nbsp;";
		} else {
		    echo "<img src=\"modules/$module_name/images/lwin.gif\" border=\"0\" alt=\"\">&nbsp;&nbsp;";
		}
		echo "<a href=\"modules.php?name=$module_name&amp;d_op=getit&amp;lid=$lid\">$title</a>";
		newdownloadgraphic($datetime, $time);
    		popgraphic($hits);
		detecteditorial($lid, $transfertitle, 1);
		echo "<br>";	    
		$description = ereg_replace($the_query, "<b>$the_query</b>", $description);
		echo "<b>"._DESCRIPTION.":</b> $description<br>";
		setlocale (LC_TIME, $locale);
		ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $time, $datetime);
		$datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
		$datetime = ucfirst($datetime);
		echo "<b>"._VERSION.":</b> $version <b>"._FILESIZE.":</b> ".CoolSize($filesize)."<br>";
		echo "<b>"._ADDEDON.":</b> $datetime <b>"._UDOWNLOADS.":</b> $hits";
    		/* voting & comments stats */
    		if ($totalvotes == 1) {
		    $votestring = _VOTE;
		} else {
		    $votestring = _VOTES;
		}
    		if ($downloadratingsummary!="0" || $downloadratingsummary!="0.0") {
		    echo " <b>"._RATING.":</b> $downloadratingsummary ($totalvotes $votestring)";
		}
    		if (empty($homepage)) {
		    echo "<br>";
		} else {
		    echo "<br><a href=\"$homepage\" target=\"new\">"._HOMEPAGE."</a> | ";
		}
    		echo "<a href=\"modules.php?name=$module_name&amp;d_op=ratedownload&amp;lid=$lid\">"._RATERESOURCE."</a>";
		echo " | <a href=\"modules.php?name=$module_name&amp;d_op=viewdownloaddetails&amp;lid=$lid\">"._DETAILS."</a>";
    		if ($totalcomments != 0) {
	    	    echo " | <a href=\"modules.php?name=$module_name&amp;d_op=viewdownloadcomments&amp;lid=$lid>"._SCOMMENTS." ($totalcomments)</a>";
		}
		detecteditorial($lid, $transfertitle, 0);
		echo "<br>";
		$result3 = $db->sql_query("SELECT cid,title,parentid FROM ".$prefix."_downloads_categories WHERE cid='$cid'");
		list($cid3,$title3,$parentid3) = $db->sql_fetchrow($result3);
		$cid3 = intval($cid3);
		$title3 = filter($title3, "nohtml");
		$parentid3 = intval($parentid3);
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
    $downloadpagesint = ($totalselecteddownloads / $downloadsresults);			
    $downloadpageremainder = ($totalselecteddownloads % $downloadsresults);		
    if ($downloadpageremainder != 0) {					 
    	$downloadpages = ceil($downloadpagesint);				
        if ($totalselecteddownloads < $downloadsresults) {
    	    $downloadpageremainder = 0;
	}
    } else {
    	$downloadpages = $downloadpagesint;
    }        
    /* Page Numbering */
    if ($downloadpages!=1 && $downloadpages!=0) {
	echo "<br><br>"
	    .""._SELECTPAGE.": ";
	$prev=$min-$downloadsresults;
	if ($prev>=0) {
    	    echo "&nbsp;&nbsp;<b>[ <a href=\"modules.php?name=$module_name&amp;d_op=search&amp;query=$the_query&amp;min=$prev&amp;orderby=$orderby&amp;show=$show\">"
    		." &lt;&lt; "._PREVIOUS."</a> ]</b> ";
      	}
	$counter = 1;
        $currentpage = ($max / $downloadsresults);
        while ($counter<=$downloadpages ) {
    	    $cpage = $counter;
            $mintemp = ($perpage * $counter) - $downloadsresults;
            if ($counter == $currentpage) {
		echo "<b>$counter</b> ";
	    } else {
		echo "<a href=\"modules.php?name=$module_name&amp;d_op=search&amp;query=$the_query&amp;min=$mintemp&amp;orderby=$orderby&amp;show=$show\">$counter</a> ";
	    }
            $counter++; 	
        }    	
        $next=$min+$downloadsresults;
        if ($x>=$perpage) {
    	    echo "&nbsp;&nbsp;<b>[ <a href=\"modules.php?name=$module_name&amp;d_op=search&amp;query=$the_query&amp;min=$max&amp;orderby=$orderby&amp;show=$show\">"
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

function viewdownloadeditorial($lid) {
    global $prefix, $db, $admin, $module_name;
    include("header.php");
    include("modules/$module_name/d_config.php");
    menu(1);
    $row = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_downloads_downloads WHERE lid='$lid'"));
    $ttitle = filter($row['title'], "nohtml");
    $lid = intval(trim($lid));
    $result=$db->sql_query("SELECT adminid, editorialtimestamp, editorialtext, editorialtitle FROM ".$prefix."_downloads_editorials WHERE downloadid = '$lid'");
    $recordexist = $db->sql_numrows($result);
    $ttitle = htmlentities($ttitle);
    $transfertitle = ereg_replace ("_", " ", $ttitle);
    $displaytitle = stripslashes($transfertitle);
    echo "<br>";
    OpenTable();
    echo "<center><font class=\"option\"><b>"._DOWNLOADPROFILE.": $displaytitle</b></font><br>";
    downloadinfomenu($lid);
    if ($recordexist != 0) {
	while(list($adminid, $editorialtimestamp, $editorialtext, $editorialtitle)=$db->sql_fetchrow($result)) {
			$editorialtitle = filter($editorialtitle, "nohtml");
            $editorialtext = filter($editorialtext);
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
    downloadfooter($lid);
    echo "</center>";
    CloseTable();
    include("footer.php");
}

function detecteditorial($lid, $img) {
    global $prefix, $db, $module_name;
    $lid = intval($lid);
    $resulted2 = $db->sql_query("SELECT adminid FROM ".$prefix."_downloads_editorials WHERE downloadid='$lid'");
    $recordexist = $db->sql_numrows($resulted2);
    if ($recordexist != 0) {
	if ($img == 1) {
	    echo "&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&amp;d_op=viewdownloadeditorial&amp;lid=$lid\"><img src=\"modules/$module_name/images/cool.gif\" alt=\""._EDITORIAL."\" border=\"0\"></a>";
	} else {
	    echo " | <a href=\"modules.php?name=$module_name&amp;d_op=viewdownloadeditorial&amp;lid=$lid\">"._EDITORIAL."</a>";
	}
    }
}

function viewdownloadcomments($lid) {
    global $prefix, $db, $admin, $bgcolor2, $module_name, $admin_file;
    include("header.php");
    include("modules/$module_name/d_config.php");
    menu(1);
    $row = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_downloads_downloads WHERE lid='$lid'"));
    $ttitle = filter($row['title'], "nohtml");
    echo "<br>";
    $lid = intval(trim($lid));
    $result=$db->sql_query("SELECT ratinguser, rating, ratingcomments, ratingtimestamp FROM ".$prefix."_downloads_votedata WHERE ratinglid = '$lid' AND ratingcomments != '' ORDER BY ratingtimestamp DESC");
    $totalcomments = $db->sql_numrows($result);
    $ttitle = htmlentities($ttitle);
    $transfertitle = ereg_replace ("_", " ", $ttitle);
    $displaytitle = stripslashes($transfertitle);
    OpenTable();
    echo "<center><font class=\"option\"><b>"._DOWNLOADPROFILE.": $displaytitle</b></font><br><br>";
    downloadinfomenu($lid);
    echo "<br><br><br>"._TOTALOF." $totalcomments "._COMMENTS."</font></center><br>"
	."<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" width=\"450\">";
    $x=0;
    while(list($ratinguser, $rating, $ratingcomments, $ratingtimestamp)=$db->sql_fetchrow($result)) {
        $rating = intval($rating);
    	$ratingcomments = filter($ratingcomments);
    	ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $ratingtimestamp, $ratingtime);
	$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
	$date_array = explode("-", $ratingtime); 
	$timestamp = mktime(0, 0, 0, $date_array['1'], $date_array['2'], $date_array['0']); 
        $formatted_date = date("F j, Y", $timestamp); 
	/* Individual user information */
	$result2=$db->sql_query("SELECT rating FROM ".$prefix."_downloads_votedata WHERE ratinguser = '$ratinguser'");
        $usertotalcomments = $db->sql_numrows($result2);
        $useravgrating = 0;
        while(list($rating2)=$db->sql_fetchrow($result2))	$useravgrating = $useravgrating + $rating2;
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
		echo "<a href=\"".$admin_file.".php?op=DownloadsModDownload&amp;lid=$lid\"><img src=\"modules/$module_name/images/editicon.gif\" border=\"0\" alt=\""._EDITTHISDOWNLOAD."\"></a>";
	    }	
	echo " $ratingcomments</font>"
	    ."<br><br><br></td></tr>";        
	$x++;
    }
    echo "</table><br><br><center>";
    downloadfooter($lid);
    echo "</center>";
    CloseTable();
    include("footer.php");
}

function viewdownloaddetails($lid) {
    global $prefix, $db, $admin, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $module_name, $anonymous;
    include("header.php");
    include("modules/$module_name/d_config.php");
    menu(1);
    $lid = intval($lid);
    $voteresult = $db->sql_query("SELECT rating, ratinguser, ratingcomments FROM ".$prefix."_downloads_votedata WHERE ratinglid = '$lid'");
    $totalvotesDB = $db->sql_numrows($voteresult);
    $totalvotesDB = intval($totalvotesDB);
    $anonvotes = 0;
    $anonvoteval = 0;
    $outsidevotes = 0;
    $outsidevoteval = 0;
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
    while(list($ratingDB, $ratinguserDB, $ratingcommentsDB)=$db->sql_fetchrow($voteresult)) {
 	$ratingDB = intval($ratingDB);
 	if (empty($ratingcommentsDB)) $truecomments--;
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
    if (!isset($avgOU) || $avgOU == 0 || $avgOU == "") {
	$avgOU = "";
    } else {
	$avgOU = number_format($avgOU, $detailvotedecimal);
    }
    if (!isset($avgRU) || $avgRU == 0 || $avgRU == "") {
	$avgRU = "";
    } else {
	$avgRU = number_format($avgRU, $detailvotedecimal);
    }
    if (!isset($avgAU) || $avgAU == 0 || $avgAU == "") {
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
    $ttitle = htmlentities($ttitle);
    $transfertitle = ereg_replace ("_", " ", $ttitle);
    $displaytitle = stripslashes($transfertitle);
    $res = $db->sql_query("SELECT title, name, email, description, filesize, version, homepage FROM ".$prefix."_downloads_downloads WHERE lid='$lid'");
    list($title, $auth_name, $email, $description, $filesize, $version, $homepage) = $db->sql_fetchrow($res);
    $ttitle = filter($title, "nohtml");
    $displaytitle = $ttitle;
	$auth_name = filter($auth_name, "nohtml");
	$email = filter($email, "nohtml");
    $description = filter($description);
    $homepage = filter($homepage, "nohtml");
    echo "<br>";
    OpenTable();
    echo "<center><font class=\"option\"><b>"._DOWNLOADPROFILE.": $displaytitle</b></font><br><br>";
    downloadinfomenu($lid); 
    echo "<br><br>"._DOWNLOADRATINGDET."<br>"
        .""._TOTALVOTES." $totalvotesDB<br>"
        .""._OVERALLRATING.": $finalrating<br><br>"
	."<font class=\"content\">$description<br>";
    if (empty($auth_name)) {
	$auth_name = "<i>"._UNKNOWN."</i>";
    } else {
	if (empty($email)) {
	    $auth_name = "$auth_name";
	} else {
	    $email = ereg_replace("@"," <i>at</i> ",$email);
	    $email = ereg_replace("\."," <i>dot</i> ",$email);
	    $auth_name = "$auth_name ($email)";
	}
    }
    echo "<br><b>"._AUTHOR.":</b> $auth_name<br>"
	."<b>"._VERSION.":</b> $version <b>"._FILESIZE.":</b> ".CoolSize($filesize)."</font><br><br>"
	."[ <b><a href=\"modules.php?name=$module_name&amp;d_op=getit&amp;lid=$lid\">"._DOWNLOADNOW."</a></b> ";
    if ((empty($homepage)) OR ($homepage == "http://")) {
	echo "]<br><br>";
    } else {
	echo "| <a href=\"$homepage\" target=\"new\">"._HOMEPAGE."</a> ]<br><br>";
    }
    echo "<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" width=\"455\">"
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
	."<tr><td bgcolor=\"$bgcolor2\"><font class=\"content\">"._DOWNLOADRATING.": $avgRU</font></td></tr>"
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
	."<tr><td bgcolor=\"$bgcolor2\"><font class=\"content\">"._DOWNLOADRATING.": $avgAU</font></td></tr>"
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
	    ."<tr><td bgcolor=\"$bgcolor2\"><font class=\"content\">"._DOWNLOADRATING.": $avgOU</font></td></tr>"
	    ."<tr><td bgcolor=\"$bgcolor1\"><font class=\"content\">"._HIGHRATING.": $topoutside</font></td></tr>"
	    ."<tr><td bgcolor=\"$bgcolor2\"><font class=\"content\">"._LOWRATING.": $bottomoutside</font></td></tr>"
	    ."<tr><td bgcolor=\"$bgcolor1\"><font class=\"content\">&nbsp;</font></td></tr>";
	}
    echo "</table><br><br><center>";
    downloadfooter($lid);
    echo "</center>";
    CloseTable();
    include("footer.php");
}

function downloadfooter($lid) {
    global $module_name;
    echo "<font class=\"content\">[ <a href=\"modules.php?name=$module_name&amp;d_op=getit&amp;lid=$lid\">"._DOWNLOADNOW."</a> | <a href=\"modules.php?name=$module_name&amp;d_op=ratedownload&amp;lid=$lid\">"._RATETHISSITE."</a> ]</font><br><br>";
    downloadfooterchild($lid);
}

function downloadfooterchild($lid) {
    global $module_name;
    include("modules/$module_name/d_config.php");
    if ($useoutsidevoting = 1) { 
	echo "<br><font class=\"content\">"._ISTHISYOURSITE." <a href=\"modules.php?name=$module_name&amp;d_op=outsidedownloadsetup&amp;lid=$lid\">"._ALLOWTORATE."</a></font>";
    }
}

function outsidedownloadsetup($lid) {
    global $module_name, $sitename, $nukeurl;
    $lid = intval($lid);
    include("header.php");
    include("modules/$module_name/d_config.php");
    menu(1);
    echo "<br>";
    OpenTable();
    echo "<center><font class=\"option\"><b>"._PROMOTEYOURSITE."</b></font></center><br><br>

    "._PROMOTE01."<br><br>

    <b>1) "._TEXTLINK."</b><br><br>

    "._PROMOTE02."<br><br>
    <center><a href=\"$nukeurl/modules.php?name=$module_name&amp;d_op=ratedownload&amp;lid=$lid\">"._RATETHISSITE." @ $sitename</a></center><br><br>
    <center>"._HTMLCODE1."</center><br>
    <center><i>&lt;a href=\"$nukeurl/modules.php?name=$module_name&amp;d_op=ratedownload&amp;lid=$lid\"&gt;"._RATETHISSITE."&lt;/a&gt;</i></center>
    <br><br>
    "._THENUMBER." \"$lid\" "._IDREFER."<br><br>

    <b>2) "._BUTTONLINK."</b><br><br>

    "._PROMOTE03."<br><br>

    <center>
    <form action=\"modules.php?name=$module_name\" method=\"post\">\n
	<input type=\"hidden\" name=\"lid\" value=\"$lid\">\n
	<input type=\"hidden\" name=\"d_op\" value=\"ratedownload\">\n
	<input type=\"submit\" value=\""._RATEIT."\">\n
    </form>\n
    </center>

    <center>"._HTMLCODE2."</center><br><br>

    <table border=\"0\" align=\"center\"><tr><td align=\"left\"><i>
    &lt;form action=\"$nukeurl/modules.php?name=$module_name\" method=\"post\"&gt;<br>\n
    &nbsp;&nbsp;&lt;input type=\"hidden\" name=\"lid\" value=\"$lid\"&gt;<br>\n
    &nbsp;&nbsp;&lt;input type=\"hidden\" name=\"d_op\" value=\"ratedownload\"&gt;<br>\n
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
	<input type=\"submit\" value=\""._DOWNLOADVOTE."\">
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
    		&lt;input type=\"hidden\" name=\"d_op\" value=\"addrating\"&gt;<br>
		&lt;input type=\"submit\" value=\""._DOWNLOADVOTE."\"&gt;<br>
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

function brokendownload($lid) {
    global $prefix, $db, $user, $cookie, $module_name;
    if (is_user($user)) {
		include("header.php");
		include("modules/$module_name/d_config.php");
	    $user2 = base64_decode($user);
	    $user2 = addslashes($user2);
	   	$cookie = explode(":", $user2);
		cookiedecode($user);
		$ratinguser = $cookie[1];
		menu(1);
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"option\"><b>"._REPORTBROKEN."</b></font><br><br><br><font class=\"content\">";
		echo "<form action=\"modules.php?name=$module_name\" method=\"post\">";
		echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\">";
		echo "<input type=\"hidden\" name=\"modifysubmitter\" value=\"$ratinguser\">";
		echo ""._THANKSBROKEN."<br>"._SECURITYBROKEN."<br><br>"; 
		echo "<input type=\"hidden\" name=\"d_op\" value=\"brokendownloadS\"><input type=\"submit\" value=\""._REPORTBROKEN."\"></center></form>";
		CloseTable();
		include("footer.php");
    } else {
		Header("Location: modules.php?name=$module_name");
    }
}

function brokendownloadS($lid, $modifysubmitter) {
    global $prefix, $db, $user, $anonymous, $cookie, $module_name, $user;
    if (is_user($user)) {
		include("modules/$module_name/d_config.php");
		$user2 = base64_decode($user);
		$user2 = addslashes($user2);
	   	$cookie = explode(":", $user2);
		cookiedecode($user);
		$ratinguser = $cookie[1];
		$lid = intval($lid);
		$db->sql_query("insert into ".$prefix."_downloads_modrequest values (NULL, '$lid', '0', '0', '', '', '', '".addslashes($ratinguser)."', '1', '".addslashes($auth_name)."', '".addslashes($email)."', '".addslashes($filesize)."', '".addslashes($version)."', '".addslashes($homepage)."')");
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

function modifydownloadrequest($lid) {
    global $prefix, $db, $user, $module_name;
    include("header.php");
    include("modules/$module_name/d_config.php");
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
	echo "<br><br><center>"._DONLYREGUSERSMODIFY."</center>";
	$blocknow = 1;
    }
    if ($blocknow != 1) {
    	$result = $db->sql_query("SELECT cid, title, url, description, name, email, filesize, version, homepage FROM ".$prefix."_downloads_downloads WHERE lid='$lid'");
    	echo "<center><font class=\"option\"><b>"._REQUESTDOWNLOADMOD."</b></font><br><font class=\"content\">";
    	while(list($cid, $title, $url, $description, $auth_name, $email, $filesize, $version, $homepage) = $db->sql_fetchrow($result)) {
            $cid = intval(trim($cid));
            $title = filter($title, "nohtml");
            $url = filter($url, "nohtml");
	    	$description = filter($description);
	    	$auth_name = filter($auth_name, "nohtml");
	    	$email = filter($email, "nohtml");
	    	$homepage = filter($homepage, "nohtml");
    	    echo "<form action=\"modules.php?name=$module_name\" method=\"post\">"
		        .""._DOWNLOADID.": <b>$lid</b></center><br><br><br>"
		        .""._DOWNLOADNAME.":<br><input type=\"text\" name=\"title\" value=\"$title\" size=\"50\" maxlength=\"100\"><br><br>"
		        .""._URL.":<br><input type=\"text\" name=\"url\" value=\"$url\" size=\"50\" maxlength=\"100\"><br><br>"
		        .""._DESCRIPTION.": <br><textarea name=\"description\" cols=\"70\" rows=\"15\">$description</textarea><br><br>"
	    		."<input type=\"hidden\" name=\"lid\" value=\"$lid\">"
				."<input type=\"hidden\" name=\"modifysubmitter\" value=\"$ratinguser\">"
				.""._CATEGORY.": <select name=\"cat\">";
			$result2=$db->sql_query("SELECT cid, title, parentid FROM ".$prefix."_downloads_categories order by title");
			while(list($cid2, $ctitle2, $parentid2) = $db->sql_fetchrow($result2)) {
            	$cid2 = intval($cid2);
            	$ctitle2 = filter($ctitle2, "nohtml");
            	$parentid2 = intval($parentid2);
				if ($cid2==$cid) {
					$sel = "selected";
				} else {
					$sel = "";
				}
				if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
	    		echo "<option value=\"$cid2\" $sel>$ctitle2</option>";
			}
	    	echo "</select><br><br>"
				.""._AUTHORNAME.":<br><input type=\"text\" name=\"auth_name\" value=\"$auth_name\" size=\"30\" maxlength=\"80\"><br><br>"
				.""._AUTHOREMAIL.":<br><input type=\"text\" name=\"email\" value=\"$email\" size=\"30\" maxlength=\"80\"><br><br>"
				.""._FILESIZE.": ("._INBYTES.")<br><input type=\"text\" name=\"filesize\" value=\"$filesize\" size=\"12\" maxlength=\"11\"><br><br>"
				.""._VERSION.":<br><input type=\"text\" name=\"version\" value=\"$version\" size=\"11\" maxlength=\"10\"><br><br>"
				.""._HOMEPAGE.":<br><input type=\"text\" name=\"homepage\" value=\"$homepage\" size=\"50\" maxlength=\"200\"><br><br>"
				."<input type=\"hidden\" name=\"d_op\" value=\"modifydownloadrequestS\">"
				."<input type=\"submit\" value=\""._SENDREQUEST."\"></form>";
    	}
    }
    CloseTable();
    include("footer.php");
}

function modifydownloadrequestS($lid, $cat, $title, $url, $description, $modifysubmitter, $auth_name, $email, $filesize, $version, $homepage) {
    global $prefix, $db, $user, $module_name;
    include("modules/$module_name/d_config.php");
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
	echo "<center><font class=\"content\">"._DONLYREGUSERSMODIFY."</font></center>";
	$blocknow = 1;
	CloseTable();
	include("footer.php");
    }
    if ($blocknow != 1) {
    	$cat = explode("-", $cat);
    	if ($cat[1]=="") {
    	    $cat[1] = 0;
    	}
    	$title = filter($title, "nohtml", 1);
    	$url = filter($url, "nohtml", 1);
    	$description = filter($description, "", 1);
        $lid = intval($lid);
        $cat[0] = intval($cat[0]);
        $cat[1] = intval($cat[1]);
    	$db->sql_query("insert into ".$prefix."_downloads_modrequest values (NULL, '$lid', '$cat[0]', '$cat[1]', '".addslashes($title)."', '".addslashes($url)."', '".addslashes($description)."', '".addslashes($ratinguser)."', '0', '".addslashes($auth_name)."', '".addslashes($email)."', '".addslashes($filesize)."', '".addslashes($version)."', '".addslashes($homepage)."')");
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
    $db->sql_query("update ".$prefix."_downloads_downloads set hits=hits+1 WHERE lid='$lid'");
    $result = $db->sql_query("SELECT url FROM ".$prefix."_downloads_downloads WHERE lid='$lid'");
    list($url) = $db->sql_fetchrow($result);
    Header("Location: $url");
}

function addrating($ratinglid, $ratinguser, $rating, $ratinghost_name, $ratingcomments) {
    global $prefix, $db, $cookie, $user, $module_name;
    $passtest = "yes";
    include("header.php");
    include("modules/$module_name/d_config.php");
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
    $results3 = $db->sql_query("SELECT title FROM ".$prefix."_downloads_downloads WHERE lid='$ratinglid'");
    while(list($title)=$db->sql_fetchrow($results3)) $ttitle = filter($title, "nohtml");
    $title = filter($title, "nohtml");
    /* Make sure only 1 anonymous from an IP in a single day. */
    $ip = $_SERVER['REMOTE_HOST'];
    if (empty($ip)) {
       $ip = $_SERVER['REMOTE_ADDR'];
    }
    /* Check if Rating is Null */
    if ($rating=="--") {
	$error = "nullerror";
        completevote($error);
	$passtest = "no";
    }
    /* Check if Download POSTER is voting (UNLESS Anonymous users allowed to post) */
    if ($ratinguser != $anonymous && $ratinguser != "outside") {
    	$result=$db->sql_query("SELECT submitter FROM ".$prefix."_downloads_downloads WHERE lid='$ratinglid'");
    	while(list($ratinguserDB)=$db->sql_fetchrow($result)) {
    	    if ($ratinguserDB==$ratinguser) {
    		$error = "postervote";
    	        completevote($error);
		$passtest = "no";
    	    }
   	}
    }
    /* Check if REG user is trying to vote twice. */
    if ($ratinguser!=$anonymous && $ratinguser != "outside") {
    	$result=$db->sql_query("SELECT ratinguser FROM ".$prefix."_downloads_votedata WHERE ratinglid='$ratinglid'");
    	while(list($ratinguserDB)=$db->sql_fetchrow($result)) {
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
    	$result=$db->sql_query("SELECT * FROM ".$prefix."_downloads_votedata WHERE ratinglid='$ratinglid' AND ratinguser='$anonymous' AND ratinghostname = '$ip' AND TO_DAYS(NOW()) - TO_DAYS(ratingtimestamp) < '$anonwaitdays'");
        $anonvotecount = $db->sql_numrows($result); 
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
    	$result=$db->sql_query("SELECT * FROM ".$prefix."_downloads_votedata WHERE ratinglid='$ratinglid' AND ratinguser='outside' AND ratinghostname = '$ip' AND TO_DAYS(NOW()) - TO_DAYS(ratingtimestamp) < '$outsidewaitdays'");
        $outsidevotecount = $db->sql_numrows($result); 
    	if ($outsidevotecount >= 1) {
    	    $error = "outsideflood";
            completevote($error);
    	    $passtest = "no";
    	}
    }
    /* Passed Tests */
    if ($passtest == "yes") {
    	$ratingcomments = filter($ratingcomments);
	if (!empty($ratingcomments)) {
	    update_points(19);
	}
	update_points(18);
    	/* All is well.  Add to Line Item Rate to DB. */
        $ratinglid = intval($ratinglid);
        $rating = intval($rating);
        $ratingcomments = filter($ratingcomments, "", 1);
        if ($rating > 10 || $rating < 1) { 
    	    header("Location: modules.php?name=$module_name&d_op=ratedownload&lid=$ratinglid"); 
    	    die(); 
        }
	 $db->sql_query("INSERT into ".$prefix."_downloads_votedata values (NULL,'$ratinglid', '$ratinguser', '$rating', '$ip', '$ratingcomments', now())");	
	/* All is well.  Calculate Score & Add to Summary (for quick retrieval & sorting) to DB. */
	/* NOTE: If weight is modified, ALL downloads need to be refreshed with new weight. */
	/*	 Running a SQL statement with your modded calc for ALL downloads will accomplish this. */
        $voteresult = $db->sql_query("SELECT rating, ratinguser, ratingcomments FROM ".$prefix."_downloads_votedata WHERE ratinglid = '$ratinglid'");
	$totalvotesDB = $db->sql_numrows($voteresult);
	include ("modules/$module_name/voteinclude.php");
        $finalrating = intval($finalrating);
        $totalvotesDB = intval($totalvotesDB);
        $truecomments = intval($truecomments);
        $ratinglid = intval($ratinglid);
        $db->sql_query("UPDATE ".$prefix."_downloads_downloads SET downloadratingsummary='$finalrating',totalvotes='$totalvotesDB',totalcomments='$truecomments' WHERE lid = '$ratinglid'");
        $error = "none";
        completevote($error);
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
    global $prefix, $db, $module_name, $sitename;
    include("modules/$module_name/d_config.php");
    $lid = intval($lid);
    $row = $db->sql_query("SELECT title FROM ".$prefix."_downloads_downloads WHERE lid='$lid'");
    $ttitle = filter($row[title], "nohtml");
    $result = $db->sql_query("SELECT url FROM ".$prefix."_downloads_downloads WHERE lid='$lid'");
    list($url)=$db->sql_fetchrow($result);
    echo "<font class=\"content\">"._THANKSTOTAKETIME." $sitename. "._DLETSDECIDE."</font><br><br><br>";
    if ($ratinguser=="outside") {
	echo "<center><font class=\"content\">".WEAPPREACIATE." $sitename!<br><a href=\"$url\">"._RETURNTO." $ttitle</a></font><center><br><br>";
        $result=$db->sql_query("SELECT title FROM ".$prefix."_downloads_downloads WHERE lid='$lid'");
        list($title)=$db->sql_fetchrow($result);
        $ttitle = ereg_replace (" ", "_", $title);
    }
    echo "<center>";
    downloadinfomenu($lid);
    echo "</center>";
    CloseTable();
}

function completevote($error) {
    global $module_name;
    include("modules/$module_name/d_config.php");
    if ($error == "none") echo "<center><font class=\"content\"><b>"._COMPLETEVOTE1."</b></font></center>";
    if ($error == "anonflood") echo "<center><font class=\"option\"><b>"._COMPLETEVOTE2."</b></font></center><br>";
    if ($error == "regflood") echo "<center><font class=\"option\"><b>"._COMPLETEVOTE3."</b></font></center><br>";
    if ($error == "postervote") echo "<center><font class=\"option\"><b>"._COMPLETEVOTE4."</b></font></center><br>";
    if ($error == "nullerror") echo "<center><font class=\"option\"><b>"._COMPLETEVOTE5."</b></font></center><br>";
    if ($error == "outsideflood") echo "<center><font class=\"option\"><b>"._COMPLETEVOTE6."</b></font></center><br>";
}

function ratedownload($lid, $user) {
    global $prefix, $cookie, $datetime, $module_name, $user_prefix;
    include("header.php");
    menu(1);
    $row = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_downloads_downloads WHERE lid='$lid'"));
    $displaytitle = filter($row['title'], "nohtml");
    echo "<br>";
    OpenTable();
    if (isset($_SERVER['REMOTE_HOST'])) { $ip = $_SERVER['REMOTE_HOST']; }
    if (empty($ip)) {
       $ip = $_SERVER['REMOTE_ADDR'];
    }
    echo "<b>$displaytitle</b>"
	."<ul><font class=\"content\">"
	."<li>"._RATENOTE1.""
	."<li>"._RATENOTE2.""
	."<li>"._RATENOTE3.""
	."<li>"._DRATENOTE4.""
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
    downloadfooterchild($lid);
    echo "</center>";
    CloseTable();
    include("footer.php");
}

function CoolSize($size) {
    $mb = 1024*1024;
    if ( $size > $mb ) {
        $mysize = sprintf ("%01.2f",$size/$mb) . " MB";
    } elseif ( $size >= 1024 ) {
        $mysize = sprintf ("%01.2f",$size/1024) . " Kb";
    } else {
        $mysize = $size . " bytes";
    }
    return $mysize;
}

if (isset($ratinglid) && isset ($ratinguser) && isset ($rating)) {
    $ret = addrating($ratinglid, $ratinguser, $rating, $ratinghost_name, $ratingcomments);
}

if (!(isset($d_op))) { $d_op = ""; }
if (!(isset($min))) { $min = 0; }
if (!(isset($orderby))) { $orderby = ""; }
if (!(isset($show))) { $show = ""; }
if (!(isset($ratenum))) { $ratenum = ""; }
if (!(isset($ratetype))) { $ratetype = ""; }
if (!(isset($newdownloadshowdays))) { $newdownloadshowdays = 7; }

switch($d_op) {

    case "AddDownload":
    AddDownload();
    break;

    case "NewDownloads":
    NewDownloads($newdownloadshowdays);
    break;

    case "NewDownloadsDate":
    NewDownloadsDate($selectdate);
    break;

    case "CoolSize":
    CoolSize($size);
    break;

    case "TopRated":
    TopRated($ratenum, $ratetype);
    break;

    case "MostPopular":
    MostPopular($ratenum, $ratetype);
    break;

    case "viewdownload":
    viewdownload($cid, $min, $orderby, $show);
    break;

    case "viewsdownload":
    viewsdownload($sid, $min, $orderby, $show);
    break;

    case "brokendownload":
    brokendownload($lid);
    break;

    case "modifydownloadrequest":
    modifydownloadrequest($lid);
    break;

    case "modifydownloadrequestS":
    modifydownloadrequestS($lid, $cat, $title, $url, $description, $modifysubmitter, $auth_name, $email, $filesize, $version, $homepage);
    break;

    case "brokendownloadS":
    brokendownloadS($lid, $modifysubmitter);
    break;

    case "getit":
    getit($lid);
    break;

    case "Add":
    Add($title, $url, $auth_name, $cat, $description, $email, $filesize, $version, $homepage);
    break;

    case "search":
    search($query, $min, $orderby, $show);
    break;

    case "rateinfo":
    rateinfo($lid);
    break;

    case "ratedownload":
    ratedownload($lid, $user);
    break;

    case "addrating":
    addrating($ratinglid, $ratinguser, $rating, $ratinghost_name, $ratingcomments, $user);
    break;

    case "viewdownloadcomments":
    viewdownloadcomments($lid);
    break;

    case "outsidedownloadsetup":
    outsidedownloadsetup($lid);
    break;

    case "viewdownloadeditorial":
    viewdownloadeditorial($lid);
    break;

    case "viewdownloaddetails":
    viewdownloaddetails($lid);
    break;

    default:
    index();
    break;

}

?>