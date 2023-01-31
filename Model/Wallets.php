<?php

class Wallets extends AppModel
{

    public $conn = null;
    public $db = 'wallets';

    public $id = "0";

    public function __construct()
    {
        $this->conn = $GLOBALS['DB_CONNECTION'];
    }


    public function create($user_id)
    {

        $wallet = $this->getUserWallets($user_id);
        if(!$wallet){

            $adr_invest = '{"'.$user_id.'":"invest"}';
            $adr_mine = '{"'.$user_id.'":"mine"}';
            $adr_task = '{"'.$user_id.'":"task"}';

            $adr_invest = Utility::EncryptPassword($adr_invest);
            $adr_mine = Utility::EncryptPassword($adr_mine);
            $adr_task = Utility::EncryptPassword($adr_task);

            $created = Utility::GetTimeStamp();

            $qry = "INSERT INTO $this->db(id, user_id, address_invest, address_mine, address_task, created)
            VALUES('0', '$user_id', '$adr_invest', '$adr_mine', '$adr_task', '$created');";
            //echo $qry; 
            $result = $this->Query($this->conn, $qry);

                                           
            if($result){
                $result = $this->getUserWallets($user_id);
            }else{
                $this->error = $this->conn->error;
            }

        }else{
            $result = $wallet;
            $this->error = "Already exists";
        }

        
        return $result;

    }


    public function getUserWallets($user_id)
    {
        return $this->Query($this->conn,"SELECT * FROM $this->db WHERE user_id = '$user_id' ;")->fetch_array(1);
    }

    public function getField($user_id, $field)
    {
        return $this->Query($this->conn, "SELECT $field FROM $this->db WHERE user_id = '$user_id' ;")->fetch_array(1);
    }

    public function saveField($field,$value)
    {
        if($this->id != "0"){
            $result = $this->Query($this->conn, "UPDATE $this->db SET $field = '$value' WHERE user_id = '$this->id'");
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

            $result = $this->Query($this->conn,$qry);

        }else{
            $result = false;
        }

        return $result;
    }

}