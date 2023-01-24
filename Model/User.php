<?php

class User {

    public $error = null;

    public $conn = null;

    public function __construct()
    {
        $this->conn = $GLOBALS['DB_CONNECTION'];
    }

    public function showAll()
    {
        $qry = mysqli_query($this->conn, "SELECT * FROM user ORDER BY user.name ");
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
        if (isset($data['minig_started'])) {
            $qry1 = $qry1 . ", minig_started = '" . $data['minig_started']."'";
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

}

/* $qry = mysqli_query($this->conn,
            "INSERT INTO user(
                id, 
                username, 
                email, 
                password, 
                pic, 
                plan, 
                last_plan, 
                status, 
                role, 
                balance_deposit, 
                balance_earned, 
                minig_started, 
                plan_purchased, 
                last_plan_purchased, 
                updated, 
                created) 
                VALUES (
                    '0', 
                    '$username', 
                    '$email', 
                    '$password_hash', 
                    )") */
?>