<?php

namespace Framework;

use Keep\Keep;
use Config\Config;
use Framework\Cli;
use service\Session;
use Framework\Vesper;

class Vesper{


    public static function up(){

        /**
         * Start Keep:
         * 
         * Do Some checks:
         * 
         * Store the route:
         * 
         * 
         */

        Config::load(); // Load the config file

    }

    public static function paint(){

        /**
         * Run frontier
         * paint the page
         */




         /**
          * Playground!
          */

        
    }

    public static function down(){

        /**
         * Report on keep
         * 
         * 
         */

        if(Config::dev()){   
            echo "<pre>";  
            var_dump( Keep::tailgate() );
            echo "</pre>";
        }
        
    }

    public static function boot(){

        Vesper::up();
        Vesper::paint();
        Vesper::down();
        
    }

    public static function cli($args = false){

        if(Config::dev()){     
            Cli::command($args);
        }else{
            echo "\nWe are in production. \n\e[33mCLI is disabled.\e[39m\n\n";
        }

    }

}