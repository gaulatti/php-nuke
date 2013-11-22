<?php

/************************************************************/
/*                                                          */
/* Updated for PHP-Nuke 5.6 -  18 Jun 2002 NukeScripts      */
/* website http://www.nukescripts.com                       */
/*                                                          */
/* Updated for PHP-Nuke 5.5 - 24/03/2002 Rugeri             */
/* website http://newsportal.homip.net                      */
/*                                                          */
/* (C) 2002                                                 */
/* All rights beyond the GPL are reserved                   */
/*                                                          */
/* Please give a link back to my site somewhere in your own */
/*                                                          */
/************************************************************/

if ( !defined('BLOCK_FILE') ) {
    Header("Location: ../index.php");
    die();
}

$content = "";

global $user, $cookie, $prefix, $user_prefix, $db, $anonymous, $sitekey, $gfx_chk, $locale;
mt_srand ((double)microtime()*1000000);
$maxran = 1000000;
$random_num = mt_rand(0, $maxran);
$datekey = date("F j");
$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $random_num . $datekey));
$code = substr($rcode, 2, 6);
cookiedecode($user);
$sql = "SELECT username FROM ".$user_prefix."_users ORDER BY user_id DESC LIMIT 0,1";
$query = $db->sql_query($sql);
list($lastuser) = $db->sql_fetchrow($query);
$sql2 = "SELECT user_id FROM ".$user_prefix."_users";
$query2 = $db->sql_query($sql2);
$numrows = $db->sql_numrows($query2);
$numrows = intval($numrows);
$sql3 = "SELECT uname, guest FROM ".$prefix."_session WHERE guest='0'";
$result = $db->sql_query($sql3);
$member_online_num = $db->sql_numrows($result);
$who_online_now = "";
$i = 1;
while (list($uname, $guest) = $db->sql_fetchrow($result)) {
    if (isset($guest) and $guest == 0) {
        if ($i < 10) {
            $who_online_now .= "0" .$i." :&nbsp;<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname\">$uname</a><br>\n";
        } else {
            $who_online_now .= $i.":&nbsp;<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname\">$uname</a><br>\n";
        }
        $who_online_now .= ($i != $member_online_num ? "  " : "");
        $i++;
    }
}

// Formatting date - Fix by Quake
$month = date('M');
$curDate2 = "%".$month[0].$month[1].$month[2]."%".date('d')."%".date('Y')."%";
$ty = time() - 86400;
$preday = strftime('%d', $ty);
$premonth = strftime('%B', $ty);
$preyear = strftime('%Y', $ty);
$curDateP = "%".$premonth[0].$premonth[1].$premonth[2]."%".$preday."%".$preyear."%";

//Select new today
$sql = "SELECT COUNT(user_id) AS userCount FROM ".$user_prefix."_users WHERE user_regdate LIKE '$curDate2'";
$query = $db->sql_query($sql);
list($userCount) = $db->sql_fetchrow($query);
$userCount = intval($userCount);
//end

//Select new yesterday
$sql = "SELECT COUNT(user_id) AS userCount FROM ".$user_prefix."_users WHERE user_regdate LIKE '$curDateP'";
$query = $db->sql_query($sql);
list($userCount2) = $db->sql_fetchrow($query);
$userCount2 = intval($userCount2);
//end

$guest_online_sql = "SELECT uname FROM ".$prefix."_session WHERE guest='1'";
$guest_online_query = $db->sql_query($guest_online_sql);
$guest_online_row = $db->sql_numrows($guest_online_query);
$guest_online_num = intval($guest_online_row);

$member_online_sql = "SELECT uname FROM ".$prefix."_session WHERE guest='0'";
$member_online_query = $db->sql_query($member_online_sql);
$member_online_row = $db->sql_numrows($member_online_query);
$member_online_num = intval($member_online_row);

$who_online_num = $guest_online_num + $member_online_num;
$who_online_num = intval($who_online_num);
$content .= "<form onsubmit=\"this.submit.disabled='true'\" action=\"modules.php?name=Your_Account\" method=\"post\">";

if (is_user($user)) {
    $uname = $cookie[1];
    $content .= "<br><img src=\"images/blocks/group-4.gif\" height=\"14\" width=\"17\"> "._BWEL.", <b>$uname</b>.<br>\n<hr>\n";
    $sql = "SELECT user_id FROM " .$user_prefix."_users WHERE username='$uname'";
    $query = $db->sql_query($sql);
    list($user_id) = $db->sql_fetchrow($query);
    $uid = intval($user_id);
    $newpms_query = $db->sql_query("SELECT privmsgs_to_userid FROM ".$prefix."_bbprivmsgs WHERE privmsgs_to_userid='$uid' AND (privmsgs_type='5' OR privmsgs_type='1')");
    $oldpms_query = $db->sql_query("SELECT privmsgs_to_userid FROM ".$prefix."_bbprivmsgs WHERE privmsgs_to_userid='$uid' AND privmsgs_type='0'");
    $newpms = $db->sql_numrows($newpms_query);
    $oldpms = $db->sql_numrows($oldpms_query);
    $content .= "<img src=\"images/blocks/email-y.gif\" height=\"10\" width=\"14\"> <a href=\"modules.php?name=Private_Messages\"><b>"._BPM."</b></a><br>\n";
    $content .= "<img src=\"images/blocks/email-r.gif\" height=\"10\" width=\"14\"> "._BUNREAD.": <b>".intval($newpms)."</b><br>\n";
    $content .= "<img src=\"images/blocks/email-g.gif\" height=\"10\" width=\"14\"> "._BREAD.": <b>".intval($oldpms)."</b><br>\n<hr>\n";
} else {
    $content .= "<img src=\"images/blocks/group-4.gif\" height=\"14\" width=\"17\"> "._BWEL.", <b>$anonymous</b>\n<hr>";
    $content .= _NICKNAME." <input type=\"text\" name=\"username\" size=\"10\" maxlength=\"25\"><br>";
    $content .= _PASSWORD." <input type=\"password\" name=\"user_password\" size=\"10\" maxlength=\"20\"><br>";
if (extension_loaded('gd') AND ($gfx_chk == 2 OR $gfx_chk == 4 OR $gfx_chk == 5 OR $gfx_chk == 7)) {
    $content .= _SECURITYCODE.": <img src='?gfx=gfx&random_num=$random_num' border='1' alt='"._SECURITYCODE."' title='"._SECURITYCODE."'><br>\n";
    $content .= _TYPESECCODE."<br><input type=\"text\" name=\"gfx_check\" size=\"7\" maxlength=\"6\">\n";
    $content .= "<input type=\"hidden\" name=\"random_num\" value=\"$random_num\"><br>\n";
} else {
    $content .= "<input type=\"hidden\" name=\"random_num\" value=\"$random_num\">";
    $content .= "<input type=\"hidden\" name=\"gfx_check\" value=\"$code\">";
}
    $content .= "<input type=\"hidden\" name=\"op\" value=\"login\">";
    $content .= "<input type=\"submit\" value=\""._LOGIN."\">\n (<a href=\"modules.php?name=Your_Account&amp;op=new_user\">"._BREG."</a>)<hr>";
}
$content .= "<img src=\"images/blocks/group-2.gif\" height=\"14\" width=\"17\"> <b><u>"._BMEMP.":</u></b><br>\n";
$content .= "<img src=\"images/blocks/ur-moderator.gif\" height=\"14\" width=\"17\"> "._BLATEST.": <a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$lastuser\"><b>$lastuser</b></a><br>\n";
$content .= "<img src=\"images/blocks/ur-author.gif\" height=\"14\" width=\"17\"> "._BTD.": <b>$userCount</b><br>\n";
$content .= "<img src=\"images/blocks/ur-admin.gif\" height=\"14\" width=\"17\"> "._BYD.": <b>$userCount2</b><br>\n";
$content .= "<img src=\"images/blocks/ur-guest.gif\" height=\"14\" width=\"17\"> "._BOVER.": <b>$numrows</b><br>\n<hr>\n";
$content .= "<img src=\"images/blocks/group-3.gif\" height=\"14\" width=\"17\"> <b><u>"._BVISIT.":</u></b>\n<br>\n";
$content .= "<img src=\"images/blocks/ur-anony.gif\" height=\"14\" width=\"17\"> "._BVIS.": <b>$guest_online_num</b><br>\n";
$content .= "<img src=\"images/blocks/ur-member.gif\" height=\"14\" width=\"17\"> "._BMEM.": <b>$member_online_num</b><br>\n";
$content .= "<img src=\"images/blocks/ur-registered.gif\" height=\"14\" width=\"17\"> "._BTT.": <b>$who_online_num</b><br>\n";
if ($member_online_num > 0) {
    $content .= "<hr>\n<img src=\"images/blocks/group-1.gif\" height=\"14\" width=\"17\"> <b><u>"._BON.":</u></b><br>$who_online_now";
}
$content .= "</form>";

?>