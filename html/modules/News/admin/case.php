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

$module_name = "News";
include_secure("modules/$module_name/admin/language/lang-".$currentlang.".php");

switch($op) {

    case "YesDelCategory":
    case "subdelete":
    case "DelCategory":
    case "NoMoveCategory":
    case "EditCategory":
    case "SaveEditCategory":
    case "AddCategory":
    case "SaveCategory":
    case "DisplayStory":
    case "PreviewAgain":
    case "PostStory":
    case "EditStory":
    case "RemoveStory":
    case "ChangeStory":
    case "DeleteStory":
    case "adminStory":
    case "PreviewAdminStory":
    case "PostAdminStory":
    case "autoDelete":
    case "autoEdit":
    case "autoSaveEdit":
    case "submissions":
    case "publish_now":
    include("modules/$module_name/admin/index.php");
    break;

}

?>