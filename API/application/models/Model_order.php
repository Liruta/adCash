<?php


class Model_order extends CI_Model
{
    public function getOrders()
    {
        if (isset($_GET['order_by'])) {
            $orderBy = $_GET['order_by'];
            if ($orderBy == 'username') {
                $this->db->order_by('user.name', 'ASC');
            }
            if ($orderBy == 'productname') {
                $this->db->order_by('products.name', 'ASC');
            }
        } else {
            $this->db->order_by('orders.order_time', 'ASC');
        }

        if (isset($_GET['limit'])) {
            $limit = $_GET['limit'];

            switch ($limit) {
                case 'today':
                    $this->db->where('order_time >=', date('Y-m-d'));
                    break;
                case '7days':
                    $this->db->where('order_time >=', date('Y-m-d', strtotime('-7 days')));
                    break;
            }
        }

        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $this->db->like('user.name', $keyword);
            $this->db->or_like('products.name', $keyword);
        }

        $this->db->select('orders.id, orders.quantity, orders.order_time');
        $this->db->select('user.name as username, user.id as userId');
        $this->db->select('products.name as product_name, products.u_price, products.id as productId');
        $this->db->select('(products.u_price * orders.quantity) as total');

        $this->db->join('user', 'orders.user_id = user.id');
        $this->db->join('products', 'orders.product_id = products.id');
        $query = $this->db->get('orders');
        $resultList = checkQuery($query);
        $results = array();
        foreach ($resultList as $result) {
            if ($result['product_name'] == 'Pepsi Cola' && $result['quantity'] >= 3) {
                $result['total'] = round(0.8 * $result['total'] * 100) / 100;
            }
            $results[] = $result;
        }
        return $results;
    }

    public function postOrder($body)
    {
        $data['user_id'] = $body->user;
        $data['product_id'] = $body->product;
        $data['quantity'] = $body->quantity;
        $data['order_time'] = date('Y-m-d H:i:s');

        if (!$body->id) {
            return $this->db->insert('orders', $data);
        } else {
            $this->db->where('id', $body->id);
            return $this->db->update('orders', $data);

        }
    }

    public function deleteOrder($orderId)
    {
        $this->db->where('id', $orderId);
        return $this->db->delete('orders');
    }
}