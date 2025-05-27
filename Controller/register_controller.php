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
            $insert = mysqli_query($koneksi, "INSERT INTO user (username, password, nama, alamat, telp, role)
                VALUES ('$username', '$password', '$nama', '$alamat', '$telp', '$role')");
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