<?php

$navigation = new view('navigation');

$email = request::post('email', '');
$text = request::post('text', '');
$newsletter = request::post('newsletter', '');

$form_view = new view('contact/form');
$form_view->email = $email;
$form_view->text = $text;
$form_view->newsletter = $newsletter;



presenter::present($form_view);