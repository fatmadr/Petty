<?php
class Appointment {
    private $conn;
    private $table = "appointments";

    public $appointment_id;
    public $user_id;
    public $vet_id;
    public $timeslot_id;
    public $appointment_date;
    public $appointment_time;
    public $status;
    public $visit_reason;
    public $is_emergency;
    public $first_visit;
    public $species;
    public $notify_if_earlier;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // CREATE
   public function create() {
    $sql = "INSERT INTO {$this->table}
            (user_id, vet_id, timeslot_id, appointment_date, appointment_time,
             status, visit_reason, is_emergency, first_visit,
             species, notify_if_earlier, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
        $this->user_id,
        $this->vet_id,
        $this->timeslot_id,
        $this->appointment_date,
        $this->appointment_time,
        $this->status,
        $this->visit_reason,
        $this->is_emergency,
        $this->first_visit,
        $this->species,
        $this->notify_if_earlier
    ]);
}


    // READ all appointments for a pet owner
    public function getAllByOwner($ownerId) {
        $sql = "SELECT a.*, t.start_time, t.end_time
                FROM {$this->table} a
                JOIN timeslots_default t ON a.timeslot_id = t.template_id
                WHERE a.user_id = ?
                ORDER BY a.appointment_date DESC, a.appointment_time DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$ownerId]);
        return $stmt;
    }

    // READ one
    public function getOne() {
    $sql = "SELECT *
            FROM {$this->table}
            WHERE appointment_id = ?
            LIMIT 1";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$this->appointment_id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    // UPDATE
    public function update() {
        $sql = "UPDATE {$this->table}
                SET visit_reason = ?, is_emergency = ?, first_visit = ?,
                    species = ?, notify_if_earlier = ?
                WHERE appointment_id = ? AND user_id = ?";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $this->visit_reason,
            $this->is_emergency,
            $this->first_visit,
            $this->species,
            $this->notify_if_earlier,
            $this->appointment_id,
            $this->user_id
        ]);
    }

    // DELETE
    public function delete() {
        $sql = "DELETE FROM {$this->table}
                WHERE appointment_id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$this->appointment_id, $this->user_id]);
    }
}

