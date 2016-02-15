<?php
    $catalogueObj = new Catalogue();
    $cats = $catalogueObj->getCategories();

    $businessObj = new Business();
    $business = $businessObj->getBusiness();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Ecommerce website project</title>
<meta name="description" content="Ecommerce website project" />
<meta name="keywords" content="Ecommerce website project" />
<meta http-equiv="imagetoolbar" content="no" />
<?php require_once 'csslinks.php';?>
</head>
<body>
    <div id="header">
        <div id="header_in">
            <h5 style="color:white"><a href="/"><?=$business['name']?></a></h5>
        </div>
    </div>
    <div id="outer">
        <div id="wrapper">
            <div id="left">
                <?php require_once 'basket_left.php'; ?>
                <?php if(!empty($cats)){ ?>
                <h2>Categories</h2>
                <a href="?page=tp&id=p">Tp</a>
                <ul id="navigation">
                    <?php
                        foreach($cats as $cat){ //\"localhost/Shopping_Cart/?page=catalogue&amp;category=".$cat['id']."\"";
                                echo "<li><a href=?page=catalogue&amp;category=".$cat['id']."";
                                echo Helper::getActive(array('category' => $cat['id']));
                                echo ">";
                                echo Helper::encodeHTML($cat['name']);
                                echo "</a></li>";
                                    //.$cat['name']."</a></li>";
                            }
                        }
                    ?>

                </ul>
            </div>
            <div id="right">
