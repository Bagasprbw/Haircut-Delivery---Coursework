<!-- <?php
session_start();
require_once '../koneksi.php';
require_once '../auth.php';
requireRole('Admin');

// Validasi ID
if (!isset($_GET['id'])) {
    echo "ID pesanan tidak ditemukan.";
    exit;
}

$id_pesanan = $_GET['id'];

// Ambil data pesanan
$stmt = $koneksi->prepare("
    SELECT p.*, u.nama AS nama_user, u.alamat AS alamat_user, u.telp AS telp_user
    FROM pesanan p
    LEFT JOIN user u ON p.id_user = u.id_user
    WHERE p.id_pesanan = ?
");
$stmt->bind_param("s", $id_pesanan);
$stmt->execute();
$result = $stmt->get_result();
$pesanan = $result->fetch_assoc();

if (!$pesanan) {
    echo "Data pesanan tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Detail Pesanan</h5>
            <a href="pesanan.php" class="btn btn-sm btn-light"><i class="fas fa-arrow-left me-1"></i>Kembali</a>
        </div>
        <div class="card-body">
            <h6 class="text-muted">Informasi Pemesan</h6>
            <table class="table">
                <tr>
                    <th>Nama Customer</th>
                    <td><?= htmlspecialchars($pesanan['nama_user']) ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><?= htmlspecialchars($pesanan['alamat']) ?></td>
                </tr>
                <tr>
                    <th>No. Telepon</th>
                    <td><?= htmlspecialchars($pesanan['telp']) ?></td>
                </tr>
                <tr>
                    <th>Tanggal Pesan</th>
                    <td><?= date('d-m-Y', strtotime($pesanan['waktu'])) ?></td>
                </tr>
            </table>

            <h6 class="text-muted mt-4">Detail Transaksi</h6>
            <table class="table">
                <tr>
                    <th>Total Harga</th>
                    <td>Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Diskon</th>
                    <td>Rp <?= number_format($pesanan['diskon'], 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Status Pesanan</th>
                    <td>
                        <?php
                            $status = $pesanan['status_pesanan'];
                            $badge = match ($status) {
                                'Selesai' => 'success',
                                'Diproses' => 'info',
                                'Dibatalkan' => 'danger',
                                'Menunggu Konfirmasi' => 'warning',
                                'Dikonfirmasi' => 'primary',
                                default => 'secondary'
                            };
                        ?>
                        <span class="badge bg-<?= $badge ?>"><?= $status ?></span>
                    </td>
                </tr>
            </table>

            <h6 class="text-muted mt-4">Layanan Dipesan</h6>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Layanan</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $queryDetail = $koneksi->prepare("
                        SELECT d.*, l.nama_layanan, l.harga_layanan
                        FROM detail_pesanan d
                        JOIN layanan l ON d.id_layanan = l.id_layanan
                        WHERE d.id_pesanan = ?
                    ");
                    $queryDetail->bind_param("s", $id_pesanan);
                    $queryDetail->execute();
                    $resDetail = $queryDetail->get_result();
                    $no = 1;
                    while ($layanan = $resDetail->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($layanan['nama_layanan']) ?></td>
                        <td>Rp <?= number_format($layanan['harga'], 0, ',', '.') ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->

<h1>Coming soon</h1>
