<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2006 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if ( !defined('BLOCK_FILE') ) {
    Header("Location: ../index.php");
    fdie();
}

global $prefix, $startdate, $db;

$row = $db->sql_fetchrow($db->sql_query("SELECT count FROM ".$prefix."_counter WHERE type='total' AND var='hits'"));
$row1 = $db->sql_numrows($db->sql_query("SELECT user_id FROM ".$prefix."_users"));
$result = $db->sql_query("SELECT hits FROM ".$prefix."_stats_month WHERE hits!='0'");
$hits = 0;
$a = 0;
while ($row2 = $db->sql_fetchrow($result)) {
    $hits = $hits+$row2['hits'];
    $a++;
}
$views_m = $hits/$a;
$result = $db->sql_query("SELECT hits FROM ".$prefix."_downloads_downloads WHERE cid='6'");
$t_down = 0;
while ($row3 = $db->sql_fetchrow($result)) {
    $t_down = $row3[0]+$t_down;
}
$t_down = $t_down+4000000;
$t_down = number_format($t_down, 0, "", ",");
$views_m = number_format($views_m, 0, "", ",");
$t_hits = number_format($row[0], 0, "", ",");
$t_users = number_format($row1, 0, "", ",");

$content = "<div style='padding:10px'>";
$content .= "Total Page Views<br><b>$t_hits</b><br>";
$content .= "<br>Montly Page Views<br><b>$views_m</b><br>";
$content .= "<br>Montly Page Views<br><b>$views_m</b><br>";
$content .= "<br>Total Registered Users<br><b>$t_users</b><br>";
$content .= "<br>PHP-Nuke's Downloads<br><b>$t_down</b>";
$content .= "<br><br><b><u>Real Time Updated</u></b>";
$content .= "</div>";

?>