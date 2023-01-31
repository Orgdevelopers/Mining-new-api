<?php

class LiveRate extends AppModel{

    public $conn = null;
    public $db = 'live_rate';

    public $id = "0";

    public function __construct()
    {
        $this->conn = $GLOBALS['DB_CONNECTION'];
    }

    public function showLiveRate($name = "BTC")
    {
        $qry = $this->Query($this->conn, "SELECT * FROM live_rate WHERE live_rate.price != '' ORDER BY live_rate.id DESC LIMIT 0,1 ");
        $result = $this->FetchArray($qry);

        if(!$result){
            $this->error = $this->conn->error;
        }

        return $result;
    }


    public function UpdateLiveRate($rate,$date)
    {
        $result = $this->Query($this->conn, "INSERT INTO live_rate(id, name, price, time) VALUES('0', 'BTC', '$rate', '$date')");

        return $this->conn->insert_id;

    }

    public function Count()
    {
        $result = $this->FetchArray($this->Query($this->conn, "SELECT COUNT(*) AS 'row_count' FROM live_rate"));

        return $result['row_count'];
        
    }


    public function DeleteOlder($count = 576)
    {
        $result = $this->Query($this->conn, "DELETE FROM live_rate WHERE live_rate.id IN (select * from ( SELECT live_rate.id FROM live_rate ORDER BY live_rate.id DESC LIMIT $count,99 ) temp_tab);");
        
        return $result;
    }

    public function RefreshIDs()
    {
        return $this->conn->query("SET  @num := 0;
        UPDATE live_rate SET live_rate.id = @num := (@num+1);
        ALTER TABLE live_rate AUTO_INCREMENT =1; ");
    }


    public function ShowAll($count = 600)
    {
        return $this->Query($this->conn, "SELECT * FROM $this->db ORDER BY id DESC LIMIT 0,$count")->fetch_all(1);
    }

    
    public function saveField($field,$value)
    {
        if($this->id != "0"){
            $result = $this->Query($this->conn, "UPDATE $this->db SET $field = '$value' WHERE id = '$this->id'");
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

            $result = $this->Query($this->conn,$qry);

        }else{
            $result = false;
        }

        return $result;
    }

}

?>