<?php
require_once '../koneksi.php';

$status = $_GET['status'] ?? '';

$query = "SELECT p.*, u.nama AS nama_user 
          FROM pesanan p 
          LEFT JOIN user u ON p.id_user = u.id_user";

if ($status && $status !== 'All') {
    $stmt = $koneksi->prepare($query . " WHERE p.status_pesanan = ? ORDER BY p.waktu DESC");
    $stmt->bind_param("s", $status);
} else {
    $stmt = $koneksi->prepare($query . " ORDER BY p.waktu DESC");
}

$stmt->execute();
$result = $stmt->get_result();

$rows = [];
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

echo json_encode($rows);
