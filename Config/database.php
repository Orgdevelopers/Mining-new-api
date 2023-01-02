<?php

class Database{

    public function getDatabase(){

        $host_name = DATABASE_HOST;
        $db_user = DATABASE_USER;
        $db_password = DATABASE_PASSWORD;
        $db_name = DATABASE_NAME;

        $conn = new mysqli($host_name, $db_user, $db_password, $db_name);
        if($conn->connect_error){
            echo $conn->connect_error;
            die;
        }else{
            define('DB_CONNECTION',$conn);
        }

    }

}