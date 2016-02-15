<?php

class Core{
    
    public function run(){
        ob_start();
        //echo Url::getPage();
         //Url::getAll();
         //print_r(Url::$_params);
        require_once(Url::getPage());
        ob_end_flush();
    }
}