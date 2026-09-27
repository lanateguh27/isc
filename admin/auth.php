<?php
session_start();
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Ambil user berdasarkan email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            /** * CATATAN: Karena ini Tugas Akhir, pastikan password di DB sudah di-hash.
             * Jika di DB masih teks biasa, gunakan: if ($password == $user['password'])
             * Jika sudah pakai hash (rekomendasi), gunakan: if (password_verify($password, $user['password']))
             */
            if ($password == $user['password']) {
                // Login Berhasil
                $_SESSION['admin_logged_in'] = true; // WAJIB TAMBAH INI
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_name'] = $user['name'];
                $_SESSION['last_activity'] = time(); // Tambah ini untuk fitur timeout
                
                header("Location: index.php");
                exit();
            } else {
                echo "<script>alert('Password Salah!'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Email tidak terdaftar!'); window.history.back();</script>";
        }

    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}