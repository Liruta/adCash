<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_order');
    }

    public function index()
    {
        json_output(200, array('status' => 200, 'message' => 'Product route'));
    }

    public function getOrders()
    {
        $orders = $this->model_order->getOrders();
        if (!$orders) {
            json_output(400, array('status' => 400, 'message' => 'No Orders in database'));
        } else {
            json_output(200, array('status' => 200, 'message' => 'Orders retrieved successfully', 'data' => $orders));
        }
    }

    public function postOrder()
    {
        $body = file_get_contents('php://input');
        if (strlen($body) > 0) {
            $body = json_decode($body);
            $postOrder = $this->model_order->postOrder($body);
            if ($postOrder == true) {
                json_output(200, array('status' => 200, 'message' => 'Order saved'));
            } else {
                json_output(500, array('status' => 500, 'message' => 'Failed to save order'));
            }
        } else {
            json_output(200, array('status' => 200, 'message' => 'No body sent'));
        }
    }

    public function deleteOrder()
    {
        $body = file_get_contents('php://input');
        if (strlen($body) > 0) {
            $body = json_decode($body);
            $orderId = $body->orderId;

            $deleteOrder = $this->model_order->deleteOrder($orderId);

            if ($deleteOrder == true) {
                json_output(200, array('status' => 200, 'message' => 'Order deleted'));
            } else {
                json_output(500, array('status' => 500, 'message' => 'Failed to delete order'));
            }
        } else {
            json_output(200, array('status' => 200, 'message' => 'No body sent'));
        }
    }

}