<?php
session_start();
require_once '../koneksi.php';

function generateIdUlasan($koneksi) {
    $result = mysqli_query($koneksi, "SELECT id_ulasan FROM ulasan ORDER BY id_ulasan DESC LIMIT 1");
    if ($row = mysqli_fetch_assoc($result)) {
        $lastId = $row['id_ulasan']; 
        $num = (int) substr($lastId, 2); 
        $num++;
        $newId = 'Ul' . str_pad($num, 3, '0', STR_PAD_LEFT);
    } else {
        $newId = 'Ul001';
    }
    return $newId;
}

$id_ulasan = generateIdUlasan($koneksi);
$id_user = $_SESSION['id_user'];
$tanggal = date("Y-m-d");
$rating = $_POST['rating'];
$pesan = $_POST['pesan'];

$query = "INSERT INTO ulasan (id_ulasan, id_user, tanggal, rating, pesan) 
          VALUES ('$id_ulasan', '$id_user', '$tanggal', '$rating', '$pesan')";

if (mysqli_query($koneksi, query: $query)) {
    $_SESSION['ulasan_status'] = 'berhasil';
} else {
    $_SESSION['ulasan_status'] = 'gagal';
}

header('Location: ../index.php#ulasan');
exit;

?>
