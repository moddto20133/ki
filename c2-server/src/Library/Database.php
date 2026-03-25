<?php
namespace Server\Library;

use PDO;
use PDOException;

class Database
{
    private $connection;

    public function __construct()
    {
        $db_host = $_ENV['DB_HOST'] ?? '127.0.0.1';
        $db_name = $_ENV['DB_DATABASE'] ?? 'moukthar';
        $db_user = $_ENV['DB_USERNAME'] ?? 'android';
        $db_pass = $_ENV['DB_PASSWORD'] ?? 'android123';
        $db_port = $_ENV['DB_PORT'] ?? '3306';

        try {
            $this->connection = new PDO(
                "mysql:host={$db_host};port={$db_port};dbname={$db_name}",
                $db_user,
                $db_pass
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function select($query, $params = [])
    {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch($query, $params = [])
    {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function query($query, $params = [])
    {
        $stmt = $this->connection->prepare($query);
        return $stmt->execute($params);
    }
}
