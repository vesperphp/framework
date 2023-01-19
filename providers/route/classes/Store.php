<?php

namespace Route;

use Config\Config;
use Sequel\Sequel;

class Store{

    public $path = '/';


    public function __destruct(){

        echo "<pre>";

        var_dump($this);

        echo "</pre>";

        // keep

    }

    public function exists(){

        
        $db = Sequel::select("_routes")->where("path","=",$this->path)->do();
        $this->object = $db;
        
        return $db;

    }

    public function create($mass = []){

        Sequel::insert("_routes")
        ->mass($mass)
        ->do();

        
    }

    public function update($mass){

        Sequel::update("_routes")
        ->where('path','=',$this->path)
        ->mass($mass)
        ->do();

    }

    public function route($path, $a){

        $this->register = $a;
        $this->path = $path;

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