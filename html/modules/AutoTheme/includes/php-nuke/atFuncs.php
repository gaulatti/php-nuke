<?php
// ----------------------------------------------------------------------
// Copyright (c) 2002-2006 Shawn McKenzie
// http://spidean.mckenzies.net
// ----------------------------------------------------------------------
//
//
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
// ----------------------------------------------------------------------

function themeheader()
{
    atThemeHeader();
}

function themefooter()
{
    atThemeFooter();
}

function themeindex($aid, $informant, $datetime, $title, $counter, $topic, $hometext, $notes, $morelink, $topicname, $topicimage, $topictext)
{
    $sid = $GLOBALS['sid'];
    $vars = compact("sid", "aid", "informant", "datetime", "title", "counter", "topic", "hometext", "notes", "morelink", "topicname", "topicimage", "topictext");
    list($preformat, $info, $links) = themeformatnews($vars);

    atRunningMultiSetVars($vars);
    
    atNewsSummary($info, $links, $preformat);
}

function themearticle($aid, $informant, $datetime, $title, $bodytext, $topic, $topicname, $topicimage, $topictext)
{
    $sid = $GLOBALS['sid'];
    $vars = compact("sid", "aid", "informant", "datetime", "title", "bodytext", "topic", "topicname", "topicimage", "topictext");
    list($preformat, $info, $links) = themeformatnews($vars);

    atRunningMultiSetVars($vars);

    atNewsArticle($info, $links, $preformat);
}

function themesidebox($title, $content)
{
    $block = atRunningGetVar("block");
    $block['title'] = $title;
    $block['content'] = $content;

    if ($block['position'] == "d") {
    	$block['position'] = "c";
    }
    atThemeBlock($block);
}

function themeformatnews($vars)
{
    extract($vars);
    
    $preformat = array (
	   'bodytext' => $bodytext,
	   'bytesmore' => $morelink,
	   'category' => $title,
	   'comment' => '?',
	   'hometext' => $hometext,
	   'notes' => $notes,
	   'searchtopic' => $topicimage,
	   'print' => $morelink,
	   'readmore' => $morelink,
	   'send' => $morelink,
	   'title' => $title,
	   'version' => '?',
	   'more' => $morelink,
	   'catandtitle' => $title,
	   'maintext' => $hometext,
	   'fulltext' => $bodytext,
    );

    $info = array (
	   'aid' => $aid,
	   'bodytext' => $bodytext,
	   'catthemeoverride' => '?',
	   'cid' => '?',
	   'cattitle' => $title,
	   'comments' => '?',
	   'counter' => $counter,
	   'hometext' => $hometext,
	   'informant' => $informant,
	   'notes' => $notes,
	   'sid' => $sid,
	   'themeoverride' => '?',
	   'tid' => $topic,
	   'time' => $datetime,
	   'title' => $title,
	   'topicname' => $topicname,
	   'topicimage' => $topicimage,
	   'topictext' => $topictext,
	   'tcounter' => '?',
	   'unixtime' => '?',
	   'withcomm' => '?',
	   'skins' => '?',
	   'topicid' => $topic,
	   'topic' => $topic,
	   'catid' => '?',
	   'version' => '?',
	   'longdatetime' => $datetime,
	   'briefdatetime' => $datetime,
	   'longdate' => $datetime,
	   'briefdate' => $datetime,
	   'catandtitle' => $title,
	   'maintext' => $hometext,
	   'fulltext' => $bodytext,
    );
    
    $links = array (
	   'category' => '?',
	   'comment' => '?',
	   'fullarticle' => '?',
	   'searchtopic' => '?',
	   'print' => '?',
	   'send' => '?',
	   'version' => '?',
    );

    return array($preformat, $info, $links);

}

?>
