<?php namespace Tests;

use PHPUnit\Framework\TestCase;
use NewbieTeam\App\Auth;

class AuthTest extends TestCase {
    protected $auth;
    protected $conn;

    protected function setUp(): void {
        // Membuat Mock dari mysqli
        $this->conn = $this->createMock(\mysqli::class);
        $this->auth = new Auth($this->conn);
    }

    public function testLoginWithValidCredentials() {
        // Data pengguna valid
        $user = [
            'nama' => 'joko',
            'password' => password_hash('12345', PASSWORD_DEFAULT),
            'sebagai' => 'admin'
        ];

        // Membuat mock dari mysqli_result
        $result = $this->createMock(\mysqli_result::class);
        
        // Mock metode fetch_assoc untuk mengembalikan data pengguna
        $result->method('fetch_assoc')->willReturn($user);

        // Mock koneksi
        $this->conn->method('query')->willReturn($result);

        // Jalankan tes
        $this->assertEquals($user, $this->auth->login('joko', '12345'));
    }

    public function testLoginWithInvalidPassword() {
        // Data pengguna valid
        $user = [
            'nama' => 'joko',
            'password' => password_hash('12345', PASSWORD_DEFAULT),
            'sebagai' => 'admin'
        ];

        // Membuat mock dari mysqli_result
        $result = $this->createMock(\mysqli_result::class);
        
        // Mock metode fetch_assoc untuk mengembalikan data pengguna
        $result->method('fetch_assoc')->willReturn($user);

        // Mock koneksi
        $this->conn->method('query')->willReturn($result);

        // Jalankan tes
        $this->assertFalse($this->auth->login('joko', 'wrongpassword'));
    }

    public function testLoginWithNonexistentUser() {
        // Membuat mock dari mysqli_result
        $result = $this->createMock(\mysqli_result::class);
        
        // Mock metode fetch_assoc untuk mengembalikan null, menandakan pengguna tidak ditemukan
        $result->method('fetch_assoc')->willReturn(null);

        // Mock koneksi
        $this->conn->method('query')->willReturn($result);

        // Jalankan tes
        $this->assertFalse($this->auth->login('notexist', '12345'));
    }
}
