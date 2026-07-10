<?php
$transparentNav = true;
require_once 'inc/header.php';
?>

    <section class="hero-section">
    <div class="hero-overlay"></div>

    <div class="container hero-container">
        <div class="row">
            <div class="col-md-7 col-lg-6">
                <h1 class="hero-title">
                    Rezerviši teren<br>za par sekundi.
                </h1>
                <a href="#courts" class="hero-btn">Pogledaj ponudu</a>
            </div>
        </div>
    </div>
</section>

    <main id="courts" class="container my-5">
        <section class="offer-section">
            <h2 class="offer-heading">Ponuda terena</h2>
            <p class="offer-subheading">Izaberi sport i pronađi idealan teren za igru.</p>

            <div class="row">
                <div class="col-sm-6 col-md-3 mb-4">
                    <div class="sport-card basketball-bg">
                        <div class="sport-overlay">
                            <h3 class="sport-title">Košarkaški</h3>
                            <a href="courts.php" class="sport-btn">Ponuda</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3 mb-4">
                    <div class="sport-card football-bg">
                        <div class="sport-overlay">
                            <h3 class="sport-title">Fudbalski</h3>
                            <a href="courts.php" class="sport-btn">Ponuda</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3 mb-4">
                    <div class="sport-card tennis-bg">
                        <div class="sport-overlay">
                            <h3 class="sport-title">Teniski</h3>
                            <a href="courts.php" class="sport-btn">Ponuda</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3 mb-4">
                    <div class="sport-card padel-bg">
                        <div class="sport-overlay">
                            <h3 class="sport-title">Padel</h3>
                            <a href="courts.php" class="sport-btn">Ponuda</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section class="guide-section">
        <div class="container">

            <h2 class="guide-heading">
                <span class="guide-icon">?</span> Kako rezervisati teren
            </h2>

            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="guide-step">
                        <h3 class="guide-step-title">1. Izaberite teren</h3>
                        <p class="guide-step-text">
                            Posetite stranicu Tereni gde možete pregledati sve dostupne opcije. Istražite različite sportove i tipove terena kako biste pronašli onaj koji najbolje odgovara vašim potrebama i preferencijama.
                        </p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="guide-step">
                        <h3 class="guide-step-title">2. Odaberite termin</h3>
                        <p class="guide-step-text">
                            Kada izaberete željeni teren, prikazaće vam se lista dostupnih termina. Odaberite datum i vreme koji vam najviše odgovaraju i uklapaju se u vaš raspored.
                        </p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="guide-step">
                        <h3 class="guide-step-title">3. Potvrdite rezervaciju</h3>
                        <p class="guide-step-text">
                            Nakon izbora termina, potrebno je samo da potvrdite rezervaciju. Proces je brz i jednostavan, a vaš termin će biti odmah rezervisan bez dodatnog čekanja.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <main class="container my-5">
    <section class="pricing-section">
        
        <h2 class="pricing-heading">Cenovnik iznajmljivanja</h2>
        <div class="pricing-underline"></div>

        <ul class="nav nav-tabs pricing-tabs justify-content-center" id="pricingTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link pricing-tab-btn" id="min30-tab" data-bs-toggle="tab" data-bs-target="#min30" type="button" role="tab" aria-controls="min30" aria-selected="false">30 minuta</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link pricing-tab-btn active" id="min60-tab" data-bs-toggle="tab" data-bs-target="#min60" type="button" role="tab" aria-controls="min60" aria-selected="true">60 minuta</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link pricing-tab-btn" id="min90-tab" data-bs-toggle="tab" data-bs-target="#min90" type="button" role="tab" aria-controls="min90" aria-selected="false">90 minuta</button>
            </li>
        </ul>

        <div class="tab-content pricing-content" id="pricingTabContent">
            
            <div class="tab-pane fade" id="min30" role="tabpanel" aria-labelledby="min30-tab">
                <div class="row">
                    <div class="col-sm-6 col-md-3 mb-4">
                        <div class="price-card">
                            <h3 class="price-card-title">Fudbalski teren</h3>
                            <p class="price-card-amount">4.500 rsd</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mb-4">
                        <div class="price-card">
                            <h3 class="price-card-title">Košarkaški teren</h3>
                            <p class="price-card-amount">2.500 rsd</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mb-4">
                        <div class="price-card">
                            <h3 class="price-card-title">Teniski teren</h3>
                            <p class="price-card-amount">1.200 rsd</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mb-4">
                        <div class="price-card">
                            <h3 class="price-card-title">Padel teren</h3>
                            <p class="price-card-amount">900 rsd</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show active" id="min60" role="tabpanel" aria-labelledby="min60-tab">
                <div class="row">
                    <div class="col-sm-6 col-md-3 mb-4">
                        <div class="price-card">
                            <h3 class="price-card-title">Fudbalski teren</h3>
                            <p class="price-card-amount">9.000 rsd</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mb-4">
                        <div class="price-card">
                            <h3 class="price-card-title">Košarkaški teren</h3>
                            <p class="price-card-amount">5.000 rsd</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mb-4">
                        <div class="price-card">
                            <h3 class="price-card-title">Teniski teren</h3>
                            <p class="price-card-amount">2.000 rsd</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mb-4">
                        <div class="price-card">
                            <h3 class="price-card-title">Padel teren</h3>
                            <p class="price-card-amount">1.500 rsd</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="min90" role="tabpanel" aria-labelledby="min90-tab">
                <div class="row">
                    <div class="col-sm-6 col-md-3 mb-4">
                        <div class="price-card">
                            <h3 class="price-card-title">Fudbalski teren</h3>
                            <p class="price-card-amount">13.000 rsd</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mb-4">
                        <div class="price-card">
                            <h3 class="price-card-title">Košarkaški teren</h3>
                            <p class="price-card-amount">7.000 rsd</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mb-4">
                        <div class="price-card">
                            <h3 class="price-card-title">Teniski teren</h3>
                            <p class="price-card-amount">2.800 rsd</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 mb-4">
                        <div class="price-card">
                            <h3 class="price-card-title">Padel teren</h3>
                            <p class="price-card-amount">2.100 rsd</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>

<?php
require_once 'inc/footer.php';
?>