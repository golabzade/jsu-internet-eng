<?php

namespace App\Kernel;

use PDO;
use PDOException;

class DB
{
    private PDO $conn;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ie-project";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "database connection failed: " . $e->getMessage();
            die();
        }
    }

    public function getConn(): PDO
    {
        return $this->conn;
    }

    public function runQuery(string $query, array $params = [], bool $is_select_mode = true, string $class_to_fetch = null): bool|array
    {
        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $status = $stmt->execute();
        if (!$is_select_mode) {
            return $status;
        }
        if (is_null($class_to_fetch)) {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $stmt->setFetchMode(PDO::FETCH_CLASS, $class_to_fetch);
        }
        return $stmt->fetchAll();
    }
}