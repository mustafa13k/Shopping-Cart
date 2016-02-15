<?php
/**
 * Created by PhpStorm.
 * User: MustafaHusain
 * Date: 6/10/14
 * Time: 9:06 AM
 */


class Business extends Application{

    private $_table = 'business';

    public function ___construct(){
        //parent::__construct();
    }

    public function getBusiness(){
        $query = "SELECT * FROM `{$this->_table}` ";
        $query.= " WHERE id = 1";
        return $this->db->fetchOne($query);
    }

    public function getVatRate(){
        $vat_rate = $this->getBusiness();
        return $vat_rate['vat_rate'];
    }
}