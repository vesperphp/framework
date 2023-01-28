<?php

namespace Route;

use Config\Config;

/**
 * This class registers the route
 * information, structurize it
 * and pass it on to Store for
 * safekeeping in the database.
 */

class Register{

    public $middleware = ['Auth@session'=>NULL]; 
    public $route = '/';
    public $redirect = 'false';
    public $header = 200;
    public $path = '/';
    public $controller;
    public $model = 'none';
    public $modelID = 0;
    public $type = 'GET';

    public function auth($access = NULL){


        // is somebody logged in?
        $this->middleware['Auth@session'] = $access;

        return $this;

    }

    public function armour($armour, $value = ''){

        // custom authentication controllers insert
        $this->middleware['Armour@call'][] = [$armour, $value];

        return $this;

    }

    public function role($role = ''){

        // check someone's role
        $this->middleware['Auth@role'] = $role;
        return $this;

    }

    public function redirect($redirect = ''){

        // check someone's role
        $this->redirect = $redirect;
        return $this;

    }

    public function header($header = ''){

        // check someone's role
        $this->header = $header;
        return $this;

    }

    public function limit($amount = false, $time = false, $group = 'vesper'){

        // limit the amount of loads (get from session)
        $this->middleware['Limit@check'] = [$amount, $time, $group];

        return $this;

    }

    public function route($path){

        $this->route = $path;

        $this->path = str_replace("//","/",Config::get("app/url")."".$path);

        return $this;

    }

    public function controller($controller){

        $this->controller = $controller;

        return $this;

    }

    public function model($model, $id){

        $this->modelID = $id;
        $this->model = $model;

        return $this;

    }

    public function store($type="GET"){

        $this->type = strtoupper($type);


        $a = [
            'parent' => 0,
            'path' => $this->path,
            'route' => $this->route,
            'httpcode' => 200,
            'redirect' => $this->redirect,
            'controller' => $this->controller,
            'model' => $this->model,
            'model_id' => $this->modelID,
            'middleware' => json_encode($this->middleware)

        ];


        $s = new Store;
        $s->route($this->route, $a);
        
/*
        echo "<pre>";
        var_dump($this->middleware);
        echo "</pre>";*/

    }

    

    

    
}
