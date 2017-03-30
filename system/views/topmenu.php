<nav>
  <a href="<?php echo url::to(''); ?>">home</a>
  <a href="<?php echo url::to('category'); ?>">memes</a>
  <a href="<?php echo url::to('contact'); ?>">contact form</a>
</nav>

<div class="cart_bar">
  <a href="<?php echo url::to('cart'); ?>">
    Cart: <?php echo $cart_amount; ?> items, <?php echo number_format($cart_total, 0, ',', ' '); ?> sweg
  </a>
</div>
