<?php
        session_start();
        require_once '../koneksi.php';
        require_once '../auth.php';
        requireRole('Admin');

        // Query hitung total data
        $pesanan_list = $koneksi->query("SELECT p.*, u.nama AS nama_user FROM pesanan p LEFT JOIN user u ON p.id_user = u.id_user ORDER BY p.waktu DESC");
        $semua_pesanan = $koneksi->query("SELECT COUNT(*) AS total FROM pesanan")->fetch_assoc()['total'];
        $pesanan_selesai = $koneksi->query("SELECT COUNT(*) AS total FROM pesanan WHERE status_pesanan = 'Selesai'")->fetch_assoc()['total'];
        // $pesanan_proses = $koneksi->query("SELECT COUNT(*) AS total FROM pesanan WHERE status_pesanan = 'Diproses'")->fetch_assoc()['total'];
        $pesanan_batal = $koneksi->query("SELECT COUNT(*) AS total FROM pesanan WHERE status_pesanan = 'Dibatalkan'")->fetch_assoc()['total'];
    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Dashboard | Pesanan</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
        <!-- Font Awesome -->
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
                    <a class="nav-link text-white" href="dashboard.php"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="pesanan.php"><i class="fas fa-tasks me-2"></i> Pesanan</a>    
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
                    <li><a class="dropdown-item" href="../index.php"><i class="fas fa-sign-out-alt me-2"></i> Landing Page</a></li>
                    <li><a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content mt-4">
            <div class="container-fluid pt-4">
                <h1 class="mb-4">Manager Pesanan</h1>
                 
                <!-- Stats Cards Row -->
                <div class="row mb-4">
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Orders</h5>
                                <div class="d-flex justify-content-between align-items-end">
                                    <h4 class="mb-0"><?= number_format($semua_pesanan, 0, ',', '.') ?></h4>
                                    <a href="user.php" class="text-success"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <h5 class="card-title">processed</h5>
                                <div class="d-flex justify-content-between align-items-end">
                                    <h4 class="mb-0"><?= number_format($pesanan_proses, 0, ',', '.') ?></h4>
                                    <a href="user.php" class="text-success"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <h5 class="card-title">Finished</h5>
                                <div class="d-flex justify-content-between align-items-end">
                                    <h4 class="mb-0"><?= number_format($pesanan_selesai, 0, ',', '.') ?></h4>
                                    <a href="user.php" class="text-success"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <h5 class="card-title">Canceled</h5>
                                <div class="d-flex justify-content-between align-items-end">
                                    <h4 class="mb-0"><?= number_format($pesanan_batal, 0, ',', '.') ?></h4>
                                    <a href="user.php" class="text-success"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- nav dan tab -->
                <div class="row mt-4 mb-4">
                    <nav class="nav nav-underline nav-fill">
                        <a class="nav-link filter-link" aria-current="page" href="#">All</a>
                        <a class="nav-link text-dark filter-link" data-status="Menunggu Konfirmasi" href="#">Menunggu Konfirmasi</a>
                        <a class="nav-link text-dark filter-link" data-status="Dikonfirmasi" href="#">Menunggu Proses </a>
                        <a class="nav-link text-dark filter-link" data-status="Diproses" href="#">Sedang Diproses </a>
                        <a class="nav-link text-success filter-link" data-status="Selesai" href="#">Selesai </a>
                        <a class="nav-link text-danger filter-link" data-status="Dibatalkan" href="#">Dibatalkan </a>
                    </nav><hr>
                    <!-- <nav class="nav nav-underline nav-fill">
                        <a class="nav-link filter-link" aria-current="page" href="#">All</a>
                        <a class="nav-link text-dark filter-link" data-status="Menunggu Konfirmasi" href="#">Menunggu Konfirmasi <span class="badge text-bg-danger">4</span></a>
                        <a class="nav-link text-dark filter-link" data-status="Dikonfirmasi" href="#">Menunggu Proses <span class="badge text-bg-danger">4</span></a>
                        <a class="nav-link text-dark filter-link" data-status="Diproses" href="#">Sedang Diproses <span class="badge text-bg-success">4</span></a>
                        <a class="nav-link text-success filter-link" data-status="Selesai" href="#">Selesai </a>
                        <a class="nav-link text-danger filter-link" data-status="Dibatalkan" href="#">Dibatalkan </a>
                    </nav><hr> -->
                </div>
                
                <!-- Charts Row -->
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Semua Data Pesanan</h5>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>No. Telepon</th>
                                        <th>Alamat</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody id="pesanan-body">
                                    <!-- otomatis oleh ajax -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Bootstrap JS (for dropdowns only) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        <script>
            // Toggle sidebar and overlay for mobile
            document.getElementById('hamburgerBtn').addEventListener('click', function() {
                document.getElementById('sidebar').classList.toggle('active');
                document.getElementById('overlay').classList.toggle('active');
            });
            
            document.getElementById('overlay').addEventListener('click', function() {
                document.getElementById('sidebar').classList.remove('active');
                document.getElementById('overlay').classList.remove('active');
            });
        </script>
        <script>
            document.querySelectorAll('.filter-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const status = this.getAttribute('data-status') || 'All';

                    fetch(`filter_pesanan.php?status=${encodeURIComponent(status)}`)
                        .then(response => response.json())
                        .then(data => {
                            const tbody = document.getElementById('pesanan-body');
                            tbody.innerHTML = '';

                            if (data.length === 0) {
                                tbody.innerHTML = '<tr><td colspan="9" class="text-center">Tidak ada pesanan.</td></tr>';
                                return;
                            }

                            let no = 1;
                            data.forEach(row => {
                                let badge = 'secondary';
                                if (row.status_pesanan === 'Selesai') badge = 'success';
                                else if (row.status_pesanan === 'Diproses') badge = 'info';
                                else if (row.status_pesanan === 'Dibatalkan') badge = 'danger';
                                else if (row.status_pesanan === 'Menunggu Konfirmasi') badge = 'warning';
                                else if (row.status_pesanan === 'Dikonfirmasi') badge = 'primary';

                                let actions = '';
                                if (row.status_pesanan === 'Menunggu Konfirmasi') {
                                    actions += `<a href="Controller/pesanan_controller.php?id=${row.id_pesanan}&aksi=konfirmasi" class="btn btn-sm btn-primary" onclick="return confirm('Yakin ingin konfirmasi pesanan ini?')">Konfirmasi</a> `;
                                } else if (row.status_pesanan === 'Dikonfirmasi') {
                                    actions += `<a href="Controller/pesanan_controller.php?id=${row.id_pesanan}&aksi=proses" class="btn btn-sm btn-info" onclick="return confirm('Yakin ingin memproses pesanan ini?')">Proses</a> `;
                                } else if (row.status_pesanan === 'Diproses') {
                                    actions += `<a href="Controller/pesanan_controller.php?id=${row.id_pesanan}&aksi=selesai" class="btn btn-sm btn-success" onclick="return confirm('Yakin ingin menyelesaikan pesanan ini?')">Pesanan Selesai</a> `;
                                }

                                if (!['Selesai', 'Dibatalkan'].includes(row.status_pesanan)) {
                                    actions += `<a href="Controller/pesanan_controller.php?id=${row.id_pesanan}&aksi=batal" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin membatalkan pesanan ini?')">Cancel</a>`;
                                }

                                tbody.innerHTML += `
                                    <tr>
                                        <td>${no++}</td>
                                        <td>${row.nama_user}</td>
                                        <td>${new Date(row.waktu).toLocaleDateString('id-ID')}</td>
                                        <td>${row.telp}</td>
                                        <td>${row.alamat}</td>
                                        <td>Rp ${parseInt(row.total_harga).toLocaleString('id-ID')}</td>
                                        <td><span class="badge bg-${badge}">${row.status_pesanan}</span></td>
                                        <td>${actions}</td>
                                        <td>
                                            <a href="detail_pesanan.php?id=${row.id_pesanan}" class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                `;
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching data:', error);
                        });
                });
            });
            // Setelah DOM selesai dimuat, otomatis klik link "All"
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelector('.filter-link[aria-current="page"]').click();
            });
        </script>
    </body>
    </html>