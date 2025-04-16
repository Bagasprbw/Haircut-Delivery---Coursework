<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars($_POST['nama']);
    $telepon = htmlspecialchars($_POST['telepon']);
    $layanan = isset($_POST['layanan']) ? implode(', ', array_map('htmlspecialchars', $_POST['layanan'])) : 'Tidak ada layanan yang dipilih';
    $layanan_tambahan = isset($_POST['layanan_tambahan']) ? implode(', ', array_map('htmlspecialchars', $_POST['layanan_tambahan'])) : 'Tidak ada layanan tambahan yang dipilih'; // Menambahkan layanan tambahan
    $barber = htmlspecialchars($_POST['barber']);
    $tanggal = htmlspecialchars($_POST['tanggal']);
    $waktu = htmlspecialchars($_POST['waktu']);
    $catatan = htmlspecialchars($_POST['catatan']);
    $pembayaran = htmlspecialchars($_POST['pembayaran']);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pemesanan</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background-color: rgb(91, 91, 91);
        }
        li {
            margin-bottom: 10px;
            list-style: none;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
        }
    </style>
</head>
<body class="">

<!-- Navbar -->
<?php require_once('Components/navbar.php'); ?>

<div class="container bg-white p-4 rounded shadow-sm">
    <h2 class="text-center mb-4">Hasil Pemesanan Barbershop</h2>
    <ul>
        <li><strong>Nama:</strong> <?php echo $nama; ?></li>
        <li><strong>Telepon:</strong> <?php echo $telepon; ?></li>
        <li><strong>Layanan yang Dipilih:</strong> <?php echo $layanan; ?></li>
        <li><strong>Layanan Tambahan yang Dipilih:</strong> <?php echo $layanan_tambahan; ?></li> <!-- Menampilkan layanan tambahan -->
        <li><strong>Barberman:</strong> <?php echo $barber; ?></li>
        <li><strong>Tanggal:</strong> <?php echo $tanggal; ?></li>
        <li><strong>Waktu:</strong> <?php echo $waktu; ?></li>
        <li><strong>Catatan Tambahan:</strong> <?php echo $catatan; ?></li>
        <li><strong>Metode Pembayaran:</strong> <?php echo $pembayaran; ?></li>
    </ul>

    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-primary">Kembali ke Halaman Utama</a>
    </div>
</div>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="JS/interaktif.js"></script>
</body>
</html>
