<?php
require_once 'inc/header.php';
require_once 'app/config/db_config.php';
require_once 'app/classes/Court.php';

$courtObj = new Court($pdo);
$courts = $courtObj->getAllCourts();

$sportSlika = [
        'Košarka' => 'basketball',
        'Fudbal'  => 'football',
        'Tenis'   => 'tennis',
        'Padel'   => 'padel'
];
?>

    <main class="courts-page-section">
        <div class="container">

            <div class="courts-intro">
                <h1 class="offer-heading">Svi tereni</h1>
                <p class="offer-subheading">Pregledajte kompletnu ponudu terena i izaberite onaj koji vam odgovara.</p>
            </div>

            <div class="courts-filter-bar">
                <button type="button" class="court-filter-btn active" data-filter="Svi">Svi</button>
                <button type="button" class="court-filter-btn" data-filter="Fudbal">Fudbal</button>
                <button type="button" class="court-filter-btn" data-filter="Košarka">Košarka</button>
                <button type="button" class="court-filter-btn" data-filter="Tenis">Tenis</button>
                <button type="button" class="court-filter-btn" data-filter="Padel">Padel</button>
            </div>

            <div class="row">
                <?php foreach ($courts as $court): ?>
                    <?php
                    $sport = $court['sport'];
                    $slikaFajl = isset($sportSlika[$sport]) ? $sportSlika[$sport] : 'default';
                    $putanjaSlike = "img/" . $slikaFajl . ".jpg";
                    ?>
                    <div class="col-sm-6 col-md-4 mb-4 court-item" data-sport="<?php echo htmlspecialchars($court['sport']); ?>">
                        <div class="court-card">
                            <div class="court-card-img-box">
                                <img src="<?php echo $putanjaSlike; ?>" alt="<?php echo htmlspecialchars($court['court_name']); ?>" class="court-card-img">
                                <span class="court-card-badge"><?php echo htmlspecialchars($court['sport']); ?></span>
                            </div>
                            <div class="court-card-body">
                                <h3 class="court-card-title"><?php echo htmlspecialchars($court['court_name']); ?></h3>

                                <p class="court-card-location"><?php echo htmlspecialchars($court['type']); ?> teren</p>

                                <div class="court-card-footer">
                            <span class="court-card-price">
                                <?php echo htmlspecialchars($court['initial_price']); ?> rsd
                                <span class="court-card-price-unit">/ 30 min</span>
                            </span>

                                    <a href="court.php?id=<?php echo $court['court_id']; ?>" class="court-card-btn">Detaljnije</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </main>

<?php
require_once 'inc/footer.php';
?>