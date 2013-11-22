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
	/* Configuration Functions to Setup all the Variables    */
	/*********************************************************/

	function options_menu($thispage) {
		global $admin_file;
		OpenTable();
		echo "<center><font class='title'><b>" . _SITECONFIG . "</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><b>"._SITECONFIGURE."</b><br><br>"
			."[ ";
		if ($thispage == "general") {
			echo "General | ";
		} else {
			echo "<a href=\"".$admin_file.".php?op=general\">"._GENERAL."</a> | ";
		}
		if ($thispage == "themes") {
			echo "Themes | ";
		} else {
			echo "<a href=\"".$admin_file.".php?op=themes\">"._THEMES."</a> | ";
		}
		if ($thispage == "users") {
			echo "Users | ";	
		} else {
			echo "<a href=\"".$admin_file.".php?op=users\">"._USERS."</a> | ";
		}
		if ($thispage == "comments") {
			echo "Comments | ";
		} else {
			echo "<a href=\"".$admin_file.".php?op=comments\">"._SETCOMMENTS."</a> | ";
		}
		if ($thispage == "languages") {
			echo "Languages | ";
		} else {
			echo "<a href=\"".$admin_file.".php?op=languages\">"._LANGUAGES."</a> | ";
		}
		if ($thispage == "footer") {
			echo "Footer | ";
		} else {
			echo "<a href=\"".$admin_file.".php?op=footer\">"._FOOTER."</a> | ";
		}
		if ($thispage == "backend") {
			echo "Backend | ";
		} else {
			echo "<a href=\"".$admin_file.".php?op=backend\">"._BACKEND."</a> | ";
		}
		if ($thispage == "referers") {
			echo "Referers | ";
		} else {
			echo "<a href=\"".$admin_file.".php?op=referers\">"._REFERERS."</a> | ";
		}
		if ($thispage == "mailing") {
			echo "Mailing | ";
		} else {
			echo "<a href=\"".$admin_file.".php?op=mailing\">"._MAILING."</a> | ";
		}
		if ($thispage == "other") {
			echo "Other ]</center>";
		} else {
			echo "<a href=\"".$admin_file.".php?op=other\">"._OTHERS."</a> ]</center>";
		}
		CloseTable();
		echo "<br>";		
	}

	function Configure() {
		global $admin_file;
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class='title'><b>" . _SITECONFIG . "</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><b>"._SITECONFIGURE."</b><br><br>";
		echo "[ <a href=\"".$admin_file.".php?op=general\">"._GENERAL."</a> | ";
		echo "<a href=\"".$admin_file.".php?op=themes\">"._THEMES."</a> | ";
		echo "<a href=\"".$admin_file.".php?op=users\">"._USERS."</a> | ";
		echo "<a href=\"".$admin_file.".php?op=comments\">"._SETCOMMENTS."</a> | ";
		echo "<a href=\"".$admin_file.".php?op=languages\">"._LANGUAGES."</a> | ";
		echo "<a href=\"".$admin_file.".php?op=footer\">"._FOOTER."</a> | ";
		echo "<a href=\"".$admin_file.".php?op=backend\">"._BACKEND."</a> | ";
		echo "<a href=\"".$admin_file.".php?op=referers\">"._REFERERS."</a> | ";
		echo "<a href=\"".$admin_file.".php?op=mailing\">"._MAILING."</a> | ";
		echo "<a href=\"".$admin_file.".php?op=other\">"._OTHERS."</a> ]</center>";
		CloseTable();
		include("footer.php");
	}

	function general() {
		global $prefix, $db, $admin_file;
		include ("header.php");
		GraphicAdmin();
		options_menu("general");
		OpenTable();
		$row = $db->sql_fetchrow($db->sql_query("SELECT sitename, nukeurl, slogan, startdate, adminmail, admingraphic, gfx_chk, nuke_editor, display_errors from ".$prefix."_config"));
		$sitename = filter($row['sitename'], "nohtml", 0, preview);
		$nukeurl = filter($row['nukeurl'], "nohtml");
		$slogan = filter($row['slogan'], "nohtml", 0, preview);
		$startdate = filter($row['startdate'], "nohtml", 0, preview);
		$admingraphic = intval($row['admingraphic']);
		$gfx_chk = intval($row['gfx_chk']);
		$nuke_editor = intval($row['nuke_editor']);
		$display_errors = intval($row['display_errors']);
		echo "<center><font class='option'><b>" . _GENSITEINFO . "</b></font></center>"
			."<form action='".$admin_file.".php' method='post'>"
			."<table border=\"0\" align=\"center\" cellpadding=\"3\"><tr><td>"
			."" . _SITENAME . ":</td><td><input type='text' name='xsitename' value='$sitename' size='40' maxlength='255'>"
			."</td></tr><tr><td>"
			."" . _SITEURL . ":</td><td><input type='text' name='xnukeurl' value='$nukeurl' size='40' maxlength='255'>"
			."</td></tr><tr><td>"
			."" . _SITESLOGAN . ":</td><td><input type='text' name='xslogan' value='$slogan' size='40' maxlength='255'>"
			."</td></tr><tr><td>"
			."" . _STARTDATE . ":</td><td><input type='text' name='xstartdate' value='$startdate' size='20' maxlength='50'>"
			."</td></tr><tr><td>"
			."" . _ADMINGRAPHIC . "</td><td>";
		if ($admingraphic==1) {
			echo "<input type='radio' name='xadmingraphic' value='1' checked>" . _YES . " &nbsp;<input type='radio' name='xadmingraphic' value='0'>" . _NO . "";
		} else {
			echo "<input type='radio' name='xadmingraphic' value='1'>" . _YES . " &nbsp;<input type='radio' name='xadmingraphic' value='0' checked>" . _NO . "";
		}
		if ($gfx_chk == 0) { $sel1 = "selected"; }
		if ($gfx_chk == 1) { $sel2 = "selected"; }
		if ($gfx_chk == 2) { $sel3 = "selected"; }
		if ($gfx_chk == 3) { $sel4 = "selected"; }
		if ($gfx_chk == 4) { $sel5 = "selected"; }
		if ($gfx_chk == 5) { $sel6 = "selected"; }
		if ($gfx_chk == 6) { $sel7 = "selected"; }
		if ($gfx_chk == 7) { $sel8 = "selected"; }
		echo "</td></tr><tr><td>"
			."Graphics Security Check:</td><td>"
			."<select name='xgfx_chk'>"
			."<option name='xgfx_chk' value='0' $sel1>"._NOCHECK."</option>"
			."<option name='xgfx_chk' value='1' $sel2>"._ADMINONLY."</option>"
			."<option name='xgfx_chk' value='2' $sel3>"._USERSONLY."</option>"
			."<option name='xgfx_chk' value='3' $sel4>"._REGUSERSONLY."</option>"
			."<option name='xgfx_chk' value='4' $sel5>"._BOTHREGADMIN."</option>"
			."<option name='xgfx_chk' value='5' $sel6>"._ADMINUSERS."</option>"
			."<option name='xgfx_chk' value='6' $sel7>"._ADMINNEW."</option>"
			."<option name='xgfx_chk' value='7' $sel8>"._EVERYWHERE."</option>"
			."</select>";
		if ($nuke_editor == 0) { $sel1 = "selected"; }
		if ($nuke_editor == 1) { $sel2 = "selected"; }
		echo "</td></tr><tr><td>"
			."Textareas Editor:</td><td>"
			."<select name='xnuke_editor'>"
			."<option name='xnuke_editor' value='0' $sel1>"._WITHOUTEDITOR."</option>"
			."<option name='xnuke_editor' value='1' $sel2>"._WITHEDITOR."</option>"
			."</select>";
		echo "</td></tr><tr><td>"
			.""._DISPLAYPHPERR.":</td><td>";
		if ($display_errors == 1) {
			echo "<input type='radio' name='xdisplay_errors' value='1' checked>" . _YES . " &nbsp;<input type='radio' name='xdisplay_errors' value='0'>" . _NO . "";
		} else {
			echo "<input type='radio' name='xdisplay_errors' value='1'>" . _YES . " &nbsp;<input type='radio' name='xdisplay_errors' value='0' checked>" . _NO . "";
		}
		echo "</td></tr><tr><td>&nbsp;</td><td halign=\"left\"><input type='hidden' name='op' value='savegeneral'>"
			."<br><br><input type='submit' value='" . _SAVECHANGES . "'></form></td></tr></table>";		
		CloseTable();
		include("footer.php");
	}

	function themes() {
		global $prefix, $db, $admin_file;
		include ("header.php");
		GraphicAdmin();
		options_menu("themes");
		OpenTable();
		$row = $db->sql_fetchrow($db->sql_query("SELECT Default_Theme, overwrite_theme from ".$prefix."_config"));
		$Default_Theme = filter($row['Default_Theme'], "nohtml");
		$overwrite_theme = intval($row['overwrite_theme']);
		$row = $db->sql_fetchrow($db->sql_query("SELECT active from ".$prefix."_modules WHERE title='AutoTheme'"));
		$auto_status = intval($row['active']);
		if ($auto_status == 1) {
			$auto_status = _ACTIVATED;
		} elseif ($auto_status == 0) {
			$auto_status = _DEACTIVATED;
		}
		echo "<center><font class='option'><b>"._THEMECONFIG."</b></font></center>"
			."<form action='".$admin_file.".php' method='post'>"
			."<table border=\"0\" align=\"center\" cellpadding=\"3\"><tr><td>"
			.""._AUTOTHEMESTATUS.":</td><td><b>$auto_status</b></td></tr>"
			."<tr><td>" . _DEFAULTTHEME . ":</td><td><select name='xDefault_Theme'>";
		$handle=opendir('themes');
		while ($file = readdir($handle)) {
			if ( (!ereg("[.]",$file)) ) {
				$themelist .= "$file ";
			}
		}
		closedir($handle);
		$themelist = explode(" ", $themelist);
		sort($themelist);
		for ($i=0; $i < sizeof($themelist); $i++) {
			if(!empty($themelist[$i])) {
				echo "<option name='xDefault_Theme' value='$themelist[$i]' ";
				if($themelist[$i]==$Default_Theme) echo "selected";
				echo ">$themelist[$i]\n";
			}
		}
		echo "</select>"
			."</td></tr><tr><td>"
			.""._LETUSERSCHANGETHM."</td><td>";
		if ($overwrite_theme == 1) {
			echo "<input type='radio' name='xoverwrite_theme' value='1' checked>" . _YES . " &nbsp;"
				."<input type='radio' name='xoverwrite_theme' value='0'>" . _NO . "";
		} else {
			echo "<input type='radio' name='xoverwrite_theme' value='1'>" . _YES . " &nbsp;"
				."<input type='radio' name='xoverwrite_theme' value='0' checked>" . _NO . "";
		}
		echo "</td></tr><tr><td>&nbsp;</td><td halign=\"left\"><input type='hidden' name='op' value='savethemes'>"
			."<br><br><input type='submit' value='" . _SAVECHANGES . "'></form></td></tr></table>";		
		CloseTable();
		include("footer.php");
	}

	function users() {
		global $prefix, $db, $admin_file;
		include("header.php");
		GraphicAdmin();
		options_menu("users");
		OpenTable();
		$row = $db->sql_fetchrow($db->sql_query("SELECT anonymous, anonpost, overwrite_theme, minpass, broadcast_msg, my_headlines, user_news from ".$prefix."_config"));
		$anonymous = filter($row['anonymous'], "nohtml");
		$anonpost = intval($row['anonpost']);
		$overwrite_theme = intval($row['overwrite_theme']);
		$minpass = intval($row['minpass']);
		$broadcast_msg = intval($row['broadcast_msg']);
		$my_headlines = intval($row['my_headlines']);
		$user_news = intval($row['user_news']);
		if ($minpass == 3) { $sel1 = "selected"; }
		if ($minpass == 5) { $sel2 = "selected"; }
		if ($minpass == 8) { $sel3 = "selected"; }
		if ($minpass == 10) { $sel4 = "selected"; }
		echo "<center><font class='option'><b>"._USERSCONFIG."</b></font></center>"
			."<form action='".$admin_file.".php' method='post'>"
			."<table border=\"0\" align=\"center\" cellpadding=\"3\"><tr><td>"
			."" . _ANONYMOUSNAME . ":</td><td><input type='text' name='xanonymous' value='$anonymous'>"
			."</td></tr><tr><td>"
    		.""._ALLOWANOMCOM."</td><td>";
		if ($anonpost==1) {
			echo "<input type='radio' name='xanonpost' value='1' checked>" . _YES . " &nbsp;<input type='radio' name='xanonpost' value='0'>" . _NO . "";
		} else {
			echo "<input type='radio' name='xanonpost' value='1'>" . _YES . " &nbsp;<input type='radio' name='xanonpost' value='0' checked>" . _NO . "";
		}
		echo "</td></tr><tr><td>"
			.""._LETUSERSCHANGETHM."</td><td>";
		if ($row[overwrite_theme] == 1) {
			echo "<input type='radio' name='xoverwrite_theme' value='1' checked>" . _YES . " &nbsp;"
				."<input type='radio' name='xoverwrite_theme' value='0'>" . _NO . "";
		} else {
			echo "<input type='radio' name='xoverwrite_theme' value='1'>" . _YES . " &nbsp;"
				."<input type='radio' name='xoverwrite_theme' value='0' checked>" . _NO . "";
		}
		echo "</td></tr><tr><td>"
			."" . _PASSWDLEN . ":</td><td>"
			."<select name='xminpass'>"
			."<option name='xminpass' value='3' $sel1>3</option>"
			."<option name='xminpass' value='5' $sel2>5</option>"
			."<option name='xminpass' value='8' $sel3>8</option>"
			."<option name='xminpass' value='10' $sel4>10</option>"
			."</select>"
			."</td></tr><tr><td>" . _BROADCASTMSG . "</td><td>";
		if ($broadcast_msg == 1) {
			echo "<input type='radio' name='xbroadcast_msg' value='1' checked>" . _YES . " &nbsp;<input type='radio' name='xbroadcast_msg' value='0'>" . _NO . "";
		} else {
			echo "<input type='radio' name='xbroadcast_msg' value='1'>" . _YES . " &nbsp;<input type='radio' name='xbroadcast_msg' value='0' checked>" . _NO . "";
		}
		echo "</td></tr><tr><td>" . _MYHEADLINES . "</td><td>";
		if ($my_headlines == 1) {
			echo "<input type='radio' name='xmy_headlines' value='1' checked>" . _YES . " &nbsp;<input type='radio' name='xmy_headlines' value='0'>" . _NO . "";
		} else {
			echo "<input type='radio' name='xmy_headlines' value='1'>" . _YES . " &nbsp;<input type='radio' name='xmy_headlines' value='0' checked>" . _NO . "";
		}
		echo "</td></tr><tr><td>" . _USERSHOMENUM . "</td><td>";
		if ($user_news == 1) {
			echo "<input type='radio' name='xuser_news' value='1' checked>" . _YES . " &nbsp;<input type='radio' name='xuser_news' value='0'>" . _NO . "";
		} else {
			echo "<input type='radio' name='xuser_news' value='1'>" . _YES . " &nbsp;<input type='radio' name='xuser_news' value='0' checked>" . _NO . "";
		}
		echo "</td></tr><tr><td>&nbsp;</td><td halign=\"left\"><input type='hidden' name='op' value='saveusers'>"
			."<br><br><input type='submit' value='" . _SAVECHANGES . "'></form></td></tr></table>";		
		CloseTable();
		include("footer.php");
	}

	function comments() {
		global $prefix, $db, $admin_file;
		include ("header.php");
		GraphicAdmin();
		options_menu("comments");
		OpenTable();
		$row = $db->sql_fetchrow($db->sql_query("SELECT anonpost, moderate, commentlimit, pollcomm, articlecomm, CensorMode, CensorReplace from ".$prefix."_config"));
		$anonpost = intval($row['anonpost']);
		$moderate = intval($row['moderate']);
		$commentlimit = intval($row['commentlimit']);
		$pollcomm = intval($row['pollcomm']);
		$articlecomm = intval($row['articlecomm']);
		$CensorMode = intval($row['CensorMode']);
		$CensorReplace = filter($row['CensorReplace'], "nohtml", 0, preview);
		echo "<center><font class='option'><b>"._COMMENTSCONFIG."</b></font></center>"
			."<form action='".$admin_file.".php' method='post'>"
			."<table border=\"0\" align=\"center\" cellpadding=\"3\"><tr><td>"
    		.""._ALLOWANOMCOM."</td><td>";
		if ($anonpost==1) {
			echo "<input type='radio' name='xanonpost' value='1' checked>" . _YES . " &nbsp;<input type='radio' name='xanonpost' value='0'>" . _NO . "";
		} else {
			echo "<input type='radio' name='xanonpost' value='1'>" . _YES . " &nbsp;<input type='radio' name='xanonpost' value='0' checked>" . _NO . "";
		}
		echo "</td></tr><tr><td>"
			."" . _MODTYPE . ":</td><td>"
			."<select name='xmoderate'>";
		if ($moderate==1) {
			$sel1 = "selected";
			$sel2 = "";
			$sel3 = "";
		} elseif ($moderate==2) {
			$sel1 = "";
			$sel2 = "selected";
			$sel3 = "";
		} elseif ($moderate==0) {
			$sel1 = "";
			$sel2 = "";
			$sel3 = "selected";
		}
		echo "<option name='xmoderate' value='1' $sel1>" . _MODADMIN . "</option>"
			."<option name='xmoderate' value='2' $sel2>" . _MODUSERS . "</option>"
			."<option name='xmoderate' value='0' $sel3>" . _NOMOD . "</option>"
			."</select></td></tr>"
			."<tr><td>" . _COMMENTSLIMIT . ":</td><td><input type='text' name='xcommentlimit' value='$commentlimit' size='11' maxlength='10'>"
			."</td></tr><tr><td>"
			."" . _COMMENTSPOLLS . "</td><td>";
		if ($pollcomm==1) {
			echo "<input type='radio' name='xpollcomm' value='1' checked>" . _YES . " &nbsp;<input type='radio' name='xpollcomm' value='0'>" . _NO . "";
		} else {
			echo "<input type='radio' name='xpollcomm' value='1'>" . _YES . " &nbsp;<input type='radio' name='xpollcomm' value='0' checked>" . _NO . "";
		}
		echo "</td></tr><tr><td>"
			."" . _COMMENTSARTICLES . "</td><td>";
		if ($articlecomm==1) {
			echo "<input type='radio' name='xarticlecomm' value='1' checked>" . _YES . " &nbsp;<input type='radio' name='xarticlecomm' value='0'>" . _NO . "";
		} else {
			echo "<input type='radio' name='xarticlecomm' value='1'>" . _YES . " &nbsp;<input type='radio' name='xarticlecomm' value='0' checked>" . _NO . "";
		}
	echo "</td></tr><tr><td>" . _CENSORMODE . "</td><td>";
		if ($CensorMode == 0) {
			$sel0 = "selected";
			$sel1 = "";
			$sel2 = "";
			$sel3 = "";
		} elseif ($CensorMode == 1) {
			$sel0 = "";
			$sel1 = "selected";
			$sel2 = "";
			$sel3 = "";
		} elseif ($CensorMode == 2) {
			$sel0 = "";
			$sel1 = "";
			$sel2 = "selected";
			$sel3 = "";
		} elseif ($CensorMode == 3) {
			$sel0 = "";
			$sel1 = "";
			$sel2 = "";
			$sel3 = "selected";
		}
		echo "<select name='xCensorMode'>"
			."<option name='xCensorMode' value='0' $sel0>" . _NOFILTERING . "</option>"
			."<option name='xCensorMode' value='1' $sel1>" . _EXACTMATCH . "</option>"
			."<option name='xCensorMode' value='2' $sel2>" . _MATCHBEG . "</option>"
			."<option name='xCensorMode' value='3' $sel3>" . _MATCHANY . "</option>"
			."</select>"
			."</td></tr><tr><td>" . _CENSORREPLACE . "</td><td>"
			."<input type='text' name='xCensorReplace' value='$CensorReplace' size='10' maxlength='10'>"
			."</td></tr><tr><td>&nbsp;</td><td halign=\"left\"><input type='hidden' name='op' value='savecomments'>"
			."<br><br><input type='submit' value='" . _SAVECHANGES . "'></form></td></tr></table>";		
		CloseTable();
		include("footer.php");
	}

	function languages() {
		global $prefix, $db, $admin_file;
		include ("header.php");
		GraphicAdmin();
		options_menu("languages");
		OpenTable();
		$row = $db->sql_fetchrow($db->sql_query("SELECT language, locale, multilingual, useflags, backend_language from ".$prefix."_config"));
		$language = filter($row['language'], "nohtml", 0, preview);
		$locale = filter($row['locale'], "nohtml", 0, preview);
		$multilingual = intval($row['multilingual']);
		$useflags = intval($row['useflags']);
		$backend_language = filter($row['backend_language'], "nohtml", 0, preview);
		echo "<center><font class='option'><b>"._LANGUAGESCONFIG."</b></font></center>"
			."<form action='".$admin_file.".php' method='post'>"
			."<table border=\"0\" align=\"center\" cellpadding=\"3\"><tr><td>"
			."" . _SELLANGUAGE . ":</td><td>"
			."<select name='xlanguage'>";
		$handle=opendir('language');
		while ($file = readdir($handle)) {
			if (ereg("^lang\-(.+)\.php", $file, $matches)) {
				$langFound = $matches[1];
				$languageslist .= "$langFound ";
			}
		}
		closedir($handle);
		$languageslist = explode(" ", $languageslist);
		sort($languageslist);
		for ($i=0; $i < sizeof($languageslist); $i++) {
			if(!empty($languageslist[$i])) {
				echo "<option name='xlanguage' value='$languageslist[$i]' ";
				if($languageslist[$i]==$language) echo "selected";
				echo ">".ucfirst($languageslist[$i])."\n";
			}
		}
		echo "</select>"
			."</td></tr><tr><td>"
			."" . _LOCALEFORMAT . ":</td><td><input type='text' name='xlocale' value='$locale' size='10' maxlength='40'>"
			."</td></tr><tr><td>"
			."" . _ACTMULTILINGUAL . "</td><td>";
		if ($multilingual==1) {
			echo "<input type='radio' name='xmultilingual' value='1' checked>" . _YES . " &nbsp;<input type='radio' name='xmultilingual' value='0'>" . _NO . "";
		} else {
			echo "<input type='radio' name='xmultilingual' value='1'>" . _YES . " &nbsp;<input type='radio' name='xmultilingual' value='0' checked>" . _NO . "";
		}
		echo "</td></tr><tr><td>"
			."" . _ACTUSEFLAGS . "</td><td>";
		if ($useflags==1) {
			echo "<input type='radio' name='xuseflags' value='1' checked>" . _YES . " &nbsp;<input type='radio' name='xuseflags' value='0'>" . _NO . "";
		} else {
			echo "<input type='radio' name='xuseflags' value='1'>" . _YES . " &nbsp;<input type='radio' name='xuseflags' value='0' checked>" . _NO . "";
		}
		echo "</td></tr><tr><td>"
			."" . _BACKENDLANG . ":</td><td><input type='text' name='xbackend_language' value='$backend_language' size='10' maxlength='40'>"
			."</td></tr><tr><td>&nbsp;</td><td halign=\"left\"><input type='hidden' name='op' value='savelanguages'>"
			."<br><br><input type='submit' value='" . _SAVECHANGES . "'></form></td></tr></table>";		
		CloseTable();
		include("footer.php");
	}

	function footer() {
		global $prefix, $db, $admin_file;
		include ("header.php");
		GraphicAdmin();
		options_menu("footer");
		OpenTable();
		$row = $db->sql_fetchrow($db->sql_query("SELECT foot1, foot2, foot3 from ".$prefix."_config"));
		$foot1 = filter($row['foot1'], "", 0, preview);
		$foot2 = filter($row['foot2'], "", 0, preview);
		$foot3 = filter($row['foot3'], "", 0, preview);
		echo "<center><font class='option'><b>"._FOOTERCONFIG."</b></font></center>"
			."<form action='".$admin_file.".php' method='post'>"
			."<table border=\"0\" align=\"center\" cellpadding=\"3\"><tr><td>"
			."" . _FOOTERLINE1 . ":</td><td><textarea name='xfoot1' cols='70' rows='15'>" . stripslashes($foot1) . "</textarea>"
			."</td></tr><tr><td>"
			."" . _FOOTERLINE2 . ":</td><td><textarea name='xfoot2' cols='70' rows='15'>" . stripslashes($foot2) . "</textarea>"
			."</td></tr><tr><td>"
			."" . _FOOTERLINE3 . ":</td><td><textarea name='xfoot3' cols='70' rows='15'>" . stripslashes($foot3) . "</textarea>"
			."</td></tr><tr><td>&nbsp;</td><td halign=\"left\"><input type='hidden' name='op' value='savefooter'>"
			."<br><br><input type='submit' value='" . _SAVECHANGES . "'></form></td></tr></table>";		
		CloseTable();
		include("footer.php");
	}

	function backend() {
		global $prefix, $db, $admin_file;
		include ("header.php");
		GraphicAdmin();
		options_menu("backend");
		OpenTable();
		$row = $db->sql_fetchrow($db->sql_query("SELECT backend_title, backend_language, site_logo, ultramode from ".$prefix."_config"));
		$backend_title = filter($row['backend_title'], "nohtml", 0, preview);
		$backend_language = filter($row['backend_language'], "nohtml", 0, preview);
		$site_logo = filter($row['site_logo'], "nohtml", 0, preview);
		$ultramode = intval($row['ultramode']);
		echo "<center><font class='option'><b>"._BACKENDCONFIG."</b></font></center>"
			."<form action='".$admin_file.".php' method='post'>"
			."<table border=\"0\" align=\"center\" cellpadding=\"3\"><tr><td>"
			."" . _BACKENDTITLE . ":</td><td><input type='text' name='xbackend_title' value='$backend_title' size='40' maxlength='100'>"
			."</td></tr><tr><td>"
			."" . _BACKENDLANG . ":</td><td><input type='text' name='xbackend_language' value='$backend_language' size='10' maxlength='10'>"
			."</td></tr><tr><td>"
			."" . _SITELOGO . ":</td><td><input type='text' name='xsite_logo' value='$site_logo' size='30' maxlength='255'><br><font class='tiny'><i>(" . _MUSTBEINIMG . ")</i></font>"
			."</td></tr><tr><td>"
			."" . _ACTULTRAMODE . "</td><td>";
		if ($ultramode==1) {
			echo "<input type='radio' name='xultramode' value='1' checked>" . _YES . " &nbsp;<input type='radio' name='xultramode' value='0'>" . _NO . "";
		} else {
			echo "<input type='radio' name='xultramode' value='1'>" . _YES . " &nbsp;<input type='radio' name='xultramode' value='0' checked>" . _NO . "";
		}
		echo "</td></tr><tr><td>&nbsp;</td><td halign=\"left\"><input type='hidden' name='op' value='savebackend'>"
			."<br><br><input type='submit' value='" . _SAVECHANGES . "'></form></td></tr></table>";		
		CloseTable();
		include("footer.php");
	}

	function referers() {
		global $prefix, $db, $admin_file;
		include ("header.php");
		GraphicAdmin();
		options_menu("referers");
		OpenTable();
		$row = $db->sql_fetchrow($db->sql_query("SELECT httpref, httprefmax, httprefmode from ".$prefix."_config"));
		$httpref = intval($row['httpref']);
		$httprefmax = intval($row['httprefmax']);
		$httprefmode = intval($row['httprefmode']);
		echo "<center><font class='option'><b>"._REFCONFIG."</b></font></center>"
			."<form action='".$admin_file.".php' method='post'>"
			."<table border=\"0\" align=\"center\" cellpadding=\"3\"><tr><td>"
			."" . _ACTIVATEHTTPREF . "</td><td>";
		if ($httpref == 1) {
			echo "<input type='radio' name='xhttpref' value='1' checked>" . _YES . " &nbsp;<input type='radio' name='xhttpref' value='0'>" . _NO . "";
		} else {
			echo "<input type='radio' name='xhttpref' value='1'>" . _YES . " &nbsp;<input type='radio' name='xhttpref' value='0' checked>" . _NO . "";
		}
		if ($httprefmax == 100) { $sel1 = "selected"; }
		if ($httprefmax == 250) { $sel2 = "selected"; }
		if ($httprefmax == 500) { $sel3 = "selected"; }
		if ($httprefmax == 1000) { $sel4 = "selected"; }
		if ($httprefmax == 2000) { $sel5 = "selected"; }
		echo "</td></tr><tr><td>"
			."" . _MAXREF . "</td><td>"
			."<select name='xhttprefmax'>"
			."<option name='xhttprefmax' value='100' $sel1>100</option>"
			."<option name='xhttprefmax' value='250' $sel2>250</option>"
			."<option name='xhttprefmax' value='500' $sel3>500</option>"
			."<option name='xhttprefmax' value='1000' $sel4>1000</option>"
			."<option name='xhttprefmax' value='2000' $sel5>2000</option>"
			."</select>"
			."</td></tr><tr><td>"
			.""._REFSHOWMODE.":</td><td>";
		if ($httprefmode == 1) {
			echo "<input type='radio' name='xhttprefmode' value='1' checked>"._ABRIDGED." &nbsp;<input type='radio' name='xhttprefmode' value='0'>"._UNABRIDGED."";
		} else {
			echo "<input type='radio' name='xhttprefmode' value='1'>"._ABRIDGED." &nbsp;<input type='radio' name='xhttprefmode' value='0' checked>"._UNABRIDGED."";
		}
		echo "</td></tr><tr><td>&nbsp;</td><td halign=\"left\"><input type='hidden' name='op' value='savereferers'>"
			."<br><br><input type='submit' value='" . _SAVECHANGES . "'></form></td></tr></table>";		
		CloseTable();
		include("footer.php");
	}

	function mailing() {
		global $prefix, $db, $admin_file;
		include ("header.php");
		GraphicAdmin();
		options_menu("mailing");
		OpenTable();
		$row = $db->sql_fetchrow($db->sql_query("SELECT adminmail, notify, notify_email, notify_subject, notify_message, notify_from from ".$prefix."_config"));
		$adminmail = filter($row['adminmail'], "nohtml", 0, preview);
		$notify= intval($row['notify']);
		$notify_email = filter($row['notify_email'], "nohtml", 0, preview);
		$notify_subject = filter($row['notify_subject'], "nohtml", 0, preview);
		$notify_message = filter($row['notify_message'], "", 0, preview);
		$notify_from = filter($row['notify_from'], "nohtml", 0, preview);
		echo "<center><font class='option'><b>"._MAILCONFIG."</b></font></center>"
			."<form action='".$admin_file.".php' method='post'>"
			."<table border=\"0\" align=\"center\" cellpadding=\"3\"><tr><td>"
			."" . _ADMINEMAIL . ":</td><td><input type='text' name='xadminmail' value='$adminmail' size='30' maxlength='255'>"
			."</td></tr><tr><td>"
			."" . _NOTIFYSUBMISSION . "</td><td>";
		if ($notify==1) {
			echo "<input type='radio' name='xnotify' value='1' checked>" . _YES . " &nbsp;<input type='radio' name='xnotify' value='0'>" . _NO . "";
		} else {
			echo "<input type='radio' name='xnotify' value='1'>" . _YES . " &nbsp;<input type='radio' name='xnotify' value='0' checked>" . _NO . "";
		}
		echo "</td></tr><tr><td>"
			."" . _EMAIL2SENDMSG . ":</td><td><input type='text' name='xnotify_email' value='$notify_email' size='30' maxlength='100'>"
			."</td></tr><tr><td>"
			."" . _EMAILSUBJECT . ":</td><td><input type='text' name='xnotify_subject' value='$notify_subject' size='40' maxlength='100'>"
			."</td></tr><tr><td>"
			."" . _EMAILMSG . ":</td><td><textarea name='xnotify_message' cols='70' rows='15'>$notify_message</textarea>"
			."</td></tr><tr><td>"
			."" . _EMAILFROM . ":</td><td><input type='text' name='xnotify_from' value='$notify_from' size='15' maxlength='25'>"
			."</td></tr><tr><td>&nbsp;</td><td halign=\"left\"><input type='hidden' name='op' value='savemailing'>"
			."<br><br><input type='submit' value='" . _SAVECHANGES . "'></form></td></tr></table>";		
		CloseTable();
		include("footer.php");
	}

	function other() {
		global $prefix, $db, $admin_file;
		include ("header.php");
		GraphicAdmin();
		options_menu("other");
		OpenTable();
		$row = $db->sql_fetchrow($db->sql_query("SELECT top, storyhome, oldnum from ".$prefix."_config"));
		$top = intval($row['top']);
		$storyhome = intval($row['storyhome']);
		$oldnum = intval($row['oldnum']);
		if ($top == 5) { $sel1 = "selected"; }
		if ($top == 10) { $sel2 = "selected"; }
		if ($top == 15) { $sel3 = "selected"; }
		if ($top == 20) { $sel4 = "selected"; }
		if ($top == 25) { $sel5 = "selected"; }
		if ($top == 30) { $sel6 = "selected"; }
		if ($storyhome == 5) { $sela1 = "selected"; }
		if ($storyhome == 10) { $sela2 = "selected"; }
		if ($storyhome == 15) { $sela3 = "selected"; }
		if ($storyhome == 20) { $sela4 = "selected"; }
		if ($storyhome == 25) { $sela5 = "selected"; }
		if ($storyhome == 30) { $sela6 = "selected"; }
		if ($oldnum == 10) { $selb1 = "selected"; }
		if ($oldnum == 20) { $selb2 = "selected"; }
		if ($oldnum == 30) { $selb3 = "selected"; }
		if ($oldnum == 40) { $selb4 = "selected"; }
		if ($oldnum == 50) { $selb5 = "selected"; }
		echo "<center><font class='option'><b>"._OTHERCONFIG."</b></font></center>"
			."<form action='".$admin_file.".php' method='post'>"
			."<table border=\"0\" align=\"center\" cellpadding=\"3\"><tr><td>"
			."" . _ITEMSTOP . ":</td><td><select name='xtop'>"
			."<option name='xtop' $sel1>5</option>"
			."<option name='xtop' $sel2>10</option>"
			."<option name='xtop' $sel3>15</option>"
			."<option name='xtop' $sel4>20</option>"
			."<option name='xtop' $sel5>25</option>"
			."<option name='xtop' $sel6>30</option>"
			."</select>"
			."</td></tr><tr><td>"
			."" . _STORIESHOME . ":</td><td><select name='xstoryhome'>"
			."<option name='xstoryhome' $sela1>5</option>"
			."<option name='xstoryhome' $sela2>10</option>"
			."<option name='xstoryhome' $sela3>15</option>"
			."<option name='xstoryhome' $sela4>20</option>"
			."<option name='xstoryhome' $sela5>25</option>"
			."<option name='xstoryhome' $sela6>30</option>"
			."</select>"
			."</td></tr><tr><td>"
			."" . _OLDSTORIES . ":</td><td><select name='xoldnum'>"
			."<option name='xoldnum' $selb1>10</option>"
			."<option name='xoldnum' $selb2>20</option>"
			."<option name='xoldnum' $selb3>30</option>"
			."<option name='xoldnum' $selb4>40</option>"
			."<option name='xoldnum' $selb5>50</option>"
			."</select>"
			."</td></tr><tr><td>&nbsp;</td><td halign=\"left\"><input type='hidden' name='op' value='saveother'>"
			."<br><br><input type='submit' value='" . _SAVECHANGES . "'></form></td></tr></table>";		
		CloseTable();
		include("footer.php");
	}

	function savegeneral($xsitename, $xnukeurl, $xslogan, $xstartdate, $xadmingraphic, $xgfx_chk, $xnuke_editor, $xdisplay_errors) {
		global $prefix, $db, $admin_file;
		$xsitename = filter($xsitename, "nohtml", 1);
		$xnukeurl = filter($xnukeurl, "nohtml", 1);
		$xslogan = filter($xslogan, "nohtml", 1);
		$xstartdate = filter($xstartdate, "nohtml", 1);
		$xadmingraphic = intval($xadmingraphic);
		$xgfx_chk = intval($xgfx_chk);
		$xnuke_editor = intval($xnuke_editor);
		$xdisplay_errors = intval($xdisplay_errors);
		$db->sql_query("UPDATE ".$prefix."_config SET sitename='$xsitename', nukeurl='$xnukeurl', site_logo='$xsite_logo', slogan='$xslogan', startdate='$xstartdate', admingraphic='$xadmingraphic', gfx_chk='$xgfx_chk', nuke_editor='$xnuke_editor', display_errors='$xdisplay_errors'");
		Header("Location: ".$admin_file.".php?op=general");
		die();
	}

	function savethemes($xDefault_Theme, $xoverwrite_theme) {
		global $prefix, $db, $admin_file;
		$xDefault_Theme = filter($xDefault_Theme, "nohtml", 1);
		$xoverwrite_theme = intval($xoverwrite_theme);
		$db->sql_query("UPDATE ".$prefix."_config SET Default_Theme='$xDefault_Theme', overwrite_theme='$xoverwrite_theme'");		
		Header("Location: ".$admin_file.".php?op=themes");
		die();
	}

	function saveusers($xanonymous, $xanonpost, $xoverwrite_theme, $xminpass, $xbroadcast_msg, $xmy_headlines, $xuser_news) {
		global $prefix, $db, $admin_file;
		$xanonymous = filter($xanonymous, "nohtml", 1);
		$xanonpost = intval($xanonpost);
		$xoverwrite_theme = intval($xoverwrite_theme);
		$xminpass = intval($xminpass);
		$xbroadcast_msg = intval($xbroadcast_msg);
		$xmy_headlines = intval($xmy_headlines);
		$xuser_news = intval($xuser_news);
		$db->sql_query("UPDATE ".$prefix."_config SET anonymous='$xanonymous', anonpost='$xanonpost', overwrite_theme='$xoverwrite_theme', minpass='$xminpass', broadcast_msg='$xbroadcast_msg', my_headlines='$xmy_headlines', user_news='$xuser_news'");
		Header("Location: ".$admin_file.".php?op=users");
		die();
	}

	function savecomments($xanonpost, $xmoderate, $xcommentlimit, $xpollcomm, $xarticlecomm, $xCensorMode, $xCensorReplace) {
		global $prefix, $db, $admin_file;
		$xanonpost = intval($xanonpost);
		$xmoderate = intval($xmoderate);
		$xcommentlimit = intval($xcommentlimit);
		$xpollcomm = intval($xpollcomm);
		$xarticlecomm = intval($xarticlecomm);
		$xCensorMode = intval($xCensorMode);
		$xCensorReplace = filter($xCensorReplace, "nohtml", 1);
		$db->sql_query("UPDATE ".$prefix."_config SET anonpost='$xanonpost', moderate='$xmoderate', commentlimit='$xcommentlimit', pollcomm='$xpollcomm', articlecomm='$xarticlecomm', CensorMode='$xCensorMode', CensorReplace='$xCensorReplace'");
		Header("Location: ".$admin_file.".php?op=comments");
		die();
	}

	function savelanguages($xlanguage, $xlocale, $xmultilingual, $xuseflags, $xbackend_language) {
		global $prefix, $db, $admin_file;
		$xlanguage = filter($xlanguage, "nohtml", 1);
		$xlocale = filter($xlocale, "nohtml", 1);
		$xmultilingual = intval($xmultilingual);
		$xuseflags = intval($xuseflags);
		$xbackend_language = filter($xbackend_language, "nohtml", 1);
		$db->sql_query("UPDATE ".$prefix."_config SET language='$xlanguage', locale='$xlocale', multilingual='$xmultilingual', useflags='$xuseflags', backend_language='$xbackend_language'");
		Header("Location: ".$admin_file.".php?op=languages");
		die();
	}

	function savefooter($xfoot1, $xfoot2, $xfoot3) {
		global $prefix, $db, $admin_file;
		$xfoot1 = filter($xfoot1, "", 1);
		$xfoot2 = filter($xfoot2, "", 1);
		$xfoot3 = filter($xfoot3, "", 1);
		$db->sql_query("UPDATE ".$prefix."_config SET foot1='$xfoot1', foot2='$xfoot2', foot3='$xfoot3'");
		Header("Location: ".$admin_file.".php?op=footer");
		die();
	}

	function savebackend($xbackend_title, $xbackend_language, $xsite_logo, $xultramode) {
		global $prefix, $db, $admin_file;
		$xbackend_title = filter($xbackend_title, "nohtml", 1);
		$xbackend_language = filter($xbackend_language, "nohtml", 1);
		$xsite_logo = filter($xsite_logo, "nohtml", 1);
		$xultramode = intval($xultramode);
		$db->sql_query("UPDATE ".$prefix."_config SET backend_title='$xbackend_title', backend_language='$xbackend_language', site_logo='$xsite_logo', ultramode='$xultramode'");
		Header("Location: ".$admin_file.".php?op=backend");
		die();
	}

	function savereferers($xhttpref, $xhttprefmax, $xhttprefmode) {
		global $prefix, $db, $admin_file;
		$xhttpref = intval($xhttpref);
		$xhttprefmax = intval($xhttprefmax);
		$xhttprefmode = intval($xhttprefmode);
		$db->sql_query("UPDATE ".$prefix."_config SET httpref='$xhttpref', httprefmax='$xhttprefmax', httprefmode='$xhttprefmode'");
		Header("Location: ".$admin_file.".php?op=referers");
		die();
	}

	function savemailing($xadminmail, $xnotify, $xnotify_email, $xnotify_subject, $xnotify_message, $xnotify_from) {
		global $prefix, $db, $admin_file;
		$xadminmail = filter($xadminmail, "nohtml", 1);
		$xnotify= intval($xnotify);
		$xnotify_email = filter($xnotify_email, "nohtml", 1);
		$xnotify_subject = filter($xnotify_subject, "nohtml", 1);
		$xnotify_message = filter($xnotify_message, "", 1);
		$xnotify_from = filter($xnotify_from, "nohtml", 1);
		$db->sql_query("UPDATE ".$prefix."_config SET adminmail='$xadminmail', notify='$xnotify', notify_email='$xnotify_email', notify_subject='$xnotify_subject', notify_message='$xnotify_message', notify_from='$xnotify_from'");
		Header("Location: ".$admin_file.".php?op=mailing");
		die();
	}

	function saveother($xtop, $xstoryhome, $xoldnum) {
		global $prefix, $db, $admin_file;
		$xtop = intval($xtop);
		$xstoryhome = intval($xstoryhome);
		$xoldnum = intval($xoldnum);	
		$db->sql_query("UPDATE ".$prefix."_config SET top='$xtop', storyhome='$xstoryhome', oldnum='$xoldnum'");
		Header("Location: ".$admin_file.".php?op=other");
		die();
	}

	switch($op) {

		case "Configure":
		Configure();
		break;

		case "general":
		general();
		break;

		case "savegeneral":
		savegeneral($xsitename, $xnukeurl, $xslogan, $xstartdate, $xadmingraphic, $xgfx_chk, $xnuke_editor, $xdisplay_errors);
		break;

		case "themes":
		themes();
		break;
		
		case "savethemes":
		savethemes($xDefault_Theme, $xoverwrite_theme);
		break;

		case "users":
		users();
		break;

		case "saveusers":
		saveusers($xanonymous, $xanonpost, $xoverwrite_theme, $xminpass, $xbroadcast_msg, $xmy_headlines, $xuser_news);
		break;
		
		case "comments":
		comments();
		break;
		
		case "savecomments":
		savecomments($xanonpost, $xmoderate, $xcommentlimit, $xpollcomm, $xarticlecomm, $xCensorMode, $xCensorReplace);
		break;

		case "languages":
		languages();
		break;
		
		case "savelanguages":
		savelanguages($xlanguage, $xlocale, $xmultilingual, $xuseflags, $xbackend_language);
		break;

		case "footer":
		footer();
		break;
		
		case "savefooter":
		savefooter($xfoot1, $xfoot2, $xfoot3);
		break;

		case "backend":
		backend();
		break;
		
		case "savebackend":
		savebackend($xbackend_title, $xbackend_language, $xsite_logo, $xultramode);
		break;

		case "referers":
		referers();
		break;
		
		case "savereferers":
		savereferers($xhttpref, $xhttprefmax, $xhttprefmode);
		break;

		case "mailing":
		mailing();
		break;
		
		case "savemailing":
		savemailing($xadminmail, $xnotify, $xnotify_email, $xnotify_subject, $xnotify_message, $xnotify_from);
		break;

		case "other":
		other();
		break;
		
		case "saveother":
		saveother($xtop, $xstoryhome, $xoldnum);
		break;

	}

} else {
	echo "Access Denied";
}

?>