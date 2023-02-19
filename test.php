<?php

if(isset($_GET['count'])){
    for ($i=0; $i < $_GET['count']; $i++) { 
        $id = uniqid();
        http_request($id);
        echo $id;
    }
}

function http_request($id)
{
  
  $headers = [
    "Accept: application/json",
    "Content-Type: application/json",
    // "Api-Key: ".API_KEY,
  ];

  $data = json_decode('{"keyword":"s","type":"video","fb_id":104351654356974015566,"video_id":6186,"action":1}',true);
  $data['fb_id'] = $id;

  $ch = curl_init("http://shodio.in/API/home_sec.php?p=likeDislikeVideo");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $return = curl_exec($ch);

  curl_close($ch);
  //return $json_data;
}

?>

<form action="test.php" method="get">
    <input type="number" name="count" id="count">
    <input type="submit" value="submit">
</form>