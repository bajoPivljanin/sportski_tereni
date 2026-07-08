<?php
require_once 'inc/header.php';
?>
<!--
pisi ovde html kod za prikaz JEDNOG terena kao neke informacije o terenu
samo napravi izgled sa random podacima o terenu i nazivu
neka fora da bude kao detaljan prikaz jednog proizvoda ono tako o terenu i da ima dugme rezervisi

samo kreni da pises body od htmla bez body taga jer je on vec u headeru
css pisi u style css
js pisi u script js

ako poseban js oces da ukljucis ukljuci ga u footer
ako poseban css oces da ukljucis ukljuci ga u header
-->


<main class="court-detail-section">
    <div class="container">
        <div class="row align-items-start">
            
            <div class="col-md-6 mb-4">
                <div class="court-image-box">
                    <img src="img/tenniscourt.jpg" alt="Premium Teniski Teren" class="court-display-img">
                </div>
            </div>

            <div class="col-md-6">
                <div class="court-info-box">
                    
                    <span class="court-badge">Premium</span>
                    <h1 class="court-main-title">Centralni Teniski Teren Premium</h1>
                    
                    <div class="court-price-tag">
                        <span class="court-price-amount">2.000 rsd</span>
                        <span class="court-price-unit">/ 60 min</span>
                    </div>

                    <p class="court-description">
                        Doživite igru na najvišem nivou na našem potpuno renoviranom centralnom teniskom terenu. 
                        Podloga je izrađena od vrhunske šljake koja smanjuje pritisak na zglobove i omogućava 
                        savršeno kretanje. Teren je opremljen profesionalnim LED osvetljenjem za noćne mečeve 
                        i nalazi se u mirnom delu kompleksa, izolovan od buke.
                    </p>

                    <div class="court-specification-box">
                        <h3 class="court-spec-heading">Karakteristike terena</h3>
                        <table class="court-spec-table">
                            <tr>
                                <th>Sport:</th>
                                <td>Tenis</td>
                            </tr>
                            <tr>
                                <th>Podloga:</th>
                                <td>Šljaka (Clay)</td>
                            </tr>
                            <tr>
                                <th>Rasveta:</th>
                                <td>Profesionalni LED reflektori</td>
                            </tr>
                            <tr>
                                <th>Dodatna oprema:</th>
                                <td>Mreža, klupe sa nadstrešnicom, svlačionica</td>
                            </tr>
                        </table>
                    </div>

                    <button type="button" id="book-court-btn" class="court-action-btn">
                        Rezerviši odmah termin
                    </button>

                </div>
            </div>

        </div>
    </div>
</main>


<?php
require_once 'inc/footer.php';
?>
