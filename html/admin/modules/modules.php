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
	/* Modules Functions                                     */
	/*********************************************************/

	function modules() {
		global $prefix, $db, $multilingual, $bgcolor2, $admin_file;
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>" . _MODULESADMIN . "</b></font></center>";
		CloseTable();
		$handle=opendir('modules');
		$modlist = "";
		while ($file = readdir($handle)) {
			if ( (!ereg("[.]",$file)) ) {
				$modlist .= "$file ";
			}
		}
		closedir($handle);
		$modlist = explode(" ", $modlist);
		sort($modlist);
		for ($i=0; $i < sizeof($modlist); $i++) {
			if(!empty($modlist[$i])) {
				$row = $db->sql_fetchrow($db->sql_query("SELECT mid from " . $prefix . "_modules where title='$modlist[$i]'"));
				$mid = intval($row['mid']);
				if (empty($mid)) {
					$db->sql_query("insert into " . $prefix . "_modules values (NULL, '$modlist[$i]', '$modlist[$i]', '0', '0', '1', '0', '')");
				}
			}
		}
		$result2 = $db->sql_query("SELECT title from " . $prefix . "_modules");
		while ($row2 = $db->sql_fetchrow($result2)) {
			$title = filter($row2['title'], "nohtml");
			$a = 0;
			$handle=opendir('modules');
			while ($file = readdir($handle)) {
				if ($file == $title) {
					$a = 1;
				}
			}
			closedir($handle);
			if ($a == 0) {
				$db->sql_query("delete from " . $prefix . "_modules where title='$title'");
			}
		}
		echo "<br>";
		OpenTable();
		echo "<br><center><font class=\"option\">" . _MODULESADDONS . "</font><br><br>"
		."<font class=\"content\">" . _MODULESACTIVATION . "</font><br><br>"
		."" . _MODULEHOMENOTE . "<br><br>" . _NOTINMENU . "<br><br>"
		."<form action=\"".$admin_file.".php\" method=\"post\">"
		."<table border=\"1\" align=\"center\" width=\"90%\"><tr><td align=\"center\" bgcolor=\"$bgcolor2\">"
		."<b>"._TITLE."</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._CUSTOMTITLE."</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._STATUS."</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._VIEW."</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._GROUP."</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._FUNCTIONS."</b></td></tr>";
		$main_m = $db->sql_fetchrow($db->sql_query("SELECT main_module from " . $prefix . "_main"));
		$main_module = $main_m['main_module'];
		$result3 = $db->sql_query("SELECT mid, title, custom_title, active, view, inmenu, mod_group from " . $prefix . "_modules order by title ASC");
		while ($row3 = $db->sql_fetchrow($result3)) {
			$mid = intval($row3['mid']);
			$title = filter($row3['title'], "nohtml");
			$custom_title = filter($row3['custom_title'], "nohtml");
			$active = intval($row3['active']);
			$view = intval($row3['view']);
			$inmenu = intval($row3['inmenu']);
			$mod_group = intval($row3['mod_group']);
			if (empty($custom_title)) {
				$custom_title = ereg_replace("_"," ",$title);
				$db->sql_query("update " . $prefix . "_modules set custom_title='$custom_title' where mid='$mid'");
			}
			if ($active == 1) {
				$active = "<img src=\"images/active.gif\" alt=\""._ACTIVE."\" title=\""._ACTIVE."\" border=\"0\" width=\"16\" height=\"16\">";
				$change = "<img src=\"images/inactive.gif\" alt=\""._DEACTIVATE."\" title=\""._DEACTIVATE."\" border=\"0\" width=\"16\" height=\"16\">";
				$act = 0;
			} else {
				$active = "<img src=\"images/inactive.gif\" alt=\""._INACTIVE."\" title=\""._INACTIVE."\" border=\"0\" width=\"16\" height=\"16\">";
				$change = "<img src=\"images/active.gif\" alt=\""._ACTIVATE."\" title=\""._ACTIVATE."\" border=\"0\" width=\"16\" height=\"16\">";
				$act = 1;
			}
			if (empty($custom_title)) {
				$custom_title = ereg_replace("_", " ", $title);
			}
			if ($view == 0) {
				$who_view = _MVALL;
			} elseif ($view == 1) {
				$who_view = _MVUSERS;
			} elseif ($view == 2) {
				$who_view = _MVADMIN;
			} elseif ($view == 3) {
				$who_view = _SUBUSERS;
			}
			if ($title != $main_module AND $inmenu == 0) {
				$title = "[ <big><strong>&middot;</strong></big> ] $title";
			}
			if ($title == $main_module) {
				$title = "<b>$title</b>";
				$custom_title = "<b>$custom_title</b>";
				$active = "$active <img src=\"images/key.gif\" alt=\""._INHOME."\" title=\""._INHOME."\" border=\"0\" width=\"17\" height=\"17\">";
				$who_view = "<b>$who_view</b>";
				$puthome = "<img src=\"images/key_x.gif\" alt=\""._INHOME."\" title=\""._INHOME."\" border=\"0\" width=\"17\" height=\"17\">";
				$change_status = "$change";
				$background = "bgcolor=\"$bgcolor2\"";
			} else {
				$puthome = "<a href=\"".$admin_file.".php?op=home_module&mid=$mid\"><img src=\"images/key.gif\" alt=\""._PUTINHOME."\" title=\""._PUTINHOME."\" border=\"0\" width=\"17\" height=\"17\"></a>";
				$change_status = "<a href=\"".$admin_file.".php?op=module_status&mid=$mid&active=$act\">$change</a>";
				$background = "";
			}
			if ($mod_group != 0) {
				$grp = $db->sql_fetchrow($db->sql_query("SELECT name FROM ".$prefix."_groups WHERE id='$mod_group'"));
				$mod_group = $grp['name'];
			} else {
				$mod_group = _NONE;
			}
			echo "<tr><td $background>&nbsp;$title</td><td align=\"center\" $background>$custom_title</td><td align=\"center\" $background>$active</td><td align=\"center\" $background>$who_view</td><td align=\"center\" $background>$mod_group</td><td align=\"center\" $background nowrap>&nbsp; <a href=\"".$admin_file.".php?op=module_edit&mid=$mid\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>  $change_status  $puthome &nbsp;</td></tr>";
		}
		echo "</table></form></center>";
		CloseTable();
		include ("footer.php");
	}

	function home_module($mid, $ok=0) {
		global $prefix, $db, $admin_file;
		$mid = intval($mid);
		if ($ok == 0) {
			include ("header.php");
			GraphicAdmin();
			title("" . _HOMECONFIG . "");
			OpenTable();
			$row = $db->sql_fetchrow($db->sql_query("SELECT title from " . $prefix . "_modules where mid='$mid'"));
			$new_m = filter($row['title'], "nohtml");
			$row2 = $db->sql_fetchrow($db->sql_query("SELECT main_module from " . $prefix . "_main"));
			$old_m = filter($row2['main_module'], "nohtml");
			echo "<center><b>" . _DEFHOMEMODULE . "</b><br><br>"
			."" . _SURETOCHANGEMOD . " <b>$old_m</b> " . _TO . " <b>$new_m</b>?<br><br>"
			."[ <a href=\"".$admin_file.".php?op=modules\">" . _NO . "</a> | <a href=\"".$admin_file.".php?op=home_module&mid=$mid&ok=1\">" . _YES . "</a> ]</center>";
			CloseTable();
			include("footer.php");
		} else {
			$row3 = $db->sql_fetchrow($db->sql_query("SELECT title from " . $prefix . "_modules where mid='$mid'"));
			$title = filter($row3['title'], "nohtml", 1);
			$active = 1;
			$view = 0;
			$res = $db->sql_query("update " . $prefix . "_main set main_module='$title'");
			$res2 = $db->sql_query("update " . $prefix . "_modules set active='$active', view='$view' where mid='$mid'");
			Header("Location: ".$admin_file.".php?op=modules");
		}
	}

	function module_status($mid, $active) {
		global $prefix, $db, $admin_file;
		$mid = intval($mid);
		$active = intval($active);
		$db->sql_query("update " . $prefix . "_modules set active='$active' where mid='$mid'");
		Header("Location: ".$admin_file.".php?op=modules");
	}

	function module_edit($mid) {
		global $prefix, $db, $admin_file;
		$main_m = $db->sql_fetchrow($db->sql_query("SELECT main_module from " . $prefix . "_main"));
		$main_module = $main_m['main_module'];
		$mid = intval($mid);
		$row = $db->sql_fetchrow($db->sql_query("SELECT title, custom_title, view, inmenu, mod_group from " . $prefix . "_modules where mid='$mid'"));
		$title = filter($row['title'], "nohtml");
		$custom_title = filter($row['custom_title'], "nohtml");
		$view = intval($row['view']);
		$inmenu = intval($row['inmenu']);
		$mod_group = intval($row['mod_group']);
		include ("header.php");
		GraphicAdmin();
		title("" . _MODULEEDIT . "");
		OpenTable();
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
		if ($title == $main_module) {
			$a = " - " . _INHOME . "";
		} else {
			$a = "";
		}
		if ($inmenu == 1) {
			$insel1 = "checked";
			$insel2 = "";
		} elseif ($inmenu == 0) {
			$insel1 = "";
			$insel2 = "checked";
		}
		echo "<center><b>" . _CHANGEMODNAME . "</b><br>($title$a)</center><br><br>"
		."<form action=\"".$admin_file.".php\" method=\"post\">"
		."<table border=\"0\"><tr><td>"
		."" . _CUSTOMMODNAME . "</td><td>"
		."<input type=\"text\" name=\"custom_title\" value=\"$custom_title\" size=\"50\"></td></tr>";
		if ($title == $main_module) {
			echo "<input type=\"hidden\" name=\"view\" value=\"0\">"
			."<input type=\"hidden\" name=\"inmenu\" value=\"$inmenu\">"
			."</table><br><br>";
		} else {
			echo "<tr><td>" . _VIEWPRIV . "</td><td><select name=\"view\">"
			."<option value=\"0\" $sel1>" . _MVALL . "</option>"
			."<option value=\"1\" $sel2>" . _MVUSERS . "</option>"
			."<option value=\"2\" $sel3>" . _MVADMIN . "</option>"
			."<option value=\"3\" $sel4>" . _SUBUSERS . "</option>"
			."</select></td></tr>";
			$numrow = $db->sql_numrows($db->sql_query("SELECT * FROM " . $prefix . "_groups"));
			if ($numrow > 0) {
				echo "<tr><td>" . _UGROUP . "</td><td><select name=\"mod_group\">";
				$result2 = $db->sql_query("SELECT id, name FROM " . $prefix . "_groups");
				while ($row2 = $db->sql_fetchrow($result2)) {
					if ($row2['id'] == $mod_group) { $gsel = "selected"; } else { $gsel = ""; }
					if ($dummy != 1) {
						if ($mod_group == 0) { $ggsel = "selected"; } else { $ggsel = ""; }
						echo "<option value=\"0\" $ggsel>" . _NONE . "</option>";
						$dummy = 1;
					}
					$row2['name'] = filter($row2['name'], "nohtml");
					echo "<option value=\"".intval($row2['id'])."\" $gsel>".$row2['name']."</option>";
					$gsel = "";
				}
				echo "</select>&nbsp;<i>(" . _VALIDIFREG . ")</i></td></tr>";
			} else {
				echo "<input type=\"hidden\" name=\"mod_group\" value=\"0\">";
			}
			echo "<tr><td>"._SHOWINMENU."</td><td>"
			."<input type=\"radio\" name=\"inmenu\" value=\"1\" $insel1> " . _YES . " &nbsp;&nbsp; <input type=\"radio\" name=\"inmenu\" value=\"0\" $insel2> " . _NO . ""
			."</td></tr></table><br><br>";
		}
		if ($title != $main_module) {

		}
		echo "<input type=\"hidden\" name=\"mid\" value=\"$mid\">"
		."<input type=\"hidden\" name=\"op\" value=\"module_edit_save\">"
		."<input type=\"submit\" value=\"" . _SAVECHANGES . "\">"
		."</form>"
		."<br><br><center>" . _GOBACK . "</center>";
		CloseTable();
		include("footer.php");
	}

	function module_edit_save($mid, $custom_title, $view, $inmenu, $mod_group) {
		global $prefix, $db, $admin_file;
		$mid = intval($mid);
		$custom_title = filter($custom_title, "nohtml", 1);
		if ($view != 1) { $mod_group = 0; }
		$result = $db->sql_query("update " . $prefix . "_modules set custom_title='$custom_title', view='$view', inmenu='$inmenu', mod_group='$mod_group' where mid='$mid'");
		Header("Location: ".$admin_file.".php?op=modules");
	}

	switch ($op){

		case "modules":
		modules();
		break;

		case "module_status":
		module_status($mid, $active);
		break;

		case "module_edit":
		module_edit($mid);
		break;

		case "module_edit_save":
		module_edit_save($mid, $custom_title, $view, $inmenu, $mod_group);
		break;

		case "home_module":
		home_module($mid, $ok);
		break;

	}

} else {
	echo "Access Denied";
}

?>