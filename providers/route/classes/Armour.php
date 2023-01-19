<?php

namespace Route;


class Armour{

    public function call($controller, $method, $values = []){
          
        $controller = "Middleware\\".$controller;
        
        if(!class_exists($controller)){
            die("Armour: Class ".$controller." does not exist.");
        }

        if(!method_exists($controller, $method)){
            die("Armour: Method ".$method." within ".$controller." does not exist.");
        }

        if(!is_array($values) && strlen($values)!=0){
            $values['param'] = $values;
        }

        if(!is_array($values)){
            $values['param'] = [];
        }

        $ar = new $controller;

        $ar->$method($values);

        var_dump($method);
        return $ar;


    }

}