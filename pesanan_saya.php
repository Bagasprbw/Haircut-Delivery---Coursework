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
            background-color: rgb(9, 9, 9);
            color: #ffffff;
        }

        .container {
            background-color: #1f1f1f;
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

        /* Modal styling untuk dark theme */
        .modal-content {
            background-color: #2d2d2d;
            border-color: #404040;
        }

        .modal-header {
            border-bottom-color: #404040;
        }

        .modal-footer {
            border-top-color: #404040;
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

        /* Loading spinner styling */
        .loading-spinner {
            text-align: center;
            padding: 3rem 2rem;
        }

        .loading-spinner .spinner-border {
            animation: spin 1s linear infinite;
        }

        .progress-bar-animated {
            animation: progress-bar-stripes 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes progress-bar-stripes {
            0% { background-position: 1rem 0; }
            100% { background-position: 0 0; }
        }

        /* Fade in animation */
        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>
    <?php include 'Components/navbar.php'; ?><br><br>
    <div class="container mt-5 fade-in">
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
                    <?php $no = 1;
                    while ($row = $pesanan_user->fetch_assoc()): ?>
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
                                <button type="button" class="btn btn-sm btn-outline-success" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#detailModal"
                                        onclick="loadDetailPesanan('<?= $row['id_pesanan'] ?>')">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
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

    <!-- Modal Detail Pesanan -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">
                        <i class="fas fa-receipt"></i> Detail Pesanan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalContent">
                    <!-- Initial content akan di-replace oleh JavaScript -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function loadDetailPesanan(idPesanan) {
            const modalContent = document.getElementById('modalContent');
            const modalTitle = document.getElementById('detailModalLabel');
            
            // Update modal title
            modalTitle.innerHTML = '<i class="fas fa-receipt"></i> Detail Pesanan #' + idPesanan;
            
            // Show loading spinner with animation
            modalContent.innerHTML = `
                <div class="loading-spinner text-center py-5">
                    <div class="spinner-border text-success mb-3" role="status" style="width: 3rem; height: 3rem;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h5 class="text-success">Memuat Detail Pesanan...</h5>
                    <p class="text-muted">Mohon tunggu sebentar</p>
                    <div class="progress mt-3" style="height: 8px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
                            role="progressbar" style="width: 100%"></div>
                    </div>
                </div>
            `;

            // Add minimum loading time untuk UX yang lebih baik (1.5 detik)
            const minimumLoadTime = 1000;
            const startTime = Date.now();

            // Fetch detail pesanan via AJAX
            fetch(`get_detail_pesanan.php?id=${idPesanan}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    const elapsedTime = Date.now() - startTime;
                    const remainingTime = Math.max(0, minimumLoadTime - elapsedTime);
                    
                    // Tunggu sisa waktu minimum loading
                    setTimeout(() => {
                        modalContent.innerHTML = data;
                        
                        // Add fade-in animation
                        modalContent.style.opacity = '0';
                        modalContent.style.transition = 'opacity 0.3s ease-in';
                        setTimeout(() => {
                            modalContent.style.opacity = '1';
                        }, 50);
                    }, remainingTime);
                })
                .catch(error => {
                    console.error('Error:', error);
                    const elapsedTime = Date.now() - startTime;
                    const remainingTime = Math.max(0, minimumLoadTime - elapsedTime);
                    
                    setTimeout(() => {
                        modalContent.innerHTML = `
                            <div class="alert alert-danger text-center py-4">
                                <i class="fas fa-exclamation-triangle fa-2x mb-3 text-danger"></i>
                                <h5>Terjadi Kesalahan</h5>
                                <p>Tidak dapat memuat detail pesanan. Silakan coba lagi.</p>
                                <button class="btn btn-outline-danger btn-sm" onclick="loadDetailPesanan('${idPesanan}')">
                                    <i class="fas fa-redo"></i> Coba Lagi
                                </button>
                            </div>
                        `;
                    }, remainingTime);
                });
        }
    </script>
</body>

</html>