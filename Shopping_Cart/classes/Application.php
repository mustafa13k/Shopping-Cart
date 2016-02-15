<?php
/**
 * Created by PhpStorm.
 * User: MustafaHusain
 * Date: 6/10/14
 * Time: 9:03 AM
 */

class Application {

    public $db;

    public function __construct(){
        $this->db = new Dbase();
    }
}