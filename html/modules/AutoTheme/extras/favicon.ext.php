<?php 

// Extra for all platforms
//
// How to register an extra and the functions that it performs and when to perform them (at operation)
//
// $extra = array ( 'at operation' => 'extra function' );
//
$extra['favicon'] = array (
	'name' => 'Shortcut Icon',
	'description' => 'Includes a shortcut icon for your site',
	'version' => '1.7',
	'author' => 'Shawn McKenzie',
	'contact' => 'http://spidean.mckenzies.net',
	'themeopen' => 'at_shortcut_icon',
	'atadmin' => 'at_admin_shortcuticon'
);

// Extra functions
//
function at_shortcut_icon($config)
{
	extract($config);
	
	$favicon = atAutoGetVar("favicon");
    $icon = $favicon['icon'];	
    
    if (!$icon) {
        $icon = "favicon.ico";
    }
    if (file_exists($imagepath.$icon)) {
        $icon = $imagepath.$icon;
    }
    echo "<!-- Add shortcut icon -->\n<link rel=\"SHORTCUT ICON\" href=\"$icon\""
    .($xhtml ? " />" : ">")."\n";
}

function at_admin_shortcuticon($vars)
{
    extract($vars);

    if (!$icon) {
        $icon = "favicon.ico";
    }	
    $output = _AT_ICON." <input type=\"text\" name=\"icon\" value=\"$icon\">\n";
	
	return $output;
}

?>
