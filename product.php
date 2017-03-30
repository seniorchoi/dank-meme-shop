<?php

// configuration
$domain = "http://www.bootcamp-eshop.local";
$db_database = 'bootcamp_eshop';
$db_host = 'localhost';
$db_charset = 'utf8';
$db_user = 'root';
$db_pass = '';

$product_id = !empty($_GET['product_id'])?$_GET['product_id']:null;

$content_title = 'Product detail'; // the default title of the page

// connect to the database
try {
  $pdo = new PDO(
    'mysql:dbname='.$db_database.';host='.$db_host.';charset='.$db_charset,
    $db_user,
    $db_pass
  );
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'Connection failed: ' . $e->getMessage();
}

$query = "
  SELECT `product`.*
  FROM `product`
  WHERE `product`.`id` = :product_id
";
$substitutions = array(
  ':product_id' => $product_id
);
$statement = $pdo->prepare($query);
$statement->execute($substitutions);
$product = $statement->fetch();
if(!$product) // if a product was not found
{
  die('error404');
}

// load the contents of the basket cookie
$cookie = isset($_COOKIE['basket'])?$_COOKIE['basket']:null; // get the cookie value (if exists)
if($cookie) { // if the cookie exists
  parse_str($cookie, $cookie_items); // get the basket items from the cookie
} else {
  $cookie_items = array(); // understand that the array of basket items is empty
}

if(!empty($_POST['order'])) // if the order form was sent
{
  $amount = isset($_POST['amount'])?(float)$_POST['amount']:0; // get the requested amount
  if($amount > 0)
  {
    $basket_item = isset($cookie_items[$product_id])?$cookie_items[$product_id]:array(); // get this product from the basket items or initialize it as a new array
    
    $basket_item['amount'] = !empty($basket_item['amount'])?$basket_item['amount']+$amount:$amount; // set the amount to be the amount sent or add the amount to the previously added amount 
    $basket_item['price'] = $product['price']; // save the price at which it was put into the basket

    $cookie_items[$product_id] = $basket_item; // put the item among the basket items

    setcookie( // we set the cookie
      'basket', // name of the cookie
      http_build_query($cookie_items), // value 
      time()+86400*7, // expires in 7 days
      "/" // for the entire domain
    );
  }
}

if($product) // if a product was found
{
  $content_title = $product['name']; // the title of the page should be the name of the product
}

// main image
$query = "
  SELECT `product_image`.*
  FROM `product_image`
  WHERE `product_image`.`product_id` = :product_id
  ORDER BY `product_image`.`order` ASC
  LIMIT 1
";
$substitutions = array(
  ':product_id' => $product['id']
);
$statement = $pdo->prepare($query);
$statement->execute($substitutions);
$main_image = $statement->fetch();

// all images
$query = "
  SELECT `product_image`.*
  FROM `product_image`
  WHERE `product_image`.`product_id` = :product_id
  ORDER BY `product_image`.`order` ASC
";
$substitutions = array(
  ':product_id' => $product['id']
);
$statement = $pdo->prepare($query);
$statement->execute($substitutions);
$gallery_images = $statement->fetchAll();


// count the total number and the total price of the items in the basket
$basket_count = 0;
$basket_price = 0.0;
foreach($cookie_items as $basket_item)
{
  if($basket_item['amount'])
  {
    $basket_count++;
  }
  if($basket_item['amount'])
  {
    $basket_price += $basket_item['amount']*$basket_item['price'];
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $content_title; ?></title>

  <link rel="stylesheet" href="css/main.css" />

</head>
<body>

  <div id="page">

    <div id="header">
      <h1>
        <a href="<?php echo $domain; ?>">
          <img src="img/my-shop.png" alt="MY SHOP" /></a>
      </h1>
    </div>

    <div id="topmenu">
      <nav>
        <a href="<?php echo $domain; ?>">home</a>
        <a href="<?php echo $domain; ?>?page=category">products</a>
        <a href="<?php echo $domain; ?>?page=contact">contact form</a>
      </nav>

      <div class="basket">
        <a href="<?php echo $domain; ?>?page=basket"><img src="img/cart.png" /> In the cart: <?php echo $basket_count.($basket_count==1?' item':' items'); ?> (<?php echo $basket_price; ?> &euro;)</a>
      </div>
    </div>



    <div id="content">
      <div id="product">
        <h1><?php echo $content_title; ?></h1>

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
              * <?php echo $product['price']; ?> &euro;
            </form>
          </div>

        </div>

        <?php if(!empty($gallery_images)) : ?>

          <div class="gallery">
            <h2>Gallery</h2>
            <div class="images">

              <?php foreach($gallery_images as $image) : ?>

                <a class="image" href="media/product/<?php echo $product['id']; ?>/<?php echo $image['filename']; ?>">
                  <img src="media/product/<?php echo $product['id']; ?>/<?php echo $image['filename']; ?>" /></a>
              <?php endforeach; ?>
              
            </div>
          </div>

        <?php endif; ?>
      </div>
    </div>




    <div id="footer">
      &copy; 2016 insert your name here
    </div>

  </div>

</body>
</html>