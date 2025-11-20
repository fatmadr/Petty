<?php

class Animal
{
    private PDO $conn;
    private string $table = "animals";

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    public function all(string $search = ''): array
    {
        if ($search !== '') {
            $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE name LIKE ? ORDER BY id DESC");
            $stmt->execute(['%' . $search . '%']);
        } else {
            $stmt = $this->conn->query("SELECT * FROM {$this->table} ORDER BY id DESC");
        }
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): void
    {
        $stmt = $this->conn->prepare("
            INSERT INTO {$this->table} (name, species, breed, dob)
            VALUES (:name, :species, :breed, :dob)
        ");

        $stmt->execute([
            ':name'    => $data['name'],
            ':species' => $data['species'] ?: null,
            ':breed'   => $data['breed'] ?: null,
            ':dob'     => $data['dob'] ?: null,
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
    }
}
