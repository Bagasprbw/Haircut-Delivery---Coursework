<?php
session_start();
require_once 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'Customer') {
    header('Location: login.php');
    exit();
}

$id_user = $_SESSION['id_user'];

// Ambil data user
$user_query = $koneksi->query("SELECT * FROM user WHERE id_user = '$id_user'");
$user_data = $user_query->fetch_assoc();

// Ambil statistik pesanan
$total_pesanan = $koneksi->query("SELECT COUNT(*) as total FROM pesanan WHERE id_user = '$id_user'")->fetch_assoc()['total'];
$pesanan_menunggu_konfirmasi = $koneksi->query("SELECT COUNT(*) as total FROM pesanan WHERE id_user = '$id_user' AND status_pesanan = 'Menunggu konfirmasi'")->fetch_assoc()['total'];
$pesanan_selesai = $koneksi->query("SELECT COUNT(*) as total FROM pesanan WHERE id_user = '$id_user' AND status_pesanan = 'Selesai'")->fetch_assoc()['total'];
$pesanan_proses = $koneksi->query("SELECT COUNT(*) as total FROM pesanan WHERE id_user = '$id_user' AND status_pesanan IN ('Diproses', 'Menunggu Konfirmasi', 'Dikonfirmasi')")->fetch_assoc()['total'];
$total_belanja = $koneksi->query("SELECT SUM(total_harga) as total FROM pesanan WHERE id_user = '$id_user' AND status_pesanan = 'Selesai'")->fetch_assoc()['total'] ?: 0;

// Handle form update profil
if ($_POST) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    
    // Update password jika diisi
    if (!empty($_POST['password_baru'])) {
        $password_lama = $_POST['password_lama'];
        $password_baru = password_hash($_POST['password_baru'], PASSWORD_DEFAULT);
        
        // Verifikasi password lama
        if (password_verify($password_lama, $user_data['password'])) {
            $update_query = "UPDATE user SET nama = '$nama', username = '$username', telp = '$telp', alamat = '$alamat', password = '$password_baru' WHERE id_user = '$id_user'";
        } else {
            $error_message = "Password lama tidak sesuai!";
        }
    } else {
        $update_query = "UPDATE user SET nama = '$nama', username = '$username', telp = '$telp', alamat = '$alamat' WHERE id_user = '$id_user'";
    }
    
    if (isset($update_query) && $koneksi->query($update_query)) {
        $success_message = "Profil berhasil diperbarui!";
        // Refresh data user
        $user_query = $koneksi->query("SELECT * FROM user WHERE id_user = '$id_user'");
        $user_data = $user_query->fetch_assoc();
    } elseif (!isset($error_message)) {
        $error_message = "Gagal memperbarui profil!";
    }
}
?>

<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background: linear-gradient(135deg, #121212 0%, #1e1e1e 100%);
            color: #ffffff;
            min-height: 100vh;
        }
        
        .profile-container {
            background: linear-gradient(145deg, #1e1e1e, #2d2d2d);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid #404040;
        }
        
        .profile-header {
            background: linear-gradient(135deg, #198754, #20c997);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .profile-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            transform: rotate(45deg);
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #198754;
            border: 4px solid rgba(255,255,255,0.3);
            margin: 0 auto 1rem;
            position: relative;
            z-index: 1;
        }
        
        .stats-card {
            background: linear-gradient(145deg, #2d2d2d, #383838);
            border-radius: 15px;
            padding: 1.5rem;
            border: 1px solid #404040;
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            border-color: #198754;
        }
        
        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .form-control {
            background-color: #2d2d2d;
            border: 1px solid #404040;
            color: #ffffff;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            background-color: #383838;
            border-color: #198754;
            color: #ffffff;
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
        }
        
        .form-control::placeholder {
            color: #adb5bd;
        }
        
        .form-label {
            color: #ffffff;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .btn-success {
            background: linear-gradient(135deg, #198754, #20c997);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-success:hover {
            background: linear-gradient(135deg, #157347, #1aa085);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(25, 135, 84, 0.4);
        }
        
        .btn-outline-primary {
            color: #0d6efd;
            border-color: #0d6efd;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-primary:hover {
            background-color: #0d6efd;
            border-color: #0d6efd;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.4);
        }
        
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        .alert-success {
            background: linear-gradient(135deg, rgba(25, 135, 84, 0.1), rgba(32, 201, 151, 0.1));
            color: #20c997;
            border-left: 4px solid #20c997;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.1), rgba(255, 87, 87, 0.1));
            color: #ff5757;
            border-left: 4px solid #ff5757;
        }
        
        .section-title {
            color: #ffffff;
            border-bottom: 2px solid #198754;
            padding-bottom: 0.5rem;
            margin-bottom: 2rem;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 60px;
            height: 2px;
            background: linear-gradient(135deg, #20c997, #198754);
        }
        
        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 12px;
        }
        
        ::-webkit-scrollbar-track {
            background: #2d2d2d;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #555555, #777777);
            border-radius: 6px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #777777, #999999);
        }
        
        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .profile-container {
                margin: 1rem;
                padding: 1.5rem;
            }
            
            .profile-avatar {
                width: 80px;
                height: 80px;
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <?php include 'Components/navbar.php'; ?><br><br>
    
    <div class="container mt-5 mb-5">           
        <div class="profile-container fade-in-up">
            <!-- Profile Header -->
            <div class="profile-header text-center">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <h2 class="mb-2"><?= htmlspecialchars($user_data['nama']) ?></h2>
                <p class="mb-0 opacity-75">
                    <i class="fas fa-envelope"></i> <?= htmlspecialchars($user_data['username']) ?>
                </p>
                <p class="mb-0 opacity-75">
                    <i class="fas fa-user-tag"></i> <?= htmlspecialchars($user_data['role']) ?>
                </p>
            </div>
            
            <!-- Statistics -->
            <a href="pesanan_saya.php" class="text-decoration-none text-white">
                <div class="row mb-4">
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="stats-card text-center">
                            <div class="stats-icon bg-primary text-white mx-auto">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <h3 class="mb-1"><?= $total_pesanan ?></h3>
                            <p class="text-muted mb-0">Total Pesanan (Booking)</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="stats-card text-center">
                            <div class="stats-icon bg-success text-white mx-auto">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h3 class="mb-1"><?= $pesanan_selesai ?></h3>
                            <p class="text-muted mb-0">Pesanan (Booking) Selesai</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="stats-card text-center">
                            <div class="stats-icon bg-warning text-white mx-auto">
                                <i class="fas fa-sync-alt"></i>
                            </div>
                            <h3 class="mb-1"><?= $pesanan_proses ?></h3>
                            <p class="text-muted mb-0">Sedang Diproses</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="stats-card text-center">
                            <div class="stats-icon bg-success text-white mx-auto">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                            <h3 class="mb-1"><?= $pesanan_selesai ?></h3>
                            <p class="text-muted mb-0">Menunggu Konfirmasi</p>
                        </div>
                    </div>
                </div>
             </a>
            
            
            <!-- Alerts -->
            <?php if (isset($success_message)): ?>
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check-circle"></i> <?= $success_message ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle"></i> <?= $error_message ?>
                </div>
            <?php endif; ?>
            
            <!-- Form Edit Profil -->
            <h3 class="section-title">
                <i class="fas fa-user-edit"></i> Edit Profil
            </h3>
            
            <form method="POST" class="fade-in-up">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label">
                            <i class="fas fa-user"></i> Nama Lengkap
                        </label>
                        <input type="text" class="form-control" id="nama" name="nama" 
                               value="<?= htmlspecialchars($user_data['nama']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">
                            <i class="fas fa-envelope"></i> username
                        </label>
                        <input type="username" class="form-control" id="username" name="username" 
                               value="<?= htmlspecialchars($user_data['username']) ?>" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="telp" class="form-label">
                            <i class="fas fa-phone"></i> Nomor telp
                        </label>
                        <input type="tel" class="form-control" id="telp" name="telp" 
                               value="<?= htmlspecialchars($user_data['telp']) ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="alamat" class="form-label">
                            <i class="fas fa-map-marker-alt"></i> Alamat
                        </label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= htmlspecialchars($user_data['alamat']) ?></textarea>
                    </div>
                </div>
                
                <hr class="my-4" style="border-color: #404040;">
                
                <h4 class="mb-3">
                    <i class="fas fa-lock"></i> Ubah Password (Opsional)
                </h4>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password_lama" class="form-label">
                            <i class="fas fa-key"></i> Password Lama
                        </label>
                        <input type="password" class="form-control" id="password_lama" name="password_lama" 
                               placeholder="Masukkan password lama">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password_baru" class="form-label">
                            <i class="fas fa-lock"></i> Password Baru
                        </label>
                        <input type="password" class="form-control" id="password_baru" name="password_baru" 
                               placeholder="Masukkan password baru">
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            });
        }, 5000);
        
        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const passwordLama = document.getElementById('password_lama').value;
            const passwordBaru = document.getElementById('password_baru').value;
            
            if (passwordBaru && !passwordLama) {
                e.preventDefault();
                alert('Harap masukkan password lama untuk mengubah password!');
                document.getElementById('password_lama').focus();
            }
        });
    </script>
</body>
</html>