<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2007 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Google Page Rank Calculation                                         */
/* Copyright 2004 by GoogleCommunity.com                                */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

// This system includes Google Page Rank Calculation made by GoogleCommunity.com
// Don't abuse this script. It's here for your use, to give accurate information
// about your site to your potential advertising customers. If you need the complete
// Google Page Rank Calculator script, please go to: http://www.GoogleCommunity.com
// and download the latest and stand alone release.

if (!defined('MODULE_FILE')) {
    die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

function is_client($client) {
	global $prefix, $db;
	if(!is_array($client)) {
		$client = base64_decode($client);
		$client = addslashes($client);
		$client = explode(":", $client);
		$cid = "$client[0]";
		if (isset($client[2])) { $pwd = $client[2]; }
	} else {
		$cid = "$client[0]";
		if (isset($client[2])) { $pwd = $client[2]; }
	}
	if (!empty($cid) AND !empty($pwd)) {
		$result = $db->sql_query("SELECT passwd FROM ".$prefix."_banner_clients WHERE cid='$cid'");
		$row = $db->sql_fetchrow($result);
		$pass = $row['passwd'];
		if(!empty($pass) AND $pass == $pwd) {
			return 1;
		}
	}
	return 0;
}

function themenu() {
	global $module_name, $prefix, $db, $client, $op;
	echo "<br>";
	if (is_client($client)) {
		if ($op == "client_home") {
			$client_opt = _MYADS;
		} else {
			$client_opt = "<a href=\"modules.php?name=$module_name&op=client_home\">"._MYADS."</a>";
		}
	} else {
		$client_opt = "<a href=\"modules.php?name=$module_name&op=client\">"._CLIENTLOGIN."</a>";
	}
	OpenTable();
	echo "<center><b>"._ADSMENU."</b><br><br>[ <a href=\"modules.php?name=$module_name\">"._MAINPAGE."</a> | <a href=\"modules.php?name=$module_name&op=sitestats\">"._SITESTATS."</a> | <a href=\"modules.php?name=$module_name&op=terms\">"._TERMS."</a> | <a href=\"modules.php?name=$module_name&op=plans\">"._PLANSPRICES."</a> | $client_opt ]</center>";
	CloseTable();
}

function theindex() {
    global $prefix, $db, $sitename;
    include("header.php");
    title("$sitename "._ADVERTISING."");
    OpenTable();
    echo ""._WELCOMEADS."";  
    CloseTable();
    themenu();
    include("footer.php");
}

function sitestats() {
    global $module_name, $prefix, $db, $user_prefix, $nukeurl, $sitename;
	$url = $nukeurl;	
    $result = $db->sql_query("SELECT hits FROM ".$prefix."_stats_year WHERE hits!='0'");
    $hits = 0;
    $a = 0;
    while ($row = $db->sql_fetchrow($result)) {
    	$hits = $hits+$row['hits'];
    	$a++;
    }
    $views_y = $hits/$a;
    $result = $db->sql_query("SELECT hits FROM ".$prefix."_stats_month WHERE hits!='0'");
    $hits = 0;
    $a = 0;
    while ($row = $db->sql_fetchrow($result)) {
    	$hits = $hits+$row['hits'];
    	$a++;
    }
    $views_m = $hits/$a;
    $result = $db->sql_query("SELECT hits FROM ".$prefix."_stats_date WHERE hits!='0'");
    $hits = 0;
    $a = 0;
    while ($row = $db->sql_fetchrow($result)) {
    	$hits = $hits+$row['hits'];
    	$a++;
    }
    $views_d = $hits/$a;
	$result = $db->sql_query("SELECT hits FROM ".$prefix."_stats_hour WHERE hits!='0'");
	$hits = 0;
    $a = 0;
    while ($row = $db->sql_fetchrow($result)) {
    	$hits = $hits+$row['hits'];
    	$a++;
    }
    $views_h = $hits/$a;
    $views_y = round($views_y);
    $views_m = round($views_m);
    $views_d = round($views_d);
    $views_h = round($views_h);
    $row = $db->sql_fetchrow($db->sql_query("SELECT count FROM ".$prefix."_counter WHERE type='total'"));
    $views_t = $row['count'];
	$regusers = $db->sql_numrows($db->sql_query("SELECT user_id FROM ".$user_prefix."_users"));
    include("header.php");
    title("$sitename: "._GENERALSTATS."");
    OpenTable();
    echo ""._HEREARENUMBERS."<br><br><br>"
    	."<li>"._TOTALVIEWS." <b>$views_t</b><br><br>"
    	."<li>"._VIEWSYEAR." <b>$views_y</b><br><br>"
		."<li>"._VIEWSMONTH." <b>$views_m</b><br><br>"
		."<li>"._VIEWSDAY." <b>$views_d</b><br><br>"
		."<li>"._VIEWSHOUR." <b>$views_h</b><br><br>"
		."<li>"._CURREGUSERS." <b>$regusers</b><br><br>";
	if ($url != "http://--------.---") {
		echo "<li>"._GOOGLERANK." <b>".getrank($url)."</b><br><br>";
	}
    CloseTable();
    themenu();
    include("footer.php");
}

function plans() {
    global $module_name, $prefix, $db, $bgcolor2, $sitename;
    include("header.php");
    title("$sitename: "._PLANSPRICES."");
    OpenTable();
    $numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_banner_plans WHERE active='1'"));
    if ($numrows > 0) {
    	$result = $db->sql_query("SELECT * FROM ".$prefix."_banner_plans WHERE active='1'");
    	echo ""._LISTPLANS."<br><br>";
    	echo "<table border=\"1\" width=\"100%\" cellpadding=\"3\">";
    	echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><b>"._PLANNAME."</b></td><td bgcolor=\"$bgcolor2\">&nbsp;<b>"._DESCRIPTION."</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._QUANTITY."</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._PRICE."</b></td><td align=\"center\" bgcolor=\"$bgcolor2\" nowrap><b>"._BUYLINKS."</b></td></tr>";
    	while ($row = $db->sql_fetchrow($result)) {
	    	if ($row['delivery_type'] == "0") {
	    		$delivery = _IMPRESSIONS;
	    	} elseif ($row['delivery_type'] == "1") {
	    		$delivery = _CLICKS;
	    	} elseif ($row['delivery_type'] == "2") {
	    		$delivery = _DAYS;
	    	} elseif ($row['delivery_type'] == "3") {
	    		$delivery = _MONTHS;
	    	} elseif ($row['delivery_type'] == "4") {
	    		$delivery = _YEARS;
	    	}
    		echo "<tr><td valign=\"top\"><b>".$row['name']."</b></td><td>".$row['description']."</td><td valign=\"bottom\"><center>".$row['delivery']."<br>$delivery</center></td><td valign=\"bottom\">".$row['price']."</td><td valign=\"bottom\" nowrap><center>".$row['buy_links']."</center></td></tr>";
    	}
    	echo "</table>";
	} else {
		echo "<center>"._ADSNOCONTENT."<br><br>"._GOBACK."</center>";
	}
    CloseTable();
    themenu();
    include("footer.php");
}

function terms() {
	global $module_name, $prefix, $db, $sitename;
    $today = getdate();
	$month = $today['mon'];
	if ($month == 1) {$month = _JANUARY;} elseif ($month == 2) {$month = _FEBRUARY;} elseif ($month == 3) {$month = _MARCH;} elseif ($month == 4) {$month = _APRIL;} elseif ($month == 5) {$month = _MAY;} elseif ($month == 6) {$month = _JUNE;} elseif ($month == 7) {$month = _JULY;} elseif ($month == 8) {$month = _AUGUST;} elseif ($month == 9) {$month = _SEPTEMBER;} elseif ($month == 10) {$month = _OCTOBER;} elseif ($month == 11) {$month = _NOVEMBER;} elseif ($month == 12) {$month = _DECEMBER;}
	$year = $today['year'];
    include("header.php");
    title("$sitename: "._TERMSCONDITIONS."");
    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_terms"));
    $terms = eregi_replace("\[sitename\]", $sitename, $row['terms_body']);
	$terms = eregi_replace("\[country\]", $row['country'], $terms);
    OpenTable();
    echo "<center><font class='title'><b>$sitename: "._TERMSCONDITIONS."</b></font></center><br><br>"
		."$terms"
		."<p align='right'>".$row['country'].", $month $year</p>";
    CloseTable();
    themenu();
    include("footer.php");
}

function client() {
	global $module_name, $prefix, $db, $sitename, $client;
	if (is_client($client)) {
		Header("Location: modules.php?name=$module_name&op=client_home");
	} else {
		include("header.php");
		title("$sitename: "._ADSYSTEM."");
		OpenTable();
		echo "<center><font class=\"title\"><b>"._CLIENTLOGIN."</b></font></center><br>";
		echo "<form method=\"POST\" action=\"modules.php?name=$module_name\"><table border=\"0\" align=\"center\" cellpadding=\"3\"><tr>";
		echo "<td align=\"right\">"._LOGIN.":</td><td><input type=\"text\" name=\"login\" size=\"15\"></td></tr>";
		echo "<td align=\"right\">"._PASSWORD.":</td><td><input type=\"password\" name=\"pass\" size=\"15\"></td></tr>";
		echo "<td>&nbsp;</td><td><input type=\"hidden\" name=\"op\" value=\"client_valid\"><input type=\"submit\" value=\""._ENTER."\"></tr></td></table></form>";
		CloseTable();
		themenu();
		include("footer.php");
	}
}

function zeroFill($a, $b) {
    $z = hexdec(80000000);
	if ($z & $a) {
    	$a = ($a>>1);
        $a &= (~$z);
        $a |= 0x40000000;
        $a = ($a>>($b-1));
    } else {
        $a = ($a>>$b);
    }
    return $a;
}

function mix($a,$b,$c) {
  $a -= $b; $a -= $c; $a ^= (zeroFill($c,13));
  $b -= $c; $b -= $a; $b ^= ($a<<8);
  $c -= $a; $c -= $b; $c ^= (zeroFill($b,13));
  $a -= $b; $a -= $c; $a ^= (zeroFill($c,12));
  $b -= $c; $b -= $a; $b ^= ($a<<16);
  $c -= $a; $c -= $b; $c ^= (zeroFill($b,5));
  $a -= $b; $a -= $c; $a ^= (zeroFill($c,3));   
  $b -= $c; $b -= $a; $b ^= ($a<<10);
  $c -= $a; $c -= $b; $c ^= (zeroFill($b,15));
  return array($a,$b,$c);
}

function GoogleCH($url, $length=null, $init=GOOGLE_MAGIC) {
    if(is_null($length)) {
        $length = sizeof($url);
    }
    $a = $b = 0x9E3779B9;
    $c = $init;
    $k = 0;
    $len = $length;
    while($len >= 12) {
        $a += ($url[$k+0] +($url[$k+1]<<8) +($url[$k+2]<<16) +($url[$k+3]<<24));
        $b += ($url[$k+4] +($url[$k+5]<<8) +($url[$k+6]<<16) +($url[$k+7]<<24));
        $c += ($url[$k+8] +($url[$k+9]<<8) +($url[$k+10]<<16)+($url[$k+11]<<24));
        $mix = mix($a,$b,$c);
        $a = $mix[0]; $b = $mix[1]; $c = $mix[2];
        $k += 12;
        $len -= 12;
    }
    $c += $length;
    switch($len) {
        case 11: $c+=($url[$k+10]<<24);
        case 10: $c+=($url[$k+9]<<16);
        case 9 : $c+=($url[$k+8]<<8);
        case 8 : $b+=($url[$k+7]<<24);
        case 7 : $b+=($url[$k+6]<<16);
        case 6 : $b+=($url[$k+5]<<8);
        case 5 : $b+=($url[$k+4]);
        case 4 : $a+=($url[$k+3]<<24);
        case 3 : $a+=($url[$k+2]<<16);
        case 2 : $a+=($url[$k+1]<<8);
        case 1 : $a+=($url[$k+0]);
    }
    $mix = mix($a,$b,$c);
    return $mix[2];
}

function strord($string) {
    for($i=0;$i<strlen($string);$i++) {
        $result[$i] = ord($string{$i});
    }
    return $result;
}

function getrank($url) {
	define('GOOGLE_MAGIC', 0xE6359A60);
    $url = 'info:'.$url;
    $ch = GoogleCH(strord($url));
    $file = "http://www.google.com/search?client=navclient-auto&ch=6$ch&features=Rank&q=$url";
    $data = file($file);
    $rankarray = explode (':', $data[2]);
    $rank = $rankarray[2];
    return $rank;
}

function client_logout() {
	global $module_name;
	$client = "";
	setcookie("client");
	Header("Location: modules.php?name=$module_name&op=client");
	die();
}

function client_valid($login, $pass) {
	global $prefix, $db, $module_name, $sitename;
	$login = filter($login, "nohtml");
	$pass = filter($pass, "nohtml");
	$numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_banner_clients WHERE login='$login' AND passwd='$pass'"));
	if ($numrows != 1) {
		include("header.php");
		title("$sitename: "._ADSYSTEM."");
		OpenTable();
		echo "<center>"._LOGININCORRECT."<br><br>"._GOBACK."</center>";
		CloseTable();
		themenu();
		include("footer.php");
		die();
	} else {
		$row = $db->sql_fetchrow($db->sql_query("SELECT cid FROM ".$prefix."_banner_clients WHERE login='$login' AND passwd='$pass'"));
		$cid = $row['cid'];
		$info = base64_encode("$cid:$login:$pass");
		setcookie("client","$info",time()+86400);
		Header("Location: modules.php?name=$module_name&op=client_home");
	}
}

function client_home() {
	global $prefix, $db, $sitename, $bgcolor2, $module_name, $client;
	if (!is_client($client)) {
		Header("Location: modules.php?name=$module_name&op=client");
		die();
	} else {
		$client = base64_decode($client);
		$client = addslashes($client);
		$client = explode(":", $client);
		$cid = $client[0];
		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_clients WHERE cid='$cid'"));
		include("header.php");
		title("$sitename "._ADSYSTEM."");
		OpenTable();
		echo "<center>"._ACTIVEADSFOR." ".$row['name']."</center><br>"
   			."<table width=\"100%\" border=\"1\"><tr>"
   			."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._NAME."</b></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._IMPMADE."</b></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._IMPTOTAL."</b></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._IMPLEFT."</b></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._CLICKS."</b></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>% "._CLICKS."</b></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._TYPE."</b></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._FUNCTIONS."</b></td><tr>";
		$sql = "SELECT * FROM ".$prefix."_banner WHERE cid='".$row['cid']."' AND active='1'";
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result)) {
			$bid = $row['bid'];
			$bid = intval($bid);
			$imptotal = $row['imptotal'];
			$imptotal = intval($imptotal);
			$impmade = $row['impmade'];
			$impmade = intval($impmade);
			$clicks = $row['clicks'];
			$clicks = intval($clicks);
			$date = $row['date'];
			if ($impmade == 0) {
				$percent = 0;
			} else {
				$percent = substr(100 * $clicks / $impmade, 0, 5);
				$percent = "$percent%";
			}
			if ($imptotal == 0) {
				$left = _UNLIMITED;
				$imptotal = _UNLIMITED;
			} else {
				$left = $imptotal-$impmade;
			}
			if ($row['ad_class'] == "flash" || $row['ad_class'] == "code") {
				$clicks = "N/A";
				$percent = "N/A";
			}
			if ($row['name'] == "") {
				$row['name'] = _NONE;
			}
			echo "<td align=\"center\">".$row['name']."</td>"
				."<td align=\"center\">$impmade</td>"
				."<td align=\"center\">$imptotal</td>"
				."<td align=\"center\">$left</td>"
				."<td align=\"center\">$clicks</td>"
				."<td align=\"center\">$percent</td>"
				."<td align=\"center\">".ucFirst($row['ad_class'])."</td>"
				."<td align=\"center\"><a href=\"modules.php?name=$module_name&op=client_report&cid=$cid&bid=$bid\"><img src=\"images/edit.gif\" border=\"0\" alt=\""._EMAILSTATS."\" title=\""._EMAILSTATS."\"></a>  <a href=\"modules.php?name=$module_name&op=view_banner&cid=$cid&bid=$bid\"><img src=\"images/view.gif\" border=\"0\" alt=\""._VIEWBANNER."\" title=\""._VIEWBANNER."\"></a></td><tr>";
		}
		echo "</table>";
		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_clients WHERE cid='$cid'"));
		echo "<br><br><center>"._INACTIVEADS." ".$row['name']."</center><br>"
    		."<table width=\"100%\" border=\"1\"><tr>"
    		."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._NAME."</b></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._IMPMADE."</b></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._IMPTOTAL."</b></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._IMPLEFT."</b></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._CLICKS."</b></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>% "._CLICKS."</b></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._TYPE."</b></td>"
			."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._FUNCTIONS."</b></td><tr>";
		$sql = "SELECT * FROM ".$prefix."_banner WHERE cid='".$row['cid']."' AND active='0'";
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result)) {
			$bid = $row['bid'];
			$bid = intval($bid);
			$imptotal = $row['imptotal'];
			$imptotal = intval($imptotal);
			$impmade = $row['impmade'];
			$impmade = intval($impmade);
			$clicks = $row['clicks'];
			$clicks = intval($clicks);
			$date = $row['date'];
			if($impmade == 0) {
				$percent = 0;
			} else {
				$percent = substr(100 * $clicks / $impmade, 0, 5);
				$percent = "$percent%";
			}
			if($imptotal == 0) {
			$left = _UNLIMITED;
				$imptotal = _UNLIMITED;
			} else {
				$left = $imptotal-$impmade;
			}
			if ($row['ad_class'] == "flash" || $row['ad_class'] == "code") {
				$clicks = "N/A";
				$percent = "N/A";
			}
			if ($row['name'] == "") {
				$row['name'] = _NONE;
			}
			echo "<td align=\"center\">".$row['name']."</td>"
				."<td align=\"center\">$impmade</td>"
				."<td align=\"center\">$imptotal</td>"
				."<td align=\"center\">$left</td>"
				."<td align=\"center\">$clicks</td>"
				."<td align=\"center\">$percent</td>"
				."<td align=\"center\">".ucFirst($row['ad_class'])."</td>"
				."<td align=\"center\"><a href=\"modules.php?name=$module_name&op=client_report&cid=$cid&bid=$bid\"><img src=\"images/edit.gif\" border=\"0\" alt=\""._EMAILSTATS."\" title=\""._EMAILSTATS."\"></a>  <a href=\"modules.php?name=$module_name&op=view_banner&cid=$cid&bid=$bid\"><img src=\"images/view.gif\" border=\"0\" alt=\""._VIEWBANNER."\" title=\""._VIEWBANNER."\"></a></td><tr>";
			$a = 1;
		}
		if ($a != 1) {
			echo "<td align=\"center\" colspan=\"8\"><i>"._NOCONTENT."</i></td></tr>";
		}
		echo "</table><br><br><center>[ <a href=\"modules.php?name=$module_name&op=client_logout\">"._LOGOUT."</a> ]</center>";
		CloseTable();
		themenu();
		include("footer.php");
	}
}

function view_banner($cid, $bid) {
	global $prefix, $db, $module_name, $client, $bgcolor2, $sitename;
	if (!is_client($client)) {
		Header("Location: modules.php?name=$module_name&op=client");
		die();
	} else {
		$client = base64_decode($client);
		$client = addslashes($client);
		$client = explode(":", $client);
		$client_id = $client[0];
		if ($cid != $client_id) {
			include("header.php");
			title("$sitename "._ADSYSTEM."");
			OpenTable();
			echo "<center>"._ADISNTYOUR."<br><br>"._GOBACK."</center>";
			CloseTable();
			themenu();
			include("footer.php");
			die();
		} else {
			include("header.php");
			title("$sitename "._ADSYSTEM."");
			OpenTable();
			$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner WHERE bid='$bid'"));	
			$cid = intval($row['cid']);
			$imptotal = intval($row['imptotal']);
			$impmade = intval($row['impmade']);
			$clicks = intval($row['clicks']);
			$imageurl = $row['imageurl'];
			$clickurl = $row['clickurl'];
			$ad_class = $row['ad_class'];
			$ad_code = $row['ad_code'];
			$ad_width = $row['ad_width'];
			$ad_height = $row['ad_height'];
			$alttext = $row['alttext'];
			echo "<center><font class=\"title\"><b>" . _YOURBANNER . ": ".$row['name']."</b></font><br><br>";
			if ($ad_class == "code") {
				$ad_code = stripslashes(FixQuotes($ad_code));
				echo "<table border=\"0\" align=\"center\"><tr><td>$ad_code</td></tr></table><br><br>";
			} elseif ($ad_class == "flash") {
				echo "<center>
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
					</center><br><br>";
			} else {
				echo "<center><img src=\"$imageurl\" border=\"1\" alt=\"$alttext\" title=\"$alttext\" width=\"$ad_width\" height=\"$ad_height\"></center><br><br>";
			}
			echo "<center>Banner Information: ".$row['name']."</center><br>"
	   			."<table width=\"100%\" border=\"1\"><tr>"
	   			."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._NAME."</b></td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._IMPMADE."</b></td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._IMPTOTAL."</b></td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._IMPLEFT."</b></td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._CLICKS."</b></td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>% "._CLICKS."</b></td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>"._TYPE."</b></td><tr>";
			$bid = $row['bid'];
			$bid = intval($bid);
			$imptotal = $row['imptotal'];
			$imptotal = intval($imptotal);
			$impmade = $row['impmade'];
			$impmade = intval($impmade);
			$clicks = $row['clicks'];
			$clicks = intval($clicks);
			$date = $row['date'];
			if ($impmade == 0) {
				$percent = 0;
			} else {
				$percent = substr(100 * $clicks / $impmade, 0, 5);
				$percent = "$percent%";
			}
			if ($imptotal == 0) {
				$left = _UNLIMITED;
				$imptotal = _UNLIMITED;
			} else {
				$left = $imptotal-$impmade;
			}
			if ($row['ad_class'] == "flash" || $row['ad_class'] == "code") {
				$clicks = "N/A";
				$percent = "N/A";
			}
			if ($row['name'] == "") {
				$row['name'] = _NONE;
			}
			if ($row['active'] == 1) {
				$status = _ACTIVE;
			} elseif ($row['active'] == 0) {
				$status = _INACTIVE;
			}
			echo "<td align=\"center\">".$row['name']."</td>"
				."<td align=\"center\">$impmade</td>"
				."<td align=\"center\">$imptotal</td>"
				."<td align=\"center\">$left</td>"
				."<td align=\"center\">$clicks</td>"
				."<td align=\"center\">$percent</td>"
				."<td align=\"center\">".ucFirst($row['ad_class'])."</td></tr><tr>"
				."<td align=\"center\" colspan=\"7\">"._CURRENTSTATUS." $status</td></tr>"
				."</table><br><br>"
				."[ <a href=\"modules.php?name=$module_name&op=client_report&cid=$cid&bid=$bid\">"._EMAILSTATS."</a> | <a href=\"modules.php?name=$module_name&op=logout\">"._LOGOUT."</a> ]";
			CloseTable();
			themenu();
			include("footer.php");
		}
	}
}

function client_report($cid, $bid) {
	global $prefix, $db, $module_name, $client, $sitename;
	if (!is_client($client)) {
		Header("Location: modules.php?name=$module_name&op=client");
		die();
	} else {
		$client = base64_decode($client);
		$client = addslashes($client);
		$client = explode(":", $client);
		$client_id = $client[0];
		if ($cid != $client_id) {
			include("header.php");
			title("$sitename: "._ADSYSTEM."");
			OpenTable();
			echo "<center>"._FUNCTIONSNOTALLOWED."<br><br>"._GOBACK."</center>";
			CloseTable();
			themenu();
			include("footer.php");
			die();
		} else {
			include("header.php");
			title("$sitename: "._ADSYSTEM."");
			OpenTable();
			$bid = intval($bid);
			$cid = intval($cid);
			$sql = "SELECT name, email FROM ".$prefix."_banner_clients WHERE cid='$cid'";
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$name = htmlentities($row['name']);
			$email = $row['email'];
			if ($email == "") {
				echo "<center><br><br>"
					."<b>"._STATSNOTSEND."</b><br><br>"
					."<a href=\"javascript:history.go(-1)\">"._GOBACK."</a>";
				CloseTable();
				themenu();
				include("footer.php");
				die();
			} else {
				$sql2 = "SELECT bid, name, imptotal, impmade, clicks, imageurl, clickurl, date, ad_class FROM ".$prefix."_banner WHERE bid='$bid' AND cid='$cid'";
				$result2 = $db->sql_query($sql2);
				$row2 = $db->sql_fetchrow($result2);
				$bid = $row2['bid'];
				$bid = intval($bid);
				$imptotal = $row2['imptotal'];
				$imptotal = intval($imptotal);
				$impmade = $row2['impmade'];
				$impmade = intval($impmade);
				$clicks = $row2['clicks'];
				$clicks = intval($clicks);
				$imageurl = $row2['imageurl'];
				$clickurl = $row2['clickurl'];
				$date = $row2['date'];
				if($impmade==0) {
					$percent = 0;
				} else {
					$percent = substr(100 * $clicks / $impmade, 0, 5);
				}
				if($imptotal==0) {
					$left = _UNLIMITED;
					$imptotal = _UNLIMITED;
				} else {
					$left = $imptotal-$impmade;
				}
				$fecha = date("F jS Y, h:iA.");
				$subject = ""._YOURSTATS." $sitename";
				if (empty($row2['ad_class']) || $row2['ad_class'] == "image") {
					$message = ""._FOLLOWINGSTATS." $sitename:\n\n\n"._CLIENTNAME.": $name\n"._BANNERID.": $bid\n"._BANNERNAME.": ".$row['name']."\n"._BANNERIMAGE.": $imageurl\n"._BANNERURL.": $clickurl\n\n"._IMPPURCHASED.": $imptotal\n"._IMPREMADE.": $impmade\n"._IMPRELEFT.": $left\n"._RECEIVEDCLICKS.": $clicks\n"._CLICKSPERCENT.": $percent%\n\n\n"._GENERATEDON.": $fecha";
				} elseif ($row2['ad_class'] == "flash") {
					$message = ""._FOLLOWINGSTATS." $sitename:\n\n\n"._CLIENTNAME.": $name\n"._BANNERID.": $bid\n"._BANNERNAME.": ".$row['name']."\n"._FLASHMOVIE.": $imageurl\n\n"._IMPPURCHASED.": $imptotal\n"._IMPREMADE.": $impmade\n"._IMPRELEFT.": $left\n"._RECEIVEDCLICKS.": N/A\n"._CLICKSPERCENT.": N/A\n\n\n"._GENERATEDON.": $fecha";
				} elseif ($row2['ad_class'] == "code") {
					$message = ""._FOLLOWINGSTATS." $sitename:\n\n\n"._CLIENTNAME.": $name\n"._BANNERID.": $bid\n"._BANNERNAME.": ".$row['name']."\n\n"._IMPPURCHASED.": $imptotal\n"._IMPREMADE.": $impmade\n"._IMPRELEFT.": $left\n"._RECEIVEDCLICKS.": N/A\n"._CLICKSPERCENT.": N/A\n\n\n"._GENERATEDON.": $fecha";
				}
				$from = "$sitename";
				mail($email, $subject, $message, "From: $from\nX-Mailer: PHP/" . phpversion());
				echo "<center><br><br><br>"
					."<b>"._STATSSENT." $email</b><br><br>"
					."[ <a href=\"javascript:history.go(-1)\">"._GOBACK."</a> ]";
				CloseTable();
				themenu();
				include("footer.php");
			}
		}
	}
}

switch ($op) {

    default:
    theindex();
    break;

    case "sitestats":
    sitestats();
    break;

    case "plans":
    plans();
    break;

    case "terms":
    terms();
    break;

	case "client":
	client();
	break;
	
	case "client_home":
	client_home();
	break;
	
	case "client_valid":
	client_valid($login, $pass);
	break;
	
	case "client_logout":
	client_logout();
	break;
	
	case "client_report":
	client_report($cid, $bid);
	break;
	
	case "view_banner":
	view_banner($cid, $bid);
	break;

}

?>