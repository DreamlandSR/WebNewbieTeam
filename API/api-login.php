<?php

include 'koneksi.php';

$nama = isset($_GET['nama']) ? $_GET['nama'] : '';
$password = isset($_GET['password']) ? $_GET['password'] : '';

if (!empty($nama) && !empty($password)) {
    // Use a prepared statement to prevent SQL injection
    $stmt = $koneksi->prepare("SELECT * FROM users WHERE nama = ?");
    $stmt->bind_param("s", $nama); // "s" for string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password with the hashed password in the database
        if (password_verify($password, $user['password'])) {
            // Check if 'role_user' column exists and is not empty
            if (isset($user['role_user']) && !empty($user['role_user'])) {
                $response = array(
                    'message' => 'Selamat Datang',
                    'role' => $user['role_user']
                );
            } else {
                $response = array(
                    'message' => 'Login Gagal - Kolom role kosong',
                    'role' => null
                );
            }
        } else {
            // Password doesn't match
            $response = array(
                'message' => 'Login Gagal - Password salah',
                'role' => null
            );
        }
    } else {
        $response = array(
            'message' => 'Login Gagal - Pengguna tidak ditemukan',
            'role' => null
        );
    }

    $stmt->close();
} else {
    $response = array(
        'message' => 'Ada data yang kosong',
        'role' => null
    );
}

$koneksi->close();
echo json_encode($response);
