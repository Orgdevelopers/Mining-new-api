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

        $all = $this->TaskComplete->getAllRequestsPending();

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
        $crypto_settings = $this->CryptoModel->getAll();

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
        unset($data['token']);

        if(isset($data['wallet_address1'])){
            $save = array(
                'id'=>1,
                'title' =>$data['title'],
                'subtitle' => $data['subtitle'],
                'wallet_address' => $data['wallet_address1'],
                'network' => $data['network1']
            );
            
            $a = $this->CryptoModel->Save($save);
        }

        if(isset($data['wallet_address2'])){
            $this->CryptoModel->id = 2;
            $save = array(
                //'id'=>2,
                'wallet_address' => $data['wallet_address2'],
                'network' => $data['network2']
            );
            
            $a = $this->CryptoModel->Save($save);
        }

        if(isset($data['wallet_address3'])){
            $save = array(
                'id'=>3,
                'wallet_address' => $data['wallet_address3'],
                'network' => $data['network3']
            );
            
            $a = $this->CryptoModel->Save($save);
        }


        if(isset($data['wallet_address4'])){
            $save = array(
                'id'=>4,
                'wallet_address' => $data['wallet_address4'],
                'network' => $data['network4']
            );
            
            $a = $this->CryptoModel->Save($save);
        }

        //$a = $this->CryptoModel->Save($data);

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


    public function acceptTaskRequest()
    {
        $this->checkParams(['id','token']);
        $this->validateToken($this->params['token']);

        $this->loadModel('TaskComplete');
        $this->loadModel('User');
        $this->loadModel('Task');
        $this->loadModel('AppSettings');
        $this->loadModel('Transactions');
        $this->loadModel('Wallets');

        $request = $this->TaskComplete->getDetailsByIdRequest($this->params['id']);
        // echo json_encode($request); die;
        $user = $this->User->showDetailsById($request['user_id']);
        $task = $this->Task->getDetailsById($request['task_id']);
        //echo json_encode($task); die;
        $settings = $this->AppSettings->getAppSettings();

        $this->TaskComplete->id = $request['id'];
        $this->TaskComplete->saveFieldRequest('status','1');

        $this->TaskComplete->create($user['id'],$request['task_id']);

        $amount_usdt = $task['amount'] * $settings['points_value'];

        //update wallet
        $this->Wallets->id = $user['id'];
        $balance = $this->Wallets->getField($user['id'],'balance_task');
        $this->Wallets->saveField('balance_task',($balance['balance_task'] + $task['amount']));

        //create transaction
        $data = array(
            'type'=>3,
            'wallet_type' => 1,
            'amount' => $amount_usdt,
            'title' => 'Task completion reward',
            'msg' => '',
            'status' => 1,
        );

        $this->Transactions->create($user['id'],$data);
        
        $body = TASK_REQUEST_ACCEPT_BODY;


        $body = str_replace("%t_p%",$task['amount'].'TP',TASK_REQUEST_ACCEPT_BODY);
        $body = str_replace("%a_m%",('$'.$amount_usdt),$body);

        $notification = PushNotifications::getNotificationBodyData($user['token'],TASK_REQUEST_ACCEPT_HEAD,$body,'task');
        PushNotifications::send($notification);

        echo json_encode(array(
            'code' => 200,
            'msg'=> 'success'
        ));
        die;

    }


    public function rejectTaskRequest()
    {
        $this->checkParams(['id','token']);
        //$this->validateToken($this->params['token']);

        $this->loadModel('TaskComplete');
        $this->loadModel('User');

        $this->loadModel('Transactions');
        $this->loadModel('Wallets');

        $request = $this->TaskComplete->getDetailsByIdRequest($this->params['id']);
        $user = $this->User->showDetailsById($request['user_id']);


        $this->TaskComplete->id = $request['id'];
        $this->TaskComplete->saveFieldRequest('status','2');

        
        $body = TASK_REQUEST_REJECT_BODY;

        if(isset($this->params['reason'])){
            $body = 'Rejection reason : '.$this->params['reason'];
        }

        $notification = PushNotifications::getNotificationBodyData($user['token'],TASK_REQUEST_REJECT_HEAD,$body,'task');
        //PushNotifications::send($notification);

        echo json_encode(array(
            'code' => 200,
            'msg'=> 'success'
        ));
        die;

    }


    public function acceptServerPurchaseRequest()
    {
        $this->checkParams(['id','token']);
        $this->validateToken($this->params['token']);

        $this->loadModel('BuyWithCrypto');
        $this->loadModel('Plans');
        $this->loadModel('User');

        $request = $this->BuyWithCrypto->getDetailsById($this->params['id']);

        if($request && $request['action'] == 'plan' ){
            $user = $this->User->showDetailsById($request['user_id']);
            $plan = $this->Plans->showDetailById($request['plan_id']);

            $date = Utility::GetTimeStamp();

            $this->BuyWithCrypto->id = $request['id'];
            $this->BuyWithCrypto->saveField('status','1');

            $old_plan = $user['plan'];
            $old_purchase = $user['plan_purchased'];
            $expiry = Utility::GetPlanExpiry($date,$plan['duration']);

            //notification
            $notification = PushNotifications::getNotificationBodyData($user['token'],PLAN_PURCHASE_REQUEST_ACCEPTED_HEAD,str_replace('%p_n%',$plan['name'],PLAN_PURCHASE_REQUEST_ACCEPTED_BODY),'default');
            PushNotifications::send($notification);

            $data = array(
                'id' => $user['id'],
                'plan' => $plan['id'],
                'last_plan' => $old_plan,
                'plan_purchased' => $date,
                'last_plan_purchased' => $old_purchase,
                'plan_ending' => $expiry
            );

            if($this->User->update($data)){
                $output = array(
                    'code' => 200,
                    'msg'=>'success'
                );
            }else{
                $output = array(
                    'code' => 200,
                    'msg'=>'success'
                );
            }

            echo json_encode($output);

        }else{
            echo json_encode(array('code'=>200,'msg'=>'error'));
        }

        die;

    }


    public function rejectServerPurchaseRequest()
    {
        $this->checkParams(['id','token']);
        $this->validateToken($this->params['token']);

        $this->loadModel('BuyWithCrypto');
        $this->loadModel('Plans');
        $this->loadModel('User');

        $request = $this->BuyWithCrypto->getDetailsById($this->params['id']);

        if($request && $request['action'] == 'plan' ){
            $user = $this->User->showDetailsById($request['id']);
            $plan = $this->Plans->showDetailsById($request['plan_id']);

            $date = Utility::GetTimeStamp();

            $this->BuyWithCrypto->id = $request['id'];
            $this->BuyWithCrypto->saveField('status','2');

            $body = str_replace('%p_n%',$plan['name'],PLAN_PURCHASE_REQUEST_REJECTED_BODY);
            if(isset($this->params['reason'])){
                $body = 'Rejection reason : '.$this->params['reason'];
            }
            $notification = PushNotifications::getNotificationBodyData($user['token'],PLAN_PURCHASE_REQUEST_REJECTED_HEAD,$body,'default');
            PushNotifications::send($notification);


            $output = array(
                'code' => 200,
                'msg'=>'success'
            );


            echo json_encode($output);

        }else{
            echo json_encode(array('code'=>200,'msg'=>'error'));
        }

        die;

    }


    public function acceptInvestmentPurchaseRequest()
    {
        $this->checkParams(['id','token']);
        //$this->validateToken($this->params['token']);

        $this->loadModel('BuyWithCrypto');
        $this->loadModel('InvestPlans');
        $this->loadModel('Investments');
        $this->loadModel('User');

        $request = $this->BuyWithCrypto->getDetailsById($this->params['id']);

        if($request && $request['action'] == 'investment' ){
            $user = $this->User->showDetailsById($request['user_id']);
            $plan = $this->InvestPlans->showDetailsById($request['investment_plan_id']);

            $date = Utility::GetTimeStamp();

            $this->BuyWithCrypto->id = $request['id'];
            $this->BuyWithCrypto->saveField('status','1');

            $old_plan = $user['plan'];
            $old_purchase = $user['plan_purchased'];
            $expiry = Utility::GetPlanExpiry($date,$plan['duration']);

            $body = str_replace('%p_n%',$plan['name'],INV_PURCHASE_REQUEST_ACCEPTED_BODY);
            $body = str_replace("%a_m%",'$'.$request['amount'],$body);
            //notification
            $notification = PushNotifications::getNotificationBodyData($user['token'],INV_PURCHASE_REQUEST_ACCEPTED_HEAD,$body,'default');
            PushNotifications::send($notification);

            if($this->Investments->create($user['id'],$plan['id'],$request['amount'],$expiry)){
                $output = array(
                    'code' => 200,
                    'msg'=>'success'
                );
            }else{
                $output = array(
                    'code' => 201,
                    'msg'=>'failed to update DB'
                );
            }

            echo json_encode($output);

        }else{
            echo json_encode(array('code'=>201,'msg'=>'error: investment plan not found'));
        }

        die;

    }


    public function rejectInvestmentPurchaseRequest()
    {
        $this->checkParams(['id','token']);
        $this->validateToken($this->params['token']);

        $this->loadModel('BuyWithCrypto');
        //$this->loadModel('Plans');
        $this->loadModel('User');

        $request = $this->BuyWithCrypto->getDetailsById($this->params['id']);

        if($request && $request['action'] == 'investment' ){
            $user = $this->User->showDetailsById($request['user_id']);
            //$plan = $this->Plans->showDetailById($request['plan_id']);

            $date = Utility::GetTimeStamp();

            $this->BuyWithCrypto->id = $request['id'];
            $this->BuyWithCrypto->saveField('status','2');

            $body = INV_PURCHASE_REQUEST_REJECTED_BODY;
            if(isset($this->params['reason'])){
                $body = 'Rejection reason : '.$this->params['reason'];
            }
            $notification = PushNotifications::getNotificationBodyData($user['token'],INV_PURCHASE_REQUEST_REJECTED_HEAD,$body,'default');
            PushNotifications::send($notification);


            $output = array(
                'code' => 200,
                'msg'=>'success'
            );


            echo json_encode($output);

        }else{
            echo json_encode(array('code'=>201,'msg'=>'not found'));
        }

        die;

    }

    public function rejectWithdrawRequest()
    {
        $this->checkParams(['token','id']);
        $this->validateToken($this->params['token']);

        $this->loadModel('User');
        $this->loadModel('Wallets');
        $this->loadModel('AppSettings');
        $this->loadModel('Transactions');
        $this->loadModel('LiveRate');

        $transaction = $this->Transactions->getDetailsById($this->params['id']);
        $settings = $this->AppSettings->getAppSettings();
        $live_rate = $this->LiveRate->showLiveRate();


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
                    $tp = number_format($tp,'0','','');
                    $this->Wallets->saveField('balance_task',($balance['balance_task']+$tp));

                }else{
                    if($live_rate){
                        $btc_usdt = str_replace(',','',$live_rate['price']);

                        $usdt_btc = 1 / $btc_usdt;
                        $usdt_sat = $usdt_btc * 100000000;

                        $sat_amount = number_format(($transaction['amount'] * $usdt_sat),'0','','');
                        $this->Wallets->saveField('balance_mine',($balance['balance_mine']+$sat_amount));

                    }

                }

                $body = str_replace("%a_m%","$".$transaction['amount'],WITHDRAW_FAIL_BODY);
                $notification = PushNotifications::getNotificationBodyData($user['token'],WITHDRAW_FAIL_HEAD,$body,"default");
                PushNotifications::send($notification);

                if(isset($this->params['reason']) && $this->params['reason'] != ""){
                    $body = 'Rejection reason - '.$this->params['reason'];
                    $notification = PushNotifications::getNotificationBodyData($user['token'],WITHDRAW_FAIL_HEAD,$body,"default");
                    PushNotifications::send($notification);
                }

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


    public function getInvestPlanDetails()
    {
        $this->checkParams(['id','token']);
        $this->validateToken($this->params['token']);

        $this->loadModel('InvestPlans');

        $details = $this->InvestPlans->showDetailsById($this->params['id']);

        if($details){
            echo json_encode(array(
                'code' => 200,
                'msg' => $details
            ));
        }else{
            echo json_encode(array(
                'code' => 201,
                'msg' => 'error'
            ));
        }

        die;

    }


    public function getPlanDetails()
    {
        $this->checkParams(['id','token']);
        //$this->validateToken($this->params['token']);

        $this->loadModel('Plans');

        $details = $this->Plans->showDetailById($this->params['id']);

        if($details){
            echo json_encode(array(
                'code' => 200,
                'msg' => $details
            ));
        }else{
            echo json_encode(array(
                'code' => 201,
                'msg' => 'error'
            ));
        }

        die;

    }


    public function deleteInvestmentPlan()
    {
        $this->checkParams(['id','token']);
        $this->validateToken($this->params['token']);

        $this->loadModel('InvestPlans');

        if($this->InvestPlans->delete($this->params['id'])){
            echo json_encode(array(
                'code' => 200,
                'msg' => 'success'
            ));
        }else{
            echo json_encode(array(
                'code' => 201,
                'msg' => 'error'
            ));
        }
        die;
    }


    public function editInvestmentPlan()
    {
        $this->checkParams(['id','token']);
        $this->validateToken($this->params['token']);

        $this->loadModel('InvestPlans');

        $this->InvestPlans->id = $this->params['id'];
        $data = $this->params;

        unset($data['token']);

        if($this->InvestPlans->Save($data)){
            echo json_encode(array(
                'code' => 200,
                'msg' => 'success'
            ));
        }else{
            echo json_encode(array(
                'code' => 201,
                'msg' => 'error'
            ));
        }
        die;

    }


    public function editServer()
    {
        $this->checkParams(['id','token']);
        //$this->validateToken($this->params['token']);

        $this->loadModel('Plans');

        $this->Plans->id = $this->params['id'];
        $data = $this->params;

        unset($data['token']);

        if($this->Plans->Save($data)){
            echo json_encode(array(
                'code' => 200,
                'msg' => 'success'
            ));
        }else{
            echo json_encode(array(
                'code' => 201,
                'msg' => 'error'
            ));
        }
        die;

    }


    public function deleteServer()
    {
        $this->checkParams(['id','token']);
        $this->validateToken($this->params['token']);

        $this->loadModel('Plans');

        if($this->Plans->delete($this->params['id'])){
            echo json_encode(array(
                'code' => 200,
                'msg' => 'success'
            ));
        }else{
            echo json_encode(array(
                'code' => 201,
                'msg' => 'error'
            ));
        }
        die;

    }


    public function addTask()
    {
        //$this->checkParams(['token']);
        //$this->validateToken($this->params['token']);
        
        $this->loadModel('Task');

        $file = IMAGE_UPLOAD_FOLDER.uniqid().".png";
        $upload = move_uploaded_file($_FILES['file']['tmp_name'],$file);
        $c = $this->Task->create('','',$file,'0','');
        if($c && $upload){
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
        die;

    }


    public function updateTask()
    {
        $this->checkParams(['id','token']);
        $this->validateToken($this->params['token']);

        $this->loadModel('Task');
        $this->Task->id = $this->params['id'];

        if(isset($this->params['link'])){
            $this->Task->saveField('link',$this->params['link']);
        }

        if(isset($this->params['amount'])){
            $this->Task->saveField('amount',$this->params['amount']);
        }

        echo json_encode(array(
            'code' => 200,
            'msg' => 'success'
        ));
        die;
    }


    public function deleteTask()
    {
        $this->checkParams(['id','token']);
        $this->validateToken($this->params['token']);

        $this->loadModel('Task');

        if($this->Task->delete($this->params['id'])){
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
        die;

    }


    public function createServer()
    {
        $this->checkParams(['token','name']);
        $this->validateToken($this->params['token']);

        $this->loadModel('Plans');

        if($this->Plans->create($this->params)){
            $output = array(
                'code' => 200,
                'msg' => 'success'
            );
        }else{
            $output = array(
                'code' => 201,
                'msg' => 'error '.$this->Plans->conn->error
            );
        }

        echo json_encode($output);
        
    }


    public function updateUser()
    {
        $this->checkParams(['token','id']);
        //$this->validateToken($this->params['token']);
        $this->loadModel('User');
        $this->loadModel('Wallets');

        //

        if($this->User->update($this->params)){

            //$data = ['user_id'=>$this->params['id']];
            $this->Wallets->id = $this->params['id'];

            if (isset($this->params['balance_mine'])) {
                //$data['balance_mine'] = $this->params['balance_mine'];
                $this->Wallets->saveField('balance_mine',$this->params['balance_mine']);
            }

            if (isset($this->params['balance_task'])) {
                //$data['balance_task'] = $this->params['balance_task'];
                $this->Wallets->saveField('balance_task',$this->params['balance_task']);
            }

            if (isset($this->params['balance_invest'])) {
                //$data['balance_invest'] = $this->params['balance_invest'];
                $this->Wallets->saveField('balance_invest',$this->params['balance_invest']);
            }

            //$this->Wallets->Save($data);

            echo json_encode(array(
                'code' => 200,
                'error' => "success"
            ));

        }else{
            echo json_encode(array(
                'code' => 201,
                'meg' => 'error'. json_encode($this->params)
            ));
        }

        die;

    }

    public function showUserDetails()
    {
        $this->checkParams(['user_id']);

        $this->loadModel('User');
        $this->loadModel('Wallets');

        $user = $this->User->showDetailsById($this->params['user_id']);
        $wallets = $this->Wallets->getUserWallets($this->params['user_id']);

        $output['User'] = $user;
        $output['Wallets'] = $wallets;

        echo json_encode(array('code'=>200,'msg'=>$output));
        die;

    }

    public function createInvestmentPlan()
    {
        $this->checkParams(['token','name']);
        $this->validateToken($this->params['token']);

        $this->loadModel('InvestPlans');

        if($this->InvestPlans->create($this->params)){
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