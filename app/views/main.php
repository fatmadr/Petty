<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Health Record Management</title>

  <!-- ===== PETPAL TEMPLATE CSS ===== -->
  <link rel="stylesheet" href="css/animate.min.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/default.css">
  <link rel="stylesheet" href="css/flaticon_pet_care.css">
  <link rel="stylesheet" href="css/fontawesome-all.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/odometer.css">
  <link rel="stylesheet" href="css/reservation.css">
  <link rel="stylesheet" href="css/responsive.css">
  <link rel="stylesheet" href="css/select2.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/swiper-bundle.min.css">

  <!-- Your custom theme overrides -->
  <style>
    body { background:#f7fafc; font-family:Inter,system-ui; }
    .btn-main{ background:#24A36D; color:white; border:none }
    .btn-main:hover{ background:#2c2250; }
    .card-animal{ cursor:pointer; transition:0.12s; }
    .card-animal:hover{ transform:translateY(-4px) }
    .avatar{ width:64px;height:64px;border-radius:50%;display:grid;place-items:center;font-weight:700;color:#fff;background:linear-gradient(135deg,#7fb3ff,#2b7cff); font-size:20px }
    .record{ border:1px solid #e8eef8; padding:12px; border-radius:8px; background:#fff; }
    .small-btn{ font-size:13px; padding:6px 8px; border-radius:8px }
  </style>
</head>

<body>

<!-- ========================================================= -->
<!--                    PETPAL NAVBAR                          -->
<!-- ========================================================= -->

<header>
    <div id="header-fixed-height"></div>
    <div id="sticky-header" class="tg-header__area tg-header__area-three">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tgmenu__wrap">
                        <div class="row align-items-center">

                            <!-- LEFT MENU -->
                            <div class="col-xl-5">
                                <div class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-xl-flex">
                                    <ul class="navigation">
                                        <li><a href="index.php">Dashboard</a></li>
                                        <li><a href="#">Animals</a></li>
                                        <li><a href="#">Records</a></li>
                                        <li><a href="#">Contact</a></li>
                                    </ul>
                                </div>
                            </div>

                            <!-- LOGO -->
                            <div class="col-xl-2 col-md-4">
                                <div class="logo text-center">
                                    <a href="index.php"><img src="pic.png" alt="Logo"></a>
                                </div>
                            </div>

                            <!-- RIGHT ACTIONS -->
                            <div class="col-xl-5 col-md-8">
                                <div class="tgmenu__action tgmenu__action-two d-none d-md-block">
                                    <ul class="list-wrap">
                                        <li class="header-search">
                                            <a href="javascript:void(0)" class="search-open-btn">
                                                <i class="flaticon-loupe"></i>
                                            </a>
                                        </li>
                                        <li class="header-btn login-btn">
                                            <a href="#" class="btn"><i class="flaticon-locked"></i> Login</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="mobile-nav-toggler">
                            <i class="flaticon-layout"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<!-- ========================================================= -->
<!--          HEALTH RECORD MANAGEMENT MAIN CONTENT            -->
<!-- ========================================================= -->

<div class="container mt-4">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h1 class="mb-0">Health Record Management</h1>
      <small class="text-muted">Manage animal profiles and their health records</small>
    </div>
    <div>
      <button class="btn btn-main" data-bs-toggle="modal" data-bs-target="#addAnimalModal">+ Add Animal</button>
    </div>
  </div>

  <div class="row g-3">

    <!-- LEFT: Animals -->
    <div class="col-lg-4">
      <form class="mb-2 d-flex justify-content-between align-items-center" method="get" action="index.php">
        <strong>Animals</strong>
        <input name="search" value="<?= htmlspecialchars($search ?? ''); ?>" class="form-control form-control-sm" placeholder="Search name..." style="max-width:160px">
      </form>

      <div class="d-grid gap-2">

        <?php if (empty($animals)): ?>
          <div class="text-muted">No animals found.</div>
        <?php else: ?>
          <?php foreach ($animals as $a): ?>
            <?php $isSelected = $selectedAnimal && $selectedAnimal['id'] == $a['id']; ?>

            <div class="card p-2 card-animal <?= $isSelected ? 'border border-primary' : '' ?>">
              <div class="d-flex align-items-center">

                <div class="avatar me-3">
                  <?= strtoupper(substr($a['name'], 0, 1)); ?>
                </div>

                <div class="flex-grow-1">
                  <a href="index.php?selected=<?= $a['id']; ?>" class="text-dark text-decoration-none">
                    <div class="fw-bold"><?= htmlspecialchars($a['name']); ?></div>
                    <div class="text-muted small">
                      <?= htmlspecialchars($a['species'] ?? ''); ?> · <?= htmlspecialchars($a['breed'] ?? ''); ?>
                    </div>
                  </a>
                </div>

                <form method="post" action="index.php" onsubmit="return confirm('Delete this animal and all its records?');">
                  <input type="hidden" name="action" value="delete_animal">
                  <input type="hidden" name="animal_id" value="<?= $a['id']; ?>">
                  <button class="btn btn-sm btn-outline-danger small-btn">Delete</button>
                </form>

              </div>
            </div>

          <?php endforeach; ?>
        <?php endif; ?>

      </div>
    </div>

    <!-- RIGHT: Animal details -->
    <div class="col-lg-8">
      <div class="card p-3">

        <?php if (!$selectedAnimal): ?>
          <div class="text-muted">Select an animal or add a new one.</div>

        <?php else: ?>
          <div class="d-flex gap-3 align-items-center mb-2">
            <div class="avatar"><?= strtoupper(substr($selectedAnimal['name'],0,1)); ?></div>

            <div>
              <h4 class="mb-0"><?= htmlspecialchars($selectedAnimal['name']); ?></h4>
              <div class="text-muted">
                <?= htmlspecialchars($selectedAnimal['species']); ?> · <?= htmlspecialchars($selectedAnimal['breed']); ?>
                <?php if (!empty($selectedAnimal['dob'])): ?>
                · <?= floor((time() - strtotime($selectedAnimal['dob']))/(60*60*24*365)); ?> yrs
                <?php endif; ?>
              </div>
            </div>

            <button class="btn btn-main btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#recordModal">
              + Add Health Record
            </button>
          </div>

          <hr>

          <h5>Health Records</h5>
          <div class="text-muted mb-2"><?= count($records) ?> record(s)</div>

          <!-- Records -->
          <?php if (empty($records)): ?>
            <div class="text-muted">No health records yet.</div>

          <?php else: ?>
            <?php foreach ($records as $r): ?>
              <div class="record d-flex justify-content-between align-items-start">
                <div>
                  <div class="fw-bold"><?= htmlspecialchars($r['title']); ?></div>
                  <div class="small text-muted">
                    <?= htmlspecialchars($r['date']); ?> · <?= htmlspecialchars($r['vet']); ?>
                  </div>
                  <div class="mt-2"><?= nl2br(htmlspecialchars($r['description'])); ?></div>
                </div>

                <div class="d-flex flex-column">
                  <a href="index.php?selected=<?= $selectedAnimal['id']; ?>&edit_record=<?= $r['id']; ?>"
                     class="btn btn-sm btn-outline-secondary mb-1 small-btn">Edit</a>

                  <form method="post" action="index.php" onsubmit="return confirm('Delete this record?');">
                    <input type="hidden" name="action" value="delete_record">
                    <input type="hidden" name="record_id" value="<?= $r['id']; ?>">
                    <button class="btn btn-sm btn-outline-danger small-btn">Delete</button>
                  </form>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>

        <?php endif; ?>

      </div>
    </div>
  </div>
</div>

<!-- ========================================================= -->
<!--                        MODALS                             -->
<!-- ========================================================= -->

<!-- ADD ANIMAL -->
<div class="modal fade" id="addAnimalModal">
  <div class="modal-dialog">
    <div class="modal-content p-3">
      <h5>Add Animal</h5>
      <form method="post" action="index.php">
        <input type="hidden" name="action" value="add_animal">

        <label>Name</label>
        <input type="text" name="name" class="form-control mb-2" required>

        <label>Species</label>
        <input type="text" name="species" class="form-control mb-2">

        <label>Breed</label>
        <input type="text" name="breed" class="form-control mb-2">

        <label>Date of Birth</label>
        <input type="date" name="dob" class="form-control mb-3">
        
        

        <label for="title">Gender :</label>
        <label for="F."> F. </label>
        <input type="radio" id="F." name="title" value="F." >
        
        <label for="M."> M. </label>
        <input type="radio" id="M." name="title" value="M." >



        <button class="btn btn-main w-100">Save</button>

      </form>
    </div>
  </div>
</div>

<!-- ADD / EDIT RECORD -->
<div class="modal fade" id="recordModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-3">
      <h5><?= isset($recordToEdit) ? "Edit Record" : "Add Record" ?></h5>

      <form method="post" action="index.php">
        <input type="hidden" name="action" value="save_record">
        <input type="hidden" name="animal_id" value="<?= $selectedAnimal['id'] ?? 0 ?>">
        <input type="hidden" name="record_id" value="<?= $recordToEdit['id'] ?? 0 ?>">

        <label>Date</label>
        <input type="date" name="date" class="form-control mb-2"
               value="<?= $recordToEdit['date'] ?? date('Y-m-d') ?>" required>

        <label>Veterinarian</label>
        <input type="text" name="vet" class="form-control mb-2"
               value="<?= $recordToEdit['vet'] ?? '' ?>">

        <label>Title</label>
        <input type="text" name="title" class="form-control mb-2"
               value="<?= $recordToEdit['title'] ?? '' ?>" required>

        <label>Description</label>
        <textarea name="description" class="form-control mb-3" rows="3"><?= $recordToEdit['description'] ?? '' ?></textarea>

        <button class="btn btn-main w-100">Save Record</button>
      </form>

    </div>
  </div>
</div>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<?php if (!empty($openRecordModal)): ?>
<script>
  new bootstrap.Modal(document.getElementById('recordModal')).show();
</script>
<?php endif; ?>

</body>
</html>
