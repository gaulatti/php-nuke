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

global $prefix, $multilingual, $currentlang, $db, $boxTitle, $content, $pollcomm, $user, $cookie, $userinfo;

if ($multilingual == 1) {
	$querylang = "WHERE planguage='$currentlang' AND artid='0'";
} else {
	$querylang = "WHERE artid='0'";
}

$row = $db->sql_fetchrow($db->sql_query("SELECT pollID FROM ".$prefix."_poll_desc $querylang ORDER BY pollID DESC LIMIT 1"));
$pollID = intval($row['pollID']);
if ($pollID == 0 || empty($pollID)) {
	$content = "";
} else {
	$content .= "<form action=\"modules.php?name=Surveys\" method=\"post\">";
	$content .= "<input type=\"hidden\" name=\"pollID\" value=\"".$pollID."\">";
	$row2 = $db->sql_fetchrow($db->sql_query("SELECT pollTitle, voters FROM ".$prefix."_poll_desc WHERE pollID='$pollID'"));
	$pollTitle = filter($row2['pollTitle'], "nohtml");
	$voters = intval($row2['voters']);
	$boxTitle = _SURVEY;
	$content .= "<span class=\"content\"><strong>$pollTitle</strong></span><br><br>\n";
	$content .= "<table border=\"0\" width=\"100%\">";
	for($i = 1; $i <= 12; $i++) {
		$row3 = $db->sql_fetchrow($db->sql_query("SELECT pollID, optionText, optionCount, voteID FROM ".$prefix."_poll_data WHERE (pollID='$pollID') AND (voteID='$i')"));
		if(isset($row3)) {
			$optionText = $row3['optionText'];
			if ($optionText != "") {
				$content .= "<tr><td valign=\"top\"><input type=\"radio\" name=\"voteID\" value=\"".$i."\"></td><td width=\"100%\"><span class=\"content\">$optionText</span></td></tr>\n";
			}
		}
	}
	$content .= "</table><br><center><span class=\"content\"><input type=\"submit\" value=\""._VOTE."\"></span><br>";
	if (is_user($user)) {
		cookiedecode($user);
	        getusrinfo($user);
	}
	$sum = 0;
	for($i = 0; $i < 12; $i++) {
		$row4 = $db->sql_fetchrow($db->sql_query("SELECT optionCount FROM ".$prefix."_poll_data WHERE (pollID='$pollID') AND (voteID='$i')"));
		$optionCount = intval($row4['optionCount']);
		$sum = (int)$sum+$optionCount;
	}

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
    // Quake - end
	$content .= "<br><span class=\"content\"><a href=\"modules.php?name=Surveys&amp;op=results&amp;pollID=".$pollID.$r_options."\"><strong>"._RESULTS."</strong></a> | <a href=\"modules.php?name=Surveys\"><strong>"._POLLS."</strong></a><br>";
	if ($pollcomm) {
		$numcom = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_pollcomments WHERE pollID='$pollID'"));
		//$content .= "<br>"._VOTES.": <strong>".intval($sum)."</strong> | "._PCOMMENTS." <strong>".intval($numcom)."</strong>\n\n";
	} else {
		$content .= "<br>"._VOTES." <strong>".intval($sum)."</strong>\n\n";
	}
	$content .= "</span></center></form>\n\n";
}

?>