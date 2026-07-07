<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../app/config/db_config.php';
require_once '../app/classes/User.php';

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->first_name) &&
    !empty($data->last_name) &&
    !empty($data->email) &&
    !empty($data->phone_number) &&
    !empty($data->password)
) {
    if (!preg_match('/^(?=.*\d)(?=.*[A-Z]).{8,}$/', $data->password)) {
        http_response_code(400);
        echo json_encode(["message" => "Lozinka mora imati najmanje 8 karaktera, jedno veliko slovo i jedan broj."]);
        exit();
    }

    $user = new User($pdo);

    if($user->register($data->first_name, $data->last_name, $data->email, $data->password, $data->phone_number)) {
        http_response_code(201);
        echo json_encode(["message" => "Uspešna registracija. Proverite vaš email za aktivaciju."]);
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Greška prilikom registracije. Email je možda već u upotrebi ili mail server nije dostupan."]);
    }

} else {
    http_response_code(400);
    echo json_encode(["message" => "Nepotpuni podaci. Sva polja su obavezna."]);
}
?>