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

$command['anonymous'] = array (
);

$command['loggedin'] = array (
);

$command['admin'] = array (
);

$command['all'] = array (
	'theme-path' => 'echo $themepath;',
	'image-path' => 'echo $imagepath;',
	'footer-msg' => 'echo footmsg();',
	'open-table' => 'OpenTable();',
	'close-table' => 'CloseTable();',
	'open-table2' => 'OpenTable2();',
	'close-table2' => 'CloseTable2();',
	'user' => 'echo $username;',
	'user-welcome' => 'echo _AT_WELCOME." ".$username;',
	'logo-image' => 'if (isset($logoimg) && file_exists($themepath.$logoimg) && !is_dir($themepath.$logoimg)) {'
	.'echo "<img src=\"".$themepath.$logoimg."\" alt=\"\" border=\"0\" />\n";}',
	'block-title' => 'echo $block["title"];',
	'block-content' => 'echo $block["content"];',
	'left-blocks' => 'atBlockDisplay("l");',
	'center-blocks' => 'atBlockDisplay("c");',
	'right-blocks' => 'atBlockDisplay("r");',
	'color1' => 'echo $bgcolor1;',
	'color2' => 'echo $bgcolor2;',
	'color3' => 'echo $bgcolor3;',
	'color4' => 'echo $bgcolor4;',
	'color5' => 'echo $textcolor1;',
	'color6' => 'echo $textcolor2;',
	'color7' => 'echo $tblcolor1;',
	'color8' => 'echo $tblcolor2;',
	'color9' => 'echo $tblcolor3;',
	'color10' => 'echo $tblcolor4;',
);

if (isset($autoblock)) {
    foreach ($autoblock as $key => $ablock){
            $command['all']['autoblock'.$key.'-blocks'] = 'atBlockDisplay("'.$key.'");';
			$command['all'][$ablock.'-blocks'] = 'atBlockDisplay("'.$key.'");';
            $command['all'][strtolower($ablock.'-blocks')] = 'atBlockDisplay("'.$key.'");';
    }
}

?>
