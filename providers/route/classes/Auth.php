<?php

namespace Route;

use Config\Config;
use service\Session;

/**
 * Auth checks if someone is logged in
 * and returns role information.
 */

class Auth{

    // check if someone is logged in

    public function session(){

        echo "check if someone is logged in";

    }

    // statics for use in code

    public static function role(){

        echo "return a users role";

    }

    public static function loggedin(){

        echo "check if user is logged in";

    }

    

}