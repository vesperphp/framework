<?php

namespace Framework;

use Keep\Keep;
use Route\Paint;
use Route\Route;
use Route\Armour;
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

         SystemRoutes::registerOnRoot(); // register system based routes
         Route::load(); // run routing file
         

    }

    public static function paint(){


        

        Paint::front();

         /**
          * Playground!
          */

          
          //$a = new Armour;
          //$a->call("Test", "pass",['1','2']);

        
    }

    public static function down(){

        /**
         * Report on keep
         * 
         * 
         */

 

        if(Config::dev()){   
            Keep::tailgate();
        }

        // wipe system/session
        
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