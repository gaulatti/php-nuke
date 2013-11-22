<?php
/***************************************************************************
 *                            functions_admin.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: functions_admin.php,v 1.5.2.3 2002/07/19 17:03:47 psotfx Exp
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
// Simple version of jumpbox, just lists authed forums
//

if (!defined('IN_PHPBB')) {
	die();
}

function make_forum_select($box_name, $ignore_forum = false, $select_forum = '')
{
        global $db, $userdata;

        $is_auth_ary = auth(AUTH_READ, AUTH_LIST_ALL, $userdata);

        $sql = "SELECT forum_id, forum_name
                FROM " . FORUMS_TABLE . "
                ORDER BY cat_id, forum_order";
        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Couldn not obtain forums information', '', __LINE__, __FILE__, $sql);
        }

        $forum_list = '';
        while( $row = $db->sql_fetchrow($result) )
        {
                if ( $is_auth_ary[$row['forum_id']]['auth_read'] && $ignore_forum != $row['forum_id'] )
                {
                        $selected = ( $select_forum == $row['forum_id'] ) ? ' selected="selected"' : '';
                        $forum_list .= '<option value="' . $row['forum_id'] . '"' . $selected .'>' . $row['forum_name'] . '</option>';
                }
        }

        $forum_list = ( $forum_list == '' ) ? '<option value="-1">-- ! No Forums ! --</option>' : '<select name="' . $box_name . '">' . $forum_list . '</select>';

        return $forum_list;
}

//
// Synchronise functions for forums/topics
//
function sync($type, $id = false)
{
        global $db;

        switch($type)
        {
                case 'all forums':
                        $sql = "SELECT forum_id
                                FROM " . FORUMS_TABLE;
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not get forum IDs', '', __LINE__, __FILE__, $sql);
                        }

                        while( $row = $db->sql_fetchrow($result) )
                        {
                                sync('forum', $row['forum_id']);
                        }
                           break;

                case 'all topics':
                        $sql = "SELECT topic_id
                                FROM " . TOPICS_TABLE;
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not get topic ID', '', __LINE__, __FILE__, $sql);
                        }

                        while( $row = $db->sql_fetchrow($result) )
                        {
                                sync('topic', $row['topic_id']);
                        }
                        break;

                  case 'forum':
                        $sql = "SELECT MAX(post_id) AS last_post, COUNT(post_id) AS total
                                FROM " . POSTS_TABLE . "
                                WHERE forum_id = '$id'";
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not get post ID', '', __LINE__, __FILE__, $sql);
                        }

                        if ( $row = $db->sql_fetchrow($result) )
                        {
                                $last_post = ( $row['last_post'] ) ? $row['last_post'] : 0;
                                $total_posts = ($row['total']) ? $row['total'] : 0;
                        }
                        else
                        {
                                $last_post = 0;
                                $total_posts = 0;
                        }

                        $sql = "SELECT COUNT(topic_id) AS total
                                FROM " . TOPICS_TABLE . "
                                WHERE forum_id = '$id'";
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not get topic count', '', __LINE__, __FILE__, $sql);
                        }

                        $total_topics = ( $row = $db->sql_fetchrow($result) ) ? ( ( $row['total'] ) ? $row['total'] : 0 ) : 0;

                        $sql = "UPDATE " . FORUMS_TABLE . "
                                SET forum_last_post_id = '$last_post', forum_posts = '$total_posts', forum_topics = '$total_topics'
                                WHERE forum_id = '$id'";
                        if ( !$db->sql_query($sql) )
                        {
                                message_die(GENERAL_ERROR, 'Could not update forum', '', __LINE__, __FILE__, $sql);
                        }
                        break;

                case 'topic':
                        $sql = "SELECT MAX(post_id) AS last_post, MIN(post_id) AS first_post, COUNT(post_id) AS total_posts
                                FROM " . POSTS_TABLE . "
                                WHERE topic_id = '$id'";
                        if ( !($result = $db->sql_query($sql)) )
                        {
                                message_die(GENERAL_ERROR, 'Could not get post ID', '', __LINE__, __FILE__, $sql);
                        }

                        if ( $row = $db->sql_fetchrow($result) )
                        {
                                $sql = ( $row['total_posts'] ) ? "UPDATE " . TOPICS_TABLE . " SET topic_replies = " . ( $row['total_posts'] - 1 ) . ", topic_first_post_id = " . $row['first_post'] . ", topic_last_post_id = " . $row['last_post'] . " WHERE topic_id = '$id'" : "DELETE FROM " . TOPICS_TABLE . " WHERE topic_id = '$id'";
                                if ( !$db->sql_query($sql) )
                                {
                                        message_die(GENERAL_ERROR, 'Could not update topic', '', __LINE__, __FILE__, $sql);
                                }
                        }
                        break;
        }

        return true;
}

?>