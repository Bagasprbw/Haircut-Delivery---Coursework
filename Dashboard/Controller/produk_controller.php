<?php
session_start();
require_once '../../koneksi.php';
require_once '../../auth.php';
requireRole('Admin');

if (isset($_POST['add_products'])) {
    // Ambil dan filter data
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['Kategori']);
    $harga = (int)$_POST['harga'];
    $stok = (int)$_POST['stok'];
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    // ==== GENERATE KODE PRODUK ====
    $result = mysqli_query($koneksi, "SELECT id_produk FROM produk ORDER BY id_produk DESC LIMIT 1");
    $data = mysqli_fetch_assoc($result);

    if ($data) {
        $lastNumber = (int)substr($data['id_produk'], 1); // Misal: "P005" → 5
        $newNumber = $lastNumber + 1;
    } else {
        $newNumber = 1;
    }

    $id_produk = 'P' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

    // ==== PROSES UPLOAD GAMBAR ====
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $folder = "../data_gambar/";
        $ext = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($ext, $allowed)) {
            // Rename gambar agar unik
            $nama_gambar = uniqid('img_', true) . '.' . $ext;
            $path_gambar = $folder . $nama_gambar;

            if (move_uploaded_file($tmp, $path_gambar)) {
                // ==== SIMPAN KE DATABASE ====
                $query = "INSERT INTO produk (id_produk, nama_produk, kategori, harga, stok, gambar, deskripsi)
                          VALUES ('$id_produk', '$nama_produk', '$kategori', $harga, $stok, '$nama_gambar', '$deskripsi')";

                if (mysqli_query($koneksi, $query)) {
                    echo "<script>alert('Produk berhasil ditambahkan!'); window.location='../data_produk.php';</script>";
                } else {
                    echo "Gagal menyimpan ke database: " . mysqli_error($koneksi);
                }
            } else {
                echo "Gagal mengunggah gambar.";
            }
        } else {
            echo "Format gambar tidak valid. Gunakan JPG, JPEG, PNG, GIF, atau WEBP.";
        }
    } else {
        echo "Gambar belum diunggah atau terjadi kesalahan.";
    }
} else {
    echo "Form tidak dikirim.";
}
?>
