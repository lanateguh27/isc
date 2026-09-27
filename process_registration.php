<?php
ob_start();
session_start();
require_once 'config.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {

        // =========================
        // 1. AMBIL DATA FORM
        // =========================
        $type        = $_POST['type'];
        $category    = $_POST['category'];
        $email       = $_POST['email'];
        $author1     = $_POST['author1'];
        $author2     = $_POST['author2'] ?? null;
        $author3     = $_POST['author3'] ?? null;
        $author4     = $_POST['author4'] ?? null;
        $author5     = $_POST['author5'] ?? null;
        $group_name  = $_POST['group_name'];
        $paper_title = $_POST['paper_title'];
        $institution = $_POST['institution'];
        $country     = $_POST['country'];
        $phone       = $_POST['phone'];
        $apply       = "Pending";

        // =========================
        // 2. SET FOLDER UPLOAD (AMAN)
        // =========================
        $baseDir = __DIR__ . "/uploads/";
        $dirAbstract = $baseDir . "abstracts/";
        $dirReceipt  = $baseDir . "receipts/";

        // =========================
        // 3. FUNCTION UPLOAD AMAN
        // =========================
        function uploadFile($file, $targetDir, $type) {

            if (!isset($file) || $file['error'] !== 0) {
                return null;
            }

            $fileTmp  = $file['tmp_name'];
            $fileSize = $file['size'];

            // 🔒 Validasi ukuran (max 2MB)
            if ($fileSize > 2 * 1024 * 1024) {
                throw new Exception("File terlalu besar! Maksimal 2MB.");
            }

            // 🔒 Validasi MIME TYPE (WAJIB)
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime  = finfo_file($finfo, $fileTmp);
            finfo_close($finfo);

            if ($type == "abstract") {
                $allowedMime = [
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];
                $prefix = "ABS-";
            } else {
                $allowedMime = [
                    'image/jpeg',
                    'image/png',
                    'application/pdf'
                ];
                $prefix = "PAY-";
            }

            if (!in_array($mime, $allowedMime)) {
                throw new Exception("Tipe file tidak valid!");
            }

            // 🔒 Validasi tambahan untuk gambar
            if (strpos($mime, 'image/') === 0) {
                if (!getimagesize($fileTmp)) {
                    throw new Exception("File gambar tidak valid!");
                }
            }

            // 🔒 Generate nama aman
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $newName = $prefix . bin2hex(random_bytes(16)) . "." . $ext;

            $destination = $targetDir . $newName;

            if (!move_uploaded_file($fileTmp, $destination)) {
                throw new Exception("Gagal upload file.");
            }

            return $newName;
        }

        // =========================
        // 4. PROSES UPLOAD
        // =========================
        $abstract_file   = uploadFile($_FILES['abstract_file'], $dirAbstract, "abstract");
        $payment_receipt = uploadFile($_FILES['payment_receipt'], $dirReceipt, "payment");

        if (!$payment_receipt) {
            throw new Exception("Bukti pembayaran wajib diupload!");
        }

        // =========================
        // 5. INSERT DATABASE
        // =========================
        $sql = "INSERT INTO registrations (
                    type, category, email, author1, author2, author3, author4, author5, 
                    group_name, paper_title, institution, country, phone, 
                    abstract_file, payment_receipt, apply
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);

        $success = $stmt->execute([
            $type, $category, $email, $author1, $author2, $author3, $author4, $author5,
            $group_name, $paper_title, $institution, $country, $phone,
            $abstract_file, $payment_receipt, $apply
        ]);

        // =========================
        // 6. KIRIM EMAIL
        // =========================
        if ($success) {

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'conference@ubhinus.ac.id';
                $mail->Password   = 'ISI_APP_PASSWORD'; // 🔥 GANTI
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                $mail->setFrom('conference@ubhinus.ac.id', 'DIGITS 2026');
                $mail->addAddress($email, $author1);

                $mail->isHTML(true);
                $mail->Subject = 'Registration Confirmation - DIGITS 2026';

                $mail->Body = "
                <h3>Dear {$author1},</h3>
                <p>Registrasi kamu berhasil sebagai <b>{$category}</b>.</p>
                <p><b>Important Dates:</b></p>
                <ul>
                    <li>July 1, 2026 - Abstract Acceptance</li>
                    <li>July 8, 2026 - Full Paper Deadline</li>
                </ul>
                <p>Terima kasih 🙌</p>
                ";

                $mail->send();

            } catch (Exception $e) {
                // email gagal tidak masalah
            }

            header("Location: registration.php?status=success");
            exit();
        }

    } catch (Exception $e) {

        $error = urlencode($e->getMessage());
        header("Location: registration.php?status=error&message=$error");
        exit();
    }
}
?>