<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Tambah Jasa</title>
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

    <!-- Form Input Jasa Barbershop -->
    <main class="container mt-4">
        <div class="card shadow card-form">
            <div class="card-body">
                <h3 class="mb-4 text-center">Tambah Jasa(Services) Barbershop</h3>
                <form action="data_jasa.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="namaJasa" class="form-label">Nama Jasa</label>
                        <input type="text" name="nama" class="form-control" id="namaJasa" placeholder="Masukkan nama jasa (cth.haircut)" required>
                    </div>

                    <div class="mb-3">
                        <label for="hargaJasa" class="form-label">Harga</label>
                        <input type="number"  name="harga" class="form-control" id="hargaJasa" placeholder="Masukkan harga jasa" required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsiJasa" class="form-label">Deskripsi</label>
                        <textarea class="form-control"  name="deskripsi" id="deskripsiJasa" rows="3" placeholder="Masukkan deskripsi jasa"></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <button type="submit" class="btn btn-primary">Simpan Jasa</button>
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
