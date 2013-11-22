<?php

#########################################################
# Sunset theme for PHPNuke 5.0                          #
# Translation by Ivan Stojmirov [stojmir@linux.net.mk]  #
# Originaly made by Francisco                           #
#########################################################



$thename = "Sunset";
$lnkcolor = "#035D8A";
$bgcolor1 = "#FFFFE6";
$bgcolor2 = "#006699";
$bgcolor3 = "#FFFFE6";
$bgcolor4 = "#FFC53A";
$textcolor1 = "FFFFFF";
$textcolor2 = "000000";
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
	echo "<font size=\"2\" color=\"#505050\">$thetext<br>$notes</font>\n";
    } else {
	if(!empty($informant)) {
	    $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
	} else {
	    $boxstuff = "$anonymous ";
	}
	$boxstuff .= ""._WRITES."  <i>\"$thetext\"</i> $notes\n";
	echo "<font size=\"2\" color=\"#505050\">$boxstuff</font>\n";
    }
}


function themeheader() {
    global $slogan, $sitename, $banners;
echo "<body bgcolor=\"#FFC53A\" text=\"#000000\" link=\"#035D8A\" vlink=\"#035D8A\">";
echo "<br><center><table border=0 width=100% cellpadding=3 cellspacing=0><tr><td>\n\n";
echo "<a href=$nuke_url><img src=themes/Sunset/images/logo.gif Alt=\""._WELCOMETO." $sitename\" border=0></a>\n";
echo "</td>\n";
echo "<td>";
ads(0);
echo "</td>";
echo "<td align=right>\n";
echo "<form action=modules.php?name=Search method=post><font size=2 color=000000>\n";
echo ""._SEARCH." \n";
echo "<input type=text name=query>\n";
echo "</form>\n";
echo "</td></tr></table>\n";
echo "<br>\n";
$public_msg = public_message();
echo "$public_msg<br>";
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td valign=top width=140>\n";

blocks("left");

echo "</td><td>&nbsp;</td><td valign=top width=100%>\n\n\n";
}

function themefooter() {
    if (defined('INDEX_FILE')) {
    echo "</td><td>&nbsp;</td><td valign=top width=200>\n";
	blocks("right");
	echo "</td>";
    }
    echo "</td></tr></table></td></tr></table>";
    footmsg();
}


function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
    global $anonymous, $tipath;
    $ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
	$t_image = "themes/$ThemeSel/images/topics/$topicimage";
    } else {
	$t_image = "$tipath$topicimage";
    }
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=035D8A><tr><td>\n";
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"5\" bgcolor=FFFFFF><tr><td>\n";
    echo "<a href=modules.php?name=News&amp;new_topic=$topic><img src=$t_image Alt=\"$topictext\" border=0 align=right></a>\n";
    echo "<img src=\"themes/Sunset/images/bullet.gif\" border=0 hspace=3><font size=3><b>$title</b></font><br>\n";
    echo "<font size=1 color=035D8A>"._POSTEDBY." ";
    formatAidHeader($aid);
    echo " "._ON." $time $timezone ($counter "._READS.")<br><br></font>\n";
    if ("$aid" == "$informant") {
	echo "<font size=2 color=000000>$thetext</font><br><br>\n";
    } else {
	if (!empty($informant)) {
	    $boxstuff = "<a href=modules.php?name=Your_Account&amp;op=userinfo&username=$informant>$informant</a> ";
	} else {
	    $boxstuff = "$anonymous ";
	}
	$boxstuff .= ""._WRITES." <i>\"$thetext\"</i> $notes\n";
	echo "<font size=2 color=000000>$boxstuff</font><br><br>\n";
    }
    echo "<font size=2>$morelink</font><br><img src=themes/Sunset/images/line.gif border=0 vspace=4>\n";
    echo "</td></tr></table>\n";
    echo "</td></tr></table>\n";
    echo "<br>\n\n\n";
}



function themearticle($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext) {
    global $admin, $sid, $tipath, $admin_file;
    $ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
	$t_image = "themes/$ThemeSel/images/topics/$topicimage";
    } else {
	$t_image = "$tipath$topicimage";
    }
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=035D8A><tr><td>\n";
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"5\" bgcolor=FFFFFF><tr><td>\n";
    echo "<a href=modules.php?name=News&amp;new_topic=$topic><img src=$t_image Alt=\"$topictext\" border=0 align=right></a>\n";
    echo "<img src=\"themes/Sunset/images/bullet.gif\" border=0 hspace=3><font size=2><b>$title</b></font>\n";
    if ($admin) {
	echo "&nbsp;&nbsp; [ <a href=".$admin_file.".php?op=EditStory&sid=$sid>"._EDIT."</a> | <a href=".$admin_file.".php?op=RemoveStory&sid=$sid>"._DELETE."</a> ]<br>\n";
    } else {
	echo "<br>\n";
    }
    echo "<font size=1 color=035D8A>"._POSTEDBY."";
    formatAidHeader($aid);
    echo " "._ON." $datetime<br>\n";
    if (!empty($informant)) {
        echo ""._CONTRIBUTEDBY." <a href=modules.php?name=Your_Account&amp;op=userinfo&username=$informant>$informant</a><br><br>\n";
    } else {
	echo ""._CONTRIBUTEDBY." $anonymous<br><br></font>\n";
    }
    echo "<font size=2 color=000000>$thetext</font><br><br>\n";
    echo "</td></tr></table>\n";
    echo "</td></tr></table>\n\n";
}



function themesidebox($title, $content) {
    mt_srand((double)microtime()*1000000);
    $rcolor = mt_rand(1, 4);
    if ($rcolor == 1) {
	$tcolor = "006699";
    } elseif ($rcolor == 2) {
	$tcolor = "941C31";
    } elseif ($rcolor == 3) {
	$tcolor = "009983";
    } elseif ($rcolor == 4) {
	$tcolor = "0066FF";
    }
    echo "<table width=\"165\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td>\n";
    echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr><td>\n";
    echo "<img src=\"themes/Sunset/images/left$rcolor.gif\" alt=\"\" border=\"0\" width=\"5\" height=\"19\"></td>\n";
    echo "<td bgcolor=$tcolor width=\"100%\"><b><font size=\"2\" color=\"#FFFFFF\">$title</font></b></td>\n";
    echo "<td align=\"right\"><img src=\"themes/Sunset/images/right$rcolor.gif\" alt=\"\" border=\"0\" width=\"5\" height=\"19\"></td></tr></table>\n";
    echo "</td></tr><tr><td align=\"center\" valign=\"top\">\n";
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\" bgcolor=$tcolor><tr><td width=100%>\n";
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\" bgcolor=$tcolor><tr><td width=\"100%\" valign=\"top\" bgcolor=\"#FFFFE6\">\n";
    echo "$content\n";
    echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr><td>\n";
    echo "<img src=\"pixel.gif\" width=\"1\" height=\"4\" alt=\"\" border=\"0\"></td></tr></table>\n";
    echo "</td></tr></table>\n";
    echo "</td></tr></table>\n";
    echo "</td></tr><tr>\n";
    echo "<td align=\"center\" valign=\"bottom\">\n";
    echo "<img width=\"100%\" height=\"5\" src=\"themes/Sunset/images/bottom$rcolor.gif\" vspace=\"0\" border=\"0\"></td></tr></table>\n";
    echo "<br>\n\n\n";
}

?>