<?php

namespace service;

class Session{

    public static function set(string $key, $value){

        $_SESSION[$key] = $value;

        return [$key => $value];

    }

    public static function get(string $key){

        return $_SESSION[$key];

    }

    public static function drop(string $key){

        unset( $_SESSION[$key] );

    }

    public static function tree(){
        
        return $_SESSION;

    }

}