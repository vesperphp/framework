<?php

namespace Route;

class Store{

    public function exists(){

    }

    public function create(){
        
    }

    public function update(){
        
    }

    public function process(){

        //if exists $this->exists();
        $this->create();
        
        //else
        $this->update();

        // then
        return 'data';

    }

}