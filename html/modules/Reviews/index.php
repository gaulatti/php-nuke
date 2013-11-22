<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2007 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Base on Reviews Addon                                                */
/* Copyright (c) 2000 by Jeff Lambert (jeffx@ican.net)                  */
/* http://www.qchc.com                                                  */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}
if (stristr($_SERVER['QUERY_STRING'],'%25')) header("Location: index.php");

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

function alpha() {
	global $module_name;
	$alphabet = array ("A","B","C","D","E","F","G","H","I","J","K","L","M",
	"N","O","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0");
	$num = count($alphabet) - 1;
	echo "<center>[ ";
	$counter = 0;
	while (list(, $ltr) = each($alphabet)) {
		echo "<a href=\"modules.php?name=$module_name&rop=$ltr\">$ltr</a>";
		if ( $counter == round($num/2) ) {
			echo " ]\n<br>\n[ ";
		} elseif ( $counter != $num ) {
			echo "&nbsp;|&nbsp;\n";
		}
		$counter++;
	}
	echo " ]</center><br><br>\n\n\n";
	echo "<center>[ <a href=\"modules.php?name=$module_name&rop=write_review\">"._WRITEREVIEW."</a> ]</center><br><br>\n\n";
}

function display_score($score) {
	$image = "<img src=\"images/blue.gif\" alt=\"\">";
	$halfimage = "<img src=\"images/bluehalf.gif\" alt=\"\">";
	$full = "<img src=\"images/star.gif\" alt=\"\">";

	if ($score == 10) {
		for ($i=0; $i < 5; $i++)
		echo "$full";
	} else if ($score % 2) {
		$score -= 1;
		$score /= 2;
		for ($i=0; $i < $score; $i++)
		echo "$image";
		echo "$halfimage";
	} else {
		$score /= 2;
		for ($i=0; $i < $score; $i++)
		echo "$image";
	}
}

function write_review() {
	global $admin, $sitename, $user, $cookie, $prefix, $user_prefix, $currentlang, $multilingual, $db, $module_name;
	include ('header.php');
	OpenTable();
	echo "
    <b>"._WRITEREVIEWFOR." $sitename</b><br><br>
    <i>"._ENTERINFO."</i><br><br>
    <form method=\"post\" action=\"modules.php?name=$module_name\">
    <b>"._PRODUCTTITLE.":</b><br>
    <input type=\"text\" name=\"title\" size=\"50\" maxlength=\"150\"><br>
    <i>"._NAMEPRODUCT."</i><br>";
	if ($multilingual == 1) {
		echo "<br><b>"._LANGUAGE.": </b>"
		."<select name=\"rlanguage\">";
		$handle=opendir('language');
		while ($file = readdir($handle)) {
			if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
				$langFound = $matches[1];
				$languageslist .= "$langFound ";
			}
		}
		closedir($handle);
		$languageslist = explode(" ", $languageslist);
		for ($i=0; $i < sizeof($languageslist); $i++) {
			if(!empty($languageslist[$i])) {
				echo "<option value=\"$languageslist[$i]\" ";
				if($languageslist[$i]==strtolower($currentlang)) echo "selected";
				echo ">$languageslist[$i]</option>\n";
			}
		}
		echo "</select><br><br>";
	} else {
		echo "<input type=\"hidden\" name=\"rlanguage\" value=\"$language\"><br><br>";
	}
	echo "<b>"._REVIEW.":</b><br>
    <textarea name=\"text\" rows=\"15\" wrap=\"virtual\" cols=\"60\"></textarea><br>";
	if (is_admin($admin)) {
		echo "<font class=\"content\">"._PAGEBREAK."</font><br>";
	}
	echo "
    <i>"._CHECKREVIEW."</i><br><br>
    <b>"._YOURNAME.":</b><br>";
	if (is_user($user)) {
		$result = $db->sql_query("select username, user_email from ".$user_prefix."_users where user_id = '".intval($cookie[0])."'");
		list($rname, $email) = $db->sql_fetchrow($result);
		$rname = filter($rname, "nohtml");
		$email = filter($email, "nohtml");
	}
	else {
		$rname = "";
		$email = "";
	}
	echo "<input type=\"text\" name=\"reviewer\" size=\"41\" maxlength=\"40\" value=\"$rname\"><br>
	    <i>"._FULLNAMEREQ."</i><br><br>
	    <b>"._REMAIL.":</b><br>
	    <input type=\"text\" name=\"email\" size=\"40\" maxlength=\"80\" value=\"$email\"><br>
	    <i>"._REMAILREQ."</i><br><br>
	    <b>"._SCORE."</b><br>
	    <select name=\"score\">
	    <option name=\"score\" value=\"10\">10</option>
	    <option name=\"score\" value=\"9\">9</option>
	    <option name=\"score\" value=\"8\">8</option>
	    <option name=\"score\" value=\"7\">7</option>
	    <option name=\"score\" value=\"6\">6</option>
	    <option name=\"score\" value=\"5\">5</option>
	    <option name=\"score\" value=\"4\">4</option>
	    <option name=\"score\" value=\"3\">3</option>
	    <option name=\"score\" value=\"2\">2</option>
	    <option name=\"score\" value=\"1\">1</option>
	    </select>
	    <i>"._SELECTSCORE."</i><br><br>
	    <b>"._RELATEDLINK.":</b><br>
	    <input type=\"text\" name=\"url\" size=\"40\" maxlength=\"100\" value=\"http://\"><br>
	    <i>"._PRODUCTSITE."</i><br><br>
	    <b>"._LINKTITLE.":</b><br>
	    <input type=\"text\" name=\"url_title\" size=\"40\" maxlength=\"50\"><br>
	    <i>"._LINKTITLEREQ."</i><br><br>
	";
	if(is_admin($admin)) {
		echo "<b>"._RIMAGEFILE.":</b><br>
			<input type=\"text\" name=\"cover\" size=\"40\" maxlength=\"100\"><br>
			<i>"._RIMAGEFILEREQ."</i><br><br>
		";
	}
	echo "<i>"._CHECKINFO."</i><br><br>
    	<input type=\"hidden\" name=\"rop\" value=\"preview_review\">
    	<input type=\"submit\" value=\""._PREVIEW."\"> <input type=\"button\" onClick=\"history.go(-1)\" value=\""._CANCEL."\"></form>
    ";
	CloseTable();
	include ("footer.php");
}

function preview_review($date, $title, $text, $reviewer, $email, $score, $cover, $url, $url_title, $hits, $id, $rlanguage) {
	global $admin, $multilingual, $module_name;
	$title = filter($title, "nohtml", 0, preview);
	$text = filter($text);
	$reviewer = filter($reviewer, "nohtml", 0, preview);
	$url_title = filter($url_title, "nohtml", 0, preview);
	$email = filter($email, "nohtml", 0, preview);
	$score = intval($score);
	$cover = filter($cover, "nohtml", 0, preview);
	$url = filter($url, "nohtml", 0, preview);
	$url_title = filter($url_title, "nohtml", 0, preview);
	$hits = intval($hits);
	$id = intval($id);
	include ('header.php');
	OpenTable();
	echo "<form method=\"post\" action=\"modules.php?name=$module_name\">";

	if (empty($title)) {
		$error = 1;
		echo ""._INVALIDTITLE."<br>";
	}
	if (empty($text)) {
		$error = 1;
		echo ""._INVALIDTEXT."<br>";
	}
	if (($score < 1) || ($score > 10)) {
		$error = 1;
		echo ""._INVALIDSCORE."<br>";
	}
	if (($hits < 0) && ($id != 0)) {
		$error = 1;
		echo ""._INVALIDHITS."<br>";
	}
	if (empty($reviewer) || empty($email)) {
		$error = 1;
		echo ""._CHECKNAME."<br>";
	} else if (!empty($reviewer) && !empty($email))
	if (!(eregi("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$",$email))) {
		$error = 1;
		/* eregi checks for a valid email! works nicely for me! */
		echo ""._INVALIDEMAIL."<br>";
	}
	if (($url_title != "" && $url =="") || ($url_title == "" && $url != "")) {
		$error = 1;
		echo ""._INVALIDLINK."<br>";
	} else if (($url != "") && (!(eregi('(^http[s]*:[/]+)(.*)', $url))))
	$url = "http://" . $url;
	/* If the user ommited the http, this nifty eregi will add it */
	if (isset($error) AND ($error == 1))
	echo "<br>"._GOBACK."";
	else
	{
		if (empty($date))
		$date = date("Y-m-d", time());
		$year2 = substr($date,0,4);
		$month = substr($date,5,2);
		$day = substr($date,8,2);
		$fdate = date("F jS Y",mktime (0,0,0,$month,$day,$year2));
		echo "<table border=\"0\" width=\"100%\"><tr><td colspan=\"2\">";
		echo "<p><font class=\"title\"><i><b>$title</b></i></font><br>";
		echo "<blockquote><p>";
		if (!empty($cover))
		echo "<img src=\"images/reviews/$cover\" align=\"right\" border=\"1\" vspace=\"2\" alt=\"\">";
		echo "$text<p>";
		echo "<b>"._ADDED."</b> $fdate<br>";
		if ($multilingual == 1) {
			echo "<b>"._LANGUAGE."</b> $rlanguage<br>";
		}
		echo "<b>"._REVIEWER."</b> <a href=\"mailto:$email\">$reviewer</a><br>";
		echo "<b>"._SCORE."</b> ";
		display_score($score);
		if (!empty($url))
		echo "<br><b>"._RELATEDLINK.":</b> <a href=\"$url\" target=\"new\">$url_title</a>";
		$id = intval($id);
		if ($id != 0) {
			echo "<br><b>"._REVIEWID.":</b> $id<br>";
			echo "<b>"._HITS.":</b> $hits<br>";
		}
		echo "</font></blockquote>";
		echo "</td></tr></table>";
		$text = urlencode($text);
		echo "<p><i>"._LOOKSRIGHT."</i> ";
		echo "<input type=\"hidden\" name=\"id\" value=$id>
		  <input type=\"hidden\" name=\"hits\" value=\"$hits\">
		  <input type=\"hidden\" name=\"rop\" value=send_review>
		  <input type=\"hidden\" name=\"date\" value=\"$date\">
		  <input type=\"hidden\" name=\"title\" value=\"$title\">
		  <input type=\"hidden\" name=\"text\" value=\"$text\">
		  <input type=\"hidden\" name=\"reviewer\" value=\"$reviewer\">
		  <input type=\"hidden\" name=\"email\" value=\"$email\">
		  <input type=\"hidden\" name=\"score\" value=\"$score\">
		  <input type=\"hidden\" name=\"url\" value=\"$url\">
		  <input type=\"hidden\" name=\"url_title\" value=\"$url_title\">
		  <input type=\"hidden\" name=\"cover\" value=\"$cover\">";
		echo "<input type=\"hidden\" name=\"rlanguage\" value=\"$rlanguage\">";
		echo "<input type=\"submit\" name=\"rop\" value=\""._YES."\"> <input type=\"button\" onClick=\"history.go(-1)\" value=\""._NO."\">";
		$id = intval($id);
		if($id != 0)
		$word = ""._RMODIFIED."";
		else
		$word = ""._RADDED."";
		if(is_admin($admin))
		echo "<br><br><b>"._NOTE."</b> "._ADMINLOGGED." $word.";
	}
	CloseTable();
	include ("footer.php");
}

function send_review($date, $title, $text, $reviewer, $email, $score, $cover, $url, $url_title, $hits, $id, $rlanguage) {
	global $admin, $EditedMessage, $prefix, $db, $module_name;
	include ('header.php');
	$id = intval($id);
	$title = filter($title, "nohtml", 1);
	$text = filter($text, "", 1);
	$reviewer = filter($reviewer, "nohtml", 1);
	$url_title = filter($url_title, "nohtml", 1);
	$email = filter($email, "nohtml", 1);
	$score = intval($score);
	$cover = filter($cover, "nohtml", 1);
	$url = filter($url, "nohtml", 1);
	$url_title = filter($url_title, "nohtml", 1);
	$hits = intval($hits);
	$date = filter($date, "nohtml", 1);
	$rlanguage = filter($rlanguage, "nohtml", 1);
	OpenTable();
	echo "<br><center>"._RTHANKS."";
	$id = intval($id);
	if ($id != 0)
	echo " "._MODIFICATION."";
	else
	echo ", $reviewer";
	echo "!<br>";
	if ($score < 0 OR $score > 10) {
		$score = 0;
	}
	if ((is_admin($admin)) && ($id == 0)) {
		$db->sql_query("INSERT INTO ".$prefix."_reviews VALUES (NULL, '$date', '$title', '$text', '$reviewer', '$email', '$score', '$cover', '$url', '$url_title', '1', '$rlanguage')");
		echo ""._ISAVAILABLE."";
	} else if ((is_admin($admin)) && ($id != 0)) {
		$db->sql_query("UPDATE ".$prefix."_reviews SET date='$date', title='$title', text='$text', reviewer='$reviewer', email='$email', score='$score', cover='$cover', url='$url', url_title='$url_title', hits='$hits', rlanguage='$rlanguage' where id = '$id'");
		echo ""._ISAVAILABLE."";
	} else {
		$db->sql_query("INSERT INTO ".$prefix."_reviews_add VALUES (NULL, '$date', '$title', '$text', '$reviewer', '$email', '$score', '$url', '$url_title', '$rlanguage')");
		echo ""._EDITORWILLLOOK."";
	}
	echo "<br><br>[ <a href=\"modules.php?name=$module_name\">"._RBACK."</a> ]<br></center>";
	CloseTable();
	include ("footer.php");
}

function reviews_index() {
	global $bgcolor3, $bgcolor2, $prefix, $multilingual, $currentlang, $db, $module_name;
	include ('header.php');
	if ($multilingual == 1) {
		$querylang = "WHERE rlanguage='$currentlang'";
	} else {
		$querylang = "";
	}
	OpenTable();
	echo "<table border=\"0\" width=\"95%\" CELLPADDING=\"2\" CELLSPACING=\"4\" align=\"center\">
    <tr><td colspan=\"2\"><center><font class=\"title\">"._RWELCOME."</font></center><br><br><br>";
	$result = $db->sql_query("select title, description from ".$prefix."_reviews_main");
	list($title, $description) = $db->sql_fetchrow($result);
	$title = filter($title, "nohtml");
	$description = filter($description);
	echo "<center><b>$title</b><br><br>$description</center>";
	echo "<br><br><br>";
	alpha();
	echo "</td></tr>";
	echo "<tr><td width=\"50%\" bgcolor=\"$bgcolor2\"><b>"._10MOSTPOP."</b></td>";
	echo "<td width=\"50%\" bgcolor=\"$bgcolor2\"><b>"._10MOSTREC."</b></td></tr>";
	$result_pop = $db->sql_query("SELECT id, title, hits from ".$prefix."_reviews $querylang order by hits DESC limit 10");
	$result_rec = $db->sql_query("SELECT id, title, date, hits from ".$prefix."_reviews $querylang order by date DESC limit 10");
	$y = 1;
	for ($x = 0; $x < 10; $x++)	{
		$myrow = $db->sql_fetchrow($result_pop);
		$id = intval($myrow['id']);
		$title = filter($myrow['title'], "nohtml");
		$hits = intval($myrow['hits']);
		echo "<tr><td width=\"50%\" bgcolor=\"$bgcolor3\">$y) <a href=\"modules.php?name=$module_name&rop=showcontent&amp;id=$id\">$title</a></td>";
		$myrow2 = $db->sql_fetchrow($result_rec);
		$id = intval($myrow2['id']);
		$title = filter($myrow2['title'], "nohtml");
		$hits = intval($myrow2['hits']);
		echo "<td width=\"50%\" bgcolor=\"$bgcolor3\">$y) <a href=\"modules.php?name=$module_name&rop=showcontent&amp;id=$id\">$title</a></td></tr>";
		$y++;
	}
	echo "<tr><td colspan=\"2\"><br></td></tr>";
	$result2 = $db->sql_query("SELECT * FROM ".$prefix."_reviews $querylang");
	$numresults = $db->sql_numrows($result2);
	echo "<tr><td colspan=\"2\"><br><center>"._THEREARE." $numresults "._REVIEWSINDB."</center></td></tr></table>";
	CloseTable();
	include ("footer.php");
}

function reviews($letter, $field, $order) {
	global $bgcolor4, $sitename, $prefix, $multilingual, $currentlang, $db, $module_name;
	include ('header.php');
	$letter = substr("$letter", 0,1);
	if ($multilingual == 1) {
		$querylang = "AND rlanguage='$currentlang'";
	} else {
		$querylang = "";
	}
	OpenTable();
	echo "<center><b>$sitename "._REVIEWS."</b><br>";
	echo "<i>"._REVIEWSLETTER." \"$letter\"</i><br><br>";
	switch ($field) {

		case "reviewer":
		$result = $db->sql_query("SELECT id, title, hits, reviewer, score FROM ".$prefix."_reviews WHERE UPPER(title) LIKE '$letter%' $querylang ORDER by reviewer $order");
		break;

		case "score":
		$result = $db->sql_query("SELECT id, title, hits, reviewer, score FROM ".$prefix."_reviews WHERE UPPER(title) LIKE '$letter%' $querylang ORDER by score $order");
		break;

		case "hits":
		$result = $db->sql_query("SELECT id, title, hits, reviewer, score FROM ".$prefix."_reviews WHERE UPPER(title) LIKE '$letter%' $querylang ORDER by hits $order");
		break;

		default:
		$result = $db->sql_query("SELECT id, title, hits, reviewer, score FROM ".$prefix."_reviews WHERE UPPER(title) LIKE '$letter%' $querylang ORDER by title $order");
		break;

	}
	$numresults = $db->sql_numrows($result);
	if ($numresults == 0) {
		echo "<i><b>"._NOREVIEWS." \"$letter\"</b></i><br><br>";
	} elseif ($numresults > 0) {
		echo "<TABLE BORDER=\"0\" width=\"100%\" CELLPADDING=\"2\" CELLSPACING=\"4\">
		<tr>
		<td width=\"50%\" bgcolor=\"$bgcolor4\">
		<P ALIGN=\"LEFT\"><a href=\"modules.php?name=$module_name&amp;rop=$letter&amp;field=title&amp;order=ASC\"><img src=\"images/up.gif\" border=\"0\" width=\"15\" height=\"9\" Alt=\""._SORTASC."\"></a><B> "._PRODUCTTITLE." </B><a href=\"modules.php?name=$module_name&amp;rop=$letter&amp;field=title&amp;order=DESC\"><img src=\"images/down.gif\" border=\"0\" width=\"15\" height=\"9\" Alt=\""._SORTDESC."\"></a>
		</td>
		<td width=\"18%\" bgcolor=\"$bgcolor4\">
		<P ALIGN=\"CENTER\"><a href=\"modules.php?name=$module_name&amp;rop=$letter&amp;field=reviewer&amp;order=ASC\"><img src=\"images/up.gif\" border=\"0\" width=\"15\" height=\"9\" Alt=\""._SORTASC."\"></a><B> "._REVIEWER." </B><a href=\"modules.php?name=$module_name&amp;rop=$letter&amp;field=reviewer&amp;order=desc\"><img src=\"images/down.gif\" border=\"0\" width=\"15\" height=\"9\" Alt=\""._SORTDESC."\"></a>
		</td>
		<td width=\"18%\" bgcolor=\"$bgcolor4\">
		<P ALIGN=\"CENTER\"><a href=\"modules.php?name=$module_name&amp;rop=$letter&amp;field=score&amp;order=ASC\"><img src=\"images/up.gif\" border=\"0\" width=\"15\" height=\"9\" Alt=\""._SORTASC."\"></a><B> "._SCORE." </B><a href=\"modules.php?name=$module_name&amp;rop=$letter&amp;field=score&amp;order=DESC\"><img src=\"images/down.gif\" border=\"0\" width=\"15\" height=\"9\" Alt=\""._SORTDESC."\"></a>
		</td>
		<td width=\"14%\" bgcolor=\"$bgcolor4\">
		<P ALIGN=\"CENTER\"><a href=\"modules.php?name=$module_name&amp;rop=$letter&amp;field=hits&amp;order=ASC\"><img src=\"images/up.gif\" border=\"0\" width=\"15\" height=\"9\" Alt=\""._SORTASC."\"></a><B> "._HITS." </B><a href=\"modules.php?name=$module_name&amp;rop=$letter&amp;field=hits&amp;order=DESC\"><img src=\"images/down.gif\" border=\"0\" width=\"15\" height=\"9\" Alt=\""._SORTDESC."\"></a>
		</td>
		</tr>";
		while($myrow = $db->sql_fetchrow($result)) {
			$title = filter($myrow["title"], "nohtml");
			$id = intval($myrow['id']);
			$reviewer = filter($myrow['reviewer'], "nohtml");
			$email = filter($myrow['email'], "nohtml");
			$score = intval($myrow['score']);
			$hits = intval($myrow['hits']);
			echo "<tr>
		    <td width=\"50%\" bgcolor=\"$bgcolor4\"><a href=\"modules.php?name=$module_name&rop=showcontent&amp;id=$id\">$title</a></td>
		    <td width=\"18%\" bgcolor=\"$bgcolor4\">";
			if (!empty($reviewer))
			echo "<center>$reviewer</center>";
			echo "</td><td width=\"18%\" bgcolor=\"$bgcolor4\"><center>";
			display_score($score);
			echo "</center></td><td width=\"14%\" bgcolor=\"$bgcolor4\"><center>$hits</center></td>
		  </tr>";
		}
		echo "</TABLE>";
		echo "<br>$numresults "._TOTALREVIEWS."<br><br>";
	}
	echo "[ <a href=\"modules.php?name=$module_name\">"._RETURN2MAIN."</a> ]";
	CloseTable();
	include ("footer.php");
}

function postcomment($id, $title) {
	global $user, $cookie, $AllowableHTML, $anonymous, $module_name, $anonpost;
	if (!is_user($user) && $anonpost == 0) {
		include("header.php");
		title("$module_name");
		OpenTable();
		echo "<center><b>"._RESTRICTEDAREA."</b><br><br>"._MODULEUSERS."";
		CloseTable();
		include("footer.php");
		die();
	}
	include("header.php");
	cookiedecode($user);
	$title = filter($title, "nohtml");
	OpenTable();
	echo "<center><font class=option><b>"._REVIEWCOMMENT." $title</b><br><br></font></center>"
	."<form action=modules.php?name=$module_name method=post>";
	if (!is_user($user) && $anonpost != 0) {
		echo "<b>"._YOURNICK."</b> $anonymous [ "._RCREATEACCOUNT." ]<br><br>";
		$uname = $anonymous;
	} else {
		echo "<b>"._YOURNICK."</b> $cookie[1]<br><br>";
		if ($anonpost != 0) {
			echo "<input type=checkbox name=xanonpost> "._POSTANON."<br><br>";
		} else {
			echo "<input type=hidden name=xanonpost value=0>";
		}
		$uname = $cookie[1];
	}
	echo "
    <input type=hidden name=uname value=$uname>
    <input type=hidden name=id value=$id>
    <b>"._SELECTSCORE."</b>
    <select name=score>
    <option name=score value=10>10</option>
    <option name=score value=9>9</option>
    <option name=score value=8>8</option>
    <option name=score value=7>7</option>
    <option name=score value=6>6</option>
    <option name=score value=5>5</option>
    <option name=score value=4>4</option>
    <option name=score value=3>3</option>
    <option name=score value=2>2</option>
    <option name=score value=1>1</option>
    </select><br><br>
    <b>"._YOURCOMMENT."</b><br>
    <textarea name=comments rows=10 cols=70></textarea><br>
    "._HTMLNOTALLOWED."<br>";
	echo "<br>
    <input type=hidden name=rop value=savecomment>
    <input type=submit value=Submit>
    </form>
    ";
	CloseTable();
	include("footer.php");
}

function savecomment($xanonpost, $uname, $id, $score, $comments) {
	global $anonymous, $user, $cookie, $prefix, $db, $module_name, $user_prefix, $anonpost;
	if (!is_user($user) && $anonpost == 0) {
		include("header.php");
		title("$module_name");
		OpenTable();
		echo "<center><b>"._RESTRICTEDAREA."</b><br><br>"._MODULEUSERS."";
		CloseTable();
		include("footer.php");
		die();
	}
	if ($xanonpost) {
		$uname = $anonymous;
	}
	$comments = filter($comments, "", 1);
	$uname = filter($uname, "nohtml");
	$id = intval($id);
	$score = intval($score);
	if (is_user($user)) {
		$krow = $db->sql_fetchrow($db->sql_query("SELECT karma FROM ".$user_prefix."_users WHERE username='$uname'"));
		if ($krow['karma'] == 2) {
			$db->sql_query("insert into ".$prefix."_reviews_comments_moderated values (NULL, '$id', '$uname', now(), '$comments', '$score')");
			include("header.php");
			title(""._MODERATEDTITLE."");
			OpenTable();
			echo "<center>"._COMMENTMODERATED."";
			echo "<br><br><a href=\"modules.php?name=$module_name&rop=showcontent&id=$id\">"._MODERATEDTITLE."</a>";
			CloseTable();
			include("footer.php");
			die();
		} elseif ($krow['karma'] == 3) {
			Header("Location: modules.php?name=$module_name&rop=showcontent&id=$id");
			die();
		}
	}
	$db->sql_query("insert into ".$prefix."_reviews_comments values (NULL, '$id', '$uname', now(), '$comments', '$score')");
	update_points(12);
	Header("Location: modules.php?name=$module_name&rop=showcontent&id=$id");
}

function r_comments($id, $title) {
	global $admin, $prefix, $db, $module_name, $anonymous;
	$id = intval($id);
	$result = $db->sql_query("SELECT cid, userid, date, comments, score from ".$prefix."_reviews_comments where rid='$id' ORDER BY date DESC");
	while ($row = $db->sql_fetchrow($result)) {
		$cid = intval($row['cid']);
		$uname = filter($row['userid'], "nohtml");
		$date = $row['date'];
		$comments = filter($row['comments']);
		$score = intval($row['score']);
		OpenTable();
		$title = filter($title, "nohtml");
		echo "<b>$title</b><br>";
		if ($uname == $anonymous) {
			echo ""._POSTEDBY." $uname "._ON." $date<br>";
		} else {
			echo ""._POSTEDBY." <a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname\">$uname</a> "._ON." $date<br>";
		}
		echo ""._MYSCORE." ";
		display_score($score);
		if (is_admin($admin)) {
			echo "<br><b>"._ADMIN."</b> [ <a href=\"modules.php?name=$module_name&rop=del_comment&amp;cid=$cid&amp;id=$id\">"._DELETE."</a> ]</font><hr noshade size=1><br><br>";
		} else {
			echo "</font><hr noshade size=1><br><br>";
		}
		echo "$comments";
		CloseTable();
		echo "<br>";
	}
}

function showcontent($id, $page) {
	global $admin, $uimages, $prefix, $db, $module_name;
	$id = intval($id);
	$page = intval($page);
	include ('header.php');
	OpenTable();
	if (($page == 1) OR (empty($page))) {
		$db->sql_query("UPDATE ".$prefix."_reviews SET hits=hits+1 WHERE id='$id'");
	}
	$result = $db->sql_query("SELECT * FROM ".$prefix."_reviews WHERE id='$id'");
	$myrow = $db->sql_fetchrow($result);
	$id = intval($myrow['id']);
	$date = $myrow['date'];
	$year = substr($date,0,4);
	$month = substr($date,5,2);
	$day = substr($date,8,2);
	$fdate = date("F jS Y",mktime (0,0,0,$month,$day,$year));
	$title = $myrow['title'];
	$title = filter($title, "nohtml");
	$text = urldecode(filter($myrow['text']));
	$cover = filter($myrow['cover'], "nohtml");
	$reviewer = filter($myrow['reviewer'], "nohtml");
	$email = filter($myrow['email'], "nohtml");
	$hits = intval($myrow['hits']);
	$url = filter($myrow['url'], "nohtml");
	$url_title = filter($myrow['url_title'], "nohtml");
	$score = intval($myrow['score']);
	$rlanguage = $myrow['rlanguage'];
	$contentpages = explode( "[--pagebreak--]", $text );
	$pageno = count($contentpages);
	if ( $page=="" || $page < 1 )
	$page = 1;
	if ( $page > $pageno )
	$page = $pageno;
	$arrayelement = (int)$page;
	$arrayelement --;
	echo "<p><i><b><font class=\"title\">$title</b></i></font><br>";
	echo "<BLOCKQUOTE><p align=justify>";
	if (!empty($cover))
	echo "<img src=\"images/reviews/$cover\" align=right border=1 vspace=2 alt=\"\">";
	echo "$contentpages[$arrayelement]
    </BLOCKQUOTE><p>";
	if (is_admin($admin))
	echo "<b>"._ADMIN."</b> [ <a href=\"modules.php?name=$module_name&rop=mod_review&amp;id=$id\">"._EDIT."</a> | <a href=modules.php?name=$module_name&rop=del_review&amp;id_del=$id>"._DELETE."</a> ]<br>";
	echo "<b>"._ADDED."</b> $fdate<br>";
	if (!empty($reviewer))
	echo "<b>"._REVIEWER."</b> <a href=mailto:$email>$reviewer</a><br>";
	if (!empty($score))
	echo "<b>"._SCORE."</b> ";
	display_score($score);
	if (!empty($url))
	echo "<br><b>"._RELATEDLINK.":</b> <a href=\"$url\" target=new>$url_title</a>";
	echo "<br><b>"._HITS.":</b> $hits";
	echo "<br><b>"._LANGUAGE.":</b> $rlanguage";
	if ($pageno > 1) {
		echo "<br><b>"._PAGE.":</b> $page/$pageno<br>";
	}
	echo "</font>";
	echo "</CENTER>";
	if($page >= $pageno) {
		$next_page = "";
	} else {
		$next_pagenumber = $page + 1;
		if ($page != 1) {
			$next_page .= "<img src=\"images/blackpixel.gif\" width=\"10\" height=\"2\" border=\"0\" alt=\"\"> &nbsp;&nbsp; ";
		}
		$next_page .= "<a href=\"modules.php?name=$module_name&rop=showcontent&amp;id=$id&amp;page=$next_pagenumber\">"._NEXT." ($next_pagenumber/$pageno)</a> <a href=\"modules.php?name=$module_name&rop=showcontent&amp;id=$id&amp;page=$next_pagenumber\"><img src=\"images/right.gif\" border=\"0\" alt=\""._NEXT."\"></a>";
	}
	if($page <= 1) {
		$previous_page = "";
	} else {
		$previous_pagenumber = $page - 1;
		$previous_page = "<a href=\"modules.php?name=$module_name&rop=showcontent&amp;id=$id&amp;page=$previous_pagenumber\"><img src=\"images/left.gif\" border=\"0\" alt=\""._PREVIOUS."\"></a> <a href=\"modules.php?name=$module_name&rop=showcontent&amp;id=$id&amp;page=$previous_pagenumber\">"._PREVIOUS." ($previous_pagenumber/$pageno)</a>";
	}
	echo "<center>"
	."$previous_page &nbsp;&nbsp; $next_page<br><br>"
	."[ <a href=\"modules.php?name=$module_name\">"._RBACK."</a> | "
	."<a href=\"modules.php?name=$module_name&rop=postcomment&amp;id=$id&amp;title=$title\">"._REPLYMAIN."</a> ]";
	CloseTable();
	if (($page == 1) OR (empty($page))) {
		echo "<br>";
		r_comments($id, $title);
	}
	include ("footer.php");
}

function mod_review($id) {
	global $admin, $prefix, $db, $module_name;
	$id = intval($id);
	include ('header.php');
	OpenTable();
	if (($id == 0) || (!is_admin($admin)))
	echo "This function must be passed argument id, or you are not admin.";
	else if (($id != 0) && (is_admin($admin)))
	{
		$result = $db->sql_query("SELECT * from ".$prefix."_reviews where id = '$id'");
		while ($myrow = $db->sql_fetchrow($result)) {
			$id = intval($myrow['id']);
			$date = $myrow['date'];
			$title = $myrow['title'];
			$title = filter($title, "nohtml");
			$text = urldecode(filter($myrow['text']));
			$cover = filter($myrow['cover'], "nohtml");
			$reviewer = filter($myrow['reviewer'], "nohtml");
			$email = filter($myrow['email'], "nohtml");
			$hits = intval($myrow['hits']);
			$url = filter($myrow['url'], "nohtml");
			$url_title = filter($myrow['url_title'], "nohtml");
			$score = intval($myrow['score']);
			$rlanguage = $myrow['rlanguage'];
		}
		echo "<center><b>"._REVIEWMOD."</b></center><br><br>";
		echo "<form method=POST action=modules.php?name=$module_name&rop=preview_review><input type=hidden name=id value=$id>";
		echo "<TABLE BORDER=0 width=100%>
			<tr>
				<td width=12%><b>"._RDATE."</b></td>
				<td><INPUT TYPE=text NAME=date SIZE=15 VALUE=\"$date\" MAXLENGTH=10></td>
			</tr>
			<tr>
				<td width=12%><b>"._RTITLE."</b></td>
				<td><INPUT TYPE=text NAME=title SIZE=50 MAXLENGTH=150 value=\"$title\"></td>
			</tr>
			<tr>";
		echo "<td width=12%><b>"._LANGUAGE."</b></td>
				<td><select name=\"rlanguage\">";
		$handle=opendir('language');
		while ($file = readdir($handle)) {
			if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
				$langFound = $matches[1];
				$languageslist .= "$langFound ";
			}
		}
		closedir($handle);
		$languageslist = explode(" ", $languageslist);
		for ($i=0; $i < sizeof($languageslist); $i++) {
			if(!empty($languageslist[$i])) {
				echo "<option value=\"$languageslist[$i]\" ";
				if($languageslist[$i]==$rlanguage) echo "selected";
				echo ">$languageslist[$i]</option>\n";
			}
		}

		echo "</select></td></tr>";
		echo "<tr>
				<td width=12%><b>"._RTEXT."</b></td>
				<td><TEXTAREA class=textbox name=text rows=20 wrap=virtual cols=60>$text</TEXTAREA></td>
			</tr>
			<tr>
				<td width=12%><b>"._REVIEWER."</b></td>
				<td><INPUT TYPE=text NAME=reviewer SIZE=41 MAXLENGTH=40 value=\"$reviewer\"></td>
			</tr>
			<tr>
				<td width=12%><b>"._REVEMAIL."</b></td>
				<td><INPUT TYPE=text NAME=email value=\"$email\" SIZE=30 MAXLENGTH=80></td>
			</tr>
			<tr>
				<td width=12%><b>"._SCORE."</b></td>
				<td><INPUT TYPE=text NAME=score value=\"$score\" size=3 maxlength=2></td>
			</tr>
			<tr>
				<td width=12%><b>"._RLINK."</b></td>
				<td><INPUT TYPE=text NAME=url value=\"$url\" size=30 maxlength=100></td>
			</tr>
			<tr>
				<td width=12%><b>"._RLINKTITLE."</b></td>
				<td><INPUT TYPE=text NAME=url_title value=\"$url_title\" size=30 maxlength=50></td>
			</tr>
			<tr>
				<td width=12%><b>"._COVERIMAGE."</b></td>
				<td><INPUT TYPE=text NAME=cover value=\"$cover\" size=30 maxlength=100></td>
			</tr>
			<tr>
				<td width=12%><b>"._HITS.":</b></td>
				<td><INPUT TYPE=text NAME=hits value=\"$hits\" size=5 maxlength=5></td>
			</tr>
		</TABLE>";
		echo "<input type=hidden name=rop value=preview_review><input type=submit value=\""._PREMODS."\">&nbsp;&nbsp;<input type=button onClick=history.go(-1) value="._CANCEL."></form>";
	}
	CloseTable();
	include ("footer.php");
}

function del_review($id_del) {
	global $admin, $prefix, $db, $module_name;
	$id_del = intval($id_del);
	if (is_admin($admin)) {
		$db->sql_query("delete from ".$prefix."_reviews where id = '$id_del'");
		$db->sql_query("delete from ".$prefix."_reviews_comments where rid='$id_del'");
		Header("Location: modules.php?name=$module_name");
	} else {
		echo "ACCESS DENIED";
	}
}

function del_comment($cid, $id) {
	global $admin, $prefix, $db, $module_name;
	$cid = intval($cid);
	if (is_admin($admin)) {
		$db->sql_query("delete from ".$prefix."_reviews_comments where cid='$cid'");
		Header("Location: modules.php?name=$module_name&rop=showcontent&id=$id");
	} else {
		echo "ACCESS DENIED";
	}
}

if (!isset($rop)) { $rop = ""; }
if (!isset($page)) { $page = ""; }
if (!isset($field)) { $field = ""; }
if (!isset($order)) { $order = ""; }
if (!isset($date)) { $date = ""; }
if (!isset($hits)) { $hits = ""; }
if (!isset($id)) { $id = ""; }
if (strlen($rop) == 1 AND ctype_alnum($rop))
  reviews($rop, $field, $order);
else switch($rop) {

	case "showcontent":
	showcontent($id, $page);
	break;

	case "write_review":
	write_review();
	break;

	case "preview_review":
	preview_review($date, $title, $text, $reviewer, $email, $score, $cover, $url, $url_title, $hits, $id, $rlanguage);
	break;

	case ""._YES."":
	send_review($date, $title, $text, $reviewer, $email, $score, $cover, $url, $url_title, $hits, $id, $rlanguage);
	break;

	case "del_review":
	del_review($id_del);
	break;

	case "mod_review":
	mod_review($id);
	break;

	case "postcomment":
	postcomment($id, $title);
	break;

	case "savecomment":
	savecomment($xanonpost, $uname, $id, $score, $comments);
	break;

	case "del_comment":
	del_comment($cid, $id);
	break;

	default:
	reviews_index();
	break;
}

?>