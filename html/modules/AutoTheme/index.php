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

if (!eregi("index.php|modules.php", $_SERVER['PHP_SELF'])) {
    die ("Access Denied");
}
include("header.php");

OpenTable();

echo "<div align=\"center\"><b><a href=\"http://www.spidean.com\">AutoTheme 0.87</a></b><br />";
echo "Copyright (c) 2002-2006 Shawn McKenzie<br /><a href=\"http://www.spidean.com\">http://www.spidean.com</a><br /><br />";
echo "This site is running the AutoTheme HTML Theme System.  AutoTheme is currently available for PostNuke, PHP-Nuke, MD-Pro, osCommerce and CRE Loaded.  AutoTheme runs as a transparent user module.  It can be configured from the Administration interface.</div><br /><br />";

CloseTable();

include("footer.php");

?>
