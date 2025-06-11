<?php
session_start();
require_once '../koneksi.php';

if (isset($_POST['username'])) {
    $username = trim($_POST['username']);
    
    // Gunakan prepared statement untuk keamanan
    $stmt = $koneksi->prepare("SELECT COUNT(*) FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        echo "<span class='text-danger'><i class='bi bi-x-circle-fill'></i> Username tidak tersedia</span>";
    } else {
        echo "<span class='text-success'><i class='bi bi-check-circle-fill'></i> Username tersedia</span>";
    }
}
?>
