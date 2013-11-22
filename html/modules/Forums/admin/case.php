<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Link to the phpBB2 forum admin menu                                  */
/*                                                                      */
/* Copyright (c) 2002 by Tom Nitzschner (tom@toms-home.com)             */
/* http://bbtonuke.sourceforge.net                                      */
/* http://www.toms-home.com                                             */
/*                                                                      */
/*   As always, make a backup before messing with anything. All code    */
/*   release by me is considered sample code only. It may be fully      */
/*   functual, but you use it at your own risk, if you break it,        */
/*   you get to fix it too. No waranty is given or implied.             */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/* Forum admin files for PHP-Nuke 7.5 by chatserv                       */
/************************************************************************/

if ( !defined('ADMIN_FILE') )
{
	die("Illegal File Access");
}
$module_name = "Forums";

switch($op) {

    case "forums":
    include("modules/$module_name/admin/forums.php");
    break;
 
}

?>