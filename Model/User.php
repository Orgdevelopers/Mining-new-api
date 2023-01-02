<?php

class User {

    public function __construct(){
        $this->conn = DB_CONNECTION;
    }

    public function show_all(){
        $qry = mysqli_query($this->conn, "SELECT * FROM user ORDER BY user.name ");
    }




}

?>