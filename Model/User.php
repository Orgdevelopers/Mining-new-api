<?php

class User extends AppModel {

    public $error = null;

    public $conn = null;

    public function __construct()
    {
        $this->conn = $GLOBALS['DB_CONNECTION'];
    }

    public function showAll($sp = 0,$limit = 999)
    {
        return $this->Query("SELECT * FROM user ORDER BY user.id DESC LIMIT $sp,$limit ;")->fetch_all(1);
    }

    public function showAllAdmin($sp = 0,$limit = 999)
    {
        return $this->Query("SELECT id, username, email, plan, last_plan, plan_purchased, last_plan_purchased, allow_public_chat, status, created FROM user ORDER BY user.id DESC LIMIT $sp,$limit ;")->fetch_all(1);
    }

    public function showDetailsByEmail($var = "")
    {

        $qry = mysqli_query($this->conn, "SELECT * FROM user WHERE user.email = '$var'");

        $output = mysqli_fetch_array($qry, 1);
        return $output;

    }

    public function showDetailsByUsername($var = null)
    {
        $qry = mysqli_query($this->conn, "SELECT * FROM user WHERE user.username = '$var'");

        $output = mysqli_fetch_array($qry, 1);
        return $output;
    }


    public function showDetailsById($var = 0)
    {
        $qry = mysqli_query($this->conn, "SELECT * FROM user WHERE user.id = '$var'");

        $output = mysqli_fetch_array($qry, 1);
        return $output;

    }


    public function create($email,$username,$password, $date,$ref)
    {

        $password_hash = Utility::EncryptPassword($password);

        $qry =
            "INSERT INTO user(
                id, 
                username, 
                email, 
                password, 
                referral, 
                updated, 
                created) 
                VALUES (
                    '0', 
                    '$username', 
                    '$email', 
                    '$password_hash', 
                    '$ref', 
                    '$date',
                    '$date'
                    );"
        ;

        if ($this->conn->query($qry)) {
            $user = $this->showDetailsByEmail($email);
            return $user;
        }else{
            return false;
        }
        
    }


    public function update($data)
    {
        if(!isset($data['id'])){
            return false;
        }

        $id = $data['id'];
        $date = Utility::GetTimeStamp();

        $data['updated'] = $date;

        $qry1 = 'UPDATE user SET id = '.$id;
        $qry2 = ' WHERE user.id = ' . $id;


        if (isset($data['username'])) {
            $qry1 = $qry1 . ", username = '" . $data['username']."'";
        }
        if (isset($data['pic'])) {
            $qry1 = $qry1 . ", pic = '" . $data['pic']."'";
        }
        if (isset($data['password'])) {
            $qry1 = $qry1 . ", password = '" . $data['password']."'";
        }
        if (isset($data['plan'])) {
            $qry1 = $qry1 . ", plan = '" . $data['plan']."'";
        }
        if (isset($data['last_plan'])) {
            $qry1 = $qry1 . ", last_plan = '" . $data['last_plan']."'";
        }
        if (isset($data['status'])) {
            $qry1 = $qry1 . ", status = '" . $data['status']."'";
        }
        if (isset($data['allow_public_chat'])) {
            $qry1 = $qry1 . ", allow_public_chat = '" . $data['allow_public_chat']."'";
        }
        if (isset($data['role'])) {
            $qry1 = $qry1 . ", role = '" . $data['role']."'";
        }
        if (isset($data['balance_deposit'])) {
            $qry1 = $qry1 . ", balance_deposit = '" . $data['balance_deposit']."'";
        }
        if (isset($data['balance_earned'])) {
            $qry1 = $qry1 . ", balance_earned = '" . $data['balance_earned']."'";
        }
        if (isset($data['plan_ending'])) {
            $qry1 = $qry1 . ", plan_ending = '" . $data['plan_ending']."'";
        }
        if (isset($data['plan_purchased'])) {
            $qry1 = $qry1 . ", plan_purchased = '" . $data['plan_purchased']."'";
        }
        if (isset($data['last_plan_purchased'])) {
            $qry1 = $qry1 . ", last_plan_purchased = '" . $data['last_plan_purchased']."'";
        }
        if (isset($data['code'])) {
            $qry1 = $qry1 . ", code = '" . $data['code']."'";
        }
        if (isset($data['token'])) {
            $qry1 = $qry1 . ", token = '" . $data['token']."'";
        }
        if (isset($data['free_trial'])) {
            $qry1 = $qry1 . ", free_trial = '" . $data['free_trial']."'";
            
        }
        if (isset($data['updated'])) {
            $qry1 = $qry1 . ", updated = '" . $data['updated']."'";
        }
        if (isset($data['created'])) {
            $qry1 = $qry1 . ", created = '" . $data['created']."'";
        }

        $full_qry = $qry1 . $qry2;

        if($this->conn->query($full_qry)){
            return true;
        }else{
            $this->error = $this->conn->error;
            return false;
        }

    }

    public function showAllPlanUsers($sp = 0,$limit = 9999)
    {
        return $this->Query("SELECT * FROM user WHERE user.plan != 0 AND user.plan_purchased != 'null' ORDER BY user.id ASC LIMIT $sp,$limit ;")->fetch_all(1);
    }

    public function getAllPlanExpiredUsers()
    {
        $date = Utility::GetTimeStamp();
        return $this->Query("SELECT * FROM user WHERE user.plan != 0 AND user.plan_ending < '$date'")->fetch_all(1);
    }

    public function countAll()
    {
        $count = $this->Query("SELECT COUNT(*) AS count FROM user")->fetch_array(1);
        if($count){
            return $count['count'];
        }else{
            return 0;
        }
    }

    public function getField($id, $field)
    {
        return $this->Query("SELECT $field FROM user WHERE id = '$id' ;")->fetch_array(1);
    }

    public function getAllEnrgyRechargeableUsers()
    {
        $date = Utility::GetTimeStamp();
        return $this->Query("SELECT user.*, miners.energy, miners.status AS 'miner_status' FROM `user` JOIN miners ON miners.user_id = user.id WHERE miners.energy < 1440 AND miners.status = 0")->fetch_all(1);
    }

}


?>