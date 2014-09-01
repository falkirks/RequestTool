<?php
/*
 * Basic autoload for class files.
 */
function __autoload($name){
    $filename = __DIR__ . "/lib/$name.php";
    if(!file_exists($filename)){
        return false;
    }
    include $filename;
}