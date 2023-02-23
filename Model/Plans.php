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


    public function create($data)
    {
        try {
            $name = $data['name'];
            $algo = $data['algo'];
            $speed = $data['speed'];
            $duration = $data['duration'];
            $earning = $data['earning'];
            $price = $data['price'];
            $package = $data['package'];
            $true_speed = $data['true_speed'];
            $time = Utility::GetTimeStamp();

        return $this->Query("INSERT INTO `plans`(`id`, `name`, `algo`, `speed`, `duration`, `earning`, `price`, `package`, `true_speed`, `updated`, `created`)
                                 VALUES ('0','$name','$algo','$speed','$duration','$earning','$price','$package','$true_speed','$time','$time')");
        } catch (\Throwable $th) {
            return false;
        }
        
    }

    public function showFreePlan()
    {
        return $this->Query("SELECT * FROM plans WHERE plans.id = '1' ;")->fetch_array(1);
    }


    public function Save($data)
    {
        if($this->id != "0" || isset($data['id'])){

            if(isset($data['id'])){
                $this->id = $data['id'];
            }

            $keys = array_keys($data);

            $qry = "UPDATE plans SET ";

            for ($i=0; $i < count($keys); $i++) { 
                $key = $keys[$i];

                if($key != "id"){
                    $value = $data[$key];
                    $qry .= $key . " = '$value' ";

                    if(count($keys) != ($i+2)){
                        $qry .= ", ";
                    }
                }
            }

            $qry .= "WHERE id = '$this->id' ;";
            //echo $qry;
            $result = $this->Query($qry);

        }else{
            $result = false;
        }

        return $result;
    }


    public function delete($id)
    {
        return $this->Query("DELETE FROM plans WHERE id = '$id' ;");
    }


}

?>