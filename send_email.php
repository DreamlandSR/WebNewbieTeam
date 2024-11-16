<?php
// Sertakan autoload PHPMailer (jika menggunakan composer)
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Jika Anda menggunakan Composer
// Atau gunakan require_once untuk menyertakan PHPMailer jika Anda mendownload secara manual

$mail = new PHPMailer(true);

try {
    // Set pengaturan untuk SMTP
    $mail->isSMTP(); // Menyatakan bahwa Anda akan menggunakan SMTP
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'youremail@gmail.com';  // Email Anda
    $mail->Password = 'yourpassword';         // App Password jika menggunakan 2FA
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Pengaturan pengirim dan penerima
    $mail->setFrom('youremail@gmail.com', 'Your Name'); // Ganti dengan email pengirim Anda
    $mail->addAddress('recipient@example.com', 'Recipient Name'); // Ganti dengan email penerima
    $mail->addReplyTo('youremail@gmail.com', 'Your Name'); // Email balasan (optional)

    // Konten email
    $mail->isHTML(true); // Mengirim email sebagai HTML
    $mail->Subject = 'Test Email via Gmail SMTP';
    $mail->Body    = 'This is a test email sent using Gmail SMTP via PHPMailer.';
    $mail->AltBody = 'This is the plain text version of the email body for non-HTML email clients.';

    // Kirim email
    $mail->send();
    echo 'Email telah dikirim.';
} catch (Exception $e) {
    echo "Email gagal dikirim. Mailer Error: {$mail->ErrorInfo}";
}
?>
