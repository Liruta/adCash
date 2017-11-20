<?php


class Model_user extends CI_Model
{
    public function getUsers()
    {
        $query = $this->db->get('user');
        return checkQuery($query);
    }
}