<?php

class ApiController {

    public function index(){

        $conn = DB_CONNECTION;

        $rows = mysqli_fetch_all(mysqli_query($conn, "select * from user"));

        echo json_encode($rows);

    }

}

?>