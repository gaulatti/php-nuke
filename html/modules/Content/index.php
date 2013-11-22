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

function showpage($pid, $page=0) {
    global $prefix, $db, $sitename, $admin, $module_name;
    include("header.php");
    OpenTable();
    $pid = intval($pid);
    $mypage = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_pages WHERE pid='$pid'"));
    $myactive = intval($mypage['active']);
    $mytitle = filter($mypage['title'], "nohtml");
    $mysubtitle = filter($mypage['subtitle'], "nohtml");
    $mypage_header = filter($mypage['page_header']);
    $mytext = filter($mypage['text']);
    $mypage_footer = filter($mypage['page_footer']);
    $mysignature = filter($mypage['signature']);
    $mydate = $mypage['date'];
    $mycounter = intval($mypage['counter']);
    if (($myactive == 0) AND (!is_admin($admin))) {
		echo "Sorry... This page doesn't exist.";
    } else {
		$db->sql_query("UPDATE ".$prefix."_pages SET counter=counter+1 WHERE pid='$pid'");
		$date = explode(" ", $mydate);
		echo "<font class=\"title\">$mytitle</font><br>"
			."<font class=\"content\">$mysubtitle<br><br><br><br>";
		$contentpages = explode( "[--pagebreak--]", $mytext );
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
		if ($page == 1) {
		    echo "<p align=\"justify\">".nl2br($mypage_header)."</p><br>";
		}
		echo "<p align=\"justify\">$contentpages[$arrayelement]</p>";
		if($page >= $pageno) {
		    $next_page = "";
		} else {
		    $next_pagenumber = $page + 1;
		    if ($page != 1) {
			$next_page .= "- ";
		    }
		    $next_page .= "<a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid&amp;page=$next_pagenumber\">"._NEXT." ($next_pagenumber/$pageno)</a> <a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid&amp;page=$next_pagenumber\"><img src=\"images/right.gif\" border=\"0\" alt=\""._NEXT."\" title=\""._NEXT."\"></a>";
		}
		if ($page == $pageno) {
		    echo "<br><p align=\"justify\">".nl2br($mypage_footer)."</p><br><br>";
		}
		if($page <= 1) {
		    $previous_page = "";
		} else {
		    $previous_pagenumber = $page - 1;
		    $previous_page = "<a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid&amp;page=$previous_pagenumber\"><img src=\"images/left.gif\" border=\"0\" alt=\""._PREVIOUS."\" title=\""._PREVIOUS."\"></a> <a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid&amp;page=$previous_pagenumber\">"._PREVIOUS." ($previous_pagenumber/$pageno)</a>";
		}
		echo "<br><br><br><center>$previous_page $next_page</center><br><br>";
		if ($page == $pageno) {
		    echo "<p align=\"right\">".nl2br($mysignature)."</p>"
			."<p align=\"right\">"._COPYRIGHT." $sitename "._COPYRIGHT2."</p>"
			."<p align=\"right\"><font class=\"tiny\">"._PUBLISHEDON.": $date[0] ($mycounter "._READS.")</font></p>"
			."<center>"._GOBACK."</center>";
		}
    }
    CloseTable();
    include("footer.php");
}

function list_pages() {
    global $prefix, $db, $sitename, $admin, $multilingual, $module_name, $admin_file;
    include("header.php");
    title("$sitename: "._PAGESLIST."");
    OpenTable();
    echo "<center><font class=\"content\">"._LISTOFCONTENT." $sitename:</center><br><br>";
    $result = $db->sql_query("SELECT * FROM ".$prefix."_pages_categories");
    $numrows = $db->sql_numrows($result);
    $numrows2 = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_pages WHERE cid!='0' AND active='1'"));
    if ($numrows > 0 AND $numrows2 > 0) {
		echo "<center>"._CONTENTCATEGORIES."</center><br><br>"
	   		."<table border=\"1\" align=\"center\" width=\"95%\">";
		while ($row = $db->sql_fetchrow($result)) {
		    $cid = intval($row['cid']);
		    $title = filter($row['title'], "nohtml");
		    $description = filter($row['description']);
		    $numrows3 = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_pages WHERE cid='$cid'"));
		    if ($numrows3 > 0) {
				echo "<tr><td valign=\"top\">&nbsp;<a href=\"modules.php?name=$module_name&amp;pa=list_pages_categories&amp;cid=$cid\">$title</a>&nbsp;</td><td align=\"left\">$description</td></tr>";
		    }
		}
		echo "</td></tr></table><br><br>"
		    ."<center>"._NONCLASSCONT."</center><br><br>";
    }
    $result4 = $db->sql_query("SELECT pid, title, subtitle, clanguage FROM ".$prefix."_pages WHERE active='1' AND cid='0' ORDER BY date");
    echo "<blockquote>";
    while ($row4 = $db->sql_fetchrow($result4)) {
		$pid = intval($row4['pid']);
		$title = filter($row4['title'], "nohtml");
		$subtitle = filter($row4['subtitle'], "nohtml");
		$clanguage = $row4['clanguage'];
		if ($multilingual == 1) {
		    $the_lang = "<img src=\"images/language/flag-".$clanguage.".png\" hspace=\"3\" border=\"0\" height=\"10\" width=\"20\">";
		} else {
		    $the_lang = "";
		}
	    if (!empty($subtitle)) {
		    $subtitle = " ($subtitle)";
		} else {
	  	    $subtitle = "";
		}
		if (is_admin($admin)) {
		    echo "<strong><big>&middot;</big></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid\">$title</a> $subtitle [ <a href=\"".$admin_file.".php?op=content_edit&amp;pid=$pid\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=content_change_status&amp;pid=$pid&amp;active=1\">"._DEACTIVATE."</a> | <a href=\"".$admin_file.".php?op=content_delete&amp;pid=$pid\">"._DELETE."</a> ]<br>";
		} else {
		    echo "<strong><big>&middot;</big></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid\">$title</a> $subtitle<br>";
		}
    }
    echo "</blockquote>";
    if (is_admin($admin)) {
		$result5 = $db->sql_query("SELECT pid, cid, title, subtitle, clanguage FROM ".$prefix."_pages WHERE active='0' ORDER BY date");
		echo "<br><br><center><b>"._YOURADMINLIST."</b></center><br><br>";
		echo "<blockquote>";
		while ($row5 = $db->sql_fetchrow($result5)) {
		    $pid = intval($row5['pid']);
		    $cid = intval($row5['cid']);
		    $title = filter($row5['title'], "nohtml");
			$subtitle = filter($row5['subtitle'], "nohtml");
		    $clanguage = $row5['clanguage'];
		    if ($multilingual == 1) {
				$the_lang = "<img src=\"images/language/flag-".$clanguage.".png\" hspace=\"3\" border=\"0\" height=\"10\" width=\"20\">";
		    } else {
				$the_lang = "";
		    }
	    	if (!empty($subtitle)) {
		        $subtitle = " ($subtitle) ";
		    } else {
	    	    $subtitle = " ";
		    }
		    echo "<strong><big>&middot;</big></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid\">$title</a> $subtitle [ <a href=\"".$admin_file.".php?op=content_edit&amp;pid=$pid\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=content_change_status&amp;pid=$pid&amp;active=0\">"._ACTIVATE."</a> | <a href=\"".$admin_file.".php?op=content_delete&amp;pid=$pid\">"._DELETE."</a> ]<br>";
		}
		echo "</blockquote>";
    }
    CloseTable();
    include("footer.php");
}

function list_pages_categories($cid) {
    global $prefix, $db, $sitename, $admin, $multilingual, $module_name, $admin_file;
    include("header.php");
    title("$sitename: "._PAGESLIST."");
    OpenTable();
    echo "<center><font class=\"content\">"._LISTOFCONTENT." $sitename:</center><br><br>";
    $cid = intval($cid);
    $result = $db->sql_query("SELECT pid, title, subtitle, clanguage FROM ".$prefix."_pages WHERE active='1' AND cid='$cid' ORDER BY date");
    echo "<blockquote>";
    while ($row = $db->sql_fetchrow($result)) {
	$pid = intval($row['pid']);
	$title = filter($row['title'], "nohtml");
	$subtitle = filter($row['subtitle'], "nohtml");
	$clanguage = $row['clanguage'];
	if ($multilingual == 1) {
	    $the_lang = "<img src=\"images/language/flag-".$clanguage.".png\" hspace=\"3\" border=\"0\" height=\"10\" width=\"20\">";
	} else {
	    $the_lang = "";
	}
        if (!empty($subtitle)) {
	    $subtitle = " ($subtitle)";
	} else {
    	    $subtitle = "";
	}
	if (is_admin($admin)) {
	    echo "<strong><big>&middot;</big></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid\">$title</a> $subtitle [ <a href=\"".$admin_file.".php?op=content_edit&amp;pid=$pid\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=content_change_status&amp;pid=$pid&amp;active=1\">"._DEACTIVATE."</a> | <a href=\"".$admin_file.".php?op=content_delete&amp;pid=$pid\">"._DELETE."</a> ]<br>";
	} else {
	    echo "<strong><big>&middot;</big></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid\">$title</a> $subtitle<br>";
	}
    }
    echo "</blockquote>";
    if (is_admin($admin)) {
	$result2 = $db->sql_query("SELECT pid, title, subtitle, clanguage FROM ".$prefix."_pages WHERE active='0' AND cid='$cid' ORDER BY date");
	echo "<br><br><center><b>"._YOURADMINLIST."</b></center><br><br>";
	echo "<blockquote>";
	while ($row2 = $db->sql_fetchrow($result2)) {
	    $pid = intval($row2['pid']);
	    $title = filter($row2['title'], "nohtml");
	    $subtitle = filter($row2['subtitle'], "nohtml");
	    $clanguage = $row2['clanguage'];
	    if ($multilingual == 1) {
		$the_lang = "<img src=\"images/language/flag-".$clanguage.".png\" hspace=\"3\" border=\"0\" height=\"10\" width=\"20\">";
	    } else {
		$the_lang = "";
	    }
    	    if (!empty($subtitle)) {
	        $subtitle = " ($subtitle) ";
	    } else {
    	        $subtitle = " ";
	    }
	    echo "<strong><big>&middot;</big></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;pa=showpage&amp;pid=$pid\">$title</a> $subtitle [ <a href=\"".$admin_file.".php?op=content_edit&amp;pid=$pid\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=content_change_status&amp;pid=$pid&amp;active=0\">"._ACTIVATE."</a> | <a href=\"".$admin_file.".php?op=content_delete&amp;pid=$pid\">"._DELETE."</a> ]<br>";
	}
	echo "</blockquote>";
    }
    echo "<center>"._GOBACK."</center>";
    CloseTable();
    include("footer.php");
}

if (!isset($page)) { $page = ""; }
if (!isset($pa)) { $pa = ""; }

switch($pa) {

    case "showpage":
    showpage($pid, $page);
    break;
    
    case "list_pages_categories":
    list_pages_categories($cid);
    break;
    
    default:
    list_pages();
    break;

}

?>