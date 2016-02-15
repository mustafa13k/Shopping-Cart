<?php
/**
 * Created by PhpStorm.
 * User: MustafaHusain
 * Date: 6/17/14
 * Time: 9:06 AM
 */

class Session{

    public static function setItem($id,$qty = 1){
        $_SESSION['basket'][$id]['qty'] = $qty;
        /*echo "<pre>";
        print_r($_SESSION['basket']);*/
    }

    public static function removeItems($id,$qty = null){
        if($qty!=null && qty < $_SESSION['basket'][$id]['qty']){
            $_SESSION['basket'][$id]['qty'] =( $_SESSION['basket'][$id]['qty'] - qty);
        }
        else{
            $_SESSION['basket'][$id] = null;
            unset($_SESSION['basket'][$id]);
        }
    }
}