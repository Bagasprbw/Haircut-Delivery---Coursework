<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once '../koneksi.php';
//login
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error_message'] = 'Invalid request method';
    header('Location: ../login.php');
    exit();
}

if (empty($_POST['username']) || empty($_POST['password'])) {
    $_SESSION['error_message'] = 'Username and password are required';
    header('Location: ../login.php');
    exit();
}

$username = trim($_POST['username']);
$password = $_POST['password'];

try {
    // Gunakan nama kolom yang sesuai dengan struktur tabel Anda
    $stmt = $koneksi->prepare("SELECT id_user, username, role, password, nama FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    
    if (!$stmt->execute()) {
        throw new Exception("Query execution failed");
    }
    
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Untuk testing, bandingkan password plain text dulu
        if ($password === $user['password']) {
            session_regenerate_id(true);
            
            // Sesuaikan dengan nama kolom di database
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['logged_in'] = true;
            
            $_SESSION['success_message'] = 'Login successful';
            header('Location: ../index.php');
            exit();
        }
        
        $_SESSION['error_message'] = 'Invalid password';
        header('Location: ../login.php');
        exit();
    }
    
    $_SESSION['error_message'] = 'Username not found';
    header('Location: ../login.php');
    exit();
    
} catch (Exception $e) {
    $_SESSION['error_message'] = 'Login error: ' . $e->getMessage();
    header('Location: ../login.php');
    exit();
}
?>