<?php
// ----------------------------------------------------------------------
// Copyright (c) 2002-2006 Shawn McKenzie
// http://spidean.mckenzies.net
// ----------------------------------------------------------------------
// LICENSE
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
//
//
//
//
// ----------------------------------------------------------------------

$platformcmd['anonymous'] = array (
'user-links' => 'echo "<a href=\"modules.php?name=Your_Account&amp;op=new_user\">"._AT_NEWACCOUNT."</a> | '
  .'<a href=\"modules.php?name=Your_Account\">"._LOGIN."</a>";',
'user-login' => 'echo "<form action=\"modules.php?name=Your_Account\" method=\"post\">"'
  .'._NICKNAME."&nbsp;<input type=\"text\" name=\"username\" size=\"10\" maxlength=\"25\" />&nbsp;"'
  .'._PASSWORD."&nbsp;<input type=\"password\" name=\"user_password\" size=\"10\" maxlength=\"20\" />&nbsp;'
  .'<input type=\"hidden\" name=\"op\" value=\"login\" />";'
  .'$btn = "<input class=\"button\" type=\"submit\" value=\""._LOGIN."\" />\n";'
  .'if (file_exists($imagepath."login.gif")) {'
  .'   $btn = "<input type=\"image\" src=\"".$imagepath."login.gif\" value=\""._LOGIN."\" alt=\""._LOGIN."\" />\n"; }'
  .'elseif (file_exists($imagepath."login.jpg")) {'
  .'   $btn = "<input type=\"image\" src=\"".$imagepath."login.jpg\" value=\""._LOGIN."\" alt=\""._LOGIN."\" />\n"; }'
  .'elseif (file_exists($imagepath."login.png")) {'
  .'   $btn = "<input type=\"image\" src=\"".$imagepath."login.png\" value=\""._LOGIN."\" alt=\""._LOGIN."\" />\n"; }'
  .'echo $btn;'
  .'echo "</form>\n";',
);

$platformcmd['loggedin'] = array (
'user-links' => 'echo "<a href=\"modules.php?name=Your_Account\">"._AT_MYACCOUNT."</a> | '
  .'<a href=\"modules.php?name=Your_Account&amp;op=logout\">"._LOGOUT."</a>"; ',
);

$platformcmd['admin'] = array (
  'article-edit-del' => 'echo "[ <a href=admin.php?op=EditStory&amp;sid=$sid>Edit</a> | <a href=admin.php?op=RemoveStory&amp;sid=$sid>Delete</a> ]";',
);

$platformcmd['all'] = array (
'search' => 'echo "<form action=\"modules.php?name=Search\" method=\"post\">'
  .'<input type=\"text\" name=\"query\" size=\"15\" />&nbsp;";'
  .'$btn = "<input type=\"submit\" value=\"Search\" />\n";'
  .'if (file_exists($imagepath."search.gif")) {'
  .'   $btn = "<input type=\"image\" src=\"".$imagepath."search.gif\" value=\"Search\" />\n";}'
  .'elseif (file_exists($imagepath."search.jpg")) {'
  .'   $btn = "<input type=\"image\" src=\"".$imagepath."search.jpg\" value=\"Search\" />\n";}'
  .'elseif (file_exists($imagepath."search.png")) {'
  .'   $btn = "<input type=\"image\" src=\"".$imagepath."search.png\" value=\"Search\" />\n";}'
  .'echo $btn;'
  .'echo "</form>\n";',
  
'banners' => 'if($GLOBALS["banners"]) { include_once("banners.php"); }',
'site-slogan' => 'echo $GLOBALS["slogan"];',
'site-name' => 'echo $GLOBALS["sitename"];',
'time' => 'echo "<script type=\"text/javascript\">\n'
  .'var now = new Date();\n'
  .'var hours = now.getHours();\n'
  .'var minutes = now.getMinutes();\n'
  .'document.write(hours + \":\" + minutes);\n'
  .'</script>";',
'date' => 'echo "<script type=\"text/javascript\">\n'
  .'var monthNames = new Array( \""._JANUARY."\",\""._FEBRUARY."\",\""._MARCH."\",\""._APRIL."\",\""._MAY."\",\""._JUNE."\",\""._JULY."\",\""._AUGUST."\",\""._SEPTEMBER."\",\""._OCTOBER."\",\""._NOVEMBER."\",\""._DECEMBER."\");\n'
  .'var now = new Date();\n'
  .'thisYear = now.getYear();\n'
  .'if(thisYear < 1900) {thisYear += 1900};\n'
  .'document.write(monthNames[now.getMonth()] + \" \" + now.getDate() + \", \" + thisYear);\n'
  .'</script>";',
'admin-messages' => 'if (atIsHomePage()) { message_box(); }',
'public-messages' => 'if(function_exists("public_message")) { public_message(); }',
'up-blocks' => 'atBlockDisplay("c");',
'down-blocks' => 'atBlockDisplay("d");',
'topic' => 'echo $topictext;',
'title' => 'echo $title;',
'posted-by' => 'if($informant) { echo _POSTEDBY." $informant";'
  .'} else { echo _POSTEDBY." $anonymous"; }',
'posted-date-time' => 'echo _ON." $datetime $timezone";',
'topic-image' => 'if(file_exists($imagepath."topics/$topicimage")) { $topicpath = $themepath; }'
  .'echo "<a href=\"modules.php?name=News&amp;new_topic=$topic\"><img src=\"".$topicpath."images/topics/$topicimage\" border=\"0\" alt=\"$topictext\" /></a>";',
'article-text' => 'echo $bodytext;',
'article-notes' => 'if($notes) { echo _NOTE." ".$notes; }',
'article-more' => 'echo $morelink;',
'article-reads' => 'echo $counter." "._READS;',
'cat-title' => 'echo $title;',
'article-summary' => 'echo $hometext;',
'article-full' => 'echo $bodytext;',
);

$platformcmd['all']['config:slogan'] = 'echo $GLOBALS["slogan"];';
$platformcmd['all']['config:sitename'] = 'echo $GLOBALS["sitename"];';
$platformcmd['all']['page:title'] = 'echo $GLOBALS["sitename"]." ".$GLOBALS["pagetitle"];';
$platformcmd['all']['page:description'] = 'echo $GLOBALS["pagetitle"];';
$platformcmd['all']['page:keywords'] = 'echo "PHP-Nuke, AutoTheme";';

?>
