<?php

class CryptoModel extends AppModel
{

    public $conn = null;
    public $db = 'crypto_address';

    public $id = "0";

    public function __construct()
    {
        $this->conn = $GLOBALS['DB_CONNECTION'];
    }


    public function getModel()
    {
        return $this->Query("SELECT * FROM $this->db WHERE id = 1 ;")->fetch_array(1);
    }

}

?>