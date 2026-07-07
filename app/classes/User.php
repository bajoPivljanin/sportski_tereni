<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function register($first_name, $last_name, $email, $password, $phone_number) {
        try {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $token = bin2hex(random_bytes(32));

            $sql = "INSERT INTO users (first_name, last_name, email, password, phone_number, token, status, role) 
                    VALUES (:fname, :lname, :email, :pass, :phone, :token, 'na verifikaciji', 'user')";

            $stmt = $this->pdo->prepare($sql);
            $success = $stmt->execute([
                'fname' => $first_name,
                'lname' => $last_name,
                'email' => $email,
                'pass'  => $hashed_password,
                'phone' => $phone_number,
                'token' => $token
            ]);

            if ($success) {
                return $this->sendVerificationEmail($email, $first_name, $token);
            }

            return false;

        } catch (\PDOException $e) {
            return false;
        }
    }

    private function sendVerificationEmail($recipient_email, $first_name, $token) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'bajagaaa9@gmail.com';
            $mail->Password   = 'ysso klbx vlzo nexf';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom('bajagaaa9@gmail.com', 'Sportski Centar');
            $mail->addAddress($recipient_email, $first_name);

            $mail->isHTML(true);
            $mail->Subject = 'Aktivacija naloga - Sportski Centar';

            $activation_link = "http://localhost:84/sportski_tereni/api/verify.php?token=" . $token;

            $mail->Body = "
                <h3>Pozdrav {$first_name},</h3>
                <p>Hvala ti na registraciji u naš Sportski Centar!</p>
                <p>Da bi tvoj nalog postao aktivan i kako bi mogao da rezervišeš terene, molimo te da klikneš na dugme ispod:</p>
                <br>
                <a href='{$activation_link}' style='padding: 10px 15px; background-color: #28a745; color: #ffffff; text-decoration: none; border-radius: 5px; display: inline-block;'>Aktiviraj Nalog</a>
                <br><br>
                <p>Ukoliko ovo dugme ne radi, prekopiraj sledeći link u svoj pretraživač:</p>
                <p><small>{$activation_link}</small></p>
            ";

            $mail->send();
            return true;

        } catch (Exception $e) {
            return false;
        }
    }

    public function login($email, $password) {
        try {
            $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                if ($user['status'] === 'blokiran') {
                    return 'blocked';
                }
                if ($user['status'] === 'na verifikaciji') {
                    return 'unverified';
                }

                return $user;
            }
            return false;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function verifyEmail($token) {
        try {
            $sql = "SELECT * FROM users WHERE token = :token LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['token' => $token]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($user) {
                if ($user['status'] === 'aktivan') {
                    return 'already_active';
                }

                $updateSql = "UPDATE users SET status = 'aktivan' WHERE token = :token";
                $updateStmt = $this->pdo->prepare($updateSql);

                if ($updateStmt->execute(['token' => $token])) {
                    return 'success';
                }
            }
            return false;
        } catch (\PDOException $e) {
            return false;
        }
    }
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        return true;
    }
}
?>