<?php

@session_start();
@ini_set('session.gc_maxlifetime',12*60*60);
@ini_set('session.cookie_lifetime',12*60*60);

error_reporting(E_ALL);

define('PRE_FIX' , "prohash_");
define('APP_NAME',"TEST");

try {
  require '../Lib/PasswordUtil.php';
} catch (\Throwable $th) {
  //throw $th;
}

//Access Your API URL in browser and you will get a code to put over here that will be something like this https://prnt.sc/w309sg

$baseurl = "https://hosting.tiktalkvideo.online/";
//$baseurl = "http://localhost/new_api/";
$baseurl = str_replace("admin-cp","",$baseurl);
// $api_url =  

//detailed path to web folder in server ex. /home/server/public_html/web/;
$HOME_PATH=__DIR__."uploads/";


//dont change any thing here
$imagebaseurl=$baseurl;
$baseurl = $baseurl."admin/";

define('homepath' , $HOME_PATH);
define('imagebaseurl' , $imagebaseurl);
define('API_URL',$baseurl);
define('HOME_PATH',$HOME_PATH);
define('API_KEY', '115cds-9857-5789-4433-0011');



function http_request($data, $h, $url)
{
  
  $headers = [
    "Accept: application/json",
    "Content-Type: application/json",
    "Api-Key: ".API_KEY,
  ];

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $return = curl_exec($ch);

  $json_data = json_decode($return, true);


  $curl_error = curl_error($ch);
  $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  return $json_data;
}


function http_request_file($url,$data)
{
  $headers = [
    "Accept: application/json",
    "Content-Type: application/json",
    "Api-Key: ".API_KEY,
  ];

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,($data));
  //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $return = curl_exec($ch);

  $json_data = json_decode($return, true);
  $curl_error = curl_error($ch);
  $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  return $json_data;
}


if(@$_GET['p'] == "logout" ) 
{ 
	@session_destroy();
	echo "<script>window.location='index.php'</script>";
}


?>
