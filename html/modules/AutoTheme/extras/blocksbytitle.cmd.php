<?php 

// Commands for calling blocks by title

// All platforms
//
$blocklist = atBlockList();

foreach ($blocklist as $title) {
    $extracmd['all'][$title] = "atBlockDisplay('', '$title');";
}

?>
