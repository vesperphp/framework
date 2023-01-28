<?php

namespace Route;

use Keep\Keep;

class Paint{

    public static function front(){

        $route = Route::find();
        //var_dump($route);

        Route::middleware($route);

    }



}