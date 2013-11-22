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
    if (is_user($user)) {
cookiedecode($user);
$username = $cookie[1];
    }
    $user = filter($user, "nohtml");
    $username = filter($username, "nohtml");
    $sitename = filter($sitename, "nohtml");
    if (isset($jbodytext)) { $jbodytext = kses(ADVT_stripslashes($jbodytext), $allowed); }
	else { $jbodytext = ""; }
    $debug = filter($debug, "nohtml");
    if ($debug == "true") :
    echo ("UserName:$username<br>SiteName: $sitename");
    endif;
    startjournal($sitename, $user);
#####################################################
# Check to see if the current user of add.php is a  #
# member of the site. If not, inform them that they #
# must register before posting.		            #
#####################################################

    if (!is_user($user)) :
    echo ("<br>");
    openTable();
    echo ("<div align=center>"._YOUMUSTBEMEMBER."<br></div>");
    closeTable();
    journalfoot();
    die();
endif;

#####################################################
# Build Journal Entry Form.	    		    #
# NOTE: The mood list is dynamic!!! To add/edit the #
# list of available moods, just upload or remove    #
# gifs and jpgs from the 			    #
# modules/Journal/Images/moods directory.	    #
#####################################################
    if (is_user($user)) {
echo "<br>";
OpenTable();
echo ("<div align=center class=title>"._ADDJOURNAL."</div><br>");
echo ("<div align=center> [ <a href=\"modules.php?name=$module_name&file=add\">"._ADDENTRY."</a> | <a href=\"modules.php?name=$module_name&file=edit&op=last\">"._YOURLAST20."</a> | <a href=\"modules.php?name=$module_name&file=edit&op=all\">"._LISTALLENTRIES."</a> ]</div>");
CloseTable();
echo "<br>";
OpenTable();
print  ("<form action='modules.php?name=$module_name&file=savenew' method='post'>");
print  ("<table align=center border=0>");
print  ("<tr>");
print  ("<td align=right valign=top><strong>"._TITLE.": </strong></td>");
print  ("<td valign=top><input type=\"text\" value=\"\" size=50 maxlength=80 name=\"title\"></td>");
print  ("</tr>");
print  ("<tr>");
print  ("<td align=right valign=top><strong>"._BODY.": </strong></td>");
print  ("<td valign=top><textarea name=\"jbodytext\" cols=\"70\" rows=\"15\"></textarea><br>"._HTMLNOTALLOWED."<br></td>");
print  ("</tr>");
print  ("<tr>");
print  ("<td align=right valign=top><strong>"._LITTLEGRAPH.": </strong><br>"._OPTIONAL."</td>");
echo "<td valign=top><table cellpadding=3><tr>";
$tempcount = 0;
        $tempcount = intval($tempcount);
        $direktori = "$jsmiles";
        $handle = opendir($direktori);
        while ($file = readdir($handle)) {
            if (is_file($file) && strtolower(substr($file, -4)) == '.gif' || '.jpg') {
                $filelist[] = $file;
            } else {
                OpenTable();
                echo "<center><b>"._ANERROR."</b></center>";
                CloseTable();
                exit;
            }
}
asort($filelist);
while (list ($key, $file) = each ($filelist)) {
    if (!ereg(".gif|.jpg",$file)) { }
    elseif ($file == "." || $file == "..") {
        $a=1;
    } else {
	if ($tempcount == 6):
	    echo "</tr><tr>";
                echo "<td><input type='radio' name='mood' value='$file'></td><td><img src=\"$jsmiles/$file\" alt=\"$file\" title=\"$file\"></td>";
	    $tempcount = 0;
	else :
                echo "<td><input type='radio' name='mood' value='$file'></td><td><img src=\"$jsmiles/$file\" alt=\"$file\" title=\"$file\"></td>";
	endif;
	$tempcount = $tempcount + 1;
    }
}
echo "</tr></table>";
print  ("</td>");
print  ("</tr>");
print  ("<tr>");
print  ("<tr>");
print  ("<td align=right valign=top><strong>"._PUBLIC.": </strong></td>");
print  ("<td align=left valign=top>");
print  ("<select name='status'>");
print  ("<option value=\"yes\" SELECTED>"._YES."</option>");
print  ("<option value=\"no\">"._NO."</option>");
print  ("</select>");
print  ("</td>");
print  ("</tr>");
print  ("<td colspan=2 align=center><input type='submit' name='submit' value='"._ADDENTRY."'><br><br>"._TYPOS."</td>");
print  ("</tr>");
print  ("</table>");
print  ("</form>");
closeTable();
echo ("<br>");
journalfoot();
    } else {
        echo ("<br>");
        openTable();
        echo ("<div align=center>"._YOUMUSTBEMEMBER."<br></div>");
        closeTable();
        journalfoot();
        die();
    }

?>