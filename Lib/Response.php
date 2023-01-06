<?php

class Response{

    public static function IncompleteParams($dev_msg = "NONE")
    {
        $body = array(
            'code' => 400,
            'dev_msg' => $dev_msg,
            'msg' => 'Error: incomplete params or request body'
        );

        echo json_encode($body);
        
    }


    public static function ServerError($var = "NONE")
    {
        # code...
        $body = array(
            'code' => 500,
            'dev_msg' => $var,
            'msg' => 'Error: Server did not respond to your request please try again later'
        );

        echo json_encode($body);
    }

    public static function NoRecords($var = 'NONE')
    {
        # code...
        $body = array(
            'code' => 100,
            'dev_msg' => $var,
            'msg' => 'No records found matching your request'
        );

        echo json_encode($body);
    }

    public static function AuthFailed($var = "")
    {
       # code...
        $body = array(
            'code' => 401,
            'dev_msg' => $var,
            'msg' => 'Error: Failed to authenticate'
        );

        echo json_encode($body);
    }


}

?>