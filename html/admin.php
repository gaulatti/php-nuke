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

define('ADMIN_FILE', true);

if(isset($aid)) {
	if(!empty($aid) AND (!isset($admin) OR empty($admin)) AND $op!='login') {
		unset($aid);
		unset($admin);
		die("Access Denied");
	}
}

require_once("mainfile.php");

//Uncomment the following lines after setting the site url in the Administration
//global $nukeurl;
//if (!stripos_clone($_SERVER['HTTP_HOST'], $nukeurl)) {
//  die("Access denied");
//}

$checkurl = $_SERVER['REQUEST_URI'];
if((stripos_clone($checkurl,'AddAuthor')) OR (stripos_clone($checkurl,'VXBkYXRlQXV0aG9y')) OR (stripos_clone($checkurl,'QWRkQXV0aG9y')) OR (stripos_clone($checkurl,'UpdateAuthor')) OR (stripos_clone($checkurl, "?admin")) OR (stripos_clone($checkurl, "&admin"))) {
	die("Illegal Operation");
}

get_lang("admin");

function create_first($name, $url, $email, $pwd, $user_new) {
	global $prefix, $db, $user_prefix, $Default_Theme;
	$first = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_authors"));
	if ($first == 0) {
		$pwd = htmlentities($pwd);
		$pwd = md5($pwd);
		$the_adm = "God";
		$email = validate_mail($email);
		$db->sql_query("INSERT INTO ".$prefix."_authors VALUES ('".addslashes($name)."', '$the_adm', '".addslashes($url)."', '".addslashes($email)."', '$pwd', '0', '1', '')");
		if ($user_new == 1) {
			$user_regdate = date("M d, Y");
			$user_avatar = "gallery/blank.gif";
			$commentlimit = 4096;
			if ($url == "http://") { $url = ""; }
			$db->sql_query("INSERT INTO ".$user_prefix."_users (user_id, username, user_email, user_website, user_avatar, user_regdate, user_password, theme, commentmax, user_level, user_lang, user_dateformat) VALUES (NULL,'".addslashes($name)."','".addslashes($email)."','".addslashes($url)."','$user_avatar','$user_regdate','$pwd','$Default_Theme','$commentlimit', '2', 'english','D M d, Y g:i a')");
		}
		login();
	}
}

global $admin_file;
$the_first = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_authors"));
if ($the_first == 0) {
	if (!$name) {
		include("header.php");
		title("$sitename: "._ADMINISTRATION."");
		OpenTable();
		echo "<center><b>"._NOADMINYET."</b></center><br><br>"
		."<form action=\"".$admin_file.".php\" method=\"post\">"
		."<table border=\"0\">"
		."<tr><td><b>"._NICKNAME.":</b></td><td><input type=\"text\" name=\"name\" size=\"30\" maxlength=\"25\"></td></tr>"
		."<tr><td><b>"._HOMEPAGE.":</b></td><td><input type=\"text\" name=\"url\" size=\"30\" maxlength=\"255\" value=\"http://\"></td></tr>"
		."<tr><td><b>"._EMAIL.":</b></td><td><input type=\"text\" name=\"email\" size=\"30\" maxlength=\"255\"></td></tr>"
		."<tr><td><b>"._PASSWORD.":</b></td><td><input type=\"password\" name=\"pwd\" size=\"11\" maxlength=\"40\"></td></tr>"
		."<tr><td colspan=\"2\">"._CREATEUSERDATA."  <input type=\"radio\" name=\"user_new\" value=\"1\" checked>"._YES."&nbsp;&nbsp;<input type=\"radio\" name=\"user_new\" value=\"0\">"._NO."</td></tr>"
		."<tr><td><input type=\"hidden\" name=\"fop\" value=\"create_first\">"
		."<input type=\"submit\" value=\""._SUBMIT."\">"
		."</td></tr></table></form>";
		CloseTable();
		include("footer.php");
	}
	switch($fop) {
		case "create_first":
		create_first($name, $url, $email, $pwd, $user_new);
		break;
	}
	die();
}

if (isset($aid) && (ereg("[^a-zA-Z0-9_-]",trim($aid)))) {
	die("Begone");
}
if (isset($aid)) { $aid = substr($aid, 0,25);}
if (isset($pwd)) { $pwd = substr($pwd, 0,40);}
if ((isset($aid)) && (isset($pwd)) && (isset($op)) && ($op == "login")) {
	$datekey = date("F j");
	$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $_POST['random_num'] . $datekey));
	$code = substr($rcode, 2, 6);
	if (extension_loaded("gd") AND $code != $_POST['gfx_check'] AND ($gfx_chk == 1 OR $gfx_chk == 5 OR $gfx_chk == 6 OR $gfx_chk == 7)) {
		Header("Location: ".$admin_file.".php");
		die();
	}
	if(!empty($aid) AND !empty($pwd)) {
		$pwd = md5($pwd);
		$result = $db->sql_query("SELECT pwd, admlanguage FROM ".$prefix."_authors WHERE aid='$aid'");
		list($rpwd, $admlanguage) = $db->sql_fetchrow($result);
		$admlanguage = addslashes($admlanguage);
		if($rpwd == $pwd) {
			$admin = base64_encode("$aid:$pwd:$admlanguage");
			setcookie("admin",$admin,time()+2592000);
			unset($op);
		}
	}
}

$admintest = 0;

if(isset($admin) && !empty($admin)) {
	$admin = addslashes(base64_decode($admin));
	$admin = explode(":", $admin);
	$aid = addslashes($admin[0]);
	$pwd = $admin[1];
	$admlanguage = $admin[2];
	if (empty($aid) OR empty($pwd)) {
		$admintest=0;
		$alert = "<html>\n";
		$alert .= "<title>INTRUDER ALERT!!!</title>\n";
		$alert .= "<body bgcolor=\"#FFFFFF\" text=\"#000000\">\n\n<br><br><br>\n\n";
		$alert .= "<center><img src=\"images/eyes.gif\" border=\"0\"><br><br>\n";
		$alert .= "<font face=\"Verdana\" size=\"+4\"><b>Get Out!</b></font></center>\n";
		$alert .= "</body>\n";
		$alert .= "</html>\n";
		die($alert);
	}
	$aid = substr($aid, 0,25);
	$result2 = $db->sql_query("SELECT name, pwd FROM ".$prefix."_authors WHERE aid='$aid'");
	if (!$result2) {
		die("Selection from database failed!");
		} else {
			list($rname, $rpwd) = $db->sql_fetchrow($result2);
			if($rpwd == $pwd && !empty($rpwd)) {
				$admintest = 1;
			}
		}
	}

	if(!isset($op)) {
		$op = "adminMain";
		} elseif(($op=="mod_authors" OR $op=="modifyadmin" OR $op=="UpdateAuthor" OR $op=="AddAuthor" OR $op=="deladmin2" OR $op=="deladmin" OR $op=="assignstories" OR $op=="deladminconf") AND ($rname != "God")) {
			die("Illegal Operation");
		}
		$pagetitle = "- "._ADMINMENU."";

		/*********************************************************/
		/* Login Function                                        */
		/*********************************************************/

		function login() {
			global $gfx_chk, $admin_file;
			include("header.php");
			mt_srand ((double)microtime()*1000000);
			$maxran = 1000000;
			$random_num = mt_rand(0, $maxran);
			OpenTable();
			echo "<center><font class=\"title\"><b>"._ADMINLOGIN."</b></font></center>";
			CloseTable();
			echo "<br>";
			OpenTable();
			echo "<form action=\"".$admin_file.".php\" method=\"post\">"
			."<table border=\"0\">"
			."<tr><td>"._ADMINID."</td>"
			."<td><input type=\"text\" NAME=\"aid\" SIZE=\"20\" MAXLENGTH=\"25\"></td></tr>"
			."<tr><td>"._PASSWORD."</td>"
			."<td><input type=\"password\" NAME=\"pwd\" SIZE=\"20\" MAXLENGTH=\"40\"></td></tr>";
			if (extension_loaded("gd") AND ($gfx_chk == 1 OR $gfx_chk == 5 OR $gfx_chk == 6 OR $gfx_chk == 7)) {
				echo "<tr><td colspan='2'>"._SECURITYCODE.": <img src='?gfx=gfx&random_num=$random_num' border='1' alt='"._SECURITYCODE."' title='"._SECURITYCODE."'></td></tr>"
				."<tr><td colspan='2'>"._TYPESECCODE.": <input type=\"text\" NAME=\"gfx_check\" SIZE=\"7\" MAXLENGTH=\"6\"></td></tr>";
			}
			echo "<tr><td>"
			."<input type=\"hidden\" NAME=\"random_num\" value=\"$random_num\">"
			."<input type=\"hidden\" NAME=\"op\" value=\"login\">"
			."<input type=\"submit\" VALUE=\""._LOGIN."\">"
			."</td></tr></table>"
			."</form>";
			CloseTable();
			include("footer.php");
		}

		function deleteNotice($id) {
			global $prefix, $db, $admin_file;
			$id = intval($id);
			$db->sql_query("DELETE FROM ".$prefix."_reviews_add WHERE id = '$id'");
			Header("Location: ".$admin_file.".php?op=reviews");
		}

		/*********************************************************/
		/* Administration Menu Function                          */
		/*********************************************************/

		function adminmenu($url, $title, $image) {
			global $counter, $admingraphic, $Default_Theme;
			$ThemeSel = get_theme();
			if (file_exists("themes/$ThemeSel/images/admin/$image")) {
				$image = "themes/$ThemeSel/images/admin/$image";
				} else {
					$image = "images/admin/$image";
				}
				if ($admingraphic == 1) {
					$img = "<img src=\"$image\" border=\"0\" alt=\"$title\" title=\"$title\"></a><br>";
					$close = "";
					} else {
						$img = "";
						$close = "</a>";
					}
					echo "<td align=\"center\" valign=\"top\" width=\"16%\"><font class=\"content\"><a href=\"$url\">$img<b>$title</b>$close<br><br></font></td>";
					if ($counter == 5) {
						echo "</tr><tr>";
						$counter = 0;
						} else {
							$counter++;
						}
					}

					function GraphicAdmin() {
						global $aid, $admingraphic, $language, $admin, $prefix, $db, $counter, $admin_file;
						$newsubs = $db->sql_numrows($db->sql_query("SELECT qid FROM ".$prefix."_queue"));
						$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
						$radminsuper = intval($row['radminsuper']);
						if ($radminsuper == 1) {
							OpenTable();
							echo "<center><a href=\"".$admin_file.".php\"><font class='title'>"._ADMINMENU."</font></a>";
							echo "<br><br>";
							echo"<table border=\"0\" width=\"100%\" cellspacing=\"1\"><tr>";
							$linksdir = dir("admin/links");
							$menulist = "";
							while($func=$linksdir->read()) {
								if(substr($func, 0, 6) == "links.") {
									$menulist .= "$func ";
								}
							}
							closedir($linksdir->handle);
							$menulist = explode(" ", $menulist);
							sort($menulist);
							for ($i=0; $i < sizeof($menulist); $i++) {
								if(!empty($menulist[$i])) {
									$sucounter = 0;
									include($linksdir->path."/$menulist[$i]");
								}
							}
							adminmenu("".$admin_file.".php?op=logout", ""._ADMINLOGOUT."", "logout.gif");
							echo"</tr></table></center>";
							$counter = "";
							CloseTable();
							echo "<br>";
						}
						OpenTable();
						echo "<center><a href=\"".$admin_file.".php\"><font class='title'>"._MODULESADMIN."</font></a>";
						echo "<br><br>";
						echo"<table border=\"0\" width=\"100%\" cellspacing=\"1\"><tr>";
						$handle=opendir('modules');
						$modlist = "";
						while ($file = readdir($handle)) {
							if ( (!ereg("[.]",$file)) ) {
								$modlist .= "$file ";
							}
						}
						closedir($handle);
						$modlist = explode(" ", $modlist);
						sort($modlist);
						for ($i=0; $i < sizeof($modlist); $i++) {
							if(!empty($modlist[$i])) {
								$row = $db->sql_fetchrow($db->sql_query("SELECT mid from " . $prefix . "_modules where title='$modlist[$i]'"));
								$mid = intval($row['mid']);
								if (empty($mid)) {
									$db->sql_query("insert into " . $prefix . "_modules values (NULL, '$modlist[$i]', '$modlist[$i]', '0', '0', '1', '0', '')");
								}
							}
						}
						$result = $db->sql_query("SELECT title, admins FROM ".$prefix."_modules ORDER BY title ASC");
						$row2 = $db->sql_fetchrow($db->sql_query("SELECT name FROM ".$prefix."_authors WHERE aid='$aid'"));
						while ($row = $db->sql_fetchrow($result)) {
							$admins = explode(",", $row['admins']);
							$auth_user = 0;
							for ($i=0; $i < sizeof($admins); $i++) {
								if ($row2['name'] == $admins[$i]) {
									$auth_user = 1;
								}
							}
							if ($radminsuper == 1 OR $auth_user == 1) {
								if (file_exists("modules/".$row['title']."/admin/index.php") AND file_exists("modules/".$row['title']."/admin/links.php") AND file_exists("modules/".$row['title']."/admin/case.php")) {
									include("modules/".$row['title']."/admin/links.php");
								}
							}
						}
						adminmenu("".$admin_file.".php?op=logout", ""._ADMINLOGOUT."", "logout.gif");
						echo"</tr></table></center>";
						CloseTable();
						echo "<br>";
					}

					/*********************************************************/
					/* Administration Main Function                          */
					/*********************************************************/

					function adminMain() {
						global $language, $admin, $aid, $prefix, $file, $db, $sitename, $user_prefix, $admin_file, $bgcolor1, $locale;
						include("header.php");
						$dummy = 0;
						$month = date('M');
						$curDate2 = "%".$month[0].$month[1].$month[2]."%".date('d')."%".date('Y')."%";
						$ty = time() - 86400;
						$preday = strftime('%d', $ty);
						$premonth = strftime('%B', $ty);
						$preyear = strftime('%Y', $ty);
						$curDateP = "%".$premonth[0].$premonth[1].$premonth[2]."%".$preday."%".$preyear."%";
						GraphicAdmin();
						$aid = substr($aid, 0,25);
						$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper, admlanguage FROM ".$prefix."_authors WHERE aid='$aid'"));
						$radminsuper = intval($row['radminsuper']);
						$admlanguage = addslashes($row['admlanguage']);
						$result = $db->sql_query("SELECT admins FROM ".$prefix."_modules WHERE title='News'");
						$result2 = $db->sql_query("SELECT name FROM ".$prefix."_authors WHERE aid='$aid'");
						list($aidname) = $db->sql_fetchrow($result2);
						$radminarticle = 0;
						while (list($admins) = $db->sql_fetchrow($result)) {
							$admins = explode(",", $admins);
							$auth_user = 0;
							for ($i=0; $i < sizeof($admins); $i++) {
								if ($aidname == $admins[$i]) {
									$auth_user = 1;
								}
							}
							if ($auth_user == 1) {
								$radminarticle = 1;
							}
						}
						if (!empty($admlanguage)) {
							$queryalang = "WHERE alanguage='$admlanguage' ";
							} else {
								$queryalang = "";
							}
							$row3 = $db->sql_fetchrow($db->sql_query("SELECT main_module from ".$prefix."_main"));
							$main_module = $row3['main_module'];
							OpenTable();
							echo "<center><b>$sitename: "._DEFHOMEMODULE."</b><br><br>"
							.""._MODULEINHOME." <b>$main_module</b><br>[ <a href=\"".$admin_file.".php?op=modules\">"._CHANGE."</a> ]</center>";
							CloseTable();
							echo "<br>";
							OpenTable();
							$guest_online_num = intval($db->sql_numrows($db->sql_query("SELECT uname FROM ".$prefix."_session WHERE guest='1'")));
							$member_online_num = intval($db->sql_numrows($db->sql_query("SELECT uname FROM ".$prefix."_session WHERE guest='0'")));
							$who_online_num = $guest_online_num + $member_online_num;
							$who_online = "<center><font class=\"option\">"._WHOSONLINE."</font><br><br><font class=\"content\">"._CURRENTLY." $guest_online_num "._GUESTS." $member_online_num "._MEMBERS."<br>";
							list($userCount) = $db->sql_fetchrow($db->sql_query("SELECT COUNT(user_id) AS userCount from ".$user_prefix."_users WHERE user_regdate LIKE '$curDate2'"));
							list($userCount2) = $db->sql_fetchrow($db->sql_query("SELECT COUNT(user_id) AS userCount FROM ".$user_prefix."_users WHERE user_regdate LIKE '$curDateP'"));
							echo "<center>$who_online<br>"
							.""._BTD.": <b>$userCount</b> - "._BYD.": <b>$userCount2</b></center>";
							CloseTable();
							if (is_active("News")) {
								echo "<br>";
								OpenTable();
								echo "<center><b>"._AUTOMATEDARTICLES."</b></center><br>";
								$count = 0;
								$result5 = $db->sql_query("SELECT anid, aid, title, time, alanguage FROM ".$prefix."_autonews $queryalang ORDER BY time ASC");
								while (list($anid, $aid, $listtitle, $time, $alanguage) = $db->sql_fetchrow($result5)) {
									$anid = intval($anid);
									$said = substr($aid, 0,25);
									$title = $listtitle;
									if (empty($alanguage)) {
										$alanguage = ""._ALL."";
									}
									if (!empty($anid)) {
										if ($count == 0) {
											echo "<table border=\"1\" width=\"100%\">";
											$count = 1;
										}
										$time = str_replace(" ", "@", $time);
										if (($radminarticle==1) OR ($radminsuper==1)) {
											if (($radminarticle==1) AND ($aid == $said) OR ($radminsuper==1)) {
												echo "<tr><td nowrap>&nbsp;<a href=\"".$admin_file.".php?op=publish_now&amp;anid=$anid\"><img src=\"images/active.gif\" alt=\""._PUBLISHNOW."\" title=\""._PUBLISHNOW."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=autoEdit&amp;anid=$anid\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=autoDelete&amp;anid=$anid\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a>&nbsp;</td><td width=\"100%\">&nbsp;$title&nbsp;</td><td align=\"center\">&nbsp;$alanguage&nbsp;</td><td nowrap>&nbsp;$time&nbsp;</td></tr>"; /* Multilingual Code : added column to display language */
												} else {
													echo "<tr><td>&nbsp;("._NOFUNCTIONS.")&nbsp;</td><td width=\"100%\">&nbsp;$title&nbsp;</td><td align=\"center\">&nbsp;$alanguage&nbsp;</td><td nowrap>&nbsp;$time&nbsp;</td></tr>"; /* Multilingual Code : added column to display language */
												}
												} else {
													echo "<tr><td width=\"100%\">&nbsp;$title&nbsp;</td><td align=\"center\">&nbsp;$alanguage&nbsp;</td><td nowrap>&nbsp;$time&nbsp;</td></tr>"; /* Multilingual Code : added column to display language */
												}
											}
										}
										if ((empty($anid)) AND ($count == 0)) {
											echo "<center><i>"._NOAUTOARTICLES."</i></center>";
										}
										if ($count == 1) {
											echo "</table>";
										}
										CloseTable();
										echo "<br>";
										OpenTable();
										echo "<center><b>"._LAST." 20 "._ARTICLES."</b></center><br>";
										$result6 = $db->sql_query("SELECT sid, aid, title, time, topic, informant, alanguage FROM ".$prefix."_stories $queryalang ORDER BY sid DESC LIMIT 0,20");
										echo "<center><table border=\"1\" width=\"100%\" bgcolor=\"$bgcolor1\">";
										while ($row6 = $db->sql_fetchrow($result6)) {
											$sid = intval($row6['sid']);
											$aid = filter($row6['aid'], "nohtml");
											$said = substr("$aid", 0,25);
											$title = filter($row6['title'], "nohtml");
											$time = $row6['time'];
											$topic = intval($row6['topic']);
											$informant = filter($row6['informant'], "nohtml");
											$alanguage = $row6['alanguage'];
											$row7 = $db->sql_fetchrow($db->sql_query("SELECT topicname FROM ".$prefix."_topics WHERE topicid='$topic'"));
											$topicname = filter($row7['topicname'], "nohtml");
											if (empty($alanguage)) {
												$alanguage = ""._ALL."";
											}
											formatTimestamp($time);
											echo "<tr><td align=\"right\"><b>$sid</b>"
											."</td><td align=\"left\" width=\"100%\"><a href=\"modules.php?name=News&amp;file=article&amp;sid=$sid\">$title</a>"
											."</td><td align=\"center\">$alanguage"
											."</td><td align=\"right\">$topicname";
											if ($radminarticle == 1 OR $radminsuper == 1) {
												if (($radminarticle==1) AND ($aid == $said) OR ($radminsuper==1)) {
													echo "</td><td align=\"right\" nowrap>&nbsp;<a href=\"".$admin_file.".php?op=EditStory&amp;sid=$sid\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=RemoveStory&amp;sid=$sid\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a>&nbsp;"
													."</td></tr>";
													} else {
														echo "</td><td align=\"right\" nowrap><font class=\"content\"><i>("._NOFUNCTIONS.")</i></font>"
														."</td></tr>";
													}
													} else {
														echo "</td></tr>";
													}
												}
												echo "</table>";
												if (($radminarticle==1) OR ($radminsuper==1)) {
													echo "<center>"
													."<form action=\"".$admin_file.".php\" method=\"post\">"
													.""._STORYID.": <input type=\"text\" NAME=\"sid\" SIZE=\"10\">"
													."<select name=\"op\">"
													."<option value=\"EditStory\" SELECTED>"._EDIT."</option>"
													."<option value=\"RemoveStory\">"._DELETE."</option>"
													."</select>"
													."<input type=\"submit\" value=\""._GO."\">"
													."</form></center>";
												}
												CloseTable();
											}
											$row8 = $db->sql_fetchrow($db->sql_query("SELECT pollID, pollTitle FROM ".$prefix."_poll_desc WHERE artid='0' ORDER BY pollID DESC LIMIT 1"));
											$pollID = intval($row8['pollID']);
											$pollTitle = filter($row8['pollTitle'], "nohtml");
											if (is_active("Surveys")) {
												echo "<br>";
												OpenTable();
												echo "<center><b>"._CURRENTPOLL.":</b> $pollTitle  <a href=\"".$admin_file.".php?op=create\"><img src=\"images/add.gif\" alt=\""._ADD."\" title=\""._ADD."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=polledit&amp;pollID=$pollID\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a></center>";
												CloseTable();
											}
											unset($title);
											include("footer.php");
										}

										if($admintest) {

											switch($op) {

												case "do_gfx":
												do_gfx();
												break;

												case "deleteNotice":
												deleteNotice($id);
												break;

												case "GraphicAdmin":
												GraphicAdmin();
												break;

												case "adminMain":
												adminMain();
												break;

												case "logout":
												setcookie("admin", false);
												$admin = "";
												include("header.php");
												OpenTable();
												echo "<center><font class=\"title\"><b>"._YOUARELOGGEDOUT."</b></font></center>";
												CloseTable();
												Header("Refresh: 3; url=".$admin_file.".php");
												include("footer.php");
												break;

												case "login";
												unset($op);

												default:
												if (!is_admin($admin)) {
													login();
												}
												$casedir = dir("admin/case");
												while($func=$casedir->read()) {
													if(substr($func, 0, 5) == "case.") {
														include($casedir->path."/".$func);
													}
												}
												closedir($casedir->handle);
												$result = $db->sql_query("SELECT title FROM ".$prefix."_modules ORDER BY title ASC");
												while (list($mod_title) = $db->sql_fetchrow($result)) {
													if (file_exists("modules/$mod_title/admin/index.php") AND file_exists("modules/$mod_title/admin/links.php") AND file_exists("modules/$mod_title/admin/case.php")) {
														include("modules/$mod_title/admin/case.php");
													}
												}
												break;

											}

											} else {

												switch($op) {

													default:
													login();
													break;

												}

											}

											?>