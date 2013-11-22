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

global $prefix, $db;

$result = $db->sql_query("SELECT pid, title FROM " . $prefix . "_pages WHERE active='1'");
while ($row = $db->sql_fetchrow($result)) {
$pid = intval($row['pid']);
$title = filter($row['title'], "nohtml");
    $content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=Content&amp;pa=showpage&amp;pid=$pid\">$title</a><br>";
}

?>