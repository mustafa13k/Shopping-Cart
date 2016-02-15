<?php
/**
 * Created by PhpStorm.
 * User: MustafaHusain
 * Date: 6/20/14
 * Time: 12:30 AM
 */
$id = Url::getParams('id');
if(!empty($id)){
    $objCatalogue = new Catalogue();
    $product =  $objCatalogue->getProduct($id);
    if(!empty($product)){
        $category = $objCatalogue->getCategory($product['category']);
        require '_header.php';
        echo "<h1>Catalogue::{$category['name']}</h1>";
        $image = (!empty($product['image']))? $objCatalogue->_path.$product['image']:null;
        if(!empty($image)){
            $width = Helper::getImgSize($image,0);
            $width = $width > 120 ? 120 :$width;
        ?>
            <div class='fl_l'>
                <div class='lft'>
                    <img src='<?=$image?>' alt='<?=Helper::encodeHTML($product['name'],1)?>' width='<?=$width?>'/>
                </div>

        <?php
        }
        echo "<div class='rgt'><h3>".$product['name']."</h3>";
        echo "<h4><strong>&pound;".$product['price']."</strong></h4>";
        echo Basket::activeButton($product['id']);
        echo "</div></div>";
        echo "<div class='dev'>&#160;</div>";
        echo "<p>".Helper::encodeHTML($product['description'],2)."</p>";
        echo "<div class='dev br_td'>&#160;</div>";
        echo "<p><a href='javascript:history.go(-1)'>Go Back</a></p>";

        require '_footer.php';

    }
    else{
        require 'error.php';
    }


}
else{
    require 'error.php';
}