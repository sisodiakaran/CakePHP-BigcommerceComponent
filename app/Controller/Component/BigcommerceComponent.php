<?php
App::uses('Component', 'Controller');

App::import('Vendor', 'Bigcommerce', array('file' => 'Bigcommerce' . DS . 'Api.php'));
use Bigcommerce\Api\Client as Bigcommerce;

class BigcommerceComponent extends Object {
    
    public $Bigcommerce;
    
    public function initialize(Controller $controller) { 
    }

    public function beforeRender(Controller $controller) {
    }

    public function shutdown(Controller $controller) {
    }

    public function beforeRedirect(Controller $controller) {
    }

    public function startup(Controller $controller) {
        $this->controller = & $controller;
		//Configure
        Bigcommerce::configure(array(
            'store_url' => 'your store url here',
            'username'  => 'your store user',
            'api_key'   => 'your store api key'
        ));
        Bigcommerce::setCipher('RC4-SHA');
    }
    
	/**
	* Function to test Connection
	*/
    public function ConnectToStore(){
        $ping = Bigcommerce::getTime();

        if($ping){
            echo $ping->format('H:i:s');
        }
            
    }
    
	/**
	* Function to get product List from the store
	*/
    public function getProductList(){
        $products = Bigcommerce::getProducts();
        $product_list = array();
        foreach($products as $product) {
            $product_list[] =  array(
                'id' => $product->id,
                'name' => $product->name,
            );
        }
        
        return $product_list;
    }
    
	/**
	* Function get store customers
	*/
    public function getCustomers(){
        $customers = $products = Bigcommerce::getCustomers();
        foreach($customers as $customer) {
            $customer_list[] =  array(
                'id'                    => $customer->id,
                'first_name'            => $customer->first_name,
                'last_name'             => $customer->last_name,
                'email'                 => $customer->email,
                'phone'                 => $customer->phone,
                'company'               => $customer->company,
                'customer_group_id'     => $customer->customer_group_id,
            );
        }
        return $customer_list;
    }
    
}