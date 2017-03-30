<div id="category">
  
  <?php if(isset($category_info)) : ?>

    <div class="category_info">
      <?php echo $category_info; ?>
    </div>

  <?php endif; ?>

  <div class="products">
    <?php echo $products; ?>
  </div>

  <div class="subcategories">
    <?php echo $subcategories; ?>
  </div>

</div>