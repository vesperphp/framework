<?php

namespace Route;

use Route\Register;
use Route\Store;

class Route{

    
    public static function register($route, $at){

        $new = new Register;

        $new->route($route);

        $mvc = explode("@", $at);

        if(is_array($mvc) && count($mvc)==2){

            $new->controller($mvc[0]);
            $new->method($mvc[1]);

        }else{

            // Keep

        }

        return $new;

    }

    public static function load(){

        require_once ROOTPATH. '/routes.php';
    }

    public static function find(){

        $search = new Store;
        return $search->process();

    }

}

/*
       $l = new Limit('test2', seconds, count);
       $l->check();
*/
