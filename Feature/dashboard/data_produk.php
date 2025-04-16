<?php
    session_start();
    $nama = $_POST['nama'] ?? NULL;
    $kategori = $_POST['kategori'] ?? NULL;
    $harga = $_POST['harga'] ?? NULL;
    $stok = $_POST['stok'] ?? NULL;
    $deskripsi = $_POST['deskripsi'] ?? NULL;
    if (isset($_POST['submit'])) {
        $target_dir = "data_gambar/"; // Folder penyimpanan
        $target_file = $target_dir . basename($_FILES["gambar_produk"]["name"]);
        
        if (move_uploaded_file($_FILES["gambar_produk"]["tmp_name"], $target_file)) {
            $gambar_produk = $target_file; // Simpan path gambar untuk digunakan di tabel
        } else {
            echo "Gagal mengupload gambar.";
        }
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Data Produk</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .profile-container {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        main {
            padding-top: 70px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <?php include 'Components/navbar.php'; ?>

    <!-- Data Produk -->
    <main class="container mt-4">
        <div class="table-container">
            <h3 class="mb-4 text-center">Data Produk Barbershop</h3>
            <div class="d-flex justify-content-between mb-3">
                <a href="tambah_produk.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Produk</a>
                <input type="text" class="form-control w-25 border border-primary" placeholder="Cari produk...">
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><?= $nama ?></td>
                            <td><?= $kategori ?></td>
                            <td>Rp. <?= number_format($harga) ?></td>
                            <td><?= $stok ?></td>
                            <td><img src="<?= $gambar_produk ?>" alt="" width="80px" height="80px"></td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                                <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-light text-dark text-center py-3 mt-4">
        <p class="mb-0">© 2025 Trim Corner. All Rights Reserved.</p>
    </footer>    

    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
