<?php

class Controller {

    public function loadModel($class){
        $model = new $class();
        $this->$class = $model;
        
    }

}

?>