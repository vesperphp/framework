<?php

namespace Route;

use Config\Config;
use Sequel\Sequel;

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

        
        $db = Sequel::select("_routes")->where("path","=",$this->path)->do();
        $this->object = $db;
        
        return $db;

    }

    public function create(){

        Sequel::insert("_routes")
        ->set("path", $this->path)
        ->do();
        
    }

    public function process(){

        if($this->exists()){

            

            $this->update();

        }else{

            $this->create();

        }

        // internal analytics can run here
        // keep

        return $this;

    }

}