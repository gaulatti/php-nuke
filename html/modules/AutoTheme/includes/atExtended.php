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

function atExtendedInit()
{
	return array();
}

function atThemeExit()
{
	$runningconfig = atGetRunningConfig();
    extract($runningconfig);

    $display = ob_get_contents();
    list($junk, $display) = atTemplateSplit($display, "#AUTOTHEME_START#");
    
    $display = atThemeAddHeader().$display;
    $display = str_replace('$', '\$', $display);
        
	//atRunningSetVar('display', $display);
	//atCommandAdd('display', 'echo $display;');
	
	$template = $template['dtd'];
	
	if (!$template) {
        $template = "HTML401_Transitional.html";
    }
    if (@file_exists($themepath.$template)) {
		$file = $themepath.$template;
	}
	elseif (@file_exists($atdir."templates/$platform/$template")) {
		$file = $atdir."templates/$platform/$template";
	}
	else {
		$file = $atdir."templates/HTML.html";
	}
	$HTML = atTemplateRead($file);
	$HTML = eregi_replace('\<\/head\>', '', $HTML);
	$HTML = preg_replace('/(\<\!--[ ]*\[|{)display(}|\][ ]*--\>)/', $display, $HTML);
	$output = atCommandReplace($HTML);

	ob_end_clean();
    atTemplateDisplay($output);
    
    return die();
}
	
function atThemeAddHeader()
{
    $runningconfig = atGetRunningConfig();
    extract($runningconfig);
 
    $stylesheet = $style['stylesheet'];
    
    $head = "\n<!--\n************************ AutoTheme 0.87 *************************\n-->\n";
    
    if (atGetModName() == "AutoTheme") {
    	$head .= "<script type=\"text/javascript\" src=\"modules/AutoTheme/javascript/picker.js\"></script>\n"
				."<script type=\"text/javascript\">\n"
				."  var JS_PATH = \"modules/AutoTheme/javascript/\";\n"
				."  var PU_PATH = JS_PATH + \"popups/\";\n"
				."</script>\n";
    }
    if (isset($stylesheet)) {
        if (@file_exists($themepath.$stylesheet) && !@is_dir($themepath.$stylesheet)) {
            $head .= "\n<!-- Custom Page stylesheet -->\n";
        	$head .= "<link rel=\"stylesheet\" href=\"".$themepath.$stylesheet."\" type=\"text/css\""
        	.($xhtml ? " />" : ">")."\n";
        }
    }
    if ($system = atPlatformHeader($xhtml)) {
	    $head .= "\n<!-- Head from system -->\n";
	    $head .= "$system\n";
    }
    if ($style['head']) {
	    $head .= "\n<!-- Head from config -->\n";
	    $head .= trim($style['head'])."\n";
    }    
    return $head;
}

function atThemeAddFooter()
{
    $footer = "\n<!--\n************************ AutoTheme 0.87 ************************\n-->\n";

	echo $footer;
}

?>
