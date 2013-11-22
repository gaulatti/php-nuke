<?php 

// Extra for all platforms
//
// How to register an extra and the functions that it performs and when to perform them (at operation)
//
// $extra = array ( 'at operation' => 'extra function' );
//
$extra['entrypage'] = array (
	'name' => 'Entry Page',
	'description' => 'Custom site entry page',
	'version' => '1.7',
	'author' => 'Shawn McKenzie',
	'contact' => 'http://spidean.mckenzies.net',
	'themeopen' => 'at_entrypage',
	'themeadmin' => 'at_admin_entrypage'
);

// Extra functions
//
function at_entrypage($vars)
{
	session_start();
	if (isset($_SESSION['entered'])) {
    	return;
    }
    else {
        $_SESSION['entered'] = 1;
    }
    extract($vars);
    
    $entrypage = atAutoGetVar("entrypage");
    $template = $entrypage['template'];
    $type = $entrypage['type'];
        
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
    if (!$template) {
        $template = "entrypage.html";
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

function at_admin_entrypage($vars)
{
    extract($vars);

    if (!$template) {
        $template = "entrypage.html";
    }
    $admin = $all = $loggedin = $anonymous = "";
    
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
    $themepath = at_gettheme_path($themedir);
    $filelist = at_listfiles($themepath, "htm");
    
    $output = "<table><tr><td>"._AT_TEMPLATE."</td>".at_file_select($themedir, "template", $template, $filelist)."</tr></table>"
    ._AT_APPLIESTO." <select name=\"type\">\n"
    ."<option $admin value=\"admin\">"._AT_ADMIN."</option>\n"
    ."<option $all value=\"all\">"._AT_ALL."</option>\n"
    ."<option $anonymous value=\"anonymous\">"._AT_ANONYMOUS."</option>\n"
    ."<option $loggedin value=\"loggedin\">"._AT_LOGGEDIN."</option>\n"
    ."</select>\n";
	
	return $output;
}

?>
