<?php

namespace Route;

use Keep\Keep;
use Config\Config;
use Route\Request;
use Sequel\Sequel;

/**
 * Pulls all the info from the database
 * regarding the requested route
 * or stores a 404 notice and returns that 
 * to the paint class.
 */

class Visit{

    public $auth = [];
    public $role = [];
    public $armour = []; 
    public $limit = [];
    public $route = '/';
    public $redirect = 'false';
    public $header = 404;
    public $path = '/';
    public $controller = 'Error@notFound';
    public $model = 'none';
    public $modelID = 0;
    public $type = 'GET';

    public function __construct($a = []){

        $this->request = Request::url();
        $this->path = Config::get('app/url').$this->request;

    }

    public function __destruct(){
/*
        echo "<pre>";

        var_dump($this);

        echo "</pre>";*/

        // keep

    }

    public function exists(){

        $db = Sequel::select("_routes")->where("route","=",$this->request)->do();
        $this->object = $db;
        
        return $db;

    }

    public function create($mass = []){

        Sequel::insert("_routes")
        ->mass($mass)
        ->do();
   
    }

    public function process(){

        if($this->exists()){

            $d = $this->object['results'][0];

            $a = [
                'parent' => 0,
                'path' => $this->path,
                'route' => $this->request,
                'httpcode' => $d['httpcode'],
                'redirect' => $d['redirect'],
                'controller' => $d['controller'],
                'model' => $d['model'],
                'model_id' => $d['model_id'],
                'middleware' => $d['middleware']
    
            ];

        }else{

            

            $a = [
                'parent' => 0,
                'path' => $this->path,
                'route' => $this->request,
                'httpcode' => 404,
                'redirect' => $this->redirect,
                'controller' => $this->controller,
                'model' => $this->model,
                'model_id' => $this->modelID,
                'middleware' => json_encode(
                    [
                        'auth' => $this->auth,
                        'role' => $this->role,
                        'armour' => $this->armour,
                        'limit' => $this->limit,
                    ])
    
            ];

            $this->create($a);

            // keep
        }

        Keep::store('route', $a);

        return $a;

    }

}