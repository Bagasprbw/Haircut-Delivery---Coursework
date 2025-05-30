<?php
session_start();
require_once '../../koneksi.php';
require_once '../../auth.php';
requireRole('Admin');

if (isset($_POST['add_services'])) {
    // Ambil dan filter data
    $nama_layanan = mysqli_real_escape_string($koneksi, $_POST['nama_layanan']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['Kategori']);
    $harga_layanan = (int)$_POST['harga_layanan'];
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    // ==== GENERATE KODE PRODUK ====
    $result = mysqli_query($koneksi, "SELECT id_layanan FROM layanan ORDER BY id_layanan DESC LIMIT 1");
    $data = mysqli_fetch_assoc($result);

    if ($data) {
        $lastNumber = (int)substr($data['id_layanan'], 1); // Misal: "P005" → 5
        $newNumber = $lastNumber + 1;
    } else {
        $newNumber = 1;
    }

    $id_layanan = 'L' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

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
                $query = "INSERT INTO layanan (id_layanan, nama_layanan, kategori, harga_layanan, gambar, deskripsi)
                          VALUES ('$id_layanan', '$nama_layanan', '$kategori', $harga_layanan, '$nama_gambar', '$deskripsi')";

                if (mysqli_query($koneksi, $query)) {
                    echo "<script>alert('Layanan berhasil ditambahkan!'); window.location='../data_jasa.php';</script>";
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

// ===== EDIT PRODUK =====
if (isset($_POST['edit_services'])) {
    $id_layanan = mysqli_real_escape_string($koneksi, $_POST['id_layanan']);
    $nama_layanan = mysqli_real_escape_string($koneksi, $_POST['nama_layanan']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['Kategori']);
    $harga_layanan = (int)$_POST['harga_layanan'];
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    // Ambil data produk lama (untuk cek gambar lama)
    $result = mysqli_query($koneksi, "SELECT gambar FROM layanan WHERE id_layanan = '$id_layanan'");
    $data_lama = mysqli_fetch_assoc($result);
    $gambar_lama = $data_lama['gambar'];

    // Proses upload gambar baru (jika ada)
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $folder = "../data_gambar/";
        $ext = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($ext, $allowed)) {
            // Rename gambar agar unik
            $nama_gambar_baru = uniqid('img_', true) . '.' . $ext;
            $path_gambar_baru = $folder . $nama_gambar_baru;

            if (move_uploaded_file($tmp, $path_gambar_baru)) {
                // Hapus gambar lama jika ada
                if ($gambar_lama && file_exists($folder . $gambar_lama)) {
                    unlink($folder . $gambar_lama);
                }
                $query = "UPDATE layanan
                          SET nama_layanan='$nama_layanan', kategori='$kategori', harga_layanan=$harga_layanan, gambar='$nama_gambar_baru', deskripsi='$deskripsi' 
                          WHERE id_layanan='$id_layanan'";
            } else {
                echo "Gagal mengunggah gambar baru.";
                exit;
            }
        } else {
            echo "Format gambar tidak valid.";
            exit;
        }
    } else {
        // Tidak ada gambar baru → tetap gunakan gambar lama
        $query = "UPDATE layanan 
                  SET nama_layanan='$nama_layanan', kategori='$kategori', harga_layanan=$harga_layanan, deskripsi='$deskripsi' 
                  WHERE id_layanan='$id_layanan'";
    }

    // Eksekusi query update
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Layanan berhasil diperbarui!'); window.location='../data_jasa.php';</script>";
    } else {
        echo "Gagal memperbarui layanan: " . mysqli_error($koneksi);
    }
}

// ===== HAPUS LAYANAN =====
if (isset($_GET['hapus_layanan'])) {
    $id_layanan = mysqli_real_escape_string($koneksi, $_GET['hapus_layanan']);

    // Ambil data layanan untuk cek gambar
    $result = mysqli_query($koneksi, "SELECT gambar FROM layanan WHERE id_layanan = '$id_layanan'");
    $data = mysqli_fetch_assoc($result);
    $gambar = $data['gambar'];
    $folder = "../data_gambar/";

    // Hapus gambar dari folder (jika ada)
    if ($gambar && file_exists($folder . $gambar)) {
        unlink($folder . $gambar);
    }

    // Hapus data dari database
    $hapus = mysqli_query($koneksi, "DELETE FROM layanan WHERE id_layanan = '$id_layanan'");

    if ($hapus) {
        echo "<script>alert('Layanan berhasil dihapus.'); window.location='../data_jasa.php';</script>";
    } else {
        echo "Gagal menghapus layanan: " . mysqli_error($koneksi);
    }
}
?>
