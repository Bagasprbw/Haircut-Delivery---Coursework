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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Pesanan Saya</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>ID Pesanan</th>
                        <th>Tanggal</th>
                        <th>Diskon</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        <th>Detail</th>
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

                            // Tambahkan warna baris jika status belum selesai atau dibatalkan
                            $row_class = (!in_array($status, ['Selesai', 'Dibatalkan'])) ? 'table-warning' : '';
                        ?>
                        <tr class="<?= $row_class ?>">
                            <td><?= $no++ ?></td>
                            <td><?= $row['id_pesanan'] ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($row['waktu'])) ?></td>
                            <td>Rp <?= number_format($row['diskon'], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                            <td><span class="badge bg-<?= $badge ?>"><?= $status ?></span></td>
                            <td>
                                <?php if (!in_array($status, ['Selesai', 'Dibatalkan'])): ?>
                                    <a href="Controller/pesanan_controller.php?id=<?= $row['id_pesanan'] ?>&aksi=batal" class="btn btn-sm btn-danger" onclick="return confirm('Batalkan pesanan ini?')">Batalkan</a>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="detail_pesanan.php?id=<?= $row['id_pesanan'] ?>" class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    <?php if ($pesanan_user->num_rows == 0): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada pesanan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
