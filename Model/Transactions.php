<?php

class Transactions extends AppModel
{

    public $conn = null;
    public $db = 'transactions';

    public $id = "0";

    public function __construct()
    {
        $this->conn = $GLOBALS['DB_CONNECTION'];
    }


    public function create($user_id,$data)
    {

        $type = 0;
        $wallet_type = 0;
        $amount = 0;
        $title = "";
        $msg = "";
        $status = 0;
        $updated = Utility::GetTimeStamp();
        $created = $updated;
        $charge = 0;

        if(isset($data['type'])){$type = $data['type'];}
        if(isset($data['wallet_type'])){$wallet_type = $data['wallet_type'];}
        if(isset($data['amount'])){$amount = $data['amount'];}
        if(isset($data['title'])){$title = $data['title'];}
        if(isset($data['message'])){$msg = $data['message'];}
        if(isset($data['status'])){$status = $data['status'];}
        if(isset($data['updated'])){$updated = $data['updated'];}
        if(isset($data['charge'])){$updated = $data['charge'];}


        $result = $this->Query("INSERT INTO $this->db(id, user_id, type, wallet_type, amount, title, charge, message, status, updated, created)
                                                    VALUES('0', '$user_id', '$type', '$wallet_type', '$amount', '$title', '$charge', '$msg', '$status', '$updated', '$created');");

        
        return $result;

    }


    public function getUserAll($user_id,$starting_point = 0, $limit = 10)
    {
        return $this->Query("SELECT * FROM $this->db WHERE user_id = '$user_id' ORDER BY id DESC LIMIT $starting_point,$limit ;")->fetch_all(1);
    }

    public function getAll($user_id,$starting_point = 0, $limit = 10)
    {
        return $this->Query("SELECT * FROM $this->db ORDER BY id DESC LIMIT $starting_point,$limit ;")->fetch_all(1);
    }

    public function getUserInvest($user_id,$starting_point = 0, $limit = 10)
    {
        return $this->Query("SELECT * FROM $this->db WHERE user_id = '$user_id' AND wallet_type = 0 ORDER BY id DESC LIMIT $starting_point,$limit ;")->fetch_all(1);
    }

    public function getUserTask($user_id,$starting_point = 0, $limit = 10)
    {
        return $this->Query("SELECT * FROM $this->db WHERE user_id = '$user_id' AND wallet_type = 1 ORDER BY id DESC LIMIT $starting_point,$limit ;")->fetch_all(1);
    }

    public function getUserMine($user_id,$starting_point = 0, $limit = 10)
    {
        return $this->Query("SELECT * FROM $this->db WHERE user_id = '$user_id' AND wallet_type = 2 ORDER BY id DESC LIMIT $starting_point,$limit ;")->fetch_all(1);
    }

    public function getUserWithdraw($user_id,$starting_point = 0, $limit = 10)
    {
        return $this->Query("SELECT * FROM $this->db WHERE user_id = '$user_id' AND type = 1 ORDER BY id DESC LIMIT $starting_point,$limit ;")->fetch_all(1);
    }

    public function getUserDeposit($user_id,$starting_point = 0, $limit = 10)
    {
        return $this->Query("SELECT * FROM $this->db WHERE user_id = '$user_id' AND type = 2 ORDER BY id DESC LIMIT $starting_point,$limit ;")->fetch_all(1);
    }

    public function getUserPending($user_id,$wallet)
    {
        return $this->Query("SELECT * FROM $this->db WHERE user_id = '$user_id' AND status = 0 AND wallet_type = '$wallet' ;")->fetch_array(1);
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