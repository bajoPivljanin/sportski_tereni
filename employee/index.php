<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../inc/header.php';

$allReservations = [
    [
        'reservation_id' => 1,
        'reservation_code' => 'REZ-8492',
        'first_name' => 'Marko',
        'last_name' => 'Marković',
        'email' => 'marko@gmail.com',
        'court_name' => 'Glavni teniski teren',
        'reservation_datetime' => '2026-07-15 18:00:00',
        'duration_minute' => 60,
        'reservation_status' => 'Na čekanju'
    ],
    [
        'reservation_id' => 2,
        'reservation_code' => 'REZ-1104',
        'first_name' => 'Nikola',
        'last_name' => 'Nikolić',
        'email' => 'nikola@hotmail.com',
        'court_name' => 'Fudbalski teren sa veštačkom travom',
        'reservation_datetime' => '2026-07-16 20:00:00',
        'duration_minute' => 90,
        'reservation_status' => 'Potvrđeno'
    ]
];
?>

<main class="employee-section py-5">
    <div class="container">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="employee-main-title h2 fw-bold" style="color: #1e3f20;">Radna tabla za zaposlene</h1>
                <p class="text-muted">Upravljanje i pregled svih zakazanih termina na sportskim terenima.</p>
            </div>
            <span class="badge px-3 py-2" style="background-color: #1e3f20; color: #fff;">Zaposleni panel</span>
        </div>

        <div class="card border-0 shadow-sm mb-4 p-3" style="border-radius: 12px;">
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                    <input type="text" id="employee-search" class="form-control" placeholder="Pretraži po kodu, imenu klijenta ili terenu..." onkeyup="filterEmployeeTable()">
                </div>
                <div class="col-md-3">
                    <select id="employee-status-filter" class="form-select" onchange="filterEmployeeTable()">
                        <option value="">Svi statusi</option>
                        <option value="na čekanju">Na čekanju</option>
                        <option value="potvrđeno">Potvrđeno</option>
                        <option value="otkazano">Otkazano</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="table-responsive card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
            <table class="table table-hover align-middle mb-0" id="employee-table">
                <thead style="background-color: #1e3f20; color: #fff;">
                    <tr>
                        <th class="py-3 px-4">Kod</th>
                        <th class="py-3">Klijent</th>
                        <th class="py-3">Teren</th>
                        <th class="py-3">Datum i vreme</th>
                        <th class="py-3">Trajanje</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 text-end px-4">Akcije</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allReservations as $rez): 
                        $fullName = htmlspecialchars($rez['first_name'] . ' ' . $rez['last_name']);
                        $status = strtolower($rez['reservation_status']);
                        
                        $statusBadge = 'bg-warning text-dark';
                        if ($status === 'potvrđeno' || $status === 'potvrdjeno') $statusBadge = 'bg-success text-white';
                        if ($status === 'otkazano') $statusBadge = 'bg-danger text-white';
                    ?>
                        <tr id="employee-row-<?php echo $rez['reservation_id']; ?>">
                            <td class="fw-bold px-4"><?php echo htmlspecialchars($rez['reservation_code']); ?></td>
                            <td>
                                <div class="fw-bold"><?php echo $fullName; ?></div>
                                <small class="text-muted"><?php echo htmlspecialchars($rez['email']); ?></small>
                            </td>
                            <td><?php echo htmlspecialchars($rez['court_name']); ?></td>
                            <td><?php echo date('d.m.Y. u H:i', strtotime($rez['reservation_datetime'])) . 'h'; ?></td>
                            <td><?php echo $rez['duration_minute']; ?> min</td>
                            <td class="status-zone">
                                <span class="badge rounded-pill <?php echo $statusBadge; ?> px-3 py-2 text-capitalize">
                                    <?php echo htmlspecialchars($rez['reservation_status']); ?>
                                </span>
                            </td>
                            <td class="text-end px-4">
                                <div class="d-inline-flex gap-2">
                                    <button class="btn btn-sm text-white btn-confirm" 
                                            style="background-color: #1e3f20;"
                                            onclick="changeStatusFrontendOnly('<?php echo $rez['reservation_id']; ?>', 'Potvrđeno')"
                                            <?php echo ($status === 'potvrđeno' || $status === 'otkazano') ? 'disabled' : ''; ?>>
                                        Potvrdi
                                    </button>
                                    <button class="btn btn-sm btn-light border btn-cancel text-danger" 
                                            onclick="changeStatusFrontendOnly('<?php echo $rez['reservation_id']; ?>', 'Otkazano')"
                                            <?php echo ($status === 'otkazano') ? 'disabled' : ''; ?>>
                                        Otkaži
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</main>

<script>

/**
 * Instant pretraga i filtriranje tabele na klijentskoj strani
 */
function filterEmployeeTable() {
  const searchInput = document.getElementById('employee-search').value.toLowerCase();
  const statusFilter = document.getElementById('employee-status-filter').value.toLowerCase();
  const tableRows = document.querySelectorAll('#employee-table tbody tr');

  tableRows.forEach(row => {
    const rowText = row.textContent.toLowerCase();
    const statusText = row.querySelector('.status-zone').textContent.toLowerCase();

    const matchesSearch = rowText.includes(searchInput);
    const matchesStatus = statusFilter === "" || statusText.includes(statusFilter);

    if (matchesSearch && matchesStatus) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
}

/**
 * Vizuelna promena statusa na klik dugmeta (Samo frontend)
 */
function changeStatusFrontendOnly(bookingId, newStatus) {
  const row = document.getElementById(`employee-row-${bookingId}`);
  if (row) {
    const statusZone = row.querySelector('.status-zone');
    const btnConfirm = row.querySelector('.btn-confirm');
    const btnCancel = row.querySelector('.btn-cancel');
    
    if (newStatus === 'Potvrđeno') {
      statusZone.innerHTML = `<span class="badge rounded-pill bg-success text-white px-3 py-2">Potvrđeno</span>`;
      btnConfirm.disabled = true;
    } else if (newStatus === 'Otkazano') {
      statusZone.innerHTML = `<span class="badge rounded-pill bg-danger text-white px-3 py-2">Otkazano</span>`;
      btnConfirm.disabled = true;
      btnCancel.disabled = true;
    }
  }
}
</script>

<?php require_once '../inc/footer.php'; ?>