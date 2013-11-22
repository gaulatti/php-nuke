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

if (!isset($jid) OR !is_numeric($jid)) { die("No journal specified."); }
$pagetitle = "- "._USERSJOURNAL;
include("header.php");
include("modules/$module_name/functions.php");
    if (is_user($user)) {
cookiedecode($user);
$username = $cookie[1];
    }
startjournal($sitename,$user);

#####################################################
# Check to see if the current username matches the  #
# the name of the author recorded in the database.  #
# If not - inform them that there is a problem and  #
# to check their current username.		    #
#####################################################
    if (is_user($user)) {
$jid = intval($jid);
$sql = "SELECT * FROM ".$prefix."_journal WHERE jid = '$jid'";
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
    $owner = $row['aid'];
    if ($owner != $username):
	openTable();
	echo ("<div align=center>"._YOUWRONG."</div>");
	closeTable();
	echo ("<br>");
	journalfoot();
	die();
    endif;
	$sql = "DELETE FROM ".$prefix."_journal WHERE jid = '$jid'";
    $db->sql_query($sql);
	$sql = "DELETE FROM ".$prefix."_journal_comments WHERE rid = '$jid'";
    $db->sql_query($sql);
    echo ("<br>");
    openTable();
    echo ("<div align=center>"._ENTRYREMOVED."<br><br>");
    echo ("<a href=\"modules.php?name=$module_name&file=edit\">"._RETURNJOURNAL."</a></div>");
    closeTable();
}
        journalfoot();
    } else {
        if (is_admin($admin)) {
            $sql = "DELETE FROM ".$prefix."_journal WHERE jid = '$jid'";
            $db->sql_query($sql);
            $sql = "DELETE FROM ".$prefix."_journal_comments WHERE rid = '$jid'";
            $db->sql_query($sql);
            echo ("<br>");
            openTable();
            echo ("<div align=center>"._ENTRYREMOVED."<br><br>");
            echo ("<a href=\"modules.php?name=$module_name&file=edit\">"._RETURNJOURNAL."</a></div>");
            closeTable();
        }
        journalfoot();
    }
    $pagetitle = "- "._YOUMUSTBEMEMBER."";
    $pagetitle = filter($pagetitle, "nohtml");
    OpenTable();
    echo "<center><b>"._YOUMUSTBEMEMBER."</b></center>";
    CloseTable();
    include("footer.php");
    die();

?>