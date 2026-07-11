<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Reservation
{
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function getUserReservations($userId) {
        $sql = "SELECT r.reservation_code, r.reservation_datetime, r.duration_minute, r.reservation_status, r.note, c.court_name
                FROM reservations r
                JOIN courts c ON r.court_id = c.court_id
                WHERE r.user_id = :user_id AND r.deleted_at IS NULL
                ORDER BY r.reservation_datetime DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function hasOverlap(int $courtId, string $startDatetime, int $durationMinute): bool {
        $start = new \DateTime($startDatetime);
        $end = (clone $start)->modify("+{$durationMinute} minutes");

        $sql = "SELECT COUNT(*) FROM reservations
                WHERE court_id = :court_id
                  AND deleted_at IS NULL
                  AND reservation_status != 'otkazano'
                  AND reservation_datetime < :end_time
                  AND DATE_ADD(reservation_datetime, INTERVAL duration_minute MINUTE) > :start_time";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'court_id' => $courtId,
            'end_time' => $end->format('Y-m-d H:i:s'),
            'start_time' => $start->format('Y-m-d H:i:s'),
        ]);

        return (int) $stmt->fetchColumn() > 0;
    }

    public function createReservation(int $courtId, int $userId, string $startDatetime, int $durationMinute) {
        $sql = "INSERT INTO reservations (court_id, user_id, reservation_code, duration_minute, reservation_status, player_status, reservation_datetime)
                VALUES (:court_id, :user_id, :code, :duration, 'na čekanju', 'nije evidentirano', :datetime)";
        $stmt = $this->pdo->prepare($sql);

        for ($attempt = 0; $attempt < 3; $attempt++) {
            $reservationCode = strtoupper(bin2hex(random_bytes(4)));
            try {
                $stmt->execute([
                    'court_id' => $courtId,
                    'user_id' => $userId,
                    'code' => $reservationCode,
                    'duration' => $durationMinute,
                    'datetime' => $startDatetime,
                ]);
                return $reservationCode;
            } catch (\PDOException $e) {
                if ($e->errorInfo[1] !== 1062) {
                    throw $e;
                }
            }
        }

        return false;
    }

    public function sendConfirmationEmail(string $recipientEmail, string $firstName, string $reservationCode, string $courtName, string $startDatetime, int $durationMinute): bool {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = Config::MAIL_USERNAME;
            $mail->Password   = Config::MAIL_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom(Config::MAIL_USERNAME, 'Sportski Tereni');
            $mail->addAddress($recipientEmail, $firstName);

            $mail->isHTML(true);
            $mail->Subject = 'Potvrda rezervacije - Sportski Tereni';

            $formattedDate = date('d.m.Y.', strtotime($startDatetime));
            $formattedTime = date('H:i', strtotime($startDatetime));

            $mail->Body = "
                <h3>Pozdrav {$firstName},</h3>
                <p>Vaša rezervacija je uspešno kreirana i čeka potvrdu zaposlenog.</p>
                <p>
                    <strong>Teren:</strong> {$courtName}<br>
                    <strong>Datum:</strong> {$formattedDate} u {$formattedTime}h<br>
                    <strong>Trajanje:</strong> {$durationMinute} min<br>
                    <strong>Kod rezervacije:</strong> {$reservationCode}
                </p>
                <p>Sačuvajte ovaj kod, on predstavlja vezu između vas i ove rezervacije.</p>
            ";

            $mail->AltBody = "Vaša rezervacija je kreirana.\nTeren: {$courtName}\nDatum: {$formattedDate} u {$formattedTime}h\nTrajanje: {$durationMinute} min\nKod rezervacije: {$reservationCode}";

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}