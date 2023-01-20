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

    public $auth = [];
    public $role = [];
    public $armour = []; 
    public $limit = [];
    public $route = '/';
    public $redirect = '';
    public $header = 200;
    public $path = '/';
    public $controller;
    public $model = 'none';
    public $modelID = 0;
    public $type = 'GET';

    public function auth($access = "all"){


        // is somebody logged in?
        $this->auth = $access;

        return $this;

    }

    public function armour($armour = ''){

        // custom authentication controllers insert
        $this->armour = $armour;

        return $this;

    }

    public function role($role = ''){

        // check someone's role
        $this->role = $role;
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
        $this->limit = [$amount, $time, $group];

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
            'redirect' => 'redirect',
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

        $s = new Store;
        $s->route($this->route, $a);
        

        /*echo "<pre>";
        var_dump($this);
        echo "</pre>";*/

    }

    

    

    
}
