<?php 

// Extra for all platforms
//
// How to register an extra and the functions that it performs and when to perform them (at operation)
//
// $extra = array ( 'at operation' => 'extra function' );
//
$extra['themelang'] = array (
	'name' => 'Theme Language',
	'description' => 'Display themes based upon the user\'s chosen language',
	'version' => '1.7',
	'author' => 'Shawn McKenzie',
	'contact' => 'http://spidean.mckenzies.net',
	'themeinit' => 'at_themelang',
	'atadmin' => 'at_admin_themelang'
);

// Extra functions
//
function at_themelang($vars)
{
    extract($vars);
    
    $themelang = atAutoGetVar("themelang");
    
    if (!$themelang) {
    	return;
    }
    foreach ($themelang['lang'] as $k => $v) {
    	$newarray[$v] = $themelang['theme'][$k].":".$themelang['user'][$k];
    }    
    $themelang = $newarray;
    $userlang = atGetLang();    	
    
    ksort($themelang);
    
    foreach ($themelang as $lang => $theme) {
    	if ($userlang == $lang) {
    		$parts = explode(":", $theme);
    		$newtheme = $parts[0];
    		$user = $parts[1];
    		break;
    	}
    }        
    atThemeSet($newtheme, $user);
}	

function at_admin_themelang($themelang)
{
	$themelist = atThemeList();
	
    foreach ($themelang['lang'] as $k => $lang) {
    	$theme = $themelang['theme'][$k];
        $output .= _AT_LANG." <input type=\"text\" name=\"lang[]\" value=\"$lang\" maxlength=\"3\"><br />\n";
        $output .= _AT_THEME." <select name=\"theme[]\">\n";
	   	$output .= "<option selected ></option>";
	    foreach ($themelist as $themename) { 		
	    	if ($theme == $themename) {
	    		$sel = " selected";
	    	}
	    	else {
	    		$sel = "";
	    	}
	        $output .= "  <option$sel>$themename</option>\n";
	    }
	    $output .= "</select><br /><br />\n";
	    $output .= _AT_USERSTHEME." <input type=\"checkbox\" name=\"user[]\" value=\"1\"><br /><br />";
    }
    $output .= _AT_LANG." <input type=\"text\" name=\"lang[]\" value=\"\" maxlength=\"3\"><br />\n";
    $output .= _AT_THEME." <select name=\"theme[]\">\n";
   	$output .= "<option selected ></option>";
    foreach ($themelist as $themename) { 		
        $output .= "  <option>$themename</option>\n";
    }
    $output .= "</select><br /><br />\n";
    $output .= _AT_USERSTHEME." <input type=\"checkbox\" name=\"user[]\" value=\"1\"><br /><br />";
    
	return $output;
}

?>
