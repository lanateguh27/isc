<?php
require_once '../config.php';

// Nama file yang akan dihasilkan
$filename = "Data_Peserta_Verified_" . date('Ymd') . ".xls";

// Header untuk memaksa browser mendownload file sebagai Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");

// Ambil data yang sudah Verified
$stmt = $pdo->query("SELECT * FROM registrations WHERE apply = 'Verified' ORDER BY id DESC");
$data = $stmt->fetchAll();

// Domain utama untuk membuat link absolut di Excel
$baseUrl = "https://digits.ubhinus.ac.id/uploads/";
?>

<table border="1">
    <thead>
        <tr style="background-color: #10b981; color: white; font-weight: bold;">
            <th>ID</th>
            <th>Tipe</th>
            <th>Kategori</th>
            <th>Email</th>
            <th>Institusi</th>
            <th>Negara</th>
            <th>Telepon</th>
            <th>Author 1</th>
            <th>Author 2</th>
            <th>Author 3</th>
            <th>Judul Paper</th>
            <th>Link Abstrak</th> 
            <th>Link Bukti Bayar</th> 
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['type'] ?></td>
            <td><?= $row['category'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['institution'] ?></td>
            <td><?= $row['country'] ?></td>
            <td>'<?= $row['phone'] ?></td> 
            <td><?= $row['author1'] ?></td>
            <td><?= $row['author2'] ?></td>
            <td><?= $row['author3'] ?></td>
            <td><?= $row['paper_title'] ?></td>
            
            <td>
                <?php if (!empty($row['abstract_file'])): ?>
                    <a href="<?= $baseUrl . 'abstracts/' . $row['abstract_file'] ?>">Download Abstrak</a>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>

            <td>
                <?php if (!empty($row['payment_receipt'])): ?>
                    <a href="<?= $baseUrl . 'receipts/' . $row['payment_receipt'] ?>">Lihat Bukti</a>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>

            <td><?= $row['apply'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>