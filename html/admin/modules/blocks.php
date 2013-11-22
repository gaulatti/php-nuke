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
$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));
if ($row['radminsuper'] == 1) {

	/*********************************************************/
	/* Blocks Functions                                      */
	/*********************************************************/

	function BlocksAdmin() {
		global $bgcolor2, $bgcolor4, $prefix, $db, $currentlang, $multilingual, $admin_file;
		include("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>"._BLOCKSADMIN."</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<br><table border=\"1\" width=\"100%\"><tr>"
		."<td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._TITLE."</b></td>"
		."<td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._POSITION."</b></td>"
		."<td align=\"center\" bgcolor=\"$bgcolor2\" colspan=\"2\"><b>"._WEIGHT."</b></td>"
		."<td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._TYPE."</b></td>"
		."<td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._STATUS."</b></td>"
		."<td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._VIEW."</b></td>";
		if ($multilingual == 1) {
			echo "<td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._LANGUAGE."</b></td>";
		}
		echo "<td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._FUNCTIONS."</b></tr>";
		$result = $db->sql_query("select bid, bkey, title, url, bposition, weight, active, blanguage, blockfile, view from ".$prefix."_blocks order by bposition, weight");
		while ($row = $db->sql_fetchrow($result)) {
			$bid = intval($row['bid']);
			$bkey = filter($row['bkey'], "nohtml");
			$title = filter($row['title'], "nohtml");
			$url = filter($row['url'], "nohtml");
			$bposition = filter($row['bposition'], "nohtml");
			$weight = intval($row['weight']);
			$active = intval($row['active']);
			$blanguage = $row['blanguage'];
			$blockfile = filter($row['blockfile'], "nohtml");
			$view = intval($row['view']);
			$weight1 = $weight - 1;
			$weight3 = $weight + 1;
			$row_res = $db->sql_fetchrow($db->sql_query("select bid from ".$prefix."_blocks where weight='$weight1' AND bposition='$bposition'"));
			$bid1 = intval($row_res['bid']);
			$con1 = "$bid1";
			$row_res2 = $db->sql_fetchrow($db->sql_query("select bid from ".$prefix."_blocks where weight='$weight3' AND bposition='$bposition'"));
			$bid2 = intval($row_res2['bid']);
			$con2 = "$bid2";
			echo "<tr>"
			."<td align=\"center\">$title</td>";
			if ($bposition == "l") {
				$bposition = "<img src=\"images/center_r.gif\" border=\"0\" alt=\""._LEFTBLOCK."\" title=\""._LEFTBLOCK."\" hspace=\"5\"> "._LEFT."";
			} elseif ($bposition == "r") {
				$bposition = ""._RIGHT." <img src=\"images/center_l.gif\" border=\"0\" alt=\""._RIGHTBLOCK."\" title=\""._RIGHTBLOCK."\" hspace=\"5\">";
			} elseif ($bposition == "c") {
				$bposition = "<img src=\"images/center_l.gif\" border=\"0\" alt=\""._CENTERBLOCK."\" title=\""._CENTERBLOCK."\">&nbsp;"._CENTERUP."&nbsp;<img src=\"images/center_r.gif\" border=\"0\" alt=\""._CENTERBLOCK."\" title=\""._CENTERBLOCK."\">";
			} elseif ($bposition == "d") {
				$bposition = "<img src=\"images/center_l.gif\" border=\"0\" alt=\""._CENTERBLOCK."\" title=\""._CENTERBLOCK."\">&nbsp;"._CENTERDOWN."&nbsp;<img src=\"images/center_r.gif\" border=\"0\" alt=\""._CENTERBLOCK."\" title=\""._CENTERBLOCK."\">";
			}
			echo "<td align=\"center\">$bposition</td>"
			."<td align=\"center\">"
			."&nbsp;$weight&nbsp;</td><td align=\"center\">";
			if ($con1) {
				echo"<a href=\"".$admin_file.".php?op=BlockOrder&amp;weight=$weight&amp;bidori=$bid&amp;weightrep=$weight1&amp;bidrep=$con1\"><img src=\"images/up.gif\" alt=\""._BLOCKUP."\" title=\""._BLOCKUP."\" border=\"0\" hspace=\"3\"></a>";
			}
			if ($con2) {
				echo "<a href=\"".$admin_file.".php?op=BlockOrder&amp;weight=$weight&amp;bidori=$bid&amp;weightrep=$weight3&amp;bidrep=$con2\"><img src=\"images/down.gif\" alt=\""._BLOCKDOWN."\" title=\""._BLOCKDOWN."\" border=\"0\" hspace=\"3\"></a>";
			}
			echo"</td>";
			if (empty($bkey)) {
				if (empty($url)) {
					$type = "HTML";
				} elseif (!empty($url)) {
					$type = "RSS/RDF";
				}
				if (!empty($blockfile)) {
					$type = _BLOCKFILE2;
				}
			} elseif (!empty($bkey)) {
				$type = _BLOCKSYSTEM;
			}
			echo "<td align=\"center\">$type</td>";
			$block_act = $active;
			if ($active == 1) {
				$active = "<img src=\"images/active.gif\" alt=\""._ACTIVE."\" title=\""._ACTIVE."\" border=\"0\" width=\"16\" height=\"16\">";
				$change = "<img src=\"images/inactive.gif\" alt=\""._DEACTIVATE."\" title=\""._DEACTIVATE."\" border=\"0\" width=\"16\" height=\"16\">";
			} elseif ($active == 0) {
				$active = "<img src=\"images/inactive.gif\" alt=\""._INACTIVE."\" title=\""._INACTIVE."\" border=\"0\" width=\"16\" height=\"16\">";
				$change = "<img src=\"images/active.gif\" alt=\""._ACTIVATE."\" title=\""._ACTIVATE."\" border=\"0\" width=\"16\" height=\"16\">";
			}
			echo "<td align=\"center\">$active</td>";
			if ($view == 0) {
				$who_view = _MVALL;
			} elseif ($view == 1) {
				$who_view = _MVUSERS;
			} elseif ($view == 2) {
				$who_view = _MVADMIN;
			} elseif ($view == 3) {
				$who_view = _MVANON;
			}
			echo "<td align=\"center\">$who_view</td>";
			if ($multilingual == 1) {
				if (empty($blanguage)) {
					$blanguage = _ALL;
				} else {
					$blanguage = ucfirst($blanguage);
				}
				echo "<td align=\"center\">$blanguage</td>";
			}
			echo "<td align=\"center\"><font class=\"content\">&nbsp;<a href=\"".$admin_file.".php?op=BlocksEdit&amp;bid=$bid\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=ChangeStatus&amp;bid=$bid\">$change</a>  ";
			if ($bkey == "") {
				echo "<a href=\"".$admin_file.".php?op=BlocksDelete&amp;bid=$bid\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a>  ";
			} elseif (!empty($bkey)) {
				echo "<img src=\"images/delete_x.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"> ";
			}
			echo "<a href=\"".$admin_file.".php?op=block_show&bid=$bid\"><img src=\"images/view.gif\" alt=\""._SHOW."\" title=\""._SHOW."\" border=\"0\" width=\"17\" height=\"17\"></a></font>&nbsp;</td></tr>";
		}
		echo "</table>"
		."<br><br>"
		."<center>[ <a href=\"".$admin_file.".php?op=fixweight\">"._FIXBLOCKS."</a> ]</center><br>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"option\"><b>"._ADDNEWBLOCK."</b></font></center><br><br>"
		."<form action=\"".$admin_file.".php\" method=\"post\">"
		."<table border=\"0\" width=\"100%\">"
		."<tr><td>"._TITLE.":</td><td><input type=\"text\" name=\"title\" size=\"30\" maxlength=\"60\"></td></tr>"
		."<tr><td>"._RSSFILE.":</td><td><input type=\"text\" name=\"url\" size=\"30\" maxlength=\"200\">&nbsp;&nbsp;"
		."<select name=\"headline\">"
		."<option name=\"headline\" value=\"0\" selected>"._CUSTOM."</option>";
		$res3 = $db->sql_query("select hid, sitename from ".$prefix."_headlines");
		while ($row_res3 = $db->sql_fetchrow($res3)) {
			$hid = intval($row_res3['hid']);
			$htitle = filter($row_res3['sitename'], "nohtml");
			echo "<option name=\"headline\" value=\"$hid\">$htitle</option>";
		}
		echo "</select>&nbsp;[ <a href=\"".$admin_file.".php?op=HeadlinesAdmin\">Setup</a> ]<br><font class=\"tiny\">";
		echo ""._SETUPHEADLINES."</font></td></tr>"
		."<tr><td>"._FILENAME.":</td><td>"
		."<select name=\"blockfile\">"
		."<option name=\"blockfile\" value=\"\" selected>"._NONE."</option>";
		$blocksdir = dir("blocks");
		while($func=$blocksdir->read()) {
			if(substr($func, 0, 6) == "block-") {
				$blockslist .= "$func ";
			}
		}
		closedir($blocksdir->handle);
		$blockslist = explode(" ", $blockslist);
		sort($blockslist);
		for ($i=0; $i < sizeof($blockslist); $i++) {
			if(!empty($blockslist[$i])) {
				$bl = ereg_replace("block-","",$blockslist[$i]);
				$bl = ereg_replace(".php","",$bl);
				$bl = ereg_replace("_"," ",$bl);
				$result2 = $db->sql_query("select * from ".$prefix."_blocks where blockfile='$blockslist[$i]'");
				$numrows = $db->sql_numrows($result2);
				if ($numrows == 0) {
					echo "<option value=\"$blockslist[$i]\">$bl</option>\n";
				}
			}
		}
		echo "</select>&nbsp;&nbsp;<font class=\"tiny\">"._FILEINCLUDE."</font></td></tr>"
		."<tr><td>"._CONTENT.":</td><td><textarea name=\"content\" cols=\"70\" rows=\"15\"></textarea><br><font class=\"tiny\">"._IFRSSWARNING."</font></td></tr>"
		."<tr><td>"._POSITION.":</td><td><select name=\"bposition\"><option name=\"bposition\" value=\"l\">"._LEFT."</option>"
		."<option name=\"bposition\" value=\"c\">"._CENTERUP."</option>"
		."<option name=\"bposition\" value=\"d\">"._CENTERDOWN."</option>"
		."<option name=\"bposition\" value=\"r\">"._RIGHT."</option></select></td></tr>";
		if ($multilingual == 1) {
			echo "<tr><td>"._LANGUAGE.":</td><td>"
			."<select name=\"blanguage\">";
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
				if($languageslist[$i]!="") {
					echo "<option value=\"$languageslist[$i]\" ";
					if($languageslist[$i]==$currentlang) echo "selected";
					echo ">".ucfirst($languageslist[$i])."</option>\n";
				}
			}
			echo "<option value=\"\">"._ALL."</option></select></td></tr>";
		} else {
			echo "<input type=\"hidden\" name=\"blanguage\" value=\"\">";
		}
		echo "<tr><td>"._ACTIVATE2."</td><td><input type=\"radio\" name=\"active\" value=\"1\" checked>"._YES." &nbsp;&nbsp;"
		."<input type=\"radio\" name=\"active\" value=\"0\">"._NO."</td></tr>"
		."<tr><td>"._EXPIRATION.":</td><td><input type=\"text\" name=\"expire\" size=\"4\" maxlength=\"3\" value=\"0\"> "._DAYS."</td></tr>"
		."<tr><td>"._AFTEREXPIRATION.":</td><td><select name=\"action\">"
		."<option name=\"action\" value=\"d\">"._DEACTIVATE."</option>"
		."<option name=\"action\" value=\"r\">"._DELETE."</option></select></td></tr>"
		."<tr><td>"._REFRESHTIME.":</td><td><select name=\"refresh\">"
		."<option name=\"refresh\" value=\"1800\">1/2 "._HOUR."</option>"
		."<option name=\"refresh\" value=\"3600\" selected>1 "._HOUR."</option>"
		."<option name=\"refresh\" value=\"18000\">5 "._HOURS."</option>"
		."<option name=\"refresh\" value=\"36000\">10 "._HOURS."</option>"
		."<option name=\"refresh\" value=\"86400\">24 "._HOURS."</option></select>&nbsp;<font class=\"tiny\">"._ONLYHEADLINES."</font></td></tr>"
		."<tr><td>"._VIEWPRIV."</td><td><select name=\"view\">"
		."<option value=\"0\" >"._MVALL."</option>"
		."<option value=\"1\" >"._MVUSERS."</option>"
		."<option value=\"2\" >"._MVADMIN."</option>"
		."<option value=\"3\" >"._MVANON."</option>"
		."</select></td></tr><tr><td nowrap>"
		.""._SUBVISIBLE."</td><td><input type=\"radio\" name=\"subscription\" value=\"0\" checked>"._YES." &nbsp;&nbsp;<input type=\"radio\" name=\"subscription\" value=\"1\">"._NO.""
		."</td></tr></table><br><br>"
		."<input type=\"hidden\" name=\"op\" value=\"BlocksAdd\">"
		."<input type=\"submit\" value=\""._CREATEBLOCK."\"></form>";
		CloseTable();
		include("footer.php");
	}

	function block_show($bid) {
		global $prefix, $db, $admin_file;
		include("header.php");
		GraphicAdmin();
		title(""._BLOCKSADMIN."");
		OpenTable();
		echo "<br><center>";
		$bid = intval($bid);
		$row = $db->sql_fetchrow($db->sql_query("select bid, bkey, title, content, url, active, bposition, blockfile from ".$prefix."_blocks where bid='$bid'"));
		$bid = intval($row['bid']);
		$bkey = filter($row['bkey'], "nohtml");
		$title = filter($row['title'], "nohtml");
		$content = filter($row['content']);
		$url = filter($row['url'], "nohtml");
		$active = intval($row['active']);
		$bposition = filter($row['bposition'], "nohtml");
		$blockfile = filter($row['blockfile'], "nohtml");
		if ($bkey == "main") {
			mainblock();
		} elseif ($bkey == "admin") {
			adminblock();
		} elseif ($bkey == "modules") {
			modules_block();
		} elseif ($bkey == "category") {
			category();
		} elseif ($bkey == "userbox") {
			userblock();
		} elseif (empty($bkey)) {
			if (empty($url)) {
				if (empty($blockfile)) {
					if ($bposition == "c") {
						themecenterbox($title, $content);
					} else {
						themesidebox($title, $content);
					}
				} else {
					if ($bposition == "c") {
						blockfileinc($title, $blockfile, 1);
					} else {
						blockfileinc($title, $blockfile);
					}
				}
			} else {
				headlines($bid);
			}
		}
		echo "</center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		if ($active == 1) {
			$act_chg = _DEACTIVATE;
		} elseif ($active == 0) {
			$act_chg = _ACTIVATE;
		}
		echo "<center><font class=\"option\"><b>"._BLOCKSADMIN.": "._FUNCTIONS."</b></font><br><br>"
		."[ <a href=\"".$admin_file.".php?op=ChangeStatus&bid=$bid\">$act_chg</a> | <a href=\"".$admin_file.".php?op=BlocksEdit&bid=$bid\">"._EDIT."</a> | ";
		if (empty($bkey)) {
			echo "<a href=\"".$admin_file.".php?op=BlocksDelete&bid=$bid\">"._DELETE."</a> | ";
		} else {
			echo ""._DELETE." | ";
		}
		echo "<a href=\"".$admin_file.".php?op=BlocksAdmin\">"._BLOCKSADMIN."</a> ]</center>";
		CloseTable();
		include("footer.php");
	}

	function fixweight() {
		global $prefix, $db, $admin_file;
		$leftpos = "l";
		$rightpos = "r";
		$centerpos = "c";
		$result = $db->sql_query("select bid from ".$prefix."_blocks where bposition='$leftpos' order by weight ASC");
		$weight = 0;
		while ($row = $db->sql_fetchrow($result)) {
			$bid = intval($row['bid']);
			$weight++;
			$db->sql_query("update ".$prefix."_blocks set weight='$weight' where bid='$bid'");
		}
		$result2 = $db->sql_query("select bid from ".$prefix."_blocks where bposition='$rightpos' order by weight ASC");
		$weight = 0;
		while ($row2 = $db->sql_fetchrow($result2)) {
			$bid = intval($row2['bid']);
			$weight++;
			$db->sql_query("update ".$prefix."_blocks set weight='$weight' where bid='$bid'");
		}
		$result3 = $db->sql_query("select bid from ".$prefix."_blocks where bposition='$centerpos' order by weight ASC");
		$weight = 0;
		while ($row3 = $db->sql_fetchrow($result3)) {
			$bid = intval($row3['bid']);
			$weight++;
			$db->sql_query("update ".$prefix."_blocks set weight='$weight' where bid='$bid'");
		}
		Header("Location: ".$admin_file.".php?op=BlocksAdmin");
	}

	function BlockOrder ($weightrep,$weight,$bidrep,$bidori) {
		global $prefix, $db, $admin_file;
		$bidrep = intval($bidrep);
		$bidori = intval($bidori);
		$result = $db->sql_query("update ".$prefix."_blocks set weight='$weight' where bid='$bidrep'");
		$result2 = $db->sql_query("update ".$prefix."_blocks set weight='$weightrep' where bid='$bidori'");
		Header("Location: ".$admin_file.".php?op=BlocksAdmin");
	}

	function rssfail() {
		include("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>"._BLOCKSADMIN."</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><b>"._RSSFAIL."</b><br><br>"
		.""._RSSTRYAGAIN."<br><br>"
		.""._GOBACK."</center>";
		CloseTable();
		include("footer.php");
		die;
	}

	function BlocksAdd($title, $content, $url, $bposition, $active, $refresh, $headline, $blanguage, $blockfile, $view, $expire, $action, $subscription) {
		global $prefix, $db, $admin_file;
		if ($headline != 0) {
			$row = $db->sql_fetchrow($db->sql_query("select sitename, headlinesurl from ".$prefix."_headlines where hid='$headline'"));
			$title = filter($row['sitename'], "nohtml", 1);
			$url = filter($row['headlinesurl'], "nohtml", 1);
		}
		$row2 = $db->sql_fetchrow($db->sql_query("SELECT weight FROM ".$prefix."_blocks WHERE bposition='$bposition' ORDER BY weight DESC"));
		$weight = intval($row2['weight']);
		$weight++;
		$title = filter($title, "nohtml", 1);
		$content = filter($content, "", 1);
		$bkey = "";
		$btime = "";
		if (!empty($blockfile)) {
			$url = "";
			if (empty($title)) {
				$title = ereg_replace("block-","",$blockfile);
				$title = ereg_replace(".php","",$title);
				$title = ereg_replace("_"," ",$title);
			}
		}
		if (!empty($url)) {
			$btime = time();
			if (!ereg("http://",$url)) {
				$url = "http://$url";
			}
			$rdf = parse_url($url);
			$fp = fsockopen($rdf['host'], 80, $errno, $errstr, 15);
			if (!$fp) {
				rssfail();
				exit;
			}
			if ($fp) {
				fputs($fp, "GET " . $rdf['path'] . "?" . $rdf['query'] . " HTTP/1.0\r\n");
				fputs($fp, "HOST: " . $rdf['host'] . "\r\n\r\n");
				$string = "";
				while(!feof($fp)) {
					$pagetext = fgets($fp,228);
					$string .= chop($pagetext);
				}
				fputs($fp,"Connection: close\r\n\r\n");
				fclose($fp);
				$items = explode("</item>",$string);
				$content = "<font class=\"content\">";
				for ($i=0;$i<10;$i++) {
					$link = ereg_replace(".*<link>","",$items[$i]);
					$link = ereg_replace("</link>.*","",$link);
					$title2 = ereg_replace(".*<title>","",$items[$i]);
					$title2 = ereg_replace("</title>.*","",$title2);
					if ($items[$i] == "" AND $cont != 1) {
						$content = "";
					} else {
						if (strcmp($link,$title2) AND !empty($items[$i])) {
							$cont = 1;
							$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"$link\" target=\"new\">$title2</a><br>\n";
						}
					}
				}
			}
		}
		$content = filter($content, "", 1);
		if (($content == "") AND ($blockfile == "")) {
			rssfail();
		} else {
			if ($expire == "") {
				$expire = 0;
			}
			if ($expire != 0) {
				$expire = time() + ($expire * 86400);
			}
			$db->sql_query("insert into ".$prefix."_blocks values (NULL, '$bkey', '$title', '$content', '$url', '$bposition', '$weight', '$active', '$refresh', '$btime', '$blanguage', '$blockfile', '$view', '$expire', '$action', '$subscription')");
			Header("Location: ".$admin_file.".php?op=BlocksAdmin");
		}
	}

	function BlocksEdit($bid) {
		global $bgcolor2, $bgcolor4, $prefix, $db, $multilingual, $admin_file, $AllowableHTML;
		include("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>"._EDITBLOCK."</b></font></center>";
		CloseTable();
		echo "<br>";
		$bid = intval($bid);
		$row = $db->sql_fetchrow($db->sql_query("select bkey, title, content, url, bposition, weight, active, refresh, blanguage, blockfile, view, expire, action, subscription from ".$prefix."_blocks where bid='$bid'"));
		$bkey = filter($row['bkey'], "nohtml");
		$title = filter($row['title'], "nohtml");
		$content = filter($row[content]);
		$url = filter($row['url'], "nohtml");
		$bposition = filter($row['bposition'], "nohtml");
		$weight = intval($row['weight']);
		$active = intval($row['active']);
		$refresh = intval($row['refresh']);
		$blanguage = $row['blanguage'];
		$blockfile = filter($row['blockfile'], "nohtml");
		$view = intval($row['view']);
		$expire = intval($row['expire']);
		$action = intval($row['action']);
		$subscription = intval($row['subscription']);
		if ($url != "") {
			$type = _RSSCONTENT;
		} elseif ($blockfile != "") {
			$type = _BLOCKFILE;
		}
		OpenTable();
		echo "<center><font class=\"option\"><b>"._BLOCK.": $title $type</b></font></center><br><br>"
		."<form action=\"".$admin_file.".php\" method=\"post\">"
		."<table border=\"0\" width=\"100%\">"
		."<tr><td>"._TITLE.":</td><td><input type=\"text\" name=\"title\" size=\"30\" maxlength=\"60\" value=\"$title\"></td></tr>";
		if ($blockfile != "") {
			echo "<tr><td>"._FILENAME.":</td><td>"
			."<select name=\"blockfile\">";
			$blocksdir = dir("blocks");
			while($func=$blocksdir->read()) {
				if(substr($func, 0, 6) == "block-") {
					$blockslist .= "$func ";
				}
			}
			closedir($blocksdir->handle);
			$blockslist = explode(" ", $blockslist);
			sort($blockslist);
			for ($i=0; $i < sizeof($blockslist); $i++) {
				if($blockslist[$i]!="") {
					$bl = ereg_replace("block-","",$blockslist[$i]);
					$bl = ereg_replace(".php","",$bl);
					$bl = ereg_replace("_"," ",$bl);
					echo "<option value=\"$blockslist[$i]\" ";
					if ($blockfile == $blockslist[$i]) { echo "selected"; }
					echo ">$bl</option>\n";
				}
			}
			echo "</select>&nbsp;&nbsp;<font class=\"tiny\">"._FILEINCLUDE."</font></td></tr>";
		} else {
			if ($url != "") {
				echo "<tr><td>"._RSSFILE.":</td><td><input type=\"text\" name=\"url\" size=\"30\" maxlength=\"200\" value=\"$url\">&nbsp;&nbsp;<font class=\"tiny\">"._ONLYHEADLINES."</font></td></tr>";
			} else {
				echo "<tr><td>"._CONTENT.":</td><td><textarea name=\"content\" cols=\"70\" rows=\"15\">$content</textarea></td></tr>";
			}
		}
		$oldposition = $bposition;
		echo "<input type=\"hidden\" name=\"oldposition\" value=\"$oldposition\">";
		$sel1 = $sel2 = $sel3 = $sel4 = "";
		if ($bposition == "l") {
			$sel1 = "selected";
		} elseif ($bposition == "c") {
			$sel2 = "selected";
		} elseif ($bposition == "r") {
			$sel3 = "selected";
		} elseif ($bposition == "d") {
			$sel4 = "selected";
		}
		echo "<tr><td>"._POSITION.":</td><td><select name=\"bposition\">"
		."<option name=\"bposition\" value=\"l\" $sel1>"._LEFT."</option>"
		."<option name=\"bposition\" value=\"c\" $sel2>"._CENTERUP."</option>"
		."<option name=\"bposition\" value=\"d\" $sel4>"._CENTERDOWN."</option>"
		."<option name=\"bposition\" value=\"r\" $sel3>"._RIGHT."</option></select></td></tr>";
		if ($multilingual == 1) {
			echo "<tr><td>"._LANGUAGE.":</td><td>"
			."<select name=\"blanguage\">";
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
				if($languageslist[$i]!="") {
					echo "<option value=\"$languageslist[$i]\" ";
					if($languageslist[$i]==$blanguage) echo "selected";
					echo ">".ucfirst($languageslist[$i])."</option>\n";
				}
			}
			if ($blanguage != "") {
				$sel3 = "";
			} else {
				$sel3 = "selected";
			}
			echo "<option value=\"\" $sel3>"._ALL."</option></select></td></tr>";
		} else {
			echo "<input type=\"hidden\" name=\"blanguage\" value=\"\">";
		}
		if ($active == 1) {
			$sel1 = "checked";
			$sel2 = "";
		} elseif ($active == 0) {
			$sel1 = "";
			$sel2 = "checked";
		}
		if ($expire != 0) {
			$oldexpire = $expire;
			$expire = intval(($expire - time()) / 3600);
			$exp_day = $expire / 24;
			$expire = "<input type=\"hidden\" name=\"expire\" value=\"$oldexpire\"><b>$expire "._HOURS." (".substr($exp_day,0,5)." "._DAYS.")</b> <input type='text' name='moretime' size='4'> "._MOREDAYS."";
		} else {
			$expire = "<input type=\"text\" name=\"expire\" value=\"0\" size=\"4\" maxlength=\"3\"> "._DAYS."";
		}
		if ($action == "d") {
			$selact1 = "selected";
			$selact2 = "";
		} elseif ($action == "r") {
			$selact1 = "";
			$selact2 = "selected";
		}
		echo "<tr><td>"._ACTIVATE2."</td><td><input type=\"radio\" name=\"active\" value=\"1\" $sel1>"._YES." &nbsp;&nbsp;"
		."<input type=\"radio\" name=\"active\" value=\"0\" $sel2>"._NO."</td></tr>"
		."<tr><td>"._EXPIRATION.":</td><td>$expire</td></tr>"
		."<tr><td>"._AFTEREXPIRATION.":</td><td><select name=\"action\">"
		."<option name=\"action\" value=\"d\" $selact1>"._DEACTIVATE."</option>"
		."<option name=\"action\" value=\"r\" $selact2>"._DELETE."</option></select></td></tr>";
		if ($url != "") {
			$sel1 = $sel2 = $sel3 = $sel4 = $sel5 = "";
			if ($refresh == 1800) {
				$sel1 = "selected";
			} elseif ($refresh == 3600) {
				$sel2 = "selected";
			} elseif ($refresh == 18000) {
				$sel3 = "selected";
			} elseif ($refresh == 36000) {
				$sel4 = "selected";
			} elseif ($refresh == 86400) {
				$sel5 = "selected";
			}
			echo "<tr><td>"._REFRESHTIME.":</td><td><select name=\"refresh\"><option name=\"refresh\" value=\"1800\" $sel1>1/2 "._HOUR."</option>"
			."<option name=\"refresh\" value=\"3600\" $sel2>1 "._HOUR."</option>"
			."<option name=\"refresh\" value=\"18000\" $sel3>5 "._HOURS."</option>"
			."<option name=\"refresh\" value=\"36000\" $sel4>10 "._HOURS."</option>"
			."<option name=\"refresh\" value=\"86400\" $sel5>24 "._HOURS."</option></select>&nbsp;<font class=\"tiny\">"._ONLYHEADLINES."</font>";
		}
		$sel1 = $sel2 = $sel3 = $sel4 = "";
		if ($view == 0) {
			$sel1 = "selected";
		} elseif ($view == 1) {
			$sel2 = "selected";
		} elseif ($view == 2) {
			$sel3 = "selected";
		} elseif ($view == 3) {
			$sel4 = "selected";
		}
		if ($subscription == 1) {
			$sub_c1 = "";
			$sub_c2 = "checked";
		} else {
			$sub_c1 = "checked";
			$sub_c2 = "";
		}
		echo "</td></tr><tr><td>"._VIEWPRIV."</td><td><select name=\"view\">"
		."<option value=\"0\" $sel1>"._MVALL."</option>"
		."<option value=\"1\" $sel2>"._MVUSERS."</option>"
		."<option value=\"2\" $sel3>"._MVADMIN."</option>"
		."<option value=\"3\" $sel4>"._MVANON."</option>"
		."</select></td></tr><tr><td nowrap>"
		.""._SUBVISIBLE."</td><td><input type='radio' name='subscription' value='0' $sub_c1> "._YES."&nbsp;&nbsp;<input type='radio' name='subscription' value='1' $sub_c2> "._NO.""
		."</td></tr></table><br><br>"
		."<input type=\"hidden\" name=\"bid\" value=\"$bid\">"
		."<input type=\"hidden\" name=\"bkey\" value=\"$bkey\">"
		."<input type=\"hidden\" name=\"weight\" value=\"$weight\">"
		."<input type=\"hidden\" name=\"op\" value=\"BlocksEditSave\">"
		."<input type=\"submit\" value=\""._SAVEBLOCK."\"></form>";
		CloseTable();
		include("footer.php");
	}

	function SortWeight($bposition) {
		global $prefix, $db;
		$numbers = 1;
		$number_two = 1;
		$result = $db->sql_query("SELECT bid,weight FROM ".$prefix."_blocks WHERE bposition='$bposition' ORDER BY weight");
		while ($row = $db->sql_fetchrow($result)) {
			$bid = intval($row['bid']);
			$weight = intval($row['weight']);
			$result2 = $db->sql_query("update ".$prefix."_blocks set weight='$numbers' where bid='$bid'");
			$numbers++;
		}
		if ($bposition == l) {
			$position_two = "r";
		} else {
			$position_two = "l";
		}
		$result_two = $db->sql_query("SELECT bid,weight FROM ".$prefix."_blocks WHERE bposition='$position_two' ORDER BY weight");
		while ($row_two = $db->sql_fetchrow($result_two)) {
			$bid2 = intval($row_two['bid']);
			$weight = intval($row_two['weight']);
			$result_two2 = $db->sql_query("update ".$prefix."_blocks set weight='$number_two' where bid='$bid2'");
			$number_two++;
		}
		return $numbers;
	}

	function BlocksEditSave($bid, $bkey, $title, $content, $url, $oldposition, $bposition, $active, $refresh, $weight, $blanguage, $blockfile, $view, $expire, $action, $subscription, $moretime) {
		global $prefix, $db, $admin_file;
		if (!empty($moretime)) {
			$moretime = $moretime * 86400;
			$expire = $moretime + $expire;
		}
		if (!empty($url)) {
			$bkey = "";
			$btime = time();
			if (!ereg("http://",$url)) {
				$url = "http://$url";
			}
			$rdf = parse_url($url);
			$fp = fsockopen($rdf['host'], 80, $errno, $errstr, 15);
			if (!$fp) {
				rssfail();
				exit;
			}
			if ($fp) {
				fputs($fp, "GET " . $rdf['path'] . "?" . $rdf['query'] . " HTTP/1.0\r\n");
				fputs($fp, "HOST: " . $rdf['host'] . "\r\n\r\n");
				$string	= "";
				while(!feof($fp)) {
					$pagetext = fgets($fp,300);
					$string .= chop($pagetext);
				}
				fputs($fp,"Connection: close\r\n\r\n");
				fclose($fp);
				$items = explode("</item>",$string);
				$content = "<font class=\"content\">";
				for ($i=0;$i<10;$i++) {
					$link = ereg_replace(".*<link>","",$items[$i]);
					$link = ereg_replace("</link>.*","",$link);
					$title2 = ereg_replace(".*<title>","",$items[$i]);
					$title2 = ereg_replace("</title>.*","",$title2);
					if ($items[$i] == "" AND $cont != 1) {
						$content = "";
					} else {
						if (strcmp($link,$title2) AND $items[$i] != "") {
							$cont = 1;
							$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"$link\" target=\"new\">$title2</a><br>\n";
						}
					}
				}
			}
			if ($oldposition != $bposition) {
				$result = $db->sql_query("select bid from ".$prefix."_blocks where weight>='$weight' AND bposition='$bposition'");
				$fweight = $weight;
				$oweight = $weight;
				while ($row = $db->sql_fetchrow($result)) {
					$nbid = intval($row['bid']);
					$weight++;
					$db->sql_query("update ".$prefix."_blocks set weight='$weight' where bid='$nbid'");
				}
				$result2 = $db->sql_query("select bid from ".$prefix."_blocks where weight>'$oweight' AND bposition='$oldposition'");
				while ($row2 = $db->sql_fetchrow($result2)) {
					$obid = intval($row2['bid']);
					$db->sql_query("update ".$prefix."_blocks set weight='$oweight' where bid='$obid'");
					$oweight++;
				}
				$row3 = $db->sql_fetchrow($db->sql_query("select weight from ".$prefix."_blocks where bposition='$bposition' order by weight DESC limit 0,1"));
				$lastw = $row3['weight'];
				if ($lastw <= $fweight) {
					$lastw++;
					$db->sql_query("update ".$prefix."_blocks set title='$title', content='$content', bposition='$bposition', weight='$lastw', active='$active', refresh='$refresh', blanguage='$blanguage', blockfile='$blockfile', view='$view', subscription='$subscription' where bid='$bid'");
				} else {
					$db->sql_query("update ".$prefix."_blocks set title='$title', content='$content', bposition='$bposition', weight='$fweight', active='$active', refresh='$refresh', blanguage='$blanguage', blockfile='$blockfile', view='$view', subscription='$subscription' where bid='$bid'");
				}
			} else {
				$db->sql_query("update ".$prefix."_blocks set bkey='$bkey', title='$title', content='$content', url='$url', bposition='$bposition', weight='$weight', active='$active', refresh='$refresh', blanguage='$blanguage', blockfile='$blockfile', view='$view', subscription='$subscription' where bid='$bid'");
			}
			Header("Location: ".$admin_file.".php?op=BlocksAdmin");
		} else {
			$title = filter($title, "nohtml", 1);
			$content = filter($content, "", 1);
			if ($oldposition != $bposition) {
				$result5 = $db->sql_query("select bid from ".$prefix."_blocks where weight>='$weight' AND bposition='$bposition'");
				$fweight = $weight;
				$oweight = $weight;
				while ($row5 = $db->sql_fetchrow($result5)) {
					$nbid = intval($row5['bid']);
					$weight++;
					$db->sql_query("update ".$prefix."_blocks set weight='$weight' where bid='$nbid'");
				}
				$result6 = $db->sql_query("select bid from ".$prefix."_blocks where weight>'$oweight' AND bposition='$oldposition'");
				while ($row6 = $db->sql_fetchrow($result6)) {
					$obid = intval($row6['bid']);
					$db->sql_query("update ".$prefix."_blocks set weight='$oweight' where bid='$obid'");
					$oweight++;
				}
				$row7 = $db->sql_fetchrow($db->sql_query("select weight from ".$prefix."_blocks where bposition='$bposition' order by weight DESC limit 0,1"));
				$lastw = $row7['weight'];
				if ($lastw <= $fweight) {
					$lastw++;
					$db->sql_query("update ".$prefix."_blocks set title='$title', content='$content', bposition='$bposition', weight='$lastw', active='$active', refresh='$refresh', blanguage='$blanguage', blockfile='$blockfile', view='$view', subscription='$subscription' where bid='$bid'");
				} else {
					$db->sql_query("update ".$prefix."_blocks set title='$title', content='$content', bposition='$bposition', weight='$fweight', active='$active', refresh='$refresh', blanguage='$blanguage', blockfile='$blockfile', view='$view', subscription='$subscription' where bid='$bid'");
				}
			} else {
				if (empty($expire)) {
					$expire = 0;
				}
				if ($expire != 0 AND $expire <= 999) {
					$expire = time() + ($expire * 86400);
				}
				$result8 = $db->sql_query("update ".$prefix."_blocks set bkey='$bkey', title='$title', content='$content', url='$url', bposition='$bposition', weight='$weight', active='$active', refresh='$refresh', blanguage='$blanguage', blockfile='$blockfile', view='$view', expire='$expire', action='$action', subscription='$subscription' where bid='$bid'");
			}
			Header("Location: ".$admin_file.".php?op=BlocksAdmin");
		}
	}

	function ChangeStatus($bid, $ok=0) {
		global $prefix, $db, $admin_file;
		$bid = intval($bid);
		$row = $db->sql_fetchrow($db->sql_query("select active from ".$prefix."_blocks where bid='$bid'"));
		$active = intval($row['active']);
		if (($ok) OR ($active == 1)) {
			if ($active == 0) {
				$active = 1;
			} elseif ($active == 1) {
				$active = 0;
			}
			$result2 = $db->sql_query("update ".$prefix."_blocks set active='$active' where bid='$bid'");
			Header("Location: ".$admin_file.".php?op=BlocksAdmin");
		} else {
			$row3 = $db->sql_fetchrow($db->sql_query("select title, content from ".$prefix."_blocks where bid='$bid'"));
			$title = filter($row3['title'], "nohtml");
			$content = filter($row3['content']);
			include("header.php");
			GraphicAdmin();
			echo "<br>";
			OpenTable();
			echo "<center><font class=\"option\"><b>"._BLOCKACTIVATION."</b></font></center>";
			CloseTable();
			echo "<br>";
			OpenTable();
			if (!empty($content)) {
				echo "<center>"._BLOCKPREVIEW." <i>$title</i><br><br>";
				themesidebox($title, $content);
			} else {
				echo "<center><i>$title</i><br><br>";
			}
			echo "<br>"._WANT2ACTIVATE."<br><br>"
			."[ <a href=\"".$admin_file.".php?op=BlocksAdmin\">"._NO."</a> | <a href=\"".$admin_file.".php?op=ChangeStatus&amp;bid=$bid&amp;ok=1\">"._YES."</a> ]"
			."</center>";
			CloseTable();
			include("footer.php");
		}
	}

	function BlocksDelete($bid, $ok=0) {
		global $prefix, $db, $admin_file;
		$bid = intval($bid);
		if ($ok) {
			$row = $db->sql_fetchrow($db->sql_query("select bposition, weight from ".$prefix."_blocks where bid='$bid'"));
			$bposition = filter($row['bposition'], "nohtml");
			$weight = intval($row['weight']);
			$result2 = $db->sql_query("select bid from ".$prefix."_blocks where weight>'$weight' AND bposition='$bposition'");
			while ($row2 = $db->sql_fetchrow($result2)) {
				$nbid = intval($row2['bid']);
				$db->sql_query("update ".$prefix."_blocks set weight='$weight' where bid='$nbid'");
				$weight++;
			}
			$db->sql_query("delete from ".$prefix."_blocks where bid='$bid'");
			Header("Location: ".$admin_file.".php?op=BlocksAdmin");
		} else {
			$row3 = $db->sql_fetchrow($db->sql_query("select title from ".$prefix."_blocks where bid='$bid'"));
			$title = $row3['title'];
			include("header.php");
			GraphicAdmin();
			OpenTable();
			echo "<center><font class=\"title\"><b>"._BLOCKSADMIN."</b></font></center>";
			CloseTable();
			echo "<br>";
			OpenTable();
			echo "<center>"._ARESUREDELBLOCK." <i>$title</i>?";
			echo "<br><br>[ <a href=\"".$admin_file.".php?op=BlocksAdmin\">"._NO."</a> | <a href=\"".$admin_file.".php?op=BlocksDelete&amp;bid=$bid&amp;ok=1\">"._YES."</a> ]</center>";
			CloseTable();
			include("footer.php");
		}
	}

	function HeadlinesAdmin() {
		global $bgcolor1, $bgcolor2, $prefix, $db, $admin_file;
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>"._HEADLINESADMIN."</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<table border=\"1\" width=\"100%\" align=\"center\"><tr>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._SITENAME."</b></td>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._URL."</b></td>"
		."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._FUNCTIONS."</b></td><tr>";
		$result = $db->sql_query("select hid, sitename, headlinesurl from ".$prefix."_headlines order by hid");
		while ($row = $db->sql_fetchrow($result)) {
			$hid = intval($row['hid']);
			$sitename = filter($row['sitename'], "nohtml");
			$headlinesurl = filter($row['headlinesurl'], "nohtml");
			echo "<td bgcolor=\"$bgcolor1\" align=\"center\">$sitename</td>"
			."<td bgcolor=\"$bgcolor1\" align=\"center\"><a href=\"$headlinesurl\" target=\"new\">$headlinesurl</a></td>"
			."<td bgcolor=\"$bgcolor1\" align=\"center\">[ <a href=\"".$admin_file.".php?op=HeadlinesEdit&amp;hid=$hid\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=HeadlinesDel&amp;hid=$hid&amp;ok=0\">"._DELETE."</a> ]</td><tr>";
		}
		echo "</form></td></tr></table>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<font class=\"option\"><b>"._ADDHEADLINE."</b></font><br><br>"
		."<font class=\"content\">"
		."<form action=\"".$admin_file.".php\" method=\"post\">"
		."<table border=\"0\" width=\"100%\"><tr><td>"
		.""._SITENAME.":</td><td><input type=\"text\" name=\"xsitename\" size=\"31\" maxlength=\"30\"></td></tr><tr><td>"
		.""._RSSFILE.":</td><td><input type=\"text\" name=\"headlinesurl\" size=\"50\" maxlength=\"200\"></td></tr><tr><td>"
		."</td></tr></table>"
		."<input type=\"hidden\" name=\"op\" value=\"HeadlinesAdd\">"
		."<input type=\"submit\" value=\""._ADD."\">"
		."</form>";
		CloseTable();
		include("footer.php");
	}

	function HeadlinesEdit($hid) {
		global $prefix, $db, $admin_file;
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>"._HEADLINESADMIN."</b></font></center>";
		CloseTable();
		echo "<br>";
		$row = $db->sql_fetchrow($db->sql_query("select sitename, headlinesurl from ".$prefix."_headlines where hid='$hid'"));
		$xsitename = filter($row['sitename'], "nohtml");
		$headlinesurl = filter($row['headlinesurl'], "nohtml");
		OpenTable();
		echo "<center><font class=\"option\"><b>"._EDITHEADLINE."</b></font></center>
	<form action=\"".$admin_file.".php\" method=\"post\">
	<input type=\"hidden\" name=\"hid\" value=\"$hid\">
	<table border=\"0\" width=\"100%\"><tr><td>
	"._SITENAME.":</td><td><input type=\"text\" name=\"xsitename\" size=\"31\" maxlength=\"30\" value=\"$xsitename\"></td></tr><tr><td>
	"._RSSFILE.":</td><td><input type=\"text\" name=\"headlinesurl\" size=\"50\" maxlength=\"200\" value=\"$headlinesurl\"></td></tr><tr><td>
	</select></td></tr></table>
	<input type=\"hidden\" name=\"op\" value=\"HeadlinesSave\">
	<input type=\"submit\" value=\""._SAVECHANGES."\">
	</form>";
		CloseTable();
		include("footer.php");
	}

	function HeadlinesSave($hid, $xsitename, $headlinesurl) {
		global $prefix, $db, $admin_file;
		$hid = intval($hid);
		$xsitename = filter($xsitename, "nohtml", 1);
		$headlinesurl = filter($headlinesurl, "nohtml", 1);
		$xsitename = ereg_replace(" ", "", $xsitename);
		$db->sql_query("update ".$prefix."_headlines set sitename='$xsitename', headlinesurl='$headlinesurl' where hid='$hid'");
		Header("Location: ".$admin_file.".php?op=HeadlinesAdmin");
	}

	function HeadlinesAdd($xsitename, $headlinesurl) {
		global $prefix, $db, $admin_file;
		$xsitename = filter($xsitename, "nohtml", 1);
		$headlinesurl = filter($headlinesurl, "nohtml", 1);
		$xsitename = ereg_replace(" ", "", $xsitename);
		$db->sql_query("insert into ".$prefix."_headlines values (NULL, '$xsitename', '$headlinesurl')");
		Header("Location: ".$admin_file.".php?op=HeadlinesAdmin");
	}

	function HeadlinesDel($hid, $ok=0) {
		global $prefix, $db, $admin_file;
		$hid = intval($hid);
		if($ok==1) {
			$db->sql_query("delete from ".$prefix."_headlines where hid='$hid'");
			Header("Location: ".$admin_file.".php?op=HeadlinesAdmin");
		} else {
			include("header.php");
			GraphicAdmin();
			OpenTable();
			echo "<center><br>";
			echo "<font class=\"option\">";
			echo "<b>"._SURE2DELHEADLINE."</b></font><br><br>";
		}
		echo "[ <a href=\"".$admin_file.".php?op=HeadlinesDel&amp;hid=$hid&amp;ok=1\">"._YES."</a> | <a href=\"".$admin_file.".php?op=HeadlinesAdmin\">"._NO."</a> ]<br><br>";
		CloseTable();
		include("footer.php");
	}

	switch($op) {

		case "BlocksAdmin":
		BlocksAdmin();
		break;

		case "BlocksAdd":
		BlocksAdd($title, $content, $url, $bposition, $active, $refresh, $headline, $blanguage, $blockfile, $view, $expire, $action, $subscription);
		break;

		case "BlocksEdit":
		BlocksEdit($bid);
		break;

		case "BlocksEditSave":
		BlocksEditSave($bid, $bkey, $title, $content, $url, $oldposition, $bposition, $active, $refresh, $weight, $blanguage, $blockfile, $view, $expire, $action, $subscription, $moretime);
		break;

		case "ChangeStatus":
		ChangeStatus($bid, $ok, $de);
		break;

		case "BlocksDelete":
		BlocksDelete($bid, $ok);
		break;

		case "BlockOrder":
		BlockOrder ($weightrep,$weight,$bidrep,$bidori);
		break;

		case "HeadlinesDel":
		HeadlinesDel($hid, $ok);
		break;

		case "HeadlinesAdd":
		HeadlinesAdd($xsitename, $headlinesurl);
		break;

		case "HeadlinesSave":
		HeadlinesSave($hid, $xsitename, $headlinesurl);
		break;

		case "HeadlinesAdmin":
		HeadlinesAdmin();
		break;

		case "HeadlinesEdit":
		HeadlinesEdit($hid);
		break;

		case "fixweight":
		fixweight();
		break;

		case "block_show":
		block_show($bid);
		break;

	}

} else {
	echo "Access Denied";
}

?>