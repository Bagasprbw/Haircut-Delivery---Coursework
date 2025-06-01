<?php
session_start();
require_once 'koneksi.php';
require_once 'auth.php';
requireRole('Customer');

$layanan_utama = mysqli_query($koneksi, "SELECT * FROM layanan WHERE kategori != 'Layanan Tambahan' ORDER BY kategori, nama_layanan");
$layanan_tambahan = mysqli_query($koneksi, "SELECT * FROM layanan WHERE kategori = 'Layanan Tambahan' ORDER BY kategori, nama_layanan");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Booking Haircut Delivery</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
    }
    
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .card-header {
      background: linear-gradient(45deg, #667eea, #764ba2);
      border-radius: 15px 15px 0 0 !important;
    }
    
    .form-control, .form-select {
      border-radius: 10px;
      border: 2px solid #e9ecef;
    }
    
    .form-control:focus, .form-select:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .btn-primary {
      background: linear-gradient(45deg, #667eea, #764ba2);
      border: none;
      border-radius: 10px;
    }
    
    .service-card {
      cursor: pointer;
      transition: all 0.3s ease;
      border-radius: 10px;
    }
    
    .service-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    .service-card.selected {
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card">
        <!-- Header -->
        <div class="card-header text-white text-center py-4">
          <h2 class="mb-1"><i class="fas fa-cut me-3"></i>Booking Haircut Delivery</h2>
          <p class="mb-0 opacity-75">Layanan cukur profesional langsung ke rumah Anda</p>
        </div>
        
        <div class="card-body p-4">
          <form action="Controller/booking_controller.php" method="POST">
            
            <!-- Data Pelanggan -->
            <div class="mb-4">
              <h5 class="text-primary mb-3">
                <i class="fas fa-user me-2"></i>Informasi Pelanggan
              </h5>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="telepon" class="form-label fw-semibold">Nomor Telepon</label>
                  <input type="tel" class="form-control" id="telepon" name="telepon" placeholder="08123456789" required>
                </div>
                  <div class="col-md-12 mb-3">
                    <label for="alamat" class="form-label fw-semibold">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Masukkan alamat lengkap Anda..." required></textarea>
                  </div>  
              </div>  
            </div>

            <!-- Layanan Utama -->
            <div class="mb-4">
              <h5 class="text-primary mb-3">
                <i class="fas fa-scissors me-2"></i>Pilih Layanan Utama
              </h5>
              <div class="row g-3">
                <?php while ($row = mysqli_fetch_assoc($layanan_utama)): ?>
                  <div class="col-md-4">
                    <div class="card service-card h-100" onclick="toggleService(this, '<?= $row['id_layanan'] ?>')">
                      <div class="card-body">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="layanan[]" id="<?= $row['id_layanan'] ?>" value="<?= $row['nama_layanan'] ?>">
                          <label class="form-check-label fw-semibold" for="<?= $row['id_layanan'] ?>">
                            <?= $row['nama_layanan'] ?> - Rp<?= number_format($row['harga_layanan']) ?>
                          </label>
                        </div>
                        <small class="text-muted"><?= $row['deskripsi'] ?></small>
                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>
              </div>
            </div>


                        <!-- Layanan Tambahan -->
            <div class="mb-4">
              <h5 class="text-primary mb-3">
                <i class="fas fa-plus-circle me-2"></i>Layanan Tambahan
              </h5>
              <div class="row g-3">
                <?php while ($row = mysqli_fetch_assoc($layanan_tambahan)): ?>
                  <div class="col-md-4">
                    <div class="card service-card h-100" onclick="toggleService(this, '<?= $row['id_layanan'] ?>')">
                      <div class="card-body">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="layanan_tambahan[]" id="<?= $row['id_layanan'] ?>" value="<?= $row['nama_layanan'] ?>">
                          <label class="form-check-label fw-semibold" for="<?= $row['id_layanan'] ?>">
                            <?= $row['nama_layanan'] ?> - Rp<?= number_format($row['harga_layanan']) ?>
                          </label>
                        </div>
                        <small class="text-muted"><?= $row['deskripsi'] ?></small>
                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>
              </div>
            </div>


            <!-- Jadwal Booking -->
            <div class="mb-4">
              <h5 class="text-primary mb-3">
                <i class="fas fa-calendar-alt me-2"></i>Jadwal Booking
              </h5>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="tanggal" class="form-label fw-semibold">Tanggal Booking</label>
                  <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="diskon" class="form-label fw-semibold">Kode Diskon</label>
                  <input type="text" class="form-control" id="diskon" name="diskon" placeholder="Masukkan kode diskon jika ada">
                </div>
              </div>
            </div>

            <!-- Catatan -->
            <div class="mb-4">
              <h5 class="text-primary mb-3">
                <i class="fas fa-sticky-note me-2"></i>Catatan Tambahan
              </h5>
              <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Tambahkan catatan khusus atau permintaan spesial..."></textarea>
            </div>

            <!-- Metode Pembayaran -->
            <div class="mb-4">
              <h5 class="text-primary mb-3">
                <i class="fas fa-credit-card me-2"></i>Metode Pembayaran
              </h5>
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="card service-card text-center" onclick="selectPayment(this, 'cod')">
                    <div class="card-body">
                      <i class="fas fa-money-bill-wave fa-2x text-success mb-2"></i>
                      <h6 class="card-title">Bayar di Tempat</h6>
                      <input type="radio" name="pembayaran" id="cod" value="Bayar di Tempat" class="d-none" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card service-card text-center" onclick="selectPayment(this, 'transfer')">
                    <div class="card-body">
                      <i class="fas fa-university fa-2x text-info mb-2"></i>
                      <h6 class="card-title">Transfer Bank</h6>
                      <input type="radio" name="pembayaran" id="transfer" value="Transfer" class="d-none" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tombol -->
            <div class="d-flex gap-2 justify-content-end">
              <button type="reset" class="btn btn-outline-secondary">
                <i class="fas fa-redo me-1"></i>Reset
              </button>
              <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-paper-plane me-1"></i>Submit Booking
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
  function toggleService(card, checkboxId) {
    const checkbox = document.getElementById(checkboxId);
    checkbox.checked = !checkbox.checked;
    
    card.classList.toggle('selected', checkbox.checked);
  }
  
  function selectBarber(card, barberName) {
    document.querySelectorAll('[onclick*="selectBarber"]').forEach(el => el.classList.remove('selected'));
    card.classList.add('selected');
    document.getElementById('barber').value = barberName;
  }
  
  function selectPayment(card, paymentId) {
    document.querySelectorAll('[onclick*="selectPayment"]').forEach(el => el.classList.remove('selected'));
    card.classList.add('selected');
    document.getElementById(paymentId).checked = true;
  }
  
  // Set minimum date dan auto-select first barber
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('tanggal').min = new Date().toISOString().split('T')[0];
    document.querySelector('[onclick*="Irsyad"]').click();
  });
</script>

</body>
</html>