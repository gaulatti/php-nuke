<?php 

// Extra for all platforms
//
// How to register an extra and the functions that it performs and when to perform them (at operation)
//
// $extra = array ( 'at operation' => 'extra function' );
//
$extra['blocktitles'] = array (
	'name' => 'Block titles',
	'description' => 'Automatically use images for block titles',
	'version' => '1.7',
	'author' => 'Shawn McKenzie',
	'contact' => 'http://spidean.mckenzies.net',
	'blockopen' => 'at_block_titles',
);

// Extra functions
//
function at_block_titles()
{
    $runningconfig = atGetRunningConfig();
    extract($runningconfig);
    
    $blocktitle = trim(strip_tags($block['title'], ""));
    
    // Check if title is a language define
    if ($blocktitle[0] == "_" && defined($blocktitle)) {
    	$blocktitle = constant($blocktitle);
    }    
    // Look for image in themes/thename/images/lang/ then themes/thename/images/
    $titleimage = strtolower(preg_replace("^\W|_^", "", $blocktitle));
    
    if (@file_exists($imagepath."$language/$titleimage.gif")) {
        $block['title'] = "<img src=\"$imagepath"."$language/$titleimage.gif\" border=\"0\" alt=\"$blocktitle\" />";
    }
    elseif (@file_exists($imagepath."$titleimage.gif")) {
        $block['title'] = "<img src=\"$imagepath"."$titleimage.gif\" border=\"0\" alt=\"$blocktitle\" />";
    }
    elseif (@file_exists($imagepath."$language/$titleimage.jpg")) {
        $block['title'] = "<img src=\"$imagepath"."$language/$titleimage.jpg\" border=\"0\" alt=\"$blocktitle\" />";
    }
    elseif (@file_exists($imagepath."$titleimage.jpg")) {
        $block['title'] = "<img src=\"$imagepath"."$titleimage.jpg\" border=\"0\" alt=\"$blocktitle\" />";
    }
    elseif (@file_exists($imagepath."$language/$titleimage.png")) {
        $block['title'] = "<img src=\"$imagepath"."$language/$titleimage.png\" border=\"0\" alt=\"$blocktitle\" />";
    }
    elseif (@file_exists($imagepath."$titleimage.png")) {
        $block['title'] = "<img src=\"$imagepath"."$titleimage.png\" border=\"0\" alt=\"$blocktitle\" />";
    }
    atCommandBuild($block, "block");
}	

?>
