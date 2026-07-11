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
$reservations = $reservationObj->getUserReservations($_SESSION['user_id']);
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
                        <th>Akcije</th> <!-- Dodata kolona za akcije -->
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($reservations)): ?>
                    <tr>
                        <td colspan="7" class="text-center py-4">Nemate nijednu rezervaciju.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($reservations as $rez): ?>
                        <?php
                        // Osiguravamo da ključevi postoje kako PHP ne bi bacao Notice/Warning
                        $r_id   = isset($rez['reservation_id']) ? $rez['reservation_id'] : 0;
                        $r_code = isset($rez['reservation_code']) ? $rez['reservation_code'] : '—';
                        $c_name = isset($rez['court_name']) ? $rez['court_name'] : '—';
                        $r_note = !empty($rez['note']) ? htmlspecialchars($rez['note']) : '—';
                        $r_dur  = isset($rez['duration_minute']) ? $rez['duration_minute'] : 60;
                        $r_stat = isset($rez['reservation_status']) ? $rez['reservation_status'] : 'Na čekanju';

                        // Provera za datum - ako ne postoji 'reservation_datetime', koristi trenutno vreme da sprečiš pad koda
                        $dbDatetime = isset($rez['reservation_datetime']) ? $rez['reservation_datetime'] : date('Y-m-d H:i:s');
                        
                        $bookingTime = strtotime($dbDatetime);
                        $datum = date('d.m.Y.', $bookingTime);
                        $vreme = date('H:i', $bookingTime) . 'h';

                        // Izračunavanje vremenske razlike (6 sati limit)
                        $currentTime = time();
                        $hoursDifference = ($bookingTime - $currentTime) / 3600;
                        
                        $isTooLateToChange = ($hoursDifference < 6);
                        $isCancelled = (strtolower($r_stat) === 'otkazano');

                        // Klase za status bedž
                        $statusClass = 'status-pending bg-warning text-dark';
                        if (strtolower($r_stat) === 'potvrđeno' || strtolower($r_stat) === 'potvrdjeno') {
                            $statusClass = 'status-active bg-success text-white';
                        } elseif ($isCancelled) {
                            $statusClass = 'status-cancelled bg-danger text-white';
                        }

                        // Unapred pripremam HTML atribute da ne lomimo navodnike unutar dugmadi
                        $disabledAttribute = ($isTooLateToChange || $isCancelled) ? 'disabled' : '';
                        ?>
                        
                        <tr id="booking-row-<?php echo $r_id; ?>">
                            <td class="reservation-code fw-bold"><?php echo htmlspecialchars($r_code); ?></td>
                            <td class="reservation-court-name"><?php echo htmlspecialchars($c_name); ?></td>
                            
                            <td class="reservation-time-cell" data-datetime="<?php echo date('Y-m-d\TH:i', $bookingTime); ?>">
                                <?php echo $datum; ?> u <?php echo $vreme; ?>
                            </td>
                            <td class="reservation-duration-cell" data-duration="<?php echo $r_dur; ?>">
                                <?php echo htmlspecialchars($r_dur); ?> min
                            </td>
                            
                            <td class="status-cell">
                                <span class="badge rounded-pill <?php echo $statusClass; ?> px-3 py-2">
                                    <?php echo htmlspecialchars($r_stat); ?>
                                </span>
                            </td>
                            <td class="reservation-note text-muted">
                                <?php echo $r_note; ?>
                            </td>
                            <td>
                                <div class="action-btn-group">
                                    <button type="button" 
                                            class="action-btn edit-btn" 
                                            onclick="openEditModal('<?php echo $r_id; ?>')" 
                                            <?php echo $disabledAttribute; ?>>
                                        Izmeni
                                    </button>
                                    
                                    <button type="button" 
                                            class="action-btn cancel-btn" 
                                            onclick="cancelBooking('<?php echo $r_id; ?>')" 
                                            <?php echo $disabledAttribute; ?>>
                                        Otkaži
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</main>

<!-- BOOTSTRAP 5 MODAL ZA IZMENU REZERVACIJE -->
<div class="modal fade" id="edit-booking-modal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content booking-modal-content">
            <div class="modal-header booking-modal-header">
                <h5 class="modal-title" id="editModalLabel">Izmena Rezervacije</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit-booking-form">
                <div class="modal-body">
                    <input type="hidden" id="edit-booking-id" name="reservation_id">
                    
                    <div class="mb-3">
                        <label for="edit-date-time" class="form-label">Izaberite novi datum i vreme</label>
                        <input type="datetime-local" id="edit-date-time" name="reservation_datetime" class="form-control booking-modal-input" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit-duration" class="form-label">Trajanje termina</label>
                        <select id="edit-duration" name="duration_minute" class="form-select booking-modal-input" required>
                            <option value="30">30 minuta</option>
                            <option value="60">60 minuta</option>
                            <option value="90">90 minuta</option>
                            <option value="180">180 minuta</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer booking-modal-footer">
                    <button type="button" class="booking-modal-close-btn" data-bs-dismiss="modal">Zatvori</button>
                    <button type="submit" class="booking-modal-save-btn">Sačuvaj izmene</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'inc/footer.php';
?>