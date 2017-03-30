<h1>Cart</h1>
<div class="products">
    <?php echo $products_view; ?>
</div>

<a href="<?php echo url::to('checkout'); ?>">Checkout</a>

<form action="" method="post">
    <input type="submit" value="Clear the cart!" name="clear" />
</form>