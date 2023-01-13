<?php

namespace Route;

use Config\Config;
use service\Session;

class Limit{

    public $length;
    public $count;
    public $time;
    public $group;
    public $session;
    public $calls;

    public function __construct($group, $length = false, $count = false){

        if(!$length==false){
            $this->length = Config::get('limit/length');
        }else{
            $this->length = $length;
        }
        
        if($count==false){
            $this->count = Config::get('limit/count');
        }else{
            $this->count = $count;
        }

        $this->group = $group; 

        $this->time = time();
        $this->session = "middleware/limit";

        $this->register();
        $this->reset();

    }

    public function check(){

        if($this->calls['count'] >= $this->count){

            if(Config::dev()){
                echo "<pre>";
                var_dump($this);
                echo "</pre>";
                die("Maximum calls reached for ".$this->group );
            }else{
                die("Maximum calls reached. Try again later." );
            }
            


        }


    }

    public function register(){

        $middleware = Session::get("middleware/limit/".$this->group);
        $count['count'] = 0;

        if(is_array($middleware)){

            // add one to the count here

            $count = [
                'start' => $middleware['start'],
                'now' => time(),
                'end' => $middleware['end'],
                'count' => $middleware['count']+1
            ];

            Session::drop("middleware/limit/".$this->group);
            Session::set("middleware/limit/".$this->group, $count);

            // remove the array

        }else{

            // start a new count here
            $count = [
                'start' => $this->time,
                'now' => time(),
                'end' => $this->time + $length,
                'count' => 1
            ];

            Session::set("middleware/limit/".$this->group, $count);

        }

        $this->calls = $count;

    }

    public function reset(){

        if($this->calls['end'] >= time()){

            Session::drop("middleware/limit/".$this->group);

            $this->register();

        }

    }

}