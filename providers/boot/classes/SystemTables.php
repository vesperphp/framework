<?php

namespace Framework;

use Sequel\Tablier;

/**
 * This is a CLI
 * command. make:(method)
 */

class SystemTables{

    public static function registerOnBoot($boot = "up"){

        if($boot=="up"){
            /**
             * Keep track of the tables made by 
             * Tablier.
             */
        
            $t = new Tablier('_tables');
        
            $t->int('id')->primary();
        
            $t->varchar('name',50)->notnull();
        
            $t->timestamp('created_at')->default();
            $t->timestamp('updated_at')->onupdate();
        
            $t->build();
        
            /**
             * The routes table:
             */
        
            $r = new Tablier('_routes');
        
            $r->int('id')->primary();

            $r->int('parent')->null();
            $r->varchar('path',200)->notnull()->default('/')->unique();
            $r->varchar('route',200)->notnull()->default('/')->unique();
            $t->int('header',3)->default(200)->null();
            $r->varchar('redirect',200)->null();

            $r->varchar('controller',35)->default("Error@notfound");
            $r->varchar('model',100);
            $r->int('model_id');
            $r->text('middleware');
        
            $r->timestamp('created_at')->default();
            $r->timestamp('updated_at')->onupdate();
        
            $r->build();
        
            /**
             * Table by Keep:
             */
        
            $t = new Tablier('_keep');
        
            $t->int('id')->primary();
        
            $t->varchar('assignment',50)->notnull();
        
            $t->timestamp('created_at')->default();
            $t->timestamp('updated_at')->onupdate();
        
            $t->build();
        
        }
        
        if($boot=="down"){
        
            $t = new Tablier('_keep');
            $t->drop();
        
        }

    }

}