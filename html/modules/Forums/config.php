<?php

if(defined('INSIDE_MOD')) {
    @include_once("mainfile.php");
} else {
    @include_once("../../mainfile.php");
}
define('PHPBB_INSTALLED', true);

?>