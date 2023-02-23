<?php

class BuyWithCrypto extends AppModel
{

    public $conn = null;
    public $db = 'buy_with_crypto';

    public $id = "0";

    public function __construct()
    {
        $this->conn = $GLOBALS['DB_CONNECTION'];
    }


    public function create($user_id,$plan_id,$investment_id,$amount,$attachment,$action,$status = 0)
    {
        $time = Utility::GetTimeStamp();
        return $this->Query("INSERT INTO $this->db(id, user_id, plan_id, investment_plan_id, attachment, amount, action, status, created) 
                                            VALUES ('0','$user_id', '$plan_id','$investment_id', '$attachment','$amount', '$action','$status','$time')");
    }

    public function getAll(){
        return $this->Query("SELECT * FROM $this->db ")->fetch_all(1);
    }


    public function getAllPending($type = "plan",$sp = 0,$limit = 999)
    {
        return $this->Query("SELECT * FROM $this->db WHERE action = '$type' AND status = 0 ORDER BY id ASC LIMIT $sp,$limit ;")->fetch_all(1);
    }


    public function getDetailsById($id)
    {
        return $this->Query("SELECT * FROM $this->db WHERE id = '$id' ;")->fetch_array(1);
    }


    public function countPending()
    {
        $result = $this->Query("SELECT COUNT(*) AS count FROM $this->db WHERE status = 0")->fetch_array(1);
        if($result){
            return $result['count'];
        }else{
            return 0;
        }
    }

    public function getUserPending($user_id,$action)
    {
        return $this->Query("SELECT * FROM $this->db WHERE user_id = '$user_id' AND action = '$action' AND status = 0 ;")->fetch_all(1);
    }

    public function getUserAll($user_id)
    {
        return $this->Query("SELECT * FROM $this->db WHERE user_id = '$user_id' ;")->fetch_all(1);
    }

    public function getField($id, $field)
    {
        return $this->Query("SELECT $field FROM $this->db WHERE id = '$id' ;")->fetch_array(1);
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