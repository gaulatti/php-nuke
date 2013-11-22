<?php 
return;
// Extra for all platforms
//
// How to register an extra and the functions that it performs and when to perform them (at operation)
//
// $extra = array ( 'at operation' => 'extra function' );
//
$extra['autoimages'] = array (
	'name' => 'Automatic theme images',
	'description' => 'Replaces any deafult images with images from the theme automagically',
	'version' => '1.7',
	'author' => 'Shawn McKenzie',
	'contact' => 'http://spidean.mckenzies.net',
	'themepostprocess' => 'at_autoimages'
);

// Extra functions
//
function at_autoimages($display)
{
	$runningconfig = atGetRunningConfig();
	extract($runningconfig);
	
	//preg_match_all("|\<img src=\"([^\"]+)\"|", $display, $images);
	preg_match_all("|\<img src=[\'\"]([^\'\"]+)[\'\"]|", $display, $images);
	
	foreach ($images[1] as $key => $path) {
		$parts = explode("/", $path);
		$last = count($parts) - 1;
		
		 switch ($parts[0]) {
		 	case "modules":
		 		$new = atImageSearch($parts[$last], $parts[1]);
		 		break;
		 		
		 	case "images":
			 	$new = atImageSearch($parts[1]."/".$parts[$last]);
		 		break;		 		
		 }
		 if ($new) {
		 	$old[$key] = $path;
		 	$new[$key] = $new;
		 }
	}
	$display = str_replace($old, $new, $display);
	
    return $display;
}

?>
