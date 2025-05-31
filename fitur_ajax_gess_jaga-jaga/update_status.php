<?php
session_start();
require_once '../koneksi.php';
require_once '../auth.php';
requireRole('Admin');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_pesanan'];
    $status = $_POST['status_pesanan'];

    $stmt = $koneksi->prepare("UPDATE pesanan SET status_pesanan = ? WHERE id_pesanan = ?");
    $stmt->bind_param("ss", $status, $id);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Status berhasil diperbarui.";
    } else {
        $_SESSION['error_message'] = "Gagal memperbarui status.";
    }
}

header("Location: pesanan.php");
exit();
