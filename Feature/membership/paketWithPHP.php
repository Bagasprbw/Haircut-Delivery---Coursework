<?php
// Data harga layanan
$servicesPrices = [
    'haircut' => 35000,
    'shaving' => 10000,
    'hairColoring' => 250000,
    'hairTreatment' => 150000,
    'headMassage' => 60000
];

// Data paket membership
$membershipPackages = [
    [
        'name' => 'Bronze', 
        'monthlyPrice' => 180000, 
        'services' => ['haircut' => 2, 'shaving' => 1], 
        'discount' => 0.1, 
        'recommended' => [1, 2]
    ],
    [
        'name' => 'Silver', 
        'monthlyPrice' => 320000, 
        'services' => ['haircut' => 3, 'shaving' => 2, 'hairTreatment' => 1], 
        'discount' => 0.15, 
        'recommended' => [3, 4]
    ],
    [
        'name' => 'Gold', 
        'monthlyPrice' => 550000, 
        'services' => ['haircut' => 4, 'shaving' => 4, 'hairColoring' => 1, 'headMassage' => 2], 
        'discount' => 0.2, 
        'recommended' => [5, 6]
    ]
];

// Keuntungan membership
$membershipBenefits = [
    ['icon' => 'fa-clock', 'text' => 'Prioritas booking tanpa antrian'],
    ['icon' => 'fa-percent', 'text' => 'Diskon untuk produk perawatan rambut'],
    ['icon' => 'fa-gift', 'text' => 'Bonus layanan setiap ulang tahun'],
    ['icon' => 'fa-user-friends', 'text' => 'Diskon untuk teman dan keluarga'],
    ['icon' => 'fa-glass-cheers', 'text' => 'Akses ke event eksklusif']
];

// Fungsi untuk memformat mata uang
function formatCurrency($amount) {
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

// Inisialisasi variabel hasil
$results = null;

// Proses form jika ada data yang dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $visitFrequency = intval($_POST['visitFrequency']);
    $membershipDuration = intval($_POST['membershipDuration']);
    
    // Mendapatkan layanan yang dipilih
    $selectedServices = [];
    $totalRegularPerVisit = 0;
    
    foreach ($servicesPrices as $serviceId => $price) {
        if (isset($_POST[$serviceId])) {
            $selectedServices[$serviceId] = true;
            $totalRegularPerVisit += $price;
        }
    }
    
    // Menghitung total biaya reguler
    $totalRegularPerMonth = $totalRegularPerVisit * $visitFrequency;
    $totalRegular = $totalRegularPerMonth * $membershipDuration;
    
    // Menentukan paket membership yang direkomendasikan
    $recommendedPackage = null;
    foreach ($membershipPackages as $pkg) {
        if (in_array($visitFrequency, $pkg['recommended'])) {
            $recommendedPackage = $pkg;
            break;
        }
    }
    
    // Jika tidak ada rekomendasi khusus, pilih berdasarkan frekuensi
    if (!$recommendedPackage) {
        if ($visitFrequency <= 2) {
            $recommendedPackage = $membershipPackages[0]; // Bronze
        } elseif ($visitFrequency <= 4) {
            $recommendedPackage = $membershipPackages[1]; // Silver
        } else {
            $recommendedPackage = $membershipPackages[2]; // Gold
        }
    }
    
    // Menghitung biaya membership
    $membershipPricePerMonth = $recommendedPackage['monthlyPrice'];
    
    // Diskon untuk durasi panjang
    $durationDiscount = 0;
    if ($membershipDuration === 3) {
        $durationDiscount = 0.05; // 5% untuk 3 bulan
    } elseif ($membershipDuration === 6) {
        $durationDiscount = 0.1; // 10% untuk 6 bulan
    } elseif ($membershipDuration === 12) {
        $durationDiscount = 0.15; // 15% untuk 12 bulan
    }
    
    // Hitung total membership dengan diskon durasi
    $discountedMonthlyPrice = $membershipPricePerMonth * (1 - $durationDiscount);
    $totalMembership = $discountedMonthlyPrice * $membershipDuration;
    
    // Hitung penghematan
    $totalSavings = $totalRegular - $totalMembership;
    $savingsPercentage = ($totalSavings / $totalRegular) * 100;
    
    // Siapkan data hasil
    $results = [
        'visitFrequency' => $visitFrequency,
        'membershipDuration' => $membershipDuration,
        'regularMonthly' => $totalRegularPerMonth,
        'membershipMonthly' => $discountedMonthlyPrice,
        'totalRegular' => $totalRegular,
        'totalMembership' => $totalMembership,
        'totalSavings' => $totalSavings,
        'savingsPercentage' => $savingsPercentage,
        'recommendedPackage' => $recommendedPackage,
        'monthlyResults' => []
    ];
    
    // Isi array dengan data bulanan
    for ($i = 1; $i <= $membershipDuration; $i++) {
        $results['monthlyResults'][] = [
            'month' => $i,
            'regularPrice' => $totalRegularPerMonth,
            'membershipPrice' => $discountedMonthlyPrice,
            'savings' => $totalRegularPerMonth - $discountedMonthlyPrice
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TRIMCORNER - Simulasi Membership Barbershop</title>
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <style>
            :root {
                --primary: #1a1a1a;
                --secondary: #c59d5f;
                --light: #f8f9fa;
                --dark: #212529;
            }
            
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f5f5f5;
            }
            
            .hero {
                background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('/img/bg-header.jpg');
                background-size: cover;
                background-position: center;
                height: 600px;
                padding: 100px 0;
                color: white;
            }
            
            .section-title {
                position: relative;
                padding-bottom: 15px;
                margin-bottom: 30px;
            }
            
            .section-title::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100px;
                height: 3px;
                background-color: #0a58ca;
            }
            
            .card {
                border: none;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s;
                margin-bottom: 20px;
            }
            
            .card:hover {
                transform: translateY(-5px);
            }
            
            .card-header {
                background-color: var(--primary);
                color: white;
                font-weight: 600;
                text-align: center;
                padding: 15px;
            }
            
            .form-label {
                font-weight: 500;
            }
            
            /* .btn-primary {
                background-color: var(--secondary);
                border-color: var(--secondary);
                font-weight: 500;
                padding: 10px 25px;
            }
            
            .btn-primary:hover {
                background-color: #b38d4f;
                border-color: #b38d4f;
            } */
            
            .table-striped tbody tr:nth-of-type(odd) {
                background-color: rgba(197, 157, 95, 0.1);
            }
            
            .price {
                font-size: 18px;
                font-weight: 600;
                color: var(--secondary);
            }
            
            .savings {
                font-size: 18px;
                font-weight: 600;
                color: #28a745;
            }
            
            footer {
                background-color: var(--primary);
                color: white;
                padding: 40px 0 20px;
            }
            
            .footer-heading {
                color: var(--secondary);
                font-weight: 600;
                margin-bottom: 20px;
            }
            
            .footer-link {
                color: rgba(255, 255, 255, 0.7);
                transition: all 0.3s;
                display: block;
                margin-bottom: 10px;
                text-decoration: none;
            }
            
            .footer-link:hover {
                color: var(--secondary);
                text-decoration: none;
            }
            
            .social-links a {
                display: inline-block;
                width: 36px;
                height: 36px;
                background-color: rgba(255, 255, 255, 0.1);
                text-align: center;
                line-height: 36px;
                border-radius: 50%;
                color: white;
                margin-right: 10px;
                transition: all 0.3s;
            }
            
            .social-links a:hover {
                background-color: var(--secondary);
            }
            
            .copyright {
                border-top: 1px solid rgba(255, 255, 255, 0.1);
                padding-top: 20px;
                margin-top: 40px;
            }
            
            .service-checkbox {
                margin-right: 10px;
            }
            
            #resultContainer {
                display: none;
            }
            
            .recommendation-box {
                background-color: #f8f9fa;
                border-left: 5px solid var(--secondary);
                padding: 15px;
                margin-top: 15px;
            }
            
            .benefit-item {
                display: flex;
                align-items: center;
                margin-bottom: 10px;
            }
            
            .benefit-icon {
                color: var(--secondary);
                margin-right: 10px;
                font-size: 18px;
            }
        </style>
        <!-- <link rel="stylesheet" href="/CSS/style.css"> -->
    </head>
<body>
    <!-- Header -->
    <?php require_once('navbar.php'); ?>


    <!-- Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row pt-5">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-3">Simulasi Membership TRIMCORNER</h1>
                    <p class="lead mb-4">Hitung penghematan Anda dengan paket membership eksklusif kami. Dapatkan layanan premium dengan harga terbaik.</p>
                    <a href="#simulator" class="btn btn-primary btn-lg">Hitung Sekarang</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Simulator Section -->
    <section id="simulator" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <h2 class="section-title">Simulasi Membership</h2>
                    <p>Gunakan simulator ini untuk menghitung penghematan yang Anda dapatkan dengan berbagai paket membership kami.</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            Form Simulasi
                        </div>
                        <div class="card-body">
                            <form id="membershipForm" method="POST">
                                <div class="mb-3">
                                    <label for="visitFrequency" class="form-label">Frekuensi Kunjungan per Bulan</label>
                                    <select class="form-select" id="visitFrequency" name="visitFrequency" required>
                                        <option value="" selected disabled>Pilih frekuensi...</option>
                                        <option value="1" <?= isset($_POST['visitFrequency']) && $_POST['visitFrequency'] == '1' ? 'selected' : '' ?>>1 kali</option>
                                        <option value="2" <?= isset($_POST['visitFrequency']) && $_POST['visitFrequency'] == '2' ? 'selected' : '' ?>>2 kali</option>
                                        <option value="3" <?= isset($_POST['visitFrequency']) && $_POST['visitFrequency'] == '3' ? 'selected' : '' ?>>3 kali</option>
                                        <option value="4" <?= isset($_POST['visitFrequency']) && $_POST['visitFrequency'] == '4' ? 'selected' : '' ?>>4 kali</option>
                                        <option value="5" <?= isset($_POST['visitFrequency']) && $_POST['visitFrequency'] == '5' ? 'selected' : '' ?>>5 kali</option>
                                        <option value="6" <?= isset($_POST['visitFrequency']) && $_POST['visitFrequency'] == '6' ? 'selected' : '' ?>>6 kali</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="membershipDuration" class="form-label">Durasi Membership</label>
                                    <select class="form-select" id="membershipDuration" name="membershipDuration" required>
                                        <option value="" selected disabled>Pilih durasi...</option>
                                        <option value="1" <?= isset($_POST['membershipDuration']) && $_POST['membershipDuration'] == '1' ? 'selected' : '' ?>>1 bulan</option>
                                        <option value="2" <?= isset($_POST['membershipDuration']) && $_POST['membershipDuration'] == '2' ? 'selected' : '' ?>>2 bulan</option>
                                        <option value="3" <?= isset($_POST['membershipDuration']) && $_POST['membershipDuration'] == '3' ? 'selected' : '' ?>>3 bulan</option>
                                        <option value="6" <?= isset($_POST['membershipDuration']) && $_POST['membershipDuration'] == '6' ? 'selected' : '' ?>>6 bulan</option>
                                        <option value="12" <?= isset($_POST['membershipDuration']) && $_POST['membershipDuration'] == '12' ? 'selected' : '' ?>>12 bulan</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Layanan yang Sering Digunakan</label>
                                    <div class="form-check">
                                        <input class="form-check-input service-checkbox" type="checkbox" id="haircut" name="haircut" <?= isset($_POST['haircut']) ? 'checked' : 'checked' ?>>
                                        <label class="form-check-label" for="haircut">
                                            Haircut (Rp 75.000)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input service-checkbox" type="checkbox" id="shaving" name="shaving" <?= isset($_POST['shaving']) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="shaving">
                                            Shaving (Rp 50.000)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input service-checkbox" type="checkbox" id="hairColoring" name="hairColoring" <?= isset($_POST['hairColoring']) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="hairColoring">
                                            Hair Coloring (Rp 250.000)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input service-checkbox" type="checkbox" id="hairTreatment" name="hairTreatment" <?= isset($_POST['hairTreatment']) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="hairTreatment">
                                            Hair Treatment (Rp 150.000)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input service-checkbox" type="checkbox" id="headMassage" name="headMassage" <?= isset($_POST['headMassage']) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="headMassage">
                                            Head Massage (Rp 60.000)
                                        </label>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary w-100">Hitung Simulasi</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-7">
                    <div id="resultContainer" style="<?= $results ? 'display: block;' : 'display: none;' ?>">
                        <?php if ($results): ?>
                        <div class="card">
                            <div class="card-header">
                                Hasil Simulasi Membership
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <h5>Ringkasan Simulasi:</h5>
                                    <p>Berikut adalah perbandingan biaya reguler vs membership berdasarkan input Anda:</p>
                                </div>
                                
                                <div class="table-responsive mb-4">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Periode</th>
                                                <th>Biaya Reguler</th>
                                                <th>Biaya Membership</th>
                                                <th>Penghematan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="resultTable">
                                            <?php foreach ($results['monthlyResults'] as $result): ?>
                                            <tr>
                                                <td>Bulan <?= $result['month'] ?></td>
                                                <td><?= formatCurrency($result['regularPrice']) ?></td>
                                                <td><?= formatCurrency($result['membershipPrice']) ?></td>
                                                <td><?= formatCurrency($result['savings']) ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <tr class="fw-bold">
                                                <td>Total <?= $results['membershipDuration'] ?> Bulan</td>
                                                <td><?= formatCurrency($results['totalRegular']) ?></td>
                                                <td><?= formatCurrency($results['totalMembership']) ?></td>
                                                <td><?= formatCurrency($results['totalSavings']) ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body text-center">
                                                <h5>Total Biaya Reguler</h5>
                                                <p class="price" id="totalRegularPrice"><?= formatCurrency($results['totalRegular']) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body text-center">
                                                <h5>Total Biaya Membership</h5>
                                                <p class="price" id="totalMembershipPrice"><?= formatCurrency($results['totalMembership']) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card mt-3 bg-light">
                                    <div class="card-body text-center">
                                        <h5>Total Penghematan</h5>
                                        <p class="savings" id="totalSavings"><?= formatCurrency($results['totalSavings']) ?></p>
                                        <p id="savingsPercentage">Anda menghemat <?= number_format($results['savingsPercentage'], 1) ?>% dengan paket membership!</p>
                                    </div>
                                </div>
                                
                                <div id="recommendationBox" class="recommendation-box mt-4">
                                    <h5>Rekomendasi Paket</h5>
                                    <p id="recommendationText">
                                        Berdasarkan frekuensi kunjungan Anda (<?= $results['visitFrequency'] ?>x per bulan) dan layanan yang dipilih, 
                                        kami merekomendasikan paket <strong><?= $results['recommendedPackage']['name'] ?></strong> dengan harga 
                                        <?= formatCurrency($results['recommendedPackage']['monthlyPrice']) ?>/bulan.
                                        <br><br>
                                        Dengan durasi <?= $results['membershipDuration'] ?> bulan, Anda mendapatkan diskon tambahan, sehingga harga efektif menjadi 
                                        <?= formatCurrency($results['membershipMonthly']) ?>/bulan.
                                    </p>
                                    
                                    <h6 class="mt-3">Keuntungan Membership:</h6>
                                    <div id="benefitsList">
                                        <?php foreach ($membershipBenefits as $benefit): ?>
                                        <div class="benefit-item">
                                            <i class="fas <?= $benefit['icon'] ?> benefit-icon"></i>
                                            <span><?= $benefit['text'] ?></span>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Membership Packages -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <h2 class="section-title">Paket Membership Kami</h2>
                    <p>Pilih paket membership yang sesuai dengan kebutuhan Anda.</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center h-100">
                        <div class="card-header">
                            Bronze
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Rp 180.000<small>/bulan</small></h3>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>2x Haircut</li>
                                <li>1x Shaving</li>
                                <li>10% diskon produk</li>
                                <li>-</li>
                                <li>-</li>
                            </ul>
                            <a href="#simulator" class="btn btn-primary">Pilih Paket</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card text-center h-100">
                        <div class="card-header">
                            Silver
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Rp 320.000<small>/bulan</small></h3>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>3x Haircut</li>
                                <li>2x Shaving</li>
                                <li>1x Hair Treatment</li>
                                <li>15% diskon produk</li>
                                <li>-</li>
                            </ul>
                            <a href="#simulator" class="btn btn-primary">Pilih Paket</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card text-center h-100">
                        <div class="card-header">
                            Gold
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Rp 550.000<small>/bulan</small></h3>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>4x Haircut</li>
                                <li>4x Shaving</li>
                                <li>1x Hair Coloring</li>
                                <li>2x Head Massage</li>
                                <li>20% diskon produk</li>
                            </ul>
                            <a href="#simulator" class="btn btn-primary">Pilih Paket</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require_once('../../Components/footer.php'); ?>

    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../JS/interaktif.js"></script>
</body>
</html>