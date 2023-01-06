<?php

class Plan {

    public $conn = null;

    public function __construct(){
        $this->conn = $GLOBALS['DB_CONNECTION'];
    }

    public function showAll(){
        $qry = mysqli_query($this->conn, "SELECT * FROM plans ORDER BY plans.id ASC");
        $result = mysqli_fetch_all($qry,1);
        return $result;

    }


    public function showAllDefault(){
        $qry = mysqli_query($this->conn, "SELECT * FROM plans WHERE plans.type = 'default' ORDER BY plans.id ASC");
        $result = mysqli_fetch_all($qry,1);
        return $result;

    }

    public function showByUserId($user_id){
        $qry = mysqli_query($this->conn, "SELECT * FROM plans WHERE plans.user_id = '$user_id' ORDER BY plans.id ASC");
        $result = mysqli_fetch_all($qry,1);
        return $result;

    }


}

?>