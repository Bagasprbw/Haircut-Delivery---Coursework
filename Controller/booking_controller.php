<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['id_user'])) {
  echo "<script>alert('Silakan login terlebih dahulu.'); window.location.href='login.php';</script>";
  exit;
}

$id_user = $_SESSION['id_user'];

function generateId($prefix = 'PS') {
  return $prefix . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
}

// Ambil data dari form
$nama       = $_POST['nama'];
$telepon    = $_POST['telepon'];
$tanggal    = $_POST['tanggal'];
$kode_diskon= strtoupper(trim($_POST['diskon'])); // Ubah ke huruf besar
$catatan    = $_POST['catatan'];
$pembayaran = $_POST['pembayaran'];

$layanan_utama     = $_POST['layanan'] ?? [];
$layanan_tambahan  = $_POST['layanan_tambahan'] ?? [];
$semua_layanan = array_merge($layanan_utama, $layanan_tambahan);

// Hitung total harga dari layanan
$total_harga = 0;
$harga_layanan = [];

foreach ($semua_layanan as $nama_layanan) {
  $safe_nama = mysqli_real_escape_string($koneksi, $nama_layanan);
  $query = mysqli_query($koneksi, "SELECT id_layanan, harga_layanan FROM layanan WHERE nama_layanan = '$safe_nama' LIMIT 1");

  $data = mysqli_fetch_assoc($query);
  if ($data) {
    $id_layanan = $data['id_layanan'];
    $harga_layanan[$id_layanan] = $data['harga_layanan'];
    $total_harga += $data['harga_layanan'];
  }
}

// Proses diskon berdasarkan kode
$persentase_diskon = 0;
if ($kode_diskon === 'HAIRCUT15') {
  $persentase_diskon = 15;
} elseif ($kode_diskon === 'HAIRCUT10') {
  $persentase_diskon = 10;
}

// Hitung nilai diskon
$nilai_diskon = floor($total_harga * ($persentase_diskon / 100));
$total_harga_setelah_diskon = $total_harga - $nilai_diskon;
if ($total_harga_setelah_diskon < 0) $total_harga_setelah_diskon = 0;

// Simpan ke tabel pesanan
$id_pesanan = generateId('PS');
$sql_pesanan = "INSERT INTO pesanan 
  (id_pesanan, id_user, waktu, nama, alamat, telp, diskon, total_harga, status_pesanan) 
  VALUES 
  ('$id_pesanan', '$id_user', '$tanggal', '$nama', '', '$telepon', '$nilai_diskon', '$total_harga_setelah_diskon', 'Menunggu Konfirmasi')";

if (mysqli_query($koneksi, $sql_pesanan)) {
  foreach ($harga_layanan as $id_layanan => $harga) {
    $id_detail = generateId('D');
    $sql_detail = "INSERT INTO detail_pesanan 
      (id_detail_pesanan, id_pesanan, id_layanan, harga) 
      VALUES 
      ('$id_detail', '$id_pesanan', '$id_layanan', '$harga')";
    mysqli_query($koneksi, $sql_detail);
  }

  echo "<script>alert('Booking berhasil! Total: Rp" . number_format($total_harga_setelah_diskon) . "'); window.location.href='../pesanan_saya.php';</script>";
} else {
  echo "Gagal menyimpan booking: " . mysqli_error($koneksi);
}
?>
