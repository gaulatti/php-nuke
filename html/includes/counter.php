<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2007 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Based on NukeStats Module Version 1.0                                */
/* Copyright (c) 2002 by Harry Mangindaan (sens@indosat.net) and        */
/*                    Sudirman (sudirman@akademika.net)                 */
/* http://www.nuketest.com                                              */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (stristr(htmlentities($_SERVER['PHP_SELF']), "counter.php")) {
	Header("Location: index.php");
	die();
}
global $prefix, $db;

/* Get the Browser data */

if ((ereg("Nav", $_SERVER["HTTP_USER_AGENT"])) || (ereg("Gold", $_SERVER["HTTP_USER_AGENT"])) || (ereg("X11", $_SERVER["HTTP_USER_AGENT"])) || (ereg("Mozilla", $_SERVER["HTTP_USER_AGENT"])) || (ereg("Netscape", $_SERVER["HTTP_USER_AGENT"])) AND (!ereg("MSIE", $_SERVER["HTTP_USER_AGENT"])) AND (!ereg("Konqueror", $_SERVER["HTTP_USER_AGENT"])) AND (!ereg("Yahoo", $_SERVER["HTTP_USER_AGENT"])) AND (!ereg("Firefox", $_SERVER["HTTP_USER_AGENT"]))) $browser = "Netscape";
elseif(ereg("Firefox", $_SERVER["HTTP_USER_AGENT"])) $browser = "FireFox";
elseif(ereg("MSIE", $_SERVER["HTTP_USER_AGENT"])) $browser = "MSIE";
elseif(ereg("Lynx", $_SERVER["HTTP_USER_AGENT"])) $browser = "Lynx";
elseif(ereg("Opera", $_SERVER["HTTP_USER_AGENT"])) $browser = "Opera";
elseif(ereg("WebTV", $_SERVER["HTTP_USER_AGENT"])) $browser = "WebTV";
elseif(ereg("Konqueror", $_SERVER["HTTP_USER_AGENT"])) $browser = "Konqueror";
elseif((eregi("bot", $_SERVER["HTTP_USER_AGENT"])) || (ereg("Google", $_SERVER["HTTP_USER_AGENT"])) || (ereg("Slurp", $_SERVER["HTTP_USER_AGENT"])) || (ereg("Scooter", $_SERVER["HTTP_USER_AGENT"])) || (eregi("Spider", $_SERVER["HTTP_USER_AGENT"])) || (eregi("Infoseek", $_SERVER["HTTP_USER_AGENT"]))) $browser = "Bot";
else $browser = "Other";

/* Get the Operating System data */

if(ereg("Win", $_SERVER["HTTP_USER_AGENT"])) $os = "Windows";
elseif((ereg("Mac", $_SERVER["HTTP_USER_AGENT"])) || (ereg("PPC", $_SERVER["HTTP_USER_AGENT"]))) $os = "Mac";
elseif(ereg("Linux", $_SERVER["HTTP_USER_AGENT"])) $os = "Linux";
elseif(ereg("FreeBSD", $_SERVER["HTTP_USER_AGENT"])) $os = "FreeBSD";
elseif(ereg("SunOS", $_SERVER["HTTP_USER_AGENT"])) $os = "SunOS";
elseif(ereg("IRIX", $_SERVER["HTTP_USER_AGENT"])) $os = "IRIX";
elseif(ereg("BeOS", $_SERVER["HTTP_USER_AGENT"])) $os = "BeOS";
elseif(ereg("OS/2", $_SERVER["HTTP_USER_AGENT"])) $os = "OS/2";
elseif(ereg("AIX", $_SERVER["HTTP_USER_AGENT"])) $os = "AIX";
else $os = "Other";

/* Save on the databases the obtained values */

$db->sql_query("UPDATE ".$prefix."_counter SET count=count+1 WHERE (type='total' AND var='hits') OR (var='$browser' AND type='browser') OR (var='$os' AND type='os')");
update_points(13);

/* Start Detailed Statistics */

$dot = date("d-m-Y-H");
$now = explode ("-",$dot);
$nowHour = $now[3];
$nowYear = $now[2];
$nowMonth = $now[1];
$nowDate = $now[0];
$sql = "SELECT year FROM ".$prefix."_stats_year WHERE year='$nowYear'";
$resultyear = $db->sql_query($sql);
$jml = $db->sql_numrows($resultyear);
if ($jml <= 0) {
	$sql = "INSERT INTO ".$prefix."_stats_year VALUES ('$nowYear','0')";
	$db->sql_query($sql);
	for ($i=1;$i<=12;$i++) {
		$db->sql_query("INSERT INTO ".$prefix."_stats_month VALUES ('$nowYear','$i','0')");
		if ($i == 1) $TotalDay = 31;
		if ($i == 2) {
			if (date("L") == true) {
				$TotalDay = 29;
			} else {
				$TotalDay = 28;
			}
		}
		if ($i == 3) $TotalDay = 31;
		if ($i == 4) $TotalDay = 30;
		if ($i == 5) $TotalDay = 31;
		if ($i == 6) $TotalDay = 30;
		if ($i == 7) $TotalDay = 31;
		if ($i == 8) $TotalDay = 31;
		if ($i == 9) $TotalDay = 30;
		if ($i == 10) $TotalDay = 31;
		if ($i == 11) $TotalDay = 30;
		if ($i == 12) $TotalDay = 31;
		for ($k=1;$k<=$TotalDay;$k++) {
			$db->sql_query("INSERT INTO ".$prefix."_stats_date VALUES ('$nowYear','$i','$k','0')");
		}
	}
}

$sql = "SELECT hour FROM ".$prefix."_stats_hour WHERE (year='$nowYear') AND (month='$nowMonth') AND (date='$nowDate')";
$result = $db->sql_query($sql);
$numrows = $db->sql_numrows($result);

if ($numrows <= 0) {
	for ($z = 0;$z<=23;$z++) {
		$db->sql_query("INSERT INTO ".$prefix."_stats_hour VALUES ('$nowYear','$nowMonth','$nowDate','$z','0')");
	}
}

$db->sql_query("UPDATE ".$prefix."_stats_year SET hits=hits+1 WHERE year='$nowYear'");
$db->sql_query("UPDATE ".$prefix."_stats_month SET hits=hits+1 WHERE (year='$nowYear') AND (month='$nowMonth')");
$db->sql_query("UPDATE ".$prefix."_stats_date SET hits=hits+1 WHERE (year='$nowYear') AND (month='$nowMonth') AND (date='$nowDate')");
$db->sql_query("UPDATE ".$prefix."_stats_hour SET hits=hits+1 WHERE (year='$nowYear') AND (month='$nowMonth') AND (date='$nowDate') AND (hour='$nowHour')");

?>