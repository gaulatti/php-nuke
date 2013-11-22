<?php 

// Extra for all platforms
//
// How to register an extra and the functions that it performs and when to perform them (at operation)
//
$extra['themeversion'] = array (
	'name' => 'Theme Information',
	'description' => 'Allows the inclusion of theme information in themes',
	'version' => '1.7',
	'author' => 'Shawn McKenzie',
	'contact' => 'http://spidean.mckenzies.net',
	'bodyopen' => 'at_themeversion',
	'themeadmin' => 'at_admin_themeversion'
);

// Extra functions
//
// The theme function is passed the $runningconfig array
//
function at_themeversion($runningconfig)
{
	if (is_array($runningconfig['themeversion'])) {
        extract($runningconfig['themeversion']);
    }	
	if (!$name) { $name = $runningconfig['thename']; }

	echo "<!--\n"
    ."*****************************************************************\n"
    ."Theme Name:  $name\n"
    ."Version:     $version\n\n"
    ."Description: ".wordwrap($description, 60)."\n\n"
    ."Author:      $author\n"
    ."Contact:     $contact\n"
	."*****************************************************************\n"
    ."-->\n";
}

// The admin function is passed the extra specific configuration array
//
function at_admin_themeversion($themeversion)
{	
    extract($themeversion);
    
    $yinc = $ninc = "";
    if ($include){ $yinc = "checked"; } else { $ninc = "checked"; }
    
    $output = "      "._AT_NAME."\n"
    ."      <input type=\"text\" name=\"name\" size=\"20\" value=\"$name\"><br />\n"
    ."      "._AT_VERSION."\n"
    ."      <input type=\"text\" name=\"version\" size=\"10\" value=\"$version\"><br /><br />\n"
    ."      "._AT_DESCRIPTION."<br />\n"
    ."      <textarea name=\"description\" rows=\"5\" cols=\"30\">$description</textarea><br />\n"
    ."      "._AT_AUTHOR."\n"
    ."      <input type=\"text\" name=\"author\" size=\"30\" value=\"$author\"><br />\n"
    ."      "._AT_CONTACT."\n"
    ."      <input type=\"text\" name=\"contact\" size=\"40\" value=\"$contact\"><br />\n"
    ."      "._AT_INCLUDEINFO
    ."      <input type=\"radio\" name=\"include\" value=\"1\" $yinc>"._YES."\n"
    ."      <input type=\"radio\" name=\"include\" value=\"0\" $ninc>"._NO."<br />\n";
	
    return $output;
}

?>
