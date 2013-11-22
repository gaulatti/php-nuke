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

if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}

global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Web_Links'"));
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
	/* Links Modified Web Links                              */
	/*********************************************************/

	function getparent($parentid, $title) {
		global $prefix,$db;
		$title = filter($title, "nohtml");
		$parentid = intval($parentid);
		$row = $db->sql_fetchrow($db->sql_query("SELECT cid, title, parentid from " . $prefix . "_links_categories where cid='$parentid'"));
		$cid = intval($row['cid']);
		$ptitle = filter($row['title'], "nohtml");
		$pparentid = intval($row['parentid']);
		$db->sql_freeresult($result);
		if (!empty($ptitle)) $title=$ptitle."/".$title;
		if ($pparentid!=0) {
			$title=getparent($pparentid,$title);
		}
		return $title;
	}

	function links() {
		global $prefix, $db, $admin_file;
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		$ThemeSel = get_theme();
		if (file_exists("themes/$ThemeSel/images/link-logo.gif")) {
			echo "<center><a href=\"modules.php?name=Web_Links\"><img src=\"themes/$ThemeSel/images/link-logo.gif\" border=\"0\" alt=\"\"></a><br><br>";
		} else {
			echo "<center><a href=\"modules.php?name=Web_Links\"><img src=\"modules/Web_Links/images/link-logo.gif\" border=\"0\" alt=\"\"></a><br><br>";
		}
		$result = $db->sql_query("SELECT * from " . $prefix . "_links_links");
		$numrows = $db->sql_numrows($result);
		echo "<font class=\"content\">" . _THEREARE . " <b>$numrows</b> " . _LINKSINDB . "</font></center>";
		CloseTable();
		echo "<br>";

		/* Temporarily 'homeless' links functions (to be revised in ".$admin_file.".php breakup) */
		$result2 = $db->sql_query("SELECT requestid,lid,cid,title,url,description,modifysubmitter from " . $prefix . "_links_modrequest where brokenlink='1'");
		$totalbrokenlinks = $db->sql_numrows($result2);
		$result3 = $db->sql_query("SELECT requestid,lid,cid,title,url,description,modifysubmitter from " . $prefix . "_links_modrequest where brokenlink='0'");
		$totalmodrequests = $db->sql_numrows($result3);
		OpenTable();
		echo "<center><font class=\"content\">[ <a href=\"".$admin_file.".php?op=LinksCleanVotes\">" . _CLEANLINKSDB . "</a> | "
		."<a href=\"".$admin_file.".php?op=LinksListBrokenLinks\">" . _BROKENLINKSREP . " ($totalbrokenlinks)</a> | "
		."<a href=\"".$admin_file.".php?op=LinksListModRequests\">" . _LINKMODREQUEST . " ($totalmodrequests)</a> | "
		."<a href=\"".$admin_file.".php?op=LinksLinkCheck\">" . _VALIDATELINKS . "</a> ]</font></center>";
		CloseTable();
		echo "<br>";

		/* List Links waiting for validation */
		$result4 = $db->sql_query("SELECT lid, cid, sid, title, url, description, name, email, submitter from " . $prefix . "_links_newlink order by lid");
		$numrows = $db->sql_numrows($result4);
		if ($numrows>0) {
			OpenTable();
			echo "<center><font class=\"option\"><b>" . _LINKSWAITINGVAL . "</b></font></center><br><br>";
			while($row4 = $db->sql_fetchrow($result4)) {
				$lid = intval($row4['lid']);
				$cid = intval($row4['cid']);
				$sid = intval($row4['sid']);
				$title = filter($row4['title'], "nohtml");
				$url = filter($row4['url'], "nohtml");
				$description = filter($row4['description']);
				$name = filter($row4['name'], "nohtml");
				$email = filter($row4['email'], "nohtml");
				$submitter = filter($row4['submitter'], "nohtml");
				$url2 = urlencode($url);
				if (empty($submitter)) {
					$submitter = _NONE;
				}
				echo "<form action=\"".$admin_file.".php\" method=\"post\">"
				."<b>" . _LINKID . ": $lid</b><br><br>"
				."" . _SUBMITTER . ":  $submitter<br>"
				."" . _PAGETITLE . ": <input type=\"text\" name=\"title\" value=\"$title\" size=\"50\" maxlength=\"100\"><br>"
				."" . _PAGEURL . ": <input type=\"text\" name=\"url\" value=\"$url\" size=\"50\" maxlength=\"100\">&nbsp;[ <a href=\"index.php?url=$url2\" target=\"_blank\">" . _VISIT . "</a> ]<br>"
				."" . _DESCRIPTION . ": <br><textarea name=\"description\" cols=\"70\" rows=\"15\">$description</textarea><br>"
				."" . _NAME . ": <input type=\"text\" name=\"name\" size=\"20\" maxlength=\"100\" value=\"$name\">&nbsp;&nbsp;"
				."" . _EMAIL . ": <input type=\"text\" name=\"email\" size=\"20\" maxlength=\"100\" value=\"$email\"><br>";
				echo "<input type=\"hidden\" name=\"new\" value=\"1\">";
				echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\">";
				echo "<input type=\"hidden\" name=\"submitter\" value=\"$submitter\">";
				echo "" . _CATEGORY . ": <select name=\"cat\">";
				$result5 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_links_categories order by title");
				while ($row5 = $db->sql_fetchrow($result5)) {
					$cid2 = intval($row5['cid']);
					$ctitle2 = filter($row5['title'], "nohtml");
					$parentid2 = intval($row5['parentid']);
					if ($cid2==$cid) {
						$sel = "selected";
					} else {
						$sel = "";
					}
					if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
					echo "<option value=\"$cid2\" $sel>$ctitle2</option>";
				}

				echo "<input type=\"hidden\" name=\"submitter\" value=\"$submitter\">";
				echo "</select><input type=\"hidden\" name=\"op\" value=\"LinksAddLink\"><input type=\"submit\" value=" . _ADD . "> [ <a href=\"".$admin_file.".php?op=LinksDelNew&amp;lid=$lid\">" . _DELETE . "</a> ]</form><br><hr noshade><br>";
			}
			CloseTable();
			echo "<br>";
		} else {
		}

		/* Add a New Main Category */

		OpenTable();
		echo "<form method=\"post\" action=\"".$admin_file.".php\">"
		."<font class=\"option\"><b>" . _ADDMAINCATEGORY . "</b></font><br><br>"
		."" . _NAME . ": <input type=\"text\" name=\"title\" size=\"30\" maxlength=\"100\"><br>"
		."" . _DESCRIPTION . ":<br><textarea name=\"cdescription\" cols=\"70\" rows=\"15\"></textarea><br>"
		."<input type=\"hidden\" name=\"op\" value=\"LinksAddCat\">"
		."<input type=\"submit\" value=\"" . _ADD . "\"><br>"
		."</form>";
		CloseTable();
		echo "<br>";

		// Add a New Sub-Category
		$result6 = $db->sql_query("SELECT * from " . $prefix . "_links_categories");
		$numrows = $db->sql_numrows($result6);
		if ($numrows>0) {
			OpenTable();
			echo "<form method=\"post\" action=\"".$admin_file.".php\">"
			."<font class=\"option\"><b>" . _ADDSUBCATEGORY . "</b></font><br><br>"
			."" . _NAME . ": <input type=\"text\" name=\"title\" size=\"30\" maxlength=\"100\">&nbsp;" . _IN . "&nbsp;";
			$result7 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_links_categories order by parentid,title");
			echo "<select name=\"cid\">";
			while($row7 = $db->sql_fetchrow($result7)) {
				$cid2 = intval($row7['cid']);
				$ctitle2 = filter($row7['title'], "nohtml");
				$parentid2 = intval($row7['parentid']);
				if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
				echo "<option value=\"$cid2\">$ctitle2</option>";
			}
			echo "</select><br>"
			."" . _DESCRIPTION . ":<br><textarea name=\"cdescription\" cols=\"70\" rows=\"15\"></textarea><br>"
			."<input type=\"hidden\" name=\"op\" value=\"LinksAddSubCat\">"
			."<input type=\"submit\" value=\"" . _ADD . "\"><br>"
			."</form>";
			CloseTable();
			echo "<br>";
		} else {
		}

		// Add a New Link to Database
		$result8 = $db->sql_query("SELECT cid, title from " . $prefix . "_links_categories");
		$numrows = $db->sql_numrows($result8);
		if ($numrows>0) {
			OpenTable();
			echo "<form method=\"post\" action=\"".$admin_file.".php\">"
			."<font class=\"option\"><b>" . _ADDNEWLINK . "</b></font><br><br>"
			."" . _PAGETITLE . ": <input type=\"text\" name=\"title\" size=\"50\" maxlength=\"100\"><br>"
			."" . _PAGEURL . ": <input type=\"text\" name=\"url\" size=\"50\" maxlength=\"100\" value=\"http://\"><br>";
			$result9 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_links_categories order by title");
			echo "" . _CATEGORY . ": <select name=\"cat\">";
			while($row9 = $db->sql_fetchrow($result9)) {
				$cid2 = intval($row9['cid']);
				$ctitle2 = filter($row9['title'], "nohtml");
				$parentid2 = intval($row9['parentid']);
				if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
				echo "<option value=\"$cid2\">$ctitle2</option>";
			}
			echo "</select><br><br><br>"
			."" . _DESCRIPTION255 . "<br><textarea name=\"description\" cols=\"70\" rows=\"15\"></textarea><br><br><br>"
			."" . _NAME . ": <input type=\"text\" name=\"name\" size=\"30\" maxlength=\"60\"><br>"
			."" . _EMAIL . ": <input type=\"text\" name=\"email\" size=\"30\" maxlength=\"60\"><br><br>"
			."<input type=\"hidden\" name=\"op\" value=\"LinksAddLink\">"
			."<input type=\"hidden\" name=\"new\" value=\"0\">"
			."<input type=\"hidden\" name=\"lid\" value=\"0\">"
			."<center><input type=\"submit\" value=\"" . _ADDURL . "\"><br>"
			."</form>";
			CloseTable();
			echo "<br>";
		} else {
		}

		// Modify Category
		$result10 = $db->sql_query("SELECT * from " . $prefix . "_links_categories");
		$numrows = $db->sql_numrows($result10);
		if ($numrows>0) {
			OpenTable();
			echo "<form method=\"post\" action=\"".$admin_file.".php\">"
			."<font class=\"option\"><b>" . _MODCATEGORY . "</b></font><br><br>";
			$result11 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_links_categories order by title");
			echo "" . _CATEGORY . ": <select name=\"cat\">";
			while($row11 = $db->sql_fetchrow($result11)) {
				$cid2 = intval($row11['cid']);
				$ctitle2 = filter($row11['title'], "nohtml");
				$parentid2 = intval($row11['parentid']);
				if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
				echo "<option value=\"$cid2\">$ctitle2</option>";
			}
			echo "</select>"
			."<input type=\"hidden\" name=\"op\" value=\"LinksModCat\">"
			."<input type=\"submit\" value=\"" . _MODIFY . "\">"
			."</form>";
			CloseTable();
			echo "<br>";
		} else {
		}

		// Modify Links
		$result12 = $db->sql_query("SELECT * from " . $prefix . "_links_links");
		$numrows = $db->sql_numrows($result12);
		if ($numrows>0) {
			OpenTable();
			echo "<form method=\"post\" action=\"".$admin_file.".php\">"
			."<font class=\"option\"><b>" . _MODLINK . "</b><br><br>"
			."" . _LINKID . ": <input type=\"text\" name=\"lid\" size=\"12\" maxlength=\"11\">&nbsp;&nbsp;"
			."<input type=\"hidden\" name=\"op\" value=\"LinksModLink\">"
			."<input type=\"submit\" value=\"" . _MODIFY . "\">"
			."</form>";
			CloseTable();
			echo "<br>";
		} else {
		}

		// Transfer Categories
		$result13 = $db->sql_query("SELECT * from " . $prefix . "_links_links");
		$numrows = $db->sql_numrows($result13);
		if ($numrows>0) {
			OpenTable();
			echo "<form method=\"post\" action=\"".$admin_file.".php\">"
			."<font class=\"option\"><b>" . _EZTRANSFERLINKS . "</b></font><br><br>"
			."" . _CATEGORY . ": "
			."<select name=\"cidfrom\">";
			$result14 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_links_categories order by parentid,title");
			while($row14 = $db->sql_fetchrow($result14)) {
				$cid2 = intval($row14['cid']);
				$ctitle2 = filter($row14['title'], "nohtml");
				$parentid2 = intval($row14['parentid']);
				if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
				echo "<option value=\"$cid2\">$ctitle2</option>";
			}
			echo "</select><br>"
			."" . _IN . "&nbsp;" . _CATEGORY . ": ";
			$result15 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_links_categories order by parentid,title");
			echo "<select name=\"cidto\">";
			while($row15 = $db->sql_fetchrow($result15)) {
				$cid2 = intval($row15['cid']);
				$ctitle2 = filter($row15['title'], "nohtml");
				$parentid2 = $row15['parentid'];
				if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
				echo "<option value=\"$cid2\">$ctitle2</option>";
			}
			echo "</select><br>"
			."<input type=\"hidden\" name=\"op\" value=\"LinksTransfer\">"
			."<input type=\"submit\" value=\"" . _EZTRANSFER . "\"><br>"
			."</form>";
			CloseTable();
			echo "<br>";
		} else {
		}

		include ("footer.php");
	}

	function LinksTransfer($cidfrom, $cidto) {
		global $prefix, $db, $admin_file;

		// begin old categories
		// (uncomment lines to transfer existing datas)
		/*
		$cat = explode("-", $cidfrom);
		if (empty($cat[1])) {
		$cat[1] = 0;
		}
		$db->sql_query("update " . $prefix . "_links_links set cid='$cidto', sid='0' where cid='$cat[0]' AND sid='$cat[1]'");
		*/
		// end old categories

		// begin new categories
		// (comment lines to transfer existing datas)
		$db->sql_query("update " . $prefix . "_links_links set cid='$cidto' where cid='$cidfrom'");
		// end new categorie
		Header("Location: ".$admin_file.".php?op=Links");
	}

	function LinksModLink($lid) {
		global $prefix, $db, $admin_file, $bgcolor1, $bgcolor2, $sitename;
		include ("header.php");
		GraphicAdmin();
		global $anonymous;
		$lid = intval($lid);
		$result = $db->sql_query("SELECT cid, title, url, description, name, email, hits from " . $prefix . "_links_links where lid='$lid'");
		OpenTable();
		echo "<center><font class=\"title\"><b>" . _WEBLINKSADMIN . "</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"option\"><b>" . _MODLINK . "</b></font></center><br><br>";
		while($row = $db->sql_fetchrow($result)) {
			$cid = intval($row['cid']);
			$title = filter($row['title'], "nohtml");
			$url = filter($row['url'], "nohtml");
			$description = filter($row['description']);
			$name = filter($row['name'], "nohtml");
			$email = filter($row['email'], "nohtml");
			$hits = intval($row['hits']);
			echo "<form action=".$admin_file.".php method=post>"
			."" . _LINKID . ": <b>$lid</b><br>"
			."" . _PAGETITLE . ": <input type=\"text\" name=\"title\" value=\"$title\" size=\"50\" maxlength=\"100\"><br>"
			."" . _PAGEURL . ": <input type=\"text\" name=\"url\" value=\"$url\" size=\"50\" maxlength=\"100\">&nbsp;[ <a href=\"$url\">Visit</a> ]<br>"
			."" . _DESCRIPTION . ":<br><textarea name=\"description\" cols=\"70\" rows=\"15\">$description</textarea><br>"
			."" . _NAME . ": <input type=\"text\" name=\"name\" size=\"50\" maxlength=\"100\" value=\"$name\"><br>"
			."" . _EMAIL . ": <input type=\"text\" name=\"email\" size=\"50\" maxlength=\"100\" value=\"$email\"><br>"
			."" . _HITS . ": <input type=\"text\" name=\"hits\" value=\"$hits\" size=\"12\" maxlength=\"11\"><br>";
			echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\">"
			."" . _CATEGORY . ": <select name=\"cat\">";
			$result2 = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_links_categories order by title");
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

			echo "</select>"
			."<input type=\"hidden\" name=\"op\" value=\"LinksModLinkS\">"
			."<input type=\"submit\" value=\"" . _MODIFY . "\"> [ <a href=\"".$admin_file.".php?op=LinksDelLink&amp;lid=$lid\">" . _DELETE . "</a> ]</form><br>";
			CloseTable();
			echo "<br>";
			/* Modify or Add Editorial */
			$resulted2 = $db->sql_query("SELECT adminid, editorialtimestamp, editorialtext, editorialtitle from " . $prefix . "_links_editorials where linkid='$lid'");
			$recordexist = $db->sql_numrows($resulted2);
			OpenTable();
			/* if returns 'bad query' status 0 (add editorial) */
			if ($recordexist == 0) {
				echo "<center><font class=\"option\"><b>" . _ADDEDITORIAL . "</b></font></center><br><br>"
				."<form action=\"".$admin_file.".php\" method=\"post\">"
				."<input type=\"hidden\" name=\"linkid\" value=\"$lid\">"
				."" . _EDITORIALTITLE . ":<br><input type=\"text\" name=\"editorialtitle\" value=\"$editorialtitle\" size=\"50\" maxlength=\"100\"><br>"
				."" . _EDITORIALTEXT . ":<br><textarea name=\"editorialtext\" cols=\"70\" rows=\"15\">$editorialtext</textarea><br>"
				."</select><input type=\"hidden\" name=\"op\" value=\"LinksAddEditorial\"><input type=\"submit\" value=\"Add\">";
			} else {
				/* if returns 'cool' then status 1 (modify editorial) */
				while($row3 = $db->sql_fetchrow($resulted2)) {
					$editorialtimestamp = $row3['editorialtimestamp'];
					$editorialtext = filter($row3['editorialtext']);
					$editorialtitle = filter($row3['editorialtitle'], "nohtml");
					ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $editorialtimestamp, $editorialtime);
					$editorialtime = strftime("%F",mktime($editorialtime[4],$editorialtime[5],$editorialtime[6],$editorialtime[2],$editorialtime[3],$editorialtime[1]));
					$date_array = explode("-", $editorialtime);
					$timestamp = mktime(0, 0, 0, $date_array['1'], $date_array['2'], $date_array['0']);
					$formatted_date = date("F j, Y", $timestamp);
					echo "<center><font class=\"option\"><b>Modify Editorial</b></font></center><br><br>"
					."<form action=\"".$admin_file.".php\" method=\"post\">"
					."" . _AUTHOR . ": $adminid<br>"
					."" . _DATEWRITTEN . ": $formatted_date<br><br>"
					."<input type=\"hidden\" name=\"linkid\" value=\"$lid\">"
					."" . _EDITORIALTITLE . ":<br><input type=\"text\" name=\"editorialtitle\" value=\"$editorialtitle\" size=\"50\" maxlength=\"100\"><br>"
					."" . _EDITORIALTEXT . ":<br><textarea name=\"editorialtext\" cols=\"70\" rows=\"15\">$editorialtext</textarea><br>"
					."</select><input type=\"hidden\" name=\"op\" value=\"LinksModEditorial\"><input type=\"submit\" value=\"" . _MODIFY . "\"> [ <a href=\"".$admin_file.".php?op=LinksDelEditorial&amp;linkid=$lid\">" . _DELETE . "</a> ]";
				}
			}
			CloseTable();
			echo "<br>";
			OpenTable();
			/* Show Comments */
			$result4 = $db->sql_query("SELECT ratingdbid, ratinguser, ratingcomments, ratingtimestamp FROM " . $prefix . "_links_votedata WHERE ratinglid = '$lid' AND ratingcomments != '' ORDER BY ratingtimestamp DESC");
			$totalcomments = $db->sql_numrows($result4);
			echo "<table valign=top width=100%>";
			echo "<tr><td colspan=7><b>Link Comments (total comments: $totalcomments)</b><br><br></td></tr>";
			echo "<tr><td width=20 colspan=1><b>User  </b></td><td colspan=5><b>Comment  </b></td><td><b><center>Delete</center></b></td><br></tr>";
			if ($totalcomments == 0) echo "<tr><td colspan=7><center><font color=cccccc>No Comments<br></font></center></td></tr>";
			$x=0;
			$colorswitch=$bgcolor1;
			while($row4 = $db->sql_fetchrow($result4)) {
				$ratingdbid = intval($row4['ratingdbid']);
				$ratinguser = $row4['ratinguser'];
				$ratingcomments = filter($row4['ratingcomments']);
				$ratingtimestamp = $row4['ratingtimestamp'];
				ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $ratingtimestamp, $ratingtime);
				$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
				$date_array = explode("-", $ratingtime);
				$timestamp = mktime(0, 0, 0, $date_array['1'], $date_array['2'], $date_array['0']);
				$formatted_date = date("F j, Y", $timestamp);
				echo "<tr><td valign=top bgcolor=$colorswitch>$ratinguser</td><td valign=top colspan=5 bgcolor=$colorswitch>$ratingcomments</td><td bgcolor=$colorswitch><center><b><a href=".$admin_file.".php?op=LinksDelComment&lid=$lid&rid=$ratingdbid>X</a></b></center></td><br></tr>";
				$x++;
				if ($colorswitch==$bgcolor1) $colorswitch=$bgcolor2;
				else $colorswitch=$bgcolor1;
			}


			// Show Registered Users Votes
			$result5 = $db->sql_query("SELECT ratingdbid, ratinguser, rating, ratinghostname, ratingtimestamp FROM " . $prefix . "_links_votedata WHERE ratinglid = '$lid' AND ratinguser != 'outside' AND ratinguser != '$anonymous' ORDER BY ratingtimestamp DESC");
			$totalvotes = $db->sql_numrows($result5);
			echo "<tr><td colspan=7><br><br><b>Registered User Votes (total votes: $totalvotes)</b><br><br></td></tr>";
			echo "<tr><td><b>User  </b></td><td><b>IP Address  </b></td><td><b>Rating  </b></td><td><b>User AVG Rating  </b></td><td><b>Total Ratings  </b></td><td><b>Date  </b></td></font></b><td><b><center>Delete</center></b></td><br></tr>";
			if ($totalvotes == 0) echo "<tr><td colspan=7><center><font color=cccccc>No Registered User Votes<br></font></center></td></tr>";
			$x=0;
			$colorswitch=$bgcolor1;
			while($row5 = $db->sql_fetchrow($result5)) {
				$ratingdbid = intval($row5['ratingdbid']);
				$ratinguser = $row5['ratinguser'];
				$rating = intval($row5['rating']);
				$ratinghostname = filter($row5['ratinghostname'], "nohtml");
				$ratingtimestamp = $row5['ratingtimestamp'];
				ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $ratingtimestamp, $ratingtime);
				$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
				$date_array = explode("-", $ratingtime);
				$timestamp = mktime(0, 0, 0, $date_array['1'], $date_array['2'], $date_array['0']);
				$formatted_date = date("F j, Y", $timestamp);

				//Individual user information
				$result6 = $db->sql_query("SELECT rating FROM " . $prefix . "_links_votedata WHERE ratinguser = '$ratinguser'");
				$usertotalcomments = $db->sql_numrows($result6);
				$useravgrating = 0;
				while($row6 = $db->sql_fetchrow($result6)) $useravgrating = $useravgrating + $rating2;
				$useravgrating = $useravgrating / $usertotalcomments;
				$useravgrating = number_format($useravgrating, 1);
				echo "<tr><td bgcolor=$colorswitch>$ratinguser</td><td bgcolor=$colorswitch>$ratinghostname</td><td bgcolor=$colorswitch>$rating</td><td bgcolor=$colorswitch>$useravgrating</td><td bgcolor=$colorswitch>$usertotalcomments</td><td bgcolor=$colorswitch>$formatted_date  </font></b></td><td bgcolor=$colorswitch><center><b><a href=".$admin_file.".php?op=LinksDelVote&lid=$lid&rid=$ratingdbid>X</a></b></center></td></tr><br>";
				$x++;
				if ($colorswitch==$bgcolor1) $colorswitch=$bgcolor2;
				else $colorswitch=$bgcolor1;
			}

			// Show Unregistered Users Votes
			$result7 = $db->sql_query("SELECT ratingdbid, rating, ratinghostname, ratingtimestamp FROM " . $prefix . "_links_votedata WHERE ratinglid = '$lid' AND ratinguser = '$anonymous' ORDER BY ratingtimestamp DESC");
			$totalvotes = $db->sql_numrows($result7);
			echo "<tr><td colspan=7><b><br><br>Unregistered User Votes (total votes: $totalvotes)</b><br><br></td></tr>";
			echo "<tr><td colspan=2><b>IP Address  </b></td><td colspan=3><b>Rating  </b></td><td><b>Date  </b></font></td><td><b><center>Delete</center></b></td><br></tr>";
			if ($totalvotes == 0) echo "<tr><td colspan=7><center><font color=cccccc>No Unregistered User Votes<br></font></center></td></tr>";
			$x=0;
			$colorswitch=$bgcolor1;
			while($row7 = $db->sql_fetchrow($result7)) {
				$ratingdbid = intval($row7['ratingdbid']);
				$rating = intval($row7['rating']);
				$ratinghostname = filter($row7['ratinghostname'], "nohtml");
				$ratingtimestamp = $row7['ratingtimestamp'];
				ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $ratingtimestamp, $ratingtime);
				$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
				$date_array = explode("-", $ratingtime);
				$timestamp = mktime(0, 0, 0, $date_array['1'], $date_array['2'], $date_array['0']);
				$formatted_date = date("F j, Y", $timestamp);
				echo "<td colspan=2 bgcolor=$colorswitch>$ratinghostname</td><td colspan=3 bgcolor=$colorswitch>$rating</td><td bgcolor=$colorswitch>$formatted_date  </font></b></td><td bgcolor=$colorswitch><center><b><a href=".$admin_file.".php?op=LinksDelVote&lid=$lid&rid=$ratingdbid>X</a></b></center></td></tr><br>";
				$x++;
				if ($colorswitch==$bgcolor1) $colorswitch=$bgcolor2;
				else $colorswitch=$bgcolor1;
			}

			// Show Outside Users Votes
			$result8 = $db->sql_query("SELECT ratingdbid, rating, ratinghostname, ratingtimestamp FROM " . $prefix . "_links_votedata WHERE ratinglid = '$lid' AND ratinguser = 'outside' ORDER BY ratingtimestamp DESC");
			$totalvotes = $db->sql_numrows($result8);
			echo "<tr><td colspan=7><b><br><br>Outside User Votes (total votes: $totalvotes)</b><br><br></td></tr>";
			echo "<tr><td colspan=2><b>IP Address  </b></td><td colspan=3><b>Rating  </b></td><td><b>Date  </b></td></font></b><td><b><center>Delete</center></b></td><br></tr>";
			if ($totalvotes == 0) echo "<tr><td colspan=7><center><font color=cccccc>No Votes from Outside $sitename<br></font></center></td></tr>";
			$x=0;
			$colorswitch=$bgcolor1;
			while($row8 = $db->sql_fetchrow($result8)) {
				$ratingdbid = intval($row8['ratingdbid']);
				$rating = intval($row8['rating']);
				$ratinghostname = filter($row8['ratinghostname'], "nohtml");
				$ratingtimestamp = $row8['ratingtimestamp'];
				ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $ratingtimestamp, $ratingtime);
				$ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
				$date_array = explode("-", $ratingtime);
				$timestamp = mktime(0, 0, 0, $date_array['1'], $date_array['2'], $date_array['0']);
				$formatted_date = date("F j, Y", $timestamp);
				echo "<tr><td colspan=2 bgcolor=$colorswitch>$ratinghostname</td><td colspan=3 bgcolor=$colorswitch>$rating</td><td bgcolor=$colorswitch>$formatted_date  </font></b></td><td bgcolor=$colorswitch><center><b><a href=".$admin_file.".php?op=LinksDelVote&lid=$lid&rid=$ratingdbid>X</a></b></center></td></tr><br>";
				$x++;
				if ($colorswitch==$bgcolor1) $colorswitch=$bgcolor2;
				else $colorswitch=$bgcolor1;
			}

			echo "<tr><td colspan=6><br></td></tr>";
			echo "</table>";
		}
		echo "</form>";
		CloseTable();
		echo "<br>";
		include ("footer.php");
	}

	function LinksDelComment($lid, $rid) {
		global $prefix, $db, $admin_file;
		$rid = intval($rid);
		$lid = intval($lid);
		$db->sql_query("UPDATE " . $prefix . "_links_votedata SET ratingcomments='' WHERE ratingdbid = '$rid'");
		$db->sql_query("UPDATE " . $prefix . "_links_links SET totalcomments = (totalcomments - 1) WHERE lid = '$lid'");
		Header("Location: ".$admin_file.".php?op=LinksModLink&lid=$lid");

	}

	function LinksDelVote($lid, $rid) {
		global $prefix, $db, $admin_file;
		$rid = intval($rid);
		$lid = intval($lid);
		$db->sql_query("delete from " . $prefix . "_links_votedata where ratingdbid=$rid");
		$voteresult = $db->sql_query("SELECT rating, ratinguser, ratingcomments FROM " . $prefix . "_links_votedata WHERE ratinglid = '$lid'");
		$totalvotesDB = $db->sql_numrows($voteresult);
		include ("voteinclude.php");
		$db->sql_query("UPDATE " . $prefix . "_links_links SET linkratingsummary='$finalrating', totalvotes='$totalvotesDB', totalcomments='$truecomments' WHERE lid = '$lid'");
		Header("Location: ".$admin_file.".php?op=LinksModLink&lid=$lid");
	}

	function LinksEditBrokenLinks($lid) {
		global $prefix, $db, $admin_file;
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"option\"><b>" . _EZBROKENLINKS . "</b></font></center><br><br>";
		$row = $db->sql_fetchrow($db->sql_query("SELECT requestid, lid, cid, title, url, description, modifysubmitter from " . $prefix . "_links_modrequest where brokenlink='1' order by requestid"));
		$requestid = intval($row['requestid']);
		$lid = intval($row['lid']);
		$cid = intval($row['cid']);
		$title = filter($row['title'], "nohtml");
		$url = filter($row['url'], "nohtml");
		$url2 = urlencode($url);
		$description = filter($row['description']);
		$modifysubmitter = $row['modifysubmitter'];
		$row2 = $db->sql_fetchrow($db->sql_query("SELECT name,email,hits from " . $prefix . "_links_links where lid='$lid'"));
		$name = filter($row2['name'], "nohtml");
		$email = filter($row2['email'], "nohtml");
		$hits = intval($row2['hits']);
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<b>" . _LINKID . ": $lid</b><br><br>"
		."" . _SUBMITTER . ":  $modifysubmitter<br>"
		."" . _PAGETITLE . ": <input type=\"text\" name=\"title\" value=\"$title\" size=\"50\" maxlength=\"100\"><br>"
		."" . _PAGEURL . ": <input type=\"text\" name=\"url\" value=\"$url\" size=\"50\" maxlength=\"100\">&nbsp;[ <a href=\"index.php?url=$url2\" target=\"_blank\">" . _VISIT . "</a> ]<br>"
		."" . _DESCRIPTION . ": <br><textarea name=\"description\" cols=\"70\" rows=\"15\">$description</textarea><br>"
		."" . _NAME . ": <input type=\"text\" name=\"name\" size=\"20\" maxlength=\"100\" value=\"$name\">&nbsp;&nbsp;"
		."" . _EMAIL . ": <input type=\"text\" name=\"email\" size=\"20\" maxlength=\"100\" value=\"$email\"><br>";
		echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\">";
		echo "<input type=\"hidden\" name=\"hits\" value=\"$hits\">";
		echo "" . _CATEGORY . ": <select name=\"cat\">";
		$result = $db->sql_query("SELECT cid, title, parentid from " . $prefix . "_links_categories order by title");
		while ($row = $db->sql_fetchrow($result)) {
			$cid2 = intval($row['cid']);
			$ctitle2 = filter($row['title'], "nohtml");
			$parentid2 = intval($row['parentid']);
			if ($cid2==$cid) {
				$sel = "selected";
			} else {
				$sel = "";
			}
			if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
			echo "<option value=\"$cid2\" $sel>$ctitle2</option>";
		}
		echo "</select><input type=\"hidden\" name=\"op\" value=\"LinksModLinkS\"><input type=\"submit\" value=" . _MODIFY . "> [ <a href=\"".$admin_file.".php?op=LinksDelNew&amp;lid=$lid\">" . _DELETE . "</a> ]</form><br><hr noshade><br>";
		CloseTable();
		echo "<br>";
		include("footer.php");
	}

	function LinksListBrokenLinks() {
		global $bgcolor1, $bgcolor2, $prefix, $db, $user_prefix, $admin_file;
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>" . _WEBLINKSADMIN . "</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		$result = $db->sql_query("SELECT requestid, lid, modifysubmitter from " . $prefix . "_links_modrequest where brokenlink='1' order by requestid");
		$totalbrokenlinks = $db->sql_numrows($result);
		echo "<center><font class=\"option\"><b>" . _USERREPBROKEN . " ($totalbrokenlinks)</b></font></center><br><br><center>"
		."" . _IGNOREINFO . "<br>"
		."" . _DELETEINFO . "</center><br><br><br>"
		."<table align=\"center\" width=\"450\">";
		if ($totalbrokenlinks==0) {
			echo "<center><font class=\"option\">" . _NOREPORTEDBROKEN . "</font></center><br><br><br>";
		} else {
			$colorswitch = $bgcolor2;
			echo "<tr>"
			."<td><b>" . _LINK . "</b></td>"
			."<td><b>" . _SUBMITTER . "</b></td>"
			."<td><b>" . _LINKOWNER . "</b></td>"
			."<td><b>" . _EDIT . "</b></td>"
			."<td><b>" . _IGNORE . "</b></td>"
			."<td><b>" . _DELETE . "</b></td>"
			."</tr>";
			while($row = $db->sql_fetchrow($result)) {
				$requestid = intval($row['requestid']);
				$lid = intval($row['lid']);
				$modifysubmitter = filter($row['modifysubmitter'], "nohtml");
				$result2 = $db->sql_query("SELECT title, url, submitter from " . $prefix . "_links_links where lid='$lid'");
				if ($modifysubmitter != '$anonymous') {
					$row3 = $db->sql_fetchrow($db->sql_query("SELECT user_email from " . $user_prefix . "_users where username='$modifysubmitter'"));
					$email = filter($row3['user_email'], "nohtml");
				}
				$row2 = $db->sql_fetchrow($result2);
				$title = filter($row2['title'], "nohtml");
				$url = filter($row2['url'], "nohtml");
				$url2 = urlencode($url);
				$owner = filter($row2['submitter'], "nohtml");
				$row4 = $db->sql_fetchrow($db->sql_query("SELECT user_email from " . $user_prefix . "_users where username='$owner'"));
				$owneremail = filter($row4['user_email'], "nohtml");
				$url = urlencode($url);
				echo "<tr>"
				."<td bgcolor=\"$colorswitch\"><a href=\"index.php?url=$url2\">$title</a>"
				."</td>";
				if (empty($email)) {
					echo "<td bgcolor=\"$colorswitch\">$modifysubmitter";
				} else {
					echo "<td bgcolor=\"$colorswitch\"><a href=\"mailto:$email\">$modifysubmitter</a>";
				}
				echo "</td>";
				if (empty($owneremail)) {
					echo "<td bgcolor=\"$colorswitch\">$owner";
				} else {
					echo "<td bgcolor=\"$colorswitch\"><a href=\"mailto:$owneremail\">$owner</a>";
				}
				echo "</td>"
				."<td bgcolor=\"$colorswitch\"><center><a href=\"".$admin_file.".php?op=LinksEditBrokenLinks&amp;lid=$lid\">X</a></center>"
				."<td bgcolor=\"$colorswitch\"><center><a href=\"".$admin_file.".php?op=LinksIgnoreBrokenLinks&amp;lid=$lid\">X</a></center>"
				."</td>"
				."<td bgcolor=\"$colorswitch\"><center><a href=\"".$admin_file.".php?op=LinksDelBrokenLinks&amp;lid=$lid\">X</a></center>"
				."</td>"
				."</tr>";
				if ($colorswitch == $bgcolor2) {
					$colorswitch = $bgcolor1;
				} else {
					$colorswitch = $bgcolor2;
				}
			}
		}
		echo "</table>";
		CloseTable();
		include ("footer.php");
	}

	function LinksDelBrokenLinks($lid) {
		global $prefix, $db, $admin_file;
		$lid = intval($lid);
		$db->sql_query("delete from " . $prefix . "_links_modrequest where lid='$lid'");
		$db->sql_query("delete from " . $prefix . "_links_links where lid='$lid'");
		Header("Location: ".$admin_file.".php?op=LinksListBrokenLinks");
	}

	function LinksIgnoreBrokenLinks($lid) {
		global $prefix, $db, $admin_file;
		$db->sql_query("delete from " . $prefix . "_links_modrequest where lid='$lid' and brokenlink='1'");
		Header("Location: ".$admin_file.".php?op=LinksListBrokenLinks");
	}

	function LinksListModRequests() {
		global $bgcolor2, $prefix, $db, $user_prefix, $admin_file;
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>" . _WEBLINKSADMIN . "</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		$result = $db->sql_query("SELECT requestid, lid, cid, sid, title, url, description, modifysubmitter from " . $prefix . "_links_modrequest where brokenlink='0' order by requestid");
		$totalmodrequests = $db->sql_numrows($result);
		echo "<center><font class=\"option\"><b>" . _USERMODREQUEST . " ($totalmodrequests)</b></font></center><br><br><br>";
		echo "<table width=\"95%\"><tr><td>";
		while($row = $db->sql_fetchrow($result)) {
			$requestid = intval($row['requestid']);
			$lid = intval($row['lid']);
			$cid = intval($row['cid']);
			$sid = intval($row['sid']);
			$title = filter($row['title'], "nohtml");
			$url = filter($row['url'], "nohtml");
			$url = urlencode($url);
			$description = filter($row['description']);
			$xdescription = eregi_replace("<a href=\"http://", "<a href=\"index.php?url=http://", $description);
			$modifysubmitter = filter($row['modifysubmitter'], "nohtml");
			$row2 = $db->sql_fetchrow($db->sql_query("SELECT cid, sid, title, url, description, submitter from " . $prefix . "_links_links where lid='$lid'"));
			$origcid = intval($row2['cid']);
			$origsid = intval($row2['sid']);
			$origtitle = filter($row2['title'], "nohtml");
			$origurl = filter($row2['url'], "nohtml");
			$origurl = urlencode($origurl);
			$origdescription = filter($row2['description']);
			$xorigdescription = eregi_replace("<a href=\"http://", "<a href=\"index.php?url=http://", $xorigdescription);
			$owner = filter($row2['submitter'], "nohtml");
			$result3 = $db->sql_query("SELECT title from " . $prefix . "_links_categories where cid='$cid'");
			$result5 = $db->sql_query("SELECT title from " . $prefix . "_links_categories where cid='$origcid'");
			$result7 = $db->sql_query("SELECT user_email from " . $user_prefix . "_users where username='$modifysubmitter'");
			$result8 = $db->sql_query("SELECT user_email from " . $user_prefix . "_users where username='$owner'");
			$row3 = $db->sql_fetchrow($result3);
			$cidtitle = filter($row3['title'], "nohtml");
			$row5 = $db->sql_fetchrow($result5);
			$origcidtitle = filter($row5['title'], "nohtml");
			$row7 = $db->sql_fetchrow($result7);
			$modifysubmitteremail = filter($row7['user_email'], "nohtml");
			$row8 = $db->sql_fetchrow($result8);
			$owneremail = filter($row8['user_email'], "nohtml");
			if (empty($owner)) {
				$owner = _OWNERISADMIN;
			}
			if (empty($origsidtitle)) {
				$origsidtitle = "-----";
			}
			if (empty($sidtitle)) {
				$sidtitle = "-----";
			}
			echo "<table border=\"1\" bordercolor=\"black\" cellpadding=\"5\" cellspacing=\"0\" align=\"center\" width=\"450\">"
			."<tr>"
			."<td>"
			."<table width=\"100%\" bgcolor=\"$bgcolor2\">"
			."<tr>"
			."<td valign=\"top\" width=\"45%\"><b>" . _ORIGINAL . "</b></td>"
			."<td rowspan=\"5\" valign=\"top\" align=\"left\"><font class=\"tiny\"><br>" . _DESCRIPTION . ":<br>$xorigdescription</font></td>"
			."</tr>"
			."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _TITLE . ": $origtitle</td></tr>"
			."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _URL . ": <a href=\"index.php?url=$origurl\">$origurl</a></td></tr>"
			."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _CATEGORY . ": $origcidtitle</td></tr>"
			."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _SUBCATEGORY . ": $origsidtitle</td></tr>"
			."</table>"
			."</td>"
			."</tr>"
			."<tr>"
			."<td>"
			."<table width=\"100%\">"
			."<tr>"
			."<td valign=\"top\" width=\"45%\"><b>" . _PROPOSED . "</b></td>"
			."<td rowspan=\"5\" valign=\"top\" align=\"left\"><font class=\"tiny\"><br>" . _DESCRIPTION . ":<br>$xdescription</font></td>"
			."</tr>"
			."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _TITLE . ": $title</td></tr>"
			."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _URL . ": <a href=\"index.php?url=$url\">$url</a></td></tr>"
			."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _CATEGORY . ": $cidtitle</td></tr>"
			."<tr><td valign=\"top\" width=\"45%\"><font class=\"tiny\">" . _SUBCATEGORY . ": $sidtitle</td></tr>"
			."</table>"
			."</td>"
			."</tr>"
			."</table>"
			."<table align=\"center\" width=\"450\">"
			."<tr>";
			if (empty($modifysubmitteremail)) {
				echo "<td align=\"left\"><font class=\"tiny\">" . _SUBMITTER . ":  $modifysubmitter</font></td>";
			} else {
				echo "<td align=\"left\"><font class=\"tiny\">" . _SUBMITTER . ":  <a href=\"mailto:$modifysubmitteremail\">$modifysubmitter</a></font></td>";
			}
			if (empty($owneremail)) {
				echo "<td align=\"center\"><font class=\"tiny\">" . _OWNER . ":  $owner</font></td>";
			} else {
				echo "<td align=\"center\"><font class=\"tiny\">" . _OWNER . ": <a href=\"mailto:$owneremail\">$owner</a></font></td>";
			}
			echo "<td align=\"right\"><font class=\"tiny\">( <a href=\"".$admin_file.".php?op=LinksChangeModRequests&amp;requestid=$requestid\">" . _ACCEPT . "</a> / <a href=\"".$admin_file.".php?op=LinksChangeIgnoreRequests&amp;requestid=$requestid\">" . _IGNORE . "</a> )</font></td></tr></table>";
		}
		if ($totalmodrequests == 0) {
			echo "<center>" . _NOMODREQUESTS . "</center><br><br>";
		}
		echo "</td></tr></table>";
		CloseTable();
		include ("footer.php");
	}

	function LinksChangeModRequests($requestid) {
		global $prefix, $db, $admin_file;
		$requestid = intval($requestid);
		$result = $db->sql_query("SELECT requestid, lid, cid, sid, title, url, description from " . $prefix . "_links_modrequest where requestid='$requestid'");
		while ($row = $db->sql_fetchrow($result)) {
			$requestid = intval($row['requestid']);
			$lid = intval($row['lid']);
			$cid = intval($row['cid']);
			$sid = intval($row['sid']);
			$title = filter($row['title'], "nohtml", 1);
			$url = filter($row['url'], "nohtml", 1);
			$description = filter($row['description'], "", 1);
			$db->sql_query("UPDATE " . $prefix . "_links_links SET cid='$cid', sid='$sid', title='$title', url='$url', description='$description' WHERE lid = '$lid'");
		}
		$db->sql_query("delete from " . $prefix . "_links_modrequest where requestid='$requestid'");
		Header("Location: ".$admin_file.".php?op=LinksListModRequests");
	}

	function LinksChangeIgnoreRequests($requestid) {
		global $prefix, $db, $admin_file;
		$requestid = intval($requestid);
		$db->sql_query("delete from " . $prefix . "_links_modrequest where requestid=$requestid");
		Header("Location: ".$admin_file.".php?op=LinksListModRequests");
	}

	function LinksCleanVotes() {
		global $prefix, $db, $admin_file;
		$result = $db->sql_query("SELECT distinct ratinglid FROM " .$prefix  . "_links_votedata");
		while ($row = $db->sql_fetchrow($result)) {
			$lid = intval($row['ratinglid']);
			$voteresult = $db->sql_query("SELECT rating, ratinguser, ratingcomments FROM " . $prefix . "_links_votedata WHERE ratinglid = '$lid'");
			$totalvotesDB = $db->sql_numrows($voteresult);
			include ("voteinclude.php");
			$db->sql_query("UPDATE " . $prefix . "_links_links SET linkratingsummary='$finalrating', totalvotes='$totalvotesDB', totalcomments='$truecomments' WHERE lid = '$lid'");
		}
		Header("Location: ".$admin_file.".php?op=Links");
	}

	function LinksModLinkS($lid, $title, $url, $description, $name, $email, $hits, $cat) {
		global $prefix, $db, $admin_file;
		$cat = explode("-", $cat);
		if (empty($cat[1])) {
			$cat[1] = 0;
		}
		$title = filter($title, "nohtml", 1);
		$url = filter($url, "nohtml", 1);
		$description = filter($description, "", 1);
		$name = filter($name, "nohtml", 1);
		$email = filter($email, "nohtml", 1);
		$hists = intval($hits);
		$db->sql_query("update " . $prefix . "_links_links set cid='$cat[0]', sid='$cat[1]', title='$title', url='$url', description='$description', name='$name', email='$email', hits='$hits' where lid='$lid'");
		$sql = "SELECT * FROM " . $prefix . "_links_modrequest where lid='$lid'";
		$result = $db->sql_query($sql);
		$numrows = $db->sql_numrows($result);
		if ($numrows>0) {
		$db->sql_query("delete from " . $prefix . "_links_modrequest where lid='$lid'");
		}
		Header("Location: ".$admin_file.".php?op=Links");
	}

	function LinksDelLink($lid) {
		global $prefix, $db, $admin_file;
		$lid = intval($lid);
		$db->sql_query("delete from " . $prefix . "_links_links where lid='$lid'");
		$sql = "SELECT * FROM " . $prefix . "_links_modrequest where lid='$lid'";
		$result = $db->sql_query($sql);
		$numrows = $db->sql_numrows($result);
		if ($numrows>0) {
		$db->sql_query("delete from " . $prefix . "_links_modrequest where lid='$lid'");
		}
		Header("Location: ".$admin_file.".php?op=Links");
	}

	function LinksModCat($cat) {
		global $prefix, $db, $admin_file;
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>" . _WEBLINKSADMIN . "</b></font></center>";
		CloseTable();
		echo "<br>";
		$cat = explode("-", $cat);
		if (empty($cat[1])) {
			$cat[1] = 0;
		}
		OpenTable();
		echo "<center><font class=\"option\"><b>" . _MODCATEGORY . "</b></font></center><br><br>";
		if ($cat[1]==0) {
			$row = $db->sql_fetchrow($db->sql_query("SELECT title, cdescription from " . $prefix . "_links_categories where cid='$cat[0]'"));
			$title = filter($row['title'], "nohtml");
			$cdescription = filter($row['cdescription']);
			echo "<form action=\"".$admin_file.".php\" method=\"get\">"
			."" . _NAME . ": <input type=\"text\" name=\"title\" value=\"$title\" size=\"51\" maxlength=\"50\"><br>"
			."" . _DESCRIPTION . ":<br><textarea name=\"cdescription\" cols=\"70\" rows=\"15\">$cdescription</textarea><br>"
			."<input type=\"hidden\" name=\"sub\" value=\"0\">"
			."<input type=\"hidden\" name=\"cid\" value=\"$cat[0]\">"
			."<input type=\"hidden\" name=\"op\" value=\"LinksModCatS\">"
			."<table border=\"0\"><tr><td>"
			."<input type=\"submit\" value=\"" . _SAVECHANGES . "\"></form></td><td>"
			."<form action=\"".$admin_file.".php\" method=\"get\">"
			."<input type=\"hidden\" name=\"sub\" value=\"0\">"
			."<input type=\"hidden\" name=\"cid\" value=\"$cat[0]\">"
			."<input type=\"hidden\" name=\"op\" value=\"LinksDelCat\">"
			."<input type=\"submit\" value=\"" . _DELETE . "\"></form></td></tr></table>";
		} else {
			$row2 = $db->sql_fetchrow($db->sql_query("SELECT title from " . $prefix . "_links_categories where cid='$cat[0]'"));
			$ctitle = filter($row2['title'], "nohtml");
			$row3 = $db->sql_fetchrow($db->sql_query("SELECT title from " . $prefix . "_links_subcategories where sid='$cat[1]'"));
			$stitle = filter($row3['title'], "nohtml");
			echo "<form action=\"".$admin_file.".php\" method=\"get\">"
			."" . _CATEGORY . ": $ctitle<br>"
			."" . _SUBCATEGORY . ": <input type=\"text\" name=\"title\" value=\"$stitle\" size=\"51\" maxlength=\"50\"><br>"
			."<input type=\"hidden\" name=\"sub\" value=\"1\">"
			."<input type=\"hidden\" name=\"cid\" value=\"$cat[0]\">"
			."<input type=\"hidden\" name=\"sid\" value=\"$cat[1]\">"
			."<input type=\"hidden\" name=\"op\" value=\"LinksModCatS\">"
			."<table border=\"0\"><tr><td>"
			."<input type=\"submit\" value=\"" . _SAVECHANGES . "\"></form></td><td>"
			."<form action=\"".$admin_file.".php\" method=\"get\">"
			."<input type=\"hidden\" name=\"sub\" value=\"1\">"
			."<input type=\"hidden\" name=\"cid\" value=\"$cat[0]\">"
			."<input type=\"hidden\" name=\"sid\" value=\"$cat[1]\">"
			."<input type=\"hidden\" name=\"op\" value=\"LinksDelCat\">"
			."<input type=\"submit\" value=\"" . _DELETE . "\"></form></td></tr></table>";
		}
		CloseTable();
		include("footer.php");
	}

	function LinksModCatS($cid, $sid, $sub, $title, $cdescription) {
		global $prefix, $db, $admin_file;
		$cid = intval($cid);
		$sid = intval($sid);
		$sub = intval($sub);
		$title = filter($title, "nohtml", 1);
		$cdescription = filter($cdescription, "", 1);
		if ($sub==0) {
			$db->sql_query("update " . $prefix . "_links_categories set title='$title', cdescription='$cdescription' where cid='$cid'");
		} else {
			$db->sql_query("update " . $prefix . "_links_subcategories set title='$title' where sid='$sid'");
		}
		Header("Location: ".$admin_file.".php?op=Links");
	}

	function LinksDelCat($cid, $sid, $sub, $ok=0) {
		global $prefix, $db, $admin_file;
		include("header.php");
		$cid = intval($cid);
		$sid = intval($sid);
		$sub = intval($sub);
		if($ok==1) {
			if ($sub>0) {
				$db->sql_query("delete from " . $prefix . "_links_categories where cid='$cid'");
				$db->sql_query("delete from " . $prefix . "_links_links where cid='$cid'");
			} else {
				$db->sql_query("delete from " . $prefix . "_links_links where cid='$cid'");
				// suppression des liens de catégories filles
				$result2 = $db->sql_query("SELECT cid from " . $prefix . "_links_categories where parentid='$cid'");
				while ($row2 = $db->sql_fetchrow($result2)) {
					$cid2 = intval($row2['cid']);
					$db->sql_query("delete from " . $prefix . "_links_links where cid='$cid2'");
				}
				$db->sql_query("delete from " . $prefix . "_links_categories where parentid='$cid'");
				$db->sql_query("delete from " . $prefix . "_links_categories where cid='$cid'");
			}
			Header("Location: ".$admin_file.".php?op=Links");
		} else {
			$result = $db->sql_query("SELECT * from " . $prefix . "_links_categories where parentid='$cid'");
			$nbsubcat = $db->sql_numrows($result);
			$result3 = $db->sql_query("SELECT cid from " . $prefix . "_links_categories where parentid='$cid'");
			while ($row3 = $db->sql_fetchrow($result3)) {
				$cid2 = intval($row3['cid']);
				$result4 = $db->sql_query("SELECT * from " . $prefix . "_links_links where cid='$cid2'");
				$nblink += $db->sql_numrows($result4);
			}
			GraphicAdmin();
			OpenTable();
			echo "<br><center><font class=\"option\">";
			echo "<b>" . _EZTHEREIS . " $nbsubcat " . _EZSUBCAT . " " . _EZATTACHEDTOCAT . "</b><br>";
			echo "<b>" . _EZTHEREIS . " $nblink " . _links . " " . _EZATTACHEDTOCAT . "</b><br>";
			echo "<b>" . _DELEZLINKCATWARNING . "</b><br><br>";
		}
		echo "[ <a href=\"".$admin_file.".php?op=LinksDelCat&amp;cid=$cid&amp;sid=$sid&amp;sub=$sub&amp;ok=1\">" . _YES . "</a> | <a href=\"".$admin_file.".php?op=Links\">" . _NO . "</a> ]<br><br>";
		CloseTable();
		include("footer.php");
	}

	function LinksDelNew($lid) {
		global $prefix, $db, $admin_file;
		$lid = intval($lid);
		$db->sql_query("delete from " . $prefix . "_links_newlink where lid='$lid'");
		Header("Location: ".$admin_file.".php?op=Links");
	}

	function LinksAddCat($title, $cdescription) {
		global $prefix, $db, $admin_file;
		$parentid = 0;
		$title = filter($title, "nohtml", 1);
		$cdescription = filter($cdescription, "", 1);
		$result = $db->sql_query("SELECT cid from " . $prefix . "_links_categories where title='$title'");
		$numrows = $db->sql_numrows($result);
		if ($numrows>0) {
			include("header.php");
			GraphicAdmin();
			OpenTable();
			echo "<br><center><font class=\"option\">"
			."<b>" . _ERRORTHECATEGORY . " $title " . _ALREADYEXIST . "</b><br><br>"
			."" . _GOBACK . "<br><br>";
			CloseTable();
			include("footer.php");
		} else {
			$db->sql_query("insert into " . $prefix . "_links_categories values (NULL, '$title', '$cdescription', '$parentid')");
			Header("Location: ".$admin_file.".php?op=Links");
		}
	}

	function LinksAddSubCat($cid, $title, $cdescription) {
		global $prefix, $db, $admin_file;
		$cid = intval($cid);
		$title = filter($title, "nohtml", 1);
		$cdescription = filter($cdescription, "", 1);
		$result = $db->sql_query("SELECT cid from " . $prefix . "_links_categories where title='$title' AND cid='$cid'");
		$numrows = $db->sql_numrows($result);
		if ($numrows>0) {
			include("header.php");
			GraphicAdmin();
			OpenTable();
			echo "<br><center>";
			echo "<font class=\"option\">"
			."<b>" . _ERRORTHESUBCATEGORY . " $title " . _ALREADYEXIST . "</b><br><br>"
			."" . _GOBACK . "<br><br>";
			include("footer.php");
		} else {
			$db->sql_query("insert into " . $prefix . "_links_categories values (NULL, '$title', '$cdescription', '$cid')");
			Header("Location: ".$admin_file.".php?op=Links");
		}
	}

	function LinksAddEditorial($linkid, $editorialtitle, $editorialtext) {
		global $aid, $prefix, $db, $admin_file;
		$linkid = intval($linkid);
		$editorialtext = filter($editorialtext, "", 1);
		$editorialtitle = filter($editorialtitle, "nohtml", 1);
		$db->sql_query("insert into " . $prefix . "_links_editorials values ('$linkid', '$aid', now(), '$editorialtext', '$editorialtitle')");
		include("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><br>"
		."<font class=option>"
		."" . _EDITORIALADDED . "<br><br>"
		."[ <a href=\"".$admin_file.".php?op=Links\">" . _WEBLINKSADMIN . "</a> ]<br><br>";
		echo "$linkid  $adminid, $editorialtitle, $editorialtext";
		CloseTable();
		include("footer.php");
	}

	function LinksModEditorial($linkid, $editorialtitle, $editorialtext) {
		global $prefix, $db, $admin_file;
		$linkid = intval($linkid);
		$editorialtext = filter($editorialtext, "", 1);
		$editorialtitle = filter($editorialtitle, "nohtml", 1);
		$editorialtext = stripslashes(FixQuotes($editorialtext));
		$db->sql_query("update " . $prefix . "_links_editorials set editorialtext='$editorialtext', editorialtitle='$editorialtitle' where linkid='$linkid'");
		include("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<br><center>"
		."<font class=\"option\">"
		."" . _EDITORIALMODIFIED . "<br><br>"
		."[ <a href=\"".$admin_file.".php?op=Links\">" . _WEBLINKSADMIN . "</a> ]<br><br>";
		CloseTable();
		include("footer.php");
	}

	function LinksDelEditorial($linkid) {
		global $prefix, $db, $admin_file;
		$linkid = intval($linkid);
		$db->sql_query("delete from " . $prefix . "_links_editorials where linkid='$linkid'");
		include("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<br><center>"
		."<font class=\"option\">"
		."" . _EDITORIALREMOVED . "<br><br>"
		."[ <a href=\"".$admin_file.".php?op=Links\">" . _WEBLINKSADMIN . "</a> ]<br><br>";
		CloseTable();
		include("footer.php");
	}

	function LinksLinkCheck() {
		global $prefix, $db, $admin_file;
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>" . _WEBLINKSADMIN . "</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"option\"><b>" . _LINKVALIDATION . "</b></font></center><br>"
		."<table width=\"100%\" align=\"center\"><tr><td colspan=\"2\" align=\"center\">"
		."<a href=\"".$admin_file.".php?op=LinksValidate&amp;cid=0&amp;sid=0\">" . _CHECKALLLINKS . "</a><br><br></td></tr>"
		."<tr><td valign=\"top\"><center><b>" . _CHECKCATEGORIES . "</b><br>" . _INCLUDESUBCATEGORIES . "<br><br><font class=\"tiny\">";
		$result = $db->sql_query("SELECT cid, title from " . $prefix . "_links_categories order by title");
		while ($row = $db->sql_fetchrow($result)) {
			$cid = intval($row['cid']);
			$title = filter($row['title'], "nohtml");
			$transfertitle = str_replace (" ", "_", $title);
			echo "<a href=\"".$admin_file.".php?op=LinksValidate&amp;cid=$cid&amp;sid=0&amp;ttitle=$transfertitle\">$title</a><br>";
		}
		echo "</font></center></td></tr></table>";
		CloseTable();
		include ("footer.php");
	}

	function LinksValidate($cid, $sid, $ttitle) {
		global $bgcolor2, $prefix, $db, $admin_file;
		$cid = intval($cid);
		$sid = intval($sid);
		$title = filter($title, "nohtml");
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>" . _WEBLINKSADMIN . "</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		$transfertitle = str_replace ("_", "", $ttitle);
		/* Check ALL Links */
		echo "<table width=100% border=0>";
		if ($cid==0 && $sid==0) {
			echo "<tr><td colspan=\"3\"><center><b>" . _CHECKALLLINKS . "</b><br>" . _BEPATIENT . "</center><br><br></td></tr>";
			$result = $db->sql_query("SELECT lid, title, url from " . $prefix . "_links_links order by title");
		}
		/* Check Categories & Subcategories */
		if ($cid!=0 && $sid==0) {
			echo "<tr><td colspan=\"3\"><center><b>" . _VALIDATINGCAT . ": $transfertitle</b><br>" . _BEPATIENT . "</center><br><br></td></tr>";
			$result = $db->sql_query("SELECT lid, title, url from " . $prefix . "_links_links where cid='$cid' order by title");
		}
		/* Check Only Subcategory */
		if ($cid==0 && $sid!=0) {
			echo "<tr><td colspan=\"3\"><center><b>" . _VALIDATINGSUBCAT . ": $transfertitle</b><br>" . _BEPATIENT . "</center><br><br></td></tr>";
			$result = $db->sql_query("SELECT lid, title, url from " . $prefix . "_links_links where sid='$sid' order by title");
		}
		echo "<tr><td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _STATUS . "</b></td><td bgcolor=\"$bgcolor2\" width=\"100%\"><b>" . _LINKTITLE . "</b></td><td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _FUNCTIONS . "</b></td></tr>";
		while($row = $db->sql_fetchrow($result)) {
			$lid = intval($row3['lid']);
			$title = filter($row['title'], "nohtml");
			$row['url'] = filter($row['url'], "nohtml");
			$vurl = parse_url($row['url']);
			$fp = fsockopen($vurl['host'], 80, $errno, $errstr, 15);
			if (!$fp){
				echo "<tr><td align=\"center\"><b>&nbsp;&nbsp;" . _FAILED . "&nbsp;&nbsp;</b></td>"
				."<td>&nbsp;&nbsp;<a href=\"$url\" target=\"new\">$title</a>&nbsp;&nbsp;</td>"
				."<td align=\"center\"><font class=\"content\">&nbsp;&nbsp;[ <a href=\"".$admin_file.".php?op=LinksModLink&amp;lid=$lid\">" . _EDIT . "</a> | <a href=\"".$admin_file.".php?op=LinksDelLink&amp;lid=$lid\">" . _DELETE . "</a> ]&nbsp;&nbsp;</font>"
				."</td></tr>";
			}
			if ($fp){
				echo "<tr><td align=\"center\">&nbsp;&nbsp;" . _OK . "&nbsp;&nbsp;</td>"
				."<td>&nbsp;&nbsp;<a href=\"$url\" target=\"new\">$title</a>&nbsp;&nbsp;</td>"
				."<td align=\"center\"><font class=\"content\">&nbsp;&nbsp;" . _NONE . "&nbsp;&nbsp;</font>"
				."</td></tr>";
			}
		}
		echo "</table>";
		CloseTable();
		include ("footer.php");
	}

	function LinksAddLink($new, $lid, $title, $url, $cat, $description, $name, $email, $submitter) {
		global $prefix, $db, $sitename, $nukeurl, $admin_file;
		$title = filter($title, "nohtml", 1);
		$url = filter($url, "nohtml", 1);
		$description = filter($description, "", 1);
		$name = filter($name, "nohtml", 1);
		$email = filter($email, "nohtml", 1);
		$submitter = filter($submitter, "nohtml", 1);
		$result = $db->sql_query("SELECT url from " . $prefix . "_links_links where url='$url'");
		$numrows = $db->sql_numrows($result);
		if ($numrows>0) {
			include("header.php");
			GraphicAdmin();
			OpenTable();
			echo "<center><font class=\"title\"><b>" . _WEBLINKSADMIN . "</b></font></center>";
			CloseTable();
			echo "<br>";
			OpenTable();
			echo "<br><center>"
			."<font class=\"option\">"
			."<b>" . _ERRORURLEXIST . "</b><br><br>"
			."" . _GOBACK . "<br><br>";
			CloseTable();
			include("footer.php");
		} else {
			/* Check if Title exist */
			if (empty($title)) {
				include("header.php");
				GraphicAdmin();
				OpenTable();
				echo "<center><font class=\"title\"><b>" . _WEBLINKSADMIN . "</b></font></center>";
				CloseTable();
				echo "<br>";
				OpenTable();
				echo "<br><center>"
				."<font class=\"option\">"
				."<b>" . _ERRORNOTITLE . "</b><br><br>"
				."" . _GOBACK . "<br><br>";
				CloseTable();
				include("footer.php");
			}
			/* Check if URL exist */
			if (empty($url)) {
				include("header.php");
				GraphicAdmin();
				OpenTable();
				echo "<center><font class=\"title\"><b>" . _WEBLINKSADMIN . "</b></font></center>";
				CloseTable();
				echo "<br>";
				OpenTable();
				echo "<br><center>"
				."<font class=\"option\">"
				."<b>" . _ERRORNOURL . "</b><br><br>"
				."" . _GOBACK . "<br><br>";
				CloseTable();
				include("footer.php");
			}
			// Check if Description exist
			if (empty($description)) {
				include("header.php");
				GraphicAdmin();
				OpenTable();
				echo "<center><font class=\"title\"><b>" . _WEBLINKSADMIN . "</b></font></center>";
				CloseTable();
				echo "<br>";
				OpenTable();
				echo "<br><center>"
				."<font class=\"option\">"
				."<b>" . _ERRORNODESCRIPTION . "</b><br><br>"
				."" . _GOBACK . "<br><br>";
				CloseTable();
				include("footer.php");
			}
			$cat = explode("-", $cat);
			if (empty($cat[1])) {
				$cat[1] = 0;
			}
			$db->sql_query("insert into " . $prefix . "_links_links values (NULL, '$cat[0]', '$cat[1]', '$title', '$url', '$description', now(), '$name', '$email', '0', '$submitter', '0', '0', '0')");
			global $nukeurl, $sitename;
			include("header.php");
			GraphicAdmin();
			OpenTable();
			echo "<br><center>";
			echo "<font class=\"option\">";
			echo "" . _NEWLINKADDED . "<br><br>";
			echo "[ <a href=\"".$admin_file.".php?op=Links\">" . _WEBLINKSADMIN . "</a> ]</center><br><br>";
			CloseTable();
			if ($new==1) {
				$db->sql_query("delete from " . $prefix . "_links_newlink where lid='$lid'");
				if (empty($email)) {
				} else {
					$subject = "" . _YOURLINKAT . " $sitename";
					$message = "" . _HELLO . " $name:\n\n" . _LINKAPPROVEDMSG . "\n\n" . _LINKTITLE . ": $title\n" . _URL . ": $url\n" . _DESCRIPTION . ": $description\n\n\n" . _YOUCANBROWSEUS . " $nukeurl/modules.php?name=Web_Links\n\n" . _THANKS4YOURSUBMISSION . "\n\n$sitename " . _TEAM . "";
					$from = "$sitename";
					mail($email, $subject, $message, "From: $from\nX-Mailer: PHP/" . phpversion());
				}
			}
			include("footer.php");
		}
	}

	switch ($op) {

		case "Links":
		links();
		break;

		case "LinksDelNew":
		LinksDelNew($lid);
		break;

		case "LinksAddCat":
		LinksAddCat($title, $cdescription);
		break;

		case "LinksAddSubCat":
		LinksAddSubCat($cid, $title, $cdescription);
		break;

		case "LinksAddLink":
		LinksAddLink($new, $lid, $title, $url, $cat, $description, $name, $email, $submitter);
		break;

		case "LinksAddEditorial":
		LinksAddEditorial($linkid, $editorialtitle, $editorialtext);
		break;

		case "LinksModEditorial":
		LinksModEditorial($linkid, $editorialtitle, $editorialtext);
		break;

		case "LinksLinkCheck":
		LinksLinkCheck();
		break;

		case "LinksValidate":
		LinksValidate($cid, $sid, $ttitle);
		break;

		case "LinksDelEditorial":
		LinksDelEditorial($linkid);
		break;

		case "LinksCleanVotes":
		LinksCleanVotes();
		break;

		case "LinksListBrokenLinks":
		LinksListBrokenLinks();
		break;

		case "LinksEditBrokenLinks":
		LinksEditBrokenLinks($lid);
		break;

		case "LinksDelBrokenLinks":
		LinksDelBrokenLinks($lid);
		break;

		case "LinksIgnoreBrokenLinks":
		LinksIgnoreBrokenLinks($lid);
		break;

		case "LinksListModRequests":
		LinksListModRequests();
		break;

		case "LinksChangeModRequests":
		LinksChangeModRequests($requestid);
		break;

		case "LinksChangeIgnoreRequests":
		LinksChangeIgnoreRequests($requestid);
		break;

		case "LinksDelCat":
		LinksDelCat($cid, $sid, $sub, $ok);
		break;

		case "LinksModCat":
		LinksModCat($cat);
		break;

		case "LinksModCatS":
		LinksModCatS($cid, $sid, $sub, $title, $cdescription);
		break;

		case "LinksModLink":
		LinksModLink($lid);
		break;

		case "LinksModLinkS":
		LinksModLinkS($lid, $title, $url, $description, $name, $email, $hits, $cat);
		break;

		case "LinksDelLink":
		LinksDelLink($lid);
		break;

		case "LinksDelVote":
		LinksDelVote($lid, $rid);
		break;

		case "LinksDelComment":
		LinksDelComment($lid, $rid);
		break;

		case "LinksTransfer":
		LinksTransfer($cidfrom,$cidto);
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