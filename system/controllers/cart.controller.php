<?php

class cart_controller
{
    /**
     * cart detail page
     */
    public function run()
    {
        // handle clearing the cart
        if( isset( $_POST['clear'] ) ) // clear button was pressed
        {
            // we clear the cart
            cart::clearCart();

            return url::redirect( url::to('cart') );
        }

        // handle removing one product
        if(isset($_POST['clear_item']) && isset($_POST['product_id'])) // clear_item button was pressed
        {
            cart::removeFromCart($_POST['product_id']);

            return url::redirect( url::to('cart') );
        }

        // handle changing the amount of a product
        if(isset($_POST['change_amount']) && isset($_POST['product_id']) && isset($_POST['amount']))
        {
            cart::updateCartAmount($_POST['product_id'], $_POST['amount']);

            return url::redirect( url::to('cart') );
        }

        //  retrieve the product ids and amounts from the cart cookie
        $product_amounts = cart::getProductAmounts();
        
        // initialize an array of products
        $products = array();

        if(count($product_amounts)) // if there are any products in the cart
        {
            $product_ids = array_keys($product_amounts);
            $string_to_use_in_query = join(', ', $product_ids);
            $query = "
                SELECT `product`.*
                FROM `product`
                WHERE `product`.`id` IN ({$string_to_use_in_query})
            ";
            $result = db::query($query); // execute the query
            foreach($result as $product)
            {
                $products[] = $product;
            }
        }

        // prepare the products view
        $products_view = new view('cart/products'); // create a view object for the products template
        $products_view->products = $products; // insert the products into that view object
        $products_view->amounts = $product_amounts; // insert the information about their amounts into that view object
        
        // prepare the layout view
        $layout = new view('cart/layout');
        $layout->products_view = $products_view;

        // present the page
        presenter::present($layout);





        // provide a way to remove products from the cart and modify their amount

        // provide a way to continue to the checkout

        // provide a link to return to the shop (continue shopping)
    }
}