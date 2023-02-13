<?php

class AppController {

    public function handle_rquest($url){

        $controller = $url[count($url)-2];
        $request = $url[count($url)-1];
        // // // // // // // // // // // // // // // // // // // // // 
        
        if($controller == "api"){
            $this->initApi();

            $source = new ApiController();

            $database = new Database();
            $database->getDatabase();

            try {
                $source->$request();
            } catch (\Throwable $th) {
                throw $th;
            }

        }else if($controller == "admin"){
            $this->initApi();

            $source = new AdminController();

            $database = new Database();
            $database->getDatabase();

            try {
                $source->$request();
            } catch (\Throwable $th) {
                throw $th;
            }

        }else{
            echo $request;

        }

    }


    public static function initApi(){
        require 'autoload.php';

    }

}

?>