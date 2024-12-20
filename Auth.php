<?php
require_once 'dbconfig.php';

class Auth {
    private $db;
    private $error;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        // session_start() seharusnya dipanggil di file login.php
    }

    public function login($nama, $password) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE nama = :nama");
            $stmt->bindParam(":nama", $nama);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && password_verify($password, $user['password'])) {
                // Set session utama
                $_SESSION['id'] = $user['id'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['role_user'] = $user['role_user'];
    
                // Jika role_user adalah 'guru', ambil id_guru
                if ($user['role_user'] === 'guru') {
                    $stmtGuru = $this->db->prepare("SELECT id_guru FROM guru WHERE id_user = :id_user");
                    $stmtGuru->bindParam(":id_user", $user['id']);
                    $stmtGuru->execute();
                    $guru = $stmtGuru->fetch(PDO::FETCH_ASSOC);
    
                    if ($guru) {
                        $_SESSION['id_guru'] = $guru['id_guru'];
                    }
                }
    
                // Jika role_user adalah 'siswa', ambil id_siswa
                if ($user['role_user'] === 'siswa') {
                    $stmtSiswa = $this->db->prepare("SELECT id_siswa FROM siswa WHERE id_user = :id_user");
                    $stmtSiswa->bindParam(":id_user", $user['id']);
                    $stmtSiswa->execute();
                    $siswa = $stmtSiswa->fetch(PDO::FETCH_ASSOC);
    
                    if ($siswa) {
                        $_SESSION['id_siswa'] = $siswa['id_siswa'];
                    }
                }
    
                return true;
            } else {
                $this->error = "Nama atau password salah";
                return false;
            }
        } catch (PDOException $e) {
            $this->error = "Error: " . $e->getMessage();
            return false;
        }
    }
    
    public function isLoggedIn() {
        return isset($_SESSION['id']);
    }
    
    public function getUserRole() {
        return isset($_SESSION['role_user']) ? $_SESSION['role_user'] : null;
    }

    public function getCurrentUser() {
        if ($this->isLoggedIn()) {
            try {
                $stmt = $this->db->prepare("SELECT id, nama, email, role_user FROM users WHERE id = :id");
                $stmt->bindParam(":id", $_SESSION['id']);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                $this->error = "Error: " . $e->getMessage();
                return false;
            }
        }
        return null; // Kembalikan null jika tidak ada sesi
    }

    public function logout() {
        // Hapus semua data sesi
        session_unset();
        session_destroy();
        return true;
    }

    public function getLastError() {
        return $this->error;
    }

    // Fungsi untuk memeriksa akses berdasarkan sebagai
    public function checkAccess($allowed_role = []) {
        if (!$this->isLoggedIn()) {
            return false;
        }

        $role = $this->getUserRole();
        return in_array($role, $allowed_role);
    }
    
// mengambil data admin

public function getUserAdmin() {
    if ($this->isLoggedIn()) {
        try {
            // Query untuk mengambil data admin berdasarkan ID
            $stmt = $this->db->prepare("SELECT id, nama, email, role_user, foto FROM admins WHERE id = :id");
            $stmt->bindParam(":id", $_SESSION['id']);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Mengembalikan data admin dalam bentuk array
        } catch(PDOException $e) {
            $this->error = "Error: " . $e->getMessage(); // Menangani error jika query gagal
            return false;
        }
    }
    return null; // Kembalikan null jika tidak ada sesi login
}


// mengambil data guru
public function getUserGuru() {
    if ($this->isLoggedIn()) {
        try {
            $stmt = $this->db->prepare("SELECT id_guru, nama, email, nip,  no_hp, foto FROM guru WHERE id_guru = :id_guru");
            $stmt->bindParam(":id_guru", $_SESSION['id_guru']);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            $this->error = "Error: " . $e->getMessage();
            return false;
        }
    }
    return null; 
}

//mengambil data siswa

public function getUserSiswa() {
    if ($this->isLoggedIn()) {
        try {
            $stmt = $this->db->prepare("SELECT id_siswa, nama, email, foto FROM siswa WHERE id_siswa = :id_siswa");
            $stmt->bindParam(":id_siswa", $_SESSION['id_siswa']);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            $this->error = "Error: " . $e->getMessage();
            return false;
        }
    }
    return null; // Kembalikan null jika tidak ada sesi
}

}

?>