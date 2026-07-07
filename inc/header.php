<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b50ec32212.js" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="as" href="index.php">TERENI</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="main-nav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Pocetna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="courts.php">Tereni</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Kontakt</a>
                </li>
            </ul>
            <div class="navbar-nav">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span class="nav-link text-white">Dobrodošli, <?php echo htmlspecialchars($_SESSION['first_name']); ?></span>
                    <a href="moje_rezervacije.php" class="nav-link">Moje rezervacije</a>
                    <a href="logout.php" class="nav-link text-danger">Odjavi se</a>
                <?php else: ?>
                    <a href="#" class="nav-link me-3" id="login-trigger">Prijavi se</a>
                    <a href="#" class="nav-link register-trigger" id="register-trigger">Registruj se</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>