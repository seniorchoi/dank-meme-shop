<?php

class checkout_controller
{
    protected $messages = array();

    public function run()
    {
        var_dump($_POST);

        // if we don't have user information
        if(!isset($_POST['customer']) 
            || !isset($_POST['user']) 
            || !$this->validateCustomerData($_POST['customer'], $_POST['user']))
        {
            $this->messages['success'][] = 'But it\'s ok...';
            return $this->step1();
        }
        else
        {
            return $this->step2();
        }
        
        // if we have user information but the 'finish' button has not been pressed
            // run step2

        // if we have user information and the 'finish' button was pressed
            // run step3 
    }

    protected function step1()
    {
        // set default values for the fields
        $post_customer = array(
            'name' => '',
            'address' => ''
        );
        $post_user = array(
            'email' => '',
            'password' => '',
            'password2' => ''
        );

        // get the customer info from $_POST
        if(isset($_POST['customer']))
        {
            $post_customer = array_merge($post_customer, $_POST['customer']);
        }

        // get the user info from $_POST
        if(isset($_POST['user']))
        {
            $post_user = array_merge($post_user, $_POST['user']);
        }

        // display and handle the user information form
        $user_info_view = new view('checkout/user_info');
        // insert the customer info into the view
        $user_info_view->customer = $post_customer;
        // insert the user info into the view
        $user_info_view->user = $post_user;
        

        $layout = new view('checkout/layout');
        $layout->step = $user_info_view;

        // insert messages into the layout
        $layout->messages = $this->messages;
        presenter::present($layout);
    }

    protected function step2()
    {
        // present the recapitulation and handle pressing the 'finish' button
        die('STEP 2!!!');
    }

    protected function step3()
    {
        // create the actual order

        // display the 'thank you' message
        // display the order id, shipping info etc.

    }

    protected function validateCustomerData($customer, $user)
    {
        $valid = true;

        // find if there are any errors in the submitted data
        if(!isset($customer['name']) || !strlen(trim($customer['name'])) ) // if customer name is missing
        {
            $this->messages['error'][] = 'The name is missing';
            $valid = false;
        }

        if(!isset($customer['address']) || !strlen(trim($customer['address'])) )
        {
            $this->messages['error'][] = 'The address is missing';
            $valid = false;
        }

        if(!isset($user['email']) || !filter_var($user['email'], FILTER_VALIDATE_EMAIL) )
        {
            $this->messages['error'][] = 'The email is missing or wrong email format';
            $valid = false;
        }

        if(!isset($user['password']) || !strlen(trim($user['password'])) )
        {
            $this->messages['error'][] = 'The password is missing';
            $valid = false;
        }

        if(!isset($user['password2']) || $user['password2'] != $user['password'] )
        {
            $this->messages['error'][] = 'The passwords do not match';
            $valid = false;
        }

        return $valid; // returns true if everything went ok, false otherwise
    }
}