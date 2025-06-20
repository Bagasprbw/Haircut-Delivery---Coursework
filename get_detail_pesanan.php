<?php
session_start();
require_once 'koneksi.php';

// Cek login & role
if (empty($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'Customer') {
    http_response_code(403);
    echo '<div class="alert alert-danger">Akses ditolak.</div>';
    exit();
}

// Cek ID pesanan
if (empty($_GET['id'])) {
    http_response_code(400);
    echo '<div class="alert alert-danger">ID pesanan tidak ditemukan.</div>';
    exit();
}

$id_pesanan = $_GET['id'];
$id_user = $_SESSION['id_user'];

// Ambil data pesanan
$stmt = $koneksi->prepare("SELECT * FROM pesanan WHERE id_pesanan = ? AND id_user = ?");
$stmt->bind_param("ss", $id_pesanan, $id_user);
$stmt->execute();
$pesanan = $stmt->get_result()->fetch_assoc();

if (!$pesanan) {
    http_response_code(404);
    echo '<div class="alert alert-danger">Pesanan tidak ditemukan.</div>';
    exit();
}

// Ambil detail pesanan
$stmt2 = $koneksi->prepare("
    SELECT dp.*, l.nama_layanan, l.harga_layanan 
    FROM detail_pesanan dp
    LEFT JOIN layanan l ON dp.id_layanan = l.id_layanan
    WHERE dp.id_pesanan = ?
");
$stmt2->bind_param("s", $id_pesanan);
$stmt2->execute();
$detail_items = $stmt2->get_result();

// Fungsi aman untuk output HTML
function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// Status badge class
$statusClass = match ($pesanan['status_pesanan']) {
    'Belum dibayar' => 'bg-danger',
    'Menunggu Konfirmasi' => 'bg-warning text-dark',
    'Dikonfirmasi' => 'bg-info text-dark',
    'Diproses' => 'bg-primary',
    'Selesai' => 'bg-success',
    'Dibatalkan' => 'bg-danger',
    default => 'bg-secondary',
};
?>

<div class="row mb-4">
    <div class="col-md-6">
        <h6><i class="fas fa-info-circle text-success"></i> Informasi Pesanan</h6>
        <table class="table table-sm table-borderless">
            <tr>
                <td><strong>ID Pesanan:</strong></td>
                <td>#<?= e($pesanan['id_pesanan']) ?></td>
            </tr>
            <tr>
                <td><strong>Tanggal:</strong></td>
                <td><?= date('d-m-Y H:i', strtotime($pesanan['waktu'])) ?></td>
            </tr>
            <tr>
                <td><strong>Status:</strong></td>
                <td>
                    <span class="badge <?= $statusClass ?>">
                        <?= e($pesanan['status_pesanan']) ?>
                    </span>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <h6><i class="fas fa-user text-success"></i> Informasi Customer</h6>
        <table class="table table-sm table-borderless">
            <tr>
                <td><strong>Nama:</strong></td>
                <td><?= e($pesanan['nama']) ?></td>
            </tr>
            <tr>
                <td><strong>Alamat:</strong></td>
                <td><?= e($pesanan['alamat']) ?></td>
            </tr>
            <tr>
                <td><strong>Telepon:</strong></td>
                <td><?= e($pesanan['telp']) ?></td>
            </tr>
        </table>
    </div>
</div>

<h6><i class="fas fa-list text-success"></i> Detail Layanan</h6>
<div class="table-responsive">
    <table class="table table-sm table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Layanan</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $total = 0;

            if ($detail_items->num_rows > 0):
                while ($item = $detail_items->fetch_assoc()):
                    $qty = isset($item['jumlah']) ? (int)$item['jumlah'] : 1;
                    
                    // Fallback jika layanan sudah dihapus
                    $nama_layanan = $item['nama_layanan'] ?? 'Layanan sudah dihapus';
                    $harga = isset($item['harga_layanan']) ? (int)$item['harga_layanan'] : (int)$item['harga'];
                    $subtotal = $harga * $qty;
                    $total += $subtotal;
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <?= e($nama_layanan) ?>
                    <?php if (is_null($item['nama_layanan'])): ?>
                        <span class="badge bg-danger ms-2">Dihapus</span>
                    <?php endif; ?>
                </td>
                <td>Rp <?= number_format($harga, 0, ',', '.') ?></td>
                <td><?= $qty ?></td>
                <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
            </tr>
            <?php
                endwhile;
            else:
            ?>
            <tr>
                <td colspan="5" class="text-center text-muted">
                    Tidak ada item pada pesanan ini.
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Ringkasan Total -->
<div class="row mt-3">
    <div class="col-md-6 offset-md-6">
        <table class="table table-sm">
            <tr>
                <td><strong>Subtotal:</strong></td>
                <td class="text-end"><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></td>
            </tr>
            <tr class="text-success">
                <td><strong>Diskon:</strong></td>
                <td class="text-end"><strong>- Rp <?= number_format($pesanan['diskon'] ?? 0, 0, ',', '.') ?></strong></td>
            </tr>
            <tr class="table-warning">
                <td><strong>Total Akhir:</strong></td>
                <td class="text-end">
                    <h5><strong>Rp <?= number_format($pesanan['total_harga'] ?? ($total - ($pesanan['diskon'] ?? 0)), 0, ',', '.') ?></strong></h5>
                </td>
            </tr>
        </table>
    </div>
</div>