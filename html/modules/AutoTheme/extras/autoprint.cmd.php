<?php

// Extra command for all platforms
//
//atRunningSetVar("autoprint", "AutoPrint");

$autoprint = atAutoGetVar("autoprint");
$atpath = atAutoGetVar("atpath");
$theme = $autoprint["theme"];

if (!$theme) {
    $theme = "AutoPrint";
}
$thispage = $_SERVER['PHP_SELF'];

if ($_SERVER['PHP_SELF'] == "modules.php") {
	$thispage = "index.php";
}
$urlend = $_SERVER['QUERY_STRING'] ? "?".$_SERVER['QUERY_STRING']."&" : "?";
$thisurl = $thispage.$urlend."theme=$theme";
$thisurl = htmlentities($thisurl);

if (file_exists($themepath."images/print.gif")) {
	$thisimage = $themepath."images/print.gif";
}
if (file_exists($atpath."images/print.gif")) {
	$thisimage = $atpath."images/print.gif";
}
if (isset($thisimage)) {
	$printimage = '<img src="'.$thisimage.'" alt="'._AT_PRINTERFRIENDLYPAGE.'" border="0"> ';
}
else {
	$printimage = "";
}
atRunningSetVar("printimage", $printimage);
atRunningSetVar("thisurl", $thisurl);

// How to register extra commands
//
// $extracmd['applies to users'] = array ( 'command-name' => "action to perform, PHP, HTML whatever" );
//
$extracmd['all'] = array (
	'print-link' => 'echo "<a target=\"_blank\" href=\"$thisurl\">$printimage"._AT_PRINTERFRIENDLYPAGE."</a>";',
);

?>
