<?php
require_once 'inc/header.php';
?>

<main class="profile-section">
    <div class="container">
        
        <div class="profile-header">
            <h1 class="profile-title">Moj Profil</h1>
            <p class="profile-subtitle">Upravljajte svojim ličnim podacima i podešavanjima naloga</p>
        </div>

        <div class="row spec-row">
            <div class="col-md-6 mb-4">
                <div class="profile-card">
                    <h2 class="profile-card-title">Lični podaci</h2>
                    
                    <div id="personal-alert-box"></div>

                    <form id="personal-info-form" action="#" method="POST">
                        <div class="form-group mb-3">
                            <label for="profile-first-name" class="form-label">Ime</label>
                            <input type="text" id="profile-first-name" name="first_name" class="form-control profile-input" value="<?php echo htmlspecialchars($_SESSION['first_name'] ?? 'Ime'); ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="profile-last-name" class="form-label">Prezime</label>
                            <input type="text" id="profile-last-name" name="last_name" class="form-control profile-input" value="<?php echo htmlspecialchars($_SESSION['last_name'] ?? 'Prezime'); ?>"  required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="profile-phone" class="form-label">Broj Telefona</label>
                            <input type="tel" id="profile-phone" name="phone_number" class="form-control profile-input" value="<?php echo htmlspecialchars($_SESSION['phone_number'] ?? '069 555 333'); ?>" required>
                        </div>

                        <button type="submit" class="profile-save-btn">Sacuvaj</button>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="profile-card">
                    <h2 class="profile-card-title">Promeni Sifru</h2>
                    
                    <div id="password-alert-box"></div>

                    <form id="security-password-form" action="#" method="POST">
                        <div class="form-group mb-3">
                            <label for="current-password" class="form-label">Trenutna Sifra</label>
                            <input type="password" id="current-password" name="current_password" class="form-control profile-input" placeholder="••••••••" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="new-password" class="form-label">Nova Sifra</label>
                            <input type="password" id="new-password" name="new_password" class="form-control profile-input" placeholder="Minimum 8 characters" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="confirm-password" class="form-label">Potvrdi Novu Sifru</label>
                            <input type="password" id="confirm-password" name="confirm_password" class="form-control profile-input" placeholder="Repeat new password" required>
                        </div>

                        <button type="submit" class="profile-save-btn">Promeni Sifru</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</main>

<?php
require_once 'inc/footer.php';
?>