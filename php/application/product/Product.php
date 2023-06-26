<?php

class Product
{
    private DB $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function findProductById(int $id)
    {
        return $this->db->findProductById($id);
    }

    public function getProducts()
    {
        return $this->db->getProducts();
    }
}