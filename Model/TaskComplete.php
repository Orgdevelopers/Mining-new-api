<?php

class Task extends AppModel
{

    public $conn = null;
    public $db = 'task_completed';

    public $id = "0";

    public function __construct()
    {
        $this->conn = $GLOBALS['DB_CONNECTION'];
    }


    public function create($user_id,$task_id)
    {
        $time = Utility::GetTimeStamp();
        return $this->Query("INSERT INTO $this->db(id, user_id, task_id, created) 
                                            VALUES ('0','$user_id', '$task_id','$time')");
    }

    public function getAll(){
        return $this->Query("SELECT * FROM $this->db ")->fetch_all(1);
    }


    public function getAllUser($user_id)
    {
        return $this->Query("SELECT * FROM $this->db WHERE user_id = '$user_id' ;")->fetch_all(1);
    }


    public function checkTaskCompleted($user_id,$task_id)
    {
        return $this->Query("SELECT * FROM $this->db WHERE user_id = '$user_id' and task_id = '$task_id' ;")->fetch_array(1);
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