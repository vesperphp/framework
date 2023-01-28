<?php

namespace Route;

use Keep\Keep;

class Request{

    public static function url(){

        if(!isset($_GET['src'])){
            $source = '/';
        }else{
            $source = $_GET['src'];
        }

        // keep
        Keep::store('request', [$source]);
        
        // sanitize

        return $source;
        
    }

}