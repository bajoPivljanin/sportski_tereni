<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once '../app/config/db_config.php';
require_once '../app/classes/User.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->email)) {
    $userObj = new User($pdo);
    $token = $userObj->generatePasswordResetToken($data->email);

    if ($token) {
        $resetLink = "http://localhost:84/sportski_tereni/reset-password.php?token=" . $token;

        // Pozivamo metodu za slanje maila direktno iz User klase
        $isSent = $userObj->sendPasswordResetEmail($data->email, $resetLink);

        if ($isSent) {
            http_response_code(200);
            echo json_encode(["message" => "Link za resetovanje lozinke je poslat na vaš email."]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Greška pri slanju emaila. Molimo pokušajte kasnije."]);
        }
    } else {
        http_response_code(200);
        echo json_encode(["message" => "Ako adresa postoji u našoj bazi, dobićete email sa linkom."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Molimo unesite email adresu."]);
}
?>