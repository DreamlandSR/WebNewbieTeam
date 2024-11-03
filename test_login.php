<?php
// Hash password yang ada di database
$hashPassword = '$2y$10$OnlP2cj.fKrNGGgtVvt4iODTT62wxbdulq7HHVk.DwNvfcpXOfHPa'; // Ganti dengan hash dari database Anda

// Password yang ingin diuji
$inputPassword = '222222'; // Ganti dengan password yang ingin Anda uji

// Menggunakan password_verify untuk memeriksa apakah password sesuai dengan hash
if (password_verify($inputPassword, $hashPassword)) {
    echo "Password benar!";
} else {
    echo "Password salah!";
}
?>
