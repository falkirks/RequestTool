<?php
/*
 * Outputs data to CLI (with cheating)
 */
class Output{
    public static function __callStatic($name, $args){
        print "[" . strtoupper($name) . "] " . $args[0] . "\n";
    }
}