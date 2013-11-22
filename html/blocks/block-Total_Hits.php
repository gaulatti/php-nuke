<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2007 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Based on Total Hits Block v0.1                                       */
/* Copyright (c) 2001 by C. Verhoef (cverhoef@gmx.net)                  */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if ( !defined('BLOCK_FILE') ) {
    Header("Location: ../index.php");
    die();
}

global $prefix, $startdate, $db;

$row = $db->sql_fetchrow($db->sql_query("SELECT count FROM ".$prefix."_counter WHERE type='total' AND var='hits'"));
$content = "<font class=\"tiny\"><center>"._WERECEIVED."<br><b><a href=\"modules.php?name=Statistics\">$row[0]</a></b><br>"._PAGESVIEWS." $startdate</center></font>";

?>