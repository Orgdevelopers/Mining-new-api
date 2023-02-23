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


    public function Save($data)
    {
        if($this->id != "0" || isset($data['user_id'])){

            if(isset($data['user_id'])){
                $this->id = $data['user_id'];
            }

            $keys = array_keys($data);

            $qry = "UPDATE plans SET ";

            for ($i=0; $i < count($keys); $i++) { 

                $key = $keys[$i];

                if($key != "user_id"){
                    $value = $data[$key];
                    $qry .= $key . " = '$value' ";

                    if(count($keys) != ($i+2)){
                        $qry .= ", ";
                    }
                }
            }

            $qry .= "WHERE user_id = '$this->id' ;";

            $result = $this->Query($qry);

        }else{
            $result = false;
        }

        return $result;
    }


}

?>