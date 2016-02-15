<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Url{

    public static $_page = 'page';
    public static $_folder = PAGES_DIR;
    public static $_params = array();

    public static function getParams($param){
        return isset($_GET[$param]) && $_GET[$param]!="" ? $_GET[$param]:null;
    }

    public static function currentPage(){
        return isset($_GET[self::$_page]) ?  $_GET[self::$_page] : 'index';
    }

    public static function getPage(){
        $page = self::$_folder.DS.self::currentPage().'.php';
        $error = self::$_folder.DS.'error.php';
        return is_file($page) ? $page : $error;
    }

    public static function getAll(){
        if(isset($_GET)){
            if(!empty($_GET)){
                foreach($_GET as $key => $value){
                    self::$_params[$key] = $value;
                }
             }
        }

    }


    /*
     * This function removes the specified $_GET parameter from the url and returns the url */
    public static  function getCurrentUrl($remove = null){
        self::getAll(); // Retrieves the Url params in form of array and stores in $_params
        $out = array(); // empty array
        if(!empty($remove)){
            //if $remove(param to be removed in url) is not in an array format make it an array
            $remove = !is_array($remove)? array($remove): $remove;
            // loop through $_params and remove the url param from $_params if found in remove array()
            foreach(self::$_params as $key => $value){
                if(in_array($key,$remove)){
                    unset(self::$_params[$key]);
                }
            }
        }
        // loop through $_params and get the params after removing in an array format
        foreach(self::$_params as $key=>$value){
            $out[] = "$key=$value";
        }
        //implode the params with & and return it
        return "?".implode("&",$out);

    }


}
?>
