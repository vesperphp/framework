<?php

namespace Framework;


class Cli{


    public static function command($input){

        if(!isset($input[1])){
            Cli::help($input);
        }

        $explode = explode(":",$input[1]);
        $controller = "Framework\\".ucfirst($explode[0]);
        $method = $explode[1];

        if(class_exists($controller)){

            $foundry = new $controller;

        }else{

            echo "\nController '".$controller."' not found.\n";
            Cli::help($input);
            exit;

        }

        if(!method_exists($controller, $method)){ 

            echo "\nMethod '".$method."' not found.\n";
            Cli::help($input);     
            exit;

        }else{

            if(isset($input[2])){
            
                $flags = str_replace(" ","",$input[2]);
                $flags = explode("/", $flags);
                $flags = array_filter($flags);
            
                $foundry->$method($flags);
            
            }else{
            
                $foundry->$method();
                
            }

        }

    }

    public static function help($input){

        echo "The command you used is not valid: \e[33m".$input[1]. "\e[39m. Need any help?\n\n";

     }


}