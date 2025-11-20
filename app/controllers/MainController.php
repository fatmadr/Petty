<?php

require_once __DIR__ . '/../models/Animal.php';
require_once __DIR__ . '/../models/Record.php';

class MainController
{
    private PDO $db;
    private Animal $animalModel;
    private Record $recordModel;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->animalModel = new Animal($db);
        $this->recordModel = new Record($db);
    }

    public function handle(): void
    {
        // ===========================
        //  HANDLE POST ACTIONS
        // ===========================
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? null;

            // ---- Add Animal ----
            if ($action === 'add_animal') {
                $name = trim($_POST['name'] ?? '');
                if ($name !== '') {
                    $this->animalModel->create([
                        'name'    => $name,
                        'species' => trim($_POST['species'] ?? ''),
                        'breed'   => trim($_POST['breed'] ?? ''),
                        'dob'     => $_POST['dob'] ?? null,
                    ]);
                }
                header("Location: index.php");
                exit;
            }

            // ---- Delete Animal ----
            if ($action === 'delete_animal') {
                $id = (int)($_POST['animal_id'] ?? 0);
                if ($id > 0) {
                    $this->recordModel->deleteByAnimal($id);
                    $this->animalModel->delete($id);
                }
                header("Location: index.php");
                exit;
            }

            // ---- Add / Edit Record ----
            if ($action === 'save_record') {
                $animalId = (int)($_POST['animal_id'] ?? 0);
                $recordId = (int)($_POST['record_id'] ?? 0);

                $data = [
                    'animal_id'   => $animalId,
                    'date'        => $_POST['date'] ?? date('Y-m-d'),
                    'title'       => trim($_POST['title'] ?? ''),
                    'description' => trim($_POST['description'] ?? ''),
                    'vet'         => trim($_POST['vet'] ?? ''),
                ];

                if ($data['title'] !== '' && $animalId > 0) {
                    if ($recordId > 0) {
                        $this->recordModel->update($recordId, $data);
                    } else {
                        $this->recordModel->create($data);
                    }
                }

                header("Location: index.php?selected=" . $animalId);
                exit;
            }

            // ---- Delete Record ----
            if ($action === 'delete_record') {
                $recordId = (int)($_POST['record_id'] ?? 0);
                if ($recordId > 0) {
                    $record = $this->recordModel->find($recordId);
                    $animalId = $record ? (int)$record['animal_id'] : 0;

                    $this->recordModel->delete($recordId);

                    header("Location: index.php?selected=" . $animalId);
                    exit;
                }
                header("Location: index.php");
                exit;
            }
        }

        // ===========================
        //  LOAD PAGE DATA
        // ===========================
        $search = trim($_GET['search'] ?? '');
        $animals = $this->animalModel->all($search);

        $selectedAnimal = null;
        $records = [];
        $selectedId = isset($_GET['selected']) ? (int)$_GET['selected'] : 0;

        if (!empty($animals)) {
            if ($selectedId === 0) {
                $selectedId = (int)$animals[0]['id'];
            }

            $selectedAnimal = $this->animalModel->find($selectedId);
            if ($selectedAnimal) {
                $records = $this->recordModel->forAnimal($selectedId);
            }
        }

        // Pre-fill record modal if editing
        $recordToEdit = null;
        $openRecordModal = false;

        if (isset($_GET['edit_record'])) {
            $recordToEdit = $this->recordModel->find((int)$_GET['edit_record']);
            $openRecordModal = $recordToEdit ? true : false;
        }

        // LOAD VIEW
        include __DIR__ . '/../views/main.php';
    }
}
