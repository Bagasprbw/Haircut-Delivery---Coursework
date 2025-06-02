<?php
session_start();
require_once '../koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header('Location: ../login.php');
    exit;
}

$id_user = $_SESSION['id_user'];

if (isset($_GET['aksi']) && $_GET['aksi'] === 'batal' && isset($_GET['id'])) {
    $id_pesanan = $_GET['id'];

    // Pastikan pesanan milik user dan belum selesai/dibatalkan
    $query = $koneksi->query("SELECT * FROM pesanan WHERE id_pesanan = '$id_pesanan' AND id_user = '$id_user' AND status_pesanan NOT IN ('Selesai', 'Dibatalkan')");

    if ($query->num_rows > 0) {
        $koneksi->query("UPDATE pesanan SET status_pesanan = 'Dibatalkan' WHERE id_pesanan = '$id_pesanan'");
        echo "<script>alert('Pesanan berhasil dibatalkan.'); window.location.href='../pesanan_saya.php';</script>";
    } else {
        echo "<script>alert('Pesanan tidak bisa dibatalkan.'); window.location.href='../pesanan_saya.php';</script>";
    }
} else {
    header('Location: ../pesanan_saya.php');
    exit;
}
?>
