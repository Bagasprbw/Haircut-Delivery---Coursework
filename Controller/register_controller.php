<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once '../koneksi.php';

//register
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = $_POST['nama'];
    $telp     = $_POST['telp'];
    $alamat   = $_POST['alamat'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role     = 'customer'; // default role

    // ==== GENERATE KODE PRODUK ====
    $result = mysqli_query($koneksi, "SELECT id_user FROM user ORDER BY id_user DESC LIMIT 1");
    $data = mysqli_fetch_assoc($result);

    if ($data) {
        $lastNumber = (int)substr($data['id_user'], 1); // Misal: "P005" → 5
        $newNumber = $lastNumber + 1;
    } else {
        $newNumber = 1;
    }

    $id_user = 'U' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

    // Cek apakah username sudah digunakan
    $cek_username = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($cek_username) > 0) {
        echo "<script>alert('Username sudah digunakan'); window.location.href='../register.php';</script>";
    } else {
        // Cek apakah nama sudah digunakan
        $cek_nama = mysqli_query($koneksi, "SELECT * FROM user WHERE nama = '$nama'");
        if (mysqli_num_rows($cek_nama) > 0) {
            echo "<script>alert('Nama sudah terdaftar. Silakan gunakan nama yang berbeda.'); window.location.href='../register.php';</script>";
        } else {
            $insert = mysqli_query($koneksi, "INSERT INTO user (id_user, username, password, nama, alamat, telp, role)
                VALUES ('$id_user', '$username', '$password', '$nama', '$alamat', '$telp', '$role')");
            if ($insert) {
                session_start();
                $_SESSION['success_message'] = 'Registrasi berhasil';
                header("Location: ../login.php");
                exit();
            } else {
                echo "<script>alert('Gagal registrasi');</script>";
            }
        }
    }
}
?>