<h2>Gallery</h2>
<div class="images">

  <?php foreach($images as $image) : ?>

    <a class="image" href="media/product/<?php echo $product['id']; ?>/<?php echo $image['filename']; ?>">
      <img src="media/product/<?php echo $product['id']; ?>/<?php echo $image['filename']; ?>" /></a>
  <?php endforeach; ?>
  
</div>