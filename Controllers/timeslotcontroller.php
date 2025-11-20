<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../Config/database.php';
require_once __DIR__ . '/../Models/timeslot.php';

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

   // 1. Get customized slots (if any)
$slots = $model->getByVetAndDate($vetId, $date);

// 2. If no custom slots exist → load defaults
if (empty($slots)) {
    $stmt = $db->prepare("SELECT 
                            template_id AS timeslot_id,
                            start_time,
                            end_time
                          FROM timeslots_default
                          ORDER BY start_time");
    $stmt->execute();
    $slots = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Mark all default slots as unbooked
    foreach ($slots as &$slot) {
        $slot['is_booked'] = 0;
    }
}


    // Add period (morning/afternoon/evening) and status label
  // Now convert them for JSON output
$result = [];

foreach ($slots as $s) {
    $hour = (int)substr($s['start_time'], 0, 2);
    $period = ($hour < 12) ? 'morning' : (($hour < 18) ? 'afternoon' : 'evening');

    $result[] = [
        'id'          => (int)$s['timeslot_id'],
        'start_time'  => substr($s['start_time'], 0, 5),
        'end_time'    => substr($s['end_time'], 0, 5),
        'period'      => $period,
        'is_available'=> $s['is_booked'] ? 0 : 1,
        'status'      => $s['is_booked'] ? 'booked' : 'free'
    ];
}

echo json_encode($result);
    exit;
}

echo json_encode([]);
