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

if ( !defined('BLOCK_FILE') ) {
	Header("Location: ../index.php");
	fdie();
}

global $prefix, $db, $admin, $language, $currentlang;

$ThemeSel = get_theme();
if (file_exists("themes/$ThemeSel/module.php")) {
	include("themes/".$ThemeSel."/module.php");
	if (is_active($default_module) AND file_exists("modules/$default_module/index.php")) {
		$def_module = $default_module;
	} else {
	    $def_module = "";
	}
    }

    $row = $db->sql_fetchrow($db->sql_query("SELECT main_module FROM ".$prefix."_main"));
    $main_module = filter($row['main_module'], "nohtml");

    /* If the module doesn't exist, it will be removed from the database automaticaly */
    $result2 = $db->sql_query("SELECT title FROM " . $prefix . "_modules");
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
	    $db->sql_query("DELETE FROM ".$prefix."_modules WHERE title='$title'");
	}
    }

    /* Now we make the Modules block with the correspondent links */

    $content .= "<li><a href=\"index.php\">"._HOME."</a></li>";
    //$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"/pixel\">PIXEL ADS</a><br>\n";
    $result3 = $db->sql_query("SELECT title, custom_title, view FROM " . $prefix . "_modules WHERE active='1' AND title!='$def_module' AND inmenu='1' ORDER BY custom_title ASC");
    while ($row3 = $db->sql_fetchrow($result3)) {
	$m_title = filter($row3['title'], "nohtml");
	$custom_title = filter($row3['custom_title'], "nohtml");
	$view = intval($row3['view']);
	$m_title2 = ereg_replace("_", " ", $m_title);
	if ($custom_title != "") {
	    $m_title2 = $custom_title;
	}
	if ($m_title != $main_module) {
	    if ((is_admin($admin) AND $view == 2) OR $view != 2) {
		$content .= "<li><a href=\"modules.php?name=$m_title\">$m_title2</li>";
	    }
	}
    }
    /* If you're Admin you and only you can see Inactive modules and test it */
    /* If you copied a new module is the /modules/ directory, it will be added to the database */
    
    if (is_admin($admin)) {
	$handle=opendir('modules');
	while ($file = readdir($handle)) {
	    if ( (!ereg("[.]",$file)) ) {
		$modlist .= "$file ";
	    }
	}
	closedir($handle);
	$modlist = explode(" ", $modlist);
	sort($modlist);
	for ($i=0; $i < sizeof($modlist); $i++) {
	    if($modlist[$i] != "") {
		$row4 = $db->sql_fetchrow($db->sql_query("SELECT mid FROM ".$prefix."_modules WHERE title='$modlist[$i]'"));
		$mid = intval($row4['mid']);
		$mod_uname = ereg_replace("_", " ", $modlist[$i]);
		if ($mid == "") {
		    $db->sql_query("INSERT INTO ".$prefix."_modules VALUES (NULL, '$modlist[$i]', '$mod_uname', '0', '0', '1', '0')");
		}
	    }
	}
	$content .= "<br><center><b>"._INVISIBLEMODULES."</b><br>";
	$content .= "<font class=\"tiny\">"._ACTIVEBUTNOTSEE."</font></center><br>";
	$result5 = $db->sql_query("SELECT title, custom_title FROM ".$prefix."_modules WHERE active='1' AND inmenu='0' ORDER BY title ASC");
	while ($row5 = $db->sql_fetchrow($result5)) {
	    $mn_title = filter($row5['title'], "nohtml");
	    $custom_title = filter($row5['custom_title'], "nohtml");
	    $mn_title2 = ereg_replace("_", " ", $mn_title);
	    if ($custom_title != "") {
		$mn_title2 = $custom_title;
	    }
	    if ($mn_title2 != "") {
		$content .= "<li><a href=\"modules.php?name=$mn_title\">$mn_title2</a></li>";
		$dummy = 1;
	    } else {
		$a = 1;
	    }
	}
	if ($a == 1 AND $dummy != 1) {
    	    $content .= "<li>"._NONE."</li>";
	}
	$content .= "<li>"._NOACTIVEMODULES."</li>";
	$content .= "<font class=\"tiny\">"._FORADMINTESTS."</font></center><br>";
	$result6 = $db->sql_query("SELECT title, custom_title FROM ".$prefix."_modules WHERE active='0' ORDER BY title ASC");
	while ($row6 = $db->sql_fetchrow($result6)) {
	    $mn_title = filter($row6['title'], "nohtml");
	    $custom_title = filter($row6['custom_title'], "nohtml");
	    $mn_title2 = ereg_replace("_", " ", $mn_title);
		if (!empty($custom_title)) {
		$mn_title2 = $custom_title;
	    }
	    if (!empty($mn_title2)) {
		$content .= "<li><a href=\"modules.php?name=$mn_title\">$mn_title2</li>";
		$dummy = 1;
	    } else {
		$a = 1;
	    }
	}
	if ($a == 1 AND $dummy != 1) {
    	    $content .= "<li>"._NONE."</li>";
	}
    }

?>
