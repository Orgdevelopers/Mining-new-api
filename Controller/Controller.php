<?php

class Controller {

    public function loadModel($class){
        $model = new $class();
        $this->$class = $model;
        
    }

    public function loadModels(array $classess){
        foreach($classess as $class){
            $model = new $class();
            $this->$class = $model;
        }
        
    }

}

?>