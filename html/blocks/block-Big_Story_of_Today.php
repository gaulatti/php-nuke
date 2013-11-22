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

if ( !defined('BLOCK_FILE') ) {
    Header("Location: ../index.php");
    die();
}

global $cookie, $prefix, $multilingual, $currentlang, $db, $user, $userinfo;

if ($multilingual == 1) {
    $querylang = "AND (alanguage='$currentlang' OR alanguage='')"; /* the OR is needed to display stories who are posted to ALL languages */
} else {
    $querylang = "";
}

$today = getdate();
$day = $today['mday'];
if ($day < 10) {
    $day = "0$day";
}
$month = $today['mon'];
if ($month < 10) {
    $month = "0$month";
}
$year = $today['year'];
$tdate = "$year-$month-$day";
$row = $db->sql_fetchrow($db->sql_query("SELECT sid, title FROM ".$prefix."_stories WHERE (time LIKE '%$tdate%') $querylang ORDER BY counter DESC LIMIT 0,1"));
$fsid = intval($row['sid']);
$ftitle = filter($row['title'], "nohtml");
$content = "<span class=\"content\">";
if ((!$fsid) AND (!$ftitle)) {
    $content .= ""._NOBIGSTORY."</font>";
} else {
    $content .= ""._BIGSTORY."<br><br>";
    getusrinfo($user);
          if (!isset($mode) OR empty($mode)) {
            if(isset($userinfo['umode'])) {
              $mode = $userinfo['umode'];
            } else {
              $mode = "thread";
            }
          }
          if (!isset($order) OR empty($order)) {
            if(isset($userinfo['uorder'])) {
              $order = $userinfo['uorder'];
            } else {
              $order = 0;
            }
          }
          if (!isset($thold) OR empty($thold)) {
            if(isset($userinfo['thold'])) {
              $thold = $userinfo['thold'];
            } else {
              $thold = 0;
            }
          }
    $r_options = "";
    $r_options .= "&amp;mode=".$mode;
    $r_options .= "&amp;order=".$order;
    $r_options .= "&amp;thold=".$thold;

    $content .= "<a href=\"modules.php?name=News&amp;file=article&amp;sid=$fsid$r_options\">$ftitle</a></span>";
}

?>