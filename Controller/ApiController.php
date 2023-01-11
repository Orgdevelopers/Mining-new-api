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

        //$this->params = array(
            //'email' => "kinddusingh1k2k3@gmail.com",
            //'username' => "kulvinder",
            //'password' => '12345678',
            
        //);

        //$this->forgetPassword();

        // $res = sendVerificationEmail("kinddusingh1k2k3@gmail.com","433444","kulvinder");

        // echo json_encode($res)." email sent";
        // die;

        // $data = array(
        //     'id' => 1,
        //     //'username' => "kulvinder",
        //     'pic'=>""
        // );

        // $this->loadModel('User');
        // if ($this->User->update($data)) {
        //     echo "updated";
        // }else{
        //     echo "failed " . $this->User->error;
        // }

        // die;

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
            if(isset($this->params['username'])){
                //username login
                
                $user = $this->User->showDetailsByUsername($this->params['username']);
                if($user){
                    $db_password = $user['password'];
                    $password = $this->params['password'];

                    if(ValidatePassword($password,$db_password,$user['email'])){
                        //password matched
                        $output = array(
                            'code' => 200,
                            'msg' => $user
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

                    if(ValidatePassword($password,$db_password,$user['email'])){
                        //password matched
                        $output = array(
                            'code' => 200,
                            'msg' => $user
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


    public function signup()
    {
        if(isset($this->params['email'])){
            $this->loadModel('User');
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
                $date = Utility::GetTimeStamp();

                $result = $this->User->create($email, $username, $password, $date);

                if ($result) {
                    //account created successfully
                    $output = array(
                        'code' => 200,
                        'msg' => $result
                    );
                }else{
                    $output = array(
                        'code' => 401,
                        'dev_msg' => "Error msg: " . $this->User->conn->error,
                        'msg' => "Error: login failed please try again later"
                    );
                }

                echo json_encode($output);
            }
            die;

        }else{
            Response::IncompleteParams();
        }
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
            if(isset($this->params['user_id'])){
                $user = $this->User->showDetailsById($this->params['user_id']);

                if($user){
                    $output = array(
                        'code' => 200,
                        'msg' => $user
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

                    $output = array(
                        'code' => 200,
                        'msg' => $user
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


}

?>