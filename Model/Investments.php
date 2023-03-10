<?php

class Investments extends AppModel
{

    public $conn = null;
    public $db = 'investments';

    public $id = "0";

    public function __construct()
    {
        $this->conn = $GLOBALS['DB_CONNECTION'];
    }


    public function create($user_id,$investment_id,$amount,$ending,$status = 0)
    {
        $time = Utility::GetTimeStamp();
        return $this->Query("INSERT INTO investments(id, user_id, investment_plan_id, amount, status, ending_date, created) 
                                            VALUES ('0','$user_id','$investment_id','$amount','$status','$ending','$time')");
    }

    public function getAll(){
        return $this->Query("SELECT * FROM $this->db ")->fetch_all(1);
    }


    public function getUserAll($user_id,$sp,$limit = APP_RECORDS_PER_PAGE)
    {
        return $this->Query("SELECT * FROM $this->db WHERE user_id = '$user_id' ORDER BY status ASC LIMIT $sp,$limit;")->fetch_all(1);
    }

    public function getDetailsById($id)
    {
        return $this->Query("SELECT * FROM $this->db WHERE id = '$id';")->fetch_array(1);
    }

    public function getUserAllPending($user_id,$sp,$limit = APP_RECORDS_PER_PAGE)
    {
        return $this->Query("SELECT * FROM $this->db WHERE user_id = '$user_id' AND status = '0' ORDER BY id DESC LIMIT $sp,$limit;")->fetch_all(1);
    }


    public function getField($id, $field)
    {
        return $this->Query("SELECT $field FROM $this->db WHERE id = '$id' ;")->fetch_array(1);
    }


    public function countActive()
    {
        $result =  $this->Query("SELECT COUNT(*) AS count FROM $this->db WHERE status = 0 ")->fetch_array(1);
        if($result){
            return $result['count'];
        }else{
            return 0;
        }
    }


    public function countUser($user_id, $status = 0)
    {
        $result =  $this->Query("SELECT COUNT(*) AS count FROM $this->db WHERE status = '$status' AND user_id = '$user_id'; ")->fetch_array(1);
        if($result){
            return $result['count'];
        }else{
            return 0;
        }
    }


    public function getExpired($date)
    {
        return $this->Query("SELECT * FROM $this->db WHERE status = 0 AND ending_date < '$date';")->fetch_all(1);
    }

    public function saveField($field,$value)
    {
        if($this->id != "0"){
            $result = $this->Query("UPDATE $this->db SET $field = '$value' WHERE id = '$this->id'");
        }else{
            $result = false;
        }
        return $result;
    }

    public function Save($data)
    {
        if($this->id != "0" || isset($data['id'])){

            if(isset($data['id'])){
                $this->id = $data['id'];
            }

            $keys = array_keys($data);

            $qry = "UPDATE $this->db SET ";

            for ($i=0; $i < count($keys); $i++) { 

                $key = $keys[$i];

                if($key != "id"){
                    $value = $data[$key];
                    $qry .= $key . " = '$value' ";

                    if(count($keys) != ($i+1)){
                        $qry .= ", ";
                    }
                }
            }

            $qry .= "WHERE id = '$this->id' ;";

            $result = $this->Query($qry);

        }else{
            $result = false;
        }

        return $result;
    }

}