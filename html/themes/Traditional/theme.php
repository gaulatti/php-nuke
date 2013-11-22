<?php

$thename = "Cuadriculado";
$bgcolor1 = "#cccccc";
$bgcolor2 = "#999999";
$bgcolor3 = "#cccccc";
$textcolor1 = "#ffffff";
$textcolor2 = "#000000";

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

function themeheader() {
	echo "<body bgcolor=\"#FFFFFF\" text=\"#000000\" link=\"#000000\" vlink=\"#000000\">"
	."<br>";
	ads(0);
	echo "<br>"
	."<table border=\"0\" cellspacing=\"0\" cellpadding=\"3\" width=\"100%\" bgcolor=\"FFFFFF\">"
	."<tr><td width=\"100%\">"
	."<a href=\"index.php\"><img src=\"themes/Traditional/images/logo.gif\" alt=\""._WELCOMETO." $sitename\" border=\"0\"></a>"
	."</td><td align=\"right\">"
	."<form action=\"modules.php?name=Search\" method=\"post\">"
	."<input type=\"text\" name=\"query\" width=\"20\" size=\"15\" length=\"20\">"
	."</td>"
	."<td width=\"60\" align=\"left\"><input type=\"submit\" value=\""._SEARCH."\"></td>"
	."</tr></table></form>"
	."<br>";
	$public_msg = public_message();
	echo "$public_msg<br>";
	echo "<table border=\"0\" width=\"100%\" cellspacing=\"5\"><tr><td valign=\"top\">";
}

function themefooter() {
	if (defined('INDEX_FILE')) {
		echo "<td>&nbsp;</td><td valign=\"top\" width=\"200\">";
		blocks("left");
		blocks("right");
	}
	echo "</td></tr></table></td></tr></table>";
	echo "<center>";
	footmsg();
	echo "</center>";
}

function themesidebox($title, $content) {
	echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"200\" bgcolor=\"#000000\"><tr><td>"
	."<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"3\"><tr><td bgcolor=\"#cccccc\">"
	."<img src=\"themes/Traditional/images/tic.gif\" border=\"0\" alt=\"\">"
	."<font class=\"option\">$title</font></td></tr>"
	."<tr><td bgcolor=\"#ffffff\">"
	."<font class=\"content\">$content</font>"
	."</td></tr></table></td></tr></table>"
	."<br>";
}



function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
	global $anonymous, $tipath;
	$ThemeSel = get_theme();
	if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
		$t_image = "themes/$ThemeSel/images/topics/$topicimage";
	} else {
		$t_image = "$tipath$topicimage";
	}
	if ("$aid" == "$informant") { ?>


<table border=0 cellpadding=3 cellspacing=1 width=100%>
	<tr>
		<td bgcolor=CCCCCC><font class=title> <b><?php echo"$title"; ?></b><br></td>
	</tr>
	<tr>
		<td bgcolor=FFFFFF><a
			href="modules.php?name=News&amp;new_topic=<?php echo"$topic"; ?>&author="><img
			src=<?php echo"$t_image"; ?> border=0
			Alt=<?php echo"\"$topictext\""; ?> align=right hspace=10 vspace=10></a>
		<font class=tiny> Posted by <b><?php formatAidHeader($aid); echo "$aid"; ?></b>
		on <?php echo"$time $timezone"; ?><br>
		(<?php echo $counter; ?> reads) </font><br>
		<br>
		<font class=content> <?php echo"$thetext<br><br></font>
</td></tr><tr><td align=left>
<font class=content>$morelink"; ?></font></td>
	</tr>
</table>
<br>


	<?php	} else {
		if(!empty($informant)) $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&username=$informant\">$informant</a> ";
		else $boxstuff = "$anonymous ";
		$boxstuff .= "writes <i>\"$thetext\"</i> $notes";
		?>

<table border=0 cellpadding=3 cellspacing=1 width=100%>
	<tr>
		<td bgcolor=CCCCCC><font class=title> <b><?php echo"$title"; ?></b><br>
		<font class=option></td>
	</tr>
	<tr>
		<td bgcolor=FFFFFF><a
			href="modules.php?name=News&amp;new_topic=<?php echo"$topic"; ?>&author="><img
			src=<?php echo"$t_image"; ?> border=0
			Alt=<?php echo"\"$topictext\""; ?> align=right hspace=10 vspace=10></a>
		<font class=option> Posted by <?php formatAidHeader($aid); ?> on <?php echo"$time $timezone"; ?><br>
		(<?php echo $counter; ?> reads) <br>
		<br>
		</font> <font class=content> <?php echo"$boxstuff<br><br></font>
</td></tr><tr><td align=left>
<font class=option>$morelink"; ?></font></td>
	</tr>
</table>
<br>

		<?php	}
}

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext) {
	global $admin, $sid, $tipath, $admin_file;
	$ThemeSel = get_theme();
	if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
		$t_image = "themes/$ThemeSel/images/topics/$topicimage";
	} else {
		$t_image = "$tipath$topicimage";
	}
	if ("$aid" == "$informant") {
		echo"

<table border=0 cellpadding=0 cellspacing=0 align=center bgcolor=000000 width=100%>
<tr><td>

<table border=0 cellpadding=3 cellspacing=1 width=100%>
<tr><td bgcolor=CCCCCC>
		$font2
<b>$title</b><br>$font2 Enviado el $datetime
";
		if ($admin) {
			echo "&nbsp;&nbsp; $font2 [ <a href=".$admin_file.".php?op=EditStory&sid=$sid>Edit</a> | <a href=".$admin_file.".php?op=RemoveStory&sid=$sid>Delete</a> ]";
		}
		echo "
</td>
</tr>
<tr>
<td bgcolor=ffffff>
<a href=modules.php?name=News&amp;new_topic=$topic><img src=$t_image border=0 Alt=\"$topictext\" align=right hspace=10 vspace=10></a>
		$thetext
</td>
</tr>
</table>
</td>
</tr>
</table><br>
";

	} else {
		if(!empty($informant)) $informant = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&username=$informant\">$informant</a> ";
		else $boxstuff = "$anonymous ";
		$boxstuff .= "writes <i>\"$thetext\"</i> $notes";
		echo "

<table border=0 cellpadding=0 cellspacing=0 align=center bgcolor=000000 width=100%>
<tr><td>
<table border=0 cellpadding=3 cellspacing=1 width=100%>
<tr><td bgcolor=CCCCCC>
		$font3
<b>$title</b><br>$font2 Contributed by $informant on $datetime</font>
";
		if ($admin) {
			echo "&nbsp;&nbsp; $font2 [ <a href=".$admin_file.".php?op=EditStory&sid=$sid>Edit</a> | <a href=".$admin_file.".php?op=RemoveStory&sid=$sid>Delete</a> ]";
		}
		echo "
</td>
</tr>
<tr>
<td bgcolor=ffffff>
<a href=modules.php?name=News&amp;new_topic=$topic><img src=$t_image border=0 Alt=\"$topictext\" align=right hspace=10 vspace=10></a>
		$font3 $thetext
</td>
</tr>
</table>
</td>
</tr>
</table><br>
";

	}
}

?>