<?php
/**
 * Created by PhpStorm.
 * User: MustafaHusain
 * Date: 6/12/14
 * Time: 8:30 AM
 */
$catId = Url::getParams('category'); //Get url parameter named category
//echo $catId;
if(empty($catId)){  //if category is set and value is unassigned or empty|null return error page
    require_once 'error.php';
}
else{
    $objCatalogue = new Catalogue();
    $category = $objCatalogue->getCategory($catId); //get the category details based on the id
    //print_r($category);
    if(empty($category)){ //if empty return an error page
        require_once 'error.php';
    }
    else{
        $productRows = $objCatalogue->getProducts($catId);// Get the products according to the catId
        $paging = new Paging($productRows , 3);
        $productRows = $paging->getRecords();
        require_once '_header.php';
        //print_r($productRows);




?>
<h1>Catalogue :: <?=$category['name']?></h1>

<?php
        if(!empty($productRows)){ // if products are not empty|null
            foreach($productRows as $products){ //loop through it and display all information

?>
<div class="catalogue_wrapper">
    <div class="catalogue_wrapper_left">
        <?php
             // Get the catalogue images link if images aren't empty or get an unavailable image
            $image = !empty($products['image']) ? $objCatalogue->_path.$products['image']
                     :$objCatalogue->_path.'unavailable.png';

             $width = Helper::getImgSize($image,0); //Get the width,height or attribute based on
                                                    // image and case(2nd arg) given.

             $width = $width > 120 ? 120 : $width; //if width exceeds 120 limit it to 120 or less.

        ?>
        <a href="?page=catalogue-item&amp;category=<?=$category['id']?>&amp;id=<?=$products['id']?>">
            <img src="<?=$image?>" alt="<?=Helper::encodeHTML($products['name'],1)?>" width="<?=$width?>">
        </a>
    </div>

    <div class="catalogue_wrapper_right">
        <h4>
            <a href="?page=catalogue-item&amp;category=<?=$category['id']?>&amp;id=<?=$products['id']?>">
                <?=Helper::encodeHTML($products['name'],1)?>
            </a>
        </h4>
        <h4>
            Price : <?=Catalogue::$_currency; echo number_format($products['price'],2);?>
        </h4>
        <p>
            <?=Helper::shortenDesc(Helper::encodeHTML($products['description']))?>
        </p>
        <p><?=Basket::activeButton($products['id'])?></p>

    </div>
</div>
<?php
            }
            echo $paging->getPaging();
        }else{
            echo "<p>There are no products to display</p>";
        }

        require_once '_footer.php';
    }
}


?>