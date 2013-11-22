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
	/* Users Groups Functions                                      */
	/*********************************************************/

	function Groups() {
		global $bgcolor2, $bgcolor4, $prefix, $user_prefix, $db, $admin_file;
		include("header.php");
		GraphicAdmin();
		title("" . _GROUPSADMIN . "");
		$grp_num = $db->sql_numrows($db->sql_query("SELECT * FROM " . $prefix . "_groups"));
		if ($grp_num == 0) {
			OpenTable();
			echo "<center><font class=\"title\"><b>" . _NOGROUPS . "</b></font></center>";
			CloseTable();
			echo "<br>";
		} else {
			OpenTable();
			echo "<center><font class=\"title\"><b>" . _UGROUPS . "</b></font></center>"
			."<br><table border=\"1\" width=\"100%\"><tr>"
			."<td align=\"center\" bgcolor=\"$bgcolor2\"><b>" . _NAME . "</b></td>"
			."<td align=\"center\" bgcolor=\"$bgcolor2\"><b>" . _DESCRIPTION . "</b></td>"
			."<td align=\"center\" bgcolor=\"$bgcolor2\"><b>" . _POINTS . "</b></td>"
			."<td align=\"center\" bgcolor=\"$bgcolor2\"><b>" . _USERSCOUNT . "</b></td>"
			."<td align=\"center\" bgcolor=\"$bgcolor2\"><b>" . _FUNCTIONS . "</b></td></tr>";
			$result = $db->sql_query("SELECT id, name, description, points FROM " . $prefix . "_groups ORDER BY points");
			while ($row = $db->sql_fetchrow($result)) {
				$id = intval($row['id']);
				$name = filter($row['name'], nohtml);
				$description = filter($row['description']);
				$points = intval($row['points']);
				$users_num = $db->sql_numrows($db->sql_query("SELECT * FROM " . $user_prefix . "_users WHERE points>='$points'"));
				echo "<tr>"
				."<td align=\"left\" nowrap>&nbsp;$name&nbsp;</td>"
				."<td align=\"left\">$description</td>"
				."<td align=\"center\">$points</td>"
				."<td align=\"center\">$users_num</td>"
				."<td align=\"center\" nowrap><font class=\"content\">&nbsp;[ <a href=\"".$admin_file.".php?op=grp_edit&amp;id=$id\">" . _EDIT . "</a> | <a href=\"".$admin_file.".php?op=grp_del&amp;id=$id\">" . _DELETE . "</a> ]&nbsp;</font></td></tr>";
			}
			echo "</table>";
			CloseTable();
			echo "<br>";
		}
		OpenTable();
		echo "<center><font class=\"option\"><b>" . _ADDNEWGROUP . "</b></font></center><br><br>"
		."<form action=\"".$admin_file.".php\" method=\"post\">"
		."<table border=\"0\" width=\"100%\">"
		."<tr><td>" . _GTITLE . ":</td><td><input type=\"text\" name=\"name\" size=\"50\" maxlength=\"255\"></td></tr>"
		."<tr><td>" . _DESCRIPTION . ":</td><td><textarea name=\"description\" cols=\"70\" rows=\"15\"></textarea></td></tr>"
		."<tr><td>" . _POINTSNEEDED . ":</td><td><input type=\"text\" name=\"points\" size=\"10\" maxlength=\"20\" value=\"0\">&nbsp;<i>(" . _ONLYNUMVAL . ")</i></td></tr>"
		."</table><br><br>"
		."<input type=\"hidden\" name=\"op\" value=\"grp_add\">"
		."<input type=\"submit\" value=\"" . _CREATEGROUP . "\"></form>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"option\"><b>" . _POINTSSYSTEM . "</b></font></center><br><br>"
		."<table border=\"1\" width=\"100%\"><tr>"
		."<td align=\"center\" bgcolor=\"$bgcolor2\"><b>" . _NAME . "</b></td>"
		."<td align=\"center\" bgcolor=\"$bgcolor2\"><b>" . _DESCRIPTION . "</b></td>"
		."<td align=\"center\" bgcolor=\"$bgcolor2\"><b>" . _POINTS . "</b></td>"
		."<td align=\"center\" bgcolor=\"$bgcolor2\"><b>" . _FUNCTIONS . "</b></td></tr>"
		."<tr>";
		$row2 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='1'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS01 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC01 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row2[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"1\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>"
		."<tr>";
		$row3 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='2'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS02 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC02 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row3[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"2\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>"
		."<tr>";
		$row4 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='3'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS03 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC03 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row4[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"3\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>"
		."<tr>";
		$row5 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='4'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS04 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC04 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row5[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"4\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>"
		."<tr>";
		$row6 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='5'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS05 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC05 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row6[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"5\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>"
		."<tr>";
		$row7 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='6'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS06 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC06 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row7[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"6\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>"
		."<tr>";
		$row8 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='7'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS07 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC07 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row8[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"7\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>"
		."<tr>";
		$row9 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='8'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS08 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC08 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row9[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"8\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>"
		."<tr>";
		$row10 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='9'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS09 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC09 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row10[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"9\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>"
		."<tr>";
		$row11 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='10'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS10 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC10 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row11[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"10\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>"
		."<tr>";
		$row12 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='11'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS11 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC11 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row12[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"11\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>"
		."<tr>";
		$row13 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='12'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS12 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC12 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row13[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"12\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>"
		."<tr>";
		$row14 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='13'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS13 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC13 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row14[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"13\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>"
		."<tr>";
		$row15 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='14'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS14 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC14 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row15[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"14\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>"
		."<tr>";
		$row16 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='15'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS15 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC15 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row16[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"15\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>"
		."<tr>";
		$row17 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='16'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS16 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC16 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row17[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"16\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>"
		."<tr>";
		$row18 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='17'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS17 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC17 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row18[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"17\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>"
		."<tr>";
		$row19 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='18'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS18 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC18 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row19[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"18\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>"
		."<tr>";
		$row20 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='19'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS19 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC19 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row20[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"19\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>"
		."<tr>";
		$row21 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='20'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS20 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC20 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row21[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"20\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>"
		."<tr>";
		$row22 = $db->sql_fetchrow($db->sql_query("SELECT points FROM " . $prefix . "_groups_points WHERE id='21'"));
		echo "<form action=\"".$admin_file.".php\" method=\"post\">"
		."<td align=\"left\" nowrap>&nbsp;" . _POINTS21 . "&nbsp;</td>"
		."<td align=\"left\">" . _DESC21 . "</td>"
		."<td align=\"center\">&nbsp;<input type=\"text\" value=\"$row22[points]\" size=\"5\" name=\"points\">&nbsp;</td>"
		."<td align=\"center\" nowrap><font class=\"content\">&nbsp;"
		."<input type=\"hidden\" name=\"id\" value=\"21\">"
		."<input type=\"hidden\" name=\"op\" value=\"points_update\">"
		."<input type=\"submit\" value=\"" . _UPDATE . "\"></form>&nbsp;</font></td></tr>";
		echo "</table>";
		CloseTable();
		include("footer.php");
	}

	function grp_add($name, $description, $points) {
		global $prefix, $db, $admin_file;
		if (!is_numeric($points) || ereg("-", $points)) {
			include("header.php");
			GraphicAdmin();
			title("" . _GROUPSADMIN . "");
			OpenTable();
			echo "<center><b>" . _GROUPADDERROR . "</b><br><br>"
			."" . _NONUMVALUE . "<br><br>"
			."" . _GOBACK . "</center>";
			CloseTable();
			include("footer.php");
		} else {
			$name = filter($name, nohtml, 1);
			$description = filter($description, "", 1);
			$points = intval($points);
			$db->sql_query("INSERT INTO " . $prefix . "_groups VALUES (NULL, '$name', '$description', '$points')");
			Header("Location: ".$admin_file.".php?op=Groups");
		}
	}

	function grp_edit($id) {
		global $prefix, $db, $admin_file;
		include("header.php");
		GraphicAdmin();
		title("" . _GROUPSADMIN . "");
		$id = intval($id);
		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_groups WHERE id='$id'"));
		$id = intval($row['id']);
		$name = filter($row['name'], nohtml);
		$description = filter($row['description']);
		$points = intval($row['points']);
		OpenTable();
		echo "<center><font class=\"option\"><b>" . _EDITGROUP . "</b></font></center><br><br>"
		."<form action=\"".$admin_file.".php\" method=\"post\">"
		."<table border=\"0\" width=\"100%\">"
		."<tr><td>" . _GTITLE . ":</td><td><input type=\"text\" name=\"name\" size=\"50\" maxlength=\"255\" value=\"$name\"></td></tr>"
		."<tr><td>" . _DESCRIPTION . ":</td><td><textarea name=\"description\" cols=\"70\" rows=\"15\">$description</textarea></td></tr>"
		."<tr><td>" . _POINTSNEEDED . ":</td><td><input type=\"text\" name=\"points\" size=\"10\" maxlength=\"20\" value=\"$points\">&nbsp;<i>(" . _ONLYNUMVAL . ")</i></td></tr>"
		."</table><br><br>"
		."<input type=\"hidden\" name=\"id\" value=\"$id\">"
		."<input type=\"hidden\" name=\"op\" value=\"grp_edit_save\">"
		."<input type=\"submit\" value=\"" . _SAVEGROUP . "\"></form>";
		CloseTable();
		include("footer.php");
	}

	function grp_edit_save($id, $name, $description, $points) {
		global $prefix, $db, $admin_file;
		$id = intval($id);
		if (!is_numeric($points)) {
			include("header.php");
			GraphicAdmin();
			title("" . _GROUPSADMIN . "");
			OpenTable();
			echo "<center><b>" . _GROUPADDERROR . "</b><br><br>"
			."" . _NONUMVALUE . "<br><br>"
			."" . _GOBACK . "</center>";
			CloseTable();
			include("footer.php");
		} else {
			$id = intval($id);
			$name = filter($name, nohtml, 1);
			$description = filter($description, "", 1);
			$points = intval($points);
			$db->sql_query("UPDATE " . $prefix . "_groups SET name='$name', description='$description', points='$points' WHERE id='$id'");
			Header("Location: ".$admin_file.".php?op=Groups");
		}
	}

	function grp_del($id, $ok=0) {
		global $prefix, $db, $admin_file;
		$id = intval($id);
		if ($ok == 0) {
			include("header.php");
			GraphicAdmin();
			title("" . _GROUPSADMIN . "");
			OpenTable();
			$row = $db->sql_fetchrow($db->sql_query("SELECT name FROM " . $prefix . "_groups WHERE id='$id'"));
			$name = filter($row['name'], nohtml);
			echo "<center><b>" . _GROUPDELETE . "</b><br><br>"
			."" . _SUREGRPDEL1 . " <b>$name</b><br><br>"
			."[ <a href=\"".$admin_file.".php?op=grp_del&id=$id&ok=1\">" . _YES . "</a> | <a href=\"".$admin_file.".php?op=Groups\">" . _NO . "</a> ]</center>";
			CloseTable();
			include("footer.php");
		} else {
			$db->sql_query("DELETE FROM " . $prefix . "_groups WHERE id='$id'");
			$db->sql_query("UPDATE " . $prefix . "_modules SET mod_group='0' WHERE mod_group='$id'");
			Header("Location: ".$admin_file.".php?op=Groups");
		}
	}

	function p_update($points, $id) {
		global $prefix, $db, $admin_file;
		$id = intval($id);
		$points = intval($points);
		$db->sql_query("UPDATE " . $prefix . "_groups_points SET points='$points' WHERE id='$id'");
		Header("Location: ".$admin_file.".php?op=Groups");
	}

	switch($op) {

		case "Groups":
		Groups();
		break;

		case "grp_add":
		grp_add($name, $description, $points);
		break;

		case "grp_edit":
		grp_edit($id);
		break;

		case "grp_edit_save":
		grp_edit_save($id, $name, $description, $points);
		break;

		case "grp_del":
		grp_del($id, $ok);
		break;

		case "points_update":
		p_update($points, $id);
		break;

	}

} else {
	echo "Access Denied";
}

?>