<?php
    session_start();
    require_once '../koneksi.php';
    require_once '../auth.php';
    requireRole('admin');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <H1>Halo admin!🙌, Selamat datang di dashbord khusus</H1>
</body>
</html>