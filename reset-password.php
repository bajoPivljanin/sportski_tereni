<?php
require_once 'inc/header.php';
require_once 'app/config/db_config.php';
require_once 'app/classes/User.php';

$message = "";
$isValidToken = false;

// Proveravamo da li je URL proslenjen token
if (isset($_GET['token']) && !empty($_GET['token'])) {
    $token = $_GET['token'];

    // Provera da li token postoji i da li je istekao
    $stmt = $pdo->prepare("SELECT email FROM users WHERE reset_token = :token AND reset_token_expire > NOW() LIMIT 1");
    $stmt->execute(['token' => $token]);

    if ($stmt->rowCount() > 0) {
        $isValidToken = true;
    } else {
        $message = "Link za resetovanje je nevažeći ili je istekao. Pokušajte ponovo.";
    }
} else {
    header("Location: index.php");
    exit;
}

// Obrada forme za novu lozinku
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_password'])) {
    $newPassword = $_POST['new_password'];

    // Validacija lozinke (minimum 8 karaktera, jedno veliko slovo, jedan broj)
    if (preg_match('/^(?=.*\d)(?=.*[A-Z]).{8,}$/', $newPassword)) {
        $userObj = new User($pdo);
        if ($userObj->resetPassword($token, $newPassword)) {
            $message = "Lozinka je uspešno promenjena! Sada možete da se prijavite.";
            $isValidToken = false; // Sakrivamo formu nakon uspeha
        } else {
            $message = "Došlo je do greške prilikom promene lozinke.";
        }
    } else {
        $message = "Lozinka mora imati najmanje 8 karaktera, jedno veliko slovo i jedan broj.";
    }
}
?>

    <main class="container my-5" style="padding-top: 50px;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4 text-success">Resetovanje lozinke</h2>

                <?php if (!empty($message)): ?>
                    <div class="alert alert-info text-center"><?php echo $message; ?></div>
                <?php endif; ?>

                <?php if ($isValidToken): ?>
                    <div class="card p-4 shadow-sm border-0" style="border-radius: 16px;">
                        <form action="reset-password.php?token=<?php echo htmlspecialchars($token); ?>" method="POST">
                            <div class="form-group mb-3">
                                <label for="new_password" class="form-label">Unesite novu lozinku:</label>
                                <input type="password" id="new_password" name="new_password" class="form-control" required placeholder="Nova lozinka">
                                <small class="text-muted">Minimum 8 karaktera, 1 veliko slovo, 1 broj.</small>
                            </div>
                            <button type="submit" class="btn w-100" style="background-color: #1b4332; color: white;">Sačuvaj novu lozinku</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

<?php require_once 'inc/footer.php'; ?>