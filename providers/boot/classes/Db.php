<?php

namespace Framework;

use Sequel\Sequel;
use Framework\SystemTables;

/**
 * This is a CLI
 * command. db:(method)
 */

class Db{

    public function build(array $flags = []){

    
        /**
         * The CLI helper to build
         * the database based on the
         * input from Init/tables and
         * system's Tablier/tables.
         */

        $boot = "up";

        SystemTables::registerOnBoot($boot);

        echo "\e[32mTablier creating tables...\n";

        foreach ( glob(ROOTPATH."/patterns/sequel/*.php") as $filename) { 
            include $filename; 
        }

        echo "\n\e[32mDone.";

    }

    public function drop(array $flags = []){

        /**
         * Drop only the tables that have
         * a down command.
         */


        $boot = "down";
        
        SystemTables::registerOnBoot($boot);

        echo "\e[32mTablier dropping tables...\n";

        foreach ( glob(ROOTPATH."/patterns/sequel/*.php") as $filename) { 
            include $filename; 
        }

        echo "\e[32mDone.";
        
    }

    public function destroy(array $flags = []){

        if(Config::dev('build')){
            echo "\e[32mTablier dropping all tables...\n";

            /** 
             * Run an SQL command
             * to drop all tables
             * within this DB.
             */


            $res = Sequel::sql("SHOW TABLES;");

            $sql = "SET FOREIGN_KEY_CHECKS = 0;
            SET GROUP_CONCAT_MAX_LEN=32768;
            SET @tables = NULL;
            SELECT GROUP_CONCAT('`', table_name, '`') INTO @tables
            FROM information_schema.tables
            WHERE table_schema = (SELECT DATABASE());
            SELECT IFNULL(@tables,'dummy') INTO @tables;
            SET @tables = CONCAT('DROP TABLE IF EXISTS ', @tables);
            PREPARE stmt FROM @tables;
            EXECUTE stmt;
            DEALLOCATE PREPARE stmt;
            SET FOREIGN_KEY_CHECKS = 1;";

            Sequel::sql($sql);

            foreach($res['all'] as $table){
                echo "\e[39m".$table['Tables_in_test']." \e[31mdeleted!\e[39m \n";
            }

            echo "\e[32mDone.";
        }else{
            echo "\e[32mAs a failsafe you can only use db:destroy when in 'build' mode, not in 'development'. Check the config file to change the value.";
        }
        
    }

    public function fill(array $flags = []){

        /**
         * The CLI helper to build
         * the database based on the
         * input from Init/tables and
         * system's Tablier/tables.
         */

        echo "\e[32mTablier filling tables...\n";

        /**
         * Run the init/tables
         */

        foreach ( glob(ROOTPATH."/patterns/filler/*.php") as $filename) { 
            include $filename; 
        }

        echo "\n\e[32mDone.";
        
    }

    public function refresh(array $flags = []){

        $this->drop();
        $this->build();
        $this->fill();
        
    }


}