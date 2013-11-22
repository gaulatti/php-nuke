<?php 

// Extra for all platforms
//
// How to register an extra and the functions that it performs and when to perform them (at operation)
//
// $extra = array ( 'at operation' => 'extra function' );
//
$extra['atadminbar'] = array (
	'name' => 'AutoTheme Admin Bar',
	'description' => 'Administration menu bar for AutoTheme configuration and templates',
	'version' => '1.7',
	'author' => 'Shawn McKenzie',
	'contact' => 'http://spidean.mckenzies.net',
	'bodyopen' => 'at_admin_bar',
	'themeclose' => 'at_config_display',
);

// Extra functions
//
function at_admin_bar()
{
    $runningconfig = atGetRunningConfig();
    extract($runningconfig);

    if ($_SERVER['PHP_SELF'] == "modules.php") {
        $thispage = "index.php";
    }
    else {
        $thispage = $_SERVER['PHP_SELF'];
    }
    if ($multipath) {
    	$thistheme = $themepath;
    }
    else {
    	$thistheme = $thename;
    }
    if (atIsAdminUser()) {
        $end = $_SERVER['QUERY_STRING'] ? "?".$_SERVER['QUERY_STRING']."&" : "?";
		$url = $thispage.$end."at_admin=";

		OpenTable();
		echo "<!-- AutoTheme Admin Bar -->\n<div align=\"center\">";
        echo "<b>"._AT_ADMINBAR.":</b><br />";
		echo _AT_VIEW.": [ <a target=\"_blank\" href=\"".$url."cmds\">"._AT_LOADEDCOMMANDS."</a>  |  ";
		echo "<a target=\"_blank\" href=\"".$url."at\">"._AT_CONFIG."</a>  |  ";
		echo "<a target=\"_blank\" href=\"".$url."theme\">"._AT_THEMECONFIG."</a>  |  ";
		echo "<a target=\"_blank\" href=\"".$url."running\">"._AT_RUNNINGCONFIG."</a> ]<br />";
		echo _AT_EDIT.": [ <a target=\"_blank\" href=\"admin.php?module=AutoTheme&amp;op=editfile&amp;themedir=$thistheme&amp;file=".$template['main']."\">"._AT_THISTEMPLATE."</a>  |  ";
		echo "<a target=\"_blank\" href=\"admin.php?module=AutoTheme&amp;op=atmain&amp;themedir=$thistheme\">"._AT_THISCONFIG."</a>  ]  ";
		echo "</div>";
		CloseTable();
	}
}

function at_config_display()
{
	if (!atIsAdminUser()) {
	    return;
	}
	$runningconfig = atGetRunningConfig();
    extract($runningconfig);
    	
    if (isset($_GET['at_admin'])) {
    	ob_end_clean();
    	OpenTable();
		eval($command['print-link']);
        echo "<h1>AutoTheme</h1><br />";

		switch ($_GET['at_admin']) {
			case "cmds":
			echo "<h2>"._AT_LOADEDCOMMANDS."</h2>";
			$commands = atRunningGetVar("command");
			
			foreach ($runningconfig as $cmd => $action) {
                $vars = " echo \$$cmd;";
            }
            $commands = array_merge((array)$commands, (array)$vars);
            
			echo "<table border=\"1\" width=\"100%\"><tr><td><b>"._AT_COMMAND."</b></td><td width=\"50%\"><b>"._AT_ACTION."</b></td><td width=\"50%\"><b>"._AT_RESULT."</b></td></tr>";
            foreach ($commands as $cmd => $action) {
                ob_start();
                eval($action);
                $result = ob_get_contents();
                ob_end_clean();

			    echo "<tr><td valign=\"top\">$cmd</td><td valign=\"top\">".htmlentities($action)."</td><td valign=\"top\">&nbsp;$result</td></tr>";
            }
            echo "</table>";
			break;
			
			case "at":
			//
			echo "<h2>"._AT_CONFIG."</h2>";
			echo "<table border=\"1\" width=\"100%\"><tr><td><b>"._AT_NAME."</b></td><td><b>"._AT_VALUE."</b></td></tr>";
			$atconfig = atGetAutoConfig();
            foreach ($atconfig as $name => $val) {
                if (is_array($val)) {
                    ob_start();
                    at_array_display($val);
                    $result = ob_get_contents();
                    ob_end_clean();
                }
                else {
                    $result = $val;
                }
                echo "<tr><td valign=\"top\">$name</td><td valign=\"top\">$result</td></tr>";
            }
            echo "</table>";
			break;

			case "theme":
			echo "<h2>"._AT_THEMECONFIG."</h2>";
        	echo "<table border=\"1\" width=\"100%\"><tr><td><b>"._AT_NAME."</b></td><td><b>"._AT_VALUE."</b></td></tr>";
			$themeconfig = atGetThemeConfig();
            foreach ($themeconfig as $name => $val) {
                if (is_array($val)) {
                    ob_start();
                    at_array_display($val);
                    $result = ob_get_contents();
                    ob_end_clean();
                }
                else {
                    $result = $val;
                }
                echo "<tr><td valign=\"top\">$name</td><td valign=\"top\">$result</td></tr>";
            }
            echo "</table>";
			break;

			case "running":
			echo "<h2>"._AT_RUNNINGCONFIG."</h2>";
        	echo "<table border=\"1\" width=\"100%\"><tr><td><b>"._AT_NAME."</b></td><td><b>"._AT_VALUE."</b></td></tr>";
			$runningconfig = atGetRunningConfig();
            foreach ($runningconfig as $name => $val) {
                if (is_array($val)) {
                    ob_start();
                    at_array_display($val);
                    $result = ob_get_contents();
                    ob_end_clean();
                }
                else {
                    $result = $val;
                }
                echo "<tr><td valign=\"top\">$name</td><td valign=\"top\">$result</td></tr>";
            }
            echo "</table>";
			break;
		}
		CloseTable();
        die();
	}
}
	
?>
