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

if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}

$module_name = "Content";
include_secure("modules/$module_name/admin/language/lang-".$currentlang.".php");

switch($op) {

	case "content":
	case "content_edit":
	case "content_delete":
	case "content_save":
	case "content_save_edit":
	case "content_change_status":
	case "add_category":
	case "edit_category":
	case "save_category":
	case "del_content_cat":
	include("modules/$module_name/admin/index.php");
	break;

}

?>