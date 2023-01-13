<?php

namespace Sequel;

use Sequel\Sequel;
use Sequel\Tablier\Construct;
use Sequel\Tablier\Columns;

/**
 * This class is a 
 * db table builder.
 * Neat.
 */

class Tablier extends Columns{

    public $table;
    public $link;

    public function __construct($table){

        $this->table = $table;
        
    }

    /**
     * The query building
     * class to create
     * new database
     * tables.
     */

    public function build(){

        /**
         * Check if the table
         * exists, if so; return
         * a message.
         */

        if(!Tablier::exists($this->table)){

            /**
             * The create table
             * master template.
             */

            $this->template = "CREATE TABLE `{%tablename%}` ( {%columns%} );";

            /**
             * Build and run the 
             * SQL query.
             */

            $sql = new Construct($this);
            Sequel::sql($sql->build());

            /**
             * Show a message for
             * use in Foundry.
             */

            $this->display(true);

            $this->sysEntry();

        }else{

            $this->display(false);
            
        }
  
    }

    /**
     * Drop this table.
     */

    public function drop(){

        /**
         * Check if the table
         * exists, if so; return
         * a message.
         */

        if(Tablier::exists($this->table)){

            /**
             * The create table
             * master template.
             */

            $this->template = "DROP TABLE IF EXISTS `{%tablename%}` CASCADE;";

            /**
             * Build and run the 
             * SQL query.
             */

            $sql = new Construct($this);
            Sequel::sql($sql->build());

            /**
             * Show a message for
             * use in Foundry.
             */

            echo "\e[39mTablier has \e[32msuccessfully\e[39m dropped the `".$this->table."` table.\e[39m\n";

            $this->sysEntry();

        }else{

            echo "\e[39mTablier \e[31mhas not ran\e[39m because table `".$this->table."` was not available to destroy.\e[39m\n";
            
        }
  
    }

    /**
     * Record the table being 
     * created in the sys table
     */

     public function sysEntry(){

        $name = $this->table;
        Sequel::insert('_tables')->set("name", $name)->do();

     }

    /**
     * Some messaging.
     */

    public function display($ran = true){

        if($ran==true){
            echo "\e[39mTablier has \e[32msuccessfully\e[39m created the `".$this->table."` table.\e[39m\n";
        }else{
            echo "\e[39mTablier \e[31mhas not ran\e[39m because table `".$this->table."` already exists.\e[39m\n";
        }
        

    }

    /**
     * Check if a table 
     * already exists.
     */

    public static function exists($table){

        $res = Sequel::sql("SHOW TABLES LIKE '".$table."';");
        if(isset($res['all']) && $res['all']!=NULL){
            return true;
        }

        return false;

    }

    /**
     * Quick and easy 
     * relationship
     * table build.
     */

     public static function relation($parent, $child){

        $t = new Tablier($parent.'_'.$child.'_relation');

        $t->int('id')->primary();
      
        $t->int($parent.'id')->foreign($parent);
        $t->int($child.'id')->foreign($child);
      
        $t->timestamp('updated_at')->onupdate();
        $t->timestamp('created_at')->default();
      
        $t->build();


     }
    
    
}