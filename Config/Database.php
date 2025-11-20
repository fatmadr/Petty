<?php
class Database {
    private $host = "localhost";
    private $db   = "health_db";   // نفس اسم DB فوق
    private $user = "root";        // غيّر إذا عندك باسورد
    private $pass = "";
    private $charset = "utf8mb4";

    public function connect(): PDO {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            return new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            die("DB Connection error: " . $e->getMessage());
        }
    }
}
