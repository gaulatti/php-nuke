<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2007 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Based on Feedback Addon 1.0                                          */
/* Copyright (c) 2001 by Jack Kozbial (jack@internetintl.com)           */
/* http://www.InternetIntl.com                                          */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

define('INDEX_FILE', true);
$subject = $sitename." "._FEEDBACK;
define('NO_EDITOR', true);

include("header.php");

if (!isset($opi) OR ($opi != "ds")) {
  $intcookie = intval($cookie[0]);
  if (!empty($cookie[1])) {
    $sql = "SELECT name, username, user_email FROM ".$user_prefix."_users WHERE user_id='".$intcookie."'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    if (!empty($row['name'])) {
		$sender_name = filter($row['name'], "nohtml");
	} else {
		$sender_name = filter($row['username'], "nohtml");
	}
	$sender_email = filter($row['user_email'], "nohtml");
  } else {
    $sender_email = "";
    $sender_name = "";
  }
}

if (!isset($message)) { $message = ""; }
if (!isset($opi)) { $opi = ""; }
if (!isset($send)) { $send = ""; }
title(_FEEDBACKTITLE);
info_box("note", _FEEDBACKNOTE);
echo "<br>";
$form_block = "
	<table border=\"0\" width=\"80%\">
    <tr><td nowrap><FORM METHOD=\"post\" ACTION=\"modules.php?name=$module_name\">
    <strong>"._YOURNAME.":</strong></td><td><INPUT type=\"text\" NAME=\"sender_name\" VALUE=\"$sender_name\" SIZE=30></td></tr>
    <tr><td nowrap><strong>"._YOUREMAIL.":</strong></td><td><INPUT type=\"text\" NAME=\"sender_email\" VALUE=\"$sender_email\" SIZE=30></td></tr>
    <tr><td><strong>"._MESSAGE.":</strong></td><td><TEXTAREA NAME=\"message\" COLS=60 ROWS=10 WRAP=virtual style='width: 399px;'>$message</TEXTAREA><br>
    <i>"._HTMLNOTALLOWED2."</i></td></tr>
    <tr><td>&nbsp;</td><td><INPUT type=\"hidden\" name=\"opi\" value=\"ds\">
    <INPUT TYPE=\"submit\" NAME=\"submit\" VALUE=\""._SEND."\">
    </FORM></td></tr></table>
";

OpenTable();
if ($_POST['opi'] != "ds") {
    echo $form_block;
} else {
    if (empty($sender_name)) {
		$name_err = "<div align=\"center\"><span class=\"option\"><strong><em>"._FBENTERNAME."</em></strong></span></div>";
		$send = "no";
    } 
    if (empty($sender_email)) {
		$email_err = "<div align=\"center\"><span class=\"option\"><strong><em>"._FBENTEREMAIL."</em></strong></span></div>";
		$send = "no";
    } 
    if (empty($message)) {
    	$message_err = "<div align=\"center\"><span class=\"option\"><strong><em>"._FBENTERMESSAGE."</em></span></font></div>";
		$send = "no";
    } 
	if ($send != "no") {
		$sender_name = removecrlf(filter($sender_name, "nohtml"));
		$sender_email = removecrlf(filter($sender_email, "nohtml"));
		$message = filter($message, "nohtml");
		$msg = "$sitename\n\n";
		$msg .= ""._SENDERNAME.": $sender_name\n";
		$msg .= ""._SENDEREMAIL.": $sender_email\n";
		$msg .= ""._MESSAGE.": $message\n\n";
		$to = $adminmail;
		$mailheaders = "From: $sender_name <$sender_email>\n";
		$mailheaders .= "Reply-To: $sender_email\n\n";
		mail($to, $subject, $msg, $mailheaders);
		echo "<p><div align=\"center\">"._FBMAILSENT."</div></p>";
		echo "<p><div align=\"center\">"._FBTHANKSFORCONTACT."</div></p>";
    } elseif ($send == "no") {
		OpenTable2();
		if (!empty($name_err)) { echo "$name_err"; }
		if (!empty($email_err)) {echo "$email_err"; }
		if (!empty($message_err)) {echo "$message_err"; }
		CloseTable2();
		echo "<br><br>";
		echo $form_block;
	}
}

CloseTable();
include("footer.php");

?>