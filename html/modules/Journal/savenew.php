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
/* Required: PHPNuke 5.5 ( http://www.phpnuke.org/ ) and phpbb2         */
/* ( http://bbtonuke.sourceforge.net/ ) forums port.                    */
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
    include("modules/$module_name/kses.php");
    if (empty($title) OR empty($jbodytext) OR empty($status)) {
        OpenTable();
        echo "<center><b>"._YOUMUSTFILLFIELDS."</b><br><br>"._GOBACK."</center>";
        CloseTable();
        include("footer.php");
        die();
    } elseif (is_user($user)) {
        cookiedecode($user);
        $username = $cookie[1];
        $htime = date("h");
        $mtime = date("i");
        $ntime = date("a");
        $mtime = "$htime:$mtime $ntime";
        $mdate = date("m");
        $ddate = date("d");
        $ydate = date("Y");
        $ndate = "$mdate-$ddate-$ydate";
        $pdate = $ndate;
        $ptime = $mtime;
        if ($debug == "true") :
        echo ("UserName:$username<br>SiteName: $sitename");
        endif;
        startjournal($sitename, $user);
        echo "<br>";
        OpenTable();
        echo ("<div align=center class=title>"._ENTRYADDED."</div><br><br>");
        echo ("<div align=center> [ <a href=\"modules.php?name=$module_name&file=edit\">"._RETURNJOURNAL."</a> ]</div>");
        CloseTable();
        $username = $cookie[1];
        $user = filter($user, "nohtml");
        $username = filter($username, "nohtml");
        $sitename = filter($sitename, "nohtml");
        $title = filter($title, "nohtml");
        $title = addslashes($title);
        if (isset($mood)) { $mood = filter($mood, "nohtml"); }
		else { $mood = ""; }
        $jbodytext = kses(ADVT_stripslashes($jbodytext), $allowed);
        $jbodytext = addslashes($jbodytext);
        $sql = "INSERT INTO ".$prefix."_journal (jid,aid,title,bodytext,mood,pdate,ptime,status,mtime,mdate) VALUES (NULL,'$username','$title','$jbodytext','$mood','$pdate','$ptime','$status','$mtime','$ndate')";
        $db->sql_query($sql);
        update_points(1);
$sql = "SELECT * FROM ".$prefix."_journal_stats WHERE joid = '$username'";
        $result = $db->sql_query($sql);
        $row_count = $db->sql_numrows($result);
        if ($row_count == 0):
$query = "INSERT INTO ".$prefix."_journal_stats (id,joid,nop,ldp,ltp,micro) VALUES ('','$username','1',now(),'$mtime',now())";
        $db->sql_query($query);
        else :
        $row = $db->sql_fetchrow($result);
        $nnop = $row['nop'];
        $nnnop = ($nnop + 1);
        $micro = date("U");
        $nnnop = filter($nnnop, "nohtml");
        $ndate = filter($ndate, "nohtml");
        $mtime = filter($mtime, "nohtml");
        $micro = filter($micro, "nohtml");
$query = "UPDATE ".$prefix."_journal_stats SET nop='$nnnop', ldp='$ndate', ltp='$mtime' micro='$micro' WHERE joid='$username'";
        $db->sql_query($query);
        endif;
        journalfoot();
    } else {
        $pagetitle = "- "._YOUMUSTBEMEMBER."";
        $pagetitle = filter($pagetitle, "nohtml");
        OpenTable();
        echo "<center><b>"._YOUMUSTBEMEMBER."</b></center>";
        CloseTable();
        include("footer.php");
        die();
    }

?>