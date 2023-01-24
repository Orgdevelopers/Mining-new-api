<?php

define('HOME_PATH', __DIR__);
require "Controller/AppController.php" ;


$php_self =  $_SERVER['PHP_SELF'];
$request_uri =  $_SERVER['REQUEST_URI'];

$php_self=str_replace("/","",$php_self);
$php_self=str_replace("index.php","/",$php_self);

$request_uri=str_replace($php_self,"",$request_uri);

//check api key
//verfiy_api_key();
if(strpos($request_uri,"?")){
    $request_uri = substr($request_uri,0,strpos($request_uri,"?") );
}

$request = explode('/',$request_uri);

echo $request_uri . "<br><br>";
echo json_encode($request);
die;

$controller = new AppController();
$controller->handle_rquest($request);



?>