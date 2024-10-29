<?php
namespace NewbieTeam\App;

class Auth
{
    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function login($nama, $password)
    {
        $nama = $this->conn->real_escape_string($nama);
        $sql = "SELECT * FROM users WHERE nama='$nama'";
        $result = $this->conn->query($sql);

        // Periksa apakah fetch_assoc mengembalikan hasil atau null
        $user = $result->fetch_assoc();
        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                return $user; // Kembalikan data user jika berhasil login
            } else {
                return false; // Password salah
            }
        }

        return false; // Nama pengguna tidak ditemukan
    }
}
