<?php
    session_start();
    require_once 'koneksi.php';
    require_once 'auth.php';
    requireRole('customer');
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Booking Haircut Delivery</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body {
      background-color: rgb(91, 91, 91);
    }
  </style>
</head>
<body>

<!-- Navbar -->
<?php require_once('Components/navbar.php'); ?>

<div class="container py-5 mt-5">
  <div class="card shadow rounded-4">
    <div class="card-body p-4">
      <h3 class="card-title text-center mb-4">Form Booking Haircut Delivery</h3>
      <form action="hasil_booking.php" method="POST">

        <!-- Data Pelanggan -->
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
          <label for="telepon" class="form-label">Nomor Telepon</label>
          <input type="tel" class="form-control" id="telepon" name="telepon" required>
        </div>

        <!-- Pilih Layanan Utama -->
        <h5 class="mt-4">Pilih Layanan</h5>
        <div class="mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="layanan[]" value="Haircut Standar" id="layanan1">
            <label class="form-check-label" for="layanan1">Haircut Standar</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="layanan[]" value="Haircut Premium" id="layanan2">
            <label class="form-check-label" for="layanan2">Haircut Premium</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="layanan[]" value="Trimming" id="layanan3">
            <label class="form-check-label" for="layanan3">Trimming</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="layanan[]" value="Coloring" id="layanan4">
            <label class="form-check-label" for="layanan4">Coloring</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="layanan[]" value="Styling" id="layanan5">
            <label class="form-check-label" for="layanan5">Styling</label>
          </div>
        </div>

        <!-- Pilih Layanan Tambahan -->
        <h5 class="mt-4">Pilih Layanan Tambahan</h5>
        <div class="mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="layanan_tambahan[]" value="Potong Jenggot" id="tambahan1">
            <label class="form-check-label" for="tambahan1">Potong Jenggot</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="layanan_tambahan[]" value="Hair Mask" id="tambahan2">
            <label class="form-check-label" for="tambahan2">Hair Mask</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="layanan_tambahan[]" value="Creambath" id="tambahan3">
            <label class="form-check-label" for="tambahan3">Creambath</label>
          </div>
        </div>

        <!-- Pilih Barberman -->
        <div class="mb-3">
          <label for="barber" class="form-label">Pilih Barberman</label>
          <select class="form-select" id="barber" name="barber">
            <option value="Irsyad">Irsyad</option>
            <option value="Fadhil">Fadhil</option>
            <option value="Gilang">Gilang</option>
          </select>
        </div>

        <!-- Jadwal Booking -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="tanggal" class="form-label">Tanggal Booking</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="waktu" class="form-label">Waktu Booking</label>
            <input type="time" class="form-control" id="waktu" name="waktu" required>
          </div>
        </div>

        <!-- Catatan -->
        <div class="mb-3">
          <label for="catatan" class="form-label">Catatan Tambahan</label>
          <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
        </div>

        <!-- Metode Pembayaran -->
        <div class="mb-3">
          <label class="form-label">Metode Pembayaran</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="pembayaran" id="cod" value="Bayar di Tempat" required>
            <label class="form-check-label" for="cod">Bayar di Tempat</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="pembayaran" id="transfer" value="Transfer" required>
            <label class="form-check-label" for="transfer">Transfer</label>
          </div>
        </div>

        <!-- Tombol -->
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <button type="reset" class="btn btn-outline-secondary">Reset</button>
          <button type="submit" class="btn btn-primary">Submit Booking</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="JS/interaktif.js"></script>
</body>
</html>
