<?php
// Mulai session
session_start();

// Hapus semua data session
$_SESSION = array();

// Jika ingin menghancurkan session sepenuhnya, hapus juga cookie session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Akhiri session
session_destroy();

// Redirect ke halaman login atau halaman utama
header("Location: login.php");
exit();
?>