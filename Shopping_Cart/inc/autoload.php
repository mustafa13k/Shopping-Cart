<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


 require_once('config.php');

function __autoload($class_name){
   
    $class = explode("_", $class_name);
    $path  = implode('/', $class).'.php';
    require_once ($path);
    
}
