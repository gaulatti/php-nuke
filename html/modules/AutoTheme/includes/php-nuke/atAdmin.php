<?php
// ----------------------------------------------------------------------
// Copyright (c) 2002-2006 Shawn McKenzie
// http://spidean.mckenzies.net
// ----------------------------------------------------------------------
//
//
// LICENSE
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
//
//
// ----------------------------------------------------------------------

if (!defined('ADMIN_FILE')) {
	if (!eregi("admin.php", $_SERVER['PHP_SELF'])) {
		die ("Access Denied");
	}
}

function atPlatformAdminInit()
{
	return array();	
}

function atAdminHeader($title="")
{
    include("header.php");
    $adminlinks = "admin.php?module=AutoTheme";
    atAdminOpenTable();
    atAdminOpenTable();
    echo "<div align=\"center\">"
    ."<a href =\"admin.php\">"._AT_ADMINMENU."</a>"
    ."</div><br />\n"
    ."<div align=\"center\">"
    ."[ <a href =\"$adminlinks&op=main\">"._AT_ATADMIN."</a> ]"
    ."<br />\n"
    ."[ <a href=\"$adminlinks&op=athemes\">"._AT_AUTOTHEMES."</a> | "
    ."<a href=\"$adminlinks&op=cmdedit\">"._AT_COMMANDS."</a> | "
    ."<a href=\"$adminlinks&op=extras\">"._AT_EXTRAS."</a> ]\n"
    ."</div>\n";
    atAdminCloseTable();
    if ($title) {
        echo "<br />";
    }
    echo "<div align=\"center\"><b>$title</b></div>\n"
    ."<br />\n";
}

function atAdminFooter()
{
    $adminlinks = "admin.php?module=AutoTheme";
    atAdminCloseTable();
    echo "<br />";
    atAdminOpenTable();
    echo "<div align=\"center\">\n"
    ."AutoTheme 0.87<br />\n"
    ."Copyright (c) 2002-2006 Shawn McKenzie<br />\n"
    ."<a target=\"_blank\" href=\"http://spidean.mckenzies.net\">http://spidean.mckenzies.net</a>\n"
    ."</div>\n";
    atAdminCloseTable();

    include("footer.php");
}

function at_preview_url($module, $modops, $theme)
{
	switch ($module) {
		case "":
		case "*HomePage":
		$page = "index.php?";
		break;
		
		case "*UserPages":
		$page = "user.php?";
		break;
		
		case "*AdminPages":
		$page = "admin.php?";
		break;
		
		default:
		$page = "modules.php?name=$module&";
		break;
	}	
	$prevpage = $page."theme=$theme";
	
	if ($modops && $modops != "default") {
		$prevpage .= "&$modops";
	}
	return "[ <a href=\"$prevpage\" target=\"_blank\">"._AT_PREVIEW."</a> | \n";
}

?>
