<?php

namespace Route;

use Config\Config;
use Sequel\Sequel;

/**
 * Store puts routing information
 * in the database.. If it doesn't
 * exist already.
 */

class Store{

    public $route = '/';


    public function __destruct(){

        /*echo "<pre>";

        var_dump($this);

        echo "</pre>";*/

        // keep

    }

    public function exists(){

        $db = Sequel::select("_routes")->where("route","=",$this->route)->do();
        $this->object = $db;
        
        return $db;

    }

    public function create($mass = []){

        Sequel::insert("_routes")
        ->mass($mass)
        ->do();

        
    }

    public function update($mass){

        echo "update";
        Sequel::update("_routes")
        ->where('route','=',$this->route)
        ->mass($mass)
        ->do();

        var_dump($this->route);

    }

    public function route($route, $a){

        $this->register = $a;
        $this->route = $route;

        if($this->exists()){ 

            $this->update($a);

        }else{

            $this->create($a);

        }

        // internal analytics can run here
        // keep

        return $this;

    }

}