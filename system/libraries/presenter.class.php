<?php

class presenter
{
  public static function present($content)
  {
    // prepare a layout for the page
    $layout = new view('layout');

    // add header
    $layout->header = new view('header');

    // add navbar
    $layout->topmenu = new view('topmenu');
    $layout->topmenu->cart_amount = cart::countItems();
    $layout->topmenu->cart_total = cart::getTotalSum();

    // add footer
    $layout->footer = new view('footer');
    
    // add the page content (from the controller)
    $layout->content = $content;

    // present the content within a HTML wrapper
    $html_wrapper = new view('html_wrapper');
    $html_wrapper->content = $layout;

    echo $html_wrapper;
  }

}