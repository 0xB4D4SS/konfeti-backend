<?php

class DB
{
    private PDO $connection;

    public function __construct()
    {
        $dsn = 'mysql:dbname=konfeti;host=mysql';
        $username = 'root';
        $password = 'test';
        $this->connection = new PDO($dsn, $username, $password);
    }

    private function fetchData($result): array
    {
        $out = [];
        foreach ($result as $key=>$item) {
            $out[$key] = $item;
        }

        return $out;
    }

    private function getAllRows(string $query): array
    {
        try {
            $response = $this->connection->query($query, PDO::FETCH_ASSOC);
            return $this->fetchData($response);
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    private function getSingleRow(string $query): array
    {
        try {
            $response = $this->connection->query($query, PDO::FETCH_ASSOC);
            return $this->fetchData($response)[0];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function findProductById(int $id): array
    {
        $query = <<<EOD
select distinct * from products where id = $id;
EOD;
        return $this->getSingleRow($query);
    }

    public function getProducts()
    {
        $query = <<<EOD
select * from products;
EOD;
        return $this->getAllRows($query);
    }

    public function createOrder(string $name, string $email, array $products, int $totalCost): string
    {
        unset($products['totalCost']);
        $jProducts = json_encode($products);
        $insertQuery = <<<EOD
insert into orders (customer_name, customer_email, products, total_cost) values ('$name', '$email', '$jProducts', $totalCost);
EOD;
        if (empty($this->getAllRows($insertQuery))) {
            return $this->connection->lastInsertId();
        }

        return '0';
    }

    public function deleteOrder(int $id): array
    {
        $query = <<<EOD
delete from orders where id = $id;
EOD;
        return $this->getAllRows($query);
    }

    public function getOrders(): array
    {
        $query = <<<EOD
select * from orders;
EOD;
        return $this->getAllRows($query);
    }

    public function getOrderById(int $id): array
    {
        $query = <<<EOD
select * from orders where id = $id;
EOD;
        return $this->getSingleRow($query);
    }
}