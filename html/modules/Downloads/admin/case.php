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

$module_name = "Downloads";
include_secure("modules/$module_name/admin/language/lang-".$currentlang.".php");


switch($op) {

	case "downloads":
	case "DownloadsDelNew":
	case "DownloadsAddCat":
	case "DownloadsAddSubCat":
	case "DownloadsAddDownload":
	case "DownloadsAddEditorial":
	case "DownloadsModEditorial":
	case "DownloadsDownloadCheck":
	case "DownloadsValidate":
	case "DownloadsDelEditorial":
	case "DownloadsCleanVotes":
	case "DownloadsListBrokenDownloads":
	case "DownloadsDelBrokenDownloads":
	case "DownloadsIgnoreBrokenDownloads":
	case "DownloadsListModRequests":
	case "DownloadsChangeModRequests":
	case "DownloadsChangeIgnoreRequests":
	case "DownloadsDelCat":
	case "DownloadsModCat":
	case "DownloadsModCatS":
	case "DownloadsModDownload":
	case "DownloadsModDownloadS":
	case "DownloadsDelDownload":
	case "DownloadsDelVote":
	case "DownloadsDelComment":
	case "DownloadsTransfer":
	case "check_download":
	include("modules/$module_name/admin/index.php");
	break;

}

?>