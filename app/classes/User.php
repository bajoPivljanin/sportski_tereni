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
    public function sendPasswordResetEmail($email, $resetLink) {
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

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->setFrom('bajagaaa9@gmail.com', 'Sportski Tereni');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Resetovanje lozinke - Sportski Tereni';

            $mail->Body    = "
                <h3>Zahtev za resetovanje lozinke</h3>
                <p>Poštovani,</p>
                <p>Dobili smo zahtev za promenu lozinke na vašem nalogu. Ako niste vi podneli ovaj zahtev, slobodno ignorišite ovu poruku.</p>
                <p>Da biste resetovali lozinku, kliknite na sledeći link (link važi 1 sat):</p>
                <p><a href='{$resetLink}' style='display: inline-block; padding: 10px 20px; color: white; background-color: #1b4332; text-decoration: none; border-radius: 5px;'>Resetuj lozinku</a></p>
                <br>
                <p>Ukoliko dugme ne radi, prekopirajte sledeći link u vaš pretraživač:</p>
                <p>{$resetLink}</p>
                <br>
                <p>Srdačan pozdrav,<br>Tim Sportski Tereni</p>
            ";

            $mail->AltBody = "Poštovani,\n\nDobili smo zahtev za promenu lozinke. Da biste resetovali lozinku, prekopirajte sledeći link u vaš pregledač:\n\n{$resetLink}\n\nLink važi 1 sat.\n\nSrdačan pozdrav,\nTim Sportski Tereni";

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    public function generatePasswordResetToken($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);

        if ($stmt->rowCount() === 0) {
            return false;
        }

        $token = bin2hex(random_bytes(32));
        // this token expires after 1 hour
        $expire = date("Y-m-d H:i:s", strtotime("+1 hour"));
        $sql = "UPDATE users SET reset_token = :token, reset_token_expire = :expire WHERE email = :email";
        $updateStmt = $this->pdo->prepare($sql);
        $updateStmt->execute(['token' => $token, 'expire' => $expire, 'email' => $email]);
        return $token;
    }
    public function resetPassword($token, $newPassword) {
        // find the user with this token and ensure the token hasnt expired
        $sql = "SELECT email FROM users WHERE reset_token = :token AND reset_token_expire > NOW() LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['token' => $token]);

        if ($stmt->rowCount() == 0) {
            return false; // Token is expired or isn't  available
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // update password and clear the tokent to prevent reuse
        $updateSql = "UPDATE users SET password = :password, reset_token = NULL, reset_token_expire = NULL WHERE email = :email";
        $updateStmt = $this->pdo->prepare($updateSql);

        return $updateStmt->execute([
            'password' => $hashedPassword,
            'email' => $row['email']
        ]);
    }
}