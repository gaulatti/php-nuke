<?php 

// Extra for all platforms
//
// How to register an extra and the functions that it performs and when to perform them (at operation)
//
// $extra = array ( 'at operation' => 'extra function' );
//
$extra['themesonadate'] = array (
	'name' => 'Themes on a Date',
	'description' => 'Display themes on specific dates',
	'version' => '1.7',
	'author' => 'Shawn McKenzie',
	'contact' => 'http://spidean.mckenzies.net',
	'themeinit' => 'at_themesonadate',
	'atadmin' => 'at_admin_themesonadate'
);

// Extra functions
//
function at_themesonadate($vars)
{
    extract($vars);
    
    $themesonadate = atAutoGetVar("themesonadate");
    
    if (!$themesonadate) {
    	return;
    }
    foreach ($themesonadate['date'] as $k => $v) {
    	$newarray[$v] = $themesonadate['theme'][$k].":".$themesonadate['user'][$k];
    }    
    $themesonadate = $newarray;
    $now = time();    	
    
    ksort($themesonadate);
    
    foreach ($themesonadate as $date => $theme) {
    	$changedate = strtotime($date);

    	if ($now >= $changedate) {
    		$newtheme = $theme;
    	}
    }        
    atThemeSet($newtheme, $user);
    
}	

function at_admin_themesonadate($themesonadate)
{
	$themelist = atThemeList();
		
    foreach ($themesonadate['date'] as $k => $date) {
    	$theme = $themesonadate['theme'][$k];
        $output .= _AT_DATE." <input type=\"text\" name=\"date[]\" value=\"$date\" maxlength=\"10\">\n";
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
    $output .= _AT_DATE." <input type=\"text\" name=\"date[]\" value=\"\" maxlength=\"10\">\n";
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
