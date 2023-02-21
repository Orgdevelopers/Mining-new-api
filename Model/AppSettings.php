<?php

class AppSettings extends AppModel
{

    public $conn = null;
    public $db = 'app_settings';

    public $id = "1";

    public function __construct()
    {
        $this->conn = $GLOBALS['DB_CONNECTION'];
    }

    public function getAppSettings()
    {
        return $this->Query("SELECT * FROM app_settings WHERE id = 1 ;")->fetch_array(1);
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

                    if(count($keys) != ($i+2)){
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

?>