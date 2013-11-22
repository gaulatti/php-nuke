<?php 

// Extra for all platforms
//
// How to register an extra and the functions that it performs and when to perform them (at operation)
//
// $extra = array ( 'at operation' => 'extra function' );
//
$extra['headcontent'] = array (
	'name' => 'Head content',
	'description' => 'Head content, title, meta tags and description for each page.',
	'version' => '1.7',
	'author' => 'Shawn McKenzie',
	'contact' => 'http://spidean.mckenzies.net',
	'themeinit' => 'at_headcontent',
	'modadmin' => 'at_admin_headcontent',
);

// Extra functions
//
function at_headcontent($vars)
{
	extract($vars);
	
	if ($headcontent[$modtemplate][$modops]) {
		extract($headcontent[$modtemplate][$modops]);
		$doit = 1;
	}
	elseif ($headcontent['default']) {
		extract($headcontent['default']);
		$doit = 1;
	}		
	elseif (!isset($doit)) {
		return;
	}
	if (defined($title)) {
		$title = constant($title);
	}
	if (defined($keywords)) {
		$keywords = constant($keywords);
	}
	if (defined($description)) {
		$description = constant($description);
	}	
	$page["title"] = $title;
	$page["keywords"] = $keywords;
	$page["description"] = $description;
    atCommandBuild($page, "page");
}

function at_admin_headcontent($headcontent)
{	
	extract($headcontent);
	
    $output = "      "._AT_TITLE."<br />\n"
    ."      <input type=\"text\" name=\"title\" size=\"50\" value=\"$title\"><br />\n"
	."      "._AT_KEYWORDS."<br />\n"
    ."      <textarea name=\"keywords\" rows=\"5\" cols=\"50\">$keywords</textarea><br />\n"
    ."      "._AT_DESCRIPTION."<br />\n"
    ."      <input type=\"text\" name=\"description\" size=\"50\" value=\"$description\"><br /><br />\n";

	return $output;	
}

?>
