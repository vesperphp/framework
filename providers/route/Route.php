<?php

namespace Route;

use Route\Register;
use Route\Visit;

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