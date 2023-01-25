<?php

class AppModel {

    public $error = "";

    public function Query($conn,$qry)
    {
        $result = mysqli_query($conn, $qry);
        if(!$result){
            $this->error = $conn->error;
        }

        return $result;
    }

    public function FetchAll($qry,$type = 1)
    {
        return mysqli_fetch_all($qry, $type);
    }

    public function FetchArray($qry,$type = 1)
    {
        
        $result = mysqli_fetch_array($qry, $type);

        return $result;
    }

}

?>