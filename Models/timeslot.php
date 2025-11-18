<?php
class Timeslot {
    private $conn;
    private $table = "timeslots";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all slots for vet & date with booking info
    public function getByVetAndDate($vetId, $date) {
        $sql = "SELECT t.*,
                       CASE
                            WHEN EXISTS (
                                SELECT 1 FROM appointments a
                                WHERE a.timeslot_id = t.timeslot_id
                                  AND a.status IN ('pending','confirmed')
                            ) THEN 1
                            ELSE 0
                       END AS is_booked
                FROM {$this->table} t
                WHERE t.vet_id = ?
                  AND t.slot_date = ?
                ORDER BY t.start_time";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$vetId, $date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
