<?php

/************************************************************************/
/* Journal &#167 ZX                                                     */
/* ================                                                     */
/*                                                                      */
/* Original work done by Joseph Howard known as Member's Journal, which */
/* was based on Trevor Scott's vision of Atomic Journal.                */
/*                                                                      */
/* Modified on 25 May 2002 by Paul Laudanski (paul@computercops.biz)    */
/* Copyright (c) 2002 Modifications by Computer Cops.                   */
/* http://computercops.biz                                              */
/*                                                                      */
/* Member's Journal did not work on a PHPNuke 5.5 portal which had      */
/* phpbb2 port integrated.  Thus was Journal &#167 ZX created with the  */
/* Member's Journal author's blessings.                                 */
/*                                                                      */
/* To install, backup everything first and then FTP the Journal package */
/* files into your site's module directory.  Also run the tables.sql    */
/* script so the proper tables and fields can be created and used.  The */
/* default table prefix is "nuke" which is hard-coded throughout the    */
/* entire system as a left-over from Member's Journal.  If a demand     */
/* exists, that can be changed for a future release.                    */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
    /* Journal 2.0 Enhanced and Debugged 2004                               */
    /* by sixonetonoffun -- http://www.netflake.com --                      */
    /* Images Created by GanjaUK -- http://www.GanjaUK.com                  */
    /************************************************************************/
if ( !defined('MODULE_FILE') )
{
	die("You can't access this file directly...");
}
    require_once("mainfile.php");
    $module_name = basename(dirname(__FILE__));
    get_lang($module_name);
    $pagetitle = "- "._USERSJOURNAL."";
    include("header.php");
    include("modules/$module_name/functions.php");
    if (is_user($user)) {
        cookiedecode($user);
        $username = $cookie[1];
        $username = filter($username, "nohtml");
    }
    $user = filter($user, "nohtml");
    $sitename = filter($sitename, "nohtml");
    startjournal($sitename, $user);
    function last20($bgcolor1, $bgcolor2, $bgcolor3, $username) {
        global $prefix, $user_prefix, $db, $module_name;
        OpenTable();
        echo ("<div align=\"center\" class=title>"._20ACTIVE."</div><br>");
        echo ("<table align=center border=1 cellpadding=0 cellspacing=0>");
        echo ("<tr>");
        echo ("<td bgcolor=$bgcolor1 width=150>&nbsp;<strong>"._MEMBER."</strong> "._CLICKTOVIEW."</td>");
        echo ("<td bgcolor=$bgcolor1 width=70 align=center><strong>"._VIEWJOURNAL."</strong></td>");
        echo ("<td bgcolor=$bgcolor1 width=70 align=center><strong>"._MEMBERPROFILE."</strong></td>");
        if (empty($username)) {
            echo "<td bgcolor=$bgcolor1 width=70 align=center><strong>"._CREATEACCOUNT2."</strong></td>";
        } else {
            if (is_active("Private_Messages")) {
                echo "<td bgcolor=$bgcolor1 width=70 align=center><strong>"._PRIVMSGJ."</strong></td>";
            }
        }
        echo "</tr>";
	$sql = "SELECT j.id, j.joid, j.nop, j.ldp, j.ltp, j.micro, u.user_id, u.username FROM ".$prefix."_journal_stats j, ".$user_prefix."_users u where u.username=j.joid ORDER BY 'ldp' DESC";
        $result = $db->sql_query($sql);
        $dcount = 1;
        while ($row = $db->sql_fetchrow($result)) {
            $row['id'] = intval($row['id']);
            $row['joid'] = filter($row['joid'], "nohtml");
            $row['nop'] = filter($row['nop'], "nohtml");
            $row['ldp'] = filter($row['ldp'], "nohtml");
            $row['ltp'] = filter($row['ltp'], "nohtml");
            $row['micro'] = filter($row['micro'], "nohtml");
            $row['user_id'] = filter($row['user_id'], "nohtml");
            if ($dcount >= 21) {
                echo "</table>";
                CloseTable();
                journalfoot();
                die();
            } else {
                $dcount = $dcount + 1;
                print ("<tr>");
                printf ("<td bgcolor=$bgcolor2>&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&file=search&bywhat=aid&exact=1&forwhat=%s\">%s</a></td>", $row['joid'], $row['joid']);
                printf ("<td bgcolor=$bgcolor2 align=center><div class=title><a href=\"modules.php?name=$module_name&file=search&bywhat=aid&exact=1&forwhat=%s\"><img src=\"modules/$module_name/images/binocs.gif\" border=0 alt=\""._VIEWJOURNAL2."\" title=\""._VIEWJOURNAL2."\"></a></td>", $row['joid'], $row['joid']);
                printf ("<td bgcolor=$bgcolor2 align=center><a href=\"modules.php?name=Your_Account&op=userinfo&username=%s\"><img src=\"modules/$module_name/images/nuke.gif\" alt=\""._USERPROFILE2."\" title=\""._USERPROFILE2."\" border=0></a></td>", $row['joid'], $row['joid'], $row['joid']);
                if (empty($username)) {
                    print ("<td align=center bgcolor=$bgcolor2><a href=\"modules.php?name=Your_Account&op=new_user\"><img src=\"modules/$module_name/images/folder.gif\" border=0 alt=\""._CREATEACCOUNT."\" title=\""._CREATEACCOUNT."\"></a></td>");
                } else {
                    if (is_active("Private_Messages")) {
                        printf ("<td align=center bgcolor=$bgcolor2><a href=\"modules.php?name=Private_Messages&mode=post&u=".$row['user_id']."\"><img src='modules/$module_name/images/chat.gif' border='0' alt='"._PRIVMSGJ2."'></a></td>", $row['joid'], $row['joid']);
                    }
                }
                echo "</tr>";
            }
        }
        echo "</table>";
        CloseTable();
    }
    function all($bgcolor1, $bgcolor2, $bgcolor3, $sitename, $username) {
        global $prefix, $user_prefix, $db, $module_name;
        OpenTable();
        echo ("<div align=\"center\" class=title>"._ALPHABETICAL."</div><br>");
        echo ("<table align=center border=1 cellpadding=0 cellspacing=0>");
        echo ("<tr>");
        echo ("<td bgcolor=$bgcolor1 width=150>&nbsp;<strong>"._MEMBER."</strong> "._CLICKTOVIEW."</td>");
        echo ("<td bgcolor=$bgcolor1 width=70 align=center><strong>"._VIEWJOURNAL."</strong></td>");
        echo ("<td bgcolor=$bgcolor1 width=70 align=center><strong>"._MEMBERPROFILE."</strong></td>");
        if (empty($username)) {
            echo ("<td bgcolor=$bgcolor1 width=70 align=center><strong>"._CREATEACCOUNT2."</strong></td>");
        } else {
            echo ("<td bgcolor=$bgcolor1 width=70 align=center><strong>"._PRIVMSGJ."</strong></td>");
        }
        echo ("</tr>");
	$sql = "SELECT j.id, j.joid, j.nop, j.ldp, j.ltp, j.micro, u.user_id FROM ".$prefix."_journal_stats j, ".$user_prefix."_users u where u.username=j.joid ORDER BY 'joid'";
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result)) {
            $row['id'] = intval($row['id']);
            $row['joid'] = filter($row['joid'], "nohtml");
            $row['nop'] = filter($row['nop'], "nohtml");
            $row['ldp'] = filter($row['ldp'], "nohtml");
            $row['ltp'] = filter($row['ltp'], "nohtml");
            $row['micro'] = filter($row['micro'], "nohtml");
            $row['user_id'] = filter($row['user_id'], "nohtml");
            print ("<tr>");
            printf ("<td bgcolor=$bgcolor2>&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&file=search&bywhat=aid&forwhat=%s\">%s</a></td>", $row['joid'], $row['joid']);
            printf ("<td bgcolor=$bgcolor2 align=center><div class=title><a href=\"modules.php?name=$module_name&file=search&bywhat=aid&forwhat=%s\"><img src=\"modules/$module_name/images/binocs.gif\" border=0 alt=\""._VIEWJOURNAL2."\" title=\""._VIEWJOURNAL2."\"></a></td>", $row['joid'], $row['joid']);
            printf ("<td bgcolor=$bgcolor2 align=center><a href=\"modules.php?name=Your_Account&op=userinfo&username=%s\"><img src=\"modules/$module_name/images/nuke.gif\" alt=\""._USERPROFILE2."\" title=\""._USERPROFILE2."\" border=0></a></td>", $row['joid'], $row['joid'], $row['joid']);
            if (empty($username)) {
                print ("<td align=center bgcolor=$bgcolor2><a href=\"modules.php?name=Your_Account&op=new_user\"><img src=\"modules/$module_name/images/folder.gif\" border=0 alt=\""._CREATEACCOUNT."\" title=\""._CREATEACCOUNT."\"></a></td>");
            } elseif (!empty($username) AND is_active("Private_Messages")) {
                print ("<td align=center bgcolor=$bgcolor2><a href=\"modules.php?name=Private_Messages&mode=post&u=".$row['user_id']."\"><img src='modules/$module_name/images/chat.gif' border='0' alt='"._PRIVMSGJ2."'></a></td>");
            }
            echo "</tr>";
        }
        echo "</table>";
        CloseTable();
    }
    echo "<br>";
    OpenTable();
    echo ("<div align=center> [ <a href=\"modules.php?name=$module_name&op=last\">"._20AUTHORS."</a> | <a href=\"modules.php?name=$module_name&op=all\">"._LISTALLJOURNALS."</a> | <a href=\"modules.php?name=$module_name&file=search&disp=showsearch\">"._SEARCHMEMBER."</a> ]</div>");
    CloseTable();
    echo "<br>";
    switch($op) {
        case "last":
        last20($bgcolor1, $bgcolor2, $bgcolor3, $username);
        break;
        case "all":
        all($bgcolor1, $bgcolor2, $bgcolor3, $sitename, $username);
        break;
        default:
        last20($bgcolor1, $bgcolor2, $bgcolor3, $username);
        break;
    }
    journalfoot();

?>