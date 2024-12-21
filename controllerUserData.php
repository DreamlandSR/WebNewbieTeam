<?php
session_start();
require "dbconfig.php"; // pastikan file ini berisi class Database dan method getConnection()

$email = "";
$nama = "";
$errors = array();

$db = new Database();
$conn = $db->getConnection();

// Jika pengguna mengklik tombol "continue" di form lupa password
if (isset($_POST['check-email'])) {
    $email = $_POST['email'];
    
    // Menggunakan prepared statement untuk menghindari SQL Injection
    $check_email = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($check_email);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        // Generate 6 digit kode reset password
        $code = rand(100000, 999999);
        
        // Update kode di database
        $update_code = "UPDATE users SET code = :code WHERE email = :email";
        $stmt = $conn->prepare($update_code);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':email', $email);
        
        if ($stmt->execute()) {
            // Mengirimkan email reset password
            $subject = "Password Reset Code";
            $message = "Your password reset code is $code";
            $sender = "From: smkn7jember@gmail.com";
            
            if (mail($email, $subject, $message, $sender)) {
                $_SESSION['info'] = "kita sudah mengirimkan kode OTP, silahkan cek emailmu sekarang - $email";
                $_SESSION['email'] = $email;
                header('Location: reset-code.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Something went wrong!";
        }
    } else {
        $errors['email'] = "This email address does not exist!";
    }
}

// Jika pengguna mengklik tombol "check reset otp"
if (isset($_POST['check-reset-otp'])) {
    $_SESSION['info'] = "";
    $otp_code = $_POST['otp'];

    // Menggunakan prepared statement untuk menghindari SQL Injection
    $check_code = "SELECT * FROM users WHERE code = :otp_code";
    $stmt = $conn->prepare($check_code);
    $stmt->bindParam(':otp_code', $otp_code);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $fetch_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $_SESSION['info'] = "Masukkan password baru anda";
        header('Location: new-password.php');
        exit();
    } else {
        $errors['otp-error'] = "You've entered an incorrect code!";
    }
}

// Jika pengguna mengklik tombol "change password"
if (isset($_POST['change-password'])) {
    $_SESSION['info'] = "";
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    
    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password not matched!";
    } else {
        $email = $_SESSION['email']; // Mendapatkan email dari session
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        
        // Menggunakan prepared statement untuk menghindari SQL Injection
        $update_pass = "UPDATE users SET code = 0, password = :password WHERE email = :email";
        $stmt = $conn->prepare($update_pass);
        $stmt->bindParam(':password', $encpass);
        $stmt->bindParam(':email', $email);
        
        if ($stmt->execute()) {
            $_SESSION['info'] = "Password kamu sudah berubah, kamu bisa login sekarang menggunakan password baru.";
            header('Location: password-changed.php');
        } else {
            $errors['db-error'] = "Failed to change your password!";
        }
    }
}

// Jika pengguna mengklik tombol "login now"
if (isset($_POST['login-now'])) {
    header('Location: login-user.php');
}
?>