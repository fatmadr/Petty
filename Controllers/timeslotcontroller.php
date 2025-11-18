<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Timeslot.php';

$db = (new Database())->connect();
$model = new Timeslot($db);

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'byDate') {
    $vetId = isset($_GET['vet_id']) ? (int)$_GET['vet_id'] : 0;
    $date  = isset($_GET['date']) ? $_GET['date'] : '';

    if ($vetId === 0 || $date === '') {
        echo json_encode([]);
        exit;
    }

    $slots = $model->getByVetAndDate($vetId, $date);

    // Add period (morning/afternoon/evening) and status label
    $result = [];
    foreach ($slots as $s) {
        $hour = (int)substr($s['start_time'], 0, 2);
        if ($hour < 12) {
            $period = 'morning';
        } elseif ($hour < 18) {
            $period = 'afternoon';
        } else {
            $period = 'evening';
        }

        $result[] = [
            'id'          => (int)$s['timeslot_id'],
            'start_time'  => substr($s['start_time'], 0, 5),
            'end_time'    => substr($s['end_time'], 0, 5),
            'period'      => $period,
            'is_available'=> (int)$s['is_available'],
            'status'      => $s['is_booked'] ? 'booked' : 'free'
        ];
    }

    echo json_encode($result);
    exit;
}

echo json_encode([]);
