<?php
class Court {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function getAllCourts() {
        $sql = "SELECT court_id, court_name, type, sport, initial_price FROM courts ORDER BY court_id ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCourtById($id) {
        $sql = "SELECT * FROM courts WHERE court_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>