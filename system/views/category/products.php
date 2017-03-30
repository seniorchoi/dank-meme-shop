<h2>memes</h2>
<div class="list">
  
  <?php foreach($products as $product) : ?>

    <a class="product" href="<?php echo url::to('product', array('product_id' => $product['id'])); ?>">
      <?php if($product['filename']) : ?>
        <img src="media/product/<?php echo $product['id']; ?>/<?php echo $product['filename']; ?>" />
      <?php endif; ?>
      <span class="name"><?php echo $product['name']; ?></span>
      <span class="price"><?php echo $product['price']; ?> sweg</span>
    </a>

  <?php endforeach; ?>


</div>
