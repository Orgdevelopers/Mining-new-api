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
      echo "<script>window.location='dashboard.php?p=plans'</script>";
    } else {
      $error_msg = $json_data['msg'];
      echo "<script>window.location='index.php?action=error&msg=" . $error_msg . "'</script>";
    }


  } else
  if ($_GET['action'] == "creatPlan") {

    $data = $_POST;
    $headers = [
      "Accept: application/json",
      "Content-Type: application/json",

    ];

    $url = API_URL . "createplan";

    //echo encrypt_password($password);

    $json_data = http_request($data, $headers, $url);

    if ($json_data['code'] == "200") {
      return_to_plans(true);      
    } else {
      if (isset($json_data['msg'])) {
        $error = $json_data['msg'];
      } else {
        $error = json_encode($json_data);
      }
      $_SESSION[PRE_FIX . 'error'] = $error;
      return_to_plans(false);


    }

  }else 
  if($_GET['action'] == "deletePlan"){

    if(isset($_GET['id'])){

      $data['id'] = $_GET['id'];
      
      $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
      ];
  
      $url = API_URL . "deleteplan";
      //echo encrypt_password($password);
  
      $json_data = http_request($data, $headers, $url);

      if($json_data['code']=="200"){
        return_to_plans(true);

      }else{

        if (isset($json_data['msg'])) {
          $error = $json_data['msg'];
        } else {
          $error = json_encode($json_data);
        }
        $_SESSION[PRE_FIX . 'error'] = $error;
        return_to_plans(false);

      }
  

    }else{
      return_to_plans(false);
    }

  }else 
  if($_GET['action']=="updatePlan"){
    
    if(isset($_GET['id'])){

      $data = $_POST;
      $data['id'] = $_GET['id'];

      $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
      ];
  
      $url = API_URL . "updateplan";
      //echo encrypt_password($password);
  
      $json_data = http_request($data, $headers, $url);

      if($json_data['code']=="200"){
        return_to_plans(true);

      }else{

        if (isset($json_data['msg'])) {
          $error = $json_data['msg'];
        } else {
          $error = json_encode($json_data);
        }
        $_SESSION[PRE_FIX . 'error'] = $error;
        return_to_plans(false);

      }
  

    }else{
      $_SESSION[PRE_FIX.'error'] = "missing id";
      return_to_plans(false);
    }

  }else
  if($_GET['action']=="updateUser"){
    if(isset($_GET['id'])){

      $data = $_POST;
      $data['id'] = $_GET['id'];
      // echo json_encode($data);
      // return;

      $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
      ];
  
      $url = API_URL . "updateuser";
      //echo encrypt_password($password);
  
      $json_data = http_request($data, $headers, $url);

      if($json_data['code']=="200"){
        return_to_users(true);
        //echo json_encode($json_data);

      }else{

        if (isset($json_data['msg'])) {
          $error = $json_data['msg'];
        } else {
          $error = json_encode($json_data);
        }
        $_SESSION[PRE_FIX . 'error'] = $error;
        return_to_users(false);

      }


    }else{
      $_SESSION[PRE_FIX.'error'] = "id missing";
      return_to_users(false);
    }




  }else
  if($_GET['action']=="delete_refund_request"){
    if(isset($_GET['id'])){

      //$data = $_POST;
      $data['id'] = $_GET['id'];
      // echo json_encode($data);
      // return;

      $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
      ];
  
      $url = API_URL . "deleterefundrequest";
      //echo encrypt_password($password);
  
      $json_data = http_request($data, $headers, $url);

      if($json_data['code']=="200"){
        return_to_refund(true);
        //echo json_encode($json_data);

      }else{

        if (isset($json_data['msg'])) {
          $error = $json_data['msg'];
        } else {
          $error = json_encode($json_data);
        }
        $_SESSION[PRE_FIX . 'error'] = $error;
        return_to_refund(false);

      }


    }else{
      $_SESSION[PRE_FIX.'error'] = "id missing";
      return_to_refund(false);
    }
    
  }else
  if($_GET['action']=="reject_refund_request"){
    if(isset($_GET['id'])){

      $data = $_POST;
      $data['id'] = $_GET['id'];
      // echo json_encode($data);
      // return;

      $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
      ];
  
      $url = API_URL . "reject_refund_request";
      //echo encrypt_password($password);
  
      $json_data = http_request($data, $headers, $url);

      if($json_data['code']=="200"){
        return_to_refund(true);
        //echo json_encode($json_data);

      }else{

        if (isset($json_data['msg'])) {
          $error = $json_data['msg'];
        } else {
          $error = json_encode($json_data);
        }
        $_SESSION[PRE_FIX . 'error'] = $error;
        return_to_refund(false);

      }


    }else{
      $_SESSION[PRE_FIX.'error'] = "id missing";
      return_to_refund(false);
    }

  }else
  if($_GET['action']=="accept_refund_requet"){
    if(isset($_GET['id'])){

      $data = $_POST;
      $data['id'] = $_GET['id'];
      // echo json_encode($data);
      // return;

      $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
      ];
  
      $url = API_URL . "accept_refund_requet";
      //echo encrypt_password($password);
  
      $json_data = http_request($data, $headers, $url);

      if($json_data['code']=="200"){
        return_to_refund(true);
        //echo json_encode($json_data);

      }else{

        if (isset($json_data['msg'])) {
          $error = $json_data['msg'];
        } else {
          $error = json_encode($json_data);
        }
        $_SESSION[PRE_FIX . 'error'] = $error;
        return_to_refund(false);

      }


    }else{
      $_SESSION[PRE_FIX.'error'] = "id missing";
      return_to_refund(false);
    }

  }else
  if($_GET['action']=="delete_wallet_address"){

    if(isset($_GET['id'])){

      $data['id'] = $_GET['id'];
      // echo json_encode($data);
      // return;

      $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
      ];
  
      $url = API_URL . "delete_wallet_address";
      //echo encrypt_password($password);
  
      $json_data = http_request($data, $headers, $url);

      if($json_data['code']=="200"){
        return_to_wallets(true);
        //echo json_encode($json_data);

      }else{

        if (isset($json_data['msg'])) {
          $error = $json_data['msg'];
        } else {
          $error = json_encode($json_data);
        }
        $_SESSION[PRE_FIX . 'error'] = $error;
        return_to_wallets(false);

      }


    }else{
      $_SESSION[PRE_FIX.'error'] = "id missing";
      return_to_wallets(false);
    }

  }else
  if($_GET['action'] =="editwalletaddress"){
      $data=$_POST;
      $data['id'] = $_GET['id'];
      // echo json_encode($data);
      // return;

      $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
      ];

      $url = API_URL . "editwalletaddress";
      //echo encrypt_password($password);

      $json_data = http_request($data, $headers, $url);

      if($json_data['code']=="200"){
        return_to_wallets(true);
        //echo json_encode($json_data);

      }else{

        if (isset($json_data['msg'])) {
          $error = $json_data['msg'];
        } else {
          $error = json_encode($json_data);
        }
        $_SESSION[PRE_FIX . 'error'] = $error;
        return_to_wallets(false);

      }

  }else 
  if($_GET['action']=="createwalletaddress"){
    $data=$_POST;
    // echo json_encode($data);
    // return;

    $headers = [
      "Accept: application/json",
      "Content-Type: application/json",
    ];

    $url = API_URL . "createwalletaddress";
    //echo encrypt_password($password);

    $json_data = http_request($data, $headers, $url);

    if($json_data['code']=="200"){
      return_to_wallets(true);
      //echo json_encode($json_data);

    }else{

      if (isset($json_data['msg'])) {
        $error = $json_data['msg'];
      } else {
        $error = json_encode($json_data);
      }
      $_SESSION[PRE_FIX . 'error'] = $error;
      return_to_wallets(false);

    }

  }else
  if($_GET['action']=="acceptpurchaserequest"){
    $data['id'] = $_GET['id'];
    // echo json_encode($data);
    // return;

    $headers = [
      "Accept: application/json",
      "Content-Type: application/json",
    ];

    $url = API_URL . "acceptpurchaserequest";
    //echo encrypt_password($password);

    $json_data = http_request($data, $headers, $url);

    if($json_data['code']=="200"){
      return_to_purchase_req(true);
      //echo json_encode($json_data);

    }else{

      if (isset($json_data['msg'])) {
        $error = $json_data['msg'];
      } else {
        $error = json_encode($json_data);
      }
      $_SESSION[PRE_FIX . 'error'] = $error;
      return_to_purchase_req(false);

    }

  }else
  if($_GET['action']=="deletepurchaserequest"){

    $data['id'] = $_GET['id'];
    // echo json_encode($data);
    // return;

    $headers = [
      "Accept: application/json",
      "Content-Type: application/json",
    ];

    $url = API_URL . "deletepurchaserequest";
    //echo encrypt_password($password);

    $json_data = http_request($data, $headers, $url);

    // if($json_data['code']=="200"){
       return_to_purchase_req(true);
    //   //echo json_encode($json_data);

    // }else{

    //   if (isset($json_data['msg'])) {
    //     $error = $json_data['msg'];
    //   } else {
    //     $error = json_encode($json_data);
    //   }
    //   $_SESSION[PRE_FIX . 'error'] = $error;
    //   return_to_purchase_req(false);

    //}

  }else
  if($_GET['action']=="accept_withdrawal_request"){

    $data["id"] = $_GET['id']; 
    $headers = [
      "Accept: application/json",
      "Content-Type: application/json",
    ];

    $url = API_URL . "accept_withdrawal_request";
    //echo encrypt_password($password);

    $json_data = http_request($data, $headers, $url);

    if($json_data['code']=="200"){
      return_to_withdrawalrequests(true);
      //echo json_encode($json_data);

    }else{

      if (isset($json_data['msg'])) {
        $error = $json_data['msg'];
      } else {
        $error = json_encode($json_data);
      }
      $_SESSION[PRE_FIX . 'error'] = $error;
      return_to_withdrawalrequests(false);

    }

  }else 
  if($_GET['action']=="reject_withdrawal_request"){
    $data["id"] = $_GET['id']; 
    $headers = [
      "Accept: application/json",
      "Content-Type: application/json",
    ];

    $url = API_URL . "reject_withdrawal_request";
    //echo encrypt_password($password);

    $json_data = http_request($data, $headers, $url);

    if($json_data['code']=="200"){
      return_to_withdrawalrequests(true);
      //echo json_encode($json_data);

    }else{

      if (isset($json_data['msg'])) {
        $error = $json_data['msg'];
      } else {
        $error = json_encode($json_data);
      }
      $_SESSION[PRE_FIX . 'error'] = $error;
      return_to_withdrawalrequests(false);

    }

  }else
  if($_GET['action']=="delete_withdrawal_request"){
    $data["id"] = $_GET['id']; 
    $headers = [
      "Accept: application/json",
      "Content-Type: application/json",
    ];

    $url = API_URL . "delete_withdrawal_request";
    //echo encrypt_password($password);

    $json_data = http_request($data, $headers, $url);

    if($json_data['code']=="200"){
      return_to_withdrawalrequests(true);
      //echo json_encode($json_data);

    }else{

      if (isset($json_data['msg'])) {
        $error = $json_data['msg'];
      } else {
        $error = json_encode($json_data);
      }
      $_SESSION[PRE_FIX . 'error'] = $error;
      return_to_withdrawalrequests(false);

    }

  }

  
}

function return_to_withdrawalrequests($success){
  if($success){
    echo "<script>window.location = 'dashboard.php?p=withdrawalrequests&action=success'</script>";
  }else{
    echo "<script>window.location = 'dashboard.php?p=withdrawalrequests&action=error'</script>";
  }
}

function return_to_purchase_req($success){
  if($success){
    echo "<script>window.location = 'dashboard.php?p=purchaserequests&action=success'</script>";
  }else{
    echo "<script>window.location = 'dashboard.php?p=purchaserequests&action=error'</script>";
  }
}

function return_to_wallets($success){
  if($success){
    echo "<script>window.location = 'dashboard.php?p=walletaddress&action=success'</script>";
  }else{
    echo "<script>window.location = 'dashboard.php?p=walletaddress&action=error'</script>";
  }
}

function return_to_refund($success){
  if($success){
    echo "<script>window.location = 'dashboard.php?p=refundcontroller&action=success'</script>";
  }else{
    echo "<script>window.location = 'dashboard.php?p=refundcontroller&action=error'</script>";
  }
}

function return_to_users($success){
  if($success){
    echo "<script>window.location = 'dashboard.php?p=users&action=success'</script>";
  }else{
    echo "<script>window.location = 'dashboard.php?p=users&action=error'</script>";
  }

}

function return_to_plans($success){

  if($success){
    echo "<script>window.location = 'dashboard.php?p=plans&action=success'</script>";
  }else{
    echo "<script>window.location = 'dashboard.php?p=plans&action=error'</script>";
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
