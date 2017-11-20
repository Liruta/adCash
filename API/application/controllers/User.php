<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_user');
    }

    public function index()
    {
        json_output(200, array('status' => 200, 'message' => 'User route'));
    }

    public function getUsers() {
        $users = $this->model_user->getUsers();
        if(!$users){
            json_output(400, array('status' => 400, 'message' => 'No users in database'));
        } else {
            json_output(200, array('status' => 200, 'message' => 'User retrieved successfully', 'data' => $users));
        }
    }
}