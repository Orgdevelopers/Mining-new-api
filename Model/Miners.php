<?php

class Miners extends AppModel
{

    public $conn = null;
    public $db = 'miners';

    public $id = "0";

    public function __construct()
    {
        $this->conn = $GLOBALS['DB_CONNECTION'];
    }


    public function create($user_id, $plan_id, $status = 0)
    {
        $date = Utility::GetTimeStamp();
        if($this->getUserMiner($user_id)){
            $this->id = $user_id;
            $this->saveField('status', 0);
            $this->saveField('plan_id', $plan_id);
            $this->saveField('activation_time', $date);

            return true;

        }
        $qry = "INSERT INTO miners(id, user_id, plan_id, status, activation_time, cron_hit_time, created) 
                            VALUES ('0','$user_id','$plan_id','$status','$date','$date','$date') ;";

        return $this->Query($qry);
    }

    public function getUserMiner($user_id)
    {
        return $this->Query("SELECT * FROM $this->db WHERE user_id = '$user_id' ;")->fetch_array(1);
    }


    public function Delete($user_id)
    {
        $qry = "DELETE FROM $this->db WHERE user_id = '$user_id' ;";

        return $this->Query($qry);
    }

    public function getField($user_id, $field)
    {
        return $this->Query("SELECT $field FROM $this->db WHERE user_id = '$user_id' ;")->fetch_array(1);
    }

    public function saveField($field,$value)
    {
        if($this->id != "0"){
            $result = $this->Query("UPDATE $this->db SET $field = '$value' WHERE user_id = '$this->id'");
        }else{
            $result = false;
        }
        return $result;
    }

    public function Save($data)
    {
        if($this->id != "0" || isset($data['user_id'])){

            if(isset($data['user_id'])){
                $this->id = $data['user_id'];
            }

            $keys = array_keys($data);

            $qry = "UPDATE $this->db SET ";

            for ($i=0; $i < count($keys); $i++) { 

                $key = $keys[$i];

                if($key != "user_id"){
                    $value = $data[$key];
                    $qry .= $key . " = '$value' ";

                    if(count($keys) != ($i+1)){
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