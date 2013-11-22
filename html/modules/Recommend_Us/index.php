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

if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = "- "._RECOMMEND."";

function RecommendSite($mess="0") {
	global $user, $cookie, $prefix, $db, $user_prefix, $module_name, $gfx_chk;
	include ("header.php");
	title(""._RECOMMEND."");
	OpenTable();
	$mess = intval($mess);
	if ($mess == 1) {
		$mess = "<center>"._SECURITYCODEERROR."</center><br><br>";
	} else {
		$mess = "";
	}
	echo "<center><font class=\"content\"><b>"._RECOMMEND."</b></font></center><br><br>$mess"
	."<table align=\"left\" border=\"0\" cellpadding=\"5\" cellspacing=\"5\"><tr><td>"
	."<form action=\"modules.php?name=$module_name\" method=\"post\">"
	."<input type=\"hidden\" name=\"op\" value=\"SendSite\">";
	if (is_user($user)) {
		$row = $db->sql_fetchrow($db->sql_query("SELECT username, user_email from ".$user_prefix."_users where user_id = '".intval($cookie[0])."'"));
		$yn = filter($row['username'], "nohtml");
		$ye = filter($row['user_email'], "nohtml");
	}
	else {
		$yn = "";
		$ye = "";
	}
	echo "<b>"._FYOURNAME." </b></td><td><input type=\"text\" name=\"yname\" value=\"$yn\"></td></tr>\n"
	."<tr><td><b>"._FYOUREMAIL." </b></td><td><input type=\"text\" name=\"ymail\" value=\"$ye\"></td></tr>\n"
	."<tr><td><b>"._FFRIENDNAME." </b></td><td><input type=\"text\" name=\"fname\"></td></tr>\n"
	."<tr><td><b>"._FFRIENDEMAIL." </b></td><td><input type=\"text\" name=\"fmail\"></td></tr>\n";
	mt_srand ((double)microtime()*1000000);
	$maxran = 1000000;
	$random_num = mt_rand(0, $maxran);
	if (extension_loaded("gd") AND $gfx_chk != 0 ) {
		echo "<tr><td><b>"._SECURITYCODE.":</b></td><td><img src='?gfx=gfx_little&random_num=$random_num' border='1' alt='"._SECURITYCODE."' title='"._SECURITYCODE."'></td></tr>\n";
		echo "<tr><td><b>"._TYPESECCODE.":</b></td><td><input type=\"text\" NAME=\"gfx_check\" SIZE=\"3\" MAXLENGTH=\"3\"></td></tr>\n";
		echo "<input type=\"hidden\" name=\"random_num\" value=\"$random_num\">\n";
	} else {
		echo "<input type=\"hidden\" name=\"random_num\" value=\"$random_num\">\n";
	}
	echo "<tr><td>&nbsp;</td><td><input type=submit value="._SEND."></form></td></tr></table>\n";
	CloseTable();
	include ('footer.php');
}

function SendSite($yname, $ymail, $fname, $fmail, $random_num="0", $gfx_check) {
	global $sitename, $slogan, $nukeurl, $module_name, $gfx_chk, $sitekey;
	if (empty($fname) OR empty($fmail) OR empty($yname) OR empty($ymail)) {
		include("header.php");
		title("$sitename - "._RECOMMEND."");
		OpenTable();
		echo "<center>"._SENDSITEERROR."<br><br>"._GOBACK."";
		CloseTable();
		include("footer.php");
		die();
	}
	$fname = removecrlf(filter($fname, "nohtml"));
	$fmail = validate_mail(removecrlf(filter($fmail, "nohtml")));
	$yname = removecrlf(filter($yname, "nohtml"));
	$ymail = validate_mail(removecrlf(filter($ymail, "nohtml")));
	$datekey = date("F j");
	$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $random_num . $datekey));
	$code = substr($rcode, 2, 3);
	if (extension_loaded("gd") AND $code != $gfx_check AND $gfx_chk != 0) {
		$mess = 1;
		Header("Location: modules.php?name=$module_name&op=RecommendSite&mess=$mess");
	} else {
		$subject = ""._INTSITE." $sitename";
		$message = ""._HELLO." $fname:\n\n"._YOURFRIEND." $yname "._OURSITE." $sitename "._INTSENT."\n\n\n"._FSITENAME." $sitename\n$slogan\n"._FSITEURL." $nukeurl\n";
		mail($fmail, $subject, $message, "From: \"$yname\" <$ymail>\nX-Mailer: PHP/" . phpversion());
		update_points(3);
		Header("Location: modules.php?name=$module_name&op=SiteSent&fname=$fname");
	}
}

function SiteSent($fname) {
	include ('header.php');
	$fname = removecrlf(filter($fname, "nohtml"));
	OpenTable();
	echo "<center><font class=\"content\">"._FREFERENCE." $fname...<br><br>"._THANKSREC."</font></center>";
	CloseTable();
	include ('footer.php');
}

if (!isset($mess)) { $mess = 0; }

switch($op) {

	case "SendSite":
	SendSite($yname, $ymail, $fname, $fmail, $random_num, $gfx_check);
	break;

	case "SiteSent":
	SiteSent($fname);
	break;

	default:
	RecommendSite($mess);
	break;

}

?>