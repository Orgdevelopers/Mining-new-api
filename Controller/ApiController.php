<?php

class ApiController extends Controller {

    public $params = [];

    public function index(){
        /*
        *100-199 informative (yellow indecation)
        * 100 - no records
        * 110 - already exists 
        *
        * 112 - no username acc
        * 113 - no accound found on email
        * 114 - user not found
        *  
        *
        *
        *200 - success or semi success (mostly green indecation)
        *
        * 201 - failed to send email
        *
        *
        *300 - redirection, work in progress (yellow)
        *
        *400 - error, rejected, (RED)
        * 
        * 401 - auth failed
        * 402 - request failed, rejected
        * 404 - not found
        *
        *500 - serious server issue (RED)
        *
        *
        */
        //echo '(`id`, `active_miners`, `quantity`, `version_code`, `version`, `force_update`, `updated`) <br> <br>';


        $email = sendWelcomeEmail('kinddusingh1k2k3@gmail.com', "username", 2);

        die;
        $this->loadModel('Plans');

        echo json_encode($this->Plans->showDetailById(1));
        die;
        
        $methods = get_class_methods($this);
        foreach($methods as $method){
            echo $method."<br>";
        }
        $this->showChart();
        $this->showChart2();

    }

    public function __construct(){
        $json_data = json_decode(file_get_contents("php://input"), true);
        if ($json_data==null) {
            $json_data = array();
        }
        $post = $_POST;
        $get = $_GET;
        $this->params = array_merge($json_data, $post, $get);

    }


    public function showAllPlans(){

        $this->loadModel('Plans');
        if (isset($this->params['user_id'])) {

            $plans = $this->plans->showUserDefault($this->params['user_id']);
        }else{
            $plans = $this->Plans->showAllDefault();
        }

        if ($plans) {

            $output = array(

                'code' => 200,
                'msg' => $plans
            );
            
        }else{
            $output = array(
                'code' => 100,
                'msg' => "no plans found in database"
            );

        }

        echo json_encode($output);

    }

    public function login() //112
    {

        if(isset($this->params['password'])){
            $this->loadModel('User');
            $this->loadModel('Wallets');

            if(isset($this->params['username'])){
                //username login
                
                $user = $this->User->showDetailsByUsername($this->params['username']);
                if($user){
                    $db_password = $user['password'];
                    $password = $this->params['password'];

                    $wallets = $this->Wallets->getUserWallets($user['id']);

                    if(ValidatePassword($password,$db_password,$user['email'])){
                        //password matched
                        $output = array(
                            'code' => 200,
                            'msg' => array('User'=>$user, 'Wallets'=>$wallets)
                        );
                        echo json_encode($output);
                   

                    }else{
                        //password not matched
                        Response::AuthFailed("Password did not matched");

                    } 
                    die;
                    
                }else{
                    $output = array(
                        'code' => 112,
                        'dev_msg' => 'no account matched to this username:'.$this->params['username'],
                        'msg' => 'No account matched to username or email'
                    );
                    echo json_encode($output);
                    die;
                }

            }else{
                //email login

                $user = $this->User->showDetailsByEmail($this->params['email']);
                if($user){
                    $db_password = $user['password'];
                    $password = $this->params['password'];

                    $wallets = $this->Wallets->getUserWallets($user['id']);

                    if(ValidatePassword($password,$db_password,$user['email'])){
                        //password matched
                        $output = array(
                            'code' => 200,
                            'msg' => array('User'=>$user, 'Wallets'=>$wallets)
                        );
                        echo json_encode($output);
                   

                    }else{
                        //password not matched
                        Response::AuthFailed("Password did not matched");

                    } 
                    die;
                    
                }else{
                    $output = array(
                        'code' => 113,
                        'dev_msg' => 'no account matched to this email:'.$this->params['email'],
                        'msg' => 'No account matched to username or email'
                    );
                    echo json_encode($output);
                    die;
                }

            }

        }else{
            Response::IncompleteParams();
        }
        
    }


    public function planPurchase()
    {
        if(isset($this->params['user_id']) && $this->params['plan_id']){

            $this->loadModels(['User','Miners','Plans','Transactions']);

            $user_id = $this->params['user_id'];
            $plan_id = $this->params['plan_id'];

            $plan_details = $this->Plans->showDetailById($plan_id);

            $date = Utility::GetTimeStamp();

            $user_update = array('id'=>$user_id, 'plan'=>$plan_id, 'plan_purchased'=> $date );
            $result = $this->User->update($user_update);

            if($result){
                $this->Miners->create($user_id, $plan_id, 0);
                $t_data = array(
                    'type' => 0,
                    'wallet_type' => 3,
                    'title' => "Server " . $plan_details['name'] . " Purchased successfully",
                    'msg' => "You have successfully purchased server now you can start mining",
                    'status' => 1,

                );

                $this->Transactions->create($user_id, $t_data);

                //send notificaiton

                $output = array(
                    'code' => 200,
                    'msg' => "Success"
                );
            }else{
                $output = array(
                    'code' => 201,
                    'msg' => "Error " . $this->User->conn->error
                );
            }

            echo json_encode($output);
            die;

        }else{
            Response::IncompleteParams();
        }
        die;
    }

    public function signup()
    {

        if(isset($this->params['email'])){
            $this->loadModel('User');
            $this->loadModel('Wallets');

            $email_user = $this->User->showDetailsByEmail($this->params['email']);
            $username_user = $this->User->showDetailsByUsername($this->params['username']);

            if($email_user || $username_user){
                //email or username already exists
                if ($email_user) {
                    $output = array(
                        'code' => 110,
                        'dev_msg' => "an account already exists with this email",
                        'msg' => 'an account already exists with this email'
                    );
                }else{
                    $output = array(
                        'code' => 111,
                        'dev_msg' => "an account already exists with this username",
                        'msg' => 'an account already exists with this username'
                    );

                }

                echo json_encode($output);
                die;

            }else{
                //create account
                $email = $this->params['email'];
                $username = $this->params['username'];
                $password = $this->params['password'];
                $referral_code = "";
                if(isset($this->params['referral_code'])){
                    $referral_code = $this->params['referral_code'];
                }
                $date = Utility::GetTimeStamp();

                $result = $this->User->create($email, $username, $password, $date,$referral_code);

                if ($result) {
                    //account created successfully
                    $this->Wallets->create($result['id']);
                    
                    $wallets = $this->Wallets->getUserWallets($result['id']);

                    $output = array(
                        'code' => 200,
                        'msg' => array('User'=>$result, 'Wallets' => $wallets)
                    );

                    echo json_encode($output);
                    
                    die;
                }else{
                    $output = array(
                        'code' => 401,
                        'dev_msg' => "Error msg: " . $this->User->conn->error,
                        'msg' => "Error: login failed please try again later"
                    );
                }

                echo json_encode($output);
                die;
            }

        }else{
            Response::IncompleteParams();
        }
    }


    public function sendWelcomeEmail()
    {
        if(isset($this->params['user_id'])){
            $this->loadModel('User');
            $user = $this->User->showDetailsById($this->params['user_id']);

            $email = sendWelcomeEmail($user['email'], $user['username'], $user['id']);

            echo json_encode($email);

        }else{
            Response::IncompleteParams();
        }
        die;
    }

    public function updatePassword()
    {
        $this->loadModel('User');
        if (isset($this->params['user_id']) && isset($this->params['password']) && isset($this->params['new_password'])) {

            $user = $this->User->showDetailsById($this->params['id']);
            if ($user) {

                if (ValidatePassword($this->params['password'],$user['password'])) {

                    $data = array();
                    $data['id'] = $user['id'];
                    $data['password'] = Utility::EncryptPassword($user['new_password']);

                    if($this->User->update($data)){

                        $new_user = $this->User->showDetailsById($this->params['id']);

                        $output = array(
                            'code' => 200,
                            'msg' => $new_user
                        );

                    }else{
                        $output = array(
                            'code' => 402,
                            'dev_msg' => $this->User->error,
                            'msg' => "Failed to update password"
                        );
                    }

                    echo json_encode($output);

               }else{
                Response::AuthFailed("Password did not matched");
               }

                die;
                
            }else{
                $output = array(
                    'code' => 114,
                    'dev_msg' => "User not found in database id:" . $this->params['id'],
                    'msg' => "user not found"
                );

                echo json_encode($output);
                die;

            }


        }else{
            Response::IncompleteParams();
        }

    }


    public function forgetPassword()
    {

        $this->loadModel('User');

        if (isset($this->params['email']) && isset($this->params['otp_verified'])) {
            $email = $this->params['email'];
            $user = $this->User->showDetailsByEmail($email);

            if ($user) {

                $data = array();
                $data['id'] = $user['id'];
                $data['password'] = Utility::EncryptPassword($this->params['password']);

                if($this->User->update($data)){

                    $output = array(
                        'code' => 200,
                        'msg' => "Password has been reset successfully"
                    );

                }else{
                    $output = array(
                        'code' => 402,
                        'dev_msg' => $this->User->error,
                        'msg' => "Failed to reset password"
                    );

                }

                echo json_encode($output);
                die;


            }else{
                $output = array(
                    'code' => 113,
                    'dev_msg' => 'no account matched to this email:'.$email,
                    'msg' => 'No account matched to username or email'
                );
                echo json_encode($output);
                die;
            }

        }
        else
        if (isset($this->params['email'])) {

            $email = $this->params['email'];
            $user = $this->User->showDetailsByEmail($email);

            if($user){
                $otp = Utility::GenerateOtp();
                $result = sendVerificationEmail($user['email'],$otp,$user['username']);

                if ($result['code']==200) {
                    $output = array(
                        'code' => 200,
                        'msg' => $otp
                    );

                }else{
                    $output = array(
                        'code' => 201,
                        'dev_msg' => $result['msg'],
                        'msg' => "Failed to send email please try again later"
                    );
                }

                echo json_encode($output);
                die;

            }else{
                $output = array(
                    'code' => 113,
                    'dev_msg' => 'no account matched to this email:'.$email,
                    'msg' => 'No account matched to username or email'
                );
                echo json_encode($output);
                die;
            }
            
        }else{
            Response::IncompleteParams();
        }
    }


    public function showPlanDetails()
    {
        if (isset($this->params['plan_id'])) {

            $this->loadModel('Plans');

            $plan = $this->Plans->showDetailById($this->params['plan_id']);

            if($plan){

                $output = array(
                    'code' => 200,
                    'msg' => $plan
                );

            }else{
                $output = array(
                    'code' => 404,
                    'msg' => 'plan not found',
                    'dev_msg' => 'plan not found related to this id'
                );
            }

            echo json_encode($output);
            die;

        }else{
            Response::IncompleteParams();
        }

    }


    public function showUserDetails()
    {
        if (isset($this->params['user_id']) || isset($this->params['username'])) {
            $this->loadModel('User');
            $this->loadModel('Wallets');
            $this->loadModel('Miners');
            $this->loadModel('Plans');

            if(isset($this->params['user_id'])){
                $user = $this->User->showDetailsById($this->params['user_id']);

                if($user){

                    $wallets = $this->Wallets->getUserWallets($user['id']);
                    if(!$wallets){
                        $wallets = null;
                    }
                    $msg['User'] = $user;
                    $msg['Wallets'] = $wallets;

                    if($user['plan']!=0){
                        $msg['Plan'] = $this->Plans->showDetailById($user['plan']);
                        $msg['Miner'] = $this->Miners->getUserMiner($user['id']);

                    }

                    $output = array(
                        'code' => 200,
                        'msg' => $msg
                    );

                }else{
                    $output = array(
                        'code' => 114,
                        'msg' => "user not found",
                        'dev_msg'=>"user not found"
                    );
                }


            }else{

                $user = $this->User->showDetailsByUsername($this->params['username']);

                if($user){

                    $wallets = $this->Wallets->getUserWallets($user['id']);
                    if(!$wallets){
                        $wallets = null;
                    }
                    $msg['User'] = $user;
                    $msg['Wallets'] = $wallets;
                    $output = array(
                        'code' => 200,
                        'msg' => $msg
                    );

                }else{
                    $output = array(
                        'code' => 112,
                        'dev_msg' => 'no account matched to this username:'.$this->params['username'],
                        'msg' => 'No account matched to username or email'
                    );
                    
                }

            }

            echo json_encode($output);
            die;

        }else{
            Response::IncompleteParams();
        }
    }


    public function verifyUser()
    {
        if(isset($this->params['user_id']) && isset($this->params['code'])){
            $this->loadModel('User');

            $otp = $this->params['code'];
            $user = $this->User->showDetailById($this->params['user_id']);

            if($user && $otp==$user['code']){
                $update_data = array(
                    'id' => $user['id'],
                    'status' => 1,
                    'code' => 0
                );

                $update = $this->User->update($update_data);
                $user['status'] = 1;
                $output = array(
                    'code' => 200,
                    'msg' => $user
                );

            }else{

                if($user){
                    $output = array(
                        'code' => 201,
                        'msg' => "incorrect otp"
                    );
                }else{
                    $output = array(
                        'code' => 114,
                        'msg' => "user not found"
                    );
                }

            }

            echo json_encode($output);
            die;

        }
        else
        if (isset($this->params['user_id'])) {
            $this->loadModel('User');
        
            $user = $this->User->showDetailsById($this->params['user_id']);

            if($user){
                
                if($user['status'] == 0){

                    //send verification email
                    $otp = Utility::GenerateOtp();
                    $data = sendVerificationEmail($user['email'], $otp, $user['username']);

                    if($data['code']==200){
                        //email sent
                        $update_data = array(
                            'id'=>$user['id'],
                            'code'=>$user['code'],
                        );

                        $this->User->update($update_data);
                        $output = array(
                            'code' => 200,
                            'msg' => "success"
                        );

                    }else{

                        $output = array(
                            'code' => 101,
                            'msg' => "failed to send email please try again later",
                            'dev_msg' => $data['msg']
                        );

                    }

                }else{

                    if($user['status'] == 1)
                    {
                            $output = array(
                                'code' => 201,
                                'msg' => 'account already verified'
                            );
                    }
                    else
                    {
                            $output = array(
                                'code' => 402,
                                'msg' => "Your account has been suspended"
                            );
                    }

                }


            }else{
                $output = array(
                    'code' => 114,
                    'msg' => "user not found",
                    'dev_msg'=>"user not found"
                );
            }

            echo json_encode($output);
            die;

        }else{
            Response::IncompleteParams();
        }
    }


    public function getBitcoinRateFromApi()
    {
        $this->loadModel('LiveRate');
        

        //$file  = file_get_contents("https://api.nomics.com/v1/exchange-rates?key=c90d0b4d956e2e43d28ce969b1682447");
        $file  = file_get_contents("http://www.google.com/search?q=btc+to+usd");

        $file = substr($file, strpos($file,'<div><div><div class="BNeawe iBp4i AP7Wnd"><div><div class="BNeawe iBp4i AP7Wnd">'));
        $file = str_replace('<div><div><div class="BNeawe iBp4i AP7Wnd"><div><div class="BNeawe iBp4i AP7Wnd">', "", $file);
        $file = substr($file,0, strpos($file, ' United States Dollar'));
        // echo json_encode($file);
        // die;
        // $file = json_decode($file, true);

        // $btc_rate_usdt = 0.0;
        $btc_rate_usd = 0.0;
        $btc_rate_usd = $file;
        // $usdt_rate = 0.0;
        $date = Utility::GetTimeStamp();


        $result = $this->LiveRate->UpdateLiveRate($btc_rate_usd, $date);

        $row_count = $this->LiveRate->Count();
        if($row_count > 587){

            $this->LiveRate->DeleteOlder();
        }

        if($result > 9999){
            $this->LiveRate->RefreshIDs();
        }

        die;

              // for ($i=0; $i < count($file); $i++) { 
        //     $single = $file[$i];
        //     if($single['currency'] == "BTC"){
        //         $btc_rate_usdt = $single['rate'];
        //     }

        //     if($single['currency'] == "USDT"){
        //         $usdt_rate = $single['rate'];
        //     }

        // }

        // $btc_rate_usd = $btc_rate_usdt * $usdt_rate;
        
    }

    public function showBitcoinLiveRate()
    {
        $this->loadModel('LiveRate');

        $result = $this->LiveRate->showLiveRate();

        if($result){
            $output = array(
                'code' => 200,
                'msg' => $result
            );
        }else{
            $output = array(
                'code' => 201,
                'msg' => "Something went wrong please try again later",
                'dev_msg'=>" Database errror: ".$this->LiveRate->error

            );
        }

        echo json_encode($output);
        die;
        
    }


    public function showAppSettings()
    {
        $this->loadModel('AppSettings');

        $settings = $this->AppSettings->getAppSettings();

        if($settings){
            $output['code'] = 200;
            $output['msg'] = $settings;

        }else{
            $output['code'] = 201;
            $output['msg'] = "Failed to get app settings";
            $output['dev_msg'] = $this->AppSettings->error;
        }

        echo json_encode($output);
        die;

    }


    public function setupMiningScore()
    {
        $this->loadModel('User');
        $this->loadModel('Wallets');
        $this->loadModel('Miners');
        $this->loadModel('Plans');

        $time = Utility::GetTimeStamp();

        $users = $this->User->showAllPlanUsers();

        if(count($users)<1){
            //echo count($users);
            die;
        }

        foreach ($users as $user) {
            if($user['plan'] != 0 && $user['plan'] !="" ){

                $miner = $this->Miners->getUserMiner($user['id']);
                if($miner['status'] == 1){
                    $wallets = $this->Wallets->getUserWallets($user['id']);
                    $plan = $this->Plans->showDetailById($user['plan']);

                    if($wallets !=null && $plan !=null){
                        $balance = $wallets['balance_mine'];
                        $balance = $balance + $plan['true_speed'];

                        $this->Wallets->id = $user['id'];
                        $this->Wallets->saveField('balance_mine', $balance);

                        $this->Miners->id = $user['id'];
                        $this->Miners->saveField('cron_hit_time', $time);
                    }
                }

            }

        }


    }



    public function planExpireCheck()
    {
        $this->loadModel('User');
        $this->loadModel('Plans');
        $this->loadModel('Miners');


        $users = $this->User->getAllPlanExpiredUsers();

        foreach($users as $user){
            $update_data['id'] = $user['id'];
            $update_data['last_plan'] = $user['plan'];
            $update_data['last_plan_purchased'] = $user['plan_purchased'];
            $update_data['plan'] = 0;
            $update_data['plan_purchased'] = null;

            $this->User->update($update_data);
            $this->Miners->Delete($user['id']);

        }

    }










    public function showChart()
    {

        $this->loadModel('LiveRate');

        $data = array_reverse($this->LiveRate->ShowAll(144));

        $x_val = array();
        $y_val = array();

        foreach ($data as $key => $single) {
            
            if($single['price'] != ""){
                $time = strtotime($single['time']);

                $x_val[] = date('h:i ',$time);
                $y_val[] = round((float) str_replace(",","",$single['price']));

            }

        }

        # code...
        ?>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
        </script>

        <div class="line-chart">
            <div class="aspect-ratio">
                <canvas id="chart"></canvas>
            </div>
        </div>

        <style>
            $bg: #252429;

            html,body{height:100%;}body{display:flex;flex-direction:column;align-items:center;justify-content:center;width:100%;background:$bg;}

            *:before,
            *:after {
            box-sizing: inherit;
            }

            html {
            box-sizing: border-box;
                padding: 20px;
            }

            .line-chart {
                animation: fadeIn 600ms cubic-bezier(.57,.25,.65,1) 1 forwards;
            opacity: 0;
                max-width: 640px;
                width: 100%;
            }

            .aspect-ratio {
            height: 0;
            padding-bottom: 50%; // 495h / 990w
            }

            @keyframes fadeIn {
            to {
                opacity: 1;
            }
            }
        </style>

        <script>
            // ============================================
            // As of Chart.js v2.5.0
            // http://www.chartjs.org/docs
            // ============================================

            var chart    = document.getElementById('chart').getContext('2d'),
                gradient = chart.createLinearGradient(0, 0, 0, 450);

            gradient.addColorStop(0, 'rgba(255, 0,0, 0.5)');
            gradient.addColorStop(0.5, 'rgba(255, 0, 0, 0.25)');
            gradient.addColorStop(1, 'rgba(255, 0, 0, 0)');


            var data  = {
                labels: <?php echo json_encode($x_val); ?>,
                datasets: [{
                        label: '$',
                        backgroundColor: gradient,
                        pointBackgroundColor: 'white',
                        borderWidth: 1,
                        borderColor: '#911215',
                        data: <?php echo json_encode($y_val); ?>
                }]
            };


            var options = {
                responsive: true,
                maintainAspectRatio: true,
                animation: {
                    easing: 'easeInOutQuad',
                    duration: 520
                }
                ,
                scales: {
                    xAxes: [{
                        gridLines: {
                            color: 'rgba(200, 200, 200, 0.05)',
                            lineWidth: 1
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: 'rgba(200, 200, 200, 0.08)',
                            lineWidth: 1
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.1
                    },
                    point: {
                        backgroundColor: "#ffff80",
                        borderColor: "#fff",
                        radius: 1
                    }
                    
                },
                legend: {
                    display: false
                },
                tooltips: {
                    titleFontFamily: 'Open Sans',
                    backgroundColor: 'rgba(0,0,0,0.3)',
                    titleFontColor: 'red',
                    caretSize: 5,
                    cornerRadius: 2,
                    xPadding: 10,
                    yPadding: 10
                }
            };


            var chartInstance = new Chart(chart, {
                type: 'line',
                data: data,
                    options: options
            });
        </script>

        <?php
    }


    public function showChart2()
    {

        
        $this->loadModel('LiveRate');

        $data = array_reverse($this->LiveRate->ShowAll(144));
      

        ?>
        <!DOCTYPE HTML>
        <html>
        <head>
        <script type="text/javascript">
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer",
            {

            title:{
            text: ""
            },
            axisX: {
                //valueFormatString: "MMM",
                
                interval:1,
                intervalType: "hour"
            },
            axisY:{
                gridColor: "#fff",
                interval:100,
                //intervalType: "number"
            },
            toolTip:{
                    shared: false,
                    content: function(e){
                        var body = new String;
                        var head ;
                        for (var i = 0; i < e.entries.length; i++){

                            const options = {
                                //day: "numeric",
                                hour: "numeric",
                                minute: "numeric"

                            };
                            var str = e.entries[i].dataPoint.x.toLocaleString("en-US",options) + " - $" + e.entries[i].dataPoint.y ;
                            
                            body = body.concat(str);
                        }
                        head = "";// Date Time + ':' + (parseDate(e.entries[0].dataPoint.x));

                        return (head.concat(body));
                    }
            },
            data: [
            {
                type: "line",
                
                dataPoints: [
                
                <?php

                foreach ($data as $key => $single) {
            
                    if($single['price'] != ""){

                        $date = new DateTime($single['time']);
                        $echo = "{ x: new Date(";
                        $echo .= $date->format("Y").",";
                        $echo .= $date->format("m").",";
                        $echo .= $date->format("d").",";
                        $echo .= $date->format("H").",";
                        $echo .= $date->format("i")."), y: ";

                        $echo .= round((float) str_replace(",", "", $single['price']))."},";

                        echo $echo;
        
                    }
        
                }

                ?>

                ]

                

            }
            ]
            });

            chart.render();
        }
        </script>
        <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script></head>
        <body>
        <div id="chartContainer" style="height: 300px; width: 100%;">
        </div>
        </body>
        </html>
        <?php
    }




}

?>

