<?php
/**
 * Created by PhpStorm.
 * User: MustafaHusain
 * Date: 6/17/14
 * Time: 8:26 AM
 */
require_once '../inc/autoload.php';
require_once '../inc/config.php';
if(isset($_POST['id']) && isset($_POST['job'])){
    $id = $_POST['id'];
    $job = $_POST['job'];
    $out = array();

    $objCatalogue = new Catalogue();
    $product = $objCatalogue->getProduct($id);
    //print_r($product);

    if(!empty($product)){
        switch($job){
            case 0:
                Session::removeItems($id);
                $out["job"] = 1;
                break;

            case 1:
                Session::setItem($id);
                $out["job"] = 0;
                break;

        }
        //echo $out["job"];
        echo json_encode($out);


    }

}