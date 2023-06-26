<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
require_once('application/Application.php');

function router($params)
{
    session_start();
    $app = new Application();
    $method = $params['method'];
    switch ($method) {
        case 'test':
            return 'lol';
        case 'addToCart':
            return $app->addToCart((int)$params['id']);
        case 'removeFromCart':
            return $app->removeFromCart((int)$params['id']);
        case 'createOrder':
            return $app->createOrder($params['name'], $params['email']);
        case 'deleteOrder':
            return $app->deleteOrder((int)$params['id']);
        case 'getOrders':
            return $app->getOrders();
        case 'getOrder':
            return $app->getOrder((int)$params['id']);
        case 'getProducts':
            return $app->getProducts();
        case 'getCart':
            return $app->getCart();
        case 'getsession':
            return $_SESSION;
        case 'clearsession':
            session_destroy();
            return 'cleared session';
    }
}

function answer($data): array
{
    if ($data) {
        return [
            'result' => 'ok',
            'data' => $data
        ];
    }

    return [
        'result' => 'error',
        'error' => [
            'code' => 999,
            'text' => 'no data for request'
        ]
    ];
}

echo json_encode(answer(router($_GET)));