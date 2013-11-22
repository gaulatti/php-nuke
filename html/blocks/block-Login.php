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
    fdie();
}

global $admin, $user, $sitekey, $gfx_chk, $admin_file;

mt_srand ((double)microtime()*1000000);
$maxran = 1000000;
$random_num = mt_rand(0, $maxran);
$content .= "<div id='login'>";
$content .= "<form onsubmit=\"this.submit.disabled='true'\" action=\"modules.php?name=Your_Account\" method=\"post\">";
$content .= ""._NICKNAME."<br>";
$content .= "<input type=\"text\" name=\"username\" size=\"10\" maxlength=\"25\" class='inputLogin'><br>";
$content .= ""._PASSWORD."<br>";
$content .= "<input type=\"password\" name=\"user_password\" size=\"10\" maxlength=\"20\" class='inputLogin'><br>";
if (extension_loaded('gd') AND ($gfx_chk == 2 OR $gfx_chk == 4 OR $gfx_chk == 5 OR $gfx_chk == 7)) {
    $content .= "<div style='padding: 5px 0; width: 81px; float:left; margin-right:5px;color:#C30'>"._SECURITYCODE.":</div> <img src='?gfx=gfx&random_num=$random_num' border='1' alt='"._SECURITYCODE."' title='"._SECURITYCODE."' style='float:left; margin-left:15px; margin-top:3px;'><br> <div style=' clear:both; height:5px;'></div>";
    $content .= "<div style='padding: 5px 0; width: 90px; font-size:10px; float:left; margin-right:5px;color:#C30'>"._TYPESECCODE."</div> <div style='padding: 0; width: 85px; float:right; margin-right:5px;'><input type=\"text\" NAME=\"gfx_check\" SIZE=\"7\" MAXLENGTH=\"6\" class='inputLoginSecurity'></div>";
    $content .= "<input type=\"hidden\" name=\"random_num\" value=\"$random_num\" >";
} else {
    $content .= "<input type=\"hidden\" name=\"random_num\" value=\"$random_num\">";
    $content .= "<input type=\"hidden\" name=\"gfx_check\" value=\"$code\">";
}
$content .= "<input type=\"hidden\" name=\"op\" value=\"login\">";
$content .= "<div style=' clear:both; height:5px;'></div>";
$content .= "<input type=\"submit\" value=\""._LOGIN."\" class='btnSubmit'></form>";
$content .= "<div style='padding:5px; font-size: 11px; color:#333; margin: 5px 0; background:#D2F0FF; border: 1px dotted #069'>"._ASREGISTERED."</div>";
$content .= "</div>";


if (is_admin($admin) AND is_user($user)) {
    $content = "<center>"._ADMIN."<br>[ <a href=\"".$admin_file.".php?op=logout\">"._LOGOUT."</a> ]</center>";
}

?>