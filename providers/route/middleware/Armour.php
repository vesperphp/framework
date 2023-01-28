<?php

namespace Route;

/**
 * Armour calls the middleware from
 * the middleware classes and puts
 * them to use.
 */

class Armour{

    public function call($controller, $method, $values = []){
          
        $controller = "Middleware\\".$controller;
        
        if(!class_exists($controller)){
            die("Armour: Class ".$controller." does not exist."); // keep
            return false;
        }

        if(!method_exists($controller, $method)){
            die("Armour: Method ".$method." within ".$controller." does not exist."); // keep
            return false;
        }

        if(!is_array($values) && strlen($values)!=0){
            $values['param'] = $values;
        }

        if(!is_array($values)){
            $values['param'] = [];
        }

        $ar = new $controller;

        $ar->$method($values);

        return true;


    }

}