<?php $objBasket = new Basket();?>

<h2>Your Basket</h2>
<dl id="basket_left">
    <dt>No.of Items</dt>
    <dd class="bl_ti"><span><?=$objBasket->_number_of_items?></span></dd>
    <dt>Sub-Total</dt>
    <dd class="bl_st">&pound;<span><?=number_format($objBasket->_sub_total,2)?></span></dd>
    <dt>VAT(<span><?=$objBasket->_vat_rate?></span>%)</dt>
    <dd class="bl_vat">&pound;<span><?=number_format($objBasket->_vat,2)?></span></dd>
    <dt>Total (inc):</dt>
    <dd class="bl_total">&pound;<span><?=number_format($objBasket->_total,2)?></span></dd>
</dl>
<div class="dev br_td">&#160;</div>
<p><a href="?page=basket">View Basket</a> | <a href="page=checkout">Checkout</a></p>
<div class="dev br_td">&#160;</div>