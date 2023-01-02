<?php

require "Controller/AppController.php" ;


$php_self =  $_SERVER['PHP_SELF'];
$request_uri =  $_SERVER['REQUEST_URI'];

$php_self=str_replace("/","",$php_self);
$php_self=str_replace("index.php","/",$php_self);

$request_uri=str_replace($php_self,"",$request_uri);

//check api key
//verfiy_api_key();

$request = explode('/',$request_uri);

$controller = new AppController();
$controller->handle_rquest($request);



?>