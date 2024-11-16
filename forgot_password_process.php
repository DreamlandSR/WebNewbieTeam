<?php
// Menghubungkan ke database
include 'dbconfig.php';  // Pastikan file dbconfig.php sudah ada dan berfungsi dengan benar
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Jika menggunakan Composer

$db = new Database();
$conn = $db->getConnection();


// Ambil email dari formulir
$email = $_POST['email'];

// Validasi email
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Periksa apakah email ada di database
    // Periksa apakah email ada di database
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    // Buat token unik
    $token = bin2hex(random_bytes(50));

    // Simpan token di database
    $expireTime = date("Y-m-d H:i:s", strtotime('+1 hour')); // Token berlaku 1 jam
    $updateQuery = "UPDATE users SET reset_token = :token, reset_token_expire = :expireTime WHERE email = :email";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bindParam(':token', $token);
    $stmt->bindParam(':expireTime', $expireTime);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    


        // Kirim email dengan link reset password
        $resetLink = "http://localhost/reset_password.php?token=$token";

        // Setup email
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP(); // Menyatakan bahwa Anda akan menggunakan SMTP
            $mail->Host = 'smtp.gmail.com'; // Alamat server SMTP Gmail
            $mail->SMTPAuth = true; // Mengaktifkan autentikasi SMTP
            $mail->Username = 'youremail@gmail.com'; // Email Gmail Anda
            $mail->Password = 'yourpassword'; // Password Gmail Anda (gunakan App Password jika 2FA diaktifkan)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Keamanan koneksi TLS
            $mail->Port = 587; // Port untuk SMTP Gmail (587 untuk TLS)

            // Pengaturan pengirim dan penerima
            $mail->setFrom('youremail@gmail.com', 'Your Name');
            $mail->addAddress($email); // Pengguna yang meminta reset
            $mail->addReplyTo('youremail@gmail.com', 'Your Name'); // Email balasan (optional)

            // Konten email
            $mail->isHTML(true);
            $mail->Subject = 'Reset Password Anda';
            $mail->Body = "Klik link berikut untuk mereset password Anda: <a href=\"$resetLink\">$resetLink</a>";
            $mail->AltBody = "Klik link berikut untuk mereset password Anda: $resetLink";

            // Kirim email
            $mail->send();
            echo "Silakan cek email Anda untuk mereset password.";
        } catch (Exception $e) {
            echo "Gagal mengirim email. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Email tidak ditemukan.";
    }
} else {
    echo "Email tidak valid.";
}
?>
