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

require_once("modules/AutoTheme/includes/atAPI.php");
$runningconfig = atThemeInit($thename);

$bgcolor1 = atRunningGetVar("bgcolor1");
$bgcolor2 = atRunningGetVar("bgcolor2");
$bgcolor3 = atRunningGetVar("bgcolor3");
$bgcolor4 = atRunningGetVar("bgcolor4");
$textcolor1 = atRunningGetVar("textcolor1");
$textcolor2 = atRunningGetVar("textcolor2");

if (!function_exists("OpenTable")) {
    function OpenTable()
    {
        $runningconfig = atGetRunningConfig();
        extract($runningconfig);

        if ($template['table1']) {
            $file = $template['table1'];
			
            $template = atTemplateCompile($themepath.$file);
            list($output, $close) = atTemplateSplit($template, "table-content");
            atTemplateDisplay($output);
        }
        else {
            echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$tblcolor1\"><tr><td>\n";
            echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\" bgcolor=\"$tblcolor2\"><tr><td>\n";
        }
    }
}

if (!function_exists("CloseTable")) {
    function CloseTable()
    {
        $runningconfig = atGetRunningConfig();
        extract($runningconfig);

        if ($template['table1']) {
            $file = $template['table1'];

            $template = atTemplateCompile($themepath.$file);
            list($open, $output) = atTemplateSplit($template, "table-content");
            atTemplateDisplay($output);
        }
        else {
            echo "</td></tr></table></td></tr></table>\n";
        }
    }
}

if (!function_exists("OpenTable2")) {
    function OpenTable2()
    {
        $runningconfig = atGetRunningConfig();
        extract($runningconfig);

        if ($template['table2']) {
            $file = $template['table2'];

            $template = atTemplateCompile($themepath.$file);
            list($output, $close) = atTemplateSplit($template, "table-content");
            atTemplateDisplay($output);
        }
        else {
            echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$tblcolor3\" align=\"center\"><tr><td>\n";
            echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"4\" bgcolor=\"$tblcolor4\"><tr><td>\n";
        }
    }
}

if (!function_exists("CloseTable2")) {
    function CloseTable2()
    {
        $runningconfig = atGetRunningConfig();
        extract($runningconfig);

        if ($template['table2']) {
            $file = $template['table2'];

            $template = atTemplateCompile($themepath.$file);
            list($open, $output) = atTemplateSplit($template, "table-content");
            atTemplateDisplay($output);
        }
        else {
            echo "</td></tr></table></td></tr></table>\n";
        }
    }
}

?>
