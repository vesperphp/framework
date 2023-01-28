<?php

namespace Route;

use Route\Visit;
use Route\Register;
use Middleware\Auth;
use service\Session;

/**
 * Route handles sorting via the
 * register class and routes.php
 * and pulling the route information
 * out of the database on request.
 */

class Route{

    
    public static function register($route, $at){

        $new = new Register;

        $new->route($route);
        $new->controller($at);

        return $new;

    }

    public static function load(){

        require_once ROOTPATH. '/routes.php';

    }

    public static function find(){

        $search = new Visit;
        return $search->process();

    }


    public static function middleware($route){


        if(!isset($route['middleware'])){

            Session::set('_keep', ['middleware' => "middleware string not found"]);
            return false;

        }

        $mw = json_decode($route['middleware']);

        //var_dump($mw);
        if(!is_object($mw)){

            Session::set('_keep', ['middleware' => "Middleware string not an array"]);
            return false;

        }

        

        foreach($mw as $type => $content){

            // case!
            $type = explode("@", $type);
            $controller = "Middleware\\".ucfirst($type[0]);
            $method = $type[1];

            if(!class_exists($controller)){ 
            
                echo "class ".$controller." does not exist"; // keep
                return false;
            
            }

            /*if(!class_exists($controller)){ 
            
                echo "class ".$controller." does not exist"; // keep
                return false;
            
            }*/


            $ar = new $controller;
    
            $ar->$method($content);
    
            return true;

            
            // if any middleware doesnt pass, return false

        }

        Session::set('_keep', ['middleware' => "Middleware is functional"]);
        
        return true;
        
        

    }

    

}

/*
       $l = new Limit('test2', seconds, count);
       $l->check();
*/

/*
        $a = new Armour;
        $a->call("controller", "method","value array");
        // middleware/controller


        $a = new Auth;
        $a->session(); // returns true/false (or dies?)

*/