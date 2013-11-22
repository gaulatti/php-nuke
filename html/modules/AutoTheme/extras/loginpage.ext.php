<?php 

// Extra for all platforms
//
// How to register an extra and the functions that it performs and when to perform them (at operation)
//
// $extra = array ( 'at operation' => 'extra function' );
//
$extra['loginpage'] = array (
	'name' => 'Login Page',
	'description' => 'Custom login page',
	'version' => '1.7',
	'author' => 'Shawn McKenzie',
	'contact' => 'http://spidean.mckenzies.net',
	'themeopen' => 'at_loginpage',
	'themeadmin' => 'at_admin_loginpage'
);

// Extra functions
//
function at_loginpage($vars)
{
	extract($vars);
	$template = $loginpage['template'];

    session_start();

	if (!atIsLoggedIn()) {
		$_SESSION['loggedin'] = 0;
		$_SESSION['login_entered'] = 0;
		return;
	}
	if ($_SESSION['loggedin'] == 1) {
		$_SESSION['login_entered'] = 1;
		return;
	}
	$_SESSION['loggedin'] = 1;
	$_SESSION['login_entered'] = 1;

	if (!$template) {
        $template = "loginpage.html";
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

function at_admin_loginpage($vars)
{
    extract($vars);
    
    $themepath = at_gettheme_path($themedir);
    $filelist = at_listfiles($themepath, "htm");
    
    $output = "<table><tr><td>"._AT_TEMPLATE."</td>".at_file_select($themedir, "template", $template, $filelist)."</tr></table>";
    	
	return $output;
}

?>
