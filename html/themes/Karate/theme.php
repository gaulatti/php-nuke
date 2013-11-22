<?php

/************************************************************/
/* THEME NAME: Karate                                       */
/* THEME DEVELOPER: Somara Sem (http://www.somara.com)      */
/* LAST MODIFIED: 09/19/2001 by dezina.com                  */
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

$bgcolor1 = "#efefef";
$bgcolor2 = "#EFCE6B";
$bgcolor3 = "#efefef";
$bgcolor4 = "#EFCE6B";
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
	echo "<font class=\"content\" color=\"#505050\">$thetext$notes</font>\n";
    } else {
	if(!empty($informant)) {
	    $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
	} else {
	    $boxstuff = "$anonymous ";
	}
	$boxstuff .= ""._WRITES." <i>\"$thetext\"</i>$notes\n";
	echo "<font class=\"content\" color=\"#505050\">$boxstuff</font>\n";
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
    global $user, $banners, $sitename, $slogan, $cookie, $prefix, $db, $anonymous;
    cookiedecode($user);
    $username = $cookie[1];
    if (empty($username)) {
        $username = "$anonymous";
    }
    echo "<body bgcolor=\"#ffffff\" text=\"#000000\" link=\"#363636\" vlink=\"#363636\" alink=\"#d5ae83\">\n"
	."<br>\n";
	ads(0);
    echo "<br>\n"
	."<table cellpadding=\"0\" cellspacing=\"0\" width=\"750\" border=\"0\" align=\"center\" bgcolor=\"#ffffff\">\n"
	."<tr>\n"
	."<td bgcolor=\"#ffffff\" width=\"306\">\n"
	."<a href=\"index.php\"><img src=\"themes/Karate/images/logo.gif\" align=\"left\" alt=\""._WELCOMETO." $sitename\" border=\"0\"></a></td>\n"
	."</tr>\n"
	."</table><br>\n"
	."<table cellpadding=\"0\" cellspacing=\"0\" width=\"750\" border=\"0\" align=\"center\" bgcolor=\"#ffffff\">\n"
	."<tr>\n"
	."<td bgcolor=\"#F3E1AF\">\n"
	."<img src=\"themes/Karate/images/tophighlight.gif\"></td>\n"
	."</tr>\n"
	."</table>\n"
	."<table cellpadding=\"0\" cellspacing=\"0\" width=\"750\" border=\"0\" align=\"center\" bgcolor=\"#ffffff\">\n"
	."<tr valign=\"middle\">\n"
	."<td width=\"400\" bgcolor=\"#F3E1AF\" align=\"left\">\n"
	."&nbsp;</td>\n"
	."<td bgcolor=\"#F3E1AF\" align=\"center\">\n"
	."<form action=\"modules.php?name=Search\" method=\"post\"><font class=\"content\" color=\"#000000\"><b>"._SEARCH." </b>\n"
	."<input type=\"text\" name=\"query\" size=\"14\"></font></form></td>\n"
	."<td bgcolor=\"#F3E1AF\" align=\"center\">\n"
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
	."<table cellpadding=\"0\" cellspacing=\"0\" width=\"750\" border=\"0\" align=\"center\" bgcolor=\"#fefefe\">\n"
	."<tr>\n"
	."<td bgcolor=\"#000000\" colspan=\"4\"><IMG src=\"themes/Karate/images/pixel.gif\" width=\"1\" height=1 alt=\"\" border=\"0\" hspace=\"0\"></td>\n"
	."</tr>\n"
	."<tr valign=\"middle\" bgcolor=\"#EFCE6B\">\n"
	."<td width=\"15%\" nowrap><font class=\"content\" color=\"#363636\">\n";
    if ($username == "$anonymous") {
	echo "&nbsp;&nbsp;<font color=\"#363636\"><a href=\"modules.php?name=Your_Account\">"._LOGINCREATE."</a></font>\n";
    } else {
	echo "&nbsp;&nbsp;"._HELLO." $username! &nbsp;&nbsp;<a href=\"modules.php?name=Your_Account&amp;op=logout\">logout</a>";
    }
    echo "</font></td>\n"
	."<td align=\"center\" height=\"20\" width=\"60%\"><font class=\"content\">\n"
        ."&nbsp;\n"
        ."</td>\n"
        ."<td align=\"right\" width=\"25%\"><font class=\"content\">\n"
        ."<script type=\"text/javascript\">\n\n"
        ."<!--   // Array ofmonth Names\n"
        ."var monthNames = new Array( \"January\",\"February\",\"March\",\"April\",\"May\",\"June\",\"July\",\"August\",\"September\",\"October\",\"November\",\"December\");\n"
        ."var now = new Date();\n"
        ."thisYear = now.getYear();\n"
        ."if(thisYear < 1900) {thisYear += 1900}; // corrections if Y2K display problem\n"
        ."document.write(monthNames[now.getMonth()] + \" \" + now.getDate() + \", \" + thisYear);\n"
        ."// -->\n\n"
        ."</script></font></td>\n"
        ."<td>&nbsp;</td>\n"
        ."</tr>\n"
        ."<tr>\n"
        ."<td bgcolor=\"#000000\" colspan=\"4\"><IMG src=\"themes/Karate/images/pixel.gif\" width=\"1\" height=\"1\" alt=\"\" border=\"0\" hspace=\"0\"></td>\n"
        ."</tr>\n"
        ."</table>\n"
	."<!-- FIN DEL TITULO -->\n"
	."<table width=\"750\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" bgcolor=\"#ffffff\" align=\"center\">\n"
	."<tr valign=\"top\">\n"
	."<td bgcolor=\"#F3E1AF\"><img src=\"themes/Karate/images/pixel.gif\" width=\"1\" height=\"3\" border=\"0\" alt=\"\"></td>\n"
	."</tr>\n"
	."<tr valign=\"top\">\n"
	."<td bgcolor=\"#ffffff\"><img src=\"themes/Karate/images/pixel.gif\" width=\"1\" height=\"5\" border=\"0\" alt=\"\"></td>\n"
	."</tr>\n"
	."</table>\n"
;
	$public_msg = public_message();
        echo "$public_msg<br>";
	echo "<table width=\"750\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" bgcolor=\"#ffffff\" align=\"center\"><tr valign=\"top\">\n"
	."<td bgcolor=\"#eeeeee\" width=\"150\" valign=\"top\">\n";
    blocks("left");
    echo "</td><td><img src=\"themes/Karate/images/pixel.gif\" width=\"15\" height=\"1\" border=\"0\" alt=\"\"></td><td width=\"100%\">\n";
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
	echo "</td><td><img src=\"themes/Karate/images/pixel.gif\" width=\"15\" height=\"1\" border=\"0\" alt=\"\"></td><td valign=\"top\" width=\"150\" bgcolor=\"#eeeeee\">\n";
	blocks("right");
    }
    echo "</td>\n"
	."</tr></table>\n"
        ."<table bgcolor=\"#000000\" width=\"750\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n"
        ."<tr>\n"
        ."<td width=\"750\" height=\"5\"><img src=\"themes/Karate/images/bottombar.gif\" width=\"750\" height=\"5\" border=\"0\" alt=\"\"></td>\n"
        ."</tr>\n"
        ."<tr>\n"
        ."<td width=\"100%\"><img src=\"themes/Karate/images/pixel.gif\" width=\"1\" height=\"1\" border=\"0\" alt=\"\"></td>\n"
        ."</tr>\n"
        ."</table>\n"
        ."<br>\n"
        ."<br>\n"
        ."<table width=\"750\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n"
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
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#ffffff\" width=\"420\"><tr><td>\n"
	."<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" bgcolor=\"#000000\" width=\"100%\"><tr><td>\n"
	."<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" bgcolor=\"#F3E1AF\" width=\"100%\"><tr><td align=\"left\">\n"
	."<font class=\"option\" color=\"#363636\"><b>$title</b></font>\n"
	."</td></tr></table></td></tr></table>\n"
	."<font color=\"#999999\"><b><a href=\"modules.php?name=News&amp;new_topic=$topic\"><img src=\"$t_image\" border=\"0\" Alt=\"$topictext\" align=\"right\" hspace=\"10\" vspace=\"10\"></a></B></font>\n";
    FormatStory($thetext, $notes, $aid, $informant);
    echo "</td></tr></table><br>\n"
	."<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" bgcolor=\"#eeeeee\" width=\"100%\"><tr><td>\n"
	."<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" bgcolor=\"#ffffff\" width=\"100%\"><tr><td align=\"center\">\n"
	."<font color=\"#999999\" size=\"1\">"._POSTEDBY." ";
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
        ."<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" bgcolor=\"#000000\" width=\"100%\"><tr><td>\n"
        ."<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" bgcolor=\"#EFCE6B\" width=\"100%\"><tr><td align=\"left\">\n"
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
    echo "<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" bgcolor=\"#000000\" width=\"150\"><tr><td>\n"
	."<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" bgcolor=\"#F3E1AF\" width=\"100%\"><tr><td align=left>\n"
	."<font class=\"content\" color=\"#363636\"><b>$title</b></font>\n"
	."</td></tr></table></td></tr></table>\n"
	."<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" width=\"150\">\n"
	."<tr valign=\"top\"><td>\n"
	."$content\n"
	."</td></tr></table>\n"
	."<br>\n\n\n";
}

?>