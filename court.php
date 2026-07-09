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

<?php
require_once 'inc/footer.php';
?>