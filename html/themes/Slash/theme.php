<?php

$bgcolor1 = "#FFFFFF";
$bgcolor2 = "#660000";
$bgcolor3 = "#e6e6e6";
$bgcolor4 = "#660000";
$textcolor1 = "#FFFFFF";
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
    global $slogan, $sitename;
	echo "<body bgcolor=DDDDDD text=222222 link=660000 vlink=222222>
	<br>";
	ads(0);
	echo "<br>
	<center>
	<table cellpadding=0 cellspacing=0 border=0 width=99% align=center><tr><td align=left>
	<a href=$nukeurl><img src=themes/Slash/images/logo.gif border=0></a>
	</td><td align=right width=100%>
	    <form action=modules.php?name=Search&amp;method=post>
	    <font class=content><input type=text name=query width=20 size=20 length=20>
	    </td>
	    <td align=right>&nbsp;&nbsp;<input type=submit value=\""._SEARCH."\"></td>
	    </form>";
	    echo "</td></tr></table><br>";
	echo "
	<table cellpadding=0 cellspacing=1 border=0 width=99% bgcolor=660000><tr><td>
	<table cellpadding=5 cellspacing=1 border=0 width=100% bgcolor=FFFFFF><tr><td>
	<font class=content>$slogan</td></tr></table></td></tr></table>";
	    $public_msg = public_message();
	    echo "$public_msg<br>";	
	echo "<table width=99% align=center cellpadding=0 cellspacing=0 border=0><tr><td valign=top rowspan=5>";
	blocks("left");
	echo "</td><td>&nbsp;</td><td valign=top width=100%>";
}

function themefooter() {
if (defined('INDEX_FILE')) {
    echo "<td>&nbsp;</td><td valign=\"top\">";
    blocks("right");
    echo "</td>";
}
echo "</tr></table></td></tr></table>";
footmsg();
}

function themeindex ($aid, $informant, $datetime, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
	global $anonymous, $tipath;
    $ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
	$t_image = "themes/$ThemeSel/images/topics/$topicimage";
    } else {
	$t_image = "$tipath$topicimage";
    }
	if ("$aid" == "$informant") { ?>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DDDDDD"><tr valign="top" bgcolor="#660000">
			<td><img src="themes/Slash/images/cl.gif" width="7" height="10" alt=""><img src="themes/Slash/images/pix.gif" width="4" height="4" alt=""></td>
			<td width="100%">
			<table width="100%" border="0" cellpadding="2" cellspacing="0"><tr><td>
			<font class="option" color="#FFFFFF"><B><?php echo"$title"; ?></B></font>
			</td></tr></table>
			</td><td align="right"><img src="themes/Slash/images/pix.gif" width="4" height="4" alt=""><img src="themes/Slash/images/cr.gif" width="7" height="10" alt=""></td>
         	</tr></table>
		<table border="0" cellpadding="0" cellspacing="0"><tr bgcolor="#e6e6e6">
			<td background="themes/Slash/images/gl.gif"><img src="themes/Slash/images/pix.gif" width="11" height="11" alt=""></td>
			<td width="100%">
				<table width="100%" border="0" cellpadding="5" cellspacing="0"><tr>
				<td><font class="tiny">Posted by <?php formatAidHeader($aid) ?> on <?php echo"$datetime $timezone"; ?> (<?php echo $counter; ?> reads)</font></td>
				</tr></table>
			</td>
			<td background="themes/Slash/images/gr.gif"><img src="themes/Slash/images/pix.gif" width="11" height="11" alt=""></td>
		</tr>
		<tr bgcolor="#006666"><td colspan="3"><img src="themes/Slash/images/pix.gif" width="1" height="1"></td></tr>
		<tr bgcolor="#ffffff">
			<td background="themes/Slash/images/wl.gif"><img src="themes/Slash/images/pix.gif" width="11" height="11" alt=""></td>
			<td width="100%"><table width="100%" border="0" cellpadding="5" cellspacing="0"><tr><td>
			
			<a href="modules.php?name=News&amp;new_topic=<?php echo"$topic"; ?>&author="><img src=<?php echo"$t_image"; ?> border=0 Alt=<?php echo"\"$topictext\""; ?> align=right hspace=10 vspace=10></a>
			
			<?php echo "$thetext"; ?>
                 </td></tr></table></td>
                 <td background="themes/Slash/images/wr.gif"><img src="themes/Slash/images/pix.gif" width="11" height="11" alt=""></td>
		</tr>
		<tr bgcolor="#660000"><td colspan="3"><img src="themes/Slash/images/pix.gif" width="1" height="1"></td></tr>
		</table><table border="0" cellpadding="0" cellspacing="0">
		<tr bgcolor="#ffffff">
			<td background="themes/Slash/images/wl_cccccc.gif"><img src="themes/Slash/images/pix.gif" width="11" height="11" alt=""></td>
			<td width="100%">
			<table width="100%" border="0" cellpadding="5" cellspacing="0"> 
			<tr><td bgcolor="#cccccc"><font class="content"><?php echo"$morelink"; ?></font></td></tr></table>
			</td>
			<td background="themes/Slash/images/wr_cccccc.gif"><img src="themes/Slash/images/pix.gif" width="11" height="11" alt=""></td>
		</tr>
		<tr bgcolor="#660000"><td colspan="3"><img src="themes/Slash/images/pix.gif" width="1" height="1"></td></tr>
		</table><BR><BR>
<?php	} else {
		if(!empty($informant)) $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&username=$informant\">$informant</a> ";
		else $boxstuff = "$anonymous ";
		$boxstuff .= "writes <i>\"$thetext\"</i> $notes";
?>		<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DDDDDD"><tr valign="top" bgcolor="#660000">
			<td><img src="themes/Slash/images/cl.gif" width="7" height="10" alt=""><img src="themes/Slash/images/pix.gif" width="4" height="4" alt=""></td>
			<td width="100%"><table width="100%" border="0" cellpadding="2" cellspacing="0"><tr><td>
			<font class="option" color="#FFFFFF"><B><?php echo"$title"; ?></B></font>
			</td></tr></table></td>
                 	<td align="right"><img src="themes/Slash/images/pix.gif" width="4" height="4" alt=""><img src="themes/Slash/images/cr.gif" width="7" height="10" alt=""></td>
         	</tr></table>
		<table border="0" cellpadding="0" cellspacing="0"><tr bgcolor="#e6e6e6">
			<td background="themes/Slash/images/gl.gif"><img src="themes/Slash/images/pix.gif" width="11" height="11" alt=""></td>
			<td width="100%">
				<table width="100%" border="0" cellpadding="5" cellspacing="0"><tr>
				<td><font class="tiny">Posted by <?php formatAidHeader($aid) ?> on <?php echo"$datetime $timezone"; ?> (<?php echo $counter; ?> reads)</font></td>
				</tr></table>
			</td>
			<td background="themes/Slash/images/gr.gif"><img src="themes/Slash/images/pix.gif" width="11" height="11" alt=""></td>
		</tr>
		<tr bgcolor="#006666"><td colspan="3"><img src="themes/Slash/images/pix.gif" width="1" height="1"></td></tr>
		<tr bgcolor="#ffffff">
			<td background="themes/Slash/images/wl.gif"><img src="themes/Slash/images/pix.gif" width="11" height="11" alt=""></td>
			<td width="100%"><table width="100%" border="0" cellpadding="5" cellspacing="0"><tr><td>
			<a href="modules.php?name=News&amp;new_topic=<?php echo"$topic"; ?>&author="><img src=<?php echo"$t_image"; ?> border=0 Alt=<?php echo"\"$topictext\""; ?> align=right hspace=10 vspace=10></a>
			<?php echo "$boxstuff"; ?>
                 </td></tr></table></td>
                 <td background="themes/Slash/images/wr.gif"><img src="themes/Slash/images/pix.gif" width="11" height="11" alt=""></td>
		</tr>
		<tr bgcolor="#660000"><td colspan="3"><img src="themes/Slash/images/pix.gif" width="1" height="1"></td></tr>
		</table><table border="0" cellpadding="0" cellspacing="0">
		<tr bgcolor="#ffffff">
			<td background="themes/Slash/images/wl_cccccc.gif"><img src="themes/Slash/images/pix.gif" width="11" height="11" alt=""></td>
			<td width="100%">
			<table width="100%" border="0" cellpadding="5" cellspacing="0"><tr><td bgcolor="#cccccc"><font class="content"><?php echo"$morelink"; ?></font></td></tr></table>
			</td>
			<td background="themes/Slash/images/wr_cccccc.gif"><img src="themes/Slash/images/pix.gif" width="11" height="11" alt=""></td>
		</tr>
		<tr bgcolor="#660000"><td colspan="3"><img src="themes/Slash/images/pix.gif" width="1" height="1"></td></tr>
		</table><BR><BR>
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
	if ("$aid" == "$informant") { ?>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DDDDDD"><tr valign="top" bgcolor="#660000">
			<td><img src="themes/Slash/images/cl.gif" width="7" height="10" alt=""><img src="themes/Slash/images/pix.gif" width="4" height="4" alt=""></td>
			<td width="100%">
			<table width="100%" border="0" cellpadding="2" cellspacing="0"><tr><td>
			<font class="option" color="#FFFFFF"><B><?php echo"$title"; ?></B></font>
			</td></tr></table>
			</td><td align="right"><img src="themes/Slash/images/pix.gif" width="4" height="4" alt=""><img src="themes/Slash/images/cr.gif" width="7" height="10" alt=""></td>
         	</tr></table>
		<table border="0" cellpadding="0" cellspacing="0"><tr bgcolor="#e6e6e6">
			<td background="themes/Slash/images/gl.gif"><img src="themes/Slash/images/pix.gif" width="11" height="11" alt=""></td>
			<td width="100%">
				<table width="100%" border="0" cellpadding="5" cellspacing="0"><tr>
				<td><font class="tiny">Posted by <?php formatAidHeader($aid) ?> on <?php echo"$datetime $timezone"; ?></font>

<?php
if ($admin) {
    echo "&nbsp;&nbsp; $font2 [ <a href=".$admin_file.".php?op=EditStory&sid=$sid>Edit</a> | <a href=".$admin_file.".php?op=RemoveStory&sid=$sid>Delete</a> ]";
}
?>
				</td>
				</tr></table>
			</td>
			<td background="themes/Slash/images/gr.gif"><img src="themes/Slash/images/pix.gif" width="11" height="11" alt=""></td>
		</tr>
		<tr bgcolor="#006666"><td colspan="3"><img src="themes/Slash/images/pix.gif" width="1" height="1"></td></tr>
		<tr bgcolor="#ffffff">
			<td background="themes/Slash/images/wl.gif"><img src="themes/Slash/images/pix.gif" width="11" height="11" alt=""></td>
			<td width="100%"><table width="100%" border="0" cellpadding="5" cellspacing="0"><tr><td>
		<?php echo "<a href=modules.php?name=News&amp;new_topic=$topic><img src=$t_image border=0 Alt=\"$topictext\" align=right hspace=10 vspace=10></a>"; ?>
			<?php echo "$thetext"; ?>
                 </td></tr></table></td>
                 <td background="themes/Slash/images/wr.gif"><img src="themes/Slash/images/pix.gif" width="11" height="11" alt=""></td>
		</tr>
		<tr bgcolor="#660000"><td colspan="3"><img src="themes/Slash/images/pix.gif" width="1" height="1"></td></tr>
		</table>
<?php	} else {
		if(!empty($informant)) $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&username=$informant\">$informant</a> ";
		else $boxstuff = "$anonymous ";
		$boxstuff .= "writes <i>\"$thetext\"</i> $notes";
?>		<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DDDDDD"><tr valign="top" bgcolor="#660000">
			<td><img src="themes/Slash/images/cl.gif" width="7" height="10" alt=""><img src="themes/Slash/images/pix.gif" width="4" height="4" alt=""></td>
			<td width="100%">
			<table width="100%" border="0" cellpadding="2" cellspacing="0"><tr><td>
			<font class="option" color="#FFFFFF"><B><?php echo"$title"; ?></B></font>
			</td></tr></table>
			</td><td align="right"><img src="themes/Slash/images/pix.gif" width="4" height="4" alt=""><img src="themes/Slash/images/cr.gif" width="7" height="10" alt=""></td>
         	</tr></table>
		<table border="0" cellpadding="0" cellspacing="0"><tr bgcolor="#e6e6e6">
			<td background="themes/Slash/images/gl.gif"><img src="themes/Slash/images/pix.gif" width="11" height="11" alt=""></td>
			<td width="100%">
				<table width="100%" border="0" cellpadding="5" cellspacing="0"><tr>
				<td><font class="tiny">Posted by <?php formatAidHeader($aid) ?> on <?php echo"$datetime $timezone"; ?></font>
				
<?php
if ($admin) {
    echo "&nbsp;&nbsp; $font2 [ <a href=".$admin_file.".php?op=EditStory&sid=$sid>Editar</a> | <a href=".$admin_file.".php?op=RemoveStory&sid=$sid>Borrar</a> ]";
}
?>
<br><?php echo "$font1"; ?>
<?php echo "Contributed by <a href=\"modules.php?name=Your_Account&amp;op=userinfo&username=$informant\">$informant</a>"; ?>
				</td>
				</tr></table>
			</td>
			<td background="themes/Slash/images/gr.gif"><img src="themes/Slash/images/pix.gif" width="11" height="11" alt=""></td>
		</tr>
		<tr bgcolor="#006666"><td colspan="3"><img src="themes/Slash/images/pix.gif" width="1" height="1"></td></tr>
		<tr bgcolor="#ffffff">
			<td background="themes/Slash/images/wl.gif"><img src="themes/Slash/images/pix.gif" width="11" height="11" alt=""></td>
			<td width="100%"><table width="100%" border="0" cellpadding="5" cellspacing="0"><tr><td>
		<?php echo "<a href=modules.php?name=News&amp;new_topic=$topic><img src=$t_image border=0 Alt=\"$topictext\" align=right hspace=10 vspace=10></a>"; ?>
			<?php echo "$thetext"; ?>
                 </td></tr></table></td>
                 <td background="themes/Slash/images/wr.gif"><img src="themes/Slash/images/pix.gif" width="11" height="11" alt=""></td>
		</tr>
		<tr bgcolor="#660000"><td colspan="3"><img src="themes/Slash/images/pix.gif" width="1" height="1"></td></tr>
		</table>
<?php	}
}

function themesidebox($title, $content) { 
?>	
    <table width="150" border="0" cellpadding="0" cellspacing="0">
	<tr valign="top" bgcolor="#660000">
		<td bgcolor="#dddddd"><img src="themes/Slash/images/pix.gif" width="3" height="3" alt=""></td>
		<td><img src="themes/Slash/images/cl.gif" width="7" height="10" alt=""></td>
		<td><font class="tiny" color="#ffffff"><B><?php echo"$title"; ?></B></font></td>
		<td align="right"><img src="themes/Slash/images/cr.gif" width="7" height="10" alt=""></td>
		<td bgcolor="#dddddd" align="right"><img src="themes/Slash/images/pix.gif" width="3" height="3" alt=""></td>
	</tr>
	</table>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr bgcolor="#660000"><td colspan="3"><img src="themes/Slash/images/pix.gif" width="1" height="1"></td></tr>
	<tr bgcolor="#ffffff">
		<td background="themes/Slash/images/sl.gif"><img src="themes/Slash/images/pix.gif" width="3" height="3" alt=""></td>
		<td width="100%">
		<table width="100%" border="0" cellpadding="5" cellspacing="0"><tr><td><?php echo"$font2"; ?><?php echo"$content"; ?>
		</td></tr></table></td>
		<td background="themes/Slash/images/sr.gif" align="right"><img src="themes/Slash/images/pix.gif" width="3" height="3" alt=""></td>
	</tr>
	<tr bgcolor="#660000"><td colspan="3"><img src="themes/Slash/images/pix.gif" width="1" height="1"></td></tr>
	</table><br><br>
<?php
}

?>