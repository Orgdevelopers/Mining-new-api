<?php

function getAllPlans(){
    
    $data = [
        "token" => PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']),
    ];
    
    $url = API_URL."showAllPlans";

    $json_data = http_request($data,null,$url);

    if($json_data != null && $json_data['code']=="200"){
        $output=$json_data['msg'];

    }else{
        $output=[];

    }
    return $output;


}

function getAllInvestPlans(){
    
    $data = [
        "token" => PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']),
    ];
    
    $url = API_URL."showAllInvestPlans";

    $json_data = http_request($data,null,$url);

    if($json_data != null && $json_data['code']=="200"){
        $output=$json_data['msg'];

    }else{
        $output=[];

    }
    return $output;


}


function getAllTasks(){
    
    $data = [
        "token" => PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']),
    ];
    
    $url = API_URL."showAllTasks";

    $json_data = http_request($data,null,$url);

    if($json_data != null && $json_data['code']=="200"){
        $output=$json_data['msg'];

    }else{
        $output=[];

    }
    return $output;


}

function loadImage($url){
    if(str_contains($url,"http") && strpos($url,"http") <255 ){
        return $url;
    }else{
        return imagebaseurl.$url;
    }
}
function showInvestmentRequests(){
    
    $data = [
        "token" => PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']),
    ];
    
    $url = API_URL."showInvestmentRequests";

    $json_data = http_request($data,null,$url);

    if($json_data != null && $json_data['code']=="200"){
        $output=$json_data['msg'];

    }else{
        $output=[];

    }
    return $output;


}


function getAllUsers()
{
    $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
        
    ];
    
    $data = [
        "token" => PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']),
    ];

    $url = API_URL."showallUsers";

    //echo encrypt_password($password);

    $json_data = ApiRequest($data,$headers,$url);

    if($json_data != null && $json_data['code']=="200"){
        $output=$json_data['msg'];

    }else{
        $output=[];

    }
    return $output;
}


function ApiRequest($data,$headers,$url)
{
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

function findPlan($allplans,$single_row)
{
    if(isset($single_row['plan'])){
        $plan_id = $single_row['plan'];
    }else{
        $plan_id = $single_row['plan_id'];
    }
    
    $i =0;

    $output = "Unknown";

    for( $i;$i<count($allplans);$i++){
        if($allplans[$i]['id']==$plan_id){
            $output = $allplans[$i]['name'];
            break;
        }

    }


    echo $output;

}

function findPlanInvest($allplans,$single_row)
{
    // if(isset($single_row['plan'])){
    //     $plan_id = $single_row['plan'];
    // }else{
        $plan_id = $single_row['investment_plan_id'];
    // }
    
    $i =0;

    $output = "Unknown";

    for( $i;$i<count($allplans);$i++){
        if($allplans[$i]['id']==$plan_id){
            $output = $allplans[$i]['name'];
            break;
        }

    }


    echo $output;

}

function getAllRefundRequests(){
    $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
        
    ];
    
    $data = [
        "show_all"=>true
    ];
    
    $url = API_URL."getallrefundrequests";

    //echo encrypt_password($password);

    $json_data = ApiRequest($data,$headers,$url);

    if($json_data != null && $json_data['code']=="200"){
        $output=$json_data['msg'];

    }else{
        $output=[];

    }
    return $output;


}

function getAllAdminWallets(){
    $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
        
    ];
    
    $data = [
        "token" => PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']),
    ];
    
    $url = API_URL."getadminwallets";

    //echo encrypt_password($password);

    $json_data = ApiRequest($data,$headers,$url);

    if($json_data != null && $json_data['code']=="200"){
        $output=$json_data['msg'];

    }else{
        $output=[];

    }
    return $output;

}

function getInvestPlanDetails($id){
    $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
        
    ];
    
    $data = [
        'id' => $id,
        "token" => PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']),
    ];
    
    $url = API_URL."getInvestPlanDetails";

    //echo encrypt_password($password);

    $json_data = http_request($data,null,$url);

    if($json_data != null && $json_data['code']=="200"){
        $output=$json_data['msg'];

    }else{
        $output=[];

    }
    return $output;

}

function getPlanDetails($id){

    $data = [
        'id' => $id,
        "token" => PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']),
    ];
    
    $url = API_URL."getPlanDetails";

    //echo encrypt_password($password);

    $json_data = http_request($data,null,$url);

    if($json_data != null && $json_data['code']=="200"){
        $output=$json_data['msg'];

    }else{
        $output=[];

    }
    return $output;

}


function getAllPurchaseRequests()
{
    $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
        
    ];
    
    $data = [
        "token" => PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']),
    ];
    
    $url = API_URL."showServerPurchaseRequests";

    //echo encrypt_password($password);

    $json_data = ApiRequest($data,$headers,$url);

    if($json_data != null && $json_data['code']=="200"){
        $output=$json_data['msg'];

    }else{
        $output=[];

    }
    return $output;
}


function getAllTaskRequests()
{
    $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
        
    ];
    
    $data = [
        "token" => PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']),
    ];
    
    $url = API_URL."showAllTaskRequests";

    //echo encrypt_password($password);

    $json_data = ApiRequest($data,$headers,$url);

    if($json_data != null && $json_data != null && $json_data['code']=="200"){
        $output=$json_data['msg'];

    }else{
        $output=[];

    }
    return $output;
}


function getallWithdrawalRequests(){
    $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
        
    ];
    
    $data = [
        "token" => PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']),
    ];
    
    $url = API_URL."showAllWithdrawRequests";

    //echo encrypt_password($password);

    $json_data = ApiRequest($data,$headers,$url);

    if($json_data != null && $json_data['code']=="200"){
        $output=$json_data['msg'];

    }else{
        $output=[];

    }
    return $output;

}


function getAppSettings(){
    $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
        
    ];
    
    $data = [
        "token" => PasswordUtil::EncryptPassword($_SESSION[PRE_FIX . 'id']),
    ];
    
    $url = API_URL."getAppSettingsAdmin";
    
    //echo encrypt_password($password);

    $json_data = ApiRequest($data,$headers,$url);

    if($json_data != null && $json_data['code']=="200"){
        $output=$json_data['msg'];

    }else{
        $output=[];

    }
    return $output;

}

function getPlanInfo($id){
    $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
        
    ];
    
    $data = ["id"=>$id];
    
    $url = API_URL."getplandetails";

    //echo encrypt_password($password);

    $json_data = ApiRequest($data,$headers,$url);

    if($json_data != null && $json_data['code']=="200"){
        $output=$json_data['msg'];

    }else{
        $output=[];

    }
    return $output;

}

function getuserDetails($id)
{
    $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
        
    ];
    
    $data = ["id"=>$id];
    
    $url = API_URL."getuserdetails";

    //echo encrypt_password($password);

    $json_data = ApiRequest($data,$headers,$url);

    if($json_data != null && $json_data['code']=="200"){
        $output=$json_data['msg'];

    }else{
        $output=[];

    }
    return $output;

}

function getWalletAddressDetails($id){
    $all = getAllAdminWallets();

    for($i=0;$i<count($all);$i++){
        if($all[$i]['id']==$id){
            return $all[$i];
            break;
        }

    }

    return null;

}

?>