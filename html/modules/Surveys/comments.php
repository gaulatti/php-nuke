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
$pagetitle = "- "._SURVEYS."";

function format_url($comment) {
	global $nukeurl;
	unset($location);
	$comment = filter($comment);
	$links = array();
	$hrefs = array();
	$pos = 0;
	while (!(($pos = strpos($comment,"<",$pos)) === false)) {
		$pos++;
		$endpos = strpos($comment,">",$pos);
		$tag = substr($comment,$pos,$endpos-$pos);
		$tag = trim($tag);
		if (isset($location)) {
			if (!strcasecmp(strtok($tag," "),"/A")) {
				$link = substr($comment,$linkpos,$pos-1-$linkpos);
				$links[] = $link;
				$hrefs[] = $location;
				unset($location);
			}
			$pos = $endpos+1;
		} else {
			if (!strcasecmp(strtok($tag," "),"A")) {
				if (eregi("HREF[ \t\n\r\v]*=[ \t\n\r\v]*\"([^\"]*)\"",$tag,$regs));
				else if (eregi("HREF[ \t\n\r\v]*=[ \t\n\r\v]*([^ \t\n\r\v]*)",$tag,$regs));
				else $regs[1] = "";
				if ($regs[1]) {
					$location = $regs[1];
				}
				$pos = $endpos+1;
				$linkpos = $pos;
			} else {
				$pos = $endpos+1;
			}
		}
	}
	for ($i=0; $i<sizeof($links); $i++) {
		if (!stripos_clone($hrefs[$i], "http://")) {
			$hrefs[$i] = $nukeurl;
		} elseif (!stripos_clone($hrefs[$i], "mailto://")) {
			$href = explode("/",$hrefs[$i]);
			$href = " [$href[2]]";
			$comment = str_replace(">$links[$i]</a>", "title='$hrefs[$i]'> $links[$i]</a>$href", $comment);
		}
	}
	return($comment);
}

function modone() {
	global $admin, $moderate, $module_name, $db, $prefix, $pollID;
	$pollsid = intval($pollID);
	$comnum = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_poll_desc WHERE pollID='$pollsid' AND comments!='0'"));
	if ($comnum != 0) {
		if(((isset($admin)) && ($moderate == 1)) || ($moderate==2)) echo "<form action=\"modules.php?name=$module_name&file=comments\" method=\"post\">";
	}
}

function modtwo($tid, $score, $reason) {
	global $admin, $user, $moderate, $reasons, $db, $prefix, $cookie, $pollID;
	$pollsid = intval($pollID);
	$tid = intval($tid);
	$comnum = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_poll_desc WHERE pollID='$pollsid' AND comments!='0'"));
	if ($comnum != 0) {
		$whoisath = $db->sql_fetchrow($db->sql_query("SELECT name FROM ".$prefix."_pollcomments WHERE tid='$tid'"));
		cookiedecode($user);
		if((((isset($admin)) && ($moderate == 1)) || ($moderate == 2)) && ($user)) {
			if (strtolower($cookie[1]) == strtolower($whoisath['name'])) {
				echo " | <select name=dkn$tid>";
				echo "<option value=\"$score:0\">$reasons[0]</option>\n";
				echo "</select>";
			} else {
				echo " | <select name=dkn$tid>";
				for($i=0; $i<sizeof($reasons); $i++) {
					echo "<option value=\"$score:$i\">$reasons[$i]</option>\n";
				}
				echo "</select>";
			}
		}
	}
}

function modthree($pollID, $mode, $order, $thold=0) {
	global $userinfo, $admin, $user, $moderate, $db, $prefix;
	$pollsid = intval($pollID);
	$comnum = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_poll_desc WHERE pollID='$pollsid' AND comments!='0'"));
	if ($comnum != 0) {
		if((((isset($admin)) && ($moderate == 1)) || ($moderate==2)) && ($user)) {
		
                  cookiedecode($user);
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

                $form = "<input type=hidden name=pollID value=$pollID>";
                $form .= "<input type=hidden name=mode value=$mode>";
                $form .= "<input type=hidden name=order value=$order>";
                $form .= "<input type=hidden name=thold value=$thold>";
                $form .= "<input type=hidden name=op value=moderate><br>";
                echo $form;

	    	OpenTable();
	    	echo "<center><font class=\"title\">"._COMMENTSMODERATION."</font><br><br>"._CLICKTOMODERATE."<br><br>";
	    	echo "<input type=submit value=\""._MODERATE."\"></form></center>";
	    	CloseTable();
	    }
	}
}

function navbar($pollID, $title, $thold, $mode, $order) {
	global $userinfo, $user, $bgcolor1, $bgcolor2, $textcolor1, $textcolor2, $anonpost, $pollcomm, $prefix, $db, $module_name;
	OpenTable();
	$pollID = intval($pollID);
	$query = $db->sql_query("SELECT pollID FROM ".$prefix."_pollcomments where pollID='$pollID'");
	if(!$query) $count = 0; else $count = $db->sql_numrows($query);
	$row = $db->sql_fetchrow($db->sql_query("SELECT pollTitle from ".$prefix."_poll_desc where pollID='$pollID'"));
	$title = filter($row['pollTitle'], "nohtml");
                  cookiedecode($user);
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
	echo "\n\n<!-- COMMENTS NAVIGATION BAR START -->\n\n";
	echo "<table width=\"99%\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\">\n";
	if($title) {
		echo "<tr><td bgcolor=\"$bgcolor2\" align=\"center\"><font class=\"content\" color=\"$textcolor1\">\"$title\" | ";
		if(is_user($user)) {
			echo "<a href=\"modules.php?name=Your_Account&amp;op=editcomm\"><font color=\"$textcolor1\">"._CONFIGURE."</font></a>";
		} else {
			echo "<a href=\"modules.php?name=Your_Account\"><font color=\"$textcolor1\">"._LOGINCREATE."</font></a>";
		}
		if(($count==1)) {
			echo " | <B>$count</B> "._COMMENT."</font></td></tr>\n";
		} else {
			echo " | <B>$count</B> "._COMMENTS."</font></td></tr>\n";
		}
	}
	echo "<tr><td bgcolor=\"$bgcolor1\" align=\"center\" width=\"100%\">\n";
	cookiedecode($user);
	if (($pollcomm) AND ($mode != "nocomments")) {
		if ($anonpost==1 OR (isset($admin) AND is_admin($admin)) OR is_user($user)) {
			if (!isset($pid)) { $pid = 0; }
			echo "<form action=\"modules.php?name=$module_name&amp;file=comments\" method=\"post\">"
			."<input type=\"hidden\" name=\"pid\" value=\"$pid\">"
			."<input type=\"hidden\" name=\"pollID\" value=\"$pollID\">"
			."<input type=\"hidden\" name=\"op\" value=\"Reply\">"
			."<input type=\"submit\" value=\""._REPLYMAIN."\"></td></form></tr>";
		}
	}
	echo "<tr><td bgcolor=\"$bgcolor2\" align=\"center\"><font class=\"tiny\">"._COMMENTSWARNING."</font></td></tr>\n"
	."</table>"
	."\n\n<!-- COMMENTS NAVIGATION BAR END -->\n\n";
	CloseTable();
	if ($anonpost == 0 AND !is_user($user)) {
		echo "<br>";
		OpenTable();
		echo "<center>"._NOANONCOMMENTS."</center>";
		CloseTable();
	}
}

function DisplayKids ($tid, $mode, $order=0, $thold=0, $level=0, $dummy=0, $tblwidth=99) {
   global $datetime, $user, $cookie, $bgcolor1, $reasons, $anonymous, $anonpost, $commentlimit, $prefix, $module_name, $db, $userinfo, $user_prefix;
	$comments = 0;
                  cookiedecode($user);
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

	$tid = intval($tid);
	$result = $db->sql_query("SELECT tid, pid, pollID, date, name, email, host_name, subject, comment, score, reason from ".$prefix."_pollcomments where pid = '$tid' order by date, tid");
	if ($mode == 'nested') {
		/* without the tblwidth variable, the tables run off the screen with netscape
		in nested mode in long threads so the text can't be read. */
		while($row = $db->sql_fetchrow($result)) {
			$r_tid = intval($row['tid']);
			$r_pid = intval($row['pid']);
			$r_pollID = intval($row['pollID']);
			$r_date = $row['date'];
			$r_name = filter($row['name'], "nohtml");
			$r_email = filter($row['email'], "nohtml");
			$r_host_name = filter($row['host_name'], "nohtml");
			$r_subject = filter($row['subject'], "nohtml");
			$r_comment = filter($row['comment']);
			$r_score = intval($row['score']);
			$r_reason = intval($row['reason']);
			if($r_score >= $thold) {
				if (!isset($level)) {
				} else {
					if (!$comments) {
						echo "<ul>";
						$tblwidth -= 5;
					}
				}
				$comments++;
				if (!eregi("[a-z0-9]",$r_name)) $r_name = $anonymous;
				if (!eregi("[a-z0-9]",$r_subject)) $r_subject = "["._NOSUBJECT."]";
				// enter hex color between first two appostrophe for second alt bgcolor
				$r_bgcolor = ($dummy%2)?"":"#E6E6D2";
				echo "<a name=\"$r_tid\">";
				echo "<table width=90% border=0><tr bgcolor=\"$bgcolor1\"><td>";
				formatTimestamp($r_date);
				if ($r_email) {
					echo "<p><b>$r_subject</b> <font class=content>";
					if($userinfo['noscore'] == 0) {
						echo "("._SCORE." $r_score";
						if($r_reason>0) echo ", $reasons[$r_reason]";
						echo ")";
					}
					echo "<br>"._BY." <a href=\"mailto:$r_email\">$r_name</a> <font class=content><b>($r_email)</b></font> "._ON." $datetime";
				} else {
					echo "<p><b>$r_subject</b> <font class=content>";
					if($userinfo['noscore'] == 0) {
						echo "("._SCORE." $r_score";
						if($r_reason>0) echo ", $reasons[$r_reason]";
						echo ")";
					}
					echo "<br>"._BY." $r_name "._ON." $datetime";
				}
				if ($r_name != $anonymous) {
					$row2 = $db->sql_fetchrow($db->sql_query("SELECT user_id FROM ".$user_prefix."_users WHERE username='$r_name'"));
					$r_uid = intval($row2['user_id']);
					echo "<br>(<a href=\"modules.php?name=Your_Account&op=userinfo&username=$r_name\">"._USERINFO."</a> ";
                                        if(is_active("Private_Messages")) {
                                          echo "| <a href=\"modules.php?name=Private_Messages&mode=post&u=$r_uid\">"._SENDAMSG."</a> ";
				        }
				        echo ")";
                                }
				$row_url = $db->sql_fetchrow($db->sql_query("SELECT user_website FROM ".$prefix."_users WHERE username='$r_name'"));
				$url = filter($row_url['user_website'], "nohtml");
				if ($url != "http://" AND !empty($url) AND stripos_clone($url, "http://")) { echo "<a href=\"$url\" target=\"new\">$url</a> "; }
				echo "</font></td></tr><tr><td>";

				if((isset($userinfo['commentmax'])) && (strlen($r_comment) > $userinfo['commentmax'])) echo substr($r_comment, 0, $userinfo['commentmax'])."<br><br><b><a href=\"modules.php?name=$module_name&file=comments&pollID=$r_pollID&tid=$r_tid&mode=$mode&order=$order&thold=$thold\">"._READREST."</a></b>";
				elseif(strlen($r_comment) > $commentlimit) echo substr("$r_comment", 0, $commentlimit)."<br><br><b><a href=\"modules.php?name=$module_name&amp;file=comments&amp;pollID=$r_pollID&amp;tid=$r_tid&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._READREST."</a></b>";
				else echo $r_comment;
				echo "</td></tr></table><br><p>";
				if ($anonpost==1 OR is_admin($admin) OR is_user($user)) {
					echo "<font class=content color=\"$bgcolor2\"> [ <a href=\"modules.php?name=$module_name&amp;file=comments&amp;op=Reply&amp;pid=$r_tid&amp;pollID=$r_pollID&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._REPLY."</a>";
				}
				modtwo($r_tid, $r_score, $r_reason);
				echo " ]</font><p>";
				DisplayKids($r_tid, $mode, $order, $thold, $level+1, $dummy+1, $tblwidth);
			}
		}
	} elseif ($mode == 'flat') {
		while($row = $db->sql_fetchrow($result)) {
			$r_tid = intval($row['tid']);
			$r_pid = intval($row['pid']);
			$r_pollID = intval($row['pollID']);
			$r_date = $row['date'];
			$r_name = filter($row['name'], "nohtml");
			$r_email = filter($row['email'], "nohtml");
			$r_host_name = filter($row['host_name'], "nohtml");
			$r_subject = filter($row['subject'], "nohtml");
			$r_comment = filter($row['comment']);
			$r_score = intval($row['score']);
			$r_reason = intval($row['reason']);
			if($r_score >= $thold) {
				if (!eregi("[a-z0-9]",$r_name)) $r_name = $anonymous;
				if (!eregi("[a-z0-9]",$r_subject)) $r_subject = "["._NOSUBJECT."]";
				echo "<a name=\"$r_tid\">";
				echo "<hr><table width=99% border=0><tr bgcolor=\"$bgcolor1\"><td>";
				formatTimestamp($r_date);
				if ($r_email) {
					echo "<p><b>$r_subject</b> <font class=content>";
					if($userinfo['noscore'] == 0) {
						echo "("._SCORE." $r_score";
						if($r_reason>0) echo ", $reasons[$r_reason]";
						echo ")";
					}
					echo "<br>"._BY." <a href=\"mailto:$r_email\">$r_name</a> <font class=content><b>($r_email)</b></font> "._ON." $datetime";
				} else {
					echo "<p><b>$r_subject</b> <font class=content>";
					if($userinfo['noscore'] == 0) {
						echo "("._SCORE." $r_score";
						if($r_reason>0) echo ", $reasons[$r_reason]";
						echo ")";
					}
					echo "<br>"._BY." $r_name "._ON." $datetime";
				}
				if ($r_name != $anonymous) {
					$row3 = $db->sql_fetchrow($db->sql_query("SELECT user_id FROM ".$prefix."_users WHERE username='$r_name'"));
					$ruid = intval($row3['user_id']);
					echo "<BR>(<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$r_name\">"._USERINFO."</a> | <a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=$ruid\">"._SENDAMSG."</a>) ";
				}
				$row_url2 = $db->sql_fetchrow($db->sql_query("SELECT user_website FROM ".$prefix."_users WHERE username='$r_name'"));
				$url = filter($row_url2['user_website'], "nohtml");
				if ($url != "http://" AND !empty($url) AND eregi("http://", $url)) { echo "<a href=\"$url\" target=\"new\">$url</a> "; }
				echo "</font></td></tr><tr><td>";
				if((isset($userinfo['commentmax'])) && (strlen($r_comment) > $userinfo['commentmax'])) echo substr($r_comment, 0, $userinfo['commentmax'])."<br><br><b><a href=\"modules.php?name=$module_name&file=comments&pollID=$r_pollID&tid=$r_tid&mode=$mode&order=$order&thold=$thold\">"._READREST."</a></b>";
				elseif(strlen($r_comment) > $commentlimit) echo substr("$r_comment", 0, $commentlimit)."<br><br><b><a href=\"modules.php?name=$module_name&amp;file=comments&amp;pollID=$r_pollID&amp;tid=$r_tid&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._READREST."</a></b>";
				else echo $r_comment;
				echo "</td></tr></table><br><p><font class=content color=\"$bgcolor2\"> [ <a href=\"modules.php?name=$module_name&amp;file=comments&amp;op=Reply&amp;pid=$r_tid&amp;pollID=$r_pollID&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._REPLY."</a>";
				modtwo($r_tid, $r_score, $r_reason);
				echo " ]</font><p>";
				DisplayKids($r_tid, $mode, $order, $thold);
			}
		}
	} else {
		while($row = $db->sql_fetchrow($result)) {
			$r_tid = intval($row['tid']);
			$r_pid = intval($row['pid']);
			$r_pollID = intval($row['pollID']);
			$r_date = $row['date'];
			$r_name = filter($row['name'], "nohtml");
			$r_email = filter($row['email'], "nohtml");
			$r_host_name = $row['host_name'];
			$r_subject = filter($row['subject'], "nohtml");
			$r_comment = filter($row['comment']);
			$r_score = intval($row['score']);
			$r_reason = intval($row['reason']);
			if($r_score >= $thold) {
				if (isset($level) && !$comments) {
				  echo "<ul>";
				}
				$comments++;
				if (!eregi("[a-z0-9]",$r_name)) $r_name = $anonymous;
				if (!eregi("[a-z0-9]",$r_subject)) $r_subject = "["._NOSUBJECT."]";
				formatTimestamp($r_date);
				echo "<li><font class=\"content\"><a href=\"modules.php?name=$module_name&amp;file=comments&amp;op=showreply&amp;tid=$r_tid&amp;pollID=$r_pollID&amp;pid=$r_pid&amp;mode=$mode&amp;order=$order&amp;thold=$thold#$r_tid\">$r_subject</a> "._BY." $r_name "._ON." $datetime</font><br>";
				DisplayKids($r_tid, $mode, $order, $thold, $level+1, $dummy+1);
			}
		}
	}
	if ($level && $comments) {
		echo "</ul>";
	}

}

function DisplayBabies ($tid, $level=0, $dummy=0) {
	global $userinfo, $datetime, $anonymous, $prefix, $db, $module_name;
	$comments = 0;
	$tid = intval($tid);
	$result = $db->sql_query("SELECT tid, pid, pollID, date, name, email, host_name, subject, comment, score, reason from ".$prefix."_pollcomments where pid = '$tid' order by date, tid");
	while($row = $db->sql_fetchrow($result)) {
		$r_tid = intval($row['tid']);
		$r_pid = intval($row['pid']);
		$r_pollID = intval($row['pollID']);
		$r_date = $row['date'];
		$r_name = filter($row['name'], "nohtml");
		$r_email = filter($row['email'], "nohtml");
		$r_host_name = filter($row['host_name'], "nohtml");
		$r_subject = filter($row['subject'], "nohtml");
		$r_comment = filter($row['comment']);
		$r_score = intval($row['score']);
		$r_reason = intval($row['reason']);
		if (!isset($level)) {
		} else {
			if (!$comments) {
				echo "<ul>";
			}
		}
		$comments++;
		if (!eregi("[a-z0-9]",$r_name)) { $r_name = $anonymous; }
		if (!eregi("[a-z0-9]",$r_subject)) { $r_subject = "["._NOSUBJECT."]"; }
		formatTimestamp($r_date);
		echo "<a href=\"modules.php?name=$module_name&amp;file=comments&amp;op=showreply&amp;tid=$r_tid&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">$r_subject</a><font class=\"content\"> "._BY." $r_name "._ON." $datetime<br>";
		DisplayBabies($r_tid, $level+1, $dummy+1);
	}
	if ($level && $comments) {
		echo "</ul>";
	}
}

function DisplayTopic ($pollID, $pid=0, $tid=0, $mode="thread", $order=0, $thold=0, $level=0, $nokids=0) {
	global $hr, $user, $datetime, $cookie, $userinfo, $admin, $commentlimit, $anonymous, $reasons, $anonpost, $foot1, $foot2, $foot3, $foot4, $prefix, $module_name, $db, $admin_file, $user_prefix;
	if (defined('NUKE_FILE')) {
		global $title, $bgcolor1, $bgcolor2, $bgcolor3;
	} else {
		global $title, $bgcolor1, $bgcolor2, $bgcolor3;
		include("mainfile.php");
		include("header.php");
	}
	if ($pid!=0) {
		include("header.php");
	}
	$count_times = 0;
                  cookiedecode($user);
                  getusrinfo($user);
	$pollID = intval($pollID);
	$pid = intval($pid);
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
	$tid = intval($tid);
	$q = "select tid, pid, pollID, date, name, email, host_name, subject, comment, score, reason from ".$prefix."_pollcomments where pollID='$pollID' and pid='$pid'";
	if(!empty($thold)) {
		$q .= " and score>='$thold'";
	} else {
		$q .= " and score>='0'";
	}
	if ($order==1) $q .= " order by date desc";
	if ($order==2) $q .= " order by score desc";
	$something = $db->sql_query($q);
	$num_tid = $db->sql_numrows($something);
	navbar($pollID, $title, $thold, $mode, $order);
	modone();
	while ($count_times < $num_tid) {
		echo "<br>";
		OpenTable();
		$row_q = $db->sql_fetchrow($something);
		$tid = intval($row_q['tid']);
		$pid = intval($row_q['pid']);
		$pollID = intval($row_q['pollID']);
		$date = $row_q['date'];
		$c_name = filter($row_q['name'], "nohtml");
		$email = filter($row_q['email'], "nohtml");
		$host_name = filter($row_q['host_name'], "nohtml");
		$subject = filter($row_q['subject'], "nohtml");
		$comment = filter($row_q['comment']);
		$score = intval($row_q['score']);
		$reason = intval($row_q['reason']);
		$karma = $db->sql_fetchrow($db->sql_query("SELECT karma FROM ".$user_prefix."_users WHERE username='$c_name'"));
		$karma = intval($karma['karma']);
		if (is_admin($admin)) {
			if ($karma == 1) {
				$karma = "<img src=\"images/karma/1.gif\" border=\"0\" alt=\""._KARMALOW."\" title=\""._KARMALOW."\">&nbsp;";
			} elseif ($karma == 2) {
				$karma = "<img src=\"images/karma/2.gif\" border=\"0\" alt=\""._KARMABAD."\" title=\""._KARMABAD."\">&nbsp;";
			} elseif ($karma == 3) {
				$karma = "<img src=\"images/karma/3.gif\" border=\"0\" alt=\""._KARMADEVIL."\" title=\""._KARMADEVIL."\">&nbsp;";
			} else {
				$karma = "";	
			}
		} else {
			$karma = "";	
		}
		if (empty($c_name)) { $c_name = $anonymous; }
		if (empty($subject)) { $subject = "["._NOSUBJECT."]"; }
		echo "<a name=\"$tid\">";
		echo "<table width=99% border=0><tr bgcolor=\"$bgcolor1\"><td width=500>";
		formatTimestamp($date);
		if ($email) {
			echo "<p><b>$subject</b> <font class=content>";
			if($userinfo['noscore'] == 0) {
				echo "("._SCORE." $score";
				if($reason>0) echo ", $reasons[$reason]";
				echo ")";
			}
			echo "<br>"._BY." <a href=\"mailto:$email\">$c_name</a> <b>($email)</b> "._ON." $datetime";
		} else {
			echo "<p><b>$subject</b> <font class=content>";
			if($userinfo['noscore'] == 0) {
				echo "("._SCORE." $score";
				if($reason>0) echo ", $reasons[$reason]";
				echo ")";
			}
			echo "<br>"._BY." $c_name "._ON." $datetime";
		}

		// If you are admin you can see the Poster IP address (you have this right, no?)
		// with this you can see who is flaming you... ha-ha-ha

		$journal = "";
		if (is_active("Journal")) {
			$row = $db->sql_fetchrow($db->sql_query("SELECT jid from ".$prefix."_journal where aid='$c_name' AND status='yes' order by pdate,jid DESC limit 0,1"));
			$jid = intval($row['jid']);
			if (!empty($jid) AND isset($jid)) {
				$journal = " | <a href=\"modules.php?name=Journal&amp;file=display&amp;jid=$jid\">"._JOURNAL."</a>";
			} else {
				$journal = "";
			}
		}
		if ($c_name != $anonymous) {
			$row2 = $db->sql_fetchrow($db->sql_query("SELECT user_id FROM ".$user_prefix."_users WHERE username='$c_name'"));
			$r_uid = intval($row2['user_id']);
			echo "<br>(<a href=\"modules.php?name=Your_Account&op=userinfo&username=$c_name\">"._USERINFO."</a> ";
                        if(is_active("Private_Messages")) {
                          echo "| <a href=\"modules.php?name=Private_Messages&mode=post&u=$r_uid\">"._SENDAMSG."</a>";
                        }
                        echo "$journal) ";
		}
		$row_url = $db->sql_fetchrow($db->sql_query("SELECT user_website FROM ".$prefix."_users WHERE username='$c_name'"));
		$url = filter($row_url['user_website'], "nohtml");
		if ($url != "http://" AND !empty($url) AND stripos_clone($url, "http://")) { echo "<a href=\"$url\" target=\"new\">$url</a> "; }

		if(is_admin($admin)) {
			$row3 = $db->sql_fetchrow($db->sql_query("SELECT host_name from ".$prefix."_pollcomments where tid='$tid'"));
			$host_name = filter($row3['host_name'], "nohtml");
			echo "<br><b>(IP: $host_name)</b> $karma";
		}

		echo "</font></td></tr><tr><td>";
		if((isset($userinfo['commentmax'])) && (strlen($comment) > $userinfo['commentmax'])) echo substr("$comment", 0, $userinfo['commentmax'])."<br><br><b><a href=\"modules.php?name=$module_name&file=comments&pollID=$r_pollID&tid=$r_tid&mode=$mode&order=$order&thold=$thold\">"._READREST."</a></b>";
		elseif(strlen($comment) > $commentlimit) echo substr("$comment", 0, $commentlimit)."<br><br><b><a href=\"modules.php?name=$module_name&amp;file=comments&amp;pollID=$pollID&tid=$tid&mode=$mode&order=$order&thold=$thold\">"._READREST."</a></b>";
		else echo $comment;
		echo "</td></tr></table><br><p>";
		if ($anonpost==1 OR is_admin($admin) OR is_user($user)) {
			echo "<font class=\"content\"> [ <a href=\"modules.php?name=$module_name&amp;file=comments&amp;op=Reply&amp;pid=$tid&amp;pollID=$pollID&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._REPLY."</a>";
		}
		if ($pid != 0) {
			$row4 = $db->sql_fetchrow($db->sql_query("SELECT pid from ".$prefix."_pollcomments where tid='$pid'"));
			$erin = intval($row4['pid']);
			echo "| <a href=\"modules.php?name=$module_name&amp;file=comments&amp;pollID=$pollID&amp;pid=$erin&amp;mode=$mode&amp;order=$order&amp;thold=$thold\">"._PARENT."</a>";
		}
		modtwo($tid, $score, $reason);

		if(is_admin($admin)) {
			echo " | <a href=\"".$admin_file.".php?op=RemovePollComment&amp;tid=$tid&amp;pollID=$pollID\">"._DELETE."</a> ]</font><p>";
		} elseif ($anonpost != 0 OR is_admin($admin) OR is_user($user)) {
			echo " ]</font><p>";
		}

		DisplayKids($tid, $mode, $order, $thold, $level);
		echo "</ul>";
		if($hr) echo "<hr noshade size=1>";
		echo "</p>";
		$count_times += 1;
		CloseTable();
	}
	modthree($pollID, $mode, $order, $thold);
	if($pid==0) return array($pollID, $pid, $subject);
	else include_once("footer.php");
}

function singlecomment($tid, $pollID, $mode, $order, $thold) {
	include_once("header.php");
	global $userinfo, $user, $cookie, $datetime, $bgcolor1, $bgcolor2, $bgcolor3, $anonpost, $admin, $anonymous, $prefix, $db, $module_name;
                  cookiedecode($user);
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
	$tid = intval($tid);
	$pollID = intval($pollID);
	$row = $db->sql_fetchrow($db->sql_query("SELECT date, name, email, subject, comment, score, reason from ".$prefix."_pollcomments where tid='$tid' and pollID='$pollID'"));
	$date = $row['date'];
	$name = filter($row['name'], "nohtml");
	$email = filter($row['email'], "nohtml");
	$subject = filter($row['subject'], "nohtml");
	$comment = filter($row['comment']);
	$score = intval($row['score']);
	$reason = intval($row['reason']);
	$titlebar = "<b>$subject</b>";
	if(empty($name)) $name = $anonymous;
	if(empty($subject)) $subject = "["._NOSUBJECT."]";
	modone();
	echo "<table width=99% border=0><tr bgcolor=\"$bgcolor1\"><td width=500>";
	formatTimestamp($date);
	if($email) echo "<p><b>$subject</b> <font class=content>("._SCORE." $score)<br>"._BY." <a href=\"mailto:$email\"><font color=\"$bgcolor2\">$name</font></a> <font class=content><b>($email)</b></font> "._ON." $datetime";
	else echo "<p><b>$subject</b> <font class=content>("._SCORE." $score)<br>"._BY." $name "._ON." $datetime";
	echo "</td></tr><tr><td>$comment</td></tr></table><br><p><font class=content color=\"$bgcolor2\"> [ <a href=\"modules.php?name=$module_name&amp;file=comments&amp;op=Reply&pid=$tid&pollID=$pollID&mode=$mode&order=$order&thold=$thold\">"._REPLY."</a> | <a href=\"modules.php?name=$module_name&amp;pollID=$pollID\">"._ROOT."</a>";
	modtwo($tid, $score, $reason);
	echo " ]";
	modthree($pollID, $mode, $order, $thold);
	include_once("footer.php");
}

function reply ($pid, $pollID, $mode, $order, $thold) {
	include_once("header.php");
	global $userinfo, $user, $cookie, $datetime, $bgcolor1, $bgcolor2, $bgcolor3, $AllowableHTML, $anonymous, $prefix, $anonpost, $module_name, $db, $nuke_editor;
                  cookiedecode($user);
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
	$pid = intval($pid);
	$pollID = intval($pollID);
	$order = htmlentities($order);
	$thold = htmlentities($thold);
	$mode = htmlentities($mode);
	if ($anonpost == 0 AND !is_user($user)) {
		OpenTable();
		echo "<center><font class=title><b>"._SURVEYCOM."</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center>"._NOANONCOMMENTS."<br><br>"._GOBACK."</center>";
		CloseTable();
	} else {
		if($pid!=0) {
			list($date, $name, $email, $subject, $comment, $score) = $db->sql_fetchrow($db->sql_query("select date, name, email, subject, comment, score from ".$prefix."_pollcomments where tid='$pid'"));
			$name = filter($name, "nohtml");
			$email = filter($email, "nohtml");
			$subject = filter($subject, "nohtml");
			$comment = filter($comment);
			$score = intval($score);
		} else {
			list($subject) = $db->sql_fetchrow($db->sql_query("select pollTitle FROM ".$prefix."_poll_desc where pollID='$pollID'"));
			$subject = filter($subject, "nohtml");
		}
		if(empty($comment)) {
			$comment = $temp_comment;
		}
		$titlebar = "<b>$subject</b>";
		if(empty($name)) $name = $anonymous;
		if(empty($subject)) $subject = "["._NOSUBJECT."]";
		formatTimestamp($date);
		OpenTable();
		echo "<center><font class=\"title\"><b>"._SURVEYCOM."</b></font></center>";
		CloseTable();
		echo "<br>";
		OpenTable();
		echo "<center><font class=\"content\"><b>$subject</b></center><br>";
		if (empty($comment)) {
			echo "<center><i>"._DIRECTCOM."</i></font></center><br>";
		} else {
			echo "<br>$comment</font>";
		}
		CloseTable();
		if(!isset($pid) || !isset($pollID)) { echo "Something is not right. This message is just to keep things from messing up down the road"; exit(); }
		if($pid == 0) {
			list($subject) = $db->sql_fetchrow($db->sql_query("select pollTitle from ".$prefix."_poll_desc where pollID='$pollID'"));
		} else {
			list($subject) = $db->sql_fetchrow($db->sql_query("select subject from ".$prefix."_pollcomments where tid='$pid'"));
		}
		$subject = filter($subject, "nohtml");
		echo "<br>";
		OpenTable();
		echo "<form action=\"modules.php?name=$module_name&amp;file=comments\" method=\"post\">";
		echo "<font class=\"content\"><b>"._YOURNAME.":</b></font> ";
		if (is_user($user)) {
			cookiedecode($user);
			echo "<font class=\"content\"><a href=\"modules.php?name=Your_Account\">$cookie[1]</a> [ <a href=\"modules.php?name=Your_Account&amp;op=logout\">"._LOGOUT."</a> ]</font>";
		} else {
			echo "<font class=\"content\">$anonymous</font>";
			$xanonpost=1;
		}
		echo "<br><br><font class=\"content\"><B>"._SUBJECT.":</B></FONT><BR>";
		if (!stripos_clone($subject,"Re:")) $subject = "Re: ".substr($subject,0,81)."";
		echo "<INPUT TYPE=\"text\" NAME=\"subject\" SIZE=50 maxlength=85 value=\"$subject\"><BR>";
		echo "<br><br><font class=\"content\"><B>"._UCOMMENT.":</B></FONT><BR>"
		."<TEXTAREA wrap=virtual cols=70 rows=15 name=comment></TEXTAREA><br>";
		if ($nuke_editor == 0) {
	    	echo "<font class=\"content\">"._ALLOWEDHTML."<br>";
	    	while (list($key,) = each($AllowableHTML)) echo " &lt;".$key."&gt;";
	    	echo "</font><br><br>";
		} else {
			echo ""._HTMLNOTALLOWED."</font><br><br>";
		}
		if (is_user($user) AND ($anonpost == 1)) { echo "<INPUT type=checkbox name=xanonpost> "._POSTANON."<br>"; }
		echo "<INPUT type=\"hidden\" name=\"pid\" value=\"$pid\">"
		."<INPUT type=\"hidden\" name=\"pollID\" value=\"$pollID\">"
		."<INPUT type=\"hidden\" name=\"mode\" value=\"$mode\">"
		."<INPUT type=\"hidden\" name=\"order\" value=\"$order\">"
		."<INPUT type=\"hidden\" name=\"thold\" value=\"$thold\">"
		."<br><INPUT type=submit name=op value=\""._PREVIEW."\"> "
		."<INPUT type=submit name=op value=\""._OK."\"></FORM>";
		CloseTable();
	}
	include_once("footer.php");
}

function replyPreview ($pid, $pollID, $subject, $comment, $xanonpost, $mode, $order, $thold) {
	include_once("header.php");
	global $userinfo, $user, $cookie, $AllowableHTML, $anonymous, $module_name, $nuke_editor;
	cookiedecode($user);
                  getusrinfo($user);
	$subject = filter($subject, "nohtml", 0, preview);
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
	$comment = filter($comment);
	$pid = intval($pid);
	$pollID = intval($pollID);
	if (!isset($pid) || !isset($pollID)) {
		die(_NOTRIGHT);
	}
	OpenTable();
	echo "<center><font class=\"title\"><b>"._SURVEYCOMPRE."</b></font></center>";
	CloseTable();
	echo "<br>";
	OpenTable();
	echo "<b>$subject</b><br>";
	echo "<font class=content>"._BY." ";
	if (is_user($user)) {
		echo $cookie[1];
	} else {
		echo $anonymous;
	}
	echo _ONN."</font><br><br>";
	echo $comment;
	CloseTable();
	echo "<br>";
	OpenTable();
	echo "<form action=\"modules.php?name=$module_name&amp;file=comments\" method=\"post\">"
	."<font class=\"content\"><B>"._YOURNAME.":</B></FONT> ";
	if (is_user($user)) {
		echo "<font class=\"content\"><a href=\"modules.php?name=Your_Account\">$cookie[1]</a> <font class=\"content\">[ <a href=\"modules.php?name=Your_Account&amp;op=logout\">"._LOGOUT."</a> ]</font>";
	} else {
		echo "<font class=\"content\">$anonymous</font>";
	}
	echo "<br><br><font class=\"content\"><B>"._SUBJECT.":</B></FONT><BR>"
	."<INPUT TYPE=\"text\" name=\"subject\" size=\"50\" maxlength=\"85\" value=\"$subject\"><br><br>"
	."<P><font class=\"content\"><B>"._UCOMMENT.":</B></FONT><BR>"
	."<TEXTAREA wrap=\"virtual\" cols=\"70\" rows=\"15\" name=\"comment\">$comment</TEXTAREA><br>";
	if ($nuke_editor == 0) {
    	echo "<font class=\"content\">"._ALLOWEDHTML."<br>";
    	while (list($key,) = each($AllowableHTML)) echo " &lt;".$key."&gt;";
    	echo "</font><br><br>";
	} else {
		echo ""._HTMLNOTALLOWED."</font><br><br>";
	}
	if (($xanonpost) AND ($anonpost == 1)) {
		echo "<INPUT type=\"checkbox\" name=\"xanonpost\" checked> "._POSTANON."<br>";
	} elseif ((is_user($user)) AND ($anonpost == 1)) {
		echo "<INPUT type=\"checkbox\" name=\"xanonpost\"> "._POSTANON."<br>";
	}
	echo "<INPUT type=\"hidden\" name=\"pid\" value=\"$pid\">"
	."<INPUT type=\"hidden\" name=\"pollID\" value=\"$pollID\"><INPUT type=\"hidden\" name=\"mode\" value=\"$mode\">"
	."<INPUT type=\"hidden\" name=\"order\" value=\"$order\"><INPUT type=\"hidden\" name=\"thold\" value=\"$thold\">"
	."<br><INPUT type=submit name=op value=\""._PREVIEW."\"> "
	."<INPUT type=submit name=op value=\""._OK."\"></FORM>";
	CloseTable();
	include_once("footer.php");
}

function CreateTopic ($xanonpost, $subject, $comment, $pid, $pollID, $host_name, $mode, $order, $thold) {
	global $userinfo, $user, $userinfo, $EditedMessage, $cookie, $prefix, $pollcomm, $anonpost, $db, $module_name, $user_prefix;
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
	$pollID = intval($pollID);
	$pid = intval($pid);
	$author = filter($author, "nohtml", 1);
	$subject = filter($subject, "nohtml", 1);
	$comment = format_url($comment);
	$comment = filter($comment, "", 1);
	if ((is_user($user)) && (!$xanonpost)) {
		$name = $userinfo['username'];
		$email = $userinfo['femail'];
		$url = $userinfo['user_website'];
		$score = 1;
	} else {
		$name = "";
		$email = "";
		$url = "";
		$score = 0;
	}
        if(!isset($ip)) {
          $ip = $_SERVER['REMOTE_ADDR'];
        }
	$pollID = intval($pollID);
	$result = $db->sql_query("select count(*) from ".$prefix."_poll_desc where pollID='$pollID'");
	$fake = $db->sql_numrows($result);
	if ($fake == 1) {
		if ((($anonpost == 0) AND (is_user($user))) OR ($anonpost == 1)) {
			if (is_user($user)) {
				$krow = $db->sql_fetchrow($db->sql_query("SELECT karma FROM ".$user_prefix."_users WHERE username='$name'"));
				$koptions = "&mode=".$mode."&order=".$order."&thold=".$thold;
				if ($krow['karma'] == 2) {
					$db->sql_query("INSERT INTO ".$prefix."_pollcomments_moderated VALUES (NULL, '$pid', '$pollID', now(), '$name', '$email', '$url', '$ip', '$subject', '$comment', '$score', '0', '0')");
					include_once("header.php");
					title(""._MODERATEDTITLE."");
					OpenTable();
					echo "<center>"._COMMENTMODERATED."";
					echo "<br><br><a href=\"modules.php?name=$module_name&op=results&pollID=$pollID$koptions\">"._MODERATEDTITLE."</a>";
					CloseTable();
					include_once("footer.php");
					die();
				} elseif ($krow['karma'] == 3) {
					Header("Location: modules.php?name=$module_name&op=results&pollID=$pollID$koptions");
					die();
				}
			}
			$db->sql_query("insert into ".$prefix."_pollcomments values (NULL, '$pid', '$pollID', now(), '$name', '$email', '$url', '$ip', '$subject', '$comment', '$score', '0', '0')");
			$db->sql_query("UPDATE ".$prefix."_poll_desc SET comments=comments+1 WHERE pollID='$pollID'");
			update_points(9);
		} else {
			die("Nice try...");
		}
	} else {
		include_once("header.php");
		echo "According to my records, the topic you are trying "
		."to reply to does not exist. If you're just trying to be "
		."annoying, well then too bad.";
		include_once("footer.php");
		die();
	}
	if ($pollcomm == 1) {
	  $options = "&mode=".$mode."&order=".$order."&thold=".$thold;
	  Header("Location: modules.php?name=$module_name&op=results&pollID=$pollID$options");
	}
}

if (isset($sid)) { $sid = intval($sid); } else { $sid = ""; }
if (isset($pollID)) { $pollID = intval($pollID); } else { $pollID = ""; }
if (isset($tid)) { $tid = intval($tid); } else { $tid = ""; }
if (isset($pid)) { $pid = intval($pid); } else { $pid = ""; }
if (isset($order)) { $order = intval($order); }
if (isset($thold)) { $thold = intval($thold); }

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

switch($op) {

	case "Reply":
	reply($pid, $pollID, $mode, $order, $thold);
	break;

	case ""._PREVIEW."":
	replyPreview ($pid, $pollID, $subject, $comment, $xanonpost, $mode, $order, $thold);
	break;

	case ""._OK."":
	CreateTopic($xanonpost, $subject, $comment, $pid, $pollID, $host_name, $mode, $order, $thold);
	break;

	case "moderate":
	if(!is_admin($admin)) {
		global $module_name;
	}
	if(($admintest==1) || ($moderate==2)) {
		while(list($tdw, $emp) = each($_POST)) {
                                $tdw = intval($tdw);
			if (stripos_clone($tdw,"dkn")) {
				$emp = explode(":", $emp);
				if($emp[1] != 0) {
					$tdw = str_replace("dkn", "", $tdw);
					$emp[0] = intval($emp[0]); 
					$emp[1] = intval($emp[1]); 
					$tdw = intval($tdw); 
					$q = "UPDATE ".$prefix."_pollcomments SET";
					if(($emp[1] == 9) && ($emp[0]>=0)) { # Overrated
						$q .= " score=score-1 where tid='$tdw'";
					} elseif (($emp[1] == 10) && ($emp[0]<=4)) { # Underrated
						$q .= " score=score+1 where tid='$tdw'";
					} elseif (($emp[1] > 4) && ($emp[0]<=4)) {
						$q .= " score=score+1, reason='$emp[1]' where tid='$tdw'";
					} elseif (($emp[1] < 5) && ($emp[0] > -1)) {
						$q .= " score=score-1, reason='$emp[1]' where tid='$tdw'";
					} elseif (($emp[0] == -1) || ($emp[0] == 5)) {
						$q .= " reason='$emp[1]' where tid='$tdw'";
					}
					$row = $db->sql_fetchrow($db->sql_query("SELECT last_moderation_ip FROM ".$prefix."_pollcomments WHERE tid='$tdw'"));
					$ip = $_SERVER['REMOTE_ADDR'];
					if(strlen($q) > 20 && $row['last_moderation_ip'] != $ip) {
						$db->sql_query($q);
						$db->sql_query("UPDATE ".$prefix."_pollcomments SET last_moderation_ip='$ip' WHERE tid='$tdw'");
					}
				}
			}
		}
	}
	Header("Location: modules.php?name=$module_name&op=results&pollID=$pollID");
	break;

	case "showreply":
	DisplayTopic($pollID, $pid, $tid, $mode, $order, $thold);
	break;

	default:
	    global $module_name, $mode, $userinfo, $order, $thold;
	if ((isset($tid)) && (!isset($pid))) {
		singlecomment($tid, $pollID, $mode, $order, $thold);
	} elseif (!isset($pid)) {
		Header("Location: modules.php?name=$module_name&op=results&pollID=$pollID&mode=$mode&order=$order&thold=$thold");
	} else {
		if(!isset($pid)) $pid=0;
		if(!isset($tid)) $tid=0;
		DisplayTopic($pollID, $pid, $tid, $mode, $order, $thold);
	}
	break;
}

?>