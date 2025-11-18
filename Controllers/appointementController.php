<?php
session_start();

require_once __DIR__ . '/../Config/database.php';
require_once __DIR__ . '/../Models/appointment.php';

$db = (new Database())->connect();
$controller = new AppointmentController($db);

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($action) {
    case 'store':
        $controller->store();
        break;
    case 'index':
        $controller->index();
        break;
    case 'show':
        $controller->show();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'update':
        $controller->update();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        echo "Unknown action";
}

class AppointmentController {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    // List appointments of logged-in owner
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            die("Not logged in");
        }

        $model = new Appointment($this->db);
        $stmt = $model->getAllByOwner($_SESSION['user_id']);
        $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/../../views/frontoffice/appointment_list.php';
    }

    // Show single appointment
    public function show() {
        if (!isset($_GET['id'])) die("Missing id");

        $model = new Appointment($this->db);
        $model->appointment_id = (int)$_GET['id'];
        $appointment = $model->getOne();

        include __DIR__ . '/../../views/frontoffice/appointment_show.php';
    }

    // Edit form
    public function edit() {
        if (!isset($_GET['id'])) die("Missing id");

        $model = new Appointment($this->db);
        $model->appointment_id = (int)$_GET['id'];
        $appointment = $model->getOne();

        include __DIR__ . '/../../views/frontoffice/appointment_edit.php';
    }

    // Handle create (from reservation.php)
    public function store() {
        if (!isset($_SESSION['user_id'])) {
            die("Not logged in");
        }

        $errors = [];

        $patient_name  = trim($_POST['patient_name']);
        $patient_phone = trim($_POST['patient_phone']);
        $species       = trim($_POST['species']);
        $visit_reason  = trim($_POST['visit_reason']);
        $appointment_date = trim($_POST['appointment_date']);
        $timeslot_id   = isset($_POST['timeslot_id']) ? (int)$_POST['timeslot_id'] : 0;
        $vet_id        = isset($_POST['vet_id']) ? (int)$_POST['vet_id'] : 0;
        $first_visit   = isset($_POST['first_visit']) ? (int)$_POST['first_visit'] : 0;
        $is_emergency  = isset($_POST['is_emergency']) ? (int)$_POST['is_emergency'] : 0;
        $notify_if_earlier = isset($_POST['notify_if_earlier']) ? 1 : 0;

        if ($patient_name === "") $errors[] = "Patient name is required.";
        if ($patient_phone === "") $errors[] = "Phone is required.";
        if ($species === "") $errors[] = "Species is required.";
        if ($visit_reason === "") $errors[] = "Reason is required.";
        if ($appointment_date === "") $errors[] = "Date is required.";
        if ($timeslot_id === 0) $errors[] = "Time slot is required.";

        // very simple date validation
        if ($appointment_date !== "" && !strtotime($appointment_date)) {
            $errors[] = "Invalid date format (use YYYY-MM-DD).";
        }

        if (!empty($errors)) {
            echo "<h3>Validation errors:</h3><ul>";
            foreach ($errors as $e) echo "<li>".htmlspecialchars($e)."</li>";
            echo "</ul><a href='../../views/frontoffice/reservation.php'>Back</a>";
            exit;
        }

        // For the time we can get it from the timeslot
        $stmt = $this->db->prepare("SELECT start_time FROM timeslots WHERE timeslot_id = ?");
        $stmt->execute([$timeslot_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            die("Invalid timeslot");
        }
        $appointment_time = $row['start_time'];

        $model = new Appointment($this->db);
        $model->pet_owner_id = $_SESSION['user_id'];
        $model->vet_id = $vet_id;
        $model->timeslot_id = $timeslot_id;
        $model->appointment_date = $appointment_date;
        $model->appointment_time = $appointment_time;
        $model->status = "pending";
        $model->visit_reason = $visit_reason;
        $model->is_emergency = $is_emergency;
        $model->first_visit = $first_visit;
        $model->species = $species;
        $model->patient_name = $patient_name;
        $model->patient_phone = $patient_phone;
        $model->notify_if_earlier = $notify_if_earlier;

        $model->create();

        header("Location: AppointmentController.php?action=index");
        exit;
    }

    // Handle update
    public function update() {
        if (!isset($_SESSION['user_id'])) die("Not logged in");
        if (!isset($_POST['appointment_id'])) die("Missing id");

        $model = new Appointment($this->db);
        $model->appointment_id = (int)$_POST['appointment_id'];
        $model->pet_owner_id   = $_SESSION['user_id'];

        $model->visit_reason   = trim($_POST['visit_reason']);
        $model->is_emergency   = isset($_POST['is_emergency']) ? (int)$_POST['is_emergency'] : 0;
        $model->first_visit    = isset($_POST['first_visit']) ? (int)$_POST['first_visit'] : 0;
        $model->species        = trim($_POST['species']);
        $model->patient_name   = trim($_POST['patient_name']);
        $model->patient_phone  = trim($_POST['patient_phone']);
        $model->notify_if_earlier = isset($_POST['notify_if_earlier']) ? 1 : 0;

        $model->update();

        header("Location: AppointmentController.php?action=index");
        exit;
    }

    // Delete
    public function delete() {
        if (!isset($_SESSION['user_id'])) die("Not logged in");
        if (!isset($_GET['id'])) die("Missing id");

        $model = new Appointment($this->db);
        $model->appointment_id = (int)$_GET['id'];
        $model->pet_owner_id   = $_SESSION['user_id'];
        $model->delete();

        header("Location: AppointmentController.php?action=index");
        exit;
    }
}
