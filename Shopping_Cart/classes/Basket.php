<?php
/**
 * Created by PhpStorm.
 * User: MustafaHusain
 * Date: 6/13/14
 * Time: 10:33 AM
 */


class Basket{


    public $_instance_catalogue;
    public $_number_of_items;
    public $_total;
    public $_vat;
    public $_sub_total;
    public $_vat_rate;
    public $_empty_basket;


    public function __construct(){
        $this->_instance_catalogue = new Catalogue();
        $this->_empty_basket = empty($_SESSION['basket']) ? true:false;
        //print_r($_SESSION['basket']);
        $objBusiness = new Business();
        $this->_vat_rate = $objBusiness->getVatRate();

        $this->noItems();
        $this->subtotal();
        $this->vat();
        $this->total();


    }

    public static function activeButton($product_id){
        if(isset($_SESSION['basket'][$product_id])){
            $id = 0;
            $label = "Remove From Basket";
        }
        else{
            $id = 1;
            $label = "Add To Basket";
        }

       // $btn = '<a href="#" class="add_to_basket " rel='.$sess_id.'_'.$id.'>'.$label.'</a>';
        $out  = "<a href=\"#\" class=\"add_to_basket";
        $out .= $id == 0 ? " red" : null;
        $out .= "\" rel=\"";
        $out .= $product_id."_".$id;
        $out .= "\" >{$label}</a>";
        return $out;
    }

    public function noItems(){
        $value = 0;
        if(!$this->_empty_basket){
            foreach($_SESSION['basket'] as $key=> $basket){
                $value = $value + $basket['qty'];
            }
        }
        $this->_number_of_items = $value;

    }

    public function vat(){
        $value = 0;
        if(!$this->_empty_basket){
            $value = ($this->_sub_total/100) * $this->_vat_rate;
        }
        $this->_vat = round($value,2);
    }



    public function total(){
        $this->_total= round(($this->_sub_total+$this->_vat),2);
    }

    public function subtotal(){
        $value = 0;
        if(!$this->_empty_basket){
            foreach($_SESSION['basket'] as $id => $basket){
                $product = $this->_instance_catalogue->getProduct($id);
                $value+= ($basket['qty'] * $product['price']);
            }
            $this->_sub_total = round($value,2);
        }
    }
}