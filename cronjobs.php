<?php
require_once("Config/config.php");

bitcoinRateUpdate();

function bitcoinRateUpdate(){
    $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
        "api-key: "
    ];
    
    $url = BASE_URL."api/getBitcoinRateFromApi";

    // echo "<script>window.location='$url'</script>";
    // //exit();

    $data = array();
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $return = curl_exec($ch);
    $json_data = json_decode($return, true);
      
    
    $curl_error = curl_error($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
}

?>

