<?php

$lnkcolor = "#336699";
$bgcolor1 = "#F6F6EB";
$bgcolor2 = "#D8D8C4";
$bgcolor3 = "#B7B78B";
$textcolor1 = "#000000";
$textcolor2 = "#000000";
$theme_home = "Web_Links";
$hr = 1; # 1 to have horizonal rule in comments instead of table bgcolor

function OpenTable() {
    global $bgcolor1, $bgcolor2;
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$bgcolor2\"><tr><td>\n";
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"8\" bgcolor=\"$bgcolor1\"><tr><td>\n";
}

function OpenTable2() {
    global $bgcolor1, $bgcolor2;
    echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$bgcolor2\" align=\"center\"><tr><td>\n";
    echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"8\" bgcolor=\"$bgcolor1\"><tr><td>\n";
}

function CloseTable() {
    echo "</td></tr></table></td></tr></table>\n";
}

function CloseTable2() {
    echo "</td></tr></table></td></tr></table>\n";
}

function FormatStory($thetext, $notes, $aid, $informant) {
    global $anonymous;
    if (!empty($notes)) {
	$notes = "<b>"._NOTE."</b> <i>$notes</i>\n";
    } else {
	$notes = "";
    }
    if ("$aid" == "$informant") {
	echo "<font size=\"2\">$thetext<br>$notes</font>\n";
    } else {
	if(!empty($informant)) {
	    $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
	} else {
	    $boxstuff = "$anonymous ";
	}
	$boxstuff .= ""._WRITES." <i>\"$thetext\"</i> $notes\n";
	echo "<font size=\"2\">$boxstuff</font>\n";
    }
}

function themeheader() {
    global $prefix, $db, $user, $cookie, $bgcolor1, $bgcolor2, $bgcolor3, $banners, $sitename, $anonymous, $user;
    echo "<body bgcolor=\"$bgcolor1\">";
	ads(0);
    if (is_user($user)) {
	cookiedecode($user);
	$username = $cookie[1];
	$bienvenida = "Hello $username! [ <a href=\"modules.php?name=Your_Account&amp;op=logout\"><b>Logout</b></a> ]";
    } else {
	$bienvenida = "<a href=\"modules.php?name=Your_Account&amp;op=new_user\">Create an Account</a>";
    }
    $topics_list = "<select name=\"topic\" onChange='submit()'>\n";
    $topics_list .= "<option value=\"\">All Topics</option>\n";
    $toplist = $db->sql_query("select topicid, topictext from $prefix"._topics." order by topictext");
    while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
	$topicid = intval($topicid);
    if ($topicid==$topic) { $sel = "selected "; }
	$topics_list .= "<option $sel value=\"$topicid\">$topics</option>\n";
	$sel = "";
    }
    echo "<center><a href=\"index.php\"><img src=\"themes/Sand_Journey/images/LogoLeft.gif\" alt=\"Welcome to $sitename\" title=\"Welcome to $sitename\" border=\"0\"></a><br><br></center>"
	."<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\" align=\"center\" bgcolor=\"$bgcolor1\"><tr><td align=\"center\">"
	."<form action=\"modules.php?name=Search\" method=\"post\">"
	."<font class=\"content\"><b>Search</b> <input type=\"text\" size=\"15\" name=\"query\">&nbsp;&nbsp;<b>in</b>&nbsp;&nbsp;$topics_list</font>"
	."</select>"
	."</form>"
	."</td></tr></table>"
	."<br>"
	."<table border=\"0 cellpadding=\"4\" cellspacing=\"0\" width=\"100%\" align=\"center\">\n"
	."<tr><td bgcolor=\"$bgcolor2\" align=\"left\" width=\"20%\">&nbsp;$bienvenida</td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\" width=\"60%\"><a href=\"index.php\">Home</a> | <a href=\"modules.php?name=Submit_News\">Submit News</a> | <a href=\"modules.php?name=Your_Account\">Your Account</a> | <a href=\"modules.php?name=Content\">Content</a> | <a href=\"modules.php?name=Topics\">Topics</a> | <a href=\"modules.php?name=Top\">Top 10</a></td>\n"
	."<td bgcolor=\"$bgcolor2\" align=\"right\" width=\"20%\">"
        ."<b><script type=\"text/javascript\">\n\n"
        ."<!--   // Array ofmonth Names\n"
        ."var monthNames = new Array( \""._JANUARY."\",\""._FEBRUARY."\",\""._MARCH."\",\""._APRIL."\",\""._MAY."\",\""._JUNE."\",\""._JULY."\",\""._AUGUST."\",\""._SEPTEMBER."\",\""._OCTOBER."\",\""._NOVEMBER."\",\""._DECEMBER."\");\n"
        ."var now = new Date();\n"
        ."thisYear = now.getYear();\n"
        ."if(thisYear < 1900) {thisYear += 1900}; // corrections if Y2K display problem\n"
        ."document.write(monthNames[now.getMonth()] + \" \" + now.getDate() + \", \" + thisYear);\n"
        ."// -->\n\n"
        ."</script></b>&nbsp;\n"
	."</td></tr>\n"
        ."<tr><td valign=\"top\" width=\"100%\" colspan=3>\n"
;
	$public_msg = public_message();
        echo "$public_msg<br>";
	echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"2\" width=\"100%\"><tr><td valign=\"top\" width=\"150\" bgcolor=$bgcolor1>";
	blocks("left");
	echo "<img src=\"images/pix.gif\" border=\"0\" width=\"150\" height=\"1\"></td><td>&nbsp;&nbsp;</td><td width=\"100%\" valign=\"top\">";
}

function themefooter() {
    global $bgcolor1, $bgcolor2, $bgcolor3;
    if (defined('INDEX_FILE')) {
	echo "</td><td>&nbsp;&nbsp;</td><td valign=\"top\" bgcolor=$bgcolor1>";
	blocks("right");
	echo "</td>";
    }
    echo "</td></tr></table></td></tr></table>";
    echo "<center>";
    footmsg();
    echo "</center>";
}

function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
    global $tipath, $anonymous, $bgcolor1, $bgcolor2, $bgcolor3;
    $ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
	$t_image = "themes/$ThemeSel/images/topics/$topicimage";
    } else {
	$t_image = "$tipath$topicimage";
    }
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" bgcolor=$bgcolor3 width=\"100%\"><tr><td>"
        ."<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" width=\"100%\"><tr><td bgcolor=$bgcolor2>"
        ."<font class=\"title\">$title</font><br>"
        ."<font size=\"1\">"
	."$time "._BY." "
        ."<b>";
    formatAidHeader($aid);
    echo "</b> ($counter "._READS.")</font></td></tr>"
	."<tr><td bgcolor=$bgcolor1><a href=\"modules.php?name=News&amp;new_topic=$topic\"><img src=\"$t_image\" align=\"right\" border=\"0\" alt=\"$topictext\" title=\"$topictext\"></a>";
    FormatStory($thetext, $notes, $aid, $informant);
    echo "<br>"
        ."</td></tr><tr><td bgcolor=$bgcolor1 align=\"right\">"
        ."<font size=\"2\">$morelink</font>"
        ."</td></tr></table></td></tr></table>"
	."<br>";
}

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext) {
    global $admin, $sid, $tipath, $bgcolor1, $bgcolor2, $bgcolor3;
    $ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
	$t_image = "themes/$ThemeSel/images/topics/$topicimage";
    } else {
	$t_image = "$tipath$topicimage";
    }
    if ("$aid" == "$informant") {
	echo"
	<table border=0 cellpadding=0 cellspacing=0 align=center bgcolor=$bgcolor3 width=100%><tr><td>
	<table border=0 cellpadding=3 cellspacing=1 width=100%><tr><td bgcolor=$bgcolor2>
	<font class=\"title\">$title</font><br>"._POSTEDON." $datetime
	<br>"._TOPIC.": <a href=modules.php?name=News&amp;new_topic=$topic>$topictext</a>
	</td></tr><tr><td bgcolor=$bgcolor1>
	<a href=\"modules.php?name=News&amp;new_topic=$topic\"><img src=\"$t_image\" border=\"0\" alt=\"$topictext\" title=\"$topictext\" align=\"right\"></a>$thetext
	</td></tr></table></td></tr></table><br>";
    } else {
	if(!empty($informant)) $informant = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&username=$informant\">$informant</a> ";
	else $boxstuff = "$anonymous ";
	$boxstuff .= ""._WRITES." <i>\"$thetext\"</i> $notes";
	echo "
	<table border=0 cellpadding=0 cellspacing=0 align=center bgcolor=$bgcolor3 width=100%><tr><td>
	<table border=0 cellpadding=3 cellspacing=1 width=100%><tr><td bgcolor=$bgcolor2>
	<font class=\"title\">$title</b></font><p>"._CONTRIBUTEDBY." $informant "._ON." $datetime</font>
	</td></tr><tr><td bgcolor=$bgcolor1>
	<a href=\"modules.php?name=News&amp;new_topic=$topic\"><img src=\"$t_image\" border=\"0\" alt=\"$topictext\" title=\"$topictext\" align=\"right\"></a>$thetext
	</td></tr></table></td></tr></table><br>";
    }
}

function themesidebox($title, $content) {
    global $bgcolor1, $bgcolor2, $bgcolor3;
    echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"150\" bgcolor=\"$bgcolor3\">\n"
	."<tr><td>\n"
        ."<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">\n"
	."<tr><td bgcolor=$bgcolor2>"
        ."<font class=\"boxtitle\">$title</font></td></tr><tr><td bgcolor=\"$bgcolor1\"><font size=\"2\">"
        ."$content"
	."</font></td></tr></table></td></tr></table><br>";
}

?>