<?php

namespace Config;

use Keep\Keep;
use service\Session;

class Config{


    public static function get(string $key){

        $sess = Session::get("system/config");

        if(empty($sess)){
            $sess = Config::load();
        }

        if(isset($sess[$key])){

            return $sess[$key];

        }

    }


    public static function load(){

        $conf = ROOTPATH."/.conf"; // - note: change to Keep::
        $contents = file($conf);

        $store = [];
        foreach($contents as $value){

            //$value = str_replace(': ', ':|:', $value);
            $explode = explode(": ", $value);

            if(
                substr($value,0,1)!='#' 
                && $value!="" 
                && $value!=" "
                && isset($explode[0])
                && isset($explode[1])
            ){ 
                
                
                $store[$explode[0]] = str_replace("\n","",$explode[1]);
            }
            
        }
        // Store in session
        Session::set("system/config", $store);
        return $store;


    }

    public static function dev($arg = ['development', 'build']){

        $store = Config::load();

        if(in_array($store["system/state"],$arg)){ return true; }
       
        return false;

    }

}