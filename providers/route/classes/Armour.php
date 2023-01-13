<?php

namespace Route;


class Armour{

    public function call($controller, $method, $values = []){
          
        
        if(!class_exists($controller)){
            echo("Armour: Class ".$controller." does not exist.");
        }

        if(!method_exists($controller, $method)){
            echo("Armour: Method ".$method." within ".$controller." does not exist.");
        }

        if(!is_array($values) && strlen($values)!=0){
            $values['param'] = $values;
        }

        if(!is_array($values)){
            $values['param'] = [];
        }


        echo "<pre>";
        var_dump([[$controller, $method], $values]);
        echo "</pre>";




        call_user_func_array([$controller, $method], $values);

    }

}