<?php
    session_start();
    $nama = $_POST['nama'] ?? NULL;
    $harga = $_POST['harga'] ?? NULL;
    $deskripsi = $_POST['deskripsi'] ?? NULL;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Data Jasa</title>
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
            <h3 class="mb-4 text-center">Data Jasa(Services) Barbershop</h3>
            <div class="d-flex justify-content-between mb-3">
                <a href="tambah_jasa.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Jasa</a>
                <input type="text" class="form-control w-25 border border-primary" placeholder="Cari jasa...">
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th>No</th>
                            <th>Nama jasa</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><?= $nama ?></td>
                            <td>Rp <?= number_format($harga) ?></td>
                            <td><?= $deskripsi ?></td>
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
