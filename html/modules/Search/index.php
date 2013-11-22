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
$instory = ''; 
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

if (isset($query)) {
	if (strlen($query) < 3) {
		Header("Location: modules.php?name=$module_name&qlen=1");
	}
}

global $admin, $prefix, $db, $module_name, $articlecomm, $multilingual, $admin_file;
if ($multilingual == 1) {
	$queryalang = "AND (s.alanguage='$currentlang' OR s.alanguage='')"; /* stories */
	$queryrlang = "AND rlanguage='$currentlang' "; /* reviews */
} else {
	$queryalang = "";
	$queryrlang = "";
	$queryslang = "";
}

	if (!isset($query)) { $query = ""; }
	if (!isset($type)) { $type = ""; }
	if (!isset($category)) { $category = 0; }
	if (!isset($days)) { $days = 0; }
	if (!isset($author)) { $author = ""; }

switch($op) {

	case "comments":
	break;

	default:
	$ThemeSel = get_theme();
	$offset=10;
	if (!isset($min)) $min=0;
	if (!isset($max)) $max=$min+$offset;
    $min = intval($min);
    $max = intval($max);
	$query = stripslashes(check_html($query, "nohtml"));
	$pagetitle = "- "._SEARCH."";
	include("header.php");
	$topic = intval($topic);
	if ($topic>0) {
		$row = $db->sql_fetchrow($db->sql_query("SELECT topicimage, topictext from ".$prefix."_topics where topicid='$topic'"));
		$topicimage = filter($row['topicimage'], "nohtml");
		$topictext = filter($row['topictext'], "nohtml");
		if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
			$topicimage = "themes/$ThemeSel/images/topics/$topicimage";
		} else {
			$topicimage = "$tipath/$topicimage";
		}
	} else {
		$topictext = ""._ALLTOPICS."";
		if (file_exists("themes/$ThemeSel/images/topics/AllTopics.gif")) {
			$topicimage = "themes/$ThemeSel/images/topics/AllTopics.gif";
		} else {
			$topicimage = "$tipath/AllTopics.gif";
		}
	}
	if (file_exists("themes/$ThemeSel/images/topics/AllTopics.gif")) {
		$alltop = "themes/$ThemeSel/images/topics/AllTopics.gif";
	} else {
		$alltop = "$tipath/AllTopics.gif";
	}
	OpenTable();
	if ($type == "users") {
		echo "<center><font class=\"title\"><b>"._SEARCHUSERS."</b></font></center><br>";
	} elseif ($type == "reviews") {
		echo "<center><font class=\"title\"><b>"._SEARCHREVIEWS."</b></font></center><br>";
	} elseif ($type == "comments" AND isset($sid)) {
		$res = $db->sql_query("select title from ".$prefix."_stories where sid='$sid'");
		list($st_title) = $db->sql_fetchrow($res);
		$st_title = filter($st_title, "nohtml");
		$instory = "AND sid='$sid'";
		echo "<center><font class=\"title\"><b>"._SEARCHINSTORY." $st_title</b></font></center><br>";
	} else {
		echo "<center><font class=\"title\"><b>"._SEARCHIN." $topictext</b></font></center><br>";
	}

	echo "<table width=\"100%\" border=\"0\"><TR><TD>";
	if (($type == "users") OR ($type == "reviews")) {
		echo "<img src=\"$alltop\" align=\"right\" border=\"0\" alt=\"\">";
	} else {
		echo "<img src=\"$topicimage\" align=\"right\" border=\"0\" alt=\"$topictext\">";
	}
	echo "<form action=\"modules.php?name=$module_name\" method=\"POST\">"
	."<input size=\"25\" type=\"text\" name=\"query\" value=\"$query\">&nbsp;&nbsp;"
	."<input type=\"submit\" value=\""._SEARCH."\"><br><br>";
	if (isset($sid)) {
		echo "<input type='hidden' name='sid' value='$sid'>";
	}
	echo "<!-- Topic Selection -->";
	$toplist = $db->sql_query("SELECT topicid, topictext from ".$prefix."_topics order by topictext");
	echo "<select name=\"topic\">";
	echo "<option value=\"\">"._ALLTOPICS."</option>\n";
	while($row2 = $db->sql_fetchrow($toplist)) {
		$topicid = intval($row2['topicid']);
		$topics = filter($row2['topictext'], "nohtml");
		if ($topicid==$topic) { $sel = "selected "; }
		echo "<option $sel value=\"$topicid\">$topics</option>\n";
		$sel = "";
	}
	echo "</select>";
	/* Category Selection */
	$category = intval($category);
	echo "&nbsp;<select name=\"category\">";
	echo "<option value=\"0\">"._ARTICLES."</option>\n";
	$result3 = $db->sql_query("SELECT catid, title from ".$prefix."_stories_cat order by title");
	while ($row3 = $db->sql_fetchrow($result3)) {
		$catid = intval($row3['catid']);
		$title = filter($row3['title'], "nohtml");
		if ($catid==$category) { $sel = "selected "; }
		echo "<option $sel value=\"$catid\">$title</option>\n";
		$sel = "";
	}
	echo "</select>";
	/* Authors Selection */
	$thing = $db->sql_query("SELECT aid from ".$prefix."_authors order by aid");
	echo "&nbsp;<select name=\"author\">";
	echo "<option value=\"\">"._ALLAUTHORS."</option>\n";
	while($row4 = $db->sql_fetchrow($thing)) {
		$authors = filter($row4['aid'], "nohtml");
		if ($authors==$author) { $sel = "selected "; }
		echo "<option value=\"$authors\">$authors</option>\n";
		$sel = "";
	}
	echo "</select>";
	/* Date Selection */
                ?>
		&nbsp;<select name="days">
                        <option <?php echo $days == 0 ? "selected " : ""; ?> value="0"><?php echo _ALL ?></option>
                        <option <?php echo $days == 7 ? "selected " : ""; ?> value="7">1 <?php echo _WEEK ?></option>
                        <option <?php echo $days == 14 ? "selected " : ""; ?> value="14">2 <?php echo _WEEKS ?></option>
                        <option <?php echo $days == 30 ? "selected " : ""; ?> value="30">1 <?php echo _MONTH ?></option>
			<option <?php echo $days == 60 ? "selected " : ""; ?> value="60">2 <?php echo _MONTHS ?></option>
                        <option <?php echo $days == 90 ? "selected " : ""; ?> value="90">3 <?php echo _MONTHS ?></option>
                </select><br>
		<?php
		$sel1 = $sel2 = $sel3 = $sel4 = "";
		if (($type == "stories") OR (empty($type))) {
			$sel1 = "checked";
		} elseif ($type == "comments") {
			$sel2 = "checked";
		} elseif ($type == "users") {
			$sel3 = "checked";
		} elseif ($type == "reviews") {
			$sel4 = "checked";
		}
		$num_rev = $db->sql_numrows($db->sql_query("SELECT * from ".$prefix."_reviews"));
		echo ""._SEARCHON."";
		echo "<input type=\"radio\" name=\"type\" value=\"stories\" $sel1> "._SSTORIES."";
		if ($articlecomm == 1) {
			echo "<input type=\"radio\" name=\"type\" value=\"comments\" $sel2> "._SCOMMENTS."";
		}
		echo "<input type=\"radio\" name=\"type\" value=\"users\" $sel3> "._SUSERS."";
		if ($num_rev > 0) {
			echo "<input type=\"radio\" name=\"type\" value=\"reviews\" $sel4> "._REVIEWS."";
		}
		echo "</form></td></tr></table>";
		if ($qlen == 1) {
			OpenTable();
			echo ""._SEARCHCHARACTERS."";
			CloseTable();
		}
		$query = stripslashes(check_html($query, "nohtml"));
		$query2 = filter($query, "nohtml", 1);
		$query3 = filter($query, "", 1);
		if ($type=="stories" OR !$type) {

			if ($category > 0) {
				$categ = "AND catid='$category' ";
			} else {
				$categ = "";
			}
			$q = "select s.sid, s.aid, s.informant, s.title, s.time, s.hometext, s.bodytext, a.url, s.comments, s.topic from ".$prefix."_stories s, ".$prefix."_authors a where s.aid=a.aid $queryalang $categ";
			if (isset($query)) $q .= "AND (s.title LIKE '%$query2%' OR s.hometext LIKE '%$query3%' OR s.bodytext LIKE '%$query3%' OR s.notes LIKE '%$query3%') ";
			if (!empty($author)) $q .= "AND s.aid='$author' ";
			if (!empty($topic)) $q .= "AND s.topic='$topic' ";
			if (!empty($days) && $days!=0) $q .= "AND TO_DAYS(NOW()) - TO_DAYS(time) <= '$days' ";
			$q .= " ORDER BY s.time DESC LIMIT $min,$offset";
			$t = $topic;
			$result5 = $db->sql_query($q);
			$nrows = $db->sql_numrows($result5);
			$x=0;
			if (!empty($query)) {
				echo "<br><hr noshade size=\"1\"><center><b>"._SEARCHRESULTS."</b></center><br><br>";
				echo "<table width=\"99%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
				if ($nrows>0) {
					while($row5 = $db->sql_fetchrow($result5)) {
						$sid = intval($row5['sid']);
						$aid = stripslashes($row5['aid']);
						$informant = filter($row5['informant'], "nohtml");
						$title = filter($row5['title'], "nohtml");
						$time = $row5['time'];
						$hometext = filter($row5['hometext']);
						$bodytext = filter($row5['bodytext']);
						$url = filter($row5['url'], "nohtml");
						$comments = intval($row5['comments']);
						$topic = intval($row5['topic']);
						$row6 = $db->sql_fetchrow($db->sql_query("SELECT topictext from ".$prefix."_topics where topicid='$topic'"));
						$topictext = filter($row6['topictext'], "nohtml");
						$furl = "modules.php?name=News&file=article&sid=$sid";
						$datetime = formatTimestamp($time);
						$query = stripslashes(check_html($query, "nohtml"));
						if (empty($informant)) {
							$informant = $anonymous;
						} else {
							$informant = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a>";
						}
						if (!empty($query) AND $query != "*") {
							if (eregi(quotemeta($query),$title)) {
								$a = 1;
							}
							$text = "$hometext$bodytext";
							if (eregi(quotemeta($query),$text)) {
								$a = 2;
							}
							if (eregi(quotemeta($query),$text) AND eregi(quotemeta($query),$title)) {
								$a = 3;
							}
							if ($a == 1) {
								$match = _MATCHTITLE;
							} elseif ($a == 2) {
								$match = _MATCHTEXT;
							} elseif ($a == 3) {
								$match = _MATCHBOTH;
							}
							if (!isset($a)) {
								$match = "";
							} else {
								$match = "$match<br>";
							}
						}
						printf("<tr><td><img src=\"images/folders.gif\" border=\"0\" alt=\"\">&nbsp;<font class=\"option\"><a href=\"%s\"><b>%s</b></a></font><br><font class=\"content\">"._CONTRIBUTEDBY." $informant<br>"._POSTEDBY." <a href=\"%s\">%s</a>",$furl,$title,$url,$aid,$informant);
						echo " "._ON." $datetime<br>"
						."$match"
						.""._TOPIC.": <a href=\"modules.php?name=$module_name&amp;query=&amp;topic=$topic\">$topictext</a> ";
						if ($comments == 0) {
							echo "("._NOCOMMENTS.")";
						} elseif ($comments == 1) {
							echo "($comments "._UCOMMENT.")";
						} elseif ($comments >1) {
							echo "($comments "._UCOMMENTS.")";
						}
						if (is_admin($admin)) {
							echo " [ <a href=\"".$admin_file.".php?op=EditStory&amp;sid=$sid\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=RemoveStory&amp;sid=$sid\">"._DELETE."</a> ]";
						}
						echo "</font><br><br><br></td></tr>\n";
						$x++;
					}

					echo "</table>";
				} else {
					echo "<tr><td><center><font class=\"option\"><b>"._NOMATCHES."</b></font></center><br><br>";
					echo "</td></tr></table>";
				}

				$prev=$min-$offset;
				if ($prev>=0) {
					print "<br><br><center><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$prev&amp;query=$query&amp;type=$type&amp;category=$category\">";
					print "<b>$min "._PREVMATCHES."</b></a></center>";
				}

				$next=$min+$offset;
				if ($x>=9) {
					print "<br><br><center><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$max&amp;query=$query&amp;type=$type&amp;category=$category\">";
					print "<b>"._NEXTMATCHES."</b></a></center>";
				}
			}

		} elseif ($type=="comments") {
			/*
			$sid = intval($sid);
			if (isset($sid)) {
			$row7 = $db->sql_fetchrow($db->sql_query("SELECT title from ".$prefix."_stories where sid='$sid'"));
			$st_title = stripslashes(check_html($row7['title'], "nohtml"));
			$instory = "AND sid='$sid'";
			} else {
			$instory = "";
			}
			*/
			$result8 = $db->sql_query("SELECT tid, sid, subject, date, name from ".$prefix."_comments where (subject like '%$query2%' OR comment like '%$query3%') order by date DESC limit $min,$offset");
			$nrows = $db->sql_numrows($result8);
			$x=0;
			if (!empty($query)) {
				echo "<br><hr noshade size=\"1\"><center><b>"._SEARCHRESULTS."</b></center><br><br>";
				echo "<table width=\"99%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
				if ($nrows>0) {
					while($row8 = $db->sql_fetchrow($result8)) {
						$tid = intval($row8['tid']);
						$sid = intval($row8['sid']);
						$subject = filter($row8['subject'], "nohtml");
						$date = $row8['date'];
						$name = filter($row8['name'], "nohtml");
						$row_res = $db->sql_fetchrow($db->sql_query("SELECT title from ".$prefix."_stories where sid='$sid'"));
						$title = filter($row_res['title'], "nohtml");
						$reply = $db->sql_numrows($db->sql_query("SELECT * from ".$prefix."_comments where pid='$tid'"));
						$furl = "modules.php?name=News&amp;file=article&amp;thold=-1&amp;mode=flat&amp;order=1&amp;sid=$sid#$tid";
						if(!$name) {
							$name = "$anonymous";
						} else {
							$name = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$name\">$name</a>";
						}
						$datetime = formatTimestamp($date);
						echo "<tr><td><img src=\"images/folders.gif\" border=\"0\" alt=\"\">&nbsp;<font class=\"option\"><a href=\"$furl\"><b>$subject</b></a></font><font class=\"content\"><br>"._POSTEDBY." $name"
						." "._ON." $datetime<br>"
						.""._ATTACHART.": $title<br>";
						if ($reply == 1) {
							echo "($reply "._SREPLY.")";
							if (is_admin($admin)) {
								echo " [ <a href=\"".$admin_file.".php?op=RemoveComment&amp;tid=$tid&amp;sid=$sid\">"._DELETE."</a> ]";
							}
							echo "<br><br><br></td></tr>\n";
						} else {
							echo "($reply "._SREPLIES.")";
							if (is_admin($admin)) {
								echo " [ <a href=\"".$admin_file.".php?op=RemoveComment&amp;tid=$tid&amp;sid=$sid\">"._DELETE."</a> ]";
							}
							echo "<br><br><br></td></tr>\n";
						}
						$x++;
					}
					echo "</table>";
				} else {
					echo "<tr><td><center><font class=\"option\"><b>"._NOMATCHES."</b></font></center><br><br>";
					echo "</td></tr></table>";
				}

				$prev=$min-$offset;
				if ($prev>=0) {
					print "<br><br><center><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$topic&amp;min=$prev&amp;query=$query&amp;type=$type\">";
					print "<b>$min "._PREVMATCHES."</b></a></center>";
				}

				$next=$min+$offset;
				if ($x>=9) {
					print "<br><br><center><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$topic&amp;min=$max&amp;query=$query&amp;type=$type\">";
					print "<b>"._NEXTMATCHES."</b></a></center>";
				}
			}
		} elseif ($type=="reviews") {
			$res_n = $db->sql_query("SELECT id, title, text, reviewer, score from ".$prefix."_reviews where (title like '%$query2%' OR text like '%$query3%') $queryrlang order by date DESC limit $min,$offset");
			$nrows = $db->sql_numrows($res_n);
			$x=0;
			if (!empty($query)) {
				echo "<br><hr noshade size=\"1\"><center><b>"._SEARCHRESULTS."</b></center><br><br>";
				echo "<table width=\"99%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
				if ($nrows>0) {
					while($rown = $db->sql_fetchrow($res_n)) {
						$id = intval($rown['id']);
						$title = filter($rown['title'], "nohtml");
						$text = filter($rown['text']);
						$reviewer = filter($rown['reviewer'], nohmtl);
						$score = intval($rown['score']);
						$furl = "modules.php?name=Reviews&amp;op=showcontent&amp;id=$id";
						$pages = count(explode( "[--pagebreak--]", $text ));
						echo "<tr><td><img src=\"images/folders.gif\" border=\"0\" alt=\"\">&nbsp;<font class=\"option\"><a href=\"$furl\"><b>$title</b></a></font><br>"
						."<font class=\"content\">"._POSTEDBY." $reviewer<br>"
						.""._REVIEWSCORE.": $score/10<br>";
						if ($pages == 1) {
							echo "($pages "._PAGE.")";
						} else {
							echo "($pages "._PAGES.")";
						}
						if (is_admin($admin)) {
							echo " [ <a href=\"modules.php?name=Reviews&amp;op=mod_review&amp;id=$id\">"._EDIT."</a> | <a href=\"modules.php?name=Reviews.php&amp;op=del_review&amp;id_del=$id\">"._DELETE."</a> ]";
						}
						print "<br><br><br></font></td></tr>\n";
						$x++;
					}
					echo "</table>";
				} else {
					echo "<tr><td><center><font class=\"option\"><b>"._NOMATCHES."</b></font></center><br><br>";
					echo "</td></tr></table>";
				}

				$prev=$min-$offset;
				if ($prev>=0) {
					print "<br><br><center><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$prev&amp;query=$query&amp;type=$type\">";
					print "<b>$min "._PREVMATCHES."</b></a></center>";
				}

				$next=$min+$offset;
				if ($x>=9) {
					print "<br><br><center><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$max&amp;query=$query&amp;type=$type\">";
					print "<b>"._NEXTMATCHES."</b></a></center>";
				}
			}
		} elseif ($type=="users") {
			$res_n3 = $db->sql_query("SELECT user_id, username, name from ".$user_prefix."_users where (username like '%$query2%' OR name like '%$query2%' OR bio like '%$query3%') order by username ASC limit $min,$offset");
			$nrows = $db->sql_numrows($res_n3);
			$x=0;
			if (!empty($query)) {
				echo "<br><hr noshade size=\"1\"><center><b>"._SEARCHRESULTS."</b></center><br><br>";
				echo "<table width=\"99%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
				if ($nrows>0) {
					while($rown3 = $db->sql_fetchrow($res_n3)) {
						$uid = intval($rown3['user_id']);
						$uname = filter($rown3['username'], "nohtml");
						$name = filter($rown3['name'], "nohtml");
						$furl = "modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname";
						if (empty($name)) {
							$name = ""._NONAME."";
						}
						echo "<tr><td><img src=\"images/folders.gif\" border=\"0\" alt=\"\">&nbsp;<font class=\"option\"><a href=\"$furl\"><b>$uname</b></a></font><font class=\"content\"> ($name)";
						if (is_admin($admin)) {
							echo " [ <a href=\"".$admin_file.".php?chng_uid=$uid&amp;op=modifyUser\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=delUser&amp;chng_uid=$uid\">"._DELETE."</a> ]";
						}
						echo "</font></td></tr>\n";
						$x++;
					}

					echo "</table>";
				} else {
					echo "<tr><td><center><font class=\"option\"><b>"._NOMATCHES."</b></font></center><br><br>";
					echo "</td></tr></table>";
				}

				$prev=$min-$offset;
				if ($prev>=0) {
					print "<br><br><center><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$prev&amp;query=$query&amp;type=$type\">";
					print "<b>$min "._PREVMATCHES."</b></a></center>";
				}

				$next=$min+$offset;
				if ($x>=9) {
					print "<br><br><center><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$max&amp;query=$query&amp;type=$type\">";
					print "<b>"._NEXTMATCHES."</b></a></center>";
				}
			}
		}
		CloseTable();
		$mod1 = $mod2 = $mod3 = "";
		if (isset($query) AND !empty($query)) {
			echo "<br>";
			if (is_active("Downloads")) {
				$dcnt = $db->sql_numrows($db->sql_query("SELECT * from ".$prefix."_downloads_downloads WHERE title LIKE '%$query2%' OR description LIKE '%$query3%'"));
				$mod1 = "<li> <a href=\"modules.php?name=Downloads&amp;d_op=search&amp;query=$query3\">"._DOWNLOADS."</a> ($dcnt "._SEARCHRESULTS.")";
			}
			if (is_active("Web_Links")) {
				$lcnt = $db->sql_numrows($db->sql_query("SELECT * from ".$prefix."_links_links WHERE title LIKE '%$query2%' OR description LIKE '%$query3%'"));
				$mod2 = "<li> <a href=\"modules.php?name=Web_Links&amp;l_op=search&amp;query=$query\">"._WEBLINKS."</a> ($lcnt "._SEARCHRESULTS.")";
			}
			if (is_active("Encyclopedia")) {
				$ecnt1 = $db->sql_query("SELECT eid from ".$prefix."_encyclopedia WHERE active='1'");
				$ecnt = 0;
				while($row_e = $db->sql_fetchrow($ecnt1)) {
					$eid = intval($row_e['eid']);
					$ecnt2 = $db->sql_numrows($db->sql_query("select * from ".$prefix."_encyclopedia WHERE title LIKE '%$query2%' OR description LIKE '%$query3%' AND eid='$eid'"));
					$ecnt3 = $db->sql_numrows($db->sql_query("select * from ".$prefix."_encyclopedia_text WHERE title LIKE '%$query2%' OR text LIKE '%$query3%' AND eid='$eid'"));
					$ecnt = $ecnt+$ecnt2+$ecnt3;
				}
				$mod3 = "<li> <a href=\"modules.php?name=Encyclopedia&amp;file=search&amp;query=$query\">"._ENCYCLOPEDIA."</a> ($ecnt "._SEARCHRESULTS.")";
			}
			OpenTable();
			echo "<font class=\"title\">"._FINDMORE."<br><br>"
			.""._DIDNOTFIND."</font><br><br>"
			.""._SEARCH." \"<b>$query</b>\" "._ON.":<br><br>"
			."<ul>"
			."$mod1"
			."$mod2"
			."$mod3"
			."<li> <a href=\"http://www.google.com/search?q=$query\" target=\"new\">Google</a>"
			."<li> <a href=\"http://groups.google.com/groups?q=$query\" target=\"new\">Google Groups</a>"
			."</ul>";
			CloseTable();
		}
		include("footer.php");
		break;
}

?>