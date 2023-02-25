<?php
require_once("config.php");

if (isset($_GET['action'])) {

  if ($_GET['action'] == "login") {
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
    $password = @$_POST['password'];

    $data = [
      "email" => $email,
      "password" => $password,
      "role" => "admin"
    ];

    $params = ['token'=>PasswordUtil::EncryptPassword(json_encode($data))];

    $url = API_URL . "adminlogin";

    $json_data = http_request($params, null, $url);

    // $json_data['code'] = "101";
    // $json_data['msg'] = "error";

    if ($json_data['code'] == '200') {
      $_SESSION[PRE_FIX . 'id'] = $json_data['msg']['id'];
      $_SESSION[PRE_FIX . 'role'] = 'admin';
      echo "<script>window.location='dashboard.php?p=servers'</script>";
    } else {
      $error_msg = $json_data['msg'];
      echo "<script>window.location='index.php?action=error&msg=" . $error_msg . "'</script>";
    }


  } else
  if ($_GET['action'] == "updateCryptoModel") {

    $data = $_POST;

    $url = API_URL . "updateCryptoModel";

    $json_data = http_request($data, null, $url);
    
    if ($json_data['code'] == "200") {
      returnToSettings(true);      
    } else {
      if (isset($json_data['msg'])) {
        $error = $json_data['msg'];
      } else {
        $error = json_encode($json_data);
      }
      $_SESSION[PRE_FIX . 'error'] = $error;
      returnToSettings(false);

    }

    /*  */

  }else 
  if($_GET['action'] == "updateAppSettings"){


      $data = $_POST;
      $url = API_URL . "updateAppSettings";
      $json_data = http_request($data, null, $url);

      if($json_data['code']=="200"){
        returnToSettings(true);

      }else{

        if (isset($json_data['msg'])) {
          $error = $json_data['msg'];
        } else {
          $error = json_encode($json_data);
        }
        $_SESSION[PRE_FIX . 'error'] = $error;
        returnToSettings(false);

      }

  }else 
  if($_GET['action']=="acceptWithdrawRequest"){
    
    if(isset($_GET['id'])){

      $data = array();
      $data['id'] = $_GET['id'];
      $data['token'] = PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']);

  
      $url = API_URL . "acceptWithdrawRequest";
  
      $json_data = http_request($data, $headers, $url);

      if($json_data['code']=="200"){
        returnToWithdrawReqeust(true);

      }else{

        if (isset($json_data['msg'])) {
          $error = $json_data['msg'];
        } else {
          $error = json_encode($json_data);
        }
        $_SESSION[PRE_FIX . 'error'] = $error;
        returnToWithdrawReqeust(false);

      }
  

    }else{
      $_SESSION[PRE_FIX.'error'] = "missing id";
      returnToWithdrawReqeust(false);
    }

  }else
  if($_GET['action']=="rejectWithdrawRequest"){
    if(isset($_GET['id'])){

      $data = array();
      if(isset($_POST['reason']) && $_POST['reason'] != ""){
        $data['reason'] = $_POST['reason'];
      }
      $data['id'] = $_GET['id'];
      $data['token'] = PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']);


      $url = API_URL . "rejectWithdrawRequest";
  
      $json_data = http_request($data, null, $url);

      if($json_data['code']=="200"){
        returnToWithdrawReqeust(true);

      }else{

        if (isset($json_data['msg'])) {
          $error = $json_data['msg'];
        } else {
          $error = json_encode($json_data);
        }
        $_SESSION[PRE_FIX . 'error'] = $error;
        returnToWithdrawReqeust(false);

      }
  

    }else{
      $_SESSION[PRE_FIX.'error'] = "missing id";
      returnToWithdrawReqeust(false);
    }


  }else
  if($_GET['action']=="acceptTaskRequest"){
    if(isset($_GET['id'])){

      $data = array();
      $data['id'] = $_GET['id'];
      $data['token'] = PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']);
  
      $url = API_URL . "acceptTaskRequest";
  
      $json_data = http_request($data, null, $url);

      if($json_data['code']=="200"){
        returnToTaskRequests(true);
        //echo json_encode($json_data);

      }else{

        if (isset($json_data['msg'])) {
          $error = $json_data['msg'];
        } else {
          $error = json_encode($json_data);
        }
        $_SESSION[PRE_FIX . 'error'] = $error;
        returnToTaskRequests(false);

      }


    }else{
      $_SESSION[PRE_FIX.'error'] = "id missing";
      returnToTaskRequests(false);
    }
    
  }else
  if($_GET['action']=="rejectTaskRequest"){
    if(isset($_GET['id'])){

      $data = array();
      if(isset($_POST['reason']) && $_POST['reason'] != ""){
        $data['reason'] = $_POST['reason'];
      }
      $data['id'] = $_GET['id'];
      $data['token'] = PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']);


      $url = API_URL . "rejectTaskRequest";
  
      $json_data = http_request($data, null, $url);

      if($json_data['code']=="200"){
        returnToTaskRequests(true);

      }else{

        if (isset($json_data['msg'])) {
          $error = $json_data['msg'];
        } else {
          $error = json_encode($json_data);
        }
        $_SESSION[PRE_FIX . 'error'] = $error;
        returnToTaskRequests(false);

      }
  

    }else{
      $_SESSION[PRE_FIX.'error'] = "missing id";
      returnToTaskRequests(false);
    }


  }else
  if($_GET['action']=="rejectServerPurchaseRequest"){
    if(isset($_GET['id'])){

      $data = array();
      if(isset($_POST['reason']) && $_POST['reason'] != ""){
        $data['reason'] = $_POST['reason'];
      }
      $data['id'] = $_GET['id'];
      $data['token'] = PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']);


      $url = API_URL . "rejectServerPurchaseRequest";
  
      $json_data = http_request($data, null, $url);

      if($json_data['code']=="200"){
        returnToServerPurchaseRequests(true);

      }else{

        if (isset($json_data['msg'])) {
          $error = $json_data['msg'];
        } else {
          $error = json_encode($json_data);
        }
        $_SESSION[PRE_FIX . 'error'] = $error;
        returnToServerPurchaseRequests(false);

      }
  

    }else{
      $_SESSION[PRE_FIX.'error'] = "missing id";
      returnToServerPurchaseRequests(false);
    }

  }else
  if($_GET['action']=="acceptServerPurchaseRequest"){

    if(isset($_GET['id'])){

      $data = array();
      $data['id'] = $_GET['id'];
      $data['token'] = PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']);
  
      $url = API_URL . "acceptServerPurchaseRequest";
  
      $json_data = http_request($data, null, $url);

      if($json_data['code']=="200"){
        returnToServerPurchaseRequests(true);
        //echo json_encode($json_data);

      }else{

        if (isset($json_data['msg'])) {
          $error = $json_data['msg'];
        } else {
          $error = json_encode($json_data);
        }
        $_SESSION[PRE_FIX . 'error'] = $error;
        returnToServerPurchaseRequests(false);

      }


    }else{
      $_SESSION[PRE_FIX.'error'] = "id missing";
      returnToServerPurchaseRequests(false);
    }

  }else
  if($_GET['action'] =="acceptInvestmentPurchaseRequest"){
      $data=$_POST;
      $data['id'] = $_GET['id'];
      $data['token'] = PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']);
      // echo json_encode($data);
      // return;

      $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
      ];

      $url = API_URL . "acceptInvestmentPurchaseRequest";
      //echo encrypt_password($password);

      $json_data = http_request($data, $headers, $url);

      if($json_data['code']=="200"){
        returnToInvestmentRequests(true);
        //echo json_encode($json_data);

      }else{

        if (isset($json_data['msg'])) {
          $error = $json_data['msg'];
        } else {
          $error = json_encode($json_data);
        }
        $_SESSION[PRE_FIX . 'error'] = $error;
        returnToInvestmentRequests(false);

      }

  }else 
  if($_GET['action']=="rejectInvestmentPurchaseRequest"){
    
    $data['id'] = $_GET['id'];
    if(isset($_POST['reason'])){
      $data['reason'] = $_POST['reason'];
    }
    $data['token'] = PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']);

    $headers = [
      "Accept: application/json",
      "Content-Type: application/json",
    ];

    $url = API_URL . "rejectInvestmentPurchaseRequest";
    //echo encrypt_password($password);

    $json_data = http_request($data, $headers, $url);

    if($json_data['code']=="200"){
      returnToInvestmentRequests(true);
      //echo json_encode($json_data);

    }else{

      if (isset($json_data['msg'])) {
        $error = $json_data['msg'];
      } else {
        $error = json_encode($json_data);
      }
      $_SESSION[PRE_FIX . 'error'] = $error;
      returnToInvestmentRequests(false);

    }

  }else
  if($_GET['action']=="updateTask"){

    $data = $_POST;
    $data['token'] = PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']);
    $headers = [
      "Accept: application/json",
      "Content-Type: application/json",
    ];

    $url = API_URL . "updateTask";
    //echo encrypt_password($password);

    $json_data = http_request($data, $headers, $url);

    if($json_data['code']=="200"){
      returnToTasks(true);
      //echo json_encode($json_data);

    }else{

      if (isset($json_data['msg'])) {
        $error = $json_data['msg'];
      } else {
        $error = json_encode($json_data);
      }
      $_SESSION[PRE_FIX . 'error'] = $error;
      returnToTasks(false);

    }

  }else
  if($_GET['action']=="deleteTask"){

    $data['id'] = $_GET['id'];
    $data['token'] = PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']);
    // echo json_encode($data);
    // return;

    $headers = [
      "Accept: application/json",
      "Content-Type: application/json",
    ];

    $url = API_URL . "deleteTask";
    //echo encrypt_password($password);

    $json_data = http_request($data, $headers, $url);

    if($json_data['code']=="200"){
      returnToTasks(true);
      //echo json_encode($json_data);

    }else{

      if (isset($json_data['msg'])) {
        $error = $json_data['msg'];
      } else {
        $error = json_encode($json_data);
      }
      $_SESSION[PRE_FIX . 'error'] = $error;
      returnToTasks(false);

    }

  }else
  if($_GET['action']=="addTask"){

    $data = array();
    
    $data['file'] = curl_file_create($_FILES['image']['tmp_name']);
    $data['token'] = PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']);

    $url = API_URL . "addTask";
    //echo encrypt_password($password);

    $json_data = http_request_file($url,$data);

    if($json_data['code'] == 200){
      returnToTasks(true);
      //echo json_encode($json_data);

    }else{

      if (isset($json_data['msg'])) {
        $error = $json_data['msg'];
      } else {
        $error = json_encode($json_data);
      }
      $_SESSION[PRE_FIX . 'error'] = $error;
      returnToTasks(false);

    }

  }else 
  if($_GET['action']=="editInvestmentPlan"){
    $data = $_POST;
    $data['id'] = $_GET['id'];
    $data['token'] = PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']);


    $url = API_URL . "editInvestmentPlan";
    //echo encrypt_password($password);

    $json_data = http_request($data, null, $url);

    if($json_data['code']=="200"){
      returnToInvestPlans(true);
      //echo json_encode($json_data);

    }else{

      if (isset($json_data['msg'])) {
        $error = $json_data['msg'];
      } else {
        $error = json_encode($json_data);
      }
      $_SESSION[PRE_FIX . 'error'] = $error;
      returnToInvestPlans(false);

    }

  }else
  if($_GET['action']=="deleteInvestmentPlan"){

    $data["id"] = $_GET['id']; 
    $data['token'] = PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']);
  

    $url = API_URL . "deleteInvestmentPlan";
    //echo encrypt_password($password);

    $json_data = http_request($data, null, $url);

    if($json_data['code']=="200"){
      returnToInvestPlans(true);
      //echo json_encode($json_data);

    }else{

      if (isset($json_data['msg'])) {
        $error = $json_data['msg'];
      } else {
        $error = json_encode($json_data);
      }
      $_SESSION[PRE_FIX . 'error'] = $error;
      returnToInvestPlans(false);

    }

  }else
  if($_GET['action']=="editServer"){

    $data = $_POST;
    $data["id"] = $_GET['id']; 
    $data['token'] = PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']);
  

    $url = API_URL . "editServer";
    //echo encrypt_password($password);

    $json_data = http_request($data, null, $url);

    if($json_data['code']=="200"){
      returnToServers(true);
      //echo json_encode($json_data);

    }else{

      if (isset($json_data['msg'])) {
        $error = $json_data['msg'];
      } else {
        $error = json_encode($json_data);
      }
      $_SESSION[PRE_FIX . 'error'] = $error;
      returnToServers(false);

    }

  }else
  if($_GET['action']=="deleteServer"){

    $data["id"] = $_GET['id']; 
    $data['token'] = PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']);
  

    $url = API_URL . "deleteServer";
    //echo encrypt_password($password);

    $json_data = http_request($data, null, $url);

    if($json_data['code']=="200"){
      returnToServers(true);
      //echo json_encode($json_data);

    }else{

      if (isset($json_data['msg'])) {
        $error = $json_data['msg'];
      } else {
        $error = json_encode($json_data);
      }
      $_SESSION[PRE_FIX . 'error'] = $error;
      returnToServers(false);

    }

  }else
  if($_GET['action']=="createServer"){

    $data = $_POST;
    $data['token'] = PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']);
  

    $url = API_URL . "createServer";
    //echo encrypt_password($password);

    $json_data = http_request($data, null, $url);

    echo json_encode($json_data);
    die;
    if($json_data['code']=="200"){
      returnToServers(true);
      //echo json_encode($json_data);

    }else{

      if (isset($json_data['msg'])) {
        $error = $json_data['msg'];
      } else {
        $error = json_encode($json_data);
      }
      $_SESSION[PRE_FIX . 'error'] = $error;
      returnToServers(false);

    }

  }else
  if($_GET['action']=="createInvestmentPlan"){

    $data = $_POST;
    $data['token'] = PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']);
  

    $url = API_URL . "createInvestmentPlan";
    //echo encrypt_password($password);

    $json_data = http_request($data, null, $url);

    if($json_data['code']=="200"){
      returnToInvestPlans(true);
      //echo json_encode($json_data);

    }else{

      if (isset($json_data['msg'])) {
        $error = $json_data['msg'];
      } else {
        $error = json_encode($json_data);
      }
      $_SESSION[PRE_FIX . 'error'] = $error;
      returnToInvestPlans(false);

    }

  }

  
}

function returnToSettings($success){
  if($success){
    echo "<script>window.location = 'dashboard.php?p=appSettings&action=success'</script>";
  }else{
    echo "<script>window.location = 'dashboard.php?p=appSettings&action=error'</script>";
  }
}

function returnToWithdrawReqeust($success){
  if($success){
    echo "<script>window.location = 'dashboard.php?p=withdrawalrequests&action=success'</script>";
  }else{
    echo "<script>window.location = 'dashboard.php?p=withdrawalrequests&action=error'</script>";
  }
}

function returnToTaskRequests($success){
  if($success){
    echo "<script>window.location = 'dashboard.php?p=taskRequests&action=success'</script>";
  }else{
    echo "<script>window.location = 'dashboard.php?p=taskRequests&action=error'</script>";
  }
}

function returnToServerPurchaseRequests($success){
  if($success){
    echo "<script>window.location = 'dashboard.php?p=purchaserequests&action=success'</script>";
  }else{
    echo "<script>window.location = 'dashboard.php?p=purchaserequests&action=error'</script>";
  }
}

function returnToInvestmentRequests($success){
  if($success){
    echo "<script>window.location = 'dashboard.php?p=investmentRequests&action=success'</script>";
  }else{
    echo "<script>window.location = 'dashboard.php?p=investmentRequests&action=error'</script>";
  }

}

function returnToTasks($success){

  if($success){
    echo "<script>window.location = 'dashboard.php?p=tasks&action=success'</script>";
  }else{
    echo "<script>window.location = 'dashboard.php?p=tasks&action=error'</script>";
  }

}

function returnToInvestPlans($success){

  if($success){
    echo "<script>window.location = 'dashboard.php?p=investmentPlans&action=success'</script>";
  }else{
    echo "<script>window.location = 'dashboard.php?p=investmentPlans&action=error'</script>";
  }

}

function returnToServers($success){

  if($success){
    echo "<script>window.location = 'dashboard.php?p=servers&action=success'</script>";
  }else{
    echo "<script>window.location = 'dashboard.php?p=servers&action=error'</script>";
  }

}

function encrypt_password($pass)
{

  $privateKey   = 'CAPITAL09KEYFORTESTING33HQ1HQ2HQ3L0L';
  $secretKey     = '1j2gh28i3h9';
  $encryptMethod      = "AES-256-CBC";
  $string     = $pass;

  $key = hash('sha256', $privateKey);
  $ivalue = substr(hash('sha256', $secretKey), 0, 16); // sha256 is hash_hmac_algo
  $result = openssl_encrypt($string, $encryptMethod, $key, 0, $ivalue);
  $output = base64_encode($result);  // output is a encripted value

  return $output;
}
