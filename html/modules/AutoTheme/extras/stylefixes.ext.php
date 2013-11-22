<?php 

// Extra for all platforms
//
// How to register an extra and the functions that it performs and when to perform them (at operation)
//
// $extra = array ( 'at operation' => 'extra function' );
//
$extra['stylefixes'] = array (
	'name' => 'Style fixes',
	'description' => 'Global styles that fix certain incompatibilities between browsers',
	'version' => '1.7',
	'author' => 'Shawn McKenzie',
	'contact' => 'http://spidean.mckenzies.net',
	'themeopen' => 'at_style_fixes',
);

// Extra functions
//
function at_style_fixes()
{
    echo "<!-- Make forms inline for IE -->\n<style type=\"text/css\">form { display: inline }</style>\n";
}

?>
