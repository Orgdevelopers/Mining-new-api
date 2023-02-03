<?php

class Plans extends AppModel {

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
        $qry = mysqli_query($this->conn, "SELECT * FROM plans WHERE plans.id != 0 AND plans.user_id = '$user_id' ORDER BY plans.id ASC");
        $result = mysqli_fetch_all($qry,1);
        return $result;

    }

    public function showUserDefault($user_id){
        $qry = mysqli_query($this->conn, "SELECT * FROM plans WHERE plans.id != 0 AND plans.user_id = '$user_id' OR plans.user_id = '0' ORDER BY plans.id ASC");
        $result = mysqli_fetch_all($qry,1);

        return $result;

    }


    public function showDetailById($id)
    {
        $qry = mysqli_query($this->conn, "SELECT * FROM plans WHERE plans.id = '$id'");
        $result = mysqli_fetch_array($qry,1);

        return $result;
    }


    public function create()
    {
        # code...
    }

    public function showFreePlan()
    {
        return $this->Query("SELECT * FROM plans WHERE plans.id = '1' ;")->fetch_array(1);
    }


}

?>