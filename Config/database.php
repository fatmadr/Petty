<?php
class Database {
    private $host = "localhost";
    private $dbname = "petty";
    private $username = "root";
    private $password = "";
    private $conn;

    public function connect() {
        if ($this->conn) {
            return $this->conn;
        }

        try {
            $this->conn = new PDO(
                "mysql:host=".$this->host.";dbname=".$this->dbname,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("SET NAMES utf8mb4");
            return $this->conn;
        } catch (PDOException $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }
}

