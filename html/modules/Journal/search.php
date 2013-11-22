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
/*                                                                      */
/************************************************************************/
/* Additional security checking code 2003 by chatserv                   */
/* http://www.nukefixes.com -- http://www.nukeresources.com             */
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
    }
    if (!isset($bywhat)):
        $bywhat = "naddaanythang";
    else :
    $bywhat = filter($bywhat, "nohtml");
    $bywhat = filter($bywhat, "nohtml");
    endif;
    if (!isset($forwhat)):
        $forwhat = "naddaanythang";
    else :
    $forwhat = filter($forwhat, "nohtml");
    $forwhat = filter($forwhat, "nohtml");
    endif;
    startjournal($sitename, $user);
    function displaySearch($sitename, $username, $bgcolor2, $bgcolor3, $bgcolor1) {
        global $module_name;
        echo "<br>";
        OpenTable();
        echo ("<div align=center class=title>");
        echo ("<strong>"._JOURNALSEARCH."</strong></div><br><br>");
        echo ("<div align=center>");
        echo ("<form action='modules.php?name=$module_name&file=search' method='post'>");
        echo ("<input type='hidden' name='disp' value='search'>");
        echo ("<input type='text' name='forwhat' size='30' maxlength='150'> "._IN." <select name='bywhat'>");
        echo ("<option value=\"aid\" SELECTED>"._MEMBER."</option>");
        echo ("<option value=\"title\">"._TITLE."</option>");
        echo ("<option value=\"bodytext\">"._BODYTEXT."</option>");
        echo ("<option value=\"comment\">"._UCOMMENTS."</option>");
        echo ("</select>&nbsp;&nbsp;<input type='submit' name='submit' value='"._SEARCH."'>");
        echo ("</form>");
        echo ("</div>");
        CloseTable();
    }
    function search($username, $bywhat, $forwhat, $sitename, $bgcolor2, $bgcolor3, $user) {
        global $prefix, $user_prefix, $db, $module_name, $exact, $bgcolor1;
        echo "<br>";
        OpenTable();
        echo ("<div align=center>");
        $exact = intval($exact);
        if ($exact == '1') {
            echo ("<strong>"._JOURNALFOR.": \"$forwhat\"</strong><br><br>");
        } else {
            echo ("<strong>"._SEARCHRESULTS.": \"$forwhat\"</strong><br><br>");
        }
        if ($forwhat == "naddaanythang") :
        displaySearch($sitename, $username, $bgcolor2, $bgcolor3, $bgcolor1);
        else :
        echo ("<table align=center width=\"90%\" border=2>");
        echo ("<tr>");
        echo ("<td align=center width=100><strong><div align=\"center\">"._PROFILE."</div></strong></td>");
        echo ("<td align=center><strong>"._TITLE."</strong> "._CLICKTOVIEW."</td>");
        echo ("<td align=center width=\"5%\"><strong>"._VIEW."</strong></td>");
         /* Commented out because this was broken sixonetonoffun
        $editdel = intval($editdel);
        if ($exact == '1') {
            if ($forwhat == $username) {
                $editdel = 1;
            }
        } else {
            if (eregi($forwhat, $username)) {
                $editdel = 2;
            }
        }
       
        if ($editdel == '1') {
            echo ("<td align=center width=\"5%\"><strong>"._EDIT."</strong></td>");
            echo ("<td align=center width=\"5%\"><strong>"._DELETE."</strong></td>");
        } elseif ($editdel == '2') {
            echo ("<td align=center width=\"5%\"><strong>"._EDIT."/<br>"._PROFILE."</strong></td>");
            echo ("<td align=center width=\"5%\"><strong>"._DELETE."/<br>&nbsp;</strong></td>");
        } else {
        	*/
            echo ("<td align=center width=\"5%\"><strong>"._PROFILE."</strong></td>");
  //    } Commented out because this was broken sixonetonoffun
        echo ("</tr>");
        if ($bywhat == 'aid'):
            if ($exact == '1') {
            $sql = "SELECT j.jid, j.aid, j.title, j.pdate, j.ptime, j.status, j.mdate, j.mtime, u.user_id, u.username FROM ".$prefix."_journal j, ".$user_prefix."_users u WHERE u.username=j.aid and j.aid='$forwhat' order by j.jid DESC";
        } else {
            $sql = "SELECT j.jid, j.aid, j.title, j.pdate, j.ptime, j.status, j.mdate, j.mtime, u.user_id, u.username FROM ".$prefix."_journal j, ".$user_prefix."_users u WHERE u.username=j.aid and j.aid like '%$forwhat%' order by j.jid DESC";
        } elseif ($bywhat == 'title'):
        $sql = "SELECT j.jid, j.aid, j.title, j.pdate, j.ptime, j.status, j.mdate, j.mtime, u.user_id, u.username FROM ".$prefix."_journal j, ".$user_prefix."_users u WHERE u.username=j.aid and j.title like '%$forwhat%' order by j.jid DESC";
        elseif ($bywhat == 'bodytext'):
        $sql = "SELECT j.jid, j.aid, j.title, j.pdate, j.ptime, j.status, j.mdate, j.mtime, u.user_id, u.username FROM ".$prefix."_journal j, ".$user_prefix."_users u WHERE u.username=j.aid and j.bodytext LIKE '%$forwhat%' order by j.jid DESC";
        elseif ($bywhat == 'comment'):
        $sql = "SELECT j.jid, j.aid, j.title, j.pdate, j.ptime, j.status, j.mdate, j.mtime, u.user_id, u.username FROM ".$prefix."_journal j, ".$user_prefix."_users u, ".$user_prefix."_journal_comments c WHERE u.username=j.aid and c.rid=j.jid and c.comment LIKE '%$forwhat%' order by j.jid DESC";
        endif;
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result)) {
            $row['jid'] = intval($row['jid']);
            $row['aid'] = filter($row['aid'], "nohtml");
            $row['title'] = filter($row['title'], "nohtml");
            $row['pdate'] = filter($row['pdate'], "nohtml");
            $row['ptime'] = filter($row['ptime'], "nohtml");
            $row['status'] = filter($row['status'], "nohtml");
            $row['mdate'] = filter($row['mdate'], "nohtml");
            $row['mtime'] = filter($row['mtime'], "nohtml");
            $row['user_id'] = filter($row['user_id'], "nohtml");
            $row['username'] = filter($row['username'], "nohtml");
            $dcount = 0;
            if ($row['status'] == "no") :
            $dcount = $dcount + 0;
            else :
            $dcount = $dcount + 1;
            print ("<tr>");
            //The follwing line made reference to non-existing field uname.//
            printf ("<td align=center bgcolor=$bgcolor2><a href=\"modules.php?name=Your_Account&op=userinfo&username=".$row['username']."\">%s</a></td>", $row['aid'], $row['aid']);
            printf ("<td align=left bgcolor=$bgcolor2>&nbsp;<a href=\"modules.php?name=$module_name&file=display&jid=%s\">%s</a> <span class=tiny>(%s @ %s)</span>", $row['jid'], $row['title'], $row['pdate'], $row['ptime']);
		$sqlscnd = "SELECT cid from ".$prefix."_journal_comments where rid=".$row['jid'];
            $rstscnd = $db->sql_query($sqlscnd);
            $scndcount = 0;
            while ($rowscnd = $db->sql_fetchrow($rstscnd)) {
                $scndcount = $scndcount + 1;
            }
            if ($scndcount > 0):
                printf (" &#151;&#151; $scndcount comments</td>");
            endif;
            printf ("<td align=center bgcolor=$bgcolor2><a href=\"modules.php?name=$module_name&file=display&jid=%s\"><img src=\"modules/$module_name/images/read.gif\" border=0 alt=\""._READ."\" title=\""._READ."\"></a></td>", $row['jid'], $row['title']);
        /* Commented out because this was broken sixonetonoffun
            if ($row['aid'] == $username) :
            printf ("<td align=center bgcolor=$bgcolor2><a href=\"modules.php?name=$module_name&file=modify&jid=%s\"><img src='modules/$module_name/images/edit.gif' border='0' alt=\""._EDIT."\" title=\""._EDIT."\"></a></td>", $row['jid'], $row['title']);
            printf ("<td align=center bgcolor=$bgcolor2><a href=\"modules.php?name=$module_name&file=delete&jid=%s&forwhat=$forwhat\"><img src='modules/$module_name/images/trash.gif' border='0' alt=\""._DELETE."\" title=\""._DELETE."\"></a></td>", $row['jid'], $row['title']);
            else :
            */
            //printf ("<td align=center bgcolor=$bgcolor2><a href=\"modules.php?name=$module_name&file=display&jid=%s\"><img src=\"modules/$module_name/images/read.gif\" border=0 alt=\""._READ."\" title=\""._READ."\"></a></td>", $row['jid'], $row['title']);
            //The follwing line made reference to non-existing field uname.//
            printf ("<td align=center bgcolor=$bgcolor2><a href=\"modules.php?name=Your_Account&op=userinfo&username=".$row['username']."\"><img src=\"modules/$module_name/images/nuke.gif\" border=\"0\" alt=\""._USERPROFILE2."\" title=\""._USERPROFILE2."\"></a></td>");
            /*
            if (empty($username)) {
            print ("<td align=center bgcolor=$bgcolor2><a href=\"modules.php?name=Your_Account\"><img src=\"modules/$module_name/images/folder.gif\" border=0 alt=\""._CREATEACCOUNT."\" title=\""._CREATEACCOUNT."\"></a></td>");
            } elseif (!empty($username) AND is_active("Private_Messages")) {
            printf ("<td align=center bgcolor=$bgcolor2><a href=\"modules.php?name=Private_Messages&mode=post&u=".$row['user_id']."\"><img src='modules/$module_name/images/chat.gif' border='0' alt='"._PRIVMSGJ2."'></a></td>", $row['aid'], $row['aid']);
            }
            */
            endif;
      //    endif; // Commented out because this was broken sixonetonoffun
        }
        echo ("</table>");
        if (empty($dcount)) {
            $dcount = 0;
        }
        echo ("<br><div align=center>$dcount "._PUBLICFOR." \"$forwhat\"</div>");
        endif;
        echo ("</div>");
        CloseTable();
    }
    if (isset($disp)) { $disp = filter($disp, "nohtml"); }
    else { $disp = ""; }
    switch($disp) {
        case "showsearch":
        displaySearch($sitename, $username, $bgcolor2, $bgcolor3, $bgcolor1, $forwhat, $user);
        break;
        case "search":
        search($username, $bywhat, $forwhat, $sitename, $bgcolor2, $bgcolor3, $user);
        break;
        default:
        search($username, $bywhat, $forwhat, $sitename, $bgcolor2, $bgcolor3, $user);
        break;
    }
    journalfoot();

?>