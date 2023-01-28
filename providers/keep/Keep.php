<?php

namespace Keep;

use service\Session;

class Keep{

    public static function tailgate(){

        echo "<hr><h3>Tailgate</h3><pre>";  
        var_dump( Session::get('_keep') );
        echo "</pre><hr>";

    }

    public static function store($key, $array){

        $a = [$key => $array];
        if(is_array(Session::get('_keep'))){

            $o = Session::get('_keep');
            $a = array_replace_recursive($o, $a);

            Session::set('_keep', $a);

        }else{

            Session::set('_keep', $a);

        }

    }
    
    
}