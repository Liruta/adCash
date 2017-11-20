<?php


function json_output($statusHeader, $response) {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, PUT, DELETE, OPTIONS, POST");
    header("Access-Control-Allow-Headers: Origin,Accept,X-Requested-With,Content-Type,Access-Control-Allow-Origin,x-access-token,Authorization");

    $ci = & get_instance();
    $ci->output->set_content_type('application/json');
    $ci->output->set_status_header($statusHeader);
    $ci->output->set_output(json_encode($response));

}