<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../app/config/db_config.php';
require_once '../app/classes/User.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->email) && !empty($data->password)) {

    $userObj = new User($pdo);
    $loginResult = $userObj->login($data->email, $data->password);

    if ($loginResult === 'blocked') {
        http_response_code(403);
        echo json_encode(["message" => "Vaš nalog je blokiran. Kontaktirajte administratora."]);
    } elseif ($loginResult === 'unverified') {
        http_response_code(401);
        echo json_encode(["message" => "Nalog nije aktiviran. Proverite email za aktivacioni link."]);
    } elseif (is_array($loginResult)) {
        $_SESSION['user_id'] = $loginResult['user_id'];
        $_SESSION['first_name'] = $loginResult['first_name'];
        $_SESSION['role'] = $loginResult['role'];

        http_response_code(200);
        echo json_encode(["message" => "Uspešna prijava."]);
    } else {
        http_response_code(401);
        echo json_encode(["message" => "Pogrešan email ili lozinka."]);
    }

} else {
    http_response_code(400);
    echo json_encode(["message" => "Molimo unesite email i lozinku."]);
}
?>