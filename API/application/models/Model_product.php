<?php


class Model_product extends CI_Model
{
    public function getProducts()
    {
        $query = $this->db->get('products');
        return checkQuery($query);
    }
}