<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_product');
    }

    public function index()
    {
        json_output(200, array('status' => 200, 'message' => 'Product route'));
    }

    public function getProducts() {
        $products = $this->model_product->getProducts();
        if(!$products){
            json_output(400, array('status' => 400, 'message' => 'No products in database'));
        } else {
            json_output(200, array('status' => 200, 'message' => 'Products retrieved successfully', 'data' => $products));
        }
    }
}