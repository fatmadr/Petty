<?php

class Record
{
    private PDO $conn;
    private string $table = "records";

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    public function forAnimal(int $animalId): array
    {
        $stmt = $this->conn->prepare("
            SELECT * FROM {$this->table}
            WHERE animal_id = ?
            ORDER BY date DESC, id DESC
        ");
        $stmt->execute([$animalId]);
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
            INSERT INTO {$this->table} (animal_id, date, title, description, vet)
            VALUES (:animal_id, :date, :title, :description, :vet)
        ");

        $stmt->execute([
            ':animal_id'   => $data['animal_id'],
            ':date'        => $data['date'],
            ':title'       => $data['title'],
            ':description' => $data['description'] ?: null,
            ':vet'         => $data['vet'] ?: null,
        ]);
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->conn->prepare("
            UPDATE {$this->table}
            SET date = :date, title = :title, description = :description, vet = :vet
            WHERE id = :id
        ");

        $stmt->execute([
            ':date'        => $data['date'],
            ':title'       => $data['title'],
            ':description' => $data['description'] ?: null,
            ':vet'         => $data['vet'] ?: null,
            ':id'          => $id,
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function deleteByAnimal(int $animalId): void
    {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE animal_id = ?");
        $stmt->execute([$animalId]);
    }
}
