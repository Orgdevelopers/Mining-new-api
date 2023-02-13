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
        $sp = 0;
        if(isset($this->params['page'])){
            $sp = $this->params['page'];
        }
        $this->loadModel('User');
        $this->loadModel('Investments');


        $users = $this->User->showAllAdmin(($sp*ADMIN_RECORDS_PER_PAGE),ADMIN_RECORDS_PER_PAGE);

        $all = array();

        foreach ($users as $user) {
            $user['investments'] = $this->Investments->countUser($user['id']);
            $all[] = $user;
        }

        if($users){
            echo json_encode(array(
                'code' => 200,
                'msg' => $all
            ));
        }else{
            echo json_encode(array(
                'code' => 201,
                'msg' => "no records"
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

}