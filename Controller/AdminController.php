<?php

class AdminController extends Controller {

    public $params = [];

    public function index(){

    }

    public function __construct(){
        $json_data = json_decode(file_get_contents("php://input"), true);
        if ($json_data==null) {
            $json_data = array();
        }
        $post = $_POST;
        $get = $_GET;
        $this->params = array_merge($json_data, $post, $get);

        $this->loadModel('Admins');
    }


    public function getDashboard()
    {
        //sleep(1);
        //$this->checkParams([''])
        $this->loadModels(array('User','Miners','Investments','BuyWithCrypto'));

        $users = $this->User->countAll();
        $investments = $this->Investments->countActive();
        $request = $this->BuyWithCrypto->countPending();
        $miners = $this->Miners->count(0);

        $output['msg']['total_users'] = $users;
        $output['msg']['miners'] = $miners;
        $output['msg']['investments'] = $investments;
        $output['msg']['requests'] = $request;

        $output['code'] = 200;

        echo json_encode($output);
        die;

    }


    public function showallUsers()
    {
        //sleep(1);
        $this->checkParams(['token']);
        $this->validateToken($this->params['token']);


        $sp = 0;
        if(isset($this->params['page'])){
            $sp = $this->params['page'];
        }
        $this->loadModel('User');
        //$this->loadModel('Investments');


        //$users = $this->User->showAllAdmin(($sp*ADMIN_RECORDS_PER_PAGE),ADMIN_RECORDS_PER_PAGE);
        $users = $this->User->showAllAdmin(($sp*ADMIN_RECORDS_PER_PAGE),999);

        $all = array();

        // foreach ($users as $user) {
        //     $user['investments'] = $this->Investments->countUser($user['id']);
        //     $all[] = $user;
        // }

        if($users){
            echo json_encode(array(
                'code' => 200,
                'msg' => $users
            ));
        }else{
            echo json_encode(array(
                'code' => 201,
                'msg' => "no records"
            ));

        }

        die;

    }


    public function showServerPurchaseRequests()
    {
        
        $this->checkParams(['token']);
        $this->validateToken($this->params['token']);

        $this->loadModel('BuyWithCrypto');

        $array = array();
        $array = $this->BuyWithCrypto->getAllPending("plan",0,999);

        if(count($array) > 0){
            echo json_encode(array(
                'code' => 200,
                'msg' => $array
            ));
        }else{
            echo json_encode(array(
                'code' => 202,
                'msg' => 'no records'
            )); 
        }

        die;

    }


    public function showInvestmentRequests()
    {
        
        $this->checkParams(['token']);
        $this->validateToken($this->params['token']);

        $this->loadModel('BuyWithCrypto');

        $array = array();
        $array = $this->BuyWithCrypto->getAllPending("investment",0,999);

        if(count($array) > 0){
            echo json_encode(array(
                'code' => 200,
                'msg' => $array
            ));
        }else{
            echo json_encode(array(
                'code' => 202,
                'msg' => 'no records'
            )); 
        }

        die;

    }


    public function checkParams($names = array())
    {
        foreach($names as $name){
            if(!isset($this->params[$name])){
                Response::IncompleteParams();
            }
        }
    }


    public function showAllPlans()
    {
        $this->checkParams(['token']);
        $this->validateToken($this->params['token']);

        $this->loadModel('Plans');

        $all = $this->Plans->showAll();

        if(count($all)>0){
            $output['code'] = 200;
            $output['msg'] = $all;
        }else{
            $output['code'] = 201;
            $output['msg'] = "no records";
        }

        echo json_encode($output);
        die;

    }


    public function showAllInvestPlans()
    {
        $this->checkParams(['token']);
        $this->validateToken($this->params['token']);

        $this->loadModel('InvestPlans');

        $all = $this->InvestPlans->getAll();

        if(count($all)>0){
            $output['code'] = 200;
            $output['msg'] = $all;
        }else{
            $output['code'] = 201;
            $output['msg'] = "no records";
        }

        echo json_encode($output);
        die;

    }


    public function showAllTasks()
    {
        $this->checkParams(['token']);
        $this->validateToken($this->params['token']);

        $this->loadModel('Task');

        $all = $this->Task->getAll();

        if(count($all)>0){
            $output['code'] = 200;
            $output['msg'] = $all;
        }else{
            $output['code'] = 201;
            $output['msg'] = "no records";
        }

        echo json_encode($output);
        die;
    }

    
    public function showAllTaskRequests()
    {
        $this->checkParams(['token']);
        $this->validateToken($this->params['token']);

        $this->loadModel('TaskComplete');

        $all = $this->TaskComplete->getAllRequests();

        if(count($all)>0){
            $output['code'] = 200;
            $output['msg'] = $all;
        }else{
            $output['code'] = 201;
            $output['msg'] = "no records";
        }

        echo json_encode($output);
        die;
    }

    public function showAllWithdrawRequests()
    {
        $this->checkParams(['token']);
        $this->validateToken($this->params['token']);

        $this->loadModel('Transactions');
        $this->loadModel('User');

        $transactions = $this->Transactions->getAllPending(0,999);

        $all = [];

        foreach ($transactions as  $transaction) {

            $username = $this->User->getField($transaction['user_id'],"username");
            $transaction['username'] = $username['username'];

            $all[] = $transaction;
            
        }

        if(count($all)>0){
            $output['code'] = 200;
            $output['msg'] = $all;
        }else{
            $output['code'] = 201;
            $output['msg'] = "no records";
        }

        echo json_encode($output);
        die;
    }

    
    public function getAppSettingsAdmin()
    {
        $this->checkParams(['token']);
        $this->validateToken($this->params['token']);

        $this->loadModel('AppSettings');
        $this->loadModel('CryptoModel');

        $appSettings = $this->AppSettings->getAppSettings();
        $crypto_settings = $this->CryptoModel->getModel();

        $msg['AppSettings'] = $appSettings;
        $msg['CryptoModel'] = $crypto_settings;

        if(count($msg)>0){
            $output['code'] = 200;
            $output['msg'] = $msg;
        }else{
            $output['code'] = 201;
            $output['msg'] = "no records";
        }

        echo json_encode($output);
        die;
    }


    public function updateCryptoModel()
    {
        
        $this->loadModel('CryptoModel');

        $data = $this->params;
        $data['id'] = 1;
        unset($data['token']);

        $a = $this->CryptoModel->Save($data);

        if($a){
            $output['code'] = 200;
            $output['msg'] = "success";
        }else{
            $output['code'] = 201;
            $output['msg'] = "error";
        }

        echo json_encode($output);
        die;
        
    }


    public function updateAppSettings()
    {
        $this->loadModel('AppSettings');

        $data = $this->params;
        $data['id'] = 1;
        unset($data['token']);

        $a = $this->AppSettings->Save($data);

        if($a){
            $output['code'] = 200;
            $output['msg'] = "success";
        }else{
            $output['code'] = 201;
            $output['msg'] = "error";
        }

        echo json_encode($output);
        die;

    }


    public function acceptWithdrawRequest()
    {
        $this->checkParams(['token','id']);
        $this->validateToken($this->params['token']);

        $this->loadModel('User');
        $this->loadModel('Transactions');

        $transaction = $this->Transactions->getDetailsById($this->params['id']);

        if($transaction && $transaction['status'] == 0){

            $user = $this->User->showDetailsById($transaction['user_id']);
            
            $this->Transactions->id = $transaction['id'];
            $this->Transactions->saveField('status','1');

            $body = str_replace("%a_m%","$ ".$transaction['amount'],WITHDRAW_SUCCESS_BODY);
            $notification = PushNotifications::getNotificationBodyData($user['token'],WITHDRAW_SUCCESS_HEAD,$body,"default");
            PushNotifications::send($notification);

            $output = array(
                'code' => 200,
                'msg' => 'success'
            );

        }else{
            $output = array(
                'code' => 201,
                'msg' => 'error'
            );
        }

        echo json_encode($output);

    }


    public function RejectWithdrawRequest()
    {
        $this->checkParams(['token','id']);
        $this->validateToken($this->params['token']);

        $this->loadModel('User');
        $this->loadModel('Wallets');
        $this->loadModel('AppSettings');
        $this->loadModel('Transactions');

        $transaction = $this->Transactions->getDetailsById($this->params['id']);
        $settings = $this->AppSettings->getAppSettings();

        if($transaction && $transaction['status'] == 0){

            $user = $this->User->showDetailsById($transaction['user_id']);
            
            $this->Transactions->id = $transaction['id'];
            $this->Transactions->saveField('status','2');

            
            $balance = $this->Wallets->getUserWallets($user['id']);

            if($balance){
                $this->Wallets->id = $user['id'];
                if($transaction['wallet_type'] == 0){
                    $this->Wallets->saveField('balance_invest',($balance['balance_invest']+$transaction['amount']));
                    
                }else if($transaction['wallet_type']==1){
                    $tp = $transaction['amount'] / $settings['points_value'];
                    $tp = (int) $tp;
                    $this->Wallets->saveField('balance_task',($balance['balance_task']+$tp));

                }else{
                    

                }

                $body = str_replace("%a_m%","$ ".$transaction['amount'],WITHDRAW_FAIL_BODY);
                $notification = PushNotifications::getNotificationBodyData($user['token'],WITHDRAW_FAIL_HEAD,$body,"default");
                PushNotifications::send($notification);

                $output = array(
                    'code' => 200,
                    'msg' => 'success'
                );

            }else{
                $output = array(
                'code' => 202,
                'msg' => 'error'
                );
            }

            

        }else{
            $output = array(
                'code' => 201,
                'msg' => 'error'
            );
        }

        echo json_encode($output);

    }


    /*
     * encrypted functions;
     */
    public function adminlogin()
    {
        //echo Utility::EncryptPassword("123456");
        $this->checkParams(['token']);
        $params = json_decode(Utility::DecryptPassword($this->params['token']),true);

        $admin = $this->Admins->getDetailsByEmail($params['email']);
        if($admin){
            if($admin['password'] == Utility::EncryptPassword($params['password'])){

                echo json_encode(array(
                    'code' => 200,
                    'msg' => $admin
                ));

            }else{
                echo json_encode(array(
                    'code' => 202,
                    'msg' => 'incorrect password'
                )); 
            }

        }else{
            echo json_encode(array(
                'code' => 201,
                'msg' => 'email or username not registered'
            ));
        }

        die;

    }



     /*
     * encrypted functions;
     */


    public function validateToken($token)
    {
        $t = Utility::DecryptPassword($token);
        if(!$this->Admins->validateToken($t)){
            echo json_encode(array(
                'code' => 401,
                'msg' => 'invali token : $'
            ));
            die;
        }
    }

}