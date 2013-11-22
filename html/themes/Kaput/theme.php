<?php

/************************************************************/
/* Theme Colors Definition                                  */
/*                                                          */
/* Control the header for your site. You need to define the */
/* BODY tag and in some part of the code call the blocks    */
/* function for left side with: block(left);                */
/************************************************************/

$thename = "NukeNews";
$bgcolor1 = "#d5d5d5";
$bgcolor2 = "#7b91ac";
$bgcolor3 = "#efefef";
$bgcolor4 = "#d5d5d5";
$textcolor1 = "#000000";
$textcolor2 = "#000000";

function OpenTable() {
    echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"><tr>
    <td width=\"15\" height=\"15\"><img src=\"themes/Kaput/images/up-left2.gif\" alt=\"\" border=\"0\"></td>
    <td background=\"themes/Kaput/images/up2.gif\" align=\"center\" width=\"100%\" height=\"15\">&nbsp;</td>
    <td><img src=\"themes/Kaput/images/up-right2.gif\" width=\"15\" height=\"15\" alt=\"\" border=\"0\"></td></tr>
    <tr>
    <td background=\"themes/Kaput/images/left2.gif\" width=\"15\">&nbsp;</td>
    <td bgcolor=\"ffffff\" width=\"100%\">";
}

function OpenTable2() {

    echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\"><tr>
    <td width=\"15\" height=\"15\"><img src=\"themes/Kaput/images/up-left2.gif\" alt=\"\" border=\"0\"></td>
    <td background=\"themes/Kaput/images/up2.gif\" align=\"center\" height=\"15\">&nbsp;</td>
    <td><img src=\"themes/Kaput/images/up-right2.gif\" width=\"15\" height=\"15\" alt=\"\" border=\"0\"></td></tr>
    <tr>
    <td background=\"themes/Kaput/images/left2.gif\" width=\"15\">&nbsp;</td>
    <td bgcolor=\"ffffff\">";
}
    
function CloseTable() {
    echo "</td>
    <td background=\"themes/Kaput/images/right2.gif\">&nbsp;</td></tr>
    <tr>
    <td width=\"15\" height=\"15\"><img src=\"themes/Kaput/images/down-left2.gif\" alt=\"\" border=\"0\"></td>
    <td background=\"themes/Kaput/images/down2.gif\" align=\"center\" height=\"15\">&nbsp;</td>
    <td><img src=\"themes/Kaput/images/down-right2.gif\" width=\"15\" height=\"15\" alt=\"\" border=\"0\"></td></tr>
    </td></tr></table>
    <br>";
}

function CloseTable2() {
    echo "</td>
    <td background=\"themes/Kaput/images/right2.gif\">&nbsp;</td></tr>
    <tr>
    <td width=\"15\" height=\"15\"><img src=\"themes/Kaput/images/down-left2.gif\" alt=\"\" border=\"0\"></td>
    <td background=\"themes/Kaput/images/down2.gif\" align=\"center\" height=\"15\">&nbsp;</td>
    <td><img src=\"themes/Kaput/images/down-right2.gif\" width=\"15\" height=\"15\" alt=\"\" border=\"0\"></td></tr>
    </td></tr></table>
    <br>";
}

function FormatStory($thetext, $notes, $aid, $informant) {
    global $anonymous;
    if (!empty($notes)) {
	$notes = "<b>"._NOTE."</b> <i>$notes</i>\n";
    } else {
	$notes = "";
    }
    if ("$aid" == "$informant") {
	echo "<font class=\"content\" color=\"#505050\">$thetext<br>$notes</font>\n";
    } else {
	if(!empty($informant)) {
	    $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
	} else {
	    $boxstuff = "$anonymous ";
	}
	$boxstuff .= "writes <i>\"$thetext\"</i> $notes\n";
	echo "<font class=\"content\" color=\"#505050\">$boxstuff</font>\n";
    }
}

/************************************************************/
/* Function themeheader()                                   */
/*                                                          */
/* Control the header for your site. You need to define the */
/* BODY tag and in some part of the code call the blocks    */
/* function for left side with: block(left);                */
/************************************************************/

function themeheader() {
    global $user, $sitename;
    cookiedecode($user);
    $username = $cookie[1];
    if (empty($username)) {
        $username = "Anonymous";
    }
    echo "<body bgcolor=\"#FFFFFF\" text=\"#000000\" link=\"#363636\" vlink=\"#363636\" alink=\"#d5ae83\">\n"
	."<br>\n";
    ads(0);
    OpenTable();
    echo "<table border=\"0\"><tr><td rowspan=\"2\">"
	."<a href=\"index.php\"><img src=\"themes/Kaput/images/logo.gif\" border=\"0\" alt=\""._WELCOMETO." $sitename\" align=\"left\"></a></td>"
	."<td align=right width=100%>"
        ."<form action=\"modules.php?name=Search\" method=\"post\">"
        ."<font class=\"content\" color=\"#000000\"><b>"._SEARCH." </b>"
        ."<input type=\"text\" name=\"query\" size=\"14\"></font></form>"
        ."</td></tr><tr>"
        ."<td align=\"right\" valign=\"bottom\" width=\"100%\">"
        ."<font class=\"content\"><b>"
	."<A href=\"/\">Home</a>&nbsp;&middot;&nbsp;<A href=\"modules.php?name=Topics\">Topics</a>&nbsp;&middot;&nbsp"
        ."<A href=\"modules.php?name=Downloads\">Downloads</a>&nbsp;&middot;&nbsp;<A href=\"modules.php?name=Your_Account\">Your Account</a>"
        ."&nbsp;&middot;&nbsp;<A href=\"modules.php?name=Forum\">Forums</a>&nbsp;&middot;&nbsp;<A href=\"modules.php?name=Top\">Top 10</a>"
        ."</b></font></td></tr></table>\n";
    CloseTable();
    $public_msg = public_message();
    echo "$public_msg<br>";	
    echo "<table cellpadding=\"0\" cellspacing=\"0\" width=\"99%\" border=\"0\" align=\"center\" bgcolor=\"#ffffff\">\n"
	."<tr><td bgcolor=\"#ffffff\" valign=\"top\">\n";
    blocks("left");
    echo "</td><td><img src=\"themes/NukeNews/images/pixel.gif\" width=\"15\" height=\"1\" border=\"0\" alt=\"\"></td><td width=\"100%\" valign=top>\n";
}

/************************************************************/
/* Function themefooter()                                   */
/*                                                          */
/* Control the footer for your site. You don't need to      */
/* close BODY and HTML tags at the end. In some part call   */
/* the function for right blocks with: block(right);        */
/* Also, $index variable need to be global and is used to   */
/* determine if the page your're viewing is the Homepage or */
/* and internal one.                                        */
/************************************************************/

function themefooter() {
    if (defined('INDEX_FILE')) {
	echo "</td><td><img src=\"themes/NukeNews/images/pixel.gif\" width=\"15\" height=\"1\" border=\"0\" alt=\"\"></td><td valign=\"top\" width=\"150\">\n";
	blocks("right");
    }
    echo "</td></tr></table>\n";
    echo "<br>";
    OpenTable();
    echo "<center>";
    footmsg();
    echo "</center>";
    CloseTable();
}

/************************************************************/
/* Function themeheader()                                   */
/*                                                          */
/* Control the header for your site. You need to define the */
/* BODY tag and in some part of the code call the blocks    */
/* function for left side with: block(left);                */
/************************************************************/

function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
    global $anonymous, $tipath;
    $ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
	$t_image = "themes/$ThemeSel/images/topics/$topicimage";
    } else {
	$t_image = "$tipath$topicimage";
    }
    echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"><tr>
    <td width=\"15\" height=\"15\"><img src=\"themes/Kaput/images/up-left2.gif\" alt=\"\" border=\"0\"></td>
    <td background=\"themes/Kaput/images/up2.gif\" align=\"center\" width=\"100%\" height=\"15\">&nbsp;</td>
    <td><img src=\"themes/Kaput/images/up-right2.gif\" width=\"15\" height=\"15\" alt=\"\" border=\"0\"></td></tr>
    <tr>
    <td background=\"themes/Kaput/images/left2.gif\" width=\"15\">&nbsp;</td>
    <td bgcolor=\"ffffff\" width=\"100%\">
    <font color=\"#999999\"><b><a href=\"modules.php?name=News&amp;new_topic=$topic\"><img src=\"$t_image\" border=\"0\" Alt=\"$topictext\" align=\"right\" hspace=\"10\" vspace=\"10\"></a></B></font>
    <b>$title</b><br><br>";
    FormatStory($thetext, $notes, $aid, $informant);
    echo "</td>
    <td background=\"themes/Kaput/images/right2.gif\">&nbsp;</td></tr>
    <tr>
    <td width=\"15\" height=\"15\"><img src=\"themes/Kaput/images/middle-left.gif\" alt=\"\" border=\"0\"></td>
    <td background=\"themes/Kaput/images/middle.gif\" align=\"center\" height=\"15\">&nbsp;</td>
    <td><img src=\"themes/Kaput/images/middle-right.gif\" width=\"15\" height=\"15\" alt=\"\" border=\"0\"></td></tr>
    <tr>
    <td background=\"themes/Kaput/images/left3.gif\" width=\"15\">&nbsp;</td>
    <td align=center>
    <font color=\"#999999\" size=\"1\">"._POSTEDBY." ";
    formatAidHeader($aid);
    echo ""._ON." $time $timezone ($counter "._READS.")<br></font>
	<font class=\"content\">$morelink</font></td>
    <td background=\"themes/Kaput/images/right3.gif\" width=\"15\">&nbsp;</td></tr>
    <tr>
    <td width=\"15\" height=\"11\" valign=top><img src=\"themes/Kaput/images/down-left3.gif\" alt=\"\" border=\"0\"></td>
    <td background=\"themes/Kaput/images/down3.gif\" align=\"center\" height=\"11\" width=100%>&nbsp;</td>
    <td><img src=\"themes/Kaput/images/down-right3.gif\" width=\"15\" height=\"11\" alt=\"\" border=\"0\">
    </td></tr></table>
    <br>";
}

/************************************************************/
/* Function themeheader()                                   */
/*                                                          */
/* Control the header for your site. You need to define the */
/* BODY tag and in some part of the code call the blocks    */
/* function for left side with: block(left);                */
/************************************************************/

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext) {
    global $admin, $sid, $tipath, $admin_file;
    $ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
	$t_image = "themes/$ThemeSel/images/topics/$topicimage";
    } else {
	$t_image = "$tipath$topicimage";
    }
    Opentable();
    echo "<font class=\"option\" color=\"#363636\"><b>$title</b></font><br>\n"
        ."<font class=\"content\">Posted on $datetime by ";
    formatAidHeader($aid);
    if (is_admin($admin)) {
	echo "<br>[ <a href=\"".$admin_file.".php?op=EditStory&amp;sid=$sid\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=RemoveStory&amp;sid=$sid\">"._DELETE."</a> ]\n";
    }
    echo "<br><br>";
    echo "<a href=\"modules.php?name=News&amp;new_topic=$topic\"><img src=\"$t_image\" border=\"0\" Alt=\"$topictext\" align=\"right\" hspace=\"10\" vspace=\"10\"></a>\n";
    FormatStory($thetext, $notes="", $aid, $informant);
    echo "<br>\n\n\n";
    CloseTable();
}

/************************************************************/
/* Function themeheader()                                   */
/*                                                          */
/* Control the header for your site. You need to define the */
/* BODY tag and in some part of the code call the blocks    */
/* function for left side with: block(left);                */
/************************************************************/

function themesidebox($title, $content) {
    echo "<table border=0 cellspacing=0 cellpadding=0 width=150><tr>"
	."<td width=17 height=17><img src=themes/Kaput/images/up-left.gif alt=\"\" border=0></td>"
        ."<td background=themes/Kaput/images/up.gif align=center width=100% height=17>&nbsp;</td>"
        ."<td><img src=themes/Kaput/images/up-right.gif width=17 height=17 alt=\"\" border=0></td></tr>"
        ."<tr>"
        ."<td background=themes/Kaput/images/left.gif width=17>&nbsp;</td>"
        ."<td background=themes/Kaput/images/backdot.gif width=126><center><font class=content><b>$title</b></font></center><br>$content</td>"
        ."<td background=themes/Kaput/images/right.gif>&nbsp;</td></tr>"
        ."<tr>"
        ."<td width=17 height=17><img src=themes/Kaput/images/down-left.gif alt=\"\" border=0></td>"
        ."<td background=themes/Kaput/images/down.gif align=center width=100% height=17>&nbsp;</td>"
        ."<td><img src=themes/Kaput/images/down-right.gif width=17 height=17 alt=\"\" border=0></td></tr>"
        ."</td></tr></table>"
        ."<br>";
}

?>