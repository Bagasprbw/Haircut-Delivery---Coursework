<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crown Barbershop - Simulasi Biaya</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #d4af37;
            --dark: #222;
            --light: #f8f9fa;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }
        
        .navbar-brand {
            font-weight: bold;
        }
        
        .navbar-brand span {
            color: var(--primary);
        }
        
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('/api/placeholder/1200/400');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 60px 0;
            margin-bottom: 30px;
        }
        
        .card {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            margin-bottom: 30px;
        }
        
        .card-header {
            background-color: var(--dark);
            color: white;
            font-weight: bold;
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover {
            background-color: #c19b2e;
            border-color: #c19b2e;
        }
        
        footer {
            background-color: var(--dark);
            color: white;
            padding: 40px 0 20px;
        }
        
        footer h5 {
            color: var(--primary);
            margin-bottom: 20px;
        }
        
        .social-icons {
            font-size: 1.5rem;
        }
        
        .social-icons a {
            color: white;
            margin-right: 15px;
        }
        
        .copyright {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #444;
        }
        
        .table-results {
            margin-top: 20px;
        }
        
        .table-results th {
            background-color: #f0f0f0;
        }
        
        .table-results th, .table-results td {
            vertical-align: middle;
        }
        
        .total-row {
            font-weight: bold;
            background-color: #f8f8f8;
        }
        
        #simulationHistory {
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Crown <span>Barbershop</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Simulasi Biaya</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section text-center">
        <div class="container">
            <h1>Simulasi Perhitungan Biaya Layanan</h1>
            <p class="lead">Hitung estimasi biaya untuk berbagai layanan di Crown Barbershop</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mb-5">
        <div class="row">
            <!-- Input Form -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        Form Simulasi Biaya
                    </div>
                    <div class="card-body">
                        <form method="post" id="calculationForm">
                            <!-- Data Customer -->
                            <div class="mb-4">
                                <h5>Data Pelanggan</h5>
                                <div class="mb-3">
                                    <label for="customerName" class="form-label">Nama Pelanggan</label>
                                    <input type="text" class="form-control" id="customerName" name="customerName" required value="<?= isset($_POST['customerName']) ? htmlspecialchars($_POST['customerName']) : '' ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="customerPhone" class="form-label">Nomor Telepon</label>
                                    <input type="tel" class="form-control" id="customerPhone" name="customerPhone" required value="<?= isset($_POST['customerPhone']) ? htmlspecialchars($_POST['customerPhone']) : '' ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="customerStatus" class="form-label">Status Member</label>
                                    <select class="form-select" id="customerStatus" name="customerStatus" required>
                                        <option value="regular" <?= (isset($_POST['customerStatus']) && $_POST['customerStatus'] == 'regular') ? 'selected' : '' ?>>Regular (Non-Member)</option>
                                        <option value="silver" <?= (isset($_POST['customerStatus']) && $_POST['customerStatus'] == 'silver') ? 'selected' : '' ?>>Silver Member (Diskon 5%)</option>
                                        <option value="gold" <?= (isset($_POST['customerStatus']) && $_POST['customerStatus'] == 'gold') ? 'selected' : '' ?>>Gold Member (Diskon 10%)</option>
                                        <option value="platinum" <?= (isset($_POST['customerStatus']) && $_POST['customerStatus'] == 'platinum') ? 'selected' : '' ?>>Platinum Member (Diskon 15%)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Layanan Dasar -->
                            <div class="mb-4">
                                <h5>Layanan Dasar (Pilih Satu)</h5>
                                <?php
                                $basicServices = [
                                    'haircut' => ['name' => 'Potong Rambut Standar', 'price' => 50000],
                                    'haircut-wash' => ['name' => 'Potong Rambut + Cuci', 'price' => 75000],
                                    'haircut-styling' => ['name' => 'Potong Rambut + Styling', 'price' => 100000],
                                    'premium' => ['name' => 'Paket Premium (Potong + Cuci + Styling)', 'price' => 150000]
                                ];
                                
                                foreach ($basicServices as $key => $service) {
                                    $checked = (isset($_POST['basicService']) && $_POST['basicService'] == $key) || (!isset($_POST['basicService']) && $key == 'haircut') ? 'checked' : '';
                                    echo '
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="basicService" id="'.$key.'" value="'.$key.'" data-price="'.$service['price'].'" '.$checked.'>
                                        <label class="form-check-label d-flex justify-content-between" for="'.$key.'">
                                            <span>'.$service['name'].'</span>
                                            <span>Rp '.number_format($service['price'], 0, ',', '.').'</span>
                                        </label>
                                    </div>';
                                }
                                ?>
                            </div>

                            <!-- Layanan Tambahan -->
                            <div class="mb-4">
                                <h5>Layanan Tambahan (Opsional)</h5>
                                <?php
                                $extraServices = [
                                    'shaving' => ['name' => 'Cukur Jenggot/Kumis', 'price' => 35000],
                                    'haircolor' => ['name' => 'Pewarnaan Rambut', 'price' => 150000],
                                    'hairmask' => ['name' => 'Hair Mask', 'price' => 100000],
                                    'massage' => ['name' => 'Pijat Kepala & Bahu', 'price' => 80000]
                                ];
                                
                                foreach ($extraServices as $key => $service) {
                                    $checked = isset($_POST['extraService']) && in_array($key, $_POST['extraService']) ? 'checked' : '';
                                    echo '
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="extraService[]" id="'.$key.'" value="'.$key.'" data-price="'.$service['price'].'" '.$checked.'>
                                        <label class="form-check-label d-flex justify-content-between" for="'.$key.'">
                                            <span>'.$service['name'].'</span>
                                            <span>Rp '.number_format($service['price'], 0, ',', '.').'</span>
                                        </label>
                                    </div>';
                                }
                                ?>
                            </div>

                            <!-- Jumlah Kunjungan -->
                            <div class="mb-4">
                                <h5>Frekuensi Kunjungan</h5>
                                <div class="mb-3">
                                    <label for="visitCount" class="form-label">Jumlah Kunjungan (dalam sebulan)</label>
                                    <input type="number" class="form-control" id="visitCount" name="visitCount" min="1" max="10" value="<?= isset($_POST['visitCount']) ? htmlspecialchars($_POST['visitCount']) : '1' ?>" required>
                                    <div class="form-text">Dapatkan diskon tambahan untuk kunjungan rutin</div>
                                </div>
                            </div>

                            <!-- Kode Promo -->
                            <div class="mb-4">
                                <h5>Kode Promo (Opsional)</h5>
                                <div class="mb-3">
                                    <label for="promoCode" class="form-label">Masukkan Kode Promo</label>
                                    <input type="text" class="form-control" id="promoCode" name="promoCode" value="<?= isset($_POST['promoCode']) ? htmlspecialchars($_POST['promoCode']) : '' ?>">
                                    <div class="form-text">
                                        Kode promo yang berlaku: NEWCUSTOMER (10%), WEEKEND (5%), BIRTHDAY (15%)
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" name="calculate">Hitung Biaya</button>
                                <button type="reset" class="btn btn-secondary">Reset Form</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Results -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        Hasil Perhitungan
                    </div>
                    <div class="card-body">
                        <div id="calculationResults">
                            <?php
                            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['calculate'])) {
                                // Proses perhitungan
                                $customerName = $_POST['customerName'];
                                $customerPhone = $_POST['customerPhone'];
                                $customerStatus = $_POST['customerStatus'];
                                $basicServiceKey = $_POST['basicService'];
                                $visitCount = (int)$_POST['visitCount'];
                                $promoCode = isset($_POST['promoCode']) ? strtoupper(trim($_POST['promoCode'])) : '';
                                
                                // Get basic service details
                                $basicService = $basicServices[$basicServiceKey];
                                $basicServiceName = $basicService['name'];
                                $basicServicePrice = $basicService['price'];
                                
                                // Initialize selected services array
                                $selectedServices = [
                                    [
                                        'name' => $basicServiceName,
                                        'price' => $basicServicePrice,
                                        'quantity' => 1,
                                        'subtotal' => $basicServicePrice
                                    ]
                                ];
                                
                                // Add extra services if selected
                                if (isset($_POST['extraService'])) {
                                    foreach ($_POST['extraService'] as $extraServiceKey) {
                                        $service = $extraServices[$extraServiceKey];
                                        $selectedServices[] = [
                                            'name' => $service['name'],
                                            'price' => $service['price'],
                                            'quantity' => 1,
                                            'subtotal' => $service['price']
                                        ];
                                    }
                                }
                                
                                // Calculate subtotal
                                $subtotal = 0;
                                foreach ($selectedServices as $service) {
                                    $subtotal += $service['price'];
                                }
                                
                                // Calculate member discount
                                $memberDiscountRate = 0;
                                switch ($customerStatus) {
                                    case 'silver':
                                        $memberDiscountRate = 0.05;
                                        break;
                                    case 'gold':
                                        $memberDiscountRate = 0.10;
                                        break;
                                    case 'platinum':
                                        $memberDiscountRate = 0.15;
                                        break;
                                }
                                $memberDiscount = $subtotal * $memberDiscountRate;
                                
                                // Calculate visit discount
                                $visitDiscountRate = 0;
                                if ($visitCount >= 3 && $visitCount < 5) {
                                    $visitDiscountRate = 0.05;
                                } elseif ($visitCount >= 5 && $visitCount < 8) {
                                    $visitDiscountRate = 0.10;
                                } elseif ($visitCount >= 8) {
                                    $visitDiscountRate = 0.15;
                                }
                                $visitDiscount = $subtotal * $visitDiscountRate;
                                
                                // Calculate promo discount
                                $promoDiscountRate = 0;
                                $promoName = "Tidak ada";
                                
                                if ($promoCode === 'NEWCUSTOMER') {
                                    $promoDiscountRate = 0.10;
                                    $promoName = "NEWCUSTOMER (10%)";
                                } elseif ($promoCode === 'WEEKEND') {
                                    $promoDiscountRate = 0.05;
                                    $promoName = "WEEKEND (5%)";
                                } elseif ($promoCode === 'BIRTHDAY') {
                                    $promoDiscountRate = 0.15;
                                    $promoName = "BIRTHDAY (15%)";
                                }
                                
                                $promoDiscount = $subtotal * $promoDiscountRate;
                                
                                // Calculate total discount and final cost
                                $totalDiscount = $memberDiscount + $visitDiscount + $promoDiscount;
                                $totalCost = $subtotal - $totalDiscount;
                                
                                // Store the calculation in session for history
                                session_start();
                                if (!isset($_SESSION['simulationHistory'])) {
                                    $_SESSION['simulationHistory'] = [];
                                }
                                
                                $simulationResult = [
                                    'customerName' => $customerName,
                                    'customerPhone' => $customerPhone,
                                    'customerStatus' => $customerStatus,
                                    'selectedServices' => $selectedServices,
                                    'visitCount' => $visitCount,
                                    'subtotal' => $subtotal,
                                    'memberDiscount' => $memberDiscount,
                                    'visitDiscount' => $visitDiscount,
                                    'promoDiscount' => $promoDiscount,
                                    'totalDiscount' => $totalDiscount,
                                    'totalCost' => $totalCost,
                                    'date' => date('Y-m-d H:i:s')
                                ];
                                
                                array_unshift($_SESSION['simulationHistory'], $simulationResult);
                                
                                // Keep only the last 5 simulations in history
                                if (count($_SESSION['simulationHistory']) > 5) {
                                    array_pop($_SESSION['simulationHistory']);
                                }
                                
                                // Display results
                                echo '
                                <h5>Informasi Pelanggan:</h5>
                                <table class="table table-striped mb-4">
                                    <tr>
                                        <th>Nama Pelanggan</th>
                                        <td>'.htmlspecialchars($customerName).'</td>
                                    </tr>
                                    <tr>
                                        <th>No. Telepon</th>
                                        <td>'.htmlspecialchars($customerPhone).'</td>
                                    </tr>
                                    <tr>
                                        <th>Status Member</th>
                                        <td>'.getStatusLabel($customerStatus).'</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Kunjungan</th>
                                        <td>'.$visitCount.' kali per bulan</td>
                                    </tr>
                                </table>
                                
                                <h5>Detail Layanan:</h5>
                                <table class="table table-hover table-results">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Layanan</th>
                                            <th class="text-end">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                
                                foreach ($selectedServices as $index => $service) {
                                    echo '
                                    <tr>
                                        <td>'.($index + 1).'</td>
                                        <td>'.htmlspecialchars($service['name']).'</td>
                                        <td class="text-end">Rp '.number_format($service['price'], 0, ',', '.').'</td>
                                    </tr>';
                                }
                                
                                echo '
                                    </tbody>
                                    <tfoot>
                                        <tr class="total-row">
                                            <td colspan="2" class="text-end">Subtotal</td>
                                            <td class="text-end">Rp '.number_format($subtotal, 0, ',', '.').'</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                                <h5>Ringkasan Diskon:</h5>
                                <table class="table table-hover table-results">
                                    <tbody>
                                        <tr>
                                            <th>Diskon Member</th>
                                            <td class="text-end">Rp '.number_format($memberDiscount, 0, ',', '.').'</td>
                                        </tr>
                                        <tr>
                                            <th>Diskon Kunjungan</th>
                                            <td class="text-end">Rp '.number_format($visitDiscount, 0, ',', '.').'</td>
                                        </tr>
                                        <tr>
                                            <th>Diskon Promo</th>
                                            <td class="text-end">Rp '.number_format($promoDiscount, 0, ',', '.').'</td>
                                        </tr>
                                        <tr class="total-row">
                                            <th>Total Diskon</th>
                                            <td class="text-end">Rp '.number_format($totalDiscount, 0, ',', '.').'</td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                <div class="alert alert-success">
                                    <h5 class="alert-heading">Total Biaya:</h5>
                                    <h3 class="mb-0">Rp '.number_format($totalCost, 0, ',', '.').'</h3>
                                </div>
                                
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" id="bookButton">Lanjutkan Booking</button>
                                </div>
                                <script>
                                    document.getElementById("bookButton").addEventListener("click", function() {
                                        alert("Terima kasih! Data booking Anda telah disimpan.");
                                    });
                                </script>';
                            } else {
                                echo '<div class="alert alert-info">
                                    Silakan isi form di samping dan klik "Hitung Biaya" untuk melihat hasil perhitungan.
                                </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        Riwayat Simulasi
                    </div>
                    <div class="card-body" id="simulationHistory">
                        <?php
                        if (isset($_SESSION['simulationHistory']) && !empty($_SESSION['simulationHistory'])) {
                            echo '<div class="table-responsive">
                                <table class="table table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Nama</th>
                                            <th>Layanan</th>
                                            <th class="text-end">Total Biaya</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                            
                            foreach ($_SESSION['simulationHistory'] as $index => $simulation) {
                                $date = date('d M Y H:i', strtotime($simulation['date']));
                                echo '
                                <tr>
                                    <td>'.($index + 1).'</td>
                                    <td>'.$date.'</td>
                                    <td>'.htmlspecialchars($simulation['customerName']).'</td>
                                    <td>'.count($simulation['selectedServices']).' layanan</td>
                                    <td class="text-end">Rp '.number_format($simulation['totalCost'], 0, ',', '.').'</td>
                                </tr>';
                            }
                            
                            echo '</tbody>
                                </table>
                            </div>';
                        } else {
                            echo '<div class="alert alert-info">
                                Belum ada riwayat simulasi.
                            </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>Crown Barbershop</h5>
                    <p>Memberikan pengalaman grooming terbaik dengan layanan premium dan stylish untuk pria modern.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Informasi Kontak</h5>
                    <p>Jl. Merdeka No. 123, Jakarta</p>
                    <p>Telp: (021) 123-4567</p>
                    <p>Email: info@crownbarbershop.com</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Jam Operasional</h5>
                    <p>Senin - Jumat: 10:00 - 21:00</p>
                    <p>Sabtu - Minggu: 09:00 - 22:00</p>
                    <div class="social-icons">
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="copyright text-center">
                <p>&copy; 2025 Crown Barbershop. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
function getStatusLabel($status) {
    switch($status) {
        case 'regular':
            return 'Regular (Non-Member)';
        case 'silver':
            return 'Silver Member (Diskon 5%)';
        case 'gold':
            return 'Gold Member (Diskon 10%)';
        case 'platinum':
            return 'Platinum Member (Diskon 15%)';
        default:
            return 'Regular';
    }
}
?>