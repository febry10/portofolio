<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Kalau belum login, redirect ke halaman login
    header("Location: login.php");
    exit;
}

// Jika sudah login, langsung arahkan ke lihat_masukan.php
header("Location: lihat_masukan.php");
exit;
?>
