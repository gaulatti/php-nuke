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

define('AUTOTHEME_ADMIN_LOADED', TRUE);
define('AT_ADMINPAGE', $_SERVER['PHP_SELF']);

if (!defined('AT_DIRPREFIX')) {
	define('AT_DIRPREFIX', '');
}
if (!defined('AT_WEBPREFIX')) {
	define('AT_WEBPREFIX', '');
}
include_once(AT_DIRPREFIX."modules/AutoTheme/includes/atAPI.php");
atAdminInit();

/* main admin function */
function AutoTheme_admin_main($var)
{
    $autoconfig = atGetAutoConfig();
    extract($autoconfig);
	
	$var = atExportVar($var);
    extract($var);

    $adminlinks = AT_ADMINPAGE."?module=AutoTheme";
    $modlist = atModList();
    
    atAdminHeader();    
    atAdminOpenTable();
    echo "<b><a href=\"$adminlinks&op=athemes\">"._AT_AUTOTHEMES."</a></b></td><td>"._AT_ATDESCR."</td></tr>\n"
    ."<tr><td><b><a href=\"$adminlinks&op=extras\">"._AT_EXTRAS."</a></b></td><td>"._AT_EXTRASDESCR
    ."<tr><td><b><a href=\"$adminlinks&op=cmdedit\">"._AT_COMMANDS."</a></b></td><td>"._AT_CMDDESCR."</td></tr>\n";
    atAdminCloseTable();
    echo "<br />";
    
    atAdminOpenTable();
    $themedir = $cmsoption['themedir'];	
	
	$themelist = atThemeList();

    echo "<form method=\"POST\" action=\"".AT_ADMINPAGE."\">\n"
    ."<b>"._AT_SETTHEME."</b><br />\n"
    ."<select name=\"themedir\">\n";
    foreach ($themelist as $theme) {
    	if ($theme == $themedir) {
    		$sel = " selected";
    	}
    	else {
    		$sel = "";
    	}    		
        echo "  <option$sel>$theme</option>\n";
    }
    echo "</select><br /><br />\n"
    ."<input type=\"hidden\" name=\"op\" value=\"settheme\">\n"
    ."<input type=\"hidden\" name=\"module\" value=\"AutoTheme\">\n"
    ."<input type=\"submit\" value=\""._AT_SAVE."\" name=\"B1\">\n"
    ."</form>\n";
    atAdminCloseTable();
    atAdminFooter();
}

function AutoTheme_admin_settheme($var)
{
	$var = atExportVar($var);
    extract($var);
	
	atThemeSet($themedir);
	
	$cmsoption['themedir'] = $themedir;
	
	$var = compact("cmsoption");
	atSaveAutoConfig($var);
	
    Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=main");
}

function AutoTheme_admin_updatemain($var)
{
	$var = atExportVar($var);
    extract($var);
	
	$autoconfig = atGetAutoConfig();
	extract($autoconfig);
	
	if (isset($mod)) {
		if (isset($add)) {
			$cache['exclude'][] = $mod;
		}
		else {
			$key = array_search($mod, $cache['exclude']);
			unset($cache['exclude'][$key]);
		}
	}
	elseif (isset($cache_on)) {
		$cache['on'] = $cache_on;
		$cache['expire'] = $cache_expire;
	}
	$var = compact("cache");	
	atSaveAutoConfig($var);
	
	Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=main");
}

function AutoTheme_admin_extras($var)
{
    $autoconfig = atGetAutoConfig();
    extract($autoconfig);

    $var = atExportVar($var);
    extract($var);
    
    atAdminHeader(_AT_EXTRAS);
    
	atAdminOpenTable();
    echo "<form method=\"POST\" action=\"".AT_ADMINPAGE."\">\n"
    ."  <input type=\"hidden\" name=\"op\" value=\"updateextras\">\n"
    ."  <input type=\"hidden\" name=\"module\" value=\"AutoTheme\">\n"
    ."  <b>"._AT_EXTRA."</b></td><td><b>"._AT_DESCRIPTION."</b></td><td><b>"._AT_ENABLE."</b></td><td><b>"._AT_ACTION."</b></td></tr><tr><td>\n";
    
    if (!$ext = atAutoGetVar("extra")) {
        $ext = atExtraScan($extradir);
    }
    if (!$ext) {
        return;
    }
    ksort($ext);
    foreach ($ext as $id => $info) {
        $yes = $no = "";
        
        $extraname = $id;
                
        $name = "_AT_".strtoupper($extraname)."_NAME";
        $descr = "_AT_".strtoupper($extraname)."_DESCRIPTION";
        
        if (!defined($descr)) {
        	$descr = $info['description'];
        }
        else {
        	$descr = constant($descr);
        }
        if (!defined($name)) {
        	$name = $info['name'];
        }
        else {
        	$name = constant($name);
        }
        if ($autoextra[$id]) {
            $yes = "checked";
        }
        else {
            $no = "checked";
        }
        echo "$name</td><td>$descr</td><td>"
        ."<input type=\"hidden\" name=\"extra[]\" value=\"$id\">\n"
        ."<input type=\"radio\" name=\"$id\" value=\"1\" $yes>"._AT_YES."\n"
        ."<input type=\"radio\" name=\"$id\" value=\"0\" $no>"._AT_NO."</td><td>";

        if ($info['atadmin'] && function_exists($info['atadmin']) && $yes == "checked") {
        	echo "[ <a href=\"".AT_ADMINPAGE."?module=AutoTheme&op=extraops&extraname=".htmlentities(urlencode($id))."\">"._AT_CONFIGURE."</a> ]";
        }
        elseif ($info['atadmin'] && function_exists($info['atadmin']) && $yes != "checked") {
            echo "[ "._AT_CONFIGURE." ]";
        }
        if ($info['themeadmin'] && function_exists($info['themeadmin'])) {
            echo "*";
        }
        if ($info['modadmin'] && function_exists($info['modadmin'])) {
            echo "**";
        }
        echo "</td></tr><tr><td>";
    }
    echo "</td></tr><tr><td><input type=\"submit\" value=\""._AT_SAVE."\" name=\"B1\">\n"
    ."</form></td><td>&nbsp;\n";

    atAdminCloseTable();
    echo _AT_EXTRANOTE;
    atAdminFooter();
}
function AutoTheme_admin_extraops($var)
{	
	$autoconfig = atGetAutoConfig();
    extract($autoconfig);

    $var = atExportVar($var);
    extract($var);
	
	$extra = atExtraLoad($extraname);
	
	$description = "_AT_".strtoupper($extraname)."_DESCRIPTION";
    $name = "_AT_".strtoupper($extraname)."_NAME";
    $help = "_AT_".strtoupper($extraname)."_HELP";
    
    if (!defined($description)) {
    	$description = $extra['description'];
    }
    else {
    	$description = constant($description);
    }
    if (!defined($name)) {
    	$name = $extra['name'];
    }
    else {
    	$name = constant($name);
    }    
    if (!defined($help)) {
    	$help = _AT_NOHELP;
    }
    else {
    	$help = constant($help);
    }
    if ($thememod) {
        atAdminThemeLinks($themedir, $name, $var, 1);
        $extrafunc = $extra['modadmin'];
        
        $themepath = at_gettheme_path($themedir);

        $themeconfig = atLoadThemeConfig($themepath);
        extract($themeconfig);
    }
	elseif ($themedir) {
        atAdminThemeLinks($themedir, $name, $var);
        $extrafunc = $extra['themeadmin'];
        
        $themepath = at_gettheme_path($themedir);

        $themeconfig = atLoadThemeConfig($themepath);
        extract($themeconfig);
    }
    elseif (!$themedir) {
        atAdminHeader($extra['name']);	
	    $extrafunc = $extra['atadmin'];
    }
    if (is_array($$extraname)) {
        if ($thememod) {
        	if ($modops) {
        		$args = ${$extraname}[$thememod][$modops];
        	}
        	else {
        		$args = ${$extraname}['default'];
			}
        }
        else {
        	$args = $$extraname;
        }
    }
    else {
        $args = array();
    }
    $args = array_merge((array)$var, (array)$args);
    
    if (function_exists("$extrafunc")) {
    	$output = $extrafunc($args);
    }
    else {
        Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=extras");
    }
    atAdminOpenTable();
    
    echo "<b>"._AT_DESCRIPTION."</b>: $description<br />";
    echo "<b>"._AT_VERSION."</b>: ".$extra['version']."<br />";
    echo "<b>"._AT_AUTHOR."</b>: ".$extra['author']."<br />";
    echo "<b>"._AT_CONTACT."</b>: ".$extra['contact']."<br />";
    atAdminCloseTable();
    
    echo "<br /><b>$name</b>: ".$help."<br /><br />";    
    
    atAdminOpenTable();
    echo "<form method=\"POST\" action=\"".AT_ADMINPAGE."\">\n"
    ."  <input type=\"hidden\" name=\"op\" value=\"updateextraops\">\n"
	."  <input type=\"hidden\" name=\"module\" value=\"AutoTheme\">\n"
	."  <input type=\"hidden\" name=\"themedir\" value=\"$themedir\">\n"
	."  <input type=\"hidden\" name=\"extraname\" value=\"$extraname\">\n"
	."  <input type=\"hidden\" name=\"thememod\" value=\"$thememod\">\n"
	."  <input type=\"hidden\" name=\"modops\" value=\"$modops\">\n"
    .$output."<br />"
	."  <input type=\"submit\" value=\""._AT_SAVE."\" name=\"B1\">\n"
    ."</form>\n";
    atAdminCloseTable();
    atAdminFooter();
}

/* Update optional settings */
function AutoTheme_admin_updateextraops($var)
{
    $var = atExportVar($var);
    extract($var);

    $extraname = $var['extraname'];
    
    if ($themedir) {
    	$themepath = at_gettheme_path($themedir);
    	$themeconfig = atLoadThemeConfig($themepath);
    	extract($themeconfig);
    }
    unset($var['op'], $var['module'], $var['extraname'], $var['themedir'], $var['B1'], $var['thememod'], $var['modops']);

    foreach ($var as $key => $val) {
        if (is_array($val)) {
            foreach ($val as $k => $v) {
                if ($v != "") {
                    $extra[$key][$k] = $v;
                }
            }
        }
        else {
            $extra[$key] = $val;
        }
    }
    if ($themedir) {
    	if ($thememod) {
    		if ($modops) {
    			${$extraname}[$thememod][$modops] = $extra;
    		}
    		else {
    			${$extraname}['default'] = $extra;
    		}    			
    	}
    	else {
    		${$extraname} = $extra;
    	}
    	$var = compact($extraname);
        atSaveThemeConfig($themedir, $var);
        Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=atmain&themedir=$themedir");
    }
    else {
    	$extravars = $extra;
    	$$extraname = $extravars;  	
        $var = compact($extraname);
        atSaveAutoConfig($var);
        Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=extras");
    }
}

/* Update main settings */
function AutoTheme_admin_updateextras($var)
{
    $var = atExportVar($var);
    extract($var);
    
    foreach ($extra as $name) {
    	$autoextra[$name] = $$name;
    }
    $var = compact("autoextra");
    atSaveAutoConfig($var);

    Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=extras");
}

/* Main autoblock settings form */
function AutoTheme_admin_ablocks($var)
{
    $var = atExportVar($var);
    extract($var);
    
    $autoconfig = atGetAutoConfig();
    extract($autoconfig);
    
    atAdminThemeLinks($themedir, _AT_ACTIVEAUTOBLOCKS, $var);
    $themepath = at_gettheme_path($themedir);
    $themeconfig = atLoadThemeConfig($themepath);
    extract($themeconfig);

    atAdminOpenTable();
    echo "<form method=\"POST\" action=\"".AT_ADMINPAGE."\">\n"
    ."  <input type=\"hidden\" name=\"op\" value=\"updateablock\">\n"
    ."  <input type=\"hidden\" name=\"themedir\" value=\"$themedir\">\n"
    ."  <input type=\"hidden\" name=\"module\" value=\"AutoTheme\">\n"
    ."<b>"._AT_AUTOBLOCK."</b></td><td><b>"._AT_ACTION."</b></td></tr><tr><td>\n";

    echo _AT_LEFT."</td><td></td></tr><tr><td>\n";
    echo _AT_RIGHT."</td><td></td></tr><tr><td>\n";
    echo _AT_CENTER."</td><td></td></tr><tr><td>\n";
    
    if ($autoblock){
        ksort($autoblock);
        foreach ($autoblock as $key => $ablock){
            echo "<input type=\"text\" name=\"ablocktemp[$key]\" value=\"".atDisplayVar($ablock)."\" size=\"20\"></td><td>\n"
            ."[ <a href=\"".AT_ADMINPAGE."?module=AutoTheme&op=delablock&ablock=$key&themedir=".htmlentities(urlencode($themedir))."\">"._AT_REMOVE."</a> ]\n"
            ."</td></tr><tr><td>\n";
        }
        echo "<input type=\"submit\" value=\""._AT_SAVE."\" name=\"B1\"></td><td>&nbsp;\n";
    }
    else {
        echo _AT_NOACTIVEAUTOBLOCKS;
    }
    atAdminCloseTable();
    echo "</form><br />\n";
    atAdminOpenTable();
    echo "<form method=\"POST\" action=\"".AT_ADMINPAGE."\">\n"
    ."<b>"._AT_ADDAUTOBLOCK."</b><br />\n"
    ."<input type=\"text\" name=\"ablock\" size=\"20\">\n"
    ."<input type=\"hidden\" name=\"op\" value=\"addablock\">\n"
    ."<input type=\"hidden\" name=\"themedir\" value=\"$themedir\">\n"
    ."<input type=\"hidden\" name=\"module\" value=\"AutoTheme\">\n"
    ."<input type=\"submit\" value=\""._AT_ADD."\" name=\"B1\">\n"
    ."</form>\n";
    atAdminCloseTable();
    atAdminFooter();
}

/* Update autoblock settings */
function AutoTheme_admin_updateablock($var)
{
    $var = atExportVar($var);
    extract($var);
    
    $autoconfig = atGetAutoConfig();
    extract($autoconfig);
    
    if ($themedir) {
        $themeconfig = atLoadThemeConfig(AT_DIRPREFIX."themes/$themedir");
        extract($themeconfig);
    }
    else {
    	$themedir = "";
    }
    foreach ($ablocktemp as $key => $ablock){
        if ($ablock) {
            //$autoblock[$key] = atExportVar($ablock);
            $autoblock[$key] = $ablock;
        }
    }
    $autoblock = array_unique($autoblock);

    $var = compact("autoblock");
    atSaveThemeConfig($themedir, $var);
    
    Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=ablocks&themedir=$themedir");
}

/* Add an autoblock */
function AutoTheme_admin_addablock($var)
{
    $var = atExportVar($var);
    extract($var);
    
    $autoconfig = atGetAutoConfig();
    extract($autoconfig);
    
    //$ablock = atExportVar($ablock);
    
    if ($themedir) {
        $themeconfig = atLoadThemeConfig(AT_DIRPREFIX."themes/$themedir");
        extract($themeconfig);
    }
    else {
    	$themedir = "";
    }
    if ($autoblock) {
        if ($ablock && !in_array($ablock, $autoblock)) {
            $autoblock[] = $ablock;
        }
    }
    elseif ($ablock) {
        $autoblock[1] = $ablock;
    }
    $var = compact("autoblock");
    atSaveThemeConfig($themedir, $var);
    
    Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=ablocks&themedir=$themedir");
}

/* Delete an autoblock */
function AutoTheme_admin_delablock($var)
{
    $var = atExportVar($var);
    extract($var);
    
    if (!isset($confirmed)) {
        AutoTheme_admin_confirmdel($var);
        exit;
    }
    extract($confirmed);

    if ($del == _AT_YES) {
    	$autoconfig = atGetAutoConfig();
    	extract($autoconfig);
    	
    	if ($themedir) {
    		$themeconfig = atLoadThemeConfig(AT_DIRPREFIX."themes/$themedir");
    		extract($themeconfig);
    	}
    	else {
    		$themedir = "";
    	}
        unset($autoblock[$ablock]);
    
        $var = compact("autoblock");
        atSaveThemeConfig($themedir, $var);
    }
    Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=ablocks&themedir=$themedir");
}

/* Main autotheme selection form */
function AutoTheme_admin_athemes($var)
{
    $themelist = at_list_themes(AT_DIRPREFIX."themes");
    
    $var = atExportVar($var);
    extract($var);
    
    atAdminHeader(_AT_ACTIVEAUTOTHEMES);
    atAdminOpenTable();
    
    echo "<b>"._AT_THEME."</b></td><td><b>"._AT_MULTISITE."</b></td><td><b>"._AT_ACTION."</b></td></tr><tr><td>\n";

    if (is_array($themelist)) {
        foreach ($themelist as $key => $themedir) {
            $prevtheme = at_gettheme_name($themedir);

            if (($multisite = at_getmultisite_name($themedir)) === false) {
                $multisite = "&nbsp;";
            }
            echo "$prevtheme</td><td>$multisite</td><td>\n"
            .at_preview_url("", "", $themedir)
            //."[ <a href=\"../index.php?theme=$prevtheme\" target=\"_AT_blank\">"._AT_PREVIEW."</a> | \n"
            ."<a href=\"".AT_ADMINPAGE."?module=AutoTheme&op=atmain&themedir=".htmlentities(urlencode($themedir))."\">"._AT_CONFIGURE."</a> ]\n"
            ."</td></tr><tr><td>\n";
        }
    }
    else {
        echo _AT_NOACTIVEAUTOTHEMES;
    }
    atAdminCloseTable();
    echo "<br />\n";
    atAdminOpenTable();
    echo "<form method=\"POST\" action=\"".AT_ADMINPAGE."\">\n"
    ."<b>"._AT_CREATENEWTHEME."</b><br />\n"
    ."<input type=\"text\" name=\"themedir\" size=\"20\">\n"
    ."<input type=\"hidden\" name=\"op\" value=\"addatheme\">\n"
    ."<input type=\"hidden\" name=\"module\" value=\"AutoTheme\">\n"
    ."<input type=\"submit\" name=\"action\" value=\""._AT_BLANK."\">\n"
    ."<input type=\"submit\" name=\"action\" value=\""._AT_EXAMPLE."\">\n"
    ."</form>\n";
    atAdminCloseTable();
    atAdminFooter();
}

function AutoTheme_admin_addatheme($var)
{
    $var = atExportVar($var);
    extract($var);

    $old_mask = umask(0);

    if (file_exists(AT_DIRPREFIX."themes/$themedir")) {
        at_display_error("<b>"._AT_ERROR."</b>: themes/$themedir/ "._AT_DIREXISTS);
    }
    if (!is_writeable(AT_DIRPREFIX."themes/")) {
        at_display_error("<b>"._AT_ERROR."</b>: themes/ "._AT_NOTWRITABLE);
    }
    mkdir(AT_DIRPREFIX."themes/$themedir");
    mkdir(AT_DIRPREFIX."themes/$themedir/images");
    mkdir(AT_DIRPREFIX."themes/$themedir/style");
    
    if ($action == _AT_BLANK) {
        $fromdir = AT_DIRPREFIX."modules/AutoTheme/tools/themes/AT-Blank";
    }
    if ($action == _AT_EXAMPLE) {
        $fromdir = AT_DIRPREFIX."modules/AutoTheme/tools/themes/AT-Example";
    }
    if ($handle = @opendir("$fromdir/images/")) {
            while (false !== ($file = @readdir($handle))) {
                if (is_dir("$fromdir/$file")) {
                    continue;
                }
                copy("$fromdir/images/$file", AT_DIRPREFIX."themes/$themedir/images/$file");
            }
            closedir($handle);
    }
    if ($handle = @opendir("$fromdir/style/")) {
            while (false !== ($file = @readdir($handle))) {
                if (is_dir("$fromdir/$file")) {
                    continue;
                }
                copy("$fromdir/style/$file", AT_DIRPREFIX."themes/$themedir/style/$file");
            }
            closedir($handle);
    }
    if ($handle = @opendir("$fromdir/")) {
            while (false !== ($file = @readdir($handle))) {
                if (is_dir("$fromdir/$file")) {
                    continue;
                }
                copy("$fromdir/$file", AT_DIRPREFIX."themes/$themedir/$file");
            }
            closedir($handle);
    }
    Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=general&themedir=".htmlentities(urlencode($themedir)));
}

/* Main autotheme admin function */
function AutoTheme_admin_atmain($var)
{
    $var = atExportVar($var);
    extract($var);
    
    if (@file_exists(AT_DIRPREFIX."themes/$themedir/theme.cfg")) {
        include(AT_DIRPREFIX."themes/$themedir/theme.cfg");
    }
    elseif (@file_exists("$themedir/theme.cfg")) {
        include("$themedir/theme.cfg");
    }
    if (isset($import)) {
        if ($import == "skip") {
            $var = compact("themedir");
            atSaveThemeConfig($themedir, $var);
            return AutoTheme_admin_atmain($var);
        }
        else {
            $var = compact("themedir", "import");
            AutoTheme_admin_import($var);
            $var = compact("themedir");
            return AutoTheme_admin_atmain($var);
        }
    }
    atAdminThemeLinks($themedir, "", $var);
    $adminlinks = "".AT_ADMINPAGE."?module=AutoTheme";

    atAdminOpenTable();
    $pathparts = explode("/", $themedir);
    $thistheme = array_pop($pathparts);

    if (atRunningGetVar("thename") == $thistheme && !isset($edit)) {
        echo "<b>"._AT_NOTICE.":</b> "._AT_ACTIVETHEMEMSG."<br /><br />"
        ."[ <a href=\"".AT_ADMINPAGE."?module=AutoTheme&op=atmain&themedir=$themedir&edit=1\">"._AT_CONTINUE."</a> ]"
        ."  [ <a href=\"".AT_ADMINPAGE."?module=AutoTheme&op=athemes\"><b>"._AT_CANCEL."</b></a> ]";

        atAdminCloseTable();
        atAdminFooter();

        return;
    }
    if (is_array($block_display) || is_array($miscellaneous)) {
        echo "<b>"._AT_NOTICE.":</b> AT-Lite .6 - "._AT_OLDTHEMEMSG."<br /><br />"
        ."[ <a href=\"".AT_ADMINPAGE."?module=AutoTheme&op=atmain&themedir=$themedir&import=lite_6\">"._AT_IMPORT."</a> ]"
        ."  [ <a href=\"".AT_ADMINPAGE."?module=AutoTheme&op=atmain&themedir=$themedir&import=skip\">"._AT_SKIP."</a> ]"
        ."  [ <a href=\"".AT_ADMINPAGE."?module=AutoTheme&op=athemes\"><b>"._AT_CANCEL."</b></a> ]";

        atAdminCloseTable();
        atAdminFooter();

        return;
    }
    elseif (!isset($atversion)) {
        echo "<b>"._AT_NOTICE.":</b> AutoTheme 1.0 - "._AT_OLDTHEMEMSG."<br /><br />"
        ."[ <a href=\"".AT_ADMINPAGE."?module=AutoTheme&op=atmain&themedir=$themedir&import=1_0\">"._AT_IMPORT."</a> ]"
        ."  [ <a href=\"".AT_ADMINPAGE."?module=AutoTheme&op=atmain&themedir=$themedir&import=skip\">"._AT_SKIP."</a> ]"
        ."  [ <a href=\"".AT_ADMINPAGE."?module=AutoTheme&op=athemes\"><b>"._AT_CANCEL."</b></a> ]";

        atAdminCloseTable();
        atAdminFooter();

        return;
    }
    echo "<b><a href=\"$adminlinks&op=general&themedir=".htmlentities(urlencode($themedir))."\">"._AT_THEMEDEF."</a></b></td><td>"._AT_GENDESCR."</td></tr>\n"
    ."<tr><td><b><a href=\"$adminlinks&op=modmain&themedir=".htmlentities(urlencode($themedir))."\">"._AT_CUSTMODULES."</a></b></td><td>"._AT_MODDESCR."</td></tr>\n"
    ."<tr><td><b><a href=\"$adminlinks&op=ablocks&themedir=".htmlentities(urlencode($themedir))."\">"._AT_AUTOBLOCKS."</a></b></td><td>"._AT_THEMEABDESCR."</td></tr>\n"
    ."<tr><td><b><a href=\"$adminlinks&op=cmdedit&themedir=".htmlentities(urlencode($themedir))."\">"._AT_COMMANDS."</a></b></td><td>"._AT_THEMECMDDESCR;

    $autoconfig = atGetAutoConfig();
    extract($autoconfig);

    if (!$ext = atAutoGetVar("extra")) {
        echo $extradir;
    	list($ext, $cmd) = atExtraScan($extradir);
    }
    if (!$ext) {
        return;
    }
    foreach ($ext as $id => $info) {
        if ($info['themeadmin'] && function_exists($info['themeadmin']) && $autoextra[$id]) {
        	echo "<tr><td><b><a href=\"$adminlinks&op=extraops&extraname=".htmlentities(urlencode($id))."&themedir=".htmlentities(urlencode($themedir))."\">".$info['name']."</a></b></td><td>".$info['description']."</td></tr>\n";
        }
    }
    atAdminCloseTable();
    atAdminFooter();
    //atFixupThemeConfig($themedir);
}

/* Import an autotheme */
function AutoTheme_admin_import($var)
{
    $var = atExportVar($var);
    extract($var);
    
    if (@file_exists(AT_DIRPREFIX."themes/$themedir/theme.cfg")) {
        include(AT_DIRPREFIX."themes/$themedir/theme.cfg");
        @copy(AT_DIRPREFIX."themes/$themedir/theme.cfg", AT_DIRPREFIX."themes/$themedir/theme.cfg.bak");
    }
    elseif (@file_exists("$themedir/theme.cfg")) {
        include("$themedir/theme.cfg");
        @copy("$themedir/theme.cfg", "$themedir/theme.cfg.bak");
    }
    if ($import == "1_0") {
        $temp['default'] = $template['default'];
        $tempdisplay['default'] = $blockdisplay['default'];
        $tempstyle['default'] = $style['default'];
        
        foreach ($template as $thememod => $innerarray) {
            if ($thememod != "default" && !isset($template[$thememod]['default'])) {
                $temp[$thememod]['default'] = $template[$thememod];
                $tempdisplay[$thememod]['default'] = $blockdisplay[$thememod];
                $tempstyle[$thememod]['default'] = $style[$thememod];
            }
            elseif ($thememod != "default") {
                $temp[$thememod] = $template[$thememod];
                $tempdisplay[$thememod] = $blockdisplay[$thememod];
                $tempstyle[$thememod] = $style[$thememod];
            }
        }
        unset($template, $blockdisplay, $style);
        $template = $temp;
        $blockdisplay = $tempdisplay;
        $style = $tempstyle;

        $var = compact("template", "blockdisplay", "style", "blocktemplate");
        atSaveThemeConfig($themedir, $var);
        return;
    }
    foreach ($template as $name => $value) {
        $key = str_replace("area", "Area", $name);
        $temp[$key] = $value;
    }
    foreach ($block_display as $name => $value) {
        $key = str_replace("area", "Area", $name);
        $block[$key] = (string)(int)$value;
    }
    unset($template);

    $template['default'] = $temp;
    $template['default']['altsummary'] = (string)(int)$alternate_summary;
    $blockdisplay['default'] = $block;

    extract($miscellaneous);
    $color1 = $bgcolor1;
    $color2 = $bgcolor2;
    $color3 = $bgcolor3;
    $color4 = $bgcolor4;
    $color5 = $textcolor1;
    $color6 = $textcolor2;
    $logoimg = $logo;
    $striphead = (int)$strip_head;
    $style['default'] = compact("stylesheet", "logoimg", "color1", "color2", "color3", "color4", "color5", "color6", "striphead");

    for ($index = 0; $index <= 1; $index++) {
        if ($custom_module) {
            foreach ($custom_module as $thememod => $innerarray) {
				if (is_array($thememod)) {
					foreach ($thememod as $name => $value) {
                    	$key = str_replace("area", "Area", $name);

                    	if (eregi("block", $key)) {
                        	$temp[$key] = $value;
                    	}
                    	elseif (eregi("Area", $key)) {
                        	$block[$key] = (string)(int)$value;
                    	}
                	}
                }
                if ($index == 1) {
                    $thememod = "*HomePage";
                }
                $template[$thememod]['default'] = $temp;
                $blockdisplay[$thememod]['default'] = $block;

                $template[$thememod]['default'] = array_merge((array)$template['default'], (array)$template[$thememod]['default']);
                $blockdisplay[$thememod]['default'] = array_merge((array)$blockdisplay['default'], (array)$blockdisplay[$thememod]['default']);

                extract($custom_module);
                $color1 = $bgcolor1;
                $color2 = $bgcolor2;
                $color3 = $bgcolor3;
                $color4 = $bgcolor4;
                $color5 = $textcolor1;
                $color6 = $textcolor2;
                $logoimg = $logo;
                $style[$thememod]['default'] = compact("stylesheet", "logoimg", "color1", "color2", "color3", "color4", "color5", "color6", "striphead");
                $style[$thememod]['default'] = array_merge((array)$style['default'], (array)$style[$thememod]['default']);
            }
        }
    }
    $blocktemplate = $custom_block;

    $var = compact("template", "blockdisplay", "style", "blocktemplate");
    atSaveThemeConfig($themedir, $var);
}

/* General theme settings */
function AutoTheme_admin_general($var)
{
    $var = atExportVar($var);
    extract($var);
    
    atAdminThemeLinks($themedir, _AT_THEMEDEF, $var, 1);
    
    if (@file_exists(AT_DIRPREFIX."themes/$themedir/theme.cfg")) {
        include(AT_DIRPREFIX."themes/$themedir/theme.cfg");
    }
    elseif (@file_exists("$themedir/theme.cfg")) {
        include("$themedir/theme.cfg");
    }
    $config = array_merge((array)$template['default'], (array)$blockdisplay['default'], (array)$style['default']);
    $temps = $template['default'];
    $formvars = compact("temps", "config");
    
    AutoTheme_admin_generalform($var, $formvars);
    atAdminFooter();
}

/* Update general theme settings */
function AutoTheme_admin_updategeneral($var)
{
    $var = atExportVar($var);
    extract($var);

    if (@file_exists(AT_DIRPREFIX."themes/$themedir/theme.cfg")) {
        include(AT_DIRPREFIX."themes/$themedir/theme.cfg");
    }
    elseif (@file_exists("$themedir/theme.cfg")) {
        include("$themedir/theme.cfg");
    }
    $template['default'] = compact("dtd", "main", "summary", "summary1", "summary2",
    "article", "altsummary", "leftblock", "centerblock", "rightblock", "table1", "table2");
    $blockdisplay['default'] = compact("left", "center", "right");
    $style['default'] = compact("stylesheet", "logoimg", "color1", "color2", "color3",
    "color4", "color5", "color6", "color7", "color8", "color9", "color10", "striphead", "head");

    if ($autoblock) {
        foreach ($autoblock as $key => $ablock) {
            $template['default']["autoblock".$key] = ${"autoblock".$key};
            $blockdisplay['default']["autoblock".$key] = $ablockdis[$key];
        }
    }
    $var = compact("altsummary", "template", "blockdisplay", "style");
    atSaveThemeConfig($themedir, $var);

    Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=atmain&themedir=".htmlentities(urlencode($themedir)));
}

/* Main module selection form */
function AutoTheme_admin_modmain($var)
{
    $var = atExportVar($var);
    extract($var);
    
    $modlist = atModList();
    natcasesort($modlist);

    atAdminThemeLinks($themedir, _AT_CUSTMODULES, $var);
    if (@file_exists(AT_DIRPREFIX."themes/$themedir/theme.cfg")) {
        include(AT_DIRPREFIX."themes/$themedir/theme.cfg");
    }
    elseif (@file_exists("$themedir/theme.cfg")) {
            include("$themedir/theme.cfg");
    }
    atAdminOpenTable();
    echo "<b>"._AT_MODULE."</b></td><td><b>"._AT_OPTIONS."<b></td><td><b>"._AT_ACTION."</b></td></tr><tr><td>\n";
    
    if (!$template['default']) {
        echo _AT_CONFGENERALFIRST;
        exit;
    }
    $c = 0;
    ksort($template);
    foreach ($template as $thememod => $innerarray) {
       $pathparts = explode("/", $themedir);
       $prevtheme = array_pop($pathparts);

       if ($thememod != "default" && !empty($innerarray)) {
           foreach ($innerarray as $modops => $opsarray) {
                echo "$thememod</td><td>$modops</td><td>\n";
                
                echo at_preview_url($thememod, $modops, $prevtheme);
                
                echo "<a href=\"".AT_ADMINPAGE."?module=AutoTheme&op=modgeneral&themedir=".htmlentities(urlencode($themedir))."&thememod=".htmlentities(urlencode($thememod))."&modops=".htmlentities(urlencode($modops))."\">"._AT_CONFIGURE."</a> | \n"
                ."<a href=\"".AT_ADMINPAGE."?module=AutoTheme&op=delmod&themedir=".htmlentities(urlencode($themedir))."&thememod=".htmlentities(urlencode($thememod))."&modops=".htmlentities(urlencode($modops))."\">"._AT_REMOVE."</a> ]\n"
                ."</td></tr><tr><td>\n";
           }
           $c++;
       }       
    }
    if (!$c) {
    	echo _AT_NOCUSTMODULES;
    }
    echo "&nbsp;</td><td>&nbsp</td><td>&nbsp;";
    atAdminCloseTable();
    echo "<br />\n";
    atAdminOpenTable();
    echo "<form method=\"POST\" action=\"".AT_ADMINPAGE."\">\n"
    ."<b>"._AT_ADDMODULE."</b><br />\n"
    ."<select name=\"thememod\">\n";
    foreach ($modlist as $mod) {
        echo "  <option>$mod</option>\n";
    }
    echo "</select><br />\n"
    ."<b>"._AT_MODULEOPS."</b><br />\n"
    ."<input type=\"text\" name=\"modops\" size=\"20\">\n"
    ."<input type=\"hidden\" name=\"themedir\" value=\"$themedir\">\n"
    ."<input type=\"hidden\" name=\"op\" value=\"addmod\">\n"
    ."<input type=\"hidden\" name=\"module\" value=\"AutoTheme\">\n"
    ."<input type=\"submit\" value=\""._AT_ADD."\" name=\"B1\">\n"
    ."</form>\n";
    atAdminCloseTable();
    atAdminFooter();
}

/* Add a module */
function AutoTheme_admin_addmod($var)
{
   $var = atExportVar($var);
    extract($var);

   if (@file_exists(AT_DIRPREFIX."themes/$themedir/theme.cfg")) {
        include(AT_DIRPREFIX."themes/$themedir/theme.cfg");
    }
    elseif (@file_exists("$themedir/theme.cfg")) {
            include("$themedir/theme.cfg");
    }
    if (!$modops) {
        $modops = "default";
    }
    if (!$blocktemplate['default']) {
    	$temp = $blocktemplate;
    	unset($blocktemplate);
    	$blocktemplate['default'] = $temp;
    	if (!$modops != "default") {
    		$blocktemplate[$thememod][$modops] = $temp;
    	}
    	$var = compact("blocktemplate");
    	atSaveThemeConfig($themedir, $var);
    }    	
    if (!$template[$thememod]['default']) {
        $tmptemplate = $template[$thememod];
        $tmpblockdisplay = $blockdisplay[$thememod];
        $tmpstyle = $style[$thememod];
        $tmpblocktemplate = $blocktemplate[$thememod];
        $template[$thememod] = $blockdisplay[$thememod] = $style[$thememod] = array();
        $template[$thememod]['default'] = $tmptemplate;
        $blockdisplay[$thememod]['default'] = $tmpblockdisplay;
        $style[$thememod]['default'] = $tmpstyle;
        $blocktemplate[$thememod]['default'] = $tmpblocktemplate;
    }
    if ($thememod && !$template[$thememod][$modops]) {
        $template[$thememod][$modops] = $template['default'];
        $blockdisplay[$thememod][$modops] = $blockdisplay['default'];
        $style[$thememod][$modops] = $style['default'];
        $blocktemplate[$thememod][$modops] = $blocktemplate['default'];
    }
    $var = compact("template", "blockdisplay", "style", "blocktemplate");
    atSaveThemeConfig($themedir, $var);
   
   Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=modgeneral&themedir=".htmlentities(urlencode($themedir))."&thememod=".htmlentities(urlencode($thememod))."&modops=".htmlentities(urlencode($modops)));
}

/* Delete a module */
function AutoTheme_admin_delmod($var)
{
    $var = atExportVar($var);
    extract($var);
    
    if (!isset($confirmed)) {
        AutoTheme_admin_confirmdel($var);
        exit;
    }
    extract($confirmed);

    if ($del == _AT_YES) {
        if (@file_exists(AT_DIRPREFIX."themes/$themedir/theme.cfg")) {
            include(AT_DIRPREFIX."themes/$themedir/theme.cfg");
        }
        elseif (@file_exists("$themedir/theme.cfg")) {
            include("$themedir/theme.cfg");
        }        
        if ($modops == "default" && !isset($template[$thememod][$modops])) {
            unset($template[$thememod], $blockdisplay[$thememod], $style[$thememod], $blocktemplate[$thememod]);            
        }
        else {
            unset($template[$thememod][$modops], $blockdisplay[$thememod][$modops], $style[$thememod][$modops], $blocktemplate[$thememod][$modops]);
        }
        $var = compact("template", "blockdisplay", "style", "blocktemplate");
        
        $autoconfig = atGetAutoConfig();
        $ext = atExtraScan($autoconfig['extradir']);
        
        foreach ($ext as $k => $v) {
            if (isset($ext[$k]['modadmin'])) {
                if (isset(${$k}[$thememod][$modops])) {
                    unset(${$k}[$thememod][$modops]);
                    if (empty(${$k}[$thememod])) {
                        unset(${$k}[$thememod]);
                    }
                    $var[$k] = ${$k};
                }
            }
            
        }        
        atSaveThemeConfig($themedir, $var);
    }
    Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=modmain&themedir=".htmlentities(urlencode($themedir)));
}

/* Module settings */
function AutoTheme_admin_modgeneral($var)
{
    $var = atExportVar($var);
    extract($var);
    
    atAdminThemeLinks($themedir, "", $var, 1);
    
	if (@file_exists(AT_DIRPREFIX."themes/$themedir/theme.cfg")) {
        include(AT_DIRPREFIX."themes/$themedir/theme.cfg");
    }
    elseif (@file_exists("$themedir/theme.cfg")) {
            include("$themedir/theme.cfg");
    }
    if (isset($template[$thememod][$modops])) {
        $template = $template[$thememod][$modops];
    }
    elseif ($template[$thememod]) {
        $template = $template[$thememod];
    }
    if (isset($style[$thememod][$modops])) {
        $style = $style[$thememod][$modops];
    }
    elseif ($style[$thememod]) {
        $style = $style[$thememod];
    }
    if (isset($blockdisplay[$thememod][$modops])) {
        $blockdisplay = $blockdisplay[$thememod][$modops];
    }
    elseif ($blockdisplay[$thememod]) {
        $blockdisplay = $blockdisplay[$thememod];
    }
    $config = array_merge((array)$template, (array)$blockdisplay, (array)$style);
    $temps = $template;
    $formvars = compact("temps", "config");

    AutoTheme_admin_generalform($var, $formvars);
    atAdminFooter();
}

/* Update module settings */
function AutoTheme_admin_updatemod($var)
{
    $var = atExportVar($var);
    extract($var);

    if (file_exists(AT_DIRPREFIX."themes/$themedir/theme.cfg")) {
        include(AT_DIRPREFIX."themes/$themedir/theme.cfg");
    }
    elseif (file_exists("$themedir/theme.cfg")) {
            include("$themedir/theme.cfg");
    }
    if (!$template[$thememod]['default']) {
        $tmptemplate = $template[$thememod];
        $tmpblockdisplay = $blockdisplay[$thememod];
        $tmpstyle = $style[$thememod];
        $template[$thememod] = $blockdisplay[$thememod] = $style[$thememod] = array();
        $template[$thememod]['default'] = $tmptemplate;
        $blockdisplay[$thememod]['default'] = $tmpblockdisplay;
        $style[$thememod]['default'] = $tmpstyle;
    }
    $template[$thememod][$modops] = compact("dtd", "main", "leftblock", "centerblock", "rightblock",
    "summary", "summary1", "summary2", "article", "altsummary", "table1", "table2");
    $blockdisplay[$thememod][$modops] = compact("left", "center", "right");
    $style[$thememod][$modops] = compact("stylesheet", "logoimg", "color1", "color2", "color3",
    "color4", "color5", "color6", "color7", "color8", "color9", "color10", "striphead", "head");

    if ($autoblock) {
        foreach ($autoblock as $key => $ablock) {
            $template[$thememod][$modops]["autoblock".$key] = ${"autoblock".$key};
            $blockdisplay[$thememod][$modops]["autoblock".$key] = $ablockdis[$key];
        }
    }
    $var = compact("template", "blockdisplay", "style");
    atSaveThemeConfig($themedir, $var);
    
    Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=modmain&themedir=".htmlentities(urlencode($themedir))."&thememod=$thememod");
}

/* Main block and settings form */
function AutoTheme_admin_blockmain($var)
{
    $blocklist = atBlockList();

    $var = atExportVar($var);
    extract($var);
    
    if (file_exists(AT_DIRPREFIX."themes/$themedir/theme.cfg")) {
        $filelist = at_listfiles(AT_DIRPREFIX."themes/$themedir", "htm");
        include(AT_DIRPREFIX."themes/$themedir/theme.cfg");
    }
    elseif (file_exists("$themedir/theme.cfg")) {
        $filelist = at_listfiles($themedir, "htm");
        include("$themedir/theme.cfg");
    }    	
    if ($modops) {
    	$where = "$thememod  >  $modops";
    }
    else {
    	$thememod = "default";
    	$where = _AT_THEMEDEF;
    }
    if (!is_array($blocktemplate['default'])) {
    	$temp = $blocktemplate;
    	unset($blocktemplate);
    	$blocktemplate['default'] = $temp;
    	if ($modops) {
    		$blocktemplate[$thememod][$modops] = $temp;
    	}
    	else {
    		$blocktemplate[$thememod]= $temp;
    	}    		
    	$var = compact("blocktemplate");
    	atSaveThemeConfig($themedir, $var);
    }    	
    atAdminThemeLinks($themedir, _AT_CUSTBLOCKS, $var, 1);
    
    atAdminOpenTable();
    echo "<form method=\"POST\" action=\"".AT_ADMINPAGE."\">\n"
    ."  <input type=\"hidden\" name=\"op\" value=\"updateblock\">\n"
    ."  <input type=\"hidden\" name=\"module\" value=\"AutoTheme\">\n"
    ."  <input type=\"hidden\" name=\"themedir\" value=\"$themedir\">\n"
    ."  <input type=\"hidden\" name=\"thememod\" value=\"$thememod\">\n"
    ."  <input type=\"hidden\" name=\"modops\" value=\"$modops\">\n"
    ."<b>"._AT_BLOCK."</b></td><td><b>"._AT_FILENAME."</b></td><td><b>"._AT_ACTION."</b></td></tr><tr><td>\n";

    if ($modops) {
    	$blocktemplate = $blocktemplate[$thememod][$modops];
    }
    else {
    	$blocktemplate = $blocktemplate[$thememod];
    }    
    if ($blocktemplate){
        ksort($blocktemplate);
        
        foreach ($blocktemplate as $themeblock => $filename){
            $blockvar = strtolower(preg_replace("^\W|_^", "", $themeblock));
            $varval = htmlentities(urlencode($themeblock));
            echo $themeblock."</td>\n"
            .at_file_select($themedir, $blockvar."file", $filename, $filelist)."<td>\n"
            ."[ <a href=\"".AT_ADMINPAGE."?module=AutoTheme&op=delblock&themedir=".htmlentities(urlencode($themedir))."&themeblock=$varval&thememod=".htmlentities(urlencode($thememod))."&modops=".htmlentities(urlencode($modops))."\">"._AT_REMOVE."</a> ]\n"
            ."</td></tr><tr><td>\n";
        }
        echo "<input type=\"submit\" value=\""._AT_SAVE."\" name=\"B1\">\n"
        ."</form></td><td>\n";
    }
    else {
        echo _AT_NOCUSTBLOCKS;
    }
    echo "&nbsp;</td><td>&nbsp;";
    atAdminCloseTable();
    echo "<br />\n";
    atAdminOpenTable();
    echo "<form method=\"POST\" action=\"".AT_ADMINPAGE."\">\n"
    ."<b>"._AT_ADDBLOCK."</b><br />\n"
    ."<select name=\"themeblock\">\n";
    foreach ($blocklist as $block) {
        if (!array_key_exists($block, $blocktemplate)) {
            echo "<option>$block</option>";
        }
    }
    echo "</select>"
    ."<input type=\"hidden\" name=\"themedir\" value=\"$themedir\">\n"
    ."<input type=\"hidden\" name=\"thememod\" value=\"$thememod\">\n"
    ."<input type=\"hidden\" name=\"modops\" value=\"$modops\">\n"
    ."<input type=\"hidden\" name=\"op\" value=\"addblock\">\n"
    ."<input type=\"hidden\" name=\"module\" value=\"AutoTheme\">\n"
    ."<input type=\"submit\" value=\""._AT_ADD."\" name=\"B1\">\n"
    ."</form>\n";
    atAdminCloseTable();
    atAdminFooter();
}

/* Add a block */
function AutoTheme_admin_addblock($var)
{
    $var = atExportVar($var);
    extract($var);
    
    if (file_exists(AT_DIRPREFIX."themes/$themedir/theme.cfg")) {
        include(AT_DIRPREFIX."themes/$themedir/theme.cfg");
    }
    elseif (file_exists("$themedir/theme.cfg")) {
            include("$themedir/theme.cfg");
    }    
    if ($modops) {
    	if (!$blocktemplate[$thememod][$modops][$themeblock]) {
    		$blocktemplate[$thememod][$modops][$themeblock] = "";
    	}
    	else {
    		Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=blockmain&themedir=".htmlentities(urlencode($themedir))."&thememod=$thememod&modops=$modops");
        	exit;
    	}    		
    }
    else {
    	if (!$blocktemplate[$thememod][$themeblock]) {
    		$blocktemplate[$thememod][$themeblock] = "";
    	}
    	else {
        	Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=blockmain&themedir=".htmlentities(urlencode($themedir))."&thememod=$thememod");
        	exit;
    	}
    }
    $var = compact("blocktemplate");
    atSaveThemeConfig($themedir, $var);
    
    Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=blockmain&themedir=".htmlentities(urlencode($themedir))."&thememod=$thememod&modops=$modops");
}

/* Delete a block */
function AutoTheme_admin_delblock($var)
{
    $var = atExportVar($var);
    extract($var);
    
    if (!isset($confirmed)) {
        AutoTheme_admin_confirmdel($var);
        exit;
    }
    extract($confirmed);

    if ($del == _AT_YES) {
        if (file_exists(AT_DIRPREFIX."themes/$themedir/theme.cfg")) {
            include(AT_DIRPREFIX."themes/$themedir/theme.cfg");
        }
        elseif (file_exists("$themedir/theme.cfg")) {
            include("$themedir/theme.cfg");
        }
        if ($modops) {
    		$themeblock = stripslashes(stripslashes($themeblock));
    		unset($blocktemplate[$thememod][$modops][$themeblock]);
    	}
    	else {
    		$themeblock = stripslashes(stripslashes($themeblock));
  	        unset($blocktemplate[$thememod][$themeblock]);
    	}    	
        $var = compact("blocktemplate");
        atSaveThemeConfig($themedir, $var);
    }
    Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=blockmain&themedir=".htmlentities(urlencode($themedir))."&thememod=$thememod&modops=$modops");
}

/* Update block settings */
function AutoTheme_admin_updateblock($var)
{
    $var = atExportVar($var);
    extract($var);
    
    if (file_exists(AT_DIRPREFIX."themes/$themedir/theme.cfg")) {
        include(AT_DIRPREFIX."themes/$themedir/theme.cfg");
    }
    elseif (file_exists("$themedir/theme.cfg")) {
            include("$themedir/theme.cfg");
    }
    if ($modops) {
    	$theblocks = $blocktemplate[$thememod][$modops];
    	unset($blocktemplate[$thememod][$modops]);
    }
    else {
    	$theblocks = $blocktemplate[$thememod];
    	unset($blocktemplate[$thememod]);
    }
    foreach ($theblocks as $themeblock => $filename){
        $blockvar = strtolower(preg_replace("^\W|_^", "", $themeblock));
        if ($modops) {
        	$blocktemplate[$thememod][$modops][$themeblock] = ${$blockvar."file"};
        }
        else {
        	$blocktemplate[$thememod][$themeblock] = ${$blockvar."file"};
        }        	
    }
    $var = compact("blocktemplate");
    atSaveThemeConfig($themedir, $var);
    
    Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=blockmain&themedir=".htmlentities(urlencode($themedir))."&thememod=$thememod&modops=$modops");
}

/* Main command editor */
function AutoTheme_admin_cmdedit($var)
{
    $var = atExportVar($var);
    extract($var);
	
    atLoadCommands();
    $autoconfig = atGetAutoConfig();
    extract($autoconfig);

    if ($themedir) {
        atAdminThemeLinks($themedir, _AT_COMMANDS, $var);
        $themeconfig = atLoadThemeConfig(AT_DIRPREFIX."themes/$themedir");
        extract($themeconfig);
        if (is_array($themecmd)) {
            $autocmd = $themecmd;
        }
    }
    else {
    	atAdminHeader(_AT_COMMANDS);
    	$themedir = "";
    }
    atAdminOpenTable();
    echo "<b>"._AT_CONFCOMMANDS."</b></td><td><b>"._AT_APPLIESTO."</b></td><td><b>"._AT_ACTION."</b></td></tr><tr><td>\n";
    
	if (!is_array($autocmd['all']) && !is_array($autocmd['anonymous']) && !is_array($autocmd['admin']) && !is_array($autocmd['loggedin'])) {
		$newacmd['all'] = $autocmd;
		$autocmd = $newacmd;
	}
    ksort($autocmd);
	$display = 0;
    foreach ($autocmd as $type => $c_array) {
        foreach ($c_array as $cmd => $action) {
            $display = 1;
            $lang_type = constant("_AT_".strtoupper($type));
            echo "$cmd</td><td>$lang_type</td><td>\n"
           	."[ <a href=\"".AT_ADMINPAGE."?module=AutoTheme&op=editcmd&cmd=".htmlentities(urlencode($cmd))."&type=".htmlentities(urlencode($type))."&themedir=".htmlentities(urlencode($themedir))."\">"._AT_CONFIGURE."</a> | \n"
           	."<a href=\"".AT_ADMINPAGE."?module=AutoTheme&op=delcmd&cmd=".htmlentities(urlencode($cmd))."&type=".htmlentities(urlencode($type))."&themedir=".htmlentities(urlencode($themedir))."\">"._AT_REMOVE."</a> ]\n"
           	."</td></tr><tr><td>\n";
       	}
    }
    if (!$display) {
        echo _AT_NOUSERCONFCOMMANDS;
    }
    atAdminCloseTable();
    echo "<br />\n";
    
    $appliesto = "<select name=\"type\">\n"
    ."<option value=\"admin\">"._AT_ADMIN."</option>\n"
    ."<option value=\"all\" selected>"._AT_ALL."</option>\n"
    ."<option value=\"anonymous\">"._AT_ANONYMOUS."</option>\n"
    ."<option value=\"loggedin\">"._AT_LOGGEDIN."</option>\n"
    ."</select>\n";
    
    atAdminOpenTable();
    echo "<form method=\"POST\" action=\"".AT_ADMINPAGE."\">\n"
    ."<b>"._AT_ADDCOMMAND."</b><br />\n"
    ."<input type=\"text\" name=\"cmd\" size=\"20\"><br />\n"
    ."<b>"._AT_APPLIESTO."</b><br />"
    .$appliesto."<br />"
    ."<b>"._AT_ACTION."</b><br />\n"
    ."<textarea rows=\"5\" style=\"width: 100%\" name=\"action\"></textarea>\n"
    ."<input type=\"hidden\" name=\"op\" value=\"addcmd\">\n"
    ."<input type=\"hidden\" name=\"module\" value=\"AutoTheme\">\n"
    ."<input type=\"hidden\" name=\"themedir\" value=\"$themedir\">\n"
    ."<input type=\"submit\" value=\""._AT_ADD."\" name=\"B1\">\n"
    ."</form>\n";
    atAdminCloseTable();
    atAdminFooter();
}

/* Edit a command */
function AutoTheme_admin_editcmd($var)
{
    $var = atExportVar($var);
    extract($var);
    
    atLoadCommands();
    $autoconfig = atGetAutoConfig();
    extract($autoconfig);
    
    if ($themedir) {
        atAdminThemeLinks($themedir, _AT_COMMANDS, $var, 1);
        $themeconfig = atLoadThemeConfig(AT_DIRPREFIX."themes/$themedir");
        extract($themeconfig);
        $autocmd = $themecmd;        
    }
    else {
    	atAdminHeader(_AT_COMMANDS);
    	$themedir = "";
    }
    
	foreach ($autocmd as $key => $val) {
    	if (!is_array($val)) {
    		$newacmd['all'] = $autocmd;
    		$autocmd = $newacmd;
    		break;
    	}
    }
    $thiscmd = atDisplayVar($autocmd[$type][$cmd]);

    $t_var = $type."_sel";
    $$t_var =  " selected";
    
    $appliesto = "<select name=\"type\">\n"
    ."<option value=\"admin\"$admin_sel>"._AT_ADMIN."</option>\n"
    ."<option value=\"all\"$all_sel>"._AT_ALL."</option>\n"
    ."<option value=\"anonymous\"$anonymous_sel>"._AT_ANONYMOUS."</option>\n"
    ."<option value=\"loggedin\"$loggedin_sel>"._AT_LOGGEDIN."</option>\n"
    ."</select>\n";

    atAdminOpenTable();
    echo "<form method=\"POST\" action=\"".AT_ADMINPAGE."\">\n"
    ."<b>"._AT_APPLIESTO."</b>: $appliesto<br /><br /><b>"._AT_COMMAND."</b>: $cmd<br /><br />\n"
    ."<b>"._AT_ACTION."</b><br />\n"
    ."<textarea wrap=\"virtual\" rows=\"10\" style=\"width: 100%\" name=\"action\">\n"
    .$thiscmd
    ."</textarea>\n"
    ."<input type=\"hidden\" name=\"cmd\" value=\"$cmd\">\n"
    ."<input type=\"hidden\" name=\"oldtype\" value=\"$type\">\n"
    ."<input type=\"hidden\" name=\"op\" value=\"updatecmd\">\n"
    ."<input type=\"hidden\" name=\"themedir\" value=\"$themedir\">\n"
    ."<input type=\"hidden\" name=\"module\" value=\"AutoTheme\">\n"
    ."<input type=\"submit\" value=\""._AT_SAVE."\" name=\"B1\">\n"
    ."</form>";
    atAdminCloseTable();
    atAdminFooter();
}

/* View a command */
function AutoTheme_admin_viewcmd($var)
{
    $var = atExportVar($var);
    extract($var);
    
    atAdminHeader(_AT_NONCONFCOMMANDS);
    
    $command = atLoadCommands();
    
    atAdminOpenTable();
    $lang_type = constant("_AT_".strtoupper($type));
    echo "<b>"._AT_APPLIESTO."</b>: $lang_type<br /><br /><b>"._AT_COMMAND."</b>: $cmd<br /><br />\n"
    ."<b>"._AT_ACTION."</b><br />\n"
    ."<textarea wrap=\"virtual\" rows=\"10\" style=\"width: 100%\" name=\"action\" readonly>\n"
    .htmlentities($command[$type][$cmd])
    ."</textarea><br />\n"
    ."[ <a href=\"".AT_ADMINPAGE."?module=AutoTheme&op=cmdedit\">"._AT_BACKTOCMDS."</a> ]";
    atAdminCloseTable();
    atAdminFooter();
}

/* Add command */
function AutoTheme_admin_addcmd($var)
{
    $var = atExportVar($var);
    extract($var);
    
    atLoadCommands();
    $autoconfig = atGetAutoConfig();
    extract($autoconfig);
        	
    if ($themedir) {
        $themeconfig = atLoadThemeConfig(AT_DIRPREFIX."themes/$themedir");
        extract($themeconfig);
        $autocmd = $themecmd;
    }
    else {
        $themedir = "";
    }
    foreach ($autocmd as $key => $val) {
    	if (!is_array($val)) {
    		$newacmd['all'] = $autocmd;
    		$autocmd = $newacmd;
    		break;
    	}
    }
    $type = strtolower($type);
    
    if ($cmd && !$autocmd[$type][$cmd] && !$command[$type][$cmd]) {
        //$autocmd[$type][$cmd] = atExportVar($action);
        $autocmd[$type][$cmd] = $action;
    }
    else {
        Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=cmdedit&themedir=$themedir");
    }
    if ($themedir) {
    	$themecmd = $autocmd;
    	$var = compact("themecmd");
    	atSaveThemeConfig($themedir, $var);
    }
    else {
    	$var = compact("autocmd");
    	atSaveAutoConfig($var);
    }
    Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=cmdedit&themedir=$themedir");
}

/* Delete command */
function AutoTheme_admin_delcmd($var)
{
    $var = atExportVar($var);
    extract($var);

    if (!$confirmed) {
        AutoTheme_admin_confirmdel($var);
        exit;
    }
    extract($confirmed);

    if ($del == _AT_YES) {
    	
    	atLoadCommands();
    	$autoconfig = atGetAutoConfig();
    	extract($autoconfig);
    	
    	if ($themedir) {
    		$themeconfig = atLoadThemeConfig(AT_DIRPREFIX."themes/$themedir");
    		extract($themeconfig);
    		$autocmd = $themecmd;
    	}
    	else {
    		$themedir = "";
    	}
    	
        foreach ($autocmd as $key => $val) {
	    	if (!is_array($val)) {
    			$newacmd['all'] = $autocmd;
    			$autocmd = $newacmd;
    			break;
    		}
    	}
        unset($autocmd[$type][$cmd]);

        if ($themedir) {
        	$themecmd = $autocmd;
        	$var = compact("themecmd");
        	atSaveThemeConfig($themedir, $var);
        }
        else {
        	$var = compact("autocmd");
        	atSaveAutoConfig($var);
        }
    }
    Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=cmdedit&themedir=$themedir");
}

/* Update a command */
function AutoTheme_admin_updatecmd($var)
{
    $var = atExportVar($var);
    extract($var);

    atLoadCommands();
    $autoconfig = atGetAutoConfig();
    extract($autoconfig);
        	
    if ($themedir) {
        $themeconfig = atLoadThemeConfig(AT_DIRPREFIX."themes/$themedir");
        extract($themeconfig);
        $autocmd = $themecmd;
    }
    else {
        $themedir = "";
    }
    
    foreach ($autocmd as $key => $val) {
    	if (!is_array($val)) {
   			$newacmd['all'] = $autocmd;
   			$autocmd = $newacmd;
   			break;
   		}
   	}
   	unset($autocmd[$oldtype][$cmd]);
    //$autocmd[$type][$cmd] = atExportVar($action);
    $autocmd[$type][$cmd] = $action;

    if ($themedir) {
    	$themecmd = $autocmd;
    	$var = compact("themecmd");
    	atSaveThemeConfig($themedir, $var);
    }
    else {
    	$var = compact("autocmd");
    	atSaveAutoConfig($var);
    }

    Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=cmdedit&themedir=$themedir");
}

/* Admin links for sub pages */
function atAdminThemeLinks($themedir, $title="", $var, $submenu=0)
{
	$var = atExportVar($var);
    extract($var);
    
	atAdminHeader();
	
	if ($thememod && $thememod != "default") {
		if (!$modops) {
			$modops = "default";
		}
		if ($title) {
			$title = "$themedir > $thememod > $modops > $title";
		}
		else {
			$title = "$themedir > $thememod > $modops";
		}			
		$submenu = 1;
	}
	else {
		if ($title) {
			$title = "$themedir > $title";
		}
		else {
			$title = $themedir;
		}
		$modops = "";
	}
    
    $adminlinks = "".AT_ADMINPAGE."?module=AutoTheme";
    echo "<div align=\"center\"><b>$title</b></div><br />\n";
    atAdminOpenTable();
    echo "<div align=\"center\">\n"
    ."[ <a href=\"$adminlinks&op=general&themedir=".htmlentities(urlencode($themedir))."\">"._AT_THEMEDEF."</a> | "
    ."<a href=\"$adminlinks&op=modmain&themedir=".htmlentities(urlencode($themedir))."\">"._AT_CUSTMODULES."</a> | "
    ."<a href=\"$adminlinks&op=ablocks&themedir=".htmlentities(urlencode($themedir))."\">"._AT_AUTOBLOCKS."</a> | "
    ."<a href=\"$adminlinks&op=cmdedit&themedir=".htmlentities(urlencode($themedir))."\">"._AT_COMMANDS."</a> ]<br />";

    $autoconfig = atGetAutoConfig();
    extract($autoconfig);
    
    if (!$ext = atAutoGetVar("extra")) {
        $ext = atExtraScan($extradir);
    }
    if (!$ext) {
        return;
    }
    ksort($ext);
    foreach ($ext as $id => $info) {
        if ($info['themeadmin'] && function_exists($info['themeadmin']) && $autoextra[$id]) {
        	echo "[ <a href=\"".AT_ADMINPAGE."?module=AutoTheme&op=extraops&extraname=".htmlentities(urlencode($id))."&themedir=".htmlentities(urlencode($themedir))."\">".$info['name']."</a> ]";
        }
    }
    echo "</div>\n";
    atAdminCloseTable();
    echo "<br />";
    
    if ($submenu) {
    	if (!$thememod) {
    		$thememod = "default";
    	}
	    atAdminOpenTable();
	    echo "<div align=\"center\">\n"    
	    ."[ <a href=\"$adminlinks&op=blockmain&themedir=".htmlentities(urlencode($themedir))."&thememod=".htmlentities(urlencode($thememod))."&modops=".htmlentities(urlencode($modops))."\">"._AT_CUSTBLOCKS."</a> | "
	    ."<a href=\"$adminlinks&op=cmsblocks&themedir=".htmlentities(urlencode($themedir))."&thememod=".htmlentities(urlencode($thememod))."&modops=".htmlentities(urlencode($modops))."\">"._AT_BLOCKCONTROL."</a> ]<br />";
	    
	    foreach ($ext as $id => $info) {
	        if ($info['modadmin'] && function_exists($info['modadmin']) && $autoextra[$id]) {
	        	echo "[ <a href=\"$adminlinks&op=extraops&extraname=".htmlentities(urlencode($id))."&themedir=".htmlentities(urlencode($themedir))."&thememod=".htmlentities(urlencode($thememod))."&modops=".htmlentities(urlencode($modops))."\">".$info['name']."</a> ]";
	        }
	    }
	    echo "</div>";
	    atAdminCloseTable();
	    echo "<br />";
    }
}

/* Confirm delete of something */
function AutoTheme_admin_confirmdel($var)
{
    $var = atExportVar($var);
    extract($var);
    
    atAdminHeader(_AT_CONFIRMDEL);
    atAdminOpenTable();
    
    echo "<b>"._AT_AREYOUSUREDEL."</b><br />\n"
    ."<form method=\"POST\" action=\"".AT_ADMINPAGE."\">\n"
    ."<input type=\"hidden\" name=\"op\" value=\"$op\">\n";
    foreach ($var as $thevar => $theval) {
        echo "<input type=\"hidden\" name=\"confirmed[$thevar]\" value=\"$theval\">\n";
    }
    echo "<input type=\"hidden\" name=\"module\" value=\"AutoTheme\">\n"
    ."<input type=\"submit\" value=\""._AT_YES."\" name=\"del\">\n"
    ."<input type=\"submit\" value=\""._AT_NO."\" name=\"del\">\n"
    ."</form>\n";

    atAdminCloseTable();
    atAdminFooter();
}

function AutoTheme_admin_generalform($var, $formvars)
{
	$autoconfig = atGetAutoConfig();
    extract($autoconfig);
	
	$var = atExportVar($var);
    extract($var);
	
	if (@file_exists(AT_DIRPREFIX."themes/$themedir/theme.cfg")) {
		include(AT_DIRPREFIX."themes/$themedir/theme.cfg");
		$filelist = at_listfiles(AT_DIRPREFIX."themes/$themedir", "htm");
		$csslist = at_listfiles(AT_DIRPREFIX."themes/$themedir", "css");
		$imglist = array_merge(
		(array)at_listfiles(AT_DIRPREFIX."themes/$themedir", "gif"),
		(array)at_listfiles(AT_DIRPREFIX."themes/$themedir", "jpg"),
		(array)at_listfiles(AT_DIRPREFIX."themes/$themedir", "png")
		);
	}
	elseif (@file_exists("$themedir/theme.cfg")) {
		include("$themedir/theme.cfg");
		$filelist = at_listfiles($themedir, "htm");
		$csslist = at_listfiles($themedir, "css");
		$imglist = array_merge(
		(array)at_listfiles($themedir, "gif"),
		(array)at_listfiles($themedir, "jpg"),
		(array)at_listfiles($themedir, "png")
		);
	}
	$templist = at_listfiles($atdir."templates/$platform", "htm");
	extract($formvars);
	extract($config);
	
	$ysh = $nsh = $yalt = $nalt = $yleft = $nleft = $ycenter = $ncenter = $yright = $nright = "";
	
	if ($striphead){ $ysh = "checked"; } else { $nsh = "checked"; }
	if ($altsummary){ $yalt = "checked"; } else { $nalt = "checked"; }
	if ($left){ $yleft = "checked"; } else { $nleft = "checked"; }
	if ($center){ $ycenter = "checked"; } else { $ncenter = "checked"; }
	if ($right){ $yright = "checked"; } else { $nright = "checked"; }
	
	if (!isset($modops)) {
		$modops = "default";
	}
	if (isset($thememod)) {
		$thisfrm = $thememod;
		$def = $thememod;
		$blockshow = _AT_BLOCKSHOW;
		$temp = $thememod;
	}
	else {
		$thisfrm = _AT_MAIN;
		$def = _AT_DEF;
		$blockshow = _AT_BLOCKDEFAULT;
		$temp = "default";
	}
	atAdminOpenTable();
	echo "<form name=\"general\" method=\"POST\" action=\"".AT_ADMINPAGE."\">\n";
	if (isset($thememod)) {
		echo "  <input type=\"hidden\" name=\"op\" value=\"updatemod\">\n"
		."  <input type=\"hidden\" name=\"thememod\" value=\"$thememod\">\n"
		."  <input type=\"hidden\" name=\"modops\" value=\"$modops\">\n";
	}
	else {
		echo "  <input type=\"hidden\" name=\"op\" value=\"updategeneral\">\n";
	}
	echo "  <input type=\"hidden\" name=\"module\" value=\"".$GLOBALS['module']."\">\n"
	."  <input type=\"hidden\" name=\"themedir\" value=\"$themedir\">\n"
	."  <table border=\"0\" width=\"100%\" cellpadding=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" cellspacing=\"0\">\n"
	."    <tr>\n"
	."      <td><b>$def "._AT_THEME." "._AT_TEMPLATES."</b></td>\n"
	."      <td><b>"._AT_FILENAME."</b></td>\n"
	."      <td>&nbsp;</td>\n"
	."    </tr>\n"
	
	."    <tr>\n"
	."      <td>"._AT_DTDTEMPLATE."</td>\n"
	.at_file_select($atdir."templates/doctype", "dtd", $temps['dtd'], $templist, 0, 0)
	."      <td>&nbsp;</td>\n"
	."      <td>&nbsp;</td>\n"
	."    </tr>\n"
	
	."    <tr>\n"
	."      <td>"._AT_PAGETEMPLATE."</td>\n"
	.at_file_select($themedir, "main", $temps['main'], $filelist)
	."      <td><b>"._AT_STRIPTOHEAD."</b></td>\n"
	."      <td>&nbsp;</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td>&nbsp;</td>\n"
	."      <td>&nbsp;</td>\n"
	."      <td><input type=\"radio\" name=\"striphead\" value=\"1\" $ysh>"._AT_YES."\n"
	."          <input type=\"radio\" name=\"striphead\" value=\"0\" $nsh>"._AT_NO."</td>\n"
	."    </tr>\n";
	
	if (!isset($thememod) || $thememod == "News" || $thememod == "*HomePage") {
		echo "    <tr>\n"
		."      <td>"._AT_SUMMARY." "._AT_ARTICLE."</td>\n"
		.at_file_select($themedir, "summary", $temps['summary'], $filelist)
		."      <td>&nbsp;</td>\n"
		."    </tr>\n"
		."    <tr>\n"
		."      <td>"._AT_FIRST." "._AT_ALTERNATING." "._AT_SUMMARY."</td>\n"
		.at_file_select($themedir, "summary1", $temps['summary1'], $filelist)
		."      <td><b>"._AT_ALTSUMMARY."</b></td>\n"
		."    </tr>\n"
		."    <tr>\n"
		."      <td>"._AT_SECOND." "._AT_ALTERNATING." "._AT_SUMMARY."</td>\n"
		.at_file_select($themedir, "summary2", $temps['summary2'], $filelist)
		."      <td><input type=\"radio\" name=\"altsummary\" value=\"1\" $yalt>"._AT_YES."\n"
		."          <input type=\"radio\" name=\"altsummary\" value=\"0\" $nalt>"._AT_NO."</td>\n"
		."    </tr>\n"
		."    <tr>\n"
		."      <td>"._AT_FULL." "._AT_ARTICLE."</td>\n"
		.at_file_select($themedir, "article", $temps['article'], $filelist)
		."      <td>&nbsp;</td>\n"
		."    </tr>\n";
	}
	else {
		echo "    <tr>\n"
		."      <td>&nbsp;</td>\n"
		."      <td>&nbsp;</td>\n"
		."      <td>&nbsp;</td>\n"
		."    </tr>\n";
	}
	echo "    <tr>\n"
	."      <td>&nbsp;</td>\n"
	."      <td>&nbsp;</td>\n"
	."      <td><b>$blockshow</b></td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td>"._AT_LEFT." "._AT_BLOCKS."</td>\n"
	.at_file_select($themedir, "leftblock", $temps['leftblock'], $filelist)
	."      <td><input type=\"radio\" name=\"left\" value=\"1\" $yleft>"._AT_YES."\n"
	."          <input type=\"radio\" name=\"left\" value=\"0\" $nleft>"._AT_NO."</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td>"._AT_CENTER." "._AT_BLOCKS."</td>\n"
	.at_file_select($themedir, "centerblock", $temps['centerblock'], $filelist)
	."      <td><input type=\"radio\" name=\"center\" value=\"1\" $ycenter>"._AT_YES."\n"
	."          <input type=\"radio\" name=\"center\" value=\"0\" $ncenter>"._AT_NO."</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td>"._AT_RIGHT." "._AT_BLOCKS."</td>\n"
	.at_file_select($themedir, "rightblock", $temps['rightblock'], $filelist)
	."      <td><input type=\"radio\" name=\"right\" value=\"1\" $yright>"._AT_YES."\n"
	."          <input type=\"radio\" name=\"right\" value=\"0\" $nright>"._AT_NO."</td>\n"
	."    </tr>\n";
	if ($autoblock){
		ksort($autoblock);
		if (isset($thememod)) {
			foreach ($autoblock as $key => $ablock){
				if ($blockdisplay[$temp][$modops]["autoblock".$key]) { $yes = "checked"; $no = ""; } else { $yes = ""; $no = "checked"; }
				echo "    <tr>\n"
				."      <td>$ablock "._AT_BLOCKS."</td>\n"
				.at_file_select($themedir, "autoblock".$key, $temps["autoblock".$key], $filelist)
				."      <td><input type=\"radio\" name=\"ablockdis[$key]\" value=\"1\" $yes>"._AT_YES."\n"
				."          <input type=\"radio\" name=\"ablockdis[$key]\" value=\"0\" $no>"._AT_NO."</td>\n"
				."    </tr>\n";
			}
		}
		else {
			foreach ($autoblock as $key => $ablock){
				if ($blockdisplay[$temp]["autoblock".$key]) { $yes = "checked"; $no = ""; } else { $yes = ""; $no = "checked"; }
				echo "    <tr>\n"
				."      <td>$ablock "._AT_BLOCKS."</td>\n"
				.at_file_select($themedir, "autoblock".$key, $temps["autoblock".$key], $filelist)
				."      <td><input type=\"radio\" name=\"ablockdis[$key]\" value=\"1\" $yes>"._AT_YES."\n"
				."          <input type=\"radio\" name=\"ablockdis[$key]\" value=\"0\" $no>"._AT_NO."</td>\n"
				."    </tr>\n";
			}
		}
	}
	echo "    <tr>\n"
	."      <td>&nbsp;</td>\n"
	."      <td>&nbsp;</td>\n"
	."      <td>&nbsp;</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td>"._AT_FIRST." "._AT_TBL."</td>\n"
	.at_file_select($themedir, "table1", $temps['table1'], $filelist)
	."      <td>&nbsp;</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td>"._AT_SECOND." "._AT_TBL."</td>\n"
	.at_file_select($themedir, "table2", $temps['table2'], $filelist)
	."      <td>&nbsp;</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td>"._AT_STYLESHEET."</td>\n"
	.at_file_select($themedir, "stylesheet", $stylesheet, $csslist, 0, 0)
	."      <td>&nbsp;</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td>"._AT_LOGO." "._AT_IMG."</td>\n"
	.at_file_select($themedir, "logoimg", $logoimg, $imglist, 0, 0)
	."      <td>&nbsp;</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td>&nbsp;</td>\n"
	."      <td>&nbsp;</td>\n"
	."      <td>&nbsp;</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td><b>$def "._AT_THEME." "._AT_COLORS."</b></td>\n"
	."      <td><b>"._AT_COLOR."</b></td>\n"
	."      <td>&nbsp;</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td>"._AT_BG." "._AT_COLOR." 1</td>\n"
	."      <td><input type=\"text\" name=\"color1\" size=\"7\" value=\"$color1\"><a href=\"javascript:TCP.popup(document.forms['general'].elements['color1'], 0)\">"._AT_SELECT."</a></td>\n"
	."      <td bgcolor=\"$color1\">&nbsp;</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td>"._AT_BG." "._AT_COLOR." 2</td>\n"
	."      <td><input type=\"text\" name=\"color2\" size=\"7\" value=\"$color2\"><a href=\"javascript:TCP.popup(document.forms['general'].elements['color2'], 0)\">"._AT_SELECT."</a></td>\n"
	."      <td bgcolor=\"$color2\">&nbsp;</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td>"._AT_BG." "._AT_COLOR." 3</td>\n"
	."      <td><input type=\"text\" name=\"color3\" size=\"7\" value=\"$color3\"><a href=\"javascript:TCP.popup(document.forms['general'].elements['color3'], 0)\">"._AT_SELECT."</a></td>\n"
	."      <td bgcolor=\"$color3\">&nbsp;</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td>"._AT_BG." "._AT_COLOR." 4</td>\n"
	."      <td><input type=\"text\" name=\"color4\" size=\"7\" value=\"$color4\"><a href=\"javascript:TCP.popup(document.forms['general'].elements['color4'], 0)\">"._AT_SELECT."</a></td>\n"
	."      <td bgcolor=\"$color4\">&nbsp;</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td>"._AT_TXT." "._AT_COLOR." 1</td>\n"
	."      <td><input type=\"text\" name=\"color5\" size=\"7\" value=\"$color5\"><a href=\"javascript:TCP.popup(document.forms['general'].elements['color5'], 0)\">"._AT_SELECT."</a></td>\n"
	."      <td bgcolor=\"$color5\">&nbsp;</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td>"._AT_TXT." "._AT_COLOR." 2</td>\n"
	."      <td><input type=\"text\" name=\"color6\" size=\"7\" value=\"$color6\"><a href=\"javascript:TCP.popup(document.forms['general'].elements['color6'], 0)\">"._AT_SELECT."</a></td>\n"
	."      <td  bgcolor=\"$color6\">&nbsp;</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td>"._AT_TBL." "._AT_BORDER." "._AT_COLOR." 1</td>\n"
	."      <td><input type=\"text\" name=\"color7\" size=\"7\" value=\"$color7\"><a href=\"javascript:TCP.popup(document.forms['general'].elements['color7'], 0)\">"._AT_SELECT."</a></td>\n"
	."      <td  bgcolor=\"$color7\">&nbsp;</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td>"._AT_TBL." "._AT_BG." "._AT_COLOR." 1</td>\n"
	."      <td><input type=\"text\" name=\"color8\" size=\"7\" value=\"$color8\"><a href=\"javascript:TCP.popup(document.forms['general'].elements['color8'], 0)\">"._AT_SELECT."</a></td>\n"
	."      <td  bgcolor=\"$color8\">&nbsp;</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td>"._AT_TBL." "._AT_BORDER." "._AT_COLOR." 2</td>\n"
	."      <td><input type=\"text\" name=\"color9\" size=\"7\" value=\"$color9\"><a href=\"javascript:TCP.popup(document.forms['general'].elements['color9'], 0)\">"._AT_SELECT."</a></td>\n"
	."      <td  bgcolor=\"$color9\">&nbsp;</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td>"._AT_TBL." "._AT_BG." "._AT_COLOR." 2</td>\n"
	."      <td><input type=\"text\" name=\"color10\" size=\"7\" value=\"$color10\"><a href=\"javascript:TCP.popup(document.forms['general'].elements['color10'], 0)\">"._AT_SELECT."</a></td>\n"
	."      <td  bgcolor=\"$color10\">&nbsp;</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td>&nbsp;</td>\n"
	."      <td>&nbsp;</td>\n"
	."      <td>&nbsp;</td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td colspan=\"3\"><b>$def "._AT_HEAD." "._AT_CONTENT."</b><br />\n"
	."<textarea type=\"text\" wrap=\"virtual\" rows=\"5\" style=\"width: 100%\" name=\"head\">\n"
	.htmlentities($head)
	."</textarea></td>\n"
	."    </tr>\n"
	."    <tr>\n"
	."      <td><br /><input type=\"submit\" value=\""._AT_SAVE."\" name=\"B1\"></td>\n"
	."      <td>&nbsp;</td>\n"
	."      <td>&nbsp;</td>\n"
	."    </tr>\n"
	."  </table>\n"
	."</form>\n";
	atAdminCloseTable();
}

/* Write autotheme.cfg */
function atSaveAutoConfig($var, $extraname="")
{
    $var = atExportVar($var);
    
    if (file_exists(AT_DIRPREFIX."modules/AutoTheme/autotheme.cfg")) {
       if (!is_writable(AT_DIRPREFIX."modules/AutoTheme/autotheme.cfg")) {
           at_display_error("<b>"._AT_ERROR."</b>: autotheme.cfg "._AT_NOTWRITABLE);
       }
    }
    elseif (!is_writable(AT_DIRPREFIX."modules/AutoTheme/")) {
       at_display_error("<b>"._AT_ERROR."</b>: modules/AutoTheme/ "._AT_NOTWRITABLE);
    }
    $autoconfig = atGetAutoConfig();
    extract($autoconfig);

    extract($var);

    if (!$autoblock) { $autoblock = array(); }
    if (!$autocmd) { $autocmd = array(); }
    if (!$autoextra) { $autoextra = array(); }

    $content = STARTPHP."\n"
    .'$cmsoption = '
    .var_export($cmsoption, TRUE)
    .";\n"
    .'$cache = '
    .var_export($cache, TRUE)
    .";\n"
    .'$autoblock = '
    .var_export($autoblock, TRUE)
    .";\n"
    .'$autocmd = '
    .var_export($autocmd, TRUE)
    .";\n"
    .'$autoextra = '
    .var_export($autoextra, TRUE)
    .";\n";
    
    foreach ($autoextra as $k => $v) {
        if (is_array($$k)) {
            $content .= '$'.$k.' = '
            .var_export($$k, TRUE)
            .";\n";
        }
    }
    $content .= ENDPHP;

    $handle = fopen(AT_DIRPREFIX."modules/AutoTheme/autotheme.cfg", "w");
	fwrite($handle, $content);
	fclose($handle);
	
	atCompileClear();
}

/* Write theme.cfg */
function atSaveThemeConfig($themedir, $var)
{	
    $var = atExportVar($var);
    
    $themepath = at_gettheme_path($themedir);
    $themeconfig = atLoadThemeConfig($themepath);
    extract($themeconfig);

    if (!is_writable("$themepath/theme.cfg")) {
        at_display_error("<b>"._AT_ERROR."</b>: $themepath/theme.cfg "._AT_NOTWRITABLE);
    }
    extract($var);

    if (!$template) { $template = array(); }
    if (!$blockdisplay) { $blockdisplay = array(); }
    if (!$style) { $style = array(); }
    if (!$blocktemplate) { $blocktemplate = array(); }
    if (!$autoblock) { $autoblock = array(); }
    if (!$themecmd) { $themecmd = array(); }
    if (!$oscbox) { $oscbox = array(); }

    $content = STARTPHP."\n"
    .'$atversion = \'1.7\';'
    ."\n"
    .'$template = '
    .var_export($template, TRUE)
    .";\n"
    .'$blockdisplay = '
    .var_export($blockdisplay, TRUE)
    .";\n"
    .'$style = '
    .var_export($style, TRUE)
    .";\n"
    .'$blocktemplate = '
    .var_export($blocktemplate, TRUE)
    .";\n"
    .'$autoblock = '
    .var_export($autoblock, TRUE)
    .";\n"
    .'$themecmd = '
    .var_export($themecmd, TRUE)
    .";\n"
    .'$blockcontrol = '
    .var_export($blockcontrol, TRUE)
    .";\n";
    
    $autoconfig = atGetAutoConfig();
    $ext = atExtraScan($autoconfig['extradir']);
    
    foreach ($ext as $k => $v) {
        if (is_array($$k) && (isset($ext[$k]['themeadmin']) || isset($ext[$k]['modadmin']))) {        	
            $content .= '$'.$k.' = '
            .var_export($$k, TRUE)
            .";\n";
        }
    }
    $content .= ENDPHP;

    $handle = fopen("$themepath/theme.cfg", "w");
	fwrite($handle, $content);
	fclose($handle);
	
	atCompileClear();
}

/* fix theme config for new features */
function atFixupThemeConfig($themedir)
{
	$autocmd = array();
    $autoblock = array();

    $autoconfig = atGetAutoConfig();
    extract($autoconfig);
    
    $tempab = $autoblock;
    $tempcmd = $autocmd;

    $themepath = at_gettheme_path($themedir);
    
    $themeconfig = atLoadThemeConfig($themepath);
    extract($themeconfig);
    
    if (empty($autoblock)) {
        $autoblock = $tempab;
    }
    if (empty($themecmd)) {
        $themecmd = $tempcmd;
    }
    /* fix old custom module names */
    if (array_key_exists("pnHome", $template)) {
        $template['*HomePage'] = $template['pnHome'];
        $blockdisplay['*HomePage'] = $blockdisplay['pnHome'];
        $style['*HomePage'] = $style['pnHome'];
        unset($template['pnHome'], $blockdisplay['pnHome'], $style['pnHome']);
    }
    if (array_key_exists("pnAdmin", $template)) {
        $template['*AdminPages'] = $template['pnAdmin'];
        $blockdisplay['*AdminPages'] = $blockdisplay['pnAdmin'];
        $style['*AdminPages'] = $style['pnAdmin'];
        unset($template['pnAdmin'], $blockdisplay['pnAdmin'], $style['pnAdmin']);
    }
    if (array_key_exists("pnUser", $template)) {
        $template['*UserPages'] = $template['pnUser'];
        $blockdisplay['*UserPages'] = $blockdisplay['pnUser'];
        $style['*UserPages'] = $style['pnUser'];
        unset($template['pnUser'], $blockdisplay['pnUser'], $style['pnUser']);
    }
    if (array_key_exists("nukeHome", $template)) {
        $template['*HomePage'] = $template['nukeHome'];
        $blockdisplay['*HomePage'] = $blockdisplay['nukeHome'];
        $style['*HomePage'] = $style['nukeHome'];
        unset($template['nukeHome'], $blockdisplay['nukeHome'], $style['nukeHome']);
    }
    if (array_key_exists("nukeAdmin", $template)) {
        $template['*AdminPages'] = $template['nukeAdmin'];
        $blockdisplay['*AdminPages'] = $blockdisplay['nukeAdmin'];
        $style['*AdminPages'] = $style['nukeAdmin'];
        unset($template['nukeAdmin'], $blockdisplay['nukeAdmin'], $style['nukeAdmin']);
    }
    if (array_key_exists("nukeUser", $template)) {
        $template['*UserPages'] = $template['nukeUser'];
        $blockdisplay['*UserPages'] = $blockdisplay['nukeUser'];
        $style['*UserPages'] = $style['nukeUser'];
        unset($template['nukeUser'], $blockdisplay['nukeUser'], $style['nukeUser']);
    }
    /* fix block templates for custom modules */
    if (!is_array($blocktemplate['default'])) {
    	$temp = $blocktemplate;
    	unset($blocktemplate);
    	$blocktemplate['default'] = $temp;
    	
        foreach ($template as $thememod => $a) {
    		if ($thememod != 'default') {
    		    foreach ($a as $modops => $v) {
                    $blocktemplate[$thememod][$modops] = $temp;
                }
            }
    	}
    }
    /* fix autoblock templates and blockdisplay keys */
    foreach ($template as $mod => $arr1) {
        foreach ($arr1 as $modop => $arr2) {
            if ($mod == "default") {
                foreach ($autoblock as $num => $name) {
                    if (!$template['default']['autoblock'.$num]) {
                        $template['default']['autoblock'.$num] = $template['default'][$name.'block'];
                        $blockdisplay['default']['autoblock'.$num] = $blockdisplay['default'][$name];
                        unset($template['default'][$name.'block']);
                        unset($blockdisplay['default'][$name]);
                    }
                }
            }
            else {
                foreach ($arr2 as $k => $v) {
                    foreach ($autoblock as $num => $name) {
                        if (!$template[$mod][$modop]['autoblock'.$num]) {
                            $template[$mod][$modop]['autoblock'.$num] = $template[$mod][$modop][$name.'block'];
                            $blockdisplay[$mod][$modop]['autoblock'.$num] = $blockdisplay[$mod][$modop][$name];
                            unset($template[$mod][$modop][$name.'block']);
                            unset($blockdisplay[$mod][$modop][$name]);
                        }
                    }
                }
            }
        }
    }
    $var = compact("template", "blockdisplay", "style", "autoblock", "themecmd", "blocktemplate");
    atSaveThemeConfig($themedir, $var);
}

function AutoTheme_admin_editfile($var)
{
   return;
}

function at_edit_link($themedir, $file, $create)
{
	return;
}

function at_edit_prep($filename, $striphead=1)
{
    return;
}

function atAdminOpenTable()
{
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"".$GLOBALS['bgcolor2']."\"><tr><td>\n";
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\" bgcolor=\"".$GLOBALS['bgcolor1']."\"><tr><td>\n";
}


function atAdminCloseTable()
{
	echo "</td></tr></table></td></tr></table>\n";
}

function AutoTheme_admin_cmsblocks($var)
{
	$var = atExportVar($var);
    extract($var);
	
	$themepath = at_gettheme_path($themedir);
    $themeconfig = atLoadThemeConfig($themepath);
    extract($themeconfig);
    	    	
    if ($modops) {
    	$themeblocks = $blockcontrol[$thememod][$modops];        
    }
    else {
    	$themeblocks = $blockcontrol['default'];
    }
    atAdminThemeLinks($themedir, _AT_BLOCKCONTROL, $var, 1);
    
    atAdminOpenTable();
     echo "<form method=\"POST\" action=\"".AT_ADMINPAGE."\">\n"
    ."  <input type=\"hidden\" name=\"op\" value=\"updatecmsblocks\">\n"
    ."  <input type=\"hidden\" name=\"module\" value=\"AutoTheme\">\n"
    ."  <input type=\"hidden\" name=\"themedir\" value=\"$themedir\">\n"
    ."  <input type=\"hidden\" name=\"thememod\" value=\"$thememod\">\n"
	."  <input type=\"hidden\" name=\"modops\" value=\"$modops\">\n"
    ."<b>"._AT_BLOCK."</b></td><td><b>"._AT_AUTOBLOCK."</b></td><td><b>"._AT_ORDER."</b></td><td><b>"._AT_ENABLE."</b></td></tr><tr><td>\n";
    
    $autoblock['l'] = _AT_LEFT;
    $autoblock['c'] = _AT_CENTER;
    $autoblock['r'] = _AT_RIGHT;
    
    $boxes = atGetBlockConfig($themeblocks);
    
    if ($boxes) {    	
        foreach ($boxes as $t => $themebox){        	        	
        	$abselect = "<select name=\"boxes[$t][position]\">";
        	foreach ($autoblock as $k => $v) {
        		if ($themebox['position'] == $k) {
        			$sel = " selected";
        		}
        		else {
        			$sel = "";
        		}
        		$abselect .= "<option$sel value=\"$k\">$v</option>";
        	}
        	$abselect .= "</select>";
        	
        	$pos = $themebox['position'];
        	switch ($pos) {
        		case "l":
        		$pos = _AT_LEFT;
        		break;
        		
        		case "c":
        		$pos = _AT_CENTER;
        		break;
        		
        		case "r":
        		$pos = _AT_RIGHT;
        		break;
        		
        		default:
        		$pos = "none";
        		break;
        	}       	
        	$yes = $no = "";
        	if ($themebox['active']) {
        		$yes = " checked";
        	}
        	else {
        		$no = " checked";
        	}
        	if ($themebox['position'] == $lastpos) {
       			$uplink = "<a href=\"".AT_ADMINPAGE."?module=AutoTheme&op=updatecmsblocks&themedir=$themedir&thememod=$thememod&modops=$modops&box=$t&order=up\">"._AT_UP."</a>";
        	}
        	else {
        		$uplink = _AT_UP;
        	}
        	$lastpos = $themebox['position'];
        	$next = next($boxes);
        	        	
        	if ($themebox['position'] == $next['position']) {
        		$downlink = "<a href=\"".AT_ADMINPAGE."?module=AutoTheme&op=updatecmsblocks&themedir=$themedir&thememod=$thememod&modops=$modops&box=$t&order=down\">"._AT_DOWN."</a>";
        	}
        	else {
        		$downlink = _AT_DOWN;
        	}
        	        	
            echo $t."</td>\n"
            ."<input type=\"hidden\" name=\"boxes[$t][title]\" value=\"$t\">\n"
            ."<td>".$abselect.$themebox['weight']."</td>\n"
            ."<td>[ $uplink | $downlink ]</td>\n"
            ."<td>"
            ."<input type=\"hidden\" name=\"boxes[$t][weight]\" value=\"".$themebox['weight']."\">\n"
            ."<input type=\"radio\" name=\"boxes[$t][active]\" value=\"1\"$yes>"._AT_YES."\n"
        	."<input type=\"radio\" name=\"boxes[$t][active]\" value=\"0\"$no>"._AT_NO."</td><td>"
            ."</td>\n"
            ."</tr><tr><td>\n";
        
        }
        echo "<input type=\"submit\" value=\""._AT_SAVE."\" name=\"save\">\n"
        ."<input type=\"submit\" value=\""._AT_RESETTODEFAULTS."\" name=\"reset\">\n"
        ."</form></td><td>\n";
    }
    else {
        echo _AT_NOBOXES;
    }
    atAdminCloseTable();
    
    if ($modops) {
    	$blockcontrol[$thememod][$modops] = $boxes;
    }
    else {
    	$blockcontrol['default'] = $boxes;
    }	
	atAdminFooter();
}

function AutoTheme_admin_updatecmsblocks($var)
{
    $var = atExportVar($var);
    extract($var);
	
	$themepath = at_gettheme_path($themedir);
    $themeconfig = atLoadThemeConfig($themepath);
    extract($themeconfig);
    
    if ($modops) {
    	$themeblocks = $blockcontrol[$thememod][$modops];
    }
    else {
    	$themeblocks = $blockcontrol['default'];
    }	
	if (isset($order)) {
		$boxes = atGetBlockConfig($themeblocks);

		switch ($order) {
			case "up":
			$boxes[$box]['weight']--;
			break;
			
			case "down":
			$boxes[$box]['weight']++;
			break;
		}
		
		if ($boxes[$box]['weight'] <= 0) {
			$boxes[$box]['weight'] = 1;
		}
		foreach ($boxes as $bkey => $b) {
			if (($bkey != $box) && ($b['position'] == $boxes[$box]['position'])) {
				$result[$bkey] = $b;
				
				switch ($order) {
					case "up":
					if ($b['weight'] == $boxes[$box]['weight']) {
						$result[$bkey]['weight']++;
					}
					break;
					
					case "down":
					if ($b['weight'] == $boxes[$box]['weight']) {
						$result[$bkey]['weight']--;
					}
					break;
				}
			}
		}
		$boxes = array_merge((array)$boxes, (array)$result);		
	}
	if (isset($reset) && !$modops) {
		$boxes = atGetBlocks();
	}
	elseif (isset($reset) && $modops) {
	    $boxes = array();
	}
	uasort($boxes, 'at_block_sort');

	$weight = 0;
	foreach ($boxes as $k => $v) {
		$result[$k]['position'] = $boxes[$k]['position'];
		$result[$k]['active'] = $boxes[$k]['active'];
		
		if ($boxes[$k]['position'] == $lastpos) {
			$weight++;
		}
		else {
			$weight = 1;
		}
		$result[$k]['weight'] = $weight;
		$lastpos = $boxes[$k]['position'];
	}
	$boxes = $result;
	 
	if ($modops) {
    	$blockcontrol[$thememod][$modops] = $boxes;
    }
    else {
    	$blockcontrol['default'] = $boxes;
    }    
	$var = compact("blockcontrol");
	atSaveThemeConfig($themedir, $var);

	Header("Location: ".AT_ADMINPAGE."?module=AutoTheme&op=cmsblocks&themedir=".htmlentities(urlencode($themedir))."&thememod=$thememod&modops=$modops");
	exit;
}

?>