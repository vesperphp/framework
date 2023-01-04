<?php

namespace Framework;

/**
 * This class works with the 
 * patterns in the patterns/models 
 * folder.
 */

class Pattern{

    public static function file(string $type, string $namespace){

        $init = ROOTPATH."/patterns/models/".$type."/init.txt";

        if(!file_exists($init)){ exit; }

        $contents = file($init);

        $store = [];
        foreach($contents as $value){

            $replace = str_replace("{namespace}", strtolower($namespace), $value);
            $replace = str_replace("{namespace_upper}", ucfirst($namespace), $replace);
            $replace = str_replace(" ", "", $replace);
            $value = str_replace("{root}", ROOTPATH, $replace);

            // Cleanup
            $value = trim(preg_replace('/\s\s+/', ' ', $value));

            if(str_contains($value, "|")){

                $exploded = explode("|", $value);
                $store[] = $exploded;

            }else{

                $store[] = $value;

            }


        }

        return $store;


    }

    public static function create(string $type, string $namespace){

        $file = Self::file($type, $namespace);

        foreach($file as $make){

            if(is_array($make)){

                Self::template($namespace, $make);

            }else{

                Self::dir($make);

            }

        }

    }

    public static function template(string $namespace, array $param){

        
        $template = $param[2];
        $file = $param[0].'/'.$param[1];

        if(file_exists($file)){ echo "\n\e[33mFile already exists.\e[39m\n".$file."\n\n"; exit; }else{
            touch($file);
        }
        if(!file_exists($template)){ echo "\n\e[33mTemplate file doesn't exist.\e[39m\n".$template."\n\n"; exit; }

        $current = file_get_contents($template);

        $replace = str_replace("{namespace}", strtolower($namespace), $current);
        $replace = str_replace("{namespace_upper}", ucfirst($namespace), $replace);
        $current = str_replace("{root}", ROOTPATH, $replace);

        file_put_contents($file, $current);

    }

    public static function dir(string $param){

        if(!is_dir($param)){
            mkdir($param);
        }


    }



}