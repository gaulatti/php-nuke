<?php

if (!eregi("modules.php", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}

$index = 0;

function f2one() {
    include("header.php");
    OpenTable();
    echo "Addon Sample File (f2.php) function \"f2one\" CALLED FROM Sand_Journey Theme<br><br>";
    echo "<ul>";
    echo "<li><a href=\"modules.php?name=Addon_Sample&amp;file=f2&amp;func=f2go\">f2.php Main</a>";
    echo "<li><a href=\"modules.php?name=Addon_Sample&amp;file=index\">Go to index.php</a>";
    echo "</ul>";    
    CloseTable();
    include("footer.php");

}

function f2go() {
    include("header.php");
    OpenTable();
    echo "Addon Sample File (f2.php) CALLED FROM Sand_Journey Theme<br>";
    echo "<ul>";
    echo "<li><a href=\"modules.php?name=Addon_Sample&amp;file=f2&amp;func=f2one\">Function f2one</a>";
    echo "<li><a href=\"modules.php?name=Addon_Sample&amp;file=index&amp;func=dos\">Go to index.php</a>";
    echo "</ul>";
    echo "As you can see now, this page doesn't show the Right Blocks, this is because at the begining "
         ."of this file we set \$index variable to \"0\"";
    CloseTable();
    include("footer.php");
}

switch($func) {

    default:
    f2go();
    break;
    
    case "f2one":
    f2one();
    break;

}

?>