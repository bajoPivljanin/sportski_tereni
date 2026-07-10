<?php
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
}