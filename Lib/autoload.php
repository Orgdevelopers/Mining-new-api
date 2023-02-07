<?php

// require 'Utility.php';
// require 'Functions.php';
// require 'Response.php'

if ($handle = opendir(__DIR__)) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            if($entry != "autoload.php"){
                require $entry;
            }

        }
    }

    closedir($handle);
}

?>