<?php
class Notification {
    private $conn;
    private $table = "notifications";

    public $notification_id;
    public $appointment_id;
    public $notification_type;
    public $message;
    public $sent_at;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $sql = "INSERT INTO {$this->table}
                (appointment_id, notification_type, message, sent_at, status)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $this->appointment_id,
            $this->notification_type,
            $this->message,
            $this->sent_at,
            $this->status
        ]);
    }
}
