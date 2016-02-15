<?php
/**
 * Created by PhpStorm.
 * User: MustafaHusain
 * Date: 6/10/14
 * Time: 11:56 AM
 */

class Catalogue extends  Application{

    private $_table = 'categories';
    private $_table_2 = 'products';
    public  $_path = 'media/catalogue/';
    public static $_currency = '&pound;';

    public function getCategories(){
        $query = "SELECT * FROM `{$this->_table}` ";
        $query.= " ORDER BY `name` ASC";
        return $this->db->fetchAll($query);
    }

    public function getCategory($id){
        $query = "SELECT * FROM `{$this->_table}` ";
        $query.= " WHERE `id` = '".$this->db->escape($id)."'";
        return $this->db->fetchOne($query);
    }

    public function getProducts($catId){
        $query = "SELECT * FROM `{$this->_table_2}` ";
        $query.= " WHERE `category` = ".$this->db->escape($catId)."";
        $query.= " ORDER BY date DESC";
        //echo $query;
        return $this->db->fetchAll($query);
    }
    public function getProduct($id){
        $query = "SELECT * FROM `{$this->_table_2}` ";
        $query.= " WHERE `id` = ".$this->db->escape($id)."";

        //echo $query;
        return $this->db->fetchOne($query);
    }
}