    <?php if (!isset($_SESSION['user_id'])): ?>
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
    <div id="forgot-password-overlay" class="login-overlay">
        <div class="login-modal-box">
            <div class="login-modal-header">
                <h2 class="login-form-title">Reset lozinke</h2>
                <button type="button" id="forgot-password-close" class="login-close-btn">&times;</button>
            </div>

            <div class="login-modal-body">
                <form id="forgot-password-form" class="login-form">

                    <div id="forgot-password-message" class="alert" style="display: none; font-size: 14px; padding: 10px;"></div>

                    <p style="font-size: 14px; color: #555; margin-bottom: 20px; line-height: 1.5;">
                        Unesite email adresu vašeg naloga i poslaćemo vam link za resetovanje lozinke.
                    </p>

                    <div class="form-group mb-4">
                        <label for="forgot-email" class="form-label">Email adresa</label>
                        <input placeholder="Unesite E-mail..." type="email" id="forgot-email" name="email" class="form-control login-input" required>
                    </div>

                    <button type="submit" id="forgot-submit-btn" class="login-submit-btn">Pošalji link</button>

                    <div class="form-group mt-4 text-center">
                        <a href="#" id="back-to-login-trigger" class="forgot-password-link">Nazad na prijavu</a>
                    </div>
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
    <?php endif; ?>
