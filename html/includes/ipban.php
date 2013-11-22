<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2007 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (stristr(htmlentities($_SERVER['PHP_SELF']), "ipban.php")) {
	Header("Location: ../index.php");
	die();
}

global $prefix, $db;
$ip = $_SERVER['REMOTE_ADDR'];
$numrow = $db->sql_numrows($db->sql_query("SELECT id FROM ".$prefix."_banned_ip WHERE ip_address='$ip'"));
if ($numrow != 0) {
	echo "<br><br><center><img src='images/admin/ipban.gif'><br><br><b>You have been banned by the administrator</b></center>";
	die();
}
$ip_class = explode(".", $ip);
$ip = "$ip_class[0].$ip_class[1].$ip_class[2].*";
list($ip_address) = $db->sql_fetchrow($db->sql_query("SELECT ip_address FROM ".$prefix."_banned_ip WHERE ip_address='$ip'"));
$ip_class_banned = explode(".", $ip_address);
if ($ip_class_banned[3] == "*") {
	if ($ip_class[0] == $ip_class_banned[0] && $ip_class[1] == $ip_class_banned[1] && $ip_class[2] == $ip_class_banned[2]) {
		echo "<br><br><center><img src='images/admin/ipban.gif'><br><br><b>You have been banned by the administrator</b></center>";
		die();
	}
}
$ip = $_SERVER['REMOTE_ADDR'];
$past = time()-2;
$sql = "DELETE FROM ".$prefix."_antiflood WHERE time < '$past'";
$db->sql_query($sql);
$ctime = time();
$db->sql_query("INSERT INTO ".$prefix."_antiflood (ip_addr, time) VALUES ('$ip', '$ctime')");
$numrow = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_antiflood WHERE ip_addr='$ip'"));
if ($numrow >= 5) {
	echo "<br><br><center><b>Sorry, too many page loads in so little time!</b></center>";
	die();
}
unset($ip);

?>