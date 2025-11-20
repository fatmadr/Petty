<?php
// Show errors while developing
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../config/Database.php';

$db = (new Database())->connect();

// ===== Handle POST actions (add/edit/delete) =====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // ADD ANIMAL
    if ($action === 'add_animal') {
        $name    = trim($_POST['name'] ?? '');
        $species = trim($_POST['species'] ?? '');
        $breed   = trim($_POST['breed'] ?? '');
        $dob     = $_POST['dob'] ?? null;

        if ($name !== '') {
            $stmt = $db->prepare("INSERT INTO animals (name, species, breed, dob) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $species ?: null, $breed ?: null, $dob ?: null]);
        }

        header("Location: admin.php?view=animals");
        exit;
    }

    // UPDATE ANIMAL
    if ($action === 'edit_animal') {
        $id      = (int)($_POST['id'] ?? 0);
        $name    = trim($_POST['name'] ?? '');
        $species = trim($_POST['species'] ?? '');
        $breed   = trim($_POST['breed'] ?? '');
        $dob     = $_POST['dob'] ?? null;

        if ($id > 0 && $name !== '') {
            $stmt = $db->prepare("UPDATE animals SET name = ?, species = ?, breed = ?, dob = ? WHERE id = ?");
            $stmt->execute([$name, $species ?: null, $breed ?: null, $dob ?: null, $id]);
        }

        header("Location: admin.php?view=animals");
        exit;
    }

    // DELETE ANIMAL (and its records)
    if ($action === 'delete_animal') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            $db->prepare("DELETE FROM records WHERE animal_id = ?")->execute([$id]);
            $db->prepare("DELETE FROM animals WHERE id = ?")->execute([$id]);
        }
        header("Location: admin.php?view=animals");
        exit;
    }

    // ADD RECORD
    if ($action === 'add_record') {
        $animalId    = (int)($_POST['animal_id'] ?? 0);
        $date        = $_POST['date'] ?? date('Y-m-d');
        $title       = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $vet         = trim($_POST['vet'] ?? '');

        if ($animalId > 0 && $title !== '') {
            $stmt = $db->prepare("
                INSERT INTO records (animal_id, date, title, description, vet)
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([$animalId, $date, $title, $description ?: null, $vet ?: null]);
        }

        header("Location: admin.php?view=records");
        exit;
    }

    // UPDATE RECORD
    if ($action === 'edit_record') {
        $id          = (int)($_POST['id'] ?? 0);
        $animalId    = (int)($_POST['animal_id'] ?? 0);
        $date        = $_POST['date'] ?? date('Y-m-d');
        $title       = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $vet         = trim($_POST['vet'] ?? '');

        if ($id > 0 && $animalId > 0 && $title !== '') {
            $stmt = $db->prepare("
                UPDATE records
                SET animal_id = ?, date = ?, title = ?, description = ?, vet = ?
                WHERE id = ?
            ");
            $stmt->execute([$animalId, $date, $title, $description ?: null, $vet ?: null, $id]);
        }

        header("Location: admin.php?view=records");
        exit;
    }

    // DELETE RECORD
    if ($action === 'delete_record') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            $db->prepare("DELETE FROM records WHERE id = ?")->execute([$id]);
        }
        header("Location: admin.php?view=records");
        exit;
    }
}

// ===== Determine which page to show =====
$view = $_GET['view'] ?? 'dashboard';

// ===== Load data for dashboard / tables =====
$totalAnimals = (int)$db->query("SELECT COUNT(*) FROM animals")->fetchColumn();
$totalRecords = (int)$db->query("SELECT COUNT(*) FROM records")->fetchColumn();

$latestRecords = $db->query("
    SELECT r.*, a.name AS animal_name
    FROM records r
    JOIN animals a ON a.id = r.animal_id
    ORDER BY r.date DESC, r.id DESC
    LIMIT 5
")->fetchAll();

$animals = $db->query("
    SELECT a.*, COUNT(r.id) AS records_count
    FROM animals a
    LEFT JOIN records r ON r.animal_id = a.id
    GROUP BY a.id
    ORDER BY a.id DESC
")->fetchAll();

$records = $db->query("
    SELECT r.*, a.name AS animal_name
    FROM records r
    JOIN animals a ON a.id = r.animal_id
    ORDER BY r.date DESC, r.id DESC
")->fetchAll();

// For editing animal / record
$editAnimal = null;
if ($view === 'animals' && isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $stmt = $db->prepare("SELECT * FROM animals WHERE id = ?");
    $stmt->execute([$id]);
    $editAnimal = $stmt->fetch();
}

$editRecord = null;
if ($view === 'records' && isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $stmt = $db->prepare("SELECT * FROM records WHERE id = ?");
    $stmt->execute([$id]);
    $editRecord = $stmt->fetch();
}

// animals for record form select
$animalsForSelect = $db->query("SELECT id, name FROM animals ORDER BY name ASC")->fetchAll();

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <title>Admin Panel - Health Records</title>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial;
      background:#f5f7fb;
    }
    .sidebar {
      min-height: 100vh;
      background: #1f2937;
      color: #e5e7eb;
    }
    .sidebar a {
      color: #e5e7eb;
      text-decoration: none;
      display:block;
      padding:10px 14px;
      border-radius:8px;
      margin-bottom:4px;
    }
    .sidebar a.active, .sidebar a:hover {
      background:#374151;
    }
    .stat-card {
      border-radius: 12px;
      padding: 16px;
      background:#ffffff;
      box-shadow: 0 2px 6px rgba(15,23,42,0.06);
    }
    .table thead {
      background:#eef2ff;
    }
  </style>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <aside class="col-md-2 sidebar p-3">
      <h4 class="mb-3">Admin Panel</h4>
      <p class="small text-muted">Health Record Management</p>
      <nav class="mt-3">
        <a href="admin.php?view=dashboard" class="<?= $view === 'dashboard' ? 'active' : '' ?>">Dashboard</a>
        <a href="admin.php?view=animals" class="<?= $view === 'animals' ? 'active' : '' ?>">Animals</a>
        <a href="admin.php?view=records" class="<?= $view === 'records' ? 'active' : '' ?>">Records</a>
        <a href="index.php" class="mt-3">← Back to App</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="col-md-10 p-4">
      <?php if ($view === 'dashboard'): ?>
        <!-- DASHBOARD -->
        <h2 class="mb-4">Dashboard</h2>
        <div class="row g-3 mb-4">
          <div class="col-md-4">
            <div class="stat-card">
              <div class="text-muted small">Total Animals</div>
              <div class="fs-3 fw-bold"><?= $totalAnimals; ?></div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-card">
              <div class="text-muted small">Total Health Records</div>
              <div class="fs-3 fw-bold"><?= $totalRecords; ?></div>
            </div>
          </div>
        </div>

        <h5 class="mb-3">Latest Records</h5>
        <?php if (empty($latestRecords)): ?>
          <div class="text-muted">No records yet.</div>
        <?php else: ?>
          <div class="table-responsive">
            <table class="table table-sm align-middle">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Animal</th>
                  <th>Date</th>
                  <th>Title</th>
                  <th>Vet</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($latestRecords as $r): ?>
                  <tr>
                    <td><?= $r['id']; ?></td>
                    <td><?= htmlspecialchars($r['animal_name']); ?></td>
                    <td><?= htmlspecialchars($r['date']); ?></td>
                    <td><?= htmlspecialchars($r['title']); ?></td>
                    <td><?= htmlspecialchars($r['vet'] ?? ''); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>

      <?php elseif ($view === 'animals'): ?>
        <!-- ANIMALS -->
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h2>Animals</h2>
          <button class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#animalForm">
            <?= $editAnimal ? 'Edit Animal' : 'Add Animal'; ?>
          </button>
        </div>

        <!-- Add / Edit Animal Form -->
        <div id="animalForm" class="collapse show mb-3">
          <div class="card card-body">
            <form method="post" action="admin.php?view=animals">
              <?php if ($editAnimal): ?>
                <input type="hidden" name="action" value="edit_animal">
                <input type="hidden" name="id" value="<?= $editAnimal['id']; ?>">
              <?php else: ?>
                <input type="hidden" name="action" value="add_animal">
              <?php endif; ?>

              <div class="row g-2">
                <div class="col-md-4">
                  <label class="form-label">Name</label>
                  <input name="name" class="form-control" required
                         value="<?= htmlspecialchars($editAnimal['name'] ?? ''); ?>">
                </div>
                <div class="col-md-3">
                  <label class="form-label">Species</label>
                  <input name="species" class="form-control"
                         value="<?= htmlspecialchars($editAnimal['species'] ?? ''); ?>">
                </div>
                <div class="col-md-3">
                  <label class="form-label">Breed</label>
                  <input name="breed" class="form-control"
                         value="<?= htmlspecialchars($editAnimal['breed'] ?? ''); ?>">
                </div>
                <div class="col-md-2">
                  <label class="form-label">DOB</label>
                  <input name="dob" type="date" class="form-control"
                         value="<?= htmlspecialchars($editAnimal['dob'] ?? ''); ?>">
                </div>
              </div>

              <div class="mt-3 d-flex gap-2">
                <button type="submit" class="btn btn-success">
                  <?= $editAnimal ? 'Update Animal' : 'Add Animal'; ?>
                </button>
                <?php if ($editAnimal): ?>
                  <a href="admin.php?view=animals" class="btn btn-secondary">Cancel</a>
                <?php endif; ?>
              </div>
            </form>
          </div>
        </div>

        <!-- Animals Table -->
        <div class="card">
          <div class="card-body">
            <?php if (empty($animals)): ?>
              <div class="text-muted">No animals found.</div>
            <?php else: ?>
              <div class="table-responsive">
                <table class="table table-hover align-middle">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Species</th>
                      <th>Breed</th>
                      <th>DOB</th>
                      <th>Records</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($animals as $a): ?>
                      <tr>
                        <td><?= $a['id']; ?></td>
                        <td><?= htmlspecialchars($a['name']); ?></td>
                        <td><?= htmlspecialchars($a['species'] ?? ''); ?></td>
                        <td><?= htmlspecialchars($a['breed'] ?? ''); ?></td>
                        <td><?= htmlspecialchars($a['dob'] ?? ''); ?></td>
                        <td><?= (int)$a['records_count']; ?></td>
                        <td class="d-flex gap-1">
                          <a href="admin.php?view=animals&edit=<?= $a['id']; ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                          <form method="post" action="admin.php?view=animals" onsubmit="return confirm('Delete this animal and its records?');">
                            <input type="hidden" name="action" value="delete_animal">
                            <input type="hidden" name="id" value="<?= $a['id']; ?>">
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                          </form>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php endif; ?>
          </div>
        </div>

      <?php elseif ($view === 'records'): ?>
        <!-- RECORDS -->
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h2>Records</h2>
          <button class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#recordForm">
            <?= $editRecord ? 'Edit Record' : 'Add Record'; ?>
          </button>
        </div>

        <!-- Add / Edit Record Form -->
        <div id="recordForm" class="collapse show mb-3">
          <div class="card card-body">
            <form method="post" action="admin.php?view=records">
              <?php if ($editRecord): ?>
                <input type="hidden" name="action" value="edit_record">
                <input type="hidden" name="id" value="<?= $editRecord['id']; ?>">
              <?php else: ?>
                <input type="hidden" name="action" value="add_record">
              <?php endif; ?>

              <div class="row g-2">
                <div class="col-md-3">
                  <label class="form-label">Animal</label>
                  <select name="animal_id" class="form-select" required>
                    <option value="">-- select --</option>
                    <?php foreach ($animalsForSelect as $af): ?>
                      <option value="<?= $af['id']; ?>"
                        <?= ($editRecord && $editRecord['animal_id'] == $af['id']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($af['name']); ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Date</label>
                  <input name="date" type="date" class="form-control" required
                         value="<?= htmlspecialchars($editRecord['date'] ?? date('Y-m-d')); ?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Title</label>
                  <input name="title" class="form-control" required
                         value="<?= htmlspecialchars($editRecord['title'] ?? ''); ?>">
                </div>
              </div>

              <div class="row g-2 mt-2">
                <div class="col-md-6">
                  <label class="form-label">Veterinarian</label>
                  <input name="vet" class="form-control"
                         value="<?= htmlspecialchars($editRecord['vet'] ?? ''); ?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Description</label>
                  <textarea name="description" rows="2" class="form-control"><?= htmlspecialchars($editRecord['description'] ?? ''); ?></textarea>
                </div>
              </div>

              <div class="mt-3 d-flex gap-2">
                <button type="submit" class="btn btn-success">
                  <?= $editRecord ? 'Update Record' : 'Add Record'; ?>
                </button>
                <?php if ($editRecord): ?>
                  <a href="admin.php?view=records" class="btn btn-secondary">Cancel</a>
                <?php endif; ?>
              </div>
            </form>
          </div>
        </div>

        <!-- Records Table -->
        <div class="card">
          <div class="card-body">
            <?php if (empty($records)): ?>
              <div class="text-muted">No records found.</div>
            <?php else: ?>
              <div class="table-responsive">
                <table class="table table-hover align-middle">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Animal</th>
                      <th>Date</th>
                      <th>Title</th>
                      <th>Vet</th>
                      <th>Description</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($records as $r): ?>
                      <tr>
                        <td><?= $r['id']; ?></td>
                        <td><?= htmlspecialchars($r['animal_name']); ?></td>
                        <td><?= htmlspecialchars($r['date']); ?></td>
                        <td><?= htmlspecialchars($r['title']); ?></td>
                        <td><?= htmlspecialchars($r['vet'] ?? ''); ?></td>
                        <td><?= nl2br(htmlspecialchars(mb_strimwidth($r['description'] ?? '', 0, 50, '...'))); ?></td>
                        <td class="d-flex gap-1">
                          <a href="admin.php?view=records&edit=<?= $r['id']; ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                          <form method="post" action="admin.php?view=records" onsubmit="return confirm('Delete this record?');">
                            <input type="hidden" name="action" value="delete_record">
                            <input type="hidden" name="id" value="<?= $r['id']; ?>">
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                          </form>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>
    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
