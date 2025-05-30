<?php
    session_start();
    require_once '../koneksi.php';
    require_once '../auth.php';
    requireRole('Admin');

    // Ambil data layanan berdasarkan ID
    if (!isset($_GET['id'])) {
        header("Location: data_jasa.php");
        exit;
    }

    $id = $_GET['id'];
    $stmt = $koneksi->prepare("SELECT * FROM layanan WHERE id_layanan = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $layanan = $result->fetch_assoc();

    if (!$layanan) {
        echo "Layanan tidak ditemukan.";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard | Edit Layanan(Jasa)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
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
        
        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: var(--sidebar-bg);
            color: white;
            padding: 20px 0;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            min-height: calc(100vh - var(--header-height));
            transition: all 0.3s;
        }
        
        /* Header */
        .header {
            height: var(--header-height);
            background-color: var(--header-bg);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: calc(100% - var(--sidebar-width));
            right: 0;
            top: 0;
            z-index: 900;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            padding: 0 20px;
            gap: 1rem;
        }
        
        .hamburger-btn {
            background: none;
            border: none;
            color: var(--sidebar-bg);
            font-size: 1.5rem;
            cursor: pointer;
            display: none;
        }
        
        /* Dorong dropdown user ke kanan */
        .dropdown {
            margin-left: auto;
        }
        
        /* Stats Cards */
        .stat-card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            height: 100%;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        /* Mobile View */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
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
                <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-box-open me-2"></i> Manage Product
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="data_produk.php">Data Produk</a></li>
                    <li><a class="dropdown-item" href="tambah_produk.php">Tambah Data</a></li>
                </ul>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-tags me-2"></i> Manage Layanan (Jasa)
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="data_jasa.php">Data Layanan (Jasa)</a></li>
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

    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>

    <!-- Header -->
    <div class="header">
        <button class="hamburger-btn" id="hamburgerBtn">
            <i class="fas fa-bars"></i>
        </button>

        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-circle me-1"></i> Admin
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content mt-4">
        <div class="container-fluid pt-4">
            <h1 class="mb-4">Form Edit Layanan(Jasa)</h1>

            <div class="card">
                <div class="card-body">
                    <form action="Controller/jasa_controller.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_layanan" value="<?= htmlspecialchars($layanan['id_layanan']) ?>">

                        <div class="mb-3">
                            <label class="form-label">ID Layanan</label>
                            <input type="text" class="form-control" name="id_layanan" value="<?= htmlspecialchars($layanan['id_layanan']) ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Layanan</label>
                            <input type="text" class="form-control" name="nama_layanan" value="<?= htmlspecialchars($layanan['nama_layanan']) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <input type="text" class="form-control" name="Kategori" value="<?= htmlspecialchars($layanan['kategori']) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" class="form-control" name="harga_layanan" value="<?= htmlspecialchars($layanan['harga_layanan']) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar (upload baru jika ingin mengganti)</label>
                            <input class="form-control" name="gambar" type="file">
                            <p class="mt-2">Gambar saat ini: <br><img src="data_gambar/<?= htmlspecialchars($layanan['gambar']) ?>" width="150"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="3"><?= htmlspecialchars($layanan['deskripsi']) ?></textarea>
                        </div>
                        <button type="submit" name="edit_services" class="btn btn-warning">Update Layanan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JS tetap sama -->
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
