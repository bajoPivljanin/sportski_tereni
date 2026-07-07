<?php
require_once '../app/config/db_config.php';
require_once '../app/classes/User.php';

if (isset($_GET['token']) && !empty($_GET['token'])) {
    $token = trim($_GET['token']);
    $user = new User($pdo);

    $verificationResult = $user->verifyEmail($token);

    if ($verificationResult === 'success') {
        $status = 'success';
        $title = 'Nalog aktiviran!';
        $message = 'Vaš nalog je uspešno aktiviran. Sada se možete prijaviti na sistem i rezervisati terene.';
    } elseif ($verificationResult === 'already_active') {
        $status = 'success';
        $title = 'Nalog je već aktiviran';
        $message = 'Vaš nalog je već ranije uspešno aktiviran. Možete se prijaviti.';
    } else {
        $status = 'error';
        $title = 'Greška pri aktivaciji';
        $message = 'Ovaj link za aktivaciju je nevažeći.';
    }
} else {
    $status = 'error';
    $title = 'Nedostaje token';
    $message = 'Pristup ovoj stranici nije validan. Nije prosleđen aktivacioni token.';
}
?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivacija naloga</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .message-box {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h1 {
            color: <?php echo $status === 'success' ? '#28a745' : '#dc3545'; ?>;
            margin-bottom: 20px;
        }
        p {
            color: #555;
            line-height: 1.5;
            margin-bottom: 30px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="message-box">
    <h1><?php echo $title; ?></h1>
    <p><?php echo $message; ?></p>
    <a href="../index.php" class="btn">Vrati se na početnu</a>
</div>
</body>
</html>