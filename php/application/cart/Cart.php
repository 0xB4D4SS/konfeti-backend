<?php

class Cart
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function addToCart(int $id): bool
    {
        if ($product = $this->product->findProductById($id)) {
            if (isset($_SESSION['cart'][$product['id']])) {
                $_SESSION['cart'][$product['id']]['amount'] += 1;
            } else {
                $_SESSION['cart'][$product['id']] = [
                    'name' => $product['name'],
                    'cost' => $product['cost'],
                    'amount' => 1,
                ];
            }
            $_SESSION['cart']['totalCost'] += $product['cost'];

            return true;
        }

        return false;
    }

    public function removeFromCart(int $id): bool
    {
        if ($product = $this->product->findProductById($id)) {
            if (isset($_SESSION['cart'][$product['id']])) {
                if ($_SESSION['cart'][$product['id']]['amount'] > 1) {
                    $_SESSION['cart'][$product['id']]['amount'] -= 1;
                } else {
                    unset($_SESSION['cart'][$product['id']]);
                }
                $_SESSION['cart']['totalCost'] -= $product['cost'];

                return true;
            }

            return false;
        }

        return false;
    }

    public function getCart(): array
    {
        return $_SESSION['cart'] ?? [];
    }
}