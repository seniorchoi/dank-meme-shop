<div id="product">
  <h1><?php echo $title; ?></h1>

  <div class="product_info">
    
    <?php if(!empty($main_image)) : ?>

      <div class="main_image">
        <img src="media/product/<?php echo $product['id']; ?>/<?php echo $main_image['filename']; ?>" />
      </div>

    <?php endif; ?>

    <div class="description">
      <?php echo $product['description']; ?>
    </div>

    <div class="order">
      <form action="" method="POST">
        <input type="submit" value="Order" name="order" />
        <input type="text" value="1" name="amount" />
        * <?php echo $product['price']; ?> sweg
      </form>
    </div>

  </div>

  <?php if(!empty($gallery)) : ?>

    <div class="gallery">
      <?php echo $gallery; ?>
    </div>

  <?php endif; ?>
</div>