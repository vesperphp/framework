<?php

namespace Route;

use Config\Config;

class Register{

    public $auth;
    public $role;
    public $armour; 
    public $limit;
    public $route;
    public $path;
    public $controller;
    public $method;
    public $model;
    public $modelID;
    public $type;

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

    public function limit($amount = false, $time = false, $group = 'vesper'){

        // limit the amount of loads (get from session)
        $this->limit = [$amount, $time, $group];

        return $this;

    }

    public function route($path){

        $this->route = $path;

        $this->path = Config::get("app/url")."".$path;

        return $this;

    }

    public function controller($controller){

        $this->controller = $controller;

        return $this;

    }

    public function method($method){

        $this->method = $method;

        return $this;

    }

    public function model($model, $id){

        $this->modelID = $id;
        $this->model = $model;

        return $this;

    }

    public function store($type="GET"){

        $this->type = $type;
        echo "<pre>";
        var_dump($this);
        echo "</pre>";

    }

    

    

    
}
