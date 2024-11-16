<?php
// Menghubungkan ke database
include 'dbconfig.php'; // Pastikan file dbconfig.php sudah ada dan berfungsi dengan benar

// Ambil token dari URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Cek apakah token ada di database dan belum kedaluwarsa
    $query = "SELECT * FROM users WHERE reset_token = ? AND reset_token_expire > NOW()";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Token valid, tampilkan formulir reset password
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Proses reset password baru
            $newPassword = $_POST['password'];

            // Enkripsi password baru
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

            // Update password di database
            $updateQuery = "UPDATE users SET password = ?, reset_token = NULL, reset_token_expire = NULL WHERE reset_token = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("ss", $hashedPassword, $token);
            $stmt->execute();

            echo "Password berhasil direset!";
        }
    } else {
        echo "Token tidak valid atau sudah kedaluwarsa.";
    }
}
?>

<!-- Formulir untuk reset password -->
<form method="POST">
    <label for="password">Password Baru:</label>
    <input type="password" name="password" required>
    <button type="submit">Reset Password</button>
</form>
