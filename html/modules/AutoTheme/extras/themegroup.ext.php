<?php     

// Extra for all platforms
//
// How to register an extra and the functions that it performs and when to perform them (at operation)
//
// $extra = array ( 'at operation' => 'extra function' );
//
$extra['themegroup'] = array (
	'name' => 'Theme Group',
	'description' => 'Display themes based upon the user\'s current group',
	'version' => '1.7',
	'author' => 'Shawn McKenzie',
	'contact' => 'http://spidean.mckenzies.net',
	'themeinit' => 'at_themegroup',
	'atadmin' => 'at_admin_themegroup'
);

// Extra functions
//
function at_themegroup($vars)
{
    extract($vars);
    
    $themegroup = atAutoGetVar("themegroup");
        
    if (!$themegroup) {
    	return;
    }
    foreach ($themegroup['group'] as $k => $v) {
    	$newarray[$v] = $themegroup['theme'][$k].":".$themegroup['user'][$k];
    }    
    $themegroup = $newarray;
    ksort($themegroup);
    
    foreach ($themegroup as $group => $theme) {
    	if (atIsInGroup($group)) {
    		$parts = explode(":", $theme);
    		$newtheme = $parts[0];
    		$user = $parts[1];
    		break;
    	}
    }
    atThemeSet($newtheme, $user);
}	

function at_admin_themegroup($themegroup)
{
    $themelist = atThemeList();
    $grouplist = atGroupList();
	
	foreach ($themegroup['group'] as $k => $group) {
    	$theme = $themegroup['theme'][$k];
    	$user = $themegroup['user'][$k];
    	
        $output .= _AT_GROUP." <select name=\"group[]\">\n";
        $output .= "<option></option>";
        foreach ($grouplist as $groupname) {
	    	if ($groupname == $group) {
	    		$sel = " selected";
	    	}
	    	else {
	    		$sel = "";
	    	}    		
	        $output .= "  <option$sel>$groupname</option>\n";
	    }
	    $output .= "</select><br /><br />\n";
        
        $output .= _AT_THEME." <select name=\"theme[]\">\n";
        $output .= "<option></option>";
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
	    if ($user) { $checked = " checked"; }
	    $output .= _AT_USERSTHEME." <input$checked type=\"checkbox\" name=\"user[]\" value=\"1\"><br /><br />";
    }
    
    $output .= _AT_GROUP." <select name=\"group[]\">\n";
    $output .= "<option selected></option>";
    foreach ($grouplist as $groupname) {
        $output .= "  <option>$groupname</option>\n";
    }
    $output .= "</select><br /><br />\n";
        
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
