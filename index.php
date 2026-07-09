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

    <div id="login-overlay" class="login-overlay">
        <div class="login-modal-box">
            <div class="login-modal-header">
                <h2 class="login-form-title">Prijavi se</h2>
                <button type="button" id="login-close" class="login-close-btn">&times;</button>
            </div>

            <div class="login-modal-body">
                <form id="login-form" class="login-form">

                    <div id="login-error-message" class="alert alert-danger" style="display: none; font-size: 14px; padding: 10px;"></div>

                    <div class="form-group mb-3">
                        <label for="login-email" class="form-label">Email adresa</label>
                        <input placeholder="Unesite E-mail..." type="email" id="login-email" name="email" class="form-control login-input" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="login-password" class="form-label">Lozinka</label>
                        <input placeholder="Unesite lozinku..." type="password" id="login-password" name="password" class="form-control login-input" required>
                    </div>

                    <div class="form-group mb-4 text-end">
                        <a href="#" id="forgot-password-trigger" class="forgot-password-link">Zaboravili ste lozinku?</a>
                    </div>

                    <button type="submit" class="login-submit-btn">Prijavi se</button>
                </form>
            </div>
        </div>
    </div>

    <div id="register-overlay" class="register-overlay">
        <div class="register-modal-box">
            <div class="register-modal-header">
                <h2 class="register-form-title">Kreiraj nalog</h2>
                <button type="button" id="register-close" class="register-close-btn">&times;</button>
            </div>

            <div class="register-modal-body">
                <form action="" method="POST" class="register-form">

                    <div class="form-group mb-3">
                        <label for="first-name" class="form-label">Ime</label>
                        <input placeholder="Unesite ime..." type="text" id="first-name" name="first_name" class="form-control register-input" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="last-name" class="form-label">Prezime</label>
                        <input placeholder="Unesite prezime..." type="text" id="last-name" name="last_name" class="form-control register-input" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email adresa</label>
                        <input placeholder="Unesite E-mail..." type="email" id="email" name="email" class="form-control register-input" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone" class="form-label">Telefon</label>
                        <input placeholder="Unesite broj telefona..." type="tel" id="phone" name="phone" class="form-control register-input" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="password" class="form-label">Lozinka</label>
                        <input placeholder="Unesite lozinku..." type="password" id="password" name="password" class="form-control register-input" required>
                    </div>

                    <button type="submit" class="register-submit-btn">Registruj se</button>
                </form>
            </div>
        </div>
    </div>

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