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

function atPlatformHeader($xhtml)
{
	return false;
}

function atPlatformAPIInit($atdir)
{
    return array();
}

function atPlatformThemeInit($thename)
{
    $GLOBALS['home_page'] = $GLOBALS['home'];
    $GLOBALS['home'] = 0;

    if (isset($_GET['theme'])) {
        $oldtheme = $thename;
        $thename = $_GET['theme'];
        $GLOBALS['oldtheme'] = $oldtheme;
    }
    $vars = compact("thename");

    return $vars;
}

function atGetPlatformVersion()
{
    return $GLOBALS['Version_Num'];
}

function atGetHomeMod()
{
        $module = $GLOBALS['main_module'];

    return $module;
}

function atIsHomePage()
{
    if ($GLOBALS['home_page'] == 1 || empty($_SERVER['QUERY_STRING'])) {
        return true;
    }
    else {
        return false;
    }
}

function atIsAdminUser()
{
    if (is_admin($GLOBALS['admin'])) {
        return true;
    }
    else {
        return false;
    }
}

function atIsLoggedIn()
{
    if (is_user($GLOBALS['user'])) {
        return true;
    }
    else {
        return false;
    }
}

function atGetUserName()
{
    if (!atIsLoggedIn()) {
        $username = _AT_GUEST;
    }
    else {
        $cookie = cookiedecode($GLOBALS['user']);
        $username = $cookie[1];
    }
    return $username;
}

function atGetModType()
{
    $type = "";

    if (eregi("admin.php", $_SERVER['PHP_SELF'])) {
        $type = "admin";
    }
    elseif (atGetModName() == "Your_Account") {
        $type = "user";
    }
    return $type;
}

function atGetModStyle()
{
    $style = "old";

    return $style;
}

function atGetModName()
{
    if (!empty($GLOBALS['module_name'])) {
    	return $GLOBALS['module_name'];
    }
    elseif (!empty($GLOBALS['module'])) {
    	return $GLOBALS['module'];
    }
    elseif (!empty($_REQUEST['name'])) {
    	return $_REQUEST['name'];
    }
}

function atGetLang()
{
    $lang = $GLOBALS['currentlang'];

    include_once("modules/AutoTheme/lang/lang.php");

    if (defined($lang)) {
        $lang = constant($lang);
    }
    return $lang;
}

function atBlockLoad($location="", $title="")
{
	if (!defined('BLOCK_FILE')) {
		define('BLOCK_FILE', true);
	}
    $runningconfig = atGetRunningConfig();
	$blocklist = $runningconfig['blocklist'];

    if ($location) {
    	foreach ($blocklist as $block) {
    		if ($block['position'] == $location && $block['active'] == 1) {
    			$blocks[] = $block;
    		}
    	}
    }
    elseif ($title) {
    	if ($blocklist[$title]['active'] == 1) {
    		$blocks[] = $blocklist[$title];
    	}
    }
    if (is_array($blocks)) {
    	foreach ($blocks as $theblock) {
    		atRunningSetVar("block", $theblock);

    		extract($theblock);

    		if ($bkey == "admin") {
    			adminblock();
    		}
    		elseif ($bkey == "userbox") {
    			userblock();
    		}
    		elseif ($bkey == "") {
    			$displaythis = 0;

    			if ($view == 0) {
    				$displaythis = 1;
    			}
    			elseif ($view == 1 && atIsLoggedIn() || atIsAdminUser()) {
    				$displaythis = 1;
    			}
    			elseif ($view == 2 && atIsAdminUser()) {
    				$displaythis = 1;
    			}
    			elseif ($view == 3 && !atIsLoggedIn() || atIsAdminUser()) {
    				$displaythis = 1;
    			}
    			if ($displaythis) {
    				if ($url == "") {
    					if ($blockfile == "") {
    						themesidebox($title, $content);
    					}
    					else {
    						blockfileinc($title, $blockfile);
    					}
    				}
    				else {
    					headlines($bid);
    				}
    			}
    		}
    	}
    }
}

function atGetBlocks()
{
    $dbi = $GLOBALS['dbi'];
    $prefix = $GLOBALS['prefix'];
    $language = $GLOBALS['currentlang'];
    $ml = $GLOBALS['multilingual'];

    if (!defined('AUTOTHEME_ADMIN_LOADED') && $ml) {
    	$querylang = "WHERE (blanguage='$language' OR blanguage='')";
    }
    else {
    	$querylang = "";
    }

	$result = sql_query("SELECT bid, bkey, title, content, url, blockfile, view, bposition, weight, active FROM ".$prefix."_blocks $querylang ORDER BY weight ASC", $dbi);

    while (list($bid, $bkey, $title, $content, $url, $blockfile, $view, $position, $weight, $active) = sql_fetch_row($result, $dbi)) {
        $blocklist[$title] = compact("bid", "bkey", "title", "content", "url", "blockfile", "view", "position", "weight", "active");
        $blocklist[$title]['weight'] = (int)$blocklist[$title]['weight'];
    }
    return $blocklist;
}

function atBlockList()
{
    $dbi = $GLOBALS['dbi'];
    $prefix = $GLOBALS['prefix'];

    $result = sql_query("SELECT title FROM ".$prefix."_blocks ORDER BY title", $dbi);

    while (list($title) = sql_fetch_row($result, $dbi)) {
        $blocklist[] = $title;
    }
    return $blocklist;
}

function atThemeList($dir="themes")
{
    $dir = AT_DIRPREFIX."themes";

	if ($handle = @opendir($dir)) {
        while (false !== ($subdir = @readdir($handle))) {
            if (@is_dir("$dir/$subdir") &&
                $subdir !== '.' &&
                $subdir !== '..' &&
                @file_exists("$dir/$subdir/theme.cfg"))
            {
                $themelist[] = $subdir;
            }
        }
        closedir($handle);
    }
    natcasesort($themelist);

    return $themelist;
}

function atModList($dir="modules")
{
    $modlist = array(
        "*AdminPages",
        "*HomePage",
        "*UserPages"
    );

    if ($handle = @opendir($dir)) {
        while (false !== ($subdir = @readdir($handle))) {
            if (@is_dir("$dir/$subdir") &&
                $subdir !== '.' &&
                $subdir !== '..')
            {
                $modlist[] = $subdir;
            }
        }
        closedir($handle);
    }
    return $modlist;
}

function atThemeSet($theme, $douser=0)
{
	$dbi = $GLOBALS['dbi'];
	$prefix = $GLOBALS['prefix'];
	$userprefix = $GLOBALS['user_prefix'];
	$user = $GLOBALS['user'];

	if (isset($theme) && @file_exists("themes/$theme/theme.cfg")) {
    	sql_query("UPDATE ".$prefix."_config SET Default_Theme='$theme'", $dbi);

	    if (atIsLoggedIn() && $douser) {
			$username = atGetUserName();
			sql_query("UPDATE ".$userprefix."_users SET theme='$theme' WHERE username='$username'", $dbi);
			$userinfo = getusrinfo($user);
			docookie($userinfo['user_id'], $userinfo['username'], $userinfo['user_password'], $userinfo['storynum'], $userinfo['umode'], $userinfo['uorder'], $userinfo['thold'], $userinfo['noscore'], $userinfo['ublockon'], $theme, $userinfo['commentmax']);

		}
	}
}

function atGroupList()
{
	return array();
}

function atIsInGroup($group)
{
	return false;
}

?>
