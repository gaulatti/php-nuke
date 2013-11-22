<?php 

// Extra for all platforms
//
// How to register an extra and the functions that it performs and when to perform them (at operation)
//
// $extra = array ( 'at operation' => 'extra function' );
//
$extra['credits'] = array (
	'name' => 'AutoTheme Credits',
	'description' => 'Add AutoTheme credit and link to footer',
	'version' => '1.7',
	'author' => 'Shawn McKenzie',
	'contact' => 'http://spidean.mckenzies.net',
	'themeclose' => 'at_credits',
	'atadmin' => 'at_admin_credits',
);

// Extra functions
//
function at_credits($vars)
{
    extract($vars);

    $atpath = atAutoGetVar("atpath");
    $credits = atAutoGetVar("credits");
    $type = $credits['type'];
    
    if ($type == "text") {
        $link = _AT_POWERED;
    }
    else {
        $link = "<img border=\"0\" src=\"$atpath/images/at-powered.gif\" alt=\""._AT_POWERED."\" width=\"100\" height=\"50\" />";
    }
    echo "\n<div align=\"center\">\n"
	."<a target=\"_blank\" href=\"http://www.spidean.com\">$link</a>\n"
	."</div>\n";
}

function at_admin_credits($credits)
{
    extract($credits);
    
    $image = $text = "";

    switch ($type) {
    	case "text":
    	$text = "selected";
    	break;
    	
    	default:
    	$image = "selected";
    	break;
    }    	
    $output = _AT_TYPE."<select name=\"type\">\n"
    ."<option $image value=\"image\">"._AT_IMAGE."</option>\n"
    ."<option $text value=\"text\">"._AT_TEXT."</option>\n"
    ."</select>\n";
	
	return $output;
}

?>
