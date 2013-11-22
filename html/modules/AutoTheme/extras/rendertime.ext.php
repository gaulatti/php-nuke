<?php

// Extra for all platforms
//
// How to register an extra and the functions that it performs and when to perform them (at operation)
//
// $extra = array ( 'at operation' => 'extra function' );
//
$extra['rendertime'] = array (
	'name' => 'Render Time',
	'description' => 'Show page render time.',
	'version' => '1.7',
	'author' => 'Shawn McKenzie',
	'contact' => 'http://spidean.mckenzies.net',
	'themeinit' => 'at_rendertime_start',
	'themeclose' => 'at_rendertime_stop',
);

// Extra functions
//
function at_rendertime_start($vars)
{
	$mtime = explode(" ", microtime());
	$renderstart = $mtime[1] + $mtime[0];
	
	atRunningSetVar("renderstart", $renderstart);
}

function at_rendertime_stop($vars)
{
	$renderstart = atRunningGetVar("renderstart");
	
    $mtime = explode(" ", microtime());
	$renderstop = $mtime[1] + $mtime[0];
	$rendertime = ($renderstop - $renderstart);
	
	printf('<div align="center">'._AT_PAGECREATED." %f "._AT_SECONDS.'</div>', $rendertime);
}

?>