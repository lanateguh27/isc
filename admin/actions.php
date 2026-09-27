<?php
require_once '../config.php';

// Setujui Pendaftaran
if (isset($_GET['approve'])) {
    $id = $_GET['approve'];
    $stmt = $pdo->prepare("UPDATE registrations SET apply = 'Verified' WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: index.php?status=approved#unapproved");
    exit();
}

// Hapus Pendaftaran (Beserta Filenya)
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // Ambil info file untuk dihapus secara fisik
    $stmtFile = $pdo->prepare("SELECT abstract_file, payment_receipt FROM registrations WHERE id = ?");
    $stmtFile->execute([$id]);
    $files = $stmtFile->fetch();

    if ($files) {
        @unlink("../uploads/abstracts/" . $files['abstract_file']);
        @unlink("../uploads/receipts/" . $files['payment_receipt']);
    }

    $stmt = $pdo->prepare("DELETE FROM registrations WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: index.php?status=deleted");
    exit();
}