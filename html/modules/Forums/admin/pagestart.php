<?php

/***************************************************************************
 *                               pagestart.php
 *                            -------------------
 *   begin                : Thursday, Aug 2, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: pagestart.php,v 1.1.2.10 2006/01/22 17:11:09 grahamje Exp $
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
        die("Hacking attempt");
}

define('IN_ADMIN', true);
define('FORUM_ADMIN', true);
define("PHPBB_ROOT_PATH", $phpbb_root_path);
define("PHPBB_PHPEX", $phpEx);
include("../../../mainfile.php");
$phpbb_root_path = PHPBB_ROOT_PATH;
$phpEx = PHPBB_PHPEX;
include($phpbb_root_path.'common.'.$phpEx);
//
// Do a check to see if the nuke user is still valid.
//

global $admin, $prefix, $db, $cookie, $nukeuser, $user;
$admin = base64_decode($admin);
$admin = explode(":", $admin);
$aid = "$admin[0]";
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Forums'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, pwd, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
    if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
        $auth_user = 1;	
    }
}

$user = addslashes(base64_decode($user));
$cookie = explode(":", $user);
$sql3 = "SELECT user_id, user_password, user_level FROM " . USERS_TABLE . "
        WHERE username='$cookie[1]'";
$result3 = $db->sql_query($sql3);
if(!$result3) {
    message_die(GENERAL_ERROR, 'Could not query user account', '', __LINE__, __FILE__, $sql);
}
$row3 = $db->sql_fetchrow($result3);
if ((is_admin($admin)) AND ($admin[1] == $row2['pwd'] && !empty($row2['pwd'])) AND ($row2['radminsuper'] == 1 or $auth_user == 1)) {
} elseif ((is_user($user)) AND ($cookie[2] == $row3['user_password'] && $row3['user_password'] != "") AND ($row3['user_level'] == 2)) {
    $nukeuser = $user;
} else {
    unset($user);
    unset($cookie);
    message_die(GENERAL_MESSAGE, "You are not authorised to administer this board");
}

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX, $nukeuser);
init_userprefs($userdata);
//
// End session management
//
/*
if( !$userdata['session_logged_in'] )
{
	redirect(append_sid("login.$phpEx?redirect=admin/index.$phpEx", true));
}
else if( $userdata['user_level'] != ADMIN )
{
        message_die(GENERAL_MESSAGE, $lang['Not_admin']);
}

if ($HTTP_GET_VARS['sid'] != $userdata['session_id'])
{
	redirect("index.$phpEx?sid=" . $userdata['session_id']);
}

if (!$userdata['session_admin'])
{
	redirect(append_sid("login.$phpEx?redirect=admin/index.$phpEx&admin=1", true));
}
*/
if ( empty($no_page_header) )
{
        // Not including the pageheader can be neccesarry if META tags are
        // needed in the calling script.
        include('./page_header_admin.'.$phpEx);
}

?>