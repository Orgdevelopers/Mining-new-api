<?php
require 'AppModel.php';

if ($handle = opendir(__DIR__)) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            if($entry != "autoload.php" && $entry != "AppModel.php"){
                require $entry;
            }

        }
    }

    closedir($handle);
}
// die;

// require 'AppModel.php';
// require 'Plans.php';
// require 'User.php';
// require 'LiveRate.php';
// require 'Wallets.php';
// require 'Transactions.php';
// require 'AppSettings.php';

?>