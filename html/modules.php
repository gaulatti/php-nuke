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

define('MODULE_FILE', true);
require_once("mainfile.php");

if (isset($name) && $name == $_REQUEST['name']) {
  $name = addslashes(trim($name));
  $modstring = strtolower($_SERVER['QUERY_STRING']);
  if (stripos_clone($name, "..") OR ((stripos_clone($modstring,"&file=nickpage") || stripos_clone($modstring,"&user=")) AND ($name=="Private_Messages" OR $name=="Forums" OR $name=="Members_List"))) header("Location: index.php");
  global $nukeuser, $db, $prefix, $user;
  if (is_user($user)) {
    $nukeuser = base64_decode($user);
    $nukeuser = addslashes($nukeuser);
  } else {
    $nukeuser = "";
  }
  $result = $db->sql_query("SELECT active, view FROM ".$prefix."_modules WHERE title='".addslashes($name)."'");
  list($mod_active, $view) = $db->sql_fetchrow($result);
  $mod_active = intval($mod_active);
  $view = intval($view);
  if (($mod_active == 1) OR ($mod_active == 0 AND is_admin($admin))) {
    if (!isset($mop) OR $mop != $_REQUEST['mop']) $mop="modload";
    if (!isset($file) OR $file != $_REQUEST['file']) $file="index";
    if (stripos_clone($file,"..") OR stripos_clone($mop,"..")) die("You are so cool...");
    $ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/modules/$name/".$file.".php")) {
      $modpath = "themes/$ThemeSel/";
    } else {
      $modpath = "";
    }
    if ($view == 0) {
      $modpath .= "modules/$name/".$file.".php";
      if (file_exists($modpath)) {
        include($modpath);
      } else {
        include("header.php");
        OpenTable();
        echo "<br><center>Sorry, such file doesn't exist...</center><br>";
        CloseTable();
        include("footer.php");
      }
    } elseif ($view == 1 AND (is_user($user) OR is_group($user, $name)) OR is_admin($admin)) {
      $modpath .= "modules/$name/".$file.".php";
      if (file_exists($modpath)) {
        include($modpath);
      } else {
        include("header.php");
        OpenTable();
        echo "<br><center>Sorry, such file doesn't exist...</center><br>";
        CloseTable();
        include("footer.php");
      }
    } elseif ($view == 1 AND !is_user($user) AND !is_admin($admin)) {
      $pagetitle = "- "._ACCESSDENIED;
      include("header.php");
      title($sitename.": "._ACCESSDENIED);
      OpenTable();
      echo "<center><strong>"._RESTRICTEDAREA."</strong><br><br>"._MODULEUSERS;
      $result2 = $db->sql_query("SELECT mod_group FROM ".$prefix."_modules WHERE title='".addslashes($name)."'");
      list($mod_group) = $db->sql_fetchrow($result2);
      if ($mod_group != 0) {
        $result3 = $db->sql_query("SELECT name FROM ".$prefix."_groups WHERE id='".intval($mod_group)."'");
        $row3 = $db->sql_fetchrow($result3);
        echo _ADDITIONALYGRP.": <b>".$row3['name']."</b><br><br>";
      }
      echo _GOBACK;
      CloseTable();
      include("footer.php");
    } elseif ($view == 2 AND is_admin($admin)) {
      $modpath .= "modules/$name/".$file.".php";
      if (file_exists($modpath)) {
        include($modpath);
      } else {
        include("header.php");
        OpenTable();
        echo "<br><center>Sorry, such file doesn't exist...</center><br>";
        CloseTable();
        include("footer.php");
      }
    } elseif ($view == 2 AND !is_admin($admin)) {
      $pagetitle = "- "._ACCESSDENIED;
      include("header.php");
      title($sitename.": "._ACCESSDENIED);
      OpenTable();
      echo "<center><b>"._RESTRICTEDAREA."</b><br><br>"._MODULESADMINS.""._GOBACK;
      CloseTable();
      include("footer.php");
    } elseif ($view == 3 AND paid()) {
      $modpath .= "modules/$name/".$file.".php";
      if (file_exists($modpath)) {
        include($modpath);
      } else {
        include("header.php");
        OpenTable();
        echo "<br><center>Sorry, such file doesn't exist...</center><br>";
        CloseTable();
        include("footer.php");
      }
    } else {
      $pagetitle = "- "._ACCESSDENIED."";
      include("header.php");
      title($sitename.": "._ACCESSDENIED."");
      OpenTable();
      echo "<center><strong>"._RESTRICTEDAREA."</strong><br><br>"._MODULESSUBSCRIBER;
      if (!empty($subscription_url)) echo "<br>"._SUBHERE;
      echo "<br><br>"._GOBACK;
      CloseTable();
      include("footer.php");
    }
  } else {
    include("header.php");
    OpenTable();
    echo "<center>"._MODULENOTACTIVE."<br><br>"._GOBACK."</center>";
    CloseTable();
    include("footer.php");
  }
} else {
  header("Location: index.php");
  exit;
}

?>