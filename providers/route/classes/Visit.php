<?php

namespace Route;

use Config\Config;
use Sequel\Sequel;

/**
 * Pulls all the info from the database
 * regarding the requested route
 * or stores a 404 notice and returns that 
 * to the paint class.
 */

class Visit{

    public function __construct($a = []){

        $this->request = Request::url();
        $this->path = Config::get('app/url').$this->request;

    }

    public function __destruct(){

        echo "<pre>";

        var_dump($this);

        echo "</pre>";

        // keep

    }

    public function exists(){

        $db = Sequel::select("_routes")->where("route","=",$this->request)->do();
        $this->object = $db;
        
        return $db;

    }

    public function create(){

        Sequel::insert("_routes")
        ->set("route", $this->route)
        ->do();
        
    }

    public function process(){

        if($this->exists()){

            dump($this);

        }else{

            echo "page not found, register the url anyway with 404";

        }

        // internal analytics can run here
        // keep

        return $this;

    }

}