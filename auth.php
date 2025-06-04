<?php
if (!function_exists('requireRole')) {
    function requireRole($role) {
        $loginPath = 'login.php';

        if (!isset($_SESSION['role'])) {
            echo "<script>
                alert('Anda harus login terlebih dahulu. untuk menggunakan fitur ini.');
                window.location.href = '$loginPath';
            </script>";
            exit();
        }

        if ($_SESSION['role'] !== $role) {
            echo "<script>
                alert('Akses ditolak: Anda tidak memiliki izin untuk mengakses halaman ini.');
                window.location.href = '$loginPath';
            </script>";
            exit();
        }
    }
}
?>