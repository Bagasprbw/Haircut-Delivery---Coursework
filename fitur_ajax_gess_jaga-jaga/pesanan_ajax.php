<?php
session_start();
require_once '../koneksi.php';
require_once '../auth.php';
requireRole('Admin');

$status = $_GET['status'] ?? 'All';

$sql = "SELECT p.*, u.nama AS nama_user FROM pesanan p LEFT JOIN user u ON p.id_user = u.id_user";
if ($status !== 'All') {
    $sql .= " WHERE p.status_pesanan = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $status);
} else {
    $stmt = $koneksi->prepare($sql);
}
$stmt->execute();
$result = $stmt->get_result();

$no = 1;
while ($row = $result->fetch_assoc()) {
    $badge = match($row['status_pesanan']) {
        'Selesai' => 'success',
        'Diproses' => 'info',
        'Dibatalkan' => 'danger',
        'Menunggu Konfirmasi' => 'warning',
        'Dikonfirmasi' => 'primary',
        default => 'secondary',
    };

    echo "<tr>
        <td>{$no}</td>
        <td>" . htmlspecialchars($row['nama_user']) . "</td>
        <td>" . date('d-m-Y', strtotime($row['waktu'])) . "</td>
        <td>" . htmlspecialchars($row['telp']) . "</td>
        <td>" . htmlspecialchars($row['alamat']) . "</td>
        <td>Rp " . number_format($row['total_harga'], 0, ',', '.') . "</td>
        <td><span class='badge bg-{$badge}'>{$row['status_pesanan']}</span></td>
        <td>
            <a href='detail_pesanan.php?id={$row['id_pesanan']}' class='btn btn-sm btn-outline-success me-1'><i class='fas fa-eye'></i></a>
            <form action='update_status.php' method='POST' class='d-inline'>
                <input type='hidden' name='id_pesanan' value='{$row['id_pesanan']}'>
                <select name='status_pesanan' class='form-select form-select-sm d-inline w-auto'>
                    
                    <option " . ($row['status_pesanan'] == 'Diproses' ? 'selected' : '') . ">Diproses</option>
                    <option " . ($row['status_pesanan'] == 'Selesai' ? 'selected' : '') . ">Selesai</option>
                    <option " . ($row['status_pesanan'] == 'Dibatalkan' ? 'selected' : '') . ">Dibatalkan</option>
                </select>
                <button type='submit' class='btn btn-sm btn-outline-primary'>Ubah</button>
            </form>
        </td>
    </tr>";
    $no++;
}
