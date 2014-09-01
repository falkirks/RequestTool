<?php
/*
 * Tests to sure required PHP extensions are loaded
 * and configured correctly.
 *
 * Also tests that we are working with a proper plugin.
 */
namespace requesttool;

class EnviromentTest{
    static public function runTests(){
        if(ini_get("phar.readonly") == 1){
            Output::error("Set phar.readonly to 0 with -dphar.readonly=0\n");
            return false;
        }
        if(!extension_loaded("yaml")){
            Output::error("YAML is not loaded. You can install with pecl install yaml");
            return false;
        }
        if(!extension_loaded("curl")){
            Output::error("CURL is not loaded. You can install with pecl install curl");
            return false;
        }
        if(!file_exists("plugin.yml") || !is_dir("src")){
            Output::error("You must run inside a plugin folder.");
            return false;
        }
        if(exec("git") !== "to read about a specific subcommand or concept."){
            Output::error("You don't have git installed. http://git-scm.com/");
            return false;
        }
        @mkdir("data");
        @mkdir("data/forums");
        @mkdir("data/github");
        return true;

    }
}