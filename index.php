<?php
require_once 'inc/header.php';
?>

<section class="hero-section d-flex align-items-center text-white position-relative">
    <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100"></div>
    
    <div class="container position-relative z-1">
        <div class="row">
            <div class="col-md-7 col-lg-6 text-start">
                <h1 class="hero-title fw-bold mb-4">
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
                    <a href="#" class="sport-btn">Ponuda</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 mb-4">
            <div class="sport-card football-bg">
                <div class="sport-overlay">
                    <h3 class="sport-title">Fudbalski</h3>
                    <a href="#" class="sport-btn">Ponuda</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 mb-4">
            <div class="sport-card tennis-bg">
                <div class="sport-overlay">
                    <h3 class="sport-title">Teniski</h3>
                    <a href="#" class="sport-btn">Ponuda</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3 mb-4">
            <div class="sport-card padel-bg">
                <div class="sport-overlay">
                    <h3 class="sport-title">Padel</h3>
                    <a href="#" class="sport-btn">Ponuda</a>
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

<?php

?>
</body>
</html>