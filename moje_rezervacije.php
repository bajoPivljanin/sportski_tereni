<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require_once 'inc/header.php';
require_once 'app/config/db_config.php';
require_once 'app/classes/Reservation.php';

$reservationObj = new Reservation($pdo);
$reservation = $reservationObj->getUserReservations($_SESSION['user_id']);
?>
<main class="reservation-section">
    <div class="container">
        
        <div class="reservation-header">
            <h1 class="reservation-main-title">Moje rezervacije</h1>
            <p class="reservation-subtitle">Pregled svih vaših zakazanih termina i njihov trenutni status.</p>
        </div>

        <div class="table-responsive reservation-table-box">
            <table class="table reservation-table">
                <thead>
                    <tr>
                        <th>Kod rezervacije</th>
                        <th>Teren</th>
                        <th>Datum i vreme</th>
                        <th>Trajanje</th>
                        <th>Status</th>
                        <th>Napomena</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($rezervacije)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-4">Nemate nijednu rezervaciju.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($rezervacije as $rez): ?>
                        <?php
                        // Razdvajanje datetime kolone na srpski format datuma i vremena
                        $datum = date('d.m.Y.', strtotime($rez['reservation_datetime']));
                        $vreme = date('H:i', strtotime($rez['reservation_datetime'])) . 'h';

                        // Boje za statuse
                        $statusClass = 'status-pending bg-warning text-dark';
                        if (strtolower($rez['reservation_status']) === 'potvrđeno' || strtolower($rez['reservation_status']) === 'potvrdjeno') {
                            $statusClass = 'status-active bg-success text-white';
                        } elseif (strtolower($rez['reservation_status']) === 'otkazano') {
                            $statusClass = 'status-cancelled bg-danger text-white';
                        }
                        ?>
                        <tr>
                            <td class="reservation-code fw-bold"><?php echo htmlspecialchars($rez['reservation_code']); ?></td>
                            <td class="reservation-court-name"><?php echo htmlspecialchars($rez['court_name']); ?></td>
                            <td><?php echo $datum; ?> u <?php echo $vreme; ?></td>
                            <td><?php echo htmlspecialchars($rez['duration_minute']); ?> min</td>
                            <td>
                                    <span class="badge rounded-pill <?php echo $statusClass; ?> px-3 py-2">
                                        <?php echo htmlspecialchars($rez['reservation_status']); ?>
                                    </span>
                            </td>
                            <td class="reservation-note text-muted">
                                <?php echo !empty($rez['note']) ? htmlspecialchars($rez['note']) : '—'; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</main>
<?php
require_once 'inc/footer.php';
?>
