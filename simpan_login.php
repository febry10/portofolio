<?php
session_start();
include 'config.php'; // file config koneksi database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk cek admin berdasarkan username
    $query = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();

        // Verifikasi password (asumsi password sudah di-hash di DB)
        if (password_verify($password, $admin['password'])) {
            // Login berhasil, set session
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $admin['username'];

            header("Location: lihat_masukan.php");
            exit;
        } else {
            // Password salah
            echo "Username atau password salah.";
        }
    } else {
        // Username tidak ditemukan
        echo "Username atau password salah.";
    }
} else {
    header("Location: login.php");
    exit;
}
?>
