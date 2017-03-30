<?php

class cart
{
  protected static $cookie_name = 'cart';
  protected static $cookie_ttl = 86400;

  /**
   * gets cart cookie value from $_COOKIE
   *
   * if the cookie is not found returns an empty array
   * the cookie name is taken from static::$cookie_name
   * json_decodes it before returning
   */
  protected static function getCookie()
  {
    if(isset($_COOKIE[static::$cookie_name]))
    {
      $cart_cookie = json_decode($_COOKIE[static::$cookie_name], true); 
    }
    else
    {
      $cart_cookie = array();
    }
    return $cart_cookie;
  }

  /**
   * sets a cart cookie
   * 
   * json_encodes it and sets under the name taken from static::$cookie_name
   */
  protected static function setCookie($cookie_value)
  {
    $_COOKIE[ static::$cookie_name ] = json_encode($cookie_value);
    setcookie(
      static::$cookie_name, 
      $_COOKIE[static::$cookie_name], 
      time()+static::$cookie_ttl
    );
  }

  /**
   * adds an amount of items to cart
   *
   * @param $product_id id of the product to add to cart
   * @param $amount amount of the product to be added
   */
  public static function addToCart($product_id, $amount)
  {
    // Retrieve the current state of the cart from the cookie (an array).
    $cart_cookie = static::getCookie();

    // Add another item in that array or modify the amount of an existing one.
    if(!isset($cart_cookie[$product_id]))
    {
      $cart_cookie[$product_id] = 0;
    }
    $cart_cookie[$product_id] += $amount;
    
    // Save the array back into the cookie.
    static::setCookie($cart_cookie);
  }

  /**
   * removes a product completely from the cart
   */
  public static function removeFromCart($product_id)
  {
    // Retrieve the current state of the cart from the cookie (an array).
    $cart_cookie = static::getCookie();

    // Remove an item from that array
    if(isset($cart_cookie[$product_id]))
    {
      unset($cart_cookie[$product_id]);
    }

    // Save the array back into the cookie.
    static::setCookie($cart_cookie);
  }

  /**
   * sets the amount of a product in the cart
   *
   * @param $product_id the id of the product whose amount we want to change
   * @param $amount the amount is should be set to
   */
  public static function updateCartAmount($product_id, $amount)
  {
    if(!$amount) // if the amount is 0
    {
      // instead of updating the amount, remove the item from cart
      return static::removeFromCart($product_id);
    }
    
    // Retrieve the current state of the cart from the cookie (an array).
    $cart_cookie = static::getCookie();  
    
    // set the amount
    $cart_cookie[$product_id] = $amount;

    // Save the array back into the cookie.
    static::setCookie($cart_cookie);
  }

  /**
   * get product ids for products in the cart
   */
  public static function getProductIds()
  {
    // Retrieve the current state of the cart from the cookie (an array).
    $cart_cookie = static::getCookie();

    // return the ids of the products
    $product_ids = array();
    foreach($cart_cookie as $product_id => $amount)
    {
      $product_ids[] = $product_id;
    }
    return $product_ids;
  }

  /**
   * returns an array of amounts indexed by the product ids
   *
   * in this implementation of the cookie it just returns the current cookie value
   * if the cookie had a different format it would have to do some more stuff to
   * return the expected value
   */
  public static function getProductAmounts()
  {
    return static::getCookie();
  }

  /**
   * clears the whole cart
   */
  public static function clearCart()
  {
    static::setCookie(array());
  }

  /**
   * counts the total number of items of products in the cart
   */
  public static function countItems()
  {
    $cart_cookie = static::getCookie();

    $total = 0;
    foreach($cart_cookie as $product_id => $amount)
    {
      $total += $amount; // add amount to total
    }
    return $total;
  }

  /**
   * return the total sum of prices of all the items in the cart
   */
  public static function getTotalSum()
  {
    // get the cookie data
    $cart_cookie = static::getCookie();

    $total = 0;

    $product_ids = array_keys($cart_cookie);
    // if there are products in the cart (otherwise the SQL query will be invalid)
    if(count($product_ids))
    {
        $string_to_use_in_query = join(', ', $product_ids);
        $query = "
          SELECT `product`.*
          FROM `product`
          WHERE `product`.`id` IN ({$string_to_use_in_query})
        ";
        $substitutions = array(
        );
        $result = db::execute($query, $substitutions); // execute the query
        foreach($result as $product)
        {
            $price = $product['price']; // get the price column from the first row
            
            $amount = $cart_cookie[ $product['id'] ];

            // add amount * price to the total
            $total += $price * $amount;
        }
    }

    // return total
    return $total;
  }
}