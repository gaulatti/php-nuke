<?php

/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2007 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

// End the transaction
if(!defined('END_TRANSACTION')) {
  define('END_TRANSACTION', 2);
}

// Get php version
$phpver = phpversion();

// convert superglobals if php is lower then 4.1.0
function include_secure($file_name)
{
    $file_name =  preg_replace("/\.[\.\/]*\//", "", $file_name);
    include_once($file_name);
}
if ($phpver < '4.1.0') {
  $_GET = $HTTP_GET_VARS;
  $_POST = $HTTP_POST_VARS;
  $_SERVER = $HTTP_SERVER_VARS;
  $_FILES = $HTTP_POST_FILES;
  $_ENV = $HTTP_ENV_VARS;
  if($_SERVER['REQUEST_METHOD'] == "POST") {
    $_REQUEST = $_POST;
  } elseif($_SERVER['REQUEST_METHOD'] == "GET") {
    $_REQUEST = $_GET;
  }
  if(isset($HTTP_COOKIE_VARS)) {
    $_COOKIE = $HTTP_COOKIE_VARS;
  }
  if(isset($HTTP_SESSION_VARS)) {
    $_SESSION = $HTTP_SESSION_VARS;
  }
}

// override old superglobals if php is higher then 4.1.0
if($phpver >= '4.1.0') {
  $HTTP_GET_VARS = $_GET;
  $HTTP_POST_VARS = $_POST;
  $HTTP_SERVER_VARS = $_SERVER;
  $HTTP_POST_FILES = $_FILES;
  $HTTP_ENV_VARS = $_ENV;
  $PHP_SELF = $_SERVER['PHP_SELF'];
  if(isset($_SESSION)) {
    $HTTP_SESSION_VARS = $_SESSION;
  }
  if(isset($_COOKIE)) {
    $HTTP_COOKIE_VARS= $_COOKIE;
  }
}

// After doing those superglobals we can now use one
// and check if this file isnt being accessed directly

if (stristr(htmlentities($_SERVER['PHP_SELF']), "mainfile.php")) {
    header("Location: index.php");
    exit();
}

if (!function_exists("floatval")) {
    function floatval($inputval) {
        return (float)$inputval;
    }
}
if ($phpver >= '4.0.4pl1' && isset($_SERVER['HTTP_USER_AGENT']) && strstr($_SERVER['HTTP_USER_AGENT'],'compatible')) {
	if (extension_loaded('zlib')) {
    	@ob_end_clean();
    	ob_start('ob_gzhandler');
  	}
} elseif ($phpver > '4.0' && isset($_SERVER['HTTP_ACCEPT_ENCODING']) && !empty($_SERVER['HTTP_ACCEPT_ENCODING'])) {
  	if (strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
    	if (extension_loaded('zlib')) {
      		$do_gzip_compress = true;
      		ob_start(array('ob_gzhandler',5));
      		ob_implicit_flush(0);
      		if (ereg("MSIE", $_SERVER['HTTP_USER_AGENT'])) {
				header('Content-Encoding: gzip');
      		}
    	}
  	}
}

$sanitize_rules = array("newlang"=>"/[a-z][a-z]/i","redirect"=>"/[a-z0-9]*/i");
foreach($_REQUEST as $key=>$value)
{
    if(!isset($sanitize_rules[$key]) || preg_match($sanitize_rules[$key], $values))
    {
        $GLOBALS[$key] = $value;
    }    
}

// This block of code makes sure $admin and $user are COOKIES
if((isset($admin) && $admin != $_COOKIE['admin']) OR (isset($user) && $user != $_COOKIE['user'])) {
	die("Illegal Operation");
}

if(!function_exists('stripos')) {
  function stripos_clone($haystack, $needle, $offset=0) {
    $return = strpos(strtoupper($haystack), strtoupper($needle), $offset);
  if ($return === false) {
    return false;
    } else {
    return true;
    }
  }
} else {
// But when this is PHP5, we use the original function
  function stripos_clone($haystack, $needle, $offset=0) {
    $return = stripos($haystack, $needle, $offset=0);
  if ($return === false) {
    return false;
    } else {
    return true;
    }
  }
}

if(isset($admin) && $admin == $_COOKIE['admin'])
{
	$admin = base64_decode($admin);
	$admin = addslashes($admin);
	$admin = base64_encode($admin);
}

if(isset($user) && $user == $_COOKIE['user'])
{
	$user = base64_decode($user);
	$user = addslashes($user);
	$user = base64_encode($user);
}

// Die message for not allowed HTML tags
$htmltags = "<center><img src=\"images/logo.gif\"><br><br><b>";
$htmltags .= "The html tags you attempted to use are not allowed</b><br><br>";
$htmltags .= "[ <a href=\"javascript:history.go(-1)\"><b>Go Back</b></a> ]</center>";

if (!defined('ADMIN_FILE')) {
 foreach ($_GET as $sec_key => $secvalue) {
 if((eregi("<[^>]*script*\"?[^>]*", $secvalue)) ||
  (eregi("<[^>]*object*\"?[^>]*", $secvalue)) ||
  (eregi("<[^>]*iframe*\"?[^>]*", $secvalue)) ||
  (eregi("<[^>]*applet*\"?[^>]*", $secvalue)) ||
  (eregi("<[^>]*meta*\"?[^>]*", $secvalue)) ||
  (eregi("<[^>]*style*\"?[^>]*", $secvalue)) ||
  (eregi("<[^>]*form*\"?[^>]*", $secvalue)) ||
  (eregi("<[^>]*img*\"?[^>]*", $secvalue)) ||
  (eregi("<[^>]*onmouseover *\"?[^>]*", $secvalue)) ||
  (eregi("<[^>]*body *\"?[^>]*", $secvalue)) ||
  (eregi("\([^>]*\"?[^)]*\)", $secvalue)) ||
  (eregi("\"", $secvalue)) ||
  (eregi("forum_admin", $sec_key)) ||
  (eregi("inside_mod", $sec_key)))
  {
   die ($htmltags);
  }
}

 foreach ($_POST as $secvalue) {
  if ((eregi("<[^>]*iframe*\"?[^>]*", $secvalue)) ||
  (eregi("<[^>]*object*\"?[^>]*", $secvalue)) ||
  (eregi("<[^>]*applet*\"?[^>]*", $secvalue)) ||
  (eregi("<[^>]*meta*\"?[^>]*", $secvalue)) ||
  (eregi("<[^>]*onmouseover*\"?[^>]*", $secvalue)) ||
  (eregi("<[^>]script*\"?[^>]*", $secvalue)) ||
  (eregi("<[^>]*body*\"?[^>]*", $secvalue)) ||
  (eregi("<[^>]style*\"?[^>]*", $secvalue))) {
   die ($htmltags);
  }
 }
}

// Define the INCLUDE PATH
if(defined('FORUM_ADMIN')) {
	define('INCLUDE_PATH', '../../../');
} elseif(defined('INSIDE_MOD')) {
	define('INCLUDE_PATH', '../../');
} else {
	define('INCLUDE_PATH', './');
}

// Include the required files
@require_once(INCLUDE_PATH."config.php");

if(!$dbname) {
    die("<br><br><center><img src=images/logo.gif><br><br><b>There seems that PHP-Nuke isn't installed yet.<br>(The values in config.php file are the default ones)<br><br>You can proceed with the <a href='./install/index.php'>web installation</a> now.</center></b>");
}

@require_once(INCLUDE_PATH."db/db.php");

/* FOLLOWING TWO LINES ARE DEPRECATED BUT ARE HERE FOR OLD MODULES COMPATIBILITY */
/* PLEASE START USING THE NEW SQL ABSTRACTION LAYER. SEE MODULES DOC FOR DETAILS */
@require_once(INCLUDE_PATH."includes/sql_layer.php");
$dbi = sql_connect($dbhost, $dbuname, $dbpass, $dbname);

@require_once(INCLUDE_PATH."includes/ipban.php");
if (file_exists(INCLUDE_PATH."includes/custom_files/custom_mainfile.php")) {
	@include_once(INCLUDE_PATH."includes/custom_files/custom_mainfile.php");
}

if (!defined('FORUM_ADMIN')) {
if(empty($admin_file)) {
   	die ("You must set a value for admin_file in config.php");
} elseif (!empty($admin_file) && !file_exists(INCLUDE_PATH.$admin_file.".php")) {
   	die ("The admin_file you defined in config.php does not exist");
  }
}

define('NUKE_FILE', true);
$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_config"));
$sitename = filter($row['sitename'], "nohtml");
$nukeurl = filter($row['nukeurl'], "nohtml");
$site_logo = filter($row['site_logo'], "nohtml");
$slogan = filter($row['slogan'], "nohtml");
$startdate = filter($row['startdate'], "nohtml");
$adminmail = filter($row['adminmail'], "nohtml");
$anonpost = intval($row['anonpost']);
$Default_Theme = filter($row['Default_Theme'], "nohtml");
$foot1 = filter($row['foot1']);
$foot2 = filter($row['foot2']);
$foot3 = filter($row['foot3']);
$commentlimit = intval($row['commentlimit']);
$anonymous = filter($row['anonymous'], "nohtml");
$minpass = intval($row['minpass']);
$pollcomm = intval($row['pollcomm']);
$articlecomm = intval($row['articlecomm']);
$broadcast_msg = intval($row['broadcast_msg']);
$my_headlines = intval($row['my_headlines']);
$top = intval($row['top']);
$storyhome = intval($row['storyhome']);
$user_news = intval($row['user_news']);
$oldnum = intval($row['oldnum']);
$ultramode = intval($row['ultramode']);
$banners = intval($row['banners']);
$backend_title = filter($row['backend_title'], "nohtml");
$backend_language = filter($row['backend_language'], "nohtml");
$language = filter($row['language'], "nohtml");
$locale = filter($row['locale'], "nohtml");
$multilingual = intval($row['multilingual']);
$useflags = intval($row['useflags']);
$notify = intval($row['notify']);
$notify_email = filter($row['notify_email'], "nohtml");
$notify_subject = filter($row['notify_subject'], "nohtml");
$notify_message = filter($row['notify_message'], "nohtml");
$notify_from = filter($row['notify_from'], "nohtml");
$moderate = intval($row['moderate']);
$admingraphic = intval($row['admingraphic']);
$httpref = intval($row['httpref']);
$httprefmax = intval($row['httprefmax']);
$CensorMode = intval($row['CensorMode']);
$CensorReplace = filter($row['CensorReplace'], "nohtml");
$copyright = filter($row['copyright']);
$Version_Num = floatval($row['Version_Num']);
$domain = str_replace("http://", "", $nukeurl);
$gfx_chk = intval($row['gfx_chk']);
$display_errors = filter($row['display_errors']);
$nuke_editor = intval($row['nuke_editor']);
$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$start_time = $mtime;
$pagetitle = "";

// Error reporting, to be set in config.php
error_reporting(E_ALL^E_NOTICE);
if ($display_errors == 1) {
  @ini_set('display_errors', 1);
} else {
  @ini_set('display_errors', 0);
}

if (!defined('FORUM_ADMIN')) {
    if ((isset($newlang)) AND (stristr($newlang,"."))) {
		if (file_exists("language/lang-".$newlang.".php")) {
			setcookie("lang",$newlang,time()+31536000);
			include_secure("language/lang-".$newlang.".php");
			$currentlang = $newlang;
		} else {
			setcookie("lang",$language,time()+31536000);
			include_secure("language/lang-".$language.".php");
			$currentlang = $language;
		}
	} elseif (isset($lang)) {
		include_secure("language/lang-".$lang.".php");
		$currentlang = $lang;
	} else {
		setcookie("lang",$language,time()+31536000);
		include_secure("language/lang-".$language.".php");
		$currentlang = $language;
	}
}

function makePass() {
	$cons = "bcdfghjklmnpqrstvwxyz";
	$vocs = "aeiou";
	for ($x=0; $x < 6; $x++) {
		mt_srand ((double) microtime() * 1000000);
		$con[$x] = substr($cons, mt_rand(0, strlen($cons)-1), 1);
		$voc[$x] = substr($vocs, mt_rand(0, strlen($vocs)-1), 1);
	}
	mt_srand((double)microtime()*1000000);
	$num1 = mt_rand(0, 9);
	$num2 = mt_rand(0, 9);
	$makepass = $con[0] . $voc[0] .$con[2] . $num1 . $num2 . $con[3] . $voc[3] . $con[4];
	return($makepass);
}

function get_lang($module) {
   global $currentlang, $language;
   if ($module == "admin" AND $module != "Forums") {
      if (file_exists("admin/language/lang-".$currentlang.".php")) {
         include_secure("admin/language/lang-".$currentlang.".php");
      } elseif (file_exists("admin/language/lang-".$language.".php")) {
         include_secure("admin/language/lang-".$language.".php");
      }
   } else {
      if (file_exists("modules/$module/language/lang-".$currentlang.".php")) {
         include_secure("modules/$module/language/lang-".$currentlang.".php");
      } elseif (file_exists("modules/$module/language/lang-".$language.".php")) {
         include_secure("modules/$module/language/lang-".$language.".php");
      }
   }
}

function is_admin($admin) {
    static $adminSave; 
    if (!$admin) { return 0; }
    if (isset($adminSave)) return $adminSave;
    if (!is_array($admin)) {
        $admin = base64_decode($admin);
        $admin = addslashes($admin);
        $admin = explode(':', $admin);
    }
    $aid = $admin[0];
    $pwd = $admin[1];
    $aid = substr(addslashes($aid), 0, 25);
    if (!empty($aid) && !empty($pwd)) {
        global $prefix, $db;
        $sql = "SELECT pwd FROM ".$prefix."_authors WHERE aid='$aid'";
        $result = $db->sql_query($sql);
        $pass = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        if ($pass[0] == $pwd && !empty($pass[0])) {
        	return $adminSave = 1;
        }
    }
    return $adminSave = 0;
}

function is_user($user) {
    if (!$user) { return 0; }
    static $userSave; 
    if (isset($userSave)) return $userSave;
    if (!is_array($user)) {
        $user = base64_decode($user);
        $user = addslashes($user);
        $user = explode(":", $user);
    }
    $uid = $user[0];
    $pwd = $user[2];
    $uid = intval($uid);
    if (!empty($uid) AND !empty($pwd)) {
        global $db, $user_prefix;
        $sql = "SELECT user_password FROM ".$user_prefix."_users WHERE user_id='$uid'";
        $result = $db->sql_query($sql);
        list($row) = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        if ($row == $pwd && !empty($row)) { 
        	return $userSave = 1;
        }
    }
    return $userSave = 0;
}

function is_group($user, $name) {
          global $prefix, $db, $user_prefix, $cookie, $user;
     if (is_user($user)) {
          if(!is_array($user)) {
          $cookie = cookiedecode($user);
          $uid = intval($cookie[0]);
          } else {
          $uid = intval($user[0]);
          }
          $result = $db->sql_query("SELECT points FROM ".$user_prefix."_users WHERE user_id='$uid'");
          $row = $db->sql_fetchrow($result);
          $points = intval($row['points']);
          $db->sql_freeresult($result);
          $result2 = $db->sql_query("SELECT mod_group FROM ".$prefix."_modules WHERE title='$name'");
          $row2 = $db->sql_fetchrow($result2);
          $mod_group = intval($row2['mod_group']);
          $db->sql_freeresult($result2);
          $result3 = $db->sql_query("SELECT points FROM ".$prefix."_groups WHERE id='$mod_group'");
          $row3 = $db->sql_fetchrow($result3);
          $grp = intval($row3['points']);
          $db->sql_freeresult($result3);
          if (($points >= 0 AND $points >= $grp) OR $mod_group == 0) {
        	return 1;
          }
     }
     return 0;
}

$postString = "";
foreach ($_POST as $postkey => $postvalue) {
    if ($postString > "") {
     $postString .= "&".$postkey."=".$postvalue;
    } else {
     $postString .= $postkey."=".$postvalue;
    }
}
str_replace("%09", "%20", $postString);
$postString_64 = base64_decode($postString);
if ((!isset($admin) OR (isset($admin) AND !is_admin($admin))) AND (stristr($postString,'%20union%20')) OR (stristr($postString,'*/union/*')) OR (stristr($postString,' union ')) OR (stristr($postString_64,'%20union%20')) OR (stristr($postString_64,'*/union/*')) OR (stristr($postString_64,' union ')) OR (stristr($postString_64,'+union+')) OR (stristr($postString,'http-equiv')) OR (stristr($postString_64,'http-equiv')) OR (stristr($postString,'alert(')) OR (stristr($postString_64,'alert(')) OR (stristr($postString,'javascript:')) OR (stristr($postString_64,'javascript:')) OR (stristr($postString,'document.cookie')) OR (stristr($postString_64,'document.cookie')) OR (stristr($postString,'onmouseover=')) OR (stristr($postString_64,'onmouseover=')) OR (stristr($postString,'document.location')) OR (stristr($postString_64,'document.location'))) {
header("Location: index.php");
die();
}

// Additional security (Union, CLike, XSS)
//Union Tap
//Copyright Zhen-Xjell 2004 http://nukecops.com
//Beta 3 Code to prevent UNION SQL Injections
  unset($matches);
  unset($loc);
  if(isset($_SERVER['QUERY_STRING'])) {
    if (preg_match("/([OdWo5NIbpuU4V2iJT0n]{5}) /", rawurldecode($loc=$_SERVER['QUERY_STRING']), $matches)) {
      die('Illegal Operation');
    }
  }
  if(!isset($admin) OR (isset($admin) AND !is_admin($admin))) {
    $queryString = $_SERVER['QUERY_STRING'];
	if (($_SERVER['PHP_SELF'] != "/index.php") OR !isset($url))
	{
	   if (stristr($queryString,'http://')) die('Illegal Operation');
	}
    if ((stristr($queryString,'%20union%20')) OR (stristr($queryString,'/*')) OR (stristr($queryString,'*/union/*')) OR (stristr($queryString,'c2nyaxb0')) OR (stristr($queryString,'+union+'))  OR ((stristr($queryString,'cmd=')) AND (!stristr($queryString,'&cmd'))) OR ((stristr($queryString,'exec')) AND (!stristr($queryString,'execu'))) OR (stristr($queryString,'concat'))) {
      die('Illegal Operation');
    }
  }

function update_points($id) {
  global $user_prefix, $prefix, $db, $user;
  if (is_user($user)) {
    if(!is_array($user)) {
      $cookie = cookiedecode($user);
      $username = trim($cookie[1]);
    } else {
      $username = trim($user[1]);
    }
      $username = substr(htmlspecialchars(str_replace("\'", "'", trim($username))), 0, 25);
      $username = rtrim($username, "\\");	
      $username = str_replace("'", "\'", $username);
    if ($db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_groups")) > 0) {
      $id = intval($id);
      $result = $db->sql_query("SELECT points FROM ".$prefix."_groups_points WHERE id='$id'");
      list($points) = $db->sql_fetchrow($result);
      $db->sql_freeresult($result);
      $rpoints = intval($points);
      $db->sql_query("UPDATE ".$user_prefix."_users SET points=points+".$rpoints." WHERE username='$username'");
    }
  }
}

function title($text) {
	OpenTable();
	echo "<center><span class=\"title\"><strong>$text</strong></span></center>";
	CloseTable();
	echo "<br>";
}

function is_active($module) {
    global $prefix, $db;
    static $save;
    if (is_array($save)) {
        if (isset($save[$module])) return ($save[$module]);
        return 0;
    }
    $sql = "SELECT title FROM ".$prefix."_modules WHERE active=1";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $save[$row[0]] = 1;
    }
    $db->sql_freeresult($result);
    if (isset($save[$module])) return ($save[$module]);
    return 0;
}

function render_blocks($side, $blockfile, $title, $content, $bid, $url) {
	if(!defined('BLOCK_FILE')) {
	  define('BLOCK_FILE', true);
	}
	if (empty($url)) {
		if (empty($blockfile)) {
			if ($side == "c") {
				themecenterbox($title, $content);
			} elseif ($side == "d") {
				themecenterbox($title, $content);
			} else {
				themesidebox($title, $content);
			}
		} else {
			if ($side == "c") {
				blockfileinc($title, $blockfile, 1);
			} elseif ($side == "d") {
				blockfileinc($title, $blockfile, 1);
			} else {
				blockfileinc($title, $blockfile);
			}
		}
	} else {
		if ($side == "c" OR $side == "d") {
			headlines($bid,1);
		} else {
			headlines($bid);
		}
	}
}

function blocks($side) {
	global $storynum, $prefix, $multilingual, $currentlang, $db, $admin, $user;
	if ($multilingual == 1) {
		$querylang = "AND (blanguage='$currentlang' OR blanguage='')";
	} else {
		$querylang = "";
	}
	if (strtolower($side[0]) == "l") {
		$pos = "l";
	} elseif (strtolower($side[0]) == "r") {
		$pos = "r";
	}  elseif (strtolower($side[0]) == "c") {
		$pos = "c";
	} elseif  (strtolower($side[0]) == "d") {
		$pos = "d";
	}
	$side = $pos;
	$sql = "SELECT bid, bkey, title, content, url, blockfile, view, expire, action, subscription FROM ".$prefix."_blocks WHERE bposition='$pos' AND active='1' $querylang ORDER BY weight ASC";
	$result = $db->sql_query($sql);
	while($row = $db->sql_fetchrow($result)) {
		$bid = intval($row['bid']);
		$title = filter($row['title'], "nohtml");
		$content = stripslashes($row['content']);
		$url = filter($row['url'], "nohtml");
		$blockfile = filter($row['blockfile'], "nohtml");
		$view = intval($row['view']);
		$expire = intval($row['expire']);
		$action = filter($row['action'], "nohtml");
		$action = substr($action, 0,1);
		$now = time();
		$sub = intval($row['subscription']);
		if ($sub == 0 OR ($sub == 1 AND !paid())) {
			if ($expire != 0 AND $expire <= $now) {
				if ($action == "d") {
					$db->sql_query("UPDATE ".$prefix."_blocks SET active='0', expire='0' WHERE bid='$bid'");
					return;
				} elseif ($action == "r") {
					$db->sql_query("DELETE FROM ".$prefix."_blocks WHERE bid='$bid'");
					return;
				}
			}
			if ($row['bkey'] == "admin") {
				adminblock();
			} elseif ($row['bkey'] == "userbox") {
				userblock();
			} elseif (empty($row['bkey'])) {
				if ($view == 0) {
					render_blocks($side, $blockfile, $title, $content, $bid, $url);
				} elseif ($view == 1 AND is_user($user) || is_admin($admin)) {
					render_blocks($side, $blockfile, $title, $content, $bid, $url);
				} elseif ($view == 2 AND is_admin($admin)) {
					render_blocks($side, $blockfile, $title, $content, $bid, $url);
				} elseif ($view == 3 AND !is_user($user) || is_admin($admin)) {
					render_blocks($side, $blockfile, $title, $content, $bid, $url);
				}
			}
		}
	}
	$db->sql_freeresult($result);
}

function message_box() {
	global $bgcolor1, $bgcolor2, $user, $admin, $cookie, $textcolor2, $prefix, $multilingual, $currentlang, $db, $admin_file;
	if ($multilingual == 1) {
		$querylang = "AND (mlanguage='$currentlang' OR mlanguage='')";
	} else {
		$querylang = "";
	}
	$result = $db->sql_query("SELECT mid, title, content, date, expire, view FROM ".$prefix."_message WHERE active='1' $querylang");
	if ($numrows = $db->sql_numrows($result) == 0) {
		return;
	} else {
		while ($row = $db->sql_fetchrow($result)) {
			$mid = intval($row['mid']);
			$title = filter($row['title'], "nohtml");
			$content = filter($row['content']);
			$mdate = $row['date'];
			$expire = intval($row['expire']);
			$view = intval($row['view']);
			if (!empty($title) && !empty($content)) {
				if ($expire == 0) {
					$remain = _UNLIMITED;
				} else {
					$etime = (($mdate+$expire)-time())/3600;
					$etime = (int)$etime;
					if ($etime < 1) {
						$remain = _EXPIRELESSHOUR;
					} else {
						$remain = ""._EXPIREIN." $etime "._HOURS."";
					}
				}
				if ($view == 5 AND paid()) {
					OpenTable();
					echo "<center><font class=\"option\" color=\"$textcolor2\"><b>$title</b></font></center><br>\n"
					."<font class=\"content\">$content</font>";
					if (is_admin($admin)) {
						echo "<br><br><center><font class=\"content\">[ "._MVIEWSUBUSERS." - $remain - <a href=\"".$admin_file.".php?op=editmsg&amp;mid=$mid\">"._EDIT."</a> ]</font></center>";
					}
					CloseTable();
					echo "<br>";
				} elseif ($view == 4 AND is_admin($admin)) {
					OpenTable();
					echo "<center><font class=\"option\" color=\"$textcolor2\"><b>$title</b></font></center><br>\n"
					."<font class=\"content\">$content</font>"
					."<br><br><center><font class=\"content\">[ "._MVIEWADMIN." - $remain - <a href=\"".$admin_file.".php?op=editmsg&amp;mid=$mid\">"._EDIT."</a> ]</font></center>";
					CloseTable();
					echo "<br>";
				} elseif ($view == 3 AND is_user($user) || is_admin($admin)) {
					OpenTable();
					echo "<center><font class=\"option\" color=\"$textcolor2\"><b>$title</b></font></center><br>\n"
					."<font class=\"content\">$content</font>";
					if (is_admin($admin)) {
						echo "<br><br><center><font class=\"content\">[ "._MVIEWUSERS." - $remain - <a href=\"".$admin_file.".php?op=editmsg&amp;mid=$mid\">"._EDIT."</a> ]</font></center>";
					}
					CloseTable();
					echo "<br>";
				} elseif ($view == 2 AND !is_user($user) || is_admin($admin)) {
					OpenTable();
					echo "<center><font class=\"option\" color=\"$textcolor2\"><b>$title</b></font></center><br>\n"
					."<font class=\"content\">$content</font>";
					if (is_admin($admin)) {
						echo "<br><br><center><font class=\"content\">[ "._MVIEWANON." - $remain - <a href=\"".$admin_file.".php?op=editmsg&amp;mid=$mid\">"._EDIT."</a> ]</font></center>";
					}
					CloseTable();
					echo "<br>";
				} elseif ($view == 1) {
					OpenTable();
					echo "<center><font class=\"option\" color=\"$textcolor2\"><b>$title</b></font></center><br>\n"
					."<font class=\"content\">$content</font>";
					if (is_admin($admin)) {
						echo "<br><br><center><font class=\"content\">[ "._MVIEWALL." - $remain - <a href=\"".$admin_file.".php?op=editmsg&amp;mid=$mid\">"._EDIT."</a> ]</font></center>";
					}
					CloseTable();
					echo "<br>";
				}
				if ($expire != 0) {
					$past = time()-$expire;
					if ($mdate < $past) {
						$db->sql_query("UPDATE ".$prefix."_message SET active='0' WHERE mid='$mid'");
					}
				}
			}
		}
	}
}

function online() {
  global $user, $cookie, $prefix, $db;
  $ip = $_SERVER['REMOTE_ADDR'];
  if (is_user($user)) {
    cookiedecode($user);
    $uname = $cookie[1];
    $guest = 0;
  } else {
    $uname = $ip;
    $guest = 1;
  }
  $past = time()-3600;
  $sql = "DELETE FROM ".$prefix."_session WHERE time < '$past'";
  $db->sql_query($sql);
  $sql = "SELECT time FROM ".$prefix."_session WHERE uname='".addslashes($uname)."'";
  $result = $db->sql_query($sql);
  $ctime = time();
  if (!empty($uname)) {
    $uname = substr($uname, 0,25);
    $row = $db->sql_fetchrow($result);
    if ($row) {
      $db->sql_query("UPDATE ".$prefix."_session SET uname='".addslashes($uname)."', time='$ctime', host_addr='$ip', guest='$guest' WHERE uname='".addslashes($uname)."'");
    } else {
      $db->sql_query("INSERT INTO ".$prefix."_session (uname, time, host_addr, guest) VALUES ('".addslashes($uname)."', '$ctime', '$ip', '$guest')");
    }
  }
  $db->sql_freeresult($result);
}

function blockfileinc($title, $blockfile, $side=0) {
	$blockfiletitle = $title;
	$file = file_exists("blocks/".$blockfile."");
	if (!$file) {
		$content = _BLOCKPROBLEM;
	} else {
		include("blocks/".$blockfile."");
	}
	if (empty($content)) {
		$content = _BLOCKPROBLEM2;
	}
	if ($side == 1) {
		themecenterbox($blockfiletitle, $content);
	} elseif ($side == 2) {
		themecenterbox($blockfiletitle, $content);
	} else {
		themesidebox($blockfiletitle, $content);
	}
}

function selectlanguage() {
	global $useflags, $currentlang;
	if ($useflags == 1) {
		$title = _SELECTLANGUAGE;
		$content = "<center><font class=\"content\">"._SELECTGUILANG."<br><br>";
		$langdir = dir("language");
		while($func=$langdir->read()) {
			if(substr($func, 0, 5) == "lang-") {
				$menulist .= "$func ";
			}
		}
		closedir($langdir->handle);
		$menulist = explode(" ", $menulist);
		sort($menulist);
		for ($i=0; $i < sizeof($menulist); $i++) {
			if($menulist[$i]!="") {
				$tl = str_replace("lang-","",$menulist[$i]);
				$tl = str_replace(".php","",$tl);
				$altlang = ucfirst($tl);
				$content .= "<a href=\"index.php?newlang=".$tl."\"><img src=\"images/language/flag-".$tl.".png\" border=\"0\" alt=\"$altlang\" title=\"$altlang\" hspace=\"3\" vspace=\"3\"></a> ";
			}
		}
		$content .= "</font></center>";
		themesidebox($title, $content);
	} else {
		$title = _SELECTLANGUAGE;
		$content = "<center><font class=\"content\">"._SELECTGUILANG."<br><br></font>";
		$content .= "<form action=\"index.php\" method=\"get\"><select name=\"newlanguage\" onChange=\"top.location.href=this.options[this.selectedIndex].value\">";
		$handle=opendir('language');
		$languageslist = "";
		while ($file = readdir($handle)) {
			if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
				$langFound = $matches[1];
				$languageslist .= "$langFound ";
			}
		}
		closedir($handle);
		$languageslist = explode(" ", $languageslist);
		sort($languageslist);
		for ($i=0; $i < sizeof($languageslist); $i++) {
			if($languageslist[$i]!="") {
				$content .= "<option value=\"index.php?newlang=$languageslist[$i]\" ";
				if($languageslist[$i]==$currentlang) $content .= " selected";
				$content .= ">".ucfirst($languageslist[$i])."</option>\n";
			}
		}
		$content .= "</select></form></center>";
		themesidebox($title, $content);
	}
}

function ultramode() {
	global $prefix, $db;
	$ultra = "ultramode.txt";
	$file = fopen($ultra, "w");
	fwrite($file, "General purpose self-explanatory file with news headlines\n");
	$sql = "SELECT s.sid, s.catid, s.aid, s.title, s.time, s.hometext, s.comments, s.topic, t.topictext, t.topicimage FROM ".$prefix."_stories s LEFT JOIN ".$prefix."_topics t ON t.topicid = s.topic WHERE s.ihome = '0' ".$querylang." ORDER BY s.time DESC LIMIT 0,10";
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) {
		$rsid = intval($row['sid']);
		$raid = filter($row['aid'], "nohtml");
		$rtitle = filter($row['title'], "nohtml");
		$rtime = $row['time'];
		$rhometext = filter(stripslashes($row['hometext']), "nohtml");
		$rcomments = intval($row['comments']);
		$rtopic = intval($row['topic']);
		$row2 = $db->sql_fetchrow($db->sql_query("select topictext, topicimage from ".$prefix."_topics where topicid='$rtopic'"));
		$topictext = filter($row2['topictext'], "nohtml");
		$topicimage = filter($row2['topicimage'], "nohtml");
		$content = "%%\n".$rtitle."\n/modules.php?name=News&amp;file=article&amp;sid=".$rsid."\n".$rtime."\n".$raid."\n".$topictext."\n".$rcomments."\n".$topicimage."\n";
		fwrite($file, $content);
	}
	fclose($file);
	$db->sql_freeresult($result);
}

function cookiedecode($user) {
    global $cookie, $db, $user_prefix;
    static $pass;
    if(!is_array($user)) {
        $user = base64_decode($user);
        $user = addslashes($user);
        $cookie = explode(":", $user);
    } else {
        $cookie = $user;
    }
    if (!isset($pass) AND isset($cookie[1])) {
       $sql = "SELECT user_password FROM ".$user_prefix."_users WHERE username='$cookie[1]'";
       $result = $db->sql_query($sql);
       list($pass) = $db->sql_fetchrow($result);
       $db->sql_freeresult($result);
    }
    if (isset($cookie[2]) AND ($cookie[2] == $pass) AND (!empty($pass))) { return $cookie; }
}

function getusrinfo($user) {
    global $user_prefix, $db, $userinfo, $cookie;
    if (!$user OR empty($user)) {
      return NULL;
    }
    cookiedecode($user);
    $user = $cookie;
    if (isset($userrow) AND is_array($userrow)) {
        if ($userrow['username'] == $user[1] && $userrow['user_password'] == $user[2]) {
            return $userrow;
        }
    }
    $sql = "SELECT * FROM ".$user_prefix."_users WHERE username='$user[1]' AND user_password='$user[2]'";
    $result = $db->sql_query($sql);
    if ($db->sql_numrows($result) == 1) {
        static $userrow;
        $userrow = $db->sql_fetchrow($result);
        return $userinfo = $userrow;
    }
    $db->sql_freeresult($result);
    unset($userinfo);
}

function FixQuotes ($what = "") {
	while (stristr($what, "\\\\'")) {
		$what = str_replace("\\\\'","'",$what);
	}
	return $what;
}

/*********************************************************/
/* text filter                                           */
/*********************************************************/

function check_words($Message) {
	global $CensorMode, $CensorReplace, $EditedMessage;
	include("config.php");
	$EditedMessage = $Message;
	if ($CensorMode != 0) {
		if (is_array($CensorList)) {
			$Replace = $CensorReplace;
			if ($CensorMode == 1) {
				for ($i = 0; $i < count($CensorList); $i++) {
					$EditedMessage = eregi_replace("$CensorList[$i]([^a-zA-Z0-9])","$Replace\\1",$EditedMessage);
				}
			} elseif ($CensorMode == 2) {
				for ($i = 0; $i < count($CensorList); $i++) {
					$EditedMessage = eregi_replace("(^|[^[:alnum:]])$CensorList[$i]","\\1$Replace",$EditedMessage);
				}
			} elseif ($CensorMode == 3) {
				for ($i = 0; $i < count($CensorList); $i++) {
					$EditedMessage = eregi_replace("$CensorList[$i]","$Replace",$EditedMessage);
				}
			}
		}
	}
	return ($EditedMessage);
}

function delQuotes($string){
	/* no recursive function to add quote to an HTML tag if needed */
	/* and delete duplicate spaces between attribs. */
	$tmp="";    # string buffer
	$result=""; # result string
	$i=0;
	$attrib=-1; # Are us in an HTML attrib ?   -1: no attrib   0: name of the attrib   1: value of the atrib
	$quote=0;   # Is a string quote delimited opened ? 0=no, 1=yes
	$len = strlen($string);
	while ($i<$len) {
		switch($string[$i]) { # What car is it in the buffer ?
		case "\"": #"       # a quote.
		if ($quote==0) {
			$quote=1;
		} else {
			$quote=0;
			if (($attrib>0) && ($tmp != "")) { $result .= "=\"$tmp\""; }
			$tmp="";
			$attrib=-1;
		}
		break;
		case "=":           # an equal - attrib delimiter
		if ($quote==0) {  # Is it found in a string ?
		$attrib=1;
		if ($tmp!="") $result.=" $tmp";
		$tmp="";
		} else $tmp .= '=';
		break;
		case " ":           # a blank ?
		if ($attrib>0) {  # add it to the string, if one opened.
		$tmp .= $string[$i];
		}
		break;
		default:            # Other
		if ($attrib<0)    # If we weren't in an attrib, set attrib to 0
		$attrib=0;
		$tmp .= $string[$i];
		break;
		}
		$i++;
	}
	if (($quote!=0) && ($tmp != "")) {
		if ($attrib==1) $result .= "=";
		/* If it is the value of an atrib, add the '=' */
		$result .= "\"$tmp\"";  /* Add quote if needed (the reason of the function ;-) */
	}
	return $result;
}

function check_html ($str, $strip="") {
	/* The core of this code has been lifted from phpslash */
	/* which is licenced under the GPL. */
	include("config.php");
	if ($strip == "nohtml")
	$AllowableHTML=array('');
	$str = stripslashes($str);
	$str = eregi_replace("<[[:space:]]*([^>]*)[[:space:]]*>",'<\\1>', $str);
	// Delete all spaces from html tags .
	$str = eregi_replace("<a[^>]*href[[:space:]]*=[[:space:]]*\"?[[:space:]]*([^\" >]*)[[:space:]]*\"?[^>]*>",'<a href="\\1">', $str);
	// Delete all attribs from Anchor, except an href, double quoted.
	$str = eregi_replace("<[[:space:]]* img[[:space:]]*([^>]*)[[:space:]]*>", '', $str);
	// Delete all img tags
	$str = eregi_replace("<a[^>]*href[[:space:]]*=[[:space:]]*\"?javascript[[:punct:]]*\"?[^>]*>", '', $str);
	// Delete javascript code from a href tags -- Zhen-Xjell @ http://nukecops.com
	$tmp = "";
	while (ereg("<(/?[[:alpha:]]*)[[:space:]]*([^>]*)>",$str,$reg)) {
		$i = strpos($str,$reg[0]);
		$l = strlen($reg[0]);
		if ($reg[1][0] == "/") $tag = strtolower(substr($reg[1],1));
		else $tag = strtolower($reg[1]);
		if ($a = $AllowableHTML[$tag])
		if ($reg[1][0] == "/") $tag = "</$tag>";
		elseif (($a == 1) || ($reg[2] == "")) $tag = "<$tag>";
		else {
			# Place here the double quote fix function.
			$attrb_list=delQuotes($reg[2]);
			// A VER
			//$attrb_list = ereg_replace("&","&amp;",$attrb_list);
			$tag = "<$tag" . $attrb_list . ">";
		} # Attribs in tag allowed
		else $tag = "";
		$tmp .= substr($str,0,$i) . $tag;
		$str = substr($str,$i+$l);
	}
	$str = $tmp . $str;
	return $str;
	exit;
	/* Squash PHP tags unconditionally */
	$str = ereg_replace("<\?","",$str);
	return $str;
}

function filter_text($Message, $strip="") {
	global $EditedMessage;
	check_words($Message);
	$EditedMessage=check_html($EditedMessage, $strip);
	return ($EditedMessage);
}

function filter($what, $strip="", $save="", $type="") {
	if ($strip == "nohtml") {
		$what = check_html($what, $strip);
		$what = htmlentities(trim($what), ENT_QUOTES);
		// If the variable $what doesn't comes from a preview screen should be converted
		if ($type != "preview" AND $save != 1) {
			$what = html_entity_decode($what, ENT_QUOTES);
		}
	}
	if ($save == 1) {
		$what = check_words($what);
		$what = check_html($what, $strip);
		$what = addslashes($what);
	} else {
		$what = stripslashes(FixQuotes($what));
		$what = check_words($what);
		$what = check_html($what, $strip);
	}
	return($what);
}

/*********************************************************/
/* formatting stories                                    */
/*********************************************************/

function formatTimestamp($time) {
    global $datetime, $locale;
    setlocale(LC_TIME, $locale);
    if (!is_numeric($time)) {
        preg_match('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $time, $datetime);
        $time = gmmktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
    }
    $time -= date("Z");
    $datetime = strftime(_DATESTRING, $time);
    $datetime = ucfirst($datetime);
    return $datetime;
}

function get_author($aid) {
	global $prefix, $db;
    static $users;
    if (isset($users[$aid]) AND is_array($users[$aid])) {
        $row = $users[$aid];
    } else {
        $sql = "SELECT url, email FROM ".$prefix."_authors WHERE aid='$aid'";
        $result = $db->sql_query($sql);
        $row = $db->sql_fetchrow($result);
        $users[$aid] = $row;
        $db->sql_freeresult($result);
    }
	$aidurl = filter($row['url'], "nohtml");
	$aidmail = filter($row['email'], "nohtml");
    if (isset($aidurl) && $aidurl != "http://") {
        $aid = "<a href=\"".$aidurl."\">$aid</a>";
    } elseif (isset($aidmail)) {
        $aid = "<a href=\"mailto:".$aidmail."\">$aid</a>";
    } else {
        $aid = $aid;
    }
    return $aid;
}

function formatAidHeader($aid) {
  $AidHeader = get_author($aid);
  echo $AidHeader;
}

if(!defined('FORUM_ADMIN')) {
  $ThemeSel = get_theme();
  include_secure("themes/$ThemeSel/theme.php");
}

if(!function_exists("themepreview")) {
	function themepreview($title, $hometext, $bodytext="", $notes="") {
		echo "<b>$title</b><br><br>$hometext";
		if (!empty($bodytext)) {
			echo "<br><br>$bodytext";
		}
		if (!empty($notes)) {
			echo "<br><br><b>"._NOTE."</b> <i>$notes</i>";
		}
    }
}

function adminblock() {
	global $admin, $prefix, $db, $admin_file;
	if (is_admin($admin)) {
	    $sql = "SELECT title, content FROM ".$prefix."_blocks WHERE bkey='admin'";
		$result = $db->sql_query($sql);
		while (list($title, $content) = $db->sql_fetchrow($result)) {
			$content = filter($content);
			$title = filter($title, "nohtml");
			$content = "<span class=\"content\">".$content."</span>";
			themesidebox($title, $content);
		}
		$title = _WAITINGCONT;
		$num = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_queue"));
		$content = "<span class=\"content\">";
		$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$admin_file.".php?op=submissions\">"._SUBMISSIONS."</a>: $num<br>";
		$num = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_reviews_add"));
		$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$admin_file.".php?op=reviews\">"._WREVIEWS."</a>: $num<br>";
		$num = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_links_newlink"));
		$brokenl = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_links_modrequest WHERE brokenlink='1'"));
		$modreql = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_links_modrequest WHERE brokenlink='0'"));
		$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$admin_file.".php?op=Links\">"._WLINKS."</a>: $num<br>";
		$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$admin_file.".php?op=LinksListModRequests\">"._MODREQLINKS."</a>: $modreql<br>";
		$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$admin_file.".php?op=LinksListBrokenLinks\">"._BROKENLINKS."</a>: $brokenl<br>";
		$num = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_downloads_newdownload"));
		$brokend = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_downloads_modrequest WHERE brokendownload='1'"));
		$modreqd = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_downloads_modrequest WHERE brokendownload='0'"));
		$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$admin_file.".php?op=downloads\">"._UDOWNLOADS."</a>: $num<br>";
		$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$admin_file.".php?op=DownloadsListModRequests\">"._MODREQDOWN."</a>: $modreqd<br>";
		$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$admin_file.".php?op=DownloadsListBrokenDownloads\">"._BROKENDOWN."</a>: $brokend<br></span>";
		themesidebox($title, $content);
	}
}

function loginbox() {
	global $user, $sitekey, $gfx_chk;
	mt_srand ((double)microtime()*1000000);
	$maxran = 1000000;
	$random_num = mt_rand(0, $maxran);
	$datekey = date("F j");
	$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $random_num . $datekey));
	$code = substr($rcode, 2, 6);
	if (!is_user($user)) {
		$title = _LOGIN;
		$boxstuff = "<form action=\"modules.php?name=Your_Account\" method=\"post\">";
		$boxstuff .= "<center><font class=\"content\">"._NICKNAME."<br>";
		$boxstuff .= "<input type=\"text\" name=\"username\" size=\"8\" maxlength=\"25\"><br>";
		$boxstuff .= ""._PASSWORD."<br>";
		$boxstuff .= "<input type=\"password\" name=\"user_password\" size=\"8\" maxlength=\"20\"><br>";
		if (extension_loaded("gd") AND ($gfx_chk == 2 OR $gfx_chk == 4 OR $gfx_chk == 5 OR $gfx_chk == 7)) {
			$boxstuff .= ""._SECURITYCODE.": <img src='?gfx=gfx&amp;random_num=$random_num' border='1' alt='"._SECURITYCODE."' title='"._SECURITYCODE."'><br>\n";
			$boxstuff .= ""._TYPESECCODE."<br><input type=\"text\" NAME=\"gfx_check\" SIZE=\"7\" MAXLENGTH=\"6\">\n";
			$boxstuff .= "<input type=\"hidden\" name=\"random_num\" value=\"$random_num\"><br>\n";
		} else {
			$boxstuff .= "<input type=\"hidden\" name=\"random_num\" value=\"$random_num\">";
			$boxstuff .= "<input type=\"hidden\" name=\"gfx_check\" value=\"$code\">";
		}
		$boxstuff .= "<input type=\"hidden\" name=\"op\" value=\"login\">";
		$boxstuff .= "<input type=\"submit\" value=\""._LOGIN."\"></font></center></form>";
		$boxstuff .= "<center><font class=\"content\">"._ASREGISTERED."</font></center>";
		themesidebox($title, $boxstuff);
	}
}

function userblock() {
  global $user, $cookie, $db, $user_prefix, $userinfo;
  if(is_user($user)) {
    getusrinfo($user);
    if($userinfo['ublockon']) {
      $sql = "SELECT ublock FROM ".$user_prefix."_users WHERE user_id='$cookie[0]'";
      $result = $db->sql_query($sql);
      $row = $db->sql_fetchrow($result);
      $ublock = intval($row['ublock']);
      $title = _MENUFOR." ".$cookie[1];
      themesidebox($title, $ublock);
    }
  }
}

function getTopics($s_sid) {
	global $topicid, $topicname, $topicimage, $topictext, $prefix, $db;
	$sid = intval($s_sid);
	$result = $db->sql_query("SELECT t.topicid, t.topicname, t.topicimage, t.topictext FROM ".$prefix."_stories s LEFT JOIN ".$prefix."_topics t ON t.topicid = s.topic WHERE s.sid = ".$sid);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	$topicid = intval($row['topicid']);
	$topicname = filter($row['topicname'], "nohtml");
	$topicimage = filter($row['topicimage'], "nohtml");
	$topictext = filter($row['topictext'], "nohtml");
}

function headlines($bid, $cenbox=0) {
	global $prefix, $db;
	$bid = intval($bid);
	$result = $db->sql_query("SELECT title, content, url, refresh, time FROM ".$prefix."_blocks WHERE bid='$bid'");
	$row = $db->sql_fetchrow($result);
	$title = filter($row['title'], "nohtml");
	$content = filter($row['content']);
	$url = filter($row['url'], "nohtml");
	$refresh = intval($row['refresh']);
	$otime = $row['time'];
	$past = time()-$refresh;
	$cont = 0;
	if ($otime < $past) {
		$btime = time();
		$rdf = parse_url($url);
		$fp = fsockopen($rdf['host'], 80, $errno, $errstr, 15);
		if (!$fp) {
			$content = "";
			$db->sql_query("UPDATE ".$prefix."_blocks SET content='$content', time='$btime' WHERE bid='$bid'");
			$cont = 0;
			if ($cenbox == 0) {
				themesidebox($title, $content);
			} else {
				themecenterbox($title, $content);
			}
			return;
		}
		if ($fp) {
			if (!empty($rdf['query']))
			$rdf['query'] = "?" . $rdf['query'];

			fputs($fp, "GET " . $rdf['path'] . $rdf['query'] . " HTTP/1.0\r\n");
			fputs($fp, "HOST: " . $rdf['host'] . "\r\n\r\n");
			$string	= "";
			while(!feof($fp)) {
				$pagetext = fgets($fp,300);
				$string .= chop($pagetext);
			}
			fputs($fp,"Connection: close\r\n\r\n");
			fclose($fp);
			$items = explode("</item>",$string);
			$content = "<font class=\"content\">";
			for ($i=0;$i<10;$i++) {
				$link = ereg_replace(".*<link>","",$items[$i]);
				$link = ereg_replace("</link>.*","",$link);
				$title2 = ereg_replace(".*<title>","",$items[$i]);
				$title2 = ereg_replace("</title>.*","",$title2);
				$title2 = stripslashes($title2);
				if (empty($items[$i]) AND $cont != 1) {
					$content = "";
					$db->sql_query("UPDATE ".$prefix."_blocks SET content='$content', time='$btime' WHERE bid='$bid'");
					$cont = 0;
					if ($cenbox == 0) {
						themesidebox($title, $content);
					} else {
						themecenterbox($title, $content);
					}
					return;
				} else {
					if (strcmp($link,$title2) AND !empty($items[$i])) {
						$cont = 1;
						$content .= "<strong><big>&middot;</big></strong><a href=\"$link\" target=\"new\">$title2</a><br>\n";
					}
				}
			}

		}
		$db->sql_query("UPDATE ".$prefix."_blocks SET content='$content', time='$btime' WHERE bid='$bid'");
	}
	$siteurl = str_replace("http://","",$url);
	$siteurl = explode("/",$siteurl);
	if (($cont == 1) OR (!empty($content))) {
		$content .= "<br><a href=\"http://$siteurl[0]\" target=\"blank\"><b>"._HREADMORE."</b></a></font>";
	} elseif (($cont == 0) OR (empty($content))) {
		$content = "<font class=\"content\">"._RSSPROBLEM."</font>";
	}
	if ($cenbox == 0) {
		themesidebox($title, $content);
	} else {
		themecenterbox($title, $content);
	}
}

function automated_news() {
	global $prefix, $multilingual, $currentlang, $db;
	if ($multilingual == 1) {
		$querylang = "WHERE (alanguage='$currentlang' OR alanguage='')";
	} else {
		$querylang = "";
	}
	$today = getdate();
	$day = $today['mday'];
	if ($day < 10) {
		$day = "0$day";
	}
	$month = $today['mon'];
	if ($month < 10) {
		$month = "0$month";
	}
	$year = $today['year'];
	$hour = $today['hours'];
	$min = $today['minutes'];
	$sec = "00";
	$result = $db->sql_query("SELECT anid, time FROM ".$prefix."_autonews $querylang");
	while ($row = $db->sql_fetchrow($result)) {
		$anid = intval($row['anid']);
		$time = $row['time'];
		ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $time, $date);
		if (($date[1] <= $year) AND ($date[2] <= $month) AND ($date[3] <= $day)) {
			if (($date[4] < $hour) AND ($date[5] >= $min) OR ($date[4] <= $hour) AND ($date[5] <= $min)) {
				$result2 = $db->sql_query("SELECT * FROM ".$prefix."_autonews WHERE anid='$anid'");
				while ($row2 = $db->sql_fetchrow($result2)) {
					$num = $db->sql_numrows($db->sql_query("SELECT sid FROM ".$prefix."_stories WHERE title='$row2[title]'"));
					if ($num == 0) {
						$title = $row2['title'];
						$hometext = filter($row2['hometext']);
						$bodytext = filter($row2['bodytext']);
						$notes = filter($row2['notes']);
						$catid2 = intval($row2['catid']);
						$aid2 = filter($row2['aid'], "nohtml");
						$time2 = $row2['time'];
						$topic2 = intval($row2['topic']);
						$informant2 = filter($row2['informant'], "nohtml");
						$ihome2 = intval($row2['ihome']);
						$alanguage2 = $row2['alanguage'];
						$acomm2 = intval($row2['acomm']);
						$associated2 = $row2['associated'];
						// Prepare and filter variables to be saved
						$hometext = filter($hometext, "", 1);
						$bodytext = filter($bodytext, "", 1);
						$notes = filter($notes, "", 1);
						$aid2 = filter($aid2, "nohtml", 1);
						$informant2 = filter($informant2, "nohtml", 1);
						$db->sql_query("DELETE FROM ".$prefix."_autonews WHERE anid='$anid'");
						$db->sql_query("INSERT INTO ".$prefix."_stories VALUES (NULL, '$catid2', '$aid2', '$title', '$time2', '$hometext', '$bodytext', '0', '0', '$topic2', '$informant2', '$notes', '$ihome2', '$alanguage2', '$acomm2', '0', '0', '0', '0', '0', '$associated2')");
					}
				}
				$db->sql_freeresult($result2);
			}
		}
	}
	$db->sql_freeresult($result);
}

if(!function_exists("themecenterbox")) {
function themecenterbox($title, $content) {
	OpenTable();
	echo "<center><font class=\"option\"><b>$title</b></font></center><br>".$content;
	CloseTable();
	echo "<br>";
  }
}

function public_message() {
	global $prefix, $user_prefix, $db, $user, $admin, $p_msg, $cookie, $broadcast_msg;
	if ($broadcast_msg == 1) {
		if (is_user($user)) {
			cookiedecode($user);
			$result = $db->sql_query("SELECT broadcast FROM ".$user_prefix."_users WHERE username='$cookie[1]'");
			$row = $db->sql_fetchrow($result);
			$upref = intval($row['broadcast']);
			if ($upref == 1) {
				$t_off = "<br><p align=\"right\">[ <a href=\"modules.php?name=Your_Account&amp;op=edithome\">";
				$t_off .= "<font size=\"2\">"._TURNOFFMSG."</font></a> ]";
				$pm_show = 1;
			} else {
				$pm_show = 0;
			}
		} else {
			$t_off = "";
		}
		if (!is_user($user) OR (is_user($user) AND ($pm_show == 1))) {
			$c_mid = base64_decode($p_msg);
			$c_mid = addslashes($c_mid);
			$c_mid = intval($c_mid);
			$result2 = $db->sql_query("SELECT mid, content, date, who FROM ".$prefix."_public_messages WHERE mid > '$c_mid' ORDER BY date ASC LIMIT 1");
			$row2 = $db->sql_fetchrow($result2);
			$mid = intval($row2['mid']);
			$content = filter($row2['content'], "nohtml");
			$tdate = $row2['date'];
			$who = filter($row2['who'], "nohtml");
			if ((!isset($c_mid)) OR ($c_mid = $mid)) {
				$public_msg = "<br><table width=\"90%\" border=\"1\" cellspacing=\"2\" cellpadding=\"0\" bgcolor=\"FFFFFF\" align=\"center\"><tr><td>\n";
				$public_msg .= "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\" bgcolor=\"FF0000\"><tr><td>\n";
				$public_msg .= "<font color=\"FFFFFF\" size=\"3\"><b>"._BROADCASTFROM." <a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$who\"><font color=\"FFFFFF\" size=\"3\">$who</font></a>: \"$content\"</b>";
				$public_msg .= "$t_off";
				$public_msg .= "</td></tr></table>";
				$public_msg .= "</td></tr></table>";
				$ref_date = $tdate+600;
				$actual_date = time();
				if ($actual_date >= $ref_date) {
					$public_msg = "";
					$numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_public_messages"));
					if ($numrows == 1) {
						$db->sql_query("DELETE FROM ".$prefix."_public_messages");
						$mid = 0;
					} else {
						$db->sql_query("DELETE FROM ".$prefix."_public_messages WHERE mid='$mid'");
					}
				}
				if ($mid == 0 OR empty($mid)) {
					setcookie("p_msg");
				} else {
					$mid = base64_encode($mid);
					$mid = addslashes($mid);
					setcookie("p_msg",$mid,time()+600);
				}
			}
		}
	} else {
		$public_msg = "";
	}
	if (empty($public_msg)) { $public_msg = ""; }
	return $public_msg;
}

function get_theme() {
    global $user, $userinfo, $Default_Theme, $name, $op;
    if (isset($ThemeSelSave)) return $ThemeSelSave;
    if (is_user($user) && ($name != "Your_Account" OR $op != "logout")) {
        getusrinfo($user);
        if(empty($userinfo['theme'])) $userinfo['theme']=$Default_Theme;
        if(file_exists("themes/".$userinfo['theme']."/theme.php")) {
            $ThemeSel = $userinfo['theme'];
        } else {
            $ThemeSel = $Default_Theme;
        }
    } else {
        $ThemeSel = $Default_Theme;
    }
    static $ThemeSelSave;
    $ThemeSelSave = $ThemeSel;
    return $ThemeSelSave;
}

function removecrlf($str) {
	// Function for Security Fix by Ulf Harnhammar, VSU Security 2002
	// Looks like I don't have so bad track record of security reports as Ulf believes
	// He decided to not contact me, but I'm always here, digging on the net
	return strtr($str, "\015\012", ' ');
}

function validate_mail($email) {
  if(strlen($email) < 7 || !eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$",$email)) {
     OpenTable();
     echo _ERRORINVEMAIL;
     CloseTable();
     die();
     } else {
     return $email;
     }
}

function paid() {
	global $db, $user, $cookie, $adminmail, $sitename, $nukeurl, $subscription_url, $user_prefix, $prefix;
	if (is_user($user)) {
		if (!empty($subscription_url)) {
			$renew = ""._SUBRENEW." $subscription_url";
		} else {
			$renew = "";
		}
		cookiedecode($user);
		$sql = "SELECT * FROM ".$prefix."_subscriptions WHERE userid='$cookie[0]'";
		$result = $db->sql_query($sql);
		$numrows = $db->sql_numrows($result);
		$row = $db->sql_fetchrow($result);
		if ($numrows == 0) {
			return 0;
		} elseif ($numrows != 0) {
			$time = time();
			if ($row['subscription_expire'] <= $time) {
				$db->sql_query("DELETE FROM ".$prefix."_subscriptions WHERE userid='$cookie[0]' AND id='".intval($row['id'])."'");
				$from = "$sitename <$adminmail>";
				$subject = "$sitename: "._SUBEXPIRED."";
				$body = ""._HELLO." $cookie[1]:\n\n"._SUBSCRIPTIONAT." $sitename "._HASEXPIRED."\n$renew\n\n"._HOPESERVED."\n\n$sitename "._TEAM."\n$nukeurl";
				$row = $db->sql_fetchrow($db->sql_query("SELECT user_email FROM ".$user_prefix."_users WHERE id='$cookie[0]' AND nickname='$cookie[1]' AND password='$cookie[2]'"));
				mail($row['user_email'], $subject, $body, "From: $from\nX-Mailer: PHP/" . phpversion());
			}
			return 1;
		}
	} else {
		return 0;
	}
}

function ads($position) {
	global $prefix, $db, $admin, $sitename, $adminmail, $nukeurl;
	$position = intval($position);
	if (paid()) {
		return;
	}
	$numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_banner WHERE position='$position' AND active='1'"));
	/* Get a random banner if exist any. */
	if ($numrows > 1) {
		$numrows = $numrows-1;
		mt_srand((double)microtime()*1000000);
		$bannum = mt_rand(0, $numrows);
	} else {
		$bannum = 0;
	}
	$sql = "SELECT bid, impmade, imageurl, clickurl, alttext FROM ".$prefix."_banner WHERE position='$position' AND active='1' LIMIT $bannum,1";
	$result = $db->sql_query($sql);
	list($bid, $impmade, $imageurl, $clickurl, $alttext) = $db->sql_fetchrow($result);
	$bid = intval($bid);
	$imageurl = filter($imageurl, "nohtml");
	$clickurl = filter($clickurl, "nohtml");
	$alttext = filter($alttext, "nohtml");
	$db->sql_query("UPDATE ".$prefix."_banner SET impmade=impmade+1 WHERE bid='$bid'");
	if($numrows > 0) {
		$sql2 = "SELECT cid, imptotal, impmade, clicks, date, ad_class, ad_code, ad_width, ad_height FROM ".$prefix."_banner WHERE bid='$bid'";
		$result2 = $db->sql_query($sql2);
		list($cid, $imptotal, $impmade, $clicks, $date, $ad_class, $ad_code, $ad_width, $ad_height) = $db->sql_fetchrow($result2);
		$cid = intval($cid);
		$imptotal = intval($imptotal);
		$impmade = intval($impmade);
		$clicks = intval($clicks);
		$ad_class = filter($ad_class, "nohtml");
		$ad_width = intval($ad_width);
		$ad_height = intval($ad_height);
		/* Check if this impression is the last one and print the banner */
		if (($imptotal <= $impmade) AND ($imptotal != 0)) {
			$db->sql_query("UPDATE ".$prefix."_banner SET active='0' WHERE bid='$bid'");
			$sql3 = "SELECT name, contact, email FROM ".$prefix."_banner_clients WHERE cid='$cid'";
			$result3 = $db->sql_query($sql3);
			list($c_name, $c_contact, $c_email) = $db->sql_fetchrow($result3);
			$c_name = filter($c_name, "nohtml");
			$c_contact = filter($c_contact, "nohtml");
			$c_email = filter($c_email, "nohtml");
			if (!empty($c_email)) {
				$from = "$sitename <$adminmail>";
				$to = "$c_contact <$c_email>";
				$message = _HELLO." $c_contact:\n\n";
				$message .= _THISISAUTOMATED."\n\n";
				$message .= _THERESULTS."\n\n";
				$message .= _TOTALIMPRESSIONS." $imptotal\n";
				$message .= _CLICKSRECEIVED." $clicks\n";
				$message .= _IMAGEURL." $imageurl\n";
				$message .= _CLICKURL." $clickurl\n";
				$message .= _ALTERNATETEXT." $alttext\n\n";
				$message .= _HOPEYOULIKED."\n\n";
				$message .= _THANKSUPPORT."\n\n";
				$message .= "- $sitename "._TEAM."\n";
				$message .= "$nukeurl";
				$subject = "$sitename: "._BANNERSFINNISHED."";
				mail($to, $subject, $message, "From: $from\nX-Mailer: PHP/" . phpversion());
			}
		}
		if ($ad_class == "code") {
			$ad_code = stripslashes(FixQuotes($ad_code));
			$ads = "<center>$ad_code</center>";
		} elseif ($ad_class == "flash") {
			$ads = "<center>
				<OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"
				codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0\"
				WIDTH=\"$ad_width\" HEIGHT=\"$ad_height\" id=\"$bid\">
				<PARAM NAME=movie VALUE=\"$imageurl\">
				<PARAM NAME=quality VALUE=high>
				<EMBED src=\"$imageurl\" quality=high WIDTH=\"$ad_width\" HEIGHT=\"$ad_height\"
				NAME=\"$bid\" ALIGN=\"\" TYPE=\"application/x-shockwave-flash\"
				PLUGINSPAGE=\"http://www.macromedia.com/go/getflashplayer\">
				</EMBED>
				</OBJECT>
				</center>";
		} else {
			$ads = "<center><a href=\"index.php?op=ad_click&amp;bid=$bid\" target=\"_blank\"><img src=\"$imageurl\" border=\"0\" alt=\"$alttext\" title=\"$alttext\"></a></center>";
		}
	} else {
		$ads = "";	
	}
	return $ads;
}

function redir($content) {
	global $nukeurl;
	unset($location);
	$content = filter($content);
	$links = array();
	$hrefs = array();
	$pos = 0;
	while (!(($pos = strpos($content,"<",$pos)) === false)) {
		$pos++;
		$endpos = strpos($content,">",$pos);
		$tag = substr($content,$pos,$endpos-$pos);
		$tag = trim($tag);
		if (isset($location)) {
			if (!strcasecmp(strtok($tag," "),"/A")) {
				$link = substr($content,$linkpos,$pos-1-$linkpos);
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
	for ($i=0; $i<sizeof($hrefs); $i++) {
		$url = urlencode($hrefs[$i]);
		$content = str_replace("<a href=\"$hrefs[$i]\">", "<a href=\"$nukeurl/index.php?url=$url\" target=\"_blank\">", $content);
	}
	return($content);
}

function info_box($graphic, $message) {
	// Function to generate a message box with a graphic inside
	// $graphic value can be whichever: warning, caution, tip, note.
	// Then the graphic value with the extension .gif should be present inside /images/system/ folder
	if (file_exists("images/system/".$graphic.".gif") AND !empty($message)) {
		Opentable();
		$graphic = filter($graphic, "nohtml");
		$message = filter($message, "");
		echo "<table align=\"center\" border=\"0\" width=\"80%\" cellpadding=\"10\"><tr>"
			."<td valign=\"top\"><img src=\"images/system/".$graphic.".gif\" border=\"0\" alt=\"\" title=\"\" width=\"34\" height=\"34\"></td>"
			."<td valign=\"top\">$message</td>"
			."</tr></table>";
		CloseTable();
	} else {
		return;
	}
}

if (isset($gfx)){
switch($gfx) {

	case "gfx":
	$datekey = date("F j");
	$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $random_num . $datekey));
	$code = substr($rcode, 2, 6);
	$ThemeSel = get_theme();
	if (file_exists("themes/".$ThemeSel."/images/code_bg.jpg")) {
		$image = ImageCreateFromJPEG("themes/".$ThemeSel."/images/code_bg.jpg");
	} else {
		$image = ImageCreateFromJPEG("images/code_bg.jpg");
	}
	$text_color = ImageColorAllocate($image, 80, 80, 80);
	Header("Content-type: image/jpeg");
	ImageString ($image, 5, 12, 2, $code, $text_color);
	ImageJPEG($image, '', 75);
	ImageDestroy($image);
	die();
	break;

	case "gfx_little":
	$datekey = date("F j");
	$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $random_num . $datekey));
	$code = substr($rcode, 2, 3);
	$ThemeSel = get_theme();
	if (file_exists("themes/".$ThemeSel."/images/code_bg_little.jpg")) {
		$image = ImageCreateFromJPEG("themes/".$ThemeSel."/images/code_bg_little.jpg");
	} else {
		$image = ImageCreateFromJPEG("images/code_bg_little.jpg");
	}
	$text_color = ImageColorAllocate($image, 80, 80, 80);
	Header("Content-type: image/jpeg");
	ImageString ($image, 5, 12, 2, $code, $text_color);
	ImageJPEG($image, '', 75);
	ImageDestroy($image);
	die();
	break;
   }
}

?>