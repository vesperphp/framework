<?php

namespace Framework;

use Framework\Pattern;

/**
 * This is a CLI
 * command. make:(method)
 */

class Make{

    public function provider(array $flags = []){

        if(isset($flags[0])){
            
            Pattern::create("provider", $flags[0]);
            echo "\n\e[33mProvider\e[39m created!\n\n";

        }else{

            echo "\nPlease add a \e[33mprovider\e[39m name to the end of your command.\n\n";

        }

    }

    public function service(array $flags = []){

        if(isset($flags[0])){
            
            Pattern::create("service", $flags[0]);
            echo "\n\e[33mService\e[39m created!\n\n";

        }else{

            echo "\nPlease add a \e[33mservice\e[39m name to the end of your command.\n\n";

        }

    }

    public function filler(array $flags = []){

        if(isset($flags[0])){
            
            Pattern::create("filler", $flags[0]);
            echo "\n\e[33mFiller\e[39m file created!\n\n";

        }else{

            echo "\nPlease add a \e[33mfiller\e[39m name to the end of your command.\n\n";

        }

    }

    public function table(array $flags = []){

        if(isset($flags[0])){
            
            Pattern::create("table", $flags[0]);
            echo "\n\e[33mTable template\e[33m created!\n\n";

        }else{

            echo "\nPlease add a \e[33mtable\e[39m name to the end of your command.\n\n";

        }

    }

    public function mvc(array $flags = []){

        if(isset($flags[0])){
            
            Pattern::create("mvc", $flags[0]);
            echo "\n\e[33mMultiple MVC files\e[33m created!\n\n";

        }else{

            echo "\nPlease add a \e[33mclass\e[39mname to the end of your command.\n\n";

        }

    }

    public function cli(array $flags = []){

        if(isset($flags[0])){
            
            Pattern::create("cli", $flags[0]);
            echo "\n\e[33mCLI command class\e[33m created!\n\n";

        }else{

            echo "\nPlease add a \e[33mclass\e[39mname to the end of your command.\n\n";

        }

    }


}