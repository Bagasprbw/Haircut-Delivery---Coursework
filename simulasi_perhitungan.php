<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haircut Delivery - Kalkulator Biaya</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color:rgb(91, 91, 91);
        }
        .form-container, .result-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            padding: 25px;
            height: 100%;
        }
        .form-label {
            font-weight: 500;
        }
        .service-option {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            transition: all 0.3s;
        }
        .service-option:hover {
            background-color: #f8f9fa;
        }
        .form-check-input:checked + .service-option {
            /* border-color: #6f42c1; */
            border-color: #0d6efd;
            background-color: #f1e8ff;
        }
        .result-placeholder {
            /* display: flex;
            align-items: center;
            justify-content: center; */
            height: 100%;
            min-height: 300px;
            background-color: #f1e8ff;
            border-radius: 8px;
            text-align: center;
            padding: 20px;
        }
        .sticky-result {
            position: sticky;
            top: 20px;
        }
        @media (max-width: 991.98px) {
            .result-col {
                margin-top: 30px;
            }
        }
    </style>
</head>
<body>
    
    <?php require_once('Components/navbar.php'); ?>
    <main style="margin: 100px 50px; ">
    <div class="row">
            <!-- Kolom Kiri - Form Input -->
            <div class="col-lg-7">
                <div class="form-container">
                    <h3 class="text-center mb-4">Form Pemesanan [SIMULASI PERHITUNGAN]</h3>
                    
                    <form method="post" action="" id="orderForm">
                        <!-- Data Pelanggan -->
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="telp" class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control" id="telp" name="telp" required>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="2" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="jarak" class="form-label">
                                Jarak (KM) <small class="fw-light fst-italic"><span class="text-danger">*</span>Kedepannya otomatis oleh sistem</small>
                            </label>
                            <input type="number" class="form-control" id="jarak" name="jarak" min="1" max="50" required>
                        </div>
                        
                        <!-- Layanan Utama (Multi Choice) -->
                        <div class="mb-3">
                            <label class="form-label">Pilih Layanan</label>
                            <small class="text-muted d-block mb-2">(Bisa memilih lebih dari satu)</small>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check p-0 mb-2">
                                        <input class="form-check-input d-none" type="checkbox" name="layanan[]" id="standar" value="standar">
                                        <label class="form-check-label w-100 service-option" for="standar">
                                            <strong>Haircut Standar</strong> - Rp 50.000<br>
                                            <small>Potong rambut dasar</small>
                                        </label>
                                    </div>
                                    
                                    <div class="form-check p-0 mb-2">
                                        <input class="form-check-input d-none" type="checkbox" name="layanan[]" id="premium" value="premium">
                                        <label class="form-check-label w-100 service-option" for="premium">
                                            <strong>Haircut Premium</strong> - Rp 80.000<br>
                                            <small>Keramas + Styling</small>
                                        </label>
                                    </div>
                                    
                                    <div class="form-check p-0 mb-2">
                                        <input class="form-check-input d-none" type="checkbox" name="layanan[]" id="triming" value="triming">
                                        <label class="form-check-label w-100 service-option" for="triming">
                                            <strong>Trimming</strong> - Rp 40.000<br>
                                            <small>Rapikan ujung rambut</small>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-check p-0 mb-2">
                                        <input class="form-check-input d-none" type="checkbox" name="layanan[]" id="shaving" value="shaving">
                                        <label class="form-check-label w-100 service-option" for="shaving">
                                            <strong>Shaving</strong> - Rp 35.000<br>
                                            <small>Cukur rambut</small>
                                        </label>
                                    </div>
                                    
                                    <div class="form-check p-0 mb-2">
                                        <input class="form-check-input d-none" type="checkbox" name="layanan[]" id="styling" value="styling">
                                        <label class="form-check-label w-100 service-option" for="styling">
                                            <strong>Styling</strong> - Rp 60.000<br>
                                            <small>Penataan rambut</small>
                                        </label>
                                    </div>
                                    
                                    <div class="form-check p-0 mb-2">
                                        <input class="form-check-input d-none" type="checkbox" name="layanan[]" id="coloring" value="coloring">
                                        <label class="form-check-label w-100 service-option" for="coloring">
                                            <strong>Coloring</strong> - Rp 120.000<br>
                                            <small>Pewarnaan rambut</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tambahan Layanan -->
                        <div class="mb-3">
                            <label class="form-label">Tambahan Layanan</label>
                            <small class="text-muted d-block mb-2">(Opsional)</small>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check p-0 mb-2">
                                        <input class="form-check-input d-none" type="checkbox" name="tambahan[]" id="creambath" value="creambath">
                                        <label class="form-check-label w-100 service-option" for="creambath">
                                            <strong>Creambath</strong> - Rp 30.000<br>
                                            <small>Perawatan rambut</small>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-check p-0 mb-2">
                                        <input class="form-check-input d-none" type="checkbox" name="tambahan[]" id="potong_jenggot" value="potong_jenggot">
                                        <label class="form-check-label w-100 service-option" for="potong_jenggot">
                                            <strong>Potong Jenggot</strong> - Rp 25.000<br>
                                            <small>Merapikan jenggot</small>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-check p-0 mb-2">
                                        <input class="form-check-input d-none" type="checkbox" name="tambahan[]" id="hair_mask" value="hair_mask">
                                        <label class="form-check-label w-100 service-option" for="hair_mask">
                                            <strong>Hair Mask</strong> - Rp 45.000<br>
                                            <small>Nutrisi mendalam</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Kode Diskon -->
                        <div class="mb-4">
                            <label for="diskon" class="form-label">Kode Diskon (Jika Ada)</label>
                            <input type="text" class="form-control" id="diskon" name="diskon" placeholder="Masukkan kode diskon">
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg" name="hitung">Hitung Total Bayar</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Kolom Kanan - Hasil Perhitungan -->
            <div class="col-lg-5 result-col">
                <div class="result-container sticky-result">
                    <?php
                    if (isset($_POST['hitung'])) {
                        // Mengambil data dari form
                        $nama = htmlspecialchars($_POST['nama']);
                        $telp = htmlspecialchars($_POST['telp']);
                        $alamat = htmlspecialchars($_POST['alamat']);
                        $jarak = floatval($_POST['jarak']);
                        $layanan = isset($_POST['layanan']) ? $_POST['layanan'] : array();
                        $tambahan = isset($_POST['tambahan']) ? $_POST['tambahan'] : array();
                        $diskon = isset($_POST['diskon']) ? strtoupper($_POST['diskon']) : '';
                        
                        // Harga layanan utama
                        $harga_layanan = 0;
                        $daftar_layanan = array();
                        
                        if (in_array('standar', $layanan)) {
                            $harga_layanan += 50000;
                            $daftar_layanan[] = "Haircut Standar";
                        }
                        if (in_array('premium', $layanan)) {
                            $harga_layanan += 80000;
                            $daftar_layanan[] = "Haircut Premium";
                        }
                        if (in_array('triming', $layanan)) {
                            $harga_layanan += 40000;
                            $daftar_layanan[] = "Trimming";
                        }
                        if (in_array('shaving', $layanan)) {
                            $harga_layanan += 35000;
                            $daftar_layanan[] = "Shaving";
                        }
                        if (in_array('styling', $layanan)) {
                            $harga_layanan += 60000;
                            $daftar_layanan[] = "Styling";
                        }
                        if (in_array('coloring', $layanan)) {
                            $harga_layanan += 120000;
                            $daftar_layanan[] = "Coloring";
                        }
                        
                        // Hitung tambahan layanan
                        $harga_tambahan = 0;
                        $daftar_tambahan = array();
                        
                        if (in_array('creambath', $tambahan)) {
                            $harga_tambahan += 30000;
                            $daftar_tambahan[] = "Creambath";
                        }
                        if (in_array('potong_jenggot', $tambahan)) {
                            $harga_tambahan += 25000;
                            $daftar_tambahan[] = "Potong Jenggot";
                        }
                        if (in_array('hair_mask', $tambahan)) {
                            $harga_tambahan += 45000;
                            $daftar_tambahan[] = "Hair Mask";
                        }
                        
                        // Hitung biaya transport
                        $biaya_transport = 10000; // Biaya dasar
                        $biaya_transport += ($jarak > 5) ? ($jarak - 5) * 2000 : 0;
                        
                        // Subtotal
                        $subtotal = $harga_layanan + $harga_tambahan + $biaya_transport;
                        
                        // Hitung diskon
                        $diskon_persen = 0;
                        if ($diskon == 'HAIRCUT10') {
                            $diskon_persen = 10;
                        } elseif ($diskon == 'HAIRCUT20') {
                            $diskon_persen = 20;
                        } elseif ($diskon == 'NEWUSER15') {
                            $diskon_persen = 15;
                        }
                        
                        $jumlah_diskon = $subtotal * $diskon_persen / 100;
                        $total = $subtotal - $jumlah_diskon;
                        
                        // Fungsi format rupiah
                        function formatRupiah($angka) {
                            return 'Rp ' . number_format($angka, 0, ',', '.');
                        }
                    ?>
                    
                    <div class="result-section">
                        <h4 class="text-center mb-3">Rincian Biaya</h4>
                        
                        <div class="mb-3">
                            <p><strong>Nama:</strong> <?php echo $nama; ?></p>
                            <p><strong>Telepon:</strong> <?php echo $telp; ?></p>
                            <p><strong>Alamat:</strong> <?php echo $alamat; ?></p>
                            <p><strong>Jarak:</strong> <?php echo $jarak; ?> km</p>
                        </div>
                        
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Item</th>
                                    <th class="text-end">Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                            <!-- menampilkan daftar pesanan (layanan utama) -->
                                <?php if (!empty($daftar_layanan)): ?>
                                    <?php foreach ($daftar_layanan as $item): ?>
                                        <tr>
                                            <td><?php echo $item; ?></td>
                                            <td class="text-end">
                                                <?php 
                                                    if ($item == "Haircut Standar") echo formatRupiah(50000);
                                                    elseif ($item == "Haircut Premium") echo formatRupiah(80000);
                                                    elseif ($item == "Trimming") echo formatRupiah(40000);
                                                    elseif ($item == "Shaving") echo formatRupiah(35000);
                                                    elseif ($item == "Styling") echo formatRupiah(60000);
                                                    elseif ($item == "Coloring") echo formatRupiah(120000);
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                
                                <!-- menampilkan daftar pesanan (layanan tambahan) -->
                                <?php if (!empty($daftar_tambahan)): ?>
                                    <?php foreach ($daftar_tambahan as $item): ?>
                                        <tr>
                                            <td><?php echo $item; ?></td>
                                            <td class="text-end">
                                                <?php 
                                                    if ($item == "Creambath") echo formatRupiah(30000);
                                                    elseif ($item == "Potong Jenggot") echo formatRupiah(25000);
                                                    elseif ($item == "Hair Mask") echo formatRupiah(45000);
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                
                                <tr>
                                    <td>Biaya Transport (<?php echo $jarak; ?> km)</td>
                                    <td class="text-end"><?php echo formatRupiah($biaya_transport); ?></td>
                                </tr>
                                
                                <tr class="table-active">
                                    <td><strong>Subtotal</strong></td>
                                    <td class="text-end"><strong><?php echo formatRupiah($subtotal); ?></strong></td>
                                </tr>
                                
                                <?php if ($diskon_persen > 0): ?>
                                    <tr>
                                        <td>Diskon (<?php echo $diskon_persen; ?>%)</td>
                                        <td class="text-end">-<?php echo formatRupiah($jumlah_diskon); ?></td>
                                    </tr>
                                <?php endif; ?>
                                
                                <tr class="table-success">
                                    <td><strong>TOTAL BAYAR</strong></td>
                                    <td class="text-end"><strong><?php echo formatRupiah($total); ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div class="alert alert-info mt-3">
                            <p class="mb-1"><strong>Informasi:</strong></p>
                            <ul class="mb-0">
                                <li>Biaya transport: Rp 10.000 (5 km pertama) + Rp 2.000/km berikutnya</li>
                                <li>Kode diskon: HAIRCUT10, HAIRCUT20, NEWUSER15</li>
                            </ul>
                        </div>
                    </div>
                    <?php } else { ?>
                        <div class="result-placeholder">
                            <div>
                                <h4>Hasil Perhitungan</h4>
                                <p class="text-muted">Formulir di sebelah kiri akan menampilkan rincian biaya di sini setelah dihitung</p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    </main>

    <?php require_once('Components/footer.php'); ?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="JS/interaktif.js"></script>
    <script>
        // Menambahkan efek visual saat memilih layanan
        document.querySelectorAll('.form-check-input').forEach(input => {
            input.addEventListener('change', function() {
                const label = document.querySelector(label[for="${this.id}"]);
                if (this.checked) {
                    label.classList.add('selected');
                } else {
                    label.classList.remove('selected');
                }
            });
        });

        // Scroll ke hasil setelah submit
        document.getElementById('orderForm').addEventListener('submit', function() {
            setTimeout(() => {
                document.querySelector('.result-col').scrollIntoView({ behavior: 'smooth' });
            }, 100);
        });
    </script>
</body>
</html>