<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah ada "Kunci Utama" dari auth.php
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); 
    exit;
}

// Update waktu aktivitas (opsional untuk timeout)
$_SESSION['last_activity'] = time();
?>