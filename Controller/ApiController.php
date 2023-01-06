<?php

class ApiController extends Controller {

    public $params = [];

    public function index(){
        /*
        *100-199 informative (yellow indecation)
        * 100 - no records
        * 110 - already exists 
        *
        *
        * 113 - login( no accound found on email, username)
        * 
        *
        * 200 - success or semi success (mostly green indecation)
        * 300 - redirection, work in progress (yellow)
        * 400 - error, rejected, (RED)
        * 500 - serious server issue (RED)
        *
        *
        *
        *
        *
        *
        *
        *
        */

        $this->params = array(
            'email' => "kinddusingh1k2k@gmail.com",
            'username' => "kulvinder",
            'password' => '12345678',
            1
        );

        $this->signup();

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

        $this->loadModel('Plan');
        

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
                        'code' => 112,
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

}

?>