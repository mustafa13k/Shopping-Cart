<?php
/**
 * Created by PhpStorm.
 * User: MustafaHusain
 * Date: 6/17/14
 * Time: 11:01 AM
 */

require_once '../inc/autoload.php';
require_once '../inc/config.php';
$basket = new Basket();
$out = array();

$out['bl_ti'] = $basket->_number_of_items;
$out['bl_st'] = number_format($basket->_sub_total,2);
$out['bl_vat'] = number_format($basket->_vat,2);
$out['bl_total'] =number_format($basket->_total,2);

echo json_encode($out);