<?php

$bgcolor1 = "#ffffff";
$bgcolor2 = "#cccccc";
$bgcolor3 = "#ffffff";
$bgcolor4 = "#eeeeee";
$textcolor1 = "#ffffff";
$textcolor2 = "#000000";

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
		echo "<font class=\"content\">$thetext<br>$notes</font>\n";
	} else {
		if(!empty($informant)) {
			$boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
		} else {
			$boxstuff = "$anonymous ";
		}
		$boxstuff .= ""._WRITES." <i>\"$thetext\"</i> $notes\n";
		echo "<font class=\"content\">$boxstuff</font>\n";
	}
}

function themeheader() {
	echo "<body bgcolor=\"ffffff\" text=\"000000\" link=\"0000ff\" vlink=\"0000ff\">"
	."<br>";
	ads(0);
	echo "<br>"
	."<table border=\"0 cellpadding=\"4\" cellspacing=\"0\" width=\"100%\" align=\"center\"><tr><td bgcolor=\"ffffff\">"
	."<table border=\"0\" cellspacing=\"0\" cellpadding=\"3\" width=\"100%\" bgcolor=\"ffffff\"><tr><td>"
	."<a href=\"index.php\"><img src=\"themes/ExtraLite/images/logo.gif\" alt=\"Welcome to $sitename\" title=\"Welcome to $sitename\" border=\"0\"></a>"
	."</td><td align=\"right\">"
	."<form action=\"modules.php?name=Search\" method=\"post\">"
	."<font class=\"content\">Search"
	."<input type=\"text\" name=\"query\">"
	."</font></form>"
	."</td></tr></table></td></tr><tr><td valign=\"top\" width=\"100%\" bgcolor=\"ffffff\">";
	$public_msg = public_message();
	echo "$public_msg<br>";
	echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"2\" width=\"100%\"><tr><td valign=\"top\" width=\"150\" bgcolor=\"ffffff\">";
	blocks("left");
	echo "<img src=\"images/pix.gif\" border=\"0\" width=\"150\" height=\"1\"></td><td>&nbsp;&nbsp;</td><td width=\"100%\" valign=\"top\">";
}

function themefooter() {
	if (defined('INDEX_FILE')) {
		echo "</td><td>&nbsp;&nbsp;</td><td valign=\"top\" bgcolor=\"#ffffff\">";
		blocks("right");
		echo "</td>";
	}
	echo "</td></tr></table></td></tr></table>";
	footmsg();
}

function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
	global $anonymous;
	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" bgcolor=\"000000\" width=\"100%\"><tr><td>"
	."<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" width=\"100%\"><tr><td bgcolor=\"ffffff\">"
	."<b>$title</b><br>"
	."<font class=\"tiny\">"
	.""._POSTEDBY." <b>";
	formatAidHeader($aid);
	echo "</b> "._ON." $time $timezone ($counter "._READS.")<br>"
	."<b>"._TOPIC."</b> <a href=\"modules.php?name=News&amp;new_topic=$topic\">$topictext</a><br>"
	."</font></td></tr><tr><td bgcolor=\"ffffff\">";
	FormatStory($thetext, $notes, $aid, $informant);
	echo "<br><br>"
	."</td></tr><tr><td bgcolor=\"ffffff\" align=\"right\">"
	."<font class=\"content\">$morelink</font>"
	."</td></tr></table></td></tr></table>"
	."<br>";
}

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext) {
	global $admin, $sid, $admin_file;
	if ("$aid" == "$informant") {
		echo"
	<table border=0 cellpadding=0 cellspacing=0 align=center bgcolor=000000 width=100%><tr><td>
	<table border=0 cellpadding=3 cellspacing=1 width=100%><tr><td bgcolor=FFFFFF>
	<b>$title</b><br><font class=tiny>Posted on $datetime";
		if ($admin) {
			echo "&nbsp;&nbsp; $font2 [ <a href=".$admin_file.".php?op=EditStory&sid=$sid>Edit</a> | <a href=".$admin_file.".php?op=RemoveStory&sid=$sid>Delete</a> ]";
		}
		echo "
	<br>Topic: <a href=modules.php?name=News&amp;new_topic=$topic>$topictext</a>
	</td></tr><tr><td bgcolor=ffffff>
	$thetext
	</td></tr></table></td></tr></table><br>";
	} else {
		if(!empty($informant)) $informant = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&username=$informant\">$informant</a> ";
		else $boxstuff = "$anonymous ";
		$boxstuff .= "writes <i>\"$thetext\"</i> $notes";
		echo "
	<table border=0 cellpadding=0 cellspacing=0 align=center bgcolor=000000 width=100%><tr><td>
	<table border=0 cellpadding=3 cellspacing=1 width=100%><tr><td bgcolor=FFFFFF>
	<b>$title</b><br><font class=content>Contributed by $informant on $datetime</font>";
		if ($admin) {
			echo "&nbsp;&nbsp; $font2 [ <a href=".$admin_file.".php?op=EditStory&sid=$sid>Edit</a> | <a href=".$admin_file.".php?op=RemoveStory&sid=$sid>Delete</a> ]";
		}
		echo "
	<br>Topic: <a href=modules.php?name=News&amp;new_topic=$topic>$topictext</a>
	</td></tr><tr><td bgcolor=ffffff>
	$thetext
	</td></tr></table></td></tr></table><br>";
	}
}

function themesidebox($title, $content) {
	echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"150\" bgcolor=\"000000\"><tr><td>"
	."<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\"><tr><td bgcolor=\"ffffff\">"
	."<font class=\"content\">$title</font></td></tr><tr><td bgcolor=\"ffffff\"><font class=\"content\">"
	."$content"
	."</font></td></tr></table></td></tr></table><br>";
}

?>