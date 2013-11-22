<?php 

// Extra for all platforms
//
// How to register an extra and the functions that it performs and when to perform them (at operation)
//
// $extra = array ( 'at operation' => 'extra function' );
//
$extra['themetime'] = array (
	'name' => 'Theme Time',
	'description' => 'Display themes on at specific times of the day',
	'version' => '1.7',
	'author' => 'Shawn McKenzie',
	'contact' => 'http://spidean.mckenzies.net',
	'themeopen' => 'at_themetime',
	'atadmin' => 'at_admin_themetime'
);

// Extra functions
//
function at_themetime($vars)
{
    extract($vars);
    
    $themetime = atAutoGetVar("themetime");
    
    if (!$themetime) {
    	return;
    }
    foreach ($themetime['time'] as $k => $v) {
    	$newarray[$v] = $themetime['theme'][$k].":".$themetime['user'][$k];
    }    
    $themetime = $newarray;
    $now = time();    	
    
    ksort($themetime);
    
    foreach ($themetime as $time => $theme) {
    	$changetime = strtotime($time);

    	if ($now >= $changetime) {
    		$newtheme = $theme;
    	}
    }        
    atThemeSet($newtheme, $user);    
}	

function at_admin_themetime($themetime)
{
    $themelist = atThemeList();
    
	foreach ($themetime['time'] as $k => $time) {
    	$theme = $themetime['theme'][$k];
        $output .= _AT_TIME." <input type=\"text\" name=\"time[]\" value=\"$time\" maxlength=\"10\">\n";
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
    $output .= _AT_TIME." <input type=\"text\" name=\"time[]\" value=\"\" maxlength=\"10\">\n";
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
