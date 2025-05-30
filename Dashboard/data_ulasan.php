<?php
session_start();
require_once '../koneksi.php';
require_once '../auth.php';
requireRole('Admin');

// Ambil data ulasan
$query = "SELECT ulasan.*, user.nama 
          FROM ulasan 
          LEFT JOIN user ON ulasan.id_user = user.id_user 
          ORDER BY tanggal DESC";
$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard | Data Ulasan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    :root {
      --sidebar-width: 250px;
      --header-height: 60px;
      --sidebar-bg: #2c3e50;
      --header-bg: #ffffff;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      overflow-x: hidden;
    }

    .sidebar {
      width: var(--sidebar-width);
      height: 100vh;
      position: fixed;
      left: 0;
      top: 0;
      background-color: var(--sidebar-bg);
      color: white;
      padding: 20px 0;
      z-index: 1000;
    }

    .main-content {
      margin-left: var(--sidebar-width);
      padding: 20px;
      min-height: calc(100vh - var(--header-height));
    }

    .header {
      height: var(--header-height);
      background-color: var(--header-bg);
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      position: fixed;
      width: calc(100% - var(--sidebar-width));
      right: 0;
      top: 0;
      z-index: 900;
      display: flex;
      align-items: center;
      padding: 0 20px;
    }

    .hamburger-btn {
      background: none;
      border: none;
      color: var(--sidebar-bg);
      font-size: 1.5rem;
      cursor: pointer;
      display: none;
    }

    .dropdown {
      margin-left: auto;
    }

    @media (max-width: 992px) {
      .sidebar {
        transform: translateX(-100%);
        transition: all 0.3s;
      }

      .sidebar.active {
        transform: translateX(0);
      }

      .main-content {
        margin-left: 0;
      }

      .header {
        width: 100%;
      }

      .hamburger-btn {
        display: block;
      }

      .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 900;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s;
      }

      .overlay.active {
        opacity: 1;
        visibility: visible;
      }
    }

    .star {
      color: #ffc107;
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <div class="sidebar-header text-center mb-4">
    <h4>Dashboard</h4>
  </div>
  <ul class="nav flex-column px-3">
    <li class="nav-item mb-2">
      <a class="nav-link text-white" href="#"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
    </li>
    <li class="nav-item mb-2">
      <a class="nav-link text-white" href="#"><i class="fas fa-tasks me-2"></i> Pesanan</a>
    </li>
    <li class="nav-item mb-2">
      <a class="nav-link text-white" href="#"><i class="fas fa-shopping-cart me-2"></i> Pembelian</a>
    </li>
    <li class="nav-item mb-2">
      <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
        <i class="fas fa-box-open me-2"></i> Manage Product
      </a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="data_produk.php">Data Produk</a></li>
        <li><a class="dropdown-item" href="tambah_produk.php">Tambah Data</a></li>
      </ul>
    </li>
    <li class="nav-item mb-2">
      <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
        <i class="fas fa-tags me-2"></i> Manage Layanan
      </a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="data_jasa.php">Data Layanan</a></li>
        <li><a class="dropdown-item" href="tambah_jasa.php">Tambah Data</a></li>
      </ul>
    </li>
    <li class="nav-item mb-2">
      <a class="nav-link text-white" href="data_ulasan.php"><i class="fas fa-inbox me-2"></i> Ulasan</a>
    </li>
  </ul>
  <hr class="bg-light mx-3 my-4" />
  <h6 class="px-3 mb-3">Settings</h6>
  <ul class="nav flex-column px-3">
    <li class="nav-item mb-2">
      <a class="nav-link text-white" href="#"><i class="fas fa-user-cog me-2"></i> Personal Settings</a>
    </li>
  </ul>
</div>

<!-- Overlay -->
<div class="overlay" id="overlay"></div>

<!-- Header -->
<div class="header">
  <button class="hamburger-btn" id="hamburgerBtn"><i class="fas fa-bars"></i></button>
  <div class="dropdown">
    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
      <i class="fas fa-user-circle me-1"></i> Admin
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
      <li><a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
    </ul>
  </div>
</div>

<!-- Main Content -->
<div class="main-content mt-4">
  <div class="container-fluid pt-4">
    <h1 class="mb-4">Data Ulasan</h1>
    <div class="card">
      <div class="card-body table-responsive">
        <table class="table table-hover">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Nama User</th>
              <th>Tanggal</th>
              <th>Rating</th>
              <th>Pesan</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama'] ?? 'User Tidak Dikenal') ?></td>
                <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                <td>
                  <?php
                    for ($i = 1; $i <= 5; $i++) {
                      echo $i <= $row['rating'] ? '<i class="fas fa-star star"></i>' : '<i class="far fa-star star"></i>';
                    }
                  ?>
                </td>
                <td><?= nl2br(htmlspecialchars($row['pesan'])) ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('hamburgerBtn').addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('active');
    document.getElementById('overlay').classList.toggle('active');
  });
  document.getElementById('overlay').addEventListener('click', function() {
    document.getElementById('sidebar').classList.remove('active');
    document.getElementById('overlay').classList.remove('active');
  });
</script>

</body>
</html>
  