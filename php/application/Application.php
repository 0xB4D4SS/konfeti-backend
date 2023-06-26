<?php

require_once('db/DB.php');
require_once('product/Product.php');
require_once('cart/Cart.php');
require_once('order/Order.php');

class Application
{
    private DB $db;
    private Product $product;
    private Cart $cart;
    private Order $order;

    function __construct()
    {
        $this->db = new DB();
        $this->product = new Product($this->db);
        $this->cart = new Cart($this->product);
        $this->order = new Order($this->db);
    }

    public function addToCart(int $id): bool
    {
        if ($id) {
            return $this->cart->addToCart($id);
        }

        return false;
    }

    public function removeFromCart(int $id): bool
    {
        if ($id) {
            return $this->cart->removeFromCart($id);
        }

        return false;
    }

    public function createOrder(string $name, string $email): array
    {
        if ($name && $email) {
            return ['orderId' => $this->order->createOrder($name, $email)];
        }

        return [];
    }

    public function deleteOrder(int $id): bool
    {
        if ($id) {
            if (empty($this->order->deleteOrder($id))) {
                return true;
            }

            return false;
        }

        return false;
    }

    public function getOrders(): array
    {
        return $this->order->getOrders();
    }

    public function getOrder(int $id): array
    {
        return $this->order->getOrder($id);
    }

    public function getProducts(): array
    {
        return $this->product->getProducts();
    }

    public function getCart(): array
    {
        return $this->cart->getCart();
    }
}