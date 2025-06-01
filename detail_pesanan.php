<?php
session_start();
require_once 'koneksi.php';

// Check if user is logged in and role is Customer
if (empty($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'Customer') {
    header('Location: login.php');
    exit();
}

// Validate order ID parameter
if (empty($_GET['id'])) {
    die("ID pesanan tidak ditemukan.");
}

$id_pesanan = $_GET['id'];
$id_user = $_SESSION['id_user'];

// Prepare and execute query to fetch order
$stmt = $koneksi->prepare("SELECT * FROM pesanan WHERE id_pesanan = ? AND id_user = ?");
$stmt->bind_param("ss", $id_pesanan, $id_user);
$stmt->execute();
$pesanan = $stmt->get_result()->fetch_assoc();

if (!$pesanan) {
    die("Pesanan tidak ditemukan.");
}

// Fetch order details with service info and quantity
// NOTE: You need to have 'jumlah' column in detail_pesanan for quantity
$stmt2 = $koneksi->prepare("
    SELECT dp.*, l.nama_layanan, l.harga_layanan 
    FROM detail_pesanan dp
    JOIN layanan l ON dp.id_layanan = l.id_layanan
    WHERE dp.id_pesanan = ?
");
$stmt2->bind_param("s", $id_pesanan);
$stmt2->execute();
$detail_items = $stmt2->get_result();

function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Detail Pesanan #<?= e($pesanan['id_pesanan']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .invoice-box {
            max-width: 800px;
            margin: 40px auto;
            border: 1px solid #eee;
            padding: 30px;
            font-size: 16px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,.1);
        }
        .invoice-title {
            margin-bottom: 30px;
        }
        .table td, .table th {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <h2 class="invoice-title text-center">Detail Pesanan</h2>

        <div class="mb-4">
            <strong>ID Pesanan:</strong> <?= e($pesanan['id_pesanan']) ?><br>
            <strong>Tanggal:</strong> <?= date('d-m-Y', strtotime($pesanan['waktu'])) ?><br>
            <strong>Status:</strong>
            <?php
                // Bootstrap badge color by status
                $statusClass = match ($pesanan['status_pesanan']) {
                    'Belum dibayar' => 'bg-danger',
                    'Menunggu Konfirmasi' => 'bg-warning text-dark',
                    'Dikonfirmasi' => 'bg-info text-dark',
                    'Diproses' => 'bg-primary',
                    'Selesai' => 'bg-success',
                    'Dibatalkan' => 'bg-secondary',
                    default => 'bg-secondary',
                };
            ?>
            <span class="badge <?= $statusClass ?>"><?= e($pesanan['status_pesanan']) ?></span>
        </div>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Produk / Layanan</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $total = 0;

                // Check if detail_items has rows
                if ($detail_items->num_rows > 0):
                    while ($item = $detail_items->fetch_assoc()):
                        // Use 'jumlah' column, if not present default to 1
                        $qty = isset($item['jumlah']) ? (int)$item['jumlah'] : 1;
                        $subtotal = $item['harga_layanan'] * $qty;
                        $total += $subtotal;
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= e($item['nama_layanan']) ?></td>
                    <td>Rp <?= number_format($item['harga_layanan'], 0, ',', '.') ?></td>
                    <td><?= $qty ?></td>
                    <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                </tr>
                <?php
                    endwhile;
                else: ?>
                <tr><td colspan="5" class="text-center">Tidak ada item pada pesanan ini.</td></tr>
                <?php endif; ?>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total Harga</strong></td>
                    <td><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end"><strong>Diskon</strong></td>
                    <td>Rp <?= number_format($pesanan['diskon'] ?? 0, 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total Akhir</strong></td>
                    <td><strong>Rp <?= number_format($pesanan['total_harga'] ?? $total - ($pesanan['diskon'] ?? 0), 0, ',', '.') ?></strong></td>
                </tr>
            </tbody>
        </table>

        <div class="mt-4 text-center">
            <a href="pesanan_saya.php" class="btn btn-secondary">Kembali ke Daftar Pesanan</a>
        </div>
    </div>
</body>
</html>
