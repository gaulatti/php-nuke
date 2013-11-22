<?php

if (!eregi("modules.php", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}

$index = 1;

function one() {
    include("header.php");
    OpenTable();
    echo "Addon Sample File (index.php) function \"one\" CALLED FROM Sand_Journey Theme<br><br>";
    echo "<ul>";
    echo "<li><a href=\"modules.php?name=Addon_Sample&amp;file=index\">Go to index.php</a>";
    echo "</ul>";
    CloseTable();
    include("footer.php");

}

function two() {
    include("header.php");
    OpenTable();
    echo "Addon Sample File (index.php) function \"two\" CALLED FROM Sand_Journey Theme";
    echo "<ul>";
    echo "<li><a href=\"modules.php?name=Addon_Sample&amp;file=index\">Go to index.php</a>";
    echo "</ul>";
    CloseTable();
    include("footer.php");

}


function AddonSample() {
    include("header.php");
    OpenTable();
    echo "Addon Sample File (index.php) CALLED FROM Sand_Journey Theme<br><br>";
    echo "<ul>";
    echo "<li><a href=\"modules.php?name=Addon_Sample&amp;file=index&amp;func=one\">Function One</a>";
    echo "<li><a href=\"modules.php?name=Addon_Sample&amp;file=index&amp;func=two\">Function Two</a>";
    echo "<li><a href=\"modules.php?name=Addon_Sample&amp;file=f2\">Call to file f2.php</a>";
    echo "</ul>";
    echo "You can now use Administration interface to activate or deactivate any module. As an Admin you can always "
         ."access to your Inactive modules for testing purpouses.";
    CloseTable();
    include("footer.php");
}

switch($func) {

    default:
    AddonSample();
    break;
    
    case "one":
    one();
    break;

    case "two":
    two();
    break;

}

?>