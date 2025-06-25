<?php
session_start();
require_once 'koneksi.php';

// Ambil semua layanan
$query = mysqli_query($koneksi, "SELECT * FROM produk");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Katalog Produk</title>
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background-color: #131312;
    }

    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.05);
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card-title {
      font-weight: 600;
    }

    .price {
      font-size: 1rem;
      font-weight: bold;
      color: #6c63ff;
    }
    .img-container {
      height: 200px;
      overflow: hidden;
      border-radius: 15px 15px 0 0;
    }
    .img-container img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
    }
  </style>
</head>
<body>

<?php include 'Components/navbar.php'; ?>

<div class="container py-5 mt-5">
  <h2 class="text-center mb-4 text-white">Produk Tersedia</h2>
  <div class="row g-4">
    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
      <div class="col-md-4">
        <div class="card h-100">
          <?php if (!empty($row['gambar'])): ?>
            <div class="img-container">
                <img src="Dashboard/data_gambar/<?= $row['gambar'] ?>" class="card-img-top" alt="<?= $row['nama_layanan'] ?>">
            </div>
          <?php endif; ?>
          <div class="card-body">
            <h5 class="card-title"><?= $row['nama_produk'] ?></h5>
            <p class="card-text"><?= $row['deskripsi'] ?></p>
            <p class="price">Rp<?= number_format($row['harga'], 0, ',', '.') ?></p>
            <span class="badge bg-secondary"><?= $row['kategori'] ?></span>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<?php include 'Components/footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
