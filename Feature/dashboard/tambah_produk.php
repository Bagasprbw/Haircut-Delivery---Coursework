<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Tambah Produk</title>
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
        .card-form {
            max-width: 600px;
            margin: auto;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <?php include 'Components/navbar.php'; ?>

    <!-- Form Input Produk Barbershop -->
    <main class="container mt-4">
        <div class="card shadow card-form">
            <div class="card-body">
                <h3 class="mb-4 text-center">Tambah Produk Barbershop</h3>
                <form action="data_produk.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="namaProduk" class="form-label">Nama Produk</label>
                        <input type="text" name="nama" class="form-control" id="namaProduk" placeholder="Masukkan nama produk" required>
                    </div>

                    <div class="mb-3">
                        <label for="kategoriProduk" class="form-label">Kategori</label>
                        <select class="form-select" name="kategori" id="kategoriProduk" required>
                            <option selected disabled>Pilih kategori</option>
                            <option value="pomade">Pomade</option>
                            <option value="wax">Wax</option>
                            <option value="shampoo">Sampo</option>
                            <option value="hairtonic">Hair Tonic</option>
                            <option value="aftershave">Aftershave</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="hargaProduk" class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" id="hargaProduk" placeholder="Masukkan harga produk" required>
                    </div>

                    <div class="mb-3">
                        <label for="stokProduk" class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" id="stokProduk" placeholder="Masukkan jumlah stok" required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsiProduk" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsiProduk" rows="3" placeholder="Masukkan deskripsi produk"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="gambarProduk" class="form-label">Upload Gambar</label>
                        <input type="file" name="gambar_produk" class="form-control" id="gambarProduk">
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <button type="submit" name="submit" class="btn btn-primary">Simpan Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p class="mb-0">© 2025 Trim Corner. All Rights Reserved.</p>
    </footer>    
    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
