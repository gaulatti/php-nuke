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

define('AUTOTHEME_DEBUG_ENABLED', FALSE);

define('AUTOTHEME_API_LOADED', TRUE);
define('STARTPHP', str_replace('&lt;', '<', '&lt;?php'));
define('ENDPHP', str_replace('&gt;', '>', '?&gt;'));

function atInit($atdir, $thename)
{
	atThemeInit($thename);
}

function atAPIInit($force=FALSE)
{
	atErrorCheck();

	if (defined('AUTOTHEME_API_INITIALIZED') && !$force) {
        return atGetGlobalConfig();
    }
    define('AUTOTHEME_API_INITIALIZED', TRUE);

    unset($GLOBALS['AT_AUTO']);
    unset($GLOBALS['AT_THEME']);
    unset($GLOBALS['AT_RUNNING']);

    define ('_ATDIR', dirname(dirname(__FILE__))."/");
    $atdir = _ATDIR;
    $incdir = $atdir."includes/";
    $extradir = $atdir."extras/";
    $compiledir = $atdir."_compile/";
    $cachedir = $atdir."_cache/";
    $platform = atGetPlatform();
    $platformdir = $incdir."$platform/";
    $atpath = "modules/AutoTheme/";

    include_secure($platformdir."atAPI.php");

    $platformconfig = atPlatformAPIInit($atdir);
    extract($platformconfig);

    atLoadAutoConfig($atdir);

    atAutoSetVar("atdir", $atdir);
    atAutoSetVar("incdir", $incdir);
    atAutoSetVar("extradir", $extradir);
    atAutoSetVar("compiledir", $compiledir);
    atAutoSetVar("cachedir", $cachedir);
    atAutoSetVar("platform", $platform);
    atAutoSetVar("platformdir", $platformdir);
    atAutoSetVar("atpath", $atpath);

    atModLangLoad('user');

    atExtraLoadAll();

    return atGetGlobalConfig();
}

function atThemeInit($thename, $force=FALSE)
{
	atErrorCheck();

    if (defined('AUTOTHEME_THEME_INITIALIZED') && !$force) {
        return atGetRunningConfig();
    }
    define('AUTOTHEME_THEME_INITIALIZED', TRUE);

    $globalconfig = atAPIInit();
    extract($globalconfig);

    $platformconfig = atPlatformThemeInit($thename);
    extract($platformconfig);

    $lang = atGetLang();
    $themepath = $multipath."themes/$thename/";
    $imagepath = $themepath."images/";
    $imagelangpath = $imagepath."$lang/";

    atThemeSetVar("lang", $lang);
    atThemeSetVar("thename", $thename);
    atThemeSetVar("themepath", $themepath);
    atThemeSetVar("imagepath", $imagepath);
    atThemeSetVar("imagelangpath", $imagelangpath);
    atThemeSetVar("multipath", $multipath);

    include_secure($platformdir."atFuncs.php");

    atLoadThemeConfig($themepath);
    atThemeLangLoad($themepath);

    $runningconfig = atLoadRunningConfig();

    $extra = $runningconfig['extra'];

    if (isset($extra)) {
    	ob_start();
    	foreach ($extra as $name) {
    		if (isset($name['themeinit'])) {
    			$func = $name['themeinit'];
    			if (function_exists("$func")) {
    				$func($runningconfig);
    			}
    		}
    	}
    	ob_end_clean();
    }
    include_secure($incdir."atExtended.php");

    atExtendedInit();

    ob_start();

    return $runningconfig;
}

function atAdminInit()
{
    if (defined('AUTOTHEME_ADMIN_INITIALIZED')) {
        return atGetGlobalConfig();
    }
    define('AUTOTHEME_ADMIN_INITIALIZED', TRUE);

    $globalconfig = atAPIInit();
    extract($globalconfig);

    include_secure($platformdir."atAdmin.php");

    $platformconfig = atPlatformAdminInit();
    extract($platformconfig);

    atModLangLoad('admin');
    atLoadAutoConfig($atdir);

    return atGetGlobalConfig();
}

function atLoadRunningConfig()
{
	$globalconfig = atGetGlobalConfig();
    extract($globalconfig);

    atRunningMultiSetVars($globalconfig);

    $modname = atGetModName();
    $modtemplate = atTemplateGetType($template);

    atLoadCommands();
    atRunningSetVar("command", atGetCommands());

    atRunningSetVar("atdir", $atdir);
    atRunningSetVar("incdir", $incdir);
    atRunningSetVar("extradir", $extradir);
    atRunningSetVar("compiledir", $compiledir);
    atRunningSetVar("platform", $platform);
    atRunningSetVar("platformdir", $platformdir);
    atRunningSetVar("thename", $thename);
    atRunningSetVar("themepath", $themepath);
    atRunningSetVar("imagepath", $imagepath);
    atRunningSetVar("imagelangpath", $imagelangpath);
    atRunningSetVar("imgpath", $imagepath);
    atRunningSetVar("multipath", $multipath);
    atRunningSetVar("modname", $modname);
    atRunningSetVar("modtemplate", $modtemplate);
    atRunningSetVar("language", atGetLang());
    atRunningSetVar("modtype", atGetModType());
    atRunningSetVar("username", atGetUserName());
    atRunningSetVar("is_loggedin", atIsLoggedIn());
    atRunningSetVar("is_admin", atIsAdminUser());
    atRunningSetVar("is_home", atIsHomePage());

    /* 1.7 cfg */
    if (isset($template[$modtemplate]['default'])) {
        $modops = "default";
        $matchlen = 0;
        if ($_SERVER['QUERY_STRING']) {
            foreach ($template[$modtemplate] as $ops => $vals) {
                if ((strlen($ops) > $matchlen) && eregi($ops, $_SERVER['QUERY_STRING'])) {
                    $modops = $ops;
                    $matchlen = strlen($modops);
                }
            }
        }
        $template = array_merge((array)$template['default'], (array)$template[$modtemplate][$modops]);
        $blockdisplay = array_merge((array)$blockdisplay['default'], (array)$blockdisplay[$modtemplate][$modops]);
        $style = array_merge((array)$style['default'], (array)$style[$modtemplate][$modops]);
       	$blocktemplate = array_merge((array)$blocktemplate['default'], (array)$blocktemplate[$modtemplate][$modops]);
       	$blockcontrol = array_merge((array)$blockcontrol['default'], (array)$blockcontrol[$modtemplate][$modops]);
    }
    /* 1.0 cfg */
    elseif (isset($template[$modtemplate])) {
        $template = array_merge((array)$template['default'], (array)$template[$modtemplate]);
        $blockdisplay = array_merge((array)$blockdisplay['default'], (array)$blockdisplay[$modtemplate]);
        $style = array_merge((array)$style['default'], (array)$style[$modtemplate]);
    }
    /* No custom module */
    elseif (!isset($template[$modtemplate])) {
        $template = $template['default'];
        $blockdisplay = $blockdisplay['default'];
        $style = $style['default'];
        if ($blocktemplate['default']) {
            $blocktemplate = $blocktemplate['default'];
        }
        if ($blockcontrol['default']) {
            $blockcontrol = $blockcontrol['default'];
        }
    }
    if (!$modops) {
    	$modops = "default";
    }
    atRunningSetVar("modops", $modops);

    if (eregi("xhtml", $template['dtd'])) {
		$xhtml = 1;
	}
	else {
		$xhtml = 0;
	}
	atRunningSetVar("xhtml", $xhtml);

    extract($style);

    atRunningSetVar("logoimg", $logoimg);
    atRunningSetVar("bgcolor1", $color1);
    atRunningSetVar("bgcolor2", $color2);
    atRunningSetVar("bgcolor3", $color3);
    atRunningSetVar("bgcolor4", $color4);
    atRunningSetVar("textcolor1", $color5);
    atRunningSetVar("textcolor2", $color6);
    atRunningSetVar("tblcolor1", $color7);
    atRunningSetVar("tblcolor2", $color8);
    atRunningSetVar("tblcolor3", $color9);
    atRunningSetVar("tblcolor4", $color10);
    atRunningSetVar("striphead", $striphead);

    $runningconfig = compact(
        "template",
        "blockdisplay",
        "style",
        "blocktemplate",
        "blockcontrol",
        "themeversion",
        "autoblock",
        "autolang"
    );

    atRunningMultiSetVars($runningconfig);
    atRunningMultiSetVars(atGetLangVars());
    atRunningSetVar("blocklist", atGetBlockConfig());

    return atGetRunningConfig();
}

function atGetLangVars()
{
    $const = get_defined_constants();

    foreach ($const as $k => $v) {
        if ($k[0] == "_") {
            $result["LANG$k"] = $v;
        }
    }
    return $result;
}

function atTemplateGetType($template)
{
    if (atIsHomePage()) {
        if (isset($template['pnHome'])) {
            $type = "pnHome";
        }
        if (isset($template['nukeHome'])) {
            $type = "nukeHome";
        }
        if (isset($template['*HomePage'])) {
            $type = "*HomePage";
        }
    }
    $modtype = atGetModType();

    if ($modtype == "admin") {
        if (isset($template['pnAdmin'])) {
            $type = "pnAdmin";
        }
        if (isset($template['nukeAdmin'])) {
            $type = "nukeAdmin";
        }
        if (isset($template['*AdminPages'])) {
            $type = "*AdminPages";
        }
    }
    if ($modtype == "user") {
        if (isset($template['pnUser'])) {
            $type = "pnUser";
        }
        if (isset($template['nukeUser'])) {
            $type = "nukeUser";
        }
        if (isset($template['*UserPages'])) {
            $type = "*UserPages";
        }
    }
    if (!isset($type)) {
        $type = atGetModName();
    }
    return $type;
}

function atGetCommands()
{
    $globalconfig = atGetGlobalConfig();
    extract($globalconfig);

    if (atIsLoggedIn()) {
        $result = $command['loggedin'];
    }
    else {
        $result = $command['anonymous'];
    }
    if (atIsAdminUser()) {
        $result = array_merge((array)$result, (array)$command['admin']);
    }
    $result = array_merge((array)$command['all'], (array)$result);

    return $result;
}

function atLoadCommands()
{
    $globalconfig = atGetGlobalConfig();
    extract($globalconfig);

    require($incdir."atCommands.php");
    require($platformdir."atCommands.php");

    $extracmd = atLoadExtraCommands($extradir);

    $result['admin'] = array_merge(
            (array)$command['admin'],
            (array)$platformcmd['admin'],
            (array)$extracmd['admin'],
            (array)$autocmd['admin'],
            (array)$themecmd['admin']);

    $result['all'] = array_merge(
            (array)$command['all'],
            (array)$platformcmd['all'],
            (array)$extracmd['all'],
            (array)$autocmd['all'],
            (array)$themecmd['all']);

    $result['anonymous'] = array_merge(
            (array)$command['anonymous'],
            (array)$platformcmd['anonymous'],
            (array)$extracmd['anonymous'],
            (array)$autocmd['anonymous'],
            (array)$themecmd['anonymous']);

    $result['loggedin'] = array_merge(
            (array)$command['loggedin'],
            (array)$platformcmd['loggedin'],
            (array)$extracmd['loggedin'],
            (array)$autocmd['loggedin'],
            (array)$themecmd['loggedin']);

    atAutoSetVar("command", $result);

    return $result;
}

function atCommandAdd($name, $command)
{
    $GLOBALS['AT_RUNNING']['command'][$name] = $command;
}

function atCommandMultiAdd($commands, $prefix="")
{
    foreach ($commands as $key => $val) {
        /* atCommandAdd("$key", 'echo $'.$prefix.'["'.$key.'"];'); */
        atCommandAdd("$key", $val);
    }
}

function atCommandReturn($commands, $prefix="")
{
    if (!$prefix) {
        $prefix = strtolower(atGetModName());
    }
    atRunningSetVar($prefix, $commands);

    foreach ($commands as $key => $val) {
        $cmd["$prefix:$key"] = 'echo $'.$prefix.'["'.$key.'"];';
    }
    return $cmd;
}

function atCommandBuild($commands, $prefix="")
{
    $cmd = atCommandReturn($commands, $prefix);
    atCommandMultiAdd($cmd, $prefix);
}

function atCommandReplace($tmpcontent, $commands=array())
{
    $runningconfig = atGetRunningConfig();
    extract($runningconfig);

    /* $search = '/{repeat:([\w\d\_]+):([\w\d\:\_]+)}(.*){repeat}/';
    $replace = STARTPHP.' for(\$i=0; \$i<count(\$$1["$2"]); \$i++) { eval(\''.ENDPHP.'$3\'); } '.ENDPHP;
    $tmpcontent = preg_replace($search, $replace, $tmpcontent); */

    $commands = array_merge((array)$command, (array)$commands);

    foreach ($commands as $cmd => $action) {
        $search = array(
            "<!-- [$cmd] -->",
            "<!--[$cmd]-->",
            "<!-- {".$cmd."} -->",
            "<!--{".$cmd."}-->",
            "{".$cmd."}",
        );

        $replace = STARTPHP." $action ".ENDPHP;
        $tmpcontent = str_replace($search, $replace, $tmpcontent);
    }
    foreach ($runningconfig as $cmd => $action) {
        $search = array(
            "<!-- [$cmd] -->",
            "<!--[$cmd]-->",
            "<!-- {".$cmd."} -->",
            "<!--{".$cmd."}-->",
            "{".$cmd."}",
        );
        $replace = STARTPHP." echo \$$cmd; ".ENDPHP;

        $tmpcontent = str_replace($search, $replace, $tmpcontent);
    }
    return $tmpcontent;
}

function atTemplateRead($file)
{
    $HTML = @file_get_contents($file);

    return $HTML;
}

function atTemplatePrep($filename, $striphead=1, $complete=0)
{
    if (defined('AUTOTHEME_DEBUG_ENABLED') && AUTOTHEME_DEBUG_ENABLED) {
        if (is_dir($filename)) {
            return _AT_TEMPLATENOTDEFINED;
        }
        elseif (!is_file($filename)) {
            return _AT_TEMPLATENOTFOUND.": $filename<br />";
        }
    }
    $HTML = atTemplateRead($filename);

    if (!$complete) {
    	$parts = spliti('\<\/head\>', $HTML);

    	if (isset($parts[1])) {
	        $HTML = $parts[1];
	        $head = $parts[0];
	    }
	    else {
	        $HTML = $parts[0];
	        $head = "";
	    }
    	if (!$striphead && $head) {
    		$head = spliti('\<head\>', $head);
    		$head = trim($head[1]);
    		$HTML = "\n<!-- Head from template -->\n$head\n\n</head>\n$HTML\n";
    	}
    	elseif($head) {
    	    $HTML = "</head>\n$HTML\n";
    	}
	    $HTML = spliti('\<\/body\>', $HTML);
	    $HTML = $HTML[0];
    }
    $HTML = trim($HTML);

    return $HTML;
}

function atTemplateSplit($content, $spliton)
{
    $parts = preg_split("/(\<\!--[ ]*\[|{)$spliton(}|\][ ]*--\>)/", $content);

    return array($parts[0], $parts[1]);
}

function atTemplateDisplay($tmpcontent)
{
    $runningconfig = atGetRunningConfig();
    extract($runningconfig);

    eval(ENDPHP.$tmpcontent);
}

function atModLangLoad($type)
{
    $lang = atGetLang();

    if (@file_exists(_ATDIR."/lang/$lang/$type.php")) {
        @include(_ATDIR."lang/$lang/$type.php");
    }
    else {
        @include(_ATDIR."lang/eng/$type.php");
    }
}

function atThemeLangLoad($themepath)
{
    $lang = atGetLang();

    if (@file_exists("$themepath/lang/$lang/global.php")) {
        @include("$themepath/lang/$lang/global.php");
    }
    else {
        @include("$themepath/lang/eng/global.php");
    }
}

function atExportVar($var)
{
    if (is_array($var)) {
        foreach ($var as $k => $v) {
            $result[atExportVar($k)] = atExportVar($v);
        }
        return $result;
    }
    if (get_magic_quotes_gpc()) {
        $var = stripslashes($var);
    }
    return $var;
}

function atDisplayVar($var)
{
    return htmlentities($var);
}

function atLoadAutoConfig($path)
{
    @include($path."/autotheme.cfg");

    $autoconfig = compact("cmsoption", "cache", "cache_expire", "autotheme", "autoblock", "autolang", "autocmd", "autoextra");

    foreach ($autoextra as $k => $v) {
        if (isset($$k)) {
            $autoconfig[$k] = $$k;
        }
    }
    atAutoMultiSetVars($autoconfig);

    return $autoconfig;
}

function atGetAutoConfig()
{
    if (isset($GLOBALS['AT_AUTO'])) {
        return $GLOBALS['AT_AUTO'];
    }
    else {
        return false;
    }
}

function atAutoMultiSetVars($vars)
{
    foreach ($vars as $name => $val) {
        atAutoSetVar($name, $val);
    }
}

function atAutoSetVar($name, $val)
{
	$GLOBALS['AT_AUTO'][$name] = $val;
}

function atAutoGetVar($var)
{
    if (isset($GLOBALS['AT_AUTO'][$var])) {
        return $GLOBALS['AT_AUTO'][$var];
    }
    else {
        return false;
    }
}

function atLoadThemeConfig($path, $atdir="modules/AutoTheme")
{
    @include($atdir."/autotheme.cfg");
    @include("modules/Blocks/autoblock.cfg");
    @include($path."/autoblock.cfg");
	@include($path."/theme.cfg");

    $themeconfig = compact("template", "blockdisplay", "style", "blocktemplate", "autoblock", "themecmd", "themeversion", "oscbox", "blockcontrol");

    foreach ($autoextra as $k => $v) {
        if (isset($$k)) {
            $themeconfig[$k] = $$k;
        }
    }
    atThemeMultiSetVars($themeconfig);

    return $themeconfig;
}

function atGetThemeConfig()
{
    return $GLOBALS['AT_THEME'];
}

function atThemeMultiSetVars($vars)
{
    foreach ($vars as $name => $val) {
        atThemeSetVar($name, $val);
    }
}

function atThemeSetVar($name, $val)
{
    $GLOBALS['AT_THEME'][$name] = $val;
}

function atThemeGetVar($var)
{
    return $GLOBALS['AT_THEME'][$var];
}

function atGetRunningConfig()
{
    return $GLOBALS['AT_RUNNING'];
}

function atRunningMultiSetVars($vars)
{
    foreach ($vars as $name => $val) {
        atRunningSetVar($name, $val);
    }
}

function atRunningSetVar($name, $val)
{
     $GLOBALS['AT_RUNNING'][$name] = $val;
}

function atRunningGetVar($var)
{
    return $GLOBALS['AT_RUNNING'][$var];
}

function atGetGlobalConfig()
{
    $autoconfig = $themeconfig = array();

    if (isset($GLOBALS['AT_AUTO'])) {
        $autoconfig = $GLOBALS['AT_AUTO'];
        $auto = 1;
    }
    if (isset($GLOBALS['AT_THEME'])) {
        $themeconfig = $GLOBALS['AT_THEME'];
        $theme = 1;
    }
    if (!isset($auto) && !isset($theme)) {
        return false;
    }
    else {
        return array_merge((array)$autoconfig, (array)$themeconfig);
    }
}

function atGetBaseDir()
{
    return $_SERVER['DOCUMENT_ROOT']."/";
}

function atGetPlatform()
{
    $platform = "AutoTheme";

	if ((isset($GLOBALS['mainfile']) && $GLOBALS['mainfile'] == 1) || defined('NUKE_FILE')) {
        $platform = "PHP-Nuke";
    }
    if (defined('CPG_NUKE')) {
        $platform = "CPG-Nuke";
    }
    if (defined('PROJECT_VERSION')) {
	    if (eregi('osCommerce', PROJECT_VERSION)) {
	    	$platform = "osCommerce";
	    }
	    if (eregi('CRE', PROJECT_VERSION)) {
	    	$platform = "CRE";
	    }
    }
    if (function_exists("pnConfigGetVar")) {
        $platform = pnConfigGetVar('Version_ID');
    }
    $platform = strtolower($platform);

    return $platform;
}

function atThemeOpen($preprocess=TRUE)
{
	ob_end_clean();
	ob_start();
	echo "\n<!-- [#AUTOTHEME_START#] -->\n";

	$runningconfig = atGetRunningConfig();

    if (!isset($runningconfig['extra'])) {
        return;
    }
    $extra = $runningconfig['extra'];

    foreach ($extra as $name) {
		if ($preprocess && isset($name['themepreprocess'])) {
			$themeprefuncs[] = $name['themepreprocess'];
		}
		if (isset($name['themeopen'])) {
            $func = $name['themeopen'];
            if (function_exists("$func")) {
            	$func($runningconfig);
            }
        }
    }
    if (isset($themeprefuncs)) {
    	atThemePreProcess($themeprefuncs);
    }
}

function atThemePreProcess($funcs)
{
	$display = ob_get_contents();
    ob_end_clean();
    ob_start();

	foreach ($funcs as $func) {
		if (function_exists("$func")) {
            $display = $func($display);
        }
    }
    echo $display;
}

function atBodyOpen()
{
    $runningconfig = atGetRunningConfig();

    //echo "\n</head>\n";

    if (!isset($runningconfig['extra'])) {
        return;
    }
    $extra = $runningconfig['extra'];

    foreach ($extra as $name) {
		if (isset($name['bodypreprocess'])) {
			$bodyprefuncs[] = $name['bodypreprocess'];
		}
		if (isset($name['bodyopen'])) {
            $func = $name['bodyopen'];
            if (function_exists("$func")) {
            	$func($runningconfig);
            }
        }
    }
    if (isset($bodyprefuncs)) {
    	atBodyPreProcess($bodyprefuncs);
    }
}

function atBodyPreProcess($funcs)
{
	$display = ob_get_contents();
    ob_end_clean();
    ob_start();

	foreach ($funcs as $func) {
		if (function_exists("$func")) {
            $display = $func($display);
        }
    }
    echo $display;
}

function atModOpen()
{
    $runningconfig = atGetRunningConfig();

    if (!isset($runningconfig['extra'])) {
        return;
    }
    $extra = $runningconfig['extra'];

    foreach ($extra as $name) {
		if (isset($name['modpreprocess'])) {
			$modprefuncs[] = $name['modpreprocess'];
		}
		if (isset($name['modopen'])) {
            $func = $name['modopen'];
            if (function_exists("$func")) {
            	$func($runningconfig);
            }
        }
    }
    if (isset($modprefuncs)) {
    	atModPreProcess($modprefuncs);
    }
}

function atModPreProcess($funcs)
{
    $display = ob_get_contents();
    ob_end_clean();
    ob_start();

	foreach ($funcs as $func) {
		if (function_exists("$func")) {
            $display = $func($display);
        }
    }
    echo $display;
}

function atModClose()
{
	$runningconfig = atGetRunningConfig();

    if (!isset($runningconfig['extra'])) {
        return;
    }
    $extra = $runningconfig['extra'];

    foreach ($extra as $name) {
		if (isset($name['modpostprocess'])) {
			$modpostfuncs[] = $name['modpostprocess'];
		}
		if (isset($name['modclose'])) {
            $func = $name['modclose'];
            if (function_exists("$func")) {
            	$func($runningconfig);
            }
        }
    }
    if (isset($modpostfuncs)) {
    	atModPostProcess($modpostfuncs);
    }
}

function atModPostProcess($funcs)
{
    $display = ob_get_contents();
    ob_end_clean();
   	ob_start();

	foreach ($funcs as $func) {
		if (function_exists("$func")) {
            $display = $func($display);
        }
    }
    echo $display;
}

function atBlockOpen()
{
    $runningconfig = atGetRunningConfig();

    if (!isset($runningconfig['extra'])) {
        return;
    }
    $extra = $runningconfig['extra'];

	foreach ($extra as $name) {
		if (isset($name['blockpreprocess'])) {
			$blockprefuncs[] = $name['blockpreprocess'];
		}
		if (isset($name['blockopen'])) {
            $func = $name['blockopen'];
            if (function_exists("$func")) {
            	$func($runningconfig);
            }
        }
    }
    if (isset($blockprefuncs)) {
    	atBlockPreProcess($blockprefuncs);
    }
}

function atBlockPreProcess($funcs)
{
    $display = ob_get_contents();
    ob_end_clean();
    ob_start();

	foreach ($funcs as $func) {
		if (function_exists("$func")) {
            $display = $func($display);
        }
    }
    echo $display;
}

function atBlockClose()
{
    $runningconfig = atGetRunningConfig();

    if (!isset($runningconfig['extra'])) {
        return;
    }
    $extra = $runningconfig['extra'];

	foreach ($extra as $name) {
		if (isset($name['blockpostprocess'])) {
			$blockpostfuncs[] = $name['blockpostprocess'];
		}
		if (isset($name['blockclose'])) {
            $func = $name['blockclose'];
            if (function_exists("$func")) {
            	$func($runningconfig);
            }
        }
    }
    if (isset($blockpostfuncs)) {
    	atBlockPostProcess($blockpostfuncs);
    }
}

function atBlockPostProcess($funcs)
{
    $display = ob_get_contents();
    ob_end_clean();
    ob_start();

	foreach ($funcs as $func) {
		if (function_exists("$func")) {
            $display = $func($display);
        }
    }
    echo $display;
}

function atThemeClose($postprocess=TRUE)
{
    $runningconfig = atGetRunningConfig();
    extract($runningconfig);

    if (!isset($runningconfig['extra'])) {
        return;
    }
    $extra = $runningconfig['extra'];

    foreach ($extra as $name) {
		if ($postprocess && isset($name['themepostprocess'])) {
			$themepostfuncs[] = $name['themepostprocess'];
		}
		if (isset($name['themeclose'])) {
            $func = $name['themeclose'];
            if (function_exists("$func")) {
            	$func($runningconfig);
            }
        }
    }
    if (isset($themepostfuncs)) {
    	atThemePostProcess($themepostfuncs);
    }
}

function atThemePostProcess($funcs)
{
	$display = ob_get_contents();
    ob_end_clean();
    ob_start();

    foreach ($funcs as $func) {
		if (function_exists("$func")) {
            $display = $func($display);
        }
    }
    echo $display;
}

function atErrorCheck()
{
	if (defined('AUTOTHEME_DEBUG_ENABLED') && AUTOTHEME_DEBUG_ENABLED === TRUE) {
	    error_reporting(E_ALL ^ E_NOTICE);
		ini_set('display_errors', "1");
		return TRUE;
	}
	else {
		error_reporting(0);
		ini_set('display_errors', "0");
        return FALSE;
	}
}

function atBufferControl($action='check')
{
/*
	$display = ob_get_contents();

	switch ($action) {
		case 'start':
			ob_start();
			echo "<!-- [#AUTOTHEME_BUFFER#] -->";
		break;

		case 'check':
		default:
			if (strpos($display, "#AUTOTHEME_BUFFER#") === FALSE) {
				ob_end_flush();
			}
		break;
	}
*/
}

function atThemeHeader()
{
	atErrorCheck();

	atThemeOpen();
	atBodyOpen();

    $runningconfig = atGetRunningConfig();
    extract($runningconfig);

    $file = $template['main'];

    $template = atTemplateCompile($themepath.$file, $striphead);
    list($output, $footer) = atTemplateSplit($template, "modules");

    atTemplateDisplay($output);

    atModOpen();
}

function atThemeFooter()
{
	atErrorCheck();

	atModClose();

    $runningconfig = atGetRunningConfig();
    extract($runningconfig);

    $file = $template['main'];

    $template = atTemplateCompile($themepath.$file, 1);
    list($header, $output) = atTemplateSplit($template, "modules");

    atTemplateDisplay($output);

    atThemeAddFooter();
	atThemeClose();
	atThemeExit();
}

function atNewsSummary($text, $url, $html)
{
    foreach ($text as $name => $val) {
        $news["text:$name"] = $val;
    }
    foreach ($url as $name => $val) {
        $news["url:$name"] = $val;
    }
    foreach ($html as $name => $val) {
        $news["html:$name"] = $val;
    }
    atCommandBuild($news, "news");

    $runningconfig = atGetRunningConfig();
    extract($runningconfig);

    if (!isset($summary_count)) {
        static $summary_count = "";
    }
    $summary_count ++;

    if ($template['altsummary'] && $template['summary1'] && $template['summary2']) {
        if ($summary_count % 2 == 0) {
            $file = $template['summary1'];
        }
        else {
            $file = $template['summary2'];
        }
    }
    else {
        $file = $template['summary'];
    }
    $output = atTemplateCompile($themepath.$file);

    atTemplateDisplay($output);
}

function atNewsArticle($text, $url, $html)
{
    foreach ($text as $name => $val) {
        $news["text:$name"] = $val;
    }
    foreach ($url as $name => $val) {
        $news["url:$name"] = $val;
    }
    foreach ($html as $name => $val) {
        $news["html:$name"] = $val;
    }
    atCommandBuild($news, "news");

    $runningconfig = atGetRunningConfig();
    extract($runningconfig);

    $file = $template['article'];

    $output = atTemplateCompile($themepath.$file);

    atTemplateDisplay($output);
}

function atThemeBlock($block)
{
    atCommandBuild($block, "block");
	atBlockOpen();

    $runningconfig = atGetRunningConfig();
    extract($runningconfig);

    $location = $block['position'];
    $blocktitle = trim(strip_tags($block['title'], ""));
    $blockname = $block['name'];

    if ($block['modname'] == "Admin_Messages" && $block['bkey'] == "messages") {
    	$blocktitle = "Administration Messages";
    }

    switch ($location) {
		case 'l':
            $file = $template['leftblock'];
            break;

        case 'r':
            $file = $template['rightblock'];
            break;

        case 'c':
            $file = $template['centerblock'];
            break;

        default:
            if (isset($autoblock[$location])) {
        	   $file = $template["autoblock".$location];
            }
            break;
    }
    if (isset($blocktemplate[$blocktitle])) {
		$file = $blocktemplate[$blocktitle];
    }
    elseif (isset($blocktemplate[$blockname])) {
		$file = $blocktemplate[$blockname];
    }
    $output = atTemplateCompile($themepath.$file);

    atTemplateDisplay($output);

    atBlockClose();
}

function atBlockDisplay($location="", $title="")
{
    $runningconfig = atGetRunningConfig();
    extract($runningconfig);

    $display = 0;

    if ($location) {
        switch ($location) {
            case 'l':
                if ($blockdisplay['left']) {
                    $display = 1;
                }
                break;

            case 'r':
                if ($blockdisplay['right']) {
        	       $display = 1;
                }
                break;

            case 'c':
                if ($blockdisplay['center']) {
                    $display = 1;
                }
                break;

            case 'd':
                if ($blockdisplay['center']) {
                    $display = 1;
                }
                break;

            default:
                if (isset($autoblock[$location]) && $blockdisplay["autoblock".$location]) {
                    $display = 1;
                }
                break;
        }
        if ($display) {
            atBlockLoad($location);
        }
    }
    elseif ($title) {
        atBlockLoad("", $title);
    }
}

function atLoadExtraCommands($dir)
{
    $atdir = atAutoGetVar("atdir");
    $platform = atGetPlatform();
    $lang = atGetLang();

    if ($handle = @opendir($dir)) {
        while (false !== ($file = @readdir($handle))) {
            if (eregi(".cmd.php", $file)) {
                $extracmd = array();

                $parts = explode(".", $file);
                $name = $parts[0];
                @include_secure($atdir."lang/$lang/$name.php");
                include_secure($dir.$file);

                foreach ($extracmd as $type => $cmds) {
                    foreach ($cmds as $cmd => $action) {
                        $cmdresult[$type][$cmd] = $extracmd[$type][$cmd];
                    }
                }
            }
        }
        closedir($handle);
    }
    if ($handle = @opendir($dir.$platform)) {
        while (false !== ($file = @readdir($handle))) {
            if (eregi(".cmd.php", $file)) {
                $extracmd = array();

                $parts = explode(".", $file);
                $name = $parts[0];
                @include_secure($atdir."lang/$lang/$name.php");
                @include_secure($dir.$platform."/$file");

                foreach ($extracmd as $type => $cmds) {
                    foreach ($cmds as $cmd => $action) {
                        $cmdresult[$type][$cmd] = $extracmd[$type][$cmd];
                    }
                }
            }
        }
        closedir($handle);
    }
    return $cmdresult;
}

function atExtraScan($dir)
{
    $extra = atRunningGetVar("extra");
    $atdir = atAutoGetVar("atdir");
    $platform = atGetPlatform();
    $lang = atGetLang();

    if ($handle = @opendir($dir.$platform)) {
        while (false !== ($file = @readdir($handle))) {
            if (eregi(".ext.php", $file)) {
                $parts = explode(".", $file);
                $name = $parts[0];
                $loaded[$name] = 1;
                @include_secure($atdir."lang/$lang/$name.php");
                @include_secure($dir.$platform."/$file");
            }
        }
        closedir($handle);
    }
    if ($handle = @opendir($dir)) {
        while (false !== ($file = @readdir($handle))) {
            if (eregi(".ext.php", $file)) {
                $parts = explode(".", $file);
                $name = $parts[0];
                if (!$loaded[$name]) {
                    @include_secure($atdir."lang/$lang/$name.php");
                    @include_secure($dir.$file);
                }
            }
        }
        closedir($handle);
    }
    atAutoSetVar("extra", $extra);

    return $extra;
}

function atExtraLoadAll()
{
    $globalconfig = atGetGlobalConfig();
    extract($globalconfig);

    $result = array();
    $lang = atGetLang();

    foreach ($autoextra as $name => $val) {
        if ($val) {
            $extra = atExtraLoad($name);
            array_push($result, $extra);
        }
    }
    return $result;
}

function atExtraLoad($name)
{
    $globalconfig = atGetGlobalConfig();
    extract($globalconfig);

    $extra = atRunningGetVar("extra");
    $platform = atGetPlatform();
    $lang = atGetLang();

    if (@file_exists($atdir."lang/$lang/$name.php")) {
        @include_secure($atdir."lang/$lang/$name.php");
    }
    else {
        @include_secure($atdir."lang/eng/$name.php");
    }
    if (@file_exists($extradir.$platform."/$name.ext.php")) {
        @include_secure($extradir.$platform."/$name.ext.php");
    }
    else {
        @include_secure($extradir."$name.ext.php");
    }
    atRunningSetVar("extra", $extra);

    return $extra[$name];
}

/* compile functions */
function atCompileRead($filename, $modifier="")
{
    $globalconfig = atGetGlobalConfig();
    extract($globalconfig);

    $oldmask = umask(0);

    $filetime =  @filemtime($incdir."atCommands.php")
				+@filemtime($platformdir."atCommands.php")
               	+@filemtime($atdir."autotheme.cfg")
               	+@filemtime($themepath."theme.cfg")
               	+@filemtime($filename);

    $filepre = atGetCompileFilename($filename, $modifier);
    $filename = $filepre."_".$filetime;

    if ($output = atTemplateRead($compiledir.$filename)) {
    	return $output;
    }
    else {
        return false;
    }
}

function atCompileWrite($filename, $content, $modifier="")
{
    $globalconfig = atGetGlobalConfig();
    extract($globalconfig);

    $oldmask = umask(0);

    $filetime =  @filemtime($incdir."atCommands.php")
				+@filemtime($platformdir."atCommands.php")
               	+@filemtime($atdir."autotheme.cfg")
               	+@filemtime($themepath."theme.cfg")
               	+@filemtime($filename);

    $filepre = atGetCompileFilename($filename, $modifier);
    $filename = $filepre."_".$filetime;

    if ($handle = @opendir($compiledir)) {
       while (false !== ($file = @readdir($handle))) {
            if (false !== strpos($file, $filepre)) {
                @unlink($compiledir.$file);

                if (function_exists('atcacheclear')) {
    				atCacheClear();
    			}
                break;
            }
        }
        closedir($handle);
    }
    if ($handle = @fopen($compiledir.$filename, "w")) {
        fwrite($handle, $content);
	    fclose($handle);
    }
}

function atCompileClear()
{
	$compiledir = atAutoGetVar('compiledir');

    if ($handle = @opendir($compiledir)) {
            while (false !== ($file = @readdir($handle))) {
                @unlink($compiledir.$file);
            }
            closedir($handle);
    }
    if (function_exists('atcacheclear')) {
    	atCacheClear();
    }
}

function atGetCompileFilename($filename, $modifier="")
{
	$thename = atRunningGetVar('thename');

	if (atIsLoggedIn()) {
        $user = 1;
    }
    else {
        $user = 0;
    }
    if (atIsAdminUser()) {
        $admin = 1;
    }
    else {
        $admin = 0;
    }
    $temp = $user.$admin.$thename.$filename.$modifier;
	$filepre = md5($temp);

	return $filepre;
}

function atTemplateCompile($file, $striphead=1)
{
    $globalconfig = atGetGlobalConfig();
    extract($globalconfig);

    if (!$output = atCompileRead($file)) {
            $HTML = atTemplatePrep($file, $striphead);
            $output = atCommandReplace($HTML, $command);
            atCompileWrite($file, $output);
    }
    return $output;
}

/**********************************/
/* Utility functions              */
/**********************************/
function at_block_sort($a, $b)
{
	if ($a['position'] == $b['position']) {
		//return strcmp($a['weight'], $b['weight']);
		return ($a["weight"] > $b["weight"]) ? TRUE : FALSE;
	}
	else {
	    return strcmp($a["position"], $b["position"]);
	}
}

function at_array_display($var)
{
    foreach ($var as $k => $v) {
        if (is_array($v)) {
            echo $k;
            at_array_display($v);
            continue;
        }
        echo "<pre>". htmlentities("$k = $v") ."</pre>";
    }
}

/**********************************/
/* Compatibility functions        */
/**********************************/
if (!function_exists("file_get_contents")) {
    function file_get_contents($filename)
    {
        if (@is_file($filename)) {
            $result = "";
            $handle = @fopen($filename, "r");
            if (!$handle) {
                return false;
            }
            while (!feof($handle)) {
                $result .= fread($handle, 4096);
            }
            return $result;
        }
        else {
            return false;
        }
    }
}

if (!function_exists("var_export")) {
    function var_export($var)
    {
        $result = "";

        switch (gettype($var)) {
            case "array":
                reset($var);
                $result = "array(\n";
                foreach ($var as $k => $v) {
                    $result .= "  " . var_export($k)." => " . var_export($v).",\n";
                }
                $result .= ")";
                break;

            case "string":
                $result = "'$var'";
                break;

            case "boolean":
                $result = ($var) ? "true" : "false";
                break;

            default:
                if (empty($var)) {
                    $result = "''";
                }
                else {
                    $result = $var;
                }
                break;
        }
        return $result;
    }
}

/**********************************/
/* Administration functions       */
/**********************************/
function at_list_themes($dir="themes")
{
    $themelist = at_listcore_themes($dir);

    if ($multibase = at_getmultisite_base()) {
        $multilist = at_listmultisite_themes($multibase);
        $themelist = array_merge((array)$themelist, (array)$multilist);
    }
    return $themelist;
}

function at_listcore_themes($dir="themes")
{
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
    return $themelist;
}

function at_listmultisite_themes($dir="parameters")
{
    $themelist = array();

    if ($handle = @opendir($dir)) {
        while (false !== ($subdir = @readdir($handle))) {
            if (@is_dir("$dir/$subdir/themes") &&
                $subdir !== '.' &&
                $subdir !== '..')
            {
                $multilist[$subdir] = at_listcore_themes("$dir/$subdir/themes");
            }
        }
        closedir($handle);
    }
    foreach ($multilist as $multidir => $list) {
        foreach ($list as $themedir) {
            $themelist[] = "$dir/$multidir/themes/$themedir";
        }
    }
    return $themelist;
}

function at_getmultisite_base()
{
    if (defined('WHERE_IS_PERSO')) {
        $pathparts = explode("/", WHERE_IS_PERSO);
        array_pop($pathparts);
        array_pop($pathparts);
        $multibase = implode("/", $pathparts);

        return $multibase;
    }
    else {
        return false;
    }
}

function at_getmultisite_name($path)
{
    $pathparts = explode("/", $path);

    if ($pathparts) {
        $multisite = $pathparts[count($pathparts)- 3];
        return $multisite;
    }
    else {
        return false;
    }
}

function at_gettheme_name($path)
{
    $pathparts = explode("/", $path);
    $themename = array_pop($pathparts);

    return $themename;
}

function at_gettheme_path($themedir)
{
    if (@file_exists(AT_DIRPREFIX."themes/$themedir")) {
        $thepath = AT_DIRPREFIX."themes/$themedir/";
    }
    elseif (@file_exists(AT_DIRPREFIX."$themedir")) {
        $thepath = AT_DIRPREFIX."$themedir/";
    }
    return $thepath;
}

function at_listfiles($dir, $ext)
{
    $filelist = $newlist = array();

    if ($handle = @opendir($dir)) {
        while (false !== ($item = @readdir($handle))) {
            if (@!is_dir($dir . $item) && eregi(".$ext", $item)) {
                $filelist[] = $item;
            }
            elseif (@is_dir("$dir/$item") && $item !== '.' && $item !== '..') {
                $sublist = at_listfiles("$dir/$item", $ext);
                if (is_array($sublist)) {
                    foreach ($sublist as $file) {
                        $newlist[] = "$item/$file";
                    }
                }
            }
        }
        closedir($handle);

        $filelist = array_merge((array)$filelist, (array)$newlist);

        return $filelist;
    }
    else {
        return false;
    }
}

function at_file_select($themedir, $name, $val, $filelist, $create=1, $link=1)
{
	$output = "<td><select name=\"$name\">\n";
    $output .= "<option></option>\n";

    foreach ($filelist as $file) {
        $sel = "";
        if ($file == $val) { $sel = " selected"; }
        $output .= "<option$sel>$file</option>\n";
    }
    $output .= "</select>\n";

    if ($link) {
        $output .= at_edit_link($themedir, $val, $create);
    }
    $output .= "</td>\n";

    return $output;
}

function at_display_error($message)
{
    atAdminHeader();
    echo $message;
    atAdminFooter();
    die();
}

function at_inputfield($opt)
{
	$input .= "<input";

	unset($opt['label']);

	foreach ($opt as $k => $v) {
		$input .= " $k=\"$v\"";
	}
	$input .= ">";

	return $input;
}

function atGetBlockConfig($blockcontrol=null)
{
    if (!$blockcontrol) {
    	$blockcontrol = atRunningGetVar('blockcontrol');
    }
    $blocks = atGetBlocks();

    if (is_array($blockcontrol)) {
    	foreach ($blocks as $title => $block) {
    		if (isset($blockcontrol[$title])) {
    			$blocklist[$title] = array_merge((array)$block, (array)$blockcontrol[$title]);
    		}
    		else {
    			$blocklist[$title] = $block;
    		}
    	}
    }
    else {
    	$blocklist = $blocks;
    }
    uasort($blocklist, 'at_block_sort');

    return $blocklist;
}

/**********************************/
/* Module functions               */
/**********************************/

function atImageSearch($path, $module=null)
{
	$runningconfig = atGetRunningConfig();
	extract($runningconfig);

	$path = explode(".", $path);

	$types = array("jpg", "gif", "png");

	if (isset($module)) {
		$paths[] = $imagepath."modules/$module/".$path[0];
	}
	$paths = array(
		$imagelangpath.$path[0],
		$imagepath.$path[0],
		$atpath."images/".$path[0]
	);

	foreach ($types as $type) {
		foreach ($paths as $file) {
			echo "$file.$type<br>";
			if (file_exists("$file.$type")) {
				return "$file.$type";
			}
		}
	}
	return FALSE;
}

/* BETA (don't use) function to get output from pnHTML and build command from it */
function atModCommand($command, &$output)
{
    $$command = $output->GetOutput();

    atCommandBuild(compact("$command"));
}

/* BETA (don't use) function to build commands from module */
function atCommandBuild2($name, $commands, $prefix="")
{
    if (!$prefix) {
        $prefix = strtolower(atGetModName());
    }
    $$name = $commands;
    $commands = compact("$name");

    atRunningSetVar($prefix, $commands);

    foreach ($commands as $key => $val) {
        foreach ($val as $num => $cmd) {
            foreach($cmd as $cname => $action) {
            atCommandAdd("$prefix:$key:$cname", 'echo $'.$prefix.'["'.$key.'"][$i]["'.$cname.'"];');
            }
        }
    }
}

/* BETA (don't use) function to return module template output */
function atModOutput($file)
{
    $globalconfig = atGetGlobalConfig();
    extract($globalconfig);

    $modname = atGetModName();

    if (file_exists($themepath."modules/$modname/$file")) {
        $file = $themepath."modules/$modname/$file";
    }
    elseif (file_exists("modules/$modname/templates/$file")) {
        $file = "modules/$modname/templates/$file";
    }
    else {
        return false;
    }
    $output = atTemplateCompile($file);

    ob_start();
    atTemplateDisplay($output);
    $display = ob_get_contents();
    ob_end_clean();

    return $display;
}

/* BETA (don't use) function to add an array and a function that loops through the array and displays a template */
function atCommandLoopAdd($function, $array)
{
    /* maybe need to add commandadd for array and func
    maybe not use this, use command add and template display or combination, why dedicated func? */
    $globalconfig = atGetGlobalConfig();
    extract($globalconfig);

    eval('function '.$function.'(\$array, \$file)
    {
        $globalconfig = atGetGlobalConfig();
        extract($globalconfig);

        $modname = atGetModName();

        if (file_exists($themepath."modules/$modname/$file")) {
           $file = $themepath."modules/$modname/$file";
           }
        elseif (file_exists("modules/$modname/templates/$file")) {
           $file = "modules/$modname/templates/$file";
        }
        else {
           return false;
        }
        $output = atTemplateCompile($file);
        atTemplateDisplay($output);
    }');
}

?>
