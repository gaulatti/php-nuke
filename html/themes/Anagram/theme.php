<?php

/************************************************************/
/* Ported Theme Name: Anagram (v1.0)                        */
/* Original Theme Name: Vision (v1.0)                       */
/* Copyright (c) 2001 Somara Sem (http://www.somara.com)    */
/* Last Updated: 09/19/2001 by dezina.com                   */
/************************************************************/

/************************************************************/
/* Theme Colors Definition                                  */
/*                                                          */
/* Define colors for your web site. $bgcolor2 is generaly   */
/* used for the tables border as you can see on OpenTable() */
/* function, $bgcolor1 is for the table background and the  */
/* other two bgcolor variables follows the same criteria.   */
/* $texcolor1 and 2 are for tables internal texts           */
/************************************************************/

$bgcolor1 = "#DAD8D8";
$bgcolor2 = "#EEEEEE";
$bgcolor3 = "#efefef";
$bgcolor4 = "#ffffff";
$textcolor1 = "#000000";
$textcolor2 = "#000000";

/************************************************************/
/* OpenTable Functions                                      */
/*                                                          */
/* Define the tables look&feel for you whole site. For this */
/* we have two options: OpenTable and OpenTable2 functions. */
/* Then we have CloseTable and CloseTable2 function to      */
/* properly close our tables. The difference is that        */
/* OpenTable has a 100% width and OpenTable2 has a width    */
/* according with the table content                         */
/************************************************************/

function OpenTable() {
    global $bgcolor1, $bgcolor2;
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$bgcolor2\"><tr><td>\n";
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"8\" bgcolor=\"$bgcolor1\"><tr><td>\n";
}

function CloseTable() {
    echo "</td></tr></table></td></tr></table>\n";
}

function OpenTable2() {
    global $bgcolor1, $bgcolor2;
    echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$bgcolor2\" align=\"center\"><tr><td>\n";
    echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"8\" bgcolor=\"$bgcolor1\"><tr><td>\n";
}

function CloseTable2() {
    echo "</td></tr></table></td></tr></table>\n";
}

/************************************************************/
/* FormatStory                                              */
/*                                                          */
/* Here we'll format the look of the stories in our site.   */
/* If you dig a little on the function you will notice that */
/* we set different stuff for anonymous, admin and users    */
/* when displaying the story.                               */
/************************************************************/

function FormatStory($thetext, $notes, $aid, $informant) {
    global $anonymous;
    if (!empty($notes)) {
	$notes = "<br><br><b>"._NOTE."</b> <i>$notes</i>\n";
    } else {
	$notes = "";
    }
    if ("$aid" == "$informant") {
	echo "<font class=\"content\">$thetext$notes</font>\n";
    } else {
	if(!empty($informant)) {
	    $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
	} else {
	    $boxstuff = "$anonymous ";
	}
	$boxstuff .= ""._WRITES." <i>\"$thetext\"</i>$notes\n";
	echo "<font class=\"content\">$boxstuff</font>\n";
    }
}

/************************************************************/
/* Function themeheader()                                   */
/*                                                          */
/* Control the header for your site. You need to define the */
/* BODY tag and in some part of the code call the blocks    */
/* function for left side with: blocks(left);               */
/************************************************************/

function themeheader() {
    global $user, $banners, $sitename, $slogan, $cookie, $prefix, $anonymous, $db;
    cookiedecode($user);
    $username = $cookie[1];
    if (empty($username)) {
        $username = $anonymous;
    }
    echo "<body bgcolor=\"#ffffff\" text=\"#000000\">\n";
	ads(0);
    echo "<br>\n"
	."<table cellpadding=\"0\" cellspacing=\"10\" width=\"780\" border=\"0\" align=\"center\" bgcolor=\"#EEEEEE\">\n"
	."<tr>\n"
	."<td bgcolor=\"#EEEEEE\">\n"
	."<a href=\"index.php\"><img src=\"themes/Anagram/images/logo.gif\" align=\"left\" alt=\""._WELCOMETO." $sitename\" border=\"0\"></a></td>\n"
	."<td bgcolor=\"#EEEEEE\" align=\"right\">\n"
	."<form action=\"modules.php?name=Search\" method=\"post\"><font class=\"content\" color=\"#000000\"><b>"._SEARCH." </b>\n"
	."<input type=\"text\" name=\"query\" size=\"14\"></font></form></td>\n"
	."<td bgcolor=\"#EEEEEE\" align=\"right\">\n"
	."<form action=\"modules.php?name=Search\" method=\"get\"><font class=\"content\"><b>"._TOPICS." </b>\n";
    $toplist = $db->sql_query("select topicid, topictext from $prefix"._topics." order by topictext");
    echo "<select name=\"topic\"onChange='submit()'>\n"
	."<option value=\"\">"._ALLTOPICS."</option>\n";
    while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
	$topicid = intval($topicid);
    if ($topicid==$topic) { $sel = "selected "; }
	echo "<option $sel value=\"$topicid\">$topics</option>\n";
	$sel = "";
    }
    echo "</select></font></form></td>\n"
	."</tr></table>\n"

    ."<table cellpadding=\"1\" cellspacing=\"2\" width=\"780\" border=\"0\" align=\"center\" bgcolor=\"#DAD8D8\">\n"
    ."<tr>\n"
    ."<td width=\"14%\" bgcolor=\"#EEEEEE\" align=\"center\" style=\"cursor:hand\" onMouseOver=\"this.style.background='#DAD8D8'\" onMouseOut=\"this.style.background='#EEEEEE'\" onClick=\"window.location.href='/'\"><a href=\"/\">Home</a></td>\n"
    ."<td width=\"14%\" bgcolor=\"#EEEEEE\" align=\"center\" style=\"cursor:hand\" onMouseOver=\"this.style.background='#DAD8D8'\" onMouseOut=\"this.style.background='#EEEEEE'\" onClick=\"window.location.href='modules.php?name=Your_Account'\"><a href=\"modules.php?name=Your_Account\">Your Account</a></td>\n"
    ."<td width=\"14%\" bgcolor=\"#EEEEEE\" align=\"center\" style=\"cursor:hand\" onMouseOver=\"this.style.background='#DAD8D8'\" onMouseOut=\"this.style.background='#EEEEEE'\" onClick=\"window.location.href='modules.php?name=FAQ'\"><a href=\"modules.php?name=FAQ\">FAQ</a></td>\n"
    ."<td width=\"14%\" bgcolor=\"#EEEEEE\" align=\"center\" style=\"cursor:hand\" onMouseOver=\"this.style.background='#DAD8D8'\" onMouseOut=\"this.style.background='#EEEEEE'\" onClick=\"window.location.href='modules.php?name=Topics'\"><a href=\"modules.php?name=Topics\">Topics</a></td>\n"
    ."<td width=\"14%\" bgcolor=\"#EEEEEE\" align=\"center\" style=\"cursor:hand\" onMouseOver=\"this.style.background='#DAD8D8'\" onMouseOut=\"this.style.background='#EEEEEE'\" onClick=\"window.location.href='modules.php?name=Content'\"><a href=\"modules.php?name=Contenido\">Content</a></td>\n"
    ."<td width=\"14%\" bgcolor=\"#EEEEEE\" align=\"center\" style=\"cursor:hand\" onMouseOver=\"this.style.background='#DAD8D8'\" onMouseOut=\"this.style.background='#EEEEEE'\" onClick=\"window.location.href='modules.php?name=Submit_News'\"><a href=\"modules.php?name=Submit_News\">Submit News</a></td>\n"
    ."<td width=\"14%\" bgcolor=\"#EEEEEE\" align=\"center\" style=\"cursor:hand\" onMouseOver=\"this.style.background='#DAD8D8'\" onMouseOut=\"this.style.background='#EEEEEE'\" onClick=\"window.location.href='modules.php?name=Top'\"><a href=\"modules.php?name=Top\">Top 10</a></td>\n"
    ."</tr>\n"
    ."</table>\n"

		."<table cellpadding=\"0\" cellspacing=\"0\" width=\"780\" border=\"0\" align=\"center\" bgcolor=\"#fefefe\">\n"
		."<tr>\n"
		."<td bgcolor=\"#DAD8D8\" colspan=\"4\"><IMG src=\"themes/Anagram/images/pixel.gif\" width=\"1\" height=1 alt=\"\" border=\"0\" hspace=\"0\"></td>\n"
		."</tr>\n"
		."<tr valign=\"middle\" bgcolor=\"#DAD8D8\">\n"
		."<td width=\"20%\" nowrap><font class=\"content\">\n";
	    if ($username == "Anonymous") {
		echo "&nbsp;&nbsp;<a href=\"modules.php?name=Your_Account\">"._LOGINCREATE."</a>\n";
	    } else {
		echo "&nbsp;&nbsp;"._HELLO." $username!";
	    }
	    echo "</font></td>\n"
		    ."<td align=\"center\" height=\"20\" width=\"60%\">\n"
	        ."&nbsp;\n"
	        ."</td>\n"
	        ."<td align=\"right\" width=\"20%\"><font class=\"content\">\n"
	        ."<script type=\"text/javascript\">\n\n"
	        ."<!--   // Array ofmonth Names\n"
	        ."var monthNames = new Array( \""._JANUARY."\",\""._FEBRUARY."\",\""._MARCH."\",\""._APRIL."\",\""._MAY."\",\""._JUNE."\",\""._JULY."\",\""._AUGUST."\",\""._SEPTEMBER."\",\""._OCTOBER."\",\""._NOVEMBER."\",\""._DECEMBER."\");\n"
	        ."var now = new Date();\n"
	        ."thisYear = now.getYear();\n"
	        ."if(thisYear < 1900) {thisYear += 1900}; // corrections if Y2K display problem\n"
	        ."document.write(monthNames[now.getMonth()] + \" \" + now.getDate() + \", \" + thisYear);\n"
	        ."// -->\n\n"
	        ."</script></b></font></td>\n"
	        ."<td>&nbsp;</td>\n"
	        ."</tr>\n"
	        ."<tr>\n"
	        ."<td bgcolor=\"#DAD8D8\" colspan=\"4\"><IMG src=\"themes/ Anagram/images/pixel.gif\" width=\"1\" height=\"1\" alt=\"\" border=\"0\" hspace=\"0\"></td>\n"
	        ."</tr>\n"
        ."</table>\n"
;

	$public_msg = public_message();
        echo "$public_msg<br>";
	echo "<!-- Begin Main Content -->\n"
	."<table width=\"780\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\"><tr valign=\"top\">\n"
	."<td background=\"themes/Anagram/images/column-bg.gif\" width=\"150\" valign=\"top\">\n";
    blocks("left");
    echo "</td>\n"
        ."<td><img src=\"themes/Anagram/images/pixel.gif\" width=\"1\" height=\"1\" border=\"0\" alt=\"\"></td>\n"
        ."<td><img src=\"themes/Anagram/images/pixel.gif\" width=\"5\" height=\"1\" border=\"0\" alt=\"\"></td>\n"
        ."<td width=\"100%\">\n";
}

/************************************************************/
/* Function themefooter()                                   */
/*                                                          */
/* Control the footer for your site. You don't need to      */
/* close BODY and HTML tags at the end. In some part call   */
/* the function for right blocks with: blocks(right);       */
/* Also, $index variable need to be global and is used to   */
/* determine if the page your're viewing is the Homepage or */
/* and internal one.                                        */
/************************************************************/

function themefooter() {
    if (defined('INDEX_FILE')) {
	echo "</td><td><img src=\"themes/Anagram/images/pixel.gif\" width=\"5\" height=\"1\" border=\"0\" alt=\"\"></td>\n"
	    ."<td background=\"themes/Anagram/images/column-bg.gif\" valign=\"top\" width=\"150\">\n";
	blocks(right);
    }
    echo "</td>\n"
	."</tr></table>\n"

        ."<table width=\"780\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" bgcolor=\"#ffffff\" align=\"center\">\n"
        ."<tr align=\"center\">\n"
        ."<td width=\"100%\" bgcolor=\"#DAD8D8\"><img src=\"themes/Anagram/images/pixel.gif\" width=\"1\" height=\"1\" alt=\"\"></td>\n"
        ."</tr>\n"
        ."</table>\n"

        ."<table width=\"780\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" bgcolor=\"#EEEEEE\" align=\"center\">\n"
        ."<tr align=\"center\">\n"
        ."<td width=\"100%\" colspan=\"3\">\n";
    footmsg();
    echo "</td>\n"
        ."</tr>\n"
        ."</table>\n";
}

/************************************************************/
/* Function themeindex()                                    */
/*                                                          */
/* This function format the stories on the Homepage         */
/************************************************************/

function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
    global $anonymous, $tipath;
    $ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
	$t_image = "themes/$ThemeSel/images/topics/$topicimage";
    } else {
	$t_image = "$tipath$topicimage";
    }
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#ffffff\" width=\"100%\"><tr><td>\n"
	."<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" bgcolor=\"#DAD8D8\" width=\"100%\"><tr><td>\n"
	."<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" bgcolor=\"#EEEEEE\" width=\"100%\"><tr><td align=\"left\">\n"
	."<font class=\"option\" color=\"#363636\"><b>$title</b></font>\n"
	."</td></tr></table></td></tr></table>\n"
	."<b><a href=\"modules.php?name=News&amp;new_topic=$topic\"><img src=\"$t_image\" border=\"0\" Alt=\"$topictext\" align=\"right\" hspace=\"10\" vspace=\"10\"></a></B>\n";
    FormatStory($thetext, $notes, $aid, $informant);
    echo "</td></tr></table>\n"
	."<table background=\"themes/Anagram/images/column-bg.gif\" border=\"0\" cellpadding=\"1\" cellspacing=\"0\" width=\"100%\"><tr><td>\n"
	."<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" width=\"100%\"><tr><td align=\"center\">\n"
	."<font class=\"tiny\">"._POSTEDBY." ";
    formatAidHeader($aid);
    echo " "._ON." $time $timezone ($counter "._READS.")<br></font>\n"
	."<font class=\"content\">$morelink</font>\n"
	."</td></tr></table></td></tr></table>\n"
	."<br>\n\n\n";
}

/************************************************************/
/* Function themeindex()                                    */
/*                                                          */
/* This function format the stories on the story page, when */
/* you click on that "Read More..." link in the home        */
/************************************************************/

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext) {
    global $admin, $sid, $tipath, $admin_file;
    $ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
	$t_image = "themes/$ThemeSel/images/topics/$topicimage";
    } else {
	$t_image = "$tipath$topicimage";
    }
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#ffffff\" width=\"100%\"><tr><td>\n"
        ."<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" bgcolor=\"#DAD8D8\" width=\"100%\"><tr><td>\n"
        ."<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" bgcolor=\"#EEEEEE\" width=\"100%\"><tr><td align=\"left\">\n"
        ."<font class=\"option\" color=\"#363636\"><b>$title</b></font><br>\n"
        ."<font class=\"content\">"._POSTEDON." $datetime "._BY." ";
    formatAidHeader($aid);
    if (is_admin($admin)) {
	echo "<br>[ <a href=\"".$admin_file.".php?op=EditStory&amp;sid=$sid\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=RemoveStory&amp;sid=$sid\">"._DELETE."</a> ]\n";
    }
    echo "</td></tr></table></td></tr></table><br>";
    echo "<a href=\"modules.php?name=News&amp;new_topic=$topic\"><img src=\"$t_image\" border=\"0\" Alt=\"$topictext\" align=\"right\" hspace=\"10\" vspace=\"10\"></a>\n";
    FormatStory($thetext, $notes="", $aid, $informant);
    echo "</td></tr></table><br>\n\n\n";
}

/************************************************************/
/* Function themesidebox()                                  */
/*                                                          */
/* Control look of your blocks. Just simple.                */
/************************************************************/

function themesidebox($title, $content) {
    echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" width=\"150\">\n"
    ."<tr>\n"
    ."<td>\n"

	."<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" bgcolor=\"#EEEEEE\" width=\"100%\">\n"
	."<tr>\n"
	."<td align=left><font class=\"content\" color=\"#363636\"><b>$title</b></font></td>\n"
	."</tr>\n"
	."</table>\n"

	."</td>\n"
	."</tr>\n"
	."</table>\n"

	."<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" width=\"150\">\n"
	."<tr valign=\"top\"><td>\n"
	."$content\n"
	."</td></tr></table>\n"
	."<br>\n\n\n";
}

?>