<?php

namespace Middleware;

use Config\Config;
use service\Session;

/**
 * Auth checks if someone is logged in
 * and returns role information.
 */

class Auth{

    public function __construct(){
        echo "run auth";
    }

    // check if someone is logged in

    public function session(){

        echo "check if someone is logged in"; // keep
        return true;

    }

    // statics for use in code

    public static function role(){

        echo "return a users role"; // keep
        return true;

    }

    public static function loggedin(){

        echo "check if user is logged in"; // keep
        return true;

    }

    

}