<?php

class User {

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


    public function create($email,$username,$password, $date)
    {

        $password_hash = Utility::EncryptPassword($password);

        $qry =
            "INSERT INTO user(
                id, 
                username, 
                email, 
                password, 
                updated, 
                created) 
                VALUES (
                    '0', 
                    '$username', 
                    '$email', 
                    '$password_hash', 
                    '$date',
                    '$date',
                    );"
        ;

        if ($this->conn->query($qry)) {
            $user = $this->showDetailsByEmail($email);
            return $user;
        }else{
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