<?php

class Order
{
    private DB $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function createOrder(string $name, string $email): string
    {
        $order = $this->db->createOrder($name, $email, $_SESSION['cart'], $_SESSION['cart']['totalCost']);
        if ($order !== '0') {
            session_destroy();
        }

        return $order;
    }

    public function deleteOrder(int $id)
    {
        return $this->db->deleteOrder($id);
    }

    public function getOrders()
    {
        return $this->db->getOrders();
    }

    public function getOrder(int $id)
    {
        return $this->db->getOrderById($id);
    }
}