    <?php
        session_start();
        require_once '../koneksi.php';
        require_once '../auth.php';
        requireRole('Admin');

        // Query hitung total data
        $total_customer = $koneksi->query("SELECT COUNT(*) AS total FROM user WHERE role = 'Customer'")->fetch_assoc()['total'];
        $total_produk = $koneksi->query("SELECT COUNT(*) AS total FROM produk")->fetch_assoc()['total'];
        $total_layanan = $koneksi->query("SELECT COUNT(*) AS total FROM layanan")->fetch_assoc()['total'];
        $total_booking_selesai = $koneksi->query("SELECT COUNT(*) AS total FROM pesanan WHERE status_pesanan = 'Selesai'")->fetch_assoc()['total'];
        $total_pembelian_selesai = $koneksi->query("SELECT COUNT(*) AS total FROM pembelian WHERE status_pembelian = 'Selesai'")->fetch_assoc()['total'];
        $total_pendapatan_pesanan = $koneksi->query("SELECT SUM(total_harga) AS total FROM pesanan WHERE status_pesanan = 'Selesai'")->fetch_assoc()['total'] ?? 0;
        $total_pendapatan_pembelian = $koneksi->query("SELECT SUM(total_harga) AS total FROM pembelian WHERE status_pembelian = 'Selesai'")->fetch_assoc()['total'] ?? 0;
    ?>

    <?php
        $pendapatan_harian = [];
        $result = $koneksi->query("
            SELECT DATE(waktu) AS tanggal, SUM(total_harga) AS total
            FROM pesanan 
            WHERE status_pesanan = 'Selesai'
            GROUP BY DATE(waktu)
            ORDER BY tanggal ASC
        ");

        while ($row = $result->fetch_assoc()) {
            $pendapatan_harian[] = [
                'tanggal' => $row['tanggal'],
                'total' => (int)$row['total'],
            ];
        }
    ?>



    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Dashboard</title>
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
                <h1 class="mb-4">Dashboard</h1>
                
                <!-- Stats Cards Row -->
                <div class="row mb-4">
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Customer</h5>
                                <div class="d-flex justify-content-between align-items-end">
                                    <h2 class="mb-0"><?= $total_customer ?></h2>
                                    <a href="user.php" class="text-success"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Layanan</h5>
                                <div class="d-flex justify-content-between align-items-end">
                                    <h2 class="mb-0"><?= $total_layanan ?></h2>
                                    <a href="data_jasa.php" class="text-success"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Produk</h5>
                                <div class="d-flex justify-content-between align-items-end">
                                    <h2 class="mb-0"><?= $total_produk ?></h2>
                                    <a href="data_produk.php" class="text-success"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <h5 class="card-title">Pesanan(Booking) Selesai</h5>
                                <div class="d-flex justify-content-between align-items-end">
                                    <h2 class="mb-0"><?= $total_booking_selesai ?></h2>
                                    <a href="user.php" class="text-success"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <h5 class="card-title">Pembelian Selesai</h5>
                                <div class="d-flex justify-content-between align-items-end">
                                    <h2 class="mb-0"><?= $total_pembelian_selesai ?></h2>
                                    <a href="user.php" class="text-success"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <h5 class="card-title">Pendapatan Pemesanan</h5>
                                <div class="d-flex justify-content-between align-items-end">
                                    <h4 class="mb-0">Rp <?= number_format($total_pendapatan_pesanan, 0, ',', '.') ?></h4>
                                    <a href="user.php" class="text-success"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 mb-3">
                        <div class="card stat-card">
                            <div class="card-body">
                                <h5 class="card-title">Pendapatan Pembelian</h5>
                                <div class="d-flex justify-content-between align-items-end">
                                    <h4 class="mb-0">Rp <?= number_format($total_pendapatan_pembelian, 0, ',', '.') ?></h4>
                                    <a href="user.php" class="text-success"><i class="fas fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Charts Row -->
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Chart Income</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="chartPendapatan" height="120"></canvas>
                            </div>
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
        <!-- Chart.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const pendapatanData = <?= json_encode($pendapatan_harian); ?>;

            const labels = pendapatanData.map(item => item.tanggal);
            const data = pendapatanData.map(item => item.total);

            const ctx = document.getElementById('chartPendapatan').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pendapatan Booking',
                        data: data,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                        tension: 0.3,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
        </script>
    </body>
    </html>
