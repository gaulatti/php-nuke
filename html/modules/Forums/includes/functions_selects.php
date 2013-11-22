<?php
/***************************************************************************
 *                            function_selects.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: functions_selects.php,v 1.3.2.4 2002/12/22 12:20:35 psotfx Exp
 *
 *
 ***************************************************************************/
/***************************************************************************
* phpbb2 forums port version 2.0.5 (c) 2003 - Nuke Cops (http://nukecops.com)
*
* Ported by Nuke Cops to phpbb2 standalone 2.0.5 Test
* and debugging completed by the Elite Nukers and site members.
*
* You run this package at your sole risk. Nuke Cops and affiliates cannot
* be held liable if anything goes wrong. You are advised to test this
* package on a development system. Backup everything before implementing
* in a production environment. If something goes wrong, you can always
* backout and restore your backups.
*
* Installing and running this also means you agree to the terms of the AUP
* found at Nuke Cops.
*
* This is version 2.0.5 of the phpbb2 forum port for PHP-Nuke. Work is based
* on Tom Nitzschner's forum port version 2.0.6. Tom's 2.0.6 port was based
* on the phpbb2 standalone version 2.0.3. Our version 2.0.5 from Nuke Cops is
* now reflecting phpbb2 standalone 2.0.5 that fixes some bugs and the
* invalid_session error message.
***************************************************************************/
/***************************************************************************
 *   This file is part of the phpBB2 port to Nuke 6.0 (c) copyright 2002
 *   by Tom Nitzschner (tom@toms-home.com)
 *   http://bbtonuke.sourceforge.net (or http://www.toms-home.com)
 *
 *   As always, make a backup before messing with anything. All code
 *   release by me is considered sample code only. It may be fully
 *   functual, but you use it at your own risk, if you break it,
 *   you get to fix it too. No waranty is given or implied.
 *
 *   Please post all questions/request about this port on http://bbtonuke.sourceforge.net first,
 *   then on my site. All original header code and copyright messages will be maintained
 *   to give credit where credit is due. If you modify this, the only requirement is
 *   that you also maintain all original copyright messages. All my work is released
 *   under the GNU GENERAL PUBLIC LICENSE. Please see the README for more information.
 *
 ***************************************************************************/
/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

//
// Pick a language, any language ...
//

if (!defined('IN_PHPBB')) {
	die();
}

function language_select($default, $select_name = "language", $dirname="modules/Forums/language")
{
        global $phpEx;

        $dir = @opendir($dirname);

        $lang = array();
        while ( $file = @readdir($dir) )
        {
                if ( ereg("^lang_", $file) && !is_file($dirname . "/" . $file) && !is_link($dirname . "/" . $file) )
                {
                        $filename = trim(str_replace("lang_", "", $file));
                        $displayname = preg_replace("/^(.*?)_(.*)$/", "\\1 [ \\2 ]", $filename);
                        $displayname = preg_replace("/\[(.*?)_(.*)\]/", "[ \\1 - \\2 ]", $displayname);
                        $lang[$displayname] = $filename;
                }
        }

        @closedir($dir);

        @asort($lang);
        @reset($lang);

        $lang_select = '<select name="' . $select_name . '">';
        while ( list($displayname, $filename) = @each($lang) )
        {
                $selected = ( strtolower($default) == strtolower($filename) ) ? ' selected="selected"' : '';
                $lang_select .= '<option value="' . $filename . '"' . $selected . '>' . ucwords($displayname) . '</option>';
        }
        $lang_select .= '</select>';

        return $lang_select;
}

//
// Pick a template/theme combo,
//
function style_select($default_style, $select_name = "style", $dirname = "templates")
{
        global $db;

        $sql = "SELECT themes_id, style_name
                FROM " . THEMES_TABLE . "
                ORDER BY template_name, themes_id";
        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, "Couldn't query themes table", "", __LINE__, __FILE__, $sql);
        }

        $style_select = '<select name="' . $select_name . '">';
        while ( $row = $db->sql_fetchrow($result) )
        {
                $selected = ( $row['themes_id'] == $default_style ) ? ' selected="selected"' : '';

                $style_select .= '<option value="' . $row['themes_id'] . '"' . $selected . '>' . $row['style_name'] . '</option>';
        }
        $style_select .= "</select>";

        return $style_select;
}

//
// Pick a timezone
//
function tz_select($default, $select_name = 'timezone')
{
        global $sys_timezone, $lang;

        if ( !isset($default) )
        {
                $default == $sys_timezone;
        }
        $tz_select = '<select name="' . $select_name . '">';

        while( list($offset, $zone) = @each($lang['tz']) )
        {
                $selected = ( $offset == $default ) ? ' selected="selected"' : '';
                $tz_select .= '<option value="' . $offset . '"' . $selected . '>' . $zone . '</option>';
        }
        $tz_select .= '</select>';

        return $tz_select;
}

?>