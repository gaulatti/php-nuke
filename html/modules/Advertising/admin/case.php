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

$module_name = "Advertising";
include_secure("modules/$module_name/admin/language/lang-".$currentlang.".php");

switch($op) {

    case "BannersAdmin":
    case "BannersAdd":
    case "BannerAddClient":
    case "BannerDelete":
    case "BannerEdit":
    case "BannerChange":
    case "BannerClientDelete":
    case "BannerClientEdit":
    case "BannerClientChange":
    case "BannerStatus":
    case "add_banner":
    case "add_client":
    case "ad_positions":
    case "position_add":
    case "position_save":
    case "position_edit":
    case "position_delete":
    case "ad_terms":
	case "ad_plans":
	case "ad_plans_add":
	case "ad_plans_edit":
	case "ad_plans_save":
	case "ad_plans_delete":
	case "ad_plans_status":
    include("modules/$module_name/admin/index.php");
    break;

}

?>