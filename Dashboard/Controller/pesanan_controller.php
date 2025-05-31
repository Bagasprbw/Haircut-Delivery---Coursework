<?php
session_start();
require_once '../../koneksi.php';
require_once '../../auth.php';
requireRole('Admin');

if (!isset($_GET['id']) || !isset($_GET['aksi'])) {
    die("Permintaan tidak valid.");
}

$id_pesanan = $_GET['id'];
$aksi = $_GET['aksi'];

$ubah_status = '';
switch ($aksi) {
    case 'konfirmasi':
        $ubah_status = 'Dikonfirmasi';
        break;
    case 'proses':
        $ubah_status = 'Diproses';
        break;
    case 'selesai':
        $ubah_status = 'Selesai';
        break;
    case 'batal':
        $ubah_status = 'Dibatalkan';
        break;
    default:
        die("Aksi tidak dikenal.");
}

// Cek apakah status sebelumnya valid untuk aksi ini (opsional keamanan tambahan)
// $cek = $koneksi->prepare("SELECT status_pesanan FROM pesanan WHERE id_pesanan = ?");
// $cek->bind_param("s", $id_pesanan);
// $cek->execute();
// $result = $cek->get_result();
// if ($result->num_rows == 0) {
//     die("Pesanan tidak ditemukan.");
// }
// $row = $result->fetch_assoc();

// $status_saat_ini = $row['status_pesanan'];

// // Cegah perubahan tidak sah
// $valid_transisi = [
//     'Menunggu Konfirmasi' => 'Dikonfirmasi',
//     'Dikonfirmasi' => 'Diproses',
//     'Diproses' => 'Selesai',
//     'Menunggu konfirmasi' => 'Dibatalkan',
//     'Dikonfirmasi' => 'Dibatalkan',
//     'Diproses' => 'Dibatalkan',
// ];

// if (!isset($valid_transisi[$status_saat_ini]) || $valid_transisi[$status_saat_ini] !== $ubah_status) {
//     if ($ubah_status !== 'Dibatalkan') {
//         die("Transisi status tidak sah.");
//     }
// }

// Ubah status
$stmt = $koneksi->prepare("UPDATE pesanan SET status_pesanan = ? WHERE id_pesanan = ?");
$stmt->bind_param("ss", $ubah_status, $id_pesanan);

if ($stmt->execute()) {
    header("Location: ../pesanan.php?status=berhasil");
} else {
    die("Gagal mengubah status.");
}
?>
