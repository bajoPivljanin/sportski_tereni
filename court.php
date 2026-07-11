<?php
require_once 'inc/header.php';
require_once 'app/config/db_config.php';
require_once 'app/classes/Court.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$courtObj = new Court($pdo);
$court = $courtObj->getCourtById($_GET['id']);

if (!$court) {
    echo "<div class='container my-5'><h2 class='text-center'>Traženi teren nije pronađen.</h2></div>";
    require_once 'inc/footer.php';
    exit;
}

$sportSlika = [
        'Košarka' => 'basketball',
        'Fudbal'  => 'football',
        'Tenis'   => 'tennis',
        'Padel'   => 'padel'
];

$sport = $court['sport'];
$slikaFajl = isset($sportSlika[$sport]) ? $sportSlika[$sport] : 'default';
$putanjaSlike = "img/" . $slikaFajl . ".jpg";
?>

    <main class="court-detail-section">
        <div class="container">
            <div class="row align-items-start">

                <div class="col-md-6 mb-4">
                    <div class="court-image-box">
                        <img src="<?php echo $putanjaSlike; ?>" alt="<?php echo htmlspecialchars($court['court_name']); ?>" class="court-display-img img-fluid">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="court-info-box ps-md-4">

                        <span class="court-badge mb-2"><?php echo htmlspecialchars($court['type']); ?> teren</span>
                        <h1 class="court-main-title mb-3"><?php echo htmlspecialchars($court['court_name']); ?></h1>

                        <div class="court-price-tag mb-4">
                            <span class="court-price-amount fs-3 fw-bold"><?php echo number_format($court['initial_price'], 0, ',', '.'); ?> rsd</span>
                            <span class="court-price-unit text-muted">/ 30 min</span>
                        </div>

                        <p class="court-description mb-4 text-secondary">
                            Rezervišite termin i uživajte u sportu na našem vrhunski opremljenom terenu.
                            Objekat pruža optimalne uslove za igru, bilo da igrate rekreativno ili profesionalno.
                        </p>

                        <div class="court-specification-box mb-4">
                            <h3 class="court-spec-heading h5 mb-3">Karakteristike terena</h3>
                            <table class="table table-bordered court-spec-table">
                                <tbody>
                                <tr>
                                    <th class="bg-light w-40">Sport:</th>
                                    <td><?php echo htmlspecialchars($court['sport']); ?></td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Tip objekta:</th>
                                    <td><?php echo htmlspecialchars($court['type']); ?></td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Oprema i dodaci:</th>
                                    <td><?php echo htmlspecialchars($court['equipment']); ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <button type="button" id="book-court-btn" class="btn btn-lg w-100 court-action-btn">
                            Rezerviši termin
                        </button>

                    </div>
                </div>

            </div>
        </div>
    </main>

<?php if (isset($_SESSION['user_id'])): ?>
    <div id="booking-overlay" class="booking-overlay">
        <div class="booking-modal-box">
            <div class="booking-modal-header">
                <h2 class="booking-form-title">Rezerviši termin</h2>
                <button type="button" id="booking-close" class="booking-close-btn">&times;</button>
            </div>

            <div class="booking-modal-body">
                <form id="booking-form" class="booking-form" data-court-id="<?php echo (int) $court['court_id']; ?>" data-initial-price="<?php echo (int) $court['initial_price']; ?>">

                    <div id="booking-message" class="alert" style="display: none; font-size: 14px; padding: 10px;"></div>

                    <div class="form-group mb-3">
                        <label for="booking-date" class="form-label">Datum</label>
                        <input type="date" id="booking-date" name="date" class="form-control login-input" min="<?php echo date('Y-m-d'); ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="booking-time" class="form-label">Vreme</label>
                        <input type="time" id="booking-time" name="time" class="form-control login-input" min="08:00" max="22:59" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="booking-duration" class="form-label">Trajanje</label>
                        <select id="booking-duration" name="duration" class="form-control login-input" required>
                            <option value="30">30 minuta</option>
                            <option value="60">60 minuta</option>
                            <option value="90">90 minuta</option>
                            <option value="180">180 minuta</option>
                        </select>
                    </div>

                    <p class="booking-price-preview">Ukupna cena: <strong id="booking-price-value"><?php echo number_format($court['initial_price'], 0, ',', '.'); ?> rsd</strong></p>

                    <button type="submit" id="booking-submit-btn" class="login-submit-btn">Potvrdi rezervaciju</button>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php
require_once 'inc/footer.php';
?>