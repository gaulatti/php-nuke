<?php 

// Extra for all platforms
//
// How to register an extra and the functions that it performs and when to perform them (at operation)
//
// $extra = array ( 'at operation' => 'extra function' );
//
$extra['transitionpages'] = array (
	'name' => 'Transition Pages',
	'description' => 'Custom module transition pages',
	'version' => '1.7',
	'author' => 'Shawn McKenzie, Richard Wing',
	'contact' => 'http://spidean.mckenzies.net, http://www.postnukearchives.com',
	'themeopen' => 'at_transitionpages',
	'modadmin' => 'at_admin_transitionpages'
);

// Extra functions
//
function at_transitionpages($transitionpages)
{
	atCommandAdd("page-url", 'echo $_SERVER["REQUEST_URI"];');
	
	$runningconfig = atGetRunningConfig();
	extract($runningconfig);

    if (is_array($transitionpages)) {
    	if ($transitionpages[$modtemplate][$modops]) {
    		$vars = $transitionpages[$modtemplate][$modops];
    	} else {
    		$vars = array_merge((array)$transitionpages['default'], (array)$transitionpages[$modtemplate][$modops]);
    	}
    	extract($vars);
   	}
	else {
		return;
	}	
	session_start();
	$module = atGetModName();
	
	if (!isset($_SESSION[$module.'_entered'])) {
		$_SESSION[$module.'_entered'] = 1;
	}
	else {
		$_SESSION[$module.'_entered']++;
	}	
	if ($visits == 0 || $visits == 1 || $_SESSION[$module.'_entered'] % $visits) {
		return;
	}
    switch ($type) {
        case "admin":
        if (!atIsAdminUser()) {
            return;
        }
        break;

        case "anonymous":
        if (atIsLoggedin()) {
            return;
        }
        break;
        
        case "loggedin":
        if (!atIsLoggedin()) {
            return;
        }
        break;
    }
    if ($rotate) {
    	$c = $_SESSION[$module.'_count'];
    	$template = $template[$c];
    	
    	if (!isset($_SESSION[$module.'_count']) || $_SESSION[$module.'_count'] > (count($template) - 1)) {
    		$_SESSION[$module.'_count'] = 0;
    	}
    	else {
    		$_SESSION[$module.'_count']++;
    	}
    }
    else {
    	$template = $template[0];
    }    
    if (!$template) {
        $template = "transitionpages.html";
    }
    if (@file_exists($themepath.$template)) {
		$file = $themepath.$template;
	}
	elseif (@file_exists($atdir."templates/$template")) {
		$file = $atdir."templates/$template";
	}
	else {
		return;
	}
    $HTML = atTemplatePrep($file, 1);
    $output = atCommandReplace($HTML, $command);
    atTemplateDisplay($output);
	atThemeExit();
}	

function at_admin_transitionpages($vars)
{
    extract($vars);
    
    $themepath = at_gettheme_path($themedir);
    $filelist = at_listfiles($themepath, "htm");
    
    $admin = $all = $loggedin = $anonymous = $yes = $no = "";    
    
    if ($visits < 2) {
    	$visits = 0;
    }
    if ($rotate) {
    	$yes = "checked";
    }
    else {
    	$no = "checked";
    }
    switch ($type) {
    	case "admin":
    	$admin = "selected";
    	break;
    	
    	case "all":
    	$all = "selected";
    	break;
    	
    	case "loggedin":
    	$loggedin = "selected";
    	break;
    	
    	default:
    	$anonymous = "selected";
    	break;
    }
    $i = 0;
    if (is_array($template)) {
	    foreach ($template as $val) {
	    	$output .= "<table><tr><td>"._AT_TEMPLATE." ".++$i."</td>".at_file_select($themedir, "template[]", $val, $filelist)."</tr></table>";
	    }
    }
    $output .= "<table><tr><td>"._AT_TEMPLATE." ".++$i."</td>".at_file_select($themedir, "template[]", $template, $filelist)."</tr></table>"
	._AT_ROTATE."<br />"
	."<input type=\"radio\" name=\"rotate\" value=\"1\" $yes>"._YES."\n"
	."<input type=\"radio\" name=\"rotate\" value=\"0\" $no>"._NO."<br />\n"
	._AT_VISITS." <input type=\"text\" size=\"3\" name=\"visits\" value=\"$visits\"><br />\n"
    ._AT_APPLIESTO." <select name=\"type\">\n"
    ."<option $admin value=\"admin\">"._AT_ADMIN."</option>\n"
    ."<option $all value=\"all\">"._AT_ALL."</option>\n"
    ."<option $anonymous value=\"anonymous\">"._AT_ANONYMOUS."</option>\n"
    ."<option $loggedin value=\"loggedin\">"._AT_LOGGEDIN."</option>\n"
    ."</select>\n";
	
	return $output;
}

?>
