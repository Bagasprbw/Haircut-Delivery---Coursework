<?php
session_start();
require_once 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'Customer') {
    header('Location: login.php');
    exit();
}

$id_user = $_SESSION['id_user'];

// Ambil data pesanan milik user ini
$pesanan_user = $koneksi->query("SELECT * FROM pesanan WHERE id_user = '$id_user' ORDER BY waktu DESC");
?>

<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background-color:rgb(9, 9, 9);
            color: #ffffff;
        }
        
        .container {
            background-color:#1f1f1f;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }
        
        .table {
            background-color: #2d2d2d;
            color: #ffffff;
            border-color: #404040;
        }
        
        .table thead th {
            background-color: #404040;
            border-color: #555555;
            color: #ffffff;
        }
        
        .table tbody td {
            border-color: #404040;
            background-color: #2d2d2d;
            color: #ffffff;
        }
        
        .table tbody tr:hover {
            background-color: #383838 !important;
        }
        
        /* Status row colors untuk dark theme */
        .table tbody tr.table-danger {
            background-color: #4a1e1e !important;
            color: #ffcccc;
        }
        
        .table tbody tr.table-warning {
            background-color: #4a3d1e !important;
            color: #fff3cd;
        }
        
        .table tbody tr.table-danger:hover {
            background-color: #5a2424 !important;
        }
        
        .table tbody tr.table-warning:hover {
            background-color: #5a4a24 !important;
        }
        
        .btn-success {
            background-color: #198754;
            border-color: #198754;
        }
        
        .btn-success:hover {
            background-color: #157347;
            border-color: #146c43;
        }
        
        .btn-outline-success {
            color: #198754;
            border-color: #198754;
        }
        
        .btn-outline-success:hover {
            background-color: #198754;
            border-color: #198754;
            color: #ffffff;
        }
        
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        
        .btn-danger:hover {
            background-color: #bb2d3b;
            border-color: #b02a37;
        }
        
        .text-muted {
            color: #adb5bd !important;
        }
        
        h2 {
            color: #ffffff;
            border-bottom: 2px solid #198754;
            padding-bottom: 0.5rem;
        }
        
        /* Badge colors untuk dark theme */
        .badge.bg-success {
            background-color: #198754 !important;
        }
        
        .badge.bg-info {
            background-color: #0dcaf0 !important;
            color: #000000;
        }
        
        .badge.bg-danger {
            background-color: #dc3545 !important;
        }
        
        .badge.bg-warning {
            background-color: #ffc107 !important;
            color: #000000;
        }
        
        .badge.bg-primary {
            background-color: #0d6efd !important;
        }
        
        .badge.bg-secondary {
            background-color: #6c757d !important;
        }
        
        /* Scrollbar styling untuk dark theme */
        ::-webkit-scrollbar {
            width: 12px;
        }
        
        ::-webkit-scrollbar-track {
            background: #2d2d2d;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #555555;
            border-radius: 6px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #777777;
        }
    </style>
</head>
<body>
    <?php include 'Components/navbar.php'; ?><br><br>
    <div class="container mt-5">
        <a href="index.php" class="btn btn-success mb-3">
            <i class="fas fa-arrow-left"></i> Back to home..
        </a>
        <h2 class="mb-4">
            <i class="fas fa-shopping-cart"></i> Pesanan Saya
        </h2>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag"></i> No</th>
                        <th><i class="fas fa-receipt"></i> ID Pesanan</th>
                        <th><i class="fas fa-calendar-alt"></i> Tanggal</th>
                        <th><i class="fas fa-percent"></i> Diskon</th>
                        <th><i class="fas fa-money-bill-wave"></i> Total Harga</th>
                        <th><i class="fas fa-info-circle"></i> Status</th>
                        <th><i class="fas fa-cogs"></i> Aksi</th>
                        <th><i class="fas fa-eye"></i> Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while ($row = $pesanan_user->fetch_assoc()): ?>
                        <?php
                            $status = $row['status_pesanan'];
                            $badge = 'secondary';
                            if ($status == 'Selesai') $badge = 'success';
                            elseif ($status == 'Diproses') $badge = 'info';
                            elseif ($status == 'Dibatalkan') $badge = 'danger';
                            elseif ($status == 'Menunggu Konfirmasi') $badge = 'warning';
                            elseif ($status == 'Dikonfirmasi') $badge = 'primary';

                            // warna tabel berdasarkan status
                            if ($status === 'Dibatalkan') {
                                $row_class = 'table-danger';
                            } elseif ($status !== 'Selesai') {
                                $row_class = 'table-warning';
                            } else {
                                $row_class = '';
                            }
                        ?>
                        <tr class="<?= $row_class ?>">
                            <td><?= $no++ ?></td>
                            <td><strong>#<?= $row['id_pesanan'] ?></strong></td>
                            <td>
                                <i class="fas fa-clock"></i> 
                                <?= date('d-m-Y H:i', strtotime($row['waktu'])) ?>
                            </td>
                            <td>
                                <i class="fas fa-tag text-success"></i> 
                                Rp <?= number_format($row['diskon'], 0, ',', '.') ?>
                            </td>
                            <td>
                                <strong>
                                    <i class="fas fa-rupiah-sign text-warning"></i> 
                                    Rp <?= number_format($row['total_harga'], 0, ',', '.') ?>
                                </strong>
                            </td>
                            <td>
                                <span class="badge bg-<?= $badge ?> px-3 py-2">
                                    <?php if ($status == 'Selesai'): ?>
                                        <i class="fas fa-check-circle"></i>
                                    <?php elseif ($status == 'Diproses'): ?>
                                        <i class="fas fa-spinner"></i>
                                    <?php elseif ($status == 'Dibatalkan'): ?>
                                        <i class="fas fa-times-circle"></i>
                                    <?php elseif ($status == 'Menunggu Konfirmasi'): ?>
                                        <i class="fas fa-hourglass-half"></i>
                                    <?php elseif ($status == 'Dikonfirmasi'): ?>
                                        <i class="fas fa-check"></i>
                                    <?php endif; ?>
                                    <?= $status ?>
                                </span>
                            </td>
                            <td>
                                <?php if (!in_array($status, ['Selesai', 'Dibatalkan'])): ?>
                                    <a href="Controller/pesanan_saya_controller.php?id=<?= $row['id_pesanan'] ?>&aksi=batal" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirm('Batalkan pesanan ini?')">
                                        <i class="fas fa-ban"></i> Batalkan
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">
                                        <i class="fas fa-minus"></i> Tidak ada aksi
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="detail_pesanan.php?id=<?= $row['id_pesanan'] ?>" 
                                   class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    <?php if ($pesanan_user->num_rows == 0): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="fas fa-shopping-cart fa-3x mb-3 d-block"></i>
                                <h5>Belum ada pesanan</h5>
                                <p>Anda belum memiliki pesanan apapun.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>