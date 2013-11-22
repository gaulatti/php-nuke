<?php

// Extra for all platforms
//
// How to register an extra and the functions that it performs and when to perform them (at operation)
//
// $extra = array ( 'at operation' => 'extra function' );
//
$extra['modstyles'] = array (
	'name' => 'Module Styles',
	'description' => 'Add style definitions for module content',
	'version' => '1.7',
	'author' => 'Shawn McKenzie',
	'contact' => 'http://spidean@mckenzies.net',
	'modopen' => 'open_mod_styles',
	'modclose' => 'close_mod_styles',
	'atadmin' => ''
);

// Extra functions
//
function open_mod_styles($vars)
{
	extract($vars);

    $modname = atGetModName();
    
    if (!isset($tag)) {
    	$tag = "div";
    }
	$display .= "\n<!-- Open Module Styles -->\n"
	."<$tag id=\"$modname\" class=\"module\">\n\n";
	
    echo $display;
}

function close_mod_styles($vars)
{
	extract($vars);
	
	if (!isset($tag)) {
    	$tag = "div";
    }
    $display .= "\n<!-- Close Module Styles -->\n"
	."</$tag>\n\n";

  	echo $display;
}

?>
