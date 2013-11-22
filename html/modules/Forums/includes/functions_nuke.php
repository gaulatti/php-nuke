<?php
/***************************************************************************
 *                            functions_nuke.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2002 Tom Nitzschner
 *   email                : tom@toms-home.com
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

if (!defined('IN_PHPBB')) {
	die();
}
 
function nuke_sql($query)
{
//echo "before = $query<br>";
        $nuke_sql = str_replace(" username", " username", $query);
        if (ereg ('privmsgs_text', $nuke_sql)){
            $nuke_sql = str_replace("uname_", "username_", $query);
        }
        $nuke_sql = str_replace("u.username", "u.username", $nuke_sql);
        $nuke_sql = str_replace("u2.username", "u2.username", $nuke_sql);
        $nuke_sql = str_replace("user_password", "user_password", $nuke_sql);
        $nuke_sql = str_replace("user_website", "user_website", $nuke_sql);
        if ((stristr($nuke_sql, "user_email,")) || (stristr($nuke_sql, "user_email "))){
            $nuke_sql = str_replace("user_email", "user_email", $nuke_sql);
        }
        $nuke_sql = str_replace("user_interests", "user_intrest", $nuke_sql);
        if (stristr($nuke_sql,"topics_watch") || (stristr($nuke_sql,"user_group"))){
        } else {
            $nuke_sql = str_replace(" user_id", " user_id", $nuke_sql);
        }
        $nuke_sql = str_replace("uid_", "user_id_", $nuke_sql);
        $nuke_sql = str_replace("\(user_id", "\(user_id", $nuke_sql);
        $nuke_sql = str_replace("u.user_id", "u.user_id", $nuke_sql);
        $nuke_sql = str_replace("u2.user_id", "u2.user_id", $nuke_sql);
//echo "after  = $nuke_sql<br><br>";

    return $nuke_sql;
}

?>