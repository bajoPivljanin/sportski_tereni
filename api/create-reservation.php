<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../app/config/db_config.php';
require_once '../app/classes/Reservation.php';
require_once '../app/classes/Court.php';
require_once '../app/classes/User.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["message" => "Morate biti prijavljeni da biste rezervisali termin."]);
    exit();
}

$data = json_decode(file_get_contents("php://input"));

if (empty($data->court_id) || empty($data->date) || empty($data->time) || empty($data->duration)) {
    http_response_code(400);
    echo json_encode(["message" => "Nepotpuni podaci. Sva polja su obavezna."]);
    exit();
}

$allowedDurations = [30, 60, 90, 180];
$duration = (int) $data->duration;

if (!in_array($duration, $allowedDurations, true)) {
    http_response_code(400);
    echo json_encode(["message" => "Nevažeće trajanje termina."]);
    exit();
}

$startDate = \DateTime::createFromFormat('Y-m-d H:i', $data->date . ' ' . $data->time);

if (!$startDate) {
    http_response_code(400);
    echo json_encode(["message" => "Nevažeći datum ili vreme."]);
    exit();
}

if ($startDate <= new \DateTime()) {
    http_response_code(400);
    echo json_encode(["message" => "Termin mora biti u budućnosti."]);
    exit();
}

$endDate = (clone $startDate)->modify("+{$duration} minutes");
$openingTime = (clone $startDate)->setTime(8, 0);
$closingTime = (clone $startDate)->setTime(23, 0);

if ($startDate < $openingTime || $endDate > $closingTime) {
    http_response_code(400);
    echo json_encode(["message" => "Rezervacije su moguće samo u periodu od 08:00 do 23:00."]);
    exit();
}

$courtObj = new Court($pdo);
$court = $courtObj->getCourtById((int) $data->court_id);

if (!$court) {
    http_response_code(404);
    echo json_encode(["message" => "Traženi teren ne postoji."]);
    exit();
}

$userObj = new User($pdo);
$user = $userObj->getUserById($_SESSION['user_id']);

if (!$user || $user['status'] === 'blokiran') {
    http_response_code(403);
    echo json_encode(["message" => "Vaš nalog je blokiran i ne može vršiti rezervacije."]);
    exit();
}

$reservationObj = new Reservation($pdo);
$startDatetime = $startDate->format('Y-m-d H:i:s');

if ($reservationObj->hasOverlap((int) $data->court_id, $startDatetime, $duration)) {
    http_response_code(409);
    echo json_encode(["message" => "Izabrani termin je već zauzet. Molimo izaberite drugi termin."]);
    exit();
}

$reservationCode = $reservationObj->createReservation((int) $data->court_id, $_SESSION['user_id'], $startDatetime, $duration);

if (!$reservationCode) {
    http_response_code(503);
    echo json_encode(["message" => "Greška prilikom kreiranja rezervacije. Pokušajte ponovo."]);
    exit();
}

$reservationObj->sendConfirmationEmail(
    $user['email'],
    $user['first_name'],
    $reservationCode,
    $court['court_name'],
    $startDatetime,
    $duration
);

http_response_code(201);
echo json_encode([
    "message" => "Rezervacija je uspešno kreirana i čeka potvrdu. Kod rezervacije je poslat na vaš email.",
    "reservation_code" => $reservationCode
]);
?>