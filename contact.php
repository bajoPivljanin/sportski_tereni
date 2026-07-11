<?php
require_once 'inc/header.php';
?>


<main class="contact-section">
    <div class="container">
        
        <div class="contact-header">
            <h1 class="contact-title">Kontaktiraj nas</h1>
            <p class="contact-subtitle">Imate pitanje ili želite da rezervišete turnir? Kontaktirajte naš tim.</p>
        </div>

        <div class="row spec-row">
            <div class="col-md-5 mb-4">
                <div class="contact-info-card">
                    
                    <div class="info-block">
                        <i class="fa-solid fa-location-dot info-icon"></i>
                        <div class="info-text-box">
                            <h3 class="info-heading">Nasa Adresa</h3>
                            <p class="info-detail">Tereni Ulica 12, 24000 Subotica, Srbija</p>
                        </div>
                    </div>

                    <div class="info-block">
                        <i class="fa-solid fa-phone info-icon"></i>
                        <div class="info-text-box">
                            <h3 class="info-heading">Broj Telefona</h3>
                            <p class="info-detail">+381 24 555 333</p>
                        </div>
                    </div>

                    <div class="info-block">
                        <i class="fa-solid fa-envelope info-icon"></i>
                        <div class="info-text-box">
                            <h3 class="info-heading">Email Adresa</h3>
                            <p class="info-detail">info@tereni.com</p>
                        </div>
                    </div>

                    <div class="info-block">
                        <i class="fa-solid fa-clock info-icon"></i>
                        <div class="info-text-box">
                            <h3 class="info-heading">Radni dani</h3>
                            <p class="info-detail">Pon - Ned: 08:00 - 23:00</p>
                        </div>
                    </div>

                </div>
            </div>


            <div class="col-md-7">
                <div class="contact-form-card">
                    <form id="contact-form" action="#" method="POST">
                        
                        <div class="form-group mb-3">
                            <label for="contact-name" class="form-label">Puno Ime</label>
                            <input type="text" id="contact-name" name="name" class="form-control contact-input" placeholder="Unesi svoje ime..." required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="contact-email" class="form-label">Email Adresa</label>
                            <input type="email" id="contact-email" name="email" class="form-control contact-input" placeholder="Unesi svoj email..." required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="contact-message" class="form-label">Vasa Poruka</label>
                            <textarea id="contact-message" name="message" class="form-control contact-input" rows="5" placeholder="Napisi svoju poruku ovde..." required></textarea>
                        </div>

                        <button type="submit" class="contact-submit-btn">Posalji poruku</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</main>


<?php
require_once 'inc/footer.php';
?>